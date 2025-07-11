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
        Schema::create('shipping_methods', function (Blueprint $table) {
            $table->id(); // Khóa chính, tự tăng [cite: 33]
            $table->string('name', 100); // Tên phương thức (ví dụ: Giao hàng nhanh, Giao hàng tiêu chuẩn) [cite: 33]
            $table->text('description')->nullable(); // Mô tả (nullable) [cite: 33]
            $table->decimal('cost', 10, 2); // Chi phí (có thể là 0 cho miễn phí vận chuyển) [cite: 33]
            $table->boolean('is_active')->default(true); // Kích hoạt (mặc định: true) [cite: 33]
            $table->timestamps(); // Thời gian tạo và cập nhật [cite: 33]
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipping_methods');
    }
};