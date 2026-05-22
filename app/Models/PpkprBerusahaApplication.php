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
    'bpn_berkas_status',
    'bpn_pembayaran_status',
    'bpn_cek_lokasi_date',
    'bpn_cek_lokasi_dt',
    'bpn_cek_lokasi_cp',
    'bpn_rapat_date',
    'bpn_rapat_dt',
    'bpn_pertek_document',
    'bpn_notes',
    'dinas_pu_status',
    'dinas_pu_notes',
    'satu_pintu_no_pkkpr',
    'satu_pintu_tanggal_terbit',
    'satu_pintu_document',
    'satu_pintu_notes',
    'doc_persyaratan',
])]
class PpkprBerusahaApplication extends Model
{
    protected $casts = [
        'bpn_cek_lokasi_dt' => 'datetime',
        'bpn_rapat_dt'      => 'datetime',
        'satu_pintu_tanggal_terbit' => 'date',
    ];
 
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
            'menunggu_bpn'        => 'Verifikasi Dokumen & Pembayaran (BPN)',
            'menunggu_dinas_pu'   => 'Penilaian Tata Ruang (Dinas PU)',
            'menunggu_satu_pintu' => 'Penerbitan Dokumen (Satu Pintu / PTSP)',
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
