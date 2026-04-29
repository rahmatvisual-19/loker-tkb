<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::table('jobs', function (Blueprint $table) {
        // Menambahkan relasi ke tabel categories
        // nullable() digunakan agar tidak error jika sebelumnya sudah ada data loker
        $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('cascade')->after('id');
    });
}

public function down(): void
{
    Schema::table('jobs', function (Blueprint $table) {
        $table->dropForeign(['category_id']);
        $table->dropColumn('category_id');
    });
}

};
