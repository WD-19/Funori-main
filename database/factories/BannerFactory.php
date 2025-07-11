<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BannerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDate = $this->faker->dateTimeBetween('-3 months', 'now');
        $endDate = $this->faker->boolean(70) ? $this->faker->dateTimeBetween($startDate, '+3 months') : null;

        return [
            'title' => $this->faker->sentence(4),
            'image_url' => $this->faker->imageUrl(1200, 400, 'abstract', true),
            'link_url' => $this->faker->boolean(70) ? $this->faker->url() : null,
            'description' => $this->faker->boolean(80) ? $this->faker->sentence(10) : null,
            'position' => $this->faker->randomElement(['homepage_slider', 'sidebar', 'product_page_banner']),
            'order' => $this->faker->numberBetween(1, 10),
            'start_date' => $startDate,
            'end_date' => $endDate,
            'is_active' => $this->faker->boolean(90),
            'created_at' => $this->faker->dateTimeBetween('-6 months', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-6 months', 'now'),
        ];
    }
}