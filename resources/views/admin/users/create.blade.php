@extends('admin.layout.admin')

@section('title', 'Thêm người dùng')

@section('content')
    <div class="main-content-inner">
        <!-- main-content-wrap -->
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-30">
                <h3>Thêm người dùng mới</h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li>
                        <a href="index.html">
                            <div class="text-tiny">Bảng điều khiển</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <a href="#">
                            <div class="text-tiny">Người dùng</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">Thêm người dùng mới</div>
                    </li>
                </ul>
            </div>
            <!-- add-new-user -->
            <form class="form-add-new-user form-style-2" enctype="multipart/form-data" method="POST"
                action="{{ route('admin.users.store') }}">
                @csrf
                <div class="wg-box">
                    <div class="left">
                        <h5 class="mb-4">Tài khoản</h5>
                        <div class="body-text1">Điền thông tin bên dưới để thêm tài khoản mới</div>
                        <div class="avatar-upload mt-3 mb-4">
                            <label for="avatarInput">
                                <img src="{{ asset('images/images.jpg') }}" alt="Avatar" class="avatar-preview"
                                    id="avatarPreview">
                            </label>
                            <input type="file" id="avatarInput" name="avatar_url" accept="image/*"
                                style="display: none;">
                            @error('avatar_url')
                                <div class="text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="right flex-grow">
                        <fieldset class="name mb-24">
                            <div class="body-title mb-10">Họ và tên</div>
                            <input class="flex-grow" type="text" placeholder="Nhập họ tên" name="full_name"
                                tabindex="0" value="{{ old('full_name') }}" aria-required="true">
                            @error('full_name')
                                <div class="text text-danger">{{ $message }}</div>
                            @enderror
                        </fieldset>
                        <fieldset class="email mb-24">
                            <div class="body-title mb-10">Email</div>
                            <input class="flex-grow" type="email" placeholder="Nhập email" name="email" tabindex="0"
                                value="{{ old('email') }}" aria-required="true">
                            @error('email')
                                <div class="text text-danger">{{ $message }}</div>
                            @enderror
                        </fieldset>
                        <fieldset class="phone mb-24">
                            <div class="body-title mb-10">Số điện thoại</div>
                            <input class="flex-grow" type="text" placeholder="Nhập số điện thoại" name="phone_number"
                                tabindex="0" value="{{ old('phone_number') }}" aria-required="true">
                            @error('phone_number')
                                <div class="text text-danger">{{ $message }}</div>
                            @enderror
                        </fieldset>
                        <fieldset class="password mb-24">
                            <div class="body-title mb-10">Mật khẩu</div>
                            <input class="password-input" type="password" placeholder="Nhập mật khẩu" name="password"
                                tabindex="0" aria-required="true">
                            <span class="show-pass">
                                <i class="icon-eye view"></i>
                                <i class="icon-eye-off hide"></i>
                            </span>
                            @error('password')
                                <div class="text text-danger">{{ $message }}</div>
                            @enderror
                        </fieldset>
                        <fieldset class="password">
                            <div class="body-title mb-10">Xác nhận mật khẩu</div>
                            <input class="password-input" type="password" placeholder="Nhập lại mật khẩu"
                                name="password_confirmation" tabindex="0" aria-required="true">
                            <span class="show-pass">
                                <i class="icon-eye view"></i>
                                <i class="icon-eye-off hide"></i>
                            </span>
                            @error('password_confirmation')
                                <div class="text text-danger">{{ $message }}</div>
                            @enderror
                        </fieldset>
                    </div>
                </div>
                <div class="wg-box">
                    <div class="left">
                        <h5 class="mb-4">Phân quyền</h5>
                        <div class="body-text">Các mục tài khoản được phép chỉnh sửa</div>
                    </div>
                    <div class="right flex-grow">
                        <fieldset class="mb-24">
                            <div class="body-title mb-10">Trạng thái tài khoản</div>
                            <div class="radio-buttons">
                                <div class="item">
                                    <input type="radio" name="account_status" id="apply-product1" value="active"
                                        {{ old('account_status') == 'active' ? 'checked' : '' }}>
                                    <label for="apply-product1"><span class="body-title-2">Hoạt động</span></label>
                                </div>
                                <div class="item">
                                    <input type="radio" name="account_status" id="apply-product2" value="inactive"
                                        {{ old('account_status', 'inactive') == 'inactive' ? 'checked' : '' }}>
                                    <label for="apply-product2"><span class="body-title-2">Không hoạt động</span></label>
                                </div>
                                <div class="item">
                                    <input type="radio" name="account_status" id="apply-product3" value="banned"
                                        {{ old('account_status') == 'banned' ? 'checked' : '' }}>
                                    <label for="apply-product3"><span class="body-title-2">Bị khóa</span></label>
                                </div>
                            </div>
                            @error('account_status')
                                <div class="text text-danger">{{ $message }}</div>
                            @enderror
                        </fieldset>
                        <fieldset>
                            <div class="body-title mb-10">Quyền</div>
                            <div class="radio-buttons">
                                <div class="item">
                                    <input type="radio" name="role" id="create-product1" value="admin"
                                        {{ old('role') == 'admin' ? 'checked' : '' }}>
                                    <label for="create-product1"><span class="body-title-2">Quản trị viên</span></label>
                                </div>
                                <div class="item">
                                    <input type="radio" name="role" id="create-product2" value="user"
                                        {{ old('role', 'user') == 'user' ? 'checked' : '' }}>
                                    <label for="create-product2"><span class="body-title-2">Người dùng</span></label>
                                </div>
                            </div>
                            @error('role')
                                <div class="text text-danger">{{ $message }}</div>
                            @enderror
                        </fieldset>
                    </div>
                </div>
                <div class="wg-box">
                    <div class="row w-100 d-flex">
                        <div class="col-md-6">
                            <button type="submit" class="tf-button w-100 py-3 fs-5">
                                <i class="bi bi-pencil-square me-1"></i> Tạo mới
                            </button>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('admin.users.index') }}" class="tf-button style-3 w-100 py-3 fs-5">
                                <i class="bi bi-list me-1"></i> Danh sách
                            </a>
                        </div>
                    </div>
                </div>
            </form>
            <!-- /add-new-user -->
        </div>
        <!-- /main-content-wrap -->
    </div>
@endsection
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var input = document.getElementById('avatarInput');
            var preview = document.getElementById('avatarPreview');
            if (input && preview) {
                input.addEventListener('change', function(event) {
                    const file = event.target.files[0];
                    if (file && file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            preview.src = e.target.result;
                        };
                        reader.readAsDataURL(file);
                    }
                });
            }
        });
    </script>
@endpush
