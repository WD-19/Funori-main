@extends('admin.layout.admin')

@section('title', 'Cập nhật banner')

@section('content')
    <div class="main-content-inner">
        @if (session('success'))
            <div class="alert alert-success" style="font-size:1.5rem; font-weight:bold; padding:15px;">
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
                    <input type="text" name="title" class="input-field"
                        value="{{ old('title', $banner->title) }}">
                    @error('title')
                        <div class="text-danger mt-1" style="font-size:1.25rem; padding:8px; display:block;">{{ $message }}</div>
                    @enderror
                </fieldset>
                <fieldset class="mb-4">
                    <label class="body-title mb-2">Ảnh banner</label>
                    <input type="file" name="image" id="banner-image" class="form-control" accept="image/*">
                    @error('image')
                        <div class="text-danger mt-1" style="font-size:1.25rem; padding:8px; display:block;">{{ $message }}</div>
                    @enderror
                    <div id="image-preview" class="mt-2">
                        @if ($banner->image_url)
                            <img src="{{ asset('storage/' . $banner->image_url) }}" style="width: 100%; height: auto; display: block;">
                        @endif
                    </div>
                </fieldset>
                <fieldset class="mb-4">
                    <label class="body-title mb-2">Link</label>
<<<<<<< HEAD
                    <input type="text" name="link_url" class="input-field" value="{{ old('link_url', $banner->link_url) }}">
=======
                    <input type="text" name="link" class="input-field" value="{{ old('link', $banner->link) }}">
                    @error('link')
                        <div class="text-danger mt-1" style="font-size:1.25rem; padding:8px; display:block;">{{ $message }}</div>
                    @enderror
>>>>>>> origin
                </fieldset>
                <fieldset class="mb-4">
                    <label class="body-title mb-2">Vị trí</label>
                    <select name="position" class="input-field">
                        @foreach ($positions as $pos)
                            <option value="{{ $pos }}" @if ($banner->position == $pos) selected @endif>
                                {{ $pos }}</option>
                        @endforeach
                        <option value="main" @if ($banner->position == 'main') selected @endif>main</option>
                        <option value="sidebar" @if ($banner->position == 'sidebar') selected @endif>sidebar</option>
                    </select>
                    @error('position')
                        <div class="text-danger mt-1" style="font-size:1.25rem; padding:8px; display:block;">{{ $message }}</div>
                    @enderror
                </fieldset>
                <fieldset class="mb-4">
                    <label class="body-title mb-2">Thứ tự</label>
                    <input type="number" name="order" class="input-field" value="{{ old('order', $banner->order) }}">
                    @error('order')
                        <div class="text-danger mt-1" style="font-size:1.25rem; padding:8px; display:block;">{{ $message }}</div>
                    @enderror
                </fieldset>
                <fieldset class="mb-4">
                    <label class="body-title mb-2">Thời gian hiển thị</label>
                    <div class="flex gap-2">
<<<<<<< HEAD
                        <input type="datetime-local" name="start_date" class="input-field"
                            value="{{ old('start_date', $banner->start_date ? \Carbon\Carbon::parse($banner->start_date)->format('Y-m-d\TH:i') : '') }}">
                        <span class="align-content-center">-</span>
                        <input type="datetime-local" name="end_date" class="input-field"
                            value="{{ old('end_date', $banner->end_date ? \Carbon\Carbon::parse($banner->end_date)->format('Y-m-d\TH:i') : '') }}">
=======
                        <div>
                            <input type="datetime-local" name="start_at" class="input-field"
                                value="{{ old('start_at', $banner->start_at ? \Carbon\Carbon::parse($banner->start_at)->format('Y-m-d\TH:i') : '') }}">
                            @error('start_at')
                                <div class="text-danger mt-1" style="font-size:1.25rem; padding:8px; display:block;">{{ $message }}</div>
                            @enderror
                        </div>
                        <span class="align-content-center">-</span>
                        <div>
                            <input type="datetime-local" name="end_at" class="input-field"
                                value="{{ old('end_at', $banner->end_at ? \Carbon\Carbon::parse($banner->end_at)->format('Y-m-d\TH:i') : '') }}">
                            @error('end_at')
                                <div class="text-danger mt-1" style="font-size:1.25rem; padding:8px; display:block;">{{ $message }}</div>
                            @enderror
                        </div>
>>>>>>> origin
                    </div>
                </fieldset>
                <fieldset class="mb-4">
                    <label class="body-title mb-2">Trạng thái</label>
                    <label class="switch">
                        <input type="checkbox" name="is_active" value="1"
                            {{ old('is_active', $banner->is_active) ? 'checked' : '' }}>
                        <span class="slider round"></span>
                    </label>
                    @error('is_active')
                        <div class="text-danger mt-1" style="font-size:1.25rem; padding:8px; display:block;">{{ $message }}</div>
                    @enderror
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