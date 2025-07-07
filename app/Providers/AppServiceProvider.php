<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Pagination\Paginator as PaginationPaginator;
use Illuminate\Support\Facades\View;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

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