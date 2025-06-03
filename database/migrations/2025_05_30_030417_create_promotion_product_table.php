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
        Schema::create('promotion_product', function (Blueprint $table) {
            $table->foreignId('promotion_id')->constrained('promotions')->onDelete('cascade'); // Khóa ngoại đến promotions(id) [cite: 43]
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade'); // Khóa ngoại đến products(id) [cite: 43]
            $table->primary(['promotion_id', 'product_id']); // Khóa chính kép [cite: 43]
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promotion_product');
    }
};