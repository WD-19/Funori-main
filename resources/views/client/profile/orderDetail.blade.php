@extends('client.profile.profile_base')

@section('page_title', 'Chi tiết đơn hàng')

@section('content_profile')
    @php
        $statusMap = [
            'pending_confirmation' => 'Chờ xác nhận',
            'processing' => 'Đang xử lý',
            'shipped' => 'Đang giao hàng',
            'delivered' => 'Đã giao hàng',
            'cancelled' => 'Đã hủy',
            'returned' => 'Đã trả hàng',
        ];
        // Chuẩn hóa key trạng thái (nếu trạng thái là tiếng Anh hoặc mã)
        $orderStatusKey = \Illuminate\Support\Str::slug($order->order_status ?? 'unknown_status', '_');
        $orderStatusVN = $statusMap[$orderStatusKey] ?? ($order->order_status ?? 'Trạng thái không xác định');
    @endphp
    <div class="container my-5" x-data="orderTracking({ orderId: {{ $order->id }}, initialStatus: '{{ $order->order_status }}', initialCreatedAt: '{{ $order->created_at?->format('c') }}', initialUpdatedAt: '{{ $order->updated_at?->format('c') }}' })" x-init="init()">
        <div class="order-detail-card"> {{-- Added padding, rounded corners, and shadow --}}
            <div class="text-center mb-4">
                <h2 style="font-size: 50px"  class="fw-bold text-uppercase mb-2"> {{-- Increased bottom margin for heading --}}
                    <i class="bi bi-receipt-cutoff me-2 text-primary"></i>
                    Đơn hàng #{{ $order->order_code ?? 'N/A' }}
                </h2>
                <span class="order-status-badge status-{{ $orderStatusKey }}">
                    {{ $orderStatusVN }}
                </span>
            </div>

            <div class="row gy-4 mb-4"> {{-- Added bottom margin for the info row --}}
                <div class="col-md-6">
                    <div class="info-box"> {{-- Removed mb-3, it's handled by gy-4 on parent row --}}
                        <h5 class="info-box-title"><i class="bi bi-info-circle me-2"></i>Thông tin chung</h5>
                        {{-- Added title to info box --}}
                        <div class="info-item common-info"><strong>Mã đơn hàng:</strong>
                            <span>{{ $order->order_code ?? 'N/A' }}</span>
                        </div>
                        <div class="info-item common-info"><strong>Ngày đặt:</strong>
                            <span>{{ $order->created_at ? $order->created_at->format('d/m/Y H:i') : 'N/A' }}</span>
                        </div>
                        <div class="info-item common-info"><strong>Thanh toán:</strong>
                            <span>{{ $order->paymentMethod->name ?? '---' }}</span>
                        </div>
                        <div class="info-item common-info"><strong>Giao hàng:</strong>
                            <span>{{ $order->shippingMethod->name ?? 'Giao tiêu chuẩn' }}</span>
                        </div>
                        <div class="info-item common-info"><strong>Ghi chú:</strong>
                            <span>{{ $order->note ?? 'Không có' }}</span>
                        </div>

                        @if (!empty($order->discount_code))
                            <div class="info-item common-info">
                                <strong>Mã giảm giá:</strong>
                                <span>{{ $order->discount_code }}</span>
                            </div>
                        @endif

                        @if (!empty($order->discount_amount) && $order->discount_amount > 0)
                            <div class="info-item common-info">
                                <strong>Số tiền giảm:</strong>
                                <span>-{{ number_format($order->discount_amount, 0, ',', '.') }}₫</span>
                            </div>
                        @endif

                        @if (in_array($order->order_status, ['cancelled', 'pending_cancellation']) && !empty($order->cancellation_reason))
                            <div class="info-item common-info text-danger"><strong>Lý do hủy:</strong>
                                <span>{{ $order->cancellation_reason }}</span>
                            </div>
                        @endif
                            
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="info-box"> {{-- Removed mb-3 --}}
                        <h5 class="info-box-title"><i class="bi bi-person me-2"></i>Thông tin người nhận</h5>
                        {{-- Added title to info box --}}
                        <div class="info-item common-info"><strong>Họ và tên:</strong>
                            <span>{{ $order->customer_name ?? 'N/A' }}</span>
                        </div>
                        <div class="info-item common-info"><strong>Điện thoại:</strong>
                            <span>{{ $order->customer_phone ?? 'N/A' }}</span>
                        </div>
                        <div class="info-item common-info"><strong>Email:</strong>
                            <span>{{ $order->customer_email ?? 'N/A' }}</span>
                        </div>
                        <div class="info-item common-info"><strong>Địa chỉ:</strong>
                            <span>{{ $order->shipping_address ?? 'N/A' }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="my-5 border-secondary-subtle"> {{-- Thicker, softer HR --}}

            {{-- Timeline trạng thái đơn hàng kiểu Shopee --}}
            <div class="mb-5">
                <h4 class="fw-bold mb-4"><i class="bi bi-clock-history me-2 text-primary"></i>Lịch sử đơn hàng</h4>
                
                <!-- Status Badge -->
                <div class="d-flex align-items-center flex-wrap gap-2 mb-4">
                    <span :class="['badge rounded-pill px-3 py-2', statusClass]" x-text="statusText"></span>
                    <template x-if="shipper && shipper.name">
                        <span class="text-muted">Shipper: <strong x-text="shipper.name"></strong></span>
                    </template>
                </div>

                <!-- Timeline -->
                <div class="order-timeline">
                    <!-- Step 1: Đặt hàng -->
                    <div class="timeline-item completed">
                        <div class="timeline-icon">
                            <i class="bi bi-check-circle-fill"></i>
                        </div>
                        <div class="timeline-content">
                            <div class="timeline-title">Đơn hàng đã được đặt</div>
                            <div class="timeline-desc">Đơn hàng đã được tạo thành công</div>
                            <div class="timeline-time">{{ $order->created_at?->format('d/m/Y H:i') }}</div>
                        </div>
                    </div>

                    <!-- Step 2: Xác nhận -->
                    <div class="timeline-item" :class="{ 'completed': status !== 'pending_confirmation' }">
                        <div class="timeline-icon">
                            <i class="bi bi-check-circle-fill"></i>
                        </div>
                        <div class="timeline-content">
                            <div class="timeline-title">Đơn hàng đã được xác nhận</div>
                            <div class="timeline-desc">Cửa hàng đã xác nhận đơn hàng</div>
                            <div class="timeline-time" x-text="getStepTime('confirmed')"></div>
                        </div>
                    </div>

                    <!-- Step 3: Chuẩn bị hàng -->
                    <div class="timeline-item" :class="{ 'completed': ['shipped', 'delivered', 'failed', 'returned'].includes(status) }" x-show="!['cancelled'].includes(status)">
                        <div class="timeline-icon">
                            <i class="bi bi-box-seam-fill"></i>
                        </div>
                        <div class="timeline-content">
                            <div class="timeline-title">Đang chuẩn bị hàng</div>
                            <div class="timeline-desc">Cửa hàng đang chuẩn bị sản phẩm</div>
                            <div class="timeline-time" x-text="getStepTime('processing')"></div>
                        </div>
                    </div>

                    <!-- Step 4: Đang giao -->
                    <div class="timeline-item" :class="{ 'completed': ['delivered', 'failed', 'returned'].includes(status), 'active': status === 'shipped' }" x-show="!['cancelled'].includes(status)">
                        <div class="timeline-icon">
                            <i class="bi bi-truck"></i>
                        </div>
                        <div class="timeline-content">
                            <div class="timeline-title">Đang giao hàng</div>
                            <div class="timeline-desc">
                                <span x-show="status === 'shipped'">Đơn hàng đang được giao đến bạn</span>
                                <span x-show="status === 'delivered'">Đơn hàng đã được giao thành công</span>
                                <span x-show="status === 'failed'">Giao hàng thất bại</span>
                                <span x-show="status === 'returned'">Đã hoàn trả hàng về kho</span>
                                <span x-show="!['shipped', 'delivered', 'failed', 'returned'].includes(status)">Chờ giao hàng</span>
                                
                                <!-- Thông tin shipper -->
                                <template x-if="['shipped', 'delivered', 'failed', 'returned'].includes(status)">
                                    <div class="shipper-info">
                                        <template x-if="shipper && shipper.name">
                                            <div>
                                                <div class="d-flex align-items-center gap-2 mb-2">
                                                    <i class="bi bi-person-circle text-primary"></i>
                                                    <span class="fw-medium">Shipper: <strong x-text="shipper.name"></strong></span>
                                                </div>
                                                <template x-if="shipper.lat && shipper.lng">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <i class="bi bi-geo-alt text-success"></i>
                                                        <a :href="`https://www.google.com/maps?q=${shipper.lat},${shipper.lng}`" 
                                                           target="_blank" 
                                                           class="text-decoration-none small">
                                                            📍 Xem vị trí hiện tại của shipper
                                                        </a>
                                                    </div>
                                                </template>
                                                <template x-if="!shipper.lat || !shipper.lng">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <i class="bi bi-geo-alt text-warning"></i>
                                                        <span class="small text-muted">Vị trí chưa được cập nhật</span>
                                                    </div>
                                                </template>
                                                <template x-if="shipper.updated_at">
                                                    <div class="mt-1">
                                                        <small class="text-muted">
                                                            <i class="bi bi-clock"></i>
                                                            Cập nhật: <span x-text="formatTime(shipper.updated_at)"></span>
                                                        </small>
                                                    </div>
                                                </template>
                                            </div>
                                        </template>
                                        
                                        <template x-if="!shipper || !shipper.name">
                                            <div class="alert alert-warning py-2 px-3 mb-0">
                                                <div class="d-flex align-items-center gap-2">
                                                    <i class="bi bi-exclamation-triangle-fill"></i>
                                                    <div>
                                                        <div class="fw-medium">Đơn hàng đang được chuẩn bị giao</div>
                                                        <div class="small">Shipper sẽ được phân công sớm nhất</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </template>
                                    </div>
                                </template>
                            </div>
                            <div class="timeline-time" x-text="getStepTime('shipped')"></div>
                        </div>
                    </div>

                    <!-- Step 5: Đã giao -->
                    <div class="timeline-item" :class="{ 'completed': status === 'delivered' }" x-show="!['cancelled'].includes(status)">
                        <div class="timeline-icon">
                            <i class="bi bi-house-check-fill"></i>
                        </div>
                        <div class="timeline-content">
                            <div class="timeline-title">Giao hàng thành công</div>
                            <div class="timeline-desc">Đơn hàng đã được giao thành công</div>
                            <div class="timeline-time" x-text="getStepTime('delivered')"></div>
                        </div>
                    </div>

                    <!-- Step 6: Giao hàng thất bại -->
                    <div class="timeline-item" x-show="status === 'failed'" style="display: none;">
                        <div class="timeline-icon failed">
                            <i class="bi bi-x-circle-fill"></i>
                        </div>
                        <div class="timeline-content">
                            <div class="timeline-title">Giao hàng thất bại</div>
                            <div class="timeline-desc">Đơn hàng không thể giao được</div>
                            <div class="timeline-time" x-text="getStepTime('failed')"></div>
                        </div>
                    </div>

                    <!-- Step 7: Đã hủy (hiển thị khi đơn hàng bị hủy trước khi giao) -->
                    <div class="timeline-item" :class="{ 'completed': ['cancelled', 'returned'].includes(status) }" x-show="['cancelled', 'returned'].includes(status)" style="display: none;">
                        <div class="timeline-icon cancelled">
                            <i class="bi bi-x-circle-fill"></i>
                        </div>
                        <div class="timeline-content">
                            <div class="timeline-title">Đơn hàng đã bị hủy</div>
                            <div class="timeline-desc">
                                <span x-show="status === 'cancelled'">Đơn hàng đã được hủy</span>
                                <span x-show="status === 'returned'">Đơn hàng không giao được, đã trả về kho</span>
                            </div>
                            <div class="timeline-time" x-text="getStepTime('cancelled') || getStepTime('returned')"></div>
                        </div>
                    </div>

                    <!-- Step 8: Đánh giá (chỉ hiển thị khi đã giao) -->
                    <div class="timeline-item" x-show="status === 'delivered'" style="display: none;">
                        <div class="timeline-icon">
                            <i class="bi bi-star-fill"></i>
                        </div>
                        <div class="timeline-content">
                            <div class="timeline-title">Đánh giá sản phẩm</div>
                            <div class="timeline-desc">Hãy đánh giá sản phẩm để giúp chúng tôi cải thiện dịch vụ</div>
                            <div class="timeline-time">
                                <a href="#" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-star me-1"></i>Đánh giá ngay
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-5"> {{-- Increased bottom margin --}}
                <h4 class="fw-bold mb-4"><i class="bi bi-box-seam me-2 text-primary"></i>Sản phẩm đã mua</h4>
                {{-- Increased bottom margin for title --}}
                @if (($order->items ?? null) && count($order->items) > 0)
                    <div class="product-cards-container"> {{-- Changed to a container for cards --}}
                        @foreach ($order->items as $item)
                            <div class="product-card-item"> {{-- Card for each product --}}
                                <div class="product-card-thumbnail">
                                    @php
                                        // Ưu tiên ảnh biến thể, sau đó đến ảnh thumbnail của sản phẩm
                                        $variantImageUrl = optional($item->productVariant->image)->image_url;
                                        $productThumbnailUrl = optional($item->product->thumbnail)->image_url;
                                        $finalImageUrl = $variantImageUrl ?? $productThumbnailUrl;
                                    @endphp
                                    <img src="{{ $finalImageUrl ? asset($finalImageUrl) : 'https://via.placeholder.com/70?text=No+Image' }}"
                                        alt="{{ optional($item->product)->name ?? 'Sản phẩm' }}" class="product-thumb">
                                </div>
                                <div class="product-card-details ps-2" style="width:100%;">
                                    <div class="d-flex justify-content-between align-items-end w-100">
                                        <div class="d-flex flex-column align-items-start flex-grow-1">
                                            <div class="product-card-name fw-semibold text-dark mb-1">
                                                {{ $item->product->name ?? 'N/A' }}
                                            </div>
                                            @php
                                                $variantAttrs =
                                                    $item->productVariant && $item->productVariant->attributeValues
                                                        ? $item->productVariant->attributeValues
                                                            ->map(function ($v) {
                                                                return (optional($v->attribute)->name ?? '') .
                                                                    ': ' .
                                                                    ($v->value ?? '');
                                                            })
                                                            ->filter()
                                                            ->toArray()
                                                        : [];
                                            @endphp

                                            @if (!empty($variantAttrs))
                                                <div class="product-card-variant text-muted mb-1">
                                                    @foreach ($variantAttrs as $attr)
                                                        <span>{{ $attr }}</span>
                                                        @if (!$loop->last)
                                                            ,
                                                        @endif
                                                    @endforeach
                                                </div>
                                            @else
                                                <div class="product-card-variant text-muted mb-1">
                                                    {{ $item->productVariant->name_variant ?? 'N/A' }}
                                                </div>
                                            @endif

                                            @if (!empty($item->productVariant->size))
                                                <div class="product-card-variant text-muted mb-1">
                                                    Kích thước: {{ $item->productVariant->size }}
                                                </div>
                                            @endif
                                            <div class="product-card-quantity mb-1">
                                                Số lượng: <span>{{ $item->quantity ?? 0 }}</span>
                                            </div>
                                            <div class="product-card-price text-primary fw-bold mb-0"
                                                style="white-space:nowrap;">
                                                Giá tiền: {{ number_format($item->subtotal ?? 0, 0, ',', '.') }}₫
                                            </div>
                                        </div>
                                        @if ($orderStatusVN == 'Đã giao')
                                            <div class="d-flex flex-column justify-content-end" style="height: 100%;">
                                                <div class="d-flex gap-2 align-items-center" style="height: 100%;">
                                                    <a href="{{ route('client.product.show', ['slug' => $item->product->slug ?? '']) }}#product-reviews"
                                                        class="btn btn-outline-primary">
                                                        <i class="bi bi-star-fill me-1"></i>Đánh giá
                                                    </a>

                                                </div>
                                            </div>
                                        @endif
                                        @if ($order->order_status === 'cancelled' && $order->items && count($order->items) > 0)
                                            <a href="{{ route('client.product.show', ['slug' => $order->items[0]->product->slug ?? '']) }}"
                                                class="btn btn-primary btn-repeat-order"
                                                data-order-id="{{ $order->id }}">
                                                <i class="bi bi-cart-plus me-2"></i>Mua lại
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="alert alert-info text-center py-4 rounded-3" role="alert">
                        <i class="bi bi-info-circle-fill me-2"></i>Đơn hàng không có sản phẩm nào.
                    </div>
                @endif
            </div>



            <div class="d-grid gap-2 col-6 mx-auto">
                <a href="" class="btn btn-outline-warning">
                    <i class="bi bi-headset me-2"></i>Liên hệ hỗ trợ
                </a>
                <a href="{{ route('client.profile.my_account.order') }}" class="btn btn-outline-dark">
                    <i class="bi bi-list-ul me-2"></i>Quay lại danh sách đơn hàng
                </a>

            </div>
        </div>

        <!-- Modal Hủy đơn hàng -->
        <div class="modal fade" id="cancelOrderModal" tabindex="-1" aria-labelledby="cancelOrderModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="POST"
                        action="{{ route('client.profile.my_account.order.cancel', ['order' => $order->id]) }}"
                        id="cancelOrderForm">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="cancelOrderModalLabel">Chọn lý do hủy đơn hàng</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="cancel_reason" id="reason1"
                                        value="Đặt nhầm sản phẩm hoặc số lượng" required>
                                    <label class="form-check-label" for="reason1">Đặt nhầm sản phẩm hoặc số lượng</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="cancel_reason" id="reason2"
                                        value="Không còn nhu cầu sử dụng sản phẩm">
                                    <label class="form-check-label" for="reason2">Không còn nhu cầu sử dụng sản
                                        phẩm</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="cancel_reason" id="reason3"
                                        value="Tìm thấy sản phẩm tương tự với giá tốt hơn">
                                    <label class="form-check-label" for="reason3">Tìm thấy sản phẩm tương tự với giá tốt
                                        hơn</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="cancel_reason" id="reason4"
                                        value="Thời gian giao hàng quá lâu">
                                    <label class="form-check-label" for="reason4">Thời gian giao hàng quá lâu</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="cancel_reason" id="reason5"
                                        value="Thay đổi địa chỉ hoặc thông tin nhận hàng">
                                    <label class="form-check-label" for="reason5">Thay đổi địa chỉ hoặc thông tin nhận
                                        hàng</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="cancel_reason" id="reasonOther"
                                        value="other">
                                    <label class="form-check-label" for="reasonOther">Lý do khác (vui lòng ghi rõ)</label>
                                </div>
                                <textarea class="form-control mt-2 d-none" name="cancel_reason_other" id="cancelReasonOtherText" rows="2"
                                    placeholder="Nhập lý do khác..."></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                            <button type="submit" class="btn btn-danger">Xác nhận hủy đơn</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const reasonOtherRadio = document.getElementById('reasonOther');
                const otherTextarea = document.getElementById('cancelReasonOtherText');
                const radios = document.querySelectorAll('input[name="cancel_reason"]');
                radios.forEach(radio => {
                    radio.addEventListener('change', function() {
                        if (reasonOtherRadio.checked) {
                            otherTextarea.classList.remove('d-none');
                            otherTextarea.required = true;
                        } else {
                            otherTextarea.classList.add('d-none');
                            otherTextarea.required = false;
                            otherTextarea.value = '';
                        }
                    });
                });
                // Khi submit, nếu chọn lý do khác thì lấy nội dung textarea
                document.getElementById('cancelOrderForm').addEventListener('submit', function(e) {
                    if (reasonOtherRadio.checked && !otherTextarea.value.trim()) {
                        otherTextarea.focus();
                        e.preventDefault();
                    }
                });
            });
        </script>
    </div>
@endsection
<style>
    /* General Body and Container */
    body {
        background: #f0f2f5;
        font-family: 'Inter', sans-serif;
        color: #343a40;
    }

    .container {
        max-width: 1000px;
        /* Adjust max-width as needed */
    }

    h2 {
        font-size: 2rem;
        color: #212529;
        margin-bottom: 0.75rem;
    }

    .order-status-badge {
        display: inline-block;
        padding: 0.5em 1.5em;
        border-radius: 2em;
        font-weight: 600;
        font-size: 0.9rem;
        margin-top: 0.5em;
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }

    .order-status-badge.status-pending_confirmation,
    .order-status-badge.status-processing,
    .order-status-badge.status-shipped {
        background-color: #fff3cd;
        color: #856404;
    }

    .order-status-badge.status-delivered {
        background-color: #d4edda;
        color: #155724;
    }

    .order-status-badge.status-cancelled,
    .order-status-badge.status-returned {
        background-color: #f8d7da;
        color: #721c24;
    }

    .order-status-badge.status-pending_cancellation {
        background-color: #e2e3e5;
        color: #383d41;
    }

    /* Info Boxes (Common Info & Recipient Info) */
    .info-box {
        background: #f8f9fa;
        border-radius: 0.75rem;
        padding: 1.25em;
        box-shadow: 0 1px 5px rgba(0, 0, 0, 0.05);
    }

    .info-box-title {
        font-size: 1.15rem;
        font-weight: 600;
        margin-bottom: 0.8rem;
        color: #495057;
        border-bottom: 1px solid #e9ecef;
        padding-bottom: 0.6rem;
    }

    .info-box-title i {
        color: #007bff;
        font-size: 1.25rem;
    }

    .info-item {
        display: flex;
        align-items: baseline;
        margin-bottom: 0.6rem;
        font-size: 0.98rem;
        line-height: 1.4;
        gap: 12px;
    }

    .info-item.common-info {
        display: flex;
        align-items: flex-start;
        margin-bottom: 0.6rem;
        font-size: 0.98rem;
        line-height: 1.4;
        gap: 12px;
    }

    .info-item.common-info strong {
        width: 120px;
        display: inline-block;
        color: #495057;
        flex-shrink: 0;
        padding-right: 8px;
    }

    .info-item.common-info span {
        flex: 1;
        display: block;
        color: #6c757d;
        word-break: break-word;
    }

    /* Horizontal Rule */
    hr {
        margin-top: 3rem;
        margin-bottom: 3rem;
        border-top: 1px solid #e9ecef;
        opacity: 0.8;
    }

    /* Product Cards - NEW STYLES */
    .product-cards-container {
        display: grid;
        gap: 1rem;
        /* Space between product cards */
    }

    .product-card-item {
        background: #fff;
        border-radius: 0.75rem;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        /* Subtle shadow for each product card */
        padding: 1rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        /* Space between thumbnail, details, and price */
        transition: all 0.2s ease-in-out;
    }

    .product-card-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
    }

    .product-card-thumbnail {
        flex-shrink: 0;
        /* Prevent thumbnail from shrinking */
    }

    .product-thumb {
        width: 70px;
        height: 70px;
        object-fit: cover;
        border-radius: 0.5rem;
        border: 1px solid #e0e0e0;
        background: #f8f9fa;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    }

    .product-card-details {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        width: 100%;
    }

    .product-card-name {
        font-size: 1rem;
        margin-bottom: 0.2rem;
    }

    .product-card-variant {
        font-size: 0.9rem;
        margin-bottom: 0.4rem;
    }

    .product-card-quantity {
        font-size: 0.95rem;
    }

    .product-card-quantity span {
        font-weight: 600;
        color: #343a40;
    }

    .product-card-price {
        font-size: 1.1rem;
        min-width: 80px;
        text-align: right;
    }

    /* Action Buttons */
    .action-button {
        padding: 0.6rem 1.5rem;
        font-size: 0.95rem;
        font-weight: 600;
        border-radius: 0.6rem;
        transition: all 0.2s ease-in-out;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
    }

    .action-button:hover {
        transform: translateY(-1px);
        box-shadow: 0 3px 8px rgba(0, 0, 0, 0.12);
    }

    /* Bootstrap Overrides / Utility classes */
    .text-primary {
        color: #007bff !important;
    }

    .text-success {
        color: #28a745 !important;
    }

    .text-danger {
        color: #dc3545 !important;
    }

    .text-warning {
        color: #ffc107 !important;
    }

    .text-info {
        color: #17a2b8 !important;
    }

    .text-dark {
        color: #212529 !important;
    }

    .text-muted {
        color: #6c757d !important;
    }

    .fw-bold {
        font-weight: 700 !important;
    }

    .fw-semibold {
        font-weight: 600 !important;
    }

    .text-uppercase {
        text-transform: uppercase !important;
    }

    /* Timeline Styles - Shopee-like */
    .order-timeline {
        position: relative;
        padding: 1rem 0;
    }

    .timeline-item {
        position: relative;
        display: flex;
        align-items: flex-start;
        margin-bottom: 2rem;
        transition: all 0.3s ease;
    }

    .timeline-item:last-child {
        margin-bottom: 0;
    }

    .timeline-item::before {
        content: '';
        position: absolute;
        left: 25px;
        top: 50px;
        width: 2px;
        height: calc(100% + 1rem);
        background: #e9ecef;
        z-index: 1;
    }

    .timeline-item:last-child::before {
        display: none;
    }

    .timeline-item.completed::before {
        background: #28a745;
    }

    .timeline-item.active::before {
        background: #007bff;
    }

    .timeline-item.cancelled::before {
        background: #dc3545;
    }

    .timeline-item.failed::before {
        background: #dc3545;
    }

    .timeline-item.returned::before {
        background: #6c757d;
    }

    .timeline-icon {
        position: relative;
        width: 50px;
        height: 50px;
        background: #e9ecef;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
        z-index: 2;
        flex-shrink: 0;
        transition: all 0.3s ease;
    }

    .timeline-item.completed .timeline-icon {
        background: #28a745;
        color: white;
        box-shadow: 0 0 0 4px rgba(40, 167, 69, 0.2);
    }

    .timeline-item.active .timeline-icon {
        background: #007bff;
        color: white;
        box-shadow: 0 0 0 4px rgba(0, 123, 255, 0.2);
        animation: pulse 2s infinite;
    }

    .timeline-item.cancelled .timeline-icon {
        background: #dc3545;
        color: white;
        box-shadow: 0 0 0 4px rgba(220, 53, 69, 0.2);
    }

    .timeline-item.failed .timeline-icon {
        background: #dc3545;
        color: white;
        box-shadow: 0 0 0 4px rgba(220, 53, 69, 0.2);
    }

    .timeline-item.returned .timeline-icon {
        background: #6c757d;
        color: white;
        box-shadow: 0 0 0 4px rgba(108, 117, 125, 0.2);
    }

    .timeline-icon i {
        font-size: 1.2rem;
        color: #6c757d;
    }

    .timeline-item.completed .timeline-icon i,
    .timeline-item.active .timeline-icon i,
    .timeline-item.cancelled .timeline-icon i,
    .timeline-item.returned .timeline-icon i {
        color: white;
    }

    .timeline-content {
        flex: 1;
        background: #f8f9fa;
        padding: 1.2rem;
        border-radius: 0.75rem;
        border: 1px solid #e9ecef;
        transition: all 0.3s ease;
    }

    .timeline-item.completed .timeline-content {
        background: #f8fff9;
        border-color: #28a745;
    }

    .timeline-item.active .timeline-content {
        background: #f0f8ff;
        border-color: #007bff;
        box-shadow: 0 2px 8px rgba(0, 123, 255, 0.1);
    }

    .timeline-item.cancelled .timeline-content {
        background: #f8d7da;
        border-color: #dc3545;
        box-shadow: 0 2px 8px rgba(220, 53, 69, 0.1);
    }

    .timeline-item.failed .timeline-content {
        background: #f8d7da;
        border-color: #dc3545;
        box-shadow: 0 2px 8px rgba(220, 53, 69, 0.1);
    }

    .timeline-item.returned .timeline-content {
        background: #e9ecef;
        border-color: #6c757d;
        box-shadow: 0 2px 8px rgba(108, 117, 125, 0.1);
    }

    .timeline-title {
        font-weight: 600;
        font-size: 1.1rem;
        color: #212529;
        margin-bottom: 0.5rem;
    }

    .timeline-item.completed .timeline-title {
        color: #28a745;
    }

    .timeline-item.active .timeline-title {
        color: #007bff;
    }

    .timeline-item.cancelled .timeline-title {
        color: #dc3545;
    }

    .timeline-item.failed .timeline-title {
        color: #dc3545;
    }

    .timeline-item.returned .timeline-title {
        color: #6c757d;
    }

    .timeline-desc {
        color: #6c757d;
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
        line-height: 1.4;
    }

    .timeline-time {
        color: #495057;
        font-size: 0.85rem;
        font-weight: 500;
    }

    .timeline-item.completed .timeline-time {
        color: #28a745;
    }

    .timeline-item.active .timeline-time {
        color: #007bff;
    }

    .timeline-item.cancelled .timeline-time {
        color: #dc3545;
    }

    .timeline-item.failed .timeline-time {
        color: #dc3545;
    }

    .timeline-item.returned .timeline-time {
        color: #6c757d;
    }

    @keyframes pulse {
        0% {
            box-shadow: 0 0 0 0 rgba(0, 123, 255, 0.7);
        }
        70% {
            box-shadow: 0 0 0 10px rgba(0, 123, 255, 0);
        }
        100% {
            box-shadow: 0 0 0 0 rgba(0, 123, 255, 0);
        }
    }

    /* Shipper Info in Timeline */
    .shipper-info {
        background: linear-gradient(135deg, rgba(0, 123, 255, 0.05) 0%, rgba(40, 167, 69, 0.05) 100%);
        border: 1px solid rgba(0, 123, 255, 0.2);
        border-radius: 0.6rem;
        padding: 0.75rem;
        margin-top: 0.75rem;
        transition: all 0.3s ease;
    }

    .timeline-item.active .shipper-info {
        background: linear-gradient(135deg, rgba(0, 123, 255, 0.1) 0%, rgba(40, 167, 69, 0.1) 100%);
        border-color: rgba(0, 123, 255, 0.3);
        box-shadow: 0 2px 8px rgba(0, 123, 255, 0.1);
    }

    .shipper-info a {
        color: #007bff;
        font-weight: 500;
        transition: all 0.2s ease;
    }

    .shipper-info a:hover {
        color: #0056b3;
        transform: translateX(2px);
    }

    /* Responsive Adjustments */
    @media (max-width: 767.98px) {
        .order-detail-card {
            padding: 1.5rem;
            margin: 1.5rem auto;
        }

        h2 {
            font-size: 1.6rem;
            margin-bottom: 0.5rem;
        }

        .order-status-badge {
            font-size: 0.8rem;
            padding: 0.4em 1em;
        }

        .info-box {
            padding: 1rem;
        }

        .info-box-title {
            font-size: 1rem;
            margin-bottom: 0.6rem;
            padding-bottom: 0.4rem;
        }

        .info-box-title i {
            font-size: 1.1rem;
        }

        .info-item {
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        .info-item.common-info strong {
            width: 100px;
        }

        hr {
            margin-top: 2rem;
            margin-bottom: 2rem;
        }

        .mb-5 {
            margin-bottom: 2.5rem !important;
        }

        .mb-4 {
            margin-bottom: 1.5rem !important;
        }

        .product-card-item {
            flex-direction: column;
            /* Stack elements vertically on small screens */
            align-items: flex-start;
            padding: 0.75rem;
        }

        .product-card-details {
            width: 100%;
            /* Take full width */
            margin-top: 0.5rem;
            /* Space between thumb and details */
        }

        .product-card-price {
            width: 100%;
            text-align: start !important;
            /* Align price to start */
            margin-top: 0.5rem;
        }

        .product-thumb {
            width: 60px;
            height: 60px;
        }

        .action-button {
            padding: 0.5rem 1rem;
            font-size: 0.85rem;
            border-radius: 0.5rem;
        }

        /* Timeline mobile responsive */
        .timeline-icon {
            width: 40px;
            height: 40px;
            margin-right: 0.75rem;
        }

        .timeline-icon i {
            font-size: 1rem;
        }

        .timeline-item::before {
            left: 20px;
        }

        .timeline-content {
            padding: 0.8rem;
        }

        .timeline-title {
            font-size: 1rem;
        }

        .timeline-desc {
            font-size: 0.85rem;
        }

        /* Shipper info mobile responsive */
        .shipper-info {
            padding: 0.6rem;
            margin-top: 0.5rem;
        }

        .shipper-info .d-flex {
            flex-direction: column;
            align-items: flex-start !important;
            gap: 0.25rem !important;
        }
    }

    @media (max-width: 575.98px) {
        .product-card-variant {
            /* Hide variant on very small screens if space is tight */
            display: none;
        }
    }
</style>

<!-- Alpine.js for dynamic timeline updates -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<!-- Echo (Reverb over Pusher protocol) -->
<!-- Realtime disabled for client page -->

<script>
    // Alpine component for order tracking (timeline only)
    function orderTracking({ orderId, initialStatus, initialCreatedAt, initialUpdatedAt }) {
        return {
            orderId,
            status: initialStatus,
            statusText: '',
            statusClass: 'bg-secondary',
            received_at: null,
            in_delivery_at: null,
            delivered_at: null,
            created_at: initialCreatedAt,
            updated_at: initialUpdatedAt,
            shipper: null,
            timer: null,
            
            async init() {
                this.updateStatusDisplay()
                await this.fetchTracking()
                // Poll for updates every 30 seconds
                this.timer = setInterval(() => this.fetchTracking(), 30000)
            },
            
            async fetchTracking() {
                try {
                    const res = await fetch(`/profile/order/${this.orderId}/tracking`, { 
                        headers: { 'X-Requested-With': 'XMLHttpRequest' }
                    })
                    const json = await res.json()
                    if (!json.success) return
                    
                    const d = json.data
                    this.status = d.order_status
                    this.received_at = d.received_at
                    this.in_delivery_at = d.in_delivery_at
                    this.delivered_at = d.delivered_at
                    // Update timestamps from API if available, keep initial values as fallback
                    this.created_at = d.created_at || this.created_at
                    this.updated_at = d.updated_at || this.updated_at
                    this.shipper = d.shipper
                    this.updateStatusDisplay()
                } catch (e) { 
                    console.error('Failed to fetch tracking:', e) 
                }
            },
            
            updateStatusDisplay() {
                const statusMap = {
                    pending_confirmation: { text: 'Chờ xác nhận', cls: 'bg-warning text-dark' },
                    processing: { text: 'Đang xử lý', cls: 'bg-info text-dark' },
                    shipped: { text: 'Đang giao', cls: 'bg-primary text-white' },
                    in_delivery: { text: 'Đang giao', cls: 'bg-primary text-white' },
                    delivered: { text: 'Đã giao', cls: 'bg-success text-white' },
                    cancelled: { text: 'Đã hủy', cls: 'bg-danger text-white' },
                    returned: { text: 'Hoàn trả', cls: 'bg-secondary text-white' },
                    failed: { text: 'Giao thất bại', cls: 'bg-danger text-white' },
                }
                const cfg = statusMap[this.status] || { text: this.status, cls: 'bg-secondary text-white' }
                this.statusText = cfg.text
                this.statusClass = `badge ${cfg.cls}`
            },
            
            formatTime(v) {
                if (!v) return '—'
                try { 
                    return new Date(v).toLocaleString('vi-VN', {
                        day: '2-digit',
                        month: '2-digit', 
                        year: 'numeric',
                        hour: '2-digit',
                        minute: '2-digit'
                    })
                } catch { 
                    return v 
                }
            },

            getStepTime(step) {
                // Helper function to check if timestamp is valid
                const isValidTime = (time) => time && time !== '' && time !== null;
                
                // Fallback logic for each timeline step using API data
                switch(step) {
                    case 'confirmed':
                        // Use received_at if available, otherwise use updated_at for confirmed orders
                        if (isValidTime(this.received_at)) return this.formatTime(this.received_at);
                        if (this.status !== 'pending_confirmation' && isValidTime(this.updated_at)) {
                            return this.formatTime(this.updated_at);
                        }
                        return '—';
                        
                    case 'processing':
                        // Use received_at or updated_at for processing/shipped/delivered orders
                        if (isValidTime(this.received_at)) return this.formatTime(this.received_at);
                        if (['processing', 'shipped', 'delivered', 'failed', 'returned'].includes(this.status) && isValidTime(this.updated_at)) {
                            return this.formatTime(this.updated_at);
                        }
                        return '—';
                        
                    case 'shipped':
                        // Use in_delivery_at if available, otherwise use updated_at for shipped/delivered/failed/returned
                        if (isValidTime(this.in_delivery_at)) return this.formatTime(this.in_delivery_at);
                        if (['shipped', 'delivered', 'failed', 'returned'].includes(this.status) && isValidTime(this.updated_at)) {
                            return this.formatTime(this.updated_at);
                        }
                        return '—';
                        
                    case 'delivered':
                        // Use delivered_at if available, otherwise use updated_at for delivered orders
                        if (isValidTime(this.delivered_at)) return this.formatTime(this.delivered_at);
                        if (this.status === 'delivered' && isValidTime(this.updated_at)) {
                            return this.formatTime(this.updated_at);
                        }
                        return '—';
                        
                    case 'cancelled':
                        // Use updated_at for cancelled orders
                        if (isValidTime(this.updated_at)) return this.formatTime(this.updated_at);
                        return '—';

                    case 'failed':
                        // Use updated_at for failed orders
                        if (isValidTime(this.updated_at)) return this.formatTime(this.updated_at);
                        return '—';

                    case 'returned':
                        // Use updated_at for returned orders
                        if (isValidTime(this.updated_at)) return this.formatTime(this.updated_at);
                        return '—';
                        
                    default:
                        return '—';
                }
            }
        }
    }
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Xử lý nút đánh giá - smooth scroll đến phần đánh giá
        document.querySelectorAll('a[href*="#product-reviews"]').forEach(function(link) {
            link.addEventListener('click', function(e) {
                // Lưu thông tin để chuyển đến trang chi tiết sản phẩm
                const href = this.getAttribute('href');
                const url = href.split('#')[0]; // Lấy URL không có anchor
                const anchor = href.split('#')[1]; // Lấy anchor

                // Lưu anchor vào sessionStorage để sử dụng ở trang chi tiết sản phẩm
                sessionStorage.setItem('scrollToReviews', anchor);

                // Chuyển đến trang chi tiết sản phẩm
                window.location.href = url;
            });
        });

        // Xử lý nút mua lại
        document.querySelectorAll('.btn-repeat-order').forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const orderId = this.dataset.orderId;
                fetch(`/api/order/${orderId}/items`) // API trả về danh sách sản phẩm của đơn
                    .then(res => res.json())
                    .then(items => {
                        // items = [{product_id, product_variant_id, quantity}, ...]
                        const addPromises = items.map(item => {
                            return fetch('/cart/add', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({
                                    product_id: item.product_id,
                                    product_variant_id: item
                                        .product_variant_id,
                                    quantity: item.quantity
                                })
                            }).then(res => res.json());
                        });
                        Promise.all(addPromises).then(results => {
                            // Lấy danh sách key sản phẩm vừa thêm để truyền sang cart
                            const keys = items.map(i => i.product_id + '_' + (i
                                .product_variant_id ?? 'null'));
                            window.location.href = '/cart?repeat_ids=' +
                                encodeURIComponent(keys.join(','));
                        });
                    });
            });
        });
    });
</script>