<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pelaku Usaha — PATEN PAK MIKO</title>

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
            --green:     #16A34A;
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

        html, body {
            height: 100%;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--surface);
            color: var(--ink);
            -webkit-font-smoothing: antialiased;
            display: flex;
        }

        /* ─── SIDEBAR ─────────────────────────────────────── */
        .sidebar {
            width: var(--sidebar);
            min-height: 100vh;
            background: var(--blue-dk);
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 20;
            overflow-y: auto;
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
            width: 36px;
            height: 36px;
            border-radius: var(--r-md);
            background: var(--blue);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .sidebar-logo-icon svg {
            width: 18px;
            height: 18px;
            fill: none;
            stroke: #fff;
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
        }
        .sidebar-logo-text strong {
            display: block;
            font-size: 14px;
            font-weight: 800;
            color: #fff;
            letter-spacing: -.02em;
        }
        .sidebar-logo-text span {
            font-size: 10px;
            font-weight: 600;
            color: rgba(255,255,255,.45);
            text-transform: uppercase;
            letter-spacing: .08em;
        }

        .sidebar-section {
            padding: 20px 12px 8px;
        }
        .sidebar-section-label {
            font-size: 10px;
            font-weight: 700;
            color: rgba(255,255,255,.3);
            text-transform: uppercase;
            letter-spacing: .1em;
            padding: 0 8px;
            margin-bottom: 6px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 10px;
            border-radius: var(--r-md);
            text-decoration: none;
            color: rgba(255,255,255,.6);
            font-size: 13.5px;
            font-weight: 600;
            transition: all .18s;
            margin-bottom: 2px;
        }
        .nav-item svg {
            width: 17px;
            height: 17px;
            fill: none;
            stroke: currentColor;
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
            flex-shrink: 0;
        }
        .nav-item:hover {
            color: #fff;
            background: rgba(255,255,255,.08);
        }
        .nav-item.active {
            color: var(--blue-dk);
            background: var(--yellow);
            font-weight: 700;
        }
        .nav-item.active svg { color: var(--blue-dk); }

        .sidebar-bottom {
            margin-top: auto;
            padding: 16px 12px;
            border-top: 1px solid rgba(255,255,255,.08);
        }
        .sidebar-user {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px;
            border-radius: var(--r-md);
            background: rgba(255,255,255,.06);
            margin-bottom: 8px;
        }
        .sidebar-avatar {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: var(--blue);
            color: #fff;
            font-weight: 700;
            font-size: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            border: 1.5px solid rgba(255,255,255,.2);
            object-fit: cover;
        }
        .sidebar-user-info strong {
            display: block;
            font-size: 13px;
            font-weight: 700;
            color: #fff;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 140px;
        }
        .sidebar-user-info span {
            font-size: 11px;
            color: rgba(255,255,255,.45);
        }

        .btn-logout-sidebar {
            display: flex;
            align-items: center;
            gap: 8px;
            width: 100%;
            padding: 9px 10px;
            background: transparent;
            border: 1px solid rgba(255,255,255,.12);
            border-radius: var(--r-md);
            color: rgba(255,255,255,.55);
            font-family: inherit;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all .18s;
        }
        .btn-logout-sidebar svg {
            width: 15px; height: 15px;
            fill: none; stroke: currentColor; stroke-width: 2;
            stroke-linecap: round; stroke-linejoin: round;
        }
        .btn-logout-sidebar:hover {
            background: rgba(239,68,68,.15);
            border-color: rgba(239,68,68,.3);
            color: #FC8181;
        }

        /* ─── MAIN AREA ────────────────────────────────────── */
        .main-wrap {
            margin-left: var(--sidebar);
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* ─── TOP BAR ─────────────────────────────────────── */
        .topbar {
            height: 64px;
            background: var(--white);
            border-bottom: 1px solid var(--line);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 32px;
            position: sticky;
            top: 0;
            z-index: 10;
        }
        .topbar-title {
            font-size: 17px;
            font-weight: 800;
            color: var(--ink);
            letter-spacing: -.02em;
        }
        .topbar-right {
            display: flex;
            align-items: center;
            gap: 14px;
        }
        .topbar-date {
            font-size: 12.5px;
            font-weight: 500;
            color: var(--muted);
        }
        .topbar-notif {
            width: 36px;
            height: 36px;
            border-radius: var(--r-md);
            background: var(--surface);
            border: 1px solid var(--line);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            position: relative;
            transition: all .18s;
        }
        .topbar-notif:hover { background: var(--blue-lt); border-color: var(--blue-md); }
        .topbar-notif svg { width: 17px; height: 17px; fill: none; stroke: var(--mid); stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; }
        .notif-dot {
            position: absolute;
            top: 7px; right: 7px;
            width: 7px; height: 7px;
            border-radius: 50%;
            background: #DC2626;
            border: 1.5px solid var(--white);
        }

        /* ─── CONTENT ──────────────────────────────────────── */
        .content {
            padding: 28px 32px;
            flex: 1;
        }

        /* ─── WELCOME STRIP ────────────────────────────────── */
        .welcome-strip {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: var(--ink);
            border-radius: var(--r-lg);
            padding: 22px 28px;
            margin-bottom: 24px;
            border-left: 5px solid var(--yellow);
            position: relative;
            overflow: hidden;
        }
        .welcome-strip::after {
            content: '';
            position: absolute;
            right: -30px; top: -40px;
            width: 200px; height: 200px;
            border-radius: 50%;
            background: rgba(255,255,255,.03);
        }
        .welcome-strip h1 {
            font-size: 20px;
            font-weight: 800;
            color: #fff;
            margin-bottom: 4px;
            letter-spacing: -.02em;
        }
        .welcome-strip p {
            font-size: 13.5px;
            color: rgba(255,255,255,.65);
        }
        .welcome-strip-badge {
            display: flex;
            align-items: center;
            gap: 8px;
            background: rgba(255,255,255,.08);
            border: 1px solid rgba(255,255,255,.12);
            border-radius: var(--r-lg);
            padding: 10px 16px;
            flex-shrink: 0;
        }
        .welcome-strip-badge svg {
            width: 18px; height: 18px; fill: none;
            stroke: var(--yellow); stroke-width: 2;
            stroke-linecap: round; stroke-linejoin: round;
        }
        .welcome-strip-badge span {
            font-size: 12.5px;
            font-weight: 600;
            color: rgba(255,255,255,.8);
        }

        /* ─── ALERTS ───────────────────────────────────────── */
        .alert-profile {
            background: #FFFDF0;
            border: 1.5px solid #FBE89F;
            color: #744210;
            padding: 14px 18px;
            border-radius: var(--r-lg);
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
        }
        .alert-text { font-size: 13px; line-height: 1.5; font-weight: 500; }
        .alert-link {
            background: var(--yellow);
            color: #744210;
            border: none;
            padding: 8px 14px;
            border-radius: var(--r-md);
            font-family: inherit;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
            text-decoration: none;
            white-space: nowrap;
        }
        .alert-success {
            background: #E6F4EA;
            border: 1px solid #B8E2C8;
            color: #137333;
            padding: 12px 16px;
            border-radius: var(--r-md);
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* ─── KPI CARDS ─────────────────────────────────────── */
        .kpi-row {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            margin-bottom: 24px;
        }
        .kpi-card {
            background: var(--white);
            border: 1px solid var(--line);
            border-radius: var(--r-lg);
            padding: 20px;
        }
        .kpi-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 14px;
        }
        .kpi-label {
            font-size: 12px;
            font-weight: 600;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: .05em;
        }
        .kpi-icon {
            width: 34px; height: 34px;
            border-radius: var(--r-md);
            display: flex; align-items: center; justify-content: center;
        }
        .kpi-icon svg {
            width: 17px; height: 17px;
            fill: none; stroke: currentColor;
            stroke-width: 2; stroke-linecap: round; stroke-linejoin: round;
        }
        .kpi-icon.blue   { background: var(--blue-lt); color: var(--blue); }
        .kpi-icon.yellow { background: var(--yellow-lt); color: var(--brown); }
        .kpi-icon.green  { background: var(--green-lt); color: var(--green-dk); }
        .kpi-icon.red    { background: #FFF5F5; color: #C53030; }

        .kpi-number {
            font-size: 28px;
            font-weight: 800;
            color: var(--ink);
            letter-spacing: -.03em;
            line-height: 1;
            margin-bottom: 6px;
        }
        .kpi-sub {
            font-size: 12px;
            color: var(--muted);
            font-weight: 500;
        }
        .kpi-badge {
            display: inline-flex;
            align-items: center;
            gap: 3px;
            font-size: 11px;
            font-weight: 700;
            padding: 2px 7px;
            border-radius: 20px;
        }
        .kpi-badge.up   { background: var(--green-lt); color: var(--green-dk); }
        .kpi-badge.down { background: #FFF5F5; color: #C53030; }
        .kpi-badge.neutral { background: var(--blue-lt); color: var(--blue); }

        /* ─── TWO-COL LAYOUT ─────────────────────────────────── */
        .grid-2col {
            display: grid;
            grid-template-columns: 1fr 360px;
            gap: 20px;
            align-items: start;
        }

        /* ─── SERVICES PANEL ─────────────────────────────────── */
        .panel {
            background: var(--white);
            border: 1px solid var(--line);
            border-radius: var(--r-lg);
        }
        .panel-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 18px 20px 14px;
            border-bottom: 1px solid var(--line);
        }
        .panel-head h2 {
            font-size: 15px;
            font-weight: 800;
            color: var(--ink);
        }
        .panel-head-link {
            font-size: 12px;
            font-weight: 700;
            color: var(--blue);
            text-decoration: none;
        }

        .services-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0;
        }
        .service-card {
            display: flex;
            flex-direction: column;
            gap: 12px;
            padding: 18px;
            border-right: 1px solid var(--line);
            border-bottom: 1px solid var(--line);
            text-decoration: none;
            transition: all .18s;
            position: relative;
            overflow: hidden;
        }
        .service-card:nth-child(2n) { border-right: none; }
        .service-card:nth-last-child(-n+2) { border-bottom: none; }
        .service-card:nth-last-child(1):nth-child(2n+1) { border-bottom: none; border-right: none; grid-column: span 2; }

        .service-card:hover {
            background: var(--surface);
        }
        .service-card:hover .service-arrow {
            opacity: 1;
            transform: translateX(0);
        }
        .service-card-top {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
        }
        .service-icon {
            width: 40px; height: 40px;
            border-radius: var(--r-md);
            display: flex; align-items: center; justify-content: center;
        }
        .service-icon svg {
            width: 19px; height: 19px;
            fill: none; stroke: currentColor;
            stroke-width: 2; stroke-linecap: round; stroke-linejoin: round;
        }
        .service-icon.green  { background: var(--green-lt); color: var(--green-dk); }
        .service-icon.yellow { background: rgba(255,203,5,.12); color: var(--brown); }
        .service-icon.blue   { background: var(--blue-lt); color: var(--blue); }
        .service-icon.orange { background: rgba(211,115,36,.12); color: #D37324; }
        .service-icon.gold   { background: rgba(214,158,46,.1); color: #D69E2E; }

        .service-arrow {
            width: 26px; height: 26px;
            border-radius: 50%;
            background: var(--blue-lt);
            display: flex; align-items: center; justify-content: center;
            opacity: 0;
            transform: translateX(-6px);
            transition: all .18s;
        }
        .service-arrow svg { width: 13px; height: 13px; fill: none; stroke: var(--blue); stroke-width: 2.5; stroke-linecap: round; }

        .service-card h3 {
            font-size: 13.5px;
            font-weight: 700;
            color: var(--ink);
            margin-bottom: 3px;
        }
        .service-card p {
            font-size: 12px;
            color: var(--muted);
            line-height: 1.45;
        }
        .service-count {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            background: var(--blue-lt);
            color: var(--blue);
            font-size: 11px;
            font-weight: 700;
            padding: 3px 8px;
            border-radius: 20px;
            margin-top: 4px;
        }

        /* ─── ACTIVITY PANEL ─────────────────────────────────── */
        .activity-list { padding: 8px 0; }
        .activity-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 12px 18px;
            border-bottom: 1px solid var(--line);
            transition: background .15s;
        }
        .activity-item:last-child { border-bottom: none; }
        .activity-item:hover { background: var(--surface); }
        .activity-dot {
            width: 8px; height: 8px;
            border-radius: 50%;
            margin-top: 5px;
            flex-shrink: 0;
        }
        .activity-dot.blue   { background: var(--blue); }
        .activity-dot.green  { background: var(--green); }
        .activity-dot.yellow { background: var(--brown); }
        .activity-dot.red    { background: #DC2626; }
        .activity-dot.gray   { background: var(--muted); }

        .activity-body {
            flex: 1;
            min-width: 0;
        }
        .activity-title {
            font-size: 13px;
            font-weight: 600;
            color: var(--ink);
            margin-bottom: 2px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .activity-meta {
            font-size: 11.5px;
            color: var(--muted);
        }
        .activity-status {
            flex-shrink: 0;
            font-size: 10.5px;
            font-weight: 700;
            padding: 3px 8px;
            border-radius: 20px;
        }
        .status-pending  { background: var(--yellow-lt); color: #92600A; }
        .status-review   { background: var(--blue-lt); color: var(--blue); }
        .status-approved { background: var(--green-lt); color: var(--green-dk); }
        .status-rejected { background: #FFF5F5; color: #C53030; }

        /* ─── QUICK STATS SIDEBAR ────────────────────────────── */
        .right-col { display: flex; flex-direction: column; gap: 20px; }

        .progress-item {
            padding: 16px 18px;
            border-bottom: 1px solid var(--line);
        }
        .progress-item:last-child { border-bottom: none; }
        .progress-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 8px;
        }
        .progress-head span { font-size: 13px; font-weight: 600; color: var(--ink); }
        .progress-head strong { font-size: 13px; font-weight: 700; color: var(--mid); }
        .progress-bar {
            height: 6px;
            border-radius: 4px;
            background: var(--surface2);
            overflow: hidden;
        }
        .progress-fill {
            height: 100%;
            border-radius: 4px;
            transition: width .5s ease;
        }
        .progress-fill.blue   { background: var(--blue); }
        .progress-fill.green  { background: var(--green); }
        .progress-fill.yellow { background: var(--brown); }
        .progress-fill.red    { background: #DC2626; }

        /* ─── CALENDAR / SCHEDULE PANEL ─────────────────────── */
        .schedule-empty {
            padding: 28px 18px;
            text-align: center;
        }
        .schedule-empty svg {
            width: 36px; height: 36px;
            fill: none; stroke: var(--blue-md);
            stroke-width: 1.5; stroke-linecap: round;
            margin-bottom: 10px;
        }
        .schedule-empty p {
            font-size: 13px;
            color: var(--muted);
            margin-bottom: 12px;
        }
        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: var(--blue);
            color: #fff;
            border: none;
            padding: 9px 16px;
            border-radius: var(--r-md);
            font-family: inherit;
            font-size: 12.5px;
            font-weight: 700;
            cursor: pointer;
            text-decoration: none;
            transition: opacity .18s;
        }
        .btn-primary:hover { opacity: .88; }
        .btn-primary svg { width: 14px; height: 14px; fill: none; stroke: #fff; stroke-width: 2.5; }

        .schedule-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 18px;
            border-bottom: 1px solid var(--line);
        }
        .schedule-item:last-child { border-bottom: none; }
        .schedule-date-box {
            width: 40px; height: 44px;
            border-radius: var(--r-md);
            background: var(--blue-lt);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .schedule-date-box .day {
            font-size: 17px;
            font-weight: 800;
            color: var(--blue);
            line-height: 1;
        }
        .schedule-date-box .month {
            font-size: 9px;
            font-weight: 700;
            color: var(--muted);
            text-transform: uppercase;
        }
        .schedule-info h4 { font-size: 13px; font-weight: 700; color: var(--ink); margin-bottom: 2px; }
        .schedule-info span { font-size: 11.5px; color: var(--muted); }

        /* ─── MOBILE RESPONSIVE ────────────────────────────── */
        .btn-menu {
            display: none;
            background: transparent; border: none; cursor: pointer;
            color: var(--ink); padding: 4px;
        }
        .sidebar-backdrop {
            display: none; position: fixed; inset: 0; background: rgba(0,30,50,.5);
            z-index: 99; opacity: 0; transition: opacity .3s; pointer-events: none;
        }
        @media (max-width: 768px) {
            .btn-menu { display: block; margin-right: 12px; }
            .sidebar { transform: translateX(-100%); transition: transform .3s ease; z-index: 100; }
            .sidebar.open { transform: translateX(0); }
            .sidebar-backdrop.show { display: block; opacity: 1; pointer-events: auto; }
            .main-wrap { margin-left: 0; }
            .topbar { padding: 0 16px; }
            .content { padding: 16px; }
            .stat-grid { grid-template-columns: 1fr; }
            .hero-grid { grid-template-columns: 1fr; }
            .two-col { grid-template-columns: 1fr; }
        }

    </style>
</head>
<body>

    <!-- ─── SIDEBAR ─────────────────────────────── -->
    <div class="sidebar-backdrop" id="sidebar-backdrop"></div>
    <aside class="sidebar" id="sidebar">
        <a href="/dashboard" class="sidebar-logo">
            <div class="sidebar-logo-icon" style="background:transparent;padding:0;overflow:hidden;">
                @if(Auth::user()->isBpn() || Auth::user()->isDpn())
                    <img src="{{ asset('storage/logo/Logo_BPN.png') }}" alt="Logo BPN" style="width:100%;height:100%;object-fit:contain;border-radius:var(--r-md);">
                @else
                    <img src="{{ asset('storage/logo/PatenDummy.jpg') }}" alt="Logo PATEN PAK MIKO" style="width:100%;height:100%;object-fit:cover;border-radius:var(--r-md);">
                @endif
            </div>
            <div class="sidebar-logo-text">
                <strong>PATEN PAK MIKO</strong>
                <span>
                    @if(Auth::user()->isPelakuUsaha()) Kantor Pertanahan Sukabumi
                    @elseif(Auth::user()->isBpn()) Portal Admin BPN
                    @elseif(Auth::user()->isDinasPu()) Portal Dinas PU
                    @elseif(Auth::user()->isSatuPintu()) Portal Satu Pintu
                    @elseif(Auth::user()->isDpn()) Kantor Pertanahan Sukabumi
                    @else Portal Manajemen @endif
                </span>
            </div>
        </a>

        <div class="sidebar-section">
            <div class="sidebar-section-label">Menu Utama</div>
            <a href="/" class="nav-item">
                <svg viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                Beranda
            </a>
            <a href="{{ route('dashboard') }}" class="nav-item active">
                <svg viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
                Dashboard
            </a>
            <a href="{{ route('profile') }}" class="nav-item">
                <svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                Profil Saya
            </a>
        </div>

        <div class="sidebar-section">
            <div class="sidebar-section-label">Layanan</div>
            <a href="{{ route('non-berusaha.index') }}" class="nav-item">
                <svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                PKKPR Non Berusaha
            </a>
            <a href="{{ route('berusaha.index') }}" class="nav-item">
                <svg viewBox="0 0 24 24"><rect x="2" y="3" width="20" height="14" rx="2"/><path d="M8 21h8M12 17v4"/></svg>
                PKKPR Berusaha
            </a>
            <a href="{{ route('kebijakan.index') }}" class="nav-item">
                <svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                Kebijakan Khusus
            </a>
            <a href="{{ route('psn.index') }}" class="nav-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z"/><line x1="4" y1="22" x2="4" y2="15"/></svg>
                PSN
            </a>
            <a href="{{ route('lapolpa.index') }}" class="nav-item">
                <svg viewBox="0 0 24 24"><path d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01"/></svg>
                LAPOLPA
            </a>
            <a href="{{ route('ulasan.index') }}" class="nav-item">
                <svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                Ulasan Layanan
            </a>
        </div>

        @if(Auth::user()->isDpn())
        <div class="sidebar-section">
            <div class="sidebar-section-label">Admin</div>
            <a href="{{ route('dpn.whatsapp') }}" class="nav-item">
                <svg viewBox="0 0 24 24"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
                Integrasi WhatsApp
            </a>
            <a href="{{ route('dpn.contacts') }}" class="nav-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg>
                Kontak Admin Instansi
            </a>
            <a href="{{ route('admin.reviews.index') }}" class="nav-item">
                <svg viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                Kelola Ulasan
            </a>
        </div>
        @endif

        <div class="sidebar-bottom">
            <div class="sidebar-user">
                @if(Auth::user()->profile_photo)
                    <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="Foto Profil" class="sidebar-avatar">
                @else
                    <div class="sidebar-avatar">{{ strtoupper(substr(Auth::user()->username, 0, 2)) }}</div>
                @endif
                <div class="sidebar-user-info">
                    <strong>{{ Auth::user()->name ?? Auth::user()->username }}</strong>
                    <span>{{ Auth::user()->phone_number }}</span>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-logout-sidebar">
                    <svg viewBox="0 0 24 24"><path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                    Keluar dari Akun
                </button>
            </form>
        </div>
    </aside>

    <!-- ─── MAIN WRAP ────────────────────────────── -->
    <div class="main-wrap">

        <!-- Top Bar -->
        <header class="topbar">
            <div style="display:flex; align-items:center;">
                <button class="btn-menu" id="toggle-sidebar">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
                </button>
                <span class="topbar-title">
                    @if(Auth::user()->isPelakuUsaha()) Dashboard Pelaku Usaha
                    @elseif(Auth::user()->isBpn()) Dashboard Admin BPN
                    @elseif(Auth::user()->isDinasPu()) Dashboard Dinas PU
                    @elseif(Auth::user()->isSatuPintu()) Dashboard Satu Pintu
                    @elseif(Auth::user()->isDpn()) Dashboard Admin Pusat
                    @else Dashboard Utama @endif
                </span>
            </div>
            <div class="topbar-right">
                <span class="topbar-date" id="current-date"></span>
                <div class="topbar-notif">
                    <svg viewBox="0 0 24 24"><path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 01-3.46 0"/></svg>
                    <span class="notif-dot"></span>
                </div>
            </div>
        </header>

        <!-- Content -->
        <div class="content">

            @if(session('success'))
                <div class="alert-success">
                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ session('success') }}
                </div>
            @endif

            @php
                $user = Auth::user();
                $isProfileIncomplete = empty($user->name) || empty($user->email) || empty($user->address) || empty($user->business_name) || empty($user->business_role);
                
                // --- Kalkulasi Statistik ---
                if ($user->isPelakuUsaha()) {
                    $totalNon = \App\Models\PpkprApplication::where('user_id', $user->id)->count();
                    $totalBerusaha = \App\Models\PpkprBerusahaApplication::where('user_id', $user->id)->count();
                    $totalKebijakan = \App\Models\KebijakanApplication::where('user_id', $user->id)->count();
                    $countLapolpa = \App\Models\LapolpaBooking::where('user_id', $user->id)->count();

                    $pendingNon = \App\Models\PpkprApplication::where('user_id', $user->id)->whereNotIn('status', ['disetujui', 'ditolak'])->count();
                    $pendingBerusaha = \App\Models\PpkprBerusahaApplication::where('user_id', $user->id)->whereNotIn('status', ['disetujui', 'ditolak'])->count();
                    $pendingKebijakan = \App\Models\KebijakanApplication::where('user_id', $user->id)->whereNotIn('status', ['disetujui', 'ditolak'])->count();

                    $disetujuiNon = \App\Models\PpkprApplication::where('user_id', $user->id)->where('status', 'disetujui')->count();
                    $disetujuiBerusaha = \App\Models\PpkprBerusahaApplication::where('user_id', $user->id)->where('status', 'disetujui')->count();
                    $disetujuiKebijakan = \App\Models\KebijakanApplication::where('user_id', $user->id)->where('status', 'disetujui')->count();

                    $ditolakNon = \App\Models\PpkprApplication::where('user_id', $user->id)->where('status', 'ditolak')->count();
                    $ditolakBerusaha = \App\Models\PpkprBerusahaApplication::where('user_id', $user->id)->where('status', 'ditolak')->count();
                    $ditolakKebijakan = \App\Models\KebijakanApplication::where('user_id', $user->id)->where('status', 'ditolak')->count();
                } else {
                    $totalNon = \App\Models\PpkprApplication::count();
                    $totalBerusaha = \App\Models\PpkprBerusahaApplication::count();
                    $totalKebijakan = \App\Models\KebijakanApplication::count();
                    $countLapolpa = \App\Models\LapolpaBooking::count();

                    $pendingNon = \App\Models\PpkprApplication::whereNotIn('status', ['disetujui', 'ditolak'])->count();
                    $pendingBerusaha = \App\Models\PpkprBerusahaApplication::whereNotIn('status', ['disetujui', 'ditolak'])->count();
                    $pendingKebijakan = \App\Models\KebijakanApplication::whereNotIn('status', ['disetujui', 'ditolak'])->count();

                    $disetujuiNon = \App\Models\PpkprApplication::where('status', 'disetujui')->count();
                    $disetujuiBerusaha = \App\Models\PpkprBerusahaApplication::where('status', 'disetujui')->count();
                    $disetujuiKebijakan = \App\Models\KebijakanApplication::where('status', 'disetujui')->count();

                    $ditolakNon = \App\Models\PpkprApplication::where('status', 'ditolak')->count();
                    $ditolakBerusaha = \App\Models\PpkprBerusahaApplication::where('status', 'ditolak')->count();
                    $ditolakKebijakan = \App\Models\KebijakanApplication::where('status', 'ditolak')->count();
                }

                $totalPermohonan = $totalNon + $totalBerusaha + $totalKebijakan;
                $totalPending = $pendingNon + $pendingBerusaha + $pendingKebijakan;
                $totalDisetujui = $disetujuiNon + $disetujuiBerusaha + $disetujuiKebijakan;
                $totalDitolak = $ditolakNon + $ditolakBerusaha + $ditolakKebijakan;
                
                $countNonBerusaha = $totalNon;
                $countBerusaha = $totalBerusaha;
                $countKebijakan = $totalKebijakan;
                
                // --- Kalkulasi SLA Pengendalian (Hanya untuk Admin) ---
                $slaHijau = 0; $slaKuning = 0; $slaMerah = 0;
                if (!$user->isPelakuUsaha()) {
                    $allPendingNon = \App\Models\PpkprApplication::whereNotIn('status', ['disetujui', 'ditolak', 'terbit_pkpr'])->get();
                    $allPendingBerusaha = \App\Models\PpkprBerusahaApplication::whereNotIn('status', ['disetujui', 'ditolak', 'terbit_pkpr'])->get();
                    $allPendingKebijakan = \App\Models\KebijakanApplication::whereNotIn('status', ['disetujui', 'ditolak', 'terbit_pkpr'])->get();
                    
                    $processSla = function($apps) use (&$slaHijau, &$slaKuning, &$slaMerah) {
                        foreach($apps as $app) {
                            $hari = $app->created_at->diffInDays(now());
                            if($hari <= 8) $slaHijau++;
                            elseif($hari > 8 && $hari <= 10) $slaKuning++;
                            else $slaMerah++;
                        }
                    };
                    
                    $processSla($allPendingNon);
                    $processSla($allPendingBerusaha);
                    $processSla($allPendingKebijakan);
                }
            @endphp

            <!-- Welcome Strip -->
            <div class="welcome-strip">
                <div>
                    <h1>Selamat Datang, {{ $user->name ?? $user->username }}!</h1>
                    <p>
                        @if(Auth::user()->isPelakuUsaha()) Pantau status permohonan dan akses layanan pemanfaatan ruang Anda.
                        @else Kelola permohonan pemanfaatan ruang dan pantau status layanan secara real-time.
                        @endif
                    </p>
                </div>
                <div class="welcome-strip-badge">
                    <svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    <span>
                        @if(Auth::user()->isPelakuUsaha()) Pelaku Usaha Terverifikasi
                        @elseif(Auth::user()->isBpn()) Admin BPN
                        @elseif(Auth::user()->isDinasPu()) Admin Dinas PU
                        @elseif(Auth::user()->isSatuPintu()) Admin Satu Pintu
                        @elseif(Auth::user()->isDpn()) Super Admin
                        @else Pengguna Terverifikasi @endif
                    </span>
                </div>
            </div>

            <!-- Profile Alert -->
            @if($isProfileIncomplete)
                <div class="alert-profile">
                    <div class="alert-text">
                        <strong>Profil belum lengkap</strong> — Lengkapi email, alamat, dan data usaha untuk mempercepat verifikasi dokumen Anda.
                    </div>
                    <a href="{{ route('profile') }}" class="alert-link">Lengkapi Sekarang</a>
                </div>
            @endif

            <!-- KPI Cards -->
            <div class="kpi-row">
                <div class="kpi-card">
                    <div class="kpi-top">
                        <span class="kpi-label">Total Permohonan</span>
                        <div class="kpi-icon blue">
                            <svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                        </div>
                    </div>
                    <div class="kpi-number">{{ $totalPermohonan ?? 0 }}</div>
                    <div class="kpi-sub"><span class="kpi-badge neutral">Semua jenis</span></div>
                </div>
                <div class="kpi-card">
                    <div class="kpi-top">
                        <span class="kpi-label">Menunggu Review</span>
                        <div class="kpi-icon yellow">
                            <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        </div>
                    </div>
                    <div class="kpi-number">{{ $totalPending ?? 0 }}</div>
                    <div class="kpi-sub"><span class="kpi-badge neutral">Dalam proses</span></div>
                </div>
                <div class="kpi-card">
                    <div class="kpi-top">
                        <span class="kpi-label">Disetujui</span>
                        <div class="kpi-icon green">
                            <svg viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                        </div>
                    </div>
                    <div class="kpi-number">{{ $totalDisetujui ?? 0 }}</div>
                    <div class="kpi-sub"><span class="kpi-badge up">↑ Selesai</span></div>
                </div>
                <div class="kpi-card">
                    <div class="kpi-top">
                        <span class="kpi-label">Ditolak</span>
                        <div class="kpi-icon red">
                            <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
                        </div>
                    </div>
                    <div class="kpi-number">{{ $totalDitolak ?? 0 }}</div>
                    <div class="kpi-sub"><span class="kpi-badge down">Perlu tindak lanjut</span></div>
                </div>
            </div>

            @if(!Auth::user()->isPelakuUsaha())
            <!-- ── SLA PENGENDALIAN INTERNAL ──────────────────── -->
            <div style="background:#fff;border:1px solid var(--line);border-radius:var(--r-lg);padding:20px 24px;margin-bottom:20px;">
                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;">
                    <div style="display:flex;align-items:center;gap:10px;">
                        <div style="width:32px;height:32px;border-radius:8px;background:#EEF7E2;display:flex;align-items:center;justify-content:center;">
                            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#16A34A" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        </div>
                        <div>
                            <div style="font-size:13.5px;font-weight:700;color:var(--ink);">Pengendalian SLA — Berkas Aktif</div>
                            <div style="font-size:11.5px;color:var(--muted);">Monitoring internal waktu proses permohonan yang sedang berjalan</div>
                        </div>
                    </div>
                    <div style="font-size:11px;color:var(--muted);background:var(--surface);border-radius:6px;padding:4px 10px;">
                        Total aktif: {{ $slaHijau + $slaKuning + $slaMerah }} berkas
                    </div>
                </div>
                <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:12px;">
                    {{-- Hijau --}}
                    <div style="background:#EEF7E2;border:1.5px solid #16A34A40;border-radius:var(--r-md);padding:16px 20px;display:flex;align-items:center;gap:14px;">
                        <div style="width:42px;height:42px;border-radius:50%;background:#16A34A;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                            <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="2.5"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                        </div>
                        <div>
                            <div style="font-size:28px;font-weight:800;color:#16A34A;line-height:1;">{{ $slaHijau }}</div>
                            <div style="font-size:12px;font-weight:600;color:#4a7c27;margin-top:2px;">≤ 8 Hari — Aman</div>
                        </div>
                    </div>
                    {{-- Kuning --}}
                    <div style="background:#FFFBEB;border:1.5px solid #D9770640;border-radius:var(--r-md);padding:16px 20px;display:flex;align-items:center;gap:14px;">
                        <div style="width:42px;height:42px;border-radius:50%;background:#D97706;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                            <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="2.5"><path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                        </div>
                        <div>
                            <div style="font-size:28px;font-weight:800;color:#D97706;line-height:1;">{{ $slaKuning }}</div>
                            <div style="font-size:12px;font-weight:600;color:#92600A;margin-top:2px;">8–10 Hari — Peringatan</div>
                        </div>
                    </div>
                    {{-- Merah --}}
                    <div style="background:#FFF5F5;border:1.5px solid #DC262640;border-radius:var(--r-md);padding:16px 20px;display:flex;align-items:center;gap:14px;">
                        <div style="width:42px;height:42px;border-radius:50%;background:#DC2626;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                            <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
                        </div>
                        <div>
                            <div style="font-size:28px;font-weight:800;color:#DC2626;line-height:1;">{{ $slaMerah }}</div>
                            <div style="font-size:12px;font-weight:600;color:#9B2C2C;margin-top:2px;">&gt; 10 Hari — Terlambat</div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Two-column grid -->
            <div class="grid-2col">

                <!-- Left: Service modules + Recent activity -->
                <div style="display:flex;flex-direction:column;gap:20px;">

                    <!-- Service Modules -->
                    <div class="panel">
                        <div class="panel-head">
                            <h2>Modul Layanan Pemanfaatan Ruang</h2>
                        </div>
                        <div class="services-grid">

                            <a href="{{ route('non-berusaha.index') }}" class="service-card">
                                <div class="service-card-top">
                                    <div class="service-icon green">
                                        <svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                                    </div>
                                    <div class="service-arrow">
                                        <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                                    </div>
                                </div>
                                <div>
                                    <h3>PKKPR Non Berusaha</h3>
                                    <p>Rumah tinggal, keagamaan, sosial, & fasilitas umum.</p>
                                </div>
                                <span class="service-count">
                                    <svg width="10" height="10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/></svg>
                                    {{ $countNonBerusaha ?? 0 }} permohonan
                                </span>
                            </a>

                            <a href="{{ route('berusaha.index') }}" class="service-card">
                                <div class="service-card-top">
                                    <div class="service-icon yellow">
                                        <svg viewBox="0 0 24 24"><rect x="2" y="3" width="20" height="14" rx="2"/><path d="M8 21h8M12 17v4"/></svg>
                                    </div>
                                    <div class="service-arrow">
                                        <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                                    </div>
                                </div>
                                <div>
                                    <h3>PKKPR Berusaha</h3>
                                    <p>Skala bisnis mikro, kecil, menengah, dan besar.</p>
                                </div>
                                <span class="service-count" style="background:rgba(255,203,5,.12);color:#92600A;">
                                    <svg width="10" height="10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/></svg>
                                    {{ $countBerusaha ?? 0 }} permohonan
                                </span>
                            </a>

                            <a href="{{ route('kebijakan.index') }}" class="service-card">
                                <div class="service-card-top">
                                    <div class="service-icon blue">
                                        <svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                                    </div>
                                    <div class="service-arrow">
                                        <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                                    </div>
                                </div>
                                <div>
                                    <h3>Kebijakan Khusus</h3>
                                    <p>Mandat kebijakan khusus pemerintah.</p>
                                </div>
                                <span class="service-count">
                                    <svg width="10" height="10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/></svg>
                                    {{ $countKebijakan ?? 0 }} permohonan
                                </span>
                            </a>

                            <a href="{{ route('lapolpa.index') }}" class="service-card">
                                <div class="service-card-top">
                                    <!-- Logo Khusus LAPOLPA (Poin 5) -->
                                    <div class="service-icon orange" style="background:transparent;padding:0;overflow:hidden;">
                                        <img src="{{ asset('storage/logo/Dummy.jpg') }}" alt="Logo LAPOLPA" style="width:100%;height:100%;object-fit:cover;border-radius:var(--r-md);">
                                    </div>
                                    <div class="service-arrow">
                                        <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                                    </div>
                                </div>
                                <div>
                                    <h3>LAPOLPA</h3>
                                    <p>Konsultasi & pelaporan pemanfaatan ruang.</p>
                                </div>
                                <span class="service-count" style="background:rgba(211,115,36,.12);color:#8B4513;">
                                    <svg width="10" height="10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M8 6h13M8 12h13"/></svg>
                                    {{ $countLapolpa ?? 0 }} jadwal
                                </span>
                            </a>

                            <a href="{{ route('ulasan.index') }}" class="service-card">
                                <div class="service-card-top">
                                    <div class="service-icon gold">
                                        <svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                                    </div>
                                    <div class="service-arrow">
                                        <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                                    </div>
                                </div>
                                <div>
                                    <h3>Ulasan Layanan</h3>
                                    <p>Beri penilaian dan saran kualitas pelayanan.</p>
                                </div>
                                <span class="service-count" style="background:rgba(214,158,46,.1);color:#92600A;">
                                    <svg width="10" height="10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                                    Berikan ulasan
                                </span>
                            </a>

                            <!-- Konsultasi Informal — Logo Khusus (Poin 5) -->
                            @if(!Auth::user()->isPelakuUsaha())
                            <a href="{{ route('informal.index') }}" class="service-card">
                                <div class="service-card-top">
                                    <div class="service-icon blue" style="background:transparent;padding:0;overflow:hidden;">
                                        <img src="{{ asset('storage/logo/Dummy.jpg') }}" alt="Logo Informal" style="width:100%;height:100%;object-fit:cover;border-radius:var(--r-md);">
                                    </div>
                                    <div class="service-arrow">
                                        <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                                    </div>
                                </div>
                                <div>
                                    <h3>Konsultasi Informal</h3>
                                    <p>Konsultasi pemanfaatan ruang non-formal.</p>
                                </div>
                                <span class="service-count">
                                    <svg width="10" height="10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                                    Layanan Informal
                                </span>
                            </a>
                            @endif

                        </div>
                    </div>

                    <!-- Recent Activity -->
                    <div class="panel">
                        <div class="panel-head">
                            <h2>Aktivitas Terkini</h2>
                            <a href="#" class="panel-head-link">Lihat semua →</a>
                        </div>
                        <div class="activity-list">
                            @forelse($recentActivities ?? [] as $activity)
                                <div class="activity-item">
                                    <span class="activity-dot {{ $activity->status_color ?? 'gray' }}"></span>
                                    <div class="activity-body">
                                        <div class="activity-title">{{ $activity->title }}</div>
                                        <div class="activity-meta">{{ $activity->type }} · {{ $activity->created_at->diffForHumans() }}</div>
                                    </div>
                                    <span class="activity-status status-{{ $activity->status_key ?? 'pending' }}">
                                        {{ $activity->status_label }}
                                    </span>
                                </div>
                            @empty
                                <div class="activity-item" style="padding:24px 18px;justify-content:center;flex-direction:column;text-align:center;gap:8px;">
                                    <svg width="32" height="32" fill="none" viewBox="0 0 24 24" stroke="#B3D4EC" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                                    <span style="font-size:13px;color:var(--muted);">Belum ada aktivitas permohonan.</span>
                                </div>
                            @endforelse
                        </div>
                    </div>

                </div>

                <!-- Right Column -->
                <div class="right-col">

                    <!-- Status Overview -->
                    <div class="panel">
                        <div class="panel-head">
                            <h2>Status Permohonan</h2>
                        </div>
                        <div class="activity-list">
                            @php
                                $total = max(($totalPermohonan ?? 1), 1);
                                $statuses = [
                                    ['label' => 'Disetujui',        'value' => $totalDisetujui ?? 0, 'color' => 'green'],
                                    ['label' => 'Menunggu Review',  'value' => $totalPending ?? 0,   'color' => 'blue'],
                                    ['label' => 'Perlu Revisi',     'value' => $totalRevisi ?? 0,    'color' => 'yellow'],
                                    ['label' => 'Ditolak',          'value' => $totalDitolak ?? 0,   'color' => 'red'],
                                ];
                            @endphp
                            @foreach($statuses as $s)
                                <div class="progress-item">
                                    <div class="progress-head">
                                        <span>{{ $s['label'] }}</span>
                                        <strong>{{ $s['value'] }}</strong>
                                    </div>
                                    <div class="progress-bar">
                                        <div class="progress-fill {{ $s['color'] }}" style="width: {{ $total > 0 ? round($s['value']/$total*100) : 0 }}%"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Upcoming Schedule -->
                    <div class="panel">
                        <div class="panel-head">
                            <h2>Jadwal Konsultasi</h2>
                            <a href="{{ route('lapolpa.index') }}" class="panel-head-link">Kelola →</a>
                        </div>
                        @if(isset($upcomingSchedules) && $upcomingSchedules->count())
                            <div class="activity-list">
                                @foreach($upcomingSchedules as $sched)
                                    <div class="schedule-item">
                                        <div class="schedule-date-box">
                                            <span class="day">{{ $sched->tanggal->format('d') }}</span>
                                            <span class="month">{{ $sched->tanggal->format('M') }}</span>
                                        </div>
                                        <div class="schedule-info">
                                            <h4>{{ $sched->keperluan ?? 'Konsultasi Ruang' }}</h4>
                                            <span>{{ $sched->tanggal->format('H:i') }} WIB · {{ $sched->lokasi ?? 'Online' }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="schedule-empty">
                                <svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                                <p>Belum ada jadwal konsultasi terdaftar.</p>
                                <a href="{{ route('lapolpa.index') }}" class="btn-primary">
                                    <svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                                    Pesan Jadwal
                                </a>
                            </div>
                        @endif
                    </div>

                </div>
            </div>

        </div><!-- /content -->
    </div><!-- /main-wrap -->

    <script>
        const d = new Date();
        const opts = { weekday:'long', year:'numeric', month:'long', day:'numeric' };
        document.getElementById('current-date').textContent = d.toLocaleDateString('id-ID', opts);

        // Sidebar Toggle Logic for Mobile
        const btnToggle = document.getElementById('toggle-sidebar');
        const sidebar = document.getElementById('sidebar');
        const backdrop = document.getElementById('sidebar-backdrop');
        
        btnToggle.addEventListener('click', () => {
            sidebar.classList.add('open');
            backdrop.classList.add('show');
        });
        
        backdrop.addEventListener('click', () => {
            sidebar.classList.remove('open');
            backdrop.classList.remove('show');
        });
    </script>

</body>
</html>