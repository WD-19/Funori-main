@extends('admin.layout.admin')

@section('title', 'Danh sách sản phẩm')

@section('content')
<div class="main-content-inner">
    <!-- main-content-wrap -->
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-30">
            <h3>Danh sách sản phẩm</h3>
            <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                <li>
                    <a href="index.html">
                        <div class="text-tiny">Trang chủ</div>
                    </a>
                </li>
                <li>
                    <i class="icon-chevron-right"></i>
                </li>
                <li>
                    <a href="#">
                        <div class="text-tiny">Sản phẩm</div>
                    </a>
                </li>
                <li>
                    <i class="icon-chevron-right"></i>
                </li>
                <li>
                    <div class="text-tiny">Tất cả sản phẩm</div>
                </li>
            </ul>
        </div>
        <!-- product-list -->
        <div class="wg-box">
            <div class="title-box">
                <i class="icon-coffee"></i>
                <div class="body-text">Mẹo tìm kiếm theo mã sản phẩm: Mỗi sản phẩm đều có mã riêng, bạn có thể sử dụng để tìm chính xác sản phẩm cần thiết.</div>
            </div>
            <div class="flex items-center justify-between gap10 flex-wrap">
                <div class="wg-filter flex-grow">
                    <form class="form-search" method="GET" action="{{ route('admin.products.index') }}">
                        <fieldset class="name">
                            <input type="text" placeholder="Tìm kiếm..." name="name" tabindex="2"
                                value="{{ request('name') }}">
                        </fieldset>
                        <div class="button-submit">
                            <button type="submit"><i class="icon-search"></i></button>
                        </div>
                    </form>
                </div>
                <a class="tf-button style-1 w208" href="{{ route('admin.products.create') }}"><i class="icon-plus"></i>Thêm mới</a>
            </div>
            <div class="wg-table table-product-list">
                <ul class="table-title flex gap20 mb-14">
                    <li>
                        <div class="body-title">Tên sản phẩm</div>
                    </li>
                    <li>
                        <div class="body-title">Mô tả</div>
                    </li>
                    <li>
                        <div class="body-title">Giá</div>
                    </li>
                    <li>
                        <div class="body-title">Thương hiệu</div>
                    </li>
                    <li>
                        <div class="body-title">Danh mục</div>
                    </li>
                    <li>
                        <div class="body-title">Số lượng</div>
                    </li>
                    <li>
                        <div class="body-title">Tồn kho</div>
                    </li>
                    <li>
                        <div class="body-title">Trạng thái</div>
                    </li>
                    <li>
                        <div class="body-title">Thao tác</div>
                    </li>
                </ul>

                <ul class="flex flex-column">
                    @foreach ($products as $product)
                    <li class="wg-product item-row gap20">
                        <div class="name">
                            <div class="image">
                                <img src="{{ $product->images->first() ? asset($product->images->first()->image_url) : asset('images/no-image.png') }}" alt="">
                            </div>
                            <div class="title line-clamp-2 mb-0">
                                <a href="#" class="body-text">{{ $product->name }}</a>
                            </div>
                        </div>
                        <div class="body-text text-main-dark mt-4">
                            {{ Str::limit($product->short_description, 40) }}
                        </div>
                        <div class="body-text text-main-dark mt-4">
                            {{ number_format($product->regular_price, 0, ',', '.') }} đ
                        </div>
                        <div class="body-text text-main-dark mt-4">
                            {{ $product->brand->name ?? 'Không xác định' }}
                        </div>
                        <div class="body-text text-main-dark mt-4">
                            {{ $product->category->name ?? 'Không xác định' }}
                        </div>
                        <div class="body-text text-main-dark mt-4">
                            {{ $product->variants->sum('stock_quantity') }}
                        </div>
                        <div>
                            @if($product->variants->sum('stock_quantity') > 0)
                            <div class="block-available bg-1 fw-7">Còn hàng</div>
                            @else
                            <div class="block-stock bg-1 fw-7">Hết hàng</div>
                            @endif
                        </div>
                        <div>
                            <form method="POST" action="{{ route('admin.products.update', $product->id) }}" style="display:inline;">
                                @csrf
                                @method('PUT')
                                <select name="status" onchange="this.form.submit()" style="max-width:200px;">
                                    <option value="published" {{ $product->status == 'published' ? 'selected' : '' }}>Hiển thị</option>
                                    <option value="draft" {{ $product->status == 'draft' ? 'selected' : '' }}>Ngừng Kinh doanh</option>
                                    <option value="archived" {{ $product->status == 'archived' ? 'selected' : '' }}>Lưu trữ</option>
                                </select>
                            </form>
                        </div>
                        <div class="list-icon-function">
                            <div class="item eye">
                                <a href="{{ route('admin.products.show', $product->id) }}"><i class="icon-eye"></i></a>
                            </div>
                            <div class="item edit">
                                <a href="{{ route('admin.products.edit', $product->id) }}"><i class="icon-edit-3"></i></a>
                            </div>
                            <!-- <div class="item trash">
                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="background:transparent;border:none;padding:0;">
                                        <i class="icon-trash-2"></i>
                                    </button>
                                </form>
                            </div> -->
                        </div>
                    </li>
                    @endforeach
                </ul>

            </div>
            <div class="divider"></div>
            <div class="flex items-center justify-between flex-wrap gap10">
                <div class="text-tiny">
                    Hiển thị {{ $products->firstItem() }} đến {{ $products->lastItem() }} trên tổng số {{ $products->total() }} sản phẩm
                </div>
                <ul class="wg-pagination">
                    <li>
                        @if ($products->onFirstPage())
                        <span><i class="icon-chevron-left"></i></span>
                        @else
                        <a href="{{ $products->previousPageUrl() }}"><i class="icon-chevron-left"></i></a>
                        @endif
                    </li>
                    @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                    <li class="{{ $page == $products->currentPage() ? 'active' : '' }}">
                        @if ($page == $products->currentPage())
                        <span>{{ $page }}</span>
                        @else
                        <a href="{{ $url }}">{{ $page }}</a>
                        @endif
                    </li>
                    @endforeach
                    <li>
                        @if ($products->hasMorePages())
                        <a href="{{ $products->nextPageUrl() }}"><i class="icon-chevron-right"></i></a>
                        @else
                        <span><i class="icon-chevron-right"></i></span>
                        @endif
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection