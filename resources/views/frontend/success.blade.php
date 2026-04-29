@extends('layouts.frontend')
<!-- Tambahkan di dalam tag <head> -->
<link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">
@section('content')
<div class="max-w-3xl mx-auto px-4 py-16 md:py-24 text-center">
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 md:p-16 relative overflow-hidden">
        
        <!-- Efek dekorasi background -->
        <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-green-400 to-green-600"></div>
        <div class="absolute -right-10 -top-10 w-40 h-40 bg-green-50 rounded-full opacity-50 blur-2xl"></div>
        <div class="absolute -left-10 -bottom-10 w-40 h-40 bg-blue-50 rounded-full opacity-50 blur-2xl"></div>

        <div class="relative z-10">
            <!-- Icon Checklist -->
            <div class="w-24 h-24 bg-green-50 text-green-600 rounded-full flex items-center justify-center mx-auto mb-8 animate-bounce" style="animation-iteration-count: 1;">
                <i data-lucide="check-circle" class="w-12 h-12"></i>
            </div>
            
            <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-4 tracking-tight">Lamaran Berhasil Dikirim!</h1>
            
            <p class="text-lg text-gray-600 mb-8 max-w-xl mx-auto leading-relaxed">
                Terima kasih atas ketertarikan Anda bergabung dengan <strong>Tokabe.id</strong>. Tim HRD kami akan segera meninjau CV dan kualifikasi Anda. 
                <br><br>
                Jika memenuhi kriteria, kami akan menghubungi Anda melalui <strong>Email</strong> atau <strong>WhatsApp</strong> untuk tahapan selanjutnya.
            </p>
            
            <div class="pt-6 border-t border-gray-100 flex justify-center">
                <a href="/" class="inline-flex items-center justify-center gap-2 bg-green-600 hover:bg-green-700 transition-colors text-white px-8 py-3.5 rounded-xl font-bold shadow-sm group">
                    <i data-lucide="arrow-left" class="w-5 h-5 group-hover:-translate-x-1 transition-transform"></i> 
                    Kembali ke Beranda
                </a>
            </div>
        </div>

    </div>
</div>
@endsection