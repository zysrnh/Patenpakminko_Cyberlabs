<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peta Publik Informal - PATENPAKMIKO</title>

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
                <div class="detail-item">
                    <span style="font-size:11px; color:var(--muted); font-style:italic;">*Data status zonasi dan rekomendasi belum tersedia.</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script>
        // Inisialisasi Peta (Fokus ke Sukabumi)
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
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
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

        // Simulasi Cek Wilayah
        btnCek.addEventListener('click', function() {
            const btn = this;
            const originalText = btn.innerHTML;
            
            // Loading state
            btn.innerHTML = `<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="animation: spin 1s linear infinite;"><circle cx="12" cy="12" r="10" stroke-opacity="0.25"/><path d="M12 2v4"/></svg> Menganalisis...`;
            btn.disabled = true;

            // Simulasi delay API (1.5 detik)
            setTimeout(() => {
                btn.innerHTML = originalText;
                btn.disabled = false;

                // Simple dummy logic
                const finalLat = marker.getLatLng().lat.toFixed(5);
                const finalLng = marker.getLatLng().lng.toFixed(5);
                document.getElementById('wilayah-text').textContent = `${finalLat}, ${finalLng}`;
                
                detailResult.classList.add('active');
            }, 1000);
        });

    </script>
    <style>
        @keyframes spin { 100% { transform: rotate(360deg); } }
    </style>
</body>
</html>
