<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;


class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $danhMuc = [
            'Ghế Sofa', 'Bàn Trà', 'Tủ Quần Áo', 'Giường Ngủ', 'Kệ Tivi'
        ];
        foreach ($danhMuc as $ten) {
            $cat = Category::create([
                'name' => $ten,
                'slug' => Str::slug($ten),
                'parent_id' => null
            ]);
            foreach (['Cao cấp', 'Phổ thông'] as $tenCon) {
                $tenDanhMucCon = $tenCon . ' ' . $ten;
                Category::create([
                    'name' => $tenDanhMucCon,
                    'slug' => Str::slug($tenDanhMucCon),
                    'parent_id' => $cat->id
                ]);
            }
        }
    }
}