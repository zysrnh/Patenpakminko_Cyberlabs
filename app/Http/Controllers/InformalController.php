<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

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
            'latitude'      => 'nullable',
            'longitude'     => 'nullable',
            'rating'        => 'required|integer|min:1|max:5',
            'name'          => 'nullable|string',
            'comment'       => 'nullable|string'
        ]);

        $isApproved = (int)$request->rating >= 4;

        $data = [
            'user_id'       => auth()->id(), // null jika tidak login
            'name'          => auth()->check() ? auth()->user()->name : ($request->name ?: 'Anonim'),
            'informal_type' => $request->informal_type,
            'latitude'      => $request->latitude ? (string)$request->latitude : null,
            'longitude'     => $request->longitude ? (string)$request->longitude : null,
            'rating'        => (int)$request->rating,
            'comment'       => $request->comment,
            'is_approved'   => $isApproved,
        ];

        if (Schema::hasColumn('informal_ratings', 'phone_number') && $request->has('phone_number')) {
            $data['phone_number'] = auth()->check() ? auth()->user()->phone_number : $request->phone_number;
        }

        \App\Models\InformalRating::create($data);

        return response()->json([
            'success' => true, 
            'message' => $isApproved 
                ? 'Terima kasih atas ulasan Anda! Ulasan Anda telah diterbitkan.' 
                : 'Terima kasih atas ulasan Anda! Ulasan akan dikaji terlebih dahulu oleh Admin DPN.'
        ]);
    }
}
