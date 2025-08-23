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
                    <li>
                        <div class="text-tiny">Chi tiết đơn hàng</div>
                    </li>
                    <li><i class="icon-chevron-right"></i></li>
                    <li>
                        <div class="text-tiny">#{{ $order->order_code }}</div>
                    </li>
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
                                    <li class="wg-product"
                                        style="display: flex; align-items: center; justify-content: space-between; gap: 24px;">
                                        <div class="name" style="flex:2; min-width:200px;">
                                            <div class="image">
                                                @php
                                                    $imageUrl = optional(optional($item->product)->images->first())
                                                        ->image_url;
                                                @endphp
                                                <img src="{{ $imageUrl ? asset($imageUrl) : asset('images/products/default.jpg') }}"
                                                    alt="">
                                            </div>
                                            <div>
                                                <div class="text-tiny">Tên sản phẩm</div>
                                                <div class="title" style="display:flex; align-items:center; gap:10px;">
                                                    <a href="#"
                                                        class="body-title-2">{{ $item->product->name ?? 'Không xác định' }}</a>
                                                    <span class="body-text tf-color-1">
                                                        ({{ number_format($item->price ?? (optional($item->product)->regular_price ?? 0), 0, ',', '.') }}₫)
                                                    </span>
                                                </div>
                                                {{-- Hiển thị biến thể nếu có --}}
                                                @php
                                                    $variantAttrs = $item->variant_attributes;
                                                    if (is_string($variantAttrs)) {
                                                        $variantAttrs = json_decode($variantAttrs, true);
                                                    }
                                                @endphp
                                                @if (!empty($variantAttrs) && is_array($variantAttrs))
                                                    <div class="text-tiny" style="color:#888;">
                                                        @foreach ($variantAttrs as $attr => $val)
                                                            <span>{{ $attr }}: {{ $val }}</span>
                                                            @if (!$loop->last)
                                                                ,
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                @elseif($item->product_variant_id && $item->productVariant && isset($item->productVariant->attributeValues))
                                                    <div class="text-tiny" style="color:#888;">
                                                        @foreach ($item->productVariant->attributeValues as $attrValue)
                                                            <span>
                                                                {{ $attrValue->attribute->name ?? '' }}:
                                                                {{ $attrValue->value ?? '' }}
                                                            </span>
                                                            @if (!$loop->last)
                                                                ,
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div style="flex:1; min-width:100px;">
                                            <div class="text-tiny">Số lượng</div>
                                            <div class="body-title-2">{{ $item->quantity }}</div>
                                        </div>
                                        <div style="flex:1; min-width:120px; text-align:left; padding-left:13px;">
                                            <div class="text-tiny">Thành tiền</div>
                                            <div class="body-title-2 tf-color-1">
                                                {{ number_format(($item->price ?? (optional($item->product)->regular_price ?? 0)) * $item->quantity, 0, ',', '.') }}₫
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="wg-box mb-20 gap10">
                        <div class="wg-table table-cart-totals">
                            <ul class="table-title flex mb-24">
                                <li>
                                    <div class="body-title">Thông tin đơn hàng</div>
                                </li>
                                <li>
                                    <div class="body-title">Giá</div>
                                </li>
                            </ul>

                            @php
                                $productTotal = 0;
                                foreach ($order->items as $item) {
                                    $price = $item->price ?? (optional($item->product)->regular_price ?? 0);
                                    $productTotal += $price * $item->quantity;
                                }
                            @endphp

                            <ul class="flex flex-column gap14">
                                <li class="divider"></li>
                                <li class="cart-totals-item">
                                    <span class="body-text">Tổng tiền sản phẩm:</span>
                                    <span
                                        class="body-title-2 tf-color-1">{{ number_format($productTotal, 0, ',', '.') }}₫</span>
                                </li>
                                <li class="divider"></li>
                                <li class="cart-totals-item">
                                    <span class="body-text">Phí vận chuyển:</span>
                                    <span
                                        class="body-title-2">{{ number_format($order->shipping_fee, 0, ',', '.') }}₫</span>
                                </li>
                                @if ($order->discount_code)
                                    <li class="divider"></li>
                                    <li class="cart-totals-item">
                                        <span class="body-text">Mã giảm giá:</span>
                                        <span class="body-title-2">{{ $order->discount_code }}</span>
                                    </li>
                                @endif
                                @if ($order->discount_amount)
                                    <li class="divider"></li>
                                    <li class="cart-totals-item">
                                        <span class="body-text">Giảm giá:</span>
                                        <span class="body-title-2">-
                                            {{ number_format($order->discount_amount, 0, ',', '.') }}₫</span>
                                    </li>
                                @endif
                                <li class="divider"></li>
                                <li class="cart-totals-item">
                                    <span class="body-title">Tổng cộng:</span>
                                    <span
                                        class="body-title tf-color-1">{{ number_format($order->total_amount, 0, ',', '.') }}₫</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="wg-box mb-20 gap10">
                        <div class="body-title">Phương thức thanh toán</div>
                        <div class="body-text">{{ $order->paymentMethod->name ?? ($order->payment_method ?? 'Không rõ') }}
                        </div>
                    </div>

                    <div class="wg-box mb-20 gap10">
                        <div class="body-title">Phương thức vận chuyển</div>
                        <div class="body-text">
                            {{ $order->shippingMethod->name ?? ($order->shipping_method ?? 'Không rõ') }}</div>
                    </div>

                    <div class="wg-box gap10">
                        <a class="tf-button style-1 w-full" href="{{ route('admin.orders.tracking', $order->id) }}"><i
                                class="icon-truck"></i> Theo dõi đơn hàng</a>
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
                                @elseif($order->order_status === 'pending_confirmation' || $order->order_status === 'pending')
                                    <span class="block-pending bg-1 fw-7">Chờ xác nhận</span>
                                @elseif($order->order_status === 'processing')
                                    <span class="block-pending bg-1 fw-7">Đang xử lý</span>
                                @elseif($order->order_status === 'shipped')
                                    <span class="block-pending bg-1 fw-7">Đang giao</span>
                                @elseif($order->order_status === 'cancelled')
                                    @php
                                        $successRefund = $order->refunds()->where('status', 'success')->first();
                                    @endphp
                                    @if($order->pending_refund)
                                        <span class="block-pending bg-1 fw-7" style="background:#f59e0b">Đã hủy - Chờ hoàn tiền</span>
                                    @elseif($successRefund)
                                        <span class="block-pending bg-1 fw-7" style="background:#8fffda">Đã hủy - Đã hoàn tiền</span>
                                    @else
                                        <span class="block-pending bg-1 fw-7" style="background:#f87171">Đã hủy</span>
                                    @endif
                                @elseif($order->order_status === 'returned')
                                    <span class="block-pending bg-1 fw-7">Đã trả hàng</span>
                                @else
                                    <span
                                        class="block-pending bg-1 fw-7">{{ ucfirst(str_replace('_', ' ', $order->order_status)) }}</span>
                                @endif
                            </div>
                        </div>
                        @if (in_array($order->order_status, ['cancelled', 'pending_cancellation']) && $order->cancellation_reason)
                            <div class="summary-item">
                                <div class="body-text">Lý do</div>
                                <div class="body-title-2 text-sm text-danger">
                                    <b>{{ $order->cancellation_reason }}</b>
                                </div>
                            </div>
                        @endif
                        <div class="summary-item">
                            <div class="body-text">Ngày đặt</div>
                            <div class="body-title-2">
                                {{ $order->ordered_at ? $order->ordered_at->format('d/m/Y H:i') : '-' }}</div>
                        </div>
                        <div class="summary-item">
                            <div class="body-text">Tổng cộng</div>
                            <div class="body-title-2 tf-color-1">{{ number_format($order->total_amount, 0, ',', '.') }}₫
                            </div>
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
                        <div class="body-title">Thông tin người đặt hàng</div>
                        <div class="body-text">
                            <b>Họ tên:</b> {{ $order->buyer_name ?? ($order->customer_name ?? '-') }}<br>
                            <b>Email:</b> {{ $order->buyer_email ?? ($order->customer_email ?? '-') }}<br>
                            <b>SĐT:</b> {{ $order->buyer_phone ?? ($order->customer_phone ?? '-') }}<br>
                            <b>Địa chỉ:</b> {{ $order->buyer_address ?? '-' }}
                        </div>
                    </div>

                    <div class="wg-box mb-20 gap10">
                        <div class="body-title">Địa chỉ giao hàng</div>
                        <div class="body-text">
                            <b>Họ tên người nhận:</b>
                            {{ $order->shipping_name ?? ($order->buyer_name ?? ($order->customer_name ?? '-')) }}<br>
                            <b>SĐT người nhận:</b>
                            {{ $order->shipping_phone ?? ($order->buyer_phone ?? ($order->customer_phone ?? '-')) }}<br>
                            <b>Email người nhận:</b>
                            {{ $order->shipping_email ?? ($order->buyer_email ?? ($order->customer_email ?? '-')) }}<br>
                            <b>Địa chỉ:</b> {{ $order->shipping_address ?? ($order->buyer_address ?? '-') }}
                        </div>
                    </div>

                    <!-- Thông tin shipper -->
                    <div class="wg-box mb-20 gap10">
                        <div class="flex items-center justify-between mb-10">
                            <div class="body-title">🚛 Thông tin shipper</div>
                            @if($order->shipper_id && in_array($order->order_status, ['pending', 'confirmed']))
                                <button type="button" class="tf-button style-3" data-bs-toggle="modal" data-bs-target="#changeShipperModal">
                                    <i class="icon-edit-3"></i> Đổi shipper
                                </button>
                            @endif
                        </div>
                        
                        @if($order->shipper)
                            <div class="shipper-info">
                                <div class="flex items-center gap10 mb-15">
                                    <div class="shipper-avatar">
                                        <div style="width:50px;height:50px;background:linear-gradient(135deg,#667eea 0%,#764ba2 100%);border-radius:50%;display:flex;align-items:center;justify-content:center;color:white;font-weight:600;font-size:18px;">
                                            {{ strtoupper(substr($order->shipper->name, 0, 1)) }}
                                        </div>
                                    </div>
                                    <div class="shipper-details">
                                        <div class="body-title-2">{{ $order->shipper->name }}</div>
                                        <div class="text-tiny" style="color: {{ $order->shipper->status === 'active' ? '#22C55E' : '#F59E0B' }};">
                                            {{ $order->shipper->status === 'active' ? '✅ Đang hoạt động' : '⏸️ Tạm ngưng' }}
                                        </div>
                                    </div>
                                </div>
                                <div class="body-text">
                                    <b>📧 Email:</b> {{ $order->shipper->email }}<br>
                                    <b>📱 Điện thoại:</b> {{ $order->shipper->phone ?? 'Chưa có' }}<br>
                                    @if($order->shipper->address)
                                        <b>📍 Địa chỉ:</b> {{ $order->shipper->address }}<br>
                                    @endif
                                    <b>📊 Hiệu suất:</b> 
                                    <span class="fw-7">{{ $order->shipper->orders()->count() }} đơn hàng</span>
                                    @php
                                        $workload = $order->shipper->orders()->whereIn('order_status', ['processing', 'shipped'])->count();
                                        $color = $workload >= 5 ? '#EF4444' : ($workload >= 3 ? '#F59E0B' : '#22C55E');
                                        $text = $workload >= 5 ? 'Bận' : ($workload >= 3 ? 'Vừa' : 'Rảnh');
                                    @endphp
                                    <span style="color: {{ $color }}; font-weight: 600; margin-left: 8px;">
                                        ({{ $text }} - {{ $workload }} đơn đang xử lý)
                                    </span>
                                </div>
                                
                                @if(in_array($order->order_status, ['processing', 'shipped']))
                                    <div class="mt-15">
                                        <div class="flex items-center gap10">
                                            <div class="status-indicator" style="width:8px;height:8px;background:#22C55E;border-radius:50%;"></div>
                                            <span class="text-tiny fw-7" style="color:#22C55E;">Đang giao hàng</span>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @else
                            <div class="no-shipper" style="text-align: center; padding: 20px; background: #FEF3C7; border-radius: 8px; border: 1px solid #F59E0B;">
                                <div style="font-size: 32px; margin-bottom: 10px;">📦</div>
                                <div class="body-text" style="color: #92400E; margin-bottom: 15px;">
                                    <b>Chưa có shipper giao hàng</b><br>
                                    Đơn hàng này chưa được phân chia cho shipper nào
                                </div>
                                @if(in_array($order->order_status, ['pending', 'confirmed']))
                                    <button type="button" class="tf-button style-1" data-bs-toggle="modal" data-bs-target="#assignShipperModal">
                                        <i class="icon-user-plus"></i> Phân chia shipper
                                    </button>
                                @endif
                            </div>
                        @endif
                    </div>

                    <div class="wg-box gap10">
                        <a class="tf-button w-full" target="_blank"
                            href="{{ route('admin.orders.printInvoice', $order->id) }}"><i class="icon-file-text"></i> In
                            hóa đơn</a>
                        <a class="tf-button w-full" target="_blank"
                            href="{{ route('admin.orders.printShipping', $order->id) }}"><i class="icon-file-text"></i>
                            In
                            phiếu giao hàng</a>
                        @if ($order->order_status === 'pending_cancellation')
                            <button type="button" class="tf-button w-full style-2 mt-2" data-bs-toggle="modal"
                                data-bs-target="#modalCancelOrder">
                                Xác nhận hủy đơn
                            </button>
                        @endif
                        
                        @if ($order->order_status === 'cancelled' && $order->pending_refund)
                            <button type="button" class="tf-button w-full style-1 mt-2" data-bs-toggle="modal"
                                data-bs-target="#modalProcessRefund">
                                <i class="icon-dollar-sign"></i>
                                Xử lý hoàn tiền
                            </button>
                        @elseif ($order->order_status === 'cancelled' && !$order->pending_refund)
                            @php
                                $successRefund = $order->refunds()->where('status', 'success')->first();
                            @endphp
                            @if ($successRefund)
                                <div class="alert alert-success mt-2" style="background: #d1fae5; border: 1px solid #a7f3d0; color: #065f46; border-radius: 8px; padding: 12px; text-align: center; font-size: 15px;">
                                    <i class="icon-check-circle" style="margin-right: 8px;"></i>
                                    <strong>Đã hoàn tiền thành công</strong><br>
                                    <small>Ngày: {{ $successRefund->refunded_at ? $successRefund->refunded_at->format('d/m/Y H:i') : 'N/A' }}</small>
                                </div>
                            @else
                                <div class="alert alert-info mt-2" style="background: #dbeafe; border: 1px solid #93c5fd; color: #1e40af; border-radius: 8px; padding: 12px; text-align: center;">
                                    <i class="icon-info" style="margin-right: 8px;"></i>
                                    <strong>Đơn hàng đã được hủy</strong><br>
                                    <small>Không cần hoàn tiền</small>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
            <!-- /Chi tiết đơn hàng -->
        </div>
    </div>
    
    <!-- Modal xử lý hoàn tiền -->
    @if ($order->order_status === 'cancelled' && $order->pending_refund)
        <div class="modal fade" id="modalProcessRefund" tabindex="-1" aria-labelledby="modalProcessRefundLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form method="POST" action="{{ route('admin.orders.process-refund', $order->id) }}">
                    @csrf
                    <div class="modal-content" style="border-radius: 12px; border: none; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);">
                        <div class="modal-header" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; border-radius: 12px 12px 0 0; border: none;">
                            <h5 class="modal-title" id="modalProcessRefundLabel" style="display: flex; align-items: center; font-weight: 600; font-size: 20px;">
                                <i class="icon-dollar-sign" style="margin-right: 12px; font-size: 22px;"></i>
                                Xử lý hoàn tiền đơn hàng #{{ $order->order_code }}
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Đóng"></button>
                        </div>
                        <div class="modal-body" style="padding: 24px;">
                            <div class="alert alert-info" style="background: #eff6ff; border: 1px solid #bfdbfe; color: #1e40af; border-radius: 8px; padding: 16px;">
                                <div style="display: flex; align-items: center; margin-bottom: 12px;">
                                    <i class="icon-info" style="margin-right: 8px; font-size: 18px;"></i>
                                    <strong style="font-size: 17px;">Thông tin hoàn tiền</strong>
                                </div>
                                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px; font-size: 15px;">
                                    <div>
                                        <strong>Khách hàng:</strong> {{ $order->customer_name }}
                                    </div>
                                    <div>
                                        <strong>Số tiền:</strong> <span style="color: #059669; font-weight: 600;">{{ number_format($order->total_amount) }} VNĐ</span>
                                    </div>
                                    <div>
                                        <strong>Phương thức:</strong> {{ $order->paymentMethod->name ?? 'N/A' }}
                                    </div>
                                    <div>
                                        <strong>Ngày hủy:</strong> {{ $order->cancelled_at ? $order->cancelled_at->format('d/m/Y H:i') : 'N/A' }}
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group" style="margin-bottom: 20px;">
                                <label for="admin_note" style="font-weight: 600; color: #374151; margin-bottom: 8px; display: block; font-size: 16px;">
                                    <i class="icon-edit-3" style="margin-right: 6px;"></i>
                                    Ghi chú (không bắt buộc):
                                </label>
                                <textarea name="admin_note" id="admin_note" class="form-control" rows="3" 
                                          placeholder="Ghi chú về việc hoàn tiền..." 
                                          style="border: 1px solid #d1d5db; border-radius: 8px; padding: 12px; resize: vertical; font-size: 15px;"></textarea>
                            </div>

                            {{-- <div class="alert alert-warning" style="background: #fffbeb; border: 1px solid #fcd34d; color: #92400e; border-radius: 8px; padding: 16px; font-size: 15px;">
                                <div style="display: flex; align-items: flex-start;">
                                    <i class="icon-alert-triangle" style="margin-right: 8px; font-size: 18px; margin-top: 2px;"></i>
                                    <div>
                                        <strong>Lưu ý quan trọng:</strong><br>
                                        Hệ thống sẽ gọi API VNPay để thực hiện hoàn tiền. 
                                        Vui lòng đảm bảo cấu hình VNPay đã chính xác trước khi thực hiện.
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                        <div class="modal-footer" style="background: #f9fafb; border-top: 1px solid #e5e7eb; border-radius: 0 0 12px 12px; padding: 16px 24px;">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="border-radius: 8px; padding: 10px 20px; font-size: 16px;">
                                <i class="icon-x" style="margin-right: 6px;"></i> Hủy
                            </button>
                            <button type="submit" class="btn btn-success" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); border: none; border-radius: 8px; padding: 10px 20px; font-weight: 600; font-size: 16px;">
                                <i class="icon-check" style="margin-right: 6px;"></i> Xác nhận hoàn tiền
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endif
    
    <!-- Modal xác nhận hủy đơn -->
    @if ($order->order_status === 'pending_cancellation')
        <div class="modal fade" id="modalCancelOrder" tabindex="-1" aria-labelledby="modalCancelOrderLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form method="POST" action="{{ route('admin.orders.processCancel', $order->id) }}">
                    @csrf
                    <div class="modal-content" style="border-radius: 12px; border: none; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);">
                        <div class="modal-header" style="background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); color: white; border-radius: 12px 12px 0 0; border: none;">
                            <h5 class="modal-title" id="modalCancelOrderLabel" style="display: flex; align-items: center; font-weight: 600;">
                                <i class="icon-alert-triangle" style="margin-right: 12px; font-size: 1.2em;"></i>
                                Xác nhận hủy đơn hàng #{{ $order->order_code }}
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Đóng"></button>
                        </div>
                        <div class="modal-body" style="padding: 24px;">
                            <div class="alert alert-warning" style="background: #fffbeb; border: 1px solid #fcd34d; color: #92400e; border-radius: 8px; padding: 16px; margin-bottom: 20px;">
                                <div style="display: flex; align-items: flex-start;">
                                    <i class="icon-alert-triangle" style="margin-right: 8px; font-size: 1.1em; margin-top: 2px;"></i>
                                    <div>
                                        <strong>Lưu ý quan trọng:</strong><br>
                                        Việc hủy đơn hàng sẽ ảnh hưởng đến tồn kho và có thể gây mất mát doanh thu. 
                                        Vui lòng xem xét kỹ lưỡng trước khi thực hiện.
                                    </div>
                                </div>
                            </div>

                            <div class="form-group" style="margin-bottom: 20px;">
                                <label for="cancellation_reason" style="font-weight: 600; color: #374151; margin-bottom: 8px; display: block;">
                                    <i class="icon-edit-3" style="margin-right: 6px;"></i>
                                    Lý do hủy đơn <span style="color: #ef4444;">*</span>
                                </label>
                                <textarea name="cancellation_reason" id="cancellation_reason" class="form-control" required rows="3" 
                                          placeholder="Nhập lý do hủy đơn hàng..." 
                                          style="border: 1px solid #d1d5db; border-radius: 8px; padding: 12px; resize: vertical;">{{ old('cancellation_reason', $order->cancellation_reason) }}</textarea>
                            </div>

                            <div class="form-group" style="margin-bottom: 20px;">
                                <label for="admin_note_cancel" style="font-weight: 600; color: #374151; margin-bottom: 8px; display: block;">
                                    <i class="icon-message-square" style="margin-right: 6px;"></i>
                                    Ghi chú của quản trị viên (không bắt buộc):
                                </label>
                                <textarea name="admin_note_cancel" id="admin_note_cancel" class="form-control" rows="3" 
                                          placeholder="Ghi chú nội bộ về việc hủy đơn..."
                                          style="border: 1px solid #d1d5db; border-radius: 8px; padding: 12px; resize: vertical;">{{ old('admin_note_cancel') }}</textarea>
                            </div>

                            <div class="alert alert-info" style="background: #eff6ff; border: 1px solid #bfdbfe; color: #1e40af; border-radius: 8px; padding: 16px;">
                                <div style="display: flex; align-items: center;">
                                    <i class="icon-info" style="margin-right: 8px; font-size: 1.1em;"></i>
                                    <div>
                                        <strong>Thông tin bổ sung:</strong><br>
                                        • Hệ thống sẽ tự động cập nhật tồn kho khi hủy đơn<br>
                                        • Khách hàng sẽ nhận được thông báo về việc hủy đơn<br>
                                        • Nếu đơn hàng đã thanh toán, sẽ được đánh dấu chờ hoàn tiền
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer" style="background: #f9fafb; border-top: 1px solid #e5e7eb; border-radius: 0 0 12px 12px; padding: 16px 24px;">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="border-radius: 8px; padding: 10px 20px;">
                                <i class="icon-x" style="margin-right: 6px;"></i> Đóng
                            </button>
                            <button type="submit" name="action" value="reject" class="btn btn-warning" style="border-radius: 8px; padding: 10px 20px; font-weight: 600;">
                                <i class="icon-x-circle" style="margin-right: 6px;"></i> Từ chối hủy
                            </button>
                            <button type="submit" name="action" value="approve" class="btn btn-danger" style="background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); border: none; border-radius: 8px; padding: 10px 20px; font-weight: 600;">
                                <i class="icon-check" style="margin-right: 6px;"></i> Duyệt hủy & trả tồn kho
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <!-- Modal gán shipper -->
    <div class="modal fade" id="assignShipperModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">📦 Phân chia shipper cho đơn hàng</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('admin.orders.assign-shipper', $order->id) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Chọn shipper giao hàng:</label>
                            <select name="shipper_id" class="form-select" required>
                                <option value="">-- Chọn shipper --</option>
                                @foreach(\App\Models\Shipper::where('status', 'active')->withCount(['orders' => function($query) { $query->whereIn('order_status', ['processing', 'shipped']); }])->orderBy('orders_count', 'asc')->get() as $shipper)
                                <option value="{{ $shipper->id }}">
                                    {{ $shipper->name }} 
                                    ({{ $shipper->orders_count }} đơn - {{ $shipper->orders_count >= 5 ? 'Bận' : ($shipper->orders_count >= 3 ? 'Vừa' : 'Rảnh') }})
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="alert alert-info">
                            <i class="icon-info"></i>
                            Shipper sẽ nhận được thông báo và có thể xem đơn hàng trong app của họ.
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="icon-user-plus"></i> Phân chia shipper
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal đổi shipper -->
    <div class="modal fade" id="changeShipperModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">🔄 Đổi shipper giao hàng</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('admin.orders.change-shipper', $order->id) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        @if($order->shipper)
                        <div class="alert alert-warning">
                            <b>Shipper hiện tại:</b> {{ $order->shipper->name }} ({{ $order->shipper->email }})
                        </div>
                        @endif
                        <div class="mb-3">
                            <label class="form-label">Chọn shipper mới:</label>
                            <select name="shipper_id" class="form-select" required>
                                <option value="">-- Chọn shipper mới --</option>
                                @foreach(\App\Models\Shipper::where('status', 'active')->where('id', '!=', $order->shipper_id)->withCount(['orders' => function($query) { $query->whereIn('order_status', ['processing', 'shipped']); }])->orderBy('orders_count', 'asc')->get() as $shipper)
                                <option value="{{ $shipper->id }}">
                                    {{ $shipper->name }} 
                                    ({{ $shipper->orders_count }} đơn - {{ $shipper->orders_count >= 5 ? 'Bận' : ($shipper->orders_count >= 3 ? 'Vừa' : 'Rảnh') }})
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Lý do đổi shipper:</label>
                            <textarea name="change_reason" class="form-control" rows="3" placeholder="Nhập lý do đổi shipper..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-warning">
                            <i class="icon-refresh-cw"></i> Đổi shipper
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
    <script></script>
@endpush
