<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            // Relasi ke tabel jobs (Jika loker dihapus, lamaran ikut terhapus)
            $table->foreignId('job_id')->constrained()->onDelete('cascade');
            
            // Status Pelamar
            $table->string('status')->default('Menunggu'); // Menunggu, Direview, Wawancara, Ditolak

            // BAGIAN 1: Data Diri
            $table->string('name');
            $table->string('email');
            $table->string('whatsapp');
            $table->string('birth_place');
            $table->date('birth_date');
            $table->enum('gender', ['Laki-laki', 'Perempuan']);
            $table->string('domicile');
            $table->string('portfolio_link')->nullable();
            $table->string('photo_path');

            // BAGIAN 2: Pendidikan
            $table->string('education_level');
            $table->string('institution_name');
            $table->string('major');
            $table->string('gpa');

            // BAGIAN 3: Pengalaman
            $table->boolean('is_fresh_graduate')->default(false);
            $table->string('company_name')->nullable();
            $table->string('job_position')->nullable();
            $table->string('work_start_date')->nullable(); // Bulan/Tahun Mulai
            $table->string('work_end_date')->nullable();   // Bulan/Tahun Selesai atau "Saat Ini"
            $table->text('job_description')->nullable();

            // BAGIAN 4: Fisik & Kesiapan
            $table->integer('height');
            $table->integer('weight');
            $table->boolean('is_color_blind')->default(false);
            $table->text('disease_history')->nullable();
            $table->string('expected_salary');
            $table->boolean('willing_out_of_town')->default(false);
            $table->string('notice_period');

            // BAGIAN 5: Berkas
            $table->string('cv_path');
            $table->string('supporting_doc_path')->nullable();

            $table->timestamps();

            // KUNCI VALIDASI: 1 Email tidak bisa melamar job_id yang sama berkali-kali
            $table->unique(['job_id', 'email']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('applications');
    }
};