<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PpkprBerusahaApplication;
use App\Models\PpkprApplication;
use App\Models\PsnApplication;
use App\Models\KebijakanApplication;
use App\Models\TanahTimbulApplication;
use App\Models\User;

class RevisiController extends Controller
{
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

        // Cari permohonan milik user ini yang statusnya ditolak
        $application = null;
        $type = "";
        
        $berusaha = PpkprBerusahaApplication::where("user_id", $user->id)->where("status", "ditolak")->latest()->first();
        if($berusaha) { $application = $berusaha; $type = "berusaha"; }
        
        if(!$application) {
            $non = PpkprApplication::where("user_id", $user->id)->where("status", "ditolak")->latest()->first();
            if($non) { $application = $non; $type = "non_berusaha"; }
        }
        
        if(!$application) {
            $psn = PsnApplication::where("user_id", $user->id)->where("status", "ditolak")->latest()->first();
            if($psn) { $application = $psn; $type = "psn"; }
        }
        
        if(!$application) {
            $kebijakan = KebijakanApplication::where("user_id", $user->id)->where("status", "ditolak")->latest()->first();
            if($kebijakan) { $application = $kebijakan; $type = "kebijakan"; }
        }
        
        if(!$application) {
            $timbul = TanahTimbulApplication::where("user_id", $user->id)->where("status", "ditolak")->latest()->first();
            if($timbul) { $application = $timbul; $type = "tanah_timbul"; }
        }

        if (!$application) {
            return redirect()->back()->with("error", "Tidak ada permohonan yang berstatus DITOLAK/PERLU REVISI untuk nomor telepon ini.");
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
                try {
                    $application->$dbColumn = $path;
                } catch (\Exception $e) {
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
            return redirect()->route("revisi.index")->with("success", "Berkas perbaikan berhasil diunggah! Status permohonan kembali Menunggu Pemeriksaan BPN.");
        }

        return redirect()->back()->with("error", "Tidak ada file yang diunggah.");
    }
}
