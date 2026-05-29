<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi OTP — PATEN PAK MIKO</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=DM+Mono:wght@500;700&display=swap" rel="stylesheet">
 
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
 
        :root {
            --clr-blue:    #218AC9;
            --clr-blue-dk: #003B64;
            --clr-blue-lt: #E3F0F9;
            --clr-yellow:  #FFCB05;
            --clr-green:   #85C341;
            --clr-ink:     #003B64;
            --clr-mid:     #2C5272;
            --clr-muted:   #7A9BB5;
            --clr-line:    #D6E4EF;
            --clr-surface: #F0F6FB;
            --clr-white:   #FFFFFF;
            --radius-sm:   6px;
            --radius-md:   10px;
            --radius-lg:   16px;
            --radius-xl:   24px;
        }
 
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--clr-surface);
            color: var(--clr-ink);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }
 
        .auth-container {
            width: 100%;
            max-width: 480px;
            background: var(--clr-white);
            border: 1px solid var(--clr-line);
            border-radius: var(--radius-lg);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.04);
            overflow: hidden;
            margin-bottom: 24px;
        }
 
        .color-bar {
            height: 4px;
            display: flex;
        }
        .color-bar span { flex: 1; }
        .color-bar span:nth-child(1) { background: var(--clr-blue); }
        .color-bar span:nth-child(2) { background: var(--clr-yellow); }
        .color-bar span:nth-child(3) { background: var(--clr-green); }
 
        .auth-header {
            padding: 40px 40px 24px;
            text-align: center;
        }
 
        .logo-icon {
            width: 48px;
            height: 48px;
            border-radius: var(--radius-md);
            background: var(--clr-blue);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 16px;
        }
        .logo-icon svg {
            width: 24px;
            height: 24px;
            fill: none;
            stroke: #fff;
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
        }
 
        .auth-title {
            font-size: 24px;
            font-weight: 800;
            letter-spacing: -0.02em;
            color: var(--clr-ink);
            margin-bottom: 8px;
        }
 
        .auth-subtitle {
            font-size: 14px;
            color: var(--clr-mid);
            line-height: 1.5;
        }
 
        .auth-body {
            padding: 0 40px 40px;
        }
 
        .alert-success {
            background-color: #E6F4EA;
            border: 1px solid #B8E2C8;
            color: #137333;
            padding: 12px 16px;
            border-radius: var(--radius-md);
            font-size: 13.5px;
            font-weight: 500;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
 
        .alert-error {
            background-color: #FCE8E6;
            border: 1px solid #F8B4B4;
            color: #C5221F;
            padding: 12px 16px;
            border-radius: var(--radius-md);
            font-size: 13.5px;
            font-weight: 500;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
 
        .form-group {
            margin-bottom: 20px;
            text-align: center;
        }
 
        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: var(--clr-ink);
            margin-bottom: 12px;
        }
 
        .otp-input-container {
            display: flex;
            justify-content: center;
            gap: 8px;
            margin-bottom: 8px;
        }
 
        .otp-box {
            width: 48px;
            height: 56px;
            font-size: 24px;
            font-weight: 700;
            text-align: center;
            border: 1.5px solid var(--clr-line);
            border-radius: var(--radius-md);
            outline: none;
            background: var(--clr-white);
            color: var(--clr-ink);
            font-family: 'DM Mono', monospace;
            transition: all 0.2s;
        }
 
        .otp-box:focus {
            border-color: var(--clr-blue);
            box-shadow: 0 0 0 4px var(--clr-blue-lt);
        }
 
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            padding: 12px 24px;
            font-family: inherit;
            font-weight: 600;
            font-size: 14px;
            border-radius: var(--radius-md);
            cursor: pointer;
            border: none;
            transition: all 0.2s;
            text-decoration: none;
        }
 
        .btn-primary {
            background: var(--clr-blue);
            color: var(--clr-white);
            margin-top: 10px;
        }
        .btn-primary:hover {
            background: var(--clr-blue-dk);
            box-shadow: 0 4px 12px rgba(33, 138, 201, 0.2);
            transform: translateY(-0.5px);
        }
 
        .auth-footer {
            margin-top: 24px;
            text-align: center;
            font-size: 13.5px;
            color: var(--clr-mid);
        }
 
        .auth-link {
            color: var(--clr-blue);
            text-decoration: none;
            font-weight: 600;
        }
        .auth-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
 
    <div class="auth-container">
        <!-- Top Accent Color Bar -->
        <div class="color-bar" aria-hidden="true">
            <span></span><span></span><span></span>
        </div>
 
        <div class="auth-header">
            <div class="logo-icon">
                <svg viewBox="0 0 24 24">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z" fill="#fff"/>
                </svg>
            </div>
            <h1 class="auth-title">Verifikasi OTP</h1>
            <p class="auth-subtitle">Masukkan 6 digit kode OTP yang kami kirimkan ke nomor WhatsApp terdaftar Anda.</p>
        </div>
 
        <div class="auth-body">
            @if(session('success'))
                <div class="alert-success">
                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ session('success') }}
                </div>
            @endif
 
            @if(session('error'))
                <div class="alert-error">
                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    {{ session('error') }}
                </div>
            @endif
 
            <form action="{{ route('password.otp.verify') }}" method="POST" id="otpForm">
                @csrf
 
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
                    <!-- Input tersembunyi yang akan dikirim ke backend -->
                    <input type="hidden" name="otp" id="fullOtp">
                    <span style="font-size: 11px; color: var(--clr-muted); margin-top: 4px; display: block;">Masukkan angka 0-9 untuk setiap kotak.</span>
                </div>
 
                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary">Verifikasi Kode OTP</button>
            </form>
 
            <div class="auth-footer">
                Tidak menerima OTP? <a href="{{ route('password.request') }}" class="auth-link">Kirim Ulang</a>
            </div>
        </div>
    </div>
 
    <script>
        const inputs = document.querySelectorAll('.otp-box');
        const hiddenInput = document.getElementById('fullOtp');
        const form = document.getElementById('otpForm');
 
        // Auto-focus next input and gather values
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
</body>
</html>
