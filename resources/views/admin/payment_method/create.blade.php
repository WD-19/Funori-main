@extends('admin.layout.admin')

@section('title', 'Thêm phương thức thanh toán')

@section('content')
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-30">
                <h3>Thêm phương thức thanh toán</h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li>
                        <a href="{{ route('admin.dashboard') }}">
                            <div class="text-tiny">Dashboard</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <a href="{{ route('admin.payment_methods.index') }}">
                            <div class="text-tiny">Payment Methods</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">Thêm phương thức</div>
                    </li>
                </ul>
            </div>
            <div class="wg-box">
                <div class="title-box mb-20">
                    <i class="icon-credit-card"></i>
                    <div class="body-text">Điền thông tin phương thức thanh toán mới vào form bên dưới.</div>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger mb-3">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success mb-3" style="font-size:1.25rem; font-weight:bold;">
                        {{ session('success') }}
                    </div>
                @endif
                <form class="form-new-product form-style-1" action="{{ route('admin.payment_methods.store') }}"
                    method="POST" class="form-grid">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="name" class="form-label fw-bold fs-5">Tên phương thức <span
                                class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" class="form-control"
                            placeholder="Tên phương thức" value="{{ old('name') }}" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="code" class="form-label fw-bold fs-5">Mã phương thức <span
                                class="text-danger">*</span></label>
                        <input type="text" name="code" id="code" class="form-control"
                            placeholder="Mã phương thức (viết liền, không dấu)" value="{{ old('code') }}" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="description" class="form-label fw-bold fs-5">Mô tả</label>
                        <textarea name="description" id="description" class="form-control rounded" placeholder="Mô tả">{{ old('description') }}</textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="instructions" class="form-label fw-bold fs-5">Hướng dẫn thanh toán</label>
                        <textarea name="instructions" id="instructions" class="form-control rounded" placeholder="Hướng dẫn thanh toán">{{ old('instructions') }}</textarea>
                    </div>

                    <div class="row mt-5">
                        <div class="col-md-6">
                            <button type="submit" class="tf-button w-100 py-3 fs-5">
                                <i class="bi bi-pencil-square me-1"></i> Thêm Mới
                            </button>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('admin.payment_methods.index') }}" class="tf-button style-3 w-100 py-3 fs-5">
                                <i class="bi bi-list me-1"></i> Danh sách
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <style>
        .form-control,
        .form-control textarea {
            font-size: 1.5rem;
        }
    </style>
@endsection
