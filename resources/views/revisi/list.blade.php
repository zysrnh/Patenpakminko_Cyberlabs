@extends("layouts.public")

@section("title", "Pilih Revisi - PATEN PAK MIKO")

@section("content")
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap');
    body { font-family: 'Poppins', sans-serif; background: #F0F6FB; }
    .btn-choose { background:#0A1C2C; color:#fff; padding:10px 20px; border-radius:4px; text-decoration:none; font-size:13px; font-weight:600; display:inline-block; font-family:'Poppins', sans-serif; border:none; cursor:pointer; }
    .btn-choose:hover { background:#001526; }
</style>
<div style="background:#F0F6FB; min-height:calc(100vh - 70px); padding:40px 20px;">
    <div style="max-width:800px; margin:0 auto;">
        <h2 style="color:#0A1C2C; margin-bottom:10px;">Pilih Permohonan yang Akan Direvisi</h2>
        <p style="color:#555; margin-bottom:24px;">Ditemukan <strong>{{ count($applications) }}</strong> permohonan yang perlu diperbaiki untuk nomor telepon <strong>{{ $phone }}</strong>.</p>
        
        <div style="display:flex; flex-direction:column; gap:16px;">
            @foreach($applications as $app)
                <div style="background:#fff; border-radius:8px; padding:20px; box-shadow:0 4px 12px rgba(0,0,0,0.05); border-left:4px solid #C53030;">
                    <div style="display:flex; justify-content:space-between; align-items:flex-start; flex-wrap:wrap; gap:12px;">
                        <div style="flex:1; min-width:280px;">
                            <div style="font-size:12px; font-weight:600; color:#C53030; text-transform:uppercase; margin-bottom:4px;">Layanan: {{ $app['layanan'] }}</div>
                            <div style="font-size:18px; font-weight:700; color:#0A1C2C; margin-bottom:4px;">
                                No. Registrasi: {{ $app['application_number'] ?? 'Belum ada' }}
                            </div>
                            <div style="font-size:13px; color:#555; margin-bottom:12px;">
                                <strong>Dibuat pada:</strong> {{ $app['created_at']->locale('id')->translatedFormat('l, d F Y \J\a\m H:i \W\I\B') }}
                            </div>
                            <div style="background:#FFF5F5; border:1px solid #FED7D7; border-radius:4px; padding:12px; font-size:13px; color:#C53030; line-height:1.5;">
                                <strong style="display:block; margin-bottom:4px;">Catatan Penolakan / Perbaikan:</strong>
                                {!! nl2br(e($app['notes'])) !!}
                            </div>
                        </div>
                        <div style="margin-top:auto; padding-top:16px;">
                            <form action="{{ route('revisi.track.detail') }}" method="POST">
                                @csrf
                                <input type="hidden" name="type" value="{{ $app['type'] }}">
                                <input type="hidden" name="id" value="{{ $app['id'] }}">
                                <button type="submit" class="btn-choose">Pilih Permohonan Ini &rarr;</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <div style="margin-top:32px;">
            <a href="{{ route('revisi.index') }}" style="color:#0A1C2C; font-size:14px; text-decoration:none; font-weight:500;">&larr; Kembali Pencarian</a>
        </div>
    </div>
</div>
@endsection
