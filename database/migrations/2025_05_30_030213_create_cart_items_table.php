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
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id(); // Khóa chính, tự tăng [cite: 25]
            $table->foreignId('cart_id')->constrained('carts')->onDelete('cascade'); // Khóa ngoại đến carts(id) [cite: 25]
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade'); // Khóa ngoại đến products(id) [cite: 25]
            $table->foreignId('product_variant_id')->nullable()->constrained('product_variants')->onDelete('set null'); // Khóa ngoại đến product_variants(id) (nullable nếu SP không có variant) [cite: 25]
            $table->unsignedInteger('quantity'); // Số lượng [cite: 25]
            $table->decimal('price_at_addition', 15, 2); // Giá tại thời điểm thêm vào giỏ (để xử lý thay đổi giá) [cite: 25]
            $table->timestamps(); // Thời gian tạo và cập nhật [cite: 25]
            // Đảm bảo không có sản phẩm/biến thể trùng lặp trong cùng một giỏ hàng
            $table->unique(['cart_id', 'product_id', 'product_variant_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};