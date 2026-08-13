<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TempUploadController extends Controller
{
    /**
     * Handle temporary background upload for form documents.
     */
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:pdf,jpg,jpeg,png,doc,docx,zip,rar|max:10240',
        ], [
            'file.required' => 'File wajib dipilih.',
            'file.mimes' => 'Format file harus PDF, JPG, PNG, DOC, DOCX, ZIP, atau RAR.',
            'file.max' => 'Ukuran file maksimal 10MB.',
        ]);

        $file = $request->file('file');
        $safeOriginalName = preg_replace('/[^a-zA-Z0-9._-]/', '_', $file->getClientOriginalName());
        $filename = Str::uuid() . '_' . $safeOriginalName;
        
        $path = $file->storeAs('temp_uploads', $filename, 'public');

        return response()->json([
            'success' => true,
            'temp_path' => $path,
            'original_name' => $file->getClientOriginalName(),
            'file_size' => number_format($file->getSize() / 1024 / 1024, 2) . ' MB',
        ]);
    }
}
