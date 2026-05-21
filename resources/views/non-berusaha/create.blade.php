<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pengajuan PPKPR Non Berusaha — PATENPAKMIKO</title>
    
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
            max-width: 800px;
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

        .card {
            background: var(--clr-white);
            border: 1px solid var(--clr-line);
            border-radius: var(--radius-lg);
            padding: 32px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.01);
            margin-bottom: 32px;
        }

        .card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
            padding-bottom: 16px;
            border-bottom: 1px solid var(--clr-line);
        }

        .card-title {
            font-size: 18px;
            font-weight: 800;
            color: var(--clr-ink);
        }

        .back-link {
            font-size: 13.5px;
            font-weight: 600;
            color: var(--clr-muted);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .back-link:hover {
            color: var(--clr-blue);
        }

        /* ─── FORM DESIGN ────────────────────────────────────── */
        .form-section-title {
            font-size: 14px;
            font-weight: 800;
            color: var(--clr-blue);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin: 28px 0 16px;
            padding-bottom: 8px;
            border-bottom: 1.5px solid var(--clr-blue-lt);
        }
        .form-section-title:first-of-type {
            margin-top: 0;
        }

        .form-grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }
        @media (max-width: 480px) {
            .form-grid-2 { grid-template-columns: 1fr; }
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-size: 12.5px;
            font-weight: 700;
            color: var(--clr-ink);
            margin-bottom: 8px;
        }

        .form-label span.req {
            color: #E53E3E;
        }

        .form-control {
            width: 100%;
            padding: 12px 16px;
            font-family: inherit;
            font-size: 14px;
            font-weight: 500;
            color: var(--clr-ink);
            background: var(--clr-white);
            border: 1.5px solid var(--clr-line);
            border-radius: var(--radius-md);
            transition: all 0.2s;
            outline: none;
        }
        .form-control:focus {
            border-color: var(--clr-blue);
            box-shadow: 0 0 0 3px var(--clr-blue-lt);
        }

        .file-input-wrapper {
            display: flex;
            flex-direction: column;
            gap: 6px;
            background: var(--clr-surface);
            border: 1px dashed var(--clr-line);
            border-radius: var(--radius-md);
            padding: 12px 16px;
        }
        .file-input-wrapper input {
            font-size: 13px;
        }
        .file-help {
            font-size: 11px;
            color: var(--clr-muted);
        }

        .error-message {
            font-size: 12px;
            color: #E53E3E;
            margin-top: 6px;
            display: block;
        }

        .form-footer {
            margin-top: 32px;
            padding-top: 24px;
            border-top: 1px solid var(--clr-line);
            display: flex;
            justify-content: flex-end;
            gap: 16px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px 24px;
            font-family: inherit;
            font-weight: 600;
            font-size: 14px;
            border-radius: var(--radius-md);
            cursor: pointer;
            border: none;
            transition: all 0.2s;
            text-decoration: none;
        }

        .btn-cancel {
            background: var(--clr-white);
            color: var(--clr-mid);
            border: 1px solid var(--clr-line);
        }
        .btn-cancel:hover {
            background: var(--clr-surface);
        }

        .btn-primary {
            background: var(--clr-blue);
            color: var(--clr-white);
        }
        .btn-primary:hover {
            background: var(--clr-blue-dk);
            box-shadow: 0 4px 12px rgba(19, 147, 204, 0.2);
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

            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Permohonan PPKPR Non Berusaha Baru</h2>
                    <a href="{{ route('non-berusaha.index') }}" class="back-link">
                        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        Kembali
                    </a>
                </div>

                <form action="{{ route('non-berusaha.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- SECTION 1: DATA IDENTITAS PENGAJUAN -->
                    <div class="form-section-title">1. Identitas Pengajuan</div>

                    <!-- Nama Pemilik Usaha -->
                    <div class="form-group">
                        <label for="nama_pemilik_usaha" class="form-label">Nama Pemilik Usaha <span class="req">*</span></label>
                        <input type="text" id="nama_pemilik_usaha" name="nama_pemilik_usaha" class="form-control" placeholder="Masukkan nama pemilik usaha" value="{{ old('nama_pemilik_usaha') }}" required>
                        @error('nama_pemilik_usaha')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-grid-2">
                        <!-- Nama Pengaju -->
                        <div class="form-group">
                            <label for="nama_pengaju" class="form-label">Nama Pengaju / Pemohon <span class="req">*</span></label>
                            <input type="text" id="nama_pengaju" name="nama_pengaju" class="form-control" placeholder="Masukkan nama pengaju" value="{{ old('nama_pengaju', Auth::user()->name ?? Auth::user()->username) }}" required>
                            @error('nama_pengaju')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Hubungan Pengaju / Sebagai Apa -->
                        <div class="form-group">
                            <label for="hubungan_pengaju" class="form-label">Hubungan Pengaju (Sebagai Apa) <span class="req">*</span></label>
                            <input type="text" id="hubungan_pengaju" name="hubungan_pengaju" class="form-control" placeholder="cth: Pemilik Usaha, Penerima Kuasa, Karyawan, dll" value="{{ old('hubungan_pengaju') }}" required>
                            @error('hubungan_pengaju')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- SECTION 2: UNGGAH PERSYARATAN -->
                    <div class="form-section-title">2. Unggah Berkas Persyaratan</div>

                    <!-- File Dokumen Persyaratan -->
                    <div class="form-group">
                        <label for="doc_persyaratan" class="form-label">
                            Dokumen Persyaratan Lengkap <span class="req">*</span>
                            <a href="{{ route('templates.persyaratan') }}" target="_blank" style="margin-left: 8px; color: var(--clr-blue); text-decoration: none; font-size: 11px; font-weight: 700;">📥 Unduh Template Persyaratan</a>
                        </label>
                        <div class="file-input-wrapper">
                            <input type="file" id="doc_persyaratan" name="doc_persyaratan" accept=".pdf,.jpg,.jpeg,.png,.zip,.rar,.doc,.docx" required>
                            <span class="file-help">Format: PDF, JPG, PNG, DOC/DOCX, ZIP/RAR. Maksimal 10MB.</span>
                        </div>
                        @error('doc_persyaratan')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Footer Action Buttons -->
                    <div class="form-footer">
                        <a href="{{ route('non-berusaha.index') }}" class="btn btn-cancel">Batal</a>
                        <button type="submit" class="btn btn-primary">Kirim Permohonan</button>
                    </div>

                </form>
            </div>

        </div>
    </main>

</body>
</html>
