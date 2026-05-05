<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Reset Password' }}</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <main class="login-page">
        <a class="login-brand" href="{{ route('home') }}" aria-label="Kembali ke beranda JTIntern">
            <img src="{{ asset('images/JTIntern_resize.png') }}" alt="JTIntern">
        </a>

        <section class="login-card" aria-labelledby="reset-title">
            <div class="login-card__header">
                <h1 id="reset-title">RESET PASSWORD</h1>
                <p>ADMIN JTINTERN</p>
            </div>

            <form class="login-form" method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                @if ($errors->any())
                    <div class="login-alert">
                        {{ $errors->first() }}
                    </div>
                @endif

                <label for="email">EMAIL ADMIN</label>
                <div class="input-group">
                    <i class="bi bi-envelope" aria-hidden="true"></i>
                    <input id="email" type="email" name="email" value="{{ old('email', $email) }}" placeholder="Masukkan email admin" autocomplete="email" required>
                </div>

                <label for="password">PASSWORD BARU</label>
                <div class="input-group">
                    <i class="bi bi-lock" aria-hidden="true"></i>
                    <input id="password" type="password" name="password" placeholder="Minimal 8 karakter" autocomplete="new-password" required>
                    <button class="password-toggle" type="button" data-password-toggle="password" aria-label="Lihat password baru">
                        <i class="bi bi-eye" aria-hidden="true"></i>
                    </button>
                </div>

                <label for="password_confirmation">KONFIRMASI PASSWORD</label>
                <div class="input-group">
                    <i class="bi bi-shield-lock" aria-hidden="true"></i>
                    <input id="password_confirmation" type="password" name="password_confirmation" placeholder="Ulangi password baru" autocomplete="new-password" required>
                    <button class="password-toggle" type="button" data-password-toggle="password_confirmation" aria-label="Lihat konfirmasi password">
                        <i class="bi bi-eye" aria-hidden="true"></i>
                    </button>
                </div>

                <button type="submit" class="login-submit">
                    Simpan Password
                    <i class="bi bi-check2-circle" aria-hidden="true"></i>
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

    <script src="{{ asset('js/password-toggle.js') }}"></script>
</body>
</html>
