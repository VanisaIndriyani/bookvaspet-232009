<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetVax | Buku Digital Riwayat Vaksin Hewan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #fff6fb;
        }
        .floating {
            animation: floating 6s ease-in-out infinite;
        }
        @keyframes floating {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
    </style>
</head>
<body class="bg-gradient-to-br from-pink-50 via-white to-pink-50 text-gray-800">

    <nav class="bg-white/90 backdrop-blur shadow-sm sticky top-0 z-20 border-b border-pink-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <a href="{{ url('/') }}" class="flex items-center text-2xl font-extrabold text-pink-600 tracking-tight hover:text-pink-700 transition">
                    <span class="mr-2">💗🐾</span> PetVax
                </a>
                
                <div class="flex items-center space-x-1 sm:space-x-2 md:space-x-4 text-sm font-semibold">
                    <div class="hidden md:flex items-center space-x-4 border-r border-pink-200 pr-4 mr-2">
                        <a href="#fitur" class="px-3 py-2 text-gray-600 hover:text-pink-600 hover:bg-pink-50 rounded-lg transition">
                            Fitur
                        </a>
                        <a href="#statistik" class="px-3 py-2 text-gray-600 hover:text-pink-600 hover:bg-pink-50 rounded-lg transition">
                            Statistik
                        </a>
                        <a href="#testimoni" class="px-3 py-2 text-gray-600 hover:text-pink-600 hover:bg-pink-50 rounded-lg transition">
                            Testimoni
                        </a>
                    </div>
                    @auth
                        <a href="{{ route('dashboard') }}" class="px-4 py-2 rounded-full bg-pink-100 text-pink-600 hover:bg-pink-200 transition font-semibold">
                            <i class="fas fa-home mr-1"></i><span class="hidden sm:inline">Dashboard</span>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="px-4 py-2 text-pink-600 hover:text-pink-700 hover:bg-pink-50 rounded-lg transition">
                            <span class="hidden sm:inline">Masuk</span><span class="sm:hidden">Login</span>
                        </a>
                        <a href="{{ route('register') }}" class="px-5 py-2 bg-pink-500 text-white rounded-full shadow-lg hover:bg-pink-600 transition font-semibold">
                            <span class="hidden sm:inline">Daftar Gratis</span><span class="sm:hidden">Daftar</span>
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <header class="relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-pink-100 via-white to-pink-50 opacity-70"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid lg:grid-cols-2 gap-12 items-center py-16 lg:py-28">
                <div>
                    <span class="inline-flex items-center px-4 py-1 rounded-full bg-white/80 text-pink-600 font-semibold text-sm shadow">
                        🌸 Platform Digital Kesehatan Hewan
                    </span>
                    <h1 class="mt-6 text-4xl md:text-5xl font-black text-gray-900 leading-tight">
                        Catat Riwayat Vaksin <span class="text-pink-500">Hewan Kesayangan</span> dengan Satu Aplikasi.
                    </h1>
                    <p class="mt-6 text-lg text-gray-600 leading-relaxed">
                        PetVax membantu pemilik dan dokter hewan memantau jadwal vaksin, catatan kesehatan, dan pengingat booster
                        secara real-time dengan tampilan manis dan mudah digunakan.
                    </p>
                    <div class="mt-8 flex flex-wrap gap-4">
                        <a href="{{ route('register') }}" class="inline-flex items-center px-8 py-4 rounded-full bg-pink-500 text-white font-bold shadow-lg hover:bg-pink-600 transition">
                            Coba Sekarang Gratis
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                        <a href="#fitur" class="inline-flex items-center px-6 py-4 rounded-full border border-pink-200 text-pink-600 font-semibold hover:border-pink-400 transition">
                            Lihat Fitur
                        </a>
                    </div>
                    <div class="mt-10 grid grid-cols-3 gap-4 text-center">
                        <div class="bg-white/70 rounded-2xl p-4 shadow">
                            <p class="text-3xl font-bold text-pink-500">120+</p>
                            <p class="text-xs uppercase tracking-widest text-gray-500">Dokter Terdaftar</p>
                        </div>
                        <div class="bg-white/70 rounded-2xl p-4 shadow">
                            <p class="text-3xl font-bold text-pink-500">1.5K</p>
                            <p class="text-xs uppercase tracking-widest text-gray-500">Hewan Tercatat</p>
                        </div>
                        <div class="bg-white/70 rounded-2xl p-4 shadow">
                            <p class="text-3xl font-bold text-pink-500">98%</p>
                            <p class="text-xs uppercase tracking-widest text-gray-500">Pengingat Tepat</p>
                        </div>
                    </div>
                </div>
                <div class="relative">
                    <div class="absolute -inset-4 bg-gradient-to-br from-pink-200 via-white to-pink-100 rounded-3xl blur-3xl opacity-60"></div>
                    <div class="relative bg-white rounded-3xl shadow-xl border border-pink-100 p-6 floating">
                        <img src="https://images.unsplash.com/photo-1507146426996-ef05306b995a?auto=format&fit=crop&w=900&q=80" alt="Pets" class="rounded-2xl shadow">
                        <div class="mt-4 grid grid-cols-2 gap-4 text-sm">
                            <div class="p-4 rounded-xl bg-pink-50 border border-pink-100">
                                <p class="text-xs uppercase text-gray-500">Pengingat Booster</p>
                                <p class="text-lg font-semibold text-pink-600">Rabies - 3 Hari Lagi</p>
                            </div>
                            <div class="p-4 rounded-xl bg-pink-50 border border-pink-100">
                                <p class="text-xs uppercase text-gray-500">Dokter Penanggung</p>
                                <p class="text-lg font-semibold text-pink-600">drh. Fira Lestari</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section id="fitur" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="text-center mb-12">
            <span class="text-sm font-semibold text-pink-500 uppercase tracking-widest">Fitur Utama</span>
            <h2 class="mt-3 text-3xl font-bold text-gray-900">Semua yang Anda Butuhkan</h2>
            <p class="mt-2 text-gray-600">Dirancang untuk memudahkan pemilik dan dokter hewan.</p>
        </div>
        <div class="grid md:grid-cols-3 gap-6">
            <div class="bg-white rounded-2xl shadow-sm border border-pink-100 p-6">
                <div class="w-12 h-12 rounded-full bg-pink-100 text-pink-600 flex items-center justify-center mb-4">
                    <i class="fas fa-notes-medical"></i>
                </div>
                <h3 class="font-bold text-lg text-gray-900">Catatan Vaksin Lengkap</h3>
                <p class="mt-2 text-gray-600 text-sm leading-relaxed">Simpan riwayat vaksinasi, dosis, dokter penanggung jawab, dan catatan tambahan.</p>
            </div>
            <div class="bg-white rounded-2xl shadow-sm border border-pink-100 p-6">
                <div class="w-12 h-12 rounded-full bg-pink-100 text-pink-600 flex items-center justify-center mb-4">
                    <i class="fas fa-bell"></i>
                </div>
                <h3 class="font-bold text-lg text-gray-900">Pengingat Booster Otomatis</h3>
                <p class="mt-2 text-gray-600 text-sm leading-relaxed">Notifikasi jadwal booster sehingga tidak ada dosis yang terlewat.</p>
            </div>
            <div class="bg-white rounded-2xl shadow-sm border border-pink-100 p-6">
                <div class="w-12 h-12 rounded-full bg-pink-100 text-pink-600 flex items-center justify-center mb-4">
                    <i class="fas fa-user-md"></i>
                </div>
                <h3 class="font-bold text-lg text-gray-900">Kolaborasi Dokter & Pemilik</h3>
                <p class="mt-2 text-gray-600 text-sm leading-relaxed">Berbagi akses data vaksin antara pemilik dan dokter hewan dengan aman.</p>
            </div>
        </div>
    </section>

    <section id="statistik" class="bg-white/80 border-y border-pink-100 py-16">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 grid md:grid-cols-3 gap-6 text-center">
            <div class="p-6">
                <p class="text-4xl font-black text-pink-500">+250</p>
                <p class="text-gray-500 mt-2">Klinik Hewan Terintegrasi</p>
            </div>
            <div class="p-6">
                <p class="text-4xl font-black text-pink-500">92%</p>
                <p class="text-gray-500 mt-2">Pengguna Merasa Lebih Tenang</p>
            </div>
            <div class="p-6">
                <p class="text-4xl font-black text-pink-500">100%</p>
                <p class="text-gray-500 mt-2">Data Terenkripsi Aman</p>
            </div>
        </div>
    </section>

    <section id="testimoni" class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="text-center mb-10">
            <span class="text-sm font-semibold text-pink-500 uppercase tracking-widest">Kata Mereka</span>
            <h2 class="mt-3 text-3xl font-bold text-gray-900">Pemilik & Dokter Senang</h2>
        </div>
        <div class="grid md:grid-cols-2 gap-6">
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-pink-100">
                <p class="text-gray-600 italic">“PetVax bikin aku gak pernah lupa jadwal vaksin. Reminder-nya manis, tampilannya juga bikin nyaman.”</p>
                <div class="mt-4 flex items-center">
                    <div class="w-10 h-10 rounded-full bg-pink-100 flex items-center justify-center text-pink-600 font-bold">VA</div>
                    <div class="ml-3">
                        <p class="font-semibold text-gray-900">Vania A.</p>
                        <p class="text-xs text-gray-500">Pemilik 2 kucing</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-pink-100">
                <p class="text-gray-600 italic">“Sebagai dokter hewan, saya tinggal cek dashboard untuk lihat riwayat vaksin pasien. Sangat membantu!”</p>
                <div class="mt-4 flex items-center">
                    <div class="w-10 h-10 rounded-full bg-pink-100 flex items-center justify-center text-pink-600 font-bold">DR</div>
                    <div class="ml-3">
                        <p class="font-semibold text-gray-900">drh. Rara</p>
                        <p class="text-xs text-gray-500">Dokter Hewan</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-gradient-to-r from-pink-500 to-pink-400 rounded-3xl px-8 md:px-16 py-12 text-white shadow-xl flex flex-col md:flex-row items-center justify-between">
            <div>
                <p class="uppercase text-xs tracking-[0.3em] text-white/80">Mulai Gratis</p>
                <h3 class="mt-3 text-3xl font-bold leading-snug">Catat setiap vaksin & jadwal booster dengan indah.</h3>
                <p class="mt-3 text-white/80">PetVax hadir gratis untuk pengguna individu. Dokter hewan bisa mendaftar dan mengelola banyak pasien sekaligus.</p>
            </div>
            <div class="mt-6 md:mt-0 flex space-x-3">
                <a href="{{ route('register') }}" class="px-6 py-3 bg-white text-pink-600 font-bold rounded-full shadow-md hover:shadow-lg transition">Daftar Sekarang</a>
                <a href="{{ route('login') }}" class="px-6 py-3 border border-white/70 rounded-full font-semibold text-white hover:bg-white/10 transition">Saya Sudah Punya Akun</a>
            </div>
        </div>
    </section>

    <footer class="bg-white border-t border-pink-100 py-6 text-center text-sm text-gray-500">
        © {{ date('Y') }} PetVax. Dibuat penuh kasih untuk hewan kesayangan Anda. 💗
    </footer>

</body>
</html>