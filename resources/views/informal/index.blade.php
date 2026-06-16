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
        height: calc(100vh - 80px); /* Fill space between header and footer */
        min-height: 600px;
        background: #F0F6FB;
    }
    
    #map {
        width: 100%;
        height: 100%;
        z-index: 1;
    }

    /* Floating Left Card */
    .map-sidebar-left {
        position: absolute;
        top: 24px;
        left: 24px;
        width: 360px;
        background: #FFFFFF;
        border-radius: 4px;
        padding: 24px;
        z-index: 1000;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        max-height: calc(100% - 48px);
        overflow-y: auto;
    }

    .ms-title {
        font-size: 16px;
        font-weight: 800;
        color: #000;
        margin-bottom: 8px;
    }

    .ms-desc {
        font-size: 11px;
        color: #4A5568;
        line-height: 1.5;
        margin-bottom: 24px;
    }

    .ms-label {
        font-size: 12px;
        font-weight: 700;
        color: #00223D;
        margin-bottom: 8px;
        display: block;
    }

    .ms-input-wrap {
        margin-bottom: 16px;
    }

    .ms-input {
        width: 100%;
        border: 1px solid #CBD5E1;
        background: #FFFFFF;
        padding: 12px 14px;
        border-radius: 4px;
        font-size: 13px;
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
        padding: 12px;
        border-radius: 4px;
        border: none;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.2s;
    }
    .btn-cek-wilayah:hover {
        background: #001529;
    }

    .ms-divider {
        height: 1px;
        background: #E2E8F0;
        margin: 24px 0;
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
        margin-bottom: 4px;
    }

    .ms-result-coord-val {
        font-size: 14px;
        font-weight: 800;
        color: #218AC9; /* Blue color from the mockup */
        margin-bottom: 16px;
        font-family: monospace;
    }

    .ms-result-text {
        font-size: 11px;
        color: #000;
        line-height: 1.6;
        margin-bottom: 12px;
    }

    /* Rating Sidebar (Right) */
    .rating-sidebar {
        position: absolute;
        top: 24px;
        right: 24px;
        width: 300px;
        background: #ffffff;
        border-radius: 4px;
        padding: 20px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        z-index: 1000;
        max-height: calc(100% - 48px);
        overflow-y: auto;
    }
    .rating-sidebar h2 { font-size: 14px; font-weight: 800; margin-bottom: 12px; display: flex; align-items: center; gap: 8px; }
    .rating-item { padding: 12px; border-bottom: 1px solid #E2E8F0; cursor: pointer; transition: background 0.2s; }
    .rating-item:hover { background: #f8fafc; }
    .rating-item:last-child { border-bottom: none; }
    .rating-item-head { display: flex; justify-content: space-between; align-items: center; margin-bottom: 4px; }
    .rating-item-name { font-size: 13px; font-weight: 700; color: #00223D; }
    .rating-item-stars { color: #f1c40f; font-size: 14px; }
    .rating-item-meta { font-size: 11px; color: #7A9BB5; }

    /* Map layer controls inline */
    .map-layers {
        margin-top: 16px;
    }
    .map-layers h4 {
        font-size: 11px; font-weight: 700; margin-bottom: 8px; color:#4A5568; text-transform:uppercase;
    }
    .map-layers label {
        display: flex; align-items: center; gap: 8px; font-size: 11px; margin-bottom: 6px; cursor: pointer;
    }

    /* Leaflet Overrides */
    .leaflet-popup-content { margin: 16px !important; }

    @media (max-width: 768px) {
        .informal-container { height: calc(100vh - 60px); }
        .map-sidebar-left {
            top: auto;
            bottom: 24px;
            left: 16px;
            right: 16px;
            width: auto;
            max-height: 40vh;
        }
        .rating-sidebar { display: none; /* Hide rating on mobile for space */ }
        .leaflet-control-attribution { display: none; }
    }
</style>

<div class="informal-container">
    <div id="map"></div>

    <!-- Floating Card Left -->
    <div class="map-sidebar-left">
        <h2 class="ms-title">Pengecekan Lokasi</h2>
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
                <input type="checkbox" id="layer-lp2b" checked> 
                <span style="display:inline-block; width:12px; height:12px; background-color:#064e3b; border-radius:2px; border: 1px solid rgba(0,0,0,0.2);"></span>
                LP2B (Lahan Pertanian Pangan Berkelanjutan)
            </label>
            <label>
                <input type="checkbox" id="layer-lbs" checked> 
                <span style="display:inline-block; width:12px; height:12px; background-color:#3b82f6; border-radius:2px; border: 1px solid rgba(0,0,0,0.2);"></span>
                LBS (Lahan Baku Sawah)
            </label>
            <label>
                <input type="checkbox" id="layer-lsd" checked> 
                <span style="display:inline-block; width:12px; height:12px; background-color:#4ade80; border-radius:2px; border: 1px solid rgba(0,0,0,0.2);"></span>
                LSD (Lahan Sawah Dilindungi)
            </label>
        </div>
    </div>

    <!-- Rating Sidebar Right -->
    <div class="rating-sidebar">
        <h2>
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#f1c40f" stroke-width="2.5"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
            Ulasan Fitur Peta
        </h2>
        
        <form id="general-rating-form" onsubmit="submitRating(event, 'general', 'informal', null, null)" style="margin-bottom: 24px; padding-bottom: 20px; border-bottom: 1px solid #E2E8F0;">
            @if(!auth()->check())
            <div style="margin-bottom: 12px;">
                <label style="display:block; font-size:11px; font-weight:700; margin-bottom:4px;">Nama Anda</label>
                <input type="text" id="rating-name-general" placeholder="Tulis nama..." style="width:100%; padding:8px; border:1px solid #E2E8F0; border-radius:4px; font-size:12px;" required>
            </div>
            @endif
            <div style="margin-bottom: 12px;">
                <label style="display:block; font-size:11px; font-weight:700; margin-bottom:4px;">Penilaian Anda</label>
                <select id="rating-val-general" style="width:100%; padding:8px; border:1px solid #E2E8F0; border-radius:4px; font-size:12px;" required>
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
                <textarea id="rating-comment-general" rows="2" placeholder="Bagaimana pengalaman Anda?" style="width:100%; padding:8px; border:1px solid #E2E8F0; border-radius:4px; font-size:12px; font-family:inherit;"></textarea>
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
                    <div style="font-style:italic; font-size:11px; color:#7A9BB5; margin-top:6px; padding:6px; background:#F8FAFC; border-radius:4px;">
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
        .then(res => res.json())
        .then(data => {
            if(data.success) {
                event.target.innerHTML = `<div style="color:green; font-weight:bold; font-size:12px; text-align:center; padding:10px;">${data.message}</div>`;
            } else {
                alert('Gagal mengirim rating.');
                btn.innerHTML = originalText;
                btn.disabled = false;
            }
        })
        .catch(e => {
            console.error(e);
            alert('Terjadi kesalahan jaringan.');
            btn.innerHTML = originalText;
            btn.disabled = false;
        });
    }

    // Map Init
    if (typeof proj4 !== 'undefined') {
        proj4.defs("ESRI:54034", "+proj=cea +lat_ts=0 +lon_0=0 +x_0=0 +y_0=0 +datum=WGS84 +units=m +no_defs");
    }

    const map = L.map('map', {
        center: [-6.9277, 106.9300],
        zoom: 13,
        minZoom: 10,
        maxZoom: 18,
        maxBounds: [
            [-7.4000, 106.4000],
            [-6.6000, 107.1000] 
        ],
        maxBoundsViscosity: 1.0,
        zoomControl: false // We will move it
    });
    
    // Move zoom control to bottom right so it doesn't overlap the left card
    L.control.zoom({ position: 'bottomright' }).addTo(map);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap | Data Gistaru Dummy'
    }).addTo(map);

    const marker = L.marker([-6.9277, 106.9300], {
        draggable: true
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
        resultArea.classList.remove('active'); // Hide result when dragged
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
                        map.fitBounds(layer.getBounds(), { maxZoom: 18, padding: [20, 20] });
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

    fetch('/storage/shp_bpn/sukabumi_bounds.geojson').then(res => res.json()).then(geojson => {
        const boundsLayer = L.geoJSON(geojson, { style: { color: '#003B64', weight: 3, opacity: 0.8, dashArray: '5, 5' }, interactive: false }).addTo(map);
        const bounds = boundsLayer.getBounds();
        map.setMaxBounds(bounds.pad(0.02));
        map.fitBounds(bounds);
        map.setMinZoom(map.getBoundsZoom(bounds));
    }).catch(e => console.log('Error bounds:', e));

    ['lp2b', 'lbs', 'lsd'].forEach(type => {
        document.getElementById('layer-' + type).addEventListener('change', function() {
            if (mapLayers[type]) {
                if (this.checked) map.addLayer(mapLayers[type]);
                else map.removeLayer(mapLayers[type]);
            }
        });
    });

    // Pindahkan marker kalau user nge-klik di sembarang area peta
    map.on('click', function(e) {
        const lat = e.latlng.lat;
        const lng = e.latlng.lng;
        marker.setLatLng([lat, lng]);
        coordDisplay.value = `${lat.toFixed(5)}, ${lng.toFixed(5)}`;
        resultArea.classList.remove('active');
    });

    coordDisplay.addEventListener('change', function() {
        const val = this.value;
        const parts = val.split(',');
        if(parts.length === 2) {
            const lat = parseFloat(parts[0].trim());
            const lng = parseFloat(parts[1].trim());
            if(!isNaN(lat) && !isNaN(lng)) {
                marker.setLatLng([lat, lng]);
                map.flyTo([lat, lng], 16, { duration: 1.0 });
                resultArea.classList.remove('active');
            }
        }
    });

    // Fly to marker on check
    btnCek.addEventListener('click', function() {
        const btn = this;
        const originalText = btn.innerHTML;
        btn.innerHTML = 'Menganalisis...';
        btn.disabled = true;

        // Sync input ke marker jaga-jaga kalau user cuma ngetik tapi gak nge-blur/enter
        const val = coordDisplay.value;
        const parts = val.split(',');
        if(parts.length === 2) {
            const parsedLat = parseFloat(parts[0].trim());
            const parsedLng = parseFloat(parts[1].trim());
            if(!isNaN(parsedLat) && !isNaN(parsedLng)) {
                marker.setLatLng([parsedLat, parsedLng]);
            }
        }

        const lat = marker.getLatLng().lat;
        const lng = marker.getLatLng().lng;
        
        // Panning map automatically to marker
        map.flyTo([lat, lng], 16, { duration: 1 });

        setTimeout(() => {
            btn.innerHTML = originalText;
            btn.disabled = false;

            resCoord.textContent = `${lat.toFixed(6)}, ${lng.toFixed(6)}`;
            
            const pt = turf.point([lng, lat]);
            let results = { lp2b: false, lbs: false, lsd: false };

            ['lp2b', 'lbs', 'lsd'].forEach(type => {
                if (geoData[type]) {
                    let features = geoData[type].features;
                    for (let i = 0; i < features.length; i++) {
                        if (turf.booleanPointInPolygon(pt, features[i])) {
                            results[type] = true;
                            break;
                        }
                    }
                }
            });

            const alertHtml = `
                <div style="background: #EFF6FF; border: 1px solid #BFDBFE; border-radius: 6px; padding: 12px; margin-top: 12px;">
                    <div style="font-size: 11px; font-weight: 700; color: #1E3A8A; margin-bottom: 4px;">
                        &#8505;&#65039; PEMBERITAHUAN PENTING
                    </div>
                    <div style="font-size: 10.5px; color: #1E40AF; line-height: 1.5;">
                        Informasi ini <b>bersifat awal</b> dan tidak dapat dijadikan dasar pengambilan keputusan. Untuk informasi yang lebih lengkap dan akurat mengenai LP2B, LBS, LSD, serta kesesuaian ruang, silakan ajukan <b>Layanan Peta Analisis Penatagunaan Tanah</b> atau <b>Pertimbangan Teknis Pertanahan</b> di Loket Kantor Pertanahan.
                    </div>
                </div>
            `;

            let statusHtml = `
                <div style="margin-bottom: 12px; display: flex; flex-direction: column; gap: 8px;">
                    <div style="background: ${results.lp2b ? '#F0FDF4' : '#FEF9C3'}; color: ${results.lp2b ? '#166534' : '#854D0E'}; padding: 6px 12px; border-radius: 4px; font-size: 11px; font-weight: 700; border: 1px solid ${results.lp2b ? '#86EFAC' : '#FDE047'};">
                        ${results.lp2b ? '&#10003;' : '&#10060;'} LP2B: ${results.lp2b ? 'Terindikasi' : 'Tidak Terindikasi'}
                    </div>
                    <div style="background: ${results.lbs ? '#F0FDF4' : '#FEF9C3'}; color: ${results.lbs ? '#166534' : '#854D0E'}; padding: 6px 12px; border-radius: 4px; font-size: 11px; font-weight: 700; border: 1px solid ${results.lbs ? '#86EFAC' : '#FDE047'};">
                        ${results.lbs ? '&#10003;' : '&#10060;'} LBS: ${results.lbs ? 'Terindikasi' : 'Tidak Terindikasi'}
                    </div>
                    <div style="background: ${results.lsd ? '#F0FDF4' : '#FEF9C3'}; color: ${results.lsd ? '#166534' : '#854D0E'}; padding: 6px 12px; border-radius: 4px; font-size: 11px; font-weight: 700; border: 1px solid ${results.lsd ? '#86EFAC' : '#FDE047'};">
                        ${results.lsd ? '&#10003;' : '&#10060;'} LSD: ${results.lsd ? 'Terindikasi' : 'Tidak Terindikasi'}
                    </div>
                </div>
            `;

            resultStatus.innerHTML = statusHtml + alertHtml;

            resultArea.classList.add('active');
        }, 1000);
    });

    function flyToMarker(lat, lng) {
        map.flyTo([lat, lng], 16);
    }
</script>
@endsection
