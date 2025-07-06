<?php

namespace App\Providers;

use App\Models\Cart;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Pagination\Paginator as PaginationPaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use App\Models\Product;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $cartItems = [];
            $cartCount = 0;
            if (Auth::check()) {
                $cart = Cart::where('user_id', Auth::id())->first();
                if ($cart) {
                    $cartItems = $cart->items()->with('product.images', 'product.variants')->get()->map(function($item) {
                        return [
                            'id' => $item->id,
                            'product' => $item->product ? $item->product->toArray() : null,
                            'quantity' => $item->quantity,
                            'price_at_addition' => $item->price_at_addition,
                        ];
                    })->all();
                    $cartCount = count($cartItems);
                }
            } else {
                $cart = session('cart', []);
                $cartItems = collect($cart)->map(function($item) {
                    $product = Product::with(['images', 'variants'])->find($item['product_id']);
                    return [
                        'id' => $item['product_id'] . '_' . ($item['product_variant_id'] ?? 'null'),
                        'product' => $product ? $product->toArray() : null,
                        'quantity' => $item['quantity'],
                        'price_at_addition' => $item['price'],
                    ];
                })->all();
                $cartCount = count($cartItems);
            }
            $view->with('cartItems', $cartItems)->with('cartCount', $cartCount);
        });
        PaginationPaginator::useBootstrapFive();
    }
}