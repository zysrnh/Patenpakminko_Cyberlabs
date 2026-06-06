<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Permohonan {{ $application->application_number }} Ã¢â‚¬â€ PATEN PAK MIKO</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">

    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --clr-blue:    #218AC9;
            --clr-blue-dk: #003B64;
            --clr-blue-lt: #E3F0F9;
            --clr-yellow:  #FFCB05;
            --clr-green:   #85C341;
            --clr-ink:     #003B64;
            --clr-mid:     #2C5272;
            --clr-muted:   #7A9BB5;
            --clr-line:    #D6E4EF;
            --clr-surface: #F0F6FB;
            --clr-white:   #FFFFFF;
            --radius-sm:   6px;
            --radius-md:   10px;
            --radius-lg:   16px;
            --radius-xl:   24px;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--clr-surface);
            color: var(--clr-ink);
            min-height: 100vh;
            -webkit-font-smoothing: antialiased;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 0 24px;
        }

        /* Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬ HEADER Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬ */
        header {
            background: var(--clr-white);
            border-bottom: 1px solid var(--clr-line);
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .header-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 72px;
        }

        .logo-wrap {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }
        .logo-icon {
            width: 40px;
            height: 40px;
            border-radius: var(--radius-md);
            background: var(--clr-blue);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .logo-icon svg {
            width: 20px;
            height: 20px;
            fill: none;
            stroke: #fff;
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
        }
        .logo-text {
            display: flex;
            flex-direction: column;
            line-height: 1;
        }
        .logo-text strong {
            font-size: 16px;
            font-weight: 800;
            color: var(--clr-ink);
            letter-spacing: -.02em;
        }
        .logo-text span {
            font-size: 10px;
            font-weight: 600;
            color: var(--clr-muted);
            text-transform: uppercase;
            letter-spacing: .1em;
            margin-top: 3px;
        }

        .nav-menu {
            display: flex;
            align-items: center;
            gap: 24px;
        }
        .nav-link {
            font-size: 14px;
            font-weight: 600;
            color: var(--clr-mid);
            text-decoration: none;
            transition: color 0.2s;
        }
        .nav-link:hover, .nav-link.active {
            color: var(--clr-blue);
        }

        .btn-logout {
            background: transparent;
            border: 1px solid var(--clr-line);
            color: var(--clr-mid);
            padding: 8px 14px;
            font-family: inherit;
            font-size: 12.5px;
            font-weight: 600;
            border-radius: var(--radius-md);
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.2s;
        }
        .btn-logout:hover {
            color: #E53E3E;
            border-color: #FED7D7;
            background: #FFF5F5;
        }

        .user-nav {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .header-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 1.5px solid var(--clr-blue);
        }
        .header-avatar-placeholder {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--clr-blue-lt);
            color: var(--clr-blue);
            font-weight: 700;
            font-size: 13px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1.5px solid var(--clr-blue);
            text-transform: uppercase;
        }
        .user-badge {
            display: flex;
            flex-direction: column;
            text-align: left;
        }
        .user-badge strong {
            font-size: 14px;
            font-weight: 700;
            color: var(--clr-ink);
        }
        .user-badge span {
            font-size: 11px;
            color: var(--clr-muted);
            font-weight: 600;
        }

        /* Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬ MAIN CONTENT Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬ */
        main {
            padding: 40px 0;
        }

        .alert-success {
            background: #E6F4EA;
            border: 1px solid #B8E2C8;
            color: #137333;
            padding: 12px 16px;
            border-radius: var(--radius-md);
            font-size: 13.5px;
            font-weight: 600;
            margin-bottom: 28px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 28px;
        }

        .back-btn {
            font-size: 13.5px;
            font-weight: 600;
            color: var(--clr-muted);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .back-btn:hover {
            color: var(--clr-blue);
        }

        .badge-status {
            font-size: 12px;
            font-weight: 700;
            padding: 4px 12px;
            border-radius: 20px;
            color: white;
            text-transform: uppercase;
            letter-spacing: 0.03em;
        }

        .grid-layout {
            display: grid;
            grid-template-columns: 1.2fr 1fr;
            gap: 28px;
            align-items: start;
        }
        @media (max-width: 900px) {
            .grid-layout { grid-template-columns: 1fr; }
        }

        /* Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬ CARDS Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬ */
        .card {
            background: var(--clr-white);
            border: 1px solid var(--clr-line);
            border-radius: var(--radius-lg);
            padding: 24px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.01);
            margin-bottom: 28px;
        }

        .card-title {
            font-size: 15px;
            font-weight: 800;
            color: var(--clr-ink);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 20px;
            padding-bottom: 8px;
            border-bottom: 1.5px solid var(--clr-line);
        }

        /* Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬ DATA LIST Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬ */
        .data-list {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .data-item {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }
        .data-label {
            font-size: 11px;
            font-weight: 700;
            color: var(--clr-muted);
            text-transform: uppercase;
            letter-spacing: 0.03em;
        }
        .data-val {
            font-size: 14px;
            font-weight: 600;
            color: var(--clr-ink);
        }
        .data-val.mono {
            font-family: 'DM Mono', monospace;
            color: var(--clr-blue);
        }

        /* Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬ DOCUMENT DOWNLOADS Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬ */
        .doc-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .doc-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 16px;
            background: var(--clr-surface);
            border: 1px solid var(--clr-line);
            border-radius: var(--radius-md);
            text-decoration: none;
            color: var(--clr-ink);
            transition: all 0.2s;
        }
        .doc-item:hover {
            border-color: var(--clr-blue);
            background: var(--clr-blue-lt);
        }
        .doc-name {
            font-size: 13px;
            font-weight: 600;
        }
        .doc-status {
            font-size: 11.5px;
            font-weight: 700;
            color: var(--clr-blue);
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }
        .doc-status svg {
            width: 14px;
            height: 14px;
            stroke-width: 2.5;
        }

        /* Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬ TIMELINE Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬ */
        .timeline {
            display: flex;
            flex-direction: column;
            position: relative;
            padding-left: 28px;
            margin-top: 10px;
        }
        .timeline::before {
            content: '';
            position: absolute;
            left: 8px;
            top: 4px;
            bottom: 4px;
            width: 2px;
            background: var(--clr-line);
        }

        .timeline-step {
            position: relative;
            margin-bottom: 28px;
        }
        .timeline-step:last-child {
            margin-bottom: 0;
        }

        .timeline-dot {
            position: absolute;
            left: -28px;
            top: 2px;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background: var(--clr-white);
            border: 3px solid var(--clr-line);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.25s;
        }

        /* Timeline States */
        .timeline-step.completed .timeline-dot {
            border-color: var(--clr-green);
            background: var(--clr-green);
        }
        .timeline-step.active .timeline-dot {
            border-color: var(--clr-blue);
            background: var(--clr-white);
        }
        .timeline-step.rejected .timeline-dot {
            border-color: #E53E3E;
            background: #E53E3E;
        }

        .timeline-step.completed .timeline-dot::after {
            content: '';
            width: 6px;
            height: 4px;
            border-left: 1.5px solid white;
            border-bottom: 1.5px solid white;
            transform: rotate(-45deg) translateY(-1px);
        }

        .timeline-step.active .timeline-dot::after {
            content: '';
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: var(--clr-blue);
        }

        .timeline-title {
            font-size: 13.5px;
            font-weight: 700;
            color: var(--clr-ink);
            margin-bottom: 4px;
        }
        .timeline-step.active .timeline-title {
            color: var(--clr-blue);
        }
        
        .timeline-desc {
            font-size: 12px;
            color: var(--clr-mid);
            line-height: 1.4;
        }

        .timeline-notes {
            margin-top: 8px;
            padding: 8px 12px;
            background: var(--clr-surface);
            border-left: 3px solid var(--clr-blue);
            border-radius: 0 var(--radius-sm) var(--radius-sm) 0;
            font-size: 12px;
            color: var(--clr-ink);
            line-height: 1.4;
        }
        .timeline-step.completed .timeline-notes {
            border-color: var(--clr-green);
        }
        .timeline-step.rejected .timeline-notes {
            border-color: #E53E3E;
            background: #FFF5F5;
        }

        /* Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬ VERIFICATION PANEL Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬ */
        .verify-card {
            background: #FFFDF0;
            border: 1.5px solid #FBE89F;
            border-radius: var(--radius-lg);
            padding: 24px;
            margin-bottom: 28px;
        }
        .verify-title {
            font-size: 14.5px;
            font-weight: 800;
            color: #744210;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 16px;
            padding-bottom: 8px;
            border-bottom: 1.5px solid #FBE89F;
        }

        .radio-group {
            display: flex;
            gap: 20px;
            margin-bottom: 16px;
        }
        .radio-label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            color: var(--clr-ink);
        }
        .radio-label input {
            width: 18px;
            height: 18px;
            accent-color: var(--clr-blue);
        }

        .btn-verify-submit {
            background: var(--clr-ink);
            color: white;
            border: none;
            padding: 10px 20px;
            font-family: inherit;
            font-size: 13.5px;
            font-weight: 700;
            border-radius: var(--radius-md);
            cursor: pointer;
            transition: all 0.2s;
        }
        .btn-verify-submit:hover {
            background: #172436;
        }

        .btn-download-cert {
            background: var(--clr-green);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: var(--radius-md);
            font-family: inherit;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s;
            box-shadow: 0 4px 12px rgba(149, 185, 62, 0.2);
            width: 100%;
            justify-content: center;
            margin-bottom: 28px;
        }
        .btn-download-cert:hover {
            background: var(--clr-green-dk);
            transform: translateY(-0.5px);
        }
    </style>
