@extends('layouts.admin')

@section('title', 'Dokter Hewan')
@section('page-title', 'Dokter Hewan')

@section('content')
<div class="mb-6">
    <h2 class="text-2xl font-bold text-gray-800">
        <i class="fas fa-user-md text-pink-600 mr-2"></i>
        Daftar Dokter Hewan
    </h2>
    <p class="text-gray-600 mt-1">Daftar semua dokter hewan yang terdaftar</p>
</div>

<div class="bg-white rounded-xl shadow-md overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-pink-50">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase">Nama</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase">Email</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase">Status</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase">Terdaftar</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($veterinarians as $vet)
                <tr class="hover:bg-pink-50">
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-pink-100 rounded-full flex items-center justify-center mr-3">
                                <i class="fas fa-user-md text-pink-600"></i>
                            </div>
                            <span class="font-medium">{{ $vet->name }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-gray-600">{{ $vet->email }}</td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $vet->email_verified_at ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                            {{ $vet->email_verified_at ? 'Aktif' : 'Belum Verifikasi' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500">{{ $vet->created_at->format('d M Y') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                        <i class="fas fa-user-md text-5xl text-gray-300 mb-4"></i>
                        <p>Tidak ada dokter hewan terdaftar</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($veterinarians->hasPages())
    <div class="px-6 py-4 border-t">
        {{ $veterinarians->links() }}
    </div>
    @endif
</div>
@endsection

