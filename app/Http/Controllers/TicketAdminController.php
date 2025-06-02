<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TicketAdminController extends Controller
{
    // … method index() …

    /**
     * Tampilkan form edit tiket
     */
    public function edit($id)
    {
        $tiket = DB::table('tiket_pesawat')->find($id);
        if (!$tiket) {
            abort(404);
        }
        return view('admin_tiket_edit', ['tiket' => $tiket]);
    }

    /**
     * Simpan perubahan tiket
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'asal'             => 'required|string',
            'tujuan'           => 'required|string',
            'tanggal'          => 'required|date',
            'jam_berangkat'    => 'required',
            'jam_tiba'         => 'required',
            'maskapai'         => 'required|string',
            'kelas'            => 'required|string',
            'harga'            => 'required|numeric',
            'durasi'           => 'required|string',
            'transit'          => 'required|integer',
            'reschedule'       => 'required|string',
            'refund'           => 'required|string',
            'kode_penerbangan' => 'required|string',
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
