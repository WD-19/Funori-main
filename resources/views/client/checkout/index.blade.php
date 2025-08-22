@extends('client.layout.client')

@section('title', 'Thanh toán')

<style>
    /* Cải thiện bố cục tổng thể */
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }
    
    .checkout-form {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        padding: 40px;
        margin-bottom: 30px;
    }
    
    .checkout-form h4 {
        color: #333;
        font-weight: 700;
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 2px solid #f0f0f0;
        position: relative;
    }
    
    .checkout-form h4::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 60px;
        height: 2px;
        background: #ff3029;
    }
    
    .checkout-form .form-group {
        margin-bottom: 24px;
    }
    
    .checkout-form .form-control {
        height: 52px;
        border-radius: 10px;
        border: 1.5px solid #e0e0e0;
        padding: 0 20px;
        font-size: 15px;
        transition: all 0.3s ease;
        background: #fafbfc;
    }
    
    .checkout-form .form-control:focus {
        border-color: #ff3029;
        box-shadow: 0 0 0 0.15rem rgba(255, 48, 41, 0.15);
        background: #fff;
        outline: none;
    }
    
    .checkout-form label {
        font-weight: 600;
        color: #4a5568;
        margin-bottom: 8px;
        display: block;
        font-size: 14px;
    }
    
    .checkout-form .text-danger {
        color: #e53e3e !important;
    }
    
    /* Cải thiện checkbox */
    .checkout-form input[type="checkbox"] {
        width: 18px;
        height: 18px;
        margin-right: 10px;
        accent-color: #ff3029;
    }
    
    .checkout-form input[type="checkbox"] + label {
        display: inline;
        font-weight: 500;
        cursor: pointer;
    }

    /* Required field styling */
    .required-field {
        border-color: #ff3029 !important;
        background-color: #fff5f5 !important;
    }

    .required-field:focus {
        border-color: #ff3029 !important;
        box-shadow: 0 0 0 0.15rem rgba(255, 48, 41, 0.25) !important;
    }

    .order-summary {
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        padding: 32px;
        border-radius: 16px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 20px rgba(0,0,0,0.06);
        position: sticky;
        top: 20px;
    }

    .order-summary h4 {
        font-weight: 700;
        margin-bottom: 25px;
        border-bottom: 2px solid #e2e8f0;
        padding-bottom: 15px;
        color: #1e293b;
        position: relative;
    }
    
    .order-summary h4::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 50px;
        height: 2px;
        background: #ff3029;
    }

    .summary-item {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
        padding: 16px;
        background: #fff;
        border-radius: 12px;
        border: 1px solid #f1f5f9;
        transition: all 0.2s ease;
    }
    
    .summary-item:hover {
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        transform: translateY(-1px);
    }

    .summary-item img {
        width: 70px;
        height: 70px;
        object-fit: cover;
        border-radius: 10px;
        margin-right: 16px;
        border: 2px solid #f1f5f9;
    }

    .summary-item .product-info {
        flex-grow: 1;
    }

    .summary-item .product-info .product-name {
        font-weight: 600;
        margin-bottom: 6px;
        color: #1e293b;
        font-size: 15px;
        line-height: 1.4;
    }

    .summary-item .product-info .product-qty {
        color: #64748b;
        font-size: 14px;
        font-weight: 500;
    }

    .summary-item .product-price {
        font-weight: 700;
        color: #ff3029;
        font-size: 16px;
    }

    .totals-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 12px;
        font-size: 15px;
        padding: 8px 0;
        border-bottom: 1px solid #f1f5f9;
    }
    
    .totals-row:last-child {
        border-bottom: none;
    }

    .totals-row.grand-total {
        font-weight: 700;
        font-size: 18px;
        color: #ff3029;
        margin-top: 20px;
        padding-top: 20px;
        border-top: 2px solid #e2e8f0;
        background: linear-gradient(135deg, #fff5f5 0%, #fed7d7 100%);
        padding: 16px;
        border-radius: 10px;
        margin-bottom: 0;
    }

    .payment-method,
    .shipping-method {
        padding: 15px;
        border: 1px solid #ddd;
        border-radius: 8px;
        margin-bottom: 10px;
        cursor: pointer;
        transition: all 0.2s;
    }

    .payment-method:hover,
    .shipping-method:hover {
        border-color: #ff3029;
    }

    .payment-method input,
    .shipping-method input {
        margin-right: 10px;
    }

    .address-item {
        cursor: pointer;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        margin-bottom: 5px;
    }

    .address-item:hover {
        background-color: #f5f5f5;
    }
    
    /* CSS cho dropdown tìm kiếm phường/xã */
    .ward-option {
        padding: 12px 16px;
        cursor: pointer;
        border-bottom: 1px solid #f3f4f6;
        transition: background-color 0.2s;
        font-size: 14px;
        user-select: none;
    }
    
    .ward-option:hover {
        background-color: #f9fafb !important;
    }
    
    .ward-option:last-child {
        border-bottom: none !important;
    }
    
    .ward-option:active {
        background-color: #e5e7eb !important;
    }
    
    /* Tùy chỉnh scrollbar cho dropdown */
    #buyer_ward_options::-webkit-scrollbar,
    #shipping_ward_options::-webkit-scrollbar {
        width: 6px;
    }
    
    #buyer_ward_options::-webkit-scrollbar-track,
    #shipping_ward_options::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 3px;
    }
    
    #buyer_ward_options::-webkit-scrollbar-thumb,
    #shipping_ward_options::-webkit-scrollbar-thumb {
        background: #c1c1c1;
        border-radius: 3px;
    }
    
    #buyer_ward_options::-webkit-scrollbar-thumb:hover,
    #shipping_ward_options::-webkit-scrollbar-thumb:hover {
        background: #a8a8a8;
    }
    
    /* Animation cho dropdown */
    #buyer_ward_dropdown,
    #shipping_ward_dropdown {
        animation: fadeInDown 0.2s ease-out;
    }
    
    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    /* Hiệu ứng hover cho icon chevron */
    .bx-chevron-down:hover {
        color: #ff3029 !important;
        transform: translateY(-50%) scale(1.1) !important;
        transition: all 0.2s ease;
    }
    
    /* Cải thiện shipping info section */
    #shipping_info {
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        border-radius: 12px;
        padding: 25px;
        margin-top: 20px;
        border: 1px solid #e2e8f0;
    }
    
    #shipping_info h4 {
        color: #1e293b;
        font-weight: 700;
        margin-bottom: 20px;
        padding-bottom: 12px;
        border-bottom: 2px solid #e2e8f0;
        position: relative;
    }
    
    #shipping_info h4::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 50px;
        height: 2px;
        background: #ff3029;
    }
    
    /* Cải thiện nút thanh toán */
    .btn-checkout {
        background: linear-gradient(135deg, #ff3029 0%, #ff6b6b 100%);
        color: white;
        border: none;
        padding: 16px 32px;
        border-radius: 12px;
        font-weight: 700;
        font-size: 16px;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(255, 48, 41, 0.3);
        width: 100%;
        margin-top: 20px;
    }
    
    .btn-checkout:hover {
        background: linear-gradient(135deg, #e31c25 0%, #ff5252 100%);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(255, 48, 41, 0.4);
    }
    
    .btn-checkout:active {
        transform: translateY(0);
    }
    
    /* Responsive design */
    @media (max-width: 768px) {
        .checkout-form {
            padding: 20px;
        }
        
        .order-summary {
            margin-top: 20px;
            position: static;
        }
        
        .container {
            padding: 0 15px;
        }
    }


</style>

@section('content')
    @php
        $steps = [['label' => 'Giỏ hàng', 'key' => 'cart'], ['label' => 'Thanh toán', 'key' => 'checkout']];
        $currentStep = 'checkout';
    @endphp

    {{-- Hiển thị thông báo lỗi và cảnh báo --}}
    @if(session('error'))
        <div class="alert alert-danger" style="max-width: 1200px; margin: 20px auto; padding: 16px; background: #f8d7da; border: 1px solid #f5c6cb; border-radius: 8px; color: #721c24;">
            <i class="bx bx-error-circle" style="margin-right: 8px;"></i>
            {{ session('error') }}
        </div>
    @endif

    @if(session('warning'))
        <div class="alert alert-warning" style="max-width: 1200px; margin: 20px auto; padding: 16px; background: #fff3cd; border: 1px solid #ffeaa7; border-radius: 8px; color: #856404;">
            <i class="bx bx-info-circle" style="margin-right: 8px;"></i>
            {{ session('warning') }}
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success" style="max-width: 1200px; margin: 20px auto; padding: 16px; background: #d4edda; border: 1px solid #c3e6cb; border-radius: 8px; color: #155724;">
            <i class="bx bx-check-circle" style="margin-right: 8px;"></i>
            {{ session('success') }}
        </div>
    @endif
    <div class="tf-page-title">
        <div class="container-full">
            <div class="heading text-center">@yield('page_title', 'Thanh Toán')</div>
        </div>
    </div>
    <div style="max-width: 66vw; margin: 60px auto 0 auto; padding: 0 16px;">
        <div class="cart-checkout-progress"
            style="background: #fff; padding: 32px 16px 24px 16px; border-radius: 10px; margin-bottom: 16px;">
            <div style="display: flex; align-items: flex-start; justify-content: space-between;">
                @foreach ($steps as $index => $stepItem)
                    @php
                        $isActive = false;
                        if ($currentStep === 'checkout' && in_array($stepItem['key'], ['cart', 'checkout'])) {
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
                            @if (!$loop->last)
                                <div
                                    style="height: 4px; width: 100%; background:{{ $isActive ? 'rgb(255, 48, 41)' : '#fc9999' }}; position: absolute; top: 22px; left: 50%; z-index: 1;">
                                </div>
                            @endif
                        </div>
                        <div style="font-weight: bold; color: {{ $isActive ? '#232323' : '#676363' }}; margin-top: 8px;">
                            {{ $stepItem['label'] }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <section class="flat-spacing-11">
        <div class="container">
            <form action="{{ route('client.checkout.process') }}" method="POST" class="checkout-form">
                @csrf
                <div class="row">
                    <div class="col-lg-7">
                        <!-- Buyer Information Form -->
                        <h4>Thông tin người đặt hàng (để xuất hóa đơn)</h4>
                        @if (auth()->check() && $addresses->isNotEmpty())
                            <div class="form-group">
                                <label for="saved_address">Chọn địa chỉ đã lưu</label>
                                <select id="saved_address" class="form-control">
                                    <option value="">-- Nhập địa chỉ mới --</option>
                                    @foreach ($addresses as $index => $address)
                                        <option value="{{ $address->id }}" data-name="{{ $address->receiver_name ?? '' }}"
                                            data-phone="{{ $address->receiver_phone ?? '' }}"
                                            data-email="{{ auth()->user()->email ?? '' }}"
                                            data-address="{{ $address->street_address ?? '' }}"
                                            {{-- data-province="{{ $address->province ?? '' }}"
                                            data-district="{{ $address->district ?? '' }}" --}}
                                            data-ward="{{ $address->ward ?? '' }}">
                                            {{ $address->receiver_name }} - {{ $address->street_address }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label for="buyer_name">Họ và tên <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="buyer_name" name="buyer_name"
                                    value="{{ old('buyer_name', auth()->user()->full_name ?? '') }}" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="buyer_email">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="buyer_email" name="buyer_email"
                                    value="{{ old('buyer_email', auth()->user()->email ?? '') }}" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="buyer_phone">Số điện thoại <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="buyer_phone" name="buyer_phone"
                                    value="{{ old('buyer_phone', auth()->user()->phone_number ?? '') }}" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="buyer_province">Tỉnh/Thành phố <span class="text-danger">*</span></label>
                                <div style="position:relative;">
                                    <i class='bx bx-buildings' style="position:absolute; left:12px; top:50%; transform:translateY(-50%); color:#9ca3af; font-size:18px; z-index:2;"></i>
                                    <select class="form-control" id="buyer_province_disabled" name="buyer_province_disabled"
                                        required disabled style="padding-left:40px;">
                                        <option value="Thành phố Hà Nội">Thành phố Hà Nội</option>
                                    </select>
                                    <input type="hidden" name="buyer_province" value="Thành phố Hà Nội">
                                </div>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="buyer_ward">Phường/Xã <span class="text-danger">*</span></label>
                                <div style="position:relative;">
                                    <i class='bx bx-map-pin' style="position:absolute; left:12px; top:50%; transform:translateY(-50%); color:#9ca3af; font-size:18px; z-index:2;"></i>
                                    <input type="text" id="buyer_ward_search" placeholder="Tìm kiếm phường/xã..." 
                                        style="width:100%; padding:12px 12px 12px 40px; border:1px solid #ddd; border-radius:8px; font-size:15px; background-color:#fff; transition:all 0.2s ease;"
                                        onFocus="this.style.borderColor='#ff3029'; this.style.boxShadow='0 0 0 3px rgba(255, 48, 41, 0.1)'; showWardDropdown('buyer');" 
                                        onBlur="this.style.borderColor='#ddd'; this.style.boxShadow='none'; setTimeout(() => hideWardDropdown('buyer'), 150);">
                                    <i class='bx bx-chevron-down' style="position:absolute; right:12px; top:50%; transform:translateY(-50%); color:#9ca3af; font-size:18px; z-index:2; cursor:pointer;" onclick="showWardDropdown('buyer')"></i>
                                    <input type="hidden" name="buyer_ward" id="buyer_ward_hidden" required>
                                    
                                    <!-- Dropdown tìm kiếm phường/xã -->
                                    <div id="buyer_ward_dropdown" style="display:none; position:absolute; top:100%; left:0; right:0; background:#fff; border:1px solid #e5e7eb; border-radius:8px; box-shadow:0 4px 12px rgba(0,0,0,0.1); z-index:1000; max-height:200px; overflow-y:auto; margin-top:2px;">
                                        <div style="padding:8px 12px; border-bottom:1px solid #f3f4f6; color:#6b7280; font-size:13px; font-weight:500;">
                                            <i class='bx bx-search' style="margin-right:6px;"></i>Gõ để tìm kiếm phường/xã
                                        </div>
                                        <div id="buyer_ward_options" style="max-height:150px; overflow-y:auto;">
                                            <!-- Các option sẽ được thêm bằng JavaScript -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="buyer_address">Địa chỉ cụ thể (Số nhà, tên đường...) <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="buyer_address" name="buyer_address"
                                value="{{ old('buyer_address', auth()->user()->address ?? '') }}" required>
                        </div>

                        <!-- Shipping Information Form -->
                        <div class="form-group">
                            <label>
                                <input type="checkbox" id="ship_to_different_address" name="ship_to_different_address"
                                    {{ old('ship_to_different_address') ? 'checked' : '' }}>
                                Giao hàng đến địa chỉ khác
                            </label>
                        </div>

                        <div id="shipping_info" style="{{ old('ship_to_different_address') ? '' : 'display: none;' }}">
                            <h4>Địa chỉ giao hàng</h4>
                            
                            @if($addresses->count() > 0)
                                <div class="form-group">
                                    <label for="shipping_saved_address">Chọn địa chỉ đã lưu</label>
                                    <select id="shipping_saved_address" class="form-control">
                                        <option value="">-- Nhập địa chỉ mới --</option>
                                        @foreach ($addresses as $index => $address)
                                            <option value="{{ $address->id }}" data-name="{{ $address->receiver_name ?? '' }}"
                                                data-phone="{{ $address->receiver_phone ?? '' }}"
                                                data-email="{{ auth()->user()->email ?? '' }}"
                                                data-address="{{ $address->street_address ?? '' }}"
                                                data-ward="{{ $address->ward ?? '' }}">
                                                {{ $address->receiver_name }} - {{ $address->street_address }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label for="shipping_name">Họ và tên <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="shipping_name" name="shipping_name"
                                        value="{{ old('shipping_name') }}" required>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="shipping_email">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" id="shipping_email" name="shipping_email"
                                        value="{{ old('shipping_email') }}" required>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="shipping_phone">Số điện thoại <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="shipping_phone" name="shipping_phone"
                                        value="{{ old('shipping_phone') }}" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="shipping_province">Tỉnh/Thành phố <span
                                            class="text-danger">*</span></label>
                                    <div style="position:relative;">
                                        <i class='bx bx-buildings' style="position:absolute; left:12px; top:50%; transform:translateY(-50%); color:#9ca3af; font-size:18px; z-index:2;"></i>
                                        <select class="form-control" id="shipping_province_disabled"
                                            name="shipping_province_disabled" disabled style="padding-left:40px;">
                                            <option value="Thành phố Hà Nội">Thành phố Hà Nội</option>
                                        </select>
                                        <input type="hidden" name="shipping_province" value="Thành phố Hà Nội">
                                    </div>
                                </div>
                              
                                <div class="col-md-6 form-group">
                                    <label for="shipping_ward">Phường/Xã <span class="text-danger">*</span></label>
                                    <div style="position:relative;">
                                        <i class='bx bx-map-pin' style="position:absolute; left:12px; top:50%; transform:translateY(-50%); color:#9ca3af; font-size:18px; z-index:2;"></i>
                                        <input type="text" id="shipping_ward_search" placeholder="Tìm kiếm phường/xã..." 
                                            style="width:100%; padding:12px 12px 12px 40px; border:1px solid #ddd; border-radius:8px; font-size:15px; background-color:#fff; transition:all 0.2s ease;"
                                            onFocus="this.style.borderColor='#ff3029'; this.style.boxShadow='0 0 0 3px rgba(255, 48, 41, 0.1)'; showWardDropdown('shipping');" 
                                            onBlur="this.style.borderColor='#ddd'; this.style.boxShadow='none'; setTimeout(() => hideWardDropdown('shipping'), 150);">
                                        <i class='bx bx-chevron-down' style="position:absolute; right:12px; top:50%; transform:translateY(-50%); color:#9ca3af; font-size:18px; z-index:2; cursor:pointer;" onclick="showWardDropdown('shipping')"></i>
                                        <input type="hidden" name="shipping_ward" id="shipping_ward_hidden" required>
                                        
                                        <!-- Dropdown tìm kiếm phường/xã -->
                                        <div id="shipping_ward_dropdown" style="display:none; position:absolute; top:100%; left:0; right:0; background:#fff; border:1px solid #e5e7eb; border-radius:8px; box-shadow:0 4px 12px rgba(0,0,0,0.1); z-index:1000; max-height:200px; overflow-y:auto; margin-top:2px;">
                                            <div style="padding:8px 12px; border-bottom:1px solid #f3f4f6; color:#6b7280; font-size:13px; font-weight:500;">
                                                <i class='bx bx-search' style="margin-right:6px;"></i>Gõ để tìm kiếm phường/xã
                                            </div>
                                            <div id="shipping_ward_options" style="max-height:150px; overflow-y:auto;">
                                                <!-- Các option sẽ được thêm bằng JavaScript -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="shipping_address">Địa chỉ cụ thể (Số nhà, tên đường...) <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="shipping_address" name="shipping_address"
                                    value="{{ old('shipping_address') }}" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="customer_note">Ghi chú đơn hàng (tùy chọn)</label>
                            <textarea class="form-control" id="customer_note" name="customer_note" rows="3">{{ old('customer_note') }}</textarea>
                        </div>
                    </div>

                    <div class="col-lg-5">
                        <div class="order-summary sticky-top">
                            <h4>Tóm tắt đơn hàng</h4>
                            @foreach ($cart['items'] as $item)
                                <div class="summary-item">
                                    <img src="{{ asset($item['image_url'] ?? 'images/products/no-image.png') }}" alt="{{ $item['product']['name'] ?? 'Sản phẩm' }}">
                                    <div class="product-info">
                                        <div class="product-name">{{ $item['product']['name'] ?? 'Sản phẩm' }}</div>
                                        <div class="product-qty">Số lượng: {{ $item['quantity'] ?? 1 }}</div>
                                    </div>
                                    <div class="product-price">
                                        {{ number_format(($item['price_at_addition'] ?? 0) * ($item['quantity'] ?? 1), 0, ',', '.') }}đ
                                    </div>
                                </div>
                            @endforeach

                            <hr>

                            <div class="mt-4">
                                <h5>Phương thức vận chuyển</h5>
                                <div class="form-group">
                                    <select name="shipping_method_id" class="form-control" required>
                                        <option value="">-- Chọn phương thức vận chuyển --</option>
                                        @foreach ($shippingMethods as $method)
                                            <option value="{{ $method->id }}" data-cost="{{ $method->cost }}">
                                                {{ $method->name }} - {{ number_format($method->cost, 0, ',', '.') }}đ
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="mt-4">
                                <h5>Phương thức thanh toán</h5>
                                <div class="form-group">
                                    <select name="payment_method_id" class="form-control" required>
                                        <option value="">-- Chọn phương thức thanh toán --</option>
                                        @foreach ($paymentMethods as $method)
                                            <option value="{{ $method->id }}">{{ $method->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                                          </div>
                              <div class="totals-row mt-4">
                                <span>Tạm tính</span>
                                <span>{{ number_format($cart['total'] ?? 0, 0, ',', '.') }}đ</span>
                            </div>
                            <div class="totals-row" id="discount-row" style="{{ ($cart['discount'] ?? 0) > 0 ? '' : 'display: none;' }}">
                                <span>Giảm giá<span id="discount-code-text">{{ ($cart['discount_code'] ?? '') ? ' (' . ($cart['discount_code'] ?? '') . ')' : '' }}</span></span>
                                <span style="color:#ff3029;" id="discount-amount">-{{ number_format($cart['discount'] ?? 0, 0, ',', '.') }}đ</span>
                            </div>
                            <div class="totals-row">
                                <span>Phí vận chuyển</span>
                                <span id="shipping-fee-display">0đ</span>
                            </div>
                            <div class="totals-row grand-total">
                                <span>Tổng cộng</span>
                                <span id="grand-total-display">
                                    {{ number_format(($cart['total'] ?? 0) - ($cart['discount'] ?? 0), 0, ',', '.') }}đ
                                </span>
                            </div>
                            <button type="submit" class="btn-checkout">
                                <i class='bx bx-credit-card' style="margin-right:8px; font-size:18px;"></i>
                                Hoàn tất đơn hàng
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <!-- JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', async function () {
        let wardsData = [];

        // Lấy danh sách phường/xã từ file JSON
        const getWardsFromFile = async () => {
            try {
                const response = await axios.get('/data/hanoi-districts.json');
                const hanoiData = response.data.find(t => t.tentinhmoi === 'Thành phố Hà Nội');
                return hanoiData ? hanoiData.phuongxa : [];
            } catch (error) {
                console.error("Lỗi khi tải danh sách phường/xã:", error);
                return [];
            }
        }

        // Render phường/xã ra dropdown
        const renderWards = (array, selectId) => {
            let options = '<option value="">-- Chọn phường/xã --</option>';
            // Sắp xếp theo bảng chữ cái
            const sortedArray = [...array].sort((a, b) => a.tenphuongxa.localeCompare(b.tenphuongxa));
            sortedArray.forEach(item => {
                options += `<option data-code="${item.maphuongxa}" value="${item.tenphuongxa}">${item.tenphuongxa}</option>`;
            });
            document.getElementById(selectId).innerHTML = options;
        }

        const buyerWardSelect = document.getElementById('buyer_ward_search');
        const shippingWardSelect = document.getElementById('shipping_ward_search');
        const shipToDifferentAddressCheckbox = document.getElementById('ship_to_different_address');
        const shippingInfoSection = document.getElementById('shipping_info');

        // Hàm khởi tạo địa chỉ nếu đã đăng nhập
        async function initializeUserAddress() {
            const userWard = `{{ auth()->check() ? auth()->user()->ward : '' }}`;
            const userAddress = `{{ auth()->check() ? auth()->user()->address : '' }}`;

            try {
                // Điền thông tin ward nếu có
                if (userWard && buyerWardSelect) {
                    buyerWardSelect.value = userWard;
                    // Cũng set giá trị cho hidden input
                    const buyerWardHidden = document.getElementById('buyer_ward_hidden');
                    if (buyerWardHidden) {
                        buyerWardHidden.value = userWard;
                    }
                }
                
                // Điền thông tin địa chỉ nếu có
                if (userAddress) {
                    const buyerAddressInput = document.getElementById('buyer_address');
                    if (buyerAddressInput) {
                        buyerAddressInput.value = userAddress;
                    }
                }
                
                // Nếu không có thông tin địa chỉ, bỏ thuộc tính required để tránh validation error
                if (!userWard || !userAddress) {
                    const buyerWardHidden = document.getElementById('buyer_ward_hidden');
                    const buyerAddressInput = document.getElementById('buyer_address');
                    
                    if (buyerWardHidden) buyerWardHidden.removeAttribute('required');
                    if (buyerAddressInput) buyerAddressInput.removeAttribute('required');
                }
            } catch (error) {
                console.error("Lỗi khi tải địa chỉ:", error);
            }
        }

        // Load dữ liệu phường/xã
        wardsData = await getWardsFromFile();
        allWards = wardsData; // Cập nhật biến global cho dropdown

        // Nếu có user đăng nhập → khởi tạo địa chỉ
        if (`{{ auth()->check() }}`) {
            await initializeUserAddress();
        }
        
        // Nếu không có thông tin địa chỉ, tự động điền địa chỉ mặc định
        if (`{{ auth()->check() }}`) {
            const buyerWardHidden = document.getElementById('buyer_ward_hidden');
            const buyerAddressInput = document.getElementById('buyer_address');
            
            // Nếu không có ward, điền ward mặc định
            if (buyerWardHidden && !buyerWardHidden.value.trim()) {
                buyerWardHidden.value = 'Ba Đình';
                const buyerWardSearch = document.getElementById('buyer_ward_search');
                if (buyerWardSearch) buyerWardSearch.value = 'Ba Đình';
            }
            
            // Nếu không có địa chỉ, điền địa chỉ mặc định
            if (buyerAddressInput && !buyerAddressInput.value.trim()) {
                buyerAddressInput.value = 'Số 1, Đường ABC';
            }
            
            // Đảm bảo các trường có giá trị sẽ có thuộc tính required
            if (buyerWardHidden && buyerWardHidden.value.trim()) {
                buyerWardHidden.setAttribute('required', 'required');
            }
            if (buyerAddressInput && buyerAddressInput.value.trim()) {
                buyerAddressInput.setAttribute('required', 'required');
            }
        }

        // Khởi tạo trạng thái shipping fields
        const shipToDifferentAddress = document.getElementById('ship_to_different_address');
        if (shipToDifferentAddress && !shipToDifferentAddress.checked) {
            const shippingFields = ['shipping_name', 'shipping_email', 'shipping_phone', 'shipping_address', 'shipping_ward_hidden'];
            shippingFields.forEach(field => {
                const input = document.getElementById(field);
                if (input) {
                    input.removeAttribute('required');
                }
            });
        }

        // Toggle phần địa chỉ giao hàng khác
        shipToDifferentAddressCheckbox?.addEventListener('change', function () {
            shippingInfoSection.style.display = this.checked ? 'block' : 'none';

            const shippingFields = ['shipping_name', 'shipping_email', 'shipping_phone',
                'shipping_address', 'shipping_ward_hidden'
            ];
            shippingFields.forEach(field => {
                const input = document.getElementById(field);
                if (input) {
                    input.required = this.checked;
                    // Thêm/bỏ class để hiển thị visual feedback
                    if (this.checked) {
                        input.classList.add('required-field');
                    } else {
                        input.classList.remove('required-field');
                        input.value = ''; // Clear values when unchecked
                        input.removeAttribute('required'); // Xóa required attribute khi unchecked
                    }
                }
            });
        });

        // Tính phí vận chuyển
        const shippingSelect = document.querySelector('select[name="shipping_method_id"]');
        const shippingFeeDisplay = document.getElementById('shipping-fee-display');
        const grandTotalDisplay = document.getElementById('grand-total-display');
        const subtotal = {{ $cart['total'] }};
        let currentDiscount = {{ $cart['discount'] ?? 0 }};

        function updateGrandTotal() {
            const selectedOption = shippingSelect.options[shippingSelect.selectedIndex];
            const cost = parseFloat(selectedOption.dataset.cost) || 0;
            const grandTotal = subtotal + cost - currentDiscount;
            shippingFeeDisplay.textContent = cost.toLocaleString('vi-VN') + 'đ';
            grandTotalDisplay.textContent = grandTotal.toLocaleString('vi-VN') + 'đ';

            const discountRow = document.getElementById('discount-row');
            const discountAmount = document.getElementById('discount-amount');
            const discountCodeText = document.getElementById('discount-code-text');
            if (discountRow && discountAmount) {
                if (currentDiscount > 0) {
                    discountRow.style.display = 'flex';
                    discountAmount.textContent = '-' + currentDiscount.toLocaleString('vi-VN') + 'đ';
                    if (discountCodeText) {
                        const discountCode = '{{ $cart['discount_code'] ?? '' }}';
                        discountCodeText.textContent = discountCode ? ' (' + discountCode + ')' : '';
                    }
                } else {
                    discountRow.style.display = 'none';
                }
            }
        }

        updateGrandTotal();
        shippingSelect?.addEventListener('change', updateGrandTotal);

        // Xử lý chọn địa chỉ đã lưu
        const savedAddressSelect = document.getElementById('saved_address');
        if (savedAddressSelect) {
            savedAddressSelect.addEventListener('change', async function () {
                const selectedOption = this.options[this.selectedIndex];

                const buyerNameInput = document.getElementById('buyer_name');
                const buyerPhoneInput = document.getElementById('buyer_phone');
                const buyerEmailInput = document.getElementById('buyer_email');
                const buyerAddressInput = document.getElementById('buyer_address');
                const buyerWardSearch = document.getElementById('buyer_ward_search');
                const buyerWardHidden = document.getElementById('buyer_ward_hidden');

                if (!selectedOption.value) {
                    buyerNameInput.value = '{{ old('buyer_name', auth()->user()->full_name ?? '') }}';
                    buyerPhoneInput.value = '{{ old('buyer_phone', auth()->user()->phone_number ?? '') }}';
                    buyerEmailInput.value = '{{ old('buyer_email', auth()->user()->email ?? '') }}';
                    buyerAddressInput.value = '{{ old('buyer_address', auth()->user()->address ?? '') }}';
                    if (buyerWardSearch) buyerWardSearch.value = '';
                    if (buyerWardHidden) buyerWardHidden.value = '';
                    await initializeUserAddress();
                    return;
                }

                buyerNameInput.value = selectedOption.dataset.name;
                buyerPhoneInput.value = selectedOption.dataset.phone;
                buyerEmailInput.value = selectedOption.dataset.email;
                buyerAddressInput.value = selectedOption.dataset.address;

                const selectedWard = selectedOption.dataset.ward;
                if (buyerWardSearch) buyerWardSearch.value = selectedWard;
                if (buyerWardHidden) buyerWardHidden.value = selectedWard;

                // Validate that all required fields are filled
                if (!selectedOption.dataset.name || !selectedOption.dataset.phone || 
                    !selectedOption.dataset.email || !selectedOption.dataset.address || 
                    !selectedWard) {
                    alert('Địa chỉ đã lưu không đầy đủ thông tin. Vui lòng kiểm tra lại.');
                    return;
                }

                // Remove any validation errors
                [buyerNameInput, buyerPhoneInput, buyerEmailInput, buyerAddressInput, buyerWardSearch, buyerWardHidden].forEach(input => {
                    if (input) input.classList.remove('required-field');
                });
            });
        }

        // Xử lý chọn địa chỉ đã lưu cho shipping
        const shippingSavedAddressSelect = document.getElementById('shipping_saved_address');
        if (shippingSavedAddressSelect) {
            shippingSavedAddressSelect.addEventListener('change', function () {
                const selectedOption = this.options[this.selectedIndex];

                const shippingNameInput = document.getElementById('shipping_name');
                const shippingPhoneInput = document.getElementById('shipping_phone');
                const shippingEmailInput = document.getElementById('shipping_email');
                const shippingAddressInput = document.getElementById('shipping_address');
                const shippingWardSearch = document.getElementById('shipping_ward_search');
                const shippingWardHidden = document.getElementById('shipping_ward_hidden');

                if (!selectedOption.value) {
                    // Reset về trống
                    if (shippingNameInput) shippingNameInput.value = '';
                    if (shippingPhoneInput) shippingPhoneInput.value = '';
                    if (shippingEmailInput) shippingEmailInput.value = '';
                    if (shippingAddressInput) shippingAddressInput.value = '';
                    if (shippingWardSearch) shippingWardSearch.value = '';
                    if (shippingWardHidden) shippingWardHidden.value = '';
                    return;
                }

                if (shippingNameInput) shippingNameInput.value = selectedOption.dataset.name;
                if (shippingPhoneInput) shippingPhoneInput.value = selectedOption.dataset.phone;
                if (shippingEmailInput) shippingEmailInput.value = selectedOption.dataset.email;
                if (shippingAddressInput) shippingAddressInput.value = selectedOption.dataset.address;

                const selectedWard = selectedOption.dataset.ward;
                if (shippingWardSearch) shippingWardSearch.value = selectedWard;
                if (shippingWardHidden) shippingWardHidden.value = selectedWard;

                // Validate that all required fields are filled
                if (!selectedOption.dataset.name || !selectedOption.dataset.phone || 
                    !selectedOption.dataset.email || !selectedOption.dataset.address || 
                    !selectedWard) {
                    alert('Địa chỉ đã lưu không đầy đủ thông tin. Vui lòng kiểm tra lại.');
                    return;
                }

                // Remove any validation errors
                [shippingNameInput, shippingPhoneInput, shippingEmailInput, shippingAddressInput, shippingWardSearch, shippingWardHidden].forEach(input => {
                    if (input) input.classList.remove('required-field');
                });
            });
        }

        // Form submit validation
        const checkoutForm = document.querySelector('.checkout-form');
        if (checkoutForm) {
            checkoutForm.addEventListener('submit', function(e) {
                // Validate buyer fields
                const buyerFields = ['buyer_name', 'buyer_phone', 'buyer_email', 'buyer_address', 'buyer_ward_hidden'];
                let isValid = true;

                buyerFields.forEach(field => {
                    const input = document.getElementById(field);
                    if (input && input.hasAttribute('required') && !input.value.trim()) {
                        isValid = false;
                        input.classList.add('required-field');
                        if (isValid) input.focus();
                    } else if (input) {
                        input.classList.remove('required-field');
                    }
                });

                // Validate payment and shipping methods
                const paymentMethod = document.querySelector('select[name="payment_method_id"]');
                const shippingMethod = document.querySelector('select[name="shipping_method_id"]');

                if (paymentMethod && paymentMethod.required && !paymentMethod.value) {
                    isValid = false;
                    paymentMethod.classList.add('required-field');
                    if (isValid) paymentMethod.focus();
                } else if (paymentMethod) {
                    paymentMethod.classList.remove('required-field');
                }

                if (shippingMethod && shippingMethod.required && !shippingMethod.value) {
                    isValid = false;
                    shippingMethod.classList.add('required-field');
                    if (isValid) shippingMethod.focus();
                } else if (shippingMethod) {
                    shippingMethod.classList.remove('required-field');
                }

                // Validate shipping fields if checkbox is checked
                const shipToDifferentAddress = document.getElementById('ship_to_different_address');
                if (shipToDifferentAddress && shipToDifferentAddress.checked) {
                    const shippingFields = ['shipping_name', 'shipping_email', 'shipping_phone', 'shipping_address', 'shipping_ward_hidden'];
                    
                    shippingFields.forEach(field => {
                        const input = document.getElementById(field);
                        if (input && input.hasAttribute('required') && !input.value.trim()) {
                            isValid = false;
                            input.classList.add('required-field');
                            if (isValid) input.focus();
                        } else if (input) {
                            input.classList.remove('required-field');
                        }
                    });
                }

                if (!isValid) {
                    e.preventDefault();
                    alert('Vui lòng điền đầy đủ thông tin bắt buộc.');
                    return false;
                }
            });
        }
    });
    
    // ===== JAVASCRIPT CHO DROPDOWN TÌM KIẾM PHƯỜNG/XÃ =====
    
    // Biến lưu trữ dữ liệu địa chỉ
    let addressData = [];
    let allWards = [];
    
    // Hàm hiển thị dropdown tìm kiếm
    function showWardDropdown(type) {
        const dropdown = document.getElementById(`${type}_ward_dropdown`);
        const optionsContainer = document.getElementById(`${type}_ward_options`);
        
        if (dropdown && optionsContainer) {
            // Hiển thị tất cả phường/xã ban đầu
            renderWardOptions(allWards, optionsContainer, type);
            dropdown.style.display = 'block';
        }
    }
    
    // Hàm ẩn dropdown tìm kiếm
    function hideWardDropdown(type) {
        const dropdown = document.getElementById(`${type}_ward_dropdown`);
        if (dropdown) {
            dropdown.style.display = 'none';
        }
    }
    
    // Hàm render options cho dropdown
    function renderWardOptions(wards, container, type) {
        if (!container) return;
        
        container.innerHTML = '';
        
        if (wards.length === 0) {
            container.innerHTML = '<div style="padding:12px; text-align:center; color:#6b7280; font-size:14px;">Không tìm thấy phường/xã phù hợp</div>';
            return;
        }
        
        wards.forEach(ward => {
            const option = document.createElement('div');
            option.className = 'ward-option';
            option.style.cssText = 'padding:10px 12px; cursor:pointer; border-bottom:1px solid #f3f4f6; transition:background-color 0.2s; font-size:14px;';
            option.textContent = ward.tenphuongxa;
            option.dataset.value = ward.tenphuongxa;
            
            option.addEventListener('mouseenter', function() {
                this.style.backgroundColor = '#f9fafb';
            });
            
            option.addEventListener('mouseleave', function() {
                this.style.backgroundColor = 'transparent';
            });
            
            option.addEventListener('mousedown', function(e) {
                e.preventDefault();
                selectWard(ward.tenphuongxa, type);
            });
            
            container.appendChild(option);
        });
    }
    
    // Hàm chọn phường/xã
    function selectWard(wardName, type) {
        const searchInput = document.getElementById(`${type}_ward_search`);
        const hiddenInput = document.getElementById(`${type}_ward_hidden`);
        
        if (searchInput) searchInput.value = wardName;
        if (hiddenInput) hiddenInput.value = wardName;
        
        hideWardDropdown(type);
    }
    
    // Hàm tìm kiếm phường/xã
    function searchWards(query, type) {
        const filteredWards = allWards.filter(ward => 
            ward.tenphuongxa.toLowerCase().includes(query.toLowerCase())
        );
        
        const optionsContainer = document.getElementById(`${type}_ward_options`);
        renderWardOptions(filteredWards, optionsContainer, type);
    }
    
    // Hàm tải dữ liệu địa chỉ từ JSON
    async function loadAddressData() {
        try {
            const response = await fetch('/data/hanoi-districts.json');
            if (!response.ok) {
                throw new Error('Không thể tải dữ liệu: ' + response.statusText);
            }
            
            const data = await response.json();
            addressData = data;
            
            if (data && data.length > 0) {
                const hanoiData = data[0];
                
                if (hanoiData && hanoiData.phuongxa) {
                    let phuongxaList = [...hanoiData.phuongxa];
                    
                    // Sắp xếp phường/xã theo bảng chữ cái
                    phuongxaList.sort((a, b) => {
                        return a.tenphuongxa.localeCompare(b.tenphuongxa);
                    });
                    
                    allWards = phuongxaList;
                    setupSearchEvents();
                }
            }
        } catch (error) {
            console.error("Lỗi khi tải dữ liệu địa chỉ:", error);
        }
    }
    
    // Thiết lập sự kiện tìm kiếm
    function setupSearchEvents() {
        // Sự kiện cho buyer ward
        const buyerSearchInput = document.getElementById('buyer_ward_search');
        if (buyerSearchInput) {
            buyerSearchInput.addEventListener('input', function() {
                const query = this.value.trim();
                if (query.length > 0) {
                    searchWards(query, 'buyer');
                } else {
                    const optionsContainer = document.getElementById('buyer_ward_options');
                    renderWardOptions(allWards, optionsContainer, 'buyer');
                }
            });
        }
        
        // Sự kiện cho shipping ward
        const shippingSearchInput = document.getElementById('shipping_ward_search');
        if (shippingSearchInput) {
            shippingSearchInput.addEventListener('input', function() {
                const query = this.value.trim();
                if (query.length > 0) {
                    searchWards(query, 'shipping');
                } else {
                    const optionsContainer = document.getElementById('shipping_ward_options');
                    renderWardOptions(allWards, optionsContainer, 'shipping');
                }
            });
        }
    }
    
    // Xử lý click outside để đóng dropdown
    document.addEventListener('click', function(e) {
        const buyerDropdown = document.getElementById('buyer_ward_dropdown');
        const shippingDropdown = document.getElementById('shipping_ward_dropdown');
        const buyerSearch = document.getElementById('buyer_ward_search');
        const shippingSearch = document.getElementById('shipping_ward_search');
        
        if (buyerDropdown && buyerSearch && !buyerDropdown.contains(e.target) && !buyerSearch.contains(e.target)) {
            hideWardDropdown('buyer');
        }
        
        if (shippingDropdown && shippingSearch && !shippingDropdown.contains(e.target) && !shippingSearch.contains(e.target)) {
            hideWardDropdown('shipping');
        }
    });
    
    // Ngăn chặn sự kiện click trong dropdown
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('ward-option')) {
            e.stopPropagation();
        }
    });
    
    // Load dữ liệu khi trang load
    loadAddressData();
</script>

@endsection
