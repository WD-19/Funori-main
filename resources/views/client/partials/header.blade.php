<div class="headermain" style="position: sticky; top: 0; z-index: 1000; background: #fff;">
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
            <a href="" class="box-heart">
                <i class="fa-regular fa-heart heart"></i>
            </a>
            <div class="cart-popup-group" style="position: relative; display: inline-block;">
                <a href="{{ route('client.view-cart') }}" class="box-cart" style="position: relative; z-index: 10;">
                    <i class="fa-solid fa-cart-shopping cart"></i>
                    @if(isset($cartCount) && $cartCount > 0)
                        <span class="cart-count-badge" style="position: absolute; top: -14px; right: -10px; background: #e53935; color: #fff; border-radius: 50%; padding: 0 5px; font-size: 11px; font-weight: bold; min-width: 18px; height: 18px; display: flex; align-items: center; justify-content: center; text-align: center; line-height: 18px; box-shadow: 0 1px 4px rgba(0,0,0,0.12); z-index: 2;">
                            {{ $cartCount }}
                        </span>
                    @endif
                </a>
                <div id="cart-popup-modal"
                     style="display:none; position:absolute; top:100%; right:0; background:#fff; border-radius:12px; box-shadow:0 4px 32px rgba(0,0,0,0.15); z-index:100; min-width:340px; max-width:96vw; min-height:80px; max-height:80vh; overflow:auto; padding:0;">
                    <div style="padding: 18px 24px 0 24px; border-radius:12px 12px 0 0; color:#bbb; font-weight:600; font-size:16px;">
                        Sản Phẩm Mới Thêm
                    </div>
                    <div id="cart-popup-content" style="padding: 12px 24px 0 24px;">
                        @if(isset($cartItems) && count($cartItems) > 0)
                            @foreach($cartItems as $item)
                                <div style="display:flex;align-items:center;margin-bottom:14px;">
                                    <img src="{{ asset($item['product']['images'][0]['image_url'] ?? 'images/products/no-image.png') }}" alt="" style="width:48px;height:48px;object-fit:cover;border-radius:6px;margin-right:12px;">
                                    <div style="flex:1;overflow:hidden;">
                                        <div style="font-weight:600;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:170px;">
                                            {{ $item['product']['name'] ?? '' }}
                                        </div>
                                    </div>
                                    <div style="color:#e53935;font-weight:500;min-width:70px;text-align:right;">
                                        {{ number_format($item['price_at_addition'], 0, ',', '.') }}đ                                    
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div style="padding: 12px 0;">Giỏ hàng của bạn đang trống.</div>
                        @endif
                    </div>
                    <div style="padding: 0 24px 18px 24px;">
                        <a href="{{ route('client.view-cart') }}" class="btn btn-danger w-100" style="margin-top:8px;font-weight:600;font-size:16px;">
                            Xem Giỏ Hàng
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var group = document.querySelector('.cart-popup-group');
    var popup = document.getElementById('cart-popup-modal');
    if(group && popup) {
        group.addEventListener('mouseenter', function() {
            popup.style.display = 'block';
        });
        group.addEventListener('mouseleave', function() {
            popup.style.display = 'none';
        });
    }
});
</script>
