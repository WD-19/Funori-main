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
        Schema::table('shippers', function (Blueprint $table) {
            // Location tracking fields
            $table->decimal('current_lat', 10, 8)->nullable();
            $table->decimal('current_lng', 11, 8)->nullable();
            $table->timestamp('location_updated_at')->nullable();
            
            // Online status fields
            $table->boolean('is_online')->default(false);
            $table->timestamp('last_online_at')->nullable();
            $table->timestamp('last_login_at')->nullable();
            
            // Additional fields for better tracking
            $table->string('current_address')->nullable();
            $table->decimal('accuracy', 5, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('shippers', function (Blueprint $table) {
            $table->dropColumn([
                'current_lat',
                'current_lng', 
                'location_updated_at',
                'is_online',
                'last_online_at',
                'last_login_at',
                'current_address',
                'accuracy'
            ]);
        });
    }
};
