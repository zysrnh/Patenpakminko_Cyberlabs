<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pelaku Usaha — PATEN PAK MIKO</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">

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
            --green:     #16A34A;
            --green-dk:  #79A73A;
            --green-lt:  #EEF7E2;
            --ink:       #003B64;
            --mid:       #2C5272;
            --muted:     #7A9BB5;
            --line:      #D6E4EF;
            --surface:   #F0F6FB;
            --surface2:  #E8F2FA;
            --white:     #FFFFFF;
            --r-sm:      6px;
            --r-md:      10px;
            --r-lg:      16px;
            --r-xl:      24px;
            --sidebar:   248px;
        }

        html, body {
            height: 100%;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--surface);
            color: var(--ink);
            -webkit-font-smoothing: antialiased;
            display: flex;
        }

        /* ─── SIDEBAR ────────────────────────── */
        .sidebar {
            width: var(--sidebar);
            background: var(--blue-dk);
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0; left: 0; bottom: 0;
            z-index: 20;
            overflow-y: auto;
            transition: transform .25s ease;
        }
        .sidebar > * {
            flex-shrink: 0;
        }

        .sidebar-logo {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 24px 20px 20px;
            border-bottom: 1px solid rgba(255,255,255,.08);
            text-decoration: none;
        }
        .sidebar-logo-icon {
            width: 36px; height: 36px;
            border-radius: var(--r-md);
            background: var(--blue);
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .sidebar-logo-icon svg { width: 18px; height: 18px; fill: none; stroke: #fff; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; }
        .sidebar-logo-text strong { display: block; font-size: 14px; font-weight: 800; color: #fff; letter-spacing: -.02em; }
        .sidebar-logo-text span { font-size: 10px; font-weight: 600; color: rgba(255,255,255,.45); text-transform: uppercase; letter-spacing: .08em; }

        .sidebar-section { padding: 20px 12px 8px; }
        .sidebar-section-label { font-size: 10px; font-weight: 700; color: rgba(255,255,255,.3); text-transform: uppercase; letter-spacing: .1em; padding: 0 8px; margin-bottom: 6px; }

        .nav-item {
            display: flex; align-items: center; gap: 10px;
            padding: 9px 10px; border-radius: var(--r-md);
            text-decoration: none; color: rgba(255,255,255,.6);
            font-size: 13.5px; font-weight: 600;
            transition: all .18s; margin-bottom: 2px;
        }
        .nav-item svg { width: 17px; height: 17px; fill: none; stroke: currentColor; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; flex-shrink: 0; }
        .nav-item:hover { color: #fff; background: rgba(255,255,255,.08); }
        .nav-item.active { color: var(--blue-dk); background: var(--yellow); font-weight: 700; }
        .nav-item.active svg { color: var(--blue-dk); }

        .sidebar-bottom { margin-top: auto; padding: 16px 12px; border-top: 1px solid rgba(255,255,255,.08); }
        .sidebar-user { display: flex; align-items: center; gap: 10px; padding: 10px; border-radius: var(--r-md); background: rgba(255,255,255,.06); margin-bottom: 8px; }
        .sidebar-avatar { width: 34px; height: 34px; border-radius: 50%; background: var(--blue); color: #fff; font-weight: 700; font-size: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; border: 1.5px solid rgba(255,255,255,.2); object-fit: cover; }
        .sidebar-user-info strong { display: block; font-size: 13px; font-weight: 700; color: #fff; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 140px; }
        .sidebar-user-info span { font-size: 11px; color: rgba(255,255,255,.45); }

        .btn-logout-sidebar {
            display: flex; align-items: center; gap: 8px;
            width: 100%; padding: 9px 10px;
            background: transparent; border: 1px solid rgba(255,255,255,.12);
            border-radius: var(--r-md); color: rgba(255,255,255,.55);
            font-family: inherit; font-size: 13px; font-weight: 600;
            cursor: pointer; transition: all .18s;
        }
        .btn-logout-sidebar svg { width: 15px; height: 15px; fill: none; stroke: currentColor; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; }
        .btn-logout-sidebar:hover { background: rgba(239,68,68,.15); border-color: rgba(239,68,68,.3); color: #FC8181; }

        /* ─── MAIN AREA ──────────────────────── */
        .main-wrap {
            margin-left: var(--sidebar);
            flex: 1; display: flex; flex-direction: column;
            min-height: 100vh;
        }



        /* ─── CONTENT ──────────────────────────────────────── */
        .content {
            padding: 28px 32px;
            flex: 1;
        }

        /* ─── WELCOME STRIP ────────────────────────────────── */
        .welcome-strip {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: var(--ink);
            border-radius: var(--r-lg);
            padding: 22px 28px;
            margin-bottom: 24px;
            border-left: 5px solid var(--yellow);
            position: relative;
            overflow: hidden;
        }
        .welcome-strip::after {
            content: '';
            position: absolute;
            right: -30px; top: -40px;
            width: 200px; height: 200px;
            border-radius: 50%;
            background: rgba(255,255,255,.03);
        }
        .welcome-strip h1 {
            font-size: 20px;
            font-weight: 800;
            color: #fff;
            margin-bottom: 4px;
            letter-spacing: -.02em;
        }
        .welcome-strip p {
            font-size: 13.5px;
            color: rgba(255,255,255,.65);
        }
        .welcome-strip-badge {
            display: flex;
            align-items: center;
            gap: 8px;
            background: rgba(255,255,255,.08);
            border: 1px solid rgba(255,255,255,.12);
            border-radius: var(--r-lg);
            padding: 10px 16px;
            flex-shrink: 0;
        }
        .welcome-strip-badge svg {
            width: 18px; height: 18px; fill: none;
            stroke: var(--yellow); stroke-width: 2;
            stroke-linecap: round; stroke-linejoin: round;
        }
        .welcome-strip-badge span {
            font-size: 12.5px;
            font-weight: 600;
            color: rgba(255,255,255,.8);
        }

        /* ─── ALERTS ───────────────────────────────────────── */
        .alert-profile {
            background: #FFFDF0;
            border: 1.5px solid #FBE89F;
            color: #744210;
            padding: 14px 18px;
            border-radius: var(--r-lg);
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
        }
        .alert-text { font-size: 13px; line-height: 1.5; font-weight: 500; }
        .alert-link {
            background: var(--yellow);
            color: #744210;
            border: none;
            padding: 8px 14px;
            border-radius: var(--r-md);
            font-family: inherit;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
            text-decoration: none;
            white-space: nowrap;
        }
        .alert-success {
            background: #E6F4EA;
            border: 1px solid #B8E2C8;
            color: #137333;
            padding: 12px 16px;
            border-radius: var(--r-md);
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* ─── KPI CARDS ─────────────────────────────────────── */
        .kpi-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 16px;
            margin-bottom: 24px;
        }
        .kpi-card {
            background: var(--white);
            border: 1px solid var(--line);
            border-radius: var(--r-lg);
            padding: 20px;
        }
        .kpi-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 14px;
        }
        .kpi-label {
            font-size: 12px;
            font-weight: 600;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: .05em;
        }
        .kpi-icon {
            width: 34px; height: 34px;
            border-radius: var(--r-md);
            display: flex; align-items: center; justify-content: center;
        }
        .kpi-icon svg {
            width: 17px; height: 17px;
            fill: none; stroke: currentColor;
            stroke-width: 2; stroke-linecap: round; stroke-linejoin: round;
        }
        .kpi-icon.blue   { background: var(--blue-lt); color: var(--blue); }
        .kpi-icon.yellow { background: var(--yellow-lt); color: var(--brown); }
        .kpi-icon.green  { background: var(--green-lt); color: var(--green-dk); }
        .kpi-icon.red    { background: #FFF5F5; color: #C53030; }

        .kpi-number {
            font-size: 28px;
            font-weight: 800;
            color: var(--ink);
            letter-spacing: -.03em;
            line-height: 1;
            margin-bottom: 6px;
        }
        .kpi-sub {
            font-size: 12px;
            color: var(--muted);
            font-weight: 500;
        }
        .kpi-badge {
            display: inline-flex;
            align-items: center;
            gap: 3px;
            font-size: 11px;
            font-weight: 700;
            padding: 2px 7px;
            border-radius: 20px;
        }
        .kpi-badge.up   { background: var(--green-lt); color: var(--green-dk); }
        .kpi-badge.down { background: #FFF5F5; color: #C53030; }
        .kpi-badge.neutral { background: var(--blue-lt); color: var(--blue); }

        /* ─── TWO-COL LAYOUT ─────────────────────────────────── */
        .grid-2col {
            display: grid;
            grid-template-columns: 1fr 360px;
            gap: 20px;
            align-items: start;
        }

        /* ─── SERVICES PANEL ─────────────────────────────────── */
        .panel {
            background: var(--white);
            border: 1px solid var(--line);
            border-radius: var(--r-lg);
        }
        .panel-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 18px 20px 14px;
            border-bottom: 1px solid var(--line);
        }
        .panel-head h2 {
            font-size: 15px;
            font-weight: 800;
            color: var(--ink);
        }
        .panel-head-link {
            font-size: 12px;
            font-weight: 700;
            color: var(--blue);
            text-decoration: none;
        }

        .services-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0;
        }
        .service-card {
            display: flex;
            flex-direction: column;
            gap: 12px;
            padding: 18px;
            border-right: 1px solid var(--line);
            border-bottom: 1px solid var(--line);
            text-decoration: none;
            transition: all .18s;
            position: relative;
            overflow: hidden;
        }
        .service-card:nth-child(2n) { border-right: none; }
        .service-card:nth-last-child(-n+2) { border-bottom: none; }
        .service-card:nth-last-child(1):nth-child(2n+1) { border-bottom: none; border-right: none; grid-column: span 2; }

        .service-card:hover {
            background: var(--surface);
        }
        .service-card:hover .service-arrow {
            opacity: 1;
            transform: translateX(0);
        }
        .service-card-top {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
        }
        .service-icon {
            width: 40px; height: 40px;
            border-radius: var(--r-md);
            display: flex; align-items: center; justify-content: center;
        }
        .service-icon svg {
            width: 19px; height: 19px;
            fill: none; stroke: currentColor;
            stroke-width: 2; stroke-linecap: round; stroke-linejoin: round;
        }
        .service-icon.green  { background: var(--green-lt); color: var(--green-dk); }
        .service-icon.yellow { background: rgba(255,203,5,.12); color: var(--brown); }
        .service-icon.blue   { background: var(--blue-lt); color: var(--blue); }
        .service-icon.orange { background: rgba(211,115,36,.12); color: #D37324; }
        .service-icon.gold   { background: rgba(214,158,46,.1); color: #D69E2E; }

        .service-arrow {
            width: 26px; height: 26px;
            border-radius: 50%;
            background: var(--blue-lt);
            display: flex; align-items: center; justify-content: center;
            opacity: 0;
            transform: translateX(-6px);
            transition: all .18s;
        }
        .service-arrow svg { width: 13px; height: 13px; fill: none; stroke: var(--blue); stroke-width: 2.5; stroke-linecap: round; }

        .service-card h3 {
            font-size: 13.5px;
            font-weight: 700;
            color: var(--ink);
            margin-bottom: 3px;
        }
        .service-card p {
            font-size: 12px;
            color: var(--muted);
            line-height: 1.45;
        }
        .service-count {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            background: var(--blue-lt);
            color: var(--blue);
            font-size: 11px;
            font-weight: 700;
            padding: 3px 8px;
            border-radius: 20px;
            margin-top: 4px;
        }

        /* ─── ACTIVITY PANEL ─────────────────────────────────── */
        .activity-list { padding: 8px 0; }
        .activity-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 12px 18px;
            border-bottom: 1px solid var(--line);
            transition: background .15s;
        }
        .activity-item:last-child { border-bottom: none; }
        .activity-item:hover { background: var(--surface); }
        .activity-dot {
            width: 8px; height: 8px;
            border-radius: 50%;
            margin-top: 5px;
            flex-shrink: 0;
        }
        .activity-dot.blue   { background: var(--blue); }
        .activity-dot.green  { background: var(--green); }
        .activity-dot.yellow { background: var(--brown); }
        .activity-dot.red    { background: #DC2626; }
        .activity-dot.gray   { background: var(--muted); }

        .activity-body {
            flex: 1;
            min-width: 0;
        }
        .activity-title {
            font-size: 13px;
            font-weight: 600;
            color: var(--ink);
            margin-bottom: 2px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .activity-meta {
            font-size: 11.5px;
            color: var(--muted);
        }
        .activity-status {
            flex-shrink: 0;
            font-size: 10.5px;
            font-weight: 700;
            padding: 3px 8px;
            border-radius: 20px;
        }
        .status-pending  { background: var(--yellow-lt); color: #92600A; }
        .status-review   { background: var(--blue-lt); color: var(--blue); }
        .status-approved { background: var(--green-lt); color: var(--green-dk); }
        .status-rejected { background: #FFF5F5; color: #C53030; }

        /* ─── QUICK STATS SIDEBAR ────────────────────────────── */
        .right-col { display: flex; flex-direction: column; gap: 20px; }

        .progress-item {
            padding: 16px 18px;
            border-bottom: 1px solid var(--line);
        }
        .progress-item:last-child { border-bottom: none; }
        .progress-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 8px;
        }
        .progress-head span { font-size: 13px; font-weight: 600; color: var(--ink); }
        .progress-head strong { font-size: 13px; font-weight: 700; color: var(--mid); }
        .progress-bar {
            height: 6px;
            border-radius: 4px;
            background: var(--surface2);
            overflow: hidden;
        }
        .progress-fill {
            height: 100%;
            border-radius: 4px;
            transition: width .5s ease;
        }
        .progress-fill.blue   { background: var(--blue); }
        .progress-fill.green  { background: var(--green); }
        .progress-fill.yellow { background: var(--brown); }
        .progress-fill.red    { background: #DC2626; }

        /* ─── CALENDAR / SCHEDULE PANEL ─────────────────────── */
        .schedule-empty {
            padding: 28px 18px;
            text-align: center;
        }
        .schedule-empty svg {
            width: 36px; height: 36px;
            fill: none; stroke: var(--blue-md);
            stroke-width: 1.5; stroke-linecap: round;
            margin-bottom: 10px;
        }
        .schedule-empty p {
            font-size: 13px;
            color: var(--muted);
            margin-bottom: 12px;
        }
        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: var(--blue);
            color: #fff;
            border: none;
            padding: 9px 16px;
            border-radius: var(--r-md);
            font-family: inherit;
            font-size: 12.5px;
            font-weight: 700;
            cursor: pointer;
            text-decoration: none;
            transition: opacity .18s;
        }
        .btn-primary:hover { opacity: .88; }
        .btn-primary svg { width: 14px; height: 14px; fill: none; stroke: #fff; stroke-width: 2.5; }

        .schedule-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 18px;
            border-bottom: 1px solid var(--line);
        }
        .schedule-item:last-child { border-bottom: none; }
        .schedule-date-box {
            width: 40px; height: 44px;
            border-radius: var(--r-md);
            background: var(--blue-lt);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .schedule-date-box .day {
            font-size: 17px;
            font-weight: 800;
            color: var(--blue);
            line-height: 1;
        }
        .schedule-date-box .month {
            font-size: 9px;
            font-weight: 700;
            color: var(--muted);
            text-transform: uppercase;
        }
        .schedule-info h4 { font-size: 13px; font-weight: 700; color: var(--ink); margin-bottom: 2px; }
        .schedule-info span { font-size: 11.5px; color: var(--muted); }

        /* ─── WELCOME / HERO CARD (dulu inline style) ────────── */
        .welcome-card {
            background: #ffffff;
            border: 1px solid var(--line);
            border-radius: 6px;
            padding: 18px 22px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            box-shadow: 0 2px 6px rgba(0,38,66,0.02);
            flex-wrap: wrap;
        }
        .welcome-card-left {
            display: flex;
            align-items: center;
            gap: 16px;
            min-width: 0;
        }
        .welcome-avatar {
            width: 44px; height: 44px;
            border-radius: 6px;
            object-fit: cover;
            flex-shrink: 0;
            border: 2px solid #fff;
            box-shadow: 0 2px 8px rgba(0,59,100,0.12);
        }
        .welcome-avatar-fallback {
            width: 44px; height: 44px;
            border-radius: 6px;
            background: linear-gradient(135deg, #003B64 0%, #218AC9 100%);
            color: #fff; font-weight: 800; font-size: 16px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
            box-shadow: 0 2px 8px rgba(0,59,100,0.12);
        }
        .welcome-card-title {
            font-size: 18px; font-weight: 800; color: #003B64;
            letter-spacing: -0.02em; margin: 0 0 4px;
            overflow-wrap: break-word;
        }
        .welcome-card-sub {
            font-size: 12.5px; color: #64748B; margin: 0;
        }
        .welcome-card-right {
            display: flex; align-items: center; gap: 10px; flex-shrink: 0;
            flex-wrap: wrap;
        }
        .btn-complete-profile {
            display: inline-flex; align-items: center; gap: 6px;
            background: #FFFBEB; border: 1px solid #FCD34D; color: #92400E;
            padding: 6px 12px; border-radius: 4px; font-size: 12px; font-weight: 700;
            text-decoration: none; transition: all 0.2s; white-space: nowrap;
        }
        .btn-complete-profile:hover { background: #FEF3C7; }
        .role-badge {
            display: inline-flex; align-items: center; gap: 6px;
            background: #F1F5F9; border: 1px solid #E2E8F0; color: #334155;
            padding: 6px 12px; border-radius: 4px; font-size: 12px; font-weight: 700;
            white-space: nowrap;
        }

        /* ─── SLA PANEL (dulu inline style) ─────────────────── */
        .sla-panel {
            background: #ffffff;
            border: 1px solid var(--line);
            border-radius: 6px;
            padding: 14px 18px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 16px;
            box-shadow: 0 2px 6px rgba(0,38,66,0.02);
        }
        .sla-panel-left {
            display: flex; align-items: center; gap: 10px;
        }
        .sla-icon {
            width: 30px; height: 30px; border-radius: 4px;
            background: #ECFDF5; color: #059669;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .sla-title { font-size: 13px; font-weight: 800; color: #0F172A; }
        .sla-sub { font-size: 11.5px; color: #64748B; }
        .sla-badges {
            display: flex; align-items: center; gap: 8px; flex-wrap: wrap;
        }
        .sla-badge {
            border-radius: 4px; padding: 6px 12px;
            display: flex; align-items: center; gap: 6px;
            white-space: nowrap;
        }
        .sla-badge.green  { background: #ECFDF5; border: 1px solid #A7F3D0; }
        .sla-badge.yellow { background: #FFFBEB; border: 1px solid #FDE68A; }
        .sla-badge.red    { background: #FEF2F2; border: 1px solid #FECACA; }
        .sla-dot { width: 7px; height: 7px; border-radius: 50%; display: inline-block; }

        /* ─── MOBILE RESPONSIVE ────────────────────────────── */
        .btn-menu {
            display: none;
            background: transparent; border: none; cursor: pointer;
            color: var(--ink); padding: 4px;
        }
        .sidebar-backdrop {
            display: none; position: fixed; inset: 0; background: rgba(0,30,50,.5);
            z-index: 99; opacity: 0; transition: opacity .3s; pointer-events: none;
        }
        @media (max-width: 768px) {
            .btn-menu { display: block; margin-right: 12px; }
            .sidebar { transform: translateX(-100%); transition: transform .3s ease; z-index: 100; }
            .sidebar.open { transform: translateX(0); }
            .sidebar-backdrop.show { display: block; opacity: 1; pointer-events: auto; }
            .main-wrap { margin-left: 0; width: 100%; }
            .topbar { padding: 0 16px; }
            .content { padding: 14px; }
            .stat-grid { grid-template-columns: 1fr; }
            .hero-grid { grid-template-columns: 1fr; }
            .two-col { grid-template-columns: 1fr; }

            /* KPI cards → Carousel horizontal di HP */
            .kpi-row {
                display: flex !important;
                overflow-x: auto !important;
                scroll-snap-type: x mandatory !important;
                -webkit-overflow-scrolling: touch !important;
                gap: 12px !important;
                padding-bottom: 8px !important;
                margin-bottom: 20px !important;
            }
            .kpi-row::-webkit-scrollbar {
                display: none;
            }
            .kpi-card {
                flex: 0 0 74% !important;
                min-width: 210px !important;
                scroll-snap-align: start !important;
                padding: 16px !important;
                border-radius: 12px !important;
            }
            .kpi-number { font-size: 24px !important; }
            .kpi-label { font-size: 11px !important; }

            /* Grid 2 kolom utama → stack */
            .grid-2col {
                grid-template-columns: 1fr !important;
            }

            /* Services grid → 1 kolom di HP kecil */
            .services-grid {
                grid-template-columns: 1fr !important;
            }
            .service-card:nth-child(2n) { border-right: none !important; }
            .service-card:nth-last-child(-n+2) { border-bottom: 1px solid var(--line) !important; }
            .service-card:last-child { border-bottom: none !important; grid-column: span 1 !important; }

            /* Panel head & activity items rapetin & rapih di HP */
            .panel-head { padding: 14px 16px 12px; }
            .activity-item {
                display: flex !important;
                flex-direction: column !important;
                align-items: flex-start !important;
                gap: 6px !important;
                padding: 14px 16px !important;
            }
            .activity-body {
                width: 100% !important;
            }
            .activity-title {
                font-size: 13.5px !important;
                font-weight: 700 !important;
                white-space: normal !important;
                word-break: break-word !important;
                line-height: 1.35 !important;
            }
            .activity-meta {
                font-size: 11.5px !important;
                margin-top: 2px !important;
            }
            .activity-status {
                align-self: flex-start !important;
                max-width: 100% !important;
                white-space: normal !important;
                font-size: 11px !important;
                padding: 4px 10px !important;
                border-radius: 12px !important;
                margin-top: 2px !important;
            }

            /* Welcome card */
            .welcome-card { padding: 16px; gap: 12px; }
            .welcome-card-left { width: 100%; }
            .welcome-card-right { width: 100%; justify-content: flex-start; }
            .welcome-card-title { font-size: 16px; }

            /* SLA panel */
            .sla-panel { padding: 14px; }
            .sla-panel-left { width: 100%; }
            .sla-badges { width: 100%; }
            .sla-badge { flex: 1 1 auto; justify-content: center; font-size: 11px !important; padding: 6px 8px; }

            /* Berita list item (admin) jadi vertical */
            .berita-item { flex-direction: column !important; align-items: flex-start !important; }
            .berita-item img, .berita-item .berita-thumb-empty { width: 100% !important; height: 160px !important; margin-bottom: 10px; }
            .berita-item .activity-body { margin-left: 0 !important; }
            .berita-item .activity-status { margin-top: 8px; }

            /* Warning table souvenir: font lebih kecil biar muat di scroll horizontal */
            .alert-warning table { font-size: 11px !important; }
            .alert-warning th, .alert-warning td { padding: 6px 8px !important; }
        }

        @media (max-width: 420px) {
            .kpi-card { flex: 0 0 85% !important; }
            .welcome-card-title { font-size: 15px !important; }
            .role-badge, .btn-complete-profile { font-size: 11px !important; padding: 5px 10px !important; }
        }

        /* ─── SIDEBAR DROPDOWN ───────────────── */
        .nav-item-group {
            display: flex;
            flex-direction: column;
        }
        .nav-item.has-dropdown {
            justify-content: space-between;
            cursor: pointer;
        }
        .nav-dropdown-menu {
            display: none;
            flex-direction: column;
            padding-left: 44px;
            margin-top: 4px;
            margin-bottom: 8px;
            gap: 4px;
        }
        .nav-dropdown-menu.open {
            display: flex;
        }
        .nav-dropdown-item {
            padding: 8px 12px;
            color: var(--muted);
            font-size: 12.5px;
            text-decoration: none;
            border-radius: var(--r-sm);
            transition: all 0.2s;
            font-weight: 500;
        }
        .nav-dropdown-item:hover, .nav-dropdown-item.active {
            color: var(--blue);
            background: var(--surface2);
        }
        .chevron {
            width: 16px; height: 16px;
            transition: transform 0.2s;
        }
        .nav-item.has-dropdown.open .chevron {
            transform: rotate(180deg);
        }

    </style>
</head>
<body>

    <!-- ─── SIDEBAR ─────────────────────────────── -->
    <div class="sidebar-backdrop" id="sidebar-backdrop"></div>
    <aside class="sidebar" id="sidebar">
        <a href="/dashboard" class="sidebar-logo">
            <div class="sidebar-logo-icon" style="background:transparent;padding:0;overflow:hidden;width:40px;height:40px;border-radius:0;">
                <img src="{{ asset('storage/logo/PATEN PAK MIKO LOGO.png') }}" alt="Logo PATEN PAK MIKO" style="width:100%;height:100%;object-fit:contain;">
            </div>
            <div class="sidebar-logo-text">
                <strong>PATEN PAK MIKO</strong>
                <span>
                    @if(Auth::user()->isPelakuUsaha()) Portal Layanan Instansi
                    @elseif(Auth::user()->isBpn()) Portal Admin Instansi
                    @elseif(Auth::user()->isDinasPu()) Portal Dinas Pekerjaan Umum dan Tata Ruang (PUTR)
                    @elseif(Auth::user()->isSatuPintu()) Portal DPMPTSP
                    @elseif(Auth::user()->isDpn()) Portal Layanan Instansi
                    @else Portal Manajemen @endif
                </span>
            </div>
        </a>

        <div class="sidebar-section">
            <div class="sidebar-section-label">Menu Utama</div>
            <a href="/" class="nav-item">
                <svg viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                Beranda
            </a>
            <a href="{{ route('dashboard') }}" class="nav-item active">
                <svg viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
                Dashboard
            </a>
            <a href="{{ route('profile') }}" class="nav-item">
                <svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                Profil Saya
            </a>
        </div>

                @if(!Auth::user()->isAdminBerita())
        <div class="sidebar-section">
            <div class="sidebar-section-label">Layanan</div>
            <a href="{{ route('berusaha.index') }}" class="nav-item">
                <svg viewBox="0 0 24 24"><rect x="2" y="3" width="20" height="14" rx="2"/><path d="M8 21h8M12 17v4"/></svg>
                Pertimbangan Teknis Pertanahan PKKPR Berusaha
            </a>
            <a href="{{ route('non-berusaha.index') }}" class="nav-item">
                <svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                Pertimbangan Teknis Pertanahan PKKPR Non Berusaha
            </a>
            <a href="{{ route('kebijakan.index') }}" class="nav-item">
                <svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>Pertimbangan Teknis Pertanahan Kebijakan</a>
            <a href="{{ route('tanah-timbul.index') }}" class="nav-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>Pertimbangan Teknis Pertanahan Tanah Timbul</a>
            <a href="{{ route('psn.index') }}" class="nav-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z"/><line x1="4" y1="22" x2="4" y2="15"/></svg>
                PSN (Proyek Nasional)
            </a>
        </div>

        <div class="sidebar-section">
            <div class="sidebar-section-label">Fasilitas & Manajemen</div>
            <a href="{{ route('informal.index') }}" class="nav-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                INFORMAL
            </a>
            <a href="{{ route('lapolpa.index') }}" class="nav-item">
                <svg viewBox="0 0 24 24"><path d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01"/></svg>
                LAPOL PAK
            </a>
            <a href="{{ route('ulasan.index') }}" class="nav-item">
                <svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                Ulasan Layanan
            </a>
        </div>

        @endif

        @if(Auth::user()->isDpn() || Auth::user()->isBpn() || Auth::user()->isDinasPu() || Auth::user()->isDinasPutr() || Auth::user()->isSatuPintu())
        <div class="sidebar-section">
            <div class="sidebar-section-label">Manajemen Pemberkasan</div>
            <div class="nav-item-group">
                <div class="nav-item has-dropdown" onclick="this.classList.toggle('open'); this.nextElementSibling.classList.toggle('open');">
                    <div style="display:flex; align-items:center; gap:12px;">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 22h14a2 2 0 002-2V7.5L14.5 2H6a2 2 0 00-2 2v4"/><polyline points="14 2 14 8 20 8"/><path d="M2 15h10"/><path d="M9 18l3-3-3-3"/></svg>
                        Pemberkasan
                    </div>
                    <svg class="chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
                </div>
                <div class="nav-dropdown-menu">
                    <a href="{{ route('berkas.index') }}" class="nav-dropdown-item">Berkas Otomatis</a>
                    <a href="{{ route('berkas.index', ['layanan' => 'PKKPR Berusaha', 'kategori' => 'Pertimbangan Teknis Berusaha']) }}" class="nav-dropdown-item">Pertimbangan Teknis Berusaha</a>
                    <a href="{{ route('berkas.index', ['layanan' => 'PKKPR Non-Berusaha', 'kategori' => 'Pertimbangan Teknis Non Berusaha']) }}" class="nav-dropdown-item">Pertimbangan Teknis Non Berusaha</a>
                    @if(!Auth::user()->isDinasPu() && !Auth::user()->isDinasPutr() && !Auth::user()->isSatuPintu())
                    <a href="{{ route('berkas.index', ['layanan' => 'Kebijakan', 'kategori' => 'Pertimbangan Teknis Kebijakan']) }}" class="nav-dropdown-item">Pertimbangan Teknis Kebijakan</a>
                    <a href="{{ route('berkas.index', ['layanan' => 'Tanah Timbul', 'kategori' => 'Pertimbangan Teknis Tanah Timbul']) }}" class="nav-dropdown-item">Pertimbangan Teknis Tanah Timbul</a>
                    @endif
                    <a href="{{ route('berkas.index', ['layanan' => 'PSN', 'kategori' => 'Pertimbangan Teknis PSN']) }}" class="nav-dropdown-item">Pertimbangan Teknis PSN</a>
                </div>
            </div>
            <a href="{{ route('dokumen.index') }}" class="nav-item {{ request()->routeIs('dokumen.*') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8l-6-6z"/><path d="M14 2v6h6"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                Pengelolaan Dokumen
            </a>
            @if(Auth::user()->isBpn() || Auth::user()->isDinasPu() || Auth::user()->isDinasPutr() || Auth::user()->isSatuPintu())
            <a href="{{ route('admin.reviews.index') }}" class="nav-item {{ request()->routeIs('admin.reviews.*') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                Evaluasi Ulasan Masuk
            </a>
            @else
            <a href="{{ route('ulasan.index') }}" class="nav-item">
                <svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                Ulasan Layanan
            </a>
            @endif
        </div>
        @endif

        @if(Auth::user()->isDpn() || Auth::user()->isAdminBerita())
        <div class="sidebar-section">
            <div class="sidebar-section-label">Admin</div>
            @if(Auth::user()->isDpn())

            {{-- <a href="{{ route('dpn.whatsapp') }}" class="nav-item">
                <svg viewBox="0 0 24 24"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
                Integrasi WhatsApp
            </a> --}}
            <a href="{{ route('dpn.contacts') }}" class="nav-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg>
                Kontak Admin Instansi
            </a>
            <a href="{{ route('dpn.kontak_page') }}" class="nav-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                Kelola Halaman Kontak
            </a>
            <a href="{{ route('admin.reviews.index') }}" class="nav-item">
                <svg viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                Kelola Ulasan
            </a>
            <a href="{{ route('admin_dpn.index') }}" class="nav-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><line x1="3" y1="9" x2="21" y2="9"/><line x1="9" y1="21" x2="9" y2="9"/></svg>
                Statistik Web
            </a>
            <a href="{{ route('dpn.holidays.index') }}" class="nav-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                Kelola Kalender Libur
            </a>
            @endif

            <a href="{{ route('admin.templates.index') }}" class="nav-item {{ request()->routeIs('admin.templates.*') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6z"/><path d="M14 2v6h6"/><path d="M16 13H8"/><path d="M16 17H8"/><path d="M10 9H8"/></svg>
                Kelola Template Dokumen
            </a>
            <a href="{{ route('admin.berita.index') }}" class="nav-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l6 6v10a2 2 0 01-2 2z"/></svg>
                Kelola Berita
            </a>
        </div>
        @endif

        @if(Auth::user()->isDpn())
        <div class="sidebar-section">
            <div class="sidebar-section-label">Manajemen Admin</div>
            <a href="{{ route('admin.users.index') }}" class="nav-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg>
                Kelola Admin
            </a>
            <a href="{{ route('admin.pelaku_usaha.index') }}" class="nav-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg>
                Kelola Pengguna
            </a>
        </div>
        @endif

        <div class="sidebar-bottom">
            <div class="sidebar-user">
                @if(Auth::user()->profile_photo)
                    <img src="{{ route('file.view', ['path' => Auth::user()->profile_photo]) }}" alt="Foto Profil" class="sidebar-avatar">
                @else
                    <div class="sidebar-avatar">{{ strtoupper(substr(Auth::user()->username, 0, 2)) }}</div>
                @endif
                <div class="sidebar-user-info">
                    <strong>{{ Auth::user()->name ?? Auth::user()->username }}</strong>
                    <span>{{ Auth::user()->phone_number }}</span>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-logout-sidebar">
                    <svg viewBox="0 0 24 24"><path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                    Keluar dari Akun
                </button>
            </form>
        </div>
    </aside>

    <!-- ─── MAIN WRAP ────────────────────────────── -->
    <div class="main-wrap">

        <!-- Top Bar -->
                @include('layouts.partials.dashboard-topbar')

        <!-- Content -->
        <div class="content">

            @if(session('success'))
                <div class="alert-success">
                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ session('success') }}
                </div>
            @endif

            @php
                $user = Auth::user();
                $isProfileIncomplete = empty($user->name) || empty($user->email) || empty($user->address) || empty($user->business_name) || empty($user->business_role);
                
                // --- Kalkulasi Statistik ---
                if ($user->isPelakuUsaha()) {
                    $totalNon = \App\Models\PpkprApplication::where('user_id', $user->id)->count();
                    $totalBerusaha = \App\Models\PpkprBerusahaApplication::where('user_id', $user->id)->count();
                    $totalKebijakan = \App\Models\KebijakanApplication::where('user_id', $user->id)->count();
                    $countLapolpak = \App\Models\LapolpaBooking::where('user_id', $user->id)->count();

                    $unpaidNon = \App\Models\PpkprApplication::where('user_id', $user->id)->whereNotIn('status', ['disetujui', 'ditolak'])->where(function($q) { $q->whereNull('bpn_pembayaran_status')->orWhere('bpn_pembayaran_status', '!=', 'sudah_bayar'); })->count();
                    $unpaidBerusaha = \App\Models\PpkprBerusahaApplication::where('user_id', $user->id)->whereNotIn('status', ['disetujui', 'ditolak'])->where(function($q) { $q->whereNull('bpn_pembayaran_status')->orWhere('bpn_pembayaran_status', '!=', 'sudah_bayar'); })->count();
                    $unpaidKebijakan = \App\Models\KebijakanApplication::where('user_id', $user->id)->whereNotIn('status', ['disetujui', 'ditolak'])->where(function($q) { $q->whereNull('bpn_pembayaran_status')->orWhere('bpn_pembayaran_status', '!=', 'sudah_bayar'); })->count();

                    $pendingNon = \App\Models\PpkprApplication::where('user_id', $user->id)->whereNotIn('status', ['disetujui', 'ditolak'])->where('bpn_pembayaran_status', 'sudah_bayar')->count();
                    $pendingBerusaha = \App\Models\PpkprBerusahaApplication::where('user_id', $user->id)->whereNotIn('status', ['disetujui', 'ditolak'])->where('bpn_pembayaran_status', 'sudah_bayar')->count();
                    $pendingKebijakan = \App\Models\KebijakanApplication::where('user_id', $user->id)->whereNotIn('status', ['disetujui', 'ditolak'])->where('bpn_pembayaran_status', 'sudah_bayar')->count();

                    $disetujuiNon = \App\Models\PpkprApplication::where('user_id', $user->id)->where('status', 'disetujui')->count();
                    $disetujuiBerusaha = \App\Models\PpkprBerusahaApplication::where('user_id', $user->id)->where('status', 'disetujui')->count();
                    $disetujuiKebijakan = \App\Models\KebijakanApplication::where('user_id', $user->id)->where('status', 'disetujui')->count();

                    $ditolakNon = \App\Models\PpkprApplication::where('user_id', $user->id)->where('status', 'ditolak')->count();
                    $ditolakBerusaha = \App\Models\PpkprBerusahaApplication::where('user_id', $user->id)->where('status', 'ditolak')->count();
                    $ditolakKebijakan = \App\Models\KebijakanApplication::where('user_id', $user->id)->where('status', 'ditolak')->count();
                } else {
                    $totalNon = \App\Models\PpkprApplication::count();
                    $totalBerusaha = \App\Models\PpkprBerusahaApplication::count();
                    $totalKebijakan = \App\Models\KebijakanApplication::count();
                    $countLapolpak = \App\Models\LapolpaBooking::count();

                    $unpaidNon = \App\Models\PpkprApplication::whereNotIn('status', ['disetujui', 'ditolak'])->where(function($q) { $q->whereNull('bpn_pembayaran_status')->orWhere('bpn_pembayaran_status', '!=', 'sudah_bayar'); })->count();
                    $unpaidBerusaha = \App\Models\PpkprBerusahaApplication::whereNotIn('status', ['disetujui', 'ditolak'])->where(function($q) { $q->whereNull('bpn_pembayaran_status')->orWhere('bpn_pembayaran_status', '!=', 'sudah_bayar'); })->count();
                    $unpaidKebijakan = \App\Models\KebijakanApplication::whereNotIn('status', ['disetujui', 'ditolak'])->where(function($q) { $q->whereNull('bpn_pembayaran_status')->orWhere('bpn_pembayaran_status', '!=', 'sudah_bayar'); })->count();

                    $pendingNon = \App\Models\PpkprApplication::whereNotIn('status', ['disetujui', 'ditolak'])->where('bpn_pembayaran_status', 'sudah_bayar')->count();
                    $pendingBerusaha = \App\Models\PpkprBerusahaApplication::whereNotIn('status', ['disetujui', 'ditolak'])->where('bpn_pembayaran_status', 'sudah_bayar')->count();
                    $pendingKebijakan = \App\Models\KebijakanApplication::whereNotIn('status', ['disetujui', 'ditolak'])->where('bpn_pembayaran_status', 'sudah_bayar')->count();

                    $disetujuiNon = \App\Models\PpkprApplication::where('status', 'disetujui')->count();
                    $disetujuiBerusaha = \App\Models\PpkprBerusahaApplication::where('status', 'disetujui')->count();
                    $disetujuiKebijakan = \App\Models\KebijakanApplication::where('status', 'disetujui')->count();

                    $ditolakNon = \App\Models\PpkprApplication::where('status', 'ditolak')->count();
                    $ditolakBerusaha = \App\Models\PpkprBerusahaApplication::where('status', 'ditolak')->count();
                    $ditolakKebijakan = \App\Models\KebijakanApplication::where('status', 'ditolak')->count();
                }

                $totalPermohonan = $totalNon + $totalBerusaha + $totalKebijakan;
                $totalUnpaid = $unpaidNon + $unpaidBerusaha + $unpaidKebijakan;
                $totalPending = $pendingNon + $pendingBerusaha + $pendingKebijakan;
                $totalDisetujui = $disetujuiNon + $disetujuiBerusaha + $disetujuiKebijakan;
                $totalDitolak = $ditolakNon + $ditolakBerusaha + $ditolakKebijakan;
                
                $countNonBerusaha = $totalNon;
                $countBerusaha = $totalBerusaha;
                $countKebijakan = $totalKebijakan;
                
                // --- Kalkulasi SLA Pengendalian (Hanya untuk Admin) ---
                $slaHijau = 0; $slaKuning = 0; $slaMerah = 0;
                if (!$user->isPelakuUsaha()) {
                    $allPendingNon = \App\Models\PpkprApplication::whereNotIn('status', ['disetujui', 'ditolak', 'terbit_pkpr'])->where('bpn_pembayaran_status', 'sudah_bayar')->get();
                    $allPendingBerusaha = \App\Models\PpkprBerusahaApplication::whereNotIn('status', ['disetujui', 'ditolak', 'terbit_pkpr'])->where('bpn_pembayaran_status', 'sudah_bayar')->get();
                    $allPendingKebijakan = \App\Models\KebijakanApplication::whereNotIn('status', ['disetujui', 'ditolak', 'terbit_pkpr'])->where('bpn_pembayaran_status', 'sudah_bayar')->get();

                    $processSla = function($apps) use (&$slaHijau, &$slaKuning, &$slaMerah) {
                        foreach($apps as $app) {
                            $startDate = $app->tgl_mulai_layanan ? \Carbon\Carbon::parse($app->tgl_mulai_layanan) : $app->created_at;
                            $endDate = $app->tgl_selesai_layanan ? \Carbon\Carbon::parse($app->tgl_selesai_layanan) : now();
                            $hariKe = $startDate->getEffectiveWorkingDayNumber($endDate);

                            $isPuPhase = in_array($app->status, ['menunggu_dinas_pu', 'menunggu_satu_pintu', 'menunggu_putr']);
                            
                            if ($isPuPhase) {
                                if($hariKe <= 16) $slaHijau++;
                                elseif($hariKe >= 17 && $hariKe <= 19) $slaKuning++;
                                else $slaMerah++;
                            } else {
                                if($hariKe <= 7) $slaHijau++;
                                elseif($hariKe >= 8 && $hariKe <= 9) $slaKuning++;
                                else $slaMerah++;
                            }
                        }
                    };
                    
                    $processSla($allPendingNon);
                    $processSla($allPendingBerusaha);
                    $processSla($allPendingKebijakan);

                    // --- Kalkulasi Pending Souvenirs (> 10 hari post-pertek upload, belum dikirim) ---
                    $pendingSouvenirs = [];
                    $souvenirModels = [
                        'ppkpr_non_berusaha' => \App\Models\PpkprApplication::class,
                        'ppkpr_berusaha'     => \App\Models\PpkprBerusahaApplication::class,
                        'kebijakan_khusus'   => \App\Models\KebijakanApplication::class,
                        'psn'                => \App\Models\PsnApplication::class,
                        'tanah_timbul'       => \App\Models\TanahTimbulApplication::class,
                    ];

                    $typeLabels = [
                        'ppkpr_non_berusaha' => 'Pertimbangan Teknis Pertanahan PKKPR Non Berusaha',
                        'ppkpr_berusaha'     => 'Pertimbangan Teknis Pertanahan PKKPR Berusaha',
                        'kebijakan_khusus'   => 'Kebijakan',
                        'psn'                => 'PSN (Proyek Nasional)',
                        'tanah_timbul'       => 'Tanah Timbul',
                    ];

                    foreach ($souvenirModels as $typeKey => $modelClass) {
                        $apps = $modelClass::whereNotNull('bpn_pertek_document')
                            ->whereNull('souvenir_sent_at')
                            ->get();

                        foreach ($apps as $app) {
                            $uploadedAt = $app->bpn_pertek_uploaded_at ?? $app->updated_at;
                            $days = (int) $uploadedAt->diffInWorkingDaysWithHolidays(now());
                            if ($days >= 10) {
                                $pendingSouvenirs[] = [
                                    'id'                 => $app->id,
                                    'application_number' => $app->application_number,
                                    'type_label'         => $typeLabels[$typeKey],
                                    'type_key'           => $typeKey,
                                    'pemilik'            => $app->nama_pemilik_usaha ?? ($app->user->name ?? $app->user->username),
                                    'phone'              => $app->user->phone_number ?? '—',
                                    'days'               => $days,
                                    'uploaded_at'        => $uploadedAt,
                                ];
                            }
                        }
                    }
                }

                // --- Fetch Aktivitas Terkini (5 Permohonan Terbaru) ---
                $recentActivities = collect();
                $recentModels = [
                    ['class' => \App\Models\PpkprBerusahaApplication::class, 'type' => 'PKKPR Berusaha', 'route' => 'berusaha.show'],
                    ['class' => \App\Models\PpkprApplication::class,        'type' => 'PKKPR Non Berusaha', 'route' => 'non-berusaha.show'],
                    ['class' => \App\Models\KebijakanApplication::class,    'type' => 'Kebijakan', 'route' => 'kebijakan.show'],
                    ['class' => \App\Models\TanahTimbulApplication::class,  'type' => 'Tanah Timbul', 'route' => 'tanah-timbul.show'],
                    ['class' => \App\Models\PsnApplication::class,          'type' => 'PSN', 'route' => 'psn.show'],
                ];

                foreach ($recentModels as $m) {
                    $query = $m['class']::with('user')->where('bpn_pembayaran_status', 'sudah_bayar');
                    if ($user->isPelakuUsaha()) {
                        $query->where('user_id', $user->id);
                    }
                    $items = $query->latest()->take(5)->get();
                    foreach ($items as $item) {
                        $statusKey = 'pending';
                        $statusLabel = $item->status_label;
                        $statusColor = 'yellow';

                        if (in_array($item->status, ['disetujui', 'terbit_pkpr'])) {
                            $statusKey = 'approved';
                            $statusColor = 'green';
                        } elseif ($item->status === 'ditolak') {
                            $statusKey = 'rejected';
                            $statusColor = 'red';
                        } elseif ($item->bpn_pembayaran_status === 'sudah_bayar') {
                            $statusKey = 'review';
                            $statusColor = 'blue';
                        } else {
                            $statusKey = 'unpaid';
                            $statusColor = 'yellow';
                        }

                        $recentActivities->push((object)[
                            'id'           => $item->id,
                            'title'        => ($item->nama_pemilik_usaha ?? ($item->user->name ?? $item->user->username)) . ' (' . ($item->application_number ?? 'No. Berkas #' . $item->id) . ')',
                            'type'         => $m['type'],
                            'created_at'   => $item->created_at,
                            'status_key'   => $statusKey,
                            'status_label' => $statusLabel,
                            'status_color' => $statusColor,
                            'url'          => route($m['route'], $item->id),
                        ]);
                    }
                }

                $recentActivities = $recentActivities->sortByDesc('created_at')->take(5);
            @endphp

            <!-- Hero Header Card (Clean & Minimal) -->
            <div class="welcome-card">
                <div class="welcome-card-left">
                    @if($user->profile_photo)
                        <img src="{{ route('file.view', ['path' => $user->profile_photo]) }}" alt="Foto Profil" class="welcome-avatar">
                    @else
                        <div class="welcome-avatar-fallback">
                            {{ strtoupper(substr($user->username ?? 'U', 0, 2)) }}
                        </div>
                    @endif
                    <div>
                        <h1 class="welcome-card-title">Selamat Datang, {{ $user->name ?? $user->username }}!</h1>
                        <p class="welcome-card-sub">
                            @if(Auth::user()->isAdminBerita()) Kelola publikasi artikel dan informasi terbaru di sini.
                            @elseif(Auth::user()->isPelakuUsaha()) Pantau status permohonan dan akses layanan pemanfaatan ruang Anda.
                            @else Kelola permohonan pemanfaatan ruang dan pantau status layanan secara real-time.
                            @endif
                        </p>
                    </div>
                </div>

                <div class="welcome-card-right">
                    @if($isProfileIncomplete)
                        <a href="{{ route('profile') }}" class="btn-complete-profile">
                            <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                            Lengkapi Profil
                        </a>
                    @endif

                    <div class="role-badge">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                        <span>
                            @if(Auth::user()->isAdminBerita()) Admin Berita
                            @elseif(Auth::user()->isPelakuUsaha()) Pelaku Usaha
                            @elseif(Auth::user()->isBpn()) Admin Instansi
                            @elseif(Auth::user()->isDinasPu()) Admin PUTR
                            @elseif(Auth::user()->isSatuPintu()) Admin DPMPTSP
                            @elseif(Auth::user()->isDpn()) Super Admin
                            @else Pengguna Terverifikasi @endif
                        </span>
                    </div>
                </div>
            </div>

            @if(Auth::user()->isAdminBerita())
                <!-- Dashboard Berita Admin -->
                @php
                    $totalBerita = \App\Models\Berita::count();
                    $publishedBerita = \App\Models\Berita::where('is_published', true)->count();
                    $draftBerita = \App\Models\Berita::where('is_published', false)->count();
                    $beritasList = \App\Models\Berita::latest()->take(5)->get();
                @endphp
                <div class="kpi-row">
                    <div class="kpi-card" style="border-radius: 6px;">
                        <div class="kpi-top">
                            <span class="kpi-label">Total Berita</span>
                            <div class="kpi-icon blue" style="border-radius: 4px;">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l6 6v10a2 2 0 01-2 2z"/></svg>
                            </div>
                        </div>
                        <div class="kpi-number">{{ $totalBerita }}</div>
                        <div class="kpi-sub"><span class="kpi-badge neutral">Semua Berita</span></div>
                    </div>
                    <div class="kpi-card" style="border-radius: 6px;">
                        <div class="kpi-top">
                            <span class="kpi-label">Dipublikasi</span>
                            <div class="kpi-icon green" style="border-radius: 4px;">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                            </div>
                        </div>
                        <div class="kpi-number">{{ $publishedBerita }}</div>
                        <div class="kpi-sub"><span class="kpi-badge up">Tampil Publik</span></div>
                    </div>
                    <div class="kpi-card" style="border-radius: 6px;">
                        <div class="kpi-top">
                            <span class="kpi-label">Draft</span>
                            <div class="kpi-icon yellow" style="border-radius: 4px;">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                            </div>
                        </div>
                        <div class="kpi-number">{{ $draftBerita }}</div>
                        <div class="kpi-sub"><span class="kpi-badge neutral">Belum Tampil</span></div>
                    </div>
                </div>

                <div class="panel" style="border-radius: 6px;">
                    <div class="panel-head">
                        <h2>Berita Terbaru</h2>
                        <a href="{{ route('admin.berita.index') }}" class="panel-head-link">Lihat Semua &rarr;</a>
                    </div>
                    <div class="activity-list">
                        @forelse($beritasList as $beritaItem)
                        <div class="activity-item berita-item" style="align-items: center; padding: 18px 20px;">
                            @if($beritaItem->image_path)
                                <img src="{{ route('file.view', ['path' => $beritaItem->image_path]) }}" alt="{{ $beritaItem->title }}" style="width: 180px; height: 110px; object-fit: cover; border-radius: 6px; flex-shrink: 0; border: 1px solid var(--line);">
                            @else
                                <div class="berita-thumb-empty" style="width: 180px; height: 110px; border-radius: 6px; background: var(--surface2); border: 1px dashed var(--line); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                    <svg width="32" height="32" fill="none" stroke="var(--muted)" stroke-width="1.5" viewBox="0 0 24 24"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                </div>
                            @endif
                            <div class="activity-body" style="margin-left: 16px;">
                                <div class="activity-title" style="font-size: 14px; margin-bottom: 4px;">{{ $beritaItem->title }}</div>
                                <div class="activity-meta">{{ $beritaItem->created_at->format('d M Y, H:i') }} • {{ $beritaItem->category ?? 'Umum' }}</div>
                            </div>
                            <div class="activity-status {{ $beritaItem->is_published ? 'status-approved' : 'status-pending' }}">
                                {{ $beritaItem->is_published ? 'Dipublikasi' : 'Draft' }}
                            </div>
                        </div>
                        @empty
                        <div class="activity-item">
                            <div class="activity-body text-center text-muted" style="font-size:13px; padding:20px;">Belum ada berita yang ditulis.</div>
                        </div>
                        @endforelse
                    </div>
                </div>
            @else
            <!-- Souvenir Alert Warning -->
            @if(!$user->isPelakuUsaha() && count($pendingSouvenirs) > 0)
                <div class="alert-warning" style="display: block; padding: 14px 18px; border-radius: 6px; margin-bottom: 20px; border: 1px solid #FCD34D; background: #FFFBEB; color: #92400E;">
                    <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 8px;">
                        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="color: #D97706; flex-shrink: 0;"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                        <strong style="font-size: 13.5px;">Peringatan Souvenir Pending (SLA > 10 Hari)</strong>
                    </div>
                    <p style="font-size: 12.5px; margin-bottom: 10px; line-height: 1.5;">
                        Terdapat <strong>{{ count($pendingSouvenirs) }}</strong> permohonan yang telah melebihi 10 hari sejak dokumen Pertek Pertanahan diunggah/diterbitkan, tetapi souvenir belum dikirimkan.
                    </p>
                    <div style="overflow-x: auto; -webkit-overflow-scrolling: touch; background: rgba(255, 255, 255, 0.7); border-radius: 6px; border: 1px solid rgba(217, 119, 6, 0.15);">
                        <table style="width: 100%; min-width: 520px; border-collapse: collapse; font-size: 12px; text-align: left;">
                            <thead>
                                <tr style="border-bottom: 1px solid rgba(217, 119, 6, 0.15);">
                                    <th style="padding: 8px 12px; font-weight: 700; color: #744210; text-transform: uppercase; font-size: 10.5px;">No. Registrasi</th>
                                    <th style="padding: 8px 12px; font-weight: 700; color: #744210; text-transform: uppercase; font-size: 10.5px;">Pemohon</th>
                                    <th style="padding: 8px 12px; font-weight: 700; color: #744210; text-transform: uppercase; font-size: 10.5px;">Layanan</th>
                                    <th style="padding: 8px 12px; font-weight: 700; color: #744210; text-transform: uppercase; font-size: 10.5px;">Durasi Pend.</th>
                                    <th style="padding: 8px 12px; font-weight: 700; color: #744210; text-transform: uppercase; font-size: 10.5px; text-align: right;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pendingSouvenirs as $ps)
                                    <tr style="border-bottom: 1px solid rgba(217, 119, 6, 0.1); background: transparent;">
                                        <td style="padding: 8px 12px; font-family: 'DM Mono', monospace; font-weight: 600; color: #003B64;">{{ $ps['application_number'] }}</td>
                                        <td style="padding: 8px 12px;">
                                            <div style="font-weight: 700;">{{ $ps['pemilik'] }}</div>
                                        </td>
                                        <td style="padding: 8px 12px; font-weight: 500;">{{ $ps['type_label'] }}</td>
                                        <td style="padding: 8px 12px;">
                                            <span style="background: #FEF2F2; color: #991B1B; padding: 2px 6px; border-radius: 4px; font-weight: 700; font-size: 10.5px; border: 1px solid #FCA5A5;">
                                                {{ $ps['days'] }} Hari
                                            </span>
                                        </td>
                                        <td style="padding: 8px 12px; text-align: right;">
                                            <form action="{{ route('souvenir.mark_sent', [$ps['type_key'], $ps['id']]) }}" method="POST" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin souvenir untuk permohonan {{ $ps['application_number'] }} telah diserahkan?')">
                                                @csrf
                                                <button type="submit" style="background: #F59E0B; color: #fff; border: none; padding: 4px 8px; border-radius: 4px; font-size: 11px; font-weight: 700; cursor: pointer;">
                                                    Tandai Terkirim
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

            <!-- Clean Executive KPI Row -->
            <div class="kpi-row" style="margin-bottom: 20px;">
                <div class="kpi-card" style="box-shadow: 0 2px 6px rgba(0,38,66,0.02); border-radius: 6px; padding: 16px 18px;">
                    <div class="kpi-top">
                        <span class="kpi-label" style="font-size: 11px; letter-spacing: 0.05em; color: #64748B;">TOTAL PERMOHONAN</span>
                        <div class="kpi-icon blue" style="border-radius: 4px; width: 30px; height: 30px;">
                            <svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                        </div>
                    </div>
                    <div class="kpi-number" style="font-size: 24px; font-weight: 800; color: #0F172A;">{{ $totalPermohonan ?? 0 }}</div>
                    <div class="kpi-sub" style="font-size: 11px; color: #94A3B8;">Semua jenis berkas</div>
                </div>

                <div class="kpi-card" style="box-shadow: 0 2px 6px rgba(0,38,66,0.02); border-radius: 6px; padding: 16px 18px;">
                    <div class="kpi-top">
                        <span class="kpi-label" style="font-size: 11px; letter-spacing: 0.05em; color: #D97706;">BELUM BAYAR / VERIFIKASI</span>
                        <div class="kpi-icon yellow" style="border-radius: 4px; width: 30px; height: 30px; background: #FEF3C7; color: #D97706;">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                    </div>
                    <div class="kpi-number" style="font-size: 24px; font-weight: 800; color: #D97706;">{{ $totalUnpaid ?? 0 }}</div>
                    <div class="kpi-sub" style="font-size: 11px; color: #94A3B8;">Menunggu SPS / Bayar</div>
                </div>

                <div class="kpi-card" style="box-shadow: 0 2px 6px rgba(0,38,66,0.02); border-radius: 6px; padding: 16px 18px;">
                    <div class="kpi-top">
                        <span class="kpi-label" style="font-size: 11px; letter-spacing: 0.05em; color: #2563EB;">SEDANG DIPROSES (LUNAS)</span>
                        <div class="kpi-icon blue" style="border-radius: 4px; width: 30px; height: 30px; background: #EFF6FF; color: #2563EB;">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>
                        </div>
                    </div>
                    <div class="kpi-number" style="font-size: 24px; font-weight: 800; color: #2563EB;">{{ $totalPending ?? 0 }}</div>
                    <div class="kpi-sub" style="font-size: 11px; color: #94A3B8;">Proses kajian instansi</div>
                </div>

                <div class="kpi-card" style="box-shadow: 0 2px 6px rgba(0,38,66,0.02); border-radius: 6px; padding: 16px 18px;">
                    <div class="kpi-top">
                        <span class="kpi-label" style="font-size: 11px; letter-spacing: 0.05em; color: #16A34A;">DISETUJUI</span>
                        <div class="kpi-icon green" style="border-radius: 4px; width: 30px; height: 30px; background: #DCFCE7; color: #16A34A;">
                            <svg viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                        </div>
                    </div>
                    <div class="kpi-number" style="font-size: 24px; font-weight: 800; color: #16A34A;">{{ $totalDisetujui ?? 0 }}</div>
                    <div class="kpi-sub" style="font-size: 11px; color: #94A3B8;">Permohonan selesai</div>
                </div>

                <div class="kpi-card" style="box-shadow: 0 2px 6px rgba(0,38,66,0.02); border-radius: 6px; padding: 16px 18px;">
                    <div class="kpi-top">
                        <span class="kpi-label" style="font-size: 11px; letter-spacing: 0.05em; color: #DC2626;">DITOLAK</span>
                        <div class="kpi-icon red" style="border-radius: 4px; width: 30px; height: 30px; background: #FEE2E2; color: #DC2626;">
                            <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
                        </div>
                    </div>
                    <div class="kpi-number" style="font-size: 24px; font-weight: 800; color: #DC2626;">{{ $totalDitolak ?? 0 }}</div>
                    <div class="kpi-sub" style="font-size: 11px; color: #94A3B8;">Perlu perbaikan/ditolak</div>
                </div>
            </div>

            @if(!Auth::user()->isPelakuUsaha())
            <!-- ── SLA PENGENDALIAN INTERNAL (CLEAN INTEGRATED ROW) ──────────────────── -->
            <div class="sla-panel">
                <div class="sla-panel-left">
                    <div class="sla-icon">
                        <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    </div>
                    <div>
                        <div class="sla-title">Pengendalian SLA — Berkas Aktif</div>
                        <div class="sla-sub">Total berkas berjalan: <strong>{{ $slaHijau + $slaKuning + $slaMerah }} berkas</strong></div>
                    </div>
                </div>

                <div class="sla-badges">
                    {{-- Hijau --}}
                    <div class="sla-badge green">
                        <span class="sla-dot" style="background: #10B981;"></span>
                        <span style="font-size: 12px; font-weight: 600; color: #065F46;">Aman: <strong style="font-size: 12.5px; font-weight: 800;">{{ $slaHijau }}</strong></span>
                    </div>

                    {{-- Kuning --}}
                    <div class="sla-badge yellow">
                        <span class="sla-dot" style="background: #F59E0B;"></span>
                        <span style="font-size: 12px; font-weight: 600; color: #92400E;">Mendekati Batas: <strong style="font-size: 12.5px; font-weight: 800;">{{ $slaKuning }}</strong></span>
                    </div>

                    {{-- Merah --}}
                    <div class="sla-badge red">
                        <span class="sla-dot" style="background: #EF4444;"></span>
                        <span style="font-size: 12px; font-weight: 600; color: #991B1B;">Terlambat: <strong style="font-size: 12.5px; font-weight: 800;">{{ $slaMerah }}</strong></span>
                    </div>
                </div>
            </div>
            @endif

            <!-- Two-column grid -->
            <div class="grid-2col" {!! Auth::user()->isPelakuUsaha() ? 'style="grid-template-columns: 1fr;"' : '' !!}>

                <!-- Left: Service modules + Recent activity -->
                <div style="display:flex;flex-direction:column;gap:20px;">


                    <!-- Recent Activity -->
                    <div class="panel">
                        <div class="panel-head">
                            <h2>Aktivitas Terkini</h2>
                            <span style="font-size: 12px; color: var(--muted); font-weight: 500;">5 Permohonan Terbaru</span>
                        </div>
                        <div class="activity-list">
                            @forelse($recentActivities as $activity)
                                <a href="{{ $activity->url }}" class="activity-item" style="text-decoration: none; display: flex; align-items: center;">
                                    <span class="activity-dot {{ $activity->status_color }}"></span>
                                    <div class="activity-body" style="margin-left: 10px;">
                                        <div class="activity-title" style="font-weight: 700; color: #003B64;">{{ $activity->title }}</div>
                                        <div class="activity-meta">{{ $activity->type }} · {{ $activity->created_at->diffForHumans() }}</div>
                                    </div>
                                    <span class="activity-status status-{{ $activity->status_key }}">
                                        {{ $activity->status_label }}
                                    </span>
                                </a>
                            @empty
                                <div class="activity-item" style="padding:24px 18px;justify-content:center;flex-direction:column;text-align:center;gap:8px;">
                                    <svg width="32" height="32" fill="none" viewBox="0 0 24 24" stroke="#B3D4EC" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                                    <span style="font-size:13px;color:var(--muted);">Belum ada aktivitas permohonan.</span>
                                </div>
                            @endforelse
                        </div>
                    </div>

                </div>

                <!-- Right Column -->
                <div class="right-col" style="display:flex;flex-direction:column;gap:20px;">

                    <!-- Status Overview -->
                    @if(!Auth::user()->isPelakuUsaha())
                    <div class="panel">
                        <div class="panel-head">
                            <h2>Status Permohonan</h2>
                        </div>
                        <div class="activity-list">
                            @php
                                $total = max(($totalPermohonan ?? 1), 1);
                                $statuses = [
                                    ['label' => 'Disetujui',                'value' => $totalDisetujui ?? 0, 'color' => 'green'],
                                    ['label' => 'Sedang Diproses (Lunas)',  'value' => $totalPending ?? 0,   'color' => 'blue'],
                                    ['label' => 'Belum Bayar',              'value' => $totalUnpaid ?? 0,    'color' => 'yellow'],
                                    ['label' => 'Ditolak',                  'value' => $totalDitolak ?? 0,   'color' => 'red'],
                                ];
                            @endphp
                            @foreach($statuses as $s)
                                <div class="progress-item">
                                    <div class="progress-head">
                                        <span>{{ $s['label'] }}</span>
                                        <strong>{{ $s['value'] }}</strong>
                                    </div>
                                    <div class="progress-bar">
                                        <div class="progress-fill {{ $s['color'] }}" style="width: {{ $total > 0 ? round($s['value']/$total*100) : 0 }}%"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Upcoming Schedule -->
                    <div class="panel">
                        <div class="panel-head">
                            <h2>Jadwal Konsultasi</h2>
                            <a href="{{ route('lapolpa.index') }}" class="panel-head-link">Kelola →</a>
                        </div>
                        @php
                            if (Auth::user()->isBpn() || Auth::user()->isDpn() || Auth::user()->role === 'admin') {
                                $upcomingSchedules = \App\Models\LapolpaBooking::whereIn('status', ['booked', 'diterima'])
                                    ->orderBy('booking_date', 'asc')
                                    ->take(5)
                                    ->get();
                            } else {
                                $upcomingSchedules = \App\Models\LapolpaBooking::where('user_id', Auth::id())
                                    ->whereIn('status', ['booked', 'diterima'])
                                    ->orderBy('booking_date', 'asc')
                                    ->take(5)
                                    ->get();
                            }
                        @endphp
                        @if(isset($upcomingSchedules) && $upcomingSchedules->count())
                            <div class="activity-list">
                                @foreach($upcomingSchedules as $sched)
                                    <div class="schedule-item">
                                        <div class="schedule-date-box">
                                            <span class="day">{{ Carbon\Carbon::parse($sched->booking_date)->format('d') }}</span>
                                            <span class="month">{{ Carbon\Carbon::parse($sched->booking_date)->format('M') }}</span>
                                        </div>
                                        <div class="schedule-info">
                                            <h4>{{ $sched->nama_pemohon ?? ($sched->user->name ?? 'Tamu') }}</h4>
                                            <span>{{ $sched->formatted_time_range }} · LAPOL PAK ({{ ucfirst($sched->status) }})</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="schedule-empty">
                                <svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                                <p>Belum ada jadwal konsultasi terdaftar.</p>
                                <a href="{{ route('lapolpa.index') }}" class="btn-primary">
                                    <svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                                    Pesan Jadwal
                                </a>
                            </div>
                        @endif
                    </div>

                </div>
            </div>
            @endif

        </div><!-- /content -->
    </div><!-- /main-wrap -->

    <script>
        const d = new Date();
        const opts = { weekday:'long', year:'numeric', month:'long', day:'numeric' };
        document.getElementById('current-date').textContent = d.toLocaleDateString('id-ID', opts);

        // Maintain sidebar scroll position
        document.addEventListener("DOMContentLoaded", function() {
            const sidebar = document.querySelector('.sidebar');
            if (sidebar) {
                const scrollPos = sessionStorage.getItem('sidebarScrollPos');
                if (scrollPos) {
                    sidebar.scrollTop = parseInt(scrollPos, 10);
                }
                sidebar.addEventListener('scroll', function() {
                    sessionStorage.setItem('sidebarScrollPos', sidebar.scrollTop);
                });
            }
        });

        // Global Sidebar Toggle Functions for Mobile
        window.toggleSidebar = function() {
            const sb = document.getElementById('sidebar') || document.querySelector('.sidebar');
            const bd = document.getElementById('sidebar-backdrop');
            if (sb) sb.classList.toggle('open');
            if (bd) bd.classList.toggle('show');
        };

        window.closeSidebar = function() {
            const sb = document.getElementById('sidebar') || document.querySelector('.sidebar');
            const bd = document.getElementById('sidebar-backdrop');
            if (sb) sb.classList.remove('open');
            if (bd) bd.classList.remove('show');
        };

        const bd = document.getElementById('sidebar-backdrop');
        if (bd) {
            bd.addEventListener('click', window.closeSidebar);
        }
    </script>

</body>
</html>