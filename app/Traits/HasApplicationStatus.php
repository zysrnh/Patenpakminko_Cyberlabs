<?php

namespace App\Traits;

use Carbon\Carbon;

trait HasApplicationStatus
{
    /**
     * Label Status Manusiawi yang Sinkron dengan Linimasa Process Stepper.
     */
    public function getStatusLabelAttribute(): string
    {
        if ($this->status === 'ditolak') {
            return 'Permohonan Ditolak';
        }

        if (in_array($this->status, ['disetujui', 'terbit_pkpr'])) {
            return 'Layanan Selesai';
        }

        if ($this->status === 'menunggu_satu_pintu') {
            return 'Penerbitan Dokumen (DPMPTSP)';
        }

        if (in_array($this->status, ['menunggu_dinas_pu', 'menunggu_putr'])) {
            // Step 7: Pertek sudah terbit → PU sedang menilai PKKPR
            if (!empty($this->bpn_pertek_document)) {
                return 'Penilaian Tata Ruang (Dinas PUTR)';
            }
            // Step 6: Rapat sudah lewat → menunggu penerbitan Pertek BPN
            if (!empty($this->bpn_rapat_dt)) {
                return 'Penerbitan Pertek (Kantor Pertanahan)';
            }
            // Step 5: Cek lokasi sudah lewat → jadwal rapat
            if (!empty($this->bpn_cek_lokasi_dt)) {
                return 'Rapat Pembahasan (Kantor Pertanahan)';
            }
            // Step 4: Sudah bayar → BPN proses lapangan
            if (($this->bpn_pembayaran_status ?? '') === 'sudah_bayar') {
                return 'Peninjauan Lapangan (Kantor Pertanahan)';
            }
            // Step 2: Belum ada progres BPN → PU validasi awal
            return 'Validasi Permohonan (Dinas PUTR)';
        }

        if ($this->status === 'menunggu_bpn') {
            if (in_array($this->bpn_berkas_status, ['tidak_sesuai', 'ditolak'])) {
                return 'Berkas Tidak Sesuai (Perlu Perbaikan)';
            }

            if ($this->bpn_berkas_status === 'diterima' && ($this->bpn_pembayaran_status ?? 'menunggu') !== 'sudah_bayar') {
                return 'Menunggu Pembayaran (SPS / PNBP)';
            }

            if (($this->bpn_pembayaran_status ?? '') === 'sudah_bayar') {
                $now = Carbon::now();
                $cekLokasiLewat = $this->bpn_cek_lokasi_dt && $now >= Carbon::parse($this->bpn_cek_lokasi_dt);
                $rapatLewat = $this->bpn_rapat_dt && $now >= Carbon::parse($this->bpn_rapat_dt);

                if (!empty($this->bpn_pertek_document)) {
                    return 'Pertek Diterbitkan (Kantor Pertanahan)';
                }

                if ($rapatLewat) {
                    return 'Penerbitan Pertek (Kantor Pertanahan)';
                }

                if (!empty($this->bpn_rapat_dt)) {
                    return 'Rapat Pembahasan (Kantor Pertanahan)';
                }

                if ($cekLokasiLewat) {
                    return 'Rapat Pembahasan (Kantor Pertanahan)';
                }

                if (!empty($this->bpn_cek_lokasi_dt)) {
                    return 'Peninjauan Lapangan (Kantor Pertanahan)';
                }

                return 'Peninjauan Lapangan (Kantor Pertanahan)';
            }

            return 'Verifikasi Dokumen (Kantor Pertanahan)';
        }

        return 'Draft / Baru';
    }

    /**
     * Kode Warna Badge Status.
     */
    public function getStatusColorAttribute(): string
    {
        if ($this->status === 'ditolak') {
            return '#DC2626'; // Red
        }

        if (in_array($this->status, ['disetujui', 'terbit_pkpr'])) {
            return '#16A34A'; // Green
        }

        if ($this->status === 'menunggu_satu_pintu') {
            return '#805AD5'; // Purple
        }

        if (in_array($this->status, ['menunggu_dinas_pu', 'menunggu_putr'])) {
            return '#0284C7'; // Blue
        }

        if ($this->status === 'menunggu_bpn') {
            if (in_array($this->bpn_berkas_status, ['tidak_sesuai', 'ditolak'])) {
                return '#DC2626'; // Red
            }

            if ($this->bpn_berkas_status === 'diterima' && ($this->bpn_pembayaran_status ?? 'menunggu') !== 'sudah_bayar') {
                return '#D97706'; // Amber/Yellow
            }

            if (($this->bpn_pembayaran_status ?? '') === 'sudah_bayar') {
                return '#2563EB'; // Blue
            }

            return '#DD6B20'; // Orange
        }

        return '#64748B'; // Slate Grey
    }

    /**
     * Kategori Status untuk Filter Tabel & Statistik Dashboard.
     */
    public function getStatusCategoryAttribute(): string
    {
        if ($this->status === 'ditolak' || in_array($this->bpn_berkas_status, ['tidak_sesuai', 'ditolak'])) {
            return 'ditolak';
        }

        if (in_array($this->status, ['disetujui', 'terbit_pkpr'])) {
            return 'selesai';
        }

        if ($this->status === 'menunggu_bpn' && (($this->bpn_pembayaran_status ?? 'menunggu') !== 'sudah_bayar')) {
            return 'belum_bayar';
        }

        return 'diproses';
    }
}
