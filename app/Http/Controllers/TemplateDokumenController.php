<?php

namespace App\Http\Controllers;

use App\Models\TemplateDokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TemplateDokumenController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        // Cek akses: DPN, BPN, Dinas PU, Dinas PUTR, Satu Pintu
        if (!$user || !in_array($user->role, ['dpn', 'bpn', 'dinas_pu', 'dinas_putr', 'satu_pintu', 'admin_berita'])) {
            return redirect('/dashboard')->with('error', 'Anda tidak memiliki akses ke halaman Kelola Template Dokumen.');
        }

        $query = TemplateDokumen::query()->latest();

        if ($request->has('kategori') && $request->kategori != '') {
            $query->where('kategori', $request->kategori);
        }

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_template', 'like', '%' . $search . '%')
                  ->orWhere('kode_template', 'like', '%' . $search . '%')
                  ->orWhere('keterangan', 'like', '%' . $search . '%');
            });
        }

        $templates = $query->paginate(12)->withQueryString();
        $kategoriList = TemplateDokumen::select('kategori')->distinct()->orderBy('kategori')->pluck('kategori');

        return view('admin.template_dokumen.index', compact('templates', 'kategoriList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_template' => 'required|string|max:255',
            'kode_template' => 'required|string|max:100|unique:template_dokumens,kode_template',
            'kategori'      => 'required|string|max:100',
            'file'          => 'required|file|mimes:doc,docx,pdf|max:20480', // Max 20MB
            'keterangan'    => 'nullable|string',
        ]);

        $file = $request->file('file');
        $ext  = strtolower($file->getClientOriginalExtension());
        $filePath = $file->store('templates', 'public');

        $bytes = $file->getSize();
        $ukuranKb = round($bytes / 1024, 2);
        $ukuranStr = $ukuranKb > 1024 ? round($ukuranKb / 1024, 2) . ' MB' : $ukuranKb . ' KB';

        TemplateDokumen::create([
            'nama_template' => $request->nama_template,
            'kode_template' => strtolower(str_replace(' ', '_', trim($request->kode_template))),
            'kategori'      => $request->kategori,
            'file_path'     => $filePath,
            'tipe_file'     => $ext,
            'ukuran_file'   => $ukuranStr,
            'keterangan'    => $request->keterangan,
            'is_active'     => true,
        ]);

        return redirect()->route('admin.templates.index')->with('success', 'Template dokumen baru berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $template = TemplateDokumen::findOrFail($id);

        $request->validate([
            'nama_template' => 'required|string|max:255',
            'kode_template' => 'required|string|max:100|unique:template_dokumens,kode_template,' . $id,
            'kategori'      => 'required|string|max:100',
            'file'          => 'nullable|file|mimes:doc,docx,pdf|max:20480',
            'keterangan'    => 'nullable|string',
        ]);

        if ($request->hasFile('file')) {
            // Hapus file lama dari storage jika ada
            if (Storage::disk('public')->exists($template->file_path)) {
                Storage::disk('public')->delete($template->file_path);
            }

            $file = $request->file('file');
            $ext  = strtolower($file->getClientOriginalExtension());
            $filePath = $file->store('templates', 'public');

            $bytes = $file->getSize();
            $ukuranKb = round($bytes / 1024, 2);
            $ukuranStr = $ukuranKb > 1024 ? round($ukuranKb / 1024, 2) . ' MB' : $ukuranKb . ' KB';

            $template->file_path   = $filePath;
            $template->tipe_file   = $ext;
            $template->ukuran_file = $ukuranStr;
        }

        $template->nama_template = $request->nama_template;
        $template->kode_template = strtolower(str_replace(' ', '_', trim($request->kode_template)));
        $template->kategori      = $request->kategori;
        $template->keterangan    = $request->keterangan;
        $template->save();

        return redirect()->route('admin.templates.index')->with('success', 'Data template dokumen berhasil diperbarui.');
    }

    public function toggleActive($id)
    {
        $template = TemplateDokumen::findOrFail($id);
        $template->is_active = !$template->is_active;
        $template->save();

        $statusMsg = $template->is_active ? 'diaktifkan' : 'dinonaktifkan';
        return redirect()->route('admin.templates.index')->with('success', "Template '{$template->nama_template}' berhasil {$statusMsg}.");
    }

    public function download($id)
    {
        $template = TemplateDokumen::findOrFail($id);

        if (Storage::disk('public')->exists($template->file_path)) {
            return Storage::disk('public')->download($template->file_path, $template->nama_template . '.' . $template->tipe_file);
        }

        return redirect()->back()->with('error', 'File template tidak ditemukan di server.');
    }

    public function preview($id)
    {
        $template = TemplateDokumen::findOrFail($id);

        if (!Storage::disk('public')->exists($template->file_path)) {
            return response()->json(['error' => 'File template tidak ditemukan di server.'], 404);
        }

        $fullPath = storage_path('app/public/' . $template->file_path);
        $ext = strtolower($template->tipe_file);

        if (in_array($ext, ['doc', 'docx'])) {
            try {
                $phpWord = \PhpOffice\PhpWord\IOFactory::load($fullPath);
                $writer  = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'HTML');

                ob_start();
                $writer->save('php://output');
                $html = ob_get_clean();

                return response($html, 200)->header('Content-Type', 'text/html');
            } catch (\Exception $e) {
                return response('<html><body style="font-family:sans-serif;padding:40px;text-align:center;"><h3>Tidak dapat merender preview file Word ini.</h3><p style="color:#718096">Gunakan tombol <strong>Unduh</strong> untuk membuka file di Microsoft Word.</p></body></html>', 200)
                    ->header('Content-Type', 'text/html');
            }
        }

        $mimeType = 'application/octet-stream';
        if ($ext === 'pdf') {
            $mimeType = 'application/pdf';
        }

        return response()->file($fullPath, [
            'Content-Type'        => $mimeType,
            'Content-Disposition' => 'inline; filename="' . $template->nama_template . '.' . $ext . '"',
        ]);
    }

    public function destroy($id)
    {
        $template = TemplateDokumen::findOrFail($id);

        if (Storage::disk('public')->exists($template->file_path)) {
            Storage::disk('public')->delete($template->file_path);
        }

        $template->delete();

        return redirect()->route('admin.templates.index')->with('success', 'Template dokumen berhasil dihapus.');
    }
}
