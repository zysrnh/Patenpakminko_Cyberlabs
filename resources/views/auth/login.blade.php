@extends('layouts.public')

@section('title', 'Login - PATEN PAK MIKO')

@section('content')
<style>
    /* Reset & Base */
    html, body {
        margin: 0; padding: 0;
        width: 100%; height: 100%;
        font-family: 'Inter', sans-serif;
    }

    /* Container for the split background */
    .login-wrapper {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        min-height: calc(100vh - 70px); /* Fill screen minus header */
        flex: 1; 
        background: #F0F6FB;
    }

    /* The right side dark blue background */
    .login-bg-right {
        position: absolute;
        top: 0; right: 0; bottom: 0;
        width: 42%;
        background-color: #174A70; /* Dark blue matching the image */
        z-index: 0;
    }

    /* Content Layout */
    .login-container {
        position: relative;
        z-index: 1;
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
        width: 100%;
        max-width: 1280px;
        padding: 60px 40px;
        gap: 60px;
    }

    /* Left Info Section */
    .login-info {
        flex: 1;
        max-width: 580px;
    }
    .login-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(50, 145, 168, 0.1);
        color: #3291A8;
        padding: 8px 16px;
        border-radius: 4px;
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 24px;
    }
    .login-title {
        font-size: 48px;
        color: #0A1C2C;
        line-height: 1.15;
        margin-bottom: 24px;
    }
    .login-title .thin {
        font-weight: 300;
        display: block;
    }
    .login-title .normal {
        font-weight: 500;
        display: block;
    }
    .login-title .highlight {
        font-weight: 800;
        color: #3291A8;
        display: block;
    }
    .login-desc {
        font-size: 14px;
        color: #555;
        line-height: 1.6;
        max-width: 440px;
    }

    /* Right Card Section */
    .login-card-wrap {
        flex: 0 0 650px; /* Dilebarin drastis biar makin masuk ke bagian kiri */
    }
    .login-card {
        background: #FFFFFF;
        border-radius: 4px;
        padding: 80px 70px; /* Padding kiri-kanan ditambahin biar imbang sama lebarnya */
        box-shadow: -15px 25px 60px rgba(0,0,0,0.12);
        width: 100%;
    }
    .form-group {
        margin-bottom: 28px; /* Jarak antar input agak dilebarin dikit */
    }
    .form-label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: #0A1C2C;
        margin-bottom: 8px;
    }
    .form-input-wrap {
        position: relative;
    }
    .form-control {
        width: 100%;
        background: #F4F7F9;
        border: 1px solid #E2E8F0;
        border-radius: 4px;
        padding: 16px;
        font-size: 14px;
        color: #0A1C2C;
        transition: all .2s;
    }
    .form-control:focus {
        outline: none;
        border-color: #3291A8;
        background: #fff;
    }
    .pw-toggle {
        position: absolute;
        right: 16px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #A0AAB2;
        cursor: pointer;
        padding: 0;
        display: flex;
    }
    .forgot-pw-wrap {
        /* Removed as we move it to label row */
    }
    .forgot-pw {
        font-size: 13px;
        color: #3291A8;
        text-decoration: none;
        font-weight: 600;
        transition: color .2s;
    }
    .forgot-pw:hover {
        color: #00223D;
        text-decoration: underline;
    }

    .btn-login {
        width: 100%;
        padding: 18px;
        background: #00223D;
        color: #fff;
        border: none;
        border-radius: 4px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: background .2s;
        margin-top: 16px;
    }
    .btn-login:hover { background: #001526; }

    /* Responsive */
    @media (max-width: 1024px) {
        .login-bg-right { width: 30%; }
        .login-container { gap: 40px; padding: 40px 20px; }
        .login-title { font-size: 36px; }
        .login-card-wrap { flex: 0 0 460px; }
    }
    @media (max-width: 768px) {
        .login-bg-right { display: none; }
        .login-wrapper { background: #F0F6FB; }
        .login-container {
            flex-direction: column;
            text-align: center;
        }
        .login-info { margin-bottom: 40px; }
        .login-desc { margin: 0 auto; }
        .login-card-wrap { width: 100%; flex: auto; }
        .login-card { padding: 40px 24px; }
        .form-label { text-align: left; }
    }
</style>

<div class="login-wrapper">
    <div class="login-bg-right"></div>
    
    <div class="login-container">
        <!-- Text Section -->
        <div class="login-info">
            <div class="login-badge">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                </svg>
                Login Akun
            </div>
            <h1 class="login-title">
                <span class="thin">Selamat</span>
                <span class="normal">Datang Kembali di</span>
                <span class="highlight">PATEN PAK MIKO</span>
            </h1>
            <p class="login-desc">Masuk ke akun Anda untuk melanjutkan pengajuan layanan, memantau status proses, melihat jadwal, dan mengakses seluruh fitur layanan pertanahan digital.</p>
        </div>

        <!-- Card Section -->
        <div class="login-card-wrap">
            <div class="login-card">
                <form method="POST" action="{{ route('login') }}" id="loginForm">
                    @csrf
                    
                    <div class="form-group">
                        <label class="form-label">Email / Username</label>
                        <input type="text" name="login" id="login" class="form-control" placeholder="Email / Username" value="{{ old('login') }}" required autofocus>
                        @error('login')
                            <span style="color: #E53E3E; font-size: 12px; margin-top: 6px; display: block;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Password</label>
                        <div class="form-input-wrap">
                            <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                            <button type="button" class="pw-toggle" id="togglePassword">
                                <svg id="eyeIcon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <span style="color: #E53E3E; font-size: 12px; margin-top: 6px; display: block;">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn-login">Login</button>

                    <div style="margin-top: 24px; text-align: center;">
                        <a href="{{ Route::has('password.request') ? route('password.request') : '#' }}" class="forgot-pw" style="font-size: 14px; font-weight: 500; color: #7A9BB5;">Lupa Password?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const passwordInput = document.getElementById('password');
    const togglePasswordButton = document.getElementById('togglePassword');
    const eyeIcon = document.getElementById('eyeIcon');

    togglePasswordButton.addEventListener('click', function() {
        const isPassword = passwordInput.getAttribute('type') === 'password';
        passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
        
        if (isPassword) {
            eyeIcon.innerHTML = '<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line>';
        } else {
            eyeIcon.innerHTML = '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle>';
        }
    });
</script>
@endsection
