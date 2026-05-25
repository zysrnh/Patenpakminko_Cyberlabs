@extends('layouts.app')

@section('title', 'Kebijakan Khusus — PATENPAKMIKO')
@section('page-title', 'Kebijakan Khusus')

@section('content')
<div class="page-header">
    <div class="page-header-left">
        <div class="breadcrumb">
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <span>›</span>
            <span>Kebijakan Khusus</span>
        </div>
        <h1>
            @if(Auth::user()->isPelakuUsaha())
                Riwayat Permohonan Saya
            @else
                Antrean Berkas Masuk
            @endif
        </h1>
        <p>Permohonan berbasis mandat kebijakan khusus pemerintah.</p>
    </div>
    @if(Auth::user()->isPelakuUsaha())
        <a href="{{ route('kebijakan.create') }}" class="btn btn-primary">
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
                    Anda belum mengajukan permohonan Kebijakan Khusus.
                @else
                    Tidak ada antrean berkas yang menunggu verifikasi.
                @endif
            </p>
            @if(Auth::user()->isPelakuUsaha())
                <a href="{{ route('kebijakan.create') }}" class="btn btn-primary">Ajukan Sekarang</a>
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
                            <td style="color:var(--mid);">{{ $app->created_at->format('d/m/Y') }}</td>
                            <td>
                                <span class="badge" style="background-color:{{ $app->status_color }}20;color:{{ $app->status_color }};">
                                    {{ $app->status_label }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('kebijakan.show', $app->id) }}" class="btn btn-sm btn-secondary">
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
