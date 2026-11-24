@extends('layouts.app')

@section('title', 'Pengelolaan Berkas - PATEN PAK MIKO')
@section('page-title', 'Pengelolaan Berkas')

@section('extra-styles')
    @keyframes berkasFadeUp {
        from { opacity: 0; transform: translateY(5px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .berkas-hero {
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
        animation: berkasFadeUp .2s cubic-bezier(0.22, 1, 0.36, 1) both;
    }
    .berkas-hero-title { font-size: 17px; font-weight: 800; color: #003B64; letter-spacing: -0.02em; margin: 0 0 2px; }
    .berkas-hero-sub { font-size: 12.5px; color: #64748B; margin: 0; }
    .berkas-toggle-upload {
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
    }
    .berkas-toggle-upload:hover { background: #218AC9; }

    .berkas-upload-drawer {
        display: none;
        background: #FFFFFF;
        border: 1px solid #D6E4EF;
        border-radius: 4px;
        margin-bottom: 14px;
        overflow: hidden;
        animation: berkasFadeUp .18s ease-out both;
    }
    .berkas-upload-drawer.is-open { display: block; }
    .berkas-drawer-head {
        padding: 12px 16px;
        background: #F8FAFC;
        border-bottom: 1px solid #E8F0F6;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .berkas-drawer-head h2 { font-size: 14px; font-weight: 800; color: #003B64; margin: 0; }
    .berkas-upload-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 12px;
        margin-bottom: 12px;
    }

    .berkas-panel {
        background: #FFFFFF;
        border: 1px solid #D6E4EF;
        border-radius: 4px;
        overflow: hidden;
        animation: berkasFadeUp .24s cubic-bezier(0.22, 1, 0.36, 1) .04s both;
    }
    .berkas-panel-head {
        padding: 13px 16px;
        background: #F8FAFC;
        border-bottom: 1px solid #E8F0F6;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
    }
    .berkas-panel-head h2 { font-size: 14.5px; font-weight: 800; color: #003B64; margin: 0; }
    .berkas-total-pill {
        font-size: 11.5px;
        font-weight: 700;
        color: #003B64;
        background: #E3F0F9;
        border: 1px solid #BFD9EC;
        padding: 2px 8px;
        border-radius: 4px;
    }

    .berkas-filter-bar {
        padding: 12px 16px;
        border-bottom: 1px solid #E8F0F6;
        background: #FFFFFF;
    }
    .berkas-filter-grid {
        display: grid;
        grid-template-columns: minmax(180px, 1.5fr) 150px minmax(180px, 1fr) auto;
        gap: 8px;
        align-items: center;
    }
    .b-input, .b-select {
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
    .b-input:focus, .b-select:focus { border-color: #218AC9; }
    .b-btn-primary {
        height: 34px;
        padding: 0 14px;
        border: none;
        border-radius: 4px;
        background: #003B64;
        color: #FFFFFF;
        font-family: inherit;
        font-size: 12px;
        font-weight: 700;
        cursor: pointer;
    }
    .b-btn-primary:hover { background: #218AC9; }
    .b-btn-reset {
        height: 34px;
        padding: 0 11px;
        border: 1px solid #CBD5E1;
        border-radius: 4px;
        background: #FFFFFF;
        color: #DC2626;
        font-size: 12px;
        font-weight: 700;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
    }

    .berkas-table-wrap { width: 100%; overflow-x: auto; }
    .berkas-table { width: 100%; border-collapse: collapse; table-layout: fixed; }
    .berkas-table th {
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
    .berkas-table td {
        padding: 11px 12px;
        border-bottom: 1px solid #EFF4F8;
        vertical-align: middle;
        font-size: 12.5px;
    }
    .berkas-table tbody tr:hover { background: #F8FAFC; }

    .file-icon-box {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        border-radius: 4px;
        font-weight: 800;
        font-size: 10.5px;
    }
    .bg-pdf { background: #FEE2E2; color: #DC2626; }
    .bg-img { background: #E3F0F9; color: #003B64; }
    .bg-doc { background: #DBEAFE; color: #1E40AF; }
    .bg-def { background: #F1F5F9; color: #475569; }

    .b-badge {
        display: inline-block;
        padding: 2px 7px;
        border-radius: 4px;
        font-size: 11px;
        font-weight: 600;
    }
    .b-badge--cat { background: #F1F5F9; border: 1px solid #CBD5E1; color: #334155; }
    .b-badge--ptsp { background: #DCFCE7; border: 1px solid #BBF7D0; color: #166534; font-weight: 700; }

    .b-actions { display: flex; justify-content: flex-end; gap: 5px; flex-wrap: nowrap; }
    .b-act-btn {
        height: 28px;
        padding: 0 9px;
        border-radius: 4px;
        font-size: 11.5px;
        font-weight: 700;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        cursor: pointer;
        border: 1px solid transparent;
        white-space: nowrap;
    }
    .b-act-view { background: #F1F5F9; color: #334155; border-color: #CBD5E1; }
    .b-act-view:hover { background: #E2E8F0; color: #003B64; }
    .b-act-dl { background: #218AC9; color: #FFFFFF; }
    .b-act-dl:hover { background: #003B64; color: #FFFFFF; }
    .b-act-del { background: #FEF2F2; color: #DC2626; border-color: #FECACA; }
    .b-act-del:hover { background: #DC2626; color: #FFFFFF; border-color: #DC2626; }

    .berkas-pag-bar {
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
    .page-item.disabled .page-link { color: #94A3B8; background: #F1F5F9; }

    @media (max-width: 1024px) {
        .berkas-filter-grid { grid-template-columns: 1fr 1fr; }
        .berkas-upload-grid { grid-template-columns: 1fr; }
        .berkas-table { table-layout: auto; min-width: 760px; }
    }
    @media (max-width: 640px) {
        .berkas-filter-grid { grid-template-columns: 1fr; }
    }
    @media (prefers-reduced-motion: reduce) {
        .berkas-hero, .berkas-upload-drawer, .berkas-panel { animation: none !important; }
    }
@endsection

@section('content')
    <div class="berkas-hero">
        <div>
            <h1 class="berkas-hero-title">Pengelolaan Berkas PTSP</h1>
            <p class="berkas-hero-sub">Unggah dan kelola dokumen hasil kerja instansi secara mandiri.</p>
        </div>
        <button type="button" class="berkas-toggle-upload" onclick="toggleBerkasDrawer()">
            <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
            <span>Unggah Berkas</span>
        </button>
    </div>

    @if($errors->any())
        <div class="alert alert-error" style="border-radius:4px; margin-bottom:14px;">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            <ul style="margin-left: 16px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Collapsible Upload Drawer -->
    <div id="berkasUploadDrawer" class="berkas-upload-drawer">
        <div class="berkas-drawer-head">
            <h2>Unggah Berkas Baru</h2>
            <button type="button" onclick="toggleBerkasDrawer()" style="background:none;border:none;font-size:18px;color:#64748B;cursor:pointer;line-height:1;">&times;</button>
        </div>
        <form action="{{ route('berkas.store') }}" method="POST" enctype="multipart/form-data" style="padding:16px;">
            @csrf
            <div class="berkas-upload-grid">
                <div>
                    <label style="font-size:12px;font-weight:700;color:#003B64;display:block;margin-bottom:5px;">Judul Dokumen <span style="color:#DC2626;">*</span></label>
                    <input type="text" name="nama_berkas" class="b-input" required placeholder="Contoh: Sertifikat PKKPR No. 001/2026">
                </div>
                <div>
                    <label style="font-size:12px;font-weight:700;color:#003B64;display:block;margin-bottom:5px;">Kategori Dokumen <span style="color:#DC2626;">*</span></label>
                    <select name="kategori" class="b-select" required>
                        <option value="">-- Pilih Kategori --</option>
                        <optgroup label="Dokumen PKKPR Berusaha">
                            <option value="Dokumen PKKPR Final (PTSP)">Dokumen PKKPR Final (PTSP)</option>
                            <option value="Sertifikat PKKPR Berusaha">Sertifikat PKKPR Berusaha</option>
                            <option value="SK PKKPR Berusaha">SK PKKPR Berusaha</option>
                        </optgroup>
                        <optgroup label="Dokumen Pertimbangan Teknis">
                            <option value="Pertek PKKPR Berusaha">Pertek PKKPR Berusaha</option>
                            <option value="Pertek PKKPR Non Berusaha">Pertek PKKPR Non Berusaha</option>
                            <option value="Pertek Kebijakan Khusus">Pertek Kebijakan Khusus</option>
                            <option value="Pertek Tanah Timbul">Pertek Tanah Timbul</option>
                            <option value="Pertek PSN">Pertek PSN</option>
                        </optgroup>
                        <optgroup label="Dokumen Resmi PTSP">
                            <option value="Berita Acara PTSP">Berita Acara PTSP</option>
                            <option value="Surat Keputusan PTSP">Surat Keputusan PTSP</option>
                            <option value="Surat Pengantar PTSP">Surat Pengantar PTSP</option>
                            <option value="Nota Dinas PTSP">Nota Dinas PTSP</option>
                        </optgroup>
                        <optgroup label="Lainnya">
                            <option value="Dokumen Lainnya (PTSP)">Dokumen Lainnya (PTSP)</option>
                        </optgroup>
                    </select>
                </div>
                <div>
                    <label style="font-size:12px;font-weight:700;color:#003B64;display:block;margin-bottom:5px;">File (PDF/JPG/PNG/DOCX, Maks 100MB) <span style="color:#DC2626;">*</span></label>
                    <input type="file" name="file" class="b-input" style="padding:4px 8px;" required accept=".pdf,.jpg,.jpeg,.png,.doc,.docx,.xls,.xlsx">
                </div>
            </div>
            <div style="display:flex; gap:10px; align-items:flex-end; flex-wrap:wrap;">
                <div style="flex:1; min-width:220px;">
                    <label style="font-size:12px;font-weight:700;color:#003B64;display:block;margin-bottom:5px;">Keterangan (Opsional)</label>
                    <input type="text" name="keterangan" class="b-input" placeholder="Catatan mengenai dokumen ini...">
                </div>
                <button type="submit" class="b-btn-primary">Simpan Berkas</button>
            </div>
        </form>
    </div>

    <div class="berkas-panel">
        <div class="berkas-panel-head">
            <h2>Daftar Berkas Tersimpan</h2>
            <span class="berkas-total-pill">{{ number_format($berkas->total()) }} Berkas</span>
        </div>

        <div class="berkas-filter-bar">
            <form action="{{ route('berkas.index') }}" method="GET" class="berkas-filter-grid">
                <input type="text" name="search" class="b-input" placeholder="Cari nama berkas atau keterangan..." value="{{ request('search') }}">
                <input type="date" name="tanggal" class="b-input" value="{{ request('tanggal') }}" title="Tanggal unggah">
                <select name="kategori" class="b-select">
                    <option value="">Semua Kategori</option>
                    <optgroup label="PKKPR Berusaha">
                        <option value="Dokumen PKKPR Final (PTSP)" {{ request('kategori') == 'Dokumen PKKPR Final (PTSP)' ? 'selected' : '' }}>Dokumen PKKPR Final (PTSP)</option>
                        <option value="Sertifikat PKKPR Berusaha" {{ request('kategori') == 'Sertifikat PKKPR Berusaha' ? 'selected' : '' }}>Sertifikat PKKPR Berusaha</option>
                        <option value="SK PKKPR Berusaha" {{ request('kategori') == 'SK PKKPR Berusaha' ? 'selected' : '' }}>SK PKKPR Berusaha</option>
                    </optgroup>
                    <optgroup label="Pertimbangan Teknis">
                        <option value="Pertek PKKPR Berusaha" {{ request('kategori') == 'Pertek PKKPR Berusaha' ? 'selected' : '' }}>Pertek PKKPR Berusaha</option>
                        <option value="Pertek PKKPR Non Berusaha" {{ request('kategori') == 'Pertek PKKPR Non Berusaha' ? 'selected' : '' }}>Pertek PKKPR Non Berusaha</option>
                        <option value="Pertek Kebijakan Khusus" {{ request('kategori') == 'Pertek Kebijakan Khusus' ? 'selected' : '' }}>Pertek Kebijakan Khusus</option>
                        <option value="Pertek Tanah Timbul" {{ request('kategori') == 'Pertek Tanah Timbul' ? 'selected' : '' }}>Pertek Tanah Timbul</option>
                        <option value="Pertek PSN" {{ request('kategori') == 'Pertek PSN' ? 'selected' : '' }}>Pertek PSN</option>
                    </optgroup>
                    <optgroup label="Dokumen Resmi PTSP">
                        <option value="Berita Acara PTSP" {{ request('kategori') == 'Berita Acara PTSP' ? 'selected' : '' }}>Berita Acara PTSP</option>
                        <option value="Surat Keputusan PTSP" {{ request('kategori') == 'Surat Keputusan PTSP' ? 'selected' : '' }}>Surat Keputusan PTSP</option>
                        <option value="Surat Pengantar PTSP" {{ request('kategori') == 'Surat Pengantar PTSP' ? 'selected' : '' }}>Surat Pengantar PTSP</option>
                        <option value="Nota Dinas PTSP" {{ request('kategori') == 'Nota Dinas PTSP' ? 'selected' : '' }}>Nota Dinas PTSP</option>
                    </optgroup>
                    <optgroup label="Lainnya">
                        <option value="Dokumen Lainnya (PTSP)" {{ request('kategori') == 'Dokumen Lainnya (PTSP)' ? 'selected' : '' }}>Dokumen Lainnya (PTSP)</option>
                    </optgroup>
                    @php
                        $ptspKats = ['Dokumen PKKPR Final (PTSP)','Sertifikat PKKPR Berusaha','SK PKKPR Berusaha','Pertek PKKPR Berusaha','Pertek PKKPR Non Berusaha','Pertek Kebijakan Khusus','Pertek Tanah Timbul','Pertek PSN','Berita Acara PTSP','Surat Keputusan PTSP','Surat Pengantar PTSP','Nota Dinas PTSP','Dokumen Lainnya (PTSP)'];
                        $extraKats = $kategoriList->filter(fn($k) => !in_array($k, $ptspKats));
                    @endphp
                    @foreach($extraKats as $kat)
                        <option value="{{ $kat }}" {{ request('kategori') == $kat ? 'selected' : '' }}>{{ $kat }}</option>
                    @endforeach
                </select>
                <div style="display:flex; gap:6px;">
                    <button type="submit" class="b-btn-primary">Filter</button>
                    @if(request('search') || request('kategori') || request('tanggal') || request('layanan') || request('pengunggah'))
                        <a href="{{ route('berkas.index', request('layanan') ? ['layanan' => request('layanan'), 'kategori' => request('kategori')] : []) }}" class="b-btn-reset">Reset</a>
                    @endif
                </div>
            </form>
        </div>

        <div class="berkas-table-wrap">
            <table class="berkas-table">
                <thead>
                    <tr>
                        <th style="width: 48px;">File</th>
                        <th style="width: 36%;">Info Berkas</th>
                        <th style="width: 22%;">Pengunggah</th>
                        <th style="width: 15%;">Tanggal</th>
                        <th style="width: 19%; text-align: right;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($berkas as $item)
                        @php
                            $ext = strtolower($item->tipe_file);
                            $bgClass = 'bg-def';
                            if ($ext === 'pdf') $bgClass = 'bg-pdf';
                            elseif (in_array($ext, ['jpg', 'jpeg', 'png'])) $bgClass = 'bg-img';
                            elseif (in_array($ext, ['doc', 'docx', 'xls', 'xlsx'])) $bgClass = 'bg-doc';

                            $pengajuInfo = null;
                            if (strpos($item->nama_berkas, '[') === 0 && strpos($item->nama_berkas, '] ') !== false) {
                                $parts = explode('] ', $item->nama_berkas);
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
                            <td>
                                <div class="file-icon-box {{ $bgClass }}">{{ strtoupper(substr($ext, 0, 3)) }}</div>
                            </td>
                            <td>
                                <div style="font-weight: 700; color: #003B64; font-size: 13px; margin-bottom: 4px; word-break: break-word;">{{ $item->nama_berkas }}</div>
                                <div style="display: flex; gap: 6px; align-items: center; flex-wrap: wrap;">
                                    <span class="b-badge b-badge--cat">{{ $item->kategori ?? 'Umum' }}</span>
                                    @if($item->is_ptsp || $item->uploaded_by_role === 'satu_pintu' || str_contains(strtolower((string)$item->kategori), 'ptsp'))
                                        <span class="b-badge b-badge--ptsp">PTSP / Instansi</span>
                                    @else
                                        <span class="b-badge b-badge--cat">Pemohon</span>
                                    @endif
                                    <span style="font-size: 11px; color: #64748B;">{{ $item->ukuran_file }}</span>
                                </div>
                            </td>
                            <td>
                                <div style="font-weight: 600; color: #0F172A;">{{ $finalName }}</div>
                                <div style="font-size: 11px; color: #64748B;">PMH{{ str_pad($item->user->id ?? 0, 3, '0', STR_PAD_LEFT) }}</div>
                            </td>
                            <td style="white-space: nowrap; color:#334155; font-size:12px;">
                                {{ $item->created_at->format('d M Y') }}<br>
                                <span style="font-size: 11px; color: #64748B;">{{ $item->created_at->format('H:i') }} WIB</span>
                            </td>
                            <td style="text-align: right;">
                                <div class="b-actions">
                                    <a href="{{ route('berkas.preview', $item->id) }}" target="_blank" class="b-act-btn b-act-view">Lihat</a>
                                    <a href="{{ route('berkas.download', $item->id) }}" class="b-act-btn b-act-dl">Unduh</a>
                                    @if(!Auth::user()->isDinasPu() && !Auth::user()->isDinasPutr() && !Auth::user()->isSatuPintu())
                                        <form action="{{ route('berkas.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus berkas ini?');" style="margin: 0;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="b-act-btn b-act-del">Hapus</button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align: center; padding: 40px 20px; color: #64748B;">
                                Belum ada berkas manual PTSP / Instansi yang tersimpan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="berkas-pag-bar">
            <span style="font-size:12px; color:#64748B;">
                Menampilkan {{ $berkas->firstItem() ?? 0 }}–{{ $berkas->lastItem() ?? 0 }} dari {{ $berkas->total() }} berkas
            </span>
            <div>
                {{ $berkas->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>

    <script>
        function toggleBerkasDrawer() {
            const drawer = document.getElementById('berkasUploadDrawer');
            if (drawer) drawer.classList.toggle('is-open');
        }
    </script>
@endsection
