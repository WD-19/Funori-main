<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        // Đồng bộ tất cả trạng thái có thể dùng trong hệ thống, bao gồm 'returned'
        DB::statement("ALTER TABLE `orders` MODIFY `order_status` ENUM(
            'pending_confirmation',
            'confirmed',
            'pending',
            'processing',
            'assigned',
            'received',
            'in_delivery',
            'shipped',
            'delivered',
            'failed',
            'cancelled',
            'returned',
            'pending_cancellation'
        ) NOT NULL DEFAULT 'pending_confirmation'");
    }

    public function down(): void
    {
        // Trả về tập enum trước đó (không có 'returned') nếu cần
        DB::statement("ALTER TABLE `orders` MODIFY `order_status` ENUM(
            'pending_confirmation',
            'confirmed',
            'pending',
            'processing',
            'assigned',
            'received',
            'in_delivery',
            'shipped',
            'delivered',
            'failed',
            'cancelled',
            'pending_cancellation'
        ) NOT NULL DEFAULT 'pending_confirmation'");
    }
};


