@extends('layouts.app')

@section('title', 'Kotak Masuk Notifikasi — PATEN PAK MIKO')
@section('page-title', 'Kotak Masuk')

@section('content')
<div class="page-header">
    <div class="page-header-left">
        <div class="breadcrumb">
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <span>›</span>
            <span>Kotak Masuk</span>
        </div>
        <h1>Kotak Masuk (Notifikasi)</h1>
        <p>Pemberitahuan sistem terkait proses verifikasi dan layanan.</p>
    </div>
    <form action="{{ route('mailbox.read_all') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-secondary">
            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
            Tandai Semua Dibaca
        </button>
    </form>
</div>

<div class="panel" style="padding: 0;">
    @if($mailboxes->isEmpty())
        <div class="empty-state" style="padding: 40px;">
            <svg viewBox="0 0 24 24" width="40" height="40" stroke="#CBD5E1" stroke-width="1.5" fill="none"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            <h3>Kotak Masuk Kosong</h3>
            <p>Belum ada notifikasi baru untuk Anda saat ini.</p>
        </div>
    @else
        <div style="display: flex; flex-direction: column;">
            @foreach($mailboxes as $box)
                <a href="{{ route('mailbox.read', $box->id) }}" style="display: block; padding: 20px 24px; border-bottom: 1px solid var(--clr-line); text-decoration: none; background: {{ $box->is_read ? '#FFFFFF' : '#F4FBFF' }}; transition: background 0.2s;">
                    <div style="display: flex; gap: 16px; align-items: flex-start;">
                        <div style="width: 42px; height: 42px; border-radius: 50%; background: {{ $box->is_read ? '#F1F5F9' : '#DBEAFE' }}; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            @if(!$box->is_read)
                                <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="#2563EB" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            @else
                                <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="#94A3B8" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 19h18M5 5a2 2 0 012-2h10a2 2 0 012 2v14a2 2 0 01-2 2H7a2 2 0 01-2-2V5z"/></svg>
                            @endif
                        </div>
                        <div style="flex: 1;">
                            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 8px;">
                                <div style="display: flex; align-items: center; gap: 8px;">
                                    @if(!$box->is_read)
                                        <span style="width: 8px; height: 8px; background: #2563EB; border-radius: 50%; display: inline-block;"></span>
                                    @endif
                                    <strong style="color: {{ $box->is_read ? '#475569' : '#1E40AF' }}; font-size: 15px;">{{ $box->title }}</strong>
                                </div>
                                <span style="font-size: 11.5px; color: #94A3B8; font-weight: 500;">{{ $box->created_at->diffForHumans() }}</span>
                            </div>
                            <div style="color: #475569; font-size: 13.5px; line-height: 1.6; background: {{ $box->is_read ? '#F8FAFC' : '#FFFFFF' }}; border: 1px solid {{ $box->is_read ? '#E2E8F0' : '#BFDBFE' }}; padding: 12px 16px; border-radius: 8px; white-space: pre-wrap; font-family: inherit;">{{ $box->message }}</div>
                            <div style="margin-top: 10px; font-size: 12px; color: #3B82F6; font-weight: 600; display: inline-flex; align-items: center; gap: 4px;">
                                Lihat Detail Permohonan <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
        <div style="padding: 16px;">
            {{ $mailboxes->links() }}
        </div>
    @endif
</div>
@endsection
