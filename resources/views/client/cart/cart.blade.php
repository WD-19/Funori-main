@extends('client.layout.client')

@section('title', 'Giỏ hàng')
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
        @if(session('error_discontinued'))
        <div class="alert alert-danger" style="background-color: #f8d7da; color: #721c24; padding: 15px; border-radius: 8px; margin-bottom: 20px; font-size: 16px; border: 1px solid #f5c6cb;">
            <strong>Sản phẩm ngừng kinh doanh!</strong> {{ session('error_discontinued') }}
        </div>
        @elseif(isset($errorMessages['discontinued']))
        <div class="alert alert-danger" style="background-color: #f8d7da; color: #721c24; padding: 15px; border-radius: 8px; margin-bottom: 20px; font-size: 16px; border: 1px solid #f5c6cb;">
            <strong>Sản phẩm ngừng kinh doanh!</strong> {{ $errorMessages['discontinued'] }}
        </div>
        @endif
        
        @if(session('error_outofstock'))
        <div class="alert alert-warning" style="background-color: #fff3cd; color: #856404; padding: 15px; border-radius: 8px; margin-bottom: 20px; font-size: 16px; border: 1px solid #ffeeba;">
            <strong>Sản phẩm hết hàng!</strong> {{ session('error_outofstock') }}
        </div>
        @elseif(isset($errorMessages['outofstock']))
        <div class="alert alert-warning" style="background-color: #fff3cd; color: #856404; padding: 15px; border-radius: 8px; margin-bottom: 20px; font-size: 16px; border: 1px solid #ffeeba;">
            <strong>Sản phẩm hết hàng!</strong> {{ $errorMessages['outofstock'] }}
        </div>
        @endif
        
        @if(session('error'))
        <div class="alert alert-danger" style="background-color: #f8d7da; color: #721c24; padding: 15px; border-radius: 8px; margin-bottom: 20px; font-size: 16px; border: 1px solid #f5c6cb;">
            <strong></strong> {{ session('error') }}
        </div>
        @endif
        
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
                                    @php
                                        $isDraft =
                                            isset($cartItem['product']['status']) &&
                                            $cartItem['product']['status'] === 'draft';
                                        $isArchived =
                                            isset($cartItem['product']['status']) &&
                                            $cartItem['product']['status'] === 'archived';
                                    @endphp
                                    <tr class="tf-cart-item file-delete"
                                        style="{{ $isDraft || $isArchived ? 'opacity:0.5;pointer-events:auto;' : '' }}">
                                        <td class="tf-cart-item_checkbox"
                                            style="width: 36px; padding-right: 4px; vertical-align: middle;">
                                            <input type="checkbox" class="cart-item-checkbox"
                                                data-item-id="{{ $cartItem['id'] }}"
                                                {{ $isDraft || $isArchived ? 'disabled' : '' }}
                                                style="{{ $isDraft || $isArchived ? 'pointer-events:none;opacity:0.5;' : '' }}">
                                        </td>
                                        <td class="cart-img-col" style="width: 90px; vertical-align: middle;">
                                            <div style="position: relative; width: 80px; height: 80px;">
                                                <button type="button" class="remove-cart-x"
                                                    data-item-id="{{ $cartItem['id'] }}"
                                                    style="position: absolute; top: -15px; left: -15px; background: rgba(180, 117, 115, 0.9); border: none; color: #fff; font-size: 18px; width: 24px; height: 24px; border-radius: 50%; cursor: pointer; z-index: 2; display: flex; align-items: center; justify-content: center; line-height: 1;">
                                                    &times;
                                                </button>
                                                @if (!empty($cartItem['variant']['image']['image_url']))
                                                    <img src="{{ asset($cartItem['variant']['image']['image_url']) }}"
                                                        alt="Biến thể"
                                                        style="object-fit: cover; border-radius: 6px; margin-bottom: 6px; width: 80px">
                                                @elseif (!empty($cartItem['image_url']))
                                                    <img src="{{ asset($cartItem['image_url']) }}"
                                                        alt="Sản phẩm"
                                                        style="object-fit: cover; border-radius: 6px; margin-bottom: 6px; width: 80px">
                                                @endif
                                            </div>
                                        </td>
                                        <td class="cart-info-col" style="vertical-align: middle;">
                                            <div class="cart-info">
                                                <div class="cart-info-col" style="flex: 2;">
                                                    <div class="cart-title-wrap">
                                                        <a href="{{ route('client.product.show', $cartItem['product']['slug'] ?? $cartItem['product_id'] ?? '#') }}"
                                                            class="cart-title link">
                                                            {{ $cartItem['product']['name'] ?? 'Sản phẩm đã xóa' }}
                                                        </a>
                                                    </div>
                                                    <div class="cart-meta-variant"
                                                        style="font-size: 13px; color: #b0b0b0; font-style: italic; margin-top: 4px;">
                                                        @if (!empty($cartItem['variant']['name_variant']))
                                                            <div>Tên biến thể: {{ $cartItem['variant']['name_variant'] }}</div>
                                                        @endif
                                                        @if (!empty($cartItem['variant_attributes']))
                                                            @foreach ($cartItem['variant_attributes'] as $attr)
                                                                <div>{{ $attr }}</div>
                                                            @endforeach
                                                        @endif
                                                        @if (!empty($cartItem['variant']['size']))
                                                            <div>Kích thước: {{ $cartItem['variant']['size'] }}</div>
                                                        @endif
                                                        @if ($isDraft)
                                                            <div style="color:red;font-weight:bold;">Sản phẩm đã ngừng kinh
                                                                doanh</div>
                                                        @elseif ($isArchived)
                                                            <div style="color:red;font-weight:bold;">Sản phẩm đã được ẩn</div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="cart-price-col" style="text-align: right; vertical-align: middle;">
                                            <div class="cart-price">
                                                {{ number_format($cartItem['price_at_addition'] ?? 0, 0, ',', '.') }}đ</div>
                                        </td>
                                        <td class="cart-qty-col" style="text-align: center; vertical-align: middle;">
                                            <div class="cart-quantity">
                                                <div class="wg-quantity"
                                                    style="{{ $isDraft || $isArchived ? 'pointer-events:none;opacity:0.5;' : '' }}">
                                                    <span class="btn-quantity minus-btn"
                                                        data-item-id="{{ $cartItem['id'] }}">-</span>
                                                    <input type="text" class="cart-qty-input"
                                                        data-item-id="{{ $cartItem['id'] }}"
                                                        value="{{ $cartItem['quantity'] ?? 1 }}" min="1"
                                                        data-max="{{ $cartItem['variant']['stock_quantity'] ?? ($cartItem['product']['stock_quantity'] ?? 9999) }}">
                                                    <span class="btn-quantity plus-btn"
                                                        data-item-id="{{ $cartItem['id'] }}">+</span>
                                                </div>
                                                
                                              
                                            </div>
                                        </td>
                                        <td class="cart-total-col" style="text-align: right; vertical-align: middle;">
                                            <div class="cart-total">
                                                {{ number_format(($cartItem['quantity'] ?? 1) * ($cartItem['price_at_addition'] ?? 0), 0, ',', '.') }}đ
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
                                        <path d="M12.5 15l-5-5 5-5" stroke="#fff" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
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
                                <button type="button" id="select_voucher_btn" class="tf-btn btn-sm btn-outline-primary mt-2"
                                    style="height: 48px; padding: 0 24px; border-radius: 6px; border: 1px solid #ff3029; color: #ff3029; background: transparent;">Chọn Voucher</button>
                                <div id="discount_message" style="margin-top: 8px; display: none;"></div>
                            </div>



                            <div style="font-family: 'Inter', Arial, Helvetica, sans-serif;">
                                <div class="tf-cart-totals-discounts">
                                    <h3 style="font-weight: 600; font-size: 18px;">Tổng tiền hàng</h3>
                                    <span class="total-value"
                                        style="font-size: 18px;">0đ</span>
                                </div>

                                <div class="tf-cart-discount-fee" style="margin-top: 24px;">
                                    <div
                                        style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 4px;">
                                        <span>Giảm giá</span>
                                        <span id="discount-display" class="discount-value">-0đ</span>
                                    </div>


                                    <div
                                        style="display: flex; justify-content: space-between; align-items: center; font-weight: bold; font-size: 18px; color: #ff3029;">
                                        <span>Tổng cộng</span>
                                        <span class="grand-total-value">
                                            0đ
                                        </span>
                                    </div>
                                </div>

                                <div class="cart-checkout-btn" style="margin-top: 18px;">
                                    <button type="button" id="checkout-btn"
                                        class="tf-btn w-100 btn-fill animate-hover-btn radius-3 justify-content-center">
                                        <span>Đặt hàng</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Voucher Modal -->
    <div class="modal fade" id="voucherModal" tabindex="-1" aria-labelledby="voucherModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Content will be loaded here -->
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
// ===== CART JAVASCRIPT - HOÀN TOÀN MỚI VÀ ĐƠN GIẢN =====

