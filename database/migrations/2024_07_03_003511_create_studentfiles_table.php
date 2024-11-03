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
        Schema::create('studentfiles', function (Blueprint $table) {
            $table->id();
            $table->string('file_foto', 50)->nullable();
            $table->string('file_kartukeluarga', 50)->nullable();
            $table->string('file_aktakelahiran', 50)->nullable();
            $table->string('file_ijazah', 50)->nullable();
            $table->timestamps();
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
