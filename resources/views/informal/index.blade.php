<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peta Publik Informal - PATEN PAK MIKO</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>

    <style>
        :root {
            --blue: #218AC9;
            --blue-dk: #003B64;
            --ink: #003B64;
            --white: #FFFFFF;
            --surface: #F0F6FB;
            --line: #D6E4EF;
            --muted: #7A9BB5;
            --r-md: 10px;
            --r-lg: 16px;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--surface);
            color: var(--ink);
            height: 100vh;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        /* Navbar */
        .navbar {
            height: 64px;
            background: var(--white);
            border-bottom: 1px solid var(--line);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 24px;
            flex-shrink: 0;
            z-index: 1000;
        }
        .nav-left { display: flex; align-items: center; gap: 16px; }
        .btn-back {
            display: flex; align-items: center; justify-content: center;
            width: 36px; height: 36px; border-radius: 8px;
            background: var(--surface); color: var(--ink);
            text-decoration: none; border: 1px solid var(--line);
            transition: all .2s;
        }
        .btn-back:hover { background: var(--line); }
        .btn-back svg { width: 16px; height: 16px; fill: none; stroke: currentColor; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; }
        
        .nav-title h1 { font-size: 16px; font-weight: 800; color: var(--ink); line-height: 1.2; }
        .nav-title span { font-size: 11px; font-weight: 600; color: var(--muted); }

        .nav-right .badge {
            display: inline-flex; align-items: center; gap: 6px;
            background: #EEF7E2; color: #79A73A;
            padding: 6px 12px; border-radius: 20px;
            font-size: 11px; font-weight: 700;
            border: 1px solid #C4E2A5;
        }
        .nav-right .badge span {
            width: 6px; height: 6px; border-radius: 50%; background: #85C341;
            animation: pulse 2s infinite;
        }
        @keyframes pulse { 0%,100% { opacity: 1; } 50% { opacity: .4; } }

        /* Map Container */
        .map-wrap {
            flex: 1;
            position: relative;
            display: flex;
        }
        #map {
            width: 100%;
            height: 100%;
            z-index: 1;
        }

        /* Sidebar Overlay */
        .sidebar-overlay {
            position: absolute;
            top: 24px; left: 24px;
            width: 320px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid var(--line);
            border-radius: var(--r-lg);
            padding: 20px;
            z-index: 1000;
            box-shadow: 0 12px 32px rgba(0, 59, 100, 0.1);
        }
        .sidebar-overlay h2 { font-size: 15px; font-weight: 800; margin-bottom: 8px; }
        .sidebar-overlay p { font-size: 12.5px; color: var(--muted); margin-bottom: 20px; line-height: 1.5; }
        
        .info-box {
            background: var(--surface);
            border: 1px solid var(--line);
            border-radius: var(--r-md);
            padding: 12px;
            margin-bottom: 20px;
        }
        .info-label { font-size: 10px; font-weight: 700; color: var(--muted); text-transform: uppercase; margin-bottom: 4px; }
        input.info-val { 
            width: 100%; 
            border: 1px solid var(--line); 
            background: #fff;
            padding: 8px;
            border-radius: 4px;
            font-size: 13px; 
            font-weight: 700; 
            color: var(--ink); 
            font-family: monospace; 
            outline: none;
            transition: all .2s;
        }
        input.info-val:focus {
            border-color: var(--blue);
            box-shadow: 0 0 0 3px rgba(33, 138, 201, 0.1);
        }
        
        .btn-primary {
            display: flex; align-items: center; justify-content: center; gap: 8px;
            width: 100%; background: var(--blue); color: #fff;
            padding: 12px; border-radius: var(--r-md);
            border: none; font-family: inherit; font-size: 13px; font-weight: 700;
            cursor: pointer; transition: all .2s;
        }
        .btn-primary:hover { background: var(--blue-dk); transform: translateY(-1px); }

        /* Detail Modal (hidden by default) */
        .detail-card {
            display: none;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px dashed var(--line);
        }
        .detail-card.active { display: block; animation: slideUp .3s ease; }
        @keyframes slideUp { from { opacity:0; transform:translateY(10px); } to { opacity:1; transform:translateY(0); } }

        .zone-badge {
            display: inline-block; padding: 4px 10px; border-radius: 4px;
            font-size: 11px; font-weight: 700; margin-bottom: 12px;
        }
        .zone-yellow { background: #FFF8D6; color: #D37324; border: 1px solid #FDE68A; }
        .zone-green { background: #EEF7E2; color: #79A73A; border: 1px solid #C4E2A5; }
        
        .detail-item { margin-bottom: 12px; }
        .detail-item:last-child { margin-bottom: 0; }
        .detail-item strong { display: block; font-size: 11px; color: var(--muted); margin-bottom: 2px; }
        .detail-item span { font-size: 13px; font-weight: 600; color: var(--ink); }

        /* Leaflet Popup Form Overrides */
        .leaflet-popup-content { margin: 16px !important; }
        .leaflet-popup-content .form-group { margin-bottom: 14px; text-align: left; display: block; }
        .leaflet-popup-content .form-label { display: block; font-size: 12px; font-weight: 700; color: var(--ink); margin-bottom: 6px; }
        .leaflet-popup-content .form-control { 
            display: block; 
            width: 100%; 
            padding: 8px 12px; 
            font-size: 13px; 
            font-family: inherit;
            color: var(--ink); 
            background-color: #fff; 
            border: 1px solid var(--border); 
            border-radius: 6px; 
            box-sizing: border-box; 
        }
        .leaflet-popup-content .form-control:focus { outline: none; border-color: var(--blue); }
        .leaflet-popup-content .btn-primary { width: 100%; padding: 10px; font-weight: 700; font-size: 13px; }

        /* Rating Sidebar Panel */
        .rating-sidebar {
            position: absolute;
            top: 80px;
            right: 24px;
            width: 300px;
            background: #ffffff;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.08);
            z-index: 1000;
            max-height: calc(100vh - 120px);
            overflow-y: auto;
            border: 1px solid var(--border);
        }
        .rating-sidebar h2 { font-size: 14px; font-weight: 800; margin-bottom: 12px; display: flex; align-items: center; gap: 8px; }
        .rating-item { padding: 12px; border-bottom: 1px solid var(--border); cursor: pointer; transition: background 0.2s; }
        .rating-item:hover { background: #f8fafc; }
        .rating-item:last-child { border-bottom: none; }
        .rating-item-head { display: flex; justify-content: space-between; align-items: center; margin-bottom: 4px; }
        .rating-item-name { font-size: 13px; font-weight: 700; color: var(--ink); }
        .rating-item-stars { color: #f1c40f; font-size: 14px; }
        .rating-item-meta { font-size: 11px; color: var(--muted); }

        /* Mobile Responsiveness */
        @media (max-width: 768px) {
            .navbar { padding: 0 16px; height: 56px; }
            .nav-title h1 { font-size: 14px; }
            .nav-title span { font-size: 10px; }
            .sidebar-overlay {
                top: auto;
                bottom: 24px;
                left: 16px;
                right: 16px;
                width: auto;
                padding: 16px;
                box-shadow: 0 -4px 24px rgba(0,0,0,0.1);
            }
            .sidebar-overlay h2 { font-size: 14px; margin-bottom: 4px; }
            .sidebar-overlay p { font-size: 11px; margin-bottom: 12px; }
            .info-box { padding: 8px; margin-bottom: 12px; }
            input.info-val { font-size: 12px; padding: 6px; }
            .btn-primary { padding: 10px; font-size: 12px; }
            
            /* Move Leaflet controls up slightly to avoid overlapping */
            .leaflet-control-attribution { display: none; }
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <div class="nav-left">
            <a href="/" class="btn-back" title="Kembali ke Beranda">
                <svg viewBox="0 0 24 24"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
            </a>
            <div class="nav-title">
                <h1>Peta Publik Informal</h1>
                <span>Pengecekan Detail Zonasi Wilayah</span>
            </div>
        </div>
        <div class="nav-right">
            <!-- Badge Removed -->
        </div>
    </nav>

    <div class="map-wrap">
        <div id="map"></div>

        <div class="sidebar-overlay">
            <h2>Pengecekan Lokasi</h2>
            <p>Geser penanda (marker) pada peta ke koordinat yang ingin Anda periksa detail peruntukannya.</p>
            
            <div class="info-box">
                <div class="info-label">Koordinat Terpilih</div>
                <input type="text" class="info-val" id="coord-display" value="-6.92770, 106.93000" placeholder="Contoh: -6.92770, 106.93000">
            </div>

            <button class="btn-primary" id="btn-cek">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
                Cek Wilayah
            </button>

            <!-- Result Area -->
            <div class="detail-card" id="detail-result">
                <h3 style="font-size: 13px; font-weight: 800; margin-bottom: 8px;">Hasil Analisis Spasial</h3>
                <div class="detail-item">
                    <strong>Titik Koordinat</strong>
                    <span id="wilayah-text">-6.92770, 106.93000</span>
                </div>
                <div class="detail-item" id="result-status">
                    <span style="font-size:11px; color:var(--muted); font-style:italic;">Sedang memproses zonasi...</span>
                </div>
            </div>
            
            <div style="margin-top: 16px;">
                <h3 style="font-size: 11px; font-weight: 700; color: var(--muted); text-transform: uppercase; margin-bottom: 8px;">Layer Peta:</h3>
                <label style="display: flex; align-items: center; gap: 8px; font-size: 12px; margin-bottom: 4px; cursor: pointer;">
                    <input type="checkbox" id="layer-lp2b" checked> LP2B (Lahan Pertanian Pangan Berkelanjutan)
                </label>
                <label style="display: flex; align-items: center; gap: 8px; font-size: 12px; margin-bottom: 4px; cursor: pointer;">
                    <input type="checkbox" id="layer-lbs" checked> LBS (Lahan Baku Sawah)
                </label>
                <label style="display: flex; align-items: center; gap: 8px; font-size: 12px; margin-bottom: 4px; cursor: pointer;">
                    <input type="checkbox" id="layer-lsd" checked> LSD (Lahan Sawah Dilindungi)
                </label>
            </div>
        </div>
        
        <!-- Panel Rating History (Kanan) -->
        <div class="rating-sidebar">
            <h2>
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#f1c40f" stroke-width="2.5"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                Riwayat Ulasan
            </h2>
            <div style="font-size:11px; color:var(--muted); margin-bottom:12px;">Daftar rating dari masyarakat pada area informal.</div>
            
            <div style="margin-bottom: 12px; display:flex; gap:8px;">
                <button onclick="fitAllMarkers()" class="btn btn-primary btn-sm" style="flex:1; padding: 6px; font-size: 11px; border-radius: 4px;">Lihat Semua Titik</button>
            </div>
            
            <div id="rating-list-container">
                @forelse($ratings as $rating)
                    <div class="rating-item" onclick="flyToMarker({{ $rating->latitude }}, {{ $rating->longitude }})">
                        <div class="rating-item-head">
                            <span class="rating-item-name">{{ $rating->name ?: 'Anonim' }}</span>
                            <span class="rating-item-stars">
                                {{ str_repeat('★', $rating->rating) }}{{ str_repeat('☆', 5 - $rating->rating) }}
                            </span>
                        </div>
                        <div class="rating-item-meta">
                            Area: {{ strtoupper($rating->informal_type) }} | Koord: {{ number_format((float)$rating->latitude, 4) }}, {{ number_format((float)$rating->longitude, 4) }}
                        </div>
                        @if($rating->comment)
                        <div style="font-style:italic; font-size:11px; color:var(--muted); margin-top:6px; padding:6px; background:var(--bg); border-radius:4px;">
                            "{{ $rating->comment }}"
                        </div>
                        @endif
                    </div>
                @empty
                    <div class="text-center py-4 text-muted" style="font-size:12px;">Belum ada ulasan.</div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Leaflet & GIS JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="https://unpkg.com/@turf/turf@6/turf.min.js"></script>
    <script>
        const isLoggedIn = {{ auth()->check() ? 'true' : 'false' }};
        const csrfToken = '{{ csrf_token() }}';
        const existingRatings = @json($ratings);

        // Fungsi klik bintang
        function setStar(element, rating, formId) {
            let stars = element.parentElement.children;
            for(let i=0; i<5; i++) {
                if(i < rating) {
                    stars[i].style.color = '#f1c40f'; // warna emas
                } else {
                    stars[i].style.color = '#ccc'; // abu-abu
                }
            }
            document.getElementById('rating-val-' + formId).value = rating;
        }

        // Fungsi submit rating via AJAX
        function submitRating(event, formId, type, lat, lng) {
            event.preventDefault();
            
            let ratingVal = document.getElementById('rating-val-' + formId).value;
            if(!ratingVal) {
                alert('Silakan pilih rating terlebih dahulu.');
                return;
            }
            
            let commentVal = document.getElementById('rating-comment-' + formId).value;

            let name = '';
            if(!isLoggedIn) {
                name = document.getElementById('rating-name-' + formId).value;
                if(!name) {
                    alert('Silakan masukkan nama Anda.');
                    return;
                }
            }

            // Ganti tombol jadi loading
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
                    event.target.innerHTML = `<div class="text-success fw-bold mt-2"><i class="fas fa-check-circle"></i> ${data.message}</div>`;
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
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/proj4js/2.9.0/proj4.js"></script>
    <script src="https://unpkg.com/shpjs@latest/dist/shp.js"></script>
    <script>
        // Inisialisasi Peta (Fokus ke Sukabumi)
        // Definisikan Proyeksi Kustom untuk LBS (Cylindrical Equal Area)
        if (typeof proj4 !== 'undefined') {
            proj4.defs("ESRI:54034", "+proj=cea +lat_ts=0 +lon_0=0 +x_0=0 +y_0=0 +datum=WGS84 +units=m +no_defs");
            proj4.defs("World_Cylindrical_Equal_Area", "+proj=cea +lat_ts=0 +lon_0=0 +x_0=0 +y_0=0 +datum=WGS84 +units=m +no_defs");
        }

        // Koordinat tengah Sukabumi: -6.9277, 106.9300
        const map = L.map('map', {
            center: [-6.9277, 106.9300],
            zoom: 13,
            minZoom: 10,
            maxZoom: 18,
            // Batasi pan/drag hanya di area Sukabumi & sekitarnya
            maxBounds: [
                [-7.4000, 106.4000], // South-West
                [-6.6000, 107.1000]  // North-East
            ],
            maxBoundsViscosity: 1.0
        });

        // Layer Peta (OpenStreetMap)
        const tileLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors | Data Gistaru Dummy'
        }).addTo(map);

        // Marker yang bisa digeser
        const marker = L.marker([-6.9277, 106.9300], {
            draggable: true
        }).addTo(map);

        const coordDisplay = document.getElementById('coord-display');
        const detailResult = document.getElementById('detail-result');
        const btnCek = document.getElementById('btn-cek');
        const zoneStatus = document.getElementById('zone-status');

        // Update koordinat di input saat marker digeser
        marker.on('drag', function(e) {
            const lat = marker.getLatLng().lat.toFixed(5);
            const lng = marker.getLatLng().lng.toFixed(5);
            coordDisplay.value = `${lat}, ${lng}`;
            // Sembunyikan hasil jika marker digeser lagi
            detailResult.classList.remove('active');
        });

        // Pindahkan marker saat pengguna mengetik dan klik di luar input (blur/enter)
        coordDisplay.addEventListener('change', function() {
            const val = this.value;
            const parts = val.split(',');
            if(parts.length === 2) {
                const lat = parseFloat(parts[0].trim());
                const lng = parseFloat(parts[1].trim());
                if(!isNaN(lat) && !isNaN(lng)) {
                    marker.setLatLng([lat, lng]);
                    map.flyTo([lat, lng], 18, { duration: 1.5 });
                    detailResult.classList.remove('active');
                }
            }
        });

        // Simpan Data GeoJSON
        let geoData = {
            lp2b: null,
            lbs: null,
            lsd: null
        };
        let mapLayers = {
            lp2b: null,
            lbs: null,
            lsd: null
        };

        // Load GeoJSON natively
        const loadGeoJSON = (url, type, color, fillOpacity = 0.5) => {
            fetch(url).then(res => res.json()).then(geojson => {
                geoData[type] = geojson;
                mapLayers[type] = L.geoJSON(geojson, {
                    style: { color: color, weight: 2, fillOpacity: fillOpacity },
                    onEachFeature: function(feature, layer) {
                        layer.on('click', function(e) {
                            // Zoom in (perdekat) ke poligon yang diklik
                            map.fitBounds(layer.getBounds(), { maxZoom: 18, padding: [20, 20] });
                            
                            // Ambil koordinat titik yang diklik
                            const lat = e.latlng.lat.toFixed(6);
                            const lng = e.latlng.lng.toFixed(6);
                            
                            // Tampilkan popup dengan nama area dan koordinat + FORM RATING
                            let formId = lat.replace('.', '_') + '-' + lng.replace('.', '_') + '-' + Math.floor(Math.random() * 1000);
                            
                            const popupContent = `
                                <div style="min-width: 260px; text-align: left;">
                                    <h4 style="font-size:14px; font-weight:800; color:var(--ink); margin:0 0 4px 0; display:flex; align-items:center; gap:6px;">
                                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                                        Ulasan Area ${type.toUpperCase()}
                                    </h4>
                                    <div style="font-size:12px; color:var(--muted); margin-bottom:16px; padding-bottom:12px; border-bottom:1px solid var(--border);">Koord: ${lat}, ${lng}</div>
                                    
                                    <form id="form-${formId}" onsubmit="submitRating(event, '${formId}', '${type}', '${lat}', '${lng}')">
                                        ${!isLoggedIn ? `
                                        <div class="form-group">
                                            <label class="form-label">Nama Anda</label>
                                            <input type="text" id="rating-name-${formId}" class="form-control" placeholder="Tulis nama Anda..." required>
                                        </div>` : ''}
                                        
                                        <div class="form-group">
                                            <label class="form-label">Penilaian Anda</label>
                                            <select id="rating-val-${formId}" class="form-control" required>
                                                <option value="" disabled selected>-- Pilih Penilaian --</option>
                                                <option value="5">(5) Sangat Baik</option>
                                                <option value="4">(4) Baik</option>
                                                <option value="3">(3) Cukup Baik</option>
                                                <option value="2">(2) Kurang</option>
                                                <option value="1">(1) Sangat Kurang</option>
                                            </select>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="form-label">Catatan / Feedback</label>
                                            <textarea id="rating-comment-${formId}" class="form-control" rows="2" placeholder="Tulis ulasan singkat Anda..."></textarea>
                                        </div>
                                        
                                        <button type="submit" class="btn btn-primary" style="margin-top: 4px;">Kirim Ulasan</button>
                                    </form>
                                </div>
                            `;
                            layer.bindPopup(popupContent).openPopup(e.latlng);
                        });
                    }
                });
                
                if (document.getElementById('layer-' + type).checked) {
                    mapLayers[type].addTo(map);
                }
            }).catch(e => console.log('Error loading GeoJSON: ', url, e));
        };

        // URL file GeoJSON yang sudah direproject
        loadGeoJSON('/storage/shp_bpn/lp2b.geojson', 'lp2b', '#2ecc71');
        loadGeoJSON('/storage/shp_bpn/lbs.geojson', 'lbs', '#f1c40f');
        loadGeoJSON('/storage/shp_bpn/lsd.geojson', 'lsd', '#e74c3c');

        // Load Sukabumi Bounds to lock the map
        fetch('/storage/shp_bpn/sukabumi_bounds.geojson').then(res => res.json()).then(geojson => {
            const boundsLayer = L.geoJSON(geojson, {
                style: {
                    color: '#003B64',
                    weight: 3,
                    opacity: 0.8,
                    dashArray: '5, 5'
                },
                interactive: false
            }).addTo(map);
            
            const bounds = boundsLayer.getBounds();
            
            // Batasi view/panning ke batas Sukabumi
            map.setMaxBounds(bounds.pad(0.02));
            map.fitBounds(bounds);
            
            // Kunci level zoom supaya mentok seukuran bounds
            map.setMinZoom(map.getBoundsZoom(bounds));
        }).catch(e => console.log('Error bounds:', e));

        // Checkbox events
        ['lp2b', 'lbs', 'lsd'].forEach(type => {
            document.getElementById('layer-' + type).addEventListener('change', function() {
                if (mapLayers[type]) {
                    if (this.checked) map.addLayer(mapLayers[type]);
                    else map.removeLayer(mapLayers[type]);
                }
            });
        });

        // Cek Wilayah
        btnCek.addEventListener('click', function() {
            const btn = this;
            const originalText = btn.innerHTML;
            
            btn.innerHTML = `<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="animation: spin 1s linear infinite;"><circle cx="12" cy="12" r="10" stroke-opacity="0.25"/><path d="M12 2v4"/></svg> Menganalisis...`;
            btn.disabled = true;

            setTimeout(() => {
                btn.innerHTML = originalText;
                btn.disabled = false;

                const lat = marker.getLatLng().lat;
                const lng = marker.getLatLng().lng;
                document.getElementById('wilayah-text').textContent = `${lat.toFixed(5)}, ${lng.toFixed(5)}`;
                
                // Spatial Analysis with Turf.js
                const pt = turf.point([lng, lat]);
                let matches = [];

                ['lp2b', 'lbs', 'lsd'].forEach(type => {
                    if (geoData[type]) {
                        // Iterasi fitur di GeoJSON
                        let features = geoData[type].features;
                        for (let i = 0; i < features.length; i++) {
                            // Karena bisa Polygon atau MultiPolygon, turf.booleanPointInPolygon mensupport keduanya
                            if (turf.booleanPointInPolygon(pt, features[i])) {
                                matches.push(type.toUpperCase());
                                break;
                            }
                        }
                    }
                });

                const resultDiv = document.getElementById('result-status');
                if (matches.length > 0) {
                    let badges = matches.map(m => `<span class="zone-badge zone-yellow">Masuk Area ${m}</span>`).join(' ');
                    resultDiv.innerHTML = `${badges}<br><span style="font-size:11px; color:var(--ink); font-weight: 600;">Koordinat ini terindikasi berada di dalam area yang dilindungi/dipertahankan. Harap perhatikan persyaratan ekstra.</span>`;
                } else {
                    resultDiv.innerHTML = `<span class="zone-badge zone-green">Bebas LP2B/LBS/LSD</span><br><span style="font-size:11px; color:var(--ink); font-weight: 600;">Koordinat ini tidak terdeteksi berada di zona LP2B, LBS, atau LSD (Berdasarkan data awal).</span>`;
                }

                detailResult.classList.add('active');
            }, 800);
        });

        // Tampilkan Marker untuk Rating yang Sudah Ada
        window.ratingMarkers = {};
        const allMarkersGroup = L.featureGroup().addTo(map);

        existingRatings.forEach(r => {
            if(r.latitude && r.longitude) {
                // Custom Icon Pin dengan Bintang Emas di tengahnya
                const customPin = L.divIcon({
                    className: 'custom-rating-pin',
                    html: `<svg viewBox="0 0 24 24" width="36" height="36" style="filter: drop-shadow(0px 4px 4px rgba(0,0,0,0.3));">
                            <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z" fill="#003B64" stroke="#FFFFFF" stroke-width="1.5"/>
                            <polygon points="12 6 13.5 9 16.5 9.5 14 11.5 14.5 14.5 12 13 9.5 14.5 10 11.5 7.5 9.5 10.5 9" fill="#f1c40f"/>
                           </svg>`,
                    iconSize: [36, 36],
                    iconAnchor: [18, 36],
                    popupAnchor: [0, -36]
                });

                const marker = L.marker([parseFloat(r.latitude), parseFloat(r.longitude)], {
                    icon: customPin
                });
                
                let stars = '★'.repeat(r.rating) + '☆'.repeat(5 - r.rating);
                marker.bindPopup(`
                    <div class="text-center" style="min-width: 150px;">
                        <strong class="d-block mb-1">${r.name || 'Anonim'}</strong>
                        <div style="color: #f1c40f; font-size: 16px; letter-spacing: 2px;">${stars}</div>
                        <small class="text-muted d-block mt-2">Area: ${r.informal_type.toUpperCase()}</small>
                        <small style="font-size:10px; color:#aaa; margin-bottom: 6px; display:block;">${r.latitude}, ${r.longitude}</small>
                        ${r.comment ? `<div style="font-style:italic; font-size:10px; color:var(--muted); text-align:left; padding:4px; background:var(--bg); border-radius:4px; margin-bottom:8px;">"${r.comment}"</div>` : ''}
                        
                        <a href="https://www.google.com/maps?q=${r.latitude},${r.longitude}" target="_blank" class="btn btn-sm btn-outline-primary w-100" style="padding:4px; font-size:10px; display:block; margin-top:4px; text-decoration:none;">
                            🌍 Buka di Google Maps
                        </a>
                    </div>
                `);
                
                allMarkersGroup.addLayer(marker);
                
                // Simpan marker global pakai key koordinat
                let key = parseFloat(r.latitude).toFixed(6) + '_' + parseFloat(r.longitude).toFixed(6);
                window.ratingMarkers[key] = marker;
            }
        });

        // Fungsi Fly To Marker
        function flyToMarker(lat, lng) {
            let key = parseFloat(lat).toFixed(6) + '_' + parseFloat(lng).toFixed(6);
            if (window.ratingMarkers[key]) {
                map.flyTo([lat, lng], 18, { duration: 1.5 });
                setTimeout(() => {
                    window.ratingMarkers[key].openPopup();
                }, 1500);
            }
        }

        function fitAllMarkers() {
            if (allMarkersGroup.getLayers().length > 0) {
                map.fitBounds(allMarkersGroup.getBounds(), { padding: [30, 30] });
            } else {
                alert('Belum ada titik ulasan yang tersedia.');
            }
        }

    </script>
    <style>
        @keyframes spin { 100% { transform: rotate(360deg); } }
        
        /* Hover effect for custom pin */
        .custom-rating-pin svg {
            transition: transform 0.2s ease;
        }
        .custom-rating-pin:hover svg {
            transform: scale(1.15) translateY(-4px);
        }
    </style>
</body>
</html>
