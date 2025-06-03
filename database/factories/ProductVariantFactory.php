<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductVariantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => Product::factory(),
            'price_modifier' => $this->faker->numberBetween(-50, 100), // Chênh lệch giá
            'stock_quantity' => $this->faker->numberBetween(0, 100),
            'image_id' => ProductImage::factory(), // Có thể là ảnh riêng cho variant
            'created_at' => $this->faker->dateTimeBetween('-6 months', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-6 months', 'now'),
        ];
    }
}