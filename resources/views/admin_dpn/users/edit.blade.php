@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="mb-4">
        <div class="breadcrumb">
            <a href="{{ route('admin.users.index') }}">Kelola Admin</a>
            <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span>Edit Admin</span>
        </div>
        <h2 class="mb-1" style="font-weight: 800; color: var(--ink);">Edit Akun: {{ $user->username }}</h2>
        <p class="text-muted mb-0" style="font-size: 14px;">Perbarui data instansi atau atur ulang kata sandi admin ini.</p>
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

                    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Peran (Role) <span class="text-danger">*</span></label>
                                <select name="role" class="form-select" required>
                                    <option value="bpn" {{ old('role', $user->role) == 'bpn' ? 'selected' : '' }}>Admin BPN</option>
                                    <option value="dinas_pu" {{ old('role', $user->role) == 'dinas_pu' ? 'selected' : '' }}>Admin Dinas PU</option>
                                    <option value="dinas_putr" {{ old('role', $user->role) == 'dinas_putr' ? 'selected' : '' }}>Admin Dinas PUTR</option>
                                    <option value="satu_pintu" {{ old('role', $user->role) == 'satu_pintu' ? 'selected' : '' }}>Admin Satu Pintu / PTSP</option>
                                    <option value="dpn" {{ old('role', $user->role) == 'dpn' ? 'selected' : '' }}>Super Admin (DPN)</option>
                                    <option value="admin_berita" {{ old('role', $user->role) == 'admin_berita' ? 'selected' : '' }}>Admin Berita</option>
                                    <option value="pelaku_usaha" {{ old('role', $user->role) == 'pelaku_usaha' ? 'selected' : '' }}>Pelaku Usaha</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Username <span class="text-danger">*</span></label>
                                <input type="text" name="username" class="form-control" value="{{ old('username', $user->username) }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Nama Lengkap / Instansi</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Nomor WhatsApp</label>
                                <input type="text" name="phone_number" class="form-control" value="{{ old('phone_number', $user->phone_number) }}">
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Email</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Status Akun <span class="text-danger">*</span></label>
                                <select name="is_active" class="form-select" required>
                                    <option value="1" {{ old('is_active', $user->is_active) == 1 ? 'selected' : '' }}>Aktif</option>
                                    <option value="0" {{ old('is_active', $user->is_active) == 0 ? 'selected' : '' }}>Nonaktif (Blokir Akses)</option>
                                </select>
                            </div>
                        </div>

                        <hr class="mb-4">
                        
                        <div class="alert alert-info" style="font-size: 13px; border-radius: 8px;">
                            Biarkan kolom kata sandi kosong jika Anda tidak ingin mengubah kata sandi akun ini.
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Kata Sandi Baru</label>
                                <input type="password" name="password" class="form-control" minlength="6" placeholder="Opsional">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Konfirmasi Kata Sandi Baru</label>
                                <input type="password" name="password_confirmation" class="form-control" minlength="6" placeholder="Ulangi jika diisi">
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary px-4 py-2" style="font-weight: 600;">Simpan Perubahan</button>
                            <a href="{{ route('admin.users.index') }}" class="btn px-4 py-2" style="background: var(--surface2); color: var(--ink); font-weight: 600;">Batal</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
