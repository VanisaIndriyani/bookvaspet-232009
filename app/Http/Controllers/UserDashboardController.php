<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Vaccination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = Auth::user();

        if ($user->role === 'dokter_hewan') {
            return redirect()->route('admin.dashboard');
        }

        $totalAnimals = $user->animals()->count();

        $vaccinationQuery = Vaccination::with('animal')
            ->whereHas('animal', fn ($query) => $query->where('user_id', $user->id));

        $totalVaccinations = (clone $vaccinationQuery)->count();

        $upcomingBoosters = (clone $vaccinationQuery)
            ->whereNotNull('tanggal_booster')
            ->whereDate('tanggal_booster', '>=', now())
            ->orderBy('tanggal_booster')
            ->take(4)
            ->get();

        $latestVaccinations = (clone $vaccinationQuery)
            ->orderByDesc('tanggal_vaksin')
            ->take(5)
            ->get();

        $animals = $user->animals()
            ->with(['vaccinations' => fn ($query) => $query->orderByDesc('tanggal_vaksin')])
            ->latest()
            ->take(4)
            ->get();

        // Transaksi yang perlu dibayar
        $pendingPayments = (clone $vaccinationQuery)
            ->whereNotNull('amount')
            ->whereIn('payment_status', ['pending', 'paid'])
            ->orderByDesc('created_at')
            ->take(3)
            ->get();

        $stats = [
            'total_animals' => $totalAnimals,
            'total_vaccinations' => $totalVaccinations,
            'upcoming_boosters' => $upcomingBoosters->count(),
        ];

        $tips = [
            [
                'title' => 'Cek Booster Rabies',
                'desc' => 'Pastikan booster rabies diberikan minimal setahun sekali untuk perlindungan optimal.',
            ],
            [
                'title' => 'Catat Gejala',
                'desc' => 'Jika hewan menunjukkan gejala setelah vaksin, catat dalam aplikasi sesuai tanggalnya.',
            ],
            [
                'title' => 'Jadwalkan Dokter',
                'desc' => 'Konsultasi rutin membantu dokter memantau pertumbuhan dan kesehatan hewan Anda.',
            ],
        ];

        return view('dashboard', compact(
            'user',
            'stats',
            'animals',
            'upcomingBoosters',
            'latestVaccinations',
            'pendingPayments',
            'tips'
        ));
    }
}

