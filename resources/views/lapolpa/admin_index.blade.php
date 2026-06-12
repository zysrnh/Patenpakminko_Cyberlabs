<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin LAPOL PAK  PATEN PAK MIKO</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --clr-primary: #1A365D;
            --clr-primary-light: #2B6CB0;
            --clr-accent: #3182CE;
            --clr-bg: #F7FAFC;
            --clr-card-bg: #FFFFFF;
            --clr-text: #2D3748;
            --clr-muted: #718096;
            --clr-line: #E2E8F0;
            --clr-green: #38A169;
            --clr-green-light: #C6F6D5;
            --clr-red: #E53E3E;
            --clr-red-light: #FED7D7;
        }
 
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
 
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--clr-bg);
            color: var(--clr-text);
            line-height: 1.6;
            padding-bottom: 60px;
        }
 
        /* Header */
        header {
            background-color: var(--clr-primary);
            color: #FFFFFF;
            padding: 16px 0;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            position: sticky;
            top: 0;
            z-index: 100;
        }
 
        .container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 0 20px;
        }
 
        .header-inner {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
 
        .logo-wrap {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: #FFFFFF;
        }
 
        .logo-icon {
            width: 38px;
            height: 38px;
            background: var(--clr-blue);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 8px rgba(49, 130, 206, 0.3);
        }
 
        .logo-icon svg {
            width: 20px;
            height: 20px;
            fill: none;
            stroke: #FFFFFF;
            stroke-width: 2.5;
        }
 
        .logo-text strong {
            display: block;
            font-size: 15px;
            font-weight: 800;
            letter-spacing: 0.5px;
        }
 
        .logo-text span {
            display: block;
            font-size: 11px;
            color: #A0AEC0;
        }
 
        .nav-menu {
            display: flex;
            align-items: center;
            gap: 20px;
        }
 
        .nav-link {
            color: #E2E8F0;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            transition: color 0.2s;
        }
 
        .nav-link:hover, .nav-link.active {
            color: #FFFFFF;
        }
 
        .btn-logout {
            background-color: rgba(229, 62, 62, 0.2);
            color: #FEB2B2;
            border: 1px solid rgba(229, 62, 62, 0.3);
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: all 0.2s;
        }
 
        .btn-logout:hover {
            background-color: var(--clr-red);
            color: #FFFFFF;
        }
 
        /* Main Layout */
        main {
            margin-top: 32px;
        }
 
        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--clr-accent);
            text-decoration: none;
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 20px;
            transition: transform 0.2s;
        }
 
        .back-link:hover {
            transform: translateX(-4px);
        }
 
        .page-title-section {
            margin-bottom: 24px;
        }
 
        .page-title {
            font-size: 24px;
            font-weight: 800;
            color: var(--clr-primary);
        }
 
        .page-subtitle {
            font-size: 14px;
            color: var(--clr-muted);
            margin-top: 4px;
        }
 
        .alert-success {
            background-color: var(--clr-green-light);
            color: #22543D;
            border: 1px solid #9AE6B4;
            padding: 16px;
            border-radius: 12px;
            margin-bottom: 24px;
            font-size: 13px;
            font-weight: 600;
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }
 
        /* Pemberitahuan Baru (Alert Booking Active) */
        .notification-banner {
            background-color: #EBF8FF;
            color: #2B6CB0;
            border: 1.5px solid #BEE3F8;
            padding: 18px;
            border-radius: 14px;
            margin-bottom: 28px;
            font-size: 13.5px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 4px 10px rgba(43, 108, 176, 0.05);
        }
 
        .notification-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }
 
        .notification-info svg {
            color: var(--clr-accent);
            flex-shrink: 0;
        }
 
        /* Cards & Table */
        .card {
            background-color: var(--clr-card-bg);
            border: 1.5px solid var(--clr-line);
            border-radius: 16px;
            padding: 28px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.02);
        }
 
        .card-title {
            font-size: 18px;
            font-weight: 800;
            color: var(--clr-primary);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            border-bottom: 1.5px solid var(--clr-line);
            padding-bottom: 12px;
        }
 
        .table-responsive {
            overflow-x: auto;
        }
 
        .table-modern {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            font-size: 13.5px;
        }
 
        .table-modern th {
            background-color: #F7FAFC;
            color: var(--clr-primary);
            font-weight: 800;
            padding: 14px 16px;
            border-bottom: 2px solid var(--clr-line);
        }
 
        .table-modern td {
            padding: 14px 16px;
            border-bottom: 1px solid var(--clr-line);
            vertical-align: middle;
        }
 
        .table-modern tr:hover {
            background-color: #FAFCFF;
        }
 
        .badge-status {
            padding: 4px 12px;
            border-radius: 100px;
            font-size: 11px;
            font-weight: 700;
            color: #FFFFFF;
            display: inline-block;
        }
 
        /* Action Forms */
        .status-select {
            padding: 6px 10px;
            border-radius: 8px;
            border: 1.5px solid var(--clr-line);
            font-size: 12px;
            font-weight: 600;
            color: var(--clr-text);
            outline: none;
            background-color: #FFFFFF;
            cursor: pointer;
            transition: all 0.2s;
        }
 
        .status-select:focus {
            border-color: var(--clr-accent);
        }
 
        .btn-update {
            background-color: var(--clr-accent);
            color: #FFFFFF;
            border: none;
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 11px;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.2s;
        }
 
        .btn-update:hover {
            background-color: var(--clr-primary-light);
        }
 
        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: var(--clr-muted);
        }
 
        .empty-state svg {
            width: 48px;
            height: 48px;
            margin-bottom: 12px;
            color: var(--clr-line);
        }

        /* ─── CALENDAR ──────────────────────────── */
        .cal-wrap { background: #fff; border: 1.5px solid var(--clr-line); border-radius: 16px; padding: 24px; margin-bottom: 28px; }
        .cal-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px; }
        .cal-header h2 { font-size: 16px; font-weight: 800; color: var(--clr-primary); }
        .cal-nav { display: flex; align-items: center; gap: 8px; }
        .cal-nav button { width: 30px; height: 30px; border: 1.5px solid var(--clr-line); background: #fff; border-radius: 8px; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all .2s; }
        .cal-nav button:hover { background: var(--clr-accent); border-color: var(--clr-accent); }
        .cal-nav button:hover svg { stroke: #fff; }
        .cal-nav button svg { width: 14px; height: 14px; fill: none; stroke: var(--clr-primary); stroke-width: 2.5; stroke-linecap: round; }
        .cal-month-label { font-size: 15px; font-weight: 700; color: var(--clr-primary); min-width: 140px; text-align: center; }
        .cal-grid { display: grid; grid-template-columns: repeat(7, 1fr); gap: 4px; }
        .cal-day-name { text-align: center; font-size: 11px; font-weight: 700; color: var(--clr-muted); text-transform: uppercase; padding: 6px 0; }
        .cal-cell { min-height: 56px; border-radius: 10px; padding: 6px; position: relative; cursor: default; transition: background .15s; }
        .cal-cell.has-booking { cursor: pointer; background: #EBF8FF; border: 1.5px solid #BEE3F8; }
        .cal-cell.has-booking:hover { background: #BEE3F8; }
        .cal-cell.today .cal-num { background: var(--clr-accent); color: #fff; border-radius: 50%; width: 26px; height: 26px; display: inline-flex; align-items: center; justify-content: center; }
        .cal-cell.other-month { opacity: .3; }
        .cal-num { font-size: 13px; font-weight: 600; color: var(--clr-text); display: block; text-align: center; }
        .cal-dots { display: flex; flex-wrap: wrap; justify-content: center; gap: 3px; margin-top: 4px; }
        .cal-dot { width: 7px; height: 7px; border-radius: 50%; flex-shrink: 0; }
        .cal-dot.booked { background: #3182CE; }
        .cal-dot.diterima { background: #D69E2E; }
        .cal-dot.selesai { background: #38A169; }
        .cal-dot.dibatalkan { background: #E53E3E; }
        .cal-legend { display: flex; gap: 16px; margin-top: 16px; flex-wrap: wrap; }
        .cal-legend-item { display: flex; align-items: center; gap: 5px; font-size: 11px; color: var(--clr-muted); font-weight: 600; }
        .cal-booking-popup { background: var(--clr-primary); color: #fff; border-radius: 10px; padding: 10px 14px; font-size: 12px; position: absolute; z-index: 50; min-width: 180px; display: none; top: 62px; left: 0; box-shadow: 0 8px 24px rgba(0,0,0,0.2); }
        .cal-booking-popup.active { display: block; }
        .cal-booking-popup h4 { font-size: 12px; font-weight: 700; margin-bottom: 6px; border-bottom: 1px solid rgba(255,255,255,0.2); padding-bottom: 5px; }
        .cal-popup-row { display: flex; align-items: center; gap: 6px; margin-top: 4px; }
        .cal-popup-dot { width: 7px; height: 7px; border-radius: 50%; flex-shrink: 0; }
    </style>
</head>
<body>
 
    <!-- Header -->
    <header>
        <div class="container">
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
                    <a href="{{ route('dashboard') }}" class="nav-link active">Dashboard</a>
                    <form action="{{ route('logout') }}" method="POST" style="margin-left: 8px;">
                        @csrf
                        <button type="submit" class="btn-logout">
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
            
            <a href="{{ route('dashboard') }}" class="back-link">
                <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Kembali ke Dashboard
            </a>
 
            <div class="page-title-section">
                <h1 class="page-title">Pengelolaan Booking LAPOL PAK (Admin)</h1>
                <p class="page-subtitle">Kelola dan update status pendaftaran pelaporan pelaku usaha secara real-time.</p>
            </div>
 
            <!-- Success Message -->
            @if(session('success'))
                <div class="alert-success" style="flex-wrap: wrap;">
                    <div style="display: flex; align-items: flex-start; gap: 12px; width: 100%;">
                        <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>{{ session('success') }}</span>
                    </div>
                    
                    @if(session('wa_links'))
                        <div style="margin-top: 12px; border-top: 1px solid rgba(0,100,0,0.1); padding-top: 12px; width: 100%;">
                            <strong style="display:block; margin-bottom: 8px; color: #0F5132;">Kirim Notifikasi WhatsApp (Manual):</strong>
                            <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                                @foreach(session('wa_links') as $index => $link)
                                    <a href="{{ $link['url'] }}" target="_blank" style="background: #25D366; color: #fff; border:none; padding: 6px 12px; font-size: 12px; text-decoration: none; display: inline-flex; align-items: center; border-radius: 6px;" id="wa-link-layout-{{ $index }}">
                                        <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" style="margin-right: 4px;"><path d="M22 2L11 13M22 2l-7 20-4-9-9-4 20-7z"/></svg>
                                        Kirim ke {{ $link['target'] }}
                                    </a>
                                @endforeach
                            </div>
                            <script>
                                setTimeout(function() {
                                    var firstWaLink = document.getElementById('wa-link-layout-0');
                                    if(firstWaLink) {
                                        window.open(firstWaLink.href, '_blank');
                                    }
                                }, 500);
                            </script>
                        </div>
                    @endif
                </div>
            @endif
 
            <!-- Pemberitahuan Baru (Jika ada booking terjadwal) -->
            @php
                $bookedCount = $bookings->where('status', 'booked')->count();
            @endphp
 
            @if($bookedCount > 0)
                <div class="notification-banner">
                    <div class="notification-info">
                        <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                        <strong>Terdapat {{ $bookedCount }} Jadwal LAPOL PAK Aktif (Booked) yang memerlukan tindak lanjut hari ini.</strong>
                    </div>
                </div>
            @endif
 
            <!-- Table Card -->

            {{-- KALENDER JADWAL LAPOL PAK --}}
            @php
                use Carbon\Carbon;
                $allBookings = $bookings;
                // Group bookings by date
                $bookingsByDate = [];
                foreach ($allBookings as $b) {
                    $key = Carbon::parse($b->booking_date)->format("Y-m-d");
                    $bookingsByDate[$key][] = $b;
                }
            @endphp

            <div class="cal-wrap" id="cal-wrap">
                <div class="cal-header">
                    <h2>
                        <svg width="16" height="16" style="margin-right:6px;vertical-align:-2px;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        Kalender Jadwal Booking
                    </h2>
                    <div class="cal-nav">
                        <button id="cal-prev" title="Bulan sebelumnya"><svg viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"/></svg></button>
                        <span class="cal-month-label" id="cal-month-label"></span>
                        <button id="cal-next" title="Bulan berikutnya"><svg viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg></button>
                    </div>
                </div>
                <div class="cal-grid" id="cal-grid">
                    <div class="cal-day-name">Min</div>
                    <div class="cal-day-name">Sen</div>
                    <div class="cal-day-name">Sel</div>
                    <div class="cal-day-name">Rab</div>
                    <div class="cal-day-name">Kam</div>
                    <div class="cal-day-name">Jum</div>
                    <div class="cal-day-name">Sab</div>
                </div>
                <div class="cal-legend">
                    <div class="cal-legend-item"><span class="cal-dot booked"></span> Booked</div>
                    <div class="cal-legend-item"><span class="cal-dot diterima"></span> Diterima</div>
                    <div class="cal-legend-item"><span class="cal-dot selesai"></span> Selesai</div>
                    <div class="cal-legend-item"><span class="cal-dot dibatalkan"></span> Dibatalkan</div>
                </div>
            </div>

            <script>
                (function() {
                    var bookings = @json($bookingsByDate);
                    var today = new Date();
                    var currentYear = today.getFullYear();
                    var currentMonth = today.getMonth();

                    var monthNames = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
                    var statusColors = { booked: "#3182CE", diterima: "#D69E2E", selesai: "#38A169", dibatalkan: "#E53E3E" };

                    function pad(n) { return n < 10 ? "0" + n : "" + n; }

                    function renderCalendar(year, month) {
                        document.getElementById("cal-month-label").textContent = monthNames[month] + " " + year;

                        var grid = document.getElementById("cal-grid");
                        // Remove old cells (keep day names = first 7)
                        while (grid.children.length > 7) {
                            grid.removeChild(grid.lastChild);
                        }

                        var firstDay = new Date(year, month, 1).getDay();
                        var daysInMonth = new Date(year, month + 1, 0).getDate();
                        var prevDays = new Date(year, month, 0).getDate();

                        // Previous month padding
                        for (var i = firstDay - 1; i >= 0; i--) {
                            var cell = document.createElement("div");
                            cell.className = "cal-cell other-month";
                            cell.innerHTML = "<span class=\"cal-num\">" + (prevDays - i) + "</span>";
                            grid.appendChild(cell);
                        }

                        // Current month days
                        for (var d = 1; d <= daysInMonth; d++) {
                            var dateKey = year + "-" + pad(month + 1) + "-" + pad(d);
                            var cell = document.createElement("div");
                            cell.className = "cal-cell";
                            cell.style.position = "relative";

                            // Today highlight
                            if (year === today.getFullYear() && month === today.getMonth() && d === today.getDate()) {
                                cell.classList.add("today");
                            }

                            var dayBookings = bookings[dateKey] || [];
                            if (dayBookings.length > 0) {
                                cell.classList.add("has-booking");
                            }

                            var numEl = document.createElement("span");
                            numEl.className = "cal-num";
                            numEl.textContent = d;
                            cell.appendChild(numEl);

                            if (dayBookings.length > 0) {
                                var dotsWrap = document.createElement("div");
                                dotsWrap.className = "cal-dots";
                                var shown = Math.min(dayBookings.length, 3);
                                for (var j = 0; j < shown; j++) {
                                    var dot = document.createElement("span");
                                    dot.className = "cal-dot " + (dayBookings[j].status || "booked");
                                    dot.style.background = statusColors[dayBookings[j].status] || "#3182CE";
                                    dotsWrap.appendChild(dot);
                                }
                                if (dayBookings.length > 3) {
                                    var more = document.createElement("span");
                                    more.style.cssText = "font-size:9px;color:var(--clr-muted);font-weight:700;";
                                    more.textContent = "+" + (dayBookings.length - 3);
                                    dotsWrap.appendChild(more);
                                }
                                cell.appendChild(dotsWrap);

                                // Popup
                                var popup = document.createElement("div");
                                popup.className = "cal-booking-popup";
                                var formattedDate = pad(d) + " " + monthNames[month] + " " + year;
                                popup.innerHTML = "<h4>📋 " + formattedDate + " (" + dayBookings.length + " booking)</h4>";
                                dayBookings.forEach(function(b) {
                                    var name = b.nama_pemohon || "Tamu";
                                    var timeStart = b.time_start ? b.time_start.substring(0,5) : "--";
                                    var timeEnd = b.time_end ? b.time_end.substring(0,5) : "--";
                                    var dotColor = statusColors[b.status] || "#3182CE";
                                    popup.innerHTML += "<div class=\"cal-popup-row\"><span class=\"cal-popup-dot\" style=\"background:" + dotColor + "\"></span><span>" + name + " · " + timeStart + "-" + timeEnd + " WIB</span></div>";
                                });
                                cell.appendChild(popup);

                                cell.addEventListener("click", function(e) {
                                    e.stopPropagation();
                                    var p = this.querySelector(".cal-booking-popup");
                                    var wasActive = p.classList.contains("active");
                                    document.querySelectorAll(".cal-booking-popup.active").forEach(function(el) { el.classList.remove("active"); });
                                    if (!wasActive) p.classList.add("active");
                                });
                            }

                            grid.appendChild(cell);
                        }

                        // Next month padding
                        var totalCells = firstDay + daysInMonth;
                        var remaining = totalCells % 7 === 0 ? 0 : 7 - (totalCells % 7);
                        for (var k = 1; k <= remaining; k++) {
                            var cell2 = document.createElement("div");
                            cell2.className = "cal-cell other-month";
                            cell2.innerHTML = "<span class=\"cal-num\">" + k + "</span>";
                            grid.appendChild(cell2);
                        }
                    }

                    renderCalendar(currentYear, currentMonth);

                    document.getElementById("cal-prev").addEventListener("click", function() {
                        currentMonth--;
                        if (currentMonth < 0) { currentMonth = 11; currentYear--; }
                        renderCalendar(currentYear, currentMonth);
                    });
                    document.getElementById("cal-next").addEventListener("click", function() {
                        currentMonth++;
                        if (currentMonth > 11) { currentMonth = 0; currentYear++; }
                        renderCalendar(currentYear, currentMonth);
                    });

                    document.addEventListener("click", function() {
                        document.querySelectorAll(".cal-booking-popup.active").forEach(function(el) { el.classList.remove("active"); });
                    });
                })();
            </script>

            <div class="card">
                <h3 class="card-title">Daftar Pendaftar LAPOL PAK</h3>
 
                <div class="table-responsive">
                    @if($bookings->isEmpty())
                        <div class="empty-state">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/>
                            </svg>
                            <p>Belum ada pendaftaran booking jadwal LAPOL PAK dari pelaku usaha.</p>
                        </div>
                    @else
                        <table class="table-modern">
                            <thead>
                                <tr>
                                    <th>Pelaku Usaha (Pemohon)</th>
                                    <th>Nomor WhatsApp</th>
                                    <th>Tanggal Booking</th>
                                    <th>Rentang Waktu</th>
                                    <th>Status</th>
                                    <th style="width: 220px;">Aksi Admin</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bookings as $booking)
                                    <tr>
                                        <td>
                                            <strong>{{ $booking->nama_pemohon ?? ($booking->user ? ($booking->user->name ?? $booking->user->username) : 'Tamu') }}</strong>
                                            <div style="font-size: 11px; color: var(--clr-muted);">{{ $booking->user ? 'Username: ' . $booking->user->username : 'Pendaftar Publik (Tanpa Akun)' }}</div>
                                        </td>
                                        <td>
                                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $booking->whatsapp_number) }}" target="_blank" style="color: var(--clr-accent); text-decoration: none; font-weight: 600;">
                                                {{ $booking->whatsapp_number }} ?
                                            </a>
                                        </td>
                                        <td>{{ $booking->formatted_date }}</td>
                                        <td style="color: var(--clr-accent); font-weight: 700;">{{ $booking->formatted_time_range }}</td>
                                        <td>
                                            <span class="badge-status" style="background-color: {{ $booking->status_color }};">
                                                {{ $booking->status_label }}
                                            </span>
                                        </td>
                                        <td>
                                            <form action="{{ route('lapolpa.update', $booking->id) }}" method="POST" style="display: flex; flex-direction: column; gap: 8px;">
                                                @csrf
                                                @method('PUT')
                                                <div style="display: flex; gap: 8px; align-items: center;">
                                                    <select name="status" class="status-select">
                                                        <option value="booked" {{ $booking->status === 'booked' ? 'selected' : '' }}>Booked</option>
                                                        <option value="diterima" {{ $booking->status === 'diterima' ? 'selected' : '' }}>Diterima</option>
                                                        <option value="selesai" {{ $booking->status === 'selesai' ? 'selected' : '' }}>Selesai</option>
                                                        <option value="dibatalkan" {{ $booking->status === 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                                                    </select>
                                                    <button type="submit" class="btn-update">Update</button>
                                                </div>
                                                <input type="text" name="admin_note" placeholder="Catatan untuk pemohon (Opsional)" value="{{ $booking->admin_note }}" style="width: 100%; padding: 6px 10px; border: 1px solid var(--clr-line); border-radius: 4px; font-size: 11px;">
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
 
        </div>
    </main>
 
</body>
</html>
