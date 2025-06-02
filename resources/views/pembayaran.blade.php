<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pembayaran - Brawijayan Travel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap CSS 5.3.2 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(110deg, #eaf2fb 50%, #fafdff 100%);
            min-height: 100vh;
        }
        .gradient-header {
            background: linear-gradient(90deg, #0455c2 0%, #1765c6 100%);
            padding: 22px 0 18px 0;
            color: #fff;
            box-shadow: 0 6px 28px 0 rgba(20,70,170,.07);
        }
        .main-container {
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: flex-start;
            margin-top: 42px;
            margin-bottom: 40px;
            gap: 38px;
        }
        .payment-left {
            width: 650px;
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 4px 24px rgba(30,80,180,0.09);
            padding: 44px 50px 38px 50px;
            display: flex;
            flex-direction: column;
            min-height: 540px;
        }
        .order-right {
            width: 340px;
            background: #f5f8fd;
            border-radius: 20px;
            box-shadow: 0 4px 22px rgba(30,60,140,0.08);
            padding: 32px 32px 30px 32px;
            min-height: 260px;
        }
        .countdown-box {
            background: #eaf4ff;
            border-radius: 13px;
            padding: 14px 25px;
            font-size: 1.12rem;
            font-weight: 600;
            color: #1d57ae;
            letter-spacing: .5px;
            margin-bottom: 26px;
            box-shadow:0 2px 8px rgba(30,100,190,0.04);
        }
        .timer {
            font-weight: bold;
            color: #ff3b43;
            font-size: 1.18rem;
            background: #fff;
            border-radius: 7px;
            padding: 3px 15px;
            margin-left: 16px;
            letter-spacing: 1.2px;
            border: 1.5px solid #b6d4ff;
        }
        .status-badge {
            display:inline-block;
            padding:7px 18px;
            border-radius:15px;
            font-size:15px;
            font-weight:700;
            margin-bottom:18px;
            margin-top:8px;
            color: #fff;
            letter-spacing:1px;
            box-shadow:0 2px 6px rgba(120,180,80,0.03);
        }
        .status-lunas { background:#16b575; }
        .status-belum { background:#ff5d63; }

        .bank-row {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            margin-top: 15px;
            gap: 14px;
        }
        .bank-row img {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 1px 6px rgba(10,60,200,0.07);
        }
        .rek-box {
            background: #f5f6fa;
            border-radius: 11px;
            padding: 15px 28px;
            font-size: 1.21rem;
            font-weight: 700;
            letter-spacing: 2px;
            margin-bottom: 22px;
            display: flex; 
            align-items: center; 
            justify-content: space-between;
        }
        .copy-btn {
            border: none;
            background: transparent;
            color: #1671d8;
            font-weight: 700;
            font-size: 1.25em;
            cursor: pointer;
            margin-left: 6px;
            border-radius: 6px;
            padding: 2px 6px;
            transition: background 0.17s;
        }
        .copy-btn:hover { background: #eaf1ff; }

        .totalpay-label {
            margin-top:20px;
            margin-bottom:8px;
            font-weight:600;
            color:#184aa5;
            font-size:1.05em;
        }
        .totalpay-box {
            background: linear-gradient(100deg,#d9e8ff 50%,#f0f6ff 100%);
            color:#1a3190;
            border-radius: 10px;
            padding: 16px 30px;
            font-size: 1.18rem;
            font-weight: 800;
            letter-spacing: 1px;
            margin-bottom: 28px;
            border: 1.7px solid #d3e1fa;
            box-shadow:0 2px 8px rgba(30,100,190,0.04);
        }
        .btns-bottom {
            width:100%;
            display:flex;
            justify-content: flex-end;
            align-items: center;
            gap: 16px;
            margin-top: 24px;
        }
        .btn-daftar {
            background:#217afe;
            border-radius:8px;
            color:#fff;
            font-weight:700;
            font-size:1.13rem;
            padding:13px 36px;
            border:none;
            box-shadow:0 1px 8px rgba(40,80,180,0.11);
            transition:background 0.15s;
        }
        .btn-daftar:hover { background:#0c5fc7; }

        .btn-sudah-bayar {
            background: #e6e6e6;
            color: #606060;
            font-weight:700;
            border-radius: 9px;
            border: none;
            font-size: 1.09em;
            padding: 10px 35px;
            box-shadow:0 2px 8px rgba(20,80,80,0.06);
            transition: background 0.14s, color 0.14s;
        }
        .btn-sudah-bayar:hover {
            background: #217afe;
            color: #fff;
        }

        .order-label {
            font-size:0.98rem;
            color:#767b88;
            margin-bottom: 3px;
        }
        .flight-info {
            display: flex;
            align-items: center;
            background: #fff;
            border-radius: 10px;
            padding: 12px 17px 12px 10px;
            margin-bottom: 9px;
            margin-top: 6px;
            gap: 10px;
            box-shadow:0 2px 9px rgba(30,80,190,0.03);
        }
        .flight-info img {
            width: 28px;
            height: 28px;
            margin-right: 8px;
        }
        .flight-airport {
            font-weight:600;
            color:#1a2b50;
        }
        .flight-time {
            font-size: 0.97rem;
            color: #757f9a;
        }
        .order-id-box {
            font-size:1.08rem;
            color:#1c2537;
            font-weight:800;
            letter-spacing:1px;
            margin-bottom: 14px;
        }

        @media (max-width: 1100px) {
            .main-container {
                flex-direction: column;
                align-items: stretch;
                gap: 30px;
            }
            .payment-left, .order-right {
                width:100%;
                margin:0 0 28px 0;
            }
            .order-right { min-height: unset; }
        }
        @media (max-width: 650px) {
            .payment-left {
                padding:20px 7vw 18px 7vw;
            }
            .order-right {
                padding: 20px 6vw 18px 6vw;
            }
        }

        /* Modal konfirmasi */
        .modal-confirm .modal-content {
            border-radius: 12px;
            border: none;
        }
        .modal-confirm .modal-header {
            border-bottom: none;
        }
        .modal-confirm .modal-footer {
            border-top: none;
        }
        .modal-confirm .btn-cancel {
            background: #e6e8ea;
            color: #222;
            border-radius: 8px;
            padding: 8px 22px;
            font-weight: 600;
            margin-right: 12px;
            border: none;
        }
        .modal-confirm .btn-ok {
            background: #21b876;
            color: #fff;
            border-radius: 8px;
            padding: 8px 22px;
            font-weight: 600;
            border: none;
        }
        .modal-confirm .btn-ok:hover {
            background: #13995b;
        }
        .modal-confirm .btn-cancel:hover {
            background: #d9dadb;
        }
    </style>
</head>
<body>
    {{-- Header Biru --}}
    <div class="gradient-header">
        <div class="container d-flex align-items-center py-1">
            <img src="{{ asset('Gambar/logo.png') }}" alt="Logo" style="height:36px; margin-right:10px;">
            <span class="fw-bold fs-4">Brawijayan</span>
        </div>
    </div>

    <div class="main-container">
        {{-- KIRI: Box Pembayaran --}}
        <div class="payment-left d-flex flex-column">
            {{-- Flash message sukses --}}
            @if(session('success'))
                <div class="alert alert-success my-3">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Hitung dan tampilkan countdown jika belum lunas --}}
            @unless($isLunas)
                <div class="countdown-box mb-3" id="countdown-section">
                    <span>Selesaikan pembayaran dalam</span>
                    <span id="timer" class="timer"></span>
                </div>
            @endunless

            <div class="mb-2" style="color:#2760ab;font-size:15px;">
                <img src="https://img.icons8.com/color/24/000000/info--v1.png"
                     style="margin-right:7px;">
                Setelah pembayaran diverifikasi, e-ticket dan bukti pembayaran akan dikirim ke email terdaftar.
            </div>

            <div class="status-badge {{ $isLunas ? 'status-lunas' : 'status-belum' }}">
                {{ $isLunas ? 'LUNAS' : 'BELUM DIBAYAR' }}
            </div>

            <h5 class="fw-bold mb-3 mt-4">Instruksi Pembayaran</h5>

            {{-- Baris Rekening --}}
            <div class="bank-row">
                <img src="{{ asset('Gambar/UBpay.png') }}" alt="UBPay" style="height:32px;">
                <span class="fw-semibold fs-6">UB Pay</span>
                <div class="rek-box flex-grow-1 ms-2" style="margin-bottom:0;">
                    <span id="rekening">{{ $rekening }}</span>
                    <button class="copy-btn" onclick="copyRekening()" title="Salin">
                        <img src="https://img.icons8.com/ios/21/1671d8/copy--v1.png"/>
                    </button>
                </div>
            </div>

            {{-- Total Pembayaran --}}
            <div class="totalpay-label">Total Pembayaran</div>
            <div class="totalpay-box">
                IDR {{ number_format($totalHarga, 0, ',', '.') }}
            </div>

            {{-- Tombol “Sudah Bayar” + “Lihat daftar pesanan” --}}
            <div class="btns-bottom">
                @unless($isLunas)
                    <button type="button" class="btn-sudah-bayar" onclick="showConfirmModal()">Sudah Bayar</button>

                    {{-- Form tersembunyi untuk konfirmasi --}}
                    <form id="formSudahBayar" action="{{ route('pembayaran.confirm') }}" method="POST" style="display:none;">
                        @csrf
                    </form>
                @endunless

                <a href="{{ url('/riwayat_eticket') }}" class="btn-daftar">Lihat daftar pesanan</a>
            </div>
        </div>

        {{-- KANAN: Box Order Info --}}
        <div class="order-right">
            <div class="order-label">Order ID:</div>
            <div class="order-id-box">{{ $orderId }}</div>

            <div class="flight-info mb-2">
                <img src="https://img.icons8.com/fluency/28/airplane-take-off.png" alt="flight" class="me-2">
                <div>
                    <div class="flight-airport">{{ $asal }} &rarr; {{ $tujuan }}</div>
                    <div class="flight-time">{{ $tanggalIndo }} &nbsp; • &nbsp; {{ substr($jamBerangkat, 0, 5) }}</div>
                </div>
            </div>

            <div class="flight-info mb-2">
                <b>{{ $maskapai }}</b> | <span>{{ $kelas }}</span>
            </div>
        </div>
    </div>

    {{-- Modal Konfirmasi Pembayaran --}}
    <div class="modal fade modal-confirm" id="modalConfirmBayar" tabindex="-1"
         aria-labelledby="modalKonfirmasiLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header border-0">
            <h5 class="modal-title" id="modalKonfirmasiLabel">Konfirmasi Pembayaran</h5>
          </div>
          <div class="modal-body">
            Apakah Anda sudah membayar pesanan ini?
          </div>
          <div class="modal-footer border-0">
            <button type="button" class="btn-cancel" data-bs-dismiss="modal">Batalkan</button>
            <button type="button" class="btn-ok" onclick="submitSudahBayar()">Konfirmasi</button>
          </div>
        </div>
      </div>
    </div>

    {{-- Bootstrap JS Bundle --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Status Lunas
        let isLunas = {{ $isLunas ? 'true' : 'false' }};

        // Timer countdown: deadlineTs (dari controller) dalam detik
        let deadlineMs = {{ $deadlineTs }} * 1000;

        function updateTimer(){
            if (isLunas) {
                let countdownSection = document.getElementById('countdown-section');
                if (countdownSection) countdownSection.style.display = 'none';
                return;
            }
            let now = new Date().getTime();
            let dist = deadlineMs - now;
            if (dist < 0) dist = 0;

            let h = Math.floor(dist / (1000*60*60));
            let m = Math.floor((dist % (1000*60*60)) / (1000*60));
            let s = Math.floor((dist % (1000*60)) / 1000);

            document.getElementById('timer').innerText =
                (h < 10 ? '0'+h : h) + ' : ' +
                (m < 10 ? '0'+m : m) + ' : ' +
                (s < 10 ? '0'+s : s);

            if (dist > 0) {
                setTimeout(updateTimer, 1000);
            }
        }

        updateTimer();

        // Salin nomor rekening ke clipboard
        function copyRekening() {
            let rek = document.getElementById('rekening').innerText;
            navigator.clipboard.writeText(rek).then(function(){
                alert('Nomor rekening berhasil disalin!');
            });
        }

        // Tampilkan modal “Sudah Bayar?”
        function showConfirmModal() {
            let modal = new bootstrap.Modal(document.getElementById('modalConfirmBayar'));
            modal.show();
        }

        // Submit form konfirmasi
        function submitSudahBayar() {
            document.getElementById('formSudahBayar').submit();
        }
    </script>
</body>
</html>
