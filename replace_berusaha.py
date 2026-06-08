import re

with open('resources/views/berusaha/show.blade.php', 'r', encoding='utf-8') as f:
    content = f.read()

# Replace the BPN forms block
start_marker = "                    <!-- SUB-STEP 1: Verifikasi Berkas Awal -->"
end_marker = "                </div>\n            @endif"

replacement = """                    <!-- SUB-STEP 1: Verifikasi Berkas Awal -->
                        <div id="bpn-panel-1" class="bpn-panel-step" style="display: {{ $application->bpn_berkas_status === 'menunggu' ? 'block' : 'none' }};">
                            @php $isStep1Active = ($application->bpn_berkas_status === 'menunggu'); @endphp
                            <fieldset {{ $isStep1Active ? '' : 'disabled' }}>
                                <form action="{{ route('berusaha.verify', $application->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="step" value="bpn_berkas">
                                    <div style="display: flex; gap: 8px; align-items: center; margin-bottom: 12px;">
                                        <strong style="font-size: 13px;">Langkah 1: Verifikasi Kelayakan Dokumen Persyaratan</strong>
                                    </div>
                                    <div class="form-group-v">
                                        <label for="action">Tindakan Pemeriksaan Berkas</label>
                                        <select name="action" id="action" class="form-select-v" required>
                                            <option value="approve" {{ $application->bpn_berkas_status === 'diterima' ? 'selected' : '' }}>Disetujui</option>
                                            <option value="reject" {{ $application->bpn_berkas_status === 'ditolak' || $application->bpn_berkas_status === 'tidak_sesuai' ? 'selected' : '' }}>Tidak Disetujui</option>
                                        </select>
                                    </div>
                                    
                                    <div id="revisi-berkas-container" style="display:none; margin-bottom: 12px; background: #fff5f5; padding: 12px; border: 1px solid #fed7d7; border-radius: 6px;">
                                        <label style="font-weight: 600; font-size: 12px; color: #c53030; margin-bottom: 8px; display: block;">Tandai Berkas yang Tidak Valid / Kurang Lengkap (Otomatis masuk ke catatan):</label>
                                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 6px; font-size: 12px;">
                                            <label><input type="checkbox" class="cb-revisi" value="Formulir PTP"> Formulir PTP</label>
                                            <label><input type="checkbox" class="cb-revisi" value="Peta Lokasi / Sketsa"> Peta Lokasi / Sketsa</label>
                                            <label><input type="checkbox" class="cb-revisi" value="KTP Pemohon"> KTP Pemohon</label>
                                            <label><input type="checkbox" class="cb-revisi" value="NPWP"> NPWP</label>
                                            <label><input type="checkbox" class="cb-revisi" value="Surat Kuasa"> Surat Kuasa</label>
                                            <label><input type="checkbox" class="cb-revisi" value="NIB / KBLI"> NIB / KBLI</label>
                                            <label><input type="checkbox" class="cb-revisi" value="Akta Pendirian"> Akta Pendirian</label>
                                            <label><input type="checkbox" class="cb-revisi" value="Proposal Kegiatan"> Proposal Kegiatan</label>
                                        </div>
                                    </div>
                                    <div class="form-group-v">
                                        <label for="notes">Catatan Pemeriksaan</label>
                                        <textarea name="notes" id="notes" class="form-control-v" rows="3" placeholder="Masukkan catatan atau instruksi perbaikan..." required>{{ $application->bpn_berkas_status !== 'menunggu' ? $application->bpn_notes : '' }}</textarea>
                                    </div>
                                    @if($isStep1Active)
                                        <button type="submit" class="btn-submit-v">Simpan Verifikasi Berkas</button>
                                    @else
                                        <div style="margin-top:12px; font-size:12.5px; color:#c53030; font-weight: 700;">(Tahap ini sudah diselesaikan / dikunci)</div>
                                    @endif
                                </form>
                            </fieldset>
                        </div>

                        <div id="bpn-panel-2" class="bpn-panel-step" style="display: {{ $application->dinas_pu_status === 'validasi_awal_diterima' && $application->bpn_pembayaran_status === 'belum_bayar' ? 'block' : 'none' }};">
                            @php $isStep2Active = ($application->dinas_pu_status === 'validasi_awal_diterima' && $application->bpn_pembayaran_status === 'belum_bayar'); @endphp
                            <fieldset {{ $isStep2Active ? '' : 'disabled' }}>
                                <form action="{{ route('berusaha.verify', $application->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="step" value="bpn_pembayaran">
                                    <div style="display: flex; gap: 8px; align-items: center; margin-bottom: 12px;">
                                        <strong style="font-size: 13px;">Langkah 2: Konfirmasi Pembayaran PTN & Input No. Berkas</strong>
                                    </div>
                                    <p style="font-size: 13px; color: var(--clr-muted); margin-bottom: 16px;">
                                        Setelah pemohon melakukan pembayaran PTN pertanahan secara offline, input <strong>Nomor Berkas</strong> di bawah lalu klik <strong>"Kirim Kredensial & Konfirmasi Lunas"</strong> untuk memverifikasi dan otomatis mengirimkan kredensial login dashboard ke WhatsApp pemohon.
                                    </p>
                                    <div class="form-group-v">
                                        <label for="no_berkas">Nomor Berkas (wajib diisi)</label>
                                        <input type="text" name="no_berkas" id="no_berkas" class="form-control-v"
                                               placeholder="cth: BERKAS/PKKPR-B/2026/001"
                                               value="{{ $application->no_berkas ?? old('no_berkas') }}" required>
                                        <span style="font-size: 11px; color: var(--clr-muted);">Nomor berkas ini akan dicatat dalam sistem dan dikirim ke pemohon via WhatsApp.</span>
                                    </div>
                                    @if($isStep2Active)
                                        <button type="submit" class="btn-submit-v">
                                            <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 2L11 13M22 2l-7 20-4-9-9-4 20-7z"/></svg>
                                            Kirim Kredensial & Konfirmasi Lunas
                                        </button>
                                    @else
                                        <div style="margin-top:12px; font-size:12.5px; color:#c53030; font-weight: 700;">(Tahap ini belum aktif atau sudah diselesaikan)</div>
                                    @endif
                                </form>
                            </fieldset>
                        </div>

                        <div id="bpn-panel-3" class="bpn-panel-step" style="display: {{ $application->bpn_pembayaran_status === 'sudah_bayar' && !$application->bpn_cek_lokasi_dt ? 'block' : 'none' }};">
                            @php $isStep3Active = ($application->bpn_pembayaran_status === 'sudah_bayar'); @endphp
                            <fieldset {{ $isStep3Active ? '' : 'disabled' }}>
                                <form action="{{ route('berusaha.verify', $application->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="step" value="bpn_cek_lokasi">
                                    <div style="display: flex; gap: 8px; align-items: center; margin-bottom: 12px;">
                                        <strong style="font-size: 13px;">Langkah 3: Jadwal Cek Lokasi Lapangan</strong>
                                    </div>
                                    <div class="form-grid-2">
                                        <div class="form-group-v">
                                            <label for="bpn_cek_lokasi_dt">Tanggal & Waktu Peninjauan</label>
                                            <input type="datetime-local" name="bpn_cek_lokasi_dt" id="bpn_cek_lokasi_dt" class="form-control-v" 
                                                   value="{{ $application->bpn_cek_lokasi_dt ? $application->bpn_cek_lokasi_dt->format('Y-m-d\TH:i') : '' }}" required>
                                        </div>
                                        <div class="form-group-v">
                                            <label for="bpn_cek_lokasi_cp">Kontak CP Admin / Petugas</label>
                                            <input type="text" name="bpn_cek_lokasi_cp" id="bpn_cek_lokasi_cp" class="form-control-v" placeholder="cth: Admin BPN (081234567891)" 
                                                   value="{{ $application->bpn_cek_lokasi_cp }}" required>
                                        </div>
                                    </div>
                                    @if($isStep3Active)
                                        <button type="submit" class="btn-submit-v">
                                            <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 2L11 13M22 2l-7 20-4-9-9-4 20-7z"/></svg>
                                            Kirimkan Jadwal Cek Lokasi
                                        </button>
                                    @else
                                        <div style="margin-top:12px; font-size:12.5px; color:#c53030; font-weight: 700;">(Tahap ini belum aktif atau sudah diselesaikan)</div>
                                    @endif
                                </form>
                            </fieldset>
                        </div>

                        <div id="bpn-panel-4" class="bpn-panel-step" style="display: {{ $application->bpn_cek_lokasi_dt && !$application->bpn_rapat_dt ? 'block' : 'none' }};">
                            @php $isStep4Active = ($application->bpn_cek_lokasi_dt && true); @endphp
                            <fieldset {{ $isStep4Active ? '' : 'disabled' }}>
                                <form action="{{ route('berusaha.verify', $application->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="step" value="bpn_rapat">
                                    <div style="display: flex; gap: 8px; align-items: center; margin-bottom: 12px;">
                                        <strong style="font-size: 13px;">Langkah 4: Jadwal Sidang / Rapat Koordinasi</strong>
                                    </div>
                                    <div class="form-group-v">
                                        <label for="bpn_rapat_dt">Tanggal & Waktu Rapat</label>
                                        <input type="datetime-local" name="bpn_rapat_dt" id="bpn_rapat_dt" class="form-control-v" 
                                               value="{{ $application->bpn_rapat_dt ? $application->bpn_rapat_dt->format('Y-m-d\TH:i') : '' }}" required>
                                    </div>
                                    @if($isStep4Active)
                                        <button type="submit" class="btn-submit-v">
                                            <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 2L11 13M22 2l-7 20-4-9-9-4 20-7z"/></svg>
                                            Kirimkan Jadwal Rapat
                                        </button>
                                    @else
                                        <div style="margin-top:12px; font-size:12.5px; color:#c53030; font-weight: 700;">(Tahap ini belum aktif atau sudah diselesaikan)</div>
                                    @endif
                                </form>
                            </fieldset>
                        </div>

                        <div id="bpn-panel-5" class="bpn-panel-step" style="display: {{ $application->bpn_rapat_dt && !$application->bpn_pertek_document ? 'block' : 'none' }};">
                            @php $isStep5Active = ($application->bpn_rapat_dt && !$application->bpn_pertek_document); @endphp
                            <fieldset {{ $isStep5Active ? '' : 'disabled' }}>
                                <form action="{{ route('berusaha.verify', $application->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="step" value="bpn_pertek">
                                    <div style="display: flex; gap: 8px; align-items: center; margin-bottom: 12px;">
                                        <strong style="font-size: 13px;">Langkah 5: Penerbitan Pertek Pertanahan</strong>
                                    </div>
                                    <div class="form-group-v">
                                        <label for="action">Tindakan Rekomendasi Teknis</label>
                                        <select name="action" id="action" class="form-select-v" required>
                                            <option value="approve" {{ $application->bpn_pertek_document || $application->status === 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                                            <option value="reject" {{ $application->status === 'ditolak' && !$application->bpn_pertek_document && $application->bpn_berkas_status === 'diterima' ? 'selected' : '' }}>Tidak Disetujui</option>
                                        </select>
                                    </div>
                                    @if($application->bpn_pertek_document)
                                        <div class="form-group-v">
                                            <label for="bpn_pertek_document">Dokumen Pertek / Rekomendasi (PDF)</label>
                                            <a href="{{ asset('storage/' . $application->bpn_pertek_document) }}" target="_blank" style="color:#218AC9; text-decoration:underline; display:block;">Lihat Dokumen Terunggah</a>
                                        </div>
                                    @else
                                        <div class="form-group-v">
                                            <label for="bpn_pertek_document">Dokumen Surat Pertek (PDF)</label>
                                            <input type="file" name="bpn_pertek_document" id="bpn_pertek_document" class="form-control-v" accept=".pdf">
                                            <span style="font-size: 11px; color: var(--clr-muted);">*Wajib diunggah jika permohonan disetujui. Maksimal 10MB.</span>
                                        </div>
                                    @endif
                                    <div class="form-group-v">
                                        <label for="notes">Catatan Pertimbangan Teknis BPN</label>
                                        <textarea name="notes" id="notes" class="form-control-v" rows="3" placeholder="Masukkan ringkasan kajian tata ruang pertanahan..." required>{{ $application->status === 'disetujui' || ($application->status === 'ditolak' && !$application->bpn_pertek_document && $application->bpn_berkas_status === 'diterima') ? $application->bpn_notes : '' }}</textarea>
                                    </div>
                                    @if($isStep5Active)
                                        <button type="submit" class="btn-submit-v">Kirim Pertek Pertanahan</button>
                                    @else
                                        <div style="margin-top:12px; font-size:12.5px; color:#c53030; font-weight: 700;">(Tahap ini belum aktif atau sudah diselesaikan)</div>
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
                </div>
            @endif"""

