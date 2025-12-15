@extends('layouts.admin')

@section('title', 'Data Buku')
@section('page-title', 'Data Buku')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h2 class="text-2xl font-bold text-gray-800">
            <i class="fas fa-book text-pink-600 mr-2"></i>
            Daftar Buku
        </h2>
        <p class="text-gray-600 mt-1">Kelola data buku perpustakaan</p>
    </div>
    <a href="{{ route('admin.books.create') }}" class="bg-pink-500 hover:bg-pink-600 text-white px-6 py-3 rounded-lg font-semibold transition shadow-md">
        <i class="fas fa-plus mr-2"></i>
        Tambah Buku
    </a>
</div>

<div class="bg-white rounded-xl shadow-md overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-pink-50">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase">Kode Buku</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase">Nama Pengarang</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase">Nama Penulis</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($books as $book)
                <tr class="hover:bg-pink-50">
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-pink-100 rounded-full flex items-center justify-center mr-3">
                                <i class="fas fa-book text-pink-600"></i>
                            </div>
                            <span class="font-medium">{{ $book->kode_buku }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-gray-600">{{ $book->nama_pengarang }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $book->nama_penulis }}</td>
                    <td class="px-6 py-4">
                        <div class="flex space-x-2">
                            <a href="{{ route('admin.books.edit', $book->id) }}" class="text-pink-600 hover:text-pink-900">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.books.destroy', $book->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data buku ini?')">
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
                        <i class="fas fa-book text-5xl text-gray-300 mb-4"></i>
                        <p>Tidak ada data buku</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($books->hasPages())
    <div class="px-6 py-4 border-t">
        {{ $books->links() }}
    </div>
    @endif
</div>
@endsection

