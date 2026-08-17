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
        
        // Cek akses: DPN, BPN, Dinas PU, Dinas PUTR, Satu Pintu (Sesuai request)
        if (!in_array($user->role, ['dpn', 'bpn', 'dinas_pu', 'dinas_putr', 'satu_pintu'])) {
            return redirect('/dashboard')->with('error', 'Anda tidak memiliki akses ke fitur ini.');
        }

        // Hanya tampilkan berkas yang di-upload manual oleh PTSP (is_ptsp = true)
        $query = Berkas::with('user')
            ->where(function($q) {
                $q->where('is_ptsp', true)
                  ->orWhereIn('uploaded_by_role', ['satu_pintu', 'dpn', 'bpn', 'dinas_pu', 'dinas_putr']);
            })
            ->latest();

        // Filter berdasarkan kategori
        if ($request->has('kategori') && $request->kategori != '') {
            $query->where('kategori', $request->kategori);
        }

        // Filter berdasarkan tanggal unggah
        if ($request->has('tanggal') && $request->tanggal != '') {
            $query->whereDate('created_at', $request->tanggal);
        }

        // Filter pencarian nama berkas atau judul dokumen
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_berkas', 'like', '%' . $search . '%')
                  ->orWhere('keterangan', 'like', '%' . $search . '%')
                  ->orWhere('kategori', 'like', '%' . $search . '%');
            });
        }

        $berkas = $query->paginate(10);

        // Ambil daftar kategori yang sudah tersimpan untuk dropdown filter
        $kategoriList = Berkas::select('kategori')
            ->where(function($q) {
                $q->where('is_ptsp', true)
                  ->orWhereIn('uploaded_by_role', ['satu_pintu', 'dpn', 'bpn', 'dinas_pu', 'dinas_putr']);
            })
            ->distinct()
            ->whereNotNull('kategori')
            ->orderBy('kategori')
            ->pluck('kategori');

        return view('berkas.index', compact('berkas', 'kategoriList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_berkas' => 'nullable|string|max:255',
            'kategori'    => 'nullable|string|max:100',
            'file'        => 'required|file|mimes:pdf,jpg,jpeg,png,doc,docx,xls,xlsx|max:102400', // Max 100MB
            'keterangan'  => 'nullable|string'
        ]);

        $file = $request->file('file');
        
        // Simpan file ke storage/app/public/berkas
        $filePath = $file->store('berkas', 'public');
        
        $ukuranKb = round($file->getSize() / 1024, 2);
        $ukuranStr = $ukuranKb > 1024 ? round($ukuranKb / 1024, 2) . ' MB' : $ukuranKb . ' KB';

        $userRole = Auth::user()->role;
        $isPtsp = in_array($userRole, ['satu_pintu', 'dpn']);

        Berkas::create([
            'user_id'          => Auth::id(),
            'nama_berkas'      => $request->nama_berkas ?: pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME),
            'kategori'         => $request->kategori,
            'is_ptsp'          => $isPtsp,
            'uploaded_by_role' => $userRole,
            'file_path'        => $filePath,
            'tipe_file'        => $file->getClientOriginalExtension(),
            'ukuran_file'      => $ukuranStr,
            'keterangan'       => $request->keterangan
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
        
        if (!Storage::disk('public')->exists($berkas->file_path)) {
            return response()->json(['error' => 'File tidak ditemukan.'], 404);
        }

        $path = storage_path('app/public/' . $berkas->file_path);
        $ext  = strtolower($berkas->tipe_file);

        // Untuk DOCX: konversi ke HTML dulu pakai PhpWord, tampilkan di browser
        if (in_array($ext, ['doc', 'docx'])) {
            try {
                $phpWord = \PhpOffice\PhpWord\IOFactory::load($path);
                $writer  = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'HTML');

                ob_start();
                $writer->save('php://output');
                $html = ob_get_clean();

                return response($html, 200)->header('Content-Type', 'text/html');
            } catch (\Exception $e) {
                // Fallback: tampilkan pesan error daripada download
                return response('<html><body style="font-family:sans-serif;padding:40px;text-align:center;"><h3>Tidak dapat menampilkan preview file ini.</h3><p style="color:#718096">Gunakan tombol <strong>Unduh</strong> untuk membuka file di Microsoft Word.</p></body></html>', 200)
                    ->header('Content-Type', 'text/html');
            }
        }

        // Tentukan Mime Type untuk file lainnya
        $mimeType = 'application/octet-stream';
        if ($ext === 'pdf')  $mimeType = 'application/pdf';
        elseif (in_array($ext, ['jpg', 'jpeg'])) $mimeType = 'image/jpeg';
        elseif ($ext === 'png')  $mimeType = 'image/png';
        elseif ($ext === 'html') $mimeType = 'text/html';

        return response()->file($path, [
            'Content-Type'        => $mimeType,
            'Content-Disposition' => 'inline; filename="' . $berkas->nama_berkas . '.' . $ext . '"'
        ]);
    }

    public function destroy($id)
    {
        $user = \Illuminate\Support\Facades\Auth::user();
        if ($user->isDinasPu() || $user->isDinasPutr() || $user->isSatuPintu()) {
            return redirect()->route('berkas.index')->with('error', 'Akses ditolak.');
        }

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

    public function viewFile($path)
    {
        if (!\Illuminate\Support\Facades\Storage::disk('public')->exists($path)) {
            abort(404, 'File tidak ditemukan.');
        }

        $fullPath = storage_path('app/public/' . $path);
        $ext = strtolower(pathinfo($fullPath, PATHINFO_EXTENSION));

        $mimeType = 'application/octet-stream';
        if ($ext === 'pdf') $mimeType = 'application/pdf';
        elseif (in_array($ext, ['jpg', 'jpeg'])) $mimeType = 'image/jpeg';
        elseif ($ext === 'png')  $mimeType = 'image/png';
        elseif ($ext === 'html') $mimeType = 'text/html';

        return response()->file($fullPath, [
            'Content-Type'        => $mimeType,
            'Content-Disposition' => 'inline; filename="' . basename($fullPath) . '"'
        ]);
    }
}
