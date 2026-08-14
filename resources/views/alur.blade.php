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
        transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
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
        box-shadow: 0 4px 14px rgba(0, 34, 61, 0.25);
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .timeline-item:hover .timeline-number {
        transform: scale(1.1);
        background-color: #3291A8;
        box-shadow: 0 0 24px rgba(50, 145, 168, 0.5);
    }

    .timeline-card {
        background: #FFFFFF;
        border-radius: 16px;
        padding: 36px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.03);
        border: 1px solid #E2E8F0;
        flex: 1;
        display: flex;
        gap: 40px;
        align-items: center;
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .timeline-item:hover .timeline-card {
        transform: translateY(-4px);
        box-shadow: 0 16px 40px rgba(0, 34, 61, 0.08);
        border-color: #CBD5E1;
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
        transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .timeline-item:hover .timeline-img-wrap img {
        transform: translateY(-6px) scale(1.03);
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
        padding-left: 18px;
        font-size: 13.5px;
        color: #4A5568;
        line-height: 1.55;
        margin-bottom: 6px;
        transition: all 0.2s ease;
    }
    .timeline-list li::before {
        content: '•';
        position: absolute;
        left: 0;
        color: #3291A8;
        font-weight: bold;
        font-size: 16px;
    }
    .timeline-list li:hover {
        transform: translateX(4px);
        color: #00223D;
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
            padding: 28px 20px;
        }
        .timeline-list li,
        .timeline-list-title {
            text-align: left;
        }
        .timeline-img-wrap {
            flex: none;
            width: 100%;
            margin-bottom: 16px;
        }
        .timeline-img-wrap img {
            max-width: 220px;
        }
    }

    @media (max-width: 576px) {
        .alur-page {
            padding: 32px 14px 60px !important;
        }
        .alur-header {
            margin-bottom: 36px !important;
        }
        .alur-badge {
            font-size: 11px !important;
            padding: 5px 12px !important;
        }
        .alur-title {
            font-size: 24px !important;
            margin-bottom: 10px !important;
        }
        .alur-subtitle {
            font-size: 13px !important;
            line-height: 1.5 !important;
        }
        .timeline-container::before {
            left: 20px !important;
            top: 10px !important;
            bottom: 10px !important;
        }
        .timeline-item {
            gap: 14px !important;
            margin-bottom: 28px !important;
        }
        .timeline-number {
            width: 42px !important;
            height: 42px !important;
            font-size: 18px !important;
        }
        .timeline-card {
            padding: 20px 16px !important;
            border-radius: 14px !important;
        }
        .timeline-content h3 {
            font-size: 18px !important;
            margin-bottom: 8px !important;
        }
        .timeline-content p {
            font-size: 13px !important;
            margin-bottom: 14px !important;
        }
        .timeline-list-title {
            font-size: 13px !important;
        }
        .timeline-list li {
            font-size: 12.5px !important;
        }
        .alur-cta {
            padding: 50px 16px !important;
        }
        .alur-cta h2 {
            font-size: 24px !important;
        }
        .alur-cta p {
            font-size: 13.5px !important;
            margin-bottom: 24px !important;
        }
        .alur-cta-buttons {
            flex-direction: column !important;
            gap: 10px !important;
        }
        .alur-cta-buttons a {
            width: 100% !important;
            text-align: center !important;
            justify-content: center !important;
        }
    }
</style>

