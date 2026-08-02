@extends('layouts.public')

@section('title', 'Hubungi Kami — PATEN PAK MIKO Kantor Pertanahan Kota Sukabumi')

@section('content')
<style>
    :root {
        --brand-navy: #003B64;
        --brand-blue: #218AC9;
        --brand-gold: #D97706;
        --brand-dark: #0F172A;
        --bg-slate: #F8FAFC;
    }

    .contact-hero {
        background: linear-gradient(135deg, #002642 0%, #003B64 50%, #0F5288 100%);
        color: #ffffff;
        padding: 64px 0 80px;
        position: relative;
        overflow: hidden;
    }
    .contact-hero::before {
        content: '';
        position: absolute;
        top: -40%;
        right: -10%;
        width: 600px;
        height: 600px;
        background: radial-gradient(circle, rgba(33,138,201,0.25) 0%, rgba(0,0,0,0) 70%);
        pointer-events: none;
    }
    .contact-hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(255, 255, 255, 0.12);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: #93C5FD;
        padding: 6px 16px;
        border-radius: 30px;
        font-size: 13px;
        font-weight: 700;
        letter-spacing: 0.02em;
        margin-bottom: 20px;
    }
    .contact-hero-title {
        font-size: 38px;
        font-weight: 800;
        letter-spacing: -0.02em;
        line-height: 1.25;
        margin-bottom: 16px;
        color: #FFFFFF;
    }
    .contact-hero-title span {
        color: #38BDF8;
        background: linear-gradient(90deg, #38BDF8, #60A5FA);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    .contact-hero-desc {
        font-size: 16px;
        color: #94A3B8;
        max-width: 680px;
        line-height: 1.6;
        margin: 0;
    }

    .contact-body {
        background: var(--bg-slate);
        padding: 60px 0 80px;
        margin-top: -30px;
        position: relative;
        z-index: 10;
        border-radius: 24px 24px 0 0;
    }

    .contact-grid {
        display: grid;
        grid-template-columns: 1fr 1.15fr;
        gap: 40px;
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
        border-radius: 12px;
        padding: 24px;
        box-shadow: 0 4px 16px rgba(0, 38, 66, 0.03);
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .info-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(0, 38, 66, 0.06);
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
        border-radius: 10px;
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
        background: linear-gradient(135deg, #059669 0%, #10B981 100%);
        color: #FFFFFF;
        border-radius: 12px;
        padding: 24px;
        box-shadow: 0 8px 20px rgba(16, 185, 129, 0.25);
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
        border-radius: 8px;
        font-size: 14px;
        font-weight: 800;
        text-decoration: none;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        transition: all 0.2s;
    }
    .wa-btn-action:hover {
        background: #ECFDF5;
        color: #065F46;
        transform: scale(1.02);
    }

    /* Social Media Grid */
    .social-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(130px, 1fr));
        gap: 10px;
        margin-top: 12px;
    }
    .social-item {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 14px;
        border-radius: 8px;
        color: #FFFFFF;
        text-decoration: none;
        font-size: 13px;
        font-weight: 700;
        transition: transform 0.2s, opacity 0.2s;
    }
    .social-item:hover {
        opacity: 0.9;
        transform: translateY(-2px);
    }
    .soc-tiktok { background: #000000; }
    .soc-instagram { background: linear-gradient(45deg, #F09433, #E6683C, #DC2743, #CC2366, #BC1888); }
    .soc-threads { background: #101010; }
    .soc-youtube { background: #FF0000; }
    .soc-facebook { background: #1877F2; }

    /* Right Side Form Card */
    .contact-form-card {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 16px;
        padding: 32px;
        box-shadow: 0 10px 30px rgba(0, 38, 66, 0.05);
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
        border-radius: 8px;
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
        background: linear-gradient(135deg, #003B64 0%, #218AC9 100%);
        color: #FFFFFF;
        border: none;
        padding: 13px 24px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 800;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        box-shadow: 0 4px 12px rgba(0, 59, 100, 0.2);
        transition: all 0.2s;
        margin-top: 8px;
    }
    .btn-submit-custom:hover {
        box-shadow: 0 6px 16px rgba(0, 59, 100, 0.3);
        transform: translateY(-1px);
    }

    /* Map Section */
    .map-section {
        background: #FFFFFF;
        border-top: 1px solid #E2E8F0;
        padding: 60px 0 0;
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
        border-radius: 0;
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
            font-size: 30px;
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
                        <a href="https://www.tiktok.com/@kantahkotsukabumi" target="_blank" rel="noopener noreferrer" class="social-item soc-tiktok">TikTok</a>
                        <a href="https://www.instagram.com/kantahkotasukabumi/" target="_blank" rel="noopener noreferrer" class="social-item soc-instagram">Instagram</a>
                        <a href="https://www.threads.com/@kantahkotasukabumi" target="_blank" rel="noopener noreferrer" class="social-item soc-threads">Threads</a>
                        <a href="https://www.youtube.com/@kantahkotasukabumi" target="_blank" rel="noopener noreferrer" class="social-item soc-youtube">YouTube</a>
                        <a href="https://www.facebook.com/share/1L6H5iMc8H/" target="_blank" rel="noopener noreferrer" class="social-item soc-facebook">Facebook</a>
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
