@extends('client.profile.profile_base')

@section('content_profile')
    <div class="my-account-content account-address">

        <h3 class="section-heading">Quản lý địa chỉ của tôi</h3>
        <p class="section-description">Thêm, chỉnh sửa hoặc xóa các địa chỉ giao hàng của bạn.</p>
        <hr class="my-4"> {{-- Thêm class my-4 cho khoảng cách tốt hơn --}}

        <div class="text-center widget-inner-address">
            <div class="address-action-bar">
                <button class="tf-btn btn-main btn-address" id="btnShowAddAddress">
                    <i class='bx bx-plus-circle'></i> Thêm địa chỉ mới
                </button>
            </div>
            <div class="address-form-wrapper card-style" style="display:none;" id="formnewAddressWrapper">
                <form class="address-form" id="formnewAddress" action="{{ route('client.profile.address.store') }}" method="POST">
                    @csrf
                    <div class="form-title text-center mb-4">
                        <i class="bx bx-map-pin" style="color:#ff3029;font-size:2em;"></i>
                        <span style="font-size:1.3em;font-weight:700;color:#222;">Thông tin địa chỉ mới</span>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="receiver_name" name="receiver_name" value="{{ old('receiver_name') }}" placeholder="Họ và tên" required>
                                <label for="receiver_name">Họ và tên</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="receiver_phone" name="receiver_phone" value="{{ old('receiver_phone') }}" placeholder="Số điện thoại" required>
                                <label for="receiver_phone">Số điện thoại</label>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3 mt-2">
                        <div class="col-md-4">
                            <div class="form-floating">
                                <select class="form-control" id="add_province_disabled" name="province_disabled" disabled>
                                    <option value="Thành phố Hà Nội">Thành phố Hà Nội</option>
                                </select>
                                <input type="hidden" name="province" value="Thành phố Hà Nội">
                                <label for="add_province_disabled">Tỉnh/Thành phố</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <select class="form-control" id="add_district" name="district" required>
                                    <option value="">-- Chọn --</option>
                                </select>
                                <label for="add_district">Quận/Huyện</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <select class="form-control" id="add_ward" name="ward" required>
                                    <option value="">-- Phường/Xã --</option>
                                </select>
                                <label for="add_ward">Phường/Xã</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-floating mt-3">
                        <input type="text" class="form-control" id="street_address" name="street_address" value="{{ old('street_address') }}" placeholder="Địa chỉ cụ thể" required>
                        <label for="street_address">Địa chỉ cụ thể</label>
                    </div>
                    <div class="form-check mt-3 text-start">
                        <input class="form-check-input" type="checkbox" id="check-new-address" name="is_default" value="1" {{ old('is_default') ? 'checked' : '' }}>
                        <label class="form-check-label" for="check-new-address">Đặt làm địa chỉ mặc định</label>
                    </div>
                    <div class="d-flex align-items-center justify-content-center gap-3 mt-4">
                        <button type="submit" class="tf-btn btn-main">Lưu địa chỉ</button>
                        <span class="tf-btn btn-light" id="btnHideAddAddress" style="cursor:pointer">Hủy</span>
                    </div>
                </form>
            </div>

            <div class="list-account-address">
                @forelse($addresses as $address)
                    <div class="account-address-item1" style="border-bottom:1px solid #eee; padding:16px;">
                        <div>
                            <strong>{{ $address->receiver_name }}</strong>
                            <span style="color:gray;">| {{ $address->receiver_phone }}</span>
                        </div>
                        <div>{{ $address->street_address }}</div>
                        @if ($address->is_default)
                            <div>
                                <span
                                    style="color:#e74c3c; border:1px solid #e74c3c; border-radius:3px; padding:2px 6px; font-size:12px;">Mặc
                                    định</span>
                            </div>
                        @endif
                        <div style="margin-top:8px;">
                            <a href="" class="edit-address-btn" data-id="{{ $address->id }}"
                                style="color:#3498db; margin-right:8px;">Cập nhật</a>
                            <form action="{{ route('client.profile.address.destroy', $address->id) }}" method="POST"
                                class="d-inline delete-address-form" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    style="color:#e74c3c; background:none; border:none; cursor:pointer;">Xóa</button>
                            </form>
                            @if (!$address->is_default)
                                <form action="{{ route('client.profile.address.setDefault', $address->id) }}"
                                    method="POST" class="d-inline set-default-address-form" style="display:inline;">
                                    @csrf
                                    <button type="submit"
                                        style="border:1px solid #888; border-radius:3px; padding:2px 8px; background:#fff; cursor:pointer;">Thiết
                                        lập mặc định</button>
                                </form>
                            @endif
                        </div>
                    </div>
                @empty
                @endforelse
            </div>

        </div>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div id="editAddressModal"
        style="display:none; position:fixed; left:0; top:0; width:100vw; height:100vh; background:rgba(0,0,0,0.3); z-index:9999; align-items:center; justify-content:center;">
        <div
            style="background:#fff; padding:32px; border-radius:8px; min-width:350px; max-width:90vw; margin:auto; position:relative;">
            <h4>Cập nhật địa chỉ</h4>
            <form id="editAddressForm">
                @csrf
                <input type="hidden" id="edit_address_id">
                <div class="box-field">
                    <div class="tf-field style-1">
                        <input class="tf-field-input tf-input" type="text" name="receiver_name"
                            id="edit_receiver_name" required placeholder=" ">
                        <label class="tf-field-label fw-4 text_black-2">Họ và tên</label>
                    </div>
                </div>
                <div class="box-field">
                    <div class="tf-field style-1">
                        <input class="tf-field-input tf-input" type="text" name="receiver_phone"
                            id="edit_receiver_phone" required placeholder=" ">
                        <label class="tf-field-label fw-4 text_black-2">Số điện thoại</label>
                    </div>
                </div>
                <div class="d-flex gap-3 mb-3">
                    <div class="box-field w-100">
                        <div class="tf-field style-1">
                            <select class="tf-field-input tf-input" name="province_disabled" id="edit_province_disabled"
                                disabled>
                                <option value="Thành phố Hà Nội">Thành phố Hà Nội</option>
                            </select>
                            <label class="tf-field-label fw-4 text_black-2">Tỉnh/Thành phố</label>
                        </div>
                    </div>
                    <div class="box-field w-100">
                        <div class="tf-field style-1">
                            <select class="tf-field-input tf-input" name="district" id="edit_district" required>
                                <option value="">-- Quận/Huyện --</option>
                            </select>
                            <label class="tf-field-label fw-4 text_black-2">Quận/Huyện</label>
                        </div>
                    </div>
                    <div class="box-field w-100">
                        <div class="tf-field style-1">
                            <select class="tf-field-input tf-input" name="ward" id="edit_ward" required>
                                <option value="">-- Phường/Xã --</option>
                            </select>
                            <label class="tf-field-label fw-4 text_black-2">Phường/Xã</label>
                        </div>
                    </div>
                </div>
                <div class="box-field">
                    <div class="tf-field style-1">
                        <input class="tf-field-input tf-input" type="text" name="street_address"
                            id="edit_street_address" required placeholder=" ">
                        <label class="tf-field-label fw-4 text_black-2">Địa chỉ cụ thể</label>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-center gap-20" style="margin-top:16px;">
                    <button type="submit" class="tf-btn btn-fill animate-hover-btn">Lưu thay đổi</button>
                    <span class="tf-btn btn-fill animate-hover-btn" id="closeEditModal"
                        style="cursor:pointer; background:#eee; color:#333;">Hủy</span>
                </div>
            </form>
        </div>
    </div>
    {{-- Bắt đầu lại các script của bạn, không thay đổi gì --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
    <script>
        document.getElementById('btnShowAddAddress').onclick = function() {
            document.getElementById('formnewAddressWrapper').style.display = 'block';
            this.style.display = 'none';
        };
        document.getElementById('btnHideAddAddress').onclick = function() {
            document.getElementById('formnewAddressWrapper').style.display = 'none';
            document.getElementById('btnShowAddAddress').style.display = 'inline-block';
        };
    </script>
    <script>
        // Hàm render dữ liệu cho select
        function renderData(array, selectId) {
            let selectElement = document.getElementById(selectId);
            selectElement.innerHTML = '<option value="">-- Chọn --</option>';
            array.forEach(element => {
                let option = document.createElement('option');
                option.value = element.name;
                option.textContent = element.name;
                option.dataset.code = element.code;
                selectElement.appendChild(option);
            });
        }

        // Hàm lấy danh sách phường/xã theo quận/huyện
        function getWardsByDistrict(districtCode) {
            return fetch('/data/hanoi-districts.json')
                .then(response => response.json())
                .then(data => {
                    const district = data.districts.find(d => d.code === districtCode);
                    return district ? district.wards : [];
                });
        }

        // Tải quận/huyện cho form THÊM MỚI khi trang load
        fetch('/data/hanoi-districts.json')
            .then(response => response.json())
            .then(data => {
                renderData(data.districts, "add_district");
            });

        // Khi chọn quận/huyện -> tải phường/xã cho form THÊM MỚI
        document.getElementById('add_district').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            if (selectedOption && selectedOption.dataset.code) {
                getWardsByDistrict(selectedOption.dataset.code)
                    .then(wards => {
                        renderData(wards, "add_ward");
                    });
            } else {
                document.getElementById('add_ward').innerHTML = '<option value="">-- Phường/Xã --</option>';
            }
        });

        // Khi chọn quận/huyện -> tải phường/xã cho form CẬP NHẬT
        document.getElementById('edit_district').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            if (selectedOption && selectedOption.dataset.code) {
                getWardsByDistrict(selectedOption.dataset.code)
                    .then(wards => {
                        renderData(wards, "edit_ward");
                    });
            } else {
                document.getElementById('edit_ward').innerHTML = '<option value="">-- Phường/Xã --</option>';
            }
        });

        document.getElementById('formnewAddress').onsubmit = async function(e) {
            e.preventDefault();
            let form = this;
            let data = new FormData(form);

            // Xóa thông báo lỗi cũ
            let alertDiv = document.querySelector('.alert.alert-danger');
            if (alertDiv) alertDiv.remove();

            // Gửi AJAX
            let response = await fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                    'Accept': 'application/json'
                },
                body: data
            });

            if (response.status === 422) {
                let result = await response.json();
                // Hiển thị lỗi
                let errorHtml = '<div class="alert alert-danger"><ul>';
                Object.values(result.errors).forEach(function(msgArr) {
                    msgArr.forEach(function(msg) {
                        errorHtml += '<li>' + msg + '</li>';
                    });
                });
                errorHtml += '</ul></div>';
                form.insertAdjacentHTML('beforebegin', errorHtml);
                // Giữ lại dữ liệu đã nhập (không cần làm gì thêm, input vẫn giữ nguyên)
            } else if (response.ok) {
                // Thành công, có thể reset form, ẩn form, hiện lại danh sách, v.v.
                alert('Thêm địa chỉ thành công!');
                location.reload();
            }
        };
    </script>
    <script>
        document.querySelectorAll('.delete-address-form').forEach(form => {
            form.onsubmit = async function(e) {
                e.preventDefault();
                if (!confirm('Bạn chắc chắn muốn xóa địa chỉ này?')) return;
                let response = await fetch(this.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': this.querySelector('input[name="_token"]').value,
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: new FormData(this)
                });
                let result = await response.json();
                if (result.success) {
                    alert('Xóa địa chỉ thành công!');
                    location.reload();
                }
            }
        });
        document.querySelectorAll('.set-default-address-form').forEach(form => {
            form.onsubmit = async function(e) {
                e.preventDefault();
                let response = await fetch(this.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': this.querySelector('input[name="_token"]').value,
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: new FormData(this)
                });
                let result = await response.json();
                if (result.success) {
                    alert('Đã thiết lập địa chỉ mặc định thành công!');
                    location.reload();
                }
            }
        });
        document.querySelectorAll('.edit-address-btn').forEach(btn => {
            btn.onclick = async function(e) {
                e.preventDefault();
                let id = this.dataset.id;
                let url = '{{ route('client.profile.address.edit', ['address' => ':id']) }}'.replace(':id',
                    id);
                let response = await fetch(url);
                let addressData = await response.json();

                // Điền thông tin cơ bản
                document.getElementById('edit_address_id').value = addressData.id;
                document.getElementById('edit_receiver_name').value = addressData.receiver_name;
                document.getElementById('edit_receiver_phone').value = addressData.receiver_phone;
                document.getElementById('edit_street_address').value = addressData.street_address;

                // Xử lý dropdown địa chỉ
                const editDistrictSelect = document.getElementById('edit_district');
                const editWardSelect = document.getElementById('edit_ward');

                // Tải danh sách quận/huyện từ JSON local
                const response = await fetch('/data/hanoi-districts.json');
                const data = await response.json();
                renderData(data.districts, 'edit_district');
                editDistrictSelect.value = addressData.district;

                // Tìm district code dựa vào tên district
                const selectedDistrict = data.districts.find(d => d.name === addressData.district);
                if (selectedDistrict) {
                    // Tải danh sách phường/xã từ district đã chọn
                    renderData(selectedDistrict.wards, 'edit_ward');
                    editWardSelect.value = addressData.ward;
                }

                document.getElementById('editAddressModal').style.display = 'flex';
            }
        });
        document.getElementById('closeEditModal').onclick = function() {
            document.getElementById('editAddressModal').style.display = 'none';
        };
        document.getElementById('editAddressForm').onsubmit = async function(e) {
            e.preventDefault();
            let id = document.getElementById('edit_address_id').value;
            let formData = new FormData(this);
            let url = '{{ route('client.profile.address.update', ['address' => ':id']) }}'.replace(':id', id);
            let res = await fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': this.querySelector('input[name="_token"]').value,
                    'Accept': 'application/json'
                },
                body: formData
            });
            if (res.status === 422) {
                let data = await res.json();
                alert(Object.values(data.errors).flat().join('\n'));
            } else {
                alert('Cập nhật địa chỉ thành công!');
                location.reload();
            }
        };

        // --- Thêm JS cho API Tỉnh/Thành ---
        const host = "https://provinces.open-api.vn/api/";
        const hanoiCode = 1;

        var renderData = (array, selectId) => {
            let selectElement = document.getElementById(selectId);
            selectElement.innerHTML = '<option value="">-- Chọn --</option>';
            array.forEach(element => {
                let option = document.createElement("option");
                option.text = element.name;
                option.value = element.name;
                option.setAttribute("data-code", element.code); // ⚠️ BẮT BUỘC
                selectElement.appendChild(option);
            });
        }


        // Tải quận/huyện cho form THÊM MỚI khi trang load
        axios.get(host + "p/" + hanoiCode + "?depth=2").then(res => {
            renderData(res.data.districts, "add_district");
        });

        // Khi chọn quận/huyện -> tải phường/xã cho form THÊM MỚI
        document.getElementById('add_district').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            if (selectedOption.dataset.code) {
                axios.get(host + "d/" + selectedOption.dataset.code + "?depth=2").then(res => {
                    renderData(res.data.wards, "add_ward");
                });
            }
        });

        // Khi chọn quận/huyện -> tải phường/xã cho form CẬP NHẬT
        document.getElementById('edit_district').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            if (selectedOption.dataset.code) {
                axios.get(host + "d/" + selectedOption.dataset.code + "?depth=2").then(res => {
                    renderData(res.data.wards, "edit_ward");
                });
            }
        });
    </script>
