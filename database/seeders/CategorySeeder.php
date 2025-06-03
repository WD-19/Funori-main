<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tạo một số danh mục gốc
        $rootCategories = Category::factory(5)->create(['parent_id' => null]);

        // Tạo danh mục con cho mỗi danh mục gốc
        $rootCategories->each(function ($rootCategory) {
            Category::factory(rand(2, 4))->create(['parent_id' => $rootCategory->id])->each(function ($childCategory) {
                // Tạo danh mục cháu cho một số danh mục con
                if (rand(0, 1)) { // 50% cơ hội có danh mục cháu
                    Category::factory(rand(1, 2))->create(['parent_id' => $childCategory->id]);
                }
            });
        });
    }
}