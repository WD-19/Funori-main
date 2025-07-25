<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PaymentMethod;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $methods = [
            ['name' => 'Thanh toán khi nhận hàng', 'code' => 'cod', 'description' => 'Thanh toán trực tiếp khi nhận hàng'],
            ['name' => 'Chuyển khoản ngân hàng', 'code' => 'bank', 'description' => 'Chuyển khoản qua tài khoản ngân hàng'],
            ['name' => 'VNPAY', 'code' => 'vnpay', 'description' => 'VNPAY'],
            ['name' => 'MOMO', 'code' => 'vnpay', 'description' => 'MOMO'],
        ];
        foreach ($methods as $m) {
            PaymentMethod::create($m);
        }
    }
}