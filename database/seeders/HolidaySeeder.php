<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Holiday;

class HolidaySeeder extends Seeder
{
    public function run(): void
    {
        $holidays = [
            // Tahun 2024
            ['date' => '2024-01-01', 'name' => 'Tahun Baru Masehi', 'is_collective_leave' => false],
            ['date' => '2024-02-08', 'name' => 'Isra Mikraj', 'is_collective_leave' => false],
            ['date' => '2024-02-09', 'name' => 'Cuti Bersama Imlek', 'is_collective_leave' => true],
            ['date' => '2024-02-14', 'name' => 'Pemilu', 'is_collective_leave' => false],
            ['date' => '2024-03-11', 'name' => 'Hari Suci Nyepi', 'is_collective_leave' => false],
            ['date' => '2024-03-12', 'name' => 'Cuti Bersama Nyepi', 'is_collective_leave' => true],
            ['date' => '2024-03-29', 'name' => 'Wafat Isa Al Masih', 'is_collective_leave' => false],
            ['date' => '2024-04-08', 'name' => 'Cuti Bersama Idul Fitri', 'is_collective_leave' => true],
            ['date' => '2024-04-09', 'name' => 'Cuti Bersama Idul Fitri', 'is_collective_leave' => true],
            ['date' => '2024-04-10', 'name' => 'Hari Raya Idul Fitri', 'is_collective_leave' => false],
            ['date' => '2024-04-11', 'name' => 'Hari Raya Idul Fitri', 'is_collective_leave' => false],
            ['date' => '2024-04-12', 'name' => 'Cuti Bersama Idul Fitri', 'is_collective_leave' => true],
            ['date' => '2024-04-15', 'name' => 'Cuti Bersama Idul Fitri', 'is_collective_leave' => true],
            ['date' => '2024-05-01', 'name' => 'Hari Buruh Internasional', 'is_collective_leave' => false],
            ['date' => '2024-05-09', 'name' => 'Kenaikan Isa Al Masih', 'is_collective_leave' => false],
            ['date' => '2024-05-10', 'name' => 'Cuti Bersama Kenaikan Isa Al Masih', 'is_collective_leave' => true],
            ['date' => '2024-05-23', 'name' => 'Hari Raya Waisak', 'is_collective_leave' => false],
            ['date' => '2024-05-24', 'name' => 'Cuti Bersama Waisak', 'is_collective_leave' => true],
            ['date' => '2024-06-17', 'name' => 'Hari Raya Idul Adha', 'is_collective_leave' => false],
            ['date' => '2024-06-18', 'name' => 'Cuti Bersama Idul Adha', 'is_collective_leave' => true],
            ['date' => '2024-07-07', 'name' => 'Tahun Baru Islam', 'is_collective_leave' => false],
            ['date' => '2024-08-17', 'name' => 'Hari Kemerdekaan RI', 'is_collective_leave' => false],
            ['date' => '2024-09-16', 'name' => 'Maulid Nabi Muhammad SAW', 'is_collective_leave' => false],
            ['date' => '2024-12-25', 'name' => 'Hari Raya Natal', 'is_collective_leave' => false],
            ['date' => '2024-12-26', 'name' => 'Cuti Bersama Natal', 'is_collective_leave' => true],

            // Tahun 2026 (Estimasi Umum)
            ['date' => '2026-01-01', 'name' => 'Tahun Baru Masehi', 'is_collective_leave' => false],
            ['date' => '2026-02-17', 'name' => 'Isra Mikraj', 'is_collective_leave' => false],
            ['date' => '2026-03-03', 'name' => 'Hari Suci Nyepi', 'is_collective_leave' => false],
            ['date' => '2026-03-20', 'name' => 'Hari Raya Idul Fitri', 'is_collective_leave' => false],
            ['date' => '2026-03-21', 'name' => 'Hari Raya Idul Fitri', 'is_collective_leave' => false],
            ['date' => '2026-04-03', 'name' => 'Wafat Isa Al Masih', 'is_collective_leave' => false],
            ['date' => '2026-05-01', 'name' => 'Hari Buruh Internasional', 'is_collective_leave' => false],
            ['date' => '2026-05-14', 'name' => 'Kenaikan Isa Al Masih', 'is_collective_leave' => false],
            ['date' => '2026-05-24', 'name' => 'Hari Raya Waisak', 'is_collective_leave' => false],
            ['date' => '2026-05-27', 'name' => 'Hari Raya Idul Adha', 'is_collective_leave' => false],
            ['date' => '2026-06-16', 'name' => 'Tahun Baru Islam', 'is_collective_leave' => false],
            ['date' => '2026-08-17', 'name' => 'Hari Kemerdekaan RI', 'is_collective_leave' => false],
            ['date' => '2026-08-25', 'name' => 'Maulid Nabi Muhammad SAW', 'is_collective_leave' => false],
            ['date' => '2026-12-25', 'name' => 'Hari Raya Natal', 'is_collective_leave' => false],
        ];

        foreach ($holidays as $holiday) {
            Holiday::updateOrCreate(
                ['date' => $holiday['date']],
                ['name' => $holiday['name'], 'is_collective_leave' => $holiday['is_collective_leave']]
            );
        }
    }
}
