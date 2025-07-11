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
        Schema::create('wishlists', function (Blueprint $table) {
            $table->id(); // Khóa chính, tự tăng [cite: 37]
            $table->foreignId('user_id')->unique()->constrained('users')->onDelete('cascade'); // Khóa ngoại đến users(id) (duy nhất) [cite: 37]
            $table->timestamps(); // Thời gian tạo và cập nhật [cite: 37]
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wishlists');
    }
};