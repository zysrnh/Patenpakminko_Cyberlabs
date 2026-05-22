<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
class Review extends Model
{
    use HasFactory;
 
    protected $fillable = [
        'user_id',
        'module_type',
        'module_id',
        'rating',
        'rating_label',
        'comment',
        'is_approved',
    ];
 
    /**
     * Relasi ke model User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
 
    /**
     * Helper untuk menampilkan jenis modul yang diulas.
     */
    public function getModuleLabelAttribute()
    {
        switch ($this->module_type) {
            case 'non_berusaha':
                return 'PPKPR Non-Berusaha';
            case 'berusaha':
                return 'PPKPR Berusaha';
            case 'kebijakan':
                return 'Kebijakan Khusus';
            case 'lapolpa':
                return 'LAPOLPA (Layanan Pelaporan)';
            case 'umum':
                return 'Layanan Umum / Portal';
            default:
                return ucfirst($this->module_type);
        }
    }
 
    /**
     * Tampilan bintang ulasan.
     */
    public function getStarsDisplayAttribute()
    {
        return str_repeat('★', $this->rating) . str_repeat('☆', 5 - $this->rating);
    }
}
