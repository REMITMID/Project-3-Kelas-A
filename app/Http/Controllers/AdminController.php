<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalTiket = DB::table('tiket_pesawat')->count();
        $nama = Auth::user()->name ?? Auth::user()->nama ?? 'Admin';
        return view('admin.dashboard', compact('totalTiket', 'nama'));
    }
}
