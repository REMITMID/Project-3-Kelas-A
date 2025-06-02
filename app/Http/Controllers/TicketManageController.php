<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;

class TicketManageController extends Controller
{
    /**
     * Tampilkan halaman daftar tiket untuk admin, beserta fitur search & sort.
     */
    public function index(Request $request)
    {
        // Ambil parameter query string
        $search = $request->query('search', '');
        $sort   = $request->query('sort', 'tanggal');
        $order  = strtoupper($request->query('order', 'ASC')) === 'DESC' ? 'DESC' : 'ASC';

        // Validasi field yang boleh di‐sort
        $allowedSorts = ['tanggal', 'maskapai', 'asal', 'tujuan', 'harga', 'jam_berangkat'];
        if (!in_array($sort, $allowedSorts)) {
            $sort = 'tanggal';
        }

        // Bangun query
        $query = Ticket::query();

        if ($search !== '') {
            $query->where(function($q) use ($search) {
                $q->where('maskapai', 'like', "%{$search}%")
                  ->orWhere('asal', 'like', "%{$search}%")
                  ->orWhere('tujuan', 'like', "%{$search}%")
                  ->orWhere('kode_penerbangan', 'like', "%{$search}%");
            });
        }

        // Sorting
        $query->orderBy($sort, $order);

        // Ambil semua tiket (bisa diganti paginate jika banyak data)
        $tickets = $query->get();

        // Kirim data ke view
        return view('admin.tickets.index', [
            'tickets' => $tickets,
            'search'  => $search,
            'sort'    => $sort,
            'order'   => $order,
        ]);
    }

    /**
     * Form edit tiket (opsional, kalau butuh fitur edit).
     */
    public function edit($id)
    {
        $ticket = Ticket::findOrFail($id);
        return view('admin.tickets.edit', compact('ticket'));
    }

    /**
     * Proses update tiket (opsional).
     */
    public function update(Request $request, $id)
    {
        $ticket = Ticket::findOrFail($id);

        $request->validate([
            'maskapai'         => 'required|string|max:255',
            'asal'             => 'required|string|max:100',
            'tujuan'           => 'required|string|max:100',
            'tanggal'          => 'required|date',
            'jam_berangkat'    => 'required',
            'jam_tiba'         => 'required',
            'kelas'            => 'required|string|max:50',
            'harga'            => 'required|numeric',
            'kode_penerbangan' => 'required|string|max:50',
        ]);

        $ticket->update($request->only([
            'maskapai',
            'asal',
            'tujuan',
            'tanggal',
            'jam_berangkat',
            'jam_tiba',
            'kelas',
            'harga',
            'kode_penerbangan',
        ]));

        

        return redirect()->route('tickets.index')
                         ->with('success', 'Data tiket berhasil diupdate.');
    }
    public function destroy($id)
    {
        // Cari dulu tiket-nya, atau throw 404 jika tidak ditemukan
        $ticket = Ticket::findOrFail($id);

        // Hapus data
        $ticket->delete();

        // Redirect kembali ke halaman daftar dengan pesan sukses
        return redirect()
            ->route('tickets.index')
            ->with('success', 'Tiket berhasil dihapus.');
    }
}