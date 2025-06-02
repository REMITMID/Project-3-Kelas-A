<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brawijayan Travel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brawijayan Travel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .hero-section {
            position: relative;
            width: 100%;
            height: 400px;
            background: url('Gambar/Background halaman dashboard.png') center center/cover no-repeat;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .hero-content h2 {
            font-size: 2.25rem;
            color: #fff;
            font-weight: 600;
            margin-bottom: 32px;
            text-align: center;
            width: 100%;
        }

        .search-modern-card {
            background: rgba(255, 255, 255, 0.97);
            border-radius: 20px;
            box-shadow: 0 8px 28px rgba(0, 0, 0, 0.09);
            padding: 32px 36px 20px 36px;
            max-width: 99vw;
            margin: auto;
        }

        .search-flex-row {
            display: flex;
            align-items: flex-end;
            gap: 16px;
            flex-wrap: wrap;
        }

        .search-flex-row .form-group {
            display: flex;
            flex-direction: column;
            min-width: 175px;
            flex: 1 1 0;
        }

        .search-flex-row label {
            font-size: 15px;
            font-weight: 600;
            color: #425179;
            margin-bottom: 7px;
        }

        .search-flex-row select,
        .search-flex-row input[type="date"] {
            border-radius: 12px;
            border: 2px solid #e5e5e7;
            background: #f6f9fd;
            font-size: 16px;
            height: 46px;
            outline: none;
            transition: border 0.2s;
            padding: 0 16px;
        }

        .search-flex-row select:focus,
        .search-flex-row input[type="date"]:focus {
            border-color: #007AFF;
        }

        .swap-btn {
            height: 46px;
            width: 46px;
            border-radius: 12px;
            background: #f3f6fd;
            border: 1.5px solid #dce4ee;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 0;
            margin-top: 22px;
            padding: 0;
            transition: border-color 0.18s;
        }

        .swap-btn:hover {
            border-color: #007AFF;
            background: #e6f0ff;
        }

        .swap-icon {
            width: 22px;
            height: 22px;
            fill: #2a5298;
        }

        .cari-btn {
            height: 46px;
            padding: 0 38px;
            border-radius: 12px;
            font-size: 1.13rem;
            font-weight: 600;
            background: #007AFF;
            color: #fff;
            border: none;
            min-width: 110px;
            margin-bottom: 0;
            margin-top: 22px;
            transition: 0.18s;
            box-shadow: 0 2px 10px rgba(30, 60, 140, 0.04);
        }

        .cari-btn:hover {
            background: #0056b3;
        }

        .promo-banner {
            background: linear-gradient(135deg, #e3f2fd 0%, #f0f8ff 100%);
            border: 1px solid #bbdefb;
            border-radius: 12px;
            padding: 10px 22px;
            display: flex;
            align-items: center;
            gap: 9px;
            margin-top: 17px;
            font-size: 15px;
            color: #1976d2;
            width: fit-content;
            max-width: 100%;
        }

        .promo-icon {
            width: 20px !important;
            height: 20px !important;
            fill: #1976d2;
            flex-shrink: 0;
        }

        .promo-link {
            color: #007AFF;
            text-decoration: none;
            font-weight: 600;
        }

        .promo-link:hover {
            text-decoration: underline;
        }

        @media (max-width: 900px) {
            .hero-content h2 {
                font-size: 1.38rem;
                margin-bottom: 18px;
            }

            .search-modern-card {
                padding: 22px 5vw;
            }

            .search-flex-row {
                flex-direction: column;
                gap: 10px;
            }

            .search-flex-row .form-group {
                min-width: 0;
            }

            .promo-banner {
                padding: 8px 8px;
                font-size: 14px;
            }
        }

        /* Rekomendasi Liburan Carousel */
        .rekomendasi-carousel-container {
            position: relative;
        }

        .rekomendasi-carousel {
            display: flex;
            gap: 24px;
            overflow-x: auto;
            overflow-y: visible;
            scroll-behavior: smooth;
            min-height: 270px;
            padding-bottom: 8px;
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        .rekomendasi-carousel::-webkit-scrollbar {
            display: none;
        }

        .destination-card {
            border-radius: 18px;
            overflow: hidden;
            cursor: pointer;
            box-shadow: 0 2px 14px rgba(40, 80, 180, 0.09);
            position: relative;
            width: 230px;
            min-width: 230px;
            max-width: 260px;
            aspect-ratio: 1.08/1;
            min-height: 240px;
            max-height: 260px;
            background: #e6eefb;
            display: flex;
            align-items: stretch;
            transition: box-shadow 0.22s;
            flex: 0 0 auto;
        }

        .destination-card:hover {
            box-shadow: 0 12px 28px rgba(40, 80, 180, 0.16);
        }

        .destination-card img {
            width: 100%;
            height: 100%;
            min-height: 230px;
            object-fit: cover;
            display: block;
            transition: filter 0.35s cubic-bezier(.4, 2, .2, 1);
        }

        /* Teks Kota dan Deskripsi */
        .destination-title,
        .destination-desc {
            position: absolute;
            left: 0;
            right: 0;
            padding: 0.78rem 1.1rem;
            z-index: 2;
        }

        .destination-title {
            bottom: 0;
            font-size: 1.16rem;
            color: #fff;
            font-weight: 700;
            letter-spacing: 1px;
            background: linear-gradient(0deg, rgba(35, 43, 66, 0.47) 82%, rgba(0, 0, 0, 0) 100%);
            border-bottom-left-radius: 15px;
            border-bottom-right-radius: 15px;
            opacity: 1;
            transition: opacity 0.18s, transform 0.32s;
            backdrop-filter: blur(1.5px);
        }

        .destination-desc {
            bottom: 0;
            color: #fff;
            font-size: 1.01rem;
            background: rgba(21, 30, 60, 0.63);
            border-bottom-left-radius: 15px;
            border-bottom-right-radius: 15px;
            opacity: 0;
            transform: translateY(28px);
            pointer-events: none;
            transition: opacity 0.34s cubic-bezier(.42, 0, .42, 1.01), transform 0.39s cubic-bezier(.56, 1.2, .3, .9);
            backdrop-filter: blur(2px);
        }

        .destination-card:hover img {
            filter: brightness(0.63) blur(1.5px) grayscale(0.05);
        }

        .destination-card:hover .destination-title {
            opacity: 0;
            transition: opacity 0.22s;
        }

        .destination-card:hover .destination-desc {
            opacity: 1;
            pointer-events: auto;
            transform: translateY(0px);
        }

        .carousel-btn {
            position: absolute;
            top: 43%;
            transform: translateY(-50%);
            background: rgba(255, 255, 255, 0.93);
            border: 1.8px solid #e4e6ed;
            border-radius: 50%;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 5;
            box-shadow: 0 2px 8px rgba(100, 120, 200, 0.12);
            transition: background 0.17s, border 0.13s;
        }

        .dropdown-item.text-danger {
            background: none;
            border: none;
            width: 100%;
            text-align: left;
            padding: 8px 16px;
        }


        .carousel-btn:active {
            background: #e2edfa;
        }

        .carousel-btn svg {
            width: 19px;
            height: 19px;
            fill: #2355a5;
        }

        .carousel-btn.left {
            left: -18px;
        }

        .carousel-btn.right {
            right: -18px;
        }

        @media (max-width: 991px) {

            .destination-card,
            .destination-card img {
                min-height: 140px;
                max-height: 160px;
                width: 155px;
                min-width: 155px;
            }

            .carousel-btn {
                width: 30px;
                height: 30px;
            }
        }

        @media (max-width: 600px) {

            .destination-card,
            .destination-card img {
                min-height: 110px;
                max-height: 120px;
                width: 110px;
                min-width: 110px;
            }

            .carousel-btn {
                width: 26px;
                height: 26px;
            }
        }

        .navbar {
            background: rgba(0, 0, 0, 0.15) !important;
            backdrop-filter: blur(6px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .navbar .btn-light {
            background-color: #fff;
            color: #000;
        }

        .navbar .btn-primary {
            color: #fff;
        }

        .navbar .text-white {
            color: #fff !important;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-transparent position-absolute top-0 start-0 w-100 z-3 py-2">
        <div class="container d-flex justify-content-between align-items-center">
            <a class="navbar-brand d-flex align-items-center text-white fw-bold" href="{{ url('/') }}">
                <img src="{{ asset('Gambar/logo.png') }}" alt="Logo" style="height:40px; margin-right:10px;">
                <span class="fw-bold text-white">Brawijayan</span>
            </a>
            <div class="d-flex align-items-center gap-3">
                @guest
                    <a href="{{ url('/login') }}" class="btn btn-light">Login</a>
                    <a href="{{ url('/register') }}" class="btn btn-primary">Daftar</a>
                @else
                    <div class="dropdown">
                        <a href="#" class="d-block link-light text-decoration-none" id="profileMenu"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->nama ?? Auth::user()->name) }}&background=033C6A&color=fff&size=36"
                                alt="Profile" style="width:36px; height:36px; border-radius:50%;">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileMenu">
                            <li>
                                <div class="dropdown-item-text fw-semibold">
                                    {{ Auth::user()->nama ?? Auth::user()->name }}
                                    <div class="small text-muted">{{ Auth::user()->email }}</div>
                                </div>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="{{ url('/riwayat_eticket') }}">Riwayat E-Ticket</a></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}" style="margin:0; padding:0;">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger"
                                        style="background: none; border: none; padding: 8px 16px; width: 100%; text-align: left; display: block;">
                                        Logout
                                    </button>
                                </form>
                            </li>

                        </ul>

                    </div>
                @endguest
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-overlay"></div>
        <div class="container hero-content">
            <h2 class="text-center w-100"><br><span class="fw-bold" style="color:#fff;">Halo User, mau pergi ke
                    mana?</span></h2>
            <div class="search-modern-card">
                <form action="{{ url('/cari-tiket') }}" method="get" class="search-flex-row">
                    <div class="form-group">
                        <label for="asal">Dari</label>
                        <select id="asal" name="asal" required>
                            <option value="CGK">Jakarta (CGK)</option>
                            <option value="SUB">Surabaya (SUB)</option>
                            <option value="DPS">Bali (DPS)</option>
                            <option value="YOG">Yogyakarta (YOG)</option>
                            <option value="UPG">Makassar (UPG)</option>
                            <option value="LOP">Lombok (LOP)</option>
                            <option value="KNO">Medan (KNO)</option>
                            <option value="SIN">Singapura (SIN)</option>
                            <option value="KUL">Malaysia (KUL)</option>
                            <option value="HND">Tokyo (HND)</option>
                            <option value="SYD">Sydney (SYD)</option>
                            <option value="SGN">Vietnam (SGN)</option>
                            <option value="BKK">Bangkok (BKK)</option>
                        </select>
                    </div>
                    <button type="button" class="swap-btn" onclick="swapAsalTujuan()" title="Tukar asal & tujuan">
                        <svg class="swap-icon" viewBox="0 0 24 24">
                            <path d="M6.99 11L3 15l3.99 4v-3H14v-2H6.99v-3zM21 9l-3.99-4v3H10v2h7.01v3L21 9z" />
                        </svg>
                    </button>
                    <div class="form-group">
                        <label for="tujuan">Ke</label>
                        <select id="tujuan" name="tujuan" required>
                            <option value="">Pilih Bandara Tujuan</option>
                            <option value="CGK">Jakarta (CGK)</option>
                            <option value="SUB">Surabaya (SUB)</option>
                            <option value="DPS">Bali (DPS)</option>
                            <option value="YOG">Yogyakarta (YOG)</option>
                            <option value="UPG">Makassar (UPG)</option>
                            <option value="LOP">Lombok (LOP)</option>
                            <option value="KNO">Medan (KNO)</option>
                            <option value="SIN">Singapura (SIN)</option>
                            <option value="KUL">Malaysia (KUL)</option>
                            <option value="HND">Tokyo (HND)</option>
                            <option value="SYD">Sydney (SYD)</option>
                            <option value="SGN">Vietnam (SGN)</option>
                            <option value="BKK">Bangkok (BKK)</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" id="tanggal" name="tanggal" required
                            value="{{ old('tanggal', date('Y-m-d')) }}">
                    </div>
                    <div class="form-group">
                        <label for="kelas">Kelas</label>
                        <select id="kelas" name="kelas" required>
                            <option value="Ekonomi">Ekonomi</option>
                            <option value="Bisnis">Bisnis</option>
                            <option value="First Class">First Class</option>
                        </select>
                    </div>
                    <button type="submit" class="cari-btn">Cari</button>
                </form>
                <div class="promo-banner mt-3">
                    <svg class="promo-icon" viewBox="0 0 24 24">
                        <path
                            d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                    </svg>
                    Gunakan promo untuk harga lebih hemat!
                </div>
            </div>
        </div>
    </section>

    <!-- Rekomendasi Liburan Carousel -->
    <section class="container my-5">
        <h4 class="fw-bold mb-3">Rekomendasi Liburan buat Kamu!</h4>
        <div class="mb-4">
            <button id="btn-internasional" class="btn btn-outline-primary btn-sm me-2 active"
                onclick="showRekomendasi('internasional')">Internasional</button>
            <button id="btn-domestik" class="btn btn-outline-secondary btn-sm"
                onclick="showRekomendasi('domestik')">Domestik</button>
        </div>
        <div class="rekomendasi-carousel-container position-relative">
            <div class="rekomendasi-carousel" id="rekomendasi-carousel">
                <!-- Destinasi diisi lewat JS -->
            </div>
        </div>
    </section>

    <script>
        function swapAsalTujuan() {
            var asal = document.getElementById('asal');
            var tujuan = document.getElementById('tujuan');
            var temp = asal.value;
            asal.value = tujuan.value;
            tujuan.value = temp;
        }
        // Data
        const rekomendasi = {
            internasional: [
                { title: "Singapura", img: "https://images.unsplash.com/photo-1496939376851-89342e90adcd?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D", desc: "Negara modern dengan ikon Merlion & surga belanja di Orchard Road." },
                { title: "Malaysia", img: "https://images.unsplash.com/photo-1596422846543-75c6fc197f07?q=80&w=2064&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D", desc: "Negara serumpun dengan budaya dan kuliner khas, menara Petronas & wisata kota." },
                { title: "Sydney", img: "https://images.unsplash.com/photo-1551352912-484163ad5be9?q=80&w=2071&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D", desc: "Kota pelabuhan terbesar Australia, Opera House & pantai Bondi." },
                { title: "Vietnam", img: "https://images.unsplash.com/photo-1609412058473-c199497c3c5d?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D", desc: "Negeri Lotus, wisata alam Ha Long Bay & street food Pho." },
                { title: "Bangkok", img: "https://images.unsplash.com/photo-1563492065599-3520f775eeed?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D", desc: "Pusat street food Asia, Grand Palace & kehidupan malam meriah." },
                { title: "Tokyo", img: "https://images.unsplash.com/photo-1532236204992-f5e85c024202?q=80&w=2095&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D", desc: "Kota futuristik Jepang, Shibuya & sakura bermekaran di musim semi." }
            ],
            domestik: [
                { title: "Yogyakarta", img: "https://images.unsplash.com/photo-1631002164896-004e2058d6e4?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D", desc: "Kota Gudeg, Malioboro, budaya Jawa & candi Prambanan/Borobudur." },
                { title: "Surabaya", img: "https://images.unsplash.com/photo-1566176553949-872b2a73e04e?q=80&w=1970&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D", desc: "Kota Pahlawan, kuliner rawon & Suroboyoan vibes, pusat bisnis Jawa Timur." },
                { title: "Bali", img: "https://plus.unsplash.com/premium_photo-1677829177642-30def98b0963?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D", desc: "Pulau Dewata, pantai eksotis & budaya Hindu yang kental." },
                { title: "Makassar", img: "https://images.unsplash.com/photo-1715601492348-9668e6d9ca31?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D", desc: "Kota metropolitan di timur, Pantai Losari & gerbang wisata ke Toraja." },
                { title: "Lombok", img: "https://images.unsplash.com/photo-1605752660759-2db7b7de8fa9?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D", desc: "Pulau tropis, Gili Trawangan, dan Gunung Rinjani yang menantang." },
                { title: "Medan", img: "https://images.unsplash.com/photo-1678803263623-df51d4679e4a?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D", desc: "Kota terbesar di Sumatra, Danau Toba & wisata kuliner Batak." }
            ]
        };

        let currentJenis = 'internasional';

        function renderCarousel(jenis) {
            const data = rekomendasi[jenis];
            const carousel = document.getElementById('rekomendasi-carousel');
            let html = '';
            for (let i = 0; i < data.length; i++) {
                html += `
                    <div class="destination-card" tabindex="0">
                        <img src="${data[i].img}" alt="${data[i].title}">
                        <div class="destination-title">${data[i].title}</div>
                        <div class="destination-desc">${data[i].desc}</div>
                    </div>
                `;
            }
            carousel.innerHTML = html;
        }

        function showRekomendasi(jenis) {
            currentJenis = jenis;
            document.getElementById('btn-internasional').classList.toggle('active', jenis === 'internasional');
            document.getElementById('btn-domestik').classList.toggle('active', jenis === 'domestik');
            renderCarousel(jenis);
        }

        function enableCarouselSwipe() {
            const carousel = document.getElementById('rekomendasi-carousel');
            let isDown = false, startX, scrollLeft;

            carousel.addEventListener('mousedown', (e) => {
                isDown = true;
                carousel.classList.add('active');
                startX = e.pageX - carousel.offsetLeft;
                scrollLeft = carousel.scrollLeft;
            });
            carousel.addEventListener('mouseleave', () => {
                isDown = false;
                carousel.classList.remove('active');
            });
            carousel.addEventListener('mouseup', () => {
                isDown = false;
                carousel.classList.remove('active');
            });
            carousel.addEventListener('mousemove', (e) => {
                if (!isDown) return;
                e.preventDefault();
                const x = e.pageX - carousel.offsetLeft;
                const walk = (x - startX) * 1.16;
                carousel.scrollLeft = scrollLeft - walk;
            });

            let touchStartX = 0;
            let touchScrollLeft = 0;
            carousel.addEventListener('touchstart', function (e) {
                touchStartX = e.touches[0].pageX;
                touchScrollLeft = carousel.scrollLeft;
            });
            carousel.addEventListener('touchmove', function (e) {
                const touchX = e.touches[0].pageX;
                const walk = (touchX - touchStartX) * 1.1;
                carousel.scrollLeft = touchScrollLeft - walk;
            });
        }

        document.addEventListener('DOMContentLoaded', function () {
            renderCarousel('internasional');
            enableCarouselSwipe();
            document.getElementById('btn-internasional').onclick = function () { showRekomendasi('internasional'); }
            document.getElementById('btn-domestik').onclick = function () { showRekomendasi('domestik'); }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>