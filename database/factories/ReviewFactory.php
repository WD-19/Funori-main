<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Đảm bảo order_item_id liên quan đến một user và product hợp lệ
        $orderItem = OrderItem::inRandomOrder()->first() ?? OrderItem::factory()->create();

        return [
            'user_id' => $orderItem->order->user_id ?? User::factory(), // Lấy user từ order_item hoặc tạo mới
            'product_id' => $orderItem->product_id,
            'order_item_id' => $orderItem->id,
            'rating' => $this->faker->numberBetween(1, 5),
            'comment' => $this->faker->boolean(80) ? $this->faker->paragraph() : null,
            'status' => $this->faker->randomElement(['pending', 'approved', 'rejected']),
            'created_at' => $this->faker->dateTimeBetween($orderItem->created_at, 'now'),
            'updated_at' => $this->faker->dateTimeBetween($orderItem->created_at, 'now'),
        ];
    }
}