<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();

            // relasi review → transaction
            $table->unsignedBigInteger('transaction_id');

            $table->string('username');
            $table->integer('rating');
            $table->string('summary');
            $table->string('texture');
            $table->string('expired');

            $table->string('image_path')->nullable();

            $table->timestamps();

            $table->foreign('transaction_id')
                ->references('id')
                ->on('transactions')
                ->onDelete('cascade');   // kalau transaksi dihapus, review ikut hilang
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
