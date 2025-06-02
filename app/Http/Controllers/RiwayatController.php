<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RiwayatController extends Controller
{
    /**
     * Tampilkan daftar riwayat pesanan (riwayat_eticket).
     */
    public function index()
    {
        // Ambil ID user yang sedang login
        $id_user = Auth::id();

        // Query riwayat_pesanan milik user yang login
        $riwayatRows = DB::table('riwayat_pesanan')
            ->where('id_user', $id_user)
            ->orderByDesc('id')
            ->get();

        // Kita akan kumpulkan setiap baris, decode penumpang_json, dan join tiket_pesawat
        $daftar = $riwayatRows->map(function($row) {
            // Decode penumpang_json ke array (jika ada)
            $penumpang = [];
            if (!empty($row->penumpang_json)) {
                $penumpang = json_decode($row->penumpang_json, true);
            }

            // Ambil data tiket_pesawat berdasarkan id_tiket
            $tiket = DB::table('tiket_pesawat')
                        ->where('id', $row->id_tiket)
                        ->first();

            return [
                'id'             => $row->id,
                'id_user'        => $row->id_user,
                'id_tiket'       => $row->id_tiket,
                'order_id'       => $row->order_id,
                'total_harga'    => $row->total_harga,
                'status'         => $row->status,
                'penumpang'      => $penumpang,
                'tiket'          => $tiket ? (array) $tiket : null,
                'created_at'     => $row->waktu_pesan ?? null,    // sesuaikan nama kolom
                'maskapai'       => $row->maskapai ?? null,       // jika tersimpan di riwayat
                'kelas'          => $row->kelas ?? null,
            ];
        })->toArray();

        // Tampilkan view dan kirim variabel $daftar
        return view('riwayat_eticket', compact('daftar'));
    }
}
