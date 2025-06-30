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
            <a href="" class="box-heart">
                <i class="fa-regular fa-heart heart"></i>
            </a>
            <a href="{{ route('client.view-cart') }}" class="box-cart">
                <i class="fa-solid fa-cart-shopping cart"></i>
            </a>
        </div>
    </div>
</div>
