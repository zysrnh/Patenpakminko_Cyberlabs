import re

with open(r'd:\Gawe\Patenpakminko_Cyberlabs\Patenpakminko\resources\views\non-berusaha\show.blade.php', 'r', encoding='utf-8') as f:
    nb_content = f.read()

with open(r'd:\Gawe\Patenpakminko_Cyberlabs\Patenpakminko\resources\views\tanah-timbul\show.blade.php', 'r', encoding='utf-8') as f:
    tt_content = f.read()

# Replace <style> block
style_match = re.search(r'<style>.*?</style>', nb_content, re.DOTALL)
if style_match:
    tt_content = re.sub(r'<style>.*?</style>', style_match.group(0), tt_content, flags=re.DOTALL)

# Replace <div class="grid-layout">
tt_content = tt_content.replace('<div class="grid-layout">', '<div class="layout-grid">')

# Re-implement Left: Application Details using detail-list instead of data-list
# We will do this via a regex finding the container
old_left_section = re.search(r'<div class="card">\s*<h2 class="card-title">Informasi Identitas Pemohon / Pengguna Layanan</h2>\s*<div class="data-list">.*?</div>\s*</div>\s*<!-- Dokumen Lampiran -->', tt_content, re.DOTALL)

new_left_section = r'''<div class="card">
                        <h2 class="card-title">Informasi Identitas Pemohon / Pengguna Layanan</h2>
                        <ul class="detail-list">
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
                            <li class="detail-item">
                                <span class="detail-label">Nama Pemohon / Pengguna Layanan</span>
                                <span class="detail-val">{{ $application->nama_pengaju }}</span>
                            </li>
                            <li class="detail-item">
                                <span class="detail-label">Status Pemohon (Sebagai Apa)</span>
                                <span class="detail-val">{{ $application->hubungan_pengaju }}</span>
                            </li>
                            <li class="detail-item">
                                <span class="detail-label">Akun Pemohon (Username)</span>
                                <span class="detail-val">PMH{{ str_pad($application->user->id ?? 0, 3, '0', STR_PAD_LEFT) }}</span>
                            </li>
                            <li class="detail-item">
                                <span class="detail-label">Nomor Telepon Gateway / HP</span>
                                <span class="detail-val mono">+{{ $application->user->phone_number }}</span>
                            </li>
                            <li class="detail-item">
                                <span class="detail-label">Tanggal Pengajuan Berkas</span>
                                <span class="detail-val">{{ $application->created_at->format('d-m-Y, H:i') }} WIB</span>
                            </li>
                            
                            <!-- BPN Info -->
                            <li class="detail-item">
                                <span class="detail-label">Kelayakan Berkas (BPN)</span>
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
                                <li class="detail-item">
                                    <span class="detail-label">Dokumen Pertek BPN</span>
                                    <span class="detail-val">
                                        <a href="{{ asset('storage/' . $application->bpn_pertek_document) }}" target="_blank" class="btn-doc">
                                            Unduh Surat Pertek
                                        </a>
                                    </span>
                                </li>
                            @endif

                            <!-- Satu Pintu Info -->
                            @if($application->satu_pintu_no_pkkpr)
                                <li class="detail-item">
                                    <span class="detail-label">Nomor PKKPR</span>
                                    <span class="detail-val">{{ $application->satu_pintu_no_pkkpr }}</span>
                                </li>
                            @endif

                            @if($application->approval_document)
                                <li class="detail-item">
                                    <span class="detail-label">Dokumen PKKPR Terbit</span>
                                    <span class="detail-val">
                                        <a href="{{ asset('storage/' . $application->approval_document) }}" target="_blank" class="btn-doc">
                                            Unduh Dokumen
                                        </a>
                                    </span>
                                </li>
                            @endif

                            <li class="detail-item" style="display: flex; flex-direction: column; gap: 8px;">
                                <span class="detail-label" style="border-bottom: 1px solid var(--clr-line); padding-bottom: 8px; margin-bottom: 4px;">Berkas Lampiran Persyaratan</span>
                                
                                @if($application->ptp_data)
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <span style="font-size: 13px; color: var(--clr-mid); font-weight: 500;">Formulir PTP</span>
                                    <a href="{{ route('tanah-timbul.ptp_pdf', $application->id) }}" target="_blank" class="btn-doc">Buka Berkas</a>
                                </div>
                                @endif
                                
                                @if($application->peta_lokasi)
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <span style="font-size: 13px; color: var(--clr-mid);">1. Peta Lokasi</span>
                                    <a href="{{ asset('storage/' . $application->peta_lokasi) }}" target="_blank" class="btn-doc">Buka Berkas</a>
                                </div>
                                @endif

                                @if($application->surat_kuasa)
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <span style="font-size: 13px; color: var(--clr-mid);">2. Surat Kuasa</span>
                                    <a href="{{ asset('storage/' . $application->surat_kuasa) }}" target="_blank" class="btn-doc">Buka Berkas</a>
                                </div>
                                @endif

                                @if($application->fc_ktp)
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <span style="font-size: 13px; color: var(--clr-mid);">3. FC KTP</span>
                                    <a href="{{ asset('storage/' . $application->fc_ktp) }}" target="_blank" class="btn-doc">Buka Berkas</a>
                                </div>
                                @endif

                                @if($application->fc_npwp)
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <span style="font-size: 13px; color: var(--clr-mid);">4. FC NPWP</span>
                                    <a href="{{ asset('storage/' . $application->fc_npwp) }}" target="_blank" class="btn-doc">Buka Berkas</a>
                                </div>
                                @endif

                                @if($application->fc_akta_pendirian)
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <span style="font-size: 13px; color: var(--clr-mid);">5. FC Akta Pendirian</span>
                                    <a href="{{ asset('storage/' . $application->fc_akta_pendirian) }}" target="_blank" class="btn-doc">Buka Berkas</a>
                                </div>
                                @endif

                                @if($application->rencana_penggunaan_tanah)
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <span style="font-size: 13px; color: var(--clr-mid);">6. Rencana Penggunaan Tanah</span>
                                    <a href="{{ asset('storage/' . $application->rencana_penggunaan_tanah) }}" target="_blank" class="btn-doc">Buka Berkas</a>
                                </div>
                                @endif

                                @if($application->nib)
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <span style="font-size: 13px; color: var(--clr-mid);">7. NIB</span>
                                    <a href="{{ asset('storage/' . $application->nib) }}" target="_blank" class="btn-doc">Buka Berkas</a>
                                </div>
                                @endif

                                @if($application->kbli)
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <span style="font-size: 13px; color: var(--clr-mid);">8. KBLI</span>
                                    <a href="{{ asset('storage/' . $application->kbli) }}" target="_blank" class="btn-doc">Buka Berkas</a>
                                </div>
                                @endif

                                @if($application->proposal_kegiatan)
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <span style="font-size: 13px; color: var(--clr-mid);">9. Proposal Kegiatan</span>
                                    <a href="{{ asset('storage/' . $application->proposal_kegiatan) }}" target="_blank" class="btn-doc">Buka Berkas</a>
                                </div>
                                @endif

                                @if($application->persyaratan_lainnya)
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <span style="font-size: 13px; color: var(--clr-mid);">10. Persyaratan Lainnya</span>
                                    <a href="{{ asset('storage/' . $application->persyaratan_lainnya) }}" target="_blank" class="btn-doc">Buka Berkas</a>
                                </div>
                                @endif
                            </li>
                        </ul>
                    </div>
                    <!-- Dokumen Lampiran -->'''

if old_left_section:
    tt_content = tt_content.replace(old_left_section.group(0), new_left_section)

# We also need to fix the SLA banner for Tanah Timbul which still uses the old style.
# The new SLA banner uses sla-item with inline style vs sla-banner flex.
# I will fetch the SLA banner from non_berusaha.
# Wait, Tanah Timbul might have different SLA steps?
# Let's see: In Tanah Timbul, we might need to just let the script update the layout class and we manually do the SLA banner, but actually in Tanah Timbul it says:
# "Total Durasi Proses", "Status Berkas", "Durasi Tersisa". It has 3 items.

# Finally, write the updated content
with open(r'd:\Gawe\Patenpakminko_Cyberlabs\Patenpakminko\resources\views\tanah-timbul\show.blade.php', 'w', encoding='utf-8') as f:
    f.write(tt_content)
