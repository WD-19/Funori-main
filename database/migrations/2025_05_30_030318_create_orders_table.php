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
        Schema::create('orders', function (Blueprint $table) {
            $table->id(); // Khóa chính, tự tăng [cite: 27]
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null'); // Khóa ngoại đến users(id) (có thể nullable nếu cho phép guest checkout) [cite: 27]
            $table->string('order_code', 50)->unique(); // Mã đơn hàng (duy nhất, dễ đọc) [cite: 27]
            $table->string('customer_name'); // Tên người nhận (denormalized) [cite: 27]
            $table->string('customer_email'); // Email người nhận (denormalized) [cite: 27]
            $table->string('customer_phone', 20); // Số điện thoại người nhận (denormalized) [cite: 27]
            $table->text('shipping_address'); // Địa chỉ giao hàng đầy đủ (denormalized) [cite: 27]
            $table->decimal('subtotal_amount', 15, 2); // Tổng tiền sản phẩm (trước thuế, phí, giảm giá) [cite: 27]
            $table->decimal('shipping_fee', 10, 2); // Phí vận chuyển [cite: 27]
            $table->decimal('discount_amount', 15, 2)->default(0.00); // Số tiền giảm giá (từ voucher/khuyến mãi) [cite: 27]
            $table->decimal('tax_amount', 15, 2)->default(0.00); // Tiền thuế (nếu có) [cite: 27]
            $table->decimal('total_amount', 15, 2); // Tổng tiền thanh toán cuối cùng [cite: 27]
            $table->foreignId('payment_method_id')->constrained('payment_methods')->onDelete('restrict'); // Khóa ngoại đến payment_methods(id) [cite: 27]
            $table->enum('payment_status', ['pending', 'paid', 'failed', 'refunded'])->default('pending'); // Trạng thái thanh toán (mặc định: 'pending') [cite: 27]
            $table->foreignId('shipping_method_id')->constrained('shipping_methods')->onDelete('restrict'); // Khóa ngoại đến shipping_methods(id) [cite: 27]
            $table->enum('order_status', ['pending_confirmation', 'processing', 'shipped', 'delivered', 'cancelled', 'returned'])->default('pending_confirmation'); // Trạng thái đơn hàng (mặc định: 'pending_confirmation') [cite: 27]
            $table->text('customer_note')->nullable(); // Ghi chú của khách hàng (nullable) [cite: 27]
            $table->text('admin_note')->nullable(); // Ghi chú của quản trị viên (nullable) [cite: 27]
            $table->timestamp('ordered_at')->useCurrent(); // Thời gian đặt hàng (mặc định: current timestamp) [cite: 27]
            $table->timestamp('delivered_at')->nullable(); // Thời gian giao hàng thành công (nullable) [cite: 27]
            $table->timestamp('cancelled_at')->nullable(); // Thời gian hủy đơn (nullable) [cite: 27]
            $table->text('cancellation_reason')->nullable(); // Lý do hủy đơn (nullable) [cite: 27]
            $table->timestamps(); // Thời gian tạo và cập nhật [cite: 27]
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};