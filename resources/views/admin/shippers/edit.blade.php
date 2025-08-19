@extends('admin.layout.admin')

@section('title', 'Chỉnh Sửa Shipper')

@section('content')
<div class="main-content-inner">
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-27">
            <h3>Chỉnh Sửa Shipper: {{ $shipper->name }}</h3>
            <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                <li><a href="{{ route('admin.dashboard') }}"><div class="text-tiny">Dashboard</div></a></li>
                <li><i class="icon-chevron-right"></i></li>
                <li><a href="{{ route('admin.shippers.index') }}"><div class="text-tiny">Shipper</div></a></li>
                <li><i class="icon-chevron-right"></i></li>
                <li><div class="text-tiny">Chỉnh Sửa</div></li>
            </ul>
        </div>

        <div class="wg-box">
            <form class="form-new-product form-style-1" action="{{ route('admin.shippers.update', $shipper) }}" method="POST">
                @csrf
                @method('PUT')
                
                <fieldset class="name">
                    <div class="body-title">Tên Shipper <span class="tf-color-1">*</span></div>
                    <input class="flex-grow" type="text" placeholder="Nhập tên shipper" name="name" 
                           value="{{ old('name', $shipper->name) }}" required>
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </fieldset>

                <fieldset class="name">
                    <div class="body-title">Email <span class="tf-color-1">*</span></div>
                    <input class="flex-grow" type="email" placeholder="Nhập email" name="email" 
                           value="{{ old('email', $shipper->email) }}" required>
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </fieldset>

                <fieldset class="name">
                    <div class="body-title">Mật Khẩu <small class="text-muted">(để trống nếu không đổi)</small></div>
                    <input class="flex-grow" type="password" placeholder="Nhập mật khẩu mới (tối thiểu 6 ký tự)" 
                           name="password">
                    @error('password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </fieldset>

                <fieldset class="name">
                    <div class="body-title">Số Điện Thoại</div>
                    <input class="flex-grow" type="text" placeholder="Nhập số điện thoại" name="phone" 
                           value="{{ old('phone', $shipper->phone) }}">
                    @error('phone')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </fieldset>

                <fieldset class="description">
                    <div class="body-title">Địa Chỉ</div>
                    <textarea class="mb-10" placeholder="Nhập địa chỉ shipper" name="address" 
                              rows="4">{{ old('address', $shipper->address) }}</textarea>
                    @error('address')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </fieldset>

                <fieldset class="category">
                    <div class="body-title">Trạng Thái <span class="tf-color-1">*</span></div>
                    <div class="select flex-grow">
                        <select class="" name="status" required>
                            <option value="">Chọn trạng thái</option>
                            <option value="active" {{ old('status', $shipper->status) == 'active' ? 'selected' : '' }}>
                                Hoạt Động
                            </option>
                            <option value="inactive" {{ old('status', $shipper->status) == 'inactive' ? 'selected' : '' }}>
                                Tạm Ngưng
                            </option>
                        </select>
                    </div>
                    @error('status')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </fieldset>

                <!-- Thông tin thống kê -->
                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="card bg-light">
                            <div class="card-body">
                                <h6 class="card-title">Thống Kê Shipper</h6>
                                <p class="mb-1"><strong>Tổng đơn hàng:</strong> {{ $shipper->orders()->count() }}</p>
                                <p class="mb-1"><strong>Đơn đang xử lý:</strong> {{ $shipper->orders()->whereIn('order_status', ['processing', 'shipped'])->count() }}</p>
                                <p class="mb-0"><strong>Ngày tham gia:</strong> {{ $shipper->created_at->format('d/m/Y') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card bg-light">
                            <div class="card-body">
                                <h6 class="card-title">Trạng Thái Hiện Tại</h6>
                                <p class="mb-1">
                                    <strong>Tình trạng:</strong> 
                                    @if($shipper->status === 'active')
                                        <span class="badge bg-success">Hoạt Động</span>
                                    @else
                                        <span class="badge bg-warning">Tạm Ngưng</span>
                                    @endif
                                </p>
                                <p class="mb-0"><strong>Cập nhật lần cuối:</strong> {{ $shipper->updated_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bot">
                    <div></div>
                    <div class="flex gap10">
                        <a href="{{ route('admin.shippers.index') }}" class="tf-button style-3 w208">
                            <i class="icon-arrow-left"></i> Quay Lại
                        </a>
                        <a href="{{ route('admin.shippers.show', $shipper) }}" class="tf-button style-2 w208">
                            <i class="icon-eye"></i> Xem Chi Tiết
                        </a>
                        <button class="tf-button w208" type="submit">
                            <i class="icon-check"></i> Cập Nhật
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

.text-muted {
    color: #6c757d;
    font-size: 12px;
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

.card {
    border: 1px solid #dee2e6;
    border-radius: 8px;
    margin-bottom: 20px;
}

.card-body {
    padding: 20px;
}

.card-title {
    font-weight: 600;
    margin-bottom: 15px;
    color: #333;
}

.badge {
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 11px;
    font-weight: 500;
}

.bg-success {
    background-color: #28a745 !important;
    color: white;
}

.bg-warning {
    background-color: #ffc107 !important;
    color: #212529;
}

.bg-light {
    background-color: #f8f9fa !important;
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

.tf-button:not(.style-3):not(.style-2) {
    background: #007bff;
    color: white;
}

.tf-button:not(.style-3):not(.style-2):hover {
    background: #0056b3;
    transform: translateY(-1px);
}

.tf-button.style-2 {
    background: #17a2b8;
    color: white;
}

.tf-button.style-2:hover {
    background: #138496;
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

.row {
    display: flex;
    flex-wrap: wrap;
    margin: 0 -15px;
}

.col-md-6 {
    flex: 0 0 50%;
    max-width: 50%;
    padding: 0 15px;
}

@media (max-width: 768px) {
    .col-md-6 {
        flex: 0 0 100%;
        max-width: 100%;
    }
}
</style>
@endsection