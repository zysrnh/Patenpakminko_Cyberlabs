<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PATEN PAK MIKO — Pertimbangan Teknis Pertanahan</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

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
            --r-md:  8px;
            --r-lg:  12px;
            --r-xl:  14px;
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--white);
            color: var(--ink);
            -webkit-font-smoothing: antialiased;
            overflow-x: hidden;
        }

        .container { max-width: 1400px; margin: 0 auto; padding: 0 40px; }

        /* ─── HEADER ──────────────────────────────────────── */
        #site-header {
            position: sticky; top: 0; z-index: 100;
            background: rgba(255,255,255,.97);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--line);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: box-shadow .3s;
        }
        #site-header.scrolled { box-shadow: 0 6px 24px rgba(0, 59, 100, 0.18); }

        .header-inner {
            display: flex; align-items: center; justify-content: space-between;
            height: 68px;
        }

        /* Logo */
        .logo-wrap {
            display: flex; align-items: center; gap: 12px; text-decoration: none; flex-shrink: 0;
        }
        .logo-img {
            width: 52px; height: 52px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--line);
        }
        .logo-text strong {
            display: block; font-size: 15px; font-weight: 800;
            color: var(--ink); letter-spacing: -.02em;
        }
        .logo-text span {
            display: block; font-size: 10px; font-weight: 500;
            color: var(--muted); margin-top: 1px;
        }

        /* Nav */
        .site-nav { display: flex; align-items: center; gap: 2px; }
        .nav-link {
            font-size: 13.5px; font-weight: 500; color: var(--mid);
            text-decoration: none; padding: 7px 14px;
            border-radius: var(--r-md); transition: all .18s;
            white-space: nowrap;
        }
        .nav-link:hover { color: var(--blue-dk); background: var(--blue-lt); }

        /* Dropdown Navbar */
        .nav-dropdown { position: relative; display: inline-block; }
        .nav-dropdown-trigger {
            display: flex; align-items: center; gap: 4px;
            font-size: 13.5px; font-weight: 500; color: var(--mid);
            padding: 7px 14px; border-radius: var(--r-md);
            text-decoration: none; cursor: pointer;
            transition: all .18s; background: none; border: none;
            font-family: inherit;
        }
        .nav-dropdown-trigger:hover { color: var(--blue-dk); background: var(--blue-lt); }
        .nav-dropdown-trigger svg { width: 14px; height: 14px; transition: transform .2s; }
        .nav-dropdown:hover .nav-dropdown-trigger svg { transform: rotate(180deg); }

        .nav-dropdown-content {
            visibility: hidden; opacity: 0; transform: translateY(8px);
            position: absolute; background: #fff;
            min-width: 260px; box-shadow: 0 8px 32px rgba(0,0,0,.12);
            z-index: 101; border-radius: var(--r-lg);
            border: 1px solid var(--line);
            top: calc(100% + 6px); left: 0;
            padding: 6px;
            transition: all 0.22s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .nav-dropdown:hover .nav-dropdown-content {
            visibility: visible; opacity: 1; transform: translateY(0);
        }
        .nav-dropdown-content a {
            color: var(--mid); padding: 9px 12px; text-decoration: none;
            display: flex; align-items: center; gap: 10px;
            font-size: 13px; font-weight: 500; border-radius: 8px;
            transition: all .15s;
        }
        .nav-dropdown-content a:hover { background: var(--surface); color: var(--blue-dk); }
        .nav-dd-icon {
            width: 28px; height: 28px; border-radius: 7px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0; overflow: hidden;
        }
        .nav-dd-icon img { width: 100%; height: 100%; object-fit: cover; }

        .nav-sep { width: 1px; height: 20px; background: var(--line); margin: 0 6px; flex-shrink: 0; }

        /* CTA Button */
        .btn-nav {
            display: inline-flex; align-items: center; gap: 8px;
            background: var(--blue-dk); color: #fff;
            padding: 9px 20px; border-radius: 10px;
            font-family: inherit; font-size: 13px; font-weight: 700;
            text-decoration: none; border: none; cursor: pointer;
            transition: all .2s; white-space: nowrap; flex-shrink: 0;
        }
        .btn-nav svg { width: 14px; height: 14px; fill: var(--yellow); stroke: none; }
        .btn-nav:hover { background: #00294a; box-shadow: 0 4px 16px rgba(0,59,100,.3); transform: translateY(-1px); }



        /* ─── HERO ────────────────────────────────────────── */
        .hero {
            padding: 72px 0 80px;
            background: var(--white);
            position: relative;
            overflow: hidden;
        }
        .hero-bg {
            position: absolute; top: 0; right: 0; bottom: 0;
            width: 55%; pointer-events: none;
            background: radial-gradient(ellipse at 80% 30%, rgba(227,240,249,.7) 0%, transparent 65%);
        }
        .hero-grid {
            display: grid;
            grid-template-columns: 1fr 1.15fr;
            gap: 64px;
            align-items: start;
            position: relative; z-index: 1;
        }

        /* Left copy */
        .hero-eyebrow {
            display: inline-flex; align-items: center; gap: 8px;
            font-size: 11px; font-weight: 700; letter-spacing: .08em;
            text-transform: uppercase; color: var(--blue);
            background: var(--blue-lt); border: 1px solid var(--blue-md);
            padding: 5px 14px 5px 10px; border-radius: 4px;
            margin-bottom: 24px;
        }
        .hero-eyebrow .eyebrow-dot {
            width: 6px; height: 6px; border-radius: 50%;
            background: var(--blue); flex-shrink: 0;
        }

        .hero-heading {
            font-size: clamp(32px, 3.8vw, 50px);
            font-weight: 800; line-height: 1.1;
            letter-spacing: -.03em; color: var(--ink);
            margin-bottom: 22px;
        }
        .hero-heading .accent {
            color: var(--blue);
            display: inline-block;
            position: relative;
        }
        .hero-heading .accent::after {
            content: '';
            position: absolute; left: 0; bottom: -3px;
            height: 3px; width: 65%;
            background: var(--yellow);
            border-radius: 2px;
        }
        .hero-heading .strong-line { font-weight: 800; }

        .hero-sub {
            font-size: 14.5px; line-height: 1.8; color: var(--mid);
            max-width: 460px; margin-bottom: 38px;
        }

        .hero-cta-row {
            display: flex; align-items: center; gap: 12px; flex-wrap: wrap;
        }
        .btn-primary {
            display: inline-flex; align-items: center; gap: 8px;
            background: var(--blue-dk); color: #fff;
            padding: 13px 26px; border-radius: 10px;
            font-family: inherit; font-size: 14px; font-weight: 700;
            text-decoration: none; border: none; cursor: pointer;
            transition: all .22s;
        }
        .btn-primary svg { width: 15px; height: 15px; fill: none; stroke: #fff; stroke-width: 2.5; stroke-linecap: round; stroke-linejoin: round; }
        .btn-primary:hover { background: var(--blue); box-shadow: 0 6px 24px rgba(33,138,201,.35); transform: translateY(-1px); }

        .btn-outline {
            display: inline-flex; align-items: center; gap: 7px;
            background: transparent; color: var(--mid);
            padding: 12px 22px; border-radius: 10px;
            font-family: inherit; font-size: 14px; font-weight: 600;
            text-decoration: none; border: 1.5px solid var(--line);
            cursor: pointer; transition: all .22s;
        }
        .btn-outline svg { width: 14px; height: 14px; fill: none; stroke: currentColor; stroke-width: 2.5; stroke-linecap: round; stroke-linejoin: round; }
        .btn-outline:hover { border-color: var(--blue-dk); color: var(--blue-dk); background: var(--blue-lt); }

        /* ─── SERVICE PANEL (Right side) ─────────────────── */
        .service-panel {
            background: #fff;
            border: 1px solid var(--line);
            border-radius: 6px;
            box-shadow:
                0 4px 12px rgba(0,0,0,.03),
                0 16px 40px rgba(0,59,100,.08);
            overflow: hidden;
        }

        /* Panel header bar */
        .sp-header {
            background: #002845; /* Darker blue to match example */
            padding: 20px 24px;
            display: flex; align-items: center; gap: 14px;
        }
        .sp-header-icon {
            width: 30px; height: 30px;
            display: flex; align-items: center; justify-content: center; flex-shrink: 0;
        }
        .sp-header-icon svg { width: 22px; height: 22px; fill: none; stroke: var(--yellow); stroke-width: 2.5; stroke-linecap: round; stroke-linejoin: round; }
        .sp-header-text strong { display: block; font-size: 14px; font-weight: 700; color: #fff; }
        .sp-header-text span { font-size: 11px; color: rgba(255,255,255,.5); font-weight: 500; display: none; } /* Hide span in header if any */

        /* Section label */
        .sp-section-label {
            font-size: 10px; font-weight: 800; color: var(--mid);
            text-transform: uppercase; letter-spacing: .08em;
            padding: 20px 24px 10px;
            display: flex; align-items: center; justify-content: space-between;
        }

        /* PKKPR service rows */
        .sp-rows { 
            padding: 0 20px 10px; display: flex; flex-direction: row; gap: 14px; 
            overflow-x: auto; scroll-snap-type: x mandatory; scroll-behavior: smooth;
            -ms-overflow-style: none; scrollbar-width: none;
        }
        .sp-rows::-webkit-scrollbar { display: none; }

        .sp-slide {
            display: flex; flex-direction: column; gap: 14px;
            min-width: 100%; flex-shrink: 0; scroll-snap-align: start;
        }

        .sp-row {
            display: flex; align-items: center; gap: 20px;
            padding: 20px 24px;
            border-radius: 4px;
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
            width: 90px; height: 90px;
            overflow: hidden; flex-shrink: 0;
            background: transparent;
            display: flex; align-items: center; justify-content: center;
        }
        .sp-row-logo img { width: 100%; height: 100%; object-fit: contain; transform: scale(1.15); }
        .sp-row-info { flex: 1; min-width: 0; }
        .sp-row-info strong {
            display: block; font-size: 17px; font-weight: 800;
            color: #003B64; margin-bottom: 4px;
            white-space: normal; overflow: visible; text-overflow: unset;
            line-height: 1.3;
        }
        .sp-row-info span { font-size: 12px; color: var(--mid); font-weight: 500; }
        
        .sp-row-cta {
            display: flex; align-items: center; gap: 6px;
            font-size: 12px; font-weight: 700; color: var(--blue);
            background: var(--blue-lt);
            padding: 8px 16px; border-radius: 20px;
            white-space: nowrap; flex-shrink: 0;
            transition: all .2s;
        }
        .sp-row:hover .sp-row-cta { background: var(--blue); color: #fff; }
        .sp-row-cta svg { width: 14px; height: 14px; fill: none; stroke: currentColor; stroke-width: 2.5; stroke-linecap: round; stroke-linejoin: round; }

        /* Coming soon badge */
        .sp-badge-soon {
            font-size: 10px; font-weight: 700; padding: 2px 8px;
            border-radius: 20px; background: var(--yellow-lt); color: var(--brown);
            white-space: nowrap; flex-shrink: 0;
        }

        /* Slider Nav */
        .slider-nav {
            display: flex; gap: 8px; padding: 0 20px 10px; justify-content: flex-end;
        }
        .btn-slider {
            width: 32px; height: 32px; border-radius: 6px;
            background: #F4F7FA; border: 1px solid var(--line);
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; color: var(--blue-dk); transition: all .2s;
        }
        .btn-slider:hover { background: var(--blue-lt); border-color: var(--blue-dk); }
        .btn-slider svg { width: 16px; height: 16px; fill: none; stroke: currentColor; stroke-width: 2.5; stroke-linecap: round; stroke-linejoin: round; }

        /* Divider */
        .sp-divider { height: 1px; background: transparent; margin: 0; }

        /* Layanan lainnya — 2 col */
        .sp-others { padding: 10px 20px 24px; display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }

        .sp-other-card {
            display: flex; align-items: center; gap: 16px;
            padding: 20px;
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
            width: 80px; height: 80px;
            overflow: hidden; flex-shrink: 0; background: transparent;
        }
        .sp-other-logo img { width: 100%; height: 100%; object-fit: contain; transform: scale(1.15); }
        .sp-other-name {
            font-size: 13px; font-weight: 800; color: var(--ink); flex: 1;
        }
        .sp-other-arrow {
            width: 26px; height: 26px; border-radius: 50%;
            background: var(--line); display: flex; align-items: center; justify-content: center;
            flex-shrink: 0; transition: all .2s;
        }
        .sp-other-card:hover .sp-other-arrow { background: var(--blue-dk); }
        .sp-other-arrow svg { width: 12px; height: 12px; fill: none; stroke: var(--mid); stroke-width: 2.5; stroke-linecap: round; stroke-linejoin: round; transition: stroke .2s; }
        .sp-other-card:hover .sp-other-arrow svg { stroke: #fff; }

        /* ─── STATS BAND ──────────────────────────────────── */
        .stats-band {
            background: #113454;
            padding: 48px 0;
            position: relative;
        }
        /* Override container khusus untuk stats agar bisa lebih lebar */
        .stats-band .container {
            max-width: 1400px;
            width: 100%;
        }
        .stats-inner {
            display: flex; justify-content: space-around; flex-wrap: wrap;
            width: 100%; margin: 0 auto; gap: 20px;
        }
        .stat-item {
            display: flex; flex-direction: column; align-items: center; text-align: center;
            flex: 1; min-width: 200px;
        }
        .stat-icon {
            width: 80px; height: 80px; border-radius: 14px;
            background: #1C517C;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 16px;
        }
        .stat-icon svg, .stat-icon img { width: 38px; height: 38px; object-fit: contain; }
        .stat-icon svg { fill: none; stroke: #fff; stroke-width: 1.5; stroke-linecap: round; stroke-linejoin: round; }
        .stat-num {
            font-size: 38px; font-weight: 800; color: #F5A623;
            font-family: 'Plus Jakarta Sans', sans-serif; line-height: 1.2;
            margin-bottom: 6px;
        }
        .stat-num em { font-style: normal; }
        .stat-label { 
            font-size: 14px; font-weight: 500; color: #fff; 
            text-transform: none; letter-spacing: 0.02em; 
        }

        /* ─── SECTION BASE ────────────────────────────────── */
        .section { padding: 96px 0; }
        .section-eyebrow {
            display: inline-flex; align-items: center; gap: 6px;
            font-size: 11px; font-weight: 700; letter-spacing: .1em;
            text-transform: uppercase; color: var(--blue);
            margin-bottom: 12px;
        }
        .section-eyebrow::before {
            content: ''; display: block;
            width: 16px; height: 2px;
            background: var(--blue); border-radius: 2px;
        }
        .section-title { font-size: clamp(24px,3vw,34px); font-weight: 800; letter-spacing: -.03em; color: var(--ink); margin-bottom: 14px; }
        .section-sub  { font-size: 15px; color: var(--mid); line-height: 1.75; max-width: 560px; }
        .section-header { margin-bottom: 52px; }
        .section-header-center { text-align: center; }
        .section-header-center .section-eyebrow { margin-left: auto; margin-right: auto; }
        .section-header-center .section-sub { margin-left: auto; margin-right: auto; }



        /* ─── PROCESS ─────────────────────────────────────── */
        .process { background: var(--white); }
        .eyebrow-badge {
            display: inline-block;
            background: #EBF8FF;
            color: var(--blue);
            font-size: 11px; font-weight: 700; letter-spacing: .05em;
            text-transform: uppercase;
            padding: 6px 14px;
            border-radius: 4px;
            margin-bottom: 16px;
        }
        .process-track {
            display: grid; grid-template-columns: repeat(4,1fr);
            gap: 20px; position: relative; padding-top: 24px;
        }
        .process-step { text-align: center; padding: 0 10px; position: relative; z-index: 1; }
        .step-img-wrapper {
            height: 140px; margin: 0 auto 24px;
            display: flex; align-items: flex-end; justify-content: center;
        }
        .step-img-wrapper img { width: 100%; max-width: 150px; max-height: 130px; object-fit: contain; }
        .step-title { font-size: 16px; font-weight: 800; color: #113454; margin-bottom: 12px; }
        .step-desc  { font-size: 13px; color: var(--mid); line-height: 1.6; }

        /* ─── REVIEWS ─────────────────────────────────────── */
        .reviews {
            background: #113454;
            padding: 120px 0;
            color: #fff;
        }
        .reviews .eyebrow-badge {
            background: #fff; color: var(--blue); margin-bottom: 20px;
        }
        .reviews .section-title {
            color: #F5A623; margin-bottom: 12px; font-weight: 800; font-size: clamp(24px, 3vw, 32px);
        }
        .reviews .section-sub {
            color: rgba(255,255,255,.8); font-size: 14.5px;
        }
        .reviews-layout {
            display: flex; align-items: flex-start; gap: 40px; margin-top: 60px;
        }
        .reviews-sidebar {
            width: 200px; flex-shrink: 0; padding-top: 20px;
        }
        .reviews-sidebar-title {
            font-size: 24px; font-weight: 700; color: #fff; line-height: 1.3;
            margin-bottom: 32px;
        }
        .reviews-nav {
            display: flex; gap: 12px;
        }
        .btn-rev-nav {
            width: 44px; height: 44px; border-radius: 50%;
            background: #fff; border: none; cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            transition: all .2s;
        }
        .btn-rev-nav svg { width: 16px; height: 16px; fill: none; stroke: var(--blue-dk); stroke-width: 2.5; stroke-linecap: round; stroke-linejoin: round; }
        .btn-rev-nav:hover { background: #F5A623; }
        .btn-rev-nav:hover svg { stroke: #fff; }
        
        .reviews-slider-wrap {
            flex: 1; overflow: hidden; padding-bottom: 40px; position: relative;
        }
        .reviews-slider {
            display: flex; gap: 20px; overflow-x: auto;
            scroll-snap-type: x mandatory; scrollbar-width: none;
        }
        .reviews-slider::-webkit-scrollbar { display: none; }
        .review-card {
            background: #fff; border-radius: 12px; padding: 28px;
            min-width: 380px; max-width: 380px; scroll-snap-align: start;
            display: flex; flex-direction: column; color: var(--ink);
            box-shadow: 0 10px 30px rgba(0,0,0,.15);
        }
        .review-header {
            display: flex; align-items: center; gap: 12px; margin-bottom: 16px;
        }
        .review-check {
            width: 26px; height: 26px; border-radius: 50%; border: 2px solid #F5A623;
            display: flex; align-items: center; justify-content: center; flex-shrink: 0;
        }
        .review-check svg { width: 12px; height: 12px; fill: none; stroke: #F5A623; stroke-width: 3; stroke-linecap: round; stroke-linejoin: round; }
        .review-author { flex: 1; }
        .review-author h4 { font-size: 15px; font-weight: 800; color: var(--ink); margin: 0 0 2px; }
        .review-author span { font-size: 12px; color: var(--muted); display: block; }
        .review-text {
            font-size: 13.5px; color: var(--mid); line-height: 1.6;
            font-style: italic; margin-bottom: 24px; flex: 1;
        }
        .review-foot-stars {
            display: flex; justify-content: flex-end; gap: 4px;
        }
        .review-foot-stars svg { width: 16px; height: 16px; fill: #F5A623; }
        .reviews-dots {
            display: flex; gap: 8px; position: absolute; bottom: 0; left: 0;
        }
        .rev-dot { width: 8px; height: 8px; border-radius: 50%; background: #fff; opacity: 0.3; cursor: pointer; transition: all .3s; }
        .rev-dot.active { background: #F5A623; opacity: 1; width: 24px; border-radius: 4px; }
        
        .reviews-empty {
            text-align: center; padding: 48px 24px; background: rgba(255,255,255,.05); border: 1.5px dashed rgba(255,255,255,.2);
            border-radius: var(--r-lg); color: rgba(255,255,255,.6); font-size: 14px; font-weight: 500; width: 100%;
        }

        /* ─── CTA BAND ────────────────────────────────────── */
        .cta-band {
            background: var(--blue-dk);
            padding: 72px 0;
            position: relative; overflow: hidden;
        }
        .cta-band::after {
            content: '';
            position: absolute; top: 0; left: 0; bottom: 0;
            width: 4px; background: var(--yellow);
        }
        .cta-deco {
            position: absolute; right: 0; top: 0; bottom: 0;
            width: 40%;
            background: radial-gradient(circle at 80% 50%, rgba(33,138,201,.2) 0%, transparent 60%);
            pointer-events: none;
        }
        .cta-inner {
            display: flex; align-items: center; justify-content: space-between;
            gap: 40px; position: relative; z-index: 1;
        }
        .cta-heading {
            font-size: clamp(22px, 3vw, 30px); font-weight: 800;
            color: #fff; letter-spacing: -.03em; margin-bottom: 10px;
        }
        .cta-sub { font-size: 14.5px; color: rgba(255,255,255,.5); line-height: 1.65; max-width: 420px; }
        .btn-cta {
            display: inline-flex; align-items: center; gap: 8px;
            background: var(--yellow); color: var(--blue-dk);
            padding: 14px 28px; border-radius: var(--r-md);
            font-family: inherit; font-size: 14px; font-weight: 800;
            text-decoration: none; border: none; cursor: pointer;
            white-space: nowrap; transition: all .22s; flex-shrink: 0;
        }
        .btn-cta svg { width: 15px; height: 15px; fill: none; stroke: var(--blue-dk); stroke-width: 2.5; stroke-linecap: round; stroke-linejoin: round; }
        .btn-cta:hover { background: #fff; box-shadow: 0 8px 28px rgba(255,203,5,.35); transform: translateY(-1px); }

        /* ─── FOOTER ──────────────────────────────────────── */
        .site-footer { background: var(--ink); padding: 72px 0 32px; }
        .footer-grid {
            display: grid; grid-template-columns: 1.5fr 1fr 1fr 1fr; gap: 48px;
            padding-bottom: 52px; border-bottom: 1px solid rgba(255,255,255,.07);
        }
        .footer-logo-text strong { color: #fff; }
        .footer-logo-text span   { color: rgba(255,255,255,.3); }
        .footer-desc { font-size: 13px; color: rgba(255,255,255,.35); line-height: 1.8; margin-top: 16px; }
        .footer-badges { display: flex; gap: 8px; margin-top: 22px; flex-wrap: wrap; }
        .f-badge {
            font-size: 9.5px; font-weight: 700; letter-spacing: .08em;
            text-transform: uppercase; padding: 4px 10px;
            border-radius: 4px; border: 1px solid rgba(255,255,255,.1);
            color: rgba(255,255,255,.3);
        }
        .f-col-title { font-size: 10.5px; font-weight: 700; color: rgba(255,255,255,.45); text-transform: uppercase; letter-spacing: .1em; margin-bottom: 18px; }
        .f-links { list-style: none; display: flex; flex-direction: column; gap: 11px; }
        .f-links a { font-size: 13px; color: rgba(255,255,255,.4); text-decoration: none; transition: color .2s; }
        .f-links a:hover { color: rgba(255,255,255,.85); }
        .f-contact-item { display: flex; align-items: flex-start; gap: 10px; margin-bottom: 14px; }
        .f-contact-icon {
            width: 30px; height: 30px; border-radius: 7px;
            background: rgba(255,255,255,.06);
            display: flex; align-items: center; justify-content: center; flex-shrink: 0;
        }
        .f-contact-icon svg { width: 13px; height: 13px; fill: none; stroke: var(--blue-md); stroke-width: 1.75; stroke-linecap: round; stroke-linejoin: round; }
        .f-contact-text { font-size: 12.5px; color: rgba(255,255,255,.38); line-height: 1.6; }
        .footer-bottom {
            padding-top: 24px;
            display: flex; align-items: center; justify-content: space-between; gap: 16px;
            flex-wrap: wrap;
        }
        .footer-copy { font-size: 12px; color: rgba(255,255,255,.22); }
        .footer-legal { display: flex; gap: 18px; }
        .footer-legal a { font-size: 12px; color: rgba(255,255,255,.22); text-decoration: none; transition: color .18s; }
        .footer-legal a:hover { color: rgba(255,255,255,.6); }

        /* ─── ARTIKEL & INFORMASI ─────────────────────────── */
        .artikel-section { background: #F4F7F9; padding: 100px 0; }
        .artikel-top-grid {
            display: grid; grid-template-columns: 1.8fr 1fr; gap: 32px;
            margin-bottom: 40px;
        }
        .art-featured {
            position: relative; border-radius: 0; overflow: hidden;
            min-height: 380px; display: flex; flex-direction: column; justify-content: flex-end;
            padding: 32px; color: #fff; box-shadow: 0 10px 30px rgba(0,0,0,.08);
            background-size: cover; background-position: center;
        }
        .art-featured::before {
            content: ''; position: absolute; inset: 0;
            background: linear-gradient(to top, rgba(0,0,0,.8) 0%, rgba(0,0,0,0) 60%);
        }
        .art-featured-content { position: relative; z-index: 1; }
        .art-badge {
            display: inline-block; background: #3291A8; color: #fff;
            font-size: 10px; font-weight: 700; text-transform: uppercase;
            padding: 4px 10px; border-radius: 4px; margin-bottom: 12px;
        }
        .art-featured-title { font-size: 24px; font-weight: 800; line-height: 1.3; margin-bottom: 8px; }
        .art-featured-date { font-size: 11px; opacity: 0.8; }
        
        .art-latest { display: flex; flex-direction: column; gap: 20px; }
        .art-latest-title { font-size: 16px; font-weight: 800; color: var(--ink); margin-bottom: 4px; }
        .art-latest-title span { color: var(--blue-dk); font-weight: 800; }
        .art-list-item { display: flex; gap: 16px; align-items: center; }
        .art-list-img { width: 90px; height: 90px; border-radius: 0; object-fit: cover; flex-shrink: 0; }
        .art-list-info { display: flex; flex-direction: column; gap: 4px; }
        .art-list-title { font-size: 13.5px; font-weight: 700; color: var(--ink); line-height: 1.4; }
        .art-list-date { font-size: 10px; color: var(--muted); }
        
        .art-carousel-wrap { position: relative; overflow: hidden; padding-bottom: 40px; }
        .art-carousel {
            display: flex; gap: 20px; overflow-x: auto;
            scroll-snap-type: x mandatory; scrollbar-width: none;
        }
        .art-carousel::-webkit-scrollbar { display: none; }
        .art-card {
            background: #fff; border-radius: 0; overflow: hidden;
            flex: 0 0 calc(33.333% - 14px); scroll-snap-align: start;
            box-shadow: 0 4px 12px rgba(0,0,0,.05);
            display: flex; flex-direction: column;
        }
        .art-card-img { width: 100%; height: 180px; object-fit: cover; }
        .art-card-body { padding: 24px; display: flex; flex-direction: column; flex: 1; }
        .art-card-meta { display: flex; justify-content: space-between; font-size: 10px; color: var(--muted); margin-bottom: 8px; }
        .art-card-title { font-size: 15px; font-weight: 800; color: var(--ink); line-height: 1.4; margin-bottom: 6px; }
        .art-card-cat { font-size: 10px; color: var(--blue); font-weight: 700; margin-bottom: 12px; }
        .art-card-desc { font-size: 12px; color: var(--mid); line-height: 1.6; margin-bottom: 20px; flex: 1; }
        .art-card-link { font-size: 11px; font-weight: 700; color: var(--ink); text-decoration: none; display: flex; align-items: center; gap: 4px; }
        
        .art-dots { display: flex; justify-content: center; gap: 8px; margin-top: 10px; margin-bottom: 30px; }
        .art-dot { width: 8px; height: 8px; border-radius: 50%; background: #D9D9D9; cursor: pointer; transition: all .3s; }
        .art-dot.active { background: #113454; }
        .art-btn-more-wrap { text-align: center; }
        .art-btn-more {
            display: inline-flex; align-items: center; gap: 8px;
            background: #113454; color: #fff; font-size: 12px; font-weight: 700;
            padding: 10px 24px; border-radius: 6px; text-decoration: none; transition: background .2s;
        }
        .art-btn-more:hover { background: #0b253b; }

        /* ─── ANIMATIONS ──────────────────────────────────── */
        .reveal { opacity: 0; transform: translateY(22px); transition: opacity .55s ease, transform .55s ease; }
        .reveal.visible { opacity: 1; transform: translateY(0); }
        .reveal-d1 { transition-delay: .1s; }
        .reveal-d2 { transition-delay: .2s; }
        .reveal-d3 { transition-delay: .3s; }
        .reveal-d4 { transition-delay: .4s; }

        /* ─── RESPONSIVE ──────────────────────────────────── */
        @media (max-width: 1023px) {
            .hero-grid { grid-template-columns: 1fr; gap: 40px; }
            .stats-inner { grid-template-columns: repeat(2,1fr); }
            .stat-item:nth-child(2) { border-right: none; }
            .services-wrap { grid-template-columns: 1fr 1fr; }
            .process-track { grid-template-columns: 1fr 1fr; gap: 32px; }
            .process-track::before { display: none; }
            .reviews-grid { grid-template-columns: 1fr 1fr; }
            .footer-grid { grid-template-columns: 1fr 1fr; gap: 32px; }
            .artikel-top-grid { grid-template-columns: 1fr; }
            .art-card { flex: 0 0 calc(50% - 10px); }
        }
        @media (max-width: 767px) {
            .site-nav .nav-link, .nav-sep, .site-nav .nav-dropdown { display: none; }
            .btn-nav { padding: 8px 14px; font-size: 12px; }
            .logo-text span { display: none; }
            .hero { padding: 40px 0 60px; }
            .hero-grid { gap: 32px; }
            .hero-cta-row { flex-direction: column; }
            .hero-cta-row .btn-primary, .hero-cta-row .btn-outline { width: 100%; justify-content: center; }
            .stats-inner { grid-template-columns: repeat(2,1fr); gap: 0; }
            .services-wrap { grid-template-columns: 1fr; }
            .reviews-grid { grid-template-columns: 1fr; }
            .cta-inner { flex-direction: column; text-align: center; }
            .process-track { grid-template-columns: 1fr; gap: 24px; }
            .footer-grid { grid-template-columns: 1fr; gap: 28px; }
            .sp-others { grid-template-columns: 1fr; }
            .art-card { flex: 0 0 85%; }
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
                    <span>Kantor Pertanahan Kota Sukabumi</span>
                </div>
            </a>

            <!-- Nav -->
            <nav class="site-nav">
                <a href="#" class="nav-link">Beranda</a>

                <div class="nav-dropdown">
                    <button class="nav-dropdown-trigger">
                        Layanan
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>
                    </button>
                    <div class="nav-dropdown-content">
                        <a href="{{ route('login') }}">
                            <span class="nav-dd-icon" style="background:var(--blue-lt);">
                                <img src="{{ asset('storage/logo/PKKPR.png') }}" alt="PKKPR">
                            </span>
                            Pertimbangan Teknis Pertanahan Berusaha
                        </a>
                        <a href="{{ route('login') }}">
                            <span class="nav-dd-icon" style="background:var(--green-lt);">
                                <img src="{{ asset('storage/logo/PKKPRNon.png') }}" alt="PKKPR Non">
                            </span>
                            Pertimbangan Teknis Pertanahan Non Berusaha
                        </a>
                        <a href="{{ route('login') }}">
                            <span class="nav-dd-icon" style="background:var(--yellow-lt);">
                                <img src="{{ asset('storage/logo/Kebijakan.png') }}" alt="Kebijakan">
                            </span>
                            Kebijakan
                        </a>
                        <a href="{{ route('lapolpa.index') }}">
                            <span class="nav-dd-icon" style="background:var(--surface);">
                                <img src="{{ asset('storage/logo/Lapolpak.png') }}" alt="LAPOLPAK">
                            </span>
                            LAPOLPAK
                        </a>
                        <a href="{{ route('informal.index') }}">
                            <span class="nav-dd-icon" style="background:var(--surface);">
                                <img src="{{ asset('storage/logo/Informal.png') }}" alt="Informal">
                            </span>
                            INFORMAL
                        </a>
                    </div>
                </div>

                <a href="#alur" class="nav-link">Alur Proses</a>
                <a href="#ulasan" class="nav-link">Ulasan</a>

                <div class="nav-sep"></div>

                <a href="tel:1500164" class="btn-nav">
                    <svg viewBox="0 0 24 24" style="width:14px;height:14px;fill:var(--yellow);flex-shrink:0;"><path d="M6.6 10.8c1.4 2.8 3.8 5.1 6.6 6.6l2.2-2.2c.3-.3.7-.4 1-.2 1.1.4 2.3.6 3.6.6.6 0 1 .4 1 1V20c0 .6-.4 1-1 1-9.4 0-17-7.6-17-17 0-.6.4-1 1-1h3.5c.6 0 1 .4 1 1 0 1.3.2 2.5.6 3.6.1.3 0 .7-.2 1L6.6 10.8z"/></svg>
                    Kontak Kami
                </a>
            </nav>
        </div>
    </div>
</header>

<!-- ══ HERO ════════════════════════════════════════════════ -->
<section class="hero">
    <div class="hero-bg"></div>
    <div class="container">
        <div class="hero-grid">

            <!-- Left: Copy -->
            <div>
                <div class="hero-eyebrow">
                    <span class="eyebrow-dot"></span>
                    Portal Layanan Masyarakat
                </div>

                <h1 class="hero-heading">
                    Pertimbangan Teknis<br>
                    <span class="accent">Pertanahan</span><br>
                    <span class="strong-line">yang Terkoneksi Kantor<br>Pertanahan Sukabumi Kota</span>
                </h1>

                <p class="hero-sub">
                    PATEN Pak Miko hadir sebagai inovasi pelayanan yang memberikan kemudahan bagi pemohon dalam memperoleh layanan pertanahan secara lebih cepat, jelas, dan transparan. PATEN Pak Miko diharapkan mampu meningkatkan kepercayaan pemohon sekaligus memberikan pengalaman layanan yang lebih profesional, responsif, dan memudahkan.
                </p>

                <div class="hero-cta-row">
                    <a href="tel:1500164" class="btn-primary">
                        Hubungi Kami
                        <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </a>
                    <a href="#modul" class="btn-outline">
                        Pelajari Layanan Kami
                        <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </a>
                </div>
            </div>

            <!-- Right: Service Panel -->
            <div>
                <div class="service-panel">
                    <!-- Header -->
                    <div class="sp-header">
                        <div class="sp-header-icon">
                            <svg viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                        </div>
                        <div class="sp-header-text">
                            <strong>Pilih Modul Layanan yang Anda Butuhkan</strong>
                        </div>
                    </div>

                    <!-- PKKPR Section -->
                    <div class="sp-section-label">
                        <span>Layanan Pertimbangan Teknis Pertanahan</span>
                        <div style="display: flex; gap: 6px;">
                            <button type="button" class="btn-slider" style="width: 28px; height: 28px;" onclick="document.querySelector('.sp-rows').scrollBy({left: -400, behavior: 'smooth'})">
                                <svg viewBox="0 0 24 24" style="width: 14px; height: 14px;"><path d="M15 18l-6-6 6-6"/></svg>
                            </button>
                            <button type="button" class="btn-slider" style="width: 28px; height: 28px;" onclick="document.querySelector('.sp-rows').scrollBy({left: 400, behavior: 'smooth'})">
                                <svg viewBox="0 0 24 24" style="width: 14px; height: 14px;"><path d="M9 18l6-6-6-6"/></svg>
                            </button>
                        </div>
                    </div>
                    <div class="sp-rows">
                        <!-- Slide 1 (3 Items) -->
                        <div class="sp-slide">
                            <!-- Berusaha -->
                            <a href="{{ route('ptp.create', ['layanan' => 'berusaha']) }}" class="sp-row">
                                <div class="sp-row-logo">
                                    <img src="{{ asset('storage/logo/PKKPR.png') }}" alt="PKKPR Berusaha">
                                </div>
                                <div class="sp-row-info">
                                    <strong>Pertimbangan Teknis Pertanahan Berusaha</strong>
                                    <span>Bisnis, usaha, industri</span>
                                </div>
                                <div class="sp-row-cta">
                                    Daftar
                                    <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                                </div>
                            </a>

                            <!-- Non Berusaha -->
                            <a href="{{ route('ptp.create', ['layanan' => 'non-berusaha']) }}" class="sp-row">
                                <div class="sp-row-logo">
                                    <img src="{{ asset('storage/logo/PKKPRNon.png') }}" alt="PKKPR Non Berusaha">
                                </div>
                                <div class="sp-row-info">
                                    <strong>Pertimbangan Teknis Pertanahan Non Berusaha</strong>
                                    <span>Rumah, sosial, keagamaan</span>
                                </div>
                                <div class="sp-row-cta">
                                    Daftar
                                    <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                                </div>
                            </a>

                            <!-- Kebijakan -->
                            <a href="{{ route('ptp.create', ['layanan' => 'kebijakan']) }}" class="sp-row">
                                <div class="sp-row-logo">
                                    <img src="{{ asset('storage/logo/Kebijakan.png') }}" alt="Kebijakan">
                                </div>
                                <div class="sp-row-info">
                                    <strong>Kebijakan Khusus</strong>
                                    <span>Kebijakan pengguna &amp; pemanfaatan tanah</span>
                                </div>
                                <div class="sp-row-cta">
                                    Daftar
                                    <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                                </div>
                            </a>
                        </div>

                        <!-- Slide 2 (2 Items) -->
                        <div class="sp-slide">
                            <!-- Tanah Timbul -->
                            <a href="{{ route('ptp.create', ['layanan' => 'tanah-timbul']) }}" class="sp-row">
                                <div class="sp-row-logo" style="background:var(--green-lt); transform: none;">
                                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="var(--green-dk)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                                </div>
                                <div class="sp-row-info">
                                    <strong>Pertimbangan Teknis Pertanahan Tanah Timbul</strong>
                                    <span>Pengurusan legalitas tanah timbul</span>
                                </div>
                                <div class="sp-row-cta">
                                    Daftar
                                    <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                                </div>
                            </a>

                            <!-- PSN -->
                            <a href="{{ route('ptp.create', ['layanan' => 'psn']) }}" class="sp-row">
                                <div class="sp-row-logo" style="background:var(--yellow-lt); transform: none;">
                                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="var(--brown)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
                                </div>
                                <div class="sp-row-info">
                                    <strong>Pertimbangan Teknis Pertanahan Untuk Proyek Strategis Nasional</strong>
                                    <span>Proyek skala nasional (PSN)</span>
                                </div>
                                <div class="sp-row-cta" style="color:var(--brown); background:var(--yellow-lt);">
                                    Daftar
                                    <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
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
                                <img src="{{ asset('storage/logo/Lapolpak.png') }}" alt="LAPOLPAK">
                            </div>
                            <span class="sp-other-name">LAPOLPAK</span>
                            <div class="sp-other-arrow">
                                <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                            </div>
                        </a>

                        <a href="{{ route('informal.index') }}" class="sp-other-card">
                            <div class="sp-other-logo">
                                <img src="{{ asset('storage/logo/Informal.png') }}" alt="INFORMAL">
                            </div>
                            <span class="sp-other-name">INFORMAL</span>
                            <div class="sp-other-arrow">
                                <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                            </div>
                        </a>

                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ══ STATS ════════════════════════════════════════════════ -->
<div class="stats-band">
    <div class="container">
        <div class="stats-inner">
            @php
                $stats = [
                    [
                        'icon' => '<img src="'.asset('storage/svg/quote-request 1.svg').'" alt="Permohonan">',
                        'value' => '12',
                        'suffix' => 'k',
                        'label' => 'Permohonan Diproses',
                    ],
                    [
                        'icon' => '<img src="'.asset('storage/svg/tag 1.svg').'" alt="Rating">',
                        'value' => $averageRating ?? '4.0',
                        'suffix' => '/5',
                        'label' => 'Rata-rata Rating',
                    ],
                    [
                        'icon' => '<img src="'.asset('storage/svg/calendar 1.svg').'" alt="Penyelesaian">',
                        'value' => '10',
                        'suffix' => ' hari',
                        'label' => 'Rata-rata Penyelesaian',
                    ],
                    [
                        'icon' => '<svg viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>',
                        'value' => $visitorCount ?? '0',
                        'suffix' => '',
                        'label' => 'Kunjungan',
                    ],
                ];
            @endphp
            @foreach($stats as $stat)
                <div class="stat-item">
                    <div class="stat-icon">{!! $stat['icon'] !!}</div>
                    <div class="stat-num">{{ $stat['value'] }}@if($stat['suffix'])<em>{{ $stat['suffix'] }}</em>@endif</div>
                    <div class="stat-label">{{ $stat['label'] }}</div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<!-- ══ PROCESS ══════════════════════════════════════════════ -->
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
                <p class="step-desc">Permohonan Anda sedang diproses. Anda dapat memantau status perkembangan layanan secara real-time melalui dashboard.</p>
            </div>
        </div>
    </div>
</section>

<!-- ══ REVIEWS ══════════════════════════════════════════════ -->
<section id="ulasan" class="section reviews">
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
                    <button class="btn-rev-nav" onclick="scrollRev(-1)"><svg viewBox="0 0 24 24"><path d="M15 18l-6-6 6-6"/></svg></button>
                    <button class="btn-rev-nav" onclick="scrollRev(1)"><svg viewBox="0 0 24 24"><path d="M9 18l6-6-6-6"/></svg></button>
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
                                        <svg viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg>
                                    </div>
                                    <div class="review-author">
                                        <h4>{{ $review->reviewer_name }}</h4>
                                        <span>Sukabumi</span>
                                    </div>
                                </div>
                                <p class="review-text">"{{ $review->comment }}"</p>
                                <div class="review-foot-stars">
                                    @for($i = 0; $i < 5; $i++)
                                        <svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                                    @endfor
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="reviews-dots" id="revDots">
                        @foreach($reviews as $index => $review)
                            <div class="rev-dot {{ $index === 0 ? 'active' : '' }}" onclick="goToRev({{ $index }})"></div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
<script>
    function scrollRev(dir) {
        const slider = document.getElementById('revSlider');
        if(slider) {
            const cardWidth = slider.querySelector('.review-card').offsetWidth + 20;
            const maxScroll = slider.scrollWidth - slider.clientWidth;
            
            // Loop ke awal jika mentok kanan
            if (dir === 1 && slider.scrollLeft >= maxScroll - 10) {
                slider.scrollTo({ left: 0, behavior: 'smooth' });
                return;
            }
            // Loop ke akhir jika mentok kiri
            if (dir === -1 && slider.scrollLeft <= 10) {
                slider.scrollTo({ left: maxScroll, behavior: 'smooth' });
                return;
            }

            slider.scrollBy({ left: dir * cardWidth, behavior: 'smooth' });
        }
    }
    function goToRev(index) {
        const slider = document.getElementById('revSlider');
        if(slider) {
            const cardWidth = slider.querySelector('.review-card').offsetWidth + 20;
            slider.scrollTo({ left: index * cardWidth, behavior: 'smooth' });
        }
    }
    // Update dots on scroll and auto-slide
    document.addEventListener("DOMContentLoaded", () => {
        const revSlider = document.getElementById('revSlider');
        if(revSlider) {
            let autoSlideInterval = setInterval(() => scrollRev(1), 4000);

            // Pause on hover/interaction
            revSlider.addEventListener('mouseenter', () => clearInterval(autoSlideInterval));
            revSlider.addEventListener('mouseleave', () => {
                autoSlideInterval = setInterval(() => scrollRev(1), 4000);
            });
            document.querySelector('.reviews-nav').addEventListener('mouseenter', () => clearInterval(autoSlideInterval));
            document.querySelector('.reviews-nav').addEventListener('mouseleave', () => {
                autoSlideInterval = setInterval(() => scrollRev(1), 4000);
            });

            revSlider.addEventListener('scroll', () => {
                const cardWidth = revSlider.querySelector('.review-card').offsetWidth + 20;
                const index = Math.round(revSlider.scrollLeft / cardWidth);
                document.querySelectorAll('.rev-dot').forEach((dot, i) => {
                    dot.classList.toggle('active', i === index);
                });
            });
        }
    });
</script>

<!-- ══ ARTIKEL & INFORMASI ════════════════════════════════════ -->
<section id="artikel" class="artikel-section">
    <div class="container">
        <div class="section-header section-header-center reveal">
            <div class="eyebrow-badge" style="background:#EBF8FF; color:#3291A8;">Artikel Kami</div>
            <h2 class="section-title" style="color:#113454;">Artikel &amp; Informasi Terbaru</h2>
            <p class="section-sub">Temukan berbagai informasi, panduan, dan berita terbaru seputar<br>pelayanan pertanahan dan administrasi digital.</p>
        </div>

        <div class="artikel-top-grid reveal reveal-d1">
            <!-- Featured Article -->
            <div class="art-featured" style="background-image: url('https://dummyimage.com/1200x800/eeeeee/31343c.png&text=Featured+Article');">
                <div class="art-featured-content">
                    <span class="art-badge">Category</span>
                    <h3 class="art-featured-title">Cara Mengajukan Permohonan PPKPR Secara Online</h3>
                    <span class="art-featured-date">Senin, 27 April 2026</span>
                </div>
            </div>

            <!-- Latest Post List -->
            <div class="art-latest">
                <h3 class="art-latest-title">Latest <span>Post</span></h3>
                
                <div class="art-list-item">
                    <img src="https://dummyimage.com/180x180/eeeeee/31343c.png&text=Post+1" alt="Panduan" class="art-list-img">
                    <div class="art-list-info">
                        <h4 class="art-list-title">Panduan Lengkap Upload Persyaratan Dokumen</h4>
                        <span class="art-list-date">Senin, 27 April 2026</span>
                    </div>
                </div>

                <div class="art-list-item">
                    <img src="https://dummyimage.com/180x180/eeeeee/31343c.png&text=Post+2" alt="Verifikasi" class="art-list-img">
                    <div class="art-list-info">
                        <h4 class="art-list-title">Tahapan Verifikasi Berkas pada PATEN PAK MIKO</h4>
                        <span class="art-list-date">Senin, 27 April 2026</span>
                    </div>
                </div>

                <div class="art-list-item">
                    <img src="https://dummyimage.com/180x180/eeeeee/31343c.png&text=Post+3" alt="Tips" class="art-list-img">
                    <div class="art-list-info">
                        <h4 class="art-list-title">Tips Menyiapkan Dokumen Pertanahan dengan Benar</h4>
                        <span class="art-list-date">Senin, 27 April 2026</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Carousel -->
        <div class="art-carousel-wrap reveal reveal-d2">
            <div class="art-carousel" id="artCarousel">
                @for ($i = 1; $i <= 9; $i++)
                <div class="art-card">
                    <img src="https://dummyimage.com/600x400/eeeeee/31343c.png&text=Berita+{{ $i }}" alt="News {{ $i }}" class="art-card-img">
                    <div class="art-card-body">
                        <div class="art-card-meta">
                            <span>Senin, 27 April 2026</span>
                        </div>
                        <h4 class="art-card-title">Judul Dummy Berita Ke-{{ $i }}</h4>
                        <span class="art-card-cat">Category</span>
                        <p class="art-card-desc">Ini adalah contoh teks dummy untuk deskripsi berita ke-{{ $i }}. Gunakan ini untuk melihat tampilan card tanpa konten asli.</p>
                        <a href="#" class="art-card-link">Read more &rarr;</a>
                    </div>
                </div>
                @endfor
            </div>

            <!-- Dots -->
            <div class="art-dots" id="artDots">
                @for ($i = 1; $i <= 9; $i++)
                    <div class="art-dot {{ $i == 1 ? 'active' : '' }}"></div>
                @endfor
            </div>

            <!-- More Button -->
            <div class="art-btn-more-wrap">
                <a href="#" class="art-btn-more">Baca Lebih Banyak &rarr;</a>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const artSlider = document.getElementById('artCarousel');
        const artDots = document.querySelectorAll('#artDots .art-dot');

        if(artSlider && artDots.length > 0) {
            let artAutoSlide = setInterval(() => {
                const cardWidth = artSlider.querySelector('.art-card').offsetWidth + 20;
                const maxScroll = artSlider.scrollWidth - artSlider.clientWidth;
                
                if (artSlider.scrollLeft >= maxScroll - 10) {
                    artSlider.scrollTo({ left: 0, behavior: 'smooth' });
                } else {
                    artSlider.scrollBy({ left: cardWidth, behavior: 'smooth' });
                }
            }, 1000); // 1 detik auto slide

            // Pause on hover
            artSlider.addEventListener('mouseenter', () => clearInterval(artAutoSlide));
            artSlider.addEventListener('mouseleave', () => {
                artAutoSlide = setInterval(() => {
                    const cardWidth = artSlider.querySelector('.art-card').offsetWidth + 20;
                    const maxScroll = artSlider.scrollWidth - artSlider.clientWidth;
                    if (artSlider.scrollLeft >= maxScroll - 10) {
                        artSlider.scrollTo({ left: 0, behavior: 'smooth' });
                    } else {
                        artSlider.scrollBy({ left: cardWidth, behavior: 'smooth' });
                    }
                }, 1000);
            });

            // Update dots on scroll
            artSlider.addEventListener('scroll', () => {
                const cardWidth = artSlider.querySelector('.art-card').offsetWidth + 20;
                let index = Math.round(artSlider.scrollLeft / cardWidth);
                if (index >= artDots.length) index = artDots.length - 1;
                
                artDots.forEach((dot, i) => {
                    dot.classList.toggle('active', i === index);
                });
            });

            // Dot click navigation
            artDots.forEach((dot, i) => {
                dot.addEventListener('click', () => {
                    const cardWidth = artSlider.querySelector('.art-card').offsetWidth + 20;
                    artSlider.scrollTo({ left: i * cardWidth, behavior: 'smooth' });
                });
            });
        }
    });
</script>

<!-- ══ CTA BAND ════════════════════════════════════════════ -->
<section class="cta-band">
    <div class="cta-deco"></div>
    <div class="container">
        <div class="cta-inner">
            <div class="reveal">
                <h2 class="cta-heading">Mulai Permohonan Anda<br>Hari Ini</h2>
                <p class="cta-sub">Daftarkan diri dan ajukan permohonan Pertimbangan Teknis Pertanahan secara digital. Cepat, transparan, dan terintegrasi dengan sistem nasional ATR/BPN.</p>
            </div>
            <a href="{{ route('login') }}" class="btn-cta reveal reveal-d2">
                Masuk Sekarang
                <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
        </div>
    </div>
</section>

<!-- ══ FOOTER ═══════════════════════════════════════════════ -->
<footer class="site-footer">
    <div class="container">
        <div class="footer-grid">
            <div>
                <a href="/" class="logo-wrap" style="margin-bottom:0">
                    <img src="{{ asset('storage/logo/PATEN PAK MIKO LOGO.png') }}" alt="Logo" style="width:44px;height:44px;border-radius:50%;object-fit:cover;">
                    <div class="logo-text footer-logo-text">
                        <strong>PATEN PAK MIKO</strong>
                        <span>Kantor Pertanahan Kota Sukabumi</span>
                    </div>
                </a>
                <p class="footer-desc">Sistem Pelayanan Terpadu &amp; Terintegrasi Pertimbangan Teknis Pertanahan, dedikasi untuk efisiensi birokrasi dan transparansi publik.</p>
                <div class="footer-badges">
                    <span class="f-badge">ATR / BPN</span>
                    <span class="f-badge">Gov 2026</span>
                    <span class="f-badge">ISO Verified</span>
                </div>
            </div>

            <div>
                <h4 class="f-col-title">Sistem</h4>
                <ul class="f-links">
                    <li><a href="#">Tentang PATEN PAK MIKO</a></li>
                    <li><a href="#">Panduan Registrasi</a></li>
                    <li><a href="#">Alur Pelayanan</a></li>
                    <li><a href="#">Integrasi Gistaru</a></li>
                    <li><a href="#">FAQ</a></li>
                </ul>
            </div>

            <div>
                <h4 class="f-col-title">Modul</h4>
                <ul class="f-links">
                    <li><a href="{{ route('lapolpa.index') }}">LAPOLPAK</a></li>
                    <li><a href="#">Pertimbangan Teknis Non Berusaha</a></li>
                    <li><a href="#">Pertimbangan Teknis Berusaha</a></li>
                    <li><a href="#">Kebijakan</a></li>
                    <li><a href="{{ route('informal.index') }}">Peta Publik</a></li>
                </ul>
            </div>

            <div>
                <h4 class="f-col-title">Hubungi Kami</h4>
                <div class="f-contact-item">
                    <div class="f-contact-icon">
                        <svg viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    </div>
                    <span class="f-contact-text">Gedung Kementerian ATR/BPN,<br>Jakarta Selatan, DKI Jakarta</span>
                </div>
                <div class="f-contact-item">
                    <div class="f-contact-icon">
                        <svg viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                    </div>
                    <span class="f-contact-text">support@patenpakmiko.go.id</span>
                </div>
                <div class="f-contact-item">
                    <div class="f-contact-icon">
                        <svg viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81 19.79 19.79 0 01.01 1.18 2 2 0 012 0h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/></svg>
                    </div>
                    <span class="f-contact-text">1500-164 (Hotline Nasional)</span>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <p class="footer-copy">&copy; 2026 Badan Pertanahan Nasional — Kementerian ATR/BPN Republik Indonesia. Seluruh hak cipta dilindungi.</p>
            <nav class="footer-legal">
                <a href="#">Syarat &amp; Ketentuan</a>
                <a href="#">Kebijakan Privasi</a>
                <a href="#">Aksesibilitas</a>
            </nav>
        </div>
    </div>
</footer>

<script>
    // Toggle Hidden Rows
    function toggleHiddenRows(btn) {
        const hiddenRows = document.querySelectorAll('.sp-row-hidden');
        const isActive = btn.classList.contains('active');
        
        if (isActive) {
            // Sembunyikan
            hiddenRows.forEach(row => row.style.display = 'none');
            btn.classList.remove('active');
            btn.querySelector('span').textContent = 'Tampilkan Layanan Lainnya';
        } else {
            // Tampilkan
            hiddenRows.forEach(row => row.style.display = 'flex');
            btn.classList.add('active');
            btn.querySelector('span').textContent = 'Sembunyikan Layanan';
        }
    }

    // Header scroll shadow
    const header = document.getElementById('site-header');
    window.addEventListener('scroll', () => {
        header.classList.toggle('scrolled', window.scrollY > 20);
    }, { passive: true });

    // Reveal on scroll
    const io = new IntersectionObserver((entries) => {
        entries.forEach(e => {
            if (e.isIntersecting) { e.target.classList.add('visible'); io.unobserve(e.target); }
        });
    }, { threshold: 0.1 });
    document.querySelectorAll('.reveal').forEach(el => io.observe(el));

    // Process step highlight
    const steps = document.querySelectorAll('.process-step');
    const stepIO = new IntersectionObserver((entries) => {
        entries.forEach(e => {
            if (e.isIntersecting) {
                steps.forEach(s => s.classList.remove('active'));
                e.target.classList.add('active');
            }
        });
    }, { threshold: 0.7 });
    steps.forEach(s => stepIO.observe(s));

    // Auto Slide for Hero Service Panel (.sp-rows)
    document.addEventListener("DOMContentLoaded", () => {
        const spRows = document.querySelector('.sp-rows');
        if (spRows) {
            let spAutoSlide = setInterval(() => {
                const maxScroll = spRows.scrollWidth - spRows.clientWidth;
                if (spRows.scrollLeft >= maxScroll - 10) {
                    spRows.scrollTo({ left: 0, behavior: 'smooth' });
                } else {
                    spRows.scrollBy({ left: 400, behavior: 'smooth' });
                }
            }, 1000);
            
            const spPanel = document.querySelector('.service-panel');
            if (spPanel) {
                spPanel.addEventListener('mouseenter', () => clearInterval(spAutoSlide));
                spPanel.addEventListener('mouseleave', () => {
                    spAutoSlide = setInterval(() => {
                        const maxScroll = spRows.scrollWidth - spRows.clientWidth;
                        if (spRows.scrollLeft >= maxScroll - 10) {
                            spRows.scrollTo({ left: 0, behavior: 'smooth' });
                        } else {
                            spRows.scrollBy({ left: 400, behavior: 'smooth' });
                        }
                    }, 1000);
                });
            }
        }
    });
</script>
</body>
</html>