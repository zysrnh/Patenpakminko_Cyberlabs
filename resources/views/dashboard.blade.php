<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pelaku Usaha — PATENPAKMIKO</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">

    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --clr-blue:    #1393CC;
            --clr-blue-dk: #0f7bb0;
            --clr-blue-lt: #E8F5FB;
            --clr-yellow:  #F2CC05;
            --clr-green:   #95B93E;
            --clr-green-dk:#7fa030;
            --clr-green-lt:#F0F7E4;
            --clr-ink:     #0B1420;
            --clr-mid:     #4B5A6A;
            --clr-muted:   #8A98A8;
            --clr-line:    #E3E8EF;
            --clr-surface: #F6F9FC;
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
            -webkit-font-smoothing: antialiased;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 0 24px;
        }

        /* ─── HEADER ─────────────────────────────────────────── */
        header {
            background: var(--clr-white);
            border-bottom: 1px solid var(--clr-line);
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .header-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 72px;
        }

        .logo-wrap {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }
        .logo-icon {
            width: 40px;
            height: 40px;
            border-radius: var(--radius-md);
            background: var(--clr-blue);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .logo-icon svg {
            width: 20px;
            height: 20px;
            fill: none;
            stroke: #fff;
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
        }
        .user-nav {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .header-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 1.5px solid var(--clr-blue);
        }

        .header-avatar-placeholder {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--clr-blue-lt);
            color: var(--clr-blue);
            font-weight: 700;
            font-size: 13px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1.5px solid var(--clr-blue);
            text-transform: uppercase;
        }

        .user-badge {
            display: flex;
            flex-direction: column;
            text-align: left; /* Biar rapi di samping avatar */
        }
        .user-badge strong {
            font-size: 14px;
            font-weight: 700;
            color: var(--clr-ink);
        }
        .user-badge span {
            font-size: 11px;
            color: var(--clr-muted);
            font-weight: 600;
        }
        .logo-text {
            display: flex;
            flex-direction: column;
            line-height: 1;
        }
        .logo-text strong {
            font-size: 16px;
            font-weight: 800;
            color: var(--clr-ink);
            letter-spacing: -.02em;
        }
        .logo-text span {
            font-size: 10px;
            font-weight: 600;
            color: var(--clr-muted);
            text-transform: uppercase;
            letter-spacing: .1em;
            margin-top: 3px;
        }

        .nav-menu {
            display: flex;
            align-items: center;
            gap: 24px;
        }
        .nav-link {
            font-size: 14px;
            font-weight: 600;
            color: var(--clr-mid);
            text-decoration: none;
            transition: color 0.2s;
        }
        .nav-link:hover, .nav-link.active {
            color: var(--clr-blue);
        }

        .btn-logout {
            background: transparent;
            border: 1px solid var(--clr-line);
            color: var(--clr-mid);
            padding: 8px 14px;
            font-family: inherit;
            font-size: 12.5px;
            font-weight: 600;
            border-radius: var(--radius-md);
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.2s;
        }
        .btn-logout:hover {
            color: #E53E3E;
            border-color: #FED7D7;
            background: #FFF5F5;
        }

        /* ─── MAIN CONTENT ───────────────────────────────────── */
        main {
            padding: 40px 0;
        }

        .welcome-section {
            background: linear-gradient(135deg, #1393CC 0%, #0f7bb0 100%);
            border-radius: var(--radius-lg);
            padding: 32px;
            color: white;
            margin-bottom: 28px;
            box-shadow: 0 10px 25px rgba(19, 147, 204, 0.15);
        }
        .welcome-section h1 {
            font-size: 24px;
            font-weight: 800;
            margin-bottom: 8px;
            letter-spacing: -0.01em;
        }
        .welcome-section p {
            font-size: 15px;
            opacity: 0.9;
            line-height: 1.5;
        }

        /* ─── ALERTS ─────────────────────────────────────────── */
        .alert-profile {
            background: #FFFDF0;
            border: 1.5px solid #FBE89F;
            color: #744210;
            padding: 16px 20px;
            border-radius: var(--radius-lg);
            margin-bottom: 28px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
        }
        .alert-text {
            font-size: 13.5px;
            line-height: 1.5;
            font-weight: 500;
        }
        .alert-link {
            background: var(--clr-yellow);
            color: #744210;
            border: none;
            padding: 8px 14px;
            border-radius: var(--radius-md);
            font-family: inherit;
            font-size: 12.5px;
            font-weight: 700;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s;
            white-space: nowrap;
        }
        .alert-link:hover {
            opacity: 0.9;
            transform: translateY(-0.5px);
        }

        .alert-success {
            background: #E6F4EA;
            border: 1px solid #B8E2C8;
            color: #137333;
            padding: 12px 16px;
            border-radius: var(--radius-md);
            font-size: 13.5px;
            font-weight: 600;
            margin-bottom: 28px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* ─── SERVICES CONTAINER ────────────────────────────── */
        .services-section {
            background: var(--clr-white);
            border: 1px solid var(--clr-line);
            border-radius: var(--radius-lg);
            padding: 32px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.01);
        }
        
        .services-title {
            font-size: 18px;
            font-weight: 800;
            color: var(--clr-ink);
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 1px solid var(--clr-line);
        }

        .services-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 16px;
        }

        .service-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px;
            border: 1px solid var(--clr-line);
            border-radius: var(--radius-md);
            text-decoration: none;
            transition: all 0.2s;
        }
        .service-item:hover {
            border-color: var(--clr-blue);
            background: var(--clr-blue-lt);
            transform: translateX(4px);
        }

        .service-info {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .service-icon {
            width: 44px;
            height: 44px;
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .service-icon.blue { background: #EBF8FF; color: var(--clr-blue); }
        .service-icon.green { background: var(--clr-green-lt); color: var(--clr-green); }
        .service-icon.yellow { background: #FFFDF0; color: var(--clr-yellow); }

        .service-icon svg {
            width: 22px;
            height: 22px;
            fill: none;
            stroke: currentColor;
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .service-text h3 {
            font-size: 14.5px;
            font-weight: 700;
            color: var(--clr-ink);
            margin-bottom: 4px;
        }
        .service-text p {
            font-size: 12.5px;
            color: var(--clr-mid);
        }

        .service-action {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            font-size: 13px;
            font-weight: 700;
            color: var(--clr-blue);
        }
        .service-action svg {
            width: 16px;
            height: 16px;
            fill: none;
            stroke: currentColor;
            stroke-width: 2.5;
        }

        .service-locked {
            opacity: 0.65;
            cursor: not-allowed;
            pointer-events: none;
        }
    </style>
</head>
<body>

    <!-- Header -->
    <header>
        <div class="container">
            <div class="header-inner">
                <a href="/dashboard" class="logo-wrap">
                    <div class="logo-icon">
                        <svg viewBox="0 0 24 24">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                        </svg>
                    </div>
                    <div class="logo-text">
                        <strong>PATENPAKMIKO</strong>
                        <span>Portal Pelaku Usaha</span>
                    </div>
                </a>

                <div class="nav-menu">
                    <a href="/" class="nav-link">Beranda</a>
                    <a href="{{ route('dashboard') }}" class="nav-link active">Dashboard</a>
                    <a href="{{ route('profile') }}" class="nav-link">Profil Saya</a>
                    
                    <div class="user-nav" style="margin-left: 12px; padding-left: 12px; border-left: 1.5px solid var(--clr-line);">
                        @if(Auth::user()->profile_photo)
                            <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="Foto Profil" class="header-avatar">
                        @else
                            <div class="header-avatar-placeholder">
                                {{ strtoupper(substr(Auth::user()->username, 0, 2)) }}
                            </div>
                        @endif
                        <div class="user-badge">
                            <strong>{{ Auth::user()->name ?? Auth::user()->username }}</strong>
                            <span>{{ Auth::user()->phone_number }}</span>
                        </div>
                    </div>
                    
                    <form action="{{ route('logout') }}" method="POST" style="margin-left: 8px;">
                        @csrf
                        <button type="submit" class="btn-logout">
                            <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                            Keluar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <!-- Main -->
    <main>
        <div class="container">
            
            @if(session('success'))
                <div class="alert-success">
                    <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ session('success') }}
                </div>
            @endif

            @php
                $user = Auth::user();
                $isProfileIncomplete = empty($user->name) || empty($user->email) || empty($user->address) || empty($user->business_name) || empty($user->business_role);
            @endphp

            <!-- Welcome Banner -->
            <div class="welcome-section">
                <h1>Selamat Datang, {{ $user->name ?? $user->username }}!</h1>
                <p>Silakan pilih jenis kesesuaian ruang di bawah untuk mengajukan permohonan baru atau melacak proses yang sedang berjalan.</p>
            </div>

            <!-- Incomplete Profile Warning -->
            @if($isProfileIncomplete)
                <div class="alert-profile">
                    <div class="alert-text">
                        <strong>⚠️ Profil Anda belum lengkap!</strong>
                        <p style="margin-top: 2px;">Melengkapi data profil (Email, Alamat, dan Data Usaha) akan memudahkan proses verifikasi dokumen administrasi Anda nantinya.</p>
                    </div>
                    <a href="{{ route('profile') }}" class="alert-link">Lengkapi Profil</a>
                </div>
            @endif

            <!-- Services Section -->
            <div class="services-section">
                <h2 class="services-title">Modul Layanan Pemanfaatan Ruang</h2>
                <div class="services-grid">
                    
                    <!-- 1. PPKPR Non Berusaha -->
                    <a href="{{ route('non-berusaha.index') }}" class="service-item">
                        <div class="service-info">
                            <div class="service-icon green">
                                <svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                            </div>
                            <div class="service-text">
                                <h3>PPKPR Non Berusaha</h3>
                                <p>Untuk rumah tinggal, keagamaan, sosial, fasilitas umum, dan kegiatan non-bisnis lainnya.</p>
                            </div>
                        </div>
                        <span class="service-action">
                            Buka Layanan
                            <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                        </span>
                    </a>

                    <!-- 2. PPKPR Berusaha -->
                    <a href="#" class="service-item service-locked">
                        <div class="service-info">
                            <div class="service-icon yellow">
                                <svg viewBox="0 0 24 24"><rect x="2" y="3" width="20" height="14" rx="2"/><path d="M8 21h8M12 17v4"/></svg>
                            </div>
                            <div class="service-text">
                                <h3>PPKPR Berusaha (Segera Hadir)</h3>
                                <p>Untuk perizinan pemanfaatan ruang dengan skala bisnis mikro, kecil, menengah, dan besar.</p>
                            </div>
                        </div>
                        <span class="service-action" style="color: var(--clr-muted)">
                            Terkunci
                        </span>
                    </a>

                    <!-- 3. Kebijakan -->
                    <a href="#" class="service-item service-locked">
                        <div class="service-info">
                            <div class="service-icon blue">
                                <svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                            </div>
                            <div class="service-text">
                                <h3>Kebijakan Khusus (Segera Hadir)</h3>
                                <p>Permohonan peninjauan ruang berdasarkan mandat kebijakan khusus pemerintah.</p>
                            </div>
                        </div>
                        <span class="service-action" style="color: var(--clr-muted)">
                            Terkunci
                        </span>
                    </a>

                </div>
            </div>

        </div>
    </main>

</body>
</html>
