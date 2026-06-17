@extends('layouts.app')

@section('content')
<div style="padding: 24px;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; flex-wrap: wrap; gap: 16px;">
        <div>
            <h2 style="margin-top: 0; margin-bottom: 4px; font-weight: 800; color: var(--ink);">Kelola Admin</h2>
            <p style="margin: 0; color: #64748B; font-size: 14px;">Manajemen akun khusus untuk Admin Instansi.</p>
        </div>
        <a href="{{ route('admin.users.create') }}" class="btn" style="background: var(--blue); color: #fff; font-weight: 600; padding: 10px 20px; border-radius: 8px; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; flex-shrink: 0;">
            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Tambah Admin
        </a>
    </div>

    @if(session('success'))
        <div style="background: #EEF7E2; border: 1px solid #16A34A; color: #166534; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; font-size: 13.5px; display: flex; align-items: center; gap: 8px;">
            <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div style="background: #FFF5F5; border: 1px solid #C53030; color: #9B2C2C; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; font-size: 13.5px; display: flex; align-items: center; gap: 8px;">
            <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            {{ session('error') }}
        </div>
    @endif

    <div style="background: #fff; border: 1px solid var(--line); border-radius: 12px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.03);">
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; min-width: 800px;">
                <thead>
                    <tr style="background: #F8FAFC; border-bottom: 1px solid var(--line);">
                        <th style="padding: 16px 20px; text-align: left; font-size: 11.5px; font-weight: 700; color: #64748B; text-transform: uppercase; letter-spacing: 0.05em; width: 60px;">No</th>
                        <th style="padding: 16px 20px; text-align: left; font-size: 11.5px; font-weight: 700; color: #64748B; text-transform: uppercase; letter-spacing: 0.05em;">Admin / Username</th>
                        <th style="padding: 16px 20px; text-align: left; font-size: 11.5px; font-weight: 700; color: #64748B; text-transform: uppercase; letter-spacing: 0.05em;">Peran (Role)</th>
                        <th style="padding: 16px 20px; text-align: left; font-size: 11.5px; font-weight: 700; color: #64748B; text-transform: uppercase; letter-spacing: 0.05em;">Kontak Info</th>
                        <th style="padding: 16px 20px; text-align: left; font-size: 11.5px; font-weight: 700; color: #64748B; text-transform: uppercase; letter-spacing: 0.05em;">Status Akses</th>
                        <th style="padding: 16px 20px; text-align: right; font-size: 11.5px; font-weight: 700; color: #64748B; text-transform: uppercase; letter-spacing: 0.05em;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $index => $user)
                    <tr style="border-bottom: 1px solid var(--line); transition: background 0.2s;" onmouseover="this.style.background='#F8FAFC'" onmouseout="this.style.background='transparent'">
                        <td style="padding: 16px 20px; color: #64748B; font-weight: 600; font-size: 13.5px;">{{ $index + 1 }}</td>
                        <td style="padding: 16px 20px;">
                            <div style="display: flex; align-items: center; gap: 12px;">
                                <div style="width: 36px; height: 36px; border-radius: 50%; background: var(--surface2); color: var(--blue-dk); display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 13px; flex-shrink: 0;">
                                    {{ strtoupper(substr($user->name ?: $user->username, 0, 2)) }}
                                </div>
                                <div>
                                    <div style="font-weight: 700; color: var(--ink); font-size: 14px; margin-bottom: 2px;">{{ $user->name ?: '-' }}</div>
                                    <div style="font-size: 12.5px; color: #64748B; font-family: 'DM Mono', monospace;">{{ '@'.$user->username }}</div>
                                </div>
                            </div>
                        </td>
                        <td style="padding: 16px 20px;">
                            @if($user->role === 'dpn')
                                <span style="display: inline-block; padding: 4px 10px; border-radius: 6px; background: #FFFBEB; color: #D97706; font-size: 11.5px; font-weight: 700; border: 1px solid #FEF3C7;">Super Admin (DPN)</span>
                            @elseif($user->role === 'bpn')
                                <span style="display: inline-block; padding: 4px 10px; border-radius: 6px; background: #EFF6FF; color: #2563EB; font-size: 11.5px; font-weight: 700; border: 1px solid #DBEAFE;">Admin BPN</span>
                            @elseif(in_array($user->role, ['dinas_pu', 'dinas_putr']))
                                <span style="display: inline-block; padding: 4px 10px; border-radius: 6px; background: #F8FAFC; color: #475569; font-size: 11.5px; font-weight: 700; border: 1px solid #E2E8F0;">Dinas PU/PUTR</span>
                            @elseif($user->role === 'satu_pintu')
                                <span style="display: inline-block; padding: 4px 10px; border-radius: 6px; background: #F0FDF4; color: #16A34A; font-size: 11.5px; font-weight: 700; border: 1px solid #DCFCE7;">Satu Pintu / PTSP</span>
                            @elseif($user->role === 'admin_berita')
                                <span style="display: inline-block; padding: 4px 10px; border-radius: 6px; background: #FAF5FF; color: #9333EA; font-size: 11.5px; font-weight: 700; border: 1px solid #F3E8FF;">Admin Berita</span>
                            @else
                                <span style="display: inline-block; padding: 4px 10px; border-radius: 6px; background: #F1F5F9; color: #64748B; font-size: 11.5px; font-weight: 700; border: 1px solid #E2E8F0;">{{ $user->role }}</span>
                            @endif
                        </td>
                        <td style="padding: 16px 20px;">
                            <div style="font-size: 13px; font-weight: 600; color: var(--ink); margin-bottom: 2px;">{{ $user->phone_number ?: 'Tidak ada WA' }}</div>
                            <div style="font-size: 12px; color: #64748B;">{{ $user->email ?: 'Tidak ada Email' }}</div>
                        </td>
                        <td style="padding: 16px 20px;">
                            @if($user->is_active)
                                <div style="display: inline-flex; align-items: center; gap: 6px; color: #16A34A; font-size: 13px; font-weight: 600;">
                                    <div style="width: 8px; height: 8px; border-radius: 50%; background: #16A34A;"></div> Aktif
                                </div>
                            @else
                                <div style="display: inline-flex; align-items: center; gap: 6px; color: #DC2626; font-size: 13px; font-weight: 600;">
                                    <div style="width: 8px; height: 8px; border-radius: 50%; background: #DC2626;"></div> Nonaktif
                                </div>
                            @endif
                        </td>
                        <td style="padding: 16px 20px; text-align: right;">
                            <div style="display: flex; justify-content: flex-end; gap: 8px;">
                                <a href="{{ route('admin.users.edit', $user->id) }}" style="display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; border-radius: 6px; background: #EFF6FF; color: #2563EB; text-decoration: none; transition: all 0.2s;" title="Edit Admin">
                                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                </a>
                                
                                @if($user->id !== Auth::id())
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="margin: 0;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun admin ini secara permanen?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; border-radius: 6px; background: #FEF2F2; color: #DC2626; border: none; cursor: pointer; transition: all 0.2s;" title="Hapus Admin">
                                        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" style="padding: 40px 20px; text-align: center;">
                            <svg width="48" height="48" fill="none" viewBox="0 0 24 24" stroke="#CBD5E1" stroke-width="1.5" style="margin-bottom: 12px;"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                            <h3 style="font-size: 15px; font-weight: 700; color: var(--ink); margin-bottom: 4px;">Belum ada Admin lain</h3>
                            <p style="font-size: 13.5px; color: #64748B;">Silakan klik tombol "Tambah Admin" untuk membuat akun baru.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
