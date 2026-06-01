<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar LAPOLPAK — PATEN PAK MIKO</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --blue: #218AC9;
            --blue-dk: #003B64;
            --ink: #003B64;
            --muted: #7A9BB5;
            --line: #D6E4EF;
            --surface: #F0F6FB;
            --white: #FFFFFF;
            --r-md: 10px;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: var(--surface); color: var(--ink); display: flex; flex-direction: column; min-height: 100vh; align-items: center; justify-content: center; padding: 20px; }
        .logo-wrap { display: flex; align-items: center; gap: 12px; text-decoration: none; margin-bottom: 24px; }
        .logo-icon { width: 44px; height: 44px; background: var(--blue); border-radius: var(--r-md); display: flex; align-items: center; justify-content: center; }
        .logo-icon svg { width: 22px; height: 22px; fill: none; stroke: #fff; stroke-width: 2; }
        .logo-text strong { display: block; font-size: 16px; font-weight: 800; color: var(--ink); }
        .logo-text span { font-size: 11px; font-weight: 600; color: var(--muted); text-transform: uppercase; }
        .card { background: var(--white); border: 1px solid var(--line); border-radius: 16px; width: 100%; max-width: 540px; padding: 32px; box-shadow: 0 10px 30px rgba(0,59,100,0.05); }
        .card-header { text-align: center; margin-bottom: 24px; }
        .card-header h1 { font-size: 20px; font-weight: 800; margin-bottom: 8px; }
        .card-header p { font-size: 13.5px; color: var(--muted); line-height: 1.5; }
        .form-group { margin-bottom: 18px; }
        .form-label { display: block; font-size: 13px; font-weight: 600; margin-bottom: 8px; }
        .form-label span { color: #E53E3E; }
        .form-control { width: 100%; padding: 12px 16px; font-family: inherit; font-size: 14px; border: 1.5px solid var(--line); border-radius: var(--r-md); outline: none; transition: border .2s; }
        .form-control:focus { border-color: var(--blue); }
        .btn { display: flex; align-items: center; justify-content: center; gap: 8px; width: 100%; padding: 14px; background: var(--blue); color: #fff; border: none; border-radius: var(--r-md); font-family: inherit; font-size: 15px; font-weight: 700; cursor: pointer; transition: background .2s; }
        .btn:hover { background: var(--blue-dk); }
        .btn svg { width: 18px; height: 18px; fill: none; stroke: currentColor; stroke-width: 2.5; stroke-linecap: round; }
        .alert { padding: 14px 16px; border-radius: var(--r-md); font-size: 13.5px; font-weight: 500; margin-bottom: 20px; display: flex; gap: 10px; }
        .alert svg { width: 20px; height: 20px; flex-shrink: 0; }
        .alert-success { background: #E6F4EA; border: 1px solid #B8E2C8; color: #137333; }
        .alert-error { background: #FCE8E6; border: 1px solid #F8B4B4; color: #C5221F; }
        .back-link { display: inline-flex; align-items: center; gap: 6px; font-size: 13px; font-weight: 600; color: var(--muted); text-decoration: none; margin-top: 24px; }
        .back-link:hover { color: var(--blue); }
    </style>
</head>
<body>

    <a href="/" class="logo-wrap">
        <div class="logo-icon">
            <svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
        </div>
        <div class="logo-text">
            <strong>PATEN PAK MIKO</strong>
            <span>Kantor Pertanahan Sukabumi</span>
        </div>
    </a>

    <div class="card">
        <div class="card-header">
            <h1>Layanan LAPOLPAK</h1>
            <p>Layanan konsultasi dan pembuatan polygon gratis di kantor. Silakan isi form di bawah untuk membuat jadwal.</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                {{ session('success') }}
            </div>
        @endif
        @if($errors->any())
            <div class="alert alert-error">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                <div>@foreach($errors->all() as $error)<p>{{ $error }}</p>@endforeach</div>
            </div>
        @endif

        <form action="{{ route('lapolpa.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label" for="nama_pemohon">Nama Pengaju <span>*</span></label>
                <input type="text" name="nama_pemohon" id="nama_pemohon" class="form-control" value="{{ old('nama_pemohon') }}" required placeholder="Masukkan nama lengkap Anda">
            </div>
            <div class="form-group">
                <label class="form-label" for="whatsapp_number">Nomor WhatsApp Aktif <span>*</span></label>
                <input type="text" name="whatsapp_number" id="whatsapp_number" class="form-control" value="{{ old('whatsapp_number') }}" required placeholder="Contoh: 081234567890">
            </div>
            <div class="form-group" style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
                <div>
                    <label class="form-label" for="booking_date">Tanggal <span>*</span></label>
                    <input type="date" name="booking_date" id="booking_date" class="form-control" min="{{ date('Y-m-d') }}" value="{{ old('booking_date') }}" required>
                </div>
                <div>
                    <label class="form-label" for="time_range">Waktu <span>*</span></label>
                    <select name="time_range" id="time_range" class="form-control" required>
                        <option value="">-- Pilih Waktu --</option>
                        <option value="08:00 - 10:00" {{ old('time_range') == '08:00 - 10:00' ? 'selected' : '' }}>08:00 - 10:00</option>
                        <option value="10:00 - 12:00" {{ old('time_range') == '10:00 - 12:00' ? 'selected' : '' }}>10:00 - 12:00</option>
                        <option value="13:00 - 15:00" {{ old('time_range') == '13:00 - 15:00' ? 'selected' : '' }}>13:00 - 15:00</option>
                    </select>
                </div>
            </div>
            
            <button type="submit" class="btn">
                <svg viewBox="0 0 24 24"><path d="M22 2L11 13M22 2l-7 20-4-9-9-4 20-7z"/></svg>
                Kirim Jadwal Booking
            </button>
        </form>
    </div>

    <a href="/" class="back-link">
        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
        Kembali ke Beranda
    </a>

</body>
</html>
