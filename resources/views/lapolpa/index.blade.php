<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LAPOLPA (Layanan Pelaporan) — PATENPAKMIKO</title>
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
            max-width: 1000px;
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
            background: linear-gradient(135deg, var(--clr-accent), var(--clr-primary-light));
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
 
        .alert-error {
            background-color: var(--clr-red-light);
            color: #9B2C2C;
            border: 1px solid #FEB2B2;
            padding: 16px;
            border-radius: 12px;
            margin-bottom: 24px;
            font-size: 13px;
            font-weight: 600;
            display: flex;
            align-items: flex-start;
            gap: 12px;
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
 
        /* Cards */
        .card {
            background-color: var(--clr-card-bg);
            border: 1.5px solid var(--clr-line);
            border-radius: 16px;
            padding: 28px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.02);
            margin-bottom: 24px;
        }
 
        .card-title {
            font-size: 18px;
            font-weight: 800;
            color: var(--clr-primary);
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 10px;
            border-bottom: 1.5px solid var(--clr-line);
            padding-bottom: 12px;
        }
 
        /* Form Styling */
        .form-group {
            margin-bottom: 20px;
        }
 
        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 700;
            color: var(--clr-primary);
            margin-bottom: 6px;
        }
 
        .form-control {
            width: 100%;
            padding: 12px 16px;
            border: 1.5px solid var(--clr-line);
            border-radius: 10px;
            font-family: inherit;
            font-size: 14px;
            color: var(--clr-text);
            transition: all 0.2s;
            background-color: #FAFAFA;
        }
 
        .form-control:focus {
            outline: none;
            border-color: var(--clr-accent);
            background-color: #FFFFFF;
            box-shadow: 0 0 0 3px rgba(49, 130, 206, 0.15);
        }
 
        .form-grid-3 {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr;
            gap: 16px;
        }
 
        @media (max-width: 600px) {
            .form-grid-3 {
                grid-template-columns: 1fr;
            }
        }
 
        .btn-submit {
            background: linear-gradient(135deg, var(--clr-accent), var(--clr-primary-light));
            color: #FFFFFF;
            border: none;
            padding: 14px 28px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 4px 10px rgba(49, 130, 206, 0.25);
        }
 
        .btn-submit:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 14px rgba(49, 130, 206, 0.35);
        }
 
        /* Booking Detail Info */
        .info-grid {
            display: grid;
            grid-template-columns: 1.5fr 2fr;
            gap: 24px;
        }
 
        @media (max-width: 768px) {
            .info-grid {
                grid-template-columns: 1fr;
            }
        }
 
        .detail-list {
            list-style: none;
        }
 
        .detail-item {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid var(--clr-line);
            font-size: 13px;
        }
 
        .detail-item:last-child {
            border-bottom: none;
        }
 
        .detail-label {
            color: var(--clr-muted);
            font-weight: 600;
        }
 
        .detail-val {
            font-weight: 700;
            color: var(--clr-primary);
            text-align: right;
        }
 
        .badge-status {
            padding: 4px 12px;
            border-radius: 100px;
            font-size: 11px;
            font-weight: 700;
            color: #FFFFFF;
            display: inline-block;
        }
 
        /* Guide Box */
        .guide-box {
            background-color: #F0F4F8;
            border-left: 4px solid var(--clr-accent);
            border-radius: 10px;
            padding: 20px;
        }
 
        .guide-box h4 {
            color: var(--clr-primary);
            font-size: 14px;
            font-weight: 800;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
 
        .guide-list {
            margin-left: 18px;
            font-size: 13px;
            color: var(--clr-text);
        }
 
        .guide-list li {
            margin-bottom: 8px;
        }
 
        .guide-list li:last-child {
            margin-bottom: 0;
        }
 
        .status-container {
            border: 1.5px solid var(--clr-line);
            background-color: var(--clr-card-bg);
            border-radius: 16px;
            padding: 28px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.02);
            text-align: center;
            margin-bottom: 24px;
        }
 
        .status-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background-color: var(--clr-green-light);
            color: var(--clr-green);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            margin-bottom: 16px;
        }
 
        .status-icon.booked {
            background-color: #EBF8FF;
            color: var(--clr-accent);
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
                <h1 class="page-title">📱 LAPOLPA (Layanan Pelaporan)</h1>
                <p class="page-subtitle">Pemesanan jadwal konsultasi & pelaporan pemanfaatan ruang pelaku usaha secara teratur.</p>
            </div>
 
            <!-- Success/Error Message -->
            @if(session('success'))
                <div class="alert-success">
                    <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif
 
            @if($errors->any())
                <div class="alert-error">
                    <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    <div>
                        @foreach($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                </div>
            @endif
 
            @if($booking)
                <!-- ========================================== -->
                <!-- JIKA PEMOHON SUDAH BOOKING (ANTI-SPAM) -->
                <!-- ========================================== -->
                <div class="status-container">
                    <div class="status-icon booked">✓</div>
                    <h2 style="font-size: 20px; font-weight: 800; color: var(--clr-primary);">Jadwal Pelaporan LAPOLPA Telah Dipesan</h2>
                    <p style="font-size: 13px; color: var(--clr-muted); margin-top: 4px;">Anda telah menjadwalkan pelaporan. Pendaftaran dibatasi satu kali saja untuk menghindari spam data.</p>
                </div>
 
                <div class="info-grid" style="margin-bottom: 24px;">
                    <!-- Left: Booking details -->
                    <div class="card" style="margin-bottom: 0;">
                        <h3 class="card-title">🗓️ Detail Jadwal Booking</h3>
                        <ul class="detail-list">
                            <li class="detail-item">
                                <span class="detail-label">Status</span>
                                <span class="detail-val">
                                    <span class="badge-status" style="background-color: {{ $booking->status_color }};">
                                        {{ $booking->status_label }}
                                    </span>
                                </span>
                            </li>
                            <li class="detail-item">
                                <span class="detail-label">Nama Pemohon</span>
                                <span class="detail-val">{{ $booking->user->name ?? $booking->user->username }}</span>
                            </li>
                            <li class="detail-item">
                                <span class="detail-label">Nomor WhatsApp</span>
                                <span class="detail-val">{{ $booking->whatsapp_number }}</span>
                            </li>
                            <li class="detail-item">
                                <span class="detail-label">Tanggal Pelaporan</span>
                                <span class="detail-val">{{ $booking->formatted_date }}</span>
                            </li>
                            <li class="detail-item">
                                <span class="detail-label">Rentang Waktu</span>
                                <span class="detail-val" style="color: var(--clr-accent);">{{ $booking->formatted_time_range }}</span>
                            </li>
                        </ul>
                    </div>
 
                    <!-- Right: Guide / Panduan -->
                    <div class="card" style="margin-bottom: 0;">
                        <h3 class="card-title">📖 Panduan Pelaporan LAPOLPA</h3>
                        <div class="guide-box">
                            <h4>
                                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                Informasi Penting Bagi Pemohon:
                            </h4>
                            <ul class="guide-list">
                                <li><strong>Hadir Tepat Waktu</strong>: Datanglah ke kantor pertanahan 10 menit sebelum waktu mulai rentang jadwal Anda.</li>
                                <li><strong>Persiapan Identitas</strong>: Bawa KTP asli/tanda pengenal sah milik pemohon yang terdaftar.</li>
                                <li><strong>Berkas Fisik</strong>: Bawa salinan dokumen persyaratan tata ruang (11 PDF berkas yang telah dikerjakan).</li>
                                <li><strong>Nomor Aktif</strong>: Pastikan nomor WhatsApp <strong>{{ $booking->whatsapp_number }}</strong> aktif karena petugas akan mengirimkan instruksi lokasi & gerbang antrean.</li>
                            </ul>
                        </div>
                    </div>
                </div>
 
                <!-- FITUR ULASAN LAYANAN LAPOLPA (ANTI-SPAM) -->
                @if($booking->status === 'selesai')
                    @php
                        $review = \App\Models\Review::where('user_id', Auth::id())
                            ->where('module_type', 'lapolpa')
                            ->where('module_id', $booking->id)
                            ->first();
                    @endphp
 
                    @if(Auth::user()->isPelakuUsaha())
                        <div class="card" style="border-color: #CBD5E0; background: #F8FAFC;">
                            <h3 class="card-title" style="color: var(--clr-primary); display: flex; align-items: center; gap: 8px;">
                                ⭐ Ulasan & Penilaian Layanan LAPOLPA
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
                                <p style="font-size: 12.5px; color: var(--clr-muted); margin-bottom: 16px;">Konsultasi Anda telah selesai dilakukan. Silakan berikan ulasan & saran Anda untuk meningkatkan pelayanan kami.</p>
                                <form action="{{ route('review.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="module_type" value="lapolpa">
                                    <input type="hidden" name="module_id" value="{{ $booking->id }}">
                                    
                                    <div class="form-group">
                                        <label for="rating">Penilaian Anda</label>
                                        <select name="rating" id="rating" class="form-control" style="padding: 12px; background: #FFF;" required>
                                            <option value="5">⭐⭐⭐⭐⭐ Sangat Baik</option>
                                            <option value="4">⭐⭐⭐⭐ Baik</option>
                                            <option value="3">⭐⭐⭐ Cukup Baik</option>
                                            <option value="2">⭐⭐ Kurang</option>
                                            <option value="1">⭐ Sangat Kurang</option>
                                        </select>
                                    </div>
 
                                    <div class="form-group">
                                        <label for="comment">Catatan Ulasan / Feedback</label>
                                        <textarea name="comment" id="comment" class="form-control" rows="2" style="background: #FFF; resize: none;" placeholder="Tuliskan saran atau ulasan singkat Anda..." required></textarea>
                                    </div>
 
                                    <button type="submit" class="btn-submit" style="padding: 10px 20px; font-size: 13px;">
                                        Kirim Ulasan Layanan
                                    </button>
                                </form>
                            @endif
                        </div>
                    @endif
                @endif
 
            @else
                <!-- ========================================== -->
                <!-- JIKA PEMOHON BELUM BOOKING (TAMPILKAN FORM) -->
                <!-- ========================================== -->
                <div class="card" style="max-width: 650px; margin: 0 auto;">
                    <h3 class="card-title">📅 Daftarkan Jadwal Laporan LAPOLPA</h3>
                    
                    <form action="{{ route('lapolpa.store') }}" method="POST">
                        @csrf
                        
                        <div class="form-group">
                            <label for="whatsapp_number">Nomor WhatsApp Aktif</label>
                            <input type="text" name="whatsapp_number" id="whatsapp_number" class="form-control" 
                                   placeholder="Contoh: 081234567890" value="{{ old('whatsapp_number', Auth::user()->phone_number) }}" required>
                            <span style="font-size: 11px; color: var(--clr-muted); margin-top: 4px; display: block;">*Notifikasi panduan & jadwal akan otomatis dikirimkan ke nomor ini.</span>
                        </div>
 
                        <div class="form-grid-3">
                            <div class="form-group">
                                <label for="booking_date">Tanggal Pelaporan</label>
                                <input type="date" name="booking_date" id="booking_date" class="form-control" 
                                       min="{{ date('Y-m-d') }}" value="{{ old('booking_date') }}" required>
                            </div>
 
                            <div class="form-group">
                                <label for="time_start">Jam Mulai</label>
                                <input type="time" name="time_start" id="time_start" class="form-control" 
                                       value="{{ old('time_start') }}" required>
                            </div>
 
                            <div class="form-group">
                                <label for="time_end">Jam Selesai</label>
                                <input type="time" name="time_end" id="time_end" class="form-control" 
                                       value="{{ old('time_end') }}" required>
                            </div>
                        </div>
 
                        <div style="margin-top: 10px; text-align: center;">
                            <button type="submit" class="btn-submit">
                                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 2L11 13M22 2l-7 20-4-9-9-4 20-7z"/></svg>
                                Kirim Jadwal Booking
                            </button>
                        </div>
                    </form>
                </div>
            @endif
 
        </div>
    </main>
 
</body>
</html>
