@extends('layouts.admin')

@section('title', 'Data Hewan')
@section('page-title', 'Data Hewan')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h2 class="text-2xl font-bold text-gray-800">
            <i class="fas fa-paw text-pink-600 mr-2"></i>
            Daftar Hewan
        </h2>
        <p class="text-gray-600 mt-1">Kelola data hewan peliharaan</p>
    </div>
    <a href="{{ route('admin.animals.create') }}" class="bg-pink-500 hover:bg-pink-600 text-white px-6 py-3 rounded-lg font-semibold transition shadow-md">
        <i class="fas fa-plus mr-2"></i>
        Tambah Hewan
    </a>
</div>

<div class="bg-white rounded-xl shadow-md overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-pink-50">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase">Nama Hewan</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase">Jenis</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase">Ras</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase">Pemilik</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($animals as $animal)
                <tr class="hover:bg-pink-50">
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-pink-100 rounded-full flex items-center justify-center mr-3">
                                <i class="fas fa-paw text-pink-600"></i>
                            </div>
                            <span class="font-medium">{{ $animal->nama }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-gray-600">{{ $animal->jenis }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $animal->ras ?? '-' }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $animal->user->name }}</td>
                    <td class="px-6 py-4">
                        <div class="flex space-x-2">
                            <a href="{{ route('admin.animals.edit', $animal->id) }}" class="text-pink-600 hover:text-pink-900">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.animals.destroy', $animal->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data hewan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                        <i class="fas fa-paw text-5xl text-gray-300 mb-4"></i>
                        <p>Tidak ada data hewan</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($animals->hasPages())
    <div class="px-6 py-4 border-t">
        {{ $animals->links() }}
    </div>
    @endif
</div>
@endsection

