@extends('layouts.public')

@section('title', 'Hubungi Kami — PATEN PAK MIKO Kantor Pertanahan Kota Sukabumi')

@section('content')
<style>
    :root {
        --brand-navy: #003B64;
        --brand-navy-dark: #002A48;
        --brand-blue: #218AC9;
        --brand-gold: #D97706;
        --brand-dark: #0F172A;
        --bg-slate: #F8FAFC;
        --radius-sm: 4px;
        --radius-md: 6px;
        --radius-lg: 8px;
    }

    .contact-hero {
        background: var(--brand-navy);
        color: #ffffff;
        padding: 56px 0 72px;
    }
    .contact-hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(255, 255, 255, 0.12);
        border: 1px solid rgba(255, 255, 255, 0.25);
        color: #BFDBFE;
        padding: 6px 14px;
        border-radius: var(--radius-sm);
        font-size: 13px;
        font-weight: 700;
        letter-spacing: 0.02em;
        margin-bottom: 18px;
    }
    .contact-hero-title {
        font-size: 36px;
        font-weight: 800;
        letter-spacing: -0.02em;
        line-height: 1.25;
        margin-bottom: 14px;
        color: #FFFFFF;
    }
    .contact-hero-title span {
        color: #7DD3FC;
    }
    .contact-hero-desc {
        font-size: 16px;
        color: #B9C6D6;
        max-width: 680px;
        line-height: 1.6;
        margin: 0;
    }

    .contact-body {
        background: var(--bg-slate);
        padding: 56px 0 80px;
        margin-top: -20px;
        position: relative;
        z-index: 10;
        border-radius: var(--radius-lg) var(--radius-lg) 0 0;
    }

    .contact-grid {
        display: grid;
        grid-template-columns: 1fr 1.15fr;
        gap: 32px;
        align-items: start;
    }

    /* Left Side Info Cards */
    .info-card-group {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }
    .info-card {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: var(--radius-lg);
        padding: 24px;
        box-shadow: 0 1px 3px rgba(0, 38, 66, 0.04);
        transition: box-shadow 0.2s;
    }
    .info-card:hover {
        box-shadow: 0 4px 12px rgba(0, 38, 66, 0.06);
    }
    .info-header {
        display: flex;
        align-items: center;
        gap: 14px;
        margin-bottom: 12px;
    }
    .info-icon-wrapper {
        width: 44px;
        height: 44px;
        border-radius: var(--radius-md);
        background: #EFF6FF;
        color: #0284C7;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .info-card-title {
        font-size: 16px;
        font-weight: 800;
        color: var(--brand-dark);
        margin: 0;
    }
    .info-card-text {
        font-size: 14px;
        color: #475569;
        line-height: 1.6;
        margin: 0;
    }

    /* WhatsApp Highlight Card */
    .wa-highlight-card {
        background: #059669;
        color: #FFFFFF;
        border-radius: var(--radius-lg);
        padding: 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        flex-wrap: wrap;
    }
    .wa-btn-action {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: #FFFFFF;
        color: #047857;
        padding: 12px 22px;
        border-radius: var(--radius-md);
        font-size: 14px;
        font-weight: 800;
        text-decoration: none;
        transition: background 0.2s;
    }
    .wa-btn-action:hover {
        background: #ECFDF5;
    }

    /* Social Media Row */
    .social-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 12px;
    }
    .social-item {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 14px;
        border-radius: var(--radius-md);
        color: #FFFFFF;
        text-decoration: none;
        font-size: 13px;
        font-weight: 700;
        transition: opacity 0.2s;
    }
    .social-item svg {
        flex-shrink: 0;
    }
    .social-item:hover {
        opacity: 0.85;
    }
    .soc-tiktok { background: #000000; }
    .soc-instagram { background: #C13584; }
    .soc-threads { background: #000000; }
    .soc-youtube { background: #FF0000; }
    .soc-facebook { background: #1877F2; }

    /* Right Side Form Card */
    .contact-form-card {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: var(--radius-lg);
        padding: 32px;
        box-shadow: 0 1px 3px rgba(0, 38, 66, 0.04);
    }
    .form-head-title {
        font-size: 20px;
        font-weight: 800;
        color: var(--brand-dark);
        margin-bottom: 6px;
    }
    .form-head-sub {
        font-size: 13.5px;
        color: #64748B;
        margin-bottom: 24px;
    }
    .form-group-custom {
        margin-bottom: 18px;
    }
    .form-label-custom {
        display: block;
        font-size: 13px;
        font-weight: 700;
        color: #334155;
        margin-bottom: 6px;
    }
    .form-label-custom span {
        color: #EF4444;
    }
    .input-wrapper {
        position: relative;
    }
    .input-icon {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #94A3B8;
        width: 18px;
        height: 18px;
        pointer-events: none;
    }
    .form-control-custom {
        width: 100%;
        padding: 11px 14px 11px 42px;
        border: 1.5px solid #CBD5E1;
        border-radius: var(--radius-md);
        font-size: 13.5px;
        color: #0F172A;
        background: #FFFFFF;
        outline: none;
        transition: border-color 0.2s, box-shadow 0.2s;
        font-family: inherit;
    }
    .form-control-custom:focus {
        border-color: var(--brand-blue);
        box-shadow: 0 0 0 3px rgba(33, 138, 201, 0.12);
    }
    select.form-control-custom {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2064748B'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 14px center;
        background-size: 16px;
        cursor: pointer;
    }
    textarea.form-control-custom {
        padding-left: 14px;
        min-height: 110px;
        resize: vertical;
    }
    .btn-submit-custom {
        width: 100%;
        background: var(--brand-navy);
        color: #FFFFFF;
        border: none;
        padding: 13px 24px;
        border-radius: var(--radius-md);
        font-size: 14px;
        font-weight: 800;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: background 0.2s;
        margin-top: 8px;
    }
    .btn-submit-custom:hover {
        background: var(--brand-navy-dark);
    }

    /* Map Section */
    .map-section {
        background: #FFFFFF;
        border-top: 1px solid #E2E8F0;
        padding: 56px 0 0;
    }
    .map-header {
        text-align: center;
        margin-bottom: 30px;
    }
    .map-title {
        font-size: 24px;
        font-weight: 800;
        color: var(--brand-dark);
        margin-bottom: 8px;
    }
    .map-sub {
        font-size: 14px;
        color: #64748B;
    }
    .map-frame-wrap {
        width: 100%;
        height: 440px;
        overflow: hidden;
        box-shadow: inset 0 2px 6px rgba(0,0,0,0.05);
    }
    .map-frame-wrap iframe {
        width: 100%;
        height: 100%;
        border: 0;
    }

    @media (max-width: 992px) {
        .contact-grid {
            grid-template-columns: 1fr;
        }
        .contact-hero-title {
            font-size: 28px;
        }
    }
</style>

<!-- Hero Section -->
<div class="contact-hero">
    <div class="container">
        <div class="contact-hero-badge">
            <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            Pusat Bantuan & Layanan Kontak
        </div>
        <h1 class="contact-hero-title">Kami Siap <span>Membantu</span> Permohonan Anda</h1>
        <p class="contact-hero-desc">
            Punya pertanyaan mengenai Pertimbangan Teknis Pertanahan (PTP), PKKPR, atau layanan tata ruang lainnya? Tim Layanan PATEN PAK MIKO Kantor Pertanahan Kota Sukabumi siap memandu Anda.
        </p>
    </div>
</div>

<!-- Main Section -->
<div class="contact-body">
    <div class="container">
        <div class="contact-grid">

            <!-- Left Info Panel -->
            <div class="info-card-group">

                <!-- Card Alamat -->
                <div class="info-card">
                    <div class="info-header">
                        <div class="info-icon-wrapper">
                            <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </div>
                        <div>
                            <h3 class="info-card-title">Alamat Kantor Pertanahan</h3>
                            <span style="font-size: 12px; color: #0284C7; font-weight: 700;">Kota Sukabumi — Jawa Barat</span>
                        </div>
                    </div>
                    <p class="info-card-text">
                        Jl. Suryakencana No. 02, Kelurahan Gunungparang, Kecamatan Cikole, Kode Pos 43111, Kota Sukabumi
                    </p>
                </div>

                <!-- Card Kontak Layanan & Jam Operasional -->
                <div class="info-card">
                    <div class="info-header">
                        <div class="info-icon-wrapper" style="background: #F0FDF4; color: #16A34A;">
                            <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        </div>
                        <div>
                            <h3 class="info-card-title">Telepon & WhatsApp Helpdesk</h3>
                            <span style="font-size: 12px; color: #16A34A; font-weight: 700;">● Jam Operasional: 08.00 - 16.00 WIB</span>
                        </div>
                    </div>
                    <div style="font-size: 14px; color: #334155; line-height: 1.8;">
                        <div><strong>Telepon CS:</strong> +62 813-2271-2133</div>
                        <div><strong>Email Resmi:</strong> patenpakmiko@mail.com</div>
                    </div>
                </div>

                <!-- Banner WhatsApp CS Direct -->
                <div class="wa-highlight-card">
                    <div>
                        <div style="font-size: 12px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.05em; opacity: 0.9; margin-bottom: 4px;">Konsultasi Cepat</div>
                        <div style="font-size: 17px; font-weight: 800; line-height: 1.3;">Butuh Bantuan Langsung via WhatsApp?</div>
                        <div style="font-size: 12.5px; opacity: 0.9; margin-top: 4px;">Terhubung dengan petugas helpdesk secara real-time.</div>
                    </div>
                    <a href="https://wa.me/6281322712133" target="_blank" class="wa-btn-action">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-1.157 4.228 4.228-1.157z"/></svg>
                        Chat Helpdesk WA
                    </a>
                </div>

                <!-- Media Sosial Card -->
                <div class="info-card">
                    <h3 class="info-card-title" style="margin-bottom: 6px;">Media Sosial Resmi</h3>
                    <p style="font-size: 13px; color: #64748B; margin-bottom: 14px;">Ikuti kanal berita dan pengumuman resmi Kantah Kota Sukabumi:</p>
                    <div class="social-grid">
                        <a href="https://www.tiktok.com/@kantahkotsukabumi" target="_blank" rel="noopener noreferrer" class="social-item soc-tiktok">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M16.6 5.82s.51.5 0 0A4.278 4.278 0 0 1 15.54 3h-3.09v12.4a2.592 2.592 0 0 1-2.59 2.5c-1.42 0-2.6-1.16-2.6-2.6 0-1.72 1.66-3.01 3.37-2.48V9.66c-3.45-.46-6.47 2.22-6.47 5.64 0 3.33 2.76 5.7 5.69 5.7 3.14 0 5.69-2.55 5.69-5.7V9.01a7.35 7.35 0 0 0 4.3 1.38V7.3s-1.88.09-3.24-1.48z"/></svg>
                            TikTok
                        </a>
                        <a href="https://www.instagram.com/kantahkotasukabumi/" target="_blank" rel="noopener noreferrer" class="social-item soc-instagram">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.012-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 1 0 0 12.324 6.162 6.162 0 0 0 0-12.324zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm6.406-11.845a1.44 1.44 0 1 0 0 2.881 1.44 1.44 0 0 0 0-2.881z"/></svg>
                            Instagram
                        </a>
                        <a href="https://www.threads.com/@kantahkotasukabumi" target="_blank" rel="noopener noreferrer" class="social-item soc-threads">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12.186 24h-.007c-3.581-.024-6.334-1.205-8.184-3.509C2.35 18.44 1.5 15.586 1.472 12.01v-.017c.03-3.579.879-6.43 2.525-8.482C5.845 1.205 8.6.024 12.18 0h.014c2.746.02 5.043.725 6.826 2.098 1.677 1.29 2.858 3.13 3.509 5.467l-2.04.569c-1.104-3.96-3.898-5.984-8.304-6.015-2.91.022-5.11.936-6.54 2.717C4.307 6.504 3.616 8.914 3.589 12c.027 3.086.718 5.496 2.057 7.164 1.43 1.781 3.631 2.695 6.54 2.717 2.623-.02 4.358-.631 5.8-2.045 1.647-1.613 1.618-3.593 1.086-4.798-.31-.705-.87-1.29-1.629-1.723-.19 1.361-.617 2.44-1.28 3.229-.878 1.048-2.132 1.63-3.774 1.665-1.238.027-2.436-.256-3.246-.902-.943-.752-1.402-1.827-1.29-3.028.108-1.163.68-2.083 1.649-2.665.98-.589 2.302-.767 3.729-.51.192.035.379.075.559.121-.017-1.098-.294-1.928-.826-2.472-.628-.643-1.596-.968-2.876-.968h-.037c-1.245.011-2.187.395-2.803 1.14l-1.622-1.291c.878-1.113 2.203-1.727 3.833-1.774h.078c1.912 0 3.427.501 4.505 1.489 1.045.958 1.605 2.328 1.663 4.07.096.03.19.061.283.094 1.446.508 2.507 1.404 3.15 2.664.74 1.447 1.096 3.941-1.049 6.077C17.63 22.98 15.303 23.98 12.186 24z"/></svg>
                            Threads
                        </a>
                        <a href="https://www.youtube.com/@kantahkotasukabumi" target="_blank" rel="noopener noreferrer" class="social-item soc-youtube">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                            YouTube
                        </a>
                        <a href="https://www.facebook.com/share/1L6H5iMc8H/" target="_blank" rel="noopener noreferrer" class="social-item soc-facebook">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.494v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.325-1.325z"/></svg>
                            Facebook
                        </a>
                    </div>
                </div>

            </div>

            <!-- Right Form Panel -->
            <div class="contact-form-card">
                <h2 class="form-head-title">Formulir Pesan & Inquiry</h2>
                <p class="form-head-sub">Kirimkan pertanyaan atau permohonan informasi Anda melalui formulir resmi di bawah ini.</p>

                <form action="#" method="POST" onsubmit="event.preventDefault(); alert('Pesan Anda telah berhasil dikirim ke Helpdesk PATEN PAK MIKO!');">

                    <div class="form-group-custom">
                        <label class="form-label-custom">Nama Lengkap <span>*</span></label>
                        <div class="input-wrapper">
                            <svg class="input-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            <input type="text" class="form-control-custom" placeholder="Masukkan nama lengkap Anda..." required>
                        </div>
                    </div>

                    <div class="form-group-custom">
                        <label class="form-label-custom">Alamat Email <span>*</span></label>
                        <div class="input-wrapper">
                            <svg class="input-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            <input type="email" class="form-control-custom" placeholder="contoh: nama@email.com" required>
                        </div>
                    </div>

                    <div class="form-group-custom">
                        <label class="form-label-custom">Nomor WhatsApp / Telepon <span>*</span></label>
                        <div class="input-wrapper">
                            <svg class="input-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            <input type="text" class="form-control-custom" placeholder="08xxxxxxxxxx" required>
                        </div>
                    </div>

                    <div class="form-group-custom">
                        <label class="form-label-custom">Kategori Layanan Pertanyaan <span>*</span></label>
                        <div class="input-wrapper">
                            <svg class="input-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                            <select class="form-control-custom" required>
                                <option value="">-- Pilih Kategori Layanan --</option>
                                <option value="berusaha">Pertimbangan Teknis Pertanahan PKKPR Berusaha</option>
                                <option value="non_berusaha">PKKPR Non-Berusaha</option>
                                <option value="kebijakan">Kebijakan Khusus Pemanfaatan Ruang</option>
                                <option value="tanah_timbul">Pertimbangan Teknis Tanah Timbul</option>
                                <option value="psn">Proyek Strategis Nasional (PSN)</option>
                                <option value="lainnya">Pertanyaan Umum / Helpdesk</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group-custom">
                        <label class="form-label-custom">Pesan / Pertanyaan Anda <span>*</span></label>
                        <textarea class="form-control-custom" placeholder="Tuliskan pertanyaan atau informasi yang Anda butuhkan secara jelas..." required></textarea>
                    </div>

                    <button type="submit" class="btn-submit-custom">
                        <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                        Kirim Pesan Konsultasi
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>

<!-- Map Section -->
<div class="map-section">
    <div class="container" style="margin-bottom: 24px;">
        <div class="map-header">
            <h2 class="map-title">Lokasi Kantor Pertanahan Kota Sukabumi</h2>
            <p class="map-sub">Kunjungi kantor pelayanan kami pada jam kerja operasional (Senin – Jumat: 08.00 - 16.00 WIB)</p>
        </div>
    </div>
    <div class="map-frame-wrap">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1980.3801373425704!2d106.92710990964812!3d-6.919236993930166!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68483119f0eb21%3A0xc96505f81ecf236f!2sJl.%20Surya%20Kencana%20No.2%2C%20Gunungparang%2C%20Kec.%20Cikole%2C%20Kota%20Sukabumi%2C%20Jawa%20Barat%2043111!5e0!3m2!1sid!2sid!4v1781316668923!5m2!1sid!2sid" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
</div>
@endsection