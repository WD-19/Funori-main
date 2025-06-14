<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ShippingMethod;

class ShippingMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $methods = [
            ['name' => 'Giao hàng tiêu chuẩn', 'description' => 'Giao hàng trong 3-5 ngày làm việc', 'cost' => 30000],
            ['name' => 'Giao hàng nhanh', 'description' => 'Giao hàng trong 24h', 'cost' => 60000],
            ['name' => 'Nhận tại cửa hàng', 'description' => 'Nhận hàng trực tiếp tại cửa hàng', 'cost' => 0],
        ];
        foreach ($methods as $m) {
            ShippingMethod::create($m);
        }
    }
}