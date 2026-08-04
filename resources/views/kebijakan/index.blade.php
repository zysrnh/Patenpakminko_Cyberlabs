@extends('layouts.app')

@section('title', 'Kebijakan — PATEN PAK MIKO')
@section('page-title', 'Kebijakan')

@push('styles')
<style>
    #searchInput:focus, #filterSla:focus {
        border-color: #218AC9 !important;
        box-shadow: 0 0 0 3px rgba(33,138,201,0.12) !important;
    }
</style>
@endpush

@section('content')
<!-- Header Card -->
<div style="background: #ffffff; border: 1px solid #E2E8F0; border-radius: 6px; padding: 18px 24px; margin-bottom: 20px; box-shadow: 0 2px 6px rgba(0,38,66,0.02); display: flex; align-items: center; justify-content: space-between; gap: 16px; flex-wrap: wrap;">
    <div>
        <div style="font-size: 12px; color: #64748B; margin-bottom: 4px; display: flex; align-items: center; gap: 6px;">
            <a href="{{ route('dashboard') }}" style="color: #218AC9; text-decoration: none; font-weight: 600;">Dashboard</a>
            <span>›</span>
            <span style="color: #64748B;">Kebijakan</span>
        </div>
        <h1 style="font-size: 19px; font-weight: 800; color: #003B64; letter-spacing: -0.02em; margin: 0;">
            @if(Auth::user()->isPelakuUsaha())
                Riwayat Permohonan Saya
            @else
                Antrean Berkas Masuk
            @endif
        </h1>
        <p style="font-size: 12.5px; color: #64748B; margin: 4px 0 0;">Permohonan berbasis mandat kebijakan pemerintah.</p>
    </div>
    @if(Auth::user()->isPelakuUsaha())
        <a href="{{ route('ptp.create', ['layanan' => 'kebijakan', 'new' => 1]) }}" class="btn btn-primary" style="border-radius: 4px; padding: 8px 16px; font-weight: 700; font-size: 13px;">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Buat Permohonan Baru
        </a>
    @endif
</div>

