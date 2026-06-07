@extends('layouts.public')

@section('content')
<style>
    .success-page-wrapper {
        min-height: 70vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #F8FAFC;
        padding: 40px 20px;
    }
    .success-container {
        background: #FFFFFF;
        border-radius: 12px;
        padding: 60px 40px;
        max-width: 800px;
        width: 100%;
        text-align: center;
        box-shadow: 0 4px 20px rgba(0,0,0,0.03);
    }
    .success-img {
        width: 180px;
        height: auto;
        margin-bottom: 30px;
    }
    .success-title {
        font-size: 28px;
        font-weight: 800;
        color: #0A1C2C;
        margin-bottom: 16px;
    }
    .success-desc {
        font-size: 15px;
        color: #4A5568;
        line-height: 1.6;
        margin-bottom: 40px;
        font-weight: 500;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }
    .btn-home {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #00223D;
        color: #FFFFFF;
        padding: 14px 28px;
        border-radius: 6px;
        font-weight: 600;
        text-decoration: none;
        font-size: 14.5px;
        transition: background .2s, transform .2s;
    }
    .btn-home:hover {
        background: #001526;
        color: #FFFFFF;
        transform: translateY(-2px);
    }
    
    @media (max-width: 768px) {
        .success-container { padding: 40px 20px; }
        .success-title { font-size: 24px; }
        .success-desc { font-size: 14px; }
    }
</style>

<div class="success-page-wrapper">
    <div class="success-container">
        <img src="{{ asset('storage/svg/UploadSukses.svg') }}" alt="Berhasil" class="success-img">
        <h2 class="success-title">Dokumen Anda berhasil dikirim</h2>
        <p class="success-desc">
            Terima kasih, pengiriman dokumen Anda telah berhasil dikirim dan sedang menunggu proses verifikasi oleh admin kami. Detail lanjutan akan dihubungi via WhatsApp oleh admin kami.
        </p>
        <!-- The user can go to their dashboard / timeline to see the application -->
        <a href="{{ route('home') }}" class="btn-home">
            Kembali ke Halaman Utama &rarr;
        </a>
    </div>
</div>
@endsection
