{{-- resources/views/admin/tickets/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Kelola Tiket - Admin')

@section('content')
<div class="result-header">
    <div class="container d-flex align-items-center">
        <img src="{{ asset('Gambar/logo.png') }}" alt="Logo" style="height:36px; margin-right:10px;">
        <span class="fw-bold fs-4 text-white">Brawijayan</span>
    </div>
</div>

<div class="container mt-4">
    <h3 class="fw-semibold mb-4">Kelola Semua Tiket</h3>

    <!-- Form Pencarian & Sort -->
    <form method="get" action="{{ route('tickets.index') }}" class="row g-2 mb-3">
        <div class="col-md-4">
            <input
                type="text"
                name="search"
                class="form-control"
                placeholder="Cari tiket..."
                value="{{ old('search', $search) }}"
            >
        </div>
        <div class="col-md-3">
            <select name="sort" class="form-select">
                <option value="tanggal" {{ $sort == 'tanggal' ? 'selected' : '' }}>Tanggal</option>
                <option value="maskapai" {{ $sort == 'maskapai' ? 'selected' : '' }}>Maskapai</option>
                <option value="asal" {{ $sort == 'asal' ? 'selected' : '' }}>Asal</option>
                <option value="tujuan" {{ $sort == 'tujuan' ? 'selected' : '' }}>Tujuan</option>
                <option value="harga" {{ $sort == 'harga' ? 'selected' : '' }}>Harga</option>
                <option value="jam_berangkat" {{ $sort == 'jam_berangkat' ? 'selected' : '' }}>Jam Berangkat</option>
            </select>
        </div>
        <div class="col-md-3">
            <select name="order" class="form-select">
                <option value="ASC" {{ $order == 'ASC' ? 'selected' : '' }}>Urutan Naik (A-Z/terkecil)</option>
                <option value="DESC" {{ $order == 'DESC' ? 'selected' : '' }}>Urutan Turun (Z-A/terbesar)</option>
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">Terapkan</button>
        </div>
    </form>

    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary mb-3">⬅ Kembali ke Dashboard</a>
    {{-- Ganti 'dashboard' jika nama route atau URL dashboard Anda berbeda --}}

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Maskapai</th>
                <th>Rute</th>
                <th>
                    <a href="{{ route('tickets.index', [
                            'search' => $search,
                            'sort'   => 'tanggal',
                            'order'  => ($sort == 'tanggal' && $order == 'ASC') ? 'DESC' : 'ASC'
                        ]) }}">
                        Tanggal
                        @if($sort == 'tanggal')
                            @if($order == 'ASC')
                                &uarr;
                            @else
                                &darr;
                            @endif
                        @endif
                    </a>
                </th>
                <th>
                    <a href="{{ route('tickets.index', [
                            'search' => $search,
                            'sort'   => 'jam_berangkat',
                            'order'  => ($sort == 'jam_berangkat' && $order == 'ASC') ? 'DESC' : 'ASC'
                        ]) }}">
                        Jam
                        @if($sort == 'jam_berangkat')
                            @if($order == 'ASC')
                                &uarr;
                            @else
                                &darr;
                            @endif
                        @endif
                    </a>
                </th>
                <th>Kelas</th>
                <th>
                    <a href="{{ route('tickets.index', [
                            'search' => $search,
                            'sort'   => 'harga',
                            'order'  => ($sort == 'harga' && $order == 'ASC') ? 'DESC' : 'ASC'
                        ]) }}">
                        Harga
                        @if($sort == 'harga')
                            @if($order == 'ASC')
                                &uarr;
                            @else
                                &darr;
                            @endif
                        @endif
                    </a>
                </th>
                <th>Kode</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($tickets as $ticket)
                <tr>
                    <td>{{ $ticket->id }}</td>
                    <td>{{ $ticket->maskapai }}</td>
                    <td>{{ $ticket->asal }} → {{ $ticket->tujuan }}</td>
                    <td>{{ \Carbon\Carbon::parse($ticket->tanggal)->format('Y-m-d') }}</td>
                    <td>{{ $ticket->jam_berangkat }} - {{ $ticket->jam_tiba }}</td>
                    <td>{{ $ticket->kelas }}</td>
                    <td>Rp {{ number_format($ticket->harga, 0, ',', '.') }}</td>
                    <td>{{ $ticket->kode_penerbangan }}</td>
                    <td>
                        <a
                            href="{{ route('tickets.edit', ['id' => $ticket->id]) }}"
                            class="btn btn-sm btn-warning"
                        >
                            Edit
                        </a>
                        <form
                            action="{{ route('tickets.destroy', ['id' => $ticket->id]) }}"
                            method="POST"
                            style="display:inline;"
                            onsubmit="return confirm('Hapus tiket ini?');"
                        >
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">Tidak ada data tiket.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
