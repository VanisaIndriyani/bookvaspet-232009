@extends('layouts.admin')

@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard Admin')

@section('content')
<!-- Statistics Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
    <!-- Total Users -->
    <div class="bg-white rounded-xl shadow-md p-6 card-hover border-l-4 border-pink-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-600 mb-1">Total Pengguna</p>
                <p class="text-3xl font-bold text-gray-800">{{ $stats['total_users'] ?? 0 }}</p>
                <p class="text-xs text-pink-600 mt-2">
                    <i class="fas fa-arrow-up"></i> +12% dari bulan lalu
                </p>
            </div>
            <div class="w-16 h-16 bg-pink-100 rounded-full flex items-center justify-center">
                <i class="fas fa-users text-pink-500 text-2xl"></i>
            </div>
        </div>
    </div>

    <!-- Total Animals -->
    <div class="bg-white rounded-xl shadow-md p-6 card-hover border-l-4 border-pink-400">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-600 mb-1">Total Hewan</p>
                <p class="text-3xl font-bold text-gray-800">{{ $stats['total_animals'] ?? 0 }}</p>
                <p class="text-xs text-pink-600 mt-2">
                    <i class="fas fa-arrow-up"></i> +8% dari bulan lalu
                </p>
            </div>
            <div class="w-16 h-16 bg-pink-100 rounded-full flex items-center justify-center">
                <i class="fas fa-paw text-pink-500 text-2xl"></i>
            </div>
        </div>
    </div>

    <!-- Total Vaccinations -->
    <div class="bg-white rounded-xl shadow-md p-6 card-hover border-l-4 border-pink-300">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-600 mb-1">Total Vaksinasi</p>
                <p class="text-3xl font-bold text-gray-800">{{ $stats['total_vaccinations'] ?? 0 }}</p>
                <p class="text-xs text-pink-600 mt-2">
                    <i class="fas fa-arrow-up"></i> +15% dari bulan lalu
                </p>
            </div>
            <div class="w-16 h-16 bg-pink-100 rounded-full flex items-center justify-center">
                <i class="fas fa-syringe text-pink-500 text-2xl"></i>
            </div>
        </div>
    </div>

    <!-- Total Veterinarians -->
    <div class="bg-white rounded-xl shadow-md p-6 card-hover border-l-4 border-pink-600">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-600 mb-1">Dokter Hewan</p>
                <p class="text-3xl font-bold text-gray-800">{{ $stats['total_veterinarians'] ?? 0 }}</p>
                <p class="text-xs text-pink-600 mt-2">
                    <i class="fas fa-arrow-up"></i> +5% dari bulan lalu
                </p>
            </div>
            <div class="w-16 h-16 bg-pink-100 rounded-full flex items-center justify-center">
                <i class="fas fa-user-md text-pink-500 text-2xl"></i>
            </div>
        </div>
    </div>
</div>

<!-- Main Content Grid -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Recent Activities -->
    <div class="lg:col-span-2 bg-white rounded-xl shadow-md p-6 border border-pink-50">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-bold text-gray-800">
                <i class="fas fa-history text-pink-600 mr-2"></i>
                Aktivitas Terkini
            </h2>
            <a href="#" class="text-sm text-pink-600 hover:text-pink-800">Lihat Semua</a>
        </div>
        <div class="space-y-4">
            @forelse($recent_activities ?? [] as $activity)
            <div class="flex items-start space-x-4 p-4 bg-pink-50 rounded-xl hover:bg-pink-100 transition shadow-sm">
                <div class="w-10 h-10 bg-pink-100 rounded-full flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-user text-pink-600"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-800">{{ $activity['description'] ?? 'Aktivitas baru' }}</p>
                    <p class="text-xs text-gray-500 mt-1">{{ $activity['time'] ?? 'Baru saja' }}</p>
                </div>
            </div>
            @empty
            <div class="text-center py-8 text-gray-500">
                <i class="fas fa-inbox text-4xl mb-2"></i>
                <p>Tidak ada aktivitas terkini</p>
            </div>
            @endforelse
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-xl shadow-md p-6 border border-pink-50">
        <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
            <i class="fas fa-bolt text-pink-500 mr-2"></i>
            Tindakan Cepat
        </h2>
        <div class="space-y-3">
            <a href="{{ route('admin.animals.create') }}" class="block w-full bg-pink-500 hover:bg-pink-600 text-white px-4 py-3 rounded-lg text-center font-semibold transition">
                <i class="fas fa-paw mr-2"></i>
                Tambah Data Hewan
            </a>
            <a href="{{ route('admin.vaccinations.create') }}" class="block w-full bg-pink-400 hover:bg-pink-500 text-white px-4 py-3 rounded-lg text-center font-semibold transition">
                <i class="fas fa-syringe mr-2"></i>
                Catat Vaksinasi
            </a>
            <a href="{{ route('admin.reports.index') }}" class="block w-full bg-pink-600 hover:bg-pink-700 text-white px-4 py-3 rounded-lg text-center font-semibold transition">
                <i class="fas fa-chart-line mr-2"></i>
                Lihat Laporan
            </a>
        </div>
    </div>
</div>

<!-- Recent Users Table -->
<div class="mt-6 bg-white rounded-xl shadow-md p-6">
    <div class="mb-6">
        <h2 class="text-xl font-bold text-gray-800">
            <i class="fas fa-users text-pink-600 mr-2"></i>
            Pengguna Terbaru
        </h2>
        <p class="text-sm text-gray-600 mt-1">Daftar pengguna yang baru saja mendaftar</p>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-pink-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Terdaftar</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($recent_users ?? [] as $user)
                <tr class="hover:bg-pink-50/70 transition">
                    <td class="px-4 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-pink-100 rounded-full flex items-center justify-center mr-3">
                                <i class="fas fa-user text-pink-600"></i>
                            </div>
                            <div class="text-sm font-medium text-gray-900">{{ $user->name ?? 'N/A' }}</div>
                        </div>
                    </td>
                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">{{ $user->email ?? 'N/A' }}</td>
                    <td class="px-4 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 text-xs font-semibold rounded-full 
                            {{ ($user->role ?? '') === 'dokter_hewan' ? 'bg-pink-100 text-pink-700' : 'bg-rose-100 text-rose-700' }}">
                            {{ ($user->role ?? '') === 'dokter_hewan' ? 'Dokter Hewan' : 'Pengguna' }}
                        </span>
                    </td>
                    <td class="px-4 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 text-xs font-semibold rounded-full 
                            {{ ($user->email_verified_at ?? null) ? 'bg-pink-100 text-pink-700' : 'bg-rose-100 text-rose-700' }}">
                            {{ ($user->email_verified_at ?? null) ? 'Terverifikasi' : 'Belum Verifikasi' }}
                        </span>
                    </td>
                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $user->created_at->format('d M Y') }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-4 py-8 text-center text-gray-500">
                        <i class="fas fa-inbox text-4xl mb-2 block"></i>
                        Tidak ada data pengguna
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

