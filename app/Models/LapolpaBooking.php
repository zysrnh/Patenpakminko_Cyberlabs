<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
 
class LapolpaBooking extends Model
{
    use HasFactory;
 
    protected $fillable = [
        'user_id',
        'nama_pemohon',
        'whatsapp_number',
        'booking_date',
        'time_start',
        'time_end',
        'status',
        'admin_note',
    ];
 
    protected $casts = [
        'booking_date' => 'date',
    ];
 
    /**
     * Relasi ke model User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
 
    /**
     * Format label tanggal indonesia.
     */
    public function getFormattedDateAttribute()
    {
        return $this->booking_date ? Carbon::parse($this->booking_date)->locale('id')->translatedFormat('l, d F Y') : '-';
    }
 
    /**
     * Format rentang waktu.
     */
    public function getFormattedTimeRangeAttribute()
    {
        if ($this->time_start && $this->time_end) {
            $start = substr($this->time_start, 0, 5);
            $end = substr($this->time_end, 0, 5);
            return "{$start} - {$end} WIB";
        }
        return '-';
    }
 
    /**
     * Badge status warna.
     */
    public function getStatusColorAttribute()
    {
        switch ($this->status) {
            case 'booked':
                return '#3182CE'; // Blue
            case 'diterima':
                return '#D69E2E'; // Yellow/Gold
            case 'selesai':
                return '#38A169'; // Green
            case 'dibatalkan':
                return '#E53E3E'; // Red
            default:
                return '#718096';
        }
    }
 
    /**
     * Badge status label.
     */
    public function getStatusLabelAttribute()
    {
        switch ($this->status) {
            case 'booked':
                return 'Terjadwal (Booked)';
            case 'diterima':
                return 'Disetujui';
            case 'selesai':
                return 'Selesai';
            case 'dibatalkan':
                return 'Dibatalkan';
            default:
                return ucfirst($this->status);
        }
    }
}
