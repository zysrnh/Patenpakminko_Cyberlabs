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
            'username' => 'budi_pu',
            'name' => 'Budi Pelaku Usaha',
            'email' => 'pu@patenpakmiko.go.id',
            'password' => bcrypt('password'),
            'role' => 'pelaku_usaha',
            'phone_number' => '081234567890',
        ]);

        // 2. BPN
        User::factory()->create([
            'username' => 'petugas_bpn',
            'name' => 'Petugas BPN',
            'email' => 'bpn@patenpakmiko.go.id',
            'password' => bcrypt('password'),
            'role' => 'bpn',
            'phone_number' => '081234567891',
        ]);

        // 3. Dinas PU (Tata Ruang)
        User::factory()->create([
            'username' => 'verifikator_pu',
            'name' => 'Verifikator Dinas PU',
            'email' => 'pu_dinas@patenpakmiko.go.id',
            'password' => bcrypt('password'),
            'role' => 'dinas_pu',
            'phone_number' => '081234567892',
        ]);

        // 4. Dinas 1 Pintu (PTSP)
        User::factory()->create([
            'username' => 'petugas_satupintu',
            'name' => 'Petugas Satu Pintu',
            'email' => 'satupintu@patenpakmiko.go.id',
            'password' => bcrypt('password'),
            'role' => 'satu_pintu',
            'phone_number' => '081234567893',
        ]);

        // 5. DPN (Dashboard Penerima Notifikasi / Super Admin)
        User::factory()->create([
            'username' => 'admin_dpn',
            'name' => 'Super Admin DPN',
            'email' => 'dpn@patenpakmiko.go.id',
            'password' => bcrypt('password'),
            'role' => 'dpn',
            'phone_number' => '081234567894',
        ]);
    }
}
