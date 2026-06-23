<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Permohonan {{ $application->application_number }} — PATEN PAK MIKO</title>
    
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
        fieldset {
            border: none;
            padding: 0;
            margin: 0;
            min-width: 0;
        }

        main {
            padding: 40px 0;
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

        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 28px;
        }

        .back-btn {
            font-size: 13.5px;
            font-weight: 600;
            color: var(--clr-muted);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .back-btn:hover {
            color: var(--clr-blue);
        }

        .badge-status {
            font-size: 12px;
            font-weight: 700;
            padding: 4px 12px;
            border-radius: 20px;
            color: white;
            text-transform: uppercase;
            letter-spacing: 0.03em;
        }

        /* ─── GRID LAYOUT ────────────────────────────────────── */
        .layout-grid {
            display: grid;
            grid-template-columns: 1.55fr 1fr;
            gap: 24px;
            align-items: start;
        }
        @media (max-width: 900px) {
            .layout-grid { grid-template-columns: 1fr; }
        }

        /* ─── CARDS ──────────────────────────────────────────── */
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
        .detail-val.mono {
            font-family: 'DM Mono', monospace;
            color: var(--clr-blue);
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

        /* ─── VERIFICATION PANEL ────────────────────────────── */
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
                        <span>Kantor Pertanahan (BPN) Sukabumi</span>
                    </div>
                </a>

                <div class="nav-menu">
                    <a href="/" class="nav-link">Beranda</a>
                    @if(Auth::user()->isDpn())
                        <a href="{{ route('dpn.whatsapp') }}" class="nav-link">Integrasi WhatsApp</a>
                    @endif
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
                    {{ session('success') }}
                    
                    @if(session('wa_links'))
                        <div style="margin-top: 12px; border-top: 1px solid rgba(0,100,0,0.1); padding-top: 12px;">
                            <strong style="display:block; margin-bottom: 8px; color: #0F5132;">Kirim Notifikasi WhatsApp (Manual):</strong>
                            <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                                @foreach(session('wa_links') as $index => $link)
                                    <a href="{{ $link['url'] }}" target="_blank" class="btn-submit-v" style="background: #25D366; color: #fff; border:none; padding: 6px 12px; font-size: 12px; width: auto; text-decoration: none; margin: 0; display: inline-flex; align-items: center;" id="wa-link-layout-{{ $index }}">
                                        <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" style="margin-right: 4px;"><path d="M22 2L11 13M22 2l-7 20-4-9-9-4 20-7z"/></svg>
                                        Kirim ke {{ $link['target'] }}
                                    </a>
                                @endforeach
                            </div>
                            <script>
                                setTimeout(function() {
                                    var firstWaLink = document.getElementById('wa-link-layout-0');
                                    if(firstWaLink) {
                                        window.open(firstWaLink.href, '_blank');
                                    }
                                }, 500);
                            </script>
                        </div>
                    @endif
                </div>
            @endif

            <div class="page-header">
                <div>
                    <a href="{{ route('kebijakan.index') }}" class="back-btn">
                        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        Kembali ke Daftar
                    </a>
                    <h1 class="page-title" style="margin-top: 8px;">Detail Permohonan <span style="font-family: 'DM Mono', monospace; font-size: 20px; color: var(--clr-blue);">{{ $application->application_number }}</span></h1>
                </div>
                
                <div style="display: flex; align-items: center; gap: 10px;">
                    <span class="badge-status" style="background-color: {{ $application->status_color }}">
                        {{ $application->status_label }}
                    </span>

                </div>
            </div>

            <!-- BUTTON DOWNLOAD DOKUMEN Pertimbangan Teknis Pertanahan SELESAI -->
            @if($application->status === 'disetujui')
                @if($application->bpn_pertek_document)
                    <a href="{{ asset('storage/' . $application->bpn_pertek_document) }}" target="_blank" class="btn-download-cert" style="background:#79A73A; margin-bottom: 20px;">
                        <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                        Unduh Dokumen Pertek Pertanahan Resmi (Kantor Pertanahan (BPN))
                    </a>
                @elseif($application->approval_document)
                    <a href="{{ asset('storage/' . $application->approval_document) }}" target="_blank" class="btn-download-cert" style="margin-bottom: 20px;">
                        <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                        Unduh Dokumen Pertimbangan Teknis Pertanahan Resmi (PDF)
                    </a>
                @endif
            @endif
 
            <!-- FITUR ULASAN LAYANAN (ANTI-SPAM) -->
            @if($application->bpn_pertek_document)
                @php
                    $review = \App\Models\Review::where('user_id', Auth::id())
                        ->where('module_type', 'kebijakan')
                        ->where('module_id', $application->id)
                        ->first();
                @endphp
 
                @if(Auth::user()->isPelakuUsaha())
                    <div class="verify-card" style="border-color: #CBD5E0; background: #F8FAFC; margin-bottom: 24px; padding: 24px; border-radius: 12px; border: 1.5px solid var(--clr-line);">
                        <h3 class="verify-title" style="color: var(--clr-blue); margin-bottom: 12px; display: flex; align-items: center; gap: 8px; font-weight: 800; font-size: 16px;">
                            <svg style="width:14px;height:14px;vertical-align:-2px;margin-right:4px;" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg> Ulasan & Penilaian Layanan
                        </h3>
 
                        @if($review)
                            <div style="background: #FFFFFF; border: 1.5px solid var(--clr-line); padding: 16px; border-radius: 10px;">
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                                    <span style="color: var(--clr-yellow); font-size: 16px; font-weight: 700;">
                                        {{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5 - $review->rating) }} 
                                        <span style="color: var(--clr-ink); font-size: 13px; font-weight: 800; margin-left: 6px;">({{ $review->rating_label }})</span>
                                    </span>
                                    @if($review->is_approved)
                                        <span style="font-size: 11px; background: #EBF8FF; color: #2B6CB0; padding: 3px 10px; border-radius: 100px; font-weight: 700;">Telah Dipublikasikan</span>
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
                                <input type="hidden" name="module_type" value="kebijakan">
                                <input type="hidden" name="module_id" value="{{ $application->id }}">
                                
                                <div class="form-group-v" style="margin-bottom: 12px;">
                                    <label for="rating" style="font-weight: 700; font-size: 12px; display: block; margin-bottom: 6px;">Penilaian Anda</label>
                                    <select name="rating" id="rating" style="width:100%; padding: 10px; border-radius: 8px; border: 1.5px solid var(--clr-line); font-size:13.5px;" required>
                                        <option value="5">Sangat Baik</option>
                                        <option value="4">Baik</option>
                                        <option value="3">Cukup Baik</option>
                                        <option value="2">Kurang</option>
                                        <option value="1">Sangat Kurang</option>
                                    </select>
                                </div>
 
                                <div class="form-group-v" style="margin-bottom: 16px;">
                                    <label for="comment" style="font-weight: 700; font-size: 12px; display: block; margin-bottom: 6px;">Catatan Ulasan / Feedback</label>
                                    <textarea name="comment" id="comment" style="width:100%; padding: 10px; border-radius: 8px; border: 1.5px solid var(--clr-line); font-size:13.5px; resize:none;" rows="2" placeholder="Tuliskan saran atau ulasan singkat Anda..." required></textarea>
                                </div>
 
                                <button type="submit" style="background: var(--clr-blue); color: white; border: none; padding: 10px 20px; border-radius: 8px; font-weight: 700; font-size: 12.5px; cursor: pointer;">
                                    Kirim Ulasan Layanan
                                </button>
                            </form>
                        @endif
                    </div>
                @endif
            @endif

            <!-- PENGATURAN SLA WAKTU LAYANAN (HANYA ADMIN KANTOR PERTANAHAN (BPN) / DPN) -->
            @if(Auth::user()->isBpn() || Auth::user()->isDpn())
                <div class="verify-card" style="border-color: #3182CE; background: #EBF8FF; margin-bottom: 24px; padding: 16px;">
                    <h3 class="verify-title" style="color: #2B6CB0; margin-bottom: 12px; display: flex; align-items: center; gap: 8px;">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Pengaturan Waktu Mulai & Selesai Layanan (SLA)
                    </h3>
                    <p style="font-size: 13px; color: #2C5282; margin-bottom: 12px;">
                        Gunakan fitur ini untuk menyesuaikan tanggal mulai atau berakhirnya layanan secara manual jika terdapat kendala sistem, terpotong hari libur, atau penundaan lainnya. Kosongkan jika ingin mengikuti waktu default.
                    </p>
                    @php
                        $verifyRoute = match(Route::currentRouteName()) {
                            'berusaha.show' => 'berusaha.verify',
                            'non-berusaha.show' => 'non-berusaha.verify',
                            'kebijakan.show' => 'kebijakan.verify',
                            'tanah-timbul.show' => 'tanah-timbul.verify',
                            'psn.show' => 'psn.verify',
                            default => 'berusaha.verify'
                        };
                    @endphp
                    <form action="{{ route($verifyRoute, $application->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="step" value="update_sla">
                        <div class="form-grid-2" style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                            <div class="form-group-v">
                                <label for="tgl_mulai_layanan" style="font-weight: 600; display: block; margin-bottom: 8px; font-size: 13px; color: #2B6CB0;">Tanggal Mulai Layanan</label>
                                <input type="datetime-local" name="tgl_mulai_layanan" id="tgl_mulai_layanan" class="form-control-v" style="border: 1px solid #63B3ED;"
                                       value="{{ $application->tgl_mulai_layanan ? $application->tgl_mulai_layanan->format('Y-m-d\TH:i') : '' }}">
                            </div>
                            <div class="form-group-v">
                                <label for="tgl_selesai_layanan" style="font-weight: 600; display: block; margin-bottom: 8px; font-size: 13px; color: #2B6CB0;">Tanggal Berakhir Layanan</label>
                                <input type="datetime-local" name="tgl_selesai_layanan" id="tgl_selesai_layanan" class="form-control-v" style="border: 1px solid #63B3ED;"
                                       value="{{ $application->tgl_selesai_layanan ? $application->tgl_selesai_layanan->format('Y-m-d\TH:i') : '' }}">
                            </div>
                        </div>
                        <button type="submit" class="btn-submit-v" style="margin-top: 12px; background: #3182CE; padding: 8px 16px;">Simpan Pengaturan Waktu</button>
                    </form>
                </div>
            @endif

            <!-- STAGED VERIFICATION FORM (Hanya untuk instansi yang sedang bertugas) -->
            @php
                $user = Auth::user();
                $canVerify = false;
                $verifierRoleLabel = '';
                
                if ($user->isBpn() && $application->status === 'menunggu_bpn') {
                    $canVerify = true;
                    $verifierRoleLabel = 'Petugas Kantor Pertanahan (BPN) (Verifikasi Kepemilikan Tanah)';
                } elseif ($user->isDinasPu() && $application->status === 'menunggu_dinas_pu') {
                    $canVerify = true;
                    $verifierRoleLabel = 'Verifikator Dinas Pekerjaan Umum dan Tata Ruang (PUTR)';
                } elseif ($user->isSatuPintu() && $application->status === 'menunggu_satu_pintu') {
                    $canVerify = true;
                    $verifierRoleLabel = 'Petugas DPMPTSP (Penerbitan Izin)';
                }

                // Logika Waktu Untuk Staged Timeline & Penentuan Form Aktif Kantor Pertanahan (BPN)
                $now = \Carbon\Carbon::now();
                $cekLokasiLewat = $application->bpn_cek_lokasi_dt
                    && $now >= $application->bpn_cek_lokasi_dt;
                $rapatLewat = $application->bpn_rapat_dt
                    && $now >= $application->bpn_rapat_dt;
            @endphp

            @if($canVerify || $user->isBpn() || $user->isDinasPu() || $user->isSatuPintu())
                <div class="verify-card">
                    <h3 class="verify-title"><svg style="width:16px;height:16px;vertical-align:-3px;margin-right:6px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg> Panel Pemeriksaan Berkas</h3>

                    @if($user->isBpn())
                        {{-- ====== TABS / PANELS UNTUK SETIAP LANGKAH ====== --}}
                        <div id="bpn-panel-1" class="bpn-panel-step" style="display: {{ $application->bpn_berkas_status === 'menunggu' ? 'block' : 'none' }};">
                            @php $isStep1Active = (Auth::user()->isBpn() && $application->bpn_berkas_status === 'menunggu'); @endphp
                            <fieldset {{ $isStep1Active ? '' : 'disabled' }}>
                                <form action="{{ route('kebijakan.verify', $application->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="step" value="bpn_berkas">
                                    <div style="background:#FFFDF5;border:1px solid #F6AD55;padding:12px 16px;border-radius:8px;font-size:13px;color:#7B341E;margin-bottom:20px;">
                                        <strong>Langkah 1 dari 4 — Verifikasi Berkas Awal:</strong> Periksa kelengkapan dokumen persyaratan yang diunggah pemohon, lalu terima atau tolak. Notifikasi WA akan terkirim otomatis.
                                    </div>
                                    <div class="form-group-v" style="margin-bottom: 20px;">
                                        <label class="form-label" style="font-weight:700;color:#744210;margin-bottom:8px;display:block;">Tindakan Pemeriksaan Berkas:</label>
                                        <div style="display: flex; gap: 20px;">
                                            <label style="display:flex;align-items:center;gap:6px;font-size:13.5px;font-weight:600;cursor:pointer;">
                                                <input type="radio" name="action" value="approve" required {{ $application->bpn_berkas_status === 'diterima' ? 'checked' : ($application->bpn_berkas_status === 'ditolak' || $application->bpn_berkas_status === 'tidak_sesuai' ? '' : 'checked') }} style="width:16px;height:16px;accent-color:var(--clr-blue);" onchange="document.getElementById('sps-upload-container').style.display='block'; document.getElementById('sps_document').required=true; document.getElementById('revisi-berkas-container').style.display='none';"> Lengkap
                                            </label>
                                            <label style="display:flex;align-items:center;gap:6px;font-size:13.5px;font-weight:600;color:#E53E3E;cursor:pointer;">
                                                <input type="radio" name="action" value="reject" required {{ $application->bpn_berkas_status === 'ditolak' || $application->bpn_berkas_status === 'tidak_sesuai' ? 'checked' : '' }} style="width:16px;height:16px;accent-color:var(--clr-blue);" onchange="document.getElementById('sps-upload-container').style.display='none'; document.getElementById('sps_document').required=false; document.getElementById('revisi-berkas-container').style.display='block';"> Tidak Lengkap
                                            </label>
                                        </div>
                                    </div>
                                    
                                    <div id="sps-upload-container" style="display: {{ in_array($application->bpn_berkas_status, ['diterima', 'menunggu']) ? 'block' : 'none' }}; margin-bottom: 20px;">
                                        <label class="form-label" style="font-weight:700;color:var(--clr-ink);margin-bottom:6px;display:block;">Upload Surat Perintah Setor (SPS) <span style="color:#C53030;">*</span></label>
                                        <input type="file" name="sps_document" id="sps_document" class="form-control-v" accept=".pdf,.jpg,.jpeg,.png" {{ in_array($application->bpn_berkas_status, ['diterima', 'menunggu']) ? 'required' : '' }}>
                                        <div style="font-size: 11.5px; color: var(--clr-muted); margin-top: 5px;">Maksimal 5MB. Wajib diisi jika Berkas Lengkap (Disetujui).</div>
                                    </div>

                                    <div id="revisi-berkas-container" style="display:none; margin-bottom: 12px; background: #fff5f5; padding: 12px; border: 1px solid #fed7d7; border-radius: 4px;">
                                        <label style="font-weight: 600; font-size: 12px; color: #c53030; margin-bottom: 8px; display: block;">Tandai Berkas yang Tidak Valid / Kurang Lengkap (Otomatis masuk ke catatan):</label>
                                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 6px; font-size: 12px;">
                                            <label><input type="checkbox" class="cb-revisi" value="Formulir PTP"> Formulir PTP</label>
                                            <label><input type="checkbox" class="cb-revisi" value="Peta Lokasi / Sketsa"> Peta Lokasi / Sketsa</label>
                                            <label><input type="checkbox" class="cb-revisi" value="Surat Kuasa"> Surat Kuasa</label>
                                            <label><input type="checkbox" class="cb-revisi" value="FC KTP Pemohon"> FC KTP Pemohon</label>
                                            <label><input type="checkbox" class="cb-revisi" value="FC NPWP"> FC NPWP</label>
                                            <label><input type="checkbox" class="cb-revisi" value="FC Akta Pendirian"> FC Akta Pendirian</label>
                                            <label><input type="checkbox" class="cb-revisi" value="Rencana Penggunaan Tanah"> Rencana Penggunaan Tanah</label>
                                            <label><input type="checkbox" class="cb-revisi" value="NIB"> NIB</label>
                                            <label><input type="checkbox" class="cb-revisi" value="KBLI"> KBLI</label>
                                            <label><input type="checkbox" class="cb-revisi" value="Proposal Kegiatan"> Proposal Kegiatan</label>
                                        </div>
                                    </div>

                                    <div class="form-group-v">
                                        <label for="notes" style="display: block; font-size: 12.5px; font-weight: 700; color: var(--clr-ink); margin-bottom: 6px;">Catatan Pemeriksaan</label>
                                        <textarea id="notes" name="notes" class="form-control-v" rows="3" placeholder="Masukkan catatan atau instruksi perbaikan..." required>{{ $application->bpn_berkas_status !== 'menunggu' ? $application->bpn_notes : '' }}</textarea>
                                    </div>
                                    @if($isStep1Active)

                                        <button type="submit" class="btn-submit-v">Simpan Verifikasi Berkas</button>
                                    @else
                                        
                                    @endif
                                </form>
                            </fieldset>
                            @if(Auth::user()->isBpn() && $application->bpn_berkas_status !== 'menunggu')
                                <form action="{{ route('kebijakan.verify', $application->id) }}" method="POST" style="margin-top: 16px;">
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

                        <div id="bpn-panel-2" class="bpn-panel-step" style="display: {{ $application->bpn_berkas_status === 'diterima' && $application->bpn_pembayaran_status === 'menunggu' ? 'block' : 'none' }};">
                            @php $isStep2Active = (Auth::user()->isBpn() && $application->bpn_berkas_status === 'diterima' && $application->bpn_pembayaran_status === 'menunggu'); @endphp
                            <fieldset {{ $isStep2Active ? '' : 'disabled' }}>
                                <form action="{{ route('kebijakan.verify', $application->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="step" value="bpn_konfirmasi_bayar">
                                    <div style="background:#FFFDF5;border:1px solid #F6AD55;padding:12px 16px;border-radius:8px;font-size:13px;color:#7B341E;margin-bottom:16px;">
                                        <strong>Langkah 2 — Konfirmasi Pembayaran PNBP:</strong> Berkas telah disetujui. Masukkan Nomor Berkas untuk mengkonfirmasi bahwa pembayaran PNBP telah diterima. Sistem otomatis mengirim akun ke WA pemohon.
                                    </div>
                                    <div class="form-group-v" style="margin-bottom:16px;">
                                        <label class="form-label" style="font-weight:700;color:#744210;">Nomor Berkas <span style="color:red;">*</span></label>
                                        <input type="text" name="no_berkas" class="form-control-v" placeholder="cth: 1234/2026/KANTOR_PERTANAHAN..." style="background:white;" value="{{ $application->no_berkas }}" required>
                                    </div>
                                    @if($isStep2Active)
                                        <button type="submit" class="btn-submit-v" style="font-size:13px;padding:10px 20px;">
                                            💰 Konfirmasi Pembayaran & Blast WA Akun Pemohon
                                        </button>
                                    @else
                                        
                                    @endif
                                </form>
                            </fieldset>

                            @if(Auth::user()->isBpn() && $application->bpn_pembayaran_status === 'sudah_bayar')
                                <form action="{{ route('kebijakan.verify', $application->id) }}" method="POST" style="margin-top: 16px;">
                                    @csrf
                                    <input type="hidden" name="step" value="resend_wa">
                                    <input type="hidden" name="wa_type" value="credential">

                                    <button type="submit" class="btn-submit-v" style="background: var(--clr-blue); width: 100%; justify-content: center;">
                                        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 2L11 13M22 2l-7 20-4-9-9-4 20-7z"/></svg>
                                        Kirim Ulang Kredensial Akun (WhatsApp)
                                    </button>
                                </form>
                            @endif
                        </div>

                        <div id="bpn-panel-3" class="bpn-panel-step" style="display: {{ $application->bpn_pembayaran_status === 'sudah_bayar' && (!$application->bpn_cek_lokasi_dt || !$cekLokasiLewat) ? 'block' : 'none' }};">
                            @php $isStep3Active = (Auth::user()->isBpn() && $application->bpn_pembayaran_status === 'sudah_bayar'); @endphp
                            <fieldset {{ $isStep3Active ? '' : 'disabled' }}>
                                <form action="{{ route('kebijakan.verify', $application->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="step" value="bpn_cek_lokasi">
                                    <div style="background:#FFFDF5;border:1px solid #F6AD55;padding:12px 16px;border-radius:8px;font-size:13px;color:#7B341E;margin-bottom:16px;">
                                        <strong>Langkah 3 dari 4 — Jadwal Peninjauan Lapangan</strong>
                                        @if($application->bpn_cek_lokasi_dt)
                                            @if($cekLokasiLewat)
                                                <span style="color:#276749;font-weight:700;"> <svg style="width:14px;height:14px;vertical-align:-2px;margin-right:4px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg> Selesai</span> —
                                                Peninjauan lapangan <strong>{{ $application->bpn_cek_lokasi_date }}</strong> sudah lewat. Jadwal bisa tetap diubah jika perlu.
                                            @else
                                                — Terjadwal: <strong>{{ $application->bpn_cek_lokasi_date }}</strong> (CP: {{ $application->bpn_cek_lokasi_cp }}). Ubah jika ada perubahan.
                                            @endif
                                        @else
                                            — Tentukan jadwal dan kontak person petugas lapangan.
                                        @endif
                                    </div>
                                    <div class="form-group-v" style="margin-bottom:12px;">
                                        <label class="form-label" style="font-weight:700;color:#744210;">Tanggal & Waktu Peninjauan Lapangan <span style="color:red;">*</span></label>
                                        <div style="display:flex; gap:8px;">
                                            <input type="datetime-local" id="bpn_cek_lokasi_dt" name="bpn_cek_lokasi_dt" class="form-control-v"
                                                value="{{ $application->bpn_cek_lokasi_dt ? $application->bpn_cek_lokasi_dt->format('Y-m-d\TH:i') : '' }}"
                                                style="background:white; flex-grow:1;" required>
                                            <button type="button" onclick="document.getElementById('bpn_cek_lokasi_dt').value = new Date(Date.now() - (new Date().getTimezoneOffset() * 60000)).toISOString().slice(0,16);" style="background:#e2e8f0; border:1px solid #cbd5e1; padding:0 12px; border-radius:6px; font-size:11px; font-weight:700; color:#475569; cursor:pointer;" title="Set ke waktu saat ini untuk test skip">📍 Sekarang</button>
                                        </div>
                                    </div>
                                    <div class="form-group-v">
                                        <label class="form-label" style="font-weight:700;color:#744210;">Kontak Person Petugas Lapangan <span style="color:red;">*</span></label>
                                        <input type="text" name="bpn_cek_lokasi_cp" class="form-control-v"
                                            value="{{ $application->bpn_cek_lokasi_cp }}"
                                            placeholder="cth: 08511234567 (Budi - Petugas Kantor Pertanahan (BPN))" style="background:white;" required>
                                    </div>
                                    @if($isStep3Active)
                                        <button type="submit" class="btn-submit-v" style="font-size:13px;padding:10px 20px;">
                                            {{ $application->bpn_cek_lokasi_dt ? '🔄 Ubah Jadwal Peninjauan Lapangan & Kirim WA' : '📍 Simpan Jadwal Peninjauan Lapangan & Blast WA' }}
                                        </button>
                                    @else
                                        
                                    @endif
                                </form>
                            </fieldset>

                            @if(Auth::user()->isBpn() && $application->bpn_cek_lokasi_dt)
                                <form action="{{ route('kebijakan.verify', $application->id) }}" method="POST" style="margin-top: 16px;">
                                    @csrf
                                    <input type="hidden" name="step" value="resend_wa">
                                    <input type="hidden" name="wa_type" value="cek_lokasi">

                                    <button type="submit" class="btn-submit-v" style="background: var(--clr-blue); width: 100%; justify-content: center;">
                                        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 2L11 13M22 2l-7 20-4-9-9-4 20-7z"/></svg>
                                        Kirim Ulang Jadwal Peninjauan Lapangan (WhatsApp)
                                    </button>
                                </form>
                            @endif
                        </div>

                        <div id="bpn-panel-4" class="bpn-panel-step" style="display: {{ $application->bpn_cek_lokasi_dt && $cekLokasiLewat && (!$application->bpn_rapat_dt || !$rapatLewat) ? 'block' : 'none' }};">
                            @php $isStep4Active = (Auth::user()->isBpn() && $application->bpn_cek_lokasi_dt && $cekLokasiLewat && (!$application->bpn_rapat_dt || !$rapatLewat)); @endphp
                            <fieldset {{ $isStep4Active ? '' : 'disabled' }}>
                                <form action="{{ route('kebijakan.verify', $application->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="step" value="bpn_rapat">
                                    <div style="background:#EBF8FF;border:1px solid #90CDF4;padding:12px 16px;border-radius:8px;font-size:13px;color:#2B6CB0;margin-bottom:16px;">
                                        <strong>Langkah 4 dari 5 — Jadwal Rapat Koordinasi</strong>
                                        @if($application->bpn_rapat_dt)
                                            — Terjadwal: <strong>{{ $application->bpn_rapat_date }}</strong>. Ubah jika ada perubahan.
                                        @else
                                            — Peninjauan lapangan terdaftar. Tentukan waktu rapat koordinasi Kantor Pertanahan (BPN).
                                        @endif
                                    </div>
                                    <div class="form-group-v" style="margin-bottom:12px;">
                                        <label class="form-label" style="font-weight:700;color:#744210;">Tanggal & Waktu Rapat <span style="color:red;">*</span></label>
                                        <div style="display:flex; gap:8px;">
                                            <input type="datetime-local" id="bpn_rapat_dt" name="bpn_rapat_dt" class="form-control-v"
                                                value="{{ $application->bpn_rapat_dt ? $application->bpn_rapat_dt->format('Y-m-d\TH:i') : '' }}"
                                                style="background:white; flex-grow:1;" required>
                                            <button type="button" onclick="document.getElementById('bpn_rapat_dt').value = new Date(Date.now() - (new Date().getTimezoneOffset() * 60000)).toISOString().slice(0,16);" style="background:#e2e8f0; border:1px solid #cbd5e1; padding:0 12px; border-radius:6px; font-size:11px; font-weight:700; color:#475569; cursor:pointer;" title="Set ke waktu saat ini untuk test skip">📍 Sekarang</button>
                                        </div>
                                    </div>
                                    @if($isStep4Active)
                                        <button type="submit" class="btn-submit-v" style="background:#218AC9;font-size:13px;padding:10px 20px;">
                                            {{ $application->bpn_rapat_dt ? '🔄 Ubah Jadwal Rapat & Kirim WA' : '📅 Simpan Jadwal Rapat & Blast WA' }}
                                        </button>
                                    @else
                                        
                                    @endif
                                </form>
                            </fieldset>

                            @if(Auth::user()->isBpn() && $application->bpn_rapat_dt)
                                <form action="{{ route('kebijakan.verify', $application->id) }}" method="POST" style="margin-top: 16px;">
                                    @csrf
                                    <input type="hidden" name="step" value="resend_wa">
                                    <input type="hidden" name="wa_type" value="rapat">

                                    <button type="submit" class="btn-submit-v" style="background: var(--clr-blue); width: 100%; justify-content: center;">
                                        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 2L11 13M22 2l-7 20-4-9-9-4 20-7z"/></svg>
                                        Kirim Ulang Jadwal Rapat (WhatsApp)
                                    </button>
                                </form>
                            @endif
                        </div>

                        <div id="bpn-panel-5" class="bpn-panel-step" style="display: {{ $application->bpn_rapat_dt && $rapatLewat && !$application->bpn_pertek_document ? 'block' : 'none' }};">
                            @php $isStep5Active = (Auth::user()->isBpn() && $application->bpn_rapat_dt && $rapatLewat && !$application->bpn_pertek_document); @endphp
                            <fieldset {{ $isStep5Active ? '' : 'disabled' }}>
                                <form action="{{ route('kebijakan.verify', $application->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="step" value="bpn_pertek">
                                    <div style="background:#F0FFF4;border:1px solid #BBF7D0;padding:12px 16px;border-radius:8px;font-size:13px;color:#166534;margin-bottom:16px;line-height:1.6;">
                                        <strong>Langkah 5 dari 5 — Penerbitan Pertek Pertanahan</strong><br>
                                        Rapat terdaftar. Upload Dokumen Pertek dan beri keputusan akhir Kantor Pertanahan (BPN).
                                    </div>
                                    <div class="form-group-v">
                                        <label class="form-label" style="font-weight:700;color:#744210;">Keputusan Akhir BPN:</label>
                                        <div class="radio-group" style="display: flex; gap: 20px; margin-bottom: 16px;">
                                            <label class="radio-label" style="display: flex; align-items: center; gap: 8px;"><input type="radio" name="action" value="approve" required {{ $application->bpn_pertek_document || $application->status === 'disetujui' || $application->status === 'menunggu_dinas_pu' || $application->status === 'menunggu_satu_pintu' ? 'checked' : 'checked' }}> Disetujui</label>
                                            <label class="radio-label" style="display: flex; align-items: center; gap: 8px; color:#E53E3E;"><input type="radio" name="action" value="reject" required {{ $application->status === 'ditolak' && !$application->bpn_pertek_document && $application->bpn_berkas_status === 'diterima' ? 'checked' : '' }}> Tidak Disetujui</label>
                                        </div>
                                    </div>
                                    @if($application->bpn_pertek_document)
                                        <div class="form-group-v">
                                            <label class="form-label" style="font-weight:700;color:#744210;">Dokumen Pertek yang diterbitkan:</label>
                                            <a href="{{ asset('storage/' . $application->bpn_pertek_document) }}" target="_blank" style="color:#218AC9; text-decoration:underline;">Lihat Dokumen Pertek</a>
                                        </div>
                                    @else
                                        <div class="form-group-v" id="pertekUploadWrapper">
                                            <label class="form-label" style="font-weight:700;color:#744210;">Unggah Dokumen Pertek (PDF/DOC/DOCX) <span style="color:red;">*</span></label>
                                            <input type="file" id="bpn_pertek_document" name="bpn_pertek_document" class="form-control-v" accept=".pdf,.doc,.docx" style="background:white;">
                                        </div>
                                    @endif
                                    <div class="form-group-v">
                                        <label class="form-label" style="font-weight:700;color:#744210;">Catatan / Rekomendasi Teknis Kantor Pertanahan (BPN) <span style="color:red;">*</span></label>
                                        <textarea name="notes" class="form-control-v" rows="3" placeholder="Tuliskan rekomendasi teknis atau alasan penolakan..." style="resize:none;background:white;" required>{{ $application->status === 'menunggu_dinas_pu' || $application->status === 'menunggu_satu_pintu' || $application->status === 'disetujui' || ($application->status === 'ditolak' && !$application->bpn_pertek_document && $application->bpn_berkas_status === 'diterima') ? $application->bpn_notes : '' }}</textarea>
                                    </div>
                                    @if($isStep5Active)
                                        <button type="submit" class="btn-submit-v" style="background:#79A73A;">📄 Terbitkan Pertek & Blast WA Pemohon</button>
                                    @else
                                        
                                    @endif
                                </form>
                            </fieldset>

                            @if(Auth::user()->isBpn() && $application->bpn_pertek_document)
                                <form action="{{ route('kebijakan.verify', $application->id) }}" method="POST" style="margin-top: 16px;">
                                    @csrf
                                    <input type="hidden" name="step" value="resend_wa">
                                    <input type="hidden" name="wa_type" value="{{ $application->status === 'ditolak' ? 'pertek_tolak' : 'pertek_terbit' }}">

                                    <button type="submit" class="btn-submit-v" style="background: var(--clr-blue); width: 100%; justify-content: center;">
                                        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 2L11 13M22 2l-7 20-4-9-9-4 20-7z"/></svg>
                                        Kirim Ulang Notifikasi Pertek (WhatsApp)
                                    </button>
                                </form>
                            @endif
                        </div>

                        <script>
                            function showBpnPanel(stepNum) {
                                // hide all
                                document.querySelectorAll('.bpn-panel-step').forEach(function(el) {
                                    el.style.display = 'none';
                                });
                                // show the selected one
                                var target = document.getElementById('bpn-panel-' + stepNum);
                                if(target) {
                                    target.style.display = 'block';
                                    target.scrollIntoView({ behavior: 'smooth', block: 'center' });
                                }
                            }
                        </script>
                    @endif



                    @if($user->isSatuPintu())
                        <div id="bpn-panel-satu-pintu" class="bpn-panel-step" style="display: {{ in_array($application->status, ['menunggu_satu_pintu', 'disetujui']) ? 'block' : 'none' }};">
                            @php $isSpActive = (Auth::user()->isSatuPintu() && $application->status === 'menunggu_satu_pintu'); @endphp
                            <fieldset {{ $isSpActive ? '' : 'disabled' }}>
                                <form action="{{ route('kebijakan.verify', $application->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="step" value="satu_pintu_terbit">
                                    <div style="background:#F0FFF4;border:1px solid #9AE6B4;padding:12px 16px;border-radius:8px;font-size:13px;color:#166534;margin-bottom:16px;">
                                        <strong>Penerbitan Pertimbangan Teknis Pertanahan (DPMPTSP):</strong> Isi data penerbitan Pertimbangan Teknis Pertanahan resmi, lalu unggah dokumen dan kirim.
                                    </div>
                                    <div class="form-group-v">
                                        <label class="form-label" style="font-weight:700;color:#744210;">Keputusan:</label>
                                        <div class="radio-group" style="display: flex; gap: 20px; margin-bottom: 16px;">
                                            <label class="radio-label" style="display: flex; align-items: center; gap: 8px;"><input type="radio" name="action" value="approve" required checked onclick="toggleSatuPintuFields(true)"> Disetujui</label>
                                            <label class="radio-label" style="display: flex; align-items: center; gap: 8px; color:#E53E3E;"><input type="radio" name="action" value="reject" required onclick="toggleSatuPintuFields(false)"> Tidak Disetujui</label>
                                        </div>
                                    </div>
                                    <div id="satuPintuFieldsWrapper">
                                        <div class="form-group-v" style="margin-bottom:12px;">
                                            <label for="satu_pintu_no_pkkpr" class="form-label" style="font-weight:700;color:#744210;">Nomor Pertimbangan Teknis Pertanahan (wajib) <span style="color:red;">*</span></label>
                                            <input type="text" id="satu_pintu_no_pkkpr" name="satu_pintu_no_pkkpr" class="form-control-v"
                                                   placeholder="cth: Pertimbangan Teknis Pertanahan-NB/2026/001" value="{{ $application->satu_pintu_no_pkkpr }}" style="background:white;" required>
                                        </div>
                                        <div class="form-group-v" style="margin-bottom:12px;">
                                            <label for="satu_pintu_tanggal_terbit" class="form-label" style="font-weight:700;color:#744210;">Tanggal Terbit (wajib) <span style="color:red;">*</span></label>
                                            <input type="date" id="satu_pintu_tanggal_terbit" name="satu_pintu_tanggal_terbit" class="form-control-v"
                                                   value="{{ $application->satu_pintu_tanggal_terbit ? $application->satu_pintu_tanggal_terbit->format('Y-m-d') : '' }}" style="background:white;" required>
                                        </div>
                                        <div class="form-group-v" style="margin-bottom:12px;">
                                            @if($application->approval_document)
                                                <label class="form-label" style="font-weight:700;color:#744210;">Dokumen Pertimbangan Teknis Pertanahan</label>
                                                <a href="{{ asset('storage/' . $application->approval_document) }}" target="_blank" style="display:inline-flex; align-items:center; gap:8px; padding:8px 16px; background:#f1f5f9; border:1px solid #cbd5e1; border-radius:6px; color:#0f172a; font-size:13px; font-weight:600; text-decoration:none; margin-top:4px; transition:all 0.2s;" onmouseover="this.style.background='#e2e8f0'" onmouseout="this.style.background='#f1f5f9'">
                                                    <svg viewBox="0 0 24 24" width="16" height="16" stroke="currentColor" stroke-width="2" fill="none"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                                                    Lihat Dokumen Terunggah
                                                </a>
                                            @else
                                                <label for="approval_document" class="form-label" style="font-weight:700;color:#744210;">Unggah Dokumen Pertimbangan Teknis Pertanahan (opsional)</label>
                                                <input type="file" id="approval_document" name="approval_document" class="form-control-v" accept="application/pdf" style="background:white;">
                                                <span style="font-size:11.5px;color:#744210;margin-top:4px;display:block;">Format PDF, maks. 10MB. Dokumen ini dapat diunduh oleh pemohon.</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group-v">
                                        <label for="notes_sp" class="form-label" style="font-weight:700;color:#744210;">Catatan / Keterangan:</label>
                                        <textarea id="notes_sp" name="notes" class="form-control-v" rows="3" placeholder="Catatan penerbitan Pertimbangan Teknis Pertanahan (opsional)..." style="resize:none;background:white;">{{ $application->satu_pintu_notes }}</textarea>
                                    </div>
                                    @if($isSpActive)
                                        <button type="submit" class="btn-submit-v" style="background:#79A73A;">📄 Terbitkan Pertimbangan Teknis Pertanahan & Blast WA Pemohon</button>
                                    @else
                                        
                                    @endif
                                </form>
                                <script>
                                    function toggleSatuPintuFields(show) {
                                        const w = document.getElementById('satuPintuFieldsWrapper');
                                        const noEl = document.getElementById('satu_pintu_no_pkkpr');
                                        const tglEl = document.getElementById('satu_pintu_tanggal_terbit');
                                        if (w) {
                                            w.style.display = show ? 'block' : 'none';
                                            if(noEl) show ? noEl.setAttribute('required','required') : noEl.removeAttribute('required');
                                            if(tglEl) show ? tglEl.setAttribute('required','required') : tglEl.removeAttribute('required');
                                        }
                                    }
                                </script>
                            </fieldset>

                            @if(Auth::user()->isSatuPintu() && $application->approval_document)
                                <form action="{{ route('kebijakan.verify', $application->id) }}" method="POST" style="margin-top: 16px;">
                                    @csrf
                                    <input type="hidden" name="step" value="resend_wa">
                                    <input type="hidden" name="wa_type" value="{{ $application->status === 'ditolak' ? 'pkkpr_tolak' : 'pkkpr_terbit' }}">
                                    <div class="form-group-v" style="margin-bottom: 12px; text-align: left;">
                                        <label style="font-size: 11px; color: var(--clr-muted);">Edit Pesan WA (Opsional):</label>
                                        <textarea name="custom_wa_message" class="form-control-v" rows="2" placeholder="Tuliskan pesan khusus jika ingin mengganti template bawaan..."></textarea>
                                    </div>
                                    <button type="submit" class="btn-submit-v" style="background: var(--clr-blue); width: 100%; justify-content: center;">
                                        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 2L11 13M22 2l-7 20-4-9-9-4 20-7z"/></svg>
                                        Kirim Ulang Notifikasi Pertimbangan Teknis Pertanahan (WhatsApp)
                                    </button>
                                </form>
                            @endif
                        </div>
                    @endif
                </div>
            @endif

            <!-- PELAKU USAHA ACTION: REUPLOAD JIKA BERKAS TIDAK SESUAI -->
            @if($user->isPelakuUsaha() && $application->status === 'menunggu_bpn' && in_array($application->bpn_berkas_status, ['tidak_sesuai', 'ditolak']))
                <div class="verify-card" style="border-color: #F5C2C1; background: #FFF5F5;">
                    <h3 class="verify-title" style="color: #C5221F;">⚠️ Perbaikan Dokumen Persyaratan Diperlukan</h3>
                    <p style="font-size: 13px; color: #7F2321; margin-bottom: 16px;">
                        Petugas Kantor Pertanahan (BPN) menyatakan berkas Anda tidak lengkap dengan catatan: <br>
                        <strong>"{{ $application->bpn_notes }}"</strong>
                    </p>
                    <form action="{{ route('kebijakan.verify', $application->id) }}" method="POST" enctype="multipart/form-data">
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

            <div class="layout-grid">
                
                <!-- Left: Application Details -->
                <div>
                    <div class="card">
                        <h2 class="card-title">Informasi Identitas Pemohon / Pengguna Layanan</h2>
                        
                        <ul class="detail-list">
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
                                <span class="detail-label">Status Pemohon (Sebagai Apa)</span>
                                <span class="detail-val">{{ $application->hubungan_pengaju }}</span>
                            </li>
                            <li class="detail-item">
                                <span class="detail-label">Akun Pemohon (Username)</span>
                                <span class="detail-val">PMH{{ str_pad($application->user->id ?? 0, 3, '0', STR_PAD_LEFT) }}</span>
                            </li>
                            <li class="detail-item">
                                <span class="detail-label">Nomor Telepon Gateway / HP</span>
                                <span class="detail-val mono">+{{ $application->user->phone_number }}</span>
                            </li>
                            <li class="detail-item">
                                <span class="detail-label">Tanggal Pengajuan Berkas</span>
                                <span class="detail-val">{{ $application->created_at->format('d-m-Y, H:i') }} WIB</span>
                            </li>
                            
                            <!-- BPN Info -->
                            <li class="detail-item">
                                <span class="detail-label">Kelayakan Berkas (Kantor Pertanahan (BPN))</span>
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
                                    <span class="detail-label">Dokumen Pertek Kantor Pertanahan (BPN)</span>
                                    <span class="detail-val">
                                        <a href="{{ asset('storage/' . $application->bpn_pertek_document) }}" target="_blank" class="btn-doc">
                                            Unduh Surat Pertek
                                        </a>
                                    </span>
                                </li>
                            @endif



                            <!-- DPMPTSP Info -->
                            @if($application->satu_pintu_no_pkkpr)
                                <li class="detail-item">
                                    <span class="detail-label">Nomor Pertimbangan Teknis Pertanahan</span>
                                    <span class="detail-val">{{ $application->satu_pintu_no_pkkpr }}</span>
                                </li>
                            @endif

                            @if($application->approval_document)
                                <li class="detail-item">
                                    <span class="detail-label">Dokumen Pertimbangan Teknis Pertanahan Terbit</span>
                                    <span class="detail-val">
                                        <a href="{{ asset('storage/' . $application->approval_document) }}" target="_blank" class="btn-doc">
                                            Unduh Dokumen
                                        </a>
                                    </span>
                                </li>
                            @endif

                            <li class="detail-item" style="display: flex; flex-direction: column; gap: 8px;">
                                <span class="detail-label" style="border-bottom: 1px solid var(--clr-line); padding-bottom: 8px; margin-bottom: 4px;">Berkas Lampiran Persyaratan</span>
                                
                                @if($application->ptp_data)
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <span style="font-size: 13px; color: var(--clr-mid); font-weight: 500;">Formulir PTP</span>
                                    <a href="{{ route('kebijakan.ptp_pdf', $application->id) }}" target="_blank" class="btn-doc">Buka Berkas</a>
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

                <!-- Right: Staged Tracking Timeline -->
                <div>

                    <!-- DAY COUNTER / SLA BANNER -->
                    @php
                        $isPuOrPtsp = Auth::user()->isDinasPu() || Auth::user()->isSatuPintu();
                        $defaultDays = $isPuOrPtsp ? 20 : 10;
                        
                        // Menghitung target SLA dengan skip hari libur nasional dan weekend
                        $targetDate = $application->tgl_selesai_layanan 
                            ? \Carbon\Carbon::parse($application->tgl_selesai_layanan) 
                            : $application->created_at->addWorkingDaysWithHolidays($defaultDays);
                        
                        $isSelesai = false;
                        if (Auth::user()->isBpn()) {
                            $isSelesai = ($application->bpn_pertek_document || in_array($application->status, ['ditolak', 'menunggu_dinas_pu', 'menunggu_satu_pintu', 'disetujui']));
                        } elseif (Auth::user()->isDinasPu()) {
                            $isSelesai = ($application->dinas_pu_status === 'disetujui' || in_array($application->status, ['ditolak', 'menunggu_satu_pintu', 'disetujui']));
                        } else {
                            $isSelesai = in_array($application->status, ['ditolak', 'disetujui']);
                        }
                        
                        if ($isSelesai) {
                            $slaBg = '#16A34A'; // Solid Green
                            $slaBorder = '#15803D';
                            $slaColor = '#FFFFFF';
                        } else {
                            $now = \Carbon\Carbon::now();
                            // Menggunakan macro baru yang skip tanggal merah & weekend
                            $daysRemaining = $now->diffInWorkingDaysWithHolidays($targetDate);
                            
                            if ($isPuOrPtsp) {
                                if ($daysRemaining >= 4) {
                                    $slaBg = '#16A34A'; 
                                    $slaBorder = '#15803D';
                                    $slaColor = '#FFFFFF';
                                } elseif ($daysRemaining >= 1) {
                                    $slaBg = '#EAB308'; 
                                    $slaBorder = '#CA8A04';
                                    $slaColor = '#FFFFFF';
                                } else {
                                    $slaBg = '#DC2626'; 
                                    $slaBorder = '#B91C1C';
                                    $slaColor = '#FFFFFF';
                                }
                            } else {
                                if ($daysRemaining >= 3) {
                                    $slaBg = '#16A34A'; 
                                    $slaBorder = '#15803D';
                                    $slaColor = '#FFFFFF';
                                } elseif ($daysRemaining >= 1) {
                                    $slaBg = '#EAB308'; 
                                    $slaBorder = '#CA8A04';
                                    $slaColor = '#FFFFFF';
                                } else {
                                    $slaBg = '#DC2626'; 
                                    $slaBorder = '#B91C1C';
                                    $slaColor = '#FFFFFF';
                                }
                            }
                        }
                    @endphp
                    
                    <div class="floating-sla" style="position: fixed; top: 120px; right: 32px; z-index: 9999; background: {{ $slaBg }}; border-radius: 4px; box-shadow: 0 10px 25px rgba(0,0,0,0.15); border: 1px solid {{ $slaBorder }}; width: 260px; overflow: hidden; display: flex; flex-direction: column;">
                        <div style="padding: 10px 14px; border-bottom: 1px solid rgba(255,255,255,0.2);">
                            <div style="font-size: 10px; font-weight: 800; color: {{ $slaColor }}; opacity: 0.95; margin-bottom: 2px; text-transform: uppercase; letter-spacing: 0.05em;">Batas Waktu (SLA)</div>
                            <div style="font-size: 12.5px; color: {{ $slaColor }};">Target: <strong style="font-weight: 800;">{{ $targetDate->format('d M Y') }}</strong></div>
                        </div>
                        <div style="padding: 12px 14px; background: rgba(0,0,0,0.06);">
                            @if($isSelesai)
                                <div style="display: flex; align-items: center; gap: 8px; color: {{ $slaColor }}; font-weight: 700; font-size: 13px;">
                                    <div style="width: 24px; height: 24px; border-radius: 50%; background: rgba(255,255,255,0.25); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                    <span>Tepat Waktu (Selesai)</span>
                                </div>
                            @else
                                <div style="font-size: 10px; color: {{ $slaColor }}; opacity: 0.95; margin-bottom: 8px; font-weight: 700;">WAKTU TERSISA:</div>
                                <div id="liveCountdownSla" data-target="{{ $targetDate->toIso8601String() }}" data-color="{{ $slaColor }}" style="display: flex; gap: 6px; align-items: center; justify-content: space-between;">
                                    <!-- Countdown script will inject here -->
                                </div>
                            @endif
                        </div>
                    </div>

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const targetEl = document.getElementById('liveCountdownSla');
                            if(!targetEl) return;
                            
                            const targetDate = new Date(targetEl.getAttribute('data-target')).getTime();
                            const textColor = targetEl.getAttribute('data-color');
                            
                            function updateCountdown() {
                                const now = new Date().getTime();
                                const distance = targetDate - now;
                                
                                if (distance < 0) {
                                    targetEl.innerHTML = '<div style="color: ' + textColor + '; font-weight: 800; font-size: 13px; display: flex; align-items: center; gap: 8px;"><svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg> Waktu Habis!</div>';
                                    return;
                                }
                                
                                const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                                const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                const seconds = Math.floor((distance % (1000 * 60)) / 1000);
                                
                                const blockStyle = 'background: rgba(255,255,255,0.2); padding: 6px 2px; border-radius: 4px; text-align: center; flex: 1; border: 1px solid rgba(255,255,255,0.1);';
                                const numStyle = 'font-size: 14.5px; font-weight: 800; color: ' + textColor + '; font-family: monospace; line-height: 1; margin-bottom: 2px;';
                                const labelStyle = 'font-size: 8.5px; font-weight: 700; color: ' + textColor + '; opacity: 0.9; text-transform: uppercase; letter-spacing: 0.05em;';
                                
                                targetEl.innerHTML = `
                                    <div style="${blockStyle}"><div style="${numStyle}">${days}</div><div style="${labelStyle}">HARI</div></div>
                                    <div style="font-weight: 800; color: ${textColor}; opacity: 0.5; padding-bottom: 12px;">:</div>
                                    <div style="${blockStyle}"><div style="${numStyle}">${hours.toString().padStart(2, '0')}</div><div style="${labelStyle}">JAM</div></div>
                                    <div style="font-weight: 800; color: ${textColor}; opacity: 0.5; padding-bottom: 12px;">:</div>
                                    <div style="${blockStyle}"><div style="${numStyle}">${minutes.toString().padStart(2, '0')}</div><div style="${labelStyle}">MNT</div></div>
                                    <div style="font-weight: 800; color: ${textColor}; opacity: 0.5; padding-bottom: 12px;">:</div>
                                    <div style="${blockStyle}"><div style="${numStyle}">${seconds.toString().padStart(2, '0')}</div><div style="${labelStyle}">DTK</div></div>
                                `;
                            }
                            
                            updateCountdown();
                            setInterval(updateCountdown, 1000);
                        });
                    </script>

                    <div class="card" style="position: sticky; top: 88px;">
                        <!-- Timeline Tracker -->
                        
                        <div class="timeline">
                            
                            <!-- STEP 1: Diajukan -->
                            <div class="timeline-step completed">
                                <span class="timeline-dot"></span>
                                <div class="timeline-content">
                                    <div class="timeline-title">Berkas Berhasil Diajukan</div>
                                    <div class="timeline-desc">Pelaku usaha berhasil mengunggah berkas persyaratan secara lengkap ke portal PATEN PAK MIKO.</div>
                                    <div style="font-size:11px;color:#558B2F;margin-top:5px;font-weight:600;">📅 {{ $application->created_at->locale('id')->translatedFormat('l, d M Y · H:i') }} WIB</div>
                                </div>
                            </div>

                            <!-- STEP 2: Verifikasi & Validasi -->
                            @php
                                $step2Status = 'active';
                                if ($application->bpn_berkas_status === 'diterima') {
                                    $step2Status = 'completed';
                                } elseif ($application->bpn_berkas_status === 'ditolak') {
                                    $step2Status = 'rejected';
                                }
                            @endphp
                            <div class="timeline-step {{ $step2Status }}" onclick="showBpnPanel(1)" style="cursor:pointer;">
                                <span class="timeline-dot"></span>
                                <div class="timeline-content">
                                    <div class="timeline-title">
                                        1. Verifikasi, Validasi dan Pendaftaran Permohonan
                                        <span style="font-size: 10px; font-weight: 600; color: var(--clr-muted); background: rgba(0,0,0,0.05); padding: 1px 6px; border-radius: 10px;">Kantor Pertanahan (BPN)</span>
                                    </div>
                                    <div class="timeline-desc">Validasi awal kelengkapan berkas dokumen persyaratan pemohon.</div>
                                    @if($application->bpn_sps_document)
                                        <div style="margin-top: 8px;">
                                            <a href="{{ asset('storage/' . $application->bpn_sps_document) }}" target="_blank" class="btn-submit-v" style="background: var(--clr-blue); color: #fff; padding: 6px 12px; font-size: 11px; text-decoration: none; display: inline-flex; align-items: center; border-radius: 4px; margin: 0;">
                                                <svg style="width:14px;height:14px;margin-right:4px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                                Unduh Surat Perintah Setor (SPS)
                                            </a>
                                        </div>
                                    @endif
                                    @if($application->bpn_berkas_status === 'diterima' && $application->bpn_berkas_approved_at)
                                        <div style="font-size:11px;color:#558B2F;margin-top:6px;font-weight:600;"><svg style="width:14px;height:14px;vertical-align:-2px;margin-right:4px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg> Disetujui pada: {{ \Carbon\Carbon::parse($application->bpn_berkas_approved_at)->format('d M Y, H:i') }} WIB</div>
                                    @endif
                                </div>
                            </div>

                            <!-- STEP 2: Pembayaran PNBP -->
                            @php
                                $step2bStatus = '';
                                if ($application->bpn_berkas_status === 'diterima') {
                                    if ($application->bpn_pembayaran_status === 'sudah_bayar') {
                                        $step2bStatus = 'completed';
                                    } else {
                                        $step2bStatus = 'active';
                                    }
                                }
                            @endphp
                            <div class="timeline-step {{ $step2bStatus }}" onclick="showBpnPanel(2)" style="cursor:pointer;">
                                <span class="timeline-dot"></span>
                                <div class="timeline-content">
                                    <div class="timeline-title">
                                        2. Pembayaran PNBP
                                        <span style="font-size: 10px; font-weight: 600; color: var(--clr-muted); background: rgba(0,0,0,0.05); padding: 1px 6px; border-radius: 10px;">Kantor Pertanahan (BPN)</span>
                                    </div>
                                    <div class="timeline-desc">Pembayaran biaya PNBP & aktivasi akun.</div>
                                    @if($application->bpn_pembayaran_status === 'sudah_bayar')
                                        <div class="timeline-notes" style="border-left-color: var(--clr-green); background: #F4FBF7; color: #137333;">
                                            <strong>No. Berkas:</strong> {{ $application->no_berkas }}<br>
                                            Status: <strong>LUNAS</strong>. Akun telah dikirim ke WA.
                                        </div>
                                    @endif
                                    @if($application->bpn_pembayaran_status === 'sudah_bayar' && $application->bpn_pembayaran_approved_at)
                                        <div style="font-size:11px;color:#558B2F;margin-top:5px;font-weight:600;">📅 {{ \Carbon\Carbon::parse($application->bpn_pembayaran_approved_at)->locale('id')->translatedFormat('l, d M Y · H:i') }} WIB</div>
                                    @endif
                                </div>
                            </div>

                            <!-- STEP 3: Peninjauan Lapangan (Kantor Pertanahan (BPN)) -->
                            @php
                                $step3Status = '';
                                if ($application->bpn_pembayaran_status === 'sudah_bayar') {
                                    if ($application->bpn_cek_lokasi_dt) {
                                        $step3Status = $cekLokasiLewat ? 'completed' : 'active';
                                    } else {
                                        $step3Status = 'active';
                                    }
                                }
                            @endphp
                            <div class="timeline-step {{ $step3Status }}" onclick="showBpnPanel(3)" style="cursor:pointer;">
                                <span class="timeline-dot"></span>
                                <div class="timeline-content">
                                    <div class="timeline-title">
                                        3. Peninjauan Lapangan (Kantor Pertanahan (BPN))
                                        <span style="font-size: 10px; font-weight: 600; color: var(--clr-muted); background: rgba(0,0,0,0.05); padding: 1px 6px; border-radius: 10px;">Kantor Pertanahan (BPN)</span>
                                    </div>
                                    <div class="timeline-desc">
                                        @if($application->bpn_cek_lokasi_dt)
                                            Dijadwalkan pada: <strong>{{ $application->bpn_cek_lokasi_date }}</strong><br>
                                            CP Lapangan: <strong>{{ $application->bpn_cek_lokasi_cp }}</strong>
                                        @else
                                            Menunggu penentuan jadwal peninjauan lapangan offline.
                                        @endif
                                    </div>
                                    @if($application->bpn_cek_lokasi_dt)
                                        <div style="font-size:11px;color:#558B2F;margin-top:5px;font-weight:600;">📅 Dijadwalkan: {{ \Carbon\Carbon::parse($application->bpn_cek_lokasi_dt)->locale('id')->translatedFormat('l, d M Y · H:i') }} WIB</div>
                                    @endif
                                </div>
                            </div>

                            <!-- STEP 4: Rapat Pembahasan Pertek (Kantor Pertanahan (BPN)) -->
                            @php
                                $step4Status = '';
                                if ($cekLokasiLewat) {
                                    if ($application->bpn_rapat_dt) {
                                        $step4Status = $rapatLewat ? 'completed' : 'active';
                                    } else {
                                        $step4Status = 'active';
                                    }
                                }
                            @endphp
                            <div class="timeline-step {{ $step4Status }}" onclick="showBpnPanel(4)" style="cursor:pointer;">
                                <span class="timeline-dot"></span>
                                <div class="timeline-content">
                                    <div class="timeline-title">
                                        4. Rapat Pembahasan
                                        <span style="font-size: 10px; font-weight: 600; color: var(--clr-muted); background: rgba(0,0,0,0.05); padding: 1px 6px; border-radius: 10px;">Kantor Pertanahan (BPN)</span>
                                    </div>
                                    <div class="timeline-desc">
                                        @if($application->bpn_rapat_dt)
                                            Dijadwalkan pada: <strong>{{ $application->bpn_rapat_date }}</strong>
                                        @else
                                            Menunggu penentuan jadwal rapat koordinasi pertanahan.
                                        @endif
                                    </div>
                                    @if($application->bpn_rapat_dt)
                                        <div style="font-size:11px;color:#558B2F;margin-top:5px;font-weight:600;">📅 Dijadwalkan: {{ \Carbon\Carbon::parse($application->bpn_rapat_dt)->locale('id')->translatedFormat('l, d M Y · H:i') }} WIB</div>
                                    @endif
                                </div>
                            </div>

                            <!-- STEP 5: Penerbitan Pertek Kantor Pertanahan (BPN) (Included in Kantor Pertanahan (BPN) step above usually, but keeping it if needed) -->
                            @php
                                $step5Status = '';
                                if ($rapatLewat) {
                                    if ($application->bpn_pertek_document) {
                                        $step5Status = 'completed';
                                    } elseif ($application->status === 'ditolak') {
                                        $step5Status = 'rejected';
                                    } else {
                                        $step5Status = 'active';
                                    }
                                }
                            @endphp
                            <div class="timeline-step {{ $step5Status }}" onclick="showBpnPanel(5)" style="display: none; cursor:pointer;">
                                <span class="timeline-dot"></span>
                                <div class="timeline-content">
                                    <div class="timeline-title">
                                        5. Penerbitan Pertek Pertanahan
                                        <span style="font-size: 10px; font-weight: 600; color: var(--clr-muted); background: rgba(0,0,0,0.05); padding: 1px 6px; border-radius: 10px;">Kantor Pertanahan (BPN)</span>
                                    </div>
                                    <div class="timeline-desc">
                                        @if($application->bpn_pertek_document)
                                            Dokumen Pertek resmi diterbitkan. Permohonan diteruskan ke instansi selanjutnya.
                                        @else
                                            Menunggu rapat selesai untuk penerbitan rekomendasi teknis.
                                        @endif
                                    </div>
                                    @if($application->bpn_pertek_uploaded_at)
                                        <div style="font-size:11px;color:#558B2F;margin-top:5px;font-weight:600;">📅 {{ \Carbon\Carbon::parse($application->bpn_pertek_uploaded_at)->locale('id')->translatedFormat('l, d M Y · H:i') }} WIB</div>
                                    @endif
                                </div>
                            </div>


                            <!-- STEP 7: Penerbitan Pertimbangan Teknis Pertanahan DPMPTSP -->
                            @php
                                $step7Status = '';
                                if (in_array($application->status, ['menunggu_satu_pintu', 'disetujui'])) {
                                    $step7Status = $application->status === 'disetujui' ? 'completed' : 'active';
                                }
                            @endphp
                            <div class="timeline-step {{ $step7Status }}" onclick="showBpnPanel('satu-pintu')" style="cursor:pointer;">
                                <span class="timeline-dot"></span>
                                <div class="timeline-content">
                                    <div class="timeline-title">
                                        5. Penerbitan Pertimbangan Teknis Pertanahan
                                        <span style="font-size: 10px; font-weight: 600; color: var(--clr-muted); background: rgba(0,0,0,0.05); padding: 1px 6px; border-radius: 10px;">Dinas PMPTSP</span>
                                    </div>
                                    <div class="timeline-desc">
                                        DPMPTSP menerbitkan dokumen Pertimbangan Teknis Pertanahan resmi.
                                    </div>
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

                            <!-- STEP 8: Selesai / Ditolak -->
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
                                            Permohonan dihentikan/ditolak oleh instansi terkait (Kantor Pertanahan (BPN) atau DPMPTSP).
                                        @elseif($application->status === 'disetujui')
                                            Seluruh alur selesai. Dokumen Kebijakan siap diunduh dari portal.
                                        @else
                                            Menunggu seluruh tahapan selesai disetujui semua instansi terkait.
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

