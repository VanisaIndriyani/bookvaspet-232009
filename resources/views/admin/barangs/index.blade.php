@extends('layouts.admin')

@section('title', 'Data Barang')
@section('page-title', 'Data Barang')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h2 class="text-2xl font-bold text-gray-800">
            <i class="fas fa-box text-pink-600 mr-2"></i>
            Daftar Barang
        </h2>
        <p class="text-gray-600 mt-1">Kelola data barang</p>
    </div>
    <a href="{{ route('admin.barangs.create') }}" class="bg-pink-500 hover:bg-pink-600 text-white px-6 py-3 rounded-lg font-semibold transition shadow-md">
        <i class="fas fa-plus mr-2"></i>
        Tambah Barang
    </a>
</div>

@if(session('success'))
<div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
    <span class="block sm:inline">{{ session('success') }}</span>
</div>
@endif

<div class="bg-white rounded-xl shadow-md overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-pink-50">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase">Kode Barang</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase">Nama Barang</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase">Jenis Barang</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($barangs as $barang)
                <tr class="hover:bg-pink-50">
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-pink-100 rounded-full flex items-center justify-center mr-3">
                                <i class="fas fa-box text-pink-600"></i>
                            </div>
                            <span class="font-medium">{{ $barang->kode_barang }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-gray-600">{{ $barang->nama_barang }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $barang->jenis_barang }}</td>
                    <td class="px-6 py-4">
                        <div class="flex space-x-2">
                            <a href="{{ route('admin.barangs.edit', $barang->id) }}" class="text-pink-600 hover:text-pink-900">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.barangs.destroy', $barang->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data barang ini?')">
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
                    <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                        <i class="fas fa-box text-5xl text-gray-300 mb-4"></i>
                        <p>Tidak ada data barang</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($barangs->hasPages())
    <div class="px-6 py-4 border-t">
        {{ $barangs->links() }}
    </div>
    @endif
</div>
@endsection

