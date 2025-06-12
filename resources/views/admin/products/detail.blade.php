@extends('admin.layout.admin')

@section('title', 'Chi tiết sản phẩm')

@section('content')
<div class="main-content-inner">
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-30">
            <h3>Chi tiết sản phẩm</h3>
            <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                <li>
                    <a href="{{ route('admin.dashboard') }}">
                        <div class="text-tiny">Dashboard</div>
                    </a>
                </li>
                <li><i class="icon-chevron-right"></i></li>
                <li>
                    <a href="{{ route('admin.products.index') }}">
                        <div class="text-tiny">Sản phẩm</div>
                    </a>
                </li>
                <li><i class="icon-chevron-right"></i></li>
                <li>
                    <div class="text-tiny">{{ $product->name }}</div>
                </li>
            </ul>
        </div>
        <div class="wg-product-detail">
            <div class="left flex-grow">
                <div class="wg-box mb-20">
                    <div class="wg-table table-product-detail">
                        <ul class="table-title flex items-center gap20 mb-24">
                            <li>
                                <div class="body-title">Thông tin sản phẩm</div>
                            </li>
                        </ul>
                        <ul class="flex flex-column gap14">
                            <li class="product-detail-item">
                                <span class="body-text">Tên sản phẩm:</span>
                                <span class="body-title-2">{{ $product->name }}</span>
                            </li>
                            <li class="product-detail-item">
                                <span class="body-text">Slug:</span>
                                <span class="body-title-2">{{ $product->slug }}</span>
                            </li>
                            <li class="product-detail-item">
                                <span class="body-text">Danh mục:</span>
                                <span class="body-title-2">{{ $product->category->name ?? '-' }}</span>
                            </li>
                            <li class="product-detail-item">
                                <span class="body-text">Thương hiệu:</span>
                                <span class="body-title-2">{{ $product->brand->name ?? '-' }}</span>
                            </li>
                            <li class="product-detail-item">
                                <span class="body-text">Giá gốc:</span>
                                <span class="body-title-2 tf-color-1">{{ number_format($product->regular_price, 0, ',', '.') }} đ</span>
                            </li>
                            <li class="product-detail-item">
                                <span class="body-text">Tổng kho:</span>
                                <span class="body-title-2">{{ $product->variants->sum('stock_quantity') }}</span>
                            </li>
                            <li class="product-detail-item">
                                <span class="body-text">Trạng thái:</span>
                                <span class="body-title-2">
                                    @if($product->status == 'published')
                                        <span class="block-available bg-1 fw-7">Hiển thị</span>
                                    @elseif($product->status == 'draft')
                                        <span class="block-pending bg-1 fw-7">Nháp</span>
                                    @elseif($product->status == 'archived')
                                        <span class="block-pending bg-1 fw-7" style="background:#6c757d">Lưu trữ</span>
                                    @else
                                        <span class="block-pending bg-1 fw-7" style="background:#f87171">Hết hàng</span>
                                    @endif
                                </span>
                            </li>
                            <li class="product-detail-item">
                                <span class="body-text">Ngày cập nhật:</span>
                                <span class="body-title-2">{{ $product->updated_at->format('d/m/Y H:i') }}</span>
                            </li>
                            <li class="product-detail-item">
                                <span class="body-text">Mô tả:</span>
                                <span class="body-title-2">{!! nl2br(e($product->description)) !!}</span>
                            </li>
                        </ul>
                    </div>
                </div>
                @if(isset($product->variants) && count($product->variants))
                <div class="wg-box">
                    <div class="wg-table table-product-variants">
                        <ul class="table-title flex mb-24">
                            <li><div class="body-title">Biến thể</div></li>
                            <li><div class="body-title">Kích thước</div></li>
                            <li><div class="body-title">Giá</div></li>
                            <li><div class="body-title">Kho</div></li>
                            <li><div class="body-title">Thuộc tính</div></li>
                        </ul>
                        <ul class="flex flex-column gap14">
                            @foreach($product->variants as $variant)
                            <li class="wg-product">
                                <div class="image">
                                    @if($variant->image)
                                        <img src="{{ asset($variant->image->image_url) }}" alt="Ảnh variant">
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </div>
                                <div>{{ $variant->size ?? '-' }}</div>
                                <div>
                                    @php
                                        $gia = $product->regular_price + $variant->price_modifier;
                                    @endphp
                                    <span class="body-title-2 tf-color-1">{{ number_format($gia, 0, ',', '.') }} đ</span>
                                </div>
                                <div>{{ $variant->stock_quantity ?? '-' }}</div>
                                <div>
                                    @if(isset($variant->attributeValues) && count($variant->attributeValues))
                                        @foreach($variant->attributeValues as $attrVal)
                                            <span class="badge bg-info text-dark me-1 mb-1">{{ $attrVal->attribute->name }}: {{ $attrVal->value }}</span>
                                        @endforeach
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif
            </div>
            <div class="right">
                <div class="wg-box mb-20 gap10">
                    <div class="body-title">Ảnh sản phẩm</div>
                    @if($product->images->count())
                        <div class="mb-3 text-center">
                            <img src="{{ asset($product->images->first()->image_url) }}" alt="Ảnh sản phẩm" class="img-fluid rounded shadow mb-2" style="max-height:180px;object-fit:cover;">
                        </div>
                        <div class="d-flex flex-wrap gap-2 justify-content-center">
                            @foreach($product->images as $img)
                                <img src="{{ asset($img->image_url) }}" alt="Ảnh phụ" class="img-thumbnail border-0" style="width:48px;height:48px;object-fit:cover;">
                            @endforeach
                        </div>
                    @else
                        <div class="bg-light text-center py-5 rounded mb-3 text-muted fs-5">Không có ảnh</div>
                    @endif
                </div>
                <div class="wg-box mb-20 gap10">
                    <div class="body-title">Tác vụ</div>
                    <a href="{{ route('admin.products.edit', $product->id) }}" class="tf-button style-1 w-full mb-2"><i class="icon-edit-3"></i> Sửa</a>
                    <a href="{{ route('admin.products.index') }}" class="tf-button w-full"><i class="icon-list"></i> Quay lại danh sách</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection