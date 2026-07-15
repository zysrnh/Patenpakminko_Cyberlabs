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
            $unreadCount = \App\Models\Mailbox::where('target_role', 'Kantor Pertanahan')->where('is_read', false)->count();
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
    height: 76px;
    padding: 0 28px;

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

/* ─── Kiri: breadcrumb ───────────────────────────────────────── */
.topbar-left {
    display: flex;
    align-items: center;
    gap: 12px;
}

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
    border-radius: 4px;
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
    border-radius: 4px;
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
    border-radius: 4px;
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
    border-radius: 4px;
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

    {{-- Left: breadcrumb title --}}
    <div class="topbar-left">

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
                    @elseif(Auth::user()->isBpn())        Dashboard Admin Kantor Pertanahan
                    @elseif(Auth::user()->isDinasPu())    Dashboard Dinas Pekerjaan Umum dan Tata Ruang (PUTR)
                    @elseif(Auth::user()->isSatuPintu())  Dashboard DPMPTSP
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

<!-- Toast Container -->
<div id="toast-container" style="position: fixed; bottom: 24px; right: 24px; z-index: 9999; display: flex; flex-direction: column; gap: 12px; pointer-events: none;"></div>

<style>
/* Toast Notification Styles */
.toast-notif {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(13, 45, 79, 0.15);
    border: 1px solid rgba(13, 45, 79, 0.1);
    padding: 16px;
    width: 320px;
    display: flex;
    align-items: flex-start;
    gap: 12px;
    transform: translateX(120%);
    opacity: 0;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    pointer-events: auto;
}
.toast-notif.show {
    transform: translateX(0);
    opacity: 1;
}
.toast-icon {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: rgba(33, 138, 201, 0.1);
    color: var(--blue);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}
.toast-icon svg { width: 20px; height: 20px; }
.toast-content { flex: 1; }
.toast-title { font-weight: 700; font-size: 13.5px; color: var(--ink); margin-bottom: 4px; line-height: 1.3; }
.toast-message { font-size: 12px; color: #5a7a9a; line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
.toast-close {
    background: none; border: none; color: #a0aec0; cursor: pointer; padding: 4px; border-radius: 6px; transition: 0.2s; flex-shrink: 0; display: flex; align-items: center; justify-content: center;
}
.toast-close:hover { background: #f1f5f9; color: #4a5568; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let notifiedIds = JSON.parse(localStorage.getItem('notified_mailbox_ids')) || [];

    function showToast(mailbox) {
        const container = document.getElementById('toast-container');
        if (!container) return;

        const toast = document.createElement('div');
        toast.className = 'toast-notif';
        
        let iconHtml = `<svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>`;
        
        toast.innerHTML = `
            <div class="toast-icon">${iconHtml}</div>
            <div class="toast-content">
                <div class="toast-title">${mailbox.title || 'Notifikasi Baru'}</div>
                <div class="toast-message">${mailbox.message || ''}</div>
            </div>
            <button class="toast-close" onclick="this.closest('.toast-notif').remove()">
                <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        `;

        // Action on click: open the link if provided
        if (mailbox.link) {
            toast.querySelector('.toast-content').style.cursor = 'pointer';
            toast.querySelector('.toast-content').addEventListener('click', () => {
                window.location.href = mailbox.link;
            });
        }

        container.appendChild(toast);
        
        // Trigger animation
        requestAnimationFrame(() => {
            toast.classList.add('show');
        });

        // Auto remove after 5 seconds
        setTimeout(() => {
            toast.classList.remove('show');
            setTimeout(() => toast.remove(), 400);
        }, 5000);
    }

    function checkNotifications() {
        fetch('{{ route("api.notifications.unread") }}', {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(res => {
            if (res.success && Array.isArray(res.data)) {
                // Get all current unread IDs from server
                const currentUnreadIds = res.data.map(item => item.id);
                
                // Check if there are newly found items that we haven't notified yet
                res.data.forEach(item => {
                    if (!notifiedIds.includes(item.id)) {
                        showToast(item);
                        notifiedIds.push(item.id);
                    }
                });

                // Cleanup: remove IDs from local storage that are no longer unread
                notifiedIds = notifiedIds.filter(id => currentUnreadIds.includes(id));
                localStorage.setItem('notified_mailbox_ids', JSON.stringify(notifiedIds));
                
                // Update badge count in topbar visually
                const badge = document.querySelector('.topbar-notif-badge');
                if (badge) {
                    badge.textContent = currentUnreadIds.length;
                    if (currentUnreadIds.length === 0) {
                        badge.style.display = 'none';
                    } else {
                        badge.style.display = 'flex';
                    }
                }
            }
        })
        .catch(err => console.error('Gagal memuat notifikasi AJAX:', err));
    }

    // Polling every 15 seconds
    setInterval(checkNotifications, 15000);
    
    // Initial fetch to sync badge and local storage on page load
    checkNotifications();
});
</script>
