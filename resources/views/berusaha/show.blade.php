<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Permohonan Pertimbangan Teknis Pertanahan PKKPR Berusaha — PATEN PAK MIKO</title>
    <!-- Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/material_blue.css">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
 
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
 
        :root {
            --clr-blue:    #218AC9;
            --clr-blue-dk: #003B64;
            --clr-blue-lt: #E3F0F9;
            --clr-yellow:  #FFCB05;
            --clr-green:   #85C341;
            --clr-green-dk:#79A73A;
            --clr-green-lt:#EEF7E2;
            --clr-ink:     #003B64;
            --clr-mid:     #2C5272;
            --clr-muted:   #7A9BB5;
            --clr-line:    #D6E4EF;
            --clr-surface: #F0F6FB;
            --clr-white:   #FFFFFF;
            --radius-sm:   5px;
            --radius-md:   5px;
            --radius-lg:   5px;
            --radius-xl:   5px;
        }
 
        body {
            font-family: 'Poppins', sans-serif;
            background: var(--clr-surface);
            color: var(--clr-ink);
            min-height: 100vh;
            -webkit-font-smoothing: antialiased;
        }

        fieldset {
            border: none;
            padding: 0;
            margin: 0;
            min-width: 0;
        }
 
        /* ─── CONTAINER: diperlebar, penuhi gap kiri kanan ──── */
        .container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 40px;
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
            text-align: left;
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
 
        /* ─── MAIN CONTENT ───────────────────────────────────── */
        main {
            padding: 40px 0;
        }
 
        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 28px;
        }
        .page-title {
            font-size: 22px;
            font-weight: 800;
            letter-spacing: -0.02em;
            color: var(--clr-ink);
        }
        .back-link {
            font-size: 13px;
            font-weight: 700;
            color: var(--clr-muted);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            transition: color 0.15s;
        }
        .back-link:hover {
            color: var(--clr-ink);
        }
 
        /* ─── SLA BANNER ─────────────────────────────────────── */
        .sla-banner {
            margin-bottom: 24px;
        }
        .sla-item {
            background: #FFF;
            border: 1.5px solid var(--clr-line);
            padding: 16px 20px;
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
        }
        .sla-info {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }
        .sla-title {
            font-size: 11.5px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        .sla-value {
            font-size: 15px;
            font-weight: 800;
            color: var(--clr-ink);
        }
        .sla-desc {
            font-size: 12px;
            font-weight: 600;
            opacity: 0.8;
        }
        .sla-badge {
            font-size: 12px;
            font-weight: 700;
            padding: 6px 14px;
            border-radius: 20px;
            white-space: nowrap;
            display: inline-flex;
            align-items: center;
            gap: 6px;
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
 
        .alert-error {
            background: #FCE8E6;
            border: 1px solid #F5C2C1;
            color: #C5221F;
            padding: 12px 16px;
            border-radius: var(--radius-md);
            font-size: 13.5px;
            font-weight: 600;
            margin-bottom: 28px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
 
        /* ─── GRID LAYOUT ────────────────────────────────────── */
        .layout-grid {
            display: grid;
            grid-template-columns: 1.55fr 1fr;
            gap: 24px;
        }
 
        .card {
            background: var(--clr-white);
            border: 1px solid var(--clr-line);
            border-radius: var(--radius-lg);
            padding: 28px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.01);
            margin-bottom: 32px;
        }
        .card:last-child {
            margin-bottom: 0;
        }
 
        .card-title {
            font-size: 16px;
            font-weight: 800;
            letter-spacing: -0.01em;
            color: var(--clr-ink);
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 1.5px solid var(--clr-surface);
        }
 
        /* ─── DATA TABLE / DETAIL ────────────────────────────── */
        .detail-list {
            list-style: none;
        }
        .detail-item {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px dashed var(--clr-line);
            font-size: 13.5px;
        }
        .detail-item:last-child {
            border-bottom: none;
        }
        .detail-label {
            font-weight: 600;
            color: var(--clr-mid);
        }
        .detail-val {
            font-weight: 700;
            color: var(--clr-ink);
            text-align: right;
        }
        .app-num {
            font-family: 'DM Mono', monospace;
            color: var(--clr-blue);
            font-size: 14px;
        }
 
        .badge-status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 11.5px;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 20px;
            color: white;
        }
 
        /* ─── TIMELINE CARD HEADER (service identifier) ──────── */
        .timeline-card-header {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 22px;
            padding-bottom: 16px;
            border-bottom: 2px solid var(--clr-surface);
        }
        .timeline-service-logo {
            width: 64px;
            height: 64px;
            object-fit: contain;
            background: transparent;
            padding: 0;
            flex-shrink: 0;
            transform: scale(1.6);
        }
        .timeline-service-meta {
            flex: 1;
        }
        .timeline-service-label {
            font-size: 10px;
            font-weight: 700;
            color: var(--clr-blue);
            text-transform: uppercase;
            letter-spacing: 0.08em;
            margin-bottom: 3px;
        }
        .timeline-service-title {
            font-size: 15px;
            font-weight: 800;
            color: var(--clr-ink);
            letter-spacing: -0.01em;
            line-height: 1.2;
        }
        .timeline-step-count {
            font-size: 11px;
            color: var(--clr-muted);
            font-weight: 600;
            margin-top: 3px;
        }

        /* ─── TIMELINE ───────────────────────────────────────── */
        .timeline {
            position: relative;
            padding-left: 38px;
        }
        .timeline::before {
            content: '';
            position: absolute;
            top: 12px;
            left: 10px;
            bottom: 12px;
            width: 2px;
            background: linear-gradient(to bottom, var(--clr-blue) 0%, var(--clr-line) 60%);
            opacity: 0.35;
        }

        .timeline-step {
            position: relative;
            margin-bottom: 10px;
        }
        .timeline-step:last-child {
            margin-bottom: 0;
        }

        /* The dot marker */
        .timeline-dot {
            position: absolute;
            left: -38px;
            top: 10px;
            width: 22px;
            height: 22px;
            border-radius: 50%;
            background: var(--clr-white);
            border: 2px solid var(--clr-line);
            transition: all 0.2s;
            z-index: 2;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0; /* hide ::after text from interfering */
        }

        /* Content bubble per step */
        .timeline-content {
            border-radius: 8px;
            padding: 10px 14px;
            transition: all 0.15s;
            border: 1.5px solid transparent;
        }
        .timeline-step:not(.completed):not(.active):not(.rejected) .timeline-content {
            padding: 6px 0;
        }

        .timeline-title {
            font-size: 13px;
            font-weight: 700;
            color: var(--clr-mid);
            margin-bottom: 2px;
            transition: color 0.2s;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .timeline-desc {
            font-size: 11.5px;
            color: var(--clr-muted);
            line-height: 1.55;
        }

        /* ── COMPLETED ── */
        .timeline-step.completed .timeline-dot {
            background: var(--clr-green);
            border-color: var(--clr-green);
        }
        .timeline-step.completed .timeline-dot::after {
            content: '✓';
            color: white;
            font-size: 12px;
            font-weight: 900;
            line-height: 1;
        }
        .timeline-step.completed .timeline-content {
            background: var(--clr-green-lt);
            border-color: #C6E5A0;
        }
        .timeline-step.completed .timeline-title {
            color: #3A6B1A;
        }
        .timeline-step.completed .timeline-desc {
            color: #558B2F;
        }

        /* ── ACTIVE ── */
        .timeline-step.active .timeline-dot {
            border-color: var(--clr-blue);
            background: var(--clr-white);
            box-shadow: 0 0 0 4px rgba(33, 138, 201, 0.15);
        }
        .timeline-step.active .timeline-dot::after {
            content: '';
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--clr-blue);
            display: block;
        }
        .timeline-step.active .timeline-content {
            background: var(--clr-blue-lt);
            border-color: #9ECCEA;
            box-shadow: 0 2px 8px rgba(33, 138, 201, 0.08);
        }
        .timeline-step.active .timeline-title {
            color: var(--clr-blue);
        }
        .timeline-step.active .timeline-desc {
            color: var(--clr-mid);
        }

        /* ── REJECTED ── */
        .timeline-step.rejected .timeline-dot {
            background: #E53E3E;
            border-color: #E53E3E;
        }
        .timeline-step.rejected .timeline-dot::after {
            content: '✕';
            color: white;
            font-size: 11px;
            font-weight: 800;
            line-height: 1;
        }
        .timeline-step.rejected .timeline-content {
            background: #FFF5F5;
            border-color: #FED7D7;
        }
        .timeline-step.rejected .timeline-title {
            color: #C53030;
        }

        /* Notes inside timeline */
        .timeline-notes {
            margin-top: 8px;
            padding: 7px 10px;
            background: rgba(255,255,255,0.65);
            border-left: 3px solid #E53E3E;
            color: #C53030;
            font-size: 11.5px;
            border-radius: 0 5px 5px 0;
            line-height: 1.5;
        }
        .timeline-step.completed .timeline-notes {
            border-left-color: var(--clr-blue);
            color: var(--clr-mid);
        }

        /* Hover interaction on clickable steps */
        .timeline-step[onclick]:hover .timeline-content {
            filter: brightness(0.97);
        }

        /* ─── DOCK ATTACHMENT / BUTTONS ──────────────────────── */
        .btn-doc {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: var(--clr-blue);
            text-decoration: none;
            font-weight: 700;
            font-size: 13px;
        }
        .btn-doc:hover {
            color: var(--clr-blue-dk);
            text-decoration: underline;
        }
 
        .btn-download-cert {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            background: var(--clr-green);
            color: var(--clr-white);
            padding: 14px;
            border-radius: var(--radius-md);
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
            margin-bottom: 28px;
            box-shadow: 0 4px 14px rgba(149, 185, 62, 0.25);
            transition: all 0.2s;
        }
        .btn-download-cert:hover {
            background: var(--clr-green-dk);
            transform: translateY(-0.5px);
            box-shadow: 0 6px 20px rgba(149, 185, 62, 0.35);
        }
 
        /* ─── PANEL VERIFIKATOR ──────────────────────────────── */
        .verify-card {
            background: var(--clr-white);
            border: 2px solid var(--clr-blue-lt);
            border-radius: var(--radius-lg);
            padding: 24px;
            margin-bottom: 32px;
            box-shadow: 0 4px 16px rgba(19, 147, 204, 0.04);
        }
        .verify-title {
            font-size: 15px;
            font-weight: 800;
            color: var(--clr-blue-dk);
            margin-bottom: 16px;
        }
 
        .form-group-v {
            margin-bottom: 16px;
        }
        .form-group-v label {
            display: block;
            font-size: 12.5px;
            font-weight: 700;
            color: var(--clr-ink);
            margin-bottom: 6px;
        }
        .form-control-v {
            width: 100%;
            padding: 10px 12px;
            font-family: inherit;
            font-size: 13px;
            border: 1.5px solid var(--clr-line);
            border-radius: var(--radius-md);
            outline: none;
            transition: border-color 0.15s;
        }
        .form-control-v:focus {
            border-color: var(--clr-blue);
        }
        .form-select-v {
            width: 100%;
            padding: 10px 12px;
            font-family: inherit;
            font-size: 13px;
            border: 1.5px solid var(--clr-line);
            border-radius: var(--radius-md);
            background: var(--clr-white);
            outline: none;
        }
        .btn-submit-v {
            background: var(--clr-blue);
            color: white;
            border: none;
            padding: 10px 18px;
            font-family: inherit;
            font-weight: 700;
            font-size: 13px;
            border-radius: var(--radius-md);
            cursor: pointer;
            transition: background 0.15s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-top: 14px;
            margin-bottom: 8px;
        }
        .btn-submit-v:hover {
            background: var(--clr-blue-dk);
        }
        
        .verify-step-badge {
            background: var(--clr-blue-lt);
            color: var(--clr-blue-dk);
            font-weight: 700;
            font-size: 10px;
            padding: 2px 6px;
            border-radius: 4px;
            text-transform: uppercase;
            margin-left: 6px;
            letter-spacing: 0.05em;
        }

        /* ─── RESPONSIVE ─────────────────────────────────────── */
        @media (max-width: 900px) {
            .container { padding: 0 20px; }
            .layout-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
 
    <!-- Header -->
    <header>
        <div class="container">
            <div class="header-inner">
                <a href="/dashboard" class="logo-wrap">
                    <div class="logo-icon" style="background: transparent;">
                        <img src="{{ asset('storage/logo/PATEN PAK MIKO LOGO.png') }}" alt="Logo" style="width: 100%; height: 100%; object-fit: contain;">
                    </div>
                    <div class="logo-text">
                        <strong>PATEN PAK MIKO</strong>
                        <span>Kantor Pertanahan Sukabumi</span>
                    </div>
                </a>
 
                <div class="nav-menu">
                    <a href="/" class="nav-link">Beranda</a>
                    <a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a>
                    <a href="{{ route('profile') }}" class="nav-link">Profil Saya</a>
                    
                    <div class="user-nav" style="margin-left: 12px; padding-left: 12px; border-left: 1.5px solid var(--clr-line);">
                        @if(Auth::user()->profile_photo)
                            <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="Foto Profil" class="header-avatar">
                        @else
                            <div class="header-avatar-placeholder">
                                {{ strtoupper(substr(Auth::user()->name ?? Auth::user()->username, 0, 2)) }}
                            </div>
                        @endif
                        <div class="user-badge">
                            <strong>{{ Auth::user()->name ?? Auth::user()->username }}</strong>
                            <span>{{ Auth::user()->phone_number ?? '' }}</span>
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
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if(session('wa_links') && count(session('wa_links')) > 0)
                <div style="background:#E8F5E9;border:1.5px solid #A5D6A7;border-radius:8px;padding:16px 20px;margin-bottom:20px;">
                    <div style="font-size:13px;font-weight:700;color:#1B5E20;margin-bottom:10px;display:flex;align-items:center;gap:8px;">
                        <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/></svg>
                        Kirim Notifikasi WhatsApp Manual
                    </div>
                    <div style="font-size:12px;color:#2E7D32;margin-bottom:12px;">Klik tombol di bawah untuk membuka WhatsApp dan kirim notifikasi ke pihak terkait:</div>
                    <div style="display:flex;flex-wrap:wrap;gap:8px;">
                        @foreach(session('wa_links') as $link)
                            <a href="{{ $link['url'] }}" target="_blank" rel="noopener noreferrer"
                               style="display:inline-flex;align-items:center;gap:6px;background:#25D366;color:#fff;padding:9px 16px;border-radius:6px;text-decoration:none;font-size:13px;font-weight:700;transition:all 0.2s;"
                               onmouseover="this.style.background='#1EBE5A'" onmouseout="this.style.background='#25D366'">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                                Kirim ke {{ $link['target'] }}
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
 
            @if($errors->any())
                <div class="alert-error">
                    <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif
 
            <div class="page-header">
                <div>
                    <h1 class="page-title">Pelacakan Pertimbangan Teknis Pertanahan PKKPR Berusaha</h1>
                </div>
                <a href="{{ route('berusaha.index') }}" class="back-link">
                    <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Kembali ke Dashboard
                </a>
            </div>
 

 
            <!-- DOWNLOAD DOKUMEN FINAL PRODUK AKHIR -->
            @if($application->status === 'disetujui' && $application->satu_pintu_document)
                <a href="{{ asset('storage/' . $application->satu_pintu_document) }}" target="_blank" class="btn-download-cert" style="margin-bottom: 20px;">
                    <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                    Unduh Document Pertimbangan Teknis Pertanahan
                </a>
            @endif
 
            <!-- FITUR ULASAN LAYANAN (ANTI-SPAM) -->
            @if($application->bpn_pertek_document)
                @php
                    $review = \App\Models\Review::where('user_id', Auth::id())
                        ->where('module_type', 'berusaha')
                        ->where('module_id', $application->id)
                        ->first();
                @endphp
 
                @if(Auth::user()->isPelakuUsaha())
                    <div class="verify-card" style="border-color: #CBD5E0; background: #F8FAFC; margin-bottom: 24px; padding: 24px;">
                        <h3 class="verify-title" style="color: var(--clr-primary); margin-bottom: 12px; display: flex; align-items: center; gap: 8px;">
                            ⭐ Ulasan & Penilaian Layanan
                        </h3>
 
                        @if($review)
                            <div style="background: #FFFFFF; border: 1.5px solid var(--clr-line); padding: 16px; border-radius: 10px;">
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                                    <span style="color: #D69E2E; font-size: 16px; font-weight: 700;">
                                        {{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5 - $review->rating) }} 
                                        <span style="color: var(--clr-primary); font-size: 13px; font-weight: 800; margin-left: 6px;">({{ $review->rating_label }})</span>
                                    </span>
                                    @if($review->is_approved)
                                        <span style="font-size: 11px; background: var(--clr-green-light); color: #22543D; padding: 3px 10px; border-radius: 100px; font-weight: 700;">Telah Dipublikasikan</span>
                                    @else
                                        <span style="font-size: 11px; background: #E2E8F0; color: #4A5568; padding: 3px 10px; border-radius: 100px; font-weight: 700;">Menunggu Moderasi Admin</span>
                                    @endif
                                </div>
                                <p style="font-style: italic; font-size: 13px; color: var(--clr-muted);">"{{ $review->comment }}"</p>
                            </div>
                        @else
                            <p style="font-size: 12.5px; color: var(--clr-muted); margin-bottom: 16px;">Silakan berikan ulasan Anda terkait efisiensi pelaporan dan pelayanan kami untuk membantu kami meningkatkan kualitas sistem.</p>
                            <form action="{{ route('review.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="module_type" value="berusaha">
                                <input type="hidden" name="module_id" value="{{ $application->id }}">
                                
                                <div class="form-group-v" style="margin-bottom: 12px;">
                                    <label for="rating" style="font-weight: 700; font-size: 12px;">Penilaian Anda</label>
                                    <select name="rating" id="rating" class="form-select-v" style="padding: 10px;" required>
                                        <option value="5">⭐⭐⭐⭐⭐ Sangat Baik</option>
                                        <option value="4">⭐⭐⭐⭐ Baik</option>
                                        <option value="3">⭐⭐⭐ Cukup Baik</option>
                                        <option value="2">⭐⭐ Kurang</option>
                                        <option value="1">⭐ Sangat Kurang</option>
                                    </select>
                                </div>
 
                                <div class="form-group-v" style="margin-bottom: 16px;">
                                    <label for="comment" style="font-weight: 700; font-size: 12px;">Catatan Ulasan / Feedback</label>
                                    <textarea name="comment" id="comment" class="form-control-v" rows="2" placeholder="Tuliskan saran atau ulasan singkat Anda..." required></textarea>
                                </div>
 
                                <button type="submit" class="btn-submit-v" style="width: auto; padding: 10px 20px; font-size: 12px;">
                                    Kirim Ulasan Layanan
                                </button>
                            </form>
                        @endif
                    </div>
                @endif
            @endif
 
            <!-- LOGIKA DETEKSI TENGGANG WAKTU OTOMATIS BPN -->
            @php
                $user = Auth::user();
                $now = \Carbon\Carbon::now();
                $cekLokasiLewat = $application->bpn_cek_lokasi_dt
                    && $now >= $application->bpn_cek_lokasi_dt;
                $rapatLewat = $application->bpn_rapat_dt
                    && $now >= $application->bpn_rapat_dt;
            @endphp
 
            <!-- ==================================================== -->
            <!-- ─── VERIFICATION PANELS FOR DIFFERENT ROLES ──────── -->
            <!-- ==================================================== -->
 
            <!-- 1. BPN PANEL -->
                    <!-- SUB-STEP 1: Verifikasi Berkas Awal -->
                        <div id="bpn-panel-1" class="bpn-panel-step" style="display: {{ $application->bpn_berkas_status === 'menunggu' ? 'block' : 'none' }};">
                            @php $isStep1Active = (Auth::user()->isBpn() && $application->bpn_berkas_status === 'menunggu'); @endphp
                            <fieldset {{ $isStep1Active ? '' : 'disabled' }}>
                                <form action="{{ route('berusaha.verify', $application->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="step" value="bpn_berkas">
                                    <div style="background:#FFFDF5;border:1px solid #F6AD55;padding:12px 16px;border-radius:8px;font-size:13px;color:#7B341E;margin-bottom:20px;">
                                        <strong>Langkah 1: Verifikasi Kelayakan Dokumen Persyaratan:</strong> Periksa kelengkapan dokumen persyaratan yang diunggah pemohon, lalu terima atau tolak. Notifikasi WA akan terkirim otomatis.
                                    </div>
                                    <div class="form-group-v" style="margin-bottom: 20px;">
                                        <label class="form-label" style="font-weight:700;color:#744210;margin-bottom:8px;display:block;">Tindakan Pemeriksaan Berkas:</label>
                                        <div style="display: flex; gap: 20px;">
                                            <label style="display:flex;align-items:center;gap:6px;font-size:13.5px;font-weight:600;cursor:pointer;">
                                                <input type="radio" name="action" value="approve" required {{ $application->bpn_berkas_status === 'diterima' ? 'checked' : ($application->bpn_berkas_status === 'tidak_sesuai' ? '' : 'checked') }} style="width:16px;height:16px;accent-color:var(--clr-blue);"> Disetujui
                                            </label>
                                            <label style="display:flex;align-items:center;gap:6px;font-size:13.5px;font-weight:600;color:#E53E3E;cursor:pointer;">
                                                <input type="radio" name="action" value="reject" required {{ $application->bpn_berkas_status === 'tidak_sesuai' || $application->bpn_berkas_status === 'ditolak' ? 'checked' : '' }} style="width:16px;height:16px;accent-color:var(--clr-blue);"> Tidak Disetujui / Tidak Lengkap
                                            </label>
                                        </div>
                                    </div>
                                    
                                    <div id="revisi-berkas-container" style="display:none; margin-bottom: 12px; background: #fff5f5; padding: 12px; border: 1px solid #fed7d7; border-radius: 6px;">
                                        <label style="font-weight: 600; font-size: 12px; color: #c53030; margin-bottom: 8px; display: block;">Tandai Berkas yang Tidak Valid / Kurang Lengkap (Otomatis masuk ke catatan):</label>
                                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 6px; font-size: 12px;">
                                            <label><input type="checkbox" class="cb-revisi" value="Formulir PTP"> Formulir PTP</label>
                                            <label><input type="checkbox" class="cb-revisi" value="Peta Lokasi / Sketsa"> Peta Lokasi / Sketsa</label>
                                            <label><input type="checkbox" class="cb-revisi" value="KTP Pemohon"> KTP Pemohon</label>
                                            <label><input type="checkbox" class="cb-revisi" value="NPWP"> NPWP</label>
                                            <label><input type="checkbox" class="cb-revisi" value="Surat Kuasa"> Surat Kuasa</label>
                                            <label><input type="checkbox" class="cb-revisi" value="NIB / KBLI"> NIB / KBLI</label>
                                            <label><input type="checkbox" class="cb-revisi" value="Akta Pendirian"> Akta Pendirian</label>
                                            <label><input type="checkbox" class="cb-revisi" value="Proposal Kegiatan"> Proposal Kegiatan</label>
                                        </div>
                                    </div>
                                    <div class="form-group-v">
                                        <label for="notes">Catatan Pemeriksaan</label>
                                        <textarea name="notes" id="notes" class="form-control-v" rows="3" placeholder="Masukkan catatan atau instruksi perbaikan..." required>{{ $application->bpn_berkas_status !== 'menunggu' ? $application->bpn_notes : '' }}</textarea>
                                    </div>
                                    @if($isStep1Active)
                                        
                                    <div class="form-group-v" style="margin-bottom: 12px; border-top: 1px dashed var(--clr-line); padding-top: 12px; margin-top: 12px;">
                                        <label style="font-size: 11.5px; color: var(--clr-muted); font-weight: 600;">✎ Edit Pesan WA (Opsional):</label>
                                        <textarea name="custom_wa_message" class="form-control-v" rows="2" placeholder="Tuliskan pesan khusus jika ingin mengganti template bawaan otomatis..."></textarea>
                                    </div>
                                    <button type="submit" class="btn-submit-v">Simpan Verifikasi Berkas</button>
                                    @else
                                        <div style="margin-top:12px; font-size:12.5px; color:#c53030; font-weight: 700;">(Tahap ini sudah diselesaikan / dikunci)</div>
                                    @endif
                                </form>
                            </fieldset>
                            @if(Auth::user()->isBpn() && in_array($application->bpn_berkas_status, ['tidak_sesuai', 'ditolak']))
                                <form action="{{ route('berusaha.verify', $application->id) }}" method="POST" style="margin-top: 16px;">
                                    @csrf
                                    <input type="hidden" name="step" value="resend_wa">
                                    <input type="hidden" name="wa_type" value="berkas_verifikasi">
                                    <button type="submit" class="btn-submit-v" style="background: var(--clr-green); width: 100%; justify-content: center;">
                                        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 2L11 13M22 2l-7 20-4-9-9-4 20-7z"/></svg>
                                        Kirim Ulang Notifikasi WhatsApp (Revisi Berkas)
                                    </button>
                                </form>
                            @endif
                        </div>

                        <div id="bpn-panel-2" class="bpn-panel-step" style="display: {{ $application->dinas_pu_status === 'validasi_awal_diterima' && $application->bpn_pembayaran_status === 'belum_bayar' ? 'block' : 'none' }};">
                            @php $isStep2Active = (Auth::user()->isBpn() && $application->dinas_pu_status === 'validasi_awal_diterima' && $application->bpn_pembayaran_status === 'belum_bayar'); @endphp
                            <fieldset {{ $isStep2Active ? '' : 'disabled' }}>
                                <form action="{{ route('berusaha.verify', $application->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="step" value="bpn_pembayaran">
                                    <div style="display: flex; gap: 8px; align-items: center; margin-bottom: 12px;">
                                        <strong style="font-size: 13px;">Langkah 2: Konfirmasi Pembayaran PNBP & Input No. Berkas</strong>
                                    </div>
                                    <p style="font-size: 13px; color: var(--clr-muted); margin-bottom: 16px;">
                                        Setelah pemohon melakukan pembayaran PNBP pertanahan secara offline, input <strong>Nomor Berkas</strong> di bawah lalu klik <strong>"Kirim Kredensial & Konfirmasi Lunas"</strong> untuk memverifikasi dan otomatis mengirimkan kredensial login dashboard ke WhatsApp pemohon.
                                    </p>
                                    <div class="form-group-v">
                                        <label for="no_berkas">Nomor Berkas (wajib diisi)</label>
                                        <input type="text" name="no_berkas" id="no_berkas" class="form-control-v"
                                               placeholder="cth: BERKAS/Pertimbangan Teknis Pertanahan-B/2026/001"
                                               value="{{ $application->no_berkas ?? old('no_berkas') }}" required>
                                        <span style="font-size: 11px; color: var(--clr-muted);">Nomor berkas ini akan dicatat dalam sistem dan dikirim ke pemohon via WhatsApp.</span>
                                    </div>
                                    @if($isStep2Active)
                                        
                                    <div class="form-group-v" style="margin-bottom: 12px; border-top: 1px dashed var(--clr-line); padding-top: 12px; margin-top: 12px;">
                                        <label style="font-size: 11.5px; color: var(--clr-muted); font-weight: 600;">✎ Edit Pesan WA (Opsional):</label>
                                        <textarea name="custom_wa_message" class="form-control-v" rows="2" placeholder="Tuliskan pesan khusus jika ingin mengganti template bawaan otomatis..."></textarea>
                                    </div>
                                        <button type="submit" class="btn-submit-v">
                                            <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 2L11 13M22 2l-7 20-4-9-9-4 20-7z"/></svg>
                                            Kirim Kredensial & Konfirmasi Lunas
                                        </button>
                                    @else
                                        <div style="margin-top:12px; font-size:12.5px; color:#c53030; font-weight: 700;">(Tahap ini sudah diselesaikan)</div>
                                    @endif
                                </form>
                            </fieldset>
                            @if(Auth::user()->isBpn() && $application->bpn_pembayaran_status === 'sudah_bayar')
                                <form action="{{ route('berusaha.verify', $application->id) }}" method="POST" style="margin-top: 16px;">
                                    @csrf
                                    <input type="hidden" name="step" value="resend_wa">
                                    <input type="hidden" name="wa_type" value="credential">
                                    <button type="submit" class="btn-submit-v" style="background: var(--clr-green); width: 100%; justify-content: center;">
                                        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 2L11 13M22 2l-7 20-4-9-9-4 20-7z"/></svg>
                                        Kirim Ulang Notifikasi Kredensial & No. Berkas (WhatsApp)
                                    </button>
                                </form>
                            @endif
                        </div>

                        <div id="bpn-panel-3" class="bpn-panel-step" style="display: {{ $application->bpn_pembayaran_status === 'sudah_bayar' && (!$application->bpn_cek_lokasi_dt || !$cekLokasiLewat) ? 'block' : 'none' }};">
                            @php $isStep3Active = (Auth::user()->isBpn() && $application->bpn_pembayaran_status === 'sudah_bayar' && (!$application->bpn_cek_lokasi_dt || !$cekLokasiLewat)); @endphp
                            <fieldset {{ $isStep3Active ? '' : 'disabled' }}>
                                <form action="{{ route('berusaha.verify', $application->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="step" value="bpn_cek_lokasi">
                                    <div style="display: flex; gap: 8px; align-items: center; margin-bottom: 12px;">
                                        <strong style="font-size: 13px;">Langkah 3: Jadwal Cek Lapangan</strong>
                                    </div>
                                    <div class="form-grid-2">
                                        <div class="form-group-v">
                                            <label for="bpn_cek_lokasi_dt">Tanggal & Waktu Peninjauan</label>
                                            <div style="display:flex; gap:8px;">
                                                <input type="datetime-local" name="bpn_cek_lokasi_dt" id="bpn_cek_lokasi_dt" class="form-control-v" 
                                                       value="{{ $application->bpn_cek_lokasi_dt ? $application->bpn_cek_lokasi_dt->format('Y-m-d\TH:i') : '' }}" style="flex-grow:1;" required>
                                                <button type="button" onclick="let d = new Date(); if(document.getElementById('bpn_cek_lokasi_dt')._flatpickr) document.getElementById('bpn_cek_lokasi_dt')._flatpickr.setDate(d); else document.getElementById('bpn_cek_lokasi_dt').value = new Date(d.getTime() - (d.getTimezoneOffset() * 60000)).toISOString().slice(0,16);" style="background:#e2e8f0; border:1px solid #cbd5e1; padding:0 12px; border-radius:6px; font-size:11px; font-weight:700; color:#475569; cursor:pointer;" title="Set ke waktu saat ini untuk test skip">📍 Sekarang</button>
                                            </div>
                                        </div>
                                        <div class="form-group-v">
                                            <label for="bpn_cek_lokasi_cp">Kontak CP Admin / Petugas</label>
                                            <input type="text" name="bpn_cek_lokasi_cp" id="bpn_cek_lokasi_cp" class="form-control-v" placeholder="cth: Admin BPN (081234567891)" 
                                                   value="{{ $application->bpn_cek_lokasi_cp }}" required>
                                        </div>
                                    </div>
                                    @if($isStep3Active)
                                        
                                    <div class="form-group-v" style="margin-bottom: 12px; border-top: 1px dashed var(--clr-line); padding-top: 12px; margin-top: 12px;">
                                        <label style="font-size: 11.5px; color: var(--clr-muted); font-weight: 600;">✎ Edit Pesan WA (Opsional):</label>
                                        <textarea name="custom_wa_message" class="form-control-v" rows="2" placeholder="Tuliskan pesan khusus jika ingin mengganti template bawaan otomatis..."></textarea>
                                    </div>
                                        <button type="submit" class="btn-submit-v" style="background: {{ $application->bpn_cek_lokasi_dt ? '#D69E2E' : 'var(--clr-blue)' }};">
                                            <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 2L11 13M22 2l-7 20-4-9-9-4 20-7z"/></svg>
                                            {{ $application->bpn_cek_lokasi_dt ? 'Rubah Jadwal & Kirim WA' : 'Kirimkan Jadwal Cek Lokasi' }}
                                        </button>
                                    @else
                                        <div style="margin-top:12px; font-size:12.5px; color:#c53030; font-weight: 700;">(Tahap ini belum aktif atau sudah diselesaikan)</div>
                                    @endif
                                </form>
                            </fieldset>
                            @if(!$isStep3Active && Auth::user()->isBpn() && $application->bpn_cek_lokasi_dt)
                                <form action="{{ route('berusaha.verify', $application->id) }}" method="POST" style="margin-top: 16px;">
                                    @csrf
                                    <input type="hidden" name="step" value="resend_wa">
                                    <input type="hidden" name="wa_type" value="cek_lokasi">
                                    <div style="margin-bottom: 8px;">
                                        <label style="font-size: 11px; color: var(--clr-muted);">Edit Pesan WA (Opsional):</label>
                                        <textarea name="custom_wa_message" class="form-control-v" rows="2" placeholder="Tuliskan pesan khusus jika ingin mengganti template bawaan..."></textarea>
                                    </div>
                                    <button type="submit" class="btn-submit-v" style="background: var(--clr-blue); width: 100%; justify-content: center;">
                                        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 2L11 13M22 2l-7 20-4-9-9-4 20-7z"/></svg>
                                </form>
                            @endif
                        </div>

                        <div id="bpn-panel-4" class="bpn-panel-step" style="display: {{ $application->bpn_cek_lokasi_dt && $cekLokasiLewat && (!$application->bpn_rapat_dt || !$rapatLewat) ? 'block' : 'none' }};">
                            @php $isStep4Active = (Auth::user()->isBpn() && $application->bpn_cek_lokasi_dt && $cekLokasiLewat && (!$application->bpn_rapat_dt || !$rapatLewat)); @endphp
                            <fieldset {{ $isStep4Active ? '' : 'disabled' }}>
                                <form action="{{ route('berusaha.verify', $application->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="step" value="bpn_rapat">
                                    <div style="display: flex; gap: 8px; align-items: center; margin-bottom: 12px;">
                                        <strong style="font-size: 13px;">Langkah 4: Jadwal Sidang / Rapat Koordinasi</strong>
                                    </div>
                                    <div class="form-group-v">
                                        <label for="bpn_rapat_dt">Tanggal & Waktu Rapat</label>
                                        <div style="display:flex; gap:8px;">
                                            <input type="datetime-local" name="bpn_rapat_dt" id="bpn_rapat_dt" class="form-control-v" 
                                                   value="{{ $application->bpn_rapat_dt ? $application->bpn_rapat_dt->format('Y-m-d\TH:i') : '' }}" style="flex-grow:1;" required>
                                            <button type="button" onclick="let d = new Date(); if(document.getElementById('bpn_rapat_dt')._flatpickr) document.getElementById('bpn_rapat_dt')._flatpickr.setDate(d); else document.getElementById('bpn_rapat_dt').value = new Date(d.getTime() - (d.getTimezoneOffset() * 60000)).toISOString().slice(0,16);" style="background:#e2e8f0; border:1px solid #cbd5e1; padding:0 12px; border-radius:6px; font-size:11px; font-weight:700; color:#475569; cursor:pointer;" title="Set ke waktu saat ini untuk test skip">📍 Sekarang</button>
                                        </div>
                                    </div>
                                    @if($isStep4Active)
                                        
                                    <div class="form-group-v" style="margin-bottom: 12px; border-top: 1px dashed var(--clr-line); padding-top: 12px; margin-top: 12px;">
                                        <label style="font-size: 11.5px; color: var(--clr-muted); font-weight: 600;">✎ Edit Pesan WA (Opsional):</label>
                                        <textarea name="custom_wa_message" class="form-control-v" rows="2" placeholder="Tuliskan pesan khusus jika ingin mengganti template bawaan otomatis..."></textarea>
                                    </div>
                                        <button type="submit" class="btn-submit-v" style="background: {{ $application->bpn_rapat_dt ? '#D69E2E' : 'var(--clr-blue)' }};">
                                            <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 2L11 13M22 2l-7 20-4-9-9-4 20-7z"/></svg>
                                            {{ $application->bpn_rapat_dt ? 'Rubah Jadwal Rapat & Kirim WA' : 'Kirimkan Jadwal Rapat' }}
                                        </button>
                                    @else
                                        <div style="margin-top:12px; font-size:12.5px; color:#c53030; font-weight: 700;">(Tahap ini belum aktif atau sudah diselesaikan)</div>
                                    @endif
                                </form>
                            </fieldset>
                            @if(!$isStep4Active && Auth::user()->isBpn() && $application->bpn_rapat_dt)
                                <form action="{{ route('berusaha.verify', $application->id) }}" method="POST" style="margin-top: 16px;">
                                    @csrf
                                    <input type="hidden" name="step" value="resend_wa">
                                    <input type="hidden" name="wa_type" value="rapat">
                                    <div style="margin-bottom: 8px;">
                                        <label style="font-size: 11px; color: var(--clr-muted);">Edit Pesan WA (Opsional):</label>
                                        <textarea name="custom_wa_message" class="form-control-v" rows="2" placeholder="Tuliskan pesan khusus jika ingin mengganti template bawaan..."></textarea>
                                    </div>
                                    <button type="submit" class="btn-submit-v" style="background: var(--clr-blue); width: 100%; justify-content: center;">
                                        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 2L11 13M22 2l-7 20-4-9-9-4 20-7z"/></svg>
                                        Kirim Ulang Jadwal Sidang/Rapat (WhatsApp)
                                    </button>
                                </form>
                            @endif
                        </div>

                        <div id="bpn-panel-5" class="bpn-panel-step" style="display: {{ $application->bpn_rapat_dt && $rapatLewat && !$application->bpn_pertek_document ? 'block' : 'none' }};">
                            @php $isStep5Active = (Auth::user()->isBpn() && $application->bpn_rapat_dt && $rapatLewat && !$application->bpn_pertek_document); @endphp
                            <fieldset {{ $isStep5Active ? '' : 'disabled' }}>
                                <form action="{{ route('berusaha.verify', $application->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="step" value="bpn_pertek">
                                    <div style="display: flex; gap: 8px; align-items: center; margin-bottom: 12px;">
                                        <strong style="font-size: 13px;">Langkah 5: Penerbitan Pertek Pertanahan</strong>
                                    </div>
                                    <div class="form-group-v">
                                        <label for="action">Tindakan Rekomendasi Teknis</label>
                                        <select name="action" id="action" class="form-select-v" required>
                                            <option value="approve" {{ $application->bpn_pertek_document || $application->status === 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                                            <option value="reject" {{ $application->status === 'ditolak' && !$application->bpn_pertek_document && $application->bpn_berkas_status === 'diterima' ? 'selected' : '' }}>Tidak Disetujui</option>
                                        </select>
                                    </div>
                                    @if($application->bpn_pertek_document)
                                        <div class="form-group-v">
                                            <label for="bpn_pertek_document">Dokumen Pertek / Rekomendasi (PDF)</label>
                                            <a href="{{ asset('storage/' . $application->bpn_pertek_document) }}" target="_blank" style="display:inline-flex; align-items:center; gap:8px; padding:8px 16px; background:#f1f5f9; border:1px solid #cbd5e1; border-radius:6px; color:#0f172a; font-size:13px; font-weight:600; text-decoration:none; margin-top:4px; transition:all 0.2s;" onmouseover="this.style.background='#e2e8f0'" onmouseout="this.style.background='#f1f5f9'">
                                                <svg viewBox="0 0 24 24" width="16" height="16" stroke="currentColor" stroke-width="2" fill="none"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                                                Lihat Dokumen Terunggah
                                            </a>
                                        </div>
                                    @else
                                        <div class="form-group-v">
                                            <label for="bpn_pertek_document">Dokumen Surat Pertek (PDF)</label>
                                            <input type="file" name="bpn_pertek_document" id="bpn_pertek_document" class="form-control-v" accept=".pdf">
                                            <span style="font-size: 11px; color: var(--clr-muted);">*Wajib diunggah jika permohonan disetujui. Maksimal 10MB.</span>
                                        </div>
                                    @endif
                                    <div class="form-group-v">
                                        <label for="notes">Catatan Pertimbangan Teknis BPN</label>
                                        <textarea name="notes" id="notes" class="form-control-v" rows="3" placeholder="Masukkan ringkasan kajian tata ruang pertanahan..." required>{{ $application->status === 'disetujui' || ($application->status === 'ditolak' && !$application->bpn_pertek_document && $application->bpn_berkas_status === 'diterima') ? $application->bpn_notes : '' }}</textarea>
                                    </div>
                                    @if($isStep5Active)
                                        
                                    <div class="form-group-v" style="margin-bottom: 12px; border-top: 1px dashed var(--clr-line); padding-top: 12px; margin-top: 12px;">
                                        <label style="font-size: 11.5px; color: var(--clr-muted); font-weight: 600;">✎ Edit Pesan WA (Opsional):</label>
                                        <textarea name="custom_wa_message" class="form-control-v" rows="2" placeholder="Tuliskan pesan khusus jika ingin mengganti template bawaan otomatis..."></textarea>
                                    </div>
                                    <button type="submit" class="btn-submit-v">Kirim Pertek Pertanahan</button>
                                    @else
                                        <div style="margin-top:12px; font-size:12.5px; color:#c53030; font-weight: 700;">(Tahap ini belum aktif atau sudah diselesaikan)</div>
                                    @endif
                                </form>
                            </fieldset>
                        </div>
                        
                        <script>
                            function showBpnPanel(stepNum) {
                                document.querySelectorAll('.bpn-panel-step').forEach(function(el) {
                                    el.style.display = 'none';
                                });
                                var target = document.getElementById('bpn-panel-' + stepNum);
                                if(target) {
                                    target.style.display = 'block';
                                    target.scrollIntoView({ behavior: 'smooth', block: 'center' });
                                }
                            }
                        </script>

            <!-- 2. DINAS PU PANEL -->
            @if($user->isDinasPu() && $application->status === 'menunggu_dinas_pu')
                @if($application->dinas_pu_status === 'menunggu_validasi_awal')
                    <div class="verify-card" style="border-color: var(--clr-blue); background: #FAFDFE;">
                        <h3 class="verify-title">🏢 Panel Validasi Permohonan Awal — Dinas PUTR</h3>
                        <form action="{{ route('berusaha.verify', $application->id) }}" method="POST">
                            @csrf
                            <div class="form-group-v">
                                <label for="action">Hasil Validasi Permohonan</label>
                                <select name="action" id="action" class="form-select-v" required>
                                    <option value="approve">Disetujui</option>
                                    <option value="reject">Tidak Disetujui</option>
                                </select>
                            </div>
                            <div class="form-group-v">
                                <label for="notes">Catatan Hasil Validasi</label>
                                <textarea name="notes" id="notes" class="form-control-v" rows="3" placeholder="Masukkan detail alasan/catatan validasi awal..." required></textarea>
                            </div>
                            
                                    <div class="form-group-v" style="margin-bottom: 12px; border-top: 1px dashed var(--clr-line); padding-top: 12px; margin-top: 12px;">
                                        <label style="font-size: 11.5px; color: var(--clr-muted); font-weight: 600;">✎ Edit Pesan WA (Opsional):</label>
                                        <textarea name="custom_wa_message" class="form-control-v" rows="2" placeholder="Tuliskan pesan khusus jika ingin mengganti template bawaan otomatis..."></textarea>
                                    </div>
                            <button type="submit" class="btn-submit-v">Kirim Validasi Awal</button>
                        </form>
                    </div>
                @else
                    <div class="verify-card">
                        <h3 class="verify-title">⚙️ Panel Penilaian Pertimbangan Teknis Pertanahan — Dinas Pekerjaan Umum (PU)</h3>
                        <form action="{{ route('berusaha.verify', $application->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group-v">
                                <label for="action">Penilaian Kepatuhan Tata Ruang</label>
                                <select name="action" id="action" class="form-select-v" required>
                                    <option value="sesuai">Sesuai Tata Ruang (Lanjut ke Dinas Satu Pintu / PTSP)</option>
                                    <option value="belum_sesuai">Belum Sesuai Tata Ruang (Kembali ke BPN)</option>
                                </select>
                            </div>
                            <div class="form-grid-2" style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                                <div class="form-group-v">
                                    <label for="dinas_pu_tanggal_penilaian">Tanggal Penilaian (Wajib)</label>
                                    <input type="date" name="dinas_pu_tanggal_penilaian" id="dinas_pu_tanggal_penilaian" class="form-control-v" required>
                                </div>
                                <div class="form-group-v">
                                    <label for="dinas_pu_document">Dokumen Penilaian Tata Ruang (PDF, Opsional)</label>
                                    <input type="file" name="dinas_pu_document" id="dinas_pu_document" class="form-control-v" accept=".pdf">
                                    <span style="font-size: 11px; color: var(--clr-muted);">*File yang diunggah hanya dapat diakses oleh BPN.</span>
                                </div>
                            </div>
                            <div class="form-group-v">
                                <label for="notes">Catatan Kajian Penilaian Tata Ruang (Opsional)</label>
                                <textarea name="notes" id="notes" class="form-control-v" rows="3" placeholder="Masukkan catatan tambahan justifikasi kesesuaian pemanfaatan ruang..."></textarea>
                            </div>
                            
                                    <div class="form-group-v" style="margin-bottom: 12px; border-top: 1px dashed var(--clr-line); padding-top: 12px; margin-top: 12px;">
                                        <label style="font-size: 11.5px; color: var(--clr-muted); font-weight: 600;">✎ Edit Pesan WA (Opsional):</label>
                                        <textarea name="custom_wa_message" class="form-control-v" rows="2" placeholder="Tuliskan pesan khusus jika ingin mengganti template bawaan otomatis..."></textarea>
                                    </div>
                            <button type="submit" class="btn-submit-v">Kirim Penilaian PU</button>
                        </form>
                    </div>
                @endif
            @endif
 
            <!-- 3. DINAS SATU PINTU (PTSP) PANEL -->
            @if($user->isSatuPintu() && $application->status === 'menunggu_satu_pintu')
                <div class="verify-card">
                    <h3 class="verify-title">🏛️ Panel Penerbitan Dokumen Akhir — Dinas Satu Pintu (PTSP)</h3>
                    <form action="{{ route('berusaha.verify', $application->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-grid-2">
                            <div class="form-group-v">
                                <label for="satu_pintu_no_pkkpr">Nomor Pertimbangan Teknis Pertanahan PKKPR Berusaha</label>
                                <input type="text" name="satu_pintu_no_pkkpr" id="satu_pintu_no_pkkpr" class="form-control-v" placeholder="cth: 503/Pertimbangan Teknis Pertanahan-B/2026/XYZ" required>
                            </div>
                            <div class="form-group-v">
                                <label for="satu_pintu_tanggal_terbit">Tanggal Terbit</label>
                                <input type="date" name="satu_pintu_tanggal_terbit" id="satu_pintu_tanggal_terbit" class="form-control-v" required>
                            </div>
                        </div>
                        <div class="form-group-v">
                            <label for="satu_pintu_document">Dokumen Produk Akhir Pertimbangan Teknis Pertanahan (PDF)</label>
                            <input type="file" name="satu_pintu_document" id="satu_pintu_document" class="form-control-v" accept=".pdf" required>
                            <span style="font-size: 11px; color: var(--clr-muted);">*Wajib mengunggah Dokumen Pertek Pertanahan/SK Pertimbangan Teknis Pertanahan PKKPR Berusaha hasil akhir. Maksimal 10MB.</span>
                        </div>
                        <div class="form-group-v">
                            <label for="notes">Catatan Tambahan (Opsional)</label>
                            <textarea name="notes" id="notes" class="form-control-v" rows="2" placeholder="Masukkan keterangan tambahan jika ada..."></textarea>
                        </div>
                        
                                    <div class="form-group-v" style="margin-bottom: 12px; border-top: 1px dashed var(--clr-line); padding-top: 12px; margin-top: 12px;">
                                        <label style="font-size: 11.5px; color: var(--clr-muted); font-weight: 600;">✎ Edit Pesan WA (Opsional):</label>
                                        <textarea name="custom_wa_message" class="form-control-v" rows="2" placeholder="Tuliskan pesan khusus jika ingin mengganti template bawaan otomatis..."></textarea>
                                    </div>
                        <button type="submit" class="btn-submit-v">
                            <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 2L11 13M22 2l-7 20-4-9-9-4 20-7z"/></svg>
                            Kirim & Tuntaskan Permohonan
                        </button>
                    </form>
                </div>
            @endif
 
            <!-- 4. PELAKU USAHA ACTION: REUPLOAD JIKA BERKAS TIDAK SESUAI -->
            @if($user->isPelakuUsaha() && $application->status === 'menunggu_bpn' && $application->bpn_berkas_status === 'tidak_sesuai')
                <div class="verify-card" style="border-color: #F5C2C1; background: #FFF5F5;">
                    <h3 class="verify-title" style="color: #C5221F;">⚠️ Perbaikan Dokumen Persyaratan Diperlukan</h3>
                    <p style="font-size: 13px; color: #7F2321; margin-bottom: 16px;">
                        Petugas BPN menyatakan berkas Anda belum sesuai dengan catatan: <br>
                        <strong>"{{ $application->bpn_notes }}"</strong>
                    </p>
                    <form action="{{ route('berusaha.verify', $application->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="step" value="reupload">
                        <div class="form-group-v" style="margin-bottom: 8px;">
                            <label for="peta_lokasi">1. Peta/sketsa lokasi</label>
                            <input type="file" name="peta_lokasi" id="peta_lokasi" class="form-control-v" accept=".pdf,.jpg,.jpeg,.png">
                        </div>
                        <div class="form-group-v" style="margin-bottom: 8px;">
                            <label for="surat_kuasa">2. Surat kuasa</label>
                            <input type="file" name="surat_kuasa" id="surat_kuasa" class="form-control-v" accept=".pdf,.jpg,.jpeg,.png">
                        </div>
                        <div class="form-group-v" style="margin-bottom: 8px;">
                            <label for="fc_ktp">3. FC KTP</label>
                            <input type="file" name="fc_ktp" id="fc_ktp" class="form-control-v" accept=".pdf,.jpg,.jpeg,.png">
                        </div>
                        <div class="form-group-v" style="margin-bottom: 8px;">
                            <label for="fc_npwp">4. FC NPWP</label>
                            <input type="file" name="fc_npwp" id="fc_npwp" class="form-control-v" accept=".pdf,.jpg,.jpeg,.png">
                        </div>
                        <div class="form-group-v" style="margin-bottom: 8px;">
                            <label for="fc_akta_pendirian">5. FC Akta Pendirian & Pengesahan Badan Hukum</label>
                            <input type="file" name="fc_akta_pendirian" id="fc_akta_pendirian" class="form-control-v" accept=".pdf,.jpg,.jpeg,.png">
                        </div>
                        <div class="form-group-v" style="margin-bottom: 8px;">
                            <label for="rencana_penggunaan_tanah">6. Rencana Penggunaan Tanah</label>
                            <input type="file" name="rencana_penggunaan_tanah" id="rencana_penggunaan_tanah" class="form-control-v" accept=".pdf,.jpg,.jpeg,.png">
                        </div>
                        <div class="form-group-v" style="margin-bottom: 8px;">
                            <label for="nib">7. NIB</label>
                            <input type="file" name="nib" id="nib" class="form-control-v" accept=".pdf,.jpg,.jpeg,.png">
                        </div>
                        <div class="form-group-v" style="margin-bottom: 8px;">
                            <label for="kbli">8. KBLI</label>
                            <input type="file" name="kbli" id="kbli" class="form-control-v" accept=".pdf,.jpg,.jpeg,.png">
                        </div>
                        <div class="form-group-v" style="margin-bottom: 12px;">
                            <label for="proposal_kegiatan">9. Proposal Kegiatan</label>
                            <input type="file" name="proposal_kegiatan" id="proposal_kegiatan" class="form-control-v" accept=".pdf,.doc,.docx">
                        </div>
                        <div class="form-group-v" style="margin-bottom: 12px;">
                            <label for="persyaratan_lainnya">10. Persyaratan Lainnya (Opsional)</label>
                            <input type="file" name="persyaratan_lainnya" id="persyaratan_lainnya" class="form-control-v" accept=".pdf,.jpg,.jpeg,.png,.zip,.rar">
                        </div>
                        <button type="submit" class="btn-submit-v" style="background: #C5221F;">Kirim Berkas Perbaikan</button>
                    </form>
                </div>
            @endif
 
            <!-- 5. PELAKU USAHA ACTION: BLAST NOTIF KE BPN -->
            @if($user->isPelakuUsaha() && $application->status === 'menunggu_bpn' && $application->bpn_berkas_status === 'diterima' && $application->bpn_pembayaran_status === 'belum_bayar')
                <div class="verify-card" style="border-color: #B8E2C8; background: #F4FBF7;">
                    <h3 class="verify-title" style="color: #137333;">✓ Berkas Valid! Langkah Selanjutnya</h3>
                    <p style="font-size: 13px; color: #137333; margin-bottom: 16px;">
                        Berkas awal Anda telah disetujui BPN. Silakan tekan tombol di bawah untuk men-trigger verifikasi pembayaran dan mengirimkan notifikasi ke BPN.
                    </p>
                    <form action="{{ route('berusaha.verify', $application->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="step" value="blast_notif">
                        <button type="submit" class="btn-submit-v" style="background: var(--clr-green);">
                            <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 2L11 13M22 2l-7 20-4-9-9-4 20-7z"/></svg>
                            Kirim Notifikasi Verifikasi Pembayaran
                        </button>
                    </form>
                </div>
            @endif
 
            <div class="layout-grid">
                
                <!-- Left: Application Details -->
                <div>
                    <div class="card">
                        <h2 class="card-title">Informasi Identitas Pemohon / Pengguna Layanan</h2>
                        
                        <ul class="detail-list">
                            <li class="detail-item">
                                <span class="detail-label">Nomor Registrasi</span>
                                <span class="detail-val app-num">{{ $application->application_number }}</span>
                            </li>
                            <li class="detail-item">
                                <span class="detail-label">Status Utama</span>
                                <span class="detail-val" style="display: flex; align-items: center; gap: 8px;">
                                    <span class="badge-status" style="background-color: {{ $application->status_color }};">
                                        {{ $application->status_label }}
                                    </span>
                                </span>
                            </li>
                            <li class="detail-item">
                                <span class="detail-label">Nama Pemilik Usaha</span>
                                <span class="detail-val">{{ $application->nama_pemilik_usaha }}</span>
                            </li>
                            <li class="detail-item">
                                <span class="detail-label">Nama Pemohon / Pengguna Layanan</span>
                                <span class="detail-val">{{ $application->nama_pengaju }}</span>
                            </li>
                            <li class="detail-item">
                                <span class="detail-label">Hubungan Pengaju</span>
                                <span class="detail-val">{{ $application->hubungan_pengaju }}</span>
                            </li>
                            <li class="detail-item">
                                <span class="detail-label">Tanggal Pengajuan</span>
                                <span class="detail-val">{{ $application->created_at->format('d-m-Y, H:i') }} WIB</span>
                            </li>
                            
                            <!-- BPN Info -->
                            <li class="detail-item">
                                <span class="detail-label">Kelayakan Berkas (BPN)</span>
                                <span class="detail-val" style="text-transform: capitalize; font-weight: 700;">
                                    {{ str_replace('_', ' ', $application->bpn_berkas_status) }}
                                </span>
                            </li>
                            <li class="detail-item">
                                <span class="detail-label">Status Pembayaran</span>
                                <span class="detail-val" style="text-transform: capitalize; font-weight: 700; color: {{ $application->bpn_pembayaran_status === 'sudah_bayar' ? 'var(--clr-green)' : '#E53E3E' }}">
                                    {{ str_replace('_', ' ', $application->bpn_pembayaran_status) }}
                                </span>
                            </li>

                            @if($application->no_berkas)
                                <li class="detail-item">
                                    <span class="detail-label">Nomor Berkas</span>
                                    <span class="detail-val" style="font-weight: 700; color: var(--clr-blue-dk);">{{ $application->no_berkas }}</span>
                                </li>
                            @endif
 
                            @if($application->bpn_pertek_document)
                                <li class="detail-item">
                                    <span class="detail-label">Dokumen Pertek BPN</span>
                                    <span class="detail-val">
                                        <a href="{{ asset('storage/' . $application->bpn_pertek_document) }}" target="_blank" class="btn-doc">
                                            Unduh Surat Pertek
                                        </a>
                                    </span>
                                </li>
                            @endif
 
                            <!-- Dinas PU Info -->
                            @if($application->status !== 'menunggu_bpn')
                                <li class="detail-item">
                                    <span class="detail-label">Penilaian Tata Ruang (PU)</span>
                                    <span class="detail-val" style="text-transform: capitalize; font-weight: 700;">
                                        {{ str_replace('_', ' ', $application->dinas_pu_status) }}
                                    </span>
                                </li>
                            @endif

                            @if($application->dinas_pu_tanggal_penilaian)
                                <li class="detail-item">
                                    <span class="detail-label">Tanggal Penilaian PU</span>
                                    <span class="detail-val" style="font-weight: 700;">{{ $application->dinas_pu_tanggal_penilaian->format('d-m-Y') }}</span>
                                </li>
                            @endif

                            @if($user->isBpn() && $application->dinas_pu_document)
                                <li class="detail-item">
                                    <span class="detail-label">Dokumen Penilaian PU</span>
                                    <span class="detail-val">
                                        <a href="{{ asset('storage/' . $application->dinas_pu_document) }}" target="_blank" class="btn-doc">
                                            Unduh Dokumen Penilaian PU
                                        </a>
                                    </span>
                                </li>
                            @endif
 
                            <!-- Satu Pintu Info -->
                            @if($application->satu_pintu_no_pkkpr)
                                <li class="detail-item">
                                    <span class="detail-label">Nomor Pertimbangan Teknis Pertanahan</span>
                                    <span class="detail-val">{{ $application->satu_pintu_no_pkkpr }}</span>
                                </li>
                            @endif
 
                            <li class="detail-item" style="display: flex; flex-direction: column; gap: 8px;">
                                <span class="detail-label" style="border-bottom: 1px solid var(--clr-line); padding-bottom: 8px; margin-bottom: 4px;">Berkas Lampiran Persyaratan</span>
                                
                                @if($application->ptp_data)
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <span style="font-size: 13px; color: var(--clr-mid); font-weight: 500;">Formulir PTP</span>
                                    <a href="{{ route('berusaha.ptp_pdf', $application->id) }}" target="_blank" class="btn-doc">Buka Berkas</a>
                                </div>
                                @endif
                                
                                @if($application->peta_lokasi)
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <span style="font-size: 13px; color: var(--clr-mid);">1. Peta Lokasi</span>
                                    <a href="{{ asset('storage/' . $application->peta_lokasi) }}" target="_blank" class="btn-doc">Buka Berkas</a>
                                </div>
                                @endif

                                @if($application->surat_kuasa)
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <span style="font-size: 13px; color: var(--clr-mid);">2. Surat Kuasa</span>
                                    <a href="{{ asset('storage/' . $application->surat_kuasa) }}" target="_blank" class="btn-doc">Buka Berkas</a>
                                </div>
                                @endif

                                @if($application->fc_ktp)
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <span style="font-size: 13px; color: var(--clr-mid);">3. FC KTP</span>
                                    <a href="{{ asset('storage/' . $application->fc_ktp) }}" target="_blank" class="btn-doc">Buka Berkas</a>
                                </div>
                                @endif

                                @if($application->fc_npwp)
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <span style="font-size: 13px; color: var(--clr-mid);">4. FC NPWP</span>
                                    <a href="{{ asset('storage/' . $application->fc_npwp) }}" target="_blank" class="btn-doc">Buka Berkas</a>
                                </div>
                                @endif

                                @if($application->fc_akta_pendirian)
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <span style="font-size: 13px; color: var(--clr-mid);">5. FC Akta Pendirian</span>
                                    <a href="{{ asset('storage/' . $application->fc_akta_pendirian) }}" target="_blank" class="btn-doc">Buka Berkas</a>
                                </div>
                                @endif

                                @if($application->rencana_penggunaan_tanah)
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <span style="font-size: 13px; color: var(--clr-mid);">6. Rencana Penggunaan Tanah</span>
                                    <a href="{{ asset('storage/' . $application->rencana_penggunaan_tanah) }}" target="_blank" class="btn-doc">Buka Berkas</a>
                                </div>
                                @endif

                                @if($application->nib)
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <span style="font-size: 13px; color: var(--clr-mid);">7. NIB</span>
                                    <a href="{{ asset('storage/' . $application->nib) }}" target="_blank" class="btn-doc">Buka Berkas</a>
                                </div>
                                @endif

                                @if($application->kbli)
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <span style="font-size: 13px; color: var(--clr-mid);">8. KBLI</span>
                                    <a href="{{ asset('storage/' . $application->kbli) }}" target="_blank" class="btn-doc">Buka Berkas</a>
                                </div>
                                @endif

                                @if($application->proposal_kegiatan)
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <span style="font-size: 13px; color: var(--clr-mid);">9. Proposal Kegiatan</span>
                                    <a href="{{ asset('storage/' . $application->proposal_kegiatan) }}" target="_blank" class="btn-doc">Buka Berkas</a>
                                </div>
                                @endif
                                @if($application->persyaratan_lainnya)
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <span style="font-size: 13px; color: var(--clr-mid);">10. Persyaratan Lainnya</span>
                                    <a href="{{ asset('storage/' . $application->persyaratan_lainnya) }}" target="_blank" class="btn-doc">Buka Berkas</a>
                                </div>
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
 
                <!-- Right: Timeline -->
                <div>
                    <!-- DAY COUNTER / SLA BANNER -->
                    @php
                        $targetDate = $application->created_at->addWeekdays(10);
                        
                        if ($application->status === 'disetujui' || $application->status === 'ditolak' || $application->bpn_pertek_document) {
                            $slaColor = '#0F5132';
                            $slaBg = '#D1E7DD';
                            $slaBorder = '#BADBCC';
                            $badgeText = '✅ Selesai Tepat Waktu';
                            $badgeBg = '#198754';
                            $badgeColor = '#FFFFFF';
                        } else {
                            $now = \Carbon\Carbon::now();
                            if ($targetDate->startOfDay() >= $now->startOfDay()) {
                                $daysRemaining = $now->startOfDay()->diffInWeekdays($targetDate->startOfDay());
                            } else {
                                $daysRemaining = -1 * $targetDate->startOfDay()->diffInWeekdays($now->startOfDay());
                            }
                            
                            if ($daysRemaining >= 4) {
                                $slaColor = '#0F5132';
                                $slaBg = '#D1E7DD';
                                $slaBorder = '#BADBCC';
                                $badgeText = '⏳ ' . $daysRemaining . ' Hari Tersisa';
                                $badgeBg = '#198754';
                                $badgeColor = '#FFFFFF';
                            } elseif ($daysRemaining >= 0) {
                                $slaColor = '#664D03';
                                $slaBg = '#FFF3CD';
                                $slaBorder = '#FFECB5';
                                $badgeText = '⚠️ ' . $daysRemaining . ' Hari Tersisa';
                                $badgeBg = '#FFC107';
                                $badgeColor = '#000000';
                            } else {
                                $slaColor = '#842029';
                                $slaBg = '#F8D7DA';
                                $slaBorder = '#F5C2C7';
                                $badgeText = '🚨 Terlambat ' . abs($daysRemaining) . ' Hari';
                                $badgeBg = '#DC3545';
                                $badgeColor = '#FFFFFF';
                            }
                        }
                    @endphp
                    <div class="sla-banner">
                        <div class="sla-item" style="background-color: {{ $slaBg }}; border-color: {{ $slaBorder }}; color: {{ $slaColor }};">
                            <div class="sla-info">
                                <div class="sla-title">Batas Waktu (Kantor Pertanahan)</div>
                                <div class="sla-value">Target: {{ $targetDate->format('d M Y') }}</div>
                                <div class="sla-desc">Batas waktu penyelesaian Pertek adalah 10 Hari Kerja.</div>
                            </div>
                            <div class="sla-badge" style="background-color: {{ $badgeBg }}; color: {{ $badgeColor }};">
                                {{ $badgeText }}
                            </div>
                        </div>
                    </div>

                    <div class="card" style="position: sticky; top: 88px;">

                        <!-- ── SERVICE IDENTIFIER HEADER ── -->
                        <div class="timeline-card-header">
                            <img
                                src="{{ asset('storage/logo/PKKPR.png') }}"
                                alt="Logo Pertimbangan Teknis Pertanahan PKKPR Berusaha"
                                class="timeline-service-logo"
                                onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                            >
                            <!-- Fallback jika logo tidak ditemukan -->
                            <div style="display:none; width:56px; height:56px; border-radius:10px; background:var(--clr-blue); align-items:center; justify-content:center; flex-shrink:0;">
                                <svg width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="white" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            </div>
                            <div class="timeline-service-meta">
                                <div class="timeline-service-label">Pelacakan Permohonan</div>
                                <div class="timeline-service-title">Pertimbangan Teknis Pertanahan PKKPR Berusaha</div>
                                <div class="timeline-step-count">8 Tahapan · 3 Instansi</div>
                            </div>
                        </div>

                        <div class="timeline">

                            <!-- STEP 0: Diajukan -->
                            <div class="timeline-step completed">
                                <span class="timeline-dot"></span>
                                <div class="timeline-content">
                                    <div class="timeline-title">Berkas Berhasil Diajukan</div>
                                    <div class="timeline-desc">Berkas persyaratan dan formulir permohonan berhasil diunggah ke portal.</div>
                                    <div style="font-size:11px;color:#558B2F;margin-top:5px;font-weight:600;">📅 {{ $application->created_at->locale('id')->translatedFormat('l, d M Y · H:i') }} WIB</div>
                                </div>
                            </div>

                            <!-- STEP 1: Verifikasi Berkas Awal BPN -->
                            @php
                                $step2Status = 'active';
                                if ($application->bpn_berkas_status === 'diterima') {
                                    $step2Status = 'completed';
                                } elseif ($application->bpn_berkas_status === 'tidak_sesuai') {
                                    $step2Status = 'rejected';
                                }
                            @endphp
                            <div class="timeline-step {{ $step2Status }}" onclick="showBpnPanel(1)" style="cursor:pointer;">
                                <span class="timeline-dot"></span>
                                <div class="timeline-content">
                                    <div class="timeline-title">
                                        1. Verifikasi Berkas Awal
                                        <span style="font-size: 10px; font-weight: 600; color: var(--clr-muted); background: rgba(0,0,0,0.05); padding: 1px 6px; border-radius: 10px;">BPN</span>
                                    </div>
                                    <div class="timeline-desc">Validasi kelengkapan berkas dokumen persyaratan pemohon.</div>
                                    @if($application->bpn_berkas_status === 'diterima' && $application->bpn_berkas_approved_at)
                                        <div style="font-size:11px;color:#558B2F;margin-top:6px;font-weight:600;">✅ Disetujui pada: {{ \Carbon\Carbon::parse($application->bpn_berkas_approved_at)->format('d M Y, H:i') }} WIB</div>
                                    @endif
                                    @if($application->bpn_berkas_status === 'tidak_sesuai')
                                        <div class="timeline-notes">
                                            <strong>Catatan Koreksi:</strong> {{ $application->bpn_notes }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- STEP 2: Validasi Permohonan Awal - Dinas PUTR -->
                            @php
                                $step3Status = '';
                                if ($application->bpn_berkas_status === 'diterima') {
                                    if ($application->dinas_pu_status === 'validasi_awal_diterima' || in_array($application->dinas_pu_status, ['menunggu_penilaian', 'sesuai', 'belum_sesuai'])) {
                                        $step3Status = 'completed';
                                    } elseif ($application->dinas_pu_status === 'validasi_awal_ditolak') {
                                        $step3Status = 'rejected';
                                    } else {
                                        $step3Status = 'active';
                                    }
                                }
                            @endphp
                            <div class="timeline-step {{ $step3Status }}" onclick="showBpnPanel('pu-1')" style="cursor:pointer;">
                                <span class="timeline-dot"></span>
                                <div class="timeline-content">
                                    <div class="timeline-title">
                                        2. Validasi Permohonan
                                        <span style="font-size: 10px; font-weight: 600; color: var(--clr-muted); background: rgba(0,0,0,0.05); padding: 1px 6px; border-radius: 10px;">Dinas PUTR</span>
                                    </div>
                                    <div class="timeline-desc">Pemeriksaan awal kelayakan tata ruang. Notifikasi dikirim ke BPN dan Pelaku Usaha.</div>
                                    @if(in_array($application->dinas_pu_status, ['validasi_awal_diterima', 'sesuai', 'belum_sesuai']) && $application->dinas_pu_approved_at)
                                        <div style="font-size:11px;color:#558B2F;margin-top:6px;font-weight:600;">✅ Disetujui pada: {{ \Carbon\Carbon::parse($application->dinas_pu_approved_at)->format('d M Y, H:i') }} WIB</div>
                                    @endif
                                    @if($application->dinas_pu_status === 'validasi_awal_ditolak')
                                        <div class="timeline-notes">
                                            <strong>Ditolak pada tahap validasi awal oleh Dinas PUTR.</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- STEP 3: Pembayaran PNBP -->
                            @php
                                $step4Status = '';
                                if (in_array($application->dinas_pu_status, ['validasi_awal_diterima', 'sesuai', 'belum_sesuai', 'menunggu_penilaian'])) {
                                    $step4Status = $application->bpn_pembayaran_status === 'sudah_bayar' ? 'completed' : 'active';
                                }
                            @endphp
                            <div class="timeline-step {{ $step4Status }}" onclick="showBpnPanel(2)" style="cursor:pointer;">
                                <span class="timeline-dot"></span>
                                <div class="timeline-content">
                                    <div class="timeline-title">
                                        3. Pembayaran PNBP & Registrasi
                                        <span style="font-size: 10px; font-weight: 600; color: var(--clr-muted); background: rgba(0,0,0,0.05); padding: 1px 6px; border-radius: 10px;">BPN</span>
                                    </div>
                                    <div class="timeline-desc">
                                        @if($application->bpn_pembayaran_status === 'sudah_bayar')
                                            Pembayaran dikonfirmasi lunas. Kredensial dashboard dikirim ke WhatsApp pemohon.
                                            @if($application->no_berkas)
                                                <br>No. Berkas: <strong>{{ $application->no_berkas }}</strong>
                                            @endif
                                        @else
                                            Menunggu konfirmasi pembayaran PNBP dan input nomor berkas oleh BPN.
                                        @endif
                                    </div>
                                    @if($application->bpn_pembayaran_status === 'sudah_bayar' && $application->bpn_pembayaran_approved_at)
                                        <div style="font-size:11px;color:#558B2F;margin-top:5px;font-weight:600;">📅 {{ \Carbon\Carbon::parse($application->bpn_pembayaran_approved_at)->locale('id')->translatedFormat('l, d M Y · H:i') }} WIB</div>
                                    @endif
                                </div>
                            </div>

                            <!-- STEP 4: Peninjauan Lapangan -->
                            @php
                                $step5Status = '';
                                if ($application->bpn_pembayaran_status === 'sudah_bayar') {
                                    $step5Status = $application->bpn_cek_lokasi_dt ? ($cekLokasiLewat ? 'completed' : 'active') : 'active';
                                }
                            @endphp
                            <div class="timeline-step {{ $step5Status }}" onclick="showBpnPanel(3)" style="cursor:pointer;">
                                <span class="timeline-dot"></span>
                                <div class="timeline-content">
                                    <div class="timeline-title">
                                        4. Peninjauan Lapangan
                                        <span style="font-size: 10px; font-weight: 600; color: var(--clr-muted); background: rgba(0,0,0,0.05); padding: 1px 6px; border-radius: 10px;">BPN</span>
                                    </div>
                                    <div class="timeline-desc">
                                        @if($application->bpn_cek_lokasi_dt)
                                            Tinjau: <strong>{{ $application->bpn_cek_lokasi_date }}</strong><br>Petugas: <strong>{{ $application->bpn_cek_lokasi_cp }}</strong>
                                        @else
                                            Menunggu jadwal peninjauan lapangan dari BPN.
                                        @endif
                                    </div>
                                    @if($application->bpn_cek_lokasi_dt)
                                        <div style="font-size:11px;color:#558B2F;margin-top:5px;font-weight:600;">📅 Dijadwalkan: {{ \Carbon\Carbon::parse($application->bpn_cek_lokasi_dt)->locale('id')->translatedFormat('l, d M Y · H:i') }} WIB</div>
                                    @endif
                                </div>
                            </div>

                            <!-- STEP 5: Rapat Pembahasan Pertek -->
                            @php
                                $step6Status = '';
                                if ($cekLokasiLewat) {
                                    $step6Status = $application->bpn_rapat_dt ? ($rapatLewat ? 'completed' : 'active') : 'active';
                                }
                            @endphp
                            <div class="timeline-step {{ $step6Status }}" onclick="showBpnPanel(4)" style="cursor:pointer;">
                                <span class="timeline-dot"></span>
                                <div class="timeline-content">
                                    <div class="timeline-title">
                                        5. Rapat Pembahasan Pertek
                                        <span style="font-size: 10px; font-weight: 600; color: var(--clr-muted); background: rgba(0,0,0,0.05); padding: 1px 6px; border-radius: 10px;">BPN</span>
                                    </div>
                                    <div class="timeline-desc">
                                        @if($application->bpn_rapat_dt)
                                            Waktu Sidang: <strong>{{ $application->bpn_rapat_date }}</strong>
                                        @else
                                            Menunggu jadwal sidang/rapat koordinasi teknis pertanahan.
                                        @endif
                                    </div>
                                    @if($application->bpn_rapat_dt)
                                        <div style="font-size:11px;color:#558B2F;margin-top:5px;font-weight:600;">📅 Dijadwalkan: {{ \Carbon\Carbon::parse($application->bpn_rapat_dt)->locale('id')->translatedFormat('l, d M Y · H:i') }} WIB</div>
                                    @endif
                                </div>
                            </div>

                            <!-- STEP 6: Penerbitan Pertek Pertanahan -->
                            @php
                                $step7Status = '';
                                if ($application->bpn_rapat_dt) {
                                    if ($application->bpn_pertek_document) {
                                        $step7Status = 'completed';
                                    } elseif (isset($application->bpn_pertek_status) && $application->bpn_pertek_status === 'ditolak') {
                                        $step7Status = 'rejected';
                                    } else {
                                        $step7Status = 'active';
                                    }
                                }
                            @endphp
                            <div class="timeline-step {{ $step7Status }}" onclick="showBpnPanel(5)" style="cursor:pointer;">
                                <span class="timeline-dot"></span>
                                <div class="timeline-content">
                                    <div class="timeline-title">
                                        6. Penerbitan Pertek Pertanahan
                                        <span style="font-size: 10px; font-weight: 600; color: var(--clr-muted); background: rgba(0,0,0,0.05); padding: 1px 6px; border-radius: 10px;">BPN</span>
                                    </div>
                                    <div class="timeline-desc">
                                        @if($application->bpn_pertek_document)
                                            Pertimbangan Teknis Pertanahan Sudah Diterbitkan Dan Diteruskan Ke Dinas PUTR Untuk Penilian PKKPR
                                        @else
                                            Menunggu penerbitan surat rekomendasi teknis pertanahan.
                                        @endif
                                    </div>
                                    @if($application->bpn_pertek_uploaded_at)
                                        <div style="font-size:11px;color:#558B2F;margin-top:5px;font-weight:600;">📅 {{ \Carbon\Carbon::parse($application->bpn_pertek_uploaded_at)->locale('id')->translatedFormat('l, d M Y · H:i') }} WIB</div>
                                    @endif
                                </div>
                            </div>

                            <!-- STEP 7: Penilaian Pertimbangan Teknis Pertanahan Dinas PU -->
                            @php
                                $step8Status = '';
                                if ($application->bpn_pertek_document) {
                                    if ($application->dinas_pu_status === 'sesuai') {
                                        $step8Status = 'completed';
                                    } elseif ($application->dinas_pu_status === 'belum_sesuai') {
                                        $step8Status = 'rejected';
                                    } elseif ($application->status === 'menunggu_dinas_pu') {
                                        $step8Status = 'active';
                                    }
                                }
                            @endphp
                            <div class="timeline-step {{ $step8Status }}" onclick="showBpnPanel('pu-2')" style="cursor:pointer;">
                                <span class="timeline-dot"></span>
                                <div class="timeline-content">
                                    <div class="timeline-title">
                                        7. Penilaian PKKPR Berusaha 
                                        <span style="font-size: 10px; font-weight: 600; color: var(--clr-muted); background: rgba(0,0,0,0.05); padding: 1px 6px; border-radius: 10px;">Dinas PU</span>
                                    </div>
                                    <div class="timeline-desc">Penilaian PKKPR Oleh Dinas PUTR</div>
                                    @if(in_array($application->dinas_pu_status, ['sesuai', 'belum_sesuai']))
                                        @if($application->dinas_pu_tanggal_penilaian)
                                            <div class="timeline-notes" style="border-left-color: {{ $application->dinas_pu_status === 'sesuai' ? 'var(--clr-green)' : '#E53E3E' }}; background: {{ $application->dinas_pu_status === 'sesuai' ? '#F4FBF7' : '#FFF5F5' }}; color: {{ $application->dinas_pu_status === 'sesuai' ? '#137333' : '#C53030' }}">
                                                <strong>Tanggal Penilaian:</strong> {{ $application->dinas_pu_tanggal_penilaian->format('d-m-Y') }}
                                                @if($application->dinas_pu_notes)
                                                    <br><strong>Catatan:</strong> {{ $application->dinas_pu_notes }}
                                                @endif
                                            </div>
                                        @elseif($application->dinas_pu_notes)
                                            <div class="timeline-notes" style="border-left-color: {{ $application->dinas_pu_status === 'sesuai' ? 'var(--clr-green)' : '#E53E3E' }}; background: {{ $application->dinas_pu_status === 'sesuai' ? '#F4FBF7' : '#FFF5F5' }}; color: {{ $application->dinas_pu_status === 'sesuai' ? '#137333' : '#C53030' }}">
                                                <strong>Catatan Dinas PU:</strong> {{ $application->dinas_pu_notes }}
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            </div>

                            <!-- STEP 8: Penerbitan Pertimbangan Teknis Pertanahan Satu Pintu -->
                            @php
                                $step9Status = '';
                                if ($application->dinas_pu_status === 'sesuai') {
                                    $step9Status = $application->satu_pintu_document ? 'completed' : 'active';
                                }
                            @endphp
                            <div class="timeline-step {{ $step9Status }}" onclick="showBpnPanel('satu-pintu')" style="cursor:pointer;">
                                <span class="timeline-dot"></span>
                                <div class="timeline-content">
                                    <div class="timeline-title">
                                        8. Penerbitan PKKPR Berusaha
                                        <span style="font-size: 10px; font-weight: 600; color: var(--clr-muted); background: rgba(0,0,0,0.05); padding: 1px 6px; border-radius: 10px;">Satu Pintu / PTSP</span>
                                    </div>
                                    <div class="timeline-desc">DPMPTSP menerbitkan dokumen  PKKPR Berusaha</div>
                                    @if($application->satu_pintu_no_pkkpr)
                                        <div class="timeline-notes" style="border-left-color: var(--clr-green); background: #F4FBF7; color: #137333;">
                                            <strong>No. Pertimbangan Teknis Pertanahan:</strong> {{ $application->satu_pintu_no_pkkpr }}
                                        </div>
                                    @endif
                                    @if($application->satu_pintu_tanggal_terbit)
                                        <div style="font-size:11px;color:#558B2F;margin-top:5px;font-weight:600;">📅 Terbit: {{ \Carbon\Carbon::parse($application->satu_pintu_tanggal_terbit)->locale('id')->translatedFormat('l, d M Y') }}</div>
                                    @endif
                                </div>
                            </div>

                            <!-- STEP FINAL: Selesai / Ditolak -->
                            @php
                                $doneStepStatus = '';
                                if ($application->status === 'disetujui') {
                                    $doneStepStatus = 'completed';
                                } elseif ($application->status === 'ditolak') {
                                    $doneStepStatus = 'rejected';
                                }
                            @endphp
                            <div class="timeline-step {{ $doneStepStatus }}">
                                <span class="timeline-dot"></span>
                                <div class="timeline-content">
                                    <div class="timeline-title">
                                        @if($application->status === 'ditolak')
                                            Permohonan Ditolak
                                        @else
                                            Permohonan Selesai & Disetujui
                                        @endif
                                    </div>
                                    <div class="timeline-desc">
                                        @if($application->status === 'ditolak')
                                            Permohonan dihentikan oleh instansi terkait (BPN, Dinas PUTR, atau Dinas PU).
                                        @elseif($application->status === 'disetujui')
                                            Seluruh alur selesai. Dokumen Pertimbangan Teknis Pertanahan PKKPR Berusaha siap diunduh dari portal.
                                        @else
                                            Menunggu seluruh tahapan disetujui oleh semua instansi terkait.
                                        @endif
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
 
            </div>
        </div>
    </main>
 
    <!-- Flatpickr JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/id.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const penilaianInput = document.getElementById('dinas_pu_tanggal_penilaian');
            if (penilaianInput) {
                flatpickr(penilaianInput, {
                    dateFormat: "Y-m-d",
                    altInput: true,
                    altFormat: "d-m-Y",
                    locale: "id",
                    allowInput: true
                });
            }

            const tanggalTerbitInput = document.getElementById('satu_pintu_tanggal_terbit');
            if (tanggalTerbitInput) {
                flatpickr(tanggalTerbitInput, {
                    dateFormat: "Y-m-d",
                    altInput: true,
                    altFormat: "d-m-Y",
                    locale: "id",
                    allowInput: true
                });
            }

            const cekLokasiInput = document.getElementById('bpn_cek_lokasi_dt');
            if (cekLokasiInput) {
                flatpickr(cekLokasiInput, {
                    enableTime: true,
                    time_24hr: true,
                    dateFormat: "Y-m-d H:i",
                    altInput: true,
                    altFormat: "d-m-Y H:i",
                    locale: "id",
                    allowInput: true
                });
            }

            const rapatInput = document.getElementById('bpn_rapat_dt');
            if (rapatInput) {
                flatpickr(rapatInput, {
                    enableTime: true,
                    time_24hr: true,
                    dateFormat: "Y-m-d H:i",
                    altInput: true,
                    altFormat: "d-m-Y H:i",
                    locale: "id",
                    allowInput: true
                });
            }
        });
    </script>

    <script>
document.addEventListener("DOMContentLoaded", function() {
    const revisiContainer = document.getElementById("revisi-berkas-container");
    const actionInputs = revisiContainer ? revisiContainer.closest('form').querySelectorAll("select[name='action'], input[type='radio'][name='action']") : document.querySelectorAll("select[name='action'], input[type='radio'][name='action']");
    const notesField = revisiContainer ? revisiContainer.closest('form').querySelector("textarea[name='notes']") : document.getElementById("notes");
    const checkboxes = document.querySelectorAll(".cb-revisi");

    function updateRevisiVisibility() {
        let isReject = false;
        actionInputs.forEach(input => {
            input.addEventListener("change", updateRevisiVisibility);
        });
        
        updateRevisiVisibility();

        checkboxes.forEach(cb => {
            cb.addEventListener("change", function() {
                let selected = Array.from(checkboxes).filter(i => i.checked).map(i => "- " + i.value);
                let currentNote = notesField.value.replace(/Berkas yang harus diperbaiki:\n(- .*\n?)+\n\n/g, "").replace(/Berkas yang harus diperbaiki:\n(- .*\n?)+/g, "").trim();
                
                if (selected.length > 0) {
                    notesField.value = "Berkas yang harus diperbaiki:\n" + selected.join("\n") + "\n\n" + currentNote;
                } else {
                    notesField.value = currentNote;
                }
            });
        });
    });
    </script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const textareas = document.querySelectorAll('textarea[name="custom_wa_message"]');
    textareas.forEach(ta => {
        const form = ta.closest('form');
        let waTypeInput = form.querySelector('input[name="wa_type"]');
        let waTypeValue = waTypeInput ? waTypeInput.value : null;

        if (!waTypeValue) {
            const stepInput = form.querySelector('input[name="step"]');
            if (stepInput) {
                const step = stepInput.value;
                if (step === 'berkas_verifikasi') waTypeValue = 'berkas_verifikasi';
                else if (step === 'pembayaran_lunas') waTypeValue = 'credential';
                else if (step === 'cek_lokasi') waTypeValue = 'cek_lokasi';
                else if (step === 'rapat') waTypeValue = 'rapat';
                else if (step === 'pertek') waTypeValue = 'pertek_terbit';
                else if (step === 'putr') waTypeValue = 'putr_validasi';
                else if (step === 'pu') waTypeValue = 'pu_selesai';
                else if (step === 'pkkpr') waTypeValue = 'pkkpr_terbit';
            }
        }

        if (!waTypeValue) {
            const html = form.innerHTML;
            if (html.includes('name="bpn_berkas_notes"') || html.includes('Simpan Verifikasi Berkas')) waTypeValue = 'berkas_verifikasi';
            else if (html.includes('name="sps_bpn"') || html.includes('Kirim Kredensial')) waTypeValue = 'credential';
            else if (html.includes('name="bpn_lokasi_notes"') || html.includes('Kirimkan Jadwal Cek Lokasi')) waTypeValue = 'cek_lokasi';
            else if (html.includes('name="bpn_rapat_notes"') || html.includes('Simpan Hasil Rapat')) waTypeValue = 'rapat';
            else if (html.includes('name="pertek_notes"') || html.includes('Kirim Pertek Pertanahan')) waTypeValue = 'pertek_terbit';
            else if (html.includes('name="dinas_pu_notes"') || html.includes('Kirim Validasi Awal')) waTypeValue = 'putr_validasi';
            else if (html.includes('name="dinas_pu_penilaian_notes"') || html.includes('Kirim Penilaian PU')) waTypeValue = 'pu_selesai';
            else if (html.includes('name="ptsp_notes"') || html.includes('Terbitkan Pertimbangan Teknis Pertanahan')) waTypeValue = 'pkkpr_terbit';
            else waTypeValue = 'berkas_verifikasi';
        }

        if (waTypeValue) {
            ta.readOnly = true;
            ta.disabled = true; // Disable so it doesn't send the prefilled text if not manually edited
            ta.style.backgroundColor = '#f4f7f9';
            ta.style.color = '#555';
            ta.rows = 7;
            ta.style.minHeight = '160px';
            
            const btn = document.createElement('button');
            btn.type = 'button';
            btn.className = 'btn-edit-wa';
            btn.innerHTML = '✏️ Rubah Pesan WA';
            btn.style.cssText = 'display:inline-block; margin-bottom:8px; background:#3291A8; color:#fff; border:none; padding:6px 12px; border-radius:4px; font-size:12px; font-weight:600; cursor:pointer;';
            
            ta.parentNode.insertBefore(btn, ta);
            
            btn.addEventListener('click', function() {
                ta.readOnly = false;
                ta.disabled = false; // Re-enable for submission
                ta.style.backgroundColor = '#fff';
                ta.style.color = '#000';
                ta.focus();
                btn.style.display = 'none'; 
            });
            
            let type = '';
            if(window.location.pathname.includes('berusaha')) type = 'berusaha';
            if(window.location.pathname.includes('non-berusaha')) type = 'non_berusaha';
            if(window.location.pathname.includes('kebijakan')) type = 'kebijakan';
            if(window.location.pathname.includes('tanah-timbul')) type = 'tanah_timbul';
            if(window.location.pathname.includes('psn')) type = 'psn';
            
            const appId = window.location.pathname.split('/').pop();
            
            const fetchTemplate = (actionOverride = null) => {
                if(type && appId && !isNaN(appId)) {
                    let url = `/api/wa-template?type=${type}&id=${appId}&wa_type=${waTypeValue}`;
                    if (actionOverride) {
                        url += `&action=${actionOverride}`;
                    }
                    fetch(url)
                        .then(res => res.json())
                        .then(data => {
                            if(data.template) {
                                ta.value = data.template;
                            }
                        })
                        .catch(err => console.error('Gagal fetch template', err));
                }
            };

            // Fetch initial
            let initialAction = null;
            const checkedRadio = form.querySelector('input[type="radio"][name="action"]:checked');
            const selectedSelect = form.querySelector('select[name="action"]');
            if (checkedRadio) {
                initialAction = checkedRadio.value;
            } else if (selectedSelect) {
                initialAction = selectedSelect.value;
            }
            fetchTemplate(initialAction);

            // Listen to radio changes
            const actionRadios = form.querySelectorAll('input[type="radio"][name="action"]');
            actionRadios.forEach(radio => {
                radio.addEventListener('change', function() {
                    fetchTemplate(this.value);
                });
            });

            // Listen to select changes
            const actionSelects = form.querySelectorAll('select[name="action"]');
            actionSelects.forEach(sel => {
                sel.addEventListener('change', function() {
                    fetchTemplate(this.value);
                });
            });
        }
    });
});
</script>
</body>
</html>