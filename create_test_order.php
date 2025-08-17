<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Order;

echo "Creating test order with processing status...\n";

$order = Order::create([
    'order_code' => 'TEST002',
    'order_status' => 'processing',
    'total_amount' => 500000,
    'user_id' => 1,
    'shipper_id' => 1,
    'shipping_address' => '456 Test Street',
    'payment_method' => 'cash'
]);

echo "Order created: " . $order->id . "\n";
echo "Order code: " . $order->order_code . "\n";
echo "Status: " . $order->order_status . "\n";
echo "Test URL: http://127.0.0.1:8000/shipper-app/orders/" . $order->id . "\n";
