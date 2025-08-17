<div class="section-menu-left">
    <div class="box-logo">
        <a href="{{ route('admin.dashboard') }}" id="site-logo-inner">
            <img id="logo_header" alt="logo-funori" src="{{ asset('images/logo/funori.jpg') }}"
                data-light="{{ asset('images/logo/funori.jpg') }}" data-dark="{{ asset('images/logo/funori-white.jpg') }}"
                width="120px">
        </a>
        <div class="button-show-hide">
            <i class="icon-chevron-left"></i>
        </div>
    </div>
    <div class="section-menu-left-wrap">
        <div class="center">
            <div class="center-item">
                <ul class="">
                    <!-- Thống Kê -->
                    <li class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <a href="{{ route('admin.dashboard') }}">
                            <div class="icon">
                                <svg width="24" height="24" fill="none">
                                    <rect x="3" y="10" width="3" height="8" rx="1" fill="#111" />
                                    <rect x="8.5" y="6" width="3" height="12" rx="1" fill="#111" />
                                    <rect x="14" y="3" width="3" height="15" rx="1" fill="#111" />
                                </svg>
                            </div>
                            <div class="text">Thống Kê</div>
                        </a>
                    </li>
                    <!-- Sản Phẩm -->
                    <li class="menu-item has-children {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                        <a href="javascript:void(0);" class="menu-item-button">
                            <div class="icon">
                                <svg width="24" height="24" fill="none">
                                    <rect x="4" y="4" width="16" height="16" rx="2" stroke="#111"
                                        stroke-width="2" />
                                    <path d="M8 12h8M12 8v8" stroke="#111" stroke-width="2" stroke-linecap="round" />
                                </svg>
                            </div>
                            <div class="text">Sản Phẩm</div>
                        </a>
                        <ul class="sub-menu">
                            <li class="sub-menu-item">
                                <a href="{{ route('admin.products.index') }}">
                                    <div class="text">Tất cả sản phẩm</div>
                                </a>
                            </li>
                            <li class="sub-menu-item">
                                <a href="{{ route('admin.products.create') }}">
                                    <div class="text">Thêm mới sản phẩm</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- Tin Nhắn Nhanh -->
                    <li class="menu-item has-children {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                        <a href="javascript:void(0);" class="menu-item-button">
                            <div class="icon">
                                <svg width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path d="M4 4h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H7l-5 4V6a2 2 0 0 1 2-2z"
                                        stroke="#111" stroke-width="2" fill="none" />
                                </svg>
                            </div>
                            <div class="text">Tin Nhắn Nhanh</div>
                        </a>
                        <ul class="sub-menu">
                            <li class="sub-menu-item">
                                <a href="{{ route('admin.messages.index') }}">
                                    <div class="text">Tất cả đoạn tin nhắn</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- Thương Hiệu -->
                    <li class="menu-item has-children {{ request()->routeIs('admin.brands.*') ? 'active' : '' }}">
                        <a href="javascript:void(0);" class="menu-item-button">
                            <div class="icon">
                                <svg width="24" height="24" fill="none">
                                    <circle cx="12" cy="8" r="5" stroke="#111" stroke-width="2" />
                                    <path d="M7 21l5-4 5 4" stroke="#111" stroke-width="2" fill="none" />
                                </svg>
                            </div>
                            <div class="text">Thương Hiệu</div>
                        </a>
                        <ul class="sub-menu">
                            <li class="sub-menu-item">
                                <a href="{{ route('admin.brands.index') }}">
                                    <div class="text">Quản lí thương hiệu</div>
                                </a>
                            </li>
                            <li class="sub-menu-item">
                                <a href="{{ route('admin.brands.create') }}">
                                    <div class="text">Thêm mới thương hiệu</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- Danh Mục -->
                    <li class="menu-item has-children {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                        <a href="javascript:void(0);" class="menu-item-button">
                            <div class="icon">
                                <svg width="24" height="24" fill="none">
                                    <rect x="4" y="6" width="16" height="2" rx="1" fill="#111" />
                                    <rect x="4" y="11" width="16" height="2" rx="1"
                                        fill="#111" />
                                    <rect x="4" y="16" width="16" height="2" rx="1"
                                        fill="#111" />
                                </svg>
                            </div>
                            <div class="text">Danh mục</div>
                        </a>
                        <ul class="sub-menu">
                            <li class="sub-menu-item">
                                <a href="{{ route('admin.categories.index') }}">
                                    <div class="text">Danh sách danh mục</div>
                                </a>
                            </li>
                            <li class="sub-menu-item">
                                <a href="{{ route('admin.categories.create') }}">
                                    <div class="text">Thêm danh mục mới</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- Thuộc Tính -->
                    <li class="menu-item has-children {{ request()->routeIs('admin.attributes.*') ? 'active' : '' }}">
                        <a href="javascript:void(0);" class="menu-item-button">
                            <div class="icon">
                                <svg width="24" height="24" fill="none">
                                    <circle cx="7" cy="7" r="3" stroke="#111" stroke-width="2" />
                                    <circle cx="17" cy="7" r="3" stroke="#111" stroke-width="2" />
                                    <circle cx="7" cy="17" r="3" stroke="#111" stroke-width="2" />
                                    <circle cx="17" cy="17" r="3" stroke="#111" stroke-width="2" />
                                </svg>
                            </div>
                            <div class="text">Thuộc tính</div>
                        </a>
                        <ul class="sub-menu">
                            <li class="sub-menu-item">
                                <a href="{{ route('admin.attributes.index') }}">
                                    <div class="text">Danh sách thuộc tính</div>
                                </a>
                            </li>
                            <li class="sub-menu-item">
                                <a href="{{ route('admin.attributes.create') }}">
                                    <div class="text">Thêm mới thuộc tính</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- Phương Thức -->
                    <li
                        class="menu-item has-children {{ request()->routeIs('admin.payment_methods.*', 'admin.shipping_methods.*') ? 'active' : '' }}">
                        <a href="javascript:void(0);" class="menu-item-button">
                            <div class="icon">
                                <svg width="24" height="24" fill="none">
                                    <rect x="3" y="7" width="18" height="10" rx="2" stroke="#111"
                                        stroke-width="2" />
                                    <path d="M7 7V5a5 5 0 0 1 10 0v2" stroke="#111" stroke-width="2" />
                                </svg>
                            </div>
                            <div class="text">Phương thức</div>
                        </a>
                        <ul class="sub-menu">
                            <li class="sub-menu-item">
                                <a href="{{ route('admin.payment_methods.index') }}">
                                    <div class="text">Phương thức thanh Toán</div>
                                </a>
                            </li>
                            <li class="sub-menu-item">
                                <a href="{{ route('admin.shipping_methods.index') }}">
                                    <div class="text">Phương thức giao Hàng</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- Mã Giảm Giá -->
                    <li class="menu-item has-children {{ request()->routeIs('admin.promotions.*') ? 'active' : '' }}">
                        <a href="javascript:void(0);" class="menu-item-button">
                            <div class="icon">
                                <svg width="24" height="24" fill="none">
                                    <rect x="3" y="7" width="18" height="10" rx="2" stroke="#111"
                                        stroke-width="2" />
                                    <path d="M7 7V5a5 5 0 0 1 10 0v2" stroke="#111" stroke-width="2" />
                                    <circle cx="12" cy="12" r="2" stroke="#111" stroke-width="2" />
                                </svg>
                            </div>
                            <div class="text">Mã giảm giá</div>
                        </a>
                        <ul class="sub-menu">
                            <li class="sub-menu-item">
                                <a href="{{ route('admin.promotions.index') }}">
                                    <div class="text">Danh sách mã giảm giá</div>
                                </a>
                            </li>
                            <li class="sub-menu-item">
                                <a href="{{ route('admin.promotions.create') }}">
                                    <div class="text">Thêm mới mã giảm giá</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- Banner -->
                    <li class="menu-item has-children {{ request()->routeIs('admin.banners.*') ? 'active' : '' }}">
                        <a href="javascript:void(0);" class="menu-item-button">
                            <div class="icon">
                                <svg width="24" height="24" fill="none">
                                    <path d="M5 21V5a1 1 0 0 1 1-1h12l-2 4 2 4H6" stroke="#111" stroke-width="2"
                                        fill="none" />
                                </svg>
                            </div>
                            <div class="text">Banner</div>
                        </a>
                        <ul class="sub-menu">
                            <li class="sub-menu-item">
                                <a href="{{ route('admin.banners.index') }}">
                                    <div class="text">Danh sách banner</div>
                                </a>
                            </li>
                            <li class="sub-menu-item">
                                <a href="{{ route('admin.banners.create') }}">
                                    <div class="text">Thêm mới banner</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- Đơn Hàng -->
                    <li class="menu-item has-children {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                        <a href="javascript:void(0);" class="menu-item-button">
                            <div class="icon">
                                <svg width="24" height="24" fill="none">
                                    <circle cx="9" cy="21" r="1" fill="#111" />
                                    <circle cx="19" cy="21" r="1" fill="#111" />
                                    <path d="M1 1h4l2.68 13.39A2 2 0 0 0 9.61 16h7.78a2 2 0 0 0 1.93-1.61L23 6H6"
                                        stroke="#111" stroke-width="2" fill="none" />
                                </svg>
                            </div>
                            <div class="text">Đơn hàng</div>
                        </a>
                        <ul class="sub-menu">
                            <li class="sub-menu-item">
                                <a href="{{ route('admin.orders.index') }}">
                                    <div class="text">Danh sách đơn hàng</div>
                                </a>
                            </li>
                            <li class="sub-menu-item">
                                <a href="{{ route('admin.orders.stats') }}">
                                    <div class="text">Thống kê đơn hàng</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- Shipper -->
                    <li class="menu-item has-children {{ request()->routeIs('admin.shippers.*') ? 'active' : '' }}">
                        <a href="javascript:void(0);" class="menu-item-button">
                            <div class="icon">
                                <svg width="24" height="24" fill="none">
                                    <path d="M7 17l-4-4 4-4M17 7l4 4-4 4" stroke="#111" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M13 6h-2a4 4 0 0 0 0 8h2" stroke="#111" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <div class="text">Shipper</div>
                        </a>
                        <ul class="sub-menu">
                            <li class="sub-menu-item">
                                <a href="{{ route('admin.shippers.index') }}">
                                    <div class="text">Danh sách shipper</div>
                                </a>
                            </li>
                            <li class="sub-menu-item">
                                <a href="{{ route('admin.shippers.create') }}">
                                    <div class="text">Thêm mới shipper</div>
                                </a>
                            </li>
                            <li class="sub-menu-item">
                                <a href="{{ route('admin.shippers.assign-orders') }}">
                                    <div class="text">Phân chia đơn hàng</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- Người Dùng -->
                    <li class="menu-item has-children {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                        <a href="javascript:void(0);" class="menu-item-button">
                            <div class="icon">
                                <svg width="24" height="24" fill="none">
                                    <circle cx="12" cy="8" r="4" stroke="#111" stroke-width="2" />
                                    <path d="M4 20c0-2.21 3.58-4 8-4s8 1.79 8 4" stroke="#111" stroke-width="2" />
                                </svg>
                            </div>
                            <div class="text">Người dùng</div>
                        </a>
                        <ul class="sub-menu">
                            <li class="sub-menu-item">
                                <a href="{{ route('admin.users.index') }}">
                                    <div class="text">Danh sách người dùng</div>
                                </a>
                            </li>
                            <li class="sub-menu-item">
                                <a href="{{ route('admin.users.create') }}">
                                    <div class="text">Thêm mới người dùng</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- Đánh Giá -->
                    <li class="menu-item has-children {{ request()->routeIs('admin.reviews.*') ? 'active' : '' }}">
                        <a href="javascript:void(0);" class="menu-item-button">
                            <div class="icon">
                                <svg width="24" height="24" fill="none">
                                    <polygon points="12,2 15,9 22,9.3 17,14 18.5,21 12,17.5 5.5,21 7,14 2,9.3 9,9"
                                        fill="#111" stroke="#111" stroke-width="1.5" />
                                </svg>
                            </div>
                            <div class="text">Đánh Giá</div>
                        </a>
                        <ul class="sub-menu">
                            <li class="sub-menu-item">
                                <a href="{{ route('admin.reviews.index') }}">
                                    <div class="text">Danh Sách Đánh Giá</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- Trang -->
                    <li class="menu-item has-children {{ request()->routeIs('admin.pages.*') ? 'active' : '' }}">
                        <a href="javascript:void(0);" class="menu-item-button">
                            <div class="icon">
                                <svg width="24" height="24" fill="none">
                                    <rect x="4" y="4" width="16" height="16" rx="2" stroke="#111"
                                        stroke-width="2" />
                                    <line x1="8" y1="8" x2="16" y2="8"
                                        stroke="#111" stroke-width="2" />
                                    <line x1="8" y1="12" x2="16" y2="12"
                                        stroke="#111" stroke-width="2" />
                                    <line x1="8" y1="16" x2="16" y2="16"
                                        stroke="#111" stroke-width="2" />
                                </svg>
                            </div>
                            <div class="text">Trang</div>
                        </a>
                        <ul class="sub-menu">
                            <li class="sub-menu-item">
                                <a href="{{ route('admin.pages.index') }}">
                                    <div class="text">Danh sách trang</div>
                                </a>
                            </li>
                            <li class="sub-menu-item">
                                <a href="{{ route('admin.pages.create') }}">
                                    <div class="text">Thêm trang mới</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- Liên Hệ -->
                    <li class="menu-item has-children {{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}">
                        <a href="javascript:void(0);" class="menu-item-button">
                            <div class="icon">
                                <svg width="24" height="24" fill="none">
                                    <path d="M21 3L3 21" stroke="#111" stroke-width="2" />
                                    <path d="M3 3l18 18" stroke="#111" stroke-width="2" />
                                    <rect x="4" y="4" width="16" height="16" rx="2" stroke="#111"
                                        stroke-width="2" />
                                </svg>
                            </div>
                            <div class="text">Liên Hệ</div>
                        </a>
                        <ul class="sub-menu">
                            <li class="sub-menu-item">
                                <a href="{{ route('admin.contacts.index') }}">
                                    <div class="text">Danh Sách Liên Hệ</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const currentRoute = window.location.pathname;
        const menuItems = document.querySelectorAll('.menu-item a');

        menuItems.forEach(item => {
            const href = item.getAttribute('href');
            if (href && currentRoute.includes(href.replace(/^\//, ''))) {
                item.closest('.menu-item').classList.add('active');
            }
        });
    });
</script>

<style>
    .menu-item.active>a {
        background-color: #f8f9fa;
        color: #007bff;
    }

    .menu-item.active>a .icon svg {
        fill: #007bff;
    }

    .menu-item.active .text {
        color: #007bff;
    }
</style>
