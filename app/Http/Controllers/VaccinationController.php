<?php

namespace App\Http\Controllers;

use App\Models\Vaccination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VaccinationController extends Controller
{
    /**
     * Display a listing of vaccinations for the authenticated user.
     */
    public function index()
    {
        $user = Auth::user();

        // Jika user adalah dokter hewan, redirect ke admin
        if ($user->role === 'dokter_hewan') {
            return redirect()->route('admin.vaccinations.index');
        }

        $vaccinations = Vaccination::with('animal')
            ->whereHas('animal', fn ($query) => $query->where('user_id', $user->id))
            ->orderByDesc('tanggal_vaksin')
            ->paginate(15);

        return view('vaccinations.index', compact('vaccinations'));
    }
}