// Đợi DOM load xong
document.addEventListener('DOMContentLoaded', function() {
    console.log('=== CART SCRIPT STARTED ===');
    
    // Khởi tạo cart
    initCart();
});

function initCart() {
    console.log('Initializing cart...');
    
    // Khởi tạo các event listeners
    initCheckboxHandlers();
    initDeleteHandlers();
    initQuantityHandlers();
    initCheckoutHandlers();
    
    // Khởi tạo trạng thái ban đầu
    updateSelectedTotal();
    
    console.log('Cart initialized successfully!');
}

// ===== CHECKBOX HANDLERS =====
function initCheckboxHandlers() {
    console.log('Setting up checkbox handlers...');
    
    // Chọn tất cả
    const selectAllCheckbox = document.getElementById('select-all-checkbox');
    if (selectAllCheckbox) {
        selectAllCheckbox.addEventListener('change', function() {
            console.log('Select all changed:', this.checked);
            const isChecked = this.checked;
            
            document.querySelectorAll('.cart-item-checkbox').forEach(checkbox => {
                checkbox.checked = isChecked;
            });
            
            updateSelectedTotal();
        });
    }
    
    // Checkbox từng sản phẩm
    document.querySelectorAll('.cart-item-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            console.log('Item checkbox changed');
            updateSelectedTotal();
        });
    });
}

