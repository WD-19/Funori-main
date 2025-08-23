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
            // Thêm cột pending_refund để đánh dấu đơn hàng chờ hoàn tiền
            if (!Schema::hasColumn('orders', 'pending_refund')) {
                $table->boolean('pending_refund')->default(false)->after('cancellation_reason');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            if (Schema::hasColumn('orders', 'pending_refund')) {
                $table->dropColumn('pending_refund');
            }
        });
    }
};
