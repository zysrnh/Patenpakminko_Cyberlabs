@extends('layouts.public')

@section('title', 'Ulasan Layanan LAPOL PAK — PATEN PAK MIKO')

@section('content')
<style>
    .review-wrapper {
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 20px;
        background-color: var(--surface);
    }
    .review-card {
        background: var(--white);
        border-radius: var(--r-xl);
        box-shadow: 0 10px 25px rgba(0,0,0,0.05);
        max-width: 500px;
        width: 100%;
        padding: 40px;
        text-align: center;
    }
    .review-icon {
        width: 64px;
        height: 64px;
        background: var(--blue-lt);
        color: var(--blue);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
    }
    .review-title {
        font-size: 24px;
        font-weight: 800;
        color: var(--ink);
        margin-bottom: 8px;
    }
    .review-desc {
        font-size: 14px;
        color: var(--muted);
        margin-bottom: 30px;
    }
    
    /* Star Rating */
    .star-rating {
        display: flex;
        flex-direction: row-reverse;
        justify-content: center;
        gap: 8px;
        margin-bottom: 24px;
    }
    .star-rating input {
        display: none;
    }
    .star-rating label {
        cursor: pointer;
        color: #E2E8F0;
        transition: color 0.2s;
    }
    .star-rating label svg {
        width: 40px;
        height: 40px;
        fill: currentColor;
    }
    .star-rating input:checked ~ label,
    .star-rating label:hover,
    .star-rating label:hover ~ label {
        color: var(--yellow);
    }

    .form-group {
        text-align: left;
        margin-bottom: 24px;
    }
    .form-label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: var(--ink);
        margin-bottom: 8px;
    }
    .form-control {
        width: 100%;
        padding: 12px;
        border: 1.5px solid var(--line);
        border-radius: var(--r-md);
        font-family: inherit;
        font-size: 14px;
        resize: vertical;
        min-height: 100px;
        outline: none;
        transition: border-color 0.2s;
    }
    .form-control:focus {
        border-color: var(--blue);
    }
    .btn-submit {
        background: var(--blue);
        color: #fff;
        border: none;
        padding: 14px 24px;
        border-radius: var(--r-md);
        font-size: 15px;
        font-weight: 700;
        width: 100%;
        cursor: pointer;
        transition: all 0.2s;
    }
    .btn-submit:hover {
        background: var(--blue-dk);
    }
</style>

<div class="review-wrapper">
    <div class="review-card">
        <div class="review-icon">
            <svg viewBox="0 0 24 24" width="32" height="32" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
        </div>
        <h1 class="review-title">Bagaimana Pelayanan Kami?</h1>
        <p class="review-desc">
            Halo <strong>{{ $booking->nama_pemohon ?? ($booking->user->name ?? 'Pemohon') }}</strong>,<br>
            Berikan ulasan Anda terkait layanan LAPOL PAK yang baru saja selesai pada tanggal {{ \Carbon\Carbon::parse($booking->booking_date)->translatedFormat('d M Y') }}.
        </p>

        <form action="{{ route('lapolpa.review.submit', $booking->id) }}" method="POST">
            @csrf
            
            <div class="star-rating">
                <input type="radio" id="star5" name="rating" value="5" required />
                <label for="star5" title="5 Bintang">
                    <svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                </label>
                
                <input type="radio" id="star4" name="rating" value="4" />
                <label for="star4" title="4 Bintang">
                    <svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                </label>
                
                <input type="radio" id="star3" name="rating" value="3" />
                <label for="star3" title="3 Bintang">
                    <svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                </label>
                
                <input type="radio" id="star2" name="rating" value="2" />
                <label for="star2" title="2 Bintang">
                    <svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                </label>
                
                <input type="radio" id="star1" name="rating" value="1" />
                <label for="star1" title="1 Bintang">
                    <svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                </label>
            </div>

            @error('rating')
                <div style="color:#E53E3E; font-size:12px; margin-bottom:16px;">Mohon pilih jumlah bintang.</div>
            @enderror

            <div class="form-group">
                <label for="comment" class="form-label">Komentar / Saran Anda (Opsional)</label>
                <textarea name="comment" id="comment" class="form-control" placeholder="Tuliskan pengalaman Anda menggunakan layanan kami..."></textarea>
            </div>

            <button type="submit" class="btn-submit">Kirim Ulasan</button>
        </form>
    </div>
</div>
@endsection
