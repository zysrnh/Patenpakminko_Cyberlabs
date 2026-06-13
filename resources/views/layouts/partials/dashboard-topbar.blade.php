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

<style>
/* ─── Topbar ─────────────────────────────────────────────────────────────── */
.topbar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    height: 56px;
    padding: 0 20px;

    /* Glassmorphism */
    background: rgba(255, 255, 255, 0.72);
    backdrop-filter: blur(16px);
    -webkit-backdrop-filter: blur(16px);

    /* Border bawah via shadow — lebih subtle dari solid line */
    border-bottom: 1px solid rgba(255, 255, 255, 0.55);
    box-shadow:
        0 1px 3px  rgba(15, 40, 70, 0.08),
        0 4px 16px rgba(15, 40, 70, 0.06),
        inset 0 1px 0 rgba(255, 255, 255, 0.9);

    position: sticky;
    top: 0;
    z-index: 100;
}

/* ─── Kiri: hamburger + breadcrumb ───────────────────────────────────────── */
.topbar-left {
    display: flex;
    align-items: center;
    gap: 12px;
}

.topbar-hamburger {
    width: 34px;
    height: 34px;
    border-radius: 8px;
    border: none;
    background: transparent;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #1a3a5c;
    transition: background 0.15s ease;
    flex-shrink: 0;
}
.topbar-hamburger:hover  { background: rgba(15, 50, 90, 0.07); }
.topbar-hamburger:active { background: rgba(15, 50, 90, 0.12); }
.topbar-hamburger svg    { width: 18px; height: 18px; }

.topbar-breadcrumb {
    display: flex;
    align-items: center;
    gap: 6px;
}

.topbar-breadcrumb-parent {
    font-size: 13px;
    font-weight: 500;
    color: #5a7a9a;
    letter-spacing: 0.01em;
    text-decoration: none;
    outline: none;
    transition: color 0.15s;
}
.topbar-breadcrumb-parent:hover { color: #1a3a5c; }

.topbar-breadcrumb-sep {
    width: 14px;
    height: 14px;
    color: #b0c0d0;
    flex-shrink: 0;
}

.topbar-breadcrumb-current {
    font-size: 14px;
    font-weight: 600;
    color: #0d2d4f;
    letter-spacing: -0.01em;
}

/* ─── Kanan: date · divider · notif · user chip ──────────────────────────── */
.topbar-right {
    display: flex;
    align-items: center;
    gap: 6px;
}

.topbar-datepill {
    display: flex;
    align-items: center;
    gap: 7px;
    padding: 5px 12px;
    border-radius: 20px;
    background: rgba(13, 45, 79, 0.06);
    border: 0.5px solid rgba(13, 45, 79, 0.1);
    color: #2a4f72;
    font-size: 12.5px;
    font-weight: 500;
    user-select: none;
    white-space: nowrap;
}
.topbar-datepill svg {
    width: 14px;
    height: 14px;
    flex-shrink: 0;
    opacity: 0.7;
}

.topbar-divider {
    width: 1px;
    height: 22px;
    background: rgba(13, 45, 79, 0.12);
    margin: 0 4px;
    flex-shrink: 0;
}

/* ─── Notif button ───────────────────────────────────────────────────────── */
.topbar-notif-btn {
    position: relative;
    width: 36px;
    height: 36px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #1a3a5c;
    text-decoration: none;
    transition: background 0.15s ease;
    flex-shrink: 0;
}
.topbar-notif-btn:hover  { background: rgba(13, 45, 79, 0.07); }
.topbar-notif-btn:active { background: rgba(13, 45, 79, 0.12); }
.topbar-notif-btn svg    { width: 19px; height: 19px; }

.topbar-notif-badge {
    position: absolute;
    top: 4px;
    right: 4px;
    min-width: 16px;
    height: 16px;
    padding: 0 4px;
    border-radius: 8px;
    background: #e53935;
    color: #fff;
    font-size: 9.5px;
    font-weight: 700;
    display: flex;
    align-items: center;
    justify-content: center;
    line-height: 1;
    border: 1.5px solid rgba(255, 255, 255, 0.85);
    letter-spacing: -0.02em;
    pointer-events: none;
}

/* ─── User chip ──────────────────────────────────────────────────────────── */
.topbar-user-chip {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 4px 10px 4px 4px;
    border-radius: 22px;
    border: 0.5px solid rgba(13, 45, 79, 0.14);
    background: rgba(13, 45, 79, 0.05);
    text-decoration: none;
    outline: none;
    transition: background 0.15s ease, border-color 0.15s ease;
    cursor: pointer;
    white-space: nowrap;
}
.topbar-user-chip:hover {
    background: rgba(13, 45, 79, 0.10);
    border-color: rgba(13, 45, 79, 0.22);
}

.topbar-user-avatar {
    width: 28px;
    height: 28px;
    border-radius: 50%;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}

.topbar-user-avatar--img {
    object-fit: cover;
}

.topbar-user-avatar--initials {
    /* Navy gradient selaras palette PATEN PAK MIKO */
    background: linear-gradient(135deg, #0d3b6e 0%, #1565a8 100%);
    color: #fff;
    font-size: 10.5px;
    font-weight: 700;
    letter-spacing: 0.03em;
}

.topbar-user-name {
    font-size: 12.5px;
    font-weight: 500;
    color: #0d2d4f;
    letter-spacing: -0.01em;
}
/* ─────────────────────────────────────────────────────────────────────────── */
</style>

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
            <a href="{{ url('/') }}" class="topbar-breadcrumb-parent">PATEN PAK MIKO</a>
            <svg class="topbar-breadcrumb-sep" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="9 18 15 12 9 6"/>
            </svg>
            <span class="topbar-breadcrumb-current">
                @if(isset($pageTitle))
                    {{ $pageTitle }}
                @else
                    @if(Auth::user()->isPelakuUsaha())   Dashboard Pelaku Usaha
                    @elseif(Auth::user()->isBpn())        Dashboard Admin BPN
                    @elseif(Auth::user()->isDinasPu())    Dashboard Dinas PU
                    @elseif(Auth::user()->isSatuPintu())  Dashboard Satu Pintu
                    @elseif(Auth::user()->isDpn())        Dashboard Admin Pusat
                    @elseif(Auth::user()->isAdminBerita()) Dashboard Berita
                    @else Dashboard
                    @endif
                @endif
            </span>
        </div>
    </div>

    {{-- Right: date · mailbox · user --}}
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
        <a href="{{ route('mailbox.index') }}"
           class="topbar-notif-btn"
           title="Kotak Masuk"
           aria-label="Kotak Masuk — {{ $unreadCount }} belum dibaca">
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
        <a href="{{ route('profile') }}" class="topbar-user-chip" title="Profil Pengguna">
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
        </a>

    </div>
</header>

<script>
    (function () {
        const el = document.getElementById('current-date');
        if (!el) return;
        const d = new Date();
        const days   = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
        const months = ['Januari','Februari','Maret','April','Mei','Juni',
                        'Juli','Agustus','September','Oktober','November','Desember'];
        el.textContent = days[d.getDay()] + ', ' + d.getDate() + ' ' + months[d.getMonth()] + ' ' + d.getFullYear();
    })();
</script>