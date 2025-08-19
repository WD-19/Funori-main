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
        Schema::create('refunds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
            $table->enum('gateway', ['momo', 'vnpay', 'manual']);
            $table->decimal('amount', 15, 2);
            $table->enum('status', ['pending', 'success', 'failed', 'cancelled'])->default('pending');
            $table->string('transaction_id', 255)->nullable(); 
            $table->string('refund_transaction_id', 255)->nullable(); 
            $table->text('gateway_response')->nullable(); 
            $table->text('error_message')->nullable(); 
            $table->timestamp('refunded_at')->nullable(); 
            $table->timestamps();
            
            $table->index(['order_id', 'status']);
            $table->index(['gateway', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('refunds');
    }
};
