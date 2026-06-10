@extends('layouts.public')

@section('title', 'LAPOL PAK - PATEN PAK MIKO')

@section('content')
    <!-- Flatpickr for beautiful calendar -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    
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
        padding: 16px 20px;
        font-family: inherit;
        font-size: 14px;
        background: #F4F7FA;
        border: 1px solid #E2E8F0;
        border-radius: 5px;
        outline: none;
        transition: border .2s, background .2s;
        color: #0A1C2C;
        font-weight: 500;
    }
    .form-control:focus {
        border-color: #3291A8;
        background: #FFFFFF;
    }
    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }

    /* Icon Input Wrapper */
    .input-with-icon {
        position: relative;
    }
    .input-with-icon input {
        padding-right: 48px;
    }
    .input-with-icon svg {
        position: absolute;
        right: 18px;
        top: 50%;
        transform: translateY(-50%);
        width: 18px;
        height: 18px;
        color: #00223D;
        pointer-events: none;
    }

    /* Custom Dropdown Styling */
    .custom-select-wrapper { position: relative; }
    .custom-select-dropdown {
        position: absolute;
        top: 100%;
        left: 0; right: 0;
        background: #fff;
        border-radius: 5px;
        box-shadow: 0 15px 40px rgba(0,0,0,0.1);
        margin-top: 8px;
        z-index: 100;
        display: none;
        padding: 12px; /* Increased padding */
        border: 1px solid #E2E8F0;
    }
    .custom-select-dropdown.show { display: block; }
    .custom-option {
        padding: 16px; /* Taller options */
        text-align: center;
        background: #F4F7FA;
        color: #0A1C2C;
        border-radius: 4px;
        margin-bottom: 12px; /* Bigger gap between options to match mockup */
        cursor: pointer;
        font-weight: 500;
        font-size: 13.5px;
        transition: background .2s, color .2s;
    }
    .custom-option:last-child { margin-bottom: 0; }
    .custom-option:hover, .custom-option.selected {
        background: #0F3750; /* Match the dark blue in mockup */
        color: #fff;
    }

    /* Flatpickr Customization */
    .flatpickr-calendar {
        width: 340px !important;
        padding: 16px !important;
        box-shadow: 0 15px 40px rgba(0,0,0,0.1) !important;
        border: 1px solid #E2E8F0 !important;
        border-radius: 8px !important;
        font-family: 'Poppins', sans-serif !important;
        margin-top: 8px !important;
    }
    .flatpickr-calendar.arrowTop:before, .flatpickr-calendar.arrowTop:after,
    .flatpickr-calendar.arrowBottom:before, .flatpickr-calendar.arrowBottom:after {
        display: none !important;
    }
    .flatpickr-months {
        margin-bottom: 16px;
    }
    .flatpickr-current-month {
        font-size: 120% !important;
        font-weight: 600 !important;
        padding-top: 4px !important;
    }
    .flatpickr-weekday {
        color: #0A1C2C !important;
        font-weight: 700 !important;
        font-size: 13px !important;
    }
    .flatpickr-days, .dayContainer {
        width: 100% !important;
        min-width: 100% !important;
        max-width: 100% !important;
    }
    .flatpickr-day {
        max-width: 40px !important;
        height: 40px !important;
        line-height: 40px !important;
        font-size: 14px !important;
        font-weight: 500 !important;
        color: #555 !important;
        border-radius: 4px !important;
        margin-top: 4px !important;
    }
    .flatpickr-day.selected {
        background: #0F3750 !important;
        border-color: #0F3750 !important;
        color: #fff !important;
    }
    .flatpickr-day:hover {
        background: #F4F7FA !important;
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
                <div class="input-with-icon">
                    <input type="text" name="nama_pemohon" id="nama_pemohon" class="form-control" value="{{ old('nama_pemohon') }}" required placeholder="Masukan nama lengkap Anda">
                </div>
            </div>
            
            <div class="form-group">
                <label class="form-label" for="whatsapp_number">Nomor WhatsApp Aktif<span>*</span></label>
                <div class="input-with-icon">
                    <input type="text" name="whatsapp_number" id="whatsapp_number" class="form-control" value="{{ old('whatsapp_number') }}" required placeholder="Contoh : 081234567890">
                </div>
            </div>
            
            <div class="form-group">
                <label class="form-label">Pilih Jadwal<span>*</span></label>
                <div class="form-grid">
                    <!-- Date Picker -->
                    <div class="input-with-icon">
                        <input type="text" name="booking_date" id="booking_date" class="form-control bg-white" placeholder="Pilih Tanggal" value="{{ old('booking_date') }}" required readonly style="cursor: pointer;">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                    </div>
                    
                    <!-- Time Picker Custom Dropdown -->
                    <div class="input-with-icon custom-select-wrapper">
                        <input type="text" id="time_range_display" class="form-control" placeholder="Pilih Waktu" value="{{ old('time_range') }}" required readonly style="cursor: pointer;">
                        <input type="hidden" name="time_range" id="time_range_value" value="{{ old('time_range') }}">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline>
                        </svg>
                        
                        <div class="custom-select-dropdown" id="timeDropdown">
                            <!-- Dikembalikan ke 3 waktu asli sesuai sistem -->
                            <div class="custom-option" data-value="08:00 - 10:00">08:00 - 10:00</div>
                            <div class="custom-option" data-value="10:00 - 12:00">10:00 - 12:00</div>
                            <div class="custom-option" data-value="13:00 - 15:00">13:00 - 15:00</div>
                        </div>
                    </div>
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

    <!-- Flatpickr JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/id.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // 1. Popup Informasi H-1
            const popup = document.getElementById('lapolpa-popup');
            let popupTimer;
            
            setTimeout(() => {
                popup.classList.add('show');
                popupTimer = setTimeout(() => { closePopup(); }, 10000);
            }, 300);

            window.closePopup = function() {
                popup.classList.remove('show');
                clearTimeout(popupTimer); 
            };

            popup.addEventListener('click', function(e) {
                if (e.target === popup) closePopup();
            });

            // 2. Inisialisasi Flatpickr untuk Tanggal
            flatpickr("#booking_date", {
                locale: "id",
                dateFormat: "Y-m-d",
                altInput: true,
                altFormat: "l, j F Y", /* Contoh: Senin, 31 April 2026 */
                minDate: new Date().fp_incr(1), // Minimal besok
                disableMobile: "true"
            });

            // 3. Custom Dropdown Logic untuk Waktu
            const timeDisplay = document.getElementById('time_range_display');
            const timeValue = document.getElementById('time_range_value');
            const dropdown = document.getElementById('timeDropdown');
            const options = dropdown.querySelectorAll('.custom-option');

            // Set initial selected visual if old() value exists
            if (timeValue.value) {
                options.forEach(opt => {
                    if (opt.dataset.value === timeValue.value) opt.classList.add('selected');
                });
            }

            // Toggle dropdown
            timeDisplay.addEventListener('click', function(e) {
                e.stopPropagation();
                dropdown.classList.toggle('show');
            });

            // Pilih opsi
            options.forEach(opt => {
                opt.addEventListener('click', function() {
                    // Update value
                    const val = this.dataset.value;
                    const text = this.innerText;
                    timeDisplay.value = text;
                    timeValue.value = val;

                    // Update UI
                    options.forEach(o => o.classList.remove('selected'));
                    this.classList.add('selected');
                    
                    dropdown.classList.remove('show');
                });
            });

            // Tutup dropdown kalau klik di luar
            document.addEventListener('click', function(e) {
                if (!e.target.closest('.custom-select-wrapper')) {
                    dropdown.classList.remove('show');
                }
            });
        });
    </script>
@endsection
