@extends('layouts.admin')

@section('title', 'Edit Barang')
@section('page-title', 'Edit Barang')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="bg-gradient-to-r from-pink-600 to-pink-500 text-white rounded-2xl p-6 shadow-lg">
        <div class="flex items-start space-x-4">
            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-white/20">
                <i class="fas fa-box text-2xl"></i>
            </div>
            <div>
                <p class="text-sm uppercase tracking-wider text-white/80">Formulir Barang</p>
                <h2 class="text-2xl font-semibold">Edit Data Barang</h2>
                <p class="text-sm text-white/80 mt-1">Perbarui informasi kode barang, nama barang, dan jenis barang sesuai kebutuhan.</p>
            </div>
        </div>
    </div>

    <div class="bg-white shadow-xl rounded-2xl p-8">
        <form action="{{ route('admin.barangs.update', $barang) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid gap-6 md:grid-cols-3">
                <div>
                    <label for="kode_barang" class="block text-sm font-semibold text-gray-700 mb-1">Kode Barang</label>
                    <input type="text" name="kode_barang" id="kode_barang" value="{{ old('kode_barang', $barang->kode_barang) }}"
                           class="w-full border border-gray-200 rounded-xl px-4 py-3 shadow-sm focus:border-pink-500 focus:ring-pink-500"
                           required>
                    <p class="text-xs text-gray-500 mt-1">Gunakan format singkat (maks 50 karakter).</p>
                    @error('kode_barang')
                        <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="nama_barang" class="block text-sm font-semibold text-gray-700 mb-1">Nama Barang</label>
                    <input type="text" name="nama_barang" id="nama_barang" value="{{ old('nama_barang', $barang->nama_barang) }}"
                           class="w-full border border-gray-200 rounded-xl px-4 py-3 shadow-sm focus:border-pink-500 focus:ring-pink-500"
                           required>
                    <p class="text-xs text-gray-500 mt-1">Nama lengkap barang.</p>
                    @error('nama_barang')
                        <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="jenis_barang" class="block text-sm font-semibold text-gray-700 mb-1">Jenis Barang</label>
                    <input type="text" name="jenis_barang" id="jenis_barang" value="{{ old('jenis_barang', $barang->jenis_barang) }}"
                           class="w-full border border-gray-200 rounded-xl px-4 py-3 shadow-sm focus:border-pink-500 focus:ring-pink-500"
                           required>
                    <p class="text-xs text-gray-500 mt-1">Jenis atau kategori barang.</p>
                    @error('jenis_barang')
                        <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="rounded-2xl bg-pink-50 border border-pink-100 p-4 text-sm text-pink-800 flex items-start space-x-3">
                <i class="fas fa-info-circle mt-0.5"></i>
                <p>Pastikan semua informasi sudah benar sebelum menyimpan perubahan.</p>
            </div>

            <div class="flex items-center justify-end space-x-3">
                <a href="{{ route('admin.barangs.index') }}" class="px-5 py-2.5 border border-gray-300 rounded-xl text-gray-700 hover:bg-gray-50 transition font-medium">Batal</a>
                <button type="submit" class="px-5 py-2.5 bg-pink-600 text-white rounded-xl font-semibold hover:bg-pink-700 transition">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection

