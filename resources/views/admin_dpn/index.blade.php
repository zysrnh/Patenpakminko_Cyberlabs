@extends('layouts.app')

@section('title', 'Kelola Statistik Web - PATEN PAK MIKO')
@section('page-title', 'Statistik Web')

@section('content')
<!-- Header Card -->
<div style="background: #ffffff; border: 1px solid #E2E8F0; border-radius: 6px; padding: 18px 24px; margin-bottom: 20px; box-shadow: 0 2px 6px rgba(0,38,66,0.02); display: flex; align-items: center; justify-content: space-between; gap: 16px; flex-wrap: wrap;">
    <div>
        <div style="font-size: 12px; color: #64748B; margin-bottom: 4px; display: flex; align-items: center; gap: 6px;">
            <a href="{{ route('dashboard') }}" style="color: #218AC9; text-decoration: none; font-weight: 600;">Dashboard</a>
            <span>›</span>
            <span style="color: #64748B;">Statistik Web (Admin DPN)</span>
        </div>
        <h1 style="font-size: 19px; font-weight: 800; color: #003B64; letter-spacing: -0.02em; margin: 0;">
            Kelola Statistik Beranda & Backup Database
        </h1>
        <p style="font-size: 12.5px; color: #64748B; margin: 4px 0 0;">Atur nilai statistik utama beranda & unduh salinan backup cadangan seluruh data database.</p>
    </div>
    <div>
        <a href="{{ route('admin_dpn.backup_database') }}" class="btn" style="background: #2563EB; color: #ffffff; font-weight: 700; font-size: 13px; padding: 10px 18px; border-radius: 6px; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; box-shadow: 0 2px 4px rgba(37,99,235,0.2);" title="Download salinan database SQL lengkap">
            <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
            Download Backup Database (.SQL)
        </a>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success" style="border-radius: 4px; margin-bottom: 20px;">
        <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <span>{{ session('success') }}</span>
    </div>
