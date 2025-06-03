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
        Schema::create('product_variant_attribute_values', function (Blueprint $table) {
            $table->id(); // Khóa chính, tự tăng [cite: 20]
            $table->foreignId('product_variant_id')->constrained('product_variants')->onDelete('cascade'); // Khóa ngoại đến product_variants(id) [cite: 20]
            $table->foreignId('attribute_value_id')->constrained('attribute_values')->onDelete('cascade'); // Khóa ngoại đến attribute_values(id) [cite: 20]
            $table->timestamps(); // Thời gian tạo và cập nhật [cite: 20]
            // Đảm bảo mỗi cặp variant-attribute_value là duy nhất
            $table->unique(['product_variant_id', 'attribute_value_id'], 'pvav_variant_value_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variant_attribute_values');
    }
};