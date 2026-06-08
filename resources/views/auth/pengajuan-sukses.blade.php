@extends('layouts.public')

@section('content')
<style>
    body { background-color: #F0F6FB; }
    
    .success-page-wrapper {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 60px 20px;
        flex: 1;
        justify-content: center;
        background-color: #F0F6FB;
    }
    .success-container {
        background: #FFFFFF;
        width: 100%;
        max-width: 1100px;
        padding: 100px 40px;
        text-align: center;
        box-shadow: none;
    }
    .success-img {
        display: block;
        width: 220px;
        height: auto;
        margin: 0 auto 30px auto;
    }
    .success-title {
        font-size: 32px;
        font-weight: 800;
        color: #003B64;
        margin-bottom: 16px;
    }
    .success-desc {
        font-size: 13px;
        color: #555;
        line-height: 1.6;
        max-width: 550px;
        margin: 0 auto 32px;
    }
    .btn-home {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        padding: 14px 28px;
        background: #003B64;
        color: #fff;
        border: none;
        border-radius: 5px;
        font-family: inherit;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: background .2s, transform .2s;
        text-decoration: none;
    }
    .btn-home:hover {
        background: #002642;
        transform: translateY(-1px);
    }
    
    @media (max-width: 767px) {
        .success-container { padding: 60px 24px; }
        .success-title { font-size: 24px; }
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
        <a href="{{ url('/') }}" class="btn-home">
            Kembali ke Halaman Utama &rarr;
        </a>
    </div>
</div>
@endsection
