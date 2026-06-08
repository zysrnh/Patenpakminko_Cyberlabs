import re

with open('resources/views/berusaha/show.blade.php', 'r', encoding='utf-8') as f:
    content = f.read()

# Replace PU Panel 1 and 2
start_pu = "            <!-- 2. DINAS PU PANEL -->"
end_pu = "            <!-- 3. DINAS SATU PINTU (PTSP) PANEL -->"

pu_replacement = """            <!-- 2. DINAS PU PANEL -->
                    <!-- TAHAP A: Validasi Permohonan Awal oleh Dinas PUTR (Stage 3) -->
                    <div id="panel-pu-1" class="bpn-panel-step" style="display: {{ $user->isDinasPu() && $application->status === 'menunggu_dinas_pu' && $application->dinas_pu_status === 'menunggu_validasi_awal' ? 'block' : 'none' }};">
                        @php $isPu1Active = ($user->isDinasPu() && $application->status === 'menunggu_dinas_pu' && $application->dinas_pu_status === 'menunggu_validasi_awal'); @endphp
                        <fieldset {{ $isPu1Active ? '' : 'disabled' }}>
                            <div class="verify-card" style="border-color: var(--clr-blue); background: #FAFDFE; margin-bottom:0;">
                                <h3 class="verify-title">🏢 Panel Validasi Permohonan Awal — Dinas PUTR</h3>
                                <form action="{{ route('berusaha.verify', $application->id) }}" method="POST">
                                    @csrf
                                    <div class="form-group-v">
                                        <label for="action">Hasil Validasi Permohonan</label>
                                        <select name="action" id="action" class="form-select-v" required>
                                            <option value="approve" {{ in_array($application->dinas_pu_status, ['validasi_awal_diterima', 'sesuai', 'belum_sesuai', 'menunggu_penilaian']) ? 'selected' : '' }}>Disetujui</option>
                                            <option value="reject" {{ $application->dinas_pu_status === 'validasi_awal_ditolak' ? 'selected' : '' }}>Tidak Disetujui</option>
                                        </select>
                                    </div>
                                    <div class="form-group-v">
                                        <label for="notes">Catatan Hasil Validasi</label>
                                        <textarea name="notes" id="notes" class="form-control-v" rows="3" placeholder="Masukkan detail alasan/catatan validasi awal..." required>{{ $application->dinas_pu_status !== 'menunggu_validasi_awal' ? $application->dinas_pu_notes : '' }}</textarea>
                                    </div>
                                    @if($isPu1Active)
                                        <button type="submit" class="btn-submit-v">Kirim Validasi Awal</button>
                                    @else
                                        <div style="margin-top:12px; font-size:12.5px; color:#c53030; font-weight: 700;">(Tahap ini belum aktif / bukan wewenang Anda / sudah diselesaikan)</div>
                                    @endif
                                </form>
                            </div>
                        </fieldset>
                    </div>

                    <!-- TAHAP B: Penilaian PKKPR oleh Dinas PU (Stage 8) -->
                    <div id="panel-pu-2" class="bpn-panel-step" style="display: {{ $user->isDinasPu() && $application->status === 'menunggu_dinas_pu' && $application->bpn_pertek_document ? 'block' : 'none' }};">
                        @php $isPu2Active = ($user->isDinasPu() && $application->status === 'menunggu_dinas_pu' && $application->bpn_pertek_document); @endphp
                        <fieldset {{ $isPu2Active ? '' : 'disabled' }}>
                            <div class="verify-card" style="margin-bottom:0;">
                                <h3 class="verify-title">⚙️ Panel Penilaian PKKPR — Dinas Pekerjaan Umum (PU)</h3>
                                <form action="{{ route('berusaha.verify', $application->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group-v">
                                        <label for="action">Penilaian Kepatuhan Tata Ruang</label>
                                        <select name="action" id="action" class="form-select-v" required>
                                            <option value="sesuai" {{ $application->dinas_pu_status === 'sesuai' ? 'selected' : '' }}>Sesuai Tata Ruang (Lanjut ke Dinas Satu Pintu / PTSP)</option>
                                            <option value="belum_sesuai" {{ $application->dinas_pu_status === 'belum_sesuai' ? 'selected' : '' }}>Belum Sesuai Tata Ruang (Kembali ke BPN)</option>
                                        </select>
                                    </div>
                                    <div class="form-grid-2" style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                                        <div class="form-group-v">
                                            <label for="dinas_pu_tanggal_penilaian">Tanggal Penilaian (Wajib)</label>
                                            <input type="date" name="dinas_pu_tanggal_penilaian" id="dinas_pu_tanggal_penilaian" class="form-control-v" value="{{ $application->dinas_pu_tanggal_penilaian ? $application->dinas_pu_tanggal_penilaian->format('Y-m-d') : '' }}" required>
                                        </div>
                                        @if($application->dinas_pu_document)
                                            <div class="form-group-v">
                                                <label for="dinas_pu_document">Dokumen Penilaian Tata Ruang (PDF)</label>
                                                <a href="{{ asset('storage/' . $application->dinas_pu_document) }}" target="_blank" style="color:#218AC9; text-decoration:underline; display:block;">Lihat Dokumen Terunggah</a>
                                            </div>
                                        @else
                                            <div class="form-group-v">
                                                <label for="dinas_pu_document">Dokumen Penilaian Tata Ruang (PDF, Opsional)</label>
                                                <input type="file" name="dinas_pu_document" id="dinas_pu_document" class="form-control-v" accept=".pdf">
                                                <span style="font-size: 11px; color: var(--clr-muted);">*File yang diunggah hanya dapat diakses oleh BPN.</span>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group-v">
                                        <label for="notes">Catatan Kajian Penilaian Tata Ruang (Opsional)</label>
                                        <textarea name="notes" id="notes" class="form-control-v" rows="3" placeholder="Masukkan catatan tambahan justifikasi kesesuaian pemanfaatan ruang...">{{ $application->dinas_pu_status === 'sesuai' || $application->dinas_pu_status === 'belum_sesuai' ? $application->dinas_pu_notes : '' }}</textarea>
                                    </div>
                                    @if($isPu2Active)
                                        <button type="submit" class="btn-submit-v">Kirim Penilaian PU</button>
                                    @else
                                        <div style="margin-top:12px; font-size:12.5px; color:#c53030; font-weight: 700;">(Tahap ini belum aktif / bukan wewenang Anda / sudah diselesaikan)</div>
                                    @endif
                                </form>
                            </div>
                        </fieldset>
                    </div>

"""

