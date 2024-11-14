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
        Schema::create('Berkas', function (Blueprint $table) {
            $table->id();
            $table->string('namaBerkas', 50)->nullable();
            $table->string('jenisBerkas', 50)->nullable();
            $table->string('filePath', 50)->nullable();
            $table->string('statusVerifikasi', 50)->nullable();
            $table->string('catatanVerifikasi', 50)->nullable();
            $table->date('tanggalVerifikasi')->nullable();
            $table->boolean('isActive')->nullable();
            $table->unsignedBigInteger('idPendaftaran');
            
            $table->foreign('idPendaftaran')
                ->references('id')
                ->on('Pendaftaran');

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
