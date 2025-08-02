<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\ProductVariant;
use Symfony\Component\HttpFoundation\Response;

class SyncCartMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Chỉ xử lý khi user đã đăng nhập và có session cart
        if (Auth::check() && Session::has('cart')) {
            $sessionCart = Session::get('cart', []);
            
            if (!empty($sessionCart)) {
                // Lấy hoặc tạo cart cho user
                $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);
                
                // Đồng bộ từng item từ session sang database
                foreach ($sessionCart as $item) {
                    if (isset($item['product_id'])) {
                        $product = Product::find($item['product_id']);
                        if ($product) {
                            // Kiểm tra xem item đã tồn tại trong database chưa
                            $existingItem = $cart->items()->where([
                                'product_id' => $item['product_id'],
                                'product_variant_id' => $item['product_variant_id'] ?? null
                            ])->first();
                            
                            if ($existingItem) {
                                // Cập nhật số lượng nếu cần
                                if ($existingItem->quantity != $item['quantity']) {
                                    $existingItem->update(['quantity' => $item['quantity']]);
                                }
                            } else {
                                // Tạo mới item
                                $cart->items()->create([
                                    'product_id' => $item['product_id'],
                                    'product_variant_id' => $item['product_variant_id'] ?? null,
                                    'quantity' => $item['quantity'],
                                    'price_at_addition' => $item['price_at_addition'] ?? $product->regular_price
                                ]);
                            }
                        }
                    }
                }
                
                // Xóa session cart sau khi đã đồng bộ
                Session::forget('cart');
            }
        }
        
        return $next($request);
    }
} 