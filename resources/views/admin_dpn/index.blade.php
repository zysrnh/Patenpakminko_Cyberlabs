@extends('layouts.app')

@section('title', 'Kelola Statistik Web - PATEN PAK MIKO')
@section('page-title', 'Statistik Web')

@section('content')
<div class="page-header mb-4">
    <div class="page-header-left">
        <div class="breadcrumb">
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <span>›</span>
            <span>Statistik Web (Admin DPN)</span>
        </div>
        <h1>
            <svg class="title-icon" style="width: 24px; height: 24px; color: var(--blue);" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><line x1="3" y1="9" x2="21" y2="9"/><line x1="9" y1="21" x2="9" y2="9"/></svg>
            Kelola Statistik Beranda & Kunjungan
        </h1>
        <p>Atur dan reset nilai 4 angka statistik utama yang tampil di beranda publik website.</p>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success" style="margin-bottom: 24px;">
        <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <span>{{ session('success') }}</span>
    </div>
@endif

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 24px;">
    <!-- Card Kelola Statistik -->
    <div class="panel">
        <div class="panel-head">
            <h2>Pengaturan Angka Statistik Beranda</h2>
        </div>
        <div class="panel-body">
            <form action="{{ route('admin_dpn.update') }}" method="POST">
                @csrf
                
                <div class="form-group mb-3">
                    <label class="form-label" style="font-weight: 700; font-size: 13px;">1. Permohonan Diproses</label>
                    <input type="text" name="permohonan_diproses" class="form-control" value="{{ $stats['permohonan_diproses'] ?? '12k' }}" placeholder="Contoh: 12k atau 1.500" required>
                    <div style="font-size: 11px; color: #718096; margin-top: 4px;">Teks/angka permohonan diproses di beranda.</div>
                </div>

                <div class="form-group mb-3">
                    <label class="form-label" style="font-weight: 700; font-size: 13px;">2. Rata-rata Penyelesaian</label>
                    <input type="text" name="rata_rata_penyelesaian" class="form-control" value="{{ $stats['rata_rata_penyelesaian'] ?? '10 hari' }}" placeholder="Contoh: 10 hari" required>
                    <div style="font-size: 11px; color: #718096; margin-top: 4px;">Durasi rata-rata penyelesaian permohonan.</div>
                </div>

                <div class="form-group mb-3">
                    <label class="form-label" style="font-weight: 700; font-size: 13px;">3. Override Rata-rata Rating (Opsional)</label>
                    <input type="text" name="rating_override" class="form-control" value="{{ $stats['rating_override'] ?? '' }}" placeholder="Biarkan kosong untuk otomatis hitung dari ulasan (misal: 5.0/5)">
                    <div style="font-size: 11px; color: #718096; margin-top: 4px;">Jika diisi, nilai ini akan meng-override hitungan otomatis ulasan.</div>
                </div>

                <div class="form-group mb-4">
                    <label class="form-label" style="font-weight: 700; font-size: 13px;">4. Jumlah Kunjungan Pengunjung</label>
                    <input type="number" name="count" class="form-control" value="{{ $stats['count'] ?? 0 }}" required style="font-size: 20px; font-weight: 700;">
                    <div style="font-size: 11px; color: #718096; margin-top: 4px;">Counter ini bertambah otomatis saat pengunjung baru membuka website.</div>
                </div>

                <button type="submit" class="btn btn-primary" style="width: 100%; padding: 12px; font-weight: 600;">Simpan Perubahan Statistik</button>
            </form>
        </div>
    </div>

    <!-- Card Reset Counter -->
    <div class="panel" style="height: fit-content;">
        <div class="panel-head">
            <h2 style="color: #C53030;">Reset Counter Kunjungan</h2>
        </div>
        <div class="panel-body">
            <p style="font-size: 13px; color: #4A5568; line-height: 1.5; margin-bottom: 20px;">
                Jika Anda ingin mengembalikan hitungan jumlah kunjungan website kembali ke <strong>0 (nol)</strong>, klik tombol reset di bawah ini.
            </p>

            <form action="{{ route('admin_dpn.reset_visitor') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin me-reset jumlah kunjungan pengunjung kembali ke 0?')">
                @csrf
                <button type="submit" class="btn btn-danger" style="width: 100%; padding: 12px; font-weight: 600; background: #E53E3E; border-color: #E53E3E;">
                    Reset Counter Kunjungan ke 0
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
