<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Shipper;
use Illuminate\Support\Facades\Hash;

class ShipperSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        // Xóa dữ liệu cũ nếu có (không truncate vì có foreign key)
        Shipper::query()->delete();

        // Tạo shipper demo
        $shippers = [
            [
                'name' => 'Nguyễn Văn Shipper',
                'email' => 'shipper@demo.com',
                'password' => Hash::make('123456'),
                'phone' => '0901234567',
                'address' => 'Hà Nội, Việt Nam',
                'status' => 'active',
            ],
            [
                'name' => 'Trần Thị Giao Hàng',
                'email' => 'shipper2@demo.com',
                'password' => Hash::make('123456'),
                'phone' => '0987654321',
                'address' => 'TP. Hồ Chí Minh, Việt Nam',
                'status' => 'active',
            ],
            [
                'name' => 'Lê Văn Nhanh',
                'email' => 'shipper3@demo.com',
                'password' => Hash::make('123456'),
                'phone' => '0912345678',
                'address' => 'Đà Nẵng, Việt Nam',
                'status' => 'active',
            ]
        ];

        foreach ($shippers as $shipperData) {
            Shipper::create($shipperData);
        }

        $this->command->info('✅ Đã tạo ' . count($shippers) . ' shipper demo');
        $this->command->info('📧 Email: shipper@demo.com, shipper2@demo.com, shipper3@demo.com');
        $this->command->info('🔑 Password: 123456');
    }
}