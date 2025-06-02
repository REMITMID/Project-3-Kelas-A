<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Admin - Brawijayan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .result-header {
            background: linear-gradient(90deg, #0455c2 0%, #1765c6 100%);
            padding: 24px 0 30px 0;
            color: #fff;
        }
    </style>
</head>

<body class="bg-light">
    <div class="result-header">
        <div class="container d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <img src="/Gambar/logo.png" alt="Logo" style="height:36px; margin-right:10px;">
                <span class="fw-bold fs-4">Brawijayan</span>
            </div>
            <div class="dropdown">
                <button class="btn btn-light btn-sm dropdown-toggle mt-2" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="Profile"
                        style="height:20px; width:20px;">
                    {{ $nama }}
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <form method="POST" action="{{ route('logout') }}" style="margin:0; padding:0;">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger"
                            style="background: none; border: none; padding: 8px 16px; width: 100%; text-align: left; display: block;">
                            Logout
                        </button>
                    </form>
                </ul>
            </div>
        </div>
        <div class="container">
            <h3 class="fw-semibold mt-2">Admin Dashboard</h3>
        </div>
    </div>
    <div class="container mt-4">
        <p>Total Tiket: <strong>{{ $totalTiket }}</strong></p>
        <a href="{{ route('admin.tiket.create') }}" class="btn btn-success mb-2">Tambah Tiket Baru</a>

        <a href="{{ route('tickets.index') }}" class="btn btn-primary mb-2">Kelola Semua Tiket</a>
        <a href="{{ route('user.index') }}" class="btn btn-outline-primary mb-2">Kelola Pengguna</a>
        <a href="{{ route('orders.index') }}" class="btn btn-outline-info mb-2">Riwayat Pesanan</a>
        <a href="{{ url('/') }}" class="btn btn-secondary mb-2">Kembali ke Beranda</a>
    </div>
</body>

</html>