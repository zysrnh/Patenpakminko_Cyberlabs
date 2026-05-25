<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password — PATENPAKMIKO</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
 
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
        }
 
        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: var(--clr-ink);
            margin-bottom: 8px;
        }
 
        .form-control {
            width: 100%;
            padding: 12px 16px;
            font-family: inherit;
            font-size: 14px;
            font-weight: 500;
            color: var(--clr-ink);
            background: var(--clr-white);
            border: 1.5px solid var(--clr-line);
            border-radius: var(--radius-md);
            transition: all 0.2s;
            outline: none;
        }
 
        .form-control:focus {
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
 
        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-top: 16px;
            color: var(--clr-muted);
            text-decoration: none;
            font-size: 13px;
            font-weight: 500;
            transition: color 0.2s;
        }
        .back-link:hover {
            color: var(--clr-blue);
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
                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2" stroke="#fff" stroke-width="2" fill="none"/>
                    <path d="M7 11V7a5 5 0 0 1 10 0v4" stroke="#fff" stroke-width="2" fill="none"/>
                </svg>
            </div>
            <h1 class="auth-title">Lupa Password</h1>
            <p class="auth-subtitle">Masukkan Nomor WhatsApp atau Username yang terdaftar untuk mengirimkan password baru Anda.</p>
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
 
            <form action="{{ route('password.otp.send') }}" method="POST">
                @csrf
 
                <!-- Input Identifier -->
                <div class="form-group">
                    <label for="identifier" class="form-label">Username atau Nomor WhatsApp</label>
                    <input type="text" id="identifier" name="identifier" class="form-control" placeholder="cth: budi_pu atau 081234..." value="{{ old('identifier') }}" required autofocus>
                    <span style="font-size: 11px; color: var(--clr-muted); margin-top: 4px; display: block;">*Masukkan data yang sesuai saat registrasi akun Anda.</span>
                </div>
 
                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary">Kirim Kode OTP</button>
            </form>
 
            <div class="auth-footer">
                Ingat password Anda? <a href="{{ route('login') }}" class="auth-link">Masuk Portal</a>
                <br>
                <a href="/" class="back-link">
                    <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
 
</body>
</html>
