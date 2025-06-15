@extends('admin.layout.admin')

@section('title', 'Cập nhật sản phẩm')

@section('content')
<div class="flex items-center flex-wrap justify-between gap20 mb-30">
    <h3>Cập nhật sản phẩm</h3>
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
                <div class="text-tiny">Sản phẩm</div>
            </a>
        </li>
        <li>
            <i class="icon-chevron-right"></i>
        </li>
        <li>
            <div class="text-tiny">Cập nhật sản phẩm</div>
        </li>
    </ul>
</div>
<!-- form-edit-product -->
<form class="form-edit-product" method="POST" action="{{ route('admin.products.update', $product->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="wg-box mb-30">
        <fieldset>
            <div class="body-title mb-10">Tải lên ảnh sản phẩm</div>
            <div class="upload-image mb-16" id="drop-area" style="border:2px dashed #ccc; border-radius:8px;">
                <div class="up-load">
                    <label class="uploadfile" for="myFile" style="width:100%;cursor:pointer;">
                        <span class="icon">
                            <i class="icon-upload-cloud"></i>
                        </span>
                        <div class="text-tiny">
                            Kéo thả ảnh vào đây hoặc <span class="text-secondary">bấm để chọn ảnh</span>
                        </div>
                        <input type="file" id="myFile" name="images[]" multiple style="display:none;">
                    </label>
                </div>
                <div class="flex gap20 flex-wrap" id="gallery">
                    @foreach($productImages as $img)
                    <div class="item">
                        <img src="{{ asset($img->image_url) }}" style="max-width:80px; max-height:80px; object-fit:cover; border:1px solid #eee; border-radius:4px;">
                    </div>
                    @endforeach
                </div>
            </div>
        </fieldset>
    </div>
    <div class="wg-box mb-30">
        <fieldset class="name">
            <div class="body-title mb-10">Tên sản phẩm <span class="tf-color-1">*</span></div>
            <input class="mb-10" type="text" placeholder="Nhập tên sản phẩm" name="name" value="{{ $product->name }}" maxlength="100" required>
        </fieldset>
        <fieldset class="category">
            <div class="body-title mb-10">Danh mục <span class="tf-color-1">*</span></div>
            <select name="category_id" required>
                <option value="">-- Chọn danh mục --</option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}" @if($product->category_id == $category->id) selected @endif>{{ $category->name }}</option>
                @endforeach
            </select>
        </fieldset>
        <fieldset class="brand">
            <div class="body-title mb-10">Thương hiệu <span class="tf-color-1">*</span></div>
            <select name="brand_id" required>
                <option value="">-- Chọn thương hiệu --</option>
                @foreach($brands as $brand)
                <option value="{{ $brand->id }}" @if($product->brand_id == $brand->id) selected @endif>{{ $brand->name }}</option>
                @endforeach
            </select>
        </fieldset>
        <fieldset class="price">
            <div class="body-title mb-10">Giá gốc <span class="tf-color-1">*</span></div>
            <input type="number" name="regular_price" min="0" step="0.01" value="{{ $product->regular_price }}" required>
        </fieldset>
        <fieldset class="short_description">
            <div class="body-title mb-10">Mô tả ngắn <span class="tf-color-1">*</span></div>
            <textarea name="short_description" maxlength="255" required>{{ $product->short_description }}</textarea>
        </fieldset>
        <fieldset class="description">
            <div class="body-title mb-10">Mô tả chi tiết</div>
            <textarea name="description">{{ $product->description }}</textarea>
        </fieldset>

        <!-- VARIANTS -->
        <fieldset class="variants">
            <div class="body-title mb-10">Biến thể</div>
            <div id="variant-list">
                @foreach($product->variants as $i => $variant)
                <div class="variant-row flex gap10 mb-2 align-items-center">
                    <input type="hidden" name="variants[{{ $i }}][id]" value="{{ $variant->id }}">
                    @foreach($attributes as $attribute)
                    <select style="width: 60%;" name="variants[{{ $i }}][attribute_values][{{ $attribute->id }}]" required>
                        <option value="">-- {{ $attribute->name }} --</option>
                        @foreach($attribute->values as $value)
                        <option value="{{ $value->id }}"
                            @if($variant->attributeValues->contains('id', $value->id)) selected @endif>
                            {{ $value->value }}
                        </option>
                        @endforeach
                    </select>
                    @endforeach
                    <input type="text" name="variants[{{ $i }}][size]" value="{{ old('variants.'.$i.'.size', $variant->size ?? '') }}" placeholder="Kích thước (ví dụ: 120x60x75 cm)">
                    <input style="width: 150px;" type="number" name="variants[{{ $i }}][price_modifier]" value="{{ $variant->price_modifier }}" placeholder="Giá chênh lệch" step="0.01">
                    <input style="width: 100px;" type="number" name="variants[{{ $i }}][stock_quantity]" value="{{ $variant->stock_quantity }}" placeholder="Kho" min="0">

                    <div class="d-flex flex-column align-items-center" style="min-width:150px;">
                        <img
                            class="variant-preview mb-1"
                            src="{{ $variant->image ? asset($variant->image->image_url) : '' }}"
                            style="width:100px;height:100px;object-fit:cover;border-radius:4px;border:1px solid #eee;">
                        <input type="file" name="variants[{{ $i }}][new_image]" accept="image/*" class="form-control form-control-sm variant-file-input" style="width:110px;">
                    </div>
                    <button type="hidden" style="padding:0 8px; width: 50px; height: 50px;"></button>
                </div>
                @endforeach
            </div>
            <button type="button" class="tf-button style-1 mt-10" id="add-variant-btn">
                <i class="icon-plus"></i> Thêm biến thể
            </button>
        </fieldset>
    </div>
    <div class="cols gap10">
        <button class="tf-button w380" type="submit">Cập nhật sản phẩm</button>
        <a href="{{ route('admin.products.index') }}" class="tf-button style-3 w380">Hủy</a>
    </div>
