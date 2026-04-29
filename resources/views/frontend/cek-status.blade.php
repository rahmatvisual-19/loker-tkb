@extends('layouts.frontend')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-12">
    <!-- Header Hasil Pencarian -->
    <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="flex items-center gap-4">
            <a href="/" class="p-2.5 bg-white rounded-xl border border-gray-200 text-gray-500 hover:text-green-600 transition-colors shadow-sm">
                <i data-lucide="arrow-left" class="w-5 h-5"></i>
            </a>
            <div>
                <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight">Status Lamaran Anda</h1>
                <p class="text-gray-500 mt-0.5">Menampilkan hasil untuk email: <strong class="text-green-600">{{ $email }}</strong></p>
            </div>
        </div>
    </div>

    <!-- Tampilan Data -->
    @if($applications->count() > 0)
        <div class="space-y-4">
            @foreach($applications as $app)
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div>
                    <h3 class="text-xl font-bold text-gray-900 mb-1.5">{{ $app->job->title ?? 'Posisi Telah Dihapus' }}</h3>
                    <div class="flex flex-wrap items-center gap-4 text-sm text-gray-500">
                        <span class="flex items-center gap-1.5">
                            <i data-lucide="building-2" class="w-4 h-4"></i> Tokabe.id
                        </span>
                        <span class="flex items-center gap-1.5">
                            <i data-lucide="calendar" class="w-4 h-4"></i> Dilamar pada {{ $app->created_at->format('d M Y, H:i') }}
                        </span>
                    </div>
                </div>
                
                <div>
                    @php
                        $badgeColors = [
                            'Menunggu' => 'bg-gray-100 text-gray-600 border-gray-200',
                            'Direview' => 'bg-blue-50 text-blue-700 border-blue-200',
                            'Wawancara' => 'bg-amber-50 text-amber-700 border-amber-200',
                            'Diterima' => 'bg-green-50 text-green-700 border-green-200',
                            'Ditolak' => 'bg-red-50 text-red-700 border-red-200',
                        ];
                        $dotColors = [
                            'Menunggu' => 'bg-gray-400', 'Direview' => 'bg-blue-500', 'Wawancara' => 'bg-amber-500', 'Diterima' => 'bg-green-500', 'Ditolak' => 'bg-red-500'
                        ];
                        $statusClass = $badgeColors[$app->status] ?? $badgeColors['Menunggu'];
                        $dotClass = $dotColors[$app->status] ?? $dotColors['Menunggu'];
                    @endphp
                    <span class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-bold border {{ $statusClass }}">
                        <span class="w-2 h-2 rounded-full {{ $dotClass }} animate-pulse"></span>
                        {{ $app->status }}
                    </span>
                </div>
            </div>
            @endforeach
        </div>
    @else
        <!-- State Jika Email Tidak Ditemukan -->
        <div class="bg-white p-12 rounded-3xl border border-gray-100 shadow-sm text-center">
            <div class="w-20 h-20 bg-red-50 text-red-400 rounded-full flex items-center justify-center mx-auto mb-5">
                <i data-lucide="search-x" class="w-10 h-10"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-800 mb-2">Riwayat Tidak Ditemukan</h3>
            <p class="text-gray-500 max-w-md mx-auto leading-relaxed">Kami tidak menemukan riwayat lamaran yang terhubung dengan email <strong class="text-gray-800">{{ $email }}</strong>. Pastikan penulisan email sudah benar atau Anda mungkin belum melamar.</p>
            
            <div class="mt-8">
                <a href="/" class="inline-flex items-center gap-2 bg-green-600 text-white px-6 py-3 rounded-xl font-bold hover:bg-green-700 transition-colors shadow-sm">
                    <i data-lucide="briefcase" class="w-4 h-4"></i> Lihat Lowongan Tersedia
                </a>
            </div>
        </div>
    @endif
</div>
@endsection