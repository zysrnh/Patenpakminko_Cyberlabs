@extends('layouts.public')

@section('title', 'Kontak Kami - PATEN PAK MIKO')

@section('content')
<style>
    .contact-page {
        background-color: #F8FAFC;
        padding-top: 60px;
        padding-bottom: 0;
    }
    .contact-container {
        display: flex;
        flex-wrap: wrap;
        gap: 60px;
        margin-bottom: 60px;
    }
    
    .contact-left {
        flex: 1;
        min-width: 320px;
        max-width: 500px;
    }
    .contact-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #E0F2FE;
        color: #0369A1;
        padding: 6px 16px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 700;
        margin-bottom: 24px;
    }
    .contact-title {
        font-size: 40px;
        font-weight: 800;
        color: #00223D;
        line-height: 1.2;
        margin-bottom: 16px;
    }
    .contact-title span {
        color: #218AC9;
    }
    .contact-subtitle {
        font-size: 14.5px;
        color: #4A5568;
        line-height: 1.6;
        margin-bottom: 40px;
    }

    .contact-info-title {
        font-size: 18px;
        font-weight: 700;
        color: #00223D;
        margin-bottom: 24px;
    }
    .contact-list {
        list-style: none;
        padding: 0;
        margin: 0 0 32px 0;
    }
    .contact-list li {
        display: flex;
        align-items: flex-start;
        gap: 16px;
        margin-bottom: 20px;
    }
    .c-icon {
        width: 40px;
        height: 40px;
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #00223D;
        flex-shrink: 0;
    }
    .c-text {
        font-size: 14px;
        color: #00223D;
        line-height: 1.5;
        font-weight: 500;
        margin-top: 10px;
    }

    .btn-wa {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #00223D;
        color: #FFF;
        padding: 12px 24px;
        border-radius: 8px;
        text-decoration: none;
        font-size: 14px;
        font-weight: 700;
        transition: background 0.2s;
    }
    .btn-wa:hover {
        background: #001529;
        color: #FFF;
    }

    .contact-right {
        flex: 1;
        min-width: 320px;
    }
    .form-title {
        font-size: 18px;
        font-weight: 700;
        color: #00223D;
        margin-bottom: 24px;
    }
    .form-group {
        margin-bottom: 20px;
    }
    .form-label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: #4A5568;
        margin-bottom: 8px;
    }
    .form-control {
        width: 100%;
        padding: 14px 16px;
        border: 1px solid #E2E8F0;
        border-radius: 8px;
        background: #FFFFFF;
        font-size: 14px;
        color: #00223D;
        font-family: inherit;
        outline: none;
        transition: border-color 0.2s;
    }
    .form-control:focus {
        border-color: #218AC9;
    }
    textarea.form-control {
        resize: vertical;
        min-height: 120px;
    }
    .btn-submit {
        background: #00223D;
        color: #FFF;
        border: none;
        padding: 14px 28px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 700;
        cursor: pointer;
        transition: background 0.2s;
        font-family: inherit;
    }
    .btn-submit:hover {
        background: #001529;
    }

    .map-wrapper {
        width: 100%;
        height: 450px;
        background: #E2E8F0;
        line-height: 0;
    }
    .map-wrapper iframe {
        width: 100%;
        height: 100%;
        display: block;
    }

    @media (max-width: 768px) {
        .contact-title { font-size: 32px; }
        .contact-container { gap: 40px; }
    }
</style>

