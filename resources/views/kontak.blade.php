@extends('layouts.public')

@section('title', 'Hubungi Kami — PATEN PAK MIKO Kantor Pertanahan Kota Sukabumi')

@php
    $settings = [];
    if (\Illuminate\Support\Facades\Storage::disk('local')->exists('whatsapp_settings.json')) {
        $settings = json_decode(\Illuminate\Support\Facades\Storage::disk('local')->get('whatsapp_settings.json'), true) ?? [];
    }
    $address = $settings['contact_address'] ?? 'Jl. Suryakencana No. 02, Kel. Gunungparang, Kec. Cikole, Kota Sukabumi, Jawa Barat 43111';
    $phone = $settings['contact_phone'] ?? ($settings['cp_admin'] ?? '6282234523450');
    $email = $settings['contact_email'] ?? 'penataanpertanahanmiko@gmail.com';
    $mapUrl = $settings['contact_map_url'] ?? 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1980.3801373425704!2d106.92710990964812!3d-6.919236993930166!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68483119f0eb21%3A0xc96505f81ecf236f!2sJl.%20Surya%20Kencana%20No.2%2C%20Gunungparang%2C%20Kec.%20Cikole%2C%20Kota%20Sukabumi%2C%20Jawa%20Barat%2043111!5e0!3m2!1sid!2sid!4v1781316668923!5m2!1sid!2sid';

    $socialTiktok = $settings['social_tiktok'] ?? 'https://www.tiktok.com/@kantahkotsukabumi';
    $socialInstagram = $settings['social_instagram'] ?? 'https://www.instagram.com/kantahkotasukabumi/';
    $socialThreads = $settings['social_threads'] ?? 'https://www.threads.com/@kantahkotasukabumi';
    $socialYoutube = $settings['social_youtube'] ?? 'https://www.youtube.com/@kantahkotasukabumi';
    $socialFacebook = $settings['social_facebook'] ?? 'https://www.facebook.com/share/1L6H5iMc8H/';

    $cleanPhone = preg_replace('/[^0-9]/', '', $phone);
    if (str_starts_with($cleanPhone, '0')) {
        $cleanPhone = '62' . substr($cleanPhone, 1);
    }
    $waUrl = 'https://wa.me/' . $cleanPhone;
@endphp

