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
        $steps = [
            ['label' => 'Giỏ hàng', 'key' => 'cart'],
            ['label' => 'Thanh toán', 'key' => 'checkout'],
        ];
        $currentStep = 'checkout';
    @endphp
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
                        <h4>Thông tin giao hàng</h4>

                        @if (auth()->check() && !empty($addresses))
                            <div class="form-group">
                                <label for="saved_address">Chọn địa chỉ đã lưu</label>
                                <select id="saved_address" class="form-control">
                                    <option value="">-- Nhập địa chỉ mới --</option>
                                    @foreach ($addresses as $index => $address)
                                        <option value="{{ $index }}"
                                            data-name="{{ $address['name'] ?? '' }}"
                                            data-phone="{{ $address['phone'] ?? '' }}"
                                            data-email="{{ $address['email'] ?? '' }}"
                                            data-address="{{ $address['address'] ?? '' }}"
                                            data-province="{{ $address['province'] ?? '' }}"
                                            data-district="{{ $address['district'] ?? '' }}"
                                            data-ward="{{ $address['ward'] ?? '' }}">
                                            {{ $address['name'] }} - {{ $address['address'] }}, {{ $address['ward'] }}, {{ $address['district'] }}, {{ $address['province'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label for="customer_name">Họ và tên <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="customer_name" name="customer_name" value="{{ old('customer_name', auth()->user()->full_name ?? '') }}" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="customer_email">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="customer_email" name="customer_email" value="{{ old('customer_email', auth()->user()->email ?? '') }}" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="customer_phone">Số điện thoại <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="customer_phone" name="customer_phone" value="{{ old('customer_phone', auth()->user()->phone ?? '') }}" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label for="province">Tỉnh/Thành phố <span class="text-danger">*</span></label>
                                <!-- Giới hạn chỉ Hà Nội, thêm input ẩn để gửi dữ liệu -->
                                <select class="form-control" id="province_disabled" name="province_disabled" required disabled>
                                    <option value="Thành phố Hà Nội">Thành phố Hà Nội</option>
                                </select>
                                <input type="hidden" name="province" value="Thành phố Hà Nội">
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="district">Quận/Huyện <span class="text-danger">*</span></label>
                                <select class="form-control" id="district" name="district" required>
                                    <option value="">-- Vui lòng chọn --</option>
                                </select>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="ward">Phường/Xã <span class="text-danger">*</span></label>
                                <select class="form-control" id="ward" name="ward" required></select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="shipping_address">Địa chỉ cụ thể (Số nhà, tên đường...) <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="shipping_address" name="shipping_address" value="{{ old('shipping_address') }}" required>
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
                                    <div class="product-price">{{ number_format($item['price_at_addition'] * $item['quantity'], 0, ',', '.') }}đ</div>
                                </div>
                            @endforeach

                            <hr>

                            <div class="mt-4">
                                <h5>Phương thức vận chuyển</h5>
                                @foreach ($shippingMethods as $method)
                                    <label class="shipping-method d-flex align-items-center">
                                        <input type="radio" name="shipping_method_id" value="{{ $method->id }}" data-cost="{{ $method->cost }}" required>
                                        <span>{{ $method->name }} - {{ number_format($method->cost, 0, ',', '.') }}đ</span>
                                    </label>
                                @endforeach
                            </div>

                            <div class="mt-4">
                                <h5>Phương thức thanh toán</h5>
                                @foreach ($paymentMethods as $method)
                                    <label class="payment-method d-flex align-items-center">
                                        <input type="radio" name="payment_method_id" value="{{ $method->id }}" required>
                                        <span>{{ $method->name }}</span>
                                    </label>
                                @endforeach
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

                            <button type="submit" class="tf-btn w-100 btn-fill animate-hover-btn radius-3 justify-content-center mt-4">
                                <span>Hoàn tất đơn hàng</span>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const host = "https://provinces.open-api.vn/api/";
            const hanoiCode = 1; // Mã của Hà Nội

            var callApiDistrict = (api) => {
                return axios.get(api).then((response) => {
                    renderData(response.data.districts, "district");
                });
            }

            var callApiWard = (api) => {
                return axios.get(api).then((response) => {
                    renderData(response.data.wards, "ward");
                });
            }

            var renderData = (array, selectId) => {
                let row = '<option value="">-- Chọn --</option>';
                array.forEach(element => {
                    row += `<option data-code="${element.code}" value="${element.name}">${element.name}</option>`
                });
                document.getElementById(selectId).innerHTML = row;
            }

            // Tải danh sách quận/huyện của Hà Nội khi trang được tải
            callApiDistrict(host + "p/" + hanoiCode + "?depth=2");

            // Khi chọn quận/huyện -> tải phường/xã
            document.getElementById('district').addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                if (selectedOption.dataset.code) {
                    callApiWard(host + "d/" + selectedOption.dataset.code + "?depth=2");
                } else {
                    document.getElementById('ward').innerHTML = '<option value="">-- Chọn --</option>';
                }
            });

            // Shipping fee calculation
            const shippingRadios = document.querySelectorAll('input[name="shipping_method_id"]');
            const shippingFeeDisplay = document.getElementById('shipping-fee-display');
            const grandTotalDisplay = document.getElementById('grand-total-display');
            const subtotal = {{ $cart['total'] }};
            shippingRadios.forEach(radio => {
                radio.addEventListener('change', function() {
                    const cost = parseFloat(this.dataset.cost);
                    shippingFeeDisplay.textContent = cost.toLocaleString('vi-VN') + 'đ';
                    grandTotalDisplay.textContent = (subtotal + cost).toLocaleString('vi-VN') + 'đ';
                });
            });

            // Handle saved address selection
            const savedAddressSelect = document.getElementById('saved_address');
            if (savedAddressSelect) {
                savedAddressSelect.addEventListener('change', async function() {
                    const selectedOption = this.options[this.selectedIndex];

                    // Lấy các element của form
                    const nameInput = document.getElementById('customer_name');
                    const phoneInput = document.getElementById('customer_phone');
                    const emailInput = document.getElementById('customer_email');
                    const addressInput = document.getElementById('shipping_address');
                    const districtSelect = document.getElementById('district');
                    const wardSelect = document.getElementById('ward');

                    if (!selectedOption.value) {
                        // Nếu chọn "-- Nhập địa chỉ mới --", reset form về thông tin user (nếu có)
                        nameInput.value = `{{ auth()->check() ? auth()->user()->full_name : '' }}`;
                        phoneInput.value = `{{ auth()->check() ? auth()->user()->phone : '' }}`;
                        emailInput.value = `{{ auth()->check() ? auth()->user()->email : '' }}`;
                        addressInput.value = '';
                        await callApiDistrict(host + "p/" + hanoiCode + "?depth=2"); // Tải lại quận huyện Hà Nội
                        wardSelect.innerHTML = '<option value="">-- Chọn --</option>';
                        return;
                    }

                    // Điền thông tin cơ bản từ địa chỉ đã lưu
                    nameInput.value = selectedOption.dataset.name;
                    phoneInput.value = selectedOption.dataset.phone;
                    emailInput.value = selectedOption.dataset.email;
                    addressInput.value = selectedOption.dataset.address;

                    // Lấy tên tỉnh, huyện, xã từ data-attributes
                    const districtName = selectedOption.dataset.district;
                    const wardName = selectedOption.dataset.ward;

                    // Vì chỉ bán ở Hà Nội, ta chỉ cần xử lý quận/huyện và phường/xã
                    if (districtName) {
                        // Tải lại danh sách quận/huyện để đảm bảo có data-code
                        await callApiDistrict(host + "p/" + hanoiCode + "?depth=2");
                        districtSelect.value = districtName;

                        // Trigger change để tải phường/xã, hoặc gọi trực tiếp
                        const districtCode = districtSelect.options[districtSelect.selectedIndex]?.dataset.code;
                        if (districtCode) {
                            await callApiWard(host + "d/" + districtCode + "?depth=2");
                            wardSelect.value = wardName;
                        }
                    }
                });
            }
        });
    </script>
@endsection
