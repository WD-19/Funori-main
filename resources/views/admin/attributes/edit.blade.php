@extends('admin.layout.admin')

@section('content')
    <div class="flex items-center flex-wrap justify-between gap20 mb-30">
        <h3>Sửa giá trị thuộc tính</h3>
        <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
            <li>
                <a href="index.html">
                    <div class="text-tiny">Trang chủ</div>
                </a>
            </li>
            <li>
                <i class="icon-chevron-right"></i>
            </li>
            <li>
                <a href="#">
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
        <form action="{{ route('admin.attributes.update', $attributeValue->id) }}" method="POST">
            @csrf
            @method('PUT')

            <fieldset class="name mb-5">
                <div class="body-title">Thuộc tính</div>
                <select name="attribute_id" id="attribute_id" class="form-control fs-4 rounded px-4" required>
                    @foreach ($attributes as $attribute)
                        <option value="{{ $attribute->id }}"
                            {{ $attributeValue->attribute_id == $attribute->id ? 'selected' : '' }}>
                            {{ $attribute->name }}
                        </option>
                    @endforeach
                </select>
            </fieldset>
            <fieldset class="name">
                <div class="body-title">Giá trị</div>
                <input class="flex-grow" type="text" placeholder="Nhập giá trị thuộc tính" name="value" tabindex="0"
                    value="{{ old('value', $attributeValue->value) }}" aria-required="true" required="">
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
@endsection
