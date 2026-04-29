<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Tokabe.id</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen p-4 font-sans relative overflow-hidden">
    
    <!-- Dekorasi Background -->
    <div class="absolute -top-24 -right-24 w-96 h-96 bg-green-200 rounded-full mix-blend-multiply filter blur-3xl opacity-50 animate-blob"></div>
    <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-blue-200 rounded-full mix-blend-multiply filter blur-3xl opacity-50 animate-blob animation-delay-2000"></div>

    <div class="w-full max-w-md bg-white rounded-3xl shadow-xl border border-gray-100 p-8 relative z-10">
        
        <!-- Logo -->
        <div class="flex items-center justify-center gap-2 mb-8">
            <div class="bg-green-600 text-white p-2 rounded-xl shadow-sm">
                <i data-lucide="building-2" class="w-7 h-7"></i>
            </div>
            <span class="font-extrabold text-3xl tracking-tight text-gray-900">
                tokabe<span class="text-green-600">Admin</span>
            </span>
        </div>

        <div class="text-center mb-8">
            <h2 class="text-2xl font-bold text-gray-900">Selamat Datang Kembali</h2>
            <p class="text-sm text-gray-500 mt-1">Silakan masuk ke panel administrasi Anda.</p>
        </div>

        <!-- Pesan Error -->
        @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-600 p-4 rounded-xl text-sm mb-6 flex items-start gap-3">
            <i data-lucide="alert-circle" class="w-5 h-5 shrink-0"></i>
            <span>{{ $errors->first() }}</span>
        </div>
        @endif

        <!-- Form Login -->
        <form action="{{ route('login.post') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1.5">Alamat Email</label>
                <div class="relative">
                    <i data-lucide="mail" class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 w-5 h-5"></i>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="admin@tokabe.id" class="w-full pl-10 border border-gray-300 rounded-xl p-3 focus:border-green-500 focus:ring-1 focus:ring-green-500 outline-none transition-all bg-gray-50 focus:bg-white" required autofocus>
                </div>
            </div>
            
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1.5">Password</label>
                <div class="relative">
                    <i data-lucide="lock" class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 w-5 h-5"></i>
                    <input type="password" name="password" placeholder="••••••••" class="w-full pl-10 border border-gray-300 rounded-xl p-3 focus:border-green-500 focus:ring-1 focus:ring-green-500 outline-none transition-all bg-gray-50 focus:bg-white" required>
                </div>
            </div>

            <div class="flex items-center justify-between">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="remember" class="w-4 h-4 text-green-600 border-gray-300 rounded focus:ring-green-500 cursor-pointer">
                    <span class="text-sm font-medium text-gray-600">Ingat Saya</span>
                </label>
            </div>

            <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3.5 rounded-xl transition-all shadow-sm hover:shadow text-base flex items-center justify-center gap-2 mt-2">
                Masuk Dashboard <i data-lucide="log-in" class="w-5 h-5"></i>
            </button>
        </form>
        
        <div class="mt-8 text-center border-t border-gray-100 pt-6">
            <a href="/" class="text-sm font-medium text-gray-500 hover:text-green-600 transition-colors flex items-center justify-center gap-1.5 inline-flex">
                <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali ke Web Publik
            </a>
        </div>
    </div>
    
    <script>lucide.createIcons();</script>
</body>
</html>