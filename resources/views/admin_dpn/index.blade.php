@extends('layouts.app')

@section('title', 'Kelola Web & Statistik - PATEN PAK MIKO')
@section('page-title', 'Kelola Web')

@section('extra-styles')
<style>
    .stat-header-box {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 4px;
        padding: 16px 20px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        flex-wrap: wrap;
    }
    .preview-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 14px;
        margin-bottom: 22px;
    }
    .preview-card {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 4px;
        padding: 16px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        gap: 8px;
    }
    .preview-card-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 8px;
    }
    .preview-card-title {
        font-size: 11px;
        font-weight: 700;
        color: #64748B;
        text-transform: uppercase;
        letter-spacing: 0.04em;
    }
    .preview-card-badge {
        font-size: 10px;
        font-weight: 700;
        padding: 2px 7px;
        border-radius: 3px;
        text-transform: uppercase;
        letter-spacing: 0.03em;
    }
    .preview-card-badge.auto {
        background: #DCFCE7;
        color: #166534;
        border: 1px solid #BBF7D0;
    }
    .preview-card-badge.manual {
        background: #E0F2FE;
        color: #0369A1;
        border: 1px solid #BAE6FD;
    }
    .preview-card-val {
        font-size: 24px;
        font-weight: 800;
        color: #003B64;
        line-height: 1.15;
        letter-spacing: -0.02em;
    }
    .preview-card-sub {
        font-size: 11px;
        color: #64748B;
        line-height: 1.35;
    }
    .stat-main-grid {
        display: grid;
        grid-template-columns: 1.55fr 1fr;
        gap: 20px;
        align-items: start;
    }

    @media (max-width: 992px) {
        .preview-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        .stat-main-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 576px) {
        .stat-header-box {
            flex-direction: column;
            align-items: flex-start;
            padding: 14px;
        }
        .stat-header-box .btn {
            width: 100%;
            justify-content: center;
        }
        .preview-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
<!-- Header Box -->
<div class="stat-header-box">
    <div>
        <div style="font-size: 12px; color: #64748B; margin-bottom: 4px; display: flex; align-items: center; gap: 6px;">
            <a href="{{ route('dashboard') }}" style="color: #218AC9; text-decoration: none; font-weight: 600;">Dashboard</a>
            <span>›</span>
            <span style="color: #64748B;">Kelola Web</span>
        </div>
        <h1 style="font-size: 19px; font-weight: 800; color: #003B64; letter-spacing: -0.02em; margin: 0;">
            Kelola Statistik Beranda
        </h1>
        <p style="font-size: 12.5px; color: #64748B; margin: 4px 0 0;">
            Atur parameter nilai statistik beranda publik serta pantau perbandingan metrik otomatis database.
        </p>
    </div>
    <div>
        <a href="{{ url('/') }}" target="_blank" class="btn btn-secondary" style="font-weight: 700; font-size: 12.5px; padding: 9px 15px; border-radius: 4px;" title="Buka beranda publik di tab baru">
            <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
            Lihat Beranda Publik
        </a>
    </div>
</div>

<!-- LIVE PREVIEW BERANDA -->
@php
    $hasPermOverride = isset($stats['permohonan_diproses']) && trim((string)$stats['permohonan_diproses']) !== '';
    $livePermVal = $hasPermOverride ? $stats['permohonan_diproses'] : number_format($totalPermohonanDb);

    $hasRatingOverride = isset($stats['rating_override']) && trim((string)$stats['rating_override']) !== '' && $stats['rating_override'] !== '0' && $stats['rating_override'] !== '0.0';
    $liveRatingVal = $hasRatingOverride ? $stats['rating_override'] : ($realAverageRating . '/5');

    $livePenyVal = !empty($stats['rata_rata_penyelesaian']) ? $stats['rata_rata_penyelesaian'] : $realAvgDays;
@endphp

<div class="preview-grid">
    <!-- Card 1: Permohonan Diproses -->
    <div class="preview-card">
        <div class="preview-card-top">
            <span class="preview-card-title">Permohonan Diproses</span>
            @if($hasPermOverride)
                <span class="preview-card-badge manual">Manual Override</span>
            @else
                <span class="preview-card-badge auto">Auto Database</span>
            @endif
        </div>
        <div class="preview-card-val">{{ $livePermVal }}</div>
        <div class="preview-card-sub">
            @if($hasPermOverride)
                Override aktif (DB Real: <strong>{{ number_format($totalPermohonanDb) }}</strong>)
            @else
                Total real dari 5 modul permohonan di DB
            @endif
        </div>
    </div>

    <!-- Card 2: Rata-rata Rating -->
    <div class="preview-card">
        <div class="preview-card-top">
            <span class="preview-card-title">Rata-rata Rating</span>
            @if($hasRatingOverride)
                <span class="preview-card-badge manual">Manual Override</span>
            @else
                <span class="preview-card-badge auto">Auto Ulasan</span>
            @endif
        </div>
        <div class="preview-card-val">{{ $liveRatingVal }}</div>
        <div class="preview-card-sub">
            @if($hasRatingOverride)
                Override aktif (Rating asli: <strong>{{ $realAverageRating }}/5</strong>)
            @else
                Dihitung dari <strong>{{ $totalApprovedCount }}</strong> ulasan disetujui
            @endif
        </div>
    </div>

    <!-- Card 3: Rata-rata Penyelesaian -->
    <div class="preview-card">
        <div class="preview-card-top">
            <span class="preview-card-title">Rata-rata Selesai</span>
            <span class="preview-card-badge manual">Durasi Layanan</span>
        </div>
        <div class="preview-card-val">{{ $livePenyVal }}</div>
        <div class="preview-card-sub">
            Kalkulasi Pertek BPN: <strong>{{ $realAvgDays }}</strong>
        </div>
    </div>

    <!-- Card 4: Kunjungan Pengunjung -->
    <div class="preview-card">
        <div class="preview-card-top">
            <span class="preview-card-title">Kunjungan Web</span>
            <span class="preview-card-badge auto">Live Counter</span>
        </div>
        <div class="preview-card-val">{{ number_format($count) }}</div>
        <div class="preview-card-sub">
            Akumulasi pengunjung unik browser
        </div>
    </div>
</div>

<!-- MAIN TWO-COLUMN CONTENT -->
<div class="stat-main-grid">

    <!-- Kolom Kiri: Form Pengaturan Nilai Statistik -->
    <div class="panel" style="border-radius: 4px;">
        <div class="panel-head" style="background: #F8FAFC;">
            <h2>
                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#218AC9" stroke-width="2.2" style="display:inline-block; vertical-align:middle; margin-right:6px;"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><line x1="3" y1="9" x2="21" y2="9"/><line x1="9" y1="21" x2="9" y2="9"/></svg>
                Form Pengaturan Statistik Beranda
            </h2>
            <span style="font-size: 11.5px; color: #64748B; font-weight: 600;">visitor_stats.json</span>
        </div>
        <div class="panel-body">
            <form action="{{ route('admin_dpn.update') }}" method="POST">
                @csrf
                
                <div class="form-group" style="margin-bottom: 18px;">
                    <label class="form-label" style="font-size: 13px; font-weight: 700; color: #003B64; margin-bottom: 5px;">
                        1. Override Angka Permohonan Diproses <span style="font-weight: 500; color: #64748B;">(Opsional)</span>
                    </label>
                    <input type="text" name="permohonan_diproses" class="form-control" value="{{ $stats['permohonan_diproses'] ?? '' }}" placeholder="Biarkan kosong untuk otomatis hitung dari database..." style="font-size: 13.5px; padding: 10px 14px;">
                    <div class="form-hint" style="font-size: 11.5px; color: #64748B; margin-top: 5px; line-height: 1.45;">
                        • <strong>Dikosongkan</strong>: Sistem otomatis menghitung total real seluruh layanan di database (saat ini: <strong>{{ number_format($totalPermohonanDb) }}</strong> permohonan).<br>
                        • <strong>Diisi</strong>: Nilai kustom ini yang akan tampil di beranda (contoh: <code>15k</code> atau <code>1,250</code>).
                    </div>
                </div>

                <div class="form-group" style="margin-bottom: 18px;">
                    <label class="form-label" style="font-size: 13px; font-weight: 700; color: #003B64; margin-bottom: 5px;">
                        2. Rata-rata Waktu Penyelesaian
                    </label>
                    <input type="text" name="rata_rata_penyelesaian" class="form-control" value="{{ $stats['rata_rata_penyelesaian'] ?? '10 hari' }}" placeholder="Contoh: 10 hari atau 5 hari kerja" required style="font-size: 13.5px; padding: 10px 14px;">
                    <div class="form-hint" style="font-size: 11.5px; color: #64748B; margin-top: 5px;">
                        Teks estimasi durasi penyelesaian layanan yang tampil pada kartu statistik beranda.
                    </div>
                </div>

                <div class="form-group" style="margin-bottom: 18px;">
                    <label class="form-label" style="font-size: 13px; font-weight: 700; color: #003B64; margin-bottom: 5px;">
                        3. Override Rata-rata Rating Ulasan <span style="font-weight: 500; color: #64748B;">(Opsional)</span>
                    </label>
                    <input type="text" name="rating_override" class="form-control" value="{{ $stats['rating_override'] ?? '' }}" placeholder="Biarkan kosong untuk otomatis hitung dari database ulasan..." style="font-size: 13.5px; padding: 10px 14px;">
                    <div class="form-hint" style="font-size: 11.5px; color: #64748B; margin-top: 5px; line-height: 1.45;">
                        • <strong>Dikosongkan</strong>: Mengambil rating rata-rata real dari ulasan yang disetujui (saat ini: <strong>{{ $realAverageRating }}/5</strong> dari {{ $totalApprovedCount }} ulasan).<br>
                        • <strong>Diisi</strong>: Menampilkan teks rating kustom (contoh: <code>4.9/5</code> atau <code>5.0</code>).
                    </div>
                </div>

                <div class="form-group" style="margin-bottom: 22px;">
                    <label class="form-label" style="font-size: 13px; font-weight: 700; color: #003B64; margin-bottom: 5px;">
                        4. Counter Jumlah Kunjungan Pengunjung
                    </label>
                    <input type="number" name="count" class="form-control" value="{{ $stats['count'] ?? 0 }}" required min="0" style="font-size: 16px; font-weight: 800; color: #003B64; padding: 10px 14px;">
                    <div class="form-hint" style="font-size: 11.5px; color: #64748B; margin-top: 5px;">
                        Counter ini bertambah 1 secara otomatis setiap kali ada pengunjung baru yang mengakses halaman beranda.
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-full" style="padding: 11px 18px; font-size: 13.5px; font-weight: 700;">
                    Simpan Perubahan Statistik
                </button>
            </form>
        </div>
    </div>

    <!-- Kolom Kanan: Panel Panduan & Reset -->
    <div style="display: flex; flex-direction: column; gap: 18px;">

        <!-- Panel Panduan Cara Kerja -->
        <div class="panel" style="border-radius: 4px;">
            <div class="panel-head" style="background: #F8FAFC;">
                <h2>
                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#218AC9" stroke-width="2.2" style="display:inline-block; vertical-align:middle; margin-right:6px;"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
                    Panduan & Cara Kerja
                </h2>
            </div>
            <div class="panel-body" style="padding: 18px; font-size: 12px; color: #334155; line-height: 1.55;">
                <div style="margin-bottom: 12px;">
                    <strong style="color: #003B64; display: block; margin-bottom: 2px;">⚡ Otomatisasi Database:</strong>
                    Jika input override dikosongkan, angka beranda akan selalu sinkron dengan data asli transaksi permohonan dan ulasan kepuasan masyarakat.
                </div>
                <div style="margin-bottom: 12px;">
                    <strong style="color: #003B64; display: block; margin-bottom: 2px;">✏️ Override Manual:</strong>
                    Gunakan kolom override jika Anda ingin menampilkan angka publisitas tertentu (misal pembulatan atau promosi layanan).
                </div>
                <div>
                    <strong style="color: #003B64; display: block; margin-bottom: 2px;">💾 Backup Database:</strong>
                    Untuk melakukan unduhan atau pengiriman cadangan database ke email, gunakan tombol <strong>Backup DB</strong> di bilah navigasi atas (topbar).
                </div>
            </div>
        </div>

        <!-- Panel Reset Counter Kunjungan -->
        <div class="panel" style="border-radius: 4px;">
            <div class="panel-head" style="background: #FEF2F2; border-bottom: 1px solid #FECACA;">
                <h2 style="color: #991B1B;">
                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#DC2626" stroke-width="2.2" style="display:inline-block; vertical-align:middle; margin-right:6px;"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                    Reset Counter Kunjungan
                </h2>
            </div>
            <div class="panel-body" style="padding: 18px;">
                <p style="font-size: 12.5px; color: #64748B; line-height: 1.5; margin-bottom: 14px;">
                    Kembalikan hitungan total kunjungan pengunjung website kembali ke <strong style="color: #0F172A;">0 (nol)</strong>.
                </p>

                <form action="{{ route('admin_dpn.reset_visitor') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin me-reset jumlah kunjungan pengunjung kembali ke 0?')">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-full" style="padding: 10px 14px; font-size: 12.5px; font-weight: 700;">
                        Reset Counter Kunjungan ke 0
                    </button>
                </form>
            </div>
        </div>

    </div>

</div>

<!-- RAK ARSIP CADANGAN DATA (AUTO-BACKUP PERMOHONAN & EMAIL BLAST) -->
<div class="panel" style="border-radius: 4px; margin-top: 24px;">
    <div class="panel-head" style="background: #F8FAFC; padding: 16px 20px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 12px;">
        <div>
            <h2 style="font-size: 15.5px; font-weight: 800; color: #003B64; margin: 0; display: flex; align-items: center; gap: 8px;">
                <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="#003B64" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"/></svg>
                Rak Arsip Cadangan Data (Auto-Backup Permohonan)
            </h2>
            <div style="font-size: 12px; color: #64748B; margin-top: 3px;">
                Tiap 1 permohonan baru masuk, database otomatis dicadangkan &amp; di-blast ke <strong>penataanpertanahanmiko@gmail.com</strong> dan <strong>zakiyh782@gmail.com</strong> (tanpa cronjob).
            </div>
        </div>
        <form action="{{ route('admin_dpn.backup_archive.manual') }}" method="POST" onsubmit="return confirm('Mulai proses pencadangan database manual sekarang?')">
            @csrf
            <button type="submit" class="btn btn-primary" style="padding: 8px 14px; font-size: 12px; font-weight: 700; border-radius: 4px; display: flex; align-items: center; gap: 6px;">
                <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                <span>Buat Cadangan Manual Sekarang</span>
            </button>
        </form>
    </div>
    <div class="panel-body" style="padding: 0;">
        @if(empty($backupArchives) || count($backupArchives) === 0)
            <div style="padding: 36px 20px; text-align: center; color: #64748B;">
                <div style="margin-bottom: 8px;">
                    <svg width="40" height="40" fill="none" viewBox="0 0 24 24" stroke="#94A3B8" stroke-width="1.6" style="margin: auto;"><path stroke-linecap="round" stroke-linejoin="round" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                </div>
                <div style="font-size: 13.5px; font-weight: 700; color: #334155; margin-bottom: 4px;">Rak Arsip Masih Kosong</div>
                <div style="font-size: 12px; color: #64748B; max-width: 480px; margin: auto;">
                    Belum ada berkas cadangan tersimpan. Berkas akan otomatis dibuat saat ada pemohon mengajukan permohonan baru, atau Anda dapat menekan tombol <strong>Buat Cadangan Manual Sekarang</strong> di atas.
                </div>
            </div>
        @else
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse; font-size: 12px; text-align: left;">
                    <thead>
                        <tr style="background: #F1F5F9; border-bottom: 1px solid #E2E8F0; color: #475569; font-weight: 700; text-transform: uppercase; font-size: 10.5px; letter-spacing: 0.03em;">
                            <th style="padding: 10px 14px; width: 40px; text-align: center;">#</th>
                            <th style="padding: 10px 14px;">Nama Berkas</th>
                            <th style="padding: 10px 14px;">Pemicu (Trigger)</th>
                            <th style="padding: 10px 14px;">Waktu Pencadangan</th>
                            <th style="padding: 10px 14px;">Ukuran</th>
                            <th style="padding: 10px 14px;">Status Email Blast</th>
                            <th style="padding: 10px 14px; text-align: right;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($backupArchives as $idx => $archive)
                            @php
                                $isManual = str_starts_with($archive['label'] ?? '', 'Manual');
                            @endphp
                            <tr style="border-bottom: 1px solid #E2E8F0; transition: background 0.15s;" onmouseover="this.style.background='#F8FAFC'" onmouseout="this.style.background='transparent'">
                                <td style="padding: 10px 14px; text-align: center; color: #64748B; font-weight: 600;">
                                    {{ $idx + 1 }}
                                </td>
                                <td style="padding: 10px 14px;">
                                    <div style="display: flex; align-items: center; gap: 8px;">
                                        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#0284C7" stroke-width="2" style="flex-shrink: 0;"><path stroke-linecap="round" stroke-linejoin="round" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"/></svg>
                                        <span style="font-family: monospace; font-size: 12px; font-weight: 700; color: #0F172A;">
                                            {{ $archive['filename'] }}
                                        </span>
                                    </div>
                                </td>
                                <td style="padding: 10px 14px;">
                                    @if($isManual)
                                        <span style="display: inline-block; padding: 2px 7px; background: #E0F2FE; color: #0369A1; border: 1px solid #BAE6FD; border-radius: 3px; font-size: 10.5px; font-weight: 700;">
                                            {{ $archive['label'] }}
                                        </span>
                                    @else
                                        <span style="display: inline-block; padding: 2px 7px; background: #DCFCE7; color: #166534; border: 1px solid #BBF7D0; border-radius: 3px; font-size: 10.5px; font-weight: 700;">
                                            {{ $archive['label'] }}
                                        </span>
                                    @endif
                                </td>
                                <td style="padding: 10px 14px; color: #334155; white-space: nowrap;">
                                    {{ \Carbon\Carbon::parse($archive['created_at'])->format('d M Y, H:i') }} WIB
                                </td>
                                <td style="padding: 10px 14px; font-weight: 700; color: #003B64; white-space: nowrap;">
                                    {{ $archive['size_formatted'] ?? '-' }}
                                </td>
                                <td style="padding: 10px 14px; white-space: nowrap;">
                                    @if(!empty($archive['email_sent']))
                                        <span style="display: inline-flex; align-items: center; gap: 4px; color: #166534; font-size: 11px; font-weight: 600;">
                                            <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                            Terkirim ke 2 Email
                                        </span>
                                    @else
                                        <span style="display: inline-flex; align-items: center; gap: 4px; color: #94A3B8; font-size: 11px;">
                                            Lokal Saja
                                        </span>
                                    @endif
                                </td>
                                <td style="padding: 10px 14px; text-align: right; white-space: nowrap;">
                                    <div style="display: flex; align-items: center; justify-content: flex-end; gap: 6px;">
                                        <a href="{{ route('admin_dpn.backup_archive.download', $archive['filename']) }}" class="btn btn-secondary" style="padding: 5px 10px; font-size: 11.5px; font-weight: 600; border-radius: 3px; display: inline-flex; align-items: center; gap: 4px;" title="Unduh Berkas SQL">
                                            <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                            Unduh
                                        </a>
                                        <form action="{{ route('admin_dpn.backup_archive.delete', $archive['filename']) }}" method="POST" style="margin: 0; display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus arsip cadangan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" style="padding: 5px 8px; font-size: 11.5px; border-radius: 3px;" title="Hapus Dari Rak Arsip">
                                                <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div style="padding: 10px 16px; background: #F8FAFC; border-top: 1px solid #E2E8F0; font-size: 11.5px; color: #64748B; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 8px;">
                <span>Total Arsip Tersimpan: <strong>{{ count($backupArchives) }} berkas</strong> (Maksimal 30 berkas rotasi otomatis)</span>
                <span>Format: <strong>SQL Dump (~2-3 MB)</strong></span>
            </div>
        @endif
    </div>
</div>
@endsection
