<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderItemFactory extends Factory
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
        $quantity = $this->faker->numberBetween(1, 3);
        $price = $product->regular_price + ($variant ? $variant->price_modifier : 0);
        $subtotal = $price * $quantity;

        $variantAttributes = null;
        if ($variant) {
            $attributes = [];
            foreach ($variant->attributeValues as $attrValue) {
                $attributes[$attrValue->attribute->name] = $attrValue->value;
            }
            $variantAttributes = $attributes;
        }

        return [
            'order_id' => Order::factory(),
            'product_id' => $product->id,
            'product_variant_id' => $variant ? $variant->id : null,
            'product_name' => $product->name,
            'variant_attributes' => $variantAttributes,
            'quantity' => $quantity,
            'subtotal' => $subtotal,
            'created_at' => $this->faker->dateTimeBetween('-5 months', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-5 months', 'now'),
        ];
    }
}