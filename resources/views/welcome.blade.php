@extends('layouts.public')

@section('content')
<!-- ══ HERO ════════════════════════════════════════════════ -->
<section class="hero">
    <div class="hero-bg" aria-hidden="true"></div>
    <div class="container">
        <div class="hero-grid">

            <!-- Left: Copy -->
            <div>
                <div class="hero-eyebrow">
                    <span class="eyebrow-dot" aria-hidden="true"></span>
                    Portal Layanan Masyarakat
                </div>

                <h1 class="hero-heading">
                    Pertimbangan Teknis<br>
                    <span class="accent">Pertanahan</span><br>
                    yang Terkoneksi Kantor<br>Pertanahan Sukabumi Kota
                </h1>

                <p class="hero-sub">
                    PATEN Pak Miko hadir sebagai inovasi pelayanan yang memberikan kemudahan bagi pemohon dalam memperoleh layanan pertanahan secara lebih cepat, jelas, dan transparan. PATEN Pak Miko diharapkan mampu meningkatkan kepercayaan pemohon sekaligus memberikan pengalaman layanan yang lebih <strong style="color: var(--blue-dk);">profesional, responsif, dan memudahkan.</strong>
                </p>

                <div class="hero-cta-row">
                    <a href="tel:1500164" class="btn-primary">
                        Hubungi Kami
                        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </a>
                    <a href="#modul" class="btn-outline">
                        Pelajari Layanan Kami
                        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </a>
                </div>
            </div>

            <!-- Right: Service Panel -->
            <div>
                <div class="service-panel" id="modul">
                    <!-- Header -->
                    <div class="sp-header">
                        <div class="sp-header-icon">
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
                                <polyline points="9 22 9 12 15 12 15 22"/>
                            </svg>
                        </div>
                        <div class="sp-header-text">
                            <strong>Pilih Modul Layanan yang Anda Butuhkan</strong>
                        </div>
                    </div>

                    <!-- PKKPR Slider Section -->
                    <div class="sp-section-label">
                        <span>Layanan Pertimbangan Teknis Pertanahan</span>
                        <div class="sp-section-label-nav">
                            <button type="button" class="btn-slider" id="spPrev" aria-label="Slide sebelumnya">
                                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M15 18l-6-6 6-6"/></svg>
                            </button>
                            <button type="button" class="btn-slider" id="spNext" aria-label="Slide berikutnya">
                                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M9 18l6-6-6-6"/></svg>
                            </button>
                        </div>
                    </div>

                    <div class="sp-rows" id="spRows">
                        <!-- Slide 1 -->
                        <div class="sp-slide">
                            <a href="{{ route('ptp.create', ['layanan' => 'berusaha']) }}" class="sp-row">
                                <div class="sp-row-logo">
                                    <img src="{{ asset('storage/logo/PKKPR.png') }}" alt="PKKPR Berusaha">
                                </div>
                                <div class="sp-row-info">
                                    <strong>Pertimbangan Teknis Pertanahan Berusaha</strong>
                                    <span>Bisnis, usaha, industri</span>
                                </div>
                                <div class="sp-row-cta">
                                    Daftar
                                    <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                                </div>
                            </a>
                            <a href="{{ route('ptp.create', ['layanan' => 'non-berusaha']) }}" class="sp-row">
                                <div class="sp-row-logo">
                                    <img src="{{ asset('storage/logo/PKKPRNon.png') }}" alt="PKKPR Non Berusaha">
                                </div>
                                <div class="sp-row-info">
                                    <strong>Pertimbangan Teknis Pertanahan Non Berusaha</strong>
                                    <span>Rumah, sosial, keagamaan</span>
                                </div>
                                <div class="sp-row-cta">
                                    Daftar
                                    <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                                </div>
                            </a>
                            <a href="{{ route('ptp.create', ['layanan' => 'kebijakan']) }}" class="sp-row">
                                <div class="sp-row-logo">
                                    <img src="{{ asset('storage/logo/Kebijakan.png') }}" alt="Kebijakan">
                                </div>
                                <div class="sp-row-info">
                                    <strong>Kebijakan</strong>
                                    <span>Kebijakan pengguna &amp; pemanfaatan tanah</span>
                                </div>
                                <div class="sp-row-cta">
                                    Daftar
                                    <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                                </div>
                            </a>
                        </div>

                        <!-- Slide 2 -->
                        <div class="sp-slide">
                            <a href="{{ route('ptp.create', ['layanan' => 'tanah-timbul']) }}" class="sp-row">
                                <div class="sp-row-logo" style="background:var(--green-lt); border-radius:8px;">
                                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="var(--green-dk)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                                    </svg>
                                </div>
                                <div class="sp-row-info">
                                    <strong>Pertimbangan Teknis Pertanahan Tanah Timbul</strong>
                                    <span>Pengurusan legalitas tanah timbul</span>
                                </div>
                                <div class="sp-row-cta">
                                    Daftar
                                    <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                                </div>
                            </a>
                            <a href="{{ route('ptp.create', ['layanan' => 'psn']) }}" class="sp-row">
                                <div class="sp-row-logo" style="background:var(--yellow-lt); border-radius:8px;">
                                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="var(--brown)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                        <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/>
                                    </svg>
                                </div>
                                <div class="sp-row-info">
                                    <strong>Pertimbangan Teknis Pertanahan Proyek Strategis Nasional</strong>
                                    <span>Proyek skala nasional (PSN)</span>
                                </div>
                                <div class="sp-row-cta" style="color:var(--brown); background:var(--yellow-lt);">
                                    Daftar
                                    <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="sp-divider"></div>

                    <!-- Layanan Lainnya -->
                    <div class="sp-section-label">Layanan Lainnya</div>
                    <div class="sp-others">
                        <a href="{{ route('lapolpa.index') }}" class="sp-other-card">
                            <div class="sp-other-logo">
                                <img src="{{ asset('storage/logo/Lapolpak.png') }}" alt="LAPOLPAK">
                            </div>
                            <span class="sp-other-name">LAPOL PAK</span>
                            <div class="sp-other-arrow">
                                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                            </div>
                        </a>
                        <a href="{{ route('informal.index') }}" class="sp-other-card">
                            <div class="sp-other-logo">
                                <img src="{{ asset('storage/logo/Informal.png') }}" alt="INFORMAL">
                            </div>
                            <span class="sp-other-name">INFORMAL</span>
                            <div class="sp-other-arrow">
                                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                            </div>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>


