@php
    $user = Auth::user();
@endphp
<div class="wrap-sidebar-account">
    <div class="profile-header-flex">
        <div class="avatar-container-small">
            <img src="{{ $user && $user->avatar_url ? asset('storage/' . $user->avatar_url) : asset('images/images.jpg') }}" alt="Ảnh đại diện" class="profile-avatar-small">
        </div>
        <div class="profile-info">
            <div class="profile-email" title="{{ $user && $user->email ? $user->email : '' }}">
                {{ $user && $user->email ? $user->email : '' }}
            </div>
        </div>
    </div>

    <ul class="my-account-nav">
        <li>
            {{-- Thông báo (Dashboard) --}}
            <a href="{{ route('client.profile.dashboard') }}" class="my-account-nav-item {{ request()->routeIs('client.profile.dashboard') || request()->routeIs('client.profile.index') ? 'active' : '' }}">
                <i class="bx bxs-dashboard icon"></i> {{-- Icon ví dụ, bạn có thể thay đổi --}}
                <span class="text-label">Thông báo</span>
            </a>
        </li>
        <li>
            {{-- Tài khoản --}}
            <a href="{{ route('client.profile.account') }}" class="my-account-nav-item {{ request()->routeIs('client.profile.account') ? 'active' : '' }}">
                <i class="bx bxs-user-account icon"></i>
                <span class="text-label">Tài khoản</span>
            </a>
        </li>
        <li>
            {{-- Địa chỉ --}}
            <a href="{{ route('client.profile.address.index') }}" class="my-account-nav-item {{ request()->routeIs('client.profile.address.*') ? 'active' : '' }}">
                <i class="bx bxs-map icon"></i>
                <span class="text-label">Địa chỉ</span>
            </a>
        </li>
        <li>
            {{-- Đổi mật khẩu --}}
            <a href="{{ route('client.profile.password.edit') }}" class="my-account-nav-item {{ request()->routeIs('client.profile.password.edit') ? 'active' : '' }}">
                <i class="bx bxs-lock-alt icon"></i>
                <span class="text-label">Đổi mật khẩu</span>
            </a>
        </li>
        <li>
            {{-- Đơn hàng --}}
            <a href="{{ route('client.profile.my_account.order') }}" class="my-account-nav-item {{ request()->routeIs('client.profile.order') ? 'active' : '' }}">
                <i class="bx bxs-shopping-bag icon"></i>
                <span class="text-label">Đơn hàng</span>
            </a>
        </li>
        <li>
            {{-- Yêu thích --}}
            <a href="{{ route('client.profile.wishlist') }}" class="my-account-nav-item {{ request()->routeIs('client.profile.wishlist') ? 'active' : '' }}">
                <i class="bx bxs-heart icon"></i>
                <span class="text-label">Yêu thích</span>
            </a>
        </li>
        <li>
            {{-- Kho Voucher --}}
            <a href="{{ route('client.profile.voucher') }}" class="my-account-nav-item">
                <i class="bx bxs-discount icon"></i>
                <span class="text-label">Kho Voucher</span>
            </a>
        </li>
        <li>
            {{-- Ví --}}
            <a href="#" class="my-account-nav-item">
                <i class="bx bxs-wallet icon"></i>
                <span class="text-label">Ví</span>
            </a>
        </li>
        {{-- Thêm mục đăng xuất --}}
      
</div>
<link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
<style>
    /* Sidebar Container */
/* Sidebar Container */
.wrap-sidebar-account {
    background-color: #ffffff; /* Nền trắng */
    border-radius: 12px; /* Bo tròn góc nhiều hơn */
    box-shadow: 0 5px 35px rgb(16 16 16 / 8%); /* Bóng đổ mạnh và rõ ràng hơn */
    padding: 25px 0; /* Đệm trên dưới */
    display: flex;
    flex-direction: column;
    height: 100%; /* Đảm bảo sidebar chiếm hết chiều cao khả dụng */
    overflow: hidden; /* Ngăn chặn nội dung tràn ra ngoài nếu quá lớn */
}

/* Profile Header (Avatar, Tên, ID) */
.profile-header {
    padding: 20px 25px; /* Đệm ngang lớn hơn một chút */
    margin-bottom: 30px; /* Khoảng cách lớn hơn với menu */
    text-align: center;
    border-bottom: 1px solid #f0f2f5; /* Đường phân cách nhẹ */
    padding-bottom: 25px;
}

