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
        Schema::create('attribute_values', function (Blueprint $table) {
            $table->id(); // Khóa chính, tự tăng [cite: 16]
            $table->foreignId('attribute_id')->constrained('attributes')->onDelete('cascade'); // Khóa ngoại đến attributes(id) [cite: 16]
            $table->string('value', 100); // Giá trị (ví dụ: Đỏ, L) [cite: 16]
            $table->timestamps(); // Thời gian tạo và cập nhật [cite: 16]
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attribute_values');
    }
};