<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create('vi_VN');
        $categories = Category::all();
        $brands = Brand::all();

        $sanPham = [
            ['name' => 'Sofa góc L cao cấp', 'desc' => 'Sofa góc L bọc da nhập khẩu, khung gỗ tự nhiên, bảo hành 5 năm.'],
            ['name' => 'Bàn trà mặt kính', 'desc' => 'Bàn trà mặt kính cường lực, chân inox sáng bóng, thiết kế hiện đại.'],
            ['name' => 'Tủ quần áo 3 cánh', 'desc' => 'Tủ quần áo gỗ công nghiệp, 3 cánh mở rộng rãi, màu trắng trang nhã.'],
            ['name' => 'Giường ngủ bọc nệm', 'desc' => 'Giường ngủ bọc nệm cao cấp, khung thép chắc chắn, phù hợp mọi không gian.'],
            ['name' => 'Kệ tivi treo tường', 'desc' => 'Kệ tivi treo tường tiết kiệm diện tích, màu gỗ tự nhiên.'],
        ];

        foreach ($sanPham as $sp) {
            $product = Product::create([
                'name' => $sp['name'],
                'slug' => Str::slug($sp['name']),
                'description' => $sp['desc'],
                'regular_price' => rand(3000000, 15000000),
                'category_id' => $categories->random()->id,
                'brand_id' => $brands->random()->id,
                'status' => 'published',
            ]);
            // Ảnh sản phẩm
            ProductImage::create([
                'product_id' => $product->id,
                'image_url' => 'images/products/demo.jpg',
                'is_thumbnail' => true,
                'order' => 1, 
            ]);
            // Biến thể
            ProductVariant::create([
                'product_id' => $product->id,
                'size' => $faker->randomElement(['Nhỏ', 'Vừa', 'Lớn']),
                'price_modifier' => 0,
                'stock_quantity' => rand(5, 20),
            ]);
        }
    }
}