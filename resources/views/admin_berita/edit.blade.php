@extends('layouts.app')

@section('page-title', 'Edit Berita')

@section('content')
<div class="page-header">
    <div class="page-header-left">
        <h1>Edit Berita</h1>
        <p>Perbarui konten atau ubah status publikasi berita ini.</p>
    </div>
    <div>
        <a href="{{ route('admin.berita.index') }}" class="btn btn-secondary">
            &larr; Kembali
        </a>
    </div>
</div>

<div class="panel">
    <div class="panel-body">
        <form action="{{ route('admin.berita.update', $berita) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div style="margin-bottom: 20px;">
                <label style="display: block; font-weight: 600; margin-bottom: 8px; color: var(--ink);">Judul Berita *</label>
                <input type="text" name="title" value="{{ old('title', $berita->title) }}" required 
                    style="width: 100%; padding: 10px 14px; border: 1px solid var(--line); border-radius: var(--r-md); font-family: inherit; font-size: 14px;">
                @error('title')<span style="color: #DC2626; font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span>@enderror
            </div>
            
            <div class="grid-2col" style="grid-template-columns: 1fr 1fr; margin-bottom: 20px;">
                <div>
                    <label style="display: block; font-weight: 600; margin-bottom: 8px; color: var(--ink);">Kategori</label>
                    <input type="text" name="category" value="{{ old('category', $berita->category) }}" placeholder="Contoh: Info, Pengumuman"
                        style="width: 100%; padding: 10px 14px; border: 1px solid var(--line); border-radius: var(--r-md); font-family: inherit; font-size: 14px;">
                    @error('category')<span style="color: #DC2626; font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span>@enderror
                </div>
                <div>
                    <label style="display: block; font-weight: 600; margin-bottom: 8px; color: var(--ink);">Link Artikel Asli / Sumber</label>
                    <input type="url" name="source_link" value="{{ old('source_link', $berita->source_link) }}" placeholder="https://..."
                        style="width: 100%; padding: 10px 14px; border: 1px solid var(--line); border-radius: var(--r-md); font-family: inherit; font-size: 14px;">
                    <span style="font-size: 12px; color: var(--muted); margin-top: 4px; display: block;">Jika berita berasal dari portal berita lain, masukkan link aslinya di sini.</span>
                    @error('source_link')<span style="color: #DC2626; font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span>@enderror
                </div>
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; font-weight: 600; margin-bottom: 8px; color: var(--ink);">Gambar Header</label>
                @if($berita->image_path)
                    <div style="margin-bottom: 12px;">
                        <img src="{{ asset('storage/'.$berita->image_path) }}" alt="Current Image" style="max-height: 150px; border-radius: 8px; border: 1px solid var(--line);">
                    </div>
                @endif
                <input type="file" name="image" accept="image/*"
                    style="width: 100%; padding: 8px 14px; border: 1px solid var(--line); border-radius: var(--r-md); font-family: inherit; font-size: 14px;">
                <span style="font-size: 12px; color: var(--muted); margin-top: 4px; display: block;">Biarkan kosong jika tidak ingin mengubah gambar.</span>
                @error('image')<span style="color: #DC2626; font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span>@enderror
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; font-weight: 600; margin-bottom: 8px; color: var(--ink);">Isi Berita</label>
                <textarea name="content" id="editor" rows="10" 
                    style="width: 100%; padding: 10px 14px; border: 1px solid var(--line); border-radius: var(--r-md); font-family: inherit; font-size: 14px;">{{ old('content', $berita->content) }}</textarea>
                @error('content')<span style="color: #DC2626; font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span>@enderror
            </div>

            <div style="margin-bottom: 24px; display: flex; align-items: center; gap: 8px;">
                <input type="checkbox" name="is_published" id="is_published" value="1" {{ old('is_published', $berita->is_published) ? 'checked' : '' }} style="width: 18px; height: 18px;">
                <label for="is_published" style="font-weight: 600; color: var(--ink); cursor: pointer;">Publikasikan (Tampil di Landing Page)</label>
            </div>

            <button type="submit" class="btn btn-primary" style="padding: 10px 24px; font-size: 14.5px;">Update Berita</button>
        </form>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('editor', {
        height: 400,
        filebrowserUploadUrl: "{{ route('admin.berita.upload', ['_token' => csrf_token() ]) }}",
        filebrowserUploadMethod: 'form',
        versionCheck: false
    });
</script>
@endsection
