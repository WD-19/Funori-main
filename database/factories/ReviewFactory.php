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
        $orderItem = OrderItem::inRandomOrder()->first() ?? OrderItem::factory()->create();

        // Random user từ bảng user thay vì lấy từ order
        $user = User::inRandomOrder()->first() ?? User::factory()->create();

        return [
            'user_id' => $user->id,
            'product_id' => $orderItem->product_id,
            'order_item_id' => $orderItem->id,
            'rating' => $this->faker->numberBetween(1, 5),
            'comment' => $this->faker->boolean(80) ? $this->faker->paragraph() : null,
            'status' => $this->faker->randomElement(['pending', 'approved', 'rejected']),
            'admin_reply' => $this->faker->boolean(40) ? $this->faker->sentence() : null,
            'admin_reply_created_at' => function (array $attributes) {
                return $attributes['admin_reply'] ? now()->subDays(rand(0, 10)) : null;
            },
            'created_at' => $this->faker->dateTimeBetween($orderItem->created_at, 'now'),
            'updated_at' => $this->faker->dateTimeBetween($orderItem->created_at, 'now'),
        ];
    }
}
