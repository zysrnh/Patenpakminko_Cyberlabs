@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1" style="font-weight: 800; color: var(--ink);">Statistik Web (Admin DPN)</h2>
            <p class="text-muted mb-0" style="font-size: 14px;">Kelola jumlah kunjungan website yang tampil di halaman beranda.</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm" style="border-radius: var(--r-md);">
                <div class="card-body p-4">
                    
                    @if(session('success'))
                        <div class="alert alert-success" style="font-size: 13px; border-radius: 8px;">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('admin_dpn.update') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-bold">Jumlah Kunjungan Saat Ini</label>
                            <input type="number" name="count" class="form-control" value="{{ $count }}" required style="font-size: 24px; font-weight: 700; height: 60px;">
                            <div class="form-text mt-2">Nilai ini akan bertambah secara otomatis setiap kali ada pengunjung baru yang membuka website. Anda juga dapat mengubahnya secara manual di sini.</div>
                        </div>

                        <button type="submit" class="btn btn-primary px-4 py-2" style="font-weight: 600;">Simpan Perubahan</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
