@extends('layouts.public')

@section('title', 'Form Pengajuan Pertimbangan Teknis Pertanahan PSN (Proyek Strategis Nasional) — PATEN PAK MIKO')

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
        @if(session('success'))
            <div class="ptp-alert ptp-alert-success" id="ptpAlertSuccess">
                <div class="ptp-alert-content">
                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="#22C55E" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="ptp-alert-icon"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                    <div class="ptp-alert-text">
                        <div class="ptp-alert-title">Dokumen Diterima</div>
                        <div class="ptp-alert-desc">
                            {{ is_string(session('success')) ? session('success') : 'Unggahan Anda telah berhasil diproses oleh sistem PATEN PAK MIKO dan akan digunakan untuk verifikasi administrasi.' }}
                        </div>
                    </div>
                </div>
                <button type="button" class="ptp-alert-close" onclick="document.getElementById('ptpAlertSuccess').style.display='none'">
                    <svg viewBox="0 0 24 24" width="20" height="20" stroke="currentColor" stroke-width="1.5" fill="none" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
        @endif

        @if($errors->any() || session('error'))
            <div class="ptp-alert ptp-alert-error" id="ptpAlertError">
                <div class="ptp-alert-content">
                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="#EF4444" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="ptp-alert-icon"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                    <div class="ptp-alert-text">
                        <div class="ptp-alert-title">Gagal Mengunggah File</div>
                        <div class="ptp-alert-desc">
                            @if(session('error'))
                                {{ session('error') }}
                            @else
                                Terjadi kesalahan saat proses upload. Pastikan file sesuai ketentuan dan koneksi internet Anda stabil.
                                <ul style="margin-top: 4px; margin-left: 16px;">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>
                <button type="button" class="ptp-alert-close" onclick="document.getElementById('ptpAlertError').style.display='none'">
                    <svg viewBox="0 0 24 24" width="20" height="20" stroke="currentColor" stroke-width="1.5" fill="none" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
        @endif

        <form action="{{ route('psn.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- SECTION 1 -->
            <div class="ptp-section-title">1. IDENTITAS PEMOHON / PENGGUNA LAYANAN</div>
            
            @php
                $ptpNama = session('ptp_form_data.nama', '');
                $ptpHubungan = session('ptp_form_data.bertindak_atas_nama', '');
                $ptpInstansi = session('ptp_form_data.nama_instansi', '');
                $ptpPemberiKuasa = session('ptp_form_data.nama_pemberi_kuasa', '');

                $pemilikUsahaValue = $ptpNama;
                if ($ptpHubungan === 'Penerima Kuasa') {
                    $pemilikUsahaValue = $ptpPemberiKuasa ?: $ptpNama;
                } elseif (in_array($ptpHubungan, ['Badan Hukum', 'Instansi Pemerintahan'])) {
                    $pemilikUsahaValue = $ptpInstansi ?: $ptpNama;
                }
                
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
                    <input type="text" id="nama_pemilik_usaha" name="nama_pemilik_usaha" class="form-control" style="background:#E2E8F0; cursor:not-allowed;" value="{{ old('nama_pemilik_usaha', $pemilikUsahaValue ?: (Auth::user()->name ?? Auth::user()->username)) }}" readonly required>
                    <!-- Tersembunyi karena form awal memerlukan nama_pengaju juga -->
                    <input type="hidden" name="nama_pengaju" value="{{ old('nama_pengaju', $ptpNama ?: (Auth::user()->name ?? Auth::user()->username)) }}">
                </div>

                <!-- Hubungan Pengaju -->
                @if($ptpHubungan !== 'Diri Sendiri')
                <div class="form-group">
                    <label class="form-label">Hubungan Pengaju (Sebagai Apa)<span class="required">*</span></label>
                    <select id="hubungan_pengaju" name="hubungan_pengaju" class="form-control" required>
                        <option value="" disabled {{ $selectedHubungan ? '' : 'selected' }}>Pilih Hubungan Pengaju...</option>
                        <option value="Pemilik Usaha / Pengguna Layanan" {{ $selectedHubungan === 'Pemilik Usaha / Pengguna Layanan' ? 'selected' : '' }}>Pemilik Usaha / Pengguna Layanan</option>
                        <option value="Penerima Kuasa" {{ $selectedHubungan === 'Penerima Kuasa' ? 'selected' : '' }}>Penerima Kuasa</option>
                        <option value="Lainnya" {{ $selectedHubungan === 'Lainnya' ? 'selected' : '' }}>Instansi / PT / Lainnya (Ketik Manual)</option>
                    </select>

                    <div id="hubungan_pengaju_lainnya_wrapper" style="display: {{ in_array($selectedHubungan, ['Lainnya', 'Pemilik Usaha / Pengguna Layanan']) ? 'block' : 'none' }}; margin-top: 8px;">
                        <input type="text" id="hubungan_pengaju_lainnya" name="hubungan_pengaju_lainnya" class="form-control" placeholder="Masukkan hubungan secara manual..." value="{{ old('hubungan_pengaju_lainnya', in_array($ptpHubungan, ['Badan Hukum', 'Instansi Pemerintahan']) ? $ptpHubungan : '') }}">
                    </div>
                </div>
                @else
                <input type="hidden" name="hubungan_pengaju" value="Pemilik Usaha / Pengguna Layanan">
                <input type="hidden" name="hubungan_pengaju_lainnya" value="Diri Sendiri">
                @endif
            </div>            <div class="ptp-divider"></div>

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
            @php
                $fullKbli = old('kbli_kode', session('ptp_form_data.kbli', ''));
                $kbliCode = preg_match('/^(\d+)/', $fullKbli, $m) ? $m[1] : $fullKbli;
            @endphp
            <input type="hidden" name="kbli_kode" value="{{ $kbliCode }}">


            <!-- ACTIONS -->
            <div class="btn-submit-wrap" style="display: flex; gap: 12px; justify-content: flex-end; align-items: center; flex-wrap: wrap; margin-top: 24px;">
                <button type="button" class="btn-batal" onclick="window.history.back()">Batal</button>
                <div style="position: relative; display: inline-block;">
                    <button type="button" onclick="document.getElementById('ptpDropdown').style.display = document.getElementById('ptpDropdown').style.display === 'none' ? 'block' : 'none'" class="btn-submit" style="background: #EBF8FF; color: #2B6CB0; border: 1.5px solid #2B6CB0; padding: 12px 24px; border-radius: 8px; font-weight: 700; font-size: 14px; cursor: pointer;">
                        Formulir PTP ▾
                    </button>
                    <div id="ptpDropdown" style="display: none; position: absolute; bottom: 100%; left: 0; margin-bottom: 8px; background: white; border: 1px solid #E2E8F0; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); width: max-content; min-width: 100%; overflow: hidden; z-index: 10;">
                        <a href="{{ route('ptp.preview') }}" target="_blank" style="display: flex; align-items: center; gap: 8px; padding: 12px 16px; text-decoration: none; color: #2D3748; font-size: 13px; font-weight: 600; border-bottom: 1px solid #E2E8F0;" onmouseover="this.style.background='#F7FAFC'" onmouseout="this.style.background='white'">
                            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg> Preview PDF
                        </a>
                        <a href="{{ route('ptp.preview') }}?action=download" style="display: flex; align-items: center; gap: 8px; padding: 12px 16px; text-decoration: none; color: #2D3748; font-size: 13px; font-weight: 600;" onmouseover="this.style.background='#F7FAFC'" onmouseout="this.style.background='white'">
                            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg> Download DOC
                        </a>
                    </div>
                </div>
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
        window.open(url, '_blank');
    }
    
    function closePreview() {
        document.getElementById('previewBackdrop').classList.remove('show');
        document.getElementById('previewModal').classList.remove('open');
        setTimeout(() => { document.getElementById('previewFrame').src = ''; }, 300);
    }

    // DRAG AND DROP FILE UPLOAD
    document.querySelectorAll('.file-input-wrapper').forEach(wrapper => {
        const input = wrapper.querySelector('input[type="file"]');
        if (!input) return;
        
        wrapper.addEventListener('dragover', e => {
            e.preventDefault();
            wrapper.classList.add('drag-over');
        });
        
        wrapper.addEventListener('dragleave', e => {
            e.preventDefault();
            wrapper.classList.remove('drag-over');
        });
        
        wrapper.addEventListener('drop', e => {
            e.preventDefault();
            wrapper.classList.remove('drag-over');
            if (e.dataTransfer.files && e.dataTransfer.files.length > 0) {
                input.files = e.dataTransfer.files;
                input.dispatchEvent(new Event('change', { bubbles: true }));
            }
        });
    });

</script>
@endsection
