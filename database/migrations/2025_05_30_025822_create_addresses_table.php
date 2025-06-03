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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id(); // Khóa chính, tự tăng [cite: 4]
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Khóa ngoại đến users(id) [cite: 4]
            $table->string('receiver_name'); // Tên người nhận [cite: 4]
            $table->string('receiver_phone', 20); // Số điện thoại người nhận [cite: 4]
            $table->string('street_address'); // Địa chỉ cụ thể (số nhà, đường) [cite: 4]
            $table->string('address_type', 50)->nullable(); // Loại địa chỉ (ví dụ: nhà, công ty - nullable) [cite: 4]
            $table->boolean('is_default')->default(false); // Là địa chỉ mặc định (mặc định: false) [cite: 4]
            $table->timestamps(); // Thời gian tạo và cập nhật [cite: 4]
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};