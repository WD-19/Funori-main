<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Attribute;
use App\Models\AttributeValue;
use Illuminate\Support\Facades\DB;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        // Màu sắc
        $colorAttr = Attribute::factory()->create(['name' => 'Color']);
        AttributeValue::factory()->count(5)->create(['attribute_id' => $colorAttr->id])->each(function ($value) use ($faker) {
            $value->update(['value' => $faker->colorName()]);
        });

        // Kích thước
        $sizeAttr = Attribute::factory()->create(['name' => 'Size']);
        AttributeValue::factory()->count(5)->create(['attribute_id' => $sizeAttr->id])->each(function ($value) use ($faker) {
            $value->update(['value' => $faker->randomElement(['Small', 'Medium', 'Large', 'XL', 'XXL'])]);
        });

        // Chất liệu
        $materialAttr = Attribute::factory()->create(['name' => 'Material']);
        AttributeValue::factory()->count(5)->create(['attribute_id' => $materialAttr->id])->each(function ($value) use ($faker) {
            $value->update(['value' => $faker->randomElement(['Wood', 'Metal', 'Leather', 'Fabric', 'Plastic'])]);
        });
    }
}