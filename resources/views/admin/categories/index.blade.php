@extends('admin.layout.admin')

@section('title', 'Danh sách danh mục')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Danh sách danh mục</h2>
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Tên danh mục</th>
                    <th>Danh mục cha</th>
                    <th>Trạng thái</th>
                    <th>Hình ảnh</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>
                            <strong>{{ str_repeat('*', $category->depth ?? 0) }}{{ $category->name }}</strong>
                        </td>
                        <td>{{ $category->parent ? $category->parent->name : 'Không có' }}</td>
                        <td>{{ $category->is_active ? 'Kích hoạt' : 'Không kích hoạt' }}</td>
                        <td>{{ $category->image_url }}</td>
                        <td>
                            <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-sm btn-primary">Sửa</a>
                            <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Xóa danh mục này?')">Xóa</button>
                            </form>
                        </td>
                    </tr>
                    @foreach ($category->children as $child)
                        <tr>
                            <td>{{ $child->id }}</td>
                            <td>
                                <strong>{{ str_repeat('*', $child->depth ?? 1) }}{{ $child->name }}</strong>
                            </td>
                            <td>{{ $child->parent ? $child->parent->name : 'Không có' }}</td>
                            <td>{{ $child->is_active ? 'Kích hoạt' : 'Không kích hoạt' }}</td>
                            <td>{{ $child->image_url }}</td>
                            <td>
                                <a href="{{ route('admin.categories.edit', $child->id) }}" class="btn btn-sm btn-primary">Sửa</a>
                                <form action="{{ route('admin.categories.destroy', $child->id) }}" method="POST" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Xóa danh mục này?')">Xóa</button>
                                </form>
                            </td>
                    </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
        <div>
            {{ $categories->links() }}
        </div>
    </div>
</div>

@endsection