<!-- ══ STATS ════════════════════════════════════════════════ -->
<div class="stats-band">
    <div class="container">
        <div class="stats-inner">
            @php
                $stats = [
                    [
                        'icon' => '<img src="'.asset('storage/svg/quote-request 1.svg').'" alt="">',
                        'value' => '12',
                        'suffix' => 'k',
                        'label' => 'Permohonan Diproses',
                    ],
                    [
                        'icon' => '<img src="'.asset('storage/svg/tag 1.svg').'" alt="">',
                        'value' => $averageRating ?? '4.0',
                        'suffix' => '/5',
                        'label' => 'Rata-rata Rating',
                    ],
                    [
                        'icon' => '<img src="'.asset('storage/svg/calendar 1.svg').'" alt="">',
                        'value' => '10',
                        'suffix' => ' hari',
                        'label' => 'Rata-rata Penyelesaian',
                    ],
                    [
                        'icon' => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>',
                        'value' => $visitorCount ?? '0',
                        'suffix' => '',
                        'label' => 'Kunjungan',
                    ],
                ];
            @endphp
            @foreach($stats as $stat)
            <div class="stat-item">
                <div class="stat-icon" aria-hidden="true">{!! $stat['icon'] !!}</div>
                <div class="stat-num">{{ $stat['value'] }}@if($stat['suffix'])<em>{{ $stat['suffix'] }}</em>@endif</div>
                <div class="stat-label">{{ $stat['label'] }}</div>
            </div>
            @endforeach
        </div>
    </div>
</div>


