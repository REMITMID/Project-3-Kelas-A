<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserManageController extends Controller
{
    /**
     * Tampilkan daftar semua pengguna (hanya untuk admin).
     */
    public function index()
    {
        // Ambil semua user, urutkan berdasarkan id DESC
        $users = User::orderBy('id', 'desc')->get();

        // Kirim ke view admin.users.index
        return view('admin.users.index', compact('users'));
    }
}
