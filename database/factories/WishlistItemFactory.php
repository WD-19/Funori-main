<?php

namespace Database\Factories;

use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class WishlistItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'wishlist_id' => Wishlist::factory(),
            'product_id' => Product::factory(),
            'created_at' => $this->faker->dateTimeBetween('-6 months', 'now'),
        ];
    }
}