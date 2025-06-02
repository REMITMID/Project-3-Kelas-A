{{-- resources/views/admin_tiket.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Tiket - Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .result-header {
            background: linear-gradient(90deg, #0455c2 0%, #1765c6 100%);
            padding: 24px 0 30px 0;
            color: #fff;
        }
        th a {
            color: inherit;
            text-decoration: none;
        }
    </style>
</head>
<body>
    {{-- Header biru --}}
    <div class="result-header">
        <div class="container d-flex align-items-center">
            <img src="{{ asset('Gambar/logo.png') }}" alt="Logo" style="height:36px; margin-right:10px;">
            <span class="fw-bold fs-4">Brawijayan</span>
        </div>
    </div>

    <div class="container mt-4">
        <h3 class="fw-semibold mb-4">Kelola Semua Tiket</h3>

        {{-- Form search + sort + order --}}
        <form method="GET" class="row g-2 mb-3">
            <div class="col-md-4">
                <input
                    type="text"
                    name="search"
                    class="form-control"
                    placeholder="Cari tiket..."
                    value="{{ old('search', $search) }}">
            </div>
            <div class="col-md-3">
                <select name="sort" class="form-select">
                    <option value="tanggal"        {{ $sort === 'tanggal'        ? 'selected' : '' }}>Tanggal</option>
                    <option value="maskapai"       {{ $sort === 'maskapai'       ? 'selected' : '' }}>Maskapai</option>
                    <option value="asal"           {{ $sort === 'asal'           ? 'selected' : '' }}>Asal</option>
                    <option value="tujuan"         {{ $sort === 'tujuan'         ? 'selected' : '' }}>Tujuan</option>
                    <option value="harga"          {{ $sort === 'harga'          ? 'selected' : '' }}>Harga</option>
                    <option value="jam_berangkat"  {{ $sort === 'jam_berangkat'  ? 'selected' : '' }}>Jam Berangkat</option>
                </select>
            </div>
            <div class="col-md-3">
                <select name="order" class="form-select">
                    <option value="ASC"  {{ $order === 'ASC'  ? 'selected' : '' }}>Urutan Naik (A-Z/terkecil)</option>
                    <option value="DESC" {{ $order === 'DESC' ? 'selected' : '' }}>Urutan Turun (Z-A/terbesar)</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Terapkan</button>
            </div>
        </form>

        {{-- Tombol “Kembali ke Dashboard” --}}
        <a href="{{ url('/admin/dashboard') }}" class="btn btn-secondary mb-3">⬅ Kembali ke Dashboard</a>

        {{-- Tabel daftar tiket --}}
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Maskapai</th>
                    <th>Rute</th>
                    <th>Tanggal</th>
                    <th>Jam</th>
                    <th>Kelas</th>
                    <th>Harga</th>
                    <th>Kode</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tiket as $row)
                    <tr>
                        <td>{{ $row->id }}</td>
                        <td>{{ $row->maskapai }}</td>
                        <td>{{ $row->asal }} → {{ $row->tujuan }}</td>
                        <td>{{ $row->tanggal }}</td>
                        <td>{{ $row->jam_berangkat }} – {{ $row->jam_tiba }}</td>
                        <td>{{ $row->kelas }}</td>
                        <td>Rp {{ number_format($row->harga, 0, ',', '.') }}</td>
                        <td>{{ $row->kode_penerbangan }}</td>
                        <td>
                            {{-- Link Edit dan Hapus bisa diarahkan ke controller/route lain --}}
                            <a href="{{ url('/admin/tiket/'.$row->id.'/edit') }}"
                               class="btn btn-sm btn-warning">
                                Edit
                            </a>
                            <a href="{{ url('/admin/tiket/'.$row->id.'/delete') }}"
                               class="btn btn-sm btn-danger"
                               onclick="return confirm('Hapus tiket ini?')">
                                Hapus
                            </a>
                        </td>
                    </tr>
                @endforeach

                @if($tiket->isEmpty())
                    <tr>
                        <td colspan="9" class="text-center text-muted">Belum ada data tiket.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
