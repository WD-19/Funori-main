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
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Khóa chính, tự tăng [cite: 2]
            $table->string('full_name'); // Họ và tên [cite: 2]
            $table->string('email')->unique(); // Email (duy nhất, dùng để đăng nhập) [cite: 2]
            $table->string('password'); // Mật khẩu (đã được hash) [cite: 2]
            $table->string('phone_number', 20)->nullable(); // Số điện thoại (có thể duy nhất) [cite: 2]
            $table->string('avatar_url')->nullable(); // Đường dẫn ảnh đại diện (nullable) [cite: 2]
            $table->enum('account_status', ['active', 'inactive', 'banned'])->default('active'); // Trạng thái tài khoản (mặc định: 'active') [cite: 2]
            $table->enum('role', ['user', 'admin'])->default('user'); // Vai trò người dùng (mặc định: 'user') [cite: 2]
            $table->string('remember_token', 100)->nullable(); // Token "nhớ đăng nhập" (nullable) [cite: 2]
            $table->timestamps(); // Thời gian tạo và cập nhật [cite: 2]
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};