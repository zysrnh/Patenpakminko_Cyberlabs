@extends('layouts.app')

@section('title', 'Profil Saya — PATEN PAK MIKO')
@section('page-title', 'Profil Saya')

@section('extra-styles')
    .profile-card {
        background: #ffffff;
        border: 1px solid #E2E8F0;
        border-radius: 14px;
        box-shadow: 0 2px 10px rgba(0,38,66,0.03);
        margin-bottom: 24px;
        overflow: hidden;
    }
    .avatar-section {
        display: flex;
        align-items: center;
        gap: 24px;
        padding: 24px 28px;
        border-bottom: 1px solid #F1F5F9;
        background: linear-gradient(180deg, #F8FAFC 0%, #FFFFFF 100%);
    }
    .avatar-preview-lg {
        width: 80px; height: 80px;
        border-radius: 20px;
        object-fit: cover;
        border: 3px solid #ffffff;
        box-shadow: 0 4px 14px rgba(0,59,100,0.12);
        flex-shrink: 0;
    }
    .avatar-placeholder-lg {
        width: 80px; height: 80px;
        border-radius: 20px;
        background: linear-gradient(135deg, #003B64 0%, #218AC9 100%);
        color: #ffffff;
        font-size: 26px;
        font-weight: 800;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        border: 3px solid #ffffff;
        box-shadow: 0 4px 14px rgba(0,59,100,0.12);
    }
    .avatar-upload-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #ffffff;
        border: 1.5px solid #CBD5E1;
        border-radius: 8px;
        padding: 8px 16px;
        font-size: 12.5px;
        font-weight: 700;
        color: #334155;
        cursor: pointer;
        transition: all 0.2s ease;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    }
    .avatar-upload-btn:hover {
        border-color: #218AC9;
        color: #218AC9;
        background: #F0F9FF;
        transform: translateY(-1px);
    }
    #profile_photo { display: none; }
    .badge-optional {
        font-size: 10px;
        font-weight: 700;
        color: #64748B;
        background: #F1F5F9;
        padding: 2px 7px;
        border-radius: 4px;
        margin-left: 6px;
    }
    .section-header {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 20px 28px 12px;
        font-size: 12px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .06em;
        color: #003B64;
    }
    .section-header svg {
        width: 16px; height: 16px; stroke: #218AC9; stroke-width: 2; fill: none;
    }
    .form-body {
        padding: 0 28px 24px;
    }
    .form-group {
        margin-bottom: 20px;
    }
    .form-label {
        font-size: 13px;
        font-weight: 700;
        color: #1E293B;
        margin-bottom: 6px;
        display: block;
    }
    .form-control {
        width: 100%;
        padding: 10px 14px;
        font-size: 13.5px;
        border: 1.5px solid #CBD5E1;
        border-radius: 8px;
        background: #F8FAFC;
        color: #0F172A;
        transition: all 0.2s ease;
    }
    .form-control:focus {
        border-color: #218AC9;
        background: #FFFFFF;
        box-shadow: 0 0 0 3px rgba(33, 138, 201, 0.15);
        outline: none;
    }
    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }
    .form-footer {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 12px;
        padding-top: 20px;
        border-top: 1px solid #F1F5F9;
        margin-top: 24px;
    }
    .btn-save {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: linear-gradient(135deg, #003B64 0%, #218AC9 100%);
        color: #ffffff;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
        box-shadow: 0 4px 12px rgba(0,59,100,0.18);
        transition: all 0.2s ease;
    }
    .btn-save:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 16px rgba(0,59,100,0.25);
    }
    .btn-cancel {
        display: inline-flex;
        align-items: center;
        padding: 10px 18px;
        background: #F1F5F9;
        border: 1px solid #E2E8F0;
        border-radius: 8px;
        color: #475569;
        font-size: 13px;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.2s ease;
    }
    .btn-cancel:hover { background: #E2E8F0; color: #1E293B; }
@endsection

@section('content')
@php $user = Auth::user(); @endphp

<!-- Header Card -->
<div style="background: #ffffff; border: 1px solid #E2E8F0; border-radius: 14px; padding: 20px 24px; margin-bottom: 20px; box-shadow: 0 2px 8px rgba(0,38,66,0.03);">
    <div style="display: flex; align-items: center; justify-content: space-between; gap: 16px;">
        <div>
            <div style="font-size: 12px; color: #64748B; margin-bottom: 4px; display: flex; align-items: center; gap: 6px;">
                <a href="{{ route('dashboard') }}" style="color: #218AC9; text-decoration: none; font-weight: 600;">Dashboard</a>
                <span>›</span>
                <span style="color: #64748B;">Profil Saya</span>
            </div>
            <h1 style="font-size: 20px; font-weight: 800; color: #003B64; letter-spacing: -0.02em; margin: 0;">Lengkapi Data Profil</h1>
            <p style="font-size: 12.5px; color: #64748B; margin: 4px 0 0;">Pastikan data Anda akurat untuk mempercepat proses verifikasi dokumen.</p>
        </div>
    </div>
</div>

<div class="profile-card">
    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Foto Profil Section --}}
        <div class="avatar-section">
            @if($user->profile_photo)
                <img src="{{ route('file.view', ['path' => $user->profile_photo]) }}" alt="Foto Profil" class="avatar-preview-lg" id="avatarPreview">
            @else
                <div class="avatar-placeholder-lg" id="avatarPlaceholder">{{ strtoupper(substr($user->username, 0, 2)) }}</div>
            @endif
            <div>
                <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 4px;">
                    <h2 style="font-size: 16px; font-weight: 800; color: #003B64; margin: 0;">{{ $user->name ?? $user->username }}</h2>
                    <span style="background: #E0F2FE; color: #0369A1; font-size: 11px; font-weight: 700; padding: 2px 8px; border-radius: 6px;">
                        @if($user->isDpn()) Super Admin
                        @elseif($user->isBpn()) Admin Instansi
                        @elseif($user->isDinasPu()) Admin PUTR
                        @elseif($user->isSatuPintu()) Admin DPMPTSP
                        @elseif($user->isPelakuUsaha()) Pelaku Usaha
                        @else Pengguna Terverifikasi @endif
                    </span>
                </div>
                <div style="font-size: 12.5px; color: #64748B; margin-bottom: 12px; font-weight: 500;">📱 {{ $user->phone_number }}</div>
                
                <label for="profile_photo" class="avatar-upload-btn">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                    Ganti Foto Profil
                </label>
                <input type="file" id="profile_photo" name="profile_photo" accept="image/*" onchange="previewAvatar(event)">
                <div style="font-size: 11px; color: #94A3B8; margin-top: 6px;">Format JPG, PNG, GIF. Ukuran maksimum 2MB.</div>
                @error('profile_photo')
                    <div style="color: #DC2626; font-size: 12px; font-weight: 600; margin-top: 4px;">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- Form Fields Section --}}
        <div class="section-header">
            <svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
            Informasi Akun
        </div>

        <div class="form-body">
            <div class="form-grid">
                <div class="form-group">
                    <label for="username" class="form-label">Username <span style="color:#DC2626;">*</span></label>
                    <input type="text" id="username" name="username" class="form-control" value="{{ old('username', $user->username) }}" required>
                    @error('username')<div style="color: #DC2626; font-size: 12px; font-weight: 600; margin-top: 4px;">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label for="phone_number" class="form-label">Nomor WhatsApp <span style="color:#DC2626;">*</span></label>
                    <input type="text" id="phone_number" name="phone_number" class="form-control" value="{{ old('phone_number', $user->phone_number) }}" required>
                    @error('phone_number')<div style="color: #DC2626; font-size: 12px; font-weight: 600; margin-top: 4px;">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="form-group">
                <label for="name" class="form-label">Nama Lengkap <span class="badge-optional">Opsional</span></label>
                <input type="text" id="name" name="name" class="form-control" placeholder="cth: Budi Hartono" value="{{ old('name', $user->name) }}">
            </div>

            <div class="form-group">
                <label for="email" class="form-label">Email <span class="badge-optional">Opsional</span></label>
                <input type="email" id="email" name="email" class="form-control" placeholder="cth: budi@gmail.com" value="{{ old('email', $user->email) }}">
                @error('email')<div style="color: #DC2626; font-size: 12px; font-weight: 600; margin-top: 4px;">{{ $message }}</div>@enderror
            </div>

            <div class="form-group" style="margin-bottom:0;">
                <label for="address" class="form-label">Alamat <span class="badge-optional">Opsional</span></label>
                <textarea id="address" name="address" class="form-control" rows="3" placeholder="Masukkan alamat lengkap">{{ old('address', $user->address) }}</textarea>
            </div>

            <div class="form-footer">
                <a href="{{ route('dashboard') }}" class="btn-cancel">Batal</a>
                <button type="submit" class="btn-save">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                    Simpan Perubahan
                </button>
            </div>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    function previewAvatar(event) {
        const file = event.target.files[0];
        if (!file) return;
        const reader = new FileReader();
        reader.onload = function(e) {
            const placeholder = document.getElementById('avatarPlaceholder');
            let img = document.getElementById('avatarPreview');
            if (placeholder) {
                placeholder.style.display = 'none';
            }
            if (!img) {
                img = document.createElement('img');
                img.id = 'avatarPreview';
                img.alt = 'Foto Profil';
                img.className = 'avatar-preview-lg';
                placeholder?.parentNode.insertBefore(img, placeholder);
            }
            img.src = e.target.result;
            img.style.display = '';
        };
        reader.readAsDataURL(file);
    }
</script>
@endsection
