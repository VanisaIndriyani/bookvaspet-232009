<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Transaksi - PetVax</title>
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
        <div class="max-w-4xl mx-auto">
            <div class="mb-6">
                <a href="{{ route('transactions.index') }}" class="text-pink-600 hover:text-pink-800">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali ke Daftar Transaksi
                </a>
            </div>

            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Informasi Vaksinasi -->
            <div class="bg-white border border-pink-100 rounded-3xl p-6 shadow-sm mb-6">
                <h3 class="text-xl font-bold text-gray-800 mb-4">
                    <i class="fas fa-syringe text-pink-600 mr-2"></i>Informasi Vaksinasi
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-600">Hewan</p>
                        <p class="font-semibold text-gray-900">{{ $vaccination->animal->nama }} ({{ $vaccination->animal->jenis }})</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Jenis Vaksin</p>
                        <p class="font-semibold text-gray-900">{{ $vaccination->jenis_vaksin }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Tanggal Vaksin</p>
                        <p class="font-semibold text-gray-900">{{ $vaccination->tanggal_vaksin->format('d M Y') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Dokter</p>
                        <p class="font-semibold text-gray-900">{{ $vaccination->dokter ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <!-- Informasi Pembayaran -->
            <div class="bg-white border border-pink-100 rounded-3xl p-6 shadow-sm mb-6">
                <h3 class="text-xl font-bold text-gray-800 mb-4">
                    <i class="fas fa-money-bill-wave text-pink-600 mr-2"></i>Informasi Pembayaran
                </h3>
                
                @if(!$vaccination->amount)
                    <div class="p-4 bg-yellow-50 rounded-lg border border-yellow-200">
                        <p class="text-yellow-800">
                            <i class="fas fa-info-circle mr-2"></i>
                            Dokter belum menetapkan nominal pembayaran. Silakan tunggu.
                        </p>
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <p class="text-sm text-gray-600">Nominal Pembayaran</p>
                            <p class="text-2xl font-bold text-gray-900">Rp {{ number_format($vaccination->amount, 0, ',', '.') }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Status</p>
                            @if($vaccination->payment_status === 'pending')
                                <span class="px-3 py-1 text-sm font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    <i class="fas fa-clock mr-1"></i>Menunggu Pembayaran
                                </span>
                            @elseif($vaccination->payment_status === 'paid')
                                <span class="px-3 py-1 text-sm font-semibold rounded-full bg-blue-100 text-blue-800">
                                    <i class="fas fa-check-circle mr-1"></i>Menunggu Verifikasi
                                </span>
                            @elseif($vaccination->payment_status === 'verified')
                                <span class="px-3 py-1 text-sm font-semibold rounded-full bg-green-100 text-green-800">
                                    <i class="fas fa-check-double mr-1"></i>Terverifikasi
                                </span>
                            @elseif($vaccination->payment_status === 'rejected')
                                <span class="px-3 py-1 text-sm font-semibold rounded-full bg-red-100 text-red-800">
                                    <i class="fas fa-times-circle mr-1"></i>Ditolak
                                </span>
                            @endif
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Metode Pembayaran</p>
                            <p class="font-semibold text-gray-900">{{ $vaccination->payment_method ?? 'Transfer Bank' }}</p>
                        </div>
                    </div>

                    <!-- Form Upload Bukti Pembayaran -->
                    @if($vaccination->payment_status === 'pending')
                        <div class="mt-6 p-4 bg-pink-50 rounded-lg border border-pink-200">
                            <h4 class="font-semibold text-gray-800 mb-3">
                                <i class="fas fa-upload text-pink-600 mr-2"></i>Upload Bukti Pembayaran
                            </h4>
                            <form action="{{ route('transactions.upload-proof', $vaccination->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-4">
                                    <label for="payment_proof" class="block text-sm font-semibold text-gray-700 mb-2">
                                        Pilih File Bukti Transfer <span class="text-red-500">*</span>
                                    </label>
                                    <input type="file" name="payment_proof" id="payment_proof" required accept="image/*"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500">
                                    <p class="mt-1 text-xs text-gray-500">Format: JPG, PNG, GIF (Maks. 2MB)</p>
                                    @error('payment_proof')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label class="block text-sm font-semibold text-gray-700 mb-3">
                                        Metode Pembayaran <span class="text-red-500">*</span>
                                    </label>
                                    
                                    <!-- Hidden input untuk form submission -->
                                    <input type="hidden" name="payment_method" id="payment_method" value="{{ old('payment_method', $vaccination->payment_method ?? '') }}" required>
                                    
                                    <!-- Transfer Bank -->
                                    <div class="mb-4">
                                        <p class="text-xs font-semibold text-gray-500 uppercase mb-2">Transfer Bank</p>
                                        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                                            <button type="button" onclick="selectPayment('Transfer Bank')" 
                                                class="payment-option p-4 border-2 rounded-lg hover:border-pink-500 hover:bg-pink-50 transition text-center {{ old('payment_method', $vaccination->payment_method) === 'Transfer Bank' ? 'border-pink-500 bg-pink-50' : 'border-gray-200' }}">
                                                <div class="text-2xl mb-2">🏦</div>
                                                <div class="text-xs font-semibold text-gray-700">Transfer Bank</div>
                                            </button>
                                        </div>
                                    </div>
                                    
                                    <!-- E-Wallet -->
                                    <div class="mb-4">
                                        <p class="text-xs font-semibold text-gray-500 uppercase mb-2">E-Wallet</p>
                                        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                                            <button type="button" onclick="selectPayment('OVO')" 
                                                class="payment-option p-4 border-2 rounded-lg hover:border-pink-500 hover:bg-pink-50 transition text-center {{ old('payment_method', $vaccination->payment_method) === 'OVO' ? 'border-pink-500 bg-pink-50' : 'border-gray-200' }}">
                                                <div class="mb-2 flex justify-center items-center h-10">
                                                    <div class="w-20 h-10 bg-gradient-to-r from-purple-600 to-purple-700 rounded-lg flex items-center justify-center shadow-sm">
                                                        <span class="text-white font-bold text-base tracking-tight">OVO</span>
                                                    </div>
                                                </div>
                                                <div class="text-xs font-semibold text-gray-700">OVO</div>
                                            </button>
                                            <button type="button" onclick="selectPayment('GoPay')" 
                                                class="payment-option p-4 border-2 rounded-lg hover:border-pink-500 hover:bg-pink-50 transition text-center {{ old('payment_method', $vaccination->payment_method) === 'GoPay' ? 'border-pink-500 bg-pink-50' : 'border-gray-200' }}">
                                                <div class="mb-2 flex justify-center items-center h-10">
                                                    <div class="w-20 h-10 bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg flex items-center justify-center shadow-sm">
                                                        <span class="text-white font-bold text-sm tracking-tight">GoPay</span>
                                                    </div>
                                                </div>
                                                <div class="text-xs font-semibold text-gray-700">GoPay</div>
                                            </button>
                                            <button type="button" onclick="selectPayment('DANA')" 
                                                class="payment-option p-4 border-2 rounded-lg hover:border-pink-500 hover:bg-pink-50 transition text-center {{ old('payment_method', $vaccination->payment_method) === 'DANA' ? 'border-pink-500 bg-pink-50' : 'border-gray-200' }}">
                                                <div class="mb-2 flex justify-center items-center h-10">
                                                    <div class="w-20 h-10 bg-gradient-to-r from-green-500 to-green-600 rounded-lg flex items-center justify-center shadow-sm">
                                                        <span class="text-white font-bold text-base tracking-tight">DANA</span>
                                                    </div>
                                                </div>
                                                <div class="text-xs font-semibold text-gray-700">DANA</div>
                                            </button>
                                            <button type="button" onclick="selectPayment('ShopeePay')" 
                                                class="payment-option p-4 border-2 rounded-lg hover:border-pink-500 hover:bg-pink-50 transition text-center {{ old('payment_method', $vaccination->payment_method) === 'ShopeePay' ? 'border-pink-500 bg-pink-50' : 'border-gray-200' }}">
                                                <div class="mb-2 flex justify-center items-center h-10">
                                                    <div class="w-20 h-10 bg-gradient-to-r from-orange-500 to-orange-600 rounded-lg flex items-center justify-center shadow-sm">
                                                        <span class="text-white font-bold text-xs tracking-tight">Shopee</span>
                                                    </div>
                                                </div>
                                                <div class="text-xs font-semibold text-gray-700">ShopeePay</div>
                                            </button>
                                        </div>
                                    </div>
                                    
                                    <!-- QR Code -->
                                    <div class="mb-4">
                                        <p class="text-xs font-semibold text-gray-500 uppercase mb-2">QR Code</p>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 max-w-md">
                                            <button type="button" onclick="selectPayment('QRIS')" 
                                                class="payment-option p-4 border-2 rounded-lg hover:border-pink-500 hover:bg-pink-50 transition text-center {{ old('payment_method', $vaccination->payment_method) === 'QRIS' ? 'border-pink-500 bg-pink-50' : 'border-gray-200' }}">
                                                <div class="mb-2 flex justify-center">
                                                    <div id="qris-qrcode" class="w-24 h-24 mx-auto bg-white p-2 rounded"></div>
                                                </div>
                                                <div class="text-xs font-semibold text-gray-700">QRIS</div>
                                            </button>
                                        </div>
                                    </div>
                                    
                                    @error('payment_method')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <button type="submit" class="w-full md:w-auto px-6 py-3 bg-pink-500 hover:bg-pink-600 text-white rounded-lg font-semibold transition">
                                    <i class="fas fa-upload mr-2"></i>Upload Bukti Pembayaran
                                </button>
                            </form>
                        </div>
                    @endif

                    <!-- Bukti Pembayaran yang Sudah Diupload -->
                    @if($vaccination->payment_proof)
                        <div class="mt-6 p-4 bg-gray-50 rounded-lg border border-gray-200">
                            <p class="text-sm font-semibold text-gray-700 mb-2">Bukti Pembayaran</p>
                            <img src="{{ asset('storage/' . $vaccination->payment_proof) }}" 
                                 alt="Bukti Pembayaran" 
                                 class="max-w-md h-auto rounded-lg border border-gray-300"
                                 onerror="this.src='data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'400\' height=\'300\'%3E%3Crect fill=\'%23ddd\' width=\'400\' height=\'300\'/%3E%3Ctext x=\'50%25\' y=\'50%25\' text-anchor=\'middle\' dy=\'.3em\' fill=\'%23999\' font-family=\'sans-serif\' font-size=\'18\'%3EGambar tidak dapat dimuat%3C/text%3E%3C/svg%3E';">
                        </div>
                    @endif

                    @if($vaccination->payment_note)
                        <div class="mt-4 p-4 bg-blue-50 rounded-lg border border-blue-200">
                            <p class="text-sm font-semibold text-gray-700 mb-1">Catatan dari Dokter:</p>
                            <p class="text-sm text-gray-600">{{ $vaccination->payment_note }}</p>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/qrcode@1.5.3/build/qrcode.min.js"></script>
    <script>
        function selectPayment(method) {
            // Set value ke hidden input
            document.getElementById('payment_method').value = method;
            
            // Remove active class dari semua button
            document.querySelectorAll('.payment-option').forEach(btn => {
                btn.classList.remove('border-pink-500', 'bg-pink-50');
                btn.classList.add('border-gray-200');
            });
            
            // Add active class ke button yang diklik
            event.target.closest('.payment-option').classList.remove('border-gray-200');
            event.target.closest('.payment-option').classList.add('border-pink-500', 'bg-pink-50');
        }
        
        // Generate QR Code untuk QRIS
        document.addEventListener('DOMContentLoaded', function() {
            // Generate QRIS QR Code - menggunakan data sederhana untuk demo
            // Dalam production, ini harus menggunakan data QRIS yang valid dari payment gateway
            const qrisData = 'https://petvax.com/payment/qris?id={{ $vaccination->id }}';
            const qrContainer = document.getElementById('qris-qrcode');
            
            // Check if element exists before manipulating
            if (!qrContainer) {
                console.warn('QR Code container not found');
                return;
            }
            
            // Gunakan API QR code generator sebagai fallback yang lebih reliable
            const qrUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=' + encodeURIComponent(qrisData);
            qrContainer.innerHTML = '<img src="' + qrUrl + '" alt="QRIS QR Code" class="w-full h-full object-contain rounded">';
            
            // Alternatif: Generate dengan library QRCode.js jika tersedia
            if (typeof QRCode !== 'undefined') {
                try {
                    QRCode.toCanvas(qrContainer, qrisData, {
                        width: 200,
                        margin: 2,
                        color: {
                            dark: '#000000',
                            light: '#FFFFFF'
                        }
                    }, function (error) {
                        if (error) {
                            console.error('QR Code generation error:', error);
                        }
                    });
                } catch (e) {
                    console.error('QRCode library error:', e);
                }
            }
        });
    </script>
    <style>
        .payment-option {
            background: white;
            cursor: pointer;
        }
        .payment-option:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .payment-option.active {
            border-color: #ec4899 !important;
            background-color: #fdf2f8 !important;
        }
        #qris-qrcode {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        #qris-qrcode canvas {
            max-width: 100%;
            height: auto;
        }
    </style>
</body>
</html>

