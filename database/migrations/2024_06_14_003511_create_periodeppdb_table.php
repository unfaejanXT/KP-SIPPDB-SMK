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
        Schema::create('periodeppdb', function (Blueprint $table) {
            $table->id();
            $table->string('kode_periode', 20)->unique(); // Identifier unik untuk periode
            $table->string('nama_periode', 100);
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->string('tahun_ajaran', 9); // Format yang sesuai untuk tahun ajaran (e.g., 2023/2024)
            $table->boolean('status')->default(true); // Aktif atau nonaktif
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('periodeppdb');
    }
};
