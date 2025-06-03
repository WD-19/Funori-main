<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->unique()->word() . ' Category';
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'parent_id' => null, // Sẽ được xử lý trong Seeder để tạo cây danh mục
            'description' => $this->faker->sentence(),
            'image_url' => $this->faker->imageUrl(640, 480, 'furniture', true),
            'is_active' => $this->faker->boolean(90),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}