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
    public function index(Request $request)
    {
        // Hanya Super Admin DPN yang bisa melihat daftar pelaku usaha secara spesifik
        if (!Auth::user()->isDpn()) {
            return redirect()->route('dashboard')->with('error', 'Akses ditolak. Anda tidak memiliki izin.');
        }

        $query = User::where('role', 'pelaku_usaha');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('username', 'like', "%{$search}%")
                  ->orWhere('phone_number', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Ambil user dengan role pelaku_usaha berpaginasi
        $users = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();
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
            'email' => 'nullable|email|max:255|unique:users,email,' . $user->id,
            'phone_number' => 'nullable|string|max:20',
            'is_active' => 'required|boolean',
            'password' => 'nullable|string|min:6',
        ]);

        $data = [
            'username' => $request->username,
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'is_active' => $request->is_active,
        ];

        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.pelaku_usaha.index')->with('success', 'Data pelaku usaha berhasil diperbarui.');
    }

    /**
     * Hapus pelaku usaha.
     */
    public function destroy($id)
    {
        if (!Auth::user()->isDpn()) {
            return redirect()->route('dashboard')->with('error', 'Akses ditolak.');
        }

        $user = User::findOrFail($id);

        if ($user->role !== 'pelaku_usaha') {
            return redirect()->route('admin.pelaku_usaha.index')->with('error', 'Akses ditolak.');
        }

        $user->delete();

        return redirect()->route('admin.pelaku_usaha.index')->with('success', 'Akun pelaku usaha berhasil dihapus.');
    }

    /**
     * Hapus masal (bulk delete via checklist) pelaku usaha.
     */
    public function bulkDestroy(Request $request)
    {
        if (!Auth::user()->isDpn()) {
            return redirect()->route('dashboard')->with('error', 'Akses ditolak.');
        }

        $ids = $request->input('user_ids', []);

        if (empty($ids)) {
            return redirect()->route('admin.pelaku_usaha.index')->with('error', 'Silakan centang pengguna yang ingin dihapus terlebih dahulu.');
        }

        $count = User::whereIn('id', $ids)->where('role', 'pelaku_usaha')->delete();

        return redirect()->route('admin.pelaku_usaha.index')->with('success', "{$count} akun pengguna berhasil dihapus.");
    }
}
