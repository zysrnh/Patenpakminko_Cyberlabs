<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PATEN PAK MIKO')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --blue:      #218AC9;
            --blue-dk:   #003B64;
            --blue-lt:   #E3F0F9;
            --blue-md:   #B3D4EC;
            --yellow:    #FFCB05;
            --yellow-lt: #FFF8D6;
            --brown:     #D37324;
            --green:     #85C341;
            --green-dk:  #79A73A;
            --green-lt:  #EEF7E2;
            --ink:       #003B64;
            --mid:       #2C5272;
            --muted:     #7A9BB5;
            --line:      #D6E4EF;
            --surface:   #F0F6FB;
            --surface2:  #E8F2FA;
            --white:     #FFFFFF;
            --r-sm:      6px;
            --r-md:      10px;
            --r-lg:      16px;
            --r-xl:      24px;
            --sidebar:   248px;
        }

        html, body { height: 100%; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--surface);
            color: var(--ink);
            -webkit-font-smoothing: antialiased;
            display: flex;
        }

        /* ─── OVERLAY (mobile) ───────────────── */
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,.45);
            z-index: 19;
        }
        .sidebar-overlay.open { display: block; }

        /* ─── SIDEBAR ────────────────────────── */
        .sidebar {
            width: var(--sidebar);
            min-height: 100vh;
            background: var(--blue-dk);
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0; left: 0;
            z-index: 20;
            overflow-y: auto;
            transition: transform .25s ease;
        }

        .sidebar-logo {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 24px 20px 20px;
            border-bottom: 1px solid rgba(255,255,255,.08);
            text-decoration: none;
        }
        .sidebar-logo-icon {
            width: 36px; height: 36px;
            border-radius: var(--r-md);
            background: var(--blue);
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .sidebar-logo-icon svg { width: 18px; height: 18px; fill: none; stroke: #fff; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; }
        .sidebar-logo-text strong { display: block; font-size: 14px; font-weight: 800; color: #fff; letter-spacing: -.02em; }
        .sidebar-logo-text span { font-size: 10px; font-weight: 600; color: rgba(255,255,255,.45); text-transform: uppercase; letter-spacing: .08em; }

        .sidebar-section { padding: 20px 12px 8px; }
        .sidebar-section-label { font-size: 10px; font-weight: 700; color: rgba(255,255,255,.3); text-transform: uppercase; letter-spacing: .1em; padding: 0 8px; margin-bottom: 6px; }

        .nav-item {
            display: flex; align-items: center; gap: 10px;
            padding: 9px 10px; border-radius: var(--r-md);
            text-decoration: none; color: rgba(255,255,255,.6);
            font-size: 13.5px; font-weight: 600;
            transition: all .18s; margin-bottom: 2px;
        }
        .nav-item svg { width: 17px; height: 17px; fill: none; stroke: currentColor; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; flex-shrink: 0; }
        .nav-item:hover { color: #fff; background: rgba(255,255,255,.08); }
        .nav-item.active { color: var(--blue-dk); background: var(--yellow); font-weight: 700; }
        .nav-item.active svg { color: var(--blue-dk); }

        .sidebar-bottom { margin-top: auto; padding: 16px 12px; border-top: 1px solid rgba(255,255,255,.08); }
        .sidebar-user { display: flex; align-items: center; gap: 10px; padding: 10px; border-radius: var(--r-md); background: rgba(255,255,255,.06); margin-bottom: 8px; }
        .sidebar-avatar { width: 34px; height: 34px; border-radius: 50%; background: var(--blue); color: #fff; font-weight: 700; font-size: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; border: 1.5px solid rgba(255,255,255,.2); object-fit: cover; }
        .sidebar-user-info strong { display: block; font-size: 13px; font-weight: 700; color: #fff; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 140px; }
        .sidebar-user-info span { font-size: 11px; color: rgba(255,255,255,.45); }

        .btn-logout-sidebar {
            display: flex; align-items: center; gap: 8px;
            width: 100%; padding: 9px 10px;
            background: transparent; border: 1px solid rgba(255,255,255,.12);
            border-radius: var(--r-md); color: rgba(255,255,255,.55);
            font-family: inherit; font-size: 13px; font-weight: 600;
            cursor: pointer; transition: all .18s;
        }
        .btn-logout-sidebar svg { width: 15px; height: 15px; fill: none; stroke: currentColor; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; }
        .btn-logout-sidebar:hover { background: rgba(239,68,68,.15); border-color: rgba(239,68,68,.3); color: #FC8181; }

        /* ─── MAIN AREA ──────────────────────── */
        .main-wrap {
            margin-left: var(--sidebar);
            flex: 1; display: flex; flex-direction: column;
            min-height: 100vh;
        }

        /* ─── TOPBAR ─────────────────────────── */
        .topbar {
            height: 60px; background: var(--white);
            border-bottom: 1px solid var(--line);
            display: flex; align-items: center;
            justify-content: space-between;
            padding: 0 28px;
            position: sticky; top: 0; z-index: 10;
        }
        .topbar-left { display: flex; align-items: center; gap: 12px; }
        .hamburger {
            display: none;
            width: 36px; height: 36px;
            background: var(--surface); border: 1px solid var(--line);
            border-radius: var(--r-md); cursor: pointer;
            align-items: center; justify-content: center;
        }
        .hamburger svg { width: 18px; height: 18px; fill: none; stroke: var(--ink); stroke-width: 2; stroke-linecap: round; }
        .topbar-title { font-size: 16px; font-weight: 800; color: var(--ink); letter-spacing: -.02em; }
        .topbar-right { display: flex; align-items: center; gap: 12px; }
        .topbar-date { font-size: 12px; font-weight: 500; color: var(--muted); }

        /* ─── CONTENT ────────────────────────── */
        .content { padding: 24px 28px; flex: 1; }

        /* ─── PAGE HEADER ────────────────────── */
        .page-header {
            display: flex; align-items: center; justify-content: space-between;
            margin-bottom: 24px;
        }
        .page-header-left { display: flex; flex-direction: column; }
        .page-header h1 { font-size: 20px; font-weight: 800; color: var(--ink); letter-spacing: -.02em; }
        .page-header p { font-size: 13px; color: var(--muted); margin-top: 3px; }
        .breadcrumb { font-size: 12px; color: var(--muted); display: flex; align-items: center; gap: 6px; margin-bottom: 6px; }
        .breadcrumb a { color: var(--blue); text-decoration: none; font-weight: 600; }

        /* ─── PANEL / CARD ───────────────────── */
        .panel { background: var(--white); border: 1px solid var(--line); border-radius: var(--r-lg); }
        .panel + .panel { margin-top: 20px; }
        .panel-head { display: flex; align-items: center; justify-content: space-between; padding: 16px 20px 14px; border-bottom: 1px solid var(--line); }
        .panel-head h2 { font-size: 14px; font-weight: 800; color: var(--ink); }
        .panel-head-link { font-size: 12px; font-weight: 700; color: var(--blue); text-decoration: none; }
        .panel-body { padding: 20px; }

        /* ─── ALERTS ─────────────────────────── */
        .alert { display: flex; align-items: center; gap: 10px; padding: 12px 16px; border-radius: var(--r-md); font-size: 13px; font-weight: 500; margin-bottom: 20px; }
        .alert svg { width: 16px; height: 16px; flex-shrink: 0; }
        .alert-success { background: #E6F4EA; border: 1px solid #B8E2C8; color: #137333; }
        .alert-error   { background: #FCE8E6; border: 1px solid #F8B4B4; color: #C5221F; }
        .alert-warning { background: #FFFDF0; border: 1.5px solid #FBE89F; color: #744210; display: flex; justify-content: space-between; }
        .alert-link { background: var(--yellow); color: #744210; border: none; padding: 7px 14px; border-radius: var(--r-md); font-family: inherit; font-size: 12px; font-weight: 700; cursor: pointer; text-decoration: none; white-space: nowrap; }

        /* ─── FORM ELEMENTS ──────────────────── */
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 18px; }
        .form-group { margin-bottom: 18px; }
        .form-label { display: block; font-size: 12.5px; font-weight: 600; color: var(--ink); margin-bottom: 7px; }
        .form-label span { color: #E53E3E; }
        .form-control {
            width: 100%; padding: 10px 14px;
            font-family: inherit; font-size: 14px; font-weight: 500; color: var(--ink);
            background: var(--white); border: 1.5px solid var(--line);
            border-radius: var(--r-md); transition: all .2s; outline: none;
        }
        .form-control:focus { border-color: var(--blue); box-shadow: 0 0 0 3px var(--blue-lt); }
        .form-control:disabled, .form-control[readonly] { background: var(--surface); color: var(--muted); cursor: not-allowed; }
        .form-hint { font-size: 11.5px; color: var(--muted); margin-top: 5px; }
        .form-error { font-size: 11.5px; color: #C5221F; margin-top: 5px; display: flex; align-items: center; gap: 4px; }

        textarea.form-control { resize: vertical; min-height: 90px; }
        select.form-control { cursor: pointer; }

        /* ─── BUTTONS ────────────────────────── */
        .btn { display: inline-flex; align-items: center; justify-content: center; gap: 7px; padding: 10px 20px; font-family: inherit; font-size: 13.5px; font-weight: 700; border-radius: var(--r-md); cursor: pointer; border: none; text-decoration: none; transition: all .18s; }
        .btn svg { width: 15px; height: 15px; fill: none; stroke: currentColor; stroke-width: 2.5; stroke-linecap: round; stroke-linejoin: round; }
        .btn-primary { background: var(--blue); color: #fff; }
        .btn-primary:hover { background: var(--blue-dk); box-shadow: 0 4px 12px rgba(33,138,201,.25); }
        .btn-secondary { background: var(--surface); color: var(--mid); border: 1px solid var(--line); }
        .btn-secondary:hover { background: var(--blue-lt); border-color: var(--blue-md); color: var(--blue); }
        .btn-danger { background: #FFF5F5; color: #C53030; border: 1px solid #FED7D7; }
        .btn-danger:hover { background: #C53030; color: #fff; }
        .btn-sm { padding: 7px 14px; font-size: 12px; }
        .btn-full { width: 100%; }

        /* ─── TABLE ──────────────────────────── */
        .table-wrap { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; font-size: 13px; }
        thead th { padding: 10px 14px; text-align: left; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: .05em; color: var(--muted); background: var(--surface); border-bottom: 1px solid var(--line); white-space: nowrap; }
        tbody td { padding: 12px 14px; border-bottom: 1px solid var(--line); color: var(--ink); vertical-align: middle; }
        tbody tr:last-child td { border-bottom: none; }
        tbody tr:hover td { background: var(--surface); }

        /* ─── BADGE / STATUS ─────────────────── */
        .badge { display: inline-flex; align-items: center; gap: 4px; padding: 3px 10px; border-radius: 20px; font-size: 11px; font-weight: 700; white-space: nowrap; }
        .badge-blue    { background: var(--blue-lt); color: var(--blue); }
        .badge-green   { background: var(--green-lt); color: var(--green-dk); }
        .badge-yellow  { background: var(--yellow-lt); color: #92600A; }
        .badge-red     { background: #FFF5F5; color: #C53030; }
        .badge-gray    { background: var(--surface2); color: var(--muted); }

        /* ─── EMPTY STATE ────────────────────── */
        .empty-state { text-align: center; padding: 48px 24px; }
        .empty-state svg { width: 48px; height: 48px; fill: none; stroke: var(--blue-md); stroke-width: 1.5; margin-bottom: 14px; }
        .empty-state h3 { font-size: 15px; font-weight: 700; color: var(--ink); margin-bottom: 6px; }
        .empty-state p { font-size: 13px; color: var(--muted); margin-bottom: 18px; }

        /* ─── MOBILE RESPONSIVE ──────────────── */
        @media (max-width: 768px) {
            body { display: block; }

            .sidebar {
                transform: translateX(-100%);
                width: 260px;
            }
            .sidebar.open { transform: translateX(0); }

            .main-wrap { margin-left: 0; }

            .hamburger { display: flex; }

            .topbar { padding: 0 16px; height: 56px; }
            .topbar-date { display: none; }

            .content { padding: 16px; }

            .form-grid { grid-template-columns: 1fr; }

            .page-header { flex-direction: column; align-items: flex-start; gap: 12px; }

            table { font-size: 12px; }
            thead th, tbody td { padding: 10px 10px; }
        }

        @media (max-width: 480px) {
            .content { padding: 12px; }
            .panel-body { padding: 14px; }
            .btn { padding: 9px 16px; font-size: 13px; }
        }

        @yield('extra-styles')
    </style>
    @yield('head-extra')
</head>
<body>
    <!-- Overlay mobile -->
    <div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>

    <!-- SIDEBAR -->
    <aside class="sidebar" id="sidebar">
        <a href="{{ route('dashboard') }}" class="sidebar-logo">
            <div class="sidebar-logo-icon">
                <svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
            </div>
            <div class="sidebar-logo-text">
                <strong>PATEN PAK MIKO</strong>
                <span>Kantor Pertanahan Sukabumi</span>
            </div>
        </a>

        <div class="sidebar-section">
            <div class="sidebar-section-label">Menu Utama</div>
            <a href="/" class="nav-item {{ request()->is('/') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                Beranda
            </a>
            <a href="{{ route('dashboard') }}" class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
                Dashboard
            </a>
            <a href="{{ route('profile') }}" class="nav-item {{ request()->routeIs('profile') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                Profil Saya
            </a>
        </div>

        <div class="sidebar-section">
            <div class="sidebar-section-label">Layanan</div>
            <a href="{{ route('non-berusaha.index') }}" class="nav-item {{ request()->routeIs('non-berusaha.*') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                PKKPR Non Berusaha
            </a>
            <a href="{{ route('berusaha.index') }}" class="nav-item {{ request()->routeIs('berusaha.*') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24"><rect x="2" y="3" width="20" height="14" rx="2"/><path d="M8 21h8M12 17v4"/></svg>
                PKKPR Berusaha
            </a>
            <a href="{{ route('kebijakan.index') }}" class="nav-item {{ request()->routeIs('kebijakan.*') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                Kebijakan Khusus
            </a>
            <a href="{{ route('psn.index') }}" class="nav-item {{ request()->routeIs('psn.*') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z"/><line x1="4" y1="22" x2="4" y2="15"/></svg>
                PSN
            </a>
            <a href="{{ route('lapolpa.index') }}" class="nav-item {{ request()->routeIs('lapolpa.*') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24"><path d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01"/></svg>
                LAPOLPA
            </a>
            <a href="{{ route('ulasan.index') }}" class="nav-item {{ request()->routeIs('ulasan.*') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                Ulasan Layanan
            </a>
        </div>

        @if(Auth::check() && Auth::user()->isDpn())
        <div class="sidebar-section">
            <div class="sidebar-section-label">Admin</div>
            <a href="{{ route('dpn.whatsapp') }}" class="nav-item {{ request()->routeIs('dpn.whatsapp') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
                Integrasi WhatsApp
            </a>
            <a href="{{ route('dpn.contacts') }}" class="nav-item {{ request()->routeIs('dpn.contacts') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg>
                Kontak Admin Instansi
            </a>
            <a href="{{ route('admin.reviews.index') }}" class="nav-item {{ request()->routeIs('admin.reviews.*') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                Kelola Ulasan
            </a>
        </div>
        @endif

        <div class="sidebar-bottom">
            <div class="sidebar-user">
                @if(Auth::check() && Auth::user()->profile_photo)
                    <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="Foto Profil" class="sidebar-avatar">
                @else
                    <div class="sidebar-avatar">{{ Auth::check() ? strtoupper(substr(Auth::user()->username ?? 'U', 0, 2)) : 'G' }}</div>
                @endif
                <div class="sidebar-user-info">
                    <strong>{{ Auth::check() ? (Auth::user()->name ?? Auth::user()->username) : 'Guest / Tamu' }}</strong>
                    <span>{{ Auth::check() ? Auth::user()->phone_number : 'Publik' }}</span>
                </div>
            </div>
            @if(Auth::check())
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-logout-sidebar">
                    <svg viewBox="0 0 24 24"><path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                    Keluar dari Akun
                </button>
            </form>
            @else
            <a href="{{ route('login') }}" class="btn-logout-sidebar" style="color: var(--blue); border-color: var(--blue); text-decoration: none; justify-content: center;">
                Masuk / Daftar Akun
            </a>
            @endif
        </div>
    </aside>

    <!-- MAIN WRAP -->
    <div class="main-wrap">
        <header class="topbar">
            <div class="topbar-left">
                <button class="hamburger" id="hamburgerBtn" onclick="toggleSidebar()">
                    <svg viewBox="0 0 24 24"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
                </button>
                <span class="topbar-title">@yield('page-title', 'PATEN PAK MIKO')</span>
            </div>
            <div class="topbar-right">
                <span class="topbar-date" id="current-date"></span>
            </div>
        </header>

        <div class="content">
            @if(session('success'))
                <div class="alert alert-success">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-error">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    <script>
        // Topbar date
        const d = new Date();
        const el = document.getElementById('current-date');
        if (el) el.textContent = d.toLocaleDateString('id-ID', { weekday:'long', year:'numeric', month:'long', day:'numeric' });

        // Sidebar mobile toggle
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('open');
            document.getElementById('sidebarOverlay').classList.toggle('open');
        }
        function closeSidebar() {
            document.getElementById('sidebar').classList.remove('open');
            document.getElementById('sidebarOverlay').classList.remove('open');
        }
    </script>
    @yield('scripts')
</body>
</html>
