@extends('layouts.app')

@section('title', 'Kelola Peta INFORMAL - PATEN PAK MIKO')
@section('page-title', 'Kelola Peta INFORMAL (Lahan Pangan & Ruang)')

@section('extra-styles')
    /* Leaflet CSS */
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>

    .layer-card-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 16px;
        margin-bottom: 24px;
    }

    .layer-card {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 4px;
        padding: 18px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.03);
        position: relative;
        overflow: hidden;
        transition: transform 0.18s, box-shadow 0.18s;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    .layer-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.06);
    }
    .layer-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 4px;
    }
    .layer-card.lp2b::before { background: #064E3B; }
    .layer-card.lbs::before { background: #3B82F6; }
    .layer-card.lsd::before { background: #10B981; }
    .layer-card.sukabumi_bounds::before { background: #003B64; }

    .layer-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 12px;
    }
    .layer-badge {
        font-size: 11px;
        font-weight: 800;
        padding: 3px 8px;
        border-radius: 3px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .badge-lp2b { background: #D1FAE5; color: #064E3B; }
    .badge-lbs  { background: #DBEAFE; color: #1E40AF; }
    .badge-lsd  { background: #ECFDF5; color: #047857; }
    .badge-bounds { background: #E0F2FE; color: #0369A1; }

    .layer-title {
        font-size: 14.5px;
        font-weight: 700;
        color: #003B64;
        margin-bottom: 4px;
        line-height: 1.35;
    }
    .layer-desc {
        font-size: 12px;
        color: #64748B;
        line-height: 1.45;
        margin-bottom: 14px;
    }

    .layer-meta-box {
        background: #F8FAFC;
        border: 1px solid #EDF2F7;
        border-radius: 3px;
        padding: 10px 12px;
        margin-bottom: 16px;
        font-size: 11.5px;
        color: #475569;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 8px;
    }
    .layer-meta-item strong {
        display: block;
        font-size: 10px;
        text-transform: uppercase;
        color: #94A3B8;
        font-weight: 700;
        margin-bottom: 2px;
    }

    .layer-actions {
        display: flex;
        gap: 8px;
        align-items: center;
    }
    .layer-actions .btn {
        flex: 1;
        font-size: 12px;
        padding: 8px 12px;
    }

    /* Form & Preview Layout */
    .map-manage-grid {
        display: grid;
        grid-template-columns: 380px 1fr;
        gap: 20px;
        align-items: start;
    }
    @media (max-width: 992px) {
        .map-manage-grid {
            grid-template-columns: 1fr;
        }
    }

    .panel-box {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 4px;
        padding: 20px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.03);
    }
    .panel-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-bottom: 14px;
        margin-bottom: 18px;
        border-bottom: 1px solid #F1F5F9;
    }
    .panel-title {
        font-size: 15px;
        font-weight: 700;
        color: #003B64;
    }

    /* Live Preview Map */
    #adminPreviewMap {
        width: 100%;
        height: 520px;
        border-radius: 4px;
        border: 1px solid #CBD5E1;
        z-index: 1;
    }

    .upload-dropzone {
        border: 2px dashed #CBD5E1;
        border-radius: 4px;
        padding: 24px 16px;
        text-align: center;
        background: #F8FAFC;
        cursor: pointer;
        transition: all 0.2s;
        margin-bottom: 14px;
    }
    .upload-dropzone:hover {
        border-color: #218AC9;
        background: #F0F6FB;
    }
    .upload-dropzone svg {
        width: 36px;
        height: 36px;
        color: #64748B;
        margin-bottom: 8px;
    }
@endsection

@section('content')
<div class="content">

    <!-- Flash Message -->
    @if(session('success'))
        <div style="background:#F0FDF4; border:1px solid #86EFAC; color:#166534; padding:12px 16px; border-radius:4px; font-size:13px; font-weight:600; margin-bottom:18px; display:flex; align-items:center; gap:8px;">
            <svg style="width:18px;height:18px;flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div style="background:#FFF5F5; border:1px solid #FEB2B2; color:#C53030; padding:12px 16px; border-radius:4px; font-size:13px; font-weight:600; margin-bottom:18px; display:flex; align-items:center; gap:8px;">
            <svg style="width:18px;height:18px;flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            {{ session('error') }}
        </div>
    @endif

    <!-- Header & Panduan Singkat -->
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:18px; flex-wrap:wrap; gap:12px;">
        <div>
            <h1 style="font-size:20px; font-weight:800; color:#003B64; margin-bottom:4px;">Kelola Data Layer Spasial Peta INFORMAL</h1>
            <p style="font-size:13px; color:#64748B;">Upload dan perbarui file spasial LP2B, LBS, LSD, atau batas wilayah untuk peta publik INFORMAL.</p>
        </div>
        <a href="{{ route('informal.index') }}" target="_blank" class="btn btn-secondary" style="font-size:12.5px; padding:9px 16px; border-radius:4px;">
            <svg style="width:15px;height:15px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
            Buka Peta Publik INFORMAL
        </a>
    </div>

    <!-- Grid Card Status Tiap Layer -->
    <div class="layer-card-grid">
        @foreach($layers as $key => $l)
            <div class="layer-card {{ $key }}">
                <div>
                    <div class="layer-header">
                        <span class="layer-badge badge-{{ $key }}">{{ $l['short_name'] }}</span>
                        <span style="display:inline-flex; align-items:center; gap:5px; font-size:11px; font-weight:700; color: {{ $l['exists'] ? '#166534' : '#C53030' }};">
                            <span style="width:7px; height:7px; border-radius:50%; background:{{ $l['exists'] ? '#22C55E' : '#EF4444' }};"></span>
                            {{ $l['exists'] ? 'Aktif' : 'Belum Ada' }}
                        </span>
                    </div>

                    <div class="layer-title">{{ $l['name'] }}</div>
                    <div class="layer-desc">{{ $l['description'] }}</div>

                    <div class="layer-meta-box">
                        <div class="layer-meta-item">
                            <strong>Ukuran File</strong>
                            <span>{{ $l['size_human'] }}</span>
                        </div>
                        <div class="layer-meta-item">
                            <strong>Update Terakhir</strong>
                            <span title="{{ $l['updated_at'] }}">{{ $l['updated_at'] }}</span>
                        </div>
                        <div class="layer-meta-item" style="grid-column: span 2;">
                            <strong>File Aktif</strong>
                            <span style="font-family:'DM Mono', monospace; font-size:11px; color:#003B64;">{{ $l['file_name'] }}</span>
                        </div>
                    </div>
                </div>

                <div class="layer-actions">
                    @if($l['exists'])
                        <a href="{{ route('admin.informal_map.download', $key) }}" class="btn btn-secondary" title="Unduh backup GeoJSON saat ini">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                            Backup
                        </a>
                    @endif
                    <button type="button" class="btn btn-primary" onclick="selectLayerForUpload('{{ $key }}', '{{ $l['name'] }}')">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                        Upload Baru
                    </button>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Main Section: Form Upload & Live Preview Map -->
    <div class="map-manage-grid">
        <!-- Panel Form Upload -->
        <div class="panel-box">
            <div class="panel-header">
                <div class="panel-title" id="formPanelTitle">Upload / Ganti File Layer</div>
            </div>

            <form action="{{ route('admin.informal_map.upload') }}" method="POST" enctype="multipart/form-data" id="uploadForm">
                @csrf
                <div style="margin-bottom:14px;">
                    <label class="form-hint" style="font-weight:700; color:#003B64; margin-bottom:6px; display:block;">Pilih Layer Target:</label>
                    <select name="layer_key" id="selectLayerKey" class="form-control" style="width:100%; padding:9px 12px; font-size:13px;" required onchange="onLayerSelectChanged()">
                        <option value="lp2b">LP2B (Lahan Pertanian Pangan Berkelanjutan)</option>
                        <option value="lbs">LBS (Lahan Baku Sawah)</option>
                        <option value="lsd">LSD (Lahan Sawah yang Dilindungi)</option>
                        <option value="sukabumi_bounds">Batas Wilayah Administrasi Kota Sukabumi</option>
                    </select>
                </div>

                <div style="margin-bottom:16px;">
                    <label class="form-hint" style="font-weight:700; color:#003B64; margin-bottom:6px; display:block;">Pilih File Peta:</label>
                    <div class="upload-dropzone" onclick="document.getElementById('mapFileInput').click()">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                        <div id="dropzoneText" style="font-size:13px; font-weight:700; color:#003B64; margin-bottom:4px;">Klik untuk memilih file</div>
                        <div style="font-size:11px; color:#64748B;">Format: <strong>.geojson</strong>, <strong>.json</strong>, atau <strong>.zip (Shapefile)</strong></div>
                        <div id="fileNameSelected" style="font-size:11.5px; font-weight:700; color:#218AC9; margin-top:8px; display:none;"></div>
                    </div>
                    <input type="file" name="map_file" id="mapFileInput" style="display:none;" accept=".geojson,.json,.zip" required onchange="handleFileSelected(this)">
                </div>

                <div style="background:#F0F6FB; border:1px solid #D6E4EF; border-radius:4px; padding:12px; font-size:11.5px; color:#2C5272; line-height:1.5; margin-bottom:18px;">
                    <strong style="display:block; margin-bottom:4px; color:#003B64;">ℹ️ Ketentuan File:</strong>
                    <ul style="padding-left:16px; margin:0;">
                        <li><strong>GeoJSON (.geojson / .json)</strong>: Format standar langsung siap pakai (disarankan EPSG:4326).</li>
                        <li><strong>Shapefile (.zip)</strong>: Berisi file <code>.shp</code>, <code>.dbf</code>, <code>.shx</code>, dan <code>.prj</code>. Otomatis dikonversi ke format standar peta Leaflet WGS84.</li>
                        <li>File lama akan di-backup otomatis di server sebelum digantikan file baru.</li>
                    </ul>
                </div>

                <button type="submit" id="btnSubmitUpload" class="btn btn-primary" style="width:100%; border-radius:4px; font-size:13px; padding:11px;">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                    Proses & Simpan Layer
                </button>
            </form>
        </div>

        <!-- Panel Live Preview Map -->
        <div class="panel-box">
            <div class="panel-header">
                <div class="panel-title">Live Preview Peta INFORMAL di Server</div>
                <div style="display:flex; gap:8px; align-items:center;">
                    <span style="font-size:12px; color:#64748B;">Layer Aktif:</span>
                    <button type="button" class="btn btn-sm btn-secondary" onclick="fitSukabumi()">Fokus Sukabumi</button>
                </div>
            </div>

            <!-- Kontrol Cepat Layer Preview -->
            <div style="display:flex; gap:14px; margin-bottom:12px; flex-wrap:wrap; font-size:12px; font-weight:700;">
                <label style="display:flex; align-items:center; gap:6px; cursor:pointer; color:#064E3B;">
                    <input type="checkbox" id="toggle-lp2b" checked onchange="toggleLayer('lp2b')">
                    <span style="width:12px; height:12px; background:#064E3B; display:inline-block; border-radius:2px;"></span>
                    LP2B
                </label>
                <label style="display:flex; align-items:center; gap:6px; cursor:pointer; color:#1E40AF;">
                    <input type="checkbox" id="toggle-lbs" checked onchange="toggleLayer('lbs')">
                    <span style="width:12px; height:12px; background:#3B82F6; display:inline-block; border-radius:2px;"></span>
                    LBS
                </label>
                <label style="display:flex; align-items:center; gap:6px; cursor:pointer; color:#047857;">
                    <input type="checkbox" id="toggle-lsd" checked onchange="toggleLayer('lsd')">
                    <span style="width:12px; height:12px; background:#10B981; display:inline-block; border-radius:2px;"></span>
                    LSD
                </label>
                <label style="display:flex; align-items:center; gap:6px; cursor:pointer; color:#003B64;">
                    <input type="checkbox" id="toggle-bounds" checked onchange="toggleLayer('sukabumi_bounds')">
                    <span style="width:12px; height:12px; border:2px dashed #003B64; display:inline-block; border-radius:2px;"></span>
                    Batas Kota
                </label>
            </div>

            <div id="adminPreviewMap"></div>
            <div style="margin-top:10px; font-size:11.5px; color:#64748B; display:flex; justify-content:space-between;">
                <span>* Klik salah satu area poligon di atas untuk melihat detail koordinat.</span>
                <span id="previewStatus">Memuat layer spasial...</span>
            </div>
        </div>
    </div>

</div>

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script>
    let map;
    let layersData = @json($layers);
    let mapLayers = {};

    document.addEventListener('DOMContentLoaded', function() {
        initMap();
        loadAllLayers();
    });

    function initMap() {
        // Inisialisasi peta berpusat di Kota Sukabumi
        map = L.map('adminPreviewMap').setView([-6.9237, 106.9287], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; OpenStreetMap & PATEN PAK MIKO'
        }).addTo(map);
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
                                    const sampleProps = Object.entries(feature.properties).slice(0, 4);
                                    sampleProps.forEach(([k, v]) => {
                                        propsHtml += `<div style="font-size:10.5px;color:#475569;"><strong>${k}:</strong> ${v}</div>`;
                                    });
                                }
                                layer.bindPopup(`
                                    <div style="min-width:160px;">
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
                        statusEl.innerText = 'Semua layer spasial aktif berhasil dimuat.';
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

    function selectLayerForUpload(key, name) {
        const sel = document.getElementById('selectLayerKey');
        if (sel) {
            sel.value = key;
            onLayerSelectChanged();
            document.getElementById('uploadForm').scrollIntoView({ behavior: 'smooth' });
        }
    }

    function onLayerSelectChanged() {
        const sel = document.getElementById('selectLayerKey');
        const titleEl = document.getElementById('formPanelTitle');
        const selectedText = sel.options[sel.selectedIndex].text;
        titleEl.innerText = 'Upload File: ' + selectedText;
    }

    function handleFileSelected(input) {
        if (input.files && input.files[0]) {
            const file = input.files[0];
            const nameEl = document.getElementById('fileNameSelected');
            const dropText = document.getElementById('dropzoneText');
            nameEl.style.display = 'block';
            nameEl.innerText = 'File terpilih: ' + file.name + ' (' + (file.size / (1024*1024)).toFixed(2) + ' MB)';
            dropText.innerText = 'Ganti File Pilihan';
        }
    }

    // Indikator loading saat submit upload
    document.getElementById('uploadForm').addEventListener('submit', function() {
        const btn = document.getElementById('btnSubmitUpload');
        btn.disabled = true;
        btn.innerHTML = '<span style="display:inline-block; animation:spin 1s linear infinite;">⏳</span> Memproses & Mengonversi File Spasial...';
    });
</script>
@endsection
