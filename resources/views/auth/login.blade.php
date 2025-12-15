<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk | PetVax</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: radial-gradient(circle at top, #ffeaf6, #fff9fc 55%);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center px-4 py-12">

    <a href="{{ url('/') }}" class="fixed top-6 left-6 inline-flex items-center text-pink-500 font-semibold hover:text-pink-600 text-sm">
        <i class="fas fa-arrow-left mr-2"></i> Kembali ke Beranda
    </a>

    <div class="w-full max-w-md bg-white/90 backdrop-blur rounded-3xl shadow-2xl border border-pink-100 px-8 py-10 relative">
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-14 h-14 rounded-full bg-pink-100 text-pink-500 text-2xl mb-4">
                💗
            </div>
            <h2 class="text-3xl font-extrabold text-gray-900">Masuk ke PetVax</h2>
            <p class="text-sm text-gray-500 mt-2">Pantau riwayat vaksin hewan kesayangan Anda.</p>
        </div>

        <!-- 1. AREA NOTIFIKASI MERAH (Akun Nonaktif/Belum Verifikasi) -->
        @if ($errors->has('email') && $errors->first('email') === 'Akun Anda nonaktif. Silakan aktifkan terlebih dahulu.')
            <div class="bg-red-50 border border-red-500 text-red-700 px-4 py-3 rounded-lg relative mb-6 font-medium" role="alert">
                <p class="text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline mr-2 align-text-bottom" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm-1-12a1 1 0 102 0V8a1 1 0 10-2 0V6zm2 6a1 1 0 10-2 0v3a1 1 0 102 0v-3z" clip-rule="evenodd" />
                    </svg>
                    {{ $errors->first('email') }}
                </p>
            </div>
        <!-- 2. AREA NOTIFIKASI ERROR LAINNYA (Error validasi atau kredensial salah) -->
        @elseif ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative mb-6" role="alert">
                <p class="text-sm">{{ $errors->first() }}</p>
            </div>
        @endif
        
        <!-- 3. AREA NOTIFIKASI HIJAU (Status/Sukses, misal setelah registrasi) -->
        @if (session('success'))
            <div class="mb-6 font-medium text-sm text-green-700 bg-green-100 border border-green-400 rounded-lg p-4 shadow-sm">
                {{ session('success') }}
            </div>
        @endif
        
        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <div>
                <label for="email" class="block text-gray-700 text-sm font-semibold mb-2">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus 
                        class="w-full px-4 py-3 border border-pink-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-pink-400 transition duration-150 placeholder:text-gray-400"
                        placeholder="namakamu@email.com">
            </div>

            <div>
                <label for="password" class="block text-gray-700 text-sm font-semibold mb-2">Password</label>
                <input type="password" id="password" name="password" required 
                        class="w-full px-4 py-3 border border-pink-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-pink-400 transition duration-150 placeholder:text-gray-400"
                        placeholder="••••••••">
            </div>

            <div class="flex justify-between items-center mb-6">
                <label class="flex items-center text-sm text-gray-600">
                    <input type="checkbox" name="remember" class="form-checkbox h-4 w-4 text-pink-500 rounded border-pink-200 focus:ring-pink-400">
                    <span class="ml-2">Ingat Saya</span>
                </label>
                <a href="{{ url('/') }}" class="text-sm text-pink-500 hover:text-pink-600 font-semibold">Beranda</a>
            </div>

            <div>
                <label for="role" class="block text-gray-700 text-sm font-semibold mb-2">Masuk sebagai:</label>
                <select id="role" name="role" required
                        class="w-full px-4 py-3 border border-pink-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-pink-400 transition duration-150 bg-white">
                    <option value="pengguna">Pengguna</option>
                    <option value="dokter_hewan">Dokter Hewan</option>
                </select>
            </div>
            
            <button type="submit" class="w-full bg-pink-500 text-white py-3 rounded-2xl hover:bg-pink-600 transition duration-200 font-bold shadow-lg shadow-pink-200">
                Masuk & Mulai Pantau
            </button>

            <p class="text-center text-sm text-gray-500">
                Belum punya akun? 
                <a href="{{ route('register') }}" class="text-pink-500 hover:text-pink-600 font-semibold">Daftar sekarang</a>
            </p>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js" defer></script>
</body>
</html>
