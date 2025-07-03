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
        Schema::create('colour_products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('product_id')->unique('products_product_id_unique');
            $table->string('product_name');
            $table->string('function')->nullable();
            $table->string('colour')->nullable();
            $table->string('invoice_product_name')->nullable();
            $table->timestamps();
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('updated_by')->constrained('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('colour_products');
    }
};
