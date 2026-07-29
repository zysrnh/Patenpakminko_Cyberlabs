@extends('layouts.public')

@section('title', 'Alur Proses — PATEN PAK MIKO')

@section('content')
<style>
    .alur-page {
        background-color: #F0F6FB;
        padding: 60px 20px 100px;
    }
    
    .alur-header {
        text-align: center;
        margin-bottom: 60px;
    }
    .alur-badge {
        display: inline-block;
        background: #EBF8FF;
        color: #3291A8;
        font-size: 12px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        padding: 6px 14px;
        border-radius: 100px;
        margin-bottom: 16px;
    }
    .alur-title {
        font-size: clamp(28px, 4vw, 36px);
        font-weight: 800;
        color: #00223D;
        margin-bottom: 12px;
    }
    .alur-subtitle {
        font-size: 15px;
        color: #4A5568;
        max-width: 600px;
        margin: 0 auto;
        line-height: 1.6;
    }

    .timeline-container {
        max-width: 1000px;
        margin: 0 auto;
        position: relative;
    }

    /* Vertical Line */
    .timeline-container::before {
        content: '';
        position: absolute;
        top: 20px;
        bottom: 20px;
        left: 32px; /* Center of the 64px circle */
        width: 3px;
        background-color: #00223D;
        z-index: 1;
    }

    .timeline-item {
        display: flex;
        gap: 40px;
        margin-bottom: 40px;
        position: relative;
        z-index: 2;
    }
    .timeline-item:last-child {
        margin-bottom: 0;
    }

    .timeline-number {
        width: 64px;
        height: 64px;
        border-radius: 50%;
        background-color: #00223D;
        color: #FFFFFF;
        font-size: 24px;
        font-weight: 800;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        box-shadow: 0 4px 12px rgba(0, 34, 61, 0.2);
    }

    .timeline-card {
        background: #FFFFFF;
        border-radius: 4px;
        padding: 40px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.03);
        flex: 1;
        display: flex;
        gap: 40px;
        align-items: center;
    }

    .timeline-img-wrap {
        flex: 0 0 280px;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .timeline-img-wrap img {
        width: 100%;
        max-width: 280px;
        height: auto;
        object-fit: contain;
    }

    .timeline-content {
        flex: 1;
    }
    .timeline-content h3 {
        font-size: 22px;
        font-weight: 800;
        color: #00223D;
        margin-bottom: 12px;
    }
    .timeline-content p {
        font-size: 14.5px;
        color: #4A5568;
        line-height: 1.6;
        margin-bottom: 16px;
    }
    .timeline-list-group {
        margin-bottom: 16px;
    }
    .timeline-list-group:last-child {
        margin-bottom: 0;
    }
    .timeline-list-title {
        font-size: 14px;
        font-weight: 700;
        color: #00223D;
        margin-bottom: 8px;
    }
    .timeline-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .timeline-list li {
        position: relative;
        padding-left: 16px;
        font-size: 13.5px;
        color: #4A5568;
        line-height: 1.5;
        margin-bottom: 6px;
    }
    .timeline-list li::before {
        content: '•';
        position: absolute;
        left: 0;
        color: #3291A8;
        font-weight: bold;
        font-size: 16px;
    }

    /* CTA Section */
    .alur-cta {
        background-image: url('{{ asset('storage/aset/Footer.png') }}');
        background-size: cover;
        background-position: center;
        padding: 80px 20px;
        text-align: center;
        position: relative;
    }
    .alur-cta::before {
        content: '';
        position: absolute;
        inset: 0;
        background: rgba(0, 34, 61, 0.85); /* Dark overlay */
    }
    .alur-cta-inner {
        position: relative;
        z-index: 2;
        max-width: 800px;
        margin: 0 auto;
    }
    .alur-cta h2 {
        font-size: clamp(28px, 4vw, 40px);
        font-weight: 800;
        color: #FFFFFF;
        margin-bottom: 16px;
        line-height: 1.3;
    }
    .alur-cta h2 span {
        color: #3291A8;
    }
    .alur-cta p {
        font-size: 16px;
        color: #E2E8F0;
        margin-bottom: 32px;
    }
    .alur-cta-buttons {
        display: flex;
        gap: 16px;
        justify-content: center;
    }

    @media (max-width: 992px) {
        .timeline-card {
            flex-direction: column;
            text-align: center;
            padding: 30px 24px;
        }
        .timeline-list li {
            text-align: left;
        }
        .timeline-list-title {
            text-align: left;
        }
        .timeline-img-wrap {
            flex: none;
            width: 100%;
            margin-bottom: 20px;
        }
        .timeline-img-wrap img {
            max-width: 200px;
        }
    }

    @media (max-width: 768px) {
        .timeline-container::before {
            left: 24px;
        }
        .timeline-number {
            width: 48px;
            height: 48px;
            font-size: 20px;
        }
        .timeline-item {
            gap: 20px;
        }
        .alur-cta-buttons {
            flex-direction: column;
        }
    }
</style>

<div class="alur-page">
    <div class="container">
        
        <div class="alur-header">
            <span class="alur-badge">Info Layanan</span>
            <h1 class="alur-title">Proses Sederhana, Hanya Empat Tahap</h1>
            <p class="alur-subtitle">Ikuti langkah-langkah pengajuan layanan dengan mudah, cepat, dan transparan melalui sistem PATEN PAK MIKO.</p>
        </div>

        <div class="timeline-container">
            
            <!-- Step 1 -->
            <div class="timeline-item">
                <div class="timeline-number">1</div>
                <div class="timeline-card">
                    <div class="timeline-img-wrap">
                        <img src="{{ asset('storage/svg/PilihLayanan.svg') }}" alt="Pilih Layanan">
                    </div>
                    <div class="timeline-content">
                        <h3>Pilih Layanan</h3>
                        <p>Tentukan jenis layanan permohonan yang sesuai dengan kebutuhan dan kriteria kegiatan pemanfaatan ruang Anda.</p>
                        
                        <div class="timeline-list-group">
                            <div class="timeline-list-title">Pilihan Layanan:</div>
                            <ul class="timeline-list">
                                <li>PPKPR Berusaha</li>
                                <li>PPKPR Non Berusaha</li>
                                <li>PKKPR Kebijakan</li>
                                <li>PSN (Proyek Strategis Nasional)</li>
                                <li>PKKPR Tanah Timbul</li>
                            </ul>
                        </div>
                        <p>Pemohon memilih jenis layanan yang tersedia di portal sesuai dengan peruntukan dan kriteria kegiatan.</p>
                        
                        <div class="timeline-list-group">
                            <div class="timeline-list-title">Tujuan Tahap Ini:</div>
                            <ul class="timeline-list">
                                <li>Memilih jenis permohonan yang sesuai kebutuhan</li>
                                <li>Mengetahui syarat dan alur spesifik tiap layanan</li>
                                <li>Mempermudah pengisian formulir pengajuan</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Step 2 -->
            <div class="timeline-item">
                <div class="timeline-number">2</div>
                <div class="timeline-card">
                    <div class="timeline-img-wrap">
                        <img src="{{ asset('storage/svg/UnggahDocumen.svg') }}" alt="Unggah Dokumen">
                    </div>
                    <div class="timeline-content">
                        <h3>Unggah Dokumen</h3>
                        <p>Lengkapi dan unggah berkas persyaratan permohonan melalui sistem secara digital dengan mudah dan cepat.</p>
                        
                        <div class="timeline-list-group">
                            <div class="timeline-list-title">Dokumen yang Diunggah:</div>
                            <ul class="timeline-list">
                                <li>Formulir permohonan & Identitas pemohon</li>
                                <li>Dokumen bukti kepemilikan / penguasaan tanah</li>
                                <li>Peta lokasi / Koordinat area permohonan</li>
                                <li>Persyaratan administrasi lainnya</li>
                            </ul>
                        </div>

                        <div class="timeline-list-group">
                            <div class="timeline-list-title">Fitur Upload:</div>
                            <ul class="timeline-list">
                                <li>Upload berkas digital mudah</li>
                                <li>Multi upload document</li>
                                <li>Validasi format file otomatis</li>
                                <li>Progress upload real-time</li>
                            </ul>
                        </div>

                        <div class="timeline-list-group">
                            <div class="timeline-list-title">Tujuan Tahap Ini:</div>
                            <ul class="timeline-list">
                                <li>Memastikan kelengkapan berkas administrasi</li>
                                <li>Mengurangi kesalahan pengajuan fisik</li>
                                <li>Mempercepat proses verifikasi data</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Step 3 -->
            <div class="timeline-item">
                <div class="timeline-number">3</div>
                <div class="timeline-card">
                    <div class="timeline-img-wrap">
                        <img src="{{ asset('storage/svg/Verifikasi&Validasi.svg') }}" alt="Verifikasi dan Validasi Berkas">
                    </div>
                    <div class="timeline-content">
                        <h3>Verifikasi dan Validasi Berkas</h3>
                        <p>Petugas Kantor Pertanahan akan memeriksa kelengkapan dan kesesuaian dokumen yang telah Anda unggah ke sistem.</p>
                        
                        <div class="timeline-list-group">
                            <div class="timeline-list-title">Proses Verifikasi:</div>
                            <ul class="timeline-list">
                                <li>Pemeriksaan kelengkapan administrasi oleh petugas</li>
                                <li>Verifikasi teknis dan validasi berkas</li>
                                <li>Peninjauan / penilaian sesuai ketentuan</li>
                            </ul>
                        </div>

                        <div class="timeline-list-group">
                            <div class="timeline-list-title">Tindak Lanjut Berkas:</div>
                            <p style="margin-bottom: 8px; font-size: 13.5px;">Setelah verifikasi dilakukan:</p>
                            <ul class="timeline-list">
                                <li>Jika dokumen tidak sesuai, pemohon menerima notifikasi revisi</li>
                                <li>Jika dokumen valid & lengkap, proses dilanjutkan ke tahap berikutnya</li>
                            </ul>
                        </div>

                        <div class="timeline-list-group">
                            <div class="timeline-list-title">Tujuan Tahap Ini:</div>
                            <ul class="timeline-list">
                                <li>Memastikan keabsahan data permohonan</li>
                                <li>Menjamin kesesuaian dengan regulasi pertanahan & tata ruang</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Step 4 -->
            <div class="timeline-item">
                <div class="timeline-number">4</div>
                <div class="timeline-card">
                    <div class="timeline-img-wrap">
                        <img src="{{ asset('storage/svg/LayananBerjalan.svg') }}" alt="Layanan Berjalan">
                    </div>
                    <div class="timeline-content">
                        <h3>Layanan Berjalan</h3>
                        <p>Permohonan Anda sedang diproses. Pantau status perkembangan layanan secara real-time melalui dashboard.</p>
                        
                        <div class="timeline-list-group">
                            <div class="timeline-list-title">Proses yang Berlangsung:</div>
                            <ul class="timeline-list">
                                <li>Pemrosesan draft dokumen & persetujuan teknis</li>
                                <li>Penerbitan surat / dokumen hasil layanan</li>
                            </ul>
                        </div>

                        <div class="timeline-list-group">
                            <div class="timeline-list-title">Fitur & Hasil Layanan:</div>
                            <ul class="timeline-list">
                                <li>Pantau status permohonan secara real-time via dashboard</li>
                                <li>Notifikasi otomatis perkembangan layanan</li>
                                <li>Unduh dokumen resmi hasil layanan setelah selesai</li>
                            </ul>
                        </div>

                        <div class="timeline-list-group">
                            <div class="timeline-list-title">Keuntungan Sistem Digital:</div>
                            <ul class="timeline-list">
                                <li>Transparan dan dapat dipantau setiap saat</li>
                                <li>Pengarsipan dokumen aman dan mudah diakses</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<section class="alur-cta">
    <div class="alur-cta-inner">
        <h2>
            Mulai Pengajuan<br>
            <span>Layanan Pertanahan</span> Anda Hari Ini
        </h2>
        <p>
            Sistem layanan administrasi pertanahan yang cepat, mudah, dan transparan melalui PATEN PAK MIKO.
        </p>
        <div class="alur-cta-buttons">
            <a href="{{ route('login') }}" class="btn-primary" style="background:#F59E0B; border:none; color:#00223D; font-weight:800;">
                Daftar Sekarang &rarr;
            </a>
            <a href="tel:1500164" class="btn-outline" style="border-color: rgba(255,255,255,0.3); color:#FFF;">
                Hubungi Admin &rarr;
            </a>
        </div>
    </div>
</section>

@endsection
