<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @php
        $jenisPermohonan = session('ptp_form_data.jenis_permohonan', 'tanah-timbul');
        $serviceName = 'Tanah Timbul';
        if ($jenisPermohonan === 'psn') {
            $serviceName = 'Proyek Strategis Nasional (PSN)';
        } elseif ($jenisPermohonan === 'tanah-timbul') {
            $serviceName = 'Tanah Timbul';
        }
    @endphp
    <title>Form Pengajuan {{ $serviceName }} â€” PATEN PAK MIKO</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
 
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
 
        :root {
            --clr-blue:    #218AC9;
            --clr-blue-dk: #003B64;
            --clr-blue-lt: #E3F0F9;
            --clr-yellow:  #FFCB05;
            --clr-green:   #85C341;
            --clr-ink:     #003B64;
            --clr-mid:     #2C5272;
            --clr-muted:   #7A9BB5;
            --clr-line:    #D6E4EF;
            --clr-surface: #F0F6FB;
            --clr-white:   #FFFFFF;
            --radius-sm:   6px;
            --radius-md:   10px;
            --radius-lg:   16px;
            --radius-xl:   24px;
        }
 
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--clr-surface);
            color: var(--clr-ink);
            min-height: 100vh;
            -webkit-font-smoothing: antialiased;
        }
 
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 0 24px;
        }
 
        /* â”€â”€â”€ HEADER â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€ */
        header {
            background: var(--clr-white);
            border-bottom: 1px solid var(--clr-line);
            position: sticky;
            top: 0;
            z-index: 10;
        }
 
        .header-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 72px;
        }
 
        .logo-wrap {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }
        .logo-icon {
            width: 40px;
            height: 40px;
            border-radius: var(--radius-md);
            background: var(--clr-blue);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .logo-icon svg {
            width: 20px;
            height: 20px;
            fill: none;
            stroke: #fff;
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
        }
        .logo-text {
            display: flex;
            flex-direction: column;
            line-height: 1;
        }
        .logo-text strong {
            font-size: 16px;
            font-weight: 800;
            color: var(--clr-ink);
            letter-spacing: -.02em;
        }
        .logo-text span {
            font-size: 10px;
            font-weight: 600;
            color: var(--clr-muted);
            text-transform: uppercase;
            letter-spacing: .1em;
            margin-top: 3px;
        }
 
        .nav-menu {
            display: flex;
            align-items: center;
            gap: 24px;
        }
        .nav-link {
            font-size: 14px;
            font-weight: 600;
            color: var(--clr-mid);
            text-decoration: none;
            transition: color 0.2s;
        }
        .nav-link:hover, .nav-link.active {
            color: var(--clr-blue);
        }
 
        .btn-logout {
            background: transparent;
            border: 1px solid var(--clr-line);
            color: var(--clr-mid);
            padding: 8px 14px;
            font-family: inherit;
            font-size: 12.5px;
            font-weight: 600;
            border-radius: var(--radius-md);
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.2s;
        }
        .btn-logout:hover {
            color: #E53E3E;
            border-color: #FED7D7;
            background: #FFF5F5;
        }
 
        .user-nav {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .header-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 1.5px solid var(--clr-blue);
        }
        .header-avatar-placeholder {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--clr-blue-lt);
            color: var(--clr-blue);
            font-weight: 700;
            font-size: 13px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1.5px solid var(--clr-blue);
            text-transform: uppercase;
        }
        .user-badge {
            display: flex;
            flex-direction: column;
            text-align: left;
        }
        .user-badge strong {
            font-size: 14px;
            font-weight: 700;
            color: var(--clr-ink);
        }
        .user-badge span {
            font-size: 11px;
            color: var(--clr-muted);
            font-weight: 600;
        }
 
        /* â”€â”€â”€ MAIN CONTENT â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€ */
        main {
            padding: 40px 0;
        }
 
        .card {
            background: var(--clr-white);
            border: 1px solid var(--clr-line);
            border-radius: var(--radius-lg);
            padding: 32px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.01);
            margin-bottom: 32px;
        }
 
        .card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 28px;
            padding-bottom: 16px;
            border-bottom: 1.5px solid var(--clr-surface);
        }
        .card-title {
            font-size: 20px;
            font-weight: 800;
            color: var(--clr-ink);
            letter-spacing: -0.02em;
        }
        .back-link {
            font-size: 13px;
            font-weight: 700;
            color: var(--clr-muted);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            transition: color 0.15s;
        }
        .back-link:hover {
            color: var(--clr-ink);
        }
 
        /* â”€â”€â”€ FORM ELEMENTS â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€ */
        .form-section-title {
            font-size: 14px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--clr-blue);
            margin-top: 12px;
            margin-bottom: 20px;
        }
 
        .form-group {
            margin-bottom: 22px;
        }
        .form-grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
 
        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 700;
            color: var(--clr-ink);
            margin-bottom: 8px;
        }
        .form-label .req {
            color: #E53E3E;
        }
 
        .form-control {
            width: 100%;
            padding: 11px 14px;
            font-family: inherit;
            font-size: 13.5px;
            color: var(--clr-ink);
            background: var(--clr-white);
            border: 1.5px solid var(--clr-line);
            border-radius: var(--radius-md);
            outline: none;
            transition: all 0.15s;
        }
        .form-control:focus {
            border-color: var(--clr-blue);
            box-shadow: 0 0 0 3px rgba(19, 147, 204, 0.1);
        }
        .form-control::placeholder {
            color: var(--clr-muted);
        }
 
        .file-input-wrapper {
            display: flex;
            flex-direction: column;
            gap: 6px;
            background: var(--clr-surface);
            border: 1px dashed var(--clr-line);
            border-radius: var(--radius-md);
            padding: 12px 16px;
        }
        .file-input-wrapper input {
            font-size: 13px;
        }
        .file-help {
            display: block;
            margin-top: 8px;
            font-size: 11px;
            color: var(--clr-muted);
        }
 
        .error-message {
            font-size: 12px;
            color: #E53E3E;
            margin-top: 6px;
            display: block;
        }
 
        .form-footer {
            margin-top: 32px;
            padding-top: 24px;
            border-top: 1px solid var(--clr-line);
            display: flex;
            justify-content: flex-end;
            gap: 16px;
        }
 
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px 24px;
            font-family: inherit;
            font-weight: 600;
            font-size: 14px;
            border-radius: var(--radius-md);
            cursor: pointer;
            border: none;
            transition: all 0.2s;
            text-decoration: none;
        }
 
        .btn-cancel {
            background: var(--clr-white);
            color: var(--clr-mid);
            border: 1px solid var(--clr-line);
        }
        .btn-cancel:hover {
            background: var(--clr-surface);
        }
 
        .btn-primary {
            background: var(--clr-blue);
            color: var(--clr-white);
        }
        .btn-primary:hover {
            background: var(--clr-blue-dk);
            box-shadow: 0 4px 12px rgba(33, 138, 201, 0.2);
            transform: translateY(-0.5px);
        }

        /* Slide Modal */
        .modal-backdrop {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0,0,0,0.5); z-index: 999;
            opacity: 0; pointer-events: none; transition: opacity 0.3s;
        }
        .modal-backdrop.show { opacity: 1; pointer-events: auto; }
        
        .modal-slide {
            position: fixed; top: 0; right: -600px; width: 600px; max-width: 90%; height: 100vh;
            background: #fff; z-index: 1000; box-shadow: -4px 0 20px rgba(0,0,0,0.1);
            transition: right 0.3s cubic-bezier(0.4, 0, 0.2, 1); display: flex; flex-direction: column;
        }
        .modal-slide.open { right: 0; }
        .modal-header {
            padding: 16px 24px; border-bottom: 1px solid var(--clr-line);
            display: flex; justify-content: space-between; align-items: center;
        }
        .modal-title { font-size: 16px; font-weight: 700; color: var(--clr-ink); }
        .btn-close {
            background: transparent; border: none; font-size: 24px; color: var(--clr-muted);
            cursor: pointer; line-height: 1; padding: 4px;
        }
        .modal-body { flex: 1; padding: 0; background: #f0f0f0; }
        .modal-body iframe { width: 100%; height: 100%; border: none; }

        .btn-contoh {
            background: #E3F0F9; border: 1px solid #218AC9; color: #218AC9;
            padding: 2px 8px; font-size: 11px; font-weight: 700; border-radius: 4px;
            cursor: pointer; margin-left: 8px; font-family: inherit; display: inline-flex; align-items: center; gap: 4px;
        }
        .btn-contoh:hover { background: #218AC9; color: white; }
    
        @media (max-width: 768px) {
            .templates-card { flex-direction: column; align-items: flex-start; gap: 16px; }
            .templates-actions { flex-direction: column; width: 100%; }
            .btn-dl { width: 100%; justify-content: center; }
            .form-grid-2 { grid-template-columns: 1fr; }
            .modal-slide { width: 100%; right: -100%; }
            .modal-slide.open { right: 0; }
        }
    </style>
</head>
<body>
 
    <!-- Header -->
    <header>
        <div class="container" style="max-width: 1000px;">
            <div class="header-inner">
                <a href="/dashboard" class="logo-wrap">
                    <div class="logo-icon">
                        <svg viewBox="0 0 24 24">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                        </svg>
                    </div>
                    <div class="logo-text">
                        <strong>PATEN PAK MIKO</strong>
                        <span>Kantor Pertanahan Sukabumi</span>
                    </div>
                </a>
 
                <div class="nav-menu">
                    <a href="/" class="nav-link">Beranda</a>
                    <form action="{{ route('logout') }}" method="POST" style="margin-left: 8px;">
                        @csrf
                        <button type="submit" class="btn-logout">Keluar</button>
                    </form>
                </div>
            </div>
        </div>
    </header>
 
    <!-- Main -->
    <main>
        <div class="container">
 
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Permohonan {{ $serviceName }} Baru</h2>
                    <a href="{{ route('tanah-timbul.index') }}" class="back-link">
                        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        Kembali
                    </a>
                </div>
 
                <form action="{{ route('tanah-timbul.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @php
                        $ptpNama = session('ptp_form_data.nama', '');
                        $ptpHubungan = session('ptp_form_data.bertindak_atas_nama', '');
                        
                        $selectedHubungan = old('hubungan_pengaju');
                        if (!$selectedHubungan) {
                            if ($ptpHubungan === 'Diri Sendiri') {
                                $selectedHubungan = 'Pemilik Usaha / Pengguna Layanan';
                            } elseif ($ptpHubungan === 'Penerima Kuasa') {
                                $selectedHubungan = 'Penerima Kuasa';
                            } elseif ($ptpHubungan) {
                                $selectedHubungan = 'Lainnya';
                            }
                        }
                    @endphp
 
                    <!-- SECTION 1: DATA IDENTITAS PEMOHON / PENGGUNA LAYANAN -->
                    <div class="form-section-title">1. Identitas Pemohon / Pengguna Layanan</div>
 
                    <!-- Nama Pemilik Usaha -->
                    <!-- Nama Pemilik Usaha (Hidden) -->
                    <input type="hidden" name="nama_pemilik_usaha" value="{{ old('nama_pemilik_usaha', $ptpNama ?: (Auth::user()->name ?? Auth::user()->username)) }}">
 
                    <div class="form-grid-2">
                        <!-- Nama Pengaju -->
                        <div class="form-group">
                            <label for="nama_pengaju" class="form-label">Nama Pemohon / Pengguna Layanan <span class="req">*</span></label>
                            <input type="text" id="nama_pengaju" name="nama_pengaju" class="form-control" placeholder="Masukkan nama pemohon / pengguna layanan" value="{{ old('nama_pengaju', $ptpNama ?: (Auth::user()->name ?? Auth::user()->username)) }}" required readonly style="background: #f0f0f0; cursor: not-allowed;">
                            @error('nama_pengaju')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
 
                        <!-- Hubungan Pengaju / Sebagai Apa -->
                        <div class="form-group">
                            <label for="hubungan_pengaju" class="form-label">Hubungan Pengaju (Sebagai Apa) <span class="req">*</span></label>
                            <select id="hubungan_pengaju" name="hubungan_pengaju" class="form-control" required style="background: white; -webkit-appearance: listbox;">
                                <option value="" disabled {{ $selectedHubungan ? '' : 'selected' }}>Pilih Hubungan Pengaju</option>
                                <option value="Pemilik Usaha / Pengguna Layanan" {{ $selectedHubungan === 'Pemilik Usaha / Pengguna Layanan' ? 'selected' : '' }}>Pemilik Usaha / Pengguna Layanan</option>
                                <option value="Penerima Kuasa" {{ $selectedHubungan === 'Penerima Kuasa' ? 'selected' : '' }}>Penerima Kuasa</option>
                                <option value="Lainnya" {{ $selectedHubungan === 'Lainnya' ? 'selected' : '' }}>Instansi / PT / Lainnya (Ketik Manual)</option>
                            </select>
                            
                            <div id="hubungan_pengaju_lainnya_wrapper" style="display: {{ $selectedHubungan === 'Lainnya' ? 'block' : 'none' }}; margin-top: 8px;">
                                <input type="text" id="hubungan_pengaju_lainnya" name="hubungan_pengaju_lainnya" class="form-control" placeholder="Masukkan hubungan pengaju secara manual (cth: Instansi, PT, Karyawan, dll)" value="{{ old('hubungan_pengaju_lainnya', in_array($ptpHubungan, ['PT / Badan Usaha', 'Instansi Pemerintah']) ? $ptpHubungan : '') }}">
                            </div>

                            @error('hubungan_pengaju')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                            @error('hubungan_pengaju_lainnya')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <script>
                            document.addEventListener('DOMContentLoaded', function () {
                                const selectHubungan = document.getElementById('hubungan_pengaju');
                                const wrapperLainnya = document.getElementById('hubungan_pengaju_lainnya_wrapper');
                                const inputLainnya = document.getElementById('hubungan_pengaju_lainnya');

                                function toggleLainnya() {
                                    if (selectHubungan.value === 'Lainnya') {
                                        wrapperLainnya.style.display = 'block';
                                        inputLainnya.setAttribute('required', 'required');
                                    } else {
                                        wrapperLainnya.style.display = 'none';
                                        inputLainnya.removeAttribute('required');
                                    }
                                }

                                selectHubungan.addEventListener('change', toggleLainnya);
                                toggleLainnya();
                            });
                        </script>
                    </div>
 
                    <!-- SECTION 2: UNGGAH PERSYARATAN -->
                    <div class="form-section-title">2. Unggah Berkas Persyaratan</div>
 
                    <!-- 1. Peta / Sketsa Lokasi -->
                    <div class="form-group">
                        <label for="peta_lokasi" class="form-label">1. Peta/sketsa lokasi yang dimohon <span class="req">*</span> <button type="button" class="btn-contoh" onclick="openPreview('{{ asset('storage/Contoh_Format/2%20Peta%20atau%20Sketsa%20Lokasi.pdf') }}', 'Contoh Peta / Sketsa Lokasi')">Lihat Contoh</button></label>
                        <div class="file-input-wrapper">
                            <input type="file" id="peta_lokasi" name="peta_lokasi" accept=".pdf,.jpg,.jpeg,.png" required>
                            <span class="file-help">Format: PDF, JPG, PNG. Maks. 5MB.</span>
                        </div>
                        @error('peta_lokasi')<span class="error-message">{{ $message }}</span>@enderror
                    </div>

                    <!-- 2. Surat Kuasa -->
                    <div class="form-group">
                        <label for="surat_kuasa" class="form-label">2. Surat kuasa <span class="req">*</span> <button type="button" class="btn-contoh" onclick="openPreview('{{ asset('storage/Contoh_Format/3%20Surat%20Kuasa.pdf') }}', 'Contoh Surat Kuasa')">Lihat Contoh</button></label>
                        <div class="file-input-wrapper">
                            <input type="file" id="surat_kuasa" name="surat_kuasa" accept=".pdf,.jpg,.jpeg,.png" required>
                            <span class="file-help">Format: PDF, JPG, PNG. Maks. 5MB.</span>
                        </div>
                        @error('surat_kuasa')<span class="error-message">{{ $message }}</span>@enderror
                    </div>

                    <!-- 3. FC KTP -->
                    <div class="form-group">
                        <label for="fc_ktp" class="form-label">3. Fotokopi KTP <span class="req">*</span> <button type="button" class="btn-contoh" onclick="openPreview('{{ asset('storage/Contoh_Format/4%20KTP%20Kuasa%20dan%20Pemberi%20Kuasa.pdf') }}', 'Contoh Fotokopi KTP')">Lihat Contoh</button></label>
                        <div class="file-input-wrapper">
                            <input type="file" id="fc_ktp" name="fc_ktp" accept=".pdf,.jpg,.jpeg,.png" required>
                            <span class="file-help">Format: PDF, JPG, PNG. Maks. 5MB.</span>
                        </div>
                        @error('fc_ktp')<span class="error-message">{{ $message }}</span>@enderror
                    </div>

                    <!-- 4. FC NPWP -->
                    <div class="form-group">
                        <label for="fc_npwp" class="form-label">4. Fotokopi NPWP <span class="req">*</span> <button type="button" class="btn-contoh" onclick="openPreview('{{ asset('storage/Contoh_Format/5%20NPWP%20Badan%20Usaha.pdf') }}', 'Contoh Fotokopi NPWP')">Lihat Contoh</button></label>
                        <div class="file-input-wrapper">
                            <input type="file" id="fc_npwp" name="fc_npwp" accept=".pdf,.jpg,.jpeg,.png" required>
                            <span class="file-help">Format: PDF, JPG, PNG. Maks. 5MB.</span>
                        </div>
                        @error('fc_npwp')<span class="error-message">{{ $message }}</span>@enderror
                    </div>

                    <!-- 5. Akta Pendirian / Dokumen Penetapan -->
                    <div class="form-group">
                        @if($jenisPermohonan === 'psn')
                            <label for="fc_akta_pendirian" class="form-label">5. Dokumen Penetapan / Rekomendasi PSN dari Kementerian / Lembaga Teknis <span class="req">*</span></label>
                            <div class="file-input-wrapper">
                                <input type="file" id="fc_akta_pendirian" name="fc_akta_pendirian" accept=".pdf,.jpg,.jpeg,.png" required>
                                <span class="file-help">Format: PDF, JPG, PNG. Maks. 10MB. (Surat penetapan PSN / rekomendasi resmi)</span>
                            </div>
                        @elseif($jenisPermohonan === 'tanah-timbul')
                            <label for="fc_akta_pendirian" class="form-label">5. Surat Keterangan Tanah Timbul dari Kepala Desa / Lurah <span class="req">*</span></label>
                            <div class="file-input-wrapper">
                                <input type="file" id="fc_akta_pendirian" name="fc_akta_pendirian" accept=".pdf,.jpg,.jpeg,.png" required>
                                <span class="file-help">Format: PDF, JPG, PNG. Maks. 10MB. (Surat resmi desa/kelurahan setempat)</span>
                            </div>
                        @else
                            <label for="fc_akta_pendirian" class="form-label">5. Fotokopi Akta Pendirian & Pengesahan Badan Hukum <span class="req">*</span> <button type="button" class="btn-contoh" onclick="openPreview('{{ asset('storage/Contoh_Format/6%20Akta%20Pendirian.pdf') }}', 'Contoh Akta Pendirian')">Lihat Contoh</button></label>
                            <div class="file-input-wrapper">
                                <input type="file" id="fc_akta_pendirian" name="fc_akta_pendirian" accept=".pdf,.jpg,.jpeg,.png" required>
                                <span class="file-help">Format: PDF, JPG, PNG. Maks. 10MB.</span>
                            </div>
                        @endif
                        @error('fc_akta_pendirian')<span class="error-message">{{ $message }}</span>@enderror
                    </div>

                    <!-- 6. Rencana Penggunaan Tanah -->
                    <div class="form-group">
                        <label for="rencana_penggunaan_tanah" class="form-label">6. Rencana Penggunaan & Pemanfaatan Tanah <span class="req">*</span></label>
                        <div class="file-input-wrapper">
                            <input type="file" id="rencana_penggunaan_tanah" name="rencana_penggunaan_tanah" accept=".pdf,.jpg,.jpeg,.png" required>
                            <span class="file-help">Format: PDF, JPG, PNG. Maks. 10MB.</span>
                        </div>
                        @error('rencana_penggunaan_tanah')<span class="error-message">{{ $message }}</span>@enderror
                    </div>

                    <!-- 7. NIB -->
                    <div class="form-group">
                        @if($jenisPermohonan === 'psn')
                            <label for="nib" class="form-label">7. Nomor Induk Berusaha (NIB) / Izin Usaha Sektoral <span class="req">*</span> <button type="button" class="btn-contoh" onclick="openPreview('{{ asset('storage/Contoh_Format/8%20NIB%20(Nomor%20Induk%20Berusaha).pdf') }}', 'Contoh NIB')">Lihat Contoh</button></label>
                            <div class="file-input-wrapper">
                                <input type="file" id="nib" name="nib" accept=".pdf,.jpg,.jpeg,.png" required>
                                <span class="file-help">Format: PDF, JPG, PNG. Maks. 5MB.</span>
                            </div>
                        @elseif($jenisPermohonan === 'tanah-timbul')
                            <label for="nib" class="form-label">7. Surat Pernyataan Penguasaan Fisik Bidang Tanah (Sporadik) <span class="req">*</span></label>
                            <div class="file-input-wrapper">
                                <input type="file" id="nib" name="nib" accept=".pdf,.jpg,.jpeg,.png" required>
                                <span class="file-help">Format: PDF, JPG, PNG. Maks. 5MB.</span>
                            </div>
                        @else
                            <label for="nib" class="form-label">7. Nomor Induk Berusaha (NIB) <span class="req">*</span> <button type="button" class="btn-contoh" onclick="openPreview('{{ asset('storage/Contoh_Format/8%20NIB%20(Nomor%20Induk%20Berusaha).pdf') }}', 'Contoh NIB')">Lihat Contoh</button></label>
                            <div class="file-input-wrapper">
                                <input type="file" id="nib" name="nib" accept=".pdf,.jpg,.jpeg,.png" required>
                                <span class="file-help">Format: PDF, JPG, PNG. Maks. 5MB.</span>
                            </div>
                        @endif
                        @error('nib')<span class="error-message">{{ $message }}</span>@enderror
                    </div>

                    <!-- 8. KBLI -->
                    <div class="form-group">
                        @if($jenisPermohonan === 'psn')
                            <label for="kbli" class="form-label">8. Dokumen KBLI / Klasifikasi Lapangan Usaha PSN <span class="req">*</span> <button type="button" class="btn-contoh" onclick="openPreview('{{ asset('storage/Contoh_Format/9%20KBLI%20(Klasifikasi%20Baku%20Lapangan%20Usaha%20Indonesia).pdf') }}', 'Contoh Dokumen KBLI')">Lihat Contoh</button></label>
                            <div class="file-input-wrapper">
                                <input type="file" id="kbli" name="kbli" accept=".pdf,.jpg,.jpeg,.png" required>
                                <span class="file-help">Format: PDF, JPG, PNG. Maks. 5MB.</span>
                            </div>
                        @elseif($jenisPermohonan === 'tanah-timbul')
                            <label for="kbli" class="form-label">8. Berita Acara Peninjauan / Rekomendasi Batas Kelurahan <span class="req">*</span></label>
                            <div class="file-input-wrapper">
                                <input type="file" id="kbli" name="kbli" accept=".pdf,.jpg,.jpeg,.png" required>
                                <span class="file-help">Format: PDF, JPG, PNG. Maks. 5MB.</span>
                            </div>
                        @else
                            <label for="kbli" class="form-label">8. Dokumen KBLI yang diajukan <span class="req">*</span> <button type="button" class="btn-contoh" onclick="openPreview('{{ asset('storage/Contoh_Format/9%20KBLI%20(Klasifikasi%20Baku%20Lapangan%20Usaha%20Indonesia).pdf') }}', 'Contoh Dokumen KBLI')">Lihat Contoh</button></label>
                            <div class="file-input-wrapper">
                                <input type="file" id="kbli" name="kbli" accept=".pdf,.jpg,.jpeg,.png" required>
                                <span class="file-help">Format: PDF, JPG, PNG. Maks. 5MB.</span>
                            </div>
                        @endif
                        @error('kbli')<span class="error-message">{{ $message }}</span>@enderror
                    </div>

                    <!-- 9. Proposal -->
                    <div class="form-group">
                        @if($jenisPermohonan === 'psn')
                            <label for="proposal_kegiatan" class="form-label">9. Proposal Rencana Kegiatan / Masterplan PSN <span class="req">*</span> <button type="button" class="btn-contoh" onclick="openPreview('{{ asset('storage/Contoh_Format/10%20Proposal%20Rencana%20Kegiatan%20Berusaha.pdf') }}', 'Contoh Proposal Kegiatan')">Lihat Contoh</button></label>
                            <div class="file-input-wrapper">
                                <input type="file" id="proposal_kegiatan" name="proposal_kegiatan" accept=".pdf,.doc,.docx" required>
                                <span class="file-help">Format: PDF, DOC, DOCX. Maks. 10MB. (Memuat gambaran umum, nilai investasi, tahapan proyek, dll)</span>
                            </div>
                        @elseif($jenisPermohonan === 'tanah-timbul')
                            <label for="proposal_kegiatan" class="form-label">9. Dokumen Bukti / Alasan Penggunaan Tanah Timbul <span class="req">*</span></label>
                            <div class="file-input-wrapper">
                                <input type="file" id="proposal_kegiatan" name="proposal_kegiatan" accept=".pdf,.doc,.docx" required>
                                <span class="file-help">Format: PDF, DOC, DOCX. Maks. 10MB. (Memuat rencana pemanfaatan untuk pertanian/tambak/rumah tinggal)</span>
                            </div>
                        @else
                            <label for="proposal_kegiatan" class="form-label">9. Proposal Rencana Kegiatan Berusaha <span class="req">*</span> <button type="button" class="btn-contoh" onclick="openPreview('{{ asset('storage/Contoh_Format/10%20Proposal%20Rencana%20Kegiatan%20Berusaha.pdf') }}', 'Contoh Proposal Kegiatan')">Lihat Contoh</button></label>
                            <div class="file-input-wrapper">
                                <input type="file" id="proposal_kegiatan" name="proposal_kegiatan" accept=".pdf,.doc,.docx" required>
                                <span class="file-help">Format: PDF, DOC, DOCX. Maks. 10MB. (Memuat Latar Belakang, Permodalan, Nilai Proyek, dll)</span>
                            </div>
                        @endif
                        @error('proposal_kegiatan')<span class="error-message">{{ $message }}</span>@enderror
                    </div>

                    <!-- 10. Persyaratan Lainnya -->
                    <div class="form-group">
                        <label for="persyaratan_lainnya" class="form-label">10. Persyaratan lainnya yang diperlukan (Sertifikat HAK / Surat Keterangan Tanah / Akta / bukti atau akta pinjam meminjam atau sewa menyewa) (Opsional) <button type="button" class="btn-contoh" onclick="openPreview('{{ asset('storage/Contoh_Format/11%20Sertipikat%20dan%20Bukti%20Penguasaan%20Fisik%20Lainnya.pdf') }}', 'Contoh Sertipikat / Bukti Fisik')">Lihat Contoh</button></label>
                        <div class="file-input-wrapper">
                            <input type="file" id="persyaratan_lainnya" name="persyaratan_lainnya" accept=".pdf,.jpg,.jpeg,.png,.zip,.rar">
                            <span class="file-help">Format: PDF, JPG, PNG, ZIP, RAR. Maks. 10MB.</span>
                        </div>
                        @error('persyaratan_lainnya')<span class="error-message">{{ $message }}</span>@enderror
                    </div>
 
                    <!-- Footer Action Buttons -->
                    <div class="form-footer">
                        <a href="{{ route('tanah-timbul.index') }}" class="btn btn-cancel">Batal</a>
                        <button type="submit" class="btn btn-primary">Kirim Permohonan</button>
                    </div>
 
                </form>
            </div>
 
        </div>
    </main>
 
    <!-- Modal Preview -->
    <div class="modal-backdrop" id="previewBackdrop" onclick="closePreview()"></div>
    <div class="modal-slide" id="previewModal">
        <div class="modal-header">
            <div class="modal-title" id="previewTitle">Contoh Dokumen</div>
            <button class="btn-close" onclick="closePreview()">&times;</button>
        </div>
        <div class="modal-body">
            <div id="mobileFallback" style="padding: 20px; text-align: center; display: none; background: #fff; border-bottom: 1px solid #ddd;">
                <p style="font-size: 13px; color: #555; margin-bottom: 12px;">Tidak dapat memuat PDF di pratinjau?</p>
                <a id="mobileDownloadLink" href="#" target="_blank" style="background: #218AC9; color: #fff; padding: 10px 16px; border-radius: 6px; text-decoration: none; font-size: 13px; font-weight: bold; display: inline-block;">Buka / Unduh Dokumen</a>
            </div>
            <iframe id="previewFrame" src=""></iframe>
        </div>
    </div>

    <script>
        function openPreview(url, title) {
            document.getElementById('previewTitle').innerText = title;
            document.getElementById('previewFrame').src = url;
            const fallbackLink = document.getElementById('mobileDownloadLink');
            if (fallbackLink) fallbackLink.href = url;
            
            const fallbackDiv = document.getElementById('mobileFallback');
            if (fallbackDiv) {
                fallbackDiv.style.display = window.innerWidth <= 768 ? 'block' : 'none';
            }
            document.getElementById('previewBackdrop').classList.add('show');
            document.getElementById('previewModal').classList.add('open');
        }

        function closePreview() {
            document.getElementById('previewBackdrop').classList.remove('show');
            document.getElementById('previewModal').classList.remove('open');
            setTimeout(() => {
                document.getElementById('previewFrame').src = '';
            }, 300);
        }
    </script>
</body>
</html>

