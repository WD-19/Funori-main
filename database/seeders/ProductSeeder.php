<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use App\Models\Attribute;
use App\Models\AttributeValue;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();
        $brands = Brand::all();

        if ($categories->isEmpty()) {
            $this->call(CategorySeeder::class);
            $categories = Category::all();
        }
        if ($brands->isEmpty()) {
            $this->call(BrandSeeder::class);
            $brands = Brand::all();
        }

        Product::factory(50)->create([
            'category_id' => $categories->random()->id,
            'brand_id' => $brands->random()->id,
        ])->each(function ($product) {
            // Mỗi sản phẩm có 2-5 ảnh
            ProductImage::factory(rand(2, 5))->create(['product_id' => $product->id])
                ->first()->update(['is_thumbnail' => true]); // Đặt ảnh đầu tiên là thumbnail

            // 70% sản phẩm có biến thể
            if (rand(0, 9) < 7) {
                // Tạo 1-3 biến thể cho mỗi sản phẩm
                ProductVariant::factory(rand(1, 3))->create([
                    'product_id' => $product->id,
                    'image_id' => $product->images()->inRandomOrder()->first()->id ?? null,
                ])->each(function ($variant) {
                    // Liên kết biến thể với các thuộc tính ngẫu nhiên
                    $attributes = Attribute::inRandomOrder()->take(rand(1, 2))->get();
                    foreach ($attributes as $attribute) {
                        $attributeValue = $attribute->values()->inRandomOrder()->first();
                        if (!$attributeValue) {
                            $attributeValue = AttributeValue::factory()->create(['attribute_id' => $attribute->id]);
                        }
                        $variant->attributeValues()->attach($attributeValue->id);
                    }
                });
            }
        });
    }
}