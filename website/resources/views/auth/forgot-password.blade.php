<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Lupa Password' }}</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <main class="login-page">
        <a class="login-brand" href="{{ route('home') }}" aria-label="Kembali ke beranda JTIntern">
            <img src="{{ asset('images/JTIntern_resize.png') }}" alt="JTIntern">
        </a>

        <section class="login-card" aria-labelledby="forgot-title">
            <div class="login-card__header">
                <h1 id="forgot-title">LUPA PASSWORD</h1>
                <p>ADMIN JTINTERN</p>
            </div>

            <form class="login-form" method="POST" action="{{ route('password.email') }}">
                @csrf

                @if ($errors->any())
                    <div class="login-alert">
                        {{ $errors->first() }}
                    </div>
                @endif

                @if (session('status'))
                    <div class="login-alert login-alert--success">
                        {{ session('status') }}
                    </div>
                @endif

                <label for="email">EMAIL ADMIN</label>
                <div class="input-group">
                    <i class="bi bi-envelope" aria-hidden="true"></i>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="Masukkan email admin" autocomplete="email" required>
                </div>

                <button type="submit" class="login-submit">
                    Kirim Link Reset
                    <i class="bi bi-send" aria-hidden="true"></i>
                </button>

                <div class="login-options login-options--center">
                    <a class="forgot-link" href="{{ route('login') }}">Kembali ke Login</a>
                </div>
            </form>

            <p class="login-copy">&copy; 2026 JTINTERN</p>
        </section>

        <section class="login-art" aria-hidden="true">
            <div class="art-window">
                <span></span>
                <span></span>
                <span></span>
                <div class="art-line art-line--long"></div>
                <div class="art-line"></div>
                <div class="art-line art-line--short"></div>
                <div class="art-text">T</div>
                <div class="art-bars">
                    <b></b>
                    <b></b>
                </div>
                <div class="art-image">
                    <i></i>
                </div>
            </div>
            <div class="art-play"><i class="bi bi-play-fill"></i></div>
            <div class="art-dots"><span></span><span></span><span></span></div>
            <div class="art-curve"></div>
            <div class="art-search"><i class="bi bi-search"></i></div>
            <div class="art-plus"><i class="bi bi-plus-lg"></i></div>
        </section>
    </main>
</body>
</html>
