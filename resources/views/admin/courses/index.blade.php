@extends('layouts.admin')

@section('title', 'Data Mata Kuliah')
@section('page-title', 'Data Mata Kuliah')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <p class="text-sm text-gray-500">Kelola daftar mata kuliah yang tersedia.</p>
        </div>
        <a href="{{ route('admin.courses.create') }}"
           class="inline-flex items-center space-x-2 px-4 py-2 bg-pink-600 text-white rounded-lg hover:bg-pink-700 transition">
            <i class="fas fa-plus"></i>
            <span>Tambah Mata Kuliah</span>
        </a>
    </div>

    <div class="bg-white shadow rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode Mata Kuliah</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Mata Kuliah</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($courses as $course)
                        <tr>
                            <td class="px-6 py-4 text-sm text-gray-900 font-semibold">{{ $course->kode }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $course->nama }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center space-x-3">
                                    <a href="{{ route('admin.courses.edit', $course) }}" class="text-pink-600 hover:text-pink-800">
                                        <div class="w-10 h-10 rounded-full bg-pink-50 flex items-center justify-center shadow-sm">
                                            <i class="fas fa-pen-to-square"></i>
                                        </div>
                                    </a>
                                    <form action="{{ route('admin.courses.destroy', $course) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus mata kuliah ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800">
                                            <div class="w-10 h-10 rounded-full bg-red-50 flex items-center justify-center shadow-sm">
                                                <i class="fas fa-trash"></i>
                                            </div>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-10 text-center text-sm text-gray-500">
                                Belum ada data mata kuliah. Klik tombol "Tambah Mata Kuliah" untuk membuat data baru.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($courses->hasPages())
            <div class="px-6 py-4">
                {{ $courses->links() }}
            </div>
        @endif
    </div>
</div>
@endsection