// ===== DELETE HANDLERS =====
function initDeleteHandlers() {
    console.log('Setting up delete handlers...');
    
    // Xóa sản phẩm đã chọn
    const deleteSelectedBtn = document.getElementById('delete-selected-btn');
    if (deleteSelectedBtn) {
        deleteSelectedBtn.addEventListener('click', function() {
            console.log('Delete selected clicked');
            const selectedItems = document.querySelectorAll('.cart-item-checkbox:checked');
            
            if (selectedItems.length === 0) {
                alert('Vui lòng chọn sản phẩm cần xóa!');
                return;
            }
            
            if (!confirm(`Bạn có chắc muốn xóa ${selectedItems.length} sản phẩm đã chọn?`)) {
                return;
            }
            
            selectedItems.forEach(checkbox => {
                const itemId = checkbox.dataset.itemId;
                console.log('Deleting item:', itemId);
                
                fetch("/cart/remove", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ item_id: itemId })
                })
                .then(response => response.json())
                .then(data => {
                    if (data && data.success) {
                        const row = checkbox.closest('tr');
                        if (row) row.remove();
                        if (data.hasOwnProperty('discount')) {
                            window.lastDiscountAmount = data.discount || 0;
                            const discountValueElement = document.querySelector('.discount-value');
                            if (discountValueElement && !window.lastDiscountAmount) {
                                discountValueElement.textContent = '-0đ';
                            }
                        }
                        updateSelectedTotal();
                    } else {
                        alert(data.message || 'Xóa sản phẩm thất bại!');
                    }
                })
                .catch(() => alert('Có lỗi khi kết nối máy chủ!'));
            });
        });
    }
    
    // Xóa toàn bộ giỏ hàng
    const clearCartBtn = document.getElementById('clear-cart-btn');
    if (clearCartBtn) {
        clearCartBtn.addEventListener('click', function() {
            console.log('Clear cart clicked');
            if (!confirm('Bạn có chắc muốn xóa tất cả sản phẩm trong giỏ hàng?')) {
                return;
            }
            
            fetch("/cart/clear", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data && data.success) {
                    document.querySelectorAll('.tf-cart-item').forEach(row => row.remove());
                    updateSelectedTotal();
                    alert('Đã xóa tất cả sản phẩm trong giỏ hàng!');
                } else {
                    alert(data.message || 'Xóa giỏ hàng thất bại!');
                }
            })
            .catch(() => alert('Có lỗi khi kết nối máy chủ!'));
        });
    }
    
    // Xóa từng sản phẩm (nút ×)
    document.querySelectorAll('.remove-cart-x').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const itemId = this.dataset.itemId;
            console.log('Remove item clicked:', itemId);
            
            if (!confirm('Bạn có chắc muốn xóa sản phẩm này khỏi giỏ hàng?')) {
                return;
            }
            
            fetch("/cart/remove", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ item_id: itemId })
            })
            .then(response => response.json())
            .then(data => {
                if (data && data.success) {
                    const row = btn.closest('tr');
                    if (row) row.remove();
                    if (data.hasOwnProperty('discount')) {
                        window.lastDiscountAmount = data.discount || 0;
                        const discountValueElement = document.querySelector('.discount-value');
                        if (discountValueElement && !window.lastDiscountAmount) {
                            discountValueElement.textContent = '-0đ';
                        }
                    }
                    updateSelectedTotal();
                } else {
                    alert(data.message || 'Xóa sản phẩm thất bại!');
                }
            })
            .catch(() => alert('Có lỗi khi kết nối máy chủ!'));
        });
    });
}

