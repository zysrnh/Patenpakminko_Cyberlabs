<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PpkprBerusahaApplication;
use App\Models\PpkprApplication;
use App\Models\PsnApplication;
use App\Models\KebijakanApplication;
use App\Models\TanahTimbulApplication;
use App\Models\User;
use App\Traits\WaBlastHelper;

class RevisiController extends Controller
{
    use WaBlastHelper;
    public function index()
    {
        return view("revisi.index");
    }

    public function track(Request $request)
    {
        $request->validate([
            "phone" => "required|string",
        ]);

        $phone = $request->phone;
        // Cari user dengan nomor HP tersebut
        $user = User::where("phone_number", $phone)->orWhere("username", $phone)->first();

        if (!$user) {
            return redirect()->back()->with("error", "Nomor telepon tidak ditemukan di sistem pendaftaran kami.");
        }

        $applications = [];

        // Fetch all rejected applications from all tables
        $berusaha = PpkprBerusahaApplication::where("user_id", $user->id)
            ->where(function($q) { $q->where("status", "ditolak")->orWhere("bpn_berkas_status", "tidak_sesuai"); })
            ->orderBy('created_at', 'desc')->get();
        foreach($berusaha as $b) {
            $applications[] = [
                'type' => 'berusaha', 'layanan' => 'PPKPR Berusaha', 'id' => $b->id,
                'application_number' => $b->application_number, 'created_at' => $b->created_at,
                'notes' => $b->bpn_notes ?? $b->putr_notes ?? $b->dinas_pu_notes ?? ''
            ];
        }

        $non = PpkprApplication::where("user_id", $user->id)
            ->where(function($q) { $q->where("status", "ditolak")->orWhere("bpn_berkas_status", "tidak_sesuai"); })
            ->orderBy('created_at', 'desc')->get();
        foreach($non as $n) {
            $applications[] = [
                'type' => 'non_berusaha', 'layanan' => 'PPKPR Non Berusaha', 'id' => $n->id,
                'application_number' => $n->application_number, 'created_at' => $n->created_at,
                'notes' => $n->bpn_notes ?? $n->putr_notes ?? $n->dinas_pu_notes ?? ''
            ];
        }

        $psn = PsnApplication::where("user_id", $user->id)
            ->where(function($q) { $q->where("status", "ditolak")->orWhere("bpn_berkas_status", "tidak_sesuai"); })
            ->orderBy('created_at', 'desc')->get();
        foreach($psn as $p) {
            $applications[] = [
                'type' => 'psn', 'layanan' => 'Proyek Strategis Nasional', 'id' => $p->id,
                'application_number' => $p->application_number, 'created_at' => $p->created_at,
                'notes' => $p->bpn_notes ?? $p->putr_notes ?? $p->dinas_pu_notes ?? ''
            ];
        }

        $kebijakan = KebijakanApplication::where("user_id", $user->id)
            ->where(function($q) { $q->where("status", "ditolak")->orWhere("bpn_berkas_status", "tidak_sesuai"); })
            ->orderBy('created_at', 'desc')->get();
        foreach($kebijakan as $k) {
            $applications[] = [
                'type' => 'kebijakan', 'layanan' => 'Kebijakan Khusus', 'id' => $k->id,
                'application_number' => $k->application_number, 'created_at' => $k->created_at,
                'notes' => $k->bpn_notes ?? $k->putr_notes ?? $k->dinas_pu_notes ?? ''
            ];
        }

        $timbul = TanahTimbulApplication::where("user_id", $user->id)
            ->where(function($q) { $q->where("status", "ditolak")->orWhere("bpn_berkas_status", "tidak_sesuai"); })
            ->orderBy('created_at', 'desc')->get();
        foreach($timbul as $t) {
            $applications[] = [
                'type' => 'tanah_timbul', 'layanan' => 'Tanah Timbul', 'id' => $t->id,
                'application_number' => $t->application_number, 'created_at' => $t->created_at,
                'notes' => $t->bpn_notes ?? $t->putr_notes ?? $t->dinas_pu_notes ?? ''
            ];
        }

        if (count($applications) === 0) {
            return redirect()->back()->with("error", "Tidak ada permohonan yang berstatus DITOLAK/PERLU REVISI untuk nomor telepon ini.");
        }

        // Sort applications by created_at descending
        usort($applications, function($a, $b) {
            return $b['created_at'] <=> $a['created_at'];
        });

        return view("revisi.list", compact("applications", "phone"));
    }

