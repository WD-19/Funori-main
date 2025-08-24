<?php

namespace Database\Factories;

use App\Models\Review;
use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    protected $model = Review::class;

    public function definition(): array
    {
        // Lấy ngẫu nhiên 1 order_item có product_id và user_id phù hợp
        $orderItem = \App\Models\OrderItem::inRandomOrder()->first();
        return [
            'user_id' => $orderItem ? $orderItem->order->user_id : User::inRandomOrder()->first()?->id ?? 1,
            'product_id' => $orderItem ? $orderItem->product_id : Product::inRandomOrder()->first()?->id ?? 1,
            'order_item_id' => $orderItem ? $orderItem->id : 1,
            'rating' => $this->faker->numberBetween(1, 5),
            'comment' => $this->faker->sentence(10),
            'status' => $this->faker->randomElement(['pending', 'approved', 'rejected']),
            'admin_reply' => null,
            'admin_reply_created_at' => null,
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