// ===== QUANTITY HANDLERS =====
function initQuantityHandlers() {
    console.log('Setting up quantity handlers...');
    
    // Nút +/-
    document.querySelectorAll('.btn-quantity').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            console.log('Quantity button clicked');
            
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
    
    // Input số lượng
    document.querySelectorAll('.cart-qty-input').forEach(input => {
        input.addEventListener('change', function() {
            console.log('Quantity input changed');
            let quantity = parseInt(this.value) || 1;
            const max = parseInt(this.getAttribute('data-max')) || 9999;
            if (quantity < 1) quantity = 1;
            if (quantity > max) quantity = max;
            this.value = quantity;
            updateCart(this);
            
            const plusBtn = this.parentNode.querySelector('.plus-btn');
            if (plusBtn && quantity >= max) plusBtn.setAttribute('disabled', 'disabled');
        });
    });
}

// ===== CHECKOUT HANDLERS =====
function initCheckoutHandlers() {
    console.log('Setting up checkout handlers...');
    
    const checkoutBtn = document.getElementById('checkout-btn');
    console.log('Checkout button found:', !!checkoutBtn);
    if (checkoutBtn) {
        checkoutBtn.addEventListener('click', function(e) {
            e.preventDefault();
            console.log('Checkout clicked');
            
            // Kiểm tra xem có sản phẩm nào trong giỏ hàng không
            const allCartItems = document.querySelectorAll('.cart-item-checkbox');
            if (allCartItems.length === 0) {
                alert('Giỏ hàng trống! Vui lòng thêm sản phẩm vào giỏ hàng.');
                return;
            }
            
            const selectedItems = document.querySelectorAll('.cart-item-checkbox:checked');
            if (selectedItems.length === 0) {
                alert('Vui lòng chọn ít nhất một sản phẩm để thanh toán!');
                return;
            }
            
            const selectedItemIds = Array.from(selectedItems).map(checkbox => checkbox.getAttribute('data-item-id'));
            
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route("client.checkout.prepare") }}';
            
            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = '{{ csrf_token() }}';
            form.appendChild(csrfToken);
            
            selectedItemIds.forEach(itemId => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'selected_items[]';
                input.value = itemId;
                form.appendChild(input);
            });
            
            document.body.appendChild(form);
            form.submit();
        });
    }
}

// ===== UTILITY FUNCTIONS =====

