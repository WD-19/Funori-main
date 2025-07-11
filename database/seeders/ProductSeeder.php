<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create('vi_VN');
        $categories = Category::all();
        $brands = Brand::all();

        $sanPham = [
            ['name' => 'Sofa góc L cao cấp', 'desc' => 'Sofa góc L bọc da nhập khẩu, khung gỗ tự nhiên, bảo hành 5 năm.'],
            ['name' => 'Bàn trà mặt kính', 'desc' => 'Bàn trà mặt kính cường lực, chân inox sáng bóng, thiết kế hiện đại.'],
            ['name' => 'Tủ quần áo 3 cánh', 'desc' => 'Tủ quần áo gỗ công nghiệp, 3 cánh mở rộng rãi, màu trắng trang nhã.'],
            ['name' => 'Giường ngủ bọc nệm', 'desc' => 'Giường ngủ bọc nệm cao cấp, khung thép chắc chắn, phù hợp mọi không gian.'],
            ['name' => 'Kệ tivi treo tường', 'desc' => 'Kệ tivi treo tường tiết kiệm diện tích, màu gỗ tự nhiên.'],
            ['name' => 'Bàn ăn 6 ghế', 'desc' => 'Bàn ăn gỗ sồi, 6 ghế bọc nệm, thiết kế sang trọng.'],
            ['name' => 'Tủ giày thông minh', 'desc' => 'Tủ giày đa năng, tiết kiệm diện tích, phù hợp căn hộ nhỏ.'],
            ['name' => 'Bàn làm việc hiện đại', 'desc' => 'Bàn làm việc chân sắt, mặt gỗ MDF chống ẩm, có ngăn kéo.'],
            ['name' => 'Ghế thư giãn bập bênh', 'desc' => 'Ghế bập bênh khung gỗ, đệm vải êm ái, phù hợp phòng khách.'],
            ['name' => 'Tủ sách 5 tầng', 'desc' => 'Tủ sách gỗ tự nhiên, 5 tầng, thiết kế tối giản.'],
            ['name' => 'Bàn trang điểm gương tròn', 'desc' => 'Bàn trang điểm nhỏ gọn, gương tròn, có ngăn kéo tiện lợi.'],
            ['name' => 'Ghế ăn bọc nệm', 'desc' => 'Ghế ăn chân gỗ, bọc nệm vải cao cấp, màu sắc trẻ trung.'],
            ['name' => 'Tủ đầu giường 2 ngăn', 'desc' => 'Tủ đầu giường nhỏ, 2 ngăn kéo, màu trắng hiện đại.'],
            ['name' => 'Giường tầng trẻ em', 'desc' => 'Giường tầng gỗ thông, an toàn cho trẻ, có cầu thang tiện lợi.'],
            ['name' => 'Bàn học sinh liền giá sách', 'desc' => 'Bàn học sinh gỗ công nghiệp, liền giá sách, màu pastel.'],
            ['name' => 'Ghế sofa đơn', 'desc' => 'Sofa đơn nhỏ gọn, phù hợp phòng ngủ hoặc phòng đọc sách.'],
            ['name' => 'Tủ rượu kính', 'desc' => 'Tủ rượu khung gỗ, cửa kính cường lực, sang trọng.'],
            ['name' => 'Bàn console hành lang', 'desc' => 'Bàn console gỗ tự nhiên, thiết kế thanh mảnh cho hành lang.'],
            ['name' => 'Kệ treo tường trang trí', 'desc' => 'Kệ treo tường gỗ, trang trí phòng khách hoặc phòng ngủ.'],
            ['name' => 'Ghế bar chân cao', 'desc' => 'Ghế bar chân sắt, mặt gỗ, phù hợp quầy bếp hoặc quán cafe.'],
        ];

        foreach ($sanPham as $sp) {
            $product = Product::create([
                'name' => $sp['name'],
                'slug' => Str::slug($sp['name']),
                'description' => $sp['desc'],
                'regular_price' => rand(3000000, 15000000),
                'category_id' => $categories->random()->id,
                'brand_id' => $brands->random()->id,
                'status' => 'published',
            ]);
            // Ảnh sản phẩm
            ProductImage::create([
                'product_id' => $product->id,
                'image_url' => 'images/products/demo.jpg',
                'is_thumbnail' => true,
                'order' => 1,
            ]);
            // Biến thể
            ProductVariant::create([
                'product_id' => $product->id,
                'name_variant' => $faker->randomElement(['Màu đỏ', 'Màu xanh', 'Màu vàng', 'Màu đen']),
                'size' => $faker->randomElement(['Nhỏ', 'Vừa', 'Lớn']),
                'price_modifier' => 0,
                'stock_quantity' => rand(5, 20),
            ]);
        }
    }
}
