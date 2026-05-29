<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Permohonan PPKPR Berusaha — PATEN PAK MIKO</title>
    
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
                    <h1 class="page-title">Pelacakan PPKPR Berusaha</h1>
                </div>
                <a href="{{ route('berusaha.index') }}" class="back-link">
                    <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Kembali ke Dashboard
                </a>
            </div>
 
            <!-- DOWNLOAD DOKUMEN FINAL PRODUK AKHIR (Flowchart Image 4 & 5) -->
            @if($application->status === 'disetujui' && $application->satu_pintu_document)
                <a href="{{ asset('storage/' . $application->satu_pintu_document) }}" target="_blank" class="btn-download-cert" style="margin-bottom: 20px;">
                    <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                    Unduh Sertifikat / Dokumen Produk Akhir PKKPR Berusaha (PDF)
                </a>
 
                <!-- FITUR ULASAN LAYANAN (ANTI-SPAM) -->
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
                    && $now->toDateString() >= $application->bpn_cek_lokasi_dt->copy()->addDay()->toDateString();
                $rapatLewat = $application->bpn_rapat_dt
                    && $now->toDateString() >= $application->bpn_rapat_dt->copy()->addDay()->toDateString();
            @endphp
 
            <!-- ==================================================== -->
            <!-- ─── VERIFICATION PANELS FOR DIFFERENT ROLES ──────── -->
            <!-- ==================================================== -->
 
            <!-- 1. BPN PANEL -->
            @if($user->isBpn() && $application->status === 'menunggu_bpn')
                <div class="verify-card">
                    <h3 class="verify-title">🏢 Panel Pemeriksaan BPN</h3>
 
                    <!-- SUB-STEP 1: Verifikasi Berkas Awal -->
                    @if($application->bpn_berkas_status === 'menunggu')
                        <form action="{{ route('berusaha.verify', $application->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="step" value="bpn_berkas">
                            <div style="display: flex; gap: 8px; align-items: center; margin-bottom: 12px;">
                                <strong style="font-size: 13px;">Langkah 1: Verifikasi Kelayakan Dokumen Persyaratan</strong>
                                <span class="verify-step-badge">Aktif</span>
                            </div>
                            <div class="form-group-v">
                                <label for="action">Tindakan Pemeriksaan Berkas</label>
                                <select name="action" id="action" class="form-select-v" required>
                                    <option value="approve">Berkas Sesuai & Valid (Pelaku Usaha dapat melakukan blast notif)</option>
                                    <option value="reject">Berkas Tidak Sesuai (Kirim catatan kesalahan)</option>
                                </select>
                            </div>
                            <div class="form-group-v">
                                <label for="notes">Catatan Pemeriksaan</label>
                                <textarea name="notes" id="notes" class="form-control-v" rows="3" placeholder="Masukkan catatan atau instruksi perbaikan..." required></textarea>
                            </div>
                            <button type="submit" class="btn-submit-v">Simpan Verifikasi Berkas</button>
                        </form>
 
                    <!-- SUB-STEP 2: Validasi Pembayaran (Setelah berkas Diterima & Blast Notif pemohon selesai) -->
                    @elseif($application->bpn_berkas_status === 'diterima' && $application->bpn_pembayaran_status === 'belum_bayar')
                        <form action="{{ route('berusaha.verify', $application->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="step" value="bpn_pembayaran">
                            <div style="display: flex; gap: 8px; align-items: center; margin-bottom: 12px;">
                                <strong style="font-size: 13px;">Langkah 2: Cek PKKPR Gistaru & Validasi Pembayaran Retribusi</strong>
                                <span class="verify-step-badge">Aktif</span>
                            </div>
                            <div class="form-group-v">
                                <label for="action">Status Validasi Pembayaran</label>
                                <select name="action" id="action" class="form-select-v" required>
                                    <option value="sudah_bayar">Sudah Bayar / Pembayaran Terverifikasi Lunas</option>
                                    <option value="belum_bayar">Belum Bayar (Kirim tagihan / peringatan WA)</option>
                                </select>
                            </div>
                            <div class="form-group-v">
                                <label for="notes">Catatan Pembayaran (Opsional)</label>
                                <textarea name="notes" id="notes" class="form-control-v" rows="2" placeholder="Masukkan catatan transaksi..."></textarea>
                            </div>
                            <button type="submit" class="btn-submit-v">Simpan Status Pembayaran</button>
                        </form>
 
                    <!-- SUB-STEP 3: Penjadwalan Cek Lokasi Lapangan -->
                    @elseif($application->bpn_pembayaran_status === 'sudah_bayar' && !$application->bpn_cek_lokasi_dt)
                        <form action="{{ route('berusaha.verify', $application->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="step" value="bpn_cek_lokasi">
                            <div style="display: flex; gap: 8px; align-items: center; margin-bottom: 12px;">
                                <strong style="font-size: 13px;">Langkah 3: Jadwal Cek Lokasi Lapangan</strong>
                                <span class="verify-step-badge">Aktif</span>
                            </div>
                            <div class="form-grid-2">
                                <div class="form-group-v">
                                    <label for="bpn_cek_lokasi_dt">Tanggal & Waktu Peninjauan</label>
                                    <input type="datetime-local" name="bpn_cek_lokasi_dt" id="bpn_cek_lokasi_dt" class="form-control-v" 
                                           value="{{ $application->bpn_cek_lokasi_dt ? $application->bpn_cek_lokasi_dt->format('Y-m-d\TH:i') : '' }}" required>
                                </div>
                                <div class="form-group-v">
                                    <label for="bpn_cek_lokasi_cp">Kontak CP Admin / Petugas</label>
                                    <input type="text" name="bpn_cek_lokasi_cp" id="bpn_cek_lokasi_cp" class="form-control-v" placeholder="cth: Admin BPN (081234567891)" 
                                           value="{{ $application->bpn_cek_lokasi_cp }}" required>
                                </div>
                            </div>
                            <button type="submit" class="btn-submit-v">
                                <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 2L11 13M22 2l-7 20-4-9-9-4 20-7z"/></svg>
                                Kirimkan Jadwal Cek Lokasi
                            </button>
                        </form>
 
                    <!-- SUB-STEP 4: Penjadwalan Rapat Sidang BPN -->
                    @elseif($application->bpn_cek_lokasi_dt && !$application->bpn_rapat_dt)
                        <form action="{{ route('berusaha.verify', $application->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="step" value="bpn_rapat">
                            <div style="display: flex; gap: 8px; align-items: center; margin-bottom: 12px;">
                                <strong style="font-size: 13px;">Langkah 4: Jadwal Sidang / Rapat Koordinasi</strong>
                                <span class="verify-step-badge">Aktif</span>
                            </div>
                            <div class="form-group-v">
                                <label for="bpn_rapat_dt">Tanggal & Waktu Rapat</label>
                                <input type="datetime-local" name="bpn_rapat_dt" id="bpn_rapat_dt" class="form-control-v" 
                                       value="{{ $application->bpn_rapat_dt ? $application->bpn_rapat_dt->format('Y-m-d\TH:i') : '' }}" required>
                            </div>
                            <button type="submit" class="btn-submit-v">
                                <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 2L11 13M22 2l-7 20-4-9-9-4 20-7z"/></svg>
                                Kirimkan Jadwal Rapat
                            </button>
                        </form>
 
                    <!-- SUB-STEP 5: Penerbitan Rekomendasi Teknis / Pertek -->
                    @elseif($application->bpn_rapat_dt && !$application->bpn_pertek_document)
                        <form action="{{ route('berusaha.verify', $application->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="step" value="bpn_pertek">
                            <div style="display: flex; gap: 8px; align-items: center; margin-bottom: 12px;">
                                <strong style="font-size: 13px;">Langkah 5: Penerbitan Pertek Pertanahan</strong>
                                <span class="verify-step-badge">Aktif</span>
                            </div>
                            <div class="form-group-v">
                                <label for="action">Tindakan Rekomendasi Teknis</label>
                                <select name="action" id="action" class="form-select-v" required>
                                    <option value="approve">Setujui & Terbitkan Surat Pertek (Diteruskan ke Dinas PU)</option>
                                    <option value="reject">Tolak Permohonan Berusaha</option>
                                </select>
                            </div>
                            <div class="form-group-v">
                                <label for="bpn_pertek_document">Dokumen Surat Pertek (PDF)</label>
                                <input type="file" name="bpn_pertek_document" id="bpn_pertek_document" class="form-control-v" accept=".pdf">
                                <span style="font-size: 11px; color: var(--clr-muted);">*Wajib diunggah jika permohonan disetujui. Maksimal 10MB.</span>
                            </div>
                            <div class="form-group-v">
                                <label for="notes">Catatan Pertimbangan Teknis BPN</label>
                                <textarea name="notes" id="notes" class="form-control-v" rows="3" placeholder="Masukkan ringkasan kajian tata ruang pertanahan..." required></textarea>
                            </div>
                            <button type="submit" class="btn-submit-v">Kirim Pertek Pertanahan</button>
                        </form>
                    @endif
                </div>
            @endif
 
            <!-- 2. DINAS PU PANEL -->
            @if($user->isDinasPu() && $application->status === 'menunggu_dinas_pu')
                <div class="verify-card">
                    <h3 class="verify-title">⚙️ Panel Penilaian — Dinas Pekerjaan Umum (PU)</h3>
                    <form action="{{ route('berusaha.verify', $application->id) }}" method="POST">
                        @csrf
                        <div class="form-group-v">
                            <label for="action">Penilaian Kepatuhan Tata Ruang</label>
                            <select name="action" id="action" class="form-select-v" required>
                                <option value="sesuai">Sesuai Tata Ruang (Lanjut ke Dinas Satu Pintu / PTSP)</option>
                                <option value="belum_sesuai">Belum Sesuai Tata Ruang (Menunggu penyesuaian)</option>
                            </select>
                        </div>
                        <div class="form-group-v">
                            <label for="notes">Catatan Kajian Penilaian Tata Ruang</label>
                            <textarea name="notes" id="notes" class="form-control-v" rows="3" placeholder="Masukkan justifikasi penilaian kesesuaian pemanfaatan ruang..." required></textarea>
                        </div>
                        <button type="submit" class="btn-submit-v">Kirim Penilaian PU</button>
                    </form>
                </div>
            @endif
 
            <!-- 3. DINAS SATU PINTU (PTSP) PANEL -->
            @if($user->isSatuPintu() && $application->status === 'menunggu_satu_pintu')
                <div class="verify-card">
                    <h3 class="verify-title">🏛️ Panel Penerbitan Dokumen Akhir — Dinas Satu Pintu (PTSP)</h3>
                    <form action="{{ route('berusaha.verify', $application->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-grid-2">
                            <div class="form-group-v">
                                <label for="satu_pintu_no_pkkpr">Nomor PKKPR Berusaha</label>
                                <input type="text" name="satu_pintu_no_pkkpr" id="satu_pintu_no_pkkpr" class="form-control-v" placeholder="cth: 503/PKKPR-B/2026/XYZ" required>
                            </div>
                            <div class="form-group-v">
                                <label for="satu_pintu_tanggal_terbit">Tanggal Terbit</label>
                                <input type="date" name="satu_pintu_tanggal_terbit" id="satu_pintu_tanggal_terbit" class="form-control-v" required>
                            </div>
                        </div>
                        <div class="form-group-v">
                            <label for="satu_pintu_document">Dokumen Produk Akhir PKKPR (PDF)</label>
                            <input type="file" name="satu_pintu_document" id="satu_pintu_document" class="form-control-v" accept=".pdf" required>
                            <span style="font-size: 11px; color: var(--clr-muted);">*Wajib mengunggah sertifikat/SK PKKPR Berusaha hasil akhir. Maksimal 10MB.</span>
                        </div>
                        <div class="form-group-v">
                            <label for="notes">Catatan Tambahan (Opsional)</label>
                            <textarea name="notes" id="notes" class="form-control-v" rows="2" placeholder="Masukkan keterangan tambahan jika ada..."></textarea>
                        </div>
                        <button type="submit" class="btn-submit-v">
                            <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 2L11 13M22 2l-7 20-4-9-9-4 20-7z"/></svg>
                            Kirim & Tuntaskan Permohonan
                        </button>
                    </form>
                </div>
            @endif
 
            <!-- 4. PELAKU USAHA ACTION: REUPLOAD JIKA BERKAS TIDAK SESUAI (Image 2) -->
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
 
            <!-- 5. PELAKU USAHA ACTION: BLAST NOTIF KE BPN (Image 2) -->
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
                        <h2 class="card-title">Informasi Pengajuan Permohonan</h2>
                        
                        <ul class="detail-list">
                            <li class="detail-item">
                                <span class="detail-label">Nomor Registrasi</span>
                                <span class="detail-val app-num">{{ $application->application_number }}</span>
                            </li>
                            <li class="detail-item">
                                <span class="detail-label">Status Utama</span>
                                <span class="detail-val">
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
                                <span class="detail-label">Nama Pemohon (Pengaju)</span>
                                <span class="detail-val">{{ $application->nama_pengaju }}</span>
                            </li>
                            <li class="detail-item">
                                <span class="detail-label">Hubungan Pengaju</span>
                                <span class="detail-val">{{ $application->hubungan_pengaju }}</span>
                            </li>
                            <li class="detail-item">
                                <span class="detail-label">Tanggal Pengajuan</span>
                                <span class="detail-val">{{ $application->created_at->translatedFormat('d F Y, H:i') }} WIB</span>
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
 
                            <!-- Satu Pintu Info -->
                            @if($application->satu_pintu_no_pkkpr)
                                <li class="detail-item">
                                    <span class="detail-label">Nomor PKKPR</span>
                                    <span class="detail-val">{{ $application->satu_pintu_no_pkkpr }}</span>
                                </li>
                            @endif
 
                            <li class="detail-item" style="display: flex; flex-direction: column; gap: 8px;">
                                <span class="detail-label" style="border-bottom: 1px solid var(--clr-line); padding-bottom: 8px; margin-bottom: 4px;">Berkas Lampiran Persyaratan</span>
                                
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
 
                <!-- Right: Staged Tracking Timeline (Flowchart Steps) -->
                <div>
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
                            <div class="timeline-step {{ $step2Status }}">
                                <span class="timeline-dot"></span>
                                <div class="timeline-title">1. Verifikasi Berkas Awal (BPN)</div>
                                <div class="timeline-desc">Validasi kelayakan berkas dokumen persyaratan pemohon.</div>
                                @if($application->bpn_berkas_status === 'tidak_sesuai')
                                    <div class="timeline-notes">
                                        <strong>Catatan Koreksi BPN:</strong> {{ $application->bpn_notes }}
                                    </div>
                                @endif
                            </div>
 
                            <!-- STEP 3: Pembayaran Retribusi -->
                            @php
                                $step3Status = '';
                                if ($application->bpn_berkas_status === 'diterima') {
                                    $step3Status = $application->bpn_pembayaran_status === 'sudah_bayar' ? 'completed' : 'active';
                                }
                            @endphp
                            <div class="timeline-step {{ $step3Status }}">
                                <span class="timeline-dot"></span>
                                <div class="timeline-title">2. Cek Gistaru & Pembayaran (BPN)</div>
                                <div class="timeline-desc">Verifikasi data lokasi pada Gistaru dan penyelesaian retribusi pertanahan.</div>
                            </div>
 
                            <!-- STEP 4: Cek Lokasi Lapangan BPN -->
                            @php
                                $step4Status = '';
                                if ($application->bpn_pembayaran_status === 'sudah_bayar') {
                                    if ($application->bpn_cek_lokasi_dt) {
                                        $step4Status = 'completed';
                                    } else {
                                        $step4Status = 'active';
                                    }
                                }
                            @endphp
                            <div class="timeline-step {{ $step4Status }}">
                                <span class="timeline-dot"></span>
                                <div class="timeline-title">3. Cek Lokasi Lapangan (BPN)</div>
                                <div class="timeline-desc">
                                    @if($application->bpn_cek_lokasi_dt)
                                        Waktu Cek: <strong>{{ $application->bpn_cek_lokasi_date }}</strong><br>
                                        Petugas Lapangan: <strong>{{ $application->bpn_cek_lokasi_cp }}</strong>
                                    @else
                                        Menunggu input jadwal cek lokasi lapangan offline.
                                    @endif
                                </div>
                            </div>
 
                            <!-- STEP 5: Rapat Koordinasi BPN -->
                            @php
                                $step5Status = '';
                                if ($application->bpn_cek_lokasi_dt) {
                                    if ($application->bpn_rapat_dt) {
                                        $step5Status = 'completed';
                                    } else {
                                        $step5Status = 'active';
                                    }
                                }
                            @endphp
                            <div class="timeline-step {{ $step5Status }}">
                                <span class="timeline-dot"></span>
                                <div class="timeline-title">4. Sidang / Rapat Koordinasi (BPN)</div>
                                <div class="timeline-desc">
                                    @if($application->bpn_rapat_dt)
                                        Waktu Sidang: <strong>{{ $application->bpn_rapat_date }}</strong>
                                    @else
                                        Menunggu jadwal sidang tata ruang pertanahan.
                                    @endif
                                </div>
                            </div>
 
                            <!-- STEP 6: Penerbitan Pertek BPN -->
                            @php
                                $step6Status = '';
                                if ($application->bpn_rapat_dt) {
                                    $step6Status = $application->bpn_pertek_document ? 'completed' : 'active';
                                }
                            @endphp
                            <div class="timeline-step {{ $step6Status }}">
                                <span class="timeline-dot"></span>
                                <div class="timeline-title">5. Penerbitan Pertek Pertanahan</div>
                                <div class="timeline-desc">
                                    @if($application->bpn_pertek_document)
                                        Dokumen Pertek berhasil diunggah. Permohonan diteruskan ke Dinas PU.
                                    @else
                                        Menunggu rapat selesai untuk penerbitan surat rekomendasi teknis.
                                    @endif
                                </div>
                            </div>
 
                            <!-- STEP 7: Penilaian Dinas PU -->
                            @php
                                $step7Status = '';
                                if ($application->status !== 'menunggu_bpn') {
                                    if ($application->dinas_pu_status === 'sesuai') {
                                        $step7Status = 'completed';
                                    } elseif ($application->dinas_pu_status === 'belum_sesuai') {
                                        $step7Status = 'rejected';
                                    } else {
                                        $step7Status = 'active';
                                    }
                                }
                            @endphp
                            <div class="timeline-step {{ $step7Status }}">
                                <span class="timeline-dot"></span>
                                <div class="timeline-title">6. Penilaian Tata Ruang (Dinas PU)</div>
                                <div class="timeline-desc">Kesesuaian tata ruang dinilai berdasarkan dokumen Pertek BPN.</div>
                                @if($application->dinas_pu_notes)
                                    <div class="timeline-notes" style="border-left-color: {{ $application->dinas_pu_status === 'sesuai' ? 'var(--clr-green)' : '#E53E3E' }}; background: {{ $application->dinas_pu_status === 'sesuai' ? '#F4FBF7' : '#FFF5F5' }}; color: {{ $application->dinas_pu_status === 'sesuai' ? '#137333' : '#C53030' }}">
                                        <strong>Catatan Dinas PU:</strong> {{ $application->dinas_pu_notes }}
                                    </div>
                                @endif
                            </div>
 
                            <!-- STEP 8: Penerbitan Sertifikat (Satu Pintu / PTSP) -->
                            @php
                                $step8Status = '';
                                if ($application->dinas_pu_status === 'sesuai') {
                                    $step8Status = $application->satu_pintu_document ? 'completed' : 'active';
                                }
                            @endphp
                            <div class="timeline-step {{ $step8Status }}">
                                <span class="timeline-dot"></span>
                                <div class="timeline-title">7. Penerbitan Sertifikat (Satu Pintu)</div>
                                <div class="timeline-desc">Input data legalitas dan upload dokumen produk akhir PKKPR.</div>
                            </div>
 
                            <!-- STEP 9: Selesai / Ditolak -->
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
                                        Permohonan dihentikan/ditolak oleh Kantor Pertanahan atau Dinas PU.
                                    @elseif($application->status === 'disetujui')
                                        Seluruh alur selesai. Sertifikat PKKPR Berusaha siap diunduh.
                                    @else
                                        Menunggu seluruh tahapan selesai disetujui instansi terkait.
                                    @endif
                                </div>
                            </div>
 
                        </div>
                    </div>
                </div>
 
            </div>
        </div>
    </main>
 
</body>
</html>
