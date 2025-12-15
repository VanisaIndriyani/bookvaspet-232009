@extends('layouts.admin')

@section('title', 'Manajemen User')
@section('page-title', 'Manajemen User')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h2 class="text-2xl font-bold text-gray-800">
            <i class="fas fa-users text-pink-600 mr-2"></i>
            Daftar Pengguna
        </h2>
        <p class="text-gray-600 mt-1">Kelola semua pengguna sistem</p>
    </div>
    <a href="{{ route('admin.users.create') }}" class="bg-pink-500 hover:bg-pink-600 text-white px-6 py-3 rounded-lg font-semibold transition shadow-md">
        <i class="fas fa-user-plus mr-2"></i>
        Tambah User Baru
    </a>
</div>

<div class="bg-white rounded-xl shadow-md overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-pink-50">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                        <i class="fas fa-user mr-2"></i>Nama
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                        <i class="fas fa-envelope mr-2"></i>Email
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                        <i class="fas fa-user-tag mr-2"></i>Role
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                        <i class="fas fa-check-circle mr-2"></i>Status
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                        <i class="fas fa-calendar mr-2"></i>Terdaftar
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                        <i class="fas fa-cog mr-2"></i>Aksi
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($users as $user)
                <tr class="hover:bg-pink-50 transition">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-pink-100 rounded-full flex items-center justify-center mr-3">
                                <i class="fas fa-user text-pink-600"></i>
                            </div>
                            <div>
                                <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-500">{{ $user->email }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-3 py-1 text-xs font-semibold rounded-full 
                            {{ $user->role === 'admin' ? 'bg-pink-200 text-pink-800' : 
                               ($user->role === 'dokter_hewan' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800') }}">
                            <i class="fas {{ $user->role === 'admin' ? 'fa-crown' : ($user->role === 'dokter_hewan' ? 'fa-user-md' : 'fa-user') }} mr-1"></i>
                            {{ ucfirst(str_replace('_', ' ', $user->role)) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-3 py-1 text-xs font-semibold rounded-full 
                            {{ $user->email_verified_at ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                            <i class="fas {{ $user->email_verified_at ? 'fa-check-circle' : 'fa-clock' }} mr-1"></i>
                            {{ $user->email_verified_at ? 'Terverifikasi' : 'Belum Verifikasi' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $user->created_at->format('d M Y') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex items-center space-x-3">
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="text-pink-600 hover:text-pink-900">
                                <i class="fas fa-edit"></i>
                            </a>
                            @if($user->id !== auth()->id())
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center">
                        <i class="fas fa-inbox text-5xl text-gray-300 mb-4"></i>
                        <p class="text-gray-500">Tidak ada data pengguna</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($users->hasPages())
    <div class="px-6 py-4 border-t border-gray-200">
        {{ $users->links() }}
    </div>
    @endif
</div>
@endsection

