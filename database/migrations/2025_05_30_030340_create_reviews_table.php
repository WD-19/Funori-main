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
            $table->id(); // Khóa chính, tự tăng
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Khóa ngoại đến users(id)
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade'); // Khóa ngoại đến products(id)
            $table->foreignId('order_item_id')->constrained('order_items')->onDelete('cascade'); // Khóa ngoại đến order_items(id)
            $table->unsignedTinyInteger('rating'); // Điểm đánh giá (1-5)
            $table->text('comment')->nullable(); // Nội dung bình luận
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending'); // Trạng thái
            $table->text('admin_reply')->nullable(); // Phản hồi từ admin (thêm dòng này)
            $table->timestamp('admin_reply_created_at')->nullable(); // Thời gian phản hồi admin (thêm dòng này)
            $table->timestamps(); // Thời gian tạo và cập nhật
            $table->softDeletes(); // Tạo cột 'deleted_at' nullable
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
