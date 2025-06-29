@extends('client.layout.client')

@section('title', 'Cửa Hàng')

@section('content')
<div class="container-fluid py-4 px-0" style="background: #fafbfc; min-height: 80vh;">
    <div class="row mx-0">
        <!-- Sidebar -->
        <div class="col-md-3 col-12 mb-4 mb-md-0">
            <div class="bg-white rounded shadow-sm p-3 h-100">
                <div class="d-flex align-items-center mb-3">
                    <div style="width: 60px; height: 60px;">
                        <img src="{{ asset(Auth::user()->avatar_url ?? 'images/images.jpg') }}" alt="avatar" class="rounded-circle" style="width: 60px; height: 60px; object-fit: cover;">
                    </div>
                    <div class="ms-3">
                        <div class="fw-bold" style="font-size: 19px;">{{ Auth::user()->full_name ?? 'Tên người dùng' }}</div>
                        <a href="#" class="text-primary text-decoration-none" style="font-size: 13px;"><i class="fa fa-pen"></i> Sửa Hồ Sơ</a>
                    </div>
                </div>
                <ul class="list-unstyled mt-4">
                    <li class="mb-3"><a href="#" class="d-flex align-items-center text-dark text-decoration-none"><i class="fa-regular fa-bell me-3" style="color:#ff5722;"></i> Thông Báo</a></li>
                    <li class="mb-3 position-relative">
                        <a href="#" class="d-flex align-items-center text-dark text-decoration-none" id="accountDropdownToggle">
                            <i class="fa-regular fa-user me-3" style="color:#1976d2;"></i> Tài Khoản Của Tôi <i class="fa fa-chevron-down ms-auto"></i>
                        </a>
                        <ul class="dropdown-menu border-0 shadow-sm mt-2" id="accountDropdownMenu" style="display: none; position: static; float: none; min-width: 180px; background: #f8f9fa;">
                            <li><a class="dropdown-item" href="#">Thông tin cá nhân</a></li>
                            <li><a class="dropdown-item" href="#">Địa chỉ</a></li>
                            <li><a class="dropdown-item" href="#">Đổi mật khẩu</a></li>
                        </ul>
                    </li>
                    <li class="mb-3"><a href="#" class="d-flex align-items-center text-danger text-decoration-none fw-bold"><i class="fa-solid fa-file-invoice me-3"></i> Đơn Mua</a></li>
                    <li class="mb-3"><a href="#" class="d-flex align-items-center text-dark text-decoration-none"><i class="fa-solid fa-heart me-3" style="color:#ff9800;"></i> Danh sách yêu thích</a></li>
                    <li class="mb-3"><a href="#" class="d-flex align-items-center text-dark text-decoration-none"><i class="fa-solid fa-cog me-3" style="color:#1976d2;"></i> Cài đặt & Bảo mật</a></li>
                </ul>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        var toggle = document.getElementById('accountDropdownToggle');
                        var menu = document.getElementById('accountDropdownMenu');
                        toggle.addEventListener('click', function(e) {
                            e.preventDefault();
                            menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
                        });
                        document.addEventListener('click', function(e) {
                            if (!toggle.contains(e.target) && !menu.contains(e.target)) {
                                menu.style.display = 'none';
                            }
                        });
                    });
                </script>
            </div>
        </div>
        <!-- Main content -->
        <div class="col-md-9 col-12">
            @yield('profile_content')
        </div>
    </div>
</div>
@endsection