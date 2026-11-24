<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SiteSetting extends Model
{
    protected $table = 'site_settings';
    protected $fillable = ['key', 'value'];

    /**
     * Ambil nilai setting berdasarkan key.
     */
    public static function get(string $key, $default = null)
    {
        try {
            if (!Schema::hasTable('site_settings')) {
                return $default;
            }
            $setting = static::where('key', $key)->first();
            return $setting ? $setting->value : $default;
        } catch (\Throwable $e) {
            return $default;
        }
    }

    /**
     * Set nilai setting.
     */
    public static function set(string $key, $value): void
    {
        try {
            if (Schema::hasTable('site_settings')) {
                static::updateOrCreate(['key' => $key], ['value' => (string)$value]);
            }
        } catch (\Throwable $e) {
            // Silently fallback
        }
    }

    /**
     * Increment angka pengunjung secara aman & atomic di database.
     */
    public static function incrementVisitor(): int
    {
        try {
            if (!Schema::hasTable('site_settings')) {
                return 2800;
            }

            // Gunakan atomic increment di level MySQL
            $affected = DB::table('site_settings')
                ->where('key', 'visitor_count')
                ->increment('value');

            if (!$affected) {
                static::set('visitor_count', '2801');
                return 2801;
            }

            return (int) static::get('visitor_count', 2800);
        } catch (\Throwable $e) {
            return 2800;
        }
    }
}
