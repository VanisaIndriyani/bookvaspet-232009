<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;

class SettingController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('admin.settings.index', compact('user'));
    }

    public function updateEmail(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'current_password' => ['required', 'string'],
        ]);

        // Verifikasi password saat ini
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini tidak sesuai.'])->withInput();
        }

        $user->update([
            'email' => $request->email,
        ]);

        return redirect()->route('admin.settings.index')->with('success', 'Email berhasil diperbarui!');
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        // Verifikasi password saat ini
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini tidak sesuai.'])->withInput();
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.settings.index')->with('success', 'Password berhasil diperbarui!');
    }
}

