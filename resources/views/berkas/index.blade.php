@extends('layouts.app')

@section('title', 'Pengelolaan Berkas - PATEN PAK MIKO')
@section('page-title', 'Pengelolaan Berkas')

@section('head-extra')
<style>
    /* Filters */
    .filters { display: flex; gap: 12px; margin-bottom: 20px; align-items: center; }
    .filters form { display: flex; gap: 12px; width: 100%; }
    .filters select, .filters input { padding: 8px 12px; border: 1.5px solid var(--line); border-radius: var(--r-md); font-size: 13px; }
    input[type="date"] { background-color: #ffffff !important; color: #0f172a !important; }

    /* Pagination Fix (Bootstrap Style) */
    .pagination {
        display: flex;
        padding-left: 0;
        list-style: none;
        gap: 4px;
        flex-wrap: wrap;
        margin-top: 20px;
        align-items: center;
    }
    .page-item .page-link {
        padding: 6px 12px;
        border: 1px solid var(--line);
        border-radius: var(--r-md);
        color: var(--blue);
        font-size: 13px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #fff;
    }
    .page-item.active .page-link {
        background: var(--blue);
        color: white;
        border-color: var(--blue);
        font-weight: 700;
    }
    .page-item.disabled .page-link {
        color: #a0aec0;
        background: #f8fafc;
        cursor: not-allowed;
    }
    nav[role="navigation"] { width: 100%; display: flex; justify-content: center; }
    @media (min-width: 640px) {
        nav[role="navigation"] { justify-content: flex-start; }
    }

    /* ─── STYLE MODAL PREVIEW ───────────────── */
    .modal-backdrop {
        position: fixed;
        top: 0; left: 0;
        width: 100vw; height: 100vh;
        background: rgba(0, 0, 0, 0.4);
        z-index: 1040;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.3s ease;
        backdrop-filter: blur(2px);
    }
    .modal-backdrop.show {
        opacity: 1;
        visibility: visible;
    }
    .modal-slide {
        position: fixed;
        top: 0; right: -600px;
        width: 100%; max-width: 600px;
        height: 100vh;
        background: #fff;
        z-index: 1050;
        box-shadow: -4px 0 24px rgba(0,0,0,0.1);
        transition: right 0.3s cubic-bezier(0.2, 0.8, 0.2, 1);
        display: flex;
        flex-direction: column;
    }
    .modal-slide.open {
        right: 0;
    }
    .modal-header {
        padding: 20px 24px;
        border-bottom: 1px solid var(--border);
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: var(--surface);
    }
    .modal-title {
        font-size: 16px;
        font-weight: 600;
        color: var(--ink);
    }
    .btn-close {
        background: none; border: none;
        font-size: 24px; color: var(--muted);
        cursor: pointer; padding: 0;
        line-height: 1; transition: color 0.2s;
    }
    .btn-close:hover { color: var(--red); }
    .modal-body {
        flex: 1;
        padding: 0;
        overflow: hidden;
    }
    #previewFrame {
        width: 100%; height: 100%;
        border: none; background: #f8fafc;
    }

    /* ─── ENHANCED UI ───────────────────────── */
    .filter-card {
        background: #f8fafc;
        border: 1px solid var(--line);
        border-radius: var(--r-md);
        padding: 16px;
        margin-bottom: 20px;
    }
    .filter-grid {
        display: grid;
        grid-template-columns: minmax(200px, 1.5fr) 1fr 1fr 1.2fr auto;
        gap: 12px;
        align-items: center;
    }
    @media (max-width: 900px) {
        .filter-grid { grid-template-columns: 1fr 1fr; }
        .filter-grid .search-col { grid-column: 1 / -1; }
        .filter-grid .action-col { grid-column: 1 / -1; display: flex; gap: 8px; }
    }
    .filter-grid .form-control {
        padding: 8px 12px;
        font-size: 13px;
        height: 38px;
    }
    
    .table-modern {
        border-collapse: separate;
        border-spacing: 0;
        width: 100%;
    }
    .table-modern th {
        background: #f1f5f9;
        color: #475569;
        font-weight: 600;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        padding: 12px 16px;
        border-bottom: 2px solid var(--line);
    }
    .table-modern td {
        padding: 16px;
        vertical-align: middle;
        border-bottom: 1px solid var(--line);
        background: #fff;
        transition: background 0.2s;
    }
    .table-modern tbody tr:hover td {
        background: #f8fafc;
    }
    
    .file-icon-box {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 36px; height: 36px;
        border-radius: var(--r-md);
        font-weight: 700; font-size: 11px;
    }
    .bg-pdf { background: #fee2e2; color: #ef4444; }
    .bg-img { background: #e0e7ff; color: #6366f1; }
    .bg-doc { background: #dbeafe; color: #3b82f6; }
    .bg-def { background: #f1f5f9; color: #64748b; }

    .btn-action-sm {
        display: inline-flex; align-items: center; justify-content: center;
        padding: 6px 12px; border-radius: 6px; font-size: 12px; font-weight: 600;
        transition: all 0.2s; text-decoration: none; border: none; cursor: pointer; gap: 4px;
    }
    .btn-action-light { background: #f1f5f9; color: #475569; }
    .btn-action-light:hover { background: #e2e8f0; color: #0f172a; }
    .btn-action-blue { background: #e0f2fe; color: #0369a1; }
    .btn-action-blue:hover { background: #bae6fd; color: #0c4a6e; }
    .btn-action-red { background: #fee2e2; color: #b91c1c; }
    .btn-action-red:hover { background: #fecaca; color: #7f1d1d; }
</style>
@endsection

@section('content')
<div class="page-header" style="flex-direction: row; justify-content: space-between; align-items: flex-end;">
    <div class="page-header-left">
        <div class="breadcrumb">
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <span>›</span>
            <span>Pengelolaan Berkas</span>
        </div>
        <h1>Pengelolaan Berkas</h1>
        <p>Unggah, simpan, dan kelola dokumen lintas instansi.</p>
    </div>
    <div>
        <form action="{{ route('berkas.sync') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-secondary">
                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 2v6h-6"/><path d="M3 12a9 9 0 0115-6.7L21 8"/><path d="M3 22v-6h6"/><path d="M21 12a9 9 0 01-15 6.7L3 16"/></svg>
                Tarik Data (Pemohon)
            </button>
        </form>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <span>{{ session('success') }}</span>
    </div>
@endif
@if(session('error'))
    <div class="alert alert-error">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
        <span>{{ session('error') }}</span>
    </div>
@endif
@if ($errors->any())
    <div class="alert alert-error">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
        <ul style="margin-left: 20px;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="panel">
    <div class="panel-head">
        <h2>Unggah Berkas Baru</h2>
    </div>
    <div class="panel-body">
        <form action="{{ route('berkas.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">Nama Pemohon/Pelaku Usaha</label>
                    <input type="text" name="nama_berkas" class="form-control" required placeholder="Contoh: PT Telkom Pasero TBK">
                </div>
                <div class="form-group">
                    <label class="form-label">Kategori</label>
                    <select name="kategori" class="form-control" required {!! request('kategori') ? 'style="pointer-events: none; background: #f1f5f9; color: var(--muted); font-weight: 500;" tabindex="-1"' : '' !!}>
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
                <div class="form-group">
                    <label class="form-label">Pilih File (PDF, JPG, PNG, DOCX - Max 100MB)</label>
                    <input type="file" name="file" class="form-control" required accept=".pdf,.jpg,.jpeg,.png,.doc,.docx,.xls,.xlsx" style="background:#fff;">
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">Keterangan Tambahan (Opsional)</label>
                <textarea name="keterangan" class="form-control" rows="2" placeholder="Tuliskan keterangan mengenai dokumen ini..."></textarea>
            </div>
            <div style="margin-top: 16px;">
                <button type="submit" class="btn btn-primary">Unggah Dokumen</button>
            </div>
        </form>
    </div>
</div>

<div class="panel">
    <div class="panel-head">
        <h2>Daftar Berkas Tersimpan</h2>
    </div>
    <div class="panel-body">
        
        <div class="filter-card">
            <form action="{{ route('berkas.index') }}" method="GET" class="filter-grid">
                <div class="search-col">
                    <input type="text" name="search" class="form-control" placeholder="Cari nama berkas atau pengunggah..." value="{{ request('search') }}">
                </div>
                <div>
                    <input type="date" name="tanggal" class="form-control" value="{{ request('tanggal') }}" title="Filter berdasarkan Tanggal Unggah">
                </div>
                <div>
                    @if(request('layanan'))
                        <input type="hidden" name="layanan" value="{{ request('layanan') }}">
                    @endif
                    <select name="kategori" class="form-control" style="{{ request('layanan') ? 'pointer-events: none; background: #e2e8f0; color: #475569; font-weight: 600; border-color: #cbd5e1;' : '' }}" {!! request('layanan') ? 'tabindex="-1"' : '' !!}>
                        <option value="">Semua Jenis Dokumen</option>
                        @php
                            $katList = $kategoriList->toArray();
                            if(request('kategori') && !in_array(request('kategori'), $katList)) {
                                $katList[] = request('kategori');
                            }
                        @endphp
                        @foreach($katList as $kat)
                            <option value="{{ $kat }}" {{ request('kategori') == $kat ? 'selected' : '' }}>{{ $kat }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="action-col" style="display: flex; gap: 8px;">
                    <button type="submit" class="btn btn-secondary" style="padding: 8px 16px; height: 38px;">Filter</button>
                    @if(request('search') || request('kategori') || request('tanggal') || request('layanan') || request('pengunggah'))
                        <a href="{{ route('berkas.index', request('layanan') ? ['layanan' => request('layanan'), 'kategori' => request('kategori')] : []) }}" class="btn btn-secondary" style="padding: 8px 16px; height: 38px; background: #fff; color: #ef4444; border-color: #fca5a5;">Reset</a>
                    @endif
                </div>
            </form>
        </div>

        <div class="table-wrap" style="border: none; padding: 0;">
            <table class="table-modern">
                <thead>
                    <tr>
                        <th style="width: 40px;"></th>
                        <th>Info Berkas</th>
                        <th>Pemohon / Akun</th>
                        <th>Tanggal Unggah</th>
                        <th style="text-align: right;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($berkas as $item)
                    @php
                        $ext = strtolower($item->tipe_file);
                        $bgClass = 'bg-def';
                        if(in_array($ext, ['pdf'])) $bgClass = 'bg-pdf';
                        elseif(in_array($ext, ['jpg','jpeg','png'])) $bgClass = 'bg-img';
                        elseif(in_array($ext, ['doc','docx','xls','xlsx'])) $bgClass = 'bg-doc';
                    @endphp
                    <tr>
                        <td>
                            <div class="file-icon-box {{ $bgClass }}">
                                {{ strtoupper(substr($ext, 0, 3)) }}
                            </div>
                        </td>
                        <td>
                            <div style="font-weight: 600; color: #0f172a; font-size: 14px; margin-bottom: 4px;">{{ $item->nama_berkas }}</div>
                            <div style="display: flex; gap: 8px; align-items: center; font-size: 12px; flex-wrap: wrap;">
                                <span style="color: #64748b; background: #f1f5f9; padding: 2px 8px; border-radius: 4px; font-weight: 500;">{{ $item->kategori ?? 'Umum' }}</span>
                                @if($item->is_ptsp || $item->uploaded_by_role === 'satu_pintu' || str_contains(strtolower($item->kategori), 'ptsp'))
                                    <span style="color: #047857; background: #D1FAE5; border: 1px solid #A7F3D0; padding: 2px 8px; border-radius: 4px; font-weight: 700; font-size: 11px; display: inline-flex; align-items: center; gap: 4px;">
                                        🛡️ Uploaded by PTSP
                                    </span>
                                @else
                                    <span style="color: #475569; background: #F1F5F9; border: 1px solid #E2E8F0; padding: 2px 8px; border-radius: 4px; font-weight: 500; font-size: 11px;">
                                        👤 Pemohon
                                    </span>
                                @endif
                                <span style="color: #94a3b8;">•</span>
                                <span style="color: #64748b;">{{ $item->ukuran_file }}</span>
                            </div>
                        </td>
                        @php
                            $pengajuInfo = null;
                            if (strpos($item->nama_berkas, '[') === 0 && strpos($item->nama_berkas, '] ') !== false) {
                                $parts = explode('] ', $item->nama_berkas);
                                if (count($parts) >= 2) {
                                    $appNo = trim($parts[1]);
                                    if (strpos($appNo, 'BERUSAHA-') === 0) {
                                        $app = \App\Models\PpkprBerusahaApplication::where('application_number', $appNo)->first();
                                        $pengajuInfo = $app ? ($app->nama_pengaju ?: $app->nama_pemilik_usaha) : null;
                                    } elseif (strpos($appNo, 'NON-BERUSAHA-') === 0) {
                                        $app = \App\Models\PpkprNonBerusahaApplication::where('application_number', $appNo)->first();
                                        $pengajuInfo = $app ? $app->nama_pengaju : null;
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
                        <td>
                            <div style="font-weight: 600; color: #334155; font-size: 13px;">{{ $finalName }}</div>
                            <div style="font-size: 11px; color: #94a3b8; margin-top: 2px;">Akun: PMH{{ str_pad($item->user->id ?? 0, 3, '0', STR_PAD_LEFT) }}</div>
                        </td>
                        <td>
                            <div style="font-size: 13px; color: #475569; font-weight: 500;">{{ $item->created_at->format('d M Y') }}</div>
                            <div style="font-size: 11px; color: #94a3b8;">{{ $item->created_at->format('H:i') }} WIB</div>
                        </td>
                        <td style="text-align: right;">
                            <div style="display: flex; justify-content: flex-end; gap: 6px;">
                                <a href="{{ route('berkas.preview', $item->id) }}" target="_blank" class="btn-action-sm btn-action-light" title="Lihat">
                                    <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                    Lihat
                                </a>
                                <a href="{{ route('berkas.download', $item->id) }}" class="btn-action-sm btn-action-blue" title="Unduh">
                                    <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                                    Unduh
                                </a>
                                @if(!Auth::user()->isDinasPu() && !Auth::user()->isDinasPutr() && !Auth::user()->isSatuPintu())
                                <form action="{{ route('berkas.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus berkas ini?');" style="margin: 0;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action-sm btn-action-red" title="Hapus">
                                        <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                        Hapus
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" style="text-align: center; padding: 60px 20px;">
                            <div style="color: #94a3b8; margin-bottom: 8px;">
                                <svg viewBox="0 0 24 24" width="48" height="48" fill="none" stroke="currentColor" stroke-width="1"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg>
                            </div>
                            <div style="color: #475569; font-weight: 500;">Belum ada berkas yang ditemukan.</div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <div style="margin-top: 20px;">
                {{ $berkas->links() }}
            </div>
        </div>
    </div>
</div>

<script>
    function openPreview(url, title) {
        window.open(url, '_blank');
    }
</script>
@endsection
