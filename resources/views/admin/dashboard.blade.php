@extends('layouts.admin')

@section('page_title', 'Dashboard')

@section('content')
<div class="mb-8">
    <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Dashboard Overview</h1>
    <p class="text-sm text-gray-500 mt-1">Selamat datang kembali di panel administrasi Tokabe.id</p>
</div>

<!-- Stats Widgets -->
<div class="grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-6 mb-8">
    
    <!-- Total Lowongan -->
    <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm flex items-center gap-4">
        <div class="p-3 bg-blue-50 text-blue-600 rounded-lg">
            <i data-lucide="briefcase" class="w-7 h-7"></i>
        </div>
        <div>
            <p class="text-sm font-medium text-gray-500">Total Lowongan</p>
            <p class="text-2xl font-bold text-gray-900">{{ \App\Models\Job::count() }}</p>
        </div>
    </div>

    <!-- Loker Aktif -->
    <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm flex items-center gap-4">
        <div class="p-3 bg-green-50 text-green-600 rounded-lg">
            <i data-lucide="check-circle-2" class="w-7 h-7"></i>
        </div>
        <div>
            <p class="text-sm font-medium text-gray-500">Loker Aktif</p>
            <p class="text-2xl font-bold text-gray-900">{{ \App\Models\Job::where('is_active', true)->count() }}</p>
        </div>
    </div>

    <!-- Loker Nonaktif / Draft -->
    <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm flex items-center gap-4">
        <div class="p-3 bg-gray-50 text-gray-600 rounded-lg">
            <i data-lucide="archive" class="w-7 h-7"></i>
        </div>
        <div>
            <p class="text-sm font-medium text-gray-500">Loker Draft</p>
            <p class="text-2xl font-bold text-gray-900">{{ \App\Models\Job::where('is_active', false)->count() }}</p>
        </div>
    </div>

</div>
@endsection
