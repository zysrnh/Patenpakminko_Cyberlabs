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
        gap: 8px;
    }

    .btn-approve {
        background: #ECFDF5;
        color: #047857;
        border: 1px solid #A7F3D0;
        padding: 6px 14px;
        border-radius: 6px;
        font-weight: 600;
        font-size: 12px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.2s ease;
        cursor: pointer;
    }
    .btn-approve:hover {
        background: #10B981;
        color: #ffffff;
        border-color: #10B981;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.25);
    }

    .btn-delete {
        background: #FEF2F2;
        color: #B91C1C;
        border: 1px solid #FECACA;
        padding: 6px 14px;
        border-radius: 6px;
        font-weight: 600;
        font-size: 12px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.2s ease;
        cursor: pointer;
    }
    .btn-delete:hover {
        background: #EF4444;
        color: #ffffff;
        border-color: #EF4444;
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.25);
    }
    
    .title-icon {
        width: 26px; height: 26px;
        margin-right: 10px;
        vertical-align: -5px;
        display: inline-block;
    }
    .panel-icon {
        width: 20px; height: 20px;
        margin-right: 8px;
        vertical-align: -4px;
        display: inline-block;
        color: #1D4ED8;
    }

    /* Stat Cards Grid */
    .stat-cards-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 16px;
        margin-bottom: 24px;
    }

    .stat-card-mini {
        background: #ffffff;
        border: 1px solid #E2E8F0;
        border-radius: 10px;
        padding: 16px 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        box-shadow: 0 2px 4px rgba(0,0,0,0.02);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .stat-card-mini:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(0,0,0,0.06);
    }
    .stat-card-info h3 {
        font-size: 22px;
        font-weight: 800;
        color: #0F172A;
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
        width: 44px;
        height: 44px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* User Avatar Initial */
    .user-avatar-badge {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: linear-gradient(135deg, #2563EB, #1D4ED8);
        color: #ffffff;
        font-weight: 700;
        font-size: 13px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .user-flex {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .badge-approved {
        background: #ECFDF5;
        color: #047857;
        border: 1px solid #A7F3D0;
        padding: 4px 10px;
        border-radius: 20px;
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
        padding: 4px 10px;
        border-radius: 20px;
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
        border-radius: 6px;
        font-size: 11px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }
@endsection

@section('content')
<div class="page-header">
    <div class="page-header-left">
        <div class="breadcrumb">
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <span>›</span>
            <span>Moderasi Ulasan (Admin)</span>
        </div>
        <h1>
            <svg class="title-icon" style="color: #F59E0B;" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
            Moderasi Ulasan Layanan
        </h1>
        <p>Tinjau, setujui, dan kelola ulasan & testimoni pengguna layanan PATEN PAK MIKO.</p>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success" style="margin-bottom: 20px;">
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
        <div class="stat-card-icon" style="background: #EFF6FF; color: #2563EB;">
            <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 10h.01M12 10h.01M16 10h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
        </div>
    </div>
    <div class="stat-card-mini">
        <div class="stat-card-info">
            <h3>{{ number_format($approvedReviewsCount) }}</h3>
            <p>Tampil (Approved)</p>
        </div>
        <div class="stat-card-icon" style="background: #ECFDF5; color: #10B981;">
            <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
    </div>
    <div class="stat-card-mini">
        <div class="stat-card-info">
            <h3>{{ number_format($pendingReviewsCount) }}</h3>
            <p>Menunggu Moderasi</p>
        </div>
        <div class="stat-card-icon" style="background: #FEF3C7; color: #F59E0B;">
            <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
    </div>
</div>

<!-- Filter Bar Card -->
<div class="panel" style="margin-bottom: 24px; border-radius: 12px; box-shadow: 0 2px 6px rgba(0,0,0,0.03);">
    <div class="panel-body" style="padding: 16px 20px;">
        <form method="GET" action="{{ route('admin.reviews.index') }}" style="display: flex; align-items: center; justify-content: space-between; gap: 16px; flex-wrap: wrap;">
            <div style="display: flex; align-items: center; gap: 12px; flex-wrap: wrap;">
                <label style="font-weight: 700; font-size: 13px; color: #1E293B; margin: 0; display: flex; align-items: center; gap: 8px;">
                    <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2" style="color: #2563EB;"><path stroke-linecap="round" stroke-linejoin="round" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
                    Filter Layanan:
                </label>
                <select name="layanan" onchange="this.form.submit()" style="padding: 9px 14px; border-radius: 8px; border: 1px solid #CBD5E0; font-size: 13px; font-weight: 600; color: #1E293B; background: #F8FAFC; min-width: 260px; outline: none; cursor: pointer;">
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
                <a href="{{ route('admin.reviews.index') }}" class="btn btn-secondary btn-sm" style="border-radius: 6px; padding: 7px 14px; text-decoration: none; font-weight: 600;">Reset Filter</a>
            @endif
        </form>
    </div>
</div>

<!-- Formal Reviews Card -->
<div class="panel" style="margin-bottom: 28px; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.03);">
    <div class="panel-head" style="background: #ffffff; padding: 18px 24px; border-bottom: 1px solid #F1F5F9;">
        <h2 style="font-size: 15px; font-weight: 800; color: #0F172A; margin: 0; display: flex; align-items: center;">
            <svg class="panel-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
            Daftar Ulasan Layanan Formal
        </h2>
    </div>
    <div class="panel-body" style="padding: 0;">
        <div class="table-wrap">
            @if($reviews->isEmpty())
                <div class="empty-state" style="text-align: center; padding: 48px 20px; color: #94A3B8;">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" style="width: 48px; height: 48px; margin-bottom: 12px; color: #CBD5E0;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                    <p style="font-weight: 600; font-size: 14px;">Tidak ada ulasan layanan formal yang sesuai dengan filter.</p>
                </div>
            @else
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background: #F8FAFC; border-bottom: 1px solid #E2E8F0; font-size: 12px; color: #475569; text-transform: uppercase;">
                            <th style="padding: 14px 20px; text-align: left;">Pelaku Usaha</th>
                            <th style="padding: 14px 20px; text-align: left;">Layanan / Modul</th>
                            <th style="padding: 14px 20px; text-align: left;">Penilaian</th>
                            <th style="padding: 14px 20px; text-align: left;">Catatan Ulasan</th>
                            <th style="padding: 14px 20px; text-align: center;">Status Publikasi</th>
                            @if(Auth::user()->isDpn())
                                <th style="padding: 14px 20px; text-align: center;">Aksi Admin</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reviews as $review)
                            @php
                                $userName = $review->user->name ?? $review->user->username ?? 'Pelaku Usaha';
                                $initial = strtoupper(substr($userName, 0, 2));
                            @endphp
                            <tr style="border-bottom: 1px solid #F1F5F9; transition: background 0.15s ease;">
                                <td style="padding: 16px 20px;">
                                    <div class="user-flex">
                                        <div class="user-avatar-badge">{{ $initial }}</div>
                                        <div>
                                            <strong style="font-size: 13.5px; color: #0F172A; display: block;">{{ $userName }}</strong>
                                            <div style="font-size: 11.5px; color: #64748B; margin-top: 2px;">Tgl: {{ $review->created_at->format('d M Y, H:i') }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td style="padding: 16px 20px;">
                                    <span style="font-weight: 700; font-size: 13px; color: #1D4ED8;">{{ $review->module_label }}</span>
                                    <div style="font-size: 11.5px; color: #64748B; margin-top: 2px;">ID Permohonan: #{{ $review->module_id }}</div>
                                </td>
                                <td style="padding: 16px 20px;">
                                    <div class="stars-yellow">
                                        @for($i=1; $i<=5; $i++)
                                            @if($i <= $review->rating)
                                                <svg width="15" height="15" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
                                            @else
                                                <svg width="15" height="15" fill="none" stroke="#CBD5E0" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                                            @endif
                                        @endfor
                                    </div>
                                    <div style="font-size: 11.5px; font-weight: 700; color: #1E293B; margin-top: 2px;">{{ $review->rating_label }}</div>
                                </td>
                                <td style="padding: 16px 20px; max-width: 280px; font-style: italic; color: #334155; font-size: 12.5px; line-height: 1.5;">
                                    "{{ $review->comment }}"
                                </td>
                                <td style="padding: 16px 20px; text-align: center;">
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
                                <td style="padding: 16px 20px; text-align: center;">
                                    <div class="actions-wrap" style="justify-content: center;">
                                        @if(!$review->is_approved)
                                            <form action="{{ route('admin.reviews.approve', $review->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn-approve">
                                                    <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                                    Setujui
                                                </button>
                                            </form>
                                        @endif
                                        <form action="{{ route('admin.reviews.destroy', $review->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus ulasan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-delete">
                                                <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
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
<div class="panel" style="border-radius: 12px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.03);">
    <div class="panel-head" style="background: #ffffff; padding: 18px 24px; border-bottom: 1px solid #F1F5F9;">
        <h2 style="font-size: 15px; font-weight: 800; color: #0F172A; margin: 0; display: flex; align-items: center;">
            <svg class="panel-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" /></svg>
            Daftar Ulasan INFORMAL (Peta Digital & Zonasi)
        </h2>
    </div>
    <div class="panel-body" style="padding: 0;">
        <div class="table-wrap">
            @if($informalRatings->isEmpty())
                <div class="empty-state" style="text-align: center; padding: 48px 20px; color: #94A3B8;">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" style="width: 48px; height: 48px; margin-bottom: 12px; color: #CBD5E0;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                    <p style="font-weight: 600; font-size: 14px;">Belum ada ulasan informal dari publik.</p>
                </div>
            @else
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background: #F8FAFC; border-bottom: 1px solid #E2E8F0; font-size: 12px; color: #475569; text-transform: uppercase;">
                            <th style="padding: 14px 20px; text-align: left;">Pengguna / Publik</th>
                            <th style="padding: 14px 20px; text-align: left;">Area Zonasi & Koordinat</th>
                            <th style="padding: 14px 20px; text-align: left;">Penilaian</th>
                            <th style="padding: 14px 20px; text-align: left;">Catatan Ulasan</th>
                            <th style="padding: 14px 20px; text-align: center;">Status Publikasi</th>
                            @if(Auth::user()->isDpn())
                                <th style="padding: 14px 20px; text-align: center;">Aksi Admin</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($informalRatings as $rating)
                            @php
                                $publicName = $rating->name ?: ($rating->user->name ?? 'Anonim');
                                $publicInitial = strtoupper(substr($publicName, 0, 2));
                            @endphp
                            <tr style="border-bottom: 1px solid #F1F5F9; transition: background 0.15s ease;">
                                <td style="padding: 16px 20px;">
                                    <div class="user-flex">
                                        <div class="user-avatar-badge" style="background: linear-gradient(135deg, #0EA5E9, #0284C7);">{{ $publicInitial }}</div>
                                        <div>
                                            <strong style="font-size: 13.5px; color: #0F172A; display: block;">{{ $publicName }}</strong>
                                            <div style="font-size: 11.5px; color: #64748B; margin-top: 2px;">Tgl: {{ $rating->created_at->format('d M Y, H:i') }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td style="padding: 16px 20px;">
                                    <span style="font-weight: 800; font-size: 12px; color: #2563EB; text-transform: uppercase;">{{ $rating->informal_type }}</span>
                                    @if(!empty($rating->latitude) && (float)$rating->latitude != 0)
                                        <div style="margin-top: 4px;">
                                            <span class="coord-badge">
                                                📍 {{ number_format((float)$rating->latitude, 5) }}, {{ number_format((float)$rating->longitude, 5) }}
                                            </span>
                                        </div>
                                    @else
                                        <div style="font-size: 11.5px; color: #94A3B8; font-style: italic; margin-top: 2px;">Ulasan Umum (Tanpa Koordinat)</div>
                                    @endif
                                </td>
                                <td style="padding: 16px 20px;">
                                    <div class="stars-yellow">
                                        @for($i=1; $i<=5; $i++)
                                            @if($i <= $rating->rating)
                                                <svg width="15" height="15" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
                                            @else
                                                <svg width="15" height="15" fill="none" stroke="#CBD5E0" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                                            @endif
                                        @endfor
                                    </div>
                                    <div style="font-size: 11.5px; font-weight: 700; color: #1E293B; margin-top: 2px;">Bintang {{ $rating->rating }}</div>
                                </td>
                                <td style="padding: 16px 20px; max-width: 280px; font-style: italic; color: #334155; font-size: 12.5px; line-height: 1.5;">
                                    "{{ $rating->comment }}"
                                </td>
                                <td style="padding: 16px 20px; text-align: center;">
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
                                <td style="padding: 16px 20px; text-align: center;">
                                    <div class="actions-wrap" style="justify-content: center;">
                                        @if(!$rating->is_approved)
                                            <form action="{{ route('admin.informal-reviews.approve', $rating->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn-approve">
                                                    <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                                    Setujui
                                                </button>
                                            </form>
                                        @endif
                                        <form action="{{ route('admin.informal-reviews.destroy', $rating->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus ulasan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-delete">
                                                <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
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
@endsection
