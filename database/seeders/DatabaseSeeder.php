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

        // 2. BPN (3 Akun)
        for ($i = 1; $i <= 3; $i++) {
            User::factory()->create([
                'username' => 'bpn' . $i,
                'name' => 'Petugas BPN ' . $i,
                'email' => 'bpn' . $i . '@patenpakmiko.go.id',
                'password' => bcrypt('Paten_bpn' . $i . '@2026'),
                'role' => 'bpn',
                'phone_number' => '08123456789' . $i,
            ]);
        }

        // 3. Dinas PU (3 Akun)
        for ($i = 1; $i <= 3; $i++) {
            User::factory()->create([
                'username' => 'pu' . $i,
                'name' => 'Verifikator Dinas PU ' . $i,
                'email' => 'pu' . $i . '@patenpakmiko.go.id',
                'password' => bcrypt('Paten_pu' . $i . '@2026'),
                'role' => 'dinas_pu',
                'phone_number' => '08223456789' . $i,
            ]);
        }

        // 4. Dinas 1 Pintu (3 Akun)
        for ($i = 1; $i <= 3; $i++) {
            User::factory()->create([
                'username' => 'satupintu' . $i,
                'name' => 'Petugas Satu Pintu ' . $i,
                'email' => 'satupintu' . $i . '@patenpakmiko.go.id',
                'password' => bcrypt('Paten_satupintu' . $i . '@2026'),
                'role' => 'satu_pintu',
                'phone_number' => '08323456789' . $i,
            ]);
        }

        // 5. DPN / Super Admin (3 Akun)
        for ($i = 1; $i <= 3; $i++) {
            User::factory()->create([
                'username' => 'dpn' . $i,
                'name' => 'Super Admin DPN ' . $i,
                'email' => 'dpn' . $i . '@patenpakmiko.go.id',
                'password' => bcrypt('Paten_dpn' . $i . '@2026'),
                'role' => 'dpn',
                'phone_number' => '08423456789' . $i,
            ]);
        }

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
