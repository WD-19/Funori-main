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
        Schema::create('banners', function (Blueprint $table) {
            $table->id(); // Khóa chính, tự tăng [cite: 49]
            $table->string('title'); // Tiêu đề banner [cite: 49]
            $table->string('image_url'); // Đường dẫn hình ảnh banner [cite: 49]
            $table->string('link_url')->nullable(); // Đường dẫn khi click vào banner (nullable) [cite: 49]
            $table->text('description')->nullable(); // Mô tả ngắn (nullable) [cite: 49]
            $table->string('position', 50); // Vị trí hiển thị (ví dụ: homepage_slider, sidebar) [cite: 49]
            $table->integer('order'); // Thứ tự hiển thị trong cùng một position [cite: 49]
            $table->dateTime('start_date')->nullable(); // Ngày bắt đầu hiển thị (nullable) [cite: 49]
            $table->dateTime('end_date')->nullable(); // Ngày kết thúc hiển thị (nullable) [cite: 49]
            $table->boolean('is_active')->default(true); // Kích hoạt (mặc định: true) [cite: 49]
            $table->timestamps(); // Thời gian tạo và cập nhật [cite: 49]
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};