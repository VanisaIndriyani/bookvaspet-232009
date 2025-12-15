<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - PetVax</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Sidebar Animation */
        .sidebar-transition {
            transition: transform 0.3s ease-in-out;
        }
        
        /* Card Hover Effect */
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        /* Mobile Menu */
        @media (max-width: 768px) {
            .sidebar-hidden {
                transform: translateX(-100%);
            }
        }

        /* Ensure links are clickable */
        .sidebar-link {
            cursor: pointer !important;
            position: relative;
            z-index: 10000 !important;
            -webkit-tap-highlight-color: transparent;
            pointer-events: auto !important;
        }
        
        /* Ensure sidebar is above overlay */
        #sidebar {
            z-index: 9999 !important;
            pointer-events: auto !important;
        }
        
        #sidebar nav a {
            pointer-events: auto !important;
            z-index: 10001 !important;
        }
        
        #overlay {
            z-index: 40;
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside id="sidebar" class="fixed md:static inset-y-0 left-0 w-64 bg-gradient-to-b from-pink-600 to-pink-500 text-white sidebar-transition sidebar-hidden md:translate-x-0" style="pointer-events: auto; z-index: 9999;">
            <div class="flex flex-col h-full">
                <!-- Logo -->
                <div class="flex items-center justify-between h-16 px-6 border-b border-pink-400">
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-paw text-2xl"></i>
                        <span class="text-xl font-bold">PetVax Admin</span>
                    </div>
                    <button id="closeSidebar" class="md:hidden text-white hover:text-pink-200">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <!-- Navigation -->
                <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
                    <a href="{{ route('admin.dashboard') }}" class="sidebar-link flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-pink-600 transition {{ request()->routeIs('admin.dashboard') ? 'bg-pink-600 shadow-lg' : '' }}" style="display: block; text-decoration: none; color: inherit;">
                        <i class="fas fa-home w-5"></i>
                        <span>Dashboard</span>
                    </a>
                    
                    <a href="{{ route('admin.animals.index') }}" class="sidebar-link flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-pink-600 transition {{ request()->routeIs('admin.animals.*') ? 'bg-pink-600 shadow-lg' : '' }}" style="display: block; text-decoration: none; color: inherit;">
                        <i class="fas fa-paw w-5"></i>
                        <span>Data Hewan</span>
                    </a>

                    

                   

                    
                    <a href="{{ route('admin.vaccinations.index') }}" class="sidebar-link flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-pink-600 transition {{ request()->routeIs('admin.vaccinations.*') ? 'bg-pink-600 shadow-lg' : '' }}" style="display: block; text-decoration: none; color: inherit;">
                        <i class="fas fa-syringe w-5"></i>
                        <span>Riwayat Vaksin</span>
                    </a>
                    
                    <a href="{{ route('admin.transactions.index') }}" class="sidebar-link flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-pink-600 transition {{ request()->routeIs('admin.transactions.*') ? 'bg-pink-600 shadow-lg' : '' }}" style="display: block; text-decoration: none; color: inherit;">
                        <i class="fas fa-money-bill-wave w-5"></i>
                        <span>Transaksi Pembayaran</span>
                    </a>
                    
                    <a href="{{ route('admin.reports.index') }}" class="sidebar-link flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-pink-600 transition {{ request()->routeIs('admin.reports.*') ? 'bg-pink-600 shadow-lg' : '' }}" style="display: block; text-decoration: none; color: inherit;">
                        <i class="fas fa-chart-bar w-5"></i>
                        <span>Laporan & Statistik</span>
                    </a>
                    
                    <a href="{{ route('admin.settings.index') }}" class="sidebar-link flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-pink-600 transition {{ request()->routeIs('admin.settings.*') ? 'bg-pink-600 shadow-lg' : '' }}" style="display: block; text-decoration: none; color: inherit;">
                        <i class="fas fa-cog w-5"></i>
                        <span>Pengaturan</span>
                    </a>
                </nav>

                <!-- User Info -->
                <div class="px-4 py-4 border-t border-pink-400">
                    <div class="flex items-center space-x-3 mb-3">
                        <div class="w-10 h-10 bg-pink-400 rounded-full flex items-center justify-center">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium truncate">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-pink-100 truncate">{{ Auth::user()->email }}</p>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center justify-center space-x-2 px-4 py-2 bg-red-500 hover:bg-red-600 rounded-lg transition">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Overlay for mobile -->
        <div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 md:hidden hidden"></div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Bar -->
            <header class="bg-white shadow-sm h-16 flex items-center justify-between px-4 md:px-6">
                <div class="flex items-center space-x-4">
                    <button id="openSidebar" class="md:hidden text-gray-600 hover:text-gray-900">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    <h1 class="text-xl font-semibold text-gray-800">@yield('page-title', 'Dashboard')</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <button class="text-gray-600 hover:text-gray-900 relative">
                        <i class="fas fa-bell"></i>
                        <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full"></span>
                    </button>
                    <div class="hidden md:flex items-center space-x-2 text-sm text-gray-600">
                        <span>Selamat datang,</span>
                        <span class="font-semibold text-pink-600">{{ Auth::user()->name }}</span>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto p-4 md:p-6">
                @if(session('status'))
                    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
                        {{ session('status') }}
                    </div>
                @endif

                @if(session('success'))
                    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                @if(isset($errors) && $errors->any())
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <script>
        // Mobile Sidebar Toggle
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        const openBtn = document.getElementById('openSidebar');
        const closeBtn = document.getElementById('closeSidebar');

        function closeSidebar() {
            sidebar.classList.add('sidebar-hidden');
            overlay.classList.add('hidden');
        }

        function openSidebar() {
            sidebar.classList.remove('sidebar-hidden');
            overlay.classList.remove('hidden');
        }
        
        openBtn.addEventListener('click', openSidebar);
        closeBtn.addEventListener('click', closeSidebar);
        overlay.addEventListener('click', closeSidebar);

        // Tutup sidebar saat link diklik (untuk mobile)
        document.querySelectorAll('.sidebar-link').forEach(link => {
            link.addEventListener('click', () => {
                // Hanya tutup di mobile (screen width < 768px)
                if (window.innerWidth < 768) {
                    closeSidebar();
                }
            });
        });
    </script>
</body>
</html>

