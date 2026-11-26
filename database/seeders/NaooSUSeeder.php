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
                'email' => env('SEED_NAOOSU_EMAIL', 'naoosu@patenpakmiko.go.id'),
                'password' => bcrypt(env('SEED_NAOOSU_PASSWORD', 'local-dev-password')),
                'role' => 'dpn',
                'phone_number' => env('SEED_NAOOSU_PHONE', '085555555599'),
            ]
        );
    }
}
