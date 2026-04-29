<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('applications', function (Blueprint $table) {
            // Hapus kolom lama yang sifatnya tunggal
            $table->dropColumn([
                'company_name',
                'job_position',
                'work_start_date',
                'work_end_date',
                'job_description'
            ]);

            // Tambahkan 1 kolom JSON untuk menyimpan banyak pengalaman sekaligus
            $table->json('work_experiences')->nullable()->after('is_fresh_graduate');
        });
    }

    public function down()
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->dropColumn('work_experiences');
            
            $table->string('company_name')->nullable();
            $table->string('job_position')->nullable();
            $table->string('work_start_date')->nullable();
            $table->string('work_end_date')->nullable();
            $table->text('job_description')->nullable();
        });
    }
};