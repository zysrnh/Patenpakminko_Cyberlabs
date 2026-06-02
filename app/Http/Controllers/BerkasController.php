<?php

namespace App\Http\Controllers;

use App\Models\Berkas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BerkasController extends Controller
{
    /**
     * Pastikan hanya role yang diizinkan yang bisa akses controller ini
     */
    public function __construct()
    {
        // Middleware akan dihandle di routes/web.php
    }

    public function index(Request $request)
    {
        $user = Auth::user();
        
        // Cek akses: DPN, BPN, Dinas PU, Dinas PUTR (Sesuai request)
        if (!in_array($user->role, ['dpn', 'bpn', 'dinas_pu', 'dinas_putr'])) {
            return redirect('/dashboard')->with('error', 'Anda tidak memiliki akses ke fitur ini.');
        }

        $query = Berkas::with('user')->latest();

        // Filter berdasarkan kategori
        if ($request->has('kategori') && $request->kategori != '') {
            $query->where('kategori', $request->kategori);
        }

        // Filter pencarian nama berkas
        if ($request->has('search') && $request->search != '') {
            $query->where('nama_berkas', 'like', '%' . $request->search . '%');
        }

        $berkas = $query->paginate(10);

        return view('berkas.index', compact('berkas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_berkas' => 'required|string|max:255',
            'kategori'    => 'nullable|string|max:100',
            'file'        => 'required|file|mimes:pdf,jpg,jpeg,png,doc,docx,xls,xlsx|max:10240', // Max 10MB
            'keterangan'  => 'nullable|string'
        ]);

        $file = $request->file('file');
        
        // Simpan file ke storage/app/public/berkas
        $filePath = $file->store('berkas', 'public');
        
        $ukuranKb = round($file->getSize() / 1024, 2);
        $ukuranStr = $ukuranKb > 1024 ? round($ukuranKb / 1024, 2) . ' MB' : $ukuranKb . ' KB';

        Berkas::create([
            'user_id'     => Auth::id(),
            'nama_berkas' => $request->nama_berkas,
            'kategori'    => $request->kategori,
            'file_path'   => $filePath,
            'tipe_file'   => $file->getClientOriginalExtension(),
            'ukuran_file' => $ukuranStr,
            'keterangan'  => $request->keterangan
        ]);

        return redirect()->route('berkas.index')->with('success', 'Berkas berhasil diupload.');
    }

    public function download($id)
    {
        $berkas = Berkas::findOrFail($id);
        
        if (Storage::disk('public')->exists($berkas->file_path)) {
            return Storage::disk('public')->download($berkas->file_path, $berkas->nama_berkas . '.' . $berkas->tipe_file);
        }

        return redirect()->back()->with('error', 'File tidak ditemukan di server.');
    }

    public function preview($id)
    {
        $berkas = Berkas::findOrFail($id);
        
        if (Storage::disk('public')->exists($berkas->file_path)) {
            $path = storage_path('app/public/' . $berkas->file_path);
            $mimeType = mime_content_type($path);
            // Default HTML mime type if not detected properly for text files
            if ($berkas->tipe_file === 'html') {
                $mimeType = 'text/html';
            }

            return response()->file($path, [
                'Content-Type' => $mimeType,
                'Content-Disposition' => 'inline; filename="' . $berkas->nama_berkas . '.' . $berkas->tipe_file . '"'
            ]);
        }

        return redirect()->back()->with('error', 'File tidak ditemukan di server.');
    }

    public function destroy($id)
    {
        $berkas = Berkas::findOrFail($id);
        
        // Hapus fisik file
        if (Storage::disk('public')->exists($berkas->file_path)) {
            Storage::disk('public')->delete($berkas->file_path);
        }
        
        $berkas->delete();

        return redirect()->route('berkas.index')->with('success', 'Berkas berhasil dihapus.');
    }

    public function sync()
    {
        // Panggil command artisan sync
        \Illuminate\Support\Facades\Artisan::call('berkas:sync');
        $output = \Illuminate\Support\Facades\Artisan::output();

        return redirect()->route('berkas.index')->with('success', 'Sinkronisasi berhasil: ' . $output);
    }
}
