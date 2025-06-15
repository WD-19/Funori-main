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

        <fieldset class="name">
            <div class="body-title">Thuộc tính</div>
            <select name="attribute_id" id="attribute_id" class="form-control" required>
                @foreach($attributes as $attribute)
                <option value="{{ $attribute->id }}" {{ $attributeValue->attribute_id == $attribute->id ? 'selected' : '' }}>
                    {{ $attribute->name }}
                </option>
                @endforeach
            </select>
        </fieldset>
        <fieldset class="name">
            <div class="body-title">Giá trị</div>
            <input class="flex-grow" type="text" placeholder="Nhập giá trị thuộc tính" name="value" tabindex="0" value="{{ old('value', $attributeValue->value) }}" aria-required="true" required="">
        </fieldset>
        <div class="bot">
            <div></div>
            <button class="tf-button w208" type="submit">Cập nhật</button><br>
            <a href="{{ route('admin.attributes.index') }}" class="btn btn-secondary">Quay lại</a>
        </div>
    </form>
</div>

@endsection