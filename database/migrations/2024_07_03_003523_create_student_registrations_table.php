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
        Schema::create('student_registrations', function (Blueprint $table) {
            $table->id();
            $table->string('nisn', 10)->unique();
            $table->string('nama_lengkap', 60);
            $table->char('jenis_kelamin', 1);
            $table->string('tempat_lahir', 100);
            $table->date('tanggal_lahir');
            $table->char('gol_darah', 2);
            $table->string('agama', 50);
            $table->string('alamat', 255);
            $table->string('nohp', 15);
            $table->string('asal_sekolah', 100);
            $table->date('tanggal_daftar');

            $table->unsignedBigInteger('userId');
            $table->foreign('userId')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('documentsId');
            $table->foreign('documentsId')->references('id')->on('documents')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('parentId');
            $table->foreign('parentId')->references('id')->on('parents')->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();
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
