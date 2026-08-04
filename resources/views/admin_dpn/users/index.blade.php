@extends('layouts.app')

@section('title', 'Kelola Admin — PATEN PAK MIKO')
@section('page-title', 'Kelola Admin')

@section('content')
<!-- Header Card -->
<div style="background: #ffffff; border: 1px solid #E2E8F0; border-radius: 6px; padding: 18px 24px; margin-bottom: 20px; box-shadow: 0 2px 6px rgba(0,38,66,0.02); display: flex; align-items: center; justify-content: space-between; gap: 16px; flex-wrap: wrap;">
    <div>
        <div style="font-size: 12px; color: #64748B; margin-bottom: 4px; display: flex; align-items: center; gap: 6px;">
            <a href="{{ route('dashboard') }}" style="color: #218AC9; text-decoration: none; font-weight: 600;">Dashboard</a>
            <span>›</span>
            <span style="color: #64748B;">Kelola Admin</span>
        </div>
        <h1 style="font-size: 19px; font-weight: 800; color: #003B64; letter-spacing: -0.02em; margin: 0;">
            Kelola Admin Instansi
        </h1>
        <p style="font-size: 12.5px; color: #64748B; margin: 4px 0 0;">Manajemen akun khusus dan perwakilan verifikator instansi yang terdaftar.</p>
    </div>
    <div style="display: flex; gap: 8px; align-items: center;">
        <button type="submit" form="bulkDeleteAdminForm" id="btnBulkDeleteAdmin" disabled style="background: #DC2626; border: none; font-weight: 700; padding: 9px 16px; border-radius: 4px; color: #fff; display: inline-flex; align-items: center; gap: 6px; font-size: 13px; opacity: 0.5; cursor: not-allowed; transition: all 0.2s;" onclick="return confirm('Apakah Anda yakin ingin menghapus secara permanen seluruh akun admin terpilih?');">
            <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
            Hapus Terpilih (<span id="selectedAdminCount">0</span>)
        </button>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary" style="background: #218AC9; border: none; font-weight: 700; padding: 9px 16px; border-radius: 4px; text-decoration: none; display: inline-flex; align-items: center; gap: 6px; font-size: 13px;">
            <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Tambah Admin
        </a>
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
        <form id="bulkDeleteAdminForm" action="{{ route('admin.users.bulk-destroy') }}" method="POST">
            @csrf
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse; min-width: 800px;">
                    <thead>
                        <tr style="background: #F8FAFC; border-bottom: 1.5px solid #E2E8F0;">
                            <th style="padding: 10px 14px; text-align: center; width: 40px;">
                                <input type="checkbox" id="selectAllAdmin" style="width: 16px; height: 16px; cursor: pointer; accent-color: #218AC9;">
                            </th>
                            <th style="padding: 10px 14px; text-align: left; font-size: 11px; font-weight: 800; color: #475569; text-transform: uppercase; letter-spacing: 0.05em; width: 40px;">No</th>
                            <th style="padding: 10px 14px; text-align: left; font-size: 11px; font-weight: 800; color: #475569; text-transform: uppercase; letter-spacing: 0.05em;">Admin / Username</th>
                            <th style="padding: 10px 14px; text-align: left; font-size: 11px; font-weight: 800; color: #475569; text-transform: uppercase; letter-spacing: 0.05em;">Peran (Role)</th>
                            <th style="padding: 10px 14px; text-align: left; font-size: 11px; font-weight: 800; color: #475569; text-transform: uppercase; letter-spacing: 0.05em;">Kontak Info</th>
                            <th style="padding: 10px 14px; text-align: center; font-size: 11px; font-weight: 800; color: #475569; text-transform: uppercase; letter-spacing: 0.05em;">Status Akses</th>
                            <th style="padding: 10px 14px; text-align: center; font-size: 11px; font-weight: 800; color: #475569; text-transform: uppercase; letter-spacing: 0.05em; width: 100px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $index => $user)
                        <tr style="border-bottom: 1px solid #F1F5F9;">
                            <td style="padding: 12px 14px; text-align: center;">
                                @if($user->id !== Auth::id())
                                    <input type="checkbox" name="user_ids[]" value="{{ $user->id }}" class="admin-cb" style="width: 16px; height: 16px; cursor: pointer; accent-color: #218AC9;">
                                @else
                                    <span title="Akun Anda sendiri (tidak dapat dihapus)" style="font-size: 10px; color: #94A3B8; font-weight: 700; background: #F1F5F9; padding: 2px 5px; border-radius: 4px;">Saya</span>
                                @endif
                            </td>
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
                                @if($user->role === 'dpn')
                                    <span class="badge" style="background: #FEF3C7; color: #B45309; border: 1px solid #FDE68A; border-radius: 4px; padding: 4px 8px; font-weight: 700; font-size: 11px; display: inline-block;">Super Admin (DPN)</span>
                                @elseif(in_array($user->role, ['bpn', 'Kantor Pertanahan']))
                                    <span class="badge" style="background: #EFF6FF; color: #1E40AF; border: 1px solid #BFDBFE; border-radius: 4px; padding: 4px 8px; font-weight: 700; font-size: 11px; display: inline-block;">Admin Kantor Pertanahan</span>
                                @elseif(in_array($user->role, ['dinas_pu', 'dinas_putr']))
                                    <span class="badge" style="background: #F8FAFC; color: #475569; border: 1px solid #E2E8F0; border-radius: 4px; padding: 4px 8px; font-weight: 700; font-size: 11px; display: inline-block;">Admin Dinas Pekerjaan Umum (PU)</span>
                                @elseif($user->role === 'satu_pintu')
                                    <span class="badge" style="background: #DCFCE7; color: #15803D; border: 1px solid #86EFAC; border-radius: 4px; padding: 4px 8px; font-weight: 700; font-size: 11px; display: inline-block;">Admin DPMPTSP</span>
                                @elseif($user->role === 'admin_berita')
                                    <span class="badge" style="background: #FAF5FF; color: #7E22CE; border: 1px solid #E9D5FF; border-radius: 4px; padding: 4px 8px; font-weight: 700; font-size: 11px; display: inline-block;">Admin Berita</span>
                                @else
                                    <span class="badge" style="background: #F1F5F9; color: #64748B; border: 1px solid #CBD5E1; border-radius: 4px; padding: 4px 8px; font-weight: 700; font-size: 11px; display: inline-block;">{{ $user->role }}</span>
                                @endif
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
                                    <span class="badge" style="background: #FEF2F2; color: #DC2626; border: 1px solid #FECACA; border-radius: 4px; padding: 4px 8px; font-weight: 700; font-size: 11px; display: inline-flex; align-items: center; gap: 4px;">
                                        <span style="width: 5px; height: 5px; border-radius: 50%; background: #DC2626;"></span> Nonaktif
                                    </span>
                                @endif
                            </td>
                            <td style="padding: 12px 14px; text-align: center;">
                                <div style="display: flex; justify-content: center; gap: 4px;">
                                    <a href="{{ route('admin.users.edit', $user->id) }}" style="display: inline-flex; align-items: center; justify-content: center; width: 30px; height: 30px; border-radius: 4px; background: #EFF6FF; color: #218AC9; border: 1px solid #BFDBFE; text-decoration: none;" title="Edit Admin">
                                        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                    </a>
                                    
                                    @if($user->id !== Auth::id())
                                    <button type="button" style="display: inline-flex; align-items: center; justify-content: center; width: 30px; height: 30px; border-radius: 4px; background: #FEF2F2; color: #DC2626; border: 1px solid #FECACA; cursor: pointer;" title="Hapus Admin" onclick="if(confirm('Apakah Anda yakin ingin menghapus akun admin ini?')) { document.querySelectorAll('.admin-cb').forEach(cb => cb.checked = false); document.querySelector('.admin-cb[value=\'{{ $user->id }}\']').checked = true; document.getElementById('bulkDeleteAdminForm').submit(); }">
                                        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" style="padding: 40px 20px; text-align: center;">
                                <svg width="40" height="40" fill="none" viewBox="0 0 24 24" stroke="#94A3B8" stroke-width="1.5" style="margin-bottom: 10px;"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                                <h3 style="font-size: 14px; font-weight: 700; color: #003B64; margin-bottom: 4px;">Belum ada Admin lain</h3>
                                <p style="font-size: 12.5px; color: #64748B;">Silakan klik tombol "Tambah Admin" untuk membuat akun baru.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const selectAll = document.getElementById('selectAllAdmin');
    const checkboxes = document.querySelectorAll('.admin-cb');
    const btnBulk = document.getElementById('btnBulkDeleteAdmin');
    const countSpan = document.getElementById('selectedAdminCount');

    function updateBulkState() {
        const checked = document.querySelectorAll('.admin-cb:checked');
        const count = checked.length;
        if (countSpan) countSpan.textContent = count;
        
        if (btnBulk) {
            if (count > 0) {
                btnBulk.disabled = false;
                btnBulk.style.opacity = '1';
                btnBulk.style.cursor = 'pointer';
            } else {
                btnBulk.disabled = true;
                btnBulk.style.opacity = '0.5';
                btnBulk.style.cursor = 'not-allowed';
            }
        }
    }

    if (selectAll) {
        selectAll.addEventListener('change', function() {
            checkboxes.forEach(cb => cb.checked = selectAll.checked);
            updateBulkState();
        });
    }

    checkboxes.forEach(cb => {
        cb.addEventListener('change', function() {
            if (!this.checked && selectAll) {
                selectAll.checked = false;
            } else if (selectAll && checkboxes.length > 0 && document.querySelectorAll('.admin-cb:checked').length === checkboxes.length) {
                selectAll.checked = true;
            }
            updateBulkState();
        });
    });
});
</script>
@endsection
