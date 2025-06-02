<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PaymentController extends Controller
{
    /**
     * Tampilkan halaman pembayaran (sama dengan booking.php bagian payment).
     */
    public function show(Request $request)
    {
        // Ambil data booking dari session (booking di‐set sebelumnya di BookingController@store)
        $booking = $request->session()->get('booking');

        if (! $booking) {
            // Jika tidak ada data booking di session, kembali ke pencarian tiket
            return redirect()->route('cari.tiket')
                             ->with('error', 'Data booking tidak ditemukan. Silakan ulangi pemesanan.');
        }

        $orderId       = $booking['order_id'];
        $asal          = $booking['asal'];
        $tujuan        = $booking['tujuan'];
        $tanggal       = $booking['tanggal'];
        $jamBerangkat  = $booking['jam_berangkat'];
        $totalHarga    = $booking['total_harga'];
        $maskapai      = $booking['maskapai'];
        $kelas         = $booking['kelas'];
        $hargaBagasi   = $booking['harga_bagasi']; // misalnya 75000
        $deadlineTs    = $booking['deadline'];      // timestamp (integer)
        $tanggalIndo   = Carbon::parse($tanggal)->translatedFormat('D, d M Y');

        $userId = Auth::id();

        // Simpan ke tabel riwayat_pesanan sekali saja (jika belum ada)
        $exists = DB::table('riwayat_pesanan')
                    ->where('order_id', $orderId)
                    ->where('id_user', $userId)
                    ->exists();

        if (! $exists) {
            $penumpangJson = json_encode($booking['penumpang'], JSON_UNESCAPED_UNICODE);

            DB::table('riwayat_pesanan')->insert([
                'id_user'        => $userId,
                'id_tiket'       => $booking['id_tiket'],
                'order_id'       => $orderId,
                'total_harga'    => $totalHarga,
                'status'         => 'Belum Dibayar',
                'penumpang_json' => $penumpangJson,
                'waktu_pesan'    => Carbon::now(), // nilai default
                // kolom lain (maskapai, asal, tujuan, jam_berangkat, dst) di tabel riwayat_pesanan 
                // atas dasar aplikasi Anda: jika ada kolom-kolom tambahan, bisa di‐insert di sini juga.
            ]);
        }

        // Ambil status terkini
        $statusPembayaran = DB::table('riwayat_pesanan')
                              ->where('order_id', $orderId)
                              ->where('id_user', $userId)
                              ->value('status');

        $isLunas = ($statusPembayaran === 'Lunas');

        // Nomor rekening statis (sama seperti di PHP‐asli)
        $rekening = "7 8001 0812 1101 1011";

        return view('pembayaran', compact(
            'orderId',
            'asal',
            'tujuan',
            'tanggalIndo',
            'jamBerangkat',
            'totalHarga',
            'maskapai',
            'kelas',
            'rekening',
            'deadlineTs',
            'isLunas'
        ));
    }

    /**
     * Ditrigger ketika user menekan tombol “Sudah Bayar”.
     * Akan mengupdate kolom status menjadi 'Lunas'.
     */
    public function confirm(Request $request)
    {
        $booking = $request->session()->get('booking');

        if (! $booking) {
            return redirect()->route('cari.tiket')
                             ->with('error', 'Data booking tidak ditemukan. Silakan ulangi pemesanan.');
        }

        $orderId = $booking['order_id'];
        $userId  = Auth::id();

        // Update status jadi Lunas
        DB::table('riwayat_pesanan')
            ->where('order_id', $orderId)
            ->where('id_user', $userId)
            ->update(['status' => 'Lunas']);

        return redirect()->route('pembayaran')
                         ->with('success', 'Pembayaran telah dikonfirmasi, status LUNAS.');
    }
}
