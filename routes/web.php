<?php

use App\Http\Controllers\JobController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\AdminApplicationController;
use App\Http\Controllers\AuthController;
use App\Models\Job;
use Illuminate\Support\Facades\Route;

// ==========================================
// 1. RUTE PUBLIK (Bebas diakses pelamar)
// ==========================================
Route::get('/', function () {
    $jobs = Job::where('is_active', true)->latest()->get();
    return view('welcome', compact('jobs'));
});

// Fitur Melamar Kerja
Route::get('/job/{job}/apply', [ApplicationController::class, 'create'])->name('applications.create');
Route::post('/job/{job}/apply', [ApplicationController::class, 'store'])->name('applications.store');
Route::get('/apply/success', function() { 
    return view('frontend.success'); 
})->name('applications.success');

// Fitur Cek Status Lamaran
Route::get('/cek-status', [ApplicationController::class, 'checkStatus'])->name('cek-status');
Route::view('/kebijakan-privasi', 'frontend.privacy')->name('privacy');

// ==========================================
// 2. RUTE AUTENTIKASI (Login & Logout)
// ==========================================
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('login.post')->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');


// ==========================================
// 3. RUTE ADMIN (Terkunci, Wajib Login!)
// ==========================================
Route::middleware('auth')->prefix('admin')->group(function () {
    
    // Halaman Dashboard Utama Admin (Misal: 127.0.0.1:8000/admin)
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Master Data Lowongan & Kategori
    Route::resource('jobs', JobController::class);
    Route::resource('categories', CategoryController::class);
    
    // Kelola Data Pelamar
    Route::resource('applications', AdminApplicationController::class)->only(['index', 'show', 'update', 'destroy']);
});