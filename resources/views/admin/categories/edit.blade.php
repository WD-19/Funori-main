{{-- filepath: c:\laragon\www\Funori-main\resources\views\admin\categories\edit.blade.php --}}
@extends('admin.layout.admin')

@section('content')
<div class="container">
    <h2>Sửa danh mục</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">
                Tên danh mục <span class="text-danger">*</span>
            </label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name', $category->name) }}">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <input type="hidden" name="slug" id="slug" value="{{ old('slug', $category->slug) }}">
        <div class="mb-3">
            <label for="parent_id" class="form-label">Danh mục cha</label>
            <select name="parent_id" id="parent_id" class="form-control @error('parent_id') is-invalid @enderror">
                <option value="">-- Không có --</option>
                @foreach($parents as $parent)
                    <option value="{{ $parent->id }}" {{ old('parent_id', $category->parent_id) == $parent->id ? 'selected' : '' }}>
                        {{ $parent->name }}
                    </option>
                @endforeach
            </select>
            @error('parent_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Mô tả</label>
            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror">{{ old('description', $category->description) }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="image_url" class="form-label">
                Ảnh
            </label>
            @if($category->image_url)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $category->image_url) }}" alt="Ảnh danh mục" style="max-width: 120px;">
                </div>
            @endif
            <input type="file" name="image_url" id="image_url" class="form-control @error('image_url') is-invalid @enderror" accept="image/*">
            @error('image_url')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="is_active" class="form-label">
                Trạng thái <span class="text-danger">*</span>
            </label>
            <select name="is_active" id="is_active" class="form-control @error('is_active') is-invalid @enderror">
                <option value="1" {{ old('is_active', $category->is_active) == '1' ? 'selected' : '' }}>Kích hoạt</option>
                <option value="0" {{ old('is_active', $category->is_active) == '0' ? 'selected' : '' }}>Không kích hoạt</option>
            </select>
            @error('is_active')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Ngày tạo</label>
            <input type="text" class="form-control" value="{{ $category->created_at }}" readonly>
        </div>
        <div class="mb-3">
            <label class="form-label">Ngày cập nhật</label>
            <input type="text" class="form-control" value="{{ $category->updated_at }}" readonly>
        </div>
        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
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
</script>
@endsection