<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'full_name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => bcrypt('password'),
            'phone_number' => $this->faker->phoneNumber(),
            'avatar_url' => $this->faker->imageUrl(200, 200, 'people'),
            'account_status' => $this->faker->randomElement(['active', 'inactive', 'banned']),
            'role' => $this->faker->randomElement(['user', 'admin']),
            'remember_token' => Str::random(10),
            'google_id' => null,
        ];
    }
}
