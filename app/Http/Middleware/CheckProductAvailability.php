<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Services\ProductStockService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Cart;
use App\Models\CartItem;

class CheckProductAvailability
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $productStockService = new ProductStockService();
        $cartItems = [];
        $removedItems = [];

        if (Auth::check()) {
            // Kiểm tra giỏ hàng database cho user đã đăng nhập
            $cart = Cart::where('user_id', Auth::id())->first();
            if ($cart) {
                $cartItemsRaw = CartItem::with(['product', 'productVariant'])
                    ->where('cart_id', $cart->id)
                    ->get();

                foreach ($cartItemsRaw as $item) {
                    $cartItems[] = [
                        'id' => $item->product_id . '_' . ($item->product_variant_id ?? 'null'),
                        'product_id' => $item->product_id,
                        'product_variant_id' => $item->product_variant_id,
                        'quantity' => $item->quantity,
                        'price_at_addition' => $item->price_at_addition,
                    ];
                }
            }
        } else {
            // Kiểm tra giỏ hàng session cho guest
            $sessionCart = Session::get('cart.items', []);
            foreach ($sessionCart as $item) {
                $cartItems[] = $item;
            }
        }

        if (!empty($cartItems)) {
            $checkResult = $productStockService->checkMultipleProducts($cartItems);
            
            if (!$checkResult['all_available']) {
                // Lưu thông tin sản phẩm không khả dụng để hiển thị thông báo
                $unavailableItems = $checkResult['unavailable_items'];
                $unavailableMessages = collect($unavailableItems)
                    ->pluck('check_result.message')
                    ->unique()
                    ->toArray();
                
                Session::put('unavailable_items', $unavailableItems);
                Session::put('unavailable_messages', $unavailableMessages);
            }
        }

        return $next($request);
    }
}
