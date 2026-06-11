<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mailbox extends Model
{
    use HasFactory;

    protected $fillable = [
        'target_role',
        'target_user_id',
        'title',
        'message',
        'link',
        'is_read',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'target_user_id');
    }
}
