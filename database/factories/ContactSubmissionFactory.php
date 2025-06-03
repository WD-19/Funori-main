<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactSubmissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = $this->faker->randomElement(['new', 'read', 'replied', 'resolved']);
        $adminReply = null;
        $repliedBy = null;

        if (in_array($status, ['replied', 'resolved'])) {
            $adminReply = $this->faker->paragraph();
            $repliedBy = User::where('role', 'admin')->inRandomOrder()->first()->id ?? User::factory(['role' => 'admin'])->create()->id;
        }

        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->boolean(80) ? $this->faker->phoneNumber() : null,
            'subject' => $this->faker->sentence(5),
            'message' => $this->faker->paragraph(3),
            'status' => $status,
            'admin_reply' => $adminReply,
            'replied_by' => $repliedBy,
            'created_at' => $this->faker->dateTimeBetween('-6 months', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-6 months', 'now'),
        ];
    }
}