</head>
<body>

    <!-- Header -->
    <header>
        <div class="container" style="max-width: 1000px;">
            <div class="header-inner">
                <a href="/dashboard" class="logo-wrap">
                    <div class="logo-icon">
                        <svg viewBox="0 0 24 24">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                        </svg>
                    </div>
                    <div class="logo-text">
                        <strong>PATEN PAK MIKO</strong>
                        <span>Kantor Pertanahan Sukabumi</span>
                    </div>
                </a>

                <div class="nav-menu">
                    <a href="/" class="nav-link">Beranda</a>
                    @if(Auth::user()->isDpn())
                        <a href="{{ route('dpn.whatsapp') }}" class="nav-link">Integrasi WhatsApp</a>
                    @endif
                    <a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a>
                    <a href="{{ route('profile') }}" class="nav-link">Profil Saya</a>
                    
                    <div class="user-nav" style="margin-left: 12px; padding-left: 12px; border-left: 1.5px solid var(--clr-line);">
                        @if(Auth::user()->profile_photo)
                            <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="Foto Profil" class="header-avatar">
                        @else
                            <div class="header-avatar-placeholder">
                                {{ strtoupper(substr(Auth::user()->username, 0, 2)) }}
                            </div>
                        @endif
                        <div class="user-badge">
                            <strong>{{ Auth::user()->name ?? Auth::user()->username }}</strong>
                            <span>{{ Auth::user()->phone_number }}</span>
                        </div>
                    </div>

                    <form action="{{ route('logout') }}" method="POST" style="margin-left: 8px;">
                        @csrf
                        <button type="submit" class="btn-logout">
                            <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                            Keluar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <!-- Main -->
    <main>
        <div class="container">

            @if(session('success'))
                <div class="alert-success">
                    <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ session('success') }}
                </div>
            @endif

            <div class="page-header">
                <div>
                    <a href="{{ route('psn.index') }}" class="back-btn">
                        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        Kembali ke Daftar
                    </a>
                    <h1 class="page-title" style="margin-top: 8px;">Detail Permohonan <span style="font-family: 'DM Mono', monospace; font-size: 20px; color: var(--clr-blue);">{{ $application->application_number }}</span></h1>
                </div>
                
                <div>
                    <span class="badge-status" style="background-color: {{ $application->status_color }}">
                        {{ $application->status_label }}
                    </span>
                    @if(Auth::user()->isBpn())
                        
                                        <div style="display: inline-flex; gap: 4px; margin-left: 8px;">
                                            <form action="{{ route('application.rollback', ['psn', $application->id]) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan ke tahap sebelumnya?')">
                                                @csrf
                                                <button type="submit" style="background: #E53E3E; color: white; border: none; padding: 4px 10px; border-radius: 4px; font-size: 11px; font-weight: 700; cursor: pointer; display: inline-flex; align-items: center; gap: 4px;">
                                                    <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                                                    Prev
                                                </button>
                                            </form>
                                            <form action="{{ route('application.forward', ['psn', $application->id]) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Bypass ke tahap selanjutnya?')">
                                                @csrf
                                                <button type="submit" style="background: #48BB78; color: white; border: none; padding: 4px 10px; border-radius: 4px; font-size: 11px; font-weight: 700; cursor: pointer; display: inline-flex; align-items: center; gap: 4px;">
                                                    Next
                                                    <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                                                </button>
                                            </form>
                                        </div>

                    @endif
                </div>
            </div>

            <!-- BUTTON DOWNLOAD DOKUMEN PPKPR SELESAI -->
            @if($application->status === 'disetujui')
                @if($application->bpn_pertek_document)
                    <a href="{{ asset('storage/' . $application->bpn_pertek_document) }}" target="_blank" class="btn-download-cert" style="background:#79A73A; margin-bottom: 20px;">
                        <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                        Unduh Dokumen Pertek Pertanahan Resmi (BPN)
                    </a>
                @elseif($application->approval_document)
                    <a href="{{ asset('storage/' . $application->approval_document) }}" target="_blank" class="btn-download-cert" style="margin-bottom: 20px;">
                        <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                        Unduh Dokumen PKKPR Resmi (PDF)
                    </a>
                @endif
            @endif
 
            <!-- FITUR ULASAN LAYANAN (ANTI-SPAM) -->
            @if($application->bpn_pertek_document)
                @php
                    $review = \App\Models\Review::where('user_id', Auth::id())
                        ->where('module_type', 'psn')
                        ->where('module_id', $application->id)
                        ->first();
                @endphp
 
                @if(Auth::user()->isPelakuUsaha())
                    <div class="verify-card" style="border-color: #CBD5E0; background: #F8FAFC; margin-bottom: 24px; padding: 24px; border-radius: 12px; border: 1.5px solid var(--clr-line);">
                        <h3 class="verify-title" style="color: var(--clr-blue); margin-bottom: 12px; display: flex; align-items: center; gap: 8px; font-weight: 800; font-size: 16px;">
                            Ã¢Â­Â Ulasan & Penilaian Layanan
                        </h3>
 
                        @if($review)
                            <div style="background: #FFFFFF; border: 1.5px solid var(--clr-line); padding: 16px; border-radius: 10px;">
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                                    <span style="color: var(--clr-yellow); font-size: 16px; font-weight: 700;">
                                        {{ str_repeat('Ã¢Ëœâ€¦', $review->rating) }}{{ str_repeat('Ã¢Ëœâ€ ', 5 - $review->rating) }} 
                                        <span style="color: var(--clr-ink); font-size: 13px; font-weight: 800; margin-left: 6px;">({{ $review->rating_label }})</span>
                                    </span>
                                    @if($review->is_approved)
                                        <span style="font-size: 11px; background: #EBF8FF; color: #2B6CB0; padding: 3px 10px; border-radius: 100px; font-weight: 700;">Telah Dipublikasikan</span>
                                    @else
                                        <span style="font-size: 11px; background: #E2E8F0; color: #4A5568; padding: 3px 10px; border-radius: 100px; font-weight: 700;">Menunggu Moderasi Admin</span>
                                    @endif
                                </div>
                                <p style="font-style: italic; font-size: 13px; color: var(--clr-muted);">"{{ $review->comment }}"</p>
                            </div>
                        @else
                            <p style="font-size: 12.5px; color: var(--clr-muted); margin-bottom: 16px;">Silakan berikan ulasan Anda terkait efisiensi pelaporan dan pelayanan kami untuk membantu kami meningkatkan kualitas sistem.</p>
                            <form action="{{ route('review.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="module_type" value="psn">
                                <input type="hidden" name="module_id" value="{{ $application->id }}">
                                
                                <div class="form-group" style="margin-bottom: 12px;">
                                    <label for="rating" style="font-weight: 700; font-size: 12px; display: block; margin-bottom: 6px;">Penilaian Anda</label>
                                    <select name="rating" id="rating" style="width:100%; padding: 10px; border-radius: 8px; border: 1.5px solid var(--clr-line); font-size:13.5px;" required>
                                        <option value="5">Ã¢Â­ÂÃ¢Â­ÂÃ¢Â­ÂÃ¢Â­ÂÃ¢Â­Â Sangat Baik</option>
                                        <option value="4">Ã¢Â­ÂÃ¢Â­ÂÃ¢Â­ÂÃ¢Â­Â Baik</option>
                                        <option value="3">Ã¢Â­ÂÃ¢Â­ÂÃ¢Â­Â Cukup Baik</option>
                                        <option value="2">Ã¢Â­ÂÃ¢Â­Â Kurang</option>
                                        <option value="1">Ã¢Â­Â Sangat Kurang</option>
                                    </select>
                                </div>
 
                                <div class="form-group" style="margin-bottom: 16px;">
                                    <label for="comment" style="font-weight: 700; font-size: 12px; display: block; margin-bottom: 6px;">Catatan Ulasan / Feedback</label>
                                    <textarea name="comment" id="comment" style="width:100%; padding: 10px; border-radius: 8px; border: 1.5px solid var(--clr-line); font-size:13.5px; resize:none;" rows="2" placeholder="Tuliskan saran atau ulasan singkat Anda..." required></textarea>
                                </div>
 
                                <button type="submit" style="background: var(--clr-blue); color: white; border: none; padding: 10px 20px; border-radius: 8px; font-weight: 700; font-size: 12.5px; cursor: pointer;">
                                    Kirim Ulasan Layanan
                                </button>
                            </form>
                        @endif
                    </div>
                @endif
            @endif

            <!-- STAGED VERIFICATION FORM (Hanya untuk instansi yang sedang bertugas) -->
            @php
                $user = Auth::user();
                $canVerify = false;
                $verifierRoleLabel = '';
                
                if ($user->isBpn() && $application->status === 'menunggu_bpn') {
                    $canVerify = true;
                    $verifierRoleLabel = 'Petugas BPN (Verifikasi Kepemilikan Tanah)';
                } elseif ($user->isDinasPu() && $application->status === 'menunggu_dinas_pu') {
                    $canVerify = true;
                    $verifierRoleLabel = 'Verifikator Dinas PU (Tata Ruang)';
                } elseif ($user->isSatuPintu() && $application->status === 'menunggu_satu_pintu') {
                    $canVerify = true;
                    $verifierRoleLabel = 'Petugas Dinas Satu Pintu (Penerbitan Izin)';
                }

                // Logika Waktu Untuk Staged Timeline & Penentuan Form Aktif BPN
                $now = \Carbon\Carbon::now();
                $cekLokasiLewat = $application->bpn_cek_lokasi_dt
                    && $now->toDateString() >= $application->bpn_cek_lokasi_dt->copy()->addDay()->toDateString();
                $rapatLewat = $application->bpn_rapat_dt
                    && $now->toDateString() >= $application->bpn_rapat_dt->copy()->addDay()->toDateString();
            @endphp

            @if($canVerify)
                <div class="verify-card">
                    <h3 class="verify-title">Ã°Å¸â€œÂ Panel Pemeriksaan Berkas Ã¢â‚¬â€ {{ $verifierRoleLabel }}</h3>
                    
                    @if($user->isBpn() && $application->status === 'menunggu_bpn')

                        {{-- ====== LANGKAH 1: VERIFIKASI BERKAS (Pertama kali masuk) ====== --}}
                        @if($application->bpn_berkas_status === 'menunggu')
                            <form action="{{ route('psn.verify', $application->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="step" value="bpn_berkas">
                                <div style="background:#FFFDF5;border:1px solid #F6AD55;padding:12px 16px;border-radius:8px;font-size:13px;color:#7B341E;margin-bottom:20px;">
                                    <strong>Langkah 1 dari 4 Ã¢â‚¬â€ Verifikasi Berkas Awal:</strong> Periksa kelengkapan dokumen persyaratan yang diunggah pemohon, lalu terima atau tolak. Notifikasi WA akan terkirim otomatis.
                                </div>
                                <div class="form-group">
                                    <label class="form-label" style="font-weight:700;color:#744210;">Keputusan Pemeriksaan Berkas:</label>
                                    <div class="radio-group">
                                        <label class="radio-label"><input type="radio" name="action" value="approve" required checked> Disetujui</label>
                                        <label class="radio-label" style="color:#E53E3E;"><input type="radio" name="action" value="reject" required> Tidak Disetujui</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="notes" class="form-label" style="font-weight:700;color:#744210;">Catatan Pemeriksaan Berkas <span style="color:red;">*</span></label>
                                    <textarea id="notes" name="notes" class="form-control" rows="3" placeholder="Tuliskan hasil pemeriksaan dokumen persyaratan..." style="resize:none;background:white;" required></textarea>
                                    @error('notes')<span class="error-message">{{ $message }}</span>@enderror
                                </div>
                                <button type="submit" class="btn-verify-submit">Kirim Hasil Verifikasi Berkas & Blast WA</button>
                            </form>

                        {{-- ====== LANGKAH 2+: SETELAH BERKAS DITERIMA ====== --}}
                        @elseif($application->bpn_berkas_status === 'diterima')
                            @php
                                $now = \Carbon\Carbon::now();
                                // Cek apakah tanggal cek lokasi + 1 hari sudah dilewati (cukup cek tanggal, bukan jam)
                                $cekLokasiLewat = $application->bpn_cek_lokasi_dt
                                    && $now->toDateString() >= $application->bpn_cek_lokasi_dt->copy()->addDay()->toDateString();
                                // Cek apakah tanggal rapat + 1 hari sudah dilewati
                                $rapatLewat = $application->bpn_rapat_dt
                                    && $now->toDateString() >= $application->bpn_rapat_dt->copy()->addDay()->toDateString();
                            @endphp

                            {{-- Info status berkas diterima --}}
                            <div style="background:#F0FFF4;border:1px solid #9AE6B4;padding:10px 14px;border-radius:8px;font-size:12.5px;color:#276749;margin-bottom:16px;">
                                Ã¢Å“â€¦ <strong>Berkas Diterima.</strong> Catatan BPN: {{ $application->bpn_notes }}
                            </div>

                            {{-- ===== Form Jadwal Cek Lokasi (Selalu bisa diedit) ===== --}}
                            <form action="{{ route('psn.verify', $application->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="step" value="bpn_cek_lokasi">
                                <div style="background:#FFFDF5;border:1px solid #F6AD55;padding:12px 16px;border-radius:8px;font-size:13px;color:#7B341E;margin-bottom:16px;">
                                    <strong>Langkah 2 dari 4 — Jadwal Cek Lokasi</strong>
                                    @if($application->bpn_cek_lokasi_dt)
                                        — Terjadwal: <strong>{{ $application->bpn_cek_lokasi_date }}</strong> (CP: {{ $application->bpn_cek_lokasi_cp }}). Ubah jika ada perubahan.
                                    @else
                                        — Tentukan jadwal dan kontak person petugas lapangan.
                                    @endif
                                </div>
                                <div class="form-group" style="margin-bottom:12px;">
                                    <label class="form-label" style="font-weight:700;color:#744210;">Tanggal & Waktu Cek Lokasi <span style="color:red;">*</span></label>
                                    <input type="datetime-local" name="bpn_cek_lokasi_dt" class="form-control"
                                        value="{{ $application->bpn_cek_lokasi_dt ? $application->bpn_cek_lokasi_dt->format('Y-m-d\TH:i') : '' }}"
                                        style="background:white;" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" style="font-weight:700;color:#744210;">Kontak Person Petugas Lapangan <span style="color:red;">*</span></label>
                                    <input type="text" name="bpn_cek_lokasi_cp" class="form-control"
                                        value="{{ $application->bpn_cek_lokasi_cp }}"
                                        placeholder="cth: 08511234567 (Budi - Petugas BPN)" style="background:white;" required>
                                    @error('bpn_cek_lokasi_cp')<span class="error-message">{{ $message }}</span>@enderror
                                </div>
                                <button type="submit" class="btn-verify-submit" style="font-size:13px;padding:10px 20px;">
                                    {{ $application->bpn_cek_lokasi_dt ? '🔄 Ubah Jadwal Cek Lokasi & Kirim WA' : '📅 Simpan Jadwal Cek Lokasi & Blast WA' }}
                                </button>
                            </form>

                            {{-- ===== Form Jadwal Rapat (muncul setelah cek lokasi diisi) ===== --}}
                            @if($application->bpn_cek_lokasi_dt)
                                <hr style="border:none;border-top:1px solid #edf2f7;margin:20px 0;">
                                <form action="{{ route('psn.verify', $application->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="step" value="bpn_rapat">
                                    <div style="background:#EBF8FF;border:1px solid #90CDF4;padding:12px 16px;border-radius:8px;font-size:13px;color:#2B6CB0;margin-bottom:16px;">
                                        <strong>Langkah 3 dari 4 — Jadwal Rapat Koordinasi</strong>
                                        @if($application->bpn_rapat_dt)
                                            — Terjadwal: <strong>{{ $application->bpn_rapat_date }}</strong>. Ubah jika ada perubahan.
                                        @else
                                            — Cek lokasi selesai. Tentukan waktu rapat koordinasi BPN.
                                        @endif
                                    </div>
                                    <div class="form-group" style="margin-bottom:12px;">
                                        <label class="form-label" style="font-weight:700;color:#744210;">Tanggal & Waktu Rapat <span style="color:red;">*</span></label>
                                        <input type="datetime-local" name="bpn_rapat_dt" class="form-control"
                                            value="{{ $application->bpn_rapat_dt ? $application->bpn_rapat_dt->format('Y-m-d\TH:i') : '' }}"
                                            style="background:white;" required>
                                    </div>
                                    <button type="submit" class="btn-verify-submit" style="background:#218AC9;font-size:13px;padding:10px 20px;">
                                        {{ $application->bpn_rapat_dt ? '🔄 Ubah Jadwal Rapat & Kirim WA' : '📅 Simpan Jadwal Rapat & Blast WA' }}
                                    </button>
                                </form>
                            @endif

                            {{-- ===== Form Upload Pertek (muncul setelah rapat diisi) ===== --}}
                            @if($application->bpn_rapat_dt)
                                <hr style="border:none;border-top:1px solid #edf2f7;margin:20px 0;">
                                <form action="{{ route('psn.verify', $application->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="step" value="bpn_pertek">
                                    <div style="background:#F0FFF4;border:1px solid #BBF7D0;padding:12px 16px;border-radius:8px;font-size:13px;color:#166534;margin-bottom:16px;line-height:1.6;">
                                        <strong>Langkah 4 dari 4 — Penerbitan Pertek Pertanahan</strong><br>
                                        Rapat terdaftar. Upload Dokumen Pertek dan beri keputusan akhir BPN.
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" style="font-weight:700;color:#744210;">Keputusan Akhir BPN:</label>
                                        <div class="radio-group">
                                            <label class="radio-label"><input type="radio" name="action" value="approve" required checked onclick="togglePertekUpload(true)"> Disetujui</label>
                                            <label class="radio-label" style="color:#E53E3E;"><input type="radio" name="action" value="reject" required onclick="togglePertekUpload(false)"> Tidak Disetujui</label>
                                        </div>
                                    </div>
                                    <div class="form-group" id="pertekUploadWrapper">
                                        <label class="form-label" style="font-weight:700;color:#744210;">Unggah Dokumen Pertek (PDF/DOC/DOCX) <span style="color:red;">*</span></label>
                                        <input type="file" id="bpn_pertek_document" name="bpn_pertek_document" class="form-control" accept=".pdf,.doc,.docx" style="background:white;">
                                        @error('bpn_pertek_document')<span class="error-message">{{ $message }}</span>@enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" style="font-weight:700;color:#744210;">Catatan / Rekomendasi Teknis BPN <span style="color:red;">*</span></label>
                                        <textarea name="notes" class="form-control" rows="3" placeholder="Tuliskan rekomendasi teknis atau alasan penolakan..." style="resize:none;background:white;" required></textarea>
                                        @error('notes')<span class="error-message">{{ $message }}</span>@enderror
                                    </div>
                                    <button type="submit" class="btn-verify-submit" style="background:#79A73A;">📄 Terbitkan Pertek & Blast WA Pemohon</button>
                                </form>
                                <script>
                                    function togglePertekUpload(show) {
                                        const w = document.getElementById('pertekUploadWrapper');
                                        const i = document.getElementById('bpn_pertek_document');
                                        if (w) { w.style.display = show ? 'block' : 'none'; show ? i.setAttribute('required','required') : i.removeAttribute('required'); }
                                    }
                                    document.addEventListener('DOMContentLoaded', () => togglePertekUpload(true));
                                </script>
                            @endif

                        @endif {{-- end bpn_berkas_status --}}

                    @else
                        {{-- ====== FORM DINAS PU ====== --}}
                        @if($user->isDinasPu() && $application->status === 'menunggu_dinas_pu')
                        <form action="{{ route('psn.verify', $application->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="step" value="dinas_pu_penilaian">
                            <div style="background:#EBF8FF;border:1px solid #90CDF4;padding:12px 16px;border-radius:8px;font-size:13px;color:#2B6CB0;margin-bottom:16px;">
                                <strong>Penilaian Tata Ruang (Dinas PU):</strong> Periksa kesesuaian tata ruang berdasarkan dokumen Pertek BPN, lalu tentukan keputusan.
                            </div>
                            <div class="form-group">
                                <label class="form-label" style="font-weight:700;color:#744210;">Keputusan Penilaian:</label>
                                <div class="radio-group">
                                    <label class="radio-label"><input type="radio" name="action" value="approve" required checked> Disetujui</label>
                                    <label class="radio-label" style="color:#E53E3E;"><input type="radio" name="action" value="reject" required> Tidak Disetujui</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="notes_pu" class="form-label" style="font-weight:700;color:#744210;">Catatan Dinas PU <span style="color:red;">*</span></label>
                                <textarea id="notes_pu" name="notes" class="form-control" rows="3" placeholder="Tuliskan catatan penilaian tata ruang..." style="resize:none;background:white;" required></textarea>
                                @error('notes')<span class="error-message">{{ $message }}</span>@enderror
                            </div>
                            <div class="form-group" style="margin-bottom:12px;">
                                <label class="form-label" style="font-weight:700;color:#744210;">Tanggal Penilaian <span style="color:red;">*</span></label>
                                <input type="date" name="dinas_pu_tanggal_penilaian" class="form-control" value="{{ old('dinas_pu_tanggal_penilaian') }}" style="background:white;" required>
                                @error('dinas_pu_tanggal_penilaian')<span class="error-message">{{ $message }}</span>@enderror
                            </div>
                            <div class="form-group" style="margin-bottom:12px;">
                                <label class="form-label" style="font-weight:700;color:#744210;">Upload Dokumen Penilaian <span style="font-size:11px;color:#718096;">(opsional &mdash; hanya masuk ke BPN)</span></label>
                                <input type="file" name="dinas_pu_document" class="form-control" accept=".pdf,.doc,.docx" style="background:white;">
                                <span style="font-size:11.5px;color:#744210;margin-top:4px;display:block;">Format PDF/DOC, maks. 10MB. File ini hanya dapat diakses oleh BPN, tidak diteruskan ke pemohon.</span>
                                @error('dinas_pu_document')<span class="error-message">{{ $message }}</span>@enderror
                            </div>
                            <button type="submit" class="btn-verify-submit" style="background:#218AC9;">Kirim Keputusan Penilaian Tata Ruang</button>
                        </form>

                        {{-- ====== FORM SATU PINTU ====== --}}
                        @elseif($user->isSatuPintu() && $application->status === 'menunggu_satu_pintu')
                        <form action="{{ route('psn.verify', $application->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div style="background:#F0FFF4;border:1px solid #9AE6B4;padding:12px 16px;border-radius:8px;font-size:13px;color:#166534;margin-bottom:16px;">
                                <strong>Penerbitan PKKPR (Dinas Satu Pintu / PTSP):</strong> Isi data penerbitan PKKPR resmi, lalu unggah dokumen dan kirim.
                            </div>
                            <div class="form-group">
                                <label class="form-label" style="font-weight:700;color:#744210;">Keputusan:</label>
                                <div class="radio-group">
                                    <label class="radio-label"><input type="radio" name="action" value="approve" required checked onclick="toggleSatuPintuFields(true)"> Disetujui</label>
                                    <label class="radio-label" style="color:#E53E3E;"><input type="radio" name="action" value="reject" required onclick="toggleSatuPintuFields(false)"> Tidak Disetujui</label>
                                </div>
                            </div>
                            <div id="satuPintuFieldsWrapper">
                                <div class="form-group" style="margin-bottom:12px;">
                                    <label for="satu_pintu_no_pkkpr" class="form-label" style="font-weight:700;color:#744210;">Nomor PKKPR (wajib) <span style="color:red;">*</span></label>
                                    <input type="text" id="satu_pintu_no_pkkpr" name="satu_pintu_no_pkkpr" class="form-control"
                                           placeholder="cth: PKKPR-NB/2026/001" value="{{ old('satu_pintu_no_pkkpr') }}" style="background:white;">
                                    @error('satu_pintu_no_pkkpr')<span class="error-message">{{ $message }}</span>@enderror
                                </div>
                                <div class="form-group" style="margin-bottom:12px;">
                                    <label for="satu_pintu_tanggal_terbit" class="form-label" style="font-weight:700;color:#744210;">Tanggal Terbit (wajib) <span style="color:red;">*</span></label>
                                    <input type="date" id="satu_pintu_tanggal_terbit" name="satu_pintu_tanggal_terbit" class="form-control"
                                           value="{{ old('satu_pintu_tanggal_terbit') }}" style="background:white;">
                                    @error('satu_pintu_tanggal_terbit')<span class="error-message">{{ $message }}</span>@enderror
                                </div>
                                <div class="form-group" style="margin-bottom:12px;">
                                    <label for="approval_document" class="form-label" style="font-weight:700;color:#744210;">Unggah Dokumen PKKPR (opsional)</label>
                                    <input type="file" id="approval_document" name="approval_document" class="form-control" accept="application/pdf" style="background:white;">
                                    <span style="font-size:11.5px;color:#744210;margin-top:4px;display:block;">Format PDF, maks. 10MB. Dokumen ini dapat diunduh oleh pemohon.</span>
                                    @error('approval_document')<span class="error-message">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="notes_sp" class="form-label" style="font-weight:700;color:#744210;">Catatan / Keterangan:</label>
                                <textarea id="notes_sp" name="notes" class="form-control" rows="3" placeholder="Catatan penerbitan PKKPR (opsional)..." style="resize:none;background:white;"></textarea>
                            </div>
                            <button type="submit" class="btn-verify-submit" style="background:#79A73A;">Ã°Å¸â€œâ€ž Terbitkan PKKPR & Blast WA Pemohon</button>
                        </form>
                        <script>
                            function toggleSatuPintuFields(show) {
                                const w = document.getElementById('satuPintuFieldsWrapper');
                                const noEl = document.getElementById('satu_pintu_no_pkkpr');
                                const tglEl = document.getElementById('satu_pintu_tanggal_terbit');
                                if (w) {
                                    w.style.display = show ? 'block' : 'none';
                                    if(noEl) show ? noEl.setAttribute('required','required') : noEl.removeAttribute('required');
                                    if(tglEl) show ? tglEl.setAttribute('required','required') : tglEl.removeAttribute('required');
                                }
                            }
                            document.addEventListener('DOMContentLoaded', () => toggleSatuPintuFields(true));
                        </script>
                        @endif
                    @endif
                </div>
            @endif

            <div class="grid-layout">
                
                <!-- Left: Application Details & Uploaded Files -->
                <div>
                    <!-- Data Permohonan -->
                    <div class="card">
                        <h2 class="card-title">Informasi Identitas Pemohon / Pengguna Layanan</h2>
                        <div class="data-list">
                            <div class="data-item">
                                <span class="data-label">Nama Pemilik Usaha</span>
                                <span class="data-val">{{ $application->nama_pemilik_usaha }}</span>
                            </div>
                            <div class="data-item">
                                <span class="data-label">Nama Pemohon / Pengguna Layanan</span>
                                <span class="data-val">{{ $application->nama_pengaju }}</span>
                            </div>
                            <div class="data-item">
                                <span class="data-label">Hubungan Pengaju (Sebagai Apa)</span>
                                <span class="data-val">{{ $application->hubungan_pengaju }}</span>
                            </div>
                            <div class="data-item">
                                <span class="data-label">Akun Pemohon (Username)</span>
                                <span class="data-val">{{ $application->user->username }}</span>
                            </div>
                            <div class="data-item">
                                <span class="data-label">Nomor Telepon Gateway / HP</span>
                                <span class="data-val mono">+{{ $application->user->phone_number }}</span>
                            </div>
                            <div class="data-item">
                                <span class="data-label">Tanggal Pengajuan Berkas</span>
                                <span class="data-val">{{ $application->created_at->format('d-m-Y, H:i') }} WIB</span>
                            </div>
                        </div>
                    </div>

                    <!-- Dokumen Lampiran -->
                    <div class="card">
                        <h2 class="card-title">Dokumen Berkas Persyaratan</h2>
                        <div class="doc-list">
                            
                            <!-- Persyaratan Utama -->
                            @if($application->peta_lokasi)
                            <a href="{{ asset('storage/' . $application->peta_lokasi) }}" target="_blank" class="doc-item">
                                <span class="doc-name">1. Peta Lokasi</span>
                                <span class="doc-status">Unduh/Lihat <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6M15 3h6v6M10 14L21 3"/></svg></span>
                            </a>
                            @endif

                            @if($application->surat_kuasa)
                            <a href="{{ asset('storage/' . $application->surat_kuasa) }}" target="_blank" class="doc-item">
                                <span class="doc-name">2. Surat Kuasa</span>
                                <span class="doc-status">Unduh/Lihat <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6M15 3h6v6M10 14L21 3"/></svg></span>
                            </a>
                            @endif

                            @if($application->fc_ktp)
                            <a href="{{ asset('storage/' . $application->fc_ktp) }}" target="_blank" class="doc-item">
                                <span class="doc-name">3. FC KTP</span>
                                <span class="doc-status">Unduh/Lihat <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6M15 3h6v6M10 14L21 3"/></svg></span>
                            </a>
                            @endif

                            @if($application->fc_npwp)
                            <a href="{{ asset('storage/' . $application->fc_npwp) }}" target="_blank" class="doc-item">
                                <span class="doc-name">4. FC NPWP</span>
                                <span class="doc-status">Unduh/Lihat <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6M15 3h6v6M10 14L21 3"/></svg></span>
                            </a>
                            @endif

                            @if($application->fc_akta_pendirian)
                            <a href="{{ asset('storage/' . $application->fc_akta_pendirian) }}" target="_blank" class="doc-item">
                                <span class="doc-name">5. FC Akta Pendirian</span>
                                <span class="doc-status">Unduh/Lihat <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6M15 3h6v6M10 14L21 3"/></svg></span>
                            </a>
                            @endif

                            @if($application->rencana_penggunaan_tanah)
                            <a href="{{ asset('storage/' . $application->rencana_penggunaan_tanah) }}" target="_blank" class="doc-item">
                                <span class="doc-name">6. Rencana Penggunaan Tanah</span>
                                <span class="doc-status">Unduh/Lihat <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6M15 3h6v6M10 14L21 3"/></svg></span>
                            </a>
                            @endif

                            @if($application->nib)
                            <a href="{{ asset('storage/' . $application->nib) }}" target="_blank" class="doc-item">
                                <span class="doc-name">7. NIB</span>
                                <span class="doc-status">Unduh/Lihat <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6M15 3h6v6M10 14L21 3"/></svg></span>
                            </a>
                            @endif

                            @if($application->kbli)
                            <a href="{{ asset('storage/' . $application->kbli) }}" target="_blank" class="doc-item">
                                <span class="doc-name">8. KBLI</span>
                                <span class="doc-status">Unduh/Lihat <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6M15 3h6v6M10 14L21 3"/></svg></span>
                            </a>
                            @endif

                            @if($application->proposal_kegiatan)
                            <a href="{{ asset('storage/' . $application->proposal_kegiatan) }}" target="_blank" class="doc-item">
                                <span class="doc-name">9. Proposal Kegiatan</span>
                                <span class="doc-status">Unduh/Lihat <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6M15 3h6v6M10 14L21 3"/></svg></span>
                            </a>
                            @endif

                            @if($application->persyaratan_lainnya)
                            <a href="{{ asset('storage/' . $application->persyaratan_lainnya) }}" target="_blank" class="doc-item">
                                <span class="doc-name">10. Persyaratan Lainnya</span>
                                <span class="doc-status">Unduh/Lihat <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6M15 3h6v6M10 14L21 3"/></svg></span>
                            </a>
                            @endif

                            <!-- Pertek Pertanahan (Jika sudah diterbitkan) -->
                            @if($application->bpn_pertek_document)
                                <a href="{{ asset('storage/' . $application->bpn_pertek_document) }}" target="_blank" class="doc-item" style="border-top: 1px solid var(--clr-line); padding-top: 12px; margin-top: 12px;">
                                    <span class="doc-name" style="font-weight: 700; color: #1a202c;">Dokumen Pertek Pertanahan (BPN)</span>
                                    <span class="doc-status" style="color: var(--clr-green-dk);">
                                        Unduh Pertek
                                        <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6M15 3h6v6M10 14L21 3"/></svg>
                                    </span>
                                </a>
                            @endif

                        </div>
                    </div>
                </div>

                <!-- Right: Staged Tracking Timeline -->
                <div>
                    <div class="card">
                        <h2 class="card-title">Linimasa Pelacakan Berkas</h2>
                        
                        <div class="timeline">
                            
                            <!-- STEP 1: Diajukan -->
                            <div class="timeline-step completed">
                                <span class="timeline-dot"></span>
                                <div class="timeline-title">Berkas Berhasil Diajukan</div>
                                <div class="timeline-desc">Pelaku usaha berhasil mengunggah berkas persyaratan secara lengkap ke portal PATEN PAK MIKO.</div>
                            </div>

                            <!-- STEP 2: Verifikasi Berkas Awal BPN -->
                            @php
                                $step2Status = 'active';
                                if ($application->bpn_berkas_status === 'diterima') {
                                    $step2Status = 'completed';
                                } elseif ($application->bpn_berkas_status === 'ditolak') {
                                    $step2Status = 'rejected';
                                }
                            @endphp
                            <div class="timeline-step {{ $step2Status }}">
                                <span class="timeline-dot"></span>
                                <div class="timeline-title">1. Verifikasi Berkas Awal (BPN)</div>
                                <div class="timeline-desc">Validasi awal kelengkapan berkas dokumen persyaratan pemohon oleh Kantor Pertanahan.</div>
                            </div>

                            <!-- STEP 3: Cek Lokasi Lapangan BPN -->
                            @php
                                $step3Status = '';
                                if ($application->bpn_berkas_status === 'diterima') {
                                    if ($application->bpn_cek_lokasi_dt) {
                                        $step3Status = $cekLokasiLewat ? 'completed' : 'active';
                                    } else {
                                        $step3Status = 'active';
                                    }
                                }
                            @endphp
                            <div class="timeline-step {{ $step3Status }}">
                                <span class="timeline-dot"></span>
                                <div class="timeline-title">2. Peninjauan Lokasi Lapangan (BPN)</div>
                                <div class="timeline-desc">
                                    @if($application->bpn_cek_lokasi_dt)
                                        Dijadwalkan pada: <strong>{{ $application->bpn_cek_lokasi_date }}</strong><br>
                                        CP Lapangan: <strong>{{ $application->bpn_cek_lokasi_cp }}</strong>
                                    @else
                                        Menunggu penentuan jadwal peninjauan lapangan offline.
                                    @endif
                                </div>
                            </div>

                            <!-- STEP 4: Rapat Koordinasi BPN -->
                            @php
                                $step4Status = '';
                                if ($cekLokasiLewat) {
                                    if ($application->bpn_rapat_dt) {
                                        $step4Status = $rapatLewat ? 'completed' : 'active';
                                    } else {
                                        $step4Status = 'active';
                                    }
                                }
                            @endphp
                            <div class="timeline-step {{ $step4Status }}">
                                <span class="timeline-dot"></span>
                                <div class="timeline-title">3. Rapat Pembahasan Pertek (BPN)</div>
                                <div class="timeline-desc">
                                    @if($application->bpn_rapat_dt)
                                        Dijadwalkan pada: <strong>{{ $application->bpn_rapat_date }}</strong>
                                    @else
                                        Menunggu penentuan jadwal rapat koordinasi pertanahan.
                                    @endif
                                </div>
                            </div>

                            <!-- STEP 5: Penerbitan Pertek BPN -->
                            @php
                                $step5Status = '';
                                if ($rapatLewat) {
                                    if ($application->bpn_pertek_document) {
                                        $step5Status = 'completed';
                                    } elseif ($application->status === 'ditolak') {
                                        $step5Status = 'rejected';
                                    } else {
                                        $step5Status = 'active';
                                    }
                                }
                            @endphp
                            <div class="timeline-step {{ $step5Status }}">
                                <span class="timeline-dot"></span>
                                <div class="timeline-title">4. Penerbitan Pertek Pertanahan (BPN)</div>
                                <div class="timeline-desc">
                                    @if($application->bpn_pertek_document)
                                        Dokumen Pertek resmi diterbitkan. Permohonan diteruskan ke Dinas PU.
                                    @else
                                        Menunggu rapat selesai untuk penerbitan rekomendasi teknis BPN.
                                    @endif
                                </div>
                            </div>

                            <!-- STEP 6: Penilaian Tata Ruang Dinas PU -->
                            @php
                                $step6Status = '';
                                if ($application->bpn_pertek_document) {
                                    if ($application->status === 'menunggu_satu_pintu' || $application->status === 'disetujui') {
                                        $step6Status = 'completed';
                                    } elseif ($application->status === 'ditolak' && !$application->satu_pintu_no_pkkpr) {
                                        $step6Status = 'rejected';
                                    } elseif ($application->status === 'menunggu_dinas_pu') {
                                        $step6Status = 'active';
                                    }
                                }
                            @endphp
                            <div class="timeline-step {{ $step6Status }}">
                                <span class="timeline-dot"></span>
                                <div class="timeline-title">5. Penilaian Tata Ruang (Dinas PU)</div>
                                <div class="timeline-desc">
                                    Dinas Pekerjaan Umum menilai kesesuaian tata ruang berdasarkan dokumen Pertek BPN. Notifikasi dikirim ke pemohon.
                                </div>
                                @if($application->dinas_pu_notes)
                                    <div class="timeline-notes" style="border-left-color: {{ in_array($application->status, ['menunggu_satu_pintu','disetujui']) ? 'var(--clr-green)' : '#E53E3E' }}; background: {{ in_array($application->status, ['menunggu_satu_pintu','disetujui']) ? '#F4FBF7' : '#FFF5F5' }}; color: {{ in_array($application->status, ['menunggu_satu_pintu','disetujui']) ? '#137333' : '#C53030' }}">
                                        <strong>Catatan Dinas PU:</strong> {{ $application->dinas_pu_notes }}
                                    </div>
                                @endif
                            </div>

                            <!-- STEP 7: Penerbitan PKKPR Satu Pintu -->
                            @php
                                $step7Status = '';
                                if (in_array($application->status, ['menunggu_satu_pintu', 'disetujui'])) {
                                    $step7Status = $application->status === 'disetujui' ? 'completed' : 'active';
                                }
                            @endphp
                            <div class="timeline-step {{ $step7Status }}">
                                <span class="timeline-dot"></span>
                                <div class="timeline-title">6. Penerbitan PKKPR (Satu Pintu / PTSP)</div>
                                <div class="timeline-desc">
                                    Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu menerbitkan dokumen PKKPR resmi.
                                </div>
                                @if($application->satu_pintu_no_pkkpr)
                                    <div class="timeline-notes" style="border-left-color: var(--clr-green); background: #F4FBF7; color: #137333;">
                                        <strong>No. PKKPR:</strong> {{ $application->satu_pintu_no_pkkpr }}
                                        @if($application->satu_pintu_tanggal_terbit)
                                            <br><strong>Tanggal Terbit:</strong> {{ $application->satu_pintu_tanggal_terbit->format('d-m-Y') }}
                                        @endif
                                    </div>
                                @endif
                            </div>

                            <!-- STEP 8: Selesai / Ditolak -->
                            @php
                                $doneStepStatus = '';
                                if ($application->status === 'disetujui') {
                                    $doneStepStatus = 'completed';
                                } elseif ($application->status === 'ditolak') {
                                    $doneStepStatus = 'rejected';
                                }
                            @endphp
                            <div class="timeline-step {{ $doneStepStatus }}">
                                <span class="timeline-dot"></span>
                                <div class="timeline-title">
                                    @if($application->status === 'ditolak')
                                        Permohonan Ditolak
                                    @else
                                        Permohonan Selesai & Disetujui
                                    @endif
                                </div>
                                <div class="timeline-desc">
                                    @if($application->status === 'ditolak')
                                        Permohonan dihentikan/ditolak oleh instansi terkait (BPN atau Dinas PU).
                                    @elseif($application->status === 'disetujui')
                                        Seluruh alur selesai. Dokumen PKKPR PSN siap diunduh dari portal.
                                    @else
                                        Menunggu seluruh tahapan selesai disetujui semua instansi terkait.
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>

