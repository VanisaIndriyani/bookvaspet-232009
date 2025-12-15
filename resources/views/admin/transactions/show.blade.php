@extends('layouts.admin')

@section('title', 'Detail Transaksi')
@section('page-title', 'Detail Transaksi')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('admin.transactions.index') }}" class="text-pink-600 hover:text-pink-800">
            <i class="fas fa-arrow-left mr-2"></i>Kembali ke Daftar Transaksi
        </a>
    </div>

    <!-- Informasi Vaksinasi -->
    <div class="bg-white rounded-xl shadow-md p-6 mb-6">
        <h3 class="text-xl font-bold text-gray-800 mb-4">
            <i class="fas fa-syringe text-pink-600 mr-2"></i>Informasi Vaksinasi
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <p class="text-sm text-gray-600">Hewan</p>
                <p class="font-semibold text-gray-900">{{ $vaccination->animal->nama }} ({{ $vaccination->animal->jenis }})</p>
            </div>
            <div>
                <p class="text-sm text-gray-600">Pemilik</p>
                <p class="font-semibold text-gray-900">{{ $vaccination->animal->user->name }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600">Jenis Vaksin</p>
                <p class="font-semibold text-gray-900">{{ $vaccination->jenis_vaksin }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600">Tanggal Vaksin</p>
                <p class="font-semibold text-gray-900">{{ $vaccination->tanggal_vaksin->format('d M Y') }}</p>
            </div>
        </div>
    </div>

    <!-- Informasi Pembayaran -->
    <div class="bg-white rounded-xl shadow-md p-6 mb-6">
        <h3 class="text-xl font-bold text-gray-800 mb-4">
            <i class="fas fa-money-bill-wave text-pink-600 mr-2"></i>Informasi Pembayaran
        </h3>
        
        @if(!$vaccination->amount)
            <!-- Form Set Nominal -->
            <form action="{{ route('admin.transactions.set-amount', $vaccination->id) }}" method="POST" class="mb-4">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="amount" class="block text-sm font-semibold text-gray-700 mb-2">
                            Nominal Pembayaran <span class="text-red-500">*</span>
                        </label>
                        <input type="number" name="amount" id="amount" required min="0" step="0.01"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500"
                            placeholder="Masukkan nominal">
                        @error('amount')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="payment_method" class="block text-sm font-semibold text-gray-700 mb-2">
                            Metode Pembayaran
                        </label>
                        <input type="text" name="payment_method" id="payment_method"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500"
                            placeholder="Contoh: Transfer Bank BCA" value="Transfer Bank">
                        @error('payment_method')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="mt-4 px-6 py-2 bg-pink-500 hover:bg-pink-600 text-white rounded-lg font-semibold transition">
                    <i class="fas fa-save mr-2"></i>Set Nominal Pembayaran
                </button>
            </form>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <p class="text-sm text-gray-600">Nominal</p>
                    <p class="text-2xl font-bold text-gray-900">Rp {{ number_format($vaccination->amount, 0, ',', '.') }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Status</p>
                    @if($vaccination->payment_status === 'pending')
                        <span class="px-3 py-1 text-sm font-semibold rounded-full bg-yellow-100 text-yellow-800">
                            <i class="fas fa-clock mr-1"></i>Menunggu Pembayaran
                        </span>
                    @elseif($vaccination->payment_status === 'paid')
                        <span class="px-3 py-1 text-sm font-semibold rounded-full bg-blue-100 text-blue-800">
                            <i class="fas fa-check-circle mr-1"></i>Sudah Bayar (Menunggu Verifikasi)
                        </span>
                    @elseif($vaccination->payment_status === 'verified')
                        <span class="px-3 py-1 text-sm font-semibold rounded-full bg-green-100 text-green-800">
                            <i class="fas fa-check-double mr-1"></i>Terverifikasi
                        </span>
                    @elseif($vaccination->payment_status === 'rejected')
                        <span class="px-3 py-1 text-sm font-semibold rounded-full bg-red-100 text-red-800">
                            <i class="fas fa-times-circle mr-1"></i>Ditolak
                        </span>
                    @endif
                </div>
                <div>
                    <p class="text-sm text-gray-600">Metode Pembayaran</p>
                    <p class="font-semibold text-gray-900">{{ $vaccination->payment_method ?? '-' }}</p>
                </div>
            </div>

            <!-- Bukti Pembayaran -->
            @if($vaccination->payment_proof)
                <div class="mb-4 p-4 bg-gray-50 rounded-lg">
                    <p class="text-sm font-semibold text-gray-700 mb-2">Bukti Pembayaran</p>
                    <div class="flex items-center space-x-4">
                        <img src="{{ Storage::disk('public')->url($vaccination->payment_proof) }}" 
                             alt="Bukti Pembayaran" 
                             class="max-w-xs h-auto rounded-lg border border-gray-300">
                        <div>
                            <a href="{{ route('admin.transactions.download-proof', $vaccination->id) }}" 
                               class="inline-block px-4 py-2 bg-pink-500 hover:bg-pink-600 text-white rounded-lg text-sm">
                                <i class="fas fa-download mr-2"></i>Download
                            </a>
                        </div>
                    </div>
                </div>
            @else
                <div class="mb-4 p-4 bg-yellow-50 rounded-lg border border-yellow-200">
                    <p class="text-sm text-yellow-800">
                        <i class="fas fa-exclamation-triangle mr-2"></i>Belum ada bukti pembayaran yang diupload
                    </p>
                </div>
            @endif

            <!-- Form Verifikasi (hanya jika sudah ada bukti) -->
            @if($vaccination->payment_proof && in_array($vaccination->payment_status, ['paid', 'pending']))
                <form action="{{ route('admin.transactions.verify', $vaccination->id) }}" method="POST" class="mt-4">
                    @csrf
                    <div class="mb-4">
                        <label for="payment_status" class="block text-sm font-semibold text-gray-700 mb-2">
                            Verifikasi Pembayaran <span class="text-red-500">*</span>
                        </label>
                        <select name="payment_status" id="payment_status" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500">
                            <option value="verified">Verifikasi (Terima)</option>
                            <option value="rejected">Tolak</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="payment_note" class="block text-sm font-semibold text-gray-700 mb-2">
                            Catatan (Opsional)
                        </label>
                        <textarea name="payment_note" id="payment_note" rows="3"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500"
                            placeholder="Masukkan catatan verifikasi...">{{ old('payment_note', $vaccination->payment_note) }}</textarea>
                    </div>
                    <button type="submit" class="px-6 py-2 bg-green-500 hover:bg-green-600 text-white rounded-lg font-semibold transition">
                        <i class="fas fa-check mr-2"></i>Verifikasi Pembayaran
                    </button>
                </form>
            @endif

            @if($vaccination->payment_note)
                <div class="mt-4 p-4 bg-blue-50 rounded-lg border border-blue-200">
                    <p class="text-sm font-semibold text-gray-700 mb-1">Catatan:</p>
                    <p class="text-sm text-gray-600">{{ $vaccination->payment_note }}</p>
                </div>
            @endif
        @endif
    </div>
</div>
@endsection

