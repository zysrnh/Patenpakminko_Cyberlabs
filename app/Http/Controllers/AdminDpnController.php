<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminDpnController extends Controller
{
    private $filePath = 'visitor_stats.json';

    public function index()
    {
        $count = 0;
        if (Storage::exists($this->filePath)) {
            $data = json_decode(Storage::get($this->filePath), true);
            $count = $data['count'] ?? 0;
        }

        return view('admin_dpn.index', compact('count'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'count' => 'required|integer|min:0'
        ]);
        
        $data = ['count' => (int) $request->count];
        Storage::put($this->filePath, json_encode($data));

        return redirect()->back()->with('success', 'Jumlah kunjungan web berhasil diperbarui!');
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
        if (!\Illuminate\Support\Facades\Auth::user()->isBpn()) {
            abort(403, 'Hanya petugas BPN yang berwenang untuk melakukan rollback status.');
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
                        $msg = 'Konfirmasi pembayaran retribusi berhasil di-rollback/dibatalkan.';
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

        return redirect()->route($redirectRoutes[$type], $id)->with('success', $msg);
    }

    public function forwardStatus($type, $id)
    {
        if (!\Illuminate\Support\Facades\Auth::user()->isBpn()) {
            abort(403, "Hanya petugas BPN yang berwenang untuk melakukan bypass status.");
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

        if (!array_key_exists($type, $models)) {
            return redirect()->back()->with("error", "Tipe permohonan tidak valid.");
        }

        $modelClass = $models[$type];
        $application = $modelClass::findOrFail($id);
        $msg = "Permohonan di-forward ke tahap selanjutnya.";

        if ($type === "ppkpr_berusaha" || $type === "berusaha") {
            if ($application->status === "menunggu_bpn") {
                if ($application->bpn_berkas_status !== "diterima") {
                    $application->bpn_berkas_status = "diterima";
                } elseif ($application->bpn_pembayaran_status !== "sudah_bayar") {
                    $application->bpn_pembayaran_status = "sudah_bayar";
                    $application->no_berkas = "BYPASS-" . time();
                } elseif (!$application->bpn_cek_lokasi_dt) {
                    $application->bpn_cek_lokasi_dt = now();
                    $application->bpn_cek_lokasi_date = now()->format("Y-m-d\TH:i");
                    $application->bpn_cek_lokasi_cp = "Bypass CP";
                } elseif (!$application->bpn_rapat_dt) {
                    $application->bpn_rapat_dt = now();
                    $application->bpn_rapat_date = now()->format("Y-m-d\TH:i");
                } else {
                    $application->status = "menunggu_putr";
                    $application->dinas_pu_status = "menunggu_validasi_awal";
                }
            } elseif ($application->status === "menunggu_putr") {
                $application->status = "menunggu_dinas_pu";
            } elseif ($application->status === "menunggu_dinas_pu") {
                $application->status = "menunggu_satu_pintu";
            } elseif ($application->status === "menunggu_satu_pintu") {
                $application->status = "disetujui";
            }
        } else {
            if ($application->status === "menunggu_bpn") {
                if ($application->bpn_berkas_status !== "diterima") {
                    $application->bpn_berkas_status = "diterima";
                } elseif ($application->bpn_pembayaran_status !== "sudah_bayar") {
                    $application->bpn_pembayaran_status = "sudah_bayar";
                    $application->no_berkas = "BYPASS-" . time();
                } elseif (!$application->bpn_cek_lokasi_dt) {
                    $application->bpn_cek_lokasi_dt = now();
                    $application->bpn_cek_lokasi_date = now()->format("Y-m-d\TH:i");
                    $application->bpn_cek_lokasi_cp = "Bypass CP";
                } elseif (!$application->bpn_rapat_dt) {
                    $application->bpn_rapat_dt = now();
                    $application->bpn_rapat_date = now()->format("Y-m-d\TH:i");
                } else {
                    $application->status = "menunggu_dinas_pu";
                }
            } elseif ($application->status === "menunggu_dinas_pu") {
                $application->status = "menunggu_satu_pintu";
            } elseif ($application->status === "menunggu_satu_pintu") {
                $application->status = "disetujui";
            }
        }

        $application->save();
        return redirect()->back()->with("success", $msg);
    }
}