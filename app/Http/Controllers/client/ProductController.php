<?php

namespace App\Http\Controllers\client;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController
{
    /**
     * Display the product details.
     *
     * @param string $slug
     * @return \Illuminate\View\View
     */
    public function show($slug)
    {
        // Lấy sản phẩm kèm các bảng liên quan: ảnh, biến thể, ảnh biến thể, danh mục
        $product = Product::with([
            'images',
            'thumbnail',
            'variants.image',
            'category'
        ])->where('slug', $slug)->first();

        if (!$product) {
            // Trả về view 404 nếu không tìm thấy sản phẩm
            return response()->view('client.errors.404', [], 404);
        }

        return view('client.product.detail', compact('product'));
    }
}
