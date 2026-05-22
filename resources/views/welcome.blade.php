<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PATENPAKMIKO — Persetujuan Kesesuaian Kegiatan Pemanfaatan Ruang</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --clr-blue:    #1393CC;
            --clr-blue-dk: #0f7bb0;
            --clr-blue-lt: #E8F5FB;
            --clr-yellow:  #F2CC05;
            --clr-green:   #95B93E;
            --clr-ink:     #0B1420;
            --clr-mid:     #4B5A6A;
            --clr-muted:   #8A98A8;
            --clr-line:    #E3E8EF;
            --clr-surface: #F6F9FC;
            --clr-white:   #FFFFFF;
            --radius-sm:   6px;
            --radius-md:   10px;
            --radius-lg:   16px;
            --radius-xl:   24px;
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--clr-white);
            color: var(--clr-ink);
            -webkit-font-smoothing: antialiased;
        }

        /* ─── UTILITIES ─────────────────────────────────────── */
        .container { max-width: 1200px; margin: 0 auto; padding: 0 24px; }
        @media (min-width: 1024px) { .container { padding: 0 48px; } }

        .label-tag {
            display: inline-flex; align-items: center; gap: 6px;
            font-size: 11px; font-weight: 700; letter-spacing: .1em;
            text-transform: uppercase; color: var(--clr-blue);
            background: var(--clr-blue-lt);
            padding: 5px 12px; border-radius: 100px;
        }

        /* ─── HEADER ─────────────────────────────────────────── */
        #site-header {
            position: sticky; top: 0; z-index: 100;
            background: rgba(255,255,255,.92);
            backdrop-filter: blur(16px);
            border-bottom: 1px solid var(--clr-line);
            transition: box-shadow .3s;
        }
        #site-header.scrolled { box-shadow: 0 4px 24px rgba(0,0,0,.06); }

        .header-inner {
            display: flex; align-items: center; justify-content: space-between;
            height: 72px;
        }

        .logo-wrap { display: flex; align-items: center; gap: 12px; text-decoration: none; }
        .logo-icon {
            width: 40px; height: 40px; border-radius: var(--radius-md);
            background: var(--clr-blue); display: flex; align-items: center;
            justify-content: center;
        }
        .logo-icon svg { width: 20px; height: 20px; fill: none; stroke: #fff; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; }
        .logo-text { display: flex; flex-direction: column; line-height: 1; }
        .logo-text strong { font-size: 16px; font-weight: 800; color: var(--clr-ink); letter-spacing: -.02em; }
        .logo-text span { font-size: 10px; font-weight: 600; color: var(--clr-muted); text-transform: uppercase; letter-spacing: .1em; margin-top: 3px; }

        .site-nav { display: flex; align-items: center; gap: 32px; }
        .site-nav a {
            font-size: 13.5px; font-weight: 500; color: var(--clr-mid);
            text-decoration: none; transition: color .2s;
        }
        .site-nav a:hover { color: var(--clr-blue); }
        .nav-divider { width: 1px; height: 20px; background: var(--clr-line); }

        .btn {
            display: inline-flex; align-items: center; justify-content: center; gap: 8px;
            font-family: inherit; font-weight: 600; font-size: 13.5px;
            border-radius: var(--radius-md); cursor: pointer;
            text-decoration: none; border: none; transition: all .2s;
        }
        .btn-primary {
            background: var(--clr-blue); color: #fff;
            padding: 10px 20px;
        }
        .btn-primary:hover { background: var(--clr-blue-dk); box-shadow: 0 4px 16px rgba(19,147,204,.28); transform: translateY(-1px); }
        .btn-lg { padding: 14px 28px; font-size: 14.5px; border-radius: var(--radius-md); }
        .btn-outline-lg {
            background: transparent; color: var(--clr-blue);
            border: 1.5px solid var(--clr-blue);
            padding: 13px 28px; font-size: 14.5px;
            border-radius: var(--radius-md);
        }
        .btn-outline-lg:hover { background: var(--clr-blue); color: #fff; transform: translateY(-1px); }

        .mobile-toggle {
            display: none; background: none; border: none; cursor: pointer; padding: 8px;
        }

        @media (max-width: 767px) {
            .site-nav, .nav-divider, #btn-nav { display: none; }
            .mobile-toggle { display: flex; flex-direction: column; gap: 5px; }
            .mobile-toggle span { display: block; width: 22px; height: 2px; background: var(--clr-ink); border-radius: 2px; }
        }

        /* ─── COLOR BAR ──────────────────────────────────────── */
        .color-bar { height: 3px; display: flex; }
        .color-bar span { flex: 1; }
        .color-bar span:nth-child(1) { background: var(--clr-blue); }
        .color-bar span:nth-child(2) { background: var(--clr-yellow); }
        .color-bar span:nth-child(3) { background: var(--clr-green); }

        /* ─── HERO ───────────────────────────────────────────── */
        .hero {
            padding: 96px 0 80px;
            background: var(--clr-white);
            overflow: hidden;
            position: relative;
        }
        .hero::before {
            content: '';
            position: absolute; inset: 0;
            background: radial-gradient(ellipse 800px 600px at 70% 50%, rgba(19,147,204,.05) 0%, transparent 70%);
            pointer-events: none;
        }
        .hero-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 64px;
            align-items: center;
        }
        @media (max-width: 1023px) {
            .hero-grid { grid-template-columns: 1fr; gap: 48px; }
            .hero-visual { display: none; }
        }

        .hero-eyebrow { margin-bottom: 20px; }
        .hero-heading {
            font-size: clamp(34px, 4vw, 52px);
            font-weight: 800;
            line-height: 1.12;
            letter-spacing: -.03em;
            color: var(--clr-ink);
            margin-bottom: 20px;
        }
        .hero-heading .accent { color: var(--clr-blue); display: block; }
        .hero-sub {
            font-size: 16px; font-weight: 400; line-height: 1.75;
            color: var(--clr-mid); max-width: 480px; margin-bottom: 36px;
        }
        .hero-actions { display: flex; align-items: center; gap: 12px; flex-wrap: wrap; }

        .hero-trust {
            display: flex; align-items: center; gap: 16px; margin-top: 48px;
            padding-top: 36px; border-top: 1px solid var(--clr-line);
        }
        .trust-item { display: flex; flex-direction: column; }
        .trust-num {
            font-size: 24px; font-weight: 800; color: var(--clr-ink);
            font-family: 'DM Mono', monospace; line-height: 1;
        }
        .trust-num .unit { font-size: 16px; color: var(--clr-blue); }
        .trust-label { font-size: 11px; font-weight: 500; color: var(--clr-muted); margin-top: 4px; text-transform: uppercase; letter-spacing: .08em; }
        .trust-sep { width: 1px; height: 40px; background: var(--clr-line); }

        /* ─── HERO VISUAL ────────────────────────────────────── */
        .hero-visual { position: relative; height: 480px; }
        .vis-card {
            position: absolute; background: var(--clr-white);
            border: 1px solid var(--clr-line);
            border-radius: var(--radius-lg);
            box-shadow: 0 8px 32px rgba(0,0,0,.08);
            padding: 20px 24px;
        }
        .vis-main {
            inset: 0; display: flex; flex-direction: column;
            background: linear-gradient(145deg, #EDF6FB 0%, #F6F9FC 100%);
            border: 1px solid #D2E8F2;
        }
        .vis-header {
            display: flex; align-items: center; justify-content: space-between;
            margin-bottom: 24px;
        }
        .vis-dots { display: flex; gap: 6px; }
        .vis-dots span { width: 10px; height: 10px; border-radius: 50%; }
        .vis-dots span:nth-child(1) { background: #FFB3AE; }
        .vis-dots span:nth-child(2) { background: #FFD67A; }
        .vis-dots span:nth-child(3) { background: #76D59F; }
        .vis-title { font-size: 11px; font-weight: 600; color: var(--clr-mid); letter-spacing: .06em; text-transform: uppercase; }
        .vis-map {
            flex: 1; background: var(--clr-white);
            border-radius: var(--radius-md); border: 1px solid var(--clr-line);
            overflow: hidden; position: relative;
        }
        .vis-map svg { width: 100%; height: 100%; }

        .vis-badge {
            bottom: 24px; right: -16px;
            padding: 14px 18px; border-radius: var(--radius-lg);
            display: flex; align-items: center; gap: 12px;
            box-shadow: 0 12px 40px rgba(0,0,0,.12);
        }
        .badge-icon {
            width: 40px; height: 40px; border-radius: var(--radius-md);
            background: var(--clr-blue); display: flex; align-items: center; justify-content: center;
        }
        .badge-icon svg { width: 18px; height: 18px; stroke: #fff; fill: none; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; }
        .badge-text strong { display: block; font-size: 14px; font-weight: 700; color: var(--clr-ink); }
        .badge-text span { font-size: 11px; color: var(--clr-muted); }

        .vis-pill {
            top: 32px; right: -24px;
            padding: 10px 16px; border-radius: 100px;
            display: flex; align-items: center; gap: 8px;
            font-size: 12px; font-weight: 600;
            box-shadow: 0 6px 20px rgba(0,0,0,.1);
        }
        .status-dot { width: 8px; height: 8px; border-radius: 50%; background: var(--clr-green); animation: pulse 2s infinite; }
        @keyframes pulse { 0%,100% { opacity: 1; } 50% { opacity: .4; } }

        /* ─── STATS BAND ─────────────────────────────────────── */
        .stats-band {
            background: var(--clr-ink); padding: 28px 0;
        }
        .stats-inner {
            display: grid; grid-template-columns: repeat(4, 1fr);
            gap: 0; divide: var(--clr-line);
        }
        @media (max-width: 767px) { .stats-inner { grid-template-columns: repeat(2,1fr); } }
        .stat-item {
            padding: 16px 32px; text-align: center;
            border-right: 1px solid rgba(255,255,255,.1);
        }
        .stat-item:last-child { border-right: none; }
        .stat-num {
            font-size: 28px; font-weight: 800; color: #fff;
            font-family: 'DM Mono', monospace; line-height: 1;
        }
        .stat-num sup { font-size: 16px; color: var(--clr-blue); vertical-align: super; }
        .stat-num sub { font-size: 14px; color: var(--clr-yellow); }
        .stat-label { font-size: 11px; font-weight: 500; color: rgba(255,255,255,.45); margin-top: 6px; text-transform: uppercase; letter-spacing: .08em; }

        /* ─── SECTION SHARED ─────────────────────────────────── */
        .section { padding: 96px 0; }
        .section-header { text-align: center; max-width: 560px; margin: 0 auto 64px; }
        .section-title { font-size: clamp(26px, 3vw, 36px); font-weight: 800; letter-spacing: -.03em; color: var(--clr-ink); margin: 12px 0 16px; }
        .section-sub { font-size: 15px; color: var(--clr-mid); line-height: 1.7; }

        /* ─── SERVICES ───────────────────────────────────────── */
        .services { background: var(--clr-surface); }
        .services-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }
        @media (max-width: 1023px) { .services-grid { grid-template-columns: repeat(2,1fr); } }
        @media (max-width: 639px)  { .services-grid { grid-template-columns: 1fr; } }

        .service-card {
            background: var(--clr-white);
            border: 1px solid var(--clr-line);
            border-radius: var(--radius-lg);
            padding: 32px;
            text-decoration: none;
            display: flex; flex-direction: column;
            transition: all .25s;
            position: relative; overflow: hidden;
        }
        .service-card::after {
            content: ''; position: absolute; bottom: 0; left: 0; right: 0;
            height: 3px; transform: scaleX(0);
            transform-origin: left; transition: transform .3s;
        }
        .service-card.blue::after  { background: var(--clr-blue); }
        .service-card.green::after { background: var(--clr-green); }
        .service-card.yellow::after { background: var(--clr-yellow); }

        .service-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 40px rgba(0,0,0,.09);
            border-color: transparent;
        }
        .service-card:hover::after { transform: scaleX(1); }

        .card-num {
            font-family: 'DM Mono', monospace;
            font-size: 11px; font-weight: 500; color: var(--clr-muted);
            letter-spacing: .1em; margin-bottom: 20px;
        }
        .card-icon {
            width: 48px; height: 48px; border-radius: var(--radius-md);
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 20px; transition: all .25s;
        }
        .card-icon svg { width: 22px; height: 22px; stroke-width: 1.75; stroke-linecap: round; stroke-linejoin: round; fill: none; }
        .service-card.blue  .card-icon { background: var(--clr-blue-lt); }
        .service-card.blue  .card-icon svg { stroke: var(--clr-blue); }
        .service-card.green .card-icon { background: rgba(149,185,62,.12); }
        .service-card.green .card-icon svg { stroke: var(--clr-green); }
        .service-card.yellow .card-icon { background: rgba(242,204,5,.12); }
        .service-card.yellow .card-icon svg { stroke: #B8990A; }

        .service-card:hover .card-icon { transform: scale(1.08); }

        .card-title { font-size: 17px; font-weight: 700; color: var(--clr-ink); margin-bottom: 10px; letter-spacing: -.01em; }
        .card-desc  { font-size: 13.5px; color: var(--clr-mid); line-height: 1.65; flex: 1; margin-bottom: 24px; }

        .card-cta {
            display: flex; align-items: center; gap: 6px;
            font-size: 13px; font-weight: 700; text-decoration: none;
        }
        .service-card.blue  .card-cta { color: var(--clr-blue); }
        .service-card.green .card-cta { color: var(--clr-green); }
        .service-card.yellow .card-cta { color: #B8990A; }
        .card-cta svg { width: 14px; height: 14px; stroke: currentColor; fill: none; stroke-width: 2.5; stroke-linecap: round; stroke-linejoin: round; transition: transform .2s; }
        .service-card:hover .card-cta svg { transform: translateX(4px); }

        .services-last-row {
            grid-column: 1 / -1;
            display: grid; grid-template-columns: repeat(2,1fr); gap: 20px;
        }
        @media (max-width: 639px) { .services-last-row { grid-template-columns: 1fr; } }

        /* ─── PROCESS ────────────────────────────────────────── */
        .process { background: var(--clr-white); }
        .process-steps {
            display: grid; grid-template-columns: repeat(4, 1fr); gap: 32px;
            position: relative;
        }
        .process-steps::before {
            content: ''; position: absolute;
            top: 28px; left: calc(12.5% + 24px); right: calc(12.5% + 24px);
            height: 1px; background: var(--clr-line);
            z-index: 0;
        }
        @media (max-width: 767px) {
            .process-steps { grid-template-columns: 1fr 1fr; }
            .process-steps::before { display: none; }
        }
        @media (max-width: 479px) { .process-steps { grid-template-columns: 1fr; } }

        .process-step { text-align: center; position: relative; z-index: 1; }
        .step-num {
            width: 56px; height: 56px; border-radius: 50%;
            background: var(--clr-white); border: 2px solid var(--clr-line);
            margin: 0 auto 20px;
            display: flex; align-items: center; justify-content: center;
            font-family: 'DM Mono', monospace; font-size: 16px; font-weight: 500;
            color: var(--clr-muted); transition: all .3s;
        }
        .process-step.active .step-num {
            background: var(--clr-blue); border-color: var(--clr-blue);
            color: #fff;
            box-shadow: 0 4px 16px rgba(19,147,204,.3);
        }
        .step-title { font-size: 15px; font-weight: 700; color: var(--clr-ink); margin-bottom: 8px; }
        .step-desc { font-size: 13px; color: var(--clr-mid); line-height: 1.6; }

        /* ─── CTA BAND ───────────────────────────────────────── */
        .cta-band {
            background: var(--clr-ink);
            padding: 72px 0;
            position: relative; overflow: hidden;
        }
        .cta-band::before {
            content: ''; position: absolute;
            top: -120px; right: -80px;
            width: 480px; height: 480px; border-radius: 50%;
            background: radial-gradient(circle, rgba(19,147,204,.15) 0%, transparent 70%);
            pointer-events: none;
        }
        .cta-band::after {
            content: ''; position: absolute;
            bottom: -100px; left: 15%;
            width: 320px; height: 320px; border-radius: 50%;
            background: radial-gradient(circle, rgba(242,204,5,.08) 0%, transparent 70%);
            pointer-events: none;
        }
        .cta-inner {
            display: flex; align-items: center; justify-content: space-between; gap: 32px;
            position: relative; z-index: 1;
        }
        @media (max-width: 767px) { .cta-inner { flex-direction: column; text-align: center; } }
        .cta-heading { font-size: 30px; font-weight: 800; color: #fff; letter-spacing: -.03em; line-height: 1.2; }
        .cta-sub { font-size: 14.5px; color: rgba(255,255,255,.5); margin-top: 10px; max-width: 400px; }
        .btn-cta {
            background: var(--clr-blue); color: #fff;
            padding: 15px 32px; border-radius: var(--radius-md);
            font-family: inherit; font-size: 14.5px; font-weight: 700;
            border: none; cursor: pointer; text-decoration: none;
            white-space: nowrap; transition: all .2s;
            display: inline-flex; align-items: center; gap: 8px;
        }
        .btn-cta:hover { background: var(--clr-blue-dk); box-shadow: 0 8px 24px rgba(19,147,204,.4); transform: translateY(-1px); }
        .btn-cta svg { width: 16px; height: 16px; stroke: #fff; fill: none; stroke-width: 2.5; stroke-linecap: round; stroke-linejoin: round; }

        /* ─── FOOTER ─────────────────────────────────────────── */
        .site-footer {
            background: #0B1420; padding: 72px 0 32px;
        }
        .footer-grid {
            display: grid; grid-template-columns: 1.4fr 1fr 1fr 1fr; gap: 48px;
            padding-bottom: 56px; border-bottom: 1px solid rgba(255,255,255,.08);
        }
        @media (max-width: 1023px) { .footer-grid { grid-template-columns: 1fr 1fr; gap: 32px; } }
        @media (max-width: 639px)  { .footer-grid { grid-template-columns: 1fr; } }

        .footer-brand .logo-text strong { color: #fff; }
        .footer-brand .logo-text span   { color: rgba(255,255,255,.3); }
        .footer-desc { font-size: 13.5px; color: rgba(255,255,255,.38); line-height: 1.75; margin-top: 16px; }
        .footer-badges { display: flex; gap: 8px; margin-top: 24px; }
        .f-badge {
            font-size: 10px; font-weight: 700; letter-spacing: .08em;
            text-transform: uppercase; padding: 4px 10px;
            border-radius: 4px; border: 1px solid rgba(255,255,255,.12);
            color: rgba(255,255,255,.35);
        }

        .footer-col-title { font-size: 11px; font-weight: 700; color: rgba(255,255,255,.5); text-transform: uppercase; letter-spacing: .1em; margin-bottom: 20px; }
        .footer-links { list-style: none; display: flex; flex-direction: column; gap: 12px; }
        .footer-links a { font-size: 13.5px; color: rgba(255,255,255,.45); text-decoration: none; transition: color .2s; }
        .footer-links a:hover { color: rgba(255,255,255,.9); }

        .footer-contact-item { display: flex; align-items: flex-start; gap: 10px; margin-bottom: 14px; }
        .contact-icon { width: 32px; height: 32px; border-radius: var(--radius-sm); background: rgba(255,255,255,.06); display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .contact-icon svg { width: 15px; height: 15px; stroke: var(--clr-blue); fill: none; stroke-width: 1.75; stroke-linecap: round; stroke-linejoin: round; }
        .contact-text { font-size: 13px; color: rgba(255,255,255,.45); line-height: 1.55; }

        .footer-bottom {
            padding-top: 28px;
            display: flex; align-items: center; justify-content: space-between; gap: 16px;
            flex-wrap: wrap;
        }
        .footer-copy { font-size: 12.5px; color: rgba(255,255,255,.25); }
        .footer-legal { display: flex; gap: 20px; }
        .footer-legal a { font-size: 12.5px; color: rgba(255,255,255,.25); text-decoration: none; transition: color .2s; }
        .footer-legal a:hover { color: rgba(255,255,255,.6); }

        /* ─── TESTIMONIAL / REVIEWS SECTION ────────────────── */
        .reviews-section {
            padding: 80px 0;
            background: #FFFFFF;
            border-top: 1px solid var(--clr-line);
        }
        .reviews-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
            margin-top: 40px;
        }
        @media (max-width: 1023px) {
            .reviews-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        @media (max-width: 639px) {
            .reviews-grid {
                grid-template-columns: 1fr;
            }
        }
        .review-card {
            background: #F8FAFC;
            border: 1.5px solid var(--clr-line);
            border-radius: var(--radius-lg);
            padding: 28px;
            transition: all .3s ease;
            position: relative;
        }
        .review-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 28px rgba(19, 147, 204, 0.08);
            border-color: var(--clr-blue);
        }
        .review-card-stars {
            color: #D69E2E;
            font-size: 16px;
            margin-bottom: 12px;
            font-weight: 700;
        }
        .review-card-label {
            font-size: 12.5px;
            font-weight: 800;
            color: var(--clr-ink);
            margin-left: 6px;
        }
        .review-card-comment {
            font-size: 13.5px;
            color: var(--clr-mid);
            line-height: 1.6;
            font-style: italic;
            margin-bottom: 20px;
        }
        .review-card-author {
            display: flex;
            align-items: center;
            gap: 12px;
            border-top: 1px solid var(--clr-line);
            padding-top: 16px;
        }
        .review-author-avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: var(--clr-blue-lt);
            color: var(--clr-blue);
            font-weight: 700;
            font-size: 13px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-transform: uppercase;
            border: 1.5px solid var(--clr-blue);
        }
        .review-author-info strong {
            display: block;
            font-size: 13px;
            color: var(--clr-ink);
            font-weight: 700;
        }
        .review-author-info span {
            display: block;
            font-size: 11px;
            color: var(--clr-muted);
            font-weight: 600;
        }
        .review-card-module {
            display: inline-block;
            background: rgba(19, 147, 204, 0.06);
            color: var(--clr-blue-dk);
            font-size: 10px;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 4px;
            margin-top: 4px;
            text-transform: uppercase;
            letter-spacing: 0.03em;
        }
 
        /* ─── REVEAL ANIMATION ───────────────────────────────── */
        .reveal {
            opacity: 0; transform: translateY(24px);
            transition: opacity .6s ease, transform .6s ease;
        }
        .reveal.visible { opacity: 1; transform: translateY(0); }
        .reveal-delay-1 { transition-delay: .1s; }
        .reveal-delay-2 { transition-delay: .2s; }
        .reveal-delay-3 { transition-delay: .3s; }
        .reveal-delay-4 { transition-delay: .4s; }
    </style>
</head>
<body>

<!-- ═══════════════════════════════════════ HEADER ══ -->
<header id="site-header">
    <div class="container">
        <div class="header-inner">
            <a href="/" class="logo-wrap" aria-label="PATENPAKMIKO Beranda">
                <div class="logo-icon">
                    <svg viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                </div>
                <div class="logo-text">
                    <strong>PATENPAKMIKO</strong>
                    <span>Badan Pertanahan Nasional</span>
                </div>
            </a>

            <nav class="site-nav" aria-label="Navigasi Utama">
                <a href="#">Beranda</a>
                <a href="#modul">Layanan</a>
                <a href="#alur">Alur Proses</a>
                <a href="#">Panduan</a>
                <a href="#">Kontak</a>
                <div class="nav-divider" aria-hidden="true"></div>
                <a href="{{ route('login') }}" class="btn btn-primary">Masuk Portal</a>
            </nav>

            <button class="mobile-toggle" aria-label="Buka Menu" id="menu-toggle">
                <span></span><span></span><span></span>
            </button>
        </div>
    </div>
    <div class="color-bar" aria-hidden="true"><span></span><span></span><span></span></div>
</header>

<!-- ═══════════════════════════════════════ HERO ═══ -->
<section class="hero" aria-label="Beranda">
    <div class="container">
        <div class="hero-grid">

            <!-- Left -->
            <div>
                <div class="hero-eyebrow">
                    <span class="label-tag">
                        <svg width="10" height="10" viewBox="0 0 10 10" fill="none" aria-hidden="true"><circle cx="5" cy="5" r="4" fill="#1393CC" opacity=".3"/><circle cx="5" cy="5" r="2.5" fill="#1393CC"/></svg>
                        Portal Pelayanan Terpadu ATR/BPN
                    </span>
                </div>
                <h1 class="hero-heading">
                    Persetujuan Kesesuaian
                    <span class="accent">Kegiatan Pemanfaatan Ruang</span>
                </h1>
                <p class="hero-sub">
                    Sistem informasi tata ruang dan pertanahan yang profesional, transparan, dan terintegrasi — mempercepat proses pengajuan izin pemanfaatan ruang secara digital.
                </p>
                <div class="hero-actions">
                    <a href="#modul" class="btn btn-primary btn-lg">
                        Lihat Modul Layanan
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </a>
                    <a href="#" class="btn-outline-lg btn">Pelajari Panduan</a>
                </div>

                <div class="hero-trust">
                    <div class="trust-item">
                        <span class="trust-num">5<span class="unit">+</span></span>
                        <span class="trust-label">Modul Layanan</span>
                    </div>
                    <div class="trust-sep" aria-hidden="true"></div>
                    <div class="trust-item">
                        <span class="trust-num">100<span class="unit">%</span></span>
                        <span class="trust-label">Berbasis Digital</span>
                    </div>
                    <div class="trust-sep" aria-hidden="true"></div>
                    <div class="trust-item">
                        <span class="trust-num">1<span class="unit"> Pintu</span></span>
                        <span class="trust-label">Integrasi Instansi</span>
                    </div>
                </div>
            </div>

            <!-- Right — Abstract dashboard visual -->
            <div class="hero-visual" aria-hidden="true">
                <div class="vis-card vis-main">
                    <div class="vis-header">
                        <div class="vis-dots">
                            <span></span><span></span><span></span>
                        </div>
                        <span class="vis-title">Peta Tata Ruang — Gistaru</span>
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="var(--clr-muted)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                    </div>
                    <div class="vis-map">
                        <svg viewBox="0 0 420 240" preserveAspectRatio="xMidYMid slice" xmlns="http://www.w3.org/2000/svg">
                            <!-- Grid lines -->
                            <defs>
                                <pattern id="grid" width="30" height="30" patternUnits="userSpaceOnUse">
                                    <path d="M 30 0 L 0 0 0 30" fill="none" stroke="#E8EEF4" stroke-width=".5"/>
                                </pattern>
                            </defs>
                            <rect width="420" height="240" fill="#F6F9FC"/>
                            <rect width="420" height="240" fill="url(#grid)"/>
                            <!-- Zone polygons -->
                            <polygon points="40,40 120,30 150,90 100,110 50,95" fill="rgba(19,147,204,.12)" stroke="#1393CC" stroke-width="1.5"/>
                            <polygon points="160,25 240,20 260,75 200,95 150,70" fill="rgba(149,185,62,.12)" stroke="#95B93E" stroke-width="1.5"/>
                            <polygon points="100,120 180,110 200,165 140,185 90,165" fill="rgba(242,204,5,.1)" stroke="#F2CC05" stroke-width="1.5"/>
                            <polygon points="210,90 300,80 330,140 270,160 210,145" fill="rgba(19,147,204,.08)" stroke="#1393CC" stroke-width="1" stroke-dasharray="4,3"/>
                            <polygon points="280,30 380,25 390,80 340,100 270,75" fill="rgba(149,185,62,.08)" stroke="#95B93E" stroke-width="1" stroke-dasharray="4,3"/>
                            <!-- Roads -->
                            <line x1="0" y1="100" x2="420" y2="95" stroke="#CBD5E1" stroke-width="4" stroke-linecap="round"/>
                            <line x1="200" y1="0" x2="195" y2="240" stroke="#CBD5E1" stroke-width="4" stroke-linecap="round"/>
                            <!-- Points of interest -->
                            <circle cx="85" cy="70" r="5" fill="#1393CC"/>
                            <circle cx="85" cy="70" r="10" fill="rgba(19,147,204,.2)"/>
                            <circle cx="195" cy="50" r="4" fill="#95B93E"/>
                            <circle cx="195" cy="50" r="8" fill="rgba(149,185,62,.2)"/>
                            <circle cx="135" cy="145" r="4" fill="#F2CC05"/>
                            <circle cx="135" cy="145" r="8" fill="rgba(242,204,5,.2)"/>
                            <!-- Legend -->
                            <rect x="10" y="200" width="10" height="10" rx="2" fill="rgba(19,147,204,.6)"/>
                            <text x="25" y="209" font-family="system-ui" font-size="9" fill="#94A3B8">Perumahan</text>
                            <rect x="90" y="200" width="10" height="10" rx="2" fill="rgba(149,185,62,.6)"/>
                            <text x="105" y="209" font-family="system-ui" font-size="9" fill="#94A3B8">Pertanian</text>
                            <rect x="165" y="200" width="10" height="10" rx="2" fill="rgba(242,204,5,.6)"/>
                            <text x="180" y="209" font-family="system-ui" font-size="9" fill="#94A3B8">Komersial</text>
                        </svg>
                    </div>
                </div>
                <!-- Floating badge -->
                <div class="vis-card vis-badge">
                    <div class="badge-icon">
                        <svg viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    </div>
                    <div class="badge-text">
                        <strong>Verifikasi Selesai</strong>
                        <span>PPKPR-2026-0421 · 14:32 WIB</span>
                    </div>
                </div>
                <!-- Online pill -->
                <div class="vis-card vis-pill">
                    <span class="status-dot" aria-hidden="true"></span>
                    <span style="font-size:12px; font-weight:600; color: var(--clr-ink)">Sistem Online</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════ STATS ══ -->
<div class="stats-band" role="region" aria-label="Statistik Layanan">
    <div class="container">
        <div class="stats-inner">
            <div class="stat-item">
                <div class="stat-num">12<sub>k</sub></div>
                <div class="stat-label">Permohonan Diproses</div>
            </div>
            <div class="stat-item">
                <div class="stat-num">98<sup>%</sup></div>
                <div class="stat-label">Tingkat Kepuasan</div>
            </div>
            <div class="stat-item">
                <div class="stat-num">14</div>
                <div class="stat-label">Hari Rata-rata Selesai</div>
            </div>
            <div class="stat-item">
                <div class="stat-num">5</div>
                <div class="stat-label">Instansi Terintegrasi</div>
            </div>
        </div>
    </div>
</div>

<!-- ═══════════════════════════════════════ SERVICES ══ -->
<section id="modul" class="section services" aria-label="Modul Layanan">
    <div class="container">
        <div class="section-header reveal">
            <span class="label-tag">Modul Layanan</span>
            <h2 class="section-title">Pilih Jalur Permohonan</h2>
            <p class="section-sub">Setiap modul dirancang untuk peruntukan spesifik. Pilih jalur yang sesuai dengan jenis kegiatan pemanfaatan ruang Anda.</p>
        </div>

        <div class="services-grid">
            <!-- 1. LAPOR-PA -->
            <a href="#" class="service-card blue reveal reveal-delay-1">
                <span class="card-num">01 / KONSULTASI</span>
                <div class="card-icon">
                    <svg viewBox="0 0 24 24"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
                </div>
                <h3 class="card-title">LAPOR-PA</h3>
                <p class="card-desc">Layanan pelaporan dan penjadwalan audiensi atau konsultasi tatap muka langsung dengan petugas BPN terkait.</p>
                <span class="card-cta">
                    Ajukan Jadwal
                    <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </span>
            </a>

            <!-- 2. PPKPR Non Berusaha -->
            <a href="{{ route('dashboard') }}" class="service-card green reveal reveal-delay-2">
                <span class="card-num">02 / NON-BISNIS</span>
                <div class="card-icon">
                    <svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                </div>
                <h3 class="card-title">PPKPR Non Berusaha</h3>
                <p class="card-desc">Pengajuan kegiatan non-bisnis dengan validasi dokumen fisik secara luring di loket pelayanan BPN terdekat.</p>
                <span class="card-cta">
                    Mulai Proses
                    <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </span>
            </a>

            <!-- 3. PPKPR Berusaha -->
            <a href="#" class="service-card yellow reveal reveal-delay-3">
                <span class="card-num">03 / PERIZINAN BISNIS</span>
                <div class="card-icon">
                    <svg viewBox="0 0 24 24"><rect x="2" y="3" width="20" height="14" rx="2"/><path d="M8 21h8M12 17v4"/></svg>
                </div>
                <h3 class="card-title">PPKPR Berusaha</h3>
                <p class="card-desc">Jalur terpadu perizinan skala bisnis melibatkan BPN, Dinas PU, dan Dinas PTSP (1 Pintu) beserta cek spasial Gistaru.</p>
                <span class="card-cta">
                    Mulai Proses
                    <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </span>
            </a>
        </div>

        <!-- Row 2 (2 cards centered) -->
        <div class="services-last-row reveal reveal-delay-2" style="margin-top: 20px;">
            <!-- 4. Kebijakan -->
            <a href="#" class="service-card blue">
                <span class="card-num">04 / KEBIJAKAN KHUSUS</span>
                <div class="card-icon">
                    <svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><line x1="10" y1="9" x2="8" y2="9"/></svg>
                </div>
                <h3 class="card-title">Kebijakan</h3>
                <p class="card-desc">Permohonan khusus berbasis kebijakan pemerintah, diproses eksklusif melalui jalur validasi luring dengan pendampingan teknis.</p>
                <span class="card-cta">
                    Pelajari Ketentuan
                    <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </span>
            </a>

            <!-- 5. INFORMAL -->
            <a href="#" class="service-card green">
                <span class="card-num">05 / AKSES PUBLIK</span>
                <div class="card-icon">
                    <svg viewBox="0 0 24 24"><polygon points="3 6 9 3 15 6 21 3 21 18 15 21 9 18 3 21 3 6"/><line x1="9" y1="3" x2="9" y2="18"/><line x1="15" y1="6" x2="15" y2="21"/></svg>
                </div>
                <h3 class="card-title">INFORMAL</h3>
                <p class="card-desc">Akses cepat peta publik. Cek mandiri detail peruntukan dan zonasi wilayah secara interaktif — tanpa login diperlukan.</p>
                <span class="card-cta">
                    Akses Peta Publik
                    <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </span>
            </a>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════ PROCESS ══ -->
<section id="alur" class="section process" aria-label="Alur Proses">
    <div class="container">
        <div class="section-header reveal">
            <span class="label-tag">Alur Pelayanan</span>
            <h2 class="section-title">Proses Sederhana, Empat Tahap</h2>
            <p class="section-sub">Setiap permohonan mengikuti alur yang terstandarisasi untuk memastikan ketepatan dan transparansi proses.</p>
        </div>
        <div class="process-steps">
            <div class="process-step active reveal reveal-delay-1">
                <div class="step-num">01</div>
                <h3 class="step-title">Registrasi Akun</h3>
                <p class="step-desc">Buat akun terverifikasi menggunakan NIK dan data diri yang valid melalui portal PATENPAKMIKO.</p>
            </div>
            <div class="process-step reveal reveal-delay-2">
                <div class="step-num">02</div>
                <h3 class="step-title">Pilih Modul</h3>
                <p class="step-desc">Tentukan jenis permohonan sesuai peruntukan dan kriteria kegiatan pemanfaatan ruang Anda.</p>
            </div>
            <div class="process-step reveal reveal-delay-3">
                <div class="step-num">03</div>
                <h3 class="step-title">Unggah Dokumen</h3>
                <p class="step-desc">Lengkapi berkas persyaratan yang dibutuhkan dan unggah melalui sistem secara digital.</p>
            </div>
            <div class="process-step reveal reveal-delay-4">
                <div class="step-num">04</div>
                <h3 class="step-title">Terima Persetujuan</h3>
                <p class="step-desc">Pantau status permohonan secara real-time dan unduh sertifikat persetujuan resmi digital.</p>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════ REVIEWS ══ -->
<section class="reviews-section" id="ulasan" aria-label="Ulasan Layanan">
    <div class="container">
        <div style="text-align: center; max-width: 600px; margin: 0 auto 48px;">
            <span style="font-size: 11px; font-weight: 700; color: var(--clr-blue); letter-spacing: 0.1em; text-transform: uppercase;">Testimoni Pelaku Usaha</span>
            <h2 style="font-size: 28px; font-weight: 800; color: var(--clr-ink); margin-top: 8px; letter-spacing: -0.02em;">Apa Kata Mereka Tentang Kami?</h2>
            <p style="font-size: 14.5px; color: var(--clr-mid); margin-top: 10px;">Ulasan jujur dari para pelaku usaha mengenai kemudahan, transparansi, dan kecepatan proses perizinan PKKPR di PATENPAKMIKO.</p>
        </div>

        @if($reviews->isEmpty())
            <div style="text-align: center; padding: 48px; background: #F8FAFC; border: 1.5px dashed var(--clr-line); border-radius: var(--radius-lg); color: var(--clr-muted);">
                <p style="font-size: 14px; font-weight: 600;">Belum ada ulasan yang dipublikasikan saat ini.</p>
            </div>
        @else
            <div class="reviews-grid">
                @foreach($reviews as $review)
                    <div class="review-card reveal">
                        <div class="review-card-stars">
                            {{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5 - $review->rating) }}
                            <span class="review-card-label">{{ $review->rating_label }}</span>
                        </div>
                        <p class="review-card-comment">
                            "{{ $review->comment }}"
                        </p>
                        <div class="review-card-author">
                            <div class="review-author-avatar">
                                {{ strtoupper(substr($review->user->username ?? 'PU', 0, 2)) }}
                            </div>
                            <div class="review-author-info">
                                <strong>{{ $review->user->name ?? $review->user->username }}</strong>
                                <span>{{ $review->created_at->format('d M Y') }}</span>
                                <span class="review-card-module">{{ $review->module_label }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

<!-- ═══════════════════════════════════════ CTA ══ -->
<section class="cta-band" aria-label="Mulai Permohonan">
    <div class="container">
        <div class="cta-inner">
            <div class="reveal">
                <h2 class="cta-heading">Mulai Permohonan<br>Anda Hari Ini</h2>
                <p class="cta-sub">Daftarkan diri dan ajukan permohonan PKKPR secara digital. Cepat, transparan, dan terintegrasi.</p>
            </div>
            <div class="reveal reveal-delay-2" style="flex-shrink:0">
                <a href="#" class="btn-cta">
                    Daftar Sekarang
                    <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════ FOOTER ══ -->
<footer class="site-footer" aria-label="Footer">
    <div class="container">
        <div class="footer-grid">

            <!-- Brand -->
            <div class="footer-brand">
                <a href="/" class="logo-wrap" style="margin-bottom:0">
                    <div class="logo-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                    </div>
                    <div class="logo-text">
                        <strong>PATENPAKMIKO</strong>
                        <span>Badan Pertanahan Nasional</span>
                    </div>
                </a>
                <p class="footer-desc">Sistem Pelayanan Terpadu & Terintegrasi Persetujuan Kesesuaian Kegiatan Pemanfaatan Ruang, dedikasi untuk efisiensi birokrasi dan transparansi publik.</p>
                <div class="footer-badges">
                    <span class="f-badge">ATR / BPN</span>
                    <span class="f-badge">Gov 2026</span>
                    <span class="f-badge">ISO Verified</span>
                </div>
            </div>

            <!-- Links 1 -->
            <div>
                <h4 class="footer-col-title">Sistem</h4>
                <ul class="footer-links">
                    <li><a href="#">Tentang PATENPAKMIKO</a></li>
                    <li><a href="#">Panduan Registrasi</a></li>
                    <li><a href="#">Alur Pelayanan</a></li>
                    <li><a href="#">Integrasi Gistaru</a></li>
                    <li><a href="#">Pertanyaan Umum (FAQ)</a></li>
                </ul>
            </div>

            <!-- Links 2 -->
            <div>
                <h4 class="footer-col-title">Modul</h4>
                <ul class="footer-links">
                    <li><a href="#">LAPOR-PA</a></li>
                    <li><a href="#">PPKPR Non Berusaha</a></li>
                    <li><a href="#">PPKPR Berusaha</a></li>
                    <li><a href="#">Kebijakan Khusus</a></li>
                    <li><a href="#">Peta Publik (Informal)</a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div>
                <h4 class="footer-col-title">Hubungi Kami</h4>
                <div class="footer-contact-item">
                    <div class="contact-icon">
                        <svg viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    </div>
                    <span class="contact-text">Gedung Kementerian ATR/BPN,<br>Jakarta Selatan, DKI Jakarta</span>
                </div>
                <div class="footer-contact-item">
                    <div class="contact-icon">
                        <svg viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                    </div>
                    <span class="contact-text">support@patenpakmiko.go.id</span>
                </div>
                <div class="footer-contact-item">
                    <div class="contact-icon">
                        <svg viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81 19.79 19.79 0 01.01 1.18 2 2 0 012 0h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/></svg>
                    </div>
                    <span class="contact-text">1500-164 (Hotline Nasional)</span>
                </div>
            </div>
        </div>

        <!-- Bottom bar -->
        <div class="footer-bottom">
            <p class="footer-copy">&copy; 2026 Badan Pertanahan Nasional — Kementerian ATR/BPN Republik Indonesia. Seluruh hak cipta dilindungi.</p>
            <nav class="footer-legal" aria-label="Legal">
                <a href="#">Syarat &amp; Ketentuan</a>
                <a href="#">Kebijakan Privasi</a>
                <a href="#">Aksesibilitas</a>
            </nav>
        </div>
    </div>
</footer>

<script>
    // ── Sticky header shadow
    const header = document.getElementById('site-header');
    window.addEventListener('scroll', () => {
        header.classList.toggle('scrolled', window.scrollY > 20);
    }, { passive: true });

    // ── Scroll reveal
    const reveals = document.querySelectorAll('.reveal');
    const io = new IntersectionObserver((entries) => {
        entries.forEach(e => {
            if (e.isIntersecting) {
                e.target.classList.add('visible');
                io.unobserve(e.target);
            }
        });
    }, { threshold: 0.12 });
    reveals.forEach(el => io.observe(el));

    // ── Counter animation for stats
    function animateCount(el, target, suffix) {
        let start = 0;
        const dur = 1800;
        const step = (ts) => {
            if (!step.startTime) step.startTime = ts;
            const p = Math.min((ts - step.startTime) / dur, 1);
            const ease = 1 - Math.pow(1 - p, 3);
            const val = Math.round(ease * target);
            el.setAttribute('data-val', val + suffix);
            if (p < 1) requestAnimationFrame(step);
        };
        requestAnimationFrame(step);
    }

    // Smooth active step highlight on scroll
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