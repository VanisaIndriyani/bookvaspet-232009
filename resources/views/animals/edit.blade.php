<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Hewan - PetVax</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <div class="min-h-screen py-8 px-4">
        <div class="max-w-3xl mx-auto">
            <!-- Header -->
            <div class="mb-6">
                <a href="{{ route('animals.index') }}" class="inline-flex items-center text-pink-600 hover:text-pink-800 mb-4">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali ke Daftar Hewan
                </a>
                <h1 class="text-3xl font-bold text-gray-800 flex items-center">
                    <i class="fas fa-edit text-pink-600 mr-3"></i>
                    Edit Data Hewan
                </h1>
                <p class="text-gray-600 mt-2">Perbarui informasi hewan peliharaan</p>
            </div>

            <!-- Form -->
            <div class="bg-white rounded-xl shadow-md p-6 md:p-8">
                <form action="{{ route('animals.update', $animal->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Nama Hewan -->
                    <div class="mb-6">
                        <label for="nama" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-tag text-pink-600 mr-2"></i>
                            Nama Hewan <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="nama" id="nama" value="{{ old('nama', $animal->nama) }}" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition">
                        @error('nama')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Jenis Hewan -->
                    <div class="mb-6">
                        <label for="jenis" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-paw text-pink-600 mr-2"></i>
                            Jenis Hewan <span class="text-red-500">*</span>
                        </label>
                        <select name="jenis" id="jenis" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition">
                            <option value="">Pilih Jenis Hewan</option>
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
                        <!-- Ras -->
                        <div class="mb-6">
                            <label for="ras" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-dna text-pink-600 mr-2"></i>
                                Ras
                            </label>
                            <input type="text" name="ras" id="ras" value="{{ old('ras', $animal->ras) }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition">
                            @error('ras')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Jenis Kelamin -->
                        <div class="mb-6">
                            <label for="jenis_kelamin" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-venus-mars text-pink-600 mr-2"></i>
                                Jenis Kelamin
                            </label>
                            <select name="jenis_kelamin" id="jenis_kelamin"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition">
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
                        <!-- Tanggal Lahir -->
                        <div class="mb-6">
                            <label for="tanggal_lahir" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-calendar text-pink-600 mr-2"></i>
                                Tanggal Lahir
                            </label>
                            <input type="date" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir', $animal->tanggal_lahir ? $animal->tanggal_lahir->format('Y-m-d') : '') }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition">
                            @error('tanggal_lahir')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Warna -->
                        <div class="mb-6">
                            <label for="warna" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-palette text-pink-600 mr-2"></i>
                                Warna
                            </label>
                            <input type="text" name="warna" id="warna" value="{{ old('warna', $animal->warna) }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition">
                            @error('warna')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Catatan -->
                    <div class="mb-6">
                        <label for="catatan" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-sticky-note text-pink-600 mr-2"></i>
                            Catatan Tambahan
                        </label>
                        <textarea name="catatan" id="catatan" rows="4"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition">{{ old('catatan', $animal->catatan) }}</textarea>
                        @error('catatan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Buttons -->
                    <div class="flex justify-end space-x-4 pt-4 border-t border-gray-200">
                        <a href="{{ route('animals.index') }}" class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition font-semibold">
                            <i class="fas fa-times mr-2"></i>
                            Batal
                        </a>
                        <button type="submit" class="px-6 py-3 bg-pink-500 hover:bg-pink-600 text-white rounded-lg font-semibold transition shadow-md">
                            <i class="fas fa-save mr-2"></i>
                            Update Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

