<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->unique()->sentence(5);
        $pageType = $this->faker->randomElement(['page', 'blog_post']);
        $status = $this->faker->randomElement(['published', 'draft']);
        $publishedAt = ($status == 'published') ? $this->faker->dateTimeBetween('-1 year', 'now') : null;

        return [
            'title' => $title,
            'slug' => Str::slug($title) . '-' . Str::random(5),
            'content' => $this->faker->paragraphs(5, true),
            'author_id' => $this->faker->boolean(70) ? (User::inRandomOrder()->first()->id ?? User::factory()) : null,
            'page_type' => $pageType,
            'status' => $status,
            'meta_title' => $this->faker->boolean(70) ? $this->faker->sentence(7) : null,
            'meta_description' => $this->faker->boolean(70) ? $this->faker->paragraph(2) : null,
            'featured_image_url' => ($pageType == 'blog_post' && $this->faker->boolean(70)) ? $this->faker->imageUrl(800, 400, 'text', true) : null,
            'published_at' => $publishedAt,
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}