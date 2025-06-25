<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Promotion;
use App\Models\Cart;
use App\Models\Review;
use Faker\Factory;
use Illuminate\Support\Str;


class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('vi_VN');
        for ($i = 0; $i < 20; $i++) {
            $order = Order::create([
                'user_id'           => 1, // hoặc random user_id nếu muốn
                'order_code'        => 'ORD-' . strtoupper(Str::random(8)),
                'customer_name'     => $faker->name(),
                'customer_email'    => $faker->unique()->safeEmail(),
                'customer_phone'    => '09' . rand(10000000, 99999999),
                'shipping_address'  => $faker->address(),
                'subtotal_amount'   => $faker->randomFloat(2, 100, 500),
                'shipping_fee'      => 0,
                'discount_amount'   => $faker->randomFloat(2, 0, 50),
                'tax_amount'        => $faker->randomFloat(4, 0, 20),
                'total_amount'      => $faker->randomFloat(4, 100, 600),
                'payment_method_id' => 1,
                'payment_status'    => 'paid',
                'shipping_method_id'=> 1,
                'order_status'      => 'delivered',
                'customer_note'     => $faker->sentence(),
                'admin_note'        => $faker->sentence(),
                'ordered_at'        => $faker->dateTimeBetween('-6 months', 'now'),
                'delivered_at'      => $faker->dateTimeBetween('-5 months', 'now'),
                'cancelled_at'      => null,
                'cancellation_reason' => null,
            ]);
            // Mỗi đơn hàng có 1-5 sản phẩm
            $products = Product::inRandomOrder()->take(rand(1, 5))->get();
            $totalAmount = 0;
            $discountApplied = 0;

            foreach ($products as $product) {
                $variant = $product->variants()->inRandomOrder()->first();
                $quantity = rand(1, 3);
                $priceAtPurchase = $product->regular_price + ($variant ? $variant->price_modifier : 0);
                $itemSubtotal = $priceAtPurchase * $quantity;

                $orderItem = OrderItem::factory()->create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'product_variant_id' => $variant ? $variant->id : null,
                    'product_name' => $product->name,
                    'variant_attributes' => $variant ? $variant->attributeValues->mapWithKeys(function($av) {
                        return [$av->attribute->name => $av->value];
                    })->toArray() : null,
                    'quantity' => $quantity,
                    'subtotal' => $itemSubtotal,
                ]);
                $totalAmount += $itemSubtotal;

                // 70% cơ hội tạo review cho order item
                if (rand(0, 9) < 7 && $order->order_status == 'delivered') {
                    Review::factory()->create([
                        'user_id' => $order->user_id,
                        'product_id' => $product->id,
                        'order_item_id' => $orderItem->id,
                    ]);
                }
            }

            // Áp dụng khuyến mãi ngẫu nhiên cho một số đơn hàng
            if (rand(0, 1)) {
                $promotion = Promotion::inRandomOrder()->first();
                if ($promotion) {
                    $actualDiscount = 0;
                    if ($promotion->discount_type == 'percentage') {
                        $actualDiscount = $totalAmount * ($promotion->discount_value / 100);
                        if ($promotion->max_discount_amount && $actualDiscount > $promotion->max_discount_amount) {
                            $actualDiscount = $promotion->max_discount_amount;
                        }
                    } else {
                        $actualDiscount = $promotion->discount_value;
                    }
                    $actualDiscount = min($actualDiscount, $totalAmount);
                    $order->promotions()->attach($promotion->id, ['discount_applied' => $actualDiscount]);
                    $discountApplied = $actualDiscount;
                    $promotion->increment('times_used');
                }
            }

            // Cập nhật tổng tiền và giảm giá sau khi thêm item và khuyến mãi
            $order->subtotal_amount = $totalAmount;
            $order->discount_amount = $discountApplied;
            $order->total_amount = $totalAmount + $order->shipping_fee + $order->tax_amount - $discountApplied;
            $order->save();

            // Xóa giỏ hàng tương ứng (nếu có)
            Cart::where('user_id', $order->user_id)->delete();
        }
    }
}