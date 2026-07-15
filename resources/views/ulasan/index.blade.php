@extends('layouts.app')

@section('title', 'Ulasan Layanan — PATEN PAK MIKO')
@section('page-title', 'Ulasan Layanan')

@section('extra-styles')
    .layout-grid { display: grid; grid-template-columns: 1fr 1.3fr; gap: 20px; align-items: start; }
    .review-item { border: 1px solid var(--line); border-radius: var(--r-md); padding: 14px 16px; margin-bottom: 12px; transition: border-color .18s; }
    .review-item:last-child { margin-bottom: 0; }
    .review-item:hover { border-color: var(--blue); }
    .review-header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 8px; }
    .review-stars { color: #D69E2E; font-size: 14px; margin-bottom: 6px; }
    .review-comment { font-size: 13px; font-style: italic; color: var(--mid); line-height: 1.5; }
    .review-date { font-size: 11px; color: var(--muted); margin-top: 6px; display: block; }
    .reviews-scroll { max-height: 480px; overflow-y: auto; padding-right: 4px; }
    @media (max-width: 768px) {
        .layout-grid { grid-template-columns: 1fr; }
    }
@endsection

@section('content')
<div class="page-header">
    <div class="page-header-left">
        <div class="breadcrumb">
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <span>›</span>
            <span>Ulasan Layanan</span>
        </div>
        <h1>Ulasan Layanan & Feedback</h1>
        <p>Berikan penilaian & saran Anda mengenai kualitas pelayanan tata ruang kami.</p>
    </div>
</div>

@if($errors->any())
    <div class="alert alert-error">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
        <div>@foreach($errors->all() as $error)<p>{{ $error }}</p>@endforeach</div>
    </div>
@endif

<div class="layout-grid">

    {{-- Kiri: Form Ulasan --}}
    <div class="panel">
        <div class="panel-head">
            <h2 style="display:flex;align-items:center;gap:8px;">
                <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                Tulis Ulasan Baru
            </h2>
        </div>
        <div class="panel-body">
            <form action="{{ route('review.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label class="form-label" for="module_type">Layanan Yang Diulas</label>
                    <select name="module_type" id="module_type" class="form-control" required>
                        <option value="umum">Layanan Umum / Portal PATEN PAK MIKO</option>
                        <option value="lapolpa">LAPOL PAK (Layanan Pelaporan)</option>
                        <option value="berusaha">Pertimbangan Teknis Pertanahan PKKPR Berusaha</option>
                        <option value="non_berusaha">Pertimbangan Teknis Pertanahan Non Berusaha</option>
                        <option value="kebijakan">Kebijakan</option>
                    </select>
                </div>

                <div class="form-group" id="module_id_container" style="display:none;">
                    <label class="form-label" for="module_id">ID / Nomor Permohonan</label>
                    <input type="number" name="module_id" id="module_id" class="form-control" placeholder="Contoh: 1" value="0">
                    <div class="form-hint">Masukkan ID permohonan atau booking Anda (opsional).</div>
                </div>

                <style>
                    .star-rating-form { display: flex; flex-direction: row-reverse; justify-content: flex-end; gap: 4px; }
                    .star-rating-form input { display: none; }
                    .star-rating-form label { font-size: 32px; color: #CBD5E0; cursor: pointer; transition: color 0.2s; line-height: 1; margin: 0; padding: 0; }
                    .star-rating-form input:checked ~ label, .star-rating-form label:hover, .star-rating-form label:hover ~ label { color: #D69E2E; }
                </style>
                <div class="form-group">
                    <label class="form-label">Penilaian (Bintang)</label>
                    <div class="star-rating-form">
                        <input type="radio" id="star5" name="rating" value="5" required />
                        <label for="star5" title="Sangat Baik">★</label>
                        <input type="radio" id="star4" name="rating" value="4" />
                        <label for="star4" title="Baik">★</label>
                        <input type="radio" id="star3" name="rating" value="3" />
                        <label for="star3" title="Cukup Baik">★</label>
                        <input type="radio" id="star2" name="rating" value="2" />
                        <label for="star2" title="Kurang">★</label>
                        <input type="radio" id="star1" name="rating" value="1" />
                        <label for="star1" title="Sangat Kurang">★</label>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="comment">Catatan / Feedback</label>
                    <textarea name="comment" id="comment" class="form-control" rows="4" placeholder="Tuliskan ulasan, kritik, atau saran Anda..." required></textarea>
                </div>

                <button type="submit" class="btn btn-primary btn-full">
                    <svg viewBox="0 0 24 24"><path d="M22 2L11 13M22 2l-7 20-4-9-9-4 20-7z"/></svg>
                    Kirim Ulasan Layanan
                </button>
            </form>
        </div>
    </div>

    {{-- Kanan: Riwayat Ulasan --}}
    <div class="panel">
        <div class="panel-head">
            <h2 style="display:flex;align-items:center;gap:8px;">
                <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                Riwayat Ulasan Anda
            </h2>
        </div>
        <div class="panel-body">
            <div class="reviews-scroll">
                @if($myReviews->isEmpty())
                    <div class="empty-state" style="padding:32px 16px;">
                        <svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                        <h3>Belum Ada Ulasan</h3>
                        <p>Anda belum pernah mengirimkan ulasan layanan.</p>
                    </div>
                @else
                    @foreach($myReviews as $rev)
                        <div class="review-item">
                            <div class="review-header">
                                <div>
                                    <span class="badge badge-blue">{{ $rev->module_label }}</span>
                                    @if($rev->module_id > 0)
                                        <div style="font-size:11px;color:var(--muted);margin-top:3px;">ID: #{{ $rev->module_id }}</div>
                                    @endif
                                </div>
                                @if($rev->is_approved)
                                    <span class="badge badge-green">Disetujui</span>
                                @else
                                    <span class="badge badge-gray">Moderasi</span>
                                @endif
                            </div>
                            <div class="review-stars">
                                {{ str_repeat('★', $rev->rating) }}{{ str_repeat('☆', 5-$rev->rating) }}
                                <span style="font-size:12px;font-weight:700;color:var(--ink);margin-left:4px;">({{ $rev->rating_label }})</span>
                            </div>
                            <p class="review-comment">"{{ $rev->comment }}"</p>
                            <span class="review-date">Dikirim: {{ $rev->created_at->format('d M Y, H:i') }}</span>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

</div>
@endsection

@section('scripts')
<script>
    const moduleTypeSelect = document.getElementById('module_type');
    const moduleIdContainer = document.getElementById('module_id_container');
    const moduleIdInput = document.getElementById('module_id');

    moduleTypeSelect.addEventListener('change', function() {
        if (this.value === 'umum') {
            moduleIdContainer.style.display = 'none';
            moduleIdInput.value = '0';
        } else {
            moduleIdContainer.style.display = 'block';
            if (moduleIdInput.value === '0') moduleIdInput.value = '';
        }
    });
</script>
@endsection