// Cập nhật tổng tiền
function updateSelectedTotal() {
    console.log('Updating selected total...');
    
    const selectedItems = document.querySelectorAll('.cart-item-checkbox:checked');
    let selectedTotal = 0;
    
    selectedItems.forEach(checkbox => {
        const row = checkbox.closest('tr');
        const totalElement = row.querySelector('.cart-total');
        const totalText = totalElement ? totalElement.textContent : '0';
        const total = parseInt(totalText.replace(/[^\d]/g, '')) || 0;
        selectedTotal += total;
    });
    
    const totalValueElement = document.querySelector('.total-value');
    if (totalValueElement) {
        totalValueElement.textContent = selectedTotal.toLocaleString('vi-VN') + 'đ';
    }
    
    // Tính toán discount (nếu có)
    const discountValueElement = document.querySelector('.discount-value');
    let discountAmount = 0;
    console.log('Checking discount:', window.lastDiscountAmount);
    if (window.lastDiscountAmount) {
        discountAmount = window.lastDiscountAmount;
        console.log('Applying discount:', discountAmount);
        if (discountValueElement) {
            // Format số tiền giảm giá đúng định dạng Việt Nam
            const formattedAmount = Math.round(discountAmount).toLocaleString('vi-VN');
            discountValueElement.textContent = '-' + formattedAmount + 'đ';
        }
    }
    
    // Tính grand total
    const grandTotal = selectedTotal - discountAmount;
    const grandTotalElement = document.querySelector('.grand-total-value');
    if (grandTotalElement) {
        grandTotalElement.textContent = grandTotal.toLocaleString('vi-VN') + 'đ';
    }
    
    // Cập nhật nút xóa
    const deleteSelectedBtn = document.getElementById('delete-selected-btn');
    if (deleteSelectedBtn) {
        if (selectedItems.length > 0) {
            deleteSelectedBtn.style.display = 'block';
            deleteSelectedBtn.textContent = `Xóa ${selectedItems.length} sản phẩm đã chọn`;
        } else {
            deleteSelectedBtn.style.display = 'none';
        }
    }
    
    // Cập nhật trạng thái checkbox "Chọn tất cả"
    updateSelectAllCheckboxState();
    
    console.log('Total updated:', selectedTotal, 'Discount:', discountAmount, 'Grand Total:', grandTotal);
}

// Cập nhật trạng thái checkbox "Chọn tất cả"
function updateSelectAllCheckboxState() {
    const selectAllCheckbox = document.getElementById('select-all-checkbox');
    if (!selectAllCheckbox) return;
    
    const itemCheckboxes = document.querySelectorAll('.cart-item-checkbox');
    const checkedCount = document.querySelectorAll('.cart-item-checkbox:checked').length;
    
    if (checkedCount === 0) {
        selectAllCheckbox.checked = false;
        selectAllCheckbox.indeterminate = false;
    } else if (checkedCount === itemCheckboxes.length) {
        selectAllCheckbox.checked = true;
        selectAllCheckbox.indeterminate = false;
    } else {
        selectAllCheckbox.checked = false;
        selectAllCheckbox.indeterminate = true;
    }
}

// Cập nhật giỏ hàng
function updateCart(input) {
    const itemId = input.dataset.itemId;
    const quantity = parseInt(input.value) || 1;
    input.disabled = true;
    
    console.log('Updating cart:', itemId, quantity);
    
    fetch("/cart/update", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json',
            'X-HTTP-Method-Override': 'PUT'
        },
        body: JSON.stringify({ item_id: itemId, quantity: quantity })
    })
    .then(response => response.json())
    .then(data => {
        if (data && data.success) {
            let row = document.querySelector(`.cart-item-checkbox[data-item-id="${itemId}"]`)?.closest('tr');
            if (!row) {
                const inputElement = document.querySelector(`.cart-qty-input[data-item-id="${itemId}"]`);
                row = inputElement?.closest('tr');
            }
            
            if (row) {
                const priceElement = row.querySelector('.cart-price');
                const priceText = priceElement ? priceElement.textContent : '0';
                const price = parseInt(priceText.replace(/[^\d]/g, '')) || 0;
                const quantity = parseInt(input.value) || 1;
                const total = price * quantity;
                const totalElement = row.querySelector('.cart-total');
                if (totalElement) {
                    totalElement.textContent = total.toLocaleString('vi-VN') + 'đ';
                }
            }
            // Đồng bộ lại discount từ backend nếu có trả về
            if (data.hasOwnProperty('discount')) {
                window.lastDiscountAmount = data.discount || 0;
                const discountValueElement = document.querySelector('.discount-value');
                if (discountValueElement && !window.lastDiscountAmount) {
                    discountValueElement.textContent = '-0đ';
                }
            }
            updateSelectedTotal();
        } else {
            alert(data.message || 'Cập nhật số lượng thất bại!');
        }
    })
    .catch(() => alert('Có lỗi khi kết nối máy chủ!'))
    .finally(() => {
        if (input) input.disabled = false;
    });
}

