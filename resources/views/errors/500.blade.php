@extends('layouts.public')

@section('title', 'Terjadi Kendala Sistem (500) — PATEN PAK MIKO')

@section('content')
<div style="min-height: 70vh; display: flex; align-items: center; justify-content: center; padding: 60px 20px; background: linear-gradient(180deg, #F8FAFC 0%, #FFF7ED 100%);">
    <div style="max-width: 580px; width: 100%; text-align: center; background: #ffffff; padding: 48px 36px; border-radius: 20px; box-shadow: 0 20px 40px rgba(15, 23, 42, 0.08); border: 1px solid #E2E8F0;">
        <div style="width: 80px; height: 80px; margin: 0 auto 24px; background: #FFF7ED; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #EA580C;">
            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                <line x1="12" y1="9" x2="12" y2="13"></line>
                <line x1="12" y1="17" x2="12.01" y2="17"></line>
            </svg>
        </div>

        <span style="font-size: 13px; font-weight: 700; color: #EA580C; letter-spacing: 1.5px; text-transform: uppercase;">Sistem Sedang Diproses</span>
        <h1 style="font-size: 26px; font-weight: 700; color: #0F172A; margin: 12px 0 14px; line-height: 1.3;">Terjadi Kendala Teknis Sementara</h1>
        
        <p style="font-size: 15px; color: #64748B; line-height: 1.6; margin-bottom: 32px;">
            Mohon maaf atas ketidaknyamanan ini. Server sedang menangani permintaan yang membutuhkan penyesuaian. Tim kami siap membantu jika kendala terus berlanjut.
        </p>

        <div style="display: flex; gap: 12px; justify-content: center; flex-wrap: wrap;">
            <button onclick="window.location.reload();" style="cursor: pointer; border: none; display: inline-flex; align-items: center; gap: 8px; padding: 12px 24px; background: linear-gradient(135deg, #1E3A8A 0%, #2563EB 100%); color: #ffffff; border-radius: 10px; font-size: 14px; font-weight: 600; box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25); transition: all 0.2s;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="23 4 23 10 17 10"></polyline><path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"></path></svg>
                Muat Ulang Halaman
            </button>
            <a href="{{ url('/') }}" style="display: inline-flex; align-items: center; gap: 8px; padding: 12px 20px; background: #F1F5F9; color: #334155; text-decoration: none; border-radius: 10px; font-size: 14px; font-weight: 600; transition: all 0.2s;">
                Kembali ke Beranda
            </a>
            <a href="{{ route('kontak') }}" style="display: inline-flex; align-items: center; gap: 8px; padding: 12px 20px; background: #FFF7ED; color: #C2410C; border: 1px solid #FFEDD5; text-decoration: none; border-radius: 10px; font-size: 14px; font-weight: 600; transition: all 0.2s;">
                Lapor Helpdesk
            </a>
        </div>
    </div>
</div>
@endsection