<!-- TIMELINE UX ENHANCEMENTS -->
<style>
    .timeline-step.viewing-step {
        background: #F0F9FF;
        border-radius: 8px;
        padding-left: 8px;
        margin-left: -8px;
        outline: 1px solid #BAE6FD;
        transition: all 0.3s ease;
    }
    .timeline-step.viewing-step .timeline-title {
        color: #0369A1;
    }
    .timeline-step.viewing-step .timeline-title::after {
        content: "📍";
        display: inline-block;
        font-size: 14px;
        margin-left: 6px;
        vertical-align: middle;
        animation: pin-bounce 1s infinite;
    }
    @keyframes pin-bounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-3px); }
    }
    .global-nav-buttons {
        display: flex;
        justify-content: space-between;
        padding: 12px 16px;
        background: #F8FAFC;
        border-top: 1px solid #E2E8F0;
        border-bottom-left-radius: 12px;
        border-bottom-right-radius: 12px;
        position: sticky;
        bottom: 0;
        z-index: 10;
    }
    .btn-nav-global {
        padding: 6px 14px;
        font-size: 12px;
        font-weight: 600;
        border-radius: 6px;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        border: 1px solid #CBD5E1;
        background: #FFFFFF;
        color: #475569;
        transition: all 0.2s;
        box-shadow: 0 1px 2px rgba(0,0,0,0.05);
    }
    .btn-nav-global:hover:not(:disabled) {
        background: #F1F5F9;
        color: #0F172A;
        border-color: #94A3B8;
    }
    .btn-nav-global:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }
    
    .btn-cek-detail {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        margin-top: 8px;
        padding: 4px 10px;
        font-size: 10.5px;
        font-weight: 700;
        color: #0284C7;
        background: #E0F2FE;
        border: 1px solid #BAE6FD;
        border-radius: 4px;
        cursor: pointer;
        transition: all 0.2s;
    }
    .btn-cek-detail:hover {
        background: #BAE6FD;
        color: #0369A1;
    }
    .timeline-step.viewing-step .btn-cek-detail {
        background: #0EA5E9;
        color: #FFFFFF;
        border-color: #0284C7;
    }
    .timeline-step:hover .btn-cek-detail {
        box-shadow: 0 2px 4px rgba(14,165,233,0.2);
    }
