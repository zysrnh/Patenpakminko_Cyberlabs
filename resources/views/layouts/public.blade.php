<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PATEN PAK MIKO — Pertimbangan Teknis Pertanahan')</title>

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('storage/ico/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('storage/ico/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('storage/ico/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('storage/ico/site.webmanifest') }}">
    <link rel="shortcut icon" href="{{ asset('storage/ico/favicon.ico') }}">


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">

    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}

    <style>
        /* ─── RESET & BASE ────────────────────────────────── */
        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --blue:      #218AC9;
            --blue-dk:   #003B64;
            --blue-lt:   #E3F0F9;
            --blue-md:   #B3D4EC;
            --yellow:    #FFCB05;
            --yellow-lt: #FFF8D6;
            --brown:     #D37324;
            --green:     #85C341;
            --green-dk:  #79A73A;
            --green-lt:  #EEF7E2;
            --ink:       #1a1a2e;
            --mid:       #4a5568;
            --muted:     #8a9bb5;
            --line:      #e8edf2;
            --surface:   #F7F9FC;
            --white:     #FFFFFF;
            --r-sm:  4px;
            --r-md:  4px;
            --r-lg:  8px;
            --r-xl:  12px;

            /* Spacing scale */
            --sp-xs:  8px;
            --sp-sm:  16px;
            --sp-md:  24px;
            --sp-lg:  40px;
            --sp-xl:  64px;
            --sp-2xl: 96px;
        }

        html {
            scroll-behavior: smooth;
            -webkit-text-size-adjust: 100%;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--white);
            color: var(--ink);
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            overflow-x: hidden;
            min-width: 320px;
        }

        img {
            max-width: 100%;
            height: auto;
            display: block;
        }

        a {
            -webkit-tap-highlight-color: transparent;
        }

        button {
            -webkit-tap-highlight-color: transparent;
            touch-action: manipulation;
        }

        .container {
            width: 100%;
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 var(--sp-lg);
        }


        /* ═══════════════════════════════════════════════════
           HEADER
        ═══════════════════════════════════════════════════ */
        #site-header {
            position: sticky;
            top: 0;
            z-index: 100;
            background: rgba(255,255,255,.97);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--line);
            box-shadow: 0 4px 12px rgba(0,0,0,.06);
            transition: box-shadow .3s;
        }
        #site-header.scrolled {
            box-shadow: 0 6px 24px rgba(0,59,100,.18);
        }

        .header-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 68px;
            gap: var(--sp-sm);
        }

        /* Logo */
        .logo-wrap {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            flex-shrink: 0;
            min-width: 0;
        }
        .logo-img {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--line);
            flex-shrink: 0;
        }
        .logo-text {
            min-width: 0;
        }
        .logo-text strong {
            display: block;
            font-size: 14px;
            font-weight: 800;
            color: var(--ink);
            letter-spacing: -.02em;
            white-space: nowrap;
        }
        .logo-text span {
            display: block;
            font-size: 10px;
            font-weight: 500;
            color: var(--muted);
            margin-top: 1px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* Desktop Nav */
        .site-nav {
            display: flex;
            align-items: center;
            gap: 8px;
            flex: 1;
            justify-content: flex-end;
        }
        .nav-link {
            font-size: 13px;
            font-weight: 500;
            color: var(--mid);
            text-decoration: none;
            padding: 7px 12px;
            border-radius: var(--r-md);
            transition: all .18s;
            white-space: nowrap;
        }
        .nav-link:hover {
            color: var(--blue-dk);
            background: var(--blue-lt);
        }

        /* Dropdown */
        .nav-dropdown {
            position: relative;
        }
        .nav-dropdown-trigger {
            display: flex;
            align-items: center;
            gap: 4px;
            font-size: 13px;
            font-weight: 500;
            color: var(--mid);
            padding: 7px 12px;
            border-radius: var(--r-md);
            text-decoration: none;
            cursor: pointer;
            transition: all .18s;
            background: none;
            border: none;
            font-family: inherit;
        }
        .nav-dropdown-trigger:hover {
            color: var(--blue-dk);
            background: var(--blue-lt);
        }
        .nav-dropdown-trigger svg {
            width: 14px;
            height: 14px;
            transition: transform .2s;
            flex-shrink: 0;
        }
        .nav-dropdown:hover .nav-dropdown-trigger svg {
            transform: rotate(180deg);
        }
        .nav-dropdown-content {
            visibility: hidden;
            opacity: 0;
            transform: translateY(8px);
            position: absolute;
            background: #fff;
            min-width: 280px;
            box-shadow: 0 8px 32px rgba(0,0,0,.12);
            z-index: 200;
            border-radius: var(--r-lg);
            border: 1px solid var(--line);
            top: calc(100% + 6px);
            left: 0;
            padding: 6px;
            transition: all .22s cubic-bezier(.16,1,.3,1);
        }
        .nav-dropdown:hover .nav-dropdown-content {
            visibility: visible;
            opacity: 1;
            transform: translateY(0);
        }
        .nav-dropdown-content a {
            color: var(--mid);
            padding: 9px 12px;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 13px;
            font-weight: 500;
            border-radius: 8px;
            transition: all .15s;
        }
        .nav-dropdown-content a:hover {
            background: var(--surface);
            color: var(--blue-dk);
        }
        .nav-dd-icon {
            width: 28px;
            height: 28px;
            border-radius: 7px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            overflow: hidden;
        }
        .nav-dd-icon img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .nav-sep {
            width: 1px;
            height: 20px;
            background: var(--line);
            margin: 0 12px;
            flex-shrink: 0;
        }

        /* CTA Button */
        .btn-nav {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: var(--blue-dk);
            color: #fff;
            padding: 9px 18px;
            border-radius: 5px;
            font-family: inherit;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: all .2s;
            white-space: nowrap;
            flex-shrink: 0;
        }
        .btn-nav svg {
            width: 14px;
            height: 14px;
            fill: var(--yellow);
            flex-shrink: 0;
        }
        .btn-nav:hover {
            background: #00294a;
            box-shadow: 0 4px 16px rgba(0,59,100,.3);
            transform: translateY(-1px);
        }

        /* Hamburger */
        .nav-hamburger {
            display: none;
            flex-direction: column;
            justify-content: center;
            gap: 5px;
            background: none;
            border: none;
            cursor: pointer;
            padding: 6px;
            border-radius: var(--r-md);
            flex-shrink: 0;
        }
        .nav-hamburger span {
            display: block;
            width: 22px;
            height: 2px;
            background: var(--ink);
            border-radius: 2px;
            transition: all .3s;
        }
        .nav-hamburger.active span:nth-child(1) {
            transform: rotate(45deg) translate(5px, 5px);
        }
        .nav-hamburger.active span:nth-child(2) {
            opacity: 0;
        }
        .nav-hamburger.active span:nth-child(3) {
            transform: rotate(-45deg) translate(5px, -5px);
        }

        /* Mobile Nav Overlay */
        .mobile-nav {
            display: none;
            position: fixed;
            inset: 0;
            z-index: 150;
            background: #fff;
            padding: 0;
            flex-direction: column;
            overflow-y: auto;
            overscroll-behavior: contain;
        }
        .mobile-nav.open {
            display: flex;
        }
        .mobile-nav-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 20px;
            border-bottom: 1px solid var(--line);
            position: sticky;
            top: 0;
            background: #fff;
            z-index: 10;
        }
        .mobile-nav-body {
            padding: 12px 20px 40px;
            display: flex;
            flex-direction: column;
        }
        .mobile-nav-body a,
        .mobile-nav-body button {
            font-size: 15px;
            font-weight: 600;
            color: var(--ink);
            text-decoration: none;
            padding: 14px 0;
            border: none;
            border-bottom: 1px solid var(--line);
            background: none;
            font-family: inherit;
            cursor: pointer;
            text-align: left;
            transition: color .18s;
            display: block;
            width: 100%;
        }
        .mobile-nav-body a:hover {
            color: var(--blue-dk);
        }
        .mobile-nav-body a:last-child {
            border-bottom: none;
        }
        .mobile-nav-body .mobile-section-label {
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .08em;
            color: var(--muted);
            padding: 20px 0 8px;
            border-bottom: none;
        }
        .mobile-nav-body .mobile-cta {
            margin-top: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: var(--blue-dk);
            color: #fff !important;
            padding: 14px;
            border-radius: 10px;
            font-weight: 700;
            border-bottom: none !important;
        }
        .mobile-nav-close {
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--surface);
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 20px;
            color: var(--ink);
            line-height: 1;
        }


        /* ═══════════════════════════════════════════════════
           HERO
        ═══════════════════════════════════════════════════ */
        .hero {
            padding: var(--sp-xl) 0 var(--sp-xl);
            background: var(--white);
            position: relative;
            overflow: hidden;
        }
        .hero-bg {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            width: 55%;
            pointer-events: none;
            background: radial-gradient(ellipse at 80% 30%, rgba(227,240,249,.7) 0%, transparent 65%);
        }
        .hero-grid {
            display: grid;
            grid-template-columns: 1fr 1.1fr;
            gap: 48px;
            align-items: start;
            position: relative;
            z-index: 1;
        }
        .hero-grid > div {
            min-width: 0;
        }

        /* Hero Copy */
        .hero-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .08em;
            text-transform: uppercase;
            color: var(--blue);
            background: var(--blue-lt);
            border: 1px solid var(--blue-md);
            padding: 5px 14px 5px 10px;
            border-radius: 4px;
            margin-bottom: 20px;
        }
        .eyebrow-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: var(--blue);
            flex-shrink: 0;
        }

        .hero-heading {
            font-size: clamp(26px, 3.5vw, 48px);
            font-weight: 800;
            line-height: 1.12;
            letter-spacing: -.03em;
            color: var(--ink);
            margin-bottom: 20px;
        }
        .hero-heading .accent {
            color: var(--blue);
            display: inline-block;
            position: relative;
        }
        .hero-heading .accent::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -3px;
            height: 3px;
            width: 65%;
            background: var(--yellow);
            border-radius: 2px;
        }

        .hero-sub {
            font-size: 14px;
            line-height: 1.8;
            color: var(--mid);
            margin-bottom: 32px;
        }

        .hero-cta-row {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }
        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--blue-dk);
            color: #fff;
            padding: 13px 24px;
            border-radius: 10px;
            font-family: inherit;
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: all .22s;
            white-space: nowrap;
        }
        .btn-primary svg {
            width: 15px;
            height: 15px;
            fill: none;
            stroke: #fff;
            stroke-width: 2.5;
            stroke-linecap: round;
            stroke-linejoin: round;
            flex-shrink: 0;
        }
        .btn-primary:hover {
            background: var(--blue);
            box-shadow: 0 6px 24px rgba(33,138,201,.35);
            transform: translateY(-1px);
        }
        .btn-outline {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: transparent;
            color: var(--mid);
            padding: 12px 20px;
            border-radius: 10px;
            font-family: inherit;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            border: 1.5px solid var(--line);
            cursor: pointer;
            transition: all .22s;
            white-space: nowrap;
        }
        .btn-outline svg {
            width: 14px;
            height: 14px;
            fill: none;
            stroke: currentColor;
            stroke-width: 2.5;
            stroke-linecap: round;
            stroke-linejoin: round;
            flex-shrink: 0;
        }
        .btn-outline:hover {
            border-color: var(--blue-dk);
            color: var(--blue-dk);
            background: var(--blue-lt);
        }


        /* ═══════════════════════════════════════════════════
           SERVICE PANEL
        ═══════════════════════════════════════════════════ */
        .service-panel {
            background: #fff;
            border: 1px solid var(--line);
            border-radius: 5px;
            box-shadow:
                0 4px 12px rgba(0,0,0,.04),
                0 16px 40px rgba(0,59,100,.08);
            overflow: hidden;
            width: 100%;
        }

        .sp-header {
            background: #002845;
            padding: 18px 20px;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .sp-header-icon {
            width: 28px;
            height: 28px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .sp-header-icon svg {
            width: 20px;
            height: 20px;
            fill: none;
            stroke: var(--yellow);
            stroke-width: 2.5;
            stroke-linecap: round;
            stroke-linejoin: round;
        }
        .sp-header-text strong {
            display: block;
            font-size: 13px;
            font-weight: 700;
            color: #fff;
            line-height: 1.4;
        }

        .sp-section-label {
            font-size: 10px;
            font-weight: 800;
            color: var(--mid);
            text-transform: uppercase;
            letter-spacing: .08em;
            padding: 16px 20px 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }
        .sp-section-label > span {
            flex: 1;
            min-width: 0;
            line-height: 1.4;
        }
        .sp-section-label-nav {
            display: flex;
            gap: 6px;
            flex-shrink: 0;
        }

        /* Slider container */
        .sp-rows {
            padding: 0 16px 10px;
            display: flex;
            flex-direction: row;
            gap: 16px;
            overflow-x: auto;
            scroll-snap-type: x mandatory;
            scroll-behavior: smooth;
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        .sp-rows::-webkit-scrollbar { display: none; }

        .sp-slide {
            display: flex;
            flex-direction: column;
            gap: 10px;
            flex: 0 0 100%;
            max-width: 100%;
            scroll-snap-align: start;
        }

        .sp-row {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 14px 16px;
            border-radius: 5px;
            background: #F4F7FA;
            text-decoration: none;
            transition: all .2s;
            border: 1px solid transparent;
        }
        .sp-row:hover {
            background: #fff;
            border-color: var(--blue-md);
            box-shadow: 0 8px 24px rgba(33,138,201,.08);
            transform: translateY(-2px);
        }
        .sp-row-logo {
            width: 72px;
            height: 72px;
            overflow: hidden;
            flex-shrink: 0;
            background: transparent;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .sp-row-logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }
        .sp-row-info {
            flex: 1;
            min-width: 0;
        }
        .sp-row-info strong {
            display: block;
            font-size: 14px;
            font-weight: 800;
            color: #003B64;
            margin-bottom: 3px;
            line-height: 1.35;
        }
        .sp-row-info span {
            font-size: 11px;
            color: var(--mid);
            font-weight: 500;
        }
        .sp-row-cta {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 11px;
            font-weight: 700;
            color: var(--blue);
            background: var(--blue-lt);
            padding: 7px 14px;
            border-radius: 20px;
            white-space: nowrap;
            flex-shrink: 0;
            transition: all .2s;
        }
        .sp-row:hover .sp-row-cta {
            background: var(--blue);
            color: #fff;
        }
        .sp-row-cta svg {
            width: 12px;
            height: 12px;
            fill: none;
            stroke: currentColor;
            stroke-width: 2.5;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        /* Slider nav buttons */
        .btn-slider {
            width: 28px;
            height: 28px;
            border-radius: 6px;
            background: #F4F7FA;
            border: 1px solid var(--line);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: var(--blue-dk);
            transition: all .2s;
            flex-shrink: 0;
        }
        .btn-slider:hover {
            background: var(--blue-lt);
            border-color: var(--blue-dk);
        }
        .btn-slider svg {
            width: 14px;
            height: 14px;
            fill: none;
            stroke: currentColor;
            stroke-width: 2.5;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .sp-divider { height: 1px; background: var(--line); margin: 0 16px; }

        /* Others 2-col grid */
        .sp-others {
            padding: 12px 16px 20px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }
        .sp-other-card {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px;
            border-radius: 6px;
            background: #fff;
            text-decoration: none;
            border: 1px solid var(--line);
            transition: all .2s;
        }
        .sp-other-card:hover {
            border-color: var(--blue-md);
            box-shadow: 0 8px 24px rgba(33,138,201,.08);
            transform: translateY(-2px);
        }
        .sp-other-logo {
            width: 52px;
            height: 52px;
            overflow: hidden;
            flex-shrink: 0;
            background: transparent;
        }
        .sp-other-logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }
        .sp-other-name {
            font-size: 12px;
            font-weight: 800;
            color: var(--ink);
            flex: 1;
            min-width: 0;
            line-height: 1.3;
        }
        .sp-other-arrow {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: var(--line);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            transition: all .2s;
        }
        .sp-other-card:hover .sp-other-arrow { background: var(--blue-dk); }
        .sp-other-arrow svg {
            width: 11px;
            height: 11px;
            fill: none;
            stroke: var(--mid);
            stroke-width: 2.5;
            stroke-linecap: round;
            stroke-linejoin: round;
            transition: stroke .2s;
        }
        .sp-other-card:hover .sp-other-arrow svg { stroke: #fff; }


        /* ═══════════════════════════════════════════════════
           STATS BAND
        ═══════════════════════════════════════════════════ */
        .stats-band {
            background: #113454;
            padding: 48px 0;
        }
        .stats-inner {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }
        .stats-inner > div {
            min-width: 0;
        }
        .stat-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            padding: 0 8px;
        }
        .stat-icon {
            width: 72px;
            height: 72px;
            border-radius: 14px;
            background: #1C517C;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 14px;
            flex-shrink: 0;
        }
        .stat-icon svg,
        .stat-icon img {
            width: 34px;
            height: 34px;
            object-fit: contain;
        }
        .stat-icon svg {
            fill: none;
            stroke: #fff;
            stroke-width: 1.5;
            stroke-linecap: round;
            stroke-linejoin: round;
        }
        .stat-num {
            font-size: 34px;
            font-weight: 800;
            color: #F5A623;
            line-height: 1.2;
            margin-bottom: 6px;
        }
        .stat-num em { font-style: normal; }
        .stat-label {
            font-size: 13px;
            font-weight: 500;
            color: #fff;
            line-height: 1.4;
        }


        /* ═══════════════════════════════════════════════════
           SECTION BASE
        ═══════════════════════════════════════════════════ */
        .section { padding: var(--sp-2xl) 0; }

        .eyebrow-badge {
            display: inline-block;
            background: #EBF8FF;
            color: var(--blue);
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .05em;
            text-transform: uppercase;
            padding: 6px 14px;
            border-radius: 4px;
            margin-bottom: 16px;
        }

        .section-title {
            font-size: clamp(22px, 2.8vw, 34px);
            font-weight: 800;
            letter-spacing: -.03em;
            color: var(--ink);
            margin-bottom: 12px;
            line-height: 1.2;
        }
        .section-sub {
            font-size: 14.5px;
            color: var(--mid);
            line-height: 1.75;
        }
        .section-header {
            margin-bottom: 48px;
        }
        .section-header-center {
            text-align: center;
        }
        .section-header-center .section-sub {
            max-width: 520px;
            margin-left: auto;
            margin-right: auto;
        }


        /* ═══════════════════════════════════════════════════
           PROCESS
        ═══════════════════════════════════════════════════ */
        .process { background: var(--white); }

        .process-track {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            position: relative;
            padding-top: 24px;
        }
        .process-step {
            text-align: center;
            padding: 0 8px;
        }
        .step-img-wrapper {
            height: 130px;
            margin: 0 auto 20px;
            display: flex;
            align-items: flex-end;
            justify-content: center;
        }
        .step-img-wrapper img {
            width: 100%;
            max-width: 130px;
            max-height: 120px;
            object-fit: contain;
        }
        .step-title {
            font-size: 15px;
            font-weight: 800;
            color: #113454;
            margin-bottom: 10px;
        }
        .step-desc {
            font-size: 13px;
            color: var(--mid);
            line-height: 1.6;
        }


        /* ═══════════════════════════════════════════════════
           REVIEWS
        ═══════════════════════════════════════════════════ */
        .reviews {
            background: #113454;
            padding: var(--sp-xl) 0;
            color: #fff;
        }
        .reviews .eyebrow-badge {
            background: #fff;
            color: var(--blue);
        }
        .reviews .section-title {
            color: #F5A623;
            font-weight: 800;
        }
        .reviews .section-sub {
            color: rgba(255,255,255,.8);
        }

        .reviews-layout {
            display: flex;
            align-items: flex-start;
            gap: 40px;
            margin-top: 48px;
        }
        .reviews-sidebar {
            width: 180px;
            flex-shrink: 0;
            padding-top: 16px;
        }
        .reviews-sidebar-title {
            font-size: 20px;
            font-weight: 700;
            color: #fff;
            line-height: 1.3;
            margin-bottom: 28px;
        }
        .reviews-nav {
            display: flex;
            gap: 12px;
        }
        .btn-rev-nav {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: #fff;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all .2s;
            flex-shrink: 0;
        }
        .btn-rev-nav svg {
            width: 16px;
            height: 16px;
            fill: none;
            stroke: var(--blue-dk);
            stroke-width: 2.5;
            stroke-linecap: round;
            stroke-linejoin: round;
        }
        .btn-rev-nav:hover { background: #F5A623; }
        .btn-rev-nav:hover svg { stroke: #fff; }

        .reviews-slider-wrap {
            flex: 1;
            overflow: hidden;
            padding-bottom: 40px;
            position: relative;
            min-width: 0;
        }
        .reviews-slider {
            display: flex;
            gap: 20px;
            overflow-x: auto;
            scroll-snap-type: x mandatory;
            scrollbar-width: none;
        }
        .reviews-slider::-webkit-scrollbar { display: none; }

        .review-card {
            background: #fff;
            border-radius: 12px;
            padding: 24px;
            min-width: 340px;
            max-width: 340px;
            scroll-snap-align: start;
            display: flex;
            flex-direction: column;
            color: var(--ink);
            box-shadow: 0 10px 30px rgba(0,0,0,.15);
        }
        .review-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 14px;
        }
        .review-check {
            width: 26px;
            height: 26px;
            border-radius: 50%;
            border: 2px solid #F5A623;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .review-check svg {
            width: 12px;
            height: 12px;
            fill: none;
            stroke: #F5A623;
            stroke-width: 3;
            stroke-linecap: round;
            stroke-linejoin: round;
        }
        .review-author { flex: 1; min-width: 0; }
        .review-author h4 {
            font-size: 14px;
            font-weight: 800;
            color: var(--ink);
            margin: 0 0 2px;
        }
        .review-author span {
            font-size: 12px;
            color: var(--muted);
            display: block;
        }
        .review-text {
            font-size: 13px;
            color: var(--mid);
            line-height: 1.65;
            font-style: italic;
            margin-bottom: 20px;
            flex: 1;
        }
        .review-foot-stars {
            display: flex;
            justify-content: flex-end;
            gap: 3px;
        }
        .review-foot-stars svg {
            width: 15px;
            height: 15px;
            fill: #F5A623;
        }
        .reviews-dots {
            display: flex;
            gap: 8px;
            position: absolute;
            bottom: 0;
            left: 0;
        }
        .rev-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #fff;
            opacity: .3;
            cursor: pointer;
            transition: all .3s;
        }
        .rev-dot.active {
            background: #F5A623;
            opacity: 1;
            width: 24px;
            border-radius: 4px;
        }
        .reviews-empty {
            text-align: center;
            padding: 48px 24px;
            background: rgba(255,255,255,.05);
            border: 1.5px dashed rgba(255,255,255,.2);
            border-radius: var(--r-lg);
            color: rgba(255,255,255,.6);
            font-size: 14px;
            font-weight: 500;
            width: 100%;
        }


        /* ═══════════════════════════════════════════════════
           ARTIKEL & INFORMASI
        ═══════════════════════════════════════════════════ */
        .artikel-section {
            background: #F4F7F9;
            padding: var(--sp-2xl) 0;
        }
        .artikel-top-grid {
            display: grid;
            grid-template-columns: 1.8fr 1fr;
            gap: 28px;
            margin-bottom: 36px;
        }
        .art-featured {
            position: relative;
            border-radius: 5px;
            overflow: hidden;
            min-height: 420px;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 28px;
            color: #fff;
            box-shadow: 0 10px 30px rgba(0,0,0,.08);
            background-size: cover;
            background-position: center;
        }
        .art-featured::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0,0,0,.8) 0%, rgba(0,0,0,0) 60%);
        }
        .art-featured-content { position: relative; z-index: 1; }
        .art-badge {
            display: inline-block;
            background: #3291A8;
            color: #fff;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            padding: 4px 10px;
            border-radius: 4px;
            margin-bottom: 10px;
        }
        .art-featured-title {
            font-size: clamp(18px, 2vw, 22px);
            font-weight: 800;
            line-height: 1.3;
            margin-bottom: 8px;
        }
        .art-featured-date { font-size: 11px; opacity: .8; }

        .art-latest {
            display: flex;
            flex-direction: column;
        }
        .art-latest-title {
            font-size: 15px;
            font-weight: 800;
            color: var(--ink);
            margin-bottom: 20px;
        }
        .art-latest-title span { color: var(--blue-dk); }
        .art-latest-list {
            display: flex;
            flex-direction: column;
            gap: 16px;
            flex: 1;
            justify-content: space-between;
        }
        .art-list-item {
            display: flex;
            gap: 14px;
            align-items: center;
            border-radius: 5px;
        }
        .art-list-img {
            width: 100px;
            height: 100px;
            border-radius: 5px;
            object-fit: cover;
            flex-shrink: 0;
        }
        .art-list-info { display: flex; flex-direction: column; gap: 4px; min-width: 0; }
        .art-list-title {
            font-size: 13px;
            font-weight: 700;
            color: var(--ink);
            line-height: 1.4;
        }
        .art-list-date { font-size: 10px; color: var(--muted); }

        /* Carousel */
        .art-carousel-wrap {
            position: relative;
            overflow: hidden;
            padding-bottom: 40px;
        }
        .art-carousel {
            display: flex;
            gap: 20px;
            overflow-x: auto;
            scroll-snap-type: x mandatory;
            scrollbar-width: none;
        }
        .art-carousel::-webkit-scrollbar { display: none; }

        .art-card {
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            flex: 0 0 calc(33.333% - 14px);
            scroll-snap-align: start;
            box-shadow: 0 4px 12px rgba(0,0,0,.05);
            display: flex;
            flex-direction: column;
        }
        .art-card-img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .art-card-body {
            padding: 20px;
            display: flex;
            flex-direction: column;
            flex: 1;
        }
        .art-card-meta {
            display: flex;
            justify-content: space-between;
            font-size: 10px;
            color: var(--muted);
            margin-bottom: 8px;
        }
        .art-card-title {
            font-size: 14px;
            font-weight: 800;
            color: var(--ink);
            line-height: 1.4;
            margin-bottom: 5px;
        }
        .art-card-cat {
            font-size: 10px;
            color: var(--blue);
            font-weight: 700;
            margin-bottom: 10px;
        }
        .art-card-desc {
            font-size: 12px;
            color: var(--mid);
            line-height: 1.6;
            margin-bottom: 16px;
            flex: 1;
        }
        .art-card-link {
            font-size: 11px;
            font-weight: 700;
            color: var(--ink);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .art-dots {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 10px;
            margin-bottom: 28px;
        }
        .art-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: #ccc;
            cursor: pointer;
            transition: all .3s;
        }
        .art-dot.active { background: #F5A623; }

        .art-btn-more-wrap { text-align: center; }
        .art-btn-more {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #113454;
            color: #fff;
            font-size: 13px;
            font-weight: 700;
            padding: 12px 28px;
            border-radius: 6px;
            text-decoration: none;
            transition: background .2s;
        }
        .art-btn-more:hover { background: #0b253b; }


        /* ═══════════════════════════════════════════════════
           CTA BAND
        ═══════════════════════════════════════════════════ */
        .cta-band {
            position: relative;
            overflow: hidden;
            background-color: var(--blue-dk);
            background-size: cover;
            background-position: center;
            padding: 96px 0;
            text-align: center;
            color: #fff;
        }
        .cta-band::before {
            content: '';
            position: absolute;
            inset: 0;
            background: rgba(11,37,59,.85);
        }
        .cta-inner {
            position: relative;
            z-index: 1;
            max-width: 760px;
            margin: 0 auto;
        }
        .cta-heading {
            font-size: clamp(24px, 3.5vw, 40px);
            font-weight: 800;
            letter-spacing: -.03em;
            margin-bottom: 14px;
            line-height: 1.2;
        }
        .cta-heading span { color: #3291A8; }
        .cta-sub {
            font-size: 14px;
            color: rgba(255,255,255,.75);
            line-height: 1.65;
            margin-bottom: 32px;
        }
        .cta-actions {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 14px;
            flex-wrap: wrap;
        }
        .btn-cta-primary {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #F5A623;
            color: var(--blue-dk);
            padding: 14px 28px;
            border-radius: 6px;
            font-weight: 700;
            font-size: 14px;
            text-decoration: none;
            transition: all .2s;
            white-space: nowrap;
        }
        .btn-cta-primary:hover { background: #e0961f; }
        .btn-cta-outline {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: transparent;
            color: #fff;
            border: 1px solid rgba(255,255,255,.5);
            padding: 14px 28px;
            border-radius: 6px;
            font-weight: 700;
            font-size: 14px;
            text-decoration: none;
            transition: all .2s;
            white-space: nowrap;
        }
        .btn-cta-outline:hover {
            background: rgba(255,255,255,.1);
            border-color: #fff;
        }


        /* ═══════════════════════════════════════════════════
           FOOTER
        ═══════════════════════════════════════════════════ */
        .site-footer { background: #0A1C2C; padding-top: 64px; }
        .footer-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1.5fr 1.5fr 1fr;
            gap: 36px;
            padding-bottom: 64px;
        }
        .footer-logo-text strong {
            color: #F5A623;
            font-size: 15px;
            display: block;
            margin-bottom: 2px;
        }
        .footer-logo-text span {
            color: rgba(255,255,255,.6);
            font-size: 11px;
        }
        .footer-desc {
            font-size: 13px;
            color: #fff;
            line-height: 1.65;
            margin-top: 14px;
            max-width: 280px;
        }
        .f-col-title {
            font-size: 13px;
            font-weight: 700;
            color: #F5A623;
            margin-bottom: 18px;
        }
        .f-links {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }
        .f-links a {
            font-size: 13px;
            color: #fff;
            text-decoration: none;
            transition: color .2s;
        }
        .f-links a:hover { color: #F5A623; }
        .f-contact-item {
            font-size: 13px;
            color: #fff;
            margin-bottom: 12px;
            line-height: 1.6;
        }

        .footer-bottom {
            background: #3291A8;
            padding: 18px 0;
        }
        .footer-bottom-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: wrap;
        }
        .footer-copy { font-size: 12px; color: #fff; font-weight: 500; }
        .footer-legal { display: flex; gap: 24px; }
        .footer-legal a {
            font-size: 12px;
            color: #fff;
            font-weight: 500;
            text-decoration: none;
            transition: opacity .2s;
        }
        .footer-legal a:hover { opacity: 0.8; }


        /* ═══════════════════════════════════════════════════
           ANIMATIONS
        ═══════════════════════════════════════════════════ */
        .reveal { opacity: 0; transform: translateY(22px); transition: opacity .55s ease, transform .55s ease; }
        .reveal.visible { opacity: 1; transform: translateY(0); }
        .reveal-d1 { transition-delay: .1s; }
        .reveal-d2 { transition-delay: .2s; }
        .reveal-d3 { transition-delay: .3s; }
        .reveal-d4 { transition-delay: .4s; }


        /* ═══════════════════════════════════════════════════
           RESPONSIVE — 1200px
        ═══════════════════════════════════════════════════ */
        @media (max-width: 1200px) {
            .container { padding: 0 24px; }
            .footer-grid { grid-template-columns: 1.5fr 1fr 1fr 1fr; gap: 28px; }
            .footer-grid > div:first-child { grid-column: span 4; }
            .footer-desc { max-width: 100%; }
        }


        /* ═══════════════════════════════════════════════════
           RESPONSIVE — 1023px (Tablet)
        ═══════════════════════════════════════════════════ */
        @media (max-width: 1023px) {
            :root {
                --sp-xl: 56px;
                --sp-2xl: 72px;
            }

            /* Header */
            .site-nav { display: none; }
            .nav-hamburger { display: flex; }
            .logo-text span { display: none; }

            /* Hero */
            .hero-grid {
                grid-template-columns: 1fr;
                gap: 36px;
            }
            .hero-bg { display: none; }
            .hero-sub { max-width: 100%; }

            /* Stats */
            .stats-inner { grid-template-columns: repeat(2, 1fr); gap: 1px; }
            .stat-item {
                padding: 28px 16px;
                border: 1px solid rgba(255,255,255,.07);
            }

            /* Process */
            .process-track { grid-template-columns: 1fr 1fr; gap: 28px; }
            .process-track > div { min-width: 0; }

            /* Reviews */
            .reviews-layout { flex-direction: column; gap: 28px; }
            .reviews-sidebar { width: 100%; padding-top: 0; display: flex; align-items: center; justify-content: space-between; }
            .reviews-sidebar-title { margin-bottom: 0; font-size: 18px; }
            .review-card { min-width: 300px; max-width: 300px; }

            /* Artikel */
            .artikel-top-grid { grid-template-columns: 1fr; }
            .artikel-top-grid > div { min-width: 0; }
            .art-featured { min-height: 320px; }
            .art-latest { margin-top: 0; }
            .art-latest-list { flex-direction: row; flex-wrap: wrap; gap: 16px; }
            .art-list-item { flex: 1; min-width: 200px; }
            .art-card { flex: 0 0 calc(50% - 10px); }

            /* Footer */
            .footer-grid { grid-template-columns: 1fr 1fr; gap: 28px; }
            .footer-grid > div { min-width: 0; }
            .footer-grid > div:first-child { grid-column: span 2; }
        }


        /* ═══════════════════════════════════════════════════
           RESPONSIVE — 767px (Mobile)
        ═══════════════════════════════════════════════════ */
        @media (max-width: 767px) {
            :root {
                --sp-lg: 20px;
                --sp-xl: 48px;
                --sp-2xl: 60px;
            }

            .container { padding: 0 var(--sp-lg); }

            /* Header */
            .header-inner { height: 60px; }
            .logo-img { width: 40px; height: 40px; }
            .logo-text strong { font-size: 13px; }

            /* Hero */
            .hero { padding: 40px 0 52px; }
            .hero-cta-row { flex-direction: column; align-items: stretch; }
            .hero-cta-row .btn-primary,
            .hero-cta-row .btn-outline { justify-content: center; width: 100%; }

            /* Stats */
            .stats-inner { grid-template-columns: 1fr 1fr; }
            .stat-num { font-size: 26px; }
            .stat-label { font-size: 11px; }
            .stat-icon { width: 56px; height: 56px; }
            .stat-icon svg, .stat-icon img { width: 26px; height: 26px; }

            /* Service Panel */
            .sp-row-logo { width: 56px; height: 56px; }
            .sp-row-info strong { font-size: 13px; }
            .sp-others { grid-template-columns: 1fr 1fr; gap: 8px; }
            .sp-other-logo { width: 44px; height: 44px; }
            .sp-other-name { font-size: 11px; }

            /* Process */
            .process-track { grid-template-columns: 1fr 1fr; gap: 20px; }
            .step-img-wrapper { height: 100px; }
            .step-title { font-size: 13px; }
            .step-desc { font-size: 12px; }

            /* Reviews */
            .reviews { padding: 60px 0; }
            .reviews-layout { gap: 20px; }
            .reviews-sidebar { flex-direction: row; align-items: center; }
            .reviews-sidebar-title { font-size: 16px; margin-bottom: 0; }
            .review-card { min-width: 270px; max-width: 270px; padding: 18px; }
            .review-text { font-size: 12px; }

            /* Artikel */
            .artikel-section { padding: 60px 0; }
            .artikel-top-grid { gap: 24px; }
            .art-featured { min-height: 260px; padding: 20px; }
            .art-featured-title { font-size: 16px; }
            .art-latest-list { flex-direction: column; }
            .art-card { flex: 0 0 80%; }
            .art-card-img { height: 160px; }

            /* CTA */
            .cta-band { padding: 60px 0; }
            .cta-actions { flex-direction: column; align-items: stretch; }
            .btn-cta-primary, .btn-cta-outline { justify-content: center; }

            /* Footer */
            .site-footer { padding-top: 48px; }
            .footer-grid { grid-template-columns: 1fr 1fr; gap: 24px; }
            .footer-grid > div:first-child { grid-column: span 2; }
            .footer-bottom-inner { flex-direction: column; align-items: flex-start; gap: 10px; }
            .footer-legal { flex-wrap: wrap; gap: 12px; }
        }


        /* ═══════════════════════════════════════════════════
           RESPONSIVE — 480px (Small Mobile)
        ═══════════════════════════════════════════════════ */
        @media (max-width: 480px) {
            :root {
                --sp-lg: 16px;
            }

            /* Header */
            .btn-nav { display: none; }
            .header-inner { height: 56px; }

            /* Hero */
            .hero-heading { font-size: 24px; }
            .hero-sub { font-size: 13px; }
            .hero-eyebrow { font-size: 10px; }

            /* Stats */
            .stat-item { padding: 20px 10px; }
            .stat-num { font-size: 22px; }

            /* Service Panel */
            .sp-row { gap: 10px; padding: 12px 14px; }
            .sp-row-logo { width: 48px; height: 48px; }
            .sp-row-info strong { font-size: 12px; }
            .sp-row-info span { display: none; }
            .sp-row-cta { padding: 6px 10px; font-size: 10px; }
            .sp-others { grid-template-columns: 1fr; }

            /* Process — single col on tiny screens */
            .process-track { grid-template-columns: 1fr 1fr; }

            /* Reviews */
            .reviews-layout { margin-top: 28px; }
            .reviews-sidebar {
                flex-direction: column;
                align-items: flex-start;
                gap: 16px;
            }
            .reviews-sidebar-title { margin-bottom: 0; }
            .review-card { min-width: 240px; max-width: 240px; }

            /* Artikel */
            .art-list-img { width: 64px; height: 64px; }
            .art-card { flex: 0 0 88%; }
            .art-featured { min-height: 220px; }

            /* Footer */
            .footer-grid { grid-template-columns: 1fr; }
            .footer-grid > div:first-child { grid-column: span 1; }
            .footer-legal { flex-direction: column; gap: 8px; }
        }


        /* ═══════════════════════════════════════════════════
           RESPONSIVE — 360px (Tiny phones)
        ═══════════════════════════════════════════════════ */
        @media (max-width: 360px) {
            :root { --sp-lg: 14px; }
            .hero-heading { font-size: 22px; }
            .sp-others { grid-template-columns: 1fr; }
            .process-track { grid-template-columns: 1fr; }
            .stats-inner { grid-template-columns: 1fr 1fr; }
        }

    </style>
</head>
<body>

<!-- ══ HEADER ══════════════════════════════════════════════ -->
<header id="site-header">
    <div class="container">
        <div class="header-inner">

            <!-- Logo -->
            <a href="/" class="logo-wrap">
                <img src="{{ asset('storage/logo/PATEN PAK MIKO LOGO.png') }}" alt="Logo PATEN PAK MIKO" class="logo-img">
                <div class="logo-text">
                    <strong>PATEN PAK MIKO</strong>
                    <span>Kantor Pertanahan (BPN) Kota Sukabumi</span>
                </div>
            </a>

            <!-- Desktop Nav -->
            <nav class="site-nav" aria-label="Main navigation">
                <a href="{{ url('/') }}" class="nav-link">Beranda</a>

                <div class="nav-dropdown">
                    <button class="nav-dropdown-trigger" aria-haspopup="true" aria-expanded="false">
                        Layanan
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M6 9l6 6 6-6"/>
                        </svg>
                    </button>
                    <div class="nav-dropdown-content" role="menu">
                        <a href="{{ Auth::check() ? route('berusaha.create') : route('login') }}" role="menuitem">
                            <span class="nav-dd-icon" style="background:var(--blue-lt);">
                                <img src="{{ asset('storage/logo/PKKPR.png') }}" alt="">
                            </span>
                            Pertimbangan Teknis Pertanahan PKKPR Berusaha
                        </a>
                        <a href="{{ Auth::check() ? route('non-berusaha.create') : route('login') }}" role="menuitem">
                            <span class="nav-dd-icon" style="background:var(--green-lt);">
                                <img src="{{ asset('storage/logo/PKKPRNon.png') }}" alt="">
                            </span>
                            Pertimbangan Teknis Pertanahan PKKPR Non Berusaha
                        </a>
                        <a href="{{ Auth::check() ? route('kebijakan.create') : route('login') }}" role="menuitem">
                            <span class="nav-dd-icon" style="background:var(--yellow-lt);">
                                <img src="{{ asset('storage/logo/Kebijakan.png') }}" alt="">
                            </span>Pertimbangan Teknis Pertanahan Kebijakan</a>
                        <a href="{{ route('ptp.create', ['layanan' => 'tanah-timbul']) }}" role="menuitem">
                            <span class="nav-dd-icon" style="background:var(--blue-lt);">
                                <img src="{{ asset('storage/logo/PKKPR.png') }}" alt="">
                            </span>Pertimbangan Teknis Pertanahan Tanah Timbul</a>
                        <a href="{{ route('ptp.create', ['layanan' => 'psn']) }}" role="menuitem">
                            <span class="nav-dd-icon" style="background:var(--blue-lt);">
                                <img src="{{ asset('storage/logo/PKKPR.png') }}" alt="">
                            </span>Pertimbangan Teknis Pertanahan Proyek Strategis Nasional (PSN)</a>
                        <a href="{{ route('lapolpa.index') }}" role="menuitem">
                            <span class="nav-dd-icon" style="background:var(--surface);">
                                <img src="{{ asset('storage/logo/Lapolpak.png') }}" alt="">
                            </span>
                            LAPOL PAK
                        </a>
                        <a href="{{ route('informal.index') }}" role="menuitem">
                            <span class="nav-dd-icon" style="background:var(--surface);">
                                <img src="{{ asset('storage/logo/Informal.png') }}" alt="">
                            </span>
                            INFORMAL
                        </a>
                    </div>
                </div>

                <a href="{{ route('alur') }}" class="nav-link">Alur Proses</a>
                <a href="{{ route('testimoni') }}" class="nav-link">Ulasan</a>

                <div class="nav-sep" aria-hidden="true"></div>

                <a href="{{ route('kontak') }}" class="btn-nav">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                    </svg>
                    Kontak Kami
                </a>

                @auth
                    @if(Auth::user()->isAdminBerita())
                        <a href="{{ route('admin.berita.index') }}" class="btn-nav">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line>
                            </svg>
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('dashboard') }}" class="btn-nav">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line>
                            </svg>
                            Dashboard
                        </a>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="btn-nav">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path>
                            <polyline points="10 17 15 12 10 7"></polyline>
                            <line x1="15" y1="12" x2="3" y2="12"></line>
                        </svg>
                        Login
                    </a>
                @endauth
            </nav>

            <!-- Hamburger (Mobile) -->
            <button class="nav-hamburger" id="hamburgerBtn" aria-label="Toggle navigation" aria-expanded="false">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </div>
</header>

<!-- Mobile Nav Overlay -->
<div class="mobile-nav" id="mobileNav" role="dialog" aria-label="Mobile navigation" aria-modal="true">
    <div class="mobile-nav-header">
        <a href="/" class="logo-wrap" onclick="closeMobileNav()">
            <img src="{{ asset('storage/logo/PATEN PAK MIKO LOGO.png') }}" alt="Logo" class="logo-img" style="width:36px;height:36px;">
            <div class="logo-text">
                <strong style="font-size:13px;">PATEN PAK MIKO</strong>
            </div>
        </a>
        <button class="mobile-nav-close" onclick="closeMobileNav()" aria-label="Close navigation">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M18 6L6 18M6 6l12 12"/>
            </svg>
        </button>
    </div>
    <div class="mobile-nav-body">
        <a href="{{ url('/') }}" onclick="closeMobileNav()">Beranda</a>
        <span class="mobile-section-label">Layanan</span>
        <a href="{{ Auth::check() ? route('berusaha.create') : route('login') }}" onclick="closeMobileNav()">Pertimbangan Teknis Pertanahan PKKPR Berusaha</a>
        <a href="{{ Auth::check() ? route('non-berusaha.create') : route('login') }}" onclick="closeMobileNav()">Pertimbangan Teknis Pertanahan PKKPR Non Berusaha</a>
        <a href="{{ Auth::check() ? route('kebijakan.create') : route('login') }}" onclick="closeMobileNav()">Pertimbangan Teknis Pertanahan Kebijakan</a>
        <a href="{{ route('ptp.create', ['layanan' => 'tanah-timbul']) }}" onclick="closeMobileNav()">Pertimbangan Teknis Pertanahan Tanah Timbul</a>
        <a href="{{ route('ptp.create', ['layanan' => 'psn']) }}" onclick="closeMobileNav()">Pertimbangan Teknis Pertanahan Proyek Strategis Nasional (PSN)</a>
        <a href="{{ route('lapolpa.index') }}" onclick="closeMobileNav()">LAPOL PAK</a>
        <a href="{{ route('informal.index') }}" onclick="closeMobileNav()">INFORMAL</a>
        <span class="mobile-section-label">Navigasi</span>
        <a href="{{ route('alur') }}" onclick="closeMobileNav()">Alur Proses</a>
        <a href="{{ route('testimoni') }}" onclick="closeMobileNav()">Ulasan</a>
        <a href="{{ route('kontak') }}" onclick="closeMobileNav()">Kontak Kami</a>
        @auth
            @if(Auth::user()->isAdminBerita())
                <a href="{{ route('admin.berita.index') }}" class="mobile-cta" onclick="closeMobileNav()">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line>
                    </svg>
                    Dashboard
                </a>
            @else
                <a href="{{ route('dashboard') }}" class="mobile-cta" onclick="closeMobileNav()">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line>
                    </svg>
                    Dashboard
                </a>
            @endif
        @else
            <a href="{{ route('login') }}" class="mobile-cta" onclick="closeMobileNav()">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path>
                    <polyline points="10 17 15 12 10 7"></polyline>
                    <line x1="15" y1="12" x2="3" y2="12"></line>
                </svg>
                Login
            </a>
        @endauth
    </div>
</div>



    <main style="min-height: 100vh; display: flex; flex-direction: column;">
        @yield('content')
    </main>

<!-- ══ FOOTER ═══════════════════════════════════════════════ -->
<footer class="site-footer">
    <div class="container">
        <div class="footer-grid">
            <div>
                <a href="/" class="logo-wrap" style="margin-bottom:18px;">
                    <img src="{{ asset('storage/logo/PATEN PAK MIKO LOGO.png') }}" alt="Logo" style="width:44px;height:44px;object-fit:contain;flex-shrink:0;">
                    <div class="logo-text footer-logo-text">
                        <strong>PATEN PAK MIKO</strong>
                        <span>Kantor Pertanahan (BPN) Sukabumi</span>
                    </div>
                </a>
                <p class="footer-desc">Sistem pelayanan pertanahan digital yang cepat, transparan, dan terintegrasi untuk masyarakat Kota Sukabumi.</p>
            </div>

            <div>
                <h4 class="f-col-title">Menu</h4>
                <ul class="f-links">
                    <li><a href="{{ url('/') }}">Beranda</a></li>
                    <li><a href="#">Tentang Kami</a></li>
                    <li><a href="#">Layanan</a></li>
                    <li><a href="{{ route('alur') }}">Alur Proses</a></li>
                    <li><a href="{{ route('kontak') }}">Kontak Kami</a></li>
                </ul>
            </div>

            <div>
                <h4 class="f-col-title">Layanan Kami</h4>
                <ul class="f-links">
                    <li><a href="{{ route('lapolpa.index') }}">LAPOL PAK</a></li>
                    <li><a href="{{ Auth::check() ? route('non-berusaha.create') : route('login') }}">Pertimbangan Teknis Pertanahan PKKPR Non Berusaha</a></li>
                    <li><a href="{{ Auth::check() ? route('berusaha.create') : route('login') }}">Pertimbangan Teknis Pertanahan PKKPR Berusaha</a></li>
                    <li><a href="{{ Auth::check() ? route('kebijakan.create') : route('login') }}">Pertimbangan Teknis Pertanahan Kebijakan</a></li>
                    <li><a href="{{ route('ptp.create', ['layanan' => 'tanah-timbul']) }}">Pertimbangan Teknis Pertanahan Tanah Timbul</a></li>
                    <li><a href="{{ route('ptp.create', ['layanan' => 'psn']) }}">Pertimbangan Teknis Pertanahan Proyek Strategis Nasional (PSN)</a></li>
                    <li><a href="{{ route('informal.index') }}">Peta Publik</a></li>
                </ul>
            </div>

            <div>
                <h4 class="f-col-title">Kontak Kami</h4>
                <div class="f-contact-item">patenpakmiko@mail.com</div>
                <div class="f-contact-item">+62 813-2271-2133</div>
                <div class="f-contact-item">Jl. Suryakencana No. 02 Kelurahan Gununggparang, Kec. Cikole, Kode Pos 43111, Kota Sukabumi</div>
            </div>

            <div>
                <h4 class="f-col-title">Social Media</h4>
                <ul class="f-links">
                    <li><a href="#">Instagram</a></li>
                    <li><a href="#">TikTok</a></li>
                    <li><a href="#">Facebook</a></li>
                    <li><a href="#">Youtube</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container footer-bottom-inner">
            <p class="footer-copy">&copy; 2026 PATEN PAK MIKO. All rights reserved</p>
            <nav class="footer-legal" aria-label="Legal links">
                <a href="#">Privacy Policy</a>
                <a href="#">Terms &amp; Conditions</a>
            </nav>
        </div>
    </div>
</footer>


<!-- ══ SCRIPTS ══════════════════════════════════════════════ -->
<script>
(function() {
    'use strict';

    /* ── Mobile Nav ─────────────────────────────────────── */
    const hamburger = document.getElementById('hamburgerBtn');
    const mobileNav = document.getElementById('mobileNav');
    let lastFocus = null;

    function openMobileNav() {
        mobileNav.classList.add('open');
        hamburger.classList.add('active');
        hamburger.setAttribute('aria-expanded', 'true');
        document.body.style.overflow = 'hidden';
        lastFocus = document.activeElement;
        mobileNav.querySelector('a, button').focus();
    }

    function closeMobileNav() {
        mobileNav.classList.remove('open');
        hamburger.classList.remove('active');
        hamburger.setAttribute('aria-expanded', 'false');
        document.body.style.overflow = '';
        if (lastFocus) lastFocus.focus();
    }

    window.closeMobileNav = closeMobileNav;

    hamburger.addEventListener('click', function() {
        if (mobileNav.classList.contains('open')) {
            closeMobileNav();
        } else {
            openMobileNav();
        }
    });

    // Close on backdrop (outside nav content)
    mobileNav.addEventListener('click', function(e) {
        if (e.target === mobileNav) closeMobileNav();
    });

    // Close on Escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && mobileNav.classList.contains('open')) {
            closeMobileNav();
        }
    });

    /* ── Header scroll shadow ───────────────────────────── */
    const header = document.getElementById('site-header');
    window.addEventListener('scroll', function() {
        header.classList.toggle('scrolled', window.scrollY > 20);
    }, { passive: true });

    /* ── Reveal on scroll ───────────────────────────────── */
    if ('IntersectionObserver' in window) {
        const io = new IntersectionObserver(function(entries) {
            entries.forEach(function(e) {
                if (e.isIntersecting) {
                    e.target.classList.add('visible');
                    io.unobserve(e.target);
                }
            });
        }, { threshold: 0.08 });
        document.querySelectorAll('.reveal').forEach(function(el) { io.observe(el); });
    } else {
        // Fallback for no IntersectionObserver
        document.querySelectorAll('.reveal').forEach(function(el) {
            el.classList.add('visible');
        });
    }

    /* ── Service Panel Slider ───────────────────────────── */
    const spRows = document.getElementById('spRows');
    if (spRows) {
        const spPrev = document.getElementById('spPrev');
        const spNext = document.getElementById('spNext');
        let spAutoTimer = null;

        function spScrollBy(dir) {
            const maxScroll = spRows.scrollWidth - spRows.clientWidth;
            if (dir > 0 && spRows.scrollLeft >= maxScroll - 10) {
                spRows.scrollTo({ left: 0, behavior: 'smooth' });
            } else if (dir < 0 && spRows.scrollLeft <= 10) {
                spRows.scrollTo({ left: maxScroll, behavior: 'smooth' });
            } else {
                spRows.scrollBy({ left: dir * (spRows.clientWidth), behavior: 'smooth' });
            }
        }

        function startSpAuto() {
            spAutoTimer = setInterval(function() { spScrollBy(1); }, 3500);
        }
        function stopSpAuto() {
            clearInterval(spAutoTimer);
        }

        if (spPrev) spPrev.addEventListener('click', function() { spScrollBy(-1); });
        if (spNext) spNext.addEventListener('click', function() { spScrollBy(1); });

        // Pause on panel hover/touch
        const panel = document.querySelector('.service-panel');
        if (panel) {
            panel.addEventListener('mouseenter', stopSpAuto);
            panel.addEventListener('mouseleave', startSpAuto);
            panel.addEventListener('touchstart', stopSpAuto, { passive: true });
            panel.addEventListener('touchend', function() {
                setTimeout(startSpAuto, 2000);
            }, { passive: true });
        }

        startSpAuto();
    }

    /* ── Reviews Slider ─────────────────────────────────── */
    const revSlider = document.getElementById('revSlider');
    if (revSlider) {
        const revDots = document.querySelectorAll('#revDots .rev-dot');
        const revPrev = document.getElementById('revPrev');
        const revNext = document.getElementById('revNext');
        let revAutoTimer = null;

        function getCardWidth() {
            const card = revSlider.querySelector('.review-card');
            return card ? card.offsetWidth + 20 : 360;
        }

        function scrollRevBy(dir) {
            const cw = getCardWidth();
            const maxScroll = revSlider.scrollWidth - revSlider.clientWidth;
            if (dir > 0 && revSlider.scrollLeft >= maxScroll - 10) {
                revSlider.scrollTo({ left: 0, behavior: 'smooth' });
            } else if (dir < 0 && revSlider.scrollLeft <= 10) {
                revSlider.scrollTo({ left: maxScroll, behavior: 'smooth' });
            } else {
                revSlider.scrollBy({ left: dir * cw, behavior: 'smooth' });
            }
        }

        function goToRev(index) {
            const cw = getCardWidth();
            revSlider.scrollTo({ left: index * cw, behavior: 'smooth' });
        }
        window.goToRev = goToRev;

        function startRevAuto() {
            revAutoTimer = setInterval(function() { scrollRevBy(1); }, 4000);
        }
        function stopRevAuto() {
            clearInterval(revAutoTimer);
        }

        if (revPrev) revPrev.addEventListener('click', function() { scrollRevBy(-1); });
        if (revNext) revNext.addEventListener('click', function() { scrollRevBy(1); });

        revSlider.addEventListener('mouseenter', stopRevAuto);
        revSlider.addEventListener('mouseleave', startRevAuto);
        revSlider.addEventListener('touchstart', stopRevAuto, { passive: true });
        revSlider.addEventListener('touchend', function() {
            setTimeout(startRevAuto, 2000);
        }, { passive: true });

        // Update dots on scroll
        revSlider.addEventListener('scroll', function() {
            const cw = getCardWidth();
            const index = Math.round(revSlider.scrollLeft / cw);
            revDots.forEach(function(dot, i) {
                dot.classList.toggle('active', i === index);
            });
        }, { passive: true });

        startRevAuto();
    }

    /* ── Articles Carousel ──────────────────────────────── */
    const artCarousel = document.getElementById('artCarousel');
    if (artCarousel) {
        const artDotEls = document.querySelectorAll('#artDots .art-dot');
        let artAutoTimer = null;
        let cardsPerPage = 3;

        function updateCardsPerPage() {
            const w = window.innerWidth;
            if (w <= 480) cardsPerPage = 1;
            else if (w <= 767) cardsPerPage = 1;
            else if (w <= 1023) cardsPerPage = 2;
            else cardsPerPage = 3;
        }

        function getArtCardWidth() {
            const card = artCarousel.querySelector('.art-card');
            return card ? card.offsetWidth + 20 : 300;
        }

        function scrollArt() {
            const cw = getArtCardWidth();
            const maxScroll = artCarousel.scrollWidth - artCarousel.clientWidth;
            if (artCarousel.scrollLeft >= maxScroll - 10) {
                artCarousel.scrollTo({ left: 0, behavior: 'smooth' });
            } else {
                artCarousel.scrollBy({ left: cw * cardsPerPage, behavior: 'smooth' });
            }
        }

        function startArtAuto() {
            artAutoTimer = setInterval(scrollArt, 1000);
        }
        function stopArtAuto() {
            clearInterval(artAutoTimer);
        }

        artCarousel.addEventListener('mouseenter', stopArtAuto);
        artCarousel.addEventListener('mouseleave', startArtAuto);
        artCarousel.addEventListener('touchstart', stopArtAuto, { passive: true });
        artCarousel.addEventListener('touchend', function() {
            setTimeout(startArtAuto, 1000);
        }, { passive: true });

        // Update dots on scroll
        artCarousel.addEventListener('scroll', function() {
            const cw = getArtCardWidth();
            const cardIndex = Math.round(artCarousel.scrollLeft / cw);
            let dotIndex = Math.floor(cardIndex / cardsPerPage);
            dotIndex = Math.max(0, Math.min(dotIndex, artDotEls.length - 1));
            artDotEls.forEach(function(dot, i) {
                dot.classList.toggle('active', i === dotIndex);
            });
        }, { passive: true });

        // Dot click
        artDotEls.forEach(function(dot, i) {
            dot.addEventListener('click', function() {
                const cw = getArtCardWidth();
                artCarousel.scrollTo({ left: i * cardsPerPage * cw, behavior: 'smooth' });
            });
        });

        updateCardsPerPage();
        window.addEventListener('resize', function() {
            updateCardsPerPage();
        }, { passive: true });

        startArtAuto();
    }

})();
</script>
</body>
</html>