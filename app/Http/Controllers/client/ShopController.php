<?php

namespace App\Http\Controllers\client;


use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\Banner;
use Illuminate\Http\Request;

class ShopController
{
    public function index(Request $request)
{
    $categories = Category::withCount('products')->get();
    $brands = Brand::all();

    $query = Product::with(['images', 'brand', 'category', 'reviews']);

    if ($request->filled('category_id')) {
        $query->where('category_id', $request->category_id);
    }
    if ($request->filled('brand_id')) {
        $query->where('brand_id', $request->brand_id);
    }

    switch ($request->sort) {
        case 'popularity':
            $query->withCount('reviews')->orderByDesc('reviews_count');
            break;
        case 'rating':
            $query->withAvg('reviews', 'rating')->orderByDesc('reviews_avg_rating');
            break;
        case 'latest':
            $query->orderByDesc('created_at');
            break;
        case 'price_asc':
            $query->orderBy('regular_price', 'asc');
            break;
        case 'price_desc':
            $query->orderBy('regular_price', 'desc');
            break;
    }

    $products = $query->latest()->paginate(16);

    $featuredProducts = Product::with(['images', 'reviews'])
    ->where('is_featured', 1)
    ->latest()
    ->take(3)
    ->get();

    $mainBanner = Banner::where('is_active', 1)
        ->where('position', 'shop')
        ->orderBy('order')
        ->first();

// Lấy 4 danh mục cha ngẫu nhiên
$randomParentCategories = Category::whereNull('parent_id')->inRandomOrder()->take(4)->get();

    return view('client.shop.shop', compact(
        'products', 'categories', 'brands', 'featuredProducts', 'mainBanner', 'randomParentCategories'
    ));
}
}
