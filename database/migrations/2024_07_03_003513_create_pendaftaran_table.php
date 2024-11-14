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
        Schema::create('Pendaftaran', function (Blueprint $table) {
            $table->id();
            $table->string('nisn', 10)->unique();
            $table->string('nama_lengkap', 50);
            $table->char('jenis_kelamin', 1);
            $table->string('tempat_lahir', 50);
            $table->date('tanggal_lahir');
            $table->char('golongan_darah', 2);
            $table->string('agama', 20);
            $table->string('alamat_rumah', 255);
            $table->string('nomor_hp', 15);
            $table->string('asal_sekolah', 100);
            $table->date('tanggal_daftar');
            $table->timestamps();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('orangtuasiswa_id');
            
            $table->foreign('user_id')
                ->references('id')
                ->on('users')->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('orangtuasiswa_id')
                ->references('id')
                ->on('OrangTuaSiswa')->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('studentregistrations');
    }
};
