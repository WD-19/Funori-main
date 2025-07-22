@extends('client.auth.layout.auth')

@section('title', 'Quên Mật Khẩu')

@section('content')
    <!-- #wrapper -->
    <div id="wrapper">
        <!-- #page -->
        <div id="page" class="">
            <div class="login-page">
                <div class="left">
                    <div class="login-box">
                        <div>
                            <h3>Quên Mật Khẩu</h3>
                            <div class="body-text text-white">Nhập địa chỉ email của bạn để nhận liên kết đặt lại mật khẩu.
                            </div>
                        </div>
                        <form class="form-login flex flex-column gap22 w-full" action="{{ route('client.password.email') }}"
                            method="POST">
                            @csrf
                            <fieldset class="email">
                                <div class="body-title mb-10 text-white">Địa chỉ email <span class="tf-color-1">*</span>
                                </div>
                                <input class="flex-grow" type="email" name="email" value="{{ old('email') }}"
                                    placeholder="Nhập địa chỉ email" required>
                                @error('email')
                                    <div class="text-danger mt-1" style="color: #ffb3b3; font-size: 16px;">{{ $message }}
                                    </div>
                                @enderror
                            </fieldset>
                            <button type="submit" class="tf-button w-full">Gửi liên kết đặt lại mật khẩu</button>
                        </form>
                        <div class="bottom body-text text-center text-white w-full">
                            Đã có tài khoản?
                            <a href="{{ route('client.login') }}" class="body-text tf-color">Đăng nhập tại đây</a>
                        </div>
                    </div>
                </div>
                <div class="right">
                    <!-- <img src="{{ asset('images/images-section/forgot-password.jpg') }}" alt=""> -->
                </div>
            </div>
        </div>
        <!-- /#page -->
    </div>
@endsection
