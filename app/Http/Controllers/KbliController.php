<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KbliController extends Controller
{
    /**
     * Search KBLI by code or title (AJAX).
     * Returns max 10 matching results.
     */
    public function search(Request $request)
    {
        $query = trim($request->get('q', ''));

        if (strlen($query) < 2) {
            return response()->json([]);
        }

        $path = storage_path('app/kbli.json');

        if (!file_exists($path)) {
            return response()->json(['error' => 'Data KBLI tidak tersedia.'], 500);
        }

        $data = json_decode(file_get_contents($path), true);

        $results = [];
        $queryLower = strtolower($query);

        foreach ($data as $item) {
            $codeMatch  = str_starts_with($item['code'], $query);
            $titleMatch = str_contains(strtolower($item['title']), $queryLower);

            if ($codeMatch || $titleMatch) {
                $results[] = [
                    'code'  => $item['code'],
                    'title' => $item['title'],
                    'label' => $item['code'] . ' — ' . $item['title'],
                ];
                if (count($results) >= 10) break;
            }
        }

        return response()->json($results);
    }

    /**
     * Get single KBLI by exact code (AJAX).
     */
    public function findByCode(Request $request)
    {
        $code = trim($request->get('code', ''));

        if (empty($code)) {
            return response()->json(null);
        }

        $path = storage_path('app/kbli.json');

        if (!file_exists($path)) {
            return response()->json(null, 500);
        }

        $data = json_decode(file_get_contents($path), true);

        foreach ($data as $item) {
            if ($item['code'] === $code) {
                return response()->json([
                    'code'  => $item['code'],
                    'title' => $item['title'],
                ]);
            }
        }

        return response()->json(null);
    }
}
