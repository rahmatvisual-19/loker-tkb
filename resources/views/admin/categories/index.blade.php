@extends('layouts.admin')

@section('page_title', 'Kategori Job')

@section('content')
<!-- Header Section (Sama persis dengan jobs) -->
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
    <div>
        <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Kategori Lowongan</h1>
        <p class="text-sm text-gray-500 mt-1">Manajemen data kategori pekerjaan</p>
    </div>
    <a href="{{ route('categories.create') }}" class="w-full sm:w-auto bg-green-600 hover:bg-green-700 text-white px-4 py-2.5 rounded-lg text-sm font-semibold flex items-center justify-center gap-2 shadow-sm transition-colors">
        <i data-lucide="plus" class="w-5 h-5"></i>
        Tambah Kategori
    </a>
</div>

<!-- Table Card (Sudah di-full-width-kan) -->
<div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
    <div class="p-4 border-b border-gray-200 flex justify-between items-center bg-white">
        <div class="relative w-full sm:w-72">
            <i data-lucide="search" class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 w-4 h-4"></i>
            <!-- TAG FORM DITAMBAHKAN DI SINI -->
            <form action="{{ route('categories.index') }}" method="GET">
                <input 
                    type="text" 
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari kategori..." 
                    class="pl-9 pr-10 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-1 focus:ring-green-500 focus:border-green-500 w-full transition-all"
                />
                <!-- Tombol 'X' untuk clear search muncul jika ada pencarian -->
                @if(request('search'))
                    <a href="{{ route('categories.index') }}" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-red-500 transition-colors" title="Reset Pencarian">
                        <i data-lucide="x" class="w-4 h-4"></i>
                    </a>
                @endif
            </form>
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm text-gray-600">
            <thead class="text-xs text-gray-500 uppercase bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-4 font-semibold w-16">No</th>
                    <th class="px-6 py-4 font-semibold">Nama Kategori</th>
                    <th class="px-6 py-4 font-semibold text-right w-32">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($categories as $category)
                <tr class="hover:bg-gray-50/80 transition-colors">
                    <td class="px-6 py-4 text-gray-500">{{ $loop->iteration }}</td>
                    <td class="px-6 py-4">
                        <span class="font-medium text-gray-900 block">{{ $category->name }}</span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('categories.edit', $category->id) }}" class="p-2 text-gray-400 hover:text-amber-500 hover:bg-amber-50 rounded-lg transition-colors" title="Edit">
                                <i data-lucide="edit" class="w-4 h-4"></i>
                            </a>
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="p-2 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-colors" title="Hapus" onclick="return confirm('Hapus kategori ini?')">
                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="px-6 py-12 text-center text-gray-500">
                        <!-- PESAN JIKA PENCARIAN KOSONG DITAMBAHKAN DI SINI -->
                        @if(request('search'))
                            Kategori dengan nama "<span class="font-semibold text-gray-800">{{ request('search') }}</span>" tidak ditemukan.
                            <div class="mt-4">
                                <a href="{{ route('categories.index') }}" class="text-green-600 hover:text-green-700 hover:underline text-sm font-medium">
                                    Kembali ke semua data
                                </a>
                            </div>
                        @else
                            Belum ada data kategori.
                        @endif
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection