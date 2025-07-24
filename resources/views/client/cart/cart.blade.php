@extends('client.layout.client')

@section('title', 'Trang chủ')
<link rel="stylesheet" href="{{ asset('css/cart.css') }}">

<style>
    .delete-selected-btn {
        background: #ff3029 !important;
        color: #fff !important;
        border: none !important;
        font-weight: bold !important;
        padding: 12px 28px !important;
        display: none !important;
        transition: all 0.3s ease !important;
    }

    .delete-selected-btn:hover {
        background: #e02a23 !important;
        transform: translateY(-1px) !important;
    }

    .total-value.selected {
        color: #ff3029 !important;
        font-weight: bold !important;
    }

    .cart-meta-variant {
        margin-top: 8px !important;
    }

    .cart-variant-select {
        border: none !important;
        background: transparent !important;
        font-size: 15px !important;
        color: #666 !important;
        font-weight: 400 !important;
        margin-left: 4px !important;
        cursor: pointer !important;
        appearance: none !important;
        outline: none !important;
        padding-right: 18px !important;
    }

    .cart-variant-select:focus {
        border: 1px solid #ff3029 !important;
        border-radius: 4px !important;
        padding: 2px 4px !important;
    }

    .cart-title.link:hover {
        text-decoration: none;
        color: #ff3029;
    }
</style>

