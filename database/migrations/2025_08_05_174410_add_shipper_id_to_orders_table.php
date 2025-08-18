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
            // Kiểm tra nếu cột shipper_id chưa tồn tại thì mới thêm
            if (!Schema::hasColumn('orders', 'shipper_id')) {
                $table->foreignId('shipper_id')->nullable()->after('user_id')->constrained('shippers')->onDelete('set null');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            if (Schema::hasColumn('orders', 'shipper_id')) {
                $table->dropForeign(['shipper_id']);
                $table->dropColumn('shipper_id');
            }
        });
    }
};