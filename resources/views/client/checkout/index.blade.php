@extends('client.layout.client')

@section('title', 'Thanh toán')

<style>
    .checkout-form .form-group {
        margin-bottom: 1.5rem;
    }

    .checkout-form .form-control {
        height: 48px;
        border-radius: 8px;
        border: 1px solid #ddd;
        padding: 0 15px;
    }

    .checkout-form .form-control:focus {
        border-color: #ff3029;
        box-shadow: 0 0 0 0.2rem rgba(255, 48, 41, 0.25);
    }

    .order-summary {
        background: #f9f9f9;
        padding: 30px;
        border-radius: 10px;
        border: 1px solid #eee;
    }

    .order-summary h4 {
        font-weight: 600;
        margin-bottom: 20px;
        border-bottom: 1px solid #ddd;
        padding-bottom: 15px;
    }

    .summary-item {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
    }

    .summary-item img {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 8px;
        margin-right: 15px;
    }

    .summary-item .product-info {
        flex-grow: 1;
    }

    .summary-item .product-info .product-name {
        font-weight: 500;
        margin-bottom: 5px;
    }

    .summary-item .product-info .product-qty {
        color: #666;
        font-size: 14px;
    }

    .summary-item .product-price {
        font-weight: 500;
    }

    .totals-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
        font-size: 16px;
    }

    .totals-row.grand-total {
        font-weight: bold;
        font-size: 20px;
        color: #ff3029;
        margin-top: 15px;
        padding-top: 15px;
        border-top: 1px solid #ddd;
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
</style>

@section('content')
    @php
        $steps = [['label' => 'Giỏ hàng', 'key' => 'cart'], ['label' => 'Thanh toán', 'key' => 'checkout']];
        $currentStep = 'checkout';
    @endphp
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
                                            data-province="{{ $address->province ?? '' }}"
                                            data-district="{{ $address->district ?? '' }}"
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
                            <div class="col-md-4 form-group">
                                <label for="buyer_province">Tỉnh/Thành phố <span class="text-danger">*</span></label>
                                <select class="form-control" id="buyer_province_disabled" name="buyer_province_disabled"
                                    required disabled>
                                    <option value="Thành phố Hà Nội">Thành phố Hà Nội</option>
                                </select>
                                <input type="hidden" name="buyer_province" value="Thành phố Hà Nội">
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="buyer_district">Quận/Huyện <span class="text-danger">*</span></label>
                                <select class="form-control" id="buyer_district" name="buyer_district" required>
                                    <option value="">-- Vui lòng chọn --</option>
                                </select>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="buyer_ward">Phường/Xã <span class="text-danger">*</span></label>
                                <select class="form-control" id="buyer_ward" name="buyer_ward" required>
                                    <option value="">-- Chọn --</option>
                                </select>
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
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label for="shipping_name">Họ và tên <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="shipping_name" name="shipping_name"
                                        value="{{ old('shipping_name') }}">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="shipping_email">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" id="shipping_email" name="shipping_email"
                                        value="{{ old('shipping_email') }}">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="shipping_phone">Số điện thoại <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="shipping_phone" name="shipping_phone"
                                        value="{{ old('shipping_phone') }}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <label for="shipping_province">Tỉnh/Thành phố <span
                                            class="text-danger">*</span></label>
                                    <select class="form-control" id="shipping_province_disabled"
                                        name="shipping_province_disabled" disabled>
                                        <option value="Thành phố Hà Nội">Thành phố Hà Nội</option>
                                    </select>
                                    <input type="hidden" name="shipping_province" value="Thành phố Hà Nội">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="shipping_district">Quận/Huyện <span class="text-danger">*</span></label>
                                    <select class="form-control" id="shipping_district" name="shipping_district">
                                        <option value="">-- Vui lòng chọn --</option>
                                    </select>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="shipping_ward">Phường/Xã <span class="text-danger">*</span></label>
                                    <select class="form-control" id="shipping_ward" name="shipping_ward">
                                        <option value="">-- Chọn --</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="shipping_address">Địa chỉ cụ thể (Số nhà, tên đường...) <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="shipping_address" name="shipping_address"
                                    value="{{ old('shipping_address') }}">
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
                                    <img src="{{ asset($item['image_url']) }}" alt="{{ $item['product']['name'] }}">
                                    <div class="product-info">
                                        <div class="product-name">{{ $item['product']['name'] }}</div>
                                        <div class="product-qty">Số lượng: {{ $item['quantity'] }}</div>
                                    </div>
                                    <div class="product-price">
                                        {{ number_format($item['price_at_addition'] * $item['quantity'], 0, ',', '.') }}đ
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
                                <span>{{ number_format($cart['total'], 0, ',', '.') }}đ</span>
                            </div>
                            <div class="totals-row">
                                <span>Phí vận chuyển</span>
                                <span id="shipping-fee-display">0đ</span>
                            </div>
                            <div class="totals-row grand-total">
                                <span>Tổng cộng</span>
                                <span id="grand-total-display">{{ number_format($cart['total'], 0, ',', '.') }}đ</span>
                            </div>

                            <button type="submit"
                                class="tf-btn w-100 btn-fill animate-hover-btn radius-3 justify-content-center mt-4">
                                <span>Hoàn tất đơn hàng</span>
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
        document.addEventListener('DOMContentLoaded', function() {
            const host = "https://provinces.open-api.vn/api/";
            const hanoiCode = 1; // Mã của Hà Nội

            var callApiDistrict = (api) => {
                return axios.get(api);
            }

            var callApiWard = (api) => {
                return axios.get(api);
            }

            var renderData = (array, selectId) => {
                let row = '<option value="">-- Chọn --</option>';
                array.forEach(element => {
                    row +=
                        `<option data-code="${element.code}" value="${element.name}">${element.name}</option>`
                });
                document.getElementById(selectId).innerHTML = row;
            }

            const buyerDistrictSelect = document.getElementById('buyer_district');
            const buyerWardSelect = document.getElementById('buyer_ward');
            const shippingDistrictSelect = document.getElementById('shipping_district');
            const shippingWardSelect = document.getElementById('shipping_ward');
            const shipToDifferentAddressCheckbox = document.getElementById('ship_to_different_address');
            const shippingInfoSection = document.getElementById('shipping_info');

            // Hàm khởi tạo địa chỉ cho người dùng đã đăng nhập
            async function initializeUserAddress() {
                const userDistrict = `{{ auth()->check() ? auth()->user()->district : '' }}`;
                const userWard = `{{ auth()->check() ? auth()->user()->ward : '' }}`;

                try {
                    // Tải quận/huyện cho cả hai form
                    const districtResponse = await callApiDistrict(host + "p/" + hanoiCode + "?depth=2");
                    renderData(districtResponse.data.districts, "buyer_district");
                    renderData(districtResponse.data.districts, "shipping_district");

                    // Nếu người dùng có quận đã lưu, chọn nó
                    if (userDistrict) {
                        buyerDistrictSelect.value = userDistrict;

                        // Lấy mã quận để tải phường/xã
                        const districtCode = buyerDistrictSelect.options[buyerDistrictSelect.selectedIndex]
                            ?.dataset.code;
                        if (districtCode) {
                            const wardResponse = await callApiWard(host + "d/" + districtCode + "?depth=2");
                            renderData(wardResponse.data.wards, "buyer_ward");

                            // Nếu người dùng có phường đã lưu, chọn nó
                            if (userWard) {
                                buyerWardSelect.value = userWard;
                            }
                        }
                    }
                } catch (error) {
                    console.error("Lỗi khi tải địa chỉ:", error);
                }
            }

            // Chạy hàm khởi tạo nếu người dùng đã đăng nhập, ngược lại chỉ tải quận/huyện
            if (`{{ auth()->check() }}`) {
                initializeUserAddress();
            } else {
                callApiDistrict(host + "p/" + hanoiCode + "?depth=2").then(res => {
                    renderData(res.data.districts, "buyer_district");
                    renderData(res.data.districts, "shipping_district");
                });
            }

            // Khi chọn quận/huyện -> tải phường/xã cho buyer
            buyerDistrictSelect.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                if (selectedOption.dataset.code) {
                    callApiWard(host + "d/" + selectedOption.dataset.code + "?depth=2").then(res => {
                        renderData(res.data.wards, "buyer_ward");
                    });
                } else {
                    buyerWardSelect.innerHTML = '<option value="">-- Chọn --</option>';
                }
            });

            // Khi chọn quận/huyện -> tải phường/xã cho shipping
            shippingDistrictSelect.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                if (selectedOption.dataset.code) {
                    callApiWard(host + "d/" + selectedOption.dataset.code + "?depth=2").then(res => {
                        renderData(res.data.wards, "shipping_ward");
                    });
                } else {
                    shippingWardSelect.innerHTML = '<option value="">-- Chọn --</option>';
                }
            });

            // Toggle shipping form visibility
            shipToDifferentAddressCheckbox.addEventListener('change', function() {
                shippingInfoSection.style.display = this.checked ? 'block' : 'none';
                // Update required attributes based on checkbox state
                const shippingFields = ['shipping_name', 'shipping_email', 'shipping_phone',
                    'shipping_address', 'shipping_district', 'shipping_ward'
                ];
                shippingFields.forEach(field => {
                    const input = document.getElementById(field);
                    if (input) input.required = this.checked;
                });
            });

            // Shipping fee calculation
            const shippingSelect = document.querySelector('select[name="shipping_method_id"]');
            const shippingFeeDisplay = document.getElementById('shipping-fee-display');
            const grandTotalDisplay = document.getElementById('grand-total-display');
            const subtotal = {{ $cart['total'] }};
            shippingSelect.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                const cost = parseFloat(selectedOption.dataset.cost) || 0;
                shippingFeeDisplay.textContent = cost.toLocaleString('vi-VN') + 'đ';
                grandTotalDisplay.textContent = (subtotal + cost).toLocaleString('vi-VN') + 'đ';
            });

            // Handle saved address selection
            const savedAddressSelect = document.getElementById('saved_address');
            if (savedAddressSelect) {
                savedAddressSelect.addEventListener('change', async function() {
                    const selectedOption = this.options[this.selectedIndex];

                    // Lấy các element của form NGƯỜI MUA
                    const buyerNameInput = document.getElementById('buyer_name');
                    const buyerPhoneInput = document.getElementById('buyer_phone');
                    const buyerEmailInput = document.getElementById('buyer_email');
                    const buyerAddressInput = document.getElementById('buyer_address');
                    const buyerDistrictSelect = document.getElementById('buyer_district');
                    const buyerWardSelect = document.getElementById('buyer_ward');

                    if (!selectedOption.value) {
                        // Nếu chọn "-- Nhập địa chỉ mới --", khôi phục thông tin người dùng mặc định
                        buyerNameInput.value =
                            '{{ old('buyer_name', auth()->user()->full_name ?? '') }}';
                        buyerPhoneInput.value =
                            '{{ old('buyer_phone', auth()->user()->phone_number ?? '') }}';
                        buyerEmailInput.value =
                        '{{ old('buyer_email', auth()->user()->email ?? '') }}';
                        buyerAddressInput.value =
                            '{{ old('buyer_address', auth()->user()->address ?? '') }}';
                        // Gọi lại hàm khởi tạo để chọn lại địa chỉ mặc định của user nếu có
                        await initializeUserAddress();
                        return;
                    }

                    // Điền thông tin từ địa chỉ đã lưu vào form NGƯỜI MUA
                    buyerNameInput.value = selectedOption.dataset.name;
                    buyerPhoneInput.value = selectedOption.dataset.phone;
                    buyerEmailInput.value = selectedOption.dataset.email;
                    buyerAddressInput.value = selectedOption.dataset.address;

                    // Lấy và tự động chọn Tỉnh/Huyện/Xã cho form NGƯỜI MUA
                    const selectedDistrict = selectedOption.dataset.district;
                    const selectedWard = selectedOption.dataset.ward;

                    // Chọn đúng quận/huyện
                    buyerDistrictSelect.value = selectedDistrict;

                    // Tải danh sách phường/xã tương ứng và chọn đúng phường/xã
                    const districtCode = Array.from(buyerDistrictSelect.options).find(opt => opt
                        .value === selectedDistrict)?.dataset.code;
                    if (districtCode) {
                        const wardResponse = await callApiWard(host + "d/" + districtCode + "?depth=2");
                        renderData(wardResponse.data.wards, "buyer_ward");
                        buyerWardSelect.value = selectedWard;
                    } else {
                        buyerWardSelect.innerHTML = '<option value="">-- Chọn --</option>';
                    }
                });
            }
        });
    </script>
@endsection