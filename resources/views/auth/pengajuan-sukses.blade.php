@extends('layouts.public')

@section('content')
<style>
    body { background-color: #F0F6FB; }
    
    .success-page-wrapper {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 60px 20px;
        flex: 1;
        justify-content: center;
        background-color: #F0F6FB;
    }
    .success-container {
        background: #FFFFFF;
        width: 100%;
        max-width: 1100px;
        padding: 100px 40px;
        text-align: center;
        box-shadow: none;
    }
    .success-img {
        display: block;
        width: 220px;
        height: auto;
        margin: 0 auto 30px auto;
    }
    .success-title {
        font-size: 32px;
        font-weight: 800;
        color: #003B64;
        margin-bottom: 16px;
    }
    .success-desc {
        font-size: 13px;
        color: #555;
        line-height: 1.6;
        max-width: 550px;
        margin: 0 auto 32px;
    }
    .btn-home {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        padding: 14px 28px;
        background: #003B64;
        color: #fff;
        border: none;
        border-radius: 5px;
        font-family: inherit;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: background .2s, transform .2s;
        text-decoration: none;
    }
    .btn-home:hover {
        background: #002642;
        transform: translateY(-1px);
    }
    
    @media (max-width: 767px) {
        .success-container { padding: 60px 24px; }
        .success-title { font-size: 24px; }
    }
</style>

<div class="success-page-wrapper">
    <div class="success-container">
        <img src="{{ asset('storage/svg/UploadSukses.svg') }}" alt="Berhasil" class="success-img">
        <h2 class="success-title">Dokumen Anda berhasil dikirim</h2>
        <p class="success-desc">
            Terima kasih, pengiriman dokumen Anda telah berhasil dikirim dan sedang menunggu proses verifikasi oleh admin kami. Detail lanjutan akan dihubungi via WhatsApp oleh admin kami.
        </p>

        @if(session('wa_links'))
            <div style="margin: 0 auto 30px auto; max-width: 550px; background: #E8F5E9; border: 1.5px solid #A5D6A7; border-radius: 8px; padding: 18px 20px; text-align: center; box-shadow: 0 4px 15px rgba(37, 211, 102, 0.15);">
                <div style="font-size: 14px; font-weight: 700; color: #1B5E20; margin-bottom: 6px; display: flex; align-items: center; justify-content: center; gap: 8px;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="#25D366"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                    Simpan Notifikasi Pendaftaran ke WhatsApp
                </div>
                <div style="font-size: 12px; color: #2E7D32; margin-bottom: 12px;">
                    Klik tombol di bawah untuk membuka WhatsApp dan menyimpan bukti permohonan Anda:
                </div>
                <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 10px;">
                    @foreach(session('wa_links') as $link)
                        @if(($link['target'] ?? '') === 'Pemohon')
                            <a href="{{ $link['url'] }}" target="_blank" rel="noopener noreferrer"
                               style="display: inline-flex; align-items: center; gap: 8px; background: #25D366; color: #fff; padding: 11px 22px; border-radius: 6px; text-decoration: none; font-size: 13px; font-weight: 700; transition: background 0.2s;"
                               onmouseover="this.style.background='#1EBE5A'" onmouseout="this.style.background='#25D366'">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                                Kirim Notifikasi Pendaftaran ke WA Anda
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>
        @endif

        <!-- The user can go to their dashboard / timeline to see the application -->
        @if(Auth::check())
            <a href="{{ route('dashboard') }}" class="btn-home">
                Kembali ke Dashboard &rarr;
            </a>
        @else
            <a href="{{ url('/') }}" class="btn-home">
                Kembali ke Halaman Utama &rarr;
            </a>
        @endif
    </div>
</div>
@endsection
