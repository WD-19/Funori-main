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
        Schema::create('carts', function (Blueprint $table) {
            $table->id(); // Khóa chính, tự tăng [cite: 23]
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade'); // Khóa ngoại đến users(id) (nullable cho khách) [cite: 23]
            // Nếu muốn quản lý session_id cho khách, có thể thêm cột này
            // $table->string('session_id')->nullable()->unique();
            $table->timestamps(); // Thời gian tạo và cập nhật [cite: 23]
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};