@extends('layouts.frontend')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-12 md:py-16">
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 md:p-12 relative overflow-hidden">
        
        <!-- Header -->
        <div class="border-b border-gray-100 pb-8 mb-8 text-center sm:text-left">
            <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 tracking-tight mb-3">Kebijakan Privasi</h1>
            <p class="text-gray-500 font-medium">Terakhir diperbarui: {{ date('d F Y') }}</p>
        </div>

        <!-- Konten Kebijakan Privasi -->
        <div class="space-y-8 text-gray-600 leading-relaxed text-sm md:text-base">
            
            <section>
                <h2 class="text-xl font-bold text-gray-900 mb-3 flex items-center gap-2">
                    <i data-lucide="shield-check" class="w-5 h-5 text-green-600"></i> Pendahuluan
                </h2>
                <p>
                    Selamat datang di portal karir <strong>Tokabe.id</strong>. Kami sangat menghargai privasi Anda dan berkomitmen untuk melindungi data pribadi yang Anda berikan saat menggunakan layanan kami. Kebijakan Privasi ini menjelaskan bagaimana kami mengumpulkan, menggunakan, menyimpan, dan melindungi informasi pribadi Anda selama proses rekrutmen.
                </p>
            </section>

            <section>
                <h2 class="text-xl font-bold text-gray-900 mb-3 flex items-center gap-2">
                    <i data-lucide="file-text" class="w-5 h-5 text-green-600"></i> Informasi yang Kami Kumpulkan
                </h2>
                <p class="mb-2">Saat Anda melamar pekerjaan melalui platform kami, kami mengumpulkan data pribadi yang mencakup, namun tidak terbatas pada:</p>
                <ul class="list-disc pl-5 space-y-1.5 marker:text-green-500">
                    <li><strong>Data Identitas:</strong> Nama lengkap, tempat/tanggal lahir, jenis kelamin, dan nomor identitas.</li>
                    <li><strong>Data Kontak:</strong> Alamat email, nomor WhatsApp, dan alamat domisili.</li>
                    <li><strong>Data Kualifikasi:</strong> Riwayat pendidikan, IPK, pengalaman kerja, serta sertifikat pendukung.</li>
                    <li><strong>Dokumen Lampiran:</strong> Pas foto, Curriculum Vitae (CV), dan dokumen paklaring lainnya.</li>
                    <li><strong>Data Fisik & Kesehatan Dasar:</strong> Tinggi/berat badan, riwayat penyakit berat, dan kondisi buta warna (hanya digunakan untuk pertimbangan keselamatan dan kecocokan pada posisi kerja spesifik di lapangan).</li>
                </ul>
            </section>

            <section>
                <h2 class="text-xl font-bold text-gray-900 mb-3 flex items-center gap-2">
                    <i data-lucide="briefcase" class="w-5 h-5 text-green-600"></i> Penggunaan Informasi
                </h2>
                <p class="mb-2">Data pribadi yang Anda berikan hanya akan digunakan untuk keperluan internal rekrutmen Tokabe.id, yaitu untuk:</p>
                <ul class="list-disc pl-5 space-y-1.5 marker:text-green-500">
                    <li>Menilai kecocokan profil Anda dengan posisi pekerjaan yang sedang dibuka.</li>
                    <li>Menghubungi Anda terkait jadwal tes, wawancara, atau pengumuman hasil rekrutmen.</li>
                    <li>Memverifikasi keabsahan dokumen dan latar belakang pengalaman Anda.</li>
                    <li>Keperluan administrasi personalia jika Anda dinyatakan diterima bergabung bersama tim kami.</li>
                </ul>
            </section>

            <section>
                <h2 class="text-xl font-bold text-gray-900 mb-3 flex items-center gap-2">
                    <i data-lucide="lock" class="w-5 h-5 text-green-600"></i> Keamanan & Penyimpanan Data
                </h2>
                <p>
                    Kami menerapkan standar keamanan teknis untuk memastikan data Anda tidak disalahgunakan, diakses tanpa izin, atau dibocorkan ke pihak ketiga (selain instansi hukum yang berwenang atas perintah pengadilan). Data lampiran (seperti CV dan Foto) disimpan di dalam server tertutup (<em>Secure Storage</em>). Apabila proses rekrutmen telah selesai atau data sudah tidak lagi relevan, data Anda dapat kami hapus dari sistem kami secara permanen.
                </p>
            </section>

            <section>
                <h2 class="text-xl font-bold text-gray-900 mb-3 flex items-center gap-2">
                    <i data-lucide="headset" class="w-5 h-5 text-green-600"></i> Hak Pengguna & Kontak Helpdesk
                </h2>
                <p>
                    Anda berhak memastikan bahwa informasi yang Anda kirimkan adalah akurat. Anda menyetujui bahwa pemberian data palsu atau manipulasi berkas dapat berakibat pada pembatalan proses rekrutmen secara otomatis.
                </p>
                <div class="mt-4 p-4 bg-green-50 border border-green-100 rounded-xl">
                    <p class="font-medium text-gray-800 mb-1">Jika Anda memiliki pertanyaan mengenai privasi Anda, silakan hubungi Helpdesk kami melalui:</p>
                    <a href="mailto:loker@tokabe.id" class="text-green-600 hover:text-green-700 font-bold flex items-center gap-2 mt-2">
                        <i data-lucide="mail" class="w-4 h-4"></i> loker@tokabe.id
                    </a>
                </div>
            </section>

        </div>
    </div>
</div>
@endsection