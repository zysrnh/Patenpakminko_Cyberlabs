@extends('layouts.public')

@section('title', 'Verifikasi OTP - PATEN PAK MIKO')

@section('content')
<style>
    /* Reset & Base */
    html, body {
        margin: 0; padding: 0;
        width: 100%; height: 100%;
        font-family: 'Poppins', sans-serif;
    }

    /* Container for the split background */
    .login-wrapper {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        min-height: calc(100vh - 70px);
        flex: 1; 
        background: #F0F6FB;
    }

    /* The right side dark blue background */
    .login-bg-right {
        position: absolute;
        top: 0; right: 0; bottom: 0;
        width: 42%;
        background-color: #174A70;
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
        flex: 0 0 650px;
    }
    .login-card {
        background: #FFFFFF;
        border-radius: 4px;
        padding: 80px 70px;
        box-shadow: -15px 25px 60px rgba(0,0,0,0.12);
        width: 100%;
    }
    .form-group {
        margin-bottom: 28px;
        text-align: center;
    }
    .form-label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: #0A1C2C;
        margin-bottom: 16px;
    }
    .otp-input-container {
        display: flex;
        justify-content: center;
        gap: 12px;
        margin-bottom: 8px;
    }
    .otp-box {
        width: 54px;
        height: 64px;
        font-size: 28px;
        font-weight: 700;
        text-align: center;
        border: 1px solid #E2E8F0;
        border-radius: 4px;
        outline: none;
        background: #F4F7F9;
        color: #0A1C2C;
        transition: all 0.2s;
    }
    .otp-box:focus {
        border-color: #3291A8;
        background: #fff;
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
        .login-card-wrap { flex: 0 0 500px; }
        .login-card { padding: 60px 40px; }
        .otp-box { width: 44px; height: 54px; font-size: 24px; }
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
        .otp-input-container { gap: 6px; }
        .otp-box { width: 40px; height: 50px; font-size: 20px; }
    }
</style>

<div class="login-wrapper">
    <div class="login-bg-right"></div>
    
    <div class="login-container">
        <!-- Text Section -->
        <div class="login-info">
            <div class="login-badge">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/>
                </svg>
                Verifikasi
            </div>
            <h1 class="login-title">
                <span class="thin">Validasi</span>
                <span class="normal">Kode OTP Anda</span>
                <span class="highlight">PATEN PAK MIKO</span>
            </h1>
            <p class="login-desc">Masukkan 6 digit kode OTP yang kami kirimkan ke nomor WhatsApp terdaftar Anda untuk memverifikasi kepemilikan akun.</p>
        </div>

        <!-- Card Section -->
        <div class="login-card-wrap">
            <div class="login-card">
                <form action="{{ route('password.otp.verify') }}" method="POST" id="otpForm">
                    @csrf
                    
                    @if(session('success'))
                        <div style="background-color: #E6F4EA; border: 1px solid #B8E2C8; color: #137333; padding: 12px 16px; border-radius: 4px; font-size: 13.5px; font-weight: 500; margin-bottom: 24px; display: flex; align-items: center; gap: 8px;">
                            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="flex-shrink:0;"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <span>{{ session('success') }}</span>
                        </div>
                    @endif
         
                    @if(session('error'))
                        <div style="background-color: #FCE8E6; border: 1px solid #F8B4B4; color: #C5221F; padding: 12px 16px; border-radius: 4px; font-size: 13.5px; font-weight: 500; margin-bottom: 24px; display: flex; align-items: center; gap: 8px;">
                            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="flex-shrink:0;"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                            <span>{{ session('error') }}</span>
                        </div>
                    @endif

                    <div class="form-group">
                        <label class="form-label">Kode OTP 6-Digit</label>
                        <div class="otp-input-container">
                            <input type="text" maxlength="1" class="otp-box" required autofocus>
                            <input type="text" maxlength="1" class="otp-box" required>
                            <input type="text" maxlength="1" class="otp-box" required>
                            <input type="text" maxlength="1" class="otp-box" required>
                            <input type="text" maxlength="1" class="otp-box" required>
                            <input type="text" maxlength="1" class="otp-box" required>
                        </div>
                        <input type="hidden" name="otp" id="fullOtp">
                        <span style="font-size: 12px; color: #7A9BB5; margin-top: 12px; display: block;">Masukkan angka 0-9 untuk setiap kotak.</span>
                    </div>

                    <button type="submit" class="btn-login">Verifikasi Kode OTP</button>

                    <div style="margin-top: 24px; text-align: center;">
                        <span style="font-size: 13.5px; color: #555;">Tidak menerima OTP?</span>
                        <a href="{{ route('password.request') }}" style="color: #3291A8; text-decoration: none; font-size: 13.5px; font-weight: 600; margin-left: 4px; transition: color .2s;" onmouseover="this.style.color='#00223D'" onmouseout="this.style.color='#3291A8'">Kirim Ulang</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const inputs = document.querySelectorAll('.otp-box');
    const hiddenInput = document.getElementById('fullOtp');
    const form = document.getElementById('otpForm');

    inputs.forEach((input, index) => {
        input.addEventListener('input', (e) => {
            // Hanya boleh angka
            if (!/^[0-9]$/.test(input.value)) {
                input.value = '';
                return;
            }

            if (input.value && index < inputs.length - 1) {
                inputs[index + 1].focus();
            }
            updateHiddenInput();
        });

        input.addEventListener('keydown', (e) => {
            if (e.key === 'Backspace' && !input.value && index > 0) {
                inputs[index - 1].focus();
            }
        });
    });

    function updateHiddenInput() {
        let otp = '';
        inputs.forEach(input => otp += input.value);
        hiddenInput.value = otp;
    }

    form.addEventListener('submit', (e) => {
        updateHiddenInput();
        if (hiddenInput.value.length !== 6) {
            e.preventDefault();
            alert('Kode OTP harus terdiri dari 6 digit.');
        }
    });
</script>
@endsection
