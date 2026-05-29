<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PATEN PAK MIKO — Persetujuan Kesesuaian Kegiatan Pemanfaatan Ruang</title>

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
            --ink:       #003B64;
            --mid:       #2C5272;
            --muted:     #7A9BB5;
            --line:      #D6E4EF;
            --surface:   #F0F6FB;
            --white:     #FFFFFF;
            --r-sm:  6px;
            --r-md:  10px;
            --r-lg:  16px;
            --r-xl:  24px;
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--white);
            color: var(--ink);
            -webkit-font-smoothing: antialiased;
            overflow-x: hidden;
        }

        .container { max-width: 1160px; margin: 0 auto; padding: 0 28px; }

        /* ─── HEADER ──────────────────────────────────────── */
        #site-header {
            position: sticky; top: 0; z-index: 100;
            background: rgba(255,255,255,.95);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--line);
            transition: box-shadow .3s;
        }
        #site-header.scrolled {
            box-shadow: 0 4px 32px rgba(0,59,100,.07);
        }
        .header-inner {
            display: flex; align-items: center; justify-content: space-between;
            height: 70px;
        }
        .logo-wrap {
            display: flex; align-items: center; gap: 12px; text-decoration: none;
        }
        .logo-icon {
            width: 38px; height: 38px; border-radius: var(--r-md);
            background: var(--blue-dk);
            display: flex; align-items: center; justify-content: center;
        }
        .logo-icon svg { width: 18px; height: 18px; fill: none; stroke: #fff; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; }
        .logo-text strong { display: block; font-size: 15px; font-weight: 800; color: var(--ink); letter-spacing: -.02em; }
        .logo-text span   { display: block; font-size: 9.5px; font-weight: 600; color: var(--muted); text-transform: uppercase; letter-spacing: .1em; margin-top: 2px; }

        .site-nav {
            display: flex; align-items: center; gap: 4px;
        }
        .nav-link {
            font-size: 13.5px; font-weight: 500; color: var(--mid);
            text-decoration: none; padding: 6px 12px;
            border-radius: var(--r-md); transition: all .18s;
        }
        .nav-link:hover { color: var(--blue); background: var(--blue-lt); }

        .nav-sep { width: 1px; height: 20px; background: var(--line); margin: 0 8px; }

        .btn-nav {
            display: inline-flex; align-items: center; gap: 7px;
            background: var(--blue-dk); color: #fff;
            padding: 9px 18px; border-radius: var(--r-md);
            font-family: inherit; font-size: 13px; font-weight: 700;
            text-decoration: none; border: none; cursor: pointer;
            transition: all .2s;
        }
        .btn-nav svg { width: 14px; height: 14px; fill: none; stroke: #fff; stroke-width: 2.5; stroke-linecap: round; stroke-linejoin: round; }
        .btn-nav:hover { background: var(--blue); box-shadow: 0 4px 20px rgba(33,138,201,.35); transform: translateY(-1px); }

        .color-bar { height: 3px; display: flex; }
        .color-bar span:nth-child(1) { flex: 3; background: var(--blue-dk); }
        .color-bar span:nth-child(2) { flex: 1; background: var(--yellow); }
        .color-bar span:nth-child(3) { flex: 1; background: var(--green); }

        /* ─── HERO ────────────────────────────────────────── */
        .hero {
            padding: 80px 0 0;
            background: var(--white);
            overflow: hidden;
            position: relative;
        }
        .hero-bg-shape {
            position: absolute;
            top: -80px; right: -120px;
            width: 700px; height: 700px;
            border-radius: 50%;
            background: radial-gradient(circle at 60% 40%, var(--blue-lt) 0%, transparent 70%);
            opacity: .55;
            pointer-events: none;
        }
        .hero-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 72px;
            align-items: center;
            position: relative;
            z-index: 1;
        }
        .hero-eyebrow {
            display: inline-flex; align-items: center; gap: 8px;
            font-size: 11px; font-weight: 700; letter-spacing: .1em;
            text-transform: uppercase; color: var(--blue);
            background: var(--blue-lt); border: 1px solid var(--blue-md);
            padding: 5px 12px; border-radius: 100px;
            margin-bottom: 24px;
        }
        .hero-eyebrow span { width: 6px; height: 6px; border-radius: 50%; background: var(--blue); }
        .hero-heading {
            font-size: clamp(32px, 3.8vw, 50px);
            font-weight: 800; line-height: 1.1;
            letter-spacing: -.03em; color: var(--ink);
            margin-bottom: 20px;
        }
        .hero-heading .line-accent {
            color: var(--blue);
            display: block;
            position: relative;
        }
        .hero-heading .line-accent::after {
            content: '';
            position: absolute; left: 0; bottom: -4px;
            height: 3px; width: 60%;
            background: var(--yellow);
            border-radius: 2px;
        }
        .hero-sub {
            font-size: 15.5px; line-height: 1.8; color: var(--mid);
            max-width: 460px; margin-bottom: 36px;
        }
        .hero-cta-row {
            display: flex; align-items: center; gap: 12px; flex-wrap: wrap;
            margin-bottom: 52px;
        }
        .btn-primary {
            display: inline-flex; align-items: center; gap: 8px;
            background: var(--blue-dk); color: #fff;
            padding: 13px 24px; border-radius: var(--r-md);
            font-family: inherit; font-size: 14px; font-weight: 700;
            text-decoration: none; border: none; cursor: pointer;
            transition: all .22s;
        }
        .btn-primary svg { width: 15px; height: 15px; fill: none; stroke: #fff; stroke-width: 2.5; stroke-linecap: round; stroke-linejoin: round; }
        .btn-primary:hover { background: var(--blue); box-shadow: 0 6px 24px rgba(33,138,201,.38); transform: translateY(-1px); }

        /* ─── HERO SERVICE BUTTONS ───────────────────────── */
        .hero-services {
            display: flex; flex-wrap: wrap; gap: 10px;
            margin-bottom: 36px;
        }
        .hs-btn {
            display: inline-flex; align-items: center; gap: 7px;
            padding: 10px 16px; border-radius: var(--r-md);
            font-family: inherit; font-size: 13px; font-weight: 700;
            text-decoration: none; border: 1.5px solid var(--line);
            background: var(--white); color: var(--ink);
            cursor: pointer; transition: all .2s; white-space: nowrap;
        }
        .hs-btn svg { width: 14px; height: 14px; fill: none; stroke: currentColor; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; flex-shrink:0; }
        .hs-btn:hover { border-color: var(--blue); color: var(--blue); background: var(--blue-lt); transform: translateY(-1px); }
        .hs-btn.hs-primary { background: var(--blue-dk); color: #fff; border-color: var(--blue-dk); }
        .hs-btn.hs-primary svg { stroke: #fff; }
        .hs-btn.hs-primary:hover { background: var(--blue); border-color: var(--blue); color: #fff; }
        .hs-btn.hs-muted { color: var(--muted); border-style: dashed; }
        .hs-btn.hs-muted:hover { border-color: var(--muted); color: var(--mid); background: var(--surface); }

        /* PKKPR Dropdown */
        .hs-dropdown { position: relative; display: inline-flex; }
        .hs-dropdown-menu {
            position: absolute; top: calc(100% + 8px); left: 0;
            background: var(--white); border: 1.5px solid var(--line);
            border-radius: var(--r-md); box-shadow: 0 12px 40px rgba(0,59,100,.12);
            min-width: 220px; display: none; flex-direction: column; z-index: 200;
            overflow: hidden; padding: 6px;
        }
        .hs-dropdown-menu a {
            display: flex; align-items: center; gap: 10px;
            padding: 10px 12px; text-decoration: none; font-size: 13px;
            font-weight: 600; color: var(--ink);
            border-radius: 6px; transition: all 0.18s;
        }
        .hs-dropdown-menu a:hover { background: var(--surface); color: var(--blue); }
        .hs-dropdown-menu .dd-num {
            width: 22px; height: 22px; border-radius: 6px; background: var(--blue-lt);
            color: var(--blue); font-size: 11px; font-weight: 700;
            display: flex; align-items: center; justify-content: center; flex-shrink:0;
        }
        .hs-dropdown-menu .dd-num.muted { background: var(--surface); color: var(--muted); }
        .hs-dropdown-menu .dd-badge {
            margin-left: auto; font-size: 10px; font-weight: 700;
            padding: 2px 7px; border-radius: 20px;
            background: var(--yellow-lt); color: var(--brown);
        }
        .hs-chevron { transition: transform .2s; }
        .hs-dropdown:hover .hs-chevron { transform: rotate(180deg); }
        .btn-outline {
            display: inline-flex; align-items: center; gap: 7px;
            background: transparent; color: var(--mid);
            padding: 12px 22px; border-radius: var(--r-md);
            font-family: inherit; font-size: 14px; font-weight: 600;
            text-decoration: none;
            border: 1.5px solid var(--line);
            cursor: pointer; transition: all .22s;
        }
        .btn-outline:hover { border-color: var(--blue); color: var(--blue); background: var(--blue-lt); }

        /* trust pills */
        .hero-trust {
            display: flex; align-items: center; gap: 0;
            padding: 18px 0;
            border-top: 1px solid var(--line);
        }
        .trust-item { display: flex; flex-direction: column; padding: 0 24px 0 0; }
        .trust-item:first-child { padding-left: 0; }
        .trust-num {
            font-size: 26px; font-weight: 800; color: var(--ink);
            font-family: 'DM Mono', monospace; line-height: 1;
            letter-spacing: -.03em;
        }
        .trust-num em { font-size: 16px; font-style: normal; color: var(--blue); }
        .trust-label { font-size: 11px; font-weight: 500; color: var(--muted); margin-top: 4px; text-transform: uppercase; letter-spacing: .07em; }
        .trust-sep { width: 1px; height: 36px; background: var(--line); margin-right: 24px; flex-shrink: 0; }

        /* ─── HERO VISUAL ─────────────────────────────────── */
        .hero-visual {
            position: relative; height: 500px;
        }
        /* Main dashboard mockup card */
        .vis-shell {
            position: absolute; inset: 0;
            background: var(--surface);
            border: 1px solid var(--line);
            border-radius: var(--r-xl);
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0,59,100,.1), 0 2px 8px rgba(0,0,0,.04);
        }
        .vis-chrome {
            height: 40px;
            background: var(--white);
            border-bottom: 1px solid var(--line);
            display: flex; align-items: center; gap: 8px;
            padding: 0 16px;
        }
        .vis-dots { display: flex; gap: 5px; }
        .vis-dots span { width: 9px; height: 9px; border-radius: 50%; }
        .vis-dots span:nth-child(1) { background: #FFB3AE; }
        .vis-dots span:nth-child(2) { background: #FFD67A; }
        .vis-dots span:nth-child(3) { background: #76D59F; }
        .vis-url {
            flex: 1; height: 24px; background: var(--surface);
            border: 1px solid var(--line); border-radius: 6px;
            font-family: 'DM Mono', monospace; font-size: 10px;
            color: var(--muted); display: flex; align-items: center;
            padding: 0 10px;
        }
        .vis-body {
            display: grid; grid-template-columns: 56px 1fr; height: calc(100% - 40px);
        }
        /* mini sidebar */
        .vis-sidebar {
            background: var(--blue-dk);
            padding: 12px 8px;
            display: flex; flex-direction: column; gap: 4px;
        }
        .vis-sb-logo {
            width: 32px; height: 32px; border-radius: 8px;
            background: var(--blue); margin: 0 auto 10px;
            display: flex; align-items: center; justify-content: center;
        }
        .vis-sb-item {
            height: 28px; border-radius: 6px;
            background: rgba(255,255,255,.07);
            margin-bottom: 2px;
        }
        .vis-sb-item.active { background: var(--yellow); }
        /* mini content */
        .vis-content {
            padding: 14px;
            overflow: hidden;
        }
        .vis-welcome {
            background: var(--blue-dk);
            border-radius: 10px;
            height: 70px;
            margin-bottom: 12px;
            border-left: 4px solid var(--yellow);
            padding: 12px;
            display: flex; flex-direction: column; gap: 6px;
        }
        .vis-wl1 { height: 10px; width: 55%; background: rgba(255,255,255,.4); border-radius: 4px; }
        .vis-wl2 { height: 8px; width: 75%; background: rgba(255,255,255,.18); border-radius: 4px; }
        .vis-kpi-row {
            display: grid; grid-template-columns: repeat(4,1fr); gap: 8px;
            margin-bottom: 12px;
        }
        .vis-kpi {
            background: var(--white); border: 1px solid var(--line);
            border-radius: 8px; padding: 10px 8px;
            display: flex; flex-direction: column; gap: 5px;
        }
        .vis-kpi-bar { height: 7px; border-radius: 3px; }
        .vis-kpi-bar.b1 { background: var(--blue-lt); width: 70%; }
        .vis-kpi-bar.b2 { background: var(--yellow-lt); width: 50%; }
        .vis-kpi-bar.b3 { background: var(--green-lt); width: 85%; }
        .vis-kpi-bar.b4 { background: #FFF5F5; width: 30%; }
        .vis-kpi-num { height: 14px; width: 60%; background: var(--line); border-radius: 4px; }
        .vis-kpi-lbl { height: 6px; width: 80%; background: var(--surface); border-radius: 3px; }
        .vis-grid2 { display: grid; grid-template-columns: 1fr 100px; gap: 8px; }
        .vis-panel {
            background: var(--white); border: 1px solid var(--line);
            border-radius: 8px; overflow: hidden;
        }
        .vis-ph {
            height: 28px; background: var(--surface);
            border-bottom: 1px solid var(--line);
            display: flex; align-items: center; padding: 0 10px; gap: 6px;
        }
        .vis-ph-dot { width: 6px; height: 6px; border-radius: 50%; background: var(--blue-md); }
        .vis-ph-txt { height: 7px; width: 50%; background: var(--line); border-radius: 3px; }
        .vis-rows { padding: 8px; display: flex; flex-direction: column; gap: 5px; }
        .vis-row { height: 22px; border-radius: 5px; background: var(--surface); display: flex; align-items: center; padding: 0 8px; gap: 6px; }
        .vis-rdot { width: 6px; height: 6px; border-radius: 50%; flex-shrink: 0; }
        .vis-rtxt { height: 6px; flex: 1; background: var(--line); border-radius: 3px; }
        .vis-rbadge { height: 12px; width: 28px; border-radius: 10px; }

        /* Floating cards */
        .vis-float {
            position: absolute;
            background: var(--white);
            border: 1px solid var(--line);
            border-radius: var(--r-lg);
            box-shadow: 0 12px 40px rgba(0,0,0,.1);
            padding: 14px 16px;
        }
        .vis-float-check {
            right: -20px; bottom: 80px;
            display: flex; align-items: center; gap: 10px;
        }
        .fc-icon {
            width: 36px; height: 36px; border-radius: 10px;
            background: var(--green-lt); display: flex;
            align-items: center; justify-content: center; flex-shrink: 0;
        }
        .fc-icon svg { width: 17px; height: 17px; fill: none; stroke: var(--green-dk); stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; }
        .fc-text strong { display: block; font-size: 12px; font-weight: 700; color: var(--ink); }
        .fc-text span { font-size: 10.5px; color: var(--muted); }

        .vis-float-status {
            top: 40px; right: -28px;
            display: flex; align-items: center; gap: 8px;
        }
        .status-pulse {
            width: 8px; height: 8px; border-radius: 50%;
            background: var(--green); flex-shrink: 0;
            animation: pulse-dot 2s ease-in-out infinite;
        }
        @keyframes pulse-dot { 0%,100%{opacity:1;box-shadow:0 0 0 0 rgba(133,195,65,.4)} 50%{opacity:.8;box-shadow:0 0 0 6px rgba(133,195,65,0)} }
        .vis-float-status span { font-size: 11.5px; font-weight: 600; color: var(--ink); }

        /* ─── STATS BAND ──────────────────────────────────── */
        .stats-band {
            background: var(--blue-dk);
            padding: 0;
            margin-top: 72px;
            position: relative;
        }
        .stats-band::before {
            content: '';
            position: absolute; top: 0; left: 0; right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--blue) 60%, var(--yellow) 80%, var(--green) 100%);
        }
        .stats-inner {
            display: grid; grid-template-columns: repeat(4,1fr);
        }
        .stat-item {
            padding: 32px 28px; text-align: center;
            border-right: 1px solid rgba(255,255,255,.07);
            position: relative;
        }
        .stat-item:last-child { border-right: none; }
        .stat-icon {
            width: 36px; height: 36px; border-radius: 10px;
            background: rgba(255,255,255,.08);
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 12px;
        }
        .stat-icon svg { width: 17px; height: 17px; fill: none; stroke: var(--blue-md); stroke-width: 1.75; stroke-linecap: round; stroke-linejoin: round; }
        .stat-num {
            font-size: 30px; font-weight: 800; color: #fff;
            font-family: 'DM Mono', monospace; line-height: 1;
            letter-spacing: -.03em;
        }
        .stat-num em { font-style: normal; color: var(--yellow); }
        .stat-label { font-size: 11px; font-weight: 500; color: rgba(255,255,255,.38); margin-top: 6px; text-transform: uppercase; letter-spacing: .08em; }

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

        /* ─── SERVICES ────────────────────────────────────── */
        .services { background: var(--surface); }
        .services-wrap {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }
        .services-row2 {
            grid-column: 1 / -1;
            display: grid; grid-template-columns: 1fr 1fr; gap: 20px;
        }

        .svc-card {
            background: var(--white);
            border: 1px solid var(--line);
            border-radius: var(--r-lg);
            padding: 28px 24px;
            text-decoration: none;
            display: flex; flex-direction: column;
            position: relative; overflow: hidden;
            transition: all .25s;
        }
        .svc-card::before {
            content: '';
            position: absolute; bottom: 0; left: 0; right: 0;
            height: 3px; transform: scaleX(0);
            transform-origin: left; transition: transform .3s;
        }
        .svc-card.c-blue::before   { background: var(--blue); }
        .svc-card.c-green::before  { background: var(--green); }
        .svc-card.c-yellow::before { background: var(--yellow); }
        .svc-card.c-orange::before { background: var(--brown); }

        .svc-card:hover { transform: translateY(-4px); box-shadow: 0 16px 48px rgba(0,59,100,.1); border-color: transparent; }
        .svc-card:hover::before { transform: scaleX(1); }

        .svc-num {
            font-family: 'DM Mono', monospace;
            font-size: 10.5px; font-weight: 500; color: var(--muted);
            letter-spacing: .1em; margin-bottom: 18px;
        }
        .svc-icon {
            width: 46px; height: 46px; border-radius: var(--r-md);
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 18px; transition: transform .25s;
        }
        .svc-card:hover .svc-icon { transform: scale(1.08); }
        .svc-icon svg { width: 21px; height: 21px; fill: none; stroke: currentColor; stroke-width: 1.75; stroke-linecap: round; stroke-linejoin: round; }
        .svc-card.c-blue   .svc-icon { background: var(--blue-lt); color: var(--blue); }
        .svc-card.c-green  .svc-icon { background: var(--green-lt); color: var(--green-dk); }
        .svc-card.c-yellow .svc-icon { background: var(--yellow-lt); color: var(--brown); }
        .svc-card.c-orange .svc-icon { background: rgba(211,115,36,.1); color: var(--brown); }

        .svc-title { font-size: 16px; font-weight: 700; color: var(--ink); margin-bottom: 10px; }
        .svc-desc  { font-size: 13px; color: var(--mid); line-height: 1.65; flex: 1; margin-bottom: 20px; }
        .svc-cta {
            display: inline-flex; align-items: center; gap: 5px;
            font-size: 13px; font-weight: 700;
        }
        .svc-cta svg { width: 14px; height: 14px; fill: none; stroke: currentColor; stroke-width: 2.5; stroke-linecap: round; stroke-linejoin: round; transition: transform .2s; }
        .svc-card:hover .svc-cta svg { transform: translateX(4px); }
        .svc-card.c-blue   .svc-cta { color: var(--blue); }
        .svc-card.c-green  .svc-cta { color: var(--green-dk); }
        .svc-card.c-yellow .svc-cta { color: var(--brown); }
        .svc-card.c-orange .svc-cta { color: var(--brown); }

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
        .reviews-grid {
            display: grid; grid-template-columns: repeat(3,1fr); gap: 20px;
        }
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
        .review-text {
            font-size: 13.5px; color: var(--mid); line-height: 1.7;
            font-style: italic; flex: 1;
        }
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

        /* ─── ANIMATIONS ──────────────────────────────────── */
        .reveal { opacity: 0; transform: translateY(22px); transition: opacity .55s ease, transform .55s ease; }
        .reveal.visible { opacity: 1; transform: translateY(0); }
        .reveal-d1 { transition-delay: .1s; }
        .reveal-d2 { transition-delay: .2s; }
        .reveal-d3 { transition-delay: .3s; }
        .reveal-d4 { transition-delay: .4s; }

        /* ─── RESPONSIVE ──────────────────────────────────── */
        @media (max-width: 1023px) {
            .hero-grid { grid-template-columns: 1fr; gap: 36px; }
            .hero-visual { display: block; min-height: auto; }
            .stats-inner { grid-template-columns: repeat(2,1fr); }
            .stat-item:nth-child(2) { border-right: none; }
            .services-wrap { grid-template-columns: 1fr 1fr; }
            .process-track { grid-template-columns: 1fr 1fr; gap: 32px; }
            .process-track::before { display: none; }
            .reviews-grid { grid-template-columns: 1fr 1fr; }
            .footer-grid { grid-template-columns: 1fr 1fr; gap: 32px; }
            /* Rapikan card layanan di tablet */
            .hero-services { flex-wrap: wrap; }
            .hs-dropdown-menu { min-width: 200px; }
        }
        @media (max-width: 767px) {
            .site-nav .nav-link, .nav-sep { display: none; }
            .btn-nav { padding: 8px 14px; font-size: 12px; }
            .logo-text span { display: none; }
            .hero { padding-top: 40px; }
            .hero-title { font-size: 28px; }
            .hero-desc { font-size: 14px; }
            .hero-cta-row { flex-direction: column; width: 100%; gap: 12px; }
            .hero-cta-row .btn-primary, .hero-cta-row .btn-outline { width: 100%; justify-content: center; }
            .hero-trust { flex-wrap: wrap; gap: 16px; }
            .trust-sep { display: none; }
            .trust-item { padding-right: 12px; }
            .stats-band { padding: 32px 0; }
            .stats-inner { grid-template-columns: repeat(2,1fr); gap: 24px 16px; }
            .services-wrap { grid-template-columns: 1fr; }
            .services-row2 { grid-template-columns: 1fr; }
            .reviews-grid { grid-template-columns: 1fr; }
            .cta-inner { flex-direction: column; text-align: center; gap: 24px; }
            .process-track { grid-template-columns: 1fr; gap: 24px; }
            .process-step { padding: 0; border: none !important; }
            .footer-grid { grid-template-columns: 1fr; gap: 32px; }
            /* Hero mobile */
            .hero-services { gap: 8px; }
            .hs-btn { font-size: 12px; padding: 9px 12px; }
            .hero-visual { margin-top: 0; }
        }
    </style>
</head>
<body>

<!-- ══ HEADER ══════════════════════════════════════════════ -->
<header id="site-header">
    <div class="container">
        <div class="header-inner">
            <a href="/" class="logo-wrap">
                <div class="logo-logos" style="display: flex; align-items: center; gap: 8px;">
                    <img src="{{ asset('storage/logo/Logo_BPN.png') }}" alt="Logo BPN" style="height: 38px; object-fit: contain;">
                </div>
                <div class="logo-text">
                    <strong>PATEN PAK MIKO</strong>
                    <span>Kantor Pertanahan Sukabumi</span>
                </div>
            </a>

            <nav class="site-nav">
                <a href="#" class="nav-link">Beranda</a>
                <a href="#modul" class="nav-link">Layanan</a>
                <a href="#alur" class="nav-link">Alur Proses</a>
                <a href="#ulasan" class="nav-link">Ulasan</a>
                <div class="nav-sep"></div>
                <a href="{{ route('login') }}" class="btn-nav">
                    <svg viewBox="0 0 24 24"><path d="M15 3h4a2 2 0 012 2v14a2 2 0 01-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" y1="12" x2="3" y2="12"/></svg>
                    Masuk Portal
                </a>
            </nav>
        </div>
    </div>
    <div class="color-bar"><span></span><span></span><span></span></div>
</header>

<!-- ══ HERO ════════════════════════════════════════════════ -->
<section class="hero">
    <div class="hero-bg-shape"></div>
    <div class="container">
        <div class="hero-grid">

            <!-- Copy -->
            <div>
                <div class="hero-eyebrow">
                    <span></span>
                    Portal Pelayanan Terpadu ATR/BPN
                </div>
                <h1 class="hero-heading">
                    Persetujuan Kesesuaian
                    <span class="line-accent">Pemanfaatan Ruang</span>
                    yang Mudah & Transparan
                </h1>
                <p class="hero-sub">
                    Sistem informasi tata ruang dan pertanahan yang profesional, transparan, dan terintegrasi — mempercepat proses pengajuan izin pemanfaatan ruang secara digital.
                </p>
                <!-- GRID TOMBOL LAYANAN DI HERO (Poin 4) -->
                <div class="hero-services">

                    <!-- PKKPR Dropdown -->
                    <div class="hs-dropdown">
                        <button class="hs-btn hs-primary" type="button">
                            <svg viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                            Layanan PKKPR
                            <svg class="hs-chevron" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                        </button>
                        <div class="hs-dropdown-menu">
                            <a href="{{ route('login') }}">
                                <span class="dd-num">1</span>
                                Berusaha
                            </a>
                            <a href="{{ route('login') }}">
                                <span class="dd-num">2</span>
                                Non Berusaha
                            </a>
                            <a href="{{ route('login') }}">
                                <span class="dd-num">3</span>
                                Kebijakan
                            </a>
                            <a href="#">
                                <span class="dd-num muted">4</span>
                                PSN
                                <span class="dd-badge">Segera Hadir</span>
                            </a>
                            <a href="#">
                                <span class="dd-num muted">5</span>
                                Tanah Timbul
                                <span class="dd-badge">Segera Hadir</span>
                            </a>
                        </div>
                    </div>

                    <!-- LAPOLPA -->
                    <a href="{{ route('login') }}" class="hs-btn" style="padding-left: 8px;">
                        <img src="{{ asset('storage/logo/Dummy.jpg') }}" alt="Logo LAPOLPA" style="width: 22px; height: 22px; object-fit: cover; border-radius: 4px; flex-shrink: 0;">
                        LAPOLPA
                    </a>

                    <!-- Informal -->
                    <a href="{{ route('login') }}" class="hs-btn" style="padding-left: 8px;">
                        <img src="{{ asset('storage/logo/Dummy.jpg') }}" alt="Logo Informal" style="width: 22px; height: 22px; object-fit: cover; border-radius: 4px; flex-shrink: 0;">
                        Konsultasi Informal
                    </a>

                    <!-- Pelajari Alur -->
                    <a href="#alur" class="hs-btn hs-muted">
                        <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3"/></svg>
                        Alur Proses
                    </a>

                </div>
                <div class="hero-trust">
                    <div class="trust-item">
                        <span class="trust-num">5<em>+</em></span>
                        <span class="trust-label">Modul Layanan</span>
                    </div>
                    <div class="trust-sep"></div>
                    <div class="trust-item">
                        <span class="trust-num">100<em>%</em></span>
                        <span class="trust-label">Digital</span>
                    </div>
                    <div class="trust-sep"></div>
                    <div class="trust-item">
                        <span class="trust-num">1<em> Pintu</em></span>
                        <span class="trust-label">Integrasi</span>
                    </div>
                    <div class="trust-sep"></div>
                    <div class="trust-item">
                        <span class="trust-num">98<em>%</em></span>
                        <span class="trust-label">Kepuasan</span>
                    </div>
                </div>
            </div>

            <!-- Visual — Service Card Panel -->
            <div class="hero-visual" style="position:relative; height:auto; min-height:460px; display:flex; align-items:center;">


                <!-- Service Panel Card -->
                <div style="
                    width:100%; background:#fff;
                    border:1px solid var(--line); border-radius:var(--r-xl);
                    box-shadow: 0 20px 60px rgba(0,59,100,.1), 0 2px 8px rgba(0,0,0,.04);
                    overflow:hidden;
                ">
                    <!-- Header -->
                    <div style="background:var(--blue-dk); padding:18px 22px; display:flex; align-items:center; gap:10px;">
                        <div style="width:32px;height:32px;border-radius:8px;background:var(--blue);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                        </div>
                        <div>
                            <div style="font-size:13px;font-weight:800;color:#fff;letter-spacing:-.01em;">PATEN PAK MIKO</div>
                            <div style="font-size:10.5px;color:rgba(255,255,255,.5);font-weight:500;">Pilih modul layanan yang Anda butuhkan</div>
                        </div>
                    </div>

                    <!-- PKKPR Group -->
                    <div style="padding:16px 20px 8px;">
                        <div style="font-size:10px;font-weight:700;color:var(--muted);text-transform:uppercase;letter-spacing:.1em;margin-bottom:10px;">
                            Layanan PKKPR
                        </div>
                        <div style="display:flex;flex-direction:column;gap:6px;">

                            <!-- Berusaha -->
                            <a href="{{ route('login') }}" style="display:flex;align-items:center;gap:12px;padding:11px 14px;border-radius:var(--r-md);background:var(--surface);text-decoration:none;transition:all .2s;" onmouseover="this.style.background='var(--blue-lt)';this.style.borderColor='var(--blue)'" onmouseout="this.style.background='var(--surface)'">
                                <div style="width:34px;height:34px;border-radius:8px;background:var(--blue-dk);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                    <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2"/><path d="M8 21h8M12 17v4"/></svg>
                                </div>
                                <div style="flex:1;">
                                    <div style="font-size:13px;font-weight:700;color:var(--ink);">PKKPR Berusaha</div>
                                    <div style="font-size:11px;color:var(--muted);">Bisnis, usaha, industri</div>
                                </div>
                                <span style="background:var(--blue-lt);color:var(--blue);font-size:10px;font-weight:700;padding:2px 8px;border-radius:20px;">Daftar →</span>
                            </a>

                            <!-- Non Berusaha -->
                            <a href="{{ route('login') }}" style="display:flex;align-items:center;gap:12px;padding:11px 14px;border-radius:var(--r-md);background:var(--surface);text-decoration:none;transition:all .2s;" onmouseover="this.style.background='var(--green-lt)'" onmouseout="this.style.background='var(--surface)'">
                                <div style="width:34px;height:34px;border-radius:8px;background:var(--green-dk);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                    <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                                </div>
                                <div style="flex:1;">
                                    <div style="font-size:13px;font-weight:700;color:var(--ink);">PKKPR Non Berusaha</div>
                                    <div style="font-size:11px;color:var(--muted);">Rumah, sosial, keagamaan</div>
                                </div>
                                <span style="background:var(--green-lt);color:var(--green-dk);font-size:10px;font-weight:700;padding:2px 8px;border-radius:20px;">Daftar →</span>
                            </a>

                            <!-- Kebijakan -->
                            <a href="{{ route('login') }}" style="display:flex;align-items:center;gap:12px;padding:11px 14px;border-radius:var(--r-md);background:var(--surface);text-decoration:none;transition:all .2s;" onmouseover="this.style.background='#E8F4FF'" onmouseout="this.style.background='var(--surface)'">
                                <div style="width:34px;height:34px;border-radius:8px;background:var(--blue);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                    <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="2"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                                </div>
                                <div style="flex:1;">
                                    <div style="font-size:13px;font-weight:700;color:var(--ink);">Kebijakan Khusus</div>
                                    <div style="font-size:11px;color:var(--muted);">PSN, mandat kebijakan pemerintah</div>
                                </div>
                                <span style="background:var(--blue-lt);color:var(--blue);font-size:10px;font-weight:700;padding:2px 8px;border-radius:20px;">Daftar →</span>
                            </a>

                            <!-- PSN - Segera Hadir -->
                            <div style="display:flex;align-items:center;gap:12px;padding:11px 14px;border-radius:var(--r-md);background:var(--surface);opacity:.6;">
                                <div style="width:34px;height:34px;border-radius:8px;background:var(--line);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                    <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="var(--muted)" stroke-width="2"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
                                </div>
                                <div style="flex:1;">
                                    <div style="font-size:13px;font-weight:700;color:var(--muted);">PSN</div>
                                    <div style="font-size:11px;color:var(--muted);">Proyek Strategis Nasional</div>
                                </div>
                                <span style="background:var(--yellow-lt);color:var(--brown);font-size:10px;font-weight:700;padding:2px 8px;border-radius:20px;">Segera Hadir</span>
                            </div>

                            <!-- Tanah Timbul - Segera Hadir -->
                            <div style="display:flex;align-items:center;gap:12px;padding:11px 14px;border-radius:var(--r-md);background:var(--surface);opacity:.6;">
                                <div style="width:34px;height:34px;border-radius:8px;background:var(--line);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                    <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="var(--muted)" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                </div>
                                <div style="flex:1;">
                                    <div style="font-size:13px;font-weight:700;color:var(--muted);">Tanah Timbul</div>
                                    <div style="font-size:11px;color:var(--muted);">Reklamasi & tanah timbul</div>
                                </div>
                                <span style="background:var(--yellow-lt);color:var(--brown);font-size:10px;font-weight:700;padding:2px 8px;border-radius:20px;">Segera Hadir</span>
                            </div>

                        </div>
                    </div>

                    <!-- Other Services -->
                    <div style="padding:8px 20px 18px;">
                        <div style="font-size:10px;font-weight:700;color:var(--muted);text-transform:uppercase;letter-spacing:.1em;margin-bottom:10px;">Layanan Lainnya</div>
                        <div style="display:flex;gap:8px;">
                            <a href="{{ route('login') }}" style="flex:1;display:flex;align-items:center;gap:8px;padding:8px 10px;border-radius:var(--r-md);border:1.5px solid var(--line);text-decoration:none;transition:all .2s;" onmouseover="this.style.borderColor='var(--blue)';this.style.color='var(--blue)'" onmouseout="this.style.borderColor='var(--line)'">
                                <img src="{{ asset('storage/logo/Dummy.jpg') }}" alt="Logo LAPOLPA" style="width:20px;height:20px;object-fit:cover;border-radius:4px;flex-shrink:0;">
                                <span style="font-size:12px;font-weight:700;color:var(--ink);">LAPOLPA</span>
                            </a>
                            <a href="{{ route('login') }}" style="flex:1;display:flex;align-items:center;gap:8px;padding:8px 10px;border-radius:var(--r-md);border:1.5px solid var(--line);text-decoration:none;transition:all .2s;" onmouseover="this.style.borderColor='var(--blue)'" onmouseout="this.style.borderColor='var(--line)'">
                                <img src="{{ asset('storage/logo/Dummy.jpg') }}" alt="Logo Informal" style="width:20px;height:20px;object-fit:cover;border-radius:4px;flex-shrink:0;">
                                <span style="font-size:12px;font-weight:700;color:var(--ink);">Konsultasi</span>
                            </a>
                        </div>
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
            <div class="stat-item">
                <div class="stat-icon"><svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/></svg></div>
                <div class="stat-num">12<em>k</em></div>
                <div class="stat-label">Permohonan Diproses</div>
            </div>
            <div class="stat-item">
                <div class="stat-icon"><svg viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg></div>
                <div class="stat-num">98<em>%</em></div>
                <div class="stat-label">Tingkat Kepuasan</div>
            </div>
            <div class="stat-item">
                <div class="stat-icon"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg></div>
                <div class="stat-num">14<em> hari</em></div>
                <div class="stat-label">Rata-rata Penyelesaian</div>
            </div>
            <div class="stat-item">
                <div class="stat-icon"><svg viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18M9 21V9"/></svg></div>
                <div class="stat-num">5</div>
                <div class="stat-label">Instansi Terintegrasi</div>
            </div>
        </div>
    </div>
</div>

<!-- ══ SERVICES ════════════════════════════════════════════ -->
<section id="modul" class="section services">
    <div class="container">
        <div class="section-header section-header-center reveal">
            <div class="section-eyebrow">Modul Layanan</div>
            <h2 class="section-title">Pilih Jalur Permohonan</h2>
            <p class="section-sub">Setiap modul dirancang untuk peruntukan spesifik. Pilih jalur yang sesuai dengan jenis kegiatan pemanfaatan ruang Anda.</p>
        </div>

        <div class="services-wrap">
            <!-- Row 1 — 3 cards -->
            <a href="#" class="svc-card c-blue reveal reveal-d1">
                <span class="svc-num">01 / KONSULTASI</span>
                <div class="svc-icon">
                    <svg viewBox="0 0 24 24"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
                </div>
                <h3 class="svc-title">LAPOLPA</h3>
                <p class="svc-desc">Pemesanan jadwal konsultasi tatap muka dan pelaporan pemanfaatan ruang secara langsung dengan petugas BPN.</p>
                <span class="svc-cta">Ajukan Jadwal <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg></span>
            </a>

            <a href="{{ route('dashboard') }}" class="svc-card c-green reveal reveal-d2">
                <span class="svc-num">02 / NON-BISNIS</span>
                <div class="svc-icon">
                    <svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                </div>
                <h3 class="svc-title">PPKPR Non Berusaha</h3>
                <p class="svc-desc">Untuk rumah tinggal, keagamaan, sosial, fasilitas umum, dan kegiatan non-bisnis. Validasi dokumen di loket BPN terdekat.</p>
                <span class="svc-cta">Mulai Proses <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg></span>
            </a>

            <a href="{{ route('dashboard') }}" class="svc-card c-yellow reveal reveal-d3">
                <span class="svc-num">03 / PERIZINAN BISNIS</span>
                <div class="svc-icon">
                    <svg viewBox="0 0 24 24"><rect x="2" y="3" width="20" height="14" rx="2"/><path d="M8 21h8M12 17v4"/></svg>
                </div>
                <h3 class="svc-title">PPKPR Berusaha</h3>
                <p class="svc-desc">Jalur terpadu perizinan skala bisnis mikro, kecil, menengah, dan besar. Melibatkan BPN, Dinas PU, dan PTSP satu pintu.</p>
                <span class="svc-cta">Mulai Proses <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg></span>
            </a>

            <!-- Row 2 — 2 cards centered -->
            <div class="services-row2 reveal reveal-d2">
                <a href="{{ route('dashboard') }}" class="svc-card c-blue">
                    <span class="svc-num">04 / KEBIJAKAN KHUSUS</span>
                    <div class="svc-icon">
                        <svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                    </div>
                    <h3 class="svc-title">Kebijakan Khusus</h3>
                    <p class="svc-desc">Permohonan berbasis kebijakan pemerintah eksklusif, diproses melalui jalur validasi luring dengan pendampingan teknis.</p>
                    <span class="svc-cta">Pelajari Ketentuan <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg></span>
                </a>

                <a href="{{ route('informal.index') }}" class="svc-card c-green">
                    <span class="svc-num">05 / AKSES PUBLIK</span>
                    <div class="svc-icon">
                        <svg viewBox="0 0 24 24"><polygon points="3 6 9 3 15 6 21 3 21 18 15 21 9 18 3 21 3 6"/><line x1="9" y1="3" x2="9" y2="18"/><line x1="15" y1="6" x2="15" y2="21"/></svg>
                    </div>
                    <h3 class="svc-title">Peta Publik (Informal)</h3>
                    <p class="svc-desc">Akses mandiri peta peruntukan dan zonasi wilayah secara interaktif melalui integrasi Gistaru — tanpa login.</p>
                    <span class="svc-cta">Buka Peta <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg></span>
                </a>
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
                <h3 class="step-title">Registrasi Akun</h3>
                <p class="step-desc">Buat akun terverifikasi menggunakan NIK dan data diri valid melalui portal PATEN PAK MIKO.</p>
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
                <p class="step-desc">Pantau status secara real-time dan unduh sertifikat persetujuan resmi digital Anda.</p>
            </div>
        </div>
    </div>
</section>

<!-- ══ REVIEWS ══════════════════════════════════════════════ -->
<section id="ulasan" class="section reviews">
    <div class="container">
        <div class="section-header section-header-center reveal">
            <div class="section-eyebrow">Testimoni</div>
            <h2 class="section-title">Apa Kata Pelaku Usaha?</h2>
            <p class="section-sub">Ulasan jujur dari para pelaku usaha mengenai kemudahan, transparansi, dan kecepatan proses PKKPR di PATEN PAK MIKO.</p>
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
                            <div class="review-avatar">
                                {{ strtoupper(substr($review->user->username ?? 'PU', 0, 2)) }}
                            </div>
                            <div class="review-info">
                                <strong>{{ $review->user->name ?? $review->user->username }}</strong>
                                <span>{{ $review->created_at->format('d M Y') }}</span>
                                <span class="review-module">{{ $review->module_label }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

<!-- ══ CTA ══════════════════════════════════════════════════ -->
<section class="cta-band">
    <div class="cta-deco"></div>
    <div class="container">
        <div class="cta-inner">
            <div class="reveal">
                <h2 class="cta-heading">Mulai Permohonan Anda<br>Hari Ini</h2>
                <p class="cta-sub">Daftarkan diri dan ajukan permohonan PKKPR secara digital. Cepat, transparan, dan terintegrasi dengan sistem nasional ATR/BPN.</p>
            </div>
            <a href="{{ route('login') }}" class="btn-cta reveal reveal-d2">
                Daftar & Masuk Sekarang
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
                    <div class="logo-logos" style="display: flex; align-items: center; gap: 8px;">
                        <img src="{{ asset('storage/logo/Logo_BPN.png') }}" alt="Logo BPN" style="height: 38px; object-fit: contain;">
                    </div>
                    <div class="logo-text footer-logo-text">
                        <strong>PATEN PAK MIKO</strong>
                        <span>Kantor Pertanahan Sukabumi</span>
                    </div>
                </a>
                <p class="footer-desc">Sistem Pelayanan Terpadu & Terintegrasi Persetujuan Kesesuaian Kegiatan Pemanfaatan Ruang, dedikasi untuk efisiensi birokrasi dan transparansi publik.</p>
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
                    <li><a href="#">LAPOLPA</a></li>
                    <li><a href="#">PPKPR Non Berusaha</a></li>
                    <li><a href="#">PPKPR Berusaha</a></li>
                    <li><a href="#">Kebijakan Khusus</a></li>
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
    const header = document.getElementById('site-header');
    window.addEventListener('scroll', () => {
        header.classList.toggle('scrolled', window.scrollY > 20);
    }, { passive: true });

    const io = new IntersectionObserver((entries) => {
        entries.forEach(e => {
            if (e.isIntersecting) { e.target.classList.add('visible'); io.unobserve(e.target); }
        });
    }, { threshold: 0.1 });
    document.querySelectorAll('.reveal').forEach(el => io.observe(el));

    // Step highlight on scroll
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

    // ── PKKPR Dropdown Toggle ──────────────────────────────
    const pkkprBtn = document.querySelector('.hs-dropdown button');
    const pkkprMenu = document.querySelector('.hs-dropdown-menu');

    if (pkkprBtn && pkkprMenu) {
        // Toggle saat klik tombol
        pkkprBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            const isOpen = pkkprMenu.style.display === 'flex';
            pkkprMenu.style.display = isOpen ? 'none' : 'flex';
            pkkprBtn.setAttribute('aria-expanded', !isOpen);
        });

        // Tutup saat klik di luar
        document.addEventListener('click', function() {
            pkkprMenu.style.display = 'none';
            pkkprBtn.setAttribute('aria-expanded', false);
        });

        // Cegah menu tutup saat klik di dalam menu
        pkkprMenu.addEventListener('click', function(e) {
            e.stopPropagation();
        });
    }
</script>
</body>
</html>