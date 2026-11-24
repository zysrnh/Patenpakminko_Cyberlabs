@extends('layouts.app')

@section('title', 'Kelola Template Dokumen - PATEN PAK MIKO')
@section('page-title', 'Kelola Template Dokumen')

@section('extra-styles')
    @keyframes tplFadeUp {
        from { opacity: 0; transform: translateY(5px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .tpl-hero {
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
        animation: tplFadeUp .2s cubic-bezier(0.22, 1, 0.36, 1) both;
    }
    .tpl-hero-title { font-size: 17px; font-weight: 800; color: #003B64; letter-spacing: -0.02em; margin: 0 0 2px; }
    .tpl-hero-sub { font-size: 12.5px; color: #64748B; margin: 0; }
    .tpl-add-btn {
        background: #003B64;
        color: #FFFFFF;
        border: none;
        border-radius: 4px;
        padding: 8px 14px;
        font-family: inherit;
        font-size: 12.5px;
        font-weight: 700;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .tpl-add-btn:hover { background: #218AC9; }

    .tpl-panel {
        background: #FFFFFF;
        border: 1px solid #D6E4EF;
        border-radius: 4px;
        overflow: hidden;
        animation: tplFadeUp .24s cubic-bezier(0.22, 1, 0.36, 1) .04s both;
    }
    .tpl-filter-bar {
        padding: 12px 16px;
        background: #F8FAFC;
        border-bottom: 1px solid #E8F0F6;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        flex-wrap: wrap;
    }
    .tpl-filter-form {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
        flex: 1;
    }
    .tpl-input, .tpl-select {
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
    .tpl-input:focus, .tpl-select:focus { border-color: #218AC9; }
    .tpl-btn-filter {
        height: 34px;
        padding: 0 13px;
        border: 1px solid #CBD5E1;
        border-radius: 4px;
        background: #FFFFFF;
        color: #003B64;
        font-family: inherit;
        font-size: 12px;
        font-weight: 700;
        cursor: pointer;
    }
    .tpl-btn-filter:hover { background: #E3F0F9; border-color: #218AC9; }
    .tpl-btn-reset {
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

    .tpl-table-wrap { width: 100%; overflow-x: auto; }
    .tpl-table {
        width: 100%;
        border-collapse: collapse;
        table-layout: fixed;
    }
    .tpl-table th {
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
    .tpl-table td {
        padding: 11px 12px;
        border-bottom: 1px solid #EFF4F8;
        vertical-align: middle;
        font-size: 12.5px;
    }
    .tpl-table tbody tr:hover { background: #F8FAFC; }

    .tpl-name { font-weight: 700; color: #003B64; font-size: 13px; display: block; word-break: break-word; }
    .tpl-desc { font-size: 11px; color: #64748B; margin-top: 2px; display: block; }
    .tpl-code {
        display: inline-block;
        margin-top: 4px;
        background: #F1F5F9;
        color: #0284C7;
        border: 1px solid #CBD5E1;
        padding: 1px 6px;
        border-radius: 4px;
        font-family: 'DM Mono', monospace;
        font-size: 10.5px;
        font-weight: 600;
        max-width: 100%;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    .tpl-cat-badge {
        display: inline-block;
        padding: 3px 8px;
        border-radius: 4px;
        background: #E3F0F9;
        color: #003B64;
        border: 1px solid #BFD9EC;
        font-size: 11px;
        font-weight: 700;
        max-width: 100%;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    .badge-file {
        display: inline-block;
        padding: 2px 6px;
        border-radius: 4px;
        font-size: 10.5px;
        font-weight: 800;
        text-transform: uppercase;
    }
    .badge-docx { background: #EFF6FF; color: #1E40AF; border: 1px solid #BFDBFE; }
    .badge-pdf  { background: #FEF2F2; color: #DC2626; border: 1px solid #FECACA; }
    .badge-doc  { background: #DCFCE7; color: #15803D; border: 1px solid #BBF7D0; }

    .badge-status {
        padding: 4px 9px;
        border-radius: 4px;
        font-size: 11px;
        font-weight: 700;
        border: 1px solid transparent;
        cursor: pointer;
        white-space: nowrap;
    }
    .badge-active   { background: #DCFCE7; color: #166534; border-color: #BBF7D0; }
    .badge-inactive { background: #F1F5F9; color: #64748B; border-color: #CBD5E1; }

    .tpl-actions {
        display: inline-flex;
        align-items: center;
        justify-content: flex-end;
        gap: 4px;
    }
    .tpl-icon-btn {
        width: 28px;
        height: 28px;
        border-radius: 4px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        border: 1px solid transparent;
        text-decoration: none;
    }
    .tpl-icon-view { background: #EFF6FF; color: #0284C7; border-color: #BFDBFE; }
    .tpl-icon-view:hover { background: #218AC9; color: #FFFFFF; }
    .tpl-icon-dl   { background: #DCFCE7; color: #166534; border-color: #BBF7D0; }
    .tpl-icon-dl:hover { background: #16A34A; color: #FFFFFF; }
    .tpl-icon-edit { background: #FEF3C7; color: #B45309; border-color: #FDE68A; }
    .tpl-icon-edit:hover { background: #D97706; color: #FFFFFF; }
    .tpl-icon-del  { background: #FEF2F2; color: #DC2626; border-color: #FECACA; }
    .tpl-icon-del:hover { background: #DC2626; color: #FFFFFF; }

    /* Pagination */
    .tpl-pag-bar {
        padding: 12px 16px;
        background: #F8FAFC;
        border-top: 1px solid #E8F0F6;
        display: flex;
        justify-content: space-between;
        align-items: center;
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

    /* Flat Modals */
    .modal-backdrop-custom {
        position: fixed;
        inset: 0;
        background: rgba(15, 23, 42, 0.55);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 9999;
        padding: 16px;
    }
    .modal-backdrop-custom.active { display: flex; }
    .modal-box {
        background: #FFFFFF;
        border-radius: 4px;
        width: 100%;
        max-width: 520px;
        overflow: hidden;
        border: 1px solid #CBD5E1;
        animation: tplFadeUp .18s ease-out both;
    }
    .modal-header-custom {
        padding: 13px 18px;
        background: #003B64;
        color: #FFFFFF;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .modal-title-custom { font-size: 14.5px; font-weight: 700; margin: 0; color: #FFFFFF; }
    .modal-close-btn {
        background: rgba(255,255,255,0.14);
        border: 1px solid rgba(255,255,255,0.22);
        border-radius: 4px;
        width: 26px;
        height: 26px;
        font-size: 16px;
        color: #FFFFFF;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    .modal-body-custom { padding: 18px; max-height: 75vh; overflow-y: auto; }
    .modal-footer-custom {
        padding: 12px 18px;
        background: #F8FAFC;
        border-top: 1px solid #E8F0F6;
        display: flex;
        justify-content: flex-end;
        gap: 8px;
    }
    .m-label { display: block; font-weight: 700; margin-bottom: 5px; font-size: 12px; color: #003B64; }

    @media (max-width: 1024px) {
        .tpl-table { table-layout: auto; min-width: 720px; }
    }
    @media (prefers-reduced-motion: reduce) {
        .tpl-hero, .tpl-panel, .modal-box { animation: none !important; }
    }
@endsection

@section('content')
<div class="tpl-hero">
    <div>
        <h1 class="tpl-hero-title">Kelola Template Dokumen</h1>
        <p class="tpl-hero-sub">Kelola master template Word/PDF untuk formulir permohonan dan acuan berkas.</p>
    </div>
    <button type="button" class="tpl-add-btn" onclick="openAddModal()">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg>
        <span>Tambah Template</span>
    </button>
</div>

<div class="tpl-panel">
    <div class="tpl-filter-bar">
        <form action="{{ route('admin.templates.index') }}" method="GET" class="tpl-filter-form">
            <input type="text" name="search" class="tpl-input" style="flex:1; min-width:190px; max-width:300px;" placeholder="Cari nama atau kode template..." value="{{ request('search') }}">
            <select name="kategori" class="tpl-select" onchange="this.form.submit()">
                <option value="">Semua Kategori</option>
                @foreach($kategoriList as $kat)
                    <option value="{{ $kat }}" {{ request('kategori') == $kat ? 'selected' : '' }}>{{ $kat }}</option>
                @endforeach
            </select>
            <button type="submit" class="tpl-btn-filter">Cari</button>
            @if(request('search') || request('kategori'))
                <a href="{{ route('admin.templates.index') }}" class="tpl-btn-reset">Reset</a>
            @endif
        </form>
        <span style="font-size:12px; font-weight:700; color:#475569;">{{ $templates->total() }} Template</span>
    </div>

    <div class="tpl-table-wrap">
        <table class="tpl-table">
            <thead>
                <tr>
                    <th style="width: 44px; text-align:center;">No</th>
                    <th style="width: 36%;">Template &amp; Kode</th>
                    <th style="width: 20%;">Kategori</th>
                    <th style="width: 14%;">Format</th>
                    <th style="width: 12%; text-align: center;">Status</th>
                    <th style="width: 18%; text-align: right;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($templates as $index => $item)
                    <tr>
                        <td style="text-align:center; font-weight: 700; color: #64748B;">{{ $templates->firstItem() + $index }}</td>
                        <td>
                            <span class="tpl-name">{{ $item->nama_template }}</span>
                            @if($item->keterangan)
                                <span class="tpl-desc">{{ Str::limit($item->keterangan, 60) }}</span>
                            @endif
                            <code class="tpl-code" title="{{ $item->kode_template }}">{{ $item->kode_template }}</code>
                        </td>
                        <td>
                            <span class="tpl-cat-badge" title="{{ $item->kategori }}">{{ $item->kategori }}</span>
                        </td>
                        <td style="white-space: nowrap;">
                            <span class="badge-file badge-{{ $item->tipe_file }}">{{ strtoupper($item->tipe_file) }}</span>
                            <span style="color: #64748B; font-size: 11px; margin-left: 4px;">{{ $item->ukuran_file }}</span>
                        </td>
                        <td style="text-align: center;">
                            <form action="{{ route('admin.templates.toggle_active', $item->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="badge-status {{ $item->is_active ? 'badge-active' : 'badge-inactive' }}" title="Klik untuk ubah status">
                                    {{ $item->is_active ? 'Aktif' : 'Non-Aktif' }}
                                </button>
                            </form>
                        </td>
                        <td style="text-align: right;">
                            <div class="tpl-actions">
                                <a href="{{ route('admin.templates.preview', $item->id) }}" target="_blank" class="tpl-icon-btn tpl-icon-view" title="Lihat">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                </a>
                                <a href="{{ route('admin.templates.download', $item->id) }}" class="tpl-icon-btn tpl-icon-dl" title="Unduh">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                                </a>
                                <button type="button" class="tpl-icon-btn tpl-icon-edit" onclick='openEditModal(@json($item))' title="Edit">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                </button>
                                <form action="{{ route('admin.templates.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus template {{ $item->nama_template }}?');" style="display:inline; margin:0;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="tpl-icon-btn tpl-icon-del" title="Hapus">
                                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 36px; color: #64748B;">
                            Belum ada template dokumen.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="tpl-pag-bar">
        <div style="font-size: 12px; color: #64748B; font-weight: 500;">
            Menampilkan {{ $templates->firstItem() ?? 0 }}–{{ $templates->lastItem() ?? 0 }} dari {{ $templates->total() }} template
        </div>
        <div>
            {{ $templates->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>

<!-- Modal Tambah Template -->
<div id="addModal" class="modal-backdrop-custom" onclick="if(event.target === this) closeAddModal()">
    <div class="modal-box">
        <div class="modal-header-custom">
            <h3 class="modal-title-custom">Tambah Template Dokumen</h3>
            <button type="button" class="modal-close-btn" onclick="closeAddModal()">&times;</button>
        </div>
        <form action="{{ route('admin.templates.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body-custom">
                <div style="margin-bottom: 12px;">
                    <label class="m-label">Kategori Template <span style="color:#DC2626;">*</span></label>
                    <select name="kategori" id="add_kategori" class="tpl-select" style="width:100%;" required onchange="autoFillKode('add')">
                        <option value="Formulir Pertek">Formulir Pertek (Template Word PTP)</option>
                        <option value="Contoh Format Requirements">Contoh Format Persyaratan Pemohon</option>
                        <option value="Surat Kuasa">Surat Kuasa</option>
                        <option value="Surat Pernyataan">Surat Pernyataan</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>
                <div style="margin-bottom: 12px;">
                    <label class="m-label">Nama Template <span style="color:#DC2626;">*</span></label>
                    <input type="text" name="nama_template" id="add_nama_template" class="tpl-input" style="width:100%;" required placeholder="Contoh: Formulir Pertek 2026" oninput="autoFillKode('add')">
                </div>
                <div style="margin-bottom: 12px;">
                    <label class="m-label">Kode Unik Template <span style="color:#DC2626;">*</span></label>
                    <input type="text" name="kode_template" id="add_kode_template" class="tpl-input" style="width:100%; font-family:monospace;" required placeholder="contoh: pertek_2026">
                </div>
                <div style="margin-bottom: 12px;">
                    <label class="m-label">File Template (.docx, .doc, .pdf, Maks 20MB) <span style="color:#DC2626;">*</span></label>
                    <input type="file" name="file" class="tpl-input" style="width:100%; padding:4px 8px;" accept=".docx,.doc,.pdf" required>
                </div>
                <div>
                    <label class="m-label">Keterangan (Opsional)</label>
                    <textarea name="keterangan" class="tpl-input" style="width:100%; height:68px; padding:8px 10px; resize:none;" placeholder="Penjelasan singkat kegunaan template..."></textarea>
                </div>
            </div>
            <div class="modal-footer-custom">
                <button type="button" class="tpl-btn-filter" onclick="closeAddModal()">Batal</button>
                <button type="submit" class="tpl-add-btn">Simpan Template</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit Template -->
<div id="editModal" class="modal-backdrop-custom" onclick="if(event.target === this) closeEditModal()">
    <div class="modal-box">
        <div class="modal-header-custom">
            <h3 class="modal-title-custom">Edit / Ganti File Template</h3>
            <button type="button" class="modal-close-btn" onclick="closeEditModal()">&times;</button>
        </div>
        <form id="editForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-body-custom">
                <div style="margin-bottom: 12px;">
                    <label class="m-label">Nama Template <span style="color:#DC2626;">*</span></label>
                    <input type="text" id="edit_nama_template" name="nama_template" class="tpl-input" style="width:100%;" required>
                </div>
                <div style="margin-bottom: 12px;">
                    <label class="m-label">Kode Unik Template <span style="color:#DC2626;">*</span></label>
                    <input type="text" id="edit_kode_template" name="kode_template" class="tpl-input" style="width:100%; font-family:monospace;" required>
                </div>
                <div style="margin-bottom: 12px;">
                    <label class="m-label">Kategori Template <span style="color:#DC2626;">*</span></label>
                    <select id="edit_kategori" name="kategori" class="tpl-select" style="width:100%;" required>
                        <option value="Formulir Pertek">Formulir Pertek (Template Word PTP)</option>
                        <option value="Contoh Format Requirements">Contoh Format Persyaratan Pemohon</option>
                        <option value="Surat Kuasa">Surat Kuasa</option>
                        <option value="Surat Pernyataan">Surat Pernyataan</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>
                <div style="margin-bottom: 12px;">
                    <label class="m-label">Ganti File Template (Opsional)</label>
                    <input type="file" name="file" class="tpl-input" style="width:100%; padding:4px 8px;" accept=".docx,.doc,.pdf">
                    <small style="color:#64748B; font-size:11px; margin-top:3px; display:block;">Kosongkan jika tidak ingin mengganti file fisik.</small>
                </div>
                <div>
                    <label class="m-label">Keterangan</label>
                    <textarea id="edit_keterangan" name="keterangan" class="tpl-input" style="width:100%; height:68px; padding:8px 10px; resize:none;"></textarea>
                </div>
            </div>
            <div class="modal-footer-custom">
                <button type="button" class="tpl-btn-filter" onclick="closeEditModal()">Batal</button>
                <button type="submit" class="tpl-add-btn">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function autoFillKode(prefix) {
        const kat = document.getElementById(prefix + '_kategori').value;
        const nama = document.getElementById(prefix + '_nama_template').value;
        const kodeInput = document.getElementById(prefix + '_kode_template');

        if (kat === 'Formulir Pertek') {
            kodeInput.value = 'pertek_2026';
        } else if (nama.trim() !== '') {
            kodeInput.value = nama.toLowerCase()
                .replace(/[^a-z0-9]/g, '_')
                .replace(/_+/g, '_')
                .replace(/^_+|_+$/g, '');
        }
    }

    function openAddModal() { document.getElementById('addModal').classList.add('active'); }
    function closeAddModal() { document.getElementById('addModal').classList.remove('active'); }

    function openEditModal(item) {
        document.getElementById('editForm').action = "{{ url('/admin/templates') }}/" + item.id;
        document.getElementById('edit_nama_template').value = item.nama_template;
        document.getElementById('edit_kode_template').value = item.kode_template;
        document.getElementById('edit_kategori').value = item.kategori;
        document.getElementById('edit_keterangan').value = item.keterangan || '';
        document.getElementById('editModal').classList.add('active');
    }
    function closeEditModal() { document.getElementById('editModal').classList.remove('active'); }

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeAddModal();
            closeEditModal();
        }
    });
</script>
@endsection
