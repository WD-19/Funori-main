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
        <form action="{{ route('admin.banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data" class="wg-box" style="max-width:600px;">
            @csrf
            @method('PUT')
            <fieldset class="mb-4">
                <label class="body-title mb-2">Tiêu đề</label>
                <input type="text" name="title" class="input-field" required value="{{ old('title', $banner->title) }}">
            </fieldset>
            <fieldset class="mb-4">
                <label class="body-title mb-2">Ảnh banner</label>
                <input type="file" name="image" id="banner-image" class="input-field" accept="image/*">
                <input type="hidden" name="cropped_image" id="cropped-image">
                <div id="cropper-preview" class="mt-2">
                    @if($banner->image_url)
                        <img src="{{ asset('storage/'.$banner->image_url) }}" style="max-width:100%;">
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
                    @foreach($positions as $pos)
                        <option value="{{ $pos }}" @if($banner->position==$pos) selected @endif>{{ $pos }}</option>
                    @endforeach
                    <option value="main" @if($banner->position=='main') selected @endif>main</option>
                    <option value="sidebar" @if($banner->position=='sidebar') selected @endif>sidebar</option>
                </select>
            </fieldset>
            <fieldset class="mb-4">
                <label class="body-title mb-2">Thứ tự</label>
                <input type="number" name="order" class="input-field" value="{{ old('order', $banner->order) }}">
            </fieldset>
            <fieldset class="mb-4">
                <label class="body-title mb-2">Thời gian hiển thị</label>
                <div class="flex gap-2">
                    <input type="datetime-local" name="start_at" class="input-field" value="{{ old('start_at', $banner->start_at ? \Carbon\Carbon::parse($banner->start_at)->format('Y-m-d\TH:i') : '') }}">
                    <span>đến</span>
                    <input type="datetime-local" name="end_at" class="input-field" value="{{ old('end_at', $banner->end_at ? \Carbon\Carbon::parse($banner->end_at)->format('Y-m-d\TH:i') : '') }}">
                </div>
            </fieldset>
            <fieldset class="mb-4">
                <label class="body-title mb-2">Trạng thái</label>
                <label class="switch">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $banner->is_active) ? 'checked' : '' }}>
                    <span class="slider round"></span>
                </label>
            </fieldset>
            <button class="tf-button" type="submit" id="submit-btn">Cập nhật</button>
            <a href="{{ route('admin.banners.index') }}" class="tf-button style-2 ml-2">Quay lại</a>
        </form>
    </div>
</div>
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css"/>
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
            aspectRatio: 2/1,
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
