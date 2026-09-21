<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Matrif</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --green-primary: #1B7A3D;
            --green-dark: #0F5C2A;
            --text-dark: #1A1A1A;
            --text-muted: #6B7280;
            --border-color: #E5E7EB;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Lexend', sans-serif;
            min-height: 100vh;
            display: flex;
        }

        .page {
            display: flex;
            width: 100%;
            min-height: 100vh;
        }

        /* ===== Kolom Kiri: Form Login ===== */
        .login-side {
            flex: 1.70;
            display: flex;
            flex-direction: column;
            padding: 40px 60px;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 60px;
        }

        .logo img {
            width: 48px;
            height: 48px;
            object-fit: contain;
        }

        .logo span {
            font-size: 24px;
            font-weight: 700;
            letter-spacing: 0.5px;
            color: var(--text-dark);
        }

        .login-card {
            width: 100%;
            max-width: 480px;
            margin: 0 auto;
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: 48px 40px;
        }

        .login-card h1 {
            text-align: center;
            font-size: 22px;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 8px;
        }

        .login-card .subtitle {
            text-align: center;
            font-size: 14px;
            font-weight: 300;
            color: var(--text-muted);
            margin-bottom: 40px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 400;
            color: var(--text-dark);
            margin-bottom: 8px;
        }

        .form-group input {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-family: 'Lexend', sans-serif;
            font-size: 14px;
            color: var(--text-dark);
            outline: none;
            transition: border-color 0.2s ease;
        }

        .form-group input:focus {
            border-color: var(--green-primary);
        }

        .forgot-password {
            text-align: right;
            margin-bottom: 32px;
        }

        .forgot-password a {
            font-size: 13px;
            font-weight: 500;
            color: var(--green-primary);
            text-decoration: none;
        }

        .forgot-password a:hover {
            text-decoration: underline;
        }

        .btn-login {
            width: 100%;
            padding: 14px;
            margin-top: 50px;
            background-color: var(--green-primary);
            color: #fff;
            border: none;
            border-radius: 8px;
            font-family: 'Lexend', sans-serif;
            font-size: 15px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .btn-login:hover {
            background-color: var(--green-dark);
        }

        .error-message {
            background-color: #FEE2E2;
            color: #B91C1C;
            font-size: 13px;
            padding: 10px 14px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
        }

        /* ===== Kolom Kanan: Banner Hijau + Gambar Transparan ===== */
        .banner-side {
            flex: 1;
            position: relative;
            background-color: var(--green-primary);
            border-radius: 30px 0 0 30px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            padding: 60px 56px;
            color: #fff;
        }

        /* Gambar latar belakang dibuat transparan/menyatu dengan warna hijau */
        .banner-side::before {
            content: "";
            position: absolute;
            inset: 0;
            background-image: url('img/login.png');
            /* ganti dengan path gambar kamu */
            background-size: cover;
            background-position: center bottom;
            opacity: 0.35;
            /* atur transparansi gambar di sini */
            z-index: 0;
        }

        /* Gradasi dari hijau solid di atas ke gambar transparan di bawah */
        .banner-side::after {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(to bottom,
                    rgba(27, 122, 61, 1) 0%,
                    rgba(27, 122, 61, 0.85) 35%,
                    rgba(27, 122, 61, 0.55) 65%,
                    rgba(27, 122, 61, 0.35) 100%);
            z-index: 1;
        }

        .banner-content {
            position: relative;
            z-index: 2;
        }

        .banner-content h2 {
            font-size: 40px;
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 16px;
        }

        .banner-content p {
            font-size: 15px;
            font-weight: 300;
            line-height: 1.6;
            max-width: 380px;
            opacity: 0.95;
        }

        /* ===== Responsive ===== */
        @media (max-width: 900px) {
            .page {
                flex-direction: column;
            }

            .banner-side {
                border-radius: 0;
                min-height: 280px;
                order: -1;
                padding: 40px 32px;
            }

            .login-side {
                padding: 32px 24px;
            }

            .login-card {
                border: none;
                padding: 24px 0;
            }
        }
    </style>
</head>

<body>

    <div class="page">

        <!-- Kolom Kiri -->
        <div class="login-side">
            <div class="logo">
                <img src="img/logo.png" alt="">
                <span>MATRIF</span>
            </div>

            <div class="login-card">
                <h1>Login Untuk Matrif</h1>
                <p class="subtitle">Lanjutkan dengan Login untuk melakukan Transaksi</p>

                @if ($errors->any())
                    <div class="error-message">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login.process') }}">
                    @csrf

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" required>
                    </div>

                    <button type="submit" class="btn-login">Login</button>
                </form>
            </div>
        </div>

        <!-- Kolom Kanan -->
        <div class="banner-side">
            <div class="banner-content">
                <h2>Selamat Datang<br>Di Matfrif !</h2>
                <p>Login dan cari pilihan buah buhan tradisional untuk keperluan masakan anda.</p>
            </div>
        </div>

    </div>

</body>

</html>