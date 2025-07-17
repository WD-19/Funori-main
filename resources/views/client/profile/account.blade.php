@extends('client.profile.index')
@php $pageTitle = 'Thông tin tài khoản'; @endphp

@section('title', 'Thông tin tài khoản')

@section('page_title', 'Tài Khoản')


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
                                <label for="phone_number">Số điện thoại</label>
                                <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
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
  
@endsection