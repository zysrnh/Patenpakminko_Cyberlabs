@extends('layouts.app')

@section('title', 'Kelola Template Dokumen - PATEN PAK MIKO')
@section('page-title', 'Kelola Template Dokumen')

@section('head-extra')
<style>
    .card-custom {
        background: #ffffff;
        border-radius: 6px;
        border: 1px solid #E2E8F0;
        box-shadow: 0 2px 6px rgba(0,38,66,0.02);
        padding: 20px;
        margin-bottom: 24px;
    }
    
    .filters-bar {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }
    
    .search-filter-group {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        flex: 1;
        align-items: center;
    }
    
    .form-control-sm, .form-select-sm {
        padding: 6px 12px;
        border: 1.5px solid #CBD5E1;
        border-radius: 4px;
        font-size: 12.5px;
        outline: none;
        transition: all 0.2s ease;
        height: 36px;
        box-sizing: border-box;
        color: #0F172A;
    }
    .form-control-sm:focus, .form-select-sm:focus {
        border-color: #218AC9;
    }

    /* Pagination Fix */
    .pagination {
        display: flex;
        padding-left: 0;
        list-style: none;
        gap: 4px;
        flex-wrap: wrap;
        margin: 0;
        align-items: center;
    }
    .page-item .page-link {
        padding: 6px 12px;
        border: 1px solid #CBD5E1;
        border-radius: 4px;
        color: #218AC9;
        font-size: 12px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #ffffff;
    }
    .page-item.active .page-link {
        background: #218AC9;
        color: white;
        border-color: #218AC9;
        font-weight: 700;
    }
    .page-item.disabled .page-link {
        color: #94A3B8;
        background: #F8FAFC;
        cursor: not-allowed;
    }
    
    .btn-action {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        padding: 6px 14px;
        border-radius: 4px;
        font-size: 12.5px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.18s ease;
        border: none;
        text-decoration: none;
        height: 36px;
        box-sizing: border-box;
    }
    
    .btn-primary-custom {
        background: #218AC9;
        color: white !important;
    }
    .btn-primary-custom:hover {
        background: #1A74AB;
    }
    
    .table-responsive {
        overflow-x: auto;
        border-radius: 6px;
        border: 1px solid #E2E8F0;
    }
    
    .table-custom {
        width: 100%;
        border-collapse: collapse;
        text-align: left;
        font-size: 13px;
    }
    
    .table-custom th {
        background: #F8FAFC;
        color: #475569;
        font-weight: 800;
        padding: 10px 14px;
        border-bottom: 1.5px solid #E2E8F0;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        font-size: 11px;
    }
    
    .table-custom td {
        padding: 12px 14px;
        border-bottom: 1px solid #F1F5F9;
        vertical-align: middle;
    }
    
    .table-custom tbody tr:hover {
        background-color: #F8FAFC;
    }

    .badge-file {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 3px 8px;
        border-radius: 4px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
    }
    .badge-docx { background: #EFF6FF; color: #1E40AF; border: 1px solid #BFDBFE; }
    .badge-pdf { background: #FEF2F2; color: #DC2626; border: 1px solid #FECACA; }
    .badge-doc { background: #DCFCE7; color: #15803D; border: 1px solid #86EFAC; }

    .badge-status {
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 11px;
        font-weight: 700;
    }
    .badge-active { background: #DCFCE7; color: #15803D; border: 1px solid #86EFAC; }
    .badge-inactive { background: #F1F5F9; color: #64748B; border: 1px solid #CBD5E1; }

    /* Modal */
    .modal-backdrop-custom {
        position: fixed;
        top: 0; left: 0; right: 0; bottom: 0;
        background: rgba(0, 38, 66, 0.6);
        backdrop-filter: blur(4px);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 9999;
        padding: 16px;
    }
    .modal-backdrop-custom.active {
        display: flex;
    }
    .modal-box {
        background: white;
        border-radius: 6px;
        width: 100%;
        max-width: 580px;
        box-shadow: 0 12px 32px rgba(0,0,0,0.2);
        overflow: hidden;
        animation: modalSlide 0.2s cubic-bezier(0.16, 1, 0.3, 1);
        border: 1px solid #E2E8F0;
    }
    @keyframes modalSlide {
        from { transform: translateY(16px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }
    .modal-header-custom {
        padding: 14px 20px;
        background: #F8FAFC;
        border-bottom: 1px solid #E2E8F0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .modal-title-custom {
        font-size: 15px;
        font-weight: 800;
        color: #003B64;
        margin: 0;
    }
    .modal-close-btn {
        background: none;
        border: none;
        font-size: 20px;
        color: #64748B;
        cursor: pointer;
    }
    .modal-body-custom {
        padding: 20px;
        max-height: 75vh;
        overflow-y: auto;
    }
    .modal-footer-custom {
        padding: 14px 20px;
        background: #F8FAFC;
        border-top: 1px solid #E2E8F0;
        display: flex;
        justify-content: flex-end;
        gap: 10px;
    }
</style>
@endsection

@section('content')
<!-- Header Card -->
<div style="background: #ffffff; border: 1px solid #E2E8F0; border-radius: 6px; padding: 18px 24px; margin-bottom: 20px; box-shadow: 0 2px 6px rgba(0,38,66,0.02); display: flex; align-items: center; justify-content: space-between; gap: 16px; flex-wrap: wrap;">
    <div>
        <div style="font-size: 12px; color: #64748B; margin-bottom: 4px; display: flex; align-items: center; gap: 6px;">
            <a href="{{ route('dashboard') }}" style="color: #218AC9; text-decoration: none; font-weight: 600;">Dashboard</a>
            <span>›</span>
            <span style="color: #64748B;">Kelola Template Dokumen</span>
        </div>
        <h1 style="font-size: 19px; font-weight: 800; color: #003B64; letter-spacing: -0.02em; margin: 0;">
            Kelola Template Dokumen
        </h1>
        <p style="font-size: 12.5px; color: #64748B; margin: 4px 0 0;">Kelola master file template Word/PDF pendukung permohonan tata ruang & pertanahan.</p>
    </div>
</div>

<div class="card-custom">
    @if(session('success'))
        <div style="background: #DCFCE7; color: #15803D; border: 1px solid #86EFAC; padding: 10px 14px; border-radius: 4px; margin-bottom: 20px; font-size: 13px; font-weight: 700;">
            ✓ {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div style="background: #FEF2F2; color: #DC2626; border: 1px solid #FECACA; padding: 10px 14px; border-radius: 4px; margin-bottom: 20px; font-size: 13px; font-weight: 700;">
            ⚠️ {{ session('error') }}
        </div>
    @endif

    <div class="filters-bar">
        <form action="{{ route('admin.templates.index') }}" method="GET" class="search-filter-group">
            <input type="text" name="search" class="form-control-sm" style="min-width: 220px;" placeholder="Cari nama / kode / keterangan..." value="{{ request('search') }}">
            <select name="kategori" class="form-select-sm" onchange="this.form.submit()">
                <option value="">-- Semua Kategori --</option>
                @foreach($kategoriList as $kat)
                    <option value="{{ $kat }}" {{ request('kategori') == $kat ? 'selected' : '' }}>{{ $kat }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn-action" style="background:#F1F5F9; color:#475569; border:1px solid #CBD5E1;">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg> Cari
            </button>
            @if(request('search') || request('kategori'))
                <a href="{{ route('admin.templates.index') }}" class="btn-action" style="background:#F8FAFC; color:#64748B; border:1px solid #CBD5E1;">Reset</a>
            @endif
        </form>

        <button type="button" class="btn-action btn-primary-custom" onclick="openAddModal()">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg> Tambah Template Dokumen
        </button>
    </div>

    <div class="table-responsive">
        <table class="table-custom">
            <thead>
                <tr>
                    <th style="width: 40px;">No</th>
                    <th>Nama Template</th>
                    <th>Kode Template</th>
                    <th>Kategori</th>
                    <th>Format & Ukuran</th>
                    <th style="text-align: center;">Status</th>
                    <th style="text-align: center; width: 140px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($templates as $index => $item)
                <tr>
                    <td style="font-weight: 600; color: #64748B;">{{ $templates->firstItem() + $index }}</td>
                    <td>
                        <strong style="color: #003B64; font-size: 13px;">{{ $item->nama_template }}</strong>
                        @if($item->keterangan)
                            <div style="color: #64748B; font-size: 11.5px; margin-top: 2px;">{{ Str::limit($item->keterangan, 70) }}</div>
                        @endif
                    </td>
                    <td>
                        <code style="background: #F1F5F9; color: #0284C7; border: 1px solid #BAE6FD; padding: 3px 8px; border-radius: 4px; font-size: 11.5px; font-weight: 700; white-space: nowrap;">{{ $item->kode_template }}</code>
                    </td>
                    <td>
                        <span style="background: #EFF6FF; color: #1E40AF; border: 1px solid #BFDBFE; padding: 4px 8px; border-radius: 4px; font-weight: 700; font-size: 11px; white-space: nowrap; display: inline-block;">
                            {{ $item->kategori }}
                        </span>
                    </td>
                    <td>
                        <span class="badge-file badge-{{ $item->tipe_file }}">
                            {{ strtoupper($item->tipe_file) }}
                        </span>
                        <span style="color: #64748B; font-size: 11px; margin-left: 4px;">{{ $item->ukuran_file }}</span>
                    </td>
                    <td style="text-align: center;">
                        <form action="{{ route('admin.templates.toggle_active', $item->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="badge-status {{ $item->is_active ? 'badge-active' : 'badge-inactive' }}" style="border:none; cursor:pointer;" title="Klik untuk mengubah status">
                                {{ $item->is_active ? '● Aktif' : '○ Non-Aktif' }}
                            </button>
                        </form>
                    </td>
                    <td style="text-align: center;">
                        <div style="display: flex; gap: 4px; justify-content: center;">
                            <a href="{{ route('admin.templates.preview', $item->id) }}" target="_blank" class="btn-action" style="background:#EFF6FF; color:#0284C7; border:1px solid #BFDBFE; padding:0; width:30px; height:30px;" title="Pratinjau File">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                            </a>
                            <a href="{{ route('admin.templates.download', $item->id) }}" class="btn-action" style="background:#DCFCE7; color:#15803D; border:1px solid #86EFAC; padding:0; width:30px; height:30px;" title="Unduh File">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                            </a>
                            <button type="button" class="btn-action" style="background:#FEF3C7; color:#D97706; border:1px solid #FDE68A; padding:0; width:30px; height:30px;" onclick='openEditModal(@json($item))' title="Edit Template">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                            </button>
                            <form action="{{ route('admin.templates.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus template {{ $item->nama_template }}?');" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-action" style="background:#DC2626; color:#ffffff; border:1px solid #DC2626; padding:0; width:30px; height:30px;" title="Hapus Template">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align: center; padding: 40px; color: #64748B;">
                        Belum ada template dokumen yang didaftarkan.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top: 16px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px;">
        <div style="font-size: 12px; color: #64748B; font-weight: 500;">
            Menampilkan {{ $templates->firstItem() ?? 0 }} - {{ $templates->lastItem() ?? 0 }} dari total {{ $templates->total() }} template
        </div>
        <div>
            {{ $templates->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>

<!-- Modal Tambah Template -->
<div id="addModal" class="modal-backdrop-custom">
    <div class="modal-box">
        <div class="modal-header-custom">
            <h3 class="modal-title-custom" style="display:flex; align-items:center; gap:8px;">
                <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="#218AC9" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg>
                Tambah Template Dokumen
            </h3>
            <button type="button" class="modal-close-btn" onclick="closeAddModal()">&times;</button>
        </div>
        <form action="{{ route('admin.templates.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body-custom">
                <div style="margin-bottom: 14px;">
                    <label style="display:block; font-weight:700; margin-bottom:6px; font-size:12.5px; color:#003B64;">Kategori Template <span style="color:#DC2626;">*</span></label>
                    <select name="kategori" id="add_kategori" class="form-select-sm" style="width:100%; font-size:12.5px; border-radius:4px;" required onchange="autoFillKode('add')">
                        <option value="Formulir Pertek">Formulir Pertek (Template Word PTP Utama)</option>
                        <option value="Contoh Format Requirements">Contoh Format Requirements (Acuan Persyaratan Pemohon)</option>
                        <option value="Surat Kuasa">Surat Kuasa</option>
                        <option value="Surat Pernyataan">Surat Pernyataan</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>
                <div style="margin-bottom: 14px;">
                    <label style="display:block; font-weight:700; margin-bottom:6px; font-size:12.5px; color:#003B64;">Nama Template <span style="color:#DC2626;">*</span></label>
                    <input type="text" name="nama_template" id="add_nama_template" class="form-control-sm" style="width:100%; border-radius:4px;" required placeholder="Contoh: Formulir Pertek 2026 Template" oninput="autoFillKode('add')">
                </div>
                <div style="margin-bottom: 14px;">
                    <label style="display:block; font-weight:700; margin-bottom:6px; font-size:12.5px; color:#003B64;">Kode Unik Template <span style="color:#DC2626;">*</span></label>
                    <input type="text" name="kode_template" id="add_kode_template" class="form-control-sm" style="width:100%; border-radius:4px;" required placeholder="Contoh: pertek_2026">
                    <small style="color:#64748B; font-size:11px; margin-top:4px; display:block;">Otomatis terisi atau gunakan huruf kecil dan garis bawah (`_`). Dipakai sistem untuk mengacu ke template ini.</small>
                </div>
                <div style="margin-bottom: 14px;">
                    <label style="display:block; font-weight:700; margin-bottom:6px; font-size:12.5px; color:#003B64;">File Template (.docx, .doc, .pdf) <span style="color:#DC2626;">*</span></label>
                    <input type="file" name="file" class="form-control-sm" style="width:100%; border-radius:4px;" accept=".docx,.doc,.pdf" required>
                    <small style="color:#64748B; font-size:11px; margin-top:4px; display:block;">Maksimal ukuran file: 20 MB.</small>
                </div>
                <div>
                    <label style="display:block; font-weight:700; margin-bottom:6px; font-size:12.5px; color:#003B64;">Keterangan / Catatan</label>
                    <textarea name="keterangan" class="form-control-sm" style="width:100%; height:80px; resize:none; border-radius:4px;" placeholder="Penjelasan kegunaan template..."></textarea>
                </div>
            </div>
            <div class="modal-footer-custom">
                <button type="button" class="btn-action" style="background:#F1F5F9; color:#475569; border:1px solid #CBD5E1;" onclick="closeAddModal()">Batal</button>
                <button type="submit" class="btn-action btn-primary-custom">Simpan Template</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit Template -->
<div id="editModal" class="modal-backdrop-custom">
    <div class="modal-box">
        <div class="modal-header-custom">
            <h3 class="modal-title-custom" style="display:flex; align-items:center; gap:8px;">
                <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="#218AC9" stroke-width="2.2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                Edit / Ganti File Template
            </h3>
            <button type="button" class="modal-close-btn" onclick="closeEditModal()">&times;</button>
        </div>
        <form id="editForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-body-custom">
                <div style="margin-bottom: 14px;">
                    <label style="display:block; font-weight:700; margin-bottom:6px; font-size:12.5px; color:#003B64;">Nama Template <span style="color:#DC2626;">*</span></label>
                    <input type="text" id="edit_nama_template" name="nama_template" class="form-control-sm" style="width:100%; border-radius:4px;" required>
                </div>
                <div style="margin-bottom: 14px;">
                    <label style="display:block; font-weight:700; margin-bottom:6px; font-size:12.5px; color:#003B64;">Kode Unik Template <span style="color:#DC2626;">*</span></label>
                    <input type="text" id="edit_kode_template" name="kode_template" class="form-control-sm" style="width:100%; border-radius:4px;" required>
                </div>
                <div style="margin-bottom: 14px;">
                    <label style="display:block; font-weight:700; margin-bottom:6px; font-size:12.5px; color:#003B64;">Kategori Template <span style="color:#DC2626;">*</span></label>
                    <select id="edit_kategori" name="kategori" class="form-select-sm" style="width:100%; font-size:12.5px; border-radius:4px;" required>
                        <option value="Formulir Pertek">Formulir Pertek (Template Word PTP Utama)</option>
                        <option value="Contoh Format Requirements">Contoh Format Requirements (Acuan Persyaratan Pemohon)</option>
                        <option value="Surat Kuasa">Surat Kuasa</option>
                        <option value="Surat Pernyataan">Surat Pernyataan</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>
                <div style="margin-bottom: 14px;">
                    <label style="display:block; font-weight:700; margin-bottom:6px; font-size:12.5px; color:#003B64;">Ganti File Template (Opsional)</label>
                    <input type="file" name="file" class="form-control-sm" style="width:100%; border-radius:4px;" accept=".docx,.doc,.pdf">
                    <small style="color:#64748B; font-size:11px; margin-top:4px; display:block;">Biarkan kosong jika tidak ingin mengganti file fisik template.</small>
                </div>
                <div>
                    <label style="display:block; font-weight:700; margin-bottom:6px; font-size:12.5px; color:#003B64;">Keterangan / Catatan</label>
                    <textarea id="edit_keterangan" name="keterangan" class="form-control-sm" style="width:100%; height:80px; resize:none; border-radius:4px;"></textarea>
                </div>
            </div>
            <div class="modal-footer-custom">
                <button type="button" class="btn-action" style="background:#F1F5F9; color:#475569; border:1px solid #CBD5E1;" onclick="closeEditModal()">Batal</button>
                <button type="submit" class="btn-action btn-primary-custom">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<script>
    function autoFillKode(prefix) {
        const kat = document.getElementById(prefix + '_kategori').value;
        const nama = document.getElementById(prefix + '_nama_template').value;
        const kodeInput = document.getElementById(prefix + '_kode_template');
        
        if (kat === 'Formulir Pertek') {
            kodeInput.value = 'pertek_2026';
        } else if (nama.trim() !== '') {
            // Slugify nama template
            kodeInput.value = nama.toLowerCase()
                .replace(/[^a-z0-9]/g, '_')
                .replace(/_+/g, '_')
                .replace(/^_+|_+$/g, '');
        }
    }

    function openAddModal() {
        document.getElementById('addModal').classList.add('active');
    }
    function closeAddModal() {
        document.getElementById('addModal').classList.remove('active');
    }

    function openEditModal(item) {
        document.getElementById('editForm').action = "{{ url('/admin/templates') }}/" + item.id;
        document.getElementById('edit_nama_template').value = item.nama_template;
        document.getElementById('edit_kode_template').value = item.kode_template;
        document.getElementById('edit_kategori').value = item.kategori;
        document.getElementById('edit_keterangan').value = item.keterangan || '';
        document.getElementById('editModal').classList.add('active');
    }
    function closeEditModal() {
        document.getElementById('editModal').classList.remove('active');
    }
</script>
@endsection
