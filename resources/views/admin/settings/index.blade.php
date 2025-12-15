@extends('layouts.admin')

@section('title', 'Pengaturan')
@section('page-title', 'Pengaturan Akun Admin')

@section('content')
<div class="mb-6">
    <h2 class="text-2xl font-bold text-gray-800">
        <i class="fas fa-cog text-pink-600 mr-2"></i>
        Pengaturan Akun Admin
    </h2>
    <p class="text-gray-600 mt-1">Kelola email dan password akun admin Anda</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Form Ganti Email -->
    <div class="bg-white rounded-xl shadow-md p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
            <i class="fas fa-envelope text-pink-600 mr-2"></i>
            Ganti Email
        </h3>
        
        <form action="{{ route('admin.settings.update-email') }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label for="current_email" class="block text-sm font-medium text-gray-700 mb-2">
                    Email Saat Ini
                </label>
                <input type="email" id="current_email" value="{{ $user->email }}" disabled
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-100 text-gray-600">
            </div>

            <div class="mb-4">
                <label for="new_email" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-envelope text-pink-600 mr-1"></i>
                    Email Baru
                </label>
                <input type="email" name="email" id="new_email" value="{{ old('email') }}" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500">
                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email_current_password" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-lock text-pink-600 mr-1"></i>
                    Konfirmasi Password
                </label>
                <input type="password" name="current_password" id="email_current_password" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500"
                    placeholder="Masukkan password untuk konfirmasi">
                @error('current_password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="w-full bg-pink-500 hover:bg-pink-600 text-white px-4 py-2 rounded-lg font-semibold transition">
                <i class="fas fa-save mr-2"></i>
                Simpan Email Baru
            </button>
        </form>
    </div>

    <!-- Form Ganti Password -->
    <div class="bg-white rounded-xl shadow-md p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
            <i class="fas fa-key text-pink-600 mr-2"></i>
            Ganti Password
        </h3>
        
        <form action="{{ route('admin.settings.update-password') }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label for="password_current_password" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-lock text-pink-600 mr-1"></i>
                    Password Saat Ini
                </label>
                <input type="password" name="current_password" id="password_current_password" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500"
                    placeholder="Masukkan password saat ini">
                @error('current_password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-key text-pink-600 mr-1"></i>
                    Password Baru
                </label>
                <input type="password" name="password" id="password" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500"
                    placeholder="Masukkan password baru">
                @error('password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-key text-pink-600 mr-1"></i>
                    Konfirmasi Password Baru
                </label>
                <input type="password" name="password_confirmation" id="password_confirmation" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500"
                    placeholder="Ulangi password baru">
            </div>

            <button type="submit" class="w-full bg-pink-500 hover:bg-pink-600 text-white px-4 py-2 rounded-lg font-semibold transition">
                <i class="fas fa-save mr-2"></i>
                Simpan Password Baru
            </button>
        </form>
    </div>
</div>

<!-- Informasi Akun -->
<div class="mt-6 bg-white rounded-xl shadow-md p-6">
    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
        <i class="fas fa-user-circle text-pink-600 mr-2"></i>
        Informasi Akun
    </h3>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
            <p class="text-sm text-gray-600 mb-1">Nama</p>
            <p class="font-semibold text-gray-800">{{ $user->name }}</p>
        </div>
        <div>
            <p class="text-sm text-gray-600 mb-1">Email</p>
            <p class="font-semibold text-gray-800">{{ $user->email }}</p>
        </div>
        <div>
            <p class="text-sm text-gray-600 mb-1">Role</p>
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-pink-100 text-pink-800">
                <i class="fas fa-crown mr-1"></i>
                {{ ucfirst($user->role) }}
            </span>
        </div>
    </div>
</div>

<!-- Informasi Sistem -->
<div class="mt-6 bg-white rounded-xl shadow-md p-6">
    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
        <i class="fas fa-info-circle text-pink-600 mr-2"></i>
        Informasi Sistem
    </h3>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
            <p class="text-sm text-gray-600 mb-1">Versi Aplikasi</p>
            <p class="font-semibold text-gray-800">1.0.0</p>
        </div>
        <div>
            <p class="text-sm text-gray-600 mb-1">Framework</p>
            <p class="font-semibold text-gray-800">Laravel</p>
        </div>
        <div>
            <p class="text-sm text-gray-600 mb-1">PHP Version</p>
            <p class="font-semibold text-gray-800">{{ PHP_VERSION }}</p>
        </div>
    </div>
</div>
@endsection

