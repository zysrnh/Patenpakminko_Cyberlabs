@extends('layouts.app')

@section('title', 'Ulasan Layanan — PATEN PAK MIKO')
@section('page-title', 'Ulasan Layanan')

@section('extra-styles')
    .layout-grid { display: grid; grid-template-columns: 1fr 1.3fr; gap: 20px; align-items: start; }
    .review-item { border: 1px solid #E2E8F0; border-radius: 4px; padding: 14px 16px; margin-bottom: 12px; transition: border-color .18s; background: #ffffff; }
    .review-item:last-child { margin-bottom: 0; }
    .review-item:hover { border-color: #218AC9; }
    .review-header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 8px; }
    .review-stars { color: #D97706; font-size: 14px; margin-bottom: 6px; }
    .review-comment { font-size: 13px; font-style: italic; color: #334155; line-height: 1.5; }
    .review-date { font-size: 11px; color: #64748B; margin-top: 6px; display: block; }
    .reviews-scroll { max-height: 480px; overflow-y: auto; padding-right: 4px; }
    @media (max-width: 768px) {
        .layout-grid { grid-template-columns: 1fr; }
    }
@endsection

@section('content')
<!-- Header Card -->
<div style="background: #ffffff; border: 1px solid #E2E8F0; border-radius: 6px; padding: 18px 24px; margin-bottom: 20px; box-shadow: 0 2px 6px rgba(0,38,66,0.02); display: flex; align-items: center; justify-content: space-between; gap: 16px; flex-wrap: wrap;">
    <div>
        <div style="font-size: 12px; color: #64748B; margin-bottom: 4px; display: flex; align-items: center; gap: 6px;">
            <a href="{{ route('dashboard') }}" style="color: #218AC9; text-decoration: none; font-weight: 600;">Dashboard</a>
            <span>›</span>
            <span style="color: #64748B;">Ulasan Layanan</span>
        </div>
        <h1 style="font-size: 19px; font-weight: 800; color: #003B64; letter-spacing: -0.02em; margin: 0;">
            Ulasan Layanan & Feedback
        </h1>
        <p style="font-size: 12.5px; color: #64748B; margin: 4px 0 0;">Berikan penilaian & saran Anda mengenai kualitas pelayanan tata ruang kami.</p>
    </div>
</div>

@if($errors->any())
    <div class="alert alert-error" style="border-radius: 4px; margin-bottom: 20px;">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
        <div>@foreach($errors->all() as $error)<p>{{ $error }}</p>@endforeach</div>
    </div>
@endif

<div class="layout-grid">

    {{-- Kiri: Form Ulasan --}}
    <div class="panel" style="border-radius: 6px; border: 1px solid #E2E8F0; box-shadow: 0 2px 6px rgba(0,38,66,0.02); overflow: hidden; background: #ffffff;">
        <div class="panel-head" style="padding: 14px 18px; border-bottom: 1px solid #E2E8F0; background: #F8FAFC;">
            <h2 style="font-size: 15px; font-weight: 800; color: #003B64; margin: 0; display:flex;align-items:center;gap:8px;">
                <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="#218AC9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                Tulis Ulasan Baru
            </h2>
        </div>
        <div class="panel-body" style="padding: 20px;">
            <form action="{{ route('review.store') }}" method="POST">
                @csrf
                <div class="form-group" style="margin-bottom: 16px;">
                    <label class="form-label" for="module_type" style="font-size: 12.5px; font-weight: 700; color: #003B64; margin-bottom: 6px; display: block;">Layanan Yang Diulas</label>
                    <select name="module_type" id="module_type" class="form-control" required style="border-radius: 4px; border: 1px solid #CBD5E1;">
                        <option value="umum">Layanan Umum / Portal PATEN PAK MIKO</option>
                        <option value="lapolpa">LAPOL PAK (Layanan Pelaporan)</option>
                        <option value="berusaha">Pertimbangan Teknis Pertanahan PKKPR Berusaha</option>
                        <option value="non_berusaha">Pertimbangan Teknis Pertanahan Non Berusaha</option>
                        <option value="kebijakan">Kebijakan</option>
                    </select>
                </div>

                <div class="form-group" id="module_id_container" style="display:none; margin-bottom: 16px;">
                    <label class="form-label" for="module_id" style="font-size: 12.5px; font-weight: 700; color: #003B64; margin-bottom: 6px; display: block;">ID / Nomor Permohonan</label>
                    <input type="number" name="module_id" id="module_id" class="form-control" placeholder="Contoh: 1" value="0" style="border-radius: 4px; border: 1px solid #CBD5E1;">
                    <div class="form-hint" style="font-size: 11.5px; color: #64748B; margin-top: 4px;">Masukkan ID permohonan atau booking Anda (opsional).</div>
                </div>

                <style>
                    .star-rating-form { display: flex; flex-direction: row-reverse; justify-content: flex-end; gap: 4px; }
                    .star-rating-form input { display: none; }
                    .star-rating-form label { font-size: 32px; color: #CBD5E0; cursor: pointer; transition: color 0.2s; line-height: 1; margin: 0; padding: 0; }
                    .star-rating-form input:checked ~ label, .star-rating-form label:hover, .star-rating-form label:hover ~ label { color: #D97706; }
                </style>
                <div class="form-group" style="margin-bottom: 16px;">
                    <label class="form-label" style="font-size: 12.5px; font-weight: 700; color: #003B64; margin-bottom: 6px; display: block;">Penilaian (Bintang)</label>
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

                <div class="form-group" style="margin-bottom: 20px;">
                    <label class="form-label" for="comment" style="font-size: 12.5px; font-weight: 700; color: #003B64; margin-bottom: 6px; display: block;">Catatan / Feedback</label>
                    <textarea name="comment" id="comment" class="form-control" rows="4" placeholder="Tuliskan ulasan, kritik, atau saran Anda..." required style="border-radius: 4px; border: 1px solid #CBD5E1;"></textarea>
                </div>

                <button type="submit" class="btn btn-primary btn-full" style="border-radius: 4px; font-weight: 700; padding: 10px 20px;">
                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 2L11 13M22 2l-7 20-4-9-9-4 20-7z"/></svg>
                    Kirim Ulasan Layanan
                </button>
            </form>
        </div>
    </div>

    {{-- Kanan: Daftar Ulasan Publik --}}
    <div class="panel" style="border-radius: 6px; border: 1px solid #E2E8F0; box-shadow: 0 2px 6px rgba(0,38,66,0.02); overflow: hidden; background: #ffffff;">
        <div class="panel-head" style="padding: 14px 18px; border-bottom: 1px solid #E2E8F0; background: #F8FAFC;">
            <h2 style="font-size: 15px; font-weight: 800; color: #003B64; margin: 0; display:flex;align-items:center;gap:8px;">
                <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="#218AC9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
                Ulasan Dari Pengguna Lain
            </h2>
        </div>
        <div class="panel-body" style="padding: 16px;">
            <div class="reviews-scroll">
                @forelse($approvedReviews ?? [] as $rev)
                    <div class="review-item">
                        <div class="review-header">
                            <div>
                                <strong style="font-size: 13px; color: #003B64;">{{ $rev->user->name ?? $rev->user->username }}</strong>
                                <span class="badge" style="background-color: #E3F0F9; color: #218AC9; border-radius: 4px; padding: 2px 6px; font-size: 10.5px; font-weight: 700; margin-left: 6px;">{{ $rev->module_label }}</span>
                            </div>
                            <div class="review-stars">
                                {{ str_repeat('★', $rev->rating) }}{{ str_repeat('☆', 5 - $rev->rating) }}
                            </div>
                        </div>
                        <p class="review-comment">"{{ $rev->comment }}"</p>
                        <span class="review-date">{{ $rev->created_at->format('d M Y, H:i') }}</span>
                    </div>
                @empty
                    <div class="empty-state" style="padding: 30px 16px; text-align: center;">
                        <svg width="36" height="36" fill="none" viewBox="0 0 24 24" stroke="#94A3B8" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M8 10h.01M12 10h.01M16 10h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                        <p style="font-size: 12.5px; color: #64748B; margin-top: 8px;">Belum ada ulasan publik yang disetujui.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const moduleSelect = document.getElementById('module_type');
        const idContainer = document.getElementById('module_id_container');

        if(moduleSelect && idContainer) {
            moduleSelect.addEventListener('change', function() {
                if(this.value === 'umum') {
                    idContainer.style.display = 'none';
                } else {
                    idContainer.style.display = 'block';
                }
            });
        }
    });
</script>
@endsection
