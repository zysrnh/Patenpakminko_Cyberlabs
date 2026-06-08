import re

with open('resources/views/psn/show.blade.php', 'r', encoding='utf-8') as f:
    content = f.read()

# Replace the BPN forms block
start_marker = "{{-- ====== LANGKAH 1: VERIFIKASI BERKAS (Pertama kali masuk) ====== --}}"
end_marker = "@endif {{-- end bpn_berkas_status --}}"

replacement = """                        {{-- ====== TABS / PANELS UNTUK SETIAP LANGKAH ====== --}}
                        <div id="bpn-panel-1" class="bpn-panel-step" style="display: {{ $application->bpn_berkas_status === 'menunggu' ? 'block' : 'none' }};">
                            @php $isStep1Active = ($application->bpn_berkas_status === 'menunggu'); @endphp
                            <fieldset {{ $isStep1Active ? '' : 'disabled' }}>
                                <form action="{{ route('psn.verify', $application->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="step" value="bpn_berkas">
                                    <div style="background:#FFFDF5;border:1px solid #F6AD55;padding:12px 16px;border-radius:8px;font-size:13px;color:#7B341E;margin-bottom:20px;">
                                        <strong>Langkah 1 dari 4 — Verifikasi Berkas Awal:</strong> Periksa kelengkapan dokumen persyaratan yang diunggah pemohon, lalu terima atau tolak.
                                    </div>
                                    <div class="form-group-v">
                                        <label for="action">Tindakan Kelayakan Berkas</label>
                                        <select name="action" id="action" class="form-select-v" required>
                                            <option value="approve" {{ $application->bpn_berkas_status === 'diterima' ? 'selected' : '' }}>Disetujui</option>
                                            <option value="reject" {{ $application->bpn_berkas_status === 'ditolak' ? 'selected' : '' }}>Tidak Disetujui</option>
                                        </select>
                                    </div>
                                    <div class="form-group-v">
                                        <label for="notes">Catatan Kelayakan Berkas</label>
                                        <textarea name="notes" id="notes" class="form-control-v" rows="3" placeholder="Masukkan catatan pemeriksaan dokumen awal..." required>{{ $application->bpn_berkas_status !== 'menunggu' ? $application->bpn_notes : '' }}</textarea>
                                    </div>
                                    @if($isStep1Active)
                                        <button type="submit" class="btn-submit-v">Simpan Verifikasi Tahap 1</button>
                                    @else
                                        <div style="margin-top:12px; font-size:12.5px; color:#c53030; font-weight: 700;">(Tahap ini sudah diselesaikan / dikunci)</div>
                                    @endif
                                </form>
                            </fieldset>
                        </div>

                        <div id="bpn-panel-2" class="bpn-panel-step" style="display: {{ $application->bpn_berkas_status === 'diterima' && (!$application->bpn_cek_lokasi_dt || !$cekLokasiLewat) ? 'block' : 'none' }};">
                            @php $isStep2Active = ($application->bpn_berkas_status === 'diterima'); @endphp
                            <fieldset {{ $isStep2Active ? '' : 'disabled' }}>
                                <form action="{{ route('psn.verify', $application->id) }}" method="POST" style="margin-bottom: 24px;">
                                    @csrf
                                    <input type="hidden" name="step" value="bpn_cek_lokasi">
                                    <div style="display: flex; gap: 8px; align-items: center; margin-bottom: 12px;">
                                        <strong style="font-size: 13.5px; color: var(--clr-ink);">TAHAP 2: Penentuan Jadwal Cek Lokasi Lapangan</strong>
                                    </div>
                                    @if($application->bpn_cek_lokasi_dt)
                                        <div style="background: var(--clr-blue-lt); border-radius: 8px; padding: 12px; font-size: 13px; color: var(--clr-blue-dk); margin-bottom: 16px; border-left: 3px solid var(--clr-blue);">
                                            Jadwal cek lokasi saat ini sudah diatur pada: <strong>{{ $application->bpn_cek_lokasi_date }}</strong>.<br>
                                            Anda dapat memperbarui jadwal di bawah ini jika diperlukan.
                                        </div>
                                    @endif
                                    <div class="form-grid-2">
                                        <div class="form-group-v">
                                            <label for="bpn_cek_lokasi_dt">Waktu Peninjauan Lapangan</label>
                                            <input type="datetime-local" name="bpn_cek_lokasi_dt" id="bpn_cek_lokasi_dt" class="form-control-v" 
                                                   value="{{ $application->bpn_cek_lokasi_dt ? $application->bpn_cek_lokasi_dt->format('Y-m-d\TH:i') : '' }}" required>
                                        </div>
                                        <div class="form-group-v">
                                            <label for="bpn_cek_lokasi_cp">Kontak Person Lapangan (Nama/No. HP)</label>
                                            <input type="text" name="bpn_cek_lokasi_cp" id="bpn_cek_lokasi_cp" class="form-control-v" placeholder="cth: Budi Setiawan (08123456789)" 
                                                   value="{{ $application->bpn_cek_lokasi_cp }}" required>
                                        </div>
                                    </div>
                                    @if($isStep2Active)
                                        <button type="submit" class="btn-submit-v">
                                            {{ $application->bpn_cek_lokasi_dt ? 'Sesuaikan & Kirim Jadwal Baru' : 'Simpan & Kirim Jadwal Ke WhatsApp' }}
                                        </button>
                                    @else
                                        <div style="margin-top:12px; font-size:12.5px; color:#c53030; font-weight: 700;">(Tahap ini belum aktif atau sudah diselesaikan)</div>
                                    @endif
                                </form>
                            </fieldset>
                        </div>

                        <div id="bpn-panel-3" class="bpn-panel-step" style="display: {{ $application->bpn_cek_lokasi_dt && $cekLokasiLewat && (!$application->bpn_rapat_dt || !$rapatLewat) ? 'block' : 'none' }};">
                            @php $isStep3Active = ($application->bpn_cek_lokasi_dt && $cekLokasiLewat); @endphp
                            <fieldset {{ $isStep3Active ? '' : 'disabled' }}>
                                <form action="{{ route('psn.verify', $application->id) }}" method="POST" style="margin-bottom: 24px;">
                                    @csrf
                                    <input type="hidden" name="step" value="bpn_rapat">
                                    <div style="display: flex; gap: 8px; align-items: center; margin-bottom: 12px;">
                                        <strong style="font-size: 13.5px; color: var(--clr-ink);">TAHAP 3: Penjadwalan Sidang / Rapat Koordinasi BPN</strong>
                                    </div>
                                    @if($application->bpn_rapat_dt)
                                        <div style="background: var(--clr-blue-lt); border-radius: 8px; padding: 12px; font-size: 13px; color: var(--clr-blue-dk); margin-bottom: 16px; border-left: 3px solid var(--clr-blue);">
                                            Jadwal Rapat Koordinasi saat ini sudah diatur pada: <strong>{{ $application->bpn_rapat_date }}</strong>.<br>
                                            Anda dapat memperbarui jadwal di bawah ini jika diperlukan.
                                        </div>
                                    @endif
                                    <div class="form-group-v">
                                        <label for="bpn_rapat_dt">Waktu Sidang/Rapat Koordinasi</label>
                                        <input type="datetime-local" name="bpn_rapat_dt" id="bpn_rapat_dt" class="form-control-v" 
                                               value="{{ $application->bpn_rapat_dt ? $application->bpn_rapat_dt->format('Y-m-d\TH:i') : '' }}" required>
                                    </div>
                                    @if($isStep3Active)
                                        <button type="submit" class="btn-submit-v">
                                            {{ $application->bpn_rapat_dt ? 'Sesuaikan & Kirim Rapat Baru' : 'Simpan & Kirim Jadwal Rapat Ke WhatsApp' }}
                                        </button>
                                    @else
                                        <div style="margin-top:12px; font-size:12.5px; color:#c53030; font-weight: 700;">(Tahap ini belum aktif atau sudah diselesaikan)</div>
                                    @endif
                                </form>
                            </fieldset>
                        </div>

                        <div id="bpn-panel-4" class="bpn-panel-step" style="display: {{ $application->bpn_rapat_dt && $rapatLewat && !$application->bpn_pertek_document ? 'block' : 'none' }};">
                            @php $isStep4Active = ($application->bpn_rapat_dt && $rapatLewat && !$application->bpn_pertek_document); @endphp
                            <fieldset {{ $isStep4Active ? '' : 'disabled' }}>
                                <form action="{{ route('psn.verify', $application->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="step" value="bpn_pertek">
                                    <div style="display: flex; gap: 8px; align-items: center; margin-bottom: 12px;">
                                        <strong style="font-size: 13.5px; color: var(--clr-ink);">TAHAP 4: Unggah Dokumen Pertek Hasil Akhir</strong>
                                    </div>
                                    <div class="form-group-v">
                                        <label for="action">Keputusan Rekomendasi Teknis</label>
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
                                            <label for="bpn_pertek_document">Dokumen Surat Rekomendasi/Pertek (PDF)</label>
                                            <input type="file" name="bpn_pertek_document" id="bpn_pertek_document" class="form-control-v" accept=".pdf,.doc,.docx">
                                            <span style="font-size: 11px; color: var(--clr-muted);">*Wajib diunggah jika permohonan disetujui. Maksimal 10MB.</span>
                                        </div>
                                    @endif
                                    <div class="form-group-v">
                                        <label for="notes">Catatan Rekomendasi/Pertek Akhir BPN</label>
                                        <textarea name="notes" id="notes" class="form-control-v" rows="3" placeholder="Masukkan ringkasan pertimbangan tata ruang BPN..." required>{{ $application->status === 'disetujui' || ($application->status === 'ditolak' && !$application->bpn_pertek_document && $application->bpn_berkas_status === 'diterima') ? $application->bpn_notes : '' }}</textarea>
                                    </div>
                                    @if($isStep4Active)
                                        <button type="submit" class="btn-submit-v">Terbitkan Pertek & Blast WA Pemohon</button>
                                    @else
                                        <div style="margin-top:12px; font-size:12.5px; color:#c53030; font-weight: 700;">(Tahap ini belum aktif atau sudah diselesaikan)</div>
                                    @endif
                                </form>
                            </fieldset>
                        </div>
                        
                        <script>
                            function showBpnPanel(stepNum) {
                                // hide all
                                document.querySelectorAll('.bpn-panel-step').forEach(function(el) {
                                    el.style.display = 'none';
                                });
                                // show the selected one
                                var target = document.getElementById('bpn-panel-' + stepNum);
                                if(target) {
                                    target.style.display = 'block';
                                    target.scrollIntoView({ behavior: 'smooth', block: 'center' });
                                }
                            }
                        </script>
                        @endif"""

s_idx = content.find(start_marker)
e_idx = content.find(end_marker)

if s_idx != -1 and e_idx != -1:
    content = content[:s_idx] + replacement + content[e_idx + len(end_marker):]
else:
    print("Markers not found!")

content = content.replace('<div class="timeline-step {{ $step2Status }}">', '<div class="timeline-step {{ $step2Status }}" onclick="showBpnPanel(1)" style="cursor:pointer;">')
content = content.replace('<div class="timeline-step {{ $step3Status }}">', '<div class="timeline-step {{ $step3Status }}" onclick="showBpnPanel(2)" style="cursor:pointer;">')
content = content.replace('<div class="timeline-step {{ $step4Status }}">', '<div class="timeline-step {{ $step4Status }}" onclick="showBpnPanel(3)" style="cursor:pointer;">')
content = content.replace('<div class="timeline-step {{ $step5Status }}">', '<div class="timeline-step {{ $step5Status }}" onclick="showBpnPanel(4)" style="cursor:pointer;">')

with open('resources/views/psn/show.blade.php', 'w', encoding='utf-8') as f:
    f.write(content)

print("Done")
