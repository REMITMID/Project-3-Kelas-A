{{-- resources/views/admin/orders/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Riwayat Pesanan ‐ Admin')

@section('content')
<div class="result-header">
    <div class="container d-flex align-items-center">
        <img src="{{ asset('Gambar/logo.png') }}" alt="Logo" style="height:36px; margin-right:10px;">
        <span class="fw-bold fs-4 text-white">Brawijayan</span>
    </div>
</div>

<div class="container mt-4">
    <h3 class="fw-semibold mb-4">Riwayat Pesanan Pengguna</h3>

    {{-- Tombol “Kembali ke Dashboard” --}}
    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary mb-3">
        ⬅ Kembali ke Dashboard
    </a>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Order ID</th>
                    <th>Nama User</th>
                    <th>Email</th>
                    <th>Maskapai</th>
                    <th>Rute</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($histories as $order)
                    <tr>
                        <td>{{ $order->order_id }}</td>
                        <td>{{ $order->user->nama }}</td>
                        <td>{{ $order->user->email }}</td>
                        <td>{{ $order->ticket->maskapai }}</td>
                        <td>{{ $order->ticket->asal }} → {{ $order->ticket->tujuan }}</td>
                        <td>{{ \Carbon\Carbon::parse($order->ticket->tanggal)->format('Y-m-d') }}</td>
                        <td>{{ $order->status }}</td>
                        <td>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">Belum ada riwayat pesanan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
