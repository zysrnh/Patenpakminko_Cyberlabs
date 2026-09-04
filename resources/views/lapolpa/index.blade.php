@extends('layouts.app')

@section('title', 'LAPOL PAK — PATEN PAK MIKO')
@section('page-title', 'LAPOL PAK')

@section('extra-styles')
    @import url("https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css");
    .flatpickr-day.holiday-or-weekend { color: #DC2626 !important; font-weight: 700 !important; }
    .flatpickr-day.holiday-or-weekend.flatpickr-disabled { color: #DC2626 !important; background: #FEF2F2 !important; opacity: 0.6; }
    .info-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 20px; }
    .detail-list { list-style: none; }
    .detail-item { display: flex; justify-content: space-between; align-items: center; padding: 10px 0; border-bottom: 1px solid #E2E8F0; font-size: 13px; }
    .detail-item:last-child { border-bottom: none; }
    .detail-label { color: #64748B; font-weight: 500; }
    .detail-val { font-weight: 700; color: #003B64; }
    .guide-box { background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 4px; padding: 14px 16px; }
    .guide-box h4 { font-size: 12.5px; font-weight: 700; color: #003B64; margin-bottom: 8px; display: flex; align-items: center; gap: 6px; }
    .guide-list { list-style: none; display: flex; flex-direction: column; gap: 7px; }
    .guide-list li { font-size: 12.5px; color: #334155; line-height: 1.5; padding-left: 14px; position: relative; }
    .guide-list li::before { content: '•'; position: absolute; left: 0; color: #218AC9; font-weight: 700; }
    .form-grid-3 { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 14px; }
    .status-booked { background: #EFF6FF; border: 1px solid #BFDBFE; border-radius: 6px; padding: 20px; text-align: center; margin-bottom: 20px; box-shadow: 0 2px 6px rgba(0,38,66,0.02); }
    .star-rating { color: #D97706; font-size: 16px; font-weight: 700; }
    @media (max-width: 768px) {
        .info-grid { grid-template-columns: 1fr; }
        .form-grid-3 { grid-template-columns: 1fr; gap: 12px; }
        .form-grid-3 > div { grid-column: span 1 !important; }
        .detail-item { flex-direction: column; align-items: flex-start; gap: 4px; }
        .status-booked { padding: 16px; }
        .flatpickr-calendar { width: calc(100vw - 32px) !important; max-width: 320px !important; }
    }
@endsection

@section('content')
<!-- Header Card -->
<div style="background: #ffffff; border: 1px solid #E2E8F0; border-radius: 6px; padding: 18px 24px; margin-bottom: 20px; box-shadow: 0 2px 6px rgba(0,38,66,0.02); display: flex; align-items: center; justify-content: space-between; gap: 16px; flex-wrap: wrap;">
    <div>
        <div style="font-size: 12px; color: #64748B; margin-bottom: 4px; display: flex; align-items: center; gap: 6px;">
            <a href="{{ route('dashboard') }}" style="color: #218AC9; text-decoration: none; font-weight: 600;">Dashboard</a>
            <span>›</span>
            <span style="color: #64748B;">LAPOL PAK</span>
        </div>
        <h1 style="font-size: 19px; font-weight: 800; color: #003B64; letter-spacing: -0.02em; margin: 0;">
            Layanan Pelaporan (LAPOL PAK)
        </h1>
        <p style="font-size: 12.5px; color: #64748B; margin: 4px 0 0;">Layanan konsultasi dan pembuatan polygon gratis langsung di kantor pertanahan.</p>
    </div>
    <div style="background: #E3F0F9; color: #218AC9; border-radius: 4px; padding: 6px 14px; font-size: 12px; font-weight: 700;">
        05 / Pelaporan
    </div>
</div>

@if($errors->any())
    <div class="alert alert-error" style="border-radius: 4px; margin-bottom: 20px;">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
        <div>@foreach($errors->all() as $error)<p>{{ $error }}</p>@endforeach</div>
    </div>
@endif

@if($booking)
    {{-- Sudah Booking --}}
    <div class="status-booked">
        <div style="width:40px;height:40px;border-radius:4px;background:#218AC9;display:flex;align-items:center;justify-content:center;margin:0 auto 12px;">
            <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
        </div>
        <div style="font-size:16px;font-weight:800;color:#003B64;margin-bottom:4px;">Jadwal Pelaporan LAPOL PAK Telah Dipesan</div>
        <div style="font-size:13px;color:#64748B;">Pendaftaran dibatasi satu kali untuk menghindari duplikasi data.</div>
    </div>

    <div class="info-grid">
        <div class="panel" style="border-radius: 6px; border: 1px solid #E2E8F0; box-shadow: 0 2px 6px rgba(0,38,66,0.02); overflow: hidden; background: #ffffff;">
            <div class="panel-head" style="padding: 14px 18px; border-bottom: 1px solid #E2E8F0; background: #F8FAFC;">
                <h2 style="font-size: 15px; font-weight: 800; color: #003B64; margin: 0; display:flex;align-items:center;gap:8px;">
                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#218AC9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    Detail Jadwal Booking
                </h2>
            </div>
            <div class="panel-body" style="padding:0;">
                <ul class="detail-list" style="padding:0 16px;">
                    <li class="detail-item">
                        <span class="detail-label">Status</span>
                        <span class="detail-val">
                            <span class="badge" style="background-color:{{ $booking->status_color }}20;color:{{ $booking->status_color }}; border-radius: 4px; padding: 4px 8px; font-weight: 700; font-size: 11px;">{{ $booking->status_label }}</span>
                        </span>
                    </li>
                    <li class="detail-item"><span class="detail-label">Nama Pemohon</span><span class="detail-val">{{ $booking->user->name ?? $booking->user->username }}</span></li>
                    <li class="detail-item"><span class="detail-label">No. WhatsApp</span><span class="detail-val">{{ $booking->whatsapp_number }}</span></li>
                    <li class="detail-item"><span class="detail-label">Tanggal</span><span class="detail-val">{{ $booking->formatted_date }}</span></li>
                    <li class="detail-item"><span class="detail-label">Waktu</span><span class="detail-val" style="color:#218AC9;">{{ $booking->formatted_time_range }}</span></li>
                </ul>
            </div>
        </div>

        <div class="panel" style="border-radius: 6px; border: 1px solid #E2E8F0; box-shadow: 0 2px 6px rgba(0,38,66,0.02); overflow: hidden; background: #ffffff;">
            <div class="panel-head" style="padding: 14px 18px; border-bottom: 1px solid #E2E8F0; background: #F8FAFC;">
                <h2 style="font-size: 15px; font-weight: 800; color: #003B64; margin: 0; display:flex;align-items:center;gap:8px;">
                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#218AC9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                    Panduan Pelaporan
                </h2>
            </div>
            <div class="panel-body" style="padding: 16px;">
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

        <div class="panel" style="border-radius: 6px; border: 1px solid #E2E8F0; box-shadow: 0 2px 6px rgba(0,38,66,0.02); overflow: hidden; background: #ffffff;">
            <div class="panel-head" style="padding: 14px 18px; border-bottom: 1px solid #E2E8F0; background: #F8FAFC;">
                <h2 style="font-size: 15px; font-weight: 800; color: #003B64; margin: 0; display:flex;align-items:center;gap:8px;">
                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#218AC9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                    Ulasan LAPOL PAK
                </h2>
            </div>
            <div class="panel-body" style="padding: 16px;">
                @if($review)
                    <div style="background:#F8FAFC;border:1px solid #E2E8F0;padding:14px 16px;border-radius:4px;">
                        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:8px;">
                            <span class="star-rating">{{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5-$review->rating) }} <span style="color:#003B64;font-size:13px;">({{ $review->rating_label }})</span></span>
                            @if($review->is_approved)
                                <span class="badge badge-green" style="border-radius: 4px;">Dipublikasikan</span>
                            @else
                                <span class="badge badge-gray" style="border-radius: 4px;">Menunggu Moderasi</span>
                            @endif
                        </div>
                        <p style="font-style:italic;font-size:13px;color:#64748B;margin:0;">"{{ $review->comment }}"</p>
                    </div>
                @else
                    <p style="font-size:13px;color:#64748B;margin-bottom:16px;">Konsultasi selesai. Berikan ulasan & saran untuk meningkatkan layanan kami.</p>
                    <form action="{{ route('review.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="module_type" value="lapolpa">
                        <input type="hidden" name="module_id" value="{{ $booking->id }}">
                        <style>
                            .star-rating-form { display: flex; flex-direction: row-reverse; justify-content: flex-end; gap: 4px; }
                            .star-rating-form input { display: none; }
                            .star-rating-form label { font-size: 32px; color: #CBD5E0; cursor: pointer; transition: color 0.2s; line-height: 1; margin: 0; padding: 0; }
                            .star-rating-form input:checked ~ label, .star-rating-form label:hover, .star-rating-form label:hover ~ label { color: #D97706; }
                        </style>
                        <div class="form-group">
                            <label class="form-label">Penilaian Anda</label>
                            <div class="star-rating-form">
                                <input type="radio" id="star5" name="rating" value="5" required />
                                <label for="star5" title="Sangat Baik">★</label>
                                <input type="radio" id="star4" name="rating" value="4" />
                                <label for="star4" title="Baik">★</label>
                                <input type="radio" id="star3" name="rating" value="3" />
                                <label for="star3" title="Cukup Baik">★</label>
                                <input type="radio" id="star2" name="rating" value="2" />
                                <label for="star2" title="Kurang">★</label>
                                <input type="radio" id="star1" name="rating" value="1" />
                                <label for="star1" title="Sangat Kurang">★</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="comment">Catatan / Feedback</label>
                            <textarea name="comment" id="comment" class="form-control" rows="3" placeholder="Tuliskan saran atau ulasan singkat Anda..." required style="border-radius: 4px; border: 1px solid #CBD5E1;"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" style="border-radius: 4px; font-weight: 700;">Kirim Ulasan</button>
                    </form>
                @endif
            </div>
        </div>
    @endif

@else
    {{-- Belum Booking: Tampilkan Form --}}
    <div class="panel" style="max-width:640px; border-radius: 6px; border: 1px solid #E2E8F0; box-shadow: 0 2px 6px rgba(0,38,66,0.02); overflow: hidden; background: #ffffff;">
        <div class="panel-head" style="padding: 14px 18px; border-bottom: 1px solid #E2E8F0; background: #F8FAFC;">
            <h2 style="font-size: 15px; font-weight: 800; color: #003B64; margin: 0; display:flex;align-items:center;gap:8px;">
                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#218AC9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                Daftarkan Jadwal Laporan LAPOL PAK
            </h2>
        </div>
        <div class="panel-body" style="padding: 20px;">
            <form action="{{ route('lapolpa.store') }}" method="POST">
                @csrf
                <div class="form-group" style="margin-bottom: 16px;">
                    <label class="form-label" for="nama_pemohon" style="font-size: 12.5px; font-weight: 700; color: #003B64; margin-bottom: 6px; display: block;">Nama Pemohon / Pengguna Layanan <span style="color: #DC2626;">*</span></label>
                    <input type="text" name="nama_pemohon" id="nama_pemohon" class="form-control"
                           value="{{ Auth::check() ? (Auth::user()->name ?? Auth::user()->username) : old('nama_pemohon') }}"
                           {{ Auth::check() ? 'readonly style=background-color:#F8FAFC;cursor:not-allowed;border-radius:4px;border:1px solid #CBD5E1;' : 'required style=border-radius:4px;border:1px solid #CBD5E1;' }}>
                </div>
                
                <div class="form-group" style="margin-bottom: 16px;">
                    <label class="form-label" for="whatsapp_number" style="font-size: 12.5px; font-weight: 700; color: #003B64; margin-bottom: 6px; display: block;">Nomor WhatsApp Aktif <span style="color: #DC2626;">*</span></label>
                    <input type="text" name="whatsapp_number" id="whatsapp_number" class="form-control"
                           placeholder="Contoh: 081234567890" value="{{ old('whatsapp_number', Auth::check() ? Auth::user()->phone_number : '') }}" required style="border-radius:4px;border:1px solid #CBD5E1;">
                    <div class="form-hint" style="font-size: 11.5px; color: #64748B; margin-top: 4px;">Notifikasi panduan & jadwal akan dikirimkan ke nomor ini via WhatsApp.</div>
                </div>

                <div class="form-grid-3" style="margin-bottom: 20px;">
                    <div class="form-group">
                        <label class="form-label" for="booking_date" style="font-size: 12.5px; font-weight: 700; color: #003B64; margin-bottom: 6px; display: block;">Tanggal Konsultasi <span style="color: #DC2626;">*</span></label>
                        <input type="text" name="booking_date" id="booking_date" class="form-control"
                               placeholder="Pilih Tanggal" value="{{ old('booking_date') }}" required readonly style="background-color:#F8FAFC; cursor:pointer; border-radius:4px; border:1px solid #CBD5E1;">
                    </div>
                    <div class="form-group" style="grid-column: span 2;">
                        <label class="form-label" for="time_range" style="font-size: 12.5px; font-weight: 700; color: #003B64; margin-bottom: 6px; display: block;">Rentang Waktu <span style="color: #DC2626;">*</span></label>
                        <select name="time_range" id="time_range" class="form-control" required style="border-radius:4px; border:1px solid #CBD5E1;">
                            <option value="">-- Pilih Waktu Konsultasi --</option>
                            <option value="08:00 - 10:00" {{ old('time_range') == '08:00 - 10:00' ? 'selected' : '' }}>Jam 08:00 - 10:00</option>
                            <option value="10:00 - 12:00" {{ old('time_range') == '10:00 - 12:00' ? 'selected' : '' }}>Jam 10:00 - 12:00</option>
                            <option value="13:00 - 15:00" {{ old('time_range') == '13:00 - 15:00' ? 'selected' : '' }}>Jam 13:00 - 15:00</option>
                        </select>
                    </div>
                </div>

                <div style="text-align:center;">
                    <button type="submit" class="btn btn-primary btn-full" style="border-radius: 4px; font-weight: 700; padding: 10px 20px;">
                        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 2L11 13M22 2l-7 20-4-9-9-4 20-7z"/></svg>
                        Kirim Jadwal Booking
                    </button>
                </div>
            </form>
        </div>
    </div>
@endif

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/id.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        if(document.getElementById('booking_date')) {
            const holidays = @json($holidays ?? []);

            flatpickr("#booking_date", {
                locale: "id",
                dateFormat: "Y-m-d",
                altInput: true,
                altFormat: "l, j F Y",
                minDate: new Date().fp_incr(1),
                disableMobile: "true",
                disable: [
                    function(date) {
                        const y = date.getFullYear();
                        const m = String(date.getMonth() + 1).padStart(2, '0');
                        const d = String(date.getDate()).padStart(2, '0');
                        const formattedDate = `${y}-${m}-${d}`;

                        return (date.getDay() === 0 || date.getDay() === 6 || holidays.includes(formattedDate));
                    }
                ],
                onDayCreate: function(dObj, dStr, fp, dayElem) {
                    const date = dayElem.dateObj;
                    const y = date.getFullYear();
                    const m = String(date.getMonth() + 1).padStart(2, '0');
                    const d = String(date.getDate()).padStart(2, '0');
                    const formattedDate = `${y}-${m}-${d}`;

                    if (date.getDay() === 0 || date.getDay() === 6 || holidays.includes(formattedDate)) {
                        dayElem.classList.add('holiday-or-weekend');
                    }
                }
            });
        }
    });
</script>
@endsection
