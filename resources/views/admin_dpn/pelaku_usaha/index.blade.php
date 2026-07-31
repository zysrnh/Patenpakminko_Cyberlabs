@extends('layouts.app')

@section('title', 'Kelola Pengguna — PATEN PAK MIKO')
@section('page-title', 'Kelola Pengguna')

@section('content')
<!-- Header Card -->
<div style="background: #ffffff; border: 1px solid #E2E8F0; border-radius: 6px; padding: 18px 24px; margin-bottom: 20px; box-shadow: 0 2px 6px rgba(0,38,66,0.02); display: flex; align-items: center; justify-content: space-between; gap: 16px; flex-wrap: wrap;">
    <div>
        <div style="font-size: 12px; color: #64748B; margin-bottom: 4px; display: flex; align-items: center; gap: 6px;">
            <a href="{{ route('dashboard') }}" style="color: #218AC9; text-decoration: none; font-weight: 600;">Dashboard</a>
            <span>›</span>
            <span style="color: #64748B;">Kelola Pengguna</span>
        </div>
        <h1 style="font-size: 19px; font-weight: 800; color: #003B64; letter-spacing: -0.02em; margin: 0;">
            Kelola Pengguna (Pelaku Usaha)
        </h1>
        <p style="font-size: 12.5px; color: #64748B; margin: 4px 0 0;">Daftar akun Pelaku Usaha yang terdaftar di sistem melalui pengajuan permohonan.</p>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success" style="border-radius: 4px; margin-bottom: 20px;">
        <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
        <span>{{ session('success') }}</span>
    </div>
@endif
@if(session('error'))
    <div class="alert alert-error" style="border-radius: 4px; margin-bottom: 20px;">
        <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
        <span>{{ session('error') }}</span>
    </div>
@endif

<div class="panel" style="border-radius: 6px; border: 1px solid #E2E8F0; box-shadow: 0 2px 6px rgba(0,38,66,0.02); overflow: hidden; background: #ffffff;">
    <div class="panel-body" style="padding: 0;">
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; min-width: 800px;">
                <thead>
                    <tr style="background: #F8FAFC; border-bottom: 1.5px solid #E2E8F0;">
                        <th style="padding: 10px 14px; text-align: left; font-size: 11px; font-weight: 800; color: #475569; text-transform: uppercase; letter-spacing: 0.05em; width: 50px;">No</th>
                        <th style="padding: 10px 14px; text-align: left; font-size: 11px; font-weight: 800; color: #475569; text-transform: uppercase; letter-spacing: 0.05em;">Nama / Username</th>
                        <th style="padding: 10px 14px; text-align: left; font-size: 11px; font-weight: 800; color: #475569; text-transform: uppercase; letter-spacing: 0.05em;">Kontak Info</th>
                        <th style="padding: 10px 14px; text-align: center; font-size: 11px; font-weight: 800; color: #475569; text-transform: uppercase; letter-spacing: 0.05em;">Status Akses</th>
                        <th style="padding: 10px 14px; text-align: center; font-size: 11px; font-weight: 800; color: #475569; text-transform: uppercase; letter-spacing: 0.05em; width: 100px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $index => $user)
                    <tr style="border-bottom: 1px solid #F1F5F9;">
                        <td style="padding: 12px 14px; color: #64748B; font-weight: 600; font-size: 12.5px;">{{ $index + 1 }}</td>
                        <td style="padding: 12px 14px;">
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <div style="width: 32px; height: 32px; border-radius: 4px; background: #218AC9; color: #ffffff; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 12px; flex-shrink: 0;">
                                    {{ strtoupper(substr($user->name ?: $user->username, 0, 2)) }}
                                </div>
                                <div>
                                    <strong style="color: #003B64; font-size: 13px; display: block;">{{ $user->name ?: '-' }}</strong>
                                    <div style="font-size: 11.5px; color: #64748B;">{{ '@'.$user->username }}</div>
                                </div>
                            </div>
                        </td>
                        <td style="padding: 12px 14px;">
                            <div style="font-size: 12.5px; font-weight: 700; color: #003B64;">{{ $user->phone_number ?: '-' }}</div>
                            <div style="font-size: 11.5px; color: #64748B;">{{ $user->email ?: '-' }}</div>
                        </td>
                        <td style="padding: 12px 14px; text-align: center;">
                            @if($user->is_active)
                                <span class="badge" style="background: #DCFCE7; color: #15803D; border: 1px solid #86EFAC; border-radius: 4px; padding: 4px 8px; font-weight: 700; font-size: 11px; display: inline-flex; align-items: center; gap: 4px;">
                                    <span style="width: 5px; height: 5px; border-radius: 50%; background: #15803D;"></span> Aktif
                                </span>
                            @else
                                <span class="badge" style="background: #FEF3C7; color: #B45309; border: 1px solid #FDE68A; border-radius: 4px; padding: 4px 8px; font-weight: 700; font-size: 11px; display: inline-flex; align-items: center; gap: 4px;">
                                    <span style="width: 5px; height: 5px; border-radius: 50%; background: #D97706;"></span> Belum Terverifikasi
                                </span>
                            @endif
                        </td>
                        <td style="padding: 12px 14px; text-align: center;">
                            <div style="display: flex; justify-content: center; gap: 4px;">
                                <a href="{{ route('admin.pelaku_usaha.edit', $user->id) }}" style="display: inline-flex; align-items: center; justify-content: center; width: 30px; height: 30px; border-radius: 4px; background: #EFF6FF; color: #218AC9; border: 1px solid #BFDBFE; text-decoration: none;" title="Edit Pengguna">
                                    <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                </a>
                                <form action="{{ route('admin.pelaku_usaha.destroy', $user->id) }}" method="POST" style="margin: 0;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun pelaku usaha ini secara permanen? Semua data terkait mungkin ikut terhapus!');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="display: inline-flex; align-items: center; justify-content: center; width: 30px; height: 30px; border-radius: 4px; background: #FEF2F2; color: #DC2626; border: 1px solid #FECACA; cursor: pointer;" title="Hapus Pengguna">
                                        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" style="padding: 40px 20px; text-align: center;">
                            <svg width="40" height="40" fill="none" viewBox="0 0 24 24" stroke="#94A3B8" stroke-width="1.5" style="margin-bottom: 10px;"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                            <h3 style="font-size: 14px; font-weight: 700; color: #003B64; margin-bottom: 4px;">Belum ada Pelaku Usaha</h3>
                            <p style="font-size: 12.5px; color: #64748B;">Sistem belum menerima permohonan yang mendaftarkan akun secara otomatis.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
