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
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // Khóa chính, tự tăng [cite: 10]
            $table->string('name'); // Tên sản phẩm [cite: 10]
            $table->string('slug')->unique(); // Slug (duy nhất) [cite: 10]
            $table->text('short_description')->nullable(); // Mô tả ngắn (nullable) [cite: 10]
            $table->longText('description'); // Mô tả chi tiết sản phẩm [cite: 10]
            $table->decimal('regular_price', 15, 2); // Giá gốc (giá thị trường) [cite: 10]
            $table->unsignedInteger('stock_quantity'); // Số lượng tồn kho (nếu không quản lý theo variant) [cite: 10]
            $table->foreignId('category_id')->constrained('categories')->onDelete('restrict'); // Khóa ngoại đến categories(id) [cite: 10]
            $table->foreignId('brand_id')->nullable()->constrained('brands')->onDelete('set null'); // Khóa ngoại đến brands(id) (nullable) [cite: 10]
            $table->enum('status', ['published', 'draft', 'archived', 'out_of_stock'])->default('draft'); // Trạng thái sản phẩm (mặc định: 'draft') [cite: 10]
            $table->boolean('is_featured')->default(false); // Sản phẩm nổi bật (mặc định: false) [cite: 10]
            $table->unsignedInteger('view_count')->default(0); // Lượt xem (mặc định: 0) [cite: 10]
            $table->timestamps(); // Thời gian tạo và cập nhật [cite: 10]
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};