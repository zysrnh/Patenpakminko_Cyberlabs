@php
    $isPelaku = Auth::user()->isPelakuUsaha();
    $isDpn = Auth::user()->isDpn();

    $countAll = $applications->count();
    $countDiproses = $applications->where('status_category', 'diproses')->count();
    $countBelumBayar = $applications->where('status_category', 'belum_bayar')->count();
    $countSelesai = $applications->where('status_category', 'selesai')->count();
    $countDitolak = $applications->where('status_category', 'ditolak')->count();
@endphp

<style>
    @keyframes sqFadeUp {
        from { opacity: 0; transform: translateY(6px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    .sq-header {
        background: #FFFFFF;
        border: 1px solid #D6E4EF;
        border-radius: 4px;
        padding: 15px 20px;
        margin-bottom: 14px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
        flex-wrap: wrap;
        animation: sqFadeUp .22s cubic-bezier(0.22, 1, 0.36, 1) both;
    }
    .sq-header-title {
        font-size: 17px;
        font-weight: 800;
        color: #003B64;
        letter-spacing: -0.02em;
        margin: 0 0 2px;
    }
    .sq-header-sub {
        font-size: 12.5px;
        color: #64748B;
        margin: 0;
    }
    .sq-header-right {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }
    .sq-total-chip {
        font-size: 12px;
        font-weight: 700;
        color: #003B64;
        background: #E3F0F9;
        border: 1px solid #BFD9EC;
        padding: 6px 12px;
        border-radius: 4px;
        font-variant-numeric: tabular-nums;
    }
    .sq-create-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #003B64;
        color: #FFFFFF;
        padding: 7px 14px;
        border-radius: 4px;
        font-size: 12.5px;
        font-weight: 600;
        text-decoration: none;
        transition: background .15s ease, transform .1s ease;
    }
    .sq-create-btn:hover {
        background: #218AC9;
        color: #FFFFFF;
    }
    .sq-create-btn:active {
        transform: scale(0.98);
    }

    .sq-panel {
        background: #FFFFFF;
        border: 1px solid #D6E4EF;
        border-radius: 4px;
        overflow: hidden;
        animation: sqFadeUp .26s cubic-bezier(0.22, 1, 0.36, 1) .04s both;
        scroll-margin-top: 72px;
    }

    /* Quick status tabs */
    .sq-tabs-bar {
        display: flex;
        align-items: center;
        gap: 4px;
        padding: 0 16px;
        border-bottom: 1px solid #D6E4EF;
        background: #F8FAFC;
        overflow-x: auto;
        scrollbar-width: none;
    }
    .sq-tabs-bar::-webkit-scrollbar { display: none; }
    .sq-tab {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 11px 12px;
        border: none;
        border-bottom: 2px solid transparent;
        background: transparent;
        color: #64748B;
        font-family: inherit;
        font-size: 12.5px;
        font-weight: 600;
        cursor: pointer;
        white-space: nowrap;
        transition: color .15s ease, border-color .15s ease, background .15s ease;
    }
    .sq-tab:hover {
        color: #003B64;
    }
    .sq-tab.is-active {
        color: #003B64;
        font-weight: 700;
        border-bottom-color: #003B64;
    }
    .sq-tab-count {
        font-size: 11px;
        font-weight: 700;
        padding: 1px 6px;
        border-radius: 4px;
        background: #E2E8F0;
        color: #475569;
        font-variant-numeric: tabular-nums;
    }
    .sq-tab.is-active .sq-tab-count {
        background: #E3F0F9;
        color: #003B64;
    }

    /* Search & SLA controls */
    .sq-filter-bar {
        padding: 12px 16px;
        border-bottom: 1px solid #E8F0F6;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        flex-wrap: wrap;
        background: #FFFFFF;
    }
    .sq-filter-controls {
        display: flex;
        align-items: center;
        gap: 10px;
        flex: 1;
        min-width: 0;
        flex-wrap: wrap;
    }
    .sq-search-box {
        position: relative;
        flex: 1 1 240px;
        min-width: 200px;
        max-width: 380px;
    }
    .sq-search-box svg {
        position: absolute;
        left: 11px;
        top: 50%;
        transform: translateY(-50%);
        width: 15px;
        height: 15px;
        color: #94A3B8;
        pointer-events: none;
    }
    .sq-input,
    .sq-select {
        height: 36px;
        border: 1px solid #CBD5E1;
        border-radius: 4px;
        background: #FFFFFF;
        color: #0F172A;
        font-family: inherit;
        font-size: 12.5px;
        font-weight: 500;
        outline: none;
        transition: border-color .15s ease, box-shadow .15s ease;
    }
    .sq-input {
        width: 100%;
        padding: 0 12px 0 34px;
    }
    .sq-select {
        padding: 0 10px;
        cursor: pointer;
        font-weight: 600;
        color: #003B64;
    }
    .sq-input:focus,
    .sq-select:focus {
        border-color: #218AC9;
        box-shadow: 0 0 0 2px #E3F0F9;
    }
    .sq-filter-meta {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 12px;
        color: #64748B;
        font-weight: 600;
        white-space: nowrap;
    }
    .sq-reset-btn {
        display: none;
        height: 30px;
        padding: 0 10px;
        border-radius: 4px;
        border: 1px solid #CBD5E1;
        background: #F8FAFC;
        color: #003B64;
        font-family: inherit;
        font-size: 11.5px;
        font-weight: 600;
        cursor: pointer;
    }
    .sq-reset-btn:hover {
        background: #E3F0F9;
        border-color: #218AC9;
    }

    /* Bulk action bar */
    .sq-bulk-bar {
        padding: 9px 16px;
        background: #FEF2F2;
        border-bottom: 1px solid #FECACA;
        display: none;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
    }

    /* Table styling — fits desktop cleanly without clipping right column */
    .sq-table-wrap {
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
    .sq-table-wrap table.sq-table {
        width: 100% !important;
        min-width: 0 !important;
        border-collapse: collapse !important;
        font-size: 12.5px !important;
    }
    .sq-table thead th {
        padding: 10px 12px !important;
        font-size: 10.5px !important;
        font-weight: 800 !important;
        color: #475569 !important;
        background: #F8FAFC !important;
        border-bottom: 1px solid #D6E4EF !important;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        white-space: nowrap !important;
    }
    .sq-table tbody td {
        padding: 11px 12px !important;
        border-bottom: 1px solid #EEF3F8 !important;
        vertical-align: middle !important;
        white-space: normal !important;
    }
    @keyframes sqRowFade {
        from { opacity: 0; transform: translateY(4px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    .sq-table tbody tr.clickable-row {
        cursor: pointer;
        transition: background-color .14s ease;
    }
    .sq-table tbody tr.clickable-row.is-row-anim {
        animation: sqRowFade .2s cubic-bezier(0.22, 1, 0.36, 1) both;
        animation-delay: calc(var(--row-idx, 0) * 18ms);
    }
    .sq-table tbody tr.clickable-row:hover td {
        background-color: #F0F7FC !important;
    }
    .sq-table tbody tr.clickable-row:hover .sq-row-name {
        color: #218AC9;
        text-decoration: underline;
    }
    .sq-table tbody tr.clickable-row:hover .sq-btn-detail svg {
        transform: translateX(2px);
    }
    .sq-row-name {
        font-weight: 700;
        color: #003B64;
        font-size: 13px;
        text-decoration: none;
        display: inline-block;
        line-height: 1.3;
        margin-bottom: 2px;
    }
    .sq-row-sub {
        font-size: 11px;
        color: #64748B;
        line-height: 1.4;
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 4px 8px;
    }
    .sq-reg-code {
        font-family: 'DM Mono', monospace;
        font-weight: 600;
        color: #003B64;
    }
    .sq-date-cell {
        white-space: nowrap !important;
        color: #475569;
        font-size: 12px;
        font-variant-numeric: tabular-nums;
    }
    .sq-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        border-radius: 4px;
        padding: 4px 9px;
        font-weight: 700;
        font-size: 11px;
        line-height: 1.25;
        white-space: nowrap;
        transition: transform .14s ease;
    }
    .sq-table tbody tr.clickable-row:hover .sq-badge {
        transform: translateY(-0.5px);
    }
    .sq-actions-cell {
        white-space: nowrap !important;
        text-align: right;
    }
    .sq-actions-group {
        display: inline-flex;
        align-items: center;
        justify-content: flex-end;
        gap: 6px;
    }
    .sq-btn-detail {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        height: 30px;
        padding: 0 10px;
        border-radius: 4px;
        background: #F8FAFC;
        border: 1px solid #CBD5E1;
        color: #003B64;
        font-size: 12px;
        font-weight: 700;
        text-decoration: none;
        transition: background .14s ease, border-color .14s ease, transform .1s ease;
    }
    .sq-btn-detail svg {
        transition: transform .15s ease;
    }
    .sq-btn-detail:hover {
        background: #E3F0F9;
        border-color: #218AC9;
    }
    .sq-btn-detail:active {
        transform: scale(0.97);
    }
    .sq-ptp-select {
        height: 30px;
        padding: 0 6px;
        border-radius: 4px;
        font-size: 11.5px;
        font-weight: 700;
        background: #E3F0F9;
        color: #003B64;
        border: 1px solid #B3D4EC;
        cursor: pointer;
        outline: none;
    }
    .sq-btn-delete {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 30px;
        height: 30px;
        padding: 0;
        border-radius: 4px;
        background: #FEF2F2;
        border: 1px solid #FECACA;
        color: #DC2626;
        cursor: pointer;
        transition: background .14s ease, color .14s ease, border-color .14s ease, transform .1s ease;
    }
    .sq-btn-delete:hover {
        background: #DC2626;
        border-color: #DC2626;
        color: #FFFFFF;
    }
    .sq-btn-delete:active {
        transform: scale(0.96);
    }

    /* Pagination bar */
    .sq-pagination-bar {
        padding: 12px 16px;
        border-top: 1px solid #D6E4EF;
        background: #F8FAFC;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 10px;
    }
    .sq-page-info {
        font-size: 12px;
        font-weight: 600;
        color: #64748B;
    }
    .sq-page-btns {
        display: flex;
        align-items: center;
        gap: 4px;
        flex-wrap: wrap;
    }
    .sq-page-btn {
        min-width: 30px;
        height: 30px;
        padding: 0 9px;
        border-radius: 4px;
        border: 1px solid #CBD5E1;
        background: #FFFFFF;
        color: #003B64;
        font-family: inherit;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: background .14s ease, border-color .14s ease, color .14s ease;
    }
    .sq-page-btn:hover:not(:disabled) {
        background: #E3F0F9;
        border-color: #218AC9;
    }
    .sq-page-btn.is-active {
        background: #003B64;
        border-color: #003B64;
        color: #FFFFFF;
    }
    .sq-page-btn:disabled {
        opacity: 0.45;
        cursor: not-allowed;
        background: #F1F5F9;
    }
    .sq-page-ellipsis {
        font-size: 12px;
        color: #94A3B8;
        padding: 0 4px;
        user-select: none;
    }

    .sq-empty-filter {
        display: none;
        padding: 36px 20px;
        text-align: center;
        color: #64748B;
        font-size: 13px;
    }

    @media (max-width: 900px) {
        .sq-table-wrap table.sq-table {
            min-width: 680px !important;
        }
    }
    @media (max-width: 640px) {
        .sq-header {
            padding: 14px 16px;
        }
        .sq-search-box,
        .sq-select {
            width: 100%;
            max-width: none;
            flex: 1 1 100%;
        }
        .sq-filter-meta {
            width: 100%;
            justify-content: space-between;
        }
        .sq-pagination-bar {
            justify-content: center;
        }
    }
    @media (prefers-reduced-motion: reduce) {
        .sq-header, .sq-panel, .sq-table tbody tr.clickable-row.is-row-anim {
            animation: none !important;
        }
        .sq-table tbody tr.clickable-row:hover .sq-btn-detail svg,
        .sq-table tbody tr.clickable-row:hover .sq-badge {
            transform: none !important;
        }
    }
</style>

<!-- Header Card -->
<div class="sq-header">
    <div>
        <h1 class="sq-header-title">
            {{ $isPelaku ? 'Riwayat Permohonan Saya' : 'Antrean Berkas Masuk' }}
        </h1>
        <p class="sq-header-sub">{{ $serviceDesc }}</p>
    </div>
    <div class="sq-header-right">
        <span class="sq-total-chip">{{ $countAll }} Total Berkas</span>
        @if($isPelaku)
            <a href="{{ route('ptp.create', ['layanan' => $layananSlug, 'new' => 1]) }}" class="sq-create-btn">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                Buat Permohonan Baru
            </a>
        @endif
    </div>
</div>

<div class="sq-panel" id="sqPanel">
    @if($applications->isEmpty())
        <div class="empty-state" style="padding: 44px 20px; text-align: center;">
            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#94A3B8" stroke-width="1.5" style="margin: 0 auto 10px;"><path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            <h3 style="font-size: 15px; font-weight: 700; color: #003B64; margin: 0 0 4px;">Belum Ada Permohonan</h3>
            <p style="font-size: 13px; color: #64748B; margin-bottom: 16px;">
                @if($isPelaku)
                    Anda belum mengajukan permohonan {{ $serviceName }}.
                @else
                    Tidak ada antrean berkas yang menunggu verifikasi saat ini.
                @endif
            </p>
            @if($isPelaku)
                <a href="{{ route('ptp.create', ['layanan' => $layananSlug, 'new' => 1]) }}" class="sq-create-btn">Ajukan Sekarang</a>
            @endif
        </div>
    @else
        <!-- Quick Status Filter Tabs -->
        <div class="sq-tabs-bar" role="tablist" aria-label="Filter status permohonan">
            <button type="button" class="sq-tab is-active" data-status-tab="all">
                Semua <span class="sq-tab-count">{{ $countAll }}</span>
            </button>
            <button type="button" class="sq-tab" data-status-tab="diproses">
                Sedang Diproses <span class="sq-tab-count">{{ $countDiproses }}</span>
            </button>
            <button type="button" class="sq-tab" data-status-tab="belum_bayar">
                Belum Bayar <span class="sq-tab-count">{{ $countBelumBayar }}</span>
            </button>
            <button type="button" class="sq-tab" data-status-tab="selesai">
                Disetujui <span class="sq-tab-count">{{ $countSelesai }}</span>
            </button>
            <button type="button" class="sq-tab" data-status-tab="ditolak">
                Ditolak <span class="sq-tab-count">{{ $countDitolak }}</span>
            </button>
        </div>

        <!-- Search & SLA Controls -->
        <div class="sq-filter-bar">
            <div class="sq-filter-controls">
                <div class="sq-search-box">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    <input type="text" id="searchInput" class="sq-input" placeholder="Cari No. Registrasi, Pemohon, atau No. WA...">
                </div>

                <input type="hidden" id="filterStatus" value="all">

                @if(!$isPelaku)
                <select id="filterSla" class="sq-select" aria-label="Filter SLA Pengendalian">
                    <option value="all">Semua Waktu (SLA)</option>
                    <option value="selesai">Sudah Selesai</option>
                    <option value="berjalan">Masih Berjalan (Aman)</option>
                    <option value="hampir">Hampir Batas Waktu</option>
                    <option value="melewati">Melewati Batas</option>
                </select>
                @endif
            </div>

            <div class="sq-filter-meta">
                <span id="sqCountInfo">Menampilkan berkas</span>
                <button type="button" id="sqResetBtn" class="sq-reset-btn">Reset</button>
            </div>
        </div>

        @if($isDpn)
        <form id="bulkForm" action="{{ route($routePrefix . '.bulk-destroy') }}" method="POST">
            @csrf
            <div class="sq-bulk-bar" id="bulkBar">
                <div style="font-size: 12.5px; font-weight: 700; color: #991B1B;">
                    <span id="selectCount">0</span> permohonan dipilih
                </div>
                <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus semua permohonan yang dipilih? Data tidak bisa dikembalikan!')" style="background:#DC2626; border:none; color:#fff; border-radius: 4px; font-weight: 700; font-size: 12px; padding: 6px 12px; cursor: pointer; display: inline-flex; align-items: center; gap: 5px;">
                    <svg viewBox="0 0 24 24" style="width:13px;height:13px;" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                    Hapus Terpilih
                </button>
            </div>
        @endif

        <div class="sq-table-wrap">
            <table class="sq-table">
                <thead>
                    <tr>
                        @if($isDpn)
                        <th style="width: 38px; text-align: center;"><input type="checkbox" id="checkAll" style="cursor:pointer;" aria-label="Pilih semua di halaman ini"></th>
                        @endif
                        <th>Pemohon &amp; Berkas</th>
                        <th style="width: 96px;">Tanggal</th>
                        @if(!$isPelaku)
                        <th style="width: 138px;">SLA</th>
                        @endif
                        <th style="width: 165px;">Status</th>
                        <th style="text-align: right;">Aksi</th>
                    </tr>
                </thead>
                <tbody id="sqTableBody">
                    @php
                        $shortStatusMap = [
                            'Permohonan Ditolak' => 'Ditolak',
                            'Layanan Selesai' => 'Selesai',
                            'Penerbitan Dokumen (DPMPTSP)' => 'Terbit · DPMPTSP',
                            'Penilaian Tata Ruang (Dinas PUTR)' => 'Penilaian · PUTR',
                            'Penerbitan Pertek (Kantor Pertanahan)' => 'Pertek · BPN',
                            'Pertek Diterbitkan (Kantor Pertanahan)' => 'Pertek · BPN',
                            'Rapat Pembahasan (Kantor Pertanahan)' => 'Rapat · BPN',
                            'Peninjauan Lapangan (Kantor Pertanahan)' => 'Cek Lokasi · BPN',
                            'Validasi Permohonan (Dinas PUTR)' => 'Validasi · PUTR',
                            'Berkas Tidak Sesuai (Perlu Perbaikan)' => 'Perlu Perbaikan',
                            'Menunggu Pembayaran (SPS / PNBP)' => 'Belum Bayar',
                            'Verifikasi Dokumen (Kantor Pertanahan)' => 'Verifikasi · BPN',
                            'Draft / Baru' => 'Baru',
                        ];
                    @endphp
                    @foreach($applications as $app)
                        @php
                            $pemohonName = $app->nama_pengaju ?: ($app->user->name ?? $app->user->username ?? '-');
                            $accountCode = $app->user ? 'PMH' . str_pad($app->user->id, 3, '0', STR_PAD_LEFT) : '-';
                            $phoneText = $app->user->phone_number ?? '-';

                            $fullStatusLabel = $app->status_label;
                            $shortStatusLabel = $shortStatusMap[$fullStatusLabel] ?? \Illuminate\Support\Str::limit($fullStatusLabel, 22);

                            $slaGroup = 'selesai';
                            $slaTitle = '';
                            if (!$isPelaku) {
                                $isSelesai = in_array($app->status, ['disetujui', 'ditolak', 'terbit_pkpr']);
                                $startDate = $app->tgl_mulai_layanan ? \Carbon\Carbon::parse($app->tgl_mulai_layanan) : $app->created_at;
                                $endDate = $isSelesai ? ($app->tgl_selesai_layanan ? \Carbon\Carbon::parse($app->tgl_selesai_layanan) : $app->updated_at) : now();

                                $hariKe = $startDate->getEffectiveWorkingDayNumber($endDate);

                                $isPuPhase = in_array($app->status, ['menunggu_dinas_pu', 'menunggu_satu_pintu', 'menunggu_putr']);
                                $batasMerah = $isPuPhase ? 20 : 10;
                                $batasKuning = $isPuPhase ? 17 : 8;

                                if ($isSelesai) {
                                    $slaClass = 'badge-green';
                                    $slaText = $hariKe > 0 ? 'Selesai · ' . $hariKe . ' Hr' : 'Selesai';
                                    $slaTitle = $hariKe > 0 ? 'Selesai (Hari ke-' . $hariKe . ' Kerja)' : 'Selesai';
                                    $slaGroup = 'selesai';
                                    $slaIcon = '<path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>';
                                } elseif ($hariKe == 0) {
                                    $slaClass = 'badge-yellow';
                                    $slaText = 'Hari 0';
                                    $slaTitle = 'Libur / Belum Hari Kerja';
                                    $slaGroup = 'hampir';
                                    $slaIcon = '<path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>';
                                } elseif ($hariKe >= $batasMerah) {
                                    $slaClass = 'badge-red';
                                    $slaText = 'Telat · ' . $hariKe . ' Hr';
                                    $slaTitle = 'Terlambat (Hari ke-' . $hariKe . ' Kerja)';
                                    $slaGroup = 'melewati';
                                    $slaIcon = '<path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>';
                                } elseif ($hariKe >= $batasKuning) {
                                    $slaClass = 'badge-yellow';
                                    $slaText = 'Hampir · ' . $hariKe . ' Hr';
                                    $slaTitle = 'Hari ke-' . $hariKe . ' Kerja (Mendekati Batas SLA)';
                                    $slaGroup = 'hampir';
                                    $slaIcon = '<path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>';
                                } else {
                                    $slaClass = 'badge-green';
                                    $slaText = 'Proses · ' . $hariKe . ' Hr';
                                    $slaTitle = 'Hari ke-' . $hariKe . ' Kerja';
                                    $slaGroup = 'berjalan';
                                    $slaIcon = '<path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>';
                                }
                            }

                            $searchBlob = strtolower(trim($pemohonName . ' ' . $app->application_number . ' ' . $accountCode . ' ' . $phoneText . ' ' . $fullStatusLabel . ' ' . $shortStatusLabel));
                        @endphp
                        <tr class="clickable-row"
                            data-href="{{ route($routePrefix . '.show', $app->id) }}"
                            data-status-category="{{ $app->status_category }}"
                            data-sla-group="{{ $slaGroup }}"
                            data-search="{{ $searchBlob }}">
                            @if($isDpn)
                            <td style="text-align: center;">
                                <input type="checkbox" name="ids[]" value="{{ $app->id }}" class="row-check" style="cursor:pointer;">
                            </td>
                            @endif
                            <td>
                                <a href="{{ route($routePrefix . '.show', $app->id) }}" class="app-row-title sq-row-name">{{ $pemohonName }}</a>
                                <div class="sq-row-sub">
                                    <span class="sq-reg-code">{{ $app->application_number }}</span>
                                    <span>&bull; {{ $accountCode }}</span>
                                    <span>&bull; {{ $phoneText }}</span>
                                </div>
                            </td>
                            <td class="sq-date-cell">{{ $app->created_at->format('d-m-Y') }}</td>
                            @if(!$isPelaku)
                            <td>
                                <span class="badge sla-badge sq-badge {{ $slaClass }}" title="{{ $slaTitle }}">
                                    <svg style="width:12px;height:12px;flex-shrink:0;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">{!! $slaIcon !!}</svg>
                                    <span>{{ $slaText }}</span>
                                </span>
                            </td>
                            @endif
                            <td>
                                <a href="{{ route($routePrefix . '.show', $app->id) }}" style="text-decoration:none; display:inline-block;" title="{{ $fullStatusLabel }}">
                                    <span class="badge sq-badge" style="background-color:{{ $app->status_color }}20; color:{{ $app->status_color }};">
                                        {{ $shortStatusLabel }}
                                    </span>
                                </a>
                            </td>
                            <td class="sq-actions-cell">
                                <div class="sq-actions-group">
                                    <a href="{{ route($routePrefix . '.show', $app->id) }}" class="sq-btn-detail">
                                        Detail
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                                    </a>
                                    @if($app->ptp_data)
                                    <select class="sq-ptp-select" onchange="if(this.value){ if(this.options[this.selectedIndex].getAttribute('data-target')==='_blank'){ window.open(this.value, '_blank'); } else { window.location.href = this.value; } this.selectedIndex = 0; }">
                                        <option value="" selected disabled>PTP ▾</option>
                                        <option value="{{ route($routePrefix . '.ptp_pdf', $app->id) }}" data-target="_blank">Preview PDF</option>
                                        <option value="{{ route($routePrefix . '.ptp_pdf', $app->id) }}?action=download" data-target="_self">Download DOCX</option>
                                    </select>
                                    @endif
                                    @if($isDpn)
                                    <button type="submit"
                                            form="delete-form-{{ $app->id }}"
                                            class="sq-btn-delete"
                                            title="Hapus permanen {{ $app->application_number }}"
                                            aria-label="Hapus {{ $app->application_number }}"
                                            onclick="return confirm('Hapus permanen permohonan {{ $app->application_number }}? Data tidak bisa dikembalikan!')">
                                        <svg viewBox="0 0 24 24" style="width:14px;height:14px;" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="sq-empty-filter" id="sqEmptyFilter">
            <p style="margin-bottom: 10px;">Tidak ada permohonan yang cocok dengan filter pencarian.</p>
            <button type="button" id="sqEmptyResetBtn" class="sq-page-btn" style="background: #003B64; color: #fff; border-color: #003B64;">Tampilkan Semua</button>
        </div>

        <!-- Pagination Bar -->
        <div class="sq-pagination-bar" id="sqPaginationBar">
            <div class="sq-page-info" id="sqPageInfo">Halaman 1 dari 1</div>
            <div class="sq-page-btns" id="sqPageBtns"></div>
        </div>

        @if($isDpn)
        </form>

        @foreach($applications as $app)
        <form id="delete-form-{{ $app->id }}" action="{{ route($routePrefix . '.destroy', $app->id) }}" method="POST" style="display:none;">
            @csrf
            @method('DELETE')
        </form>
        @endforeach
        @endif
    @endif
</div>

@if($applications->isNotEmpty())
<script>
document.addEventListener('DOMContentLoaded', function() {
    const checkAll = document.getElementById('checkAll');
    const rowChecks = Array.from(document.querySelectorAll('.row-check'));
    const selectCount = document.getElementById('selectCount');
    const bulkBar = document.getElementById('bulkBar');

    const searchInput = document.getElementById('searchInput');
    const filterSla = document.getElementById('filterSla');
    const filterStatus = document.getElementById('filterStatus');
    const statusTabs = Array.from(document.querySelectorAll('.sq-tab[data-status-tab]'));
    const resetBtn = document.getElementById('sqResetBtn');
    const emptyResetBtn = document.getElementById('sqEmptyResetBtn');
    const countInfo = document.getElementById('sqCountInfo');
    const emptyFilter = document.getElementById('sqEmptyFilter');
    const paginationBar = document.getElementById('sqPaginationBar');
    const pageInfo = document.getElementById('sqPageInfo');
    const pageBtns = document.getElementById('sqPageBtns');
    const panel = document.getElementById('sqPanel');
    const tableWrap = document.querySelector('.sq-table-wrap');
    const tableBody = document.getElementById('sqTableBody');

    if (!tableBody) return;
    const allRows = Array.from(tableBody.querySelectorAll('tr'));
    const perPage = 10;
    let currentPage = 1;

    function getVisiblePageRows() {
        return allRows.filter(r => r.style.display !== 'none');
    }

    function updateBulkCount() {
        if (!rowChecks.length) return;
        const checked = document.querySelectorAll('.row-check:checked');
        if (selectCount) selectCount.textContent = checked.length;
        if (bulkBar) {
            bulkBar.style.display = checked.length > 0 ? 'flex' : 'none';
        }
        if (checkAll) {
            const visibleRows = getVisiblePageRows();
            const visibleChecked = visibleRows.filter(r => {
                const cb = r.querySelector('.row-check');
                return cb && cb.checked;
            });
            checkAll.checked = (visibleRows.length > 0 && visibleChecked.length === visibleRows.length);
            checkAll.indeterminate = (visibleChecked.length > 0 && visibleChecked.length < visibleRows.length);
        }
    }

    if (checkAll) {
        checkAll.addEventListener('change', function() {
            const visibleRows = getVisiblePageRows();
            visibleRows.forEach(r => {
                const cb = r.querySelector('.row-check');
                if (cb) cb.checked = this.checked;
            });
            updateBulkCount();
        });
    }

    rowChecks.forEach(cb => {
        cb.addEventListener('change', updateBulkCount);
    });

    function buildPageList(totalPages, current) {
        if (totalPages <= 7) {
            return Array.from({ length: totalPages }, (_, i) => i + 1);
        }
        const pages = [1];
        if (current > 3) pages.push('...');
        for (let p = Math.max(2, current - 1); p <= Math.min(totalPages - 1, current + 1); p++) {
            pages.push(p);
        }
        if (current < totalPages - 2) pages.push('...');
        pages.push(totalPages);
        return pages;
    }

    function renderTable(scrollToTop) {
        const searchTxt = (searchInput ? searchInput.value : '').trim().toLowerCase();
        const slaVal = filterSla ? filterSla.value : 'all';
        const statusVal = filterStatus ? filterStatus.value : 'all';

        const isDirty = searchTxt !== '' || slaVal !== 'all' || statusVal !== 'all';
        if (resetBtn) resetBtn.style.display = isDirty ? 'inline-flex' : 'none';

        const matched = allRows.filter(row => {
            const haystack = row.getAttribute('data-search') || '';
            const cat = row.getAttribute('data-status-category') || '';
            const slaGroup = row.getAttribute('data-sla-group') || '';

            if (searchTxt && !haystack.includes(searchTxt)) return false;
            if (statusVal !== 'all' && cat !== statusVal) return false;
            if (slaVal !== 'all' && slaGroup !== slaVal) return false;
            return true;
        });

        const total = matched.length;
        const totalPages = Math.max(1, Math.ceil(total / perPage));
        if (currentPage > totalPages) currentPage = totalPages;

        allRows.forEach(r => {
            r.style.display = 'none';
            r.classList.remove('is-row-anim');
        });

        if (total === 0) {
            if (tableWrap) tableWrap.style.display = 'none';
            if (emptyFilter) emptyFilter.style.display = 'block';
            if (paginationBar) paginationBar.style.display = 'none';
            if (countInfo) countInfo.textContent = '0 berkas ditemukan';
            updateBulkCount();
            return;
        }

        if (tableWrap) tableWrap.style.display = 'block';
        if (emptyFilter) emptyFilter.style.display = 'none';

        const startIdx = (currentPage - 1) * perPage;
        const endIdx = Math.min(startIdx + perPage, total);

        for (let i = startIdx; i < endIdx; i++) {
            matched[i].style.display = '';
            matched[i].style.setProperty('--row-idx', String(i - startIdx));
        }
        void tableBody.offsetWidth;
        for (let i = startIdx; i < endIdx; i++) {
            matched[i].classList.add('is-row-anim');
        }

        if (countInfo) {
            countInfo.textContent = 'Menampilkan ' + (startIdx + 1) + '–' + endIdx + ' dari ' + total + ' berkas';
        }

        if (totalPages <= 1) {
            if (paginationBar) paginationBar.style.display = 'none';
        } else if (paginationBar && pageInfo && pageBtns) {
            paginationBar.style.display = 'flex';
            pageInfo.textContent = 'Halaman ' + currentPage + ' dari ' + totalPages;
            pageBtns.innerHTML = '';

            const prev = document.createElement('button');
            prev.type = 'button';
            prev.className = 'sq-page-btn';
            prev.textContent = '← Prev';
            prev.disabled = currentPage === 1;
            prev.addEventListener('click', () => {
                if (currentPage > 1) {
                    currentPage--;
                    renderTable(true);
                }
            });
            pageBtns.appendChild(prev);

            buildPageList(totalPages, currentPage).forEach(item => {
                if (item === '...') {
                    const el = document.createElement('span');
                    el.className = 'sq-page-ellipsis';
                    el.textContent = '...';
                    pageBtns.appendChild(el);
                    return;
                }
                const btn = document.createElement('button');
                btn.type = 'button';
                btn.className = 'sq-page-btn' + (item === currentPage ? ' is-active' : '');
                btn.textContent = String(item);
                btn.addEventListener('click', () => {
                    if (currentPage !== item) {
                        currentPage = item;
                        renderTable(true);
                    }
                });
                pageBtns.appendChild(btn);
            });

            const next = document.createElement('button');
            next.type = 'button';
            next.className = 'sq-page-btn';
            next.textContent = 'Next →';
            next.disabled = currentPage === totalPages;
            next.addEventListener('click', () => {
                if (currentPage < totalPages) {
                    currentPage++;
                    renderTable(true);
                }
            });
            pageBtns.appendChild(next);
        }

        updateBulkCount();

        if (scrollToTop && panel) {
            panel.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    }

    statusTabs.forEach(tab => {
        tab.addEventListener('click', function() {
            const val = this.getAttribute('data-status-tab');
            if (filterStatus) filterStatus.value = val;
            statusTabs.forEach(t => t.classList.toggle('is-active', t === this));
            currentPage = 1;
            renderTable(false);
        });
    });

    function resetAllFilters() {
        if (searchInput) searchInput.value = '';
        if (filterSla) filterSla.value = 'all';
        if (filterStatus) filterStatus.value = 'all';
        statusTabs.forEach(t => t.classList.toggle('is-active', t.getAttribute('data-status-tab') === 'all'));
        currentPage = 1;
        renderTable(false);
    }

    if (searchInput) searchInput.addEventListener('input', () => { currentPage = 1; renderTable(false); });
    if (filterSla) filterSla.addEventListener('change', () => { currentPage = 1; renderTable(false); });
    if (resetBtn) resetBtn.addEventListener('click', resetAllFilters);
    if (emptyResetBtn) emptyResetBtn.addEventListener('click', resetAllFilters);

    allRows.forEach(row => {
        row.addEventListener('click', function(e) {
            if (e.target.closest('input, button, a, select, label')) return;
            const href = this.getAttribute('data-href');
            if (href) window.location.href = href;
        });
    });

    renderTable(false);
});
</script>
@endif
