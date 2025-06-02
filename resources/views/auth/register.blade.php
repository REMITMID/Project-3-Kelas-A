<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register - Brawijayan Travel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            background: url('{{ asset('Gambar/Background register dan login.png') }}') center center/cover no-repeat;
            background-size: cover;
            position: relative;
            overflow-x: hidden;
        }
        .glass-bg {
           position: fixed;
           top: 0; left: 0; right: 0; bottom: 0;
           z-index: 0;
           background: rgba(10, 35, 70, 0.6);
           backdrop-filter: blur(18px);
           -webkit-backdrop-filter: blur(18px);
           pointer-events: none;
           border-top: 1.5px solid rgba(30, 90, 180, 0.22);
           border-bottom: 1.5px solid rgba(30, 90, 180, 0.18);
        }
        .container-fluid, .left-logo-box, .register-card {
            position: relative;
            z-index: 1;
        }
        .left-logo-box {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .left-logo-inner {
            text-align: center;
        }
        .left-logo-inner img {
            height: 100px;
            margin-bottom: 18px;
        }
        .left-logo-inner .brand-name {
            color: #fff;
            font-size: 2.7rem;
            font-weight: bold;
            text-shadow: 0 2px 12px rgba(0, 0, 0, 0.2);
        }
        .register-card {
            background: #fff;
            border-radius: 26px;
            box-shadow: 0 8px 36px rgba(0, 0, 0, 0.14);
            padding: 54px 36px 30px 36px;
            width: 100%;
            max-width: 410px;
            margin: 0 auto;
        }
        .social-login {
            margin-top: 18px;
            margin-bottom: 8px;
            text-align: center;
        }
        .social-login button {
            border: 1px solid #ddd;
            border-radius: 8px;
            width: 40px;
            height: 40px;
            margin: 0 8px;
            background: #fff;
        }
        .login-link {
            margin-top: 16px;
            text-align: center;
            font-size: 0.98rem;
        }
        @media (max-width: 900px) {
            .left-logo-box {
                display: none;
            }
            .register-card {
                margin-top: 40px;
                box-shadow: none;
                border-radius: 0;
                min-height: 100vh;
            }
        }
    </style>
</head>
<body>
    <div class="glass-bg"></div>
    <div class="container-fluid">
        <div class="row min-vh-100">
            <!-- Logo di KIRI -->
            <div class="col-md-6 left-logo-box">
                <div class="left-logo-inner">
                    <img src="{{ asset('Gambar/logo.png') }}" alt="Logo">
                    <div class="brand-name">Brawijayan</div>
                </div>
            </div>
            <!-- Card Register di KANAN -->
            <div class="col-md-6 d-flex align-items-center justify-content-center">
                <div class="register-card">
                    <h3 class="fw-bold mb-4 text-center">Daftar Akun</h3>
                    {{-- Alert error jika ada --}}
                    @if($errors->any())
                        <div class="alert alert-danger">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="mb-3">
                            <input type="text" class="form-control" name="name" placeholder="Nama Lengkap" required value="{{ old('name') }}">
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control" name="email" placeholder="Email" required value="{{ old('email') }}">
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>
                        <div class="mb-4">
                            <input type="password" class="form-control" name="password_confirmation" placeholder="Konfirmasi Password" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 mb-3"
                            style="background:#033C6A; font-weight:600; border-radius: 10px;">Daftar</button>
                    </form>
                    <div class="text-center text-muted" style="margin-bottom:6px; font-size:0.97rem;">Atau daftar dengan
                    </div>
                    <div class="social-login">
                        <button title="Apple"><img src="https://img.icons8.com/ios-filled/28/000000/mac-os.png"
                                style="height:24px;"></button>
                        <button title="Facebook"><img src="https://img.icons8.com/ios-filled/28/000000/facebook-new.png"
                                style="height:24px;"></button>
                        <button title="Google"><img src="https://img.icons8.com/color/28/000000/google-logo.png"
                                style="height:24px;"></button>
                    </div>
                    <div class="login-link">
                        Sudah punya akun? <a href="{{ url('/login') }}"><b>login di sini</b></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
