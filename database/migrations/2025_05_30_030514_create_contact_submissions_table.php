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
        Schema::create('contact_submissions', function (Blueprint $table) {
            $table->id(); // Khóa chính, tự tăng [cite: 53]
            $table->string('name'); // Tên người liên hệ [cite: 53]
            $table->string('email'); // Email người liên hệ [cite: 53]
            $table->string('phone', 20)->nullable(); // Số điện thoại (nullable) [cite: 53]
            $table->string('subject'); // Chủ đề [cite: 53]
            $table->text('message'); // Nội dung tin nhắn [cite: 53]
            $table->enum('status', ['new', 'read', 'replied', 'resolved'])->default('new'); // Trạng thái (mặc định: 'new') [cite: 53]
            $table->text('admin_reply')->nullable(); // Nội dung admin phản hồi (nullable) [cite: 53]
            $table->foreignId('replied_by')->nullable()->constrained('users')->onDelete('set null'); // Khóa ngoại đến users(id) (admin đã phản hồi, nullable) [cite: 53]
            $table->timestamp('created_at')->useCurrent(); // Thời gian gửi [cite: 53]
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate(); // Thời gian cập nhật trạng thái [cite: 53]
            $table->softDeletes(); // Tạo cột 'deleted_at' nullable

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_submissions');
    }
};
