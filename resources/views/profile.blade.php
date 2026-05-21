<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya — PATENPAKMIKO</title>
    
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
            max-width: 680px;
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

        /* ─── MAIN CONTENT ───────────────────────────────────── */
        main {
            padding: 40px 0;
        }

        .card {
            background: var(--clr-white);
            border: 1px solid var(--clr-line);
            border-radius: var(--radius-lg);
            padding: 32px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.02);
            margin-bottom: 24px;
        }

        .card-header {
            margin-bottom: 24px;
            padding-bottom: 16px;
            border-bottom: 1px solid var(--clr-line);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .card-title {
            font-size: 18px;
            font-weight: 800;
            color: var(--clr-ink);
        }

        .back-btn {
            font-size: 13.5px;
            font-weight: 600;
            color: var(--clr-muted);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: color 0.2s;
        }
        .back-btn:hover {
            color: var(--clr-blue);
        }

        .alert-success {
            background: #E6F4EA;
            border: 1px solid #B8E2C8;
            color: #137333;
            padding: 12px 16px;
            border-radius: var(--radius-md);
            font-size: 13.5px;
            font-weight: 600;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* ─── FORM ELEMENTS ──────────────────────────────────── */
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            margin-bottom: 20px;
        }
        @media (max-width: 480px) {
            .form-grid { grid-template-columns: 1fr; }
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-size: 12px;
            font-weight: 700;
            color: var(--clr-ink);
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.03em;
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

        .form-control-static {
            background: var(--clr-surface);
            color: var(--clr-mid);
            cursor: not-allowed;
            border-color: var(--clr-line);
        }

        .btn-submit {
            background: var(--clr-blue);
            color: var(--clr-white);
            border: none;
            padding: 12px 24px;
            border-radius: var(--radius-md);
            font-family: inherit;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        .btn-submit:hover {
            background: var(--clr-blue-dk);
            box-shadow: 0 4px 12px rgba(19, 147, 204, 0.2);
            transform: translateY(-0.5px);
        }

        .error-message {
            font-size: 12px;
            color: #E53E3E;
            margin-top: 6px;
            display: block;
        }

        .form-footer {
            margin-top: 24px;
            padding-top: 20px;
            border-top: 1px solid var(--clr-line);
            display: flex;
            justify-content: flex-end;
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
        
        /* Avatar Uploader */
        .avatar-upload-container {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 24px;
            padding: 16px;
            background: var(--clr-surface);
            border: 1px solid var(--clr-line);
            border-radius: var(--radius-md);
        }
        .avatar-preview-lg {
            width: 72px;
            height: 72px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--clr-blue);
        }
        .avatar-placeholder-lg {
            width: 72px;
            height: 72px;
            border-radius: 50%;
            background: var(--clr-blue-lt);
            color: var(--clr-blue);
            font-weight: 800;
            font-size: 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid var(--clr-blue);
            text-transform: uppercase;
        }
        .avatar-upload-info {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }
        .avatar-upload-help {
            font-size: 11.5px;
            color: var(--clr-muted);
            margin-top: 2px;
        }

        .badge-optional {
            font-size: 10px;
            font-weight: 700;
            color: var(--clr-muted);
            background: var(--clr-surface);
            padding: 2px 6px;
            border-radius: 4px;
            float: right;
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
                    <a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a>
                    <a href="{{ route('profile') }}" class="nav-link active">Profil Saya</a>
                    
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

            @php
                $user = Auth::user();
            @endphp

            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Lengkapi Data Profil</h2>
                    <a href="{{ route('dashboard') }}" class="back-btn">
                        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        Kembali
                    </a>
                </div>

                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Unggah Foto Profil -->
                    <div class="avatar-upload-container">
                        @if($user->profile_photo)
                            <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="Foto Profil" class="avatar-preview-lg">
                        @else
                            <div class="avatar-placeholder-lg">
                                {{ strtoupper(substr($user->username, 0, 2)) }}
                            </div>
                        @endif
                        <div class="avatar-upload-info">
                            <label for="profile_photo" class="form-label" style="margin-bottom: 2px;">Unggah Foto Profil</label>
                            <input type="file" id="profile_photo" name="profile_photo" class="avatar-upload-input" accept="image/*">
                            <span class="avatar-upload-help">Format: JPG, JPEG, PNG, GIF, SVG. Maksimal 2MB.</span>
                            @error('profile_photo')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Akun Utama (Read-only) -->
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Username (Permanen)</label>
                            <input type="text" class="form-control form-control-static" value="{{ $user->username }}" readonly tabindex="-1">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Nomor WA (Permanen)</label>
                            <input type="text" class="form-control form-control-static" value="{{ $user->phone_number }}" readonly tabindex="-1">
                        </div>
                    </div>

                    <!-- Nama Lengkap -->
                    <div class="form-group">
                        <label for="name" class="form-label">
                            Nama Lengkap
                            <span class="badge-optional">Opsional</span>
                        </label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="cth: Budi Hartono" value="{{ old('name', $user->name) }}">
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <label for="email" class="form-label">
                            Email
                            <span class="badge-optional">Opsional</span>
                        </label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="cth: budi@gmail.com" value="{{ old('email', $user->email) }}">
                        @error('email')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Alamat Lengkap -->
                    <div class="form-group">
                        <label for="address" class="form-label">
                            Alamat Tempat Tinggal / Kantor
                            <span class="badge-optional">Opsional</span>
                        </label>
                        <textarea id="address" name="address" class="form-control" rows="3" placeholder="Masukkan alamat lengkap" style="resize: none;">{{ old('address', $user->address) }}</textarea>
                    </div>

                    <!-- Data Usaha -->
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="business_name" class="form-label">
                                Nama Perusahaan / Usaha
                                <span class="badge-optional">Opsional</span>
                            </label>
                            <input type="text" id="business_name" name="business_name" class="form-control" placeholder="cth: CV. Jaya Selalu" value="{{ old('business_name', $user->business_name) }}">
                        </div>
                        <div class="form-group">
                            <label for="business_role" class="form-label">
                                Jabatan di Usaha
                                <span class="badge-optional">Opsional</span>
                            </label>
                            <input type="text" id="business_role" name="business_role" class="form-control" placeholder="cth: Direktur / Owner" value="{{ old('business_role', $user->business_role) }}">
                        </div>
                    </div>

                    <div class="form-footer">
                        <button type="submit" class="btn-submit">
                            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/></svg>
                            Simpan Perubahan
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </main>

</body>
</html>
