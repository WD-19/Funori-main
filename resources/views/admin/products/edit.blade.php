@extends('admin.layout.admin')

@section('title', 'Cập nhật sản phẩm')

@section('content')
    <div class="flex items-center flex-wrap justify-between gap20 mb-30">
        <h3>Cập nhật sản phẩm</h3>
        <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
            <li>
                <a href="{{ route('admin.dashboard') }}">
                    <div class="text-tiny">Trang chủ</div>
                </a>
            </li>
            <li>
                <i class="icon-chevron-right"></i>
            </li>
            <li>
                <a href="{{ route('admin.products.index') }}">
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

    {{-- @if ($errors->any())
    <div class="alert alert-danger mb-3">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif --}}

    <!-- form-edit-product -->
    <form class="form-edit-product" method="POST" action="{{ route('admin.products.update', $product->id) }}"
        enctype="multipart/form-data">
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
                    @error('images.*')
                        <div class="text-danger text-tiny mt-2">{{ $message }}</div>
                    @enderror
                    <div class="flex gap20 flex-wrap" id="gallery">
                        @foreach ($productImages as $img)
                            <div class="item position-relative" data-image-id="{{ $img->id }}">
                                <img src="{{ asset($img->image_url) }}"
                                    style="max-width:80px; max-height:80px; object-fit:cover; border:1px solid #eee; border-radius:4px;">
                                <button type="button" class="btn btn-danger btn-sm btn-remove-image"
                                    style="position:absolute;top:2px;right:2px;padding:2px 6px;line-height:1;font-size:14px;"
                                    data-image-id="{{ $img->id }}">×</button>
                                <input type="hidden" name="keep_images[]" value="{{ $img->id }}">
                            </div>
                        @endforeach
                    </div>
                </div>
            </fieldset>
        </div>
        <div class="wg-box mb-30">
            <fieldset class="name">
                <div class="body-title mb-10">Tên sản phẩm <span class="tf-color-1">*</span></div>
                <input class="mb-10" type="text" placeholder="Nhập tên sản phẩm" name="name"
                    value="{{ old('name', $product->name) }}" maxlength="100">
                @error('name')
                    <div class="text-danger text-tiny mt-2">{{ $message }}</div>
                @enderror
            </fieldset>
            <fieldset class="category">
                <div class="body-title mb-10">Danh mục <span class="tf-color-1">*</span></div>
                <select name="category_id">
                    <option value="">-- Chọn danh mục --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @if (old('category_id', $product->category_id) == $category->id) selected @endif>
                            {{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <div class="text-danger text-tiny mt-2">{{ $message }}</div>
                @enderror
            </fieldset>
            <fieldset class="brand">
                <div class="body-title mb-10">Thương hiệu <span class="tf-color-1">*</span></div>
                <select name="brand_id">
                    <option value="">-- Chọn thương hiệu --</option>
                    @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}" @if (old('brand_id', $product->brand_id) == $brand->id) selected @endif>
                            {{ $brand->name }}</option>
                    @endforeach
                </select>
                @error('brand_id')
                    <div class="text-danger text-tiny mt-2">{{ $message }}</div>
                @enderror
            </fieldset>
            <fieldset class="price">
                <div class="body-title mb-10">Giá gốc <span class="tf-color-1">*</span></div>
                <input type="text" name="regular_price" class="price-input" placeholder="Nhập giá (ví dụ: 1.500.000)"
                    value="{{ old('regular_price', $product->regular_price) ? number_format(old('regular_price', $product->regular_price), 0, ',', '.') : '' }}">
                @error('regular_price')
                    <div class="text-danger text-tiny mt-2">{{ $message }}</div>
                @enderror
            </fieldset>
            <fieldset class="short_description">
                <div class="body-title mb-10">Mô tả ngắn <span class="tf-color-1">*</span></div>
                <textarea name="short_description" maxlength="255">{{ old('short_description', $product->short_description) }}</textarea>
                @error('short_description')
                    <div class="text-danger text-tiny mt-2">{{ $message }}</div>
                @enderror
            </fieldset>
            <fieldset class="description">
                <div class="body-title mb-10">Mô tả chi tiết</div>
                <textarea name="description">{{ old('description', $product->description) }}</textarea>
                @error('description')
                    <div class="text-danger text-tiny mt-2">{{ $message }}</div>
                @enderror
            </fieldset>

            <!-- VARIANTS -->
            <fieldset class="variants">
                <div class="body-title mb-10">Biến thể</div>
                @error('variants')
                    <div class="text-danger text-tiny mt-2">{{ $message }}</div>
                @enderror

                <div id="variant-list">
                    @foreach ($product->variants as $i => $variant)
                        <div class="variant-row">
                            <input type="hidden" name="variants[{{ $i }}][id]" value="{{ $variant->id }}">
                            @foreach ($attributes as $attribute)
                                <select style="width: 20%;"
                                    name="variants[{{ $i }}][attribute_values][{{ $attribute->id }}]">
                                    <option value="">-- {{ $attribute->name }} --</option>
                                    @foreach ($attribute->values as $value)
                                        <option value="{{ $value->id }}"
                                            @if ($variant->attributeValues->contains('id', $value->id)) selected @endif>
                                            {{ $value->value }}
                                        </option>
                                    @endforeach
                                </select>
                            @endforeach
                            <input type="text" name="variants[{{ $i }}][name_variant]"
                                value="{{ old('variants.' . $i . '.name_variant', $variant->name_variant ?? '') }}"
                                placeholder="Tên biến thể" style="width:28%;">
                            <input type="text" name="variants[{{ $i }}][size]"
                                value="{{ old('variants.' . $i . '.size', $variant->size ?? '') }}"
                                placeholder="Kích thước (ví dụ: 120x60x75 cm)" style="width:200px;">
                            <input type="text"
                                name="variants[{{ $i }}][price_modifier]"
                                value="{{ old('variants.' . $i . '.price_modifier', $variant->price_modifier) ? number_format(old('variants.' . $i . '.price_modifier', $variant->price_modifier), 0, ',', '.') : '' }}"
                                placeholder="Giá chênh lệch (ví dụ: 50,000)" class="price-input" style="width: 150px;">
                            <input type="number"
                                name="variants[{{ $i }}][stock_quantity]"
                                value="{{ old('variants.' . $i . '.stock_quantity', $variant->stock_quantity) }}"
                                placeholder="Kho" min="0" style="width: 100px;">
                            <div class="variant-image-upload">
                                @if($variant->image)
                                    <div class="existing-image-container">
                                        <img src="{{ asset($variant->image->image_url) }}" class="existing-image">
                                        <div class="image-overlay">
                                            <span class="change-text">Thay đổi ảnh</span>
                                        </div>
                                        <input type="file" name="variants[{{ $i }}][new_image]" accept="image/*" class="file-input">
                                    </div>
                                @else
                                    <div class="upload-area">
                                        <span class="icon"><i class="icon-upload-cloud"></i></span>
                                        <span class="text-tiny">Chọn ảnh biến thể</span>
                                        <input type="file" name="variants[{{ $i }}][new_image]" accept="image/*" class="file-input">
                                    </div>
                                @endif
                            </div>
                            <button type="button" class="remove-variant tf-button style-3" style="padding:0 8px; width: 30px; height: 30px;">×</button>
                        </div>
                    @endforeach
                </div>
                <br><br>
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

    <style>
        .variant-image-upload {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 180px;
        }

        .variant-image-upload .upload-area {
            cursor: pointer;
            display: block;
            border: 2px dashed #e0e0e0;
            border-radius: 8px;
            padding: 12px;
            text-align: center;
            background: #f8f9fa;
            width: 100%;
            transition: all 0.3s ease;
            position: relative;
        }

        .variant-image-upload .upload-area:hover {
            border-color: #007bff;
            background: #e3f2fd;
        }

        .variant-image-upload .existing-image-container {
            position: relative;
            width: 100%;
            height: 120px;
            border-radius: 8px;
            overflow: hidden;
            cursor: pointer;
            border: 1px solid #e0e0e0;
        }

        .variant-image-upload .existing-image {
            width: 100%;
            height: 100%;
            object-fit: contain;
            border-radius: 8px;
            background: #f8f9fa;
        }

        .variant-image-upload .image-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .variant-image-upload .existing-image-container:hover .image-overlay {
            opacity: 1;
        }

        .variant-image-upload .change-text {
            color: white;
            font-size: 12px;
            font-weight: 500;
        }

        .variant-image-upload .file-input {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }

        .variant-image-upload .icon {
            display: block;
            font-size: 20px;
            color: #6c757d;
            margin-bottom: 4px;
        }

        .variant-image-upload .text-tiny {
            font-size: 12px;
            color: #6c757d;
            font-weight: 500;
        }

        .variant-row {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 15px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 8px;
            border: 1px solid #e9ecef;
        }

        .variant-row input,
        .variant-row select {
            padding: 8px 12px;
            border: 1px solid #ced4da;
            border-radius: 6px;
            font-size: 14px;
            transition: border-color 0.3s ease;
        }

        .variant-row input:focus,
        .variant-row select:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 0 2px rgba(0,123,255,0.25);
        }

        .remove-variant {
            background: #dc3545;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .remove-variant:hover {
            background: #c82333;
            transform: scale(1.05);
        }
    </style>

    @php
        $attributeSelects = '';
        foreach ($attributes as $attribute) {
            $attributeSelects .=
                '<select style="width: 20%;" name="VARIANT_NAME[attribute_values][' . $attribute->id . ']" >';
            $attributeSelects .= '<option value="">-- ' . $attribute->name . ' --</option>';
            foreach ($attribute->values as $value) {
                $attributeSelects .= '<option value="' . $value->id . '">' . $value->value . '</option>';
            }
            $attributeSelects .= '</select>';
        }
    @endphp

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Format số với dấu phẩy
            function formatNumber(num) {
                return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }

            // Xóa dấu phẩy để lấy số nguyên
            function unformatNumber(str) {
                return str.replace(/\./g, '');
            }

            // Xử lý input giá
            function handlePriceInput(input) {
                input.addEventListener('input', function(e) {
                    let value = e.target.value.replace(/[^\d]/g, '');
                    if (value) {
                        e.target.value = formatNumber(value);
                    }
                });

                input.addEventListener('blur', function(e) {
                    let value = e.target.value.replace(/[^\d]/g, '');
                    if (value) {
                        e.target.value = formatNumber(value);
                    }
                });
            }

            // Xử lý form submit
            document.querySelector('.form-edit-product').addEventListener('submit', function(e) {
                // Xử lý giá gốc
                const regularPriceInput = document.querySelector('input[name="regular_price"]');
                if (regularPriceInput.value) {
                    regularPriceInput.value = unformatNumber(regularPriceInput.value);
                }

                // Xử lý giá chênh lệch trong variants
                const priceModifierInputs = document.querySelectorAll('input[name*="[price_modifier]"]');
                priceModifierInputs.forEach(input => {
                    if (input.value) {
                        input.value = unformatNumber(input.value);
                    }
                });
            });

            // Áp dụng format cho các input giá hiện có
            document.querySelectorAll('.price-input').forEach(handlePriceInput);



            const dropArea = document.getElementById('drop-area');
            const input = document.getElementById('myFile');
            const gallery = document.getElementById('gallery');
            let filesArray = [];

            // XÓA ẢNH SẢN PHẨM ĐÃ CÓ
            gallery.addEventListener('click', function(e) {
                if (e.target.classList.contains('btn-remove-image')) {
                    const imageId = e.target.getAttribute('data-image-id');
                    const item = e.target.closest('.item');
                    if (item) {
                        item.remove();
                    }
                    // Xóa input keep_images tương ứng
                    const inputKeep = gallery.querySelector('input[name="keep_images[]"][value="' +
                        imageId + '"]');
                    if (inputKeep) inputKeep.remove();
                }
            });

            // DRAG & DROP ẢNH MỚI
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
                // Hiển thị ảnh mới chọn (không ảnh cũ)
                files.forEach(file => {
                    if (!file.type.startsWith('image/')) return;
                    const reader = new FileReader();
                    reader.onload = e => {
                        const div = document.createElement('div');
                        div.className = 'item position-relative';
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.style.maxWidth = '80px';
                        img.style.maxHeight = '80px';
                        img.style.objectFit = 'cover';
                        img.style.border = '1px solid #eee';
                        img.style.borderRadius = '4px';
                        
                        // Thêm nút xóa ảnh
                        const removeBtn = document.createElement('button');
                        removeBtn.type = 'button';
                        removeBtn.className = 'btn btn-danger btn-sm btn-remove-image';
                        removeBtn.innerHTML = '×';
                        removeBtn.style.cssText = 'position:absolute;top:2px;right:2px;padding:2px 6px;line-height:1;font-size:14px;';
                        removeBtn.onclick = function() {
                            div.remove();
                            // Xóa file khỏi filesArray
                            const index = filesArray.indexOf(file);
                            if (index > -1) {
                                filesArray.splice(index, 1);
                                updateInputFiles();
                            }
                        };
                        
                        div.appendChild(img);
                        div.appendChild(removeBtn);
                        gallery.appendChild(div);
                    };
                    reader.readAsDataURL(file);
                });
            };

            // VARIANT JS
            const variantList = document.getElementById('variant-list');
            const addVariantBtn = document.getElementById('add-variant-btn');
            const attributeSelectsTemplate = `{!! addslashes($attributeSelects) !!}`;
            let variantIndex = variantList.querySelectorAll('.variant-row').length;
            addVariantBtn.addEventListener('click', function() {
                const variantDiv = document.createElement('div');
                variantDiv.className = 'variant-row flex gap10 mb-2 align-items-center';
                let selects = attributeSelectsTemplate.replace(/VARIANT_NAME/g,
                `variants[${variantIndex}]`);
                variantDiv.innerHTML = `
                ${selects}
                <input type="text" name="variants[${variantIndex}][name_variant]" placeholder="Tên biến thể" style="width:28%;">
                <input type="text" name="variants[${variantIndex}][size]" placeholder="Kích thước (ví dụ: 120x60x75 cm)" style="width:200px;">
                <input type="text" name="variants[${variantIndex}][price_modifier]" placeholder="Giá chênh lệch (ví dụ: 50,000)" class="price-input" style="width: 150px;">
                <input type="number" name="variants[${variantIndex}][stock_quantity]" placeholder="Kho" min="0" style="width: 100px;">
                <div class="variant-image-upload">
                    <div class="upload-area">
                        <span class="icon"><i class="icon-upload-cloud"></i></span>
                        <span class="text-tiny">Chọn ảnh biến thể</span>
                        <input type="file" name="variants[${variantIndex}][new_image]" accept="image/*" class="file-input">
                    </div>
                </div>
                <button type="button" class="remove-variant tf-button style-3" style="padding:0 8px; width: 30px; height: 30px;">×</button>
            `;
                variantList.appendChild(variantDiv);

                // Áp dụng format cho input giá chênh lệch mới
                const priceModifierInput = variantDiv.querySelector('input[name*="[price_modifier]"]');
                if (priceModifierInput) {
                    handlePriceInput(priceModifierInput);
                }



                variantDiv.querySelector('.remove-variant').onclick = function() {
                    variantDiv.remove();
                };
                variantIndex++;
            });
        });
    </script>

@endsection
