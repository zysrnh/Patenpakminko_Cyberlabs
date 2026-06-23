@extends('layouts.public')

@section('content')
<style>
    .page-header {
        background: #00223D;
        padding: 80px 0 60px;
        text-align: center;
        color: #fff;
    }
    .page-header h1 {
        font-size: 36px;
        margin-bottom: 16px;
    }
    .page-header p {
        font-size: 16px;
        opacity: 0.8;
    }
    .reviews-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 24px;
        padding: 60px 0;
    }
    .review-card {
        background: #fff;
        border: 1px solid rgba(0,0,0,0.05);
        border-radius: 12px;
        padding: 24px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.02);
    }
</style>

<div class="page-header">
    <div class="container">
        <h1>Testimoni Pengguna</h1>
        <p>Lihat pengalaman dan ulasan dari pengguna yang telah merasakan kemudahan layanan digital PATEN PAK MIKO.</p>
    </div>
</div>

<div class="container">
    @if($reviews->isEmpty())
        <div style="text-align: center; padding: 100px 0;">
            <p style="color: #718096;">Belum ada ulasan yang dipublikasikan saat ini.</p>
        </div>
    @else
        <div class="reviews-grid">
            @foreach($reviews as $review)
            <div class="review-card">
                <div class="review-header" style="display:flex; justify-content:space-between; margin-bottom:16px;">
                    <div class="review-author" style="display:flex; flex-direction:column;">
                        <h4 style="margin:0; font-size:16px; color:#1a202c;">{{ $review->reviewer_name }}</h4>
                        <span style="font-size:12px; color:#718096;">Sukabumi</span>
                    </div>
                    <div class="review-check" style="background:#EBF8FF; color:#3182CE; width:24px; height:24px; border-radius:50%; display:flex; align-items:center; justify-content:center;">
                        <svg viewBox="0 0 24 24" style="width:14px;height:14px;" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>
                    </div>
                </div>
                <p class="review-text" style="font-size:14px; line-height:1.6; color:#4a5568; margin-bottom:16px;">"{{ $review->comment }}"</p>
                <div class="review-foot-stars" aria-label="5 bintang" style="display:flex; gap:4px; color:#ECC94B;">
                    @for($i = 0; $i < 5; $i++)
                    <svg viewBox="0 0 24 24" style="width:16px;height:16px;" fill="currentColor"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                    @endfor
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