console.log('=== CART SCRIPT LOADED ===');

// ===== VOUCHER HANDLERS =====
function initVoucherHandlers() {
    console.log('Setting up voucher handlers...');
    
    // Lưu lại discountCode và selectedItems toàn cục
    let lastDiscountCode = '';
    let lastSelectedItems = [];
    let lastSelectedTotal = 0;
    let lastDiscountAmount = 0;

    function triggerDiscountUpdate() {
        // Nếu đã có mã giảm giá và đã từng áp dụng thì tự động cập nhật lại
        if (lastDiscountCode && lastSelectedItems.length > 0) {
            // Lấy lại các sản phẩm đang được chọn hiện tại
            const checkedItems = document.querySelectorAll('.cart-item-checkbox:checked');
            let selectedTotal = 0;
            let selectedItems = [];
            checkedItems.forEach(function (checkbox) {
                const row = checkbox.closest('tr');
                const qtyInput = row.querySelector('.cart-qty-input');
                const quantity = qtyInput ? parseInt(qtyInput.value) || 1 : 1;
                const priceElement = row.querySelector('.cart-price');
                const priceText = priceElement ? priceElement.textContent : '0';
                const price = parseInt(priceText.replace(/[^\d]/g, '')) || 0;
                selectedTotal += price * quantity;
                selectedItems.push({ item_id: checkbox.getAttribute('data-item-id'), quantity: quantity, price: price });
            });
            if (selectedItems.length > 0) {
                lastSelectedItems = selectedItems;
                lastSelectedTotal = selectedTotal;
                applyDiscount(lastDiscountCode, selectedItems, selectedTotal);
            }
        }
    }

    // Nút áp dụng mã giảm giá
    const applyDiscountBtn = document.getElementById('apply_discount');
    if (applyDiscountBtn) {
        applyDiscountBtn.addEventListener('click', function () {
            const discountCodeInput = document.getElementById('discount_code');
            const discountCode = discountCodeInput.value;
            const checkedItems = document.querySelectorAll('.cart-item-checkbox:checked');
            
            if (checkedItems.length === 0) {
                alert('Vui lòng chọn sản phẩm cần áp dụng mã giảm giá.');
                return;
            }
            
            let selectedTotal = 0;
            let selectedItems = [];
            checkedItems.forEach(function (checkbox) {
                const row = checkbox.closest('tr');
                const qtyInput = row.querySelector('.cart-qty-input');
                const quantity = qtyInput ? parseInt(qtyInput.value) || 1 : 1;
                const priceElement = row.querySelector('.cart-price');
                const priceText = priceElement ? priceElement.textContent : '0';
                const price = parseInt(priceText.replace(/[^\d]/g, '')) || 0;
                selectedTotal += price * quantity;
                selectedItems.push({ item_id: checkbox.getAttribute('data-item-id'), quantity: quantity, price: price });
            });
            
            if (discountCode) {
                lastDiscountCode = discountCode;
                lastSelectedItems = selectedItems;
                lastSelectedTotal = selectedTotal;
                applyDiscount(discountCode, selectedItems, selectedTotal);
            }
        });
    }

    // Không tự động gọi lại applyDiscount khi thay đổi số lượng/checkbox.
    // Backend đã tự tái tính và trả về discount trong các API update/remove.

    function applyDiscount(discountCode, selectedItems, selectedTotal) {
        fetch('/cart/apply-discount', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                discount_code: discountCode,
                selected_items: selectedItems
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
                lastDiscountAmount = data.discount || 0;
                window.lastDiscountAmount = lastDiscountAmount; // Lưu vào window object
                updateSelectedTotal();
            } else {
                messageDiv.textContent = data.message;
                messageDiv.style.color = 'red';
                lastDiscountAmount = 0;
                window.lastDiscountAmount = 0; // Reset discount
                updateSelectedTotal();
            }
            setTimeout(() => {
                messageDiv.style.display = 'none';
            }, 5000);
        })
        .catch(error => {
            const messageDiv = document.getElementById('discount_message');
            messageDiv.style.display = 'block';
            messageDiv.textContent = 'Có lỗi xảy ra khi áp dụng mã giảm giá!';
            messageDiv.style.color = 'red';
            lastDiscountAmount = 0;
            window.lastDiscountAmount = 0; // Reset discount
            updateSelectedTotal();
            setTimeout(() => {
                messageDiv.style.display = 'none';
            }, 5000);
        });
    }
}

