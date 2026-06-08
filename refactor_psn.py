import re

with open('resources/views/psn/show.blade.php', 'r', encoding='utf-8') as f:
    content = f.read()

# 1. Remove @if($canVerify) and @if($user->isBpn() && ...) wrapping
start_verify = "@if($canVerify)\n                <div class=\"verify-card\">\n                    <h3 class=\"verify-title\">Ã°Å¸â€œÂ  Panel Pemeriksaan Berkas Ã¢â‚¬â€  {{ $verifierRoleLabel }}</h3>\n                    \n                    @if($user->isBpn() && $application->status === 'menunggu_bpn')"

new_verify = """                <div class="verify-card">
                    <h3 class="verify-title">📝 Panel Pemeriksaan Berkas</h3>"""

# Since the characters are corrupted (Ã°Å¸â€œÂ  and Ã¢â‚¬â€ ), we just replace it via regex
content = re.sub(r"@if\(\$canVerify\)\s*<div class=\"verify-card\">\s*<h3 class=\"verify-title\">[^<]+</h3>\s*@if\(\$user->isBpn\(\) && \$application->status === 'menunggu_bpn'\)", new_verify, content)

# 2. Add Auth::user()->isBpn() to isStepActive definitions for BPN panels
content = content.replace(
    "@php $isStep1Active = ($application->bpn_berkas_status === 'menunggu'); @endphp",
    "@php $isStep1Active = (Auth::user()->isBpn() && $application->bpn_berkas_status === 'menunggu'); @endphp"
)
content = content.replace(
    "@php $isStep2Active = ($application->bpn_berkas_status === 'diterima'); @endphp",
    "@php $isStep2Active = (Auth::user()->isBpn() && $application->bpn_berkas_status === 'diterima' && (!$application->bpn_cek_lokasi_dt || !$cekLokasiLewat)); @endphp"
)
content = content.replace(
    "@php $isStep3Active = ($application->bpn_cek_lokasi_dt && $cekLokasiLewat); @endphp",
    "@php $isStep3Active = (Auth::user()->isBpn() && $application->bpn_cek_lokasi_dt && $cekLokasiLewat && (!$application->bpn_rapat_dt || !$rapatLewat)); @endphp"
)
content = content.replace(
    "@php $isStep4Active = ($application->bpn_rapat_dt && $rapatLewat && !$application->bpn_pertek_document); @endphp",
    "@php $isStep4Active = (Auth::user()->isBpn() && $application->bpn_rapat_dt && $rapatLewat && !$application->bpn_pertek_document); @endphp"
)

# 3. Replace PU and PTSP forms with bpn-panel-step
start_pu = "                    @else\n                        {{-- ====== FORM DINAS PU ====== --}}\n                        @if($user->isDinasPu() && $application->status === 'menunggu_dinas_pu')"
end_pu = "                        @endif\n                    @endif\n                </div>\n            @endif"

