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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id(); // Khóa chính, tự tăng [cite: 35]
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Khóa ngoại đến users(id) [cite: 35]
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade'); // Khóa ngoại đến products(id) [cite: 35]
            $table->foreignId('order_item_id')->constrained('order_items')->onDelete('cascade'); // Khóa ngoại đến order_items(id) (để đảm bảo người dùng đã mua SP) [cite: 35]
            $table->unsignedTinyInteger('rating'); // Điểm đánh giá (ví dụ: 1 đến 5) [cite: 35]
            $table->text('comment')->nullable(); // Nội dung bình luận (nullable) [cite: 35]
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending'); // Trạng thái (mặc định: 'pending' - chờ duyệt) [cite: 35]
            $table->timestamps(); // Thời gian tạo và cập nhật [cite: 35]
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};