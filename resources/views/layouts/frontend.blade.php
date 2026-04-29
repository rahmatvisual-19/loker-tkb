<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tokabe.id - Karir</title>
    
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-[#f8f9fa] font-sans antialiased flex flex-col min-h-screen">
    
    <!-- Navbar Top -->
    <nav class="bg-white px-4 md:px-8 py-4 flex items-center justify-between sticky top-0 z-50 border-b border-gray-100 shadow-sm">
        
        <!-- Bagian Logo -->
        <a href="/" class="flex items-center gap-3">
            <img src="{{ asset('tokabe teks hitam.png') }}" alt="Logo Tokabe.id" class="h-8 md:h-10 w-auto object-contain">
        </a>
        
        <!-- Menu Navigasi Desktop -->
        <div class="hidden md:flex items-center gap-8 text-sm font-medium text-gray-500">
            <a href="/" class="text-gray-900 border-b-2 border-green-600 pb-1">Lowongan</a>
            
            <!-- Link Kebijakan Privasi -->
            <a href="{{ route('privacy') }}" class="hover:text-green-600 transition-colors">Kebijakan Privasi</a>
            
            <!-- Link Helpdesk Email (Menampilkan Alamat Email Secara Langsung) -->
            <a href="mailto:loker@tokabe.id" class="text-green-600 hover:text-green-700 font-bold transition-colors flex items-center gap-1.5 bg-green-50 px-3 py-1.5 rounded-lg border border-green-100">
                <i data-lucide="headset" class="w-4 h-4"></i> Helpdesk: loker@tokabe.id
            </a>
        </div>
    </nav>

    <!-- Konten Utama -->
    <main class="flex-1">
        @yield('content')
    </main>

    <!-- Footer Copyright -->
    <footer class="bg-white border-t border-gray-200 mt-auto">
        <div class="max-w-7xl mx-auto px-4 py-8 text-center md:flex md:items-center md:justify-between">
            
            <!-- Logo di footer -->
            <div class="flex items-center justify-center gap-2 mb-4 md:mb-0">
                <img src="{{ asset('tokabe teks hitam.png') }}" alt="Logo Tokabe.id" class="h-6 w-auto grayscale opacity-60 hover:grayscale-0 hover:opacity-100 transition-all cursor-pointer">
            </div>
            
            <!-- Copyright otomatis tahun sekarang -->
            <p class="text-sm text-gray-500 font-medium">
                &copy; {{ date('Y') }} Tokabe.id. All rights reserved.
            </p>
            
            <!-- Link Bantuan Tambahan di Footer -->
            <div class="mt-4 md:mt-0 flex items-center justify-center gap-4 text-sm text-gray-400 font-medium">
                <a href="{{ route('privacy') }}" class="hover:text-green-600 transition-colors">Kebijakan Privasi</a>
                <span>•</span>
                <a href="mailto:loker@tokabe.id" class="hover:text-green-600 transition-colors flex items-center gap-1"><i data-lucide="mail" class="w-3.5 h-3.5"></i> loker@tokabe.id</a>
            </div>
            
        </div>
    </footer>

    <script>lucide.createIcons();</script>
</body>
</html>