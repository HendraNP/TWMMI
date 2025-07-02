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
        Schema::create('user_mails', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(false);
            $table->string('email')->nullable(false);
            $table->text('message')->nullable(false);
            $table->string('flag')->default('unread'); // 'unread', 'read', 'replied', etc.
            $table->text('reply')->nullable();
            $table->integer('replied_by')->nullable(); // ID of the user who replied
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_mails');
    }
};
