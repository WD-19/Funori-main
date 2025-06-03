<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PromotionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $discountType = $this->faker->randomElement(['percentage', 'fixed_amount']);
        $discountValue = ($discountType == 'percentage') ? $this->faker->numberBetween(5, 50) : $this->faker->randomFloat(2, 10000, 500000);
        $maxDiscountAmount = ($discountType == 'percentage') ? $this->faker->randomFloat(2, 50000, 1000000) : null;
        $minOrderValue = $this->faker->boolean(50) ? $this->faker->randomFloat(2, 200000, 2000000) : null;
        $startDate = $this->faker->dateTimeBetween('-3 months', '+1 month');
        $endDate = $this->faker->boolean(70) ? $this->faker->dateTimeBetween($startDate, '+6 months') : null;

        $name = $this->faker->words(3, true) . ' Discount';
        $code = $this->faker->boolean(80) ? strtoupper(Str::random(8)) : null;

        return [
            'name' => $name,
            'code' => $code,
            'description' => $this->faker->sentence(),
            'discount_type' => $discountType,
            'discount_value' => $discountValue,
            'max_discount_amount' => $maxDiscountAmount,
            'min_order_value' => $minOrderValue,
            'usage_limit_per_voucher' => $this->faker->boolean(50) ? $this->faker->numberBetween(10, 500) : null,
            'usage_limit_per_user' => $this->faker->boolean(50) ? $this->faker->numberBetween(1, 5) : null,
            'times_used' => $this->faker->numberBetween(0, 100),
            'start_date' => $startDate,
            'end_date' => $endDate,
            'is_active' => $this->faker->boolean(90),
            'applies_to' => $this->faker->randomElement(['all_products', 'specific_products', 'specific_categories']),
            'created_at' => $this->faker->dateTimeBetween('-6 months', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-6 months', 'now'),
        ];
    }
}