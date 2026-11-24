@extends('layouts.app')

@section('title', 'Moderasi Ulasan Layanan - PATEN PAK MIKO')
@section('page-title', 'Moderasi Ulasan')

@section('extra-styles')
    @keyframes rvFadeUp {
        from { opacity: 0; transform: translateY(5px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .rv-hero {
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
        animation: rvFadeUp .2s cubic-bezier(0.22, 1, 0.36, 1) both;
    }
    .rv-hero-title { font-size: 17px; font-weight: 800; color: #003B64; letter-spacing: -0.02em; margin: 0 0 2px; }
    .rv-hero-sub { font-size: 12.5px; color: #64748B; margin: 0; }
    .rv-stats-row {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
    }
    .rv-stat-chip {
        background: #F8FAFC;
        border: 1px solid #CBD5E1;
        border-radius: 4px;
        padding: 6px 11px;
        display: flex;
        align-items: baseline;
        gap: 6px;
    }
    .rv-stat-chip strong { font-size: 15px; font-weight: 800; color: #003B64; }
    .rv-stat-chip span { font-size: 11px; font-weight: 600; color: #64748B; }
    .rv-stat-chip--ok { background: #F0FDF4; border-color: #BBF7D0; }
    .rv-stat-chip--ok strong { color: #166534; }
    .rv-stat-chip--wait { background: #FFFBEB; border-color: #FDE68A; }
    .rv-stat-chip--wait strong { color: #B45309; }

    /* Global Toolbar */
    .rv-toolbar-card {
        background: #FFFFFF;
        border: 1px solid #D6E4EF;
        border-radius: 4px;
        padding: 12px 16px;
        margin-bottom: 14px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        flex-wrap: wrap;
        animation: rvFadeUp .22s cubic-bezier(0.22, 1, 0.36, 1) .03s both;
    }
    .rv-filter-left {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
    }
    .rv-select, .rv-search {
        height: 33px;
        padding: 0 10px;
        border: 1px solid #CBD5E1;
        border-radius: 4px;
        font-family: inherit;
        font-size: 12px;
        color: #0F172A;
        background: #FFFFFF;
        outline: none;
    }
    .rv-select:focus, .rv-search:focus { border-color: #218AC9; }
    .rv-status-tabs {
        display: flex;
        align-items: center;
        gap: 5px;
    }
    .rv-tab {
        height: 33px;
        padding: 0 11px;
        border: 1px solid #CBD5E1;
        border-radius: 4px;
        background: #FFFFFF;
        color: #475569;
        font-family: inherit;
        font-size: 11.5px;
        font-weight: 700;
        cursor: pointer;
    }
    .rv-tab:hover { background: #F1F5F9; color: #003B64; }
    .rv-tab.is-active { background: #003B64; border-color: #003B64; color: #FFFFFF; }

    /* Panels */
    .rv-panel {
        background: #FFFFFF;
        border: 1px solid #D6E4EF;
        border-radius: 4px;
        overflow: hidden;
        margin-bottom: 16px;
        animation: rvFadeUp .24s cubic-bezier(0.22, 1, 0.36, 1) .05s both;
    }
    .rv-panel-head {
        padding: 12px 16px;
        background: #F8FAFC;
        border-bottom: 1px solid #E8F0F6;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
    }
    .rv-panel-head h2 {
        font-size: 14px;
        font-weight: 800;
        color: #003B64;
        margin: 0;
    }
    .rv-count-pill {
        font-size: 11px;
        font-weight: 700;
        color: #003B64;
        background: #E3F0F9;
        border: 1px solid #BFD9EC;
        padding: 2px 8px;
        border-radius: 4px;
    }

    .rv-table-wrap { width: 100%; overflow-x: auto; }
    .rv-table {
        width: 100%;
        border-collapse: collapse;
        table-layout: fixed;
    }
    .rv-table th {
        padding: 9px 12px;
        background: #F8FAFC;
        border-bottom: 1px solid #D6E4EF;
        font-size: 10.5px;
        color: #475569;
        text-transform: uppercase;
        font-weight: 800;
        letter-spacing: 0.04em;
        text-align: left;
    }
    .rv-table td {
        padding: 10px 12px;
        border-bottom: 1px solid #EFF4F8;
        vertical-align: middle;
        font-size: 12.5px;
    }
    .rv-table tbody tr:hover { background: #F8FAFC; }

    .user-avatar-badge {
        width: 32px;
        height: 32px;
        border-radius: 4px;
        background: #218AC9;
        color: #FFFFFF;
        font-weight: 700;
        font-size: 11.5px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .user-flex { display: flex; align-items: center; gap: 9px; }

    .stars-yellow { color: #D97706; display: inline-flex; align-items: center; gap: 1px; }
    .review-comment-box {
        background: #F8FAFC;
        border: 1px solid #E2E8F0;
        border-radius: 4px;
        padding: 7px 9px;
        font-size: 11.5px;
        color: #334155;
        line-height: 1.4;
    }
    .review-comment-text {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        font-style: italic;
    }
    .btn-detail-comment {
        margin-top: 3px;
        font-size: 11px;
        font-weight: 700;
        color: #218AC9;
        background: none;
        border: none;
        padding: 0;
        cursor: pointer;
    }
    .btn-detail-comment:hover { color: #003B64; text-decoration: underline; }

    .badge-approved {
        background: #DCFCE7;
        color: #166534;
        border: 1px solid #BBF7D0;
        padding: 3px 8px;
        border-radius: 4px;
        font-size: 11px;
        font-weight: 700;
        white-space: nowrap;
        display: inline-block;
    }
    .badge-pending {
        background: #FEF3C7;
        color: #B45309;
        border: 1px solid #FDE68A;
        padding: 3px 8px;
        border-radius: 4px;
        font-size: 11px;
        font-weight: 700;
        white-space: nowrap;
        display: inline-block;
    }

    .actions-wrap {
        display: inline-flex;
        align-items: center;
        justify-content: flex-end;
        gap: 4px;
        flex-wrap: nowrap;
    }
    .rv-act-btn {
        height: 27px;
        padding: 0 8px;
        border-radius: 4px;
        font-family: inherit;
        font-size: 11px;
        font-weight: 700;
        cursor: pointer;
        border: 1px solid transparent;
        white-space: nowrap;
    }
    .btn-approve { background: #DCFCE7; color: #166534; border-color: #BBF7D0; }
    .btn-approve:hover { background: #16A34A; color: #FFFFFF; border-color: #16A34A; }
    .btn-edit { background: #FEF3C7; color: #B45309; border-color: #FDE68A; }
    .btn-edit:hover { background: #D97706; color: #FFFFFF; border-color: #D97706; }
    .btn-delete { background: #FEF2F2; color: #DC2626; border-color: #FECACA; }
    .btn-delete:hover { background: #DC2626; color: #FFFFFF; border-color: #DC2626; }

    /* Pagination */
    .rv-pag-bar {
        padding: 10px 16px;
        background: #F8FAFC;
        border-top: 1px solid #E8F0F6;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        flex-wrap: wrap;
        font-size: 12px;
        color: #64748B;
    }
    .rv-pag-btns { display: flex; gap: 4px; align-items: center; }
    .rv-pg-btn {
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
    .rv-pg-btn:hover:not(:disabled) { background: #E3F0F9; border-color: #218AC9; }
    .rv-pg-btn.is-active { background: #003B64; border-color: #003B64; color: #FFFFFF; }
    .rv-pg-btn:disabled { opacity: .45; cursor: not-allowed; }

    /* Modals */
    .rv-modal-backdrop {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(15, 23, 42, 0.55);
        z-index: 9999;
        align-items: center;
        justify-content: center;
        padding: 16px;
    }
    .rv-modal-box {
        background: #FFFFFF;
        border-radius: 4px;
        width: 100%;
        max-width: 480px;
        overflow: hidden;
        border: 1px solid #CBD5E1;
        animation: rvFadeUp .18s ease-out both;
    }
    .rv-modal-head {
        background: #003B64;
        color: #FFFFFF;
        padding: 13px 18px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .rv-modal-head h3 { font-size: 14.5px; font-weight: 700; margin: 0; color: #FFFFFF; }
    .rv-modal-close {
        background: rgba(255,255,255,0.14);
        border: 1px solid rgba(255,255,255,0.22);
        border-radius: 4px;
        width: 26px;
        height: 26px;
        color: #FFFFFF;
        font-size: 16px;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    @media (max-width: 1024px) {
        .rv-table { table-layout: auto; min-width: 780px; }
    }
    @media (prefers-reduced-motion: reduce) {
        .rv-hero, .rv-toolbar-card, .rv-panel, .rv-modal-box { animation: none !important; }
    }
@endsection

@section('content')
@php
    $totalReviewsCount = $reviews->count() + $lapolpaReviews->count() + $informalRatings->count();
    $approvedReviewsCount = $reviews->where('is_approved', true)->count() + $lapolpaReviews->where('is_approved', true)->count() + $informalRatings->where('is_approved', true)->count();
    $pendingReviewsCount = $totalReviewsCount - $approvedReviewsCount;
@endphp

<div class="rv-hero">
    <div>
        <h1 class="rv-hero-title">Moderasi Ulasan Layanan</h1>
        <p class="rv-hero-sub">Tinjau, setujui, dan kelola ulasan pengguna dari layanan perizinan, LAPOL PAK, dan peta INFORMAL.</p>
    </div>
    <div class="rv-stats-row">
        <div class="rv-stat-chip">
            <strong>{{ number_format($totalReviewsCount) }}</strong>
            <span>Total</span>
        </div>
        <div class="rv-stat-chip rv-stat-chip--ok">
            <strong>{{ number_format($approvedReviewsCount) }}</strong>
            <span>Tampil</span>
        </div>
        <div class="rv-stat-chip rv-stat-chip--wait">
            <strong>{{ number_format($pendingReviewsCount) }}</strong>
            <span>Menunggu</span>
        </div>
    </div>
</div>

<!-- Toolbar Filter & Cari -->
<div class="rv-toolbar-card">
    <div class="rv-filter-left">
        <form method="GET" action="{{ route('admin.reviews.index') }}" style="display:flex; gap:6px; align-items:center; flex-wrap:wrap;">
            <select name="layanan" onchange="this.form.submit()" class="rv-select">
                <option value="">Semua Kategori Layanan</option>
                <optgroup label="Perizinan & Kebijakan">
                    <option value="perizinan" {{ request('layanan') == 'perizinan' ? 'selected' : '' }}>Semua Layanan Perizinan</option>
                    <option value="berusaha" {{ request('layanan') == 'berusaha' ? 'selected' : '' }}>PKKPR Berusaha</option>
                    <option value="non_berusaha" {{ request('layanan') == 'non_berusaha' ? 'selected' : '' }}>PKKPR Non-Berusaha</option>
                    <option value="kebijakan" {{ request('layanan') == 'kebijakan' ? 'selected' : '' }}>Pertek Kebijakan</option>
                    <option value="tanah_timbul" {{ request('layanan') == 'tanah_timbul' ? 'selected' : '' }}>Tanah Timbul</option>
                    <option value="psn" {{ request('layanan') == 'psn' ? 'selected' : '' }}>PSN</option>
                    <option value="umum" {{ request('layanan') == 'umum' ? 'selected' : '' }}>Ulasan Umum</option>
                </optgroup>
                <optgroup label="LAPOL PAK">
                    <option value="lapolpa" {{ request('layanan') == 'lapolpa' ? 'selected' : '' }}>LAPOL PAK</option>
                </optgroup>
                <optgroup label="Peta Digital">
                    <option value="informal" {{ request('layanan') == 'informal' ? 'selected' : '' }}>INFORMAL (Peta Digital)</option>
                </optgroup>
            </select>
            @if(request('layanan'))
                <a href="{{ route('admin.reviews.index') }}" class="rv-tab" style="text-decoration:none; display:inline-flex; align-items:center; color:#DC2626;">Reset</a>
            @endif
        </form>

        <div class="rv-status-tabs" id="rvStatusTabs">
            <button type="button" class="rv-tab is-active" data-status="all" onclick="setRvStatus('all')">Semua</button>
            <button type="button" class="rv-tab" data-status="approved" onclick="setRvStatus('approved')">Tampil</button>
            <button type="button" class="rv-tab" data-status="pending" onclick="setRvStatus('pending')">Menunggu</button>
        </div>
    </div>

    <input type="text" id="rvSearchInput" class="rv-search" style="min-width:220px; flex:0 1 260px;" placeholder="Cari pengulas atau isi komentar...">
</div>

{{-- PANEL 1: PERIZINAN & KEBIJAKAN --}}
@if(!request('layanan') || (!in_array(request('layanan'), ['lapolpa', 'informal'])))
<div class="rv-panel" data-rv-panel="formal">
    <div class="rv-panel-head">
        <h2>Ulasan Layanan Perizinan &amp; Kebijakan</h2>
        <span class="rv-count-pill">{{ $reviews->count() }} Data</span>
    </div>
    <div class="rv-table-wrap">
        @if($reviews->isEmpty())
            <div style="text-align: center; padding: 32px; color: #64748B; font-size:13px;">Tidak ada ulasan layanan perizinan.</div>
        @else
            <table class="rv-table">
                <thead>
                    <tr>
                        <th style="width: 22%;">Pelaku Usaha</th>
                        <th style="width: 17%;">Layanan</th>
                        <th style="width: 14%;">Penilaian</th>
                        <th style="width: 26%;">Komentar</th>
                        <th style="width: 10%; text-align:center;">Status</th>
                        @if(Auth::user()->isDpn())
                            <th style="width: 11%; text-align:right;">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($reviews as $review)
                        @php
                            $userName = null;
                            if ($review->module_type === 'berusaha' && $review->module_id) {
                                $appItem = \App\Models\PpkprBerusahaApplication::find($review->module_id);
                                if ($appItem) $userName = $appItem->nama_pengaju ?: $appItem->nama_pemilik_usaha;
                            } elseif ($review->module_type === 'non_berusaha' && $review->module_id) {
                                $appItem = \App\Models\PpkprApplication::find($review->module_id);
                                if ($appItem) $userName = $appItem->nama_pengaju ?: $appItem->nama_pemilik_usaha;
                            } elseif ($review->module_type === 'kebijakan' && $review->module_id) {
                                $appItem = \App\Models\KebijakanApplication::find($review->module_id);
                                if ($appItem) $userName = $appItem->nama_pengaju ?: $appItem->nama_pemilik_usaha;
                            } elseif ($review->module_type === 'tanah_timbul' && $review->module_id) {
                                $appItem = \App\Models\TanahTimbulApplication::find($review->module_id);
                                if ($appItem) $userName = $appItem->nama_pengaju ?: $appItem->nama_pemilik_usaha;
                            } elseif ($review->module_type === 'psn' && $review->module_id) {
                                $appItem = \App\Models\PsnApplication::find($review->module_id);
                                if ($appItem) $userName = $appItem->nama_pengaju ?: $appItem->nama_pemilik_usaha;
                            }
                            if (!$userName || strtolower($userName) === 'petugas bpn') {
                                $userName = ($review->user && strtolower($review->user->name) !== 'petugas bpn') ? $review->user->name : ($review->user->username ?? 'Pelaku Usaha');
                            }
                            $initial = strtoupper(substr($userName, 0, 2));
                        @endphp
                        <tr class="rv-row"
                            data-panel="formal"
                            data-approved="{{ $review->is_approved ? 'approved' : 'pending' }}"
                            data-search="{{ strtolower($userName . ' ' . $review->module_label . ' ' . $review->comment) }}">
                            <td>
                                <div class="user-flex">
                                    <div class="user-avatar-badge">{{ $initial }}</div>
                                    <div style="min-width:0; overflow:hidden;">
                                        <strong style="font-size: 12.5px; color: #003B64; display: block; text-overflow:ellipsis; overflow:hidden; white-space:nowrap;">{{ $userName }}</strong>
                                        <span style="font-size: 11px; color: #64748B;">{{ $review->created_at->format('d M Y, H:i') }}</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <strong style="color:#218AC9; display:block; font-size:12px;">{{ $review->module_label }}</strong>
                                <span style="font-size:11px; color:#64748B;">ID: #{{ $review->module_id }}</span>
                            </td>
                            <td>
                                <div class="stars-yellow">
                                    @for($i=1; $i<=5; $i++)
                                        @if($i <= $review->rating)
                                            <svg width="13" height="13" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                        @else
                                            <svg width="13" height="13" fill="none" stroke="#CBD5E1" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                                        @endif
                                    @endfor
                                </div>
                                <div style="font-size:11px; font-weight:700; color:#003B64; margin-top:2px;">{{ $review->rating_label }}</div>
                            </td>
                            <td>
                                <div class="review-comment-box">
                                    <div class="review-comment-text">“{{ $review->comment }}”</div>
                                    <button type="button" class="btn-detail-comment"
                                        onclick="openDetailModal('{{ addslashes(e($userName)) }}', '{{ addslashes(e($review->module_label)) }} #{{ $review->module_id }}', '{{ $review->rating }}', '{{ addslashes(e($review->comment)) }}', '{{ $review->created_at->format('d M Y, H:i') }}')">
                                        Lihat Detail
                                    </button>
                                </div>
                            </td>
                            <td style="text-align: center;">
                                @if($review->is_approved)
                                    <span class="badge-approved">Tampil</span>
                                @else
                                    <span class="badge-pending">Menunggu</span>
                                @endif
                            </td>
                            @if(Auth::user()->isDpn())
                                <td style="text-align: right;">
                                    <div class="actions-wrap">
                                        @if(!$review->is_approved)
                                            <form action="{{ route('admin.reviews.approve', $review->id) }}" method="POST" style="margin:0;">
                                                @csrf
                                                <button type="submit" class="rv-act-btn btn-approve" title="Setujui">Setujui</button>
                                            </form>
                                        @endif
                                        @if(Auth::user()->isSuperAdmin())
                                            <button type="button" class="rv-act-btn btn-edit btn-trigger-edit-formal"
                                                data-id="{{ $review->id }}"
                                                data-name="{{ e($userName) }}"
                                                data-rating="{{ $review->rating }}"
                                                data-comment="{{ e($review->comment) }}"
                                                data-approved="{{ $review->is_approved ? '1' : '0' }}">Edit</button>
                                        @endif
                                        <form action="{{ route('admin.reviews.destroy', $review->id) }}" method="POST" onsubmit="return confirm('Hapus ulasan ini?')" style="margin:0;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="rv-act-btn btn-delete">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
    @if($reviews->isNotEmpty())
        <div class="rv-pag-bar" id="pag-formal">
            <span class="rv-pag-info">Menampilkan data</span>
            <div class="rv-pag-btns"></div>
        </div>
    @endif
</div>
@endif

{{-- PANEL 2: LAPOL PAK --}}
@if(!request('layanan') || request('layanan') === 'lapolpa')
<div class="rv-panel" data-rv-panel="lapol">
    <div class="rv-panel-head">
        <h2>Ulasan Layanan LAPOL PAK</h2>
        <span class="rv-count-pill">{{ $lapolpaReviews->count() }} Data</span>
    </div>
    <div class="rv-table-wrap">
        @if($lapolpaReviews->isEmpty())
            <div style="text-align: center; padding: 32px; color: #64748B; font-size:13px;">Belum ada ulasan layanan LAPOL PAK.</div>
        @else
            <table class="rv-table">
                <thead>
                    <tr>
                        <th style="width: 22%;">Pemohon</th>
                        <th style="width: 17%;">ID Booking</th>
                        <th style="width: 14%;">Penilaian</th>
                        <th style="width: 26%;">Komentar</th>
                        <th style="width: 10%; text-align:center;">Status</th>
                        @if(Auth::user()->isDpn())
                            <th style="width: 11%; text-align:right;">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($lapolpaReviews as $review)
                        @php
                            $lapolpaBooking = \App\Models\LapolpaBooking::find($review->module_id);
                            $pemohonName = $lapolpaBooking ? $lapolpaBooking->nama_pemohon : ($review->user ? ($review->user->name ?? $review->user->username) : 'Pemohon LAPOLPAK');
                            $initial = strtoupper(substr($pemohonName, 0, 2));
                        @endphp
                        <tr class="rv-row"
                            data-panel="lapol"
                            data-approved="{{ $review->is_approved ? 'approved' : 'pending' }}"
                            data-search="{{ strtolower($pemohonName . ' lapolpak ' . $review->comment) }}">
                            <td>
                                <div class="user-flex">
                                    <div class="user-avatar-badge" style="background:#003B64;">{{ $initial }}</div>
                                    <div style="min-width:0; overflow:hidden;">
                                        <strong style="font-size: 12.5px; color: #003B64; display: block; text-overflow:ellipsis; overflow:hidden; white-space:nowrap;">{{ $pemohonName }}</strong>
                                        <span style="font-size: 11px; color: #64748B;">{{ $review->created_at->format('d M Y, H:i') }}</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <strong style="color:#218AC9; display:block; font-size:12px;">LAPOL PAK</strong>
                                <span style="font-size:11px; color:#64748B;">Booking #{{ $review->module_id }}</span>
                            </td>
                            <td>
                                <div class="stars-yellow">
                                    @for($i=1; $i<=5; $i++)
                                        @if($i <= $review->rating)
                                            <svg width="13" height="13" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                        @else
                                            <svg width="13" height="13" fill="none" stroke="#CBD5E1" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                                        @endif
                                    @endfor
                                </div>
                                <div style="font-size:11px; font-weight:700; color:#003B64; margin-top:2px;">{{ $review->rating_label }}</div>
                            </td>
                            <td>
                                <div class="review-comment-box">
                                    <div class="review-comment-text">“{{ $review->comment }}”</div>
                                    <button type="button" class="btn-detail-comment"
                                        onclick="openDetailModal('{{ addslashes(e($pemohonName)) }}', 'LAPOL PAK #{{ $review->module_id }}', '{{ $review->rating }}', '{{ addslashes(e($review->comment)) }}', '{{ $review->created_at->format('d M Y, H:i') }}')">
                                        Lihat Detail
                                    </button>
                                </div>
                            </td>
                            <td style="text-align: center;">
                                @if($review->is_approved)
                                    <span class="badge-approved">Tampil</span>
                                @else
                                    <span class="badge-pending">Menunggu</span>
                                @endif
                            </td>
                            @if(Auth::user()->isDpn())
                                <td style="text-align: right;">
                                    <div class="actions-wrap">
                                        @if(!$review->is_approved)
                                            <form action="{{ route('admin.reviews.approve', $review->id) }}" method="POST" style="margin:0;">
                                                @csrf
                                                <button type="submit" class="rv-act-btn btn-approve">Setujui</button>
                                            </form>
                                        @endif
                                        @if(Auth::user()->isSuperAdmin())
                                            <button type="button" class="rv-act-btn btn-edit btn-trigger-edit-formal"
                                                data-id="{{ $review->id }}"
                                                data-name="{{ e($pemohonName) }}"
                                                data-rating="{{ $review->rating }}"
                                                data-comment="{{ e($review->comment) }}"
                                                data-approved="{{ $review->is_approved ? '1' : '0' }}">Edit</button>
                                        @endif
                                        <form action="{{ route('admin.reviews.destroy', $review->id) }}" method="POST" onsubmit="return confirm('Hapus ulasan ini?')" style="margin:0;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="rv-act-btn btn-delete">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
    @if($lapolpaReviews->isNotEmpty())
        <div class="rv-pag-bar" id="pag-lapol">
            <span class="rv-pag-info">Menampilkan data</span>
            <div class="rv-pag-btns"></div>
        </div>
    @endif
</div>
@endif

{{-- PANEL 3: INFORMAL --}}
@if(!request('layanan') || request('layanan') === 'informal')
<div class="rv-panel" data-rv-panel="informal">
    <div class="rv-panel-head">
        <h2>Ulasan Peta Digital (INFORMAL)</h2>
        <span class="rv-count-pill">{{ $informalRatings->count() }} Data</span>
    </div>
    <div class="rv-table-wrap">
        @if($informalRatings->isEmpty())
            <div style="text-align: center; padding: 32px; color: #64748B; font-size:13px;">Belum ada ulasan informal.</div>
        @else
            <table class="rv-table">
                <thead>
                    <tr>
                        <th style="width: 22%;">Pengguna</th>
                        <th style="width: 17%;">Layer &amp; Koordinat</th>
                        <th style="width: 14%;">Penilaian</th>
                        <th style="width: 26%;">Komentar</th>
                        <th style="width: 10%; text-align:center;">Status</th>
                        @if(Auth::user()->isDpn())
                            <th style="width: 11%; text-align:right;">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($informalRatings as $rating)
                        @php
                            $publicName = $rating->name ?: ($rating->user->name ?? 'Anonim');
                            $publicInitial = strtoupper(substr($publicName, 0, 2));
                        @endphp
                        <tr class="rv-row"
                            data-panel="informal"
                            data-approved="{{ $rating->is_approved ? 'approved' : 'pending' }}"
                            data-search="{{ strtolower($publicName . ' ' . ($rating->informal_type ?? '') . ' ' . $rating->comment) }}">
                            <td>
                                <div class="user-flex">
                                    <div class="user-avatar-badge" style="background:#0F4C81;">{{ $publicInitial }}</div>
                                    <div style="min-width:0; overflow:hidden;">
                                        <strong style="font-size: 12.5px; color: #003B64; display: block; text-overflow:ellipsis; overflow:hidden; white-space:nowrap;">{{ $publicName }}</strong>
                                        <span style="font-size: 11px; color: #64748B;">{{ $rating->created_at->format('d M Y, H:i') }}</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <strong style="color:#218AC9; display:block; font-size:12px;">{{ $rating->informal_type ?: 'PETA' }}</strong>
                                @if(!empty($rating->latitude) && (float)$rating->latitude != 0 && (float)$rating->longitude != 0)
                                    <span style="font-size:11px; color:#64748B; font-family:monospace;">{{ number_format((float)$rating->latitude, 4) }}, {{ number_format((float)$rating->longitude, 4) }}</span>
                                @else
                                    <span style="font-size:11px; color:#64748B;">Ulasan Peta</span>
                                @endif
                            </td>
                            <td>
                                <div class="stars-yellow">
                                    @for($i=1; $i<=5; $i++)
                                        @if($i <= $rating->rating)
                                            <svg width="13" height="13" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                        @else
                                            <svg width="13" height="13" fill="none" stroke="#CBD5E1" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                                        @endif
                                    @endfor
                                </div>
                                <div style="font-size:11px; font-weight:700; color:#003B64; margin-top:2px;">{{ $rating->rating }}/5</div>
                            </td>
                            <td>
                                <div class="review-comment-box">
                                    <div class="review-comment-text">“{{ $rating->comment }}”</div>
                                    <button type="button" class="btn-detail-comment"
                                        onclick="openDetailModal('{{ addslashes(e($publicName)) }}', 'INFORMAL: {{ addslashes(e($rating->informal_type ?: 'PETA')) }}', '{{ $rating->rating }}', '{{ addslashes(e($rating->comment)) }}', '{{ $rating->created_at->format('d M Y, H:i') }}')">
                                        Lihat Detail
                                    </button>
                                </div>
                            </td>
                            <td style="text-align: center;">
                                @if($rating->is_approved)
                                    <span class="badge-approved">Tampil</span>
                                @else
                                    <span class="badge-pending">Menunggu</span>
                                @endif
                            </td>
                            @if(Auth::user()->isDpn())
                                <td style="text-align: right;">
                                    <div class="actions-wrap">
                                        @if(!$rating->is_approved)
                                            <form action="{{ route('admin.informal-reviews.approve', $rating->id) }}" method="POST" style="margin:0;">
                                                @csrf
                                                <button type="submit" class="rv-act-btn btn-approve">Setujui</button>
                                            </form>
                                        @endif
                                        <button type="button" class="rv-act-btn btn-edit btn-trigger-edit-informal"
                                            data-id="{{ $rating->id }}"
                                            data-name="{{ e($publicName) }}"
                                            data-rating="{{ $rating->rating }}"
                                            data-comment="{{ e($rating->comment) }}"
                                            data-approved="{{ $rating->is_approved ? '1' : '0' }}">Edit</button>
                                        <form action="{{ route('admin.informal-reviews.destroy', $rating->id) }}" method="POST" onsubmit="return confirm('Hapus ulasan ini?')" style="margin:0;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="rv-act-btn btn-delete">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
    @if($informalRatings->isNotEmpty())
        <div class="rv-pag-bar" id="pag-informal">
            <span class="rv-pag-info">Menampilkan data</span>
            <div class="rv-pag-btns"></div>
        </div>
    @endif
</div>
@endif

<!-- Modal Detail Catatan Ulasan Lengkap -->
<div id="detailCommentModal" class="rv-modal-backdrop" onclick="if(event.target === this) closeDetailModal()">
    <div class="rv-modal-box">
        <div class="rv-modal-head">
            <h3>Detail Catatan Ulasan</h3>
            <button type="button" onclick="closeDetailModal()" class="rv-modal-close">&times;</button>
        </div>
        <div style="padding: 18px;">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; gap: 12px; margin-bottom: 12px; border-bottom: 1px solid #E8F0F6; padding-bottom: 10px;">
                <div>
                    <span style="font-size: 11px; font-weight: 700; color: #64748B; text-transform: uppercase;">Pengulas</span>
                    <strong id="modal_detail_name" style="font-size: 14px; color: #003B64; display: block;">-</strong>
                    <span id="modal_detail_service" style="font-size: 11.5px; color: #218AC9; font-weight: 600;">-</span>
                </div>
                <div style="text-align: right;">
                    <div id="modal_detail_stars" class="stars-yellow" style="justify-content: flex-end;"></div>
                    <div id="modal_detail_date" style="font-size: 11px; color: #64748B; margin-top: 2px;">-</div>
                </div>
            </div>
            <div id="modal_detail_comment" style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 4px; padding: 12px; font-size: 13px; color: #1E293B; line-height: 1.5; font-style: italic; white-space: pre-wrap; max-height: 220px; overflow-y: auto;">-</div>
            <div style="display: flex; justify-content: flex-end; margin-top: 14px;">
                <button type="button" onclick="closeDetailModal()" class="rv-tab">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Ulasan Formal -->
<div id="editReviewModal" class="rv-modal-backdrop" onclick="if(event.target === this) closeEditReviewModal()">
    <div class="rv-modal-box">
        <div class="rv-modal-head">
            <h3>Edit Ulasan Layanan</h3>
            <button type="button" onclick="closeEditReviewModal()" class="rv-modal-close">&times;</button>
        </div>
        <form id="editReviewForm" method="POST" action="" style="padding: 18px;">
            @csrf
            @method('PUT')
            <div style="margin-bottom: 12px;">
                <label style="font-size: 11.5px; font-weight: 700; color: #003B64; display: block; margin-bottom: 4px;">Nama Pemohon:</label>
                <input type="text" id="edit_reviewer_name" readonly class="rv-search" style="background: #F8FAFC; width: 100%; height: 34px;">
            </div>
            <div style="margin-bottom: 12px;">
                <label style="font-size: 11.5px; font-weight: 700; color: #003B64; display: block; margin-bottom: 4px;">Penilaian (1-5):</label>
                <select name="rating" id="edit_review_rating" class="rv-select" required style="width: 100%; height: 34px;">
                    <option value="5">5 Bintang — Sangat Memuaskan</option>
                    <option value="4">4 Bintang — Memuaskan</option>
                    <option value="3">3 Bintang — Cukup Baik</option>
                    <option value="2">2 Bintang — Kurang</option>
                    <option value="1">1 Bintang — Sangat Kurang</option>
                </select>
            </div>
            <div style="margin-bottom: 12px;">
                <label style="font-size: 11.5px; font-weight: 700; color: #003B64; display: block; margin-bottom: 4px;">Komentar:</label>
                <textarea name="comment" id="edit_review_comment" rows="3" required class="rv-search" style="width: 100%; height: auto; padding: 8px 10px; resize: vertical;"></textarea>
            </div>
            <div style="margin-bottom: 14px;">
                <label style="font-size: 11.5px; font-weight: 700; color: #003B64; display: block; margin-bottom: 4px;">Status Publikasi:</label>
                <select name="is_approved" id="edit_review_is_approved" class="rv-select" style="width: 100%; height: 34px;">
                    <option value="1">Tampil di Halaman Utama</option>
                    <option value="0">Menunggu Moderasi / Sembunyikan</option>
                </select>
            </div>
            <div style="display: flex; justify-content: flex-end; gap: 8px; border-top: 1px solid #E8F0F6; padding-top: 12px;">
                <button type="button" onclick="closeEditReviewModal()" class="rv-tab">Batal</button>
                <button type="submit" class="rv-tab is-active">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit Ulasan Informal -->
<div id="editInformalModal" class="rv-modal-backdrop" onclick="if(event.target === this) closeEditInformalModal()">
    <div class="rv-modal-box">
        <div class="rv-modal-head">
            <h3>Edit Ulasan Peta INFORMAL</h3>
            <button type="button" onclick="closeEditInformalModal()" class="rv-modal-close">&times;</button>
        </div>
        <form id="editInformalForm" method="POST" action="" style="padding: 18px;">
            @csrf
            @method('PUT')
            <div style="margin-bottom: 12px;">
                <label style="font-size: 11.5px; font-weight: 700; color: #003B64; display: block; margin-bottom: 4px;">Nama Pengguna:</label>
                <input type="text" name="name" id="edit_informal_name" class="rv-search" style="width: 100%; height: 34px;">
            </div>
            <div style="margin-bottom: 12px;">
                <label style="font-size: 11.5px; font-weight: 700; color: #003B64; display: block; margin-bottom: 4px;">Penilaian (1-5):</label>
                <select name="rating" id="edit_informal_rating" class="rv-select" required style="width: 100%; height: 34px;">
                    <option value="5">5 Bintang — Sangat Memuaskan</option>
                    <option value="4">4 Bintang — Memuaskan</option>
                    <option value="3">3 Bintang — Cukup Baik</option>
                    <option value="2">2 Bintang — Kurang</option>
                    <option value="1">1 Bintang — Sangat Kurang</option>
                </select>
            </div>
            <div style="margin-bottom: 12px;">
                <label style="font-size: 11.5px; font-weight: 700; color: #003B64; display: block; margin-bottom: 4px;">Komentar:</label>
                <textarea name="comment" id="edit_informal_comment" rows="3" required class="rv-search" style="width: 100%; height: auto; padding: 8px 10px; resize: vertical;"></textarea>
            </div>
            <div style="margin-bottom: 14px;">
                <label style="font-size: 11.5px; font-weight: 700; color: #003B64; display: block; margin-bottom: 4px;">Status Publikasi:</label>
                <select name="is_approved" id="edit_informal_is_approved" class="rv-select" style="width: 100%; height: 34px;">
                    <option value="1">Tampil di Halaman Utama</option>
                    <option value="0">Menunggu Moderasi / Sembunyikan</option>
                </select>
            </div>
            <div style="display: flex; justify-content: flex-end; gap: 8px; border-top: 1px solid #E8F0F6; padding-top: 12px;">
                <button type="button" onclick="closeEditInformalModal()" class="rv-tab">Batal</button>
                <button type="submit" class="rv-tab is-active">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
function openDetailModal(name, service, rating, comment, date) {
    document.getElementById('modal_detail_name').innerText = name || '-';
    document.getElementById('modal_detail_service').innerText = service || '-';
    document.getElementById('modal_detail_date').innerText = date || '-';
    document.getElementById('modal_detail_comment').innerText = '“' + comment + '”';

    var starHtml = '';
    var r = parseInt(rating) || 5;
    for (var i = 1; i <= 5; i++) {
        starHtml += i <= r
            ? '<svg width="14" height="14" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>'
            : '<svg width="14" height="14" fill="none" stroke="#CBD5E1" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>';
    }
    document.getElementById('modal_detail_stars').innerHTML = starHtml;
    document.getElementById('detailCommentModal').style.display = 'flex';
}
function closeDetailModal() { document.getElementById('detailCommentModal').style.display = 'none'; }
function closeEditReviewModal() { document.getElementById('editReviewModal').style.display = 'none'; }
function closeEditInformalModal() { document.getElementById('editInformalModal').style.display = 'none'; }

document.addEventListener('click', function(e) {
    var btn = e.target.closest('.btn-trigger-edit-formal');
    if (btn) {
        document.getElementById('editReviewForm').action = '/admin/reviews/' + btn.dataset.id;
        document.getElementById('edit_reviewer_name').value = btn.dataset.name;
        document.getElementById('edit_review_rating').value = btn.dataset.rating;
        document.getElementById('edit_review_comment').value = btn.dataset.comment;
        document.getElementById('edit_review_is_approved').value = btn.dataset.approved;
        document.getElementById('editReviewModal').style.display = 'flex';
    }
    var btnInf = e.target.closest('.btn-trigger-edit-informal');
    if (btnInf) {
        document.getElementById('editInformalForm').action = '/admin/informal-reviews/' + btnInf.dataset.id;
        document.getElementById('edit_informal_name').value = btnInf.dataset.name;
        document.getElementById('edit_informal_rating').value = btnInf.dataset.rating;
        document.getElementById('edit_informal_comment').value = btnInf.dataset.comment;
        document.getElementById('edit_informal_is_approved').value = btnInf.dataset.approved;
        document.getElementById('editInformalModal').style.display = 'flex';
    }
});

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeDetailModal();
        closeEditReviewModal();
        closeEditInformalModal();
    }
});

// Filter Status, Pencarian & Pagination 10 Baris per Panel
document.addEventListener('DOMContentLoaded', function() {
    const panels = ['formal', 'lapol', 'informal'];
    const state = { status: 'all', q: '', pages: { formal: 1, lapol: 1, informal: 1 } };
    const perPage = 10;

    function renderPanel(panelName) {
        const rows = Array.from(document.querySelectorAll('.rv-row[data-panel="' + panelName + '"]'));
        if (!rows.length) return;

        const filtered = rows.filter(r => {
            const okStatus = state.status === 'all' || r.dataset.approved === state.status;
            const okQuery = !state.q || (r.dataset.search || '').includes(state.q);
            return okStatus && okQuery;
        });

        const total = filtered.length;
        const totalPages = Math.max(1, Math.ceil(total / perPage));
        if (state.pages[panelName] > totalPages) state.pages[panelName] = totalPages;
        const page = state.pages[panelName];

        rows.forEach(r => r.style.display = 'none');
        const start = (page - 1) * perPage;
        const end = start + perPage;
        filtered.slice(start, end).forEach(r => r.style.display = '');

        const pagBar = document.getElementById('pag-' + panelName);
        if (!pagBar) return;
        const info = pagBar.querySelector('.rv-pag-info');
        const btns = pagBar.querySelector('.rv-pag-btns');
        if (info) {
            info.textContent = total === 0
                ? '0 ulasan sesuai filter'
                : 'Menampilkan ' + (start + 1) + '–' + Math.min(end, total) + ' dari ' + total + ' ulasan';
        }
        if (btns) {
            btns.innerHTML = '';
            const prev = document.createElement('button');
            prev.type = 'button';
            prev.className = 'rv-pg-btn';
            prev.textContent = '‹';
            prev.disabled = page <= 1;
            prev.onclick = () => { state.pages[panelName]--; renderPanel(panelName); };
            btns.appendChild(prev);

            for (let p = 1; p <= totalPages; p++) {
                if (totalPages > 7 && Math.abs(p - page) > 2 && p !== 1 && p !== totalPages) continue;
                const b = document.createElement('button');
                b.type = 'button';
                b.className = 'rv-pg-btn' + (p === page ? ' is-active' : '');
                b.textContent = p;
                b.onclick = () => { state.pages[panelName] = p; renderPanel(panelName); };
                btns.appendChild(b);
            }

            const next = document.createElement('button');
            next.type = 'button';
            next.className = 'rv-pg-btn';
            next.textContent = '›';
            next.disabled = page >= totalPages;
            next.onclick = () => { state.pages[panelName]++; renderPanel(panelName); };
            btns.appendChild(next);
        }
    }

    function renderAll() { panels.forEach(renderPanel); }

    window.setRvStatus = function(status) {
        state.status = status;
        panels.forEach(p => state.pages[p] = 1);
        document.querySelectorAll('#rvStatusTabs .rv-tab').forEach(b => b.classList.toggle('is-active', b.dataset.status === status));
        renderAll();
    };

    const searchEl = document.getElementById('rvSearchInput');
    if (searchEl) {
        searchEl.addEventListener('input', function() {
            state.q = this.value.trim().toLowerCase();
            panels.forEach(p => state.pages[p] = 1);
            renderAll();
        });
    }

    renderAll();
});
</script>
@endsection
