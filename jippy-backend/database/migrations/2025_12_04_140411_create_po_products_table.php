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
        Schema::create('po_products', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->text('short_desc')->nullable();
    $table->text('description')->nullable();
    $table->string('category')->nullable();
    $table->string('color')->nullable();
    $table->string('sizes')->nullable();
    $table->decimal('price', 10, 2);
    $table->date('close_po_date')->nullable();
    $table->string('status')->default('open');
    $table->string('image')->nullable();
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('po_products');
    }
};
