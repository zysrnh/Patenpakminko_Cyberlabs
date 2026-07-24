@extends('layouts.app')

@section('title', 'Kelola Template Dokumen - PATEN PAK MIKO')
@section('page-title', 'Kelola Template Dokumen')

@section('head-extra')
<style>
    .card-custom {
        background: #ffffff;
        border-radius: var(--r-lg, 12px);
        border: 1px solid var(--line, #e2e8f0);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
        padding: 24px;
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
        gap: 12px;
        flex: 1;
    }
    
    .form-control-sm, .form-select-sm {
        padding: 8px 14px;
        border: 1.5px solid var(--line, #cbd5e1);
        border-radius: 8px;
        font-size: 13px;
        outline: none;
        transition: all 0.2s ease;
    }
    .form-control-sm:focus, .form-select-sm:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
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
        border: 1px solid var(--line, #cbd5e1);
        border-radius: 6px;
        color: #2563eb;
        font-size: 13px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #ffffff;
    }
    .page-item.active .page-link {
        background: #2563eb;
        color: white;
        border-color: #2563eb;
        font-weight: 700;
    }
    .page-item.disabled .page-link {
        color: #94a3b8;
        background: #f8fafc;
        cursor: not-allowed;
    }
    
    .btn-action {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
        border: none;
        text-decoration: none;
    }
    
    .btn-primary-custom {
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
        color: white !important;
    }
    .btn-primary-custom:hover {
        background: linear-gradient(135deg, #1d4ed8, #1e40af);
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25);
    }
    
    .table-responsive {
        overflow-x: auto;
        border-radius: 8px;
        border: 1px solid var(--line, #e2e8f0);
    }
    
    .table-custom {
        width: 100%;
        border-collapse: collapse;
        text-align: left;
        font-size: 13px;
    }
    
    .table-custom th {
        background: #f8fafc;
        color: #475569;
        font-weight: 700;
        padding: 12px 16px;
        border-bottom: 1.5px solid #e2e8f0;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-size: 11px;
    }
    
    .table-custom td {
        padding: 14px 16px;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
    }
    
    .table-custom tbody tr:hover {
        background-color: #f8fafc;
    }

    .badge-file {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 4px 8px;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
    }
    .badge-docx { background: #eff6ff; color: #1d4ed8; border: 1px solid #bfdbfe; }
    .badge-pdf { background: #fef2f2; color: #dc2626; border: 1px solid #fecaca; }
    .badge-doc { background: #f0fdf4; color: #16a34a; border: 1px solid #bbf7d0; }

    .badge-status {
        padding: 4px 10px;
        border-radius: 999px;
        font-size: 11px;
        font-weight: 700;
    }
    .badge-active { background: #dcfce7; color: #15803d; }
    .badge-inactive { background: #f3f4f6; color: #6b7280; }

    /* Modal */
    .modal-backdrop-custom {
        position: fixed;
        top: 0; left: 0; right: 0; bottom: 0;
        background: rgba(15, 23, 42, 0.6);
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
        border-radius: 14px;
        width: 100%;
        max-width: 600px;
        box-shadow: 0 20px 25px -5px rgba(0,0,0,0.2);
        overflow: hidden;
        animation: modalSlide 0.2s cubic-bezier(0.16, 1, 0.3, 1);
    }
    @keyframes modalSlide {
        from { transform: translateY(16px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }
    .modal-header-custom {
        padding: 18px 24px;
        background: #f8fafc;
        border-bottom: 1px solid #e2e8f0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .modal-title-custom {
        font-size: 16px;
        font-weight: 700;
        color: #0f172a;
        margin: 0;
    }
    .modal-close-btn {
        background: none;
        border: none;
        font-size: 20px;
        color: #64748b;
        cursor: pointer;
    }
    .modal-body-custom {
        padding: 24px;
        max-height: 75vh;
        overflow-y: auto;
    }
    .modal-footer-custom {
        padding: 16px 24px;
        background: #f8fafc;
        border-top: 1px solid #e2e8f0;
        display: flex;
        justify-content: flex-end;
        gap: 10px;
    }
</style>
@endsection

@section('content')
<div class="card-custom">
    @if(session('success'))
        <div style="background: #dcfce7; color: #15803d; border: 1px solid #bbf7d0; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; font-size: 13px; font-weight: 600;">
            ✓ {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div style="background: #fef2f2; color: #dc2626; border: 1px solid #fecaca; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; font-size: 13px; font-weight: 600;">
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
            <button type="submit" class="btn-action" style="background:#e2e8f0;color:#334155;">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg> Cari
            </button>
            @if(request('search') || request('kategori'))
                <a href="{{ route('admin.templates.index') }}" class="btn-action" style="background:#f1f5f9;color:#64748b;">Reset</a>
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
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($templates as $index => $item)
                <tr>
                    <td>{{ $templates->firstItem() + $index }}</td>
                    <td>
                        <strong style="color: #0f172a;">{{ $item->nama_template }}</strong>
                        @if($item->keterangan)
                            <br><small style="color: #64748b;">{{ Str::limit($item->keterangan, 70) }}</small>
                        @endif
                    </td>
                    <td>
                        <code style="background: #f1f5f9; color: #0284c7; padding: 2px 6px; border-radius: 4px; font-size: 11px;">{{ $item->kode_template }}</code>
                    </td>
                    <td>
                        <span style="background: #e0f2fe; color: #0369a1; padding: 4px 8px; border-radius: 6px; font-weight: 600; font-size: 11px;">
                            {{ $item->kategori }}
                        </span>
                    </td>
                    <td>
                        <span class="badge-file badge-{{ $item->tipe_file }}">
                            {{ strtoupper($item->tipe_file) }}
                        </span>
                        <span style="color: #64748b; font-size: 11px; margin-left: 4px;">{{ $item->ukuran_file }}</span>
                    </td>
                    <td>
                        <form action="{{ route('admin.templates.toggle_active', $item->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="badge-status {{ $item->is_active ? 'badge-active' : 'badge-inactive' }}" style="border:none; cursor:pointer;" title="Klik untuk mengubah status">
                                {{ $item->is_active ? '● Aktif' : '○ Non-Aktif' }}
                            </button>
                        </form>
                    </td>
                    <td>
                        <div style="display: flex; gap: 6px;">
                            <a href="{{ route('admin.templates.preview', $item->id) }}" target="_blank" class="btn-action" style="background:#f0f9ff;color:#0284c7;padding:7px 10px;" title="Pratinjau File">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                            </a>
                            <a href="{{ route('admin.templates.download', $item->id) }}" class="btn-action" style="background:#f0fdf4;color:#16a34a;padding:7px 10px;" title="Unduh File">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                            </a>
                            <button type="button" class="btn-action" style="background:#fefce8;color:#ca8a04;padding:7px 10px;" onclick='openEditModal(@json($item))' title="Edit Template">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                            </button>
                            <form action="{{ route('admin.templates.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus template {{ $item->nama_template }}?');" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-action" style="background:#fef2f2;color:#dc2626;padding:7px 10px;" title="Hapus Template">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align: center; padding: 40px; color: #64748b;">
                        Belum ada template dokumen yang didaftarkan.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top: 20px; display: flex; justify-content: space-between; align-items: center;">
        <div style="font-size: 12px; color: #64748b;">
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
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg>
                Tambah Template Dokumen
            </h3>
            <button type="button" class="modal-close-btn" onclick="closeAddModal()">&times;</button>
        </div>
        <form action="{{ route('admin.templates.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body-custom">
                <div style="margin-bottom: 14px;">
                    <label style="display:block; font-weight:700; margin-bottom:6px; font-size:13px;">Kategori Template <span style="color:red;">*</span></label>
                    <select name="kategori" id="add_kategori" class="form-select-sm" style="width:100%; font-size:13px;" required onchange="autoFillKode('add')">
                        <option value="Formulir Pertek">Formulir Pertek (Template Word PTP Utama)</option>
                        <option value="Contoh Format Requirements">Contoh Format Requirements (Acuan Persyaratan Pemohon)</option>
                        <option value="Surat Kuasa">Surat Kuasa</option>
                        <option value="Surat Pernyataan">Surat Pernyataan</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>
                <div style="margin-bottom: 14px;">
                    <label style="display:block; font-weight:700; margin-bottom:6px; font-size:13px;">Nama Template <span style="color:red;">*</span></label>
                    <input type="text" name="nama_template" id="add_nama_template" class="form-control-sm" style="width:100%;" required placeholder="Contoh: Formulir Pertek 2026 Template" oninput="autoFillKode('add')">
                </div>
                <div style="margin-bottom: 14px;">
                    <label style="display:block; font-weight:700; margin-bottom:6px; font-size:13px;">Kode Unik Template <span style="color:red;">*</span></label>
                    <input type="text" name="kode_template" id="add_kode_template" class="form-control-sm" style="width:100%;" required placeholder="Contoh: pertek_2026">
                    <small style="color:#64748b; font-size:11px;">Otomatis terisi atau gunakan huruf kecil dan garis bawah (`_`). Dipakai sistem untuk mengacu ke template ini.</small>
                </div>
                <div style="margin-bottom: 14px;">
                    <label style="display:block; font-weight:700; margin-bottom:6px; font-size:13px;">File Template (.docx, .doc, .pdf) <span style="color:red;">*</span></label>
                    <input type="file" name="file" class="form-control-sm" style="width:100%;" accept=".docx,.doc,.pdf" required>
                    <small style="color:#64748b; font-size:11px;">Maksimal ukuran file: 20 MB.</small>
                </div>
                <div>
                    <label style="display:block; font-weight:700; margin-bottom:6px; font-size:13px;">Keterangan / Catatan</label>
                    <textarea name="keterangan" class="form-control-sm" style="width:100%; height:80px; resize:none;" placeholder="Penjelasan kegunaan template..."></textarea>
                </div>
            </div>
            <div class="modal-footer-custom">
                <button type="button" class="btn-action" style="background:#e2e8f0; color:#475569;" onclick="closeAddModal()">Batal</button>
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
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                Edit / Ganti File Template
            </h3>
            <button type="button" class="modal-close-btn" onclick="closeEditModal()">&times;</button>
        </div>
        <form id="editForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-body-custom">
                <div style="margin-bottom: 14px;">
                    <label style="display:block; font-weight:700; margin-bottom:6px; font-size:13px;">Nama Template <span style="color:red;">*</span></label>
                    <input type="text" id="edit_nama_template" name="nama_template" class="form-control-sm" style="width:100%;" required>
                </div>
                <div style="margin-bottom: 14px;">
                    <label style="display:block; font-weight:700; margin-bottom:6px; font-size:13px;">Kode Unik Template <span style="color:red;">*</span></label>
                    <input type="text" id="edit_kode_template" name="kode_template" class="form-control-sm" style="width:100%;" required>
                </div>
                <div style="margin-bottom: 14px;">
                    <label style="display:block; font-weight:700; margin-bottom:6px; font-size:13px;">Kategori Template <span style="color:red;">*</span></label>
                    <select id="edit_kategori" name="kategori" class="form-select-sm" style="width:100%; font-size:13px;" required>
                        <option value="Formulir Pertek">Formulir Pertek (Template Word PTP Utama)</option>
                        <option value="Contoh Format Requirements">Contoh Format Requirements (Acuan Persyaratan Pemohon)</option>
                        <option value="Surat Kuasa">Surat Kuasa</option>
                        <option value="Surat Pernyataan">Surat Pernyataan</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>
                <div style="margin-bottom: 14px;">
                    <label style="display:block; font-weight:700; margin-bottom:6px; font-size:13px;">Ganti File Template (Opsional)</label>
                    <input type="file" name="file" class="form-control-sm" style="width:100%;" accept=".docx,.doc,.pdf">
                    <small style="color:#64748b; font-size:11px;">Biarkan kosong jika tidak ingin mengganti file fisik template.</small>
                </div>
                <div>
                    <label style="display:block; font-weight:700; margin-bottom:6px; font-size:13px;">Keterangan / Catatan</label>
                    <textarea id="edit_keterangan" name="keterangan" class="form-control-sm" style="width:100%; height:80px; resize:none;"></textarea>
                </div>
            </div>
            <div class="modal-footer-custom">
                <button type="button" class="btn-action" style="background:#e2e8f0; color:#475569;" onclick="closeEditModal()">Batal</button>
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
