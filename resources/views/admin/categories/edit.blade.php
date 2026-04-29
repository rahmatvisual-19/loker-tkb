@extends('layouts.admin')

@section('page_title', 'Edit Kategori')

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 sm:p-8 max-w-2xl mx-auto mb-10">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('categories.index') }}" class="p-2 text-gray-400 hover:text-gray-700 bg-gray-50 hover:bg-gray-100 rounded-lg transition-colors">
            <i data-lucide="arrow-left" class="w-5 h-5"></i>
        </a>
        <h2 class="text-2xl font-bold text-gray-800">Edit Kategori</h2>
    </div>

    <form action="{{ route('categories.update', $category->id) }}" method="POST" class="space-y-5">
        @csrf
        @method('PUT')
        
        <div>
            <label class="block mb-1.5 text-sm font-medium text-gray-700">Nama Kategori</label>
            <input type="text" name="name" value="{{ $category->name }}" class="w-full border border-gray-300 focus:border-green-500 focus:ring-1 focus:ring-green-500 rounded-lg p-2.5 transition-colors" required>
        </div>

        <div class="pt-4 border-t border-gray-100">
            <button type="submit" class="bg-green-600 hover:bg-green-700 transition-colors text-white font-medium px-6 py-2.5 rounded-lg shadow-sm">Update Kategori</button>
        </div>
    </form>
</div>
@endsection