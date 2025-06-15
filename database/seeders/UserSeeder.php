<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Address;
use App\Models\Wishlist;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create('vi_VN');

        // Admin
        User::create([
            'full_name' => 'Quản trị viên',
            'email' => 'admin@noithat.vn',
            'password' => bcrypt('matkhau123'),
            'role' => 'admin',
            'account_status' => 'active',
        ]);

        // Người dùng thường
        for ($i = 1; $i <= 10; $i++) {
            $user = User::create([
                'full_name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => bcrypt('12345678'),
                'role' => 'user',
                'account_status' => 'active',
            ]);
            Address::create([
                'user_id' => $user->id,
                'receiver_name' => $user->full_name,
                'receiver_phone' => '09' . rand(10000000, 99999999),
                'street_address' => $faker->streetAddress,
                'is_default' => true,
            ]);
            Wishlist::create(['user_id' => $user->id]);
        }
    }
}