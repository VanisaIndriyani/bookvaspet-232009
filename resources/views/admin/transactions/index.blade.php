@extends('layouts.admin')

@section('title', 'Transaksi Pembayaran')
@section('page-title', 'Transaksi Pembayaran')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h2 class="text-2xl font-bold text-gray-800">
            <i class="fas fa-money-bill-wave text-pink-600 mr-2"></i>
            Transaksi Pembayaran
        </h2>
        <p class="text-gray-600 mt-1">Kelola pembayaran vaksinasi</p>
    </div>
</div>

<div class="bg-white rounded-xl shadow-md overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-pink-50">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase">Hewan & Pemilik</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase">Jenis Vaksin</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase">Nominal</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase">Status</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase">Metode</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($vaccinations as $vaccination)
                <tr class="hover:bg-pink-50 transition">
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-pink-100 rounded-full flex items-center justify-center mr-3">
                                <i class="fas fa-paw text-pink-600"></i>
                            </div>
                            <div>
                                <div class="font-medium text-gray-900">{{ $vaccination->animal->nama }}</div>
                                <div class="text-sm text-gray-500">{{ $vaccination->animal->user->name }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-pink-100 text-pink-800">
                            {{ $vaccination->jenis_vaksin }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        @if($vaccination->amount)
                            <span class="font-semibold text-gray-900">Rp {{ number_format($vaccination->amount, 0, ',', '.') }}</span>
                        @else
                            <span class="text-gray-400">-</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        @if($vaccination->payment_status === 'pending')
                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                <i class="fas fa-clock mr-1"></i>Menunggu
                            </span>
                        @elseif($vaccination->payment_status === 'paid')
                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                <i class="fas fa-check-circle mr-1"></i>Sudah Bayar
                            </span>
                        @elseif($vaccination->payment_status === 'verified')
                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                <i class="fas fa-check-double mr-1"></i>Terverifikasi
                            </span>
                        @elseif($vaccination->payment_status === 'rejected')
                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                <i class="fas fa-times-circle mr-1"></i>Ditolak
                            </span>
                        @else
                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
                                Belum Set
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-gray-600">
                        {{ $vaccination->payment_method ?? '-' }}
                    </td>
                    <td class="px-6 py-4">
                        <a href="{{ route('admin.transactions.show', $vaccination->id) }}" 
                           class="text-pink-600 hover:text-pink-900">
                            <i class="fas fa-eye mr-1"></i>Detail
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                        <i class="fas fa-money-bill-wave text-5xl text-gray-300 mb-4"></i>
                        <p>Tidak ada transaksi pembayaran</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($vaccinations->hasPages())
    <div class="px-6 py-4 border-t">
        {{ $vaccinations->links() }}
    </div>
    @endif
</div>
@endsection