pu_ptsp_replacement = """                        <div id="panel-pu-1" class="bpn-panel-step" style="display: {{ $application->bpn_pertek_document && $application->status !== 'menunggu_satu_pintu' && $application->status !== 'disetujui' ? 'block' : 'none' }};">
                            @php $isPuActive = (Auth::user()->isDinasPu() && $application->status === 'menunggu_dinas_pu'); @endphp
                            <fieldset {{ $isPuActive ? '' : 'disabled' }}>
                                <form action="{{ route('psn.verify', $application->id) }}" method="POST">
                                    @csrf
                                    <div style="background:#EBF8FF;border:1px solid #90CDF4;padding:12px 16px;border-radius:8px;font-size:13px;color:#2B6CB0;margin-bottom:16px;">
                                        <strong>Penilaian Tata Ruang (Dinas PU):</strong> Periksa kesesuaian tata ruang berdasarkan dokumen Pertek BPN, lalu tentukan keputusan.
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" style="font-weight:700;color:#744210;">Keputusan Penilaian:</label>
                                        <div class="radio-group">
                                            <label class="radio-label"><input type="radio" name="action" value="approve" required {{ $application->status === 'menunggu_satu_pintu' || $application->status === 'disetujui' ? 'checked' : 'checked' }}> Disetujui</label>
                                            <label class="radio-label" style="color:#E53E3E;"><input type="radio" name="action" value="reject" required {{ $application->status === 'ditolak' && !$application->satu_pintu_no_pkkpr ? 'checked' : '' }}> Tidak Disetujui</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="notes_pu" class="form-label" style="font-weight:700;color:#744210;">Catatan Dinas PU <span style="color:red;">*</span></label>
                                        <textarea id="notes_pu" name="notes" class="form-control" rows="3" placeholder="Tuliskan catatan penilaian tata ruang..." style="resize:none;background:white;" required>{{ $application->dinas_pu_notes }}</textarea>
                                    </div>
                                    @if($isPuActive)
                                        <button type="submit" class="btn-verify-submit" style="background:#218AC9;">Kirim Keputusan Penilaian Tata Ruang</button>
                                    @else
                                        <div style="margin-top:12px; font-size:12.5px; color:#c53030; font-weight: 700;">(Tahap ini belum aktif / bukan wewenang Anda / sudah diselesaikan)</div>
                                    @endif
                                </form>
                            </fieldset>
                        </div>

                        <div id="panel-satu-pintu" class="bpn-panel-step" style="display: {{ in_array($application->status, ['menunggu_satu_pintu', 'disetujui']) ? 'block' : 'none' }};">
                            @php $isSpActive = (Auth::user()->isSatuPintu() && $application->status === 'menunggu_satu_pintu'); @endphp
                            <fieldset {{ $isSpActive ? '' : 'disabled' }}>
                                <form action="{{ route('psn.verify', $application->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div style="background:#F0FFF4;border:1px solid #9AE6B4;padding:12px 16px;border-radius:8px;font-size:13px;color:#166534;margin-bottom:16px;">
                                        <strong>Penerbitan PKKPR (Dinas Satu Pintu / PTSP):</strong> Isi data penerbitan PKKPR resmi, lalu unggah dokumen dan kirim.
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" style="font-weight:700;color:#744210;">Keputusan:</label>
                                        <div class="radio-group">
                                            <label class="radio-label"><input type="radio" name="action" value="approve" required checked onclick="toggleSatuPintuFields(true)"> Disetujui</label>
                                            <label class="radio-label" style="color:#E53E3E;"><input type="radio" name="action" value="reject" required onclick="toggleSatuPintuFields(false)"> Tidak Disetujui</label>
                                        </div>
                                    </div>
                                    <div id="satuPintuFieldsWrapper">
                                        <div class="form-group" style="margin-bottom:12px;">
                                            <label for="satu_pintu_no_pkkpr" class="form-label" style="font-weight:700;color:#744210;">Nomor PKKPR (wajib) <span style="color:red;">*</span></label>
                                            <input type="text" id="satu_pintu_no_pkkpr" name="satu_pintu_no_pkkpr" class="form-control"
                                                   placeholder="cth: PKKPR-NB/2026/001" value="{{ $application->satu_pintu_no_pkkpr }}" style="background:white;" required>
                                        </div>
                                        <div class="form-group" style="margin-bottom:12px;">
                                            <label for="satu_pintu_tanggal_terbit" class="form-label" style="font-weight:700;color:#744210;">Tanggal Terbit (wajib) <span style="color:red;">*</span></label>
                                            <input type="date" id="satu_pintu_tanggal_terbit" name="satu_pintu_tanggal_terbit" class="form-control"
                                                   value="{{ $application->satu_pintu_tanggal_terbit ? $application->satu_pintu_tanggal_terbit->format('Y-m-d') : '' }}" style="background:white;" required>
                                        </div>
                                        <div class="form-group" style="margin-bottom:12px;">
                                            @if($application->approval_document)
                                                <label class="form-label" style="font-weight:700;color:#744210;">Dokumen PKKPR</label>
                                                <a href="{{ asset('storage/' . $application->approval_document) }}" target="_blank" style="color:#218AC9; text-decoration:underline; display:block;">Lihat Dokumen Terunggah</a>
                                            @else
                                                <label for="approval_document" class="form-label" style="font-weight:700;color:#744210;">Unggah Dokumen PKKPR (opsional)</label>
                                                <input type="file" id="approval_document" name="approval_document" class="form-control" accept="application/pdf" style="background:white;">
                                                <span style="font-size:11.5px;color:#744210;margin-top:4px;display:block;">Format PDF, maks. 10MB. Dokumen ini dapat diunduh oleh pemohon.</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="notes_sp" class="form-label" style="font-weight:700;color:#744210;">Catatan / Keterangan:</label>
                                        <textarea id="notes_sp" name="notes" class="form-control" rows="3" placeholder="Catatan penerbitan PKKPR (opsional)..." style="resize:none;background:white;">{{ $application->satu_pintu_notes }}</textarea>
                                    </div>
                                    @if($isSpActive)
                                        <button type="submit" class="btn-verify-submit" style="background:#79A73A;">📄 Terbitkan PKKPR & Blast WA Pemohon</button>
                                    @else
                                        <div style="margin-top:12px; font-size:12.5px; color:#c53030; font-weight: 700;">(Tahap ini belum aktif / bukan wewenang Anda / sudah diselesaikan)</div>
                                    @endif
                                </form>
                                <script>
                                    function toggleSatuPintuFields(show) {
                                        const w = document.getElementById('satuPintuFieldsWrapper');
                                        const noEl = document.getElementById('satu_pintu_no_pkkpr');
                                        const tglEl = document.getElementById('satu_pintu_tanggal_terbit');
                                        if (w) {
                                            w.style.display = show ? 'block' : 'none';
                                            if(noEl) show ? noEl.setAttribute('required','required') : noEl.removeAttribute('required');
                                            if(tglEl) show ? tglEl.setAttribute('required','required') : tglEl.removeAttribute('required');
                                        }
                                    }
                                </script>
                            </fieldset>
                        </div>
                </div>
"""

