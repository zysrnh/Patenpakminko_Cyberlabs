<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable([
    'user_id',
    'application_number',
    'applicant_name',
    'applicant_nik',
    'location_address',
    'land_size',
    'coordinates',
    'land_purpose',
    'status',
    'bpn_notes',
    'dinas_pu_notes',
    'satu_pintu_notes',
    'approval_document',
    'doc_ktp',
    'doc_sertifikat',
    'doc_pernyataan',
    'doc_desain',
    'doc_foto_lapangan',
    'doc_pbb',
    'doc_surat_kuasa',
    'doc_akta_yayasan',
    'doc_rekomendasi_tetangga',
    'doc_pendukung'
])]
class PpkprApplication extends Model
{
    /**
     * Relasi ke User pembuat permohonan.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Label Status Manusiawi.
     */
    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'menunggu_bpn'        => 'Verifikasi Dokumen (BPN)',
            'menunggu_dinas_pu'   => 'Analisis Tata Ruang (Dinas PU)',
            'menunggu_satu_pintu' => 'Penerbitan Dokumen (Satu Pintu)',
            'disetujui'           => 'Permohonan Disetujui / Selesai',
            'ditolak'             => 'Permohonan Ditolak',
            default               => 'Draft / Baru',
        };
    }

    /**
     * Badge CSS Kelas warna status.
     */
    public function getStatusColorAttribute(): string
    {
        return match ($this->status) {
            'menunggu_bpn'        => '#ED8936', // Orange
            'menunggu_dinas_pu'   => '#3182CE', // Blue
            'menunggu_satu_pintu' => '#805AD5', // Purple
            'disetujui'           => '#38A169', // Green
            'ditolak'             => '#E53E3E', // Red
            default               => '#718096', // Grey
        };
    }
}
