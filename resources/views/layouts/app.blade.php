<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PATEN PAK MIKO')</title>

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('storage/ico/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('storage/ico/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('storage/ico/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('storage/ico/site.webmanifest') }}">
    <link rel="shortcut icon" href="{{ asset('storage/ico/favicon.ico') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
    
    <!-- Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/airbnb.css">
    <style>
        .flatpickr-calendar .flatpickr-day.flatpickr-disabled:not(.prevMonthDay):not(.nextMonthDay) {
            color: #E53E3E !important;
            background-color: #FFF5F5 !important;
            font-weight: 700 !important;
            opacity: 1 !important;
        }
        span.flatpickr-day.disabled.prevMonthDay,
        span.flatpickr-day.disabled.nextMonthDay {
            opacity: 0.4 !important;
            background-color: transparent !important;
        }
        
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
            --surface2:  #E8F2FA;
            --white:     #FFFFFF;
            --r-sm:      4px;
            --r-md:      4px;
            --r-lg:      8px;
            --r-xl:      12px;
            --sidebar:   248px;
        }

        html {
            overflow-x: clip !important;
            max-width: 100vw;
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
            width: 100%;
        }

        /* ─── OVERLAY (mobile) ───────────────── */
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,.45);
            z-index: 999;
        }
        .sidebar-overlay.open { display: block; }

        /* ─── SIDEBAR CSS DI-HANDLE PARTIAL sidebar.blade.php ─── */

        /* ─── MAIN AREA ──────────────────────── */
        .main-wrap {
            margin-left: var(--sidebar);
            flex: 1; display: flex; flex-direction: column;
            min-height: 100vh;
            min-width: 0;
            width: calc(100% - var(--sidebar));
            max-width: 100%;
            transition: margin-left .2s ease, width .2s ease;
        }


        /* ─── CONTENT ────────────────────────── */
        .content { padding: 24px 28px; flex: 1; min-width: 0; width: 100%; overflow-x: hidden; background: #F4F7FA; }

        /* ─── PAGE HEADER ────────────────────── */
        .page-header {
            display: flex; align-items: center; justify-content: space-between;
            margin-bottom: 24px;
        }
        .page-header-left { display: flex; flex-direction: column; }
        .page-header h1 { font-size: 20px; font-weight: 800; color: var(--ink); letter-spacing: -.02em; }
        .page-header p { font-size: 13px; color: var(--muted); margin-top: 3px; }
        .breadcrumb { font-size: 12px; color: var(--muted); display: flex; align-items: center; gap: 6px; margin-bottom: 6px; }
        .breadcrumb a { color: var(--blue); text-decoration: none; font-weight: 600; }

        /* ─── PANEL / CARD ───────────────────── */
        .panel { background: var(--white); border: 1px solid var(--line); border-radius: var(--r-lg); }
        .panel + .panel { margin-top: 20px; }
        .panel-head { display: flex; align-items: center; justify-content: space-between; padding: 16px 20px 14px; border-bottom: 1px solid var(--line); }
        .panel-head h2 { font-size: 14px; font-weight: 800; color: var(--ink); }
        .panel-head-link { font-size: 12px; font-weight: 700; color: var(--blue); text-decoration: none; }
        .panel-body { padding: 20px; }

        /* ─── ALERTS ─────────────────────────── */
        .alert { display: flex; align-items: center; gap: 10px; padding: 12px 16px; border-radius: var(--r-md); font-size: 13px; font-weight: 500; margin-bottom: 20px; }
        .alert svg { width: 16px; height: 16px; flex-shrink: 0; }
        .alert-success { background: #E6F4EA; border: 1px solid #B8E2C8; color: #137333; }
        .alert-error   { background: #FCE8E6; border: 1px solid #F8B4B4; color: #C5221F; }
        .alert-warning { background: #FFFDF0; border: 1.5px solid #FBE89F; color: #744210; display: flex; justify-content: space-between; }
        .alert-link { background: var(--yellow); color: #744210; border: none; padding: 7px 14px; border-radius: var(--r-md); font-family: inherit; font-size: 12px; font-weight: 700; cursor: pointer; text-decoration: none; white-space: nowrap; }

        /* ─── FORM ELEMENTS ──────────────────── */
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 18px; }
        .form-group { margin-bottom: 18px; }
        .form-label { display: block; font-size: 12.5px; font-weight: 600; color: var(--ink); margin-bottom: 7px; }
        .form-label span { color: #E53E3E; }
        .form-control {
            width: 100%; padding: 10px 14px;
            font-family: inherit; font-size: 14px; font-weight: 500; color: var(--ink);
            background: var(--white); border: 1.5px solid var(--line);
            border-radius: var(--r-md); transition: all .2s; outline: none;
        }
        .form-control:focus { border-color: var(--blue); box-shadow: 0 0 0 3px var(--blue-lt); }
        .form-control:disabled, .form-control[readonly] { background: var(--surface); color: var(--muted); cursor: not-allowed; }
        .form-hint { font-size: 11.5px; color: var(--muted); margin-top: 5px; }
        .form-error { font-size: 11.5px; color: #C5221F; margin-top: 5px; display: flex; align-items: center; gap: 4px; }

        textarea.form-control { resize: vertical; min-height: 90px; }
        select.form-control { cursor: pointer; }

        /* ─── BUTTONS ────────────────────────── */
        .btn { display: inline-flex; align-items: center; justify-content: center; gap: 7px; padding: 10px 20px; font-family: inherit; font-size: 13.5px; font-weight: 700; border-radius: var(--r-md); cursor: pointer; border: none; text-decoration: none; transition: all .18s; }
        .btn svg { width: 15px; height: 15px; fill: none; stroke: currentColor; stroke-width: 2.5; stroke-linecap: round; stroke-linejoin: round; }
        .btn-primary { background: var(--blue); color: #fff; }
        .btn-primary:hover { background: var(--blue-dk); box-shadow: 0 4px 12px rgba(33,138,201,.25); }
        .btn-secondary { background: var(--surface); color: var(--mid); border: 1px solid var(--line); }
        .btn-secondary:hover { background: var(--blue-lt); border-color: var(--blue-md); color: var(--blue); }
        .btn-danger { background: #FFF5F5; color: #C53030; border: 1px solid #FED7D7; }
        .btn-danger:hover { background: #C53030; color: #fff; }
        .btn-sm { padding: 7px 14px; font-size: 12px; }
        .btn-full { width: 100%; }

        /* ─── TABLE ──────────────────────────── */
        .table-wrap {
            overflow-x: auto !important;
            -webkit-overflow-scrolling: touch !important;
            width: 100% !important;
            display: block !important;
        }
        .table-wrap table {
            min-width: 780px !important;
            width: 100% !important;
            border-collapse: collapse !important;
            font-size: 13px !important;
        }
        thead th {
            padding: 10px 14px !important;
            text-align: left;
            font-size: 11px !important;
            font-weight: 800 !important;
            text-transform: uppercase;
            letter-spacing: .05em;
            color: var(--muted);
            background: var(--surface);
            border-bottom: 1px solid var(--line);
            white-space: nowrap !important;
        }
        tbody td {
            padding: 12px 14px !important;
            border-bottom: 1px solid var(--line);
            color: var(--ink);
            vertical-align: middle;
            white-space: nowrap !important;
        }
        tbody tr:last-child td { border-bottom: none; }
        tbody tr:hover td { background: var(--surface); }

        /* ─── BADGE / STATUS ─────────────────── */
        .badge { display: inline-flex; align-items: center; gap: 4px; padding: 3px 10px; border-radius: 20px; font-size: 11px; font-weight: 700; white-space: nowrap; }
        .badge-blue    { background: var(--blue-lt); color: var(--blue); }
        .badge-green   { background: var(--green-lt); color: var(--green-dk); }
        .badge-yellow  { background: var(--yellow-lt); color: #92600A; }
        .badge-red     { background: #FFF5F5; color: #C53030; }
        .badge-gray    { background: var(--surface2); color: var(--muted); }

        /* ─── EMPTY STATE ────────────────────── */
        .empty-state { text-align: center; padding: 48px 24px; }
        .empty-state svg { width: 48px; height: 48px; fill: none; stroke: var(--blue-md); stroke-width: 1.5; margin-bottom: 14px; }
        .empty-state h3 { font-size: 15px; font-weight: 700; color: var(--ink); margin-bottom: 6px; }
        .empty-state p { font-size: 13px; color: var(--muted); margin-bottom: 18px; }

        /* ─── GLOBAL PAGINATION ──────────────── */
        .pagination {
            display: flex !important;
            list-style: none !important;
            padding: 0 !important;
            margin: 0 !important;
            gap: 4px !important;
            align-items: center !important;
        }
        .pagination li {
            display: inline-block !important;
            margin: 0 !important;
            list-style: none !important;
        }
        .pagination li::before {
            content: none !important;
        }
        .page-item .page-link, .pagination li a, .pagination li span {
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            min-width: 32px !important;
            height: 32px !important;
            padding: 0 10px !important;
            border: 1px solid #CBD5E1 !important;
            border-radius: 4px !important;
            color: #218AC9 !important;
            font-size: 12px !important;
            font-weight: 700 !important;
            text-decoration: none !important;
            background: #FFFFFF !important;
            box-sizing: border-box !important;
            transition: all 0.15s ease !important;
        }
        .pagination li.active .page-link, .pagination li.active span, .pagination li.active a {
            background: #218AC9 !important;
            color: #FFFFFF !important;
            border-color: #218AC9 !important;
        }
        .pagination li.disabled .page-link, .pagination li.disabled span {
            color: #94A3B8 !important;
            background: #F8FAFC !important;
            border-color: #E2E8F0 !important;
            cursor: not-allowed !important;
        }
        .pagination li a:hover {
            background: #EFF6FF !important;
            border-color: #218AC9 !important;
        }

        /* ─── GLOBAL SMOOTH MICRO-ANIMATIONS ───────────────── */
        @keyframes fadeSlideUp {
            from {
                opacity: 0;
                transform: translateY(8px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .panel, .profile-card, .welcome-card, .kpi-card, .alert, .page-header {
            animation: fadeSlideUp 0.26s cubic-bezier(0.22, 1, 0.36, 1) both;
        }

        .btn, .btn-primary, .btn-save, .btn-cancel, .avatar-upload-btn {
            transition: background-color 0.16s ease, border-color 0.16s ease, color 0.16s ease, transform 0.1s ease !important;
        }

        .btn:active, .btn-primary:active, .btn-save:active, .btn-cancel:active, .avatar-upload-btn:active {
            transform: scale(0.98) !important;
        }

        @media (prefers-reduced-motion: reduce) {
            .panel, .profile-card, .welcome-card, .kpi-card, .alert, .page-header, .profile-intro {
                animation: none !important;
            }
        }

        /* ─── MOBILE RESPONSIVE ──────────────── */
        @media (max-width: 768px) {
            html, body {
                display: block;
                overflow-x: hidden !important;
                width: 100% !important;
                max-width: 100vw !important;
            }

            .main-wrap {
                margin-left: 0 !important;
                width: 100% !important;
                max-width: 100% !important;
                overflow-x: hidden !important;
            }

            .content {
                padding: 14px !important;
                width: 100% !important;
                max-width: 100% !important;
                box-sizing: border-box !important;
                overflow-x: hidden !important;
            }

            .form-grid { grid-template-columns: 1fr; }

            .page-header { flex-direction: column; align-items: flex-start; gap: 12px; }

            table { font-size: 12px; }
            thead th, tbody td { padding: 10px 10px; }

            .table-filter-wrap {
                flex-direction: column !important;
                align-items: stretch !important;
                gap: 10px !important;
                padding: 12px 14px !important;
            }
            .table-filter-wrap > * {
                width: 100% !important;
                min-width: 0 !important;
            }
            .search-box {
                width: 100% !important;
            }
        }

        @media (max-width: 480px) {
            .content { padding: 12px; }
            .panel-body { padding: 14px; }
            .btn { padding: 9px 16px; font-size: 13px; }
        }

        @yield('extra-styles')
    </style>
    @yield('head-extra')
</head>
<body>
    <!-- Overlay mobile -->
    <div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>

    <!-- SIDEBAR -->
    @include('layouts.partials.sidebar')

    <!-- MAIN WRAP -->
    <div class="main-wrap">
        @php
            $pageTitleStr = trim($__env->yieldContent('page-title'));
            if(empty($pageTitleStr)) $pageTitleStr = null;
        @endphp
        @include('layouts.partials.dashboard-topbar', ['pageTitle' => $pageTitleStr])

        <div class="content">
            @if(session('success'))
                <div class="alert alert-success">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-error">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    <script>
        // Sidebar scroll persistence & mobile toggle
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

        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('open');
            document.getElementById('sidebarOverlay').classList.toggle('open');
        }
        function closeSidebar() {
            document.getElementById('sidebar').classList.remove('open');
            document.getElementById('sidebarOverlay').classList.remove('open');
        }
    </script>
    @yield('scripts')

<script>
document.addEventListener('DOMContentLoaded', function() {
    const textareas = document.querySelectorAll('textarea[name="custom_wa_message"]');
    textareas.forEach(ta => {
        const form = ta.closest('form');
        if (!form || form.dataset.waInit === '1' || form.querySelector('.btn-edit-wa')) return;
        const waTypeInput = form.querySelector('input[name="wa_type"]');
        if (waTypeInput) {
            form.dataset.waInit = '1';
            ta.readOnly = true;
            ta.style.backgroundColor = '#f4f7f9';
            ta.style.color = '#555';
            
            const btn = document.createElement('button');
            btn.type = 'button';
            btn.className = 'btn-edit-wa';
            btn.innerHTML = '✏️ Rubah Pesan WA';
            btn.style.cssText = 'display:inline-block; margin-bottom:8px; background:#3291A8; color:#fff; border:none; padding:6px 12px; border-radius:4px; font-size:12px; font-weight:600; cursor:pointer;';
            
            ta.parentNode.insertBefore(btn, ta);
            
            btn.addEventListener('click', function() {
                ta.readOnly = false;
                ta.style.backgroundColor = '#fff';
                ta.style.color = '#000';
                ta.focus();
                btn.style.display = 'none'; 
            });
            
            const pathParts = window.location.pathname.split('/');
            // /layanan/berusaha/123 -> pathParts[1] is 'layanan', [2] is 'berusaha', [3] is id
            // Let's find the type dynamically.
            let type = '';
            if(window.location.pathname.includes('berusaha')) type = 'berusaha';
            if(window.location.pathname.includes('non-berusaha')) type = 'non_berusaha';
            if(window.location.pathname.includes('kebijakan')) type = 'kebijakan';
            if(window.location.pathname.includes('tanah-timbul')) type = 'tanah_timbul';
            if(window.location.pathname.includes('psn')) type = 'psn';
            
            // Extract ID from URL
            const appId = window.location.pathname.split('/').pop();
            
            if(type && appId && !isNaN(appId)) {
                fetch(`/api/wa-template?type=${type}&id=${appId}&wa_type=${waTypeInput.value}`)
                    .then(res => res.json())
                    .then(data => {
                        if(data.template) {
                            ta.value = data.template;
                        }
                    })
                    .catch(err => console.error('Gagal fetch template', err));
            }
        }
    });
});
</script>

    <!-- Flatpickr JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/id.js"></script>
    @php
        $holidays = [];
        try {
            $holidays = \App\Models\Holiday::get()->map(function($h) {
                return \Carbon\Carbon::parse($h->date)->format('Y-m-d');
            })->toArray();
        } catch(\Exception $e) {}
    @endphp
    <script>
        window.appHolidays = {!! json_encode($holidays) !!};
        
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Flatpickr on all datetime-local inputs (skip already initialized)
            document.querySelectorAll('input[type="datetime-local"]:not(.flatpickr-input)').forEach(function(el) {
                if (el._flatpickr) return;
                flatpickr(el, {
                    enableTime: true,
                    dateFormat: "Y-m-d\\TH:i",
                    altInput: true,
                    altFormat: "j F Y - H:i",
                    locale: "id",
                    disable: [
                        function(date) {
                            return (date.getDay() === 0 || date.getDay() === 6);
                        },
                        ...window.appHolidays
                    ]
                });
            });

            // Initialize Flatpickr on date inputs without time if needed
            document.querySelectorAll('input[type="date"]:not(.flatpickr-input)').forEach(function(el) {
                if (el._flatpickr) return;
                flatpickr(el, {
                    dateFormat: "Y-m-d",
                    altInput: true,
                    altFormat: "j F Y",
                    locale: "id",
                    disable: [
                        function(date) {
                            return (date.getDay() === 0 || date.getDay() === 6);
                        },
                        ...window.appHolidays
                    ]
                });
            });

            /* ── Client-side File Size Validation (Max 100MB) ──────── */
            document.querySelectorAll('input[type="file"]').forEach(function(input) {
                input.addEventListener('change', function() {
                    const maxMB = 100;
                    const maxBytes = maxMB * 1024 * 1024;
                    
                    let limitBytes = maxBytes;
                    let limitMB = maxMB;

                    let totalSize = 0;
                    for (let i = 0; i < this.files.length; i++) {
                        totalSize += this.files[i].size;
                    }
                    
                    if (totalSize > limitBytes) {
                        this.value = ''; // Reset input
                        
                        let errorDiv = this.parentElement.querySelector('.file-size-error');
                        if (!errorDiv) {
                            errorDiv = document.createElement('div');
                            errorDiv.className = 'file-size-error';
                            errorDiv.style.cssText = 'color: #E53E3E; font-size: 11px; font-weight: 700; margin-top: 6px; background: #FFF5F5; padding: 6px 10px; border-radius: 4px; border: 1px solid #FED7D7;';
                            this.parentElement.appendChild(errorDiv);
                        }
                        
                        errorDiv.innerHTML = `⚠️ GAGAL! Ukuran file melebihi batas maksimal ${limitMB}MB.`;
                        this.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        
                        errorDiv.animate([
                            { opacity: 0.5, transform: 'scale(0.98)' },
                            { opacity: 1, transform: 'scale(1)' }
                        ], { duration: 300 });
                        
                        alert(`Maaf, ukuran file yang Anda pilih terlalu besar. Maksimal ${limitMB}MB per file.`);
                    } else {
                        let errorDiv = this.parentElement.querySelector('.file-size-error');
                        if (errorDiv) {
                            errorDiv.remove();
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>
