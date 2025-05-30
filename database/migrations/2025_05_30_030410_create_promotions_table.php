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
        Schema::create('promotions', function (Blueprint $table) {
            $table->id(); // Khóa chính, tự tăng [cite: 41]
            $table->string('name'); // Tên chương trình khuyến mãi [cite: 41]
            $table->string('code', 50)->unique()->nullable(); // Mã voucher/khuyến mãi (duy nhất, nullable nếu là KM tự động) [cite: 41]
            $table->text('description')->nullable(); // Mô tả (nullable) [cite: 41]
            $table->enum('discount_type', ['percentage', 'fixed_amount']); // Loại giảm giá [cite: 41]
            $table->decimal('discount_value', 10, 2); // Giá trị giảm (ví dụ: 10 cho 10%, 100000 cho 100.000 VNĐ) [cite: 41]
            $table->decimal('max_discount_amount', 15, 2)->nullable(); // Số tiền giảm tối đa (nếu discount_type là percentage, nullable) [cite: 41]
            $table->decimal('min_order_value', 15, 2)->nullable(); // Giá trị đơn hàng tối thiểu để áp dụng (nullable) [cite: 41]
            $table->unsignedInteger('usage_limit_per_voucher')->nullable(); // Số lần sử dụng tối đa cho voucher này (nullable) [cite: 41]
            $table->unsignedInteger('usage_limit_per_user')->nullable(); // Số lần sử dụng tối đa cho mỗi người dùng (nullable) [cite: 41]
            $table->unsignedInteger('times_used')->default(0); // Số lần đã sử dụng (mặc định: 0) [cite: 41]
            $table->dateTime('start_date'); // Thời gian bắt đầu [cite: 41]
            $table->dateTime('end_date')->nullable(); // Thời gian kết thúc (nullable nếu không giới hạn) [cite: 41]
            $table->boolean('is_active')->default(true); // Kích hoạt (mặc định: true) [cite: 41]
            $table->enum('applies_to', ['all_products', 'specific_products', 'specific_categories'])->default('all_products'); // Áp dụng cho (mặc định 'all_products') [cite: 41]
            $table->timestamps(); // Thời gian tạo và cập nhật [cite: 41]
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promotions');
    }
};