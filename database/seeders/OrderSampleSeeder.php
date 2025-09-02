<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\DB;

class OrderSampleSeeder extends Seeder
{
    public function run()
    {
        DB::transaction(function () {
            $userIds = \App\Models\User::pluck('id')->toArray();
            for ($i = 1; $i <= 20; $i++) {
                $product = Product::inRandomOrder()->first();
                if (!$product) continue;
                $variant = ProductVariant::where('product_id', $product->id)->inRandomOrder()->first();
                $price = $variant ? ($variant->price_modifier ?? 0) : ($product->price ?? 0);
                $variantData = $variant ? json_encode([
                    'name_variant' => $variant->name_variant,
                    'size' => $variant->size,
                ]) : null;
                $userId = !empty($userIds) ? $userIds[array_rand($userIds)] : null;
                $order = Order::create([
                    'user_id' => $userId,
                    'order_code' => 'ORD-SAMPLE-' . uniqid(),
                    'ordered_at' => now(),
                    'customer_name' => 'Khách Test ' . $i,
                    'customer_phone' => '09000000' . $i,
                    'customer_email' => 'test' . $i . '@example.com',
                    'buyer_name' => 'Khách Test ' . $i,
                    'buyer_phone' => '09000000' . $i,
                    'buyer_email' => 'test' . $i . '@example.com',
                    'buyer_address' => 'Địa chỉ test ' . $i,
                    'customer_note' => 'Đơn hàng test số ' . $i,
                    'payment_method_id' => 1,
                    'shipping_method_id' => 1,
                    'subtotal_amount' => $price * 2,
                    'tax_amount' => 0,
                    'shipping_fee' => 0,
                    'discount_amount' => 0,
                    'discount_code' => null,
                    'total_amount' => $price * 2,
                    'order_status' => 'delivered',
                    'shipping_name' => 'Khách Test ' . $i,
                    'shipping_phone' => '09000000' . $i,
                    'shipping_email' => 'test' . $i . '@example.com',
                    'shipping_address' => 'Địa chỉ test ' . $i,
                    'payment_status' => 'pending',
                ]);
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'product_variant_id' => $variant ? $variant->id : null,
                    'quantity' => 2,
                    'price' => $price,
                    'subtotal' => $price * 2,
                    'product_name' => $product->name,
                    'variant' => $variantData,
                ]);
            }
        });
    }
}
