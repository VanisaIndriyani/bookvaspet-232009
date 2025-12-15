<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar | PetVax</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #ffeaf6, #fff0f7, #ffffff);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center px-4 py-12">

    <a href="{{ url('/') }}" class="fixed top-6 left-6 inline-flex items-center text-pink-500 font-semibold hover:text-pink-600 text-sm">
        <i class="fas fa-arrow-left mr-2"></i> Kembali ke Beranda
    </a>

    <div class="w-full max-w-lg bg-white/90 backdrop-blur p-10 rounded-3xl shadow-2xl border border-pink-100">
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-14 h-14 rounded-full bg-pink-100 text-pink-500 text-2xl mb-4">
                🐶
            </div>
            <h2 class="text-3xl font-bold text-gray-900">Buat Akun Baru</h2>
            <p class="text-sm text-gray-500 mt-2">Catat riwayat vaksin & kesehatan hewan dalam satu tempat.</p>
        </div>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <ul class="mt-3 list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf

            <div>
                <label for="name" class="block text-gray-700 text-sm font-semibold mb-2">Nama Lengkap</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus 
                       class="w-full px-4 py-3 border border-pink-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-pink-400 placeholder:text-gray-400"
                       placeholder="Nama Pemilik Hewan">
            </div>

            <div>
                <label for="email" class="block text-gray-700 text-sm font-semibold mb-2">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required 
                       class="w-full px-4 py-3 border border-pink-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-pink-400 placeholder:text-gray-400"
                       placeholder="emailkamu@mail.com">
            </div>

            <div>
                <label for="password" class="block text-gray-700 text-sm font-semibold mb-2">Password</label>
                <input type="password" id="password" name="password" required 
                       class="w-full px-4 py-3 border border-pink-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-pink-400 placeholder:text-gray-400"
                       placeholder="Minimal 8 karakter">
            </div>

            <div>
                <label for="password_confirmation" class="block text-gray-700 text-sm font-semibold mb-2">Konfirmasi Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required 
                       class="w-full px-4 py-3 border border-pink-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-pink-400 placeholder:text-gray-400"
                       placeholder="Ulangi password">
            </div>

            <button type="submit" class="w-full bg-pink-500 text-white py-3 rounded-2xl hover:bg-pink-600 transition duration-200 font-bold shadow-lg shadow-pink-200">
                Buat Akun PetVax
            </button>

            <p class="text-center text-sm text-gray-500">
                Sudah punya akun? 
                <a href="{{ route('login') }}" class="text-pink-500 hover:text-pink-600 font-semibold">Masuk di sini</a>
            </p>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js" defer></script>
</body>
</html>