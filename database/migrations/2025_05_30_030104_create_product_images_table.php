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
        Schema::create('product_images', function (Blueprint $table) {
            $table->id(); // Khóa chính, tự tăng [cite: 12]
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade'); // Khóa ngoại đến products(id) [cite: 12]
            $table->string('image_url'); // Đường dẫn hình ảnh [cite: 12]
            $table->string('alt_text')->nullable(); // Văn bản thay thế cho ảnh (SEO, nullable) [cite: 12]
            $table->boolean('is_thumbnail')->default(false); // Là ảnh đại diện chính của sản phẩm (mặc định: false) [cite: 12]
            $table->integer('order'); // Thứ tự hiển thị ảnh [cite: 12]
            $table->timestamps(); // Thời gian tạo và cập nhật [cite: 12]
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_images');
    }
};