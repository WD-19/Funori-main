<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Promotion;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Review;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Order::factory(20)->create()->each(function ($order) {
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
            if (rand(0, 1)) { // 50% cơ hội áp dụng khuyến mãi
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

                    // Đảm bảo discount không lớn hơn subtotal
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
        });
    }
}