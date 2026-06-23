<?php

namespace App\Http\Controllers;

use App\Models\Holiday;
use Illuminate\Http\Request;

class HolidayController extends Controller
{
    public function index()
    {
        if (!auth()->user()->isDpn() && !auth()->user()->isBpn()) {
            abort(403, 'Akses ditolak.');
        }

        $holidays = Holiday::orderBy('date', 'desc')->get();
        return view('admin_dpn.holidays', compact('holidays'));
    }

    public function store(Request $request)
    {
        if (!auth()->user()->isDpn() && !auth()->user()->isBpn()) {
            abort(403, 'Akses ditolak.');
        }

        $request->validate([
            'date' => 'required|date|unique:holidays,date',
            'name' => 'required|string|max:255',
            'is_collective_leave' => 'nullable|boolean',
        ], [
            'date.unique' => 'Tanggal libur ini sudah ada di database.'
        ]);

        Holiday::create([
            'date' => $request->date,
            'name' => $request->name,
            'is_collective_leave' => $request->has('is_collective_leave'),
        ]);

        return redirect()->back()->with('success', 'Hari libur berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        if (!auth()->user()->isDpn() && !auth()->user()->isBpn()) {
            abort(403, 'Akses ditolak.');
        }

        $holiday = Holiday::findOrFail($id);
        $holiday->delete();

        return redirect()->back()->with('success', 'Hari libur berhasil dihapus.');
    }
}
