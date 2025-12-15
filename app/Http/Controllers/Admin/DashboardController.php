<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Animal;
use App\Models\Vaccination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index()
    {
        // Get statistics
        $stats = [
            'total_users' => User::count(),
            'total_animals' => Animal::count(),
            'total_vaccinations' => Vaccination::count(),
            'total_veterinarians' => User::where('role', 'dokter_hewan')->count(),
        ];

        // Get recent users (last 5)
        $recent_users = User::latest()->take(5)->get();

        // Sample recent activities (can be replaced with actual activity log)
        $recent_activities = [
            [
                'description' => 'User baru mendaftar: ' . ($recent_users->first()->name ?? 'Unknown'),
                'time' => '5 menit yang lalu'
            ],
            [
                'description' => 'Vaksinasi baru dicatat',
                'time' => '15 menit yang lalu'
            ],
            [
                'description' => 'Data hewan baru ditambahkan',
                'time' => '1 jam yang lalu'
            ],
        ];

        return view('admin.dashboard', compact('stats', 'recent_users', 'recent_activities'));
    }
}

