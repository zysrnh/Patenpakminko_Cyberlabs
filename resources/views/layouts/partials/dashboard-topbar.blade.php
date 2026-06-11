{{-- ═══════════════════════════════════════════════════════
     PATEN PAK MIKO — Dashboard Topbar Partial
     resources/views/layouts/partials/dashboard-topbar.blade.php
     ═══════════════════════════════════════════════════════ --}}

@php
    $unreadCount = 0;
    if (Auth::check()) {
        $u = Auth::user();
        if ($u->isPelakuUsaha()) {
            $unreadCount = \App\Models\Mailbox::where('target_user_id', $u->id)->where('is_read', false)->count();
        } elseif ($u->isBpn()) {
            $unreadCount = \App\Models\Mailbox::where('target_role', 'bpn')->where('is_read', false)->count();
        } elseif ($u->isDinasPu() || $u->isDinasPutr()) {
            $unreadCount = \App\Models\Mailbox::where('target_role', 'dinas_pu')->where('is_read', false)->count();
        } elseif ($u->isSatuPintu()) {
            $unreadCount = \App\Models\Mailbox::where('target_role', 'satu_pintu')->where('is_read', false)->count();
        }
    }
@endphp

<header class="topbar">

    {{-- Left: hamburger + breadcrumb title --}}
    <div class="topbar-left">
        <button class="topbar-hamburger" id="toggle-sidebar" aria-label="Buka menu navigasi">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                <line x1="3" y1="6"  x2="21" y2="6"/>
                <line x1="3" y1="12" x2="21" y2="12"/>
                <line x1="3" y1="18" x2="21" y2="18"/>
            </svg>
        </button>

        <div class="topbar-breadcrumb">
            <span class="topbar-breadcrumb-parent">PATEN PAK MIKO</span>
            <svg class="topbar-breadcrumb-sep" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="9 18 15 12 9 6"/>
            </svg>
            <span class="topbar-breadcrumb-current">
                @if(Auth::user()->isPelakuUsaha())  Dashboard Pelaku Usaha
                @elseif(Auth::user()->isBpn())       Dashboard Admin BPN
                @elseif(Auth::user()->isDinasPu())   Dashboard Dinas PU
                @elseif(Auth::user()->isSatuPintu()) Dashboard Satu Pintu
                @elseif(Auth::user()->isDpn())       Dashboard Admin Pusat
                @elseif(Auth::user()->isAdminBerita()) Dashboard Berita
                @else Dashboard @endif
            </span>
        </div>
    </div>

    {{-- Right: date · mailbox --}}
    <div class="topbar-right">

        {{-- Date pill --}}
        <div class="topbar-datepill">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="4" width="18" height="18" rx="2"/>
                <line x1="16" y1="2" x2="16" y2="6"/>
                <line x1="8"  y1="2" x2="8"  y2="6"/>
                <line x1="3"  y1="10" x2="21" y2="10"/>
            </svg>
            <span id="current-date">—</span>
        </div>

        {{-- Divider --}}
        <div class="topbar-divider"></div>

        {{-- Mailbox / Notification --}}
        <a href="{{ route('mailbox.index') }}" class="topbar-notif-btn" title="Kotak Masuk" aria-label="Kotak Masuk — {{ $unreadCount }} belum dibaca">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                <path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9"/>
                <path d="M13.73 21a2 2 0 01-3.46 0"/>
            </svg>
            @if($unreadCount > 0)
                <span class="topbar-notif-badge" aria-hidden="true">
                    {{ $unreadCount > 99 ? '99+' : $unreadCount }}
                </span>
            @endif
        </a>

        {{-- User chip --}}
        <div class="topbar-user-chip">
            @if(Auth::user()->profile_photo)
                <img
                    src="{{ asset('storage/' . Auth::user()->profile_photo) }}"
                    alt="Foto Profil"
                    class="topbar-user-avatar topbar-user-avatar--img"
                >
            @else
                <div class="topbar-user-avatar topbar-user-avatar--initials">
                    {{ strtoupper(substr(Auth::user()->name ?? Auth::user()->username, 0, 2)) }}
                </div>
            @endif
            <span class="topbar-user-name">{{ Str::limit(Auth::user()->name ?? Auth::user()->username, 18) }}</span>
        </div>

    </div>
</header>