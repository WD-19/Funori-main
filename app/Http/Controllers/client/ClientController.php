<?php

namespace App\Http\Controllers\client;

use App\Models\Banner;
use App\Models\Product;
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

    $banners = Banner::where('is_active', 1)
    ->orderBy('created_at', 'desc')
    ->get();

    return view('client.home', compact('products','banners'));
}

}
