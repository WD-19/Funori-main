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
        Schema::table('orders', function (Blueprint $table) {
            // Thêm các cột tracking delivery (kiểm tra tồn tại trước)
            if (!Schema::hasColumn('orders', 'received_at')) {
                $table->timestamp('received_at')->nullable()->after('shipper_id');
            }
            if (!Schema::hasColumn('orders', 'in_delivery_at')) {
                $table->timestamp('in_delivery_at')->nullable()->after('received_at');
            }
            if (!Schema::hasColumn('orders', 'failed_at')) {
                $table->timestamp('failed_at')->nullable()->after('in_delivery_at');
            }
            
            // Thêm các cột thông tin bổ sung
            if (!Schema::hasColumn('orders', 'delivery_notes')) {
                $table->text('delivery_notes')->nullable()->after('failed_at');
            }
            if (!Schema::hasColumn('orders', 'failure_reason')) {
                $table->text('failure_reason')->nullable()->after('delivery_notes');
            }
            if (!Schema::hasColumn('orders', 'delivery_images')) {
                $table->json('delivery_images')->nullable()->after('failure_reason');
            }
            
            // Cập nhật enum status để phù hợp với luồng mới
            $table->enum('order_status', [
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
                'cancelled'
            ])->default('pending_confirmation')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'received_at',
                'in_delivery_at', 
                'failed_at',
                'delivery_notes',
                'failure_reason',
                'delivery_images'
            ]);
            
            // Revert status enum
            $table->enum('order_status', [
                'pending_confirmation',
                'confirmed',
                'pending', 
                'processing',
                'shipped',
                'delivered',
                'cancelled'
            ])->default('pending_confirmation')->change();
        });
    }
};
