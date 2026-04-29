@extends('layouts.admin')

@section('page_title', 'Detail Pelamar')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <div class="flex items-center gap-3">
        <a href="{{ route('applications.index') }}" class="p-2 text-gray-400 hover:text-gray-700 bg-white border border-gray-200 shadow-sm rounded-lg transition-colors">
            <i data-lucide="arrow-left" class="w-5 h-5"></i>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Detail Pelamar</h1>
            <p class="text-sm text-gray-500 mt-0.5">Melihat profil dan kualifikasi secara mendalam.</p>
        </div>
    </div>
    
    <!-- Form Update Status -->
    <div class="bg-white p-2 rounded-xl border border-gray-200 shadow-sm flex items-center gap-2">
        <span class="text-sm font-semibold text-gray-600 pl-2">Status:</span>
        <form action="{{ route('applications.update', $application->id) }}" method="POST" class="flex items-center gap-2">
            @csrf
            @method('PUT')
            <select name="status" class="border border-gray-300 rounded-lg text-sm font-medium focus:ring-green-500 focus:border-green-500 py-1.5 px-3 bg-gray-50">
                <option value="Menunggu" {{ $application->status == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                <option value="Direview" {{ $application->status == 'Direview' ? 'selected' : '' }}>Direview</option>
                <option value="Wawancara" {{ $application->status == 'Wawancara' ? 'selected' : '' }}>Wawancara</option>
                <option value="Diterima" {{ $application->status == 'Diterima' ? 'selected' : '' }}>Diterima</option>
                <option value="Ditolak" {{ $application->status == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
            </select>
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white p-1.5 rounded-lg transition-colors" title="Simpan Status">
                <i data-lucide="check" class="w-4 h-4"></i>
            </button>
        </form>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    
    <!-- Kolom Kiri (Profil Singkat & Dokumen) -->
    <div class="space-y-6 lg:col-span-1">
        <!-- Card Profil -->
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6 text-center">
            <img src="{{ Storage::url($application->photo_path) }}" alt="Photo" class="w-32 h-32 rounded-full object-cover border-4 border-gray-50 shadow-sm mx-auto mb-4 bg-gray-100">
            <h2 class="text-xl font-bold text-gray-900">{{ $application->name }}</h2>
            <p class="text-green-600 font-semibold text-sm mb-4">Melamar: {{ $application->job->title ?? 'Loker Dihapus' }}</p>
            
            <div class="flex flex-col gap-2.5 text-sm text-gray-600 mb-6">
                <a href="mailto:{{ $application->email }}" class="flex items-center justify-center gap-2 hover:text-green-600"><i data-lucide="mail" class="w-4 h-4"></i> {{ $application->email }}</a>
                <a href="https://wa.me/{{ $application->whatsapp }}" target="_blank" class="flex items-center justify-center gap-2 hover:text-green-600"><i data-lucide="phone" class="w-4 h-4"></i> {{ $application->whatsapp }}</a>
                <span class="flex items-center justify-center gap-2"><i data-lucide="map-pin" class="w-4 h-4"></i> {{ $application->domicile }}</span>
            </div>

            <div class="flex gap-2 justify-center">
                <a href="{{ Storage::url($application->cv_path) }}" target="_blank" class="flex-1 bg-gray-900 hover:bg-gray-800 text-white py-2 rounded-lg font-medium text-sm flex items-center justify-center gap-2 transition-colors">
                    <i data-lucide="file-text" class="w-4 h-4"></i> Lihat CV
                </a>
                @if($application->portfolio_link)
                <a href="{{ $application->portfolio_link }}" target="_blank" class="flex-1 bg-blue-50 text-blue-600 hover:bg-blue-100 border border-blue-200 py-2 rounded-lg font-medium text-sm flex items-center justify-center gap-2 transition-colors">
                    <i data-lucide="link" class="w-4 h-4"></i> Portofolio
                </a>
                @endif
            </div>
            
            @if($application->supporting_doc_path)
            <div class="mt-3">
                <a href="{{ Storage::url($application->supporting_doc_path) }}" target="_blank" class="w-full bg-gray-50 text-gray-600 hover:bg-gray-100 border border-gray-200 py-2 rounded-lg font-medium text-sm flex items-center justify-center gap-2 transition-colors">
                    <i data-lucide="paperclip" class="w-4 h-4"></i> File Pendukung Lainnya
                </a>
            </div>
            @endif
        </div>
        
        <!-- Card Info Personal Fisik -->
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6">
            <h3 class="font-bold text-gray-900 mb-4 border-b border-gray-100 pb-2">Informasi Personal</h3>
            <ul class="space-y-3 text-sm text-gray-600">
                <li class="flex justify-between"><span class="font-medium text-gray-500">Gender</span> <span>{{ $application->gender }}</span></li>
                <li class="flex justify-between"><span class="font-medium text-gray-500">TTL</span> <span class="text-right">{{ $application->birth_place }}, {{ \Carbon\Carbon::parse($application->birth_date)->format('d M Y') }}</span></li>
                <li class="flex justify-between"><span class="font-medium text-gray-500">Tinggi/Berat</span> <span>{{ $application->height }} cm / {{ $application->weight }} kg</span></li>
                <li class="flex justify-between"><span class="font-medium text-gray-500">Buta Warna</span> <span>{{ $application->is_color_blind ? 'Ya' : 'Tidak' }}</span></li>
                <li class="flex justify-between"><span class="font-medium text-gray-500">Riwayat Sakit</span> <span class="text-right max-w-[150px]">{{ $application->disease_history ?: 'Tidak Ada' }}</span></li>
            </ul>
        </div>
    </div>

    <!-- Kolom Kanan (Pendidikan, Pengalaman, Harapan) -->
    <div class="space-y-6 lg:col-span-2">
        
        <!-- Card Pendidikan -->
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                <i data-lucide="graduation-cap" class="w-5 h-5 text-green-600"></i> Riwayat Pendidikan
            </h3>
            <div class="bg-gray-50 p-4 rounded-lg border border-gray-100 flex justify-between items-center">
                <div>
                    <h4 class="font-bold text-gray-900 text-lg">{{ $application->institution_name }}</h4>
                    <p class="text-gray-600">{{ $application->education_level }} - {{ $application->major }}</p>
                </div>
                <div class="text-right">
                    <span class="text-xs text-gray-500 font-medium uppercase tracking-wider">Nilai/IPK</span>
                    <p class="text-2xl font-black text-green-600">{{ $application->gpa }}</p>
                </div>
            </div>
        </div>

        <!-- Card Pengalaman -->
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                <i data-lucide="briefcase" class="w-5 h-5 text-green-600"></i> Pengalaman Kerja
            </h3>
            
            @if($application->is_fresh_graduate)
                <div class="text-center py-6 bg-green-50 rounded-lg border border-green-100">
                    <i data-lucide="sparkles" class="w-8 h-8 text-green-500 mx-auto mb-2"></i>
                    <p class="font-bold text-green-700">Kandidat adalah Fresh Graduate</p>
                    <p class="text-sm text-green-600">Belum memiliki pengalaman kerja formal sebelumnya.</p>
                </div>
            @else
                <div class="space-y-4">
                    @php 
                        $experiences = $application->work_experiences ?? []; 
                    @endphp
                    
                    @forelse($experiences as $exp)
                        <div class="relative pl-6 pb-4 border-l-2 border-gray-200 last:border-0 last:pb-0">
                            <div class="absolute w-3 h-3 bg-green-500 rounded-full -left-[7px] top-1.5 ring-4 ring-white"></div>
                            <h4 class="font-bold text-gray-900 text-base">{{ $exp['job_position'] ?? '-' }}</h4>
                            <p class="text-green-600 font-medium text-sm mb-1">{{ $exp['company_name'] ?? '-' }}</p>
                            <p class="text-xs text-gray-400 mb-2 font-medium flex items-center gap-1">
                                <i data-lucide="calendar" class="w-3.5 h-3.5"></i> {{ $exp['work_start_date'] ?? '...' }} s/d {{ $exp['work_end_date'] ?? '...' }}
                            </p>
                            <p class="text-sm text-gray-600 bg-gray-50 p-3 rounded-lg">{{ $exp['job_description'] ?? '-' }}</p>
                        </div>
                    @empty
                        <p class="text-gray-500 text-sm">Data pengalaman kerja tidak ditemukan.</p>
                    @endforelse
                </div>
            @endif
        </div>

        <!-- Card Kesiapan Kerja -->
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                <i data-lucide="target" class="w-5 h-5 text-green-600"></i> Ekspektasi & Kesiapan
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
                    <span class="text-xs text-gray-500 font-medium block mb-1">Ekspektasi Gaji Bersih</span>
                    <span class="font-bold text-gray-900">
                        Rp. {{ number_format((int) preg_replace('/[^0-9]/', '', $application->expected_salary), 0, ',', '.') }}
                    </span>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
                    <span class="text-xs text-gray-500 font-medium block mb-1">Kesiapan Bergabung</span>
                    <span class="font-bold text-gray-900">{{ $application->notice_period }}</span>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
                    <span class="text-xs text-gray-500 font-medium block mb-1">Tugas Luar Kota</span>
                    <span class="font-bold {{ $application->willing_out_of_town ? 'text-green-600' : 'text-red-600' }}">
                        {{ $application->willing_out_of_town ? 'Ya, Bersedia' : 'Tidak Bersedia' }}
                    </span>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection