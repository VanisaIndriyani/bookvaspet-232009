<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class RegisterController extends Controller
{
    /**
     * Menampilkan formulir registrasi (view).
     * Rute: GET /register
     * File View: resources/views/auth/register.blade.php
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('auth.register'); 
    }

    /**
     * Memproses dan menyimpan data user baru ke database.
     * Rute: POST /register
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        // 1. VALIDASI DATA INPUT
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users', 
            'password' => 'required|string|min:8|confirmed', // Memastikan field password cocok dengan password_confirmation
        ], [
            // Pesan error kustom
            'name.required' => 'Nama wajib diisi.',
            'email.unique' => 'Email ini sudah terdaftar.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'password.min' => 'Password minimal harus 8 karakter.',
        ]);

        // 2. MEMBUAT DAN MENYIMPAN USER BARU
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Password harus di-hash menggunakan Hash::make()
        ]);

        // 3. LOGIN OTOMATIS (Opsional: Agar user langsung masuk setelah daftar)
        auth()->login($user);

        // 4. REDIRECT ke halaman tujuan (Sesuai rute /home yang sudah kita buat)
        return redirect()->route('home')->with('success', 'Registrasi berhasil! Selamat datang.');
    }
}