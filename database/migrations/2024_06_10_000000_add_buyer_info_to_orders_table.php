<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBuyerInfoToOrdersTable extends Migration
{
// thông tin người đặt hàng 
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('buyer_name')->nullable()->after('shipping_address');
            $table->string('buyer_email')->nullable()->after('buyer_name');
            $table->string('buyer_phone', 20)->nullable()->after('buyer_email');
            $table->text('buyer_address')->nullable()->after('buyer_phone');
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['buyer_name', 'buyer_email', 'buyer_phone', 'buyer_address']);
        });
    }
}
