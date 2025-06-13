@extends('admin.layout.admin')

@section('title', 'Chi tiết sản phẩm')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0 fw-bold">Chi tiết sản phẩm</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 bg-white px-3 py-2 rounded shadow-sm">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.products.index') }}">Sản phẩm</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <!-- Thông tin sản phẩm -->
        <div class="col-lg-8">
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Thông tin sản phẩm</h5>
                </div>
                <div class="card-body">
                    <dl class="row mb-0">
                        <dt class="col-sm-4">Tên sản phẩm:</dt>
                        <dd class="col-sm-8 fw-semibold">{{ $product->name }}</dd>

                        <dt class="col-sm-4">Slug:</dt>
                        <dd class="col-sm-8">{{ $product->slug }}</dd>

                        <dt class="col-sm-4">Danh mục:</dt>
                        <dd class="col-sm-8">{{ $product->category->name ?? '-' }}</dd>

                        <dt class="col-sm-4">Thương hiệu:</dt>
                        <dd class="col-sm-8">{{ $product->brand->name ?? '-' }}</dd>

                        <dt class="col-sm-4">Giá gốc:</dt>
                        <dd class="col-sm-8 text-danger fw-bold">{{ number_format($product->regular_price, 0, ',', '.') }} đ</dd>

                        <dt class="col-sm-4">Tổng kho:</dt>
                        <dd class="col-sm-8">{{ $product->variants->sum('stock_quantity') }}</dd>

                        <dt class="col-sm-4">Trạng thái:</dt>
                        <dd class="col-sm-8">
                            @if($product->status == 'published')
                                <span class="badge bg-success">Hiển thị</span>
                            @elseif($product->status == 'draft')
                                <span class="badge bg-warning text-dark">Nháp</span>
                            @elseif($product->status == 'archived')
                                <span class="badge bg-secondary">Lưu trữ</span>
                            @else
                                <span class="badge bg-danger">Hết hàng</span>
                            @endif
                        </dd>

                        <dt class="col-sm-4">Ngày cập nhật:</dt>
                        <dd class="col-sm-8">{{ $product->updated_at->format('d/m/Y H:i') }}</dd>

                        <dt class="col-sm-4">Mô tả:</dt>
                        <dd class="col-sm-8">{!! nl2br(e($product->description)) !!}</dd>
                    </dl>
                </div>
            </div>

            @if(isset($product->variants) && count($product->variants))
            <!-- Biến thể -->
            <div class="card shadow-sm">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">Biến thể sản phẩm</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle">
                            <thead class="table-light text-center">
                                <tr>
                                    <th>Ảnh</th>
                                    <th>Kích thước</th>
                                    <th>Giá</th>
                                    <th>Kho</th>
                                    <th>Thuộc tính</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($product->variants as $variant)
                                <tr>
                                    <td class="text-center">
                                        @if($variant->image)
                                            <img src="{{ asset($variant->image->image_url) }}" alt="Ảnh variant" class="img-thumbnail" style="width: 60px; height: 60px; object-fit: cover;">
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td class="text-center">{{ $variant->size ?? '-' }}</td>
                                    <td class="text-danger text-center">
                                        @php $gia = $product->regular_price + $variant->price_modifier; @endphp
                                        {{ number_format($gia, 0, ',', '.') }} đ
                                    </td>
                                    <td class="text-center">{{ $variant->stock_quantity ?? '-' }}</td>
                                    <td>
                                        @if(isset($variant->attributeValues) && count($variant->attributeValues))
                                            @foreach($variant->attributeValues as $attrVal)
                                                <span class="badge bg-secondary me-1">{{ $attrVal->attribute->name }}: {{ $attrVal->value }}</span>
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
                </div>
            </div>
            @endif
        </div>

        <!-- Ảnh và tác vụ -->
        <div class="col-lg-4">
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-light">
                    <h5 class="mb-0">Ảnh sản phẩm</h5>
                </div>
                <div class="card-body text-center">
                    @if($product->images->count())
                        <img src="{{ asset($product->images->first()->image_url) }}" class="img-fluid rounded shadow mb-3" style="max-height:180px; object-fit: cover;" alt="Ảnh sản phẩm">
                        <div class="d-flex flex-wrap justify-content-center gap-2">
                            @foreach($product->images as $img)
                                <img src="{{ asset($img->image_url) }}" class="img-thumbnail border border-1" style="width:48px; height:48px; object-fit:cover;" alt="Ảnh phụ">
                            @endforeach
                        </div>
                    @else
                        <div class="bg-light text-muted py-5 rounded">Không có ảnh</div>
                    @endif
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-header bg-light">
                    <h5 class="mb-0">Tác vụ</h5>
                </div>
                <div class="card-body">
                    <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-outline-primary w-100 mb-2">
                        <i class="bi bi-pencil-square me-1"></i> Sửa sản phẩm
                    </a>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary w-100">
                        <i class="bi bi-list me-1"></i> Quay lại danh sách
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
