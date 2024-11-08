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
        Schema::create('nilais', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('walas_id');
            $table->unsignedBigInteger('siswa_id')->unique();
            $table->double('matematika');
            $table->double('indonesia');
            $table->double('inggris');
            $table->double('kejuruan');
            $table->double('pilihan');
            $table->double('rata_rata');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilais');
    }
};
