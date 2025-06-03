<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductVariant;
use App\Models\AttributeValue;
use App\Models\ProductVariantAttributeValue;

class ProductVariantAttributeValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $variants = ProductVariant::all();
        $attributeValues = AttributeValue::all();

        foreach ($variants as $variant) {
            // Gán 1-2 giá trị thuộc tính ngẫu nhiên cho mỗi biến thể
            $values = $attributeValues->random(rand(1, 2));
            foreach ($values as $value) {
                // Tránh trùng lặp
                ProductVariantAttributeValue::firstOrCreate([
                    'product_variant_id' => $variant->id,
                    'attribute_value_id' => $value->id,
                ]);
            }
        }
    }
}