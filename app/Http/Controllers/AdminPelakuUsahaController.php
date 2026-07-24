<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminPelakuUsahaController extends Controller
{
    /**
     * Tampilkan daftar pelaku usaha.
     */
    public function index()
    {
        // Hanya Super Admin DPN yang bisa melihat daftar pelaku usaha secara spesifik
        if (!Auth::user()->isDpn()) {
            return redirect()->route('dashboard')->with('error', 'Akses ditolak. Anda tidak memiliki izin.');
        }

        // Ambil hanya user dengan role pelaku_usaha
        $users = User::where('role', 'pelaku_usaha')->orderBy('created_at', 'desc')->get();
        return view('admin_dpn.pelaku_usaha.index', compact('users'));
    }

    /**
     * Tampilkan form edit pelaku usaha.
     */
    public function edit($id)
    {
        if (!Auth::user()->isDpn()) {
            return redirect()->route('dashboard')->with('error', 'Akses ditolak.');
        }

        $user = User::findOrFail($id);
        
        if ($user->role !== 'pelaku_usaha') {
            return redirect()->route('admin.pelaku_usaha.index')->with('error', 'Akses ditolak. Ini bukan akun pelaku usaha.');
        }

        return view('admin_dpn.pelaku_usaha.edit', compact('user'));
    }

    /**
     * Update data pelaku usaha.
     */
    public function update(Request $request, $id)
    {
        if (!Auth::user()->isDpn()) {
            return redirect()->route('dashboard')->with('error', 'Akses ditolak.');
        }

        $user = User::findOrFail($id);

        if ($user->role !== 'pelaku_usaha') {
            return redirect()->route('admin.pelaku_usaha.index')->with('error', 'Akses ditolak. Ini bukan akun pelaku usaha.');
        }

        $request->validate([
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'name' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
            'is_active' => 'required|boolean',
        ]);

        $data = [
            'username' => $request->username,
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'is_active' => $request->is_active,
        ];

        if ($request->filled('password')) {
            $data['password'] = \Illuminate\Support\Facades\Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.pelaku_usaha.index')->with('success', 'Akun pelaku usaha berhasil diperbarui.');
    }

    /**
     * Hapus pelaku usaha dari database.
     */
    public function destroy($id)
    {
        if (!Auth::user()->isDpn()) {
            return redirect()->route('dashboard')->with('error', 'Akses ditolak.');
        }

        $user = User::findOrFail($id);
        
        // Memastikan yang dihapus adalah pelaku usaha
        if ($user->role !== 'pelaku_usaha') {
            return redirect()->route('admin.pelaku_usaha.index')->with('error', 'Hanya dapat menghapus akun pelaku usaha.');
        }

        $user->delete();

        return redirect()->route('admin.pelaku_usaha.index')->with('success', 'Akun Pelaku Usaha berhasil dihapus.');
    }
}
