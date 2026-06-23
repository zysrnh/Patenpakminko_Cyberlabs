<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Holiday extends Model
{
    use HasFactory;

    protected $fillable = ['date', 'name', 'is_collective_leave'];
    protected $casts = ['date' => 'date', 'is_collective_leave' => 'boolean'];

    protected static function booted()
    {
        static::saved(function () {
            Cache::forget('indonesian_holidays');
        });

        static::deleted(function () {
            Cache::forget('indonesian_holidays');
        });
    }
}
