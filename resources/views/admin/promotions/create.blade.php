@extends('admin.layout.admin')

@section('title', 'Thêm khuyến mãi')

@section('content')
    <div class="flex items-center flex-wrap justify-between gap20 mb-30">
        <h3>Thêm khuyến mãi</h3>
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
                <div class="text-tiny">Thêm khuyến mãi</div>
            </li>
        </ul>
    </div>
    <form class="form-add-promotion" method="POST" action="{{ route('admin.promotions.store') }}">
        @csrf
        <div class="wg-box mb-30">
            <fieldset class="name">
                <div class="body-title mb-10">Tên khuyến mãi <span class="tf-color-1">*</span></div>
                <input class="mb-10" type="text" placeholder="Nhập tên khuyến mãi" name="name" maxlength="100"
                    value="{{ old('name') }}">
                @error('name')
                    <div class="text-danger mt-2">{{ $message }}</div>
                @enderror
            </fieldset>
            <fieldset class="code">
                <div class="body-title mb-10">Mã khuyến mãi <span class="tf-color-1">*</span></div>
                <input class="mb-10" type="text" placeholder="Nhập mã hoặc tạo tự động" name="code" id="promotion_code" maxlength="50"
                    value="{{ old('code') }}" style="width: 70%; display: inline-block;">
                <button type="button" id="generate_code" style="padding: 8px 16px; background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; margin-left: 10px;">
                    Tạo mã
                </button>
                @error('code')
                    <div class="text-danger mt-2">{{ $message }}</div>
                @enderror
            </fieldset>
            <fieldset class="discount_type">
                <div class="body-title mb-10">Loại giảm giá <span class="tf-color-1">*</span></div>
                <select name="discount_type">
                    <option value="percentage" {{ old('discount_type') == 'percentage' ? 'selected' : '' }}>Phần trăm (%)
                    </option>
                    <option value="fixed_amount" {{ old('discount_type') == 'fixed_amount' ? 'selected' : '' }}>Tiền mặt
                        (VNĐ)</option>
                </select>
                @error('discount_type')
                    <div class="text-danger mt-2">{{ $message }}</div>
                @enderror
            </fieldset>
            <fieldset class="discount_value">
                <div class="body-title mb-10">Giá trị giảm <span class="tf-color-1">*</span></div>
                <input type="text" name="discount_value"
                    value="{{ old('discount_value') ? number_format((float)old('discount_value'), 0, ',', '.') : '' }}"
                    placeholder="Nhập số (VD: 2000000 hoặc 2.000.000)">
                @error('discount_value')
                    <div class="text-danger mt-2">{{ $message }}</div>
                @enderror
            </fieldset>
            <fieldset class="max_discount_amount">
                <div class="body-title mb-10">Giảm tối đa (nếu là %)</div>
                <input type="text" name="max_discount_amount"
                    value="{{ old('max_discount_amount') ? number_format((float)old('max_discount_amount'), 0, ',', '.') : '' }}"
                    placeholder="Nhập số (VD: 500000 hoặc 500.000)">
                @error('max_discount_amount')
                    <div class="text-danger mt-2">{{ $message }}</div>
                @enderror
            </fieldset>
            <fieldset class="min_order_value">
                <div class="body-title mb-10">Đơn tối thiểu áp dụng <span class="tf-color-1">*</span></div>
                <input type="text" name="min_order_value"
                    value="{{ old('min_order_value') ? number_format((float)old('min_order_value'), 0, ',', '.') : '' }}"
                    placeholder="Nhập số (VD: 1000000 hoặc 1.000.000)">
                @error('min_order_value')
                    <div class="text-danger mt-2">{{ $message }}</div>
                @enderror
            </fieldset>
            <fieldset class="usage_limit_per_voucher">
                <div class="body-title mb-10">Số lượt dùng tối đa cho mã <span class="tf-color-1">*</span></div>
                <input type="number" name="usage_limit_per_voucher"
                    value="{{ old('usage_limit_per_voucher') }}" placeholder="Nhập số (VD: 100)">
                @error('usage_limit_per_voucher')
                    <div class="text-danger mt-2">{{ $message }}</div>
                @enderror
            </fieldset>
            <fieldset class="usage_limit_per_user">
                <div class="body-title mb-10">Số lượt dùng tối đa mỗi người <span class="tf-color-1">*</span></div>
                <input type="number" name="usage_limit_per_user" value="{{ old('usage_limit_per_user') }}" placeholder="Nhập số (VD: 5)">
                @error('usage_limit_per_user')
                    <div class="text-danger mt-2">{{ $message }}</div>
                @enderror
            </fieldset>
            <fieldset class="start_date">
                <div class="body-title mb-10">Ngày bắt đầu <span class="tf-color-1">*</span></div>
                <input type="date" name="start_date" value="{{ old('start_date') }}">
                @error('start_date')
                    <div class="text-danger mt-2">{{ $message }}</div>
                @enderror
            </fieldset>
            <fieldset class="end_date">
                <div class="body-title mb-10">Ngày kết thúc <span class="tf-color-1">*</span></div>
                <input type="date" name="end_date" value="{{ old('end_date') }}">
                @error('end_date')
                    <div class="text-danger mt-2">{{ $message }}</div>
                @enderror
            </fieldset>
            <fieldset class="applies_to">
                <div class="body-title mb-10">Áp dụng cho <span class="tf-color-1">*</span></div>
                <select name="applies_to" id="applies_to">
                    <option value="all_products" {{ old('applies_to') == 'all_products' ? 'selected' : '' }}>Tất cả sản
                        phẩm</option>
                    <option value="specific_brands" {{ old('applies_to') == 'specific_brands' ? 'selected' : '' }}>Thương
                        hiệu cụ thể</option>
                    <option value="specific_categories" {{ old('applies_to') == 'specific_categories' ? 'selected' : '' }}>
                        Danh mục cụ thể</option>
                </select>
                @error('applies_to')
                    <div class="text-danger mt-2">{{ $message }}</div>
                @enderror
            </fieldset>
            <fieldset id="brand-select-field" style="display:none;">
                <div class="body-title mb-10">Chọn thương hiệu áp dụng</div>
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
                    <div class="text-danger mt-2">{{ $message }}</div>
                @enderror
            </fieldset>
            <fieldset id="category-select-field" style="display:none;">
                <div class="body-title mb-10">Chọn danh mục áp dụng</div>
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
                    <div class="text-danger mt-2">{{ $message }}</div>
                @enderror
            </fieldset>
            <fieldset class="description">
                <div class="body-title mb-10">Mô tả</div>
                <textarea name="description">{{ old('description') }}</textarea>
                @error('description')
                    <div class="text-danger mt-2">{{ $message }}</div>
                @enderror
            </fieldset>
            <fieldset class="is_active">
                <div class="body-title mb-10">Kích hoạt</div>
                <select name="is_active">
                    <option value="1" {{ old('is_active', 1) == 1 ? 'selected' : '' }}>Có</option>
                    <option value="0" {{ old('is_active', 1) == 0 ? 'selected' : '' }}>Không</option>
                </select>
                @error('is_active')
                    <div class="text-danger mt-2">{{ $message }}</div>
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
            document.getElementById('brand-select-field').style.display = appliesTo === 'specific_brands' ? '' : 'none';
            document.getElementById('category-select-field').style.display = appliesTo === 'specific_categories' ? '' :
                'none';
        }
                document.getElementById('applies_to').addEventListener('change', togglePromotionFields);
        window.addEventListener('DOMContentLoaded', togglePromotionFields);

        // Generate promotion code
        document.getElementById('generate_code').addEventListener('click', function() {
            const code = generatePromotionCode();
            document.getElementById('promotion_code').value = code;
        });

        function generatePromotionCode() {
            const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            let result = '';
            for (let i = 0; i < 8; i++) {
                result += chars.charAt(Math.floor(Math.random() * chars.length));
            }
            return result;
        }
    </script>
@endsection
