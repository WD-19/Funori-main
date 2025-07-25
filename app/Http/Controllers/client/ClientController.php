<?php

namespace App\Http\Controllers\client;

use App\Models\Banner;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Page;
use Illuminate\Http\Request;

class ClientController
{
    public function index()
    {
        $products = Product::with([
            'category',
            'brand',
            'reviews',
            'images',
        ])
            ->where('status', 'published')
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();
        $topCategories = Category::withCount('products')
            ->orderByDesc('products_count')
            ->take(5)
            ->get();
        $randomBrands = Brand::inRandomOrder()->take(5)->get();

        $banners = Banner::where('is_active', 1)
            ->orderBy('created_at', 'desc')
            ->get();

        // hiển thị bài viết
        $latestPages = Page::where('status', 'published')
        ->orderByDesc('published_at')
        ->take(2)
        ->get();

        return view('client.home', compact('products', 'banners', 'topCategories', 'randomBrands', 'latestPages'));
    }
}
