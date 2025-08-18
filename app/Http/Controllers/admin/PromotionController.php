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
        // Debug: Log request data
        \Log::info('Store request data:', $request->all());
        
        // Format currency inputs before validation
        $request->merge([
            'discount_value' => $this->formatCurrency($request->discount_value),
            'max_discount_amount' => $this->formatCurrency($request->max_discount_amount),
            'min_order_value' => $this->formatCurrency($request->min_order_value),
        ]);

        $rules = [
            'name' => 'required|string|max:255|min:3',
            'code' => 'required|string|max:50|unique:promotions,code|regex:/^[A-Z0-9]+$/',
            'description' => 'nullable|string|max:1000',
            'discount_type' => 'required|in:percentage,fixed_amount',
            'discount_value' => 'required|numeric|min:0|max:999999999',
            'max_discount_amount' => 'nullable|numeric|min:0|max:999999999',
            'min_order_value' => 'required|numeric|min:0|max:999999999',
            'usage_limit_per_voucher' => 'required|integer|min:0|max:999999',
            'usage_limit_per_user' => 'required|integer|min:0|max:999999',
            'start_date' => 'required|date|before_or_equal:end_date',
            'end_date' => 'required|date|after_or_equal:start_date|after_or_equal:today',
            'is_active' => 'boolean',
            'applies_to' => 'required|in:all_products,specific_brands,specific_categories',
            'brand_ids' => 'required_if:applies_to,specific_brands|array|min:1',
            'brand_ids.*' => 'integer|exists:brands,id',
            'category_ids' => 'required_if:applies_to,specific_categories|array|min:1',
            'category_ids.*' => 'integer|exists:categories,id',
        ];

        // Chỉ validate khi đúng loại
        if ($request->applies_to == 'specific_brands') {
            $rules['brand_ids'] = 'required|array|min:1';
        }
        if ($request->applies_to == 'specific_categories') {
            $rules['category_ids'] = 'required|array|min:1';
        }

        $data = $request->validate($rules, [
            'name.required' => 'Tên khuyến mãi không được để trống.',
            'name.min' => 'Tên khuyến mãi phải có ít nhất 3 ký tự.',
            'name.max' => 'Tên khuyến mãi không được vượt quá 255 ký tự.',
            'code.unique' => 'Mã giảm giá này đã tồn tại. Vui lòng chọn mã khác.',
            'code.regex' => 'Mã giảm giá chỉ được chứa chữ cái in hoa và số.',
            'code.max' => 'Mã giảm giá không được vượt quá 50 ký tự.',
            'description.max' => 'Mô tả không được vượt quá 1000 ký tự.',
            'discount_type.required' => 'Vui lòng chọn loại giảm giá.',
            'discount_type.in' => 'Loại giảm giá không hợp lệ.',
            'discount_value.required' => 'Giá trị giảm không được để trống.',
            'discount_value.numeric' => 'Giá trị giảm phải là số.',
            'discount_value.min' => 'Giá trị giảm phải lớn hơn 0.',
            'discount_value.max' => 'Giá trị giảm không được vượt quá 999,999,999.',
            'max_discount_amount.numeric' => 'Giảm tối đa phải là số.',
            'max_discount_amount.min' => 'Giảm tối đa phải lớn hơn 0.',
            'max_discount_amount.max' => 'Giảm tối đa không được vượt quá 999,999,999.',
            'min_order_value.numeric' => 'Đơn tối thiểu phải là số.',
            'min_order_value.min' => 'Đơn tối thiểu phải lớn hơn 0.',
            'min_order_value.max' => 'Đơn tối thiểu không được vượt quá 999,999,999.',
            'usage_limit_per_voucher.integer' => 'Số lượt dùng tối đa phải là số nguyên.',
            'usage_limit_per_voucher.min' => 'Số lượt dùng tối đa phải lớn hơn 0.',
            'usage_limit_per_voucher.max' => 'Số lượt dùng tối đa không được vượt quá 999,999.',
            'usage_limit_per_user.integer' => 'Số lượt dùng mỗi người phải là số nguyên.',
            'usage_limit_per_user.min' => 'Số lượt dùng mỗi người phải lớn hơn 0.',
            'usage_limit_per_user.max' => 'Số lượt dùng mỗi người không được vượt quá 999,999.',
            'start_date.date' => 'Ngày bắt đầu không hợp lệ.',
            'start_date.before_or_equal' => 'Ngày bắt đầu phải trước hoặc bằng ngày kết thúc.',
            'end_date.date' => 'Ngày kết thúc không hợp lệ.',
            'end_date.after_or_equal' => 'Ngày kết thúc phải sau hoặc bằng ngày bắt đầu và không trước hôm nay.',
            'applies_to.required' => 'Vui lòng chọn đối tượng áp dụng.',
            'applies_to.in' => 'Đối tượng áp dụng không hợp lệ.',
            'brand_ids.required_if' => 'Vui lòng chọn ít nhất một thương hiệu.',
            'brand_ids.min' => 'Vui lòng chọn ít nhất một thương hiệu.',
            'brand_ids.*.integer' => 'ID thương hiệu không hợp lệ.',
            'brand_ids.*.exists' => 'Thương hiệu không tồn tại.',
            'category_ids.required_if' => 'Vui lòng chọn ít nhất một danh mục.',
            'category_ids.min' => 'Vui lòng chọn ít nhất một danh mục.',
            'category_ids.*.integer' => 'ID danh mục không hợp lệ.',
            'category_ids.*.exists' => 'Danh mục không tồn tại.',
            'start_date.required' => 'Ngày bắt đầu không được để trống.',
            'end_date.required' => 'Ngày kết thúc không được để trống.',
            'code.string' => 'Mã giảm giá phải là chuỗi.',
            'description.string' => 'Mô tả phải là chuỗi.',
            'name.string' => 'Tên khuyến mãi phải là chuỗi.',
            'is_active.boolean' => 'Trạng thái kích hoạt không hợp lệ.',
            'code.required' => 'Mã khuyến mãi không được để trống.',
            'min_order_value.required' => 'Đơn tối thiểu không được để trống.',
            'usage_limit_per_voucher.required' => 'Số lượt dùng tối đa không được để trống.',
            'usage_limit_per_user.required' => 'Số lượt dùng mỗi người không được để trống.',
        ]);

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
        
        // Format currency inputs before validation
        $request->merge([
            'discount_value' => $this->formatCurrency($request->discount_value),
            'max_discount_amount' => $this->formatCurrency($request->max_discount_amount),
            'min_order_value' => $this->formatCurrency($request->min_order_value),
        ]);
        
        $rules = [
            'name' => 'required|string|max:255|min:3',
            'code' => 'required|string|max:50|unique:promotions,code,' . $promotion->id . '|regex:/^[A-Z0-9]+$/',
            'description' => 'nullable|string|max:1000',
            'discount_type' => 'required|in:percentage,fixed_amount',
            'discount_value' => 'required|numeric|min:0|max:999999999',
            'max_discount_amount' => 'nullable|numeric|min:0|max:999999999',
            'min_order_value' => 'required|numeric|min:0|max:999999999',
            'usage_limit_per_voucher' => 'required|integer|min:0|max:999999',
            'usage_limit_per_user' => 'required|integer|min:0|max:999999',
            'start_date' => 'required|date|before_or_equal:end_date',
            'end_date' => 'required|date|after_or_equal:start_date|after_or_equal:today',
            'is_active' => 'boolean',
            'applies_to' => 'required|in:all_products,specific_brands,specific_categories',
            'brand_ids' => 'required_if:applies_to,specific_brands|array|min:1',
            'brand_ids.*' => 'integer|exists:brands,id',
            'category_ids' => 'required_if:applies_to,specific_categories|array|min:1',
            'category_ids.*' => 'integer|exists:categories,id',
        ];

        // Chỉ validate khi đúng loại
        if ($request->applies_to == 'specific_brands') {
            $rules['brand_ids'] = 'required|array|min:1';
        }
        if ($request->applies_to == 'specific_categories') {
            $rules['category_ids'] = 'required|array|min:1';
        }

        $data = $request->validate($rules, [
            'name.required' => 'Tên khuyến mãi không được để trống.',
            'name.min' => 'Tên khuyến mãi phải có ít nhất 3 ký tự.',
            'name.max' => 'Tên khuyến mãi không được vượt quá 255 ký tự.',
            'code.unique' => 'Mã giảm giá này đã tồn tại. Vui lòng chọn mã khác.',
            'code.regex' => 'Mã giảm giá chỉ được chứa chữ cái in hoa và số.',
            'code.max' => 'Mã giảm giá không được vượt quá 50 ký tự.',
            'code.required' => 'Mã khuyến mãi không được để trống.',
            'description.max' => 'Mô tả không được vượt quá 1000 ký tự.',
            'discount_type.required' => 'Vui lòng chọn loại giảm giá.',
            'discount_type.in' => 'Loại giảm giá không hợp lệ.',
            'discount_value.required' => 'Giá trị giảm không được để trống.',
            'discount_value.numeric' => 'Giá trị giảm phải là số.',
            'discount_value.min' => 'Giá trị giảm phải lớn hơn 0.',
            'discount_value.max' => 'Giá trị giảm không được vượt quá 999,999,999.',
            'max_discount_amount.numeric' => 'Giảm tối đa phải là số.',
            'max_discount_amount.min' => 'Giảm tối đa phải lớn hơn 0.',
            'max_discount_amount.max' => 'Giảm tối đa không được vượt quá 999,999,999.',
            'min_order_value.numeric' => 'Đơn tối thiểu phải là số.',
            'min_order_value.min' => 'Đơn tối thiểu phải lớn hơn 0.',
            'min_order_value.max' => 'Đơn tối thiểu không được vượt quá 999,999,999.',
            'usage_limit_per_voucher.integer' => 'Số lượt dùng tối đa phải là số nguyên.',
            'usage_limit_per_voucher.min' => 'Số lượt dùng tối đa phải lớn hơn 0.',
            'usage_limit_per_voucher.max' => 'Số lượt dùng tối đa không được vượt quá 999,999.',
            'usage_limit_per_user.integer' => 'Số lượt dùng mỗi người phải là số nguyên.',
            'usage_limit_per_user.min' => 'Số lượt dùng mỗi người phải lớn hơn 0.',
            'usage_limit_per_user.max' => 'Số lượt dùng mỗi người không được vượt quá 999,999.',
            'start_date.date' => 'Ngày bắt đầu không hợp lệ.',
            'start_date.before_or_equal' => 'Ngày bắt đầu phải trước hoặc bằng ngày kết thúc.',
            'end_date.date' => 'Ngày kết thúc không hợp lệ.',
            'end_date.after_or_equal' => 'Ngày kết thúc phải sau hoặc bằng ngày bắt đầu.',
            'end_date.after_or_equal' => 'Ngày kết thúc phải từ hôm nay trở đi.',
            'applies_to.required' => 'Vui lòng chọn đối tượng áp dụng.',
            'applies_to.in' => 'Đối tượng áp dụng không hợp lệ.',
            'brand_ids.required_if' => 'Vui lòng chọn ít nhất một thương hiệu.',
            'brand_ids.min' => 'Vui lòng chọn ít nhất một thương hiệu.',
            'brand_ids.*.integer' => 'ID thương hiệu không hợp lệ.',
            'brand_ids.*.exists' => 'Thương hiệu không tồn tại.',
            'category_ids.required_if' => 'Vui lòng chọn ít nhất một danh mục.',
            'category_ids.min' => 'Vui lòng chọn ít nhất một danh mục.',
            'category_ids.*.integer' => 'ID danh mục không hợp lệ.',
            'category_ids.*.exists' => 'Danh mục không tồn tại.',
            'start_date.required' => 'Ngày bắt đầu không được để trống.',
            'end_date.required' => 'Ngày kết thúc không được để trống.',
            'code.string' => 'Mã giảm giá phải là chuỗi.',
            'description.string' => 'Mô tả phải là chuỗi.',
            'name.string' => 'Tên khuyến mãi phải là chuỗi.',
            'is_active.boolean' => 'Trạng thái kích hoạt không hợp lệ.',
            'min_order_value.required' => 'Đơn tối thiểu không được để trống.',
            'usage_limit_per_voucher.required' => 'Số lượt dùng tối đa không được để trống.',
            'usage_limit_per_user.required' => 'Số lượt dùng mỗi người không được để trống.',
        ]);
        
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

    /**
     * Check if promotion code is available
     */
    public function checkCode(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:50|regex:/^[A-Z0-9]+$/',
            'promotion_id' => 'nullable|integer|exists:promotions,id'
        ], [
            'code.required' => 'Mã giảm giá không được để trống.',
            'code.regex' => 'Mã giảm giá chỉ được chứa chữ cái in hoa và số.',
        ]);

        $code = $request->input('code');
        $promotionId = $request->input('promotion_id');
        
        $query = Promotion::where('code', $code);
        
        // Nếu đang edit, loại trừ promotion hiện tại
        if ($promotionId) {
            $query->where('id', '!=', $promotionId);
        }
        
        $exists = $query->exists();
        
        return response()->json([
            'available' => !$exists,
            'code' => $code,
            'message' => $exists ? 'Mã giảm giá này đã tồn tại.' : 'Mã giảm giá có thể sử dụng.'
        ]);
    }

    /**
     * Format currency input to numeric value
     */
    private function formatCurrency($value)
    {
        if (empty($value)) {
            return null;
        }
        
        // Loại bỏ tất cả ký tự không phải số và dấu chấm
        $value = preg_replace('/[^0-9.]/', '', $value);
        
        // Nếu có dấu chấm, loại bỏ hết dấu chấm
        $value = str_replace('.', '', $value);
        
        // Chuyển đổi thành số
        return (float) $value;
    }

}

