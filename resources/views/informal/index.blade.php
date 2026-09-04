@extends('layouts.public')

@section('title', 'Peta Publik Informal - PATEN PAK MIKO')

@section('content')
<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>

<style>
    /* Scoped Map Styles */
    .informal-container {
        position: relative;
        width: 100%;
        height: calc(100vh - 68px);
        height: calc(100dvh - 68px);
        min-height: 520px;
        background: #F0F6FB;
        overflow: hidden;
    }
    
    #map {
        width: 100%;
        height: 100%;
        z-index: 1;
        touch-action: pan-x pan-y;
    }

    /* Floating Left Card */
    .map-sidebar-left {
        position: absolute;
        top: 20px;
        left: 20px;
        width: 360px;
        background: #FFFFFF;
        border-radius: 4px;
        padding: 20px;
        z-index: 1000;
        box-shadow: 0 4px 16px rgba(0,34,61,0.12);
        max-height: calc(100% - 40px);
        overflow-y: auto;
        border: 1px solid #E2E8F0;
    }

    .ms-title {
        font-size: 15px;
        font-weight: 800;
        color: #00223D;
        margin-bottom: 6px;
    }

    .ms-desc {
        font-size: 11.5px;
        color: #4A5568;
        line-height: 1.5;
        margin-bottom: 18px;
    }

    .ms-label {
        font-size: 11.5px;
        font-weight: 700;
        color: #00223D;
        margin-bottom: 6px;
        display: block;
    }

    .ms-input-wrap {
        margin-bottom: 12px;
    }

    .ms-input {
        width: 100%;
        border: 1px solid #CBD5E1;
        background: #FFFFFF;
        padding: 10px 12px;
        border-radius: 4px;
        font-size: 12.5px;
        color: #00223D;
        font-family: monospace;
        font-weight: 600;
        outline: none;
        transition: border-color 0.2s;
    }
    .ms-input:focus {
        border-color: #218AC9;
    }

    .btn-cek-wilayah {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        width: 100%;
        background: #00223D;
        color: #FFFFFF;
        padding: 10px 14px;
        border-radius: 4px;
        border: none;
        font-size: 12px;
        font-weight: 700;
        cursor: pointer;
        transition: background 0.2s;
    }
    .btn-cek-wilayah:hover {
        background: #001529;
    }

    .ms-divider {
        height: 1px;
        background: #E2E8F0;
        margin: 16px 0;
    }

    /* Results */
    .ms-result {
        display: none;
    }
    .ms-result.active {
        display: block;
        animation: fadeIn 0.3s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    .ms-result-coord-label {
        font-size: 11px;
        color: #4A5568;
        margin-bottom: 2px;
    }

    .ms-result-coord-val {
        font-size: 13px;
        font-weight: 800;
        color: #218AC9;
        margin-bottom: 12px;
        font-family: monospace;
    }

    .ms-result-text {
        font-size: 11px;
        color: #000;
        line-height: 1.5;
        margin-bottom: 10px;
    }

    /* Rating Sidebar (Right) */
    .rating-sidebar {
        position: absolute;
        top: 20px;
        right: 20px;
        width: 310px;
        background: #ffffff;
        border-radius: 4px;
        padding: 18px;
        box-shadow: 0 4px 16px rgba(0,34,61,0.12);
        z-index: 1000;
        max-height: calc(100% - 40px);
        overflow-y: auto;
        border: 1px solid #E2E8F0;
    }
    .rating-sidebar h2 { font-size: 14px; font-weight: 800; color: #00223D; margin-bottom: 12px; display: flex; align-items: center; gap: 8px; }
    .rating-item { padding: 10px; border-bottom: 1px solid #E2E8F0; cursor: pointer; transition: background 0.2s; border-radius: 3px; }
    .rating-item:hover { background: #F8FAFC; }
    .rating-item:last-child { border-bottom: none; }
    .rating-item-head { display: flex; justify-content: space-between; align-items: center; margin-bottom: 3px; }
    .rating-item-name { font-size: 12.5px; font-weight: 700; color: #00223D; }
    .rating-item-stars { color: #f1c40f; font-size: 13px; }
    .rating-item-meta { font-size: 10.5px; color: #7A9BB5; }

    /* Map layer controls inline */
    .map-layers {
        margin-top: 14px;
    }
    .map-layers h4 {
        font-size: 11px; font-weight: 700; margin-bottom: 8px; color:#4A5568; text-transform:uppercase; letter-spacing: 0.03em;
    }
    .map-layers label {
        display: flex; align-items: center; gap: 8px; font-size: 11.5px; margin-bottom: 6px; cursor: pointer; color: #1E293B;
    }

    /* Mobile Sheet Toggle Bar */
    .sheet-drag-handle {
        display: none;
        width: 36px;
        height: 4px;
        background: #CBD5E1;
        border-radius: 2px;
        margin: 0 auto 10px;
    }
    .mobile-sheet-toggle {
        display: none;
    }

    /* Leaflet Overrides */
    .leaflet-popup-content { margin: 14px !important; }

    /* Mobile Tab Navigation Bar */
    .informal-mobile-tabs {
        display: none;
    }

    @media (max-width: 768px) {
        .informal-container { 
            height: calc(100vh - 60px);
            height: calc(100dvh - 60px);
            position: relative;
        }
        
        .informal-mobile-tabs {
            display: flex;
            position: absolute;
            top: 10px;
            left: 10px;
            right: 10px;
            z-index: 1001;
            background: #FFFFFF;
            padding: 3px;
            border-radius: 4px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.12);
            gap: 4px;
            border: 1px solid #CBD5E1;
        }

        .mobile-tab-btn {
            flex: 1;
            padding: 7px 10px;
            font-size: 11px;
            font-weight: 700;
            border: none;
            background: transparent;
            color: #64748B;
            border-radius: 3px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            transition: all 0.2s;
        }

        .mobile-tab-btn.active {
            background: #00223D;
            color: #FFFFFF;
        }

        .sheet-drag-handle {
            display: block;
        }

        /* Bottom Sheet Collapsible */
        .map-sidebar-left {
            top: auto;
            bottom: 0;
            left: 0;
            right: 0;
            width: 100%;
            max-height: 55vh;
            padding: 14px 16px 20px;
            z-index: 1000;
            border-radius: 12px 12px 0 0;
            border-bottom: none;
            box-shadow: 0 -4px 20px rgba(0,0,0,0.15);
            transition: max-height 0.3s ease, transform 0.3s ease;
        }

        .map-sidebar-left.collapsed {
            max-height: 125px;
            overflow: hidden;
        }

        .map-sidebar-left.collapsed .ms-desc,
        .map-sidebar-left.collapsed .ms-divider,
        .map-sidebar-left.collapsed .map-layers,
        .map-sidebar-left.collapsed #result-area {
            display: none !important;
        }

        .mobile-sheet-toggle {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 8px;
            cursor: pointer;
        }

        .mobile-toggle-btn {
            font-size: 10.5px;
            font-weight: 700;
            color: #218AC9;
            background: #F0F6FB;
            border: 1px solid #B3D4EC;
            border-radius: 3px;
            padding: 3px 8px;
            cursor: pointer;
        }

        .rating-sidebar {
            display: none;
            top: auto;
            bottom: 0;
            left: 0;
            right: 0;
            width: 100%;
            max-height: 70vh;
            padding: 16px 16px 24px;
            z-index: 1000;
            border-radius: 12px 12px 0 0;
            box-shadow: 0 -4px 20px rgba(0,0,0,0.15);
            transition: all 0.3s ease;
        }

        .rating-sidebar.mobile-active {
            display: block !important;
        }

        .map-sidebar-left.mobile-hidden {
            display: none !important;
        }

        .leaflet-control-zoom {
            margin-bottom: 140px !important;
            margin-right: 12px !important;
        }

        .leaflet-control-attribution { display: none; }
    }
</style>

<div class="informal-container">
    <!-- Mobile Navigation Tab Switcher -->
    <div class="informal-mobile-tabs">
        <button type="button" class="mobile-tab-btn active" id="tab-cek-lokasi" onclick="switchMobileTab('cek-lokasi')">
            <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            Cek Lokasi
        </button>
        <button type="button" class="mobile-tab-btn" id="tab-ulasan" onclick="switchMobileTab('ulasan')">
            <svg width="13" height="13" fill="currentColor" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
            Ulasan Fitur Peta
        </button>
    </div>

    <div id="map"></div>

    <!-- Floating Card Left / Mobile Bottom Sheet -->
    <div class="map-sidebar-left" id="sidebar-cek-lokasi">
        <div class="sheet-drag-handle" onclick="toggleBottomSheet()"></div>
        
        <div class="mobile-sheet-toggle">
            <h2 class="ms-title" style="margin-bottom:0;">Pengecekan Lokasi</h2>
            <button type="button" class="mobile-toggle-btn" id="btn-toggle-sheet" onclick="toggleBottomSheet()">Tutup Detail &#9660;</button>
        </div>

        <p class="ms-desc">Geser penanda (marker) pada peta ke koordinat yang ingin Anda periksa detail peruntukannya.</p>

        <label class="ms-label">Koordinat Terpilih</label>
        <div class="ms-input-wrap">
            <input type="text" class="ms-input" id="coord-display" value="-6.92770, 106.93000">
        </div>

        <button class="btn-cek-wilayah" id="btn-cek">
            Cek Wilayah &rarr;
        </button>

        <div class="ms-divider"></div>

        <div id="result-area" class="ms-result">
            <h2 class="ms-title">Detail Wilayah</h2>
            <div class="ms-result-coord-label">Nomor Koordinat</div>
            <div class="ms-result-coord-val" id="res-coord">-6.92770, 106.93000</div>
            
            <div id="result-status">
                <p class="ms-result-text" style="font-style: italic;">Sedang memproses zonasi...</p>
            </div>
        </div>

        <div class="map-layers">
            <h4>Layer Peta</h4>
            <label>
                <input type="checkbox" id="layer-lp2b"> 
                <span style="display:inline-block; width:12px; height:12px; background-color:#064e3b; border-radius:2px; border: 1px solid rgba(0,0,0,0.2);"></span>
                LP2B (Lahan Pertanian Pangan Berkelanjutan)
            </label>
            <label>
                <input type="checkbox" id="layer-lbs"> 
                <span style="display:inline-block; width:12px; height:12px; background-color:#3b82f6; border-radius:2px; border: 1px solid rgba(0,0,0,0.2);"></span>
                LBS (Lahan Baku Sawah)
            </label>
            <label>
                <input type="checkbox" id="layer-lsd"> 
                <span style="display:inline-block; width:12px; height:12px; background-color:#4ade80; border-radius:2px; border: 1px solid rgba(0,0,0,0.2);"></span>
                LSD (Lahan Sawah Dilindungi)
            </label>
        </div>
    </div>

    <!-- Rating Sidebar Right -->
    <div class="rating-sidebar" id="sidebar-ulasan">
        <h2>
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#f1c40f" stroke-width="2.5"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
            Ulasan Fitur Peta
        </h2>
        
        <form id="general-rating-form" onsubmit="submitRating(event, 'general', 'informal', null, null)" style="margin-bottom: 20px; padding-bottom: 16px; border-bottom: 1px solid #E2E8F0;">
            @if(!auth()->check())
            <div style="margin-bottom: 10px;">
                <label style="display:block; font-size:11px; font-weight:700; margin-bottom:4px;">Nama Anda</label>
                <input type="text" id="rating-name-general" placeholder="Tulis nama..." style="width:100%; padding:8px 10px; border:1px solid #CBD5E1; border-radius:4px; font-size:12px;" required>
            </div>
            @endif
            <div style="margin-bottom: 10px;">
                <label style="display:block; font-size:11px; font-weight:700; margin-bottom:4px;">Penilaian Anda</label>
                <select id="rating-val-general" style="width:100%; padding:8px 10px; border:1px solid #CBD5E1; border-radius:4px; font-size:12px;" required>
                    <option value="" disabled selected>-- Pilih Penilaian --</option>
                    <option value="5">(5) Sangat Baik</option>
                    <option value="4">(4) Baik</option>
                    <option value="3">(3) Cukup Baik</option>
                    <option value="2">(2) Kurang</option>
                    <option value="1">(1) Sangat Kurang</option>
                </select>
            </div>
            <div style="margin-bottom: 12px;">
                <label style="display:block; font-size:11px; font-weight:700; margin-bottom:4px;">Komentar (Opsional)</label>
                <textarea id="rating-comment-general" rows="2" placeholder="Bagaimana pengalaman Anda?" style="width:100%; padding:8px 10px; border:1px solid #CBD5E1; border-radius:4px; font-size:12px; font-family:inherit;"></textarea>
            </div>
            <button type="submit" class="btn-cek-wilayah">Kirim Ulasan</button>
        </form>
        
        <div id="rating-list-container">
            @forelse($ratings as $rating)
                <div class="rating-item" @if($rating->latitude) onclick="flyToMarker({{ $rating->latitude }}, {{ $rating->longitude }})" @endif>
                    <div class="rating-item-head">
                        <span class="rating-item-name">{{ $rating->name ?: 'Anonim' }}</span>
                        <span class="rating-item-stars">
                            {{ str_repeat('★', $rating->rating) }}{{ str_repeat('☆', 5 - $rating->rating) }}
                        </span>
                    </div>
                    <div class="rating-item-meta">
                        @if($rating->latitude)
                        Koord: {{ number_format((float)$rating->latitude, 4) }}, {{ number_format((float)$rating->longitude, 4) }}
                        @else
                        Ulasan Umum
                        @endif
                    </div>
                    @if($rating->comment)
                    <div style="font-style:italic; font-size:11px; color:#4A5568; margin-top:5px; padding:6px 8px; background:#F8FAFC; border-radius:3px; border: 1px solid #E2E8F0;">
                        "{{ $rating->comment }}"
                    </div>
                    @endif
                </div>
            @empty
                <div style="text-align:center; padding:16px; color:#7A9BB5; font-size:11px;">Belum ada ulasan.</div>
            @endforelse
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script src="https://unpkg.com/@turf/turf@6/turf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/proj4js/2.9.0/proj4.js"></script>

<script>
    const isLoggedIn = {{ auth()->check() ? 'true' : 'false' }};
    const csrfToken = '{{ csrf_token() }}';

    function submitRating(event, formId, type, lat, lng) {
        event.preventDefault();
        
        let ratingVal = document.getElementById('rating-val-' + formId).value;
        if(!ratingVal) return alert('Silakan pilih rating terlebih dahulu.');
        
        // Ambil koordinat dari marker peta jika lat & lng belum ada
        if ((!lat || !lng) && typeof marker !== 'undefined' && marker) {
            const pos = marker.getLatLng();
            lat = pos.lat;
            lng = pos.lng;
        }

        let commentVal = document.getElementById('rating-comment-' + formId).value;
        let name = '';
        if(!isLoggedIn) {
            name = document.getElementById('rating-name-' + formId).value;
            if(!name) return alert('Silakan masukkan nama Anda.');
        }

        let btn = event.target.querySelector('button[type="submit"]');
        let originalText = btn.innerHTML;
        btn.innerHTML = 'Mengirim...';
        btn.disabled = true;

        fetch('{{ route('informal.rating.store') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({
                informal_type: type,
                latitude: lat,
                longitude: lng,
                rating: ratingVal,
                comment: commentVal,
                name: name
            })
        })
        .then(async res => {
            const data = await res.json().catch(() => null);
            if (res.ok && data && data.success) {
                event.target.innerHTML = `<div style="color:green; font-weight:bold; font-size:12px; text-align:center; padding:10px;">${data.message}</div>`;
            } else {
                alert((data && data.message) ? data.message : 'Ulasan Anda berhasil dikirim!');
                btn.innerHTML = originalText;
                btn.disabled = false;
            }
        })
        .catch(e => {
            console.error(e);
            alert('Ulasan Anda berhasil dikirim!');
            btn.innerHTML = originalText;
            btn.disabled = false;
        });
    }

    // Map Init (Bebas tanpa maxBounds kaku agar gesture pan/swipe di HP tidak mental balik)
    if (typeof proj4 !== 'undefined') {
        proj4.defs("ESRI:54034", "+proj=cea +lat_ts=0 +lon_0=0 +x_0=0 +y_0=0 +datum=WGS84 +units=m +no_defs");
    }

    const map = L.map('map', {
        center: [-6.9277, 106.9300],
        zoom: 13,
        minZoom: 8,
        maxZoom: 19,
        zoomControl: false,
        bounceAtZoomLimits: false
    });
    
    // Move zoom control to bottom right
    L.control.zoom({ position: 'bottomright' }).addTo(map);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap'
    }).addTo(map);

    const redIcon = new L.Icon({
        iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/images/marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
    });

    const marker = L.marker([-6.9277, 106.9300], {
        draggable: true,
        icon: redIcon
    }).addTo(map);

    const coordDisplay = document.getElementById('coord-display');
    const resultArea = document.getElementById('result-area');
    const resCoord = document.getElementById('res-coord');
    const resultStatus = document.getElementById('result-status');
    const btnCek = document.getElementById('btn-cek');

    marker.on('drag', function(e) {
        const lat = marker.getLatLng().lat.toFixed(5);
        const lng = marker.getLatLng().lng.toFixed(5);
        coordDisplay.value = `${lat}, ${lng}`;
        resultArea.classList.remove('active');
    });

    marker.on('dragend', function(e) {
        const lat = marker.getLatLng().lat.toFixed(5);
        const lng = marker.getLatLng().lng.toFixed(5);
        coordDisplay.value = `${lat}, ${lng}`;
        // Pengecekan zonasi tanpa auto flyTo peta
        analyzeCoordinates(parseFloat(lat), parseFloat(lng), false);
    });

    let geoData = { lp2b: null, lbs: null, lsd: null };
    let mapLayers = { lp2b: null, lbs: null, lsd: null };

    const loadGeoJSON = (url, type, color, fillOpacity = 0.5) => {
        fetch(url).then(res => res.json()).then(geojson => {
            geoData[type] = geojson;
            mapLayers[type] = L.geoJSON(geojson, {
                style: { color: color, weight: 2, fillOpacity: fillOpacity },
                onEachFeature: function(feature, layer) {
                    layer.on('click', function(e) {
                        const lat = e.latlng.lat.toFixed(6);
                        const lng = e.latlng.lng.toFixed(6);
                        layer.bindPopup(`<div style="text-align:center;"><strong>Area ${type.toUpperCase()}</strong><br>Koord: ${lat}, ${lng}</div>`).openPopup(e.latlng);
                    });
                }
            });
            if (document.getElementById('layer-' + type).checked) mapLayers[type].addTo(map);
        }).catch(e => console.log('Error GeoJSON:', url));
    };

    loadGeoJSON('/storage/shp_bpn/lp2b.geojson', 'lp2b', '#064e3b', 0.65);
    loadGeoJSON('/storage/shp_bpn/lbs.geojson', 'lbs', '#3b82f6', 0.5);
    loadGeoJSON('/storage/shp_bpn/lsd.geojson', 'lsd', '#4ade80', 0.5);

    let sukabumiGeojson = null;
    let sukabumiBoundsLayer = null;
    fetch('/storage/shp_bpn/sukabumi_bounds.geojson').then(res => res.json()).then(geojson => {
        sukabumiGeojson = geojson;
        sukabumiBoundsLayer = L.geoJSON(geojson, { style: { color: '#003B64', weight: 3, opacity: 0.8, dashArray: '5, 5' }, interactive: false }).addTo(map);
    }).catch(e => console.log('Error bounds:', e));

    let sukabumiAsliGeojson = null;
    fetch('https://nominatim.openstreetmap.org/search.php?q=Kota+Sukabumi&polygon_geojson=1&format=json', {
        headers: { 'Accept-Language': 'id' }
    })
    .then(res => res.json())
    .then(data => {
        if(Array.isArray(data)) {
            let match = data.find(i => i.geojson && (i.geojson.type === 'Polygon' || i.geojson.type === 'MultiPolygon'));
            if (match) sukabumiAsliGeojson = match.geojson;
        }
    }).catch(e => console.log('OSM fetch error:', e));

    ['lp2b', 'lbs', 'lsd'].forEach(type => {
        document.getElementById('layer-' + type).addEventListener('change', function() {
            if (mapLayers[type]) {
                if (this.checked) map.addLayer(mapLayers[type]);
                else map.removeLayer(mapLayers[type]);
            }
        });
    });

    // Pindahkan marker kalau user nge-klik di peta (tanpa memaksa flyTo yang bikin mental)
    map.on('click', function(e) {
        const lat = e.latlng.lat;
        const lng = e.latlng.lng;
        marker.setLatLng([lat, lng]);
        coordDisplay.value = `${lat.toFixed(5)}, ${lng.toFixed(5)}`;
        resultArea.classList.remove('active');
        
        analyzeCoordinates(lat, lng, false);
    });

    coordDisplay.addEventListener('change', function() {
        const val = this.value;
        const parts = val.split(',');
        if(parts.length === 2) {
            const lat = parseFloat(parts[0].trim());
            const lng = parseFloat(parts[1].trim());
            if(!isNaN(lat) && !isNaN(lng)) {
                marker.setLatLng([lat, lng]);
                map.flyTo([lat, lng], 16, { duration: 0.8 });
                resultArea.classList.remove('active');
            }
        }
    });

    // Fungsi utama analisis zonasi
    function analyzeCoordinates(lat, lng, shouldFly = false) {
        const originalText = btnCek.innerHTML;
        btnCek.innerHTML = 'Menganalisis...';
        btnCek.disabled = true;

        if (shouldFly) {
            map.flyTo([lat, lng], 16, { duration: 0.8 });
        }

        // Auto expand bottom sheet di mobile jika sedang collapsed
        const sheet = document.getElementById('sidebar-cek-lokasi');
        if (sheet && sheet.classList.contains('collapsed')) {
            sheet.classList.remove('collapsed');
            const toggleBtn = document.getElementById('btn-toggle-sheet');
            if (toggleBtn) toggleBtn.innerHTML = 'Tutup Detail &#9660;';
        }

        setTimeout(() => {
            btnCek.innerHTML = originalText;
            btnCek.disabled = false;

            resCoord.textContent = `${lat.toFixed(6)}, ${lng.toFixed(6)}`;
            
            const pt = turf.point([lng, lat]);
            
            // Cek apakah di luar wilayah sukabumi
            let inSukabumi = false; 
            try {
                if (sukabumiAsliGeojson) {
                    inSukabumi = turf.booleanPointInPolygon(pt, sukabumiAsliGeojson);
                } else if (sukabumiGeojson && sukabumiGeojson.features && sukabumiGeojson.features.length > 0) {
                    const polys = turf.polygonize(sukabumiGeojson);
                    if (polys && polys.features && polys.features.length > 0) {
                        for (let i = 0; i < polys.features.length; i++) {
                            if (turf.booleanPointInPolygon(pt, polys.features[i])) {
                                inSukabumi = true;
                                break;
                            }
                        }
                    } else {
                        const bbox = turf.bbox(sukabumiGeojson);
                        const poly = turf.bboxPolygon(bbox);
                        inSukabumi = turf.booleanPointInPolygon(pt, poly);
                    }
                } else {
                    inSukabumi = true;
                }
            } catch (err) {
                console.error("Error check sukabumi bounds:", err);
                inSukabumi = true; 
            }

            if (!inSukabumi) {
                resultStatus.innerHTML = `
                    <div style="background: #FEF2F2; border: 1px solid #FECACA; border-radius: 4px; padding: 10px; margin-top: 10px;">
                        <div style="font-size: 11px; font-weight: 700; color: #991B1B; margin-bottom: 3px;">
                            &#9888;&#65039; DI LUAR WILAYAH
                        </div>
                        <div style="font-size: 10.5px; color: #B91C1C; line-height: 1.4;">
                            Koordinat yang Anda masukkan tidak termasuk dalam wilayah Kota Sukabumi. Harap masukkan koordinat yang berada di wilayah Kota Sukabumi.
                        </div>
                    </div>
                `;
                resultArea.classList.add('active');
                return;
            }

            let results = { lp2b: false, lbs: false, lsd: false };

            ['lp2b', 'lbs', 'lsd'].forEach(type => {
                if (geoData[type]) {
                    let features = geoData[type].features;
                    for (let i = 0; i < features.length; i++) {
                        try {
                            if (turf.booleanPointInPolygon(pt, features[i])) {
                                results[type] = true;
                                break;
                            }
                        } catch (err) {
                            // ignore invalid geometries
                        }
                    }
                }
            });

            const alertHtml = `
                <div style="background: #EFF6FF; border: 1px solid #BFDBFE; border-radius: 4px; padding: 10px; margin-top: 10px;">
                    <div style="font-size: 11px; font-weight: 700; color: #1E3A8A; margin-bottom: 3px;">
                        &#8505;&#65039; PEMBERITAHUAN PENTING
                    </div>
                    <div style="font-size: 10.5px; color: #1E40AF; line-height: 1.4;">
                        Informasi ini <b>bersifat awal</b>. Untuk kepastian tata ruang dan kesesuaian ruang, silakan ajukan <b>Layanan PTP</b> di Kantor Pertanahan.
                    </div>
                </div>
            `;

            ['lp2b', 'lbs', 'lsd'].forEach(type => {
                const layerCheckbox = document.getElementById('layer-' + type);
                if (results[type]) {
                    if (!layerCheckbox.checked) {
                        layerCheckbox.checked = true;
                        layerCheckbox.dispatchEvent(new Event('change'));
                    }
                } else {
                    if (layerCheckbox.checked) {
                        layerCheckbox.checked = false;
                        layerCheckbox.dispatchEvent(new Event('change'));
                    }
                }
            });

            let statusHtml = `
                <div style="margin-bottom: 10px; display: flex; flex-direction: column; gap: 6px;">
                    <div style="background: ${results.lp2b ? '#F0FDF4' : '#FEF9C3'}; color: ${results.lp2b ? '#166534' : '#854D0E'}; padding: 6px 10px; border-radius: 4px; font-size: 11px; font-weight: 700; border: 1px solid ${results.lp2b ? '#86EFAC' : '#FDE047'};">
                        ${results.lp2b ? '&#10003;' : '&#10060;'} LP2B: ${results.lp2b ? 'Terindikasi' : 'Tidak Terindikasi'}
                    </div>
                    <div style="background: ${results.lbs ? '#F0FDF4' : '#FEF9C3'}; color: ${results.lbs ? '#166534' : '#854D0E'}; padding: 6px 10px; border-radius: 4px; font-size: 11px; font-weight: 700; border: 1px solid ${results.lbs ? '#86EFAC' : '#FDE047'};">
                        ${results.lbs ? '&#10003;' : '&#10060;'} LBS: ${results.lbs ? 'Terindikasi' : 'Tidak Terindikasi'}
                    </div>
                    <div style="background: ${results.lsd ? '#F0FDF4' : '#FEF9C3'}; color: ${results.lsd ? '#166534' : '#854D0E'}; padding: 6px 10px; border-radius: 4px; font-size: 11px; font-weight: 700; border: 1px solid ${results.lsd ? '#86EFAC' : '#FDE047'};">
                        ${results.lsd ? '&#10003;' : '&#10060;'} LSD: ${results.lsd ? 'Terindikasi' : 'Tidak Terindikasi'}
                    </div>
                </div>
            `;

            resultStatus.innerHTML = statusHtml + alertHtml;

            resultArea.classList.add('active');
        }, 400);
    }

    // Tombol "Cek Wilayah" secara eksplisit
    btnCek.addEventListener('click', function() {
        const val = coordDisplay.value;
        const parts = val.split(',');
        if(parts.length === 2) {
            const parsedLat = parseFloat(parts[0].trim());
            const parsedLng = parseFloat(parts[1].trim());
            if(!isNaN(parsedLat) && !isNaN(parsedLng)) {
                marker.setLatLng([parsedLat, parsedLng]);
                analyzeCoordinates(parsedLat, parsedLng, true);
                return;
            }
        }
        const lat = marker.getLatLng().lat;
        const lng = marker.getLatLng().lng;
        analyzeCoordinates(lat, lng, true);
    });

    function flyToMarker(lat, lng) {
        map.flyTo([lat, lng], 16);
    }

    function switchMobileTab(targetTab) {
        const tabCek = document.getElementById('tab-cek-lokasi');
        const tabUlasan = document.getElementById('tab-ulasan');
        const sidebarCek = document.getElementById('sidebar-cek-lokasi');
        const sidebarUlasan = document.getElementById('sidebar-ulasan');

        if (targetTab === 'ulasan') {
            tabCek.classList.remove('active');
            tabUlasan.classList.add('active');
            sidebarCek.classList.add('mobile-hidden');
            sidebarUlasan.classList.add('mobile-active');
        } else {
            tabUlasan.classList.remove('active');
            tabCek.classList.add('active');
            sidebarUlasan.classList.remove('mobile-active');
            sidebarCek.classList.remove('mobile-hidden');
        }
    }

    function toggleBottomSheet() {
        const sheet = document.getElementById('sidebar-cek-lokasi');
        const toggleBtn = document.getElementById('btn-toggle-sheet');
        if (sheet) {
            sheet.classList.toggle('collapsed');
            if (sheet.classList.contains('collapsed')) {
                if (toggleBtn) toggleBtn.innerHTML = 'Buka Detail &#9650;';
            } else {
                if (toggleBtn) toggleBtn.innerHTML = 'Tutup Detail &#9660;';
            }
        }
    }
</script>
@endsection
