@extends('layouts.app')

@section('title', 'Proyek Strategis Nasional (PSN) â€” PATEN PAK MIKO')
@section('page-title', 'Proyek Strategis Nasional (PSN)')

@push('styles')
<style>
    #searchInput:focus, #filterSla:focus {
        border-color: var(--blue) !important;
        box-shadow: 0 0 0 3px rgba(33,138,201,0.15) !important;
    }
</style>
@endpush

@section('content')
<div class="page-header">
    <div class="page-header-left">
        <div class="breadcrumb">
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <span>â€º</span>
            <span>Proyek Strategis Nasional (PSN)</span>
        </div>
        <h1>
            @if(Auth::user()->isPelakuUsaha())
                Riwayat Permohonan Saya
            @else
                Antrean Berkas Masuk
            @endif
        </h1>
        <p>Permohonan berbasis mandat Proyek Strategis Nasional (PSN) pemerintah.</p>
    </div>
    @if(Auth::user()->isPelakuUsaha())
        <a href="{{ route('ptp.create', ['layanan' => 'psn']) }}" class="btn btn-primary">
            <svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Buat Permohonan Baru
        </a>
    @endif
</div>

<div class="panel">
    @if($applications->isEmpty())
        <div class="empty-state">
            <svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
            <h3>Belum Ada Permohonan</h3>
            <p>
                @if(Auth::user()->isPelakuUsaha())
                    Anda belum mengajukan permohonan Proyek Strategis Nasional (PSN).
                @else
                    Tidak ada antrean berkas yang menunggu verifikasi.
                @endif
            </p>
            @if(Auth::user()->isPelakuUsaha())
                <a href="{{ route('ptp.create', ['layanan' => 'psn']) }}" class="btn btn-primary">Ajukan Sekarang</a>
            @endif
        </div>
    @else
                <!-- Filter Controls -->
        <div class="table-filter-wrap" style="padding: 16px; border-bottom: 1px solid var(--line); display: flex; gap: 12px; align-items: center; flex-wrap: wrap; background: var(--surface); border-top-left-radius: var(--r-lg); border-top-right-radius: var(--r-lg);">
            <div class="search-box" style="position: relative; flex: 1; min-width: 250px;">
                <svg style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: var(--muted); width: 18px; height: 18px;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                <input type="text" id="searchInput" placeholder="Cari No. Registrasi, Pemohon, atau No WA..." style="width: 100%; padding: 10px 14px 10px 40px; border: 1.5px solid var(--line); border-radius: var(--r-md); font-size: 13.5px; outline: none; transition: border-color 0.2s;">
            </div>
            @if(!Auth::user()->isPelakuUsaha())
            <select id="filterSla" style="padding: 10px 14px; border: 1.5px solid var(--line); border-radius: var(--r-md); font-size: 13.5px; outline: none; background: white; color: var(--ink); cursor: pointer; font-weight: 500;">
                <option value="all">Semua Waktu (SLA)</option>
                <option value="selesai">Sudah Selesai</option>
                <option value="berjalan">Masih Berjalan (Aman)</option>
                <option value="hampir">Hampir Batas Waktu</option>
                <option value="melewati">Melewati Batas</option>
            </select>
            @endif
        </div>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>No. Registrasi</th>
                        <th>Pemohon</th>
                        <th>No. WA</th>
                        <th>Tgl Pengajuan</th>
                        @if(!Auth::user()->isPelakuUsaha())
                        <th>SLA (Pengendalian)</th>
                        @endif
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($applications as $app)
                        <tr>
                            <td>
                                <span style="font-family:'DM Mono',monospace;font-size:12px;font-weight:600;color:var(--blue);">{{ $app->application_number }}</span>
                                <div style="font-size:11px;color:var(--muted);margin-top:2px;font-weight:600;">{{ $app->service_name }}</div>
                            </td>
                            <td>
                                <div style="font-weight:700; color:#003B64;">{{ $app->nama_pengaju ?: ($app->user->name ?? $app->user->username) }}</div>
                                <div style="font-size:11px; color:var(--muted);">Akun: PMH{{ str_pad($app->user->id, 3, '0', STR_PAD_LEFT) }}</div>
                            </td>
                            <td style="color:var(--mid);">{{ $app->user->phone_number }}</td>
                            <td style="color:var(--mid);">{{ $app->created_at->format('d-m-Y') }}</td>
                            @if(!Auth::user()->isPelakuUsaha())
                                @php
                                    $isSelesai = in_array($app->status, ['disetujui', 'ditolak', 'terbit_pkpr']);
                                    $startDate = $app->tgl_mulai_layanan ?? $app->created_at;
                                    $endDate = $isSelesai ? ($app->tgl_selesai_layanan ?? $app->updated_at) : now();
                                    $hari = (int)$startDate->diffInDays($endDate);
                                    $hariKe = $hari + 1;
                                    
                                    $isPuPhase = in_array($app->status, ['menunggu_dinas_pu', 'menunggu_satu_pintu', 'menunggu_putr']);
                                    $batasMerah = $isPuPhase ? 20 : 10;
                                    $batasKuning = $isPuPhase ? 17 : 8;

                                    if ($isSelesai) {
                                        $slaClass = 'badge-green';
                                        $slaText = 'Selesai (Hari ke-' . $hariKe . ')';
                                        $slaIcon = '<path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>';
                                    } elseif ($hariKe >= $batasMerah) {
                                        $slaClass = 'badge-red';
                                        $slaText = 'Hari ke-' . $hariKe . ' (Terlambat)';
                                        $slaIcon = '<path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>';
                                    } elseif ($hariKe >= $batasKuning) {
                                        $slaClass = 'badge-yellow';
                                        $slaText = 'Hari ke-' . $hariKe;
                                        $slaIcon = '<path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>';
                                    } else {
                                        $slaClass = 'badge-green';
                                        $slaText = 'Hari ke-' . $hariKe;
                                        $slaIcon = '<path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>';
                                    }
                                @endphp
                                <td>
                                    <span class="badge sla-badge {{ $slaClass }}" style="border-radius: var(--r-sm); padding: 5px 10px; font-weight: 700;">
                                        <svg style="width:14px;height:14px;vertical-align:-2px;margin-right:4px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">{!! $slaIcon !!}</svg> {{ $slaText }}
                                    </span>
                                </td>
                            @endif
                            <td>
                                <span class="badge" style="background-color:{{ $app->status_color }}20;color:{{ $app->status_color }};">
                                    {{ $app->status_label }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('psn.show', $app->id) }}" class="btn btn-sm btn-secondary">
                                    Detail
                                    <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const filterSla = document.getElementById('filterSla');
    const tableBody = document.querySelector('.table-wrap table tbody');
    if(!tableBody) return;
    const rows = tableBody.querySelectorAll('tr');

    function filterTable() {
        const searchTxt = searchInput ? searchInput.value.toLowerCase() : '';
        const slaVal = filterSla ? filterSla.value : 'all';

        rows.forEach(row => {
            const textContent = row.textContent.toLowerCase();
            let slaText = '';
            const slaBadge = row.querySelector('.sla-badge');
            if (slaBadge) {
                slaText = slaBadge.textContent.toLowerCase();
            }
            
            let matchSearch = textContent.includes(searchTxt);
            let matchSla = true;

            if (slaVal === 'selesai' && !slaText.includes('selesai')) matchSla = false;
            if (slaVal === 'berjalan' && (!slaBadge || !slaBadge.classList.contains('badge-green') || slaText.includes('selesai'))) matchSla = false;
            if (slaVal === 'hampir' && (!slaBadge || !slaBadge.classList.contains('badge-yellow'))) matchSla = false;
            if (slaVal === 'melewati' && (!slaBadge || !slaBadge.classList.contains('badge-red'))) matchSla = false;

            row.style.display = (matchSearch && matchSla) ? '' : 'none';
        });
    }

    if(searchInput) searchInput.addEventListener('input', filterTable);
    if(filterSla) filterSla.addEventListener('change', filterTable);
});
</script>
@endsection

