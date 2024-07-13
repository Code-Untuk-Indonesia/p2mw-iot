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
        Schema::create('alats', function (Blueprint $table) {
            $table->unsignedBigInteger('Kode_alat')->primary();
            $table->unsignedBigInteger('user_id');
            $table->string('kejadian');
            $table->timestamps();

            $table->foreign('user_id')->references('UniqueID')->on('user_apps')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alats');
    }
};
