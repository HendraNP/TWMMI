<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id(); // Auto-increment primary key
            $table->string('customer_no')->unique()->comment('Customer Number');
            $table->string('customer_name');
            $table->text('office_address');
            $table->text('delivery_address')->nullable();
            $table->foreignId('sales_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('pic')->nullable(); // Person in Charge
            $table->string('telp_no', 30)->nullable();
            $table->string('email')->nullable();
            $table->string('npwp', 16)->nullable()->comment('NPWP 16-digit Indonesian Tax ID');
            $table->timestamps();
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('updated_by')->constrained('users');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
