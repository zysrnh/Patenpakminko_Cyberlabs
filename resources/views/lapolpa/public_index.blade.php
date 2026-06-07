@extends('layouts.public')

@section('title', 'LAPOL PAK - PATEN PAK MIKO')

@section('content')
<style>
    /* Styling khusus untuk halaman LAPOL PAK */
    body { background-color: #F0F6FB; }
    
    .lapolpa-wrapper {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 60px 20px;
        flex: 1;
        justify-content: center;
    }
    .lapolpa-badge {
        background-color: #E6F3FA;
        color: var(--blue-dk);
        padding: 6px 16px;
        border-radius: 5px;
        font-size: 12px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        margin-bottom: 20px;
    }
    .lapolpa-badge svg {
        width: 14px;
        height: 14px;
    }
    .lapolpa-title {
        font-size: 28px;
        font-weight: 800;
        color: var(--ink);
        text-align: center;
        margin-bottom: 12px;
    }
    .lapolpa-title span {
        color: #003B64; /* Dibuat lebih gelap */
    }
    .lapolpa-subtitle {
        text-align: center;
        font-size: 14px;
        color: var(--mid);
        max-width: 480px;
        margin-bottom: 40px;
        line-height: 1.6;
    }
    .lapolpa-card {
        background: #FFFFFF;
        border-radius: 5px;
        box-shadow: 0 10px 40px rgba(0, 59, 100, 0.08);
        width: 100%;
        max-width: 600px;
        padding: 40px;
        margin-bottom: 30px;
    }
    .form-group {
        margin-bottom: 20px;
    }
    .form-label {
        display: block;
        font-size: 13px;
        font-weight: 700;
        margin-bottom: 8px;
        color: var(--ink);
    }
    .form-label span {
        color: #E53E3E;
    }
    .form-control {
        width: 100%;
        padding: 14px 16px;
        font-family: inherit;
        font-size: 14px;
        background: #F4F7FA;
        border: 1px solid var(--line);
        border-radius: 5px;
        outline: none;
        transition: border .2s, background .2s;
        color: var(--ink);
    }
    .form-control:focus {
        border-color: var(--blue-md);
        background: #FFFFFF;
    }
    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }
    .btn-submit {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        width: 100%;
        padding: 16px;
        background: var(--blue-dk);
        color: #fff;
        border: none;
        border-radius: 5px;
        font-family: inherit;
        font-size: 14px;
        font-weight: 700;
        cursor: pointer;
        transition: background .2s, transform .2s;
        margin-top: 10px;
    }
    .btn-submit:hover {
        background: #001f35;
        transform: translateY(-1px);
    }
    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 20px;
        background: #E6F3FA;
        color: var(--blue-dk);
        font-size: 13px;
        font-weight: 700;
        text-decoration: none;
        border-radius: 5px;
        transition: background .2s;
    }
    .btn-back:hover {
        background: #d4ecf8;
    }
    .alert {
        padding: 14px 16px;
        border-radius: 5px;
        font-size: 13.5px;
        font-weight: 500;
        margin-bottom: 24px;
        display: flex;
        gap: 10px;
    }
    .alert svg { width: 20px; height: 20px; flex-shrink: 0; }
    .alert-error { background: #FCE8E6; border: 1px solid #F8B4B4; color: #C5221F; }
    
    /* Popup Modal Styling */
    .lapolpa-popup-overlay {
        position: fixed;
        top: 0; left: 0; right: 0; bottom: 0;
        background: rgba(0, 40, 70, 0.6); /* Lebih gelap sedikit untuk gantiin efek blur */
        z-index: 9999;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.3s cubic-bezier(0.4, 0, 0.2, 1), visibility 0.3s ease;
    }
    .lapolpa-popup-overlay.show {
        opacity: 1;
        visibility: visible;
    }
    .lapolpa-popup-card {
        background: #fff;
        border-radius: 5px;
        width: 100%;
        max-width: 420px;
        padding: 32px 24px;
        text-align: center;
        position: relative;
        transform: translateY(20px) scale(0.95);
        transition: transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1); /* Efek membal halus */
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
    }
    .lapolpa-popup-overlay.show .lapolpa-popup-card {
        transform: translateY(0) scale(1);
    }
    .lapolpa-popup-close {
        position: absolute;
        top: 12px;
        right: 12px;
        background: transparent;
        border: none;
        font-size: 24px;
        line-height: 1;
        color: #999;
        cursor: pointer;
        transition: color 0.2s;
    }
    .lapolpa-popup-close:hover {
        color: #003B64;
    }
    .lapolpa-popup-icon {
        width: 50px;
        height: 50px;
        background: #E6F3FA;
        color: #218AC9;
        border-radius: 5px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 16px;
    }
    .lapolpa-popup-icon svg {
        width: 26px;
        height: 26px;
    }
    .lapolpa-popup-title {
        font-size: 18px;
        font-weight: 800;
        color: #003B64;
        margin-bottom: 10px;
    }
    .lapolpa-popup-text {
        font-size: 14px;
        color: #7A9BB5;
        line-height: 1.5;
        margin-bottom: 0;
    }
    .lapolpa-popup-text strong {
        color: #003B64;
    }

    @media (max-width: 767px) {
        .form-grid { grid-template-columns: 1fr; gap: 20px; }
        .lapolpa-card { padding: 24px; }
        .lapolpa-title { font-size: 24px; }
    }
