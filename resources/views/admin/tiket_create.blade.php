{{-- resources/views/admin/tiket_tambah.blade.php --}}
@extends('layouts.app')

@section('content')
    {{-- HEADER GRADIENT BIRU --}}
    <div class="result-header" style="background: linear-gradient(90deg, #0455c2 0%, #1765c6 100%); padding: 24px 0 30px 0; color: #fff;">
        <div class="container d-flex align-items-center">
            <img src="{{ asset('Gambar/logo.png') }}" alt="Logo" style="height:36px; margin-right:10px;">
            <span class="fw-bold fs-4">Brawijayan</span>
        </div>
    </div>

    <div class="container mt-4">
        <h3 class="fw-semibold mb-4">Tambah Tiket Baru</h3>

        {{-- Tampilkan flash message sukses/gagal --}}
        @if(session('pesan'))
            <div class="alert alert-info">{{ session('pesan') }}</div>
        @endif

        {{-- Tampilkan error validasi --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <div class="container mt-5">
        <form method="POST" action="{{ route('admin.tiket.store') }}" class="row g-3">
            @csrf

            <div class="col-md-6">
                <label class="form-label">Asal</label>
                <input type="text" name="asal" class="form-control" required value="{{ old('asal') }}">
            </div>
            <div class="col-md-6">
                <label class="form-label">Tujuan</label>
                <input type="text" name="tujuan" class="form-control" required value="{{ old('tujuan') }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">Tanggal</label>
                <input type="date" name="tanggal" class="form-control" required value="{{ old('tanggal') }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">Jam Berangkat</label>
                <input type="time" name="jam_berangkat" class="form-control" required value="{{ old('jam_berangkat') }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">Jam Tiba</label>
                <input type="time" name="jam_tiba" class="form-control" required value="{{ old('jam_tiba') }}">
            </div>
            <div class="col-md-6">
                <label class="form-label">Maskapai</label>
                <input type="text" name="maskapai" class="form-control" required value="{{ old('maskapai') }}">
            </div>
            <div class="col-md-6">
                <label class="form-label">Kelas</label>
                <select name="kelas" class="form-select" required>
                    <option value="Ekonomi" {{ old('kelas')=='Ekonomi' ? 'selected':'' }}>Ekonomi</option>
                    <option value="Bisnis" {{ old('kelas')=='Bisnis' ? 'selected':'' }}>Bisnis</option>
                    <option value="First Class" {{ old('kelas')=='First Class' ? 'selected':'' }}>First Class</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">Harga</label>
                <input type="number" name="harga" class="form-control" required value="{{ old('harga') }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">Durasi</label>
                <input type="text" name="durasi" class="form-control" placeholder="misal: 2j 30m" required value="{{ old('durasi') }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">Transit</label>
                <input type="number" name="transit" class="form-control" required value="{{ old('transit', 0) }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">Reschedule</label>
                <select name="reschedule" class="form-select" required>
                    <option value="Diperbolehkan" {{ old('reschedule')=='Diperbolehkan' ? 'selected':'' }}>Diperbolehkan</option>
                    <option value="Tidak diperbolehkan" {{ old('reschedule')=='Tidak diperbolehkan' ? 'selected':'' }}>Tidak diperbolehkan</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">Refund</label>
                <select name="refund" class="form-select" required>
                    <option value="Diperbolehkan" {{ old('refund')=='Diperbolehkan' ? 'selected':'' }}>Diperbolehkan</option>
                    <option value="Tidak diperbolehkan" {{ old('refund')=='Tidak diperbolehkan' ? 'selected':'' }}>Tidak diperbolehkan</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">Kode Penerbangan</label>
                <input type="text" name="kode_penerbangan" class="form-control" required value="{{ old('kode_penerbangan') }}">
            </div>
            <div class="col-md-6">
                <label class="form-label">Tipe Perjalanan</label>
                <select name="tipe_perjalanan" class="form-select" required>
                    <option value="Sekali Jalan" {{ old('tipe_perjalanan')=='Sekali Jalan' ? 'selected':'' }}>Sekali Jalan</option>
                    <option value="PP" {{ old('tipe_perjalanan')=='PP' ? 'selected':'' }}>PP</option>
                </select>
            </div>

            <div class="col-12 mt-4">
                <button type="submit" class="btn btn-success">Simpan Tiket</button>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>

    {{-- Inline CSS khusus untuk halaman ini, sama persis dengan template PHP --}}
    <style>
        .result-header {
            /* sudah diatur di atas lewat inline style */
        }
        .form-label {
            font-weight: 500;
            margin-bottom: 4px;
        }
    </style>
@endsection
