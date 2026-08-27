@extends('layouts.app')

@section('title', 'Moderasi Ulasan Layanan - PATEN PAK MIKO')
@section('page-title', 'Moderasi Ulasan')

@section('extra-styles')
    .stars-yellow {
        color: #F59E0B;
        display: inline-flex;
        align-items: center;
        gap: 3px;
    }
    
    .actions-wrap {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .btn-approve {
        background: #DCFCE7;
        color: #15803D;
        border: 1px solid #86EFAC;
        padding: 5px 10px;
        border-radius: 4px;
        font-weight: 700;
        font-size: 12px;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        transition: all 0.18s ease;
        cursor: pointer;
    }
    .btn-approve:hover {
        background: #16A34A;
        color: #ffffff;
        border-color: #16A34A;
    }

    .btn-delete {
        background: #DC2626;
        color: #FFFFFF;
        border: 1px solid #DC2626;
        padding: 5px 10px;
        border-radius: 4px;
        font-weight: 700;
        font-size: 12px;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        transition: all 0.18s ease;
        cursor: pointer;
    }
    .btn-delete:hover {
        background: #B91C1C;
        border-color: #B91C1C;
    }

    .btn-edit {
        background: #FEF3C7;
        color: #D97706;
        border: 1px solid #FCD34D;
        padding: 5px 10px;
        border-radius: 4px;
        font-weight: 700;
        font-size: 12px;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        transition: all 0.18s ease;
        cursor: pointer;
    }
    .btn-edit:hover {
        background: #F59E0B;
        color: #ffffff;
        border-color: #F59E0B;
    }

    /* Stat Cards Grid */
    .stat-cards-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 16px;
        margin-bottom: 20px;
    }

    .stat-card-mini {
        background: #ffffff;
        border: 1px solid #E2E8F0;
        border-radius: 6px;
        padding: 16px 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        box-shadow: 0 2px 6px rgba(0,38,66,0.02);
    }
    .stat-card-info h3 {
        font-size: 22px;
        font-weight: 800;
        color: #003B64;
        margin: 0;
        line-height: 1.2;
    }
    .stat-card-info p {
        font-size: 12px;
        font-weight: 600;
        color: #64748B;
        margin: 4px 0 0 0;
    }
    .stat-card-icon {
        width: 40px;
        height: 40px;
        border-radius: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* User Avatar Initial */
    .user-avatar-badge {
        width: 34px;
        height: 34px;
        border-radius: 4px;
        background: #218AC9;
        color: #ffffff;
        font-weight: 700;
        font-size: 12.5px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .user-flex {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .badge-approved {
        background: #DCFCE7;
        color: #15803D;
        border: 1px solid #86EFAC;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 11px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    .badge-pending {
        background: #FEF3C7;
        color: #B45309;
        border: 1px solid #FDE68A;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 11px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    .coord-badge {
        background: #EFF6FF;
        color: #1E40AF;
        border: 1px solid #BFDBFE;
        padding: 3px 8px;
        border-radius: 4px;
        font-size: 11px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    /* ─── MOBILE RESPONSIVE ────────────────────────────── */
    @media (max-width: 768px) {
        .stat-cards-grid {
            display: flex;
            overflow-x: auto;
            scroll-snap-type: x mandatory;
            -webkit-overflow-scrolling: touch;
            padding-bottom: 8px;
            gap: 12px;
            margin-bottom: 16px;
        }
        .stat-card-mini {
            flex: 0 0 76%;
            scroll-snap-align: start;
        }
        .table-wrap {
            overflow-x: auto !important;
            -webkit-overflow-scrolling: touch !important;
            width: 100% !important;
        }
        .table-wrap table {
            min-width: 820px !important;
        }
        .review-filter-form {
            flex-direction: column !important;
            align-items: stretch !important;
            gap: 12px !important;
        }
        .review-filter-form > div {
            flex-direction: column !important;
            align-items: stretch !important;
            width: 100% !important;
        }
        .review-filter-form select {
            width: 100% !important;
            min-width: 0 !important;
        }
    }
@endsection

@section('content')
<!-- Header Card -->
<div style="background: #ffffff; border: 1px solid #E2E8F0; border-radius: 6px; padding: 18px 24px; margin-bottom: 20px; box-shadow: 0 2px 6px rgba(0,38,66,0.02); display: flex; align-items: center; justify-content: space-between; gap: 16px; flex-wrap: wrap;">
    <div>
        <div style="font-size: 12px; color: #64748B; margin-bottom: 4px; display: flex; align-items: center; gap: 6px;">
            <a href="{{ route('dashboard') }}" style="color: #218AC9; text-decoration: none; font-weight: 600;">Dashboard</a>
            <span>›</span>
            <span style="color: #64748B;">Moderasi Ulasan (Admin)</span>
        </div>
        <h1 style="font-size: 19px; font-weight: 800; color: #003B64; letter-spacing: -0.02em; margin: 0;">
            Moderasi Ulasan Layanan
        </h1>
        <p style="font-size: 12.5px; color: #64748B; margin: 4px 0 0;">Tinjau, setujui, dan kelola ulasan & testimoni pengguna layanan PATEN PAK MIKO.</p>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success" style="border-radius: 4px; margin-bottom: 20px;">
        <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <span>{{ session('success') }}</span>
    </div>
@endif

@php
    $totalReviewsCount = $reviews->count() + $informalRatings->count();
    $approvedReviewsCount = $reviews->where('is_approved', true)->count() + $informalRatings->where('is_approved', true)->count();
    $pendingReviewsCount = $totalReviewsCount - $approvedReviewsCount;
@endphp

<!-- Stat Cards Grid -->
<div class="stat-cards-grid">
    <div class="stat-card-mini">
        <div class="stat-card-info">
            <h3>{{ number_format($totalReviewsCount) }}</h3>
            <p>Total Ulasan Masuk</p>
        </div>
        <div class="stat-card-icon" style="background: #EFF6FF; color: #218AC9;">
            <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 10h.01M12 10h.01M16 10h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
        </div>
    </div>
    <div class="stat-card-mini">
        <div class="stat-card-info">
            <h3>{{ number_format($approvedReviewsCount) }}</h3>
            <p>Tampil (Approved)</p>
        </div>
        <div class="stat-card-icon" style="background: #DCFCE7; color: #16A34A;">
            <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
    </div>
    <div class="stat-card-mini">
        <div class="stat-card-info">
            <h3>{{ number_format($pendingReviewsCount) }}</h3>
            <p>Menunggu Moderasi</p>
        </div>
        <div class="stat-card-icon" style="background: #FEF3C7; color: #D97706;">
            <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
    </div>
</div>

<!-- Filter Bar Card -->
<div class="panel" style="margin-bottom: 20px; border-radius: 6px; border: 1px solid #E2E8F0; box-shadow: 0 2px 6px rgba(0,38,66,0.02); background: #ffffff;">
    <div class="panel-body" style="padding: 14px 18px;">
        <form method="GET" action="{{ route('admin.reviews.index') }}" class="review-filter-form" style="display: flex; align-items: center; justify-content: space-between; gap: 16px; flex-wrap: wrap;">
            <div style="display: flex; align-items: center; gap: 12px; flex-wrap: wrap;">
                <label style="font-weight: 700; font-size: 13px; color: #003B64; margin: 0; display: flex; align-items: center; gap: 8px;">
                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2" style="color: #218AC9;"><path stroke-linecap="round" stroke-linejoin="round" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
                    Filter Layanan:
                </label>
                <select name="layanan" onchange="this.form.submit()" style="padding: 8px 12px; border-radius: 4px; border: 1.5px solid #CBD5E1; font-size: 13px; font-weight: 600; color: #0F172A; background: #ffffff; min-width: 260px; outline: none; cursor: pointer;">
                    <option value="">-- Semua Layanan (Formal & Informal) --</option>
                    <option value="berusaha" {{ request('layanan') == 'berusaha' ? 'selected' : '' }}>PKKPR Berusaha</option>
                    <option value="non_berusaha" {{ request('layanan') == 'non_berusaha' ? 'selected' : '' }}>PKKPR Non-Berusaha</option>
                    <option value="kebijakan" {{ request('layanan') == 'kebijakan' ? 'selected' : '' }}>Pertimbangan Teknis Kebijakan</option>
                    <option value="lapolpa" {{ request('layanan') == 'lapolpa' ? 'selected' : '' }}>LAPOL PAK</option>
                    <option value="tanah_timbul" {{ request('layanan') == 'tanah_timbul' ? 'selected' : '' }}>Tanah Timbul</option>
                    <option value="psn" {{ request('layanan') == 'psn' ? 'selected' : '' }}>PSN (Proyek Strategis Nasional)</option>
                    <option value="umum" {{ request('layanan') == 'umum' ? 'selected' : '' }}>Ulasan Umum</option>
                    <option value="informal" {{ request('layanan') == 'informal' ? 'selected' : '' }}>INFORMAL (Peta Digital / Rating Zonasi)</option>
                </select>
            </div>
            @if(request('layanan'))
                <a href="{{ route('admin.reviews.index') }}" class="btn btn-secondary btn-sm" style="border-radius: 4px; padding: 6px 12px; text-decoration: none; font-weight: 700; font-size: 12px;">Reset Filter</a>
            @endif
        </form>
    </div>
</div>

<!-- Formal Reviews Card -->
<div class="panel" style="margin-bottom: 24px; border-radius: 6px; border: 1px solid #E2E8F0; box-shadow: 0 2px 6px rgba(0,38,66,0.02); overflow: hidden; background: #ffffff;">
    <div class="panel-head" style="padding: 14px 18px; border-bottom: 1px solid #E2E8F0; background: #F8FAFC;">
        <h2 style="font-size: 15px; font-weight: 800; color: #003B64; margin: 0; display: flex; align-items: center; gap: 8px;">
            <svg width="17" height="17" fill="none" viewBox="0 0 24 24" stroke="#218AC9" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
            Daftar Ulasan Layanan Formal
        </h2>
    </div>
    <div class="panel-body" style="padding: 0;">
        <div class="table-wrap">
            @if($reviews->isEmpty())
                <div class="empty-state" style="text-align: center; padding: 40px 20px; color: #64748B;">
                    <svg fill="none" viewBox="0 0 24 24" stroke="#94A3B8" stroke-width="1.5" style="width: 40px; height: 40px; margin-bottom: 10px;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                    <p style="font-weight: 600; font-size: 13px;">Tidak ada ulasan layanan formal yang sesuai dengan filter.</p>
                </div>
            @else
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background: #F8FAFC; border-bottom: 1.5px solid #E2E8F0; font-size: 11px; color: #475569; text-transform: uppercase; font-weight: 800; letter-spacing: 0.05em;">
                            <th style="padding: 10px 14px; text-align: left;">Pelaku Usaha</th>
                            <th style="padding: 10px 14px; text-align: left;">Layanan / Modul</th>
                            <th style="padding: 10px 14px; text-align: left;">Penilaian</th>
                            <th style="padding: 10px 14px; text-align: left;">Catatan Ulasan</th>
                            <th style="padding: 10px 14px; text-align: center;">Status Publikasi</th>
                            @if(Auth::user()->isDpn())
                                <th style="padding: 10px 14px; text-align: center; width: 140px;">Aksi Admin</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reviews as $review)
                            @php
                                $userName = null;
                                if ($review->module_type === 'berusaha' && $review->module_id) {
                                    $appItem = \App\Models\PpkprBerusahaApplication::find($review->module_id);
                                    if ($appItem) {
                                        $userName = $appItem->nama_pengaju ?: $appItem->nama_pemilik_usaha;
                                    }
                                } elseif ($review->module_type === 'non_berusaha' && $review->module_id) {
                                    $appItem = \App\Models\PpkprApplication::find($review->module_id);
                                    if ($appItem) {
                                        $userName = $appItem->nama_pengaju ?: $appItem->nama_pemilik_usaha;
                                    }
                                } elseif ($review->module_type === 'kebijakan' && $review->module_id) {
                                    $appItem = \App\Models\KebijakanApplication::find($review->module_id);
                                    if ($appItem) {
                                        $userName = $appItem->nama_pengaju ?: $appItem->nama_pemilik_usaha;
                                    }
                                }
                                if (!$userName || strtolower($userName) === 'petugas bpn') {
                                    $userName = ($review->user && strtolower($review->user->name) !== 'petugas bpn') ? $review->user->name : ($review->user->username ?? 'Pelaku Usaha');
                                }
                                $initial = strtoupper(substr($userName, 0, 2));
                            @endphp
                            <tr style="border-bottom: 1px solid #F1F5F9;">
                                <td style="padding: 12px 14px;">
                                    <div class="user-flex">
                                        <div class="user-avatar-badge">{{ $initial }}</div>
                                        <div>
                                            <strong style="font-size: 13px; color: #003B64; display: block;">{{ $userName }}</strong>
                                            <div style="font-size: 11px; color: #64748B; margin-top: 2px;">Tgl: {{ $review->created_at->format('d M Y, H:i') }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td style="padding: 12px 14px;">
                                    <span style="font-weight: 700; font-size: 12.5px; color: #218AC9;">{{ $review->module_label }}</span>
                                    <div style="font-size: 11px; color: #64748B; margin-top: 2px;">ID Permohonan: #{{ $review->module_id }}</div>
                                </td>
                                <td style="padding: 12px 14px;">
                                    <div class="stars-yellow">
                                        @for($i=1; $i<=5; $i++)
                                            @if($i <= $review->rating)
                                                <svg width="14" height="14" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
                                            @else
                                                <svg width="14" height="14" fill="none" stroke="#CBD5E1" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                                            @endif
                                        @endfor
                                    </div>
                                    <div style="font-size: 11px; font-weight: 700; color: #003B64; margin-top: 2px;">{{ $review->rating_label }}</div>
                                </td>
                                <td style="padding: 12px 14px; max-width: 280px; font-style: italic; color: #334155; font-size: 12.5px; line-height: 1.4;">
                                    "{{ $review->comment }}"
                                </td>
                                <td style="padding: 12px 14px; text-align: center;">
                                    @if($review->is_approved)
                                        <span class="badge-approved">
                                            <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                            Tampil (Approved)
                                        </span>
                                    @else
                                        <span class="badge-pending">
                                            <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                            Menunggu Review
                                        </span>
                                    @endif
                                </td>
                                @if(Auth::user()->isDpn())
                                <td style="padding: 12px 14px; text-align: center; white-space: nowrap;">
                                    <div class="actions-wrap" style="justify-content: center;">
                                        @if(!$review->is_approved)
                                            <form action="{{ route('admin.reviews.approve', $review->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                <button type="submit" class="btn-approve">
                                                    <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                                    Setujui
                                                </button>
                                            </form>
                                        @endif
                                        <button type="button" class="btn-edit btn-trigger-edit-formal"
                                             data-id="{{ $review->id }}"
                                             data-name="{{ e($userName) }}"
                                             data-rating="{{ $review->rating }}"
                                             data-comment="{{ e($review->comment) }}"
                                             data-approved="{{ $review->is_approved ? '1' : '0' }}">
                                             <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                             Edit
                                        </button>
                                        <form action="{{ route('admin.reviews.destroy', $review->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus ulasan ini?')" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-delete">
                                                <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                Hapus
                                            </button>
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
    </div>
</div>

<!-- Informal Ratings Card -->
<div class="panel" style="border-radius: 6px; border: 1px solid #E2E8F0; box-shadow: 0 2px 6px rgba(0,38,66,0.02); overflow: hidden; background: #ffffff;">
    <div class="panel-head" style="padding: 14px 18px; border-bottom: 1px solid #E2E8F0; background: #F8FAFC;">
        <h2 style="font-size: 15px; font-weight: 800; color: #003B64; margin: 0; display: flex; align-items: center; gap: 8px;">
            <svg width="17" height="17" fill="none" viewBox="0 0 24 24" stroke="#218AC9" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" /></svg>
            Daftar Ulasan INFORMAL (Peta Digital & Zonasi)
        </h2>
    </div>
    <div class="panel-body" style="padding: 0;">
        <div class="table-wrap">
            @if($informalRatings->isEmpty())
                <div class="empty-state" style="text-align: center; padding: 40px 20px; color: #64748B;">
                    <svg fill="none" viewBox="0 0 24 24" stroke="#94A3B8" stroke-width="1.5" style="width: 40px; height: 40px; margin-bottom: 10px;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                    <p style="font-weight: 600; font-size: 13px;">Belum ada ulasan informal dari publik.</p>
                </div>
            @else
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background: #F8FAFC; border-bottom: 1.5px solid #E2E8F0; font-size: 11px; color: #475569; text-transform: uppercase; font-weight: 800; letter-spacing: 0.05em;">
                            <th style="padding: 10px 14px; text-align: left;">Pengguna / Publik</th>
                            <th style="padding: 10px 14px; text-align: left;">Area Zonasi & Koordinat</th>
                            <th style="padding: 10px 14px; text-align: left;">Penilaian</th>
                            <th style="padding: 10px 14px; text-align: left;">Catatan Ulasan</th>
                            <th style="padding: 10px 14px; text-align: center;">Status Publikasi</th>
                            @if(Auth::user()->isDpn())
                                <th style="padding: 10px 14px; text-align: center; width: 140px;">Aksi Admin</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($informalRatings as $rating)
                            @php
                                $publicName = $rating->name ?: ($rating->user->name ?? 'Anonim');
                                $publicInitial = strtoupper(substr($publicName, 0, 2));
                            @endphp
                            <tr style="border-bottom: 1px solid #F1F5F9;">
                                <td style="padding: 12px 14px;">
                                    <div class="user-flex">
                                        <div class="user-avatar-badge" style="background: #0284C7;">{{ $publicInitial }}</div>
                                        <div>
                                            <strong style="font-size: 13px; color: #003B64; display: block;">{{ $publicName }}</strong>
                                            <div style="font-size: 11px; color: #64748B; margin-top: 2px;">Tgl: {{ $rating->created_at->format('d M Y, H:i') }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td style="padding: 12px 14px;">
                                    <span style="font-weight: 800; font-size: 12px; color: #218AC9; text-transform: uppercase;">{{ $rating->informal_type }}</span>
                                    @if(!empty($rating->latitude) && (float)$rating->latitude != 0)
                                        <div style="margin-top: 4px;">
                                            <span class="coord-badge">
                                                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                                {{ number_format((float)$rating->latitude, 5) }}, {{ number_format((float)$rating->longitude, 5) }}
                                            </span>
                                        </div>
                                    @else
                                        <div style="font-size: 11px; color: #64748B; font-style: italic; margin-top: 2px;">Ulasan Umum (Tanpa Koordinat)</div>
                                    @endif
                                </td>
                                <td style="padding: 12px 14px;">
                                    <div class="stars-yellow">
                                        @for($i=1; $i<=5; $i++)
                                            @if($i <= $rating->rating)
                                                <svg width="14" height="14" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
                                            @else
                                                <svg width="14" height="14" fill="none" stroke="#CBD5E1" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                                            @endif
                                        @endfor
                                    </div>
                                    <div style="font-size: 11px; font-weight: 700; color: #003B64; margin-top: 2px;">Bintang {{ $rating->rating }}</div>
                                </td>
                                <td style="padding: 12px 14px; max-width: 280px; font-style: italic; color: #334155; font-size: 12.5px; line-height: 1.4;">
                                    "{{ $rating->comment }}"
                                </td>
                                <td style="padding: 12px 14px; text-align: center;">
                                    @if($rating->is_approved)
                                        <span class="badge-approved">
                                            <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                            Tampil (Approved)
                                        </span>
                                    @else
                                        <span class="badge-pending">
                                            <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                            Menunggu Review
                                        </span>
                                    @endif
                                </td>
                                @if(Auth::user()->isDpn())
                                <td style="padding: 12px 14px; text-align: center; white-space: nowrap;">
                                    <div class="actions-wrap" style="justify-content: center;">
                                        @if(!$rating->is_approved)
                                            <form action="{{ route('admin.informal-reviews.approve', $rating->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                <button type="submit" class="btn-approve">
                                                    <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                                    Setujui
                                                </button>
                                            </form>
                                        @endif
                                        <form action="{{ route('admin.informal-reviews.destroy', $rating->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus ulasan ini?')" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-delete">
                                                <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                Hapus
                                            </button>
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
    </div>
</div>

<!-- Modal Edit Ulasan Formal -->
<div id="editReviewModal" style="display: none; position: fixed; inset: 0; background: rgba(15, 23, 42, 0.6); z-index: 9999; align-items: center; justify-content: center; backdrop-filter: blur(3px);">
    <div style="background: #ffffff; border-radius: 8px; width: 100%; max-width: 520px; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1), 0 10px 10px -5px rgba(0,0,0,0.04); overflow: hidden; margin: 16px;">
        <div style="background: #003B64; color: #ffffff; padding: 16px 20px; display: flex; align-items: center; justify-content: space-between;">
            <h3 style="font-size: 15px; font-weight: 800; margin: 0; color: #ffffff;">Edit Ulasan Layanan</h3>
            <button type="button" onclick="closeEditReviewModal()" style="background: none; border: none; color: #ffffff; font-size: 20px; cursor: pointer; line-height: 1;">&times;</button>
        </div>
        <form id="editReviewForm" method="POST" action="" style="padding: 20px;">
            @csrf
            @method('PUT')
            <div style="margin-bottom: 14px;">
                <label style="font-size: 12px; font-weight: 700; color: #475569; display: block; margin-bottom: 4px;">Nama Pemohon / Pelaku Usaha:</label>
                <input type="text" id="edit_reviewer_name" readonly class="form-control" style="background: #F8FAFC; border: 1px solid #CBD5E1; border-radius: 4px; padding: 8px 12px; font-size: 13px; color: #334155; width: 100%;">
            </div>
            <div style="margin-bottom: 14px;">
                <label style="font-size: 12px; font-weight: 700; color: #475569; display: block; margin-bottom: 4px;">Penilaian Bintang (1-5):</label>
                <select name="rating" id="edit_review_rating" class="form-control" required style="border: 1px solid #CBD5E1; border-radius: 4px; padding: 8px 12px; font-size: 13px; width: 100%;">
                    <option value="5">⭐⭐⭐⭐⭐ 5 Bintang (Sangat Memuaskan)</option>
                    <option value="4">⭐⭐⭐⭐ 4 Bintang (Memuaskan)</option>
                    <option value="3">⭐⭐⭐ 3 Bintang (Cukup)</option>
                    <option value="2">⭐⭐ 2 Bintang (Kurang)</option>
                    <option value="1">⭐ 1 Bintang (Sangat Kurang)</option>
                </select>
            </div>
            <div style="margin-bottom: 14px;">
                <label style="font-size: 12px; font-weight: 700; color: #475569; display: block; margin-bottom: 4px;">Teks Catatan Ulasan / Testimoni:</label>
                <textarea name="comment" id="edit_review_comment" rows="4" required style="border: 1px solid #CBD5E1; border-radius: 4px; padding: 10px 12px; font-size: 13px; width: 100%; resize: vertical;" placeholder="Tulis ulasan..."></textarea>
            </div>
            <div style="margin-bottom: 20px;">
                <label style="font-size: 12px; font-weight: 700; color: #475569; display: block; margin-bottom: 6px;">Status Publikasi:</label>
                <select name="is_approved" id="edit_review_is_approved" class="form-control" style="border: 1px solid #CBD5E1; border-radius: 4px; padding: 8px 12px; font-size: 13px; width: 100%;">
                    <option value="1">✅ Tampil di Halaman Utama (Approved)</option>
                    <option value="0">⏳ Menunggu Moderasi / Sembunyikan</option>
                </select>
            </div>
            <div style="display: flex; justify-content: flex-end; gap: 10px; border-top: 1px solid #E2E8F0; padding-top: 14px;">
                <button type="button" onclick="closeEditReviewModal()" class="btn btn-secondary" style="border-radius: 4px; padding: 8px 16px; font-size: 13px; font-weight: 700;">Batal</button>
                <button type="submit" class="btn btn-primary" style="background: #218AC9; border-color: #218AC9; border-radius: 4px; padding: 8px 18px; font-size: 13px; font-weight: 700; color: #ffffff;">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit Ulasan Informal -->
<div id="editInformalModal" style="display: none; position: fixed; inset: 0; background: rgba(15, 23, 42, 0.6); z-index: 9999; align-items: center; justify-content: center; backdrop-filter: blur(3px);">
    <div style="background: #ffffff; border-radius: 8px; width: 100%; max-width: 520px; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1), 0 10px 10px -5px rgba(0,0,0,0.04); overflow: hidden; margin: 16px;">
        <div style="background: #003B64; color: #ffffff; padding: 16px 20px; display: flex; align-items: center; justify-content: space-between;">
            <h3 style="font-size: 15px; font-weight: 800; margin: 0; color: #ffffff;">Edit Ulasan Peta Informal</h3>
            <button type="button" onclick="closeEditInformalModal()" style="background: none; border: none; color: #ffffff; font-size: 20px; cursor: pointer; line-height: 1;">&times;</button>
        </div>
        <form id="editInformalForm" method="POST" action="" style="padding: 20px;">
            @csrf
            @method('PUT')
            <div style="margin-bottom: 14px;">
                <label style="font-size: 12px; font-weight: 700; color: #475569; display: block; margin-bottom: 4px;">Nama Pengguna / Publik:</label>
                <input type="text" name="name" id="edit_informal_name" class="form-control" style="border: 1px solid #CBD5E1; border-radius: 4px; padding: 8px 12px; font-size: 13px; width: 100%;">
            </div>
            <div style="margin-bottom: 14px;">
                <label style="font-size: 12px; font-weight: 700; color: #475569; display: block; margin-bottom: 4px;">Penilaian Bintang (1-5):</label>
                <select name="rating" id="edit_informal_rating" class="form-control" required style="border: 1px solid #CBD5E1; border-radius: 4px; padding: 8px 12px; font-size: 13px; width: 100%;">
                    <option value="5">⭐⭐⭐⭐⭐ 5 Bintang (Sangat Memuaskan)</option>
                    <option value="4">⭐⭐⭐⭐ 4 Bintang (Memuaskan)</option>
                    <option value="3">⭐⭐⭐ 3 Bintang (Cukup)</option>
                    <option value="2">⭐⭐ 2 Bintang (Kurang)</option>
                    <option value="1">⭐ 1 Bintang (Sangat Kurang)</option>
                </select>
            </div>
            <div style="margin-bottom: 14px;">
                <label style="font-size: 12px; font-weight: 700; color: #475569; display: block; margin-bottom: 4px;">Teks Catatan Ulasan / Testimoni:</label>
                <textarea name="comment" id="edit_informal_comment" rows="4" required style="border: 1px solid #CBD5E1; border-radius: 4px; padding: 10px 12px; font-size: 13px; width: 100%; resize: vertical;" placeholder="Tulis ulasan..."></textarea>
            </div>
            <div style="margin-bottom: 20px;">
                <label style="font-size: 12px; font-weight: 700; color: #475569; display: block; margin-bottom: 6px;">Status Publikasi:</label>
                <select name="is_approved" id="edit_informal_is_approved" class="form-control" style="border: 1px solid #CBD5E1; border-radius: 4px; padding: 8px 12px; font-size: 13px; width: 100%;">
                    <option value="1">✅ Tampil di Halaman Utama (Approved)</option>
                    <option value="0">⏳ Menunggu Moderasi / Sembunyikan</option>
                </select>
            </div>
            <div style="display: flex; justify-content: flex-end; gap: 10px; border-top: 1px solid #E2E8F0; padding-top: 14px;">
                <button type="button" onclick="closeEditReviewModal()" class="btn btn-secondary" style="border-radius: 4px; padding: 8px 16px; font-size: 13px; font-weight: 700;">Batal</button>
                <button type="submit" class="btn btn-primary" style="background: #218AC9; border-color: #218AC9; border-radius: 4px; padding: 8px 18px; font-size: 13px; font-weight: 700; color: #ffffff;">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('click', function(e) {
    var btn = e.target.closest('.btn-trigger-edit-formal');
    if (btn) {
        var id = btn.getAttribute('data-id');
        var name = btn.getAttribute('data-name');
        var rating = btn.getAttribute('data-rating');
        var comment = btn.getAttribute('data-comment');
        var approved = btn.getAttribute('data-approved');

        document.getElementById('editReviewForm').action = '/admin/reviews/' + id;
        document.getElementById('edit_reviewer_name').value = name;
        document.getElementById('edit_review_rating').value = rating;
        document.getElementById('edit_review_comment').value = comment;
        document.getElementById('edit_review_is_approved').value = approved;
        document.getElementById('editReviewModal').style.display = 'flex';
    }

    var btnInf = e.target.closest('.btn-trigger-edit-informal');
    if (btnInf) {
        var idInf = btnInf.getAttribute('data-id');
        var nameInf = btnInf.getAttribute('data-name');
        var ratingInf = btnInf.getAttribute('data-rating');
        var commentInf = btnInf.getAttribute('data-comment');
        var approvedInf = btnInf.getAttribute('data-approved');

        document.getElementById('editInformalForm').action = '/admin/informal-reviews/' + idInf;
        document.getElementById('edit_informal_name').value = nameInf;
        document.getElementById('edit_informal_rating').value = ratingInf;
        document.getElementById('edit_informal_comment').value = commentInf;
        document.getElementById('edit_informal_is_approved').value = approvedInf;
        document.getElementById('editInformalModal').style.display = 'flex';
    }
});

function closeEditReviewModal() {
    document.getElementById('editReviewModal').style.display = 'none';
}
function closeEditInformalModal() {
    document.getElementById('editInformalModal').style.display = 'none';
}
</script>
@endsection
