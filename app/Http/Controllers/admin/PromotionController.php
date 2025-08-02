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
        return view('admin.promotions.create', compact('categories', 'brands'));
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:promotions,code',
            'description' => 'nullable|string',
            'discount_type' => 'required|in:percentage,fixed_amount',
            'discount_value' => 'required|numeric|min:0',
            'max_discount_amount' => 'required_if:discount_type,percentage|nullable|numeric|min:0',
            'min_order_value' => 'required|numeric|min:0',
            'usage_limit_per_voucher' => 'required|integer|min:0',
            'usage_limit_per_user' => 'required|integer|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'is_active' => 'required|boolean',
            'applies_to' => 'required|in:all_products,specific_brands,specific_categories',
            'brand_ids' => 'required_if:applies_to,specific_brands|array|min:1',
            'category_ids' => 'required_if:applies_to,specific_categories|array|min:1',
        ];

        $messages = [
            'name.required' => 'Vui lòng nhập tên khuyến mãi.',
            'name.max' => 'Tên khuyến mãi không được vượt quá 255 ký tự.',
            'code.required' => 'Vui lòng nhập mã khuyến mãi.',
            'code.max' => 'Mã khuyến mãi không được vượt quá 50 ký tự.',
            'code.unique' => 'Mã khuyến mãi đã tồn tại.',
            'description.string' => 'Mô tả phải là chuỗi ký tự.',
            'discount_type.required' => 'Vui lòng chọn loại giảm giá.',
            'discount_type.in' => 'Loại giảm giá không hợp lệ.',
            'discount_value.required' => 'Vui lòng nhập giá trị giảm.',
            'discount_value.numeric' => 'Giá trị giảm phải là số.',
            'discount_value.min' => 'Giá trị giảm phải lớn hơn hoặc bằng 0.',
            'max_discount_amount.required_if' => 'Vui lòng nhập giá trị giảm tối đa khi chọn loại giảm giá là phần trăm.',
            'max_discount_amount.numeric' => 'Giá trị giảm tối đa phải là số.',
            'max_discount_amount.min' => 'Giá trị giảm tối đa phải lớn hơn hoặc bằng 0.',
            'min_order_value.required' => 'Vui lòng nhập giá trị đơn tối thiểu.',
            'min_order_value.numeric' => 'Giá trị đơn tối thiểu phải là số.',
            'min_order_value.min' => 'Giá trị đơn tối thiểu phải lớn hơn hoặc bằng 0.',
            'usage_limit_per_voucher.required' => 'Vui lòng nhập số lượt dùng tối đa cho mã.',
            'usage_limit_per_voucher.integer' => 'Số lượt dùng tối đa cho mã phải là số nguyên.',
            'usage_limit_per_voucher.min' => 'Số lượt dùng tối đa cho mã phải lớn hơn hoặc bằng 0.',
            'usage_limit_per_user.required' => 'Vui lòng nhập số lượt dùng tối đa mỗi người.',
            'usage_limit_per_user.integer' => 'Số lượt dùng tối đa mỗi người phải là số nguyên.',
            'usage_limit_per_user.min' => 'Số lượt dùng tối đa mỗi người phải lớn hơn hoặc bằng 0.',
            'start_date.required' => 'Vui lòng chọn ngày bắt đầu.',
            'start_date.date' => 'Ngày bắt đầu không hợp lệ.',
            'end_date.required' => 'Vui lòng chọn ngày kết thúc.',
            'end_date.date' => 'Ngày kết thúc không hợp lệ.',
            'end_date.after_or_equal' => 'Ngày kết thúc phải sau hoặc bằng ngày bắt đầu.',
            'is_active.required' => 'Vui lòng chọn trạng thái kích hoạt.',
            'is_active.boolean' => 'Trạng thái kích hoạt không hợp lệ.',
            'applies_to.required' => 'Vui lòng chọn loại áp dụng.',
            'applies_to.in' => 'Loại áp dụng không hợp lệ.',
            'brand_ids.required_if' => 'Vui lòng chọn ít nhất một thương hiệu khi áp dụng cho thương hiệu cụ thể.',
            'brand_ids.array' => 'Danh sách thương hiệu không hợp lệ.',
            'brand_ids.min' => 'Vui lòng chọn ít nhất một thương hiệu.',
            'category_ids.required_if' => 'Vui lòng chọn ít nhất một danh mục khi áp dụng cho danh mục cụ thể.',
            'category_ids.array' => 'Danh sách danh mục không hợp lệ.',
            'category_ids.min' => 'Vui lòng chọn ít nhất một danh mục.',
        ];

        $data = $request->validate($rules, $messages);

        $promotion = Promotion::create($data);

        if ($request->applies_to == 'specific_categories' && $request->filled('category_ids')) {
            $promotion->categories()->sync($request->category_ids);
        }
        if ($request->applies_to == 'specific_brands' && $request->filled('brand_ids')) {
            $promotion->brands()->sync($request->brand_ids);
        }

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
            'code' => 'required|string|max:50|unique:promotions,code,' . $promotion->id,
            'description' => 'nullable|string',
            'discount_type' => 'required|in:percentage,fixed_amount',
            'discount_value' => 'required|numeric|min:0',
            'max_discount_amount' => 'required_if:discount_type,percentage|nullable|numeric|min:0',
            'min_order_value' => 'required|numeric|min:0',
            'usage_limit_per_voucher' => 'required|integer|min:0',
            'usage_limit_per_user' => 'required|integer|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'is_active' => 'required|boolean',
            'applies_to' => 'required|in:all_products,specific_brands,specific_categories',
            'brand_ids' => 'required_if:applies_to,specific_brands|array|min:1',
            'category_ids' => 'required_if:applies_to,specific_categories|array|min:1',
        ];

        $messages = [
            'name.required' => 'Vui lòng nhập tên khuyến mãi.',
            'name.max' => 'Tên khuyến mãi không được vượt quá 255 ký tự.',
            'code.required' => 'Vui lòng nhập mã khuyến mãi.',
            'code.max' => 'Mã khuyến mãi không được vượt quá 50 ký tự.',
            'code.unique' => 'Mã khuyến mãi đã tồn tại.',
            'description.string' => 'Mô tả phải là chuỗi ký tự.',
            'discount_type.required' => 'Vui lòng chọn loại giảm giá.',
            'discount_type.in' => 'Loại giảm giá không hợp lệ.',
            'discount_value.required' => 'Vui lòng nhập giá trị giảm.',
            'discount_value.numeric' => 'Giá trị giảm phải là số.',
            'discount_value.min' => 'Giá trị giảm phải lớn hơn hoặc bằng 0.',
            'max_discount_amount.required_if' => 'Vui lòng nhập giá trị giảm tối đa khi chọn loại giảm giá là phần trăm.',
            'max_discount_amount.numeric' => 'Giá trị giảm tối đa phải là số.',
            'max_discount_amount.min' => 'Giá trị giảm tối đa phải lớn hơn hoặc bằng 0.',
            'min_order_value.required' => 'Vui lòng nhập giá trị đơn tối thiểu.',
            'min_order_value.numeric' => 'Giá trị đơn tối thiểu phải là số.',
            'min_order_value.min' => 'Giá trị đơn tối thiểu phải lớn hơn hoặc bằng 0.',
            'usage_limit_per_voucher.required' => 'Vui lòng nhập số lượt dùng tối đa cho mã.',
            'usage_limit_per_voucher.integer' => 'Số lượt dùng tối đa cho mã phải là số nguyên.',
            'usage_limit_per_voucher.min' => 'Số lượt dùng tối đa cho mã phải lớn hơn hoặc bằng 0.',
            'usage_limit_per_user.required' => 'Vui lòng nhập số lượt dùng tối đa mỗi người.',
            'usage_limit_per_user.integer' => 'Số lượt dùng tối đa mỗi người phải là số nguyên.',
            'usage_limit_per_user.min' => 'Số lượt dùng tối đa mỗi người phải lớn hơn hoặc bằng 0.',
            'start_date.required' => 'Vui lòng chọn ngày bắt đầu.',
            'start_date.date' => 'Ngày bắt đầu không hợp lệ.',
            'end_date.required' => 'Vui lòng chọn ngày kết thúc.',
            'end_date.date' => 'Ngày kết thúc không hợp lệ.',
            'end_date.after_or_equal' => 'Ngày kết thúc phải sau hoặc bằng ngày bắt đầu.',
            'is_active.required' => 'Vui lòng chọn trạng thái kích hoạt.',
            'is_active.boolean' => 'Trạng thái kích hoạt không hợp lệ.',
            'applies_to.required' => 'Vui lòng chọn loại áp dụng.',
            'applies_to.in' => 'Loại áp dụng không hợp lệ.',
            'brand_ids.required_if' => 'Vui lòng chọn ít nhất một thương hiệu khi áp dụng cho thương hiệu cụ thể.',
            'brand_ids.array' => 'Danh sách thương hiệu không hợp lệ.',
            'brand_ids.min' => 'Vui lòng chọn ít nhất một thương hiệu.',
            'category_ids.required_if' => 'Vui lòng chọn ít nhất một danh mục khi áp dụng cho danh mục cụ thể.',
            'category_ids.array' => 'Danh sách danh mục không hợp lệ.',
            'category_ids.min' => 'Vui lòng chọn ít nhất một danh mục.',
        ];

        $data = $request->validate($rules, $messages);

        $promotion->update($data);

        if ($request->applies_to == 'specific_categories') {
            $promotion->categories()->sync($request->category_ids ?? []);
            $promotion->brands()->sync([]);
        } elseif ($request->applies_to == 'specific_brands') {
            $promotion->brands()->sync($request->brand_ids ?? []);
            $promotion->categories()->sync([]);
        } else {
            $promotion->categories()->sync([]);
            $promotion->brands()->sync([]);
        }

        return redirect()->route('admin.promotions.index')
            ->with('success', 'Cập nhật khuyến mãi thành công!');
    }
}