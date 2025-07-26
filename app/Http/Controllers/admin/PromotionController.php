<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
use App\Models\Category;
use App\Models\Brand;
use App\Models\User;
use App\Mail\NewPromotionMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class PromotionController
{
    public function index()
    {
        $promotions = Promotion::orderByDesc('updated_at')->paginate(20);
        return view('admin.promotions.index', compact('promotions'));
    }

    public function create()
    {
        $categories = Category::select('id', 'name')->orderBy('name')->get();
        $brands = Brand::select('id', 'name')->orderBy('name')->get();
        return view('admin.promotions.create', compact( 'categories', 'brands'));
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:50|unique:promotions,code',
            'description' => 'nullable|string',
            'discount_type' => 'required|in:percentage,fixed_amount',
            'discount_value' => 'required|numeric|min:0',
            'max_discount_amount' => 'nullable|numeric|min:0',
            'min_order_value' => 'nullable|numeric|min:0',
            'usage_limit_per_voucher' => 'nullable|integer|min:0',
            'usage_limit_per_user' => 'nullable|integer|min:0',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'is_active' => 'boolean',
            'applies_to' => 'required|in:all_products,specific_brands,specific_categories',
        ];

        // Chỉ validate khi đúng loại
        if ($request->applies_to == 'specific_brands') {
            $rules['brand_ids'] = 'required|array|min:1';
        }
        if ($request->applies_to == 'specific_categories') {
            $rules['category_ids'] = 'required|array|min:1';
        }

        $data = $request->validate($rules);

        $promotion = Promotion::create($data);

        if ($request->applies_to == 'specific_categories' && $request->filled('category_ids')) {
            $promotion->categories()->sync($request->category_ids);
        }
        if ($request->applies_to == 'specific_brands' && $request->filled('brand_ids')) {
            $promotion->brands()->sync($request->brand_ids);
        }

        // Gửi email cho tất cả user
        $users = User::whereNotNull('email')->pluck('email');
        foreach ($users as $email) {
            Mail::to($email)->send(new NewPromotionMail($promotion));
        }

        return redirect()->route('admin.promotions.index')->with('success', 'Tạo khuyến mãi thành công!');
    }

    public function edit($id)
    {
        $promotion = Promotion::with(['brands', 'categories'])->findOrFail($id);
        $categories = Category::select('id', 'name')->orderBy('name')->get();
        $brands = Brand::select('id', 'name')->orderBy('name')->get();
        return view('admin.promotions.edit', compact('promotion', 'categories', 'brands'));
    }

    public function update(Request $request, $id)
    {
        $promotion = Promotion::findOrFail($id);
        
        $rules = [
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:50|unique:promotions,code,' . $promotion->id,
            'description' => 'nullable|string',
            'discount_type' => 'required|in:percentage,fixed_amount',
            'discount_value' => 'required|numeric|min:0',
            'max_discount_amount' => 'nullable|numeric|min:0',
            'min_order_value' => 'nullable|numeric|min:0',
            'usage_limit_per_voucher' => 'nullable|integer|min:0',
            'usage_limit_per_user' => 'nullable|integer|min:0',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'is_active' => 'boolean',
            'applies_to' => 'required|in:all_products,specific_brands,specific_categories',
        ];

        // Chỉ validate khi đúng loại
        if ($request->applies_to == 'specific_brands') {
            $rules['brand_ids'] = 'required|array|min:1';
        }
        if ($request->applies_to == 'specific_categories') {
            $rules['category_ids'] = 'required|array|min:1';
        }

        $data = $request->validate($rules);
        
        $promotion->update($data);

        // Cập nhật quan hệ
        if ($request->applies_to == 'specific_categories') {
            $promotion->categories()->sync($request->category_ids ?? []);
            $promotion->brands()->sync([]); // Xóa liên kết với brands
        } elseif ($request->applies_to == 'specific_brands') {
            $promotion->brands()->sync($request->brand_ids ?? []);
            $promotion->categories()->sync([]); // Xóa liên kết với categories
        } else {
            // Nếu áp dụng cho tất cả sản phẩm, xóa mọi liên kết
            $promotion->categories()->sync([]);
            $promotion->brands()->sync([]);
        }

        return redirect()->route('admin.promotions.index')
            ->with('success', 'Cập nhật khuyến mãi thành công!');
    }


}

