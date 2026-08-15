@extends('layouts.app')

@section('title', 'Kelola Halaman Kontak Publik — PATEN PAK MIKO')
@section('page-title', 'Kelola Halaman Kontak Publik')

@section('extra-styles')
    .info-callout {
        background: #F0F7FF;
        border: 1.5px solid #BAE6FD;
        border-radius: 12px;
        padding: 18px 20px;
        margin-bottom: 24px;
        display: flex;
        align-items: flex-start;
        gap: 14px;
    }
    .info-callout-icon {
        color: #0284C7;
        flex-shrink: 0;
        margin-top: 2px;
    }
    .info-callout-title {
        font-size: 14px;
        font-weight: 700;
        color: #0369A1;
        margin-bottom: 4px;
    }
    .info-callout-desc {
        font-size: 12.5px;
        color: #0C4A6E;
        line-height: 1.6;
        margin: 0;
    }
    .info-callout-desc code {
        background: rgba(2, 132, 199, 0.12);
        color: #0284C7;
        padding: 2px 7px;
        border-radius: 4px;
        font-family: 'DM Mono', monospace;
        font-size: 11.5px;
        font-weight: 600;
    }

    .form-panel-box {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 16px;
        padding: 28px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.02);
    }
    .form-panel-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-bottom: 18px;
        margin-bottom: 24px;
        border-bottom: 1.5px solid #F1F5F9;
    }
    .form-panel-title {
        font-size: 16px;
        font-weight: 800;
        color: #0F172A;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .form-grid-item {
        background: #F8FAFC;
        border: 1.5px solid #E2E8F0;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 20px;
        transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
    }
    .form-grid-item:focus-within {
        background: #FFFFFF;
        border-color: #218AC9;
        box-shadow: 0 2px 8px rgba(33, 138, 201, 0.08);
    }
    .item-head {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 14px;
    }
    .item-icon-badge {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        flex-shrink: 0;
    }
    .item-label {
        font-size: 14px;
        font-weight: 700;
        color: #0F172A;
    }
    .item-sub {
        font-size: 12px;
        color: #64748B;
        margin-top: 2px;
    }

    .custom-input {
        width: 100%;
        padding: 11px 14px;
        border: 1.5px solid #CBD5E1;
        border-radius: 8px;
        font-size: 13.5px;
        color: #0F172A;
        background: #FFFFFF;
        outline: none;
        transition: border-color 0.2s;
        font-family: inherit;
    }
    .custom-input:focus {
        border-color: #218AC9;
    }
    textarea.custom-input {
        resize: vertical;
        line-height: 1.5;
    }
    .code-input {
        font-family: 'DM Mono', monospace;
        font-size: 12.5px;
        color: #003B64;
        background: #FFFFFF;
    }

    .map-preview-wrap {
        margin-top: 16px;
        border-radius: 10px;
        overflow: hidden;
        border: 1.5px solid #CBD5E1;
        background: #F1F5F9;
        height: 240px;
        position: relative;
    }
    .map-preview-badge {
        position: absolute;
        top: 12px;
        left: 12px;
        background: #0F172A;
        color: #FFFFFF;
        padding: 4px 10px;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 700;
        z-index: 10;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .btn-submit-main {
        background: #003B64;
        color: white;
        border: none;
        padding: 12px 28px;
        font-size: 14px;
        font-weight: 700;
        border-radius: 10px;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        transition: background 0.2s;
    }
    .btn-submit-main:hover {
        background: #002B4A;
    }

    /* ─── MOBILE RESPONSIVE ────────────────────────────── */
    @media (max-width: 768px) {
        .page-header h1 {
            font-size: 15px !important;
            word-break: break-word !important;
            line-height: 1.4 !important;
        }
        .page-header p {
            font-size: 11px !important;
            word-break: break-word !important;
        }
        .info-callout {
            flex-direction: column !important;
            gap: 8px !important;
            padding: 12px 10px !important;
            max-width: 100% !important;
            box-sizing: border-box !important;
        }
        .info-callout-title {
            font-size: 13px !important;
            word-break: break-word !important;
        }
        .info-callout-desc {
            font-size: 11.5px !important;
            word-break: break-word !important;
        }
        .info-callout-desc code {
            word-break: break-all !important;
            white-space: normal !important;
            display: inline-block !important;
            max-width: 100% !important;
            font-size: 10.5px !important;
        }
        .form-panel-box {
            padding: 12px 10px !important;
            border-radius: 10px !important;
            max-width: 100% !important;
            box-sizing: border-box !important;
        }
        .form-panel-title {
            font-size: 14px !important;
            word-break: break-word !important;
        }
        .form-grid-item {
            padding: 12px 10px !important;
            border-radius: 8px !important;
            max-width: 100% !important;
            box-sizing: border-box !important;
        }
        .item-head {
            flex-direction: row !important;
            align-items: center !important;
            gap: 10px !important;
        }
        .item-icon-badge {
            width: 32px !important;
            height: 32px !important;
            border-radius: 6px !important;
        }
        .item-label {
            font-size: 13px !important;
            word-break: break-word !important;
        }
        .item-sub {
            font-size: 11px !important;
            word-break: break-word !important;
        }
        .custom-input {
            padding: 8px 10px !important;
            font-size: 12px !important;
            word-break: break-all !important;
            max-width: 100% !important;
            box-sizing: border-box !important;
        }
        .btn-submit-main {
            width: 100% !important;
            justify-content: center !important;
            font-size: 13px !important;
            padding: 10px 16px !important;
        }
        .map-preview-wrap {
            height: 180px !important;
        }
    }
@endsection

@section('content')
<div class="page-header">
    <div class="page-header-left">
        <div class="breadcrumb">
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <span>›</span>
            <span>Kelola Halaman Kontak</span>
        </div>
        <h1>
            <svg style="width:24px;height:24px;vertical-align:-4px;margin-right:8px;color:var(--blue);" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            Kelola Informasi Halaman Kontak Publik (/kontak)
        </h1>
        <p>Atur informasi alamat, nomor WhatsApp CS helpdesk, email resmi, serta kode sematan Google Maps untuk halaman kontak publik.</p>
    </div>
</div>

@if($errors->any())
    <div class="alert alert-error" style="display: block; margin-bottom: 24px;">
        @foreach($errors->all() as $err)
            <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 4px;">
                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                <span>{{ $err }}</span>
            </div>
        @endforeach
    </div>
@endif

<!-- Info Callout -->
<div class="info-callout">
    <div class="info-callout-icon">
        <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
    </div>
    <div>
        <div class="info-callout-title">Petunjuk Pengisian Peta Google Maps</div>
        <div class="info-callout-desc">
            Anda dapat langsung <strong>Copy & Paste seluruh kode HTML <code>&lt;iframe src="..."&gt;&lt;/iframe&gt;</code></strong> hasil dari Google Maps (Bagikan → Sematkan peta), atau memasukkan link URL embed-nya saja. Sistem akan secara otomatis mendeteksi dan menampilkan peta lokasi secara presisi.
        </div>
    </div>
</div>

<form action="{{ route('dpn.kontak_page.save') }}" method="POST">
    @csrf
    <div class="form-panel-box">
        <div class="form-panel-header">
            <div class="form-panel-title">
                <svg width="20" height="20" fill="none" stroke="#003B64" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                Pengaturan Konten Halaman Publik (/kontak)
            </div>
        </div>

        <!-- 1. Alamat Kantor Pertanahan -->
        <div class="form-grid-item">
            <div class="item-head">
                <div class="item-icon-badge" style="background: #0284C7;">
                    <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </div>
                <div>
                    <div class="item-label">Alamat Resmi Kantor Pertanahan</div>
                    <div class="item-sub">Teks alamat lengkap kantor pertanahan yang tampil pada halaman kontak publik.</div>
                </div>
            </div>
            <textarea name="contact_address" class="custom-input" rows="2" placeholder="Jl. Suryakencana No. 02, Kel. Gunungparang, Kec. Cikole, Kota Sukabumi, Jawa Barat 43111" required>{{ old('contact_address', $settings['contact_address'] ?? 'Jl. Suryakencana No. 02, Kel. Gunungparang, Kec. Cikole, Kota Sukabumi, Jawa Barat 43111') }}</textarea>
        </div>

        <!-- 2. Telepon CS / WhatsApp Helpdesk -->
        <div class="form-grid-item">
            <div class="item-head">
                <div class="item-icon-badge" style="background: #16A34A;">
                    <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                </div>
                <div>
                    <div class="item-label">Nomor Telepon CS / WhatsApp Helpdesk</div>
                    <div class="item-sub">Nomor WhatsApp tujuan tombol "Hubungi Kami" & "Chat Helpdesk" (Gunakan format angka, contoh: 6282234523450).</div>
                </div>
            </div>
            <input type="text" name="contact_phone" class="custom-input" placeholder="Contoh: 6282234523450" value="{{ old('contact_phone', $settings['contact_phone'] ?? '6282234523450') }}" required>
        </div>

        <!-- 3. Email Official -->
        <div class="form-grid-item">
            <div class="item-head">
                <div class="item-icon-badge" style="background: #D97706;">
                    <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                </div>
                <div>
                    <div class="item-label">Email Resmi Official</div>
                    <div class="item-sub">Email resmi bantuan pertanahan yang ditampilkan pada halaman kontak publik.</div>
                </div>
            </div>
            <input type="email" name="contact_email" class="custom-input" placeholder="penataanpertanahanmiko@gmail.com" value="{{ old('contact_email', $settings['contact_email'] ?? 'penataanpertanahanmiko@gmail.com') }}" required>
        </div>

        <!-- 4. Kode Iframe / Link Google Maps -->
        <div class="form-grid-item">
            <div class="item-head">
                <div class="item-icon-badge" style="background: #4F46E5;">
                    <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/></svg>
                </div>
                <div>
                    <div class="item-label">Kode Iframe / Link Sematan Google Maps</div>
                    <div class="item-sub">Paste langsung kode HTML sematan Google Maps dari fitur Bagikan → Sematkan Peta.</div>
                </div>
            </div>
            <textarea name="contact_map_iframe" class="custom-input code-input" rows="3" placeholder='<iframe src="https://www.google.com/maps/embed?pb=..." width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>'>{{ old('contact_map_iframe', $settings['contact_map_iframe'] ?? ($settings['contact_map_url'] ?? 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1980.3801373425704!2d106.92710990964812!3d-6.919236993930166!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68483119f0eb21%3A0xc96505f81ecf236f!2sJl.%20Surya%20Kencana%20No.2%2C%20Gunungparang%2C%20Kec.%20Cikole%2C%20Kota%20Sukabumi%2C%20Jawa%20Barat%2043111!5e0!3m2!1sid!2sid!4v1781316668923!5m2!1sid!2sid')) }}</textarea>
            
            @if(!empty($settings['contact_map_url']))
                <div class="map-preview-wrap">
                    <div class="map-preview-badge">
                        <span style="width: 7px; height: 7px; border-radius: 50%; background: #10B981; display: inline-block;"></span>
                        Live Preview Peta Aktif
                    </div>
                    <iframe src="{{ $settings['contact_map_url'] }}" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            @endif
        </div>

        <!-- 5. Link Media Sosial Resmi -->
        <div style="margin-top: 32px; margin-bottom: 16px; padding-top: 20px; border-top: 1.5px solid #F1F5F9;">
            <h3 style="font-size: 15px; font-weight: 800; color: #0F172A; margin-bottom: 4px;">Link Media Sosial Resmi Kantah Kota Sukabumi</h3>
            <p style="font-size: 12px; color: #64748B; margin: 0;">Masukkan URL profil media sosial resmi yang akan dihubungkan pada ikon Halaman Kontak Publik.</p>
        </div>

        <!-- TikTok -->
        <div class="form-grid-item">
            <div class="item-head">
                <div class="item-icon-badge" style="background: #000000;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M16.6 5.82s.51.5 0 0A4.278 4.278 0 0 1 15.54 3h-3.09v12.4a2.592 2.592 0 0 1-2.59 2.5c-1.42 0-2.6-1.16-2.6-2.6 0-1.72 1.66-3.01 3.37-2.48V9.66c-3.45-.46-6.47 2.22-6.47 5.64 0 3.33 2.76 5.7 5.69 5.7 3.14 0 5.69-2.55 5.69-5.7V9.01a7.35 7.35 0 0 0 4.3 1.38V7.3s-1.88.09-3.24-1.48z"/></svg>
                </div>
                <div>
                    <div class="item-label">Link Akun TikTok</div>
                    <div class="item-sub">URL akun TikTok resmi (contoh: https://www.tiktok.com/@kantahkotsukabumi)</div>
                </div>
            </div>
            <input type="url" name="social_tiktok" class="custom-input" placeholder="https://www.tiktok.com/@kantahkotsukabumi" value="{{ old('social_tiktok', $settings['social_tiktok'] ?? 'https://www.tiktok.com/@kantahkotsukabumi') }}">
        </div>

        <!-- Instagram -->
        <div class="form-grid-item">
            <div class="item-head">
                <div class="item-icon-badge" style="background: #E1306C;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.012-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 1 0 0 12.324 6.162 6.162 0 0 0 0-12.324zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm6.406-11.845a1.44 1.44 0 1 0 0 2.881 1.44 1.44 0 0 0 0-2.881z"/></svg>
                </div>
                <div>
                    <div class="item-label">Link Akun Instagram</div>
                    <div class="item-sub">URL akun Instagram resmi (contoh: https://www.instagram.com/kantahkotasukabumi/)</div>
                </div>
            </div>
            <input type="url" name="social_instagram" class="custom-input" placeholder="https://www.instagram.com/kantahkotasukabumi/" value="{{ old('social_instagram', $settings['social_instagram'] ?? 'https://www.instagram.com/kantahkotasukabumi/') }}">
        </div>

        <!-- Threads -->
        <div class="form-grid-item">
            <div class="item-head">
                <div class="item-icon-badge" style="background: #101010;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M12.186 24h-.007c-3.581-.024-6.334-1.205-8.184-3.509C2.35 18.44 1.5 15.586 1.472 12.01v-.017c.03-3.579.879-6.43 2.525-8.482C5.845 1.205 8.6.024 12.18 0h.014c2.746.02 5.043.725 6.826 2.098 1.677 1.29 2.858 3.13 3.509 5.467l-2.04.569c-1.104-3.96-3.898-5.984-8.304-6.015-2.91.022-5.11.936-6.54 2.717C4.307 6.504 3.616 8.914 3.589 12c.027 3.086.718 5.496 2.057 7.164 1.43 1.781 3.631 2.695 6.54 2.717 2.623-.02 4.358-.631 5.8-2.045 1.647-1.613 1.618-3.593 1.086-4.798-.31-.705-.87-1.29-1.629-1.723-.19 1.361-.617 2.44-1.28 3.229-.878 1.048-2.132 1.63-3.774 1.665-1.238.027-2.436-.256-3.246-.902-.943-.752-1.402-1.827-1.29-3.028.108-1.163.68-2.083 1.649-2.665.98-.589 2.302-.767 3.729-.51.192.035.379.075.559.121-.017-1.098-.294-1.928-.826-2.472-.628-.643-1.596-.968-2.876-.968h-.037c-1.245.011-2.187.395-2.803 1.14l-1.622-1.291c.878-1.113 2.203-1.727 3.833-1.774h.078c1.912 0 3.427.501 4.505 1.489 1.045.958 1.605 2.328 1.663 4.07.096.03.19.061.283.094 1.446.508 2.507 1.404 3.15 2.664.74 1.447 1.096 3.941-1.049 6.077C17.63 22.98 15.303 23.98 12.186 24z"/></svg>
                </div>
                <div>
                    <div class="item-label">Link Akun Threads</div>
                    <div class="item-sub">URL akun Threads resmi (contoh: https://www.threads.com/@kantahkotasukabumi)</div>
                </div>
            </div>
            <input type="url" name="social_threads" class="custom-input" placeholder="https://www.threads.com/@kantahkotasukabumi" value="{{ old('social_threads', $settings['social_threads'] ?? 'https://www.threads.com/@kantahkotasukabumi') }}">
        </div>

        <!-- YouTube -->
        <div class="form-grid-item">
            <div class="item-head">
                <div class="item-icon-badge" style="background: #FF0000;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                </div>
                <div>
                    <div class="item-label">Link Kanal YouTube</div>
                    <div class="item-sub">URL kanal YouTube resmi (contoh: https://www.youtube.com/@kantahkotasukabumi)</div>
                </div>
            </div>
            <input type="url" name="social_youtube" class="custom-input" placeholder="https://www.youtube.com/@kantahkotasukabumi" value="{{ old('social_youtube', $settings['social_youtube'] ?? 'https://www.youtube.com/@kantahkotasukabumi') }}">
        </div>

        <!-- Facebook -->
        <div class="form-grid-item">
            <div class="item-head">
                <div class="item-icon-badge" style="background: #1877F2;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.494v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.325-1.325z"/></svg>
                </div>
                <div>
                    <div class="item-label">Link Halaman Facebook</div>
                    <div class="item-sub">URL halaman Facebook resmi (contoh: https://www.facebook.com/share/1L6H5iMc8H/)</div>
                </div>
            </div>
            <input type="url" name="social_facebook" class="custom-input" placeholder="https://www.facebook.com/share/1L6H5iMc8H/" value="{{ old('social_facebook', $settings['social_facebook'] ?? 'https://www.facebook.com/share/1L6H5iMc8H/') }}">
        </div>

        <div style="margin-top: 32px; padding-top: 20px; border-top: 1.5px solid #F1F5F9; display: flex; justify-content: flex-end;">
            <button type="submit" class="btn-submit-main">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                Simpan Pengaturan Halaman Kontak
            </button>
        </div>
    </div>
</form>
@endsection
