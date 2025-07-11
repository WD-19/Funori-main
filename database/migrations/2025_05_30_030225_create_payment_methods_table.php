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
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id(); // Khóa chính, tự tăng [cite: 31]
            $table->string('name', 100); // Tên phương thức (ví dụ: COD, Chuyển khoản ngân hàng, VNPay) [cite: 31]
            $table->string('code', 50)->unique(); // Mã phương thức (ví dụ: cod, bank_transfer, vnpay) (duy nhất) [cite: 31]
            $table->text('description')->nullable(); // Mô tả (nullable) [cite: 31]
            $table->text('instructions')->nullable(); // Hướng dẫn thanh toán (ví dụ: thông tin tài khoản ngân hàng, nullable) [cite: 31]
            $table->boolean('is_active')->default(true); // Kích hoạt (mặc định: true) [cite: 31]
            $table->timestamps(); // Thời gian tạo và cập nhật [cite: 31]
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_methods');
    }
};