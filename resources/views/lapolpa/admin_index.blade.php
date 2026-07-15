@extends('layouts.app')

@section('title', 'Admin LAPOL PAK — PATEN PAK MIKO')
@section('page-title', 'Admin LAPOL PAK')

@section('extra-styles')
    /* Pemberitahuan Baru (Alert Booking Active) */
    .notification-banner {
        background-color: #EBF8FF;
        color: #2B6CB0;
        border: 1.5px solid #BEE3F8;
        padding: 18px;
        border-radius: var(--r-md);
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
        color: var(--blue);
        flex-shrink: 0;
    }

    /* Action Forms */
    .status-select {
        padding: 6px 10px;
        border-radius: var(--r-sm);
        border: 1.5px solid var(--line);
        font-size: 12px;
        font-weight: 600;
        color: var(--ink);
        outline: none;
        background-color: #FFFFFF;
        cursor: pointer;
        transition: all 0.2s;
    }

    .status-select:focus {
        border-color: var(--blue);
    }

    /* ─── CALENDAR ──────────────────────────── */
    .cal-wrap { background: #fff; border: 1.5px solid var(--line); border-radius: var(--r-lg); padding: 24px; margin-bottom: 28px; }
    .cal-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px; }
    .cal-header h2 { font-size: 16px; font-weight: 800; color: var(--ink); }
    .cal-nav { display: flex; align-items: center; gap: 8px; }
    .cal-nav button { width: 30px; height: 30px; border: 1.5px solid var(--line); background: #fff; border-radius: 8px; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all .2s; }
    .cal-nav button:hover { background: var(--blue); border-color: var(--blue); }
    .cal-nav button:hover svg { stroke: #fff; }
    .cal-nav button svg { width: 14px; height: 14px; fill: none; stroke: var(--ink); stroke-width: 2.5; stroke-linecap: round; }
    .cal-month-label { font-size: 15px; font-weight: 700; color: var(--ink); min-width: 140px; text-align: center; }
    .cal-grid { display: grid; grid-template-columns: repeat(7, 1fr); gap: 4px; }
    .cal-day-name { text-align: center; font-size: 11px; font-weight: 700; color: var(--muted); text-transform: uppercase; padding: 6px 0; }
    .cal-cell { min-height: 56px; border-radius: 10px; padding: 6px; position: relative; cursor: default; transition: background .15s; }
    .cal-cell.has-booking { cursor: pointer; background: #EBF8FF; border: 1.5px solid #BEE3F8; }
    .cal-cell.has-booking:hover { background: #BEE3F8; }
    .cal-cell.today .cal-num { background: var(--blue); color: #fff; border-radius: 50%; width: 26px; height: 26px; display: inline-flex; align-items: center; justify-content: center; }
    .cal-cell.other-month { opacity: .3; }
    .cal-cell.holiday { background-color: #FFF5F5; border: 1.5px solid transparent; }
    .cal-cell.holiday .cal-num { color: #E53E3E; font-weight: 800; }
    .cal-num { font-size: 13px; font-weight: 600; color: var(--ink); display: block; text-align: center; }
    .cal-dots { display: flex; flex-wrap: wrap; justify-content: center; gap: 3px; margin-top: 4px; }
    .cal-dot { width: 7px; height: 7px; border-radius: 50%; flex-shrink: 0; }
    .cal-dot.booked { background: #3182CE; }
    .cal-dot.diterima { background: #10B981; }
    .cal-dot.selesai { background: #38A169; }
    .cal-dot.ditolak { background: #E53E3E; }
    .cal-legend { display: flex; gap: 16px; margin-top: 16px; flex-wrap: wrap; }
    .cal-legend-item { display: flex; align-items: center; gap: 5px; font-size: 11px; color: var(--muted); font-weight: 600; }
    .cal-booking-popup { background: var(--ink); color: #fff; border-radius: 10px; padding: 10px 14px; font-size: 12px; position: absolute; z-index: 50; min-width: 180px; display: none; top: 62px; left: 0; box-shadow: 0 8px 24px rgba(0,0,0,0.2); }
    .cal-booking-popup.active { display: block; }
    .cal-booking-popup h4 { font-size: 12px; font-weight: 700; margin-bottom: 6px; border-bottom: 1px solid rgba(255,255,255,0.2); padding-bottom: 5px; }
    .cal-popup-row { display: flex; align-items: center; gap: 6px; margin-top: 4px; }
    .cal-popup-dot { width: 7px; height: 7px; border-radius: 50%; flex-shrink: 0; }
@endsection

@section('content')
<div class="page-header">
    <div class="page-header-left">
        <div class="breadcrumb">
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <span>›</span>
            <span>LAPOL PAK (Admin)</span>
        </div>
        <h1>Pengelolaan Booking LAPOL PAK (Admin)</h1>
        <p>Kelola dan update status pendaftaran pelaporan pelaku usaha secara real-time.</p>
    </div>
</div>

<!-- Success Message -->
@if(session('success'))
    <div class="alert alert-success" style="flex-wrap: wrap;">
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
            <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
            </svg>
            <strong>Terdapat {{ $bookedCount }} Jadwal LAPOL PAK Aktif (Booked) yang memerlukan tindak lanjut hari ini.</strong>
        </div>
    </div>
@endif

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
        var statusColors = { booked: "#3182CE", diterima: "#10B981", selesai: "#38A169", ditolak: "#E53E3E" };

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

                // Check Weekend or Holiday
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
                        dot.style.background = statusColors[dayBookings[j].status] || "#3182CE";
                        dotsWrap.appendChild(dot);
                    }
                    if (dayBookings.length > 3) {
                        var more = document.createElement("span");
                        more.style.cssText = "font-size:9px;color:var(--muted);font-weight:700;";
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

<div class="panel">
    <div class="panel-head">
        <h2>Daftar Pendaftar LAPOL PAK</h2>
    </div>
    <div class="panel-body" style="padding:0;">
        <div class="table-wrap">
            @if($bookings->isEmpty())
                <div class="empty-state">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/>
                    </svg>
                    <p>Belum ada pendaftaran booking jadwal LAPOL PAK dari pelaku usaha.</p>
                </div>
            @else
                <table>
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
                                    <div style="font-size: 11px; color: var(--muted);">{{ $booking->user ? 'Username: ' . $booking->user->username : 'Pendaftar Publik (Tanpa Akun)' }}</div>
                                </td>
                                <td>
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $booking->whatsapp_number) }}" target="_blank" style="color: var(--blue); text-decoration: none; font-weight: 600;">
                                        {{ $booking->whatsapp_number }} 💬
                                    </a>
                                </td>
                                <td>{{ $booking->formatted_date }}</td>
                                <td style="color: var(--blue); font-weight: 700;">{{ $booking->formatted_time_range }}</td>
                                <td>
                                    <span class="badge" style="background-color: {{ $booking->status_color }}20; color: {{ $booking->status_color }};">
                                        {{ $booking->status_label }}
                                    </span>
                                </td>
                                <td>
                                    <form action="{{ route('lapolpa.update', $booking->id) }}" method="POST" style="display: flex; flex-direction: column; gap: 8px;">
                                        @csrf
                                        @method('PUT')
                                        <div style="display: flex; gap: 8px; align-items: center;">
                                            <select name="status" class="status-select">
                                                @if($booking->status === 'booked')
                                                <option value="booked" selected disabled>Menunggu Aksi</option>
                                                @endif
                                                <option value="diterima" {{ $booking->status === 'diterima' ? 'selected' : '' }}>Diterima</option>
                                                <option value="selesai" {{ $booking->status === 'selesai' ? 'selected' : '' }}>Selesai</option>
                                                <option value="ditolak" {{ $booking->status === 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                            </select>
                                            <button type="submit" class="btn btn-primary btn-sm">Update</button>
                                        </div>
                                        <input type="text" name="admin_note" placeholder="Catatan untuk pemohon (Opsional)" value="{{ $booking->admin_note }}" class="form-control" style="font-size: 11px; padding: 6px 10px;">
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
    <div id="wa-blast-container" style="background:#E8F5E9;border:1.5px solid #A5D6A7;border-radius:8px;padding:16px 20px;margin-bottom:20px;box-shadow: 0 4px 15px rgba(37, 211, 102, 0.2);">
        <div style="font-size:13px;font-weight:700;color:#1B5E20;margin-bottom:10px;display:flex;align-items:center;gap:8px;">
            <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/></svg>
            Kirim Notifikasi WhatsApp Manual
        </div>
        <div style="font-size:12px;color:#2E7D32;margin-bottom:12px;">Klik tombol di bawah untuk membuka WhatsApp dan kirim notifikasi ke pihak terkait:</div>
        <div style="display:flex;flex-wrap:wrap;gap:8px;">
            @foreach(session('wa_links') as $index => $link)
                <a href="{{ $link['url'] }}" target="_blank" rel="noopener noreferrer" id="wa-link-layout-{{ $index }}"
                   style="display:inline-flex;align-items:center;gap:6px;background:#25D366;color:#fff;padding:9px 16px;border-radius:6px;text-decoration:none;font-size:13px;font-weight:700;transition:all 0.2s;"
                   onmouseover="this.style.background='#1EBE5A'" onmouseout="this.style.background='#25D366'">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
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
