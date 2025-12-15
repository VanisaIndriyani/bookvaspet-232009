@extends('layouts.admin')

@section('title', 'Edit Mata Kuliah')
@section('page-title', 'Edit Mata Kuliah')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white shadow rounded-xl p-6 space-y-6">
        <div>
            <h2 class="text-lg font-semibold text-gray-800">Perbarui Informasi Mata Kuliah</h2>
            <p class="text-sm text-gray-500">Sesuaikan kode dan nama mata kuliah kemudian simpan perubahan.</p>
        </div>

        <form action="{{ route('admin.courses.update', $course) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label for="kode" class="block text-sm font-medium text-gray-700 mb-1">Kode Mata Kuliah</label>
                <input type="text" name="kode" id="kode" value="{{ old('kode', $course->kode) }}"
                       class="w-full border-gray-300 rounded-lg shadow-sm focus:border-pink-500 focus:ring-pink-500"
                       required>
                @error('kode')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama Mata Kuliah</label>
                <input type="text" name="nama" id="nama" value="{{ old('nama', $course->nama) }}"
                       class="w-full border-gray-300 rounded-lg shadow-sm focus:border-pink-500 focus:ring-pink-500"
                       required>
                @error('nama')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-end space-x-3">
                <a href="{{ route('admin.courses.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">Batal</a>
                <button type="submit" class="px-4 py-2 bg-pink-600 text-white rounded-lg hover:bg-pink-700 transition">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection

