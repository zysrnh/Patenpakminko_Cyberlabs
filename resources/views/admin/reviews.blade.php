<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moderasi Ulasan Layanan — PATENPAKMIKO</title>
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
            --clr-stars: #D69E2E;
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
 
        .stars-yellow {
            color: var(--clr-stars);
            font-size: 15px;
            letter-spacing: 1px;
            font-weight: 700;
        }
 
        /* Action Buttons */
        .actions-wrap {
            display: flex;
            gap: 8px;
        }
 
        .btn-action {
            border: none;
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 11px;
            font-weight: 700;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            transition: all 0.2s;
            text-decoration: none;
        }
 
        .btn-action.approve {
            background-color: var(--clr-green-light);
            color: #22543D;
            border: 1px solid #9AE6B4;
        }
 
        .btn-action.approve:hover {
            background-color: var(--clr-green);
            color: #FFFFFF;
        }
 
        .btn-action.delete {
            background-color: var(--clr-red-light);
            color: #9B2C2C;
            border: 1px solid #FEB2B2;
        }
 
        .btn-action.delete:hover {
            background-color: var(--clr-red);
            color: #FFFFFF;
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
                        <strong>PATENPAKMIKO</strong>
                        <span>Portal Pelaku Usaha</span>
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
                <h1 class="page-title">⭐ Moderasi Ulasan Layanan (Admin)</h1>
                <p class="page-subtitle">Tinjau, setujui, dan publikasikan ulasan & testimoni yang diajukan pelaku usaha.</p>
            </div>
 
            <!-- Success Message -->
            @if(session('success'))
                <div class="alert-success">
                    <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif
 
            <!-- Table Card -->
            <div class="card">
                <h3 class="card-title">📋 Daftar Pengajuan Ulasan</h3>
 
                <div class="table-responsive">
                    @if($reviews->isEmpty())
                        <div class="empty-state">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499c-.191-.166-.446-.235-.69-.188a.75.75 0 00-.547.547c-.047.244.022.499.188.69l3.413 3.924a.75.75 0 11-1.127.99l-3.413-3.924a2.25 2.25 0 011.64-3.64 2.25 2.25 0 011.64.566l.7.608.7-.608A2.25 2.25 0 0118 2.25a2.25 2.25 0 011.64 3.64l-3.413 3.924a.75.75 0 11-1.127-.99l3.413-3.924c.166-.191.235-.446.188-.69a.75.75 0 00-.547-.547.75.75 0 00-.69.188l-.7.608-.7-.608z"/>
                            </svg>
                            <p>Belum ada ulasan yang diajukan oleh pelaku usaha.</p>
                        </div>
                    @else
                        <table class="table-modern">
                            <thead>
                                <tr>
                                    <th>Pelaku Usaha</th>
                                    <th>Layanan / Modul</th>
                                    <th>Penilaian</th>
                                    <th>Catatan Ulasan</th>
                                    <th>Status Publikasi</th>
                                    <th>Aksi Admin</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reviews as $review)
                                    <tr>
                                        <td>
                                            <strong>{{ $review->user->name ?? $review->user->username }}</strong>
                                            <div style="font-size: 11px; color: var(--clr-muted);">Tgl: {{ $review->created_at->format('d M Y, H:i') }}</div>
                                        </td>
                                        <td>
                                            <span style="font-weight: 700; color: var(--clr-primary-light);">{{ $review->module_label }}</span>
                                            <div style="font-size: 11px; color: var(--clr-muted);">ID Permohonan: #{{ $review->module_id }}</div>
                                        </td>
                                        <td>
                                            <div class="stars-yellow">{{ $review->stars_display }}</div>
                                            <div style="font-size: 11px; font-weight: 700; color: var(--clr-primary);">{{ $review->rating_label }}</div>
                                        </td>
                                        <td style="max-width: 250px; font-style: italic; color: #4A5568;">
                                            "{{ $review->comment }}"
                                        </td>
                                        <td>
                                            @if($review->is_approved)
                                                <span class="badge-status" style="background-color: var(--clr-green);">Tampil (Approved)</span>
                                            @else
                                                <span class="badge-status" style="background-color: var(--clr-muted);">Menunggu Review</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="actions-wrap">
                                                @if(!$review->is_approved)
                                                    <form action="{{ route('admin.reviews.approve', $review->id) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn-action approve">
                                                            ✓ Setujui
                                                        </button>
                                                    </form>
                                                @endif
                                                <form action="{{ route('admin.reviews.destroy', $review->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus ulasan ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn-action delete">
                                                        ✗ Hapus
                                                    </button>
                                                </form>
                                            </div>
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
