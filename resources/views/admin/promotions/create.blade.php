@extends('admin.layout.admin')

@section('title', 'Thêm khuyến mãi')

@section('content')
    <div class="flex items-center flex-wrap justify-between gap20 mb-30">
        <h3>Thêm khuyến mãi</h3>
        <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
            <li>
                <a href="{{ route('admin.dashboard') }}">
                    <div class="text-tiny">Bảng điều khiển</div>
                </a>
            </li>
            <li><i class="icon-chevron-right"></i></li>
            <li>
                <a href="{{ route('admin.promotions.index') }}">
                    <div class="text-tiny">Mã giảm giá</div>
                </a>
            </li>
            <li><i class="icon-chevron-right"></i></li>
            <li>
                <div class="text-tiny">Thêm khuyến mãi</div>
            </li>
        </ul>
    </div>
    <form class="form-add-promotion" method="POST" action="{{ route('admin.promotions.store') }}">
        @csrf
        <div class="wg-box mb-30">
            <fieldset class="name">
                <div class="body-title mb-10">Tên khuyến mãi <span class="tf-color-1">*</span></div>
                <input class="mb-10" type="text" placeholder="Nhập tên khuyến mãi" name="name" maxlength="100" required value="{{ old('name') }}" id="name">
                @error('name')
                    <div class="text-danger text-sm mt-1">{{ $message }}</div>
                @enderror
            </fieldset>
            <fieldset class="code">
                <div class="body-title mb-10">Mã khuyến mãi <span class="tf-color-1">*</span></div>
                <input class="mb-10" type="text" placeholder="Nhập mã" name="code" maxlength="50" required value="{{ old('code') }}" id="code">
                @error('code')
                    <div class="text-danger text-sm mt-1">{{ $message }}</div>
                @enderror
            </fieldset>
            <fieldset class="discount_type">
                <div class="body-title mb-10">Loại giảm giá <span class="tf-color-1">*</span></div>
                <select name="discount_type" id="discount_type" required>
                    <option value="percentage" {{ old('discount_type') == 'percentage' ? 'selected' : '' }}>Phần trăm (%)</option>
                    <option value="fixed_amount" {{ old('discount_type') == 'fixed_amount' ? 'selected' : '' }}>Tiền mặt (VNĐ)</option>
                </select>
                @error('discount_type')
                    <div class="text-danger text-sm mt-1">{{ $message }}</div>
                @enderror
            </fieldset>
            <fieldset class="discount_value">
                <div class="body-title mb-10">Giá trị giảm <span class="tf-color-1">*</span></div>
                <input type="number" name="discount_value" min="0" step="0.01" required value="{{ old('discount_value') }}">
                @error('discount_value')
                    <div class="text-danger text-sm mt-1">{{ $message }}</div>
                @enderror
            </fieldset>
            <fieldset class="max_discount_amount" id="max_discount_amount_field">
                <div class="body-title mb-10">Giảm tối đa (nếu là %) <span class="tf-color-1" id="max_discount_required">*</span></div>
                <input type="number" name="max_discount_amount" min="0" step="0.01" value="{{ old('max_discount_amount') }}">
                @error('max_discount_amount')
                    <div class="text-danger text-sm mt-1">{{ $message }}</div>
                @enderror
            </fieldset>
            <fieldset class="min_order_value">
                <div class="body-title mb-10">Đơn tối thiểu áp dụng <span class="tf-color-1">*</span></div>
                <input type="number" name="min_order_value" min="0" step="0.01" required value="{{ old('min_order_value') }}">
                @error('min_order_value')
                    <div class="text-danger text-sm mt-1">{{ $message }}</div>
                @enderror
            </fieldset>
            <fieldset class="usage_limit_per_voucher">
                <div class="body-title mb-10">Số lượt dùng tối đa cho mã <span class="tf-color-1">*</span></div>
                <input type="number" name="usage_limit_per_voucher" min="0" required value="{{ old('usage_limit_per_voucher') }}">
                @error('usage_limit_per_voucher')
                    <div class="text-danger text-sm mt-1">{{ $message }}</div>
                @enderror
            </fieldset>
            <fieldset class="usage_limit_per_user">
                <div class="body-title mb-10">Số lượt dùng tối đa mỗi người <span class="tf-color-1">*</span></div>
                <input type="number" name="usage_limit_per_user" min="0" required value="{{ old('usage_limit_per_user') }}">
                @error('usage_limit_per_user')
                    <div class="text-danger text-sm mt-1">{{ $message }}</div>
                @enderror
            </fieldset>
            <fieldset class="start_date">
                <div class="body-title mb-10">Ngày bắt đầu <span class="tf-color-1">*</span></div>
                <input type="date" name="start_date" required value="{{ old('start_date') }}">
                @error('start_date')
                    <div class="text-danger text-sm mt-1">{{ $message }}</div>
                @enderror
            </fieldset>
            <fieldset class="end_date">
                <div class="body-title mb-10">Ngày kết thúc <span class="tf-color-1">*</span></div>
                <input type="date" name="end_date" required value="{{ old('end_date') }}">
                @error('end_date')
                    <div class="text-danger text-sm mt-1">{{ $message }}</div>
                @enderror
            </fieldset>
            <fieldset class="applies_to">
                <div class="body-title mb-10">Áp dụng cho <span class="tf-color-1">*</span></div>
                <select name="applies_to" id="applies_to" required>
                    <option value="all_products" {{ old('applies_to') == 'all_products' ? 'selected' : '' }}>Tất cả sản phẩm</option>
                    <option value="specific_brands" {{ old('applies_to') == 'specific_brands' ? 'selected' : '' }}>Thương hiệu cụ thể</option>
                    <option value="specific_categories" {{ old('applies_to') == 'specific_categories' ? 'selected' : '' }}>Danh mục cụ thể</option>
                </select>
                @error('applies_to')
                    <div class="text-danger text-sm mt-1">{{ $message }}</div>
                @enderror
            </fieldset>
            <fieldset id="brand-select-field" style="display:none;">
                <div class="body-title mb-10">Chọn thương hiệu áp dụng <span class="tf-color-1">*</span></div>
                <div class="row">
                    @foreach ($brands as $brand)
                        <div class="col-md-4 mb-2">
                            <label>
                                <input type="checkbox" name="brand_ids[]" value="{{ $brand->id }}"
                                    {{ collect(old('brand_ids'))->contains($brand->id) ? 'checked' : '' }}>
                                {{ $brand->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
                @error('brand_ids')
                    <div class="text-danger text-sm mt-1">{{ $message }}</div>
                @enderror
            </fieldset>
            <fieldset id="category-select-field" style="display:none;">
                <div class="body-title mb-10">Chọn danh mục áp dụng <span class="tf-color-1">*</span></div>
                <div class="row">
                    @foreach ($categories as $category)
                        <div class="col-md-4 mb-2">
                            <label>
                                <input type="checkbox" name="category_ids[]" value="{{ $category->id }}"
                                    {{ collect(old('category_ids'))->contains($category->id) ? 'checked' : '' }}>
                                {{ $category->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
                @error('category_ids')
                    <div class="text-danger text-sm mt-1">{{ $message }}</div>
                @enderror
            </fieldset>
            <fieldset class="description">
                <div class="body-title mb-10">Mô tả</div>
                <textarea name="description">{{ old('description') }}</textarea>
                @error('description')
                    <div class="text-danger text-sm mt-1">{{ $message }}</div>
                @enderror
            </fieldset>
            <fieldset class="is_active">
                <div class="body-title mb-10">Kích hoạt <span class="tf-color-1">*</span></div>
                <select name="is_active" required>
                    <option value="1" {{ old('is_active', 1) == 1 ? 'selected' : '' }}>Có</option>
                    <option value="0" {{ old('is_active', 1) == 0 ? 'selected' : '' }}>Không</option>
                </select>
                @error('is_active')
                    <div class="text-danger text-sm mt-1">{{ $message }}</div>
                @enderror
            </fieldset>
        </div>
        <div class="row mt-5">
            <div class="col-md-6">
                <button type="submit" class="tf-button w-100 py-3 fs-5">
                    <i class="bi bi-pencil-square me-1"></i> Thêm Mới
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
            var discountType = document.getElementById('discount_type').value;
            document.getElementById('brand-select-field').style.display = appliesTo === 'specific_brands' ? '' : 'none';
            document.getElementById('category-select-field').style.display = appliesTo === 'specific_categories' ? '' : 'none';
            var maxDiscountField = document.getElementById('max_discount_amount_field');
            var maxDiscountInput = maxDiscountField.querySelector('input[name="max_discount_amount"]');
            var maxDiscountRequired = document.getElementById('max_discount_required');
            if (discountType === 'percentage') {
                maxDiscountField.style.display = '';
                maxDiscountInput.setAttribute('required', 'required');
                maxDiscountRequired.style.display = '';
            } else {
                maxDiscountField.style.display = 'none';
                maxDiscountInput.removeAttribute('required');
                maxDiscountRequired.style.display = 'none';
            }
        }

        function convertToUpperCase(inputId) {
            var input = document.getElementById(inputId);
            input.addEventListener('input', function() {
                this.value = this.value.toUpperCase();
            });
        }

        document.getElementById('applies_to').addEventListener('change', togglePromotionFields);
        document.getElementById('discount_type').addEventListener('change', togglePromotionFields);
        window.addEventListener('DOMContentLoaded', togglePromotionFields);
        convertToUpperCase('name');
        convertToUpperCase('code');
    </script>
@endsection