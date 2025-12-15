@extends('layouts.admin')

@section('title', 'Laporan & Statistik')
@section('page-title', 'Laporan & Statistik')

@section('content')
<div class="mb-6">
    <h2 class="text-2xl font-bold text-gray-800">
        <i class="fas fa-chart-bar text-pink-600 mr-2"></i>
        Laporan & Statistik Sistem
    </h2>
    <p class="text-gray-600 mt-1">Ringkasan data dan statistik pengguna</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
    <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-pink-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-600 mb-1">Total Pengguna</p>
                <p class="text-3xl font-bold text-gray-800">{{ $stats['total_users'] }}</p>
            </div>
            <div class="w-16 h-16 bg-pink-100 rounded-full flex items-center justify-center">
                <i class="fas fa-users text-pink-500 text-2xl"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-blue-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-600 mb-1">Pengguna Biasa</p>
                <p class="text-3xl font-bold text-gray-800">{{ $stats['total_pengguna'] }}</p>
            </div>
            <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center">
                <i class="fas fa-user text-blue-500 text-2xl"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-green-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-600 mb-1">Dokter Hewan</p>
                <p class="text-3xl font-bold text-gray-800">{{ $stats['total_dokter'] }}</p>
            </div>
            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center">
                <i class="fas fa-user-md text-green-500 text-2xl"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-green-400">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-600 mb-1">Terverifikasi</p>
                <p class="text-3xl font-bold text-gray-800">{{ $stats['verified_users'] }}</p>
            </div>
            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center">
                <i class="fas fa-check-circle text-green-500 text-2xl"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-yellow-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-600 mb-1">Belum Verifikasi</p>
                <p class="text-3xl font-bold text-gray-800">{{ $stats['unverified_users'] }}</p>
            </div>
            <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center">
                <i class="fas fa-clock text-yellow-500 text-2xl"></i>
            </div>
        </div>
    </div>
</div>

<!-- Laporan Transaksi -->
<div class="mb-6 mt-8">
    <h2 class="text-2xl font-bold text-gray-800">
        <i class="fas fa-money-bill-wave text-pink-600 mr-2"></i>
        Laporan Transaksi Pembayaran
    </h2>
    <p class="text-gray-600 mt-1">Statistik dan data transaksi pembayaran vaksinasi</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
    <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-purple-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-600 mb-1">Total Transaksi</p>
                <p class="text-3xl font-bold text-gray-800">{{ $stats['total_transactions'] }}</p>
            </div>
            <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center">
                <i class="fas fa-receipt text-purple-500 text-2xl"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-yellow-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-600 mb-1">Menunggu Pembayaran</p>
                <p class="text-3xl font-bold text-gray-800">{{ $stats['total_pending'] }}</p>
            </div>
            <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center">
                <i class="fas fa-clock text-yellow-500 text-2xl"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-blue-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-600 mb-1">Menunggu Verifikasi</p>
                <p class="text-3xl font-bold text-gray-800">{{ $stats['total_paid'] }}</p>
            </div>
            <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center">
                <i class="fas fa-check-circle text-blue-500 text-2xl"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-green-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-600 mb-1">Total Pendapatan</p>
                <p class="text-2xl font-bold text-gray-800">Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}</p>
            </div>
            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center">
                <i class="fas fa-money-bill-wave text-green-500 text-2xl"></i>
            </div>
        </div>
    </div>
</div>

<!-- Tabel Transaksi Terbaru -->
<div class="bg-white rounded-xl shadow-md overflow-hidden mb-6">
    <div class="px-6 py-4 border-b border-gray-200">
        <h3 class="text-lg font-bold text-gray-800">
            <i class="fas fa-list text-pink-600 mr-2"></i>
            Transaksi Terbaru
        </h3>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-pink-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Hewan & Pemilik</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Jenis Vaksin</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Nominal</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Metode</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Tanggal</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($recentTransactions as $transaction)
                <tr class="hover:bg-pink-50 transition">
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-pink-100 rounded-full flex items-center justify-center mr-3">
                                <i class="fas fa-paw text-pink-600"></i>
                            </div>
                            <div>
                                <div class="font-medium text-gray-900">{{ $transaction->animal->nama }}</div>
                                <div class="text-sm text-gray-500">{{ $transaction->animal->user->name }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-pink-100 text-pink-800">
                            {{ $transaction->jenis_vaksin }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="font-semibold text-gray-900">Rp {{ number_format($transaction->amount, 0, ',', '.') }}</span>
                    </td>
                    <td class="px-6 py-4 text-gray-600">
                        {{ $transaction->payment_method ?? '-' }}
                    </td>
                    <td class="px-6 py-4">
                        @if($transaction->payment_status === 'pending')
                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                <i class="fas fa-clock mr-1"></i>Menunggu
                            </span>
                        @elseif($transaction->payment_status === 'paid')
                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                <i class="fas fa-check-circle mr-1"></i>Sudah Bayar
                            </span>
                        @elseif($transaction->payment_status === 'verified')
                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                <i class="fas fa-check-double mr-1"></i>Terverifikasi
                            </span>
                        @elseif($transaction->payment_status === 'rejected')
                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                <i class="fas fa-times-circle mr-1"></i>Ditolak
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-gray-600">
                        {{ $transaction->created_at->format('d M Y') }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                        <i class="fas fa-money-bill-wave text-5xl text-gray-300 mb-4"></i>
                        <p>Tidak ada transaksi</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

