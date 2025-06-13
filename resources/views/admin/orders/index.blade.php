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
                            <a href="{{ route('admin.dashboard') }}"><div class="text-tiny">Bảng điều khiển</div></a>
                        </li>
                        <li>
                            <i class="icon-chevron-right"></i>
                        </li>
                        <li>
                            <div class="text-tiny">Danh sách đơn hàng</div>
                        </li>
                    </ul>
                </div>
                <form class="form-search flex gap9 items-end" method="get" action="{{ route('admin.orders.index') }}" style="background:#f9fafb;padding:12px 18px;border-radius:10px;">
                    <fieldset class="mb-0">
                        <label class="body-title mb-2 block">Mã đơn/Khách</label>
                        <input type="text" placeholder="Nhập mã đơn hoặc tên khách..." name="q" value="{{ request('q') }}" class="input-field" style="min-width:150px;">
                    </fieldset>
                    <fieldset class="mb-0">
                        <label class="body-title mb-2 block">Sản phẩm</label>
                        <input type="text" placeholder="Tên sản phẩm..." name="product" value="{{ request('product') }}" class="input-field" style="min-width:120px;">
                    </fieldset>
                    <fieldset class="mb-0">
                        <label class="body-title mb-2 block">Trạng thái</label>
                        <select name="status" class="form-select" style="min-width:120px;">
                            <option value="">-- Tất cả --</option>
                            <option value="pending_confirmation" @if(request('status')=='pending_confirmation') selected @endif>Chờ xác nhận</option>
                            <option value="processing" @if(request('status')=='processing') selected @endif>Đang xử lý</option>
                            <option value="shipped" @if(request('status')=='shipped') selected @endif>Đang giao hàng</option>
                            <option value="delivered" @if(request('status')=='delivered') selected @endif>Đã giao</option>
                            <option value="cancelled" @if(request('status')=='cancelled') selected @endif>Đã hủy</option>
                            <option value="returned" @if(request('status')=='returned') selected @endif>Đã trả hàng</option>
                            <option value="pending_cancellation" @if(request('status')=='pending_cancellation') selected @endif>Chờ hủy</option>
                        </select>
                    </fieldset>
                    <button class="btn btn-primary flex items-center gap-2 mt-6 px-2 py-1" type="submit" style="font-size:12px; border-radius:6px;">
                        <i class="icon-search" style="font-size:14px;"></i>
                        <span>Tìm</span>
                    </button>
                   
                </form>
            </div>
            <!-- order-list -->
            <div class="wg-box">
                <div class="wg-table table-all-category mt-2">
                    <ul class="table-title flex gap10 mb-14" style="background:#f3f4f6;">
                        <li style="min-width:180px"><div class="body-title">Sản phẩm</div></li>
                        <li style="min-width:120px"><div class="body-title">Mã đơn</div></li>
                        <li style="min-width:100px"><div class="body-title">Giá trị</div></li>
                        <li style="min-width:80px"><div class="body-title">SL</div></li>
                        <li style="min-width:120px"><div class="body-title">Thanh toán</div></li>
                        <li style="min-width:120px"><div class="body-title">Trạng thái</div></li>
                        <li style="min-width:90px"><div class="body-title">Theo dõi</div></li>
                        <li style="min-width:110px"><div class="body-title">Hành động</div></li>
                    </ul>
                    <ul class="flex flex-column">
                        @forelse($orders as $order)
                        <li class="wg-product item-row gap10" style="align-items:center; border-bottom:1px solid #eee; padding:12px 0;">
                            <div class="name flex items-center gap10" style="min-width:180px">
                                <div class="image" style="width:40px;height:40px;">
                                    <img src="{{ optional(optional($order->items->first())->product)->image_url ?: asset('images/products/default.jpg') }}" alt="" style="width:100%;height:100%;object-fit:cover;">
                                </div>
                                <div class="title line-clamp-2 mb-0">
                                    <a href="{{ route('admin.orders.show', $order->id) }}" class="body-text fw-6">
                                        {{ optional(optional($order->items->first())->product)->name ?? 'Không có' }}
                                    </a>
                                </div>
                            </div>
                            <div class="body-text text-main-dark" style="min-width:120px">#{{ $order->order_code }}</div>
                            <div class="body-text text-main-dark" style="min-width:100px">{{ number_format($order->total_amount, 0, ',', '.') }}₫</div>
                            <div class="body-text text-main-dark" style="min-width:80px">{{ $order->items->sum('quantity') }}</div>
                            <div class="body-text text-main-dark" style="min-width:120px">
                                {{ optional($order->paymentMethod)->name ?? $order->payment_method ?? 'Không có' }}
                            </div>
                            <div style="min-width:120px">
                                @if($order->order_status === 'delivered')
                                    <span class="block-available bg-1 fw-7" style="padding:2px 8px;border-radius:6px;">Đã giao</span>
                                @elseif($order->order_status === 'pending' || $order->order_status === 'pending_confirmation')
                                    <span class="block-pending bg-1 fw-7" style="padding:2px 8px;border-radius:6px;">Chờ xử lý</span>
                                @elseif($order->order_status === 'pending_cancellation')
                                    <span class="block-pending fw-7" style="background:#ef4444;color:#fff;padding:2px 8px;border-radius:6px;">Chờ hủy</span>
                                @elseif($order->order_status === 'cancelled')
                                    <span class="block-pending bg-1 fw-7" style="background:#f87171;padding:2px 8px;border-radius:6px;">Đã hủy</span>
                                @elseif($order->order_status === 'processing')
                                    <span class="block-pending bg-1 fw-7" style="padding:2px 8px;border-radius:6px;">Đang xử lý</span>
                                @elseif($order->order_status === 'shipped')
                                    <span class="block-pending bg-1 fw-7" style="padding:2px 8px;border-radius:6px;">Đang giao hàng</span>
                                @elseif($order->order_status === 'returned')
                                    <span class="block-pending bg-1 fw-7" style="padding:2px 8px;border-radius:6px;">Đã trả hàng</span>
                                @else
                                    <span class="block-pending bg-1 fw-7" style="padding:2px 8px;border-radius:6px;">{{ ucfirst(str_replace('_',' ',$order->order_status)) }}</span>
                                @endif
                            </div>
                            <div style="min-width:90px">
                                <a href="{{ route('admin.orders.tracking', $order->id) }}" class="block-tracking bg-1" style="padding:2px 8px;border-radius:6px;">Theo dõi</a>
                            </div>
                            <div class="list-icon-function" style="min-width:110px">
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="item eye" title="Xem"><i class="icon-eye"></i></a>
                                <a href="{{ route('admin.orders.edit', $order->id) }}" class="item edit" title="Sửa"><i class="icon-edit-3"></i></a>
                                {{-- Không có nút xóa --}}
                            </div>
                        </li>
                        @empty
                        <li>
                            <div class="body-text text-center py-4">Không tìm thấy đơn hàng nào.</div>
                        </li>
                        @endforelse
                    </ul>
                </div>
                <div class="divider"></div>
                <div class="flex items-center justify-between flex-wrap gap10">
                    <div class="text-tiny">
                        Hiển thị {{ $orders->firstItem() ?? 0 }} đến {{ $orders->lastItem() ?? 0 }} của {{ $orders->total() }} đơn hàng
                    </div>
                    <ul class="wg-pagination">
                        {{ $orders->links() }}
                    </ul>
                </div>
            </div>
            <!-- /order-list -->
        </div>
    </div>
    <div class="bottom-page">
        <div class="body-text">Bản quyền © 2024 <a href="https://themesflat.co/html/ecomus/index.html">Ecomus</a>. Thiết kế bởi Themesflat. Đã đăng ký bản quyền.</div>
    </div>
@endsection
