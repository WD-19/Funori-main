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
                $cartCount = count($cart);
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
