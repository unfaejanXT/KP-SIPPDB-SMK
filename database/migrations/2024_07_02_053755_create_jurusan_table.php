<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('jurusan', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 50)->unique(); // Kode unik untuk jurusan
            $table->string('nama', 100);
            $table->text('deskripsi')->nullable(); // Deskripsi tidak wajib
            $table->unsignedSmallInteger('kuota')->default(0); // Tipe data lebih kecil untuk kuota
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jurusan');
    }
};