@section('content')

    @php
        // Không còn 4 bước, chỉ cần 2 bước: giỏ hàng -> checkout
        $steps = [['label' => 'Giỏ hàng', 'key' => 'cart'], ['label' => 'Thanh toán', 'key' => 'checkout']];
        $currentStep = 'cart';
    @endphp

    <div class="tf-page-title">
        <div class="container-full">
            <div class="heading text-center">@yield('page_title', 'Giỏ Hàng')</div>
        </div>
    </div>

    <div style="max-width: 66vw; margin: 60px auto 0 auto; padding: 0 16px;">
        <div class="cart-checkout-progress"
            style="background: #fff; padding: 32px 16px 24px 16px; border-radius: 10px; margin-bottom: 16px;">
            <div style="display: flex; align-items: flex-start; justify-content: space-between;">
                @foreach ($steps as $index => $stepItem)
                    @php
                        $isActive = false;
                        if ($currentStep === 'cart' && $stepItem['key'] === 'cart') {
                            $isActive = true;
                        }
                        if ($currentStep === 'checkout' && in_array($stepItem['key'], ['cart', 'checkout'])) {
                            $isActive = true;
                        }
                        if ($currentStep === 'invoice') {
                            $isActive = true;
                        }
                    @endphp
                    <div style="flex:1; text-align: center; {{ $isActive ? '' : 'opacity:0.4;' }}">
                        <div style="position: relative; display: flex; flex-direction: column; align-items: center;">
                            <div
                                style="width: 48px; height: 48px; background:{{ $isActive ? 'rgb(255, 48, 41)' : '#fc9999' }}; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-bottom: 8px; position: relative; z-index: 2;">
                                <svg width="28" height="28" viewBox="0 0 24 24" fill="none">
                                    <path d="M6 13l4 4 8-8" stroke="{{ $isActive ? '#fff' : '#BDBDBD' }}" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                            <div
                                style="height: 4px; width: 100%; background:{{ $isActive ? 'rgb(255, 48, 41)' : '#fc9999' }}; position: absolute; top: 24px; left: 48px; right: -50%; z-index: 1;">
                            </div>
                        </div>
                        <div style="font-weight: bold; color: {{ $isActive ? '#232323' : '#676363' }}; margin-top: 8px;">
                            {{ $stepItem['label'] }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- page-cart -->
    <section class="flat-spacing-11">
        <div class="container1">
            <div class="tf-page-cart-wrap">
                <div class="tf-page-cart-item">
                    <form>
                        <table class="tf-table-page-cart cart-table-fixed">
                            <thead>
                                <tr>
                                    <th style="width: 36px; padding-right: 4px;">
                                        <input type="checkbox" id="select-all-checkbox" />
                                    </th>
                                    <th class="cart-img-col" style="width: 90px;">Sản phẩm</th>
                                    <th class="cart-info-col"></th>
                                    <th class="cart-price-col">Đơn giá</th>
                                    <th class="cart-qty-col">Số lượng</th>
                                    <th class="cart-total-col">Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($cartItems as $cartItem)
                                    <tr class="tf-cart-item file-delete">
                                        <td class="tf-cart-item_checkbox"
                                            style="width: 36px; padding-right: 4px; vertical-align: middle;">
                                            <input type="checkbox" class="cart-item-checkbox"
                                                data-item-id="{{ $cartItem['id'] }}">
                                        </td>
                                        <td class="cart-img-col" style="width: 90px; vertical-align: middle;">
                                            <div style="position: relative; width: 80px; height: 80px;">
                                                {{-- Nút xóa góc trái trên --}}
                                                <button type="button" class="remove-cart-x"
                                                    data-item-id="{{ $cartItem['id'] }}"
                                                    style="position: absolute; top: -15px; left: -15px; background: rgba(180, 117, 115, 0.9); border: none; color: #fff; font-size: 18px; width: 24px; height: 24px; border-radius: 50%; cursor: pointer; z-index: 2; display: flex; align-items: center; justify-content: center; line-height: 1;">
                                                    &times;
                                                </button>
                                                {{-- <a href="{{ route('client.product.show', $cartItem['product']['slug'] ?? $cartItem['product_id']) }}" class="img-box">
                                                    <img src="{{ asset($cartItem['product']['images'][0]['image_url'] ?? 'images/products/no-image.png') }}" alt="Ảnh sản phẩm" width="80">   --}}
                                                {{-- Hiển thị ảnh của biến thể nếu có --}}
                                                @if (!empty($cartItem['variant']['image']['image_url']))
                                                    <img src="{{ asset($cartItem['variant']['image']['image_url']) }}"
                                                        alt="Biến thể"
                                                        style="object-fit: cover; border-radius: 6px; margin-bottom: 6px; width: 80px">
                                                @endif
                                            </div>
                                        </td>
                                        <td class="cart-info-col" style="vertical-align: middle;">
                                            <div class="cart-info">
                                                <div class="cart-info-col" style="flex: 2;">
                                                    <div class="cart-title-wrap">
                                                        <a href="{{ route('client.product.show', $cartItem['product']['slug'] ?? $cartItem['product_id']) }}"
                                                            class="cart-title link">
                                                            {{ $cartItem['product']['name'] ?? 'Sản phẩm đã xóa' }}
                                                        </a>
                                                    </div>
                                                    <div class="cart-meta-variant"
                                                        style="font-size: 13px; color: #b0b0b0; font-style: italic; margin-top: 4px;">
                                                        {{-- Hiển thị các thuộc tính động --}}
                                                        @if (!empty($cartItem['variant_attributes']))
                                                            @foreach ($cartItem['variant_attributes'] as $attr)
                                                                <div>{{ $attr }}</div>
                                                            @endforeach
                                                        @endif

                                                        {{-- Hiển thị size nếu có --}}
                                                        @if (!empty($cartItem['variant']['size']))
                                                            <div>Kích thước: {{ $cartItem['variant']['size'] }}</div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="cart-price-col" style="text-align: right; vertical-align: middle;">
                                            <div class="cart-price">
                                                {{ number_format($cartItem['price_at_addition'], 0, ',', '.') }}đ</div>
                                        </td>
                                        <td class="cart-qty-col" style="text-align: center; vertical-align: middle;">
                                            <div class="cart-quantity">
                                                <div class="wg-quantity">
                                                    <span class="btn-quantity minus-btn"
                                                        data-item-id="{{ $cartItem['id'] }}">-</span>
                                                    <input type="text" class="cart-qty-input"
                                                        data-item-id="{{ $cartItem['id'] }}"
                                                        value="{{ $cartItem['quantity'] }}" min="1"
                                                        data-max="{{ $cartItem['variant']['stock_quantity'] ?? ($cartItem['product']['stock_quantity'] ?? 9999) }}">
                                                    <span class="btn-quantity plus-btn"
                                                        data-item-id="{{ $cartItem['id'] }}">+</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="cart-total-col" style="text-align: right; vertical-align: middle;">
                                            <div class="cart-total">
                                                {{ number_format($cartItem['quantity'] * $cartItem['price_at_addition'], 0, ',', '.') }}đ
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Giỏ hàng của bạn đang trống.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="cart-action-buttons"
                            style="display: flex; justify-content: space-between; align-items: center; margin-top: 18px; gap: 10px;">
                            <div class="left-actions">
                                <a href="{{ route('shop') }}" class="tf-btn"
                                    style="background: #232323; color: #fff; font-weight: bold; border: none; display: flex; align-items: center; padding: 12px 28px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                                        viewBox="0 0 20 20" style="margin-right: 8px;">
                                        <path d="M12.5 15l-5-5 5-5" stroke="#fff" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                    Tiếp tục mua sắm
                                </a>
                            </div>
                            <div class="right-actions" style="display: flex; gap: 10px;">
                                <button type="button" class="tf-btn delete-selected-btn" id="delete-selected-btn"
                                    style="background: #ff3029; color: #fff; border: none; font-weight: bold; padding: 12px 28px; display: none;">Xóa
                                    sản phẩm đã chọn</button>
                                <button type="button" class="tf-btn" id="clear-cart-btn"
                                    style="background: #fff; color: #232323; border: 1px solid #232323; font-weight: bold; padding: 12px 28px;">Xóa
                                    giỏ hàng</button>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="tf-page-cart-footer">
                    <div class="tf-cart-footer-inner">
                        <div class="tf-free-shipping-bar">
                            <div class="tf-progress-bar">
                                <span style="width: 50%;">
                                    <div class="progress-car">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="21" height="14"
                                            viewBox="0 0 21 14" fill="currentColor">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M0 0.875C0 0.391751 0.391751 0 0.875 0H13.5625C14.0457 0 14.4375 0.391751 14.4375 0.875V3.0625H17.3125C17.5867 3.0625 17.845 3.19101 18.0104 3.40969L20.8229 7.12844C20.9378 7.2804 21 7.46572 21 7.65625V11.375C21 11.8582 20.6082 12.25 20.125 12.25H17.7881C17.4278 13.2695 16.4554 14 15.3125 14C14.1696 14 13.1972 13.2695 12.8369 12.25H7.72563C7.36527 13.2695 6.39293 14 5.25 14C4.10706 14 3.13473 13.2695 2.77437 12.25H0.875C0.391751 12.25 0 11.8582 0 11.375V0.875ZM2.77437 10.5C3.13473 9.48047 4.10706 8.75 5.25 8.75C6.39293 8.75 7.36527 9.48046 7.72563 10.5H12.6875V1.75H1.75V10.5H2.77437ZM14.4375 8.89937V4.8125H16.8772L19.25 7.94987V10.5H17.7881C17.4278 9.48046 16.4554 8.75 15.3125 8.75C15.0057 8.75 14.7112 8.80264 14.4375 8.89937ZM5.25 10.5C4.76676 10.5 4.375 10.8918 4.375 11.375C4.375 11.8582 4.76676 12.25 5.25 12.25C5.73323 12.25 6.125 11.8582 6.125 11.375C6.125 10.8918 5.73323 10.5 5.25 10.5ZM15.3125 10.5C14.8293 10.5 14.4375 10.8918 14.4375 11.375C14.4375 11.8582 14.8293 12.25 15.3125 12.25C15.7957 12.25 16.1875 11.8582 16.1875 11.375C16.1875 10.8918 15.7957 10.5 15.3125 10.5Z">
                                            </path>
                                        </svg>
                                    </div>
                                </span>
                            </div>

                        </div>
                        <div class="tf-page-cart-checkout">


                            <div class="tf-cart-coupon" style="margin-top: 24px;">
                                <div class="body-title mb-2">Mã giảm giá</div>
                                <div class="tf-coupon-field d-flex gap-2">
                                    <input type="text" id="discount_code" placeholder="Nhập mã giảm giá"
                                        style="height: 48px; border-radius: 6px; border: 1px solid #ddd; padding: 0 12px;">
                                    <button type="button" id="apply_discount"
                                        class="tf-btn btn-sm btn-fill animate-hover-btn"
                                        style="height: 48px; padding: 0 24px; border-radius: 6px;">Áp dụng</button>
                                </div>
                                <div id="discount_message" style="margin-top: 8px; display: none;"></div>
                            </div>

                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const applyDiscountBtn = document.getElementById('apply_discount');
                                    const discountCodeInput = document.getElementById('discount_code');

                                    applyDiscountBtn.addEventListener('click', function() {
                                        const discountCode = discountCodeInput.value;
                                        if (discountCode) {
                                            applyDiscount(discountCode);
                                        }
                                    });
                                });

                                // Thêm định nghĩa hàm applyDiscount ở đây
                                function applyDiscount(discountCode) {
                                    fetch('/cart/apply-discount', {
                                            method: 'POST',
                                            headers: {
                                                'Content-Type': 'application/json',
                                                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                                            },
                                            body: JSON.stringify({
                                                discount_code: discountCode
                                            })
                                        })
                                        .then(response => response.json())
                                        .then(data => {
                                            const messageDiv = document.getElementById('discount_message');
                                            const totalValue = document.querySelector('.total-value');
                                            const grandTotalValue = document.querySelector('.grand-total-value');
                                            const discountValue = document.querySelector('.discount-value');

                                            messageDiv.style.display = 'block';
                                            if (data.success) {
                                                messageDiv.textContent = data.message;
                                                messageDiv.style.color = 'green';

                                                // Cập nhật tổng tiền hàng (nếu cần)
                                                if (data.new_total !== undefined) {
                                                    totalValue.textContent = data.new_total.toLocaleString('vi-VN') + 'đ';
                                                }

                                                // Cập nhật giá trị giảm giá
                                                discountValue.textContent = '-' + data.discount.toLocaleString('vi-VN') + 'đ';

                                                // Cập nhật tổng cộng (tạm thời giữ nguyên, có thể cần điều chỉnh nếu có phí ship)
                                                let currentTotal = parseFloat(totalValue.textContent.replace(/[^\d]/g, '')) || 0;
                                                grandTotalValue.textContent = (currentTotal - data.discount).toLocaleString('vi-VN') + 'đ';

                                            } else {
                                                messageDiv.textContent = data.message;
                                                messageDiv.style.color = 'red';
                                                // Ẩn thông tin giảm giá nếu không thành công
                                                discountValue.textContent = '-0đ';

                                                // Khôi phục lại tổng ban đầu
                                                let originalTotal = <?php echo e($total); ?>;
                                                totalValue.textContent = originalTotal.toLocaleString('vi-VN') + 'đ';
                                                grandTotalValue.textContent = originalTotal.toLocaleString('vi-VN') + 'đ';
                                            }
                                            // Tự động ẩn thông báo sau 5 giây
                                            setTimeout(() => {
                                                messageDiv.style.display = 'none';
                                            }, 5000);
                                        })
                                        .catch(error => {
                                            const messageDiv = document.getElementById('discount_message');
                                            messageDiv.style.display = 'block';
                                            messageDiv.textContent = 'Có lỗi xảy ra khi áp dụng mã giảm giá!';
                                            messageDiv.style.color = 'red';
                                            // Ẩn thông tin giảm giá nếu có lỗi
                                            const discountValue = document.querySelector('.discount-value');
                                            discountValue.textContent = '-0đ';

                                            setTimeout(() => {
                                                messageDiv.style.display = 'none';
                                            }, 5000);
                                        });
                                }
                            </script>

                            <div style="font-family: 'Inter', Arial, Helvetica, sans-serif;">
                                <div class="tf-cart-totals-discounts">
                                    <h3 style="font-weight: 600; font-size: 18px;">Tổng tiền hàng</h3>
                                    <span class="total-value"
                                        style="font-size: 18px;">{{ number_format($total, 0, ',', '.') }}đ</span>
                                </div>

                                <div class="tf-cart-discount-fee" style="margin-top: 24px;">
                                    <div
                                        style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 4px;">
                                        <span>Giảm giá</span>
                                       <span class="discount-value">-{{ number_format($discount ?? 0, 0, ',', '.') }}đ</span>
                                    </div>


                                    <div
                                        style="display: flex; justify-content: space-between; align-items: center; font-weight: bold; font-size: 18px; color: #ff3029;">
                                        <span>Tổng cộng</span>
                                        <span class="grand-total-value">
                                            {{ number_format($total - ($discount ?? 0) + ($shipping_fee ?? 0), 0, ',', '.') }}đ
                                        </span>
                                    </div>
                                </div>

                                <div class="cart-checkout-btn" style="margin-top: 18px;">
                                    <a href="{{ route('client.checkout.index') }}" id="checkout-btn"
                                        class="tf-btn w-100 btn-fill animate-hover-btn radius-3 justify-content-center {{ empty($cartItems) ? 'disabled' : '' }}"
                                        style="{{ empty($cartItems) ? 'pointer-events: none; opacity: 0.5;' : '' }}">
                                        <span>Đặt hàng</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- product -->
    <div class="all-box-new-product" style="display: flex; flex-wrap: wrap; gap: 37px; padding: 0px 15px">
        @php
            $wishlistProductIds = [];
            if (Auth::check() && Auth::user()->wishlist) {
                $wishlistProductIds = Auth::user()->wishlist->items->pluck('product_id')->toArray();
            }
        @endphp
        @foreach ($newestProducts as $product)
            <div class="new-product-1">
                <div class="pic-product-1">
                    <a href="{{ route('client.product.show', $product->slug) }}">
                        <img src="{{ $product->images->first() ? asset($product->images->first()->image_url) : asset('images/no-image.png') }}"
                            alt="{{ $product->name }}"
                            onmouseover="this.src='{{ $product->images->get(1) ? asset($product->images->get(1)->image_url) : asset($product->images->first() ? $product->images->first()->image_url : 'images/no-image.png') }}'"
                            onmouseout="this.src='{{ $product->images->first() ? asset($product->images->first()->image_url) : asset('images/no-image.png') }}'">
                    </a>
                    <div class="box-icon-new-product">
                        <a href="{{ route('client.product.show', $product->slug) }}"><i style="font-size: 19px;"
                                id="search-Product" class="fa-solid fa-magnifying-glass"></i></a>
                        <button class="wishlist-btn" data-product-id="{{ $product->id }}"
                            style="background:none;border:none;padding:0;cursor:pointer;">
                            <i style="font-size: 18px; color:{{ in_array($product->id, $wishlistProductIds) ? 'red' : '#545353' }};"
                                class="fa-solid fa-heart" id="heart-Product"></i>
                        </button>
                        <i style="font-size: 18px;" id="cart-Product" class="fa-solid fa-cart-shopping"></i>
                    </div>
                </div>
                <div class="box-star" style="width: 100%; height: 23px;">
                    @php
                        $avg = round($product->reviews->avg('rating'), 1);
                        $count = $product->reviews->count();
                    @endphp
                    @for ($i = 1; $i <= 5; $i++)
                        @if ($i <= floor($avg))
                            <i style="color: #fcad02; margin-left: 0;" class="fa-solid fa-star"></i>
                        @elseif($i - $avg < 1 && $avg - floor($avg) >= 0.5)
                            <i style="color: #fcad02; margin-left: 0;" class="fa-solid fa-star-half-stroke"></i>
                        @else
                            <i style="color: #ccc; margin-left: 0;" class="fa-solid fa-star"></i>
                        @endif
                    @endfor
                    <span style="margin-left: 5px; color: rgb(201, 201, 201); font-size: 12px;">
                        ({{ $count }} review{{ $count != 1 ? 's' : '' }})
                    </span>
                </div>
                <div class="title-new-product">
                    <a href="{{ route('client.product.show', $product->slug) }}">{{ $product->name }}</a>
                </div>
                @php
                    $totalStock = $product->variants->sum('stock_quantity');
                @endphp
                <div style="font-size: 16px; color: rgb(170, 167, 167);">
                    @if ($product->variants->count() > 0 && $totalStock <= 0)
                        <span style="color:red;font-weight:bold;">Hết hàng</span>
                    @else
                        {{ number_format($product->regular_price, 0, ',', '.') }} đ
                    @endif
                </div>
            </div>
        @endforeach
    </div>

