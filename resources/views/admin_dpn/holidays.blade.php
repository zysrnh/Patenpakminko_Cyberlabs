@extends('layouts.app')

@section('title', 'Manajemen Hari Libur Nasional — PATEN PAK MIKO')
@section('page-title', 'Manajemen Hari Libur Nasional')

@section('content')
<style>
/* ── Calendar Page Scoped Styles ───────────────────────────────────── */

.hl-wrapper {
    display: grid;
    grid-template-columns: 1fr 380px;
    gap: 20px;
    align-items: start;
    margin-bottom: 20px;
}

/* ── Calendar Panel ────────────────────────────────────────────────── */
.hl-cal-panel {
    background: var(--surface);
    border: 1px solid var(--line);
    border-radius: var(--r-lg);
    overflow: hidden;
}

.hl-cal-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 16px 20px;
    border-bottom: 1px solid var(--line);
    background: var(--bg);
}

.hl-cal-header h3 {
    margin: 0;
    font-size: 15px;
    font-weight: 800;
    color: var(--ink);
    letter-spacing: -0.2px;
}

.hl-nav-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 30px;
    height: 30px;
    background: var(--surface);
    border: 1px solid var(--line);
    border-radius: var(--r-sm);
    cursor: pointer;
    color: var(--mid);
    transition: all 0.15s ease;
}

.hl-nav-btn:hover {
    background: var(--blue);
    border-color: var(--blue);
    color: #fff;
}

.hl-cal-body {
    padding: 16px 20px 20px;
}

.hl-day-names {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    gap: 4px;
    margin-bottom: 8px;
}

.hl-day-name {
    text-align: center;
    font-size: 11px;
    font-weight: 700;
    color: var(--muted);
    text-transform: uppercase;
    letter-spacing: 0.5px;
    padding: 4px 0;
}

