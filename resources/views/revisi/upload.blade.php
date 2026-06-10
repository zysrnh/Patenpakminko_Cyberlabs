@extends("layouts.public")

@section("title", "Upload Revisi - PATEN PAK MIKO")

@section("content")
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap');

    /* Reset & Base */
    html, body {
        margin: 0; padding: 0;
        width: 100%; height: 100%;
        font-family: 'Poppins', sans-serif;
    }

    /* Container for the split background */
    .login-wrapper {
        position: relative;
        display: flex;
        align-items: stretch; /* Stretch to fill height if content is long */
        justify-content: center;
        width: 100%;
        min-height: calc(100vh - 70px);
        flex: 1; 
        background: #F0F6FB;
    }

    /* The right side dark blue background */
    .login-bg-right {
        position: absolute;
        top: 0; right: 0; bottom: 0;
        width: 42%;
        background-color: #174A70;
        z-index: 0;
    }

    /* Content Layout */
    .login-container {
        position: relative;
        z-index: 1;
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
        width: 100%;
        max-width: 1280px;
        padding: 60px 40px;
        gap: 60px;
    }

    /* Left Info Section */
    .login-info {
        flex: 1;
        max-width: 580px;
        align-self: center;
    }
    .login-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(50, 145, 168, 0.1);
        color: #3291A8;
        padding: 8px 16px;
        border-radius: 4px;
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 24px;
    }
    .login-title {
        font-size: 48px;
        color: #0A1C2C;
        line-height: 1.15;
        margin-bottom: 24px;
    }
    .login-title .thin {
        font-weight: 300;
        display: block;
    }
    .login-title .normal {
        font-weight: 500;
        display: block;
    }
    .login-title .highlight {
        font-weight: 800;
        color: #3291A8;
        display: block;
    }
    .login-desc {
        font-size: 14px;
        color: #555;
        line-height: 1.6;
        max-width: 440px;
    }

    /* Right Card Section */
    .login-card-wrap {
        flex: 0 0 650px;
        margin: 40px 0;
    }
    .login-card {
        background: #FFFFFF;
        border-radius: 4px;
        padding: 50px 60px;
        box-shadow: -15px 25px 60px rgba(0,0,0,0.12);
        width: 100%;
    }

    /* Alert / Warning */
    .alert-warning-custom {
        background: #FFFBEB;
        border: 1.5px solid #FDE68A;
        border-radius: 6px;
        padding: 20px;
        margin-bottom: 30px;
    }
    .alert-warning-custom strong {
        display: block;
        color: #B45309;
        font-size: 15px;
        margin-bottom: 4px;
    }
    .alert-warning-custom p {
        font-size: 13.5px;
        color: #92400E;
        margin: 0 0 12px 0;
    }
    .alert-notes {
        background: #FFFFFF;
        border: 1px solid #FCD34D;
        border-radius: 4px;
        padding: 12px;
        font-family: 'DM Mono', monospace;
        font-size: 12.5px;
        color: #B45309;
        white-space: pre-wrap;
        line-height: 1.5;
    }

    .form-section-title {
        font-size: 16px;
        font-weight: 700;
        color: #0A1C2C;
        margin-bottom: 20px;
        padding-bottom: 12px;
        border-bottom: 1.5px solid #E2E8F0;
    }

    .form-group {
        margin-bottom: 24px;
    }
    .form-label {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 13.5px;
        font-weight: 700;
        color: #E53E3E;
        margin-bottom: 8px;
    }
    .form-control {
        width: 100%;
        background: #F4F7F9;
        border: 1px solid #E2E8F0;
        border-radius: 4px;
        padding: 12px 16px;
        font-size: 13.5px;
        color: #0A1C2C;
        transition: all .2s;
        box-sizing: border-box;
    }
    .form-control:focus {
        outline: none;
        border-color: #3291A8;
        background: #fff;
    }
    .form-hint {
        font-size: 11.5px;
        color: #7A9BB5;
        margin-top: 6px;
        display: block;
    }

    .btn-login {
        width: 100%;
        padding: 18px;
        background: #00223D;
        color: #fff;
        border: none;
        border-radius: 4px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: background .2s;
        margin-top: 16px;
    }
    .btn-login:hover { background: #001526; }

    /* Responsive */
    @media (max-width: 1024px) {
        .login-bg-right { width: 30%; }
        .login-container { gap: 40px; padding: 40px 20px; align-items: stretch; }
        .login-title { font-size: 36px; }
        .login-card-wrap { flex: 0 0 460px; align-self: center; }
    }
    @media (max-width: 768px) {
        .login-bg-right { display: none; }
        .login-wrapper { background: #F0F6FB; }
        .login-container {
            flex-direction: column;
            text-align: center;
        }
        .login-info { margin-bottom: 40px; }
        .login-desc { margin: 0 auto; }
        .login-card-wrap { width: 100%; flex: auto; margin: 0; }
        .login-card { padding: 40px 24px; text-align: left; }
        .form-label { text-align: left; }
    }
</style>

<div class="login-wrapper">
    <div class="login-bg-right"></div>
    
    <div class="login-container">
        <!-- Text Section -->
        <div class="login-info">
            <div class="login-badge">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                    <polyline points="17 8 12 3 7 8"></polyline>
                    <line x1="12" y1="3" x2="12" y2="15"></line>
                </svg>
                Unggah Ulang Dokumen
            </div>
            <h1 class="login-title">
                <span class="thin">Selesaikan</span>
                <span class="normal">Perbaikan Berkas</span>
                <span class="highlight">Permohonan</span>
            </h1>
            <p class="login-desc">Sistem telah mendeteksi kekurangan atau ketidaksesuaian pada dokumen yang Anda unggah sebelumnya. Silakan baca catatan dari petugas dengan seksama dan unggah ulang dokumen yang diminta pada form di samping.</p>
        </div>

        <!-- Card Section -->
        <div class="login-card-wrap">
            <div class="login-card">
                
                <div class="alert-warning-custom">
                    <strong>Permohonan Anda Perlu Perbaikan</strong>
                    @php
                        $namaPemohon = $application->nama_pengaju ?: ($application->user->name ?? $application->user->username ?? 'Pemohon');
                    @endphp
                    <p>Atas Nama: <b>{{ $namaPemohon }}</b></p>
                    <p style="margin-top: -6px;">No. Registrasi: <b>{{ $application->application_number }}</b></p>
                    <div style="font-size: 13px; font-weight: 600; color: #B45309; margin-bottom: 6px;">Catatan / Instruksi Pemeriksa:</div>
                    <div class="alert-notes">{{ $notes }}</div>
                </div>

                <form action="{{ route("revisi.upload", ["type" => $type, "id" => $application->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <h5 class="form-section-title">Daftar Dokumen yang Harus Diunggah Ulang:</h5>
                    
                    @if(count($missingFiles) > 0)
                        @foreach($missingFiles as $file)
                            <div class="form-group">
                                <label class="form-label">
                                    {{ $file }}
                                    <span style="font-size: 11px; font-weight: 600; color: #E53E3E; background: #FFF5F5; padding: 2px 6px; border-radius: 4px; border: 1px solid #FED7D7;">Wajib</span>
                                </label>
                                <input type="file" name="doc_{{ str_replace(" ", "_", $file) }}" class="form-control" accept=".pdf,.png,.jpg,.jpeg,.zip" required>
                                <span class="form-hint">Maksimal 10MB. Format yang didukung: PDF, JPG, PNG.</span>
                            </div>
                        @endforeach
                    @else
                        <div class="form-group">
                            <label class="form-label">
                                Dokumen Perbaikan (Gabungan ZIP/PDF)
                                <span style="font-size: 11px; font-weight: 600; color: #E53E3E; background: #FFF5F5; padding: 2px 6px; border-radius: 4px; border: 1px solid #FED7D7;">Wajib</span>
                            </label>
                            <input type="file" name="doc_Gabungan_Perbaikan" class="form-control" accept=".pdf,.zip,.rar" required>
                            <span class="form-hint">Silakan satukan seluruh perbaikan dokumen dalam 1 file ZIP atau PDF (Max 10MB).</span>
                        </div>
                    @endif

                    <button type="submit" class="btn-login">Unggah & Kirim Berkas Revisi</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
