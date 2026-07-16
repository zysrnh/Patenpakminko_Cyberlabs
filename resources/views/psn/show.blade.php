<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Permohonan {{ $application->application_number }} — PATEN PAK MIKO</title>
    
    <!-- Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/material_blue.css">
    <style>
        .flatpickr-calendar .flatpickr-day.flatpickr-disabled:not(.prevMonthDay):not(.nextMonthDay) {
            color: #E53E3E !important;
            background-color: #FFF5F5 !important;
            font-weight: bold !important;
            opacity: 1 !important;
            border-radius: 4px;
        }
        .form-control-v.flatpickr-input[readonly], .flatpickr-input[readonly] {
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20" fill="%232B6CB0"><path d="M19 4h-1V2h-2v2H8V2H6v2H5c-1.11 0-1.99.9-1.99 2L3 20a2 2 0 0 0 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V10h14v10zm0-12H5V6h14v2z"/></svg>');
            background-repeat: no-repeat;
            background-position: right 10px center;
            padding-right: 36px;
            cursor: pointer;
            background-color: #fff;
        }
    </style>
    
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
        main {
            padding: 40px 0;
        }
 
        /* ─── SLA BANNER ─────────────────────────────────────── */
        .sla-banner {
            background: #F0F6FB;
            border-left: 4px solid var(--clr-blue);
            padding: 16px 20px;
            border-radius: var(--radius-md);
            margin-bottom: 28px;
            display: flex;
            gap: 24px;
            align-items: center;
        }
        .sla-item {
            flex: 1;
        }
        .sla-item.divider {
            border-left: 1px solid #D6E4EF;
            padding-left: 24px;
        }
        .sla-title {
            font-size: 11px;
            font-weight: 700;
            color: var(--clr-blue);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 4px;
        }
        .sla-value {
            font-size: 15px;
            font-weight: 800;
            color: var(--clr-ink);
        }
        .sla-desc {
            font-size: 11.5px;
            color: var(--clr-muted);
            margin-top: 4px;
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

        .grid-layout {
            display: grid;
            grid-template-columns: 1.2fr 1fr;
            gap: 28px;
            align-items: start;
        }
        @media (max-width: 900px) {
            .grid-layout { grid-template-columns: 1fr; }
        }

        /* ─── CARDS ──────────────────────────────────────────── */
        .card {
            background: var(--clr-white);
            border: 1px solid var(--clr-line);
            border-radius: var(--radius-lg);
            padding: 24px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.01);
            margin-bottom: 28px;
        }

        .card-title {
            font-size: 15px;
            font-weight: 800;
            color: var(--clr-ink);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 20px;
            padding-bottom: 8px;
            border-bottom: 1.5px solid var(--clr-line);
        }

        /* ─── DATA LIST ──────────────────────────────────────── */
        .data-list {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .data-item {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }
        .data-label {
            font-size: 11px;
            font-weight: 700;
            color: var(--clr-muted);
            text-transform: uppercase;
            letter-spacing: 0.03em;
        }
        .data-val {
            font-size: 14px;
            font-weight: 600;
            color: var(--clr-ink);
        }
        .data-val.mono {
            font-family: 'DM Mono', monospace;
            color: var(--clr-blue);
        }

        /* ─── DOCUMENT DOWNLOADS ────────────────────────────── */
        .doc-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .doc-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 16px;
            background: var(--clr-surface);
            border: 1px solid var(--clr-line);
            border-radius: var(--radius-md);
            text-decoration: none;
            color: var(--clr-ink);
            transition: all 0.2s;
        }
        .doc-item:hover {
            border-color: var(--clr-blue);
            background: var(--clr-blue-lt);
        }
        .doc-name {
            font-size: 13px;
            font-weight: 600;
        }
        .doc-status {
            font-size: 11.5px;
            font-weight: 700;
            color: var(--clr-blue);
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }
        .doc-status svg {
            width: 14px;
            height: 14px;
            stroke-width: 2.5;
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
            display: flex;
            flex-direction: column;
            position: relative;
            padding-left: 28px;
            margin-top: 10px;
        }
        .timeline::before {
            content: '';
            position: absolute;
            left: 8px;
            top: 4px;
            bottom: 4px;
            width: 2px;
            background: var(--clr-line);
        }

        .timeline-step {
            position: relative;
            margin-bottom: 28px;
        }
        .timeline-step:last-child {
            margin-bottom: 0;
        }

        .timeline-dot {
            position: absolute;
            left: -28px;
            top: 2px;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background: var(--clr-white);
            border: 3px solid var(--clr-line);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.25s;
        }

        /* Timeline States */
        .timeline-step.completed .timeline-dot {
            border-color: var(--clr-green);
            background: var(--clr-green);
        }
        .timeline-step.active .timeline-dot {
            border-color: var(--clr-blue);
            background: var(--clr-white);
        }
        .timeline-step.rejected .timeline-dot {
            border-color: #E53E3E;
            background: #E53E3E;
        }

        .timeline-step.completed .timeline-dot::after {
            content: '';
            width: 6px;
            height: 4px;
            border-left: 1.5px solid white;
            border-bottom: 1.5px solid white;
            transform: rotate(-45deg) translateY(-1px);
        }

        .timeline-step.active .timeline-dot::after {
            content: '';
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: var(--clr-blue);
        }

        .timeline-title {
            font-size: 13.5px;
            font-weight: 700;
            color: var(--clr-ink);
            margin-bottom: 4px;
        }
        .timeline-step.active .timeline-title {
            color: var(--clr-blue);
        }
        
        .timeline-desc {
            font-size: 12px;
            color: var(--clr-mid);
            line-height: 1.4;
        }

        .timeline-notes {
            margin-top: 8px;
            padding: 8px 12px;
            background: var(--clr-surface);
            border-left: 3px solid var(--clr-blue);
            border-radius: 0 var(--radius-sm) var(--radius-sm) 0;
            font-size: 12px;
            color: var(--clr-ink);
            line-height: 1.4;
        }
        .timeline-step.completed .timeline-notes {
            border-color: var(--clr-green);
        }
        .timeline-step.rejected .timeline-notes {
            border-color: #E53E3E;
            background: #FFF5F5;
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
 
        fieldset {
            border: none;
            padding: 0;
            margin: 0;
            min-width: 0;
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
            background: var(--clr-green);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: var(--radius-md);
            font-family: inherit;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s;
            box-shadow: 0 4px 12px rgba(149, 185, 62, 0.2);
            width: 100%;
            justify-content: center;
            margin-bottom: 28px;
        }
        .btn-download-cert:hover {
            background: var(--clr-green-dk);
            transform: translateY(-0.5px);
        }
    </style>
</head>
<body>

    <!-- Header -->
    <header>
        <div class="container" style="max-width: 1000px;">
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
                </div>
            @endif

            <div class="page-header">
                <div>
                    <a href="{{ route('psn.index') }}" class="back-btn">
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
                    <a href="{{ route('file.view', ['path' => $application->bpn_pertek_document]) }}" target="_blank" class="btn-download-cert" style="background:#79A73A; margin-bottom: 20px;">
                        <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                        Unduh Dokumen Pertek Pertanahan
                    </a>
                @elseif($application->approval_document)
                    <a href="{{ route('file.view', ['path' => $application->approval_document]) }}" target="_blank" class="btn-download-cert" style="margin-bottom: 20px;">
                        <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                        Unduh Dokumen PKKPR PSN (PDF)
                    </a>
                @endif
            @endif
 
            <!-- FITUR ULASAN LAYANAN (ANTI-SPAM) -->
            @if($application->bpn_pertek_document)
                @php
                    $review = \App\Models\Review::where('user_id', Auth::id())
                        ->where('module_type', 'psn')
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
                                <input type="hidden" name="module_type" value="psn">
                                <input type="hidden" name="module_id" value="{{ $application->id }}">
                                
                                <style>
                                    .star-rating { display: flex; flex-direction: row-reverse; justify-content: flex-end; gap: 4px; }
                                    .star-rating input { display: none; }
                                    .star-rating label { font-size: 32px; color: #CBD5E0; cursor: pointer; transition: color 0.2s; line-height: 1; margin: 0; padding: 0; }
                                    .star-rating input:checked ~ label, .star-rating label:hover, .star-rating label:hover ~ label { color: #D69E2E; }
                                </style>
                                <div class="form-group-v" style="margin-bottom: 12px;">
                                    <label style="font-weight: 700; font-size: 12px; display: block; margin-bottom: 6px;">Penilaian Anda</label>
                                    <div class="star-rating">
                                        <input type="radio" id="star5" name="rating" value="5" required />
                                        <label for="star5" title="Sangat Baik">★</label>
                                        <input type="radio" id="star4" name="rating" value="4" />
                                        <label for="star4" title="Baik">★</label>
                                        <input type="radio" id="star3" name="rating" value="3" />
                                        <label for="star3" title="Cukup Baik">★</label>
                                        <input type="radio" id="star2" name="rating" value="2" />
                                        <label for="star2" title="Kurang">★</label>
                                        <input type="radio" id="star1" name="rating" value="1" />
                                        <label for="star1" title="Sangat Kurang">★</label>
                                    </div>
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

            <!-- PENGATURAN SLA WAKTU LAYANAN (HANYA ADMIN Kantor Pertanahan / DPN) -->
            @if((Auth::user()->isBpn() || Auth::user()->isDpn()) && $application->bpn_pembayaran_status === 'sudah_bayar')
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
                    $verifierRoleLabel = 'Petugas Kantor Pertanahan (Verifikasi Kepemilikan Tanah)';
                } elseif ($user->isDinasPu() && $application->status === 'menunggu_dinas_pu') {
                    $canVerify = true;
                    $verifierRoleLabel = 'Verifikator Dinas Pekerjaan Umum dan Tata Ruang (PUTR)';
                } elseif ($user->isSatuPintu() && $application->status === 'menunggu_satu_pintu') {
                    $canVerify = true;
                    $verifierRoleLabel = 'Petugas DPMPTSP (Penerbitan Izin)';
                }

                // Logika Waktu Untuk Staged Timeline & Penentuan Form Aktif Kantor Pertanahan
                $now = \Carbon\Carbon::now();
                $cekLokasiLewat = $application->bpn_cek_lokasi_dt
                    && $now >= $application->bpn_cek_lokasi_dt;
                $rapatLewat = $application->bpn_rapat_dt
                    && $now >= $application->bpn_rapat_dt;
            @endphp

                            <div class="verify-card">
                    <h3 class="verify-title"><svg style="width:16px;height:16px;vertical-align:-3px;margin-right:6px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg> Panel Pemeriksaan Berkas</h3>

                        {{-- ====== TABS / PANELS UNTUK SETIAP LANGKAH ====== --}}
                        {{-- ====== TABS / PANELS UNTUK SETIAP LANGKAH ====== --}}
                        <div id="Kantor Pertanahan-panel-1" class="Kantor Pertanahan-panel-step" style="display: {{ in_array($application->bpn_berkas_status, ['menunggu', 'tidak_sesuai', 'ditolak']) ? 'block' : 'none' }};">
                            @php $isStep1Active = (Auth::user()->isBpn() && $application->bpn_berkas_status === 'menunggu'); @endphp
                            <fieldset {{ $isStep1Active ? '' : 'disabled' }}>
                                <form action="{{ route('psn.verify', $application->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="step" value="bpn_berkas">
                                    <div style="background:#FFFDF5;border:1px solid #F6AD55;padding:12px 16px;border-radius:8px;font-size:13px;color:#7B341E;margin-bottom:20px;">
                                        <strong>Langkah 1 dari 4 — Verifikasi Berkas Awal:</strong> Periksa kelengkapan dokumen persyaratan yang diunggah pemohon, lalu terima atau tolak. Notifikasi WA akan terkirim otomatis.
                                    </div>
                                    <div class="form-group-v" style="margin-bottom: 20px;">
                                        <label class="form-label" style="font-weight:700;color:#744210;margin-bottom:8px;display:block;">Tindakan Pemeriksaan Berkas:</label>
                                        <div style="display: flex; gap: 20px;">
                                            <label style="display:flex;align-items:center;gap:6px;font-size:13.5px;font-weight:600;cursor:pointer;">
                                                <input type="radio" name="action" value="approve" required {{ $application->bpn_berkas_status === 'diterima' ? 'checked' : ($application->bpn_berkas_status === 'ditolak' || $application->bpn_berkas_status === 'tidak_sesuai' ? '' : 'checked') }} style="width:16px;height:16px;accent-color:var(--clr-blue);" onchange="document.getElementById('sps-upload-container').style.display='block'; document.getElementById('sps_document').required=true; document.getElementById('revisi-berkas-container').style.display='none';"> Disetujui / Lengkap
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
                                            <label><input type="checkbox" class="cb-revisi" value="Penetapan Dokumen PSN"> Penetapan Dokumen PSN</label>
                                            <label><input type="checkbox" class="cb-revisi" value="Rencana Penggunaan Tanah"> Rencana Penggunaan Tanah</label>
                                            <label><input type="checkbox" class="cb-revisi" value="Bukti Penguasaan Tanah"> Bukti Penguasaan Tanah</label>
                                            <label><input type="checkbox" class="cb-revisi" value="NIB"> NIB</label>
                                            <label><input type="checkbox" class="cb-revisi" value="KBLI"> KBLI</label>
                                            <label><input type="checkbox" class="cb-revisi" value="Persyaratan Lainnya"> Persyaratan Lainnya</label>
                                        </div>
                                    </div>

                                    <div class="form-group-v">
                                        <label for="notes" style="display: block; font-size: 12.5px; font-weight: 700; color: var(--clr-ink); margin-bottom: 6px;">Catatan Pemeriksaan</label>
                                        <textarea id="notes" name="notes" class="form-control-v" rows="3" placeholder="Masukkan catatan atau instruksi perbaikan..." required>{{ $application->bpn_berkas_status !== 'menunggu' ? $application->bpn_notes : '' }}</textarea>
                                    </div>
                                    <script>
                                        document.addEventListener('DOMContentLoaded', function() {
                                            const checkboxes = document.querySelectorAll('.cb-revisi');
                                            const notesArea = document.getElementById('notes');
                                            
                                            checkboxes.forEach(cb => {
                                                cb.addEventListener('change', function() {
                                                    let activeNotes = [];
                                                    checkboxes.forEach(c => {
                                                        if(c.checked) activeNotes.push("- " + c.value);
                                                    });
                                                    
                                                    if(activeNotes.length > 0) {
                                                        notesArea.value = "Mohon perbaiki dokumen berikut:\n" + activeNotes.join("\n") + "\n\nCatatan Tambahan: ";
                                                    } else {
                                                        notesArea.value = "";
                                                    }
                                                });
                                            });
                                        });
                                    </script>
                                    @if($isStep1Active)
                                        <button type="submit" class="btn-submit-v">Simpan Verifikasi Berkas</button>
                                    @else
                                        
                                    @endif
                                </form>
                            </fieldset>
                            @if(Auth::user()->isBpn() && $application->bpn_berkas_status !== 'menunggu' && $application->status === 'menunggu_bpn')
                                <form action="{{ route('psn.verify', $application->id) }}" method="POST" style="margin-top: 16px;">
                                    @csrf
                                    <input type="hidden" name="step" value="resend_wa">
                                    <input type="hidden" name="wa_type" value="berkas_verifikasi">
                                    <div class="form-group-v" style="margin-top: 12px; margin-bottom: 12px; text-align: left;">
                                        <label style="font-size: 11px; color: var(--clr-muted);">Edit Pesan WA (Opsional):</label>
                                        <textarea name="custom_wa_message" class="form-control-v" rows="2" placeholder="Tuliskan pesan khusus jika ingin mengganti template bawaan..."></textarea>
                                    </div>
                                    <button type="submit" class="btn-submit-v" style="background: var(--clr-green); width: 100%; justify-content: center;">
                                        Kirim Ulang Notifikasi WhatsApp
                                    </button>
                                </form>
                            @endif
                        </div>

                        <div id="Kantor Pertanahan-panel-2" class="Kantor Pertanahan-panel-step" style="display: {{ $application->bpn_berkas_status === 'diterima' && $application->bpn_pembayaran_status === 'menunggu' ? 'block' : 'none' }};">
                            @php $isStep2Active = (Auth::user()->isBpn() && $application->bpn_berkas_status === 'diterima' && $application->bpn_pembayaran_status === 'menunggu'); @endphp
                            <fieldset {{ $isStep2Active ? '' : 'disabled' }}>
                                <form action="{{ route('psn.verify', $application->id) }}" method="POST">
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
                        </div>

                        <div id="Kantor Pertanahan-panel-3" class="Kantor Pertanahan-panel-step" style="display: {{ $application->bpn_pembayaran_status === 'sudah_bayar' && (!$application->bpn_cek_lokasi_dt || !$cekLokasiLewat) ? 'block' : 'none' }};">
                            @php $isStep3Active = (Auth::user()->isBpn() && $application->bpn_pembayaran_status === 'sudah_bayar' && (!$application->bpn_cek_lokasi_dt || !$cekLokasiLewat)); @endphp
                            <fieldset {{ $isStep3Active ? '' : 'disabled' }}>
                                <form action="{{ route('psn.verify', $application->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="step" value="bpn_cek_lokasi">
                                    <div style="background:#FFFDF5;border:1px solid #F6AD55;padding:12px 16px;border-radius:8px;font-size:13px;color:#7B341E;margin-bottom:16px;">
                                        <strong>Langkah 3 dari 4 — Jadwal Peninjauan Lapangan</strong>
                                        @if($application->bpn_cek_lokasi_dt)
                                            @if($cekLokasiLewat)
                                                <span style="color:#276749;font-weight:700;"> <svg style="width:14px;height:14px;vertical-align:-2px;margin-right:4px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg> Selesai</span> —
                                                Peninjauan lapangan <strong>{{ $application->bpn_cek_lokasi_date }}</strong> sudah lewat. Jadwal bisa tetap diubah jika perlu.
                                            @else
                                                — Terjadwal: <strong>{{ $application->bpn_cek_lokasi_date }}</strong> (Contact Person Petugas Lapang: {{ $application->bpn_cek_lokasi_cp }}). Ubah jika ada perubahan.
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
                                            placeholder="cth: 08511234567 (Budi - Petugas Kantor Pertanahan)" style="background:white;" required>
                                    </div>
                                    @if($isStep3Active)
                                        <button type="submit" class="btn-submit-v" style="font-size:13px;padding:10px 20px;">
                                            {{ $application->bpn_cek_lokasi_dt ? '🔄 Ubah Jadwal Peninjauan Lapangan & Kirim WA' : '📍 Simpan Jadwal Peninjauan Lapangan & Blast WA' }}
                                        </button>
                                    @else
                                        <button type="submit" class="btn-submit-v" style="background: var(--clr-blue); width: 100%; justify-content: center;">
                                            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 2L11 13M22 2l-7 20-4-9-9-4 20-7z"/></svg>
                                            Kirim Ulang Pesan WA
                                        </button>
                                    @endif
                                </form>
                            </fieldset>

                            @if(Auth::user()->isBpn() && $application->bpn_cek_lokasi_dt)
                                <form action="{{ route('psn.verify', $application->id) }}" method="POST" style="margin-top: 16px;">
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
<div id="Kantor Pertanahan-panel-4" class="Kantor Pertanahan-panel-step" style="display: {{ $application->bpn_cek_lokasi_dt && $cekLokasiLewat && (!$application->bpn_rapat_dt || !$rapatLewat) ? 'block' : 'none' }};">
                            @php $isStep4Active = (Auth::user()->isBpn() && $application->bpn_cek_lokasi_dt && $cekLokasiLewat && (!$application->bpn_rapat_dt || !$rapatLewat)); @endphp
                            <fieldset {{ $isStep4Active ? '' : 'disabled' }}>
                                <form action="{{ route('psn.verify', $application->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="step" value="bpn_rapat">
                                    <div style="background:#EBF8FF;border:1px solid #90CDF4;padding:12px 16px;border-radius:8px;font-size:13px;color:#2B6CB0;margin-bottom:16px;">
                                        <strong>Langkah 4 dari 5 — Jadwal Rapat Koordinasi</strong>
                                        @if($application->bpn_rapat_dt)
                                            — Terjadwal: <strong>{{ $application->bpn_rapat_date }}</strong>. Ubah jika ada perubahan.
                                        @else
                                            — Peninjauan lapangan terdaftar. Tentukan waktu rapat koordinasi Kantor Pertanahan.
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
                                <form action="{{ route('psn.verify', $application->id) }}" method="POST" style="margin-top: 16px;">
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
<div id="Kantor Pertanahan-panel-5" class="Kantor Pertanahan-panel-step" style="display: {{ $application->bpn_rapat_dt && $rapatLewat && !$application->bpn_pertek_document ? 'block' : 'none' }};">
                            @php $isStep5Active = (Auth::user()->isBpn() && $application->bpn_rapat_dt && $rapatLewat && !$application->bpn_pertek_document); @endphp
                            <fieldset {{ $isStep5Active ? '' : 'disabled' }}>
                                <form action="{{ route('psn.verify', $application->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="step" value="bpn_pertek">
                                    <div style="background:#F0FFF4;border:1px solid #BBF7D0;padding:12px 16px;border-radius:8px;font-size:13px;color:#166534;margin-bottom:16px;line-height:1.6;">
                                        <strong>Langkah 5 dari 5 — Penerbitan Pertek Pertanahan</strong><br>
                                        Rapat terdaftar. Upload Dokumen Pertek dan beri keputusan akhir Kantor Pertanahan.
                                    </div>
                                    <div class="form-group-v">
                                        <label class="form-label" style="font-weight:700;color:#744210;">Keputusan Akhir Kantor Pertanahan:</label>
                                        <div class="radio-group">
                                            <label class="radio-label"><input type="radio" name="action" value="approve" required {{ $application->bpn_pertek_document || $application->status === 'disetujui' || $application->status === 'menunggu_dinas_pu' || $application->status === 'menunggu_satu_pintu' ? 'checked' : 'checked' }}> Disetujui</label>
                                            <label class="radio-label" style="color:#E53E3E;"><input type="radio" name="action" value="reject" required {{ $application->status === 'ditolak' && !$application->bpn_pertek_document && $application->bpn_berkas_status === 'diterima' ? 'checked' : '' }}> Tidak Disetujui</label>
                                        </div>
                                    </div>
                                    @if($application->bpn_pertek_document)
                                        <div class="form-group-v">
                                            <label class="form-label" style="font-weight:700;color:#744210;">Dokumen Pertek yang diterbitkan:</label>
                                            <a href="{{ route('file.view', ['path' => $application->bpn_pertek_document]) }}" target="_blank" style="color:#218AC9; text-decoration:underline;">Lihat Dokumen Pertek</a>
                                        </div>
                                    @else
                                        <div class="form-group-v" id="pertekUploadWrapper">
                                            <label class="form-label" style="font-weight:700;color:#744210;">Unggah Dokumen Pertek (PDF/DOC/DOCX) <span style="color:red;">*</span></label>
                                            <input type="file" id="bpn_pertek_document" name="bpn_pertek_document" class="form-control-v" accept=".pdf,.doc,.docx" style="background:white;">
                                        </div>
                                    @endif
                                    <div class="form-group-v">
                                        <label class="form-label" style="font-weight:700;color:#744210;">Catatan / Rekomendasi Teknis Kantor Pertanahan <span style="color:red;">*</span></label>
                                        <textarea name="notes" class="form-control-v" rows="3" placeholder="Tuliskan rekomendasi teknis atau alasan penolakan..." style="resize:none;background:white;" required>{{ $application->status === 'menunggu_dinas_pu' || $application->status === 'menunggu_satu_pintu' || $application->status === 'disetujui' || ($application->status === 'ditolak' && !$application->bpn_pertek_document && $application->bpn_berkas_status === 'diterima') ? $application->bpn_notes : '' }}</textarea>
                                    </div>
                                    @if($isStep5Active)
                                        <button type="submit" class="btn-submit-v" style="background:#79A73A;">📄 Terbitkan Pertek & Blast WA Pemohon</button>
                                    @else
                                        
                                    @endif
                                </form>
                            </fieldset>

                            @if(Auth::user()->isBpn() && $application->bpn_pertek_document)
                                <form action="{{ route('psn.verify', $application->id) }}" method="POST" style="margin-top: 16px;">
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
                                document.querySelectorAll('.Kantor Pertanahan-panel-step').forEach(function(el) {
                                    el.style.display = 'none';
                                });
                                // show the selected one
                                var target = document.getElementById('Kantor Pertanahan-panel-' + stepNum);
                                if(target) {
                                    target.style.display = 'block';
                                    target.scrollIntoView({ behavior: 'smooth', block: 'center' });
                                }
                            }
                        </script>


                        <div id="Kantor Pertanahan-panel-pu-1" class="Kantor Pertanahan-panel-step" style="display: {{ $application->bpn_pertek_document && $application->status !== 'menunggu_satu_pintu' && $application->status !== 'disetujui' ? 'block' : 'none' }};">
                            @php $isPuActive = (Auth::user()->isDinasPu() && $application->status === 'menunggu_dinas_pu'); @endphp
                            <fieldset {{ $isPuActive ? '' : 'disabled' }}>
                                <form action="{{ route('psn.verify', $application->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="step" value="dinas_pu_penilaian">
                                    <div style="background:#EBF8FF;border:1px solid #90CDF4;padding:12px 16px;border-radius:8px;font-size:13px;color:#2B6CB0;margin-bottom:16px;">
                                        <strong>Penilaian Tata Ruang (Dinas Pekerjaan Umum dan Tata Ruang (PUTR)):</strong> Periksa kesesuaian tata ruang berdasarkan dokumen Pertek Kantor Pertanahan, lalu tentukan keputusan.
                                    </div>
                                    <div class="form-group-v">
                                        <label class="form-label" style="font-weight:700;color:#744210;">Keputusan Penilaian:</label>
                                        <div class="radio-group">
                                            <label class="radio-label"><input type="radio" name="action" value="approve" required {{ $application->status === 'menunggu_satu_pintu' || $application->status === 'disetujui' ? 'checked' : 'checked' }}> Sudah Dinilai</label>
                                            <label class="radio-label" style="color:#E53E3E;"><input type="radio" name="action" value="reject" required {{ $application->status === 'ditolak' && !$application->satu_pintu_no_pkkpr ? 'checked' : '' }}> Belum Dinilai</label>
                                        </div>
                                    </div>
                                    <div class="form-group-v" style="margin-bottom:12px;">
                                        <label for="dinas_pu_tanggal_penilaian" class="form-label" style="font-weight:700;color:#744210;">Tanggal Penilaian <span style="color:red;">*</span></label>
                                        <input type="date" id="dinas_pu_tanggal_penilaian" name="dinas_pu_tanggal_penilaian" class="form-control-v"
                                                value="{{ $application->dinas_pu_tanggal_penilaian ? \Carbon\Carbon::parse($application->dinas_pu_tanggal_penilaian)->format('Y-m-d') : date('Y-m-d') }}" style="background:white;" required>
                                    </div>
                                    <div class="form-group-v" style="margin-bottom:12px;">
                                        <label for="dinas_pu_document" class="form-label" style="font-weight:700;color:#744210;">Unggah Dokumen Penilaian PU (opsional)</label>
                                        <input type="file" id="dinas_pu_document" name="dinas_pu_document" class="form-control-v" accept="application/pdf,.doc,.docx" style="background:white;">
                                        @if($application->dinas_pu_document)
                                            <a href="{{ route('file.view', ['path' => $application->dinas_pu_document]) }}" target="_blank" style="font-size:12px; color:#2B6CB0; display:block; margin-top:4px;">Lihat Dokumen Terunggah</a>
                                        @endif
                                    </div>
                                    <div class="form-group-v">
                                        <label for="notes_pu" class="form-label" style="font-weight:700;color:#744210;">Catatan Dinas Pekerjaan Umum dan Tata Ruang (PUTR) <span style="color:red;">*</span></label>
                                        <textarea id="notes_pu" name="notes" class="form-control-v" rows="3" placeholder="Tuliskan catatan penilaian tata ruang..." style="resize:none;background:white;" required>{{ $application->dinas_pu_notes }}</textarea>
                                    </div>
                                    @if($isPuActive)
                                        <button type="submit" class="btn-submit-v" style="background:#218AC9;">Kirim Keputusan Penilaian Tata Ruang</button>
                                    @else
                                        
                                    @endif
                                </form>
                            </fieldset>
                            @if(Auth::user()->isDinasPu() && $application->dinas_pu_tanggal_penilaian)
                                <form action="{{ route('psn.verify', $application->id) }}" method="POST" style="margin-top: 16px;">
                                    @csrf
                                    <input type="hidden" name="step" value="resend_wa">
                                    <input type="hidden" name="wa_type" value="{{ $application->status === 'ditolak' ? 'pu_tolak' : 'pu_selesai' }}">

                                    <button type="submit" class="btn-submit-v" style="background: var(--clr-blue); width: 100%; justify-content: center;">
                                        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 2L11 13M22 2l-7 20-4-9-9-4 20-7z"/></svg>
                                        Kirim Ulang Notifikasi PU (WhatsApp)
                                    </button>
                                </form>
                            @endif
                        </div>

                        <div id="Kantor Pertanahan-panel-satu-pintu" class="Kantor Pertanahan-panel-step" style="display: {{ in_array($application->status, ['menunggu_satu_pintu', 'disetujui']) ? 'block' : 'none' }};">
                            @php $isSpActive = (Auth::user()->isSatuPintu() && $application->status === 'menunggu_satu_pintu'); @endphp
                            <fieldset {{ $isSpActive ? '' : 'disabled' }}>
                                <form action="{{ route('psn.verify', $application->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="step" value="satu_pintu">
                                    <div style="background:#F0FFF4;border:1px solid #9AE6B4;padding:12px 16px;border-radius:8px;font-size:13px;color:#166534;margin-bottom:16px;">
                                        <strong>Penerbitan PKKPR PSN (DPMPTSP):</strong> Isi data penerbitan PKKPR resmi, lalu unggah dokumen dan kirim.
                                    </div>
                                    <div class="form-group-v">
                                        <label class="form-label" style="font-weight:700;color:#744210;">Keputusan:</label>
                                        <div class="radio-group">
                                            <label class="radio-label"><input type="radio" name="action" value="approve" required checked onclick="toggleSatuPintuFields(true)"> Disetujui</label>
                                            <label class="radio-label" style="color:#E53E3E;"><input type="radio" name="action" value="reject" required onclick="toggleSatuPintuFields(false)"> Tidak Disetujui</label>
                                        </div>
                                    </div>
                                    <div id="satuPintuFieldsWrapper">
                                        <div class="form-group-v" style="margin-bottom:12px;">
                                            <label for="satu_pintu_no_pkkpr" class="form-label" style="font-weight:700;color:#744210;">Nomor PKKPR PSN (wajib) <span style="color:red;">*</span></label>
                                            <input type="text" id="satu_pintu_no_pkkpr" name="satu_pintu_no_pkkpr" class="form-control-v"
                                                   placeholder="cth: PKKPR-PSN/2026/001" value="{{ $application->satu_pintu_no_pkkpr }}" style="background:white;" required>
                                        </div>
                                        <div class="form-group-v" style="margin-bottom:12px;">
                                            <label for="satu_pintu_tanggal_terbit" class="form-label" style="font-weight:700;color:#744210;">Tanggal Terbit (wajib) <span style="color:red;">*</span></label>
                                            <input type="date" id="satu_pintu_tanggal_terbit" name="satu_pintu_tanggal_terbit" class="form-control-v"
                                                   value="{{ $application->satu_pintu_tanggal_terbit ? $application->satu_pintu_tanggal_terbit->format('Y-m-d') : date('Y-m-d') }}" style="background:white;" required>
                                        </div>
                                        <div class="form-group-v" style="margin-bottom:12px;">
                                            @if($application->approval_document)
                                                <label class="form-label" style="font-weight:700;color:#744210;">Dokumen PKKPR PSN</label>
                                                <a href="{{ route('file.view', ['path' => $application->approval_document]) }}" target="_blank" style="display:inline-flex; align-items:center; gap:8px; padding:8px 16px; background:#F97316; border:none; border-radius:6px; color:#ffffff; font-size:13px; font-weight:600; text-decoration:none; margin-top:4px; transition:all 0.2s;" onmouseover="this.style.background='#EA580C'" onmouseout="this.style.background='#F97316'">
                                                    <svg viewBox="0 0 24 24" width="16" height="16" stroke="currentColor" stroke-width="2" fill="none"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                                                    Lihat Dokumen Terunggah
                                                </a>
                                            @else
                                                <label for="approval_document" class="form-label" style="font-weight:700;color:#744210;">Unggah Dokumen PKKPR PSN (opsional)</label>
                                                <input type="file" id="approval_document" name="approval_document" class="form-control-v" accept="application/pdf" style="background:white;">
                                                <span style="font-size:11.5px;color:#744210;margin-top:4px;display:block;">Format PDF, maks. 10MB. Dokumen ini dapat diunduh oleh pemohon.</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group-v">
                                        <label for="notes_sp" class="form-label" style="font-weight:700;color:#744210;">Catatan / Keterangan:</label>
                                        <textarea id="notes_sp" name="notes" class="form-control-v" rows="3" placeholder="Catatan penerbitan PKKPR PSN (opsional)..." style="resize:none;background:white;">{{ $application->satu_pintu_notes }}</textarea>
                                    </div>
                                    @if($isSpActive)
                                        <button type="submit" class="btn-submit-v" style="background:#79A73A;">📄 Terbitkan PKKPR PSN & Blast WA Pemohon</button>
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
                            @if(Auth::user()->isSatuPintu() && in_array($application->status, ['disetujui', 'ditolak']) && $application->satu_pintu_tanggal_terbit)
                                <form action="{{ route('psn.verify', $application->id) }}" method="POST" style="margin-top: 16px;">
                                    @csrf
                                    <input type="hidden" name="step" value="resend_wa">
                                    <input type="hidden" name="wa_type" value="{{ $application->status === 'ditolak' ? 'pkkpr_tolak' : 'pkkpr_terbit' }}">

                                    <button type="submit" class="btn-submit-v" style="background: var(--clr-blue); width: 100%; justify-content: center;">
                                        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 2L11 13M22 2l-7 20-4-9-9-4 20-7z"/></svg>
                                        Kirim Ulang Notifikasi PKKPR PSN (WhatsApp)
                                    </button>
                                </form>
                            @endif
                        </div>
                </div>
            <!-- PELAKU USAHA ACTION: REUPLOAD JIKA BERKAS TIDAK SESUAI -->
            @if($user->isPelakuUsaha() && $application->status === 'menunggu_bpn' && in_array($application->bpn_berkas_status, ['tidak_sesuai', 'ditolak']))
                <div class="verify-card" style="border-color: #F5C2C1; background: #FFF5F5;">
                    <h3 class="verify-title" style="color: #C5221F;">⚠️ Perbaikan Dokumen Persyaratan Diperlukan</h3>
                    <p style="font-size: 13px; color: #7F2321; margin-bottom: 16px;">
                        Petugas Kantor Pertanahan menyatakan berkas Anda tidak lengkap dengan catatan: <br>
                        <strong>"{{ $application->bpn_notes }}"</strong>
                    </p>
                    <form action="{{ route('psn.verify', $application->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="step" value="reupload">
                        <div class="form-group-v" style="margin-bottom: 8px;">
                            <label for="peta_lokasi" style="display:block;margin-bottom:4px;font-size:13px;font-weight:700;">1. Peta/sketsa lokasi</label>
                            <input type="file" name="peta_lokasi" id="peta_lokasi" class="form-control-v" accept=".pdf,.jpg,.jpeg,.png">
                        </div>
                        <div class="form-group-v" style="margin-bottom: 8px;">
                            <label for="surat_kuasa" style="display:block;margin-bottom:4px;font-size:13px;font-weight:700;">2. Surat kuasa</label>
                            <input type="file" name="surat_kuasa" id="surat_kuasa" class="form-control-v" accept=".pdf,.jpg,.jpeg,.png">
                        </div>
                        <div class="form-group-v" style="margin-bottom: 8px;">
                            <label for="fc_ktp" style="display:block;margin-bottom:4px;font-size:13px;font-weight:700;">3. FC KTP</label>
                            <input type="file" name="fc_ktp" id="fc_ktp" class="form-control-v" accept=".pdf,.jpg,.jpeg,.png">
                        </div>
                        <div class="form-group-v" style="margin-bottom: 8px;">
                            <label for="fc_npwp" style="display:block;margin-bottom:4px;font-size:13px;font-weight:700;">4. FC NPWP</label>
                            <input type="file" name="fc_npwp" id="fc_npwp" class="form-control-v" accept=".pdf,.jpg,.jpeg,.png">
                        </div>
                        <div class="form-group-v" style="margin-bottom: 8px;">
                            <label for="fc_akta_pendirian" style="display:block;margin-bottom:4px;font-size:13px;font-weight:700;">5. FC Akta Pendirian & Pengesahan Badan Hukum</label>
                            <input type="file" name="fc_akta_pendirian" id="fc_akta_pendirian" class="form-control-v" accept=".pdf,.jpg,.jpeg,.png">
                        </div>
                        <div class="form-group-v" style="margin-bottom: 8px;">
                            <label for="rencana_penggunaan_tanah" style="display:block;margin-bottom:4px;font-size:13px;font-weight:700;">6. Rencana Penggunaan Tanah</label>
                            <input type="file" name="rencana_penggunaan_tanah" id="rencana_penggunaan_tanah" class="form-control-v" accept=".pdf,.jpg,.jpeg,.png">
                        </div>
                        <div class="form-group-v" style="margin-bottom: 8px;">
                            <label for="kbli_kode" style="display:block;margin-bottom:4px;font-size:13px;font-weight:700;">7. KBLI</label>
                            <input type="text" name="kbli_kode" id="kbli_kode" class="form-control-v" placeholder="Masukkan kode KBLI baru (jika ada)">
                        </div>
                        <div class="form-group-v" style="margin-bottom: 12px;">
                            <label for="proposal_kegiatan" style="display:block;margin-bottom:4px;font-size:13px;font-weight:700;">8. Proposal Kegiatan</label>
                            <input type="file" name="proposal_kegiatan" id="proposal_kegiatan" class="form-control-v" accept=".pdf,.doc,.docx">
                        </div>
                        <div class="form-group-v" style="margin-bottom: 12px;">
                            <label for="persyaratan_lainnya" style="display:block;margin-bottom:4px;font-size:13px;font-weight:700;">9. Persyaratan Lainnya (Opsional)</label>
                            <input type="file" name="persyaratan_lainnya" id="persyaratan_lainnya" class="form-control-v" accept=".pdf,.jpg,.jpeg,.png,.zip,.rar">
                        </div>
                        <button type="submit" class="btn-submit-v" style="background: #C5221F; width:100%;">Kirim Berkas Perbaikan</button>
                    </form>
                </div>
            @endif

            <div class="grid-layout">
                
                <!-- Left: Application Details & Uploaded Files -->
                <div>
                    <!-- Data Permohonan -->
                    <div class="card">
                        <h2 class="card-title">Informasi Identitas Pemohon / Pengguna Layanan</h2>
                        <div class="data-list">
                            <div class="data-item">
                                <span class="data-label">Nama Pemilik Usaha</span>
                                <span class="data-val">{{ $application->nama_pemilik_usaha }}</span>
                            </div>
                            <div class="data-item">
                                <span class="data-label">Nama Pemohon / Pengguna Layanan</span>
                                <span class="data-val">{{ $application->nama_pengaju }}</span>
                            </div>
                            <div class="data-item">
                                <span class="data-label">Hubungan Pengaju (Sebagai Apa)</span>
                                <span class="data-val">{{ $application->hubungan_pengaju }}</span>
                            </div>
                            <div class="data-item">
                                <span class="data-label">Akun Pemohon (Username)</span>
                                <span class="data-val">PMH{{ str_pad($application->user->id ?? 0, 3, '0', STR_PAD_LEFT) }}</span>
                            </div>
                            <div class="data-item">
                                <span class="data-label">Nomor Telepon Gateway / HP</span>
                                <span class="data-val mono">+{{ $application->user->phone_number }}</span>
                            </div>
                            <div class="data-item">
                                <span class="data-label">Tanggal Pengajuan Berkas</span>
                                <span class="data-val">{{ $application->created_at->format('d-m-Y, H:i') }} WIB</span>
                            </div>
                        </div>
                    </div>

                    <!-- Dokumen Lampiran -->
                    <div class="card">
                        <h2 class="card-title">Dokumen Berkas Persyaratan</h2>
                        <div class="doc-list">
                            
                            <!-- Persyaratan Utama -->
                            @if($application->ptp_data)
                            <div class="doc-item">
                                <span class="doc-name" style="font-weight: 700; color: var(--clr-blue-dk);">Formulir PTP (Digital)</span>
                                <div class="doc-status" style="position: relative;">
                                    <button type="button" onclick="document.getElementById('ptpAdminDropdown').style.display = document.getElementById('ptpAdminDropdown').style.display === 'none' ? 'block' : 'none'" style="background: none; border: none; color: #2B6CB0; font-weight: 600; font-size: 13px; cursor: pointer; display: flex; align-items: center; gap: 4px; padding: 0;">
                                        Unduh/Lihat ▾
                                    </button>
                                    <div id="ptpAdminDropdown" style="display: none; position: absolute; top: 100%; right: 0; margin-top: 8px; background: white; border: 1px solid #E2E8F0; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); width: max-content; overflow: hidden; z-index: 10; text-align: left;">
                                        <a href="{{ route('psn.ptp_pdf', $application->id) }}" target="_blank" style="display: flex; align-items: center; gap: 8px; padding: 10px 16px; text-decoration: none; color: #2D3748; font-size: 13px; font-weight: 600; border-bottom: 1px solid #E2E8F0;" onmouseover="this.style.background='#F7FAFC'" onmouseout="this.style.background='white'">
                                            <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg> Preview PDF
                                        </a>
                                        <a href="{{ route('psn.ptp_pdf', $application->id) }}?action=download" style="display: flex; align-items: center; gap: 8px; padding: 10px 16px; text-decoration: none; color: #2D3748; font-size: 13px; font-weight: 600;" onmouseover="this.style.background='#F7FAFC'" onmouseout="this.style.background='white'">
                                            <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg> Download DOC
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @if($application->peta_lokasi)
                            <a href="{{ route('file.view', ['path' => $application->peta_lokasi]) }}" target="_blank" class="doc-item">
                                <span class="doc-name">1. Peta Lokasi</span>
                                <span class="doc-status">Unduh/Lihat <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6M15 3h6v6M10 14L21 3"/></svg></span>
                            </a>
                            @endif

                            @if($application->surat_kuasa)
                            <a href="{{ route('file.view', ['path' => $application->surat_kuasa]) }}" target="_blank" class="doc-item">
                                <span class="doc-name">2. Surat Kuasa</span>
                                <span class="doc-status">Unduh/Lihat <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6M15 3h6v6M10 14L21 3"/></svg></span>
                            </a>
                            @endif

                            @if($application->fc_ktp)
                            <a href="{{ route('file.view', ['path' => $application->fc_ktp]) }}" target="_blank" class="doc-item">
                                <span class="doc-name">3. FC KTP</span>
                                <span class="doc-status">Unduh/Lihat <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6M15 3h6v6M10 14L21 3"/></svg></span>
                            </a>
                            @endif

                            @if($application->fc_npwp)
                            <a href="{{ route('file.view', ['path' => $application->fc_npwp]) }}" target="_blank" class="doc-item">
                                <span class="doc-name">4. FC NPWP</span>
                                <span class="doc-status">Unduh/Lihat <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6M15 3h6v6M10 14L21 3"/></svg></span>
                            </a>
                            @endif

                            @if($application->fc_akta_pendirian)
                            <a href="{{ route('file.view', ['path' => $application->fc_akta_pendirian]) }}" target="_blank" class="doc-item">
                                <span class="doc-name">5. FC Akta Pendirian</span>
                                <span class="doc-status">Unduh/Lihat <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6M15 3h6v6M10 14L21 3"/></svg></span>
                            </a>
                            @endif

                            @if($application->rencana_penggunaan_tanah)
                            <a href="{{ route('file.view', ['path' => $application->rencana_penggunaan_tanah]) }}" target="_blank" class="doc-item">
                                <span class="doc-name">6. Rencana Penggunaan Tanah</span>
                                <span class="doc-status">Unduh/Lihat <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6M15 3h6v6M10 14L21 3"/></svg></span>
                            </a>
                            @endif

                            @if($application->nib)
                            <a href="{{ route('file.view', ['path' => $application->nib]) }}" target="_blank" class="doc-item">
                                <span class="doc-name">7. NIB</span>
                                <span class="doc-status">Unduh/Lihat <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6M15 3h6v6M10 14L21 3"/></svg></span>
                            </a>
                            @endif

                            @if($application->kbli)
                            <a href="{{ route('file.view', ['path' => $application->kbli]) }}" target="_blank" class="doc-item">
                                <span class="doc-name">8. KBLI</span>
                                <span class="doc-status">Unduh/Lihat <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6M15 3h6v6M10 14L21 3"/></svg></span>
                            </a>
                            @endif

                            @if($application->proposal_kegiatan)
                            <a href="{{ route('file.view', ['path' => $application->proposal_kegiatan]) }}" target="_blank" class="doc-item">
                                <span class="doc-name">9. Proposal Kegiatan</span>
                                <span class="doc-status">Unduh/Lihat <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6M15 3h6v6M10 14L21 3"/></svg></span>
                            </a>
                            @endif

                            @if($application->persyaratan_lainnya)
                            <a href="{{ route('file.view', ['path' => $application->persyaratan_lainnya]) }}" target="_blank" class="doc-item">
                                <span class="doc-name">10. Persyaratan Lainnya</span>
                                <span class="doc-status">Unduh/Lihat <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6M15 3h6v6M10 14L21 3"/></svg></span>
                            </a>
                            @endif

                            <!-- Pertek Pertanahan (Jika sudah diterbitkan) -->
                            @if($application->bpn_pertek_document)
                                <a href="{{ route('file.view', ['path' => $application->bpn_pertek_document]) }}" target="_blank" class="doc-item" style="border-top: 1px solid var(--clr-line); padding-top: 12px; margin-top: 12px;">
                                    <span class="doc-name" style="font-weight: 700; color: #1a202c;">Dokumen PKKPR PSN</span>
                                    <span class="doc-status" style="color: var(--clr-green-dk);">
                                        Unduh Pertek
                                        <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6M15 3h6v6M10 14L21 3"/></svg>
                                    </span>
                                </a>
                            @endif

                        </div>
                    </div>
                </div>

                <!-- Right: Staged Tracking Timeline -->
                <div>
                    <div class="card">
                        <h1 class="page-title">Detail PKKPR PSN</h1>
                    </div>

                                        <!-- SLA Banner -->
                    <style>
                        .sla-banner { display: grid; grid-template-columns: 1fr; gap: 16px; margin-bottom: 20px; }
                        .sla-item { padding: 16px; border-radius: 10px; border: 1.5px solid; display: flex; justify-content: space-between; align-items: center;}
                        .sla-info { display: flex; flex-direction: column; }
                        .sla-title { font-size: 11px; font-weight: 800; text-transform: uppercase; margin-bottom: 4px; opacity: 0.8; }
                        .sla-value { font-size: 18px; font-weight: 800; margin-bottom: 4px; }
                        .sla-desc { font-size: 12.5px; opacity: 0.9; }
                        .sla-badge { padding: 8px 14px; border-radius: 8px; font-weight: 800; font-size: 14px; text-align: center; }
                    </style>
                    <!-- DAY COUNTER / SLA BANNER -->
                    @php
                        $isPuPhase = in_array($application->status, ['menunggu_dinas_pu', 'menunggu_satu_pintu', 'menunggu_putr', 'disetujui', 'terbit_pkpr']) || $application->bpn_pertek_document;
                        $defaultDays = $isPuPhase ? 20 : 10;
                        
                        // SLA: badge SELALU muncul, countdown jalan hanya jika sudah bayar + BPN sudah set tgl_mulai_layanan
                        $sudahBayar = $application->bpn_pembayaran_status === 'sudah_bayar';
                        if ($sudahBayar && $application->tgl_mulai_layanan) {
                            $startDate = \Carbon\Carbon::parse($application->tgl_mulai_layanan);
                            $targetDate = $application->tgl_selesai_layanan 
                                ? \Carbon\Carbon::parse($application->tgl_selesai_layanan) 
                                : $startDate->copy()->addDays($defaultDays);
                        } else {
                            $targetDate = null;
                        }
                        
                        $isSelesai = false;
                        if (Auth::user()->isBpn()) {
                            $isSelesai = ($application->bpn_pertek_document || in_array($application->status, ['ditolak', 'menunggu_dinas_pu', 'menunggu_satu_pintu', 'disetujui']));
                        } elseif (Auth::user()->isDinasPu()) {
                            $isSelesai = ($application->dinas_pu_status === 'disetujui' || in_array($application->status, ['ditolak', 'menunggu_satu_pintu', 'disetujui']));
                        } else {
                            $isSelesai = in_array($application->status, ['ditolak', 'disetujui']);
                        }
                        
                        if ($isSelesai) {
                            $slaBg = '#16A34A';
                            $slaBorder = '#15803D';
                            $slaColor = '#FFFFFF';
                        } elseif (!$sudahBayar || !$targetDate) {
                            $slaBg = '#64748B';
                            $slaBorder = '#475569';
                            $slaColor = '#FFFFFF';
                        } else {
                            $now = \Carbon\Carbon::now();
                            $daysRemaining = $now->diffInDays($targetDate, false);
                            
                            if ($isPuPhase) {
                                if ($daysRemaining >= 4) { $slaBg = '#16A34A'; $slaBorder = '#15803D'; $slaColor = '#FFFFFF'; }
                                elseif ($daysRemaining >= 1) { $slaBg = '#EAB308'; $slaBorder = '#CA8A04'; $slaColor = '#FFFFFF'; }
                                else { $slaBg = '#DC2626'; $slaBorder = '#B91C1C'; $slaColor = '#FFFFFF'; }
                            } else {
                                if ($daysRemaining >= 3) { $slaBg = '#16A34A'; $slaBorder = '#15803D'; $slaColor = '#FFFFFF'; }
                                elseif ($daysRemaining >= 1) { $slaBg = '#EAB308'; $slaBorder = '#CA8A04'; $slaColor = '#FFFFFF'; }
                                else { $slaBg = '#DC2626'; $slaBorder = '#B91C1C'; $slaColor = '#FFFFFF'; }
                            }
                        }
                    @endphp
                    
                    {{-- Badge SLA selalu muncul --}}
                    <div class="floating-sla" style="position: fixed; top: 120px; right: 32px; z-index: 9999; background: {{ $slaBg }}; border-radius: 4px; box-shadow: 0 10px 25px rgba(0,0,0,0.15); border: 1px solid {{ $slaBorder }}; width: 260px; overflow: hidden; display: flex; flex-direction: column;">
                        <div style="padding: 10px 14px; border-bottom: 1px solid rgba(255,255,255,0.2);">
                            <div style="font-size: 10px; font-weight: 800; color: {{ $slaColor }}; opacity: 0.95; margin-bottom: 2px; text-transform: uppercase; letter-spacing: 0.05em;">Batas Waktu (SLA)</div>
                            @if($targetDate)
                                <div style="font-size: 12.5px; color: {{ $slaColor }};">Target: <strong style="font-weight: 800;">{{ $targetDate->format('d M Y') }}</strong></div>
                            @elseif($sudahBayar)
                                <div style="font-size: 12.5px; color: {{ $slaColor }};">Target: <strong style="font-weight: 800;">Belum Diatur</strong></div>
                            @else
                                <div style="font-size: 12.5px; color: {{ $slaColor }};">Target: <strong style="font-weight: 800;">Menunggu Pembayaran</strong></div>
                            @endif
                        </div>
                        <div style="padding: 12px 14px; background: rgba(0,0,0,0.06);">
                            @if($isSelesai)
                                <div style="display: flex; align-items: center; gap: 8px; color: {{ $slaColor }}; font-weight: 700; font-size: 13px;">
                                    <div style="width: 24px; height: 24px; border-radius: 50%; background: rgba(255,255,255,0.25); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                    <span>Tepat Waktu (Selesai)</span>
                                </div>
                            @elseif(!$sudahBayar)
                                <div style="display: flex; align-items: center; gap: 8px; color: {{ $slaColor }}; font-weight: 700; font-size: 13px;">
                                    <div style="width: 24px; height: 24px; border-radius: 50%; background: rgba(255,255,255,0.2); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                    </div>
                                    <span>Menunggu Pembayaran PNBP</span>
                                </div>
                            @elseif(!$targetDate)
                                <div style="display: flex; align-items: center; gap: 8px; color: {{ $slaColor }}; font-weight: 700; font-size: 13px;">
                                    <div style="width: 24px; height: 24px; border-radius: 50%; background: rgba(255,255,255,0.2); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    </div>
                                    <span>Menunggu Admin Set SLA</span>
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
                        <!-- ── SERVICE IDENTIFIER HEADER ── -->
                        <div class="timeline-card-header">
                            <img
                                src="{{ asset('storage/logo/PSN.png') }}"
                                alt="Logo PSN"
                                class="timeline-service-logo"
                                onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                            >
                            <!-- Fallback jika logo tidak ditemukan -->
                            <div style="display:none; width:56px; height:56px; border-radius:10px; background:var(--clr-blue); align-items:center; justify-content:center; flex-shrink:0;">
                                <svg width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="white" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            </div>
                            <div class="timeline-service-meta">
                                <div class="timeline-service-label">Pelacakan Permohonan</div>
                                <div class="timeline-service-title">PKKPR PSN</div>
                                <div class="timeline-step-count">8 Tahapan · Kantor Pertanahan, PUTR, & DPMPTSP</div>
                            </div>
                        </div>
                        
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
                                        <span style="font-size: 10px; font-weight: 600; color: var(--clr-muted); background: rgba(0,0,0,0.05); padding: 1px 6px; border-radius: 10px;">Kantor Pertanahan</span>
                                    </div>
                                    <div class="timeline-desc">Validasi awal kelengkapan berkas dokumen persyaratan pemohon.</div>
                                    @if($application->bpn_sps_document)
                                        <div style="margin-top: 8px;">
                                            <a href="{{ route('file.view', ['path' => $application->bpn_sps_document]) }}" target="_blank" class="btn-submit-v" style="background: var(--clr-blue); color: #fff; padding: 6px 12px; font-size: 11px; text-decoration: none; display: inline-flex; align-items: center; border-radius: 4px; margin: 0;">
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
                                        <span style="font-size: 10px; font-weight: 600; color: var(--clr-muted); background: rgba(0,0,0,0.05); padding: 1px 6px; border-radius: 10px;">Kantor Pertanahan</span>
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

                            <!-- STEP 3: Peninjauan Lapangan (Kantor Pertanahan) -->
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
                                        3. Peninjauan Lapangan (Kantor Pertanahan)
                                        <span style="font-size: 10px; font-weight: 600; color: var(--clr-muted); background: rgba(0,0,0,0.05); padding: 1px 6px; border-radius: 10px;">Kantor Pertanahan</span>
                                    </div>
                                    <div class="timeline-desc">
                                        @if($application->bpn_cek_lokasi_dt)
                                            Dijadwalkan pada: <strong>{{ $application->bpn_cek_lokasi_date }}</strong><br>
                                            Contact Person Petugas Lapang: <strong>{{ $application->bpn_cek_lokasi_cp }}</strong>
                                        @else
                                            Menunggu penentuan jadwal peninjauan lapangan offline.
                                        @endif
                                    </div>
                                    @if($application->bpn_cek_lokasi_dt)
                                        <div style="font-size:11px;color:#558B2F;margin-top:5px;font-weight:600;">📅 Dijadwalkan: {{ \Carbon\Carbon::parse($application->bpn_cek_lokasi_dt)->locale('id')->translatedFormat('l, d M Y · H:i') }} WIB</div>
                                    @endif
                                </div>
                            </div>

                            <!-- STEP 4: Rapat Pembahasan Pertek (Kantor Pertanahan) -->
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
                                        <span style="font-size: 10px; font-weight: 600; color: var(--clr-muted); background: rgba(0,0,0,0.05); padding: 1px 6px; border-radius: 10px;">Kantor Pertanahan</span>
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

                            <!-- STEP 5: Penerbitan Pertek Kantor Pertanahan (Included in Kantor Pertanahan step above usually, but keeping it if needed) -->
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
                            <div class="timeline-step {{ $step5Status }}" onclick="showBpnPanel(5)" style="cursor:pointer;">
                                <span class="timeline-dot"></span>
                                <div class="timeline-content">
                                    <div class="timeline-title">
                                        5. Penerbitan Pertek Pertanahan
                                        <span style="font-size: 10px; font-weight: 600; color: var(--clr-muted); background: rgba(0,0,0,0.05); padding: 1px 6px; border-radius: 10px;">Kantor Pertanahan</span>
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

                            <!-- STEP 6: Penilaian Pertimbangan Teknis Pertanahan Dinas Pekerjaan Umum dan Tata Ruang (PUTR) -->
                            @php
                                $step6Status = '';
                                if ($application->bpn_pertek_document) {
                                    if ($application->status === 'menunggu_satu_pintu' || $application->status === 'disetujui') {
                                        $step6Status = 'completed';
                                    } elseif ($application->status === 'ditolak' && !$application->satu_pintu_no_pkkpr) {
                                        $step6Status = 'rejected';
                                    } elseif ($application->status === 'menunggu_dinas_pu') {
                                        $step6Status = 'active';
                                    }
                                }
                            @endphp
                            <div class="timeline-step {{ $step6Status }}" onclick="showBpnPanel('pu-1')" style="cursor:pointer;">
                                <span class="timeline-dot"></span>
                                <div class="timeline-content">
                                    <div class="timeline-title">
                                        5. Penilaian Pertimbangan Teknis Pertanahan
                                        <span style="font-size: 10px; font-weight: 600; color: var(--clr-muted); background: rgba(0,0,0,0.05); padding: 1px 6px; border-radius: 10px;">Dinas Pekerjaan Umum dan Tata Ruang (PUTR)</span>
                                    </div>
                                    <div class="timeline-desc">
                                        Dinas Pekerjaan Umum dan Tata Ruang menilai kesesuaian tata ruang berdasarkan dokumen Pertek. Notifikasi dikirim ke pemohon.
                                    </div>
                                    @if($application->dinas_pu_notes)
                                        <div class="timeline-notes" style="border-left-color: {{ in_array($application->status, ['menunggu_satu_pintu','disetujui']) ? 'var(--clr-green)' : '#E53E3E' }}; background: {{ in_array($application->status, ['menunggu_satu_pintu','disetujui']) ? '#F4FBF7' : '#FFF5F5' }}; color: {{ in_array($application->status, ['menunggu_satu_pintu','disetujui']) ? '#137333' : '#C53030' }}">
                                            <strong>Catatan Dinas Pekerjaan Umum dan Tata Ruang (PUTR):</strong> {{ $application->dinas_pu_notes }}
                                        </div>
                                    @endif
                                    @if($application->dinas_pu_tanggal_penilaian)
                                        <div style="font-size:11px;color:#558B2F;margin-top:5px;font-weight:600;">📅 Selesai: {{ \Carbon\Carbon::parse($application->dinas_pu_tanggal_penilaian)->locale('id')->translatedFormat('l, d M Y') }}</div>
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
                                        6. Penerbitan Pertimbangan Teknis Pertanahan
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
                                            Layanan Ditolak
                                        @else
                                            Layanan Selesai
                                        @endif
                                    </div>
                                    <div class="timeline-desc">
                                        @if($application->status === 'ditolak')
                                            Layanan dihentikan/ditolak oleh instansi terkait (Kantor Pertanahan atau Dinas Pekerjaan Umum dan Tata Ruang (PUTR)).
                                        @elseif($application->status === 'disetujui')
                                            Seluruh alur selesai. Dokumen PKKPR PSN siap diunduh dari portal.
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
            @if(session('wa_links'))
                <div id="wa-blast-container" style="background:#E8F5E9;border:1.5px solid #A5D6A7;border-radius:8px;padding:16px 20px;margin-bottom:20px;box-shadow: 0 4px 15px rgba(37, 211, 102, 0.2);">
                    <div style="font-size:13px;font-weight:700;color:#1B5E20;margin-bottom:10px;display:flex;align-items:center;gap:8px;">
                        <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/></svg>
                        Kirim Notifikasi WhatsApp Manual
                    </div>
                    <div style="font-size:12px;color:#2E7D32;margin-bottom:12px;">Klik tombol di bawah untuk membuka WhatsApp dan kirim notifikasi ke pihak terkait:</div>
                    <div style="display:flex;flex-wrap:wrap;gap:8px;">
                        @foreach(session('wa_links') as $index => $link)
                            <a href="{{ $link['url'] }}" target="_blank" rel="noopener noreferrer" id="wa-link-layout-{{ $index }}"
                               style="display:inline-flex;align-items:center;gap:6px;background:#25D366;color:#fff;padding:9px 16px;border-radius:6px;text-decoration:none;font-size:13px;font-weight:700;transition:all 0.2s;"
                               onmouseover="this.style.background='#1EBE5A'" onmouseout="this.style.background='#25D366'">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                                Kirim ke {{ $link['target'] }}
                            </a>
                        @endforeach
                    </div>
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            setTimeout(function() {
                                const waContainer = document.getElementById('wa-blast-container');
                                if (waContainer) {
                                    waContainer.scrollIntoView({ behavior: 'smooth', block: 'center' });
                                }
                            }, 400);
                        });
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
            const tPanel = document.getElementById('Kantor Pertanahan-panel-' + match[1]);
            document.querySelectorAll('.Kantor Pertanahan-panel-step').forEach(p => p.style.display = 'none');
            if(tPanel) { 
                tPanel.style.display = 'block'; 
            }
            
            document.querySelectorAll('.timeline-step').forEach(ts => ts.classList.remove('viewing-step'));
            targetStep.classList.add('viewing-step');
            
            targetStep.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            window.scrollTo({ top: 0, behavior: 'smooth' });
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
        const activePanel = document.querySelector('.Kantor Pertanahan-panel-step[style*="display: block"]');
        if(activePanel) {
            const panelIdMatch = activePanel.id.replace('Kantor Pertanahan-panel-', '');
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
    <!-- Flatpickr JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/id.js"></script>
    @php
        $holidays = [];
        try {
            $holidays = \App\Models\Holiday::get()->map(function($h) {
                return \Carbon\Carbon::parse($h->date)->format('Y-m-d');
            })->toArray();
        } catch(\Exception $e) {}
    @endphp
    <script>
        window.appHolidays = {!! json_encode($holidays) !!};
        
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('input[type="datetime-local"], input[type="date"]').forEach(el => {
                if(!el.getAttribute('placeholder')) el.setAttribute('placeholder', 'Pilih Tanggal & Waktu...');
            });

            const commonDisable = [
                function(date) {
                    const y = date.getFullYear();
                    const m = String(date.getMonth() + 1).padStart(2, '0');
                    const d = String(date.getDate()).padStart(2, '0');
                    const formattedDate = `${y}-${m}-${d}`;
                    return (date.getDay() === 0 || date.getDay() === 6 || window.appHolidays.includes(formattedDate));
                }
            ];

            flatpickr('#tgl_mulai_layanan, #tgl_selesai_layanan, #bpn_cek_lokasi_dt, #bpn_rapat_dt, #dinas_pu_tanggal_penilaian, #satu_pintu_tanggal_terbit', {
                enableTime: true,
                dateFormat: "Y-m-d\\TH:i",
                altInput: true,
                altFormat: "j F Y - H:i",
                locale: "id",
                allowInput: true,
                disable: commonDisable
            });
        });
    </script>
</body>
</html>
