@extends('layouts.app')

@section('title', 'Kelola Peta INFORMAL - PATEN PAK MIKO')
@section('page-title', 'Kelola Peta INFORMAL')

@section('head-extra')
    <!-- Leaflet CSS dimuat di head agar tidak merusak style halaman -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
@endsection

@section('extra-styles')
    /* ─── GRID CARD UTAMA ──────────────────────────────── */
    .map-cards-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 18px;
        margin-bottom: 24px;
    }

    .clean-map-card {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 6px;
        padding: 20px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        box-shadow: 0 1px 3px rgba(0,0,0,0.03);
        position: relative;
        overflow: hidden;
        transition: transform 0.15s ease, box-shadow 0.15s ease;
    }
    .clean-map-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 14px rgba(0, 34, 61, 0.07);
    }
    .clean-map-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 4px;
    }
    .clean-map-card.lp2b::before { background: #064E3B; }
    .clean-map-card.lbs::before  { background: #3B82F6; }
    .clean-map-card.lsd::before  { background: #10B981; }

    .card-top-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 12px;
    }

    .card-tag {
        font-size: 11px;
        font-weight: 800;
        padding: 3px 8px;
        border-radius: 4px;
        letter-spacing: 0.5px;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }
    .tag-lp2b { background: #D1FAE5; color: #064E3B; }
    .tag-lbs  { background: #DBEAFE; color: #1E40AF; }
    .tag-lsd  { background: #ECFDF5; color: #047857; }

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
    .status-dot.active { background: #22C55E; }
    .status-dot.inactive { background: #EF4444; }

    .card-title-text {
        font-size: 15px;
        font-weight: 700;
        color: #003B64;
        margin-bottom: 4px;
    }
    .card-desc-text {
        font-size: 12px;
        color: #64748B;
        line-height: 1.5;
        margin-bottom: 16px;
    }

    .card-info-box {
        background: #F8FAFC;
        border: 1px solid #EDF2F7;
        border-radius: 4px;
        padding: 10px 12px;
        margin-bottom: 16px;
        font-size: 11.5px;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 8px;
    }
    .info-label {
        font-size: 10px;
        color: #94A3B8;
        font-weight: 700;
        text-transform: uppercase;
        display: block;
        margin-bottom: 2px;
    }
    .info-value {
        color: #1E293B;
        font-weight: 600;
    }

    .card-btn-group {
        display: flex;
        gap: 8px;
    }
    .btn-upload-action {
        flex: 2;
        background: #218AC9;
        color: #FFFFFF;
        border: none;
        padding: 9px 12px;
        border-radius: 4px;
        font-size: 12.5px;
        font-weight: 700;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        transition: all 0.15s;
    }
    .btn-upload-action:hover {
        background: #003B64;
    }

    .btn-backup-action {
        flex: 1;
        background: #FFFFFF;
        color: #475569;
        border: 1px solid #CBD5E1;
        padding: 9px 8px;
        border-radius: 4px;
        font-size: 11.5px;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
        transition: all 0.15s;
    }
    .btn-backup-action:hover {
        background: #F1F5F9;
        color: #0F172A;
    }

    .btn-delete-action {
        flex: 1;
        background: #FEF2F2;
        color: #DC2626;
        border: 1px solid #FECACA;
        padding: 9px 8px;
        border-radius: 4px;
        font-size: 11.5px;
        font-weight: 700;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 4px;
        transition: all 0.15s;
    }
    .btn-delete-action:hover {
        background: #DC2626;
        color: #FFFFFF;
        border-color: #DC2626;
    }

    .btn-restore-action {
        flex: 1;
        background: #F0FDF4;
        color: #166534;
        border: 1px solid #BBF7D0;
        padding: 9px 10px;
        border-radius: 4px;
        font-size: 11.5px;
        font-weight: 700;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
        transition: all 0.15s;
    }
    .btn-restore-action:hover {
        background: #166534;
        color: #FFFFFF;
        border-color: #166534;
    }

    /* ─── SECTION PREVIEW PETA ─────────────────────────── */
    .preview-map-card {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 6px;
        padding: 20px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.03);
    }

    .preview-top-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
        padding-bottom: 14px;
        margin-bottom: 14px;
        border-bottom: 1px solid #F1F5F9;
    }

    .preview-title {
        font-size: 15px;
        font-weight: 700;
        color: #003B64;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .preview-filters {
        display: flex;
        align-items: center;
        gap: 16px;
        flex-wrap: wrap;
        font-size: 12px;
        font-weight: 700;
    }
    .filter-item {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        cursor: pointer;
    }

    #adminPreviewMap {
        width: 100%;
        height: 540px;
        border-radius: 4px;
        border: 1px solid #CBD5E1;
        background: #E2E8F0;
    }

    /* ─── MODAL UPLOAD ─────────────────────────────────── */
    .modal-backdrop-custom {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(15, 23, 42, 0.6);
        backdrop-filter: blur(4px);
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
        border-radius: 6px;
        width: 100%;
        max-width: 500px;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.15);
        overflow: hidden;
        border: 1px solid #E2E8F0;
        animation: popModal 0.2s cubic-bezier(0.16, 1, 0.3, 1);
    }
    @keyframes popModal {
        from { opacity: 0; transform: scale(0.95); }
        to { opacity: 1; transform: scale(1); }
    }

    .modal-head {
        background: #003B64;
        color: #FFFFFF;
        padding: 16px 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .modal-head h3 {
        font-size: 15px;
        font-weight: 700;
        margin: 0;
    }
    .modal-close-btn {
        background: transparent;
        border: none;
        color: #FFFFFF;
        font-size: 18px;
        cursor: pointer;
        opacity: 0.8;
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 28px;
        height: 28px;
        border-radius: 4px;
    }
    .modal-close-btn:hover {
        opacity: 1;
        background: rgba(255,255,255,0.15);
    }

    .modal-body {
        padding: 22px 20px;
    }

    .simple-dropzone {
        border: 2px dashed #CBD5E1;
        border-radius: 6px;
        padding: 30px 20px;
        text-align: center;
        background: #F8FAFC;
        cursor: pointer;
        transition: all 0.2s;
    }
    .simple-dropzone:hover {
        border-color: #218AC9;
        background: #F0F6FB;
    }
    .dropzone-icon {
        width: 44px;
        height: 44px;
        color: #218AC9;
        margin-bottom: 10px;
    }

    .btn-submit-modal {
        width: 100%;
        background: #003B64;
        color: #FFFFFF;
        border: none;
        padding: 12px;
        border-radius: 4px;
        font-size: 13.5px;
        font-weight: 700;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        margin-top: 16px;
        transition: background 0.15s;
    }
    .btn-submit-modal:hover {
        background: #218AC9;
    }
@endsection

@section('content')

    <!-- Header Halaman Bersih -->
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px; flex-wrap:wrap; gap:12px;">
        <div>
            <h1 style="font-size:20px; font-weight:800; color:#003B64; margin-bottom:4px;">Kelola Data Peta INFORMAL</h1>
            <p style="font-size:13px; color:#64748B;">Perbarui data peta LP2B, LBS, dan LSD secara mandiri tanpa coding. Cukup upload file GeoJSON atau Shapefile.</p>
        </div>
        <a href="{{ route('informal.index') }}" target="_blank" class="btn btn-secondary" style="font-size:12.5px; padding:9px 16px; border-radius:4px;">
            <svg style="width:15px;height:15px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
            Buka Peta Publik INFORMAL
        </a>
    </div>

    <!-- 3 Card Utama (LP2B, LBS, LSD) -->
    <div class="map-cards-container">
        @php
            $mainKeys = ['lp2b', 'lbs', 'lsd'];
        @endphp

        @foreach($mainKeys as $k)
            @if(isset($layers[$k]))
                @php $l = $layers[$k]; @endphp
                <div class="clean-map-card {{ $k }}">
                    <div>
                        <div class="card-top-row">
                            <span class="card-tag tag-{{ $k }}">{{ $l['short_name'] }}</span>
                            <span class="card-status-badge" style="color: {{ $l['exists'] ? '#166534' : '#C53030' }};">
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
                            <div style="grid-column: span 2; border-top: 1px dashed #E2E8F0; padding-top: 6px; margin-top: 2px;">
                                <span class="info-label">File Sumber Diupload</span>
                                <span class="info-value" style="font-size: 11px; color: #218AC9; word-break: break-all;">
                                    📁 {{ $l['original_filename'] }}
                                </span>
                            </div>
                            @endif
                            @if(!empty($l['latest_backup_file']))
                            <div style="grid-column: span 2; background: #FEF3C7; padding: 6px 8px; border-radius: 4px; margin-top: 2px;">
                                <span class="info-label" style="color: #92400E;">Cadangan Terakhir (File Lama)</span>
                                <span class="info-value" style="font-size: 10.5px; color: #B45309; word-break: break-all; font-family: 'DM Mono', monospace;">
                                    💾 {{ $l['latest_backup_file'] }}
                                </span>
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="card-btn-group" style="display: flex; gap: 6px; flex-wrap: wrap;">
                        <button type="button" class="btn-upload-action" onclick="openUploadModal('{{ $k }}', '{{ $l['name'] }}')" style="flex: {{ $l['exists'] ? '1.3' : '2' }};">
                            <svg style="width:14px;height:14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                            {{ $l['exists'] ? 'Ganti File' : 'Upload File' }}
                        </button>
                        @if($l['exists'])
                            <a href="{{ route('admin.informal_map.download', $k) }}" class="btn-backup-action" title="Unduh backup file data aktif ke laptop">
                                <svg style="width:13px;height:13px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                Backup
                            </a>
                            <button type="button" class="btn-delete-action" onclick="confirmDeleteLayer('{{ $k }}', '{{ $l['short_name'] }}')" title="Hapus file data dari peta aktif (otomatis dicadangkan terlebih dahulu)">
                                <svg style="width:13px;height:13px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                Hapus
                            </button>
                        @elseif(!empty($l['latest_backup_file']))
                            <form action="{{ route('admin.informal_map.restore', $k) }}" method="POST" style="flex: 1; margin: 0; display: inline-flex;" onsubmit="return confirm('Pulihkan data layer {{ $l['short_name'] }} dari cadangan terakhir ({{ $l['latest_backup_file'] }})?')">
                                @csrf
                                <button type="submit" class="btn-restore-action" style="width: 100%;" title="Pulihkan kembali dari file cadangan terakhir">
                                    <svg style="width:13px;height:13px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                                    Pulihkan
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @endif
        @endforeach
    </div>

    <!-- Section Live Preview Peta Lega & Terbuka -->
    <div class="preview-map-card">
        <div class="preview-top-bar">
            <div class="preview-title">
                <svg style="width:18px;height:18px;color:#218AC9;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><polygon points="1 6 1 22 8 18 16 22 23 18 23 2 16 6 8 2 1 6"></polygon><line x1="8" y1="2" x2="8" y2="18"></line><line x1="16" y1="6" x2="16" y2="22"></line></svg>
                Pratinjau Peta INFORMAL (Kota Sukabumi)
            </div>

            <div class="preview-filters">
                <label class="filter-item" style="color:#064E3B;">
                    <input type="checkbox" id="toggle-lp2b" checked onchange="toggleLayer('lp2b')">
                    <span style="width:12px; height:12px; background:#064E3B; display:inline-block; border-radius:2px;"></span>
                    LP2B
                </label>
                <label class="filter-item" style="color:#1E40AF;">
                    <input type="checkbox" id="toggle-lbs" checked onchange="toggleLayer('lbs')">
                    <span style="width:12px; height:12px; background:#3B82F6; display:inline-block; border-radius:2px;"></span>
                    LBS
                </label>
                <label class="filter-item" style="color:#047857;">
                    <input type="checkbox" id="toggle-lsd" checked onchange="toggleLayer('lsd')">
                    <span style="width:12px; height:12px; background:#10B981; display:inline-block; border-radius:2px;"></span>
                    LSD
                </label>
                <label class="filter-item" style="color:#003B64;">
                    <input type="checkbox" id="toggle-bounds" checked onchange="toggleLayer('sukabumi_bounds')">
                    <span style="width:12px; height:12px; border:2px dashed #003B64; display:inline-block; border-radius:2px;"></span>
                    Batas Kota
                </label>
                <button type="button" class="btn btn-sm btn-secondary" style="font-size:11.5px; padding:5px 10px;" onclick="fitSukabumi()">Fokus Sukabumi</button>
            </div>
        </div>

        <div id="adminPreviewMap"></div>
        <div style="margin-top:10px; font-size:11.5px; color:#64748B; display:flex; justify-content:space-between; flex-wrap:wrap; gap:8px;">
            <span>💡 <em>Klik salah satu poligon warna di atas untuk mengecek informasi koordinat spasial.</em></span>
            <span id="previewStatus" style="font-weight:600; color:#003B64;">Memuat layer spasial...</span>
        </div>
    </div>

    <!-- MODAL POPUP UPLOAD FILE (SUPER USER-FRIENDLY) -->
    <div id="uploadModal" class="modal-backdrop-custom" onclick="if(event.target === this) closeUploadModal()">
        <div class="modal-box-custom">
            <div class="modal-head">
                <h3 id="modalTitle">Upload File Peta</h3>
                <button type="button" class="modal-close-btn" onclick="closeUploadModal()">&times;</button>
            </div>

            <form action="{{ route('admin.informal_map.upload') }}" method="POST" enctype="multipart/form-data" id="modalUploadForm">
                @csrf
                <input type="hidden" name="layer_key" id="modalLayerKey" value="">

                <div class="modal-body">
                    <div style="font-size:13px; color:#1E293B; margin-bottom:12px;">
                        Anda akan memperbarui data untuk layer: <strong id="modalLayerName" style="color:#003B64;">-</strong>
                    </div>

                    <div class="simple-dropzone" onclick="document.getElementById('modalFileInput').click()">
                        <svg class="dropzone-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                        <div id="dropzoneMainText" style="font-size:14px; font-weight:700; color:#003B64; margin-bottom:4px;">Klik untuk memilih file</div>
                        <div style="font-size:11.5px; color:#64748B;">Bisa file <strong>.geojson</strong>, <strong>.json</strong>, atau <strong>.zip (Shapefile)</strong></div>
                        <div id="dropzoneSelectedFile" style="font-size:12px; font-weight:700; color:#218AC9; margin-top:10px; display:none; background:#E0F2FE; padding:6px 10px; border-radius:4px;"></div>
                    </div>
                    <input type="file" name="map_file" id="modalFileInput" style="display:none;" accept=".geojson,.json,.zip" required onchange="handleModalFileChange(this)">

                    <div style="background:#F0FDF4; border:1px solid #BBF7D0; border-radius:4px; padding:10px 12px; margin-top:14px; font-size:11.5px; color:#166534; line-height:1.5;">
                        🛡️ <strong>Aman & Ada Riwayatnya:</strong> File yang sedang aktif di server akan otomatis dicadangkan (di-backup) ke folder cadangan dengan nama <code>[layer]_bak_[tanggal]_[jam].geojson</code> sebelum ditimpa file baru ini.
                    </div>

                    <button type="submit" id="btnSubmitModal" class="btn-submit-modal">
                        <svg style="width:16px;height:16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Simpan & Terapkan ke Peta
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
<!-- Leaflet JS dimuat di bagian script -->
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
    });

    function initMap() {
        // Inisialisasi peta berpusat di Kota Sukabumi
        map = L.map('adminPreviewMap', {
            center: [-6.9237, 106.9287],
            zoom: 13,
            scrollWheelZoom: true
        });

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; OpenStreetMap & PATEN PAK MIKO'
        }).addTo(map);

        // Pastikan ukuran Leaflet me-render penuh tanpa terpotong
        setTimeout(() => {
            map.invalidateSize();
        }, 250);
        window.addEventListener('resize', () => {
            map.invalidateSize();
        });
    }

    function loadAllLayers() {
        const statusEl = document.getElementById('previewStatus');
        let loadedCount = 0;
        let total = Object.keys(layersData).length;

        Object.keys(layersData).forEach(key => {
            const l = layersData[key];
            if (!l.exists) {
                loadedCount++;
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
                        statusEl.innerText = '✓ Semua data spasial berhasil dimuat.';
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

    /* Modal Functions */
    function openUploadModal(layerKey, layerName) {
        document.getElementById('modalLayerKey').value = layerKey;
        document.getElementById('modalLayerName').innerText = layerName;
        document.getElementById('modalTitle').innerText = 'Upload File: ' + layerName;
        document.getElementById('modalFileInput').value = '';
        document.getElementById('dropzoneSelectedFile').style.display = 'none';
        document.getElementById('dropzoneMainText').innerText = 'Klik untuk memilih file';

        const modal = document.getElementById('uploadModal');
        modal.classList.add('open');
    }

    function closeUploadModal() {
        const modal = document.getElementById('uploadModal');
        modal.classList.remove('open');
    }

    function handleModalFileChange(input) {
        if (input.files && input.files[0]) {
            const file = input.files[0];
            const selEl = document.getElementById('dropzoneSelectedFile');
            const mainText = document.getElementById('dropzoneMainText');
            selEl.style.display = 'block';
            selEl.innerText = '📁 File: ' + file.name + ' (' + (file.size / (1024*1024)).toFixed(2) + ' MB)';
            mainText.innerText = 'Ganti File Lain';
        }
    }

    document.getElementById('modalUploadForm').addEventListener('submit', function() {
        const btn = document.getElementById('btnSubmitModal');
        btn.disabled = true;
        btn.innerHTML = '<span style="display:inline-block; animation:spin 1s linear infinite;">⏳</span> Menyimpan & Mengonversi File...';
    });
</script>
@endsection
