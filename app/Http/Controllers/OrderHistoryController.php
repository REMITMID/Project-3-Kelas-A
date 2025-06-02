<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderHistory;

class OrderHistoryController extends Controller
{
    /**
     * Tampilkan halaman riwayat pesanan (hanya untuk admin).
     */
    public function index()
    {
        // Ambil semua riwayat, urutkan berdasarkan waktu_pesan (DESC), beserta relasi user & ticket
        $histories = OrderHistory::with(['user', 'ticket'])
            ->orderBy('waktu_pesan', 'desc')
            ->get();

        // Kirim data ke view
        return view('admin.orders.index', compact('histories'));
    }
}
