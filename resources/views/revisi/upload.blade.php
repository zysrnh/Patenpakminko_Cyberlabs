@extends("layouts.guest")

@section("content")
<div class="container" style="max-width: 600px; margin-top: 50px; margin-bottom: 50px;">
    <div class="card">
        <div class="card-header" style="background: var(--blue-dk); color: white;">
            <h4 class="m-0">Upload Perbaikan Berkas</h4>
        </div>
        <div class="card-body">
            <div class="alert alert-warning">
                <strong>Permohonan Anda perlu perbaikan.</strong><br>
                Nomor Permohonan: {{ $application->application_number }}<br>
                Catatan Pemeriksa:<br>
                <div style="background: #fff; padding: 10px; margin-top: 8px; border-radius: 4px; border: 1px solid #ddd; font-family: monospace; white-space: pre-wrap;">{{ $notes }}</div>
            </div>

            <hr>

            <form action="{{ route("revisi.upload", ["type" => $type, "id" => $application->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <h5 class="mb-3">Berkas yang Harus Diunggah Ulang:</h5>
                
                @if(count($missingFiles) > 0)
                    @foreach($missingFiles as $file)
                        <div class="form-group mb-3">
                            <label style="font-weight: 600; color: #E53E3E;">{{ $file }}</label>
                            <input type="file" name="doc_{{ str_replace(" ", "_", $file) }}" class="form-control" accept=".pdf,.png,.jpg,.jpeg,.zip" required>
                            <small class="text-muted">Maksimal 10MB (PDF/JPG/PNG).</small>
                        </div>
                    @endforeach
                @else
                    <div class="form-group mb-3">
                        <label style="font-weight: 600; color: #E53E3E;">Dokumen Perbaikan (Gabungan ZIP/PDF)</label>
                        <input type="file" name="doc_Gabungan_Perbaikan" class="form-control" accept=".pdf,.zip,.rar" required>
                        <small class="text-muted">Unggah seluruh perbaikan dokumen dalam 1 file ZIP atau PDF (Max 10MB).</small>
                    </div>
                @endif

                <button type="submit" class="btn btn-primary w-100 mt-3" style="background: var(--blue-dk);">Unggah Berkas Revisi</button>
            </form>
        </div>
    </div>
</div>
@endsection
