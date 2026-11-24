

@extends('layouts.public')

@section('content')
<!-- HERO SECTION -->
<style>
    /* Compact the service panel to fit the hero height with 5 items */
    .hero .sp-slide { gap: 8px !important; }
    .hero .sp-row { padding: 8px 14px !important; }
    .hero .sp-others { padding: 10px 16px 16px !important; gap: 8px !important; }
    .hero .sp-other-card { padding: 10px 14px !important; }
    .hero-brand-flex {
        display: flex;
        align-items: center;
        gap: 16px;
        margin-bottom: 16px;
        flex-wrap: wrap;
    }
    .hero-logo-img {
        width: clamp(70px, 14vw, 160px);
        height: auto;
        object-fit: contain;
        flex-shrink: 0;
    }
    .hero-heading-title {
        margin-bottom: 0;
        text-transform: uppercase;
        font-size: clamp(28px, 5.5vw, 68px);
        line-height: 1.08;
        font-weight: 800;
        letter-spacing: -0.02em;
        color: var(--blue-dk);
    }
    .hero-sub-title {
        font-size: clamp(15px, 2.2vw, 26px);
        font-weight: 800;
        color: #00223D;
        margin-bottom: 20px;
        line-height: 1.35;
    }
    .hero-sub-title .accent {
        color: var(--blue);
        display: inline-block;
        position: relative;
    }
    .hero-sub-title .accent::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: -2px;
        height: 3px;
        width: 100%;
        background: var(--yellow);
        border-radius: 2px;
    }
    @media (max-width: 991px) {
        .hero {
            padding: 28px 0 36px !important;
        }
        .hero-grid {
            grid-template-columns: 1fr !important;
            gap: 28px !important;
        }
    }
    @media (max-width: 576px) {
        .hero-brand-flex {
            gap: 10px;
            margin-bottom: 12px;
        }
        .hero-logo-img {
            width: clamp(54px, 16vw, 75px);
        }
        .hero-heading-title {
            font-size: clamp(22px, 6.5vw, 28px);
            line-height: 1.1;
        }
        .hero-sub-title {
            font-size: clamp(13.5px, 3.8vw, 16px);
            line-height: 1.4;
            margin-bottom: 14px;
        }
        .hero-sub {
            font-size: 13px !important;
            line-height: 1.55 !important;
            margin-bottom: 20px !important;
        }
        .service-panel {
            border-radius: 16px !important;
            box-shadow: 0 10px 30px rgba(17, 52, 84, 0.08) !important;
        }
        .sp-header {
            padding: 12px 14px !important;
        }
        .sp-header-text strong {
            font-size: 13px !important;
        }
        .sp-section-label {
            padding: 10px 14px 6px !important;
            font-size: 11px !important;
        }
        .sp-slide {
            padding: 0 10px 10px !important;
            gap: 8px !important;
        }
        .sp-row {
            padding: 10px 12px !important;
            border-radius: 12px !important;
            gap: 10px !important;
        }
        .sp-row-logo {
            width: 42px !important;
            height: 42px !important;
            flex: 0 0 42px !important;
            border-radius: 10px !important;
        }
        .sp-row-logo img {
            width: 26px !important;
            height: 26px !important;
        }
        .sp-row-info strong {
            font-size: 12px !important;
            line-height: 1.3 !important;
            color: #0F172A !important;
        }
        .sp-row-info span {
            font-size: 10.5px !important;
            color: #64748B !important;
            margin-top: 2px !important;
        }
        .sp-row-cta {
            padding: 6px 10px !important;
            font-size: 10.5px !important;
            font-weight: 700 !important;
            border-radius: 8px !important;
        }
        .sp-others {
            padding: 10px 12px 14px !important;
            gap: 8px !important;
        }
        .sp-other-card {
            padding: 10px 12px !important;
            border-radius: 10px !important;
        }
    }
    @media (max-width: 360px) {
        .hero-brand-flex {
            gap: 8px;
        }
        .hero-logo-img {
            width: 48px;
        }
        .hero-heading-title {
            font-size: 20px;
        }
        .hero-sub-title {
            font-size: 12.5px;
        }
        .sp-row-info strong {
            font-size: 11px !important;
        }
        .sp-row-cta {
            padding: 4px 8px !important;
            font-size: 10px !important;
        }
    }

    /* ─── DESKTOP: SATU LAYAR PER SECTION (1025px+) ─────────── */
    @media (min-width: 1025px) and (min-height: 580px) {
        html:has(.home-section) {
            scroll-snap-type: y proximity;
        }
        .home-section {
            scroll-snap-align: start;
            scroll-margin-top: 68px;
        }

        /* Screen 1: Hero & Panel Layanan */
        .hero.home-section {
            min-height: calc(100dvh - 68px);
            display: flex;
            align-items: center;
            padding: clamp(14px, 2.4vh, 40px) 0;
        }
        .hero-grid {
            align-items: center;
            gap: clamp(24px, 3vw, 48px);
        }
        .hero-brand-flex {
            gap: clamp(12px, 1.5vw, 18px);
            margin-bottom: clamp(8px, 1.3vh, 16px);
        }
        .hero-logo-img {
            width: clamp(60px, 8.5vh, 132px);
        }
        .hero-heading-title {
            font-size: clamp(28px, 4.2vw, 60px);
        }
        .hero-sub-title {
            font-size: clamp(14.5px, 1.7vw, 23px);
            margin-bottom: clamp(10px, 1.5vh, 18px);
        }
        .hero-sub {
            font-size: clamp(12.5px, 1.5vh, 14px);
            line-height: 1.65;
            margin-bottom: clamp(14px, 2.2vh, 26px);
        }
        .hero .sp-header {
            padding: clamp(10px, 1.4vh, 16px) 18px;
        }
        .hero .sp-section-label {
            padding: clamp(6px, 0.9vh, 10px) 18px clamp(4px, 0.6vh, 6px);
        }
        .hero .sp-slide {
            gap: clamp(5px, 0.75vh, 8px) !important;
            padding: 0 14px clamp(6px, 0.9vh, 10px);
        }
        .hero .sp-row {
            padding: clamp(5px, 0.85vh, 9px) 12px !important;
        }
        .hero .sp-row-logo {
            width: clamp(34px, 4.4vh, 44px) !important;
            height: clamp(34px, 4.4vh, 44px) !important;
            flex: 0 0 clamp(34px, 4.4vh, 44px) !important;
        }
        .hero .sp-others {
            padding: clamp(6px, 1vh, 12px) 14px clamp(10px, 1.4vh, 16px) !important;
            gap: 8px !important;
        }
        .hero .sp-other-card {
            padding: clamp(7px, 1vh, 11px) 12px !important;
        }

        /* Screen 2: Statistik + Tahapan Permohonan */
        .home-screen-process {
            min-height: calc(100dvh - 68px);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .home-screen-process .stats-band {
            padding: clamp(16px, 2.4vh, 32px) 0;
            flex-shrink: 0;
        }
        .home-screen-process .stat-icon {
            width: clamp(46px, 6vh, 64px);
            height: clamp(46px, 6vh, 64px);
            margin-bottom: clamp(6px, 0.9vh, 12px);
        }
        .home-screen-process .stat-icon svg,
        .home-screen-process .stat-icon img {
            width: clamp(22px, 3vh, 30px);
            height: clamp(22px, 3vh, 30px);
        }
        .home-screen-process .stat-num {
            font-size: clamp(22px, 3.1vh, 32px);
            margin-bottom: 3px;
        }
        .home-screen-process .stat-label {
            font-size: clamp(11.5px, 1.4vh, 13px);
        }
        .home-screen-process .process {
            flex: 1;
            display: flex;
            align-items: center;
            padding: clamp(16px, 2.8vh, 44px) 0;
        }
        .home-screen-process .section-header {
            margin-bottom: clamp(14px, 2.2vh, 36px);
        }
        .home-screen-process .eyebrow-badge {
            margin-bottom: clamp(8px, 1vh, 14px);
        }
        .home-screen-process .process-track {
            padding-top: clamp(6px, 1vh, 16px);
        }
        .home-screen-process .step-img-wrapper {
            height: clamp(80px, 11.5vh, 122px);
            margin-bottom: clamp(10px, 1.4vh, 18px);
        }
        .home-screen-process .step-img-wrapper img {
            max-height: clamp(76px, 10.5vh, 114px);
        }

        /* Screen 3: Testimoni & Ulasan */
        .reviews.home-section {
            min-height: calc(100dvh - 68px);
            display: flex;
            align-items: center;
            padding: clamp(22px, 3.4vh, 52px) 0;
        }
        .reviews.home-section .section-header {
            margin-bottom: clamp(16px, 2.4vh, 36px);
        }
        .reviews.home-section .reviews-layout {
            margin-top: clamp(12px, 2vh, 28px);
        }

        /* Screen 4: Artikel & Informasi */
        .artikel-section.home-section {
            min-height: calc(100dvh - 68px);
            display: flex;
            align-items: center;
            padding: clamp(20px, 2.8vh, 44px) 0;
        }
        .artikel-section.home-section .section-header {
            margin-bottom: clamp(12px, 1.8vh, 26px);
        }
        .artikel-section.home-section .eyebrow-badge {
            margin-bottom: clamp(6px, 0.9vh, 12px);
        }
        .artikel-section.home-section .artikel-top-grid {
            gap: clamp(14px, 1.8vw, 24px);
            margin-bottom: clamp(14px, 2vh, 24px);
        }
        .artikel-section.home-section .art-featured {
            min-height: clamp(185px, 27vh, 330px);
            padding: clamp(14px, 2vh, 24px);
        }
        .artikel-section.home-section .art-latest-title {
            margin-bottom: clamp(8px, 1.2vh, 14px);
        }
        .artikel-section.home-section .art-latest-list {
            gap: clamp(8px, 1.1vh, 14px);
        }
        .artikel-section.home-section .art-list-img {
            width: clamp(54px, 7.2vh, 84px);
            height: clamp(54px, 7.2vh, 84px);
        }
        .artikel-section.home-section .art-carousel-wrap {
            margin-top: 0 !important;
            padding-bottom: 0;
        }
        .artikel-section.home-section .art-card-img {
            height: clamp(92px, 13.5vh, 165px);
        }
        .artikel-section.home-section .art-card-body {
            padding: clamp(10px, 1.4vh, 16px);
        }
        .artikel-section.home-section .art-card-desc {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            margin-bottom: 10px;
        }
        .artikel-section.home-section .art-dots {
            margin: clamp(8px, 1.2vh, 14px) 0 0;
        }

        /* Screen 5: CTA Band + Footer pas dalam 1 layar bawah */
        .cta-band.home-section {
            padding: clamp(20px, 3.6vh, 64px) 0;
        }
        .cta-band.home-section .cta-heading {
            font-size: clamp(22px, 3vw, 38px);
            margin-bottom: clamp(6px, 1vh, 12px);
        }
        .cta-band.home-section .cta-sub {
            font-size: clamp(12.5px, 1.45vh, 14px);
            margin-bottom: clamp(14px, 2.2vh, 26px);
        }
        .cta-band.home-section .btn-cta-primary,
        .cta-band.home-section .btn-cta-outline {
            padding: clamp(9px, 1.3vh, 13px) clamp(18px, 2vw, 26px);
            font-size: clamp(12.5px, 1.45vh, 14px);
        }
        body:has(.home-section) .site-footer {
            padding-top: clamp(22px, 3.2vh, 48px);
        }
        body:has(.home-section) .footer-grid {
            gap: clamp(18px, 2.2vw, 32px);
            padding-bottom: clamp(18px, 2.8vh, 42px);
        }
        body:has(.home-section) .f-col-title {
            margin-bottom: clamp(8px, 1.2vh, 14px);
        }
        body:has(.home-section) .f-links {
            gap: clamp(6px, 0.9vh, 10px);
        }
        body:has(.home-section) .footer-desc {
            font-size: clamp(11.5px, 1.35vh, 13px);
            margin-top: 10px;
        }
        body:has(.home-section) .f-links a,
        body:has(.home-section) .f-contact-item {
            font-size: clamp(11.5px, 1.35vh, 12.5px);
        }
    }
</style>
<section class="hero home-section">
    <div class="hero-bg" aria-hidden="true"></div>
    <div class="container">
        <div class="hero-grid">

            <!-- Left: Copy -->
            <div>
                <div class="hero-brand-flex">

                    <img src="{{ asset('storage/logo/PATEN PAK MIKO LOGO.png') }}" alt="Logo PATEN PAK MIKO" class="hero-logo-img">

                    <h1 class="hero-heading-title">

                        PATEN<br>PAK MIKO

                    </h1>

                </div>

                <h2 class="hero-sub-title">

                    Pertimbangan Teknis <span class="accent">Pertanahan</span> Terintegrasi Kantor Pertanahan Kota Sukabumi

                </h2>



                <p class="hero-sub">

                    PATEN PAK MIKO hadir sebagai inovasi pelayanan yang memberikan kemudahan bagi pemohon dalam memperoleh layanan pertanahan secara lebih cepat, jelas, dan transparan. PATEN PAK MIKO diharapkan mampu meningkatkan kepercayaan pemohon sekaligus memberikan pengalaman layanan yang lebih <strong style="color: var(--blue-dk);">profesional, responsif, dan memudahkan.</strong>

                </p>



                <div class="hero-cta-row">

                    <a href="{{ route('kontak') }}" class="btn-primary">

                        Hubungi Kami

                        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>

                    </a>

                    <a href="#modul" class="btn-outline">

                        Pelajari Layanan Kami

                        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>

                    </a>

                </div>

            </div>



            <!-- Right: Service Panel -->

            <div>

            <div class="service-panel" id="modul">

                <!-- Header -->

                <div class="sp-header">

                    <div class="sp-header-icon">

                        <svg viewBox="0 0 24 24" aria-hidden="true">

                            <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>

                            <polyline points="9 22 9 12 15 12 15 22"/>

                        </svg>

                    </div>

                    <div class="sp-header-text">

                        <strong>Pilih Jenis Layanan yang Anda Butuhkan</strong>

                    </div>

                </div>



                <!-- Pertimbangan Teknis Pertanahan Slider Section -->

                <div class="sp-section-label">

                    <span>Layanan Pertimbangan Teknis Pertanahan</span>

                </div>



                <div class="sp-rows" id="spRows">

                    <!-- Slide 1 -->

                    <div class="sp-slide">

                        <a href="{{ route('ptp.create', ['layanan' => 'berusaha']) }}" class="sp-row">

                            <div class="sp-row-logo" style="flex: 0 0 48px; height: 48px; background: #f0f7ff; color: #1e40af; border-radius: 12px; display: flex; align-items: center; justify-content: center;">

                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="width: 24px; height: 24px;"><path d="M4 19.5A2.5 2.5 0 016.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 014 19.5v-15A2.5 2.5 0 016.5 2z"/></svg>

                            </div>

                            <div class="sp-row-info">

                                <strong>Pertimbangan Teknis Pertanahan PKKPR Berusaha</strong>

                                <span>Bisnis, usaha, industri</span>

                            </div>

                            <div class="sp-row-cta">

                                Daftar

                                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>

                            </div>

                        </a>

                        <a href="{{ route('ptp.create', ['layanan' => 'non-berusaha']) }}" class="sp-row">

                            <div class="sp-row-logo" style="flex: 0 0 48px; height: 48px; background: #f0f7ff; color: #1e40af; border-radius: 12px; display: flex; align-items: center; justify-content: center;">

                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="width: 24px; height: 24px;"><path d="M4 19.5A2.5 2.5 0 016.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 014 19.5v-15A2.5 2.5 0 016.5 2z"/></svg>

                            </div>

                            <div class="sp-row-info">

                                <strong>Pertimbangan Teknis Pertanahan PKKPR Non Berusaha</strong>

                                <span>Rumah, sosial, keagamaan</span>

                            </div>

                            <div class="sp-row-cta">

                                Daftar

                                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>

                            </div>

                        </a>

                        <a href="{{ route('ptp.create', ['layanan' => 'kebijakan']) }}" class="sp-row">

                            <div class="sp-row-logo" style="flex: 0 0 48px; height: 48px; background: #f0f7ff; color: #1e40af; border-radius: 12px; display: flex; align-items: center; justify-content: center;">

                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="width: 24px; height: 24px;"><path d="M4 19.5A2.5 2.5 0 016.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 014 19.5v-15A2.5 2.5 0 016.5 2z"/></svg>

                            </div>

                            <div class="sp-row-info">

                                <strong>Pertimbangan Teknis Pertanahan Kebijakan</strong>

                                <span>Kebijakan pengguna &amp; pemanfaatan tanah</span>

                            </div>

                            <div class="sp-row-cta">

                                Daftar

                                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>

                            </div>

                        </a>

                        <a href="{{ route('ptp.create', ['layanan' => 'tanah-timbul']) }}" class="sp-row">

                            <div class="sp-row-logo" style="flex: 0 0 48px; height: 48px; background: #f0f7ff; color: #1e40af; border-radius: 12px; display: flex; align-items: center; justify-content: center;">

                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="width: 24px; height: 24px;"><path d="M4 19.5A2.5 2.5 0 016.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 014 19.5v-15A2.5 2.5 0 016.5 2z"/></svg>

                            </div>

                            <div class="sp-row-info">

                                <strong>Pertimbangan Teknis Pertanahan Tanah Timbul</strong>

                                <span>Layanan pendaftaran tanah timbul</span>

                            </div>

                            <div class="sp-row-cta">

                                Daftar

                                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>

                            </div>

                        </a>

                        <a href="{{ route('ptp.create', ['layanan' => 'psn']) }}" class="sp-row">

                            <div class="sp-row-logo" style="flex: 0 0 48px; height: 48px; background: #f0f7ff; color: #1e40af; border-radius: 12px; display: flex; align-items: center; justify-content: center;">

                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="width: 24px; height: 24px;"><path d="M4 19.5A2.5 2.5 0 016.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 014 19.5v-15A2.5 2.5 0 016.5 2z"/></svg>

                            </div>

                            <div class="sp-row-info">

                                <strong>Pertimbangan Teknis Pertanahan Proyek Strategis Nasional (PSN)</strong>

                                <span>Layanan permohonan proyek strategis</span>

                            </div>

                            <div class="sp-row-cta">

                                Daftar

                                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>

                            </div>

                        </a>

                        </div>



                    </div>



                    <div class="sp-divider"></div>



                    <!-- Layanan Lainnya -->

                    <div class="sp-section-label">Layanan Lainnya</div>

                    <div class="sp-others">

                        <a href="{{ route('lapolpa.index') }}" class="sp-other-card">

                            <div class="sp-other-logo">

                                <img src="{{ asset('storage/logo/Lapolpak.png') }}" alt="LAPOL PAK">

                            </div>

                            <span class="sp-other-name">LAPOL PAK</span>

                            <div class="sp-other-arrow">

                                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>

                            </div>

                        </a>

                        <a href="{{ route('informal.index') }}" class="sp-other-card">

                            <div class="sp-other-logo">

                                <img src="{{ asset('storage/logo/Informal.png') }}" alt="INFORMAL">

                            </div>

                            <span class="sp-other-name">INFORMAL</span>

                            <div class="sp-other-arrow">

                                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>

                            </div>

                        </a>

                    </div>



                </div>

            </div>

        </div>

    </div>

</section>





<!--  SCREEN 2: STATS + PROCESS  -->
<div class="home-screen-process home-section">
<div class="stats-band">

    <div class="container">

        <div class="stats-inner">

            @php

                $statsData = $statsData ?? [];

                $hasPermOverride = isset($statsData['permohonan_diproses']) && trim((string)$statsData['permohonan_diproses']) !== '';
                $permValue = $hasPermOverride ? $statsData['permohonan_diproses'] : number_format($totalPermohonan ?? 0);

                $penyValue = !empty($statsData['rata_rata_penyelesaian']) ? $statsData['rata_rata_penyelesaian'] : '10 hari';

                $hasRatingOverride = isset($statsData['rating_override']) && trim((string)$statsData['rating_override']) !== '' && $statsData['rating_override'] !== '0' && $statsData['rating_override'] !== '0.0';

                $ratingVal = $hasRatingOverride ? $statsData['rating_override'] : (($averageRating && $averageRating !== '0.0' && $averageRating !== '0') ? $averageRating : '5.0');

                $ratingSuffix = ($hasRatingOverride || str_contains((string)$ratingVal, '/')) ? '' : '/5';



                $stats = [

                    [

                        'icon' => '<img src="'.asset('storage/svg/quote-request 1.svg').'" alt="">',

                        'value' => $permValue,

                        'suffix' => '',

                        'label' => 'Permohonan Diproses',

                    ],

                    [

                        'icon' => '<img src="'.asset('storage/svg/tag 1.svg').'" alt="">',

                        'value' => $ratingVal,

                        'suffix' => $ratingSuffix,

                        'label' => 'Rata-rata Rating',

                    ],

                    [

                        'icon' => '<img src="'.asset('storage/svg/calendar 1.svg').'" alt="">',

                        'value' => $penyValue,

                        'suffix' => '',

                        'label' => 'Rata-rata Penyelesaian',

                    ],

                    [

                        'icon' => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>',

                        'value' => number_format((int)($visitorCount ?? 0)),

                        'suffix' => '',

                        'label' => 'Kunjungan',

                    ],

                ];

            @endphp

            @foreach($stats as $stat)

            <div class="stat-item">

                <div class="stat-icon" aria-hidden="true">{!! $stat['icon'] !!}</div>

                <div class="stat-num">{{ $stat['value'] }}@if($stat['suffix'])<em>{{ $stat['suffix'] }}</em>@endif</div>

                <div class="stat-label">{{ $stat['label'] }}</div>

            </div>

            @endforeach

        </div>

    </div>

</div>





<!--  PROCESS  -->

<section id="alur" class="section process">

    <div class="container">

        <div class="section-header section-header-center reveal">

            <div class="eyebrow-badge">Tahapan Permohonan</div>

            <h2 class="section-title">Proses Sederhana, Hanya Empat Tahap</h2>

            <p class="section-sub">Ikuti langkah-langkah pengajuan layanan dengan mudah, cepat, dan transparan melalui sistem PATEN PAK MIKO.</p>

        </div>

        <div class="process-track">

            <div class="process-step reveal reveal-d1">

                <div class="step-img-wrapper">

                    <img src="{{ asset('storage/svg/PilihLayanan.svg') }}" alt="Pilih Layanan">

                </div>

                <h3 class="step-title">Pilih Layanan</h3>

                <p class="step-desc">Tentukan jenis layanan permohonan yang sesuai dengan kebutuhan dan kriteria kegiatan pemanfaatan ruang Anda.</p>

            </div>

            <div class="process-step reveal reveal-d2">

                <div class="step-img-wrapper">

                    <img src="{{ asset('storage/svg/UnggahDocumen.svg') }}" alt="Unggah Dokumen">

                </div>

                <h3 class="step-title">Unggah Dokumen</h3>

                <p class="step-desc">Lengkapi dan unggah berkas persyaratan permohonan melalui sistem secara digital dengan mudah dan cepat.</p>

            </div>

            <div class="process-step reveal reveal-d3">

                <div class="step-img-wrapper">

                    <img src="{{ asset('storage/svg/Verifikasi&Validasi.svg') }}" alt="Verifikasi dan Validasi Berkas">

                </div>

                <h3 class="step-title">Verifikasi dan Validasi Berkas</h3>

                <p class="step-desc">Petugas Kantor Pertanahan akan memeriksa kelengkapan dan kesesuaian dokumen yang telah Anda unggah ke sistem.</p>

            </div>

            <div class="process-step reveal reveal-d4">

                <div class="step-img-wrapper">

                    <img src="{{ asset('storage/svg/LayananBerjalan.svg') }}" alt="Layanan Berjalan">

                </div>

                <h3 class="step-title">Layanan Berjalan</h3>

                <p class="step-desc">Permohonan Anda sedang diproses. Pantau status perkembangan layanan secara real-time melalui dashboard.</p>

            </div>

        </div>

    </div>

</section>
</div>

<!--  REVIEWS  -->

<section id="ulasan" class="reviews home-section">

    <div class="container">

        <div class="section-header section-header-center reveal">

            <div class="eyebrow-badge">Testimoni</div>

            <h2 class="section-title">Pendapat dan Kepuasan Masyarakat</h2>

            <p class="section-sub">Lihat pengalaman dan ulasan dari pengguna yang telah merasakan kemudahan layanan digital PATEN PAK MIKO.</p>

        </div>



        <div class="reviews-layout">

            <div class="reviews-sidebar reveal">

                <h3 class="reviews-sidebar-title">Testimoni<br>Pengguna</h3>

                <div class="reviews-nav">

                    <button class="btn-rev-nav" id="revPrev" aria-label="Ulasan sebelumnya">

                        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M15 18l-6-6 6-6"/></svg>

                    </button>

                    <button class="btn-rev-nav" id="revNext" aria-label="Ulasan berikutnya">

                        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M9 18l6-6-6-6"/></svg>

                    </button>

                </div>

            </div>



            <div class="reviews-slider-wrap reveal reveal-d2">

                @if($reviews->isEmpty())

                <div class="reviews-empty">

                    <p>Belum ada ulasan yang dipublikasikan saat ini.</p>

                </div>

                @else

                <div class="reviews-slider" id="revSlider">

                    @foreach($reviews as $review)

                    <div class="review-card">

                        <div class="review-header">

                            <div class="review-check">

                                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M20 6L9 17l-5-5"/></svg>

                            </div>

                            <div class="review-author">

                                <h4>{{ $review->reviewer_name }}</h4>

                                <span>Sukabumi &bull; {{ $review->module_label_display }}</span>

                            </div>

                        </div>

                        <p class="review-text">"{{ $review->comment }}"</p>

                        <div class="review-foot-stars" aria-label="5 bintang">

                            @for($i = 0; $i < 5; $i++)

                            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>

                            @endfor

                        </div>

                    </div>

                    @endforeach

                </div>

                <div class="reviews-dots" id="revDots" role="tablist" aria-label="Review navigation">

                    @foreach($reviews as $index => $review)

                    <div class="rev-dot {{ $index === 0 ? 'active' : '' }}"

                         role="tab"

                         tabindex="0"

                         aria-label="Ulasan {{ $index + 1 }}"

                         onclick="goToRev({{ $index }})"

                         onkeydown="if(event.key==='Enter') goToRev({{ $index }})">

                    </div>

                    @endforeach

                </div>

                @endif

            </div>

        </div>

    </div>

</section>





<!--  ARTIKEL & INFORMASI  -->

<section id="artikel" class="artikel-section home-section">

    <div class="container">

        <div class="section-header section-header-center reveal">

            <div class="eyebrow-badge" style="background:#EBF8FF; color:#3291A8;">Artikel Kami</div>

            <h2 class="section-title" style="color:#113454;">Artikel &amp; Informasi Terbaru</h2>

            <p class="section-sub">Temukan berbagai informasi, panduan, dan berita terbaru seputar pelayanan pertanahan dan administrasi digital.</p>

        </div>



        @if($beritas->isEmpty())

        <div class="text-center py-5">

            <p class="text-muted">Belum ada artikel atau berita yang dipublikasikan.</p>

        </div>

        @else

        <div class="artikel-top-grid reveal reveal-d1">

            <!-- Featured (Latest 1) -->

            @php $featured = $beritas->first(); @endphp

            <div class="art-featured" style="background-image: url('{{ $featured->image_path ? Storage::url($featured->image_path) : 'https://dummyimage.com/1200x800/eeeeee/31343c.png&text=Paten+Pak+Miko' }}');">

                <div class="art-featured-content">

                    <span class="art-badge">{{ $featured->category ?? 'Umum' }}</span>

                    <h3 class="art-featured-title">{{ $featured->title }}</h3>

                    <span class="art-featured-date">{{ $featured->created_at->format('l, d F Y') }}</span>

                    <a href="{{ route('berita.show', $featured->slug) }}" class="btn btn-sm btn-primary mt-3" style="width: fit-content;">Baca Artikel</a>

                </div>

            </div>



            <!-- Latest List (Next 3) -->

            <div class="art-latest">

                <h3 class="art-latest-title">Latest <span>Post</span></h3>

                <div class="art-latest-list">

                    @foreach($beritas->slice(1, 3) as $post)

                    <div class="art-list-item">

                        <img src="{{ $post->image_path ? Storage::url($post->image_path) : 'https://dummyimage.com/180x180/eeeeee/31343c.png&text=News' }}" alt="{{ $post->title }}" class="art-list-img" loading="lazy">

                        <div class="art-list-info">

                            <h4 class="art-list-title">

                                <a href="{{ route('berita.show', $post->slug) }}" style="color: inherit; text-decoration: none;">{{ $post->title }}</a>

                            </h4>

                            <span class="art-list-date">{{ $post->created_at->format('l, d F Y') }}</span>

                        </div>

                    </div>

                    @endforeach

                </div>

            </div>

        </div>



        <!-- Carousel (All others or duplicates for carousel effect) -->

        <div class="art-carousel-wrap reveal reveal-d2 mt-5">

            <div class="art-carousel" id="artCarousel">

                @foreach($beritas as $berita)

                <div class="art-card">

                    <img src="{{ $berita->image_path ? Storage::url($berita->image_path) : 'https://dummyimage.com/600x400/eeeeee/31343c.png&text=News' }}" alt="{{ $berita->title }}" class="art-card-img" loading="lazy">

                    <div class="art-card-body">

                        <div class="art-card-meta">

                            <span>{{ $berita->created_at->format('d M Y') }}</span>

                        </div>

                        <h4 class="art-card-title">{{ $berita->title }}</h4>

                        <span class="art-card-cat">{{ $berita->category ?? 'Umum' }}</span>

                        <p class="art-card-desc">{{ Str::limit(strip_tags($berita->content), 100) }}</p>

                        <a href="{{ route('berita.show', $berita->slug) }}" class="art-card-link">Baca selengkapnya &rarr;</a>

                    </div>

                </div>

                @endforeach

            </div>

            <div class="art-dots" id="artDots" role="tablist">

                @for ($i = 1; $i <= min(3, ceil($beritas->count() / 3)); $i++)

                <div class="art-dot {{ $i == 1 ? 'active' : '' }}" role="tab" aria-label="Halaman {{ $i }}"></div>

                @endfor

            </div>

        </div>

        @endif

    </div>

</section>





<!--  CTA BAND  -->

<section class="cta-band home-section" style="background-image: url('{{ asset('storage/aset/Footer.png') }}');">

    <div class="container">

        <div class="cta-inner reveal">

            <h2 class="cta-heading">

                Wujudkan Pelayanan<br>

                Administrasi yang <span>Lebih Mudah</span>

            </h2>

            <p class="cta-sub">

                Mulai proses pengajuan Anda sekarang melalui sistem PATEN PAK MIKO<br>

                yang cepat, aman, dan terintegrasi secara digital.

            </p>

            <div class="cta-actions">

                <a href="{{ route('login') }}" class="btn-cta-primary">Mulai Sekarang &rarr;</a>

                <a href="{{ route('alur') }}" class="btn-cta-outline">Pelajari Layanan &rarr;</a>

            </div>

        </div>

    </div>

</section>





@endsection

