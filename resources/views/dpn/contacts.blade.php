<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Kontak Admin Instansi — PATEN PAK MIKO</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --blue:    #218AC9;
            --blue-dk: #003B64;
            --blue-lt: #E3F0F9;
            --green:   #85C341;
            --yellow:  #FFCB05;
            --ink:     #003B64;
            --muted:   #7A9BB5;
            --line:    #D6E4EF;
            --surface: #F0F6FB;
            --white:   #FFFFFF;
            --r-md:    10px;
            --r-lg:    16px;
        }
        body { font-family: 'Poppins', sans-serif; background: var(--surface); color: var(--ink); min-height: 100vh; }

        /* ─── HEADER ──────────────────────────────── */
        header { background: var(--white); border-bottom: 2px solid var(--line); padding: 0 32px; height: 64px; display: flex; align-items: center; justify-content: space-between; position: sticky; top: 0; z-index: 100; }
        .logo { display: flex; align-items: center; gap: 12px; text-decoration: none; }
        .logo-icon { width: 38px; height: 38px; background: linear-gradient(135deg, var(--blue) 0%, var(--blue-dk) 100%); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: white; font-weight: 800; font-size: 14px; }
        .logo-text { font-weight: 800; font-size: 15px; color: var(--blue-dk); }
        .logo-sub { font-size: 11px; font-weight: 500; color: var(--muted); }
        .back-btn { display: inline-flex; align-items: center; gap: 6px; font-size: 13px; font-weight: 600; color: var(--blue); text-decoration: none; padding: 8px 14px; border-radius: var(--r-md); background: var(--blue-lt); transition: background 0.2s; }
        .back-btn:hover { background: #C8E0F0; }

        /* ─── MAIN ──────────────────────────────────── */
        main { max-width: 760px; margin: 0 auto; padding: 32px 24px; }

        /* ─── ALERT ─────────────────────────────────── */
        .alert-success { display: flex; align-items: center; gap: 10px; background: #F0FFF4; border: 1.5px solid #9AE6B4; color: #276749; border-radius: var(--r-md); padding: 12px 16px; font-size: 13.5px; font-weight: 600; margin-bottom: 24px; }
        .alert-error { background: #FFF5F5; border: 1.5px solid #FEB2B2; color: #C53030; border-radius: var(--r-md); padding: 12px 16px; font-size: 13.5px; margin-bottom: 24px; }

        /* ─── CARD ──────────────────────────────────── */
        .card { background: var(--white); border: 1.5px solid var(--line); border-radius: var(--r-lg); padding: 28px; margin-bottom: 20px; }
        .card-header { display: flex; align-items: flex-start; gap: 14px; margin-bottom: 24px; padding-bottom: 20px; border-bottom: 1.5px solid var(--line); }
        .card-icon { width: 46px; height: 46px; border-radius: var(--r-md); display: flex; align-items: center; justify-content: center; font-size: 20px; flex-shrink: 0; }
        .card-title { font-size: 17px; font-weight: 800; color: var(--blue-dk); line-height: 1.3; }
        .card-subtitle { font-size: 13px; color: var(--muted); margin-top: 3px; line-height: 1.5; }

        /* ─── CONTACT ITEMS ─────────────────────────── */
        .contacts-grid { display: grid; gap: 18px; }
        .contact-item { display: grid; grid-template-columns: auto 1fr; gap: 16px; align-items: center; padding: 18px; border: 1.5px solid var(--line); border-radius: var(--r-md); background: var(--surface); transition: border-color 0.2s, background 0.2s; }
        .contact-item:focus-within { border-color: var(--blue); background: var(--white); box-shadow: 0 0 0 3px rgba(33,138,201,0.10); }
        .contact-badge { width: 44px; height: 44px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 16px; font-weight: 800; color: white; flex-shrink: 0; }
        .bg-bpn     { background: linear-gradient(135deg, #218AC9, #003B64); }
        .bg-putr    { background: linear-gradient(135deg, #ED8936, #C05621); }
        .bg-pu      { background: linear-gradient(135deg, #38A169, #276749); }
        .bg-ptsp    { background: linear-gradient(135deg, #805AD5, #553C9A); }
        .contact-info { flex: 1; }
        .contact-label { font-size: 13.5px; font-weight: 700; color: var(--blue-dk); margin-bottom: 4px; }
        .contact-desc { font-size: 11.5px; color: var(--muted); margin-bottom: 10px; line-height: 1.5; }
        .contact-input { width: 100%; padding: 9px 12px; border: 1.5px solid var(--line); border-radius: 8px; font-size: 13.5px; font-family: 'DM Mono', monospace; font-weight: 500; background: white; color: var(--blue-dk); outline: none; transition: border-color 0.2s; }
        .contact-input:focus { border-color: var(--blue); box-shadow: 0 0 0 3px rgba(33,138,201,0.10); }
        .contact-current { font-size: 11px; color: var(--muted); margin-top: 5px; font-family: 'DM Mono', monospace; }
        .contact-current strong { color: var(--green); }

        /* ─── INFO BOX ──────────────────────────────── */
        .info-box { background: var(--blue-lt); border: 1.5px solid #A9CFEA; border-radius: var(--r-md); padding: 14px 16px; margin-bottom: 24px; }
        .info-box p { font-size: 12.5px; color: var(--blue-dk); line-height: 1.65; }
        .info-box strong { font-weight: 700; }
        .info-table { width: 100%; border-collapse: collapse; margin-top: 10px; font-size: 12px; }
        .info-table th { background: rgba(33,138,201,0.12); color: var(--blue-dk); padding: 6px 10px; text-align: left; font-weight: 700; border-radius: 4px; }
        .info-table td { padding: 6px 10px; color: var(--ink); border-bottom: 1px solid rgba(33,138,201,0.12); vertical-align: top; }
        .info-table tr:last-child td { border-bottom: none; }

        /* ─── SUBMIT ────────────────────────────────── */
        .btn-save { display: inline-flex; align-items: center; gap: 8px; background: linear-gradient(135deg, var(--blue) 0%, var(--blue-dk) 100%); color: white; font-size: 14px; font-weight: 700; border: none; border-radius: var(--r-md); padding: 13px 28px; cursor: pointer; letter-spacing: 0.2px; transition: transform 0.15s, box-shadow 0.15s; }
        .btn-save:hover { transform: translateY(-1px); box-shadow: 0 6px 20px rgba(33,138,201,0.35); }
        .btn-secondary { display: inline-flex; align-items: center; gap: 8px; background: var(--surface); color: var(--blue-dk); font-size: 13px; font-weight: 600; border: 1.5px solid var(--line); border-radius: var(--r-md); padding: 11px 20px; cursor: pointer; text-decoration: none; transition: background 0.2s; }
        .btn-secondary:hover { background: var(--blue-lt); }
        .form-actions { display: flex; align-items: center; gap: 12px; margin-top: 24px; padding-top: 20px; border-top: 1.5px solid var(--line); }
    </style>
</head>
<body>

<header>
    <a href="{{ route('dashboard') }}" class="logo">
        <div class="logo-icon">PM</div>
        <div>
            <div class="logo-text">PATEN PAK MIKO</div>
            <div class="logo-sub">Kantor Pertanahan Kota Pangkalpinang</div>
        </div>
    </a>
    <a href="{{ route('dashboard') }}" class="back-btn">
        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Kembali ke Dashboard
    </a>
</header>

<main>

    @if(session('success'))
        <div class="alert-success">
            <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert-error">
            @foreach($errors->all() as $err)<div>⚠ {{ $err }}</div>@endforeach
        </div>
    @endif

    <!-- Info Box -->
    <div class="info-box">
        <p><strong>📋 Panduan Pengaturan Kontak Notifikasi WhatsApp</strong><br>
        Nomor HP yang diisi di sini akan digunakan sebagai tujuan blast notifikasi WA otomatis ke masing-masing instansi pada setiap tahapan alur. Gunakan format nomor tanpa tanda + atau spasi (cukup angka saja, awali 62 atau 08).</p>
        <table class="info-table" style="margin-top: 12px;">
            <tr>
                <th>Instansi</th>
                <th>Kapan menerima notifikasi?</th>
            </tr>
            <tr>
                <td><strong>Admin BPN</strong></td>
                <td>Saat berkas diajukan, saat PUTR validasi selesai, saat PU penilaian selesai</td>
            </tr>
            <tr>
                <td><strong>Admin PUTR</strong></td>
                <td>Saat BPN setujui berkas (Berusaha) — untuk melakukan validasi awal permohonan</td>
            </tr>
            <tr>
                <td><strong>Admin Dinas PU</strong></td>
                <td>Saat Pertek BPN terbit (Berusaha & Non-Berusaha) — untuk penilaian PKKPR</td>
            </tr>
            <tr>
                <td><strong>Admin Satu Pintu (PTSP)</strong></td>
                <td>Saat penilaian Dinas PU selesai — untuk penerbitan PKKPR resmi</td>
            </tr>
        </table>
    </div>

    <!-- Form -->
    <form action="{{ route('dpn.contacts.save') }}" method="POST">
        @csrf
        <div class="card">
            <div class="card-header">
                <div class="card-icon" style="background: linear-gradient(135deg, #EBF8FF, #BEE3F8);">📞</div>
                <div>
                    <div class="card-title">Nomor HP Admin Instansi Terkait</div>
                    <div class="card-subtitle">Atur nomor HP penerima notifikasi WhatsApp blast untuk setiap instansi yang terlibat dalam alur PKKPR.</div>
                </div>
            </div>

            <div class="contacts-grid">

                <!-- BPN -->
                <div class="contact-item">
                    <div class="contact-badge bg-bpn">BPN</div>
                    <div class="contact-info">
                        <div class="contact-label">Admin Kantor Pertanahan (BPN)</div>
                        <div class="contact-desc">Menerima notif: pengajuan baru, validasi PUTR selesai, penilaian PU selesai. Berperan di semua alur layanan.</div>
                        <input type="text" name="admin_bpn" class="contact-input" id="admin_bpn"
                               placeholder="cth: 6281234567890"
                               value="{{ old('admin_bpn', $settings['admin_bpn'] ?? '') }}"
                               inputmode="numeric">
                        @if(!empty($settings['admin_bpn']))
                            <div class="contact-current">Tersimpan: <strong>{{ $settings['admin_bpn'] }}</strong></div>
                        @else
                            <div class="contact-current" style="color: #E53E3E;">⚠ Belum diisi — notif ke BPN menggunakan nomor fallback.</div>
                        @endif
                    </div>
                </div>

                <!-- PUTR -->
                <div class="contact-item">
                    <div class="contact-badge bg-putr">PUTR</div>
                    <div class="contact-info">
                        <div class="contact-label">Admin Dinas PUTR (Pekerjaan Umum & Tata Ruang)</div>
                        <div class="contact-desc">Khusus alur PKKPR Berusaha — menerima notif saat BPN menyetujui berkas, sebagai penanda untuk melakukan validasi awal permohonan.</div>
                        <input type="text" name="admin_putr" class="contact-input" id="admin_putr"
                               placeholder="cth: 6281234567891"
                               value="{{ old('admin_putr', $settings['admin_putr'] ?? '') }}"
                               inputmode="numeric">
                        @if(!empty($settings['admin_putr']))
                            <div class="contact-current">Tersimpan: <strong>{{ $settings['admin_putr'] }}</strong></div>
                        @else
                            <div class="contact-current" style="color: #E53E3E;">⚠ Belum diisi — notif ke PUTR menggunakan nomor fallback.</div>
                        @endif
                    </div>
                </div>

                <!-- Dinas PU -->
                <div class="contact-item">
                    <div class="contact-badge bg-pu">PU</div>
                    <div class="contact-info">
                        <div class="contact-label">Admin Dinas PU (Tata Ruang & Penilaian PKKPR)</div>
                        <div class="contact-desc">Menerima notif saat Pertek BPN terbit (Berusaha & Non-Berusaha) — sebagai trigger untuk melakukan penilaian PKKPR.</div>
                        <input type="text" name="admin_dinas_pu" class="contact-input" id="admin_dinas_pu"
                               placeholder="cth: 6281234567892"
                               value="{{ old('admin_dinas_pu', $settings['admin_dinas_pu'] ?? '') }}"
                               inputmode="numeric">
                        @if(!empty($settings['admin_dinas_pu']))
                            <div class="contact-current">Tersimpan: <strong>{{ $settings['admin_dinas_pu'] }}</strong></div>
                        @else
                            <div class="contact-current" style="color: #E53E3E;">⚠ Belum diisi — notif ke Dinas PU menggunakan nomor fallback.</div>
                        @endif
                    </div>
                </div>

                <!-- Satu Pintu / PTSP -->
                <div class="contact-item">
                    <div class="contact-badge bg-ptsp">SP</div>
                    <div class="contact-info">
                        <div class="contact-label">Admin Satu Pintu / PTSP (Penerbitan PKKPR)</div>
                        <div class="contact-desc">Menerima notif saat penilaian Dinas PU selesai (Berusaha & Non-Berusaha) — sebagai trigger untuk menerbitkan PKKPR resmi.</div>
                        <input type="text" name="admin_satu_pintu" class="contact-input" id="admin_satu_pintu"
                               placeholder="cth: 6281234567893"
                               value="{{ old('admin_satu_pintu', $settings['admin_satu_pintu'] ?? '') }}"
                               inputmode="numeric">
                        @if(!empty($settings['admin_satu_pintu']))
                            <div class="contact-current">Tersimpan: <strong>{{ $settings['admin_satu_pintu'] }}</strong></div>
                        @else
                            <div class="contact-current" style="color: #E53E3E;">⚠ Belum diisi — notif ke Satu Pintu menggunakan nomor fallback.</div>
                        @endif
                    </div>
                </div>

            <!-- CP Admin (Pemohon) -->
                <div class="contact-item">
                    <div class="contact-badge" style="background: var(--clr-ink); color: white;">CP</div>
                    <div class="contact-info">
                        <div class="contact-label">Contact Person Admin (WA Blast Pemohon)</div>
                        <div class="contact-desc">Nomor ini akan di-blast dan otomatis disisipkan di setiap akhir pesan WhatsApp yang terkirim ke pemohon (Sebagai kontak bantuan).</div>
                        <input type="text" name="cp_admin" class="contact-input" id="cp_admin"
                               placeholder="cth: 081234567890"
                               value="{{ old('cp_admin', $settings['cp_admin'] ?? '') }}"
                               inputmode="numeric">
                        @if(!empty($settings['cp_admin']))
                            <div class="contact-current">Tersimpan: <strong>{{ $settings['cp_admin'] }}</strong></div>
                        @else
                            <div class="contact-current" style="color: #E53E3E;">Belum diisi - Info CP Admin tidak akan disisipkan di pesan pemohon.</div>
                        @endif
                    </div>
                </div>

            </div>

            <div class="form-actions">
                <button type="submit" class="btn-save">
                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                    Simpan Semua Kontak Admin
                </button>

            </div>
        </div>
    </form>

</main>
</body>
</html>
