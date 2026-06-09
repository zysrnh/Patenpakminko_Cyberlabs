@extends('layouts.app')

@section('title', 'Proyek Strategis Nasional (PSN) â€” PATEN PAK MIKO')
@section('page-title', 'Proyek Strategis Nasional (PSN)')

@section('content')
<div class="page-header">
    <div class="page-header-left">
        <div class="breadcrumb">
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <span>â€º</span>
            <span>Proyek Strategis Nasional (PSN)</span>
        </div>
        <h1>
            @if(Auth::user()->isPelakuUsaha())
                Riwayat Permohonan Saya
            @else
                Antrean Berkas Masuk
            @endif
        </h1>
        <p>Permohonan berbasis mandat Proyek Strategis Nasional (PSN) pemerintah.</p>
    </div>
    @if(Auth::user()->isPelakuUsaha())
        <a href="{{ route('ptp.create', ['layanan' => 'psn']) }}" class="btn btn-primary">
            <svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Buat Permohonan Baru
        </a>
    @endif
</div>

<div class="panel">
    @if($applications->isEmpty())
        <div class="empty-state">
            <svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
            <h3>Belum Ada Permohonan</h3>
            <p>
                @if(Auth::user()->isPelakuUsaha())
                    Anda belum mengajukan permohonan Proyek Strategis Nasional (PSN).
                @else
                    Tidak ada antrean berkas yang menunggu verifikasi.
                @endif
            </p>
            @if(Auth::user()->isPelakuUsaha())
                <a href="{{ route('ptp.create', ['layanan' => 'psn']) }}" class="btn btn-primary">Ajukan Sekarang</a>
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
                            <td>
                                <span style="font-family:'DM Mono',monospace;font-size:12px;font-weight:600;color:var(--blue);">{{ $app->application_number }}</span>
                                <div style="font-size:11px;color:var(--muted);margin-top:2px;font-weight:600;">{{ $app->service_name }}</div>
                            </td>
                            <td>
                                <div style="font-weight:700; color:#003B64;">{{ $app->nama_pengaju ?: ($app->user->name ?? $app->user->username) }}</div>
                                <div style="font-size:11px; color:var(--muted);">Akun: PMH{{ str_pad($app->user->id, 3, '0', STR_PAD_LEFT) }}</div>
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
                                            âœ… {{ $hari }}H Selesai
                                        @elseif($hari > 10)
                                            ðŸ”´ {{ $hari }}H Melewati Batas
                                        @else
                                            â³ {{ $hari }}H Â· Sisa {{ $sisaHari }}H
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
                                <a href="{{ route('psn.show', $app->id) }}" class="btn btn-sm btn-secondary">
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

