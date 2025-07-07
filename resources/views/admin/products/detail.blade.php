@extends('admin.layout.admin')

@section('title', 'Chi tiết sản phẩm')

@section('content')
<style>
    .img-hover-zoom {
        transition: transform 0.3s ease-in-out;
    }
    .img-hover-zoom:hover {
        transform: scale(1.05);
    }
    .product-thumb {
        width: 64px;
        height: 64px;
        object-fit: cover;
    }
    .img-main {
        max-height: 220px;
        object-fit: cover;
    }
    .card h5, dt, dd, .table, .breadcrumb {
        font-size: 1.05rem;
    }
    .card-body {
        font-size: 1.1rem;
        line-height: 1.6;
    }
    .badge {
        font-size: 1rem;
        padding: 0.5em 0.75em;
    }
    .btn {
        font-size: 1.05rem;
        padding: 0.6em 1em;
    }
</style>

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold mb-0 fs-3">🛍 Chi tiết sản phẩm</h3>
    </div>

    <div class="row">
        <!-- Thông tin sản phẩm -->
        <div class="col-lg-8">
            <div class="card shadow-sm mb-4" style="background: #f8f9fa; border-radius: 14px;">
                <div class="card-header bg-primary text-white" style="border-radius: 14px 14px 0 0;">
                    <h5 class="mb-0 fs-4">📄 Thông tin sản phẩm</h5>
                </div>
                <div class="card-body">
                    <dl class="row" style="margin-bottom:0; font-size:1.25rem;">
                        <dt class="col-sm-4" style="background:#f3f3f3; padding:12px; border-radius:6px; font-size:1.15rem;">Tên sản phẩm:</dt>
                        <dd class="col-sm-8 fw-semibold" style="padding:12px; font-size:1.25rem;">{{ $product->name }}</dd>

                        <dt class="col-sm-4" style="background:#f3f3f3; padding:12px; border-radius:6px; font-size:1.15rem;">Slug:</dt>
                        <dd class="col-sm-8" style="padding:12px; font-size:1.15rem;">{{ $product->slug }}</dd>

                        <dt class="col-sm-4" style="background:#f3f3f3; padding:12px; border-radius:6px; font-size:1.15rem;">Danh mục:</dt>
                        <dd class="col-sm-8" style="padding:12px; font-size:1.15rem;">{{ $product->category->name ?? '-' }}</dd>

                        <dt class="col-sm-4" style="background:#f3f3f3; padding:12px; border-radius:6px; font-size:1.15rem;">Thương hiệu:</dt>
                        <dd class="col-sm-8" style="padding:12px; font-size:1.15rem;">{{ $product->brand->name ?? '-' }}</dd>

                        <dt class="col-sm-4" style="background:#f3f3f3; padding:12px; border-radius:6px; font-size:1.15rem;">Giá gốc:</dt>
                        <dd class="col-sm-8 text-danger fw-bold" style="padding:12px; font-size:1.3rem;">{{ number_format($product->regular_price, 0, ',', '.') }} đ</dd>

                        <dt class="col-sm-4" style="background:#f3f3f3; padding:12px; border-radius:6px; font-size:1.15rem;">Tổng kho:</dt>
                        <dd class="col-sm-8" style="padding:12px; font-size:1.15rem;">{{ $product->variants->sum('stock_quantity') }}</dd>

                        <dt class="col-sm-4" style="background:#f3f3f3; padding:12px; border-radius:6px; font-size:1.15rem;">Trạng thái:</dt>
                        <dd class="col-sm-8" style="padding:12px; font-size:1.15rem;">
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

                        <dt class="col-sm-4" style="background:#f3f3f3; padding:12px; border-radius:6px; font-size:1.15rem;">Ngày cập nhật:</dt>
                        <dd class="col-sm-8" style="padding:12px; font-size:1.15rem;">{{ $product->updated_at->format('d/m/Y H:i') }}</dd>

                        <dt class="col-sm-4" style="background:#f3f3f3; padding:12px; border-radius:6px; font-size:1.15rem;">Mô tả:</dt>
                        <dd class="col-sm-8" style="padding:12px; font-size:1.15rem;">{!! nl2br(e($product->description)) !!}</dd>
                    </dl>
                </div>
            </div>

            @if($product->variants && count($product->variants))
            <div class="card shadow-sm" style="background: #f8f9fa; border-radius: 14px;">
                <div class="card-header bg-info text-white" style="border-radius: 14px 14px 0 0;">
                    <h5 class="mb-0" style="font-size:1.5rem;">🔧 Biến thể sản phẩm</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle text-center" style="background: #fff; font-size:1.15rem;">
                            <thead class="table-light fs-6">
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
                                    <td>
                                        @if($variant->image)
                                            <img src="{{ asset($variant->image->image_url) }}" class="img-thumbnail img-hover-zoom" style="width: 72px; height: 72px;" alt="Ảnh biến thể">
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>{{ $variant->size ?? '-' }}</td>
                                    <td class="text-danger">
                                        {{ number_format($product->regular_price + $variant->price_modifier, 0, ',', '.') }} đ
                                    </td>
                                    <td>{{ $variant->stock_quantity ?? '-' }}</td>
                                    <td>
                                        @forelse($variant->attributeValues as $attrVal)
                                            <span class="badge bg-secondary me-2 mb-2" style="font-size:1rem; padding:8px 12px; display:inline-block;">{{ $attrVal->attribute->name }}: {{ $attrVal->value }}</span>
                                        @empty
                                            <span class="text-muted">-</span>
                                        @endforelse
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
            <div class="card shadow-sm mb-4" style="background: #f8f9fa; border-radius: 14px;">
                <div class="card-header bg-light" style="border-radius: 14px 14px 0 0;">
                    <h5 class="mb-0 fs-5">🖼 Ảnh sản phẩm</h5>
                </div>
                <div class="card-body text-center">
                    @if($product->images->count())
                        <img src="{{ asset($product->images->first()->image_url) }}" class="img-fluid rounded shadow img-main img-hover-zoom mb-3" alt="Ảnh chính">
                        <div class="d-flex flex-wrap justify-content-center gap-2">
                            @foreach($product->images as $img)
                                <img src="{{ asset($img->image_url) }}" class="img-thumbnail border product-thumb img-hover-zoom" alt="Ảnh phụ">
                            @endforeach
                        </div>
                    @else
                        <div class="bg-light text-muted py-5 rounded">Không có ảnh</div>
                    @endif
                </div>
            </div>

            <div class="card shadow-sm" style="background: #f8f9fa; border-radius: 14px;">
                <div class="card-header bg-light" style="border-radius: 14px 14px 0 0;">
                    <h5 class="mb-0 fs-5">🛠 Tác vụ</h5>
                </div>
                <div class="card-body d-grid gap-2">
                    <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-outline-primary">
                        <i class="bi bi-pencil-square me-1"></i> Sửa sản phẩm
                    </a>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-list me-1"></i> Quay lại danh sách
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


