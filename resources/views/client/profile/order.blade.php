@extends('client.profile.profile_base')

@section('page_title', 'Đơn Hàng')

@section('content_profile')
    <div class="my-account-content account-order">
        <div class="wrap-account-order">
            <div class="order-history-header">
                <h3 class="fw-6">Đơn Hàng Của Tôi</h3>
            </div>
            <div class="order-status-tabs">
                <a href="{{ route('client.profile.my_account.order', ['order_status' => 'all']) }}"
                    class="status-tab {{ request('order_status', 'all') == 'all' ? 'active' : '' }}">Tất cả</a>
                <a href="{{ route('client.profile.my_account.order', ['order_status' => 'pending_confirmation']) }}"
                    class="status-tab {{ request('order_status', 'all') == 'pending_confirmation' ? 'active' : '' }}">Chờ xác
                    nhận</a>
                <a href="{{ route('client.profile.my_account.order', ['order_status' => 'processing']) }}"
                    class="status-tab {{ request('order_status', 'all') == 'processing' ? 'active' : '' }}">Đang xử lý</a>
                <a href="{{ route('client.profile.my_account.order', ['order_status' => 'shipped']) }}"
                    class="status-tab {{ request('order_status', 'all') == 'shipped' ? 'active' : '' }}">Đang giao</a>
                <a href="{{ route('client.profile.my_account.order', ['order_status' => 'delivered']) }}"
                    class="status-tab {{ request('order_status', 'all') == 'delivered' ? 'active' : '' }}">Đã giao</a>
                <a href="{{ route('client.profile.my_account.order', ['order_status' => 'cancelled']) }}"
                    class="status-tab {{ request('order_status', 'all') == 'cancelled' ? 'active' : '' }}">Đã hủy</a>
                <a href="{{ route('client.profile.my_account.order', ['order_status' => 'returned']) }}"
                    class="status-tab {{ request('order_status', 'all') == 'returned' ? 'active' : '' }}">Trả hàng/Hoàn
                    tiền</a>
            </div>
            @php
                $statusMap = [
                    'pending_confirmation' => 'Chờ xác nhận',
                    'processing' => 'Đang xử lý',
                    'shipped' => 'Đã gửi hàng / Đang giao hàng',
                    'delivered' => 'Đã giao hàng',
                    'cancelled' => 'Đã hủy',
                    'returned' => 'Đã hoàn trả',
                    'pending_cancellation' => 'Chờ xác nhận hủy đơn / Đang yêu cầu hủy',
                ];
            @endphp

            <div class="order-list">
                @foreach ($ordersByStatus as $status => $orders)
                    <div class="order-status-group" data-status="{{ $status }}">
                        @if ($orders->isEmpty())
                            <div class="no-orders-message">
                                <img src="{{ asset('images/png-clipart-computer-icons-encapsulated-postscript-writing-written-miscellaneous-text-Photoroom.png') }}"
                                    alt="Không có đơn hàng" style="width: 180px; margin-bottom: 16px;">
                                <div>Không có đơn hàng nào ở trạng thái này!</div>
                            </div>
                        @else
                            @foreach ($orders as $order)
                                <div class="order-card" data-order-status="{{ Str::slug($order->status) }}">
                                    <div class="order-details-content">
                                        {{-- Row 1: Image, Code, and Date --}}
                                        <div class="order-date-and-id" style="display: flex; justify-content: space-between; align-items: center; padding-bottom: 10px; margin-bottom: 10px; border-bottom: 1px dashed #eee;">
                                            <div class="order-id" style="display: flex; align-items: center; gap: 8px;">
                                                @php
                                                    $firstItem = $order->items->first();
                                                    $variantImage = $firstItem && $firstItem->productVariant && $firstItem->productVariant->image ? $firstItem->productVariant->image->image_url : null;
                                                    $productImage = $firstItem && $firstItem->product && $firstItem->product->thumbnail ? $firstItem->product->thumbnail->image_url : null;
                                                    $imageUrl = $variantImage ?? $productImage;
                                                @endphp
                                                <img src="{{ $imageUrl ? asset($imageUrl) : 'https://via.placeholder.com/60?text=N/A' }}"
                                                     alt="Ảnh đại diện đơn"
                                                     style="width:60px;height:60px;object-fit:cover;border-radius:4px;">
                                                <span>Mã đơn hàng: {{ $order->order_code }}</span>
                                            </div>
                                            <div class="order-date">
                                                Ngày đặt hàng: {{ $order->created_at ? $order->created_at->format('d/m/Y - H:i') : '' }}
                                            </div>
                                        </div>

                                        <div class="order-summary-footer-combined">
                                            <div class="order-summary-details">
                                                {{-- Row 2: Payment, Method, Count --}}
                                                <div class="order-other-details" style="display: flex; flex-direction: column; gap: 5px; font-size:14px;">
                                                    @php
                                                        $paymentStatusMap = [
                                                            'pending' => ['label' => 'Chờ thanh toán', 'class' => 'status-pending'],
                                                            'paid' => ['label' => 'Đã thanh toán', 'class' => 'status-paid'],
                                                            'failed' => ['label' => 'Thanh toán thất bại', 'class' => 'status-failed'],
                                                            'refunded' => ['label' => 'Đã hoàn tiền', 'class' => 'status-refunded'],
                                                        ];
                                                        $status = $order->payment_status ?? 'pending';
                                                        $statusInfo = $paymentStatusMap[$status] ?? $paymentStatusMap['pending'];
                                                    @endphp
                                                    <div class="order-payment-status">
                                                        Thanh toán:
                                                        <span class="payment-status {{ $statusInfo['class'] }}">
                                                            {{ $statusInfo['label'] }}
                                                        </span>
                                                    </div>
                                                    <div class="order-payment-method">
                                                        Phương thức thanh toán: <span>{{ $order->paymentMethod->name ?? '---' }}</span>
                                                    </div>
                                                    <div class="order-product-count">
                                                        Số lượng sản phẩm: <strong>{{ $order->items->sum('quantity') }}</strong>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Right Part: Total and Actions --}}
                                            <div class="order-total-amount">
                                                <p>Tổng tiền:</p>
                                                <span class="amount">{{ number_format($order->total_amount, 0, ',', '.') }}₫</span>
                                            </div>
                                            <div class="order-actions">
                                                <a href="{{ route('client.profile.my_account.orderdetail', ['id' => $order->id]) }}" class="btn btn-outline-success">
                                                    <span>Xem chi tiết</span>
                                                </a>
                                                @if (in_array(Str::slug($order->order_status, '_'), ['pending_confirmation', 'processing']))
                                                    <button type="button" class="btn btn-outline-danger cancel-order-btn"
                                                        data-bs-toggle="modal" data-bs-target="#cancelOrderModal"
                                                        data-order-id="{{ $order->id }}">
                                                        Huỷ đơn hàng
                                                    </button>
                                                @endif
                                                @if (Str::slug($order->order_status, '_') === 'delivered')
                                                    @php
                                                        $canReturn = false;
                                                        if ($order->delivered_at) {
                                                            $deliveredAt = \Carbon\Carbon::parse($order->delivered_at);
                                                            $canReturn = now()->diffInDays($deliveredAt) <= 7;
                                                        }
                                                    @endphp
                                                    @if ($canReturn)
                                                        <form action="{{ route('client.profile.my_account.orderdetail', ['id' => $order->id]) }}" method="POST" style="display:inline;">
                                                            @csrf
                                                            <button type="submit" class="btn btn-outline-danger">
                                                                <i class="bi bi-arrow-counterclockwise me-2"></i>Hoàn/Trả hàng
                                                            </button>
                                                        </form>
                                                    @else
                                                        <form action="{{ route('client.profile.order.repeat', $order->id) }}" method="POST" style="display:inline;">
                                                            @csrf
                                                            <button type="submit" class="btn btn-outline-primary">
                                                                <i class="bi bi-cart-plus me-2"></i>Mua lại
                                                            </button>
                                                        </form>
                                                    @endif
                                                @endif
                                                @if (Str::slug($order->order_status, '_') === 'cancelled')
                                                    <form action="{{ route('client.profile.order.repeat', $order->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        <button type="submit" class="btn btn-outline-primary">
                                                            <i class="bi bi-cart-plus me-2"></i>Mua lại
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Modal Hủy đơn hàng (dùng chung cho cả trang) -->
    <div class="modal fade" id="cancelOrderModal" tabindex="-1" aria-labelledby="cancelOrderModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="" id="cancelOrderForm">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="cancelOrderModalLabel">Chọn lý do hủy đơn hàng</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="cancel_reason" id="order_reason1" value="Đặt nhầm sản phẩm hoặc số lượng" required>
                                <label class="form-check-label" for="order_reason1">Đặt nhầm sản phẩm hoặc số lượng</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="cancel_reason" id="order_reason2" value="Không còn nhu cầu sử dụng sản phẩm">
                                <label class="form-check-label" for="order_reason2">Không còn nhu cầu sử dụng sản phẩm</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="cancel_reason" id="order_reason3" value="Tìm thấy sản phẩm tương tự với giá tốt hơn">
                                <label class="form-check-label" for="order_reason3">Tìm thấy sản phẩm tương tự với giá tốt hơn</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="cancel_reason" id="order_reason4" value="Thời gian giao hàng quá lâu">
                                <label class="form-check-label" for="order_reason4">Thời gian giao hàng quá lâu</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="cancel_reason" id="order_reason5" value="Thay đổi địa chỉ hoặc thông tin nhận hàng">
                                <label class="form-check-label" for="order_reason5">Thay đổi địa chỉ hoặc thông tin nhận hàng</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="cancel_reason" id="order_reasonOther" value="other">
                                <label class="form-check-label" for="order_reasonOther">Lý do khác (vui lòng ghi rõ)</label>
                            </div>
                            <textarea class="form-control mt-2 d-none" name="cancel_reason_other" id="order_cancelReasonOtherText" rows="2" placeholder="Nhập lý do khác..."></textarea>
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
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {

                const currentStatus = '{{ request('order_status', 'all') }}';
                const activeTab = document.querySelector(`.status-tab[data-status="${currentStatus}"]`);

                if (activeTab) {
                    activeTab.classList.add('active');
                }

                const cancelOrderModal = document.getElementById('cancelOrderModal');
                if (cancelOrderModal) {
                    const cancelOrderForm = document.getElementById('cancelOrderForm');
                    const reasonOtherRadio = document.getElementById('order_reasonOther');
                    const otherTextarea = document.getElementById('order_cancelReasonOtherText');
                    
                    // Cập nhật action của form khi modal được mở
                    cancelOrderModal.addEventListener('show.bs.modal', function (event) {
                        const button = event.relatedTarget;
                        const orderId = button.getAttribute('data-order-id');
                        // Cập nhật action của form
                        const actionUrl = "{{ route('client.profile.my_account.order.cancel', ['id' => ':id']) }}".replace(':id', orderId);
                        cancelOrderForm.setAttribute('action', actionUrl);
                        
                        // Reset form khi mở modal
                        cancelOrderForm.reset();
                        otherTextarea.classList.add('d-none');
                        otherTextarea.required = false;
                    });

                    // Xử lý hiện/ẩn textarea cho "Lý do khác"
                    const radios = cancelOrderForm.querySelectorAll('input[name="cancel_reason"]');
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

                    // Validate khi submit
                    cancelOrderForm.addEventListener('submit', function(e) {
                        if (reasonOtherRadio.checked && !otherTextarea.value.trim()) {
                            alert('Vui lòng nhập lý do hủy đơn hàng.');
                            otherTextarea.focus();
                            e.preventDefault();
                        }
                    });
                }
            });
        </script>
        <script>
