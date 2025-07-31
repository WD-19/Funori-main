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
use App\Models\Wishlist;

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
        View::composer('client.partials.header', function ($view) {
            if (Auth::check()) {
                $cart = Cart::where('user_id', Auth::id())->first();
                $cartCount = $cart ? $cart->items()->count() : 0;
            } else {
                $cart = session('cart', []);
                $globalCartItems = collect($cart)->map(function ($item) {
                    if (!isset($item['product_id'])) {
                        return null; // hoặc return []; hoặc bỏ qua tuỳ logic
                    }
                    $product = Product::with([
                        'images',
                        'variants.image',
                        'variants.attributeValues.attribute'
                    ])->find($item['product_id']);
                    $variant = $product?->variants?->firstWhere('id', $item['product_variant_id'] ?? null);

                    return [
                        'id' => $item['product_id'] . '-' . ($item['product_variant_id'] ?? 'null'),
                        'product' => $product ? $product->toArray() : null,
                        'variant' => $variant ? $variant->toArray() : null,
                        'variant_attributes' => $variant?->attributeValues->map(function ($attrVal) {
                            return $attrVal->attribute->name . ': ' . $attrVal->value;
                        })->all() ?? [],
                        'quantity' => $item['quantity'],
                        'price_at_addition' => $item['price'] ?? null,
                        'image_url' => $variant->image->image_url ?? ($product->images[0]->image_url ?? null),
                    ];
                })->filter()->values()->all();

                $cartCount = count($globalCartItems);
            }
            $view->with('cartCount', $cartCount);
        });


        PaginationPaginator::useBootstrapFive();
        View::composer('*', function ($view) {
            $wishlistCount = 0;
            $wishlistItems = collect();
            if (Auth::check()) {
                $wishlist = Auth::user()->wishlist;
                if ($wishlist) {
                    $wishlistItems = $wishlist->items()->with('product.images')->get();
                    $wishlistCount = $wishlistItems->count();
                }
            }
            $view->with('headerWishlistCount', $wishlistCount)->with('headerWishlistItems', $wishlistItems);
        });
    }
}
