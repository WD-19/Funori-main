<?php

namespace Database\Factories;

use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Database\Eloquent\Factories\Factory;

class CartItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $product = Product::inRandomOrder()->first() ?? Product::factory()->create();
        $variant = $product->variants()->inRandomOrder()->first();

        return [
            'cart_id' => Cart::factory(),
            'product_id' => $product->id,
            'product_variant_id' => $variant ? $variant->id : null,
            'quantity' => $this->faker->numberBetween(1, 5),
            'price_at_addition' => $product->regular_price + ($variant ? $variant->price_modifier : 0),
            'created_at' => $this->faker->dateTimeBetween('-3 months', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-3 months', 'now'),
        ];
    }
}