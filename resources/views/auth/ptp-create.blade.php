@extends('layouts.public')

@section('title', 'Formulir Permohonan PTP — PATEN PAK MIKO')

@section('content')
<!-- Flatpickr CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<style>
    body { background-color: #F0F6FB; }
    
    .ptp-wrapper {
        padding: 60px 20px;
        display: flex;
        justify-content: center;
        margin-bottom: 60px;
    }

    .ptp-container {
        width: 100%;
        max-width: 1140px;
        background: #FFFFFF;
        border-radius: 8px;
        padding: 50px 60px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.04);
    }

    .ptp-header-top {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 50px;
    }

    .ptp-layanan-label {
        font-size: 11px;
        font-weight: 700;
        color: #7A9BB5;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        margin-bottom: 14px;
    }

    .ptp-badge {
        display: flex;
        align-items: center;
        gap: 24px;
        background: #F0F6FB;
        border: 1.5px solid #D6EAF5;
        border-radius: 12px;
        padding: 20px 28px;
    }

    .ptp-logo-circle {
        width: 96px;
        height: 96px;
        border-radius: 50%;
        background: #FFFFFF;
        border: 2px solid #D6EAF5;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        box-shadow: 0 4px 16px rgba(50,145,168,0.12);
        overflow: hidden;
    }

    .ptp-logo-circle img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        transform: scale(1.9); /* Zoom in to ignore the image's huge transparent padding */
    }

    .ptp-badge-text {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .ptp-badge-tag {
        font-size: 11px;
        font-weight: 700;
        color: #3291A8;
        text-transform: uppercase;
        letter-spacing: 0.07em;
    }

    .ptp-badge-name {
        font-size: 21px;
        font-weight: 800;
        color: #1E1E2F;
        letter-spacing: -0.02em;
        line-height: 1.2;
    }

    .btn-kembali {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 24px;
        background: #00223D;
        color: #FFFFFF;
        text-decoration: none;
        border-radius: 6px;
        font-size: 13.5px;
        font-weight: 600;
        transition: background .2s;
        white-space: nowrap;
        margin-top: 4px;
    }
    .btn-kembali:hover { background: #001526; color: #fff; }

    .ptp-section-title {
        font-size: 16.5px;
        font-weight: 800;
        color: #00223D;
        margin-bottom: 24px;
        text-transform: uppercase;
        letter-spacing: 0.03em;
    }

    .ptp-divider {
        border-top: 2px dashed #E2E8F0;
        margin: 40px 0;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 24px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }
    .form-group.full { grid-column: span 2; }

    .form-label {
        font-size: 13.5px;
        font-weight: 700;
        color: #0A1C2C;
    }
    .form-label span.required { color: #DC2626; margin-left: 4px; }
    .form-label span.optional { font-weight: 500; color: #7A9BB5; margin-left: 4px; font-size: 12px; }

    .form-control {
        padding: 16px 20px;
        background: #F4F7FA;
        border: 1px solid #E2E8F0;
        border-radius: 6px;
        font-family: inherit;
        font-size: 14px;
        color: #0A1C2C;
        outline: none;
        transition: border .2s, background .2s;
        font-weight: 500;
        width: 100%;
    }
    .form-control:focus { border-color: #3291A8; background: #FFF; }
    textarea.form-control { min-height: 120px; resize: vertical; line-height: 1.6; }

    /* Native select styling fallback */
    select.form-control {
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%233291A8' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 16px center;
        background-size: 18px;
        padding-right: 44px;
    }

    /* Tom Select Custom Overrides */
    .ts-wrapper.form-control {
        padding: 0 !important;
        border: none !important;
        background: transparent !important;
        box-shadow: none !important;
        height: auto !important;
    }
    .ts-wrapper { width: 100%; }
    .ts-control {
        padding: 14px 20px;
        background: #F4F7FA;
        border: 1px solid #E2E8F0;
        border-radius: 6px;
        font-family: inherit;
        font-size: 14px;
        color: #0A1C2C;
        box-shadow: none;
        min-height: 52px;
        display: flex;
        align-items: center;
        position: relative;
    }
    .ts-control.focus { border-color: #3291A8; background: #FFF; box-shadow: none; }
    .ts-control input { font-size: 14px; }
    .ts-dropdown {
        border-radius: 6px;
        border: 1px solid #E2E8F0;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        margin-top: 6px;
        border-top: none;
    }
    .ts-dropdown .option {
        padding: 14px 20px;
        font-size: 14px;
        font-weight: 500;
        transition: background 0.1s;
    }
    .ts-dropdown .active {
        background-color: #F0F6FB !important;
        color: #0A1C2C !important;
    }
    .ts-wrapper.single .ts-control:after {
        border: none;
        content: "";
        width: 18px;
        height: 18px;
        background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%233291A8' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
        background-size: contain;
        background-repeat: no-repeat;
        position: absolute;
        top: 50%;
        right: 16px;
        transform: translateY(-50%);
        margin-top: 0;
        transition: transform 0.2s;
    }
    .ts-wrapper.single.dropdown-active .ts-control:after {
        transform: translateY(-50%) rotate(180deg);
    }
    
    .ts-dropdown .dropdown-input-wrap {
        padding: 10px 12px;
        border-bottom: 1px solid #E2E8F0;
    }
    .ts-dropdown .dropdown-input {
        border: 1px solid #E2E8F0 !important;
        border-radius: 6px;
        padding: 10px 14px;
        font-size: 14px;
        outline: none !important;
        box-shadow: none !important;
        width: 100%;
        font-family: inherit;
        background: #F4F7FA;
        color: #0A1C2C;
        transition: border 0.2s, background 0.2s;
    }
    .ts-dropdown .dropdown-input:focus {
        border-color: #3291A8 !important;
        background: #FFF;
    }
    .ts-dropdown .dropdown-input::placeholder {
        color: #94A3B8;
    }

    .nested-grid {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr;
        gap: 16px;
    }

    /* KBLI Dropdown Styles */
    .kbli-wrapper { position: relative; }
    .kbli-dropdown {
        position: absolute; top: 100%; left: 0; right: 0;
        background: #fff; border: 1px solid #E2E8F0;
        border-radius: 6px; box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        max-height: 250px; overflow-y: auto; z-index: 1000;
        display: none; margin-top: 8px; padding: 8px;
    }
    .kbli-dropdown.show { display: block; }
    .kbli-item {
        padding: 12px 16px; cursor: pointer; border-radius: 4px;
        font-size: 13.5px; transition: background 0.2s; margin-bottom: 4px;
    }
    .kbli-item:last-child { margin-bottom: 0; }
    .kbli-item:hover, .kbli-item.active { background: #F0F6FB; color: #0A1C2C; }
    .kbli-item strong { color: #3291A8; margin-right: 6px; }
    .kbli-item strong { color: #3291A8; margin-right: 6px; }

    .btn-submit-wrap {
        display: flex;
        justify-content: flex-end;
        gap: 16px;
        margin-top: 50px;
    }
    .btn-batal {
        padding: 16px 36px;
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        color: #555;
        font-weight: 600;
        border-radius: 6px;
        cursor: pointer;
        font-size: 14px;
        transition: background .2s;
    }
    .btn-batal:hover { background: #F4F7FA; }
    .btn-submit {
        padding: 16px 36px;
        background: #00223D;
        color: #FFFFFF;
        border: none;
        font-weight: 600;
        border-radius: 6px;
        cursor: pointer;
        font-size: 14px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: background .2s;
    }
    .btn-submit:hover { background: #001526; }

    /* Alert & Info */
    .alert {
        padding: 16px 20px;
        border-radius: 6px;
        font-size: 14px;
        font-weight: 500;
        margin-bottom: 30px;
        display: flex;
        gap: 12px;
    }
    .alert-error { background: #FCE8E6; border: 1px solid #F8B4B4; color: #C5221F; }
    .alert-info { background: #FFF8D6; border-left: 4px solid #FFCB05; color: #D37324; font-weight: 600; }

    @media (max-width: 992px) {
        .form-grid { grid-template-columns: 1fr; gap: 20px; }
        .form-group.full { grid-column: span 1; }
        .nested-grid { grid-template-columns: 1fr; gap: 16px; }
        .ptp-container { padding: 30px 20px; }
        .ptp-header { flex-direction: column; gap: 20px; align-items: flex-start; }
        .ptp-badge-name { font-size: 17px; }
    }

    @media (max-width: 768px) {
        .ptp-header-top {
            flex-direction: column;
            gap: 20px;
        }
        .ptp-badge {
            gap: 16px;
            padding: 16px 20px;
            width: 100%;
        }
        .ptp-logo-circle {
            width: 70px;
            height: 70px;
        }
        .ptp-logo-circle img {
            width: 58px;
            height: 58px;
        }
        .ptp-badge-name { font-size: 16px; }
        .btn-kembali { margin-top: 0; align-self: flex-start; }
        .btn-submit-wrap {
            flex-direction: column-reverse;
            gap: 12px;
            margin-top: 40px;
        }
        .btn-submit-wrap button {
            width: 100%;
            justify-content: center;
        }
        .form-group { gap: 8px; }
    }
</style>

@php
    $layananActive = old('jenis_permohonan', request('layanan', 'berusaha'));
    $layananName = match($layananActive) {
        'berusaha' => 'Pertimbangan Teknis Pertanahan PKKPR Berusaha',
        'non-berusaha' => 'Pertimbangan Teknis Pertanahan PKKPR Non Berusaha',
        'kebijakan' => 'Pertimbangan Teknis Pertanahan Kebijakan',
        'psn' => 'Pertimbangan Teknis Pertanahan Proyek Strategis Nasional (PSN)',
        'tanah-timbul' => 'Pertimbangan Teknis Pertanahan Tanah Timbul',
        default => 'Pertimbangan Teknis Pertanahan PKKPR Berusaha'
    };

    $layananLogo = match($layananActive) {
        'berusaha' => 'PKKPR.png',
        'non-berusaha' => 'PKKPRNon.png',
        'kebijakan' => 'Kebijakan.png',
        default => 'PKKPR.png'
    };
@endphp

<div class="ptp-wrapper">
    <div class="ptp-container">

        <!-- Header Actions -->
        <div class="ptp-header-top">
            <div>
                <div class="ptp-layanan-label">Layanan Yang Dipilih:</div>
                <div class="ptp-badge">
                    <div class="ptp-logo-circle">
                        <img src="{{ asset('storage/logo/' . $layananLogo) }}" alt="Logo {{ $layananActive }}">
                    </div>
                    <div class="ptp-badge-text">
                        <span class="ptp-badge-name">{{ $layananName }}</span>
                    </div>
                </div>
            </div>
            <a href="/" class="btn-kembali">&larr; Kembali</a>
        </div>

        <!-- Banner Unduh Template Dokumen PTP -->
        <div style="background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%); border: 1.5px solid #bae6fd; border-radius: 12px; padding: 16px 20px; margin-bottom: 24px; display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 16px;">
            <div style="display: flex; align-items: center; gap: 12px;">
                <div style="width: 40px; height: 40px; border-radius: 10px; background: #0284c7; color: white; display: flex; align-items: center; justify-content: center; flex-shrink: 0; box-shadow: 0 4px 10px rgba(2, 132, 199, 0.25);">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6z"/><path d="M14 2v6h6"/><path d="M16 13H8"/><path d="M16 17H8"/><path d="M10 9H8"/></svg>
                </div>
                <div>
                    <h4 style="margin: 0 0 2px 0; font-size: 15px; font-weight: 700; color: #0369a1;">Unduh Template</h4>
                    <p style="margin: 0; font-size: 12px; color: #0284c7;">Unduh template fisik Formulir Pertimbangan Teknis Pertanahan (.docx)</p>
                </div>
            </div>
            <a href="{{ route('public.template.download', 'pertek_2026') }}" class="btn-download-template" style="background: #0284c7; color: white; padding: 9px 18px; border-radius: 8px; font-weight: 700; font-size: 13px; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; box-shadow: 0 4px 12px rgba(2, 132, 199, 0.2); transition: all 0.2s ease;">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                Unduh Template
            </a>
        </div>

        <!-- Alerts -->
        @if(session('info'))
            <div class="alert alert-info">{{ session('info') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-error">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="24" height="24" style="flex-shrink:0;"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                <div>
                    <div style="font-weight: 700; margin-bottom: 6px;">Terdapat kesalahan pada isian form:</div>
                    <ul style="margin-left: 16px; font-size: 13px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <form action="{{ route('ptp.store') }}" method="POST">
            @csrf
            <input type="hidden" name="jenis_permohonan" id="jenis_permohonan" value="{{ $layananActive }}">

            <!-- SECTION 1 -->
            <div class="ptp-section-title">1. IDENTITAS PEMOHON / PENGGUNA LAYANAN</div>
            
            <div class="form-grid">
                <div class="form-group full">
                    <label class="form-label">Nama Lengkap Pemohon<span class="required">*</span></label>
                    <input type="text" name="nama" class="form-control" placeholder="Tulis nama lengkap sesuai KTP" value="{{ old('nama') }}" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Nomor Induk Kependudukan (NIK)<span class="required">*</span></label>
                    <input type="text" name="nik" class="form-control" placeholder="16 Digit NIK KTP" minlength="16" maxlength="16" value="{{ old('nik') }}" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Nomor Induk Berusaha (NIB)<span class="optional">(Opsional)</span></label>
                    <input type="text" name="nib" class="form-control" placeholder="13 Digit NIB (Kosongkan jika tidak ada)" maxlength="13" value="{{ old('nib') }}" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                </div>

                <div class="form-group">
                    <label class="form-label">Nomor WhatsApp Aktif<span class="required">*</span></label>
                    <input type="text" name="phone_number" class="form-control" placeholder="Contoh: 0812XXXXXXXX" value="{{ old('phone_number') }}" required>
                </div>

                <div class="form-group full">
                    <label class="form-label">Alamat Pemohon Lengkap<span class="required">*</span></label>
                    <textarea name="alamat" class="form-control" placeholder="Tulis alamat rumah lengkap sesuai KTP" required>{{ old('alamat') }}</textarea>
                </div>
            </div>

            <div class="ptp-divider"></div>

            <!-- SECTION 2 -->
            <div class="ptp-section-title">2. KETERANGAN KUASA & ANGGARAN DASAR</div>
            
            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">Hubungan Pengaju (Bertindak Sebagai)<span class="required">*</span></label>
                    <select id="bertindak_atas_nama" name="bertindak_atas_nama" class="form-control" required placeholder="Pilih Hubungan Pengaju">
                        <option value=""></option>
                        <option value="Diri Sendiri" {{ old('bertindak_atas_nama') === 'Diri Sendiri' ? 'selected' : '' }}>Diri Sendiri / Pemilik Usaha</option>
                        <option value="Penerima Kuasa" {{ old('bertindak_atas_nama') === 'Penerima Kuasa' ? 'selected' : '' }}>Penerima Kuasa</option>
                        <option value="Badan Hukum" {{ old('bertindak_atas_nama') === 'Badan Hukum' ? 'selected' : '' }}>Badan Hukum</option>
                        <option value="Instansi Pemerintahan" {{ old('bertindak_atas_nama') === 'Instansi Pemerintahan' ? 'selected' : '' }}>Instansi Pemerintahan</option>
                    </select>
                </div>

                <div class="form-group" id="group_nama_instansi" style="display: none;">
                    <label class="form-label">Nama Instansi<span class="required">*</span></label>
                    <input type="text" id="nama_instansi" name="nama_instansi" class="form-control" placeholder="Tulis Nama Instansi" value="{{ old('nama_instansi') }}">
                </div>

                <div class="form-group" id="group_nama_pemberi_kuasa" style="display: none;">
                    <label class="form-label">Nama Pemberi Kuasa<span class="required">*</span></label>
                    <input type="text" id="nama_pemberi_kuasa" name="nama_pemberi_kuasa" class="form-control" placeholder="Tulis Nama Pemberi Kuasa / Pemilik Usaha" value="{{ old('nama_pemberi_kuasa') }}">
                </div>

                <div class="form-group">
                    <label class="form-label">Nomor Anggaran Dasar Perusahaan<span class="optional">(Opsional)</span></label>
                    <input type="text" id="anggaran_dasar_no" name="anggaran_dasar_no" class="form-control" placeholder="Nomor AD/ART (Khusus PT/CV)" value="{{ old('anggaran_dasar_no') }}">
                </div>

                <div class="form-group">
                    <label class="form-label">Tanggal Anggaran Dasar<span class="optional">(Opsional)</span></label>
                    <input type="date" id="anggaran_dasar_tanggal" name="anggaran_dasar_tanggal" class="form-control bg-white" placeholder="Pilih Tanggal" value="{{ old('anggaran_dasar_tanggal') }}">
                </div>
            </div>

            <div class="ptp-divider"></div>

            <!-- SECTION 3 -->
            <div class="ptp-section-title">3. DETAIL TANAH YANG DIMOHON</div>

            <div class="form-grid">
                <div class="form-group full">
                    <label class="form-label">Rencana Penggunaan & Pemanfaatan Tanah<span class="required">*</span></label>
                    <input type="text" name="rencana_kegiatan" class="form-control" placeholder="Contoh: Pembangunan Perumahan, Ruko, Pabrik, dll" value="{{ old('rencana_kegiatan') }}" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Kode & Nama KBLI<span class="required" id="kbli-required" style="display: none;">*</span></label>
                    <div class="kbli-wrapper">
                        <input type="text" id="kbli" name="kbli" class="form-control" placeholder="Ketik kode KBLI atau nama kegiatan..." value="{{ old('kbli') }}" autocomplete="off">
                        <div class="kbli-dropdown" id="kbliDropdown"></div>
                    </div>
                    <div id="kbliSelectedInfo" style="display:none; margin-top: 10px;"></div>
                </div>

                <div class="form-group">
                    <label class="form-label">Luas Tanah yang Dimohon (m²)<span class="required">*</span></label>
                    <input type="number" name="luas_tanah" class="form-control" placeholder="Luas dalam meter persegi" value="{{ old('luas_tanah') }}" required>
                </div>

                <div class="form-group full">
                    <label class="form-label">Letak Tanah yang Dimohon<span class="required">*</span></label>
                    <div class="nested-grid">
                        <input type="text" name="letak_tanah_jalan" class="form-control" placeholder="Jalan, Nomor, RT / RW" value="{{ old('letak_tanah_jalan') }}" required>
                        <input type="text" name="letak_tanah_kelurahan" class="form-control" placeholder="Kelurahan" value="{{ old('letak_tanah_kelurahan') }}" required>
                        <input type="text" name="letak_tanah_kecamatan" class="form-control" placeholder="Kecamatan" value="{{ old('letak_tanah_kecamatan') }}" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Status Penguasaan Tanah<span class="required">*</span></label>
                    <input type="text" name="status_penguasaan" class="form-control" placeholder="Contoh: Milik Sendiri, Sewa, Pinjam Pakai" value="{{ old('status_penguasaan') }}" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Penggunaan Tanah Saat Ini<span class="required">*</span></label>
                    <input type="text" name="penggunaan_saat_ini" class="form-control" placeholder="Contoh: Tanah Kosong, Sawah, Kebun" value="{{ old('penggunaan_saat_ini') }}" required>
                </div>
            </div>

            <!-- ACTIONS -->
            <div class="btn-submit-wrap">
                <button type="button" class="btn-batal" onclick="window.history.back()">Batal</button>
                <button type="submit" class="btn-submit">
                    Simpan & Lanjutkan
                    <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M12 5l7 7-7 7"/></svg>
                </button>
            </div>

        </form>
    </div>
</div>

<style>
    .help-banner-wrapper {
        background: #EAF3FA;
        padding: 60px 20px;
        display: flex;
        justify-content: center;
        width: 100%;
        margin-top: 20px;
    }
    .help-banner {
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 100%;
        max-width: 1140px;
        gap: 60px;
    }
    .help-banner-img {
        flex: 1;
        display: flex;
        justify-content: flex-end;
    }
    .help-banner-img img {
        width: 100%;
        max-width: 480px;
        height: auto;
    }
    .help-banner-content {
        flex: 1;
    }
    .help-banner-content h2 {
        font-size: 38px;
        font-weight: 800;
        color: #0A1C2C;
        margin-bottom: 16px;
        line-height: 1.2;
    }
    .help-banner-content h2 span {
        color: #F59E0B;
    }
    .help-banner-content p {
        font-size: 16px;
        color: #0A1C2C;
        margin-bottom: 30px;
        line-height: 1.6;
        font-weight: 500;
        max-width: 80%;
    }
    .btn-hubungi {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: #00223D;
        color: #FFFFFF;
        padding: 14px 28px;
        border-radius: 6px;
        font-weight: 700;
        text-decoration: none;
        font-size: 14px;
        transition: background .2s;
    }
    .btn-hubungi:hover { background: #001526; color: #fff; }
    @media (max-width: 992px) {
        .help-banner {
            flex-direction: column;
            text-align: center;
            gap: 40px;
        }
        .help-banner-img {
            justify-content: center;
        }
        .help-banner-img img { max-width: 320px; }
        .help-banner-content {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .help-banner-content p { max-width: 100%; }
        .help-banner-content h2 { font-size: 32px; }
    }
</style>

<div class="help-banner-wrapper">
    <div class="help-banner">
        <div class="help-banner-img">
            <img src="{{ asset('storage/svg/tandatanya.svg') }}" alt="Ilustrasi Bantuan">
        </div>
        <div class="help-banner-content">
            <h2>Butuh <span>Bantuan</span><br>Pengajuan Dokumen?</h2>
            <p>Tim PATEN PAK MIKO siap membantu proses pelayanan pertanahan Anda.</p>
            <a href="https://wa.me/6281200000000" target="_blank" class="btn-hubungi">
                Hubungi Admin 
                <svg width="18" height="18" fill="none" stroke="#F59E0B" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
            </a>
        </div>
    </div>
</div>

<!-- Scripts -->
<link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/id.js"></script>
<script>
    // Initialize Tom Select
    let tsBertindak = new TomSelect('#bertindak_atas_nama', {
        create: false,
        placeholder: "Pilih Hubungan Pengaju...",
        allowEmptyOption: true,
        plugins: ['dropdown_input'],
        onChange: function(value) {
            // Optional: Interactivity based on selection
            // Example: show/hide Anggaran Dasar if PT / Badan Usaha
            const ptGroup1 = document.getElementById('anggaran_dasar_no').closest('.form-group');
            const ptGroup2 = document.getElementById('anggaran_dasar_tanggal').closest('.form-group');
            const instansiGroup = document.getElementById('group_nama_instansi');
            const instansiInput = document.getElementById('nama_instansi');
            const pemberiKuasaGroup = document.getElementById('group_nama_pemberi_kuasa');
            const pemberiKuasaInput = document.getElementById('nama_pemberi_kuasa');
            
            if (value === 'Badan Hukum') {
                ptGroup1.style.display = 'flex';
                ptGroup2.style.display = 'flex';
                instansiGroup.style.display = 'none';
                instansiInput.required = false;
                pemberiKuasaGroup.style.display = 'none';
                pemberiKuasaInput.required = false;
            } else if (value === 'Instansi Pemerintahan') {
                ptGroup1.style.display = 'none';
                ptGroup2.style.display = 'none';
                document.getElementById('anggaran_dasar_no').value = '';
                document.getElementById('anggaran_dasar_tanggal').value = '';
                instansiGroup.style.display = 'flex';
                instansiInput.required = true;
                pemberiKuasaGroup.style.display = 'none';
                pemberiKuasaInput.required = false;
            } else if (value === 'Penerima Kuasa') {
                ptGroup1.style.display = 'none';
                ptGroup2.style.display = 'none';
                document.getElementById('anggaran_dasar_no').value = '';
                document.getElementById('anggaran_dasar_tanggal').value = '';
                instansiGroup.style.display = 'none';
                instansiInput.required = false;
                pemberiKuasaGroup.style.display = 'flex';
                pemberiKuasaInput.required = true;
            } else {
                ptGroup1.style.display = 'none';
                ptGroup2.style.display = 'none';
                document.getElementById('anggaran_dasar_no').value = '';
                document.getElementById('anggaran_dasar_tanggal').value = '';
                instansiGroup.style.display = 'none';
                instansiInput.required = false;
                pemberiKuasaGroup.style.display = 'none';
                pemberiKuasaInput.required = false;
            }
        }
    });

    // Trigger initial state
    tsBertindak.trigger('change', tsBertindak.getValue());
    flatpickr('#anggaran_dasar_tanggal', {
        dateFormat: "Y-m-d",
        altInput: true,
        altFormat: "d F Y",
        locale: "id",
        allowInput: true
    });

    document.addEventListener("DOMContentLoaded", function() {
        const kbliInput = document.getElementById('kbli');
        const kbliRequired = document.getElementById('kbli-required');
        const jenisPermohonan = document.getElementById('jenis_permohonan').value;
        const dropdown = document.getElementById('kbliDropdown');
        const infoBox = document.getElementById('kbliSelectedInfo');
        let debounceTimer;

        if (jenisPermohonan === 'berusaha') {
            kbliInput.required = true;
            if (kbliRequired) kbliRequired.style.display = 'inline';
        }

        // Initialize view if old data exists
        if (kbliInput.value) {
            const val = kbliInput.value.trim();
            const codeMatch = val.match(/^(\d{4,5})/);
            if (codeMatch) {
                const code = codeMatch[1];
                const titleMatch = val.match(/-\s*(.+)/);
                const title = titleMatch ? titleMatch[1] : '';
                infoBox.style.display = 'block';
                infoBox.innerHTML = `
                <div style="display: flex; align-items: flex-start; gap: 10px; background: #F0F6FB; border: 1px solid #D6E4EF; padding: 12px 16px; border-radius: 6px;">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#85C341" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0;">
                        <path d="M20 6L9 17l-5-5"/>
                    </svg>
                    <div style="font-size: 13.5px; color: #0A1C2C; font-weight: 500;">
                        <strong style="color: #3291A8;">${code}</strong> &mdash; ${title}
                    </div>
                </div>`;
            }
        }

        kbliInput.addEventListener('input', function() {
            clearTimeout(debounceTimer);
            const q = this.value.trim();
            infoBox.style.display = 'none';

            if (q.length < 2) {
                dropdown.classList.remove('show');
                return;
            }

            debounceTimer = setTimeout(() => {
                fetch(`/api/kbli/search?q=${encodeURIComponent(q)}`)
                    .then(res => res.json())
                    .then(data => {
                        dropdown.innerHTML = '';
                        if (data.length === 0) {
                            dropdown.innerHTML = '<div style="padding:12px 16px; color:#7A9BB5; font-size:13.5px;">KBLI tidak ditemukan.</div>';
                            dropdown.classList.add('show');
                            return;
                        }
                        data.forEach(item => {
                            const div = document.createElement('div');
                            div.className = 'kbli-item';
                            div.innerHTML = `<strong>${item.code}</strong> &mdash; ${item.title}`;
                            div.addEventListener('click', () => {
                                kbliInput.value = `${item.code} - ${item.title}`;
                                dropdown.classList.remove('show');
                                
                                infoBox.style.display = 'block';
                                infoBox.innerHTML = `
                                <div style="display: flex; align-items: flex-start; gap: 10px; background: #F0F6FB; border: 1px solid #D6E4EF; padding: 12px 16px; border-radius: 6px;">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#85C341" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0;">
                                        <path d="M20 6L9 17l-5-5"/>
                                    </svg>
                                    <div style="font-size: 13.5px; color: #0A1C2C; font-weight: 500;">
                                        <strong style="color: #3291A8;">${item.code}</strong> &mdash; ${item.title}
                                    </div>
                                </div>`;
                            });
                            dropdown.appendChild(div);
                        });
                        dropdown.classList.add('show');
                    })
                    .catch(err => {
                        console.error('KBLI Fetch Error:', err);
                        dropdown.classList.remove('show');
                    });
            }, 300);
        });

        document.addEventListener('click', function(e) {
            if (!kbliInput.contains(e.target) && !dropdown.contains(e.target)) {
                dropdown.classList.remove('show');
            }
        });
    });
</script>
@endsection
 
