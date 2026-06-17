@extends('layouts.app')

@section('content')
<style>
    .admin-form-control {
        width: 100%;
        padding: 12px 16px;
        font-size: 14px;
        color: var(--ink);
        background-color: #F8FAFC;
        border: 1px solid #E2E8F0;
        border-radius: 8px;
        transition: border-color 0.2s, box-shadow 0.2s, background-color 0.2s;
        font-family: inherit;
    }
    .admin-form-control:focus {
        background-color: #fff;
        border-color: var(--blue);
        box-shadow: 0 0 0 3px rgba(33, 138, 201, 0.15);
        outline: none;
    }
    select.admin-form-control {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='none' viewBox='0 0 24 24' stroke='%2364748B' stroke-width='2'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M6 9l6 6 6-6'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 16px center;
        padding-right: 40px;
    }
    .admin-form-label {
        font-size: 13.5px;
        font-weight: 700;
        color: #334155;
        margin-bottom: 8px;
        display: block;
    }
    .admin-form-label .required {
        color: #DC2626;
        margin-left: 2px;
    }
    .admin-card {
        background: #fff;
        border: 1px solid var(--line);
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.03);
        padding: 32px;
        max-width: 800px;
    }
    .admin-row {
        display: flex;
        flex-wrap: wrap;
        margin: -12px;
        margin-bottom: 8px;
    }
    .admin-col {
        flex: 1;
        padding: 12px;
        min-width: 280px;
    }
    .btn-primary {
        background: var(--blue);
        color: #fff;
        border: none;
        padding: 12px 24px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 14px;
        cursor: pointer;
        transition: background 0.2s;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }
    .btn-primary:hover {
        background: var(--blue-dk);
    }
    .btn-secondary {
        background: #F1F5F9;
        color: #475569;
        border: 1px solid #E2E8F0;
        padding: 11px 24px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 14px;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
    }
    .btn-secondary:hover {
        background: #E2E8F0;
        color: #334155;
    }
</style>

<div class="container py-4">
    <div class="mb-4">
        <div style="display: flex; align-items: center; gap: 8px; font-size: 13.5px; font-weight: 600; color: #64748B; margin-bottom: 12px;">
            <a href="{{ route('admin.users.index') }}" style="color: var(--blue); text-decoration: none;">Kelola Admin</a>
            <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span>Tambah Admin</span>
        </div>
        <h2 style="font-weight: 800; color: var(--ink); margin-bottom: 4px;">Tambah Admin Baru</h2>
        <p style="font-size: 14.5px; color: #64748B;">Buat akun admin instansi untuk mengelola sistem.</p>
    </div>

    <div class="admin-card">
        @if ($errors->any())
            <div style="background: #FEF2F2; border: 1px solid #FECACA; color: #DC2626; padding: 16px; border-radius: 8px; margin-bottom: 24px; font-size: 13.5px;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf
            
            <div class="admin-row">
                <div class="admin-col">
                    <label class="admin-form-label">Peran (Role) <span class="required">*</span></label>
                    <select name="role" class="admin-form-control" required>
                        <option value="" disabled selected>Pilih Peran Instansi...</option>
                        <option value="bpn" {{ old('role') == 'bpn' ? 'selected' : '' }}>Admin BPN</option>
                        <option value="dinas_pu" {{ old('role') == 'dinas_pu' ? 'selected' : '' }}>Admin Dinas PU</option>
                        <option value="dinas_putr" {{ old('role') == 'dinas_putr' ? 'selected' : '' }}>Admin Dinas PUTR</option>
                        <option value="satu_pintu" {{ old('role') == 'satu_pintu' ? 'selected' : '' }}>Admin Satu Pintu / PTSP</option>
                        <option value="admin_berita" {{ old('role') == 'admin_berita' ? 'selected' : '' }}>Admin Berita</option>
                        <option value="dpn" {{ old('role') == 'dpn' ? 'selected' : '' }}>Super Admin (DPN)</option>
                    </select>
                </div>
                <div class="admin-col">
                    <label class="admin-form-label">Username <span class="required">*</span></label>
                    <input type="text" name="username" class="admin-form-control" value="{{ old('username') }}" placeholder="cth: admin_bpn1" required>
                </div>
            </div>

            <div class="admin-row">
                <div class="admin-col">
                    <label class="admin-form-label">Nama Lengkap / Instansi</label>
                    <input type="text" name="name" class="admin-form-control" value="{{ old('name') }}" placeholder="cth: Verifikator BPN 1">
                </div>
                <div class="admin-col">
                    <label class="admin-form-label">Nomor WhatsApp</label>
                    <input type="text" name="phone_number" class="admin-form-control" value="{{ old('phone_number') }}" placeholder="cth: 08123456789">
                </div>
            </div>

            <div class="admin-row">
                <div class="admin-col">
                    <label class="admin-form-label">Email</label>
                    <input type="email" name="email" class="admin-form-control" value="{{ old('email') }}" placeholder="cth: bpn@patenpakmiko.go.id">
                </div>
            </div>

            <div style="border-top: 1px dashed #E2E8F0; margin: 24px 0;"></div>

            <div class="admin-row">
                <div class="admin-col">
                    <label class="admin-form-label">Kata Sandi Awal <span class="required">*</span></label>
                    <input type="password" name="password" class="admin-form-control" minlength="6" placeholder="Minimal 6 karakter" required>
                </div>
                <div class="admin-col">
                    <label class="admin-form-label">Konfirmasi Kata Sandi <span class="required">*</span></label>
                    <input type="password" name="password_confirmation" class="admin-form-control" minlength="6" placeholder="Ulangi kata sandi" required>
                </div>
            </div>

            <div style="display: flex; gap: 12px; margin-top: 16px;">
                <button type="submit" class="btn-primary">
                    <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                    Simpan & Buat Admin
                </button>
                <a href="{{ route('admin.users.index') }}" class="btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
