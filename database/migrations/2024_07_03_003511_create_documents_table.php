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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('foto', 50);
            $table->string('kk', 50);
            $table->string('akta_kelahiran', 50);
            $table->string('ijazah', 50);
            $table->unsignedBigInteger('registration_id');

            $table->foreign('registration_id')
                ->references('id')
                ->on('student_registrations')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
