@extends('layouts.app')

@section('title', 'Pengaturan Kontak Admin Instansi - PATEN PAK MIKO')
@section('page-title', 'Pengaturan Kontak Notifikasi')

@section('extra-styles')
    .contact-item { display: flex; gap: 16px; align-items: flex-start; padding: 18px; border: 1px solid var(--line); border-radius: var(--r-md); background: var(--surface); margin-bottom: 16px; }
    .contact-badge { width: 44px; height: 44px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 14px; font-weight: 800; color: white; flex-shrink: 0; }
    .bg-bpn     { background: var(--blue-dk); }
    .bg-putr    { background: #C05621; }
    .bg-pu      { background: #276749; }
    .bg-ptsp    { background: #553C9A; }
    .contact-info { flex: 1; }
    .contact-label { font-size: 13.5px; font-weight: 700; color: var(--ink); margin-bottom: 4px; }
    .contact-desc { font-size: 11.5px; color: var(--muted); margin-bottom: 10px; line-height: 1.5; }
    .contact-input { width: 100%; padding: 10px 14px; border: 1.5px solid var(--line); border-radius: var(--r-md); font-size: 14px; font-family: monospace; font-weight: 500; background: white; color: var(--ink); outline: none; transition: border-color 0.2s; }
    .contact-input:focus { border-color: var(--blue); box-shadow: 0 0 0 3px var(--blue-lt); }
    .contact-current { font-size: 11px; color: var(--muted); margin-top: 5px; font-family: monospace; }
    .contact-current strong { color: var(--green-dk); }
    
    .info-box { background: var(--blue-lt); border: 1px solid #A9CFEA; border-radius: var(--r-md); padding: 16px; margin-bottom: 24px; }
    .info-box p { font-size: 12.5px; color: var(--ink); line-height: 1.65; margin-bottom: 12px;}
    .info-box strong { font-weight: 700; color: var(--blue-dk); }
    .info-table { width: 100%; border-collapse: collapse; font-size: 12px; }
    .info-table th { background: rgba(33,138,201,0.12); color: var(--blue-dk); padding: 8px 12px; text-align: left; font-weight: 700; border-radius: 4px; }
    .info-table td { padding: 8px 12px; color: var(--ink); border-bottom: 1px solid rgba(33,138,201,0.12); vertical-align: top; }
    .info-table tr:last-child td { border-bottom: none; }
@endsection

@section('content')
<div class="page-header">
    <div class="page-header-left">
        <div class="breadcrumb">
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <span>›</span>
            <span>Pengaturan Kontak Notifikasi</span>
        </div>
        <h1>
            <svg style="width:24px;height:24px;vertical-align:-4px;margin-right:8px;color:var(--blue);" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
            Pengaturan Kontak Notifikasi WhatsApp
        </h1>
        <p>Atur nomor telepon penerima notifikasi WhatsApp otomatis untuk setiap instansi terkait.</p>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <span>{{ session('success') }}</span>
    </div>
@endif

@if($errors->any())
    <div class="alert alert-error" style="display: block;">
        @foreach($errors->all() as $err)
            <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 4px;">
                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                <span>{{ $err }}</span>
            </div>
        @endforeach
    </div>
@endif

<!-- Info Box -->
<div class="info-box">
    <p>
        <strong>
            <svg style="width:16px;height:16px;vertical-align:-3px;margin-right:4px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            Panduan Pengaturan Kontak Notifikasi WhatsApp
        </strong><br>
        Nomor telepon yang diisi pada halaman ini akan digunakan sebagai tujuan pengiriman notifikasi WhatsApp otomatis kepada masing-masing instansi pada setiap tahapan alur layanan. Gunakan format angka tanpa tanda + atau spasi (contoh: 628... atau 08...).
    </p>
    <div class="table-wrap">
        <table class="info-table">
            <tr>
                <th>Instansi</th>
                <th>Kapan menerima notifikasi?</th>
            </tr>
            <tr>
                <td><strong>Admin BPN</strong></td>
                <td>Saat berkas diajukan, saat PUTR validasi selesai, dan saat PUTR penilaian selesai</td>
            </tr>
            <tr>
                <td><strong>Admin PUTR</strong></td>
                <td>Saat BPN menyetujui berkas dan saat Pertek BPN terbit — untuk validasi awal & penilaian Pertimbangan Teknis Pertanahan</td>
            </tr>
            <tr>
                <td><strong>Admin DPMPTSP</strong></td>
                <td>Saat penilaian PUTR selesai — untuk penerbitan Pertimbangan Teknis Pertanahan resmi</td>
            </tr>
            <tr>
                <td><strong>Contact Person</strong></td>
                <td>Disisipkan di setiap akhir pesan WhatsApp yang dikirimkan kepada pemohon</td>
            </tr>
        </table>
    </div>
</div>

<form action="{{ route('dpn.contacts.save') }}" method="POST">
    @csrf
    <div class="panel">
        <div class="panel-head">
            <h2>Nomor Telepon Admin Instansi Terkait</h2>
        </div>
        <div class="panel-body">
            
            <!-- BPN -->
            <div class="contact-item">
                <div class="contact-badge bg-bpn">
                    <svg width="22" height="22" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/></svg>
                </div>
                <div class="contact-info">
                    <div class="contact-label">Admin BPN</div>
                    <div class="contact-desc">Menerima notifikasi untuk: pengajuan baru, penyelesaian validasi PUTR, dan penyelesaian penilaian PUTR. Berperan dalam seluruh alur layanan.</div>
                    <input type="text" name="admin_bpn" class="contact-input" id="admin_bpn" placeholder="contoh: 6281234567890" value="{{ old('admin_bpn', $settings['admin_bpn'] ?? '') }}" inputmode="numeric">
                    @if(!empty($settings['admin_bpn']))
                        <div class="contact-current">Tersimpan: <strong>{{ $settings['admin_bpn'] }}</strong></div>
                    @else
                        <div class="contact-current" style="color: #C53030;">Belum diisi — notifikasi ke BPN akan menggunakan nomor telepon sistem (cadangan).</div>
                    @endif
                </div>
            </div>

            <!-- PUTR -->
            <div class="contact-item">
                <div class="contact-badge bg-putr">
                    <svg width="22" height="22" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/></svg>
                </div>
                <div class="contact-info">
                    <div class="contact-label">Admin PUTR</div>
                    <div class="contact-desc">Menerima notifikasi saat Pertek BPN terbit (Berusaha & Non-Berusaha) — sebagai informasi awal untuk melakukan penilaian Pertimbangan Teknis Pertanahan.</div>
                    <input type="text" name="admin_dinas_pu" class="contact-input" id="admin_dinas_pu" placeholder="contoh: 6281234567892" value="{{ old('admin_dinas_pu', $settings['admin_dinas_pu'] ?? '') }}" inputmode="numeric">
                    @if(!empty($settings['admin_dinas_pu']))
                        <div class="contact-current">Tersimpan: <strong>{{ $settings['admin_dinas_pu'] }}</strong></div>
                    @else
                        <div class="contact-current" style="color: #C53030;">Belum diisi — notifikasi ke PUTR akan menggunakan nomor telepon sistem (cadangan).</div>
                    @endif
                </div>
            </div>

            <!-- DPMPTSP -->
            <div class="contact-item">
                <div class="contact-badge bg-ptsp">
                    <svg width="22" height="22" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/></svg>
                </div>
                <div class="contact-info">
                    <div class="contact-label">Admin DPMPTSP</div>
                    <div class="contact-desc">Menerima notifikasi saat penilaian PUTR selesai (Berusaha & Non-Berusaha) — sebagai informasi untuk menerbitkan dokumen Pertimbangan Teknis Pertanahan resmi.</div>
                    <input type="text" name="admin_satu_pintu" class="contact-input" id="admin_satu_pintu" placeholder="contoh: 6281234567893" value="{{ old('admin_satu_pintu', $settings['admin_satu_pintu'] ?? '') }}" inputmode="numeric">
                    @if(!empty($settings['admin_satu_pintu']))
                        <div class="contact-current">Tersimpan: <strong>{{ $settings['admin_satu_pintu'] }}</strong></div>
                    @else
                        <div class="contact-current" style="color: #C53030;">Belum diisi — notifikasi ke DPMPTSP akan menggunakan nomor telepon sistem (cadangan).</div>
                    @endif
                </div>
            </div>

            <!-- CP Admin (Pemohon) -->
            <div class="contact-item">
                <div class="contact-badge" style="background: var(--ink); color: white;">
                    <svg width="22" height="22" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/></svg>
                </div>
                <div class="contact-info">
                    <div class="contact-label">Contact Person</div>
                    <div class="contact-desc">Nomor ini akan disisipkan secara otomatis pada setiap akhir pesan WhatsApp yang dikirimkan kepada pemohon, berfungsi sebagai kontak layanan bantuan.</div>
                    <input type="text" name="cp_admin" class="contact-input" id="cp_admin" placeholder="contoh: 081234567890" value="{{ old('cp_admin', $settings['cp_admin'] ?? '') }}" inputmode="numeric">
                    @if(!empty($settings['cp_admin']))
                        <div class="contact-current">Tersimpan: <strong>{{ $settings['cp_admin'] }}</strong></div>
                    @else
                        <div class="contact-current" style="color: #C53030;">Belum diisi — Informasi Contact Person tidak akan disisipkan pada pesan notifikasi pemohon.</div>
                    @endif
                </div>
            </div>

            <div style="margin-top: 24px; padding-top: 20px; border-top: 1px solid var(--line);">
                <button type="submit" class="btn btn-primary">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M5 13l4 4L19 7"/></svg>
                    Simpan Pengaturan Kontak
                </button>
            </div>
        </div>
    </div>
</form>
@endsection
