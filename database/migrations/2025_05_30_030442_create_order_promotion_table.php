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
        Schema::create('order_promotion', function (Blueprint $table) {
            $table->id(); // Khóa chính, tự tăng [cite: 47]
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade'); // Khóa ngoại đến orders(id) [cite: 47]
            $table->foreignId('promotion_id')->constrained('promotions')->onDelete('restrict'); // Khóa ngoại đến promotions(id) [cite: 47]
            $table->decimal('discount_applied', 15, 2); // Số tiền giảm giá cụ thể được áp dụng cho đơn hàng này [cite: 47]
            $table->timestamp('created_at')->useCurrent(); // Thời gian tạo [cite: 47]
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_promotion');
    }
};