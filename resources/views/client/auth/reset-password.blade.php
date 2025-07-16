@extends('client.auth.layout.auth')

@section('title', 'Đặt lại mật khẩu')

@section('content')
    <div id="wrapper">
        <div id="page" class="">
            <div class="login-page">
                <div class="left">
                    <div class="login-box">
                        <div>
                            <h3>Đặt lại mật khẩu</h3>
                            <div class="body-text text-white">Vui lòng nhập mật khẩu mới của bạn.</div>
                        </div>
                        <form class="form-login flex flex-column gap22 w-full" action="{{ route('password.update') }}"
                            method="POST">
                            @csrf
                            <input type="hidden" name="token" value="{{ request()->route('token') }}">

                            <fieldset class="email">
                                <div class="body-title mb-10 text-white">Địa chỉ email <span class="tf-color-1">*</span>
                                </div>
                                <input class="flex-grow" type="email" name="email"
                                    value="{{ old('email', $email ?? '') }}" required autofocus
                                    placeholder="Nhập địa chỉ email">
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </fieldset>

                            <fieldset class="password">
                                <div class="body-title mb-10 text-white">Mật khẩu mới <span class="tf-color-1">*</span>
                                </div>
                                <input class="password-input" type="password" name="password" required
                                    placeholder="Nhập mật khẩu mới">
                                @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </fieldset>

                            <fieldset class="password_confirmation">
                                <div class="body-title mb-10 text-white">Xác nhận mật khẩu <span class="tf-color-1">*</span>
                                </div>
                                <input class="password-input" type="password" name="password_confirmation" required
                                    placeholder="Xác nhận mật khẩu mới">
                            </fieldset>

                            <button type="submit" class="tf-button w-full">Đặt lại mật khẩu</button>
                        </form>
                    </div>
                </div>
                <div class="right">
                    <!-- Optional: Add an image or additional content here -->
                </div>
            </div>
        </div>
    </div>
@endsection
