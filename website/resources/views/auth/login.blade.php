<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Login Page' }}</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <main class="login-page">
        <a class="login-brand" href="{{ route('home') }}" aria-label="Kembali ke beranda JTIntern">
            <img src="{{ asset('images/JTIntern_resize.png') }}" alt="JTIntern">
        </a>

        <section class="login-card" aria-labelledby="login-title">
            <div class="login-card__header">
                <h1 id="login-title">ADMIN PANEL</h1>
                <p>POLITEKNIK NEGERI MALANG</p>
            </div>

            <form class="login-form" method="POST" action="{{ route('login.store') }}">
                @csrf

                @if ($errors->any())
                    <div class="login-alert">
                        {{ $errors->first() }}
                    </div>
                @endif

                <label for="username">USERNAME</label>
                <div class="input-group">
                    <i class="bi bi-person" aria-hidden="true"></i>
                    <input id="username" type="text" name="username" value="{{ old('username') }}" placeholder="Masukkan username anda" autocomplete="username" required>
                </div>

                <label for="password">PASSWORD</label>
                <div class="input-group">
                    <i class="bi bi-lock" aria-hidden="true"></i>
                    <input id="password" type="password" name="password" placeholder="********" autocomplete="current-password" required>
                </div>

                <a class="forgot-link" href="#">Lupa Password?</a>

                <button type="submit" class="login-submit">
                    Login
                    <i class="bi bi-box-arrow-in-right" aria-hidden="true"></i>
                </button>
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
