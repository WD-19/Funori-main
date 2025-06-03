<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Address; // Import Address model
use App\Models\Wishlist; // Import Wishlist model

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tạo một admin user cụ thể
        User::factory()->create([
            'full_name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'account_status' => 'active',
        ]);

        // Tạo 10 user thông thường
        User::factory(10)->create()->each(function ($user) {
            // Mỗi user có 1-3 địa chỉ
            Address::factory(rand(1, 3))->create(['user_id' => $user->id]);

            // Mỗi user có 1 wishlist
            Wishlist::factory()->create(['user_id' => $user->id]);
        });
    }
}