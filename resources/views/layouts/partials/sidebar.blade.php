{{-- ═══════════════════════════════════════════════════════
     PATEN PAK MIKO — Unified Sidebar Partial
     resources/views/layouts/partials/sidebar.blade.php
     ═══════════════════════════════════════════════════════ --}}

<style>
    /* ─── UNIFIED FLAT SIDEBAR & SLIM SCROLLBAR ──────────── */
    .sidebar {
        width: var(--sidebar);
        background: var(--blue-dk);
        display: flex;
        flex-direction: column;
        position: fixed;
        top: 0; left: 0; bottom: 0;
        z-index: 20;
        padding-bottom: 20px;
        overflow-y: auto;
        overflow-x: hidden;
        transition: transform .25s ease;
    }
    .sidebar > * {
        flex-shrink: 0;
    }
    .sidebar::-webkit-scrollbar {
        width: 5px;
    }
    .sidebar::-webkit-scrollbar-track,
    .sidebar::-webkit-scrollbar-track-piece {
        background: transparent;
    }
    .sidebar::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, 0.22);
        border-radius: 2px;
    }
    .sidebar::-webkit-scrollbar-thumb:hover {
        background: rgba(255, 255, 255, 0.4);
    }
    .sidebar::-webkit-scrollbar-button,
    .sidebar::-webkit-scrollbar-corner {
        display: none;
        width: 0;
        height: 0;
    }

    .sidebar-logo-wrap {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 18px 16px 16px;
        border-bottom: 1px solid rgba(255, 255, 255, .08);
    }
    .sidebar-logo {
        display: flex;
        align-items: center;
        gap: 11px;
        text-decoration: none;
        min-width: 0;
        flex: 1;
        padding: 0;
        border-bottom: none;
    }
    .sidebar-logo-icon {
        width: 38px;
        height: 38px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        overflow: hidden;
    }
    .sidebar-logo-text {
        min-width: 0;
    }
    .sidebar-logo-text strong {
        display: block;
        font-size: 14px;
        font-weight: 800;
        color: #fff;
        letter-spacing: -.02em;
        white-space: nowrap;
    }
    .sidebar-logo-text span {
        display: block;
        font-size: 9.5px;
        font-weight: 600;
        color: rgba(255, 255, 255, .48);
        text-transform: uppercase;
        letter-spacing: .06em;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 158px;
    }

    .btn-close-sidebar-mobile {
        display: none;
        background: transparent;
        border: none;
        color: rgba(255, 255, 255, 0.7);
        cursor: pointer;
        padding: 4px;
        border-radius: 4px;
        transition: all 0.2s;
        flex-shrink: 0;
    }
    .btn-close-sidebar-mobile:hover {
        color: #ffffff;
        background: rgba(255, 255, 255, 0.1);
    }

    .sidebar-section {
        padding: 14px 12px 4px;
    }
    .sidebar-section-label {
        font-size: 10px;
        font-weight: 700;
        color: rgba(255, 255, 255, .38);
        text-transform: uppercase;
        letter-spacing: .08em;
        padding: 0 8px;
        margin-bottom: 6px;
    }

    .nav-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 9px 11px;
        border-radius: 4px;
        text-decoration: none;
        color: rgba(255, 255, 255, .72);
        font-size: 13px;
        font-weight: 600;
        line-height: 1.35;
        transition: background .16s ease, color .16s ease;
        margin-bottom: 2px;
    }
    .nav-item svg {
        width: 17px;
        height: 17px;
        fill: none;
        stroke: currentColor;
        stroke-width: 2;
        stroke-linecap: round;
        stroke-linejoin: round;
        flex-shrink: 0;
    }
    .nav-item:hover {
        color: #fff;
        background: rgba(255, 255, 255, .09);
    }
    .nav-item.active {
        color: var(--blue-dk);
        background: var(--yellow);
        font-weight: 700;
    }
    .nav-item.active svg {
        color: var(--blue-dk);
    }

    /* Dropdown */
    .nav-item-group {
        display: flex;
        flex-direction: column;
    }
    .nav-item.has-dropdown {
        justify-content: space-between;
        cursor: pointer;
    }
    .nav-dropdown-menu {
        display: none;
        flex-direction: column;
        margin: 2px 0 6px 19px;
        padding-left: 12px;
        border-left: 1px solid rgba(255, 255, 255, .14);
        gap: 2px;
    }
    .nav-dropdown-menu.open {
        display: flex;
    }
    .nav-dropdown-item {
        padding: 7px 10px;
        color: rgba(255, 255, 255, .66);
        font-size: 12px;
        text-decoration: none;
        border-radius: 4px;
        transition: background .16s ease, color .16s ease;
        font-weight: 500;
        line-height: 1.35;
    }
    .nav-dropdown-item:hover {
        color: #fff;
        background: rgba(255, 255, 255, .08);
    }
    .nav-dropdown-item.active {
        color: var(--blue-dk);
        background: var(--yellow);
        font-weight: 700;
    }
    .chevron {
        width: 15px;
        height: 15px;
        transition: transform .2s ease;
    }
    .nav-item.has-dropdown.open .chevron {
        transform: rotate(180deg);
    }

    .sidebar-bottom {
        margin-top: auto;
        padding: 14px 12px;
        border-top: 1px solid rgba(255, 255, 255, .08);
    }
    .sidebar-user {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 9px 10px;
        border-radius: 4px;
        background: rgba(255, 255, 255, .06);
        margin-bottom: 8px;
    }
    .sidebar-avatar {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        background: var(--blue);
        color: #fff;
        font-weight: 700;
        font-size: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        border: 1.5px solid rgba(255, 255, 255, .2);
        object-fit: cover;
    }
    .sidebar-user-info strong {
        display: block;
        font-size: 12.5px;
        font-weight: 700;
        color: #fff;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 145px;
    }
    .sidebar-user-info span {
        display: block;
        font-size: 11px;
        color: rgba(255, 255, 255, .48);
    }

    .btn-logout-sidebar {
        display: flex;
        align-items: center;
        gap: 8px;
        width: 100%;
        padding: 8.5px 10px;
        background: transparent;
        border: 1px solid rgba(255, 255, 255, .14);
        border-radius: 4px;
        color: rgba(255, 255, 255, .65);
        font-family: inherit;
        font-size: 12.5px;
        font-weight: 600;
        cursor: pointer;
        transition: all .18s;
    }
    .btn-logout-sidebar svg {
        width: 15px;
        height: 15px;
        fill: none;
        stroke: currentColor;
        stroke-width: 2;
        stroke-linecap: round;
        stroke-linejoin: round;
    }
    .btn-logout-sidebar:hover {
        background: rgba(239, 68, 68, .16);
        border-color: rgba(239, 68, 68, .35);
        color: #FC8181;
    }

    @media (max-width: 768px) {
        .btn-close-sidebar-mobile {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .sidebar {
            width: 272px !important;
            transform: translateX(-100%);
            z-index: 1000 !important;
        }
        .sidebar.open {
            transform: translateX(0);
        }
    }
</style>

<aside class="sidebar" id="sidebar">
    <div class="sidebar-logo-wrap">
        <a href="{{ route('dashboard') }}" class="sidebar-logo">
            <div class="sidebar-logo-icon">
                <img src="{{ asset('storage/logo/PATEN PAK MIKO LOGO.png') }}" alt="Logo PATEN PAK MIKO" style="width:100%;height:100%;object-fit:contain;">
            </div>
            <div class="sidebar-logo-text">
                <strong>PATEN PAK MIKO</strong>
                <span>
                    @if(Auth::check())
                        @if(Auth::user()->isPelakuUsaha()) Kantor Pertanahan Kota Sukabumi
                        @elseif(Auth::user()->isBpn()) Portal Admin Kantor Pertanahan
                        @elseif(Auth::user()->isDinasPu()) Portal Dinas PUTR
                        @elseif(Auth::user()->isSatuPintu()) Portal DPMPTSP
                        @elseif(Auth::user()->isDpn()) Super Admin
                        @else Portal Manajemen @endif
                    @else
                        Kantor Pertanahan Kota Sukabumi
                    @endif
                </span>
            </div>
        </a>
        <button type="button" class="btn-close-sidebar-mobile" onclick="closeSidebar()" aria-label="Tutup menu">
            <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>

    <div class="sidebar-section">
        <div class="sidebar-section-label">Menu Utama</div>
        <a href="/" class="nav-item {{ request()->is('/') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
            Beranda
        </a>
        <a href="{{ route('dashboard') }}" class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
            Dashboard
        </a>
        <a href="{{ route('profile') }}" class="nav-item {{ request()->routeIs('profile') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
            Profil Saya
        </a>
    </div>

    @if(!Auth::check() || !Auth::user()->isAdminBerita())
    <div class="sidebar-section">
        <div class="sidebar-section-label">Layanan</div>
        <a href="{{ route('berusaha.index') }}" class="nav-item {{ request()->routeIs('berusaha.*') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24"><rect x="2" y="3" width="20" height="14" rx="2"/><path d="M8 21h8M12 17v4"/></svg>
            Pertimbangan Teknis Pertanahan PKKPR Berusaha
        </a>
        <a href="{{ route('non-berusaha.index') }}" class="nav-item {{ request()->routeIs('non-berusaha.*') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
            Pertimbangan Teknis Pertanahan PKKPR Non Berusaha
        </a>
        <a href="{{ route('kebijakan.index') }}" class="nav-item {{ request()->routeIs('kebijakan.*') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
            Pertimbangan Teknis Pertanahan Kebijakan
        </a>
        <a href="{{ route('tanah-timbul.index') }}" class="nav-item {{ request()->routeIs('tanah-timbul.*') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
            Pertimbangan Teknis Pertanahan Tanah Timbul
        </a>
        <a href="{{ route('psn.index') }}" class="nav-item {{ request()->routeIs('psn.*') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24"><path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z"/><line x1="4" y1="22" x2="4" y2="15"/></svg>
            PSN (Proyek Nasional)
        </a>
    </div>

    <div class="sidebar-section">
        <div class="sidebar-section-label">Fasilitas & Manajemen</div>
        <a href="{{ route('informal.index') }}" class="nav-item {{ request()->routeIs('informal.*') && !request()->routeIs('admin.informal_map.*') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
            INFORMAL
        </a>
        @if(Auth::check() && (Auth::user()->isBpn() || Auth::user()->isDpn() || Auth::user()->isSuperAdmin()))
        <a href="{{ route('admin.informal_map.index') }}" class="nav-item {{ request()->routeIs('admin.informal_map.*') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24"><polygon points="1 6 1 22 8 18 16 22 23 18 23 2 16 6 8 2 1 6"/><line x1="8" y1="2" x2="8" y2="18"/><line x1="16" y1="6" x2="16" y2="22"/></svg>
            Kelola Peta INFORMAL
        </a>
        @endif
        <a href="{{ route('lapolpa.index') }}" class="nav-item {{ request()->routeIs('lapolpa.*') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24"><path d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01"/></svg>
            LAPOL PAK
        </a>
        @if(Auth::check() && (Auth::user()->isBpn() || Auth::user()->isDinasPu() || Auth::user()->isDinasPutr() || Auth::user()->isSatuPintu()))
        <a href="{{ route('admin.reviews.index') }}" class="nav-item {{ request()->routeIs('admin.reviews.*') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
            Evaluasi Ulasan Masuk
        </a>
        @else
        <a href="{{ route('ulasan.index') }}" class="nav-item {{ request()->routeIs('ulasan.*') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
            Ulasan Layanan
        </a>
        @endif
    </div>

    @if(Auth::check() && (Auth::user()->isDpn() || Auth::user()->isBpn() || Auth::user()->isDinasPu() || Auth::user()->isDinasPutr() || Auth::user()->isSatuPintu()))
    <div class="sidebar-section">
        <div class="sidebar-section-label">Manajemen Pemberkasan</div>
        <div class="nav-item-group">
            <div class="nav-item has-dropdown {{ request()->routeIs('berkas.*') ? 'active open' : '' }}" onclick="this.classList.toggle('open'); this.nextElementSibling.classList.toggle('open');">
                <div style="display:flex; align-items:center; gap:10px;">
                    <svg viewBox="0 0 24 24"><path d="M4 19.5A2.5 2.5 0 016.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 014 19.5v-15A2.5 2.5 0 016.5 2z"/></svg>
                    Pemberkasan
                </div>
                <svg class="chevron" viewBox="0 0 24 24"><polyline points="6 9 12 15 18 9"/></svg>
            </div>
            <div class="nav-dropdown-menu {{ request()->routeIs('berkas.*') ? 'open' : '' }}">
                <a href="{{ route('berkas.index') }}" class="nav-dropdown-item {{ request()->routeIs('berkas.index') && !request('kategori') ? 'active' : '' }}">Berkas Otomatis</a>
                <a href="{{ route('berkas.index', ['kategori' => 'Pertek PKKPR Berusaha']) }}" class="nav-dropdown-item {{ request('kategori') == 'Pertek PKKPR Berusaha' ? 'active' : '' }}">Pertimbangan Teknis Berusaha</a>
                <a href="{{ route('berkas.index', ['kategori' => 'Pertek PKKPR Non Berusaha']) }}" class="nav-dropdown-item {{ request('kategori') == 'Pertek PKKPR Non Berusaha' ? 'active' : '' }}">Pertimbangan Teknis Non Berusaha</a>
                @if(!Auth::user()->isDinasPu() && !Auth::user()->isDinasPutr() && !Auth::user()->isSatuPintu())
                <a href="{{ route('berkas.index', ['kategori' => 'Pertek Kebijakan Khusus']) }}" class="nav-dropdown-item {{ request('kategori') == 'Pertek Kebijakan Khusus' ? 'active' : '' }}">Pertimbangan Teknis Kebijakan</a>
                <a href="{{ route('berkas.index', ['kategori' => 'Pertek Tanah Timbul']) }}" class="nav-dropdown-item {{ request('kategori') == 'Pertek Tanah Timbul' ? 'active' : '' }}">Pertimbangan Teknis Tanah Timbul</a>
                @endif
                <a href="{{ route('berkas.index', ['kategori' => 'Pertek PSN']) }}" class="nav-dropdown-item {{ request('kategori') == 'Pertek PSN' ? 'active' : '' }}">Pertimbangan Teknis PSN</a>
            </div>
        </div>
        <a href="{{ route('dokumen.index') }}" class="nav-item {{ request()->routeIs('dokumen.*') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8l-6-6z"/><path d="M14 2v6h6"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
            Pengelolaan Dokumen
        </a>
    </div>
    @endif
    @endif

    @if(Auth::check() && (Auth::user()->isDpn() || Auth::user()->isAdminBerita()))
    <div class="sidebar-section">
        <div class="sidebar-section-label">Admin</div>
        @if(Auth::user()->isDpn())
        <a href="{{ route('dpn.contacts') }}" class="nav-item {{ request()->routeIs('dpn.contacts*') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg>
            Kontak Admin Instansi
        </a>
        <a href="{{ route('dpn.kontak_page') }}" class="nav-item {{ request()->routeIs('dpn.kontak_page*') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24"><path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            Kelola Halaman Kontak
        </a>
        <a href="{{ route('admin.reviews.index') }}" class="nav-item {{ request()->routeIs('admin.reviews.*') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
            Kelola Ulasan
        </a>
        <a href="{{ route('admin_dpn.index') }}" class="nav-item {{ request()->routeIs('admin_dpn.*') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><line x1="3" y1="9" x2="21" y2="9"/><line x1="9" y1="21" x2="9" y2="9"/></svg>
            Kelola Web
        </a>
        <a href="{{ route('dpn.holidays.index') }}" class="nav-item {{ request()->routeIs('dpn.holidays.*') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
            Kelola Kalender Libur
        </a>
        @endif

        <a href="{{ route('admin.templates.index') }}" class="nav-item {{ request()->routeIs('admin.templates.*') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8l-6-6z"/><path d="M14 2v6h6"/><path d="M16 13H8"/><path d="M16 17H8"/><path d="M10 9H8"/></svg>
            Kelola Template Dokumen
        </a>
        <a href="{{ route('admin.berita.index') }}" class="nav-item {{ request()->routeIs('admin.berita.*') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24"><path d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l6 6v10a2 2 0 01-2 2z"/></svg>
            Kelola Berita
        </a>
    </div>
    @endif

    @if(Auth::check() && Auth::user()->isDpn())
    <div class="sidebar-section">
        <div class="sidebar-section-label">Manajemen Admin</div>
        <a href="{{ route('admin.users.index') }}" class="nav-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg>
            Kelola Admin
        </a>
        <a href="{{ route('admin.pelaku_usaha.index') }}" class="nav-item {{ request()->routeIs('admin.pelaku_usaha.*') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg>
            Kelola Pengguna
        </a>
    </div>
    @endif

    @if(!Auth::check())
    <div class="sidebar-bottom">
        <a href="{{ route('login') }}" class="btn-logout-sidebar" style="color: #FFFFFF; background: var(--blue); border-color: var(--blue); text-decoration: none; justify-content: center;">
            Masuk ke Akun
        </a>
    </div>
    @endif
</aside>
