@extends('layouts.public')

@section('title', 'Ulasan Pengguna — PATEN PAK MIKO Kantor Pertanahan Kota Sukabumi')

@section('content')
<style>
    @keyframes testimoniFadeUp {
        from { opacity: 0; transform: translateY(8px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    .reviews-page-wrap {
        background: #F4F7FA;
        flex: 1;
        display: flex;
        flex-direction: column;
    }
    .page-header {
        background: #003B64;
        padding: clamp(22px, 3.4vh, 38px) 0;
        color: #FFFFFF;
        border-bottom: 1px solid #002D4D;
    }
    .page-header-inner {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        flex-wrap: wrap;
    }
    .page-header-copy {
        max-width: 640px;
    }
    .page-header-badge {
        display: inline-block;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        color: #FFCB05;
        margin-bottom: 6px;
    }
    .page-header h1 {
        font-size: clamp(24px, 2.8vw, 32px);
        font-weight: 800;
        letter-spacing: -0.02em;
        margin: 0 0 6px;
        color: #FFFFFF;
        line-height: 1.2;
    }
    .page-header p {
        font-size: clamp(13px, 1.45vh, 14.5px);
        color: #DCEBF7;
        margin: 0;
        line-height: 1.5;
    }
    .reviews-summary-box {
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 4px;
        padding: 12px 18px;
        display: flex;
        align-items: center;
        gap: 14px;
        flex-shrink: 0;
    }
    .reviews-summary-score {
        font-size: 28px;
        font-weight: 800;
        color: #FFCB05;
        line-height: 1;
        font-variant-numeric: tabular-nums;
    }
    .reviews-summary-meta strong {
        display: block;
        font-size: 13px;
        font-weight: 700;
        color: #FFFFFF;
    }
    .reviews-summary-meta span {
        font-size: 11.5px;
        color: #B8D4E8;
    }

    .reviews-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: clamp(12px, 1.4vw, 18px);
        padding: clamp(20px, 2.8vh, 36px) 0 clamp(28px, 4vh, 48px);
    }
    .review-card {
        background: #FFFFFF;
        border: 1px solid #D6E4EF;
        border-radius: 4px;
        padding: clamp(16px, 2vh, 22px);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        gap: 12px;
        transition: border-color 0.16s ease, transform 0.16s ease;
        animation: testimoniFadeUp 0.26s cubic-bezier(0.22, 1, 0.36, 1) both;
    }
    .review-card:hover {
        border-color: #94B8D4;
        transform: translateY(-2px);
    }
    .review-card-top {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 12px;
    }
    .review-author {
        display: flex;
        flex-direction: column;
        min-width: 0;
    }
    .review-author h4 {
        margin: 0 0 2px;
        font-size: 14.5px;
        font-weight: 700;
        color: #003B64;
        overflow-wrap: break-word;
    }
    .review-author span {
        font-size: 11.5px;
        color: #64748B;
        font-weight: 500;
    }
    .review-verified {
        background: #E3F0F9;
        color: #218AC9;
        width: 24px;
        height: 24px;
        min-width: 24px;
        border-radius: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .review-verified svg {
        width: 14px;
        height: 14px;
    }
    .review-body-text {
        font-size: 13px;
        line-height: 1.55;
        color: #334155;
        margin: 0;
        flex: 1;
    }
    .review-stars-row {
        display: flex;
        align-items: center;
        gap: 3px;
        padding-top: 10px;
        border-top: 1px solid #E8F0F6;
    }
    .review-stars-row svg {
        width: 15px;
        height: 15px;
    }
    .reviews-empty-box {
        background: #FFFFFF;
        border: 1px solid #D6E4EF;
        border-radius: 4px;
        text-align: center;
        padding: 48px 20px;
        margin: 32px 0;
        color: #64748B;
        font-size: 14px;
    }

    /* ═══ MOBILE RESPONSIVE FIXES ═══ */
    @media (max-width: 768px) {
        .page-header {
            padding: 24px 0;
        }
        .reviews-summary-box {
            width: 100%;
            justify-content: flex-start;
        }
        .reviews-grid {
            grid-template-columns: 1fr !important;
            gap: 12px;
            padding: 20px 0 32px;
        }
        .review-card {
            padding: 16px;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .review-card {
            animation: none !important;
        }
        .review-card:hover {
            transform: none !important;
        }
    }
</style>

@php
    $avgScore = $reviews->isNotEmpty() ? number_format($reviews->avg('rating') ?: 5, 1) : '5.0';
@endphp

<div class="reviews-page-wrap">
    <div class="page-header">
        <div class="container">
            <div class="page-header-inner">
                <div class="page-header-copy">
                    <div class="page-header-badge">Testimoni Masyarakat</div>
                    <h1>Ulasan Pengguna Layanan</h1>
                    <p>Pengalaman langsung masyarakat dan pemohon terhadap pelayanan digital PATEN PAK MIKO.</p>
                </div>
                <div class="reviews-summary-box">
                    <div class="reviews-summary-score">{{ $avgScore }}</div>
                    <div class="reviews-summary-meta">
                        <strong>Indeks Kepuasan</strong>
                        <span>{{ $reviews->count() }} Ulasan Terverifikasi</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        @if($reviews->isEmpty())
            <div class="reviews-empty-box">
                Belum ada ulasan yang dipublikasikan saat ini.
            </div>
        @else
            <div class="reviews-grid">
                @foreach($reviews as $review)
                @php
                    $stars = max(1, min(5, (int) ($review->rating ?? 5)));
                @endphp
                <div class="review-card">
                    <div>
                        <div class="review-card-top">
                            <div class="review-author">
                                <h4>{{ $review->reviewer_name }}</h4>
                                <span>Sukabumi &bull; {{ $review->module_label_display }}</span>
                            </div>
                            <div class="review-verified" title="Ulasan Terverifikasi">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>
                            </div>
                        </div>
                        <p class="review-body-text" style="margin-top: 10px;">"{{ $review->comment }}"</p>
                    </div>
                    <div class="review-stars-row" aria-label="{{ $stars }} bintang">
                        @for($i = 1; $i <= 5; $i++)
                            <svg viewBox="0 0 24 24" fill="currentColor" style="color: {{ $i <= $stars ? '#F5A623' : '#CBD5E1' }};"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                        @endfor
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection