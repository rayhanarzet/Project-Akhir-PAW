<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('short_desc')->nullable();
            $table->text('description')->nullable();
            $table->string('category')->nullable();
            $table->string('color')->nullable();
            $table->string('sizes')->nullable();
            $table->integer('price')->default(0);
            $table->date('close_po_date')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
};
