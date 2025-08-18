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
            // GPS coordinates for delivery location
            if (!Schema::hasColumn('orders', 'shipping_lat')) {
                $table->decimal('shipping_lat', 10, 8)->nullable();
            }
            if (!Schema::hasColumn('orders', 'shipping_lng')) {
                $table->decimal('shipping_lng', 11, 8)->nullable();
            }
            
            // GPS coordinates for delivery completion
            if (!Schema::hasColumn('orders', 'delivery_lat')) {
                $table->decimal('delivery_lat', 10, 8)->nullable();
            }
            if (!Schema::hasColumn('orders', 'delivery_lng')) {
                $table->decimal('delivery_lng', 11, 8)->nullable();
            }
            
            // Delivery tracking
            if (!Schema::hasColumn('orders', 'delivery_started_at')) {
                $table->timestamp('delivery_started_at')->nullable();
            }
            if (!Schema::hasColumn('orders', 'delivery_completed_at')) {
                $table->timestamp('delivery_completed_at')->nullable();
            }
            
            // Additional delivery info
            if (!Schema::hasColumn('orders', 'delivery_address')) {
                $table->string('delivery_address')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'shipping_lat',
                'shipping_lng',
                'delivery_lat',
                'delivery_lng',
                'delivery_started_at',
                'delivery_completed_at',
                'delivery_address'
            ]);
        });
    }
};
