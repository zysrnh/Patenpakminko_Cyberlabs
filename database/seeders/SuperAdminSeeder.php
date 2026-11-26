<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds for 1 Super Admin account only.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['username' => 'superadmin'],
            [
                'name' => 'Super Admin PATEN PAK MIKO',
                'email' => env('SEED_SUPERADMIN_EMAIL', 'superadmin@patenpakmiko.go.id'),
                'password' => bcrypt(env('SEED_SUPERADMIN_PASSWORD', 'local-dev-password')),
                'role' => 'dpn',
                'phone_number' => env('SEED_SUPERADMIN_PHONE', '085555555599'),
            ]
        );
    }
}
