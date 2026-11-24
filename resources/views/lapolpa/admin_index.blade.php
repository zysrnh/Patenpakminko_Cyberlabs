@extends('layouts.app')

@section('title', 'Admin LAPOL PAK — PATEN PAK MIKO')
@section('page-title', 'Admin LAPOL PAK')

@section('extra-styles')
    @keyframes lapolFadeUp {
        from { opacity: 0; transform: translateY(5px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    /* ─── HERO HEADER RINGKAS (FLAT) ───────────────────── */
    .lapol-hero {
        background: #FFFFFF;
        border: 1px solid #D6E4EF;
        border-radius: 4px;
        padding: 15px 18px;
        margin-bottom: 14px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
        flex-wrap: wrap;
        animation: lapolFadeUp .2s cubic-bezier(0.22, 1, 0.36, 1) both;
    }
    .lapol-hero-title {
        font-size: 17px;
        font-weight: 800;
        color: #003B64;
        letter-spacing: -0.02em;
        margin: 0 0 2px;
    }
    .lapol-hero-sub {
        font-size: 12.5px;
        color: #64748B;
        margin: 0;
    }
    .lapol-stat-strip {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
    }
    .lapol-stat-box {
        background: #F8FAFC;
        border: 1px solid #E2E8F0;
        border-radius: 4px;
        padding: 6px 11px;
        display: flex;
        align-items: baseline;
        gap: 6px;
    }
    .lapol-stat-box--alert {
        background: #EFF6FF;
        border-color: #BFDBFE;
    }
    .lapol-stat-num {
        font-size: 15px;
        font-weight: 800;
        color: #003B64;
    }
    .lapol-stat-box--alert .lapol-stat-num { color: #1D4ED8; }
    .lapol-stat-label {
        font-size: 11px;
        font-weight: 600;
        color: #64748B;
    }

    /* ─── ALERT BANNER BOOKED AKTIF ────────────────────── */
    .notification-banner {
        background: #EFF6FF;
        color: #1E40AF;
        border: 1px solid #BFDBFE;
        padding: 10px 14px;
        border-radius: 4px;
        margin-bottom: 14px;
        font-size: 12.5px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        flex-wrap: wrap;
    }
    .notification-info {
        display: flex;
        align-items: center;
        gap: 8px;
        font-weight: 700;
    }
    .notification-quick-btn {
        background: #2563EB;
        color: #FFFFFF;
        border: none;
        border-radius: 4px;
        padding: 5px 10px;
        font-family: inherit;
        font-size: 11.5px;
        font-weight: 700;
        cursor: pointer;
    }
    .notification-quick-btn:hover { background: #1D4ED8; }

    /* ─── KALENDER KOMPAK (FLAT) ───────────────────────── */
    .cal-wrap {
        background: #FFFFFF;
        border: 1px solid #D6E4EF;
        border-radius: 4px;
        padding: 14px 16px;
        margin-bottom: 16px;
        animation: lapolFadeUp .24s cubic-bezier(0.22, 1, 0.36, 1) .03s both;
    }
    .cal-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 12px;
    }
    .cal-header-left {
        display: flex;
        align-items: center;
        gap: 14px;
        flex-wrap: wrap;
    }
    .cal-header h2 {
        font-size: 14.5px;
        font-weight: 800;
        color: #003B64;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 7px;
    }
    .cal-legend {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
    }
    .cal-legend-item {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: 11px;
        color: #475569;
        font-weight: 600;
    }
    .cal-nav {
        display: flex;
        align-items: center;
        gap: 6px;
        background: #F8FAFC;
        padding: 3px 6px;
        border-radius: 4px;
        border: 1px solid #CBD5E1;
    }
    .cal-nav button {
        width: 26px;
        height: 26px;
        border: 1px solid #CBD5E1;
        background: #FFFFFF;
        border-radius: 4px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background .15s ease, border-color .15s ease;
    }
    .cal-nav button:hover { background: #218AC9; border-color: #218AC9; }
    .cal-nav button:hover svg { stroke: #FFFFFF; }
    .cal-nav button svg { width: 12px; height: 12px; fill: none; stroke: #003B64; stroke-width: 2.5; stroke-linecap: round; }
    .cal-month-label {
        font-size: 13px;
        font-weight: 800;
        color: #003B64;
        min-width: 112px;
        text-align: center;
    }

    .cal-grid {
        display: grid;
        grid-template-columns: repeat(7, minmax(0, 1fr));
        gap: 4px;
    }
    .cal-day-name {
        text-align: center;
        font-size: 10.5px;
        font-weight: 800;
        color: #64748B;
        text-transform: uppercase;
        padding: 4px 0;
        letter-spacing: 0.04em;
    }
    .cal-day-name.weekend { color: #DC2626; }

    .cal-cell {
        min-height: 40px;
        border-radius: 4px;
        padding: 4px 4px;
        position: relative;
        cursor: default;
        border: 1px solid #E2E8F0;
        background: #FFFFFF;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: flex-start;
        transition: border-color .15s ease, background .15s ease;
    }
    .cal-cell.has-booking {
        cursor: pointer;
        background: #EFF6FF;
        border: 1px solid #60A5FA;
    }
    .cal-cell.has-booking:hover { background: #DBEAFE; }
    .cal-cell.is-date-selected {
        outline: 2px solid #003B64;
        background: #DBEAFE !important;
    }
    .cal-cell.today {
        border: 1.5px solid #218AC9 !important;
        background: #F0F9FF !important;
    }
    .cal-cell.today .cal-num { color: #003B64; font-weight: 800; }
    .cal-cell.other-month { opacity: .28; background: #FAFAFA; border-color: transparent; }
    .cal-cell.holiday { background: #FEF2F2; border-color: #FECACA; }
    .cal-cell.holiday .cal-num { color: #DC2626; font-weight: 700; }

    .cal-num {
        font-size: 12px;
        font-weight: 600;
        color: #0F172A;
        line-height: 1.2;
    }
    .cal-dots {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 3px;
        margin-top: 3px;
    }
    .cal-dot { width: 6px; height: 6px; border-radius: 50%; flex-shrink: 0; }
    .cal-dot.booked { background: #2563EB; }
    .cal-dot.diterima { background: #16A34A; }
    .cal-dot.selesai { background: #059669; }
    .cal-dot.ditolak { background: #DC2626; }

    .cal-booking-popup {
        background: #003B64;
        color: #FFFFFF;
        border-radius: 4px;
        padding: 9px 12px;
        font-size: 11.5px;
        position: absolute;
        z-index: 50;
        min-width: 195px;
        display: none;
        top: 44px;
        left: 0;
        border: 1px solid #0F4C81;
    }
    .cal-booking-popup.active { display: block; }
    .cal-booking-popup h4 {
        font-size: 11.5px;
        font-weight: 700;
        margin: 0 0 5px;
        border-bottom: 1px solid rgba(255,255,255,0.18);
        padding-bottom: 4px;
    }
    .cal-popup-row { display: flex; align-items: center; gap: 6px; margin-top: 3px; }
    .cal-popup-dot { width: 6px; height: 6px; border-radius: 50%; flex-shrink: 0; }

    /* ─── PANEL TABEL & FILTER BAR ─────────────────────── */
    .lapol-panel {
        background: #FFFFFF;
        border: 1px solid #D6E4EF;
        border-radius: 4px;
        overflow: hidden;
        animation: lapolFadeUp .28s cubic-bezier(0.22, 1, 0.36, 1) .06s both;
    }
    .lapol-panel-head {
        padding: 13px 16px;
        border-bottom: 1px solid #E8F0F6;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        flex-wrap: wrap;
        background: #F8FAFC;
    }
    .lapol-panel-title {
        font-size: 14.5px;
        font-weight: 800;
        color: #003B64;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 7px;
    }
    .lapol-date-pill {
        display: none;
        align-items: center;
        gap: 6px;
        background: #E3F0F9;
        color: #003B64;
        border: 1px solid #BFD9EC;
        border-radius: 4px;
        padding: 3px 8px;
        font-size: 11.5px;
        font-weight: 700;
    }
    .lapol-date-pill.is-visible { display: inline-flex; }
    .lapol-date-pill button {
        background: none;
        border: none;
        color: #003B64;
        font-weight: 800;
        cursor: pointer;
        padding: 0 2px;
        font-size: 13px;
        line-height: 1;
    }

    .lapol-toolbar {
        padding: 12px 16px;
        border-bottom: 1px solid #E8F0F6;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        flex-wrap: wrap;
    }
    .lapol-tabs {
        display: flex;
        align-items: center;
        gap: 6px;
        flex-wrap: wrap;
    }
    .lapol-tab {
        padding: 5px 10px;
        border: 1px solid #CBD5E1;
        border-radius: 4px;
        background: #FFFFFF;
        color: #475569;
        font-family: inherit;
        font-size: 11.5px;
        font-weight: 700;
        cursor: pointer;
        transition: background .15s ease, border-color .15s ease, color .15s ease;
    }
    .lapol-tab:hover { background: #F1F5F9; color: #003B64; }
    .lapol-tab.is-active {
        background: #003B64;
        border-color: #003B64;
        color: #FFFFFF;
    }
    .lapol-search-wrap {
        position: relative;
        min-width: 220px;
        flex: 0 1 280px;
    }
    .lapol-search-wrap svg {
        position: absolute;
        left: 9px;
        top: 50%;
        transform: translateY(-50%);
        color: #94A3B8;
        pointer-events: none;
    }
    .lapol-search-input {
        width: 100%;
        height: 32px;
        padding: 0 10px 0 30px;
        border: 1px solid #CBD5E1;
        border-radius: 4px;
        font-family: inherit;
        font-size: 12px;
        color: #0F172A;
        outline: none;
    }
    .lapol-search-input:focus { border-color: #218AC9; }

    .lapol-bulk-bar {
        padding: 9px 16px;
        background: #FEF2F2;
        border-bottom: 1px solid #FECACA;
        display: none;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
    }

    /* ─── TABEL & COMPACT AKSI ─────────────────────────── */
    .table-wrap { overflow-x: auto; }
    .lapol-table {
        width: 100%;
        border-collapse: collapse;
    }
    .lapol-table th {
        padding: 10px 12px;
        font-size: 11px;
        font-weight: 800;
        color: #475569;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        background: #F8FAFC;
        border-bottom: 1px solid #D6E4EF;
        text-align: left;
        white-space: nowrap;
    }
    .lapol-table td {
        padding: 10px 12px;
        border-bottom: 1px solid #EFF4F8;
        font-size: 12.5px;
        vertical-align: middle;
    }
    .lapol-table tbody tr:hover { background: #F8FAFC; }

    .applicant-name {
        color: #003B64;
        font-size: 13px;
        font-weight: 700;
        display: block;
    }
    .applicant-sub {
        font-size: 11px;
        color: #64748B;
        margin-top: 1px;
        display: block;
    }
    .wa-link {
        color: #16A34A;
        text-decoration: none;
        font-weight: 700;
        font-size: 12px;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        white-space: nowrap;
    }
    .wa-link:hover { text-decoration: underline; }
    .status-pill {
        display: inline-flex;
        align-items: center;
        padding: 3px 9px;
        border-radius: 4px;
        font-size: 11px;
        font-weight: 700;
        white-space: nowrap;
    }

    /* Compact Inline Aksi */
    .row-action-form {
        display: flex;
        align-items: center;
        gap: 6px;
        flex-wrap: nowrap;
    }
    .status-select {
        height: 30px;
        padding: 0 8px;
        border-radius: 4px;
        border: 1px solid #CBD5E1;
        font-family: inherit;
        font-size: 11.5px;
        font-weight: 700;
        color: #0F172A;
        background: #FFFFFF;
        cursor: pointer;
        outline: none;
    }
    .status-select:focus { border-color: #218AC9; }
    .note-input-inline {
        height: 30px;
        min-width: 145px;
        flex: 1;
        padding: 0 9px;
        border-radius: 4px;
        border: 1px solid #CBD5E1;
        font-family: inherit;
        font-size: 11.5px;
        color: #0F172A;
        outline: none;
    }
    .note-input-inline:focus { border-color: #218AC9; }
    .btn-row-save {
        height: 30px;
        padding: 0 11px;
        border-radius: 4px;
        border: none;
        background: #218AC9;
        color: #FFFFFF;
        font-family: inherit;
        font-size: 11.5px;
        font-weight: 700;
        cursor: pointer;
        white-space: nowrap;
        transition: background .15s ease;
    }
    .btn-row-save:hover { background: #003B64; }
    .btn-row-del {
        height: 30px;
        padding: 0 9px;
        border-radius: 4px;
        border: 1px solid #FECACA;
        background: #FEF2F2;
        color: #DC2626;
        font-family: inherit;
        font-size: 11.5px;
        font-weight: 700;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        white-space: nowrap;
        transition: background .15s ease, color .15s ease, border-color .15s ease;
    }
    .btn-row-del:hover { background: #DC2626; color: #FFFFFF; border-color: #DC2626; }

    /* ─── PAGINATION BAR ───────────────────────────────── */
    .lapol-pag-bar {
        padding: 11px 16px;
        border-top: 1px solid #E8F0F6;
        background: #F8FAFC;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 10px;
        font-size: 12px;
        color: #64748B;
    }
    .lapol-pag-btns {
        display: flex;
        align-items: center;
        gap: 4px;
    }
    .lapol-pg-btn {
        min-width: 28px;
        height: 28px;
        padding: 0 8px;
        border: 1px solid #CBD5E1;
        border-radius: 4px;
        background: #FFFFFF;
        color: #334155;
        font-family: inherit;
        font-size: 11.5px;
        font-weight: 700;
        cursor: pointer;
    }
    .lapol-pg-btn:hover:not(:disabled) { background: #E3F0F9; border-color: #218AC9; }
    .lapol-pg-btn.is-active { background: #003B64; border-color: #003B64; color: #FFFFFF; }
    .lapol-pg-btn:disabled { opacity: .45; cursor: not-allowed; }

    @media (max-width: 900px) {
        .row-action-form { flex-wrap: wrap; }
    }
    @media (max-width: 640px) {
        .cal-wrap { padding: 12px; }
        .cal-cell { min-height: 36px; }
        .cal-num { font-size: 11px; }
        .lapol-toolbar { flex-direction: column; align-items: stretch; }
        .lapol-search-wrap { max-width: none; }
    }
    @media (prefers-reduced-motion: reduce) {
        .lapol-hero, .cal-wrap, .lapol-panel { animation: none !important; transition: none !important; }
    }
@endsection

@section('content')
@php
    use Carbon\Carbon;
    $bookedCount   = $bookings->where('status', 'booked')->count();
    $acceptedCount = $bookings->where('status', 'diterima')->count();
    $doneCount     = $bookings->where('status', 'selesai')->count();

    $bookingsByDate = [];
    foreach ($bookings as $b) {
        $key = Carbon::parse($b->booking_date)->format("Y-m-d");
        $bookingsByDate[$key][] = $b;
    }
@endphp

<!-- Hero Ringkas -->
<div class="lapol-hero">
    <div>
        <h1 class="lapol-hero-title">Jadwal Konsultasi LAPOL PAK</h1>
        <p class="lapol-hero-sub">Pantau kalender kunjungan dan perbarui status pendaftaran konsultasi pemohon.</p>
    </div>
    <div class="lapol-stat-strip">
        <div class="lapol-stat-box {{ $bookedCount > 0 ? 'lapol-stat-box--alert' : '' }}">
            <span class="lapol-stat-num">{{ $bookedCount }}</span>
            <span class="lapol-stat-label">Booked</span>
        </div>
        <div class="lapol-stat-box">
            <span class="lapol-stat-num">{{ $acceptedCount }}</span>
            <span class="lapol-stat-label">Diterima</span>
        </div>
        <div class="lapol-stat-box">
            <span class="lapol-stat-num">{{ $doneCount }}</span>
            <span class="lapol-stat-label">Selesai</span>
        </div>
        <div class="lapol-stat-box">
            <span class="lapol-stat-num">{{ $bookings->count() }}</span>
            <span class="lapol-stat-label">Total</span>
        </div>
    </div>
</div>

@if($bookedCount > 0)
    <div class="notification-banner">
        <div class="notification-info">
            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
            </svg>
            <span>Ada {{ $bookedCount }} jadwal baru (Booked) menunggu konfirmasi petugas.</span>
        </div>
        <button type="button" class="notification-quick-btn" onclick="setLapolStatusTab('booked')">Lihat Antrean Booked</button>
    </div>
@endif

<!-- Kalender Jadwal Kompak -->
<div class="cal-wrap" id="cal-wrap">
    <div class="cal-header">
        <div class="cal-header-left">
            <h2>
                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#218AC9" stroke-width="2.2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                <span>Kalender Booking</span>
            </h2>
            <div class="cal-legend">
                <div class="cal-legend-item"><span class="cal-dot booked"></span> Booked</div>
                <div class="cal-legend-item"><span class="cal-dot diterima"></span> Diterima</div>
                <div class="cal-legend-item"><span class="cal-dot selesai"></span> Selesai</div>
                <div class="cal-legend-item"><span class="cal-dot ditolak"></span> Ditolak</div>
            </div>
        </div>
        <div class="cal-nav">
            <button type="button" id="cal-prev" title="Bulan sebelumnya"><svg viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"/></svg></button>
            <span class="cal-month-label" id="cal-month-label"></span>
            <button type="button" id="cal-next" title="Bulan berikutnya"><svg viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg></button>
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
</div>

<!-- Form Bulk Delete Berdiri Sendiri (Tidak Nested) -->
<form id="bulkForm" action="{{ route('lapolpa.bulk-destroy') }}" method="POST" style="display:none;">
    @csrf
    <div id="bulkHiddenInputs"></div>
</form>

<!-- Daftar Pendaftar -->
<div class="lapol-panel">
    <div class="lapol-panel-head">
        <div style="display:flex; align-items:center; gap:10px; flex-wrap:wrap;">
            <h2 class="lapol-panel-title">
                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                <span>Daftar Pendaftar LAPOL PAK</span>
            </h2>
            <span id="dateFilterPill" class="lapol-date-pill">
                <span id="dateFilterLabel">Tanggal: -</span>
                <button type="button" onclick="clearDateFilter()" title="Hapus filter tanggal">&times;</button>
            </span>
        </div>
    </div>

    <div class="lapol-toolbar">
        <div class="lapol-tabs" id="lapolStatusTabs">
            <button type="button" class="lapol-tab is-active" data-status="all" onclick="setLapolStatusTab('all')">Semua ({{ $bookings->count() }})</button>
            <button type="button" class="lapol-tab" data-status="booked" onclick="setLapolStatusTab('booked')">Booked ({{ $bookedCount }})</button>
            <button type="button" class="lapol-tab" data-status="diterima" onclick="setLapolStatusTab('diterima')">Diterima ({{ $acceptedCount }})</button>
            <button type="button" class="lapol-tab" data-status="selesai" onclick="setLapolStatusTab('selesai')">Selesai ({{ $doneCount }})</button>
            <button type="button" class="lapol-tab" data-status="ditolak" onclick="setLapolStatusTab('ditolak')">Ditolak ({{ $bookings->where('status', 'ditolak')->count() }})</button>
        </div>
        <div class="lapol-search-wrap">
            <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35"/></svg>
            <input type="text" id="lapolSearch" class="lapol-search-input" placeholder="Cari pemohon atau nomor WA...">
        </div>
    </div>

    <div class="lapol-bulk-bar" id="bulkBar">
        <div style="font-size: 12px; font-weight: 700; color: #991B1B;">
            <span id="selectCount">0</span> antrean dipilih
        </div>
        <button type="button" onclick="submitBulkDelete()" style="background:#DC2626; border:none; color:#fff; border-radius:4px; font-weight:700; font-size:11.5px; padding:5px 11px; cursor:pointer; display:inline-flex; align-items:center; gap:5px;">
            <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
            <span>Hapus Terpilih</span>
        </button>
    </div>

    <div class="table-wrap">
        @if($bookings->isEmpty())
            <div class="empty-state" style="padding: 36px 20px; text-align: center;">
                <svg width="36" height="36" fill="none" viewBox="0 0 24 24" stroke="#94A3B8" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/>
                </svg>
                <p style="font-size: 13px; color: #64748B; margin-top: 8px;">Belum ada pendaftaran jadwal LAPOL PAK.</p>
            </div>
        @else
            <table class="lapol-table">
                <thead>
                    <tr>
                        <th style="width:36px; text-align:center;"><input type="checkbox" id="checkAll" style="cursor:pointer;"></th>
                        <th>Pemohon</th>
                        <th>WhatsApp</th>
                        <th>Tanggal</th>
                        <th>Jam</th>
                        <th>Status</th>
                        <th style="min-width: 390px;">Kelola</th>
                    </tr>
                </thead>
                <tbody id="lapolTableBody">
                    @foreach($bookings as $booking)
                        @php
                            $rowDateIso = Carbon::parse($booking->booking_date)->format('Y-m-d');
                            $displayName = $booking->nama_pemohon ?? ($booking->user ? ($booking->user->name ?? $booking->user->username) : 'Tamu');
                            $subAccount = $booking->user ? '@' . $booking->user->username : 'Publik';
                        @endphp
                        <tr class="lapol-row"
                            data-status="{{ $booking->status }}"
                            data-date="{{ $rowDateIso }}"
                            data-search="{{ strtolower($displayName . ' ' . ($booking->whatsapp_number ?? '') . ' ' . $subAccount) }}">
                            <td style="text-align:center;">
                                <input type="checkbox" value="{{ $booking->id }}" class="row-check" style="cursor:pointer;">
                            </td>
                            <td>
                                <span class="applicant-name">{{ $displayName }}</span>
                                <span class="applicant-sub">{{ $subAccount }}</span>
                            </td>
                            <td>
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $booking->whatsapp_number) }}" target="_blank" class="wa-link">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                                    <span>{{ $booking->whatsapp_number }}</span>
                                </a>
                            </td>
                            <td style="color:#334155; white-space:nowrap;">{{ $booking->formatted_date }}</td>
                            <td style="color:#003B64; font-weight:700; white-space:nowrap;">{{ $booking->formatted_time_range }}</td>
                            <td>
                                <span class="status-pill" style="background-color: {{ $booking->status_color }}20; color: {{ $booking->status_color }};">
                                    {{ $booking->status_label }}
                                </span>
                            </td>
                            <td>
                                <form action="{{ route('lapolpa.update', $booking->id) }}" method="POST" class="row-action-form">
                                    @csrf
                                    @method('PUT')
                                    <select name="status" class="status-select">
                                        @if($booking->status === 'booked')
                                            <option value="booked" selected disabled>Menunggu</option>
                                        @endif
                                        <option value="diterima" {{ $booking->status === 'diterima' ? 'selected' : '' }}>Diterima</option>
                                        <option value="selesai" {{ $booking->status === 'selesai' ? 'selected' : '' }}>Selesai</option>
                                        <option value="ditolak" {{ $booking->status === 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                    </select>
                                    <input type="text" name="admin_note" placeholder="Catatan opsional..." value="{{ $booking->admin_note }}" class="note-input-inline">
                                    <button type="submit" class="btn-row-save">Simpan</button>
                                    <button type="button" onclick="if(confirm('Hapus data booking ini?')) { document.getElementById('delete-form-{{ $booking->id }}').submit(); }" class="btn-row-del" title="Hapus">
                                        <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                                <form id="delete-form-{{ $booking->id }}" action="{{ route('lapolpa.destroy', $booking->id) }}" method="POST" style="display:none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div id="lapolEmptyFiltered" style="display:none; padding: 28px 16px; text-align:center; font-size:13px; color:#64748B;">
                Tidak ada jadwal booking yang sesuai filter.
            </div>
        @endif
    </div>

    @if(!$bookings->isEmpty())
        <div class="lapol-pag-bar">
            <span id="lapolPagInfo">Menampilkan data</span>
            <div class="lapol-pag-btns" id="lapolPagBtns"></div>
        </div>
    @endif
</div>
@endsection

@section('scripts')
<script>
    (function() {
        var bookings = @json($bookingsByDate);
        var today = new Date();
        var currentYear = today.getFullYear();
        var currentMonth = today.getMonth();
        var selectedDateKey = '';

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
                if (isWeekend || isHoliday) cell.classList.add("holiday");

                var dayBookings = bookings[dateKey] || [];
                if (dayBookings.length > 0) cell.classList.add("has-booking");
                if (selectedDateKey === dateKey) cell.classList.add("is-date-selected");

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
                        more.style.cssText = "font-size:9px;color:#475569;font-weight:700;";
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

                    (function(key, label) {
                        cell.addEventListener("click", function(e) {
                            e.stopPropagation();
                            var p = this.querySelector(".cal-booking-popup");
                            var wasActive = p.classList.contains("active");
                            document.querySelectorAll(".cal-booking-popup.active").forEach(function(el) { el.classList.remove("active"); });
                            if (!wasActive) p.classList.add("active");

                            selectedDateKey = (selectedDateKey === key) ? '' : key;
                            if (window.setLapolDateFilter) {
                                window.setLapolDateFilter(selectedDateKey, label);
                            }
                            renderCalendar(currentYear, currentMonth);
                        });
                    })(dateKey, formattedDate);
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

        window.refreshLapolCalendar = function(dateKey) {
            selectedDateKey = dateKey || '';
            renderCalendar(currentYear, currentMonth);
        };

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

    // ─── FILTER STATUS, SEARCH, BULK DELETE & PAGINATION ───────────
    document.addEventListener('DOMContentLoaded', function() {
        const rows = Array.from(document.querySelectorAll('.lapol-row'));
        const searchInput = document.getElementById('lapolSearch');
        const emptyFiltered = document.getElementById('lapolEmptyFiltered');
        const pagInfo = document.getElementById('lapolPagInfo');
        const pagBtns = document.getElementById('lapolPagBtns');
        const datePill = document.getElementById('dateFilterPill');
        const dateLabel = document.getElementById('dateFilterLabel');

        let activeStatus = 'all';
        let activeDate = '';
        let currentPage = 1;
        const perPage = 10;

        function applyFilters() {
            const q = (searchInput ? searchInput.value : '').trim().toLowerCase();
            const matched = rows.filter(function(r) {
                const okStatus = (activeStatus === 'all') || (r.dataset.status === activeStatus);
                const okDate = (!activeDate) || (r.dataset.date === activeDate);
                const okSearch = (!q) || (r.dataset.search || '').includes(q);
                return okStatus && okDate && okSearch;
            });

            const total = matched.length;
            const totalPages = Math.max(1, Math.ceil(total / perPage));
            if (currentPage > totalPages) currentPage = totalPages;

            rows.forEach(r => r.style.display = 'none');
            const start = (currentPage - 1) * perPage;
            const end = start + perPage;
            matched.slice(start, end).forEach(r => r.style.display = '');

            if (emptyFiltered) emptyFiltered.style.display = total === 0 ? 'block' : 'none';
            if (pagInfo) {
                pagInfo.textContent = total === 0
                    ? '0 antrean ditemukan'
                    : 'Menampilkan ' + (start + 1) + '–' + Math.min(end, total) + ' dari ' + total + ' antrean';
            }

            if (pagBtns) {
                pagBtns.innerHTML = '';
                const prev = document.createElement('button');
                prev.type = 'button';
                prev.className = 'lapol-pg-btn';
                prev.textContent = '‹';
                prev.disabled = currentPage <= 1;
                prev.onclick = function() { currentPage--; applyFilters(); };
                pagBtns.appendChild(prev);

                for (let p = 1; p <= totalPages; p++) {
                    if (totalPages > 7 && Math.abs(p - currentPage) > 2 && p !== 1 && p !== totalPages) continue;
                    const btn = document.createElement('button');
                    btn.type = 'button';
                    btn.className = 'lapol-pg-btn' + (p === currentPage ? ' is-active' : '');
                    btn.textContent = p;
                    btn.onclick = function() { currentPage = p; applyFilters(); };
                    pagBtns.appendChild(btn);
                }

                const next = document.createElement('button');
                next.type = 'button';
                next.className = 'lapol-pg-btn';
                next.textContent = '›';
                next.disabled = currentPage >= totalPages;
                next.onclick = function() { currentPage++; applyFilters(); };
                pagBtns.appendChild(next);
            }
        }

        window.setLapolStatusTab = function(status) {
            activeStatus = status;
            currentPage = 1;
            document.querySelectorAll('#lapolStatusTabs .lapol-tab').forEach(btn => {
                btn.classList.toggle('is-active', btn.dataset.status === status);
            });
            applyFilters();
        };

        window.setLapolDateFilter = function(dateKey, labelText) {
            activeDate = dateKey || '';
            currentPage = 1;
            if (datePill && dateLabel) {
                if (activeDate) {
                    dateLabel.textContent = 'Tanggal: ' + labelText;
                    datePill.classList.add('is-visible');
                } else {
                    datePill.classList.remove('is-visible');
                }
            }
            applyFilters();
        };

        window.clearDateFilter = function() {
            window.setLapolDateFilter('', '');
            if (window.refreshLapolCalendar) window.refreshLapolCalendar('');
        };

        if (searchInput) {
            searchInput.addEventListener('input', function() {
                currentPage = 1;
                applyFilters();
            });
        }

        applyFilters();

        // Bulk Checkboxes (tanpa nested form)
        const checkAll = document.getElementById('checkAll');
        const rowChecks = document.querySelectorAll('.row-check');
        const bulkBar = document.getElementById('bulkBar');
        const selectCount = document.getElementById('selectCount');

        function updateBulkBar() {
            const checkedCount = document.querySelectorAll('.row-check:checked').length;
            if (bulkBar && selectCount) {
                bulkBar.style.display = checkedCount > 0 ? 'flex' : 'none';
                selectCount.innerText = checkedCount;
            }
        }

        if (checkAll) {
            checkAll.addEventListener('change', function() {
                rows.forEach(r => {
                    if (r.style.display !== 'none') {
                        const cb = r.querySelector('.row-check');
                        if (cb) cb.checked = checkAll.checked;
                    }
                });
                updateBulkBar();
            });
        }

        rowChecks.forEach(cb => {
            cb.addEventListener('change', function() {
                if (!cb.checked && checkAll) checkAll.checked = false;
                updateBulkBar();
            });
        });

        window.submitBulkDelete = function() {
            const checked = Array.from(document.querySelectorAll('.row-check:checked'));
            if (!checked.length) return;
            if (!confirm('Apakah Anda yakin ingin menghapus ' + checked.length + ' antrean yang dipilih?')) return;

            const container = document.getElementById('bulkHiddenInputs');
            const form = document.getElementById('bulkForm');
            if (!container || !form) return;

            container.innerHTML = '';
            checked.forEach(cb => {
                const inp = document.createElement('input');
                inp.type = 'hidden';
                inp.name = 'ids[]';
                inp.value = cb.value;
                container.appendChild(inp);
            });
            form.submit();
        };
    });
</script>
@endsection
