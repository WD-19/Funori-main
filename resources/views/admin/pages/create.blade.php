@extends('admin.layout.admin')

@section('content')
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-30">
            <h3>Thêm trang mới</h3>
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
                    <a href="{{ route('admin.pages.index') }}">
                        <div class="text-tiny">Trang</div>
                    </a>
                </li>
                <li>
                    <i class="icon-chevron-right"></i>
                </li>
                <li>
                    <div class="text-tiny">Thêm trang mới</div>
                </li>
            </ul>
        </div>
        <!-- new-page -->
        <div class="wg-box">
            <form action="{{ route('admin.pages.store') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <!-- Tiêu đề -->
                <fieldset class="name">
                    <div class="body-title">Tiêu đề trang <span class="tf-color-1">*</span></div>
                    <input class="flex-grow form-control @error('title') is-invalid @enderror" type="text"
                        placeholder="Tiêu đề trang" name="title" id="title" value="{{ old('title') }}">
                    @error('title')
                        <div class="invalid-feedback fw-bold fs-5" style="display:block;">{{ $message }}</div>
                    @enderror
                </fieldset>
                <input type="hidden" name="slug" id="slug" value="{{ old('slug') }}">
                <!-- Nội dung -->
                <fieldset>
                    <div class="body-title">Nội dung <span class="tf-color-1">*</span></div>
                    <div class="ck-editor-container">
                        <textarea class="flex-grow @error('content') is-invalid @enderror" name="content" id="content" rows="6" cols="100"
                            placeholder="Nội dung trang">{{ old('content') }}</textarea>
                        @error('content')
                            <div class="invalid-feedback fw-bold fs-5" style="display:block;">{{ $message }}</div>
                        @enderror
                    </div>
                </fieldset>
                <fieldset>
                    <div class="body-title">Tác giả <span class="tf-color-1">*</span></div>
                    <div class="select flex-grow">
                        <select name="author_id" id="author_id" class="@error('author_id') is-invalid @enderror">
                            <option value="">-- Chọn tác giả --</option>
                            @foreach ($authors as $author)
                                <option value="{{ $author->id }}" {{ old('author_id') == $author->id ? 'selected' : '' }}>
                                    {{ $author->full_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('author_id')
                            <div class="invalid-feedback fw-bold fs-5" style="display:block;">{{ $message }}</div>
                        @enderror
                    </div>
                </fieldset>
                <fieldset>
                    <div class="body-title">Loại trang <span class="tf-color-1">*</span></div>
                    <div class="select flex-grow">
                        <select name="page_type" id="page_type" class="@error('page_type') is-invalid @enderror">
                            <option value="blog_post" {{ old('page_type', 'blog_post') == 'blog_post' ? 'selected' : '' }}>
                                Blog Post</option>
                            <option value="page" {{ old('page_type') == 'page' ? 'selected' : '' }}>Page</option>
                        </select>
                        @error('page_type')
                            <div class="invalid-feedback fw-bold fs-5" style="display:block;">{{ $message }}</div>
                        @enderror
                    </div>
                </fieldset>
                <fieldset>
                    <div class="body-title">Trạng thái <span class="tf-color-1">*</span></div>
                    <div class="select flex-grow">
                        <select name="status" id="status" class="@error('status') is-invalid @enderror">
                            <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Nháp</option>
                            <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Đã xuất bản
                            </option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback fw-bold fs-5" style="display:block;">{{ $message }}</div>
                        @enderror
                    </div>
                </fieldset>
                <!-- Ảnh đại diện -->
                <fieldset>
                    <div class="body-title">Ảnh đại diện <span class="tf-color-1">*</span></div>
                    <div class="upload-image flex-grow d-block">
                        <div class="item up-load">
                            <label class="uploadfile h250" for="featured_image_url">
                                <span class="icon">
                                    <i class="icon-upload-cloud"></i>
                                </span>
                                <span class="body-text">Kéo thả ảnh vào đây hoặc <span class="tf-color">nhấn để
                                        chọn</span></span>
                                <input type="file" id="featured_image_url" name="featured_image_url"
                                    class="@error('featured_image_url') is-invalid @enderror" accept="image/*">
                            </label>
                        </div>
                        <img id="featured_image_url-preview" src="" alt=""
                            style="display: none; max-width: 100%; max-height: 200px; margin-top: 10px; border-radius: 8px; border: 2px solid #e0e0e0; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                        @error('featured_image_url')
                            <div class="invalid-feedback fw-bold fs-5" style="display:block;">{{ $message }}</div>
                        @enderror
                    </div>
                </fieldset>
                <fieldset>
                    <div class="body-title">Meta title <span class="tf-color-1">*</span></div>
                    <input class="flex-grow form-control @error('meta_title') is-invalid @enderror" type="text"
                        placeholder="Meta title" name="meta_title" id="meta_title" value="{{ old('meta_title') }}">
                    @error('meta_title')
                        <div class="invalid-feedback fw-bold fs-5" style="display:block;">{{ $message }}</div>
                    @enderror
                </fieldset>
                <fieldset>
                    <div class="body-title">Meta description <span class="tf-color-1">*</span></div>
                    <textarea class="flex-grow @error('meta_description') is-invalid @enderror" name="meta_description"
                        id="meta_description" rows="2" placeholder="Meta description">{{ old('meta_description') }}</textarea>
                    @error('meta_description')
                        <div class="invalid-feedback fw-bold fs-5" style="display:block;">{{ $message }}</div>
                    @enderror
                </fieldset>
                <fieldset>
                    <div class="body-title">Ngày xuất bản <span class="tf-color-1">*</span></div>
                    <input class="flex-grow form-control @error('published_at') is-invalid @enderror"
                        type="datetime-local" name="published_at" id="published_at" value="{{ old('published_at') }}">
                    @error('published_at')
                        <div class="invalid-feedback fw-bold fs-5" style="display:block;">{{ $message }}</div>
                    @enderror
                </fieldset>
                <div class="row mt-5">
                    <div class="col-md-6">
                        <button type="submit" class="tf-button w-100 py-3 fs-5">
                            <i class="bi bi-pencil-square me-1"></i> Thêm mới
                        </button>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ route('admin.pages.index') }}" class="tf-button style-3 w-100 py-3 fs-5">
                            <i class="bi bi-list me-1"></i> Danh sách
                        </a>
                    </div>
                </div>
            </form>
        </div>
        <!-- /new-page -->
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
        .tox-tinymce {
            min-height: 300px;
            max-height: 600px;
            overflow-y: auto;
            width: 100%;
            box-sizing: border-box;
            word-break: break-word;
            overflow-wrap: break-word;
            max-width: 100%;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .wg-box {
            width: 100%;
            overflow-x: hidden;
        }
        .form-new-product {
            max-width: 100%;
        }
        .ck-editor-container {
            width: 100%;
            max-width: 100%;
            margin-bottom: 15px;
        }
    </style>
    <script>
        // Tạo slug tự động khi nhập tiêu đề
        document.getElementById('title').addEventListener('input', function() {
            let title = this.value;
            let slug = title.toLowerCase()
                .normalize('NFD').replace(/[\u0300-\u036f]/g, '')
                .replace(/[^a-z0-9\s-]/g, '')
                .trim().replace(/\s+/g, '-');
            document.getElementById('slug').value = slug;
        });

        // Xử lý kéo thả và chọn ảnh
        const uploadLabel = document.querySelector('.uploadfile');
        const uploadInput = document.getElementById('featured_image_url');
        const preview = document.getElementById('featured_image_url-preview');

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
            }
        });

        // Hiển thị ảnh xem trước khi chọn file
        uploadInput.addEventListener('change', (e) => {
            const [file] = e.target.files;
            if (file) {
                preview.src = URL.createObjectURL(file);
                preview.style.display = 'block';
            } else {
                preview.src = '';
                preview.style.display = 'none';
            }
        });
    </script>
    @push('scripts')
        <script src="https://cdn.tiny.cloud/1/hs04m6101y0gorgukhuffqutjnhs52o68gb16y52y7nvuj6u/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
        <script>
            tinymce.init({
                selector: '#content',
                plugins: 'image media link table lists advlist',
                toolbar: 'undo redo | bold italic underline | alignleft aligncenter alignright | image media link | table bullist numlist | styleselect | formatselect | fontselect | fontsizeselect',
                height: 800,
                menubar: false,
                images_upload_url: '{{ route('admin.pages.upload-image') }}',
                images_upload_credentials: true,
                images_upload_handler: async (blobInfo, progress) => {
                    let formData = new FormData();
                    formData.append('file', blobInfo.blob(), blobInfo.filename());
                    formData.append('_token', '{{ csrf_token() }}');

                    const response = await fetch('{{ route('admin.pages.upload-image') }}', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'Accept': 'application/json'
                        }
                    });
                    const json = await response.json();
                    if (!json.location) {
                        throw new Error('Tải ảnh thất bại: ' + (json.error || 'Lỗi không xác định'));
                    }
                    return json.location;
                },
                readonly: false,
                image_caption: true,
                image_advtab: true,
                content_style: 'body { font-family: Arial, sans-serif; font-size: 14px; } img { max-width: 100%; height: auto; }'
            });
        </script>
    @endpush
    @push('head')
        <style>
            .tox-tinymce {
                min-height: 300px;
                max-height: 600px;
                overflow-y: auto;
                width: 100%;
                box-sizing: border-box;
                word-break: break-word;
                overflow-wrap: break-word;
                max-width: 100%;
                border: 1px solid #ccc;
                border-radius: 4px;
            }
            .wg-box {
                width: 100%;
                overflow-x: hidden;
            }
            .form-new-product {
                max-width: 100%;
            }
            .ck-editor-container {
                width: 100%;
                max-width: 100%;
                margin-bottom: 15px;
            }
        </style>
    @endpush
@endsection