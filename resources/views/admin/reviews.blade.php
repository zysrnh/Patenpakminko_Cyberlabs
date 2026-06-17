@extends('layouts.app')

@section('title', 'Moderasi Ulasan Layanan - PATEN PAK MIKO')
@section('page-title', 'Moderasi Ulasan')

@section('extra-styles')
    .stars-yellow {
        color: #D69E2E;
        display: inline-flex;
        align-items: center;
        gap: 2px;
    }
    
    .actions-wrap {
        display: flex;
        gap: 8px;
    }

    .btn-success { background: #E6F4EA; color: #137333; border: 1px solid #B8E2C8; }
    .btn-success:hover { background: #137333; color: #fff; }
    
    .title-icon {
        width: 24px; height: 24px;
        margin-right: 8px;
        vertical-align: -4px;
        display: inline-block;
    }
    .panel-icon {
        width: 18px; height: 18px;
        margin-right: 6px;
        vertical-align: -3px;
        display: inline-block;
        color: var(--blue);
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
            <svg class="title-icon" style="color: #D69E2E;" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
            Moderasi Ulasan Layanan (Admin)
        </h1>
        <p>Tinjau, setujui, dan publikasikan ulasan & testimoni yang diajukan pelaku usaha.</p>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success">
        <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <span>{{ session('success') }}</span>
    </div>
@endif

<div class="panel">
    <div class="panel-head">
        <h2>
            <svg class="panel-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
            Daftar Pengajuan Ulasan
        </h2>
    </div>
    <div class="panel-body" style="padding: 0;">
        <div class="table-wrap">
            @if($reviews->isEmpty())
                <div class="empty-state" style="text-align: center; padding: 40px 20px; color: var(--muted);">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" style="width: 48px; height: 48px; margin-bottom: 12px; color: var(--line);">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                    <p>Belum ada ulasan yang diajukan oleh pelaku usaha.</p>
                </div>
            @else
                <table>
                    <thead>
                        <tr>
                            <th>Pelaku Usaha</th>
                            <th>Layanan / Modul</th>
                            <th>Penilaian</th>
                            <th>Catatan Ulasan</th>
                            <th>Status Publikasi</th>
                            <th>Aksi Admin</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reviews as $review)
                            <tr>
                                <td>
                                    <strong>{{ $review->user->name ?? $review->user->username }}</strong>
                                    <div style="font-size: 11px; color: var(--muted);">Tgl: {{ $review->created_at->format('d M Y, H:i') }}</div>
                                </td>
                                <td>
                                    <span style="font-weight: 700; color: var(--blue);">{{ $review->module_label }}</span>
                                    <div style="font-size: 11px; color: var(--muted);">ID Permohonan: #{{ $review->module_id }}</div>
                                </td>
                                <td>
                                    <div class="stars-yellow">
                                        @for($i=1; $i<=5; $i++)
                                            @if($i <= $review->rating)
                                                <svg width="14" height="14" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
                                            @else
                                                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                                            @endif
                                        @endfor
                                    </div>
                                    <div style="font-size: 11px; font-weight: 700; color: var(--ink);">{{ $review->rating_label }}</div>
                                </td>
                                <td style="max-width: 250px; font-style: italic; color: #4A5568;">
                                    "{{ $review->comment }}"
                                </td>
                                <td>
                                    @if($review->is_approved)
                                        <span class="badge badge-green">Tampil (Approved)</span>
                                    @else
                                        <span class="badge badge-gray">Menunggu Review</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="actions-wrap">
                                        @if(!$review->is_approved)
                                            <form action="{{ route('admin.reviews.approve', $review->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm">
                                                    <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                                    Setujui
                                                </button>
                                            </form>
                                        @endif
                                        <form action="{{ route('admin.reviews.destroy', $review->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus ulasan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>

<!-- Informal Ratings Card -->
<div class="panel">
    <div class="panel-head">
        <h2>
            <svg class="panel-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" /></svg>
            Daftar Ulasan Peta Publik Informal
        </h2>
    </div>
    <div class="panel-body" style="padding: 0;">
        <div class="table-wrap">
            @if($informalRatings->isEmpty())
                <div class="empty-state" style="text-align: center; padding: 40px 20px; color: var(--muted);">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" style="width: 48px; height: 48px; margin-bottom: 12px; color: var(--line);">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                    <p>Belum ada ulasan informal dari publik.</p>
                </div>
            @else
                <table>
                    <thead>
                        <tr>
                            <th>Pengguna / Publik</th>
                            <th>Area Zonasi</th>
                            <th>Penilaian</th>
                            <th>Catatan Ulasan</th>
                            <th>Status Publikasi</th>
                            <th>Aksi Admin</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($informalRatings as $rating)
                            <tr>
                                <td>
                                    <strong>{{ $rating->name ?: 'Anonim' }}</strong>
                                    <div style="font-size: 11px; color: var(--muted);">Tgl: {{ $rating->created_at->format('d M Y, H:i') }}</div>
                                </td>
                                <td>
                                    <span style="font-weight: 700; color: var(--blue);">{{ strtoupper($rating->informal_type) }}</span>
                                    <div style="font-size: 11px; color: var(--muted);">Koord: {{ number_format((float)$rating->latitude, 4) }}, {{ number_format((float)$rating->longitude, 4) }}</div>
                                </td>
                                <td>
                                    <div class="stars-yellow">
                                        @for($i=1; $i<=5; $i++)
                                            @if($i <= $rating->rating)
                                                <svg width="14" height="14" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
                                            @else
                                                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                                            @endif
                                        @endfor
                                    </div>
                                    <div style="font-size: 11px; font-weight: 700; color: var(--ink);">Bintang {{ $rating->rating }}</div>
                                </td>
                                <td style="max-width: 250px; font-style: italic; color: #4A5568;">
                                    "{{ $rating->comment }}"
                                </td>
                                <td>
                                    @if($rating->is_approved)
                                        <span class="badge badge-green">Tampil (Approved)</span>
                                    @else
                                        <span class="badge badge-gray">Menunggu Review</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="actions-wrap">
                                        @if(!$rating->is_approved)
                                            <form action="{{ route('admin.informal-reviews.approve', $rating->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm">
                                                    <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                                    Setujui
                                                </button>
                                            </form>
                                        @endif
                                        <form action="{{ route('admin.informal-reviews.destroy', $rating->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus ulasan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
@endsection
