@extends('admin.layout.admin')

@section('title', 'Chi tiết sản phẩm')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Chi tiết sản phẩm</h2>
    <div class="row">
        <div class="col-md-4">
            @if($product->images->count())
                <img src="{{ $product->images->first()->url ?? '#' }}" alt="Ảnh sản phẩm" class="img-fluid rounded shadow-sm mb-3">
            @else
                <div class="bg-light text-center py-5 rounded mb-3 text-muted">Không có ảnh</div>
            @endif
        </div>
        <div class="col-md-8">
            <h3>{{ $product->name }}</h3>
            <div class="mb-2 text-muted">{{ $product->slug }}</div>
            <p><strong>Danh mục:</strong> {{ $product->category->name ?? '-' }}</p>
            <p><strong>Thương hiệu:</strong> {{ $product->brand->name ?? '-' }}</p>
            <p><strong>Giá gốc:</strong> {{ number_format($product->regular_price, 0, ',', '.') }} đ</p>
            <p><strong>Số lượng kho:</strong> {{ $product->stock_quantity }}</p>
            <p><strong>Trạng thái:</strong>
                @if($product->status == 'published')
                    <span class="badge bg-success">Hiển thị</span>
                @elseif($product->status == 'draft')
                    <span class="badge bg-secondary">Nháp</span>
                @elseif($product->status == 'archived')
                    <span class="badge bg-dark">Lưu trữ</span>
                @else
                    <span class="badge bg-danger">Hết hàng</span>
                @endif
            </p>
            <p><strong>Nổi bật:</strong>
                @if($product->is_featured)
                    <span class="badge bg-warning text-dark">Nổi bật</span>
                @else
                    <span class="text-muted">Không</span>
                @endif
            </p>
            <p><strong>Mô tả:</strong></p>
            <div class="border rounded p-3 bg-light mb-3">{!! nl2br(e($product->description)) !!}</div>


            @if(isset($product->variants) && count($product->variants))
                <div class="mb-3">
                    <h5>Các biến thể</h5>
                    <table class="table table-bordered table-sm">
                        <thead>
                            <tr>
                                <th>SKU</th>
                                <th>Giá</th>
                                <th>Kho</th>
                                <th>Thuộc tính</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($product->variants as $variant)
                                <tr>
                                    <td>{{ $variant->sku ?? '-' }}</td>
                                    <td>{{ number_format($variant->price_modifier ?? 0, 0, ',', '.') }} %</td>
                                    <td>{{ $variant->stock_quantity ?? '-' }}</td>
                                    <td>
                                        @if(isset($variant->attributeValues) && count($variant->attributeValues))
                                            @foreach($variant->attributeValues as $attrVal)
                                                <span>{{ $attrVal->attribute->name }}: {{ $attrVal->value }}</span>
                                            @endforeach
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

            <div class="mt-4">
                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-primary">Sửa</a>
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Quay lại danh sách</a>
            </div>
        </div>
    </div>
</div>
@endsection