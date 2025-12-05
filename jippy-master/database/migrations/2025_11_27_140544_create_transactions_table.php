<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('order_id')->unique();
            $table->unsignedBigInteger('product_id');
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone');
            $table->integer('quantity');
            $table->integer('total_price');
            $table->string('payment_status')->default('pending'); // pending | success | failed
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
