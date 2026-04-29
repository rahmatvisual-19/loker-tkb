<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Tokabe</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Alpine.js untuk Sidebar Toggle -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-gray-50 font-sans text-gray-900 overflow-hidden" x-data="{ sidebarOpen: false }">
    <div class="flex h-screen">
        
        <!-- Sidebar (Desktop & Mobile) -->
        <aside 
            class="bg-white border-r border-gray-200 flex flex-col shadow-sm z-20 fixed inset-y-0 left-0 transform transition-transform duration-300 md:relative md:translate-x-0 w-64"
            :class="{'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen}"
        >
            <!-- Logo Area -->
            <div class="h-16 flex items-center px-6 border-b border-gray-100 justify-between">
                <div class="flex items-center gap-2">
                    <div class="bg-green-600 text-white p-1.5 rounded-lg">
                        <i data-lucide="building-2" class="w-5 h-5"></i>
                    </div>
                    <span class="font-extrabold text-xl tracking-tight text-gray-900">
                        tokabe<span class="text-green-600">Admin</span>
                    </span>
                </div>
                <!-- Close Button Mobile -->
                <button @click="sidebarOpen = false" class="md:hidden text-gray-500">
                    <i data-lucide="x" class="w-6 h-6"></i>
                </button>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 px-4 py-6 space-y-1.5 overflow-y-auto">
                
                <!-- Dashboard Link -->
                <a href="{{ route('admin.dashboard') }}" 
                   class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->is('admin') ? 'bg-green-50 text-green-700' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-900' }}">
                    <i data-lucide="layout-dashboard" class="w-5 h-5 {{ request()->is('admin') ? 'text-green-600' : 'text-gray-400' }}"></i>
                    Dashboard
                </a>
                
                <div class="pt-4 pb-2">
                    <p class="px-3 text-xs font-bold uppercase tracking-wider text-gray-400">Master Data</p>
                </div>
                
                <!-- Kelola Lowongan Link -->
                <!-- Menggunakan jobs.* agar tetap hijau saat di halaman create atau edit -->
                <a href="{{ route('jobs.index') }}" 
                   class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('jobs.*') ? 'bg-green-50 text-green-700' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-900' }}">
                    <i data-lucide="briefcase" class="w-5 h-5 {{ request()->routeIs('jobs.*') ? 'text-green-600' : 'text-gray-400' }}"></i>
                    Kelola Lowongan
                </a>

                <!-- Kategori Job Link -->
                <a href="{{ route('categories.index') }}" 
                   class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('categories.*') ? 'bg-green-50 text-green-700' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-900' }}">
                    <i data-lucide="tags" class="w-5 h-5 {{ request()->routeIs('categories.*') ? 'text-green-600' : 'text-gray-400' }}"></i>
                    Kategori Job
                </a>

                <!-- Data Pelamar Link (SUDAH DIUBAH MENJADI HIJAU) -->
                <a href="{{ route('applications.index') }}" 
                   class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('applications.*') ? 'bg-green-50 text-green-700' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-900' }}">
                    <i data-lucide="users" class="w-5 h-5 {{ request()->routeIs('applications.*') ? 'text-green-600' : 'text-gray-400' }}"></i>
                    Data Pelamar
                </a>
            </nav>

            <!-- User Profile Bottom -->
            <!-- User Profile Bottom -->
<div class="p-4 border-t border-gray-100">
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-red-600 hover:bg-red-50 transition-colors">
            <i data-lucide="log-out" class="w-5 h-5"></i>
            Logout ({{ Auth::user()->name }})
        </button>
    </form>
</div>
        </aside>

        <!-- Overlay for mobile sidebar -->
        <div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 bg-gray-900/50 z-10 md:hidden"></div>

        <!-- Main Content Area -->
        <main class="flex-1 flex flex-col h-full overflow-hidden relative">
            
            <!-- Topbar -->
            <header class="h-16 bg-white border-b border-gray-200 flex items-center justify-between px-4 sm:px-6 lg:px-8 shadow-sm relative z-0">
                <div class="flex items-center gap-4">
                    <button @click="sidebarOpen = true" class="md:hidden text-gray-500 hover:text-gray-900">
                        <i data-lucide="menu" class="w-6 h-6"></i>
                    </button>
                    <div class="hidden sm:flex items-center gap-2 text-sm text-gray-500">
                        <span>Admin</span>
                        <i data-lucide="chevron-right" class="w-4 h-4"></i>
                        <span class="font-medium text-gray-900">@yield('page_title', 'Kelola Lowongan')</span>
                    </div>
                </div>
                <div class="flex items-center gap-5">
                    <a href="/" target="_blank" class="text-sm font-medium text-green-600 hover:text-green-700 hidden sm:block">Lihat Web Publik</a>
                    <div class="h-5 w-px bg-gray-300 hidden sm:block"></div>
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center text-green-700 font-bold text-sm">
                            AD
                        </div>
                        <span class="text-sm font-medium hidden sm:block">Admin Tokabe</span>
                    </div>
                </div>
            </header>

            <!-- Content Scrollable -->
            <div class="flex-1 overflow-auto bg-gray-50/50 p-4 sm:p-6 lg:p-8">
                <!-- Flash Messages -->
                @if(session('success'))
                <div class="mb-4 p-4 bg-green-50 border border-green-200 rounded-lg flex items-center gap-3">
                    <i data-lucide="check-circle" class="w-5 h-5 text-green-600"></i>
                    <span class="text-sm text-green-800">{{ session('success') }}</span>
                </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>