</form>


@php
$attributeSelects = '';
foreach($attributes as $attribute) {
$attributeSelects .= '<select  style="width: 60%;" name="VARIANT_NAME[attribute_values]['.$attribute->id.']" required>';
    $attributeSelects .= '<option value="">-- '.$attribute->name.' --</option>';
    foreach($attribute->values as $value) {
    $attributeSelects .= '<option value="'.$value->id.'">'.$value->value.'</option>';
    }
    $attributeSelects .= '</select>';
}

$imageOptions = '<option value="">-- Ảnh biến thể (chọn từ gallery) --</option>';
foreach($productImages as $img) {
$imageOptions .= '<option value="'.$img->id.'" data-url="'.asset($img->image_url).'">Ảnh #'.$img->id.'</option>';
}
@endphp

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dropArea = document.getElementById('drop-area');
        const input = document.getElementById('myFile');
        const gallery = document.getElementById('gallery');
        let filesArray = [];

        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropArea.addEventListener(eventName, e => e.preventDefault(), false);
            dropArea.addEventListener(eventName, e => e.stopPropagation(), false);
        });
        ['dragenter', 'dragover'].forEach(eventName => {
            dropArea.addEventListener(eventName, () => dropArea.style.borderColor = '#007bff', false);
        });
        ['dragleave', 'drop'].forEach(eventName => {
            dropArea.addEventListener(eventName, () => dropArea.style.borderColor = '#ccc', false);
        });
        dropArea.addEventListener('drop', handleDrop, false);

        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = Array.from(dt.files);
            filesArray = filesArray.concat(files);
            updateInputFiles();
            previewFiles(filesArray);
        };
        dropArea.querySelector('label').onclick = () => input.click();
        input.addEventListener('change', function() {
            const files = Array.from(this.files);
            filesArray = filesArray.concat(files);
            updateInputFiles();
            previewFiles(filesArray);
        });

        function updateInputFiles() {
            const dataTransfer = new DataTransfer();
            filesArray.forEach(file => dataTransfer.items.add(file));
            input.files = dataTransfer.files;
        };

        function previewFiles(files) {
            gallery.innerHTML = '';
            files.forEach(file => {
                if (!file.type.startsWith('image/')) return;
                const reader = new FileReader();
                reader.onload = e => {
                    const div = document.createElement('div');
                    div.className = 'item';
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.maxWidth = '80px';
                    img.style.maxHeight = '80px';
                    img.style.objectFit = 'cover';
                    img.style.border = '1px solid #eee';
                    img.style.borderRadius = '4px';
                    div.appendChild(img);
                    gallery.appendChild(div);
                };
                reader.readAsDataURL(file);
            });
        };

        const variantList = document.getElementById('variant-list');
        const addVariantBtn = document.getElementById('add-variant-btn');
        const attributeSelectsTemplate = `{!! addslashes($attributeSelects) !!}`;
        const imageOptionsTemplate = `{!! addslashes($imageOptions) !!}`;
        let variantIndex = variantList.querySelectorAll('.variant-row').length;
        addVariantBtn.addEventListener('click', function() {
            const variantDiv = document.createElement('div');
            variantDiv.className = 'variant-row flex gap10 mb-2 align-items-center';
            let selects = attributeSelectsTemplate.replace(/VARIANT_NAME/g, `variants[${variantIndex}]`);
            variantDiv.innerHTML = `
                ${selects}
                <input type="text" name="variants[${variantIndex}][size]" placeholder="Kích thước (ví dụ: 120x60x75 cm)" class="form-control form-control-sm">
                <input type="number" name="variants[${variantIndex}][price_modifier]" placeholder="Giá chênh lệch" step="0.01" class="form-control form-control-sm" style="width: 150px;">
                <input style="width: 100px;" type="number" name="variants[${variantIndex}][stock_quantity]" placeholder="Kho" min="0" class="form-control form-control-sm">
                <div class="d-flex flex-column align-items-center" style="min-width:150px;">
                    <img class="variant-preview mb-1" src="" style="width:80px;height:80px;object-fit:cover;border-radius:4px;border:1px solid #eee;display:none;">
                    <input type="file" name="variants[${variantIndex}][new_image]" accept="image/*" class="form-control form-control-sm variant-file-input" style="width:110px;">
                </div>
                <button type="button" class="remove-variant tf-button style-3" style="padding:0 8px; width: 50px; height: 50px;">&times;</button>
            `;
            variantDiv.querySelector('.remove-variant').onclick = function() {
                variantDiv.remove();
            };
            variantList.appendChild(variantDiv);

            // Hiển thị ảnh khi chọn
            const selectImg = variantDiv.querySelector('select[name^="variants"][name$="[image_id]"]');
            const previewImg = variantDiv.querySelector('.variant-preview');
            if (selectImg) {
                selectImg.addEventListener('change', function() {
                    const imgId = this.value;
                    if (imgId) {
                        const imgOption = this.querySelector('option[value="' + imgId + '"]');
                        if (imgOption) {
                            const url = imgOption.getAttribute('data-url');
                            if (url) {
                                previewImg.src = url;
                                previewImg.style.display = '';
                            }
                        }
                    } else {
                        previewImg.style.display = 'none';
                    }
                });
            }
            variantDiv.querySelector('.remove-variant').onclick = function() {
                variantDiv.remove();
            };
            variantIndex++;
        });

        document.querySelectorAll('#variant-list .variant-row').forEach(function(variantDiv) {
            const selectImg = variantDiv.querySelector('select[name$="[image_id]"]');
            const previewImg = variantDiv.querySelector('.variant-preview');
            if (selectImg) {
                selectImg.addEventListener('change', function() {
                    const imgId = this.value;
                    const imgOption = this.querySelector('option[value="' + imgId + '"]');
                    if (imgId && imgOption) {
                        const url = imgOption.getAttribute('data-url');
                        if (url) {
                            previewImg.src = url;
                            previewImg.style.display = '';
                        }
                    } else {
                        previewImg.style.display = 'none';
                    }
                });
            }
        });

    });
</script>

@endsection