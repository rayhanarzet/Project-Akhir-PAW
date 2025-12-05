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
    Schema::create('reviews', function (Blueprint $table) {
        $table->id();
        $table->string('username');
        $table->integer('rating');
        $table->string('summary'); 
        $table->string('texture');
        $table->string('expired');
        // image_path kita tambahkan lewat migration satunya lagi, 
        // tapi kalau mau langsung disini juga bisa. 
        // Biar rapi sesuai command kamu, kita biarkan ini untuk data dasar dulu.
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
