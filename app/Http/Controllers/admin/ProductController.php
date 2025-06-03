<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController
{
    public function index()
    {
        $products = Product::with(['category', 'brand', 'images'])->paginate(20);
        return view('admin.products.index', compact('products'));
    }
    public function show($id)
    {
        $product = Product::with([
            'category',
            'brand',
            'images',
            'variants.attributeValues.attribute'
        ])->findOrFail($id);

        return view('admin.products.detail', compact('product'));
    }
}
