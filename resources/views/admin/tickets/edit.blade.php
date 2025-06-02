{{-- resources/views/admin/tickets/edit.blade.php --}}
@extends('layouts.app')

@section('title', 'Edit Tiket ‒ Admin')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Edit Data Tiket: {{ $ticket->kode_penerbangan }}</h3>

    {{-- Tampilkan validasi error --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('tickets.update', ['id' => $ticket->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="maskapai" class="form-label">Maskapai</label>
            <input type="text" name="maskapai" id="maskapai"
                   class="form-control"
                   value="{{ old('maskapai', $ticket->maskapai) }}"
                   required>
        </div>
        <div class="mb-3">
            <label for="asal" class="form-label">Asal</label>
            <input type="text" name="asal" id="asal"
                   class="form-control"
                   value="{{ old('asal', $ticket->asal) }}"
                   required>
        </div>
        <div class="mb-3">
            <label for="tujuan" class="form-label">Tujuan</label>
            <input type="text" name="tujuan" id="tujuan"
                   class="form-control"
                   value="{{ old('tujuan', $ticket->tujuan) }}"
                   required>
        </div>
        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" name="tanggal" id="tanggal"
                   class="form-control"
                   value="{{ old('tanggal', $ticket->tanggal) }}"
                   required>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="jam_berangkat" class="form-label">Jam Berangkat</label>
                <input type="time" name="jam_berangkat" id="jam_berangkat"
                       class="form-control"
                       value="{{ old('jam_berangkat', $ticket->jam_berangkat) }}"
                       required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="jam_tiba" class="form-label">Jam Tiba</label>
                <input type="time" name="jam_tiba" id="jam_tiba"
                       class="form-control"
                       value="{{ old('jam_tiba', $ticket->jam_tiba) }}"
                       required>
            </div>
        </div>
        <div class="mb-3">
            <label for="kelas" class="form-label">Kelas</label>
            <select name="kelas" id="kelas" class="form-select" required>
                <option value="Economy" {{ $ticket->kelas == 'Economy' ? 'selected' : '' }}>Economy</option>
                <option value="Business" {{ $ticket->kelas == 'Business' ? 'selected' : '' }}>Business</option>
                <option value="First Class" {{ $ticket->kelas == 'First Class' ? 'selected' : '' }}>First Class</option>
                {{-- Tambahkan opsi lain sesuai kebutuhan --}}
            </select>
        </div>
        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" name="harga" id="harga"
                   class="form-control"
                   value="{{ old('harga', $ticket->harga) }}"
                   required>
        </div>
        <div class="mb-3">
            <label for="kode_penerbangan" class="form-label">Kode Penerbangan</label>
            <input type="text" name="kode_penerbangan" id="kode_penerbangan"
                   class="form-control"
                   value="{{ old('kode_penerbangan', $ticket->kode_penerbangan) }}"
                   required>
        </div>
        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
        <a href="{{ route('tickets.index') }}" class="btn btn-secondary ms-2">Batal</a>
    </form>
</div>
@endsection
