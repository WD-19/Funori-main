@extends('admin.layout.admin')
@section('title', 'Cập nhật banner')
@section('content')
    <div class="main-content-inner">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="main-content-wrap">
            <h3 class="mb-4">Cập nhật banner</h3>
            <form action="{{ route('admin.banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data"
                class="wg-box w-100">
                @csrf
                @method('PUT')
                <fieldset class="mb-4">
                    <label class="body-title mb-2">Tiêu đề</label>
                    <input type="text" name="title" class="input-field" required
                        value="{{ old('title', $banner->title) }}">
                </fieldset>
                <fieldset class="mb-4">
                    <label class="body-title mb-2">Ảnh banner</label>
                    <input type="file" name="image" id="banner-image" class="form-control" accept="image/*">
                    <input type="hidden" name="cropped_image" id="cropped-image">
                    <div id="cropper-preview" class="mt-2">
                        @if ($banner->image_url)
                            <img src="{{ asset('storage/' . $banner->image_url) }}" style="max-width:100%;">
                        @endif
                    </div>
                </fieldset>
                <fieldset class="mb-4">
                    <label class="body-title mb-2">Link</label>
                    <input type="text" name="link_url" class="input-field" value="{{ old('link_url', $banner->link_url) }}">
                </fieldset>
                <fieldset class="mb-4">
                    <label class="body-title mb-2">Vị trí</label>
                    <select name="position" class="input-field" required>
                        @foreach ($positions as $pos)
                            <option value="{{ $pos }}" @if ($banner->position == $pos) selected @endif>
                                {{ $pos }}</option>
                        @endforeach
                        <option value="main" @if ($banner->position == 'main') selected @endif>main</option>
                        <option value="sidebar" @if ($banner->position == 'sidebar') selected @endif>sidebar</option>
                    </select>
                </fieldset>
                <fieldset class="mb-4">
                    <label class="body-title mb-2">Thứ tự</label>
                    <input type="number" name="order" class="input-field" value="{{ old('order', $banner->order) }}">
                </fieldset>
                <fieldset class="mb-4">
                    <label class="body-title mb-2">Thời gian hiển thị</label>
                    <div class="flex gap-2">
                        <input type="datetime-local" name="start_date" class="input-field"
                            value="{{ old('start_date', $banner->start_date ? \Carbon\Carbon::parse($banner->start_date)->format('Y-m-d\TH:i') : '') }}">
                        <span class="align-content-center">-</span>
                        <input type="datetime-local" name="end_date" class="input-field"
                            value="{{ old('end_date', $banner->end_date ? \Carbon\Carbon::parse($banner->end_date)->format('Y-m-d\TH:i') : '') }}">
                    </div>
                </fieldset>
                <fieldset class="mb-4">
                    <label class="body-title mb-2">Trạng thái</label>
                    <label class="switch">
                        <input type="checkbox" name="is_active" value="1"
                            {{ old('is_active', $banner->is_active) ? 'checked' : '' }}>
                        <span class="slider round"></span>
                    </label>
                </fieldset>

                <div class="row">
                    <div class="col-md-6">
                        <button type="submit" class="tf-button w-100 py-3 fs-5">
                            <i class="bi bi-pencil-square me-1"></i> Cập nhật
                        </button>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ route('admin.banners.index') }}" class="tf-button style-3 w-100 py-3 fs-5">
                            <i class="bi bi-list me-1"></i> Danh sách
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" />
        <script>
            let cropper;
            let croppedData = '';
            document.getElementById('banner-image')?.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (!file) return;
                const reader = new FileReader();
                reader.onload = function(ev) {
                    let img = document.createElement('img');
                    img.src = ev.target.result;
                    img.style.maxWidth = '100%';
                    document.getElementById('cropper-preview').innerHTML = '';
                    document.getElementById('cropper-preview').appendChild(img);
                    if (cropper) cropper.destroy();
                    cropper = new Cropper(img, {
                        aspectRatio: 2 / 1,
                        viewMode: 1,
                        autoCropArea: 1,
                    });
                };
                reader.readAsDataURL(file);
            });

            document.getElementById('submit-btn').addEventListener('click', function(e) {
                if (cropper) {
                    e.preventDefault();
                    cropper.getCroppedCanvas({
                        width: 1200,
                        height: 600,
                        imageSmoothingQuality: 'high'
                    }).toBlob(function(blob) {
                        let reader = new FileReader();
                        reader.onloadend = function() {
                            document.getElementById('cropped-image').value = reader.result;
                            e.target.form.submit();
                        };
                        reader.readAsDataURL(blob);
                    }, 'image/jpeg', 0.92);
                }
            });
        </script>
    @endpush
@endsection
