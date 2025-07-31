@php
    $user = Auth::user();
@endphp
<div class="headermain"
    style="position: sticky; top: 0; z-index: 1000; background: #fff;  box-shadow: 0 5px 35px rgb(16 16 16 / 25%);">
    <div class="contentmain">

        <nav class="box-menu" style="flex: 1; min-width: 0; align-items: center; ">
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
        <div class="box-logo" style="flex: 0 0 auto; display: flex; align-items: center; height: 48px;">
            <div class="logo">
                <a href="{{ route('home') }}" class="logo-link">
                    {{-- <img src="{{ asset('client/picture/logo.png') }}" alt="Logo" /> --}}
                    <img src="{{ asset('client/picture/logo.png') }}" alt="Logo" />
                </a>
            </div>
        </div>
        <div class="box-icon d-flex align-items-center gap-3"
            style="flex: 1; justify-content: flex-end; height: 48px; display: flex; align-items: center;">
            <form action="{{ route('client.search') }}" method="GET" class="search-bar"
                style="position:relative; width:320px; margin-right:12px; height:36px; display:flex; align-items:center;">
                <input type="text" name="q" id="search-input" autocomplete="off"
                    placeholder="Tìm kiếm sản phẩm..."
                    style="width:100%;height:36px;padding:8px 40px 8px 16px;border-radius:18px;border:1px solid #ddd;font-size:15px;line-height:1.2;">
                <button type="submit" id="search-submit"
                    style="position:absolute;right:8px;top:50%;transform:translateY(-50%);background:none;border:none;height:28px;display:flex;align-items:center;">
                    <i class="fa-solid fa-magnifying-glass" style="color:#fcad02;font-size:18px;"></i>
                </button>
                <div id="search-suggestions"
                    style="display:none;position:absolute;top:110%;left:0;width:100%;background:#fff;box-shadow:0 2px 8px rgba(0,0,0,0.15);border-radius:8px;z-index:9999;max-height:400px;overflow:auto;">
                </div>
                <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const searchInput = document.getElementById('search-input');
                    const searchSuggestions = document.getElementById('search-suggestions');
                    let searchTimeout;

                    searchInput.addEventListener('input', function() {
                        const query = this.value.trim();
                        
                        clearTimeout(searchTimeout);
                        
                        if (query.length < 2) {
                            searchSuggestions.style.display = 'none';
                            return;
                        }

                        // Set timeout to prevent too many requests
                        searchTimeout = setTimeout(function() {
                            // Add loading indicator
                            searchSuggestions.innerHTML = '<div class="p-3 text-center">Đang tìm kiếm...</div>';
                            searchSuggestions.style.display = 'block';

                            // Make AJAX request
                            fetch(`/search?q=${encodeURIComponent(query)}`, {
                                headers: {
                                    'X-Requested-With': 'XMLHttpRequest'
                                }
                            })
                            .then(response => response.json())
                            .then(products => {
                                if (products.length > 0) {
                                    // Build HTML for suggestions
                                    const html = products.map(product => `
                                        <a href="/${product.slug}" class="suggestion-item">
                                            <div class="d-flex align-items-center p-2 hover-bg">
                                                <div class="search-product-image me-2">
                                                    <img src="${product.image}" alt="${product.name}" 
                                                         style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px;">
                                                </div>
                                                <div class="flex-grow-1">
                                                    <div class="search-product-name" style="font-weight: 500; color: #333;">
                                                        ${product.name}
                                                    </div>
                                                    <div class="search-product-price" style="color: #fc573b; font-weight: 600;">
                                                        ${product.price}đ
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    `).join('');
                                    
                                    searchSuggestions.innerHTML = html;
                                } else {
                                    searchSuggestions.innerHTML = '<div class="p-3 text-center">Không tìm thấy sản phẩm</div>';
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                searchSuggestions.innerHTML = '<div class="p-3 text-center">Có lỗi xảy ra</div>';
                            });
                        }, 300);
                    });

                    // Hide suggestions when clicking outside
                    document.addEventListener('click', function(e) {
                        if (!searchInput.contains(e.target) && !searchSuggestions.contains(e.target)) {
                            searchSuggestions.style.display = 'none';
                        }
                    });

                    // Style for suggestion items
                    const style = document.createElement('style');
                    style.textContent = `
                        .suggestion-item {
                            display: block;
                            text-decoration: none;
                            border-bottom: 1px solid #eee;
                        }
                        .suggestion-item:last-child {
                            border-bottom: none;
                        }
                        .hover-bg:hover {
                            background-color: #f8f9fa;
                        }
                        .search-product-name {
                            font-size: 14px;
                            margin-bottom: 4px;
                            display: -webkit-box;
                            -webkit-line-clamp: 2;
                            -webkit-box-orient: vertical;
                            overflow: hidden;
                        }
                        .search-product-price {
                            font-size: 13px;
                        }
                    `;
                    document.head.appendChild(style);
                });
                </script>
            </form>
            
            <script>
            $(document).ready(function() {
                var searchTimeout;
                var searchInput = $('#search-input');
                var searchSuggestions = $('#search-suggestions');

                searchInput.on('input', function() {
                    clearTimeout(searchTimeout);
                    var query = $(this).val().trim();

                    if (query.length < 2) {
                        searchSuggestions.hide().empty();
                        return;
                    }

                    searchTimeout = setTimeout(function() {
                        $.ajax({
                            url: '{{ route("client.search") }}',
                            method: 'GET',
                            data: {
                                q: query
                            },
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            },
                            success: function(response) {
                                if (response && response.length > 0) {
                                    var html = '';
                                    response.forEach(function(product) {
                                        html += `
                                        <a href="/product/${product.slug}" class="search-suggestion-item">
                                            <div class="d-flex align-items-center p-2" style="border-bottom: 1px solid #eee;">
                                                <div class="search-product-image" style="width: 50px; height: 50px; margin-right: 10px;">
                                                    <img src="${product.image}" alt="${product.name}" style="width: 100%; height: 100%; object-fit: cover;">
                                                </div>
                                                <div class="search-product-info" style="flex: 1;">
                                                    <div class="search-product-name" style="font-weight: 500; color: #333;">${product.name}</div>
                                                    <div class="search-product-price" style="color: #fc573b; font-size: 14px;">${product.price}đ</div>
                                                </div>
                                            </div>
                                        </a>`;
                                    });
                                    searchSuggestions.html(html).show();
                                } else {
                                    searchSuggestions.html('<div class="p-3 text-center">Không tìm thấy sản phẩm</div>').show();
                                }
                            }
                        });
                    }, 300);
                });

                // Ẩn gợi ý khi click ra ngoài
                $(document).on('click', function(e) {
                    if (!$(e.target).closest('.search-bar').length) {
                        searchSuggestions.hide();
                    }
                });

                // Style cho các item gợi ý
                $('<style>')
                    .text(`
                        .search-suggestion-item {
                            display: block;
                            text-decoration: none;
                            transition: background-color 0.2s;
                        }
                        .search-suggestion-item:hover {
                            background-color: #f5f5f5;
                        }
                    `)
                    .appendTo('head');
            });
            </script>


            <div class="box-user dropdown d-flex align-items-center"
                style="height: 36px; display: flex;  position: relative;">
                <a href="{{ Auth::check() ? '#' : route('client.login') }}" id="userDropdown"
                    style="padding: 0; border: none; background: none; display: flex; align-items: center; height: 36px;">
                    @if (Auth::check())
                        <img src="{{ $user && $user->avatar_url ? asset('storage/' . $user->avatar_url) : asset('images/images.jpg') }}"
                            alt="avatar"
                            style="width:32px;height:32px;object-fit:cover;border-radius:50%; display: block; vertical-align: middle; border: 3px solid rgba(255, 48, 41, 0.15);">
                        <span
                            style="margin-left: 8px; color: #fc573b; font-weight: 600; font-size: 13px;">{{ $user && $user->username ? $user->username : ($user && $user->name ? $user->name : '') }}</span>
                    @else
                        <i class="fa-regular fa-user user"
                            style="font-size: 24px; vertical-align: middle; line-height: 1;"></i>
                    @endif
                </a>
                @if (Auth::check())
                    <div class="dropdown-menu simple-profile-dropdown"
                        style="display: none; position: absolute; top: 110%; left: 50%; transform: translateX(-50%); background: #fff; box-shadow: 0 2px 8px rgba(0,0,0,0.15); min-width: 200px; z-index: 100; border-radius: 12px; overflow: hidden; padding: 0;">
                        <a href="{{ route('client.profile.account') }}"
                            style="display: block; padding: 10px 18px; color: #222; text-decoration: none; font-size: 15px; border-bottom: 1px solid #f5f5f5; font-weight: 400; text-align: left;">
                            Tài Khoản Của Tôi</a>
                        <a href="{{ route('client.profile.my_account.order') }}"
                            style="display: block; padding: 10px 18px; color: #222; text-decoration: none; font-size: 15px; border-bottom: 1px solid #f5f5f5; font-weight: 400; text-align: left;">
                            Đơn Mua</a>
                        <form action="{{ route('client.logout') }}" method="POST" style="margin: 0;">
                            @csrf
                            <button type="submit"
                                style="display: block; width: 100%; background: none; border: none; padding: 10px 30px; color: #222; font-size: 15px; font-weight: 400; text-align: left; box-sizing: border-box; outline: none; border-bottom: 1px solid #f5f5f5; cursor: pointer; font-family: inherit;">
                                Đăng Xuất
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

            <div class="box-heart" id="wishlist-header-btn" style="height: 36px; display: flex; align-items: center;">
                <a href="{{ route('client.profile.wishlist') }}" style="display:inline-block;position:relative;">
                    <i class="fa-regular fa-heart heart"></i>
                    @if (isset($headerWishlistCount) && $headerWishlistCount > 0)
                        <span class="wishlist-badge"
                            style="position:absolute;top:-11px;right:-11px;min-width:18px;height:18px;display:flex;align-items:center;justify-content:center;background:#e53935;color:#fff;font-size:11px;padding:0 4px;border-radius:50%;font-weight:bold;line-height:1;box-shadow:0 1px 4px rgba(0,0,0,0.08);z-index:2;">{{ $headerWishlistCount }}</span>
                    @endif
                </a>

                <div class="wishlist-dropdown"
                    style="display:none;position:absolute;top:120%;right:0;min-width:260px;z-index:999;background:#fff;border-radius:8px;box-shadow:0 2px 8px rgba(0,0,0,0.15);padding:12px;">
                    <div id="mini-wishlist-content">
                        @php
                            $wishlistItems =
                                Auth::check() && Auth::user()->wishlist
                                    ? Auth::user()
                                        ->wishlist->items()
                                        ->with('product.images')
                                        ->orderByDesc('created_at')
                                        ->get()
                                    : collect();
                            $maxShow = 5;
                        @endphp
                        @if ($wishlistItems->count())
                            @foreach ($wishlistItems->take($maxShow) as $item)
                                <a href="{{ route('client.product.show', $item->product->slug) }}"
                                    class="mini-wishlist-item-link d-flex align-items-center mb-2 p-2"
                                    style="border-radius:6px;transition:background 0.15s; text-decoration:none; color:#333;"
                                    title="{{ $item->product->name }}">
                                    <img src="{{ $item->product->images->first() ? asset($item->product->images->first()->image_url) : asset('images/no-image.png') }}"
                                        style="width:40px;height:40px;object-fit:cover;border-radius:6px;margin-right:10px;">
                                    <span class="mini-wishlist-name"
                                        style="font-size:14px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:130px;display:inline-block;">{{ $item->product->name }}</span>
                                </a>
                            @endforeach
                            @if ($wishlistItems->count() > $maxShow)
                                <div style="text-align:center;font-size:13px;color:#888;">
                                    +{{ $wishlistItems->count() - $maxShow }} sản phẩm khác...</div>
                            @endif
                        @else
                            <div style="text-align:center;color:#888;font-size:14px;">Chưa có sản phẩm yêu thích</div>
                        @endif
                        <div style="text-align:center;margin-top:8px;">
                            <a href="{{ route('client.profile.wishlist') }}" class="btn btn-sm btn-warning"
                                style="background:#fcad02;color:#fff;font-weight:600;">Xem tất cả</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="cart-popup-group" style="position: relative; display: flex; align-items: center; height: 36px;">
                <a href="{{ route('client.view-cart') }}" class="box-cart" style="position: relative; z-index: 10;">
                    <i class="fa-solid fa-cart-shopping cart"></i>
                    <span class="cart-count-badge" id="cart-count-badge"
                        style="position: absolute; top: -12px; right: -12px; background: #e53935; color: #fff; border-radius: 50%; padding: 2px 6px; font-size: 11px; font-weight: bold; min-width: 18px; height: 18px; display: flex; align-items: center; justify-content: center; text-align: center; box-shadow: 0 1px 4px rgba(0,0,0,0.12); z-index: 2; {{ (!isset($cartCount) || $cartCount == 0) ? 'display: none;' : '' }}">
                        {{ $cartCount ?? 0 }}
                    </span>
                </a>
                <div id="cart-popup-modal"
                    style="display: none; position: absolute; top: 120%; right: 0; background: #fff; border-radius: 12px; box-shadow: 0 6px 24px rgba(0, 0, 0, 0.15); z-index: 100; width: 360px; max-width: 90vw; max-height: 80vh; overflow-y: auto; transition: all 0.2s ease;">
                    <div
                        style="padding: 16px 20px; border-bottom: 1px solid #f0f0f0; font-weight: 600; font-size: 16px; color: #444;">
                        Sản phẩm mới thêm
                    </div>
                    <div id="cart-popup-content" style="padding: 12px 20px;">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const cartGroup = document.querySelector('.cart-popup-group');
        const popup = document.getElementById('cart-popup-modal');
        const cartPopupContent = document.getElementById('cart-popup-content');
        const cartBadge = document.getElementById('cart-count-badge');
        let timeout;

        // Hiển thị popup mini cart khi hover
        if (cartGroup && popup) {
            cartGroup.addEventListener('mouseenter', () => {
                clearTimeout(timeout);
                popup.style.display = 'block';
                loadMiniCart();
            });

            cartGroup.addEventListener('mouseleave', () => {
                timeout = setTimeout(() => {
                    popup.style.display = 'none';
                }, 300); // delay nhỏ để tránh flicker khi rê chuột nhanh
            });
        }

        // Load nội dung mini cart
        function loadMiniCart() {
            if (!cartPopupContent) return;
            fetch('/cart/mini-list')
                .then(response => response.text())
                .then(html => {
                    cartPopupContent.innerHTML = html;
                })
                .catch(error => {
                    console.error('Lỗi khi load mini cart:', error);
                    cartPopupContent.innerHTML = `
                    <div style="padding: 20px 0; text-align: center; color: #888; font-size: 14px;">
                        Có lỗi khi tải dữ liệu giỏ hàng.
                    </div>`;
                });
        }

        // Cập nhật số lượng hiển thị trên badge giỏ hàng
        function updateCartCountBadge(newCount) {
            if (cartBadge) {
                cartBadge.textContent = newCount;
                // Hiển thị/ẩn badge dựa trên số lượng
                if (newCount > 0) {
                    cartBadge.style.display = 'flex';
                } else {
                    cartBadge.style.display = 'none';
                }
            }
        }

        // Cập nhật lại nội dung mini cart
        function updateMiniCartContent() {
            loadMiniCart();
        }

        // Thêm sản phẩm vào giỏ hàng và cập nhật giao diện
        window.addToCartAndUpdate = function(formData) {
            fetch('/cart/add', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        if (data.cart_count !== undefined) {
                            updateCartCountBadge(data.cart_count);
                        }
                        updateMiniCartContent();
                        // alert('Sản phẩm đã được thêm vào giỏ hàng!'); // Đã bỏ thông báo
                    } else {
                        alert(data.message || 'Có lỗi xảy ra!');
                    }
                })
                .catch(error => {
                    console.error('Lỗi khi thêm vào giỏ hàng:', error);
                    alert('Có lỗi xảy ra khi kết nối máy chủ!');
                });
        }

        // Xóa sản phẩm khỏi giỏ hàng và cập nhật giao diện
        window.removeFromCartAndUpdate = function(itemId) {
            fetch('/cart/remove', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        item_id: itemId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        if (data.cartCount !== undefined) {
                            updateCartCountBadge(data.cartCount);
                        }
                        updateMiniCartContent();
                        alert('Đã xóa sản phẩm khỏi giỏ hàng!');
                    } else {
                        alert(data.message || 'Có lỗi xảy ra!');
                    }
                })
                .catch(error => {
                    console.error('Lỗi khi xóa khỏi giỏ hàng:', error);
                    alert('Có lỗi xảy ra khi kết nối máy chủ!');
                });
        }
    });
</script>


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

    #search-suggestions {
        display: none;
        position: absolute;
        top: 110%;
        left: 0;
        width: 100%;
        background: #fff;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        border-radius: 8px;
        z-index: 9999;
        max-height: 400px;
        overflow-y: auto;
        padding: 0;
    }

    .suggest-item {
        display: flex;
        align-items: center;
        padding: 10px 16px;
        border-bottom: 1px solid #f2f2f2;
        text-decoration: none;
        color: #222;
        transition: background 0.15s;
    }

    .suggest-item:last-child {
        border-bottom: none;
    }

    .suggest-item:hover {
        background: #fcf3e6;
    }

    .suggest-thumb {
        width: 44px;
        height: 44px;
        object-fit: cover;
        border-radius: 6px;
        margin-right: 12px;
        background: #f8f8f8;
    }

    .suggest-info {
        flex: 1;
        min-width: 0;
    }

    .suggest-title {
        font-size: 15px;
        font-weight: 600;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .suggest-price {
        color: #fcad02;
        font-size: 14px;
        font-weight: 500;
        margin-top: 2px;
    }
</style>

