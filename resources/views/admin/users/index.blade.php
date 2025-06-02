{{-- resources/views/admin/users/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Kelola Pengguna ‐ Admin')

@section('content')
<div class="result-header">
    <div class="container d-flex align-items-center">
        <img src="{{ asset('Gambar/logo.png') }}" alt="Logo" style="height:36px; margin-right:10px;">
        <span class="fw-bold fs-4 text-white">Brawijayan</span>
    </div>
</div>

<div class="container mt-4">
    <h3 class="fw-semibold mb-4">Daftar Pengguna</h3>

    {{-- Tampilkan flash message jika ada --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary mb-3">
        ⬅ Kembali ke Dashboard
    </a>
    {{-- Ganti route('dashboard') sesuai nama route halaman dashboard Anda --}}

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                {{-- Jika ingin tambah kolom aksi (edit/hapus), tambahkan di sini --}}
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    {{-- Kolom 'nama' diasumsikan memang ada di tabel users --}}
                    <td>{{ $user->nama }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>
                    {{-- Jika ingin tombol edit/hapus, tambahkan <td> di sini --}}
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">
                        Tidak ada pengguna.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
