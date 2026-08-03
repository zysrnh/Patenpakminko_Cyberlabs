@extends('layouts.app')

@section('title', 'Kelola Halaman Kontak Publik — PATEN PAK MIKO')
@section('page-title', 'Kelola Halaman Kontak Publik')

@section('extra-styles')
    .info-callout {
        background: #EFF6FF;
        border: 1px solid #BFDBFE;
        border-radius: var(--r-md);
        padding: 16px 20px;
        margin-bottom: 24px;
        display: flex;
        align-items: flex-start;
        gap: 14px;
    }
    .info-callout-icon {
        color: #1D4ED8;
        flex-shrink: 0;
        margin-top: 2px;
    }
    .info-callout-title {
        font-size: 13.5px;
        font-weight: 700;
        color: #1E40AF;
        margin-bottom: 4px;
    }
    .info-callout-desc {
        font-size: 12.5px;
        color: #1E3A8A;
        line-height: 1.6;
        margin: 0;
    }
    .info-callout-desc code {
        background: rgba(29, 78, 216, 0.1);
        color: #1D4ED8;
        padding: 2px 6px;
        border-radius: 4px;
        font-family: monospace;
        font-size: 11.5px;
    }

    .form-grid-item {
        background: #FFFFFF;
        border: 1px solid var(--line);
        border-radius: var(--r-md);
        padding: 20px;
        margin-bottom: 20px;
        transition: border-color 0.2s, box-shadow 0.2s;
    }
    .form-grid-item:focus-within {
        border-color: var(--blue);
        box-shadow: 0 0 0 3px var(--blue-lt);
    }
    .item-head {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 14px;
    }
    .item-icon-badge {
        width: 38px;
        height: 38px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        flex-shrink: 0;
    }
    .item-label {
        font-size: 14px;
        font-weight: 700;
        color: var(--ink);
    }
    .item-sub {
        font-size: 12px;
        color: var(--muted);
    }

    .custom-input {
        width: 100%;
        padding: 11px 14px;
        border: 1.5px solid var(--line);
        border-radius: var(--r-md);
        font-size: 13.5px;
        color: var(--ink);
        background: #FFFFFF;
        outline: none;
        transition: border-color 0.2s;
        font-family: inherit;
    }
    .custom-input:focus {
        border-color: var(--blue);
    }
    textarea.custom-input {
        resize: vertical;
    }
    .code-input {
        font-family: monospace;
        font-size: 12.5px;
        color: #003B64;
        background: #F8FAFC;
    }

    .map-preview-wrap {
        margin-top: 14px;
        border-radius: 8px;
        overflow: hidden;
        border: 1px solid var(--line);
        background: #F1F5F9;
        height: 240px;
        position: relative;
    }
    .map-preview-badge {
        position: absolute;
        top: 10px;
        left: 10px;
        background: rgba(15, 23, 42, 0.85);
        color: #FFFFFF;
        padding: 4px 10px;
        border-radius: 4px;
        font-size: 11px;
        font-weight: 700;
        z-index: 10;
        backdrop-filter: blur(4px);
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

@if(session('success'))
    <div class="alert alert-success">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <span>{{ session('success') }}</span>
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
            Anda dapat langsung <strong>Copy & Paste seluruh kode HTML <code>&lt;iframe src="..."&gt;&lt;/iframe&gt;</code></strong> hasil dari Google Maps (Bagikan → Sematkan peta), atau memasukkan link URL embed-nya saja. Sistem akan secara otomatis mendeteksi dan menampilkan peta lokasi dengan rapi.
        </div>
    </div>
</div>

<form action="{{ route('dpn.kontak_page.save') }}" method="POST">
    @csrf
    <div class="panel">
        <div class="panel-head">
            <h2>Pengaturan Konten Halaman Publik (/kontak)</h2>
        </div>
        <div class="panel-body">
            
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
                        <div class="item-sub">Nomor WhatsApp tujuan tombol "Hubungi Kami" & "Chat Helpdesk" (Gunakan format angka, contoh: 6281322712133).</div>
                    </div>
                </div>
                <input type="text" name="contact_phone" class="custom-input" placeholder="contoh: 6281322712133" value="{{ old('contact_phone', $settings['contact_phone'] ?? '6281322712133') }}" required>
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
                <input type="email" name="contact_email" class="custom-input" placeholder="patenpakminko@mail.com" value="{{ old('contact_email', $settings['contact_email'] ?? 'patenpakminko@mail.com') }}" required>
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
                        <div class="map-preview-badge">● Live Preview Peta Aktif</div>
                        <iframe src="{{ $settings['contact_map_url'] }}" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                @endif
            </div>

            <div style="margin-top: 24px; padding-top: 20px; border-top: 1px solid var(--line);">
                <button type="submit" class="btn btn-primary" style="padding: 12px 24px; font-weight: 700;">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                    Simpan Pengaturan Halaman Kontak
                </button>
            </div>
        </div>
    </div>
</form>
@endsection
