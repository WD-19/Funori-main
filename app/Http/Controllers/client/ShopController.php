<?php

namespace App\Http\Controllers\client;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\Banner;
use App\Models\Attribute;
use App\Models\ProductVariantAttributeValue;
use App\Models\AttributeValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShopController
{
    public function index(Request $request)
    {
        $categories = Category::withCount('products')->get();
        $brands = Brand::where('is_active', 1)->get();
        $materials = AttributeValue::where('attribute_id', 1)->get();
        foreach ($materials as $material) {
            $material->products_count = DB::table('product_variant_attribute_values')
                ->join('product_variants', 'product_variant_attribute_values.product_variant_id', '=', 'product_variants.id')
                ->where('product_variant_attribute_values.attribute_value_id', $material->id)
                ->distinct('product_variants.product_id')
                ->count('product_variants.product_id');
        }


        $query = Product::with(['images', 'brand', 'category', 'reviews']);

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }
        if ($request->filled('brand_id')) {
            $query->where('brand_id', $request->brand_id);
        }
        if ($request->filled('material')) {
            $query->whereHas('variants.attributeValues', function ($q) use ($request) {
                $q->where('attribute_value_id', $request->material);
            });
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
            'products',
            'categories',
            'brands',
            'featuredProducts',
            'mainBanner',
            'randomParentCategories',
            'materials'
        ));
    }
    public function suggest(Request $request)
    {
        $q = $request->input('q');
        $products = Product::with('images')
            ->where('name', 'like', "%$q%")
            ->limit(10)
            ->get(['id', 'name', 'slug', 'regular_price as price']);

        // Lấy ảnh đầu tiên cho mỗi sản phẩm
        $results = $products->map(function ($product) {
            return [
                'id'    => $product->id,
                'name'  => $product->name,
                'slug'  => $product->slug,
                'price' => number_format($product->price, 0, ',', '.'),
                'image_url' => $product->images->first()
                    ? asset($product->images->first()->image_url)
                    : asset('images/no-image.png'),
            ];
        });

        return response()->json($results);
    }
}