.avatar-container {
    width: 120px; /* Kích thước container avatar LỚN HƠN */
    height: 120px;
    margin: 0 auto 18px auto; /* Căn giữa và khoảng cách dưới */
    position: relative;
    border-radius: 50%; /* Đảm bảo hình tròn */
    overflow: hidden; /* Ẩn phần tràn ra ngoài của ảnh */
    box-shadow: 0 0 0 6px rgba(255, 48, 41, 0.2), /* Viền phát sáng nhẹ */
                0 0 15px rgba(0,0,0,0.1); /* Bóng đổ cho avatar */
}

.profile-avatar-large {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 50%; /* Đảm bảo hình tròn */
    transition: transform 0.3s ease; /* Hiệu ứng hover */
}

.profile-avatar-large:hover {
    transform: scale(1.08); /* Phóng to nhẹ khi hover */
}

.profile-username {
    font-size: 1.5em; /* Lớn hơn đáng kể */
    font-weight: 700; /* Đậm hơn */
    color: #333;
    margin-bottom: 8px; /* Khoảng cách với ID */
    text-shadow: 1px 1px 2px rgba(0,0,0,0.05); /* Bóng chữ nhẹ */
}

.profile-userid {
    font-size: 0.95em; /* Kích thước dễ đọc */
    color: #777;
    margin-bottom: 0;
}

/* Navigation Menu */
.my-account-nav {
    list-style: none;
    padding: 0 20px; /* Đệm ngang cho danh sách */
    margin: 0;
    flex-grow: 1; /* Cho phép danh sách này mở rộng để đẩy nội dung khác xuống */
}

.my-account-nav li {
    margin-bottom: 8px; /* Khoảng cách giữa các mục menu */
}

.my-account-nav-item {
    display: flex; /* Dùng flexbox để căn chỉnh icon và text */
    align-items: center; /* Căn giữa theo chiều dọc */
    padding: 14px 18px; /* Đệm lớn hơn cho mỗi mục, tạo không gian */
    text-decoration: none;
    color: #444; /* Màu chữ mặc định hơi đậm hơn */
    border-radius: 10px; /* Bo tròn góc các mục menu nhiều hơn */
    transition: background-color 0.3s ease, color 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;
    font-size: 1.08em; /* Font size lớn hơn một chút */
    font-weight: 500;
}

.my-account-nav-item:hover, .my-account-nav-item:focus {
    text-decoration: none !important;
}

.my-account-nav-item:hover {
    background-color: #f3f6f9; /* Nền xám nhạt tinh tế khi hover */
    color: #ff3029; /* Màu đỏ khi hover */
    transform: translateX(6px); /* Hiệu ứng dịch chuyển nhẹ sang phải */
    box-shadow: 0 2px 10px rgba(0,0,0,0.05); /* Thêm bóng đổ nhẹ khi hover */
}

.my-account-nav-item.active {
    background-color: #ff3029; /* Nền đỏ đậm khi active */
    color: #ffffff; /* Chữ trắng khi active */
    font-weight: 600;
    box-shadow: 0 4px 15px rgba(255, 48, 41, 0.3); /* Đổ bóng mạnh hơn cho mục active */
    transform: translateX(0); /* Đảm bảo không dịch chuyển khi active */
}

.my-account-nav-item .icon {
    font-size: 1.6em;
    margin-right: 15px;
    line-height: 1;
    font-weight: 400;
    transition: color 0.3s, font-weight 0.3s, font-size 0.3s;
}
.my-account-nav-item.active .icon,
.my-account-nav-item:hover .icon {
    color: inherit;
    font-weight: 700;
    font-size: 1.8em;
}

/* Đảm bảo màu icon cũng thay đổi khi active/hover */
/* Các styles khác cho phần nội dung chính của profile, form, button, v.v. */
/* (Giữ nguyên các styles này hoặc điều chỉnh nếu cần) */

/* ... và các style khác ... */

.profile-header-flex {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 10px 25px 20px 25px;
    border-bottom: 1px solid #f0f2f5;
    margin-bottom: 20px;
}

.avatar-container-small {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    overflow: hidden;
    flex-shrink: 0;
    box-shadow: 0 0 0 3px rgba(255, 48, 41, 0.15);
}

.profile-avatar-small {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 50%;
}

.profile-info {
    flex: 1;
    min-width: 0;
}

.profile-username {
    font-size: 1.1em;
    font-weight: 600;
    color: #333;
}

.profile-email {
    font-size: 0.9em;
    color: #777;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}
</style>