<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PpkprBerusahaApplication;
use App\Models\PpkprApplication;
use App\Models\PsnApplication;
use App\Models\KebijakanApplication;
use App\Models\TanahTimbulApplication;
use App\Traits\WaBlastHelper;

class WaTemplateController extends Controller
{
    use WaBlastHelper;

    public function getTemplate(Request $request)
    {
        $type = $request->input('type');
        $id = $request->input('id');
        $waType = $request->input('wa_type');

        if (!$type || !$id || !$waType) {
            return response()->json(['error' => 'Missing parameters'], 400);
        }

        $application = null;
        $layananTitle = '';
        $routeName = '';

        if ($type === 'berusaha') {
            $application = PpkprBerusahaApplication::find($id);
            $layananTitle = 'PPKPR Berusaha';
            $routeName = 'berusaha.show';
        } elseif ($type === 'non-berusaha' || $type === 'non_berusaha') {
            $application = PpkprApplication::find($id);
            $layananTitle = 'PPKPR Non Berusaha';
            $routeName = 'non-berusaha.show';
        } elseif ($type === 'psn') {
            $application = PsnApplication::find($id);
            $layananTitle = 'Proyek Strategis Nasional';
            $routeName = 'psn.show';
        } elseif ($type === 'kebijakan') {
            $application = KebijakanApplication::find($id);
            $layananTitle = 'Kebijakan Khusus';
            $routeName = 'kebijakan.show';
        } elseif ($type === 'tanah-timbul' || $type === 'tanah_timbul') {
            $application = TanahTimbulApplication::find($id);
            $layananTitle = 'Tanah Timbul';
            $routeName = 'tanah-timbul.show';
        }

        if (!$application) {
            return response()->json(['error' => 'Application not found'], 404);
        }

        // Apply temporary override if action is specified (so frontend can see template changes dynamically)
        $action = $request->query('action');
        if ($action) {
            if ($waType === 'berkas_verifikasi') {
                $application->bpn_berkas_status = ($action === 'approve' || $action === 'disetujui') ? 'diterima' : 'tidak_sesuai';
            } elseif ($waType === 'pertek_terbit') {
                $application->bpn_pertek_status = ($action === 'approve' || $action === 'disetujui') ? 'diterima' : 'ditolak';
            } elseif ($waType === 'putr_validasi') {
                $application->dinas_pu_status = ($action === 'approve' || $action === 'disetujui') ? 'validasi_selesai' : 'dikembalikan';
            } elseif ($waType === 'pu_selesai') {
                $application->dinas_pu_penilaian_status = ($action === 'approve' || $action === 'disetujui') ? 'selesai' : 'dikembalikan';
            } elseif ($waType === 'pkkpr_terbit') {
                $application->ptsp_status = ($action === 'approve' || $action === 'disetujui') ? 'terbit' : 'ditolak';
            }
        }

        $url = route($routeName, $application->id);
        $template = WaBlastHelper::generateWaMessage($waType, $application, $layananTitle, $url);

        return response()->json(['template' => $template]);
    }
}
