<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminUserController extends Controller
{
    /**
     * Tampilkan daftar admin/user.
     */
    public function index()
    {
        // Hanya Super Admin DPN yang bisa melihat daftar admin
        if (!Auth::user()->isDpn()) {
            return redirect()->route('dashboard')->with('error', 'Akses ditolak. Anda tidak memiliki izin.');
        }

        $users = User::where('role', '!=', 'pelaku_usaha')->orderBy('created_at', 'desc')->get();
        return view('admin_dpn.users.index', compact('users'));
    }

    /**
     * Tampilkan form untuk membuat admin baru.
     */
    public function create()
    {
        if (!Auth::user()->isDpn()) {
            return redirect()->route('dashboard')->with('error', 'Akses ditolak.');
        }

        return view('admin_dpn.users.create');
    }

    /**
     * Simpan admin baru ke database.
     */
    public function store(Request $request)
    {
        if (!Auth::user()->isDpn()) {
            return redirect()->route('dashboard')->with('error', 'Akses ditolak.');
        }

        $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'name' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|string|in:dpn,bpn,dinas_pu,dinas_putr,satu_pintu,admin_berita,pelaku_usaha',
        ]);

        User::create([
            'username' => $request->username,
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'is_active' => true,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Akun berhasil dibuat.');
    }

    /**
     * Tampilkan form untuk edit admin.
     */
    public function edit($id)
    {
        if (!Auth::user()->isDpn()) {
            return redirect()->route('dashboard')->with('error', 'Akses ditolak.');
        }

        $user = User::findOrFail($id);
        return view('admin_dpn.users.edit', compact('user'));
    }

    /**
     * Update admin di database.
     */
    public function update(Request $request, $id)
    {
        if (!Auth::user()->isDpn()) {
            return redirect()->route('dashboard')->with('error', 'Akses ditolak.');
        }

        $user = User::findOrFail($id);

        $request->validate([
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'name' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
            'role' => 'required|string|in:dpn,bpn,dinas_pu,dinas_putr,satu_pintu,admin_berita,pelaku_usaha',
            'is_active' => 'required|boolean',
        ]);

        $data = [
            'username' => $request->username,
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'role' => $request->role,
            'is_active' => $request->is_active,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')->with('success', 'Akun berhasil diperbarui.');
    }

    /**
     * Hapus admin dari database.
     */
    public function destroy($id)
    {
        if (!Auth::user()->isDpn()) {
            return redirect()->route('dashboard')->with('error', 'Akses ditolak.');
        }

        $user = User::findOrFail($id);
        
        // Mencegah admin menghapus dirinya sendiri
        if ($user->id === Auth::id()) {
            return redirect()->route('admin.users.index')->with('error', 'Tidak dapat menghapus akun Anda sendiri.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Akun berhasil dihapus.');
    }
}
