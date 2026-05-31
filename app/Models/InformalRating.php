<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class InformalRating extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'informal_type',
        'latitude',
        'longitude',
        'rating',
        'comment',
        'is_approved'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
