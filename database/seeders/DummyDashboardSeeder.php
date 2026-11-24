<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class DummyDashboardSeeder extends Seeder
{
    /**
     * Buat file PDF dan gambar PNG sampel valid di storage/app/public/samples
     * agar tombol Preview dan Buka Tab Baru di halaman detail langsung berfungsi.
     */
    private function ensureSampleFiles(): void
    {
        $disk = Storage::disk('public');
        $disk->makeDirectory('samples');

        $pdfs = [
            'samples/identitas-pemohon.pdf' => [
                'DOKUMEN CONTOH - IDENTITAS PEMOHON',
                'Salinan KTP Elektronik & NPWP Pemohon Layanan Pertimbangan Teknis Pertanahan',
                'PATEN PAK MIKO - Kantor Pertanahan Kota Sukabumi',
            ],
            'samples/surat-kuasa.pdf' => [
                'DOKUMEN CONTOH - SURAT KUASA PERMOHONAN',
                'Surat Kuasa Penunjukan Perwakilan Pengurusan PKKPR / Pertek',
                'Status: Berkas Persyaratan Valid',
            ],
            'samples/akta-legalitas.pdf' => [
                'DOKUMEN CONTOH - AKTA PENDIRIAN & LEGALITAS USAHA',
                'Akta Pendirian Badan Usaha, NIB (OSS RBA), & Klasifikasi KBLI Terlampir',
                'Kantor Pertanahan Kota Sukabumi',
            ],
            'samples/rencana-proposal.pdf' => [
                'DOKUMEN CONTOH - RENCANA PENGGUNAAN TANAH & PROPOSAL',
                'Rencana Tapak, Luasan Lahan, dan Uraian Kegiatan Pemanfaatan Ruang',
                'Lokasi: Kota Sukabumi, Jawa Barat',
            ],
            'samples/sps-pnbp.pdf' => [
                'SURAT PERINTAH SETOR (SPS) PNBP - CONTOH',
                'Tagihan Penerimaan Negara Bukan Pajak (PNBP) Pertimbangan Teknis Pertanahan',
                'Status Pembayaran: Terverifikasi / Lunas',
            ],
            'samples/pertek-bpn.pdf' => [
                'PERTIMBANGAN TEKNIS PERTANAHAN (PERTEK) - CONTOH',
                'Dokumen Resmi Rekomendasi Teknis Kantor Pertanahan Kota Sukabumi',
                'Berdasarkan Hasil Peninjauan Lapangan & Rapat Pembahasan Teknis',
            ],
            'samples/pkkpr-final.pdf' => [
                'DOKUMEN PERSETUJUAN PKKPR FINAL - CONTOH',
                'Kesesuaian Kegiatan Pemanfaatan Ruang (PKKPR) Terbit Lengkap',
                'DPMPTSP & Kantor Pertanahan Kota Sukabumi',
            ],
        ];

        foreach ($pdfs as $relPath => $lines) {
            $disk->put($relPath, $this->buildSimplePdf($lines));
        }

        // Gambar sketsa peta lokasi (PNG valid)
        $disk->put('samples/sketsa-lokasi.png', $this->buildSampleMapPng());
    }

    /**
     * Generator PDF minimal valid (PDF 1.4, font Helvetica) tanpa dependency eksternal.
     */
    private function buildSimplePdf(array $lines): string
    {
        $escape = static fn (string $s): string => str_replace(['\\', '(', ')'], ['\\\\', '\\(', '\\)'], $s);

        $streamLines = ["BT", "/F1 15 Tf", "50 750 Td", "(" . $escape($lines[0] ?? 'DOKUMEN CONTOH') . ") Tj"];
        $streamLines[] = "/F2 11 Tf";
        $y = 720;
        for ($i = 1; $i < count($lines); $i++) {
            $streamLines[] = "0 -26 Td";
            $streamLines[] = "(" . $escape($lines[$i]) . ") Tj";
            $y -= 26;
        }
        $streamLines[] = "0 -34 Td";
        $streamLines[] = "(Dokumen ini adalah berkas sampel lokal untuk pengujian preview petugas PATEN PAK MIKO.) Tj";
        $streamLines[] = "ET";

        $stream = implode("\n", $streamLines);

        $objects = [
            1 => "1 0 obj\n<< /Type /Catalog /Pages 2 0 R >>\nendobj\n",
            2 => "2 0 obj\n<< /Type /Pages /Kids [3 0 R] /Count 1 >>\nendobj\n",
            3 => "3 0 obj\n<< /Type /Page /Parent 2 0 R /MediaBox [0 0 595 842] /Contents 4 0 R /Resources << /Font << /F1 5 0 R /F2 6 0 R >> >> >>\nendobj\n",
            4 => "4 0 obj\n<< /Length " . strlen($stream) . " >>\nstream\n{$stream}\nendstream\nendobj\n",
            5 => "5 0 obj\n<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica-Bold >>\nendobj\n",
            6 => "6 0 obj\n<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica >>\nendobj\n",
        ];

        $pdf = "%PDF-1.4\n";
        $offsets = [0 => 0];
        foreach ($objects as $num => $body) {
            $offsets[$num] = strlen($pdf);
            $pdf .= $body;
        }
        $xrefOffset = strlen($pdf);
        $pdf .= "xref\n0 " . (count($objects) + 1) . "\n";
        $pdf .= "0000000000 65535 f \n";
        for ($i = 1; $i <= count($objects); $i++) {
            $pdf .= sprintf("%010d 00000 n \n", $offsets[$i]);
        }
        $pdf .= "trailer\n<< /Size " . (count($objects) + 1) . " /Root 1 0 R >>\nstartxref\n{$xrefOffset}\n%%EOF\n";

        return $pdf;
    }

    /**
     * Generator PNG sketsa bidang tanah sederhana untuk preview gambar peta lokasi.
     */
    private function buildSampleMapPng(): string
    {
        if (function_exists('imagecreatetruecolor')) {
            $im = imagecreatetruecolor(800, 500);
            $bg = imagecolorallocate($im, 241, 245, 249);
            $grid = imagecolorallocate($im, 214, 228, 239);
            $navy = imagecolorallocate($im, 0, 59, 100);
            $blue = imagecolorallocate($im, 33, 138, 201);
            $green = imagecolorallocate($im, 22, 163, 74);
            $fill = imagecolorallocate($im, 227, 240, 249);
            $white = imagecolorallocate($im, 255, 255, 255);

            imagefilledrectangle($im, 0, 0, 800, 500, $bg);
            for ($x = 0; $x <= 800; $x += 40) {
                imageline($im, $x, 0, $x, 500, $grid);
            }
            for ($y = 0; $y <= 500; $y += 40) {
                imageline($im, 0, $y, 800, $y, $grid);
            }
            imagefilledrectangle($im, 0, 0, 800, 52, $navy);
            imagestring($im, 5, 24, 18, 'SKETSA PETA LOKASI BIDANG TANAH (CONTOH) - PATEN PAK MIKO', $white);

            $pts = [180, 140, 560, 120, 620, 340, 220, 390];
            imagefilledpolygon($im, $pts, $fill);
            imagepolygon($im, $pts, $blue);
            imagefilledellipse($im, 400, 250, 18, 18, $green);
            imagestring($im, 4, 265, 245, 'Titik Koordinat: -6.9215, 106.9261', $navy);
            imagestring($im, 3, 24, 465, 'Kota Sukabumi | Dokumen Simulasi Verifikasi Petugas', $navy);

            ob_start();
            imagepng($im);
            $png = ob_get_clean();
            imagedestroy($im);
            if ($png !== false) {
                return $png;
            }
        }

        // Fallback 1x1 transparent PNG
        return base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII=');
    }

    /**
     * Kosongkan data transaksi lokal dan isi 500 data dummy permohonan + berkas contoh + ulasan + jadwal konsultasi.
     */
    public function run(): void
    {
        $this->ensureSampleFiles();

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
            $isPsn = $svc['table'] === 'psn_applications';
            $isBerusaha = $svc['table'] === 'ppkpr_berusaha_applications';

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

                $hasPertek = $status === 'disetujui' || in_array($status, ['menunggu_dinas_pu', 'menunggu_satu_pintu'], true);

                $row = [
                    'user_id'                   => $pelakuIds[array_rand($pelakuIds)],
                    'application_number'        => $appNumber,
                    'no_berkas'                 => $pembayaran === 'sudah_bayar' ? 'BRK-' . rand(10000, 99999) : null,
                    'nama_pemilik_usaha'        => $ownerName,
                    'nama_pengaju'              => $ownerName,
                    'hubungan_pengaju'          => $relations[array_rand($relations)],
                    'status'                    => $status,
                    'bpn_berkas_status'         => $berkas,
                    'bpn_pembayaran_status'     => $pembayaran,
                    'peta_lokasi'               => 'samples/sketsa-lokasi.png',
                    'surat_kuasa'               => 'samples/surat-kuasa.pdf',
                    'fc_ktp'                    => 'samples/identitas-pemohon.pdf',
                    'fc_npwp'                   => 'samples/identitas-pemohon.pdf',
                    'fc_akta_pendirian'         => 'samples/akta-legalitas.pdf',
                    'rencana_penggunaan_tanah'  => 'samples/rencana-proposal.pdf',
                    'proposal_kegiatan'         => 'samples/rencana-proposal.pdf',
                    'persyaratan_lainnya'       => $i % 2 === 0 ? 'samples/surat-kuasa.pdf' : null,
                    'bpn_sps_document'          => ($berkas === 'diterima') ? 'samples/sps-pnbp.pdf' : null,
                    'bpn_pertek_document'       => $hasPertek ? 'samples/pertek-bpn.pdf' : null,
                    'tgl_mulai_layanan'         => $pembayaran === 'sudah_bayar' ? $createdAt->copy()->addHours(2) : null,
                    'tgl_selesai_layanan'       => $status === 'disetujui' ? $createdAt->copy()->addDays(rand(3, 9)) : null,
                    'created_at'                => $createdAt,
                    'updated_at'                => $createdAt->copy()->addHours(rand(1, 48)),
                ];

                if (!$isPsn) {
                    $row['nib'] = 'samples/akta-legalitas.pdf';
                    $row['kbli'] = 'samples/akta-legalitas.pdf';
                }

                if ($isBerusaha) {
                    $row['satu_pintu_document'] = $status === 'disetujui' ? 'samples/pkkpr-final.pdf' : null;
                } else {
                    $row['approval_document'] = $status === 'disetujui' ? 'samples/pkkpr-final.pdf' : null;
                }

                $rows[] = $row;
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