</style>

<div class="lapolpa-wrapper">
    <div class="lapolpa-badge">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
        LAPOL PAK
    </div>
    <h1 class="lapolpa-title"><span>LAPOL PAK</span></h1>
    <p class="lapolpa-subtitle">Layanan konsultasi dan pembuatan polygon gratis di kantor.<br>Silahkan isi form di bawah untuk membuat jadwal</p>

    <div class="lapolpa-card">
        @if($errors->any())
            <div class="alert alert-error">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                <div>@foreach($errors->all() as $error)<p>{{ $error }}</p>@endforeach</div>
            </div>
        @endif

        <form action="{{ route('lapolpa.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label" for="nama_pemohon">Nama Pengaju<span>*</span></label>
                <input type="text" name="nama_pemohon" id="nama_pemohon" class="form-control" value="{{ old('nama_pemohon') }}" required placeholder="Masukan nama lengkap Anda">
            </div>
            
            <div class="form-group">
                <label class="form-label" for="whatsapp_number">Nomor WhatsApp Aktif<span>*</span></label>
                <input type="text" name="whatsapp_number" id="whatsapp_number" class="form-control" value="{{ old('whatsapp_number') }}" required placeholder="Contoh : 081234567890">
            </div>
            
            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label" for="booking_date">Tanggal<span>*</span></label>
                    <input type="date" name="booking_date" id="booking_date" class="form-control" min="{{ date('Y-m-d', strtotime('+1 day')) }}" value="{{ old('booking_date') }}" required>
                </div>
                <div class="form-group">
                    <label class="form-label" for="time_range">Waktu<span>*</span></label>
                    <select name="time_range" id="time_range" class="form-control" required>
                        <option value="">--Pilih Waktu--</option>
                        <option value="08:00 - 10:00" {{ old('time_range') == '08:00 - 10:00' ? 'selected' : '' }}>08:00 - 10:00</option>
                        <option value="10:00 - 12:00" {{ old('time_range') == '10:00 - 12:00' ? 'selected' : '' }}>10:00 - 12:00</option>
                        <option value="13:00 - 15:00" {{ old('time_range') == '13:00 - 15:00' ? 'selected' : '' }}>13:00 - 15:00</option>
                    </select>
                </div>
            </div>
            
            <button type="submit" class="btn-submit">
                Kirim Jadwal Booking &rarr;
            </button>
        </form>
    </div>

    <a href="/" class="btn-back">
        &larr; Kembali ke Beranda
    </a>

    <!-- Popup Informasi H-1 -->
    <div id="lapolpa-popup" class="lapolpa-popup-overlay">
        <div class="lapolpa-popup-card">
            <button class="lapolpa-popup-close" aria-label="Close" onclick="closePopup()">&times;</button>
            <div class="lapolpa-popup-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
            </div>
            <h3 class="lapolpa-popup-title">Informasi Penting</h3>
            <p class="lapolpa-popup-text">Untuk pengajuan jadwal konsultasi pembuatan polygon dan sketsa peta dapat diajukan <strong>H-1</strong> dari jadwal yang ditentukan.</p>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const popup = document.getElementById('lapolpa-popup');
        let popupTimer;
        
        // Tampilkan popup setelah sedikit delay untuk efek smooth
        setTimeout(() => {
            popup.classList.add('show');
            // Set timeout 10 detik untuk hilang otomatis
            popupTimer = setTimeout(() => {
                closePopup();
            }, 10000);
        }, 300);

        // Fungsi tutup popup
        window.closePopup = function() {
            popup.classList.remove('show');
            clearTimeout(popupTimer); 
        };

        // Tutup jika klik di luar modal (overlay)
        popup.addEventListener('click', function(e) {
            if (e.target === popup) {
                closePopup();
            }
        });
    });
</script>
@endsection
