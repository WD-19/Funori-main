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
        Schema::create('pages', function (Blueprint $table) {
            $table->id(); // Khóa chính, tự tăng [cite: 51]
            $table->string('title'); // Tiêu đề trang/bài viết [cite: 51]
            $table->string('slug')->unique(); // Slug (duy nhất) [cite: 51]
            $table->longText('content'); // Nội dung trang (HTML hoặc Markdown) [cite: 51]
            $table->foreignId('author_id')->nullable()->constrained('users')->onDelete('set null'); // Khóa ngoại đến users(id) (người tạo/viết bài, nullable) [cite: 51]
            $table->enum('page_type', ['page', 'blog_post'])->default('page'); // Loại trang (mặc định: 'page') [cite: 51]
            $table->enum('status', ['published', 'draft'])->default('draft'); // Trạng thái (mặc định: 'draft') [cite: 51]
            $table->string('meta_title')->nullable(); // Thẻ meta title SEO (nullable) [cite: 51]
            $table->text('meta_description')->nullable(); // Thẻ meta description SEO (nullable) [cite: 51]
            $table->string('featured_image_url')->nullable(); // Ảnh đại diện cho bài blog (nullable) [cite: 51]
            $table->timestamp('published_at')->nullable(); // Thời gian xuất bản (nullable) [cite: 51]
            $table->timestamps(); // Thời gian tạo và cập nhật [cite: 51]
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};