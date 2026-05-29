@extends('layouts.app')

@section('title', 'PKKPR Berusaha — PATEN PAK MIKO')
@section('page-title', 'PKKPR Berusaha')

@section('content')
<div class="page-header">
    <div class="page-header-left">
        <div class="breadcrumb">
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <span>›</span>
            <span>PKKPR Berusaha</span>
        </div>
        <h1>
            @if(Auth::user()->isPelakuUsaha())
                Riwayat Permohonan Saya
            @else
                Antrean Berkas Masuk
            @endif
        </h1>
        <p>Perizinan bisnis terpadu — skala mikro hingga besar.</p>
    </div>
    @if(Auth::user()->isPelakuUsaha())
        <a href="{{ route('berusaha.create') }}" class="btn btn-primary">
            <svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Buat Permohonan Baru
        </a>
    @endif
</div>

<div class="panel">
    @if($applications->isEmpty())
        <div class="empty-state">
            <svg viewBox="0 0 24 24"><path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            <h3>Belum Ada Permohonan</h3>
            <p>
                @if(Auth::user()->isPelakuUsaha())
                    Anda belum mengajukan permohonan PKKPR Berusaha.
                @else
                    Tidak ada antrean berkas yang menunggu verifikasi.
                @endif
            </p>
            @if(Auth::user()->isPelakuUsaha())
                <a href="{{ route('berusaha.create') }}" class="btn btn-primary">Ajukan Sekarang</a>
            @endif
        </div>
    @else
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>No. Registrasi</th>
                        <th>Pemohon</th>
                        <th>No. WA</th>
                        <th>Tgl Pengajuan</th>
                        @if(!Auth::user()->isPelakuUsaha())
                        <th>SLA (Pengendalian)</th>
                        @endif
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($applications as $app)
                        <tr>
                            <td><span style="font-family:'DM Mono',monospace;font-size:12px;font-weight:600;color:var(--blue);">{{ $app->application_number }}</span></td>
                            <td>
                                <div style="font-weight:700;">{{ $app->user->username }}</div>
                                <div style="font-size:11.5px;color:var(--muted);">{{ $app->user->name ?? '—' }}</div>
                            </td>
                            <td style="color:var(--mid);">{{ $app->user->phone_number }}</td>
                            <td style="color:var(--mid);">{{ $app->created_at->format('d-m-Y') }}</td>
                            @if(!Auth::user()->isPelakuUsaha())
                                @php
                                    $isSelesai = in_array($app->status, ['disetujui', 'ditolak', 'terbit_pkpr']);
                                    $hari = $isSelesai ? (int)$app->created_at->diffInDays($app->updated_at) : (int)$app->created_at->diffInDays(now());
                                    $sisaHari = max(0, 10 - $hari);
                                    
                                    if($hari <= 8) {
                                        $warnaSla = '#16A34A'; // Hijau
                                    } elseif($hari > 8 && $hari <= 10) {
                                        $warnaSla = '#D97706'; // Kuning
                                    } else {
                                        $warnaSla = '#DC2626'; // Merah
                                    }
                                @endphp
                                <td>
                                    <span class="badge" style="background-color:{{ $warnaSla }};color:#fff; border:none; font-size:11.5px; white-space:nowrap; padding:4px 10px; border-radius:20px; font-weight:700; letter-spacing:.01em;">
                                        @if($isSelesai)
                                            ✅ {{ $hari }}H Selesai
                                        @elseif($hari > 10)
                                            🔴 {{ $hari }}H Melewati Batas
                                        @else
                                            ⏳ {{ $hari }}H · Sisa {{ $sisaHari }}H
                                        @endif
                                    </span>
                                </td>
                            @endif
                            <td>
                                <span class="badge" style="background-color:{{ $app->status_color }}20;color:{{ $app->status_color }};">
                                    {{ $app->status_label }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('berusaha.show', $app->id) }}" class="btn btn-sm btn-secondary">
                                    Detail
                                    <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
