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
                {{-- Nút bật bộ lọc --}}
                <div class="mb-3">
                    <button type="button" onclick="toggleOrderFilter()"
                        class="btn btn-outline-primary flex items-center gap-1 px-3 py-1 rounded-md" style="color: #f59e0b; border: 1px solid #f59e0b; hover: border-color: #f59e0b; background-color: #fff;">>
                        <i class="icon-filter"></i>
                        <span>Lọc đơn hàng</span>
                    </button>
                </div>

                {{-- FORM LỌC - Ẩn mặc định --}}
                <div id="order-filter-form" class="form-search bg-gray-50 p-4 rounded-lg mb-4 hidden">
                    <form method="get" action="{{ route('admin.orders.index') }}" class="flex flex-wrap gap-4 items-end">
                        {{-- Tìm kiếm --}}
                        <div class="flex flex-col">
                            <label class="body-title mb-1"  >Tìm kiếm</label>
                            <input type="text" name="q" value="{{ request('q') }}"
                                placeholder="Mã đơn, tên khách, SĐT..." class="input-field"
                                style="min-width:220px; height:36px;">
                        </div>

                        {{-- Trạng thái --}}
                        <div class="flex flex-col">
                            <label class="body-title mb-1">Trạng thái</label>
                            <select name="status" class="form-select" style="min-width:160px; height:36px;">
                                <option value="">-- Tất cả --</option>
                                <option value="pending_confirmation" @selected(request('status') == 'pending_confirmation')>Chờ xử lý</option>
                                <option value="processing" @selected(request('status') == 'processing')>Đang xử lý</option>
                                <option value="shipped" @selected(request('status') == 'shipped')>Đang giao hàng</option>
                                <option value="delivered" @selected(request('status') == 'delivered')>Đã giao</option>
                                <option value="cancelled" @selected(request('status') == 'cancelled')>Đã hủy</option>
                                <option value="returned" @selected(request('status') == 'returned')>Đã trả hàng</option>
                            </select>
                        </div>

                        {{-- Phương thức thanh toán --}}
                        <div class="flex flex-col">
                            <label class="body-title mb-1">Phương thức thanh toán</label>
                            <select name="payment_method_id" class="form-select" style="min-width:160px; height:36px;">
                                <option value="">-- Tất cả --</option>
                                <option value="1" @selected(request('payment_method_id') == '1')>COD</option>
                                <option value="2" @selected(request('payment_method_id') == '2')>Chuyển khoản</option>
                                <option value="3" @selected(request('payment_method_id') == '3')>Momo</option>
                            </select>
                        </div>

                        {{-- Phương thức vận chuyển --}}
                        <div class="flex flex-col">
                            <label class="body-title mb-1">Vận chuyển</label>
                            <select name="shipping_method_id" class="form-select" style="min-width:160px; height:36px;">
                                <option value="">-- Tất cả --</option>
                                <option value="1" @selected(request('shipping_method_id') == '1')>Giao hàng tiêu chuẩn</option>
                                <option value="2" @selected(request('shipping_method_id') == '2')>Giao hàng nhanh</option>
                                <option value="3" @selected(request('shipping_method_id') == '3')>Nhận tại cửa hàng</option>
                            </select>
                        </div>
                        {{-- Nút tìm kiếm --}}
                        <div class="flex items-end">
                            <button class="btn btn-primary flex items-center gap-1 px-3 py-1 rounded-md" style="color: #fff; border: 1px solid #f59e0b; background-color: #f59e0b ;" type="submit"
                                style="height:36px;">
                                <i class="icon-search text-sm" ></i>
                                <span>Tìm</span>
                            </button>
                        </div>
                    </form>
                </div>

                {{-- SCRIPT --}}
                <script>
                    function toggleOrderFilter() {
                        const filter = document.getElementById('order-filter-form');
                        filter.classList.toggle('hidden');
                    }
                </script>



            </div>
            <div class="wg-box">
                <div class="wg-table table-all-category mt-2">
                    <ul class="table-title flex mb-14" style="background:#f3f4f6; padding: 0 12px;">
                        <li style="width: 30px; text-align: center; flex-shrink: 0;">
                            <div class="body-title">STT</div>
                        </li>

                        <li style="min-width: 120px; padding-left: 10px;">
                            <div class="body-title">Mã đơn</div>
                        </li>

                        <li style="min-width: 100px; padding-left: 10px;">
                            <div class="body-title">Giá trị</div>
                        </li>

                        <li style="min-width: 180px; padding-left: 10px;">
                            <div class="body-title">Khách hàng</div>
                        </li>

                        <li style="min-width: 120px; padding-left: 10px;">
                            <div class="body-title">Ngày đặt</div>
                        </li>

                        <li style="min-width: 100px; padding-left: 10px;">
                            <div class="body-title">Hình thức</div>
                        </li>

                        <li style="min-width: 120px; padding-left: 10px;">
                            <div class="body-title">Vận chuyển</div>
                        </li>

                        <li style="min-width: 120px; padding-left: 10px;">
                            <div class="body-title">Trạng thái</div>
                        </li>

                        <li style="min-width: 50px; padding-left: 10px;">
                            <div class="body-title"></div>
                        </li>
                    </ul>
                    <ul class="flex flex-column">
                        @forelse($orders as $order)
                            <li class="wg-product item-row "
                                style="display: flex; align-items:center; border-bottom:1px solid #eee; padding: 12px;">
                                <div class="body-text text-main-dark"
                                    style="width: 30px; text-align: center; flex-shrink: 0;">
                                    {{ $orders->firstItem() + $loop->index }}
                                </div>
                                <div class="body-text text-main-dark" style="min-width:120px; padding-left: 10px;">
                                    {{ $order->order_code }}
                                </div>
                                <div class="body-text text-main-dark" style="min-width: 100px; padding-left: 10px;">
                                    {{ number_format($order->total_amount, 0, ',', '.') }}₫
                                </div>
                                <div class="body-text text-main-dark" style="min-width: 180px; padding-left: 10px;">
                                    <div>{{ $order->buyer_name ?? $order->shipping_name }}</div>
                                    <div class="text-xs" style="color: #2563eb; font-weight: 500;">
                                        {{ $order->buyer_phone ?? $order->shipping_phone }}
                                    </div>
                                    @if ($order->buyer_name && $order->shipping_name && $order->buyer_name != $order->shipping_name)
                                        <div class="text-xs text-gray-500 mt-1">
                                            Ship to: {{ $order->shipping_name }}
                                            (<span
                                                style="color: #2563eb; font-weight: 500;">{{ $order->shipping_phone }}</span>)
                                        </div>
                                    @endif
                                </div>
                                <div class="body-text text-main-dark" style="min-width: 120px; padding-left: 10px;">
                                    {{ optional($order->created_at)->format('d/m/Y H:i') }}
                                </div>
                                <div class="body-text text-main-dark" style="min-width: 100px; padding-left: 10px;">
                                    {{ optional($order->paymentMethod)->name ?? 'Không có' }}
                                </div>
                                <div class="body-text text-main-dark" style="min-width: 120px; padding-left: 10px;">
                                    {{ optional($order->shippingMethod)->name ?? 'Không có' }}
                                </div>
                                <div style="min-width:120px; padding-left: 10px;">
                                    @if ($order->order_status === 'delivered')
                                        <span class="block-available bg-1 fw-7"
                                            style="padding:2px 8px;border-radius:6px;">Đã giao</span>
                                    @elseif($order->order_status === 'pending' || $order->order_status === 'pending_confirmation')
                                        <span class="block-pending bg-1 fw-7"
                                            style="padding:2px 8px;border-radius:6px;">Chờ
                                            xử lý</span>
                                    @elseif($order->order_status === 'pending_cancellation')
                                        <span class="block-pending fw-7"
                                            style="background:#ef4444;color:#fff;padding:2px 8px;border-radius:6px;">Chờ
                                            hủy</span>
                                    @elseif($order->order_status === 'cancelled')
                                        <span class="block-pending bg-1 fw-7"
                                            style="background:#f87171;padding:2px 8px;border-radius:6px;">Đã hủy</span>
                                    @elseif($order->order_status === 'processing')
                                        <span class="block-pending bg-1 fw-7"
                                            style="padding:2px 8px;border-radius:6px;">Đang xử lý</span>
                                    @elseif($order->order_status === 'shipped')
                                        <span class="block-pending bg-1 fw-7"
                                            style="padding:2px 8px;border-radius:6px;">Đang giao hàng</span>
                                    @elseif($order->order_status === 'returned')
                                        <span class="block-pending bg-1 fw-7"
                                            style="padding:2px 8px;border-radius:6px;">Đã
                                            trả hàng</span>
                                    @else
                                        <span class="block-pending bg-1 fw-7" style="padding:2px 8px;border-radius:6px;">
                                            {{ ucfirst(str_replace('_', ' ', $order->order_status)) }}
                                        </span>
                                    @endif
                                </div>
                                <div class="list-icon-function" style="padding-left: 10px;">
                                    <a href="{{ route('admin.orders.show', $order->id) }}" class="item eye"
                                        title="View"><i class="icon-eye"></i></a>
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
                                <a
                                    href="{{ $page == $orders->currentPage() ? 'javascript:void(0);' : $url }}">{{ $page }}</a>
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
        </div>
</div> @endsection
