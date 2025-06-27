<?php

namespace App\Http\Controllers\client;


use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
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
    if ($request->filled('min_price')) {
        $query->where('regular_price', '>=', $request->min_price);
    }
    if ($request->filled('max_price')) {
        $query->where('regular_price', '<=', $request->max_price);
    }

    $products = $query->latest()->paginate(12);

    $featuredProducts = Product::with(['images', 'reviews'])
    ->where('is_featured', 1)
    ->latest()
    ->take(3)
    ->get();

    return view('client.shop.shop', compact('products', 'categories', 'brands', 'featuredProducts'));
}
}
