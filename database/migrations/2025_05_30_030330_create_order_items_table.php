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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id(); // Khóa chính, tự tăng [cite: 29]
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade'); // Khóa ngoại đến orders(id) [cite: 29]
            $table->foreignId('product_id')->constrained('products')->onDelete('restrict'); // Khóa ngoại đến products(id) [cite: 29]
            $table->foreignId('product_variant_id')->nullable()->constrained('product_variants')->onDelete('restrict'); // Khóa ngoại đến product_variants(id) (nullable nếu SP không có variant) [cite: 29]
            $table->string('product_name'); // Tên sản phẩm tại thời điểm mua (denormalized) [cite: 29]
            $table->json('variant_attributes')->nullable(); // Các thuộc tính của biến thể tại thời điểm mua (ví dụ: {"Màu sắc": "Đỏ", "Kích thước": "L"}) (nullable) [cite: 29]
            $table->unsignedInteger('quantity'); // Số lượng mua [cite: 29]
            $table->decimal('subtotal', 15, 2); // Thành tiền cho mục này (quantity * price_at_purchase) [cite: 29]
            $table->timestamps(); // Thời gian tạo và cập nhật [cite: 29]
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};