.hl-day-name.sun { color: #DC2626; }

.hl-days-grid {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    gap: 4px;
}

.hl-day {
    height: 52px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    background: var(--surface);
    border-radius: var(--r-sm);
    font-size: 13px;
    font-weight: 600;
    color: var(--ink);
    border: 1px solid transparent;
    cursor: pointer;
    transition: all 0.15s ease;
    position: relative;
    gap: 3px;
}

.hl-day.empty {
    background: transparent;
    cursor: default;
    pointer-events: none;
}

.hl-day.today {
    background: #EFF6FF;
    border-color: #BFDBFE;
    color: var(--blue);
    font-weight: 800;
}

.hl-day.sunday { color: #DC2626; }

.hl-day.is-holiday {
    background: #FEF2F2;
    border-color: #FECACA;
    color: #DC2626;
}

.hl-day.is-collective {
    background: #FFFBEB;
    border-color: #FDE68A;
    color: #D97706;
}

.hl-day.selected {
    border-color: var(--blue) !important;
    box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.2);
}

.hl-day:not(.empty):not(.today):hover {
    border-color: var(--line);
    background: var(--bg);
    transform: translateY(-1px);
    box-shadow: 0 2px 8px rgba(0,0,0,0.06);
}

.hl-dot {
    width: 5px;
    height: 5px;
    border-radius: 50%;
    flex-shrink: 0;
}

.hl-dot.red  { background: #DC2626; }
.hl-dot.yellow { background: #D97706; }

/* Tooltip */
.hl-tooltip {
    position: absolute;
    bottom: calc(100% + 8px);
    left: 50%;
    transform: translateX(-50%);
    background: #1e293b;
    color: #fff;
    font-size: 11px;
    font-weight: 500;
    padding: 5px 9px;
    border-radius: 5px;
    white-space: nowrap;
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.15s ease;
    z-index: 20;
    max-width: 160px;
    overflow: hidden;
    text-overflow: ellipsis;
}

.hl-tooltip::after {
    content: '';
    position: absolute;
    top: 100%;
    left: 50%;
    transform: translateX(-50%);
    border: 4px solid transparent;
    border-top-color: #1e293b;
}

.hl-day:hover .hl-tooltip { opacity: 1; }

/* Legend */
.hl-legend {
    display: flex;
    align-items: center;
    gap: 20px;
    padding: 12px 20px;
    border-top: 1px solid var(--line);
    background: var(--bg);
}

.hl-legend-item {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 12px;
    font-weight: 600;
    color: var(--mid);
}

.hl-legend-swatch {
    width: 11px;
    height: 11px;
    border-radius: 3px;
}

/* ── Form Panel ────────────────────────────────────────────────────── */
.hl-form-panel {
    background: var(--surface);
    border: 1px solid var(--line);
    border-radius: var(--r-lg);
    overflow: hidden;
    position: sticky;
    top: 80px;
}

.hl-form-header {
    padding: 14px 20px;
    border-bottom: 1px solid var(--line);
    background: var(--bg);
}

.hl-form-header h3 {
    margin: 0;
    font-size: 14px;
    font-weight: 700;
    color: var(--ink);
}

.hl-form-header p {
    margin: 2px 0 0;
    font-size: 12px;
    color: var(--muted);
}

.hl-form-body {
    padding: 18px 20px 20px;
    display: flex;
    flex-direction: column;
    gap: 14px;
}

.hl-field label {
    display: block;
    font-size: 12px;
    font-weight: 700;
    color: var(--mid);
    text-transform: uppercase;
    letter-spacing: 0.4px;
    margin-bottom: 6px;
}

.hl-field label .req {
    color: #DC2626;
    font-weight: 700;
}

.hl-field .form-control {
    width: 100%;
}

.hl-field-hint {
    font-size: 11px;
    color: var(--muted);
    margin-top: 4px;
    display: flex;
    align-items: center;
    gap: 4px;
}

.hl-toggle-row {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 12px 14px;
    background: var(--bg);
    border: 1px solid var(--line);
    border-radius: var(--r-sm);
    cursor: pointer;
    transition: background 0.15s;
}

.hl-toggle-row:hover { background: #FEFBEB; border-color: #FDE68A; }

.hl-toggle-row input[type="checkbox"] {
    width: 15px;
    height: 15px;
    accent-color: #D97706;
    cursor: pointer;
    flex-shrink: 0;
}

.hl-toggle-label {
    font-size: 13px;
    font-weight: 500;
    color: var(--ink);
    cursor: pointer;
    user-select: none;
}

.hl-toggle-sub {
    font-size: 11px;
    color: var(--muted);
    margin-top: 1px;
}

.hl-submit-btn {
    width: 100%;
    justify-content: center;
    padding: 10px 16px;
    font-size: 13px;
    font-weight: 700;
    letter-spacing: 0.1px;
}

/* ── Table Panel ───────────────────────────────────────────────────── */
.hl-table-panel {
    background: var(--surface);
    border: 1px solid var(--line);
    border-radius: var(--r-lg);
    overflow: hidden;
}

.hl-table-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 14px 20px;
    border-bottom: 1px solid var(--line);
    background: var(--bg);
}

.hl-table-header h3 {
    margin: 0;
    font-size: 14px;
    font-weight: 700;
    color: var(--ink);
}

.hl-badge-count {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 22px;
    height: 22px;
    padding: 0 7px;
    background: var(--blue);
    color: #fff;
    font-size: 11px;
    font-weight: 700;
    border-radius: 99px;
}

.hl-table-scroll {
    max-height: 480px;
    overflow-y: auto;
}

.hl-table-scroll table {
    width: 100%;
    border-collapse: collapse;
}

.hl-table-scroll thead th {
    position: sticky;
    top: 0;
    background: var(--bg);
    z-index: 5;
    padding: 10px 16px;
    font-size: 11px;
    font-weight: 700;
    color: var(--muted);
    text-transform: uppercase;
    letter-spacing: 0.5px;
    border-bottom: 1px solid var(--line);
    text-align: left;
    white-space: nowrap;
}

.hl-table-scroll tbody tr {
    border-bottom: 1px solid var(--line);
    transition: background 0.1s;
}

.hl-table-scroll tbody tr:last-child { border-bottom: none; }
.hl-table-scroll tbody tr:hover { background: var(--bg); }

.hl-table-scroll tbody td {
    padding: 11px 16px;
    font-size: 13px;
    color: var(--ink);
    vertical-align: middle;
}

.hl-date-cell {
    font-weight: 700;
    font-size: 13px;
    color: var(--ink);
    white-space: nowrap;
}

.hl-date-day {
    font-size: 11px;
    font-weight: 500;
    color: var(--muted);
    margin-top: 1px;
}

.hl-type-badge {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 3px 9px;
    border-radius: 99px;
    font-size: 11.5px;
    font-weight: 700;
    white-space: nowrap;
}

.hl-type-badge.nasional {
    background: #FEE2E2;
    color: #DC2626;
}

.hl-type-badge.collective {
    background: #FEF3C7;
    color: #D97706;
}

.hl-type-badge .dot {
    width: 5px;
    height: 5px;
    border-radius: 50%;
    flex-shrink: 0;
}

.hl-type-badge.nasional .dot  { background: #DC2626; }
.hl-type-badge.collective .dot { background: #D97706; }

.hl-delete-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 30px;
    height: 30px;
    background: transparent;
    border: 1px solid #FECACA;
    border-radius: var(--r-sm);
    color: #DC2626;
    cursor: pointer;
    transition: all 0.15s;
}

.hl-delete-btn:hover {
    background: #FEE2E2;
    border-color: #DC2626;
}

.hl-empty-state {
    padding: 40px 24px;
    text-align: center;
    color: var(--muted);
    font-size: 13px;
}

.hl-empty-icon {
    width: 44px;
    height: 44px;
    border-radius: 50%;
    background: var(--bg);
    border: 1px solid var(--line);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 12px;
    color: var(--muted);
}

/* ── Selected date preview strip ──────────────────────────────────── */
.hl-date-preview {
    display: none;
    align-items: center;
    gap: 8px;
    padding: 8px 12px;
    background: #EFF6FF;
    border: 1px solid #BFDBFE;
    border-radius: var(--r-sm);
    font-size: 12px;
    font-weight: 600;
    color: var(--blue);
    margin-top: -6px;
}

.hl-date-preview.show { display: flex; }

/* ── Responsive ────────────────────────────────────────────────────── */
@media (max-width: 960px) {
    .hl-wrapper {
        grid-template-columns: 1fr;
    }
    .hl-form-panel { position: static; }
}
</style>

{{-- ── Page Header ────────────────────────────────────────────────── --}}
<div class="page-header" style="margin-bottom: 20px;">
    <div class="page-header-left">
        <div class="breadcrumb">
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <span>›</span>
            <span>Manajemen Hari Libur (SLA)</span>
        </div>
        <h1>Pengaturan Kalender Libur Nasional</h1>
        <p>Visualisasi dan atur tanggal merah & cuti bersama — akan dilewati otomatis dalam perhitungan SLA.</p>
    </div>
</div>

{{-- ── 2-Col: Calendar + Form ─────────────────────────────────────── --}}
<div class="hl-wrapper">

    {{-- Calendar Panel --}}
    <div class="hl-cal-panel">
        <div class="hl-cal-header">
            <button type="button" class="hl-nav-btn" id="btnPrevMonth" aria-label="Bulan sebelumnya">
                <svg viewBox="0 0 24 24" width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5">
                    <polyline points="15 18 9 12 15 6"/>
                </svg>
            </button>
            <h3 id="currentMonthLabel">Juni 2026</h3>
            <button type="button" class="hl-nav-btn" id="btnNextMonth" aria-label="Bulan berikutnya">
                <svg viewBox="0 0 24 24" width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5">
                    <polyline points="9 18 15 12 9 6"/>
                </svg>
            </button>
        </div>

        <div class="hl-cal-body">
            <div class="hl-day-names">
                <div class="hl-day-name">Sen</div>
                <div class="hl-day-name">Sel</div>
                <div class="hl-day-name">Rab</div>
                <div class="hl-day-name">Kam</div>
                <div class="hl-day-name">Jum</div>
                <div class="hl-day-name">Sab</div>
                <div class="hl-day-name sun">Min</div>
            </div>
            <div class="hl-days-grid" id="calendarDays"></div>
        </div>

        <div class="hl-legend">
            <div class="hl-legend-item">
                <div class="hl-legend-swatch" style="background:#FEF2F2; border:1px solid #FECACA;"></div>
                Libur Nasional
            </div>
            <div class="hl-legend-item">
                <div class="hl-legend-swatch" style="background:#FFFBEB; border:1px solid #FDE68A;"></div>
                Cuti Bersama
            </div>
            <div class="hl-legend-item">
                <div class="hl-legend-swatch" style="background:#EFF6FF; border:1px solid #BFDBFE;"></div>
                Hari Ini
            </div>
        </div>
    </div>

    {{-- Form Panel --}}
    <div class="hl-form-panel">
        <div class="hl-form-header">
            <h3>Tambah Hari Libur</h3>
            <p>Klik tanggal di kalender atau isi manual</p>
        </div>

        <div class="hl-form-body">
            <form action="{{ route('dpn.holidays.store') }}" method="POST" id="holidayForm">
                @csrf

                <div class="hl-field">
                    <label>Tanggal <span class="req">*</span></label>
                    <input type="date" name="date" id="dateInput" class="form-control" required>
                    <div class="hl-date-preview" id="datePreview">
                        <svg viewBox="0 0 24 24" width="13" height="13" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                            <line x1="16" y1="2" x2="16" y2="6"/>
                            <line x1="8" y1="2" x2="8" y2="6"/>
                            <line x1="3" y1="10" x2="21" y2="10"/>
                        </svg>
                        <span id="datePreviewText">—</span>
                    </div>
                </div>

                <div class="hl-field" style="margin-top: 4px;">
                    <label>Nama Peringatan / Libur <span class="req">*</span></label>
                    <input
                        type="text"
                        name="name"
                        id="nameInput"
                        class="form-control"
                        placeholder="Contoh: Hari Kemerdekaan RI"
                        required
                    >
                </div>

                <div style="margin-top: 4px;">
                    <label class="hl-toggle-row" for="collectiveCheck">
                        <input type="checkbox" name="is_collective_leave" id="collectiveCheck" value="1">
                        <div>
                            <div class="hl-toggle-label">Cuti Bersama</div>
                            <div class="hl-toggle-sub">Ditampilkan dengan warna kuning pada kalender</div>
                        </div>
                    </label>
                </div>

                <button type="submit" class="btn btn-primary hl-submit-btn" style="margin-top: 4px;">
                    <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5">
                        <line x1="12" y1="5" x2="12" y2="19"/>
                        <line x1="5" y1="12" x2="19" y2="12"/>
                    </svg>
                    Simpan Hari Libur
                </button>
            </form>
        </div>
    </div>

</div>

{{-- ── Table Panel ─────────────────────────────────────────────────── --}}
<div class="hl-table-panel">
    <div class="hl-table-header">
        <h3>Daftar Hari Libur</h3>
        @if(!$holidays->isEmpty())
            <span class="hl-badge-count">{{ $holidays->count() }}</span>
        @endif
    </div>

    @if($holidays->isEmpty())
        <div class="hl-empty-state">
            <div class="hl-empty-icon">
                <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.5">
                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                    <line x1="16" y1="2" x2="16" y2="6"/>
                    <line x1="8" y1="2" x2="8" y2="6"/>
                    <line x1="3" y1="10" x2="21" y2="10"/>
                </svg>
            </div>
            Belum ada hari libur yang disimpan.<br>
            <span style="color: var(--muted); font-size: 12px;">Tambahkan melalui form di atas.</span>
        </div>
    @else
        <div class="hl-table-scroll">
            <table>
                <thead>
                    <tr>
                        <th style="width: 160px;">Tanggal</th>
                        <th>Keterangan</th>
                        <th style="width: 140px;">Tipe</th>
                        <th style="width: 60px; text-align: center;">Hapus</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($holidays as $holiday)
                        @php
                            $parsed = \Carbon\Carbon::parse($holiday->date);
                        @endphp
                        <tr>
                            <td>
                                <div class="hl-date-cell">{{ $parsed->translatedFormat('d M Y') }}</div>
                                <div class="hl-date-day">{{ $parsed->translatedFormat('l') }}</div>
                            </td>
                            <td style="color: var(--ink); font-weight: 500;">{{ $holiday->name }}</td>
                            <td>
                                @if($holiday->is_collective_leave)
                                    <span class="hl-type-badge collective">
                                        <span class="dot"></span>
                                        Cuti Bersama
                                    </span>
                                @else
                                    <span class="hl-type-badge nasional">
                                        <span class="dot"></span>
                                        Libur Nasional
                                    </span>
                                @endif
                            </td>
                            <td style="text-align: center;">
                                <form
                                    action="{{ route('dpn.holidays.destroy', $holiday->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Hapus \'{{ addslashes($holiday->name) }}\'?\nPerhitungan SLA yang melewati tanggal ini akan disesuaikan ulang.');"
                                >
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="hl-delete-btn" title="Hapus hari libur ini">
                                        <svg viewBox="0 0 24 24" width="13" height="13" fill="none" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

@php
    $holidaysJson = $holidays->mapWithKeys(function($h) {
        return [$h->date->format('Y-m-d') => [
            'name'        => $h->name,
            'is_collective' => $h->is_collective_leave,
        ]];
    })->toJson();
@endphp

<script>
document.addEventListener('DOMContentLoaded', function () {
    const holidaysData   = {!! $holidaysJson !!};
    const today          = new Date();
    let currentDate      = new Date();

    const gridEl         = document.getElementById('calendarDays');
    const monthLabelEl   = document.getElementById('currentMonthLabel');
    const dateInputEl    = document.getElementById('dateInput');
    const datePreviewEl  = document.getElementById('datePreview');
    const datePreviewTxt = document.getElementById('datePreviewText');

    const MONTHS = ['Januari','Februari','Maret','April','Mei','Juni',
                    'Juli','Agustus','September','Oktober','November','Desember'];
    const DAYS   = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];

    /* ── Helpers ────────────────────────────────────────────────── */
    function pad(n) { return String(n).padStart(2, '0'); }

    function toDateStr(y, m, d) {
        return `${y}-${pad(m + 1)}-${pad(d)}`;
    }

    function formatHuman(dateStr) {
        const d = new Date(dateStr + 'T00:00:00');
        return `${DAYS[d.getDay()]}, ${d.getDate()} ${MONTHS[d.getMonth()]} ${d.getFullYear()}`;
    }

    /* ── Render calendar ────────────────────────────────────────── */
    function renderCalendar() {
        gridEl.innerHTML = '';

        const year  = currentDate.getFullYear();
        const month = currentDate.getMonth();

        monthLabelEl.textContent = `${MONTHS[month]} ${year}`;

        const firstDay    = new Date(year, month, 1).getDay();
        const daysInMonth = new Date(year, month + 1, 0).getDate();
        const offset      = firstDay === 0 ? 6 : firstDay - 1; // Monday-start

        /* Empty cells */
        for (let i = 0; i < offset; i++) {
            const el = document.createElement('div');
            el.className = 'hl-day empty';
            gridEl.appendChild(el);
        }

        /* Day cells */
        for (let day = 1; day <= daysInMonth; day++) {
            const dateStr  = toDateStr(year, month, day);
            const dayOfWeek = new Date(year, month, day).getDay();
            const isToday  = (
                year  === today.getFullYear() &&
                month === today.getMonth()    &&
                day   === today.getDate()
            );
            const hData    = holidaysData[dateStr];
            const selected = dateInputEl.value === dateStr;

            const cell = document.createElement('div');
            cell.className = 'hl-day';
            cell.dataset.date = dateStr;

            if (isToday)        cell.classList.add('today');
            if (dayOfWeek === 0) cell.classList.add('sunday');
            if (hData)          cell.classList.add(hData.is_collective ? 'is-collective' : 'is-holiday');
            if (selected)       cell.classList.add('selected');

            const numSpan = document.createElement('span');
            numSpan.textContent = day;
            cell.appendChild(numSpan);

            if (hData) {
                const dot = document.createElement('div');
                dot.className = `hl-dot ${hData.is_collective ? 'yellow' : 'red'}`;
                cell.appendChild(dot);

                const tip = document.createElement('div');
                tip.className = 'hl-tooltip';
                tip.textContent = hData.name;
                cell.appendChild(tip);
            }

            cell.addEventListener('click', () => {
                dateInputEl.value = dateStr;
                updateDatePreview(dateStr);

                // Visual selection feedback
                document.querySelectorAll('.hl-day.selected')
                    .forEach(d => d.classList.remove('selected'));
                cell.classList.add('selected');
            });

            gridEl.appendChild(cell);
        }
    }

    /* ── Date preview strip ─────────────────────────────────────── */
    function updateDatePreview(dateStr) {
        if (!dateStr) {
            datePreviewEl.classList.remove('show');
            return;
        }
        datePreviewTxt.textContent = formatHuman(dateStr);
        datePreviewEl.classList.add('show');
    }

    /* ── Sync: manual date input → re-render selection ─────────── */
    dateInputEl.addEventListener('change', function () {
        updateDatePreview(this.value);
        // Navigate calendar to the selected month if needed
        if (this.value) {
            const d = new Date(this.value + 'T00:00:00');
            currentDate = new Date(d.getFullYear(), d.getMonth(), 1);
            renderCalendar();
        }
    });

    /* ── Navigation ─────────────────────────────────────────────── */
    document.getElementById('btnPrevMonth').addEventListener('click', () => {
        currentDate.setMonth(currentDate.getMonth() - 1);
        renderCalendar();
    });

    document.getElementById('btnNextMonth').addEventListener('click', () => {
        currentDate.setMonth(currentDate.getMonth() + 1);
        renderCalendar();
    });

    /* ── Init ───────────────────────────────────────────────────── */
    renderCalendar();

    // Restore preview if date already has a value (e.g. after validation fail)
    if (dateInputEl.value) updateDatePreview(dateInputEl.value);
});
</script>
@endsection
