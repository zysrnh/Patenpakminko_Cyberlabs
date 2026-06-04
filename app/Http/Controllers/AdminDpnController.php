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
}
