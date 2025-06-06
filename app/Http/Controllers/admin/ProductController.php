<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController
{
    public function index(Request $request)
{
    $query = Product::with(['category', 'brand', 'images']);

    if ($request->filled('name')) {
        $query->where('name', 'like', '%' . $request->name . '%');
    }

    $products = $query->paginate(20)->appends($request->all());
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
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.products.create', compact('categories', 'brands'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'regular_price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'sku' => 'nullable|string|max:50',
            'tags' => 'nullable|string|max:255',
            'short_description' => 'required|string|max:255',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Tạo sản phẩm
        $product = Product::create([
            'name' => $validated['name'],
            'category_id' => $validated['category_id'],
            'brand_id' => $validated['brand_id'],
            'regular_price' => $validated['regular_price'],
            'sale_price' => $request->sale_price,
            'stock_quantity' => $validated['stock_quantity'],
            'sku' => $request->sku,
            'tags' => $request->tags,
            'short_description' => $validated['short_description'],
        ]);

        // Lưu ảnh
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');
                $product->images()->create(['image_url' => $path]);
            }
        }

        // Lưu thuộc tính (attributes)
        if ($request->has('attributes')) {
            foreach ($request->attributes as $attrName => $attrValues) {
                foreach ($attrValues as $value) {
                    if ($value) {
                        $product->attributes()->create([
                            'name' => $attrName,
                            'value' => $value,
                        ]);
                    }
                }
            }
        }

        // Lưu biến thể (variants)
        if ($request->has('variants')) {
            foreach ($request->variants as $variant) {
                $product->variants()->create([
                    'sku' => $variant['sku'] ?? null,
                    'price' => $variant['price'] ?? null,
                    'stock' => $variant['stock'] ?? null,
                    'color' => $variant['color'] ?? null,
                    'size' => $variant['size'] ?? null,
                ]);
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully!');
    }

    public function destroy($id)
{
    $product = Product::findOrFail($id);
    $product->images()->delete();
    $product->attributes()->delete();
    $product->variants()->delete();

    $product->delete();

    return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully!');
}
}