document.addEventListener('DOMContentLoaded', function() {
    @php
        $repeatIds = session('repeat_ids') ? explode(',', session('repeat_ids')) : [];
    @endphp
    @if(!empty($repeatIds))
        const ids = @json($repeatIds);
        ids.forEach(id => {
            const checkbox = document.querySelector('.cart-item-checkbox[data-item-id="' + id + '"]');
            if (checkbox) checkbox.checked = true;
        });
        if (typeof updateSelectedTotal === 'function') updateSelectedTotal();
    @endif
});
</script>
    @endpush
@endsection
<style>
    .order-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .my-account-content.account-order {
        padding: 25px;
        background-color: #f7f7f7;
        /* Light grey background for the whole section */
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.03);
        /* Subtle shadow */
    }

    .order-history-header {
        margin-bottom: 25px;
        text-align: center;
    }

    .order-history-header h3 {
        font-size: 28px;
        color: #333;
        font-weight: 700;
        margin: 0;
    }

    /* Order Status Tabs */
    .order-status-tabs {
        display: flex;
        justify-content: flex-start;
        gap: 10px;
        /* Space between tabs */
        margin-bottom: 25px;
        padding: 10px;
        background-color: #fff;
        border-radius: 8px;
        overflow-x: auto;
        /* Allow horizontal scrolling on small screens */
        -webkit-overflow-scrolling: touch;
        white-space: nowrap;
        /* Prevent tabs from wrapping */
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        /* Adding scrollbar hide for aesthetics if possible */
        scrollbar-width: none;
        /* Firefox */
        -ms-overflow-style: none;
        /* IE and Edge */
    }

    .order-status-tabs::-webkit-scrollbar {
        display: none;
        /* Chrome, Safari, Opera */
    }


    .status-tab {
        display: inline-block;
        padding: 8px 15px;
        border-radius: 20px;
        /* Pill shape */
        text-decoration: none;
        color: #555;
        font-weight: 600;
        font-size: 14px;
        transition: all 0.2s ease-in-out;
        background-color: #f0f0f0;
        /* Default background for tabs */
        border: 1px solid #e0e0e0;
        flex-shrink: 0;
        /* Prevent tabs from shrinking too much */
    }

    .status-tab:hover {
        color: #ee4d2d;
        /* Shopee's red */
        background-color: #fff0ed;
        text-decoration: none;
        /* Thêm dòng này để bỏ gạch chân khi hover */
    }

    .status-tab.active {
        background-color: #ee4d2d;
        /* Shopee's red for active tab */
        color: #fff;
        border-color: #ee4d2d;
        box-shadow: 0 2px 5px rgba(238, 77, 45, 0.3);
    }

    /* Order List and Cards */
    .order-list {
        display: grid;
        gap: 15px;
        /* Space between order cards */
    }

    .order-card {
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        /* Ensures border-radius applies correctly to children */
        transition: all 0.2s ease-in-out;
        margin-bottom: 24px;
        /* Tạo khoảng cách giữa các đơn hàng */
    }

    .order-card:hover {
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.12);
    }

    .order-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 20px;
        border-bottom: 1px solid #eee;
        background-color: #fcfcfc;
        font-size: 14px;
        color: #555;
    }

    .order-shop-name {
        font-weight: 600;
        color: #333;
    }

    /* Order Status Badge in header */
    .order-status {
        font-size: 13px;
        font-weight: 600;
        padding: 4px 8px;
        border-radius: 4px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* Specific status colors */
    .status-pending,
    .status-processing,
    .status-shipping {
        
        color: #856404;
    }

    .status-completed {
        background-color: #d4edda;
        /* Green for completed */
        color: #155724;
    }

    .status-cancelled,
    .status-returned {
        background-color: #f8d7da;
        /* Reddish for cancelled/returned */
        color: #721c24;
    }

    /* Main content div that now combines body and footer */
    .order-details-content {
        padding: 15px 20px;
    }

    .order-item-preview {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 10px;
        /* Space between item and "more items" summary */
    }

    .product-thumbnail {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 4px;
        border: 1px solid #eee;
    }

    .product-info {
        flex-grow: 1;
    }

    .product-name {
        font-size: 15px;
        color: #333;
        font-weight: 500;
        margin-bottom: 4px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .product-quantity {
        font-size: 14px;
        color: #666;
    }

    .more-items-summary {
        text-align: right;
        font-size: 13px;
        color: #888;
        margin-top: 5px;
        /* Space above this text */
        padding-bottom: 15px;
        /* Space before the dashed line */
        border-bottom: 1px dashed #eee;
        /* Dashed line like Shopee */
    }


    /* New combined footer section within order-details-content */
    .order-summary-footer-combined {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        /* Align items to the bottom */
        padding-top: 15px;
        /* Padding above this section */
        background-color: #fcfcfc;
        /* Light background for the footer part */
        margin: 0 -20px -15px -20px;
        /* Adjust negative margin to fill the card width, offset padding */
        padding-left: 20px;
        padding-right: 20px;
        padding-bottom: 15px;
        border-bottom-left-radius: 8px;
        /* Maintain card border radius */
        border-bottom-right-radius: 8px;
        flex-wrap: wrap;
        /* Allow wrapping on small screens */
        row-gap: 10px;
        /* Space between rows when wrapping */
    }


    .order-summary-details {
        display: flex;
        flex-direction: column;
        gap: 5px;
        font-size: 14px;
        color: #666;
        margin-right: 15px;
        /* Space between summary and total */
    }

    .order-summary-details .order-date-and-id {
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 100%;
        margin-bottom: 8px;
        padding-bottom: 6px;
        border-bottom: 1px dashed #eee;
    }

    .order-id {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 16px;
        font-weight: 600;
        color: #333;
        flex-shrink: 0;
    }

    .order-date {
        font-size: 16px;
        font-weight: 600;
        color: #333;
        white-space: nowrap;
        margin-left: auto;
        /* đẩy sang phải */
        text-align: right;
    }


    .order-payment-status .payment-status {
        font-weight: 600;
    }

    .status-paid {
        color: #28a745;
        /* Green for paid */
    }

    .status-pending {
        color: #ffc107;
        /* Yellow for pending */
    }

    .status-failed {
        color: #dc3545;
        /* Red for failed */
    }

    .status-refunded {
        color: #007bff;
        /* Blue for refunded */
    }

    .order-date {
        font-size: 13px;
        color: #888;
    }

    .order-total-amount {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        /* Align "Tổng tiền" and amount to the right */
        margin-left: auto;
        /* Push to the right before actions */
    }

    .order-total-amount p {
        font-size: 14px;
        color: #666;
        margin-bottom: 5px;
    }

    .order-total-amount .amount {
        font-size: 17px !important;
        color: #ee4d2d;
        /* Shopee's red */
        font-weight: 700;
    }

    .order-actions {
        display: flex;
        gap: 10px;
        margin-top: 10px;
        /* Space above buttons when wrapping */
        justify-content: flex-end;
        /* Align buttons to the right */
        width: 100%;
        /* Take full width on small screens for alignment */
    }

    /* Your existing tf-btn styles should be here or imported */
    .tf-btn {
        padding: 8px 18px;
        font-size: 14px;
        border-radius: 4px;
        cursor: pointer;
        text-align: center;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease-in-out;
        white-space: nowrap;
        /* Prevent button text from wrapping */
    }

    /* Main action button */
    .btn-view-details {
        background-color: #ee4d2d !important;
        color: #fff !important;
        border: 1px solid #ee4d2d !important;
        opacity: 1 !important;
        pointer-events: auto !important;
        visibility: visible !important;
    }


    /* Secondary action buttons */
    .btn-action-secondary {
        background-color: #fff;
        color: #555;
        border: 1px solid #ddd;
    }

    .btn-action-secondary:hover {
        background-color: #f0f0f0;
        color: #ee4d2d;
        border-color: #ee4d2d;
    }



    /* No orders message */
    .no-orders-message {
        text-align: center;
        padding: 30px;
        font-size: 16px;
        color: #777;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.08);
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .order-status-tabs {
            justify-content: flex-start;
            /* Keep scrollable on small screens */
            padding: 10px;
        }

        .status-tab {
            font-size: 13px;
            padding: 7px 12px;
        }

        .order-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 5px;
        }

        .order-shop-name {
            width: 100%;
            /* Take full width */
        }

        .order-status {
            align-self: flex-end;
            /* Push status to the right */
            margin-top: -20px;
            /* Pull it up to sit beside shop name */
        }

        .order-details-content {
            padding: 15px;
            /* Adjust padding for smaller screens */
        }

        .order-summary-footer-combined {
            flex-direction: column;
            align-items: center;
            gap: 10px;
            margin: 0 -15px -15px -15px;
            /* Adjust negative margin */
            padding-left: 15px;
            padding-right: 15px;
            padding-bottom: 15px;
        }

        .order-summary-details {
            width: 100%;
            text-align: center;
            margin-right: 0;
        }

        .order-total-amount {
            width: 100%;
            align-items: center;
            margin-left: 0;
        }

        .order-actions {
            width: 100%;
            justify-content: center;
            flex-wrap: wrap;
            /* Allow buttons to wrap */
        }

        .tf-btn {
            flex-grow: 1;
            /* Allow buttons to grow and fill space */
            min-width: unset;
            /* Remove min-width to allow shrinking */
        }
    }

    @media (max-width: 480px) {
        .my-account-content.account-order {
            padding: 15px;
        }

        .order-history-header h3 {
            font-size: 24px;
        }

        .order-card {
            margin-bottom: 10px;
        }

        .product-thumbnail {
            width: 50px;
            height: 50px;
        }

        .product-name {
            font-size: 14px;
        }

        .product-quantity,
        .more-items-summary {
            font-size: 12px;
        }

        .order-total-amount .amount {
            font-size: 18px;
        }
    }

    .order-status-title {
        font-size: 18px;
        font-weight: bold;
        color: #ee4d2d;
        margin: 30px 0 10px 0;
        text-transform: uppercase;
    }
</style>
