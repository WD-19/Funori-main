<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

// Channel cho admin - tracking đơn hàng
Broadcast::channel('admin.orders', function ($user) {
    return $user && $user->role === 'admin';
});

// Channel cho client - timeline vận chuyển đơn hàng
Broadcast::channel('client.orders.{userId}', function ($user, $userId) {
    return $user && $user->id == $userId;
});

// Channel cho shipper - danh sách và cập nhật đơn hàng
Broadcast::channel('shipper.orders', function ($user) {
    // Tạm thời cho phép tất cả (public channel)
    return true;
});

// Channel public cho order cụ thể
Broadcast::channel('orders.{orderId}', function ($user, $orderId) {
    // Cho phép tất cả user đã đăng nhập truy cập
    return $user !== null;
});

// Channel public cho location updates
Broadcast::channel('orders.{orderId}.location', function ($user, $orderId) {
    // Cho phép tất cả user đã đăng nhập truy cập
    return $user !== null;
});

// Channel public cho new orders
Broadcast::channel('orders.new', function ($user) {
    // Cho phép tất cả user đã đăng nhập truy cập
    return $user !== null;
});
