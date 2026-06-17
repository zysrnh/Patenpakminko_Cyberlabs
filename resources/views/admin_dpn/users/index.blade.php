@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1" style="font-weight: 800; color: var(--ink);">Kelola Admin & Pengguna</h2>
            <p class="text-muted mb-0" style="font-size: 14px;">Manajemen akun untuk Admin BPN, Dinas PU, Dinas PUTR, Satu Pintu, dan Pelaku Usaha.</p>
        </div>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary px-4 py-2" style="font-weight: 600; border-radius: var(--r-md);">
            + Tambah Admin
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success" style="font-size: 13px; border-radius: 8px;">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger" style="font-size: 13px; border-radius: 8px;">
            {{ session('error') }}
        </div>
    @endif

    <div class="card border-0 shadow-sm" style="border-radius: var(--r-md); overflow: hidden;">
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th style="width: 50px;">No</th>
                        <th>Nama & Username</th>
                        <th>Peran (Role)</th>
                        <th>Kontak</th>
                        <th>Status</th>
                        <th style="text-align: center; width: 100px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $index => $user)
                    <tr>
                        <td style="color: var(--muted); font-weight: 600;">{{ $index + 1 }}</td>
                        <td>
                            <div style="font-weight: 700; color: var(--ink);">{{ $user->name ?: '-' }}</div>
                            <div style="font-size: 12px; color: var(--muted);">{{ $user->username }}</div>
                        </td>
                        <td>
                            @if($user->role === 'dpn')
                                <span class="badge badge-yellow">Super Admin (DPN)</span>
                            @elseif($user->role === 'bpn')
                                <span class="badge badge-blue">Admin BPN</span>
                            @elseif(in_array($user->role, ['dinas_pu', 'dinas_putr']))
                                <span class="badge badge-gray">Dinas PU/PUTR</span>
                            @elseif($user->role === 'satu_pintu')
                                <span class="badge badge-green">Satu Pintu / PTSP</span>
                            @elseif($user->role === 'admin_berita')
                                <span class="badge badge-gray">Admin Berita</span>
                            @elseif($user->role === 'pelaku_usaha')
                                <span class="badge" style="background: var(--surface); color: var(--ink);">Pelaku Usaha</span>
                            @else
                                <span class="badge badge-gray">{{ $user->role }}</span>
                            @endif
                        </td>
                        <td>
                            <div style="font-size: 12px;">{{ $user->phone_number ?: '-' }}</div>
                            <div style="font-size: 11px; color: var(--muted);">{{ $user->email ?: '-' }}</div>
                        </td>
                        <td>
                            @if($user->is_active)
                                <span class="badge badge-green" style="background: #DCFCE7; color: #166534;">Aktif</span>
                            @else
                                <span class="badge badge-red">Nonaktif</span>
                            @endif
                        </td>
                        <td style="text-align: center;">
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm" style="background: var(--surface2); color: var(--ink); font-weight: 600; font-size: 12px; padding: 4px 10px;">Edit</a>
                            
                            @if($user->id !== Auth::id())
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm" style="background: #FFF5F5; color: #C53030; font-weight: 600; font-size: 12px; padding: 4px 10px; border: none;">Hapus</button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6">
                            <div class="empty-state">
                                <h3>Belum ada pengguna</h3>
                                <p>Silakan tambah admin/pengguna baru.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
