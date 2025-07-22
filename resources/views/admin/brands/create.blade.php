@extends('admin.layout.admin')

@section('title', 'Thêm thương hiệu mới')

@section('content')
<div class="main-content-inner">
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-30">
            <h3>Thêm thương hiệu mới</h3>
            <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                <li>
                    <a href="{{ route('admin.dashboard') }}">
                        <div class="text-tiny">Bảng điều khiển</div>
                    </a>
                </li>
                <li><i class="icon-chevron-right"></i></li>
                <li>
                    <a href="{{ route('admin.brands.index') }}">
                        <div class="text-tiny">Thương hiệu</div>
                    </a>
                </li>
                <li><i class="icon-chevron-right"></i></li>
                <li><div class="text-tiny">Thêm thương hiệu</div></li>
            </ul>
        </div>
        <div class="wg-box">
            <div class="title-box mb-20">
                <i class="icon-layers"></i>
                <div class="body-text">Điền thông tin thương hiệu mới vào form bên dưới.</div>
            </div>
            @if (session('success'))
                <div class="alert alert-success mb-3" style="font-size:1.5rem; font-weight:bold; padding:15px;">
                    {{ session('success') }}
                </div>
            @endif
            <form method="POST" action="{{ route('admin.brands.store') }}" class="form-grid" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-5">
                    <label class="form-label fw-bold fs-5 mb-3" for="name">Tên thương hiệu <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                    @error('name')
                        <div class="invalid-feedback" style="font-size:1.25rem; padding:8px;">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group mb-5">
                    <label class="form-label fw-bold fs-5 mb-3" for="logo">Logo</label>
                    <input type="file" name="logo" id="logo" class="form-control @error('logo') is-invalid @enderror">
                    @error('logo')
                        <div class="invalid-feedback" style="font-size:1.25rem; padding:8px;">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group mb-5">
                    <label class="form-label fw-bold fs-5 mb-3" for="description">Mô tả</label>
                    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="4">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback" style="font-size:1.25rem; padding:8px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row mt-5">
                    <div class="col-md-6">
                        <button type="submit" class="tf-button w-100 py-3 fs-5">
                            <i class="bi bi-pencil-square me-1"></i> Thêm mới
                        </button>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ route('admin.brands.index') }}" class="tf-button style-3 w-100 py-3 fs-5">
                            <i class="bi bi-list me-1"></i> Danh sách
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<style>
    .form-control, .form-control textarea {
        font-size: 1.5rem;
    }
    
    .form-group {
        padding: 20px 0;
    }
    
    .form-label {
        display: block;
        margin-bottom: 12px;
    }
    
    .form-control {
        padding: 12px 16px;
        border-radius: 6px;
        border: 1px solid #ddd;
        transition: border-color 0.3s ease;
    }
    
    .form-control:focus {
        border-color: #007bff;
        outline: none;
        box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
    }
    
    .form-control.is-invalid {
        border-color: #dc3545;
    }
    
    .invalid-feedback {
        color: #dc3545;
        font-size: 0.875rem;
        margin-top: 0.25rem;
    }
    
    .wg-box {
        padding: 30px;
    }
</style>
@endsection