@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="mb-4">
        <div class="breadcrumb">
            <a href="{{ route('admin.users.index') }}">Kelola Admin</a>
            <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span>Tambah Admin</span>
        </div>
        <h2 class="mb-1" style="font-weight: 800; color: var(--ink);">Tambah Admin Baru</h2>
        <p class="text-muted mb-0" style="font-size: 14px;">Tambahkan akun baru untuk memberikan akses ke dashboard admin sesuai instansi masing-masing.</p>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm" style="border-radius: var(--r-md);">
                <div class="card-body p-4">
                    
                    @if ($errors->any())
                        <div class="alert alert-danger" style="font-size: 13px; border-radius: 8px;">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.users.store') }}" method="POST">
                        @csrf
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Peran (Role) <span class="text-danger">*</span></label>
                                <select name="role" class="form-select" required>
                                    <option value="" disabled selected>Pilih Peran/Instansi</option>
                                    <option value="bpn" {{ old('role') == 'bpn' ? 'selected' : '' }}>Admin BPN</option>
                                    <option value="dinas_pu" {{ old('role') == 'dinas_pu' ? 'selected' : '' }}>Admin Dinas PU</option>
                                    <option value="dinas_putr" {{ old('role') == 'dinas_putr' ? 'selected' : '' }}>Admin Dinas PUTR</option>
                                    <option value="satu_pintu" {{ old('role') == 'satu_pintu' ? 'selected' : '' }}>Admin Satu Pintu / PTSP</option>
                                    <option value="dpn" {{ old('role') == 'dpn' ? 'selected' : '' }}>Super Admin (DPN)</option>
                                    <option value="admin_berita" {{ old('role') == 'admin_berita' ? 'selected' : '' }}>Admin Berita</option>
                                    <option value="pelaku_usaha" {{ old('role') == 'pelaku_usaha' ? 'selected' : '' }}>Pelaku Usaha (Hanya jika perlu manual)</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Username <span class="text-danger">*</span></label>
                                <input type="text" name="username" class="form-control" value="{{ old('username') }}" required placeholder="cth: admin_bpn1">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Nama Lengkap / Instansi</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="cth: Bpk. Budi - BPN Sukabumi">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Nomor WhatsApp</label>
                                <input type="text" name="phone_number" class="form-control" value="{{ old('phone_number') }}" placeholder="cth: 08123456789">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="cth: admin@bpn.go.id">
                        </div>

                        <hr class="mb-4">

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Kata Sandi (Password) <span class="text-danger">*</span></label>
                                <input type="password" name="password" class="form-control" required minlength="6" placeholder="Minimal 6 karakter">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Konfirmasi Kata Sandi <span class="text-danger">*</span></label>
                                <input type="password" name="password_confirmation" class="form-control" required minlength="6" placeholder="Ulangi password">
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary px-4 py-2" style="font-weight: 600;">Simpan Admin Baru</button>
                            <a href="{{ route('admin.users.index') }}" class="btn px-4 py-2" style="background: var(--surface2); color: var(--ink); font-weight: 600;">Batal</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
