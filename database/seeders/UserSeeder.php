<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds for regular admin & users.
     */
    public function run(): void
    {
        $defaultPassword = env('SEED_DEFAULT_PASSWORD', 'local-dev-password');

        // 1. Pelaku Usaha (PU)
        User::updateOrCreate(
            ['username' => 'pelaku_usaha'],
            [
                'name' => 'Budi Pelaku Usaha',
                'email' => 'pu@patenpakmiko.go.id',
                'password' => bcrypt(env('SEED_PU_PASSWORD', $defaultPassword)),
                'role' => 'pelaku_usaha',
                'phone_number' => '081234567890',
            ]
        );

        // 2. BPN (Admin 1)
        User::updateOrCreate(
            ['username' => 'bpn1'],
            [
                'name' => 'Petugas BPN',
                'email' => 'bpn@patenpakmiko.go.id',
                'password' => bcrypt(env('SEED_BPN_PASSWORD', $defaultPassword)),
                'role' => 'bpn',
                'phone_number' => '081111111111',
            ]
        );

        // 3. Dinas PU (Admin 2)
        User::updateOrCreate(
            ['username' => 'pu1'],
            [
                'name' => 'Verifikator Dinas PU',
                'email' => 'dinas_pu@patenpakmiko.go.id',
                'password' => bcrypt(env('SEED_DINAS_PU_PASSWORD', $defaultPassword)),
                'role' => 'dinas_pu',
                'phone_number' => '082222222222',
            ]
        );

        // 4. Dinas 1 Pintu / PTSP (Admin 3)
        User::updateOrCreate(
            ['username' => 'satupintu1'],
            [
                'name' => 'Petugas Satu Pintu',
                'email' => 'satupintu@patenpakmiko.go.id',
                'password' => bcrypt(env('SEED_SATUPINTU_PASSWORD', $defaultPassword)),
                'role' => 'satu_pintu',
                'phone_number' => '083333333333',
            ]
        );

        // 5. Dinas PUTR (Admin 4)
        User::updateOrCreate(
            ['username' => 'putr1'],
            [
                'name' => 'Verifikator Dinas PUTR',
                'email' => 'putr@patenpakmiko.go.id',
                'password' => bcrypt(env('SEED_PUTR_PASSWORD', $defaultPassword)),
                'role' => 'dinas_putr',
                'phone_number' => '084444444444',
            ]
        );

        // 6. Admin Berita (1 Akun)
        User::updateOrCreate(
            ['username' => 'admin_berita'],
            [
                'name' => 'Admin Berita',
                'email' => 'berita@patenpakmiko.go.id',
                'password' => bcrypt(env('SEED_BERITA_PASSWORD', $defaultPassword)),
                'role' => 'admin_berita',
                'phone_number' => '085234567891',
            ]
        );
    }
}
