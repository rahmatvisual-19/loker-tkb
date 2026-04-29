<!-- Semua inputan persis seperti file lama Anda, ditata dalam grid 2 kolom agar rapi di Modal -->
<div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
    
    <div class="sm:col-span-2">
        <label class="block mb-1.5 text-sm font-medium text-gray-700">Posisi Pekerjaan</label>
        <input type="text" name="title" class="w-full border border-gray-300 focus:border-green-500 focus:ring-1 focus:ring-green-500 rounded-lg p-2.5 transition-colors" placeholder="Misal: Staff Administrasi" required>
    </div>

    <!-- Kolom Baru: Skala Prioritas -->
    <div>
        <label class="block mb-1.5 text-sm font-medium text-gray-700">Skala Prioritas</label>
        <select name="priority" class="w-full border border-gray-300 focus:border-green-500 focus:ring-1 focus:ring-green-500 rounded-lg p-2.5 transition-colors bg-white appearance-none" required>
            <option value="Low Priority">Low Priority</option>
            <option value="Medium-Low">Medium-Low</option>
            <option value="Medium" selected>Medium</option>
            <option value="High Priority">High Priority</option>
            <option value="Critical">Critical</option>
        </select>
    </div>

    <!-- Kolom Lama: Minimal Pendidikan -->
    <div>
        <label class="block mb-1.5 text-sm font-medium text-gray-700">Syarat Minimal Pendidikan (Filter Knockout)</label>
        <select name="min_education" class="w-full border border-gray-300 focus:border-green-500 focus:ring-1 focus:ring-green-500 rounded-lg p-2.5 transition-colors bg-white appearance-none" required>
            <option value="Bebas">Bebas (Semua Jenjang)</option>
            <option value="SMA/SMK">SMA / SMK Sederajat</option>
            <option value="D3">D3 (Diploma)</option>
            <option value="S1">S1 (Sarjana)</option>
            <option value="S2">S2 (Magister)</option>
        </select>
    </div>

    <div>
        <label class="block mb-1.5 text-sm font-medium text-gray-700">Kategori Pekerjaan</label>
        <select name="category_id" class="w-full border border-gray-300 focus:border-green-500 focus:ring-1 focus:ring-green-500 rounded-lg p-2.5 transition-colors bg-white appearance-none" required>
            <option value="">-- Pilih Kategori --</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="block mb-1.5 text-sm font-medium text-gray-700">Lokasi (Misal: MEDAN)</label>
        <input type="text" name="location" class="w-full border border-gray-300 focus:border-green-500 focus:ring-1 focus:ring-green-500 rounded-lg p-2.5 transition-colors" required>
    </div>
    
    <div>
        <label class="block mb-1.5 text-sm font-medium text-gray-700">Tipe (Misal: Full-time)</label>
        <input type="text" name="type" class="w-full border border-gray-300 focus:border-green-500 focus:ring-1 focus:ring-green-500 rounded-lg p-2.5 transition-colors" required>
    </div>
    
    <div>
        <label class="block mb-1.5 text-sm font-medium text-gray-700">Status (Misal: Kontrak)</label>
        <input type="text" name="status" class="w-full border border-gray-300 focus:border-green-500 focus:ring-1 focus:ring-green-500 rounded-lg p-2.5 transition-colors" required>
    </div>
    
    <div class="sm:col-span-2">
        <label class="block mb-1.5 text-sm font-medium text-gray-700">Gaji (Misal: Rp 3.000.000)</label>
        <input type="text" name="salary_range" class="w-full border border-gray-300 focus:border-green-500 focus:ring-1 focus:ring-green-500 rounded-lg p-2.5 transition-colors" required>
    </div>

    <!-- Semua Textarea persis seperti semula -->
    <div class="sm:col-span-2">
        <label class="block mb-1.5 text-sm font-medium text-gray-700">Kualifikasi (Gunakan baris baru untuk list)</label>
        <textarea name="qualification" rows="4" class="w-full border border-gray-300 focus:border-green-500 focus:ring-1 focus:ring-green-500 rounded-lg p-2.5 transition-colors" required></textarea>
    </div>
    
    <div class="sm:col-span-2">
        <label class="block mb-1.5 text-sm font-medium text-gray-700">Deskripsi Pekerjaan (Gunakan baris baru untuk list)</label>
        <textarea name="description" rows="4" class="w-full border border-gray-300 focus:border-green-500 focus:ring-1 focus:ring-green-500 rounded-lg p-2.5 transition-colors" required></textarea>
    </div>
    
    <div class="sm:col-span-2">
        <label class="block mb-1.5 text-sm font-medium text-gray-700">Fasilitas (Gunakan baris baru untuk list)</label>
        <textarea name="facilities" rows="4" class="w-full border border-gray-300 focus:border-green-500 focus:ring-1 focus:ring-green-500 rounded-lg p-2.5 transition-colors" required></textarea>
    </div>

    <div class="sm:col-span-2">
        <label class="block mb-1.5 text-sm font-medium text-gray-700">Link Pendaftaran (Opsional)</label>
        <input type="url" name="apply_link" class="w-full border border-gray-300 focus:border-green-500 focus:ring-1 focus:ring-green-500 rounded-lg p-2.5 transition-colors" placeholder="https://...">
    </div>

    <input type="hidden" name="is_active" value="1">
</div>