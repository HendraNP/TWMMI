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
        Schema::create('colour_catalogs', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('colour_name', 50)->nullable();
            $table->string('colour_code', 10)->nullable();
            $table->string('hex_code', 7)->nullable();
            $table->string('colour_family', 10)->nullable();
            $table->dateTime('created_at')->nullable()->useCurrent();
            $table->dateTime('updated_at')->useCurrentOnUpdate()->nullable();
            $table->string('type', 7)->nullable();
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('updated_by')->constrained('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('colour_catalogs');
    }
};
