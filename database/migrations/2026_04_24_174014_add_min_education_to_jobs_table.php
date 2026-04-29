<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('jobs', function (Blueprint $table) {
            // Menambahkan kolom syarat minimal pendidikan (SMA/SMK, D3, S1, S2)
            $table->string('min_education')->default('SMA/SMK')->after('title');
        });
    }

    public function down()
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->dropColumn('min_education');
        });
    }
};