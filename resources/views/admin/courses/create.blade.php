@extends('layouts.admin')

@section('title', 'Tambah Mata Kuliah')
@section('page-title', 'Tambah Mata Kuliah')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="bg-gradient-to-r from-pink-600 to-pink-500 text-white rounded-2xl p-6 shadow-lg">
        <div class="flex items-start space-x-4">
            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-white/20">
                <i class="fas fa-book-open text-2xl"></i>
            </div>
            <div>
                <p class="text-sm uppercase tracking-wider text-white/80">Formulir Mata Kuliah</p>
                <h2 class="text-2xl font-semibold">Tambah Mata Kuliah Baru</h2>
                <p class="text-sm text-white/80 mt-1">Pastikan kode unik dan nama mata kuliah mudah dikenali tim akademik.</p>
            </div>
        </div>
    </div>

    <div class="bg-white shadow-xl rounded-2xl p-8">
        <form action="{{ route('admin.courses.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="grid gap-6 md:grid-cols-2">
                <div>
                    <label for="kode" class="block text-sm font-semibold text-gray-700 mb-1">Kode Mata Kuliah</label>
                    <input type="text" name="kode" id="kode" value="{{ old('kode') }}"
                           class="w-full border border-gray-200 rounded-xl px-4 py-3 shadow-sm focus:border-pink-500 focus:ring-pink-500"
                           placeholder="Contoh: MKU101" required>
                    <p class="text-xs text-gray-500 mt-1">Gunakan format singkat (maks 20 karakter).</p>
                    @error('kode')
                        <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="nama" class="block text-sm font-semibold text-gray-700 mb-1">Nama Mata Kuliah</label>
                    <input type="text" name="nama" id="nama" value="{{ old('nama') }}"
                           class="w-full border border-gray-200 rounded-xl px-4 py-3 shadow-sm focus:border-pink-500 focus:ring-pink-500"
                           placeholder="Contoh: Pengantar Kesehatan Hewan" required>
                    <p class="text-xs text-gray-500 mt-1">Tuliskan nama lengkap sesuai katalog.</p>
                    @error('nama')
                        <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="rounded-2xl bg-pink-50 border border-pink-100 p-4 text-sm text-pink-800 flex items-start space-x-3">
                <i class="fas fa-info-circle mt-0.5"></i>
                <p>Data mata kuliah yang baru akan langsung muncul pada daftar utama begitu Anda menyimpan perubahan.</p>
            </div>

            <div class="flex items-center justify-end space-x-3">
                <a href="{{ route('admin.courses.index') }}" class="px-5 py-2.5 border border-gray-300 rounded-xl text-gray-700 hover:bg-gray-50 transition font-medium">Batal</a>
                <button type="submit" class="px-5 py-2.5 bg-pink-600 text-white rounded-xl font-semibold hover:bg-pink-700 transition">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection

