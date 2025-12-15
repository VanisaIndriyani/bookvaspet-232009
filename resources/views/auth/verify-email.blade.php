<div class="container mx-auto mt-10 p-5">
    <div class="max-w-md mx-auto bg-white rounded-xl shadow-lg p-6">
        <h1 class="text-2xl font-bold mb-4">Verifikasi Alamat Email Anda</h1>

        @if (session('resent'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                Tautan verifikasi baru telah dikirimkan ke alamat email Anda.
            </div>
        @endif

        <p class="mb-4 text-gray-700">
            Sebelum melanjutkan, silakan periksa email Anda untuk tautan verifikasi.
        </p>
        <p class="mb-6 text-gray-700">
            Jika Anda tidak menerima email,
            <form class="inline" method="POST" action="{{ route('verification.resend') }}">
                @csrf
                <button type="submit" class="text-indigo-600 hover:text-indigo-800 font-medium underline">
                    klik di sini untuk meminta yang lain.
                </button>
            </form>
        </p>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-sm text-red-500 hover:text-red-700">Logout</button>
        </form>
    </div>
</div>