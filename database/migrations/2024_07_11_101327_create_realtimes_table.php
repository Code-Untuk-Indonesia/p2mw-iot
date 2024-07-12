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
        Schema::create('realtimes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('Lokasi_id');
            $table->string('lat');
            $table->string('lon');
            $table->foreign('Lokasi_id')->references('Lokasi_id')->on('lokasis')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('realtimes');
    }
};
