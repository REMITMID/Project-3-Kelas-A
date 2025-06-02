<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TiketAdminController extends Controller
{
    /**
     * Tampilkan daftar semua tiket dengan fitur search, sort, order.
     */
    public function index(Request $request)
    {
        // Ambil parameter dari query string
        $search = $request->query('search', '');
        $sort   = $request->query('sort', 'tanggal');
        $order  = strtoupper($request->query('order', 'ASC')) === 'DESC' ? 'DESC' : 'ASC';

        // Pastikan kolom sort aman
        $allowedSorts = ['tanggal', 'maskapai', 'asal', 'tujuan', 'harga', 'jam_berangkat'];
        if (!in_array($sort, $allowedSorts)) {
            $sort = 'tanggal';
        }

        // Bangun query builder
        $query = DB::table('tiket_pesawat')
            ->when($search, function($q, $search) {
                $q->where('maskapai', 'like', "%{$search}%")
                  ->orWhere('asal', 'like', "%{$search}%")
                  ->orWhere('tujuan', 'like', "%{$search}%")
                  ->orWhere('kode_penerbangan', 'like', "%{$search}%");
            })
            ->orderBy($sort, $order);

        // Paging atau get semua (misalnya paginasi 10 per halaman)
        $tiket = $query->paginate(10)->withQueryString();

        // Kirim ke view, sertakan nilai search, sort, order supaya form tetap terisi
        return view('admin.tiket.index', compact('tiket', 'search', 'sort', 'order'));
    }

    /**
     * Form tambah tiket baru
     */
    public function create()
    {
        return view('admin.tiket.create');
    }

    /**
     * Simpan tiket baru ke database
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'asal'           => 'required|string|max:50',
            'tujuan'         => 'required|string|max:50',
            'tanggal'        => 'required|date',
            'jam_berangkat'  => 'required',
            'jam_tiba'       => 'required',
            'maskapai'       => 'required|string|max:100',
            'kelas'          => 'required|string',
            'harga'          => 'required|numeric',
            'durasi'         => 'required|string',
            'transit'        => 'required|integer',
            'reschedule'     => 'required|string',
            'refund'         => 'required|string',
            'kode_penerbangan' => 'required|string|max:20',
            'tipe_perjalanan'  => 'required|string',
        ]);

        DB::table('tiket_pesawat')->insert($data);

        return redirect()->route('admin.tiket.create')
                         ->with('pesan', '✅ Tiket berhasil ditambahkan!');
    }

    /**
     * Form edit tiket yang sudah ada
     */
    public function edit($id)
    {
        $tiket = DB::table('tiket_pesawat')->find($id);
        if (!$tiket) {
            abort(404);
        }
        return view('admin.tiket.edit', compact('tiket'));
    }

    /**
     * Update data tiket di database
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'asal'           => 'required|string|max:50',
            'tujuan'         => 'required|string|max:50',
            'tanggal'        => 'required|date',
            'jam_berangkat'  => 'required',
            'jam_tiba'       => 'required',
            'maskapai'       => 'required|string|max:100',
            'kelas'          => 'required|string',
            'harga'          => 'required|numeric',
            'durasi'         => 'required|string',
            'transit'        => 'required|integer',
            'reschedule'     => 'required|string',
            'refund'         => 'required|string',
            'kode_penerbangan' => 'required|string|max:20',
            'tipe_perjalanan'  => 'required|string',
        ]);

        DB::table('tiket_pesawat')->where('id', $id)->update($data);

        return redirect()->route('admin.tiket.index')
                         ->with('pesan', '✅ Tiket berhasil diupdate!');
    }

    /**
     * Hapus tiket
     */
    public function destroy($id)
    {
        DB::table('tiket_pesawat')->where('id', $id)->delete();
        return redirect()->route('admin.tiket.index')
                         ->with('pesan', '✅ Tiket berhasil dihapus!');
    }
}
