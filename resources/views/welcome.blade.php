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
            transition: box-shadow .3s;
        }
        #site-header.scrolled { box-shadow: 0 4px 24px rgba(0,59,100,.08); }

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

        .color-bar { height: 3px; display: flex; }
        .color-bar span:nth-child(1) { flex: 3; background: var(--blue-dk); }
        .color-bar span:nth-child(2) { flex: 1; background: var(--yellow); }
        .color-bar span:nth-child(3) { flex: 1; background: var(--green); }

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
        .process-track {
            display: grid; grid-template-columns: repeat(4,1fr);
            gap: 0; position: relative;
        }
        .process-track::before {
            content: ''; position: absolute;
            top: 27px; left: calc(12.5% + 20px); right: calc(12.5% + 20px);
            height: 1px; background: var(--line); z-index: 0;
        }
        .process-step { text-align: center; padding: 0 20px; position: relative; z-index: 1; }
        .step-circle {
            width: 54px; height: 54px; border-radius: 50%;
            border: 1.5px solid var(--line);
            background: var(--white);
            margin: 0 auto 20px;
            display: flex; align-items: center; justify-content: center;
            font-family: 'DM Mono', monospace; font-size: 15px; font-weight: 500;
            color: var(--muted); transition: all .3s;
        }
        .process-step.active .step-circle {
            background: var(--blue-dk); border-color: var(--blue-dk);
            color: #fff;
            box-shadow: 0 4px 20px rgba(33,138,201,.3);
        }
        .step-title { font-size: 14.5px; font-weight: 700; color: var(--ink); margin-bottom: 8px; }
        .step-desc  { font-size: 12.5px; color: var(--mid); line-height: 1.65; }

        /* ─── REVIEWS ─────────────────────────────────────── */
        .reviews { background: var(--surface); }
        .reviews-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 20px; }
        .review-card {
            background: var(--white); border: 1px solid var(--line);
            border-radius: var(--r-lg); padding: 24px;
            display: flex; flex-direction: column; gap: 14px;
            transition: all .25s;
        }
        .review-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 36px rgba(33,138,201,.09);
            border-color: var(--blue-md);
        }
        .review-stars { color: #D69E2E; font-size: 15px; letter-spacing: 1px; }
        .review-stars span { font-size: 12px; font-weight: 700; color: var(--mid); margin-left: 6px; font-family: 'DM Mono', monospace; }
        .review-text { font-size: 13.5px; color: var(--mid); line-height: 1.7; font-style: italic; flex: 1; }
        .review-text::before { content: '\201C'; }
        .review-text::after  { content: '\201D'; }
        .review-foot {
            display: flex; align-items: center; gap: 12px;
            padding-top: 14px; border-top: 1px solid var(--line);
        }
        .review-avatar {
            width: 36px; height: 36px; border-radius: 50%;
            background: var(--blue-lt); color: var(--blue);
            font-weight: 700; font-size: 12px;
            display: flex; align-items: center; justify-content: center;
            text-transform: uppercase; border: 1.5px solid var(--blue-md);
            flex-shrink: 0;
        }
        .review-info strong { display: block; font-size: 12.5px; font-weight: 700; color: var(--ink); }
        .review-info span   { font-size: 11px; color: var(--muted); }
        .review-module {
            display: inline-block; margin-top: 3px;
            background: var(--blue-lt); color: var(--blue);
            font-size: 10px; font-weight: 700;
            padding: 1px 7px; border-radius: 4px;
            text-transform: uppercase; letter-spacing: .04em;
        }
        .reviews-empty {
            text-align: center; padding: 48px 24px;
            background: var(--white); border: 1.5px dashed var(--line);
            border-radius: var(--r-lg); color: var(--muted);
            font-size: 14px; font-weight: 500;
            grid-column: 1 / -1;
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

        /* ─── NEWS CAROUSEL ───────────────────────────────── */
        .news-carousel-wrap { position: relative; max-width: 100%; margin-top: 40px; }
        .news-carousel {
            display: flex; overflow-x: auto; scroll-snap-type: x mandatory;
            gap: 20px; padding-bottom: 20px; scrollbar-width: none;
        }
        .news-carousel::-webkit-scrollbar { display: none; }
        .news-card {
            scroll-snap-align: start;
            flex: 0 0 calc(33.333% - 14px);
            background: #fff; border: 1px solid var(--line);
            border-radius: var(--r-md); overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,.05); transition: transform .3s;
        }
        .news-card:hover { transform: translateY(-5px); box-shadow: 0 12px 24px rgba(0,0,0,.1); }
        .news-img { width: 100%; height: 200px; object-fit: cover; }
        .news-content { padding: 20px; }
        .news-date { font-size: 12px; color: var(--muted); font-weight: 600; margin-bottom: 8px; display: block; }
        .news-title { font-size: 16px; font-weight: 700; color: var(--ink); margin-bottom: 12px; line-height: 1.4; }
        .news-desc { font-size: 14px; color: var(--mid); line-height: 1.6; }

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
            .news-card { flex: 0 0 85%; }
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
    <div class="color-bar"><span></span><span></span><span></span></div>
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

<!-- ══ BERITA & GALERI ════════════════════════════════════════ -->
<section id="galeri" class="section" style="background: var(--white);">
    <div class="container">
        <div class="section-header section-header-center reveal">
            <div class="section-eyebrow">Berita &amp; Galeri</div>
            <h2 class="section-title">Informasi Seputar Tata Ruang</h2>
            <p class="section-sub">Berita terbaru dan dokumentasi kegiatan pelayanan pertimbangan teknis pertanahan di Kota Sukabumi.</p>
        </div>

        <div class="news-carousel-wrap reveal reveal-d2">
            <div class="news-carousel" id="newsCarousel">
                <div class="news-card">
                    <img src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&w=800&q=80" alt="Berita 1" class="news-img">
                    <div class="news-content">
                        <span class="news-date">02 Jun 2026</span>
                        <h3 class="news-title">Sosialisasi Peraturan Baru Kesesuaian Tata Ruang</h3>
                        <p class="news-desc">Kantor Pertanahan mengadakan sosialisasi terkait pembaruan regulasi untuk perizinan pelaku usaha skala menengah dan besar.</p>
                    </div>
                </div>
                <div class="news-card">
                    <img src="https://images.unsplash.com/photo-1541888086225-b467ec6b60c0?auto=format&fit=crop&w=800&q=80" alt="Berita 2" class="news-img">
                    <div class="news-content">
                        <span class="news-date">28 Mei 2026</span>
                        <h3 class="news-title">Peninjauan Lapangan Kawasan Industri Baru</h3>
                        <p class="news-desc">Tim lapangan BPN dan Dinas PU melakukan survei bersama untuk memastikan kelayakan lokasi kawasan industri di wilayah selatan.</p>
                    </div>
                </div>
                <div class="news-card">
                    <img src="https://images.unsplash.com/photo-1503387762-592deb58ef4e?auto=format&fit=crop&w=800&q=80" alt="Berita 3" class="news-img">
                    <div class="news-content">
                        <span class="news-date">15 Mei 2026</span>
                        <h3 class="news-title">Penghargaan Inovasi Pelayanan Publik 2026</h3>
                        <p class="news-desc">Paten Pak Miko kembali mendapatkan apresiasi sebagai sistem layanan pertanahan terbaik dengan transparansi tingkat tinggi.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ══ PROCESS ══════════════════════════════════════════════ -->
<section id="alur" class="section process">
    <div class="container">
        <div class="section-header section-header-center reveal">
            <div class="section-eyebrow">Alur Pelayanan</div>
            <h2 class="section-title">Proses Sederhana, Empat Tahap</h2>
            <p class="section-sub">Setiap permohonan mengikuti alur terstandarisasi untuk memastikan ketepatan, kepatuhan, dan transparansi proses.</p>
        </div>
        <div class="process-track">
            <div class="process-step active reveal reveal-d1">
                <div class="step-circle">01</div>
                <h3 class="step-title">Siapkan Formulir</h3>
                <p class="step-desc">Isi formulir PTP di loket Kantor Pertanahan dan dapatkan akun resmi dari petugas layanan kami.</p>
            </div>
            <div class="process-step reveal reveal-d2">
                <div class="step-circle">02</div>
                <h3 class="step-title">Pilih Modul</h3>
                <p class="step-desc">Tentukan jenis permohonan sesuai peruntukan dan kriteria kegiatan pemanfaatan ruang Anda.</p>
            </div>
            <div class="process-step reveal reveal-d3">
                <div class="step-circle">03</div>
                <h3 class="step-title">Unggah Dokumen</h3>
                <p class="step-desc">Lengkapi dan unggah berkas persyaratan melalui sistem secara digital, kapan saja dan di mana saja.</p>
            </div>
            <div class="process-step reveal reveal-d4">
                <div class="step-circle">04</div>
                <h3 class="step-title">Terima Persetujuan</h3>
                <p class="step-desc">Pantau status secara real-time dan unduh Dokumen Pertek Pertanahan persetujuan resmi digital Anda.</p>
            </div>
        </div>
    </div>
</section>

<!-- ══ REVIEWS ══════════════════════════════════════════════ -->
<section id="ulasan" class="section reviews">
    <div class="container">
        <div class="section-header section-header-center reveal">
            <div class="section-eyebrow">Testimoni</div>
            <h2 class="section-title">Apa Kata Pengguna Layanan</h2>
            <p class="section-sub">Ulasan jujur dari para pengguna layanan/pemohon mengenai kemudahan, transparansi, dan kecepatan proses Pertimbangan Teknis Pertanahan di PATEN PAK MIKO.</p>
        </div>

        @if($reviews->isEmpty())
            <div class="reviews-empty">
                <p>Belum ada ulasan yang dipublikasikan saat ini.</p>
            </div>
        @else
            <div class="reviews-grid">
                @foreach($reviews as $review)
                    <div class="review-card reveal">
                        <div>
                            <div class="review-stars">
                                {{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5 - $review->rating) }}
                                <span>{{ number_format($review->rating, 1) }}</span>
                            </div>
                        </div>
                        <p class="review-text">{{ $review->comment }}</p>
                        <div class="review-foot">
                            <div class="review-avatar">{{ $review->reviewer_initial }}</div>
                            <div class="review-info">
                                <strong>{{ $review->reviewer_name }}</strong>
                                <span>{{ $review->created_at->format('d M Y') }}</span>
                                <span class="review-module">{{ $review->module_label_display }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

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
</script>
</body>
</html>