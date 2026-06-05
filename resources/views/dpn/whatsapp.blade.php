<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Integrasi WhatsApp Gateway — PATEN PAK MIKO</title>
    
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
            max-width: 1000px;
            margin: 0 auto;
            padding: 0 24px;
        }

        /* --- HEADER ------------------------------------------- */
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

        /* --- MAIN CONTENT ------------------------------------- */
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
            margin-bottom: 28px;
        }
        .page-title {
            font-size: 22px;
            font-weight: 800;
            color: var(--clr-ink);
        }

        .grid-layout {
            display: grid;
            grid-template-columns: 1.1fr 1fr;
            gap: 28px;
            align-items: start;
        }
        @media (max-width: 900px) {
            .grid-layout { grid-template-columns: 1fr; }
        }

        .card {
            background: var(--clr-white);
            border: 1px solid var(--clr-line);
            border-radius: var(--radius-lg);
            padding: 24px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.01);
            margin-bottom: 28px;
        }

        .card-title {
            font-size: 14.5px;
            font-weight: 800;
            color: var(--clr-ink);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1.5px solid var(--clr-line);
        }

        /* --- WA GATEWAY QR SECTION --------------------------- */
        .gateway-status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            font-weight: 800;
            padding: 4px 12px;
            border-radius: 20px;
            text-transform: uppercase;
            letter-spacing: 0.02em;
            margin-bottom: 20px;
        }
        .gateway-status-badge.connected {
            background: var(--clr-green-lt);
            color: var(--clr-green-dk);
        }
        .gateway-status-badge.disconnected {
            background: #FFF5F5;
            color: #E53E3E;
        }

        .qr-area {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            background: var(--clr-surface);
            border: 1px solid var(--clr-line);
            border-radius: var(--radius-lg);
            text-align: center;
        }

        .qr-mock {
            width: 180px;
            height: 180px;
            background: white;
            padding: 10px;
            border: 1px solid var(--clr-line);
            border-radius: var(--radius-md);
            box-shadow: 0 4px 10px rgba(0,0,0,0.02);
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .qr-mock svg {
            width: 100%;
            height: 100%;
        }

        .btn-toggle {
            font-family: inherit;
            font-weight: 700;
            font-size: 13.5px;
            padding: 10px 20px;
            border-radius: var(--radius-md);
            cursor: pointer;
            border: none;
            transition: all 0.2s;
            width: 100%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        .btn-toggle.connect {
            background: var(--clr-blue);
            color: white;
        }
        .btn-toggle.connect:hover {
            background: var(--clr-blue-dk);
        }
        .btn-toggle.disconnect {
            background: #E53E3E;
            color: white;
        }
        .btn-toggle.disconnect:hover {
            background: #C53030;
        }

        .device-info-table {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }
        .device-info-table td {
            padding: 10px 0;
            border-bottom: 1px solid var(--clr-line);
            font-size: 13.5px;
        }
        .device-info-table td.label {
            color: var(--clr-muted);
            font-weight: 600;
            width: 45%;
        }
        .device-info-table td.val {
            color: var(--clr-ink);
            font-weight: 700;
            text-align: right;
        }

        /* --- TEMPLATE CONFIGURATION -------------------------- */
        .form-label {
            display: block;
            font-size: 12px;
            font-weight: 700;
            color: var(--clr-ink);
            margin-bottom: 8px;
            text-transform: uppercase;
        }
        .form-control {
            width: 100%;
            padding: 12px 16px;
            font-family: inherit;
            font-size: 13.5px;
            line-height: 1.5;
            color: var(--clr-ink);
            background: var(--clr-white);
            border: 1.5px solid var(--clr-line);
            border-radius: var(--radius-md);
            outline: none;
            resize: none;
            transition: border-color 0.2s;
        }
        .form-control:focus {
            border-color: var(--clr-blue);
        }

        .placeholder-table {
            width: 100%;
            margin-top: 14px;
            font-size: 11.5px;
            border-collapse: collapse;
        }
        .placeholder-table th {
            text-align: left;
            padding: 6px 8px;
            background: var(--clr-surface);
            color: var(--clr-mid);
            font-weight: 700;
        }
        .placeholder-table td {
            padding: 8px;
            border-bottom: 1px solid var(--clr-line);
        }
        .placeholder-tag {
            font-family: 'DM Mono', monospace;
            background: var(--clr-blue-lt);
            color: var(--clr-blue-dk);
            font-weight: 700;
            padding: 2px 6px;
            border-radius: 4px;
        }

        .btn-submit {
            background: var(--clr-ink);
            color: white;
            border: none;
            padding: 10px 20px;
            font-family: inherit;
            font-weight: 700;
            font-size: 13px;
            border-radius: var(--radius-md);
            cursor: pointer;
            transition: background 0.2s;
            margin-top: 16px;
        }
        .btn-submit:hover {
            background: #172436;
        }

        /* --- LOGS LIST ---------------------------------------- */
        .logs-container {
            display: flex;
            flex-direction: column;
            gap: 12px;
            max-height: 350px;
            overflow-y: auto;
            padding-right: 6px;
        }
        .log-item {
            background: var(--clr-surface);
            border: 1px solid var(--clr-line);
            border-radius: var(--radius-md);
            padding: 14px;
        }
        .log-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 6px;
            font-size: 11.5px;
        }
        .log-recipient {
            font-weight: 700;
            color: var(--clr-blue-dk);
            font-family: 'DM Mono', monospace;
        }
        .log-time {
            color: var(--clr-muted);
        }
        .log-message {
            font-size: 12.5px;
            color: var(--clr-ink);
            line-height: 1.45;
            white-space: pre-wrap;
        }
    </style>
</head>
<body>

    <!-- Header -->
    <header>
        <div class="container">
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
                    <a href="{{ route('non-berusaha.index') }}" class="nav-link">PPKPR Non Berusaha</a>
                    @if(Auth::user()->isDpn())
                        <a href="{{ route('dpn.whatsapp') }}" class="nav-link active">Integrasi WhatsApp</a>
                    @endif
                    
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
                <h1 class="page-title">Pusat Integrasi WhatsApp Gateway</h1>
            </div>

            <div class="grid-layout">
                
                <!-- KIRI: Status Koneksi & QR Scan Simulasi -->
                <div>
                    <div class="card">
                        <h2 class="card-title">Konektivitas WhatsApp</h2>
                        
                        @if($settings['connected'])
                            <div class="gateway-status-badge connected">
                                <span style="width: 8px; height: 8px; border-radius: 50%; background: var(--clr-green); display: inline-block;"></span>
                                Terhubung (Aktif)
                            </div>
                            
                            <table class="device-info-table">
                                <tr>
                                    <td class="label">Nomor Pengirim</td>
                                    <td class="val">+{{ $settings['phone_number'] }}</td>
                                </tr>
                                <tr>
                                    <td class="label">Fonnte API Token</td>
                                    <td class="val mono" style="font-size: 11px; max-width: 150px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; text-align: right;">{{ $settings['fonnte_token'] ? substr($settings['fonnte_token'], 0, 10) . '...' : 'Dikosongkan (Simulasi)' }}</td>
                                </tr>
                                <tr>
                                    <td class="label">Sinyal Perangkat</td>
                                    <td class="val" style="color: var(--clr-green-dk);">Sangat Baik (Excellent)</td>
                                </tr>
                                <tr>
                                    <td class="label">Daya Baterai HP</td>
                                    <td class="val">92% (Mengisi Daya)</td>
                                </tr>
                                <tr>
                                    <td class="label">Tipe Sesi</td>
                                    <td class="val">WhatsApp Multi-Device Web</td>
                                </tr>
                            </table>

                            <form action="{{ route('dpn.whatsapp.toggle') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn-toggle disconnect">
                                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
                                    Putuskan Sesi WhatsApp
                                </button>
                            </form>
                        @else
                            <div class="gateway-status-badge disconnected">
                                <span style="width: 8px; height: 8px; border-radius: 50%; background: #E53E3E; display: inline-block;"></span>
                                Terputus
                            </div>

                            <p style="font-size: 13px; color: var(--clr-mid); line-height: 1.5; margin-bottom: 20px;">
                                Silakan hubungkan nomor telepon dinas / portal agar notifikasi status PPKPR terkirim secara otomatis kepada pemohon via WhatsApp.
                            </p>

                            <form action="{{ route('dpn.whatsapp.toggle') }}" method="POST">
                                @csrf
                                <div class="form-group" style="text-align: left; margin-bottom: 16px;">
                                    <label for="phone_number" class="form-label">Nomor Telepon Gateway</label>
                                    <input type="text" id="phone_number" name="phone_number" class="form-control" placeholder="cth: 081234567894" value="{{ $settings['phone_number'] }}" required>
                                </div>

                                <div class="form-group" style="text-align: left; margin-bottom: 16px;">
                                    <label for="fonnte_token" class="form-label">Fonnte API Token (Opsional)</label>
                                    <input type="text" id="fonnte_token" name="fonnte_token" class="form-control" placeholder="Masukkan Token API Fonnte Anda" value="{{ $settings['fonnte_token'] ?? '' }}">
                                    <span style="font-size: 11px; color: var(--clr-muted); display: block; margin-top: 4px;">Kosongkan jika hanya ingin mencoba mode simulasi log tanpa kirim pesan asli.</span>
                                </div>

                                <div class="qr-area" style="margin-bottom: 20px;">
                                    <div class="qr-mock">
                                        <!-- Inline SVG QR Code Mock -->
                                        <svg viewBox="0 0 100 100" shape-rendering="crispEdges">
                                            <path fill="#ffffff" d="M0,0h100v100h-100z"/>
                                            <path fill="#003B64" d="M0,0h30v30h-30z M70,0h30v30h-30z M0,70h30v30h-30z M10,10h10v10h-10z M80,10h10v10h-10z M10,80h10v10h-10z M35,5h5v5h-5z M45,5h10v5h-10z M60,5h5v15h-5z M40,15h10v5h-10z M35,25h10v5h-10z M55,25h10v5h-10z M90,35h5v10h-5z M75,40h5v10h-5z M85,45h5v10h-5z M95,55h5v5h-5z M80,60h10v5h-10z M85,75h10v5h-10z M70,85h5v10h-5z M90,85h5v5h-5z M45,35h5v25h-5z M35,45h5v5h-5z M55,45h5v5h-5z M60,55h5v10h-5z M35,65h20v5h-20z M40,75h10v5h-10z M55,75h5v10h-5z M35,85h5v10h-5z M45,90h15v5h-15z M65,90h5v5h-5z M65,70h10v5h-10z M70,75h5v5h-5z M65,80h5v10h-5z"/>
                                        </svg>
                                    </div>
                                    <p style="font-size: 11px; color: var(--clr-muted); line-height: 1.4;">Scan QR Code di atas menggunakan WhatsApp di ponsel Anda melalui tautan <strong>Perangkat Tertaut</strong>.</p>
                                </div>

                                <button type="submit" class="btn-toggle connect">
                                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M23 12a11.05 11.05 0 00-22 0v1h11a2 2 0 012 2v2a2 2 0 01-2 2H1v1a11.05 11.05 0 0022 0z"/></svg>
                                    Simulasikan Hubungkan / Scan QR
                                </button>
                            </form>
                        @endif
                    </div>
                </div>

                <!-- KANAN: Pengaturan Template & Log Notifikasi -->
                <div>
                    <!-- Template Notifikasi -->
                    <div class="card">
                        <h2 class="card-title">Template Notifikasi Status</h2>
                        <form action="{{ route('dpn.whatsapp.save') }}" method="POST">
                            @csrf
                            <div class="form-group" style="margin-bottom: 16px;">
                                <label for="cp_admin" class="form-label">Contact Person Admin (Nomor WA)</label>
                                <input type="text" id="cp_admin" name="cp_admin" class="form-control" placeholder="cth: 08123456789 (Kosongkan jika tidak ingin disisipkan)" value="{{ $settings['cp_admin'] ?? '' }}">
                                <span style="font-size: 11px; color: var(--clr-muted); display: block; margin-top: 4px;">Nomor ini akan otomatis ditambahkan pada akhir setiap pesan WA pemohon.</span>
                            </div>

                            <div class="form-group">
                                <label for="template" class="form-label">Format Isi Pesan Notifikasi</label>
                                <textarea id="template" name="template" class="form-control" rows="6" required>{{ $settings['template'] }}</textarea>
                            </div>

                            <button type="submit" class="btn-submit">Simpan Template</button>
                        </form>

                        <h3 style="font-size: 12px; font-weight: 800; color: var(--clr-mid); margin: 20px 0 8px; text-transform: uppercase;">Variabel Dinamis (Placeholders)</h3>
                        <div style="overflow-x: auto;">
                            <table class="placeholder-table">
                                <thead>
                                    <tr>
                                        <th>Tag / Placeholder</th>
                                        <th>Keterangan Variabel</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><span class="placeholder-tag">{nama_pemohon}</span></td>
                                        <td>Nama lengkap pemilik permohonan.</td>
                                    </tr>
                                    <tr>
                                        <td><span class="placeholder-tag">{nomor_registrasi}</span></td>
                                        <td>Nomor registrasi unik PPKPR.</td>
                                    </tr>
                                    <tr>
                                        <td><span class="placeholder-tag">{status_sekarang}</span></td>
                                        <td>Tahap verifikasi aktif saat ini.</td>
                                    </tr>
                                    <tr>
                                        <td><span class="placeholder-tag">{catatan_terakhir}</span></td>
                                        <td>Uraian catatan/keterangan dari pemeriksa terakhir.</td>
                                    </tr>
                                    <tr>
                                        <td><span class="placeholder-tag">{tautan_detail}</span></td>
                                        <td>Link pelacakan permohonan langsung.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Log Notifikasi -->
                    <div class="card">
                        <h2 class="card-title">Log Pengiriman WhatsApp (Terkirim)</h2>
                        <div class="logs-container">
                            @if(empty($logs))
                                <div style="text-align: center; padding: 30px; color: var(--clr-muted); font-size: 13px;">
                                    Belum ada riwayat pengiriman notifikasi.
                                </div>
                            @else
                                @foreach($logs as $log)
                                    <div class="log-item">
                                        <div class="log-header" style="display: flex; align-items: center; justify-content: space-between; gap: 8px;">
                                            <span class="log-recipient" style="font-weight: 700; color: var(--clr-blue-dk); font-family: 'DM Mono', monospace;">Ke: +{{ $log['recipient'] }}</span>
                                            <span class="log-status" style="font-size: 10px; font-weight: 700; background: {{ strpos($log['status'] ?? '', 'Terkirim') !== false ? '#E6F4EA' : (strpos($log['status'] ?? '', 'Gagal') !== false ? '#FFF5F5' : '#EDEDED') }}; color: {{ strpos($log['status'] ?? '', 'Terkirim') !== false ? '#137333' : (strpos($log['status'] ?? '', 'Gagal') !== false ? '#E53E3E' : '#555') }}; padding: 2px 6px; border-radius: 4px; text-transform: uppercase;">{{ $log['status'] ?? 'Simulasi' }}</span>
                                            <span class="log-time" style="color: var(--clr-muted); font-size: 11px;">{{ $log['timestamp'] }}</span>
                                        </div>
                                        <div class="log-message" style="margin-top: 8px; font-size: 12.5px; line-height: 1.45; white-space: pre-wrap;">{{ $log['message'] }}</div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </main>

</body>
</html>
