<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Tampilkan halaman registrasi.
     */
    public function showRegister()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.register');
    }

    /**
     * Proses registrasi Pelaku Usaha.
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|alpha_dash|min:4|max:50|unique:users,username',
            'phone_number' => 'required|string|min:9|max:15|unique:users,phone_number',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'username.required' => 'Username wajib diisi.',
            'username.unique' => 'Username sudah terdaftar.',
            'username.alpha_dash' => 'Username hanya boleh berisi huruf, angka, strip, dan underscore.',
            'phone_number.required' => 'Nomor telepon wajib diisi.',
            'phone_number.unique' => 'Nomor telepon sudah terdaftar.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal terdiri dari 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Buat user dengan role pelaku_usaha
        $user = User::create([
            'username' => strtolower($request->username),
            'phone_number' => $request->phone_number,
            'password' => Hash::make($request->password),
            'role' => 'pelaku_usaha',
        ]);

        // Login otomatis
        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'Registrasi berhasil! Selamat datang di dashboard Anda.');
    }

    /**
     * Tampilkan halaman login.
     */
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    /**
     * Proses login.
     */
    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ], [
            'login.required' => 'Username, No Telepon, atau Email wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        $login = $request->input('login');
        $password = $request->input('password');

        // Deteksi field login (email, phone_number, atau username)
        if (filter_var($login, FILTER_VALIDATE_EMAIL)) {
            $field = 'email';
        } elseif (is_numeric($login)) {
            $field = 'phone_number';
        } else {
            $field = 'username';
        }

        if (Auth::attempt([$field => $login, 'password' => $password], $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'))->with('success', 'Berhasil masuk ke sistem.');
        }

        return redirect()->back()->withErrors([
            'login' => 'Kredensial yang Anda masukkan salah.',
        ])->withInput();
    }

    /**
     * Tampilkan halaman profil terpisah.
     */
    public function showProfile()
    {
        return view('profile');
    }

    /**
     * Update profil pelaku usaha.
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'name' => 'nullable|string|max:100',
            'email' => 'nullable|email|unique:users,email,' . $user->id,
            'address' => 'nullable|string|max:500',
            'business_name' => 'nullable|string|max:150',
            'business_role' => 'nullable|string|max:100',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan oleh pengguna lain.',
            'profile_photo.image' => 'Berkas harus berupa gambar.',
            'profile_photo.mimes' => 'Format foto harus jpeg, png, jpg, gif, atau svg.',
            'profile_photo.max' => 'Ukuran foto maksimal adalah 2MB.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Ambil data teks
        $data = $request->only([
            'name', 'email', 'address', 'business_name', 'business_role'
        ]);

        // Tangani unggahan foto
        if ($request->hasFile('profile_photo')) {
            // Hapus foto lama jika ada di storage
            if ($user->profile_photo && \Storage::disk('public')->exists($user->profile_photo)) {
                \Storage::disk('public')->delete($user->profile_photo);
            }

            // Simpan foto baru ke public disk
            $path = $request->file('profile_photo')->store('profile_photos', 'public');
            $data['profile_photo'] = $path;
        }

        // Update data
        $user->update($data);

        return redirect()->route('profile')->with('success', 'Profil Anda berhasil diperbarui!');
    }

    /**
     * Proses logout.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'Anda telah keluar dari sistem.');
    }
}
