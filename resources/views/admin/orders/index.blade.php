@extends('admin.layout.admin')
@section('title', 'Danh sách đơn hàng')
@section('content')
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-30">
                <div>
                    <h3>Danh sách đơn hàng</h3>
                    <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10 mt-2">
                        <li>
                            <a href="{{ route('admin.dashboard') }}">
                                <div class="text-tiny">Bảng điều khiển</div>
                            </a>
                        </li>
                        <li>
                            <i class="icon-chevron-right"></i>
                        </li>
                        <li>
                            <div class="text-tiny">Danh sách đơn hàng</div>
                        </li>
                    </ul>
                </div>
                <form class="form-search flex gap9 items-end" method="get" action="{{ route('admin.orders.index') }}"
                    style="background:#f9fafb;padding:12px 18px;border-radius:10px;">
                    <fieldset class="mb-0">
                        <label class="body-title mb-2 block">Mã đơn/Khách</label>
                        <input type="text" placeholder="Nhập mã đơn hoặc tên khách..." name="q"
                            value="{{ request('q') }}" class="input-field" style="min-width:150px;">
                    </fieldset>
                    <fieldset class="mb-0">
                        <label class="body-title mb-2 block">Sản phẩm</label>
                        <input type="text" placeholder="Tên sản phẩm..." name="product" value="{{ request('product') }}"
                            class="input-field" style="min-width:120px;">
                    </fieldset>
                    <fieldset class="mb-0">
                        <label class="body-title mb-2 block">Trạng thái</label>
                        <select name="status" class="form-select" style="min-width:120px;">
                            <option value="">-- Tất cả --</option>
                            <option value="pending_confirmation" @if (request('status') == 'pending_confirmation') selected @endif>Chờ xử lý
                            </option>
                            <option value="processing" @if (request('status') == 'processing') selected @endif>Đang xử lý</option>
                            <option value="shipped" @if (request('status') == 'shipped') selected @endif>Đang giao hàng
                            </option>
                            <option value="delivered" @if (request('status') == 'delivered') selected @endif>Đã giao</option>
                            <option value="cancelled" @if (request('status') == 'cancelled') selected @endif>Đã hủy</option>
                            <option value="returned" @if (request('status') == 'returned') selected @endif>Đã trả hàng</option>

                        </select>
                    </fieldset>
                    <button class="btn btn-primary flex items-center gap-2 mt-6 px-2 py-1" type="submit"
                        style="font-size:12px; border-radius:6px;">
                        <i class="icon-search" style="font-size:14px;"></i>
                        <span>Tìm</span>
                    </button>

                </form>
            </div>
            <!-- order-list -->
            <div class="wg-box">
                <div class="wg-table table-all-category mt-2">
                    <ul class="table-title flex gap10 mb-14" style="background:#f3f4f6; padding: 0 12px;">
                        <li style="width: 30px; text-align: center; flex-shrink: 0;">
                            <div class="body-title">STT</div>
                        </li>
                        <li>
                            <div class="body-title">Sản phẩm</div>
                        </li>
                        <li class="w-20">
                            <div class="body-title">Giá</div>
                        </li>
                        <li class="w-24">
                            <div class="body-title">Danh mục</div>
                        </li>
                        <li class="w-20">
                            <div class="body-title">Thương hiệu</div>
                        </li>
                        <li class="w-14">
                            <div class="body-title">Tồn kho</div>
                        </li>
                        <li class="w-20">
                            <div class="body-title">Trạng thái</div>
                        </li>
                        <li class="w-16">
                            <div class="body-title">Thao tác</div>
                        </li>
                    </ul>

                    <ul class="flex flex-column">
                        @foreach ($products as $product)
                            <li class="wg-product item-row gap10">
                                {{-- Số thứ tự --}}
                                <div class="body-text text-main-dark"
                                    style="width: 30px; text-align: center; flex-shrink: 0;">
                                    {{ $products->firstItem() + $loop->index }}
                                </div>

                                {{-- Ảnh + Tên --}}
                                <div class="name flex-1 flex items-center gap10">
                                    <div class="image w-12 h-12">
                                        <img class="object-cover rounded"
                                            src="{{ $product->images->first()->image_url ?? asset('images/no-image.png') }}"
                                            alt="">
                                    </div>
                                    <div class="title line-clamp-2 mb-0">
                                        <a href="{{ route('admin.products.show', $product->id) }}" class="body-text">
                                            {{ $product->name }}
                                        </a>
                                    </div>
                                </div>

                                {{-- Giá --}}
                                <div class="body-text text-main-dark mt-4 w-20">
                                    {{ number_format($product->regular_price, 0, ',', '.') }} đ
                                </div>

                                {{-- Danh mục --}}
                                <div class="body-text text-main-dark mt-4 w-24">
                                    {{ $product->category->name ?? '-' }}
                                </div>

                                {{-- Thương hiệu --}}
                                <div class="body-text text-main-dark mt-4 w-20">
                                    {{ $product->brand->name ?? '-' }}
                                </div>

                                {{-- Tồn kho --}}
                                <div class="body-text text-main-dark mt-4 w-14">
                                    {{ $product->variants->sum('stock_quantity') }}
                                </div>

                                {{-- Trạng thái hiển thị --}}
                                <div class="body-text mt-4 w-20">
                                    <form method="POST" action="{{ route('admin.products.update', $product->id) }}"
                                        style="display:inline;">
                                        @csrf @method('PUT')
                                        <select name="status" onchange="this.form.submit()" class="max-w-[120px]">
                                            <option value="published" {{ $product->status == 'published' ? 'selected' : '' }}>
                                                Hiển thị</option>
                                            <option value="draft" {{ $product->status == 'draft' ? 'selected' : '' }}>Ngừng KD
                                            </option>
                                            <option value="archived" {{ $product->status == 'archived' ? 'selected' : '' }}>Lưu
                                                trữ</option>
                                        </select>
                                    </form>
                                </div>

                                {{-- Thao tác --}}
                                <div class="list-icon-function mt-4 w-16 flex justify-center gap6">
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
                        Hiển thị {{ $orders->firstItem() ?? 0 }} đến {{ $orders->lastItem() ?? 0 }} của
                        {{ $orders->total() }} đơn hàng
                    </div>
                    <ul class="wg-pagination">
                        <li>
                            @if ($orders->onFirstPage())
                                <span><i class="icon-chevron-left"></i></span>
                            @else
                                <a href="{{ $orders->previousPageUrl() }}"><i class="icon-chevron-left"></i></a>
                            @endif
                        </li>
                        @foreach ($orders->getUrlRange(1, $orders->lastPage()) as $page => $url)
                            <li class="{{ $page == $orders->currentPage() ? 'active' : '' }}">
                                <a href="{{ $page == $orders->currentPage() ? 'javascript:void(0);' : $url }}">{{ $page }}</a>
                            </li>
                        @endforeach
                        <li>
                            @if ($orders->hasMorePages())
                                <a href="{{ $orders->nextPageUrl() }}"><i class="icon-chevron-right"></i></a>
                            @else
                                <span><i class="icon-chevron-right"></i></span>
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
            <!-- /order-list -->
        </div>
    </div>

    <!-- /order-list -->
    </div>
    </div>

@endsection
