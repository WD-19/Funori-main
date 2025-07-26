@extends('admin.layout.admin')

@section('title', 'Chi tiết người dùng')

@section('content')
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-30">
                <h3>Chi tiết người dùng</h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li>
                        <a href="{{ route('admin.dashboard') }}">
                            <div class="text-tiny">Bảng điều khiển</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <a href="{{ route('admin.users.index') }}">
                            <div class="text-tiny">Người dùng</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">Chi tiết người dùng</div>
                    </li>
                </ul>
            </div>
            <!-- user-detail -->
            <form class="form-add-new-user form-style-2">
                <div class="wg-box">
                    <div class="left">
                        <h5 class="mb-4">Tài khoản</h5>
                        <div class="body-text1">Thông tin tài khoản</div>
                        <div class="avatar-upload mt-3 mb-4">
                            <img src="{{ $user->avatar_url ? asset($user->avatar_url) : asset('images/images.jpg') }}"
                                alt="Ảnh đại diện" class="avatar-preview" id="avatarPreview"
                                style="width:120px;height:120px;border-radius:50%;">
                        </div>
                    </div>
                    <div class="right flex-grow">
                        <fieldset class="name mb-24">
                            <div class="body-title mb-10">Tên người dùng</div>
                            <input class="flex-grow" type="text" placeholder="Tên người dùng" name="full_name"
                                value="{{ $user->full_name }}" readonly>
                        </fieldset>
                        <fieldset class="email mb-24">
                            <div class="body-title mb-10">Email</div>
                            <input class="flex-grow" type="email" placeholder="Email" name="email"
                                value="{{ $user->email }}" readonly>
                        </fieldset>
                        <fieldset class="phone mb-24">
                            <div class="body-title mb-10">Số điện thoại</div>
                            <input class="flex-grow" type="text" placeholder="Số điện thoại" name="phone_number"
                                value="{{ $user->phone_number }}" readonly>
                        </fieldset>
                        <fieldset class="password mb-24">
                            <div class="body-title mb-10">Mật khẩu</div>
                            <input class="password-input" type="password" placeholder="Mật khẩu" value="********" readonly>
                        </fieldset>
                    </div>
                </div>
                <div class="wg-box">
                    <div class="left">
                        <h5 class="mb-4">Quyền và Trạng thái tài khoản</h5>
                        <div class="body-text">Phân quyền tài khoản</div>
                    </div>
                    <div class="right flex-grow">
                        <fieldset class="mb-24">
                            <div class="body-title mb-10">Trạng thái tài khoản</div>
                            <div class="radio-buttons">
                                <div class="item">
                                    <input type="radio" name="account_status" value="active"
                                        {{ $user->account_status == 'active' ? 'checked' : '' }} disabled>
                                    <label><span class="body-title-2">Hoạt động</span></label>
                                </div>
                                <div class="item">
                                    <input type="radio" name="account_status" value="inactive"
                                        {{ $user->account_status == 'inactive' ? 'checked' : '' }} disabled>
                                    <label><span class="body-title-2">Không hoạt động</span></label>
                                </div>
                                <div class="item">
                                    <input type="radio" name="account_status" value="banned"
                                        {{ $user->account_status == 'banned' ? 'checked' : '' }} disabled>
                                    <label><span class="body-title-2">Bị khóa</span></label>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <div class="body-title mb-10">Vai trò</div>
                            <div class="radio-buttons">
                                <div class="item">
                                    <input type="radio" name="role" value="admin"
                                        {{ $user->role == 'admin' ? 'checked' : '' }} disabled>
                                    <label><span class="body-title-2">Quản trị viên</span></label>
                                </div>
                                <div class="item">
                                    <input type="radio" name="role" value="user"
                                        {{ $user->role == 'user' ? 'checked' : '' }} disabled>
                                    <label><span class="body-title-2">Người dùng</span></label>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
                <div class="bot mt-4">
                    <a href="{{ route('admin.users.index') }}" class="tf-button w180">Danh sách</a>
                    <a href="{{ route('admin.users.orderHistory', $user->id) }}" class="tf-button w180 btn-primary">Lịch sử đơn hàng</a>
                </div>
            </form>
            <!-- /user-detail -->
        </div>
    </div>
@endsection