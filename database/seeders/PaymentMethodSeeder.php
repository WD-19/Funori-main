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
            ['name' => 'Thanh toán qua Momo', 'code' => 'momo', 'description' => 'Thanh toán bằng ví điện tử Momo'],
        ];
        foreach ($methods as $m) {
            PaymentMethod::create($m);
        }
    }
}