<div class="alur-page">
    <div class="container">
        
        <div class="alur-header reveal">
            <span class="alur-badge">Info Layanan</span>
            <h1 class="alur-title">Proses Sederhana, Hanya Empat Tahap</h1>
            <p class="alur-subtitle">Ikuti langkah-langkah pengajuan layanan dengan mudah, cepat, dan transparan melalui sistem PATEN PAK MIKO.</p>
        </div>

        <div class="timeline-container">
            
            <!-- Step 1 -->
            <div class="timeline-item reveal">
                <div class="timeline-number">1</div>
                <div class="timeline-card">
                    <div class="timeline-img-wrap">
                        <img src="{{ asset('storage/svg/PilihLayanan.svg') }}" alt="Pilih Layanan">
                    </div>
                    <div class="timeline-content">
                        <h3>Pilih Layanan</h3>
                        <p>Tentukan jenis layanan permohonan yang sesuai dengan kebutuhan dan kriteria kegiatan pemanfaatan ruang Anda.</p>
                        
                        <div class="timeline-list-group">
                            <div class="timeline-list-title">Layanan Pertimbangan Teknis Pertanahan:</div>
                            <ul class="timeline-list">
                                <li>Pertimbangan Teknis Pertanahan PKKPR Berusaha</li>
                                <li>Pertimbangan Teknis Pertanahan PKKPR Non Berusaha</li>
                                <li>Pertimbangan Teknis Pertanahan Kebijakan</li>
                                <li>Pertimbangan Teknis Pertanahan Tanah Timbul</li>
                                <li>Pertimbangan Teknis Pertanahan Proyek Strategis Nasional (PSN)</li>
                            </ul>
                        </div>
                        <div class="timeline-list-group" style="margin-top: 12px;">
                            <div class="timeline-list-title">Layanan Lainnya:</div>
                            <ul class="timeline-list">
                                <li>LAPOL PAK</li>
                                <li>INFORMAL</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Step 2 -->
            <div class="timeline-item reveal">
                <div class="timeline-number">2</div>
                <div class="timeline-card">
                    <div class="timeline-img-wrap">
                        <img src="{{ asset('storage/svg/UnggahDocumen.svg') }}" alt="Unggah Dokumen">
                    </div>
                    <div class="timeline-content">
                        <h3>Unggah Dokumen</h3>
                        <p>Lengkapi dan unggah berkas persyaratan permohonan melalui sistem secara digital dengan mudah dan cepat.</p>
                        
                        <div class="timeline-list-group">
                            <div class="timeline-list-title">10 Berkas Persyaratan yang Diunggah:</div>
                            <ul class="timeline-list">
                                <li>Peta / Sketsa Lokasi yang dimohon</li>
                                <li>Surat Kuasa (apabila dikuasakan)</li>
                                <li>Fotokopi KTP Pemohon</li>
                                <li>Fotokopi NPWP Pemohon</li>
                                <li>Fotokopi Akta Pendirian & Pengesahan Badan Hukum</li>
                                <li>Rencana Penggunaan & Pemanfaatan Tanah</li>
                                <li>Nomor Induk Berusaha (NIB) / Legalitas Usaha</li>
                                <li>Dokumen KBLI yang diajukan (opsional)</li>
                                <li>Proposal Rencana Kegiatan Berusaha (opsional)</li>
                                <li>Persyaratan Lainnya (Sertifikat HAK / SKT / Akta Sewa)</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Step 3 -->
            <div class="timeline-item reveal">
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
                                <li>Pemeriksaan kelengkapan administrasi dan keabsahan dokumen oleh petugas</li>
                                <li>Jika dokumen belum sesuai, pemohon menerima notifikasi perbaikan/revisi berkas</li>
                                <li>Jika berkas valid dan lengkap, permohonan diteruskan ke tahap pemrosesan teknis</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Step 4 -->
            <div class="timeline-item reveal">
                <div class="timeline-number">4</div>
                <div class="timeline-card">
                    <div class="timeline-img-wrap">
                        <img src="{{ asset('storage/svg/LayananBerjalan.svg') }}" alt="Layanan Berjalan">
                    </div>
                    <div class="timeline-content">
                        <h3>Layanan Berjalan</h3>
                        <p>Permohonan Anda sedang diproses. Pantau status perkembangan layanan secara real-time melalui dashboard.</p>
                        
                        <div class="timeline-list-group">
                            <div class="timeline-list-title">Pemantauan & Hasil Layanan:</div>
                            <ul class="timeline-list">
                                <li>Pemrosesan permohonan dan penyusunan rekomendasi / dokumen teknis</li>
                                <li>Pantau status permohonan secara real-time via Dashboard Pemohon</li>
                                <li>Notifikasi WhatsApp otomatis pada setiap pembaruan status</li>
                                <li>Unduh dokumen resmi hasil layanan (PDF) secara digital setelah selesai</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<section class="alur-cta reveal">
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
