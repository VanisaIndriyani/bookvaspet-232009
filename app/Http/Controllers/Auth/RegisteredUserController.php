<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered; // Import event Registered
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Menampilkan tampilan form registrasi.
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Menangani permintaan registrasi masuk.
     */
        public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            // ... (Kode validasi tetap sama)
        ]);

        // 2. Membuat Pengguna Baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'owner',
        ]);
        
        // Memanggil event Registered (penting untuk verifikasi email)
        event(new Registered($user)); 

        // 3. Hapus atau Komentar baris Auth::login($user);
        // Auth::login($user); // Baris ini TIDAK digunakan

        // 4. Arahkan pengguna ke halaman login dengan pesan sukses
        return redirect()->route('login')->with('success', 'Pendaftaran berhasil! Silakan masuk untuk melanjutkan.');
    }
}