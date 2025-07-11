<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'receiver_name' => $this->faker->name(),
            'receiver_phone' => $this->faker->phoneNumber(),
            'street_address' => $this->faker->address(),
            'address_type' => $this->faker->randomElement(['home', 'work', null]),
            'is_default' => $this->faker->boolean(20), // 20% là mặc định
            'created_at' => $this->faker->dateTimeBetween('-6 months', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-6 months', 'now'),
        ];
    }
}