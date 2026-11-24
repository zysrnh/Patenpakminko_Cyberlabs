@extends('layouts.app')

@section('title', 'Detail Permohonan ' . $application->application_number . ' — PATEN PAK MIKO')
@section('page-title', 'Detail PKKPR Berusaha')

@section('extra-styles')
@include('layouts.partials.application-detail-styles')
@endsection

@section('content')
<div class="container">
    @if($errors->any())
        <div class="alert-error" style="background:#FEF2F2;border:1px solid #FECACA;color:#991B1B;padding:12px 16px;border-radius:4px;margin-bottom:16px;display:flex;align-items:center;gap:8px;font-size:13px;font-weight:600;">
            <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            <span>{{ $errors->first() }}</span>
        </div>
    @endif

    <div class="detail-hero-card">
        <div class="detail-hero-left">
            <div class="detail-hero-top-row">
                <a href="{{ route('berusaha.index') }}" class="detail-back-btn">
                    <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Kembali ke Antrean
                </a>
                <span class="detail-reg-pill">{{ $application->application_number }}</span>
                <span class="detail-status-pill" style="background-color: {{ $application->status_color }}">
                    {{ $application->status_label }}
                </span>
            </div>
            <h1 class="detail-hero-title">Pertimbangan Teknis Pertanahan PKKPR Berusaha</h1>
            <div class="detail-hero-meta">
                <span>Pemohon: <strong>{{ $application->nama_pemohon ?? ($application->user->name ?? '-') }}</strong></span>
                <span>•</span>
                <span>Diajukan: {{ $application->created_at->locale('id')->translatedFormat('d M Y, H:i') }} WIB</span>
            </div>

            @php
                $showRollbackBtn = Auth::user()->isDpn() && !($application->status === 'menunggu_bpn' && ($application->bpn_berkas_status === 'menunggu' || !$application->bpn_berkas_status));
                $showSlaBtn = (Auth::user()->isBpn() || Auth::user()->isDpn()) && $application->bpn_pembayaran_status === 'sudah_bayar';
            @endphp
            @if($showRollbackBtn || $showSlaBtn)
                <div class="detail-admin-tools">
                    @if($showSlaBtn)
                        <button type="button" class="detail-tool-btn" onclick="toggleAdminDrawer('sla', this)">
                            <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Atur Waktu SLA
                        </button>
                    @endif
                    @if($showRollbackBtn)
                        <button type="button" class="detail-tool-btn detail-tool-btn--warn" onclick="toggleAdminDrawer('rollback', this)">
                            <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"/></svg>
                            Rollback Tahap
                        </button>
                    @endif
                </div>
            @endif
        </div>
        <div class="detail-hero-sla-slot" id="detailSlaSlot"></div>
    </div>

            <!-- BANNER PERTEK TERBIT (AGAR PEMOHON TIDAK KELEWAT) -->
            @if($application->bpn_pertek_document)
                <div class="pertek-ready-banner" style="display: flex; align-items: center; justify-content: space-between; gap: 16px; flex-wrap: wrap;">
                    <div style="display: flex; align-items: center; gap: 14px;">
                                                <div style="width: 38px; height: 38px; background: #16A34A; border-radius: 4px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; color: #FFFFFF;">
                            <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <div>
                            <div style="font-size: 14.5px; font-weight: 800; color: #065F46; margin-bottom: 2px;">
                                Dokumen Pertek Pertanahan Berusaha (BPN) Telah Terbit!
                            </div>
                            <div style="font-size: 12.5px; color: #047857;">
                                Dokumen resmi Pertimbangan Teknis Pertanahan dari Kantor Pertanahan telah selesai & dapat diunduh.
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('file.view', ['path' => $application->bpn_pertek_document]) }}" target="_blank" class="pertek-ready-btn" style="color: #ffffff; font-weight: 700; font-size: 13px; padding: 9px 18px; text-decoration: none; display: inline-flex; align-items: center; gap: 8px;" >
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                        Unduh Hasil Pertek (BPN)
                    </a>
                </div>
            @endif
            <!-- DOWNLOAD DOKUMEN FINAL PRODUK AKHIR -->
            @if($application->status === 'disetujui' && $application->satu_pintu_document)
                <a href="{{ route('file.view', ['path' => $application->satu_pintu_document]) }}" target="_blank" class="btn-download-cert" style="margin-bottom: 20px;">
                    <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                    Unduh Dokumen PKKPR Berusaha (PDF)
                </a>
            @endif
 
            <!-- FITUR ULASAN LAYANAN (ANTI-SPAM) -->
            @if($application->bpn_pertek_document)
                @php
                    $review = \App\Models\Review::where('user_id', Auth::id())
                        ->where('module_type', 'berusaha')
                        ->where('module_id', $application->id)
                        ->first();
                @endphp
 
                @if(Auth::user()->isPelakuUsaha())
                    <div class="verify-card" style="border-color: #CBD5E0; background: #F8FAFC; margin-bottom: 24px; padding: 24px;">
                        <h3 class="verify-title" style="color: var(--clr-primary); margin-bottom: 12px; display: flex; align-items: center; gap: 8px;">
                            <svg style="width:14px;height:14px;vertical-align:-2px;margin-right:4px;" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg> Ulasan & Penilaian Layanan
                        </h3>
 
                        @if($review)
                            <div style="background: #FFFFFF; border: 1.5px solid var(--clr-line); padding: 16px; border-radius: 10px;">
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                                    <span style="color: #D69E2E; font-size: 16px; font-weight: 700;">
                                        {{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5 - $review->rating) }} 
                                        <span style="color: var(--clr-primary); font-size: 13px; font-weight: 800; margin-left: 6px;">({{ $review->rating_label }})</span>
                                    </span>
                                    </div>
                                <p style="font-style: italic; font-size: 13px; color: var(--clr-muted);">"{{ $review->comment }}"</p>
                            </div>
                        @else
                            <p style="font-size: 12.5px; color: var(--clr-muted); margin-bottom: 16px;">Silakan berikan ulasan Anda terkait efisiensi pelaporan dan pelayanan kami untuk membantu kami meningkatkan kualitas sistem.</p>
                            <form action="{{ route('review.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="module_type" value="berusaha">
                                <input type="hidden" name="module_id" value="{{ $application->id }}">
                                
                                <style>
                                    .star-rating { display: flex; flex-direction: row-reverse; justify-content: flex-end; gap: 4px; }
                                    .star-rating input { display: none; }
                                    .star-rating label { font-size: 32px; color: #CBD5E0; cursor: pointer; transition: color 0.2s; line-height: 1; margin: 0; padding: 0; }
                                    .star-rating input:checked ~ label, .star-rating label:hover, .star-rating label:hover ~ label { color: #D69E2E; }
                                </style>
                                <div class="form-group-v" style="margin-bottom: 12px;">
                                    <label style="font-weight: 700; font-size: 12px; display: block; margin-bottom: 6px;">Penilaian Anda</label>
                                    <div class="star-rating">
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
 
                                <div class="form-group-v" style="margin-bottom: 16px;">
                                    <label for="comment" style="font-weight: 700; font-size: 12px;">Catatan Ulasan / Feedback</label>
                                    <textarea name="comment" id="comment" class="form-control-v" rows="2" placeholder="Tuliskan saran atau ulasan singkat Anda..." required></textarea>
                                </div>
 
                                <button type="submit" class="btn-submit-v" style="width: auto; padding: 10px 20px; font-size: 12px;">
                                    Kirim Ulasan Layanan
                                </button>
                            </form>
                        @endif
                    </div>
                @endif
            @endif
 
            <!-- LOGIKA DETEKSI TENGGANG WAKTU OTOMATIS Kantor Pertanahan -->
            @php
                $user = Auth::user();
                $now = \Carbon\Carbon::now();
                $cekLokasiLewat = $application->bpn_cek_lokasi_dt
                    && $now >= $application->bpn_cek_lokasi_dt;
                $rapatLewat = $application->bpn_rapat_dt
                    && $now >= $application->bpn_rapat_dt;
            @endphp
            
            <!-- FITUR ULASAN LAYANAN -->
            @if($application->status === 'selesai' || $application->status === 'ditolak')
                @php
                    $review = \App\Models\Review::where('user_id', Auth::id())
                        ->where('module_type', 'berusaha')
                        ->where('module_id', $application->id)
                        ->first();
                @endphp
 
                @if(Auth::user()->isPelakuUsaha())
                    <div class="verify-card" style="border-color: #CBD5E0; background: #F8FAFC; margin-bottom: 24px; padding: 24px; border-radius: 12px; border: 1.5px solid var(--clr-line);">
                        <h3 class="verify-title" style="color: var(--clr-blue); margin-bottom: 12px; display: flex; align-items: center; gap: 8px; font-weight: 800; font-size: 16px;">
                            <svg style="width:14px;height:14px;vertical-align:-2px;margin-right:4px;" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg> Ulasan & Penilaian Layanan
                        </h3>
 
                        @if($review)
                            <div style="background: #FFFFFF; border: 1.5px solid var(--clr-line); padding: 16px; border-radius: 10px;">
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                                    <span style="color: var(--clr-yellow); font-size: 16px; font-weight: 700;">
                                        {{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5 - $review->rating) }} 
                                        <span style="color: var(--clr-ink); font-size: 13px; font-weight: 800; margin-left: 6px;">({{ $review->rating_label }})</span>
                                    </span>
                                    @if($review->is_approved)
                                        <span style="font-size: 11px; background: #EBF8FF; color: #2B6CB0; padding: 3px 10px; border-radius: 100px; font-weight: 700;">Telah Dipublikasikan</span>
                                    @else
                                        <span style="font-size: 11px; background: #E2E8F0; color: #4A5568; padding: 3px 10px; border-radius: 100px; font-weight: 700;">Menunggu Moderasi Admin</span>
                                    @endif
                                </div>
                                <p style="font-style: italic; font-size: 13px; color: var(--clr-muted);">"{{ $review->comment }}"</p>
                            </div>
                        @else
                            <p style="font-size: 12.5px; color: var(--clr-muted); margin-bottom: 16px;">Silakan berikan ulasan Anda terkait efisiensi pelaporan dan pelayanan kami untuk membantu kami meningkatkan kualitas sistem.</p>
                            <form action="{{ route('review.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="module_type" value="berusaha">
                                <input type="hidden" name="module_id" value="{{ $application->id }}">
                                
                                <style>
                                    .star-rating { display: flex; flex-direction: row-reverse; justify-content: flex-end; gap: 4px; }
                                    .star-rating input { display: none; }
                                    .star-rating label { font-size: 32px; color: #CBD5E0; cursor: pointer; transition: color 0.2s; line-height: 1; margin: 0; padding: 0; }
                                    .star-rating input:checked ~ label, .star-rating label:hover, .star-rating label:hover ~ label { color: #D69E2E; }
                                </style>
                                <div class="form-group" style="margin-bottom: 12px;">
                                    <label style="font-weight: 700; font-size: 12px; display: block; margin-bottom: 6px;">Penilaian Anda</label>
                                    <div class="star-rating">
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
 
                                <div class="form-group" style="margin-bottom: 16px;">
                                    <label for="comment" style="font-weight: 700; font-size: 12px; display: block; margin-bottom: 6px;">Catatan Ulasan / Feedback</label>
                                    <textarea name="comment" id="comment" style="width:100%; padding: 10px; border-radius: 8px; border: 1.5px solid var(--clr-line); font-size:13.5px; resize:none;" rows="2" placeholder="Tuliskan saran atau ulasan singkat Anda..." required></textarea>
                                </div>
 
                                <button type="submit" style="background: var(--clr-blue); color: white; border: none; padding: 10px 20px; border-radius: 8px; font-weight: 700; font-size: 12.5px; cursor: pointer;">
                                    Kirim Ulasan Layanan
                                </button>
                            </form>
                        @endif
                    </div>
                @endif
            @endif
 
            <!-- KEMBALI KE TAHAP SEBELUMNYA (ROLLBACK STATUS & NOTIFIKASI WA) -->
            @if(Auth::user()->isDpn() && !($application->status === 'menunggu_bpn' && ($application->bpn_berkas_status === 'menunggu' || !$application->bpn_berkas_status)))
                <div class="verify-card admin-drawer-card" data-drawer="rollback" style="border: 1px solid #FBD38D; background: #FFFBEB; padding: 18px 20px;">
                    <h3 class="verify-title" style="color: #C05621; margin-bottom: 8px; display: flex; align-items: center; gap: 8px; font-size: 15px; font-weight: 700;">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"/></svg>
                        Kembali ke Tahap Sebelumnya (Rollback Status & Notifikasi WA)
                    </h3>
                    <p style="font-size: 12.5px; color: #7B341E; margin-bottom: 12px;">
                        Gunakan fitur ini jika permohonan perlu dikembalikan ke tahap pemeriksaan sebelumnya. Status permohonan di database akan diperbarui dan notifikasi WhatsApp ke pihak terkait akan otomatis dibuatkan.
                    </p>
                    <form action="{{ route('application.rollback', ['type' => 'berusaha', 'id' => $application->id]) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin mengembalikan status permohonan ini ke tahap sebelumnya?');">
                        @csrf
                        <button type="submit" style="background: #DD6B20; border: none; color: #fff; font-weight: 700; font-size: 12.5px; padding: 9px 18px; border-radius: 6px; cursor: pointer; display: inline-flex; align-items: center; gap: 6px;">
                            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"/></svg>
                            Rollback Status & Kirim Notifikasi WA
                        </button>
                    </form>
                </div>
            @endif

            {{-- MAJU KE TAHAP BERIKUTNYA (DISEMBUNYIKAN SEMENTARA) --}}
            @if(false)
                <div class="verify-card" style="border: 1px solid #B2F5EA; background: #F0FFF4; margin-bottom: 24px; padding: 16px; border-radius: 8px;">
                    <h3 class="verify-title" style="color: #276749; margin-bottom: 8px; display: flex; align-items: center; gap: 8px; font-size: 15px; font-weight: 700;">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10H11a8 8 0 00-8 8v2M21 10l-6 6m6-6l-6-6"/></svg>
                        Maju ke Tahap Berikutnya (Forward Status & Notifikasi WA)
                    </h3>
                    <p style="font-size: 12.5px; color: #276749; margin-bottom: 12px;">
                        Gunakan fitur ini untuk memajukan status permohonan ke tahap berikutnya secara bypass. Status akan diperbarui dan notifikasi WhatsApp ke pihak terkait akan otomatis dibuatkan.
                    </p>
                    <form action="{{ route('application.forward', ['type' => 'berusaha', 'id' => $application->id]) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin memajukan status permohonan ini ke tahap berikutnya?');">
                        @csrf
                        <button type="submit" style="background: #276749; border: none; color: #fff; font-weight: 700; font-size: 12.5px; padding: 9px 18px; border-radius: 6px; cursor: pointer; display: inline-flex; align-items: center; gap: 6px;">
                            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10H11a8 8 0 00-8 8v2M21 10l-6 6m6-6l-6-6"/></svg>
                            Maju ke Tahap Berikutnya & Kirim Notifikasi WA
                        </button>
                    </form>
                </div>
            @endif

            <!-- PENGATURAN SLA WAKTU LAYANAN (HANYA ADMIN Kantor Pertanahan / DPN) -->
            @if((Auth::user()->isBpn() || Auth::user()->isDpn()) && $application->bpn_pembayaran_status === 'sudah_bayar')
                <div class="verify-card admin-drawer-card" data-drawer="sla" style="border: 1px solid #93C5FD; background: #F0F9FF; padding: 18px 20px;">
                    <h3 class="verify-title" style="color: #2B6CB0; margin-bottom: 12px; display: flex; align-items: center; gap: 8px;">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Pengaturan Waktu Mulai & Selesai Layanan (SLA)
                    </h3>
                    <p style="font-size: 13px; color: #2C5282; margin-bottom: 12px;">
                        Gunakan fitur ini untuk menyesuaikan tanggal mulai atau berakhirnya layanan secara manual jika terdapat kendala sistem, terpotong hari libur, atau penundaan lainnya. Kosongkan jika ingin mengikuti waktu default.
                    </p>
                    @php
                        $verifyRoute = match(Route::currentRouteName()) {
                            'berusaha.show' => 'berusaha.verify',
                            'non-berusaha.show' => 'non-berusaha.verify',
                            'kebijakan.show' => 'kebijakan.verify',
                            'tanah-timbul.show' => 'tanah-timbul.verify',
                            'psn.show' => 'psn.verify',
                            default => 'berusaha.verify'
                        };

                        $isPuPhaseOpt = in_array($application->status, ['menunggu_dinas_pu', 'menunggu_satu_pintu', 'menunggu_putr', 'disetujui', 'terbit_pkpr']) || $application->bpn_pertek_document;
                        $defaultDaysOpt = $isPuPhaseOpt ? 20 : 10;

                        $autoStart = $application->tgl_mulai_layanan 
                            ? \Carbon\Carbon::parse($application->tgl_mulai_layanan) 
                            : ($application->bpn_pembayaran_approved_at ? \Carbon\Carbon::parse($application->bpn_pembayaran_approved_at) : $application->created_at);

                        $autoTarget = $application->tgl_selesai_layanan 
                            ? \Carbon\Carbon::parse($application->tgl_selesai_layanan) 
                            : $autoStart->copy()->addWorkingDaysWithHolidays($defaultDaysOpt);

                        $workingDaysDuration = (int)$autoStart->diffInWorkingDaysWithHolidays($autoTarget);
                        $calendarDaysDuration = (int)$autoStart->diffInDays($autoTarget);
                    @endphp
                    <form action="{{ route($verifyRoute, $application->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="step" value="update_sla">
                        <div class="form-grid-2" style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                            <div class="form-group-v">
                                <label for="tgl_mulai_layanan" style="font-weight: 600; display: block; margin-bottom: 8px; font-size: 13px; color: #2B6CB0;">Tanggal Mulai Layanan</label>
                                <input type="datetime-local" name="tgl_mulai_layanan" id="tgl_mulai_layanan" class="form-control-v" style="border: 1px solid #63B3ED;"
                                       value="{{ $autoStart->format('Y-m-d\TH:i') }}">
                            </div>
                            <div class="form-group-v">
                                <label for="tgl_selesai_layanan" style="font-weight: 600; display: block; margin-bottom: 8px; font-size: 13px; color: #2B6CB0;">Tanggal Berakhir Layanan (SLA)</label>
                                <input type="datetime-local" name="tgl_selesai_layanan" id="tgl_selesai_layanan" class="form-control-v" style="border: 1px solid #63B3ED;"
                                       value="{{ $autoTarget->format('Y-m-d\TH:i') }}">
                            </div>
                        </div>
                        <div id="slaDurationInfo" style="margin-top: 10px; font-size: 12.5px; font-weight: 700; color: #1A365D; background: #E2E8F0; padding: 6px 12px; border-radius: 6px; display: inline-flex; align-items: center; gap: 6px;">
                            <span>⏱️ Durasi Terpasang: <strong id="txtWorkingDays" style="color: #2B6CB0;">{{ $workingDaysDuration }}</strong> Hari Kerja Efektif (<span id="txtCalendarDays">{{ $calendarDaysDuration }}</span> Hari Kalender)</span>
                        </div>
                        <div>
                            <button type="submit" class="btn-submit-v" style="margin-top: 12px; background: #3182CE; padding: 8px 16px;">Simpan Pengaturan Waktu</button>
                        </div>
                    </form>
                </div>
            @endif

            <!-- ==================================================== -->
            <!-- ─── VERIFICATION PANELS FOR DIFFERENT ROLES ──────── -->
            <!-- ==================================================== -->
 
            <!-- 1. Kantor Pertanahan PANEL -->
                    <!-- SUB-STEP 1: Verifikasi Berkas Awal -->
                        <div id="bpn-panel-1" class="bpn-panel-step" style="display: {{ in_array($application->bpn_berkas_status, ['menunggu', 'diterima', 'tidak_sesuai', 'ditolak']) ? 'block' : 'none' }};">
                            @php $isStep1Active = (Auth::user()->isBpn() && $application->bpn_pembayaran_status !== 'sudah_bayar'); @endphp
                            <fieldset {{ $isStep1Active ? '' : 'disabled' }}>
                                <form action="{{ route('berusaha.verify', $application->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="step" value="bpn_berkas">
                                    <div style="background:#FFFDF5;border:1px solid #F6AD55;padding:12px 16px;border-radius:8px;font-size:13px;color:#7B341E;margin-bottom:20px;">
                                        <strong>Langkah 1: Verifikasi Kelayakan Dokumen Persyaratan:</strong> Periksa kelengkapan dokumen persyaratan yang diunggah pemohon, lalu terima atau tolak. Notifikasi WA akan terkirim otomatis.
                                    </div>
                                    <div class="form-group-v" style="margin-bottom: 20px;">
                                        <label class="form-label" style="font-weight:700;color:#744210;margin-bottom:8px;display:block;">Tindakan Pemeriksaan Berkas:</label>
                                        <div style="display: flex; gap: 20px;">
                                            <label style="display:flex;align-items:center;gap:6px;font-size:13.5px;font-weight:600;cursor:pointer;">
                                                <input type="radio" name="action" value="approve" required {{ $application->bpn_berkas_status === 'diterima' ? 'checked' : ($application->bpn_berkas_status === 'tidak_sesuai' ? '' : 'checked') }} style="width:16px;height:16px;accent-color:var(--clr-blue);" onchange="document.getElementById('revisi-berkas-container').style.display='none';"> Disetujui / Lengkap
                                            </label>
                                            <label style="display:flex;align-items:center;gap:6px;font-size:13.5px;font-weight:600;color:#E53E3E;cursor:pointer;">
                                                <input type="radio" name="action" value="reject" required {{ $application->bpn_berkas_status === 'tidak_sesuai' || $application->bpn_berkas_status === 'ditolak' ? 'checked' : '' }} style="width:16px;height:16px;accent-color:var(--clr-blue);" onchange="document.getElementById('revisi-berkas-container').style.display='block';"> Tidak Lengkap
                                            </label>
                                        </div>
                                    </div>

                                    <div id="revisi-berkas-container" style="display:none; margin-bottom: 12px; background: #fff5f5; padding: 12px; border: 1px solid #fed7d7; border-radius: 4px;">
                                        <label style="font-weight: 600; font-size: 12px; color: #c53030; margin-bottom: 8px; display: block;">Tandai Berkas yang Tidak Valid / Kurang Lengkap (Otomatis masuk ke catatan):</label>
                                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 6px; font-size: 12px;">
                                            <label><input type="checkbox" class="cb-revisi" value="Formulir PTP"> Formulir PTP</label>
                                            <label><input type="checkbox" class="cb-revisi" value="Peta Lokasi / Sketsa"> Peta Lokasi / Sketsa</label>
                                            <label><input type="checkbox" class="cb-revisi" value="KTP Pemohon"> KTP Pemohon</label>
                                            <label><input type="checkbox" class="cb-revisi" value="NPWP"> NPWP</label>
                                            <label><input type="checkbox" class="cb-revisi" value="Surat Kuasa"> Surat Kuasa</label>
                                            <label><input type="checkbox" class="cb-revisi" value="Akta Pendirian"> Akta Pendirian</label>
                                            <label><input type="checkbox" class="cb-revisi" value="Rencana Penggunaan Tanah"> Rencana Penggunaan Tanah</label>
                                            <label><input type="checkbox" class="cb-revisi" value="NIB"> NIB</label>
                                            <label><input type="checkbox" class="cb-revisi" value="Sertifikat Standar / KBLI"> Sertifikat Standar / KBLI</label>
                                            <label><input type="checkbox" class="cb-revisi" value="Proposal Kegiatan"> Proposal Kegiatan</label>
                                            <label><input type="checkbox" class="cb-revisi" value="Persyaratan Lainnya"> Persyaratan Lainnya</label>
                                        </div>
                                    </div>
                                    <div class="form-group-v">
                                        <label for="notes">Catatan Pemeriksaan</label>
                                        <textarea name="notes" id="notes" class="form-control-v" rows="3" placeholder="Masukkan catatan atau instruksi perbaikan..." required>{{ $application->bpn_berkas_status !== 'menunggu' ? $application->bpn_notes : '' }}</textarea>
                                    </div>
                                    @if($isStep1Active)
                                        
                                    <div class="form-group-v" style="margin-bottom: 12px; border-top: 1px dashed var(--clr-line); padding-top: 12px; margin-top: 12px;">
                                        <label style="font-size: 11.5px; color: var(--clr-muted); font-weight: 600;">✎ Edit Pesan WA (Opsional):</label>
                                        <textarea name="custom_wa_message" class="form-control-v" rows="2" placeholder="Tuliskan pesan khusus jika ingin mengganti template bawaan otomatis..."></textarea>
                                    </div>
                                    <button type="submit" class="btn-submit-v">Simpan Verifikasi Berkas & Send WA</button>
                                    @else
                                        
                                    @endif
                                </form>
                            </fieldset>
                            @if(Auth::user()->isBpn() && $application->bpn_berkas_status === 'diterima')
                                <form action="{{ route('berusaha.verify', $application->id) }}" method="POST" style="margin-top: 12px;">
                                    @csrf
                                    <input type="hidden" name="step" value="resend_wa">
                                    <input type="hidden" name="wa_type" value="berkas_verifikasi">
                                    <button type="submit" class="btn-submit-v" style="background: var(--clr-green); width: 100%; justify-content: center;">
                                        Kirim Ulang Notifikasi WhatsApp Verifikasi
                                    </button>
                                </form>
                            @endif
                        </div>

                        <div id="bpn-panel-2" class="bpn-panel-step" style="display: {{ $application->dinas_pu_status === 'validasi_awal_diterima' && $application->bpn_pembayaran_status === 'belum_bayar' ? 'block' : 'none' }};">
                            @php $isStep2Active = (Auth::user()->isBpn() && $application->bpn_pembayaran_status === 'belum_bayar'); @endphp
                            <fieldset {{ $isStep2Active ? '' : 'disabled' }}>
                                <form action="{{ route('berusaha.verify', $application->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="step" value="bpn_pembayaran">
                                    <div style="display: flex; gap: 8px; align-items: center; margin-bottom: 12px;">
                                        <strong style="font-size: 13px;">Langkah 2: Konfirmasi Pembayaran PNBP & Input No. Berkas</strong>
                                    </div>
                                    <p style="font-size: 13px; color: var(--clr-muted); margin-bottom: 16px;">
                                        Setelah pemohon melakukan pembayaran PNBP secara offline, input <strong>Nomor Berkas</strong> di bawah lalu klik <strong>"Kirim Kredensial & Konfirmasi Lunas"</strong> untuk memverifikasi lunas dan otomatis mengirimkan kredensial login dashboard ke WhatsApp pemohon.
                                    </p>
                                    <div class="form-group-v">
                                        <label for="no_berkas">Nomor Berkas (wajib diisi)</label>
                                        <input type="text" name="no_berkas" id="no_berkas" class="form-control-v"
                                               placeholder="cth: BERKAS/Pertimbangan Teknis Pertanahan-B/2026/001"
                                               value="{{ $application->no_berkas ?? old('no_berkas') }}" required>
                                        <span style="font-size: 11px; color: var(--clr-muted);">Nomor berkas ini akan dicatat dalam sistem dan dikirim ke pemohon via WhatsApp.</span>
                                    </div>
                                    @if($isStep2Active)
                                        
                                    <div class="form-group-v" style="margin-bottom: 12px; border-top: 1px dashed var(--clr-line); padding-top: 12px; margin-top: 12px;">
                                        <label style="font-size: 11.5px; color: var(--clr-muted); font-weight: 600;">✎ Edit Pesan WA (Opsional):</label>
                                        <textarea name="custom_wa_message" class="form-control-v" rows="2" placeholder="Tuliskan pesan khusus jika ingin mengganti template bawaan otomatis..."></textarea>
                                    </div>
                                        <button type="submit" class="btn-submit-v">
                                            <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 2L11 13M22 2l-7 20-4-9-9-4 20-7z"/></svg>
                                            Kirim Kredensial & Konfirmasi Lunas
                                        </button>
                                    @else
                                        
                                    @endif
                                </form>
                            </fieldset>
                            @if(Auth::user()->isBpn() && $application->bpn_pembayaran_status === 'sudah_bayar')
                                <form action="{{ route('berusaha.verify', $application->id) }}" method="POST" style="margin-top: 16px;">
                                    @csrf
                                    <input type="hidden" name="step" value="resend_wa">
                                    <input type="hidden" name="wa_type" value="credential">
                                    <button type="submit" class="btn-submit-v" style="background: var(--clr-green); width: 100%; justify-content: center;">
                                        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 2L11 13M22 2l-7 20-4-9-9-4 20-7z"/></svg>
                                        Kirim Ulang Notifikasi Kredensial & No. Berkas (WhatsApp)
                                    </button>
                                </form>
                            @endif
                        </div>

                        <div id="bpn-panel-3" class="bpn-panel-step" style="display: {{ $application->bpn_pembayaran_status === 'sudah_bayar' && (!$application->bpn_cek_lokasi_dt || !$cekLokasiLewat) ? 'block' : 'none' }};">
                            @php $isStep3Active = (Auth::user()->isBpn() && $application->bpn_pembayaran_status === 'sudah_bayar' && (!$application->bpn_cek_lokasi_dt || !$cekLokasiLewat)); @endphp
                            <fieldset {{ $isStep3Active ? '' : 'disabled' }}>
                                <form action="{{ route('berusaha.verify', $application->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="step" value="bpn_cek_lokasi">
                                    <div style="display: flex; gap: 8px; align-items: center; margin-bottom: 12px;">
                                        <strong style="font-size: 13px;">Langkah 3: Jadwal Cek Lapangan</strong>
                                    </div>
                                    <div class="form-grid-2">
                                        <div class="form-group-v">
                                            <label for="bpn_cek_lokasi_dt">Tanggal & Waktu Peninjauan</label>
                                            <div style="display:flex; gap:8px;">
                                                <input type="datetime-local" name="bpn_cek_lokasi_dt" id="bpn_cek_lokasi_dt" class="form-control-v" 
                                                       value="{{ $application->bpn_cek_lokasi_dt ? $application->bpn_cek_lokasi_dt->format('Y-m-d\TH:i') : '' }}" style="flex-grow:1;" required>
                                                <button type="button" onclick="let d = new Date(); if(document.getElementById('bpn_cek_lokasi_dt')._flatpickr) document.getElementById('bpn_cek_lokasi_dt')._flatpickr.setDate(d); else document.getElementById('bpn_cek_lokasi_dt').value = new Date(d.getTime() - (d.getTimezoneOffset() * 60000)).toISOString().slice(0,16);" style="background:#e2e8f0; border:1px solid #cbd5e1; padding:0 12px; border-radius:6px; font-size:11px; font-weight:700; color:#475569; cursor:pointer;" title="Set ke waktu saat ini untuk test skip">📍 Sekarang</button>
                                            </div>
                                        </div>
                                        <div class="form-group-v">
                                            <label for="bpn_cek_lokasi_cp">Kontak Person Petugas Lapang</label>
                                            <input type="text" name="bpn_cek_lokasi_cp" id="bpn_cek_lokasi_cp" class="form-control-v" placeholder="cth: Admin Kantor Pertanahan (081234567891)" 
                                                   value="{{ $application->bpn_cek_lokasi_cp }}" required>
                                        </div>
                                    </div>
                                    @if($isStep3Active)
                                        
                                    <div class="form-group-v" style="margin-bottom: 12px; border-top: 1px dashed var(--clr-line); padding-top: 12px; margin-top: 12px;">
                                        <label style="font-size: 11.5px; color: var(--clr-muted); font-weight: 600;">✎ Edit Pesan WA (Opsional):</label>
                                        <textarea name="custom_wa_message" class="form-control-v" rows="2" placeholder="Tuliskan pesan khusus jika ingin mengganti template bawaan otomatis..."></textarea>
                                    </div>
                                        <button type="submit" class="btn-submit-v" style="background: {{ $application->bpn_cek_lokasi_dt ? '#D69E2E' : 'var(--clr-blue)' }};">
                                            <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 2L11 13M22 2l-7 20-4-9-9-4 20-7z"/></svg>
                                            {{ $application->bpn_cek_lokasi_dt ? 'Rubah Jadwal & Kirim WA' : 'Kirimkan Jadwal Peninjauan Lapangan' }}
                                        </button>
                                    @else
                                        
                                    @endif
                                </form>
                            </fieldset>
                            @if(!$isStep3Active && Auth::user()->isBpn() && $application->bpn_cek_lokasi_dt)
                                <form action="{{ route('berusaha.verify', $application->id) }}" method="POST" style="margin-top: 16px;">
                                    @csrf
                                    <input type="hidden" name="step" value="resend_wa">
                                    <input type="hidden" name="wa_type" value="cek_lokasi">
                                    <div style="margin-bottom: 8px;">
                                        <label style="font-size: 11px; color: var(--clr-muted);">Edit Pesan WA (Opsional):</label>
                                        <textarea name="custom_wa_message" class="form-control-v" rows="2" placeholder="Tuliskan pesan khusus jika ingin mengganti template bawaan..."></textarea>
                                    </div>
                                    <button type="submit" class="btn-submit-v" style="background: var(--clr-blue); width: 100%; justify-content: center;">
                                        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 2L11 13M22 2l-7 20-4-9-9-4 20-7z"/></svg>
                                        Kirim Ulang Pesan WA
                                    </button>
                                </form>
                            @endif
                        </div>

                        <div id="bpn-panel-4" class="bpn-panel-step" style="display: {{ $application->bpn_cek_lokasi_dt && $cekLokasiLewat && (!$application->bpn_rapat_dt || !$rapatLewat) ? 'block' : 'none' }};">
                            @php $isStep4Active = (Auth::user()->isBpn() && $application->bpn_cek_lokasi_dt && $cekLokasiLewat && (!$application->bpn_rapat_dt || !$rapatLewat)); @endphp
                            <fieldset {{ $isStep4Active ? '' : 'disabled' }}>
                                <form action="{{ route('berusaha.verify', $application->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="step" value="bpn_rapat">
                                    <div style="display: flex; gap: 8px; align-items: center; margin-bottom: 12px;">
                                        <strong style="font-size: 13px;">Langkah 4: Jadwal Sidang / Rapat Koordinasi</strong>
                                    </div>
                                    <div class="form-group-v">
                                        <label for="bpn_rapat_dt">Tanggal & Waktu Rapat</label>
                                        <div style="display:flex; gap:8px;">
                                            <input type="datetime-local" name="bpn_rapat_dt" id="bpn_rapat_dt" class="form-control-v" 
                                                   value="{{ $application->bpn_rapat_dt ? $application->bpn_rapat_dt->format('Y-m-d\TH:i') : '' }}" style="flex-grow:1;" required>
                                            <button type="button" onclick="let d = new Date(); if(document.getElementById('bpn_rapat_dt')._flatpickr) document.getElementById('bpn_rapat_dt')._flatpickr.setDate(d); else document.getElementById('bpn_rapat_dt').value = new Date(d.getTime() - (d.getTimezoneOffset() * 60000)).toISOString().slice(0,16);" style="background:#e2e8f0; border:1px solid #cbd5e1; padding:0 12px; border-radius:6px; font-size:11px; font-weight:700; color:#475569; cursor:pointer;" title="Set ke waktu saat ini untuk test skip">📍 Sekarang</button>
                                        </div>
                                    </div>
                                    @if($isStep4Active)
                                        
                                    <div class="form-group-v" style="margin-bottom: 12px; border-top: 1px dashed var(--clr-line); padding-top: 12px; margin-top: 12px;">
                                        <label style="font-size: 11.5px; color: var(--clr-muted); font-weight: 600;">✎ Edit Pesan WA (Opsional):</label>
                                        <textarea name="custom_wa_message" class="form-control-v" rows="2" placeholder="Tuliskan pesan khusus jika ingin mengganti template bawaan otomatis..."></textarea>
                                    </div>
                                        <button type="submit" class="btn-submit-v" style="background: {{ $application->bpn_rapat_dt ? '#D69E2E' : 'var(--clr-blue)' }};">
                                            <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 2L11 13M22 2l-7 20-4-9-9-4 20-7z"/></svg>
                                            {{ $application->bpn_rapat_dt ? 'Rubah Jadwal Rapat & Kirim WA' : 'Kirimkan Jadwal Rapat' }}
                                        </button>
                                    @else
                                        
                                    @endif
                                </form>
                            </fieldset>
                            @if(!$isStep4Active && Auth::user()->isBpn() && $application->bpn_rapat_dt)
                                <form action="{{ route('berusaha.verify', $application->id) }}" method="POST" style="margin-top: 16px;">
                                    @csrf
                                    <input type="hidden" name="step" value="resend_wa">
                                    <input type="hidden" name="wa_type" value="rapat">
                                    <div style="margin-bottom: 8px;">
                                        <label style="font-size: 11px; color: var(--clr-muted);">Edit Pesan WA (Opsional):</label>
                                        <textarea name="custom_wa_message" class="form-control-v" rows="2" placeholder="Tuliskan pesan khusus jika ingin mengganti template bawaan..."></textarea>
                                    </div>
                                    <button type="submit" class="btn-submit-v" style="background: var(--clr-blue); width: 100%; justify-content: center;">
                                        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 2L11 13M22 2l-7 20-4-9-9-4 20-7z"/></svg>
                                        Kirim Ulang Jadwal Sidang/Rapat (WhatsApp)
                                    </button>
                                </form>
                            @endif
                        </div>

                        <div id="bpn-panel-5" class="bpn-panel-step" style="display: {{ $application->bpn_rapat_dt && $rapatLewat && !$application->bpn_pertek_document ? 'block' : 'none' }};">
                            @php $isStep5Active = (Auth::user()->isBpn() && $application->bpn_rapat_dt && $rapatLewat && !$application->bpn_pertek_document); @endphp
                            <fieldset {{ $isStep5Active ? '' : 'disabled' }}>
                                <form action="{{ route('berusaha.verify', $application->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="step" value="bpn_pertek">
                                    <div style="display: flex; gap: 8px; align-items: center; margin-bottom: 12px;">
                                        <strong style="font-size: 13px;">Langkah 5: Penerbitan Pertek Pertanahan</strong>
                                    </div>
                                    <div class="form-group-v">
                                        <select name="action" id="action" class="form-select-v" required>
                                            <option value="approve" {{ $application->bpn_pertek_document || $application->status === 'disetujui' ? 'selected' : '' }}>Terbit</option>
                                            <option value="reject" {{ $application->status === 'ditolak' && !$application->bpn_pertek_document && $application->bpn_berkas_status === 'diterima' ? 'selected' : '' }}>Belum Terbit</option>
                                        </select>
                                    </div>
                                    @if($application->bpn_pertek_document)
                                        <div class="form-group-v">
                                            <label for="bpn_pertek_document">Dokumen Pertek</label>
                                            <a href="{{ route('file.view', ['path' => $application->bpn_pertek_document]) }}" target="_blank" style="display:inline-flex; align-items:center; gap:8px; padding:8px 16px; background:#F97316; border:none; border-radius:6px; color:#ffffff; font-size:13px; font-weight:600; text-decoration:none; margin-top:4px; transition:all 0.2s;" onmouseover="this.style.background='#EA580C'" onmouseout="this.style.background='#F97316'">
                                                <svg viewBox="0 0 24 24" width="16" height="16" stroke="currentColor" stroke-width="2" fill="none"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                                                Lihat Dokumen Terunggah
                                            </a>
                                        </div>
                                    @else
                                        <div class="form-group-v">
                                            <label for="bpn_pertek_document">Dokumen Pertimbangan Teknis Pertanahan (PDF)</label>
                                            <input type="file" name="bpn_pertek_document" id="bpn_pertek_document" class="form-control-v" accept=".pdf">
                                            <span style="font-size: 11px; color: var(--clr-muted);">*Wajib diunggah jika permohonan disetujui. Maksimal 100MB.</span>
                                        </div>
                                    @endif
                                    <div class="form-group-v">
                                        <label for="notes">Catatan Pertimbangan Teknis Kantor Pertanahan</label>
                                        <textarea name="notes" id="notes" class="form-control-v" rows="3" placeholder="Masukkan ringkasan kajian tata ruang pertanahan..." required>{{ $application->status === 'disetujui' || ($application->status === 'ditolak' && !$application->bpn_pertek_document && $application->bpn_berkas_status === 'diterima') ? $application->bpn_notes : '' }}</textarea>
                                    </div>
                                    @if($isStep5Active)
                                        
                                    <div class="form-group-v" style="margin-bottom: 12px; border-top: 1px dashed var(--clr-line); padding-top: 12px; margin-top: 12px;">
                                        <label style="font-size: 11.5px; color: var(--clr-muted); font-weight: 600;">✎ Edit Pesan WA (Opsional):</label>
                                        <textarea name="custom_wa_message" class="form-control-v" rows="2" placeholder="Tuliskan pesan khusus jika ingin mengganti template bawaan otomatis..."></textarea>
                                    </div>
                                    <button type="submit" class="btn-submit-v">Kirim Pertek Pertanahan</button>
                                    @else
                                        
                                    @endif
                                </form>
                            </fieldset>
                        </div>
                        
                        <script>
                            function showBpnPanel(stepNum) {
                                document.querySelectorAll('.bpn-panel-step').forEach(function(el) {
                                    el.style.display = 'none';
                                });
                                var target = document.getElementById('bpn-panel-' + stepNum);
                                if(target) {
                                    target.style.display = 'block';
                                    target.scrollIntoView({ behavior: 'smooth', block: 'center' });
                                }
                            }
                        </script>

            <!-- 2. DINAS PU PANEL -->
            @if(($user->isDinasPu() || $user->isDinasPutr() || $user->isDpn()) && (in_array($application->status, ['menunggu_dinas_pu', 'menunggu_putr']) || ($application->bpn_berkas_status === 'diterima' && $application->dinas_pu_status !== 'validasi_awal_diterima' && $application->dinas_pu_status !== 'sesuai')))
                @if(in_array($application->dinas_pu_status, ['menunggu_validasi_awal', 'menunggu', null, '']) && $application->dinas_pu_status !== 'validasi_awal_diterima')
                    <div id="bpn-panel-pu-1" class="verify-card bpn-panel-step" style="border-color: var(--clr-blue); background: #FAFDFE;">
                        <h3 class="verify-title">🏢 Panel Validasi Permohonan Awal — Dinas Pekerjaan Umum dan Tata Ruang (PUTR)</h3>
                        <form action="{{ route('berusaha.verify', $application->id) }}" method="POST">
                            @csrf
                            <div class="form-group-v">
                                <label for="action">Hasil Validasi Permohonan</label>
                                <select name="action" id="action" class="form-select-v" required>
                                    <option value="approve">Tervalidasi</option>
                                    <option value="reject">Belum Tervalidasi</option>
                                </select>
                            </div>
                            <div class="form-group-v">
                                <label for="notes">Catatan Hasil Validasi</label>
                                <textarea name="notes" id="notes" class="form-control-v" rows="3" placeholder="Masukkan detail alasan/catatan validasi awal..." required></textarea>
                            </div>
                            
                                    <div class="form-group-v" style="margin-bottom: 12px; border-top: 1px dashed var(--clr-line); padding-top: 12px; margin-top: 12px;">
                                        <label style="font-size: 11.5px; color: var(--clr-muted); font-weight: 600;">✎ Edit Pesan WA (Opsional):</label>
                                        <textarea name="custom_wa_message" class="form-control-v" rows="2" placeholder="Tuliskan pesan khusus jika ingin mengganti template bawaan otomatis..."></textarea>
                                    </div>
                            <button type="submit" class="btn-submit-v">Kirim Validasi Awal</button>
                        </form>
                    </div>
                @else
                    <div id="bpn-panel-pu-2" class="verify-card bpn-panel-step">
                        <h3 class="verify-title">⚙️ Panel Penilaian PKKPR Berusaha — Dinas Pekerjaan Umum (PU)</h3>
                        <form action="{{ route('berusaha.verify', $application->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group-v">
                                <label for="action">Penilaian Kepatuhan Tata Ruang</label>
                                <select name="action" id="action" class="form-select-v" required>
                                    <option value="sesuai">Sudah Dinilai</option>
                                    <option value="belum_sesuai">Belum Dinilai</option>
                                </select>
                            </div>
                            <div class="form-grid-2" style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                                <div class="form-group-v">
                                    <label for="dinas_pu_tanggal_penilaian">Tanggal Penilaian (Wajib)</label>
                                    <input type="date" name="dinas_pu_tanggal_penilaian" id="dinas_pu_tanggal_penilaian" class="form-control-v" required>
                                </div>
                                <div class="form-group-v">
                                    <label for="dinas_pu_document">Dokumen Penilaian Tata Ruang (PDF, Opsional)</label>
                                    <input type="file" name="dinas_pu_document" id="dinas_pu_document" class="form-control-v" accept=".pdf">
                                    <span style="font-size: 11px; color: var(--clr-muted);">*File yang diunggah hanya dapat diakses oleh Kantor Pertanahan.</span>
                                </div>
                            </div>
                            <div class="form-group-v">
                                <label for="notes">Catatan Penilaian PKKPR Berusaha</label>
                                <textarea name="notes" id="notes" class="form-control-v" rows="3" placeholder="Masukkan catatan tambahan justifikasi kesesuaian pemanfaatan ruang..."></textarea>
                            </div>
                            
                                    <div class="form-group-v" style="margin-bottom: 12px; border-top: 1px dashed var(--clr-line); padding-top: 12px; margin-top: 12px;">
                                        <label style="font-size: 11.5px; color: var(--clr-muted); font-weight: 600;">✎ Edit Pesan WA (Opsional):</label>
                                        <textarea name="custom_wa_message" class="form-control-v" rows="2" placeholder="Tuliskan pesan khusus jika ingin mengganti template bawaan otomatis..."></textarea>
                                    </div>
                            <button type="submit" class="btn-submit-v">Kirim Penilaian PU</button>
                        </form>
                    </div>
                @endif
            @endif
 
            <!-- 3. DINAS SATU PINTU (PTSP) PANEL -->
            @if($user->isSatuPintu() && $application->status === 'menunggu_satu_pintu')
                <div id="bpn-panel-satu-pintu" class="verify-card bpn-panel-step">
                    <h3 class="verify-title">🏛️ Panel Penerbitan PKKPR Berusaha - DPMPTSP</h3>
                    <form action="{{ route('berusaha.verify', $application->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-grid-2">
                            <div class="form-group-v">
                                <label for="satu_pintu_no_pkkpr">Nomor PKKPR Berusaha</label>
                                <input type="text" name="satu_pintu_no_pkkpr" id="satu_pintu_no_pkkpr" class="form-control-v" placeholder="cth: 503/Pertimbangan Teknis Pertanahan-B/2026/XYZ" required>
                            </div>
                            <div class="form-group-v">
                                <label for="satu_pintu_tanggal_terbit">Tanggal Terbit</label>
                                <input type="date" name="satu_pintu_tanggal_terbit" id="satu_pintu_tanggal_terbit" class="form-control-v" required>
                            </div>
                        </div>
                        <div class="form-group-v">
                            <label for="satu_pintu_document">Dokumentasi Produk Akhir PKKPR Berusaha</label>
                            <input type="file" name="satu_pintu_document" id="satu_pintu_document" class="form-control-v" accept=".pdf" required>
                            <span style="font-size: 11px; color: var(--clr-muted);">*Wajib mengunggah Dokumen/SK PKKPR Berusaha hasil akhir. Maksimal 100MB.</span>
                        </div>
                        <div class="form-group-v">
                            <label for="notes">Catatan Tambahan (Opsional)</label>
                            <textarea name="notes" id="notes" class="form-control-v" rows="2" placeholder="Masukkan keterangan tambahan jika ada..."></textarea>
                        </div>
                        
                                    <div class="form-group-v" style="margin-bottom: 12px; border-top: 1px dashed var(--clr-line); padding-top: 12px; margin-top: 12px;">
                                        <label style="font-size: 11.5px; color: var(--clr-muted); font-weight: 600;">✎ Edit Pesan WA (Opsional):</label>
                                        <textarea name="custom_wa_message" class="form-control-v" rows="2" placeholder="Tuliskan pesan khusus jika ingin mengganti template bawaan otomatis..."></textarea>
                                    </div>
                        <button type="submit" class="btn-submit-v">
                            <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 2L11 13M22 2l-7 20-4-9-9-4 20-7z"/></svg>
                            Kirim & Tuntaskan Permohonan
                        </button>
                    </form>
                </div>
            @endif
 
            <!-- 4. PELAKU USAHA ACTION: REUPLOAD JIKA BERKAS TIDAK SESUAI -->
            @if($user->isPelakuUsaha() && $application->status === 'menunggu_bpn' && $application->bpn_berkas_status === 'tidak_sesuai')
                <div class="verify-card" style="border-color: #F5C2C1; background: #FFF5F5;">
                    <h3 class="verify-title" style="color: #C5221F;">⚠️ Perbaikan Dokumen Persyaratan Diperlukan</h3>
                    <p style="font-size: 13px; color: #7F2321; margin-bottom: 16px;">
                        Petugas Kantor Pertanahan menyatakan berkas Anda tidak lengkap dengan catatan: <br>
                        <strong>"{{ $application->bpn_notes }}"</strong>
                    </p>
                    <form action="{{ route('berusaha.verify', $application->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="step" value="reupload">
                        <div class="form-group-v" style="margin-bottom: 8px;">
                            <label for="peta_lokasi">1. Peta/sketsa lokasi</label>
                            <input type="file" name="peta_lokasi" id="peta_lokasi" class="form-control-v" accept=".pdf,.jpg,.jpeg,.png">
                        </div>
                        <div class="form-group-v" style="margin-bottom: 8px;">
                            <label for="surat_kuasa">2. Surat kuasa</label>
                            <input type="file" name="surat_kuasa" id="surat_kuasa" class="form-control-v" accept=".pdf,.jpg,.jpeg,.png">
                        </div>
                        <div class="form-group-v" style="margin-bottom: 8px;">
                            <label for="fc_ktp">3. FC KTP</label>
                            <input type="file" name="fc_ktp" id="fc_ktp" class="form-control-v" accept=".pdf,.jpg,.jpeg,.png">
                        </div>
                        <div class="form-group-v" style="margin-bottom: 8px;">
                            <label for="fc_npwp">4. FC NPWP</label>
                            <input type="file" name="fc_npwp" id="fc_npwp" class="form-control-v" accept=".pdf,.jpg,.jpeg,.png">
                        </div>
                        <div class="form-group-v" style="margin-bottom: 8px;">
                            <label for="fc_akta_pendirian">5. FC Akta Pendirian & Pengesahan Badan Hukum</label>
                            <input type="file" name="fc_akta_pendirian" id="fc_akta_pendirian" class="form-control-v" accept=".pdf,.jpg,.jpeg,.png">
                        </div>
                        <div class="form-group-v" style="margin-bottom: 8px;">
                            <label for="rencana_penggunaan_tanah">6. Rencana Penggunaan Tanah</label>
                            <input type="file" name="rencana_penggunaan_tanah" id="rencana_penggunaan_tanah" class="form-control-v" accept=".pdf,.jpg,.jpeg,.png">
                        </div>
                        <div class="form-group-v" style="margin-bottom: 8px;">
                            <label for="nib">7. NIB</label>
                            <input type="file" name="nib" id="nib" class="form-control-v" accept=".pdf,.jpg,.jpeg,.png">
                        </div>
                        <div class="form-group-v" style="margin-bottom: 8px;">
                            <label for="kbli">8. KBLI</label>
                            <input type="file" name="kbli" id="kbli" class="form-control-v" accept=".pdf,.jpg,.jpeg,.png">
                        </div>
                        <div class="form-group-v" style="margin-bottom: 12px;">
                            <label for="proposal_kegiatan">9. Proposal Kegiatan</label>
                            <input type="file" name="proposal_kegiatan" id="proposal_kegiatan" class="form-control-v" accept=".pdf,.doc,.docx">
                        </div>
                        <div class="form-group-v" style="margin-bottom: 12px;">
                            <label for="persyaratan_lainnya">10. Persyaratan Lainnya (Opsional)</label>
                            <input type="file" name="persyaratan_lainnya" id="persyaratan_lainnya" class="form-control-v" accept=".pdf,.jpg,.jpeg,.png,.zip,.rar">
                        </div>
                        <button type="submit" class="btn-submit-v" style="background: #C5221F;">Kirim Berkas Perbaikan</button>
                    </form>
                </div>
            @endif
 

 
            <div class="layout-grid">
                
                <!-- Left: Application Details -->
                <div>
                    <div class="card">
                        <h2 class="card-title">Informasi Identitas Pemohon / Pengguna Layanan</h2>
                        
                        <ul class="detail-list">
                            <li class="detail-item">
                                <span class="detail-label">Nomor Registrasi</span>
                                <span class="detail-val app-num">{{ $application->application_number }}</span>
                            </li>
                            <li class="detail-item">
                                <span class="detail-label">Status Utama</span>
                                <span class="detail-val" style="display: flex; align-items: center; gap: 8px;">
                                    <span class="badge-status" style="background-color: {{ $application->status_color }};">
                                        {{ $application->status_label }}
                                    </span>
                                </span>
                            </li>
                            <li class="detail-item">
                                <span class="detail-label">Nama Pemilik Usaha</span>
                                <span class="detail-val">{{ $application->nama_pemilik_usaha }}</span>
                            </li>
                            @if(strtolower($application->hubungan_pengaju) !== 'diri sendiri')
                                <li class="detail-item">
                                    <span class="detail-label">Nama Pemohon / Pengguna Layanan</span>
                                    <span class="detail-val">{{ $application->nama_pengaju }}</span>
                                </li>
                            @endif
                            <li class="detail-item">
                                <span class="detail-label">Hubungan Pemohon / Pengguna Layanan</span>
                                <span class="detail-val">{{ $application->hubungan_pengaju }}</span>
                            </li>
                            <li class="detail-item">
                                <span class="detail-label">Tanggal Permohonan</span>
                                <span class="detail-val">{{ $application->created_at->format('d-m-Y, H:i') }} WIB</span>
                            </li>
                            
                            <!-- Kantor Pertanahan Info -->
                            <li class="detail-item">
                                <span class="detail-label">Kelayakan Berkas (Kantor Pertanahan)</span>
                                <span class="detail-val" style="text-transform: capitalize; font-weight: 700;">
                                    {{ str_replace('_', ' ', $application->bpn_berkas_status) }}
                                </span>
                            </li>
                            <li class="detail-item">
                                <span class="detail-label">Status Pembayaran</span>
                                <span class="detail-val" style="text-transform: capitalize; font-weight: 700; color: {{ $application->bpn_pembayaran_status === 'sudah_bayar' ? 'var(--clr-green)' : '#E53E3E' }}">
                                    {{ str_replace('_', ' ', $application->bpn_pembayaran_status) }}
                                </span>
                            </li>

                            @if($application->no_berkas)
                                <li class="detail-item">
                                    <span class="detail-label">Nomor Berkas</span>
                                    <span class="detail-val" style="font-weight: 700; color: var(--clr-blue-dk);">{{ $application->no_berkas }}</span>
                                </li>
                            @endif
 
                            @if($application->bpn_pertek_document)
                                <li class="detail-item" style="padding: 12px 0;">
                                    <span class="detail-label" style="font-weight: 800; color: #065F46;">Dokumen Pertek Pertanahan Berusaha (BPN)</span>
                                    <span class="detail-val">
                                        <a href="{{ route('file.view', ['path' => $application->bpn_pertek_document]) }}" target="_blank" style="display: inline-flex; align-items: center; gap: 8px; background: #16A34A; color: #ffffff; padding: 10px 18px; border-radius: 8px; text-decoration: none; font-size: 13px; font-weight: 800; box-shadow: 0 4px 12px rgba(5, 150, 105, 0.25); transition: all 0.2s;" >
                                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                            📄 Unduh Pertek Pertanahan Berusaha (BPN)
                                        </a>
                                    </span>
                                </li>
                            @endif
 
                            <!-- Dinas Pekerjaan Umum dan Tata Ruang (PUTR) Info -->
                            @if($application->status !== 'menunggu_bpn')
                                <li class="detail-item">
                                    <span class="detail-label">Penilaian Tata Ruang (PU)</span>
                                    <span class="detail-val" style="text-transform: capitalize; font-weight: 700;">
                                        {{ $application->dinas_pu_status === 'sesuai' ? 'Sudah Dinilai' : ($application->dinas_pu_status === 'belum_sesuai' ? 'Belum Dinilai' : str_replace('_', ' ', $application->dinas_pu_status)) }}
                                    </span>
                                </li>
                            @endif

                            @if($application->dinas_pu_tanggal_penilaian)
                                <li class="detail-item">
                                    <span class="detail-label">Tanggal Penilaian PU</span>
                                    <span class="detail-val" style="font-weight: 700;">{{ $application->dinas_pu_tanggal_penilaian->format('d-m-Y') }}</span>
                                </li>
                            @endif

                            @if($user->isBpn() && $application->dinas_pu_document)
                                <li class="detail-item">
                                    <span class="detail-label">Dokumen Penilaian PU</span>
                                    <span class="detail-val">
                                        <a href="{{ route('file.view', ['path' => $application->dinas_pu_document]) }}" target="_blank" class="btn-doc">
                                            Unduh Dokumen Penilaian PU
                                        </a>
                                    </span>
                                </li>
                            @endif
 
                            <!-- DPMPTSP Info -->
                            @if($application->satu_pintu_no_pkkpr)
                                <li class="detail-item">
                                    <span class="detail-label">Nomor PKKPR Berusaha</span>
                                    <span class="detail-val">{{ $application->satu_pintu_no_pkkpr }}</span>
                                </li>
                            @endif
 
                            <li class="detail-item" style="display: flex; flex-direction: column; gap: 8px;">
                                <span class="detail-label" style="border-bottom: 1px solid var(--clr-line); padding-bottom: 8px; margin-bottom: 4px;">Berkas Lampiran Persyaratan</span>
                                
                                @if($application->ptp_data)
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <span style="font-size: 13px; color: var(--clr-mid); font-weight: 500;">Formulir PTP</span>
                                    <div style="position: relative;">
                                        <button type="button" onclick="document.getElementById('ptpAdminDropdown').style.display = document.getElementById('ptpAdminDropdown').style.display === 'none' ? 'block' : 'none'" class="btn-doc" style="border: none; cursor: pointer;">
                                            Buka Berkas ▾
                                        </button>
                                        <div id="ptpAdminDropdown" style="display: none; position: absolute; top: 100%; right: 0; margin-top: 8px; background: white; border: 1px solid #E2E8F0; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); width: max-content; overflow: hidden; z-index: 10; text-align: left;">
                                            <a href="{{ route('berusaha.ptp_pdf', $application->id) }}" target="_blank" style="display: flex; align-items: center; gap: 8px; padding: 10px 16px; text-decoration: none; color: #2D3748; font-size: 13px; font-weight: 600; border-bottom: 1px solid #E2E8F0;" onmouseover="this.style.background='#F7FAFC'" onmouseout="this.style.background='white'">
                                                <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg> Preview PDF
                                            </a>
                                            <a href="{{ route('berusaha.ptp_pdf', $application->id) }}?action=download" style="display: flex; align-items: center; gap: 8px; padding: 10px 16px; text-decoration: none; color: #2D3748; font-size: 13px; font-weight: 600;" onmouseover="this.style.background='#F7FAFC'" onmouseout="this.style.background='white'">
                                                <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg> Download DOC
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                
                                @if($application->peta_lokasi)
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <span style="font-size: 13px; color: var(--clr-mid);">1. Peta Lokasi</span>
                                    <a href="{{ route('file.view', ['path' => $application->peta_lokasi]) }}" target="_blank" class="btn-doc">Buka Berkas</a>
                                </div>
                                @endif

                                @if($application->surat_kuasa)
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <span style="font-size: 13px; color: var(--clr-mid);">2. Surat Kuasa</span>
                                    <a href="{{ route('file.view', ['path' => $application->surat_kuasa]) }}" target="_blank" class="btn-doc">Buka Berkas</a>
                                </div>
                                @endif

                                @if($application->fc_ktp)
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <span style="font-size: 13px; color: var(--clr-mid);">3. FC KTP</span>
                                    <a href="{{ route('file.view', ['path' => $application->fc_ktp]) }}" target="_blank" class="btn-doc">Buka Berkas</a>
                                </div>
                                @endif

                                @if($application->fc_npwp)
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <span style="font-size: 13px; color: var(--clr-mid);">4. FC NPWP</span>
                                    <a href="{{ route('file.view', ['path' => $application->fc_npwp]) }}" target="_blank" class="btn-doc">Buka Berkas</a>
                                </div>
                                @endif

                                @if($application->fc_akta_pendirian)
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <span style="font-size: 13px; color: var(--clr-mid);">5. FC Akta Pendirian</span>
                                    <a href="{{ route('file.view', ['path' => $application->fc_akta_pendirian]) }}" target="_blank" class="btn-doc">Buka Berkas</a>
                                </div>
                                @endif

                                @if($application->rencana_penggunaan_tanah)
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <span style="font-size: 13px; color: var(--clr-mid);">6. Rencana Penggunaan Tanah</span>
                                    <a href="{{ route('file.view', ['path' => $application->rencana_penggunaan_tanah]) }}" target="_blank" class="btn-doc">Buka Berkas</a>
                                </div>
                                @endif

                                @if($application->nib)
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <span style="font-size: 13px; color: var(--clr-mid);">7. NIB</span>
                                    <a href="{{ route('file.view', ['path' => $application->nib]) }}" target="_blank" class="btn-doc">Buka Berkas</a>
                                </div>
                                @endif

                                @if($application->kbli)
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <span style="font-size: 13px; color: var(--clr-mid);">8. KBLI</span>
                                    <a href="{{ route('file.view', ['path' => $application->kbli]) }}" target="_blank" class="btn-doc">Buka Berkas</a>
                                </div>
                                @endif

                                @if($application->proposal_kegiatan)
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <span style="font-size: 13px; color: var(--clr-mid);">9. Proposal Kegiatan</span>
                                    <a href="{{ route('file.view', ['path' => $application->proposal_kegiatan]) }}" target="_blank" class="btn-doc">Buka Berkas</a>
                                </div>
                                @endif
                                @if($application->persyaratan_lainnya)
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <span style="font-size: 13px; color: var(--clr-mid);">10. Persyaratan Lainnya</span>
                                    <a href="{{ route('file.view', ['path' => $application->persyaratan_lainnya]) }}" target="_blank" class="btn-doc">Buka Berkas</a>
                                </div>
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
 
                <!-- Right: Timeline -->
                <div>
                                        <!-- DAY COUNTER / SLA BANNER -->
                    @php
                        $isPuPhase = in_array($application->status, ['menunggu_dinas_pu', 'menunggu_satu_pintu', 'menunggu_putr', 'disetujui', 'terbit_pkpr']) || $application->bpn_pertek_document;
                        $defaultDays = $isPuPhase ? 20 : 10;
                        
                        // SLA: badge SELALU muncul. Jika sudah bayar, hitung target date otomatis/manual.
                        $sudahBayar = $application->bpn_pembayaran_status === 'sudah_bayar';
                        if ($sudahBayar) {
                            $defaultStartDate = $application->bpn_pembayaran_approved_at 
                                ? \Carbon\Carbon::parse($application->bpn_pembayaran_approved_at) 
                                : $application->created_at->copy();
                                
                            $startDate = $application->tgl_mulai_layanan 
                                ? \Carbon\Carbon::parse($application->tgl_mulai_layanan) 
                                : $defaultStartDate;
                                
                            $targetDate = $application->tgl_selesai_layanan 
                                ? \Carbon\Carbon::parse($application->tgl_selesai_layanan) 
                                : $startDate->copy()->addWorkingDaysWithHolidays($defaultDays);
                        } else {
                            $targetDate = null;
                        }
                        
                        $isSelesai = false;
                        if (Auth::user()->isBpn()) {
                            // BPN: selesai hanya jika permohonan sudah di-approve/tolak secara final
                            // Status menunggu_dinas_pu / menunggu_satu_pintu masih berjalan, bukan selesai
                            $isSelesai = in_array($application->status, ['ditolak', 'disetujui']);
                        } elseif (Auth::user()->isDinasPu()) {
                            $isSelesai = ($application->dinas_pu_status === 'disetujui' || in_array($application->status, ['ditolak', 'menunggu_satu_pintu', 'disetujui']));
                        } else {
                            $isSelesai = in_array($application->status, ['ditolak', 'disetujui']);
                        }
                        
                        if ($isSelesai) {
                            $slaBg = '#16A34A';
                            $slaBorder = '#15803D';
                            $slaColor = '#FFFFFF';
                        } elseif (!$sudahBayar || !$targetDate) {
                            $slaBg = '#64748B';
                            $slaBorder = '#475569';
                            $slaColor = '#FFFFFF';
                        } else {
                            $now = \Carbon\Carbon::now();
                            $daysRemaining = (int)$now->diffInWorkingDaysWithHolidays($targetDate);
                            if ($now > $targetDate) {
                                $daysRemaining = -$daysRemaining;
                            }
                            
                            if ($isPuPhase) {
                                if ($daysRemaining >= 4) { $slaBg = '#16A34A'; $slaBorder = '#15803D'; $slaColor = '#FFFFFF'; }
                                elseif ($daysRemaining >= 1) { $slaBg = '#EAB308'; $slaBorder = '#CA8A04'; $slaColor = '#FFFFFF'; }
                                else { $slaBg = '#DC2626'; $slaBorder = '#B91C1C'; $slaColor = '#FFFFFF'; }
                            } else {
                                if ($daysRemaining >= 3) { $slaBg = '#16A34A'; $slaBorder = '#15803D'; $slaColor = '#FFFFFF'; }
                                elseif ($daysRemaining >= 1) { $slaBg = '#EAB308'; $slaBorder = '#CA8A04'; $slaColor = '#FFFFFF'; }
                                else { $slaBg = '#DC2626'; $slaBorder = '#B91C1C'; $slaColor = '#FFFFFF'; }
                            }
                        }
                    @endphp
                    
                    {{-- Badge SLA selalu muncul --}}
                    <div class="floating-sla" style="position: fixed; top: 120px; right: 32px; z-index: 9999; background: {{ $slaBg }}; border-radius: 4px; box-shadow: 0 10px 25px rgba(0,0,0,0.15); border: 1px solid {{ $slaBorder }}; width: 260px; overflow: hidden; display: flex; flex-direction: column;">
                        <div style="padding: 10px 14px; border-bottom: 1px solid rgba(255,255,255,0.2);">
                            <div style="font-size: 10px; font-weight: 800; color: {{ $slaColor }}; opacity: 0.95; margin-bottom: 2px; text-transform: uppercase; letter-spacing: 0.05em;">Batas Waktu (SLA)</div>
                            @if($targetDate)
                                <div style="font-size: 12.5px; color: {{ $slaColor }};">Target: <strong style="font-weight: 800;">{{ $targetDate->format('d M Y') }}</strong></div>
                            @elseif($sudahBayar)
                                <div style="font-size: 12.5px; color: {{ $slaColor }};">Target: <strong style="font-weight: 800;">Belum Diatur</strong></div>
                            @else
                                <div style="font-size: 12.5px; color: {{ $slaColor }};">Target: <strong style="font-weight: 800;">Menunggu Pembayaran</strong></div>
                            @endif
                        </div>
                        <div style="padding: 12px 14px; background: rgba(0,0,0,0.06);">
                            @if($isSelesai)
                                <div style="display: flex; align-items: center; gap: 8px; color: {{ $slaColor }}; font-weight: 700; font-size: 13px;">
                                    <div style="width: 24px; height: 24px; border-radius: 50%; background: rgba(255,255,255,0.25); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                    <span>Tepat Waktu (Selesai)</span>
                                </div>
                            @elseif(!$sudahBayar)
                                <div style="display: flex; align-items: center; gap: 8px; color: {{ $slaColor }}; font-weight: 700; font-size: 13px;">
                                    <div style="width: 24px; height: 24px; border-radius: 50%; background: rgba(255,255,255,0.2); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                    </div>
                                    <span>Menunggu Pembayaran</span>
                                </div>
                            @elseif(!$targetDate)
                                <div style="display: flex; align-items: center; gap: 8px; color: {{ $slaColor }}; font-weight: 700; font-size: 13px;">
                                    <div style="width: 24px; height: 24px; border-radius: 50%; background: rgba(255,255,255,0.2); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    </div>
                                    <span>Menunggu Admin Set SLA</span>
                                </div>
                            @else
                                <div style="font-size: 10px; color: {{ $slaColor }}; opacity: 0.95; margin-bottom: 8px; font-weight: 700;">WAKTU TERSISA:</div>
                                <div id="liveCountdownSla" data-target="{{ $targetDate->toIso8601String() }}" data-color="{{ $slaColor }}" style="display: flex; gap: 6px; align-items: center; justify-content: space-between;">
                                    <!-- Countdown script will inject here -->
                                </div>
                            @endif
                        </div>
                    </div>

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const targetEl = document.getElementById('liveCountdownSla');
                            if(!targetEl) return;
                            
                            const targetDateStr = targetEl.getAttribute('data-target');
                            const targetDateObj = new Date(targetDateStr);
                            const textColor = targetEl.getAttribute('data-color');
                            
                            function updateCountdown() {
                                const now = new Date();
                                const distance = targetDateObj.getTime() - now.getTime();
                                
                                if (distance < 0) {
                                    targetEl.innerHTML = '<div style="color: ' + textColor + '; font-weight: 800; font-size: 13px; display: flex; align-items: center; gap: 8px;"><svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg> Waktu Habis!</div>';
                                    return;
                                }
                                
                                const holidays = window.appHolidays || [];
                                let workingDays = 0;
                                let tempDate = new Date(now.getFullYear(), now.getMonth(), now.getDate());
                                let targetDay = new Date(targetDateObj.getFullYear(), targetDateObj.getMonth(), targetDateObj.getDate());
                                
                                while (tempDate <= targetDay) {
                                    const y = tempDate.getFullYear();
                                    const m = String(tempDate.getMonth() + 1).padStart(2, '0');
                                    const d = String(tempDate.getDate()).padStart(2, '0');
                                    const dateStr = `${y}-${m}-${d}`;
                                    if (tempDate.getDay() !== 0 && tempDate.getDay() !== 6 && !holidays.includes(dateStr)) {
                                        workingDays++;
                                    }
                                    tempDate.setDate(tempDate.getDate() + 1);
                                }
                                
                                const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                const seconds = Math.floor((distance % (1000 * 60)) / 1000);
                                
                                const blockStyle = 'background: rgba(255,255,255,0.2); padding: 6px 2px; border-radius: 4px; text-align: center; flex: 1; border: 1px solid rgba(255,255,255,0.1);';
                                const numStyle = 'font-size: 14.5px; font-weight: 800; color: ' + textColor + '; font-family: monospace; line-height: 1; margin-bottom: 2px;';
                                const labelStyle = 'font-size: 8.5px; font-weight: 700; color: ' + textColor + '; opacity: 0.9; text-transform: uppercase; letter-spacing: 0.05em;';
                                
                                targetEl.innerHTML = `
                                    <div style="${blockStyle}"><div style="${numStyle}">${workingDays}</div><div style="${labelStyle}">HARI</div></div>
                                    <div style="font-weight: 800; color: ${textColor}; opacity: 0.5; padding-bottom: 12px;">:</div>
                                    <div style="${blockStyle}"><div style="${numStyle}">${hours.toString().padStart(2, '0')}</div><div style="${labelStyle}">JAM</div></div>
                                    <div style="font-weight: 800; color: ${textColor}; opacity: 0.5; padding-bottom: 12px;">:</div>
                                    <div style="${blockStyle}"><div style="${numStyle}">${minutes.toString().padStart(2, '0')}</div><div style="${labelStyle}">MNT</div></div>
                                    <div style="font-weight: 800; color: ${textColor}; opacity: 0.5; padding-bottom: 12px;">:</div>
                                    <div style="${blockStyle}"><div style="${numStyle}">${seconds.toString().padStart(2, '0')}</div><div style="${labelStyle}">DTK</div></div>
                                `;
                            }
                            
                            updateCountdown();
                            setInterval(updateCountdown, 1000);
                        });
                    </script>

                    <div class="card" style="position: sticky; top: 88px; max-height: calc(100vh - 100px); overflow-y: auto;">

                        <!-- ── SERVICE IDENTIFIER HEADER ── -->
                        <div class="timeline-card-header">
                            <img
                                src="{{ asset('storage/logo/PKKPR.png') }}"
                                alt="Logo Pertimbangan Teknis Pertanahan PKKPR Berusaha"
                                class="timeline-service-logo"
                                onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                            >
                            <!-- Fallback jika logo tidak ditemukan -->
                            <div style="display:none; width:56px; height:56px; border-radius:10px; background:var(--clr-blue); align-items:center; justify-content:center; flex-shrink:0;">
                                <svg width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="white" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            </div>
                            <div class="timeline-service-meta">
                                <div class="timeline-service-label">Pelacakan Permohonan</div>
                                <div class="timeline-service-title">Pertimbangan Teknis Pertanahan PKKPR Berusaha</div>
                                <div class="timeline-step-count">8 Tahapan · 3 Instansi</div>

                                <!-- Downstream Helper Logic untuk Linimasa -->
                            @php
                                // 'menunggu_dinas_pu' dapat terjadi di DUA titik berbeda:
                                // 1. Step 2: Validasi Permohonan Awal (setelah BPN setujui berkas, SEBELUM Pertek terbit)
                                // 2. Step 7: Penilaian PKKPR Berusaha (SETELAH Pertek terbit)
                                // Kita hanya anggap "sudah melewati BPN stages" jika Pertek sudah ada.
                                $dinasPuDariPertek = in_array($application->status, ['menunggu_dinas_pu', 'menunggu_putr'])
                                    && !empty($application->bpn_pertek_document);

                                $hasPassedSps = ($application->bpn_pembayaran_status === 'sudah_bayar')
                                    || !empty($application->bpn_cek_lokasi_dt)
                                    || !empty($application->bpn_rapat_dt)
                                    || !empty($application->bpn_pertek_document)
                                    || $dinasPuDariPertek
                                    || in_array($application->status, ['menunggu_satu_pintu', 'disetujui', 'terbit_pkpr']);

                                $hasPassedCekLokasi = $cekLokasiLewat
                                    || !empty($application->bpn_rapat_dt)
                                    || !empty($application->bpn_pertek_document)
                                    || $dinasPuDariPertek
                                    || in_array($application->status, ['menunggu_satu_pintu', 'disetujui', 'terbit_pkpr']);

                                $hasPassedRapat = $rapatLewat
                                    || !empty($application->bpn_pertek_document)
                                    || $dinasPuDariPertek
                                    || in_array($application->status, ['menunggu_satu_pintu', 'disetujui', 'terbit_pkpr']);

                                $hasPassedPertek = !empty($application->bpn_pertek_document)
                                    || $dinasPuDariPertek
                                    || in_array($application->status, ['menunggu_satu_pintu', 'disetujui', 'terbit_pkpr']);
                            @endphp
                            </div>
                        </div>

                        <div class="timeline">

                            <!-- STEP 0: Diajukan -->
                            <div class="timeline-step completed">
                                <span class="timeline-dot"></span>
                                <div class="timeline-content">
                                    <div class="timeline-title">Berkas Berhasil Diajukan</div>
                                    <div class="timeline-desc">Berkas persyaratan dan formulir permohonan berhasil diunggah ke portal.</div>
                                    <div style="font-size:11px;color:#558B2F;margin-top:5px;font-weight:600;">📅 {{ $application->created_at->locale('id')->translatedFormat('l, d M Y · H:i') }} WIB</div>
                                </div>
                            </div>

                            <!-- STEP 1: Verifikasi Berkas Awal Kantor Pertanahan -->
                            @php
                                $step2Status = '';
                                if ($application->bpn_berkas_status === 'tidak_sesuai' || $application->bpn_berkas_status === 'ditolak') {
                                    $step2Status = 'rejected';
                                } elseif ($application->bpn_berkas_status === 'diterima' || $hasPassedSps) {
                                    $step2Status = 'completed';
                                } else {
                                    $step2Status = 'active';
                                }
                            @endphp
                            <div class="timeline-step {{ $step2Status }}" onclick="showBpnPanel(1)" style="cursor:pointer;">
                                <span class="timeline-dot"></span>
                                <div class="timeline-content">
                                    <div class="timeline-title">
                                        1. Verifikasi Berkas Awal
                                        <span style="font-size: 10px; font-weight: 600; color: var(--clr-muted); background: rgba(0,0,0,0.05); padding: 1px 6px; border-radius: 10px;">Kantor Pertanahan</span>
                                    </div>
                                    <div class="timeline-desc">Validasi kelengkapan berkas dokumen persyaratan pemohon.</div>
                                    @if(($application->bpn_berkas_status === 'diterima' || $hasPassedSps) && $application->bpn_berkas_approved_at)
                                        <div style="font-size:11px;color:#558B2F;margin-top:6px;font-weight:600;"><svg style="width:14px;height:14px;vertical-align:-2px;margin-right:4px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg> Disetujui pada: {{ \Carbon\Carbon::parse($application->bpn_berkas_approved_at)->format('d M Y, H:i') }} WIB</div>
                                    @endif
                                    @if($application->bpn_berkas_status === 'tidak_sesuai')
                                        <div class="timeline-notes">
                                            <strong>Catatan Koreksi:</strong> {{ $application->bpn_notes }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- STEP 2: Validasi Permohonan Awal - Dinas Pekerjaan Umum dan Tata Ruang (PUTR) -->
                            @php
                                $step3Status = '';
                                if ($application->dinas_pu_status === 'validasi_awal_ditolak') {
                                    $step3Status = 'rejected';
                                } elseif (in_array($application->dinas_pu_status, ['validasi_awal_diterima', 'sesuai', 'belum_sesuai', 'menunggu_penilaian'])
                                    || in_array($application->status, ['menunggu_satu_pintu', 'disetujui', 'terbit_pkpr'])
                                    || ($application->bpn_pembayaran_status === 'sudah_bayar')
                                    || !empty($application->bpn_cek_lokasi_dt)
                                    || !empty($application->bpn_rapat_dt)
                                    || !empty($application->bpn_pertek_document)) {
                                    $step3Status = 'completed';
                                } elseif ($application->bpn_berkas_status === 'diterima' || in_array($application->status, ['menunggu_dinas_pu', 'menunggu_putr'])) {
                                    $step3Status = 'active';
                                }
                            @endphp
                            <div class="timeline-step {{ $step3Status }}" onclick="showBpnPanel('pu-1')" style="cursor:pointer;">
                                <span class="timeline-dot"></span>
                                <div class="timeline-content">
                                    <div class="timeline-title">
                                        2. Validasi Permohonan
                                        <span style="font-size: 10px; font-weight: 600; color: var(--clr-muted); background: rgba(0,0,0,0.05); padding: 1px 6px; border-radius: 10px;">Dinas Pekerjaan Umum dan Tata Ruang (PUTR)</span>
                                    </div>
                                    <div class="timeline-desc">Pemeriksaan awal kelayakan tata ruang. Notifikasi dikirim ke Kantor Pertanahan dan Pelaku Usaha.</div>
                                    @if((in_array($application->dinas_pu_status, ['validasi_awal_diterima', 'sesuai', 'belum_sesuai']) || $hasPassedSps) && $application->dinas_pu_approved_at)
                                        <div style="font-size:11px;color:#558B2F;margin-top:6px;font-weight:600;"><svg style="width:14px;height:14px;vertical-align:-2px;margin-right:4px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg> Disetujui pada: {{ \Carbon\Carbon::parse($application->dinas_pu_approved_at)->format('d M Y, H:i') }} WIB</div>
                                    @endif
                                    @if($application->dinas_pu_status === 'validasi_awal_ditolak')
                                        <div class="timeline-notes">
                                            <strong>Ditolak pada tahap validasi awal oleh Dinas Pekerjaan Umum dan Tata Ruang (PUTR).</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- STEP 3: Pembayaran PNBP -->
                            @php
                                $step4Status = '';
                                if ($application->bpn_pembayaran_status === 'sudah_bayar' || $hasPassedCekLokasi) {
                                    $step4Status = 'completed';
                                } elseif (in_array($application->dinas_pu_status, ['validasi_awal_diterima', 'sesuai', 'belum_sesuai', 'menunggu_penilaian'])) {
                                    $step4Status = 'active';
                                }
                            @endphp
                            <div class="timeline-step {{ $step4Status }}" onclick="showBpnPanel(2)" style="cursor:pointer;">
                                <span class="timeline-dot"></span>
                                <div class="timeline-content">
                                    <div class="timeline-title">
                                        3. Pembayaran PNBP & Registrasi
                                        <span style="font-size: 10px; font-weight: 600; color: var(--clr-muted); background: rgba(0,0,0,0.05); padding: 1px 6px; border-radius: 10px;">Kantor Pertanahan</span>
                                    </div>
                                    <div class="timeline-desc">
                                        @if($application->bpn_pembayaran_status === 'sudah_bayar' || $hasPassedCekLokasi)
                                            Pembayaran dikonfirmasi lunas. Kredensial dashboard dikirim ke WhatsApp pemohon.
                                            @if($application->no_berkas)
                                                <br>No. Berkas: <strong>{{ $application->no_berkas }}</strong>
                                            @endif
                                        @else
                                            Menunggu konfirmasi pembayaran PNBP dan input nomor berkas oleh Kantor Pertanahan.
                                        @endif
                                    </div>
                                    @if(($application->bpn_pembayaran_status === 'sudah_bayar' || $hasPassedCekLokasi) && $application->bpn_pembayaran_approved_at)
                                        <div style="font-size:11px;color:#558B2F;margin-top:5px;font-weight:600;">📅 {{ \Carbon\Carbon::parse($application->bpn_pembayaran_approved_at)->locale('id')->translatedFormat('l, d M Y · H:i') }} WIB</div>
                                    @endif
                                </div>
                            </div>

                            <!-- STEP 4: Peninjauan Lapangan -->
                            @php
                                $step5Status = '';
                                if ($hasPassedRapat || $cekLokasiLewat) {
                                    $step5Status = 'completed';
                                } elseif ($application->bpn_pembayaran_status === 'sudah_bayar' || $hasPassedCekLokasi || !empty($application->bpn_cek_lokasi_dt)) {
                                    $step5Status = 'active';
                                }
                            @endphp
                            <div class="timeline-step {{ $step5Status }}" onclick="showBpnPanel(3)" style="cursor:pointer;">
                                <span class="timeline-dot"></span>
                                <div class="timeline-content">
                                    <div class="timeline-title">
                                        4. Peninjauan Lapangan
                                        <span style="font-size: 10px; font-weight: 600; color: var(--clr-muted); background: rgba(0,0,0,0.05); padding: 1px 6px; border-radius: 10px;">Kantor Pertanahan</span>
                                    </div>
                                    <div class="timeline-desc">
                                        @if($application->bpn_cek_lokasi_dt)
                                            Petugas Lapang: <strong>{{ $application->bpn_cek_lokasi_cp }}</strong>
                                        @else
                                            Menunggu jadwal peninjauan lapangan dari Kantor Pertanahan.
                                        @endif
                                    </div>
                                    @if($application->bpn_cek_lokasi_dt)
                                        <div style="font-size:11px;color:#558B2F;margin-top:5px;font-weight:600;">📅 Dijadwalkan: {{ \Carbon\Carbon::parse($application->bpn_cek_lokasi_dt)->locale('id')->translatedFormat('l, d M Y · H:i') }} WIB</div>
                                    @endif
                                </div>
                            </div>

                            <!-- STEP 5: Rapat Pembahasan Pertek -->
                            @php
                                $step6Status = '';
                                if ($hasPassedPertek || $rapatLewat) {
                                    $step6Status = 'completed';
                                } elseif (($hasPassedCekLokasi || $cekLokasiLewat || !empty($application->bpn_cek_lokasi_dt)) && !$hasPassedPertek) {
                                    $step6Status = 'active';
                                }
                            @endphp
                            <div class="timeline-step {{ $step6Status }}" onclick="showBpnPanel(4)" style="cursor:pointer;">
                                <span class="timeline-dot"></span>
                                <div class="timeline-content">
                                    <div class="timeline-title">
                                        5. Rapat Pembahasan Pertek
                                        <span style="font-size: 10px; font-weight: 600; color: var(--clr-muted); background: rgba(0,0,0,0.05); padding: 1px 6px; border-radius: 10px;">Kantor Pertanahan</span>
                                    </div>
                                    <div class="timeline-desc">
                                        @if($application->bpn_rapat_dt)
                                            Sidang koordinasi teknis pertanahan.
                                        @else
                                            Menunggu jadwal sidang/rapat koordinasi teknis pertanahan.
                                        @endif
                                    </div>
                                    @if($application->bpn_rapat_dt)
                                        <div style="font-size:11px;color:#558B2F;margin-top:5px;font-weight:600;">📅 Dijadwalkan: {{ \Carbon\Carbon::parse($application->bpn_rapat_dt)->locale('id')->translatedFormat('l, d M Y · H:i') }} WIB</div>
                                    @endif
                                </div>
                            </div>

                            <!-- STEP 6: Penerbitan Pertek Pertanahan -->
                            @php
                                $step7Status = '';
                                if (isset($application->bpn_pertek_status) && $application->bpn_pertek_status === 'ditolak') {
                                    $step7Status = 'rejected';
                                } elseif ($hasPassedPertek || !empty($application->bpn_pertek_document)) {
                                    $step7Status = 'completed';
                                } elseif (($hasPassedRapat || $rapatLewat || !empty($application->bpn_rapat_dt)) && empty($application->bpn_pertek_document)) {
                                    $step7Status = 'active';
                                }
                            @endphp
                            <div class="timeline-step {{ $step7Status }}" onclick="showBpnPanel(5)" style="cursor:pointer;">
                                <span class="timeline-dot"></span>
                                <div class="timeline-content">
                                    <div class="timeline-title">
                                        6. Penerbitan Pertek Pertanahan
                                        <span style="font-size: 10px; font-weight: 600; color: var(--clr-muted); background: rgba(0,0,0,0.05); padding: 1px 6px; border-radius: 10px;">Kantor Pertanahan</span>
                                    </div>
                                    <div class="timeline-desc">
                                        @if($application->bpn_pertek_document)
                                            Pertek Pertanahan Sudah Diterbitkan Dan Diteruskan Ke Dinas Pekerjaan Umum dan Tata Ruang (PUTR) Untuk Penilian PKKPR
                                        @else
                                            Menunggu penerbitan surat rekomendasi teknis pertanahan.
                                        @endif
                                    </div>
                                    @if($application->bpn_pertek_uploaded_at)
                                        <div style="font-size:11px;color:#558B2F;margin-top:5px;font-weight:600;">📅 {{ \Carbon\Carbon::parse($application->bpn_pertek_uploaded_at)->locale('id')->translatedFormat('l, d M Y · H:i') }} WIB</div>
                                    @endif
                                </div>
                            </div>

                            <!-- STEP 7: Penilaian Pertimbangan Teknis Pertanahan Dinas Pekerjaan Umum dan Tata Ruang (PUTR) -->
                            @php
                                $step8Status = '';
                                if ($application->dinas_pu_status === 'belum_sesuai') {
                                    $step8Status = 'rejected';
                                } elseif ($application->dinas_pu_status === 'sesuai' || in_array($application->status, ['menunggu_satu_pintu', 'disetujui', 'terbit_pkpr'])) {
                                    $step8Status = 'completed';
                                } elseif ($hasPassedPertek || $application->dinas_pu_status === 'menunggu_penilaian' || (!empty($application->bpn_pertek_document) && in_array($application->status, ['menunggu_dinas_pu', 'menunggu_putr']))) {
                                    $step8Status = 'active';
                                }
                            @endphp
                            <div class="timeline-step {{ $step8Status }}" onclick="showBpnPanel('pu-2')" style="cursor:pointer;">
                                <span class="timeline-dot"></span>
                                <div class="timeline-content">
                                    <div class="timeline-title">
                                        7. Penilaian PKKPR Berusaha 
                                        <span style="font-size: 10px; font-weight: 600; color: var(--clr-muted); background: rgba(0,0,0,0.05); padding: 1px 6px; border-radius: 10px;">Dinas Pekerjaan Umum dan Tata Ruang (PUTR)</span>
                                    </div>
                                    <div class="timeline-desc">Penilaian PKKPR oleh Dinas Pekerjaan Umum dan Tata Ruang (PUTR)</div>
                                    @if(in_array($application->dinas_pu_status, ['sesuai', 'belum_sesuai']))
                                        @if($application->dinas_pu_tanggal_penilaian)
                                            <div class="timeline-notes" style="border-left-color: {{ $application->dinas_pu_status === 'sesuai' ? 'var(--clr-green)' : '#E53E3E' }}; background: {{ $application->dinas_pu_status === 'sesuai' ? '#F4FBF7' : '#FFF5F5' }}; color: {{ $application->dinas_pu_status === 'sesuai' ? '#137333' : '#C53030' }}">
                                                <strong>Tanggal Penilaian:</strong> {{ $application->dinas_pu_tanggal_penilaian->format('d-m-Y') }}
                                                @if($application->dinas_pu_notes)
                                                    <br><strong>Catatan:</strong> {{ $application->dinas_pu_notes }}
                                                @endif
                                            </div>
                                        @elseif($application->dinas_pu_notes)
                                            <div class="timeline-notes" style="border-left-color: {{ $application->dinas_pu_status === 'sesuai' ? 'var(--clr-green)' : '#E53E3E' }}; background: {{ $application->dinas_pu_status === 'sesuai' ? '#F4FBF7' : '#FFF5F5' }}; color: {{ $application->dinas_pu_status === 'sesuai' ? '#137333' : '#C53030' }}">
                                                <strong>Catatan Dinas Pekerjaan Umum dan Tata Ruang (PUTR):</strong> {{ $application->dinas_pu_notes }}
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            </div>

                            <!-- STEP 8: Penerbitan Pertimbangan Teknis Pertanahan DPMPTSP -->
                            @php
                                $step9Status = '';
                                if ($application->status === 'ditolak') {
                                    $step9Status = 'rejected';
                                } elseif (in_array($application->status, ['disetujui', 'terbit_pkpr']) || !empty($application->satu_pintu_document)) {
                                    $step9Status = 'completed';
                                } elseif ($application->status === 'menunggu_satu_pintu' || $application->dinas_pu_status === 'sesuai') {
                                    $step9Status = 'active';
                                }
                            @endphp
                            <div class="timeline-step {{ $step9Status }}" onclick="showBpnPanel('satu-pintu')" style="cursor:pointer;">
                                <span class="timeline-dot"></span>
                                <div class="timeline-content">
                                    <div class="timeline-title">
                                        8. Penerbitan PKKPR
                                        <span style="font-size: 10px; font-weight: 600; color: var(--clr-muted); background: rgba(0,0,0,0.05); padding: 1px 6px; border-radius: 10px;">DPMPTSP</span>
                                    </div>
                                    <div class="timeline-desc">DPMPTSP menerbitkan dokumen PKKPR Berusaha</div>
                                    @if($application->satu_pintu_no_pkkpr)
                                        <div class="timeline-notes" style="border-left-color: var(--clr-green); background: #F4FBF7; color: #137333;">
                                            <strong>No. PKKPR Berusaha:</strong> {{ $application->satu_pintu_no_pkkpr }}
                                        </div>
                                    @endif
                                    @if($application->satu_pintu_tanggal_terbit)
                                        <div style="font-size:11px;color:#558B2F;margin-top:5px;font-weight:600;">📅 Terbit: {{ \Carbon\Carbon::parse($application->satu_pintu_tanggal_terbit)->locale('id')->translatedFormat('l, d M Y') }}</div>
                                    @endif
                                </div>
                            </div>

                            <!-- STEP FINAL: Selesai / Ditolak -->
                            @php
                                $doneStepStatus = '';
                                if ($application->status === 'disetujui') {
                                    $doneStepStatus = 'completed';
                                } elseif ($application->status === 'ditolak') {
                                    $doneStepStatus = 'rejected';
                                }
                            @endphp
                            <div class="timeline-step {{ $doneStepStatus }}">
                                <span class="timeline-dot"></span>
                                <div class="timeline-content">
                                    <div class="timeline-title">
                                        @if($application->status === 'ditolak')
                                            Layanan Ditolak
                                        @else
                                            Layanan Selesai
                                        @endif
                                    </div>
                                    <div class="timeline-desc">
                                        @if($application->status === 'ditolak')
                                            Layanan dihentikan oleh instansi terkait (Kantor Pertanahan, Dinas Pekerjaan Umum dan Tata Ruang (PUTR), atau Dinas Pekerjaan Umum dan Tata Ruang (PUTR)).
                                        @elseif($application->status === 'disetujui')
                                            Seluruh alur selesai. Dokumen PKKPR Berusaha siap diunduh dari portal.
                                        @else
                                            Menunggu seluruh tahapan disetujui oleh semua instansi terkait.
                                        @endif
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
 
            </div>
</div>
@endsection

@section('scripts')
    @php
        $holidays = [];
        try {
            $holidays = \App\Models\Holiday::get()->map(function($h) {
                return \Carbon\Carbon::parse($h->date)->format('Y-m-d');
            })->toArray();
        } catch(\Exception $e) {}
    @endphp
    <script>
        window.appHolidays = {!! json_encode($holidays) !!};
        
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('input[type="datetime-local"], input[type="date"]').forEach(el => {
                if(!el.getAttribute('placeholder')) el.setAttribute('placeholder', 'Pilih Tanggal & Waktu...');
            });

            const commonDisable = [
                function(date) {
                    const y = date.getFullYear();
                    const m = String(date.getMonth() + 1).padStart(2, '0');
                    const d = String(date.getDate()).padStart(2, '0');
                    const formattedDate = `${y}-${m}-${d}`;
                    return (date.getDay() === 0 || date.getDay() === 6 || window.appHolidays.includes(formattedDate));
                }
            ];

            const penilaianInput = document.getElementById('dinas_pu_tanggal_penilaian');
            if (penilaianInput) {
                flatpickr(penilaianInput, {
                    dateFormat: "Y-m-d",
                    altInput: true,
                    altFormat: "d-m-Y",
                    locale: "id",
                    allowInput: true,
                    disable: commonDisable
                });
            }

            const tanggalTerbitInput = document.getElementById('satu_pintu_tanggal_terbit');
            if (tanggalTerbitInput) {
                flatpickr(tanggalTerbitInput, {
                    dateFormat: "Y-m-d",
                    altInput: true,
                    altFormat: "d-m-Y",
                    locale: "id",
                    allowInput: true,
                    disable: commonDisable
                });
            }

            const cekLokasiInput = document.getElementById('bpn_cek_lokasi_dt');
            if (cekLokasiInput) {
                flatpickr(cekLokasiInput, {
                    enableTime: true,
                    time_24hr: true,
                    dateFormat: "Y-m-d H:i",
                    altInput: true,
                    altFormat: "d-m-Y H:i",
                    locale: "id",
                    allowInput: true,
                    disable: commonDisable
                });
            }

            const rapatInput = document.getElementById('bpn_rapat_dt');
            if (rapatInput) {
                flatpickr(rapatInput, {
                    enableTime: true,
                    time_24hr: true,
                    dateFormat: "Y-m-d H:i",
                    altInput: true,
                    altFormat: "d-m-Y H:i",
                    locale: "id",
                    allowInput: true,
                    disable: commonDisable
                });
            }
            
            function addWorkingDays(startDate, days, holidays) {
                let date = new Date(startDate);
                let added = 0;
                while (added < days) {
                    date.setDate(date.getDate() + 1);
                    const y = date.getFullYear();
                    const m = String(date.getMonth() + 1).padStart(2, '0');
                    const d = String(date.getDate()).padStart(2, '0');
                    const dateStr = `${y}-${m}-${d}`;
                    if (date.getDay() !== 0 && date.getDay() !== 6 && !holidays.includes(dateStr)) {
                        added++;
                    }
                }
                return date;
            }

            function updateSlaDurationUI() {
                const startEl = document.getElementById('tgl_mulai_layanan');
                const endEl = document.getElementById('tgl_selesai_layanan');
                const txtWorking = document.getElementById('txtWorkingDays');
                const txtCalendar = document.getElementById('txtCalendarDays');
                
                if (!startEl || !endEl || !txtWorking || !txtCalendar || !startEl.value || !endEl.value) return;
                
                let start = new Date(startEl.value);
                let end = new Date(endEl.value);
                if (isNaN(start.getTime()) || isNaN(end.getTime()) || start > end) {
                    txtWorking.innerText = '0';
                    txtCalendar.innerText = '0';
                    return;
                }
                
                const diffTime = Math.abs(end - start);
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                txtCalendar.innerText = diffDays;
                
                let holidays = window.appHolidays || [];
                let workingCount = 0;
                let curr = new Date(start);
                curr.setHours(0,0,0,0);
                let endLimit = new Date(end);
                endLimit.setHours(0,0,0,0);
                
                while (curr < endLimit) {
                    curr.setDate(curr.getDate() + 1);
                    const y = curr.getFullYear();
                    const m = String(curr.getMonth() + 1).padStart(2, '0');
                    const d = String(curr.getDate()).padStart(2, '0');
                    const dateStr = `${y}-${m}-${d}`;
                    if (curr.getDay() !== 0 && curr.getDay() !== 6 && !holidays.includes(dateStr)) {
                        workingCount++;
                    }
                }
                txtWorking.innerText = workingCount;
            }

            const slaEnd = document.getElementById('tgl_selesai_layanan');
            let selesaiPicker = null;
            if(slaEnd) {
                selesaiPicker = flatpickr(slaEnd, {
                    enableTime: true, time_24hr: true, dateFormat: "Y-m-d\\TH:i", altInput: true, altFormat: "j F Y - H:i", locale: "id", allowInput: true, disable: commonDisable,
                    defaultDate: slaEnd.value || null,
                    onChange: function() {
                        updateSlaDurationUI();
                    }
                });
            }

            const slaStart = document.getElementById('tgl_mulai_layanan');
            if(slaStart) {
                flatpickr(slaStart, {
                    enableTime: true, time_24hr: true, dateFormat: "Y-m-d\\TH:i", altInput: true, altFormat: "j F Y - H:i", locale: "id", allowInput: true, disable: commonDisable,
                    defaultDate: slaStart.value || null,
                    onChange: function(selectedDates, dateStr, instance) {
                        if (selectedDates.length > 0 && selesaiPicker) {
                            const target = addWorkingDays(selectedDates[0], {{ $isPuPhase ? 20 : 10 }}, window.appHolidays || []);
                            selesaiPicker.setDate(target, true);
                        }
                        updateSlaDurationUI();
                    }
                });
            }
        });
    </script>

    <script>
