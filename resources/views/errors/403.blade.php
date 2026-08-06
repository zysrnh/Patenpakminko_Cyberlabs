@extends('layouts.public')

@section('title', 'Akses Dibatasi (403) — PATEN PAK MIKO')

@section('content')
<div style="min-height: 70vh; display: flex; align-items: center; justify-content: center; padding: 60px 20px; background: linear-gradient(180deg, #F8FAFC 0%, #FEF2F2 100%);">
    <div style="max-width: 560px; width: 100%; text-align: center; background: #ffffff; padding: 48px 36px; border-radius: 20px; box-shadow: 0 20px 40px rgba(15, 23, 42, 0.08); border: 1px solid #E2E8F0;">
        <div style="width: 80px; height: 80px; margin: 0 auto 24px; background: #FEF2F2; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #DC2626;">
            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
            </svg>
        </div>

        <span style="font-size: 13px; font-weight: 700; color: #DC2626; letter-spacing: 1.5px; text-transform: uppercase;">Akses Dibatasi (403)</span>
        <h1 style="font-size: 26px; font-weight: 700; color: #0F172A; margin: 12px 0 14px; line-height: 1.3;">Aksi / Halaman Tidak Diizinkan</h1>
        
        <p style="font-size: 15px; color: #64748B; line-height: 1.6; margin-bottom: 32px;">
            {{ $exception->getMessage() ?: 'Anda tidak memiliki hak akses untuk membuka halaman atau melakukan aksi ini. Silakan hubungi administrator atau pastikan Anda telah login dengan akun yang sesuai.' }}
        </p>

        <div style="display: flex; gap: 12px; justify-content: center; flex-wrap: wrap;">
            <a href="{{ url('/') }}" style="display: inline-flex; align-items: center; gap: 8px; padding: 12px 24px; background: linear-gradient(135deg, #1E3A8A 0%, #2563EB 100%); color: #ffffff; text-decoration: none; border-radius: 10px; font-size: 14px; font-weight: 600; box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25); transition: all 0.2s;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                Kembali ke Beranda
            </a>
            @if(Auth::check())
                <a href="{{ route('dashboard') }}" style="display: inline-flex; align-items: center; gap: 8px; padding: 12px 20px; background: #F1F5F9; color: #334155; text-decoration: none; border-radius: 10px; font-size: 14px; font-weight: 600; transition: all 0.2s;">
                    Ke Dashboard
                </a>
            @else
                <a href="{{ route('login') }}" style="display: inline-flex; align-items: center; gap: 8px; padding: 12px 20px; background: #F1F5F9; color: #334155; text-decoration: none; border-radius: 10px; font-size: 14px; font-weight: 600; transition: all 0.2s;">
                    Login Akun
                </a>
            @endif
        </div>
    </div>
</div>
@endsection
