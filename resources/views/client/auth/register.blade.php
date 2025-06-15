@extends('client.auth.layout.auth')
@section('title', 'Đăng ký')

@section('content')

    <!-- #wrapper -->
    <div id="wrapper">
        <!-- #page -->
        <div id="page" class="">
            <div class="login-page">
                <div class="left">
                    <div class="login-box type-signup">
                        <div>
                            <h3>Tạo tài khoản mới</h3>
                            <div class="body-text text-white">Nhập thông tin cá nhân của bạn để đăng ký tài khoản
                            </div>
                        </div>
                        <div class="flex flex-column gap16 w-full">
                            <a href="#" class="tf-button style-2 w-full">
                                <span class="">Đăng nhập để tiếp tục sử dụng hệ thống.</span>
                            </a>
                        </div>
                        <form class="form-login flex flex-column gap22 w-full" action="{{ route('client.register.store') }}"
                            method="POST">
                            @csrf
                            <div>
                                <div class="body-title mb-10 text-white">Họ và tên <span class="tf-color-1">*</span></div>
                                <div class="cols gap10">
                                    <fieldset class="name">
                                        <input class="flex-grow" type="text" placeholder="Nhập họ và tên" name="name"
                                            tabindex="0" value="{{ old('name') }}">
                                        @error('name')
                                            <div class="text-danger mt-1" style="color: #ffb3b3; font-size: 16px;">{{ $message }}</div>
                                        @enderror
                                    </fieldset>
                                </div>
                            </div>
                            <fieldset class="email">
                                <div class="body-title mb-10 text-white">Địa chỉ email <span class="tf-color-1">*</span>
                                </div>
                                <input class="flex-grow" type="email" placeholder="Nhập địa chỉ email" name="email"
                                    tabindex="0" value="{{ old('email') }}">
                                @error('email')
                                    <div class="text-danger mt-1" style="color: #ffb3b3; font-size: 16px;">{{ $message }}</div>
                                @enderror
                            </fieldset>
                            <fieldset class="phone">
                                <div class="body-title mb-10 text-white">Số điện thoại <span class="tf-color-1">*</span>
                                </div>
                                <input class="flex-grow" type="text" placeholder="Nhập số điện thoại" name="phone"
                                    tabindex="0" value="{{ old('phone') }}">
                                @error('phone')
                                    <div class="text-danger mt-1" style="color: #ffb3b3; font-size: 16px;">{{ $message }}</div>
                                @enderror
                            </fieldset>
                            <fieldset class="password">
                                <div class="body-title mb-10 text-white">Mật khẩu <span class="tf-color-1">*</span></div>
                                <input class="password-input" type="password" placeholder="Nhập mật khẩu" name="password"
                                    tabindex="0">
                                <span class="show-pass">
                                    <i class="icon-eye view"></i>
                                    <i class="icon-eye-off hide"></i>
                                </span>
                                @error('password')
                                    <div class="text-danger mt-1" style="color: #ffb3b3; font-size: 16px;">{{ $message }}</div>
                                @enderror
                            </fieldset>
                            <fieldset class="password">
                                <div class="body-title mb-10 text-white">Xác nhận mật khẩu <span class="tf-color-1">*</span>
                                </div>
                                <input class="password-input" type="password" placeholder="Nhập lại mật khẩu"
                                    name="password_confirmation" tabindex="0">
                                <span class="show-pass">
                                    <i class="icon-eye view"></i>
                                    <i class="icon-eye-off hide"></i>
                                </span>
                                @error('password_confirmation')
                                    <div class="text-danger mt-1" style="color: #ffb3b3; font-size: 16px;">{{ $message }}</div>
                                @enderror
                            </fieldset>
                            <div class="flex justify-between items-center">
                                <div class="flex gap10">
                                    <input class="tf-check" type="checkbox" id="signed" required>
                                    <label class="body-text text-white" for="signed">
                                        Tôi đồng ý với
                                        <span style="color: #ffd700; text-decoration: underline;">Chính sách bảo mật</span>
                                    </label>
                                </div>
                            </div>

                            <button type="submit" class="tf-button w-full" id="register-btn" disabled
                                style="opacity: 0.5; cursor: not-allowed;">Đăng ký</button>
                        </form>
                        <div class="bottom body-text text-center text-white w-full">
                            Đã có tài khoản?
                            <a href="{{ route('client.login.index') }}" class="body-text tf-color">Đăng nhập tại đây</a>
                        </div>
                    </div>
                </div>
                <div class="right">
                    <!-- <img src="{{ asset('images/images-section/bg.jpg') }}" alt=""> -->
                </div>
            </div>
        </div>
        <!-- /#page -->
    </div>
    <script>
        // Disable/enable button theo checkbox
        document.addEventListener('DOMContentLoaded', function() {
            const checkbox = document.getElementById('signed');
            const btn = document.getElementById('register-btn');
            checkbox.addEventListener('change', function() {
                if (this.checked) {
                    btn.disabled = false;
                    btn.style.opacity = 1;
                    btn.style.cursor = 'pointer';
                } else {
                    btn.disabled = true;
                    btn.style.opacity = 0.5;
                    btn.style.cursor = 'not-allowed';
                }
            });
        });
    </script>
@endsection
