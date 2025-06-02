<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Menampilkan form Booking (mirip booking.php asli).
     */
    public function create(Request $request)
    {
        // Ambil ID tiket dari query-string (?id=...)
        $tiketId = $request->query('id');
        if (! $tiketId) {
            return redirect()->route('cari.tiket')
                             ->with('error', 'Tiket tidak ditemukan.');
        }

        // Ambil data penerbangan (tiket_pesawat)
        $tiket = DB::table('tiket_pesawat')->where('id', $tiketId)->first();
        if (! $tiket) {
            return redirect()->route('cari.tiket')
                             ->with('error', 'Tiket tidak ditemukan.');
        }

        // Harga per orang (ambil dari kolom harga), dan tarif bagasi tetap (seperti
        // di PHP‐asli: 75.000). Kalau mau ambil dari DB, bisa ganti di sini.
        $hargaPerOrang = (int) $tiket->harga;
        $hargaBagasi   = 75000;

        // Tampilkan view booking.blade.php, kirim semua variabel yang diperlukan
        return view('booking', compact('tiket', 'hargaPerOrang', 'hargaBagasi'));
    }

    /**
     * Proses form Booking, simpan data ke session, lalu redirect ke pembayaran.
     */
    public function store(Request $request)
    {
        // Validasi minimal: semua field hidden + penumpang_json
        $data = $request->validate([
            'id_tiket'          => 'required|integer|exists:tiket_pesawat,id',
            'maskapai'          => 'required|string',
            'asal'              => 'required|string',
            'tujuan'            => 'required|string',
            'kode_penerbangan'  => 'required|string',
            'jam_berangkat'     => 'required|string',
            'jam_tiba'          => 'required|string',
            'tanggal'           => 'required|date',
            'kelas'             => 'required|string',
            'harga_perorang'    => 'required|integer',
            'harga_bagasi'      => 'required|integer',
            'jumlah_bagasi'     => 'required|integer',
            'total_harga'       => 'required|integer',
            'penumpang_json'    => 'required|string',
        ]);

        // Decode JSON penumpang
        $penumpang = json_decode($data['penumpang_json'], true);
        if (! is_array($penumpang) || count($penumpang) < 1) {
            return back()->with('error', 'Isi minimal 1 penumpang sebelum lanjut.')
                         ->withInput();
        }

        // Generate order_id dan deadline (55 menit ke depan)
        $orderId  = rand(1000000000, 9999999999);
        $deadline = now()->addMinutes(55)->timestamp;

        // Siapkan data booking di session (mirip $_SESSION['booking'] di PHP‐asli)
        $booking = [
            'order_id'         => $orderId,
            'id_tiket'         => $data['id_tiket'],
            'maskapai'         => $data['maskapai'],
            'asal'             => $data['asal'],
            'tujuan'           => $data['tujuan'],
            'kode_penerbangan' => $data['kode_penerbangan'],
            'jam_berangkat'    => $data['jam_berangkat'],
            'jam_tiba'         => $data['jam_tiba'],
            'tanggal'          => $data['tanggal'],
            'kelas'            => $data['kelas'],
            'harga_perorang'   => $data['harga_perorang'],
            'harga_bagasi'     => $data['harga_bagasi'],
            'jumlah_bagasi'    => $data['jumlah_bagasi'],
            'total_harga'      => $data['total_harga'],
            'penumpang'        => $penumpang,
            'deadline'         => $deadline,
            'user_id'          => Auth::id(),
        ];

        // Simpan ke session
        $request->session()->put('booking', $booking);

        // Redirect ke halaman pembayaran (route 'pembayaran')
        return redirect()->route('pembayaran');
    }

    /**
     * Hanya contoh method untuk menampilkan halaman pembayaran.
     * Di sini kita bisa menampilkan data booking dari session.
     */
    public function pembayaran(Request $request)
    {
        $booking = $request->session()->get('booking');
        if (! $booking) {
            return redirect()->route('cari.tiket')
                             ->with('error', 'Tidak ada data booking aktif.');
        }
        // Tampilkan view pembayaran.blade.php (silakan buat sendiri)
        return view('pembayaran', compact('booking'));
    }
}
