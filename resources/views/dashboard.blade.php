<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pelaku Usaha — PATEN PAK MIKO</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>

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
            --r-sm:      4px;
            --r-md:      4px;
            --r-lg:      8px;
            --r-xl:      12px;
            --sidebar:   248px;
        }

        html {
            overflow-x: clip;
        }

        html::-webkit-scrollbar {
            width: 7px;
            height: 7px;
        }
        html::-webkit-scrollbar-track,
        html::-webkit-scrollbar-track-piece {
            background: #E8F2FA;
        }
        html::-webkit-scrollbar-thumb {
            background: #94B8D4;
            border-radius: 2px;
        }
        html::-webkit-scrollbar-thumb:hover {
            background: #218AC9;
        }
        html::-webkit-scrollbar-button,
        html::-webkit-scrollbar-corner {
            display: none;
            width: 0;
            height: 0;
        }

        body {
            min-height: 100vh;
            font-family: 'Poppins', sans-serif;
            background: var(--surface);
            color: var(--ink);
            -webkit-font-smoothing: antialiased;
            display: flex;
        }

        /* ─── SIDEBAR CSS DI-HANDLE PARTIAL sidebar.blade.php ─── */

        /* ─── MAIN AREA ──────────────────────── */
        .main-wrap {
            margin-left: var(--sidebar);
            flex: 1; display: flex; flex-direction: column;
            min-height: 100vh;
            min-width: 0;
            transition: margin-left .2s ease;
        }



        /* ─── CONTENT ──────────────────────────────────────── */
        .content {
            padding: 24px 28px;
            flex: 1;
            background: #F4F7FA;
        }

        .alert-success {
            background: #E6F4EA;
            border: 1px solid #B8E2C8;
            color: #137333;
            padding: 12px 16px;
            border-radius: 4px;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* ─── KPI CARDS ─────────────────────────────────────── */
        @keyframes dashFadeUp {
            from { opacity: 0; transform: translateY(8px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .kpi-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(175px, 1fr));
            gap: 14px;
            margin-bottom: 18px;
        }
        .kpi-card {
            background: #FFFFFF;
            border: 1px solid #D6E4EF;
            border-radius: 4px;
            padding: 16px 18px;
            transition: transform .16s ease, border-color .16s ease, background-color .16s ease;
            animation: dashFadeUp .26s cubic-bezier(0.22, 1, 0.36, 1) both;
        }
        .kpi-row .kpi-card:nth-child(1) { animation-delay: .03s; }
        .kpi-row .kpi-card:nth-child(2) { animation-delay: .06s; }
        .kpi-row .kpi-card:nth-child(3) { animation-delay: .09s; }
        .kpi-row .kpi-card:nth-child(4) { animation-delay: .12s; }
        .kpi-row .kpi-card:nth-child(5) { animation-delay: .15s; }
        .kpi-card:hover {
            transform: translateY(-2px);
            border-color: #94B8D4;
        }

        .kpi-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
            margin-bottom: 12px;
        }
        .kpi-label {
            font-size: 11px;
            font-weight: 700;
            color: #64748B;
            text-transform: uppercase;
            letter-spacing: .05em;
        }
        .kpi-icon {
            width: 30px; height: 30px;
            border-radius: 4px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
            transition: transform .18s ease;
        }
        .kpi-card:hover .kpi-icon {
            transform: scale(1.06);
        }
        .kpi-icon svg {
            width: 16px; height: 16px;
            fill: none; stroke: currentColor;
            stroke-width: 2; stroke-linecap: round; stroke-linejoin: round;
        }
        .kpi-icon.navy   { background: #EEF4FA; color: #003B64; }
        .kpi-icon.blue   { background: #E3F0F9; color: #218AC9; }
        .kpi-icon.yellow { background: #FEF3C7; color: #D97706; }
        .kpi-icon.green  { background: #DCFCE7; color: #16A34A; }
        .kpi-icon.red    { background: #FEE2E2; color: #DC2626; }

        .kpi-number {
            font-size: 26px;
            font-weight: 800;
            color: #003B64;
            letter-spacing: -.03em;
            line-height: 1;
            font-variant-numeric: tabular-nums;
        }

        /* ─── OVERVIEW GRID (PROPORTIONAL 2-COL) ────────────── */
        .grid-overview {
            display: grid;
            grid-template-columns: minmax(0, 7fr) minmax(0, 5fr);
            gap: 18px;
            align-items: stretch;
            margin-bottom: 18px;
        }
        .grid-overview > .panel {
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        /* ─── PANEL ──────────────────────────────────────────── */
        .panel {
            background: #FFFFFF;
            border: 1px solid #D6E4EF;
            border-radius: 4px;
            min-width: 0;
            overflow: hidden;
            transition: border-color .16s ease;
            animation: dashFadeUp .28s cubic-bezier(0.22, 1, 0.36, 1) .14s both;
        }
        .grid-overview > .panel:nth-child(2) {
            animation-delay: .18s;
        }
        .panel-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 6px;
            padding: 13px 18px;
            border-bottom: 1px solid #D6E4EF;
            background: #F8FAFC;
        }
        .panel-head h2 {
            font-size: 14px;
            font-weight: 800;
            color: #003B64;
        }
        .panel-head-meta {
            font-size: 11.5px;
            font-weight: 600;
            color: #64748B;
        }
        .panel-head-link {
            font-size: 12px;
            font-weight: 700;
            color: var(--blue);
            text-decoration: none;
        }
        .panel-head-link:hover {
            text-decoration: underline;
        }
        .panel-body-chart {
            padding: 16px 18px;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            gap: 14px;
        }
        .chart-wrap {
            position: relative;
            width: 100%;
            height: 220px;
        }
        .review-summary-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 10px 12px;
            padding: 12px 14px;
            background: #F8FAFC;
            border: 1px solid #E2E8F0;
            border-radius: 4px;
        }
        .review-score-group {
            display: flex;
            align-items: baseline;
            gap: 6px;
        }
        .review-score-big {
            font-size: 26px;
            font-weight: 800;
            color: #003B64;
            line-height: 1;
        }
        .review-score-max {
            font-size: 12px;
            font-weight: 600;
            color: #64748B;
        }
        .review-meta-right {
            text-align: right;
            font-size: 11.5px;
            color: #475569;
            line-height: 1.45;
        }
        .review-meta-right strong {
            color: #003B64;
            font-weight: 700;
        }

        /* ─── ACTIVITY PANEL ─────────────────────────────────── */
        .activity-list { padding: 0; }
        .activity-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 13px 18px;
            border-bottom: 1px solid #E8F0F6;
            transition: background .15s ease, padding-left .16s ease;
        }
        .activity-item:last-child { border-bottom: none; }
        a.activity-item:hover { background: #F8FAFC; padding-left: 22px; }
        a.activity-item:active { background: #F1F5F9; }

        .activity-body {
            flex: 1;
            min-width: 0;
        }
        .activity-title {
            font-size: 13px;
            font-weight: 700;
            color: #003B64;
            margin-bottom: 2px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .activity-meta {
            font-size: 11.5px;
            color: #64748B;
        }
        .activity-status {
            flex-shrink: 0;
            font-size: 11px;
            font-weight: 700;
            padding: 4px 8px;
            border-radius: 4px;
        }
        .status-pending,
        .status-unpaid   { background: #FEF3C7; color: #92400E; }
        .status-review   { background: #E3F0F9; color: #003B64; }
        .status-approved { background: #DCFCE7; color: #166534; }
        .status-rejected { background: #FEE2E2; color: #991B1B; }

        /* ─── QUICK STATS SIDEBAR ────────────────────────────── */
        .right-col { display: flex; flex-direction: column; gap: 18px; }

        .progress-item {
            padding: 14px 18px;
            border-bottom: 1px solid #E8F0F6;
        }
        .progress-item:last-child { border-bottom: none; }
        .progress-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 8px;
        }
        .progress-head span { font-size: 12.5px; font-weight: 600; color: #003B64; }
        .progress-head strong { font-size: 12.5px; font-weight: 700; color: #334155; }
        .progress-bar {
            height: 6px;
            border-radius: 2px;
            background: #E8F2FA;
            overflow: hidden;
        }
        .progress-fill {
            height: 100%;
            border-radius: 2px;
            transition: width .4s ease;
        }
        .progress-fill.blue   { background: #218AC9; }
        .progress-fill.green  { background: #16A34A; }
        .progress-fill.yellow { background: #D97706; }
        .progress-fill.red    { background: #DC2626; }

        .btn-primary, .btn-complete-profile {
            transition: background .16s ease, border-color .16s ease, transform .1s ease;
        }
        .btn-primary:active, .btn-complete-profile:active, .panel-head-link:active {
            transform: scale(0.98);
        }

        /* ─── CALENDAR / SCHEDULE PANEL ─────────────────────── */
        .schedule-empty {
            padding: 26px 18px;
            text-align: center;
        }
        .schedule-empty svg {
            width: 34px; height: 34px;
            fill: none; stroke: var(--blue-md);
            stroke-width: 1.5; stroke-linecap: round;
            margin-bottom: 10px;
        }
        .schedule-empty p {
            font-size: 12.5px;
            color: #64748B;
            margin-bottom: 12px;
        }
        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #003B64;
            color: #fff;
            border: none;
            padding: 8px 14px;
            border-radius: 4px;
            font-family: inherit;
            font-size: 12.5px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
        }
        .btn-primary:hover { background: #218AC9; }
        .btn-primary svg { width: 14px; height: 14px; fill: none; stroke: #fff; stroke-width: 2.5; }

        .schedule-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 18px;
            border-bottom: 1px solid #E8F0F6;
        }
        .schedule-item:last-child { border-bottom: none; }
        .schedule-date-box {
            width: 40px; height: 42px;
            border-radius: 4px;
            background: #E3F0F9;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .schedule-date-box .day {
            font-size: 16px;
            font-weight: 800;
            color: #003B64;
            line-height: 1;
        }
        .schedule-date-box .month {
            font-size: 9px;
            font-weight: 700;
            color: #64748B;
            text-transform: uppercase;
        }
        .schedule-info h4 { font-size: 13px; font-weight: 700; color: #003B64; margin-bottom: 2px; }
        .schedule-info span { font-size: 11.5px; color: #64748B; }

        /* ─── WELCOME / HERO CARD ───────────────────────────── */
        .welcome-card {
            background: #FFFFFF;
            border: 1px solid #D6E4EF;
            border-radius: 4px;
            padding: 14px 20px;
            margin-bottom: 18px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: wrap;
            animation: dashFadeUp .22s cubic-bezier(0.22, 1, 0.36, 1) both;
        }
        .welcome-card-left {
            display: flex;
            align-items: center;
            gap: 14px;
            min-width: 0;
        }
        .welcome-avatar {
            width: 42px; height: 42px;
            border-radius: 4px;
            object-fit: cover;
            flex-shrink: 0;
            border: 1px solid #D6E4EF;
        }
        .welcome-avatar-fallback {
            width: 42px; height: 42px;
            border-radius: 4px;
            background: #003B64;
            color: #fff; font-weight: 800; font-size: 15px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .welcome-card-title {
            font-size: 17px; font-weight: 800; color: #003B64;
            letter-spacing: -0.02em; margin: 0 0 2px;
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
            background: #FEF3C7; border: 1px solid #F59E0B; color: #92400E;
            padding: 6px 12px; border-radius: 4px; font-size: 12px; font-weight: 700;
            text-decoration: none; white-space: nowrap;
        }
        .btn-complete-profile:hover { background: #FDE68A; }

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
        @media (max-width: 1024px) {
            .grid-overview {
                grid-template-columns: 1fr !important;
            }
        }

        @media (max-width: 768px) {
            body { display: block; }
            .btn-menu { display: block; margin-right: 12px; }
            .btn-close-sidebar-mobile { display: flex; align-items: center; justify-content: center; }
            .sidebar-backdrop { z-index: 999; }
            .sidebar-backdrop.show { display: block; opacity: 1; pointer-events: auto; }
            .main-wrap {
                margin-left: 0 !important;
                width: 100% !important;
                max-width: 100% !important;
                min-width: 0;
            }
            .content { padding: 14px; }

            /* KPI cards → Grid 2 kolom rapi di HP */
            .kpi-row {
                display: grid !important;
                grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
                gap: 10px !important;
                margin-bottom: 16px !important;
            }
            .kpi-card:first-child {
                grid-column: 1 / -1;
            }
            .kpi-card {
                padding: 14px !important;
                border-radius: 4px !important;
            }
            .kpi-number { font-size: 22px !important; }
            .kpi-label { font-size: 10.5px !important; }

            .chart-wrap {
                height: 200px;
            }

            /* Panel head & activity items rapetin & rapih di HP */
            .panel-head { padding: 14px 16px; }
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
                padding: 4px 8px !important;
                border-radius: 4px !important;
                margin-top: 2px !important;
            }

            /* Welcome card */
            .welcome-card { padding: 16px; gap: 12px; }
            .welcome-card-left { width: 100%; }
            .welcome-card-right { width: 100%; justify-content: flex-start; }
            .welcome-card-title { font-size: 16px; }

            /* Berita list item (admin) jadi vertical */
            .berita-item { flex-direction: column !important; align-items: flex-start !important; }
            .berita-item img, .berita-item .berita-thumb-empty { width: 100% !important; height: 160px !important; margin-bottom: 10px; }
            .berita-item .activity-body { margin-left: 0 !important; }
            .berita-item .activity-status { margin-top: 8px; }

            /* Warning table souvenir: font lebih kecil biar muat di scroll horizontal */
            .alert-warning table { font-size: 11px !important; }
            .alert-warning th, .alert-warning td { padding: 6px 8px !important; }
        }

        @media (max-width: 640px) {
            .chart-wrap-services {
                height: 250px !important;
            }
            .panel-body-chart {
                padding: 14px;
            }
        }

        @media (max-width: 420px) {
            .content { padding: 12px; }
            .welcome-card-title { font-size: 15px !important; }
            .btn-complete-profile { font-size: 11px !important; padding: 5px 10px !important; }
            .review-meta-right { text-align: left; width: 100%; }
        }

        @media (prefers-reduced-motion: reduce) {
            .welcome-card, .kpi-card, .panel {
                animation: none !important;
            }
            .kpi-card:hover {
                transform: none !important;
            }
            .kpi-card:hover .kpi-icon {
                transform: none !important;
            }
            a.activity-item:hover {
                padding-left: 18px !important;
            }
        }

        .chart-wrap-reviews {
            height: 155px;
        }

        /* ─── DESKTOP SINGLE-VIEWPORT FIT (1025px+) ─────────── */
        @media (min-width: 1025px) and (min-height: 560px) {
            .main-wrap {
                height: 100dvh;
                overflow: hidden;
            }
            .main-wrap:has(.alert-warning, .berita-item) {
                height: auto;
                min-height: 100dvh;
                overflow: visible;
            }
            .content {
                flex: 1;
                min-height: 0;
                display: flex;
                flex-direction: column;
                gap: clamp(8px, 1.25vh, 14px);
                padding: clamp(10px, 1.5vh, 18px) clamp(16px, 2vw, 24px);
                overflow: hidden;
            }
            .main-wrap:has(.alert-warning, .berita-item) .content {
                overflow: visible;
            }
            .alert-success {
                padding: 8px 14px;
                margin-bottom: 0;
                flex-shrink: 0;
                font-size: 12px;
            }
            .welcome-card {
                margin-bottom: 0;
                padding: clamp(8px, 1.05vh, 13px) 16px;
                flex-shrink: 0;
            }
            .welcome-avatar,
            .welcome-avatar-fallback {
                width: clamp(34px, 4.4vh, 42px);
                height: clamp(34px, 4.4vh, 42px);
            }
            .welcome-card-title {
                font-size: clamp(14.5px, 1.95vh, 17px);
                margin-bottom: 1px;
            }
            .welcome-card-sub {
                font-size: clamp(11px, 1.4vh, 12.5px);
            }
            .kpi-row {
                margin-bottom: 0;
                gap: clamp(10px, 1vw, 14px);
                flex-shrink: 0;
            }
            .kpi-card {
                padding: clamp(9px, 1.2vh, 14px) 14px;
            }
            .kpi-top {
                margin-bottom: clamp(4px, 0.7vh, 10px);
            }
            .kpi-icon {
                width: clamp(26px, 3.3vh, 30px);
                height: clamp(26px, 3.3vh, 30px);
            }
            .kpi-number {
                font-size: clamp(20px, 2.7vh, 26px);
            }
            .grid-overview {
                margin-bottom: 0;
                gap: clamp(12px, 1.2vw, 16px);
                min-height: 0;
            }
            .grid-overview--charts {
                flex: 1.08;
            }
            .grid-overview--activity {
                flex: 1;
            }
            .grid-overview > .panel {
                min-height: 0;
            }
            .panel-head {
                padding: clamp(7px, 0.95vh, 11px) 15px;
                flex-shrink: 0;
            }
            .panel-head h2 {
                font-size: clamp(12.5px, 1.55vh, 14px);
            }
            .panel-body-chart {
                padding: clamp(8px, 1.1vh, 14px) 15px;
                flex: 1;
                min-height: 0;
                gap: clamp(6px, 0.9vh, 10px);
            }
            .chart-wrap,
            .chart-wrap-services,
            .chart-wrap-reviews {
                flex: 1;
                min-height: 92px;
                height: auto !important;
            }
            .review-summary-bar {
                padding: clamp(6px, 0.85vh, 10px) 12px;
                flex-shrink: 0;
            }
            .review-score-big {
                font-size: clamp(19px, 2.4vh, 25px);
            }
            .activity-list {
                flex: 1;
                min-height: 0;
                overflow-y: auto;
            }
            .activity-list::-webkit-scrollbar {
                width: 5px;
            }
            .activity-list::-webkit-scrollbar-track {
                background: transparent;
            }
            .activity-list::-webkit-scrollbar-thumb {
                background: #CBD5E1;
                border-radius: 2px;
            }
            .activity-list::-webkit-scrollbar-thumb:hover {
                background: #94B8D4;
            }
            .activity-item,
            .schedule-item {
                padding: clamp(7px, 0.95vh, 11px) 15px;
            }
            .schedule-empty {
                flex: 1;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                padding: clamp(10px, 1.5vh, 20px);
            }
            .schedule-empty svg {
                width: clamp(26px, 3.2vh, 34px);
                height: clamp(26px, 3.2vh, 34px);
                margin-bottom: 6px;
            }
            .schedule-empty p {
                margin-bottom: 8px;
            }
        }

    </style>
</head>
<body>

    <!-- ─── SIDEBAR ─────────────────────────────── -->
    <div class="sidebar-backdrop" id="sidebar-backdrop"></div>
    @include('layouts.partials.sidebar')

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
                $isProfileIncomplete = $user->isPelakuUsaha()
                    ? (empty($user->name) || empty($user->email) || empty($user->address) || empty($user->business_name) || empty($user->business_role))
                    : (empty($user->name) || empty($user->email));

                // --- Kalkulasi Statistik Terpadu Across 5 Layanan ---
                $serviceModels = [
                    ['class' => \App\Models\PpkprBerusahaApplication::class, 'label' => 'PKKPR Berusaha',     'short' => 'Berusaha',     'route' => 'berusaha.show'],
                    ['class' => \App\Models\PpkprApplication::class,        'label' => 'PKKPR Non Berusaha', 'short' => 'Non Berusaha', 'route' => 'non-berusaha.show'],
                    ['class' => \App\Models\KebijakanApplication::class,    'label' => 'Kebijakan',          'short' => 'Kebijakan',    'route' => 'kebijakan.show'],
                    ['class' => \App\Models\TanahTimbulApplication::class,  'label' => 'Tanah Timbul',       'short' => 'Tanah Timbul', 'route' => 'tanah-timbul.show'],
                    ['class' => \App\Models\PsnApplication::class,          'label' => 'PSN',                'short' => 'PSN',          'route' => 'psn.show'],
                ];

                $totalPermohonan = 0;
                $totalUnpaid = 0;
                $totalPending = 0;
                $totalDisetujui = 0;
                $totalDitolak = 0;
                $serviceChartLabels = [];
                $serviceChartCounts = [];
                $recentActivities = collect();

                foreach ($serviceModels as $svc) {
                    $baseQuery = $svc['class']::query();
                    if ($user->isPelakuUsaha()) {
                        $baseQuery->where('user_id', $user->id);
                    }

                    $svcTotal = (clone $baseQuery)->count();
                    $svcUnpaid = (clone $baseQuery)
                        ->whereNotIn('status', ['disetujui', 'terbit_pkpr', 'ditolak'])
                        ->where(function ($q) {
                            $q->whereNull('bpn_pembayaran_status')
                              ->orWhere('bpn_pembayaran_status', '!=', 'sudah_bayar');
                        })
                        ->count();
                    $svcPending = (clone $baseQuery)
                        ->whereNotIn('status', ['disetujui', 'terbit_pkpr', 'ditolak'])
                        ->where('bpn_pembayaran_status', 'sudah_bayar')
                        ->count();
                    $svcDisetujui = (clone $baseQuery)
                        ->whereIn('status', ['disetujui', 'terbit_pkpr'])
                        ->count();
                    $svcDitolak = (clone $baseQuery)
                        ->where('status', 'ditolak')
                        ->count();

                    $totalPermohonan += $svcTotal;
                    $totalUnpaid += $svcUnpaid;
                    $totalPending += $svcPending;
                    $totalDisetujui += $svcDisetujui;
                    $totalDitolak += $svcDitolak;

                    $serviceChartLabels[] = $svc['short'];
                    $serviceChartCounts[] = $svcTotal;

                    $recentQuery = (clone $baseQuery)->with('user')->where('bpn_pembayaran_status', 'sudah_bayar');
                    foreach ($recentQuery->latest()->take(5)->get() as $item) {
                        $statusKey = 'pending';
                        if (in_array($item->status, ['disetujui', 'terbit_pkpr'])) {
                            $statusKey = 'approved';
                        } elseif ($item->status === 'ditolak') {
                            $statusKey = 'rejected';
                        } elseif ($item->bpn_pembayaran_status === 'sudah_bayar') {
                            $statusKey = 'review';
                        } else {
                            $statusKey = 'unpaid';
                        }

                        $recentActivities->push((object)[
                            'id'           => $item->id,
                            'title'        => ($item->nama_pemilik_usaha ?? ($item->user->name ?? $item->user->username)) . ' (' . ($item->application_number ?? 'No. Berkas #' . $item->id) . ')',
                            'type'         => $svc['label'],
                            'created_at'   => $item->created_at,
                            'status_key'   => $statusKey,
                            'status_label' => $item->status_label,
                            'url'          => route($svc['route'], $item->id),
                        ]);
                    }
                }

                $recentActivities = $recentActivities->sortByDesc('created_at')->take(5);

                // --- Tambahkan layanan non-Pertek (LAPOL PAK & INFORMAL) ke grafik overview ---
                $lapolpaCount = $user->isPelakuUsaha()
                    ? \App\Models\LapolpaBooking::where('user_id', $user->id)->count()
                    : \App\Models\LapolpaBooking::count();
                $informalCount = $user->isPelakuUsaha()
                    ? \App\Models\InformalRating::where('user_id', $user->id)->count()
                    : \App\Models\InformalRating::count();

                $serviceChartLabels[] = 'LAPOL PAK';
                $serviceChartCounts[] = $lapolpaCount;
                $serviceChartLabels[] = 'INFORMAL';
                $serviceChartCounts[] = $informalCount;
                $totalSeluruhLayanan = $totalPermohonan + $lapolpaCount + $informalCount;

                // --- Overview Ulasan & Kepuasan Layanan ---
                $reviewQuery = \App\Models\Review::query();
                $informalQuery = \App\Models\InformalRating::query();
                if ($user->isPelakuUsaha()) {
                    $reviewQuery->where('is_approved', true);
                    $informalQuery->where('is_approved', true);
                }

                $allReviews = (clone $reviewQuery)->select('rating', 'is_approved')->get();
                $allInformal = (clone $informalQuery)->select('rating', 'is_approved')->get();
                $combinedRatings = $allReviews->concat($allInformal);

                $reviewTotal = $combinedRatings->count();
                $reviewApproved = $combinedRatings->where('is_approved', true)->count();
                $reviewPending = $reviewTotal - $reviewApproved;
                $reviewAverage = $reviewTotal > 0 ? round($combinedRatings->avg('rating'), 1) : 0;

                $ratingStars = [5, 4, 3, 2, 1];
                $ratingDist = [];
                foreach ($ratingStars as $star) {
                    $ratingDist[] = $combinedRatings->where('rating', $star)->count();
                }

                if (!$user->isPelakuUsaha()) {
                    // --- Kalkulasi Pending Souvenirs (> 10 hari kerja SLA Pertek) ---
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
                            $startDate = $app->tgl_mulai_layanan ? \Carbon\Carbon::parse($app->tgl_mulai_layanan) : $app->created_at;
                            $pertekDate = $app->bpn_pertek_uploaded_at ? \Carbon\Carbon::parse($app->bpn_pertek_uploaded_at) : $app->updated_at;
                            $pertekWorkingDays = $startDate->getEffectiveWorkingDayNumber($pertekDate);

                            if ($pertekWorkingDays > 10) {
                                $pendingSouvenirs[] = [
                                    'id'                 => $app->id,
                                    'application_number' => $app->application_number,
                                    'type_label'         => $typeLabels[$typeKey],
                                    'type_key'           => $typeKey,
                                    'pemilik'            => $app->nama_pemilik_usaha ?? ($app->user->name ?? $app->user->username),
                                    'phone'              => $app->user->phone_number ?? '—',
                                    'days'               => $pertekWorkingDays,
                                    'uploaded_at'        => $pertekDate,
                                ];
                            }
                        }
                    }
                }
            @endphp

            <!-- Header Sambutan Flat & Clean -->
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
                        <h1 class="welcome-card-title">Selamat Datang, {{ $user->name ?? $user->username }}</h1>
                        <p class="welcome-card-sub">
                            @if(Auth::user()->isAdminBerita()) Ringkasan publikasi berita dan informasi.
                            @elseif(Auth::user()->isPelakuUsaha()) Ringkasan status permohonan layanan Anda.
                            @else Ringkasan permohonan layanan dan status berkas aktif.
                            @endif
                        </p>
                    </div>
                </div>

                @if($isProfileIncomplete)
                <div class="welcome-card-right">
                    <a href="{{ route('profile') }}" class="btn-complete-profile">
                        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                        Lengkapi Profil
                    </a>
                </div>
                @endif
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
                    <div class="kpi-card is-navy">
                        <div class="kpi-top">
                            <span class="kpi-label">Total Berita</span>
                            <div class="kpi-icon navy">
                                <svg viewBox="0 0 24 24"><path d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l6 6v10a2 2 0 01-2 2z"/></svg>
                            </div>
                        </div>
                        <div class="kpi-number">{{ $totalBerita }}</div>
                    </div>
                    <div class="kpi-card is-green">
                        <div class="kpi-top">
                            <span class="kpi-label">Dipublikasi</span>
                            <div class="kpi-icon green">
                                <svg viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                            </div>
                        </div>
                        <div class="kpi-number" style="color: #16A34A;">{{ $publishedBerita }}</div>
                    </div>
                    <div class="kpi-card is-amber">
                        <div class="kpi-top">
                            <span class="kpi-label">Draft</span>
                            <div class="kpi-icon yellow">
                                <svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                            </div>
                        </div>
                        <div class="kpi-number" style="color: #D97706;">{{ $draftBerita }}</div>
                    </div>
                </div>

                <div class="panel">
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

            <!-- KPI Row Solid & Clean -->
            <div class="kpi-row">
                <div class="kpi-card is-navy">
                    <div class="kpi-top">
                        <span class="kpi-label">Total Permohonan</span>
                        <div class="kpi-icon navy">
                            <svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                        </div>
                    </div>
                    <div class="kpi-number">{{ $totalPermohonan ?? 0 }}</div>
                </div>

                <div class="kpi-card is-amber">
                    <div class="kpi-top">
                        <span class="kpi-label">Belum Bayar</span>
                        <div class="kpi-icon yellow">
                            <svg viewBox="0 0 24 24"><path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                    </div>
                    <div class="kpi-number" style="color: #D97706;">{{ $totalUnpaid ?? 0 }}</div>
                </div>

                <div class="kpi-card is-blue">
                    <div class="kpi-top">
                        <span class="kpi-label">Sedang Diproses</span>
                        <div class="kpi-icon blue">
                            <svg viewBox="0 0 24 24"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>
                        </div>
                    </div>
                    <div class="kpi-number" style="color: #218AC9;">{{ $totalPending ?? 0 }}</div>
                </div>

                <div class="kpi-card is-green">
                    <div class="kpi-top">
                        <span class="kpi-label">Disetujui</span>
                        <div class="kpi-icon green">
                            <svg viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                        </div>
                    </div>
                    <div class="kpi-number" style="color: #16A34A;">{{ $totalDisetujui ?? 0 }}</div>
                </div>

                <div class="kpi-card is-red">
                    <div class="kpi-top">
                        <span class="kpi-label">Ditolak</span>
                        <div class="kpi-icon red">
                            <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
                        </div>
                    </div>
                    <div class="kpi-number" style="color: #DC2626;">{{ $totalDitolak ?? 0 }}</div>
                </div>
            </div>

            <!-- Row 2: Grafik Overview (Permohonan per Layanan & Ulasan Kepuasan) -->
            <div class="grid-overview grid-overview--charts">
                <div class="panel">
                    <div class="panel-head">
                        <h2>Aktivitas Seluruh Layanan</h2>
                        <span class="panel-head-meta">{{ $totalSeluruhLayanan }} Total Data</span>
                    </div>
                    <div class="panel-body-chart">
                        <div class="chart-wrap chart-wrap-services">
                            <canvas id="serviceStatsChart"></canvas>
                        </div>
                    </div>
                </div>

                <div class="panel">
                    <div class="panel-head">
                        <h2>Ulasan & Kepuasan Layanan</h2>
                        @if(Auth::user()->isDpn() || Auth::user()->isBpn() || Auth::user()->isDinasPu() || Auth::user()->isDinasPutr() || Auth::user()->isSatuPintu())
                            <a href="{{ route('admin.reviews.index') }}" class="panel-head-link">Kelola →</a>
                        @else
                            <a href="{{ route('ulasan.index') }}" class="panel-head-link">Lihat →</a>
                        @endif
                    </div>
                    <div class="panel-body-chart">
                        <div class="review-summary-bar">
                            <div class="review-score-group">
                                <span class="review-score-big">{{ number_format($reviewAverage, 1) }}</span>
                                <span class="review-score-max">/ 5.0</span>
                            </div>
                            <div class="review-meta-right">
                                <div><strong>{{ $reviewTotal }}</strong> Total Ulasan</div>
                                @if(!Auth::user()->isPelakuUsaha())
                                    <div>{{ $reviewApproved }} Disetujui · {{ $reviewPending }} Menunggu</div>
                                @else
                                    <div>Indeks Kepuasan Publik</div>
                                @endif
                            </div>
                        </div>
                        <div class="chart-wrap chart-wrap-reviews">
                            <canvas id="reviewRatingChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Row 3: Aktivitas Terkini & Jadwal Konsultasi (Proporsional 7fr : 5fr) -->
            <div class="grid-overview grid-overview--activity">
                <div class="panel">
                    <div class="panel-head">
                        <h2>Aktivitas Terkini</h2>
                        <span class="panel-head-meta">5 Terbaru</span>
                    </div>
                    <div class="activity-list">
                        @forelse($recentActivities as $activity)
                            <a href="{{ $activity->url }}" class="activity-item" style="text-decoration: none;">
                                <div class="activity-body">
                                    <div class="activity-title">{{ $activity->title }}</div>
                                    <div class="activity-meta">{{ $activity->type }} · {{ $activity->created_at->diffForHumans() }}</div>
                                </div>
                                <span class="activity-status status-{{ $activity->status_key }}">
                                    {{ $activity->status_label }}
                                </span>
                            </a>
                        @empty
                            <div class="activity-item" style="padding:24px 18px;justify-content:center;flex-direction:column;text-align:center;gap:8px;">
                                <svg width="30" height="30" fill="none" viewBox="0 0 24 24" stroke="#B3D4EC" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                                <span style="font-size:12.5px;color:#64748B;">Belum ada aktivitas permohonan.</span>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Jadwal Konsultasi -->
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
            @endif

        </div><!-- /content -->
    </div><!-- /main-wrap -->

    @if(!Auth::user()->isAdminBerita())
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (typeof Chart === 'undefined') return;

            const serviceCtx = document.getElementById('serviceStatsChart');
            if (serviceCtx) {
                const isMobileChart = window.innerWidth <= 640;
                new Chart(serviceCtx, {
                    type: 'bar',
                    data: {
                        labels: @json($serviceChartLabels),
                        datasets: [{
                            label: 'Jumlah Layanan',
                            data: @json($serviceChartCounts),
                            backgroundColor: ['#003B64', '#218AC9', '#2C5272', '#475569', '#0284C7', '#D97706', '#16A34A'],
                            borderRadius: 3,
                            barPercentage: isMobileChart ? 0.65 : 0.56
                        }]
                    },
                    options: {
                        indexAxis: isMobileChart ? 'y' : 'x',
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false },
                            tooltip: {
                                backgroundColor: '#003B64',
                                cornerRadius: 4,
                                padding: 10
                            }
                        },
                        scales: {
                            x: {
                                beginAtZero: isMobileChart,
                                grid: { display: isMobileChart, color: '#E8F0F6' },
                                ticks: {
                                    precision: 0,
                                    color: isMobileChart ? '#64748B' : '#334155',
                                    font: { family: 'Poppins', size: 10.5, weight: isMobileChart ? '500' : '600' }
                                }
                            },
                            y: {
                                beginAtZero: !isMobileChart,
                                grid: { display: !isMobileChart, color: '#E8F0F6' },
                                ticks: {
                                    precision: 0,
                                    color: isMobileChart ? '#003B64' : '#64748B',
                                    font: { family: 'Poppins', size: 11, weight: isMobileChart ? '600' : '500' }
                                }
                            }
                        }
                    }
                });
            }

            const reviewCtx = document.getElementById('reviewRatingChart');
            if (reviewCtx) {
                new Chart(reviewCtx, {
                    type: 'bar',
                    data: {
                        labels: ['5 ★', '4 ★', '3 ★', '2 ★', '1 ★'],
                        datasets: [{
                            label: 'Jumlah Ulasan',
                            data: @json($ratingDist),
                            backgroundColor: ['#16A34A', '#218AC9', '#D97706', '#EA580C', '#DC2626'],
                            borderRadius: 3,
                            barPercentage: 0.65
                        }]
                    },
                    options: {
                        indexAxis: 'y',
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false },
                            tooltip: {
                                backgroundColor: '#003B64',
                                cornerRadius: 4,
                                padding: 8
                            }
                        },
                        scales: {
                            x: {
                                beginAtZero: true,
                                grid: { color: '#E8F0F6' },
                                ticks: { precision: 0, color: '#64748B', font: { family: 'Poppins', size: 10.5 } }
                            },
                            y: {
                                grid: { display: false },
                                ticks: { color: '#003B64', font: { family: 'Poppins', size: 11, weight: '700' } }
                            }
                        }
                    }
                });
            }
        });

        document.addEventListener('DOMContentLoaded', function () {
            if (window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
                return;
            }

            function animateNumber(el, target, decimals, duration) {
                if (!el || isNaN(target) || target <= 0) return;
                const start = performance.now();
                function step(now) {
                    const progress = Math.min((now - start) / duration, 1);
                    const eased = 1 - Math.pow(1 - progress, 3);
                    const val = target * eased;
                    el.textContent = decimals > 0 ? val.toFixed(decimals) : Math.round(val).toString();
                    if (progress < 1) {
                        requestAnimationFrame(step);
                    } else {
                        el.textContent = decimals > 0 ? target.toFixed(decimals) : Math.round(target).toString();
                    }
                }
                el.textContent = decimals > 0 ? (0).toFixed(decimals) : '0';
                requestAnimationFrame(step);
            }

            document.querySelectorAll('.kpi-number').forEach(function (el) {
                const raw = parseInt((el.textContent || '').replace(/[^\d]/g, ''), 10);
                animateNumber(el, raw, 0, 420);
            });

            document.querySelectorAll('.review-score-big').forEach(function (el) {
                const raw = parseFloat((el.textContent || '').trim());
                animateNumber(el, raw, 1, 450);
            });
        });
    </script>
    @endif

    <script>
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