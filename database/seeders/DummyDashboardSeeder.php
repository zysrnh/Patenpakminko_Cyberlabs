<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DummyDashboardSeeder extends Seeder
{
    /**
     * Kosongkan data transaksi lokal dan isi 500 data dummy permohonan + ulasan + jadwal konsultasi.
     */
    public function run(): void
    {
        $pelakuIds = DB::table('users')
            ->where('role', 'pelaku_usaha')
            ->pluck('id')
            ->toArray();

        if (empty($pelakuIds)) {
            $pelakuIds = DB::table('users')->pluck('id')->toArray();
        }

        if (empty($pelakuIds)) {
            $this->command?->error('Tidak ada user di tabel users. Jalankan UserSeeder/NaooSUSeeder terlebih dahulu.');
            return;
        }

        $tablesToClear = [
            'ppkpr_applications',
            'ppkpr_berusaha_applications',
            'kebijakan_applications',
            'tanah_timbul_applications',
            'psn_applications',
            'reviews',
            'informal_ratings',
            'lapolpa_bookings',
        ];

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        foreach ($tablesToClear as $table) {
            DB::table($table)->truncate();
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $owners = [
            'PT Sinar Sukabumi Jaya', 'CV Mandiri Sejahtera', 'PT Bumi Agraria Nusantara',
            'CV Karya Pratama', 'PT Citra Properti Sukabumi', 'UD Sumber Makmur',
            'PT Lembah Hijau Lestari', 'CV Harmoni Tata Ruang', 'PT Mitra Industri Cikole',
            'Ahmad Fauzi', 'Siti Nurhaliza', 'Budi Santoso', 'Dewi Anggraini',
            'Rizky Ramadhan', 'Hendra Wijaya', 'Nadia Putri', 'Agus Setiawan',
            'Rina Marlina', 'Dedi Kurniawan', 'Yuniarti Kusuma',
        ];
        $relations = ['Pemilik Langsung', 'Kuasa Pemohon', 'Direktur Utama', 'Perwakilan Legal'];

        $serviceDistribution = [
            ['table' => 'ppkpr_berusaha_applications', 'prefix' => 'BERUSAHA',     'count' => 160],
            ['table' => 'ppkpr_applications',          'prefix' => 'NON-BERUSAHA', 'count' => 140],
            ['table' => 'kebijakan_applications',      'prefix' => 'KEBIJAKAN',    'count' => 85],
            ['table' => 'tanah_timbul_applications',   'prefix' => 'TANAH-TIMBUL', 'count' => 65],
            ['table' => 'psn_applications',            'prefix' => 'PSN',          'count' => 50],
        ];

        $now = Carbon::now();
        $appRefs = [];
        $seq = 1;

        foreach ($serviceDistribution as $svc) {
            $rows = [];
            for ($i = 0; $i < $svc['count']; $i++) {
                $createdAt = $now->copy()->subDays(rand(0, 175))->subHours(rand(0, 23))->subMinutes(rand(0, 59));
                $roll = rand(1, 100);

                if ($roll <= 44) {
                    $status = 'disetujui';
                    $pembayaran = 'sudah_bayar';
                    $berkas = 'diterima';
                } elseif ($roll <= 74) {
                    $pool = ['menunggu_bpn', 'menunggu_dinas_pu', 'menunggu_satu_pintu'];
                    $status = $pool[array_rand($pool)];
                    $pembayaran = 'sudah_bayar';
                    $berkas = 'diterima';
                } elseif ($roll <= 92) {
                    $status = 'menunggu_bpn';
                    $pembayaran = 'menunggu';
                    $berkas = rand(0, 1) ? 'diterima' : 'menunggu';
                } else {
                    $status = 'ditolak';
                    $pembayaran = 'sudah_bayar';
                    $berkas = 'ditolak';
                }

                $ownerName = $owners[array_rand($owners)];
                $appNumber = $svc['prefix'] . '-' . $createdAt->format('Ymd') . '-' . str_pad((string) $seq, 4, '0', STR_PAD_LEFT);
                $seq++;

                $rows[] = [
                    'user_id'               => $pelakuIds[array_rand($pelakuIds)],
                    'application_number'    => $appNumber,
                    'no_berkas'             => $pembayaran === 'sudah_bayar' ? 'BRK-' . rand(10000, 99999) : null,
                    'nama_pemilik_usaha'    => $ownerName,
                    'nama_pengaju'          => $ownerName,
                    'hubungan_pengaju'      => $relations[array_rand($relations)],
                    'status'                => $status,
                    'bpn_berkas_status'     => $berkas,
                    'bpn_pembayaran_status' => $pembayaran,
                    'tgl_mulai_layanan'     => $pembayaran === 'sudah_bayar' ? $createdAt->copy()->addHours(2) : null,
                    'tgl_selesai_layanan'   => $status === 'disetujui' ? $createdAt->copy()->addDays(rand(3, 9)) : null,
                    'created_at'            => $createdAt,
                    'updated_at'            => $createdAt->copy()->addHours(rand(1, 48)),
                ];
            }

            foreach (array_chunk($rows, 100) as $chunk) {
                DB::table($svc['table'])->insert($chunk);
            }

            $insertedIds = DB::table($svc['table'])->pluck('id')->toArray();
            $moduleKey = match ($svc['table']) {
                'ppkpr_berusaha_applications' => 'berusaha',
                'ppkpr_applications'          => 'non_berusaha',
                'kebijakan_applications'      => 'kebijakan',
                default                       => 'umum',
            };
            foreach ($insertedIds as $id) {
                $appRefs[] = ['type' => $moduleKey, 'id' => $id];
            }
        }

        // ─── Seed 80 Ulasan Layanan (reviews) ──────────────────────
        $ratingPool = array_merge(
            array_fill(0, 44, 5),
            array_fill(0, 22, 4),
            array_fill(0, 8, 3),
            array_fill(0, 4, 2),
            array_fill(0, 2, 1)
        );
        $ratingLabels = [
            5 => 'Sangat Memuaskan',
            4 => 'Memuaskan',
            3 => 'Cukup Baik',
            2 => 'Kurang Memuaskan',
            1 => 'Perlu Perbaikan',
        ];
        $comments = [
            'Pelayanan cepat dan berkas diproses sesuai estimasi waktu.',
            'Petugas sangat responsif membantu kelengkapan dokumen Pertek.',
            'Sistem tracking status berkas jelas dan mudah dipantau.',
            'Proses verifikasi awal lancar, info pembayaran transparan.',
            'Cukup baik, jadwal peninjauan lokasi tepat waktu.',
            'Alur pengajuan mudah dipahami oleh pemohon baru.',
        ];

        $reviewRows = [];
        $usedReviewKeys = [];
        $attempts = 0;
        while (count($reviewRows) < 80 && $attempts < 2000) {
            $attempts++;
            $ref = $appRefs[array_rand($appRefs)];
            $uid = $pelakuIds[array_rand($pelakuIds)];
            $comboKey = $uid . '-' . $ref['type'] . '-' . $ref['id'];
            if (isset($usedReviewKeys[$comboKey])) {
                continue;
            }
            $usedReviewKeys[$comboKey] = true;

            $rating = $ratingPool[array_rand($ratingPool)];
            $createdAt = $now->copy()->subDays(rand(0, 120))->subHours(rand(0, 23));

            $reviewRows[] = [
                'user_id'      => $uid,
                'module_type'  => $ref['type'],
                'module_id'    => $ref['id'],
                'rating'       => $rating,
                'rating_label' => $ratingLabels[$rating],
                'comment'      => $comments[array_rand($comments)],
                'is_approved'  => rand(1, 100) <= 82 ? 1 : 0,
                'created_at'   => $createdAt,
                'updated_at'   => $createdAt,
            ];
        }
        DB::table('reviews')->insert($reviewRows);

        // ─── Seed 40 Rating Peta INFORMAL (informal_ratings) ───────
        $informalTypes = ['LP2B', 'LBS', 'LSD'];
        $informalRows = [];
        for ($i = 0; $i < 40; $i++) {
            $rating = $ratingPool[array_rand($ratingPool)];
            $createdAt = $now->copy()->subDays(rand(0, 120))->subHours(rand(0, 23));

            $informalRows[] = [
                'user_id'       => $pelakuIds[array_rand($pelakuIds)],
                'name'          => $owners[array_rand($owners)],
                'informal_type' => $informalTypes[array_rand($informalTypes)],
                'latitude'      => -6.92 + (rand(-300, 300) / 10000),
                'longitude'     => 106.92 + (rand(-300, 300) / 10000),
                'rating'        => $rating,
                'comment'       => 'Data spasial layer peta informatif dan membantu pengecekan lahan.',
                'is_approved'   => rand(1, 100) <= 85 ? 1 : 0,
                'created_at'    => $createdAt,
                'updated_at'    => $createdAt,
            ];
        }
        DB::table('informal_ratings')->insert($informalRows);

        // ─── Seed 25 Jadwal Konsultasi (lapolpa_bookings) ──────────
        $slots = [
            ['09:00:00', '10:00:00'],
            ['10:30:00', '11:30:00'],
            ['13:30:00', '14:30:00'],
            ['15:00:00', '16:00:00'],
        ];
        $bookingRows = [];
        $shuffledUserIds = $pelakuIds;
        shuffle($shuffledUserIds);
        for ($i = 0; $i < 25; $i++) {
            $isUpcoming = $i < 15;
            $date = $isUpcoming
                ? $now->copy()->addDays(rand(1, 14))->format('Y-m-d')
                : $now->copy()->subDays(rand(1, 45))->format('Y-m-d');
            $slot = $slots[array_rand($slots)];
            $status = $isUpcoming ? (rand(0, 1) ? 'booked' : 'diterima') : 'selesai';
            $uid = $shuffledUserIds[$i] ?? null;

            $bookingRows[] = [
                'user_id'         => $uid,
                'nama_pemohon'    => $owners[array_rand($owners)],
                'whatsapp_number' => '0812' . rand(10000000, 99999999),
                'booking_date'    => $date,
                'time_start'      => $slot[0],
                'time_end'        => $slot[1],
                'status'          => $status,
                'admin_note'      => $isUpcoming ? 'Konsultasi teknis persyaratan Pertek.' : 'Konsultasi telah dilaksanakan.',
                'created_at'      => $now->copy()->subDays(rand(0, 10)),
                'updated_at'      => $now,
            ];
        }
        DB::table('lapolpa_bookings')->insert($bookingRows);
    }
}
