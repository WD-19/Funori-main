@extends('admin.layout.admin')

@section('title', 'Danh sách sản phẩm')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Danh sách sản phẩm</h2>
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Ảnh</th>
                    <th>Tên sản phẩm</th>
                    <th>Danh mục</th>
                    <th>Thương hiệu</th>
                    <th>Giá</th>
                    <th>Kho</th>
                    <th>Trạng thái</th>
                    <th>Nổi bật</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>
                        @if($product->images->count())
                        <img src="{{ $product->images->first()->url ?? '#' }}" alt="Ảnh" width="60" height="60" style="object-fit:cover;border-radius:8px;">
                        @else
                        <span class="text-muted">Không có ảnh</span>
                        @endif
                    </td>
                    <td>
                        <strong>{{ $product->name }}</strong>
                        <div class="text-muted small">{{ $product->slug }}</div>
                    </td>
                    <td>{{ $product->category->name ?? '-' }}</td>
                    <td>{{ $product->brand->name ?? '-' }}</td>
                    <td>
                        {{ number_format($product->regular_price, 0, ',', '.') }} đ
                    </td>
                    <td>
                        {{ $product->stock_quantity }}
                    </td>
                    <td>
                        @if($product->status == 'published')
                        <span class="badge bg-success">Hiển thị</span>
                        @elseif($product->status == 'draft')
                        <span class="badge bg-secondary">Nháp</span>
                        @elseif($product->status == 'archived')
                        <span class="badge bg-dark">Lưu trữ</span>
                        @else
                        <span class="badge bg-danger">Hết hàng</span>
                        @endif
                    </td>
                    <td>
                        @if($product->is_featured)
                        <span class="badge bg-warning text-dark">Nổi bật</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-primary">Sửa</a>
                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Xóa sản phẩm này?')">Xóa</button>
                        </form>
                        <a href="{{ route('admin.products.show', $product->id) }}" class="btn btn-sm btn-info">Chi tiet</a>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div>
            {{ $products->links() }}
        </div>
    </div>
</div>
@endsection