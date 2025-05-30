<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // Import User model

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Gọi các Seeder khác theo thứ tự phụ thuộc
        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            BrandSeeder::class, // Nên chạy Brands trước Products
            ProductSeeder::class, // Products cần Categories và Brands
            AttributeSeeder::class, // Attributes và Values cần ProductVariants
            PaymentMethodSeeder::class,
            ShippingMethodSeeder::class,
            OrderSeeder::class, // Orders cần Users, PaymentMethods, ShippingMethods
            OtherDataSeeder::class, // Các dữ liệu còn lại
        ]);
    }
}