@extends('layouts.admin')

@section('title', 'Riwayat Vaksin')
@section('page-title', 'Riwayat Vaksinasi')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h2 class="text-2xl font-bold text-gray-800">
            <i class="fas fa-syringe text-pink-600 mr-2"></i>
            Riwayat Vaksinasi
        </h2>
        <p class="text-gray-600 mt-1">Kelola riwayat vaksinasi hewan</p>
    </div>
    <a href="{{ route('admin.vaccinations.create') }}" class="bg-pink-500 hover:bg-pink-600 text-white px-6 py-3 rounded-lg font-semibold transition shadow-md">
        <i class="fas fa-plus mr-2"></i>
        Tambah Vaksinasi
    </a>
</div>

<div class="bg-white rounded-xl shadow-md overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-pink-50">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase">Hewan</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase">Jenis Vaksin</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase">Tanggal Vaksin</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase">Tanggal Booster</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase">Dokter</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase">Status Pembayaran</th>
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
                    <td class="px-6 py-4 text-gray-600">
                        <i class="fas fa-calendar text-pink-600 mr-1"></i>
                        {{ $vaccination->tanggal_vaksin->format('d M Y') }}
                    </td>
                    <td class="px-6 py-4 text-gray-600">
                        @if($vaccination->tanggal_booster)
                            <i class="fas fa-calendar-check text-green-600 mr-1"></i>
                            {{ $vaccination->tanggal_booster->format('d M Y') }}
                        @else
                            <span class="text-gray-400">-</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-gray-600">
                        @if($vaccination->dokter)
                            <i class="fas fa-user-md text-pink-600 mr-1"></i>
                            {{ $vaccination->dokter }}
                        @else
                            <span class="text-gray-400">-</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        @if($vaccination->amount)
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
                            @endif
                            <div class="text-xs text-gray-500 mt-1">Rp {{ number_format($vaccination->amount, 0, ',', '.') }}</div>
                        @else
                            <span class="text-gray-400 text-xs">Belum set</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex space-x-2">
                            <a href="{{ route('admin.vaccinations.edit', $vaccination->id) }}" class="text-pink-600 hover:text-pink-900" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            @if($vaccination->amount)
                                <a href="{{ route('admin.transactions.show', $vaccination->id) }}" class="text-blue-600 hover:text-blue-900" title="Lihat Transaksi">
                                    <i class="fas fa-money-bill-wave"></i>
                                </a>
                            @endif
                            <form action="{{ route('admin.vaccinations.destroy', $vaccination->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus riwayat vaksin ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-12 text-center text-gray-500">
                        <i class="fas fa-syringe text-5xl text-gray-300 mb-4"></i>
                        <p>Tidak ada data vaksinasi</p>
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
