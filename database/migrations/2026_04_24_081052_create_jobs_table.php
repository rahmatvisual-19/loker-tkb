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
    Schema::create('jobs', function (Blueprint $table) {
        $table->id();
        $table->string('title'); // Contoh: Operational Support
        $table->string('location'); // Contoh: MEDAN
        $table->string('type'); // Contoh: Full-time
        $table->string('status'); // Contoh: PKWT (Kontrak)
        $table->string('salary_range'); // Contoh: Rp 3.000.000 - Rp 4.000.000
        $table->longText('qualification');
        $table->longText('description');
        $table->longText('facilities');
        $table->string('apply_link')->nullable();
        $table->boolean('is_active')->default(true);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
