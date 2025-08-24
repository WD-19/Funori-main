<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Review;
use App\Models\Product;

class UserAndReviewSeeder extends Seeder
{
    public function run(): void
    {
        // Tạo 40 user mẫu rải đều trong 1 năm
        $faker = \Faker\Factory::create();
        $users = collect();
        for ($i = 0; $i < 40; $i++) {
            $createdAt = $faker->dateTimeBetween('-1 year', 'now');
            $user = User::factory()->create([
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ]);
            $users->push($user);
        }

        // Đảm bảo có sản phẩm để đánh giá
        $products = Product::all();
        if ($products->count() === 0) {
            $products = Product::factory(10)->create();
        }

        // Tạo 200 đánh giá ngẫu nhiên trong 1 năm
        Review::factory(200)->create();
    }
}
