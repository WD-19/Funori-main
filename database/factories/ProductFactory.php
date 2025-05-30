<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->unique()->words(3, true) . ' ' . $this->faker->randomElement(['Chair', 'Table', 'Sofa', 'Bed', 'Cabinet']);
        return [
            'name' => $name,
            'slug' => Str::slug($name) . '-' . Str::random(5), // Thêm random để đảm bảo unique
            'short_description' => $this->faker->sentence(10),
            'description' => $this->faker->paragraphs(3, true),
            'regular_price' => $this->faker->randomFloat(2, 50, 5000),
            'stock_quantity' => $this->faker->numberBetween(0, 200),
            'category_id' => Category::factory(),
            'brand_id' => Brand::factory(),
            'status' => $this->faker->randomElement(['published', 'draft', 'archived', 'out_of_stock']),
            'is_featured' => $this->faker->boolean(30),
            'view_count' => $this->faker->numberBetween(0, 10000),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}