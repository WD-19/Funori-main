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
        Schema::create('promotion_category', function (Blueprint $table) {
            $table->foreignId('promotion_id')->constrained('promotions')->onDelete('cascade'); // Khóa ngoại đến promotions(id) [cite: 45]
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade'); // Khóa ngoại đến categories(id) [cite: 45]
            $table->primary(['promotion_id', 'category_id']); // Khóa chính kép [cite: 45]
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promotion_category');
    }
};