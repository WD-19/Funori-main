<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Banner;
use App\Models\Page;
use App\Models\ContactSubmission;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\WishlistItem;
use App\Models\Promotion;
use App\Models\Category;
use App\Models\Product;

class OtherDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tạo 10 banner
        Banner::factory(10)->create();
        // Tạo 15 trang/bài blog
        Page::factory(15)->create();
        // Tạo 20 liên hệ
        ContactSubmission::factory(20)->create();

        // Liên kết promotions với sản phẩm và danh mục cụ thể (nếu có)
        Promotion::all()->each(function ($promotion) {
            if ($promotion->applies_to === 'specific_products') {
                $products = Product::inRandomOrder()->take(rand(3, 10))->get();
                $promotion->products()->attach($products->pluck('id'));
            } elseif ($promotion->applies_to === 'specific_categories') {
                $categories = Category::inRandomOrder()->take(rand(2, 5))->get();
                $promotion->categories()->attach($categories->pluck('id'));
            }
        });

        // Seed demo banners nếu chưa có
        if (Banner::count() == 0) {
            Banner::insert([
                [
                    'title' => 'Banner Trang Chủ',
                    'image_url' => 'banners/demo1.jpg',
                    'link' => 'https://example.com',
                    'position' => 'main',
                    'order' => 1,
                    'start_at' => now()->subDays(10),
                    'end_at' => now()->addDays(20),
                    'is_active' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'title' => 'Banner Sidebar',
                    'image_url' => 'banners/demo2.jpg',
                    'link' => 'https://example.com/sidebar',
                    'position' => 'sidebar',
                    'order' => 2,
                    'start_at' => now()->subDays(5),
                    'end_at' => now()->addDays(10),
                    'is_active' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'title' => 'Banner Sự kiện',
                    'image_url' => 'banners/demo3.jpg',
                    'link' => null,
                    'position' => 'main',
                    'order' => 3,
                    'start_at' => now(),
                    'end_at' => now()->addDays(30),
                    'is_active' => 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        }
    }
}