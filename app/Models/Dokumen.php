<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    use HasFactory;

    protected $table = 'dokumens';

    protected $fillable = [
        'user_id',
        'nama_dokumen',
        'kategori',
        'file_path',
        'tipe_file',
        'ukuran_file',
        'keterangan'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
