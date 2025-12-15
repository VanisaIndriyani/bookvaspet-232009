<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\RedirectsUsers;
use Illuminate\Contracts\Auth\MustVerifyEmail; // Penting: Untuk pengecekan verifikasi

class AuthenticatedSessionController extends Controller
{
    use RedirectsUsers;

    /**
     * Menampilkan tampilan form login.
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Menangani permintaan login masuk.
     */
    public function store(Request $request)
    {
        // 1. Validasi Input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. Coba Proses Login
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            
            $user = Auth::user();

            // 3. Pengecekan Verifikasi Email (Jika Model User mengimplementasikan MustVerifyEmail)
            if ($user instanceof MustVerifyEmail && ! $user->hasVerifiedEmail()) {
                
                // Logout pengguna yang berhasil login tetapi belum verifikasi
                Auth::guard('web')->logout();

                $request->session()->invalidate();
                $request->session()->regenerateToken();

                // Redirect kembali ke halaman login dengan pesan error spesifik
                return redirect()->route('login')->withErrors([
                    // Pesan ini memicu notifikasi merah di login.blade.php
                    'email' => 'Akun Anda nonaktif. Silakan aktifkan terlebih dahulu.',
                ]);
            }
            
            // 4. Jika SUDAH VERIFIKASI: Lanjutkan proses login dan redirect ke dashboard
            $request->session()->regenerate();

            // Redirect ke dashboard
            return redirect()->intended(route('dashboard'));
        }

        // 5. Gagal Login (Kredensial tidak valid)
        return back()->withErrors([
            'email' => 'Email atau Password yang Anda masukkan tidak valid.',
        ])->onlyInput('email');
    }

    /**
     * Menghancurkan (logout) sesi autentikasi.
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}