s_idx = content.find(start_pu)
e_idx = content.find(end_pu, s_idx)
content = content[:s_idx] + pu_replacement + content[e_idx:]


# Replace Satu Pintu Panel
start_sp = "            <!-- 3. DINAS SATU PINTU (PTSP) PANEL -->"
end_sp = "            <!-- 4. PELAKU USAHA ACTION:"

sp_replacement = """            <!-- 3. DINAS SATU PINTU (PTSP) PANEL -->
                <div id="panel-satu-pintu" class="bpn-panel-step" style="display: {{ $user->isSatuPintu() && $application->status === 'menunggu_satu_pintu' ? 'block' : 'none' }};">
                    @php $isSpActive = ($user->isSatuPintu() && $application->status === 'menunggu_satu_pintu'); @endphp
                    <fieldset {{ $isSpActive ? '' : 'disabled' }}>
                        <div class="verify-card" style="margin-bottom:0;">
                            <h3 class="verify-title">🏛️ Panel Penerbitan Dokumen Akhir — Dinas Satu Pintu (PTSP)</h3>
                            <form action="{{ route('berusaha.verify', $application->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-grid-2">
                                    <div class="form-group-v">
                                        <label for="satu_pintu_no_pkkpr">Nomor PKKPR Berusaha</label>
                                        <input type="text" name="satu_pintu_no_pkkpr" id="satu_pintu_no_pkkpr" class="form-control-v" placeholder="cth: 503/PKKPR-B/2026/XYZ" value="{{ $application->satu_pintu_no_pkkpr }}" required>
                                    </div>
                                    <div class="form-group-v">
                                        <label for="satu_pintu_tanggal_terbit">Tanggal Terbit</label>
                                        <input type="date" name="satu_pintu_tanggal_terbit" id="satu_pintu_tanggal_terbit" class="form-control-v" value="{{ $application->satu_pintu_tanggal_terbit ? $application->satu_pintu_tanggal_terbit->format('Y-m-d') : '' }}" required>
                                    </div>
                                </div>
                                @if($application->satu_pintu_document)
                                    <div class="form-group-v">
                                        <label for="satu_pintu_document">Dokumen Produk Akhir PKKPR (PDF)</label>
                                        <a href="{{ asset('storage/' . $application->satu_pintu_document) }}" target="_blank" style="color:#218AC9; text-decoration:underline; display:block;">Lihat Dokumen Terunggah</a>
                                    </div>
                                @else
                                    <div class="form-group-v">
                                        <label for="satu_pintu_document">Dokumen Produk Akhir PKKPR (PDF)</label>
                                        <input type="file" name="satu_pintu_document" id="satu_pintu_document" class="form-control-v" accept=".pdf" required>
                                        <span style="font-size: 11px; color: var(--clr-muted);">*Wajib mengunggah Dokumen Pertek Pertanahan/SK PKKPR Berusaha hasil akhir. Maksimal 10MB.</span>
                                    </div>
                                @endif
                                <div class="form-group-v">
                                    <label for="notes">Catatan Tambahan (Opsional)</label>
                                    <textarea name="notes" id="notes" class="form-control-v" rows="2" placeholder="Masukkan keterangan tambahan jika ada...">{{ $application->status === 'disetujui' ? $application->satu_pintu_notes : '' }}</textarea>
                                </div>
                                @if($isSpActive)
                                    <button type="submit" class="btn-submit-v">
                                        <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 2L11 13M22 2l-7 20-4-9-9-4 20-7z"/></svg>
                                        Kirim & Tuntaskan Permohonan
                                    </button>
                                @else
                                    <div style="margin-top:12px; font-size:12.5px; color:#c53030; font-weight: 700;">(Tahap ini belum aktif / bukan wewenang Anda / sudah diselesaikan)</div>
                                @endif
                            </form>
                        </div>
                    </fieldset>
                </div>

"""

s_idx = content.find(start_sp)
e_idx = content.find(end_sp, s_idx)
content = content[:s_idx] + sp_replacement + content[e_idx:]

# Remove the @if($user->isBpn() && ...) wrapping the BPN panel
# Actually, the BPN panel isn't wrapped in the if anymore because we want everyone to see it?
# Wait! In my previous script, I left `@if($user->isBpn() && $application->status === 'menunggu_bpn')` at line 768!
# Let's see the current file content for BPN panel wrap.
