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
        Schema::create('orangtuasiswa', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pendaftaran_id')->unique(); // Menghubungkan ke tabel pendaftaran
            $table->string('nama_ayah', 100);
            $table->string('pekerjaan_ayah', 50);
            $table->decimal('penghasilan_ayah', 12, 2)->default(0);
            $table->string('nama_ibu', 100);
            $table->string('pekerjaan_ibu', 50);
            $table->decimal('penghasilan_ibu', 12, 2)->default(0);
            $table->string('nama_wali', 100)->nullable();
            $table->string('pekerjaan_wali', 50)->nullable();
            $table->decimal('penghasilan_wali', 12, 2)->nullable()->default(0);
            $table->text('alamat_wali')->nullable();
            $table->string('no_hp_wali', 20)->nullable();
            $table->string('no_hp_orangtua', 20)->nullable();
            $table->timestamps();

            // Foreign key
            $table->foreign('pendaftaran_id')
                ->references('id')
                ->on('pendaftaran')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orangtuasiswa');
    }
};
