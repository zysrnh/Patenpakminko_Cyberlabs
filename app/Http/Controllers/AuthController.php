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
            'username' => 'required|string|alpha_dash|min:4|max:50|unique:users,username,' . $user->id,
            'phone_number' => 'required|string|min:9|max:15|unique:users,phone_number,' . $user->id,
            'name' => 'nullable|string|max:100',
            'email' => 'nullable|email|unique:users,email,' . $user->id,
            'address' => 'nullable|string|max:500',
            'business_name' => 'nullable|string|max:150',
            'business_role' => 'nullable|string|max:100',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'username.required' => 'Username wajib diisi.',
            'username.unique' => 'Username sudah digunakan oleh pengguna lain.',
            'username.alpha_dash' => 'Username hanya boleh berisi huruf, angka, strip, dan underscore.',
            'username.min' => 'Username minimal terdiri dari 4 karakter.',
            'phone_number.required' => 'Nomor WhatsApp wajib diisi.',
            'phone_number.unique' => 'Nomor WhatsApp sudah digunakan oleh pengguna lain.',
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
            'username', 'phone_number', 'name', 'email', 'address', 'business_name', 'business_role'
        ]);
        $data['username'] = strtolower($data['username']);

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
 
    /**
     * Tampilkan halaman lupa password.
     */
    public function showForgotPassword()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.forgot-password');
    }
 
    /**
     * Proses pengiriman OTP via WhatsApp.
     */
    public function sendOtp(Request $request)
    {
        $request->validate([
            'identifier' => 'required|string',
        ], [
            'identifier.required' => 'Username atau nomor WhatsApp wajib diisi.',
        ]);
 
        $identifier = $request->input('identifier');
 
        // Cari user berdasarkan username ATAU phone_number
        $user = User::where('username', strtolower($identifier))
            ->orWhere('phone_number', $identifier)
            ->first();
 
        if (!$user) {
            return redirect()->back()->with('error', 'Username atau nomor WhatsApp tidak terdaftar dalam sistem.')->withInput();
        }
 
        if (empty($user->phone_number)) {
            return redirect()->back()->with('error', 'Akun Anda tidak memiliki nomor WhatsApp yang terdaftar.')->withInput();
        }
 
        // Generate 6 digit OTP acak
        $otp = (string) rand(100000, 999999);
 
        // Simpan data OTP di Session (Valid selama 10 menit)
        session([
            'reset_otp' => $otp,
            'reset_user_id' => $user->id,
            'reset_otp_expires_at' => now()->addMinutes(10)
        ]);
 
        // Siapkan pesan notifikasi WhatsApp OTP
        $name = $user->name ?? $user->username;
        $message = "Halo *{$name}*,\n\n"
                 . "Berikut adalah Kode OTP untuk menyetel ulang password akun PATENPAKMIKO Anda:\n\n"
                 . "💬 Kode OTP: *{$otp}*\n\n"
                 . "Kode ini berlaku selama *10 menit*. Mohon untuk tidak membagikan kode ini kepada siapapun demi keamanan akun Anda.";
 
        // Kirim WhatsApp via Fonnte
        $this->executeFonnteSend($user->phone_number, $message);
 
        return redirect()->route('password.otp.verify.form')->with('success', 'Kode OTP berhasil dikirim via WhatsApp ke nomor ' . $user->phone_number . '.');
    }
 
    /**
     * Tampilkan halaman verifikasi OTP.
     */
    public function showVerifyOtp()
    {
        if (!session()->has('reset_user_id') || !session()->has('reset_otp')) {
            return redirect()->route('password.request')->with('error', 'Silakan masukkan username atau nomor WhatsApp Anda terlebih dahulu.');
        }
        return view('auth.verify-otp');
    }
 
    /**
     * Verifikasi kode OTP dari user.
     */
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|string|size:6',
        ], [
            'otp.required' => 'Kode OTP wajib diisi.',
            'otp.size' => 'Kode OTP harus terdiri dari 6 digit.',
        ]);
 
        $userOtp = $request->input('otp');
        $sessionOtp = session('reset_otp');
        $expiresAt = session('reset_otp_expires_at');
 
        if (!$sessionOtp || !$expiresAt || now()->gt($expiresAt)) {
            return redirect()->route('password.request')->with('error', 'Kode OTP telah kedaluwarsa atau tidak valid. Silakan kirim ulang.');
        }
 
        if ($userOtp !== $sessionOtp) {
            return redirect()->back()->with('error', 'Kode OTP yang Anda masukkan salah.');
        }
 
        // Tandai OTP telah sukses diverifikasi
        session(['otp_verified' => true]);
 
        return redirect()->route('password.reset.form')->with('success', 'Verifikasi OTP berhasil! Silakan masukkan password baru Anda.');
    }
 
    /**
     * Tampilkan halaman reset password baru.
     */
    public function showResetPassword()
    {
        if (!session('otp_verified')) {
            return redirect()->route('password.request')->with('error', 'Silakan lakukan verifikasi OTP terlebih dahulu.');
        }
        return view('auth.reset-password');
    }
 
    /**
     * Proses reset/update password baru.
     */
    public function resetPassword(Request $request)
    {
        if (!session('otp_verified')) {
            return redirect()->route('password.request')->with('error', 'Sesi verifikasi Anda telah kedaluwarsa.');
        }
 
        $request->validate([
            'password' => 'required|string|min:6|confirmed',
        ], [
            'password.required' => 'Password baru wajib diisi.',
            'password.min' => 'Password minimal terdiri dari 6 karakter.',
            'password.confirmed' => 'Konfirmasi password baru tidak cocok.',
        ]);
 
        $userId = session('reset_user_id');
        $user = User::findOrFail($userId);
        $newPassword = $request->input('password');
 
        // Update password baru
        $user->password = Hash::make($newPassword);
        $user->save();
 
        // Kirim WhatsApp konfirmasi password baru
        if (!empty($user->phone_number)) {
            $name = $user->name ?? $user->username;
            $message = "Halo *{$name}*,\n\n"
                     . "Password akun PATENPAKMIKO Anda telah berhasil disetel ulang!\n\n"
                     . "Berikut adalah Kredensial Login Anda:\n"
                     . "👤 Username: *{$user->username}*\n"
                     . "🔑 Password Baru: *{$newPassword}*\n\n"
                     . "Simpan pesan ini dengan baik dan jangan sebarkan password Anda kepada siapa pun demi keamanan.\n"
                     . "Link login: " . route('login');
                     
            $this->executeFonnteSend($user->phone_number, $message);
        }
 
        // Bersihkan session OTP
        session()->forget(['reset_otp', 'reset_user_id', 'reset_otp_expires_at', 'otp_verified']);
 
        return redirect()->route('login')->with('success', 'Password Anda berhasil diperbarui! Kredensial login baru telah dikirimkan ke WhatsApp Anda.');
    }
 
    /**
     * Helper: Mendapatkan pengaturan WhatsApp.
     */
    private function getWhatsappSettings()
    {
        $path = storage_path('app/whatsapp_settings.json');
        if (file_exists($path)) {
            return json_decode(file_get_contents($path), true);
        }
        return [
            'connected' => true,
            'fonnte_token' => '',
        ];
    }
 
    /**
     * Kirim notifikasi WA ke Fonnte API dan catat ke JSON log.
     */
    private function executeFonnteSend($phone, $message)
    {
        $settings = $this->getWhatsappSettings();
        $statusText = 'Simulasi';
 
        if (!empty($settings['fonnte_token'])) {
            $recipientClean = preg_replace('/[^0-9]/', '', $phone);
            if (str_starts_with($recipientClean, '0')) {
                $recipientClean = '62' . substr($recipientClean, 1);
            }
 
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.fonnte.com/send',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 20,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array(
                    'target' => $recipientClean,
                    'message' => $message,
                ),
                CURLOPT_HTTPHEADER => array(
                    'Authorization: ' . $settings['fonnte_token']
                ),
            ));
            
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
 
            if (!$err) {
                $fonnteResponse = json_decode($response, true);
                if (isset($fonnteResponse['status']) && $fonnteResponse['status'] == true) {
                    $statusText = 'Terkirim (Fonnte API)';
                } else {
                    $statusText = 'Gagal (Fonnte: ' . ($fonnteResponse['reason'] ?? 'Kesalahan Token') . ')';
                }
            } else {
                $statusText = 'Gagal (Koneksi API Error)';
            }
        }
 
        $logPath = storage_path('app/whatsapp_logs.json');
        $logs = [];
        if (file_exists($logPath)) {
            $logs = json_decode(file_get_contents($logPath), true) ?: [];
        }
 
        $newLog = [
            'id' => uniqid(),
            'recipient' => $phone,
            'message' => $message,
            'timestamp' => now()->format('d M Y, H:i:s'),
            'status' => $statusText,
        ];
 
        array_unshift($logs, $newLog);
        file_put_contents($logPath, json_encode($logs, JSON_PRETTY_PRINT));
    }
}
