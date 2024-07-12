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
        Schema::create('histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_alat');
            $table->foreign('id_alat')->references('Kode_alat')->on('alats')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('history_lokasi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('history_id');
            $table->unsignedBigInteger('lokasi_id');
            $table->foreign('history_id')->references('id')->on('histories')->onDelete('cascade');
            $table->foreign('lokasi_id')->references('Lokasi_id')->on('lokasis')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('history_lokasi');
        Schema::dropIfExists('histories');
    }
};
