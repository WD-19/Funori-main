<div class="wrap-sidebar-account">
    <ul class="my-account-nav">
        <li>
            <a href="{{ route('client.profile.dashboard') }}" class="my-account-nav-item {{ request()->routeIs('client.profile.dashboard') ? 'active' : '' }}">Thông báo</a>
        </li>
        <li>
            <a href="{{ route('client.profile.account') }}" class="my-account-nav-item {{ request()->routeIs('client.profile.account') ? 'active' : '' }}">Tài khoản</a>
        </li>
        <li>
            <a href="{{ route('client.profile.address.index') }}" class="my-account-nav-item {{ request()->routeIs('client.profile.address.*') ? 'active' : '' }}">Địa chỉ</a>
        </li>
        <li>
            <a href="{{ route('client.profile.account') }}#change-password-section" class="my-account-nav-item">Đổi mật khẩu</a>
        </li>
        <li>
            <a href="{{ route('client.profile.order') }}" class="my-account-nav-item {{ request()->routeIs('client.profile.order') ? 'active' : '' }}">Đơn hàng</a>
        </li>
        <li>
            <a href="{{ route('client.profile.wishlist') }}" class="my-account-nav-item {{ request()->routeIs('client.profile.wishlist') ? 'active' : '' }}">Yêu thích</a>
        </li>
    </ul>
</div>
<style>
.my-account-nav-item.active {
    color: #ff3029;
    font-weight: bold;
}
</style>