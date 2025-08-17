<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\Shipper;
use Carbon\Carbon;

class OrderTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Lấy shipper test
        $shipper = Shipper::where('email', 'shipper@example.com')->first();
        
        if (!$shipper) {
            $this->command->error('Shipper test không tồn tại. Vui lòng chạy ShipperTestSeeder trước.');
            return;
        }

        // Tạo đơn hàng mẫu trực tiếp
        $orders = [
            [
                'order_code' => 'ORD001',
                'user_id' => 1, // Giả sử user_id = 1
                'shipper_id' => $shipper->id,
                'order_status' => 'pending_confirmation',
                'total_amount' => 150000,
                'shipping_address' => '123 Đường Test, Quận 1, TP.HCM',
                'customer_name' => 'Nguyễn Văn A',
                'customer_email' => 'nguyenvana@example.com',
                'customer_phone' => '0123456789',
                'payment_method_id' => 1,
                'payment_status' => 'paid',
                'shipping_method_id' => 1,
                'created_at' => Carbon::now()->subDays(2)
            ],
            [
                'order_code' => 'ORD002',
                'user_id' => 1,
                'shipper_id' => $shipper->id,
                'order_status' => 'processing',
                'total_amount' => 250000,
                'shipping_address' => '456 Đường Test, Quận 2, TP.HCM',
                'customer_name' => 'Trần Thị B',
                'customer_email' => 'tranthib@example.com',
                'customer_phone' => '0987654321',
                'payment_method_id' => 1,
                'payment_status' => 'paid',
                'created_at' => Carbon::now()->subDays(1)
            ],
            [
                'order_code' => 'ORD003',
                'user_id' => 1,
                'shipper_id' => $shipper->id,
                'order_status' => 'shipped',
                'total_amount' => 180000,
                'shipping_address' => '789 Đường Test, Quận 3, TP.HCM',
                'customer_name' => 'Lê Văn C',
                'customer_email' => 'levanc@example.com',
                'customer_phone' => '0555666777',
                'payment_method_id' => 1,
                'payment_status' => 'paid',
                'created_at' => Carbon::now()
            ]
        ];

        foreach ($orders as $orderData) {
            Order::firstOrCreate(
                ['order_code' => $orderData['order_code']],
                $orderData
            );
        }

        $this->command->info('Đã tạo ' . count($orders) . ' đơn hàng mẫu cho shipper test.');
    }
}
