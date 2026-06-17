@extends('layouts.app')

@section('title', 'Pertimbangan Teknis Pertanahan PKKPR Non Berusaha — PATEN PAK MIKO')
@section('page-title', 'Pertimbangan Teknis Pertanahan PKKPR Non Berusaha')

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
            <span>›</span>
            <span>Pertimbangan Teknis Pertanahan PKKPR Non Berusaha</span>
        </div>
        <h1>
            @if(Auth::user()->isPelakuUsaha())
                Riwayat Permohonan Saya
            @else
                Antrean Berkas Masuk
            @endif
        </h1>
        <p>Permohonan kesesuaian ruang untuk rumah tinggal, keagamaan, sosial, dan fasilitas umum.</p>
    </div>
    @if(Auth::user()->isPelakuUsaha())
        <a href="{{ route('ptp.create', ['layanan' => 'non-berusaha']) }}" class="btn btn-primary">
            <svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Buat Permohonan Baru
        </a>
    @endif
</div>

<div class="panel">
    @if($applications->isEmpty())
        <div class="empty-state">
            <svg viewBox="0 0 24 24"><path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            <h3>Belum Ada Permohonan</h3>
            <p>
                @if(Auth::user()->isPelakuUsaha())
                    Anda belum mengajukan permohonan Pertimbangan Teknis Pertanahan PKKPR Non Berusaha.
                @else
                    Tidak ada antrean berkas yang menunggu verifikasi.
                @endif
            </p>
            @if(Auth::user()->isPelakuUsaha())
                <a href="{{ route('ptp.create', ['layanan' => 'non-berusaha']) }}" class="btn btn-primary">Ajukan Sekarang</a>
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
                            <td><span style="font-family:'DM Mono',monospace;font-size:12px;font-weight:600;color:var(--blue);">{{ $app->application_number }}</span></td>
                            <td>
                                <div style="font-weight:700; color:#003B64;">{{ $app->nama_pengaju ?: ($app->user->name ?? $app->user->username) }}</div>
                                <div style="font-size:11px; color:var(--muted);">Akun: PMH{{ str_pad($app->user->id, 3, '0', STR_PAD_LEFT) }}</div>
                            </td>
                            <td style="color:var(--mid);">{{ $app->user->phone_number }}</td>
                            <td style="color:var(--mid);">{{ $app->created_at->format('d-m-Y') }}</td>
                            @if(!Auth::user()->isPelakuUsaha())
                                @php
                                    // Hitung umur berkas jika belum selesai
                                    $isSelesai = in_array($app->status, ['disetujui', 'ditolak', 'terbit_pkpr']);
                                    $hari = $isSelesai ? (int)$app->created_at->diffInDays($app->updated_at) : (int)$app->created_at->diffInDays(now());
                                    $sisaHari = max(0, 10 - $hari);
                                    
                                    if($hari <= 8) {
                                        $warnaSla = '#16A34A'; // Hijau (Aman)
                                    } elseif($hari > 8 && $hari <= 10) {
                                        $warnaSla = '#D97706'; // Kuning (Peringatan)
                                    } else {
                                        $warnaSla = '#DC2626'; // Merah (Terlambat/Batas Waktu)
                                    }
                                @endphp
                                <td>
                                    <span class="badge sla-badge" style="background-color:{{ $warnaSla }};color:#fff; border:none; font-size:11.5px; white-space:nowrap; padding:4px 10px; border-radius:20px; font-weight:700; letter-spacing:.01em;">
                                        @if($isSelesai)
                                            <svg style="width:14px;height:14px;vertical-align:-2px;margin-right:4px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg> {{ $hari }}H Selesai
                                        @elseif($hari > 10)
                                            <svg style="width:14px;height:14px;vertical-align:-2px;margin-right:4px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg> {{ $hari }}H Melewati Batas
                                        @else
                                            <svg style="width:14px;height:14px;vertical-align:-2px;margin-right:4px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg> {{ $hari }}H · Sisa {{ $sisaHari }}H
                                        @endif
                                    </span>
                                </td>
                            @endif
                            <td>
                                <span class="badge" style="background-color:{{ $app->status_color }}20;color:{{ $app->status_color }};">
                                    {{ $app->status_label }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('non-berusaha.show', $app->id) }}" class="btn btn-sm btn-secondary">
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
            // if aman: should contain "sisa" but not "sisa 0h", "sisa 1h", "sisa 2h"
            if (slaVal === 'berjalan' && (!slaText.includes('sisa') || slaText.includes('sisa 2h') || slaText.includes('sisa 1h') || slaText.includes('sisa 0h'))) matchSla = false;
            // if hampir: should contain "sisa 0h" or "sisa 1h" or "sisa 2h"
            if (slaVal === 'hampir' && !(slaText.includes('sisa 2h') || slaText.includes('sisa 1h') || slaText.includes('sisa 0h'))) matchSla = false;
            // if melewati: should contain "melewati batas"
            if (slaVal === 'melewati' && !slaText.includes('terlambat')) matchSla = false;

            row.style.display = (matchSearch && matchSla) ? '' : 'none';
        });
    }

    if(searchInput) searchInput.addEventListener('input', filterTable);
    if(filterSla) filterSla.addEventListener('change', filterTable);
});
</script>
@endsection
