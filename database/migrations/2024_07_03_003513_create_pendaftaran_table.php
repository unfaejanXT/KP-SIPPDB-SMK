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
        Schema::create('pendaftaran', function (Blueprint $table) {
            $table->id();
            $table->string('no_pendaftaran')->unique();
            $table->string('nisn', 10)->unique();
            $table->string('nama_lengkap', 50);
            $table->char('jenis_kelamin', 1);
            $table->string('tempat_lahir', 50);
            $table->date('tanggal_lahir');
            $table->char('golongan_darah', 2)->nullable(); // Bisa jadi optional
            $table->string('agama', 20);
            $table->string('alamat_rumah', 255);
            $table->string('nomor_hp', 15);
            $table->string('asal_sekolah', 100);
            $table->string('pas_foto',255)->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('gelombang_id'); // Referensi ke tabel gelombang
            $table->unsignedBigInteger('jurusan_id');
            $table->string('status', 20)->default('draft');
            $table->integer('current_step')->default(0);
            $table->timestamps();
    
            // Foreign keys
            $table->foreign('jurusan_id')
                ->references('id')
                ->on('jurusan')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
    
            $table->foreign('gelombang_id')
                ->references('id')
                ->on('gelombang')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });
    }
    
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftaran');
    }
};