@endif

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 20px; align-items: start;">
    <!-- Card Kelola Statistik -->
    <div class="panel" style="border-radius: 6px; border: 1px solid #E2E8F0; box-shadow: 0 2px 6px rgba(0,38,66,0.02); overflow: hidden; background: #ffffff;">
        <div class="panel-head" style="padding: 14px 18px; border-bottom: 1px solid #E2E8F0; background: #F8FAFC;">
            <h2 style="font-size: 15px; font-weight: 800; color: #003B64; margin: 0; display: flex; align-items: center; gap: 8px;">
                <svg width="17" height="17" fill="none" viewBox="0 0 24 24" stroke="#218AC9" stroke-width="2.2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><line x1="3" y1="9" x2="21" y2="9"/><line x1="9" y1="21" x2="9" y2="9"/></svg>
                Pengaturan Angka Statistik Beranda
            </h2>
        </div>
        <div class="panel-body" style="padding: 20px;">
            <form action="{{ route('admin_dpn.update') }}" method="POST">
                @csrf
                
                <div class="form-group" style="margin-bottom: 16px;">
                    <label class="form-label" style="font-weight: 700; font-size: 12.5px; color: #003B64; margin-bottom: 6px; display: block;">
                        1. Override Permohonan Diproses <span style="font-weight: 500; color: #64748B;">(Opsional)</span>
                    </label>
                    <input type="text" name="permohonan_diproses" class="form-control" value="{{ $stats['permohonan_diproses'] ?? '' }}" placeholder="Biarkan kosong untuk otomatis hitung dari database..." style="border-radius: 4px; border: 1.5px solid #CBD5E1; padding: 8px 12px; font-size: 13px;">
                    <div style="font-size: 11.5px; color: #64748B; margin-top: 4px; line-height: 1.4;">
                        Jika <strong>dikosongkan</strong> → otomatis hitung total permohonan real dari semua layanan di database.<br>
                        Jika <strong>diisi</strong> (misal: <code>12k</code> atau <code>0</code>) → nilai tersebut yang tampil di beranda.
                    </div>
                </div>

                <div class="form-group" style="margin-bottom: 16px;">
                    <label class="form-label" style="font-weight: 700; font-size: 12.5px; color: #003B64; margin-bottom: 6px; display: block;">
                        2. Rata-rata Penyelesaian
                    </label>
                    <input type="text" name="rata_rata_penyelesaian" class="form-control" value="{{ $stats['rata_rata_penyelesaian'] ?? '10 hari' }}" placeholder="Contoh: 10 hari" required style="border-radius: 4px; border: 1.5px solid #CBD5E1; padding: 8px 12px; font-size: 13px;">
                    <div style="font-size: 11.5px; color: #64748B; margin-top: 4px;">Durasi rata-rata penyelesaian permohonan.</div>
                </div>

                <div class="form-group" style="margin-bottom: 16px;">
                    <label class="form-label" style="font-weight: 700; font-size: 12.5px; color: #003B64; margin-bottom: 6px; display: block;">
                        3. Override Rata-rata Rating <span style="font-weight: 500; color: #64748B;">(Opsional)</span>
                    </label>
                    <input type="text" name="rating_override" class="form-control" value="{{ $stats['rating_override'] ?? '' }}" placeholder="Biarkan kosong untuk otomatis hitung dari ulasan (misal: 5.0/5)" style="border-radius: 4px; border: 1.5px solid #CBD5E1; padding: 8px 12px; font-size: 13px;">
                    <div style="font-size: 11.5px; color: #64748B; margin-top: 4px;">Jika diisi, nilai ini akan meng-override hitungan otomatis ulasan.</div>
                </div>

                <div class="form-group" style="margin-bottom: 20px;">
                    <label class="form-label" style="font-weight: 700; font-size: 12.5px; color: #003B64; margin-bottom: 6px; display: block;">
                        4. Jumlah Kunjungan Pengunjung
                    </label>
                    <input type="number" name="count" class="form-control" value="{{ $stats['count'] ?? 0 }}" required style="font-size: 18px; font-weight: 800; color: #003B64; border-radius: 4px; border: 1.5px solid #CBD5E1; padding: 8px 12px;">
                    <div style="font-size: 11.5px; color: #64748B; margin-top: 4px;">Counter ini bertambah otomatis saat pengunjung baru membuka website.</div>
                </div>

                <button type="submit" class="btn btn-primary btn-full" style="border-radius: 4px; padding: 10px 16px; font-weight: 700; font-size: 13px; width: 100%;">
                    Simpan Perubahan Statistik
                </button>
            </form>
        </div>
    </div>

    <!-- Card Reset Counter -->
    <div class="panel" style="border-radius: 6px; border: 1px solid #E2E8F0; box-shadow: 0 2px 6px rgba(0,38,66,0.02); overflow: hidden; background: #ffffff; height: fit-content;">
        <div class="panel-head" style="padding: 14px 18px; border-bottom: 1px solid #FECACA; background: #FEF2F2;">
            <h2 style="font-size: 15px; font-weight: 800; color: #991B1B; margin: 0; display: flex; align-items: center; gap: 8px;">
                <svg width="17" height="17" fill="none" viewBox="0 0 24 24" stroke="#DC2626" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                Reset Counter Kunjungan
            </h2>
        </div>
        <div class="panel-body" style="padding: 20px;">
            <p style="font-size: 12.5px; color: #64748B; line-height: 1.5; margin-bottom: 16px;">
                Jika Anda ingin mengembalikan hitungan jumlah kunjungan website kembali ke <strong style="color: #0F172A;">0 (nol)</strong>, klik tombol reset di bawah ini.
            </p>

            <form action="{{ route('admin_dpn.reset_visitor') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin me-reset jumlah kunjungan pengunjung kembali ke 0?')">
                @csrf
                <button type="submit" class="btn btn-danger btn-full" style="border-radius: 4px; padding: 10px 16px; font-weight: 700; font-size: 13px; background: #DC2626; border-color: #DC2626; color: #fff; width: 100%;">
                    Reset Counter Kunjungan ke 0
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
