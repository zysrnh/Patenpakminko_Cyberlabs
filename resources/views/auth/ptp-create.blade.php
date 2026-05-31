<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Permohonan PTP — PATEN PAK MIKO</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --blue:      #218AC9;
            --blue-dk:   #003B64;
            --blue-lt:   #E3F0F9;
            --blue-md:   #B3D4EC;
            --yellow:    #FFCB05;
            --yellow-lt: #FFF8D6;
            --brown:     #D37324;
            --green:     #85C341;
            --green-dk:  #79A73A;
            --green-lt:  #EEF7E2;
            --ink:       #003B64;
            --mid:       #2C5272;
            --muted:     #7A9BB5;
            --line:      #D6E4EF;
            --surface:   #F0F6FB;
            --white:     #FFFFFF;
            --r-sm:      6px;
            --r-md:      10px;
            --r-lg:      16px;
            --shadow:    0 8px 30px rgba(0, 59, 100, 0.08);
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--surface);
            color: var(--ink);
            -webkit-font-smoothing: antialiased;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
        }

        .container {
            max-width: 850px;
            width: 100%;
            background: var(--white);
            border-radius: var(--r-lg);
            box-shadow: var(--shadow);
            border: 1px solid var(--line);
            overflow: hidden;
        }

        .header {
            background: var(--blue-dk);
            color: var(--white);
            padding: 32px 40px;
            text-align: center;
            position: relative;
        }

        .header h1 {
            font-size: 20px;
            font-weight: 800;
            letter-spacing: -0.02em;
            margin-bottom: 6px;
            text-transform: uppercase;
        }

        .header p {
            font-size: 13px;
            color: var(--blue-md);
            font-weight: 500;
        }

        .header-logo {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            margin-bottom: 12px;
        }

        .header-logo img {
            height: 48px;
            width: auto;
        }

        .form-body {
            padding: 40px;
        }

        .target-address {
            background: var(--surface);
            border-left: 4px solid var(--blue);
            padding: 16px 20px;
            border-radius: 0 var(--r-md) var(--r-md) 0;
            margin-bottom: 30px;
            font-size: 14px;
            line-height: 1.6;
            color: var(--mid);
        }

        .target-address strong {
            color: var(--ink);
        }

        .section-title {
            font-size: 15px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--blue-dk);
            border-bottom: 2px solid var(--line);
            padding-bottom: 8px;
            margin-bottom: 20px;
            margin-top: 30px;
        }

        .section-title:first-of-type {
            margin-top: 0;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .full-width {
            grid-column: span 2;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .form-label {
            font-size: 13px;
            font-weight: 700;
            color: var(--ink);
        }

        .form-label span.required {
            color: #DC2626;
        }

        .form-control {
            font-family: inherit;
            font-size: 14px;
            padding: 11px 16px;
            border-radius: var(--r-md);
            border: 1px solid var(--line);
            color: var(--ink);
            background: var(--white);
            outline: none;
            transition: all 0.2s ease;
        }

        .form-control:focus {
            border-color: var(--blue);
            box-shadow: 0 0 0 3px rgba(33, 138, 201, 0.15);
        }

        textarea.form-control {
            min-height: 90px;
            resize: vertical;
        }

        /* Service Cards Choice */
        .service-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 12px;
            margin-top: 8px;
        }

        .service-card {
            border: 1px solid var(--line);
            border-radius: var(--r-md);
            padding: 12px;
            cursor: pointer;
            transition: all 0.2s ease;
            position: relative;
            display: flex;
            flex-direction: column;
            gap: 6px;
            background: var(--white);
        }

        .service-card:hover {
            border-color: var(--blue-md);
            background: var(--surface);
        }

        .service-card.active {
            border-color: var(--blue);
            background: var(--blue-lt);
            box-shadow: 0 0 0 1px var(--blue);
        }

        .service-card input[type="radio"] {
            position: absolute;
            top: 10px;
            right: 10px;
            accent-color: var(--blue);
        }

        .service-card-title {
            font-size: 12.5px;
            font-weight: 800;
            color: var(--ink);
            padding-right: 16px;
            line-height: 1.3;
        }

        .service-card-desc {
            font-size: 10.5px;
            color: var(--muted);
            line-height: 1.3;
        }

        /* Letak Tanah Nested Grid */
        .nested-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr;
            gap: 10px;
        }

        .btn-submit {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: var(--blue);
            color: var(--white);
            font-weight: 700;
            font-size: 15px;
            padding: 14px 28px;
            border-radius: var(--r-md);
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
            gap: 8px;
            margin-top: 30px;
            width: 100%;
        }

        .btn-submit:hover {
            background: #1978B0;
            transform: translateY(-1px);
        }

        .btn-submit svg {
            width: 18px;
            height: 18px;
            fill: none;
            stroke: currentColor;
            stroke-width: 2.5;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 12px;
            color: var(--muted);
        }

        .error-msg {
            color: #DC2626;
            font-size: 11.5px;
            font-weight: 600;
            margin-top: 4px;
        }

        @media (max-width: 768px) {
            .form-grid {
                grid-template-columns: 1fr;
            }
            .full-width {
                grid-column: span 1;
            }
            .service-cards {
                grid-template-columns: 1fr;
            }
            .nested-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
    <!-- Flatpickr CSS CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/material_blue.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/id.js"></script>
</head>
<body>

    <div class="container">
        <div class="header">
            <div class="header-logo">
                <!-- Garuda / Logo Kantor Pertanahan -->
                <svg viewBox="0 0 24 24" width="48" height="48" style="fill: var(--yellow);"><path d="M12 2L2 22h20L12 2zm0 3.8L19.3 19H4.7L12 5.8zM11 10v4h2v-4h-2zm0 6v2h2v-2h-2z"/></svg>
            </div>
            <h1>Permohonan Pertimbangan Teknis Pertanahan</h1>
            <p>Kantor Pertanahan Kota Sukabumi — Layanan Integrasi PATEN PAK MIKO</p>
        </div>

        <div class="form-body">
            
            @php
                $layananActive = old('jenis_permohonan', request('layanan', 'berusaha'));
                $layananName = match($layananActive) {
                    'berusaha' => 'Kegiatan Berusaha (PKKPR)',
                    'non-berusaha' => 'Non-Berusaha (PKKPR)',
                    'kebijakan' => 'Kebijakan Tanah',
                    'psn' => 'Proyek Strategis Nasional (PSN)',
                    'tanah-timbul' => 'Tanah Timbul',
                    default => 'Kegiatan Berusaha (PKKPR)'
                };
            @endphp


            <div style="display: flex; gap: 16px; margin-bottom: 24px; align-items: stretch; flex-wrap: wrap;">
                <div class="target-address" style="flex: 1.2; min-width: 280px; margin-bottom: 0;">
                    Kepada Yh.<br>
                    <strong>Kepala Kantor Pertanahan Kota Sukabumi</strong><br>
                    di tempat.
                </div>
                <div style="flex: 1; min-width: 280px; background: #EBF8FF; border: 1.5px solid #BEE3F8; border-radius: var(--r-md); padding: 14px 20px; display: flex; flex-direction: column; justify-content: center; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); position: relative; overflow: hidden;">
                    <div style="position: absolute; right: -10px; top: -10px; opacity: 0.08; color: #3182CE;">
                        <svg width="80" height="80" fill="currentColor" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    </div>
                    <span style="font-size: 10px; font-weight: 700; color: #4A5568; text-transform: uppercase; letter-spacing: 0.05em; display: block;">Layanan Terpilih:</span>
                    <div style="font-size: 15px; font-weight: 800; color: #2B6CB0; margin-top: 4px; display: flex; align-items: center; gap: 6px;">
                        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        {{ $layananName }}
                    </div>
                    <span style="font-size: 10px; color: #718096; font-weight: 600; margin-top: 4px;">Pendaftaran Calon Pemohon PKKPR</span>
                </div>
            </div>

            @if(session('info'))
                <div style="background: var(--yellow-lt); border-left: 4px solid var(--yellow); padding: 12px 16px; border-radius: var(--r-sm); margin-bottom: 20px; font-size: 13.5px; color: var(--brown); font-weight: 600;">
                    {{ session('info') }}
                </div>
            @endif

            @if($errors->any())
                <div style="background: #FEF2F2; border-left: 4px solid #DC2626; padding: 12px 16px; border-radius: var(--r-sm); margin-bottom: 20px;">
                    <div style="font-size: 13.5px; color: #991B1B; font-weight: 700; margin-bottom: 4px;">Terdapat kesalahan pada isian form:</div>
                    <ul style="font-size: 12.5px; color: #B91C1C; margin-left: 16px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('ptp.store') }}" method="POST">
                @csrf
                <input type="hidden" name="jenis_permohonan" id="jenis_permohonan" value="{{ $layananActive }}">

                <!-- SECTION 1 -->
                <div class="section-title">1. Identitas Pemohon / Calon Pengguna</div>
                
                <div class="form-grid">
                    <div class="form-group full-width">
                        <label for="nama" class="form-label">Nama Lengkap Pemohon <span class="required">*</span></label>
                        <input type="text" id="nama" name="nama" class="form-control" placeholder="Tulis nama lengkap sesuai KTP" value="{{ old('nama') }}" required>
                        @error('nama') <span class="error-msg">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="nik" class="form-label">Nomor Induk Kependudukan (NIK) <span class="required">*</span></label>
                        <input type="text" id="nik" name="nik" class="form-control" placeholder="16 Digit NIK KTP" minlength="16" maxlength="16" value="{{ old('nik') }}" required>
                        @error('nik') <span class="error-msg">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="nib" class="form-label">Nomor Induk Berusaha (NIB)</label>
                        <input type="text" id="nib" name="nib" class="form-control" placeholder="13 Digit NIB (Khusus Pelaku Usaha)" value="{{ old('nib') }}">
                        @error('nib') <span class="error-msg">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="phone_number" class="form-label">Nomor WhatsApp Aktif <span class="required">*</span></label>
                        <input type="text" id="phone_number" name="phone_number" class="form-control" placeholder="Contoh: 0812XXXXXXXX" value="{{ old('phone_number') }}" required>
                        <span style="font-size: 11px; color: var(--muted);">Digunakan untuk menerima Blast WhatsApp Kredensial Login & Status.</span>
                        @error('phone_number') <span class="error-msg">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group full-width">
                        <label for="alamat" class="form-label">Alamat Pemohon Lengkap <span class="required">*</span></label>
                        <textarea id="alamat" name="alamat" class="form-control" placeholder="Tulis alamat rumah lengkap sesuai KTP" required>{{ old('alamat') }}</textarea>
                        @error('alamat') <span class="error-msg">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- SECTION 2 -->
                <div class="section-title">2. Keterangan Kuasa & Anggaran Dasar</div>
                
                <div class="form-grid">
                    <div class="form-group">
                        <label for="bertindak_atas_nama" class="form-label">Bertindak Untuk dan Atas Nama <span class="required">*</span></label>
                        <select id="bertindak_atas_nama" name="bertindak_atas_nama" class="form-control" required>
                            <option value="Diri Sendiri" {{ old('bertindak_atas_nama') === 'Diri Sendiri' ? 'selected' : '' }}>Diri Sendiri</option>
                            <option value="Penerima Kuasa" {{ old('bertindak_atas_nama') === 'Penerima Kuasa' ? 'selected' : '' }}>Penerima Kuasa</option>
                            <option value="PT / Badan Usaha" {{ old('bertindak_atas_nama') === 'PT / Badan Usaha' ? 'selected' : '' }}>PT / Badan Usaha</option>
                            <option value="Instansi Pemerintah" {{ old('bertindak_atas_nama') === 'Instansi Pemerintah' ? 'selected' : '' }}>Instansi Pemerintah</option>
                        </select>
                        @error('bertindak_atas_nama') <span class="error-msg">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="anggaran_dasar_no" class="form-label">Anggaran Dasar Perusahaan (No)</label>
                        <input type="text" id="anggaran_dasar_no" name="anggaran_dasar_no" class="form-control" placeholder="Nomor AD/ART (Khusus PT/CV)" value="{{ old('anggaran_dasar_no') }}">
                        @error('anggaran_dasar_no') <span class="error-msg">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="anggaran_dasar_tanggal" class="form-label">Tanggal Anggaran Dasar</label>
                        <input type="date" id="anggaran_dasar_tanggal" name="anggaran_dasar_tanggal" class="form-control" value="{{ old('anggaran_dasar_tanggal') }}">
                        @error('anggaran_dasar_tanggal') <span class="error-msg">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- SECTION 3 -->
                <div class="section-title">3. Detail Tanah yang Dimohon</div>

                <div class="form-grid">
                    <div class="form-group full-width">
                        <label for="rencana_kegiatan" class="form-label">Rencana Kegiatan / Penggunaan & Pemanfaatan Tanah <span class="required">*</span></label>
                        <input type="text" id="rencana_kegiatan" name="rencana_kegiatan" class="form-control" placeholder="Contoh: Pembangunan Perumahan, Ruko, dll" value="{{ old('rencana_kegiatan') }}" required>
                        @error('rencana_kegiatan') <span class="error-msg">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="kbli" class="form-label">Kode & Nama KBLI</label>
                        <input type="text" id="kbli" name="kbli" class="form-control" placeholder="Contoh: 68111 - Real Estat" value="{{ old('kbli') }}">
                        @error('kbli') <span class="error-msg">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="luas_tanah" class="form-label">Luas Tanah yang Dimohon (m²) <span class="required">*</span></label>
                        <input type="number" id="luas_tanah" name="luas_tanah" class="form-control" placeholder="Luas tanah dalam satuan meter persegi" value="{{ old('luas_tanah') }}" required>
                        @error('luas_tanah') <span class="error-msg">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group full-width">
                        <label class="form-label">Letak Tanah yang Dimohon <span class="required">*</span></label>
                        <div class="nested-grid">
                            <input type="text" name="letak_tanah_jalan" class="form-control" placeholder="Jalan, Nomor, RT / RW" value="{{ old('letak_tanah_jalan') }}" required>
                            <input type="text" name="letak_tanah_kelurahan" class="form-control" placeholder="Kelurahan" value="{{ old('letak_tanah_kelurahan') }}" required>
                            <input type="text" name="letak_tanah_kecamatan" class="form-control" placeholder="Kecamatan" value="{{ old('letak_tanah_kecamatan') }}" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="status_penguasaan" class="form-label">Status Penguasaan / Penguasaan Tanah <span class="required">*</span></label>
                        <input type="text" id="status_penguasaan" name="status_penguasaan" class="form-control" placeholder="Contoh: Milik Sendiri, Sewa, Pinjam Pakai" value="{{ old('status_penguasaan') }}" required>
                        @error('status_penguasaan') <span class="error-msg">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="penggunaan_saat_ini" class="form-label">Penggunaan Tanah Saat Ini <span class="required">*</span></label>
                        <input type="text" id="penggunaan_saat_ini" name="penggunaan_saat_ini" class="form-control" placeholder="Contoh: Tanah Kosong, Sawah, Kebun" value="{{ old('penggunaan_saat_ini') }}" required>
                        @error('penggunaan_saat_ini') <span class="error-msg">{{ $message }}</span> @enderror
                    </div>
                </div>

                <button type="submit" class="btn-submit">
                    Simpan & Lanjutkan Unggah Dokumen
                    <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </button>

            </form>
        </div>
    </div>

    <div class="footer">
        &copy; 2026 PATEN PAK MIKO · Kantor Pertanahan Kota Sukabumi. All Rights Reserved.
    </div>

    <script>
        // Enforce DD-MM-YYYY via Flatpickr
        flatpickr('#anggaran_dasar_tanggal', {
            dateFormat: "Y-m-d",
            altInput: true,
            altFormat: "d-m-Y",
            locale: "id",
            allowInput: true
        });
    </script>
</body>
</html>
