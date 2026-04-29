@extends('layouts.frontend')

@section('content')
<!-- Logika Alpine.js untuk Screening dan Logika Form -->
<div 
    x-data="applicationForm()" 
    x-init="initData('{{ $job->min_education }}')"
    class="max-w-4xl mx-auto px-4 py-10"
>
    <!-- Header Pekerjaan (Konteks) -->
    <div class="bg-green-600 rounded-t-2xl p-6 md:p-8 text-white shadow-sm">
        <span class="inline-block px-3 py-1 bg-green-500 text-white text-xs font-bold rounded-full mb-3">
            {{ $job->category->name ?? 'Umum' }}
        </span>
        <h1 class="text-3xl md:text-4xl font-extrabold mb-2">Formulir Lamaran: {{ $job->title }}</h1>
        <div class="flex flex-wrap gap-4 text-sm font-medium text-green-100 mt-4">
            <span class="flex items-center gap-1.5"><i data-lucide="map-pin" class="w-4 h-4"></i> {{ $job->location }}</span>
            <span class="flex items-center gap-1.5"><i data-lucide="briefcase" class="w-4 h-4"></i> {{ $job->type }}</span>
            <span class="flex items-center gap-1.5"><i data-lucide="graduation-cap" class="w-4 h-4"></i> Min. {{ $job->min_education }}</span>
        </div>
    </div>

    <!-- TAHAP 0: PRE-SCREENING (Knockout) -->
    <div x-show="step === 0" x-transition.opacity.duration.500ms class="bg-white rounded-b-2xl p-8 md:p-12 shadow-sm border border-gray-100 border-t-0 text-center">
        
        <div x-show="!screeningFailed">
            <div class="w-16 h-16 bg-green-50 text-green-600 rounded-full flex items-center justify-center mx-auto mb-6">
                <i data-lucide="clipboard-check" class="w-8 h-8"></i>
            </div>
            <h2 class="text-2xl font-bold text-gray-900 mb-3">Pengecekan Kualifikasi Awal</h2>
            <p class="text-gray-500 mb-8 max-w-lg mx-auto">Sebelum melanjutkan, pastikan kualifikasi Anda sesuai. Apa jenjang pendidikan terakhir Anda saat ini?</p>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 max-w-2xl mx-auto">
                <template x-for="edu in educationOptions" :key="edu">
                    <button 
                        type="button"
                        @click="checkScreening(edu)"
                        class="px-4 py-4 border-2 border-gray-200 rounded-xl hover:border-green-600 hover:bg-green-50 hover:text-green-700 transition-all font-bold text-gray-600"
                        x-text="edu"
                    ></button>
                </template>
            </div>
        </div>

        <!-- Pesan Gagal Screening -->
        <div x-show="screeningFailed" style="display: none;" class="py-8">
            <div class="w-16 h-16 bg-red-50 text-red-500 rounded-full flex items-center justify-center mx-auto mb-6">
                <i data-lucide="x-octagon" class="w-8 h-8"></i>
            </div>
            <h2 class="text-2xl font-bold text-gray-900 mb-3">Mohon Maaf</h2>
            <p class="text-gray-600 mb-6 max-w-lg mx-auto">Kualifikasi minimal pendidikan untuk posisi <strong x-text="'{{ $job->title }}'"></strong> adalah <strong x-text="'{{ $job->min_education }}'"></strong>. Kualifikasi Anda saat ini belum memenuhi syarat.</p>
            
            <a href="/" class="inline-flex items-center gap-2 bg-green-600 text-white px-6 py-3 rounded-xl font-bold hover:bg-green-700 transition-colors">
                <i data-lucide="search" class="w-5 h-5"></i> Cari Lowongan Lain
            </a>
        </div>
    </div>

    <!-- TAHAP 1: FORM UTAMA -->
    <div x-show="step === 1" style="display: none;" x-transition.opacity.duration.500ms class="bg-white rounded-b-2xl p-6 md:p-10 shadow-sm border border-gray-100 border-t-0">
        
        <!-- Pesan Error Validasi Laravel -->
        @if ($errors->any())
        <div class="mb-8 p-4 bg-red-50 border border-red-200 rounded-xl flex items-start gap-3">
            <i data-lucide="alert-circle" class="w-5 h-5 text-red-600 mt-0.5 shrink-0"></i>
            <div>
                <h4 class="text-sm font-bold text-red-800 mb-1">Gagal mengirim lamaran!</h4>
                <ul class="list-disc pl-5 text-sm text-red-700 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif

        <form action="{{ route('applications.store', $job->id) }}" method="POST" enctype="multipart/form-data" class="space-y-12">
            @csrf

            <!-- Hidden input untuk hasil screening pendidikan -->
            <input type="hidden" name="education_level" x-model="selectedEducation">

            <!-- BAGIAN 1: Data Diri -->
            <section>
                <div class="border-b border-gray-200 pb-4 mb-6">
                    <h3 class="text-xl font-bold text-gray-900 flex items-center gap-2">
                        <span class="bg-green-100 text-green-700 w-8 h-8 rounded-full flex items-center justify-center text-sm">1</span> Data Diri & Kontak
                    </h3>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1.5">Nama Lengkap *</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="w-full border border-gray-300 rounded-lg p-3 focus:border-green-500 focus:ring-1 focus:ring-green-500 outline-none" required>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1.5">Email Aktif *</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="w-full border border-gray-300 rounded-lg p-3 focus:border-green-500 focus:ring-1 focus:ring-green-500 outline-none" required>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1.5">Nomor WhatsApp *</label>
                        <input type="number" name="whatsapp" value="{{ old('whatsapp') }}" class="w-full border border-gray-300 rounded-lg p-3 focus:border-green-500 focus:ring-1 focus:ring-green-500 outline-none" required>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1.5">Tempat Lahir *</label>
                            <input type="text" name="birth_place" value="{{ old('birth_place') }}" class="w-full border border-gray-300 rounded-lg p-3 focus:border-green-500 focus:ring-1 focus:ring-green-500 outline-none" required>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1.5">Tanggal Lahir *</label>
                            <input type="date" name="birth_date" value="{{ old('birth_date') }}" class="w-full border border-gray-300 rounded-lg p-3 focus:border-green-500 focus:ring-1 focus:ring-green-500 outline-none" required>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1.5">Jenis Kelamin *</label>
                        <select name="gender" class="w-full border border-gray-300 rounded-lg p-3 focus:border-green-500 focus:ring-1 focus:ring-green-500 outline-none bg-white" required>
                            <option value="">Pilih</option>
                            <option value="Laki-laki" {{ old('gender') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ old('gender') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1.5">Kota Domisili Saat Ini *</label>
                        <input type="text" name="domicile" value="{{ old('domicile') }}" placeholder="Contoh: Medan" class="w-full border border-gray-300 rounded-lg p-3 focus:border-green-500 focus:ring-1 focus:ring-green-500 outline-none" required>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1.5">Link Portofolio / LinkedIn <span class="font-normal text-gray-400">(Opsional)</span></label>
                        <input type="url" name="portfolio_link" value="{{ old('portfolio_link') }}" placeholder="https://" class="w-full border border-gray-300 rounded-lg p-3 focus:border-green-500 focus:ring-1 focus:ring-green-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1.5">Upload Pas Photo <span class="font-normal text-gray-400">(JPG/PNG, Max 2MB)</span> *</label>
                        <input type="file" name="photo" accept="image/*" class="w-full border border-gray-300 rounded-lg p-2.5 focus:border-green-500 focus:ring-1 focus:ring-green-500 outline-none file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100" required>
                    </div>
                </div>
            </section>

            <!-- BAGIAN 2: Pendidikan -->
            <section>
                <div class="border-b border-gray-200 pb-4 mb-6">
                    <h3 class="text-xl font-bold text-gray-900 flex items-center gap-2">
                        <span class="bg-green-100 text-green-700 w-8 h-8 rounded-full flex items-center justify-center text-sm">2</span> Riwayat Pendidikan
                    </h3>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1.5">Jenjang Pendidikan</label>
                        <!-- Ditampilkan otomatis dari hasil screening -->
                        <div class="w-full border border-gray-200 bg-gray-50 text-gray-700 rounded-lg p-3 font-semibold" x-text="selectedEducation"></div>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1.5">Nama Institusi / Sekolah *</label>
                        <input type="text" name="institution_name" value="{{ old('institution_name') }}" class="w-full border border-gray-300 rounded-lg p-3 focus:border-green-500 focus:ring-1 focus:ring-green-500 outline-none" required>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1.5">Jurusan *</label>
                        <input type="text" name="major" value="{{ old('major') }}" placeholder="Contoh: Teknik Informatika / IPA" class="w-full border border-gray-300 rounded-lg p-3 focus:border-green-500 focus:ring-1 focus:ring-green-500 outline-none" required>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1.5">Nilai Akhir / IPK *</label>
                        <input type="number" step="0.01" name="gpa" value="{{ old('gpa') }}" placeholder="Contoh: 3.85 atau 85.5" class="w-full border border-gray-300 rounded-lg p-3 focus:border-green-500 focus:ring-1 focus:ring-green-500 outline-none" required>
                    </div>
                </div>
            </section>

            <!-- BAGIAN 3: Pengalaman Kerja (Dinamis dengan Alpine.js) -->
            <section>
                <div class="border-b border-gray-200 pb-4 mb-6 flex justify-between items-end">
                    <h3 class="text-xl font-bold text-gray-900 flex items-center gap-2">
                        <span class="bg-green-100 text-green-700 w-8 h-8 rounded-full flex items-center justify-center text-sm">3</span> Pengalaman Kerja
                    </h3>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-bold text-gray-700 mb-3">Status Pengalaman Kerja Anda saat ini? *</label>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        
                        <!-- Opsi 1: Profesional -->
                        <label class="flex items-start gap-3 p-4 border rounded-xl cursor-pointer hover:bg-gray-50 transition-colors" :class="experienceType === 'experienced' ? 'bg-green-50 border-green-500 ring-1 ring-green-500' : 'border-gray-200'">
                            <input type="radio" name="experience_type" value="experienced" x-model="experienceType" class="mt-0.5 w-4 h-4 text-green-600 focus:ring-green-500">
                            <div>
                                <span class="font-bold text-gray-900 block mb-0.5">Profesional</span>
                                <span class="text-xs text-gray-500">Sudah memiliki pengalaman kerja formal.</span>
                            </div>
                        </label>

                        <!-- Opsi 2: Fresh Grad dengan pengalaman -->
                        <label class="flex items-start gap-3 p-4 border rounded-xl cursor-pointer hover:bg-gray-50 transition-colors" :class="experienceType === 'fresh_with_exp' ? 'bg-green-50 border-green-500 ring-1 ring-green-500' : 'border-gray-200'">
                            <input type="radio" name="experience_type" value="fresh_with_exp" x-model="experienceType" class="mt-0.5 w-4 h-4 text-green-600 focus:ring-green-500">
                            <div>
                                <span class="font-bold text-gray-900 block mb-0.5">Fresh Grad (Ada Pengalaman)</span>
                                <span class="text-xs text-gray-500">Ada pengalaman magang / freelance.</span>
                            </div>
                        </label>

                        <!-- Opsi 3: Fresh Grad polos -->
                        <label class="flex items-start gap-3 p-4 border rounded-xl cursor-pointer hover:bg-gray-50 transition-colors" :class="experienceType === 'fresh_no_exp' ? 'bg-green-50 border-green-500 ring-1 ring-green-500' : 'border-gray-200'">
                            <input type="radio" name="experience_type" value="fresh_no_exp" x-model="experienceType" class="mt-0.5 w-4 h-4 text-green-600 focus:ring-green-500">
                            <div>
                                <span class="font-bold text-gray-900 block mb-0.5">Fresh Grad (Tanpa Pengalaman)</span>
                                <span class="text-xs text-gray-500">Belum ada pengalaman kerja sama sekali.</span>
                            </div>
                        </label>

                    </div>
                </div>
                
                <!-- Form Pengalaman (Sembunyi HANYA JIKA opsi ke-3 dipilih) -->
                <div x-show="experienceType !== 'fresh_no_exp'" x-collapse class="space-y-6">
                    <template x-for="(exp, index) in experiences" :key="index">
                        <div class="p-6 border border-gray-100 bg-gray-50/50 rounded-xl relative">
                            
                            <!-- Header Bar Tiap Pengalaman -->
                            <div class="flex justify-between items-center mb-5 pb-3 border-b border-gray-200">
                                <h4 class="font-bold text-green-700 flex items-center gap-2">
                                    <i data-lucide="briefcase" class="w-4 h-4"></i> Pengalaman #<span x-text="index + 1"></span>
                                </h4>
                                <button type="button" x-show="experiences.length > 1" @click="removeExperience(index)" class="text-red-500 hover:text-red-700 text-sm font-bold flex items-center gap-1.5 transition-colors bg-red-50 px-3 py-1.5 rounded-lg hover:bg-red-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                                    Hapus
                                </button>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-1.5">Nama Perusahaan *</label>
                                    <input type="text" x-bind:name="`experiences[${index}][company_name]`" x-model="exp.company_name" :required="experienceType !== 'fresh_no_exp'" class="w-full border border-gray-300 rounded-lg p-3 focus:border-green-500 focus:ring-1 focus:ring-green-500 outline-none">
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-1.5">Posisi / Jabatan *</label>
                                    <input type="text" x-bind:name="`experiences[${index}][job_position]`" x-model="exp.job_position" :required="experienceType !== 'fresh_no_exp'" class="w-full border border-gray-300 rounded-lg p-3 focus:border-green-500 focus:ring-1 focus:ring-green-500 outline-none">
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-1.5">Bulan & Tahun Mulai *</label>
                                    <input type="month" x-bind:name="`experiences[${index}][work_start_date]`" x-model="exp.work_start_date" :required="experienceType !== 'fresh_no_exp'" class="w-full border border-gray-300 rounded-lg p-3 focus:border-green-500 focus:ring-1 focus:ring-green-500 outline-none">
                                </div>

                                <div>
                                    <div class="flex justify-between items-center mb-1.5">
                                        <label class="block text-sm font-bold text-gray-700">Bulan & Tahun Selesai *</label>
                                        <label class="flex items-center gap-1.5 text-xs text-green-700 font-bold cursor-pointer">
                                            <input type="checkbox" x-bind:name="`experiences[${index}][is_currently_working]`" x-model="exp.is_currently_working" class="rounded text-green-600 focus:ring-green-500">
                                            Masih Bekerja
                                        </label>
                                    </div>
                                    <input type="month" x-bind:name="`experiences[${index}][work_end_date]`" x-model="exp.work_end_date" :disabled="exp.is_currently_working" :required="experienceType !== 'fresh_no_exp' && !exp.is_currently_working" class="w-full border border-gray-300 rounded-lg p-3 focus:border-green-500 focus:ring-1 focus:ring-green-500 outline-none disabled:bg-gray-100 disabled:text-gray-400">
                                </div>

                                <div class="md:col-span-2">
                                    <label class="block text-sm font-bold text-gray-700 mb-1.5">Deskripsi Singkat Pekerjaan *</label>
                                    <textarea x-bind:name="`experiences[${index}][job_description]`" x-model="exp.job_description" rows="3" :required="experienceType !== 'fresh_no_exp'" placeholder="Jelaskan secara singkat tugas harian Anda..." class="w-full border border-gray-300 rounded-lg p-3 focus:border-green-500 focus:ring-1 focus:ring-green-500 outline-none"></textarea>
                                </div>
                            </div>
                        </div>
                    </template>
                    
                    <!-- Tombol Tambah Pengalaman -->
                    <button type="button" @click="addExperience()" class="mt-2 flex items-center justify-center gap-2 w-full py-3.5 border-2 border-dashed border-green-500 text-green-600 hover:bg-green-50 rounded-xl font-bold transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                        Tambah Pengalaman Lainnya
                    </button>
                </div>
            </section>

            <!-- BAGIAN 4: Kondisi Fisik & Kesiapan -->
            <section>
                <div class="border-b border-gray-200 pb-4 mb-6">
                    <h3 class="text-xl font-bold text-gray-900 flex items-center gap-2">
                        <span class="bg-green-100 text-green-700 w-8 h-8 rounded-full flex items-center justify-center text-sm">4</span> Kondisi Fisik & Kesiapan
                    </h3>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1.5">Tinggi Badan (cm) *</label>
                            <input type="number" name="height" value="{{ old('height') }}" class="w-full border border-gray-300 rounded-lg p-3 focus:border-green-500 focus:ring-1 focus:ring-green-500 outline-none" required>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1.5">Berat Badan (kg) *</label>
                            <input type="number" name="weight" value="{{ old('weight') }}" class="w-full border border-gray-300 rounded-lg p-3 focus:border-green-500 focus:ring-1 focus:ring-green-500 outline-none" required>
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1.5">Apakah Anda Buta Warna? *</label>
                        <select name="is_color_blind" class="w-full border border-gray-300 rounded-lg p-3 focus:border-green-500 focus:ring-1 focus:ring-green-500 outline-none bg-white" required>
                            <option value="">Pilih</option>
                            <option value="0" {{ old('is_color_blind') == '0' ? 'selected' : '' }}>Tidak</option>
                            <option value="1" {{ old('is_color_blind') == '1' ? 'selected' : '' }}>Ya</option>
                        </select>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-bold text-gray-700 mb-1.5">Riwayat Penyakit Berat <span class="font-normal text-gray-400">(Kosongkan jika tidak ada)</span></label>
                        <input type="text" name="disease_history" value="{{ old('disease_history') }}" class="w-full border border-gray-300 rounded-lg p-3 focus:border-green-500 focus:ring-1 focus:ring-green-500 outline-none">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1.5">Ekspektasi Gaji Bersih (Rp) *</label>
                        <input type="text" name="expected_salary" value="{{ old('expected_salary') }}" placeholder="Contoh: 3.500.000" class="w-full border border-gray-300 rounded-lg p-3 focus:border-green-500 focus:ring-1 focus:ring-green-500 outline-none" required>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1.5">Waktu Ketersediaan Bergabung *</label>
                        <select name="notice_period" class="w-full border border-gray-300 rounded-lg p-3 focus:border-green-500 focus:ring-1 focus:ring-green-500 outline-none bg-white" required>
                            <option value="">Pilih</option>
                            <option value="Segera" {{ old('notice_period') == 'Segera' ? 'selected' : '' }}>Segera (ASAP)</option>
                            <option value="1 Minggu" {{ old('notice_period') == '1 Minggu' ? 'selected' : '' }}>1 Minggu</option>
                            <option value="1 Bulan (Notice)" {{ old('notice_period') == '1 Bulan (Notice)' ? 'selected' : '' }}>1 Bulan (One Month Notice)</option>
                            <option value="Lebih dari 1 Bulan" {{ old('notice_period') == 'Lebih dari 1 Bulan' ? 'selected' : '' }}>Lebih dari 1 Bulan</option>
                        </select>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-bold text-gray-700 mb-1.5">Apakah bersedia ditugaskan ke luar kota / lapangan? *</label>
                        <select name="willing_out_of_town" class="w-full md:w-1/2 border border-gray-300 rounded-lg p-3 focus:border-green-500 focus:ring-1 focus:ring-green-500 outline-none bg-white" required>
                            <option value="">Pilih</option>
                            <option value="1" {{ old('willing_out_of_town') == '1' ? 'selected' : '' }}>Ya, Bersedia</option>
                            <option value="0" {{ old('willing_out_of_town') == '0' ? 'selected' : '' }}>Tidak Bersedia</option>
                        </select>
                    </div>
                </div>
            </section>

            <!-- BAGIAN 5: Berkas Lamaran -->
            <section>
                <div class="border-b border-gray-200 pb-4 mb-6">
                    <h3 class="text-xl font-bold text-gray-900 flex items-center gap-2">
                        <span class="bg-green-100 text-green-700 w-8 h-8 rounded-full flex items-center justify-center text-sm">5</span> Upload Berkas Lamaran
                    </h3>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:border-green-500 transition-colors bg-gray-50">
                        <i data-lucide="file-text" class="w-8 h-8 text-gray-400 mx-auto mb-3"></i>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Upload CV / Resume *</label>
                        <p class="text-xs text-gray-500 mb-4">Wajib berformat PDF (Maks. 2MB)</p>
                        <input type="file" name="cv" accept=".pdf" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100" required>
                    </div>

                    <div class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:border-green-500 transition-colors bg-gray-50">
                        <i data-lucide="folder-archive" class="w-8 h-8 text-gray-400 mx-auto mb-3"></i>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Paklaring / Sertifikat <span class="font-normal text-gray-400">(Opsional)</span></label>
                        <p class="text-xs text-gray-500 mb-4">Format PDF/JPG/PNG (Maks. 2MB)</p>
                        <input type="file" name="supporting_doc" accept=".pdf,.jpg,.jpeg,.png" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200">
                    </div>
                </div>
            </section>

            <!-- Pernyataan & Tombol Submit -->
            <section class="bg-gray-50 rounded-xl p-6 border border-gray-200 mt-8">
                <label class="flex items-start gap-4 cursor-pointer">
                    <input type="checkbox" name="agreement" required class="mt-1 w-5 h-5 text-green-600 rounded border-gray-300 focus:ring-green-500">
                    <span class="text-sm text-gray-700 leading-relaxed">
                        <strong>Pernyataan Kejujuran:</strong><br>
                        Saya menyatakan bahwa semua data yang saya masukkan dalam formulir ini adalah benar dan dapat dipertanggungjawabkan. Jika di kemudian hari ditemukan ketidaksesuaian data antara kualifikasi yang saya sampaikan dengan berkas asli, saya bersedia menerima sanksi berupa <strong>gugurnya lamaran saya secara otomatis</strong>.
                    </span>
                </label>

                <div class="mt-8 flex flex-col md:flex-row gap-4 justify-end">
                    <a href="/" class="px-6 py-3 border-2 border-gray-300 rounded-xl font-bold text-gray-600 hover:bg-gray-100 transition-colors text-center">
                        Kembali
                    </a>
                    <button type="submit" class="bg-green-600 text-white px-8 py-3 rounded-xl font-bold hover:bg-green-700 transition-colors flex items-center justify-center gap-2 shadow-sm">
                        Kirim Lamaran Sekarang <i data-lucide="send" class="w-5 h-5"></i>
                    </button>
                </div>
            </section>
        </form>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('applicationForm', () => ({
            step: 0,
            selectedEducation: '',
            minEducationRequirement: '',
            screeningFailed: false,
            
            // State untuk pengalaman kerja dinamis
            experienceType: '{{ old("experience_type", "experienced") }}',
            experiences: [
                {
                    company_name: '',
                    job_position: '',
                    work_start_date: '',
                    work_end_date: '',
                    is_currently_working: false,
                    job_description: ''
                }
            ],
            
            // Urutan Bobot Pendidikan
            educationWeights: {
                'Bebas': 0,
                'SMA/SMK': 1,
                'D3': 2,
                'S1': 3,
                'S2': 4
            },
            
            educationOptions: ['SMA/SMK', 'D3', 'S1', 'S2'],

            initData(minJobEducation) {
                this.minEducationRequirement = minJobEducation;
                // Jika error validasi back dari controller, langsung buka step 1
                @if($errors->any())
                    this.selectedEducation = '{{ old('education_level') }}';
                    this.step = 1;
                @endif
            },

            checkScreening(edu) {
                this.selectedEducation = edu;
                let jobMinWeight = this.educationWeights[this.minEducationRequirement] || 0;
                let applicantWeight = this.educationWeights[edu] || 0;

                if (applicantWeight >= jobMinWeight) {
                    // Lolos Screening
                    this.screeningFailed = false;
                    this.step = 1;
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                } else {
                    // Gagal Screening
                    this.screeningFailed = true;
                }
            },

            // Fungsi tambah/hapus row pengalaman kerja
            addExperience() {
                this.experiences.push({
                    company_name: '',
                    job_position: '',
                    work_start_date: '',
                    work_end_date: '',
                    is_currently_working: false,
                    job_description: ''
                });
            },

            removeExperience(index) {
                this.experiences.splice(index, 1);
            }
        }))
    });
</script>
@endsection