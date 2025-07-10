@extends('client.profile.index')
@php $pageTitle = 'Thông tin tài khoản'; @endphp

@section('title', 'Thông tin tài khoản')

@section('content_profile')
    <div class="my-account-content">
        <style>
            .form-group { margin-bottom: 1.5rem; }
        </style>
                <h3>Thông tin tài khoản</h3>
                <p>Quản lý thông tin hồ sơ để bảo mật tài khoản</p>
                <hr>

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('client.profile.account.update') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="full_name">Họ và tên</label>
                                <input type="text" class="form-control" id="full_name" name="full_name" value="{{ old('full_name', $user->full_name) }}" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">Số điện thoại</label>
                                <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $user->phone) }}" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                            </div>

                            <hr>
                            <h5>Địa chỉ mặc định</h5>
                            <div class="form-group">
                                <label for="province">Tỉnh/Thành phố</label>
                                <select class="form-control" disabled>
                                    <option>Thành phố Hà Nội</option>
                                </select>
                                <input type="hidden" name="province" value="Thành phố Hà Nội">
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="district">Quận/Huyện</label>
                                    <select class="form-control" id="district" name="district"></select>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="ward">Phường/Xã</label>
                                    <select class="form-control" id="ward" name="ward"></select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="address">Địa chỉ cụ thể (Số nhà, tên đường...)</label>
                                <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $user->address) }}">
                            </div>

                            <hr>
                            <h5 id="change-password-section">Đổi mật khẩu</h5>
                             <div class="form-group">
                                <label for="password">Mật khẩu mới</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Bỏ trống nếu không muốn đổi">
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Xác nhận mật khẩu mới</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                            </div>

                            <button type="submit" class="tf-btn btn-fill animate-hover-btn radius-3">Lưu thay đổi</button>
                        </div>
                    </div>
                </form>
    </div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const host = "https://provinces.open-api.vn/api/";
    const hanoiCode = 1;

    const districtSelect = document.getElementById('district');
    const wardSelect = document.getElementById('ward');

    // Get saved values from Blade
    const userDistrict = `{{ old('district', $user->district) }}`.trim();
    const userWard = `{{ old('ward', $user->ward) }}`.trim();

    const renderOptions = (items, selectElement) => {
        selectElement.innerHTML = '<option value="">-- Chọn --</option>';
        items.forEach(item => {
            const option = document.createElement('option');
            option.dataset.code = item.code;
            option.value = item.name;
            option.textContent = item.name;
            selectElement.appendChild(option);
        });
    };

    const callApi = (url) => {
        return axios.get(url);
    };

    const loadWards = async (districtCode) => {
        wardSelect.innerHTML = '<option value="">-- Đang tải Phường/Xã --</option>';
        if (!districtCode) {
            wardSelect.innerHTML = '<option value="">-- Vui lòng chọn Quận/Huyện --</option>';
            return;
        }
        try {
            const response = await callApi(`${host}d/${districtCode}?depth=2`);
            renderOptions(response.data.wards, wardSelect);
            if (userWard) {
                wardSelect.value = userWard;
            }
        } catch (error) {
            console.error("Lỗi khi tải danh sách Phường/Xã:", error);
            wardSelect.innerHTML = '<option value="">-- Lỗi tải dữ liệu --</option>';
        }
    };

    const initializeAddress = async () => {
        try {
            const districtResponse = await callApi(host + "p/" + hanoiCode + "?depth=2");
            renderOptions(districtResponse.data.districts, districtSelect);

            if (userDistrict) {
                districtSelect.value = userDistrict;
                const selectedDistrictOption = districtSelect.options[districtSelect.selectedIndex];
                const districtCode = selectedDistrictOption ? selectedDistrictOption.dataset.code : null;

                if (districtCode) {
                    await loadWards(districtCode);
                }
            }
        } catch (error) {
            console.error("Lỗi tải Quận/Huyện:", error);
            districtSelect.innerHTML = '<option value="">-- Lỗi tải dữ liệu --</option>';
        }
    };

    districtSelect.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const districtCode = selectedOption ? selectedOption.dataset.code : null;
        loadWards(districtCode);
    });

    initializeAddress();
});
</script>
@endsection
