<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Attribute;
use App\Models\AttributeValue;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Chất liệu
        $material = Attribute::create(['name' => 'Chất liệu']);
        foreach (['Gỗ', 'Kim loại', 'Da', 'Vải', 'Nhựa'] as $cl) {
            AttributeValue::create(['attribute_id' => $material->id, 'value' => $cl]);
        }
    }
}