@extends('layouts.app')

@section('title', 'LAPOLPAK — PATEN PAK MIKO')
@section('page-title', 'LAPOLPAK')

@section('extra-styles')
    .info-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 20px; }
    .detail-list { list-style: none; }
    .detail-item { display: flex; justify-content: space-between; align-items: center; padding: 10px 0; border-bottom: 1px solid var(--line); font-size: 13px; }
    .detail-item:last-child { border-bottom: none; }
    .detail-label { color: var(--muted); font-weight: 500; }
    .detail-val { font-weight: 700; color: var(--ink); }
    .guide-box { background: var(--surface); border: 1px solid var(--line); border-radius: var(--r-md); padding: 14px 16px; }
    .guide-box h4 { font-size: 12.5px; font-weight: 700; color: var(--ink); margin-bottom: 8px; display: flex; align-items: center; gap: 6px; }
    .guide-list { list-style: none; display: flex; flex-direction: column; gap: 7px; }
    .guide-list li { font-size: 12.5px; color: var(--mid); line-height: 1.5; padding-left: 14px; position: relative; }
    .guide-list li::before { content: '•'; position: absolute; left: 0; color: var(--blue); font-weight: 700; }
    .form-grid-3 { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 14px; }
    .status-booked { background: var(--blue-lt); border: 1.5px solid var(--blue-md); border-radius: var(--r-lg); padding: 20px; text-align: center; margin-bottom: 20px; }
    .star-rating { color: #D69E2E; font-size: 16px; font-weight: 700; }
    @media (max-width: 768px) {
        .info-grid { grid-template-columns: 1fr; }
        .form-grid-3 { grid-template-columns: 1fr; }
    }
@endsection

@section('content')
<div class="page-header">
    <div class="page-header-left">
        <div class="breadcrumb">
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <span>›</span>
            <span>LAPOLPAK</span>
        </div>
        <h1>Layanan Pelaporan (LAPOLPAK)</h1>
        <p>Layanan ini merupakan layanan konsultasi dan pembuatan polygon gratis di kantor.</p>
    </div>
    <div class="badge badge-blue" style="padding:6px 14px;font-size:12px;">05 / Pelaporan</div>
</div>

@if($errors->any())
    <div class="alert alert-error">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
        <div>@foreach($errors->all() as $error)<p>{{ $error }}</p>@endforeach</div>
    </div>
@endif

@if($booking)
    {{-- Sudah Booking --}}
    <div class="status-booked">
        <div style="width:44px;height:44px;border-radius:50%;background:var(--blue);display:flex;align-items:center;justify-content:center;margin:0 auto 12px;">
            <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
        </div>
        <div style="font-size:16px;font-weight:800;color:var(--blue);margin-bottom:4px;">Jadwal Pelaporan LAPOLPAK Telah Dipesan</div>
        <div style="font-size:13px;color:var(--muted);">Pendaftaran dibatasi satu kali untuk menghindari duplikasi data.</div>
    </div>

    <div class="info-grid">
        <div class="panel">
            <div class="panel-head">
                <h2 style="display:flex;align-items:center;gap:8px;">
                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    Detail Jadwal Booking
                </h2>
            </div>
            <div class="panel-body" style="padding:0;">
                <ul class="detail-list" style="padding:0 16px;">
                    <li class="detail-item">
                        <span class="detail-label">Status</span>
                        <span class="detail-val">
                            <span class="badge" style="background-color:{{ $booking->status_color }}20;color:{{ $booking->status_color }};">{{ $booking->status_label }}</span>
                        </span>
                    </li>
                    <li class="detail-item"><span class="detail-label">Nama Pemohon</span><span class="detail-val">{{ $booking->user->name ?? $booking->user->username }}</span></li>
                    <li class="detail-item"><span class="detail-label">No. WhatsApp</span><span class="detail-val">{{ $booking->whatsapp_number }}</span></li>
                    <li class="detail-item"><span class="detail-label">Tanggal</span><span class="detail-val">{{ $booking->formatted_date }}</span></li>
                    <li class="detail-item"><span class="detail-label">Waktu</span><span class="detail-val" style="color:var(--blue);">{{ $booking->formatted_time_range }}</span></li>
                </ul>
            </div>
        </div>

        <div class="panel">
            <div class="panel-head">
                <h2 style="display:flex;align-items:center;gap:8px;">
                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                    Panduan Pelaporan
                </h2>
            </div>
            <div class="panel-body">
                <div class="guide-box">
                    <h4><svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg> Informasi Penting:</h4>
                    <ul class="guide-list">
                        <li><strong>Hadir Tepat Waktu</strong>: Datang 10 menit sebelum jadwal mulai.</li>
                        <li><strong>Bawa Identitas</strong>: KTP asli pemohon yang terdaftar.</li>
                        <li><strong>Berkas Fisik</strong>: Salinan dokumen persyaratan tata ruang.</li>
                        <li><strong>WA Aktif</strong>: Nomor <strong>{{ $booking->whatsapp_number }}</strong> harus aktif.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    {{-- Ulasan jika selesai --}}
    @if($booking->status === 'selesai' && (Auth::check() && Auth::user()->isPelakuUsaha()))
        @php
            $review = \App\Models\Review::where('user_id', Auth::id())
                ->where('module_type', 'lapolpa')
                ->where('module_id', $booking->id)
                ->first();
        @endphp

        <div class="panel">
            <div class="panel-head">
                <h2 style="display:flex;align-items:center;gap:8px;">
                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                    Ulasan LAPOLPAK
                </h2>
            </div>
            <div class="panel-body">
                @if($review)
                    <div style="background:var(--surface);border:1px solid var(--line);padding:14px 16px;border-radius:var(--r-md);">
                        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:8px;">
                            <span class="star-rating">{{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5-$review->rating) }} <span style="color:var(--ink);font-size:13px;">({{ $review->rating_label }})</span></span>
                            @if($review->is_approved)
                                <span class="badge badge-green">Dipublikasikan</span>
                            @else
                                <span class="badge badge-gray">Menunggu Moderasi</span>
                            @endif
                        </div>
                        <p style="font-style:italic;font-size:13px;color:var(--muted);">"{{ $review->comment }}"</p>
                    </div>
                @else
                    <p style="font-size:13px;color:var(--muted);margin-bottom:16px;">Konsultasi selesai. Berikan ulasan & saran untuk meningkatkan layanan kami.</p>
                    <form action="{{ route('review.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="module_type" value="lapolpa">
                        <input type="hidden" name="module_id" value="{{ $booking->id }}">
                        <div class="form-group">
                            <label class="form-label" for="rating">Penilaian Anda</label>
                            <select name="rating" id="rating" class="form-control" required>
                                <option value="5">(5) Sangat Baik</option>
                                <option value="4">(4) Baik</option>
                                <option value="3">(3) Cukup Baik</option>
                                <option value="2">(2) Kurang</option>
                                <option value="1">(1) Sangat Kurang</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="comment">Catatan / Feedback</label>
                            <textarea name="comment" id="comment" class="form-control" rows="3" placeholder="Tuliskan saran atau ulasan singkat Anda..." required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Kirim Ulasan</button>
                    </form>
                @endif
            </div>
        </div>
    @endif

