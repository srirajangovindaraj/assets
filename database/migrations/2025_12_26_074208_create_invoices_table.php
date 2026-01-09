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
        Schema::create('invoices', function (Blueprint $table) {
              $table->id();
            $table->foreignId('vendor_id')->constrained()->cascadeOnDelete();
            $table->string('invoice_number')->unique();
            $table->date('invoice_date');
            $table->string('category')->nullable();
            $table->date('due_date')->nullable();
            $table->decimal('partial_amount', 10, 2)->nullable();
            $table->decimal('sub_total', 12, 2);
            $table->enum('discount_type', ['percentage', 'amount'])->nullable();
            $table->decimal('discount_percentage', 4, 2)->nullable();
            $table->decimal('discount_amount', 12, 2)->nullable();
            $table->decimal('tax_amount', 12, 2)->default(0);
            $table->decimal('total_amount', 12, 2);
            $table->string('invoice_file_path')->nullable();
            $table->enum('status', ['paid', 'unpaid','partial_paid'])->default('unpaid');

            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
