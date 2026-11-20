@extends('layouts.app')

@section('title', 'Pengaturan Kontak Admin Instansi - PATEN PAK MIKO')
@section('page-title', 'Pengaturan Kontak Notifikasi')

@section('extra-styles')
    .contact-card-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 16px;
        margin-bottom: 28px;
    }
    .instansi-guide-card {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 12px;
        padding: 16px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.03);
        position: relative;
        overflow: hidden;
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .instansi-guide-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(0,0,0,0.05);
    }
    .instansi-guide-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 4px;
    }
    .instansi-guide-card.bpn::before { background: #003B64; }
    .instansi-guide-card.putr::before { background: #DD6B20; }
    .instansi-guide-card.ptsp::before { background: #6B46C1; }
    .instansi-guide-card.cp::before { background: #059669; }

    .guide-icon {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 12px;
    }
    .bpn .guide-icon { background: #E3F0F9; color: #003B64; }
    .putr .guide-icon { background: #FEEBC8; color: #DD6B20; }
    .ptsp .guide-icon { background: #E9D8FD; color: #6B46C1; }
    .cp .guide-icon { background: #D1FAE5; color: #059669; }

    .guide-title {
        font-size: 13.5px;
        font-weight: 700;
        color: #0F172A;
        margin-bottom: 4px;
    }
    .guide-desc {
        font-size: 11.5px;
        color: #64748B;
        line-height: 1.5;
    }

    .form-panel {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 16px;
        padding: 28px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.02);
    }
    .form-panel-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-bottom: 18px;
        margin-bottom: 24px;
        border-bottom: 1.5px solid #F1F5F9;
    }
    .form-panel-title {
        font-size: 16px;
        font-weight: 800;
        color: #0F172A;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .contact-input-row {
        background: #F8FAFC;
        border: 1.5px solid #E2E8F0;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 20px;
        transition: all 0.2s;
    }
    .contact-input-row:focus-within {
        background: #FFFFFF;
        border-color: #218AC9;
        box-shadow: 0 2px 8px rgba(33, 138, 201, 0.08);
    }

    .contact-row-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 6px;
    }
    .contact-row-title {
        font-size: 14px;
        font-weight: 700;
        color: #0F172A;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .contact-badge-pill {
        font-size: 11px;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 6px;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }
    .status-filled {
        background: #DCFCE7;
        color: #15803D;
        border: 1px solid #BBF7D0;
    }
    .status-empty {
        background: #FEE2E2;
        color: #B91C1C;
        border: 1px solid #FECACA;
    }

    .contact-row-desc {
        font-size: 12px;
        color: #64748B;
        line-height: 1.55;
        margin-bottom: 14px;
    }

    .input-group-wa {
        display: flex;
        gap: 10px;
        align-items: center;
    }
    .input-prefix {
        background: #EDF2F7;
        border: 1.5px solid #CBD5E1;
        border-radius: 8px;
        padding: 10px 14px;
        font-size: 13px;
        font-weight: 700;
        color: #475569;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .input-wa-field {
        flex: 1;
        padding: 10px 14px;
        border: 1.5px solid #CBD5E1;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        font-family: 'DM Mono', monospace;
        color: #0F172A;
        outline: none;
        transition: border-color 0.2s;
    }
    .input-wa-field:focus {
        border-color: #218AC9;
    }
    .btn-test-wa {
        padding: 10px 16px;
        background: #25D366;
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 12.5px;
        font-weight: 700;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: background 0.2s;
        white-space: nowrap;
    }
    .btn-test-wa:hover {
        background: #1EBE57;
        color: white;
    }
    .btn-remove-number {
        background: #FEE2E2;
        color: #DC2626;
        border: 1px solid #FECACA;
        padding: 10px 12px;
        border-radius: 8px;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.15s ease;
    }
    .btn-remove-number:hover {
        background: #FCA5A5;
        color: #991B1B;
    }
    .btn-add-number {
        background: #F1F5F9;
        color: #003B64;
        border: 1.5px dashed #CBD5E1;
        padding: 8px 16px;
        font-size: 12px;
        font-weight: 700;
        border-radius: 6px;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.15s ease;
    }
    .btn-add-number:hover {
        background: #E2E8F0;
        border-color: #94A3B8;
        color: #00223D;
    }
    .contact-number-item + .contact-number-item {
        margin-top: 10px;
    }

    .btn-submit-main {
        background: #003B64;
        color: white;
        border: none;
        padding: 12px 28px;
        font-size: 14px;
        font-weight: 700;
        border-radius: 10px;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        transition: background 0.2s;
    }
    .btn-submit-main:hover {
        background: #002B4A;
    }

    /* ─── MOBILE RESPONSIVE ────────────────────────────── */
    @media (max-width: 640px) {
        .form-panel {
            padding: 16px 14px;
        }
        .contact-input-row {
            padding: 14px 12px;
        }
        .contact-row-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 8px;
        }
        .input-group-wa {
            flex-wrap: wrap;
            gap: 8px;
        }
        .input-wa-field {
            min-width: 140px;
        }
        .btn-test-wa {
            width: 100%;
            justify-content: center;
            padding: 10px 14px;
        }
        .btn-remove-number {
            padding: 10px 14px;
        }
        .btn-add-number {
            width: 100%;
            justify-content: center;
        }
        .btn-submit-main {
            width: 100%;
            justify-content: center;
        }
        .contact-card-grid {
            display: none !important;
        }
    }
@endsection

@section('content')
@php
    $normalizeList = function($val) {
        if (is_array($val)) {
            return array_values(array_filter(array_map('trim', $val), fn($x) => $x !== '' && $x !== null));
        }
        if (is_string($val) && trim($val) !== '') {
            $parts = preg_split('/[\r\n,;]+/', trim($val));
            return array_values(array_filter(array_map('trim', $parts), fn($x) => $x !== '' && $x !== null));
        }
        return [];
    };

    $bpnNumbers = $normalizeList(old('admin_bpn', $settings['admin_bpn'] ?? []));
    if (empty($bpnNumbers)) $bpnNumbers = [''];

    $puNumbers = $normalizeList(old('admin_dinas_pu', $settings['admin_dinas_pu'] ?? []));
    if (empty($puNumbers)) $puNumbers = [''];

    $ptspNumbers = $normalizeList(old('admin_satu_pintu', $settings['admin_satu_pintu'] ?? []));
    if (empty($ptspNumbers)) $ptspNumbers = [''];

    $cpNumbers = $normalizeList(old('cp_admin', $settings['cp_admin'] ?? []));
    if (empty($cpNumbers)) $cpNumbers = [''];
@endphp

<div class="page-header">
    <div class="page-header-left">
        <div class="breadcrumb">
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <span>›</span>
            <span>Pengaturan Kontak Notifikasi</span>
        </div>
        <h1>
            <svg style="width:24px;height:24px;vertical-align:-4px;margin-right:8px;color:var(--blue);" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
            Pengaturan Kontak Notifikasi WhatsApp
        </h1>
        <p>Kelola nomor telepon penerima notifikasi WhatsApp otomatis untuk setiap instansi terkait dalam alur layanan. Anda dapat menambahkan lebih dari satu nomor admin per instansi.</p>
    </div>
</div>

@if($errors->any())
    <div class="alert alert-error" style="display: block; margin-bottom: 24px;">
        @foreach($errors->all() as $err)
            <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 4px;">
                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                <span>{{ $err }}</span>
            </div>
        @endforeach
    </div>
@endif

<!-- Ringkasan Alur Notifikasi Instansi -->
<div class="contact-card-grid">
    <div class="instansi-guide-card bpn">
        <div class="guide-icon">
            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5m0 0h5m-5 0V10"/></svg>
        </div>
        <div class="guide-title">Kantor Pertanahan (BPN)</div>
        <div class="guide-desc">Menerima notifikasi saat berkas diajukan, serta saat penyelesaian validasi & penilaian PUTR.</div>
    </div>

    <div class="instansi-guide-card putr">
        <div class="guide-icon">
            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
        </div>
        <div class="guide-title">Dinas PUTR (PU)</div>
        <div class="guide-desc">Menerima notifikasi saat Pertek BPN terbit untuk melakukan permohonan validasi & penilaian Pertimbangan Teknis.</div>
    </div>

    <div class="instansi-guide-card ptsp">
        <div class="guide-icon">
            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
        </div>
        <div class="guide-title">DPMPTSP (Satu Pintu)</div>
        <div class="guide-desc">Menerima notifikasi saat penilaian PUTR selesai untuk penerbitan dokumen PKKPR resmi.</div>
    </div>

    <div class="instansi-guide-card cp">
        <div class="guide-icon">
            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
        </div>
        <div class="guide-title">Contact Person Pemohon</div>
        <div class="guide-desc">Disisipkan pada pesan WhatsApp blast yang dikirimkan ke pemohon sebagai kontak bantuan.</div>
    </div>
</div>

<!-- Form Pengaturan Kontak -->
<form action="{{ route('dpn.contacts.save') }}" method="POST">
    @csrf
    <div class="form-panel">
        <div class="form-panel-header">
            <div class="form-panel-title">
                <svg width="20" height="20" fill="none" stroke="#003B64" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                Nomor Telepon Admin Instansi Terkait
            </div>
            <span style="font-size: 12px; color: #64748B;">Format: <code>628...</code> atau <code>08...</code> (Bisa tambah banyak nomor)</span>
        </div>

        <!-- 1. Admin Kantor Pertanahan (BPN) -->
        <div class="contact-input-row" id="section-admin_bpn">
            <div class="contact-row-header">
                <div class="contact-row-title">
                    <span style="width:10px; height:10px; border-radius:50%; background:#003B64; display:inline-block;"></span>
                    Admin Kantor Pertanahan (BPN)
                </div>
                @php
                    $validBpn = count(array_filter($bpnNumbers, fn($x) => !empty($x)));
                @endphp
                @if($validBpn > 0)
                    <span class="contact-badge-pill status-filled">
                        <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"/></svg>
                        {{ $validBpn }} Nomor Tersimpan
                    </span>
                @else
                    <span class="contact-badge-pill status-empty">
                        <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                        Belum Diisi
                    </span>
                @endif
            </div>
            <div class="contact-row-desc">
                Menerima notifikasi WhatsApp saat ada permohonan baru, penyelesaian validasi PUTR, serta penyelesaian penilaian PUTR.
            </div>
            
            <div class="contact-number-list" id="list-admin_bpn">
                @foreach($bpnNumbers as $num)
                    <div class="contact-number-item">
                        <div class="input-group-wa">
                            <div class="input-prefix">
                                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                WA
                            </div>
                            <input type="text" name="admin_bpn[]" class="input-wa-field" placeholder="Contoh: 081234567890" value="{{ $num }}" inputmode="numeric">
                            @if(!empty($num))
                                @php
                                    $cleanBpn = preg_replace('/[^0-9]/', '', $num);
                                    if (str_starts_with($cleanBpn, '0')) $cleanBpn = '62' . substr($cleanBpn, 1);
                                @endphp
                                <a href="https://wa.me/{{ $cleanBpn }}" target="_blank" class="btn-test-wa" title="Tes chat WhatsApp ke nomor ini">
                                    <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/></svg>
                                    Tes WA
                                </a>
                            @endif
                            <button type="button" class="btn-remove-number" onclick="removeContactNumber(this)" title="Hapus baris nomor ini">
                                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <div style="margin-top: 12px;">
                <button type="button" class="btn-add-number" onclick="addContactNumber('list-admin_bpn', 'admin_bpn[]', '081234567890')">
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                    Tambah Nomor Admin BPN
                </button>
            </div>
        </div>

        <!-- 2. Admin PUTR -->
        <div class="contact-input-row" id="section-admin_dinas_pu">
            <div class="contact-row-header">
                <div class="contact-row-title">
                    <span style="width:10px; height:10px; border-radius:50%; background:#DD6B20; display:inline-block;"></span>
                    Admin Dinas PUTR (PU)
                </div>
                @php
                    $validPu = count(array_filter($puNumbers, fn($x) => !empty($x)));
                @endphp
                @if($validPu > 0)
                    <span class="contact-badge-pill status-filled">
                        <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"/></svg>
                        {{ $validPu }} Nomor Tersimpan
                    </span>
                @else
                    <span class="contact-badge-pill status-empty">
                        <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                        Belum Diisi
                    </span>
                @endif
            </div>
            <div class="contact-row-desc">
                Menerima notifikasi WhatsApp saat Pertek Kantor Pertanahan (BPN) terbit untuk proses verifikasi & penilaian lokasi.
            </div>

            <div class="contact-number-list" id="list-admin_dinas_pu">
                @foreach($puNumbers as $num)
                    <div class="contact-number-item">
                        <div class="input-group-wa">
                            <div class="input-prefix">
                                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                WA
                            </div>
                            <input type="text" name="admin_dinas_pu[]" class="input-wa-field" placeholder="Contoh: 081234567892" value="{{ $num }}" inputmode="numeric">
                            @if(!empty($num))
                                @php
                                    $cleanPu = preg_replace('/[^0-9]/', '', $num);
                                    if (str_starts_with($cleanPu, '0')) $cleanPu = '62' . substr($cleanPu, 1);
                                @endphp
                                <a href="https://wa.me/{{ $cleanPu }}" target="_blank" class="btn-test-wa" title="Tes chat WhatsApp ke nomor ini">
                                    <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/></svg>
                                    Tes WA
                                </a>
                            @endif
                            <button type="button" class="btn-remove-number" onclick="removeContactNumber(this)" title="Hapus baris nomor ini">
                                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>

            <div style="margin-top: 12px;">
                <button type="button" class="btn-add-number" onclick="addContactNumber('list-admin_dinas_pu', 'admin_dinas_pu[]', '081234567892')">
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                    Tambah Nomor Admin PUTR
                </button>
            </div>
        </div>

        <!-- 3. Admin DPMPTSP (Satu Pintu) -->
        <div class="contact-input-row" id="section-admin_satu_pintu">
            <div class="contact-row-header">
                <div class="contact-row-title">
                    <span style="width:10px; height:10px; border-radius:50%; background:#6B46C1; display:inline-block;"></span>
                    Admin DPMPTSP (Satu Pintu)
                </div>
                @php
                    $validPtsp = count(array_filter($ptspNumbers, fn($x) => !empty($x)));
                @endphp
                @if($validPtsp > 0)
                    <span class="contact-badge-pill status-filled">
                        <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"/></svg>
                        {{ $validPtsp }} Nomor Tersimpan
                    </span>
                @else
                    <span class="contact-badge-pill status-empty">
                        <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                        Belum Diisi
                    </span>
                @endif
            </div>
            <div class="contact-row-desc">
                Menerima notifikasi WhatsApp saat penilaian PUTR selesai untuk penerbitan dokumen PKKPR resmi.
            </div>

            <div class="contact-number-list" id="list-admin_satu_pintu">
                @foreach($ptspNumbers as $num)
                    <div class="contact-number-item">
                        <div class="input-group-wa">
                            <div class="input-prefix">
                                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                WA
                            </div>
                            <input type="text" name="admin_satu_pintu[]" class="input-wa-field" placeholder="Contoh: 081234567893" value="{{ $num }}" inputmode="numeric">
                            @if(!empty($num))
                                @php
                                    $cleanPtsp = preg_replace('/[^0-9]/', '', $num);
                                    if (str_starts_with($cleanPtsp, '0')) $cleanPtsp = '62' . substr($cleanPtsp, 1);
                                @endphp
                                <a href="https://wa.me/{{ $cleanPtsp }}" target="_blank" class="btn-test-wa" title="Tes chat WhatsApp ke nomor ini">
                                    <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/></svg>
                                    Tes WA
                                </a>
                            @endif
                            <button type="button" class="btn-remove-number" onclick="removeContactNumber(this)" title="Hapus baris nomor ini">
                                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>

            <div style="margin-top: 12px;">
                <button type="button" class="btn-add-number" onclick="addContactNumber('list-admin_satu_pintu', 'admin_satu_pintu[]', '081234567893')">
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                    Tambah Nomor Admin DPMPTSP
                </button>
            </div>
        </div>

        <!-- 4. Contact Person (Pemohon) -->
        <div class="contact-input-row" id="section-cp_admin">
            <div class="contact-row-header">
                <div class="contact-row-title">
                    <span style="width:10px; height:10px; border-radius:50%; background:#059669; display:inline-block;"></span>
                    Contact Person Layanan (Bantuan Pemohon)
                </div>
                @php
                    $validCp = count(array_filter($cpNumbers, fn($x) => !empty($x)));
                @endphp
                @if($validCp > 0)
                    <span class="contact-badge-pill status-filled">
                        <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"/></svg>
                        {{ $validCp }} Nomor Tersimpan
                    </span>
                @else
                    <span class="contact-badge-pill status-empty">
                        <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                        Belum Diisi
                    </span>
                @endif
            </div>
            <div class="contact-row-desc">
                Nomor ini disisipkan secara otomatis pada bagian akhir setiap notifikasi WhatsApp blast kepada pemohon sebagai nomor bantuan/call center.
            </div>

            <div class="contact-number-list" id="list-cp_admin">
                @foreach($cpNumbers as $num)
                    <div class="contact-number-item">
                        <div class="input-group-wa">
                            <div class="input-prefix">
                                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                WA
                            </div>
                            <input type="text" name="cp_admin[]" class="input-wa-field" placeholder="Contoh: 081234567890" value="{{ $num }}" inputmode="numeric">
                            @if(!empty($num))
                                @php
                                    $cleanCp = preg_replace('/[^0-9]/', '', $num);
                                    if (str_starts_with($cleanCp, '0')) $cleanCp = '62' . substr($cleanCp, 1);
                                @endphp
                                <a href="https://wa.me/{{ $cleanCp }}" target="_blank" class="btn-test-wa" title="Tes chat WhatsApp ke nomor ini">
                                    <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/></svg>
                                    Tes WA
                                </a>
                            @endif
                            <button type="button" class="btn-remove-number" onclick="removeContactNumber(this)" title="Hapus baris nomor ini">
                                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>

            <div style="margin-top: 12px;">
                <button type="button" class="btn-add-number" onclick="addContactNumber('list-cp_admin', 'cp_admin[]', '081234567890')">
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                    Tambah Nomor CP Pemohon
                </button>
            </div>
        </div>

        <div style="margin-top: 32px; padding-top: 20px; border-top: 1.5px solid #F1F5F9; display: flex; justify-content: flex-end;">
            <button type="submit" class="btn-submit-main">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                Simpan Kontak Admin Instansi
            </button>
        </div>
    </div>
</form>
@endsection

@section('scripts')
<script>
function addContactNumber(listId, inputName, placeholder) {
    const list = document.getElementById(listId);
    if (!list) return;

    const div = document.createElement('div');
    div.className = 'contact-number-item';
    div.innerHTML = `
        <div class="input-group-wa">
            <div class="input-prefix">
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                WA
            </div>
            <input type="text" name="${inputName}" class="input-wa-field" placeholder="Contoh: ${placeholder}" value="" inputmode="numeric">
            <button type="button" class="btn-remove-number" onclick="removeContactNumber(this)" title="Hapus baris nomor ini">
                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
            </button>
        </div>
    `;
    list.appendChild(div);
    const input = div.querySelector('input');
    if (input) input.focus();
}

function removeContactNumber(btn) {
    const item = btn.closest('.contact-number-item');
    if (!item) return;
    const list = item.closest('.contact-number-list');
    if (list && list.querySelectorAll('.contact-number-item').length > 1) {
        item.remove();
    } else {
        // Jika tinggal 1 baris, kosongkan isinya
        const input = item.querySelector('input');
        if (input) input.value = '';
        const testBtn = item.querySelector('.btn-test-wa');
        if (testBtn) testBtn.remove();
    }
}
</script>
@endsection
