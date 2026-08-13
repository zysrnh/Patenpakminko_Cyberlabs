<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable([
    'user_id',
    'application_number',
    'no_berkas',
    'nama_pemilik_usaha',
    'nama_pengaju',
    'hubungan_pengaju',
    'status',
    'bpn_notes',
    'putr_notes',
    'putr_validated_at',
    'credential_sent_at',
    'dinas_pu_notes',
    'dinas_pu_tanggal_penilaian',
    'dinas_pu_document',
    'satu_pintu_notes',
    'approval_document',
    'peta_lokasi',
    'surat_kuasa',
    'fc_ktp',
    'fc_npwp',
    'fc_akta_pendirian',
    'rencana_penggunaan_tanah',
    'persyaratan_lainnya',
    'bpn_berkas_status',
    'bpn_cek_lokasi_date',
    'bpn_cek_lokasi_dt',
    'bpn_cek_lokasi_cp',
    'bpn_rapat_date',
    'bpn_rapat_dt',
    'bpn_pertek_document',
    'bpn_pertek_uploaded_at',
    'souvenir_sent_at',
    'nib',
    'kbli',
    'proposal_kegiatan',
    'ptp_data',
    'satu_pintu_no_pkkpr',
    'satu_pintu_tanggal_terbit',
    'tgl_mulai_layanan',
    'tgl_selesai_layanan',
])]
class PpkprApplication extends Model
{
    protected $casts = [
        'bpn_cek_lokasi_dt'          => 'datetime',
        'bpn_rapat_dt'               => 'datetime',
        'bpn_pertek_uploaded_at'     => 'datetime',
        'souvenir_sent_at'           => 'datetime',
        'satu_pintu_tanggal_terbit'  => 'date',
        'dinas_pu_tanggal_penilaian' => 'date',
        'putr_validated_at'          => 'datetime',
        'credential_sent_at'         => 'datetime',
        'tgl_mulai_layanan'          => 'datetime',
        'tgl_selesai_layanan'        => 'datetime',
    ];
    use \App\Traits\HasApplicationStatus;

    /**
     * Relasi ke User pembuat permohonan.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
