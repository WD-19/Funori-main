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
        Schema::create('brands', function (Blueprint $table) {
            $table->id(); // Khóa chính, tự tăng [cite: 8]
            $table->string('name')->unique(); // Tên thương hiệu (duy nhất) [cite: 8]
            $table->string('slug')->unique(); // Slug (duy nhất) [cite: 8]
            $table->string('logo_url')->nullable(); // Đường dẫn logo thương hiệu (nullable) [cite: 8]
            $table->text('description')->nullable(); // Mô tả (nullable) [cite: 8]
            $table->boolean('is_active')->default(true); // Kích hoạt (mặc định: true) [cite: 8]
            $table->timestamps(); // Thời gian tạo và cập nhật [cite: 8]
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brands');
    }
};