document.addEventListener("DOMContentLoaded", function() {
    const revisiContainer = document.getElementById("revisi-berkas-container");
    const actionInputs = revisiContainer ? revisiContainer.closest('form').querySelectorAll("select[name='action'], input[type='radio'][name='action']") : document.querySelectorAll("select[name='action'], input[type='radio'][name='action']");
    const notesField = revisiContainer ? revisiContainer.closest('form').querySelector("textarea[name='notes']") : document.getElementById("notes");
    const checkboxes = document.querySelectorAll(".cb-revisi");

    function updateRevisiVisibility() {
        let isReject = false;
        actionInputs.forEach(input => {
            if (input.tagName === "SELECT" && input.value === "reject") isReject = true;
            if (input.tagName === "INPUT" && input.checked && input.value === "reject") isReject = true;
        });
        if (revisiContainer) {
            revisiContainer.style.display = isReject ? "block" : "none";
            if(!isReject) {
                checkboxes.forEach(cb => cb.checked = false);
                if (notesField) {
                    notesField.value = notesField.value.replace(/Berkas yang harus diperbaiki:\n(- .*\n?)+\n\n/g, "").replace(/Berkas yang harus diperbaiki:\n(- .*\n?)+/g, "").trim();
                }
            }
        }
    }

    actionInputs.forEach(input => {
        input.addEventListener("change", updateRevisiVisibility);
    });
    
    // Initial check
    updateRevisiVisibility();

    checkboxes.forEach(cb => {
        cb.addEventListener("change", function() {
            if (!notesField) return;
            let selected = Array.from(checkboxes).filter(i => i.checked).map(i => "- " + i.value);
            let currentNote = notesField.value.replace(/Berkas yang harus diperbaiki:\n(- .*\n?)+\n\n/g, "").replace(/Berkas yang harus diperbaiki:\n(- .*\n?)+/g, "").trim();
            
            if (selected.length > 0) {
                notesField.value = "Berkas yang harus diperbaiki:\n" + selected.join("\n") + "\n\n" + currentNote;
            } else {
                notesField.value = currentNote;
            }
        });
    });
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const textareas = document.querySelectorAll('textarea[name="custom_wa_message"]');
    textareas.forEach(ta => {
        const wrapper = ta.closest('.form-group-v') || ta.parentElement;
        if (wrapper) wrapper.style.display = 'none';
        const form = ta.closest('form');
        if(!form) return;
        let waTypeInput = form.querySelector('input[name="wa_type"]');
        let waTypeValue = waTypeInput ? waTypeInput.value : null;

        if (!waTypeValue) {
            const stepInput = form.querySelector('input[name="step"]');
            if (stepInput) {
                const step = stepInput.value;
                if (step === 'berkas_verifikasi') waTypeValue = 'berkas_verifikasi';
                else if (step === 'pembayaran_lunas') waTypeValue = 'credential';
                else if (step === 'cek_lokasi') waTypeValue = 'cek_lokasi';
                else if (step === 'rapat') waTypeValue = 'rapat';
                else if (step === 'pertek') waTypeValue = 'pertek_terbit';
                else if (step === 'putr') waTypeValue = 'putr_validasi';
                else if (step === 'pu') waTypeValue = 'pu_selesai';
                else if (step === 'pkkpr') waTypeValue = 'pkkpr_terbit';
            }
        }

        if (!waTypeValue) {
            const html = form.innerHTML;
            if (html.includes('name="bpn_berkas_notes"') || html.includes('Simpan Verifikasi Berkas')) waTypeValue = 'berkas_verifikasi';
            else if (html.includes('name="sps_bpn"') || html.includes('Kirim Kredensial')) waTypeValue = 'credential';
            else if (html.includes('name="bpn_lokasi_notes"') || html.includes('Kirimkan Jadwal Peninjauan Lapangan')) waTypeValue = 'cek_lokasi';
            else if (html.includes('name="bpn_rapat_notes"') || html.includes('Simpan Hasil Rapat')) waTypeValue = 'rapat';
            else if (html.includes('name="pertek_notes"') || html.includes('Kirim Pertek Pertanahan')) waTypeValue = 'pertek_terbit';
            else if (html.includes('name="dinas_pu_notes"') || html.includes('Kirim Validasi Awal')) waTypeValue = 'putr_validasi';
            else if (html.includes('name="dinas_pu_penilaian_notes"') || html.includes('Kirim Penilaian PU')) waTypeValue = 'pu_selesai';
            else if (html.includes('name="ptsp_notes"') || html.includes('Terbitkan Pertimbangan Teknis Pertanahan')) waTypeValue = 'pkkpr_terbit';
            else waTypeValue = 'berkas_verifikasi';
        }

        if (waTypeValue) {
            ta.readOnly = true;
            ta.disabled = true; // Disable so it doesn't send the prefilled text if not manually edited
            ta.style.backgroundColor = '#f4f7f9';
            ta.style.color = '#555';
            ta.rows = 7;
            ta.style.minHeight = '160px';
            
            const btn = document.createElement('button');
            btn.type = 'button';
            btn.className = 'btn-edit-wa';
            btn.innerHTML = '✏️ Rubah Pesan WA';
            btn.style.cssText = 'display:inline-block; margin-bottom:8px; background:#3291A8; color:#fff; border:none; padding:6px 12px; border-radius:4px; font-size:12px; font-weight:600; cursor:pointer;';
            
            ta.parentNode.insertBefore(btn, ta);
            
            btn.addEventListener('click', function() {
                ta.readOnly = false;
                ta.disabled = false; // Re-enable for submission
                ta.style.backgroundColor = '#fff';
                ta.style.color = '#000';
                ta.focus();
                btn.style.display = 'none'; 
            });
            
            let type = '';
            if(window.location.pathname.includes('berusaha')) type = 'berusaha';
            if(window.location.pathname.includes('non-berusaha')) type = 'non_berusaha';
            if(window.location.pathname.includes('kebijakan')) type = 'kebijakan';
            if(window.location.pathname.includes('tanah-timbul')) type = 'tanah_timbul';
            if(window.location.pathname.includes('psn')) type = 'psn';
            
            const appId = window.location.pathname.split('/').pop();
            
            const fetchTemplate = (actionOverride = null) => {
                if(type && appId && !isNaN(appId)) {
                    let url = `/api/wa-template?type=${type}&id=${appId}&wa_type=${waTypeValue}`;
                    if (actionOverride) {
                        url += `&action=${actionOverride}`;
                    }
                    fetch(url)
                        .then(res => res.json())
                        .then(data => {
                            if(data.template) {
                                ta.value = data.template;
                            }
                        })
                        .catch(err => console.error('Gagal fetch template', err));
                }
            };

            // Fetch initial
            let initialAction = null;
            const checkedRadio = form.querySelector('input[type="radio"][name="action"]:checked');
            const selectedSelect = form.querySelector('select[name="action"]');
            if (checkedRadio) {
                initialAction = checkedRadio.value;
            } else if (selectedSelect) {
                initialAction = selectedSelect.value;
            }
            fetchTemplate(initialAction);

            // Listen to radio changes
            const actionRadios = form.querySelectorAll('input[type="radio"][name="action"]');
            actionRadios.forEach(radio => {
                radio.addEventListener('change', function() {
                    fetchTemplate(this.value);
                });
            });

            // Listen to select changes
            const actionSelects = form.querySelectorAll('select[name="action"]');
            actionSelects.forEach(sel => {
                sel.addEventListener('change', function() {
                    fetchTemplate(this.value);
                });
            });
        }
    });
});
</script>
<!-- TIMELINE UX ENHANCEMENTS -->
<style>
    .timeline-step.viewing-step {
        background: #F0F9FF;
        border-radius: 8px;
        padding-left: 8px;
        margin-left: -8px;
        outline: 1px solid #BAE6FD;
        transition: all 0.3s ease;
    }
    .timeline-step.viewing-step .timeline-title {
        color: #0369A1;
    }
    .timeline-step.viewing-step .timeline-title::after {
        content: "📍";
        display: inline-block;
        font-size: 14px;
        margin-left: 6px;
        vertical-align: middle;
        animation: pin-bounce 1s infinite;
    }
    @keyframes pin-bounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-3px); }
    }
    .global-nav-buttons {
        display: flex;
        justify-content: space-between;
        padding: 12px 16px;
        background: #F8FAFC;
        border-top: 1px solid #E2E8F0;
        border-bottom-left-radius: 12px;
        border-bottom-right-radius: 12px;
    }
    .btn-nav-global {
        padding: 6px 14px;
        font-size: 12px;
        font-weight: 600;
        border-radius: 6px;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        border: 1px solid #CBD5E1;
        background: #FFFFFF;
        color: #475569;
        transition: all 0.2s;
        box-shadow: 0 1px 2px rgba(0,0,0,0.05);
    }
    .btn-nav-global:hover:not(:disabled) {
        background: #F1F5F9;
        color: #0F172A;
        border-color: #94A3B8;
    }
    .btn-nav-global:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }
    
    .btn-cek-detail {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        margin-top: 8px;
        padding: 4px 10px;
        font-size: 10.5px;
        font-weight: 700;
        color: #0284C7;
        background: #E0F2FE;
        border: 1px solid #BAE6FD;
        border-radius: 4px;
        cursor: pointer;
        transition: all 0.2s;
    }
    .btn-cek-detail:hover {
        background: #BAE6FD;
        color: #0369A1;
    }
    .timeline-step.viewing-step .btn-cek-detail {
        background: #0EA5E9;
        color: #FFFFFF;
        border-color: #0284C7;
    }
    .timeline-step:hover .btn-cek-detail {
        box-shadow: 0 2px 4px rgba(14,165,233,0.2);
    }
