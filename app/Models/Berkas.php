<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berkas extends Model
{
    use HasFactory;

    protected $table = 'berkas';

    protected $fillable = [
        'user_id',
        'nama_berkas',
        'kategori',
        'is_ptsp',
        'uploaded_by_role',
        'file_path',
        'tipe_file',
        'ukuran_file',
        'keterangan'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getNamaDokumenAttribute()
    {
        return $this->attributes['nama_berkas'] ?? '';
    }
}
