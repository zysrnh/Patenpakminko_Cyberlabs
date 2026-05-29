@extends('layouts.app')

@section('title', 'Profil Saya — PATEN PAK MIKO')
@section('page-title', 'Profil Saya')

@section('extra-styles')
    .avatar-section {
        display: flex;
        align-items: center;
        gap: 20px;
        padding: 20px;
        border-bottom: 1px solid var(--line);
        margin-bottom: 4px;
    }
    .avatar-preview-lg {
        width: 72px; height: 72px;
        border-radius: 50%;
        object-fit: cover;
        border: 2.5px solid var(--blue);
        flex-shrink: 0;
    }
    .avatar-placeholder-lg {
        width: 72px; height: 72px;
        border-radius: 50%;
        background: var(--blue-lt);
        color: var(--blue);
        font-size: 22px;
        font-weight: 800;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        border: 2.5px solid var(--blue-md);
    }
    .avatar-upload-label {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: var(--surface);
        border: 1px solid var(--line);
        border-radius: var(--r-md);
        padding: 7px 14px;
        font-size: 12.5px;
        font-weight: 600;
        color: var(--mid);
        cursor: pointer;
        transition: all .18s;
        margin-bottom: 4px;
    }
    .avatar-upload-label:hover { border-color: var(--blue); color: var(--blue); background: var(--blue-lt); }
    .avatar-upload-label svg { width: 14px; height: 14px; fill: none; stroke: currentColor; stroke-width: 2; stroke-linecap: round; }
    #profile_photo { display: none; }
    .badge-optional {
        font-size: 10px; font-weight: 700;
        color: var(--muted); background: var(--surface);
        padding: 2px 6px; border-radius: 4px;
        float: right;
    }
    .form-footer {
        display: flex;
        justify-content: flex-end;
        padding-top: 16px;
        border-top: 1px solid var(--line);
        margin-top: 4px;
    }
    .section-divider {
        font-size: 11px; font-weight: 700;
        text-transform: uppercase; letter-spacing: .08em;
        color: var(--muted); padding: 16px 20px 10px;
    }
@endsection

@section('content')
@php $user = Auth::user(); @endphp

<div class="page-header">
    <div class="page-header-left">
        <div class="breadcrumb">
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <span>›</span>
            <span>Profil Saya</span>
        </div>
        <h1>Lengkapi Data Profil</h1>
        <p>Pastikan data Anda akurat untuk mempercepat proses verifikasi dokumen.</p>
    </div>
</div>

<div class="panel">
    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Foto Profil --}}
        <div class="avatar-section">
            @if($user->profile_photo)
                <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="Foto Profil" class="avatar-preview-lg" id="avatarPreview">
            @else
                <div class="avatar-placeholder-lg" id="avatarPlaceholder">{{ strtoupper(substr($user->username, 0, 2)) }}</div>
            @endif
            <div>
                <div style="font-size:14px;font-weight:700;color:var(--ink);margin-bottom:4px;">
                    {{ $user->name ?? $user->username }}
                </div>
                <div style="font-size:12px;color:var(--muted);margin-bottom:10px;">{{ $user->phone_number }}</div>
                <label for="profile_photo" class="avatar-upload-label">
                    <svg viewBox="0 0 24 24"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                    Ganti Foto
                </label>
                <input type="file" id="profile_photo" name="profile_photo" accept="image/*" onchange="previewAvatar(event)">
                <div style="font-size:11px;color:var(--muted);">JPG, PNG, GIF. Maks. 2MB.</div>
                @error('profile_photo')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- Akun --}}
        <div class="section-divider">Informasi Akun</div>
        <div class="panel-body" style="padding-top:0;">
            <div class="form-grid">
                <div class="form-group">
                    <label for="username" class="form-label">Username <span>*</span></label>
                    <input type="text" id="username" name="username" class="form-control" value="{{ old('username', $user->username) }}" required>
                    @error('username')<div class="form-error">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label for="phone_number" class="form-label">Nomor WhatsApp <span>*</span></label>
                    <input type="text" id="phone_number" name="phone_number" class="form-control" value="{{ old('phone_number', $user->phone_number) }}" required>
                    @error('phone_number')<div class="form-error">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="form-group">
                <label for="name" class="form-label">Nama Lengkap <span class="badge-optional">Opsional</span></label>
                <input type="text" id="name" name="name" class="form-control" placeholder="cth: Budi Hartono" value="{{ old('name', $user->name) }}">
            </div>

            <div class="form-group">
                <label for="email" class="form-label">Email <span class="badge-optional">Opsional</span></label>
                <input type="email" id="email" name="email" class="form-control" placeholder="cth: budi@gmail.com" value="{{ old('email', $user->email) }}">
                @error('email')<div class="form-error">{{ $message }}</div>@enderror
            </div>

            <div class="form-group" style="margin-bottom:0;">
                <label for="address" class="form-label">Alamat <span class="badge-optional">Opsional</span></label>
                <textarea id="address" name="address" class="form-control" rows="3" placeholder="Masukkan alamat lengkap">{{ old('address', $user->address) }}</textarea>
            </div>
        </div>

        {{-- Data Usaha --}}
        <div class="section-divider" style="border-top:1px solid var(--line);">Data Usaha</div>
        <div class="panel-body" style="padding-top:0;">
            <div class="form-grid">
                <div class="form-group">
                    <label for="business_name" class="form-label">Nama Perusahaan / Usaha <span class="badge-optional">Opsional</span></label>
                    <input type="text" id="business_name" name="business_name" class="form-control" placeholder="cth: CV. Jaya Selalu" value="{{ old('business_name', $user->business_name) }}">
                </div>
                <div class="form-group">
                    <label for="business_role" class="form-label">Jabatan <span class="badge-optional">Opsional</span></label>
                    <input type="text" id="business_role" name="business_role" class="form-control" placeholder="cth: Direktur / Owner" value="{{ old('business_role', $user->business_role) }}">
                </div>
            </div>

            <div class="form-footer">
                <a href="{{ route('dashboard') }}" class="btn btn-secondary" style="margin-right:10px;">Batal</a>
                <button type="submit" class="btn btn-primary">
                    <svg viewBox="0 0 24 24"><path d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
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
