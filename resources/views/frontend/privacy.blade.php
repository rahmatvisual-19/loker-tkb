@extends('layouts.frontend')
<!-- Tambahkan di dalam tag <head> -->
<link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">
@section('content')
<div class="max-w-4xl mx-auto px-4 py-12 md:py-16">
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 md:p-12 relative overflow-hidden">
        
        <!-- Header / Hero Section -->
        <div class="border-l-4 border-green-600 pl-5 mb-10">
            <h1 class="text-3xl font-bold text-gray-900 leading-tight mb-1">Kebijakan Privasi</h1>
            <div class="text-sm text-gray-500 font-medium">Dokumen resmi perlindungan data pelamar kerja</div>
        </div>

        <!-- Daftar Isi (TOC) -->
        <div class="bg-gray-50 rounded-2xl p-6 md:p-8 mb-10 border border-gray-100">
            <h3 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-4">Daftar Isi</h3>
            <ol class="list-decimal pl-5 space-y-2.5 text-sm text-gray-600 font-medium marker:text-green-600">
                <li><a href="#s1" class="hover:text-green-600 hover:underline transition-colors">1. Pendahuluan & Dasar Hukum</a></li>
                <li><a href="#s2" class="hover:text-green-600 hover:underline transition-colors">2. Informasi yang Kami Kumpulkan</a></li>
                <li><a href="#s3" class="hover:text-green-600 hover:underline transition-colors">3. Penggunaan Informasi</a></li>
                <li><a href="#s4" class="hover:text-green-600 hover:underline transition-colors">4. Keamanan & Penyimpanan Data</a></li>
                <li><a href="#s5" class="hover:text-green-600 hover:underline transition-colors">5. Retensi & Penghapusan Data</a></li>
                <li><a href="#s6" class="hover:text-green-600 hover:underline transition-colors">6. Hak-Hak Pengguna</a></li>
                <li><a href="#s7" class="hover:text-green-600 hover:underline transition-colors">7. Persetujuan (Consent)</a></li>
                <li><a href="#s8" class="hover:text-green-600 hover:underline transition-colors">8. Kontak & Helpdesk</a></li>
            </ol>
        </div>

        <div class="space-y-12">
            <!-- SECTION 1 -->
            <section id="s1" class="scroll-mt-24">
                <div class="flex items-center gap-3 mb-4 pb-3 border-b border-gray-100">
                    <div class="w-8 h-8 rounded-full bg-green-600 text-white text-sm font-bold flex items-center justify-center shrink-0">1</div>
                    <h2 class="text-xl font-bold text-gray-900">Pendahuluan & Dasar Hukum</h2>
                </div>
                <div class="space-y-3 text-gray-600 text-[15px] leading-relaxed">
                    <p>Selamat datang di portal karir <strong>Tokabe.id</strong>. Kami berkomitmen untuk melindungi privasi dan data pribadi Anda sesuai dengan ketentuan hukum yang berlaku di Indonesia.</p>
                    <p>Kebijakan Privasi ini mengatur bagaimana kami mengumpulkan, menggunakan, menyimpan, dan melindungi informasi pribadi Anda dalam proses rekrutmen melalui platform kami.</p>
                </div>
                <div class="bg-gray-50 rounded-xl p-4 md:p-5 mt-5 text-[15px] text-gray-600 leading-relaxed border border-gray-100">
                    <strong class="text-gray-900 font-semibold">Dasar hukum kebijakan ini:</strong> Undang-Undang No. 27 Tahun 2022 tentang Pelindungan Data Pribadi (UU PDP), serta peraturan pelaksanaan terkait yang berlaku di Indonesia. Dengan menggunakan layanan kami, Anda menyatakan telah membaca dan menyetujui ketentuan dalam kebijakan ini.
                </div>
            </section>

            <!-- SECTION 2 -->
            <section id="s2" class="scroll-mt-24">
                <div class="flex items-center gap-3 mb-5 pb-3 border-b border-gray-100">
                    <div class="w-8 h-8 rounded-full bg-green-600 text-white text-sm font-bold flex items-center justify-center shrink-0">2</div>
                    <h2 class="text-xl font-bold text-gray-900">Informasi yang Kami Kumpulkan</h2>
                </div>
                <p class="text-gray-600 text-[15px] leading-relaxed mb-5">Saat Anda melamar pekerjaan melalui platform kami, kami mengumpulkan data pribadi berikut:</p>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
                    <div class="bg-white border border-gray-200 rounded-xl p-5">
                        <div class="text-xs font-bold text-gray-600 uppercase tracking-wide mb-2">Data Identitas</div>
                        <div class="text-[15px] text-gray-800 leading-relaxed">Nama lengkap, tempat/tanggal lahir, jenis kelamin, nomor KTP/identitas</div>
                    </div>
                    <div class="bg-white border border-gray-200 rounded-xl p-5">
                        <div class="text-xs font-bold text-gray-600 uppercase tracking-wide mb-2">Data Kontak</div>
                        <div class="text-[15px] text-gray-800 leading-relaxed">Alamat email, nomor WhatsApp, alamat domisili saat ini</div>
                    </div>
                    <div class="bg-white border border-gray-200 rounded-xl p-5">
                        <div class="text-xs font-bold text-gray-600 uppercase tracking-wide mb-2">Data Kualifikasi</div>
                        <div class="text-[15px] text-gray-800 leading-relaxed">Riwayat pendidikan, IPK, pengalaman kerja, sertifikat pendukung</div>
                    </div>
                    <div class="bg-white border border-gray-200 rounded-xl p-5">
                        <div class="text-xs font-bold text-gray-600 uppercase tracking-wide mb-2">Dokumen Lampiran</div>
                        <div class="text-[15px] text-gray-800 leading-relaxed">Pas foto terbaru, Curriculum Vitae (CV), surat paklaring, referensi kerja</div>
                    </div>
                </div>

                <div class="flex gap-3 bg-amber-50 border border-amber-200 rounded-xl p-4 md:p-5">
                    <i data-lucide="alert-triangle" class="w-5 h-5 text-amber-600 shrink-0 mt-0.5"></i>
                    <p class="text-[15px] text-amber-900 leading-relaxed"><strong class="font-bold text-amber-950">Data Sensitif — Fisik & Kesehatan:</strong> Untuk posisi kerja lapangan tertentu, kami dapat meminta data tinggi/berat badan, riwayat penyakit berat, dan kondisi buta warna. Data ini dikategorikan sebagai data pribadi yang bersifat sensitif, dikumpulkan hanya jika relevan dengan keselamatan kerja pada posisi yang dilamar, dan dilindungi dengan standar keamanan yang lebih ketat.</p>
                </div>
            </section>

            <!-- SECTION 3 -->
            <section id="s3" class="scroll-mt-24">
                <div class="flex items-center gap-3 mb-4 pb-3 border-b border-gray-100">
                    <div class="w-8 h-8 rounded-full bg-green-600 text-white text-sm font-bold flex items-center justify-center shrink-0">3</div>
                    <h2 class="text-xl font-bold text-gray-900">Penggunaan Informasi</h2>
                </div>
                <p class="text-gray-600 text-[15px] leading-relaxed mb-4">Data pribadi Anda hanya digunakan untuk keperluan rekrutmen internal Tokabe.id, meliputi:</p>
                <ul class="list-disc pl-5 space-y-2 text-[15px] text-gray-600 marker:text-green-500 mb-5">
                    <li>Menilai kesesuaian profil Anda dengan posisi yang sedang dibuka</li>
                    <li>Menghubungi Anda terkait jadwal tes, wawancara, atau hasil rekrutmen</li>
                    <li>Memverifikasi keabsahan dokumen dan riwayat pengalaman kerja Anda</li>
                    <li>Keperluan administrasi personalia apabila Anda dinyatakan diterima</li>
                </ul>
                <p class="text-gray-600 text-[15px] leading-relaxed">Kami <strong class="text-gray-900 font-semibold">tidak akan</strong> menjual, menyewakan, atau membagikan data Anda kepada pihak ketiga untuk tujuan komersial. Data hanya dapat dibagikan kepada instansi hukum yang berwenang berdasarkan perintah pengadilan yang sah.</p>
            </section>

            <!-- SECTION 4 -->
            <section id="s4" class="scroll-mt-24">
                <div class="flex items-center gap-3 mb-4 pb-3 border-b border-gray-100">
                    <div class="w-8 h-8 rounded-full bg-green-600 text-white text-sm font-bold flex items-center justify-center shrink-0">4</div>
                    <h2 class="text-xl font-bold text-gray-900">Keamanan & Penyimpanan Data</h2>
                </div>
                <p class="text-gray-600 text-[15px] leading-relaxed mb-4">Kami menerapkan langkah-langkah keamanan teknis dan organisasional yang memadai untuk melindungi data Anda, antara lain:</p>
                <ul class="list-disc pl-5 space-y-2 text-[15px] text-gray-600 marker:text-green-500">
                    <li>Dokumen lampiran (CV, foto, dan berkas sensitif) disimpan di <strong class="text-gray-900 font-semibold">secure storage</strong> dengan akses terbatas hanya bagi tim rekrutmen yang berwenang</li>
                    <li>Transmisi data dilindungi menggunakan enkripsi (HTTPS/TLS)</li>
                    <li>Akses ke sistem data dibatasi berdasarkan peran dan kebutuhan (role-based access control)</li>
                    <li>Sistem diaudit secara berkala untuk mendeteksi potensi kebocoran atau penyalahgunaan data</li>
                </ul>
            </section>

            <!-- SECTION 5 -->
            <section id="s5" class="scroll-mt-24">
                <div class="flex items-center gap-3 mb-4 pb-3 border-b border-gray-100">
                    <div class="w-8 h-8 rounded-full bg-green-600 text-white text-sm font-bold flex items-center justify-center shrink-0">5</div>
                    <h2 class="text-xl font-bold text-gray-900">Retensi & Penghapusan Data</h2>
                </div>
                <p class="text-gray-600 text-[15px] leading-relaxed mb-4">Kami menyimpan data Anda hanya selama diperlukan untuk tujuan rekrutmen:</p>
                <ul class="list-disc pl-5 space-y-3 text-[15px] text-gray-600 marker:text-green-500">
                    <li><strong class="text-gray-900 font-semibold">Pelamar yang tidak diterima:</strong> Data disimpan maksimal <strong>2 (dua) tahun</strong> sejak tanggal pendaftaran, untuk keperluan rekrutmen masa mendatang atau audit internal, kemudian dihapus secara permanen.</li>
                    <li><strong class="text-gray-900 font-semibold">Pelamar yang diterima:</strong> Data dialihkan ke sistem administrasi kepegawaian dan tunduk pada kebijakan privasi karyawan yang berlaku.</li>
                    <li><strong class="text-gray-900 font-semibold">Permintaan penghapusan lebih awal:</strong> Anda dapat mengajukan permintaan penghapusan data kapan saja sebelum periode retensi berakhir (lihat bagian Hak Pengguna).</li>
                </ul>
            </section>

            <!-- SECTION 6 -->
            <section id="s6" class="scroll-mt-24">
                <div class="flex items-center gap-3 mb-5 pb-3 border-b border-gray-100">
                    <div class="w-8 h-8 rounded-full bg-green-600 text-white text-sm font-bold flex items-center justify-center shrink-0">6</div>
                    <h2 class="text-xl font-bold text-gray-900">Hak-Hak Pengguna</h2>
                </div>
                <p class="text-gray-600 text-[15px] leading-relaxed mb-5">Sesuai dengan UU PDP, Anda memiliki hak-hak berikut atas data pribadi Anda:</p>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-5">
                    <div class="bg-white border border-gray-200 rounded-xl p-5">
                        <div class="text-base font-bold text-gray-900 mb-1.5">Hak Akses</div>
                        <div class="text-[15px] text-gray-600 leading-relaxed">Meminta konfirmasi data apa saja yang kami simpan tentang Anda</div>
                    </div>
                    <div class="bg-white border border-gray-200 rounded-xl p-5">
                        <div class="text-base font-bold text-gray-900 mb-1.5">Hak Koreksi</div>
                        <div class="text-[15px] text-gray-600 leading-relaxed">Meminta perbaikan data yang tidak akurat atau tidak lengkap</div>
                    </div>
                    <div class="bg-white border border-gray-200 rounded-xl p-5">
                        <div class="text-base font-bold text-gray-900 mb-1.5">Hak Penghapusan</div>
                        <div class="text-[15px] text-gray-600 leading-relaxed">Meminta penghapusan data Anda sebelum periode retensi berakhir</div>
                    </div>
                    <div class="bg-white border border-gray-200 rounded-xl p-5">
                        <div class="text-base font-bold text-gray-900 mb-1.5">Hak Keberatan</div>
                        <div class="text-[15px] text-gray-600 leading-relaxed">Mengajukan keberatan atas pemrosesan data dalam kondisi tertentu</div>
                    </div>
                </div>

                <p class="text-gray-600 text-[15px] leading-relaxed mb-5">Untuk mengajukan permintaan terkait hak-hak di atas, silakan hubungi Helpdesk kami. Kami akan merespons dalam <strong class="text-gray-900 font-semibold">14 hari kerja</strong> sejak permintaan diterima.</p>
                
                <div class="flex gap-3 bg-red-50 border border-red-200 rounded-xl p-4 md:p-5">
                    <i data-lucide="shield-alert" class="w-5 h-5 text-red-600 shrink-0 mt-0.5"></i>
                    <p class="text-[15px] text-red-900 leading-relaxed">Pemberian data yang tidak akurat, palsu, atau manipulasi berkas akan mengakibatkan <strong class="font-bold text-red-950">pembatalan otomatis</strong> proses rekrutmen Anda tanpa pemberitahuan lebih lanjut, dan dapat dilaporkan kepada pihak berwajib apabila terbukti merupakan tindakan pemalsuan dokumen.</p>
                </div>
            </section>

            <!-- SECTION 7 -->
            <section id="s7" class="scroll-mt-24">
                <div class="flex items-center gap-3 mb-4 pb-3 border-b border-gray-100">
                    <div class="w-8 h-8 rounded-full bg-green-600 text-white text-sm font-bold flex items-center justify-center shrink-0">7</div>
                    <h2 class="text-xl font-bold text-gray-900">Persetujuan (Consent)</h2>
                </div>
                <p class="text-gray-600 text-[15px] leading-relaxed mb-4">Dengan mengisi dan mengirimkan formulir lamaran kerja melalui platform Tokabe.id, Anda menyatakan:</p>
                <ul class="list-disc pl-5 space-y-2 text-[15px] text-gray-600 marker:text-green-500 mb-5">
                    <li>Telah membaca, memahami, dan <strong class="text-gray-900 font-semibold">menyetujui</strong> Kebijakan Privasi ini secara keseluruhan</li>
                    <li>Memberikan izin kepada Tokabe.id untuk mengumpulkan dan memproses data pribadi Anda sesuai tujuan yang dijelaskan dalam kebijakan ini</li>
                    <li>Bahwa seluruh data dan dokumen yang Anda berikan adalah benar dan dapat dipertanggungjawabkan</li>
                </ul>
                <p class="text-gray-600 text-[15px] leading-relaxed">Anda dapat mencabut persetujuan ini kapan saja dengan menghubungi Helpdesk kami. Pencabutan persetujuan dapat mengakibatkan penghentian proses rekrutmen Anda.</p>
            </section>

            <!-- SECTION 8 -->
            <section id="s8" class="scroll-mt-24">
                <div class="flex items-center gap-3 mb-5 pb-3 border-b border-gray-100">
                    <div class="w-8 h-8 rounded-full bg-green-600 text-white text-sm font-bold flex items-center justify-center shrink-0">8</div>
                    <h2 class="text-xl font-bold text-gray-900">Kontak & Helpdesk</h2>
                </div>
                <p class="text-gray-600 text-[15px] leading-relaxed mb-5">Jika Anda memiliki pertanyaan, keberatan, atau permintaan terkait data pribadi Anda, silakan hubungi tim kami:</p>
                
                <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
                    <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-6 px-6 py-4 border-b border-gray-100">
                        <div class="text-[15px] text-gray-500 sm:w-28 shrink-0">Email</div>
                        <div class="text-[15px] text-gray-900"><a href="mailto:loker@tokabe.id" class="text-green-600 font-medium hover:text-green-700 hover:underline transition-colors">loker@tokabe.id</a></div>
                    </div>
                    <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-6 px-6 py-4 border-b border-gray-100">
                        <div class="text-[15px] text-gray-500 sm:w-28 shrink-0">Platform</div>
                        <div class="text-[15px] text-gray-900"><a href="https://loker.tokabe.id" class="text-green-600 font-medium hover:text-green-700 hover:underline transition-colors">loker.tokabe.id</a></div>
                    </div>
                    <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-6 px-6 py-4 border-b border-gray-100">
                        <div class="text-[15px] text-gray-500 sm:w-28 shrink-0">Respons</div>
                        <div class="text-[15px] text-gray-800">Maksimal 14 hari kerja sejak pesan diterima</div>
                    </div>
                    <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-6 px-6 py-4">
                        <div class="text-[15px] text-gray-500 sm:w-28 shrink-0">Jam Layanan</div>
                        <div class="text-[15px] text-gray-800">Senin–Jumat, 08.00–17.00 WIB</div>
                    </div>
                </div>
            </section>
        </div>

        <!-- Footer Note -->
        <div class="border-t border-gray-200 pt-8 mt-12 text-sm text-gray-500 leading-relaxed text-justify md:text-left">
            Kebijakan Privasi ini dapat diperbarui sewaktu-waktu. Perubahan material akan diberitahukan melalui email terdaftar atau pemberitahuan di platform kami. Versi terbaru selalu tersedia di halaman ini. Dengan terus menggunakan layanan kami setelah pembaruan, Anda dianggap telah menyetujui perubahan tersebut.
        </div>

    </div>
</div>
@endsection