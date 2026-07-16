<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DokumenController extends Controller
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

        $query = Dokumen::with('user')->latest();

        // Filter berdasarkan kategori
        if ($request->has('kategori') && $request->kategori != '') {
            $query->where('kategori', $request->kategori);
        }

        // Filter berdasarkan tanggal unggah
        if ($request->has('tanggal') && $request->tanggal != '') {
            $query->whereDate('created_at', $request->tanggal);
        }

        // Filter pencarian nama dokumen atau nama pengunggah
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_dokumen', 'like', '%' . $search . '%')
                  ->orWhereHas('user', function($qUser) use ($search) {
                      $qUser->where('name', 'like', '%' . $search . '%')
                            ->orWhere('business_name', 'like', '%' . $search . '%');
                  });
            });
        }

        // Filter berdasarkan layanan khusus (PKKPR Berusaha, Non Berusaha, dsb)
        if ($request->has('layanan') && $request->layanan != '') {
            $query->where('nama_dokumen', 'like', '[' . $request->layanan . ']%');
        }

        // Filter berdasarkan pemohon
        if ($request->has('user_id') && $request->user_id != '') {
            $query->where('user_id', $request->user_id);
        }

        // Khusus PTSP: Hanya boleh melihat kategori "Dokumen Pertimbangan Teknis Pertanahan"
        if ($user->isSatuPintu()) {
            $query->where('kategori', 'Dokumen Pertimbangan Teknis Pertanahan');
        }

        $dokumen = $query->paginate(10);
        
        // Ambil daftar pemohon yang sudah ada berkas/dokumennya atau role pelaku_usaha
        $userIdsBerkas = \App\Models\Berkas::select('user_id')->distinct()->pluck('user_id')->toArray();
        $userIdsDokumen = Dokumen::select('user_id')->distinct()->pluck('user_id')->toArray();
        $allUserIds = array_unique(array_merge($userIdsBerkas, $userIdsDokumen));
        
        $pemohonList = \App\Models\User::whereIn('id', $allUserIds)->orWhere('role', 'pelaku_usaha')->get();

        // Ambil daftar kategori yang sudah ada untuk dropdown filter
        $kategoriList = Dokumen::select('kategori')->distinct()->whereNotNull('kategori')->orderBy('kategori')->pluck('kategori');

        return view('dokumen.index', compact('dokumen', 'pemohonList', 'kategoriList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_dokumen' => 'nullable|string|max:255',
            'kategori'    => 'nullable|string|max:100',
            'file'        => 'required|file|mimes:pdf,jpg,jpeg,png,doc,docx,xls,xlsx|max:102400', // Max 10MB
            'keterangan'  => 'nullable|string'
        ]);

        $file = $request->file('file');
        
        // Simpan file ke storage/app/public/dokumen
        $filePath = $file->store('dokumen', 'public');
        
        $ukuranKb = round($file->getSize() / 1024, 2);
        $ukuranStr = $ukuranKb > 1024 ? round($ukuranKb / 1024, 2) . ' MB' : $ukuranKb . ' KB';

        Dokumen::create([
            'user_id'     => Auth::id(),
            'nama_dokumen' => $request->nama_dokumen ?: pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME),
            'kategori'    => $request->kategori,
            'file_path'   => $filePath,
            'tipe_file'   => $file->getClientOriginalExtension(),
            'ukuran_file' => $ukuranStr,
            'keterangan'  => $request->keterangan
        ]);

        return redirect()->route('dokumen.index')->with('success', 'Dokumen berhasil diupload.');
    }

    public function download($id)
    {
        $dokumen = Dokumen::findOrFail($id);
        
        if (Storage::disk('public')->exists($dokumen->file_path)) {
            return Storage::disk('public')->download($dokumen->file_path, $dokumen->nama_dokumen . '.' . $dokumen->tipe_file);
        }

        return redirect()->back()->with('error', 'File tidak ditemukan di server.');
    }

    public function preview($id)
    {
        $dokumen = Dokumen::findOrFail($id);
        
        if (!Storage::disk('public')->exists($dokumen->file_path)) {
            return response()->json(['error' => 'File tidak ditemukan.'], 404);
        }

        $path = storage_path('app/public/' . $dokumen->file_path);
        $ext  = strtolower($dokumen->tipe_file);

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
            'Content-Disposition' => 'inline; filename="' . $dokumen->nama_dokumen . '.' . $ext . '"'
        ]);
    }

    public function destroy($id)
    {
        $dokumen = Dokumen::findOrFail($id);
        
        // Hapus fisik file
        if (Storage::disk('public')->exists($dokumen->file_path)) {
            Storage::disk('public')->delete($dokumen->file_path);
        }
        
        $dokumen->delete();

        return redirect()->route('dokumen.index')->with('success', 'Dokumen berhasil dihapus.');
    }

    public function downloadZip(Request $request)
    {
        $userId = $request->user_id;
        if (!$userId) {
            return redirect()->back()->with('error', 'Silakan pilih pemohon terlebih dahulu untuk mengunduh semua dokumen.');
        }

        $user = \App\Models\User::find($userId);
        if (!$user) {
            return redirect()->back()->with('error', 'Pemohon tidak ditemukan.');
        }

        // Ambil dari Berkas (Otomatis) dan Dokumen (Manual)
        $berkas = \App\Models\Berkas::where('user_id', $userId)->get();
        $dokumen = Dokumen::where('user_id', $userId)->get();

        if ($berkas->isEmpty() && $dokumen->isEmpty()) {
            return redirect()->back()->with('error', 'Tidak ada dokumen untuk pemohon ini.');
        }

        $zip = new \ZipArchive;
        $zipFileName = 'Semua_Dokumen_' . preg_replace('/[^a-zA-Z0-9_]/', '_', $user->name ?? $user->business_name) . '.zip';
        $zipFilePath = public_path($zipFileName);

        if ($zip->open($zipFilePath, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) === TRUE) {
            // Tambahkan file dari Berkas
            foreach ($berkas as $b) {
                if (Storage::disk('public')->exists($b->file_path)) {
                    $path = storage_path('app/public/' . $b->file_path);
                    $nameInZip = 'Otomatis/' . $b->nama_berkas . '.' . $b->tipe_file;
                    $zip->addFile($path, $nameInZip);
                }
            }
            // Tambahkan file dari Dokumen
            foreach ($dokumen as $d) {
                if (Storage::disk('public')->exists($d->file_path)) {
                    $path = storage_path('app/public/' . $d->file_path);
                    $nameInZip = 'Manual/' . $d->nama_dokumen . '.' . $d->tipe_file;
                    $zip->addFile($path, $nameInZip);
                }
            }
            $zip->close();
        } else {
            return redirect()->back()->with('error', 'Gagal membuat file ZIP.');
        }

        return response()->download($zipFilePath)->deleteFileAfterSend(true);
    }

    public function downloadBatch(Request $request)
    {
        $ids = $request->input('dokumen_ids');
        
        if (empty($ids)) {
            return redirect()->back()->with('error', 'Tidak ada dokumen yang dipilih.');
        }

        $dokumenList = Dokumen::whereIn('id', $ids)->get();

        if ($dokumenList->isEmpty()) {
            return redirect()->back()->with('error', 'Dokumen yang dipilih tidak ditemukan.');
        }

        $zip = new \ZipArchive;
        $zipFileName = 'Batch_Dokumen_' . date('Ymd_His') . '.zip';
        $zipFilePath = public_path($zipFileName);

        if ($zip->open($zipFilePath, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) === TRUE) {
            foreach ($dokumenList as $d) {
                if (Storage::disk('public')->exists($d->file_path)) {
                    $path = storage_path('app/public/' . $d->file_path);
                    $nameInZip = preg_replace('/[^a-zA-Z0-9_\-\.]/', '_', $d->nama_dokumen) . '.' . $d->tipe_file;
                    
                    // Prevent duplicate names in zip
                    $count = 1;
                    $originalName = pathinfo($nameInZip, PATHINFO_FILENAME);
                    while($zip->locateName($nameInZip) !== false) {
                        $nameInZip = $originalName . '_' . $count . '.' . $d->tipe_file;
                        $count++;
                    }

                    $zip->addFile($path, $nameInZip);
                }
            }
            $zip->close();
        } else {
            return redirect()->back()->with('error', 'Gagal membuat file ZIP.');
        }

        return response()->download($zipFilePath)->deleteFileAfterSend(true);
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
