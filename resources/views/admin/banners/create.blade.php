z@extends('admin.layout.admin')

@section('title', 'Thêm banner mới')

@section('content')
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <h3 class="mb-4">Thêm banner mới</h3>
            <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data" class="wg-box w-100">
                @csrf
                <fieldset class="mb-4">
                    <label class="body-title mb-2">Tiêu đề</label>
                    <input type="text" name="title" class="input-field" value="{{ old('title') }}">
                    @error('title')
                        <div class="text-danger mt-1" style="font-size:1.25rem; padding:8px; display:block;">{{ $message }}</div>
                    @enderror
                </fieldset>
                <fieldset class="mb-4">
                    <label class="body-title mb-2">Ảnh banner</label>
                    <input type="file" name="image" id="banner-image" class="input-field" accept="image/*">
                    @error('image')
                        <div class="text-danger mt-1" style="font-size:1.25rem; padding:8px; display:block;">{{ $message }}</div>
                    @enderror
                    <div id="image-preview" class="mt-2"></div>
                </fieldset>
                <fieldset class="mb-4">
                    <label class="body-title mb-2">Link</label>
<<<<<<< HEAD
                    <input type="text" name="link_url" class="input-field" value="{{ old('link_url') }}">
=======
                    <input type="text" name="link" class="input-field" value="{{ old('link') }}">
                    @error('link')
                        <div class="text-danger mt-1" style="font-size:1.25rem; padding:8px; display:block;">{{ $message }}</div>
                    @enderror
>>>>>>> origin
                </fieldset>
                <fieldset class="mb-4">
                    <label class="body-title mb-2">Vị trí</label>
                    <select name="position" class="input-field">
                        @foreach ($positions as $pos)
                            <option value="{{ $pos }}">{{ $pos }}</option>
                        @endforeach
                        <option value="main">main</option>
                        <option value="sidebar">sidebar</option>
                    </select>
                    @error('position')
                        <div class="text-danger mt-1" style="font-size:1.25rem; padding:8px; display:block;">{{ $message }}</div>
                    @enderror
                </fieldset>
                <fieldset class="mb-4">
                    <label class="body-title mb-2">Thứ tự</label>
                    <input type="number" name="order" class="input-field" value="{{ old('order', 1) }}">
                    @error('order')
                        <div class="text-danger mt-1" style="font-size:1.25rem; padding:8px; display:block;">{{ $message }}</div>
                    @enderror
                </fieldset>
                <fieldset class="mb-4">
                    <label class="body-title mb-2">Thời gian hiển thị</label>
                    <div class="flex gap-2">
<<<<<<< HEAD
                        <input type="datetime-local" name="start_date" class="input-field" value="{{ old('start_date') }}">
                        <span>đến</span>
                        <input type="datetime-local" name="end_date" class="input-field" value="{{ old('end_date') }}">
=======
                        <div>
                            <input type="datetime-local" name="start_at" class="input-field" value="{{ old('start_at') }}">
                            @error('start_at')
                                <div class="text-danger mt-1" style="font-size:1.25rem; padding:8px; display:block;">{{ $message }}</div>
                            @enderror
                        </div>
                        <span>đến</span>
                        <div>
                            <input type="datetime-local" name="end_at" class="input-field" value="{{ old('end_at') }}">
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
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', 1) ? 'checked' : '' }}>
                        <span class="slider round"></span>
                    </label>
                    @error('is_active')
                        <div class="text-danger mt-1" style="font-size:1.25rem; padding:8px; display:block;">{{ $message }}</div>
                    @enderror
                </fieldset>
                <button class="tf-button" type="submit" id="submit-btn">Tạo banner</button>
                <a href="{{ route('admin.banners.index') }}" class="tf-button style-2 ml-2">Quay lại</a>
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