<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    public function run()
    {
        // Lấy 5 user và 10 sản phẩm mẫu (nếu chưa có thì tạo)
        $users = User::inRandomOrder()->limit(5)->get();
        if ($users->count() < 5) {
            $users = User::factory(5)->create();
        }
        $products = Product::inRandomOrder()->limit(10)->get();
        if ($products->count() < 10) {
            $products = Product::factory(10)->create();
        }

        $faker = \Faker\Factory::create();
        $paymentMethods = [1, 2]; // adjust as needed
        $shippingMethods = [1, 2]; // adjust as needed
        $paymentStatuses = ['pending', 'paid', 'failed', 'refunded'];
        $orderStatuses = [
            'delivered'
        ];

    for ($i = 0; $i < 100; $i++) {
            $user = $users->random();
            $customerName = $faker->name;
            $customerEmail = $faker->unique()->safeEmail;
            $customerPhone = $faker->phoneNumber;
            $shippingAddress = $faker->address;
            $shippingName = $faker->name;
            $shippingEmail = $faker->unique()->safeEmail;
            $shippingPhone = $faker->phoneNumber;
            $orderStatus = $faker->randomElement($orderStatuses);
            $paymentStatus = $faker->randomElement($paymentStatuses);
            $paymentMethodId = $faker->randomElement($paymentMethods);
            $shippingMethodId = $faker->randomElement($shippingMethods);
            $shippingFee = rand(10000, 30000);
            $subtotal = 0;

            $daysAgo = rand(0, 364);
            $orderDate = now()->subDays($daysAgo);
            $order = Order::create([
                'user_id' => $user->id,
                'order_code' => 'OD' . now()->format('ymdHis') . rand(100,999) . $i,
                'customer_name' => $customerName,
                'customer_email' => $customerEmail,
                'customer_phone' => $customerPhone,
                'shipping_address' => $shippingAddress,
                'shipping_name' => $shippingName,
                'shipping_email' => $shippingEmail,
                'shipping_phone' => $shippingPhone,
                'subtotal_amount' => 0,
                'shipping_fee' => $shippingFee,
                'discount_amount' => 0,
                'tax_amount' => 0,
                'total_amount' => 0, // will update after items
                'payment_method_id' => $paymentMethodId,
                'payment_status' => $paymentStatus,
                'shipping_method_id' => $shippingMethodId,
                'order_status' => $orderStatus,
                'customer_note' => $faker->optional()->sentence,
                'admin_note' => $faker->optional()->sentence,
                'ordered_at' => $orderDate,
                'created_at' => $orderDate,
                'updated_at' => $orderDate,
            ]);

            $total = 0;
            $itemCount = rand(1, 4);
                for ($j = 0; $j < $itemCount; $j++) {
                    $product = $products->random();
                    $qty = rand(1, 3);
                    $itemSubtotal = $product->regular_price * $qty;
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $product->id,
                        'product_name' => $product->name,
                        'quantity' => $qty,
                        'subtotal' => $itemSubtotal,
                    ]);
                    $total += $itemSubtotal;
            }
            $order->subtotal_amount = $total;
            $order->total_amount = $total + $order->shipping_fee;
            $order->save();
        }
    }
}
