<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Konfirmasi Pembelian Tiket</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap CSS (sama versi 5.3.2) --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { background: #f4fbff; }

        .gradient-header {
            background: linear-gradient(90deg, #0455c2 0%, #1765c6 100%);
            padding: 32px 0 48px 0;
            color: #fff;
        }

        /* CARD INFO TIKET */
        .flight-info-box {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 2px 16px rgba(40, 60, 120, 0.10);
            padding: 28px 36px 26px 36px;
            margin: 0 auto 34px auto;
            max-width: 900px;
        }
        .flight-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0px;
        }
        .flight-logo {
            width: 60px; height: 60px; border-radius: 50%; object-fit: contain;
            border: 2.5px solid #e3e8f0;
            background: #fff;
        }
        .flight-segment {
            flex: 1;
            text-align: center;
        }
        .flight-segment .time {
            font-size: 2.25rem;
            font-weight: 800;
            color: #222d49;
        }
        .flight-segment .city {
            font-size: 1.16rem;
            font-weight: 600;
            color: #2366c6;
        }
        .flight-segment .airport {
            font-size: 1em;
            color: #77829c;
        }
        .flight-middle {
            min-width: 105px;
            text-align: center;
            font-size: 1.08em;
            color: #858fa8;
        }
        .flight-middle .duration {
            font-size: 1.13em;
            font-weight: 500;
        }
        .flight-middle .direct {
            color: #34b188;
            font-size: 0.96em;
            font-weight: 600;
        }
        .flight-no-date {
            margin-top: 10px;
            font-size: 1.07em;
            color: #697a9e;
        }

        /* GRID FORM LAYOUT */
        .booking-grid {
            display: grid;
            grid-template-columns: 1.1fr 1fr;
            gap: 32px;
            max-width: 900px;
            margin: 0 auto 24px auto;
        }
        @media (max-width: 991px) {
            .booking-grid { grid-template-columns: 1fr; gap:18px;}
            .flight-info-box { padding:18px 10px 17px 10px; }
        }

        /* CARD REUSABLE */
        .section-card {
            border-radius: 16px;
            box-shadow: 0 2px 12px rgba(60,78,120,0.08);
            background: #fff;
            padding: 20px 28px 22px 28px;
            margin-bottom: 0;
        }
        .section-title {
            font-weight: 700;
            font-size: 1.16em;
            margin-bottom: 17px;
            color: #1a2968;
        }

        /* BAGASI */
        .bagasi-card {
            border: 1.5px solid #e9ecf3;
            background: #fafdff;
            padding-top: 19px;
            margin-bottom: 0;
        }

        /* PENUMPANG */
        .penumpang-card {
            background: #f6f8fc;
            border-radius: 10px;
            padding: 10px 16px;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 1px 6px rgba(40,80,180,0.07);
        }
        .penumpang-card .action-btn {
            margin-left: 8px;
            font-size: 18px;
            color: #676fd4;
            background: none;
            border: none;
            cursor: pointer;
        }
        .penumpang-card .action-btn.delete { color: #e74c3c; }
        .btn-add-penumpang {
            background: #fff;
            color: #0455c2;
            border-radius: 8px;
            font-weight: 600;
            border: 1.2px solid #0455c2;
        }
        .btn-add-penumpang:hover { background: #1971d2; color: #fff; }

        /* TOTAL */
        .total-box {
            border-radius: 16px;
            box-shadow: 0 2px 12px rgba(60,78,120,0.11);
            background: #fff;
            padding: 26px 38px 20px 38px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 42px auto 26px auto;
            max-width: 900px;
        }
        @media (max-width: 900px) {
            .total-box { flex-direction: column; gap:14px; padding:20px 10px 18px 10px;}
            .booking-grid { padding: 0 4vw; }
        }
        .btn-next {
            background: #513fff;
            color: #fff;
            font-weight: 600;
            border-radius: 12px;
            font-size: 1.13rem;
            padding: 11px 38px;
            min-width: 210px;
            box-shadow: 0 2px 11px rgba(70,60,200,0.09);
            transition: background .16s;
        }
        .btn-next:hover {
            background: #3d30b7;
            color: #fff;
        }
        .modal-title { font-weight:600; }
    </style>
</head>
<body>
    {{-- Header biru --}}
    <div class="gradient-header mb-4">
        <div class="container">
            <div class="d-flex align-items-center mb-2">
                <img src="{{ asset('Gambar/logo.png') }}" alt="Logo" style="height:44px; margin-right:13px;">
                <span class="fw-bold fs-3">Brawijayan</span>
            </div>
            <h2 class="fw-bold mt-3">Konfirmasi Pembelian Tiket</h2>
        </div>
    </div>

    {{-- INFORMASI PENERBANGAN --}}
    <div class="flight-info-box mb-4">
        <div class="flight-row">
            {{-- Logo & Nama Maskapai --}}
            <div>
                <img src="{{ asset('Gambar/logo_' . Str::lower(str_replace(' ', '', $tiket->maskapai)) . '.png') }}"
                     class="flight-logo"
                     alt="{{ $tiket->maskapai }}">
                <div class="mt-2 fw-bold">{{ $tiket->maskapai }}</div>
                <div class="text-secondary small mt-1">{{ $tiket->kelas }}</div>
            </div>

            {{-- Segment Keberangkatan --}}
            <div class="flight-segment">
                <div class="time">{{ substr($tiket->jam_berangkat, 0, 5) }}</div>
                <div class="city">{{ $tiket->asal }}</div>
                <div class="airport">{{ $tiket->bandara_asal ?? 'Bandara Asal' }}</div>
            </div>

            {{-- Tengah: Icon + Durasi + Transit --}}
            <div class="flight-middle">
                <div class="duration">{{ $tiket->durasi }}</div>
                <div>
                    <svg width="34" height="14" style="margin:0 1px -2px 0;" fill="#bad3ff" viewBox="0 0 34 14">
                        <path d="M3 7h28m0 0l-3-3m3 3l-3 3" stroke="#4592ea" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <div class="direct">
                    {{ $tiket->transit ? $tiket->transit . ' transit' : 'Langsung' }}
                </div>
            </div>

            {{-- Segment Kedatangan --}}
            <div class="flight-segment">
                <div class="time">{{ substr($tiket->jam_tiba, 0, 5) }}</div>
                <div class="city">{{ $tiket->tujuan }}</div>
                <div class="airport">{{ $tiket->bandara_tujuan ?? 'Bandara Tujuan' }}</div>
            </div>

            {{-- Flight Number & Tanggal --}}
            <div>
                <div class="flight-no-date">
                    <div class="fw-bold mb-1">Flight No. {{ $tiket->kode_penerbangan }}</div>
                    <div>{{ \Illuminate\Support\Carbon::parse($tiket->tanggal)->format('d M Y') }}</div>
                </div>
            </div>
        </div>
    </div>

    {{-- GRID: Detail Penumpang & Bagasi --}}
    <div class="booking-grid mb-4">
        {{-- Kolom 1: Detail Penumpang --}}
        <div>
            <div class="section-card h-100 d-flex flex-column">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="section-title mb-0">Detail Penumpang</div>
                    <button class="btn btn-add-penumpang btn-sm" type="button" onclick="showPassengerModal()">+ Tambah Penumpang</button>
                </div>
                <div id="passenger-list" style="max-height: 170px; overflow-y:auto; flex:1 1 auto;">
                    {{-- Daftar penumpang akan di‐inject lewat JavaScript --}}
                </div>
            </div>
        </div>

        {{-- Kolom 2: Pilihan Bagasi --}}
        <div>
            <div class="section-card bagasi-card h-100">
                <div class="section-title mb-2">Pelengkap</div>
                <div class="mb-2"><b>Bagasi</b></div>
                <div class="mb-1" style="color:#888;font-size:0.97rem;">
                    Bawa bagasi hingga 20kg per orang.<br>
                    Tambah bagasi RP {{ number_format($hargaBagasi, 0, ',', '.') }} / orang.
                </div>
                <div>
                    <select class="form-select" id="bagasiSelect" onchange="updateTotalHarga()">
                        <option value="0">Tidak tambah bagasi</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    {{-- FORM SUBMIT KE PEMBAYARAN --}}
    <form id="bookingForm" action="{{ route('booking.store') }}" method="POST">
        @csrf
        <input type="hidden" name="id_tiket" value="{{ $tiket->id }}">
        <input type="hidden" name="maskapai" value="{{ $tiket->maskapai }}">
        <input type="hidden" name="asal" value="{{ $tiket->asal }}">
        <input type="hidden" name="tujuan" value="{{ $tiket->tujuan }}">
        <input type="hidden" name="kode_penerbangan" value="{{ $tiket->kode_penerbangan }}">
        <input type="hidden" name="jam_berangkat" value="{{ $tiket->jam_berangkat }}">
        <input type="hidden" name="jam_tiba" value="{{ $tiket->jam_tiba }}">
        <input type="hidden" name="tanggal" value="{{ $tiket->tanggal }}">
        <input type="hidden" name="kelas" value="{{ $tiket->kelas }}">
        <input type="hidden" name="harga_perorang" id="inputHargaPerOrang">
        <input type="hidden" name="harga_bagasi" id="inputHargaBagasi">
        <input type="hidden" name="jumlah_bagasi" id="inputJmlBagasi">
        <input type="hidden" name="total_harga" id="inputTotalHarga">
        <input type="hidden" name="penumpang_json" id="inputPenumpangJson">

        <div class="total-box mb-5">
            <div>
                <div class="mb-2" style="color:#888;" id="total-orang-txt">
                    Harga total untuk 0 orang
                </div>
                <div class="fw-bold fs-4" style="color:#1477ff;" id="total-harga-txt">
                    RP 0
                </div>
            </div>
            <button type="button" class="btn btn-next" onclick="submitBooking()">Lanjut ke Pembayaran</button>
        </div>
    </form>

    {{-- MODAL ADD/EDIT PENUMPANG --}}
    <div class="modal fade" id="passengerModal" tabindex="-1">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <form id="passengerForm" autocomplete="off">
            <div class="modal-header">
              <h5 class="modal-title">Passenger Details</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <input type="hidden" name="editIndex" id="editIndex">
              <div class="mb-3">
                <label class="form-label d-block mb-1">Title</label>
                <div>
                  <label class="me-2">
                    <input type="radio" name="title" value="Tuan " required> Tuan 
                  </label>
                  <label class="me-2">
                    <input type="radio" name="title" value="Nyonya "> Nyonya 
                  </label>
                  <label class="me-2">
                    <input type="radio" name="title" value="Nona "> Nona 
                  </label>
                </div>
              </div>
              <div class="mb-2">
                <input type="text" name="fullname" class="form-control" placeholder="Full Name" required>
              </div>
              <div class="mb-2">
                <input type="text" name="nik" class="form-control" placeholder="Nomor Induk Kependudukan" required>
              </div>
              <div class="mb-2">
                <input type="text" name="phone" class="form-control" placeholder="Phone Number" value="+62" required>
              </div>
              <div class="mb-2">
                <label class="form-label">Upload Sertifikat Vaksin</label>
                <input type="file" name="vaksin" class="form-control" accept="image/*" id="inputVaksin">
                <div id="previewVaksin" style="margin-top:6px;"></div>
                <button type="button" class="btn btn-sm btn-secondary mt-2" id="resetVaksin" style="display:none;">
                  Hapus Sertifikat
                </button>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    {{-- Bootstrap JS Bundle --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Data penumpang akan disimpan di array ini (mirip di PHP-asli: ke $_SESSION)
        let passengerData = [];
        let hargaPerOrang = {{ $hargaPerOrang }};
        let hargaBagasi   = {{ $hargaBagasi }};

        function showPassengerModal(editIdx = null) {
            const form = document.getElementById('passengerForm');
            form.reset();
            document.getElementById('editIndex').value = '';
            document.getElementById('previewVaksin').innerHTML = '';
            document.getElementById('resetVaksin').style.display = 'none';
            document.getElementById('inputVaksin').value = '';

            if (editIdx !== null) {
                let p = passengerData[editIdx];
                form.title.value    = p.title;
                form.fullname.value = p.fullname;
                form.nik.value      = p.nik;
                form.phone.value    = p.phone;
                document.getElementById('editIndex').value = editIdx;
                // Tampilkan preview vaksin jika ada
                if (p.vaksin) {
                    document.getElementById('previewVaksin').innerHTML =
                        `<img src="${p.vaksin}" alt="Sertifikat" style="max-width:100px;max-height:70px;border-radius:6px;border:1px solid #d5d5d5;">`;
                    document.getElementById('resetVaksin').style.display = 'inline-block';
                }
            }

            let modal = new bootstrap.Modal(document.getElementById('passengerModal'));
            modal.show();
        }

        document.getElementById('passengerForm').onsubmit = function(e) {
            e.preventDefault();
            const form = e.target;
            let editIdx = form.editIndex.value;
            let data = {
                title:    form.title.value,
                fullname: form.fullname.value,
                nik:      form.nik.value,
                phone:    form.phone.value
            };

            // --- Penanganan Sertifikat Vaksin (mirip PHP-asli) ---
            let fileInput = form.vaksin;
            // Jika edit dan belum mengganti file, tetap pertahankan vaksin lama
            if (editIdx !== '') {
                data.vaksin = passengerData[editIdx]?.vaksin ?? null;
            } else {
                data.vaksin = null;
            }

            // Jika tombol “Hapus Sertifikat” ditekan (data-clear="1"), kosongkan vaksin
            if (fileInput.getAttribute('data-clear') === '1') {
                data.vaksin = null;
                fileInput.removeAttribute('data-clear');
                savePassengerData(data, editIdx);
                return false;
            }

            // Jika meng‐upload file baru
            if (fileInput && fileInput.files.length > 0) {
                let file = fileInput.files[0];
                let reader = new FileReader();
                reader.onload = function(ev) {
                    data.vaksin = ev.target.result; // base64 string
                    savePassengerData(data, editIdx);
                }
                reader.readAsDataURL(file);
                return false; // tunggu async
            } else {
                savePassengerData(data, editIdx);
                return false;
            }
        };

        function savePassengerData(data, editIdx) {
            if (editIdx !== '') {
                passengerData[editIdx] = data;
            } else {
                passengerData.push(data);
            }
            updatePassengerList();
            bootstrap.Modal.getInstance(document.getElementById('passengerModal')).hide();
        }

        function updatePassengerList() {
            const list = document.getElementById('passenger-list');
            list.innerHTML = '';
            passengerData.forEach((p, idx) => {
                list.innerHTML += `
                <div class="penumpang-card">
                    <div>
                        <b>Penumpang ${idx + 1}:</b> ${p.title}${p.fullname} 
                        <span style="color:#999;font-size:0.97em;">(${p.nik})</span>
                        ${p.vaksin ? `<span style="color:green;font-size:0.95em;">✔️ Sertifikat vaksin</span>` : ''}
                    </div>
                    <div>
                        <button class="action-btn" title="Edit" onclick="showPassengerModal(${idx})">&#9998;</button>
                        <button class="action-btn delete" title="Hapus" onclick="deletePassenger(${idx})">&times;</button>
                    </div>
                </div>
                `;
            });
            updateBagasiSelect();
            updateTotalHarga();
        }

        function deletePassenger(idx) {
            if (confirm('Hapus penumpang ini?')) {
                passengerData.splice(idx, 1);
                updatePassengerList();
            }
        }

        // Update opsi select bagasi sesuai jumlah penumpang
        function updateBagasiSelect() {
            let select = document.getElementById('bagasiSelect');
            select.innerHTML = `<option value="0">Tidak tambah bagasi</option>`;
            for (let i = 1; i <= passengerData.length; i++) {
                select.innerHTML += `<option value="${i}">Tambah bagasi untuk ${i} penumpang</option>`;
            }
        }

        // Hitung & tampilkan total harga
        function updateTotalHarga() {
            let jmlOrang = passengerData.length;
            let jmlBagasi = parseInt(document.getElementById('bagasiSelect').value || "0");
            let totalHarga = (jmlOrang * hargaPerOrang) + (jmlBagasi * hargaBagasi);

            document.getElementById('total-orang-txt').innerText = `Harga total untuk ${jmlOrang} orang`;
            document.getElementById('total-harga-txt').innerText = "RP " + totalHarga.toLocaleString('id-ID');
        }

        // Submit Booking: validasi minimal 1 penumpang
        function submitBooking() {
            if (passengerData.length == 0) {
                alert('Isi minimal 1 penumpang sebelum lanjut!');
                return;
            }

            document.getElementById('inputHargaPerOrang').value = hargaPerOrang;
            document.getElementById('inputHargaBagasi').value = hargaBagasi;
            document.getElementById('inputJmlBagasi').value = document.getElementById('bagasiSelect').value;

            // Ambil total harga dari teks (hapus non-digit)
            let totalText = document.getElementById('total-harga-txt').innerText;
            let totalNumber = parseInt(totalText.replace(/\D/g, '')) || 0;
            document.getElementById('inputTotalHarga').value = totalNumber;

            // Hapus property vaksin (kita hanya kirim data text‐based)
            passengerData.forEach(p => delete p.vaksin);
            document.getElementById('inputPenumpangJson').value = JSON.stringify(passengerData);

            document.getElementById('bookingForm').submit();
        }

        // Jika select bagasi berubah, langsung update total harga
        document.getElementById('bagasiSelect').addEventListener('change', updateTotalHarga);
    </script>
</body>
</html>
