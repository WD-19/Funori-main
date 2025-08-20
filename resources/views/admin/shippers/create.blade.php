@extends('admin.layout.admin')

@section('title', 'Thêm Shipper Mới')

@section('content')
<div class="main-content-inner">
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-27">
            <h3>Thêm Shipper Mới</h3>
            <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                <li><a href="{{ route('admin.dashboard') }}"><div class="text-tiny">Dashboard</div></a></li>
                <li><i class="icon-chevron-right"></i></li>
                <li><a href="{{ route('admin.shippers.index') }}"><div class="text-tiny">Shipper</div></a></li>
                <li><i class="icon-chevron-right"></i></li>
                <li><div class="text-tiny">Thêm Mới</div></li>
            </ul>
        </div>

        <div class="wg-box">
            <form class="form-new-product form-style-1" action="{{ route('admin.shippers.store') }}" method="POST">
                @csrf
                
                <fieldset class="name">
                    <div class="body-title">Tên Shipper <span class="tf-color-1">*</span></div>
                    <input class="flex-grow" type="text" placeholder="Nhập tên shipper" name="name" 
                           value="{{ old('name') }}" required>
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </fieldset>

                <fieldset class="name">
                    <div class="body-title">Email <span class="tf-color-1">*</span></div>
                    <input class="flex-grow" type="email" placeholder="Nhập email" name="email" 
                           value="{{ old('email') }}" required>
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </fieldset>

                <fieldset class="name">
                    <div class="body-title">Mật Khẩu <span class="tf-color-1">*</span></div>
                    <input class="flex-grow" type="password" placeholder="Nhập mật khẩu (tối thiểu 6 ký tự)" 
                           name="password" required>
                    @error('password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </fieldset>

                <fieldset class="name">
                    <div class="body-title">Số Điện Thoại</div>
                    <input class="flex-grow" type="text" placeholder="Nhập số điện thoại" name="phone" 
                           value="{{ old('phone') }}">
                    @error('phone')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </fieldset>

                <fieldset class="description">
                    <div class="body-title">Địa Chỉ</div>
                    <textarea class="mb-10" placeholder="Nhập địa chỉ shipper" name="address" 
                              rows="4">{{ old('address') }}</textarea>
                    @error('address')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </fieldset>

                <fieldset class="category">
                    <div class="body-title">Trạng Thái <span class="tf-color-1">*</span></div>
                    <div class="select flex-grow">
                        <select class="" name="status" required>
                            <option value="">Chọn trạng thái</option>
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>
                                Hoạt Động
                            </option>
                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>
                                Tạm Ngưng
                            </option>
                        </select>
                    </div>
                    @error('status')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </fieldset>

                <div class="bot">
                    <div></div>
                    <div class="flex gap10">
                        <a href="{{ route('admin.shippers.index') }}" class="tf-button style-3 w208">
                            <i class="icon-arrow-left"></i> Quay Lại
                        </a>
                        <button class="tf-button w208" type="submit">
                            <i class="icon-plus"></i> Tạo Shipper
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.form-new-product fieldset {
    margin-bottom: 20px;
}

.text-danger {
    color: #dc3545;
    font-size: 12px;
    margin-top: 5px;
}

.tf-color-1 {
    color: #dc3545;
}

.body-title {
    font-weight: 600;
    margin-bottom: 8px;
    color: #333;
}

.flex-grow {
    width: 100%;
    padding: 12px;
    border: 1px solid #ddd;
    border-radius: 6px;
    font-size: 14px;
}

.flex-grow:focus {
    border-color: #007bff;
    outline: none;
    box-shadow: 0 0 0 2px rgba(0,123,255,.25);
}

.select select {
    width: 100%;
    padding: 12px;
    border: 1px solid #ddd;
    border-radius: 6px;
    font-size: 14px;
    background-color: white;
}

.select select:focus {
    border-color: #007bff;
    outline: none;
    box-shadow: 0 0 0 2px rgba(0,123,255,.25);
}

textarea.mb-10 {
    width: 100%;
    padding: 12px;
    border: 1px solid #ddd;
    border-radius: 6px;
    font-size: 14px;
    resize: vertical;
    min-height: 100px;
}

textarea.mb-10:focus {
    border-color: #007bff;
    outline: none;
    box-shadow: 0 0 0 2px rgba(0,123,255,.25);
}

.bot {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 30px;
    padding-top: 20px;
    border-top: 1px solid #eee;
}

.tf-button {
    padding: 12px 24px;
    border-radius: 6px;
    text-decoration: none;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
}

.tf-button.w208 {
    min-width: 150px;
    justify-content: center;
}

.tf-button:not(.style-3) {
    background: #007bff;
    color: white;
}

.tf-button:not(.style-3):hover {
    background: #0056b3;
    transform: translateY(-1px);
}

.tf-button.style-3 {
    background: #6c757d;
    color: white;
}

.tf-button.style-3:hover {
    background: #545b62;
    transform: translateY(-1px);
}
</style>
@endsection