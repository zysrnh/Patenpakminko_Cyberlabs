@extends('layouts.app')

@section('title', 'Profil Saya — PATEN PAK MIKO')
@section('page-title', 'Profil Saya')

@section('extra-styles')
    .profile-intro {
        background: #FFFFFF;
        border: 1px solid #D6E4EF;
        border-radius: 4px;
        padding: 16px 20px;
        margin-bottom: 18px;
        animation: fadeSlideUp .22s cubic-bezier(0.22, 1, 0.36, 1) both;
    }
    .profile-intro h1 {
        font-size: 17px;
        font-weight: 800;
        color: #003B64;
        letter-spacing: -0.02em;
        margin: 0 0 2px;
    }
    .profile-intro p {
        font-size: 12.5px;
        color: #64748B;
        margin: 0;
    }
    .profile-card {
        background: #FFFFFF;
        border: 1px solid #D6E4EF;
        border-radius: 4px;
        margin-bottom: 24px;
        overflow: hidden;
        animation: fadeSlideUp .26s cubic-bezier(0.22, 1, 0.36, 1) .05s both;
    }
    .avatar-section {
        display: flex;
        align-items: center;
        gap: 20px;
        padding: 20px 24px;
        border-bottom: 1px solid #D6E4EF;
        background: #F8FAFC;
    }
    .avatar-preview-lg {
        width: 72px; height: 72px;
        border-radius: 4px;
        object-fit: cover;
        border: 1px solid #D6E4EF;
        flex-shrink: 0;
    }
    .avatar-placeholder-lg {
        width: 72px; height: 72px;
        border-radius: 4px;
        background: #003B64;
        color: #FFFFFF;
        font-size: 22px;
        font-weight: 800;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .avatar-role-badge {
        background: #E3F0F9;
        color: #003B64;
        font-size: 11px;
        font-weight: 700;
        padding: 2px 8px;
        border-radius: 4px;
    }
    .avatar-upload-btn {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        background: #FFFFFF;
        border: 1px solid #CBD5E1;
        border-radius: 4px;
        padding: 7px 13px;
        font-size: 12px;
        font-weight: 600;
        color: #003B64;
        cursor: pointer;
        transition: background 0.15s ease, border-color 0.15s ease, transform 0.1s ease;
    }
    .avatar-upload-btn:hover {
        border-color: #218AC9;
        background: #E3F0F9;
    }
    .avatar-upload-btn:active {
        transform: scale(0.98);
    }
    #profile_photo { display: none; }
    .badge-optional {
        font-size: 10px;
        font-weight: 700;
        color: #64748B;
        background: #F1F5F9;
        padding: 2px 6px;
        border-radius: 4px;
        margin-left: 6px;
    }
    .section-header {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 16px 24px 12px;
        margin-bottom: 18px;
        border-bottom: 1px solid #E8F0F6;
        font-size: 12px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .06em;
        color: #003B64;
    }
    .section-header svg {
        width: 15px; height: 15px; stroke: #218AC9; stroke-width: 2; fill: none;
    }
    .form-body {
        padding: 0 24px 24px;
    }
    .form-group {
        margin-bottom: 18px;
    }
    .form-label {
        font-size: 12.5px;
        font-weight: 700;
        color: #003B64;
        margin-bottom: 6px;
        display: block;
    }
    .form-control {
        width: 100%;
        padding: 9px 12px;
        font-size: 13.5px;
        border: 1px solid #CBD5E1;
        border-radius: 4px;
        background: #FFFFFF;
        color: #0F172A;
        transition: border-color 0.15s ease, background-color 0.15s ease;
    }
    .form-control:focus {
        border-color: #218AC9;
        background: #FFFFFF;
        box-shadow: 0 0 0 2px #E3F0F9;
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
        gap: 10px;
        padding-top: 18px;
        border-top: 1px solid #E8F0F6;
        margin-top: 22px;
    }
    .btn-save {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        background: #003B64;
        color: #FFFFFF;
        border: 1px solid #003B64;
        padding: 8px 18px;
        border-radius: 4px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.15s ease, border-color 0.15s ease, transform 0.1s ease;
    }
    .btn-save:hover {
        background: #218AC9;
        border-color: #218AC9;
    }
    .btn-save:active {
        transform: scale(0.98);
    }
    .btn-cancel {
        display: inline-flex;
        align-items: center;
        padding: 8px 16px;
        background: #FFFFFF;
        border: 1px solid #CBD5E1;
        border-radius: 4px;
        color: #475569;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        transition: background 0.15s ease, color 0.15s ease, border-color 0.15s ease, transform 0.1s ease;
    }
    .btn-cancel:hover {
        background: #F1F5F9;
        color: #003B64;
        border-color: #94B8D4;
    }
    .btn-cancel:active {
        transform: scale(0.98);
    }

    /* ─── MOBILE RESPONSIVE ────────────────────────────── */
    @media (max-width: 640px) {
        .profile-intro {
            padding: 14px 16px;
            margin-bottom: 14px;
        }
        .avatar-section {
            flex-direction: column;
            align-items: center;
            text-align: center;
            padding: 18px 16px;
            gap: 14px;
        }
        .avatar-section > div {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
        }
        .avatar-user-head {
            justify-content: center;
            flex-wrap: wrap;
        }
        .avatar-upload-btn {
            width: 100%;
            justify-content: center;
            padding: 9px 16px;
        }
        .section-header {
            padding: 14px 16px 10px;
            margin-bottom: 14px;
        }
        .form-body {
            padding: 0 16px 20px;
        }
        .form-grid {
            grid-template-columns: 1fr;
            gap: 0;
        }
        .form-footer {
            flex-direction: column-reverse;
            gap: 10px;
            width: 100%;
        }
        .btn-save, .btn-cancel {
            width: 100%;
            justify-content: center;
            padding: 10px 16px;
        }
    }
@endsection

@section('content')
@php $user = Auth::user(); @endphp

<!-- Header Card -->
<div class="profile-intro">
    <h1>Pengaturan Profil</h1>
    <p>Pastikan data akun Anda akurat untuk mempercepat proses verifikasi dokumen.</p>
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
                <div class="avatar-user-head" style="display: flex; align-items: center; gap: 8px; margin-bottom: 3px;">
                    <h2 style="font-size: 15px; font-weight: 800; color: #003B64; margin: 0;">{{ $user->name ?? $user->username }}</h2>
                    <span class="avatar-role-badge">
                        @if($user->isDpn()) Super Admin
                        @elseif($user->isBpn()) Admin Instansi
                        @elseif($user->isDinasPu()) Admin PUTR
                        @elseif($user->isSatuPintu()) Admin DPMPTSP
                        @elseif($user->isPelakuUsaha()) Pelaku Usaha
                        @else Pengguna Terverifikasi @endif
                    </span>
                </div>
                <div style="font-size: 12px; color: #64748B; margin-bottom: 10px; font-weight: 500;">WhatsApp: {{ $user->phone_number }}</div>
                
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
