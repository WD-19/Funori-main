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
        Banner::factory(10)->create(); // Tạo 10 banner
        Page::factory(15)->create(); // Tạo 15 trang/bài blog
        ContactSubmission::factory(20)->create(); // Tạo 20 liên hệ





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
    }
}