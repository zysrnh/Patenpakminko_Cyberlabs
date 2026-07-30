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
                'email' => 'superadmin@patenpakmiko.go.id',
                'password' => bcrypt('Paten_superadmin@2026'),
                'role' => 'dpn',
                'phone_number' => '085555555599',
                'is_active' => true,
            ]
        );
    }
}