</body>
</html>


<script>
document.addEventListener("DOMContentLoaded", function() {
    const actionInputs = document.querySelectorAll("select[name='action'], input[type='radio'][name='action']");
    const revisiContainer = document.getElementById("revisi-berkas-container");
    const notesField = document.getElementById("notes");
    const checkboxes = document.querySelectorAll(".cb-revisi");

    function updateRevisiVisibility() {
        let isReject = false;
        actionInputs.forEach(input => {
            if (input.tagName === "SELECT" && input.value === "reject") isReject = true;
            if (input.tagName === "INPUT" && input.checked && input.value === "reject") isReject = true;
        });
        if (revisiContainer) {
            revisiContainer.style.display = isReject ? "block" : "none";
            if(!isReject) {
                checkboxes.forEach(cb => cb.checked = false);
            }
        }
    }

    actionInputs.forEach(input => {
        input.addEventListener("change", updateRevisiVisibility);
    });
    
    // Initial check
    updateRevisiVisibility();

    checkboxes.forEach(cb => {
        cb.addEventListener("change", function() {
            let selected = Array.from(checkboxes).filter(i => i.checked).map(i => "- " + i.value);
            let currentNote = notesField.value.replace(/Berkas yang harus diperbaiki:\n(- .*\n?)+\n\n/g, "").replace(/Berkas yang harus diperbaiki:\n(- .*\n?)+/g, "").trim();
            
            if (selected.length > 0) {
                notesField.value = "Berkas yang harus diperbaiki:\n" + selected.join("\n") + "\n\n" + currentNote;
            } else {
                notesField.value = currentNote;
            }
        });
    });
});
</script>
