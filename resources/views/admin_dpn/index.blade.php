@extends('layouts.app')

@section('title', 'Kelola Web & Statistik - PATEN PAK MIKO')
@section('page-title', 'Kelola Web')

@section('extra-styles')
    @keyframes kwFadeUp {
        from { opacity: 0; transform: translateY(5px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .kw-hero {
        background: #FFFFFF;
        border: 1px solid #D6E4EF;
        border-radius: 4px;
        padding: 15px 18px;
        margin-bottom: 14px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
        flex-wrap: wrap;
        animation: kwFadeUp .2s cubic-bezier(0.22, 1, 0.36, 1) both;
    }
    .kw-hero-title { font-size: 17px; font-weight: 800; color: #003B64; letter-spacing: -0.02em; margin: 0 0 2px; }
    .kw-hero-sub { font-size: 12.5px; color: #64748B; margin: 0; }
    .kw-btn-home {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #FFFFFF;
        color: #003B64;
        border: 1px solid #CBD5E1;
        border-radius: 4px;
        padding: 7px 12px;
        font-size: 12px;
        font-weight: 700;
        text-decoration: none;
    }
    .kw-btn-home:hover { background: #F1F5F9; border-color: #218AC9; }

    /* 4 Ringkasan Angka Beranda */
    .preview-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 12px;
        margin-bottom: 14px;
        animation: kwFadeUp .22s cubic-bezier(0.22, 1, 0.36, 1) .03s both;
    }
    .preview-card {
        background: #FFFFFF;
        border: 1px solid #D6E4EF;
        border-radius: 4px;
        padding: 14px 16px;
    }
    .preview-card-label {
        font-size: 11px;
        font-weight: 700;
        color: #64748B;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        margin-bottom: 4px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 6px;
    }
    .preview-card-val {
        font-size: 22px;
        font-weight: 800;
        color: #003B64;
        line-height: 1.15;
    }
    .preview-card-sub {
        font-size: 11.5px;
        color: #64748B;
        margin-top: 4px;
    }
    .kw-source-tag {
        font-size: 10px;
        font-weight: 700;
        padding: 2px 6px;
        border-radius: 4px;
    }
    .kw-source-tag--auto { background: #DCFCE7; color: #166534; }
    .kw-source-tag--custom { background: #E3F0F9; color: #003B64; }

    /* Workspace Tabs */
    .kw-tabs {
        display: flex;
        align-items: center;
        gap: 6px;
        margin-bottom: 14px;
        flex-wrap: wrap;
    }
    .kw-tab-btn {
        height: 34px;
        padding: 0 14px;
        border: 1px solid #CBD5E1;
        border-radius: 4px;
        background: #FFFFFF;
        color: #475569;
        font-family: inherit;
        font-size: 12.5px;
        font-weight: 700;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: background .15s ease, color .15s ease, border-color .15s ease;
    }
    .kw-tab-btn:hover { background: #F1F5F9; color: #003B64; }
    .kw-tab-btn.is-active {
        background: #003B64;
        border-color: #003B64;
        color: #FFFFFF;
    }
    .kw-tab-panel { display: none; }
    .kw-tab-panel.is-active { display: block; animation: kwFadeUp .18s ease-out both; }

    /* Panels & Form */
    .kw-two-col {
        display: grid;
        grid-template-columns: 1.5fr 1fr;
        gap: 14px;
        align-items: start;
    }
    .kw-panel {
        background: #FFFFFF;
        border: 1px solid #D6E4EF;
        border-radius: 4px;
        overflow: hidden;
    }
    .kw-panel-head {
        padding: 12px 16px;
        background: #F8FAFC;
        border-bottom: 1px solid #E8F0F6;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        flex-wrap: wrap;
    }
    .kw-panel-head h2 {
        font-size: 14px;
        font-weight: 800;
        color: #003B64;
        margin: 0;
    }
    .kw-panel-body { padding: 16px; }

    .kw-form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
        margin-bottom: 14px;
    }
    .kw-label {
        display: block;
        font-size: 12px;
        font-weight: 700;
        color: #003B64;
        margin-bottom: 4px;
    }
    .kw-input {
        width: 100%;
        height: 36px;
        padding: 0 11px;
        border: 1px solid #CBD5E1;
        border-radius: 4px;
        font-family: inherit;
        font-size: 13px;
        color: #0F172A;
        background: #FFFFFF;
        outline: none;
    }
    .kw-input:focus { border-color: #218AC9; }
    .kw-hint { font-size: 11px; color: #64748B; margin-top: 4px; display: block; line-height: 1.4; }

    .kw-btn-primary {
        background: #003B64;
        color: #FFFFFF;
        border: none;
        border-radius: 4px;
        padding: 9px 16px;
        font-family: inherit;
        font-size: 12.5px;
        font-weight: 700;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        text-decoration: none;
    }
    .kw-btn-primary:hover { background: #218AC9; color: #FFFFFF; }
    .kw-btn-green {
        background: #16A34A;
        color: #FFFFFF;
        border: none;
        border-radius: 4px;
        padding: 9px 15px;
        font-family: inherit;
        font-size: 12.5px;
        font-weight: 700;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        text-decoration: none;
    }
    .kw-btn-green:hover { background: #15803D; color: #FFFFFF; }
    .kw-btn-outline {
        background: #FFFFFF;
        color: #334155;
        border: 1px solid #CBD5E1;
        border-radius: 4px;
        padding: 8px 14px;
        font-family: inherit;
        font-size: 12px;
        font-weight: 700;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        text-decoration: none;
    }
    .kw-btn-outline:hover { background: #F1F5F9; color: #003B64; }
    .kw-btn-danger {
        background: #DC2626;
        color: #FFFFFF;
        border: none;
        border-radius: 4px;
        padding: 9px 14px;
        font-family: inherit;
        font-size: 12px;
        font-weight: 700;
        cursor: pointer;
    }
    .kw-btn-danger:hover { background: #B91C1C; }

    .kw-subbox {
        background: #F8FAFC;
        border: 1px solid #E2E8F0;
        border-radius: 4px;
        padding: 14px;
        margin-bottom: 12px;
    }
    .kw-table { width: 100%; border-collapse: collapse; font-size: 12px; }
    .kw-table th {
        padding: 9px 12px;
        background: #F8FAFC;
        border-bottom: 1px solid #D6E4EF;
        color: #475569;
        font-size: 10.5px;
        font-weight: 800;
        text-transform: uppercase;
        text-align: left;
    }
    .kw-table td {
        padding: 10px 12px;
        border-bottom: 1px solid #EFF4F8;
        vertical-align: middle;
    }
    .kw-table tbody tr:hover { background: #F8FAFC; }

    @media (max-width: 1024px) {
        .preview-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        .kw-two-col, .kw-form-grid { grid-template-columns: 1fr; }
    }
    @media (max-width: 576px) {
        .preview-grid { grid-template-columns: 1fr; }
    }
    @media (prefers-reduced-motion: reduce) {
        .kw-hero, .preview-grid, .kw-tab-panel.is-active { animation: none !important; }
    }
@endsection

@section('content')
@php
    $hasPermOverride = isset($stats['permohonan_diproses']) && trim((string)$stats['permohonan_diproses']) !== '';
    $livePermVal = $hasPermOverride ? $stats['permohonan_diproses'] : number_format($totalPermohonanDb);

    $hasRatingOverride = isset($stats['rating_override']) && trim((string)$stats['rating_override']) !== '' && $stats['rating_override'] !== '0' && $stats['rating_override'] !== '0.0';
    $liveRatingVal = $hasRatingOverride ? $stats['rating_override'] : ($realAverageRating . '/5');

    $livePenyVal = !empty($stats['rata_rata_penyelesaian']) ? $stats['rata_rata_penyelesaian'] : $realAvgDays;
@endphp

<!-- Hero Ringkas -->
<div class="kw-hero">
    <div>
        <h1 class="kw-hero-title">Pengaturan Beranda &amp; Cadangan Sistem</h1>
        <p class="kw-hero-sub">Kelola angka statistik yang tampil di beranda publik, koneksi Google Drive, dan arsip SQL.</p>
    </div>
    <a href="{{ url('/') }}" target="_blank" class="kw-btn-home">
        <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
        <span>Lihat Beranda Publik</span>
    </a>
</div>

<!-- 4 Angka Aktif Saat Ini -->
<div class="preview-grid">
    <div class="preview-card">
        <div class="preview-card-label">
            <span>Permohonan</span>
            <span class="kw-source-tag {{ $hasPermOverride ? 'kw-source-tag--custom' : 'kw-source-tag--auto' }}">
                {{ $hasPermOverride ? 'Manual' : 'Otomatis' }}
            </span>
        </div>
        <div class="preview-card-val">{{ $livePermVal }}</div>
        <div class="preview-card-sub">Data asli DB: {{ number_format($totalPermohonanDb) }} berkas</div>
    </div>

    <div class="preview-card">
        <div class="preview-card-label">
            <span>Rating Layanan</span>
            <span class="kw-source-tag {{ $hasRatingOverride ? 'kw-source-tag--custom' : 'kw-source-tag--auto' }}">
                {{ $hasRatingOverride ? 'Manual' : 'Otomatis' }}
            </span>
        </div>
        <div class="preview-card-val">{{ $liveRatingVal }}</div>
        <div class="preview-card-sub">Dari {{ $totalApprovedCount }} ulasan tayang</div>
    </div>

    <div class="preview-card">
        <div class="preview-card-label">
            <span>Rata-rata Selesai</span>
            <span class="kw-source-tag kw-source-tag--custom">Teks Beranda</span>
        </div>
        <div class="preview-card-val">{{ $livePenyVal }}</div>
        <div class="preview-card-sub">Hitung riil Pertek: {{ $realAvgDays }}</div>
    </div>

    <div class="preview-card">
        <div class="preview-card-label">
            <span>Total Kunjungan</span>
            <span class="kw-source-tag kw-source-tag--auto">Counter</span>
        </div>
        <div class="preview-card-val">{{ number_format($count) }}</div>
        <div class="preview-card-sub">Pengunjung tercatat sistem</div>
    </div>
</div>

<!-- Tab Navigasi Bagian -->
<div class="kw-tabs">
    <button type="button" class="kw-tab-btn is-active" data-kw-tab="stats" onclick="switchKwTab('stats')">Statistik Beranda</button>
    <button type="button" class="kw-tab-btn" data-kw-tab="gdrive" onclick="switchKwTab('gdrive')">
        Google Drive ({{ !empty($gdriveRefreshToken) || $gdriveAuthMode === 'service_account' ? 'Terhubung' : 'Belum' }})
    </button>
    <button type="button" class="kw-tab-btn" data-kw-tab="archive" onclick="switchKwTab('archive')">Arsip Cadangan DB ({{ count($backupArchives ?? []) }})</button>
</div>

<!-- TAB 1: STATISTIK BERANDA -->
<div id="kw-panel-stats" class="kw-tab-panel is-active">
    <div class="kw-two-col">
        <div class="kw-panel">
            <div class="kw-panel-head">
                <h2>Ubah Nilai Statistik Beranda</h2>
            </div>
            <div class="kw-panel-body">
                <form action="{{ route('admin_dpn.update') }}" method="POST">
                    @csrf
                    <div class="kw-form-grid">
                        <div>
                            <label class="kw-label">Angka Permohonan (Opsional)</label>
                            <input type="text" name="permohonan_diproses" class="kw-input" value="{{ $stats['permohonan_diproses'] ?? '' }}" placeholder="Kosong = otomatis ({{ number_format($totalPermohonanDb) }})">
                            <span class="kw-hint">Isi jika ingin menampilkan angka custom (misal: <code>1.200+</code>). Kosongkan agar hitung otomatis.</span>
                        </div>
                        <div>
                            <label class="kw-label">Teks Estimasi Selesai</label>
                            <input type="text" name="rata_rata_penyelesaian" class="kw-input" value="{{ $stats['rata_rata_penyelesaian'] ?? '10 hari' }}" required placeholder="Contoh: 10 hari">
                            <span class="kw-hint">Teks durasi layanan yang ditampilkan di halaman depan.</span>
                        </div>
                        <div>
                            <label class="kw-label">Nilai Rating (Opsional)</label>
                            <input type="text" name="rating_override" class="kw-input" value="{{ $stats['rating_override'] ?? '' }}" placeholder="Kosong = otomatis ({{ $realAverageRating }}/5)">
                            <span class="kw-hint">Kosongkan untuk ambil rata-rata dari ulasan pemohon.</span>
                        </div>
                        <div>
                            <label class="kw-label">Angka Kunjungan Website</label>
                            <input type="number" name="count" class="kw-input" value="{{ $stats['count'] ?? 0 }}" required min="0" style="font-weight:700;">
                            <span class="kw-hint">Menambah otomatis setiap kali halaman depan dibuka.</span>
                        </div>
                    </div>

                    <button type="submit" class="kw-btn-primary">Simpan Perubahan Statistik</button>
                </form>
            </div>
        </div>

        <div class="kw-panel">
            <div class="kw-panel-head" style="background:#FEF2F2; border-bottom-color:#FECACA;">
                <h2 style="color:#991B1B;">Reset Penghitung Kunjungan</h2>
            </div>
            <div class="kw-panel-body">
                <p style="font-size:12.5px; color:#475569; margin:0 0 14px; line-height:1.5;">
                    Gunakan tombol di bawah jika ingin mengembalikan jumlah kunjungan website menjadi <strong>0</strong>. Data permohonan dan ulasan tidak terpengaruh.
                </p>
                <form action="{{ route('admin_dpn.reset_visitor') }}" method="POST" onsubmit="return confirm('Reset angka kunjungan website kembali ke 0?')">
                    @csrf
                    <button type="submit" class="kw-btn-danger" style="width:100%;">Reset Kunjungan ke 0</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- TAB 2: GOOGLE DRIVE CLOUD -->
<div id="kw-panel-gdrive" class="kw-tab-panel">
    <div id="gdrive-config-section" class="kw-panel">
        <div class="kw-panel-head">
            <h2>Integrasi Google Drive Backup</h2>
            @if(!empty($gdriveRefreshToken))
                <div style="display:flex; align-items:center; gap:8px;">
                    <span class="kw-source-tag kw-source-tag--auto">Terhubung: {{ $gdriveClientEmail ?: 'Gmail Pribadi' }}</span>
                    <form action="{{ route('admin_dpn.gdrive_disconnect') }}" method="POST" onsubmit="return confirm('Putuskan koneksi Google Drive?')" style="margin:0;">
                        @csrf
                        <button type="submit" class="kw-btn-danger" style="padding:4px 10px; font-size:11px;">Putuskan</button>
                    </form>
                </div>
            @elseif($gdriveAuthMode === 'service_account')
                <span class="kw-source-tag kw-source-tag--auto">Service Account: {{ $gdriveClientEmail }}</span>
            @else
                <span class="kw-source-tag" style="background:#FEF3C7; color:#92400E;">Belum Terhubung</span>
            @endif
        </div>

        <div class="kw-panel-body">
            <div class="kw-two-col">
                <form action="{{ route('admin_dpn.gdrive_settings') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div style="margin-bottom:12px;">
                        <label class="kw-label">Folder ID atau URL Google Drive</label>
                        <input type="text" name="gdrive_folder_id" class="kw-input" value="{{ $gdriveFolderId }}" placeholder="Paste URL atau ID folder Google Drive" required>
                    </div>

                    <div class="kw-subbox">
                        <div style="font-size:12px; font-weight:800; color:#003B64; margin-bottom:10px;">Kredensial OAuth 2.0 (Gmail Pribadi)</div>
                        <div class="kw-form-grid" style="margin-bottom:0;">
                            <div>
                                <label class="kw-label">Client ID</label>
                                <input type="text" name="gdrive_client_id" class="kw-input" value="{{ $gdriveClientId }}" placeholder="xxx.apps.googleusercontent.com" style="font-family:monospace; font-size:12px;">
                            </div>
                            <div>
                                <label class="kw-label">Client Secret</label>
                                <input type="password" name="gdrive_client_secret" class="kw-input" value="{{ $gdriveClientSecret }}" placeholder="GOCSPX-..." style="font-family:monospace; font-size:12px;">
                            </div>
                        </div>
                    </div>

                    <details style="font-size:12px; color:#475569; margin-bottom:14px;">
                        <summary style="cursor:pointer; font-weight:700; color:#003B64;">Opsi Lanjutan: Service Account JSON (Workspace)</summary>
                        <div class="kw-subbox" style="margin-top:8px; margin-bottom:0;">
                            <div style="margin-bottom:8px;">
                                <label class="kw-label">Upload File .json</label>
                                <input type="file" name="gdrive_credentials_file" accept=".json,application/json" class="kw-input" style="padding:5px 8px; height:auto;">
                            </div>
                            <div>
                                <label class="kw-label">Atau Paste JSON</label>
                                <textarea name="gdrive_credentials_json" rows="2" class="kw-input" style="height:auto; padding:8px; font-family:monospace; font-size:11px;" placeholder='{"type": "service_account", ...}'></textarea>
                            </div>
                        </div>
                    </details>

                    <div style="display:flex; gap:8px; flex-wrap:wrap;">
                        <button type="submit" class="kw-btn-primary">Simpan Pengaturan Drive</button>
                        @if(empty($gdriveRefreshToken))
                            <a href="{{ route('admin_dpn.gdrive_auth') }}" class="kw-btn-green">Hubungkan Akun Google</a>
                        @endif
                    </div>
                </form>

                <div>
                    <div class="kw-subbox">
                        <div style="font-size:12.5px; font-weight:800; color:#003B64; margin-bottom:6px;">Uji Koneksi Folder</div>
                        <p style="font-size:11.5px; color:#64748B; margin:0 0 10px;">Pastikan aplikasi bisa menulis file ke folder Google Drive tujuan.</p>
                        <form action="{{ route('admin_dpn.gdrive_test') }}" method="POST">
                            @csrf
                            <button type="submit" class="kw-btn-outline" style="width:100%;">Tes Koneksi Google Drive</button>
                        </form>
                    </div>

                    @if($gdriveIsConfigured)
                        <div class="kw-subbox" style="background:#F0FDF4; border-color:#BBF7D0; margin-bottom:0;">
                            <div style="font-size:12.5px; font-weight:800; color:#166534; margin-bottom:8px;">Upload Backup Sekarang</div>
                            <div style="display:flex; flex-direction:column; gap:8px;">
                                <form action="{{ route('admin_dpn.backup_gdrive') }}" method="POST" onsubmit="return confirm('Upload Database SQL ke Google Drive?')">
                                    @csrf
                                    <input type="hidden" name="backup_format" value="sql">
                                    <button type="submit" class="kw-btn-green" style="width:100%;">Upload Database (.SQL)</button>
                                </form>
                                <form action="{{ route('admin_dpn.backup_gdrive') }}" method="POST" onsubmit="return confirm('Kompres dan upload seluruh dokumen fisik (.ZIP) ke Google Drive?')">
                                    @csrf
                                    <input type="hidden" name="backup_format" value="zip">
                                    <button type="submit" class="kw-btn-outline" style="width:100%;">Upload Semua Dokumen (.ZIP)</button>
                                </form>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <details style="margin-top:14px; border-top:1px solid #E8F0F6; padding-top:12px; font-size:12px; color:#475569;">
                <summary style="cursor:pointer; font-weight:700; color:#218AC9;">Cara Setup OAuth Client ID di Google Cloud Console</summary>
                <ol style="margin:8px 0 0; padding-left:18px; line-height:1.6;">
                    <li>Buka Google Cloud Console → <strong>APIs &amp; Services → Credentials → Create OAuth client ID (Web application)</strong>.</li>
                    <li>Tambahkan Authorized redirect URI: <code>{{ route('admin_dpn.gdrive_callback') }}</code> (atau <code>http://127.0.0.1:8000/admin_dpn/gdrive-callback</code> untuk lokal).</li>
                    <li>Salin Client ID &amp; Secret ke form di atas, simpan, lalu klik <strong>Hubungkan Akun Google</strong>.</li>
                </ol>
            </details>
        </div>
    </div>
</div>

<!-- TAB 3: ARSIP CADANGAN DB -->
<div id="kw-panel-archive" class="kw-tab-panel">
    <div class="kw-panel">
        <div class="kw-panel-head">
            <div>
                <h2>Arsip Cadangan Database</h2>
                <div style="font-size:11.5px; color:#64748B; margin-top:2px;">Rotasi otomatis hingga 30 file SQL setiap permohonan baru atau manual backup.</div>
            </div>
            <form action="{{ route('admin_dpn.backup_archive.manual') }}" method="POST" onsubmit="return confirm('Buat cadangan database SQL sekarang?')" style="margin:0;">
                @csrf
                <button type="submit" class="kw-btn-primary">Buat Cadangan Sekarang</button>
            </form>
        </div>
        <div style="overflow-x:auto;">
            @if(empty($backupArchives) || count($backupArchives) === 0)
                <div style="padding:32px 16px; text-align:center; color:#64748B; font-size:12.5px;">
                    Belum ada file cadangan tersimpan. Klik <strong>Buat Cadangan Sekarang</strong> untuk membuat backup SQL.
                </div>
            @else
                <table class="kw-table">
                    <thead>
                        <tr>
                            <th style="width:40px; text-align:center;">#</th>
                            <th>Nama Berkas</th>
                            <th>Pemicu</th>
                            <th>Waktu</th>
                            <th>Ukuran</th>
                            <th>Email Blast</th>
                            <th style="text-align:right;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($backupArchives as $idx => $archive)
                            <tr>
                                <td style="text-align:center; color:#64748B; font-weight:700;">{{ $idx + 1 }}</td>
                                <td><code style="font-size:11.5px; color:#003B64; font-weight:700;">{{ $archive['filename'] }}</code></td>
                                <td><span class="kw-source-tag kw-source-tag--custom">{{ $archive['label'] }}</span></td>
                                <td style="white-space:nowrap;">{{ \Carbon\Carbon::parse($archive['created_at'])->format('d M Y, H:i') }} WIB</td>
                                <td style="font-weight:700; color:#003B64;">{{ $archive['size_formatted'] ?? '-' }}</td>
                                <td>{{ !empty($archive['email_sent']) ? 'Terkirim' : 'Lokal' }}</td>
                                <td style="text-align:right; white-space:nowrap;">
                                    <div style="display:inline-flex; gap:5px;">
                                        <a href="{{ route('admin_dpn.backup_archive.download', $archive['filename']) }}" class="kw-btn-outline" style="padding:4px 9px; font-size:11px;">Unduh</a>
                                        <form action="{{ route('admin_dpn.backup_archive.delete', $archive['filename']) }}" method="POST" style="margin:0;" onsubmit="return confirm('Hapus arsip ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="kw-btn-danger" style="padding:4px 9px; font-size:11px;">Hapus</button>
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
@endsection

@section('scripts')
<script>
    function switchKwTab(name) {
        document.querySelectorAll('.kw-tab-btn').forEach(btn => {
            btn.classList.toggle('is-active', btn.dataset.kwTab === name);
        });
        document.querySelectorAll('.kw-tab-panel').forEach(panel => {
            panel.classList.toggle('is-active', panel.id === 'kw-panel-' + name);
        });
        try { sessionStorage.setItem('kw_active_tab', name); } catch (e) {}
    }

    document.addEventListener('DOMContentLoaded', function() {
        if (window.location.hash === '#gdrive-config-section') {
            switchKwTab('gdrive');
            return;
        }
        try {
            const saved = sessionStorage.getItem('kw_active_tab');
            if (saved && document.getElementById('kw-panel-' + saved)) {
                switchKwTab(saved);
            }
        } catch (e) {}
    });
</script>
@endsection
