<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin LAPOLPA — PATEN PAK MIKO</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --clr-primary: #1A365D;
            --clr-primary-light: #2B6CB0;
            --clr-accent: #3182CE;
            --clr-bg: #F7FAFC;
            --clr-card-bg: #FFFFFF;
            --clr-text: #2D3748;
            --clr-muted: #718096;
            --clr-line: #E2E8F0;
            --clr-green: #38A169;
            --clr-green-light: #C6F6D5;
            --clr-red: #E53E3E;
            --clr-red-light: #FED7D7;
        }
 
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
 
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--clr-bg);
            color: var(--clr-text);
            line-height: 1.6;
            padding-bottom: 60px;
        }
 
        /* Header */
        header {
            background-color: var(--clr-primary);
            color: #FFFFFF;
            padding: 16px 0;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            position: sticky;
            top: 0;
            z-index: 100;
        }
 
        .container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 0 20px;
        }
 
        .header-inner {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
 
        .logo-wrap {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: #FFFFFF;
        }
 
        .logo-icon {
            width: 38px;
            height: 38px;
            background: var(--clr-blue);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 8px rgba(49, 130, 206, 0.3);
        }
 
        .logo-icon svg {
            width: 20px;
            height: 20px;
            fill: none;
            stroke: #FFFFFF;
            stroke-width: 2.5;
        }
 
        .logo-text strong {
            display: block;
            font-size: 15px;
            font-weight: 800;
            letter-spacing: 0.5px;
        }
 
        .logo-text span {
            display: block;
            font-size: 11px;
            color: #A0AEC0;
        }
 
        .nav-menu {
            display: flex;
            align-items: center;
            gap: 20px;
        }
 
        .nav-link {
            color: #E2E8F0;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            transition: color 0.2s;
        }
 
        .nav-link:hover, .nav-link.active {
            color: #FFFFFF;
        }
 
        .btn-logout {
            background-color: rgba(229, 62, 62, 0.2);
            color: #FEB2B2;
            border: 1px solid rgba(229, 62, 62, 0.3);
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: all 0.2s;
        }
 
        .btn-logout:hover {
            background-color: var(--clr-red);
            color: #FFFFFF;
        }
 
        /* Main Layout */
        main {
            margin-top: 32px;
        }
 
        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--clr-accent);
            text-decoration: none;
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 20px;
            transition: transform 0.2s;
        }
 
        .back-link:hover {
            transform: translateX(-4px);
        }
 
        .page-title-section {
            margin-bottom: 24px;
        }
 
        .page-title {
            font-size: 24px;
            font-weight: 800;
            color: var(--clr-primary);
        }
 
        .page-subtitle {
            font-size: 14px;
            color: var(--clr-muted);
            margin-top: 4px;
        }
 
        .alert-success {
            background-color: var(--clr-green-light);
            color: #22543D;
            border: 1px solid #9AE6B4;
            padding: 16px;
            border-radius: 12px;
            margin-bottom: 24px;
            font-size: 13px;
            font-weight: 600;
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }
 
        /* Pemberitahuan Baru (Alert Booking Active) */
        .notification-banner {
            background-color: #EBF8FF;
            color: #2B6CB0;
            border: 1.5px solid #BEE3F8;
            padding: 18px;
            border-radius: 14px;
            margin-bottom: 28px;
            font-size: 13.5px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 4px 10px rgba(43, 108, 176, 0.05);
        }
 
        .notification-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }
 
        .notification-info svg {
            color: var(--clr-accent);
            flex-shrink: 0;
        }
 
        /* Cards & Table */
        .card {
            background-color: var(--clr-card-bg);
            border: 1.5px solid var(--clr-line);
            border-radius: 16px;
            padding: 28px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.02);
        }
 
        .card-title {
            font-size: 18px;
            font-weight: 800;
            color: var(--clr-primary);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            border-bottom: 1.5px solid var(--clr-line);
            padding-bottom: 12px;
        }
 
        .table-responsive {
            overflow-x: auto;
        }
 
        .table-modern {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            font-size: 13.5px;
        }
 
        .table-modern th {
            background-color: #F7FAFC;
            color: var(--clr-primary);
            font-weight: 800;
            padding: 14px 16px;
            border-bottom: 2px solid var(--clr-line);
        }
 
        .table-modern td {
            padding: 14px 16px;
            border-bottom: 1px solid var(--clr-line);
            vertical-align: middle;
        }
 
        .table-modern tr:hover {
            background-color: #FAFCFF;
        }
 
        .badge-status {
            padding: 4px 12px;
            border-radius: 100px;
            font-size: 11px;
            font-weight: 700;
            color: #FFFFFF;
            display: inline-block;
        }
 
        /* Action Forms */
        .status-select {
            padding: 6px 10px;
            border-radius: 8px;
            border: 1.5px solid var(--clr-line);
            font-size: 12px;
            font-weight: 600;
            color: var(--clr-text);
            outline: none;
            background-color: #FFFFFF;
            cursor: pointer;
            transition: all 0.2s;
        }
 
        .status-select:focus {
            border-color: var(--clr-accent);
        }
 
        .btn-update {
            background-color: var(--clr-accent);
            color: #FFFFFF;
            border: none;
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 11px;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.2s;
        }
 
        .btn-update:hover {
            background-color: var(--clr-primary-light);
        }
 
        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: var(--clr-muted);
        }
 
        .empty-state svg {
            width: 48px;
            height: 48px;
            margin-bottom: 12px;
            color: var(--clr-line);
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
                    <a href="{{ route('dashboard') }}" class="nav-link active">Dashboard</a>
                    <form action="{{ route('logout') }}" method="POST" style="margin-left: 8px;">
                        @csrf
                        <button type="submit" class="btn-logout">
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
            
            <a href="{{ route('dashboard') }}" class="back-link">
                <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Kembali ke Dashboard
            </a>
 
            <div class="page-title-section">
                <h1 class="page-title">?? Pengelolaan Booking LAPOLPA (Admin)</h1>
                <p class="page-subtitle">Kelola dan update status pendaftaran pelaporan pelaku usaha secara real-time.</p>
            </div>
 
            <!-- Success Message -->
            @if(session('success'))
                <div class="alert-success">
                    <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif
 
            <!-- Pemberitahuan Baru (Jika ada booking terjadwal) -->
            @php
                $bookedCount = $bookings->where('status', 'booked')->count();
            @endphp
 
            @if($bookedCount > 0)
                <div class="notification-banner">
                    <div class="notification-info">
                        <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                        <strong>Terdapat {{ $bookedCount }} Jadwal LAPOLPA Aktif (Booked) yang memerlukan tindak lanjut hari ini.</strong>
                    </div>
                </div>
            @endif
 
            <!-- Table Card -->
            <div class="card">
                <h3 class="card-title">Daftar Pendaftar LAPOLPAK</h3>
 
                <div class="table-responsive">
                    @if($bookings->isEmpty())
                        <div class="empty-state">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/>
                            </svg>
                            <p>Belum ada pendaftaran booking jadwal LAPOLPA dari pelaku usaha.</p>
                        </div>
                    @else
                        <table class="table-modern">
                            <thead>
                                <tr>
                                    <th>Pelaku Usaha (Pemohon)</th>
                                    <th>Nomor WhatsApp</th>
                                    <th>Tanggal Booking</th>
                                    <th>Rentang Waktu</th>
                                    <th>Status</th>
                                    <th style="width: 220px;">Aksi Admin</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bookings as $booking)
                                    <tr>
                                        <td>
                                            <strong>{{ $booking->nama_pemohon ?? ($booking->user ? ($booking->user->name ?? $booking->user->username) : 'Tamu') }}</strong>
                                            <div style="font-size: 11px; color: var(--clr-muted);">{{ $booking->user ? 'Username: ' . $booking->user->username : 'Pendaftar Publik (Tanpa Akun)' }}</div>
                                        </td>
                                        <td>
                                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $booking->whatsapp_number) }}" target="_blank" style="color: var(--clr-accent); text-decoration: none; font-weight: 600;">
                                                {{ $booking->whatsapp_number }} ?
                                            </a>
                                        </td>
                                        <td>{{ $booking->formatted_date }}</td>
                                        <td style="color: var(--clr-accent); font-weight: 700;">{{ $booking->formatted_time_range }}</td>
                                        <td>
                                            <span class="badge-status" style="background-color: {{ $booking->status_color }};">
                                                {{ $booking->status_label }}
                                            </span>
                                        </td>
                                        <td>
                                            <form action="{{ route('lapolpa.update', $booking->id) }}" method="POST" style="display: flex; flex-direction: column; gap: 8px;">
                                                @csrf
                                                @method('PUT')
                                                <div style="display: flex; gap: 8px; align-items: center;">
                                                    <select name="status" class="status-select">
                                                        <option value="booked" {{ $booking->status === 'booked' ? 'selected' : '' }}>Booked</option>
                                                        <option value="diterima" {{ $booking->status === 'diterima' ? 'selected' : '' }}>Diterima</option>
                                                        <option value="selesai" {{ $booking->status === 'selesai' ? 'selected' : '' }}>Selesai</option>
                                                        <option value="dibatalkan" {{ $booking->status === 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                                                    </select>
                                                    <button type="submit" class="btn-update">Update</button>
                                                </div>
                                                <input type="text" name="admin_note" placeholder="Catatan untuk pemohon (Opsional)" value="{{ $booking->admin_note }}" style="width: 100%; padding: 6px 10px; border: 1px solid var(--clr-line); border-radius: 4px; font-size: 11px;">
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
 
        </div>
    </main>
 
</body>
</html>
