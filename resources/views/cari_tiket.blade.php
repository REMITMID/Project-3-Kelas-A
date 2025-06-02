<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Hasil Pencarian Tiket</title>

    {{-- Bootstrap CSS (sama versi 5.3.2) --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f4f7fd;
        }

        .result-header {
            background: linear-gradient(90deg, #0455c2 0%, #1765c6 100%);
            padding: 24px 0 30px 0;
            color: #fff;
        }

        .search-summary {
            background: #fff;
            border-radius: 14px;
            padding: 16px 24px;
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.05);
            margin-top: -40px;
        }

        .ticket-link {
            text-decoration: none;
            color: inherit;
            display: block;
        }

        .ticket-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 2px 12px rgba(60, 78, 120, 0.08);
            margin-bottom: 18px;
            padding: 20px 28px;
            display: flex;
            align-items: center;
            gap: 22px;
            cursor: pointer;
            transition: box-shadow 0.2s, transform 0.15s;
        }

        .ticket-card:hover {
            box-shadow: 0 8px 30px rgba(60, 78, 120, 0.17);
            transform: translateY(-2px) scale(1.012);
            border: 1.2px solid #1971d2;
        }

        .ticket-logo {
            width: 58px;
        }

        .ticket-info {
            flex: 1;
        }

        .ticket-maskapai {
            font-weight: 500;
            font-size: 1.08rem;
        }

        .ticket-meta {
            font-size: 0.97rem;
            color: #888;
        }

        .ticket-harga {
            font-size: 1.22rem;
            font-weight: bold;
            color: #0455c2;
            min-width: 160px;
            text-align: right;
        }

        .label-green {
            color: #12b886;
            font-size: 0.95rem;
        }

        @media (max-width: 700px) {
            .ticket-card {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .ticket-harga {
                text-align: left;
            }
        }
    </style>
</head>

<body>
    {{-- Bagian “Header Biru” (result-header) persis sama --}}
    <div class="result-header">
        <div class="container">
            <a href="{{ url('/') }}" class="navbar-brand d-flex align-items-center mb-3"
                style="color:#fff; text-decoration:none;">
                <img src="{{ asset('Gambar/logo.png') }}" alt="Logo" style="height:36px; margin-right:10px;">
                <span class="fw-bold">Brawijayan</span>
            </a>
            <h3 class="fw-semibold mt-1">Hasil Pencarian Tiket</h3>
        </div>
    </div>

    {{-- Kontainer utama untuk form + hasil --}}
    <div class="container">
        {{-- Form pencarian (mirip ‘<form action="cari_tiket.php" method="get">’ asli) --}}
        <form action="{{ route('cari.tiket') }}" method="get" class="row g-2 align-items-center py-3 px-3 mb-3"
            style="background:#fff; border-radius:16px; box-shadow:0 4px 16px rgba(0,0,0,0.04);">
            <div class="col-md-3 col-6 mb-2 mb-md-0">
                <label class="form-label mb-1" style="font-weight:500;">Dari</label>
                <select name="asal" class="form-select" required>
                    <option value="">Pilih Bandara Asal</option>
                    <option value="CGK" {{ $asal == 'CGK' ? 'selected' : '' }}>Jakarta (CGK)</option>
                    <option value="SUB" {{ $asal == 'SUB' ? 'selected' : '' }}>Surabaya (SUB)</option>
                    <option value="DPS" {{ $asal == 'DPS' ? 'selected' : '' }}>Bali (DPS)</option>
                    <option value="YOG" {{ $asal == 'YOG' ? 'selected' : '' }}>Yogyakarta (YOG)</option>
                    <option value="UPG" {{ $asal == 'UPG' ? 'selected' : '' }}>Makassar (UPG)</option>
                    <option value="LOP" {{ $asal == 'LOP' ? 'selected' : '' }}>Lombok (LOP)</option>
                    <option value="KNO" {{ $asal == 'KNO' ? 'selected' : '' }}>Medan (KNO)</option>
                    <option value="SIN" {{ $asal == 'SIN' ? 'selected' : '' }}>Singapura (SIN)</option>
                    <option value="KUL" {{ $asal == 'KUL' ? 'selected' : '' }}>Malaysia (KUL)</option>
                    <option value="HND" {{ $asal == 'HND' ? 'selected' : '' }}>Tokyo (HND)</option>
                    <option value="SYD" {{ $asal == 'SYD' ? 'selected' : '' }}>Sydney (SYD)</option>
                    <option value="SGN" {{ $asal == 'SGN' ? 'selected' : '' }}>Vietnam (SGN)</option>
                    <option value="BKK" {{ $asal == 'BKK' ? 'selected' : '' }}>Bangkok (BKK)</option>
                </select>
            </div>
            <div class="col-md-3 col-6 mb-2 mb-md-0">
                <label class="form-label mb-1" style="font-weight:500;">Ke</label>
                <select name="tujuan" class="form-select" required>
                    <option value="">Pilih Bandara Tujuan</option>
                    <option value="CGK" {{ $tujuan == 'CGK' ? 'selected' : '' }}>Jakarta (CGK)</option>
                    <option value="SUB" {{ $tujuan == 'SUB' ? 'selected' : '' }}>Surabaya (SUB)</option>
                    <option value="DPS" {{ $tujuan == 'DPS' ? 'selected' : '' }}>Bali (DPS)</option>
                    <option value="YOG" {{ $tujuan == 'YOG' ? 'selected' : '' }}>Yogyakarta (YOG)</option>
                    <option value="UPG" {{ $tujuan == 'UPG' ? 'selected' : '' }}>Makassar (UPG)</option>
                    <option value="LOP" {{ $tujuan == 'LOP' ? 'selected' : '' }}>Lombok (LOP)</option>
                    <option value="KNO" {{ $tujuan == 'KNO' ? 'selected' : '' }}>Medan (KNO)</option>
                    <option value="SIN" {{ $tujuan == 'SIN' ? 'selected' : '' }}>Singapura (SIN)</option>
                    <option value="KUL" {{ $tujuan == 'KUL' ? 'selected' : '' }}>Malaysia (KUL)</option>
                    <option value="HND" {{ $tujuan == 'HND' ? 'selected' : '' }}>Tokyo (HND)</option>
                    <option value="SYD" {{ $tujuan == 'SYD' ? 'selected' : '' }}>Sydney (SYD)</option>
                    <option value="SGN" {{ $tujuan == 'SGN' ? 'selected' : '' }}>Vietnam (SGN)</option>
                    <option value="BKK" {{ $tujuan == 'BKK' ? 'selected' : '' }}>Bangkok (BKK)</option>
                </select>
            </div>
            <div class="col-md-2 col-6 mb-2 mb-md-0">
                <label class="form-label mb-1" style="font-weight:500;">Tanggal</label>
                <input type="date" name="tanggal" class="form-control" required value="{{ $tanggal }}">
            </div>
            <div class="col-md-2 col-6 mb-2 mb-md-0">
                <label class="form-label mb-1" style="font-weight:500;">Kelas</label>
                <select name="kelas" class="form-select" required>
                    <option value="Ekonomi" {{ $kelas == 'Ekonomi' ? 'selected' : '' }}>Ekonomi</option>
                    <option value="Bisnis" {{ $kelas == 'Bisnis' ? 'selected' : '' }}>Bisnis</option>
                    <option value="First Class" {{ $kelas == 'First Class' ? 'selected' : '' }}>First Class</option>
                </select>
            </div>
            <div class="col-md-2 col-12 d-grid align-items-end">
                <label class="form-label mb-1 d-none d-md-block">&nbsp;</label>
                <button type="submit" class="btn btn-primary" style="height:40px;">Cari</button>
            </div>
        </form>

        {{-- Loop hasil query persis seperti PHP-asli --}}
        @if($penerbangan->count() > 0)
            @foreach($penerbangan as $row)
                <a href="{{ url('/booking?id=' . $row->id) }}" class="ticket-link">
                    <div class="ticket-card">
                        <div>
                            {{-- Nama file logo mengikuti pola: logo_<maskapai tanpa spasi lowercase>.png --}}
                            <img src="{{ asset('Gambar/logo_' . strtolower(str_replace(' ', '', $row->maskapai)) . '.png') }}"
                                 class="ticket-logo"
                                 alt="{{ $row->maskapai }}">
                        </div>
                        <div class="ticket-info">
                            <div class="ticket-maskapai">
                                {{ $row->maskapai }}
                                <span class="ticket-meta ms-2">{{ $row->kode_penerbangan }}</span>
                            </div>
                            <div class="ticket-meta mb-2">
                                {{ $row->asal }} <i class="bi bi-arrow-right"></i> {{ $row->tujuan }} | {{ $row->tipe_perjalanan }}
                            </div>
                            <div class="d-flex align-items-center gap-4">
                                <div>
                                    <div class="fw-bold" style="font-size:1.18rem;">
                                        {{ substr($row->jam_berangkat, 0, 5) }}
                                    </div>
                                    <div style="font-size:0.94rem">{{ $row->asal }}</div>
                                </div>
                                <div class="text-center" style="font-size:0.95rem;">
                                    {{ $row->durasi }}<br>
                                    {{ $row->transit > 0 ? $row->transit . ' transit' : 'Langsung' }}
                                </div>
                                <div>
                                    <div class="fw-bold" style="font-size:1.18rem;">
                                        {{ substr($row->jam_tiba, 0, 5) }}
                                    </div>
                                    <div style="font-size:0.94rem">{{ $row->tujuan }}</div>
                                </div>
                            </div>
                            <div class="mt-2 d-flex flex-wrap gap-3">
                                @if(strtolower($row->reschedule) == 'diperbolehkan')
                                    <span class="label-green">Reschedule diperbolehkan</span>
                                @else
                                    <span style="color:#888;font-size:0.94rem;">
                                        Reschedule &amp; refund tidak diperbolehkan
                                    </span>
                                @endif

                                @if(strtolower($row->refund) == 'diperbolehkan')
                                    <span class="label-green">Refund diperbolehkan</span>
                                @endif
                            </div>
                        </div>
                        <div class="ticket-harga">
                            RP {{ number_format($row->harga, 0, ',', '.') }}
                            <span style="font-size:0.98rem; font-weight:400;">/pax</span>
                        </div>
                    </div>
                </a>
            @endforeach
        @else
            <div class="alert alert-warning mt-4">
                Tidak ditemukan tiket untuk filter pencarian ini.
            </div>
        @endif
    </div>
</body>
</html>
