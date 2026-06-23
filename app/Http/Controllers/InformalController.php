<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InformalController extends Controller
{
    /**
     * Menampilkan halaman peta publik (Informal) yang dibatasi untuk area Sukabumi.
     */
    public function index()
    {
        $ratings = \App\Models\InformalRating::where('is_approved', true)->latest()->get();
        return view('informal.index', compact('ratings'));
    }

    public function storeRating(Request $request)
    {
        $request->validate([
            'informal_type' => 'required|string',
            'latitude' => 'nullable|string',
            'longitude' => 'nullable|string',
            'rating' => 'required|integer|min:1|max:5',
            'name' => 'nullable|string',
            'comment' => 'nullable|string'
        ]);

        $isApproved = $request->rating >= 4;

        \App\Models\InformalRating::create([
            'user_id' => auth()->id(), // null jika tidak login
            'name' => auth()->check() ? auth()->user()->name : $request->name,
            'informal_type' => $request->informal_type,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'is_approved' => $isApproved,
        ]);

        return response()->json(['success' => true, 'message' => 'Terima kasih atas rating Anda!']);
    }
}
