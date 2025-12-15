<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Animal;
use App\Models\Vaccination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users' => User::count(),
            'total_pengguna' => User::where('role', 'pengguna')->count(),
            'total_dokter' => User::where('role', 'dokter_hewan')->count(),
            'verified_users' => User::whereNotNull('email_verified_at')->count(),
            'unverified_users' => User::whereNull('email_verified_at')->count(),
            'total_animals' => Animal::count(),
            'total_vaccinations' => Vaccination::count(),
            // Statistik Transaksi
            'total_transactions' => Vaccination::whereNotNull('amount')->count(),
            'total_pending' => Vaccination::where('payment_status', 'pending')->whereNotNull('amount')->count(),
            'total_paid' => Vaccination::where('payment_status', 'paid')->count(),
            'total_verified' => Vaccination::where('payment_status', 'verified')->count(),
            'total_rejected' => Vaccination::where('payment_status', 'rejected')->count(),
            'total_revenue' => Vaccination::where('payment_status', 'verified')->sum('amount'),
        ];

        // Data untuk chart distribusi role
        $roleData = [
            'labels' => ['Pengguna', 'Dokter Hewan'],
            'data' => [
                $stats['total_pengguna'],
                $stats['total_dokter']
            ]
        ];

        // Data untuk chart status verifikasi
        $verificationData = [
            'labels' => ['Terverifikasi', 'Belum Verifikasi'],
            'data' => [
                $stats['verified_users'],
                $stats['unverified_users']
            ]
        ];

        // Data vaksinasi per bulan (6 bulan terakhir)
        $vaccinationMonthly = Vaccination::select(
            DB::raw('MONTH(tanggal_vaksin) as month'),
            DB::raw('YEAR(tanggal_vaksin) as year'),
            DB::raw('COUNT(*) as count')
        )
        ->where('tanggal_vaksin', '>=', now()->subMonths(6))
        ->groupBy('year', 'month')
        ->orderBy('year', 'asc')
        ->orderBy('month', 'asc')
        ->get();

        $monthLabels = [];
        $monthData = [];
        foreach ($vaccinationMonthly as $item) {
            $monthLabels[] = date('M Y', mktime(0, 0, 0, $item->month, 1, $item->year));
            $monthData[] = $item->count;
        }

        // Data jenis vaksin
        $vaccineTypes = Vaccination::select('jenis_vaksin', DB::raw('COUNT(*) as count'))
            ->groupBy('jenis_vaksin')
            ->get();

        $vaccineLabels = $vaccineTypes->pluck('jenis_vaksin')->toArray();
        $vaccineData = $vaccineTypes->pluck('count')->toArray();

        // Data transaksi per metode pembayaran
        $paymentMethods = Vaccination::select('payment_method', DB::raw('COUNT(*) as count'))
            ->whereNotNull('payment_method')
            ->groupBy('payment_method')
            ->get();

        $paymentMethodLabels = $paymentMethods->pluck('payment_method')->toArray();
        $paymentMethodData = $paymentMethods->pluck('count')->toArray();

        // Data transaksi per status
        $transactionStatus = [
            'labels' => ['Pending', 'Paid', 'Verified', 'Rejected'],
            'data' => [
                $stats['total_pending'],
                $stats['total_paid'],
                $stats['total_verified'],
                $stats['total_rejected']
            ]
        ];

        // Transaksi terbaru
        $recentTransactions = Vaccination::with('animal.user')
            ->whereNotNull('amount')
            ->latest()
            ->take(10)
            ->get();

        return view('admin.reports.index', compact(
            'stats', 
            'roleData', 
            'verificationData', 
            'monthLabels', 
            'monthData', 
            'vaccineLabels', 
            'vaccineData',
            'paymentMethodLabels',
            'paymentMethodData',
            'transactionStatus',
            'recentTransactions'
        ));
    }
}

