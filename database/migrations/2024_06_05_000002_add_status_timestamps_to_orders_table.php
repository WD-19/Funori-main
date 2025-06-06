<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusTimestampsToOrdersTable extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            if (!Schema::hasColumn('orders', 'processing_at')) {
                $table->timestamp('processing_at')->nullable()->after('ordered_at');
            }
            if (!Schema::hasColumn('orders', 'shipped_at')) {
                $table->timestamp('shipped_at')->nullable()->after('processing_at');
            }
            if (!Schema::hasColumn('orders', 'returned_at')) {
                $table->timestamp('returned_at')->nullable()->after('cancelled_at');
            }
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            if (Schema::hasColumn('orders', 'processing_at')) {
                $table->dropColumn('processing_at');
            }
            if (Schema::hasColumn('orders', 'shipped_at')) {
                $table->dropColumn('shipped_at');
            }
            if (Schema::hasColumn('orders', 'returned_at')) {
                $table->dropColumn('returned_at');
            }
        });
    }
}
