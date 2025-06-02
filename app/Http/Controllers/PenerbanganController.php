<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenerbanganController extends Controller
{
    /**
     * Tampilkan halaman pencarian tiket (mirip cari_tiket.php asli).
     */
    public function index(Request $request)
    {
        // Ambil filter dari query string (GET)
        $asal    = $request->query('asal', '');
        $tujuan  = $request->query('tujuan', '');
        $tanggal = $request->query('tanggal', '');
        $kelas   = $request->query('kelas', '');

        // Bangun query menggunakan Query Builder (mirip mysqli_real_escape)
        $query = DB::table('tiket_pesawat');
        if ($asal)    $query->where('asal', $asal);
        if ($tujuan)  $query->where('tujuan', $tujuan);
        if ($tanggal) $query->where('tanggal', $tanggal);
        if ($kelas)   $query->where('kelas', $kelas);

        // Urutkan berdasarkan jam_berangkat
        $penerbangan = $query->orderBy('jam_berangkat', 'asc')->get();

        // Return view 'cari_tiket' (kita akan buat Blade-nya persis seperti HTML asli)
        return view('cari_tiket', [
            'penerbangan' => $penerbangan,
            'asal'        => $asal,
            'tujuan'      => $tujuan,
            'tanggal'     => $tanggal,
            'kelas'       => $kelas,
        ]);
    }
}
