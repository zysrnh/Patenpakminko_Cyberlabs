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
                            <div style="display: flex; align-items: center; gap: 14px;">
                                @if($berita->image_path)
                                    <img src="{{ route('file.view', ['path' => $berita->image_path]) }}" alt="Thumbnail" style="width: 120px; height: 80px; object-fit: cover; border-radius: 8px; flex-shrink: 0; border: 1px solid var(--line);">
                                @else
                                    <div style="width: 120px; height: 80px; border-radius: 8px; background: var(--surface2); border: 1px dashed var(--line); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                        <svg width="28" height="28" fill="none" stroke="var(--muted)" stroke-width="1.5" viewBox="0 0 24 24"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    </div>
                                @endif
                                <div style="margin-left: 4px;">
                                    <strong style="color: var(--ink); display: block; font-size: 13.5px; margin-bottom: 4px; line-height: 1.3;">{{ $berita->title }}</strong>
                                    <a href="{{ $berita->source_link ?? '#' }}" target="_blank" style="font-size: 11.5px; color: var(--blue); text-decoration: none; display: inline-block; max-width: 250px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                        {{ $berita->source_link ?? 'Tidak ada link sumber' }}
                                    </a>
                                </div>
                            </div>
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
