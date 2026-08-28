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
                'type' => 'kebijakan', 'layanan' => 'Kebijakan', 'id' => $k->id,
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
        
        $separator = null;
        if (stripos($notes, "Berkas yang harus diperbaiki:") !== false) {
            $separator = "Berkas yang harus diperbaiki:";
        } elseif (stripos($notes, "Mohon perbaiki dokumen berikut:") !== false) {
            $separator = "Mohon perbaiki dokumen berikut:";
        } elseif (stripos($notes, "dokumen berikut:") !== false) {
            $separator = "dokumen berikut:";
        }

        if ($separator) {
            $parts = explode($separator, $notes);
            $subText = $parts[1] ?? '';
            if (stripos($subText, "Catatan Tambahan:") !== false) {
                $subParts = explode("Catatan Tambahan:", $subText);
                $subText = $subParts[0];
            }
            $list = explode("\n", trim($subText));
            foreach($list as $l) {
                $item = trim(preg_replace('/^[\s\-\•\*\.]+/u', '', $l));
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

    private function resolveDbColumn(string $originalName, $application): string
    {
        $table = $application->getTable();
        $nameLower = strtolower($originalName);

        // Keyword & explicit mapping detection
        if (str_contains($nameLower, 'rencana')) {
            if (\Illuminate\Support\Facades\Schema::hasColumn($table, 'rencana_penggunaan_tanah')) return 'rencana_penggunaan_tanah';
        }
        if (str_contains($nameLower, 'penguasaan') || str_contains($nameLower, 'sertifikat') || str_contains($nameLower, 'bukti')) {
            if (\Illuminate\Support\Facades\Schema::hasColumn($table, 'bukti_penguasaan_tanah')) return 'bukti_penguasaan_tanah';
        }
        if (str_contains($nameLower, 'peta') || str_contains($nameLower, 'sketsa')) {
            if (\Illuminate\Support\Facades\Schema::hasColumn($table, 'peta_lokasi')) return 'peta_lokasi';
        }
        if (str_contains($nameLower, 'ktp')) {
            if (\Illuminate\Support\Facades\Schema::hasColumn($table, 'fc_ktp')) return 'fc_ktp';
        }
        if (str_contains($nameLower, 'npwp')) {
            if (\Illuminate\Support\Facades\Schema::hasColumn($table, 'fc_npwp')) return 'fc_npwp';
        }
        if (str_contains($nameLower, 'kuasa')) {
            if (\Illuminate\Support\Facades\Schema::hasColumn($table, 'surat_kuasa')) return 'surat_kuasa';
        }
        if (str_contains($nameLower, 'nib') || str_contains($nameLower, 'kbli')) {
            if (\Illuminate\Support\Facades\Schema::hasColumn($table, 'nib')) return 'nib';
        }
        if (str_contains($nameLower, 'akta')) {
            if (\Illuminate\Support\Facades\Schema::hasColumn($table, 'fc_akta_pendirian')) return 'fc_akta_pendirian';
        }
        if (str_contains($nameLower, 'proposal')) {
            if (\Illuminate\Support\Facades\Schema::hasColumn($table, 'proposal_kegiatan')) return 'proposal_kegiatan';
        }
        if (str_contains($nameLower, 'ptp') || str_contains($nameLower, 'formulir')) {
            if (\Illuminate\Support\Facades\Schema::hasColumn($table, 'formulir_ptp')) return 'formulir_ptp';
        }

        return "persyaratan_lainnya";
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

        $timestamp = date("Ymd_His");
        $uploadedCount = 0;

        foreach ($request->allFiles() as $key => $file) {
            // Jika format field name yang diinput menggunakan prefix doc_
            if (strpos($key, "doc_") === 0) {
                $originalName = str_replace("doc_", "", $key);
                $originalName = str_replace("_", " ", $originalName); // revert back
                
                $dbColumn = $this->resolveDbColumn($originalName, $application);

                $extension = $file->getClientOriginalExtension();
                $fileName = "REVISI_" . $type . "_" . $id . "_" . $dbColumn . "_" . $timestamp . "." . $extension;
                $path = $file->storeAs("revisi_docs", $fileName, "public");
                
                if (\Illuminate\Support\Facades\Schema::hasColumn($application->getTable(), $dbColumn)) {
                    $application->$dbColumn = $path;
                } else {
                    $application->persyaratan_lainnya = $path;
                }
                $uploadedCount++;
            }
        }

        foreach ($request->all() as $inputKey => $tempPath) {
            if (strpos($inputKey, "temp_doc_") === 0 && !empty($tempPath) && \Illuminate\Support\Facades\Storage::disk('public')->exists($tempPath)) {
                $originalName = str_replace("temp_doc_", "", $inputKey);
                $originalName = str_replace("_", " ", $originalName);
                
                $dbColumn = $this->resolveDbColumn($originalName, $application);

                $extension = pathinfo($tempPath, PATHINFO_EXTENSION);
                $fileName = "REVISI_" . $type . "_" . $id . "_" . $dbColumn . "_" . $timestamp . "." . $extension;
                $newPath = "revisi_docs/" . $fileName;
                \Illuminate\Support\Facades\Storage::disk('public')->copy($tempPath, $newPath);

                if (\Illuminate\Support\Facades\Schema::hasColumn($application->getTable(), $dbColumn)) {
                    $application->$dbColumn = $newPath;
                } else {
                    $application->persyaratan_lainnya = $newPath;
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
