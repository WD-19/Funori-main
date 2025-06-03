@extends('admin.layout.admin')

@section('title', 'Danh sách thuộc tính')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Danh sách sản phẩm</h2>
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Tên thuộc tính</th>
                    <th>Giá trị</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($attributes as $attributea)
                <tr>
                    <td>
                        <strong>{{ $attributea->attribute->name }}</strong>
                    </td>
                    <td>{{ $attributea->value }}</td>
                    <td>
                        <a href="{{ route('admin.attributes.edit', $attributea->id) }}" class="btn btn-sm btn-primary">Sửa</a>
                        <form action="{{ route('admin.attributes.destroy', $attributea->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Xóa thuộc tính này?')">Xóa</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div>
            {{ $attributes->links() }}
        </div>
    </div>
</div>
@endsection