@else
    {{-- Belum Booking: Tampilkan Form --}}
    <div class="panel" style="max-width:640px;">
        <div class="panel-head">
            <h2 style="display:flex;align-items:center;gap:8px;">
                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                Daftarkan Jadwal Laporan LAPOLPAK
            </h2>
        </div>
        <div class="panel-body">
            <form action="{{ route('lapolpa.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label class="form-label" for="nama_pemohon">Nama Pengaju <span>*</span></label>
                    <input type="text" name="nama_pemohon" id="nama_pemohon" class="form-control"
                           value="{{ Auth::check() ? (Auth::user()->name ?? Auth::user()->username) : old('nama_pemohon') }}"
                           {{ Auth::check() ? 'readonly style=background-color:var(--surface);cursor:not-allowed;' : 'required' }}>
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="whatsapp_number">Nomor WhatsApp Aktif <span>*</span></label>
                    <input type="text" name="whatsapp_number" id="whatsapp_number" class="form-control"
                           placeholder="Contoh: 081234567890" value="{{ old('whatsapp_number', Auth::check() ? Auth::user()->phone_number : '') }}" required>
                    <div class="form-hint">Notifikasi panduan & jadwal akan dikirimkan ke nomor ini via WhatsApp.</div>
                </div>

                <div class="form-grid-3">
                    <div class="form-group">
                        <label class="form-label" for="booking_date">Tanggal Konsultasi <span>*</span></label>
                        <input type="date" name="booking_date" id="booking_date" class="form-control"
                               min="{{ date('Y-m-d') }}" value="{{ old('booking_date') }}" required>
                    </div>
                    <div class="form-group" style="grid-column: span 2;">
                        <label class="form-label" for="time_range">Rentang Waktu <span>*</span></label>
                        <select name="time_range" id="time_range" class="form-control" required>
                            <option value="">-- Pilih Waktu Konsultasi --</option>
                            <option value="08:00 - 10:00" {{ old('time_range') == '08:00 - 10:00' ? 'selected' : '' }}>Jam 08:00 - 10:00</option>
                            <option value="10:00 - 12:00" {{ old('time_range') == '10:00 - 12:00' ? 'selected' : '' }}>Jam 10:00 - 12:00</option>
                            <option value="13:00 - 15:00" {{ old('time_range') == '13:00 - 15:00' ? 'selected' : '' }}>Jam 13:00 - 15:00</option>
                        </select>
                    </div>
                </div>

                <div style="text-align:center;margin-top:8px;">
                    <button type="submit" class="btn btn-primary btn-full">
                        <svg viewBox="0 0 24 24"><path d="M22 2L11 13M22 2l-7 20-4-9-9-4 20-7z"/></svg>
                        Kirim Jadwal Booking
                    </button>
                </div>
            </form>
        </div>
    </div>
@endif
@endsection

@section('head-extra')
    <!-- Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/material_blue.css">
@endsection

@section('scripts')
    <!-- Flatpickr JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/id.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const bookingDateInput = document.getElementById('booking_date');
            if (bookingDateInput) {
                flatpickr(bookingDateInput, {
                    dateFormat: "Y-m-d",
                    altInput: true,
                    altFormat: "d-m-Y",
                    locale: "id",
                    minDate: "today",
                    allowInput: true
                });
            }
        });
    </script>
@endsection