    public function trackDetail(Request $request)
    {
        $type = $request->input('type');
        $id = $request->input('id');

        $application = null;
        if($type === "berusaha") $application = PpkprBerusahaApplication::findOrFail($id);
        elseif($type === "non_berusaha") $application = PpkprApplication::findOrFail($id);
        elseif($type === "psn") $application = PsnApplication::findOrFail($id);
        elseif($type === "kebijakan") $application = KebijakanApplication::findOrFail($id);
        elseif($type === "tanah_timbul") $application = TanahTimbulApplication::findOrFail($id);

        if (!$application) {
            abort(404);
        }

        // Parsing bpn_notes untuk mendeteksi berkas apa yang kurang
        $notes = $application->bpn_notes ?? $application->putr_notes ?? $application->dinas_pu_notes ?? "";
        $missingFiles = [];
        
        if (strpos($notes, "Berkas yang harus diperbaiki:") !== false) {
            $parts = explode("Berkas yang harus diperbaiki:", $notes);
            $list = explode("\n", trim($parts[1]));
            foreach($list as $l) {
                $item = trim(str_replace("-", "", $l));
                if(!empty($item)) {
                    $missingFiles[] = $item;
                }
            }
        } else {
            // Jika tidak ada deteksi regex otomatis, asumsikan harus upload semuanya dalam 1 bundle zip
            $missingFiles[] = "Dokumen Perbaikan (Gabungan PDF/ZIP)";
        }

        return view("revisi.upload", compact("application", "type", "missingFiles", "notes"));
    }

    public function upload(Request $request, $type, $id)
    {
        $application = null;
        if($type === "berusaha") $application = PpkprBerusahaApplication::findOrFail($id);
        elseif($type === "non_berusaha") $application = PpkprApplication::findOrFail($id);
        elseif($type === "psn") $application = PsnApplication::findOrFail($id);
        elseif($type === "kebijakan") $application = KebijakanApplication::findOrFail($id);
        elseif($type === "tanah_timbul") $application = TanahTimbulApplication::findOrFail($id);

        if(!$application) abort(404);

        // Map nama berkas ke kolom database
        $mapping = [
            "Formulir PTP" => "formulir_ptp",
            "Peta Lokasi / Sketsa" => "peta_lokasi",
            "KTP Pemohon" => "fc_ktp",
            "NPWP" => "fc_npwp",
            "Surat Kuasa" => "surat_kuasa",
            "NIB / KBLI" => "nib",
            "Akta Pendirian" => "fc_akta_pendirian",
            "Proposal Kegiatan" => "proposal_kegiatan",
            "Dokumen Perbaikan (Gabungan PDF/ZIP)" => "persyaratan_lainnya"
        ];

        $timestamp = date("Ymd_His");
        $uploadedCount = 0;

        foreach ($request->allFiles() as $key => $file) {
            // Jika format field name yang diinput menggunakan prefix doc_
            if (strpos($key, "doc_") === 0) {
                $originalName = str_replace("doc_", "", $key);
                $originalName = str_replace("_", " ", $originalName); // revert back
                
                // Cari kolom db yang sesuai
                $dbColumn = "persyaratan_lainnya"; // default fallback
                foreach($mapping as $k => $col) {
                    if (strtolower(str_replace(" ", "", $k)) == strtolower(str_replace(" ", "", $originalName))) {
                        $dbColumn = $col;
                        break;
                    }
                }

                $extension = $file->getClientOriginalExtension();
                $fileName = "REVISI_" . $type . "_" . $id . "_" . $dbColumn . "_" . $timestamp . "." . $extension;
                $path = $file->storeAs("revisi_docs", $fileName, "public");
                
                // Simpan ke kolom aplikasi atau requirements
                // Karena kita tidak yakin kolomnya ada di tabel atau tidak, kita masukkan semua ke persyaratan_lainnya jika error
                // Cek apakah kolom benar-benar ada di tabel sebelum diset
                if (\Illuminate\Support\Facades\Schema::hasColumn($application->getTable(), $dbColumn)) {
                    $application->$dbColumn = $path;
                } else {
                    $application->persyaratan_lainnya = $path;
                }
                $uploadedCount++;
            }
        }

        if ($uploadedCount > 0) {
            $application->status = "menunggu_bpn";
            $application->bpn_berkas_status = "menunggu";
            $application->bpn_notes = "Telah Direvisi Pemohon. " . $application->bpn_notes;
            $application->save();

            // Blast WA ke Admin Kantor Pertanahan (BPN) bahwa pemohon telah mengunggah revisi
            $this->sendNotificationWithMailbox($application, 'berkas_revisi_bpn', 'Revisi Dokumen', 'dashboard', '');

            return redirect()->route("pengajuan.sukses")->with("success", "Berkas perbaikan berhasil diunggah! Status permohonan kembali Menunggu Pemeriksaan BPN.");
        }

        return redirect()->back()->with("error", "Tidak ada file yang diunggah.");
    }
}
