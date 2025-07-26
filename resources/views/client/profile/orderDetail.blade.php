@extends('client.profile.profile_base')

@section('page_title', 'Chi tiết đơn hàng')

@section('content_profile')
    @php
        $statusMap = [
            'pending_confirmation' => 'Chờ xác nhận',
            'processing' => 'Đang xử lý',
            'shipped' => 'Đang giao',
            'delivered' => 'Đã giao',
            'cancelled' => 'Đã hủy',
            'returned' => 'Trả hàng/Hoàn tiền',
            'pending_cancellation' => 'Chờ xác nhận hủy đơn',
        ];
        // Chuẩn hóa key trạng thái (nếu trạng thái là tiếng Anh hoặc mã)
        $orderStatusKey = \Illuminate\Support\Str::slug($order->order_status ?? 'unknown_status', '_');
        $orderStatusVN = $statusMap[$orderStatusKey] ?? ($order->order_status ?? 'Trạng thái không xác định');
    @endphp
    <div class="container my-5">
        <div class="order-detail-card"> {{-- Added padding, rounded corners, and shadow --}}
            <div class="text-center mb-4">
                <h2 class="fw-bold text-uppercase mb-2"> {{-- Increased bottom margin for heading --}}
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
                                                    <a href="{{ route('client.product.show', ['slug' => $item->product->slug ?? '']) }}#product-reviews" class="btn btn-outline-primary">
                                                        <i class="bi bi-star-fill me-1"></i>Đánh giá
                                                    </a>
                                                   
                                                </div>
                                            </div>
                                        @endif
                                        @if ($order->order_status === 'cancelled' && $order->items && count($order->items) > 0)
                                            <a href="{{ route('client.product.show', ['slug' => $order->items[0]->product->slug ?? '']) }}"
                                                class="btn btn-primary btn-repeat-order" data-order-id="{{ $order->id }}">
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
    }

    @media (max-width: 575.98px) {
        .product-card-variant {
            /* Hide variant on very small screens if space is tight */
            display: none;
        }
    }
</style>

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
                                product_variant_id: item.product_variant_id,
                                quantity: item.quantity
                            })
                        }).then(res => res.json());
                    });
                    Promise.all(addPromises).then(results => {
                        // Lấy danh sách key sản phẩm vừa thêm để truyền sang cart
                        const keys = items.map(i => i.product_id + '_' + (i.product_variant_id ?? 'null'));
                        window.location.href = '/cart?repeat_ids=' + encodeURIComponent(keys.join(','));
                    });
                });
        });
    });
});
</script>
