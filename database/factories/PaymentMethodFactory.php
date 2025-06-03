<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PaymentMethodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->unique()->randomElement(['Cash On Delivery', 'Bank Transfer', 'Credit Card', 'VNPay', 'ZaloPay']);
        return [
            'name' => $name,
            'code' => Str::slug($name, '_'),
            'description' => $this->faker->sentence(),
            'instructions' => $this->faker->boolean(50) ? $this->faker->paragraph() : null,
            'is_active' => $this->faker->boolean(90),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}