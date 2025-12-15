<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Vaksinasi - PetVax</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #fff0f7, #ffeaf6);
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="min-h-screen">
    <nav class="bg-white/80 backdrop-blur shadow-sm sticky top-0 z-20 border-b border-pink-100">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex justify-between h-16 items-center">
                <a href="{{ url('/') }}" class="flex items-center text-xl font-black text-pink-500 tracking-tight">
                    💗 PetVax
                </a>
                <div class="flex items-center space-x-1 sm:space-x-4 text-sm font-semibold">
                    <span class="hidden lg:inline text-gray-500 mr-2">Hai, <span class="text-pink-500">{{ Auth::user()->name }}</span></span>
                    <div class="hidden md:flex items-center space-x-4 border-r border-pink-200 pr-4 mr-2">
                        <a href="{{ route('dashboard') }}" class="px-3 py-2 text-pink-500 hover:text-pink-600 hover:bg-pink-50 rounded-lg transition {{ request()->routeIs('dashboard') ? 'bg-pink-50' : '' }}">
                            <i class="fas fa-home mr-1"></i>Dashboard
                        </a>
                        <a href="{{ route('vaccinations.index') }}" class="px-3 py-2 text-pink-500 hover:text-pink-600 hover:bg-pink-50 rounded-lg transition {{ request()->routeIs('vaccinations.*') ? 'bg-pink-50' : '' }}">
                            <i class="fas fa-syringe mr-1"></i>Vaksinasi
                        </a>
                        <a href="{{ route('transactions.index') }}" class="px-3 py-2 text-pink-500 hover:text-pink-600 hover:bg-pink-50 rounded-lg transition {{ request()->routeIs('transactions.*') ? 'bg-pink-50' : '' }}">
                            <i class="fas fa-money-bill-wave mr-1"></i>Pembayaran
                        </a>
                        <a href="{{ url('/') }}" class="px-3 py-2 text-pink-500 hover:text-pink-600 hover:bg-pink-50 rounded-lg transition">
                            Beranda
                        </a>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="px-4 py-2 rounded-full bg-pink-500 text-white shadow hover:bg-pink-600 transition">
                            <i class="fas fa-sign-out-alt mr-1"></i><span class="hidden sm:inline">Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <main class="py-10 px-4">
        <div class="max-w-6xl mx-auto">
            <!-- Header -->
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-800 flex items-center">
                    <i class="fas fa-syringe text-pink-600 mr-3"></i>
                    Riwayat Vaksinasi
                </h1>
                <p class="text-gray-600 mt-2">Riwayat lengkap vaksinasi hewan peliharaan Anda</p>
            </div>

            <!-- Vaccinations Table -->
            <div class="bg-white border border-pink-100 rounded-3xl p-6 shadow-sm">
                @if($vaccinations->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead class="bg-pink-50">
                                <tr>
                                    <th class="text-left px-4 py-3 font-semibold text-gray-500">Hewan</th>
                                    <th class="text-left px-4 py-3 font-semibold text-gray-500">Vaksin</th>
                                    <th class="text-left px-4 py-3 font-semibold text-gray-500">Tanggal</th>
                                    <th class="text-left px-4 py-3 font-semibold text-gray-500">Booster</th>
                                    <th class="text-left px-4 py-3 font-semibold text-gray-500">Dokter</th>
                                    <th class="text-left px-4 py-3 font-semibold text-gray-500">Lokasi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-pink-50">
                                @foreach($vaccinations as $vaccination)
                                    <tr class="hover:bg-pink-50/70">
                                        <td class="px-4 py-3">
                                            <div class="flex items-center">
                                                <div class="w-10 h-10 bg-pink-100 rounded-full flex items-center justify-center mr-3">
                                                    <i class="fas fa-paw text-pink-600"></i>
                                                </div>
                                                <div>
                                                    <div class="font-semibold text-gray-900">{{ $vaccination->animal->nama }}</div>
                                                    <div class="text-xs text-gray-500">{{ $vaccination->animal->jenis }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3">
                                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-pink-100 text-pink-800">
                                                {{ $vaccination->jenis_vaksin }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 text-gray-600">
                                            <i class="fas fa-calendar text-pink-500 mr-1"></i>
                                            {{ $vaccination->tanggal_vaksin->format('d M Y') }}
                                        </td>
                                        <td class="px-4 py-3 text-gray-600">
                                            @if($vaccination->tanggal_booster)
                                                <i class="fas fa-calendar-check text-green-600 mr-1"></i>
                                                {{ $vaccination->tanggal_booster->format('d M Y') }}
                                                @if($vaccination->tanggal_booster->isFuture())
                                                    <span class="ml-2 text-xs text-pink-600 font-semibold">(Mendatang)</span>
                                                @endif
                                            @else
                                                <span class="text-gray-400">—</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3 text-gray-600">
                                            @if($vaccination->dokter)
                                                <i class="fas fa-user-md text-pink-500 mr-1"></i>
                                                {{ $vaccination->dokter }}
                                            @else
                                                <span class="text-gray-400">—</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3 text-gray-600">
                                            @if($vaccination->lokasi)
                                                <i class="fas fa-map-marker-alt text-pink-500 mr-1"></i>
                                                {{ $vaccination->lokasi }}
                                            @else
                                                <span class="text-gray-400">—</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @if($vaccination->catatan)
                                    <tr>
                                        <td colspan="6" class="px-4 py-2 bg-pink-50/50">
                                            <p class="text-xs text-gray-600">
                                                <i class="fas fa-sticky-note text-pink-500 mr-1"></i>
                                                <span class="font-semibold">Catatan:</span> {{ $vaccination->catatan }}
                                            </p>
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($vaccinations->hasPages())
                    <div class="mt-6 pt-4 border-t border-pink-100">
                        {{ $vaccinations->links() }}
                    </div>
                    @endif
                @else
                    <div class="text-center text-gray-500 py-12">
                        <i class="fas fa-syringe text-6xl text-pink-300 mb-4"></i>
                        <p class="text-lg mb-2">Belum ada riwayat vaksinasi</p>
                        <p class="text-sm text-gray-400">Dokter akan menambahkan riwayat vaksinasi setelah pemeriksaan.</p>
                    </div>
                @endif
            </div>
        </div>
    </main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js" defer></script>
</body>
</html>

