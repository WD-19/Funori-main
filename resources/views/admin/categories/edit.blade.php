@extends('admin.layout.admin')

@section('title', 'Chỉnh sửa danh mục')

@section('content')
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-30">
            <h3>Chỉnh sửa danh mục</h3>
            <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                <li>
                    <a href="{{ route('admin.dashboard') }}">
                        <div class="text-tiny">Bảng điều khiển</div>
                    </a>
                </li>
                <li><i class="icon-chevron-right"></i></li>
                <li>
                    <a href="{{ route('admin.categories.index') }}">
                        <div class="text-tiny">Danh mục</div>
                    </a>
                </li>
                <li><i class="icon-chevron-right"></i></li>
                <li>
                    <div class="text-tiny">Chỉnh sửa danh mục</div>
                </li>
            </ul>
        </div>
        <div class="wg-box">
            <form class="form-new-product form-style-1" action="{{ route('admin.categories.update', $category->id) }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <fieldset class="name">
                    <div class="body-title">Tên danh mục <span class="tf-color-1">*</span></div>
                    <input class="flex-grow form-control @error('name') is-invalid @enderror" type="text"
                        placeholder="Tên danh mục" name="name" id="name" value="{{ old('name', $category->name) }}">
                    @error('name')
                        <div class="invalid-feedback fw-bold fs-5" style="display:block;">{{ $message }}</div>
                    @enderror
                </fieldset>

                <input type="hidden" name="slug" id="slug" value="{{ old('slug', $category->slug) }}">

                <fieldset class="category">
                    <div class="body-title">Danh mục</div>
                    <div class="select flex-grow">
                        <select name="parent_id" id="parent_id" class="@error('parent_id') is-invalid @enderror">
                            <option value="">-- Danh mục cha --</option>
                            @foreach ($parents as $parent)
                                <option value="{{ $parent->id }}" @if (session('error') && is_null($category->parent_id) && $category->children()->count() > 0
                                        ? $category->parent_id == $parent->id
                                        : old('parent_id', $category->parent_id) == $parent->id) selected @endif>
                                    {{ $parent->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('parent_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </fieldset>

                <fieldset>
                    <div class="body-title">Mô tả</div>
                    <textarea class="flex-grow" name="description" id="description" placeholder="Mô tả danh mục">{{ old('description', $category->description) }}</textarea>
                </fieldset>

                <fieldset>
                    <div class="body-title">Ảnh</div>
                    <div class="upload-image flex-grow d-block">
                        <div class="item up-load" style="display: flex; align-items: flex-start; gap: 24px;">
                            <label class="uploadfile h250" for="image_url" style="flex:1;">
                                <span class="icon">
                                    <i class="icon-upload-cloud"></i>
                                </span>
                                <span class="body-text">Kéo thả ảnh vào đây hoặc <span class="tf-color">nhấn để
                                        chọn</span></span>
                                <input type="file" id="image_url" name="image_url"
                                    class="@error('image_url') is-invalid @enderror" accept="image/*">
                            </label>
                        </div>
                        @if ($category->image_url)
                            <img id="old-image" src="{{ asset('storage/' . $category->image_url) }}" alt="Ảnh danh mục"
                                style="max-width: 100%; max-height: 200px; margin-top: 10px; border-radius: 8px; border: 2px solid #e0e0e0; box-shadow: 0 2px 4px rgba(0,0,0,0.1); object-fit: cover;">
                        @endif
                        <img id="image_url-preview" src="#" alt=""
                            style="display: none; max-width: 100%; max-height: 200px; margin-top: 10px; border-radius: 8px; border: 2px solid #e0e0e0; box-shadow: 0 2px 4px rgba(0,0,0,0.1); object-fit: cover;">
                        @error('image_url')
                            <div class="invalid-feedback fw-bold fs-5" style="display:block;">{{ $message }}</div>
                        @enderror
                    </div>
                </fieldset>

                <fieldset class="category">
                    <div class="body-title">Trạng thái <span class="tf-color-1">*</span></div>
                    <div class="select flex-grow">
                        <select name="is_active" id="is_active" class="@error('is_active') is-invalid @enderror">
                            <option value="">-- Chọn trạng thái --</option>
                            <option value="1" {{ old('is_active', $category->is_active) == '1' ? 'selected' : '' }}>
                                Kích hoạt</option>
                            <option value="0" {{ old('is_active', $category->is_active) == '0' ? 'selected' : '' }}>
                                Không kích hoạt</option>
                        </select>
                        @error('is_active')
                            <div class="invalid-feedback fw-bold fs-5" style="display:block;">{{ $message }}</div>
                        @enderror
                    </div>
                </fieldset>

                <fieldset>
                    <div class="body-title">Ngày tạo</div>
                    <input type="text" class="form-control" value="{{ $category->created_at }}" readonly>
                </fieldset>
                <fieldset>
                    <div class="body-title">Ngày cập nhật</div>
                    <input type="text" class="form-control" value="{{ $category->updated_at }}" readonly>
                </fieldset>

                <div class="row mt-5">
                    <div class="col-md-6">
                        <button type="submit" class="tf-button w-100 py-3 fs-5">
                            <i class="bi bi-pencil-square me-1"></i> Cập nhật
                        </button>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ route('admin.categories.index') }}" class="tf-button style-3 w-100 py-3 fs-5">
                            <i class="bi bi-list me-1"></i> Danh sách
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <style>
        .uploadfile {
            border: 2px dashed #ced4da;
            border-radius: 10px;
            background-color: #f8f9fa;
            transition: all 0.3s ease;
            padding: 20px;
            text-align: center;
            cursor: pointer;
        }
        .uploadfile:hover, .uploadfile.dragover {
            border-color: #6c757d;
            background-color: #e9ecef;
            transform: scale(1.02);
        }
        .uploadfile .icon {
            font-size: 2.5rem;
            color: #6c757d;
            margin-bottom: 10px;
        }
        .uploadfile .body-text {
            font-size: 1.1rem;
            color: #495057;
        }
        .uploadfile .tf-color {
            color: #007bff;
            font-weight: 600;
        }
        .uploadfile input[type="file"] {
            display: none;
        }
        .invalid-feedback {
            color: #dc3545;
            font-size: 0.9rem;
            margin-top: 5px;
        }
    </style>
    <script>
        // Tạo slug tự động khi nhập tên
        document.getElementById('name').addEventListener('input', function() {
            let name = this.value;
            let slug = name.toLowerCase()
                .normalize('NFD').replace(/[\u0300-\u036f]/g, '')
                .replace(/[^a-z0-9\s-]/g, '')
                .trim().replace(/\s+/g, '-');
            document.getElementById('slug').value = slug;
        });

        // Xử lý kéo thả và chọn ảnh
        const uploadLabel = document.querySelector('.uploadfile');
        const uploadInput = document.getElementById('image_url');
        const preview = document.getElementById('image_url-preview');
        const oldImage = document.getElementById('old-image');

        // Xử lý sự kiện kéo thả
        uploadLabel.addEventListener('dragover', (e) => {
            e.preventDefault();
            uploadLabel.classList.add('dragover');
        });

        uploadLabel.addEventListener('dragenter', (e) => {
            e.preventDefault();
            uploadLabel.classList.add('dragover');
        });

        uploadLabel.addEventListener('dragleave', (e) => {
            e.preventDefault();
            uploadLabel.classList.remove('dragover');
        });

        uploadLabel.addEventListener('drop', (e) => {
            e.preventDefault();
            uploadLabel.classList.remove('dragover');
            const file = e.dataTransfer.files[0];
            if (file && file.type.startsWith('image/')) {
                uploadInput.files = e.dataTransfer.files;
                preview.src = URL.createObjectURL(file);
                preview.style.display = 'block';
                if (oldImage) oldImage.style.display = 'none'; // Ẩn ảnh cũ khi chọn ảnh mới
            }
        });

        // Hiển thị ảnh xem trước khi chọn file
        uploadInput.addEventListener('change', (e) => {
            const [file] = e.target.files;
            if (file) {
                preview.src = URL.createObjectURL(file);
                preview.style.display = 'block';
                if (oldImage) oldImage.style.display = 'none'; // Ẩn ảnh cũ khi chọn ảnh mới
            } else {
                preview.src = '#';
                preview.style.display = 'none';
                if (oldImage) oldImage.style.display = 'block'; // Hiển thị lại ảnh cũ nếu hủy chọn
            }
        });
    </script>
@endsection