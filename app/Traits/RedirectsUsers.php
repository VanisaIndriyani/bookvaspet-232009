<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait RedirectsUsers
{
    /**
     * Tentukan rute redirect berdasarkan role pengguna.
     */
    protected function redirectTo()
    {
        if (Auth::user()->role === 'vet') {
            return route('vet.dashboard'); // Rute untuk Dokter Hewan
        }

        return route('owner.dashboard'); // Rute untuk Pemilik Hewan (Default)
    }
}