@extends('admin.layout.admin')

@section('title', 'Danh sách sản phẩm')

@section('content')
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-30">
                <h3>Danh sách sản phẩm</h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li><a href="index.html">
                            <div class="text-tiny">Trang chủ</div>
                        </a></li>
                    <li><i class="icon-chevron-right"></i></li>
                    <li><a href="#">
                            <div class="text-tiny">Sản phẩm</div>
                        </a></li>
                    <li><i class="icon-chevron-right"></i></li>
                    <li>
                        <div class="text-tiny">Tất cả sản phẩm</div>
                    </li>
                </ul>
            </div>

            <div class="wg-box">
                <div class="title-box">
                    <i class="icon-coffee"></i>
                    <div class="body-text">Mẹo tìm kiếm theo mã sản phẩm: Mỗi sản phẩm đều có mã riêng, bạn có thể sử dụng
                        để tìm chính xác sản phẩm cần thiết.</div>
                </div>

                <div class="flex items-center justify-between gap10 flex-wrap">
                    <div class="wg-filter flex-grow">
                        <form class="form-search flex gap10" method="GET">
                            <fieldset class="name">
                                <input type="text" placeholder="Tìm kiếm sản phẩm..." name="name"
                                    value="{{ request('name') }}">
                            </fieldset>
                            <fieldset>
                                <select name="category_id">
                                    <option value="">Danh Mục</option>
                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat->id }}"
                                            {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                                            {{ $cat->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </fieldset>
                            <fieldset>
                                <select name="brand_id">
                                    <option value="">Thương Hiệu</option>
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}"
                                            {{ request('brand_id') == $brand->id ? 'selected' : '' }}>
                                            {{ $brand->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </fieldset>
                            <fieldset>
                                <select name="status">
                                    <option value="">Trạng Thái</option>
                                    <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Hiển
                                        thị</option>
                                    <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Ngừng KD
                                    </option>
                                    <option value="archived" {{ request('status') == 'archived' ? 'selected' : '' }}>Lưu trữ
                                    </option>
                                </select>
                            </fieldset>
                            <div class="button-submit">
                                <button type="submit"><i class="icon-search"></i></button>
                            </div>
                        </form>
                    </div>
                    <a class="tf-button style-1 w208" href="{{ route('admin.products.create') }}"><i
                            class="icon-plus"></i>Thêm mới</a>
                </div>

                <div class="wg-table table-product-list">
                    <ul class="table-title flex gap2 mb-10">
                        <li style="width: 30px; text-align: center; flex-shrink: 0;">
                            <div class="body-title">STT</div>
                        </li>
                        <li>
                            <div class="body-title">Sản phẩm</div>
                        </li>
                        <li class="w-14">
                            <div class="body-title">Giá</div>
                        </li>
                        <li class="w-14">
                            <div class="body-title">Danh mục</div>
                        </li>
                        <li class="w-14">
                            <div class="body-title">Thương hiệu</div>
                        </li>
                        <li class="w-10">
                            <div class="body-title">Tồn kho</div>
                        </li>
                        <li class="w-12">
                            <div class="body-title">Trạng thái</div>
                        </li>
                        <li class="w-8">
                            <div class="body-title">Thao tác</div>
                        </li>
                    </ul>

                    <ul class="flex flex-column">
                        @foreach ($products as $product)
                            <li class="wg-product item-row gap2">
                                {{-- Số thứ tự --}}
                                <div class="body-text text-main-dark"
                                    style="width: 30px; text-align: center; flex-shrink: 0;">
                                    {{ $products->firstItem() + $loop->index }}
                                </div>

                                {{-- Ảnh + Tên --}}
                                <div class="name flex-1 flex items-center gap2">
                                    <div class="image w-8 h-8">
                                        <img class="object-cover rounded"
                                            src="{{ $product->images->first() ? asset($product->images->first()->image_url) : asset('images/no-image.png') }}"
                                            alt="">
                                    </div>
                                    <div class="title line-clamp-2 mb-0">
                                        <a href="{{ route('admin.products.show', $product->id) }}" class="body-text">
                                            {{ $product->name }}
                                        </a>
                                    </div>
                                </div>

                                {{-- Giá --}}
                                <div class="body-text text-main-dark mt-4 w-14">
                                    {{ number_format($product->regular_price, 0, ',', '.') }} đ
                                </div>

                                {{-- Danh mục --}}
                                <div class="body-text text-main-dark mt-4 w-14">
                                    {{ $product->category ? $product->category->name : 'Không có danh mục' }}
                                </div>

                                {{-- Thương hiệu --}}
                                <div class="body-text text-main-dark mt-4 w-14">
                                    {{ $product->brand ? $product->brand->name : 'Không có thương hiệu' }}
                                </div>

                                {{-- Tồn kho --}}
                                <div class="body-text text-main-dark mt-4 w-10">
                                    {{ $product->variants->sum('stock_quantity') }}
                                </div>

                                {{-- Trạng thái hiển thị --}}
                                <div class="body-text mt-4 w-12" style="padding-right:0;">
                                    {{-- Form để thay đổi trạng thái --}}
                                    <form method="POST" action="{{ route('admin.products.update', $product->id) }}"
                                        style="display:inline;">
                                        @csrf @method('PUT')
                                        <select name="status" onchange="this.form.submit()" class="max-w-[80px]"
                                            style="padding-right:0;">
                                            <option value="published"
                                                {{ $product->status == 'published' ? 'selected' : '' }}>
                                                Hiển thị</option>
                                            <option value="draft" {{ $product->status == 'draft' ? 'selected' : '' }}>
                                                Ngừng KD
                                            </option>
                                            <option value="archived"
                                                {{ $product->status == 'archived' ? 'selected' : '' }}>Lưu
                                                trữ</option>
                                        </select>
                                    </form>
                                </div>

                                {{-- Thao tác --}}
                                <div class="list-icon-function mt-4 w-8 flex justify-center gap1" style="padding-left:0;">
                                    <a href="{{ route('admin.products.show', $product->id) }}" class="item eye"><i
                                            class="icon-eye"></i></a>
                                    <a href="{{ route('admin.products.edit', $product->id) }}" class="item edit"><i
                                            class="icon-edit-3"></i></a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="divider"></div>

                <div class="flex items-center justify-between flex-wrap gap10">
                    <div class="text-tiny">
                        Hiển thị {{ $products->firstItem() }} đến {{ $products->lastItem() }} trên tổng số
                        {{ $products->total() }} sản phẩm
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
