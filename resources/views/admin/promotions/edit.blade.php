@extends('admin.layout.admin')

@section('title', 'Sửa khuyến mãi')

@section('content')
    <div class="flex items-center flex-wrap justify-between gap20 mb-30">
        <h3>Sửa khuyến mãi</h3>
        <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
            <li>
                <a href="{{ route('admin.dashboard') }}">
                    <div class="text-tiny">Dashboard</div>
                </a>
            </li>
            <li><i class="icon-chevron-right"></i></li>
            <li>
                <a href="{{ route('admin.promotions.index') }}">
                    <div class="text-tiny">Promotions</div>
                </a>
            </li>
            <li><i class="icon-chevron-right"></i></li>
            <li>
                <div class="text-tiny">Sửa khuyến mãi</div>
            </li>
        </ul>
    </div>
    <form class="form-edit-promotion" method="POST" action="{{ route('admin.promotions.update', $promotion->id) }}">
        @csrf
        @method('PUT')
        <div class="wg-box mb-30">
            <fieldset class="name">
                <div class="body-title mb-10">Tên khuyến mãi <span class="tf-color-1">*</span></div>
                <input class="mb-10" type="text" placeholder="Nhập tên khuyến mãi" name="name" maxlength="100"
                    required value="{{ old('name', $promotion->name) }}">
            </fieldset>
            <fieldset class="code">
                <div class="body-title mb-10">Mã khuyến mãi</div>
                <input class="mb-10" type="text" placeholder="Nhập mã" name="code" maxlength="50"
                    value="{{ old('code', $promotion->code) }}">
            </fieldset>
            <fieldset class="discount_type">
                <div class="body-title mb-10">Loại giảm giá <span class="tf-color-1">*</span></div>
                <select name="discount_type" required>
                    <option value="percentage" {{ old('discount_type', $promotion->discount_type) == 'percentage' ? 'selected' : '' }}>
                        Phần trăm (%)</option>
                    <option value="fixed_amount" {{ old('discount_type', $promotion->discount_type) == 'fixed_amount' ? 'selected' : '' }}>
                        Tiền mặt (VNĐ)</option>
                </select>
            </fieldset>
            <fieldset class="discount_value">
                <div class="body-title mb-10">Giá trị giảm <span class="tf-color-1">*</span></div>
                <input type="number" name="discount_value" min="0" step="0.01" required
                    value="{{ old('discount_value', $promotion->discount_value) }}">
            </fieldset>
            <fieldset class="max_discount_amount">
                <div class="body-title mb-10">Giảm tối đa (nếu là %)</div>
                <input type="number" name="max_discount_amount" min="0" step="0.01"
                    value="{{ old('max_discount_amount', $promotion->max_discount_amount) }}">
            </fieldset>
            <fieldset class="min_order_value">
                <div class="body-title mb-10">Đơn tối thiểu áp dụng</div>
                <input type="number" name="min_order_value" min="0" step="0.01"
                    value="{{ old('min_order_value', $promotion->min_order_value) }}">
            </fieldset>
            <fieldset class="usage_limit_per_voucher">
                <div class="body-title mb-10">Số lượt dùng tối đa cho mã</div>
                <input type="number" name="usage_limit_per_voucher" min="0"
                    value="{{ old('usage_limit_per_voucher', $promotion->usage_limit_per_voucher) }}">
            </fieldset>
            <fieldset class="usage_limit_per_user">
                <div class="body-title mb-10">Số lượt dùng tối đa mỗi người</div>
                <input type="number" name="usage_limit_per_user" min="0" 
                    value="{{ old('usage_limit_per_user', $promotion->usage_limit_per_user) }}">
            </fieldset>
            <fieldset class="start_date">
                <div class="body-title mb-10">Ngày bắt đầu</div>
                <input type="date" name="start_date" value="{{ old('start_date', $promotion->start_date ? date('Y-m-d', strtotime($promotion->start_date)) : '') }}">
            </fieldset>
            <fieldset class="end_date">
                <div class="body-title mb-10">Ngày kết thúc</div>
                <input type="date" name="end_date" value="{{ old('end_date', $promotion->end_date ? date('Y-m-d', strtotime($promotion->end_date)) : '') }}">
            </fieldset>
            <fieldset class="applies_to">
                <div class="body-title mb-10">Áp dụng cho <span class="tf-color-1">*</span></div>
                <select name="applies_to" id="applies_to" required>
                    <option value="all_products" {{ old('applies_to', $promotion->applies_to) == 'all_products' ? 'selected' : '' }}>
                        Tất cả sản phẩm</option>
                    <option value="specific_brands" {{ old('applies_to', $promotion->applies_to) == 'specific_brands' ? 'selected' : '' }}>
                        Thương hiệu cụ thể</option>
                    <option value="specific_categories" {{ old('applies_to', $promotion->applies_to) == 'specific_categories' ? 'selected' : '' }}>
                        Danh mục cụ thể</option>
                </select>
            </fieldset>
            <fieldset id="brand-select-field" style="display:none;">
                <div class="body-title mb-10">Chọn thương hiệu áp dụng</div>
                <div class="row">
                    @foreach ($brands as $brand)
                        <div class="col-md-4 mb-2">
                            <label>
                                <input type="checkbox" name="brand_ids[]" value="{{ $brand->id }}"
                                    {{ in_array($brand->id, old('brand_ids', $promotion->brands->pluck('id')->toArray())) ? 'checked' : '' }}>
                                {{ $brand->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </fieldset>
            <fieldset id="category-select-field" style="display:none;">
                <div class="body-title mb-10">Chọn danh mục áp dụng</div>
                <div class="row">
                    @foreach ($categories as $category)
                        <div class="col-md-4 mb-2">
                            <label>
                                <input type="checkbox" name="category_ids[]" value="{{ $category->id }}"
                                    {{ in_array($category->id, old('category_ids', $promotion->categories->pluck('id')->toArray())) ? 'checked' : '' }}>
                                {{ $category->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </fieldset>
            <fieldset class="description">
                <div class="body-title mb-10">Mô tả</div>
                <textarea name="description">{{ old('description', $promotion->description) }}</textarea>
            </fieldset>
            <fieldset class="is_active">
                <div class="body-title mb-10">Kích hoạt</div>
                <select name="is_active">
                    <option value="1" {{ old('is_active', $promotion->is_active) == 1 ? 'selected' : '' }}>Có</option>
                    <option value="0" {{ old('is_active', $promotion->is_active) == 0 ? 'selected' : '' }}>Không</option>
                </select>
            </fieldset>
        </div>
        <div class="row mt-5">
            <div class="col-md-6">
                <button type="submit" class="tf-button w-100 py-3 fs-5">
                    <i class="bi bi-save me-1"></i> Lưu Thay Đổi
                </button>
            </div>
            <div class="col-md-6">
                <a href="{{ route('admin.promotions.index') }}" class="tf-button style-3 w-100 py-3 fs-5">
                    <i class="bi bi-list me-1"></i> Danh sách
                </a>
            </div>
        </div>
    </form>

    <script>
        function togglePromotionFields() {
            var appliesTo = document.getElementById('applies_to').value;
            document.getElementById('brand-select-field').style.display = appliesTo === 'specific_brands' ? '' : 'none';
            document.getElementById('category-select-field').style.display = appliesTo === 'specific_categories' ? '' : 'none';
        }
        document.getElementById('applies_to').addEventListener('change', togglePromotionFields);
        window.addEventListener('DOMContentLoaded', togglePromotionFields);
    </script>
@endsection
