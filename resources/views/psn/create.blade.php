@extends('layouts.public')

@section('title', 'Form Pengajuan PKKPR PSN (Proyek Strategis Nasional) — PATEN PAK MIKO')

@section('content')
<link rel="stylesheet" href="{{ asset('css/ptp-form.css') }}">

<div class="ptp-wrapper">
    <div class="ptp-container">
        
        <div class="ptp-header-top">
            <div class="ptp-badge">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0;">
                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                    <line x1="16" y1="2" x2="16" y2="6"></line>
                    <line x1="8" y1="2" x2="8" y2="6"></line>
                    <line x1="3" y1="10" x2="21" y2="10"></line>
                </svg>
                <span class="ptp-badge-name">Pertimbangan Teknis Pertanahan PSN</span>
            </div>
            <a href="{{ route('psn.index') }}" class="btn-kembali">&larr; Kembali</a>
        </div>

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

        <form action="{{ route('psn.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- SECTION 1 -->
            <div class="ptp-section-title">1. IDENTITAS PEMOHON / PENGGUNA LAYANAN</div>
            
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

            <div class="form-grid">
                <!-- Nama Pemilik Usaha / Perusahaan -->
                <div class="form-group">
                    <label class="form-label">Nama Pemohon / Pengguna Layanan<span class="required">*</span></label>
                    <input type="text" id="nama_pemilik_usaha" name="nama_pemilik_usaha" class="form-control" style="background:#E2E8F0; cursor:not-allowed;" value="{{ old('nama_pemilik_usaha', $ptpNama ?: (Auth::user()->name ?? Auth::user()->username)) }}" readonly required>
                    <!-- Tersembunyi karena form awal memerlukan nama_pengaju juga -->
                    <input type="hidden" name="nama_pengaju" value="{{ old('nama_pengaju', $ptpNama ?: (Auth::user()->name ?? Auth::user()->username)) }}">
                </div>

                <!-- Hubungan Pengaju -->
                <div class="form-group">
                    <label class="form-label">Hubungan Pengaju (Sebagai Apa)<span class="required">*</span></label>
                    <select id="hubungan_pengaju" name="hubungan_pengaju" class="form-control" required>
                        <option value="" disabled {{ $selectedHubungan ? '' : 'selected' }}>Pilih Hubungan Pengaju...</option>
                        <option value="Pemilik Usaha / Pengguna Layanan" {{ $selectedHubungan === 'Pemilik Usaha / Pengguna Layanan' ? 'selected' : '' }}>Pemilik Usaha / Pengguna Layanan</option>
                        <option value="Penerima Kuasa" {{ $selectedHubungan === 'Penerima Kuasa' ? 'selected' : '' }}>Penerima Kuasa</option>
                        <option value="Lainnya" {{ $selectedHubungan === 'Lainnya' ? 'selected' : '' }}>Instansi / PT / Lainnya (Ketik Manual)</option>
                    </select>

                    <div id="hubungan_pengaju_lainnya_wrapper" style="display: {{ in_array($selectedHubungan, ['Lainnya', 'Pemilik Usaha / Pengguna Layanan']) ? 'block' : 'none' }}; margin-top: 8px;">
                        <input type="text" id="hubungan_pengaju_lainnya" name="hubungan_pengaju_lainnya" class="form-control" placeholder="Masukkan hubungan secara manual..." value="{{ old('hubungan_pengaju_lainnya', in_array($ptpHubungan, ['PT / Badan Usaha', 'Instansi Pemerintah']) ? $ptpHubungan : '') }}">
                    </div>
                </div>
            </div>

            <div class="ptp-divider"></div>

            <!-- SECTION 2 -->
            <div class="ptp-section-title">2. UNGGAH BERKAS PERSYARATAN</div>

            <div class="form-grid">
                <!-- 1. Peta Lokasi -->
                <div class="form-group">
                    <label class="form-label">
                        <span class="label-text">1. Peta/sketsa lokasi yang dimohon<span class="required">*</span></span>
                        <button type="button" class="btn-contoh" onclick="openPreview('{{ asset('storage/Contoh_Format/2%20Peta%20atau%20Sketsa%20Lokasi.pdf') }}', 'Contoh Peta / Sketsa Lokasi')">Lihat Contoh</button>
                    </label>
                    <div class="file-input-wrapper">
                        <input type="file" name="peta_lokasi" accept=".pdf,.jpg,.jpeg,.png" required>
                        <span class="file-help">Format : PDF, JPG, PNG, Maks 5MB</span>
                    </div>
                </div>

                <!-- 2. Surat Kuasa -->
                <div class="form-group">
                    <label class="form-label">
                        <span class="label-text">2. Surat Kuasa<span class="required">*</span></span>
                        <button type="button" class="btn-contoh" onclick="openPreview('{{ asset('storage/Contoh_Format/3%20Surat%20Kuasa.pdf') }}', 'Contoh Surat Kuasa')">Lihat Contoh</button>
                    </label>
                    <div class="file-input-wrapper">
                        <input type="file" name="surat_kuasa" accept=".pdf,.jpg,.jpeg,.png" required>
                        <span class="file-help">Format : PDF, JPG, PNG, Maks 5MB</span>
                    </div>
                </div>

                <!-- 3. FC KTP -->
                <div class="form-group">
                    <label class="form-label">
                        <span class="label-text">3. Fotokopi KTP<span class="required">*</span></span>
                        <button type="button" class="btn-contoh" onclick="openPreview('{{ asset('storage/Contoh_Format/4%20KTP%20Kuasa%20dan%20Pemberi%20Kuasa.pdf') }}', 'Contoh Fotokopi KTP')">Lihat Contoh</button>
                    </label>
                    <div class="file-input-wrapper">
                        <input type="file" name="fc_ktp" accept=".pdf,.jpg,.jpeg,.png" required>
                        <span class="file-help">Format : PDF, JPG, PNG, Maks 5MB</span>
                    </div>
                </div>

                <!-- 4. FC NPWP -->
                <div class="form-group">
                    <label class="form-label">
                        <span class="label-text">4. Fotokopi NPWP<span class="required">*</span></span>
                        <button type="button" class="btn-contoh" onclick="openPreview('{{ asset('storage/Contoh_Format/5%20NPWP%20Badan%20Usaha.pdf') }}', 'Contoh Fotokopi NPWP')">Lihat Contoh</button>
                    </label>
                    <div class="file-input-wrapper">
                        <input type="file" name="fc_npwp" accept=".pdf,.jpg,.jpeg,.png" required>
                        <span class="file-help">Format : PDF, JPG, PNG, Maks 5MB</span>
                    </div>
                </div>

                <!-- 5. Akta Pendirian / Dokumen Penetapan -->
                <div class="form-group">
                    <label class="form-label">
                        <span class="label-text">5. Dokumen Penetapan / Rekomendasi PSN dari Kementerian / Lembaga Teknis<span class="required">*</span></span>
                    </label>
                    <div class="file-input-wrapper">
                        <input type="file" name="fc_akta_pendirian" accept=".pdf,.jpg,.jpeg,.png" required>
                        <span class="file-help">Format : PDF, JPG, PNG, Maks 10MB</span>
                    </div>
                </div>

                <!-- 6. Rencana Penggunaan Tanah -->
                <div class="form-group">
                    <label class="form-label">
                        <span class="label-text">6. Rencana Penggunaan & Pemanfaatan Tanah<span class="required">*</span></span>
                        <button type="button" class="btn-contoh" style="opacity: 0; pointer-events:none;">Lihat Contoh</button>
                    </label>
                    <div class="file-input-wrapper">
                        <input type="file" name="rencana_penggunaan_tanah" accept=".pdf,.jpg,.jpeg,.png" required>
                        <span class="file-help">Format : PDF, JPG, PNG, Maks 10MB</span>
                    </div>
                </div>

                <!-- 7. NIB -->
                <div class="form-group">
                    <label class="form-label">
                        <span class="label-text">7. Nomor Induk Berusaha (NIB) / Izin Usaha Sektoral<span class="required">*</span></span>
                        <button type="button" class="btn-contoh" onclick="openPreview('{{ asset('storage/Contoh_Format/8%20NIB%20(Nomor%20Induk%20Berusaha).pdf') }}', 'Contoh NIB')">Lihat Contoh</button>
                    </label>
                    <div class="file-input-wrapper">
                        <input type="file" name="nib" accept=".pdf,.jpg,.jpeg,.png" required>
                        <span class="file-help">Format : PDF, JPG, PNG, Maks 5MB</span>
                    </div>
                </div>

                <!-- 8. Dokumen KBLI -->
                <div class="form-group">
                    <label class="form-label">
                        <span class="label-text">8. Dokumen KBLI / Klasifikasi Lapangan Usaha PSN<span class="optional">(Opsional)</span></span>
                        <button type="button" class="btn-contoh" onclick="openPreview('{{ asset('storage/Contoh_Format/9%20KBLI%20(Klasifikasi%20Baku%20Lapangan%20Usaha%20Indonesia).pdf') }}', 'Contoh Dokumen KBLI')">Lihat Contoh</button>
                    </label>
                    <div class="file-input-wrapper">
                        <input type="file" name="kbli" accept=".pdf,.jpg,.jpeg,.png">
                        <span class="file-help">Format : PDF, JPG, PNG, Maks 5MB</span>
                    </div>
                    <!-- Hidden field kbli_kode to pass validation if required -->
                    <input type="hidden" name="kbli_kode" value="{{ old('kbli_kode', session('ptp_form_data.kbli', '')) }}">
                </div>

                <!-- 9. Proposal -->
                <div class="form-group">
                    <label class="form-label">
                        <span class="label-text">9. Proposal Rencana Kegiatan Berusaha / Proyek Strategis Nasional<span class="optional">(Opsional)</span></span>
                        <button type="button" class="btn-contoh" onclick="openPreview('{{ asset('storage/Contoh_Format/10%20Proposal%20Rencana%20Kegiatan%20Berusaha.pdf') }}', 'Contoh Proposal Kegiatan')">Lihat Contoh</button>
                    </label>
                    <div class="file-input-wrapper">
                        <input type="file" name="proposal_kegiatan" accept=".pdf,.doc,.docx">
                        <span class="file-help">Format : PDF, DOC, DOCX, Maks 10MB</span>
                    </div>
                </div>

                <!-- 10. Persyaratan Lainnya -->
                <div class="form-group">
                    <label class="form-label">
                        <span class="label-text" style="line-height: 1.4;">10. Persyaratan lainnya yang diperlukan<br><span style="font-size:11px; font-weight:500; color:#7A9BB5;">(Sertifikat HAK / SKT / Akta / Sewa Menyewa)</span><span class="required">*</span></span>
                        <button type="button" class="btn-contoh" onclick="openPreview('{{ asset('storage/Contoh_Format/11%20Sertipikat%20dan%20Bukti%20Penguasaan%20Fisik%20Lainnya.pdf') }}', 'Contoh Dokumen Pertek Pertanahan / Bukti Fisik')">Lihat Contoh</button>
                    </label>
                    <div class="file-input-wrapper">
                        <input type="file" name="persyaratan_lainnya" accept=".pdf,.jpg,.jpeg,.png,.zip,.rar" required>
                        <span class="file-help">Format : PDF, JPG, PNG, ZIP, RAR, Maks 10MB</span>
                    </div>
                </div>
            </div>

            <!-- ACTIONS -->
            <div class="btn-submit-wrap">
                <button type="button" class="btn-batal" onclick="window.history.back()">Batal</button>
                <button type="submit" class="btn-submit">
                    Kirim Permohonan
                </button>
            </div>

        </form>
    </div>
