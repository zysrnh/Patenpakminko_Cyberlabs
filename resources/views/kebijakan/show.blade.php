<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Permohonan {{ $application->service_name }} — PATEN PAK MIKO</title>
    
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
            grid-template-columns: 1.5fr 1fr;
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
                    <h1 class="page-title">Pelacakan Berkas {{ $application->service_name }}</h1>
                </div>
                <a href="{{ route('kebijakan.index') }}" class="back-link">
                    <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Kembali ke Dashboard
                </a>
            </div>
 
            <!-- DOWNLOAD DOKUMEN FINAL PERTEK (Jika Status Disetujui) -->
            @if($application->status === 'disetujui' && $application->bpn_pertek_document)
                <a href="{{ asset('storage/' . $application->bpn_pertek_document) }}" target="_blank" class="btn-download-cert" style="margin-bottom: 20px;">
                    <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                    Unduh Surat Rekomendasi / Pertek {{ $application->service_name }} (PDF)
                </a>
 
                <!-- FITUR ULASAN LAYANAN (ANTI-SPAM) -->
                @php
                    $review = \App\Models\Review::where('user_id', Auth::id())
                        ->where('module_type', 'kebijakan')
                        ->where('module_id', $application->id)
                        ->first();
                @endphp
 
                @if(Auth::user()->isPelakuUsaha())
                    <div class="verify-card" style="border-color: #CBD5E0; background: #F8FAFC; margin-bottom: 24px; padding: 24px;">
                        <h3 class="verify-title" style="color: var(--clr-blue-dk); margin-bottom: 12px; display: flex; align-items: center; gap: 8px;">
                            ⭐ Ulasan & Penilaian Layanan
                        </h3>
 
                        @if($review)
                            <div style="background: #FFFFFF; border: 1.5px solid var(--clr-line); padding: 16px; border-radius: 10px;">
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                                    <span style="color: #D69E2E; font-size: 16px; font-weight: 700;">
                                        {{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5 - $review->rating) }} 
                                        <span style="color: var(--clr-ink); font-size: 13px; font-weight: 800; margin-left: 6px;">({{ $review->rating_label }})</span>
                                    </span>
                                    @if($review->is_approved)
                                        <span style="font-size: 11px; background: var(--clr-blue-lt); color: var(--clr-blue-dk); padding: 3px 10px; border-radius: 100px; font-weight: 700;">Telah Dipublikasikan</span>
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
 
            <!-- STAGED VERIFICATION FORM (Hanya untuk BPN yang sedang bertugas) -->
            @php
                $user = Auth::user();
                $canVerify = false;
                $verifierRoleLabel = '';
                
                if ($user->isBpn() && $application->status === 'menunggu_bpn') {
                    $canVerify = true;
                    $verifierRoleLabel = 'Petugas BPN (Verifikasi Kebijakan)';
                }
 
                // Logika Waktu Untuk Staged Timeline & Penentuan Form Aktif BPN
                $now = \Carbon\Carbon::now();
                $cekLokasiLewat = $application->bpn_cek_lokasi_dt
                    && $now->toDateString() >= $application->bpn_cek_lokasi_dt->copy()->addDay()->toDateString();
                $rapatLewat = $application->bpn_rapat_dt
                    && $now->toDateString() >= $application->bpn_rapat_dt->copy()->addDay()->toDateString();
            @endphp
 
            @if($canVerify)
                <div class="verify-card">
                    <h3 class="verify-title">📝 Panel Pemeriksaan Berkas — {{ $verifierRoleLabel }}</h3>
                    
                    @if($user->isBpn() && $application->status === 'menunggu_bpn')
 
                        <!-- TAHAP 1: Verifikasi Berkas Awal -->
                        @if($application->bpn_berkas_status === 'menunggu')
                            <form action="{{ route('kebijakan.verify', $application->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="step" value="bpn_berkas">
                                <div style="display: flex; gap: 8px; align-items: center; margin-bottom: 12px;">
                                    <strong style="font-size: 13.5px; color: var(--clr-ink);">TAHAP 1: Verifikasi Dokumen Persyaratan Awal</strong>
                                    <span class="verify-step-badge">Aktif</span>
                                </div>
                                <div class="form-group-v">
                                    <label for="action">Tindakan Kelayakan Berkas</label>
                                    <select name="action" id="action" class="form-select-v" required>
                                        <option value="approve">Lolos & Terima Berkas (Lanjut Cek Lokasi)</option>
                                        <option value="reject">Tolak Permohonan (Berhenti)</option>
                                    </select>
                                </div>
                                <div class="form-group-v">
                                    <label for="notes">Catatan Kelayakan Berkas</label>
                                    <textarea name="notes" id="notes" class="form-control-v" rows="3" placeholder="Masukkan catatan pemeriksaan dokumen awal..." required></textarea>
                                </div>
                                <button type="submit" class="btn-submit-v">Simpan Verifikasi Tahap 1</button>
                            </form>
 
                        <!-- TAHAP 2: Penjadwalan Cek Lokasi -->
                        @elseif($application->bpn_berkas_status === 'diterima' && !$cekLokasiLewat)
                            <form action="{{ route('kebijakan.verify', $application->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="step" value="bpn_cek_lokasi">
                                <div style="display: flex; gap: 8px; align-items: center; margin-bottom: 12px;">
                                    <strong style="font-size: 13.5px; color: var(--clr-ink);">TAHAP 2: Penentuan Jadwal Cek Lokasi Lapangan</strong>
                                    <span class="verify-step-badge">Aktif</span>
                                </div>
 
                                @if($application->bpn_cek_lokasi_dt)
                                    <div style="background: var(--clr-blue-lt); border-radius: 8px; padding: 12px; font-size: 13px; color: var(--clr-blue-dk); margin-bottom: 16px; border-left: 3px solid var(--clr-blue);">
                                        Jadwal cek lokasi saat ini sudah diatur pada: <strong>{{ $application->bpn_cek_lokasi_date }}</strong>.<br>
                                        Anda dapat memperbarui jadwal di bawah ini jika diperlukan. Terdapat tenggang waktu verifikasi otomatis 1 hari setelah jadwal terlewati.
                                    </div>
                                @endif
 
                                <div class="form-grid-2">
                                    <div class="form-group-v">
                                        <label for="bpn_cek_lokasi_dt">Waktu Peninjauan Lapangan</label>
                                        <input type="datetime-local" name="bpn_cek_lokasi_dt" id="bpn_cek_lokasi_dt" class="form-control-v" 
                                               value="{{ $application->bpn_cek_lokasi_dt ? $application->bpn_cek_lokasi_dt->format('Y-m-d\TH:i') : '' }}" required>
                                    </div>
                                    <div class="form-group-v">
                                        <label for="bpn_cek_lokasi_cp">Kontak Person Lapangan (Nama/No. HP)</label>
                                        <input type="text" name="bpn_cek_lokasi_cp" id="bpn_cek_lokasi_cp" class="form-control-v" placeholder="cth: Budi Setiawan (08123456789)" 
                                               value="{{ $application->bpn_cek_lokasi_cp }}" required>
                                    </div>
                                </div>
                                <button type="submit" class="btn-submit-v">
                                    {{ $application->bpn_cek_lokasi_dt ? 'Sesuaikan & Kirim Jadwal Baru' : 'Simpan & Kirim Jadwal Ke WhatsApp' }}
                                </button>
                            </form>
 
                        <!-- TAHAP 3: Penjadwalan Sidang / Rapat Koordinasi -->
                        @elseif($cekLokasiLewat && !$rapatLewat)
                            <form action="{{ route('kebijakan.verify', $application->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="step" value="bpn_rapat">
                                <div style="display: flex; gap: 8px; align-items: center; margin-bottom: 12px;">
                                    <strong style="font-size: 13.5px; color: var(--clr-ink);">TAHAP 3: Penjadwalan Sidang / Rapat Koordinasi BPN</strong>
                                    <span class="verify-step-badge">Aktif</span>
                                </div>
 
                                @if($application->bpn_rapat_dt)
                                    <div style="background: var(--clr-blue-lt); border-radius: 8px; padding: 12px; font-size: 13px; color: var(--clr-blue-dk); margin-bottom: 16px; border-left: 3px solid var(--clr-blue);">
                                        Jadwal Rapat Koordinasi saat ini sudah diatur pada: <strong>{{ $application->bpn_rapat_date }}</strong>.<br>
                                        Anda dapat memperbarui jadwal di bawah ini jika diperlukan. Terdapat tenggang waktu verifikasi otomatis 1 hari setelah jadwal terlewati.
                                    </div>
                                @endif
 
                                <div class="form-group-v">
                                    <label for="bpn_rapat_dt">Waktu Sidang/Rapat Koordinasi</label>
                                    <input type="datetime-local" name="bpn_rapat_dt" id="bpn_rapat_dt" class="form-control-v" 
                                           value="{{ $application->bpn_rapat_dt ? $application->bpn_rapat_dt->format('Y-m-d\TH:i') : '' }}" required>
                                </div>
                                <button type="submit" class="btn-submit-v">
                                    {{ $application->bpn_rapat_dt ? 'Sesuaikan & Kirim Rapat Baru' : 'Simpan & Kirim Jadwal Rapat Ke WhatsApp' }}
                                </button>
                            </form>
 
                        <!-- TAHAP 4: Penerbitan Surat Pertek Akhir -->
                        @elseif($rapatLewat && !$application->bpn_pertek_document)
                            <form action="{{ route('kebijakan.verify', $application->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="step" value="bpn_pertek">
                                <div style="display: flex; gap: 8px; align-items: center; margin-bottom: 12px;">
                                    <strong style="font-size: 13.5px; color: var(--clr-ink);">TAHAP 4: Unggah Dokumen Pertek Hasil Akhir</strong>
                                    <span class="verify-step-badge">Aktif</span>
                                </div>
                                <div class="form-group-v">
                                    <label for="action">Keputusan Rekomendasi Teknis</label>
                                    <select name="action" id="action" class="form-select-v" required>
                                        <option value="approve">Setujui & Terbitkan Surat Rekomendasi</option>
                                        <option value="reject">Tolak Rekomendasi Pertanahan</option>
                                    </select>
                                </div>
                                <div class="form-group-v">
                                    <label for="bpn_pertek_document">Dokumen Surat Rekomendasi/Pertek (PDF)</label>
                                    <input type="file" name="bpn_pertek_document" id="bpn_pertek_document" class="form-control-v" accept=".pdf,.doc,.docx">
                                    <span style="font-size: 11px; color: var(--clr-muted);">*Wajib diunggah jika permohonan disetujui. Maksimal 10MB.</span>
                                </div>
                                <div class="form-group-v">
                                    <label for="notes">Catatan Rekomendasi/Pertek Akhir BPN</label>
                                    <textarea name="notes" id="notes" class="form-control-v" rows="3" placeholder="Masukkan ringkasan pertimbangan tata ruang BPN..." required></textarea>
                                </div>
                                <button type="submit" class="btn-submit-v">Tuntaskan & Terbitkan Hasil Akhir</button>
                            </form>
                        @endif
 
                    @endif
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
                                <span class="detail-label">Status Verifikasi</span>
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
                            <li class="detail-item" style="display: flex; flex-direction: column; gap: 8px;">
                                <span class="detail-label" style="border-bottom: 1px solid var(--clr-line); padding-bottom: 8px; margin-bottom: 4px;">Berkas Lampiran Persyaratan</span>
                                @php
                                    $jenisPermohonan = 'kebijakan';
                                    if ($application->ptp_data) {
                                        $ptp = json_decode($application->ptp_data, true);
                                        $jenisPermohonan = $ptp['jenis_permohonan'] ?? 'kebijakan';
                                    }
                                @endphp

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
                                    <span style="font-size: 13px; color: var(--clr-mid);">
                                        @if($jenisPermohonan === 'psn')
                                            5. Dokumen Penetapan / Rekomendasi PSN
                                        @elseif($jenisPermohonan === 'tanah-timbul')
                                            5. Surat Keterangan Tanah Timbul (Kades/Lurah)
                                        @else
                                            5. FC Akta Pendirian
                                        @endif
                                    </span>
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
                                    <span style="font-size: 13px; color: var(--clr-mid);">
                                        @if($jenisPermohonan === 'psn')
                                            7. NIB / Izin Sektoral
                                        @elseif($jenisPermohonan === 'tanah-timbul')
                                            7. Surat Pernyataan Penguasaan Fisik (Sporadik)
                                        @else
                                            7. NIB
                                        @endif
                                    </span>
                                    <a href="{{ asset('storage/' . $application->nib) }}" target="_blank" class="btn-doc">Buka Berkas</a>
                                </div>
                                @endif

                                @if($application->kbli)
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <span style="font-size: 13px; color: var(--clr-mid);">
                                        @if($jenisPermohonan === 'psn')
                                            8. KBLI / Klasifikasi PSN
                                        @elseif($jenisPermohonan === 'tanah-timbul')
                                            8. Berita Acara Peninjauan Batas
                                        @else
                                            8. KBLI
                                        @endif
                                    </span>
                                    <a href="{{ asset('storage/' . $application->kbli) }}" target="_blank" class="btn-doc">Buka Berkas</a>
                                </div>
                                @endif

                                @if($application->proposal_kegiatan)
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <span style="font-size: 13px; color: var(--clr-mid);">
                                        @if($jenisPermohonan === 'psn')
                                            9. Proposal / Masterplan PSN
                                        @elseif($jenisPermohonan === 'tanah-timbul')
                                            9. Bukti / Rencana Penggunaan Tanah
                                        @else
                                            9. Proposal Kegiatan
                                        @endif
                                    </span>
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
                    <div class="card">
                        <h2 class="card-title">Linimasa Pelacakan Berkas</h2>
                        
                        <div class="timeline">
                            
                            <!-- STEP 1: Diajukan -->
                            <div class="timeline-step completed">
                                <span class="timeline-dot"></span>
                                <div class="timeline-title">Berkas Berhasil Diajukan</div>
                                <div class="timeline-desc">Pelaku usaha berhasil mengunggah berkas persyaratan secara lengkap ke portal PATEN PAK MIKO.</div>
                            </div>
 
                            <!-- STEP 2: Verifikasi Berkas Awal BPN -->
                            @php
                                $step2Status = 'active';
                                if ($application->bpn_berkas_status === 'diterima') {
                                    $step2Status = 'completed';
                                } elseif ($application->bpn_berkas_status === 'ditolak') {
                                    $step2Status = 'rejected';
                                }
                            @endphp
                            <div class="timeline-step {{ $step2Status }}">
                                <span class="timeline-dot"></span>
                                <div class="timeline-title">1. Verifikasi Berkas Awal (BPN)</div>
                                <div class="timeline-desc">Validasi awal kelengkapan berkas dokumen persyaratan pemohon.</div>
                                @if($application->bpn_berkas_status === 'diterima' && $application->bpn_notes && !$application->bpn_cek_lokasi_dt)
                                    <div class="timeline-notes">
                                        <strong>Catatan BPN:</strong> {{ $application->bpn_notes }}
                                    </div>
                                @endif
                            </div>
 
                            <!-- STEP 3: Cek Lokasi Lapangan BPN -->
                            @php
                                $step3Status = '';
                                if ($application->bpn_berkas_status === 'diterima') {
                                    if ($application->bpn_cek_lokasi_dt) {
                                        $step3Status = $cekLokasiLewat ? 'completed' : 'active';
                                    } else {
                                        $step3Status = 'active';
                                    }
                                }
                            @endphp
                            <div class="timeline-step {{ $step3Status }}">
                                <span class="timeline-dot"></span>
                                <div class="timeline-title">2. Cek Lokasi Lapangan (BPN)</div>
                                <div class="timeline-desc">
                                    @if($application->bpn_cek_lokasi_dt)
                                        Dijadwalkan pada: <strong>{{ $application->bpn_cek_lokasi_date }}</strong><br>
                                        CP Lapangan: <strong>{{ $application->bpn_cek_lokasi_cp }}</strong>
                                    @else
                                        Menunggu penentuan jadwal peninjauan lapangan offline.
                                    @endif
                                </div>
                            </div>
 
                            <!-- STEP 4: Rapat Koordinasi BPN -->
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
                            <div class="timeline-step {{ $step4Status }}">
                                <span class="timeline-dot"></span>
                                <div class="timeline-title">3. Sidang / Rapat Koordinasi (BPN)</div>
                                <div class="timeline-desc">
                                    @if($application->bpn_rapat_dt)
                                        Dijadwalkan pada: <strong>{{ $application->bpn_rapat_date }}</strong>
                                    @else
                                        Menunggu penentuan jadwal rapat koordinasi pertanahan.
                                    @endif
                                </div>
                            </div>
 
                            <!-- STEP 5: Penerbitan Pertek BPN -->
                            @php
                                $step5Status = '';
                                if ($rapatLewat) {
                                    $step5Status = $application->bpn_pertek_document ? 'completed' : 'active';
                                }
                            @endphp
                            <div class="timeline-step {{ $step5Status }}">
                                <span class="timeline-dot"></span>
                                <div class="timeline-title">4. Penerbitan Pertek Pertanahan</div>
                                <div class="timeline-desc">
                                    @if($application->bpn_pertek_document)
                                        Dokumen Pertek resmi telah diterbitkan dan diunggah.
                                    @else
                                        Menunggu rapat selesai untuk penerbitan rekomendasi teknis BPN.
                                    @endif
                                </div>
                            </div>
 
                            <!-- STEP 6: Selesai / Ditolak -->
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
                                        Permohonan dihentikan/ditolak oleh Kantor Pertanahan (BPN).
                                    @elseif($application->status === 'disetujui')
                                        Sertifikat / Surat Rekomendasi Kebijakan Khusus siap diunduh.
                                    @else
                                        Menunggu seluruh tahapan selesai disetujui BPN.
                                    @endif
                                </div>
                                @if($application->status === 'disetujui' && $application->bpn_notes)
                                    <div class="timeline-notes" style="border-color: var(--clr-green);">
                                        <strong>Catatan Akhir BPN:</strong> {{ $application->bpn_notes }}
                                    </div>
                                @endif
                            </div>
 
                        </div>
                    </div>
                </div>
 
            </div>
        </div>
    </main>
 
</body>
</html>