<!-- ══ PROCESS ══════════════════════════════════════════════ -->
<section id="alur" class="section process">
    <div class="container">
        <div class="section-header section-header-center reveal">
            <div class="eyebrow-badge">Tahapan Permohonan</div>
            <h2 class="section-title">Proses Sederhana, Hanya Empat Tahap</h2>
            <p class="section-sub">Ikuti langkah-langkah pengajuan layanan dengan mudah, cepat, dan transparan melalui sistem PATEN PAK MIKO.</p>
        </div>
        <div class="process-track">
            <div class="process-step reveal reveal-d1">
                <div class="step-img-wrapper">
                    <img src="{{ asset('storage/svg/PilihLayanan.svg') }}" alt="Pilih Layanan">
                </div>
                <h3 class="step-title">Pilih Layanan</h3>
                <p class="step-desc">Tentukan jenis layanan permohonan yang sesuai dengan kebutuhan dan kriteria kegiatan pemanfaatan ruang Anda.</p>
            </div>
            <div class="process-step reveal reveal-d2">
                <div class="step-img-wrapper">
                    <img src="{{ asset('storage/svg/UnggahDocumen.svg') }}" alt="Unggah Dokumen">
                </div>
                <h3 class="step-title">Unggah Dokumen</h3>
                <p class="step-desc">Lengkapi dan unggah berkas persyaratan permohonan melalui sistem secara digital dengan mudah dan cepat.</p>
            </div>
            <div class="process-step reveal reveal-d3">
                <div class="step-img-wrapper">
                    <img src="{{ asset('storage/svg/Verifikasi&Validasi.svg') }}" alt="Verifikasi dan Validasi Berkas">
                </div>
                <h3 class="step-title">Verifikasi dan Validasi Berkas</h3>
                <p class="step-desc">Petugas Kantor Pertanahan akan memeriksa kelengkapan dan kesesuaian dokumen yang telah Anda unggah ke sistem.</p>
            </div>
            <div class="process-step reveal reveal-d4">
                <div class="step-img-wrapper">
                    <img src="{{ asset('storage/svg/LayananBerjalan.svg') }}" alt="Layanan Berjalan">
                </div>
                <h3 class="step-title">Layanan Berjalan</h3>
                <p class="step-desc">Permohonan Anda sedang diproses. Pantau status perkembangan layanan secara real-time melalui dashboard.</p>
            </div>
        </div>
    </div>
</section>


<!-- ══ REVIEWS ══════════════════════════════════════════════ -->
<section id="ulasan" class="reviews">
    <div class="container">
        <div class="section-header section-header-center reveal">
            <div class="eyebrow-badge">Testimoni</div>
            <h2 class="section-title">Pendapat dan Kepuasan Masyarakat</h2>
            <p class="section-sub">Lihat pengalaman dan ulasan dari pengguna yang telah merasakan kemudahan layanan digital PATEN PAK MIKO.</p>
        </div>

        <div class="reviews-layout">
            <div class="reviews-sidebar reveal">
                <h3 class="reviews-sidebar-title">Testimoni<br>Pengguna</h3>
                <div class="reviews-nav">
                    <button class="btn-rev-nav" id="revPrev" aria-label="Ulasan sebelumnya">
                        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M15 18l-6-6 6-6"/></svg>
                    </button>
                    <button class="btn-rev-nav" id="revNext" aria-label="Ulasan berikutnya">
                        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M9 18l6-6-6-6"/></svg>
                    </button>
                </div>
            </div>

            <div class="reviews-slider-wrap reveal reveal-d2">
                @if($reviews->isEmpty())
                <div class="reviews-empty">
                    <p>Belum ada ulasan yang dipublikasikan saat ini.</p>
                </div>
                @else
                <div class="reviews-slider" id="revSlider">
                    @foreach($reviews as $review)
                    <div class="review-card">
                        <div class="review-header">
                            <div class="review-check">
                                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M20 6L9 17l-5-5"/></svg>
                            </div>
                            <div class="review-author">
                                <h4>{{ $review->reviewer_name }}</h4>
                                <span>Sukabumi</span>
                            </div>
                        </div>
                        <p class="review-text">"{{ $review->comment }}"</p>
                        <div class="review-foot-stars" aria-label="5 bintang">
                            @for($i = 0; $i < 5; $i++)
                            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                            @endfor
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="reviews-dots" id="revDots" role="tablist" aria-label="Review navigation">
                    @foreach($reviews as $index => $review)
                    <div class="rev-dot {{ $index === 0 ? 'active' : '' }}"
                         role="tab"
                         tabindex="0"
                         aria-label="Ulasan {{ $index + 1 }}"
                         onclick="goToRev({{ $index }})"
                         onkeydown="if(event.key==='Enter') goToRev({{ $index }})">
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </div>
</section>


