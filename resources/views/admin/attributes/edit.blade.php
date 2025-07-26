@extends('admin.layout.admin')

@section('title', 'Sửa giá trị thuộc tính')

@section('content')
    <div class="flex items-center flex-wrap justify-between gap20 mb-30">
        <h3>Sửa giá trị thuộc tính</h3>
        <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
            <li>
                <a href="{{ route('admin.dashboard') }}">
                    <div class="text-tiny">Bảng điều khiển</div>
                </a>
            </li>
            <li>
                <i class="icon-chevron-right"></i>
            </li>
            <li>
                <a href="{{ route('admin.attributes.index') }}">
                    <div class="text-tiny">Thuộc tính</div>
                </a>
            </li>
            <li>
                <i class="icon-chevron-right"></i>
            </li>
            <li>
                <div class="text-tiny">Sửa giá trị thuộc tính</div>
            </li>
        </ul>
    </div>
    <div class="wg-box">
        @if (session('success'))
            <div class="alert alert-success mb-3" style="font-size:1.5rem; font-weight:bold; padding:15px;">
                {{ session('success') }}
            </div>
        @endif
        <form action="{{ route('admin.attributes.update', $attributeValue->id) }}" method="POST">
            @csrf
            @method('PUT')

            <fieldset class="name mb-6">
                <div class="body-title">Thuộc tính</div>
                <select name="attribute_id" id="attribute_id" class="form-control fs-4 rounded px-4 @error('attribute_id') is-invalid @enderror">
                    @foreach ($attributes as $attribute)
                        <option value="{{ $attribute->id }}"
                            {{ $attributeValue->attribute_id == $attribute->id ? 'selected' : '' }}>
                            {{ $attribute->name }}
                        </option>
                    @endforeach
                </select>
                @error('attribute_id')
                    <div class="invalid-feedback" style="font-size:1.25rem; padding:8px;">{{ $message }}</div>
                @enderror
            </fieldset>
            <fieldset class="name mt-6">
                <div class="body-title">Giá trị</div>
                <input class="flex-grow form-control @error('value') is-invalid @enderror" type="text" placeholder="Nhập giá trị thuộc tính" name="value" tabindex="0"
                    value="{{ old('value', $attributeValue->value) }}" aria-required="true">
                @error('value')
                    <div class="invalid-feedback" style="font-size:1.25rem; padding:8px;">{{ $message }}</div>
                @enderror
            </fieldset>

            <div class="row mt-5">
                <div class="col-md-6 mb-2">
                    <button type="submit" class="tf-button w-100 py-3 fs-5">
                        <i class="bi bi-pencil-square me-1"></i> Cập nhật
                    </button>
                </div>
                <div class="col-md-6 mb-2">
                    <a href="{{ route('admin.attributes.index') }}" class="tf-button style-3 w-100 py-3 fs-5">
                        <i class="bi bi-list me-1"></i> Danh sách
                    </a>
                </div>
            </div>
        </form>
    </div>
    <style>
        .name {
            padding: 15px 0;
        }
        .body-title {
            margin-bottom: 10px;
            font-weight: bold;
        }
        .form-control {
            padding: 12px 16px;
            border-radius: 6px;
            border: 1px solid #ddd;
            width: 100%;
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
    </style>
@endsection