@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // --- Biến DOM chính ---
            const selectAllCheckbox = document.getElementById('select-all-checkbox');
            const itemCheckboxes = document.querySelectorAll('.cart-item-checkbox');
            const deleteSelectedBtn = document.getElementById('delete-selected-btn');
            const clearCartBtn = document.getElementById('clear-cart-btn');
            const agreeCheckbox = document.getElementById('check-agree');
            const checkoutBtn = document.querySelector('.cart-checkout-btn a');
            const checkoutDiv = document.querySelector('.cart-checkout-btn');

            // --- Chọn tất cả / bỏ chọn tất cả ---
            if (selectAllCheckbox) {
                selectAllCheckbox.addEventListener('change', function() {
                    const isChecked = this.checked;
                    itemCheckboxes.forEach(function(checkbox) {
                        checkbox.checked = isChecked;
                    });
                    updateSelectedTotal();
                });
            }

            // --- Cập nhật tổng tiền và hiển thị nút xóa đã chọn ---
            function updateSelectedTotal() {
                const selectedItems = document.querySelectorAll('.cart-item-checkbox:checked');
                let selectedTotal = 0;
                selectedItems.forEach(function(checkbox) {
                    const row = checkbox.closest('tr');
                    const totalElement = row.querySelector('.cart-total');
                    const totalText = totalElement.textContent;
                    const total = parseInt(totalText.replace(/[^\d]/g, '')) || 0;
                    selectedTotal += total;
                });
                const totalValueElement = document.querySelector('.total-value');
                if (totalValueElement) {
                    if (selectedItems.length === 0) {
                        totalValueElement.textContent = '0đ';
                        totalValueElement.style.color = '#ff3029';
                        const cartTotalsElement = document.querySelector('.tf-cart-totals-discounts h3');
                        if (cartTotalsElement) cartTotalsElement.textContent = 'Tổng tiền hàng';
                        const grandTotalElement = document.querySelector('.grand-total-value');
                        if (grandTotalElement) grandTotalElement.textContent = '0đ';
                    } else {
                        totalValueElement.textContent = selectedTotal.toLocaleString('vi-VN') + 'đ';
                        totalValueElement.style.color = '#ff3029';
                        const cartTotalsElement = document.querySelector('.tf-cart-totals-discounts h3');
                        if (cartTotalsElement) {
                            cartTotalsElement.textContent = `Tổng tiền hàng (${selectedItems.length} sản phẩm)`;
                        }
                        const discount = 0;
                        const shippingFee = 0;
                        const grandTotalElement = document.querySelector('.grand-total-value');
                        if (grandTotalElement) {
                            grandTotalElement.textContent = (selectedTotal - discount + shippingFee).toLocaleString(
                                'vi-VN') + 'đ';
                        }
                    }
                }
                if (deleteSelectedBtn) {
                    if (selectedItems.length > 0) {
                        deleteSelectedBtn.style.display = 'block';
                        deleteSelectedBtn.textContent = `Xóa ${selectedItems.length} sản phẩm đã chọn`;
                    } else {
                        deleteSelectedBtn.style.display = 'none';
                        const cartTotalsElement = document.querySelector('.tf-cart-totals-discounts h3');
                        if (cartTotalsElement) cartTotalsElement.textContent = 'Tổng tiền hàng';
                    }
                }
            }
            // Gắn sự kiện change cho từng checkbox sản phẩm
            itemCheckboxes.forEach(function(checkbox) {
                checkbox.addEventListener('change', updateSelectedTotal);
            });

            // --- Xóa nhiều sản phẩm đã chọn ---
            if (deleteSelectedBtn) {
                deleteSelectedBtn.addEventListener('click', function() {
                    const selectedItems = document.querySelectorAll('.cart-item-checkbox:checked');
                    if (selectedItems.length === 0) {
                        alert('Vui lòng chọn sản phẩm cần xóa!');
                        return;
                    }
                    if (!confirm(`Bạn có chắc muốn xóa ${selectedItems.length} sản phẩm đã chọn?`)) return;
                    const deletePromises = [];
                    selectedItems.forEach(function(checkbox) {
                        const itemId = checkbox.dataset.itemId;
                        const deletePromise = fetch("/cart/remove", {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Accept': 'application/json'
                                },
                                body: JSON.stringify({
                                    item_id: itemId
                                })
                            }).then(response => response.json())
                            .then(data => {
                                if (data && data.success) {
                                    const row = checkbox.closest('tr');
                                    if (row) row.parentNode.removeChild(row);
                                    if (typeof data.cartCount !== 'undefined')
                                        updateCartCountBadge(data.cartCount);
                                    return {
                                        success: true
                                    };
                                } else {
                                    return {
                                        success: false
                                    };
                                }
                            }).catch(() => ({
                                success: false
                            }));
                        deletePromises.push(deletePromise);
                    });
                    Promise.all(deletePromises).then((results) => {
                        const failedCount = results.filter(r => !r.success).length;
                        updateSelectedTotal();
                        if (failedCount > 0) alert(
                            `${failedCount} sản phẩm xóa thất bại. Vui lòng thử lại!`);
                    });
                });
            }

            // --- Tăng/giảm số lượng ---
            document.querySelectorAll('.btn-quantity').forEach(function(btn) {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    const input = this.closest('.wg-quantity').querySelector('.cart-qty-input');
                    if (!input) return;
                    let val = parseInt(input.value) || 1;
                    const max = parseInt(input.getAttribute('data-max')) || 9999;
                    if (this.classList.contains('plus-btn')) {
                        if (val < max) {
                            val += 1;
                            input.value = val;
                            updateCart(input);
                        }
                        if (val >= max) this.setAttribute('disabled', 'disabled');
                    } else if (this.classList.contains('minus-btn')) {
                        if (val > 1) {
                            val -= 1;
                            input.value = val;
                            updateCart(input);
                        }
                        const plusBtn = this.parentNode.querySelector('.plus-btn');
                        if (plusBtn) plusBtn.removeAttribute('disabled');
                    }
                });
            });
            // Sự kiện change cho input số lượng (gộp lại, chỉ 1 lần)
            document.querySelectorAll('.cart-qty-input').forEach(function(input) {
                input.addEventListener('change', function() {
                    let quantity = parseInt(this.value) || 1;
                    const max = parseInt(this.getAttribute('data-max')) || 9999;
                    if (quantity < 1) quantity = 1;
                    if (quantity > max) quantity = max;
                    this.value = quantity;
                    updateCart(this);
                    // Disable/enable nút +
                    const plusBtn = this.parentNode.querySelector('.plus-btn');
                    if (plusBtn) {
                        if (quantity >= max) plusBtn.setAttribute('disabled', 'disabled');
                        else plusBtn.removeAttribute('disabled');
                    }
                });
                // Khởi tạo trạng thái nút + khi load trang
                const max = parseInt(input.getAttribute('data-max')) || 9999;
                const plusBtn = input.parentNode.querySelector('.plus-btn');
                if (plusBtn) {
                    if (parseInt(input.value) >= max) plusBtn.setAttribute('disabled', 'disabled');
                    else plusBtn.removeAttribute('disabled');
                }
            });

            // --- Hàm cập nhật giỏ hàng (gọi API) ---
            function updateCart(input) {
                const itemId = input.dataset.itemId;
                const quantity = parseInt(input.value);
                input.disabled = true;
                const row = input.closest('tr');
                const priceElement = row.querySelector('.cart-price');
                const totalElement = row.querySelector('.cart-total');
                let priceText = priceElement.textContent;
                let price = parseInt(priceText.replace(/[^\d]/g, '')) || 0;
                const total = price * quantity;
                totalElement.textContent = total.toLocaleString('vi-VN') + 'đ';
                updateSelectedTotal();
                updateCartOnServer(itemId, quantity, input);
            }

            function updateCartOnServer(itemId, quantity, input) {
                fetch("/cart/update", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': "{{ csrf_token() }}",
                            'Accept': 'application/json',
                            'X-HTTP-Method-Override': 'PUT'
                        },
                        body: JSON.stringify({
                            item_id: itemId,
                            quantity: quantity
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data && data.success) {
                            // Không reload trang nữa
                        }
                    })
                    .catch(() => {})
                    .finally(() => {
                        if (input) input.disabled = false;
                    });
            }

            // --- Xóa từng sản phẩm ---
            document.querySelectorAll('.remove-cart-x').forEach(function(btn) {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    const itemId = this.dataset.itemId;
                    if (!confirm('Bạn có chắc muốn xóa sản phẩm này khỏi giỏ hàng?')) return;
                    fetch("/cart/remove", {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({
                                item_id: itemId
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data && data.success) {
                                const row = btn.closest('tr');
                                if (row) row.parentNode.removeChild(row);
                                updateSelectedTotal();
                                if (typeof data.cartCount !== 'undefined') updateCartCountBadge(
                                    data.cartCount);
                            } else {
                                alert(data.message || 'Xóa sản phẩm thất bại!');
                            }
                        })
                        .catch(() => {
                            alert('Có lỗi khi kết nối máy chủ!');
                        });
                });
            });

            // --- Xóa toàn bộ giỏ hàng ---
            if (clearCartBtn) {
                clearCartBtn.addEventListener('click', function() {
                    if (!confirm('Bạn có chắc muốn xóa tất cả sản phẩm trong giỏ hàng?')) return;
                    fetch("/cart/clear", {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data && data.success) {
                                document.querySelectorAll('.tf-cart-item').forEach(row => row.parentNode
                                    .removeChild(row));
                                document.querySelector('.total-value').textContent = '0đ';
                                document.querySelector('.grand-total-value').textContent = '0đ';
                                if (deleteSelectedBtn) deleteSelectedBtn.style.display = 'none';
                                if (selectAllCheckbox) selectAllCheckbox.checked = false;
                                if (typeof data.cartCount !== 'undefined') updateCartCountBadge(data
                                    .cartCount);
                                alert('Đã xóa tất cả sản phẩm trong giỏ hàng!');
                            } else {
                                alert(data.message || 'Xóa giỏ hàng thất bại!');
                            }
                        })
                        .catch(() => {
                            alert('Có lỗi khi kết nối máy chủ!');
                        });
                });
            }

            // --- Cập nhật badge số lượng giỏ hàng ---
            function updateCartCountBadge(newCount) {
                const badge = document.getElementById('cart-count-badge');
                if (badge) {
                    badge.textContent = newCount;
                    badge.style.display = newCount > 0 ? 'flex' : 'none';
                }
            }

            // Áp dụng mã giảm giá
            function applyDiscount(discountCode) {
                fetch('/cart/apply-discount', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                        },
                        body: JSON.stringify({
                            discount_code: discountCode
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        const messageDiv = document.getElementById('discount_message');
                        const totalValue = document.querySelector('.total-value');
                        const grandTotalValue = document.querySelector('.grand-total-value');
                        const discountValue = document.querySelector('.discount-value');

                        messageDiv.style.display = 'block';
                        if (data.success) {
                            messageDiv.textContent = data.message;
                            messageDiv.style.color = 'green';

                            // Cập nhật tổng tiền hàng (nếu cần)
                            if (data.new_total !== undefined) {
                                totalValue.textContent = data.new_total.toLocaleString('vi-VN') + 'đ';
                            }

                            // Cập nhật giá trị giảm giá
                            discountValue.textContent = '-' + data.discount.toLocaleString('vi-VN') + 'đ';

                            // Cập nhật tổng cộng (tạm thời giữ nguyên, có thể cần điều chỉnh nếu có phí ship)
                            let currentTotal = parseFloat(totalValue.textContent.replace(/[^\d]/g, '')) || 0;
                            grandTotalValue.textContent = (currentTotal - data.discount).toLocaleString(
                                'vi-VN') + 'đ';

                        } else {
                            messageDiv.textContent = data.message;
                            messageDiv.style.color = 'red';
                            // Ẩn thông tin giảm giá nếu không thành công
                            discountValue.textContent = '-0đ';

                            // Khôi phục lại tổng ban đầu
                            let originalTotal = <?php echo e($total); ?>;
                            totalValue.textContent = originalTotal.toLocaleString('vi-VN') + 'đ';
                            grandTotalValue.textContent = originalTotal.toLocaleString('vi-VN') + 'đ';
                        }
                        // Tự động ẩn thông báo sau 5 giây
                        setTimeout(() => {
                            messageDiv.style.display = 'none';
                        }, 5000);
                    })
                    .catch(error => {
                        const messageDiv = document.getElementById('discount_message');
                        messageDiv.style.display = 'block';
                        messageDiv.textContent = 'Có lỗi xảy ra khi áp dụng mã giảm giá!';
                        messageDiv.style.color = 'red';
                        // Ẩn thông tin giảm giá nếu có lỗi
                        const discountValue = document.querySelector('.discount-value');
                        discountValue.textContent = '-0đ';

                        setTimeout(() => {
                            messageDiv.style.display = 'none';
                        }, 5000);
                    });
            }


            function toggleCheckoutState() {
                if (agreeCheckbox && checkoutBtn && checkoutDiv) {
                    if (agreeCheckbox.checked) {
                        checkoutDiv.style.opacity = '1';
                        checkoutBtn.classList.remove('disabled');
                        checkoutBtn.style.pointerEvents = '';
                    } else {
                        checkoutDiv.style.opacity = '0.5';
                        checkoutBtn.classList.add('disabled');
                        checkoutBtn.style.pointerEvents = 'none';
                    }
                }
            }
            if (agreeCheckbox) {
                agreeCheckbox.addEventListener('change', toggleCheckoutState);
                toggleCheckoutState();
            }

            // --- Scroll đến sản phẩm gợi ý (nếu có) ---
            document.querySelectorAll('.similar-search-icon').forEach(function(el) {
                el.addEventListener('click', function(e) {
                    const target = document.getElementById('suggested-products');
                    if (target) {
                        e.preventDefault();
                        target.scrollIntoView({
                            behavior: 'smooth'
                        });
                    }
                });
            });

            // --- Khởi tạo tổng tiền ban đầu ---
            updateSelectedTotal();
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @php
                $repeatIds = session('repeat_ids') ? explode(',', session('repeat_ids')) : [];
            @endphp
            @if (!empty($repeatIds))
                const ids = @json($repeatIds);
                console.log('repeatIds:', ids);
                setTimeout(function() {
                    ids.forEach(id => {
                        const checkbox = document.querySelector(
                            '.cart-item-checkbox[data-item-id="' + id + '"]');
                        if (checkbox) checkbox.checked = true;
                    });
                    if (typeof updateSelectedTotal === 'function') updateSelectedTotal();
                }, 200);
            @endif
        });
    </script>
@endpush
