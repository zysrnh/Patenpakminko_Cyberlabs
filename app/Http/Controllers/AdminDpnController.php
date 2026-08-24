<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminDpnController extends Controller
{
    use \App\Traits\WaBlastHelper;

    private $filePath = 'visitor_stats.json';

    public function index()
    {
        $stats = [
            'count' => 0,
            'permohonan_diproses' => '',
            'rata_rata_penyelesaian' => '10 hari',
            'rating_override' => '',
        ];

        if (Storage::exists($this->filePath)) {
            $data = json_decode(Storage::get($this->filePath), true);
            if (is_array($data)) {
                $stats = array_merge($stats, $data);
            }
        }

        $count = $stats['count'];

        return view('admin_dpn.index', compact('stats', 'count'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'count' => 'required|integer|min:0',
            'permohonan_diproses' => 'nullable|string|max:50',
            'rata_rata_penyelesaian' => 'nullable|string|max:50',
            'rating_override' => 'nullable|string|max:20',
        ]);
        
        $permVal  = $request->input('permohonan_diproses');
        $penyVal  = $request->input('rata_rata_penyelesaian');
        $rateVal  = $request->input('rating_override');

        $stats = [
            'count'                  => (int) $request->count,
            'permohonan_diproses'    => $permVal ?? '',                                                          // kosong = auto hitung DB
            'rata_rata_penyelesaian' => ($penyVal !== null && $penyVal !== '') ? $penyVal : '10 hari',
            'rating_override'        => $rateVal ?? '',
        ];
        Storage::put($this->filePath, json_encode($stats));

        return redirect()->back()->with('success', 'Statistik website beranda berhasil diperbarui!');
    }

    public function resetVisitorCount()
    {
        $stats = [
            'count' => 0,
            'permohonan_diproses' => '',
            'rata_rata_penyelesaian' => '10 hari',
            'rating_override' => '',
        ];
        if (Storage::exists($this->filePath)) {
            $data = json_decode(Storage::get($this->filePath), true);
            if (is_array($data)) {
                $stats = array_merge($stats, $data);
            }
        }
        $stats['count'] = 0;
        Storage::put($this->filePath, json_encode($stats));

        return redirect()->back()->with('success', 'Jumlah kunjungan berhasil di-reset ke 0!');
    }

    public function markSouvenirSent($type, $id)
    {
        $models = [
            'ppkpr_non_berusaha' => \App\Models\PpkprApplication::class,
            'ppkpr_berusaha' => \App\Models\PpkprBerusahaApplication::class,
            'kebijakan_khusus' => \App\Models\KebijakanApplication::class,
            'psn' => \App\Models\PsnApplication::class,
            'tanah_timbul' => \App\Models\TanahTimbulApplication::class,
        ];

        if (!array_key_exists($type, $models)) {
            return redirect()->back()->with('error', 'Tipe permohonan tidak valid.');
        }

        $modelClass = $models[$type];
        $application = $modelClass::findOrFail($id);

        $application->souvenir_sent_at = now();
        $application->save();

        return redirect()->back()->with('success', 'Souvenir untuk permohonan ' . $application->application_number . ' berhasil ditandai sebagai terkirim.');
    }

    public function rollbackStatus($type, $id)
    {
        if (!\Illuminate\Support\Facades\Auth::user()->isDpn()) {
            abort(403, 'Hanya Super Admin (DPN) yang berwenang untuk melakukan rollback status.');
        }

        $models = [
            'ppkpr_non_berusaha' => \App\Models\PpkprApplication::class,
            'ppkpr_berusaha' => \App\Models\PpkprBerusahaApplication::class,
            'berusaha' => \App\Models\PpkprBerusahaApplication::class,
            'kebijakan_khusus' => \App\Models\KebijakanApplication::class,
            'psn' => \App\Models\PsnApplication::class,
            'tanah_timbul' => \App\Models\TanahTimbulApplication::class,
            'tanah-timbul' => \App\Models\TanahTimbulApplication::class,
        ];

        $redirectRoutes = [
            'ppkpr_non_berusaha' => 'non-berusaha.show',
            'ppkpr_berusaha' => 'berusaha.show',
            'berusaha' => 'berusaha.show',
            'kebijakan_khusus' => 'kebijakan.show',
            'psn' => 'psn.show',
            'tanah_timbul' => 'tanah-timbul.show',
            'tanah-timbul' => 'tanah-timbul.show',
        ];

        if (!array_key_exists($type, $models)) {
            return redirect()->back()->with('error', 'Tipe permohonan tidak valid.');
        }

        $modelClass = $models[$type];
        $application = $modelClass::findOrFail($id);

        $msg = '';

        if ($type === 'ppkpr_berusaha' || $type === 'berusaha') {
            if ($application->status === 'disetujui' || $application->status === 'ditolak') {
                if ($application->satu_pintu_no_pkkpr) {
                    $application->status = 'menunggu_satu_pintu';
                    $application->satu_pintu_no_pkkpr = null;
                    $application->satu_pintu_tanggal_terbit = null;
                    $application->satu_pintu_document = null;
                    $application->satu_pintu_notes = null;
                    $msg = 'Permohonan di-rollback ke tahap menunggu verifikasi Dinas Satu Pintu.';
                } elseif ($application->dinas_pu_tanggal_penilaian) {
                    $application->status = 'menunggu_dinas_pu';
                    $application->dinas_pu_status = 'menunggu_penilaian';
                    $application->dinas_pu_tanggal_penilaian = null;
                    $application->dinas_pu_document = null;
                    $application->dinas_pu_notes = null;
                    $msg = 'Permohonan di-rollback ke tahap menunggu penilaian Dinas PU.';
                } elseif ($application->dinas_pu_notes && $application->dinas_pu_status === 'validasi_awal_ditolak') {
                    $application->status = 'menunggu_dinas_pu';
                    $application->dinas_pu_status = 'menunggu_validasi_awal';
                    $application->dinas_pu_notes = null;
                    $msg = 'Permohonan di-rollback ke tahap menunggu validasi awal Dinas PUTR.';
                } else {
                    $application->status = 'menunggu_bpn';
                    if ($application->bpn_berkas_status === 'tidak_sesuai') {
                        $application->bpn_berkas_status = 'menunggu';
                    }
                    $msg = 'Permohonan di-rollback ke tahap pemeriksaan BPN.';
                }
            } elseif ($application->status === 'menunggu_satu_pintu') {
                $application->status = 'menunggu_dinas_pu';
                $application->dinas_pu_status = 'menunggu_penilaian';
                $application->dinas_pu_tanggal_penilaian = null;
                $application->dinas_pu_document = null;
                $application->dinas_pu_notes = null;
                $msg = 'Permohonan di-rollback ke tahap penilaian Dinas PU.';
            } elseif ($application->status === 'menunggu_dinas_pu') {
                if ($application->dinas_pu_status === 'menunggu_penilaian') {
                    $application->status = 'menunggu_bpn';
                    $application->bpn_pertek_document = null;
                    $application->bpn_pertek_uploaded_at = null;
                    $msg = 'Permohonan di-rollback ke tahap penerbitan Pertek BPN.';
                } elseif ($application->dinas_pu_status === 'menunggu_validasi_awal') {
                    $application->status = 'menunggu_bpn';
                    $application->bpn_berkas_status = 'menunggu';
                    $application->bpn_notes = null;
                    $msg = 'Permohonan di-rollback ke tahap verifikasi berkas awal BPN.';
                }
            } elseif ($application->status === 'menunggu_bpn') {
                if ($application->bpn_pembayaran_status === 'sudah_bayar') {
                    if ($application->bpn_rapat_dt) {
                        $application->bpn_rapat_dt = null;
                        $application->bpn_rapat_date = null;
                        $msg = 'Jadwal Rapat Pembahasan berhasil dihapus/direset.';
                    } elseif ($application->bpn_cek_lokasi_dt) {
                        $application->bpn_cek_lokasi_dt = null;
                        $application->bpn_cek_lokasi_date = null;
                        $application->bpn_cek_lokasi_cp = null;
                        $msg = 'Jadwal Cek Lokasi Lapangan berhasil dihapus/direset.';
                    } else {
                        $application->bpn_pembayaran_status = 'belum_bayar';
                        $application->no_berkas = null;
                        $msg = 'Konfirmasi pembayaran PNBP berhasil di-rollback/dibatalkan.';
                    }
                } else {
                    $application->status = 'menunggu_dinas_pu';
                    $application->dinas_pu_status = 'menunggu_validasi_awal';
                    $application->dinas_pu_notes = null;
                    $msg = 'Permohonan di-rollback ke tahap menunggu validasi awal Dinas PUTR.';
                }
            }
        } else {
            if ($application->status === 'disetujui' || $application->status === 'ditolak') {
                if ($application->satu_pintu_no_pkkpr || $application->approval_document) {
                    $application->status = 'menunggu_satu_pintu';
                    $application->satu_pintu_no_pkkpr = null;
                    $application->satu_pintu_tanggal_terbit = null;
                    $application->satu_pintu_notes = null;
                    $application->approval_document = null;
                    $msg = 'Permohonan di-rollback ke tahap menunggu verifikasi Dinas Satu Pintu.';
                } elseif ($application->dinas_pu_notes) {
                    $application->status = 'menunggu_dinas_pu';
                    $application->dinas_pu_notes = null;
                    $msg = 'Permohonan di-rollback ke tahap menunggu verifikasi Dinas PU.';
                } else {
                    $application->status = 'menunggu_bpn';
                    if ($application->bpn_berkas_status === 'ditolak') {
                        $application->bpn_berkas_status = 'menunggu';
                    }
                    $msg = 'Permohonan di-rollback ke tahap pemeriksaan BPN.';
                }
            } elseif ($application->status === 'menunggu_satu_pintu') {
                $application->status = 'menunggu_dinas_pu';
                $application->dinas_pu_notes = null;
                $msg = 'Permohonan di-rollback ke tahap verifikasi Dinas PU.';
            } elseif ($application->status === 'menunggu_dinas_pu') {
                $application->status = 'menunggu_bpn';
                $application->bpn_pertek_document = null;
                $application->bpn_pertek_uploaded_at = null;
                $msg = 'Permohonan di-rollback ke tahap penerbitan Pertek BPN.';
            } elseif ($application->status === 'menunggu_putr') {
                $application->status = 'menunggu_bpn';
                $application->bpn_berkas_status = 'menunggu';
                $application->bpn_notes = null;
                $msg = 'Permohonan di-rollback ke tahap verifikasi berkas awal BPN.';
            } elseif ($application->status === 'menunggu_bpn') {
                if ($application->bpn_rapat_dt) {
                    $application->bpn_rapat_dt = null;
                    $application->bpn_rapat_date = null;
                    $msg = 'Jadwal Rapat Pembahasan berhasil dihapus/direset.';
                } elseif ($application->bpn_cek_lokasi_dt) {
                    $application->bpn_cek_lokasi_dt = null;
                    $application->bpn_cek_lokasi_date = null;
                    $application->bpn_cek_lokasi_cp = null;
                    $msg = 'Jadwal Cek Lokasi Lapangan berhasil dihapus/direset.';
                } else {
                    if ($application->bpn_berkas_status === 'diterima') {
                        $application->status = 'menunggu_putr';
                        $application->no_berkas = null;
                        $msg = 'Konfirmasi pembayaran/No. Berkas berhasil dibatalkan. Status kembali ke Menunggu Konfirmasi Pembayaran.';
                    } else {
                        $application->bpn_berkas_status = 'menunggu';
                        $application->bpn_notes = null;
                        $msg = 'Pemeriksaan berkas awal berhasil di-rollback ke status Menunggu Verifikasi.';
                    }
                }
            }
        }

        $application->save();

        $layananName = match($type) {
            'ppkpr_berusaha', 'berusaha' => 'Pertimbangan Teknis Pertanahan PKKPR Berusaha',
            'ppkpr_non_berusaha' => 'Pertimbangan Teknis Pertanahan PKKPR Non Berusaha',
            'kebijakan_khusus' => 'Pertimbangan Teknis Pertanahan Kebijakan',
            'psn' => 'Pertimbangan Teknis Pertanahan Proyek Strategis Nasional (PSN)',
            'tanah_timbul', 'tanah-timbul' => 'Pertimbangan Teknis Pertanahan Tanah Timbul',
            default => 'Layanan Pertanahan'
        };

        try {
            $this->sendNotificationWithMailbox($application, 'rollback', $layananName, $redirectRoutes[$type], $msg);
        } catch (\Exception $e) {}

        return redirect()->route($redirectRoutes[$type], $id)->with('success', $msg);
    }

    public function forwardStatus($type, $id)
    {
        if (!\Illuminate\Support\Facades\Auth::user()->isDpn()) {
            abort(403, "Hanya Super Admin (DPN) yang berwenang untuk melakukan maju status.");
        }

        $models = [
            "ppkpr_non_berusaha" => \App\Models\PpkprApplication::class,
            "ppkpr_berusaha" => \App\Models\PpkprBerusahaApplication::class,
            "berusaha" => \App\Models\PpkprBerusahaApplication::class,
            "kebijakan_khusus" => \App\Models\KebijakanApplication::class,
            "psn" => \App\Models\PsnApplication::class,
            "tanah_timbul" => \App\Models\TanahTimbulApplication::class,
            "tanah-timbul" => \App\Models\TanahTimbulApplication::class,
        ];

        $redirectRoutes = [
            'ppkpr_non_berusaha' => 'non-berusaha.show',
            'ppkpr_berusaha' => 'berusaha.show',
            'berusaha' => 'berusaha.show',
            'kebijakan_khusus' => 'kebijakan.show',
            'psn' => 'psn.show',
            'tanah_timbul' => 'tanah-timbul.show',
            'tanah-timbul' => 'tanah-timbul.show',
        ];

        if (!array_key_exists($type, $models)) {
            return redirect()->back()->with("error", "Tipe permohonan tidak valid.");
        }

        $modelClass = $models[$type];
        $application = $modelClass::findOrFail($id);
        $msg = "Permohonan di-maju ke tahap selanjutnya.";

        if ($type === "ppkpr_berusaha" || $type === "berusaha") {
            if ($application->status === "menunggu_bpn") {
                if ($application->bpn_berkas_status !== "diterima") {
                    $application->bpn_berkas_status = "diterima";
                    $msg = "Berkas dinyatakan diterima/lengkap.";
                } elseif ($application->bpn_pembayaran_status !== "sudah_bayar") {
                    $application->bpn_pembayaran_status = "sudah_bayar";
                    $application->no_berkas = "BYPASS-" . time();
                    $msg = "Pembayaran PNBP dikonfirmasi (bypass).";
                } elseif (!$application->bpn_cek_lokasi_dt) {
                    $application->bpn_cek_lokasi_dt = now();
                    $application->bpn_cek_lokasi_date = now()->format("Y-m-d\TH:i");
                    $application->bpn_cek_lokasi_cp = "Bypass CP";
                    $msg = "Jadwal Cek Lokasi di-set (bypass).";
                } elseif (!$application->bpn_rapat_dt) {
                    $application->bpn_rapat_dt = now();
                    $application->bpn_rapat_date = now()->format("Y-m-d\TH:i");
                    $msg = "Jadwal Rapat Pembahasan di-set (bypass).";
                } else {
                    $application->status = "menunggu_dinas_pu";
                    $application->dinas_pu_status = "menunggu_validasi_awal";
                    $msg = "Permohonan di-maju ke tahap Validasi Awal Dinas PUTR.";
                }
            } elseif ($application->status === "menunggu_dinas_pu") {
                $application->status = "menunggu_satu_pintu";
                $msg = "Permohonan di-maju ke tahap Verifikasi Dinas Satu Pintu.";
            } elseif ($application->status === "menunggu_satu_pintu") {
                $application->status = "disetujui";
                $msg = "Permohonan di-maju ke status Disetujui.";
            }
        } else {
            if ($application->status === "menunggu_bpn") {
                if ($application->bpn_berkas_status !== "diterima") {
                    $application->bpn_berkas_status = "diterima";
                    $msg = "Berkas dinyatakan diterima/lengkap.";
                } elseif ($application->bpn_pembayaran_status !== "sudah_bayar") {
                    $application->bpn_pembayaran_status = "sudah_bayar";
                    $application->no_berkas = "BYPASS-" . time();
                    $msg = "Pembayaran PNBP dikonfirmasi (bypass).";
                } elseif (!$application->bpn_cek_lokasi_dt) {
                    $application->bpn_cek_lokasi_dt = now();
                    $application->bpn_cek_lokasi_date = now()->format("Y-m-d\TH:i");
                    $application->bpn_cek_lokasi_cp = "Bypass CP";
                    $msg = "Jadwal Cek Lokasi di-set (bypass).";
                } elseif (!$application->bpn_rapat_dt) {
                    $application->bpn_rapat_dt = now();
                    $application->bpn_rapat_date = now()->format("Y-m-d\TH:i");
                    $msg = "Jadwal Rapat Pembahasan di-set (bypass).";
                } else {
                    $application->status = "menunggu_dinas_pu";
                    $msg = "Permohonan di-maju ke tahap Verifikasi Dinas PU.";
                }
            } elseif ($application->status === "menunggu_dinas_pu") {
                $application->status = "menunggu_satu_pintu";
                $msg = "Permohonan di-maju ke tahap Verifikasi Dinas Satu Pintu.";
            } elseif ($application->status === "menunggu_satu_pintu") {
                $application->status = "disetujui";
                $msg = "Permohonan di-maju ke status Disetujui.";
            }
        }

        $application->save();

        $layananName = match($type) {
            'ppkpr_berusaha', 'berusaha' => 'Pertimbangan Teknis Pertanahan PKKPR Berusaha',
            'ppkpr_non_berusaha' => 'Pertimbangan Teknis Pertanahan PKKPR Non Berusaha',
            'kebijakan_khusus' => 'Pertimbangan Teknis Pertanahan Kebijakan',
            'psn' => 'Pertimbangan Teknis Pertanahan Proyek Strategis Nasional (PSN)',
            'tanah_timbul', 'tanah-timbul' => 'Pertimbangan Teknis Pertanahan Tanah Timbul',
            default => 'Layanan Pertanahan'
        };

        try {
            $this->sendNotificationWithMailbox($application, 'rollback', $layananName, $redirectRoutes[$type], $msg);
        } catch (\Exception $e) {}

        return redirect()->route($redirectRoutes[$type], $id)->with("success", $msg);
    }

    /**
     * Download backup database SQL murni (~2-5 MB, Sangat Ringan) (Khusus Super Admin DPN).
     */
    public function downloadDatabaseSqlOnly()
    {
        if (!\Illuminate\Support\Facades\Auth::check() || !\Illuminate\Support\Facades\Auth::user()->isDpn()) {
            return redirect()->back()->with('error', 'Akses ditolak.');
        }

        try {
            $sqlContent = \App\Services\BackupService::generateSqlDump();
            $fileName = 'patenpakminko_db_backup_' . now()->format('Y-m-d_H-i-s') . '.sql';

            return response()->streamDownload(function() use ($sqlContent) {
                echo $sqlContent;
            }, $fileName, [
                'Content-Type' => 'text/x-sql',
                'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
            ]);
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Gagal ekspor database SQL: ' . $e->getMessage());
        }
    }

    /**
     * Download backup sistem & database lengkap / custom dalam format ZIP (Khusus Super Admin DPN).
     */
    public function downloadDatabaseBackup(\Illuminate\Http\Request $request)
    {
        if (!\Illuminate\Support\Facades\Auth::check() || !\Illuminate\Support\Facades\Auth::user()->isDpn()) {
            return redirect()->back()->with('error', 'Akses ditolak. Fitur backup sistem khusus Super Admin DPN.');
        }

        try {
            \App\Services\BackupService::cleanOldBackups(30);

            $selectedCategories = $request->input('categories', []);
            if (is_string($selectedCategories)) {
                $selectedCategories = array_filter(explode(',', $selectedCategories));
            }

            $zipPath = \App\Services\BackupService::createFullZipBackup(null, (array)$selectedCategories);
            $fileName = basename($zipPath);

            return response()->download($zipPath, $fileName, [
                'Content-Type' => 'application/zip',
            ])->deleteFileAfterSend(true);

        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Gagal membuat backup sistem: ' . $e->getMessage());
        }
    }

    /**
     * Kirim backup database SQL ke email terpilih (Khusus Super Admin DPN).
     */
    public function sendBackupEmailNow(\Illuminate\Http\Request $request)
    {
        if (!\Illuminate\Support\Facades\Auth::check() || !\Illuminate\Support\Facades\Auth::user()->isDpn()) {
            return redirect()->back()->with('error', 'Akses ditolak.');
        }

        $targetOption = $request->input('target_option', 'both'); // 'both', 'my_email', 'penataan_email'
        $userEmail = \Illuminate\Support\Facades\Auth::user()->email;
        $penataanEmail = 'penataanpertanahanmiko@gmail.com';

        $recipients = [];
        if ($targetOption === 'my_email' && $userEmail) {
            $recipients[] = $userEmail;
        } elseif ($targetOption === 'penataan_email') {
            $recipients[] = $penataanEmail;
        } else {
            if ($userEmail) {
                $recipients[] = $userEmail;
            }
            $recipients[] = $penataanEmail;
        }

        $recipients = array_values(array_filter(array_unique($recipients)));

        if (empty($recipients)) {
            return redirect()->back()->with('error', 'Tidak ada alamat email tujuan pengiriman yang valid.');
        }

        $success = \App\Services\BackupService::sendDatabaseBackupEmail($recipients);

        if ($success) {
            $recipientStr = implode(', ', $recipients);
            return redirect()->back()->with('success', "Salinan Database SQL berhasil dikirimkan ke email: {$recipientStr}");
        } else {
            return redirect()->back()->with('error', 'Gagal mengirim email backup. Pastikan konfigurasi SMTP Email di server sudah aktif.');
        }
    }
}