</div>

<div class="help-banner-wrapper">
    <div class="help-banner">
        <div class="help-banner-img">
            <img src="{{ asset('storage/svg/tandatanya.svg') }}" alt="Ilustrasi Bantuan">
        </div>
        <div class="help-banner-content">
            <h2>Butuh <span>Bantuan</span><br>Pengajuan Dokumen?</h2>
            <p>Tim PATEN PAK MIKO siap membantu proses pelayanan pertanahan Anda.</p>
            <a href="https://wa.me/628123456789" class="btn-hubungi" target="_blank">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" width="18" height="18"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                Hubungi Admin
            </a>
        </div>
    </div>
</div>

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
    document.addEventListener('DOMContentLoaded', function () {
        const selectHubungan = document.getElementById('hubungan_pengaju');
        const wrapperLainnya = document.getElementById('hubungan_pengaju_lainnya_wrapper');
        const inputLainnya = document.getElementById('hubungan_pengaju_lainnya');

        function toggleLainnya() {
            if (selectHubungan.value === 'Lainnya' || selectHubungan.value === 'Pemilik Usaha / Pengguna Layanan') {
                wrapperLainnya.style.display = 'block';
                inputLainnya.setAttribute('required', 'required');
                if (selectHubungan.value === 'Pemilik Usaha / Pengguna Layanan') {
                    inputLainnya.placeholder = 'Ketik pemilik usaha/layanan apa (cth: Pemilik Toko Roti, dll)';
                } else {
                    inputLainnya.placeholder = 'Masukkan hubungan pengaju secara manual (cth: Instansi, PT, dll)';
                }
            } else {
                wrapperLainnya.style.display = 'none';
                inputLainnya.removeAttribute('required');
            }
        }

        selectHubungan.addEventListener('change', toggleLainnya);
        toggleLainnya();
    });

    function openPreview(url, title) {
        document.getElementById('previewTitle').innerText = title;
        document.getElementById('previewFrame').src = url;
        const fallbackLink = document.getElementById('mobileDownloadLink');
        if (fallbackLink) fallbackLink.href = url;
        const fallbackDiv = document.getElementById('mobileFallback');
        if (fallbackDiv) { fallbackDiv.style.display = window.innerWidth <= 768 ? 'block' : 'none'; }
        document.getElementById('previewBackdrop').classList.add('show');
        document.getElementById('previewModal').classList.add('open');
    }
    
    function closePreview() {
        document.getElementById('previewBackdrop').classList.remove('show');
        document.getElementById('previewModal').classList.remove('open');
        setTimeout(() => { document.getElementById('previewFrame').src = ''; }, 300);
    }

    // KBLI AUTOCOMPLETE
    (function () {
        const input = document.getElementById('kbli_kode');
        const dropdown = document.getElementById('kbliDropdown');
        const infoBox = document.getElementById('kbliSelectedInfo');
        if (!input) return;
        let debounceTimer = null, activeIndex = -1;
        function showInfo(code, title) {
            infoBox.innerHTML = `<span class="kbli-desc"><span class="kbli-desc-icon">✅</span> <strong>${code}</strong> — ${title}</span>`;
            infoBox.style.display = 'block';
        }
        function closeDropdown() { dropdown.classList.remove('show'); dropdown.innerHTML = ''; activeIndex = -1; }
        if (input.value.length >= 2) {
            fetch(`/api/kbli/find?code=${encodeURIComponent(input.value)}`)
                .then(r => r.json()).then(d => { if (d && d.title) showInfo(d.code, d.title); });
        }
        input.addEventListener('input', function () {
            clearTimeout(debounceTimer);
            const q = this.value.trim();
            infoBox.style.display = 'none';
            if (q.length < 2) { closeDropdown(); return; }
            debounceTimer = setTimeout(() => {
                fetch(`/api/kbli/search?q=${encodeURIComponent(q)}`)
                    .then(r => r.json())
                    .then(results => {
                        closeDropdown();
                        if (!results.length) return;
                        results.forEach(item => {
                            const div = document.createElement('div');
                            div.className = 'kbli-item';
                            div.innerHTML = `<strong>${item.code}</strong> ${item.title}`;
                            div.addEventListener('click', () => { input.value = item.code; showInfo(item.code, item.title); closeDropdown(); });
                            dropdown.appendChild(div);
                        });
                        dropdown.classList.add('show'); activeIndex = -1;
                    }).catch(() => closeDropdown());
            }, 300);
        });
        input.addEventListener('keydown', function (e) {
            const items = dropdown.querySelectorAll('.kbli-item');
            if (!items.length) return;
            if (e.key === 'ArrowDown') { e.preventDefault(); activeIndex = Math.min(activeIndex + 1, items.length - 1); items.forEach((el, i) => el.classList.toggle('active', i === activeIndex)); }
            else if (e.key === 'ArrowUp') { e.preventDefault(); activeIndex = Math.max(activeIndex - 1, 0); items.forEach((el, i) => el.classList.toggle('active', i === activeIndex)); }
            else if (e.key === 'Enter' && activeIndex >= 0) { e.preventDefault(); items[activeIndex].click(); }
            else if (e.key === 'Escape') { closeDropdown(); }
        });
        document.addEventListener('click', function (e) {
            if (!input.contains(e.target) && !dropdown.contains(e.target)) closeDropdown();
        });
    })();
</script>
@endsection
