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
        Schema::create('pendaftaran_siswa', function (Blueprint $table) {
            $table->id();
            $table->string('nisn', 10)->unique();
            $table->string('nama_lengkap', 50);
            $table->char('jenis_kelamin', 1);
            $table->string('tempat_lahir', 50);
            $table->date('tanggal_lahir');
            $table->char('gol_darah', 2);
            $table->string('agama', 20);
            $table->string('alamat', 255);
            $table->string('nohp', 15);
            $table->string('asal_sekolah', 100);
            $table->date('tanggal_daftar');
            $table->unsignedBigInteger('orangtua_id');
            $table->unsignedBigInteger('berkas_id');
            $table->timestamps();

            $table->foreign('orangtua_id')
                ->references('id')
                ->on('orangtua')->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('berkas_id')
                ->references('id')
                ->on('berkas')->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_registrations');
    }
};
