<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Pesanan - Brawijayan Travel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f6f9ff;}
        .gradient-header { background: linear-gradient(90deg, #0455c2 0%, #1765c6 100%); padding: 22px 0 18px 0; color: #fff; }
        .main-container { max-width: 950px; margin: 36px auto 0 auto;}
        .riwayat-card {
            background:#fff; border-radius:16px; box-shadow:0 1px 8px rgba(50,70,120,0.09);
            padding:28px 28px 19px 28px; margin-bottom: 25px; position:relative;
        }
        .status-badge {
            padding:5px 16px; border-radius:13px; font-size:14px; font-weight:600; position:absolute; right:28px; top:27px;
        }
        .status-lunas { background:#17a551; color:#fff;}
        .status-belum { background:#dc3545; color:#fff;}
        .btn-detail {
            background:#1477ff; color:#fff; font-weight:600; border-radius:8px; padding:7px 28px; font-size:1.06em; border:none; margin-top:6px;
        }
        .btn-detail:hover { background:#0c5fc7;}
        .logo-app {height:36px; margin-right:11px;}
        .fw-brand {font-weight:bold; font-size:1.23em;}
        .flight-title { font-size:1.15em; font-weight:600; color:#194086;}
        .flight-info { font-size:1.08em; color:#32343d;}
        .order-id-label { color:#888;font-size:0.98em;}
        /* MODAL */
        .modal-content {
            border-radius: 23px;
            padding: 0;
        }
        .modal-body {
            padding: 35px 32px 25px 32px;
            border-radius: 22px;
            background: #fafdff;
        }
        .modal-header { border-bottom: none; }
        .qr-box {
            display: flex; align-items: center; justify-content: center;
        }
        .kode-pemesanan-box {
            background: #2967ff; color:#fff; font-weight:700;
            padding:9px 23px; border-radius:9px; display: inline-block; font-size:1.18em;
            margin-bottom: 18px;
        }
        .table-penumpang th, .table-penumpang td {
            vertical-align: middle !important;
        }
        .table-penumpang th { background: #eaf0fa; font-size:1.07em;}
        .table-penumpang td { background: #fff; }
        .icon-menuju {
            font-size: 1.6em; color: #888; margin: 0 6px;
            vertical-align: middle; display: inline-block;
        }
        .date-pesan {
            float:right; font-size:1.04em; color:#b2bad6; font-weight:500; margin-top: 5px;
        }
        @media (max-width: 600px) {
            .modal-body { padding: 22px 6px; }
        }
    </style>
</head>
<body>
    <div class="gradient-header">
        <div class="container d-flex align-items-center py-1">
            <a href="{{ url('/') }}" class="d-flex align-items-center text-decoration-none text-white">
                <img src="{{ asset('Gambar/logo.png') }}" alt="Logo" class="logo-app">
                <span class="fw-brand">Brawijayan</span>
            </a>
        </div>
    </div>

    <div class="main-container">
        <h3 class="mb-4 fw-bold">Riwayat Pesanan Tiket</h3>

        @if(count($daftar) === 0)
            <div class="alert alert-info">Belum ada pesanan.</div>
        @endif

        @foreach($daftar as $r)
            @php
                // Pastikan key “tiket” selalu array (bila null, jadikan array kosong)
                $tiket = $r['tiket'] ?? null;
                $penumpang = $r['penumpang'] ?? [];
            @endphp

            <div class="riwayat-card">
                <div class="order-id-label">Order ID: <b>{{ $r['order_id'] }}</b></div>
                <div class="flight-title mt-1 mb-2">
                    {{ $tiket['maskapai'] ?? '-' }} &bull; {{ $tiket['kelas'] ?? '-' }}
                </div>
                <div class="flight-info mb-1">
                    {{ $tiket['asal'] ?? '-' }} &rarr; {{ $tiket['tujuan'] ?? '-' }} |
                    @if(!empty($tiket['tanggal']))
                        {{ \Carbon\Carbon::parse($tiket['tanggal'])->format('D, d M Y') }}
                    @else
                        -
                    @endif
                    |
                    @if(!empty($tiket['jam_berangkat']))
                        {{ \Illuminate\Support\Str::substr($tiket['jam_berangkat'], 0, 5) }} WIB
                    @else
                        -
                    @endif
                </div>
                <div style="font-weight:600; color:#1671d8; margin-bottom:6px;">
                    Rp {{ number_format($r['total_harga'], 0, ',', '.') }}
                </div>
                <span class="status-badge {{ strtolower($r['status'])=='lunas' ? 'status-lunas' : 'status-belum' }}">
                    {{ strtoupper($r['status']) }}
                </span>

                @if(strtolower($r['status']) === 'lunas')
                    <button
                        class="btn-detail mt-2"
                        onclick='showDetailRiwayat(
                            @json($r),
                            @json($tiket)
                        )'
                    >
                        Lihat Detail
                    </button>
                @else
                    <a class="btn-detail" href="{{ route('pembayaran') }}">Lihat Detail</a>
                @endif
            </div>
        @endforeach
    </div>

    <!-- MODAL Detail Riwayat -->
    <div class="modal fade" id="modalDetailRiwayat" tabindex="-1" aria-labelledby="modalDetailLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-body" id="modalDetailContent"></div>
          <button type="button" class="btn-close position-absolute" style="top:24px; right:28px; z-index:10;" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function bandaraInfo(nama) {
            const map = {
                'Jakarta': 'Soekarno-Hatta International Airport',
                'Denpasar': 'I Gusti Ngurah Rai International Airport',
                'Surabaya': 'Juanda International Airport',
                'Makassar': 'Sultan Hasanuddin Airport',
                'Yogyakarta': 'Yogyakarta International Airport',
                'Medan': 'Kualanamu International Airport',
                'Lombok': 'Lombok International Airport'
            };
            return map[nama] || nama;
        }

        function showDetailRiwayat(data, tiket) {
            let jamBerangkat = (tiket?.jam_berangkat || data.jam_berangkat || '').substring(0,5) || '-';
            let jamTiba      = (tiket?.jam_tiba      || data.jam_tiba      || '').substring(0,5) || '-';
            let asal         = tiket?.asal || data.asal || '-';
            let tujuan       = tiket?.tujuan || data.tujuan || '-';
            let bandaraAsal  = tiket?.bandara_asal  || asal;
            let bandaraTujuan= tiket?.bandara_tujuan|| tujuan;
            let kodePenerbangan = tiket?.kode_penerbangan || data.kode_penerbangan || '-';
            let durasi       = tiket?.durasi || data.durasi || '-';
            let tanggal      = tiket?.tanggal || data.tanggal || '';
            let tglIndo      = tanggal ? new Date(tanggal) : null;

            const bulan = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
            let tglPesan = '-';
            if (tglIndo) {
                tglPesan = `${tglIndo.getDate()} ${bulan[tglIndo.getMonth()]} ${tglIndo.getFullYear()}`;
            }

            let logo = '{{ asset("Gambar") }}/logo_' + ( (tiket?.maskapai || data.maskapai).toLowerCase().replace(/ /g,'') ) + '.png';
            let qr   = 'https://upload.wikimedia.org/wikipedia/commons/d/d0/QR_code_for_mobile_English_Wikipedia.svg';

            // Cek apakah ada vaksin per penumpang
            let adaVaksin = false;
            if (Array.isArray(data.penumpang)) {
                data.penumpang.forEach(p => {
                    if (p.vaksin || p.vaksin_url) adaVaksin = true;
                });
            }

            let penumpangRows = '';
            if (Array.isArray(data.penumpang) && data.penumpang.length > 0) {
                data.penumpang.forEach(function(p, i){
                    let namaLengkap = p.fullname || p.nama || '-';
                    let nik = p.nik || '-';
                    let vaksin = p.vaksin || p.vaksin_url || '';
                    let vaksinHTML = vaksin 
                        ? `<img src="${vaksin}" alt="Sertifikat Vaksin" style="max-width:68px;max-height:54px;border-radius:7px;border:1px solid #e2e2e2;">`
                        : '-';

                    penumpangRows += `
                        <tr>
                            <td style="text-align:center; font-weight:700;">${String(i+1).padStart(2,'0')}</td>
                            <td>${(p.title || '') + ' ' + namaLengkap}</td>
                            <td>${nik}</td>
                            ${vaksin ? `<td>${vaksinHTML}</td>` : ''}
                        </tr>`;
                });
            } else {
                penumpangRows = `<tr><td colspan="${adaVaksin ? 4 : 3}" class="text-center text-muted">
                                   Data penumpang tidak tersedia.
                                </td></tr>`;
            }

            document.getElementById('modalDetailContent').innerHTML = `
                <div>
                    <div style="font-size:2rem; font-weight:700; margin-bottom:13px;">Detail Riwayat</div>
                    <div>
                        <span class="kode-pemesanan-box">Kode Pemesanan: ${data.order_id}</span>
                        <span class="date-pesan">${tglPesan}</span>
                    </div>
                    <hr class="my-3">
                    <div class="row g-2 mb-2 align-items-center" style="background:#f9fbff; border-radius:20px; padding:18px 0;">
                        <div class="col-lg-2 col-3 text-center d-flex flex-column justify-content-center align-items-center">
                            <img src="${logo}" alt="Logo Maskapai" style="width:56px; border-radius:9px;">
                            <div class="mt-2" style="font-size:1.08em;font-weight:600;">${tiket?.maskapai || data.maskapai}</div>
                            <div style="font-size:0.97em; color:#a0a6bc;">${tiket?.kelas || data.kelas}</div>
                        </div>
                        <div class="col-lg-8 col-9">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="text-center flex-fill" style="min-width:120px;">
                                    <div style="font-size:2.6em;font-weight:800;color:#2b3564;line-height:1">${jamBerangkat}</div>
                                    <div style="font-size:1.35em;font-weight:700;color:#2177e9;">${asal}</div>
                                    <div style="font-size:0.99em;color:#98a4c1;">${bandaraAsal}</div>
                                </div>
                                <div class="text-center flex-fill">
                                    <div style="font-size:2.1em;color:#b1c6e3;font-weight:700;letter-spacing:1px;">────→────</div>
                                    <div style="font-size:1.09em; color:#96a3bb; margin:4px 0 1px 0;">${durasi}</div>
                                </div>
                                <div class="text-center flex-fill" style="min-width:120px;">
                                    <div style="font-size:2.6em;font-weight:800;color:#2b3564;line-height:1">${jamTiba}</div>
                                    <div style="font-size:1.35em;font-weight:700;color:#2177e9;">${tujuan}</div>
                                    <div style="font-size:0.99em;color:#98a4c1;">${bandaraTujuan}</div>
                                </div>
                                <div class="text-center flex-fill" style="min-width:86px;">
                                    <img src="${qr}" alt="QR Code" style="width:68px; border-radius:6px;">
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-2">
                                <div style="font-size:1.1em; color:#7888ab;">Flight No. <b>${kodePenerbangan}</b></div>
                                <div style="font-size:1.1em; color:#9ba3be;">${tglPesan}</div>
                            </div>
                        </div>
                    </div>
                    <div style="font-size:1.24em;font-weight:700; margin-bottom:9px; margin-top:17px;">Penumpang</div>
                    <div class="table-responsive">
                        <table class="table table-penumpang">
                            <thead>
                                <tr>
                                    <th style="width:55px;">No.</th>
                                    <th>Nama</th>
                                    <th>NIK</th>
                                    ${adaVaksin ? '<th>Sertifikat Vaksin</th>' : ''}
                                </tr>
                            </thead>
                            <tbody>
                                ${penumpangRows}
                            </tbody>
                        </table>
                    </div>
                </div>
            `;
            new bootstrap.Modal(document.getElementById('modalDetailRiwayat')).show();
        }
    </script>
</body>
</html>
