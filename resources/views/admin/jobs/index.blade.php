@extends('layouts.admin')

@section('page_title', 'Daftar Lowongan')

@section('content')
<!-- Header Section -->
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
    <div>
        <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Daftar Lowongan</h1>
        <p class="text-sm text-gray-500 mt-1">Manajemen data lowongan kerja Tokabe.id</p>
    </div>
    <!-- Tombol untuk memanggil Modal Create -->
    <button type="button" onclick="openModal('modalCreate')" class="w-full sm:w-auto bg-green-600 hover:bg-green-700 text-white px-4 py-2.5 rounded-lg text-sm font-semibold flex items-center justify-center gap-2 shadow-sm transition-colors">
        <i data-lucide="plus" class="w-5 h-5"></i>
        Tambah Loker Baru
    </button>
</div>

<!-- Data Table Container -->
<div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
    
    <!-- Table Action Bar (Search) -->
    <div class="p-4 border-b border-gray-200 flex justify-between items-center bg-white">
        <div class="relative w-full sm:w-72">
            <i data-lucide="search" class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 w-4 h-4"></i>
            <form action="{{ route('jobs.index') }}" method="GET">
                <input 
                    type="text" 
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari lowongan..." 
                    class="pl-9 pr-10 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-1 focus:ring-green-500 focus:border-green-500 w-full transition-all"
                />
                @if(request('search'))
                    <a href="{{ route('jobs.index') }}" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-red-500 transition-colors" title="Reset Pencarian">
                        <i data-lucide="x" class="w-4 h-4"></i>
                    </a>
                @endif
            </form>
        </div>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        @php
            // 1. Menentukan bobot prioritas (Angka lebih kecil = Posisi lebih atas)
            $priorityWeight = [
                'Critical' => 1,
                'High Priority' => 2,
                'Medium' => 3,
                'Medium-Low' => 4,
                'Low Priority' => 5,
            ];

            // 2. Mengurutkan koleksi jobs berdasarkan bobot yang dibuat
            $sortedJobs = collect($jobs)->sortBy(function($job) use ($priorityWeight) {
                return $priorityWeight[$job->priority] ?? 99; // Jika kosong/tidak ada, taruh di paling bawah (99)
            });
        @endphp
        <table class="w-full text-left text-sm text-gray-600">
            <thead class="text-xs text-gray-500 uppercase bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-4 font-semibold">Posisi Pekerjaan</th>
                    <!-- Kolom Prioritas Baru -->
                    <th class="px-6 py-4 font-semibold">Prioritas</th>
                    <th class="px-6 py-4 font-semibold">Kategori</th>
                    <th class="px-6 py-4 font-semibold">Lokasi & Tipe</th>
                    <th class="px-6 py-4 font-semibold text-center">Status</th>
                    <th class="px-6 py-4 font-semibold text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                <!-- 3. Ganti loop dari $jobs menjadi $sortedJobs -->
                @forelse($sortedJobs as $job)
                <tr class="hover:bg-gray-50/80 transition-colors">
                    <td class="px-6 py-4">
                        <span class="font-medium text-gray-900 block">{{ $job->title }}</span>
                    </td>
                    <td class="px-6 py-4">
                        <!-- Indikator Skala Prioritas -->
                        @php
                            $prioColors = [
                                'Low Priority' => ['text' => '#9CA3AF', 'bg' => 'rgba(156, 163, 175, 0.1)'],
                                'Medium-Low' => ['text' => '#60A5FA', 'bg' => 'rgba(96, 165, 250, 0.1)'],
                                'Medium' => ['text' => '#2563EB', 'bg' => 'rgba(37, 99, 235, 0.1)'],
                                'High Priority' => ['text' => '#F97316', 'bg' => 'rgba(249, 115, 22, 0.1)'],
                                'Critical' => ['text' => '#DC2626', 'bg' => 'rgba(220, 38, 38, 0.1)'],
                            ];
                            $style = $prioColors[$job->priority] ?? $prioColors['Medium'];
                        @endphp
                        <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold" style="color: {{ $style['text'] }}; background-color: {{ $style['bg'] }};">
                            {{ $job->priority ?? 'Medium' }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <!-- Warna Kategori Seragam Sesuai Gambar -->
                        @php
                            $catName = $job->category->name ?? 'Tanpa Kategori';
                        @endphp
                        <span class="inline-flex items-center px-3 py-1 rounded-md text-xs font-semibold bg-blue-50 text-blue-600">
                            {{ $catName }} 
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="block text-gray-900">{{ $job->location }}</span>
                        <span class="text-xs text-gray-500 mt-0.5 block">{{ $job->type }}</span>
                    </td>
                    <td class="px-6 py-4 text-center">
                        @if($job->is_active)
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-green-50 text-green-700 border border-green-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Aktif
                        </span>
                        @else
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-600 border border-gray-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span> Draft
                        </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex justify-end gap-2">
                            <!-- Tombol untuk memanggil Modal Edit, perhatikan penggunaan data-job agar aman -->
                            <button type="button" data-job="{{ json_encode($job) }}" onclick="openEditModal(this)" class="p-2 text-gray-400 hover:text-amber-500 hover:bg-amber-50 rounded-lg transition-colors" title="Edit">
                                <i data-lucide="edit" class="w-4 h-4"></i>
                            </button>
                            <form action="{{ route('jobs.destroy', $job->id) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="p-2 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-colors" title="Hapus" onclick="return confirm('Hapus loker ini?')">
                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                        <div class="flex flex-col items-center justify-center gap-2">
                            <i data-lucide="search-x" class="w-8 h-8 text-gray-300"></i>
                            <p>Belum ada data lowongan pekerjaan.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- ================= MODAL CREATE ================= -->
<div id="modalCreate" class="hidden fixed inset-0 z-[99] overflow-y-auto bg-black/60 backdrop-blur-sm transition-all">
    <div class="flex min-h-screen items-start justify-center p-4 sm:p-6 py-10">
        <div class="bg-white rounded-2xl shadow-2xl max-w-4xl w-full relative overflow-hidden">
            <!-- Header Modal (Sticky) -->
            <div class="sticky top-0 bg-white border-b border-gray-100 p-6 flex justify-between items-center z-10">
                <h2 class="text-xl font-bold text-gray-800">Tambah Lowongan Baru</h2>
                <button type="button" onclick="closeModal('modalCreate')" class="p-2 hover:bg-gray-100 rounded-full transition-colors">
                    <i data-lucide="x" class="w-5 h-5 text-gray-500"></i>
                </button>
            </div>
            
            <!-- Body Form Create -->
            <form action="{{ route('jobs.store') }}" method="POST">
                @csrf
                <div class="p-6">
                    <!-- Memanggil Form yang disatukan -->
                    @include('admin.jobs.form_fields')
                </div>
                
                <!-- Footer Modal -->
                <div class="p-6 border-t border-gray-100 flex justify-end gap-3 bg-gray-50">
                    <button type="button" onclick="closeModal('modalCreate')" class="px-5 py-2.5 text-gray-600 font-medium hover:text-gray-800 transition-colors">Batal</button>
                    <button type="submit" class="px-6 py-2.5 bg-green-600 hover:bg-green-700 text-white rounded-xl font-semibold shadow-sm transition-all flex items-center gap-2">
                        <i data-lucide="save" class="w-5 h-5"></i> Simpan Loker
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ================= MODAL EDIT ================= -->
<div id="modalEdit" class="hidden fixed inset-0 z-[99] overflow-y-auto bg-black/60 backdrop-blur-sm transition-all">
    <div class="flex min-h-screen items-start justify-center p-4 sm:p-6 py-10">
        <div class="bg-white rounded-2xl shadow-2xl max-w-4xl w-full relative overflow-hidden">
            <!-- Header Modal (Sticky) -->
            <div class="sticky top-0 bg-white border-b border-gray-100 p-6 flex justify-between items-center z-10">
                <h2 class="text-xl font-bold text-gray-800">Edit Lowongan Pekerjaan</h2>
                <button type="button" onclick="closeModal('modalEdit')" class="p-2 hover:bg-gray-100 rounded-full transition-colors">
                    <i data-lucide="x" class="w-5 h-5 text-gray-500"></i>
                </button>
            </div>
            
            <!-- Body Form Edit -->
            <form id="editForm" method="POST">
                @csrf @method('PUT')
                <div class="p-6">
                    <!-- Memanggil Form yang disatukan -->
                    @include('admin.jobs.form_fields')
                </div>
                
                <!-- Footer Modal -->
                <div class="p-6 border-t border-gray-100 flex justify-end gap-3 bg-gray-50">
                    <button type="button" onclick="closeModal('modalEdit')" class="px-5 py-2.5 text-gray-600 font-medium hover:text-gray-800 transition-colors">Batal</button>
                    <button type="submit" class="px-6 py-2.5 bg-amber-500 hover:bg-amber-600 text-white rounded-xl font-semibold shadow-sm transition-all flex items-center gap-2">
                        <i data-lucide="save" class="w-5 h-5"></i> Update Loker
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- SCRIPT UNTUK MODAL & AUTO-FILL EDIT -->
<script>
    function openModal(id) {
        document.getElementById(id).classList.remove('hidden');
        document.body.style.overflow = 'hidden'; // Mencegah scroll pada background
    }

    function closeModal(id) {
        document.getElementById(id).classList.add('hidden');
        document.body.style.overflow = 'auto'; // Mengembalikan scroll
    }

    function openEditModal(button) {
        // Ambil data JSON dari tombol yang di-klik
        const jobData = button.getAttribute('data-job');
        const job = JSON.parse(jobData);
        
        // Atur URL form action ke route update dengan ID yang sesuai
        const form = document.getElementById('editForm');
        form.action = `/admin/jobs/${job.id}`;
        
        // Isi otomatis setiap kolom inputan sesuai database (Tidak ada inputan yang dihilangkan)
        form.querySelector('[name="title"]').value = job.title || '';
        form.querySelector('[name="priority"]').value = job.priority || 'Medium';
        form.querySelector('[name="min_education"]').value = job.min_education || 'Bebas';
        form.querySelector('[name="category_id"]').value = job.category_id || '';
        form.querySelector('[name="location"]').value = job.location || '';
        form.querySelector('[name="type"]').value = job.type || '';
        form.querySelector('[name="status"]').value = job.status || '';
        form.querySelector('[name="salary_range"]').value = job.salary_range || '';
        form.querySelector('[name="qualification"]').value = job.qualification || '';
        form.querySelector('[name="description"]').value = job.description || '';
        form.querySelector('[name="facilities"]').value = job.facilities || '';
        form.querySelector('[name="apply_link"]').value = job.apply_link || '';

        // Tampilkan modal edit
        openModal('modalEdit');
    }
</script>
@endsection