<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('model_histories', function (Blueprint $table) {
            $table->id();
            $table->string('model_type'); // e.g. App\Models\Customer
            $table->unsignedBigInteger('model_id'); // ID of the model instance
            $table->string('event'); // 'created' or 'updated'
            $table->json('before_changes')->nullable()->comment('Original values before update');
            $table->json('changes')->nullable(); // JSON of changed attributes
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete(); // who made the change
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('model_histories');
    }
};