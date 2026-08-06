@extends('layouts.public')

@section('title', 'Sesi Berakhir (419) — PATEN PAK MIKO')

@section('content')
<div style="min-height: 70vh; display: flex; align-items: center; justify-content: center; padding: 60px 20px; background: linear-gradient(180deg, #F8FAFC 0%, #F0FDF4 100%);">
    <div style="max-width: 560px; width: 100%; text-align: center; background: #ffffff; padding: 48px 36px; border-radius: 20px; box-shadow: 0 20px 40px rgba(15, 23, 42, 0.08); border: 1px solid #E2E8F0;">
        <div style="width: 80px; height: 80px; margin: 0 auto 24px; background: #EFF6FF; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #2563EB;">
            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"></circle>
                <polyline points="12 6 12 12 16 14"></polyline>
            </svg>
        </div>

        <span style="font-size: 13px; font-weight: 700; color: #2563EB; letter-spacing: 1.5px; text-transform: uppercase;">Sesi Berakhir (419)</span>
        <h1 style="font-size: 26px; font-weight: 700; color: #0F172A; margin: 12px 0 14px; line-height: 1.3;">Sesi Pengisian Telah Kadaluarsa</h1>
        
        <p style="font-size: 15px; color: #64748B; line-height: 1.6; margin-bottom: 32px;">
            Sesi formulir atau keamanan Anda telah berakhir karena tidak ada aktivitas untuk beberapa saat. Silakan muat ulang halaman atau lakukan pengajuan kembali.
        </p>

        <div style="display: flex; gap: 12px; justify-content: center; flex-wrap: wrap;">
            <button onclick="window.location.reload();" style="cursor: pointer; border: none; display: inline-flex; align-items: center; gap: 8px; padding: 12px 24px; background: linear-gradient(135deg, #1E3A8A 0%, #2563EB 100%); color: #ffffff; border-radius: 10px; font-size: 14px; font-weight: 600; box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25); transition: all 0.2s;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="23 4 23 10 17 10"></polyline><path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"></path></svg>
                Muat Ulang Halaman
            </button>
            <a href="{{ url('/') }}" style="display: inline-flex; align-items: center; gap: 8px; padding: 12px 20px; background: #F1F5F9; color: #334155; text-decoration: none; border-radius: 10px; font-size: 14px; font-weight: 600; transition: all 0.2s;">
                Kembali ke Beranda
            </a>
        </div>
    </div>
</div>
@endsection
