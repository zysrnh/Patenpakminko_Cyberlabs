@extends('layouts.app')

@section('page-title', 'Manajemen Berita')

@section('content')
<div class="page-header">
    <div class="page-header-left">
        <h1>Manajemen Berita / Artikel</h1>
        <p>Kelola artikel, berita, dan pengumuman yang akan tampil di halaman depan.</p>
    </div>
    <div>
        <a href="{{ route('admin.berita.create') }}" class="btn btn-primary">
            <svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Tambah Berita
        </a>
    </div>
</div>

<div class="panel">
    <div class="panel-head">
        <h2>Daftar Berita</h2>
    </div>
    <div class="panel-body" style="padding: 0;">
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Judul & Sumber</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th>Tanggal Publish</th>
                        <th style="text-align: right;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($beritas as $berita)
                    <tr>
                        <td>
                            <strong style="color: var(--ink); display: block; font-size: 13.5px; margin-bottom: 3px;">{{ $berita->title }}</strong>
                            <a href="{{ $berita->source_link ?? '#' }}" target="_blank" style="font-size: 11.5px; color: var(--blue); text-decoration: none; display: inline-block; max-width: 300px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                {{ $berita->source_link ?? 'Tidak ada link sumber' }}
                            </a>
                        </td>
                        <td>
                            <span class="badge badge-gray">{{ $berita->category ?? 'Umum' }}</span>
                        </td>
                        <td>
                            @if($berita->is_published)
                                <span class="badge badge-green">Dipublikasi</span>
                            @else
                                <span class="badge badge-yellow">Draft</span>
                            @endif
                        </td>
                        <td>
                            {{ $berita->created_at->format('d M Y') }}
                        </td>
                        <td style="text-align: right;">
                            <div style="display: flex; gap: 8px; justify-content: flex-end;">
                                <a href="{{ route('berita.show', $berita->slug) }}" target="_blank" class="btn btn-outline btn-sm" style="padding: 6px 12px; border: 1px solid var(--line); border-radius: 4px; text-decoration: none; color: var(--ink);">Lihat</a>
                                <a href="{{ route('admin.berita.edit', $berita) }}" class="btn btn-secondary btn-sm" style="padding: 6px 12px;">Edit</a>
                                <form action="{{ route('admin.berita.destroy', $berita) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus berita ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" style="padding: 6px 12px;">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">
                            <div class="empty-state">
                                <svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                                <h3>Belum Ada Berita</h3>
                                <p>Anda belum mempublikasikan berita atau artikel apa pun.</p>
                                <a href="{{ route('admin.berita.create') }}" class="btn btn-primary btn-sm">Mulai Tulis Berita</a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($beritas->hasPages())
    <div class="panel-body" style="border-top: 1px solid var(--line);">
        {{ $beritas->links() }}
    </div>
    @endif
</div>
@endsection
