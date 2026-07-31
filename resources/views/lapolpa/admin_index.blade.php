@extends('layouts.app')

@section('title', 'Admin LAPOL PAK — PATEN PAK MIKO')
@section('page-title', 'Admin LAPOL PAK')

@section('extra-styles')
    /* Pemberitahuan Baru (Alert Booking Active) */
    .notification-banner {
        background-color: #EFF6FF;
        color: #1E40AF;
        border: 1px solid #BFDBFE;
        padding: 14px 18px;
        border-radius: 4px;
        margin-bottom: 20px;
        font-size: 13px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        box-shadow: 0 2px 6px rgba(0, 38, 66, 0.02);
    }

    .notification-info {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .notification-info svg {
        color: #2563EB;
        flex-shrink: 0;
    }

    /* Action Forms */
    .status-select {
        padding: 6px 10px;
        border-radius: 4px;
        border: 1.5px solid #CBD5E1;
        font-size: 12px;
        font-weight: 600;
        color: #0F172A;
        outline: none;
        background-color: #FFFFFF;
        cursor: pointer;
        transition: all 0.2s;
    }

    .status-select:focus {
        border-color: #218AC9;
    }

    /* ─── CALENDAR ULTRA CLEAN ──────────────────────────── */
    .cal-wrap { background: #fff; border: 1px solid #E2E8F0; border-radius: 6px; padding: 20px; margin-bottom: 24px; box-shadow: 0 2px 6px rgba(0,38,66,0.02); }
    .cal-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 16px; }
    .cal-header h2 { font-size: 16px; font-weight: 800; color: #003B64; margin: 0; }
    .cal-nav { display: flex; align-items: center; gap: 8px; background: #F8FAFC; padding: 4px 8px; border-radius: 6px; border: 1px solid #E2E8F0; }
    .cal-nav button { width: 28px; height: 28px; border: 1px solid #CBD5E1; background: #fff; border-radius: 4px; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all .18s; }
    .cal-nav button:hover { background: #218AC9; border-color: #218AC9; }
    .cal-nav button:hover svg { stroke: #fff; }
    .cal-nav button svg { width: 13px; height: 13px; fill: none; stroke: #003B64; stroke-width: 2.5; stroke-linecap: round; }
    .cal-month-label { font-size: 14px; font-weight: 800; color: #003B64; min-width: 120px; text-align: center; letter-spacing: -0.01em; }
    .cal-grid { display: grid; grid-template-columns: repeat(7, 1fr); gap: 6px; }
    .cal-day-name { text-align: center; font-size: 11px; font-weight: 800; color: #475569; text-transform: uppercase; padding: 6px 0; letter-spacing: 0.05em; }
    .cal-day-name.weekend { color: #DC2626; }
    
    .cal-cell { min-height: 52px; border-radius: 4px; padding: 6px 4px; position: relative; cursor: default; transition: all .15s; border: 1px solid #E2E8F0; background: #FFFFFF; display: flex; flex-direction: column; align-items: center; justify-content: flex-start; }
    .cal-cell:hover { border-color: #218AC9; background: #F8FAFC; }
    .cal-cell.has-booking { cursor: pointer; background: #EFF6FF; border: 1.5px solid #60A5FA; }
    .cal-cell.has-booking:hover { background: #DBEAFE; }
    
    /* Today Highlight */
    .cal-cell.today { border: 2px solid #218AC9 !important; background: #F0F9FF !important; }
    .cal-cell.today .cal-num { color: #218AC9; font-weight: 800; font-size: 13.5px; }

    /* Other Month & Holidays */
    .cal-cell.other-month { opacity: .25; background: #FAFAFA; border-color: transparent; }
    .cal-cell.holiday { background-color: #FFF5F5; border-color: #FEE2E2; }
    .cal-cell.holiday .cal-num { color: #DC2626; font-weight: 700; }

    .cal-num { font-size: 13px; font-weight: 600; color: #0F172A; display: block; text-align: center; line-height: 1.2; }
    .cal-dots { display: flex; flex-wrap: wrap; justify-content: center; gap: 3px; margin-top: 5px; }
    .cal-dot { width: 7px; height: 7px; border-radius: 50%; flex-shrink: 0; }
    .cal-dot.booked { background: #2563EB; }
    .cal-dot.diterima { background: #16A34A; }
    .cal-dot.selesai { background: #059669; }
    .cal-dot.ditolak { background: #DC2626; }
    
    .cal-legend { display: flex; gap: 16px; margin-top: 16px; flex-wrap: wrap; padding-top: 12px; border-top: 1px solid #F1F5F9; }
    .cal-legend-item { display: flex; align-items: center; gap: 6px; font-size: 11.5px; color: #475569; font-weight: 600; }
    
    .cal-booking-popup { background: #003B64; color: #fff; border-radius: 6px; padding: 10px 14px; font-size: 12px; position: absolute; z-index: 50; min-width: 190px; display: none; top: 58px; left: 0; box-shadow: 0 8px 24px rgba(0,0,0,0.18); border: 1px solid rgba(255,255,255,0.1); }
    .cal-booking-popup.active { display: block; }
    .cal-booking-popup h4 { font-size: 12px; font-weight: 700; margin-bottom: 6px; border-bottom: 1px solid rgba(255,255,255,0.15); padding-bottom: 5px; }
    .cal-popup-row { display: flex; align-items: center; gap: 6px; margin-top: 4px; }
    .cal-popup-dot { width: 7px; height: 7px; border-radius: 50%; flex-shrink: 0; }
@endsection

@section('content')
<!-- Header Card -->
<div style="background: #ffffff; border: 1px solid #E2E8F0; border-radius: 6px; padding: 18px 24px; margin-bottom: 20px; box-shadow: 0 2px 6px rgba(0,38,66,0.02); display: flex; align-items: center; justify-content: space-between; gap: 16px; flex-wrap: wrap;">
    <div>
        <div style="font-size: 12px; color: #64748B; margin-bottom: 4px; display: flex; align-items: center; gap: 6px;">
            <a href="{{ route('dashboard') }}" style="color: #218AC9; text-decoration: none; font-weight: 600;">Dashboard</a>
            <span>›</span>
            <span style="color: #64748B;">LAPOL PAK (Admin)</span>
        </div>
        <h1 style="font-size: 19px; font-weight: 800; color: #003B64; letter-spacing: -0.02em; margin: 0;">
            Pengelolaan Booking LAPOL PAK (Admin)
        </h1>
        <p style="font-size: 12.5px; color: #64748B; margin: 4px 0 0;">Kelola dan update status pendaftaran pelaporan pelaku usaha secara real-time.</p>
    </div>
</div>

<!-- Success Message -->
@if(session('success'))
    <div class="alert alert-success" style="flex-wrap: wrap; border-radius: 4px; margin-bottom: 20px;">
        <div style="display: flex; align-items: flex-start; gap: 12px; width: 100%;">
            <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <span>{{ session('success') }}</span>
        </div>
    </div>
@endif

<!-- Pemberitahuan Baru (Jika ada booking terjadwal) -->
@php
    $bookedCount = $bookings->where('status', 'booked')->count();
@endphp

@if($bookedCount > 0)
    <div class="notification-banner">
        <div class="notification-info">
            <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
            </svg>
            <span style="font-weight: 700;">Terdapat {{ $bookedCount }} Jadwal LAPOL PAK Aktif (Booked) yang memerlukan tindak lanjut hari ini.</span>
        </div>
    </div>
@endif

{{-- KALENDER JADWAL LAPOL PAK --}}
@php
    use Carbon\Carbon;
    $allBookings = $bookings;
    $bookingsByDate = [];
    foreach ($allBookings as $b) {
        $key = Carbon::parse($b->booking_date)->format("Y-m-d");
        $bookingsByDate[$key][] = $b;
    }
@endphp

<div class="cal-wrap" id="cal-wrap">
    <div class="cal-header">
        <h2 style="display: flex; align-items: center; gap: 8px;">
            <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="#218AC9" stroke-width="2.2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
            Kalender Jadwal Booking
        </h2>
        <div class="cal-nav">
            <button id="cal-prev" title="Bulan sebelumnya"><svg viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"/></svg></button>
            <span class="cal-month-label" id="cal-month-label"></span>
            <button id="cal-next" title="Bulan berikutnya"><svg viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg></button>
        </div>
    </div>
    <div class="cal-grid" id="cal-grid">
        <div class="cal-day-name weekend">Min</div>
        <div class="cal-day-name">Sen</div>
        <div class="cal-day-name">Sel</div>
        <div class="cal-day-name">Rab</div>
        <div class="cal-day-name">Kam</div>
        <div class="cal-day-name">Jum</div>
        <div class="cal-day-name weekend">Sab</div>
    </div>
    <div class="cal-legend">
        <div class="cal-legend-item"><span class="cal-dot booked"></span> Booked</div>
        <div class="cal-legend-item"><span class="cal-dot diterima"></span> Diterima</div>
        <div class="cal-legend-item"><span class="cal-dot selesai"></span> Selesai</div>
        <div class="cal-legend-item"><span class="cal-dot ditolak"></span> Ditolak</div>
    </div>
</div>

<script>
    (function() {
        var bookings = @json($bookingsByDate);
        var today = new Date();
        var currentYear = today.getFullYear();
        var currentMonth = today.getMonth();

        var monthNames = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
        var statusColors = { booked: "#2563EB", diterima: "#16A34A", selesai: "#059669", ditolak: "#DC2626" };

        function pad(n) { return n < 10 ? "0" + n : "" + n; }

        function renderCalendar(year, month) {
            document.getElementById("cal-month-label").textContent = monthNames[month] + " " + year;

            var grid = document.getElementById("cal-grid");
            while (grid.children.length > 7) {
                grid.removeChild(grid.lastChild);
            }

            var firstDay = new Date(year, month, 1).getDay();
            var daysInMonth = new Date(year, month + 1, 0).getDate();
            var prevDays = new Date(year, month, 0).getDate();

            for (var i = firstDay - 1; i >= 0; i--) {
                var cell = document.createElement("div");
                cell.className = "cal-cell other-month";
                cell.innerHTML = "<span class=\"cal-num\">" + (prevDays - i) + "</span>";
                grid.appendChild(cell);
            }

            for (var d = 1; d <= daysInMonth; d++) {
                var dateKey = year + "-" + pad(month + 1) + "-" + pad(d);
                var cell = document.createElement("div");
                cell.className = "cal-cell";

                if (year === today.getFullYear() && month === today.getMonth() && d === today.getDate()) {
                    cell.classList.add("today");
                }

                var dayOfWeek = new Date(year, month, d).getDay();
                var isWeekend = (dayOfWeek === 0 || dayOfWeek === 6);
                var isHoliday = window.appHolidays && window.appHolidays.includes(dateKey);
                if (isWeekend || isHoliday) {
                    cell.classList.add("holiday");
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
                        dot.style.background = statusColors[dayBookings[j].status] || "#2563EB";
                        dotsWrap.appendChild(dot);
                    }
                    if (dayBookings.length > 3) {
                        var more = document.createElement("span");
                        more.style.cssText = "font-size:9px;color:#64748B;font-weight:700;";
                        more.textContent = "+" + (dayBookings.length - 3);
                        dotsWrap.appendChild(more);
                    }
                    cell.appendChild(dotsWrap);

                    var popup = document.createElement("div");
                    popup.className = "cal-booking-popup";
                    var formattedDate = pad(d) + " " + monthNames[month] + " " + year;
                    popup.innerHTML = "<h4>" + formattedDate + " (" + dayBookings.length + " booking)</h4>";
                    dayBookings.forEach(function(b) {
                        var name = b.nama_pemohon || "Tamu";
                        var timeStart = b.time_start ? b.time_start.substring(0,5) : "--";
                        var timeEnd = b.time_end ? b.time_end.substring(0,5) : "--";
                        var dotColor = statusColors[b.status] || "#2563EB";
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

<div class="panel" style="border-radius: 6px; border: 1px solid #E2E8F0; box-shadow: 0 2px 6px rgba(0,38,66,0.02); overflow: hidden; background: #ffffff;">
    <div class="panel-head" style="padding: 14px 18px; border-bottom: 1px solid #E2E8F0; background: #F8FAFC;">
        <h2 style="font-size: 15px; font-weight: 800; color: #003B64; margin: 0; display: flex; align-items: center; gap: 8px;">
            <svg width="17" height="17" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
            Daftar Pendaftar LAPOL PAK
        </h2>
    </div>
    <div class="panel-body" style="padding:0;">
        <div class="table-wrap">
            @if($bookings->isEmpty())
                <div class="empty-state" style="padding: 40px 20px; text-align: center;">
                    <svg width="40" height="40" fill="none" viewBox="0 0 24 24" stroke="#94A3B8" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/>
                    </svg>
                    <p style="font-size: 13px; color: #64748B; margin-top: 10px;">Belum ada pendaftaran booking jadwal LAPOL PAK dari pelaku usaha.</p>
                </div>
            @else
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="border-bottom: 1.5px solid #E2E8F0; background: #F8FAFC;">
                            <th style="padding: 10px 14px; font-size: 11px; font-weight: 800; color: #475569; text-transform: uppercase; letter-spacing: 0.05em;">Pelaku Usaha (Pemohon)</th>
                            <th style="padding: 10px 14px; font-size: 11px; font-weight: 800; color: #475569; text-transform: uppercase; letter-spacing: 0.05em;">Nomor WhatsApp</th>
                            <th style="padding: 10px 14px; font-size: 11px; font-weight: 800; color: #475569; text-transform: uppercase; letter-spacing: 0.05em;">Tanggal Booking</th>
                            <th style="padding: 10px 14px; font-size: 11px; font-weight: 800; color: #475569; text-transform: uppercase; letter-spacing: 0.05em;">Rentang Waktu</th>
                            <th style="padding: 10px 14px; font-size: 11px; font-weight: 800; color: #475569; text-transform: uppercase; letter-spacing: 0.05em;">Status</th>
                            <th style="padding: 10px 14px; font-size: 11px; font-weight: 800; color: #475569; text-transform: uppercase; letter-spacing: 0.05em; min-width: 260px;">Aksi Admin</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bookings as $booking)
                            <tr style="border-bottom: 1px solid #F1F5F9;">
                                <td style="padding: 12px 14px;">
                                    <strong style="color: #003B64; font-size: 13px;">{{ $booking->nama_pemohon ?? ($booking->user ? ($booking->user->name ?? $booking->user->username) : 'Tamu') }}</strong>
                                    <div style="font-size: 11px; color: #64748B; margin-top: 2px;">{{ $booking->user ? 'Username: ' . $booking->user->username : 'Pendaftar Publik (Tanpa Akun)' }}</div>
                                </td>
                                <td style="padding: 12px 14px;">
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $booking->whatsapp_number) }}" target="_blank" style="color: #25D366; text-decoration: none; font-weight: 700; font-size: 12.5px; display: inline-flex; align-items: center; gap: 4px;">
                                        <svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                                        {{ $booking->whatsapp_number }}
                                    </a>
                                </td>
                                <td style="padding: 12px 14px; color: #334155; font-size: 12.5px;">{{ $booking->formatted_date }}</td>
                                <td style="padding: 12px 14px; color: #218AC9; font-weight: 700; font-size: 12.5px;">{{ $booking->formatted_time_range }}</td>
                                <td style="padding: 12px 14px;">
                                    <span class="badge" style="background-color: {{ $booking->status_color }}20; color: {{ $booking->status_color }}; border-radius: 4px; padding: 4px 8px; font-weight: 700; font-size: 11px;">
                                        {{ $booking->status_label }}
                                    </span>
                                </td>
                                <td style="padding: 12px 14px; min-width: 260px;">
                                    <form action="{{ route('lapolpa.update', $booking->id) }}" method="POST" style="display: flex; flex-direction: column; gap: 6px;">
                                        @csrf
                                        @method('PUT')
                                        <div style="display: flex; gap: 6px; align-items: center;">
                                            <select name="status" class="status-select" style="flex: 1; height: 34px; box-sizing: border-box;">
                                                @if($booking->status === 'booked')
                                                <option value="booked" selected disabled>Menunggu Aksi</option>
                                                @endif
                                                <option value="diterima" {{ $booking->status === 'diterima' ? 'selected' : '' }}>Diterima</option>
                                                <option value="selesai" {{ $booking->status === 'selesai' ? 'selected' : '' }}>Selesai</option>
                                                <option value="ditolak" {{ $booking->status === 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                            </select>
                                            <button type="submit" class="btn btn-primary btn-sm" style="border-radius: 4px; font-size: 12px; padding: 0 14px; font-weight: 700; height: 34px; white-space: nowrap; box-sizing: border-box;">Update</button>
                                        </div>
                                        <input type="text" name="admin_note" placeholder="Catatan untuk pemohon (Opsional)" value="{{ $booking->admin_note }}" class="form-control" style="font-size: 11.5px; padding: 6px 10px; border-radius: 4px; border: 1.5px solid #CBD5E1; height: 34px; box-sizing: border-box; width: 100%;">
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
@if(session('wa_links'))
    <div id="wa-blast-container" style="background:#F0FDF4;border:1px solid #BBF7D0;border-radius:6px;padding:16px 20px;margin-bottom:20px;box-shadow: 0 2px 6px rgba(0,38,66,0.02);">
        <div style="font-size:13px;font-weight:700;color:#166534;margin-bottom:8px;display:flex;align-items:center;gap:8px;">
            <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/></svg>
            Kirim Notifikasi WhatsApp Manual
        </div>
        <div style="font-size:12.5px;color:#15803D;margin-bottom:12px;">Klik tombol di bawah untuk membuka WhatsApp dan kirim notifikasi ke pihak terkait:</div>
        <div style="display:flex;flex-wrap:wrap;gap:8px;">
            @foreach(session('wa_links') as $index => $link)
                <a href="{{ $link['url'] }}" target="_blank" rel="noopener noreferrer" id="wa-link-layout-{{ $index }}"
                   style="display:inline-flex;align-items:center;gap:6px;background:#25D366;color:#fff;padding:8px 14px;border-radius:4px;text-decoration:none;font-size:12.5px;font-weight:700;transition:all 0.2s;"
                   onmouseover="this.style.background='#1EBE5A'" onmouseout="this.style.background='#25D366'">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                    Kirim ke {{ $link['target'] }}
                </a>
            @endforeach
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                setTimeout(function() {
                    const waContainer = document.getElementById('wa-blast-container');
                    if (waContainer) {
                        waContainer.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }
                }, 400);
            });
            setTimeout(function() {
                var firstWaLink = document.getElementById('wa-link-layout-0');
                if(firstWaLink) {
                    window.open(firstWaLink.href, '_blank');
                }
            }, 500);
        </script>
    </div>
@endif
@endsection
