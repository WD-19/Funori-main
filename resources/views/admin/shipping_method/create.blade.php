@extends('admin.layout.admin')
@section('title', 'Thêm phương thức giao hàng')
@section('content')
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-30">
                <h3>Thêm phương thức giao hàng</h3>
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
                        <div class="text-tiny">Thêm phương thức</div>
                    </li>
                </ul>
            </div>

            <div class="wg-box">
                <div class="title-box mb-20">
                    <i class="icon-truck"></i>
                    <div class="body-text">Điền thông tin phương thức giao hàng mới vào form bên dưới.</div>
                </div>

                <form method="POST" action="{{ route('admin.shipping_methods.store') }}" class="form-new-product form-style-1">
                    @csrf

                    {{-- Tên phương thức --}}
                    <div class="form-group mb-3">
                        <label for="name" class="form-label label-lg">
                            Tên phương thức <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="name" id="name" class="form-control"
                            placeholder="Tên phương thức" value="{{ old('name') }}">
                        @error('name')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Mô tả --}}
                    <div class="form-group mb-3">
                        <label for="description" class="form-label label-lg">Mô tả</label>
                        <textarea name="description" id="description" class="form-control" placeholder="Mô tả">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Chi phí --}}
                    <div class="form-group mb-3">
                        <label for="cost" class="form-label label-lg">
                            Chi phí <span class="text-danger">*</span>
                        </label>
                        <input type="number" step="0.01" name="cost" id="cost" class="form-control"
                            placeholder="Chi phí" value="{{ old('cost') }}">
                        @error('cost')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <button type="submit" class="tf-button w-100 py-3 fs-5">
                                <i class="bi bi-pencil-square me-1"></i> Thêm Mới
                            </button>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('admin.shipping_methods.index') }}" class="tf-button style-3 w-100 py-3 fs-5">
                                <i class="bi bi-list me-1"></i> Danh sách
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        .label-lg {
            font-size: 1.15rem;
            font-weight: bold;
            color: #222;
            margin-bottom: 6px;
            display: block;
        }

        .form-control,
        .form-control textarea {
            font-size: 1.5rem;
        }

        .text-danger {
            font-size: 1.25rem;
            color: #dc3545;
            margin-top: 4px;
            display: block;
        }
    </style>
@endsection
