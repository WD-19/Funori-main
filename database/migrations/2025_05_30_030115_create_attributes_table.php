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
        Schema::create('attributes', function (Blueprint $table) {
            $table->id(); // Khóa chính, tự tăng [cite: 14]
            $table->string('name', 100); // Tên thuộc tính (ví dụ: Màu sắc) [cite: 14]
            $table->timestamps(); // Thời gian tạo và cập nhật [cite: 14]
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attributes');
    }
};