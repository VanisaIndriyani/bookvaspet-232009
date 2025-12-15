@extends('layouts.admin')

@section('title', 'Edit Vaksinasi')
@section('page-title', 'Edit Vaksinasi')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-xl shadow-md p-6">
        <div class="mb-6">
            <a href="{{ route('admin.vaccinations.index') }}" class="text-pink-600 hover:text-pink-800">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
        </div>

        <form action="{{ route('admin.vaccinations.update', $vaccination->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-6">
                <label for="animal_id" class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-paw text-pink-600 mr-2"></i>
                    Hewan <span class="text-red-500">*</span>
                </label>
                <select name="animal_id" id="animal_id" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500">
                    @foreach($animals as $animal)
                        <option value="{{ $animal->id }}" {{ old('animal_id', $vaccination->animal_id) == $animal->id ? 'selected' : '' }}>
                            {{ $animal->nama }} ({{ $animal->jenis }}) - {{ $animal->user->name }}
                        </option>
                    @endforeach
                </select>
                @error('animal_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="jenis_vaksin" class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-syringe text-pink-600 mr-2"></i>
                    Jenis Vaksin <span class="text-red-500">*</span>
                </label>
                <select name="jenis_vaksin" id="jenis_vaksin" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500">
                    <option value="DHPP" {{ old('jenis_vaksin', $vaccination->jenis_vaksin) === 'DHPP' ? 'selected' : '' }}>DHPP</option>
                    <option value="Rabies" {{ old('jenis_vaksin', $vaccination->jenis_vaksin) === 'Rabies' ? 'selected' : '' }}>Rabies</option>
                    <option value="FVRCP" {{ old('jenis_vaksin', $vaccination->jenis_vaksin) === 'FVRCP' ? 'selected' : '' }}>FVRCP</option>
                    <option value="FeLV" {{ old('jenis_vaksin', $vaccination->jenis_vaksin) === 'FeLV' ? 'selected' : '' }}>FeLV</option>
                    <option value="Bordetella" {{ old('jenis_vaksin', $vaccination->jenis_vaksin) === 'Bordetella' ? 'selected' : '' }}>Bordetella</option>
                    <option value="Lainnya" {{ old('jenis_vaksin', $vaccination->jenis_vaksin) === 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                </select>
                @error('jenis_vaksin')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="mb-6">
                    <label for="tanggal_vaksin" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-calendar text-pink-600 mr-2"></i>
                        Tanggal Vaksin <span class="text-red-500">*</span>
                    </label>
                    <input type="date" name="tanggal_vaksin" id="tanggal_vaksin" value="{{ old('tanggal_vaksin', $vaccination->tanggal_vaksin ? $vaccination->tanggal_vaksin->format('Y-m-d') : '') }}" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500">
                    @error('tanggal_vaksin')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="tanggal_booster" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-calendar-check text-pink-600 mr-2"></i>
                        Tanggal Booster
                    </label>
                    <input type="date" name="tanggal_booster" id="tanggal_booster" value="{{ old('tanggal_booster', $vaccination->tanggal_booster ? $vaccination->tanggal_booster->format('Y-m-d') : '') }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500">
                    @error('tanggal_booster')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="mb-6">
                    <label for="dokter" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-user-md text-pink-600 mr-2"></i>
                        Dokter
                    </label>
                    <input type="text" name="dokter" id="dokter" value="{{ old('dokter', $vaccination->dokter) }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500">
                    @error('dokter')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="lokasi" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-map-marker-alt text-pink-600 mr-2"></i>
                        Lokasi
                    </label>
                    <input type="text" name="lokasi" id="lokasi" value="{{ old('lokasi', $vaccination->lokasi) }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500">
                    @error('lokasi')
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
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500">{{ old('catatan', $vaccination->catatan) }}</textarea>
                @error('catatan')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Section Pembayaran -->
            <div class="mb-6 p-4 bg-pink-50 rounded-lg border border-pink-200">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">
                    <i class="fas fa-money-bill-wave text-pink-600 mr-2"></i>
                    Informasi Pembayaran
                </h3>
                
                <div class="mb-4">
                    <label for="amount" class="block text-sm font-semibold text-gray-700 mb-2">
                        Nominal Pembayaran
                    </label>
                    <input type="number" name="amount" id="amount" value="{{ old('amount', $vaccination->amount) }}" min="0" step="0.01"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500"
                        placeholder="Masukkan nominal (opsional)">
                    <p class="mt-1 text-xs text-gray-500">Kosongkan jika akan diisi nanti</p>
                    @error('amount')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                @if($vaccination->amount)
                    <div class="mt-4 p-3 bg-white rounded-lg">
                        <p class="text-sm text-gray-600 mb-2">Status Pembayaran:</p>
                        @if($vaccination->payment_status === 'pending')
                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                <i class="fas fa-clock mr-1"></i>Menunggu Pembayaran
                            </span>
                        @elseif($vaccination->payment_status === 'paid')
                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                <i class="fas fa-check-circle mr-1"></i>Sudah Bayar (Menunggu Verifikasi)
                            </span>
                        @elseif($vaccination->payment_status === 'verified')
                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                <i class="fas fa-check-double mr-1"></i>Terverifikasi
                            </span>
                        @elseif($vaccination->payment_status === 'rejected')
                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                <i class="fas fa-times-circle mr-1"></i>Ditolak
                            </span>
                        @endif
                        <div class="mt-2">
                            <a href="{{ route('admin.transactions.show', $vaccination->id) }}" 
                               class="text-sm text-pink-600 hover:text-pink-800">
                                <i class="fas fa-external-link-alt mr-1"></i>Lihat Detail Transaksi
                            </a>
                        </div>
                    </div>
                @endif
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('admin.vaccinations.index') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
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
