@extends('layouts.admin')

@section('title', 'Tambah Buku')
@section('page-title', 'Tambah Buku')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="bg-gradient-to-r from-pink-600 to-pink-500 text-white rounded-2xl p-6 shadow-lg">
        <div class="flex items-start space-x-4">
            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-white/20">
                <i class="fas fa-book text-2xl"></i>
            </div>
            <div>
                <p class="text-sm uppercase tracking-wider text-white/80">Formulir Buku</p>
                <h2 class="text-2xl font-semibold">Tambah Buku Baru</h2>
                <p class="text-sm text-white/80 mt-1">Pastikan kode buku unik dan informasi pengarang serta penulis lengkap.</p>
            </div>
        </div>
    </div>

    <div class="bg-white shadow-xl rounded-2xl p-8">
        <form action="{{ route('admin.books.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="grid gap-6 md:grid-cols-3">
                <div>
                    <label for="kode_buku" class="block text-sm font-semibold text-gray-700 mb-1">Kode Buku</label>
                    <input type="text" name="kode_buku" id="kode_buku" value="{{ old('kode_buku') }}"
                           class="w-full border border-gray-200 rounded-xl px-4 py-3 shadow-sm focus:border-pink-500 focus:ring-pink-500"
                           placeholder="Contoh: BK001" required>
                    <p class="text-xs text-gray-500 mt-1">Gunakan format singkat (maks 50 karakter).</p>
                    @error('kode_buku')
                        <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="nama_pengarang" class="block text-sm font-semibold text-gray-700 mb-1">Nama Pengarang</label>
                    <input type="text" name="nama_pengarang" id="nama_pengarang" value="{{ old('nama_pengarang') }}"
                           class="w-full border border-gray-200 rounded-xl px-4 py-3 shadow-sm focus:border-pink-500 focus:ring-pink-500"
                           placeholder="Contoh: Dr. Ahmad Hidayat" required>
                    <p class="text-xs text-gray-500 mt-1">Nama lengkap pengarang buku.</p>
                    @error('nama_pengarang')
                        <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="nama_penulis" class="block text-sm font-semibold text-gray-700 mb-1">Nama Penulis</label>
                    <input type="text" name="nama_penulis" id="nama_penulis" value="{{ old('nama_penulis') }}"
                           class="w-full border border-gray-200 rounded-xl px-4 py-3 shadow-sm focus:border-pink-500 focus:ring-pink-500"
                           placeholder="Contoh: Prof. Siti Nurhaliza" required>
                    <p class="text-xs text-gray-500 mt-1">Nama lengkap penulis buku.</p>
                    @error('nama_penulis')
                        <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="rounded-2xl bg-pink-50 border border-pink-100 p-4 text-sm text-pink-800 flex items-start space-x-3">
                <i class="fas fa-info-circle mt-0.5"></i>
                <p>Data buku yang baru akan langsung muncul pada daftar utama begitu Anda menyimpan perubahan.</p>
            </div>

            <div class="flex items-center justify-end space-x-3">
                <a href="{{ route('admin.books.index') }}" class="px-5 py-2.5 border border-gray-300 rounded-xl text-gray-700 hover:bg-gray-50 transition font-medium">Batal</a>
                <button type="submit" class="px-5 py-2.5 bg-pink-600 text-white rounded-xl font-semibold hover:bg-pink-700 transition">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection

