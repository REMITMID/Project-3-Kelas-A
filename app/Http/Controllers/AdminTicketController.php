<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminTicketController extends Controller
{
    public function create()
    {
        return view('admin.tiket_create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'asal' => 'required|string|max:100',
            'tujuan' => 'required|string|max:100',
            'tanggal' => 'required|date',
            'jam_berangkat' => 'required',
            'jam_tiba' => 'required',
            'maskapai' => 'required|string|max:100',
            'kelas' => 'required|string|max:50',
            'harga' => 'required|integer',
            'durasi' => 'required|string|max:30',
            'transit' => 'required|integer',
            'reschedule' => 'required|string',
            'refund' => 'required|string',
            'kode_penerbangan' => 'required|string|max:50',
            'tipe_perjalanan' => 'required|string|max:50',
        ]);

        // Simpan ke DB
        DB::table('tiket_pesawat')->insert($validated);

        return redirect()->route('admin.tiket.create')->with('pesan', '✅ Tiket berhasil ditambahkan!');
    }
}
    