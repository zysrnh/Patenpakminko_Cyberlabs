@extends("layouts.public")

@section("title", "Lacak Revisi - PATEN PAK MIKO")

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
        align-items: center;
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
    }
    .login-card {
        background: #FFFFFF;
        border-radius: 4px;
        padding: 80px 70px;
        box-shadow: -15px 25px 60px rgba(0,0,0,0.12);
        width: 100%;
    }
    .form-group {
        margin-bottom: 28px;
    }
    .form-label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: #0A1C2C;
        margin-bottom: 8px;
    }
    .form-control {
        width: 100%;
        background: #F4F7F9;
        border: 1px solid #E2E8F0;
        border-radius: 4px;
        padding: 16px;
        font-size: 14px;
        color: #0A1C2C;
        transition: all .2s;
        box-sizing: border-box;
    }
    .form-control:focus {
        outline: none;
        border-color: #3291A8;
        background: #fff;
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

    .alert {
        padding: 16px;
        border-radius: 4px;
        margin-bottom: 24px;
        font-size: 13.5px;
        font-weight: 500;
    }
    .alert-danger {
        background: #FFF5F5;
        color: #C53030;
        border: 1px solid #FED7D7;
    }
    .alert-success {
        background: #F0FFF4;
        color: #2F855A;
        border: 1px solid #C6F6D5;
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .login-bg-right { width: 30%; }
        .login-container { gap: 40px; padding: 40px 20px; }
        .login-title { font-size: 36px; }
        .login-card-wrap { flex: 0 0 460px; }
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
        .login-card-wrap { width: 100%; flex: auto; }
        .login-card { padding: 40px 24px; }
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
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                    <polyline points="14 2 14 8 20 8"></polyline>
                    <line x1="16" y1="13" x2="8" y2="13"></line>
                    <line x1="16" y1="17" x2="8" y2="17"></line>
                    <polyline points="10 9 9 9 8 9"></polyline>
                </svg>
                Portal Revisi Berkas
            </div>
            <h1 class="login-title">
                <span class="thin">Upload Ulang</span>
                <span class="normal">Perbaikan Berkas</span>
                <span class="highlight">Pemohon</span>
            </h1>
            <p class="login-desc">Jika permohonan Anda dikembalikan (Tidak Sesuai / Ditolak) pada tahap verifikasi awal, masukkan Nomor Telepon / WhatsApp Anda untuk melacak dan mengunggah ulang dokumen yang kurang lengkap.</p>
        </div>

        <!-- Card Section -->
        <div class="login-card-wrap">
            <div class="login-card">
                @if(session("error"))
                    <div class="alert alert-danger">{{ session("error") }}</div>
                @endif
                @if(session("success"))
                    <div class="alert alert-success">{{ session("success") }}</div>
                @endif

                <form method="POST" action="{{ route('revisi.track') }}" id="loginForm">
                    @csrf
                    
                    <div class="form-group">
                        <label class="form-label">Nomor Telepon / WhatsApp</label>
                        <input type="text" name="phone" class="form-control" placeholder="Contoh: 08123456789" required autofocus>
                    </div>

                    <button type="submit" class="btn-login">Lacak Berkas Revisi</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