<!-- ══ ARTIKEL & INFORMASI ════════════════════════════════════ -->
<section id="artikel" class="artikel-section">
    <div class="container">
        <div class="section-header section-header-center reveal">
            <div class="eyebrow-badge" style="background:#EBF8FF; color:#3291A8;">Artikel Kami</div>
            <h2 class="section-title" style="color:#113454;">Artikel &amp; Informasi Terbaru</h2>
            <p class="section-sub">Temukan berbagai informasi, panduan, dan berita terbaru seputar pelayanan pertanahan dan administrasi digital.</p>
        </div>

        <div class="artikel-top-grid reveal reveal-d1">
            <!-- Featured -->
            <div class="art-featured" style="background-image: url('https://dummyimage.com/1200x800/eeeeee/31343c.png&text=Featured+Article');">
                <div class="art-featured-content">
                    <span class="art-badge">Category</span>
                    <h3 class="art-featured-title">Cara Mengajukan Permohonan PPKPR Secara Online</h3>
                    <span class="art-featured-date">Senin, 27 April 2026</span>
                </div>
            </div>

            <!-- Latest List -->
            <div class="art-latest">
                <h3 class="art-latest-title">Latest <span>Post</span></h3>
                <div class="art-latest-list">
                    <div class="art-list-item">
                        <img src="https://dummyimage.com/180x180/eeeeee/31343c.png&text=Post+1" alt="" class="art-list-img" loading="lazy">
                        <div class="art-list-info">
                            <h4 class="art-list-title">Panduan Lengkap Upload Persyaratan Dokumen</h4>
                            <span class="art-list-date">Senin, 27 April 2026</span>
                        </div>
                    </div>
                    <div class="art-list-item">
                        <img src="https://dummyimage.com/180x180/eeeeee/31343c.png&text=Post+2" alt="" class="art-list-img" loading="lazy">
                        <div class="art-list-info">
                            <h4 class="art-list-title">Tahapan Verifikasi Berkas pada PATEN PAK MIKO</h4>
                            <span class="art-list-date">Senin, 27 April 2026</span>
                        </div>
                    </div>
                    <div class="art-list-item">
                        <img src="https://dummyimage.com/180x180/eeeeee/31343c.png&text=Post+3" alt="" class="art-list-img" loading="lazy">
                        <div class="art-list-info">
                            <h4 class="art-list-title">Tips Menyiapkan Dokumen Pertanahan dengan Benar</h4>
                            <span class="art-list-date">Senin, 27 April 2026</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Carousel -->
        <div class="art-carousel-wrap reveal reveal-d2">
            <div class="art-carousel" id="artCarousel">
                @for ($i = 1; $i <= 9; $i++)
                <div class="art-card">
                    <img src="https://dummyimage.com/600x400/eeeeee/31343c.png&text=Berita+{{ $i }}" alt="Berita {{ $i }}" class="art-card-img" loading="lazy">
                    <div class="art-card-body">
                        <div class="art-card-meta">
                            <span>Senin, 27 April 2026</span>
                        </div>
                        <h4 class="art-card-title">Judul Berita Ke-{{ $i }}</h4>
                        <span class="art-card-cat">Category</span>
                        <p class="art-card-desc">Contoh teks deskripsi berita ke-{{ $i }}. Gunakan ini untuk melihat tampilan card tanpa konten asli.</p>
                        <a href="#" class="art-card-link">Baca selengkapnya &rarr;</a>
                    </div>
                </div>
                @endfor
            </div>
            <div class="art-dots" id="artDots" role="tablist">
                @for ($i = 1; $i <= 3; $i++)
                <div class="art-dot {{ $i == 1 ? 'active' : '' }}" role="tab" aria-label="Halaman {{ $i }}"></div>
                @endfor
            </div>
            <div class="art-btn-more-wrap">
                <a href="#" class="art-btn-more">Baca Lebih Banyak &rarr;</a>
            </div>
        </div>
    </div>
</section>


<!-- ══ CTA BAND ════════════════════════════════════════════ -->
<section class="cta-band" style="background-image: url('{{ asset('storage/aset/Footer.png') }}');">
    <div class="container">
        <div class="cta-inner reveal">
            <h2 class="cta-heading">
                Wujudkan Pelayanan<br>
                Administrasi yang <span>Lebih Mudah</span>
            </h2>
            <p class="cta-sub">
                Mulai proses pengajuan Anda sekarang melalui sistem PATEN PAK MIKO<br>
                yang cepat, aman, dan terintegrasi secara digital.
            </p>
            <div class="cta-actions">
                <a href="{{ route('login') }}" class="btn-cta-primary">Mulai Sekarang &rarr;</a>
                <a href="#alur" class="btn-cta-outline">Pelajari Layanan &rarr;</a>
            </div>
        </div>
    </div>
</section>


@endsection
