<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Hewan - PetVax</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <div class="min-h-screen py-8 px-4">
        <div class="max-w-7xl mx-auto">
            <!-- Header -->
            <div class="mb-6 flex flex-col md:flex-row md:items-center md:justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800 flex items-center">
                        <i class="fas fa-paw text-pink-600 mr-3"></i>
                        Data Hewan Peliharaan
                    </h1>
                    <p class="text-gray-600 mt-2">
                        @if(Auth::user()->role === 'dokter_hewan')
                            Daftar semua hewan pasien
                        @else
                            Daftar hewan peliharaan Anda
                        @endif
                    </p>
                </div>
                <a href="{{ route('animals.create') }}" class="mt-4 md:mt-0 bg-pink-500 hover:bg-pink-600 text-white px-6 py-3 rounded-lg font-semibold transition shadow-md inline-flex items-center">
                    <i class="fas fa-plus mr-2"></i>
                    Tambah Hewan Baru
                </a>
            </div>

            <!-- Animals Grid -->
            @if($animals->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($animals as $animal)
                <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-pink-100 rounded-full flex items-center justify-center mr-3">
                                <i class="fas fa-paw text-pink-600 text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-800">{{ $animal->nama }}</h3>
                                <p class="text-sm text-gray-500">{{ $animal->jenis }}</p>
                            </div>
                        </div>
                        <div class="flex space-x-2">
                            <a href="{{ route('animals.edit', $animal->id) }}" class="text-pink-600 hover:text-pink-800">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('animals.destroy', $animal->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data hewan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="space-y-2 text-sm">
                        @if($animal->ras)
                        <div class="flex items-center text-gray-600">
                            <i class="fas fa-dna text-pink-600 w-5"></i>
                            <span>Ras: {{ $animal->ras }}</span>
                        </div>
                        @endif

                        @if($animal->jenis_kelamin)
                        <div class="flex items-center text-gray-600">
                            <i class="fas fa-venus-mars text-pink-600 w-5"></i>
                            <span>{{ ucfirst($animal->jenis_kelamin) }}</span>
                        </div>
                        @endif

                        @if($animal->tanggal_lahir)
                        <div class="flex items-center text-gray-600">
                            <i class="fas fa-calendar text-pink-600 w-5"></i>
                            <span>{{ $animal->tanggal_lahir->format('d M Y') }}</span>
                        </div>
                        @endif

                        @if($animal->warna)
                        <div class="flex items-center text-gray-600">
                            <i class="fas fa-palette text-pink-600 w-5"></i>
                            <span>Warna: {{ $animal->warna }}</span>
                        </div>
                        @endif

                        @if(Auth::user()->role === 'dokter_hewan')
                        <div class="flex items-center text-gray-600">
                            <i class="fas fa-user text-pink-600 w-5"></i>
                            <span>Pemilik: {{ $animal->user->name }}</span>
                        </div>
                        @endif
                    </div>

                    @if($animal->catatan)
                    <div class="mt-4 pt-4 border-t border-gray-200">
                        <p class="text-xs text-gray-500">
                            <i class="fas fa-sticky-note text-pink-600 mr-1"></i>
                            {{ Str::limit($animal->catatan, 100) }}
                        </p>
                    </div>
                    @endif
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($animals->hasPages())
            <div class="mt-6">
                {{ $animals->links() }}
            </div>
            @endif
            @else
            <div class="bg-white rounded-xl shadow-md p-12 text-center">
                <i class="fas fa-paw text-6xl text-pink-300 mb-4"></i>
                <p class="text-gray-500 text-lg mb-2">Belum ada data hewan</p>
                <p class="text-gray-400 text-sm mb-6">Mulai dengan menambahkan hewan peliharaan pertama Anda</p>
                <a href="{{ route('animals.create') }}" class="inline-flex items-center bg-pink-500 hover:bg-pink-600 text-white px-6 py-3 rounded-lg font-semibold transition">
                    <i class="fas fa-plus mr-2"></i>
                    Tambah Hewan Pertama
                </a>
            </div>
            @endif
        </div>
    </div>
</body>
</html>