@section('content')
<style>
    .contact-wrapper {
        background-color: #FFFFFF;
        padding: 60px 0 40px;
    }
    .contact-grid-main {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 60px;
        align-items: start;
    }

    /* Left Side Styling */
    .contact-tag-sub {
        font-size: 14px;
        font-weight: 700;
        color: #218AC9;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        margin-bottom: 12px;
    }
    .contact-main-heading {
        font-size: 44px;
        font-weight: 900;
        color: #003B64;
        line-height: 1.15;
        letter-spacing: -0.03em;
        margin-bottom: 20px;
    }
    .contact-main-heading span {
        color: #218AC9;
    }
    .contact-lead-text {
        font-size: 15px;
        color: #64748B;
        line-height: 1.6;
        margin-bottom: 36px;
        max-width: 480px;
    }

    /* Contact Details Block */
    .contact-detail-list {
        display: flex;
        flex-direction: column;
        gap: 18px;
        margin-bottom: 32px;
    }
    .contact-detail-item {
        display: flex;
        align-items: flex-start;
        gap: 14px;
    }
    .contact-detail-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        background: #F1F5F9;
        color: #003B64;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .contact-detail-content {
        font-size: 14px;
        color: #1E293B;
        line-height: 1.5;
        font-weight: 600;
    }
    .contact-detail-content span {
        display: block;
        font-size: 12px;
        color: #64748B;
        font-weight: 500;
        margin-bottom: 2px;
    }

    /* WhatsApp Button */
    .btn-wa-direct {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: #25D366;
        color: #FFFFFF;
        padding: 12px 24px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 800;
        text-decoration: none;
        box-shadow: 0 4px 14px rgba(37, 211, 102, 0.25);
        transition: all 0.2s;
        margin-bottom: 36px;
    }
    .btn-wa-direct:hover {
        background: #1EBE5D;
        color: #FFFFFF;
        transform: translateY(-2px);
    }

    /* Minimalist Bule Social Icons */
    .social-section-title {
        font-size: 13px;
        font-weight: 700;
        color: #94A3B8;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        margin-bottom: 12px;
    }
    .social-icon-row {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
    }
    .social-icon-btn {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        background: #F8FAFC;
        border: 1px solid #E2E8F0;
        color: #334155;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        transition: all 0.2s;
    }
    .social-icon-btn:hover {
        background: #003B64;
        color: #FFFFFF;
        border-color: #003B64;
        transform: translateY(-3px);
        box-shadow: 0 4px 12px rgba(0, 59, 100, 0.15);
    }

    /* Right Form Card Styling */
    .form-card-minimal {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 16px;
        padding: 36px;
        box-shadow: 0 10px 30px rgba(0, 38, 66, 0.04);
    }
    .form-card-title {
        font-size: 22px;
        font-weight: 800;
        color: #003B64;
        margin-bottom: 6px;
    }
    .form-card-sub {
        font-size: 13.5px;
        color: #64748B;
        margin-bottom: 28px;
    }
    .form-field-group {
        margin-bottom: 20px;
    }
    .form-field-label {
        display: block;
        font-size: 13px;
        font-weight: 700;
        color: #334155;
        margin-bottom: 6px;
    }
    .form-field-label span {
        color: #EF4444;
    }
    .form-field-input {
        width: 100%;
        padding: 12px 16px;
        border: 1.5px solid #CBD5E1;
        border-radius: 8px;
        font-size: 14px;
        color: #0F172A;
        background: #FFFFFF;
        outline: none;
        transition: border-color 0.2s, box-shadow 0.2s;
        font-family: inherit;
    }
    .form-field-input:focus {
        border-color: #218AC9;
        box-shadow: 0 0 0 3px rgba(33, 138, 201, 0.12);
    }
    textarea.form-field-input {
        min-height: 120px;
        resize: vertical;
    }
    .btn-send-message {
        width: 100%;
        background: #003B64;
        color: #FFFFFF;
        border: none;
        padding: 14px 24px;
        border-radius: 8px;
        font-size: 14.5px;
        font-weight: 800;
        cursor: pointer;
        transition: all 0.2s;
        margin-top: 8px;
    }
    .btn-send-message:hover {
        background: #002642;
        box-shadow: 0 4px 14px rgba(0, 38, 66, 0.2);
    }

    @media (max-width: 992px) {
        .contact-grid-main {
            grid-template-columns: 1fr;
            gap: 36px;
        }
        .contact-main-heading {
            font-size: 32px;
        }
    }

    @media (max-width: 768px) {
        .contact-wrapper {
            padding: 24px 0 32px !important;
        }
        .contact-grid-main {
            gap: 28px !important;
        }
        .contact-tag-sub {
            font-size: 12px !important;
            margin-bottom: 8px !important;
        }
        .contact-main-heading {
            font-size: 25px !important;
            line-height: 1.25 !important;
            margin-bottom: 12px !important;
        }
        .contact-lead-text {
            font-size: 13px !important;
            line-height: 1.55 !important;
            margin-bottom: 24px !important;
        }
        .contact-detail-list {
            gap: 14px !important;
            margin-bottom: 24px !important;
        }
        .contact-detail-item {
            gap: 12px !important;
        }
        .contact-detail-icon {
            width: 36px !important;
            height: 36px !important;
            border-radius: 8px !important;
        }
        .contact-detail-content {
            font-size: 13px !important;
        }
        .contact-detail-content span {
            font-size: 11px !important;
        }
        .btn-wa-direct {
            width: 100% !important;
            justify-content: center !important;
            padding: 12px 18px !important;
            font-size: 13.5px !important;
            margin-bottom: 28px !important;
        }
        .form-card-minimal {
            padding: 20px 16px !important;
            border-radius: 14px !important;
        }
        .form-card-title {
            font-size: 18px !important;
            margin-bottom: 4px !important;
        }
        .form-card-sub {
            font-size: 12.5px !important;
            margin-bottom: 20px !important;
        }
        .form-field-group {
            margin-bottom: 14px !important;
        }
        .form-field-label {
            font-size: 12px !important;
            margin-bottom: 4px !important;
        }
        .form-field-input {
            padding: 10px 12px !important;
            font-size: 14px !important;
            border-radius: 8px !important;
        }
        textarea.form-field-input {
            min-height: 90px !important;
        }
        .btn-send-message {
            padding: 12px 18px !important;
            font-size: 13.5px !important;
            border-radius: 8px !important;
        }
        .contact-map-section {
            padding: 24px 0 40px !important;
        }
        .contact-map-frame {
            height: 240px !important;
        }
    }

    @media (max-width: 480px) {
        .contact-main-heading {
            font-size: 22px !important;
        }
        .social-icon-btn {
            width: 38px !important;
            height: 38px !important;
        }
    }
</style>

