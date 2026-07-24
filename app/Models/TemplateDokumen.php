<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class TemplateDokumen extends Model
{
    use HasFactory;

    protected $table = 'template_dokumens';

    protected $fillable = [
        'nama_template',
        'kode_template',
        'kategori',
        'file_path',
        'tipe_file',
        'ukuran_file',
        'keterangan',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Helper static untuk mendapatkan full path file template aktif berdasarkan kode.
     * Jika tidak ditemukan atau file tidak ada, kembali ke fallback path default.
     */
    public static function getTemplatePath(string $kode, string $defaultFallbackPath): string
    {
        $template = self::where('kode_template', $kode)->where('is_active', true)->first();

        if ($template && Storage::disk('public')->exists($template->file_path)) {
            return storage_path('app/public/' . $template->file_path);
        }

        return $defaultFallbackPath;
    }

    /**
     * Helper static untuk mendapatkan public asset URL preview file template aktif berdasarkan kode.
     */
    public static function getPreviewUrl(string $kode, string $defaultRelativePath = ''): string
    {
        $template = self::where('kode_template', $kode)->where('is_active', true)->first();

        if ($template && Storage::disk('public')->exists($template->file_path)) {
            return route('public.template.preview', $template->kode_template);
        }

        return asset($defaultRelativePath);
    }
}
