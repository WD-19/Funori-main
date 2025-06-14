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
        // Màu sắc
        $color = Attribute::create(['name' => 'Màu sắc']);
        foreach (['Đỏ', 'Xanh', 'Vàng', 'Nâu', 'Trắng', 'Đen'] as $mau) {
            AttributeValue::create(['attribute_id' => $color->id, 'value' => $mau]);
        }

        // Kích thước
        $size = Attribute::create(['name' => 'Kích thước']);
        foreach (['Nhỏ', 'Vừa', 'Lớn', 'Siêu lớn'] as $kt) {
            AttributeValue::create(['attribute_id' => $size->id, 'value' => $kt]);
        }

        // Chất liệu
        $material = Attribute::create(['name' => 'Chất liệu']);
        foreach (['Gỗ', 'Kim loại', 'Da', 'Vải', 'Nhựa'] as $cl) {
            AttributeValue::create(['attribute_id' => $material->id, 'value' => $cl]);
        }
    }
}