<div class="headermain">
    <div class="contentmain">
        {{-- <div class="box-menu-mobile">
            <button>
                <i class="fa-solid fa-bars"></i>
            </button>
        </div> --}}
        <nav class="box-menu">
            <ul class="all-list-menu">
                <li>
                    <a href="{{ route('home') }}" class="hover-a">Trang chủ</a>
                </li>
                <li class="padding-list-menu">
                    <a href="{{ route('shop') }}" class="hover-a">Cửa hàng</a>
                    <!-- <a href="">
                            <i class="fa-solid fa-angle-down angle-down"></i>
                        </a> -->
                </li>
                <li class="padding-list-menu">
                    <a href="{{ route('client.about') }}" class="hover-a">Về chúng tôi</a>
                    <!-- <a href="">
                            <i class="fa-solid fa-angle-down angle-down"></i>
                        </a> -->
                </li>
                {{-- <li class="padding-list-menu">
                    <a href="#" class="hover-a">Blog</a>
                    <!-- <a href="">
                            <i class="fa-solid fa-angle-down angle-down"></i>
                        </a> -->
                </li> --}}
                <li class="padding-list-menu">
                    <a href="{{ route('client.page') }}" class="hover-a">Tin tức</a>
                </li>
                <li class="padding-list-menu">
                    <a href="{{ route('client.contact') }}" class="hover-a">Liên hệ</a>
                </li>
            </ul>
        </nav>
        <div class="box-logo">
            <div class="logo">
                <a href="{{ route('home') }}" class="logo-link">
                    {{-- <img src="{{ asset('client/picture/logo.png') }}" alt="Logo" /> --}}
                    <img src="{{ asset('client/picture/logo.png') }}" alt="Logo" />
                </a>
            </div>
        </div>
        <div class="box-icon d-flex align-items-center gap-3">
            <a href="{{ route('client.search') }}" class="box-search">
                <i class="fa-solid fa-magnifying-glass search"></i>
            </a>
            <div class="box-user dropdown d-flex align-items-center" style="position: relative;">
                <a href="{{ Auth::check() ? '#' : route('client.login') }}" id="userDropdown" style="padding: 0; border: none; background: none; display: flex; align-items: center; vertical-align: middle;">
                    @if(Auth::check())
                        <img src="{{ asset(Auth::user()->avatar_url ? Auth::user()->avatar_url : 'images/images.jpg') }}" alt="avatar" style="width:32px;height:32px;object-fit:cover;border-radius:50%; display: block; vertical-align: middle;">
                    @else
                        <i class="fa-regular fa-user user"></i>
                    @endif
                </a>
                @if(Auth::check())
                <div class="dropdown-menu" style="display: none; position: absolute; top: 110%; left: 50%; transform: translateX(-50%); background: #fff; box-shadow: 0 2px 8px rgba(0,0,0,0.15); min-width: 200px; z-index: 100; border-radius: 10px; overflow: hidden; padding: 18px 0;">
                    <a href="{{ route('client.profile.dashboard') }}" class="dropdown-item d-flex align-items-center" style="padding: 16px 28px; color: #1976d2; font-weight: 600; font-size: 15px; background: none; border: none;">
                        <i class="fa-regular fa-user" style="font-size: 18px; color: #1976d2; margin-right: 16px;"></i> Profile
                    </a>
                    <form action="{{ route('client.logout') }}" method="POST" style="margin: 0;">
                        @csrf
                        <button type="submit" class="dropdown-item d-flex align-items-center" style="background: none; border: none; padding: 16px 28px; color: #e53935; font-size: 15px; font-weight: 500; cursor: pointer;">
                            <i class="fa-solid fa-right-from-bracket" style="font-size: 18px; color: #e53935; margin-right: 16px;"></i> Đăng xuất
                        </button>
                    </form>
                </div>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        var userDropdown = document.getElementById('userDropdown');
                        var dropdownMenu = userDropdown.nextElementSibling;
                        userDropdown.addEventListener('click', function(e) {
                            e.preventDefault();
                            dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
                        });
                        document.addEventListener('click', function(e) {
                            if (!userDropdown.contains(e.target) && !dropdownMenu.contains(e.target)) {
                                dropdownMenu.style.display = 'none';
                            }
                        });
                    });
                </script>
                @endif
            </div>
            <div class="box-heart" id="wishlist-header-btn" style="position:relative;cursor:pointer;">
                <a href="{{ route('client.profile.wishlist') }}" style="display:inline-block;position:relative;">
                    <i class="fa-regular fa-heart heart"></i>
                    @if(isset($headerWishlistCount) && $headerWishlistCount > 0)
                        <span class="wishlist-badge" style="position:absolute;top:-6px;right:-10px;min-width:18px;height:18px;display:flex;align-items:center;justify-content:center;background:#fcad02;color:#fff;font-size:11px;padding:0 4px;border-radius:50%;font-weight:bold;line-height:1;box-shadow:0 1px 4px rgba(0,0,0,0.08);z-index:2;">{{ $headerWishlistCount }}</span>
                    @endif
                </a>
                
                <div class="wishlist-dropdown" style="display:none;position:absolute;top:120%;right:0;min-width:260px;z-index:999;background:#fff;border-radius:8px;box-shadow:0 2px 8px rgba(0,0,0,0.15);padding:12px;">
                    <div id="mini-wishlist-content">
                        @php
                            $wishlistItems = Auth::check() && Auth::user()->wishlist ? Auth::user()->wishlist->items()->with('product.images')->orderByDesc('created_at')->get() : collect();
                            $maxShow = 5;
                        @endphp
                        @if($wishlistItems->count())
                            @foreach($wishlistItems->take($maxShow) as $item)
                                <a href="{{ route('client.product.show', $item->product->slug) }}" class="mini-wishlist-item-link d-flex align-items-center mb-2 p-2" style="border-radius:6px;transition:background 0.15s; text-decoration:none; color:#333;" title="{{ $item->product->name }}">
                                    <img src="{{ $item->product->images->first() ? asset($item->product->images->first()->image_url) : asset('images/no-image.png') }}" style="width:40px;height:40px;object-fit:cover;border-radius:6px;margin-right:10px;">
                                    <span class="mini-wishlist-name" style="font-size:14px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:130px;display:inline-block;">{{ $item->product->name }}</span>
                                </a>
                            @endforeach
                            @if($wishlistItems->count() > $maxShow)
                                <div style="text-align:center;font-size:13px;color:#888;">+{{ $wishlistItems->count() - $maxShow }} sản phẩm khác...</div>
                            @endif
                        @else
                            <div style="text-align:center;color:#888;font-size:14px;">Chưa có sản phẩm yêu thích</div>
                        @endif
                        <div style="text-align:center;margin-top:8px;">
                            <a href="{{ route('client.profile.wishlist') }}" class="btn btn-sm btn-warning" style="background:#fcad02;color:#fff;font-weight:600;">Xem tất cả</a>
                        </div>
                    </div>
                </div>
            </div>
            <a href="{{ route('client.view-cart') }}" class="box-cart">
                <i class="fa-solid fa-cart-shopping cart"></i>
            </a>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var btn = document.getElementById('wishlist-header-btn');
    var dropdown = btn.querySelector('.wishlist-dropdown');
    var timeout;
    function showDropdown() {
        clearTimeout(timeout);
        dropdown.style.display = 'block';
    }
    function hideDropdown() {
        timeout = setTimeout(function() {
            dropdown.style.display = 'none';
        }, 120);
    }
    btn.addEventListener('mouseenter', showDropdown);
    btn.addEventListener('mouseleave', hideDropdown);
    dropdown.addEventListener('mouseenter', showDropdown);
    dropdown.addEventListener('mouseleave', hideDropdown);
});

// Thêm đoạn sau vào cuối file để tự động reload mini-wishlist-content sau khi thêm vào yêu thích

</script>
<style>
.mini-wishlist-item-link:hover .mini-wishlist-name {
    color: #fcad02 !important;
    text-decoration: underline;
}
.mini-wishlist-item-link:hover {
    background: #fcf3e6 !important;
    text-decoration: none;
}
</style>