</style>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const timelineSteps = Array.from(document.querySelectorAll('.timeline-step[onclick^="showBpnPanel"]'));
    if(timelineSteps.length === 0) return;
    
    let currentIndex = 0;
    
    // Inject "Cek Detail" button into each clickable timeline step for better UX
    timelineSteps.forEach(step => {
        const contentDiv = step.querySelector('.timeline-content');
        if(contentDiv && !contentDiv.querySelector('.btn-cek-detail')) {
            const btn = document.createElement('button');
            btn.type = 'button';
            btn.className = 'btn-cek-detail';
            btn.innerHTML = '<svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg> Cek Detail';
            
            // The button doesn't need its own click event because it's inside the step which already has a click event.
            // But we add a dummy one to prevent event bubbling issues if needed, actually it's fine.
            contentDiv.appendChild(btn);
        }
    });
    
    // Create Global Nav Container
    const navDiv = document.createElement('div');
    navDiv.className = 'global-nav-buttons';
    
    const prevBtn = document.createElement('button');
    prevBtn.type = 'button';
    prevBtn.className = 'btn-nav-global';
    prevBtn.innerHTML = '<svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg> Sebelumnya';
    
    const nextBtn = document.createElement('button');
    nextBtn.type = 'button';
    nextBtn.className = 'btn-nav-global';
    nextBtn.innerHTML = 'Selanjutnya <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>';
    
    navDiv.appendChild(prevBtn);
    navDiv.appendChild(nextBtn);
    
    // Find the timeline container
    const timelineBody = document.querySelector('.timeline');
    if(timelineBody) {
        const card = timelineBody.closest('.card');
        if(card) {
            // Append to the bottom of the card
            card.appendChild(navDiv);
        }
    }
    
    function updateNavButtons() {
        prevBtn.disabled = currentIndex === 0;
        nextBtn.disabled = currentIndex === timelineSteps.length - 1;
    }
    
    function switchPanel(index) {
        if(index < 0 || index >= timelineSteps.length) return;
        
        currentIndex = index;
        const targetStep = timelineSteps[currentIndex];
        const match = targetStep.getAttribute('onclick') ? targetStep.getAttribute('onclick').match(/showBpnPanel\(['"]?([^'"]+)['"]?\)/) : null;
        
        if(match) {
            const panelId = match[1];
            // Hide all panel steps
            document.querySelectorAll('[id*="-panel-"]').forEach(p => p.style.display = 'none');
            
            let tPanel = document.getElementById('bpn-panel-' + panelId) 
                      || document.getElementById('panel-' + panelId)
                      || document.querySelector('[id$="-panel-' + panelId + '"]');
            
            if(tPanel) { 
                tPanel.style.display = 'block'; 
            }
            
            document.querySelectorAll('.timeline-step').forEach(ts => ts.classList.remove('viewing-step'));
            targetStep.classList.add('viewing-step');
            
            targetStep.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }
        updateNavButtons();
    }
    
    // Override click on timeline steps to sync currentIndex
    timelineSteps.forEach((step, index) => {
        step.addEventListener('click', function(e) {
            e.preventDefault(); 
            switchPanel(index);
        });
    });
    
    prevBtn.addEventListener('click', () => switchPanel(currentIndex - 1));
    nextBtn.addEventListener('click', () => switchPanel(currentIndex + 1));
    
    // Initialize to current active step (or latest completed step)
    setTimeout(() => {
        let initialActiveIndex = timelineSteps.findIndex(s => s.classList.contains('active'));
        if (initialActiveIndex === -1) {
            for (let i = timelineSteps.length - 1; i >= 0; i--) {
                if (timelineSteps[i].classList.contains('completed')) {
                    initialActiveIndex = i;
                    break;
                }
            }
        }
        if (initialActiveIndex === -1) initialActiveIndex = 0;
        
        switchPanel(initialActiveIndex);
    }, 150);
});
</script>
@include('layouts.partials.doc-reminder-modal', [
    'moduleSlug' => 'berusaha',
    'serviceLabel' => 'PKKPR Berusaha',
])
@endsection
