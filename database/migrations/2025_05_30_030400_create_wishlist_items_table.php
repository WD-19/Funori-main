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
        Schema::create('wishlist_items', function (Blueprint $table) {
            $table->id(); // Khóa chính, tự tăng [cite: 39]
            $table->foreignId('wishlist_id')->constrained('wishlists')->onDelete('cascade'); // Khóa ngoại đến wishlists(id) [cite: 39]
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade'); // Khóa ngoại đến products(id) [cite: 39]
            $table->timestamp('created_at')->useCurrent(); // Thời gian tạo [cite: 39]
            // Đảm bảo không có sản phẩm trùng lặp trong cùng một danh sách yêu thích
            $table->unique(['wishlist_id', 'product_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wishlist_items');
    }
};