@endsection

{{-- Thêm CSS mới vào đây (hoặc vào file CSS của bạn) --}}
<style>
    /* ========================================================================== */
    /* BỔ SUNG & TỐI ƯU CSS CHO TRANG ĐỊA CHỈ (ADDRESS) */
    /* ========================================================================== */
    .right {
        background-color: #ffffff;
        /* Nền trắng */
        border-radius: 12px;
        /* Bo tròn góc nhiều hơn */
        box-shadow: 0 5px 35px rgb(16 16 16 / 46%);
        /* Bóng đổ mạnh và rõ ràng hơn */
        padding: 25px 20px;
        /* Đệm trên dưới */
        display: flex;
        flex-direction: column;
        overflow: hidden;
        /* Ngăn chặn nội dung tràn ra ngoài nếu quá lớn */
    }

    /* Tiêu đề trang Địa chỉ */
    .section-heading {
        font-size: 2.2em;
        /* Kích thước lớn hơn */
        font-weight: 700;
        /* Rất đậm */
        color: #212529;
        /* Màu tối hơn cho sự sang trọng */
        margin-bottom: 10px;
        position: relative;
        /* Để tạo đường gạch dưới giả */
        padding-bottom: 10px;
        /* Khoảng cách cho đường gạch */
    }

    .section-description {
        font-size: 1.1em;
        /* Kích thước dễ đọc */
        color: #6c757d;
        /* Màu xám dịu */
        margin-bottom: 25px;
        /* Khoảng cách với HR */
    }

    /* Nút "Thêm địa chỉ mới" */
    .btn-address {
        padding: 12px 25px;
        font-size: 1.05em;
        font-weight: 600;
        display: inline-flex;
        /* Để căn chỉnh icon và text */
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        /* Bo tròn góc */
        box-shadow: 0 4px 15px rgba(255, 48, 41, 0.2);
        /* Bóng đổ nhẹ */
        transition: all 0.3s ease;
    }

    .btn-address i {
        font-size: 1.3em;
        margin-right: 8px;
        /* Khoảng cách giữa icon và text */
    }

    .btn-address:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(255, 48, 41, 0.3);
    }

    /* Form thêm địa chỉ mới (wd-form-address) */
    .wd-form-address {
        background-color: #fcfcfc;
        /* Nền trắng sáng hơn */
        border: 1px solid #e9ecef;
        /* Viền mỏng nhẹ */
        border-radius: 12px;
        /* Bo tròn góc */
        padding: 30px;
        /* Đệm lớn hơn bên trong form */
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
        /* Bóng đổ đẹp hơn */
        margin-bottom: 30px;
        /* Khoảng cách từ form đến list địa chỉ */
        display: flex;
        /* Use flexbox for better layout control */
        flex-direction: column;
        /* Stack items vertically */
        gap: 1.5rem;
        /* Consistent spacing between form fields */
    }

    .form-section-title {
        margin-bottom: 15px;
        /* Adjust margin to fit with gap */
        padding-bottom: 15px;
        border-bottom: 1px dashed #e0e0e0;
        /* Viền nét đứt nhẹ */
        text-align: center;
    }

    .form-section-title h4 {
        font-size: 1.5em;
        font-weight: 700;
        color: #444;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .form-section-title h4 i {
        color: #ff3029;
        /* Màu đỏ của theme */
        margin-right: 10px;
        font-size: 1.2em;
    }

    /* Các trường input trong form địa chỉ */
    .wd-form-address .box-field {
        margin-bottom: 0;
        /* Remove default margin as flex gap handles it */
    }

    /* Styling for tf-field style-1 */
    .tf-field.style-1 {
        position: relative;
        width: 100%;
        /* Ensure it takes full width of its parent */
    }

    .tf-field-input {
        border: 1px solid #ced4da;
        border-radius: 8px;
        padding: 12px 15px;
        font-size: 1em;
        height: auto;
        /* Ensure height adjusts to content */
        width: 100%;
        /* Make input fill the container */
        transition: all 0.3s ease;
        background-color: #fff;
        /* Ensure white background */
        color: #343a40;
        /* Darker text for readability */
        box-sizing: border-box;
        /* Include padding and border in the element's total width and height */
    }

    .tf-field-input:focus {
        border-color: #ff3029;
        /* Màu viền focus */
        box-shadow: 0 0 0 0.2rem rgba(255, 48, 41, 0.25);
        /* Bóng đổ focus */
        outline: none;
        /* Remove default outline */
    }

    .tf-field-label {
        position: absolute;
        top: 50%;
        left: 15px;
        transform: translateY(-50%);
        font-weight: 600;
        color: #6c757d;
        /* Softer color for label */
        pointer-events: none;
        /* Allow clicks through the label to the input */
        transition: all 0.2s ease;
        background-color: transparent;
        /* Ensure no background to hide input */
        padding: 0 5px;
        /* Slight padding to create a visual break when animated */
    }

    /* Move label up and shrink when input is focused or has content */
    .tf-field-input:focus+.tf-field-label,
    .tf-field-input:not(:placeholder-shown)+.tf-field-label {
        top: 0;
        font-size: 0.8em;
        /* Smaller font size */
        color: #ff3029;
        /* Highlight label color on focus */
        transform: translateY(-50%);
        background-color: #fcfcfc;
        /* Match form background for a "floating" effect */
        padding: 0 5px;
        /* Ensure padding for background color */
    }

    /* Specific styling for select inputs */
    .tf-field-input.tf-input[name="district"],
    .tf-field-input.tf-input[name="ward"],
    .tf-field-input.tf-input[name="province_disabled"] {
        appearance: none;
        /* Remove default select arrow */
        -webkit-appearance: none;
        -moz-appearance: none;
        background-image: url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22292.4%22%20height%3D%22292.4%22%3E%3Cpath%20fill%3D%22%236c757d%22%20d%3D%22M287%2C197.89c0.4%2C-0.4%2C0.6%2C-1%2C0.6%2C-1.6s-0.2%2C-1.2-0.6%2C-1.6l-140-140c-0.8%2C-0.8-2-0.8-2.8%2C0l-140%2C140c-0.8%2C0.8-0.8%2C2%2C0%2C2.8c0.4%2C0.4%2C1%2C0.6%2C1.4%2C0.6s1-0.2%2C1.4-0.6L146.2%2C62.89L285.6%2C197.89C286.2%2C198.49%2C286.6%2C198.69%2C287%2C197.89z%22%2F%3E%3C%2Fsvg%3E');
        /* Custom arrow */
        background-repeat: no-repeat;
        background-position: right 15px center;
        background-size: 10px;
        padding-right: 35px;
        /* Space for the custom arrow */
    }


    /* Checkbox "Đặt làm địa chỉ mặc định" */
    .box-checkbox {
        padding-left: 0;
        margin-bottom: 1.5rem;
        display: flex;
        /* Use flex for alignment */
        align-items: center;
        /* Vertically align items */
        gap: 8px;
        /* Space between checkbox and label */
    }

    .tf-check {
        width: 1.2em;
        height: 1.2em;
        margin-top: 0;
        /* Remove default margin-top */
        vertical-align: middle;
        background-color: #fff;
        border: 1px solid #ced4da;
        border-radius: 0.25em;
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        cursor: pointer;
        display: inline-block;
        transition: all 0.2s ease;
        flex-shrink: 0;
        /* Prevent checkbox from shrinking */
    }

    .tf-check:checked {
        background-color: #ff3029;
        border-color: #ff3029;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3e%3cpath fill='none' stroke='%23fff' stroke-linecap='round' stroke-linejoin='round' stroke-width='3' d='M6 10l3 3l6-6'/%3e%3c/svg%3e");
        background-size: 100% 100%;
        background-position: center;
        background-repeat: no-repeat;
    }

    .box-checkbox label {
        margin-bottom: 0;
        color: #333;
        font-weight: 500;
        cursor: pointer;
        display: inline;
        /* Keep inline for text flow */
    }

    /* Nút trong form (Lưu địa chỉ, Hủy) */
    .wd-form-address .d-flex.align-items-center.justify-content-center.gap-20 {
        margin-top: 10px;
        /* Adjust spacing above buttons */
    }

    .wd-form-address .tf-btn {
        min-width: 150px;
        font-size: 1.05em;
        font-weight: 600;
        border-radius: 8px;
        padding: 12px 20px;
    }

    .wd-form-address .tf-btn.btn-hide-address {
        background-color: #e9ecef !important;
        color: #6c757d !important;
        border: 1px solid #ced4da !important;
    }

    .wd-form-address .tf-btn.btn-hide-address:hover {
        background-color: #dee2e6 !important;
        color: #495057 !important;
    }


    /* Danh sách địa chỉ (list-account-address) */
    .list-account-address {
        margin-top: 30px;
        /* Khoảng cách từ form */
    }

    .account-address-item1 {
        border: 1px solid #e9ecef;
        /* Viền mỏng */
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        /* Bóng đổ nhẹ */
        transition: all 0.2s ease-in-out;
        padding: 20px;
        /* Thêm padding vào đây để nội dung không dính sát */
        margin-bottom: 15px;
        /* Khoảng cách giữa các item */
        background-color: #fff;
        text-align: left;
        /* Đảm bảo text align trái */
    }

    .account-address-item1:hover {
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        /* Nổi bật hơn khi hover */
        transform: translateY(-2px);
    }

    .account-address-item1 strong {
        font-weight: 700;
        color: #333;
        margin-bottom: 0;
    }

    .account-address-item1 span[style*="color:gray"] {
        font-size: 0.95em;
        line-height: 1.6;
    }

    .account-address-item1 span[style*="color:#e74c3c"] {
        background-color: #ff3029;
        /* Màu đỏ của theme */
        color: white !important;
        /* Đảm bảo màu chữ trắng */
        font-weight: 600;
        padding: 4px 8px;
        border-radius: 50rem;
        /* Bo tròn hoàn toàn */
        font-size: 0.8em;
        border: none !important;
        /* Bỏ viền cũ */
        display: inline-block;
        /* Để padding hoạt động */
        margin-left: 10px;
        /* Khoảng cách từ số điện thoại */
    }

    /* Nút hành động trong mỗi địa chỉ */
    .account-address-item1 .d-inline {
        display: inline-block !important;
        /* Ensure forms are inline */
        margin-left: 8px;
        /* Space between action buttons */
    }

    .account-address-item1 a,
    .account-address-item1 button {
        padding: 6px 12px;
        font-size: 0.9em;
        border-radius: 6px;
        font-weight: 500;
        text-decoration: none;
        display: inline-block;
        /* Ensure can apply padding/margin */
        border: 1px solid transparent;
        /* Transparent border by default */
        transition: all 0.2s ease;
        cursor: pointer;
        /* Indicate clickable */
    }

    .account-address-item1 a.edit-address-btn {
        background-color: #3498db;
        border-color: #3498db;
        color: white !important;
    }

    .account-address-item1 a.edit-address-btn:hover {
        background-color: #2980b9;
        border-color: #2980b9;
    }

    .account-address-item1 button[type="submit"][style*="color:#e74c3c"] {
        /* Nút Xóa */
        background-color: #e74c3c !important;
        border-color: #e74c3c !important;
        color: white !important;
        padding: 6px 12px;
        border-radius: 6px;
    }

    .account-address-item1 button[type="submit"][style*="color:#e74c3c"]:hover {
        background-color: #c0392b !important;
        border-color: #c0392b !important;
    }

    .account-address-item1 button[type="submit"][style*="border:1px solid #888"] {
        /* Nút Thiết lập mặc định */
        border: 1px solid #6c757d !important;
        color: #6c757d !important;
        background-color: transparent !important;
        padding: 6px 12px;
        border-radius: 6px;
    }

    .account-address-item1 button[type="submit"][style*="border:1px solid #888"]:hover {
        background-color: #6c757d !important;
        color: white !important;
    }


    /* ================== */
    /* Modal Styling (tùy chỉnh cho modal bạn đang dùng) */
    /* ================== */
    #editAddressModal {
        display: flex;
        /* Đảm bảo modal được căn giữa khi hiển thị */
        align-items: center;
        justify-content: center;
    }

    #editAddressModal>div {
        /* Phần nội dung bên trong modal */
        background: #fff;
        padding: 32px;
        border-radius: 8px;
        min-width: 350px;
        max-width: 90vw;
        margin: auto;
        position: relative;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        border: none;
        /* Bỏ viền cũ */
    }

    #editAddressModal h4 {
        font-size: 1.5em;
        font-weight: 600;
        color: #333;
        margin-bottom: 20px;
        text-align: center;
    }

    #editAddressModal .box-field {
        margin-bottom: 15px;
    }

    #editAddressModal .tf-field-input,
    #editAddressModal select.tf-field-input {
        border-radius: 10px !important;
        border: 1.5px solid #e0e0e0;
        padding: 14px 18px;
        font-size: 1.08em;
        background: #fafbfc;
        color: #222;
        transition: border 0.2s, box-shadow 0.2s;
        box-shadow: none;
    }

    #editAddressModal .tf-field-input:focus,
    #editAddressModal select.tf-field-input:focus {
        border-color: #ff3029;
        background: #fff;
        box-shadow: 0 0 0 0.15rem rgba(255, 48, 41, 0.13);
        outline: none;
    }

    #editAddressModal .tf-field-label {
        color: #888;
        font-weight: 500;
        font-size: 1em;
        left: 18px;
        top: 50%;
        transform: translateY(-50%);
        background: transparent;
        transition: all 0.2s;
        pointer-events: none;
    }

    #editAddressModal .tf-field-input:focus + .tf-field-label,
    #editAddressModal .tf-field-input:not(:placeholder-shown) + .tf-field-label {
        top: 0;
        font-size: 0.85em;
        color: #ff3029;
        background: #fff;
        padding: 0 4px;
    }

    #editAddressModal .tf-btn {
        min-width: 120px;
    }

    #closeEditModal {
        background-color: #f0f2f5 !important;
        color: #6c757d !important;
        border: 1px solid #e0e0e0 !important;
    }

    #closeEditModal:hover {
        background-color: #e0e0e0 !important;
        color: #333 !important;
    }

    /* PHẦN CSS MỚI CHO THÔNG BÁO ĐỊA CHỈ TRỐNG */
    .empty-address-message {
        text-align: center;
        /* Căn giữa nội dung */
        padding: 40px 20px;
        /* Khoảng đệm lớn hơn */
        margin-top: 30px;
        /* Khoảng cách với các phần tử khác */
        color: #777;
        /* Màu chữ nhẹ nhàng */
        font-size: 1.1em;
        line-height: 1.6;
        display: flex;
        /* Dùng flexbox để căn giữa icon và text */
        flex-direction: column;
        /* Xếp theo cột: icon trên, text dưới */
        align-items: center;
        /* Căn giữa theo chiều ngang */
        justify-content: center;
        /* Căn giữa theo chiều dọc nếu có không gian */
        background-color: transparent;
        /* Loại bỏ background */
        border: none;
        /* Loại bỏ border */
        box-shadow: none;
        /* Loại bỏ shadow */
    }

    .empty-address-message i.bx {
        font-size: 4.5em;
        /* Kích thước icon lớn hơn một chút */
        color: #ffaa00;
        /* Màu vàng cam nổi bật */
        margin-bottom: 15px;
        animation: pulse 1.5s infinite;
        /* Thêm hiệu ứng nhấp nháy nhẹ */
    }

    @keyframes pulse {
        0% {
            transform: scale(1);
            opacity: 0.8;
        }

        50% {
            transform: scale(1.05);
            opacity: 1;
        }

        100% {
            transform: scale(1);
            opacity: 0.8;
        }
    }

    .empty-address-message p {
        font-size: 1.4em;
        /* Tiêu đề lớn hơn */
        font-weight: 700;
        color: #333;
        margin-bottom: 10px;
    }

    .empty-address-message span {
        font-size: 1.1em;
        color: #666;
        max-width: 80%;
        /* Giới hạn chiều rộng để text không quá dài */
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .wd-form-address .d-flex.gap-3.mb-3 {
            flex-direction: column;
            gap: 1.5rem;
            /* Maintain consistent gap */
        }

        .wd-form-address .d-flex.gap-3.mb-3 .box-field.w-100 {
            width: 100%;
            /* Ensure full width on smaller screens */
        }

        .wd-form-address .d-flex.align-items-center.justify-content-center.gap-20 {
            flex-direction: column;
            gap: 15px;
            /* Adjust button spacing */
        }

        .wd-form-address .tf-btn {
            width: 100%;
            min-width: unset;
        }
    }

    /* New styles for the address form wrapper */
    .address-form-wrapper {
        padding: 32px 24px;
        margin: 0 auto 32px auto;
        max-width: 700px;
    }

    .address-form-title {
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4em;
        font-weight: 700;
        color: #222;
        margin-bottom: 24px;
        gap: 10px;
    }

    .address-form-title i {
        color: #ff3029;
        font-size: 1.5em;
    }

    .form-floating>label {
        color: #888;
    }

    .btn-dark {
        background: #000;
        color: #fff;
        border-radius: 8px;
        font-weight: 600;
        border: none;
    }

    .btn-dark:hover {
        background: #222;
    }

    .btn-light {
        background: #f3f3f3;
        color: #333;
        border-radius: 8px;
        font-weight: 600;
        border: 1px solid #ddd;
    }

    .btn-light:hover {
        background: #e9ecef;
    }

    .address-form .form-check {
        text-align: left !important;
        margin-left: 2px;
    }

    .tf-btn {
        display: inline-block;
        font-weight: 600;
        border-radius: 8px;
        padding: 12px 32px;
        font-size: 1.08em;
        border: none;
        transition: all 0.2s;
        cursor: pointer;
        text-align: center;
    }

    .tf-btn.btn-main {
        background: linear-gradient(90deg, #ff3029 60%, #ff7e5f 100%);
        color: #fff !important;
        box-shadow: 0 4px 15px rgba(255, 48, 41, 0.13);
    }

    .tf-btn.btn-main:hover {
        background: linear-gradient(90deg, #ff7e5f 60%, #ff3029 100%);
        color: #fff !important;
        transform: translateY(-2px) scale(1.03);
        box-shadow: 0 8px 24px rgba(255, 48, 41, 0.18);
    }

    .tf-btn.btn-light {
        background: #f3f3f3 !important;
        color: #333 !important;
        border: 1px solid #ddd;
    }

    .tf-btn.btn-light:hover {
        background: #e9ecef !important;
        color: #ff3029 !important;
    }

    .address-form-wrapper.card-style {
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 8px 32px rgba(0,0,0,0.10);
        padding: 40px 32px 32px 32px;
        max-width: 600px;
        margin: 32px auto;
        border: none;
    }
    .form-title {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }
    .form-floating > label {
        color: #888;
        font-weight: 500;
    }
    .form-control, .form-select {
        border-radius: 10px !important;
        border: 1.5px solid #e0e0e0;
        font-size: 1.08em;
        background: #fafbfc;
        color: #222;
        transition: border 0.2s, box-shadow 0.2s;
        box-shadow: none;
    }
    .form-control:focus, .form-select:focus {
        border-color: #ff3029;
        background: #fff;
        box-shadow: 0 0 0 0.15rem rgba(255, 48, 41, 0.13);
        outline: none;
    }
    .form-check-input {
        border-radius: 4px;
        border: 1.5px solid #ff3029;
        width: 1.2em;
        height: 1.2em;
        margin-right: 8px;
    }
    .form-check-input:checked {
        background-color: #ff3029;
        border-color: #ff3029;
    }
</style>
