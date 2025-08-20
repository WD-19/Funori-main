<?php

namespace App\Providers;

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Shipper;

class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Sử dụng middleware api cho API authentication
        Broadcast::routes(['middleware' => ['api']]);
        
        // Debug: Log route registration
        \Log::info('Broadcasting routes registered with middleware: api');
        
        // Authorize channels - tạm thời cho phép tất cả
        Broadcast::channel('shipper.orders', function ($user) {
            // Debug: Log user info
            \Log::info('Broadcasting auth attempt for shipper.orders', [
                'user_id' => $user?->id,
                'user_role' => $user?->role,
                'user_exists' => $user !== null
            ]);
            
            // Tạm thời cho phép tất cả
            return true;
        });
        
        Broadcast::channel('orders.{orderId}', function ($user, $orderId) {
            // Bất kỳ user nào đã đăng nhập đều có thể nghe
            return true;
        });
        
        Broadcast::channel('orders.{orderId}.location', function ($user, $orderId) {
            // Bất kỳ user nào đã đăng nhập đều có thể nghe
            return $user !== null;
        });
        
        Broadcast::channel('orders.new', function ($user) {
            // Bất kỳ user nào đã đăng nhập đều có thể nghe
            return true;
        });
        
        // Admin channel để tracking đơn hàng
        Broadcast::channel('admin.orders', function ($user) {
            // Tạm thời cho phép tất cả
            return true;
        });
    }
}