// Khởi tạo voucher handlers
initVoucherHandlers();

// ===== VOUCHER MODAL HANDLERS =====
function initVoucherModalHandlers() {
    console.log('Setting up voucher modal handlers...');
    
    // Nút "Chọn Voucher"
    const selectVoucherBtn = document.getElementById('select_voucher_btn');
    if (selectVoucherBtn) {
        selectVoucherBtn.addEventListener('click', function() {
            console.log('Select voucher button clicked');
            openVoucherModal();
        });
    }
}

function openVoucherModal() {
    console.log('Opening voucher modal...');
    
    // Show loading state
    const modalContent = document.querySelector('#voucherModal .modal-content');
    modalContent.innerHTML = `
        <div class="modal-header border-0 pb-0">
            <h5 class="modal-title fw-bold text-dark">
                <i class="fas fa-ticket-alt me-2 text-primary"></i>
                Chọn mã giảm giá
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body text-center py-5">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="mt-3 text-muted">Đang tải danh sách voucher...</p>
        </div>
    `;
    
    // Show modal
    const modal = new bootstrap.Modal(document.getElementById('voucherModal'));
    modal.show();
    
    // Load voucher list via AJAX
    fetch('/cart/vouchers')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.text();
        })
        .then(html => {
            modalContent.innerHTML = html;
            
            // Add event listeners to voucher items
            document.querySelectorAll('.apply-voucher-btn').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    
                    const voucherCode = this.getAttribute('data-code');
                    const voucherCard = this.closest('.voucher-card');
                    
                    console.log('Voucher selected:', voucherCode);
                    
                    // Add loading state to button
                    const originalText = this.innerHTML;
                    this.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Đang áp dụng...';
                    this.disabled = true;
                    
                    // Add success animation to card
                    voucherCard.style.borderColor = '#28a745';
                    voucherCard.style.background = 'linear-gradient(135deg, #f8fff9 0%, #e8f5e8 100%)';
                    
                    // Fill the discount code input
                    const discountInput = document.getElementById('discount_code');
                    if (discountInput) {
                        discountInput.value = voucherCode;
                        discountInput.focus();
                    }
                    
                    // Close modal after delay
                    setTimeout(() => {
                        modal.hide();
                        
                        // Auto-apply the voucher
                        const applyBtn = document.getElementById('apply_discount');
                        if (applyBtn) {
                            applyBtn.click();
                        }
                        
                        // Reset button state
                        this.innerHTML = originalText;
                        this.disabled = false;
                    }, 1000);
                });
            });
            
            // Add click event to entire voucher card
            document.querySelectorAll('.voucher-card').forEach(card => {
                card.addEventListener('click', function(e) {
                    if (!e.target.closest('.apply-voucher-btn')) {
                        const btn = this.querySelector('.apply-voucher-btn');
                        if (btn) {
                            btn.click();
                        }
                    }
                });
            });
        })
        .catch(error => {
            console.error('Error loading vouchers:', error);
            modalContent.innerHTML = `
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold text-dark">
                        <i class="fas fa-ticket-alt me-2 text-primary"></i>
                        Chọn mã giảm giá
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center py-5">
                    <div class="mb-3">
                        <i class="fas fa-exclamation-triangle text-warning" style="font-size: 3rem;"></i>
                    </div>
                    <h6 class="text-danger mb-2">Lỗi tải dữ liệu</h6>
                    <p class="text-muted small">Không thể tải danh sách voucher. Vui lòng thử lại!</p>
                    <button type="button" class="btn btn-primary btn-sm" onclick="openVoucherModal()">
                        <i class="fas fa-redo me-1"></i>Thử lại
                    </button>
                </div>
            `;
        });
}

// Khởi tạo voucher modal handlers
initVoucherModalHandlers();
</script>
@endpush