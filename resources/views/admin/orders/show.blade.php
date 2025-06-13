@extends('admin.layout.admin')
@section('title', 'Đơn hàng ' . $order->order_code)
@section('content')
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-30">
                <h3>Đơn hàng #{{ $order->order_code }}</h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li>
                        <a href="{{ route('admin.dashboard') }}">
                            <div class="text-tiny">Bảng điều khiển</div>
                        </a>
                    </li>
                    <li><i class="icon-chevron-right"></i></li>
                    <li>
                        <a href="{{ route('admin.orders.index') }}">
                            <div class="text-tiny">Đơn hàng</div>
                        </a>
                    </li>
                    <li><i class="icon-chevron-right"></i></li>
                    <li><div class="text-tiny">Chi tiết đơn hàng</div></li>
                    <li><i class="icon-chevron-right"></i></li>
                    <li><div class="text-tiny">#{{ $order->order_code }}</div></li>
                </ul>
            </div>

            <!-- Chi tiết đơn hàng -->
            <div class="wg-order-detail">
                <div class="left flex-grow">
                    <div class="wg-box mb-20">
                        <div class="wg-table table-order-detail">
                            <ul class="table-title flex items-center justify-between gap20 mb-24">
                                <li>
                                    <div class="body-title">Tất cả sản phẩm</div>
                                </li>
                            </ul>
                            <ul class="flex flex-column">
                                @foreach ($order->items as $item)
                                    <li class="wg-product">
                                        <div class="name">
                                            <div class="image">
                                                <img src="{{ optional($item->product)->image_url ?: asset('images/products/default.jpg') }}" alt="">
                                            </div>
                                            <div>
                                                <div class="text-tiny">Tên sản phẩm</div>
                                                <div class="title">
                                                    <a href="#" class="body-title-2">{{ $item->product->name ?? 'Không xác định' }}</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="text-tiny">Số lượng</div>
                                            <div class="title">
                                                <div class="body-title-2">{{ $item->quantity }}</div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="wg-box">
                        <div class="wg-table table-cart-totals">
                            <ul class="table-title flex mb-24">
                                <li><div class="body-title">Tổng giỏ hàng</div></li>
                                <li><div class="body-title">Giá</div></li>
                            </ul>
                            <ul class="flex flex-column gap14">
                                <li class="cart-totals-item">
                                    <span class="body-text">Tạm tính:</span>
                                    <span class="body-title-2">{{ number_format($order->subtotal_amount, 0, ',', '.') }}₫</span>
                                </li>
                                <li class="divider"></li>
                                <li class="cart-totals-item">
                                    <span class="body-text">Phí vận chuyển:</span>
                                    <span class="body-title-2">{{ number_format($order->shipping_fee, 0, ',', '.') }}₫</span>
                                </li>
                                @if ($order->discount_amount)
                                    <li class="divider"></li>
                                    <li class="cart-totals-item">
                                        <span class="body-text">Giảm giá:</span>
                                        <span class="body-title-2">- {{ number_format($order->discount_amount, 0, ',', '.') }}₫</span>
                                    </li>
                                @endif
                                <li class="divider"></li>
                                <li class="cart-totals-item">
                                    <span class="body-text">Thuế (VAT):</span>
                                    <span class="body-title-2">{{ number_format($order->tax_amount, 0, ',', '.') }}₫</span>
                                </li>
                                <li class="divider"></li>
                                <li class="cart-totals-item">
                                    <span class="body-title">Tổng cộng:</span>
                                    <span class="body-title tf-color-1">{{ number_format($order->total_amount, 0, ',', '.') }}₫</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="right">
                    <div class="wg-box mb-20 gap10">
                        <div class="body-title">Tóm tắt</div>
                        <div class="summary-item">
                            <div class="body-text">Mã đơn</div>
                            <div class="body-title-2">#{{ $order->order_code }}</div>
                        </div>
                        <div class="summary-item">
                            <div class="body-text">Trạng thái</div>
                            <div class="body-title-2">
                                @if ($order->order_status === 'delivered')
                                    <span class="block-available bg-1 fw-7">Đã giao</span>
                                @elseif($order->order_status === 'pending' || $order->order_status === 'pending_confirmation')
                                    <span class="block-pending bg-1 fw-7">Chờ xử lý</span>
                                @elseif($order->order_status === 'cancelled')
                                    <span class="block-pending bg-1 fw-7" style="background:#f87171">Đã hủy</span>
                                @else
                                    <span class="block-pending bg-1 fw-7">{{ ucfirst(str_replace('_', ' ', $order->order_status)) }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="summary-item">
                            <div class="body-text">Ngày đặt</div>
                            <div class="body-title-2">{{ $order->ordered_at ? $order->ordered_at->format('d/m/Y H:i') : '-' }}</div>
                        </div>
                        <div class="summary-item">
                            <div class="body-text">Tổng cộng</div>
                            <div class="body-title-2 tf-color-1">{{ number_format($order->total_amount, 0, ',', '.') }}₫</div>
                        </div>
                        @if ($order->customer_note)
                            <div class="summary-item">
                                <div class="body-text">Ghi chú khách hàng</div>
                                <div class="body-title-2">{{ $order->customer_note }}</div>
                            </div>
                        @endif
                        @if ($order->admin_note)
                            <div class="summary-item">
                                <div class="body-text">Ghi chú quản trị</div>
                                <div class="body-title-2">{{ $order->admin_note }}</div>
                            </div>
                        @endif
                    </div>

                    <div class="wg-box mb-20 gap10">
                        <div class="body-title">Địa chỉ giao hàng</div>
                        <div class="body-text">{{ $order->shipping_address }}</div>
                    </div>

                    <div class="wg-box mb-20 gap10">
                        <div class="body-title">Thông tin người đặt hàng</div>
                        <div class="body-text">
                            <b>Họ tên:</b> {{ $order->buyer_name ?? '-' }}<br>
                            <b>Email:</b> {{ $order->buyer_email ?? '-' }}<br>
                            <b>SĐT:</b> {{ $order->buyer_phone ?? '-' }}<br>
                            <b>Địa chỉ:</b> {{ $order->buyer_address ?? '-' }}
                        </div>
                    </div>

                    <div class="wg-box mb-20 gap10">
                        <div class="body-title">Phương thức thanh toán</div>
                        <div class="body-text">{{ $order->paymentMethod->name ?? ($order->payment_method ?? 'Không rõ') }}</div>
                    </div>

                    <div class="wg-box mb-20 gap10">
                        <div class="body-title">Phương thức vận chuyển</div>
                        <div class="body-text">{{ $order->shippingMethod->name ?? ($order->shipping_method ?? 'Không rõ') }}</div>
                    </div>

                    <div class="wg-box gap10">
                        <div class="body-title">Ngày giao dự kiến</div>
                        <div class="body-title-2 tf-color-2">{{ $order->delivered_at ? $order->delivered_at->format('d/m/Y') : '-' }}</div>
                        <a class="tf-button style-1 w-full" href="{{ route('admin.orders.tracking', $order->id) }}"><i class="icon-truck"></i> Theo dõi đơn hàng</a>
                        <a class="tf-button w-full" target="_blank" href="{{ route('admin.orders.printInvoice', $order->id) }}"><i class="icon-file-text"></i> In hóa đơn</a>
                        <a class="tf-button w-full" target="_blank" href="{{ route('admin.orders.printShipping', $order->id) }}"><i class="icon-file-text"></i> In phiếu giao hàng</a>
                        @if($order->order_status === 'pending_cancellation')
                        <button type="button" class="tf-button w-full style-2 mt-2" data-bs-toggle="modal" data-bs-target="#modalCancelOrder">
                            Xác nhận hủy đơn
                        </button>
                        @endif
                    </div>
                </div>
            </div>
            <!-- /Chi tiết đơn hàng -->
        </div>
    </div>
    <!-- Modal xác nhận hủy đơn -->
    @if($order->order_status === 'pending_cancellation')
    <div class="modal fade" id="modalCancelOrder" tabindex="-1" aria-labelledby="modalCancelOrderLabel" aria-hidden="true">
      <div class="modal-dialog">
        <form method="POST" action="{{ route('admin.orders.processCancel', $order->id) }}">
            @csrf
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="modalCancelOrderLabel">Xác nhận hủy đơn hàng #{{ $order->order_code }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
              </div>
              <div class="modal-body">
                <div class="mb-3">
                    <label for="cancellation_reason" class="form-label">Lý do hủy đơn (bắt buộc):</label>
                    <textarea name="cancellation_reason" id="cancellation_reason" class="form-control" required rows="2">{{ old('cancellation_reason', $order->cancellation_reason) }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="admin_note_cancel" class="form-label">Ghi chú của quản trị viên (không bắt buộc):</label>
                    <textarea name="admin_note_cancel" id="admin_note_cancel" class="form-control" rows="2">{{ old('admin_note_cancel') }}</textarea>
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" name="action" value="approve" class="btn btn-danger">Duyệt hủy & trả tồn kho</button>
                <button type="submit" name="action" value="reject" class="btn btn-secondary">Từ chối hủy</button>
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Đóng</button>
              </div>
            </div>
        </form>
      </div>
    </div>
    @endif
    <div class="bottom-page">
        <div class="body-text">Bản quyền © 2024 <a href="https://themesflat.co/html/ecomus/index.html">Ecomus</a>. Thiết kế bởi Themesflat. Đã đăng ký bản quyền.</div>
    </div>
@endsection
@push('scripts')
<script>
    // Nếu dùng Bootstrap 5, modal sẽ tự hoạt động
</script>
@endpush
