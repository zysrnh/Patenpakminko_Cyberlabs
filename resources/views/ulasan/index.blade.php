<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ulasan Layanan — PATENPAKMIKO</title>
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
 
        /* Layout Grid */
        .layout-grid {
            display: grid;
            grid-template-columns: 1fr 1.3fr;
            gap: 28px;
        }
 
        @media (max-width: 768px) {
            .layout-grid {
                grid-template-columns: 1fr;
            }
        }
 
        /* Cards */
        .card {
            background-color: var(--clr-card-bg);
            border: 1.5px solid var(--clr-line);
            border-radius: 16px;
            padding: 28px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.02);
            height: fit-content;
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
 
        /* Form Control */
        .form-group {
            margin-bottom: 18px;
        }
 
        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 700;
            color: var(--clr-primary);
            margin-bottom: 6px;
        }
 
        .form-control, .form-select {
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
 
        .form-control:focus, .form-select:focus {
            outline: none;
            border-color: var(--clr-accent);
            background-color: #FFFFFF;
            box-shadow: 0 0 0 3px rgba(49, 130, 206, 0.15);
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
            width: 100%;
            justify-content: center;
        }
 
        .btn-submit:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 14px rgba(49, 130, 206, 0.35);
        }
 
        /* Reviews List */
        .review-item {
            border: 1.5px solid var(--clr-line);
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 16px;
            background-color: #FFFFFF;
            transition: border-color 0.2s;
        }
 
        .review-item:hover {
            border-color: var(--clr-accent);
        }
 
        .review-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 8px;
        }
 
        .badge-module {
            background-color: rgba(49, 130, 206, 0.08);
            color: var(--clr-primary-light);
            font-size: 11px;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 6px;
            display: inline-block;
        }
 
        .badge-status {
            font-size: 11px;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 100px;
            display: inline-block;
        }
 
        .badge-status.approved {
            background-color: var(--clr-green-light);
            color: #22543D;
        }
 
        .badge-status.pending {
            background-color: #E2E8F0;
            color: #4A5568;
        }
 
        .review-stars {
            color: var(--clr-stars);
            font-size: 14px;
            margin-bottom: 6px;
        }
 
        .review-comment {
            font-size: 13px;
            font-style: italic;
            color: #4A5568;
        }
 
        .review-date {
            font-size: 11px;
            color: var(--clr-muted);
            margin-top: 8px;
            display: block;
        }
 
        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: var(--clr-muted);
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
                    <a href="{{ route('profile') }}" class="nav-link">Profil Saya</a>
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
                <h1 class="page-title">⭐ Ulasan Layanan & Feedback</h1>
                <p class="page-subtitle">Berikan ulasan dan penilaian Anda mengenai kualitas pelayanan tata ruang kami.</p>
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
 
            <div class="layout-grid">
                
                <!-- Left: Form Input Ulasan -->
                <div class="card">
                    <h3 class="card-title">📝 Tulis Ulasan Baru</h3>
                    
                    <form action="{{ route('review.store') }}" method="POST">
                        @csrf
                        
                        <div class="form-group">
                            <label for="module_type">Layanan Yang Diulas</label>
                            <select name="module_type" id="module_type" class="form-select" required>
                                <option value="umum">Layanan Umum / Portal PATENPAKMIKO</option>
                                <option value="lapolpa">LAPOLPA (Layanan Pelaporan)</option>
                                <option value="berusaha">PPKPR Berusaha</option>
                                <option value="non_berusaha">PPKPR Non-Berusaha</option>
                                <option value="kebijakan">Kebijakan Khusus</option>
                            </select>
                        </div>
 
                        <div class="form-group" id="module_id_container" style="display: none;">
                            <label for="module_id">ID / Nomor Permohonan</label>
                            <input type="number" name="module_id" id="module_id" class="form-control" placeholder="Contoh: 1" value="0">
                            <span style="font-size: 11px; color: var(--clr-muted); margin-top: 4px; display: block;">*Masukkan ID permohonan atau booking Anda (opsional, default 0).</span>
                        </div>
 
                        <div class="form-group">
                            <label for="rating">Penilaian Anda (Bintang)</label>
                            <select name="rating" id="rating" class="form-select" required>
                                <option value="5">⭐⭐⭐⭐⭐ Sangat Baik</option>
                                <option value="4">⭐⭐⭐⭐ Baik</option>
                                <option value="3">⭐⭐⭐ Cukup Baik</option>
                                <option value="2">⭐⭐ Kurang</option>
                                <option value="1">⭐ Sangat Kurang</option>
                            </select>
                        </div>
 
                        <div class="form-group">
                            <label for="comment">Catatan Ulasan / Feedback</label>
                            <textarea name="comment" id="comment" class="form-control" rows="4" placeholder="Tuliskan ulasan, kritik, atau saran Anda..." style="resize: none;" required></textarea>
                        </div>
 
                        <button type="submit" class="btn-submit">
                            Kirim Ulasan Layanan
                        </button>
                    </form>
                </div>
 
                <!-- Right: Riwayat Ulasan -->
                <div class="card" style="background-color: #F8FAFC;">
                    <h3 class="card-title">⏳ Riwayat Ulasan Anda</h3>
                    
                    <div style="max-height: 480px; overflow-y: auto; padding-right: 4px;">
                        @if($myReviews->isEmpty())
                            <div class="empty-state">
                                <p style="font-size: 13.5px; font-weight: 600;">Anda belum pernah mengirimkan ulasan.</p>
                            </div>
                        @else
                            @foreach($myReviews as $rev)
                                <div class="review-item">
                                    <div class="review-header">
                                        <div>
                                            <span class="badge-module">{{ $rev->module_label }}</span>
                                            @if($rev->module_id > 0)
                                                <div style="font-size: 11px; color: var(--clr-muted); margin-top: 4px;">ID: #{{ $rev->module_id }}</div>
                                            @endif
                                        </div>
                                        <div>
                                            @if($rev->is_approved)
                                                <span class="badge-status approved">Disetujui</span>
                                            @else
                                                <span class="badge-status pending">Moderasi</span>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <div class="review-stars">
                                        {{ str_repeat('★', $rev->rating) }}{{ str_repeat('☆', 5 - $rev->rating) }}
                                        <span style="font-size: 12px; font-weight: 800; color: var(--clr-text); margin-left: 4px;">({{ $rev->rating_label }})</span>
                                    </div>
                                    
                                    <p class="review-comment">"{{ $rev->comment }}"</p>
                                    <span class="review-date">Dikirim pada: {{ $rev->created_at->format('d M Y, H:i') }}</span>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
 
            </div>
        </div>
    </main>
 
    <script>
        // Toggle input ID Permohonan berdasarkan tipe layanan yang dipilih
        const moduleTypeSelect = document.getElementById('module_type');
        const moduleIdContainer = document.getElementById('module_id_container');
        const moduleIdInput = document.getElementById('module_id');
 
        moduleTypeSelect.addEventListener('change', function() {
            if (this.value === 'umum') {
                moduleIdContainer.style.display = 'none';
                moduleIdInput.value = '0';
            } else {
                moduleIdContainer.style.display = 'block';
                if (moduleIdInput.value === '0') {
                    moduleIdInput.value = '';
                }
            }
        });
    </script>
</body>
</html>
