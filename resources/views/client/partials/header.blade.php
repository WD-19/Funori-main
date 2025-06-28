<div class="header">
    <div class="content">
        {{-- <div class="box-menu-mobile">
            <button>
                <i class="fa-solid fa-bars"></i>
            </button>
        </div> --}}
        <nav class="box-menu">
            <ul class="all-list-menu">
                <li>
                    <a href="{{ route('home') }}" class="hover-a">Home</a>
                </li>
                <li class="padding-list-menu">
                    <a href="{{ route('shop') }}" class="hover-a">Shop</a>
                    <!-- <a href="">
                            <i class="fa-solid fa-angle-down angle-down"></i>
                        </a> -->
                </li>
                <li class="padding-list-menu">
                    <a href="#" class="hover-a">About Us</a>
                    <!-- <a href="">
                            <i class="fa-solid fa-angle-down angle-down"></i>
                        </a> -->
                </li>
                <li class="padding-list-menu">
                    <a href="#" class="hover-a">Blog</a>
                    <!-- <a href="">
                            <i class="fa-solid fa-angle-down angle-down"></i>
                        </a> -->
                </li>
                <li class="padding-list-menu">
                    <a href="#" class="hover-a">Page</a>
                    <a href="#">
                        <i class="fa-solid fa-angle-down angle-down"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <div class="box-logo">
            <div class="logo">
                <a href="index.html">
                    <img src="{{ asset('client/picture/logo.png') }}" alt="" />
                </a>
            </div>
        </div>
        <div class="box-icon">
            <a href="" class="box-search">
                <i class="fa-solid fa-magnifying-glass search"></i>
            </a>
            <a href="{{ route('client.login.index') }}" class="box-user">
                <i class="fa-regular fa-user user"></i>
            </a>
            <a href="" class="box-heart">
                <i class="fa-regular fa-heart heart"></i>
            </a>
            <a href="" class="box-cart">
                <i class="fa-solid fa-cart-shopping cart"></i>
            </a>
        </div>
    </div>
</div>
