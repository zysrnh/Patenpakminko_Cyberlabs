@extends('layouts.app')

@section('title', 'Kelola Halaman Kontak Publik — PATEN PAK MIKO')
@section('page-title', 'Kelola Halaman Kontak Publik')

@section('extra-styles')
    .contact-item { display: flex; gap: 16px; align-items: flex-start; padding: 20px; border: 1px solid var(--line); border-radius: var(--r-md); background: var(--surface); margin-bottom: 20px; }
    .contact-badge { width: 44px; height: 44px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 14px; font-weight: 800; color: white; flex-shrink: 0; }
    .contact-info { flex: 1; }
    .contact-label { font-size: 14px; font-weight: 700; color: var(--ink); margin-bottom: 4px; }
    .contact-desc { font-size: 12px; color: var(--muted); margin-bottom: 10px; line-height: 1.5; }
    .contact-input { width: 100%; padding: 12px 14px; border: 1.5px solid var(--line); border-radius: var(--r-md); font-size: 14px; font-family: inherit; font-weight: 500; background: white; color: var(--ink); outline: none; transition: border-color 0.2s; }
    .contact-input:focus { border-color: var(--blue); box-shadow: 0 0 0 3px var(--blue-lt); }
    .contact-current { font-size: 11.5px; color: var(--muted); margin-top: 6px; font-family: monospace; word-break: break-all; }
    .contact-current strong { color: var(--green-dk); }
    
    .info-box { background: var(--blue-lt); border: 1px solid #A9CFEA; border-radius: var(--r-md); padding: 18px; margin-bottom: 24px; }
    .info-box p { font-size: 13px; color: var(--ink); line-height: 1.6; margin: 0; }
    .info-box strong { font-weight: 700; color: var(--blue-dk); }
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
        <p>Kelola data alamat, nomor WhatsApp CS helpdesk, email resmi, serta kode sematan Google Maps untuk halaman kontak publik.</p>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <span>{{ session('success') }}</span>
    </div>
@endif

<div class="info-box">
    <p>
        <strong>
            <svg style="width:16px;height:16px;vertical-align:-3px;margin-right:4px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            Petunjuk Pengisian Google Maps:
        </strong><br>
        Anda dapat langsung **Copy & Paste seluruh kode `<iframe src="..."></iframe>`** hasil dari Google Maps (Bagikan → Sematkan peta), atau memasukkan link URL embed-nya saja. Sistem secara otomatis akan memproses dan menampilkan peta lokasi dengan rapi di halaman kontak publik.
    </p>
</div>

<form action="{{ route('dpn.kontak_page.save') }}" method="POST">
    @csrf
    <div class="panel">
        <div class="panel-head">
            <h2>Form Informasi Halaman Kontak Publik</h2>
        </div>
        <div class="panel-body">
            
            <!-- Alamat Kantor Pertanahan -->
            <div class="contact-item">
                <div class="contact-badge" style="background: #0284C7; color: white;">
                    <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </div>
                <div class="contact-info">
                    <div class="contact-label">Alamat Kantor Pertanahan</div>
                    <div class="contact-desc">Teks alamat resmi kantor yang akan ditampilkan pada halaman kontak publik.</div>
                    <textarea name="contact_address" class="contact-input" rows="2" placeholder="Jl. Suryakencana No. 02, Kel. Gunungparang, Kec. Cikole, Kota Sukabumi, Jawa Barat 43111" required>{{ old('contact_address', $settings['contact_address'] ?? 'Jl. Suryakencana No. 02, Kel. Gunungparang, Kec. Cikole, Kota Sukabumi, Jawa Barat 43111') }}</textarea>
                </div>
            </div>

            <!-- Telepon CS / WhatsApp Helpdesk -->
            <div class="contact-item">
                <div class="contact-badge" style="background: #16A34A; color: white;">
                    <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                </div>
                <div class="contact-info">
                    <div class="contact-label">Nomor Telepon CS / WhatsApp Helpdesk</div>
                    <div class="contact-desc">Nomor WhatsApp tujuan saat pemohon menekan tombol "Hubungi Kami" & "Chat Helpdesk" (contoh: 6281322712133).</div>
                    <input type="text" name="contact_phone" class="contact-input" placeholder="contoh: 6281322712133" value="{{ old('contact_phone', $settings['contact_phone'] ?? '6281322712133') }}" required>
                </div>
            </div>

            <!-- Email Official -->
            <div class="contact-item">
                <div class="contact-badge" style="background: #D97706; color: white;">
                    <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                </div>
                <div class="contact-info">
                    <div class="contact-label">Email Official</div>
                    <div class="contact-desc">Email resmi bantuan yang ditampilkan di halaman /kontak.</div>
                    <input type="email" name="contact_email" class="contact-input" placeholder="patenpakminko@mail.com" value="{{ old('contact_email', $settings['contact_email'] ?? 'patenpakminko@mail.com') }}" required>
                </div>
            </div>

            <!-- Kode Iframe Google Maps / Link Sematan -->
            <div class="contact-item">
                <div class="contact-badge" style="background: #4F46E5; color: white;">
                    <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/></svg>
                </div>
                <div class="contact-info">
                    <div class="contact-label">Kode Iframe / Link Google Maps</div>
                    <div class="contact-desc">Paste langsung kode HTML <code>&lt;iframe src="..."&gt;&lt;/iframe&gt;</code> hasil sematan Google Maps di sini.</div>
                    <textarea name="contact_map_iframe" class="contact-input" rows="3" placeholder='<iframe src="https://www.google.com/maps/embed?pb=..." width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>'>{{ old('contact_map_iframe', $settings['contact_map_iframe'] ?? ($settings['contact_map_url'] ?? 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1980.3801373425704!2d106.92710990964812!3d-6.919236993930166!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68483119f0eb21%3A0xc96505f81ecf236f!2sJl.%20Surya%20Kencana%20No.2%2C%20Gunungparang%2C%20Kec.%20Cikole%2C%20Kota%20Sukabumi%2C%20Jawa%20Barat%2043111!5e0!3m2!1sid!2sid!4v1781316668923!5m2!1sid!2sid')) }}</textarea>
                    
                    @if(!empty($settings['contact_map_url']))
                        <div class="contact-current">URL Peta Terdeteksi: <strong>{{ $settings['contact_map_url'] }}</strong></div>
                        <div style="margin-top: 14px; border-radius: 8px; overflow: hidden; border: 1px solid var(--line); height: 200px;">
                            <iframe src="{{ $settings['contact_map_url'] }}" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                        </div>
                    @endif
                </div>
            </div>

            <div style="margin-top: 24px; padding-top: 20px; border-top: 1px solid var(--line);">
                <button type="submit" class="btn btn-primary">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                    Simpan Perubahan Halaman Kontak
                </button>
            </div>
        </div>
    </div>
</form>
@endsection
