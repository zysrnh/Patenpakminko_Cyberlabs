<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['username', 'phone_number', 'password', 'role', 'name', 'email', 'address', 'business_name', 'business_role', 'profile_photo', 'is_active'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    // Helper functions to check roles
    public function isDpn(): bool
    {
        return $this->role === 'dpn';
    }

    public function isBpn(): bool
    {
        return $this->role === 'bpn';
    }

    public function isDinasPu(): bool
    {
        return $this->role === 'dinas_pu';
    }

    public function isDinasPutr(): bool
    {
        return $this->role === 'dinas_putr';
    }

    public function isSatuPintu(): bool
    {
        return $this->role === 'satu_pintu';
    }

    public function isPelakuUsaha(): bool
    {
        return $this->role === 'pelaku_usaha';
    }

    public function isAdminBerita(): bool
    {
        return $this->role === 'admin_berita';
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
