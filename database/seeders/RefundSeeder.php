<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Refund;
use App\Models\Order;
use App\Models\User;

class RefundSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Lấy user đầu tiên
        $user = User::first();
        if (!$user) {
            $this->command->error('Không tìm thấy user nào. Vui lòng chạy UserSeeder trước.');
            return;
        }

        // Lấy đơn hàng đầu tiên của user
        $order = $user->orders()->first();
        if (!$order) {
            $this->command->error('Không tìm thấy đơn hàng nào. Vui lòng tạo đơn hàng trước.');
            return;
        }

        // Tạo refund mẫu - Pending
        Refund::create([
            'order_id' => $order->id,
            'gateway' => 'vnpay',
            'amount' => $order->total_amount,
            'status' => 'pending',
            'transaction_id' => 'VNPAY_' . time() . '_001',
            'refund_transaction_id' => null,
            'gateway_response' => [
                'reason' => 'Test refund pending',
                'request_time' => now()->toISOString()
            ],
            'error_message' => null,
            'refunded_at' => null,
        ]);

        // Tạo refund mẫu - Success
        Refund::create([
            'order_id' => $order->id,
            'gateway' => 'momo',
            'amount' => $order->total_amount,
            'status' => 'success',
            'transaction_id' => 'MOMO_' . time() . '_002',
            'refund_transaction_id' => 'REF_' . time() . '_SUCCESS',
            'gateway_response' => [
                'reason' => 'Test refund success',
                'resultCode' => 0,
                'message' => 'Success'
            ],
            'error_message' => null,
            'refunded_at' => now()->subHours(2),
        ]);

        // Tạo refund mẫu - Failed
        Refund::create([
            'order_id' => $order->id,
            'gateway' => 'vnpay',
            'amount' => $order->total_amount,
            'status' => 'failed',
            'transaction_id' => 'VNPAY_' . time() . '_003',
            'refund_transaction_id' => null,
            'gateway_response' => [
                'reason' => 'Test refund failed',
                'vnp_ResponseCode' => '99',
                'vnp_Message' => 'Invalid signature'
            ],
            'error_message' => 'Chữ ký không hợp lệ',
            'refunded_at' => null,
        ]);

        $this->command->info('Đã tạo 3 refund mẫu cho testing!');
        $this->command->info('Order ID: ' . $order->id);
        $this->command->info('User ID: ' . $user->id);
    }
}
