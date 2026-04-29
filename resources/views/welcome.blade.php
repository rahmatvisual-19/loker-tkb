@extends('layouts.frontend')
<!-- Tambahkan di dalam tag <head> -->
<link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">
@section('content')
    <!-- Hero Section -->
    <header class="bg-green-600 py-16 px-4 text-center">
        <h1 class="text-4xl md:text-5xl font-black text-white mb-4 tracking-wide">Bergabunglah Bersama Tim Tokabe.id</h1>
        

        <!-- Form Cek Status Lamaran -->
        <div class="max-w-xl mx-auto bg-green-700/40 p-2 rounded-2xl backdrop-blur-sm border border-green-500/30">
            <form action="{{ route('cek-status') }}" method="GET" class="flex flex-col sm:flex-row gap-2">
                <div class="relative flex-1">
                    <!-- Icon diletakkan dengan z-10 agar selalu di atas background putih input -->
                    <i data-lucide="mail" class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 w-5 h-5 z-10"></i>
                    <!-- Perbaikan: Tambahan class "bg-white" agar kotak pencarian terlihat jelas -->
                    <input type="email" name="email" placeholder="Masukkan Email untuk cek status lamaran..." class="w-full pl-12 pr-4 py-3.5 rounded-xl border-0 focus:ring-2 focus:ring-green-300 text-gray-900 placeholder-gray-500 font-medium shadow-sm bg-white" required>
                </div>
                <button type="submit" class="bg-gray-900 hover:bg-black text-white px-8 py-3.5 rounded-xl font-bold transition-colors flex items-center justify-center gap-2 shadow-sm">
                    <i data-lucide="search" class="w-4 h-4"></i> Cek Status
                </button>
            </form>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 py-10 space-y-8">
        <!-- Header Section -->
        <div class="bg-white p-4 md:p-5 rounded-2xl shadow-sm border border-gray-100 flex justify-between items-center">
            <h2 class="text-lg font-bold text-gray-800">Peluang Karir Saat Ini <span class="text-green-600">({{ $jobs->count() }})</span></h2>
            <span class="bg-gray-100 text-gray-500 px-4 py-1.5 rounded-full text-sm font-medium">loker.tokabe.id</span>
        </div>

        @if($jobs->count() > 0)
        
        @php
            // Logika Pengurutan Berdasarkan Prioritas
            // Angka lebih kecil = Posisi lebih awal/atas
            $priorityWeight = [
                'Critical' => 1,
                'High Priority' => 2,
                'Medium' => 3,
                'Medium-Low' => 4,
                'Low Priority' => 5,
            ];

            // Mengurutkan data jobs dan menyimpannya di variabel baru ($sortedJobs)
            // Jika ada loker tanpa prioritas yang valid, akan ditaruh di urutan paling bawah (99)
            $sortedJobs = collect($jobs)->sortBy(function($job) use ($priorityWeight) {
                return $priorityWeight[$job->priority] ?? 99;
            });
        @endphp

        <!-- Grid Layout Container (1 kolom HP, 2 Tablet, 3 Desktop) -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            
            <!-- Menggunakan data yang sudah diurutkan ($sortedJobs) -->
            @foreach($sortedJobs as $job)
            <!-- Kita bungkus tiap card dengan x-data Alpine.js untuk fitur Modal -->
            <div x-data="{ showModal: false, acceptedPrivacy: false }" class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-lg hover:border-green-200 transition-all flex flex-col h-full">
                
                <!-- Card Header -->
                <div class="mb-4">
                    <span class="inline-block px-3 py-1 bg-green-50 text-green-700 text-xs font-bold rounded-full mb-3">
                        {{ $job->category->name ?? 'Umum' }}
                    </span>
                    <h3 class="text-xl font-extrabold text-gray-900 leading-tight mb-2">{{ $job->title }}</h3>
                    <p class="text-gray-500 text-sm flex items-center gap-1.5">
                        <i data-lucide="map-pin" class="w-4 h-4 text-gray-400"></i> {{ $job->location }}
                    </p>
                </div>
                
                <!-- Card Body (Badges) -->
                <div class="flex flex-wrap gap-2 mb-6 flex-1">
                    <span class="flex items-center gap-1.5 px-2.5 py-1.5 rounded-lg text-xs font-medium bg-gray-50 text-gray-600 border border-gray-100">
                        <i data-lucide="briefcase" class="w-3.5 h-3.5 text-gray-400"></i> {{ $job->type }}
                    </span>
                    <span class="flex items-center gap-1.5 px-2.5 py-1.5 rounded-lg text-xs font-medium bg-gray-50 text-gray-600 border border-gray-100">
                        <i data-lucide="file-text" class="w-3.5 h-3.5 text-gray-400"></i> {{ $job->status }}
                    </span>
                    <span class="flex items-center gap-1.5 px-2.5 py-1.5 rounded-lg text-xs font-medium bg-blue-50 text-blue-700 border border-blue-100">
                        <i data-lucide="graduation-cap" class="w-3.5 h-3.5 text-blue-500"></i> Min. {{ $job->min_education }}
                    </span>
                    <span class="flex items-center gap-1.5 px-2.5 py-1.5 rounded-lg text-xs font-bold bg-green-50 text-green-700 border border-green-100">
                        <i data-lucide="banknote" class="w-4 h-4 text-green-600"></i> {{ $job->salary_range }}
                    </span>
                </div>

                <!-- Card Footer (Button Trigger Modal) -->
                <div class="pt-4 border-t border-gray-100 mt-auto">
                    <button @click="showModal = true" class="w-full bg-white border-2 border-green-600 text-green-600 hover:bg-green-600 hover:text-white transition-colors py-2.5 rounded-xl font-semibold text-sm flex items-center justify-center gap-2">
                        Lihat Detail
                        <i data-lucide="arrow-right" class="w-4 h-4"></i>
                    </button>
                </div>

                <!-- MODAL POP-UP DETAIL -->
                <div x-show="showModal" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                    <!-- Background Overlay -->
                    <div x-show="showModal" x-transition.opacity class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm transition-opacity" @click="showModal = false"></div>

                    <!-- Modal Panel -->
                    <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                        <div x-show="showModal" 
                             x-transition:enter="ease-out duration-300" 
                             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" 
                             x-transition:leave="ease-in duration-200" 
                             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" 
                             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                             class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-2xl transition-all sm:my-8 w-full sm:max-w-2xl">
                            
                            <!-- Modal Header -->
                            <div class="bg-gray-50 px-6 py-4 border-b border-gray-100 flex justify-between items-center sticky top-0 z-10">
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900" id="modal-title">{{ $job->title }}</h3>
                                    <p class="text-sm text-gray-500">{{ $job->location }} • {{ $job->type }} • Min. {{ $job->min_education }}</p>
                                </div>
                                <button @click="showModal = false" class="text-gray-400 hover:text-red-500 transition-colors p-2 bg-white rounded-full shadow-sm">
                                    <i data-lucide="x" class="w-5 h-5"></i>
                                </button>
                            </div>

                            <!-- Modal Body (Scrollable) -->
                            <div class="px-6 py-6 max-h-[60vh] overflow-y-auto space-y-6">
                                
                                <!-- Kualifikasi -->
                                <div>
                                    <h4 class="text-base font-bold text-gray-900 mb-3 flex items-center gap-2">
                                        <i data-lucide="check-circle" class="w-5 h-5 text-green-600"></i> Kualifikasi
                                    </h4>
                                    <ul class="list-disc pl-5 space-y-1.5 text-gray-600 text-sm">
                                        @php $quals = explode("\n", str_replace("\r", "", $job->qualification)); @endphp
                                        @foreach($quals as $line)
                                            @if(trim($line)) <li>{{ trim($line) }}</li> @endif
                                        @endforeach
                                    </ul>
                                </div>

                                <!-- Deskripsi Pekerjaan -->
                                <div>
                                    <h4 class="text-base font-bold text-gray-900 mb-3 flex items-center gap-2">
                                        <i data-lucide="file-text" class="w-5 h-5 text-green-600"></i> Deskripsi Pekerjaan
                                    </h4>
                                    <ul class="list-disc pl-5 space-y-1.5 text-gray-600 text-sm">
                                        @php $descs = explode("\n", str_replace("\r", "", $job->description)); @endphp
                                        @foreach($descs as $line)
                                            @if(trim($line)) <li>{{ trim($line) }}</li> @endif
                                        @endforeach
                                    </ul>
                                </div>

                                <!-- Fasilitas -->
                                <div>
                                    <h4 class="text-base font-bold text-gray-900 mb-3 flex items-center gap-2">
                                        <i data-lucide="gift" class="w-5 h-5 text-green-600"></i> Fasilitas & Benefit
                                    </h4>
                                    <ul class="list-disc pl-5 space-y-1.5 text-gray-600 text-sm">
                                        @php $facs = explode("\n", str_replace("\r", "", $job->facilities)); @endphp
                                        @foreach($facs as $line)
                                            @if(trim($line)) <li>{{ trim($line) }}</li> @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>

                            <!-- Modal Footer -->
                            <div class="bg-gray-50 px-6 py-4 border-t border-gray-100 flex flex-col gap-4 sticky bottom-0">
                                <!-- Checkbox Kebijakan Privasi -->
                                <div class="flex items-start gap-3 w-full text-left">
                                    <input type="checkbox" 
                                           id="privacy_{{ $job->id }}" 
                                           x-model="acceptedPrivacy" 
                                           class="mt-1 w-4 h-4 text-green-600 border-gray-300 rounded focus:ring-green-500 cursor-pointer">
                                    <label for="privacy_{{ $job->id }}" class="text-sm text-gray-600 cursor-pointer select-none leading-snug">
                                        Saya telah membaca dan menyetujui 
                                        <a href="{{ route('privacy') }}" target="_blank" class="text-green-600 font-bold hover:underline">Kebijakan Privasi</a> Tokabe.id.
                                    </label>
                                </div>
                                
                                <!-- Buttons -->
                                <div class="flex flex-col sm:flex-row gap-3 justify-end items-center">
                                    <button @click="showModal = false" class="w-full sm:w-auto px-5 py-2.5 text-sm font-medium text-gray-600 hover:text-gray-900 bg-white border border-gray-300 rounded-xl hover:bg-gray-50 transition-colors">
                                        Tutup
                                    </button>
                                    <a :href="acceptedPrivacy ? '{{ route('applications.create', $job->id) }}' : '#'" 
                                       @click.prevent="if(!acceptedPrivacy) { 
                                           Swal.fire({
                                               icon: 'warning',
                                               title: 'Perhatian!',
                                               html: 'Harap membaca dan menyetujui <strong>Kebijakan Privasi</strong> terlebih dahulu dengan mencentang kotak yang tersedia.',
                                               confirmButtonText: 'Mengerti',
                                               confirmButtonColor: '#16a34a',
                                               customClass: {
                                                   popup: 'rounded-2xl',
                                                   confirmButton: 'rounded-xl px-6 py-2.5 font-semibold'
                                               }
                                           });
                                       } else {
                                           window.location.href = '{{ route('applications.create', $job->id) }}';
                                       }"
                                       :class="acceptedPrivacy ? 'bg-green-600 hover:bg-green-700 cursor-pointer' : 'bg-gray-400 cursor-not-allowed'"
                                       class="w-full sm:w-auto transition-colors text-white px-6 py-2.5 rounded-xl flex items-center justify-center gap-2 font-semibold shadow-sm">
                                        Lamar Sekarang <i data-lucide="send" class="w-4 h-4"></i>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- END MODAL -->

            </div>
            @endforeach

        </div>
        @else
        <div class="text-center py-16 bg-white rounded-2xl border border-gray-100 shadow-sm">
            <i data-lucide="inbox" class="w-16 h-16 text-gray-300 mx-auto mb-4"></i>
            <h3 class="text-xl font-bold text-gray-600">Belum ada lowongan tersedia saat ini.</h3>
            <p class="text-gray-400 mt-2">Silakan pantau terus halaman ini untuk update terbaru.</p>
        </div>
        @endif
    </main>
@endsection