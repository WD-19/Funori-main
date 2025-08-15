<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Shipper;
use Illuminate\Support\Facades\Hash;

class ShipperTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create test shipper
        Shipper::updateOrCreate(
            ['email' => 'shipper@example.com'],
            [
                'name' => 'Test Shipper',
                'email' => 'shipper@example.com',
                'password' => Hash::make('password123'),
                'phone' => '0123456789',
                'address' => '123 Test Street, Ho Chi Minh City',
                'status' => 'active',
                'is_online' => false,
                'current_lat' => 10.8231,
                'current_lng' => 106.6297,
                'current_address' => 'Ho Chi Minh City, Vietnam',
                'accuracy' => 10.0,
                'location_updated_at' => now(),
            ]
        );

        $this->command->info('Test shipper created successfully!');
        $this->command->info('Email: shipper@example.com');
        $this->command->info('Password: password123');
    }
}
