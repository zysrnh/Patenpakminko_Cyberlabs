<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pengajuan Kebijakan Khusus — PATEN PAK MIKO</title>
    
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
 
        /* ─── HEADER ─────────────────────────────────────────── */
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
 
        /* ─── MAIN CONTENT ───────────────────────────────────── */
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
 
        /* ─── FORM ELEMENTS ───────────────────────────────────── */
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
                    <a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a>
                    <a href="{{ route('profile') }}" class="nav-link">Profil Saya</a>
                    
                    <div class="user-nav" style="margin-left: 12px; padding-left: 12px; border-left: 1.5px solid var(--clr-line);">
                        @if(Auth::user()->profile_photo)
                            <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="Foto Profil" class="header-avatar">
                        @else
                            <div class="header-avatar-placeholder">
                                {{ strtoupper(substr(Auth::user()->username, 0, 2)) }}
                            </div>
                        @endif
                        <div class="user-badge">
                            <strong>{{ Auth::user()->name ?? Auth::user()->username }}</strong>
                            <span>{{ Auth::user()->phone_number }}</span>
                        </div>
                    </div>
 
                    <form action="{{ route('logout') }}" method="POST" style="margin-left: 8px;">
                        @csrf
                        <button type="submit" class="btn-logout">
                            <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                            Keluar
                        </button>
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
                    <h2 class="card-title">Permohonan Kebijakan Khusus Baru</h2>
                    <a href="{{ route('kebijakan.index') }}" class="back-link">
                        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        Kembali
                    </a>
                </div>
 
                <form action="{{ route('kebijakan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
 
                    <!-- SECTION 1: DATA IDENTITAS PEMOHON / PENGGUNA LAYANAN -->
                    <div class="form-section-title">1. Identitas Pemohon / Pengguna Layanan</div>
 
                    <!-- Nama Pemilik Usaha -->
                    <div class="form-group">
                        <label for="nama_pemilik_usaha" class="form-label">Nama Pemilik Usaha <span class="req">*</span></label>
                        <input type="text" id="nama_pemilik_usaha" name="nama_pemilik_usaha" class="form-control" placeholder="Masukkan nama pemilik usaha" value="{{ old('nama_pemilik_usaha') }}" required>
                        @error('nama_pemilik_usaha')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
 
                    <div class="form-grid-2">
                        <!-- Nama Pengaju -->
                        <div class="form-group">
                            <label for="nama_pengaju" class="form-label">Nama Pemohon / Pengguna Layanan <span class="req">*</span></label>
                            <input type="text" id="nama_pengaju" name="nama_pengaju" class="form-control" placeholder="Masukkan nama pemohon / pengguna layanan" value="{{ old('nama_pengaju', Auth::user()->name ?? Auth::user()->username) }}" required>
                            @error('nama_pengaju')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
 
                        <!-- Hubungan Pengaju / Sebagai Apa -->
                        <div class="form-group">
                            <label for="hubungan_pengaju" class="form-label">Hubungan Pengaju (Sebagai Apa) <span class="req">*</span></label>
                            <select id="hubungan_pengaju" name="hubungan_pengaju" class="form-control" required style="background: white; -webkit-appearance: listbox;">
                                <option value="" disabled {{ old('hubungan_pengaju') ? '' : 'selected' }}>Pilih Hubungan Pengaju</option>
                                <option value="Pemilik Usaha / Pengguna Layanan" {{ old('hubungan_pengaju') == 'Pemilik Usaha / Pengguna Layanan' ? 'selected' : '' }}>Pemilik Usaha / Pengguna Layanan</option>
                                <option value="Penerima Kuasa" {{ old('hubungan_pengaju') == 'Penerima Kuasa' ? 'selected' : '' }}>Penerima Kuasa</option>
                                <option value="Lainnya" {{ old('hubungan_pengaju') == 'Lainnya' ? 'selected' : '' }}>Instansi / PT / Lainnya (Ketik Manual)</option>
                            </select>
                            
                            <div id="hubungan_pengaju_lainnya_wrapper" style="display: {{ old('hubungan_pengaju') == 'Lainnya' ? 'block' : 'none' }}; margin-top: 8px;">
                                <input type="text" id="hubungan_pengaju_lainnya" name="hubungan_pengaju_lainnya" class="form-control" placeholder="Masukkan hubungan pengaju secara manual (cth: Instansi, PT, Karyawan, dll)" value="{{ old('hubungan_pengaju_lainnya') }}">
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
                        <label for="peta_lokasi" class="form-label">1. Peta/sketsa lokasi yang dimohon <span class="req">*</span></label>
                        <div class="file-input-wrapper">
                            <input type="file" id="peta_lokasi" name="peta_lokasi" accept=".pdf,.jpg,.jpeg,.png" required>
                            <span class="file-help">Format: PDF, JPG, PNG. Maks. 5MB.</span>
                        </div>
                        @error('peta_lokasi')<span class="error-message">{{ $message }}</span>@enderror
                    </div>

                    <!-- 2. Surat Kuasa -->
                    <div class="form-group">
                        <label for="surat_kuasa" class="form-label">2. Surat kuasa <span class="req">*</span></label>
                        <div class="file-input-wrapper">
                            <input type="file" id="surat_kuasa" name="surat_kuasa" accept=".pdf,.jpg,.jpeg,.png" required>
                            <span class="file-help">Format: PDF, JPG, PNG. Maks. 5MB.</span>
                        </div>
                        @error('surat_kuasa')<span class="error-message">{{ $message }}</span>@enderror
                    </div>

                    <!-- 3. FC KTP -->
                    <div class="form-group">
                        <label for="fc_ktp" class="form-label">3. Fotokopi KTP <span class="req">*</span></label>
                        <div class="file-input-wrapper">
                            <input type="file" id="fc_ktp" name="fc_ktp" accept=".pdf,.jpg,.jpeg,.png" required>
                            <span class="file-help">Format: PDF, JPG, PNG. Maks. 5MB.</span>
                        </div>
                        @error('fc_ktp')<span class="error-message">{{ $message }}</span>@enderror
                    </div>

                    <!-- 4. FC NPWP -->
                    <div class="form-group">
                        <label for="fc_npwp" class="form-label">4. Fotokopi NPWP <span class="req">*</span></label>
                        <div class="file-input-wrapper">
                            <input type="file" id="fc_npwp" name="fc_npwp" accept=".pdf,.jpg,.jpeg,.png" required>
                            <span class="file-help">Format: PDF, JPG, PNG. Maks. 5MB.</span>
                        </div>
                        @error('fc_npwp')<span class="error-message">{{ $message }}</span>@enderror
                    </div>

                    <!-- 5. Akta Pendirian -->
                    <div class="form-group">
                        <label for="fc_akta_pendirian" class="form-label">5. Fotokopi Akta Pendirian & Pengesahan Badan Hukum <span class="req">*</span></label>
                        <div class="file-input-wrapper">
                            <input type="file" id="fc_akta_pendirian" name="fc_akta_pendirian" accept=".pdf,.jpg,.jpeg,.png" required>
                            <span class="file-help">Format: PDF, JPG, PNG. Maks. 10MB.</span>
                        </div>
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
                        <label for="nib" class="form-label">7. Nomor Induk Berusaha (NIB) <span class="req">*</span></label>
                        <div class="file-input-wrapper">
                            <input type="file" id="nib" name="nib" accept=".pdf,.jpg,.jpeg,.png" required>
                            <span class="file-help">Format: PDF, JPG, PNG. Maks. 5MB.</span>
                        </div>
                        @error('nib')<span class="error-message">{{ $message }}</span>@enderror
                    </div>

                    <!-- 8. KBLI -->
                    <div class="form-group">
                        <label for="kbli" class="form-label">8. Dokumen KBLI yang diajukan <span class="req">*</span></label>
                        <div class="file-input-wrapper">
                            <input type="file" id="kbli" name="kbli" accept=".pdf,.jpg,.jpeg,.png" required>
                            <span class="file-help">Format: PDF, JPG, PNG. Maks. 5MB.</span>
                        </div>
                        @error('kbli')<span class="error-message">{{ $message }}</span>@enderror
                    </div>

                    <!-- 9. Proposal -->
                    <div class="form-group">
                        <label for="proposal_kegiatan" class="form-label">9. Proposal Rencana Kegiatan Berusaha <span class="req">*</span></label>
                        <div class="file-input-wrapper">
                            <input type="file" id="proposal_kegiatan" name="proposal_kegiatan" accept=".pdf,.doc,.docx" required>
                            <span class="file-help">Format: PDF, DOC, DOCX. Maks. 10MB. (Memuat Latar Belakang, Permodalan, Nilai Proyek, dll)</span>
                        </div>
                        @error('proposal_kegiatan')<span class="error-message">{{ $message }}</span>@enderror
                    </div>

                    <!-- 10. Persyaratan Lainnya -->
                    <div class="form-group">
                        <label for="persyaratan_lainnya" class="form-label">10. Persyaratan lainnya yang diperlukan (Sertifikat HAK / Surat Keterangan Tanah / Akta / bukti atau akta pinjam meminjam atau sewa menyewa) (Opsional)</label>
                        <div class="file-input-wrapper">
                            <input type="file" id="persyaratan_lainnya" name="persyaratan_lainnya" accept=".pdf,.jpg,.jpeg,.png,.zip,.rar">
                            <span class="file-help">Format: PDF, JPG, PNG, ZIP, RAR. Maks. 10MB.</span>
                        </div>
                        @error('persyaratan_lainnya')<span class="error-message">{{ $message }}</span>@enderror
                    </div>
 
                    <!-- Footer Action Buttons -->
                    <div class="form-footer">
                        <a href="{{ route('kebijakan.index') }}" class="btn btn-cancel">Batal</a>
                        <button type="submit" class="btn btn-primary">Kirim Permohonan</button>
                    </div>
 
                </form>
            </div>
 
        </div>
    </main>
 
</body>
</html>