<div class="contact-wrapper">
    <div class="container">
        <div class="contact-grid-main">
            
            <!-- Left Side Content -->
            <div>
                <div class="contact-tag-sub">Hubungi Kami</div>
                <h1 class="contact-main-heading">
                    Kami Siap Membantu Anda.<br>
                    <span>Mari Terhubung.</span>
                </h1>
                <p class="contact-lead-text">
                    Jangan ragu untuk menghubungi tim helpdesk PATEN PAK MIKO Kantor Pertanahan Kota Sukabumi apabila Anda membutuhkan bantuan terkait pengajuan Pertimbangan Teknis Pertanahan (PTP) maupun informasi perizinan ruang.
                </p>

                <div class="contact-detail-list">
                    <!-- Alamat -->
                    <div class="contact-detail-item">
                        <div class="contact-detail-icon">
                            <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </div>
                        <div class="contact-detail-content">
                            <span>Alamat Kantor Resmi</span>
                            {{ $address }}
                        </div>
                    </div>

                    <!-- Telepon -->
                    <div class="contact-detail-item">
                        <div class="contact-detail-icon">
                            <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        </div>
                        <div class="contact-detail-content">
                            <span>Telepon CS / WhatsApp</span>
                            +{{ $cleanPhone }}
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="contact-detail-item">
                        <div class="contact-detail-icon">
                            <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                        <div class="contact-detail-content">
                            <span>Email Official</span>
                            {{ $email }}
                        </div>
                    </div>
                </div>

                <!-- WhatsApp CS Direct Button -->
                <a href="{{ $waUrl }}" target="_blank" class="btn-wa-direct">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-1.157 4.228 4.228-1.157z"/></svg>
                    Chat Helpdesk WhatsApp
                </a>

                <!-- Minimalist Social Icons -->
                <div>
                    <div class="social-section-title">Media Sosial Resmi</div>
                    <div class="social-icon-row">
                        <!-- TikTok -->
                        <a href="{{ $socialTiktok }}" target="_blank" rel="noopener noreferrer" class="social-icon-btn" title="TikTok">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M16.6 5.82s.51.5 0 0A4.278 4.278 0 0 1 15.54 3h-3.09v12.4a2.592 2.592 0 0 1-2.59 2.5c-1.42 0-2.6-1.16-2.6-2.6 0-1.72 1.66-3.01 3.37-2.48V9.66c-3.45-.46-6.47 2.22-6.47 5.64 0 3.33 2.76 5.7 5.69 5.7 3.14 0 5.69-2.55 5.69-5.7V9.01a7.35 7.35 0 0 0 4.3 1.38V7.3s-1.88.09-3.24-1.48z"/></svg>
                        </a>
                        <!-- Instagram -->
                        <a href="{{ $socialInstagram }}" target="_blank" rel="noopener noreferrer" class="social-icon-btn" title="Instagram">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.012-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 1 0 0 12.324 6.162 6.162 0 0 0 0-12.324zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm6.406-11.845a1.44 1.44 0 1 0 0 2.881 1.44 1.44 0 0 0 0-2.881z"/></svg>
                        </a>
                        <!-- Threads -->
                        <a href="{{ $socialThreads }}" target="_blank" rel="noopener noreferrer" class="social-icon-btn" title="Threads">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M12.186 24h-.007c-3.581-.024-6.334-1.205-8.184-3.509C2.35 18.44 1.5 15.586 1.472 12.01v-.017c.03-3.579.879-6.43 2.525-8.482C5.845 1.205 8.6.024 12.18 0h.014c2.746.02 5.043.725 6.826 2.098 1.677 1.29 2.858 3.13 3.509 5.467l-2.04.569c-1.104-3.96-3.898-5.984-8.304-6.015-2.91.022-5.11.936-6.54 2.717C4.307 6.504 3.616 8.914 3.589 12c.027 3.086.718 5.496 2.057 7.164 1.43 1.781 3.631 2.695 6.54 2.717 2.623-.02 4.358-.631 5.8-2.045 1.647-1.613 1.618-3.593 1.086-4.798-.31-.705-.87-1.29-1.629-1.723-.19 1.361-.617 2.44-1.28 3.229-.878 1.048-2.132 1.63-3.774 1.665-1.238.027-2.436-.256-3.246-.902-.943-.752-1.402-1.827-1.29-3.028.108-1.163.68-2.083 1.649-2.665.98-.589 2.302-.767 3.729-.51.192.035.379.075.559.121-.017-1.098-.294-1.928-.826-2.472-.628-.643-1.596-.968-2.876-.968h-.037c-1.245.011-2.187.395-2.803 1.14l-1.622-1.291c.878-1.113 2.203-1.727 3.833-1.774h.078c1.912 0 3.427.501 4.505 1.489 1.045.958 1.605 2.328 1.663 4.07.096.03.19.061.283.094 1.446.508 2.507 1.404 3.15 2.664.74 1.447 1.096 3.941-1.049 6.077C17.63 22.98 15.303 23.98 12.186 24z"/></svg>
                        </a>
                        <!-- YouTube -->
                        <a href="{{ $socialYoutube }}" target="_blank" rel="noopener noreferrer" class="social-icon-btn" title="YouTube">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                        </a>
                        <!-- Facebook -->
                        <a href="{{ $socialFacebook }}" target="_blank" rel="noopener noreferrer" class="social-icon-btn" title="Facebook">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.494v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.325-1.325z"/></svg>
                        </a>
                    </div>
                </div>

            </div>

            <!-- Right Form Card -->
            <div class="form-card-minimal">
                <h2 class="form-card-title">Formulir Pesan / Inquiry</h2>
                <p class="form-card-sub">Silakan lengkapi formulir di bawah untuk mengirim pesan langsung ke helpdesk kami.</p>

                <form onsubmit="sendInquiryToWA(event)">
                    <div class="form-field-group">
                        <label class="form-field-label">Nama Lengkap <span>*</span></label>
                        <input type="text" id="inquiry_name" class="form-field-input" placeholder="contoh: Ridwan Kustiyadi" required>
                    </div>

                    <div class="form-field-group">
                        <label class="form-field-label">Alamat Email <span>*</span></label>
                        <input type="email" id="inquiry_email" class="form-field-input" placeholder="contoh: ridwan@company.com" required>
                    </div>

                    <div class="form-field-group">
                        <label class="form-field-label">Nomor WhatsApp <span>*</span></label>
                        <input type="text" id="inquiry_phone" class="form-field-input" placeholder="contoh: +62 812 3456 7890" required>
                    </div>

                    <div class="form-field-group">
                        <label class="form-field-label">Pesan / Pertanyaan <span>*</span></label>
                        <textarea id="inquiry_message" class="form-field-input" placeholder="Tuliskan pertanyaan atau kendala Anda di sini..." required></textarea>
                    </div>

                    <button type="submit" class="btn-send-message">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" style="margin-right: 6px; vertical-align: -3px;"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-1.157 4.228 4.228-1.157z"/></svg>
                        Kirim Pesan via WhatsApp Helpdesk
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>

