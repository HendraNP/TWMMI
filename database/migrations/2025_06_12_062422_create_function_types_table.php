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
        Schema::create('function_types', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('function_name', 255)->comment('Function Name');
            $table->string('function_code', 50)->unique()->comment('Function Code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('function_types');
    }
};
