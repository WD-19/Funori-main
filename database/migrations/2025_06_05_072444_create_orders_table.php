<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id(); // BIGINT UNSIGNED, AUTO_INCREMENT

            //  muốn cho phép guest checkout => user_id có thể NULL
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('order_code', 50)->unique();       // Mã đơn hàng duy nhất
            $table->string('customer_name', 255);             // Tên người nhận (denormalized)
            $table->string('customer_email', 255);            // Email người nhận
            $table->string('customer_phone', 20);             // Số điện thoại
            $table->text('shipping_address');                 // Địa chỉ giao hàng đầy đủ

            $table->decimal('subtotal_amount', 15, 2)->default(0);   // Tổng tiền sản phẩm
            $table->decimal('shipping_fee', 10, 2)->default(0);      // Phí vận chuyển
            $table->decimal('discount_amount', 15, 2)->default(0);   // Số tiền giảm giá
            $table->decimal('tax_amount', 15, 2)->default(0);        // Tiền thuế
            $table->decimal('total_amount', 15, 2)->default(0);      // Tổng tiền thanh toán cuối

            $table->unsignedBigInteger('payment_method_id');    // Khóa ngoại đến payment_methods(id)
            $table->enum('payment_status', ['pending', 'paid', 'failed', 'refunded'])
                  ->default('pending');                         // Trạng thái thanh toán

            $table->unsignedBigInteger('shipping_method_id');   // Khóa ngoại đến shipping_methods(id)
            $table->enum('order_status', [
                    'pending_confirmation',
                    'processing',
                    'shipped',
                    'delivered',
                    'cancelled',
                    'returned'
                ])->default('pending_confirmation');            // Trạng thái đơn hàng

            $table->text('customer_note')->nullable();   // Ghi chú của khách (nullable)
            $table->text('admin_note')->nullable();      // Ghi chú của admin (nullable)

            $table->timestamp('ordered_at')->useCurrent();        // Thời gian đặt hàng, mặc định current timestamp
            $table->timestamp('delivered_at')->nullable();        // Thời gian giao thành công
            $table->timestamp('cancelled_at')->nullable();        // Thời gian hủy đơn
            $table->text('cancellation_reason')->nullable();      // Lý do hủy đơn

            $table->timestamps(); // created_at, updated_at

            // Thiết lập foreign key (nếu đã có bảng users, payment_methods, shipping_methods)
            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onDelete('set null');

            $table->foreign('payment_method_id')
                  ->references('id')->on('payment_methods')
                  ->onDelete('restrict');

            $table->foreign('shipping_method_id')
                  ->references('id')->on('shipping_methods')
                  ->onDelete('restrict');
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
