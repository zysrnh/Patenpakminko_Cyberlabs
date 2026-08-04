@extends('layouts.app')

@section('title', 'Pengelolaan Dokumen - PATEN PAK MIKO')
@section('page-title', 'Pengelolaan Dokumen')

@section('head-extra')
<style>
    /* Filters */
    .filters { display: flex; gap: 12px; margin-bottom: 20px; align-items: center; }
    .filters form { display: flex; gap: 12px; width: 100%; }
    .filters select, .filters input { padding: 8px 12px; border: 1.5px solid var(--line); border-radius: var(--r-md); font-size: 13px; }

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
</style>
@endsection

@section('content')
<div class="page-header" style="flex-direction: row; justify-content: space-between; align-items: flex-end;">
    <div class="page-header-left">
        <div class="breadcrumb">
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <span>›</span>
            <span>Pengelolaan Dokumen</span>
        </div>
        <h1>Pengelolaan Dokumen</h1>
        <p>Unggah, simpan, dan kelola dokumen lintas instansi.</p>
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
        <h2>Unggah Dokumen Baru</h2>
    </div>
    <div class="panel-body">
        <form action="{{ route('dokumen.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">Nama Pemohon/Pelaku Usaha</label>
                    <input type="text" name="nama_dokumen" class="form-control" required placeholder="Contoh: PT Telkom Pasero TBK">
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
        <h2>Daftar Dokumen Tersimpan</h2>
    </div>
    <div class="panel-body">
        
        <div class="filters">
            <form action="{{ route('dokumen.index') }}" method="GET" style="display: flex; flex-wrap: wrap; gap: 12px; width: 100%; align-items: center;">
                <input type="text" name="search" placeholder="Cari nama dokumen atau pengunggah..." value="{{ request('search') }}" style="flex: 1; min-width: 250px;">
                <select name="user_id" style="min-width: 180px;">
                    <option value="">Semua Pemohon</option>
                    @foreach($pemohonList as $pemohon)
                        <option value="{{ $pemohon->id }}" {{ request('user_id') == $pemohon->id ? 'selected' : '' }}>
                            {{ $pemohon->name ?? $pemohon->business_name ?? 'Admin ('.$pemohon->id.')' }}</option>
                    @endforeach
                </select>
                <input type="date" name="tanggal" value="{{ request('tanggal') }}" style="min-width: 140px;" title="Filter berdasarkan Tanggal Unggah">
                <select name="kategori" style="min-width: 200px;">
                    <option value="">Semua Jenis Dokumen</option>
                    @foreach($kategoriList as $kat)
                        <option value="{{ $kat }}" {{ request('kategori') == $kat ? 'selected' : '' }}>{{ $kat }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-secondary" style="padding: 8px 16px;">Filter</button>
                @if(request('search') || request('kategori') || request('tanggal'))
                    <a href="{{ route('dokumen.index') }}" class="btn btn-secondary" style="padding: 8px 16px;">Reset</a>
                @endif
            </form>
            @if(request('user_id'))
            <form action="{{ route('dokumen.download_zip') }}" method="POST" style="margin:0;">
                @csrf
                <input type="hidden" name="user_id" value="{{ request('user_id') }}">
                <button type="submit" class="btn btn-primary" style="padding: 8px 16px; background-color: #10b981; border-color: #10b981;">
                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                    Unduh ZIP (Semua Dokumen)
                </button>
            </form>
            @endif
        </div>

        <div class="table-wrap">
            <form action="{{ route('dokumen.download_batch') }}" method="POST" id="batchDownloadForm">
                @csrf
                <div style="margin-bottom: 12px; display: flex; justify-content: space-between; align-items: center;">
                    <div style="font-size: 13px; color: var(--muted);">
                        <span id="selectedCount">0</span> dokumen terpilih
                    </div>
                    <div style="display: flex; gap: 8px;">
                        <button type="button" class="btn btn-primary" id="btnBatchDownload" disabled style="background-color: #6366f1; border-color: #6366f1;" onclick="submitBatchDoc('{{ route('dokumen.download_batch') }}')">
                            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                            Unduh Batch (Terpilih)
                        </button>
                        @if(Auth::user()->isDpn())
                        <button type="button" class="btn btn-danger" id="btnBatchDelete" disabled style="background-color: #e53e3e; border-color: #e53e3e; color:#fff;" onclick="submitBatchDoc('{{ route('dokumen.bulk-destroy') }}', 'Apakah Anda yakin ingin menghapus permanen semua dokumen yang dipilih? Data tidak bisa dikembalikan!')">
                            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            Hapus Batch (Terpilih)
                        </button>
                        @endif
                    </div>
                </div>
            <table>
                <thead>
                    <tr>
                        <th style="width: 40px; text-align: center;">
                            <input type="checkbox" id="selectAll" style="cursor: pointer; width: 16px; height: 16px;">
                        </th>
                        <th>Nama Dokumen</th>
                        <th>Kategori</th>
                        <th>Informasi File</th>
                        <th>Pemohon / Akun</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($dokumen as $item)
                    <tr>
                        <td style="text-align: center;">
                            <input type="checkbox" name="dokumen_ids[]" value="{{ $item->id }}" class="doc-checkbox" style="cursor: pointer; width: 16px; height: 16px;">
                        </td>
                        <td style="max-width: 250px; word-wrap: break-word;">
                            <strong>{{ $item->nama_dokumen }}</strong>
                            @if($item->keterangan)
                                <div style="font-size: 12px; color: var(--muted); margin-top: 4px;">{{ Str::limit($item->keterangan, 50) }}</div>
                            @endif
                        </td>
                        <td style="white-space: nowrap;"><span class="badge badge-gray">{{ $item->kategori ?? 'Umum' }}</span></td>
                        <td>
                            <span class="badge badge-blue">{{ strtoupper($item->tipe_file) }}</span>
                            <span style="font-size:12px;color:var(--muted);margin-left:6px;">{{ $item->ukuran_file }}</span>
                        </td>
                        @php
                            $pengajuInfo = null;
                            if (strpos($item->nama_dokumen, '[') === 0 && strpos($item->nama_dokumen, '] ') !== false) {
                                $parts = explode('] ', $item->nama_dokumen);
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
                            <span style="font-weight: 500; color: var(--ink);">{{ $finalName }}</span><br>
                            <span style="font-size: 11px; color: var(--muted);">(Akun: PMH{{ str_pad($item->user->id ?? 0, 3, '0', STR_PAD_LEFT) }})</span>
                        </td>
                        <td style="white-space: nowrap;">{{ $item->created_at->format('d M Y, H:i') }}</td>
                        <td style="white-space: nowrap;">
                            <div style="display: flex; gap: 6px; flex-wrap: wrap;">
                                <a href="{{ route('dokumen.preview', $item->id) }}" target="_blank" class="btn btn-secondary btn-sm">
                                    Lihat
                                </a>
                                <a href="{{ route('dokumen.download', $item->id) }}" class="btn btn-primary btn-sm">Unduh</a>
                                @if(!Auth::user()->isDinasPu() && !Auth::user()->isDinasPutr() && !Auth::user()->isSatuPintu())
                                <button type="submit" form="delete-form-{{ $item->id }}" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus dokumen ini?');">Hapus</button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" style="text-align: center; padding: 40px 20px; color: var(--muted);">
                            Belum ada dokumen yang diunggah.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            </form>

            @foreach($dokumen as $item)
            <form id="delete-form-{{ $item->id }}" action="{{ route('dokumen.destroy', $item->id) }}" method="POST" style="display:none;">
                @csrf
                @method('DELETE')
            </form>
            @endforeach

            <div style="margin-top: 20px;">
                {{ $dokumen->links() }}
            </div>
        </div>
    </div>
</div>

<script>
    function submitBatchDoc(url, msg) {
        if (msg && !confirm(msg)) return false;
        const form = document.getElementById('batchDownloadForm');
        if (form) {
            form.action = url;
            form.submit();
        }
    }

    function openPreview(url, title) {
        window.open(url, '_blank');
    }

    // Script for Checkbox Batch Download
    document.addEventListener('DOMContentLoaded', function() {
        const selectAll = document.getElementById('selectAll');
        const checkboxes = document.querySelectorAll('.doc-checkbox');
        const btnBatch = document.getElementById('btnBatchDownload');
        const btnBatchDelete = document.getElementById('btnBatchDelete');
        const countDisplay = document.getElementById('selectedCount');

        function updateState() {
            let checkedCount = 0;
            checkboxes.forEach(cb => {
                if(cb.checked) checkedCount++;
            });
            countDisplay.innerText = checkedCount;
            if (btnBatch) btnBatch.disabled = checkedCount === 0;
            if (btnBatchDelete) btnBatchDelete.disabled = checkedCount === 0;
            selectAll.checked = (checkedCount === checkboxes.length && checkboxes.length > 0);
        }

        if(selectAll) {
            selectAll.addEventListener('change', function() {
                checkboxes.forEach(cb => cb.checked = this.checked);
                updateState();
            });
        }

        checkboxes.forEach(cb => {
            cb.addEventListener('change', updateState);
        });
    });
</script>
@endsection
