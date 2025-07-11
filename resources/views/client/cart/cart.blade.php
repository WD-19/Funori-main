@extends('client.layout.client')

@section('title', 'Trang chủ')
<link rel="stylesheet" href="{{ asset('css/cart.css') }}">
<!-- Font Awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


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

    .list-product-btn {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
        margin-top: 10px;
    }
    .list-product-btn .box-icon {
        margin: 0;
        padding: 0;
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    /* Xóa hoặc giảm khoảng cách dưới phần "You may also like" */
    .flat-spacing-17,
    .container1,
    .swiper {
        margin-bottom: 0 !important;
        padding-bottom: 0 !important;
    }

    /* Xóa khoảng trống dưới phần sản phẩm gợi ý */
    .flat-spacing-17,
    .container1,
    .swiper,
    .swiper-wrapper,
    .swiper-slide {
        margin-bottom: 0 !important;
        padding-bottom: 0 !important;
        min-height: 0 !important;
        height: auto !important;
    }

    /* Xóa chiều cao cố định hoặc min-height của swiper và các thành phần con */
    .swiper,
    .swiper-wrapper,
    .swiper-slide {
        min-height: 0 !important;
        height: auto !important;
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
                                        </td>
                                        <td class="cart-info-col" style="vertical-align: middle;">
                                            <div class="cart-info">
                                                <div class="cart-title-wrap">
                                                    <a href="{{ route('client.product.show', $cartItem['product']['slug'] ?? $cartItem['product_id']) }}"
                                                        class="cart-title link">
                                                        {{ $cartItem['product']['name'] ?? 'Sản phẩm đã xóa' }}
                                                    </a>
                                                    @if (!empty($cartItem['variant_attributes']))
                                                        <div class="cart-meta-variant" style="color: #555;">
                                                        </div>
                                                    @endif
                                                </div>

                                                @if (!empty($cartItem['variant_attributes']))
                                                    <div class="cart-meta-variant" style="color: #555;">

                                                        {{-- Hiển thị các thuộc tính biến thể --}}
                                                        @foreach ($cartItem['variant_attributes'] as $attr)
                                                            <div>{{ $attr }}</div>
                                                        @endforeach
                                                    </div>
                                                @endif


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
                            {{-- <div class="tf-progress-msg">
                                    Mua thêm <span class="price fw-6">{{ number_format($total, 0, ',', '.') }}đ</span> để được <span class="fw-6">Miễn phí vận chuyển</span>
                                </div> --}}
                        </div>
                        <div class="tf-page-cart-checkout">
                          

                            <div style="font-family: 'Inter', Arial, Helvetica, sans-serif;">
                               

                                <div class="tf-cart-discount-fee" style="margin-top: 24px;">
                                   
                                    <hr style="margin: 8px 0;">
                                    <div
                                        style="display: flex; justify-content: space-between; align-items: center; font-weight: bold; font-size: 18px; color: #ff3029;">
                                        <span>Tổng cộng</span>
                                        <span class="grand-total-value">
                                            {{ number_format($total - ($discount ?? 0) + ($shipping_fee ?? 0), 0, ',', '.') }}đ
                                        </span>
                                    </div>
                                </div>
                                <div class="cart-checkbox" style="margin-top: 18px;">
                                    <input type="checkbox" class="tf-check" id="check-agree">
                                    <label for="check-agree" class="fw-4">
                                        Tôi đồng ý với <a href="terms-conditions.html">điều khoản & điều kiện</a>
                                    </label>
                                </div>
                                <div class="cart-checkout-btn" style="margin-top: 18px;">
                                    <a href="{{ route('client.checkout.index') }}"
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
    <section class="flat-spacing-17 pt_0">
        <div class="container1">
            <div class="flat-title">
                <span class="title">SẢN PHẨM MỚI</span>
            </div>
            <div class="hover-sw-nav hover-sw-2">
                <div dir="ltr" class="swiper tf-sw-product-sell wrap-sw-over" data-preview="4" data-tablet="3"
                    data-mobile="2" data-space-lg="30" data-space-md="15" data-pagination="2" data-pagination-md="3"
                    data-pagination-lg="3">
                    <div class="swiper-wrapper">
                        @foreach($newestProducts as $product)
                            <div class="swiper-slide" lazy="true">
                                <div class="card-product">
                                    <div class="card-product-wrapper">
                                        <a href="{{ route('client.product.show', $product->slug) }}" class="product-img">
                                            <img class="lazyload img-product"
                                                 src="{{ asset($product->images[0]->image_url ?? 'images/products/no-image.png') }}"
                                                 alt="image-product">
                                            <!-- Nếu muốn ảnh hover, có thể lấy ảnh thứ 2 nếu có -->
                                            @if(isset($product->images[1]))
                                                <img class="lazyload img-hover"
                                                     src="{{ asset($product->images[1]->image_url) }}"
                                                     alt="image-product">
                                            @endif
                                        </a>
                                        <div class="list-product-btn">
                                            <a href="#quick_add" data-bs-toggle="modal"
                                                class="box-icon bg_white quick-add tf-btn-loading">
                                                <span class="icon icon-bag"></span>
                                                <span class="tooltip">Quick Add</span>
                                            </a>
                                            <a href="javascript:void(0);" class="box-icon bg_white wishlist btn-icon-action">
                                                <span class="icon icon-heart"></span>
                                                <span class="tooltip">Add to Wishlist</span>
                                                <span class="icon icon-delete"></span>
                                            </a>
                                            <a href="#compare" data-bs-toggle="offcanvas" aria-controls="offcanvasLeft"
                                                class="box-icon bg_white compare btn-icon-action">
                                                <span class="icon icon-compare"></span>
                                                <span class="tooltip">Add to Compare</span>
                                                <span class="icon icon-check"></span>
                                            </a>
                                            <a href="#quick_view" data-bs-toggle="modal"
                                                class="box-icon bg_white quickview tf-btn-loading">
                                                <span class="icon icon-view"></span>
                                                <span class="tooltip">Quick View</span>
                                            </a>
                                        </div>
                                       
                                    </div>
                                    <div class="card-product-info">
                                        <a href="{{ route('client.product.show', $product->slug) }}" class="title link">{{ $product->name }}</a>
                                        <span class="price">{{ number_format($product->regular_price, 0, ',', '.') }}đ</span>
                                        <!-- Nếu muốn hiển thị màu, size động thì cần thêm dữ liệu -->
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="nav-sw nav-next-slider nav-next-product box-icon w_46 round"><span
                        class="icon icon-arrow-left"></span></div>
                <div class="nav-sw nav-prev-slider nav-prev-product box-icon w_46 round"><span
                        class="icon icon-arrow-right"></span></div>
                <div class="sw-dots style-2 sw-pagination-product justify-content-center"></div>
            </div>
        </div>
    </section>

@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Xử lý checkbox "Chọn tất cả"
        const selectAllCheckbox = document.getElementById('select-all-checkbox');
        const itemCheckboxes = document.querySelectorAll('.cart-item-checkbox');
        const deleteSelectedBtn = document.getElementById('delete-selected-btn');

        // Xử lý checkbox "Chọn tất cả"
        selectAllCheckbox.addEventListener('change', function() {
            const isChecked = this.checked;

            // Tích/bỏ tích tất cả checkbox sản phẩm
            itemCheckboxes.forEach(function(checkbox) {
                checkbox.checked = isChecked;
            });

            // Cập nhật tổng tiền
            updateSelectedTotal();
        });

        // Hàm cập nhật tổng tiền theo sản phẩm được chọn
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

            // Cập nhật hiển thị tổng tiền
            const totalValueElement = document.querySelector('.total-value');
            if (totalValueElement) {
                if (selectedItems.length === 0) {
                    // Không có sản phẩm nào được chọn, hiển thị 0đ
                    totalValueElement.textContent = '0đ';
                    totalValueElement.style.color = '#ff3029';

                    // Reset lại text header
                    const cartTotalsElement = document.querySelector('.tf-cart-totals-discounts h3');
                    if (cartTotalsElement) {
                        cartTotalsElement.textContent = 'Tổng tiền hàng';
                    }

                    // Cập nhật tổng cộng cũng là 0đ
                    const grandTotalElement = document.querySelector('.grand-total-value');
                    if (grandTotalElement) {
                        grandTotalElement.textContent = '0đ';
                    }
                } else {
                    // Hiển thị tổng sản phẩm được chọn (dù chỉ 1 hay nhiều)
                    totalValueElement.textContent = selectedTotal.toLocaleString('vi-VN') + 'đ';
                    totalValueElement.style.color = '#ff3029';

                    // Thêm tooltip hoặc text nhỏ để hiển thị số lượng sản phẩm được chọn
                   

                    // Cập nhật tổng cộng = tổng đã chọn - giảm giá + phí vận chuyển
                    const discount = 0; // Nếu có biến discount, lấy từ DOM hoặc JS
                    const shippingFee = 0; // Nếu có biến shipping_fee, lấy từ DOM hoặc JS
                    const grandTotalElement = document.querySelector('.grand-total-value');
                    if (grandTotalElement) {
                        grandTotalElement.textContent = (selectedTotal - discount + shippingFee).toLocaleString(
                            'vi-VN') + 'đ';
                    }
                }
            }

            // Hiển thị/ẩn nút xóa sản phẩm đã chọn
            if (selectedItems.length > 0) {
                deleteSelectedBtn.style.display = 'block';
                deleteSelectedBtn.textContent = `Xóa ${selectedItems.length} sản phẩm đã chọn`;
            } else {
                deleteSelectedBtn.style.display = 'none';
                // Reset lại text header
                const cartTotalsElement = document.querySelector('.tf-cart-totals-discounts h3');
                if (cartTotalsElement) {
                    cartTotalsElement.textContent = 'Tổng tiền hàng';
                }
            }
        }

        itemCheckboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                updateSelectedTotal();
            });
        });

        // Xử lý nút xóa sản phẩm đã chọn
        deleteSelectedBtn.addEventListener('click', function() {
            const selectedItems = document.querySelectorAll('.cart-item-checkbox:checked');

            if (selectedItems.length === 0) {
                alert('Vui lòng chọn sản phẩm cần xóa!');
                return;
            }
            if (!confirm(`Bạn có chắc muốn xóa ${selectedItems.length} sản phẩm đã chọn?`)) {
                return;
            }

            // Xóa từng sản phẩm được chọn
            const deletePromises = [];

            selectedItems.forEach(function(checkbox) {
                const itemId = checkbox.dataset.itemId;

                // Gọi API xóa
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
                            // Xóa khỏi DOM
                            const row = checkbox.closest('tr');
                            if (row) {
                                row.parentNode.removeChild(row);
                            }
                            // Cập nhật badge số lượng giỏ hàng nếu backend trả về cartCount
                            if (typeof data.cartCount !== 'undefined') {
                                updateCartCountBadge(data.cartCount);
                            }
                            return {
                                success: true,
                                itemId: itemId
                            };
                        } else {
                            console.warn('Server remove failed for item:', itemId, data
                                .message);
                            return {
                                success: false,
                                itemId: itemId,
                                message: data.message
                            };
                        }
                    }).catch(error => {
                        console.warn('Server remove failed for item:', itemId, error);
                        return {
                            success: false,
                            itemId: itemId,
                            error: error
                        };
                    });

                deletePromises.push(deletePromise);
            });

            // Đợi tất cả API calls hoàn thành
            Promise.all(deletePromises).then((results) => {
                const successCount = results.filter(r => r.success).length;
                const failedCount = results.filter(r => !r.success).length;

                if (successCount > 0) {
                    console.log(`${successCount} items removed successfully`);
                    // Cập nhật lại tổng tiền
                    updateSelectedTotal();
                }

                if (failedCount > 0) {
                    alert(`${failedCount} sản phẩm xóa thất bại. Vui lòng thử lại!`);
                }
            });
        });

        // Xử lý nút tăng/giảm số lượng
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
                    // Disable nếu đạt max
                    if (val >= max) {
                        this.setAttribute('disabled', 'disabled');
                    }
                } else if (this.classList.contains('minus-btn')) {
                    if (val > 1) {
                        val -= 1;
                        input.value = val;
                        updateCart(input);
                    }
                    // Enable lại nút "+" nếu giảm xuống dưới max
                    const plusBtn = this.parentNode.querySelector('.plus-btn');
                    if (plusBtn) plusBtn.removeAttribute('disabled');
                }
            });
        });

        // Khi load lại số lượng, kiểm tra để disable/enable nút "+"
        document.querySelectorAll('.cart-qty-input').forEach(function(input) {
            input.addEventListener('change', function() {
                let quantity = parseInt(this.value) || 1;
                const max = parseInt(this.getAttribute('data-max')) || 9999;
                if (quantity < 1) quantity = 1;
                if (quantity > max) quantity = max;
                this.value = quantity;
                updateCart(this);

                // Disable/enable nút "+"
                const plusBtn = this.parentNode.querySelector('.plus-btn');
                if (plusBtn) {
                    if (quantity >= max) {
                        plusBtn.setAttribute('disabled', 'disabled');
                    } else {
                        plusBtn.removeAttribute('disabled');
                    }
                }
            });

            // Khởi tạo trạng thái nút "+" khi load trang
            const max = parseInt(input.getAttribute('data-max')) || 9999;
            const plusBtn = input.parentNode.querySelector('.plus-btn');
            if (plusBtn) {
                if (parseInt(input.value) >= max) {
                    plusBtn.setAttribute('disabled', 'disabled');
                } else {
                    plusBtn.removeAttribute('disabled');
                }
            }
        });
        // Gắn sự kiện change cho input số lượng
        document.querySelectorAll('.cart-qty-input').forEach(function(input) {
            input.addEventListener('change', function() {
                let quantity = parseInt(this.value) || 1;
                if (quantity < 1) quantity = 1;
                this.value = quantity;
                updateCart(this);
            });
        });

        // Hàm cập nhật giỏ hàng
        function updateCart(input) {
            const itemId = input.dataset.itemId;
            const quantity = parseInt(input.value);

            // Disable input trong khi đang cập nhật
            input.disabled = true;

            // Tính toán trực tiếp ở frontend
            const row = input.closest('tr');
            const priceElement = row.querySelector('.cart-price');
            const totalElement = row.querySelector('.cart-total');

            // Lấy giá từ element hiện tại
            let priceText = priceElement.textContent;
            let price = parseInt(priceText.replace(/[^\d]/g, '')) || 0;

            // Tính thành tiền
            const total = price * quantity;

            // Cập nhật thành tiền của sản phẩm
            totalElement.textContent = total.toLocaleString('vi-VN') + 'đ';

            // Cập nhật tổng giỏ hàng
            updateSelectedTotal();

            // Gọi API để cập nhật database (không block UI)
            updateCartOnServer(itemId, quantity, input);
        }

        // Hàm cập nhật tổng giỏ hàng
        function updateCartTotal() {
            const totalElements = document.querySelectorAll('.cart-total');
            let grandTotal = 0;

            totalElements.forEach(function(element) {
                const totalText = element.textContent;
                const total = parseInt(totalText.replace(/[^\d]/g, '')) || 0;
                grandTotal += total;
            });

            const totalValueElement = document.querySelector('.total-value');
            if (totalValueElement) {
                totalValueElement.textContent = grandTotal.toLocaleString('vi-VN') + 'đ';
                totalValueElement.style.color = ''; // Reset màu về mặc định
            }
        }

        function updateCartCountBadge(count) {
            let badge = document.getElementById('cart-count-badge');

            if (count > 0) {
                if (!badge) {
                    // Nếu chưa có badge thì tạo mới
                    const cartIcon = document.querySelector('.box-cart');
                    badge = document.createElement('span');
                    badge.id = 'cart-count-badge';
                    badge.className = 'cart-count-badge';
                    badge.style =
                        'position: absolute; top: -14px; right: -10px; background: #e53935; color: #fff; border-radius: 50%; padding: 0 5px; font-size: 11px; font-weight: bold; min-width: 18px; height: 18px; display: flex; align-items: center; justify-content: center; text-align: center; line-height: 18px; box-shadow: 0 1px 4px rgba(0,0,0,0.12); z-index: 2;';
                    cartIcon.appendChild(badge);
                }

                badge.textContent = count;
                badge.style.display = 'flex';
            } else {
                if (badge) badge.remove(); // hoặc: badge.style.display = 'none';
            }
        }




        // Hàm gọi API để cập nhật database (không block UI)
        function updateCartOnServer(itemId, quantity, input) {
            const url = "/cart/update";
            const csrfToken = "{{ csrf_token() }}";

            fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                        'X-HTTP-Method-Override': 'PUT'
                    },
                    body: JSON.stringify({
                        item_id: itemId,
                        quantity: quantity
                    })
                })
                .then(response => {
                    if (!response.ok) {
                        console.warn('Server update failed, but UI updated successfully');
                        return;
                    }
                    return response.json();
                })
                .then(data => {
                    if (data && data.success) {
                        console.log('Server updated successfully');
                    }
                })
                .catch(error => {
                    console.warn('Server update failed, but UI updated successfully:', error);
                })
                .finally(() => {
                    // Re-enable input sau khi hoàn thành
                    if (input) {
                        input.disabled = false;
                    }
                });
        }

        // Xóa sản phẩm khỏi giỏ hàng
        document.querySelectorAll('.remove-cart-x').forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const itemId = this.dataset.itemId;
                if (!confirm('Bạn có chắc muốn xóa sản phẩm này khỏi giỏ hàng?')) return;

                // Gọi API để xóa trên database/session
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
                            // Chỉ xóa khỏi DOM khi backend đã xóa thành công
                            const row = btn.closest('tr');
                            if (row) row.parentNode.removeChild(row);
                            updateCartTotal();
                            updateSelectedTotal();
                        } else {
                            alert(data.message || 'Xóa sản phẩm thất bại!');
                        }
                    })
                    .catch(() => {
                        alert('Có lỗi khi kết nối máy chủ!');
                    });
            });
        });


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

        // Khởi tạo ban đầu
        updateSelectedTotal();

        // Xử lý nút "Xóa giỏ hàng"
        const clearCartBtn = document.getElementById('clear-cart-btn');
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
                            // Chỉ xóa khỏi DOM khi backend đã xóa thành công
                            document.querySelectorAll('.tf-cart-item').forEach(row => row.parentNode
                                .removeChild(row));
                            document.querySelector('.total-value').textContent = '0đ';
                            document.querySelector('.grand-total-value').textContent = '0đ';
                            if (deleteSelectedBtn) deleteSelectedBtn.style.display = 'none';
                            if (selectAllCheckbox) selectAllCheckbox.checked = false;
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


        const agreeCheckbox = document.getElementById('check-agree');
        const checkoutBtn = document.querySelector('.cart-checkout-btn a');
        const checkoutDiv = document.querySelector('.cart-checkout-btn');

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
            toggleCheckoutState(); // Gọi khi load trang
        }
    });
</script>
