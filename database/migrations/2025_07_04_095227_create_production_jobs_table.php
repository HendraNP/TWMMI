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
        Schema::create('production_jobs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invoice_detail_id')->constrained()->onDelete('cascade');
            $table->unsignedInteger('colour_product_id');
            $table->foreign('colour_product_id')->references('id')->on('colour_products')->onDelete('restrict');
            $table->decimal('quantity', 10, 2);
            $table->enum('status', ['waiting', 'in_progress', 'completed', 'finalized'])->default('waiting');
            $table->string('batch_code')->nullable()->unique();
            $table->timestamp('started_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('production_jobs');
    }
};
