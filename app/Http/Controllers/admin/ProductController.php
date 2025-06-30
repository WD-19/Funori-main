<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Attribute;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class ProductController
{
    public function index(Request $request)
    {
        $query = Product::with(['category', 'brand', 'images', 'variants']);

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
        // Thêm lọc theo danh mục
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }
        // Thêm lọc theo thương hiệu
        if ($request->filled('brand_id')) {
            $query->where('brand_id', $request->brand_id);
        }
        // Thêm lọc theo trạng thái
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $categories = Category::all();
        $brands = Brand::all();

        $products = $query->orderBy('updated_at', 'desc')->paginate(10)->appends($request->all());
        return view('admin.products.index', compact('products', 'categories', 'brands'));
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
        $productImages = [];
        $attributes = Attribute::with('values')->get();
        return view('admin.products.create', compact('categories', 'brands', 'attributes', 'productImages'));
    }
    public function edit($id)
    {
        $product = Product::with(['images', 'variants.attributeValues', 'variants.image'])->findOrFail($id);
        $categories = Category::all();
        $brands = Brand::all();
        $attributes = Attribute::with('values')->get();
        $productImages = $product->images; // Để chọn ảnh cho variant

        return view('admin.products.edit', compact('product', 'categories', 'brands', 'attributes', 'productImages'));
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->images()->delete();
        foreach ($product->variants as $variant) {
            $variant->attributeValues()->detach();
            $variant->delete();
        }
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully!');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'regular_price' => 'required|numeric|min:0',
            'short_description' => 'required|string|max:255',
            'description' => 'required|string',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'variants' => 'required|array|min:1',
            'variants.*.attribute_values' => 'required|array',
            'variants.*.attribute_values.*' => 'required|integer|exists:attribute_values,id',
            'variants.*.size' => 'required|string|max:100',
            'variants.*.price_modifier' => 'required|numeric',
            'variants.*.stock_quantity' => 'required|integer|min:0',
            'variants.*.image' => 'required|image|mimes:jpeg,png,jpg, gif,svg|max:2048',
        ], [
            'name.required' => 'Tên sản phẩm là bắt buộc.',
            'name.max' => 'Tên sản phẩm không được vượt quá 100 ký tự.',
            'category_id.required' => 'Vui lòng chọn danh mục.',
            'category_id.exists' => 'Danh mục không hợp lệ.',
            'brand_id.required' => 'Vui lòng chọn thương hiệu.',
            'brand_id.exists' => 'Thương hiệu không hợp lệ.',
            'regular_price.required' => 'Giá gốc là bắt buộc.',
            'regular_price.numeric' => 'Giá gốc phải là số.',
            'regular_price.min' => 'Giá gốc phải lớn hơn hoặc bằng 0.',
            'short_description.required' => 'Mô tả ngắn là bắt buộc.',
            'short_description.max' => 'Mô tả ngắn không được vượt quá 255 ký tự.',
            'description.required' => 'Mô tả chi tiết là bắt buộc.',
            'images.*.image' => 'Tệp tải lên phải là hình ảnh.',
            'images.*.mimes' => 'Ảnh phải có định dạng jpeg, png, jpg, gif hoặc svg.',
            'images.*.max' => 'Ảnh không được vượt quá 2MB.',
            'variants.required' => 'Phải có ít nhất một biến thể.',
            'variants.array' => 'Biến thể không hợp lệ.',
            'variants.*.attribute_values.required' => 'Vui lòng chọn thuộc tính cho biến thể.',
            'variants.*.attribute_values.array' => 'Thuộc tính biến thể không hợp lệ.',
            'variants.*.attribute_values.*.required' => 'Vui lòng chọn giá trị thuộc tính.',
            'variants.*.attribute_values.*.exists' => 'Giá trị thuộc tính không hợp lệ.',
            'variants.*.size.required' => 'Kích thước của biến thể là bắt buộc.',
            'variants.*.size.max' => 'Kích thước không được vượt quá 100 ký tự.',
            'variants.*.price_modifier.required' => 'Giá chênh lệch là bắt buộc.',
            'variants.*.price_modifier.numeric' => 'Giá chênh lệch phải là số.',
            'variants.*.stock_quantity.required' => 'Số lượng kho là bắt buộc.',
            'variants.*.stock_quantity.integer' => 'Số lượng kho phải là số nguyên.',
            'variants.*.stock_quantity.min' => 'Số lượng kho phải lớn hơn hoặc bằng 0.',
            'variants.*.image.required' => 'Ảnh biến thể là bắt buộc.',
            'variants.*.image.image' => 'Ảnh biến thể phải là hình ảnh.',
            'variants.*.image.mimes' => 'Ảnh biến thể phải có định dạng jpeg, png, jpg, gif hoặc svg.',
            'variants.*.image.max' => 'Ảnh biến thể không được vượt quá 2MB.',
        ]);

        $slug = Str::slug($validated['name']);

        // Kiểm tra trùng tên hoặc slug
        $exists = Product::where('name', $validated['name'])
            ->orWhere('slug', $slug)
            ->exists();

        if ($exists) {
            return back()
                ->withErrors(['name' => 'Tên sản phẩm hoặc đường dẫn (slug) đã tồn tại.'])
                ->withInput();
        }

        $product = Product::create([
            'name' => $validated['name'],
            'slug' => $slug,
            'category_id' => $validated['category_id'],
            'brand_id' => $validated['brand_id'],
            'regular_price' => $validated['regular_price'],
            'short_description' => $validated['short_description'],
            'description' => $request->description,
        ]);

        // Lưu ảnh gallery
        $galleryImageIds = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $fileName = uniqid() . '_' . time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/products'), $fileName);
                $img = $product->images()->create([
                    'image_url' => 'images/products/' . $fileName,
                    'order' => 0
                ]);
                $galleryImageIds[] = $img->id;
            }
        }

        // Lưu variants
        if ($request->has('variants')) {
            foreach ($request->variants as $index => $variant) {
                $variantImageId = null;
                // Sửa lấy file ảnh đúng chuẩn Laravel
                if ($request->hasFile("variants.$index.image")) {
                    $file = $request->file("variants.$index.image");
                    $fileName = uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('images/products'), $fileName);
                    $img = $product->images()->create([
                        'image_url' => 'images/products/' . $fileName,
                        'order' => 0
                    ]);
                    $variantImageId = $img->id;
                }
                $variantModel = $product->variants()->create([
                    'size' => $variant['size'] ?? null,
                    'price_modifier' => $variant['price_modifier'] ?? 0,
                    'stock_quantity' => $variant['stock_quantity'] ?? 0,
                    'image_id' => $variantImageId,
                ]);
                // Lưu thuộc tính cho variant
                if (isset($variant['attribute_values'])) {
                    foreach ($variant['attribute_values'] as $attribute_id => $value_id) {
                        if ($value_id) {
                            $variantModel->attributeValues()->attach($value_id);
                        }
                    }
                }
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Thêm sản phẩm thành công!');
    }
    public function update(Request $request, $id)
    {
        $product = Product::with(['variants.attributeValues', 'images', 'variants.image'])->findOrFail($id);

        if ($request->has('status')) {
            $product->status = $request->status;
            $product->save();
            return back()->with('success', 'Cập nhật trạng thái thành công!');
        }

        // Đếm số ảnh sẽ còn lại sau khi cập nhật
        $keepImages = $request->input('keep_images', []);
        $newImages = $request->file('images', []);
        $totalImages = count($keepImages) + (is_array($newImages) ? count($newImages) : 0);

        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'regular_price' => 'required|numeric|min:0',
            'short_description' => 'required|string|max:255',
            'description' => 'required|string',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'variants' => 'required|array|min:1',
            'variants.*.attribute_values' => 'required|array',
            'variants.*.attribute_values.*' => 'required|integer|exists:attribute_values,id',
            'variants.*.size' => 'required|string|max:100',
            'variants.*.price_modifier' => 'required|numeric',
            'variants.*.stock_quantity' => 'required|integer|min:0',
            'variants.*.new_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'keep_images' => 'array',
            'keep_images.*' => 'integer|exists:product_images,id',
        ], [
            'name.required' => 'Tên sản phẩm là bắt buộc.',
            'name.max' => 'Tên sản phẩm không được vượt quá 100 ký tự.',
            'category_id.required' => 'Vui lòng chọn danh mục.',
            'category_id.exists' => 'Danh mục không hợp lệ.',
            'brand_id.required' => 'Vui lòng chọn thương hiệu.',
            'brand_id.exists' => 'Thương hiệu không hợp lệ.',
            'regular_price.required' => 'Giá gốc là bắt buộc.',
            'regular_price.numeric' => 'Giá gốc phải là số.',
            'regular_price.min' => 'Giá gốc phải lớn hơn hoặc bằng 0.',
            'short_description.required' => 'Mô tả ngắn là bắt buộc.',
            'short_description.max' => 'Mô tả ngắn không được vượt quá 255 ký tự.',
            'description.required' => 'Mô tả chi tiết là bắt buộc.',
            'images.*.image' => 'Tệp tải lên phải là hình ảnh.',
            'images.*.mimes' => 'Ảnh phải có định dạng jpeg, png, jpg, gif hoặc svg.',
            'images.*.max' => 'Ảnh không được vượt quá 2MB.',
            'variants.required' => 'Phải có ít nhất một biến thể.',
            'variants.array' => 'Biến thể không hợp lệ.',
            'variants.*.attribute_values.required' => 'Vui lòng chọn thuộc tính cho biến thể.',
            'variants.*.attribute_values.array' => 'Thuộc tính biến thể không hợp lệ.',
            'variants.*.attribute_values.*.required' => 'Vui lòng chọn giá trị thuộc tính.',
            'variants.*.attribute_values.*.exists' => 'Giá trị thuộc tính không hợp lệ.',
            'variants.*.size.required' => 'Kích thước của biến thể là bắt buộc.',
            'variants.*.size.max' => 'Kích thước không được vượt quá 100 ký tự.',
            'variants.*.price_modifier.required' => 'Giá chênh lệch là bắt buộc.',
            'variants.*.price_modifier.numeric' => 'Giá chênh lệch phải là số.',
            'variants.*.stock_quantity.required' => 'Số lượng kho là bắt buộc.',
            'variants.*.stock_quantity.integer' => 'Số lượng kho phải là số nguyên.',
            'variants.*.stock_quantity.min' => 'Số lượng kho phải lớn hơn hoặc bằng 0.',
            'variants.*.new_image.image' => 'Ảnh biến thể phải là hình ảnh.',
            'variants.*.new_image.mimes' => 'Ảnh biến thể phải có định dạng jpeg, png, jpg, gif hoặc svg.',
            'variants.*.new_image.max' => 'Ảnh biến thể không được vượt quá 2MB.',
        ]);

        $slug = Str::slug($validated['name']);

        // Kiểm tra trùng tên hoặc slug (trừ sản phẩm hiện tại)
        $exists = Product::where(function($q) use ($validated, $slug, $id) {
                $q->where('name', $validated['name'])
                  ->orWhere('slug', $slug);
            })
            ->where('id', '!=', $id)
            ->exists();

        if ($exists) {
            return back()
                ->withErrors(['name' => 'Tên sản phẩm hoặc đường dẫn (slug) đã tồn tại.'])
                ->withInput();
        }

        // Đếm số ảnh sẽ còn lại sau khi cập nhật
        $keepImages = $request->input('keep_images', []);
        $newImages = $request->file('images', []);
        $totalImages = count($keepImages) + (is_array($newImages) ? count($newImages) : 0);

        // Validate bắt buộc phải còn ít nhất 1 ảnh sau khi cập nhật
        if ($totalImages < 1) {
            return back()
                ->withErrors(['images' => 'Sản phẩm phải có ít nhất 1 ảnh.'])
                ->withInput();
        }

        // Validate biến thể phải có ảnh (cũ hoặc mới)
        $variantErrors = [];
        foreach ($request->variants as $i => $variant) {
            $hasOld = !empty($variant['id']) && $product->variants->where('id', $variant['id'])->first() && $product->variants->where('id', $variant['id'])->first()->image_id;
            $hasNew = isset($variant['new_image']) && $variant['new_image'];
            if (!$hasOld && !$hasNew) {
                $variantErrors["variants.$i.new_image"] = "Ảnh biến thể là bắt buộc.";
            }
        }
        if (!empty($variantErrors)) {
            return back()->withErrors($variantErrors)->withInput();
        }

        // XÓA ẢNH KHÔNG ĐƯỢC GIỮ LẠI
        $product->images()->whereNotIn('id', $keepImages)->each(function($img) {
            @unlink(public_path($img->image_url));
            $img->delete();
        });

        // Lưu ảnh mới
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $fileName = uniqid() . '_' . time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/products'), $fileName);
                $product->images()->create([
                    'image_url' => 'images/products/' . $fileName,
                    'order' => 0
                ]);
            }
        }

        // Cập nhật sản phẩm cha
        $product->update([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'category_id' => $validated['category_id'],
            'brand_id' => $validated['brand_id'],
            'regular_price' => $validated['regular_price'],
            'short_description' => $validated['short_description'],
            'description' => $request->description,
        ]);

        // Xử lý variants
        $variantIds = [];
        if ($request->has('variants')) {
            foreach ($request->variants as $i => $variantData) {
                if (!empty($variantData['id'])) {
                    // Update variant cũ
                    $variant = $product->variants()->find($variantData['id']);
                    if ($variant) {
                        // Upload ảnh mới nếu có
                        $file = $request->file("variants.$i.new_image");
                        if ($file) {
                            // Xóa ảnh cũ nếu có
                            if ($variant->image) {
                                $oldPath = public_path($variant->image->image_url);
                                if (file_exists($oldPath)) {
                                    @unlink($oldPath);
                                }
                                $variant->image->delete();
                            }
                            // Upload ảnh mới
                            $fileName = uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();
                            $file->move(public_path('images/products'), $fileName);
                            $img = $product->images()->create([
                                'image_url' => 'images/products/' . $fileName,
                                'order' => 0
                            ]);
                            $variant->image_id = $img->id;
                            $variant->save();
                        }
                        // Cập nhật các trường khác
                        $variant->update([
                            'size' => $variantData['size'] ?? null,
                            'price_modifier' => $variantData['price_modifier'] ?? 0,
                            'stock_quantity' => $variantData['stock_quantity'] ?? 0,
                        ]);
                        // Cập nhật attribute_values
                        if (isset($variantData['attribute_values'])) {
                            $variant->attributeValues()->sync(array_filter($variantData['attribute_values']));
                        }
                        $variantIds[] = $variant->id;
                    }
                } else {
                    // Tạo mới variant
                    $variantImageId = null;
                    $file = $request->file("variants.$i.new_image");
                    if ($file) {
                        $fileName = uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();
                        $file->move(public_path('images/products'), $fileName);
                        $img = $product->images()->create([
                            'image_url' => 'images/products/' . $fileName,
                            'order' => 0
                        ]);
                        $variantImageId = $img->id;
                    }
                    $newVariant = $product->variants()->create([
                        'size' => $variantData['size'] ?? null,
                        'price_modifier' => $variantData['price_modifier'] ?? 0,
                        'stock_quantity' => $variantData['stock_quantity'] ?? 0,
                        'image_id' => $variantImageId,
                    ]);
                    if (isset($variantData['attribute_values'])) {
                        $newVariant->attributeValues()->sync(array_filter($variantData['attribute_values']));
                    }
                    $variantIds[] = $newVariant->id;
                }
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Cập nhật sản phẩm thành công!');
    }
}