<div class="contact-page">
    <div class="container">
        <div class="contact-container">
            
            <div class="contact-left">
                <div class="contact-badge">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                    Kontak Kami
                </div>
                <h1 class="contact-title">Kami Siap <span>Membantu</span> Anda</h1>
                <p class="contact-subtitle">Jangan ragu untuk menghubungi tim kami apabila Anda membutuhkan bantuan terkait proses pengajuan layanan.</p>

                <h3 class="contact-info-title">Informasi Kontak</h3>
                <ul class="contact-list">
                    <li>
                        <div class="c-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                        </div>
                        <div class="c-text">
                            Jl. Suryakencana No. 02 Kelurahan Gununggparang, Kec. Cikole, Kode Pos 43111, Kota Sukabumi
                        </div>
                    </li>
                    <li>
                        <div class="c-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                        </div>
                        <div class="c-text" style="margin-top: 10px;">
                            +62 813-2271-2133
                        </div>
                    </li>
                    <li>
                        <div class="c-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                        </div>
                        <div class="c-text" style="margin-top: 10px;">
                            patenpakmiko@mail.com
                        </div>
                    </li>
                </ul>

                <a href="https://wa.me/6281322712133" target="_blank" class="btn-wa">
                    Chat via WhatsApp
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
                </a>

                <div style="margin-top: 32px;">
                    <h3 class="contact-info-title" style="margin-bottom: 12px;">Media Sosial Resmi</h3>
                    <div style="display: flex; flex-wrap: wrap; gap: 10px;">
                        <a href="https://www.tiktok.com/@kantahkotsukabumi" target="_blank" rel="noopener noreferrer" style="display: inline-flex; align-items: center; gap: 6px; padding: 8px 16px; background: #000000; color: #FFF; border-radius: 6px; text-decoration: none; font-size: 13px; font-weight: 600;">TikTok</a>
                        <a href="https://www.instagram.com/kantahkotasukabumi/" target="_blank" rel="noopener noreferrer" style="display: inline-flex; align-items: center; gap: 6px; padding: 8px 16px; background: #E1306C; color: #FFF; border-radius: 6px; text-decoration: none; font-size: 13px; font-weight: 600;">Instagram</a>
                        <a href="https://www.threads.com/@kantahkotasukabumi" target="_blank" rel="noopener noreferrer" style="display: inline-flex; align-items: center; gap: 6px; padding: 8px 16px; background: #101010; color: #FFF; border-radius: 6px; text-decoration: none; font-size: 13px; font-weight: 600;">Threads</a>
                        <a href="https://www.youtube.com/@kantahkotasukabumi" target="_blank" rel="noopener noreferrer" style="display: inline-flex; align-items: center; gap: 6px; padding: 8px 16px; background: #FF0000; color: #FFF; border-radius: 6px; text-decoration: none; font-size: 13px; font-weight: 600;">YouTube</a>
                        <a href="https://www.facebook.com/share/1L6H5iMc8H/" target="_blank" rel="noopener noreferrer" style="display: inline-flex; align-items: center; gap: 6px; padding: 8px 16px; background: #1877F2; color: #FFF; border-radius: 6px; text-decoration: none; font-size: 13px; font-weight: 600;">Facebook</a>
                    </div>
                </div>
            </div>

            <div class="contact-right">
                <h3 class="form-title">Form Inquiry</h3>
                <form action="#" method="POST" onsubmit="event.preventDefault(); alert('Pesan Anda berhasil dikirim!');">
                    <div class="form-group">
                        <label class="form-label">Full Name</label>
                        <input type="text" class="form-control" placeholder="Full Name" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Phone Number</label>
                        <input type="text" class="form-control" placeholder="Phone Number" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Message</label>
                        <textarea class="form-control" placeholder="Message" required></textarea>
                    </div>
                    <button type="submit" class="btn-submit">Send Inquiry</button>
                </form>
            </div>

        </div>
    </div>

    <!-- Map Full Width -->
    <div class="map-wrapper">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1980.3801373425704!2d106.92710990964812!3d-6.919236993930166!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68483119f0eb21%3A0xc96505f81ecf236f!2sJl.%20Surya%20Kencana%20No.2%2C%20Gunungparang%2C%20Kec.%20Cikole%2C%20Kota%20Sukabumi%2C%20Jawa%20Barat%2043111!5e0!3m2!1sid!2sid!4v1781316668923!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
</div>
@endsection
