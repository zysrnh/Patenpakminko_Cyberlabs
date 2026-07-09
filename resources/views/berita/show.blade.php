@extends('layouts.public')

@section('title', $berita->title . ' — PATEN PAK MIKO')

@section('content')
<div class="container" style="padding-top: 40px; padding-bottom: 80px;">
    <div class="row" style="display: flex; flex-wrap: wrap; margin: 0 -15px;">
        
        <!-- Kolom Kiri: Artikel Utama -->
        <div class="col-lg-8" style="padding: 0 15px; width: 100%; max-width: 100%; flex: 0 0 100%;">
            @if($berita->image_path)
                <img src="{{ route('file.view', ['path' => $berita->image_path]) }}" alt="{{ $berita->title }}" style="width: 100%; max-height: 500px; object-fit: cover; border-radius: 8px; margin-bottom: 24px;">
            @endif

            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 16px;">
                <span style="font-size: 13px; font-weight: 600; color: var(--blue-dk); background: var(--blue-lt); padding: 4px 12px; border-radius: 4px;">
                    {{ $berita->category ?? 'Umum' }}
                </span>
                <span style="font-size: 13px; color: var(--muted);">
                    {{ $berita->created_at->format('d M Y') }}
                </span>
            </div>

            <h1 style="font-size: clamp(24px, 4vw, 36px); font-weight: 800; line-height: 1.3; color: var(--ink); margin-bottom: 24px;">
                {{ $berita->title }}
            </h1>

            <div class="article-content" style="font-size: 16px; line-height: 1.8; color: var(--ink);">
                {!! $berita->content !!}

                @if($berita->source_link)
                    <div style="margin-top: 40px; padding: 16px 20px; background: var(--surface); border-radius: 8px; border-left: 4px solid var(--blue);">
                        <strong style="display: block; margin-bottom: 4px; font-size: 14px;">Sumber Asli:</strong>
                        <a href="{{ $berita->source_link }}" target="_blank" style="color: var(--blue); word-break: break-all; font-size: 14px; text-decoration: none;">
                            {{ $berita->source_link }}
                        </a>
                    </div>
                @endif
            </div>
            
            <div style="margin-top: 40px; border-top: 1px solid var(--line); padding-top: 20px;">
                <a href="{{ url('/') }}#artikel" style="display: inline-flex; align-items: center; gap: 8px; color: var(--blue-dk); text-decoration: none; font-weight: 600; font-size: 14px;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="19" y1="12" x2="5" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg>
                    Kembali ke Beranda
                </a>
            </div>
        </div>

        <!-- Kolom Kanan: Berita Lainnya -->
        <div class="col-lg-4 sidebar-col" style="padding: 0 15px; width: 100%; max-width: 100%; flex: 0 0 100%; margin-top: 40px;">
            <div class="sidebar-inner" style="position: sticky; top: 100px;">
                <h4 style="font-size: 18px; font-weight: 800; color: var(--ink); margin-bottom: 20px; padding-bottom: 12px; border-bottom: 2px solid var(--line);">
                    Berita Lainnya
                </h4>

                <div class="other-news-list">
                    @forelse($other_news as $post)
                    <a href="{{ route('berita.show', $post->slug) }}" class="other-news-item" style="display: block; text-decoration: none; margin-bottom: 24px; group">
                        <div style="position: relative; margin-bottom: 12px;">
                            <img src="{{ $post->image_path ? Storage::url($post->image_path) : 'https://dummyimage.com/600x400/eeeeee/31343c.png&text=News' }}" 
                                 alt="{{ $post->title }}" 
                                 style="width: 100%; height: 160px; object-fit: cover; border-radius: 8px; transition: transform 0.3s; background: var(--surface);">
                            <span style="position: absolute; top: 12px; left: 12px; background: var(--blue-dk); color: white; padding: 4px 10px; font-size: 11px; font-weight: 700; border-radius: 4px; text-transform: uppercase;">
                                {{ $post->category ?? 'Umum' }}
                            </span>
                        </div>
                        <h5 style="font-size: 15px; font-weight: 700; color: var(--ink); margin-bottom: 8px; line-height: 1.45; transition: color 0.2s;" class="post-title">
                            {{ $post->title }}
                        </h5>
                        <span style="font-size: 12px; color: var(--muted); font-weight: 500;">
                            {{ $post->created_at->format('d M Y') }}
                        </span>
                    </a>
                    @empty
                    <p style="color: var(--muted); font-size: 14px;">Belum ada berita lainnya.</p>
                    @endforelse
                </div>
            </div>
        </div>

    </div>
</div>

<style>
    /* Responsive Grid Adjustments */
    @media(min-width: 992px) {
        .col-lg-8 { flex: 0 0 66.666667% !important; max-width: 66.666667% !important; padding-right: 40px !important; }
        .sidebar-col { flex: 0 0 33.333333% !important; max-width: 33.333333% !important; margin-top: 0 !important; }
    }

    /* Hover Effects for Sidebar */
    .other-news-item:hover .post-title {
        color: var(--blue) !important;
    }
    .other-news-item img {
        transition: transform 0.3s ease;
    }
    .other-news-item:hover img {
        transform: scale(1.02);
    }
    
    /* Image Wrapper overflow hidden for scale effect */
    .other-news-item > div {
        overflow: hidden;
        border-radius: 8px;
    }

    /* Styling content CKEditor inside the public view */
    .article-content img {
        max-width: 100%;
        height: auto !important;
        border-radius: 8px;
        margin: 20px 0;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }
    .article-content h1, .article-content h2, .article-content h3, .article-content h4 {
        margin-top: 1.8em;
        margin-bottom: 0.8em;
        color: var(--blue-dk);
        font-weight: 800;
        line-height: 1.3;
    }
    .article-content p {
        margin-bottom: 1.4em;
    }
    .article-content ul, .article-content ol {
        margin-bottom: 1.4em;
        padding-left: 24px;
    }
    .article-content li {
        margin-bottom: 6px;
    }
    .article-content a {
        color: var(--blue);
        text-decoration: none;
        font-weight: 600;
    }
    .article-content a:hover {
        text-decoration: underline;
    }
    .article-content blockquote {
        border-left: 4px solid var(--blue);
        padding: 16px 20px;
        margin: 24px 0;
        background: var(--blue-lt);
        border-radius: 0 8px 8px 0;
        color: var(--blue-dk);
        font-style: italic;
        font-weight: 500;
    }
</style>
@endsection
