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
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 20px;
        padding: 20px 0 26px;
    }

    /* Toolbar Filter & Search */
    .reviews-toolbar {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 10px;
        padding: 14px 18px;
        margin-top: 26px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        flex-wrap: wrap;
        scroll-margin-top: 84px;
    }
    .reviews-filters-left {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
        flex: 1;
        min-width: 0;
    }
    .rev-search-wrap {
        position: relative;
        flex: 1 1 210px;
        min-width: 180px;
        max-width: 280px;
    }
    .rev-search-wrap svg {
        position: absolute;
        left: 11px;
        top: 50%;
        transform: translateY(-50%);
        width: 15px;
        height: 15px;
        color: #94A3B8;
        pointer-events: none;
    }
    .rev-input,
    .rev-select {
        height: 38px;
        border: 1px solid #CBD5E1;
        border-radius: 8px;
        background: #FFFFFF;
        color: #0F172A;
        font-family: inherit;
        font-size: 13px;
        font-weight: 500;
        outline: none;
        transition: border-color 0.15s ease, box-shadow 0.15s ease;
    }
    .rev-input {
        width: 100%;
        padding: 0 12px 0 34px;
    }
    .rev-select {
        padding: 0 12px;
        cursor: pointer;
    }
    .rev-input:focus,
    .rev-select:focus {
        border-color: #218AC9;
        box-shadow: 0 0 0 2px #E3F0F9;
    }
    .reviews-meta-right {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 12.5px;
        color: #64748B;
        font-weight: 600;
        white-space: nowrap;
    }
    .rev-reset-btn {
        display: none;
        height: 32px;
        padding: 0 11px;
        border-radius: 6px;
        border: 1px solid #CBD5E1;
        background: #F8FAFC;
        color: #003B64;
        font-family: inherit;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.15s ease, border-color 0.15s ease;
    }
    .rev-reset-btn:hover {
        background: #EBF5FB;
        border-color: #218AC9;
    }

    /* Pagination */
    .reviews-pagination-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
        padding: 8px 0 48px;
    }
    .reviews-page-status {
        font-size: 13px;
        color: #64748B;
        font-weight: 600;
    }
    .reviews-page-buttons {
        display: flex;
        align-items: center;
        gap: 6px;
        flex-wrap: wrap;
    }
    .rev-page-btn {
        min-width: 36px;
        height: 36px;
        padding: 0 12px;
        border-radius: 8px;
        border: 1px solid #CBD5E1;
        background: #FFFFFF;
        color: #003B64;
        font-family: inherit;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: background 0.15s ease, border-color 0.15s ease, color 0.15s ease, transform 0.1s ease;
    }
    .rev-page-btn:hover:not(:disabled) {
        background: #EBF5FB;
        border-color: #218AC9;
    }
    .rev-page-btn:active:not(:disabled) {
        transform: scale(0.97);
    }
    .rev-page-btn.is-active {
        background: #003B64;
        border-color: #003B64;
        color: #FFFFFF;
    }
    .rev-page-btn:disabled {
        opacity: 0.45;
        cursor: not-allowed;
        background: #F8FAFC;
    }

    @media (max-width: 1024px) {
        .reviews-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
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
        .reviews-toolbar {
            margin-top: 18px;
            padding: 14px;
        }
        .reviews-filters-left {
            width: 100%;
        }
        .rev-search-wrap,
        .rev-select {
            width: 100%;
            max-width: none;
            flex: 1 1 100%;
        }
        .reviews-meta-right {
            width: 100%;
            justify-content: space-between;
        }
        .reviews-grid {
            grid-template-columns: 1fr !important;
            gap: 14px;
            padding: 16px 0 24px;
        }
        .review-card {
            padding: 18px;
        }
        .reviews-pagination-bar {
            justify-content: center;
            padding-bottom: 36px;
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

    $preparedReviews = $reviews->map(function ($review) {
        $rawCat = strtoupper((string) ($review->module_label_display ?? ''));
        if (str_contains($rawCat, 'INFORMAL')) {
            $group = 'INFORMAL';
        } elseif (str_contains($rawCat, 'LAPOL')) {
            $group = 'LAPOL PAK';
        } elseif (str_contains($rawCat, 'NON')) {
            $group = 'PKKPR Non-Berusaha';
        } elseif (str_contains($rawCat, 'BERUSAHA')) {
            $group = 'PKKPR Berusaha';
        } elseif (str_contains($rawCat, 'KEBIJAKAN')) {
            $group = 'Kebijakan';
        } elseif (str_contains($rawCat, 'TANAH TIMBUL')) {
            $group = 'Tanah Timbul';
        } elseif (str_contains($rawCat, 'PSN')) {
            $group = 'PSN';
        } else {
            $group = $review->module_label_display ?: 'Layanan Umum';
        }
        $review->service_group = $group;
        return $review;
    });

    $serviceGroups = $preparedReviews->pluck('service_group')->unique()->values();
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
                        <span>{{ $preparedReviews->count() }} Ulasan Terverifikasi</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        @if($preparedReviews->isEmpty())
            <div class="reviews-empty-box">
                Belum ada ulasan yang dipublikasikan saat ini.
            </div>
        @else
            <!-- Filter Toolbar -->
            <div class="reviews-toolbar" id="reviewsToolbar">
                <div class="reviews-filters-left">
                    <div class="rev-search-wrap">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                        <input type="text" id="reviewSearchInput" class="rev-input" placeholder="Cari nama atau komentar...">
                    </div>

                    <select id="reviewCategoryFilter" class="rev-select" aria-label="Filter berdasarkan layanan">
                        <option value="all">Semua Layanan</option>
                        @foreach($serviceGroups as $grp)
                            <option value="{{ $grp }}">{{ $grp }}</option>
                        @endforeach
                    </select>

                    <select id="reviewRatingFilter" class="rev-select" aria-label="Filter berdasarkan rating">
                        <option value="all">Semua Bintang</option>
                        <option value="5">5 Bintang</option>
                        <option value="4">4 Bintang</option>
                        <option value="3-down">3 Bintang ke Bawah</option>
                    </select>

                    <select id="reviewSortFilter" class="rev-select" aria-label="Urutkan ulasan">
                        <option value="latest" selected>Urutkan: Terbaru</option>
                        <option value="highest">Rating Tertinggi</option>
                        <option value="lowest">Rating Terendah</option>
                    </select>
                </div>

                <div class="reviews-meta-right">
                    <span id="reviewsCountInfo">Menampilkan ulasan</span>
                    <button type="button" id="resetReviewFilterBtn" class="rev-reset-btn">Reset Filter</button>
                </div>
            </div>

            <div class="reviews-grid" id="reviewsGrid">
                @foreach($preparedReviews as $review)
                @php
                    $stars = max(1, min(5, (int) ($review->rating ?? 5)));
                    $ts = $review->created_at ? $review->created_at->timestamp : 0;
                    $searchHaystack = strtolower(trim(($review->reviewer_name ?? '') . ' ' . ($review->module_label_display ?? '') . ' ' . ($review->comment ?? '')));
                @endphp
                <div class="review-card"
                     data-category="{{ $review->service_group }}"
                     data-rating="{{ $stars }}"
                     data-ts="{{ $ts }}"
                     data-search="{{ $searchHaystack }}">
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
                        <p class="review-body-text">"{{ $review->comment }}"</p>
                    </div>
                    <div class="review-stars-row" aria-label="{{ $stars }} bintang">
                        @for($i = 1; $i <= 5; $i++)
                            <svg viewBox="0 0 24 24" fill="currentColor" style="color: {{ $i <= $stars ? '#F5A623' : '#CBD5E1' }};"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                        @endfor
                    </div>
                </div>
                @endforeach
            </div>

            <div id="reviewsFilterEmpty" class="reviews-empty-box" style="display: none;">
                <p style="margin-bottom: 14px;">Tidak ada ulasan yang sesuai dengan filter pencarian Anda.</p>
                <button type="button" id="emptyResetReviewBtn" class="rev-page-btn" style="background: #003B64; color: #fff; border-color: #003B64;">Tampilkan Semua Ulasan</button>
            </div>

            <!-- Pagination Bar -->
            <div class="reviews-pagination-bar" id="reviewsPaginationBar">
                <div class="reviews-page-status" id="reviewsPageStatus">Halaman 1 dari 1</div>
                <div class="reviews-page-buttons" id="reviewsPageButtons"></div>
            </div>
        @endif
    </div>
</div>

@if($preparedReviews->isNotEmpty())
<script>
document.addEventListener('DOMContentLoaded', function () {
    const grid = document.getElementById('reviewsGrid');
    const searchInput = document.getElementById('reviewSearchInput');
    const catSelect = document.getElementById('reviewCategoryFilter');
    const ratingSelect = document.getElementById('reviewRatingFilter');
    const sortSelect = document.getElementById('reviewSortFilter');
    const resetBtn = document.getElementById('resetReviewFilterBtn');
    const emptyResetBtn = document.getElementById('emptyResetReviewBtn');
    const countInfo = document.getElementById('reviewsCountInfo');
    const emptyBox = document.getElementById('reviewsFilterEmpty');
    const paginationBar = document.getElementById('reviewsPaginationBar');
    const pageStatus = document.getElementById('reviewsPageStatus');
    const pageButtons = document.getElementById('reviewsPageButtons');
    const toolbar = document.getElementById('reviewsToolbar');

    if (!grid) return;

    const allCards = Array.from(grid.querySelectorAll('.review-card'));
    const perPage = 9;
    let currentPage = 1;

    function getFilteredAndSorted() {
        const q = (searchInput.value || '').trim().toLowerCase();
        const cat = catSelect.value;
        const rating = ratingSelect.value;
        const sort = sortSelect.value;

        const filtered = allCards.filter(function (card) {
            const cCat = card.getAttribute('data-category');
            const cRating = parseInt(card.getAttribute('data-rating') || '5', 10);
            const cSearch = card.getAttribute('data-search') || '';

            if (cat !== 'all' && cCat !== cat) return false;
            if (rating === '5' && cRating !== 5) return false;
            if (rating === '4' && cRating !== 4) return false;
            if (rating === '3-down' && cRating > 3) return false;
            if (q && !cSearch.includes(q)) return false;
            return true;
        });

        filtered.sort(function (a, b) {
            const rA = parseInt(a.getAttribute('data-rating') || '5', 10);
            const rB = parseInt(b.getAttribute('data-rating') || '5', 10);
            const tA = parseInt(a.getAttribute('data-ts') || '0', 10);
            const tB = parseInt(b.getAttribute('data-ts') || '0', 10);

            if (sort === 'highest') {
                return rB !== rA ? rB - rA : tB - tA;
            }
            if (sort === 'lowest') {
                return rA !== rB ? rA - rB : tB - tA;
            }
            return tB - tA;
        });

        return filtered;
    }

    function render(scrollTop) {
        const filtered = getFilteredAndSorted();
        const total = filtered.length;
        const totalPages = Math.max(1, Math.ceil(total / perPage));
        if (currentPage > totalPages) currentPage = totalPages;

        const isDirty = searchInput.value.trim() !== '' || catSelect.value !== 'all' || ratingSelect.value !== 'all' || sortSelect.value !== 'latest';
        resetBtn.style.display = isDirty ? 'inline-flex' : 'none';

        allCards.forEach(function (card) {
            card.style.display = 'none';
        });

        if (total === 0) {
            grid.style.display = 'none';
            emptyBox.style.display = 'block';
            paginationBar.style.display = 'none';
            countInfo.textContent = '0 ulasan ditemukan';
            return;
        }

        grid.style.display = 'grid';
        emptyBox.style.display = 'none';

        const startIdx = (currentPage - 1) * perPage;
        const endIdx = Math.min(startIdx + perPage, total);

        filtered.forEach(function (card) {
            grid.appendChild(card);
        });
        for (let i = startIdx; i < endIdx; i++) {
            filtered[i].style.display = 'flex';
        }

        countInfo.textContent = 'Menampilkan ' + (startIdx + 1) + '–' + endIdx + ' dari ' + total + ' ulasan';

        if (totalPages <= 1) {
            paginationBar.style.display = 'none';
        } else {
            paginationBar.style.display = 'flex';
            pageStatus.textContent = 'Halaman ' + currentPage + ' dari ' + totalPages;
            pageButtons.innerHTML = '';

            const prevBtn = document.createElement('button');
            prevBtn.type = 'button';
            prevBtn.className = 'rev-page-btn';
            prevBtn.textContent = '← Sebelumnya';
            prevBtn.disabled = currentPage === 1;
            prevBtn.addEventListener('click', function () {
                if (currentPage > 1) {
                    currentPage--;
                    render(true);
                }
            });
            pageButtons.appendChild(prevBtn);

            for (let p = 1; p <= totalPages; p++) {
                const pBtn = document.createElement('button');
                pBtn.type = 'button';
                pBtn.className = 'rev-page-btn' + (p === currentPage ? ' is-active' : '');
                pBtn.textContent = String(p);
                pBtn.addEventListener('click', function () {
                    if (currentPage !== p) {
                        currentPage = p;
                        render(true);
                    }
                });
                pageButtons.appendChild(pBtn);
            }

            const nextBtn = document.createElement('button');
            nextBtn.type = 'button';
            nextBtn.className = 'rev-page-btn';
            nextBtn.textContent = 'Berikutnya →';
            nextBtn.disabled = currentPage === totalPages;
            nextBtn.addEventListener('click', function () {
                if (currentPage < totalPages) {
                    currentPage++;
                    render(true);
                }
            });
            pageButtons.appendChild(nextBtn);
        }

        if (scrollTop && toolbar) {
            toolbar.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    }

    function resetFilters() {
        searchInput.value = '';
        catSelect.value = 'all';
        ratingSelect.value = 'all';
        sortSelect.value = 'latest';
        currentPage = 1;
        render(false);
    }

    searchInput.addEventListener('input', function () {
        currentPage = 1;
        render(false);
    });
    catSelect.addEventListener('change', function () {
        currentPage = 1;
        render(false);
    });
    ratingSelect.addEventListener('change', function () {
        currentPage = 1;
        render(false);
    });
    sortSelect.addEventListener('change', function () {
        currentPage = 1;
        render(false);
    });
    resetBtn.addEventListener('click', resetFilters);
    if (emptyResetBtn) emptyResetBtn.addEventListener('click', resetFilters);

    render(false);
});
</script>
@endif
@endsection