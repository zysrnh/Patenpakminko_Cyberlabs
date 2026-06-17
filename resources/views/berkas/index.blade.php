@extends('layouts.app')

@section('title', 'Pengelolaan Berkas - PATEN PAK MIKO')
@section('page-title', 'Pengelolaan Berkas')

@section('extra-styles')
    /* Filters */
    .filters { display: flex; gap: 12px; margin-bottom: 20px; align-items: center; }
    .filters form { display: flex; gap: 12px; width: 100%; }
    .filters select, .filters input { padding: 8px 12px; border: 1.5px solid var(--line); border-radius: var(--r-md); font-size: 13px; }

    /* Pagination Fix */
    nav[role="navigation"] svg { width: 20px; height: 20px; }
    nav[role="navigation"] p { margin-top: 12px; font-size: 13px; color: var(--muted); }
    nav[role="navigation"] a, nav[role="navigation"] span { padding: 6px 12px; border: 1px solid var(--line); border-radius: var(--r-md); color: var(--blue); font-size: 13px; text-decoration: none; }
    nav[role="navigation"] .flex.justify-between { display: flex; justify-content: space-between; align-items: center; }
    nav[role="navigation"] .hidden { display: none; }

    /* Slide Modal */
    .modal-backdrop {
        position: fixed; top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(0,0,0,0.5); z-index: 999;
        opacity: 0; pointer-events: none; transition: opacity 0.3s;
    }
    .modal-backdrop.show { opacity: 1; pointer-events: auto; }
    
    .modal-slide {
        position: fixed; top: 0; right: -600px; width: 600px; max-width: 90%; height: 100vh;
        background: #fff; z-index: 1000; box-shadow: -4px 0 20px rgba(0,0,0,0.1);
        transition: right 0.3s cubic-bezier(0.4, 0, 0.2, 1); display: flex; flex-direction: column;
    }
    .modal-slide.open { right: 0; }
    .modal-header {
        padding: 16px 24px; border-bottom: 1px solid var(--line);
        display: flex; justify-content: space-between; align-items: center;
    }
    .modal-title { font-size: 16px; font-weight: 700; color: var(--ink); }
    .btn-close {
        background: transparent; border: none; font-size: 24px; color: var(--muted);
        cursor: pointer; line-height: 1; padding: 4px;
    }
    .modal-body { flex: 1; padding: 0; background: #f0f0f0; }
    .modal-body iframe { width: 100%; height: 100%; border: none; }
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
        <p>Unggah, simpan, dan kelola dokumen lintas instansi (BPN & PU).</p>
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
                    <label class="form-label">Nama Berkas</label>
                    <input type="text" name="nama_berkas" class="form-control" required placeholder="Contoh: Sketsa Lokasi Tanah Timbul">
                </div>
                <div class="form-group">
                    <label class="form-label">Kategori (Modul)</label>
                    <select name="kategori" class="form-control" required>
                        <option value="">-- Pilih Jenis Dokumen --</option>
                        @if(Auth::user()->isSatuPintu())
                            <option value="Dokumen Pertimbangan Teknis Pertanahan">Dokumen Pertimbangan Teknis Pertanahan</option>
                        @else
                            <option value="Peta Lokasi">Peta Lokasi</option>
                            <option value="Surat Kuasa">Surat Kuasa</option>
                            <option value="FC KTP">FC KTP / Identitas</option>
                            <option value="FC NPWP">FC NPWP</option>
                            <option value="FC Akta Pendirian">FC Akta Pendirian</option>
                            <option value="Rencana Penggunaan Tanah">Rencana Penggunaan Tanah</option>
                            <option value="NIB">NIB</option>
                            <option value="KBLI">KBLI</option>
                            <option value="Proposal Kegiatan">Proposal Kegiatan</option>
                            <option value="Formulir PTP">Formulir PTP</option>
                            <option value="Dokumen Pertimbangan Teknis Pertanahan">Dokumen Pertimbangan Teknis Pertanahan</option>
                            <option value="Dokumen Penilaian (PU)">Dokumen Penilaian (PU)</option>
                            <option value="Dokumen Pertimbangan Teknis Pertanahan Final (PTSP)">Dokumen Pertimbangan Teknis Pertanahan Final (PTSP)</option>
                            <option value="Persyaratan Lainnya">Lainnya</option>
                        @endif
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">Pilih File (PDF, JPG, PNG, DOCX - Max 100MB)</label>
                <input type="file" name="file" class="form-control" required accept=".pdf,.jpg,.jpeg,.png,.doc,.docx,.xls,.xlsx" style="background:#fff;">
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
        
        <div class="filters">
            <form action="{{ route('berkas.index') }}" method="GET" style="display: flex; flex-wrap: wrap; gap: 12px; width: 100%; align-items: center;">
                <input type="text" name="search" placeholder="Cari nama berkas atau pengunggah..." value="{{ request('search') }}" style="flex: 1; min-width: 250px;">
                <select name="user_id" style="min-width: 180px;">
                    <option value="">Semua Pemohon</option>
                    @foreach($pemohonList as $pemohon)
                        <option value="{{ $pemohon->id }}" {{ request('user_id') == $pemohon->id ? 'selected' : '' }}>
                            {{ $pemohon->name ?? $pemohon->business_name ?? 'Admin ('.$pemohon->id.')' }}
                        </option>
                    @endforeach
                </select>
                <select name="kategori" style="min-width: 200px;">
                    @if(Auth::user()->isSatuPintu())
                        <option value="Dokumen Pertimbangan Teknis Pertanahan" {{ request('kategori') == 'Dokumen Pertimbangan Teknis Pertanahan' ? 'selected' : '' }}>Dokumen Pertimbangan Teknis Pertanahan</option>
                    @else
                        <option value="">Semua Jenis Dokumen</option>
                        <option value="Peta Lokasi" {{ request('kategori') == 'Peta Lokasi' ? 'selected' : '' }}>Peta Lokasi</option>
                        <option value="FC KTP" {{ request('kategori') == 'FC KTP' ? 'selected' : '' }}>FC KTP</option>
                        <option value="FC NPWP" {{ request('kategori') == 'FC NPWP' ? 'selected' : '' }}>FC NPWP</option>
                        <option value="Surat Kuasa" {{ request('kategori') == 'Surat Kuasa' ? 'selected' : '' }}>Surat Kuasa</option>
                        <option value="FC Akta Pendirian" {{ request('kategori') == 'FC Akta Pendirian' ? 'selected' : '' }}>FC Akta Pendirian</option>
                        <option value="Rencana Penggunaan Tanah" {{ request('kategori') == 'Rencana Penggunaan Tanah' ? 'selected' : '' }}>Rencana Penggunaan Tanah</option>
                        <option value="NIB" {{ request('kategori') == 'NIB' ? 'selected' : '' }}>NIB</option>
                        <option value="KBLI" {{ request('kategori') == 'KBLI' ? 'selected' : '' }}>KBLI</option>
                        <option value="Proposal Kegiatan" {{ request('kategori') == 'Proposal Kegiatan' ? 'selected' : '' }}>Proposal Kegiatan</option>
                        <option value="Formulir PTP" {{ request('kategori') == 'Formulir PTP' ? 'selected' : '' }}>Formulir PTP</option>
                        <option value="Dokumen Pertimbangan Teknis Pertanahan" {{ request('kategori') == 'Dokumen Pertimbangan Teknis Pertanahan' ? 'selected' : '' }}>Dokumen Pertimbangan Teknis Pertanahan</option>
                        <option value="Dokumen Penilaian (PU)" {{ request('kategori') == 'Dokumen Penilaian (PU)' ? 'selected' : '' }}>Dokumen Penilaian (PU)</option>
                        <option value="Dokumen Pertimbangan Teknis Pertanahan Final (PTSP)" {{ request('kategori') == 'Dokumen Pertimbangan Teknis Pertanahan Final (PTSP)' ? 'selected' : '' }}>Dokumen Pertimbangan Teknis Pertanahan Final (PTSP)</option>
                        <option value="Persyaratan Lainnya" {{ request('kategori') == 'Persyaratan Lainnya' ? 'selected' : '' }}>Persyaratan Lainnya</option>
                    @endif
                </select>
                <button type="submit" class="btn btn-secondary" style="padding: 8px 16px;">Filter</button>
                @if(request('search') || request('kategori'))
                    <a href="{{ route('berkas.index') }}" class="btn btn-secondary" style="padding: 8px 16px;">Reset</a>
                @endif
            </form>
        </div>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Nama Berkas</th>
                        <th>Kategori</th>
                        <th>Informasi File</th>
                        <th>Pengaju / Pengunggah</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($berkas as $item)
                    <tr>
                        <td style="max-width: 250px; word-wrap: break-word;">
                            <strong>{{ $item->nama_berkas }}</strong>
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
                            <span style="font-weight: 500; color: var(--ink);">{{ $finalName }}</span><br>
                            <span style="font-size: 11px; color: var(--muted);">(Akun: PMH{{ str_pad($item->user->id ?? 0, 3, '0', STR_PAD_LEFT) }})</span>
                        </td>
                        <td style="white-space: nowrap;">{{ $item->created_at->format('d M Y, H:i') }}</td>
                        <td style="white-space: nowrap;">
                            <div style="display: flex; gap: 6px; flex-wrap: wrap;">
                                <button type="button" class="btn btn-secondary btn-sm" onclick="openPreview('{{ route('berkas.preview', $item->id) }}', '{{ $item->nama_berkas }}')">
                                    Lihat
                                </button>
                                <a href="{{ route('berkas.download', $item->id) }}" class="btn btn-primary btn-sm">Unduh</a>
                                <form action="{{ route('berkas.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus berkas ini?');" style="margin: 0;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 40px 20px; color: var(--muted);">
                            Belum ada berkas yang diunggah.
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

<!-- Modal Preview -->
<div class="modal-backdrop" id="previewBackdrop" onclick="closePreview()"></div>
<div class="modal-slide" id="previewModal">
    <div class="modal-header">
        <div class="modal-title" id="previewTitle">Preview Dokumen</div>
        <button class="btn-close" onclick="closePreview()">&times;</button>
    </div>
    <div class="modal-body">
        <iframe id="previewFrame" src=""></iframe>
    </div>
</div>

<script>
    function openPreview(url, title) {
        document.getElementById('previewTitle').innerText = title;
        document.getElementById('previewFrame').src = url;
        document.getElementById('previewBackdrop').classList.add('show');
        document.getElementById('previewModal').classList.add('open');
    }

    function closePreview() {
        document.getElementById('previewBackdrop').classList.remove('show');
        document.getElementById('previewModal').classList.remove('open');
        setTimeout(() => {
            document.getElementById('previewFrame').src = '';
        }, 300);
    }
</script>
@endsection
