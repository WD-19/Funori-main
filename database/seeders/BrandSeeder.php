<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;
use Illuminate\Support\Str;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $thuongHieu = [
            'Nội thất Hòa Phát', 'Nội thất Xuân Hòa', 'Nội thất Funi', 'Nội thất An Cường', 'Nội thất Gỗ Việt',
            'Nội thất Phúc Long', 'Nội thất Minh Khôi', 'Nội thất Nhà Xinh', 'Nội thất Phố Xinh', 'Nội thất Vina'
        ];
        foreach ($thuongHieu as $ten) {
            Brand::create([
                'name' => $ten,
                'slug' => Str::slug($ten),
            ]);
        }
    }
}