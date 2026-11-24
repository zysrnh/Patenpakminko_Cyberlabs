@extends('layouts.app')

@section('title', 'Kelola Peta INFORMAL - PATEN PAK MIKO')
@section('page-title', 'Kelola Peta INFORMAL')

@section('head-extra')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
@endsection

@section('extra-styles')
    @keyframes informalFadeUp {
        from { opacity: 0; transform: translateY(6px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    @keyframes informalSpin {
        to { transform: rotate(360deg); }
    }

    /* ─── HERO HEADER STRIP (FLAT) ─────────────────────── */
    .informal-hero {
        background: #FFFFFF;
        border: 1px solid #D6E4EF;
        border-radius: 4px;
        padding: 16px 20px;
        margin-bottom: 18px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        flex-wrap: wrap;
        animation: informalFadeUp .2s cubic-bezier(0.22, 1, 0.36, 1) both;
    }
    .informal-hero-meta {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
        margin-bottom: 6px;
    }
    .informal-hero-pill {
        font-size: 11px;
        font-weight: 700;
        color: #003B64;
        background: #E3F0F9;
        border: 1px solid #BFD9EC;
        padding: 2px 8px;
        border-radius: 4px;
        text-transform: uppercase;
        letter-spacing: 0.04em;
    }
    .informal-hero-count {
        font-size: 11px;
        font-weight: 700;
        color: #166534;
        background: #DCFCE7;
        border: 1px solid #BBF7D0;
        padding: 2px 8px;
        border-radius: 4px;
    }
    .informal-hero-title {
        font-size: 18px;
        font-weight: 800;
        color: #003B64;
        letter-spacing: -0.02em;
        margin: 0 0 3px;
    }
    .informal-hero-desc {
        font-size: 12.5px;
        color: #64748B;
        margin: 0;
    }
    .informal-public-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #FFFFFF;
        color: #003B64;
        border: 1px solid #CBD5E1;
        border-radius: 4px;
        padding: 8px 14px;
        font-size: 12.5px;
        font-weight: 700;
        text-decoration: none;
        transition: background .15s ease, border-color .15s ease;
    }
    .informal-public-btn:hover {
        background: #F1F5F9;
        border-color: #218AC9;
        color: #003B64;
    }

    /* ─── GRID 3 LAYER UTAMA ───────────────────────────── */
    .map-cards-container {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 16px;
        margin-bottom: 18px;
        align-items: stretch;
    }

    .clean-map-card {
        background: #FFFFFF;
        border: 1px solid #D6E4EF;
        border-radius: 4px;
        padding: 18px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        position: relative;
        overflow: hidden;
        transition: border-color .15s ease;
        animation: informalFadeUp .24s cubic-bezier(0.22, 1, 0.36, 1) both;
    }
    .clean-map-card:nth-child(2) { animation-delay: .04s; }
    .clean-map-card:nth-child(3) { animation-delay: .08s; }
    .clean-map-card:hover {
        border-color: #94B8D4;
    }
    .clean-map-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 3px;
    }
    .clean-map-card.lp2b::before { background: #064E3B; }
    .clean-map-card.lbs::before  { background: #218AC9; }
    .clean-map-card.lsd::before  { background: #16A34A; }

    .card-body-stack {
        display: flex;
        flex-direction: column;
        flex: 1;
    }
    .card-top-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 10px;
    }

    .card-tag {
        font-size: 11px;
        font-weight: 800;
        padding: 3px 8px;
        border-radius: 4px;
        letter-spacing: 0.04em;
        display: inline-flex;
        align-items: center;
    }
    .tag-lp2b { background: #D1FAE5; color: #064E3B; border: 1px solid #A7F3D0; }
    .tag-lbs  { background: #DBEAFE; color: #1E40AF; border: 1px solid #BFDBFE; }
    .tag-lsd  { background: #DCFCE7; color: #166534; border: 1px solid #BBF7D0; }

    .card-status-badge {
        font-size: 11px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }
    .status-dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        display: inline-block;
    }
    .status-dot.active { background: #16A34A; }
    .status-dot.inactive { background: #DC2626; }

    .card-title-text {
        font-size: 14.5px;
        font-weight: 800;
        color: #003B64;
        line-height: 1.35;
        min-height: 40px;
        margin-bottom: 4px;
    }
    .card-desc-text {
        font-size: 12px;
        color: #64748B;
        line-height: 1.45;
        min-height: 36px;
        margin-bottom: 14px;
    }

    .card-info-box {
        background: #F8FAFC;
        border: 1px solid #E2E8F0;
        border-radius: 4px;
        padding: 10px 12px;
        margin-top: auto;
        margin-bottom: 14px;
        font-size: 11.5px;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 8px 10px;
    }
    .info-label {
        font-size: 10px;
        color: #64748B;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        display: block;
        margin-bottom: 2px;
    }
    .info-value {
        color: #0F172A;
        font-weight: 700;
        font-size: 11.5px;
    }
    .info-row-full {
        grid-column: 1 / -1;
        border-top: 1px dashed #CBD5E1;
        padding-top: 7px;
        margin-top: 1px;
    }
    .info-inline-meta {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: 11px;
        font-weight: 600;
        color: #003B64;
        word-break: break-all;
    }
    .info-backup-strip {
        grid-column: 1 / -1;
        background: #FFFBEB;
        border: 1px solid #FDE68A;
        padding: 6px 8px;
        border-radius: 4px;
    }
    .info-backup-strip .info-label { color: #92400E; margin-bottom: 1px; }
    .info-backup-name {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: 10.5px;
        color: #92400E;
        word-break: break-all;
        font-family: 'DM Mono', monospace;
        font-weight: 600;
    }

    .card-btn-group {
        display: grid;
        grid-template-columns: 1.4fr 1fr 1fr;
        gap: 6px;
    }
    .card-btn-group--compact {
        grid-template-columns: 1fr 1fr;
    }
    .card-btn-group--single {
        grid-template-columns: 1fr;
    }
    .btn-upload-action {
        background: #218AC9;
        color: #FFFFFF;
        border: none;
        padding: 8px 10px;
        border-radius: 4px;
        font-family: inherit;
        font-size: 12px;
        font-weight: 700;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
        transition: background .15s ease;
    }
    .btn-upload-action:hover { background: #003B64; }

    .btn-backup-action {
        background: #FFFFFF;
        color: #334155;
        border: 1px solid #CBD5E1;
        padding: 8px 8px;
        border-radius: 4px;
        font-size: 11.5px;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 4px;
        transition: background .15s ease, color .15s ease;
    }
    .btn-backup-action:hover { background: #F1F5F9; color: #003B64; }

    .btn-delete-action {
        background: #FEF2F2;
        color: #DC2626;
        border: 1px solid #FECACA;
        padding: 8px 8px;
        border-radius: 4px;
        font-family: inherit;
        font-size: 11.5px;
        font-weight: 700;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 4px;
        transition: background .15s ease, color .15s ease, border-color .15s ease;
    }
    .btn-delete-action:hover {
        background: #DC2626;
        color: #FFFFFF;
        border-color: #DC2626;
    }

    .btn-restore-action {
        width: 100%;
        background: #F0FDF4;
        color: #166534;
        border: 1px solid #BBF7D0;
        padding: 8px 10px;
        border-radius: 4px;
        font-family: inherit;
        font-size: 11.5px;
        font-weight: 700;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
        transition: background .15s ease, color .15s ease;
    }
    .btn-restore-action:hover {
        background: #16A34A;
        color: #FFFFFF;
        border-color: #16A34A;
    }

    /* ─── SECTION PREVIEW PETA ─────────────────────────── */
    .preview-map-card {
        background: #FFFFFF;
        border: 1px solid #D6E4EF;
        border-radius: 4px;
        padding: 18px 20px;
        animation: informalFadeUp .28s cubic-bezier(0.22, 1, 0.36, 1) .06s both;
    }

    .preview-top-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
        padding-bottom: 12px;
        margin-bottom: 14px;
        border-bottom: 1px solid #E8F0F6;
    }

    .preview-title {
        font-size: 14.5px;
        font-weight: 800;
        color: #003B64;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .preview-filters {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
        font-size: 12px;
        font-weight: 700;
    }
    .filter-chip {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 4px 10px;
        border: 1px solid #CBD5E1;
        border-radius: 4px;
        background: #F8FAFC;
        cursor: pointer;
        font-size: 11.5px;
        font-weight: 700;
        user-select: none;
        transition: background .15s ease, border-color .15s ease;
    }
    .filter-chip:hover { background: #E3F0F9; border-color: #94B8D4; }
    .filter-chip input { margin: 0; accent-color: #003B64; cursor: pointer; }
    .filter-focus-btn {
        background: #003B64;
        color: #FFFFFF;
        border: none;
        border-radius: 4px;
        font-family: inherit;
        font-size: 11.5px;
        font-weight: 700;
        padding: 5px 11px;
        cursor: pointer;
        transition: background .15s ease;
    }
    .filter-focus-btn:hover { background: #218AC9; }

    #adminPreviewMap {
        width: 100%;
        height: 460px;
        border-radius: 4px;
        border: 1px solid #CBD5E1;
        background: #E2E8F0;
    }
    .preview-footer-bar {
        margin-top: 10px;
        font-size: 11.5px;
        color: #64748B;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 8px;
    }

    /* ─── MODAL UPLOAD (FLAT) ──────────────────────────── */
    .modal-backdrop-custom {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(15, 23, 42, 0.55);
        z-index: 99999;
        align-items: center;
        justify-content: center;
        padding: 16px;
    }
    .modal-backdrop-custom.open {
        display: flex;
    }

    .modal-box-custom {
        background: #FFFFFF;
        border-radius: 4px;
        width: 100%;
        max-width: 480px;
        overflow: hidden;
        border: 1px solid #CBD5E1;
        animation: informalFadeUp 0.18s ease-out both;
    }

    .modal-head {
        background: #003B64;
        color: #FFFFFF;
        padding: 14px 18px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .modal-head h3 {
        font-size: 14.5px;
        font-weight: 700;
        margin: 0;
    }
    .modal-close-btn {
        background: rgba(255,255,255,0.12);
        border: 1px solid rgba(255,255,255,0.22);
        color: #FFFFFF;
        font-size: 16px;
        line-height: 1;
        cursor: pointer;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 28px;
        height: 28px;
        border-radius: 4px;
    }
    .modal-close-btn:hover { background: rgba(255,255,255,0.22); }

    .modal-body {
        padding: 18px 20px 20px;
    }

    .simple-dropzone {
        border: 1.5px dashed #94B8D4;
        border-radius: 4px;
        padding: 26px 18px;
        text-align: center;
        background: #F8FAFC;
        cursor: pointer;
        transition: border-color .15s ease, background .15s ease;
    }
    .simple-dropzone:hover,
    .simple-dropzone.is-dragover {
        border-color: #218AC9;
        background: #E3F0F9;
    }
    .dropzone-icon {
        width: 36px;
        height: 36px;
        color: #218AC9;
        margin-bottom: 8px;
    }

    .modal-safety-note {
        background: #F0FDF4;
        border: 1px solid #BBF7D0;
        border-radius: 4px;
        padding: 10px 12px;
        margin-top: 14px;
        font-size: 11.5px;
        color: #166534;
        line-height: 1.5;
        display: flex;
        align-items: flex-start;
        gap: 8px;
    }

    .btn-submit-modal {
        width: 100%;
        background: #003B64;
        color: #FFFFFF;
        border: none;
        padding: 10px 14px;
        border-radius: 4px;
        font-family: inherit;
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        margin-top: 14px;
        transition: background 0.15s ease;
    }
    .btn-submit-modal:hover { background: #218AC9; }

    @media (max-width: 1080px) {
        .map-cards-container {
            grid-template-columns: 1fr;
        }
        .card-title-text,
        .card-desc-text {
            min-height: 0;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .informal-hero, .clean-map-card, .preview-map-card, .modal-box-custom {
            animation: none !important;
            transition: none !important;
        }
    }
@endsection

@section('content')
    @php
        $mainKeys = ['lp2b', 'lbs', 'lsd'];
        $activeLayerCount = 0;
        foreach ($mainKeys as $mk) {
            if (!empty($layers[$mk]['exists'])) {
                $activeLayerCount++;
            }
        }
    @endphp

    <!-- Hero Strip Flat -->
    <div class="informal-hero">
        <div>
            <div class="informal-hero-meta">
                <span class="informal-hero-pill">Pengelolaan Layer Spasial</span>
                <span class="informal-hero-count">{{ $activeLayerCount }} / {{ count($mainKeys) }} Layer Terpasang</span>
            </div>
            <h1 class="informal-hero-title">Kelola Data Peta INFORMAL</h1>
            <p class="informal-hero-desc">Perbarui data poligon LP2B, LBS, dan LSD menggunakan file GeoJSON atau Shapefile (.zip).</p>
        </div>
        <a href="{{ route('informal.index') }}" target="_blank" class="informal-public-btn">
            <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
            </svg>
            <span>Buka Peta Publik INFORMAL</span>
        </a>
    </div>

    <!-- 3 Card Utama (LP2B, LBS, LSD) -->
    <div class="map-cards-container">
        @foreach($mainKeys as $k)
            @if(isset($layers[$k]))
                @php
                    $l = $layers[$k];
                    $hasBackup = !$l['exists'] && !empty($l['latest_backup_file']);
                    $btnGroupClass = $l['exists'] ? 'card-btn-group' : ($hasBackup ? 'card-btn-group card-btn-group--compact' : 'card-btn-group card-btn-group--single');
                @endphp
                <div class="clean-map-card {{ $k }}">
                    <div class="card-body-stack">
                        <div class="card-top-row">
                            <span class="card-tag tag-{{ $k }}">{{ $l['short_name'] }}</span>
                            <span class="card-status-badge" style="color: {{ $l['exists'] ? '#166534' : '#DC2626' }};">
                                <span class="status-dot {{ $l['exists'] ? 'active' : 'inactive' }}"></span>
                                {{ $l['exists'] ? 'Terpasang' : 'Belum Ada' }}
                            </span>
                        </div>

                        <div class="card-title-text">{{ $l['name'] }}</div>
                        <div class="card-desc-text">{{ $l['description'] }}</div>

                        <div class="card-info-box">
                            <div>
                                <span class="info-label">Ukuran Data</span>
                                <span class="info-value">{{ $l['size_human'] }}</span>
                            </div>
                            <div>
                                <span class="info-label">Pembaruan</span>
                                <span class="info-value">{{ $l['updated_at'] }}</span>
                            </div>
                            @if(!empty($l['original_filename']))
                                <div class="info-row-full">
                                    <span class="info-label">File Sumber Diupload</span>
                                    <span class="info-inline-meta">
                                        <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                                        <span>{{ $l['original_filename'] }}</span>
                                    </span>
                                </div>
                            @endif
                            @if(!empty($l['latest_backup_file']))
                                <div class="info-backup-strip">
                                    <span class="info-label">Cadangan Terakhir</span>
                                    <span class="info-backup-name">
                                        <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="flex-shrink:0;"><path stroke-linecap="round" stroke-linejoin="round" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/></svg>
                                        <span>{{ $l['latest_backup_file'] }}</span>
                                    </span>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="{{ $btnGroupClass }}">
                        <button type="button" class="btn-upload-action" onclick="openUploadModal('{{ $k }}', '{{ $l['name'] }}')">
                            <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                            <span>{{ $l['exists'] ? 'Ganti File' : 'Upload File' }}</span>
                        </button>
                        @if($l['exists'])
                            <a href="{{ route('admin.informal_map.download', $k) }}" class="btn-backup-action" title="Unduh backup file data aktif ke perangkat">
                                <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                <span>Backup</span>
                            </a>
                            <button type="button" class="btn-delete-action" onclick="confirmDeleteLayer('{{ $k }}', '{{ $l['short_name'] }}')" title="Hapus file data dari peta aktif (otomatis dicadangkan)">
                                <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                <span>Hapus</span>
                            </button>
                        @elseif(!empty($l['latest_backup_file']))
                            <form action="{{ route('admin.informal_map.restore', $k) }}" method="POST" style="margin: 0;" onsubmit="return confirm('Pulihkan data layer {{ $l['short_name'] }} dari cadangan terakhir ({{ $l['latest_backup_file'] }})?')">
                                @csrf
                                <button type="submit" class="btn-restore-action" title="Pulihkan kembali dari file cadangan terakhir">
                                    <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                                    <span>Pulihkan</span>
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @endif
        @endforeach
    </div>

    <!-- Section Live Preview Peta -->
    <div class="preview-map-card">
        <div class="preview-top-bar">
            <div class="preview-title">
                <svg width="17" height="17" style="color:#218AC9;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <polygon points="1 6 1 22 8 18 16 22 23 18 23 2 16 6 8 2 1 6"></polygon>
                    <line x1="8" y1="2" x2="8" y2="18"></line>
                    <line x1="16" y1="6" x2="16" y2="22"></line>
                </svg>
                <span>Pratinjau Peta INFORMAL (Kota Sukabumi)</span>
            </div>

            <div class="preview-filters">
                <label class="filter-chip" style="color:#064E3B;">
                    <input type="checkbox" id="toggle-lp2b" checked onchange="toggleLayer('lp2b')">
                    <span style="width:10px; height:10px; background:#064E3B; display:inline-block; border-radius:2px;"></span>
                    <span>LP2B</span>
                </label>
                <label class="filter-chip" style="color:#1E40AF;">
                    <input type="checkbox" id="toggle-lbs" checked onchange="toggleLayer('lbs')">
                    <span style="width:10px; height:10px; background:#218AC9; display:inline-block; border-radius:2px;"></span>
                    <span>LBS</span>
                </label>
                <label class="filter-chip" style="color:#166534;">
                    <input type="checkbox" id="toggle-lsd" checked onchange="toggleLayer('lsd')">
                    <span style="width:10px; height:10px; background:#16A34A; display:inline-block; border-radius:2px;"></span>
                    <span>LSD</span>
                </label>
                <label class="filter-chip" style="color:#003B64;">
                    <input type="checkbox" id="toggle-bounds" checked onchange="toggleLayer('sukabumi_bounds')">
                    <span style="width:10px; height:10px; border:1.5px dashed #003B64; display:inline-block; border-radius:2px;"></span>
                    <span>Batas Kota</span>
                </label>
                <button type="button" class="filter-focus-btn" onclick="fitSukabumi()">Fokus Sukabumi</button>
            </div>
        </div>

        <div id="adminPreviewMap"></div>
        <div class="preview-footer-bar">
            <span>Klik poligon pada peta untuk melihat koordinat dan atribut layer spasial.</span>
            <span id="previewStatus" style="font-weight:700; color:#003B64;">Memuat layer spasial...</span>
        </div>
    </div>

    <!-- MODAL POPUP UPLOAD FILE -->
    <div id="uploadModal" class="modal-backdrop-custom" onclick="if(event.target === this) closeUploadModal()">
        <div class="modal-box-custom" role="dialog" aria-modal="true" aria-labelledby="modalTitle">
            <div class="modal-head">
                <h3 id="modalTitle">Upload File Peta</h3>
                <button type="button" class="modal-close-btn" onclick="closeUploadModal()" aria-label="Tutup">&times;</button>
            </div>

            <form action="{{ route('admin.informal_map.upload') }}" method="POST" enctype="multipart/form-data" id="modalUploadForm">
                @csrf
                <input type="hidden" name="layer_key" id="modalLayerKey" value="">

                <div class="modal-body">
                    <div style="font-size:13px; color:#334155; margin-bottom:12px;">
                        Pembaruan data untuk layer: <strong id="modalLayerName" style="color:#003B64;">-</strong>
                    </div>

                    <div id="simpleDropzone" class="simple-dropzone" onclick="document.getElementById('modalFileInput').click()">
                        <svg class="dropzone-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                        </svg>
                        <div id="dropzoneMainText" style="font-size:13.5px; font-weight:700; color:#003B64; margin-bottom:4px;">Klik atau seret file ke area ini</div>
                        <div style="font-size:11.5px; color:#64748B;">Format didukung: <strong>.geojson</strong>, <strong>.json</strong>, atau <strong>.zip (Shapefile)</strong></div>
                        <div id="dropzoneSelectedFile" style="font-size:12px; font-weight:700; color:#003B64; margin-top:10px; display:none; background:#E3F0F9; border:1px solid #BFD9EC; padding:6px 10px; border-radius:4px;"></div>
                    </div>
                    <input type="file" name="map_file" id="modalFileInput" style="display:none;" accept=".geojson,.json,.zip" required onchange="handleModalFileChange(this)">

                    <div class="modal-safety-note">
                        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#16A34A" stroke-width="2" style="flex-shrink:0; margin-top:1px;">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                        <span><strong>Backup Otomatis:</strong> File aktif di server otomatis dicadangkan sebagai <code>[layer]_bak_[tanggal]_[jam].geojson</code> sebelum ditimpa file baru.</span>
                    </div>

                    <button type="submit" id="btnSubmitModal" class="btn-submit-modal">
                        <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        <span>Simpan &amp; Terapkan ke Peta</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Form Hapus Layer Tersembunyi -->
    <form id="deleteLayerForm" method="POST" style="display:none;">
        @csrf
    </form>
@endsection

@section('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script>
    let map;
    let layersData = @json($layers);
    let mapLayers = {};

    function confirmDeleteLayer(layerKey, layerName) {
        if (confirm('Apakah Anda yakin ingin MENGHAPUS layer ' + layerName + ' dari peta?\n\nFile data aktif akan otomatis dicadangkan ke folder backup terlebih dahulu.')) {
            const form = document.getElementById('deleteLayerForm');
            form.action = "{{ url('admin/informal-map/delete') }}/" + layerKey;
            form.submit();
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        initMap();
        loadAllLayers();
        initDropzoneDragAndDrop();
    });

    function initMap() {
        map = L.map('adminPreviewMap', {
            center: [-6.9237, 106.9287],
            zoom: 13,
            scrollWheelZoom: true
        });

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; OpenStreetMap & PATEN PAK MIKO'
        }).addTo(map);

        setTimeout(() => { map.invalidateSize(); }, 250);
        window.addEventListener('resize', () => { map.invalidateSize(); });
    }

    function loadAllLayers() {
        const statusEl = document.getElementById('previewStatus');
        let loadedCount = 0;
        let total = Object.keys(layersData).length;

        Object.keys(layersData).forEach(key => {
            const l = layersData[key];
            if (!l.exists) {
                loadedCount++;
                if (loadedCount >= total) {
                    statusEl.innerText = 'Semua layer tersedia telah dimuat.';
                }
                return;
            }

            fetch(l.url)
                .then(res => res.json())
                .then(geojson => {
                    const style = {
                        color: l.color,
                        weight: l.weight || 2,
                        fillColor: l.fillColor || l.color,
                        fillOpacity: key === 'sukabumi_bounds' ? 0 : (l.opacity || 0.5),
                        dashArray: key === 'sukabumi_bounds' ? '5, 5' : null
                    };

                    const layerObj = L.geoJSON(geojson, {
                        style: style,
                        onEachFeature: function(feature, layer) {
                            layer.on('click', function(e) {
                                const lat = e.latlng.lat.toFixed(5);
                                const lng = e.latlng.lng.toFixed(5);
                                const name = l.short_name;
                                let propsHtml = '';
                                if (feature.properties) {
                                    const sampleProps = Object.entries(feature.properties).slice(0, 3);
                                    sampleProps.forEach(([k, v]) => {
                                        propsHtml += `<div style="font-size:10.5px;color:#475569;"><strong>${k}:</strong> ${v}</div>`;
                                    });
                                }
                                layer.bindPopup(`
                                    <div style="min-width:160px; font-family:sans-serif;">
                                        <strong style="color:${l.color}; font-size:12px;">Area ${name}</strong>
                                        <div style="font-size:11px; color:#64748B; margin-top:2px;">Koord: ${lat}, ${lng}</div>
                                        <hr style="margin:4px 0; border:0; border-top:1px solid #E2E8F0;">
                                        ${propsHtml}
                                    </div>
                                `).openPopup(e.latlng);
                            });
                        }
                    });

                    mapLayers[key] = layerObj;
                    layerObj.addTo(map);

                    loadedCount++;
                    if (loadedCount >= total) {
                        statusEl.innerText = 'Semua data spasial berhasil dimuat.';
                    }
                })
                .catch(err => {
                    console.error('Gagal memuat layer ' + key, err);
                    loadedCount++;
                });
        });
    }

    function toggleLayer(key) {
        const chk = document.getElementById('toggle-' + (key === 'sukabumi_bounds' ? 'bounds' : key));
        if (!chk || !mapLayers[key]) return;

        if (chk.checked) {
            map.addLayer(mapLayers[key]);
        } else {
            map.removeLayer(mapLayers[key]);
        }
    }

    function fitSukabumi() {
        if (mapLayers['sukabumi_bounds']) {
            map.fitBounds(mapLayers['sukabumi_bounds'].getBounds());
        } else {
            map.setView([-6.9237, 106.9287], 13);
        }
    }

    function openUploadModal(layerKey, layerName) {
        document.getElementById('modalLayerKey').value = layerKey;
        document.getElementById('modalLayerName').innerText = layerName;
        document.getElementById('modalTitle').innerText = 'Upload File: ' + layerName;
        document.getElementById('modalFileInput').value = '';
        document.getElementById('dropzoneSelectedFile').style.display = 'none';
        document.getElementById('dropzoneMainText').innerText = 'Klik atau seret file ke area ini';

        document.getElementById('uploadModal').classList.add('open');
    }

    function closeUploadModal() {
        document.getElementById('uploadModal').classList.remove('open');
    }

    function handleModalFileChange(input) {
        if (input.files && input.files[0]) {
            const file = input.files[0];
            const selEl = document.getElementById('dropzoneSelectedFile');
            const mainText = document.getElementById('dropzoneMainText');
            selEl.style.display = 'block';
            selEl.innerText = 'File dipilih: ' + file.name + ' (' + (file.size / (1024 * 1024)).toFixed(2) + ' MB)';
            mainText.innerText = 'Ganti File Lain';
        }
    }

    function initDropzoneDragAndDrop() {
        const dropzone = document.getElementById('simpleDropzone');
        const fileInput = document.getElementById('modalFileInput');
        if (!dropzone || !fileInput) return;

        ['dragenter', 'dragover'].forEach(evt => {
            dropzone.addEventListener(evt, e => {
                e.preventDefault();
                e.stopPropagation();
                dropzone.classList.add('is-dragover');
            });
        });

        ['dragleave', 'drop'].forEach(evt => {
            dropzone.addEventListener(evt, e => {
                e.preventDefault();
                e.stopPropagation();
                dropzone.classList.remove('is-dragover');
            });
        });

        dropzone.addEventListener('drop', e => {
            const dt = e.dataTransfer;
            if (dt && dt.files && dt.files.length > 0) {
                fileInput.files = dt.files;
                handleModalFileChange(fileInput);
            }
        });
    }

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeUploadModal();
        }
    });

    document.getElementById('modalUploadForm').addEventListener('submit', function() {
        const btn = document.getElementById('btnSubmitModal');
        btn.disabled = true;
        btn.innerHTML = '<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" style="animation:informalSpin .8s linear infinite;"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg><span>Menyimpan &amp; Mengonversi File...</span>';
    });
</script>
@endsection
