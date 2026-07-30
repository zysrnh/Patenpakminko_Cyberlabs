<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class NaooSUSeeder extends Seeder
{
    /**
     * Run the database seeds for Super Admin account: NaooSU.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['username' => 'NaooSU'],
            [
                'name' => 'NaooSU',
                'email' => 'naoosu@patenpakmiko.go.id',
                'password' => bcrypt('Paten_naoosu@2026'),
                'role' => 'dpn',
                'phone_number' => '085555555599',
            ]
        );
    }
}