<!-- Map Section Wrapped in Container -->
<div class="contact-map-section" style="background: #F8FAFC; padding: 40px 0 80px; border-top: 1px solid #E2E8F0;">
    <div class="container">
        <div style="background: #FFFFFF; border: 1px solid #E2E8F0; border-radius: 16px; padding: 24px; box-shadow: 0 4px 16px rgba(0,38,66,0.03);">
            <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 14px; margin-bottom: 20px;">
                <div>
                    <h3 style="font-size: 18px; font-weight: 800; color: #003B64; margin: 0 0 4px;">Lokasi Kantor Pertanahan Kota Sukabumi</h3>
                    <p style="font-size: 13px; color: #64748B; margin: 0;">{{ $address }} · Jam Kerja: Senin–Jumat (08.00–16.00 WIB)</p>
                </div>
                <a href="https://maps.google.com/?q={{ urlencode($address) }}" target="_blank" style="display: inline-flex; align-items: center; gap: 6px; background: #F1F5F9; color: #003B64; border: 1px solid #CBD5E1; padding: 8px 16px; border-radius: 8px; font-size: 13px; font-weight: 700; text-decoration: none;">
                    Buka Google Maps ↗
                </a>
            </div>
            <div class="contact-map-frame" style="width: 100%; height: 380px; border-radius: 12px; overflow: hidden; border: 1px solid #E2E8F0;">
                <iframe src="{{ $mapUrl }}" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
</div>

<script>
function sendInquiryToWA(event) {
    event.preventDefault();
    const name = document.getElementById('inquiry_name').value;
    const email = document.getElementById('inquiry_email').value;
    const phone = document.getElementById('inquiry_phone').value;
    const message = document.getElementById('inquiry_message').value;

    const targetPhone = "{{ $cleanPhone }}";
    const text = `Halo Helpdesk PATEN PAK MIKO,\n\nSaya ingin mengajukan pertanyaan/inquiry:\n• Nama: ${name}\n• Email: ${email}\n• WhatsApp: ${phone}\n\n*Pesan / Pertanyaan:*\n${message}`;

    const waUrl = `https://wa.me/${targetPhone}?text=${encodeURIComponent(text)}`;
    window.open(waUrl, '_blank');
}
</script>
@endsection