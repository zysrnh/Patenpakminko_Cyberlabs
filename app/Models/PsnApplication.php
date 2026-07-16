<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable([
    'user_id',
    'application_number',
    'nama_pemilik_usaha',
    'nama_pengaju',
    'hubungan_pengaju',
    'status',
    'ptp_data',
    'bpn_notes',
    'dinas_pu_notes',
    'satu_pintu_notes',
    'approval_document',
    'peta_lokasi',
    'surat_kuasa',
    'fc_ktp',
    'fc_npwp',
    'fc_akta_pendirian',
    'rencana_penggunaan_tanah',
    'proposal_kegiatan',
    'persyaratan_lainnya',
    'bpn_berkas_status',
    'bpn_pembayaran_status',
    'bpn_berkas_approved_at',
    'bpn_pembayaran_approved_at',
    'bpn_rapat_approved_at',
    'bpn_cek_lokasi_date',
    'bpn_cek_lokasi_dt',
    'bpn_cek_lokasi_cp',
    'bpn_rapat_date',
    'bpn_rapat_dt',
    'bpn_pertek_document',
    'bpn_pertek_uploaded_at',
    'souvenir_sent_at',
    'dinas_pu_tanggal_penilaian',
    'dinas_pu_document',
    'satu_pintu_no_pkkpr',
    'satu_pintu_tanggal_terbit',
    'tgl_mulai_layanan',
    'tgl_selesai_layanan',
])]
class PsnApplication extends Model
{
    protected $table = 'psn_applications';

    protected $casts = [
        'bpn_cek_lokasi_dt'       => 'datetime',
        'bpn_rapat_dt'            => 'datetime',
        'bpn_pertek_uploaded_at'  => 'datetime',
        'souvenir_sent_at'        => 'datetime',
        'satu_pintu_tanggal_terbit' => 'date',
        'tgl_mulai_layanan'       => 'datetime',
        'tgl_selesai_layanan'     => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'menunggu_bpn'        => 'Verifikasi Dokumen (Kantor Pertanahan)',
            'menunggu_dinas_pu'   => 'Penilaian PKKPR (Dinas PUTR)',
            'menunggu_satu_pintu' => 'Penerbitan PKKPR (DPMPTSP)',
            'disetujui'           => 'Layanan Selesai',
            'ditolak'             => 'Permohonan Ditolak',
            default               => 'Draft / Baru',
        };
    }

    public function getStatusColorAttribute(): string
    {
        return match ($this->status) {
            'menunggu_bpn'        => '#ED8936',
            'menunggu_dinas_pu'   => '#3182CE',
            'menunggu_satu_pintu' => '#805AD5',
            'disetujui'           => '#38A169',
            'ditolak'             => '#E53E3E',
            default               => '#718096',
        };
    }
}
