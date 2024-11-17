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
            $table->enum('tipe_berkas', ['akta_kelahiran', 'kk', 'ijazah', 'ktp_orangtua', 'kip']); // Jenis berkas tetap
            $table->string('path_berkas', 255)->nullable(); // Untuk menyimpan path file
            $table->string('status_verifikasi', 50)->nullable(); // Status verifikasi
            $table->text('catatan_verifikasi')->nullable(); // Alasan verifikasi
            $table->date('tanggal_verifikasi')->nullable(); // Tanggal verifikasi
            $table->boolean('is_active')->default(true); // Status aktif berkas
            $table->unsignedBigInteger('pendaftaran_id'); // Relasi ke tabel pendaftaran
            $table->timestamps(); // Menambahkan created_at dan updated_at
    
            $table->foreign('pendaftaran_id')
                  ->references('id')
                  ->on('pendaftaran')
                  ->onDelete('cascade'); // Cascade delete ketika pendaftaran dihapus
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('files');
    }
};
