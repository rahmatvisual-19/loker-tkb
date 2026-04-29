@extends('layouts.admin')

@section('page_title', 'Data Pelamar')

@section('content')
<!-- Header Section -->
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
    <div>
        <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Data Pelamar Masuk</h1>
        <p class="text-sm text-gray-500 mt-1">Kelola dan review semua lamaran yang masuk.</p>
    </div>
</div>

<!-- Table Card -->
<div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
    
    <!-- Table Action Bar (Search & Filter) -->
    <div class="p-4 border-b border-gray-200 bg-white">
        <form action="{{ route('applications.index') }}" method="GET" class="flex flex-col sm:flex-row gap-3">
            <!-- Search -->
            <div class="relative w-full sm:flex-1 md:w-80">
                <i data-lucide="search" class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 w-4 h-4"></i>
                <input 
                    type="text" 
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari nama atau email pelamar..." 
                    class="pl-9 pr-10 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-1 focus:ring-green-500 focus:border-green-500 w-full transition-all"
                />
                @if(request('search'))
                    <a href="{{ route('applications.index', ['status' => request('status'), 'education_level' => request('education_level')]) }}" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-red-500 transition-colors" title="Reset Pencarian">
                        <i data-lucide="x" class="w-4 h-4"></i>
                    </a>
                @endif
            </div>

            <!-- Filter Pendidikan -->
            <select name="education_level" onchange="this.form.submit()" class="border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-1 focus:ring-green-500 focus:border-green-500 py-2 px-3 w-full sm:w-40 bg-white">
                <option value="">Semua Pendidikan</option>
                <option value="SMA/SMK" {{ request('education_level') == 'SMA/SMK' ? 'selected' : '' }}>SMA/SMK</option>
                <option value="D3" {{ request('education_level') == 'D3' ? 'selected' : '' }}>D3</option>
                <option value="S1" {{ request('education_level') == 'S1' ? 'selected' : '' }}>S1</option>
                <option value="S2" {{ request('education_level') == 'S2' ? 'selected' : '' }}>S2</option>
            </select>

            <!-- Filter Status -->
            <select name="status" onchange="this.form.submit()" class="border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-1 focus:ring-green-500 focus:border-green-500 py-2 px-3 w-full sm:w-40 bg-white">
                <option value="">Semua Status</option>
                <option value="Menunggu" {{ request('status') == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                <option value="Direview" {{ request('status') == 'Direview' ? 'selected' : '' }}>Direview</option>
                <option value="Wawancara" {{ request('status') == 'Wawancara' ? 'selected' : '' }}>Wawancara</option>
                <option value="Diterima" {{ request('status') == 'Diterima' ? 'selected' : '' }}>Diterima</option>
                <option value="Ditolak" {{ request('status') == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
            </select>
        </form>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm text-gray-600">
            <thead class="text-xs text-gray-500 uppercase bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-4 font-semibold">Pelamar</th>
                    <th class="px-6 py-4 font-semibold">Posisi Dilamar</th>
                    <th class="px-6 py-4 font-semibold">Pendidikan</th>
                    <th class="px-6 py-4 font-semibold text-center">Status</th>
                    <th class="px-6 py-4 font-semibold text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($applications as $app)
                <tr class="hover:bg-gray-50/80 transition-colors">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <img src="{{ Storage::url($app->photo_path) }}" alt="Photo" class="w-10 h-10 rounded-full object-cover border border-gray-200 bg-gray-50">
                            <div>
                                <span class="font-bold text-gray-900 block">{{ $app->name }}</span>
                                <span class="text-xs text-gray-500">{{ $app->email }}</span>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="font-medium text-gray-800 block">{{ $app->job->title ?? 'Loker Dihapus' }}</span>
                        <!-- Mengganti diffForHumans() dengan format tanggal dan waktu pasti -->
                        <span class="text-xs text-gray-400 mt-0.5 block">{{ $app->created_at->format('d M Y, H:i') }}</span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="block text-gray-900 font-medium">{{ $app->education_level }}</span>
                        <span class="text-xs text-gray-500 mt-0.5 block truncate max-w-[150px]" title="{{ $app->institution_name }}">{{ $app->institution_name }}</span>
                    </td>
                    <td class="px-6 py-4 text-center">
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
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium border {{ $statusClass }}">
                            <span class="w-1.5 h-1.5 rounded-full {{ $dotClass }}"></span>
                            {{ $app->status }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('applications.show', $app->id) }}" class="p-2 text-gray-400 hover:text-green-600 hover:bg-green-50 rounded-lg transition-colors" title="Lihat Detail">
                                <i data-lucide="eye" class="w-4 h-4"></i>
                            </a>
                            <form action="{{ route('applications.destroy', $app->id) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="p-2 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-colors" title="Hapus" onclick="return confirm('Yakin ingin menghapus data pelamar ini?')">
                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                        <div class="flex flex-col items-center justify-center gap-2">
                            <i data-lucide="inbox" class="w-8 h-8 text-gray-300"></i>
                            <p>Belum ada data pelamar yang sesuai.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($applications->hasPages())
    <div class="p-4 border-t border-gray-200 bg-gray-50">
        {{ $applications->links() }}
    </div>
    @endif
</div>
@endsection