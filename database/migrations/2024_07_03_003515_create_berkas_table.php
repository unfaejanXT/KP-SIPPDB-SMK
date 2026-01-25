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
        Schema::create('berkas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pendaftaran_id')->constrained('pendaftaran')->onDelete('cascade');
            $table->foreignId('jenis_berkas_id')->constrained('jenis_berkas')->onDelete('cascade');
            $table->string('file_path');
            $table->string('status_verifikasi')->nullable();
            $table->text('catatan_verifikasi')->nullable();
            $table->timestamp('uploaded_at')->useCurrent();
            $table->timestamp('verified_at')->nullable();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berkas');
    }
};
