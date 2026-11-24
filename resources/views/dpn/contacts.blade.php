@extends('layouts.app')

@section('title', 'Pengaturan Kontak Admin Instansi - PATEN PAK MIKO')
@section('page-title', 'Pengaturan Kontak Notifikasi')

@section('extra-styles')
    @keyframes ctFadeUp {
        from { opacity: 0; transform: translateY(5px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .ct-hero {
        background: #FFFFFF;
        border: 1px solid #D6E4EF;
        border-radius: 4px;
        padding: 15px 18px;
        margin-bottom: 14px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
        flex-wrap: wrap;
        animation: ctFadeUp .2s cubic-bezier(0.22, 1, 0.36, 1) both;
    }
    .ct-hero-title { font-size: 17px; font-weight: 800; color: #003B64; letter-spacing: -0.02em; margin: 0 0 2px; }
    .ct-hero-sub { font-size: 12.5px; color: #64748B; margin: 0; }
    .ct-format-pill {
        font-size: 11.5px;
        color: #475569;
        background: #F8FAFC;
        border: 1px solid #CBD5E1;
        border-radius: 4px;
        padding: 5px 10px;
    }

    /* Grid 2x2 agar ringkas dalam 1 layar */
    .ct-grid-2x2 {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 14px;
        margin-bottom: 16px;
        animation: ctFadeUp .24s cubic-bezier(0.22, 1, 0.36, 1) .04s both;
    }

    .contact-card {
        background: #FFFFFF;
        border: 1px solid #D6E4EF;
        border-radius: 4px;
        padding: 16px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        position: relative;
        overflow: hidden;
    }
    .contact-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 3px;
    }
    .contact-card--bpn::before  { background: #003B64; }
    .contact-card--putr::before { background: #DD6B20; }
    .contact-card--ptsp::before { background: #218AC9; }
    .contact-card--cp::before   { background: #16A34A; }

    .contact-row-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 8px;
        margin-bottom: 5px;
    }
    .contact-row-title {
        font-size: 14px;
        font-weight: 800;
        color: #003B64;
        display: flex;
        align-items: center;
        gap: 7px;
    }
    .contact-badge-pill {
        font-size: 11px;
        font-weight: 700;
        padding: 2px 8px;
        border-radius: 4px;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        white-space: nowrap;
    }
    .status-filled { background: #DCFCE7; color: #166534; border: 1px solid #BBF7D0; }
    .status-empty  { background: #FEF2F2; color: #DC2626; border: 1px solid #FECACA; }

    .contact-row-desc {
        font-size: 12px;
        color: #64748B;
        line-height: 1.45;
        margin-bottom: 12px;
    }

    .input-group-wa {
        display: flex;
        gap: 6px;
        align-items: center;
    }
    .input-prefix {
        background: #F1F5F9;
        border: 1px solid #CBD5E1;
        border-radius: 4px;
        height: 34px;
        padding: 0 9px;
        font-size: 11.5px;
        font-weight: 700;
        color: #475569;
        display: inline-flex;
        align-items: center;
    }
    .input-wa-field {
        flex: 1;
        min-width: 0;
        height: 34px;
        padding: 0 10px;
        border: 1px solid #CBD5E1;
        border-radius: 4px;
        font-size: 13px;
        font-weight: 600;
        font-family: 'DM Mono', monospace;
        color: #0F172A;
        outline: none;
    }
    .input-wa-field:focus { border-color: #218AC9; }

    .btn-test-wa {
        height: 34px;
        padding: 0 11px;
        background: #16A34A;
        color: #FFFFFF;
        border: none;
        border-radius: 4px;
        font-size: 11.5px;
        font-weight: 700;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        white-space: nowrap;
    }
    .btn-test-wa:hover { background: #15803D; color: #FFFFFF; }

    .btn-remove-number {
        height: 34px;
        width: 34px;
        background: #FEF2F2;
        color: #DC2626;
        border: 1px solid #FECACA;
        border-radius: 4px;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .btn-remove-number:hover { background: #DC2626; color: #FFFFFF; border-color: #DC2626; }

    .btn-add-number {
        margin-top: 10px;
        background: #F8FAFC;
        color: #003B64;
        border: 1px dashed #94B8D4;
        padding: 6px 12px;
        font-family: inherit;
        font-size: 11.5px;
        font-weight: 700;
        border-radius: 4px;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }
    .btn-add-number:hover { background: #E3F0F9; border-color: #218AC9; }

    .contact-number-item + .contact-number-item { margin-top: 8px; }

    .ct-save-bar {
        background: #FFFFFF;
        border: 1px solid #D6E4EF;
        border-radius: 4px;
        padding: 12px 16px;
        display: flex;
        align-items: center;
        justify-content: flex-end;
    }
    .btn-submit-main {
        background: #003B64;
        color: #FFFFFF;
        border: none;
        padding: 9px 20px;
        font-family: inherit;
        font-size: 13px;
        font-weight: 700;
        border-radius: 4px;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    .btn-submit-main:hover { background: #218AC9; }

    @media (max-width: 900px) {
        .ct-grid-2x2 { grid-template-columns: 1fr; }
    }
    @media (prefers-reduced-motion: reduce) {
        .ct-hero, .ct-grid-2x2 { animation: none !important; }
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

    $sections = [
        [
            'key'         => 'admin_bpn',
            'accent'      => 'bpn',
            'title'       => 'Admin Kantor Pertanahan (BPN)',
            'desc'        => 'Notifikasi saat permohonan baru masuk serta validasi & penilaian PUTR selesai.',
            'numbers'     => $normalizeList(old('admin_bpn', $settings['admin_bpn'] ?? [])),
            'placeholder' => '081234567890',
            'btnLabel'    => 'Tambah Nomor BPN',
        ],
        [
            'key'         => 'admin_dinas_pu',
            'accent'      => 'putr',
            'title'       => 'Admin Dinas PUTR (PU)',
            'desc'        => 'Notifikasi saat Pertek BPN terbit untuk penilaian kesesuaian tata ruang.',
            'numbers'     => $normalizeList(old('admin_dinas_pu', $settings['admin_dinas_pu'] ?? [])),
            'placeholder' => '081234567892',
            'btnLabel'    => 'Tambah Nomor PUTR',
        ],
        [
            'key'         => 'admin_satu_pintu',
            'accent'      => 'ptsp',
            'title'       => 'Admin DPMPTSP (Satu Pintu)',
            'desc'        => 'Notifikasi saat penilaian PUTR selesai untuk penerbitan dokumen PKKPR resmi.',
            'numbers'     => $normalizeList(old('admin_satu_pintu', $settings['admin_satu_pintu'] ?? [])),
            'placeholder' => '081234567893',
            'btnLabel'    => 'Tambah Nomor DPMPTSP',
        ],
        [
            'key'         => 'cp_admin',
            'accent'      => 'cp',
            'title'       => 'Contact Person Pemohon',
            'desc'        => 'Disisipkan otomatis di bagian akhir pesan WhatsApp blast ke pemohon.',
            'numbers'     => $normalizeList(old('cp_admin', $settings['cp_admin'] ?? [])),
            'placeholder' => '081234567890',
            'btnLabel'    => 'Tambah Nomor CP',
        ],
    ];
@endphp

<div class="ct-hero">
    <div>
        <h1 class="ct-hero-title">Kontak Notifikasi WhatsApp Instansi</h1>
        <p class="ct-hero-sub">Kelola nomor penerima notifikasi WA otomatis di tiap tahap layanan.</p>
    </div>
    <div class="ct-format-pill">Format: <code>628...</code> atau <code>08...</code></div>
</div>

@if($errors->any())
    <div class="alert alert-error" style="border-radius: 4px; margin-bottom: 14px;">
        @foreach($errors->all() as $err)
            <div style="display: flex; align-items: center; gap: 8px;">
                <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                <span>{{ $err }}</span>
            </div>
        @endforeach
    </div>
@endif

<form action="{{ route('dpn.contacts.save') }}" method="POST">
    @csrf
    <div class="ct-grid-2x2">
        @foreach($sections as $sec)
            @php
                $nums = !empty($sec['numbers']) ? $sec['numbers'] : [''];
                $validCount = count(array_filter($nums, fn($x) => !empty($x)));
            @endphp
            <div class="contact-card contact-card--{{ $sec['accent'] }}" id="section-{{ $sec['key'] }}">
                <div>
                    <div class="contact-row-header">
                        <div class="contact-row-title">{{ $sec['title'] }}</div>
                        @if($validCount > 0)
                            <span class="contact-badge-pill status-filled">{{ $validCount }} Aktif</span>
                        @else
                            <span class="contact-badge-pill status-empty">Kosong</span>
                        @endif
                    </div>
                    <div class="contact-row-desc">{{ $sec['desc'] }}</div>

                    <div class="contact-number-list" id="list-{{ $sec['key'] }}">
                        @foreach($nums as $num)
                            <div class="contact-number-item">
                                <div class="input-group-wa">
                                    <span class="input-prefix">WA</span>
                                    <input type="text" name="{{ $sec['key'] }}[]" class="input-wa-field" placeholder="{{ $sec['placeholder'] }}" value="{{ $num }}" inputmode="numeric">
                                    @if(!empty($num))
                                        @php
                                            $cleanWa = preg_replace('/[^0-9]/', '', $num);
                                            if (str_starts_with($cleanWa, '0')) $cleanWa = '62' . substr($cleanWa, 1);
                                        @endphp
                                        <a href="https://wa.me/{{ $cleanWa }}" target="_blank" class="btn-test-wa" title="Tes chat WhatsApp">Tes WA</a>
                                    @endif
                                    <button type="button" class="btn-remove-number" onclick="removeContactNumber(this)" title="Hapus nomor">
                                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div>
                    <button type="button" class="btn-add-number" onclick="addContactNumber('list-{{ $sec['key'] }}', '{{ $sec['key'] }}[]', '{{ $sec['placeholder'] }}')">
                        <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                        <span>{{ $sec['btnLabel'] }}</span>
                    </button>
                </div>
            </div>
        @endforeach
    </div>

    <div class="ct-save-bar">
        <button type="submit" class="btn-submit-main">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.4" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
            <span>Simpan Kontak Instansi</span>
        </button>
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
            <span class="input-prefix">WA</span>
            <input type="text" name="${inputName}" class="input-wa-field" placeholder="${placeholder}" value="" inputmode="numeric">
            <button type="button" class="btn-remove-number" onclick="removeContactNumber(this)" title="Hapus nomor">
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
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
        const input = item.querySelector('input');
        if (input) input.value = '';
        const testBtn = item.querySelector('.btn-test-wa');
        if (testBtn) testBtn.remove();
    }
}
</script>
@endsection