s_idx = content.find(start_marker)
e_idx = content.find(end_marker, s_idx)

if s_idx != -1 and e_idx != -1:
    content = content[:s_idx] + replacement + content[e_idx + len(end_marker):]
else:
    print("Markers not found! Start:", s_idx, "End:", e_idx)

# Timeline modifications
content = content.replace('<div class="timeline-step {{ $step2Status }}">', '<div class="timeline-step {{ $step2Status }}" onclick="showBpnPanel(1)" style="cursor:pointer;">')
content = content.replace('<div class="timeline-step {{ $step4Status }}">', '<div class="timeline-step {{ $step4Status }}" onclick="showBpnPanel(2)" style="cursor:pointer;">')
content = content.replace('<div class="timeline-step {{ $step5Status }}">', '<div class="timeline-step {{ $step5Status }}" onclick="showBpnPanel(3)" style="cursor:pointer;">')
content = content.replace('<div class="timeline-step {{ $step6Status }}">', '<div class="timeline-step {{ $step6Status }}" onclick="showBpnPanel(4)" style="cursor:pointer;">')
content = content.replace('<div class="timeline-step {{ $step7Status }}">', '<div class="timeline-step {{ $step7Status }}" onclick="showBpnPanel(5)" style="cursor:pointer;">')

with open('resources/views/berusaha/show.blade.php', 'w', encoding='utf-8') as f:
    f.write(content)

print("Done berusaha")
