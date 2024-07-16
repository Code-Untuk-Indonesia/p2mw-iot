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
            $table->id();
            $table->string('kodealat')->unique();
            $table->unsignedBigInteger('userapps_id');
            $table->timestamps();

            $table->foreign('userapps_id')->references('UniqueID')->on('user_apps')->onDelete('cascade');
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
