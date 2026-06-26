<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Pelaku Usaha (PU)
        User::factory()->create([
            'username' => 'pelaku_usaha',
            'name' => 'Budi Pelaku Usaha',
            'email' => 'pu@patenpakmiko.go.id',
            'password' => bcrypt('Paten_pu@2026'),
            'role' => 'pelaku_usaha',
            'phone_number' => '081234567890',
        ]);

        // 2. BPN (Admin 1)
        User::factory()->create([
            'username' => 'bpn1',
            'name' => 'Petugas BPN',
            'email' => 'bpn@patenpakmiko.go.id',
            'password' => bcrypt('Paten_bpn1@2026'),
            'role' => 'bpn',
            'phone_number' => '081111111111',
        ]);

        // 3. Dinas PU (Admin 2)
        User::factory()->create([
            'username' => 'pu1',
            'name' => 'Verifikator Dinas PU',
            'email' => 'pu@patenpakmiko.go.id',
            'password' => bcrypt('Paten_pu1@2026'),
            'role' => 'dinas_pu',
            'phone_number' => '082222222222',
        ]);

        // 4. Dinas 1 Pintu / PTSP (Admin 3)
        User::factory()->create([
            'username' => 'satupintu1',
            'name' => 'Petugas Satu Pintu',
            'email' => 'satupintu@patenpakmiko.go.id',
            'password' => bcrypt('Paten_satupintu1@2026'),
            'role' => 'satu_pintu',
            'phone_number' => '083333333333',
        ]);

        // 5. Dinas PUTR (Admin 4)
        User::factory()->create([
            'username' => 'putr1',
            'name' => 'Verifikator Dinas PUTR',
            'email' => 'putr@patenpakmiko.go.id',
            'password' => bcrypt('Paten_putr1@2026'),
            'role' => 'dinas_putr',
            'phone_number' => '084444444444',
        ]);

        // 6. DPN / Super Admin
        User::factory()->create([
            'username' => 'dpn1',
            'name' => 'Super Admin DPN',
            'email' => 'dpn@patenpakmiko.go.id',
            'password' => bcrypt('Paten_dpn1@2026'),
            'role' => 'dpn',
            'phone_number' => '085555555555',
        ]);

        // 6. Admin Berita (1 Akun)
        User::factory()->create([
            'username' => 'admin_berita',
            'name' => 'Admin Berita',
            'email' => 'berita@patenpakmiko.go.id',
            'password' => bcrypt('Paten_berita@2026'),
            'role' => 'admin_berita',
            'phone_number' => '085234567891',
        ]);
    }
}
