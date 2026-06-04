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
}
