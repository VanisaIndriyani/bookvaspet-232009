@extends('layouts.admin')

@section('title', 'Edit Hewan')
@section('page-title', 'Edit Hewan')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-xl shadow-md p-6">
        <div class="mb-6">
            <a href="{{ route('admin.animals.index') }}" class="text-pink-600 hover:text-pink-800">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
        </div>

        <form action="{{ route('admin.animals.update', $animal->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-6">
                <label for="user_id" class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-user text-pink-600 mr-2"></i>
                    Pemilik Hewan <span class="text-red-500">*</span>
                </label>
                <select name="user_id" id="user_id" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500">
                    @foreach(\App\Models\User::where('role', '!=', 'admin')->get() as $user)
                        <option value="{{ $user->id }}" {{ old('user_id', $animal->user_id) == $user->id ? 'selected' : '' }}>
                            {{ $user->name }} ({{ $user->email }})
                        </option>
                    @endforeach
                </select>
                @error('user_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="nama" class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-tag text-pink-600 mr-2"></i>
                    Nama Hewan <span class="text-red-500">*</span>
                </label>
                <input type="text" name="nama" id="nama" value="{{ old('nama', $animal->nama) }}" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500">
                @error('nama')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="jenis" class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-paw text-pink-600 mr-2"></i>
                    Jenis Hewan <span class="text-red-500">*</span>
                </label>
                <select name="jenis" id="jenis" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500">
                    <option value="Kucing" {{ old('jenis', $animal->jenis) === 'Kucing' ? 'selected' : '' }}>Kucing</option>
                    <option value="Anjing" {{ old('jenis', $animal->jenis) === 'Anjing' ? 'selected' : '' }}>Anjing</option>
                    <option value="Kelinci" {{ old('jenis', $animal->jenis) === 'Kelinci' ? 'selected' : '' }}>Kelinci</option>
                    <option value="Hamster" {{ old('jenis', $animal->jenis) === 'Hamster' ? 'selected' : '' }}>Hamster</option>
                    <option value="Burung" {{ old('jenis', $animal->jenis) === 'Burung' ? 'selected' : '' }}>Burung</option>
                    <option value="Lainnya" {{ old('jenis', $animal->jenis) === 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                </select>
                @error('jenis')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="mb-6">
                    <label for="ras" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-dna text-pink-600 mr-2"></i>
                        Ras
                    </label>
                    <input type="text" name="ras" id="ras" value="{{ old('ras', $animal->ras) }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500">
                    @error('ras')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="jenis_kelamin" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-venus-mars text-pink-600 mr-2"></i>
                        Jenis Kelamin
                    </label>
                    <select name="jenis_kelamin" id="jenis_kelamin"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500">
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="jantan" {{ old('jenis_kelamin', $animal->jenis_kelamin) === 'jantan' ? 'selected' : '' }}>Jantan</option>
                        <option value="betina" {{ old('jenis_kelamin', $animal->jenis_kelamin) === 'betina' ? 'selected' : '' }}>Betina</option>
                    </select>
                    @error('jenis_kelamin')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="mb-6">
                    <label for="tanggal_lahir" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-calendar text-pink-600 mr-2"></i>
                        Tanggal Lahir
                    </label>
                    <input type="date" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir', $animal->tanggal_lahir ? $animal->tanggal_lahir->format('Y-m-d') : '') }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500">
                    @error('tanggal_lahir')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="warna" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-palette text-pink-600 mr-2"></i>
                        Warna
                    </label>
                    <input type="text" name="warna" id="warna" value="{{ old('warna', $animal->warna) }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500">
                    @error('warna')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mb-6">
                <label for="catatan" class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-sticky-note text-pink-600 mr-2"></i>
                    Catatan Tambahan
                </label>
                <textarea name="catatan" id="catatan" rows="4"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500">{{ old('catatan', $animal->catatan) }}</textarea>
                @error('catatan')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('admin.animals.index') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2 bg-pink-500 hover:bg-pink-600 text-white rounded-lg font-semibold transition">
                    <i class="fas fa-save mr-2"></i>Update
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
