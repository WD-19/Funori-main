<?php

namespace App\Http\Controllers\client;


use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ShopController
{
    public function index(Request $request)
{
    $categories = Category::withCount('products')->get();

    $query = Product::with(['images', 'brand', 'category', 'reviews']);

    if ($request->filled('category_id')) {
        $query->where('category_id', $request->category_id);
    }

    $products = $query->latest()->paginate(12);

    return view('client.shop', compact('products', 'categories'));
}
}