<div class="panel" style="border-radius: 6px; border: 1px solid #E2E8F0; box-shadow: 0 2px 6px rgba(0,38,66,0.02); overflow: hidden; background: #ffffff;">
    @if($applications->isEmpty())
        <div class="empty-state" style="padding: 40px 20px; text-align: center;">
            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#94A3B8" stroke-width="1.5"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
            <h3 style="font-size: 15px; font-weight: 700; color: #0F172A; margin: 12px 0 4px;">Belum Ada Permohonan</h3>
            <p style="font-size: 13px; color: #64748B; margin-bottom: 16px;">
                @if(Auth::user()->isPelakuUsaha())
                    Anda belum mengajukan permohonan Kebijakan.
                @else
                    Tidak ada antrean berkas yang menunggu verifikasi.
                @endif
            </p>
            @if(Auth::user()->isPelakuUsaha())
                <a href="{{ route('ptp.create', ['layanan' => 'kebijakan', 'new' => 1]) }}" class="btn btn-primary" style="border-radius: 4px;">Ajukan Sekarang</a>
            @endif
        </div>
    @else
        <!-- Filter Controls -->
        <div class="table-filter-wrap" style="padding: 14px 18px; border-bottom: 1px solid #E2E8F0; display: flex; gap: 12px; align-items: center; flex-wrap: wrap; background: #F8FAFC;">
            <div class="search-box" style="position: relative; flex: 1; min-width: 240px;">
                <svg style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #94A3B8; width: 16px; height: 16px;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                <input type="text" id="searchInput" placeholder="Cari No. Registrasi, Pemohon, atau No WA..." style="width: 100%; padding: 8px 12px 8px 36px; border: 1.5px solid #CBD5E1; border-radius: 4px; font-size: 13px; outline: none; background: #ffffff; color: #0F172A; transition: border-color 0.2s;">
            </div>
            <select id="filterStatus" style="padding: 8px 12px; border: 1.5px solid #CBD5E1; border-radius: 4px; font-size: 13px; outline: none; background: #ffffff; color: #0F172A; cursor: pointer; font-weight: 600;">
                <option value="all" selected>Semua Status Permohonan</option>
                <option value="diproses">Sedang Diproses (Sudah Bayar)</option>
                <option value="belum_bayar">Belum Bayar / Menunggu Verifikasi</option>
                <option value="selesai">Layanan Selesai (Disetujui)</option>
                <option value="ditolak">Permohonan Ditolak</option>
            </select>
            @if(!Auth::user()->isPelakuUsaha())
            <select id="filterSla" style="padding: 8px 12px; border: 1.5px solid #CBD5E1; border-radius: 4px; font-size: 13px; outline: none; background: #ffffff; color: #0F172A; cursor: pointer; font-weight: 600;">
                <option value="all">Semua Waktu (SLA)</option>
                <option value="selesai">Sudah Selesai</option>
                <option value="berjalan">Masih Berjalan (Aman)</option>
                <option value="hampir">Hampir Batas Waktu</option>
                <option value="melewati">Melewati Batas</option>
            </select>
            @endif
        </div>

        @if(Auth::user()->isDpn())
        <form id="bulkForm" action="{{ route('kebijakan.bulk-destroy') }}" method="POST">
            @csrf
            <div style="padding: 10px 18px; background: #FEF2F2; border-bottom: 1px solid #FECACA; display: none; align-items: center; justify-content: space-between;" id="bulkBar">
                <div style="font-size: 12.5px; font-weight: 700; color: #991B1B;">
                    <span id="selectCount">0</span> permohonan dipilih
                </div>
                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus semua permohonan yang dipilih? Data tidak bisa dikembalikan!')" style="background:#DC2626; border-color:#DC2626; color:#fff; border-radius: 4px; font-weight: 700; font-size: 12px; padding: 5px 12px;">
                    <svg viewBox="0 0 24 24" style="width:13px;height:13px;vertical-align:-2px;margin-right:4px;" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                    Hapus Terpilih
                </button>
            </div>
        @endif

        <div class="table-wrap" style="min-height: 180px;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="border-bottom: 1.5px solid #E2E8F0; background: #F8FAFC;">
                        @if(Auth::user()->isDpn())
                        <th style="width:36px; text-align:center; padding: 10px 12px;"><input type="checkbox" id="checkAll" style="cursor:pointer;"></th>
                        @endif
                        <th style="padding: 10px 14px; font-size: 11px; font-weight: 800; color: #475569; text-transform: uppercase; letter-spacing: 0.05em;">Pemohon</th>
                        <th style="padding: 10px 14px; font-size: 11px; font-weight: 800; color: #475569; text-transform: uppercase; letter-spacing: 0.05em;">No. WA</th>
                        <th style="padding: 10px 14px; font-size: 11px; font-weight: 800; color: #475569; text-transform: uppercase; letter-spacing: 0.05em;">Tgl Permohonan</th>
                        @if(!Auth::user()->isPelakuUsaha())
                        <th style="padding: 10px 14px; font-size: 11px; font-weight: 800; color: #475569; text-transform: uppercase; letter-spacing: 0.05em;">SLA (Pengendalian)</th>
                        @endif
                        <th style="padding: 10px 14px; font-size: 11px; font-weight: 800; color: #475569; text-transform: uppercase; letter-spacing: 0.05em;">Status</th>
                        <th style="padding: 10px 14px; font-size: 11px; font-weight: 800; color: #475569; text-transform: uppercase; letter-spacing: 0.05em; text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($applications as $app)
                        <tr style="border-bottom: 1px solid #F1F5F9;">
                            @if(Auth::user()->isDpn())
                            <td style="text-align:center; padding: 12px;"><input type="checkbox" name="ids[]" value="{{ $app->id }}" class="row-check" style="cursor:pointer;"></td>
                            @endif
                            <td style="padding: 12px 14px;">
                                <div style="font-weight:700; color:#003B64; font-size: 13px;">{{ $app->nama_pengaju ?: ($app->user->name ?? $app->user->username) }}</div>
                                <div style="font-size:11px; color:#64748B;">
                                    Akun: PMH{{ str_pad($app->user->id, 3, '0', STR_PAD_LEFT) }} • 
                                    <span style="font-family:'DM Mono',monospace; font-weight:600; color:#003B64;">{{ $app->application_number }}</span>
                                </div>
                            </td>
                            <td style="padding: 12px 14px; color:#334155; font-size: 12.5px;">{{ $app->user->phone_number }}</td>
                            <td style="padding: 12px 14px; color:#334155; font-size: 12.5px;">{{ $app->created_at->format('d-m-Y') }}</td>
                            @if(!Auth::user()->isPelakuUsaha())
                                @php
                                    $isSelesai = in_array($app->status, ['disetujui', 'ditolak', 'terbit_pkpr']);
                                    $startDate = $app->tgl_mulai_layanan ?? $app->created_at;
                                    $endDate = $isSelesai ? ($app->tgl_selesai_layanan ?? $app->updated_at) : now();
                                    $hari = (int)$startDate->diffInWorkingDaysWithHolidays($endDate);
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
                                <td style="padding: 12px 14px;">
                                    <span class="badge sla-badge {{ $slaClass }}" style="border-radius: 4px; padding: 4px 8px; font-weight: 700; font-size: 11px;">
                                        <svg style="width:13px;height:13px;vertical-align:-2px;margin-right:4px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">{!! $slaIcon !!}</svg> {{ $slaText }}
                                    </span>
                                </td>
                            @endif
                            <td style="padding: 12px 14px;">
                                <span class="badge" style="background-color:{{ $app->status_color }}20;color:{{ $app->status_color }}; border-radius: 4px; padding: 4px 8px; font-weight: 700; font-size: 11px;">
                                    {{ $app->status_label }}
                                </span>
                            </td>
                            <td style="padding: 12px 14px; white-space: nowrap; text-align: center;">
                                <div style="display:inline-flex; gap:6px; align-items:center;">
                                    <a href="{{ route('kebijakan.show', $app->id) }}" class="btn btn-sm btn-secondary" style="border-radius: 4px; font-size: 12px; font-weight: 700; padding: 5px 10px; display: inline-flex; align-items: center; gap: 4px;">
                                        Detail
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                                    </a>
                                    @if($app->ptp_data)
                                     <select onchange="if(this.value){ if(this.options[this.selectedIndex].getAttribute('data-target')==='_blank'){ window.open(this.value, '_blank'); } else { window.location.href = this.value; } this.selectedIndex = 0; }" style="border-radius: 4px; font-size: 12px; font-weight: 700; padding: 5px 8px; background: #E3F0F9; color: #003B64; border: 1px solid #B3D4EC; cursor: pointer; outline: none; height: 30px;">
                                         <option value="" selected disabled>Berkas PTP ▾</option>
                                         <option value="{{ route('kebijakan.ptp_pdf', $app->id) }}" data-target="_blank">📄 Preview PDF</option>
                                         <option value="{{ route('kebijakan.ptp_pdf', $app->id) }}?action=download" data-target="_self">📥 Download DOCX</option>
                                     </select>
                                     @endif
                                    @if(Auth::user()->isDpn())
                                    <button type="submit" form="delete-form-{{ $app->id }}" class="btn btn-sm btn-danger" onclick="return confirm('Hapus permanen permohonan {{ $app->application_number }}? Data tidak bisa dikembalikan!')" style="background:#DC2626;border-color:#DC2626;color:#fff; border-radius: 4px; font-size: 12px; font-weight: 700; padding: 5px 10px; display: inline-flex; align-items: center; gap: 4px;">
                                        <svg viewBox="0 0 24 24" style="width:12px;height:12px;" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        Hapus
                                    </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if(Auth::user()->isDpn())
        </form>

        @foreach($applications as $app)
        <form id="delete-form-{{ $app->id }}" action="{{ route('kebijakan.destroy', $app->id) }}" method="POST" style="display:none;">
            @csrf
            @method('DELETE')
        </form>
        @endforeach
        @endif
    @endif
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const checkAll = document.getElementById('checkAll');
    const rowChecks = document.querySelectorAll('.row-check');
    const selectCount = document.getElementById('selectCount');
    const bulkBar = document.getElementById('bulkBar');

    function updateCount() {
        if (!rowChecks.length) return;
        const checked = document.querySelectorAll('.row-check:checked');
        if (selectCount) selectCount.textContent = checked.length;
        if (bulkBar) {
            bulkBar.style.display = checked.length > 0 ? 'flex' : 'none';
        }
        if (checkAll) {
            checkAll.checked = (checked.length === rowChecks.length && rowChecks.length > 0);
        }
    }

    updateCount();

    if (checkAll) {
        checkAll.addEventListener('change', function() {
            rowChecks.forEach(cb => {
                if (cb.closest('tr').style.display !== 'none') {
                    cb.checked = this.checked;
                }
            });
            updateCount();
        });
    }

    rowChecks.forEach(cb => {
        cb.addEventListener('change', updateCount);
    });

    const searchInput = document.getElementById('searchInput');
    const filterSla = document.getElementById('filterSla');
    const filterStatus = document.getElementById('filterStatus');
    const tableBody = document.querySelector('.table-wrap table tbody');
    if(!tableBody) return;
    const rows = tableBody.querySelectorAll('tr');

    function filterTable() {
        const searchTxt = searchInput ? searchInput.value.toLowerCase() : '';
        const slaVal = filterSla ? filterSla.value : 'all';
        const statusVal = filterStatus ? filterStatus.value : 'all';

        rows.forEach(row => {
            const textContent = row.textContent.toLowerCase();
            let slaText = '';
            const slaBadge = row.querySelector('.sla-badge');
            if (slaBadge) {
                slaText = slaBadge.textContent.toLowerCase();
            }
            
            let matchSearch = textContent.includes(searchTxt);
            let matchSla = true;
            let matchStatus = true;

            if (slaVal === 'selesai' && !slaText.includes('selesai')) matchSla = false;
            if (slaVal === 'berjalan' && (!slaBadge || !slaBadge.classList.contains('badge-green') || slaText.includes('selesai'))) matchSla = false;
            if (slaVal === 'hampir' && (!slaBadge || !slaBadge.classList.contains('badge-yellow'))) matchSla = false;
            if (slaVal === 'melewati' && (!slaBadge || !slaBadge.classList.contains('badge-red'))) matchSla = false;

            if (statusVal === 'diproses' && (textContent.includes('menunggu pembayaran') || textContent.includes('layanan selesai') || textContent.includes('permohonan ditolak'))) matchStatus = false;
            if (statusVal === 'belum_bayar' && (!textContent.includes('menunggu pembayaran') && !textContent.includes('verifikasi dokumen'))) matchStatus = false;
            if (statusVal === 'selesai' && !textContent.includes('layanan selesai')) matchStatus = false;
            if (statusVal === 'ditolak' && !textContent.includes('permohonan ditolak')) matchStatus = false;

            row.style.display = (matchSearch && matchSla && matchStatus) ? '' : 'none';
        });
    }

    if(searchInput) searchInput.addEventListener('input', filterTable);
    if(filterSla) filterSla.addEventListener('change', filterTable);
    if(filterStatus) filterStatus.addEventListener('change', filterTable);

    // Initial filter execution on load
    filterTable();
});
</script>
@endsection