s_idx = content.find(start_pu)
e_idx = content.find(end_pu, s_idx)
if s_idx != -1 and e_idx != -1:
    content = content[:s_idx] + pu_ptsp_replacement + content[e_idx + len(end_pu):]

# 4. Update Timeline Points to be clickable
content = re.sub(r'<div class="timeline-step \{\{ \$step5Status \}\}">\s*<span class="timeline-dot"></span>\s*<div class="timeline-title">5\. Penilaian Tata Ruang \(Dinas PU\)</div>', 
                 '<div class="timeline-step {{ $step5Status }}" onclick="showBpnPanel(\'pu-1\')" style="cursor:pointer;">\n                                <span class="timeline-dot"></span>\n                                <div class="timeline-title">5. Penilaian Tata Ruang (Dinas PU)</div>', 
                 content)

content = re.sub(r'<div class="timeline-step \{\{ \$step6Status \}\}">\s*<span class="timeline-dot"></span>\s*<div class="timeline-title">6\. Penerbitan PKKPR \(Satu Pintu / PTSP\)</div>', 
                 '<div class="timeline-step {{ $step6Status }}" onclick="showBpnPanel(\'satu-pintu\')" style="cursor:pointer;">\n                                <span class="timeline-dot"></span>\n                                <div class="timeline-title">6. Penerbitan PKKPR (Satu Pintu / PTSP)</div>', 
                 content)

with open('resources/views/psn/show.blade.php', 'w', encoding='utf-8') as f:
    f.write(content)

print("Done psn refactor")
