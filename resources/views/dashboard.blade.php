<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pengguna | PetVax</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #fff0f7, #ffeaf6);
        }
    </style>
</head>
<body class="min-h-screen">
@php use Illuminate\Support\Str; @endphp
    <nav class="bg-white/80 backdrop-blur shadow-sm sticky top-0 z-20 border-b border-pink-100">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex justify-between h-16 items-center">
                <a href="{{ url('/') }}" class="flex items-center text-xl font-black text-pink-500 tracking-tight">
                    💗 PetVax
                </a>
                <div class="flex items-center space-x-1 sm:space-x-4 text-sm font-semibold">
                    <span class="hidden lg:inline text-gray-500 mr-2">Hai, <span class="text-pink-500">{{ $user->name }}</span></span>
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
        <div class="max-w-6xl mx-auto space-y-10">
            <!-- Header / Guidance -->
            <div class="bg-white border border-pink-100 rounded-3xl p-6 shadow-sm">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <p class="text-sm font-semibold text-pink-500 uppercase tracking-widest">Dashboard Pengguna</p>
                        <h1 class="text-3xl md:text-4xl font-black text-gray-900 mt-2">Semua catatan vaksin Anda di satu tempat.</h1>
                        <p class="text-gray-500 mt-2 max-w-2xl">
                            Dashboard ini menampilkan data yang dicatat oleh dokter hewan Anda. Jika ada informasi yang perlu dikoreksi,
                            cukup hubungi dokter melalui tombol bantuan di bawah ini.
                        </p>
                    </div>
                    <div class="text-sm text-gray-400 italic">Hubungi dokter Anda jika membutuhkan perubahan data.</div>
                </div>
                <div class="mt-6 grid sm:grid-cols-3 gap-4 text-sm text-gray-600">
                    <div class="p-4 rounded-2xl border border-pink-100 bg-pink-50/60">
                        <p class="font-semibold text-pink-600">1 · Lihat Data</p>
                        <p>Cek daftar hewan dan riwayat vaksin terbaru Anda.</p>
                    </div>
                    <div class="p-4 rounded-2xl border border-pink-100 bg-pink-50/60">
                        <p class="font-semibold text-pink-600">2 · Ingat Booster</p>
                        <p>Perhatikan jadwal booster agar tidak tertinggal.</p>
                    </div>
                    <div class="p-4 rounded-2xl border border-pink-100 bg-pink-50/60">
                        <p class="font-semibold text-pink-600">3 · Konsultasi Dokter</p>
                        <p>Jika ada data yang berubah, sampaikan kepada dokter.</p>
                    </div>
                </div>
            </div>

            <!-- Stats -->
            <div class="grid md:grid-cols-3 gap-5">
                <div class="bg-white border border-pink-100 rounded-2xl p-5 shadow-sm">
                    <p class="text-sm text-gray-500">Total Hewan</p>
                    <p class="text-3xl font-bold text-pink-500 mt-2">{{ $stats['total_animals'] }}</p>
                </div>
                <div class="bg-white border border-pink-100 rounded-2xl p-5 shadow-sm">
                    <p class="text-sm text-gray-500">Riwayat Vaksin</p>
                    <p class="text-3xl font-bold text-pink-500 mt-2">{{ $stats['total_vaccinations'] }}</p>
                </div>
                <div class="bg-white border border-pink-100 rounded-2xl p-5 shadow-sm">
                    <p class="text-sm text-gray-500">Booster Mendatang</p>
                    <p class="text-3xl font-bold text-pink-500 mt-2">{{ $stats['upcoming_boosters'] }}</p>
                </div>
            </div>

            <!-- Pending Payments -->
            @if($pendingPayments->count() > 0)
            <section class="bg-white border border-pink-100 rounded-3xl p-6 shadow-sm">
                <div class="flex justify-between items-center mb-4">
                    <div>
                        <h2 class="text-xl font-bold text-gray-900">
                            <i class="fas fa-money-bill-wave text-pink-600 mr-2"></i>
                            Pembayaran yang Perlu Dilakukan
                        </h2>
                        <p class="text-xs text-gray-400 uppercase tracking-widest">Lakukan pembayaran untuk melanjutkan vaksinasi</p>
                    </div>
                    <a href="{{ route('transactions.index') }}" class="text-sm text-pink-500 font-semibold hover:text-pink-600">
                        Lihat semua <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
                <div class="space-y-3">
                    @foreach($pendingPayments as $payment)
                        <div class="p-4 border border-pink-100 rounded-2xl bg-pink-50/60 hover:bg-pink-50 transition">
                            <div class="flex items-center justify-between">
                                <div class="flex-1">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 bg-pink-100 rounded-full flex items-center justify-center">
                                            <i class="fas fa-paw text-pink-600"></i>
                                        </div>
                                        <div>
                                            <p class="font-semibold text-gray-900">{{ $payment->animal->nama }}</p>
                                            <p class="text-sm text-gray-500">{{ $payment->jenis_vaksin }} • {{ $payment->tanggal_vaksin->format('d M Y') }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right mr-4">
                                    <p class="text-lg font-bold text-pink-600">Rp {{ number_format($payment->amount, 0, ',', '.') }}</p>
                                    @if($payment->payment_status === 'pending')
                                        <span class="text-xs px-2 py-1 rounded-full bg-yellow-100 text-yellow-800 mt-1 inline-block">
                                            <i class="fas fa-clock mr-1"></i>Belum Bayar
                                        </span>
                                    @elseif($payment->payment_status === 'paid')
                                        <span class="text-xs px-2 py-1 rounded-full bg-blue-100 text-blue-800 mt-1 inline-block">
                                            <i class="fas fa-check-circle mr-1"></i>Menunggu Verifikasi
                                        </span>
                                    @endif
                                </div>
                                <a href="{{ route('transactions.show', $payment->id) }}" 
                                   class="px-4 py-2 bg-pink-500 hover:bg-pink-600 text-white rounded-lg text-sm font-semibold transition">
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
            @endif

            <!-- Animals -->
            <section class="bg-white border border-pink-100 rounded-3xl p-6 shadow-sm">
                <div class="flex justify-between items-center mb-4">
                    <div>
                        <h2 class="text-xl font-bold text-gray-900">Hewan Peliharaan</h2>
                        <p class="text-xs text-gray-400 uppercase tracking-widest">Data dikelola dokter</p>
                    </div>
                    <button onclick="openModal()" class="text-xs text-pink-500 font-semibold hover:text-pink-600 cursor-pointer">
                        <i class="fas fa-info-circle mr-1"></i>Bagaimana cara mengubah data?
                    </button>
                </div>
                @if ($animals->isEmpty())
                    <div class="text-center text-gray-500 py-6 border border-dashed border-pink-100 rounded-2xl">
                        <p>Belum ada data hewan. Dokter akan menambahkan data setelah pemeriksaan pertama.</p>
                        <p class="text-xs text-gray-400 mt-2">Tanyakan pada dokter saat kunjungan berikutnya.</p>
                    </div>
                @else
                    <div class="grid md:grid-cols-2 gap-4">
                        @foreach ($animals as $animal)
                            @php $lastVaccination = $animal->vaccinations->first(); @endphp
                            <div class="p-5 border border-pink-100 rounded-2xl bg-pink-50/60">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm text-gray-400 uppercase tracking-widest">{{ $animal->jenis }}</p>
                                        <h3 class="text-lg font-bold text-gray-900">{{ $animal->nama }}</h3>
                                    </div>
                                    <span class="text-xs px-3 py-1 rounded-full bg-white text-pink-500 border border-pink-100">
                                        {{ $animal->jenis_kelamin ? ucfirst($animal->jenis_kelamin) : '—' }}
                                    </span>
                                </div>
                                <p class="text-sm text-gray-500 mt-3">Ras: {{ $animal->ras ?? 'Tidak diketahui' }}</p>
                                <p class="text-sm text-gray-500">Terakhir divaksin: {{ $lastVaccination?->tanggal_vaksin?->format('d M Y') ?? 'Belum ada' }}</p>
                                
                                @if($animal->catatan)
                                <div class="mt-4 pt-4 border-t border-pink-200">
                                    <p class="text-xs text-gray-600">
                                        <i class="fas fa-sticky-note text-pink-500 mr-1"></i>
                                        <span class="font-semibold">Catatan:</span> {{ Str::limit($animal->catatan, 100) }}
                                    </p>
                                </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif
            </section>

            <!-- Upcoming Boosters & Tips -->
            <div class="grid md:grid-cols-2 gap-6">
                <section class="bg-white border border-pink-100 rounded-3xl p-6 shadow-sm">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-bold text-gray-900">Booster Terdekat</h2>
                        <a href="{{ route('vaccinations.index') }}" class="text-xs text-pink-500 font-semibold hover:text-pink-600">Lihat semua</a>
                    </div>
                    @forelse ($upcomingBoosters as $booster)
                        <div class="flex items-center py-3 border-b border-pink-50 last:border-0">
                            <div class="w-10 h-10 rounded-full bg-pink-100 flex items-center justify-center text-pink-500">
                                <i class="fas fa-syringe"></i>
                            </div>
                            <div class="ml-4 flex-1">
                                <p class="font-semibold text-gray-900">{{ $booster->animal->nama }}</p>
                                <p class="text-sm text-gray-500">{{ $booster->jenis_vaksin }} • {{ $booster->dokter ?? 'Dokter belum ditentukan' }}</p>
                            </div>
                            <span class="text-sm font-semibold text-pink-500">{{ $booster->tanggal_booster?->format('d M Y') }}</span>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500">Belum ada jadwal booster terdekat.</p>
                    @endforelse
                </section>

                <section class="bg-white border border-pink-100 rounded-3xl p-6 shadow-sm">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Tips Perawatan</h2>
                    <div class="space-y-4">
                        @foreach ($tips as $tip)
                            <div class="p-4 rounded-2xl bg-pink-50 border border-pink-100">
                                <p class="font-semibold text-gray-900">{{ $tip['title'] }}</p>
                                <p class="text-sm text-gray-500 mt-1">{{ $tip['desc'] }}</p>
                            </div>
                        @endforeach
                    </div>
                </section>
            </div>

            <!-- Recent Vaccinations -->
            <section class="bg-white border border-pink-100 rounded-3xl p-6 shadow-sm">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-bold text-gray-900">Riwayat Vaksin Terbaru</h2>
                    <a href="{{ route('vaccinations.index') }}" class="text-sm text-pink-500 font-semibold hover:text-pink-600">Riwayat lengkap</a>
                </div>
                @if ($latestVaccinations->isEmpty())
                    <p class="text-sm text-gray-500">Belum ada riwayat vaksin yang tercatat.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead class="bg-pink-50">
                                <tr>
                                    <th class="text-left px-4 py-3 font-semibold text-gray-500">Hewan</th>
                                    <th class="text-left px-4 py-3 font-semibold text-gray-500">Vaksin</th>
                                    <th class="text-left px-4 py-3 font-semibold text-gray-500">Tanggal</th>
                                    <th class="text-left px-4 py-3 font-semibold text-gray-500">Booster</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-pink-50">
                                @foreach ($latestVaccinations as $vaccination)
                                    <tr class="hover:bg-pink-50/70">
                                        <td class="px-4 py-3">{{ $vaccination->animal->nama }}</td>
                                        <td class="px-4 py-3 font-semibold text-pink-500">{{ $vaccination->jenis_vaksin }}</td>
                                        <td class="px-4 py-3">{{ $vaccination->tanggal_vaksin->format('d M Y') }}</td>
                                        <td class="px-4 py-3">
                                            {{ $vaccination->tanggal_booster?->format('d M Y') ?? '—' }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </section>
        </div>
    </main>

    <!-- Modal -->
    <div id="infoModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl shadow-xl max-w-2xl w-full p-6 relative">
            <button onclick="closeModal()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
                <i class="fas fa-times text-xl"></i>
            </button>
            <div class="mb-4">
                <h3 class="text-2xl font-bold text-gray-900 flex items-center">
                    <i class="fas fa-info-circle text-pink-600 mr-3"></i>
                    Cara Mengubah Data
                </h3>
            </div>
            <div class="space-y-4 text-gray-700">
                <div class="p-4 rounded-2xl bg-pink-50 border border-pink-100">
                    <p class="font-semibold text-pink-600 mb-2">
                        <i class="fas fa-phone-alt mr-2"></i>Hubungi Dokter Hewan Anda
                    </p>
                    <p class="text-sm">
                        Data hewan peliharaan dan riwayat vaksinasi dikelola oleh dokter hewan. Untuk mengubah atau memperbarui data, silakan hubungi dokter hewan Anda melalui kontak yang tersedia.
                    </p>
                </div>
                <div class="p-4 rounded-2xl bg-pink-50 border border-pink-100">
                    <p class="font-semibold text-pink-600 mb-2">
                        <i class="fas fa-calendar-check mr-2"></i>Saat Kunjungan Berikutnya
                    </p>
                    <p class="text-sm">
                        Anda juga dapat menyampaikan perubahan data saat kunjungan berikutnya ke klinik dokter hewan. Dokter akan memperbarui data setelah konfirmasi.
                    </p>
                </div>
                <div class="p-4 rounded-2xl bg-pink-50 border border-pink-100">
                    <p class="font-semibold text-pink-600 mb-2">
                        <i class="fas fa-shield-alt mr-2"></i>Mengapa Data Dikelola Dokter?
                    </p>
                    <p class="text-sm">
                        Data dikelola oleh dokter untuk memastikan akurasi informasi medis dan riwayat vaksinasi hewan peliharaan Anda. Ini membantu menjaga kualitas perawatan kesehatan hewan.
                    </p>
                </div>
            </div>
            <div class="mt-6 flex justify-end">
                <button onclick="closeModal()" class="px-6 py-2 bg-pink-500 hover:bg-pink-600 text-white rounded-lg font-semibold transition">
                    Mengerti
                </button>
            </div>
        </div>
    </div>

    <script>
        function openModal() {
            document.getElementById('infoModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('infoModal').classList.add('hidden');
        }

        // Close modal when clicking outside
        document.getElementById('infoModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeModal();
            }
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js" defer></script>
</body>
</html>