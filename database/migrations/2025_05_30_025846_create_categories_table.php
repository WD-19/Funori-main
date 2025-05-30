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
        Schema::create('categories', function (Blueprint $table) {
            $table->id(); // Khóa chính, tự tăng [cite: 6]
            $table->string('name')->unique(); // Tên danh mục (duy nhất) [cite: 6]
            $table->string('slug')->unique(); // Slug (duy nhất) [cite: 6]
            $table->foreignId('parent_id')->nullable()->constrained('categories')->onDelete('set null'); // Khóa ngoại đến categories(id) (cho danh mục cha, nullable) [cite: 6]
            $table->text('description')->nullable(); // Mô tả (nullable) [cite: 6]
            $table->string('image_url')->nullable(); // Đường dẫn ảnh danh mục (nullable) [cite: 6]
            $table->boolean('is_active')->default(true); // Kích hoạt (mặc định: true) [cite: 6]
            $table->timestamps(); // Thời gian tạo và cập nhật [cite: 6]
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};