</style>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const timelineSteps = Array.from(document.querySelectorAll('.timeline-step[onclick^="showBpnPanel"]'));
    if(timelineSteps.length === 0) return;
    
    let currentIndex = 0;
    
    // Inject "Cek Detail" button into each clickable timeline step for better UX
    timelineSteps.forEach(step => {
        const contentDiv = step.querySelector('.timeline-content');
        if(contentDiv && !contentDiv.querySelector('.btn-cek-detail')) {
            const btn = document.createElement('button');
            btn.type = 'button';
            btn.className = 'btn-cek-detail';
            btn.innerHTML = '<svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg> Cek Detail';
            
            // The button doesn't need its own click event because it's inside the step which already has a click event.
            // But we add a dummy one to prevent event bubbling issues if needed, actually it's fine.
            contentDiv.appendChild(btn);
        }
    });
    
    // Create Global Nav Container
    const navDiv = document.createElement('div');
    navDiv.className = 'global-nav-buttons';
    
    const prevBtn = document.createElement('button');
    prevBtn.type = 'button';
    prevBtn.className = 'btn-nav-global';
    prevBtn.innerHTML = '<svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg> Sebelumnya';
    
    const nextBtn = document.createElement('button');
    nextBtn.type = 'button';
    nextBtn.className = 'btn-nav-global';
    nextBtn.innerHTML = 'Selanjutnya <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>';
    
    navDiv.appendChild(prevBtn);
    navDiv.appendChild(nextBtn);
    
    // Find the timeline container
    const timelineBody = document.querySelector('.timeline');
    if(timelineBody) {
        const card = timelineBody.closest('.card');
        if(card) {
            // Append to the bottom of the card
            card.appendChild(navDiv);
        }
    }
    
    function updateNavButtons() {
        prevBtn.disabled = currentIndex === 0;
        nextBtn.disabled = currentIndex === timelineSteps.length - 1;
    }
    
    function switchPanel(index) {
        if(index < 0 || index >= timelineSteps.length) return;
        
        currentIndex = index;
        const targetStep = timelineSteps[currentIndex];
        const match = targetStep.getAttribute('onclick').match(/showBpnPanel\(['"]?([^'"]+)['"]?\)/);
        
        if(match) {
            const tPanel = document.getElementById('bpn-panel-' + match[1]);
            document.querySelectorAll('.bpn-panel-step').forEach(p => p.style.display = 'none');
            if(tPanel) { 
                tPanel.style.display = 'block'; 
            }
            
            document.querySelectorAll('.timeline-step').forEach(ts => ts.classList.remove('viewing-step'));
            targetStep.classList.add('viewing-step');
            
            targetStep.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }
        updateNavButtons();
    }
    
    // Override click on timeline steps to sync currentIndex
    timelineSteps.forEach((step, index) => {
        step.addEventListener('click', function(e) {
            e.preventDefault(); 
            switchPanel(index);
        });
    });
    
    prevBtn.addEventListener('click', () => switchPanel(currentIndex - 1));
    nextBtn.addEventListener('click', () => switchPanel(currentIndex + 1));
    
    // Initialize
    setTimeout(() => {
        const activePanel = document.querySelector('.bpn-panel-step[style*="display: block"]');
        if(activePanel) {
            const panelIdMatch = activePanel.id.replace('bpn-panel-', '');
            const activeStepIndex = timelineSteps.findIndex(s => s.getAttribute('onclick').includes(panelIdMatch));
            if(activeStepIndex !== -1) {
                switchPanel(activeStepIndex);
            } else {
                switchPanel(0);
            }
        } else {
            switchPanel(0);
        }
    }, 150);
});
</script>
</body>
</html>