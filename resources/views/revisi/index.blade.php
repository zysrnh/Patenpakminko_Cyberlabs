@extends("layouts.guest")

@section("content")
<div class="container" style="max-width: 500px; margin-top: 50px;">
    <div class="card">
        <div class="card-header" style="background: var(--blue-dk); color: white;">
            <h4 class="m-0">Portal Revisi Berkas</h4>
        </div>
        <div class="card-body">
            @if(session("error"))
                <div class="alert alert-danger">{{ session("error") }}</div>
            @endif
            @if(session("success"))
                <div class="alert alert-success">{{ session("success") }}</div>
            @endif

            <p class="text-muted">Masukkan Nomor Telepon yang Anda gunakan saat mendaftar untuk melacak dan mengunggah perbaikan berkas permohonan Anda yang ditolak.</p>
            
            <form action="{{ route("revisi.track") }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label style="font-weight: 600;">Nomor Telepon / WhatsApp</label>
                    <input type="text" name="phone" class="form-control" placeholder="Contoh: 08123456789" required>
                </div>
                <button type="submit" class="btn btn-primary w-100" style="background: var(--blue-dk);">Lacak Berkas Revisi</button>
            </form>
        </div>
    </div>
</div>
@endsection
