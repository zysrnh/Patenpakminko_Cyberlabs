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
    height: 64px;
    padding: 0 24px;
    gap: 14px;

    /* Glassmorphism */
    background: rgba(255, 255, 255, 0.92);
    backdrop-filter: blur(16px);
    -webkit-backdrop-filter: blur(16px);

    border-bottom: 1px solid #E2E8F0;
    box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04);

    position: sticky;
    top: 0;
    z-index: 100;
}

/* ─── Hamburger (mobile sidebar toggle) ─────────────────────── */
.hamburger {
    display: none;
    align-items: center;
    justify-content: center;
    width: 36px;
    height: 36px;
    border-radius: 8px;
    background: transparent;
    border: none;
    color: #0F172A;
    cursor: pointer;
    flex-shrink: 0;
    padding: 0;
    margin-right: 2px;
}
.hamburger:hover { background: #F1F5F9; }
.hamburger svg { width: 22px; height: 22px; }

/* ─── Kiri: breadcrumb ───────────────────────────────────────── */
.topbar-left {
    display: flex;
    align-items: center;
    gap: 12px;
    min-width: 0;
    flex-shrink: 1;
}

.topbar-breadcrumb {
    display: flex;
    align-items: center;
    gap: 8px;
    min-width: 0;
    overflow: hidden;
}

.topbar-breadcrumb-parent {
    font-size: 12.5px;
    font-weight: 700;
    color: #64748B;
    letter-spacing: 0.04em;
    text-transform: uppercase;
    text-decoration: none;
    outline: none;
    transition: color 0.15s;
    white-space: nowrap;
    flex-shrink: 0;
}
.topbar-breadcrumb-parent:hover { color: #0F172A; }

.topbar-breadcrumb-sep {
    width: 14px;
    height: 14px;
    color: #94A3B8;
    flex-shrink: 0;
}

.topbar-breadcrumb-current {
    font-size: 14.5px;
    font-weight: 800;
    color: #0F172A;
    letter-spacing: -0.015em;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

/* ─── Kanan: date · divider · notif · user chip ──────────────────────────── */
.topbar-right {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-shrink: 0;
}

.topbar-datepill {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 0 14px;
    height: 36px;
    border-radius: 8px;
    background: #F1F5F9;
    border: 1px solid #E2E8F0;
    color: #334155;
    font-size: 13px;
    font-weight: 600;
    user-select: none;
    white-space: nowrap;
    flex-shrink: 0;
}
.topbar-datepill svg {
    width: 15px;
    height: 15px;
    flex-shrink: 0;
    color: #64748B;
}

.topbar-divider {
    width: 1px;
    height: 22px;
    background: #E2E8F0;
    margin: 0 2px;
    flex-shrink: 0;
}

/* ─── Backup DB Button ─────────────────────────────────────────────────── */
.topbar-backup-btn {
    height: 36px;
    padding: 0 14px;
    border-radius: 8px;
    background: #E0F2FE;
    color: #0284C7;
    border: 1px solid #BAE6FD;
    font-size: 12.5px;
    font-weight: 700;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    text-decoration: none;
    white-space: nowrap;
    flex-shrink: 0;
    transition: all 0.15s ease;
}
.topbar-backup-btn:hover {
    background: #BAE6FD;
    color: #0369A1;
}

/* ─── Notif button ───────────────────────────────────────────────────────── */
.topbar-notif-btn {
    position: relative;
    width: 36px;
    height: 36px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #334155;
    text-decoration: none;
    transition: background 0.15s ease;
    flex-shrink: 0;
}
.topbar-notif-btn:hover  { background: #F1F5F9; color: #0F172A; }
.topbar-notif-btn:active { background: #E2E8F0; }
.topbar-notif-btn svg    { width: 19px; height: 19px; }

.topbar-notif-badge {
    position: absolute;
    top: 3px;
    right: 3px;
    min-width: 15px;
    height: 15px;
    padding: 0 4px;
    border-radius: 8px;
    background: #EF4444;
    color: #fff;
    font-size: 9.5px;
    font-weight: 800;
    display: flex;
    align-items: center;
    justify-content: center;
    line-height: 1;
    border: 1.5px solid #ffffff;
    letter-spacing: -0.02em;
    pointer-events: none;
}

/* ─── User chip ──────────────────────────────────────────────────────────── */
.topbar-user-chip {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 3px 12px 3px 3px;
    height: 36px;
    border-radius: 8px;
    border: 1px solid #E2E8F0;
    background: #F8FAFC;
    text-decoration: none;
    outline: none;
    transition: background 0.15s ease, border-color 0.15s ease;
    cursor: pointer;
    white-space: nowrap;
}
.topbar-user-chip:hover {
    background: #F1F5F9;
    border-color: #CBD5E1;
}

.topbar-user-avatar {
    width: 30px;
    height: 30px;
    border-radius: 6px;
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
    background: linear-gradient(135deg, #0d3b6e 0%, #1565a8 100%);
    color: #fff;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.03em;
}

.topbar-user-name {
    font-size: 13px;
    font-weight: 700;
    color: #0F172A;
    letter-spacing: -0.01em;
}

.topbar-logout-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    height: 36px;
    padding: 0 14px;
    border-radius: 8px;
    border: 1px solid #FCA5A5;
    background: #FEF2F2;
    color: #EF4444;
    font-size: 12.5px;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.15s ease-in-out;
    white-space: nowrap;
    outline: none;
}
.topbar-logout-btn:hover {
    background: #EF4444;
    color: #ffffff;
    border-color: #EF4444;
    box-shadow: 0 2px 8px rgba(239, 68, 68, 0.25);
}

/* ─── MOBILE RESPONSIVE ──────────────────────────────────────── */
@media (max-width: 992px) {
    .topbar-datepill { display: none; }
}

@media (max-width: 768px) {
    .topbar {
        padding: 0 14px;
        height: 60px;
        gap: 8px;
    }
    .hamburger { display: flex; }

    /* Breadcrumb: sembunyikan "PATEN PAK MIKO >" biar muat, sisain judul halaman aja */
    .topbar-breadcrumb-parent,
    .topbar-breadcrumb-sep {
        display: none;
    }
    .topbar-breadcrumb-current {
        font-size: 14px;
        font-weight: 800;
        max-width: 40vw;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .topbar-right { gap: 6px; }
    .topbar-divider { display: none; }

    /* Backup DB: icon aja, teks disembunyikan */
    .topbar-backup-btn span { display: none; }
    .topbar-backup-btn { padding: 0; width: 36px; height: 36px; justify-content: center; border-radius: 8px; }

    .topbar-user-name { display: none; }
    .topbar-user-chip { padding: 4px; gap: 0; height: 36px; border-radius: 8px; }

    /* Logout: icon aja di HP */
    .topbar-logout-btn span { display: none; }
    .topbar-logout-btn { padding: 0; width: 36px; height: 36px; justify-content: center; margin-left: 0; border-radius: 8px; }
}

@media (max-width: 420px) {
    .topbar { padding: 0 8px; }
    .topbar-breadcrumb-current { max-width: 32vw; font-size: 13px; }
    .topbar-notif-btn { width: 32px; height: 32px; }
    .topbar-notif-btn svg { width: 17px; height: 17px; }
}
/* ─────────────────────────────────────────────────────────────────────────── */
</style>

<header class="topbar">

    {{-- Left: hamburger (mobile) + breadcrumb title --}}
    <div class="topbar-left">

        <button type="button" class="hamburger" onclick="toggleSidebar()" aria-label="Buka menu navigasi">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="3" y1="6" x2="21" y2="6"/>
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

    {{-- Right: date · mailbox · user · logout --}}
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

        @if(Auth::check() && Auth::user()->isDpn())
            <button type="button" onclick="openBackupChoiceModal()" class="topbar-backup-btn" title="Opsi Backup System & Database">
                <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="flex-shrink:0;"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                <span>Backup DB</span>
            </button>

            <!-- MODAL PILIHAN BACKUP -->
            <div id="backupChoiceModal" style="display: none; position: fixed; inset: 0; background: rgba(15, 23, 42, 0.65); backdrop-filter: blur(4px); z-index: 99999; align-items: center; justify-content: center; padding: 16px; overflow-y: auto;">
                <div style="background: #ffffff; border-radius: 16px; width: 100%; max-width: 460px; max-height: calc(100vh - 32px); display: flex; flex-direction: column; box-shadow: 0 20px 50px rgba(0,0,0,0.35); overflow: hidden; border: 1px solid #E2E8F0; text-align: left; margin: auto; animation: modalPop 0.25s cubic-bezier(0.34, 1.56, 0.64, 1);">
                    <div style="background: linear-gradient(135deg, #0F172A 0%, #1E293B 100%); padding: 16px 20px; color: #ffffff; display: flex; align-items: center; justify-content: space-between; flex-shrink: 0;">
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <span style="font-size: 20px;">💾</span>
                            <div>
                                <h3 style="font-size: 15px; font-weight: 800; margin: 0; color: #ffffff;">Opsi Backup System & Database</h3>
                                <div style="font-size: 11.5px; color: #94A3B8;">Pilih metode unduh langsung atau via email</div>
                            </div>
                        </div>
                        <button type="button" onclick="closeBackupChoiceModal()" style="background: rgba(255,255,255,0.15); border: none; color: #fff; width: 28px; height: 28px; border-radius: 50%; cursor: pointer; font-size: 14px; display: flex; align-items: center; justify-content: center;">✕</button>
                    </div>

                    <div style="padding: 18px 20px; display: flex; flex-direction: column; gap: 14px; overflow-y: auto;">
                        
                        <!-- SEKSI 1: DOWNLOAD LANGSUNG -->
                        <div>
                            <div style="font-size: 10.5px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px; color: #64748B; margin-bottom: 8px; display: flex; align-items: center; gap: 6px;">
                                📥 UNDUH LANGSUNG KE PERANGKAT
                            </div>
                            <div style="display: flex; flex-direction: column; gap: 8px;">
                                <!-- Opsi 1: SQL Only -->
                                <a href="{{ route('admin_dpn.backup_database_sql') }}" onclick="closeBackupChoiceModal()" style="display: flex; align-items: center; gap: 12px; padding: 12px 14px; border: 1.5px solid #E2E8F0; border-radius: 10px; text-decoration: none; background: #F8FAFC; transition: all 0.2s;" onmouseover="this.style.borderColor='#3B82F6'; this.style.background='#EFF6FF';" onmouseout="this.style.borderColor='#E2E8F0'; this.style.background='#F8FAFC';">
                                    <div style="width: 36px; height: 36px; background: #DBEAFE; color: #1D4ED8; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 16px; flex-shrink: 0;">
                                        ⚡
                                    </div>
                                    <div style="flex: 1;">
                                        <div style="font-size: 13px; font-weight: 700; color: #0F172A;">Download Database SQL (~2 MB)</div>
                                        <div style="font-size: 11px; color: #64748B; margin-top: 1px;">Sangat Cepat & Ringan. Berisi data tabel DB (User, Permohonan, Tracking, Ulasan).</div>
                                    </div>
                                </a>

                                <!-- Opsi 2: Full ZIP -->
                                <a href="{{ route('admin_dpn.backup_database') }}" onclick="closeBackupChoiceModal()" style="display: flex; align-items: center; gap: 12px; padding: 12px 14px; border: 1.5px solid #E2E8F0; border-radius: 10px; text-decoration: none; background: #F8FAFC; transition: all 0.2s;" onmouseover="this.style.borderColor='#10B981'; this.style.background='#ECFDF5';" onmouseout="this.style.borderColor='#E2E8F0'; this.style.background='#F8FAFC';">
                                    <div style="width: 36px; height: 36px; background: #D1FAE5; color: #047857; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 16px; flex-shrink: 0;">
                                        📦
                                    </div>
                                    <div style="flex: 1;">
                                        <div style="font-size: 13px; font-weight: 700; color: #0F172A;">Download Full ZIP (~874 MB)</div>
                                        <div style="font-size: 11px; color: #64748B; margin-top: 1px;">Komplit. Database SQL + Seluruh Berkas PDF & Gambar Upload 5 Layanan.</div>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <!-- SEKSI 2: KIRIM EMAIL -->
                        <div>
                            <div style="font-size: 10.5px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px; color: #64748B; margin-bottom: 8px; display: flex; align-items: center; gap: 6px;">
                                ✉️ PENGIRIMAN VIA EMAIL
                            </div>
                            <form action="{{ route('admin_dpn.send_backup_email') }}" method="POST" style="margin: 0;">
                                @csrf
                                <button type="submit" onclick="closeBackupChoiceModal()" style="width: 100%; text-align: left; display: flex; align-items: center; gap: 12px; padding: 12px 14px; border: 1.5px solid #E2E8F0; border-radius: 10px; background: #F8FAFC; cursor: pointer; transition: all 0.2s;" onmouseover="this.style.borderColor='#8B5CF6'; this.style.background='#F5F3FF';" onmouseout="this.style.borderColor='#E2E8F0'; this.style.background='#F8FAFC';">
                                    <div style="width: 36px; height: 36px; background: #EDE9FE; color: #6D28D9; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 16px; flex-shrink: 0;">
                                        📧
                                    </div>
                                    <div style="flex: 1;">
                                        <div style="font-size: 13px; font-weight: 700; color: #0F172A;">Kirim Salinan Database SQL ke Email</div>
                                        <div style="font-size: 11px; color: #64748B; margin-top: 1px;">Dikirim ke <strong>penataanpertanahanmiko@gmail.com</strong> (Auto 3 hari sekali).</div>
                                    </div>
                                </button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

            <script>
                function openBackupChoiceModal() {
                    const modal = document.getElementById('backupChoiceModal');
                    if (modal) modal.style.display = 'flex';
                }
                function closeBackupChoiceModal() {
                    const modal = document.getElementById('backupChoiceModal');
                    if (modal) modal.style.display = 'none';
                }
            </script>
        @endif

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
                    src="{{ route('file.view', ['path' => Auth::user()->profile_photo]) }}"
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

        {{-- Topbar Logout Button --}}
        @if(Auth::check())
        <form action="{{ route('logout') }}" method="POST" style="margin: 0; display: inline-flex;">
            @csrf
            <button type="submit" class="topbar-logout-btn" title="Keluar dari Akun">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width: 15px; height: 15px;">
                    <path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/>
                    <polyline points="16 17 21 12 16 7"/>
                    <line x1="21" y1="12" x2="9" y2="12"/>
                </svg>
                <span>Keluar</span>
            </button>
        </form>
        @endif

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
<div id="toast-container" style="position: fixed; bottom: 24px; right: 24px; z-index: 9999; display: flex; flex-direction: column; gap: 12px; pointer-events: none; max-width: calc(100vw - 32px);"></div>

<style>
/* Toast Notification Styles */
.toast-notif {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(13, 45, 79, 0.15);
    border: 1px solid rgba(13, 45, 79, 0.1);
    padding: 16px;
    width: 320px;
    max-width: calc(100vw - 32px);
    display: flex;
    align-items: flex-start;
    gap: 12px;
    transform: translateX(120%);
    opacity: 0;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    pointer-events: auto;
    box-sizing: border-box;
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
.toast-content { flex: 1; min-width: 0; }
.toast-title { font-weight: 700; font-size: 13.5px; color: var(--ink); margin-bottom: 4px; line-height: 1.3; }
.toast-message { font-size: 12px; color: #5a7a9a; line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
.toast-close {
    background: none; border: none; color: #a0aec0; cursor: pointer; padding: 4px; border-radius: 6px; transition: 0.2s; flex-shrink: 0; display: flex; align-items: center; justify-content: center;
}
.toast-close:hover { background: #f1f5f9; color: #4a5568; }

@media (max-width: 480px) {
    #toast-container { left: 16px; right: 16px; bottom: 16px; max-width: none; }
    .toast-notif { width: 100%; }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let notifiedIds = JSON.parse(localStorage.getItem('notified_mailbox_ids')) || [];
    let toastQueue = [];
    let isShowingToast = false;

    function showToast(mailbox) {
        const container = document.getElementById('toast-container');
        if (!container) return;

        // Remove any existing toasts first
        container.querySelectorAll('.toast-notif').forEach(el => {
            el.classList.remove('show');
            setTimeout(() => el.remove(), 300);
        });

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

        if (mailbox.link) {
            toast.querySelector('.toast-content').style.cursor = 'pointer';
            toast.querySelector('.toast-content').addEventListener('click', () => {
                window.location.href = mailbox.link;
            });
        }

        container.appendChild(toast);
        requestAnimationFrame(() => toast.classList.add('show'));

        const timer = setTimeout(() => {
            toast.classList.remove('show');
            setTimeout(() => toast.remove(), 400);
        }, 4000);

        // Cancel auto-dismiss on hover
        toast.addEventListener('mouseenter', () => clearTimeout(timer));
        toast.addEventListener('mouseleave', () => {
            setTimeout(() => {
                toast.classList.remove('show');
                setTimeout(() => toast.remove(), 400);
            }, 1500);
        });
    }

    function showSummaryToast(count, firstItem) {
        const container = document.getElementById('toast-container');
        if (!container) return;

        container.querySelectorAll('.toast-notif').forEach(el => {
            el.classList.remove('show');
            setTimeout(() => el.remove(), 300);
        });

        const toast = document.createElement('div');
        toast.className = 'toast-notif';

        let iconHtml = `<svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>`;

        toast.innerHTML = `
            <div class="toast-icon" style="background: rgba(220, 38, 38, 0.1); color: #dc2626;">${iconHtml}</div>
            <div class="toast-content" style="cursor: pointer;">
                <div class="toast-title">${count} Notifikasi Baru</div>
                <div class="toast-message">Klik untuk melihat seluruh kotak masuk Anda.</div>
            </div>
            <button class="toast-close" onclick="this.closest('.toast-notif').remove()">
                <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        `;

        toast.querySelector('.toast-content').addEventListener('click', () => {
            window.location.href = '{{ route("mailbox.index") }}';
        });

        container.appendChild(toast);
        requestAnimationFrame(() => toast.classList.add('show'));

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
                const currentUnreadIds = res.data.map(item => item.id);
                
                // Find new items not yet shown
                const newItems = res.data.filter(item => !notifiedIds.includes(item.id));

                if (newItems.length === 1) {
                    showToast(newItems[0]);
                } else if (newItems.length > 1) {
                    showSummaryToast(newItems.length, newItems[0]);
                }

                // Mark all new items as notified
                newItems.forEach(item => notifiedIds.push(item.id));

                // Cleanup IDs no longer unread
                notifiedIds = notifiedIds.filter(id => currentUnreadIds.includes(id));
                localStorage.setItem('notified_mailbox_ids', JSON.stringify(notifiedIds));
                
                // Update badge count in topbar
                const badge = document.querySelector('.topbar-notif-badge');
                if (badge) {
                    badge.textContent = currentUnreadIds.length > 99 ? '99+' : currentUnreadIds.length;
                    badge.style.display = currentUnreadIds.length === 0 ? 'none' : 'flex';
                }
            }
        })
        .catch(err => console.error('Gagal memuat notifikasi AJAX:', err));
    }

    setInterval(checkNotifications, 15000);
    checkNotifications();
});
</script>