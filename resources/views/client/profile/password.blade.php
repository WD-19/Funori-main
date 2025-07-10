@extends('client.profile.index')

@section('content_profile')
    <div class="my-account-content account-edit">
        <div class="">
            <form id="form-password-change" method="POST" action="{{ route('client.profile.password.update') }}">
                @csrf
                <h6 class="mb_20">Đổi mật khẩu</h6>
                <div class="tf-field style-1 mb_30">
                    <input class="tf-field-input tf-input" placeholder=" " type="password" id="current_password"
                        name="current_password" required>
                    <label class="tf-field-label fw-4 text_black-2" for="current_password">Mật khẩu cũ</label>
                </div>
                <div class="tf-field style-1 mb_30">
                    <input class="tf-field-input tf-input" placeholder=" " type="password" id="new_password"
                        name="new_password" required>
                    <label class="tf-field-label fw-4 text_black-2" for="new_password">Mật khẩu mới</label>
                </div>
                <div class="tf-field style-1 mb_30">
                    <input class="tf-field-input tf-input" placeholder=" " type="password" id="new_password_confirmation"
                        name="new_password_confirmation" required>
                    <label class="tf-field-label fw-4 text_black-2" for="new_password_confirmation">Xác nhận mật
                        khẩu</label>
                </div>
                <div class="mb_20">
                    <button type="submit"
                        class="tf-btn w-100 radius-3 btn-fill animate-hover-btn justify-content-center">Lưu thay
                        đổi</button>
                </div>
            </form>
        </div>
    </div>
    @if (session('success'))
        <div class="alert alert-success mt-2">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger mt-2">{{ session('error') }}</div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger mt-2">
            <ul style="margin-bottom:0;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection
