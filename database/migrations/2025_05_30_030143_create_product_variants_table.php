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
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id(); // Khóa chính, tự tăng [cite: 18]
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade'); // Khóa ngoại đến products(id) [cite: 18]
            $table->decimal('price_modifier', 10, 2); // Chênh lệch giá so với giá gốc sản phẩm (có thể âm hoặc dương) [cite: 18]
            $table->unsignedInteger('stock_quantity'); // Số lượng tồn kho của biến thể này [cite: 18]
            $table->foreignId('image_id')->nullable()->constrained('product_images')->onDelete('set null'); // Khóa ngoại đến product_images(id) (ảnh riêng cho variant, nullable) [cite: 18]
            $table->string('size', 50)->nullable(); // Thêm cột size, cho phép null
            $table->timestamps(); // Thời gian tạo và cập nhật [cite: 18]
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variants');
    }
};