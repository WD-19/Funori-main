@extends('admin.layout.admin')
@section('title', 'Chỉnh sửa phương thức giao hàng')
@section('content')
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-30">
                <h3>Chỉnh sửa phương thức giao hàng</h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li>
                        <a href="{{ route('admin.dashboard') }}">
                            <div class="text-tiny">Bảng điều khiển</div>
                        </a>
                    </li>
                    <li><i class="icon-chevron-right"></i></li>
                    <li>
                        <a href="{{ route('admin.shipping_methods.index') }}">
                            <div class="text-tiny">Phương thức giao hàng</div>
                        </a>
                    </li>
                    <li><i class="icon-chevron-right"></i></li>
                    <li>
                        <div class="text-tiny">Chỉnh sửa</div>
                    </li>
                </ul>
            </div>
            <div class="wg-box">
                <form method="POST" action="{{ route('admin.shipping_methods.update', $method->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group mb-3">
                        <label for="name" class="body-title">Tên phương thức</label>
                        <input type="text" name="name" id="name" class="input-field" value="{{ old('name', $method->name) }}" >
                        @error('name')<div class="text-danger" style="font-size:16px;font-weight:bold; margin-top:4px;">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="cost" class="body-title">Chi phí giao hàng</label>
                        <input type="number" name="cost" id="cost" class="input-field" value="{{ old('cost', $method->cost) }}"  min="0" step="0.01">
                        @error('cost')<div class="text-danger" style="font-size:16px;font-weight:bold; margin-top:4px;">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="description" class="body-title">Mô tả</label>
                        <textarea name="description" id="description" class="input-field" rows="2">{{ old('description', $method->description) }}</textarea>
                        @error('description')<div class="text-danger" style="font-size:16px;font-weight:bold; margin-top:4px;">{{ $message }}</div>@enderror
                    </div>
                    <div style="display: flex; gap: 12px; align-items: center; margin-top: 8px;">
                        <button type="submit" class="tf-button style-1">Cập nhật</button>
                        <a href="{{ route('admin.shipping_methods.index') }}" class="tf-button">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
