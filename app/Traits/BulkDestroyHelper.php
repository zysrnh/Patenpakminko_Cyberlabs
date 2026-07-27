<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

trait BulkDestroyHelper
{
    /**
     * Bulk delete records by IDs (DPN only).
     * Controller using this trait must define $bulkModel and $bulkRedirectRoute and optionally $bulkFileFields.
     */
    public function bulkDestroy(Request $request)
    {
        if (!Auth::user()->isDpn()) {
            abort(403, 'Hanya Super Admin DPN yang dapat melakukan hapus massal.');
        }

        $ids = $request->input('ids', []);

        if (empty($ids)) {
            return redirect()->back()->with('error', 'Tidak ada item yang dipilih.');
        }

        $model      = $this->bulkModel;
        $fileFields = $this->bulkFileFields ?? [];
        $route      = $this->bulkRedirectRoute;

        $apps = $model::whereIn('id', $ids)->get();
        $count = $apps->count();

        foreach ($apps as $app) {
            foreach ($fileFields as $field) {
                if (!empty($app->$field)) Storage::delete($app->$field);
            }
            $app->delete();
        }

        return redirect()->route($route)->with('success', "{$count} permohonan berhasil dihapus dari antrean.");
    }
}
