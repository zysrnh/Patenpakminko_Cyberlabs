<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Permohonan PKKPR Berusaha — PATEN PAK MIKO</title>
    <!-- Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/material_blue.css">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
 
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
            max-width: 1100px;
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
            grid-template-columns: 1.5fr 1.2fr;
            gap: 32px;
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
 
        /* ─── TIMELINE ───────────────────────────────────────── */
        .timeline {
            position: relative;
            padding-left: 28px;
        }
        .timeline::before {
            content: '';
            position: absolute;
            top: 6px;
            left: 8px;
            bottom: 6px;
            width: 2px;
            background: var(--clr-line);
        }
 
        .timeline-step {
            position: relative;
            margin-bottom: 24px;
        }
        .timeline-step:last-child {
            margin-bottom: 0;
        }
 
        .timeline-dot {
            position: absolute;
            left: -28px;
            top: 4px;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background: var(--clr-white);
            border: 2px solid var(--clr-muted);
            transition: all 0.2s;
            z-index: 2;
        }
 
        .timeline-title {
            font-size: 14px;
            font-weight: 800;
            color: var(--clr-mid);
            margin-bottom: 4px;
            transition: color 0.2s;
        }
        .timeline-desc {
            font-size: 12.5px;
            color: var(--clr-muted);
            line-height: 1.5;
        }
 
        /* STATES */
        .timeline-step.completed .timeline-dot {
            background: var(--clr-green);
            border-color: var(--clr-green);
        }
        .timeline-step.completed .timeline-dot::after {
            content: '✓';
            color: white;
            font-size: 10px;
            font-weight: 800;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
            margin-top: -1px;
        }
        .timeline-step.completed .timeline-title {
            color: var(--clr-ink);
        }
 
        .timeline-step.active .timeline-dot {
            border-color: var(--clr-blue);
            background: var(--clr-blue-lt);
            box-shadow: 0 0 0 4px rgba(19, 147, 204, 0.15);
        }
        .timeline-step.active .timeline-dot::after {
            content: '';
            position: absolute;
            top: 4px;
            left: 4px;
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: var(--clr-blue);
        }
        .timeline-step.active .timeline-title {
            color: var(--clr-blue);
        }
 
        .timeline-step.rejected .timeline-dot {
            background: #E53E3E;
            border-color: #E53E3E;
        }
        .timeline-step.rejected .timeline-dot::after {
            content: '✕';
            color: white;
            font-size: 9px;
            font-weight: 800;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
        }
        .timeline-step.rejected .timeline-title {
            color: #E53E3E;
        }
 
        .timeline-notes {
            margin-top: 8px;
            padding: 8px 12px;
            background: #FFF5F5;
            border-left: 3px solid #E53E3E;
            color: #C53030;
            font-size: 12px;
            border-radius: 4px;
        }
        .timeline-step.completed .timeline-notes {
            background: #F0F4F8;
            border-left-color: var(--clr-blue);
            color: var(--clr-ink);
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
    </style>
</head>
<body>
 
    <!-- Header -->
    <header>
        <div class="container" style="max-width: 1100px;">
            <div class="header-inner">
                <a href="/dashboard" class="logo-wrap">
                    <div class="logo-icon">
                        <svg viewBox="0 0 24 24">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                        </svg>
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
 
            @if($errors->any())
                <div class="alert-error">
                    <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif
 
            <div class="page-header">
                <div>
                    <h1 class="page-title">Pelacakan PKKPR Berusaha</h1>
                </div>
                <a href="{{ route('berusaha.index') }}" class="back-link">
                    <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Kembali ke Dashboard
                </a>
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
                    @php
                        $targetDate = $application->created_at->addWeekdays(10);
                        $now = \Carbon\Carbon::now();
                        
                        $isBpnDone = ($application->bpn_pertek_document != null || in_array($application->status, ['ditolak', 'menunggu_dinas_pu', 'menunggu_satu_pintu', 'disetujui']));
                        
                        if ($isBpnDone) {
                            $daysRemaining = 0;
                            $slaColor = '#0F5132';
                            $slaBg = '#D1E7DD';
                            $slaBorder = '#BADBCC';
                            $badgeText = '✅ Selesai';
                            $badgeBg = '#198754';
                            $badgeColor = '#FFFFFF';
                        } else {
                            $daysRemaining = 0;
                            if ($now->startOfDay() <= $targetDate->startOfDay()) {
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
                                <div class="sla-title">SLA Tahap 1 (Kantor Pertanahan)</div>
                                <div class="sla-value">Target: {{ $targetDate->format('d M Y') }}</div>
                                <div class="sla-desc">Batas waktu penyelesaian Pertek adalah 10 Hari Kerja.</div>
                            </div>
                            <div class="sla-badge" style="background-color: {{ $badgeBg }}; color: {{ $badgeColor }};">
                                {{ $badgeText }}
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <h2 class="card-title">Linimasa Pelacakan Berkas</h2>

                        <div class="timeline">

                            <!-- STEP 1: Diajukan -->
                            <div class="timeline-step completed">
                                <span class="timeline-dot"></span>
                                <div class="timeline-title">Berkas Berhasil Diajukan</div>
                                <div class="timeline-desc">Pelaku usaha berhasil mengunggah berkas persyaratan dan formulir permohonan ke portal.</div>
                            </div>

                            <!-- STEP 2: Verifikasi Berkas Awal BPN -->

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
                                <div class="timeline-title">1. Verifikasi Berkas Awal (BPN)</div>
                                    @if($application->bpn_berkas_approved_at)
                                    <div style="font-size: 11px; color: #1393cc; margin-top: 4px; margin-bottom: 6px; font-weight: 700;">
                                        <i class="fas fa-calendar-check"></i> Disetujui: {{ \Carbon\Carbon::parse($application->bpn_berkas_approved_at)->translatedFormat('d M Y, H:i') }}
                                    </div>
                                    @endif
                                <div class="timeline-desc">Validasi kelayakan kelengkapan berkas dokumen persyaratan pemohon oleh BPN.</div>
                                @if($application->bpn_berkas_status === 'tidak_sesuai')
                                    <div class="timeline-notes">
                                        <strong>Catatan Koreksi BPN:</strong> {{ $application->bpn_notes }}
                                    </div>
                                @endif
                            </div>

                            <!-- STEP 3: Validasi Permohonan Awal - Dinas PUTR -->
                            @php
                                $step3Status = '';
                                if ($application->bpn_berkas_status === 'diterima') {
                                    if ($application->dinas_pu_status === 'validasi_awal_diterima' || in_array($application->dinas_pu_status, ['sesuai', 'belum_sesuai'])) {
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
                                <div class="timeline-title">2. Validasi Permohonan (Dinas PUTR)</div>
                                <div class="timeline-desc">
                                    Pemeriksaan awal kelayakan tata ruang oleh Dinas PUTR. Notifikasi dikirim ke BPN dan Pelaku Usaha.
                                </div>
                                @if($application->dinas_pu_status === 'validasi_awal_ditolak')
                                    <div class="timeline-notes">
                                        <strong>Permohonan ditolak pada tahap validasi awal oleh Dinas PUTR.</strong>
                                    </div>
                                @endif
                            </div>

                            <!-- STEP 4: Pembayaran PTN (BPN, setelah PUTR lolos) -->
                            @php
                                $step4Status = '';
                                if (in_array($application->dinas_pu_status, ['validasi_awal_diterima', 'sesuai', 'belum_sesuai', 'menunggu_penilaian'])) {
                                    $step4Status = $application->bpn_pembayaran_status === 'sudah_bayar' ? 'completed' : 'active';
                                }
                            @endphp
                            <div class="timeline-step {{ $step4Status }}" onclick="showBpnPanel(2)" style="cursor:pointer;">
                                <span class="timeline-dot"></span>
                                <div class="timeline-title">3. Pembayaran PTN & Registrasi Berkas (BPN)</div>
                                <div class="timeline-desc">
                                    @if($application->bpn_pembayaran_status === 'sudah_bayar')
                                        Pembayaran telah dikonfirmasi lunas. Kredensial login dashboard telah dikirimkan ke WhatsApp pemohon.
                                        @if($application->no_berkas)
                                            <br>No. Berkas: <strong>{{ $application->no_berkas }}</strong>
                                        @endif
                                    @else
                                        Menunggu konfirmasi pembayaran PTN dan input nomor berkas oleh BPN. Jika tidak dibayar dalam 7 hari, permohonan otomatis dihapus dari sistem.
                                    @endif
                                </div>
                            </div>

                            <!-- STEP 5: Peninjauan Lapangan BPN -->
                            @php
                                $step5Status = '';
                                if ($application->bpn_pembayaran_status === 'sudah_bayar') {
                                    $step5Status = $application->bpn_cek_lokasi_dt ? 'completed' : 'active';
                                }
                            @endphp
                            <div class="timeline-step {{ $step5Status }}" onclick="showBpnPanel(3)" style="cursor:pointer;">
                                <span class="timeline-dot"></span>
                                <div class="timeline-title">4. Peninjauan Lapangan Kantor Pertanahan</div>
                                    @if($application->bpn_cek_lokasi_dt)
                                    <div style="font-size: 11px; color: #1393cc; margin-top: 4px; margin-bottom: 6px; font-weight: 700;">
                                        <i class="fas fa-calendar-check"></i> Jadwal Tinjauan: {{ \Carbon\Carbon::parse($application->bpn_cek_lokasi_dt)->translatedFormat('d M Y, H:i') }}
                                    </div>
                                    @endif
                                <div class="timeline-desc">
                                    @if($application->bpn_cek_lokasi_dt)
                                        Waktu Tinjau: <strong>{{ $application->bpn_cek_lokasi_date }}</strong><br>
                                        Petugas Lapangan: <strong>{{ $application->bpn_cek_lokasi_cp }}</strong>
                                    @else
                                        Menunggu input jadwal peninjauan lokasi lapangan dari BPN.
                                    @endif
                                </div>
                            </div>

                            <!-- STEP 6: Rapat Pembahasan Pertek BPN -->
                            @php
                                $step6Status = '';
                                if ($application->bpn_cek_lokasi_dt) {
                                    $step6Status = $application->bpn_rapat_dt ? 'completed' : 'active';
                                }
                            @endphp
                            <div class="timeline-step {{ $step6Status }}" onclick="showBpnPanel(4)" style="cursor:pointer;">
                                <span class="timeline-dot"></span>
                                <div class="timeline-title">5. Rapat Pembahasan Pertimbangan Teknis Pertanahan</div>
                                    @if($application->bpn_rapat_dt)
                                    <div style="font-size: 11px; color: #1393cc; margin-top: 4px; margin-bottom: 6px; font-weight: 700;">
                                        <i class="fas fa-calendar-check"></i> Jadwal Rapat: {{ \Carbon\Carbon::parse($application->bpn_rapat_dt)->translatedFormat('d M Y, H:i') }}
                                    </div>
                                    @endif
                                <div class="timeline-desc">
                                    @if($application->bpn_rapat_dt)
                                        Waktu Sidang: <strong>{{ $application->bpn_rapat_date }}</strong>
                                    @else
                                        Menunggu jadwal sidang/rapat koordinasi teknis pertanahan.
                                    @endif
                                </div>
                            </div>

                            <!-- STEP 7: Penerbitan Pertek Pertanahan BPN -->
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
                                <div class="timeline-title">6. Penerbitan Pertek Pertanahan (BPN)</div>
                                    @if($application->bpn_pertek_uploaded_at)
                                    <div style="font-size: 11px; color: #1393cc; margin-top: 4px; margin-bottom: 6px; font-weight: 700;">
                                        <i class="fas fa-calendar-check"></i> Terbit: {{ \Carbon\Carbon::parse($application->bpn_pertek_uploaded_at)->translatedFormat('d M Y, H:i') }}
                                    </div>
                                    @endif
                                <div class="timeline-desc">
                                    @if($application->bpn_pertek_document)
                                        Surat Rekomendasi Teknis (Pertek) berhasil diterbitkan dan diteruskan ke Dinas PU untuk penilaian tata ruang.
                                    @else
                                        Menunggu penerbitan surat rekomendasi teknis pertanahan oleh BPN.
                                    @endif
                                </div>
                            </div>

                            <!-- STEP 8: Penilaian PKKPR oleh Dinas PU -->
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
                                <div class="timeline-title">7. Penilaian PKKPR (Dinas PU)</div>
                                    @if($application->dinas_pu_tanggal_penilaian)
                                    <div style="font-size: 11px; color: #1393cc; margin-top: 4px; margin-bottom: 6px; font-weight: 700;">
                                        <i class="fas fa-calendar-check"></i> Selesai: {{ \Carbon\Carbon::parse($application->dinas_pu_tanggal_penilaian)->translatedFormat('d M Y') }}
                                    </div>
                                    @endif
                                <div class="timeline-desc">
                                    Dinas Pekerjaan Umum melakukan penilaian kesesuaian tata ruang. Notifikasi dikirim ke Pelaku Usaha, PTSP, dan BPN.
                                </div>
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
                            </div>

                            <!-- STEP 9: Penerbitan PKKPR (Dinas Satu Pintu / PTSP) -->
                            @php
                                $step9Status = '';
                                if ($application->dinas_pu_status === 'sesuai') {
                                    $step9Status = $application->satu_pintu_document ? 'completed' : 'active';
                                }
                            @endphp
                            <div class="timeline-step {{ $step9Status }}" onclick="showBpnPanel('satu-pintu')" style="cursor:pointer;">
                                <span class="timeline-dot"></span>
                                <div class="timeline-title">8. Penerbitan PKKPR (Dinas PMPTSP)</div>
                                    @if($application->satu_pintu_tanggal_terbit)
                                    <div style="font-size: 11px; color: #1393cc; margin-top: 4px; margin-bottom: 6px; font-weight: 700;">
                                        <i class="fas fa-calendar-check"></i> Terbit: {{ \Carbon\Carbon::parse($application->satu_pintu_tanggal_terbit)->translatedFormat('d M Y') }}
                                    </div>
                                    @endif
                                <div class="timeline-desc">
                                    Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu (DPMPTSP) menerbitkan dokumen PKKPR Berusaha resmi.
                                </div>
                                @if($application->satu_pintu_no_pkkpr)
                                    <div class="timeline-notes" style="border-left-color: var(--clr-green); background: #F4FBF7; color: #137333;">
                                        <strong>No. PKKPR:</strong> {{ $application->satu_pintu_no_pkkpr }}
                                    </div>
                                @endif
                            </div>

                            <!-- STEP 10: Selesai / Ditolak -->
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
                                <div class="timeline-title">
                                    @if($application->status === 'ditolak')
                                        Permohonan Ditolak
                                    @else
                                        Permohonan Selesai & Disetujui
                                    @endif
                                </div>
                                <div class="timeline-desc">
                                    @if($application->status === 'ditolak')
                                        Permohonan dihentikan/ditolak oleh instansi terkait (BPN, Dinas PUTR, atau Dinas PU).
                                    @elseif($application->status === 'disetujui')
                                        Seluruh alur selesai. Dokumen PKKPR Berusaha siap diunduh dari portal.
                                    @else
                                        Menunggu seluruh tahapan selesai disetujui oleh semua instansi terkait.
                                    @endif
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
            // Inisialisasi Tanggal Penilaian Dinas PU
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

            // Inisialisasi Tanggal Terbit Satu Pintu (PTSP)
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

            // Inisialisasi Tanggal Cek Lokasi BPN
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

            // Inisialisasi Tanggal Rapat BPN
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
</body>
</html>


<script>
document.addEventListener("DOMContentLoaded", function() {
    const actionInputs = document.querySelectorAll("select[name='action'], input[type='radio'][name='action']");
    const revisiContainer = document.getElementById("revisi-berkas-container");
    const notesField = document.getElementById("notes");
    const checkboxes = document.querySelectorAll(".cb-revisi");

    function updateRevisiVisibility() {
        let isReject = false;
        actionInputs.forEach(input => {
            if (input.tagName === "SELECT" && input.value === "reject") isReject = true;
            if (input.tagName === "INPUT" && input.checked && input.value === "reject") isReject = true;
        });
        if (revisiContainer) {
            revisiContainer.style.display = isReject ? "block" : "none";
            if(!isReject) {
                checkboxes.forEach(cb => cb.checked = false);
            }
        }
    }

    actionInputs.forEach(input => {
        input.addEventListener("change", updateRevisiVisibility);
    });
    
    // Initial check
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
