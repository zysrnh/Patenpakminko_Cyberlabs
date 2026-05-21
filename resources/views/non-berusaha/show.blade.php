<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Permohonan {{ $application->application_number }} — PATENPAKMIKO</title>
    
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

        /* ─── VERIFICATION PANEL ────────────────────────────── */
        .verify-card {
            background: #FFFDF0;
            border: 1.5px solid #FBE89F;
            border-radius: var(--radius-lg);
            padding: 24px;
            margin-bottom: 28px;
        }
        .verify-title {
            font-size: 14.5px;
            font-weight: 800;
            color: #744210;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 16px;
            padding-bottom: 8px;
            border-bottom: 1.5px solid #FBE89F;
        }

        .radio-group {
            display: flex;
            gap: 20px;
            margin-bottom: 16px;
        }
        .radio-label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            color: var(--clr-ink);
        }
        .radio-label input {
            width: 18px;
            height: 18px;
            accent-color: var(--clr-blue);
        }

        .btn-verify-submit {
            background: var(--clr-ink);
            color: white;
            border: none;
            padding: 10px 20px;
            font-family: inherit;
            font-size: 13.5px;
            font-weight: 700;
            border-radius: var(--radius-md);
            cursor: pointer;
            transition: all 0.2s;
        }
        .btn-verify-submit:hover {
            background: #172436;
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

            <div class="page-header">
                <div>
                    <a href="{{ route('non-berusaha.index') }}" class="back-btn">
                        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        Kembali ke Daftar
                    </a>
                    <h1 class="page-title" style="margin-top: 8px;">Detail Permohonan <span style="font-family: 'DM Mono', monospace; font-size: 20px; color: var(--clr-blue);">{{ $application->application_number }}</span></h1>
                </div>
                
                <div>
                    <span class="badge-status" style="background-color: {{ $application->status_color }}">
                        {{ $application->status_label }}
                    </span>
                </div>
            </div>

            <!-- BUTTON DOWNLOAD DOKUMEN PPKPR SELESAI -->
            @if($application->status === 'disetujui' && $application->approval_document)
                <a href="{{ asset('storage/' . $application->approval_document) }}" target="_blank" class="btn-download-cert">
                    <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                    Unduh Dokumen PPKPR Resmi (PDF)
                </a>
            @endif

            <!-- STAGED VERIFICATION FORM (Hanya untuk instansi yang sedang bertugas) -->
            @php
                $user = Auth::user();
                $canVerify = false;
                $verifierRoleLabel = '';
                
                if ($user->isBpn() && $application->status === 'menunggu_bpn') {
                    $canVerify = true;
                    $verifierRoleLabel = 'Petugas BPN (Verifikasi Kepemilikan Tanah)';
                } elseif ($user->isDinasPu() && $application->status === 'menunggu_dinas_pu') {
                    $canVerify = true;
                    $verifierRoleLabel = 'Verifikator Dinas PU (Tata Ruang)';
                } elseif ($user->isSatuPintu() && $application->status === 'menunggu_satu_pintu') {
                    $canVerify = true;
                    $verifierRoleLabel = 'Petugas Dinas Satu Pintu (Penerbitan Izin)';
                }
            @endphp

            @if($canVerify)
                <div class="verify-card">
                    <h3 class="verify-title">📝 Panel Pemeriksaan Berkas — {{ $verifierRoleLabel }}</h3>
                    <form action="{{ route('non-berusaha.verify', $application->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- Keputusan -->
                        <div class="form-group">
                            <label class="form-label" style="font-weight: 700; color: #744210;">Keputusan Peninjauan:</label>
                            <div class="radio-group">
                                <label class="radio-label">
                                    <input type="radio" name="action" value="approve" required checked onclick="toggleCertUpload(true)">
                                    Setujui / Lolos Verifikasi
                                </label>
                                <label class="radio-label" style="color: #E53E3E;">
                                    <input type="radio" name="action" value="reject" required onclick="toggleCertUpload(false)">
                                    Tolak Permohonan
                                </label>
                            </div>
                        </div>

                        <!-- Khusus Satu Pintu: upload dokumen akhir jika disetujui -->
                        @if($user->isSatuPintu())
                            <div class="form-group" id="certUploadWrapper">
                                <label for="approval_document" class="form-label" style="font-weight: 700; color: #744210;">Unggah Dokumen PPKPR Final (PDF) <span class="req" style="color: red;">*</span></label>
                                <input type="file" id="approval_document" name="approval_document" class="form-control" accept="application/pdf" style="background: white;">
                                <span style="font-size: 11.5px; color: #744210; margin-top: 4px; display: block;">Dokumen Surat Keterangan / Sertifikat Kesesuaian Tata Ruang yang sah untuk diunduh pelaku usaha.</span>
                                @error('approval_document')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>
                        @endif

                        <!-- Catatan Verifikasi -->
                        <div class="form-group">
                            <label for="notes" class="form-label" style="font-weight: 700; color: #744210;">Catatan / Uraian Hasil Pemeriksaan:</label>
                            <textarea id="notes" name="notes" class="form-control" rows="4" placeholder="Tuliskan catatan detail verifikasi dokumen pemohon di sini..." style="resize: none; background: white;" required></textarea>
                            @error('notes')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn-verify-submit">Kirim Verifikasi</button>
                    </form>
                </div>

                <script>
                    function toggleCertUpload(show) {
                        const wrapper = document.getElementById('certUploadWrapper');
                        if (wrapper) {
                            const input = document.getElementById('approval_document');
                            if (show) {
                                wrapper.style.display = 'block';
                                input.setAttribute('required', 'required');
                            } else {
                                wrapper.style.display = 'none';
                                input.removeAttribute('required');
                            }
                        }
                    }
                    // Inisialisasi awal
                    document.addEventListener('DOMContentLoaded', () => {
                        toggleCertUpload(true);
                    });
                </script>
            @endif

            <div class="grid-layout">
                
                <!-- Left: Application Details & Uploaded Files -->
                <div>
                    <!-- Data Permohonan -->
                    <div class="card">
                        <h2 class="card-title">Informasi Identitas Pengajuan</h2>
                        <div class="data-list">
                            <div class="data-item">
                                <span class="data-label">Nama Pemilik Usaha</span>
                                <span class="data-val">{{ $application->nama_pemilik_usaha }}</span>
                            </div>
                            <div class="data-item">
                                <span class="data-label">Nama Pengaju / Pemohon</span>
                                <span class="data-val">{{ $application->nama_pengaju }}</span>
                            </div>
                            <div class="data-item">
                                <span class="data-label">Hubungan Pengaju (Sebagai Apa)</span>
                                <span class="data-val">{{ $application->hubungan_pengaju }}</span>
                            </div>
                            <div class="data-item">
                                <span class="data-label">Akun Pemohon (Username)</span>
                                <span class="data-val">{{ $application->user->username }}</span>
                            </div>
                            <div class="data-item">
                                <span class="data-label">Nomor Telepon Gateway / HP</span>
                                <span class="data-val mono">+{{ $application->user->phone_number }}</span>
                            </div>
                            <div class="data-item">
                                <span class="data-label">Tanggal Pengajuan Berkas</span>
                                <span class="data-val">{{ $application->created_at->format('d F Y (H:i)') }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Dokumen Lampiran -->
                    <div class="card">
                        <h2 class="card-title">Dokumen Berkas Persyaratan</h2>
                        <div class="doc-list">
                            
                            <!-- Persyaratan Utama -->
                            <a href="{{ asset('storage/' . $application->doc_persyaratan) }}" target="_blank" class="doc-item">
                                <span class="doc-name">Dokumen Persyaratan Lengkap</span>
                                <span class="doc-status">
                                    Unduh/Lihat Berkas
                                    <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6M15 3h6v6M10 14L21 3"/></svg>
                                </span>
                            </a>

                        </div>
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
                                <div class="timeline-desc">Pelaku usaha berhasil mengunggah berkas persyaratan secara lengkap ke portal PATENPAKMIKO.</div>
                            </div>

                            <!-- STEP 2: BPN -->
                            @php
                                $bpnStepStatus = 'active';
                                if ($application->status !== 'menunggu_bpn') {
                                    $bpnStepStatus = ($application->status === 'ditolak' && is_null($application->bpn_notes) === false) ? 'rejected' : 'completed';
                                }
                            @endphp
                            <div class="timeline-step {{ $bpnStepStatus }}">
                                <span class="timeline-dot"></span>
                                <div class="timeline-title">Pemeriksaan Dokumen Pertanahan (BPN)</div>
                                <div class="timeline-desc">Validasi kepemilikan hak atas tanah, SHM, sertifikat tanah, serta pengecekan batas koordinat.</div>
                                @if($application->bpn_notes)
                                    <div class="timeline-notes">
                                        <strong>Catatan Pemeriksa BPN:</strong><br>
                                        {{ $application->bpn_notes }}
                                    </div>
                                @endif
                            </div>

                            <!-- STEP 3: Dinas PU -->
                            @php
                                $puStepStatus = '';
                                if ($application->status === 'menunggu_dinas_pu') {
                                    $puStepStatus = 'active';
                                } elseif ($application->status === 'menunggu_satu_pintu' || $application->status === 'disetujui') {
                                    $puStepStatus = 'completed';
                                } elseif ($application->status === 'ditolak' && $application->bpn_notes && !$application->dinas_pu_notes) {
                                    $puStepStatus = ''; // BPN ditolak, PU ga jalan
                                } elseif ($application->status === 'ditolak' && $application->dinas_pu_notes) {
                                    $puStepStatus = 'rejected';
                                }
                            @endphp
                            <div class="timeline-step {{ $puStepStatus }}">
                                <span class="timeline-dot"></span>
                                <div class="timeline-title">Analisis Kesesuaian Tata Ruang (Dinas PU)</div>
                                <div class="timeline-desc">Analisis tata ruang berdasarkan Rencana Detail Tata Ruang (RDTR) Kabupaten/Kota untuk fungsi non-berusaha.</div>
                                @if($application->dinas_pu_notes)
                                    <div class="timeline-notes">
                                        <strong>Catatan Dinas PU (Tata Ruang):</strong><br>
                                        {{ $application->dinas_pu_notes }}
                                    </div>
                                @endif
                            </div>

                            <!-- STEP 4: Satu Pintu -->
                            @php
                                $spStepStatus = '';
                                if ($application->status === 'menunggu_satu_pintu') {
                                    $spStepStatus = 'active';
                                } elseif ($application->status === 'disetujui') {
                                    $spStepStatus = 'completed';
                                } elseif ($application->status === 'ditolak' && $application->satu_pintu_notes) {
                                    $spStepStatus = 'rejected';
                                }
                            @endphp
                            <div class="timeline-step {{ $spStepStatus }}">
                                <span class="timeline-dot"></span>
                                <div class="timeline-title">Penerbitan Surat Keputusan PPKPR (Satu Pintu)</div>
                                <div class="timeline-desc">Verifikasi akhir, pencetakan dokumen legalitas PPKPR Non Berusaha, dan tanda tangan elektronik.</div>
                                @if($application->satu_pintu_notes)
                                    <div class="timeline-notes">
                                        <strong>Catatan Dinas Satu Pintu (PTSP):</strong><br>
                                        {{ $application->satu_pintu_notes }}
                                    </div>
                                @endif
                            </div>

                            <!-- STEP 5: Selesai -->
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
                                        Dokumen PPKPR Selesai & Terbit
                                    @endif
                                </div>
                                <div class="timeline-desc">
                                    @if($application->status === 'ditolak')
                                        Permohonan tidak lolos verifikasi administrasi/tata ruang dan telah ditutup.
                                    @elseif($application->status === 'disetujui')
                                        Sertifikat/Surat Kesesuaian Tata Ruang resmi telah ditandatangani dan siap diunduh.
                                    @else
                                        Menunggu selesainya seluruh proses verifikasi instansi.
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
