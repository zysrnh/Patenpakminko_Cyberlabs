@extends('layouts.app')

@section('title', 'Pengelolaan Dokumen - PATEN PAK MIKO')
@section('page-title', 'Pengelolaan Dokumen')

@section('extra-styles')
    @keyframes docFadeUp {
        from { opacity: 0; transform: translateY(5px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .doc-hero {
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
        animation: docFadeUp .2s cubic-bezier(0.22, 1, 0.36, 1) both;
    }
    .doc-hero-title {
        font-size: 17px;
        font-weight: 800;
        color: #003B64;
        letter-spacing: -0.02em;
        margin: 0 0 2px;
    }
    .doc-hero-sub {
        font-size: 12.5px;
        color: #64748B;
        margin: 0;
    }
    .doc-toggle-upload {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #003B64;
        color: #FFFFFF;
        border: none;
        border-radius: 4px;
        padding: 8px 14px;
        font-family: inherit;
        font-size: 12.5px;
        font-weight: 700;
        cursor: pointer;
        transition: background .15s ease;
    }
    .doc-toggle-upload:hover { background: #218AC9; }

    /* Collapsible Upload Drawer */
    .doc-upload-drawer {
        display: none;
        background: #FFFFFF;
        border: 1px solid #D6E4EF;
        border-radius: 4px;
        margin-bottom: 14px;
        overflow: hidden;
        animation: docFadeUp .18s ease-out both;
    }
    .doc-upload-drawer.is-open { display: block; }
    .doc-drawer-head {
        padding: 12px 16px;
        background: #F8FAFC;
        border-bottom: 1px solid #E8F0F6;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .doc-drawer-head h2 {
        font-size: 14px;
        font-weight: 800;
        color: #003B64;
        margin: 0;
    }
    .doc-upload-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 12px;
        margin-bottom: 12px;
    }

    /* Main Table Panel */
    .doc-panel {
        background: #FFFFFF;
        border: 1px solid #D6E4EF;
        border-radius: 4px;
        overflow: hidden;
        animation: docFadeUp .24s cubic-bezier(0.22, 1, 0.36, 1) .04s both;
    }
    .doc-panel-head {
        padding: 13px 16px;
        background: #F8FAFC;
        border-bottom: 1px solid #E8F0F6;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        flex-wrap: wrap;
    }
    .doc-panel-head h2 {
        font-size: 14.5px;
        font-weight: 800;
        color: #003B64;
        margin: 0;
    }
    .doc-total-pill {
        font-size: 11.5px;
        font-weight: 700;
        color: #003B64;
        background: #E3F0F9;
        border: 1px solid #BFD9EC;
        padding: 2px 8px;
        border-radius: 4px;
    }

    /* Filter Bar Grid */
    .doc-filter-bar {
        padding: 12px 16px;
        border-bottom: 1px solid #E8F0F6;
        background: #FFFFFF;
    }
    .doc-filter-form {
        display: grid;
        grid-template-columns: minmax(180px, 1.5fr) minmax(140px, 1fr) 140px minmax(150px, 1fr) auto;
        gap: 8px;
        align-items: center;
    }
    .doc-input, .doc-select {
        width: 100%;
        height: 34px;
        padding: 0 10px;
        border: 1px solid #CBD5E1;
        border-radius: 4px;
        font-family: inherit;
        font-size: 12.5px;
        color: #0F172A;
        background: #FFFFFF;
        outline: none;
    }
    .doc-input:focus, .doc-select:focus { border-color: #218AC9; }
    .doc-filter-actions {
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .doc-btn-filter {
        height: 34px;
        padding: 0 13px;
        border: 1px solid #003B64;
        background: #003B64;
        color: #FFFFFF;
        border-radius: 4px;
        font-family: inherit;
        font-size: 12px;
        font-weight: 700;
        cursor: pointer;
    }
    .doc-btn-filter:hover { background: #218AC9; border-color: #218AC9; }
    .doc-btn-reset {
        height: 34px;
        padding: 0 11px;
        border: 1px solid #CBD5E1;
        background: #FFFFFF;
        color: #475569;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
    }
    .doc-btn-reset:hover { background: #F1F5F9; color: #0F172A; }

    /* Batch Bar */
    .doc-batch-bar {
        padding: 10px 16px;
        border-bottom: 1px solid #E8F0F6;
        background: #F8FAFC;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }
    .doc-batch-btns {
        display: flex;
        align-items: center;
        gap: 6px;
        flex-wrap: wrap;
    }
    .doc-btn-batch {
        height: 30px;
        padding: 0 11px;
        border-radius: 4px;
        border: none;
        font-family: inherit;
        font-size: 11.5px;
        font-weight: 700;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        color: #FFFFFF;
    }
    .doc-btn-batch:disabled { opacity: 0.45; cursor: not-allowed; }
    .doc-btn-batch--dl { background: #218AC9; }
    .doc-btn-batch--dl:hover:not(:disabled) { background: #003B64; }
    .doc-btn-batch--del { background: #DC2626; }
    .doc-btn-batch--del:hover:not(:disabled) { background: #B91C1C; }
    .doc-btn-batch--all { background: #991B1B; }
    .doc-btn-batch--all:hover { background: #7F1D1D; }

    /* Table */
    .doc-table-wrap { width: 100%; overflow-x: auto; }
    .doc-table {
        width: 100%;
        border-collapse: collapse;
        table-layout: fixed;
    }
    .doc-table th {
        padding: 10px 12px;
        font-size: 10.5px;
        font-weight: 800;
        color: #475569;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        background: #F8FAFC;
        border-bottom: 1px solid #D6E4EF;
        text-align: left;
    }
    .doc-table td {
        padding: 10px 12px;
        border-bottom: 1px solid #EFF4F8;
        vertical-align: middle;
        font-size: 12.5px;
    }
    .doc-table tbody tr:hover { background: #F8FAFC; }

    .doc-title-txt {
        font-weight: 700;
        color: #003B64;
        display: block;
        word-break: break-word;
    }
    .doc-sub-txt {
        font-size: 11px;
        color: #64748B;
        margin-top: 2px;
        display: block;
    }
    .doc-cat-badge {
        display: inline-block;
        padding: 3px 8px;
        border-radius: 4px;
        background: #F1F5F9;
        border: 1px solid #CBD5E1;
        color: #334155;
        font-size: 11px;
        font-weight: 600;
        max-width: 100%;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    .doc-ext-badge {
        display: inline-block;
        padding: 2px 6px;
        border-radius: 4px;
        background: #E3F0F9;
        color: #003B64;
        font-size: 10.5px;
        font-weight: 800;
    }
    .doc-row-actions {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 5px;
        flex-wrap: nowrap;
    }
    .doc-act-btn {
        height: 28px;
        padding: 0 9px;
        border-radius: 4px;
        font-size: 11.5px;
        font-weight: 700;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        border: 1px solid transparent;
        white-space: nowrap;
    }
    .doc-act-view { background: #F1F5F9; color: #334155; border-color: #CBD5E1; }
    .doc-act-view:hover { background: #E2E8F0; color: #003B64; }
    .doc-act-dl { background: #218AC9; color: #FFFFFF; }
    .doc-act-dl:hover { background: #003B64; color: #FFFFFF; }
    .doc-act-del { background: #FEF2F2; color: #DC2626; border-color: #FECACA; }
    .doc-act-del:hover { background: #DC2626; color: #FFFFFF; border-color: #DC2626; }

    /* Pagination */
    .doc-pag-bar {
        padding: 12px 16px;
        background: #F8FAFC;
        border-top: 1px solid #E8F0F6;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 10px;
    }
    .pagination { display: flex; list-style: none; gap: 4px; margin: 0; padding: 0; flex-wrap: wrap; }
    .page-item .page-link {
        padding: 5px 10px;
        border: 1px solid #CBD5E1;
        border-radius: 4px;
        color: #003B64;
        font-size: 12px;
        font-weight: 700;
        text-decoration: none;
        background: #FFFFFF;
        display: inline-flex;
    }
    .page-item.active .page-link { background: #003B64; color: #FFFFFF; border-color: #003B64; }
    .page-item.disabled .page-link { color: #94A3B8; background: #F1F5F9; cursor: not-allowed; }

    @media (max-width: 1080px) {
        .doc-filter-form { grid-template-columns: 1fr 1fr; }
        .doc-upload-grid { grid-template-columns: 1fr; }
        .doc-table { table-layout: auto; min-width: 820px; }
    }
    @media (max-width: 640px) {
        .doc-filter-form { grid-template-columns: 1fr; }
    }
    @media (prefers-reduced-motion: reduce) {
        .doc-hero, .doc-upload-drawer, .doc-panel { animation: none !important; }
    }
@endsection

@section('content')
    <div class="doc-hero">
        <div>
            <h1 class="doc-hero-title">Pengelolaan Dokumen</h1>
            <p class="doc-hero-sub">Arsip terpusat berkas persyaratan &amp; dokumen terbit dari seluruh layanan permohonan.</p>
        </div>
        <button type="button" class="doc-toggle-upload" onclick="toggleDocUploadDrawer(this)">
            <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
            <span>Unggah Dokumen</span>
        </button>
    </div>

    @if($errors->any())
        <div class="alert alert-error" style="border-radius: 4px; margin-bottom: 14px;">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            <ul style="margin-left: 16px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Collapsible Form Upload -->
    <div id="docUploadDrawer" class="doc-upload-drawer">
        <div class="doc-drawer-head">
            <h2>Unggah Dokumen Baru</h2>
            <button type="button" onclick="toggleDocUploadDrawer()" style="background:none;border:none;font-size:18px;color:#64748B;cursor:pointer;line-height:1;">&times;</button>
        </div>
        <form action="{{ route('dokumen.store') }}" method="POST" enctype="multipart/form-data" style="padding: 16px;">
            @csrf
            <div class="doc-upload-grid">
                <div>
                    <label class="form-label" style="font-size:12px;font-weight:700;color:#003B64;display:block;margin-bottom:5px;">Nama Pemohon / Judul</label>
                    <input type="text" name="nama_dokumen" class="doc-input" required placeholder="Contoh: PT Telkom Persero Tbk">
                </div>
                <div>
                    <label class="form-label" style="font-size:12px;font-weight:700;color:#003B64;display:block;margin-bottom:5px;">Kategori</label>
                    <select name="kategori" class="doc-select" required {!! request('kategori') ? 'style="pointer-events: none; background: #F1F5F9; color: #64748B;" tabindex="-1"' : '' !!}>
                        <option value="">-- Pilih Jenis Dokumen --</option>
                        <option value="PKKPR Otomatis" {{ request('kategori') == 'PKKPR Otomatis' ? 'selected' : '' }}>PKKPR Otomatis</option>
                        <option value="Peta Lokasi" {{ request('kategori') == 'Peta Lokasi' ? 'selected' : '' }}>Peta Lokasi</option>
                        <option value="Surat Kuasa" {{ request('kategori') == 'Surat Kuasa' ? 'selected' : '' }}>Surat Kuasa</option>
                        <option value="FC KTP" {{ request('kategori') == 'FC KTP' ? 'selected' : '' }}>FC KTP / Identitas</option>
                        <option value="FC NPWP" {{ request('kategori') == 'FC NPWP' ? 'selected' : '' }}>FC NPWP</option>
                        <option value="FC Akta Pendirian" {{ request('kategori') == 'FC Akta Pendirian' ? 'selected' : '' }}>FC Akta Pendirian</option>
                        <option value="Rencana Penggunaan Tanah" {{ request('kategori') == 'Rencana Penggunaan Tanah' ? 'selected' : '' }}>Rencana Penggunaan Tanah</option>
                        <option value="NIB" {{ request('kategori') == 'NIB' ? 'selected' : '' }}>NIB</option>
                        <option value="KBLI" {{ request('kategori') == 'KBLI' ? 'selected' : '' }}>KBLI</option>
                        <option value="Proposal Kegiatan" {{ request('kategori') == 'Proposal Kegiatan' ? 'selected' : '' }}>Proposal Kegiatan</option>
                        <option value="Formulir PTP" {{ request('kategori') == 'Formulir PTP' ? 'selected' : '' }}>Formulir PTP</option>
                        <option value="Pertimbangan Teknis Berusaha" {{ request('kategori') == 'Pertimbangan Teknis Berusaha' ? 'selected' : '' }}>Pertimbangan Teknis Berusaha</option>
                        <option value="Pertimbangan Teknis Non Berusaha" {{ request('kategori') == 'Pertimbangan Teknis Non Berusaha' ? 'selected' : '' }}>Pertimbangan Teknis Non Berusaha</option>
                        <option value="Pertimbangan Teknis Kebijakan" {{ request('kategori') == 'Pertimbangan Teknis Kebijakan' ? 'selected' : '' }}>Pertimbangan Teknis Kebijakan</option>
                        <option value="Pertimbangan Teknis Tanah Timbul" {{ request('kategori') == 'Pertimbangan Teknis Tanah Timbul' ? 'selected' : '' }}>Pertimbangan Teknis Tanah Timbul</option>
                        <option value="Pertimbangan Teknis PSN" {{ request('kategori') == 'Pertimbangan Teknis PSN' ? 'selected' : '' }}>Pertimbangan Teknis PSN</option>
                        <option value="Dokumen Penilaian (PU)" {{ request('kategori') == 'Dokumen Penilaian (PU)' ? 'selected' : '' }}>Dokumen Penilaian (PU)</option>
                        <option value="Persyaratan Lainnya" {{ request('kategori') == 'Persyaratan Lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                </div>
                <div>
                    <label class="form-label" style="font-size:12px;font-weight:700;color:#003B64;display:block;margin-bottom:5px;">File (PDF/JPG/PNG/DOCX, Maks 100MB)</label>
                    <input type="file" name="file" class="doc-input" style="padding:4px 8px;" required accept=".pdf,.jpg,.jpeg,.png,.doc,.docx,.xls,.xlsx">
                </div>
            </div>
            <div style="display:flex; gap:10px; align-items:flex-end; flex-wrap:wrap;">
                <div style="flex:1; min-width:220px;">
                    <label class="form-label" style="font-size:12px;font-weight:700;color:#003B64;display:block;margin-bottom:5px;">Keterangan (Opsional)</label>
                    <input type="text" name="keterangan" class="doc-input" placeholder="Catatan singkat dokumen...">
                </div>
                <button type="submit" class="doc-btn-filter" style="height:34px; padding:0 18px;">Simpan Dokumen</button>
            </div>
        </form>
    </div>

    <!-- Panel Daftar Dokumen -->
    <div class="doc-panel">
        <div class="doc-panel-head">
            <h2>Daftar Dokumen Tersimpan</h2>
            <div style="display:flex; align-items:center; gap:8px; flex-wrap:wrap;">
                <span class="doc-total-pill">{{ number_format($dokumen->total()) }} Dokumen</span>
                @if(request('user_id'))
                    <form action="{{ route('dokumen.download_zip') }}" method="POST" style="margin:0;">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ request('user_id') }}">
                        <button type="submit" class="doc-btn-batch" style="background:#16A34A; height:28px;">
                            <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                            <span>Unduh ZIP Pemohon</span>
                        </button>
                    </form>
                @endif
            </div>
        </div>

        <!-- Bar Filter 1 Baris Rapi -->
        <div class="doc-filter-bar">
            <form action="{{ route('dokumen.index') }}" method="GET" class="doc-filter-form">
                <input type="text" name="search" class="doc-input" placeholder="Cari nama dokumen atau pengunggah..." value="{{ request('search') }}">
                <select name="user_id" class="doc-select">
                    <option value="">Semua Pemohon</option>
                    @foreach($pemohonList as $pemohon)
                        <option value="{{ $pemohon->id }}" {{ request('user_id') == $pemohon->id ? 'selected' : '' }}>
                            {{ $pemohon->name ?? $pemohon->business_name ?? 'Admin (' . $pemohon->id . ')' }}
                        </option>
                    @endforeach
                </select>
                <input type="date" name="tanggal" class="doc-input" value="{{ request('tanggal') }}" title="Tanggal unggah">
                <select name="kategori" class="doc-select">
                    <option value="">Semua Jenis</option>
                    @foreach($kategoriList as $kat)
                        <option value="{{ $kat }}" {{ request('kategori') == $kat ? 'selected' : '' }}>{{ $kat }}</option>
                    @endforeach
                </select>
                <div class="doc-filter-actions">
                    <button type="submit" class="doc-btn-filter">Filter</button>
                    @if(request('search') || request('kategori') || request('tanggal') || request('user_id'))
                        <a href="{{ route('dokumen.index') }}" class="doc-btn-reset">Reset</a>
                    @endif
                </div>
            </form>
        </div>

        <form action="{{ route('dokumen.download_batch') }}" method="POST" id="batchDownloadForm" style="display:none;">
            @csrf
            <div id="batchHiddenInputs"></div>
        </form>

        <div class="doc-batch-bar">
            <div style="font-size: 12px; color: #475569; font-weight: 700;">
                <span id="selectedCount">0</span> dokumen terpilih
            </div>
            <div class="doc-batch-btns">
                <button type="button" class="doc-btn-batch doc-btn-batch--dl" id="btnBatchDownload" disabled onclick="submitBatchDoc('{{ route('dokumen.download_batch') }}')">
                    <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                    <span>Unduh Batch</span>
                </button>
                @if(!Auth::user()->isDinasPu() && !Auth::user()->isDinasPutr() && !Auth::user()->isSatuPintu())
                    <button type="button" class="doc-btn-batch doc-btn-batch--del" id="btnBatchDelete" disabled onclick="submitBatchDoc('{{ route('dokumen.bulk-destroy') }}', 'Hapus permanen semua dokumen yang dipilih?')">
                        <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        <span>Hapus Batch</span>
                    </button>
                    <button type="button" class="doc-btn-batch doc-btn-batch--all" onclick="if(confirm('Hapus SELURUH dokumen di sistem?') && confirm('Tindakan ini tidak dapat dibatalkan. Lanjutkan?')) { document.getElementById('deleteAllForm').submit(); }">
                        <span>Hapus Semua</span>
                    </button>
                @endif
            </div>
        </div>

        <div class="doc-table-wrap">
            <table class="doc-table">
                <thead>
                    <tr>
                        <th style="width: 38px; text-align: center;"><input type="checkbox" id="selectAll" style="cursor:pointer;"></th>
                        <th style="width: 27%;">Nama Dokumen</th>
                        <th style="width: 17%;">Kategori</th>
                        <th style="width: 12%;">File</th>
                        <th style="width: 16%;">Pemohon</th>
                        <th style="width: 12%;">Tanggal</th>
                        <th style="width: 16%; text-align: right;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($dokumen as $item)
                        @php
                            $pengajuInfo = null;
                            if (strpos($item->nama_dokumen, '[') === 0 && strpos($item->nama_dokumen, '] ') !== false) {
                                $parts = explode('] ', $item->nama_dokumen);
                                if (count($parts) >= 2) {
                                    $appNo = trim($parts[1]);
                                    if (strpos($appNo, 'BERUSAHA-') === 0) {
                                        $app = \App\Models\PpkprBerusahaApplication::where('application_number', $appNo)->first();
                                        $pengajuInfo = $app ? ($app->nama_pengaju ?: $app->nama_pemilik_usaha) : null;
                                    } elseif (strpos($appNo, 'NON-BERUSAHA-') === 0 || strpos($appNo, 'PPKPR-NON-') === 0) {
                                        $app = \App\Models\PpkprApplication::where('application_number', $appNo)->first();
                                        $pengajuInfo = $app ? ($app->nama_pengaju ?: $app->nama_pemilik_usaha) : null;
                                    } elseif (strpos($appNo, 'PSN-') === 0) {
                                        $app = \App\Models\PsnApplication::where('application_number', $appNo)->first();
                                        $pengajuInfo = $app ? $app->nama_pengaju : null;
                                    } elseif (strpos($appNo, 'TANAH-TIMBUL-') === 0) {
                                        $app = \App\Models\TanahTimbulApplication::where('application_number', $appNo)->first();
                                        $pengajuInfo = $app ? $app->nama_pengaju : null;
                                    } elseif (strpos($appNo, 'KEBIJAKAN-') === 0) {
                                        $app = \App\Models\KebijakanApplication::where('application_number', $appNo)->first();
                                        $pengajuInfo = $app ? $app->nama_pengaju : null;
                                    }
                                }
                            }
                            $finalName = $pengajuInfo ?: ($item->user->name ?? 'Admin');
                        @endphp
                        <tr>
                            <td style="text-align: center;">
                                <input type="checkbox" value="{{ $item->id }}" class="doc-checkbox" style="cursor:pointer;">
                            </td>
                            <td>
                                <span class="doc-title-txt">{{ $item->nama_dokumen }}</span>
                                @if($item->keterangan)
                                    <span class="doc-sub-txt">{{ Str::limit($item->keterangan, 45) }}</span>
                                @endif
                            </td>
                            <td>
                                <span class="doc-cat-badge" title="{{ $item->kategori ?? 'Umum' }}">{{ $item->kategori ?? 'Umum' }}</span>
                            </td>
                            <td style="white-space: nowrap;">
                                <span class="doc-ext-badge">{{ strtoupper($item->tipe_file) }}</span>
                                <span style="font-size:11.5px; color:#64748B; margin-left:4px;">{{ $item->ukuran_file }}</span>
                            </td>
                            <td>
                                <span style="font-weight:600; color:#0F172A; display:block; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;">{{ $finalName }}</span>
                                <span style="font-size:11px; color:#64748B;">PMH{{ str_pad($item->user->id ?? 0, 3, '0', STR_PAD_LEFT) }}</span>
                            </td>
                            <td style="white-space: nowrap; color:#334155; font-size:12px;">
                                {{ $item->created_at->format('d M Y') }}<br>
                                <span style="font-size:11px; color:#64748B;">{{ $item->created_at->format('H:i') }} WIB</span>
                            </td>
                            <td style="text-align: right;">
                                <div class="doc-row-actions">
                                    <a href="{{ route('dokumen.preview', $item->id) }}" target="_blank" class="doc-act-btn doc-act-view">Lihat</a>
                                    <a href="{{ route('dokumen.download', $item->id) }}" class="doc-act-btn doc-act-dl">Unduh</a>
                                    @if(!Auth::user()->isDinasPu() && !Auth::user()->isDinasPutr() && !Auth::user()->isSatuPintu())
                                        <button type="submit" form="delete-form-{{ $item->id }}" class="doc-act-btn doc-act-del" onclick="return confirm('Hapus dokumen ini?');">Hapus</button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align: center; padding: 36px 20px; color: #64748B;">
                                Belum ada dokumen yang sesuai filter.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @foreach($dokumen as $item)
            <form id="delete-form-{{ $item->id }}" action="{{ route('dokumen.destroy', $item->id) }}" method="POST" style="display:none;">
                @csrf
                @method('DELETE')
            </form>
        @endforeach

        <form id="deleteAllForm" action="{{ route('dokumen.destroy_all') }}" method="POST" style="display:none;">
            @csrf
        </form>

        <div class="doc-pag-bar">
            <span style="font-size:12px; color:#64748B;">
                Menampilkan {{ $dokumen->firstItem() ?? 0 }}–{{ $dokumen->lastItem() ?? 0 }} dari {{ $dokumen->total() }} dokumen
            </span>
            <div>
                {{ $dokumen->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>

    <script>
        function toggleDocUploadDrawer() {
            const drawer = document.getElementById('docUploadDrawer');
            if (drawer) drawer.classList.toggle('is-open');
        }

        function submitBatchDoc(url, msg) {
            const checked = Array.from(document.querySelectorAll('.doc-checkbox:checked'));
            if (!checked.length) return false;
            if (msg && !confirm(msg)) return false;

            const form = document.getElementById('batchDownloadForm');
            const holder = document.getElementById('batchHiddenInputs');
            if (!form || !holder) return false;

            holder.innerHTML = '';
            checked.forEach(cb => {
                const inp = document.createElement('input');
                inp.type = 'hidden';
                inp.name = 'dokumen_ids[]';
                inp.value = cb.value;
                holder.appendChild(inp);
            });
            form.action = url;
            form.submit();
        }

        document.addEventListener('DOMContentLoaded', function() {
            const selectAll = document.getElementById('selectAll');
            const checkboxes = document.querySelectorAll('.doc-checkbox');
            const btnBatch = document.getElementById('btnBatchDownload');
            const btnBatchDelete = document.getElementById('btnBatchDelete');
            const countDisplay = document.getElementById('selectedCount');

            function updateState() {
                const checkedCount = Array.from(checkboxes).filter(cb => cb.checked).length;
                if (countDisplay) countDisplay.innerText = checkedCount;
                if (btnBatch) btnBatch.disabled = checkedCount === 0;
                if (btnBatchDelete) btnBatchDelete.disabled = checkedCount === 0;
                if (selectAll) selectAll.checked = (checkedCount === checkboxes.length && checkboxes.length > 0);
            }

            if (selectAll) {
                selectAll.addEventListener('change', function() {
                    checkboxes.forEach(cb => cb.checked = this.checked);
                    updateState();
                });
            }
            checkboxes.forEach(cb => cb.addEventListener('change', updateState));
        });
    </script>
@endsection
