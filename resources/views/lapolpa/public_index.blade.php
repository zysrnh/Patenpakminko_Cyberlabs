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
        padding: 40px 16px;
        flex: 1;
        justify-content: center;
        min-height: calc(100vh - 140px);
    }
    .lapolpa-badge {
        background-color: #E6F3FA;
        color: var(--blue-dk);
        padding: 6px 14px;
        border-radius: 4px;
        font-size: 11.5px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        margin-bottom: 16px;
    }
    .lapolpa-badge svg {
        width: 14px;
        height: 14px;
    }
    .lapolpa-title {
        font-size: 24px;
        font-weight: 800;
        color: var(--ink);
        text-align: center;
        margin-bottom: 8px;
    }
    .lapolpa-title span {
        color: #003B64;
    }
    .lapolpa-subtitle {
        text-align: center;
        font-size: 13px;
        color: var(--mid);
        max-width: 480px;
        margin-bottom: 28px;
        line-height: 1.5;
    }
    .lapolpa-card {
        background: #FFFFFF;
        border-radius: 4px;
        border: 1px solid #E2E8F0;
        box-shadow: 0 4px 20px rgba(0, 59, 100, 0.06);
        width: 100%;
        max-width: 580px;
        padding: 32px 28px;
        margin-bottom: 24px;
    }
    .form-group {
        margin-bottom: 18px;
    }
    .form-label {
        display: block;
        font-size: 12.5px;
        font-weight: 700;
        margin-bottom: 6px;
        color: var(--ink);
    }
    .form-label span {
        color: #E53E3E;
    }
    .form-control {
        width: 100%;
        padding: 12px 14px;
        font-family: inherit;
        font-size: 13.5px;
        background: #F4F7FA;
        border: 1px solid #CBD5E1;
        border-radius: 4px;
        outline: none;
        transition: border .2s, background .2s;
        color: #0A1C2C;
        font-weight: 500;
    }
    .form-control:focus {
        border-color: #218AC9;
        background: #FFFFFF;
    }
    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 14px;
    }

    /* Icon Input Wrapper */
    .input-with-icon {
        position: relative;
    }
    .input-with-icon input {
        padding-right: 42px;
    }
    .input-with-icon svg {
        position: absolute;
        right: 14px;
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
        border-radius: 4px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.12);
        margin-top: 6px;
        z-index: 100;
        display: none;
        padding: 10px;
        border: 1px solid #CBD5E1;
    }
    .custom-select-dropdown.show { display: block; }
    .custom-option {
        padding: 12px;
        text-align: center;
        background: #F4F7FA;
        color: #0A1C2C;
        border-radius: 3px;
        margin-bottom: 8px;
        cursor: pointer;
        font-weight: 600;
        font-size: 13px;
        transition: background .2s, color .2s;
    }
    .custom-option:last-child { margin-bottom: 0; }
    .custom-option:hover, .custom-option.selected {
        background: #003B64;
        color: #fff;
    }

    /* Flatpickr Customization Responsive */
    .flatpickr-calendar {
        width: calc(100vw - 32px) !important;
        max-width: 320px !important;
        padding: 12px !important;
        box-shadow: 0 10px 30px rgba(0,0,0,0.12) !important;
        border: 1px solid #CBD5E1 !important;
        border-radius: 4px !important;
        font-family: 'Poppins', sans-serif !important;
        margin-top: 6px !important;
    }
    .flatpickr-calendar.arrowTop:before, .flatpickr-calendar.arrowTop:after,
    .flatpickr-calendar.arrowBottom:before, .flatpickr-calendar.arrowBottom:after {
        display: none !important;
    }
    .flatpickr-months {
        margin-bottom: 12px;
    }
    .flatpickr-current-month {
        font-size: 110% !important;
        font-weight: 600 !important;
        padding-top: 4px !important;
    }
    .flatpickr-weekday {
        color: #0A1C2C !important;
        font-weight: 700 !important;
        font-size: 12px !important;
    }
    .flatpickr-days, .dayContainer {
        width: 100% !important;
        min-width: 100% !important;
        max-width: 100% !important;
    }
    .flatpickr-day {
        max-width: 36px !important;
        height: 36px !important;
        line-height: 36px !important;
        font-size: 13px !important;
        font-weight: 500 !important;
        color: #475569 !important;
        border-radius: 3px !important;
        margin-top: 2px !important;
    }
    .flatpickr-day.selected {
        background: #003B64 !important;
        border-color: #003B64 !important;
        color: #fff !important;
    }
    .flatpickr-day:hover {
        background: #F4F7FA !important;
    }
    .flatpickr-day.holiday-or-weekend {
        color: #E53E3E !important;
        font-weight: 700 !important;
    }
    .flatpickr-day.holiday-or-weekend.flatpickr-disabled {
        color: #E53E3E !important;
        background: #FCE8E6 !important;
        opacity: 0.6;
    }

    .btn-submit {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        width: 100%;
        padding: 13px;
        background: #003B64;
        color: #fff;
        border: none;
        border-radius: 4px;
        font-family: inherit;
        font-size: 13.5px;
        font-weight: 700;
        cursor: pointer;
        transition: background .2s;
        margin-top: 8px;
    }
    .btn-submit:hover {
        background: #00223D;
    }
    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 9px 16px;
        background: #E6F3FA;
        color: var(--blue-dk);
        font-size: 12.5px;
        font-weight: 700;
        text-decoration: none;
        border-radius: 4px;
        transition: background .2s;
    }
    .btn-back:hover {
        background: #d4ecf8;
    }
    .alert {
        padding: 12px 14px;
        border-radius: 4px;
        font-size: 13px;
        font-weight: 500;
        margin-bottom: 20px;
        display: flex;
        gap: 10px;
    }
    .alert svg { width: 18px; height: 18px; flex-shrink: 0; }
    .alert-error { background: #FCE8E6; border: 1px solid #F8B4B4; color: #C5221F; }
    
    /* Popup Modal Styling */
    .lapolpa-popup-overlay {
        position: fixed;
        top: 0; left: 0; right: 0; bottom: 0;
        background: rgba(0, 34, 61, 0.65);
        z-index: 9999;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 16px;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.3s ease, visibility 0.3s ease;
    }
    .lapolpa-popup-overlay.show {
        opacity: 1;
        visibility: visible;
    }
    .lapolpa-popup-card {
        background: #fff;
        border-radius: 4px;
        width: 100%;
        max-width: 420px;
        max-height: 88vh;
        overflow-y: auto;
        padding: 28px 20px;
        text-align: center;
        position: relative;
        transform: translateY(20px) scale(0.95);
        transition: transform 0.3s ease;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
    }
    .lapolpa-popup-overlay.show .lapolpa-popup-card {
        transform: translateY(0) scale(1);
    }
    .lapolpa-popup-close {
        position: absolute;
        top: 10px;
        right: 10px;
        background: transparent;
        border: none;
        font-size: 22px;
        line-height: 1;
        color: #94A3B8;
        cursor: pointer;
        padding: 4px;
        transition: color 0.2s;
    }
    .lapolpa-popup-close:hover {
        color: #003B64;
    }
    .lapolpa-popup-icon {
        width: 46px;
        height: 46px;
        background: #E6F3FA;
        color: #218AC9;
        border-radius: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 14px;
    }
    .lapolpa-popup-icon svg {
        width: 24px;
        height: 24px;
    }
    .lapolpa-popup-title {
        font-size: 16px;
        font-weight: 800;
        color: #003B64;
        margin-bottom: 8px;
    }
    .lapolpa-popup-text {
        font-size: 13px;
        color: #475569;
        line-height: 1.5;
        margin-bottom: 0;
    }
    .lapolpa-popup-text strong {
        color: #003B64;
    }

    @media (max-width: 767px) {
        .lapolpa-wrapper {
            padding: 24px 12px;
        }
        .form-grid { 
            grid-template-columns: 1fr; 
            gap: 14px; 
        }
        .lapolpa-card { 
            padding: 20px 16px; 
        }
        .lapolpa-title { 
            font-size: 20px; 
        }
    }
</style>

<div class="lapolpa-wrapper">
    <!-- Logo LAPOL PAK -->
    <img src="{{ asset('storage/logo/Lapolpak.png') }}" alt="Logo LAPOL PAK" style="max-width: 85%; width: 260px; height: auto; margin-bottom: 24px;">

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
                <label class="form-label" for="nama_pemohon">Nama Pemohon / Pengguna Layanan<span>*</span></label>
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
            <p class="lapolpa-popup-text">Untuk permohonan jadwal konsultasi pembuatan polygon dan sketsa peta dapat dimohonkan <strong>H-1</strong> dari jadwal yang ditentukan.</p>
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
        const holidays = @json($holidays ?? []);

        flatpickr("#booking_date", {
            locale: "id",
            dateFormat: "Y-m-d",
            altInput: true,
            altFormat: "l, j F Y",
            minDate: new Date().fp_incr(1),
            disableMobile: "true",
            disable: [
                function(date) {
                    const y = date.getFullYear();
                    const m = String(date.getMonth() + 1).padStart(2, '0');
                    const d = String(date.getDate()).padStart(2, '0');
                    const formattedDate = `${y}-${m}-${d}`;

                    return (date.getDay() === 0 || date.getDay() === 6 || holidays.includes(formattedDate));
                }
            ],
            onDayCreate: function(dObj, dStr, fp, dayElem) {
                const date = dayElem.dateObj;
                const y = date.getFullYear();
                const m = String(date.getMonth() + 1).padStart(2, '0');
                const d = String(date.getDate()).padStart(2, '0');
                const formattedDate = `${y}-${m}-${d}`;

                if (date.getDay() === 0 || date.getDay() === 6 || holidays.includes(formattedDate)) {
                    dayElem.classList.add('holiday-or-weekend');
                }
            }
        });

        // 3. Custom Dropdown Logic untuk Waktu
        const timeDisplay = document.getElementById('time_range_display');
        const timeValue = document.getElementById('time_range_value');
        const dropdown = document.getElementById('timeDropdown');
        const options = dropdown.querySelectorAll('.custom-option');

        if (timeValue.value) {
            options.forEach(opt => {
                if (opt.dataset.value === timeValue.value) opt.classList.add('selected');
            });
        }

        timeDisplay.addEventListener('click', function(e) {
            e.stopPropagation();
            dropdown.classList.toggle('show');
        });

        options.forEach(opt => {
            opt.addEventListener('click', function() {
                const val = this.dataset.value;
                const text = this.innerText;
                timeDisplay.value = text;
                timeValue.value = val;

                options.forEach(o => o.classList.remove('selected'));
                this.classList.add('selected');
                
                dropdown.classList.remove('show');
            });
        });

        document.addEventListener('click', function(e) {
            if (!e.target.closest('.custom-select-wrapper')) {
                dropdown.classList.remove('show');
            }
        });
    });
</script>
@endsection
