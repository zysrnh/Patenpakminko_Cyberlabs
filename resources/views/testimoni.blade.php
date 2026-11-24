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
        padding: 44px 0;
        color: #FFFFFF;
        border-bottom: 1px solid #002D4D;
    }
    .page-header-inner {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 24px;
        flex-wrap: wrap;
    }
    .page-header-copy {
        max-width: 660px;
    }
    .page-header-badge {
        display: inline-block;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        color: #FFCB05;
        margin-bottom: 8px;
    }
    .page-header h1 {
        font-size: clamp(26px, 3vw, 34px);
        font-weight: 800;
        letter-spacing: -0.02em;
        margin: 0 0 8px;
        color: #FFFFFF;
        line-height: 1.2;
    }
    .page-header p {
        font-size: 14.5px;
        color: #DCEBF7;
        margin: 0;
        line-height: 1.55;
    }
    .reviews-summary-box {
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.18);
        border-radius: 8px;
        padding: 14px 20px;
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
        font-size: 12px;
        color: #B8D4E8;
    }

    .reviews-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 22px;
        padding: 38px 0 56px;
    }
    .review-card {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 10px;
        padding: 22px 24px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        gap: 14px;
        transition: border-color 0.18s ease, transform 0.18s ease;
        animation: testimoniFadeUp 0.28s cubic-bezier(0.22, 1, 0.36, 1) both;
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
        margin: 0 0 3px;
        font-size: 15px;
        font-weight: 700;
        color: #003B64;
        overflow-wrap: break-word;
    }
    .review-author span {
        font-size: 12px;
        color: #64748B;
        font-weight: 500;
    }
    .review-verified {
        background: #EBF5FB;
        color: #218AC9;
        width: 26px;
        height: 26px;
        min-width: 26px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .review-verified svg {
        width: 14px;
        height: 14px;
    }
    .review-body-text {
        font-size: 13.5px;
        line-height: 1.65;
        color: #334155;
        margin: 12px 0 0;
        flex: 1;
    }
    .review-stars-row {
        display: flex;
        align-items: center;
        gap: 4px;
        padding-top: 4px;
    }
    .review-stars-row svg {
        width: 16px;
        height: 16px;
    }
    .reviews-empty-box {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 10px;
        text-align: center;
        padding: 56px 24px;
        margin: 40px 0;
        color: #64748B;
        font-size: 14px;
    }

    /* ═══ MOBILE RESPONSIVE FIXES ═══ */
    @media (max-width: 768px) {
        .page-header {
            padding: 28px 0;
        }
        .reviews-summary-box {
            width: 100%;
            justify-content: flex-start;
        }
        .reviews-grid {
            grid-template-columns: 1fr !important;
            gap: 14px;
            padding: 24px 0 40px;
        }
        .review-card {
            padding: 18px;
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