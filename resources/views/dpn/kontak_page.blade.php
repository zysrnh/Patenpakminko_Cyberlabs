@extends('layouts.app')

@section('title', 'Kelola Halaman Kontak Publik — PATEN PAK MIKO')
@section('page-title', 'Kelola Halaman Kontak Publik')

@section('extra-styles')
    @keyframes kpFadeUp {
        from { opacity: 0; transform: translateY(5px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .kp-hero {
        background: #FFFFFF;
        border: 1px solid #D6E4EF;
        border-radius: 4px;
        padding: 15px 18px;
        margin-bottom: 14px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
        flex-wrap: wrap;
        animation: kpFadeUp .2s cubic-bezier(0.22, 1, 0.36, 1) both;
    }
    .kp-hero-title { font-size: 17px; font-weight: 800; color: #003B64; letter-spacing: -0.02em; margin: 0 0 2px; }
    .kp-hero-sub { font-size: 12.5px; color: #64748B; margin: 0; }
    .kp-public-link {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #FFFFFF;
        color: #003B64;
        border: 1px solid #CBD5E1;
        border-radius: 4px;
        padding: 7px 12px;
        font-size: 12px;
        font-weight: 700;
        text-decoration: none;
    }
    .kp-public-link:hover { background: #F1F5F9; border-color: #218AC9; }

    .kp-layout {
        display: grid;
        grid-template-columns: 1.15fr 1fr;
        gap: 14px;
        align-items: start;
        animation: kpFadeUp .24s cubic-bezier(0.22, 1, 0.36, 1) .04s both;
    }
    .kp-card {
        background: #FFFFFF;
        border: 1px solid #D6E4EF;
        border-radius: 4px;
        overflow: hidden;
        margin-bottom: 14px;
    }
    .kp-card:last-child { margin-bottom: 0; }
    .kp-card-head {
        padding: 12px 16px;
        background: #F8FAFC;
        border-bottom: 1px solid #E8F0F6;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 8px;
    }
    .kp-card-head h2 {
        font-size: 14px;
        font-weight: 800;
        color: #003B64;
        margin: 0;
    }
    .kp-card-body { padding: 16px; }

    .kp-grid-2 {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
        margin-bottom: 12px;
    }
    .kp-field { margin-bottom: 12px; }
    .kp-field:last-child { margin-bottom: 0; }
    .kp-label {
        display: block;
        font-size: 12px;
        font-weight: 700;
        color: #003B64;
        margin-bottom: 4px;
    }
    .kp-hint {
        font-size: 11px;
        color: #64748B;
        margin-top: 3px;
        display: block;
    }
    .kp-input {
        width: 100%;
        padding: 8px 10px;
        border: 1px solid #CBD5E1;
        border-radius: 4px;
        font-family: inherit;
        font-size: 12.5px;
        color: #0F172A;
        background: #FFFFFF;
        outline: none;
    }
    .kp-input:focus { border-color: #218AC9; }
    .kp-code {
        font-family: 'DM Mono', monospace;
        font-size: 11.5px;
        color: #003B64;
    }

    .kp-social-row {
        display: grid;
        grid-template-columns: 92px 1fr;
        align-items: center;
        gap: 8px;
        margin-bottom: 8px;
    }
    .kp-social-row:last-child { margin-bottom: 0; }
    .kp-social-tag {
        font-size: 11.5px;
        font-weight: 700;
        color: #334155;
        background: #F1F5F9;
        border: 1px solid #CBD5E1;
        border-radius: 4px;
        height: 33px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .map-preview-wrap {
        margin-top: 10px;
        border-radius: 4px;
        overflow: hidden;
        border: 1px solid #CBD5E1;
        background: #F1F5F9;
        height: 170px;
        position: relative;
    }
    .map-preview-badge {
        position: absolute;
        top: 8px;
        left: 8px;
        background: #003B64;
        color: #FFFFFF;
        padding: 3px 8px;
        border-radius: 4px;
        font-size: 10.5px;
        font-weight: 700;
        z-index: 5;
    }

    .kp-radio-group {
        display: flex;
        gap: 16px;
        flex-wrap: wrap;
        margin-top: 8px;
    }
    .kp-radio-item {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 12.5px;
        font-weight: 600;
        color: #0F172A;
        cursor: pointer;
    }

    .kp-save-bar {
        background: #FFFFFF;
        border: 1px solid #D6E4EF;
        border-radius: 4px;
        padding: 12px 16px;
        margin-top: 14px;
        display: flex;
        justify-content: flex-end;
    }
    .btn-submit-main {
        background: #003B64;
        color: #FFFFFF;
        border: none;
        padding: 9px 20px;
        font-family: inherit;
        font-size: 13px;
        font-weight: 700;
        border-radius: 4px;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 7px;
    }
    .btn-submit-main:hover { background: #218AC9; }

    @media (max-width: 960px) {
        .kp-layout, .kp-grid-2 { grid-template-columns: 1fr; }
    }
    @media (prefers-reduced-motion: reduce) {
        .kp-hero, .kp-layout { animation: none !important; }
    }
@endsection

@section('content')
<div class="kp-hero">
    <div>
        <h1 class="kp-hero-title">Kelola Informasi Halaman Kontak</h1>
        <p class="kp-hero-sub">Atur alamat, helpdesk WhatsApp, email, embed Google Maps, dan link media sosial.</p>
    </div>
    <a href="{{ url('/kontak') }}" target="_blank" class="kp-public-link">
        <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
        <span>Lihat Halaman /kontak</span>
    </a>
</div>

@if($errors->any())
    <div class="alert alert-error" style="border-radius: 4px; margin-bottom: 14px;">
        @foreach($errors->all() as $err)
            <div style="display: flex; align-items: center; gap: 8px;">
                <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                <span>{{ $err }}</span>
            </div>
        @endforeach
    </div>
@endif

<form action="{{ route('dpn.kontak_page.save') }}" method="POST">
    @csrf
    <div class="kp-layout">
        <!-- Kolom Kiri: Info Kontak & Peta -->
        <div>
            <div class="kp-card">
                <div class="kp-card-head">
                    <h2>Identitas &amp; Peta Kantor</h2>
                </div>
                <div class="kp-card-body">
                    <div class="kp-grid-2">
                        <div>
                            <label class="kp-label">WhatsApp Helpdesk (628...)</label>
                            <input type="text" name="contact_phone" class="kp-input" placeholder="6282234523450" value="{{ old('contact_phone', $settings['contact_phone'] ?? '6282234523450') }}" required>
                        </div>
                        <div>
                            <label class="kp-label">Email Resmi</label>
                            <input type="email" name="contact_email" class="kp-input" placeholder="penataanpertanahanmiko@gmail.com" value="{{ old('contact_email', $settings['contact_email'] ?? 'penataanpertanahanmiko@gmail.com') }}" required>
                        </div>
                    </div>

                    <div class="kp-field">
                        <label class="kp-label">Alamat Resmi Kantor Pertanahan</label>
                        <textarea name="contact_address" class="kp-input" rows="2" required>{{ old('contact_address', $settings['contact_address'] ?? 'Jl. Suryakencana No. 02, Kel. Gunungparang, Kec. Cikole, Kota Sukabumi, Jawa Barat 43111') }}</textarea>
                    </div>

                    <div class="kp-field">
                        <label class="kp-label">Kode Embed Google Maps (&lt;iframe&gt; / URL)</label>
                        <textarea name="contact_map_iframe" class="kp-input kp-code" rows="2" placeholder='<iframe src="https://www.google.com/maps/embed?pb=..." ...></iframe>'>{{ old('contact_map_iframe', $settings['contact_map_iframe'] ?? ($settings['contact_map_url'] ?? 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1980.3801373425704!2d106.92710990964812!3d-6.919236993930166!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68483119f0eb21%3A0xc96505f81ecf236f!2sJl.%20Surya%20Kencana%20No.2%2C%20Gunungparang%2C%20Kec.%20Cikole%2C%20Kota%20Sukabumi%2C%20Jawa%20Barat%2043111!5e0!3m2!1sid!2sid!4v1781316668923!5m2!1sid!2sid')) }}</textarea>
                        <span class="kp-hint">Paste langsung kode &lt;iframe&gt; dari Google Maps (Bagikan → Sematkan peta).</span>
                    </div>

                    @if(!empty($settings['contact_map_url']))
                        <div class="map-preview-wrap">
                            <span class="map-preview-badge">Preview Peta Aktif</span>
                            <iframe src="{{ $settings['contact_map_url'] }}" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Media Sosial & Identitas Pengembang -->
        <div>
            <div class="kp-card">
                <div class="kp-card-head">
                    <h2>Media Sosial Resmi</h2>
                </div>
                <div class="kp-card-body">
                    <div class="kp-social-row">
                        <span class="kp-social-tag">TikTok</span>
                        <input type="url" name="social_tiktok" class="kp-input" placeholder="https://www.tiktok.com/@kantahkotsukabumi" value="{{ old('social_tiktok', $settings['social_tiktok'] ?? 'https://www.tiktok.com/@kantahkotsukabumi') }}">
                    </div>
                    <div class="kp-social-row">
                        <span class="kp-social-tag">Instagram</span>
                        <input type="url" name="social_instagram" class="kp-input" placeholder="https://www.instagram.com/kantahkotasukabumi/" value="{{ old('social_instagram', $settings['social_instagram'] ?? 'https://www.instagram.com/kantahkotasukabumi/') }}">
                    </div>
                    <div class="kp-social-row">
                        <span class="kp-social-tag">Threads</span>
                        <input type="url" name="social_threads" class="kp-input" placeholder="https://www.threads.com/@kantahkotasukabumi" value="{{ old('social_threads', $settings['social_threads'] ?? 'https://www.threads.com/@kantahkotasukabumi') }}">
                    </div>
                    <div class="kp-social-row">
                        <span class="kp-social-tag">YouTube</span>
                        <input type="url" name="social_youtube" class="kp-input" placeholder="https://www.youtube.com/@kantahkotasukabumi" value="{{ old('social_youtube', $settings['social_youtube'] ?? 'https://www.youtube.com/@kantahkotasukabumi') }}">
                    </div>
                    <div class="kp-social-row">
                        <span class="kp-social-tag">Facebook</span>
                        <input type="url" name="social_facebook" class="kp-input" placeholder="https://www.facebook.com/share/1L6H5iMc8H/" value="{{ old('social_facebook', $settings['social_facebook'] ?? 'https://www.facebook.com/share/1L6H5iMc8H/') }}">
                    </div>
                </div>
            </div>

            <div class="kp-card">
                <div class="kp-card-head">
                    <h2>Identitas Pengembang (PT Atom Rekadaya Cipta)</h2>
                </div>
                <div class="kp-card-body">
                    <p style="font-size:12px; color:#64748B; margin:0 0 8px; line-height:1.45;">
                        Ditampilkan di halaman kontak &amp; footer sebagai informasi entitas resmi mitra teknologi (compliance WhatsApp API).
                    </p>
                    <div class="kp-radio-group">
                        <label class="kp-radio-item">
                            <input type="radio" name="show_developer_badge" value="1" {{ old('show_developer_badge', $settings['show_developer_badge'] ?? '1') == '1' ? 'checked' : '' }} style="accent-color:#003B64;">
                            <span>Tampilkan</span>
                        </label>
                        <label class="kp-radio-item" style="color:#64748B;">
                            <input type="radio" name="show_developer_badge" value="0" {{ old('show_developer_badge', $settings['show_developer_badge'] ?? '1') == '0' ? 'checked' : '' }} style="accent-color:#DC2626;">
                            <span>Sembunyikan</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="kp-save-bar">
        <button type="submit" class="btn-submit-main">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.4" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
            <span>Simpan Perubahan Kontak</span>
        </button>
    </div>
</form>
@endsection
