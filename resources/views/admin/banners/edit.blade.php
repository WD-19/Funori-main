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
                    <div id="image-preview" class="mt-2">
                        @if ($banner->image_url)
                            <img src="{{ asset('storage/' . $banner->image_url) }}" style="width: 100%; height: auto; display: block;">
                        @endif
                    </div>
                </fieldset>
                <fieldset class="mb-4">
                    <label class="body-title mb-2">Link</label>
                    <input type="text" name="link" class="input-field" value="{{ old('link', $banner->link) }}">
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
                        <input type="datetime-local" name="start_at" class="input-field"
                            value="{{ old('start_at', $banner->start_at ? \Carbon\Carbon::parse($banner->start_at)->format('Y-m-d\TH:i') : '') }}">
                        <span class="align-content-center">-</span>
                        <input type="datetime-local" name="end_at" class="input-field"
                            value="{{ old('end_at', $banner->end_at ? \Carbon\Carbon::parse($banner->end_at)->format('Y-m-d\TH:i') : '') }}">
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
        <script>
            document.getElementById('banner-image')?.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (!file) return;
                const reader = new FileReader();
                reader.onload = function(ev) {
                    const img = document.createElement('img');
                    img.src = ev.target.result;
                    img.style.width = '100%'; // Hiển thị full chiều rộng
                    img.style.height = 'auto'; // Giữ tỷ lệ khung hình
                    document.getElementById('image-preview').innerHTML = '';
                    document.getElementById('image-preview').appendChild(img);
                };
                reader.readAsDataURL(file);
            });
        </script>
    @endpush
@endsection