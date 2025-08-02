{{-- filepath: d:\laragon\www\Funori-main\resources\views\client\shop.blade.php --}}
@extends('client.layout.client')
@section('title', 'Cửa Hàng')

@section('content')

    <div class="box-banner-shop"
        @if (isset($mainBanner)) style="background: url('{{ asset('storage/' . $mainBanner->image_url) }}') center center/cover no-repeat; border-radius: 16px; min-height: 260px; position: relative;" @endif>
        <div class="in-box-banner" style=" border-radius: 16px; padding: 32px; position: absolute; top: 0;">
            <div class="tf-page-title">
                <div class="container-full" style="padding: 19px 0px;">
                    <div class="heading text-center">@yield('page_title', 'Cửa Hàng')</div>
                </div>
            </div>
            <div class="box-list-product">
                @foreach ($randomParentCategories as $category)
                    <div class="box-shop-product">
                        <a href="{{ route('shop', ['category_id' => $category->id]) }}">
                            <img src="{{ $category->image_url ? asset('storage/' . $category->image_url) : asset('images/no-image.png') }}"
                                alt="{{ $category->name }}">
                            <div class="name-product">
                                <p>{{ $category->name }}</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="box-shop">
        <div class="box-sidebar">
            <div class="first-sidebar" style="margin-bottom: 20px;">
                <div class="title-sidebar">
                    Danh mục
                </div>
                @foreach ($categories as $category)
                    @if ($category->products_count > 0)
                        <div class="in-sidebar">
                            <a href="{{ route('shop', ['category_id' => $category->id]) }}"
                                style="display:flex;justify-content:space-between;align-items:center;text-decoration:none;color:inherit;">
                                <div class="name"
                                    @if (request('category_id') == $category->id) style="font-weight:bold;color:#fcad02;" @endif>
                                    {{ $category->name }}
                                </div>
                                <div class="box-number">{{ $category->products_count }}</div>
                            </a>
                        </div>
                    @endif
                @endforeach
            </div>
            {{-- <div class="box-price">
                <div class="price-title">Price</div>
                <input type="range" name="" id="">
                <div class="box-range">
                    Range:
                    <span>$50</span>
                    <span>-</span>
                    <span>$500</span>
                </div>
            </div> --}}

            <div class="all-box-brands">
                <div class="title-brands">Thương hiệu</div>
                <div class="box-list-brands">
                    @foreach ($brands as $brand)
                        <div class="box-img-brands" style="margin-bottom: 10px;">
                            <a href="{{ route('shop', array_merge(request()->except('page'), ['brand_id' => $brand->id])) }}"
                                style="display:block;{{ request('brand_id') == $brand->id ? 'border:2px solid #fcad02;border-radius:8px;' : '' }}">
                                @if ($brand->logo_url)
                                    <img style="width: 100% ;" src="{{ asset('storage/' . $brand->logo_url) }}"
                                        alt="{{ $brand->name }}" style="max-width:60px;max-height:60px;">
                                @else
                                    <div
                                        style="width:60px;height:60px;display:flex;align-items:center;justify-content:center;background:#f3f3f3;border-radius:8px;">
                                        {{ $brand->name }}
                                    </div>
                                @endif
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="first-sidebar" style="margin-bottom: 20px;">
                <div class="title-sidebar">
                    Chất liệu
                </div>
                @foreach ($materials as $material)
                    <div class="in-sidebar">
                        <a href="{{ route('shop', array_merge(request()->except('page'), ['material' => $material->id])) }}"
                            style="display:flex;justify-content:space-between;align-items:center;text-decoration:none;color:inherit;">
                            <div class="name"
                                @if (request('material') == $material->id) style="font-weight:bold;color:#fcad02;" @endif>
                                {{ $material->value }}
                            </div>

                        </a>
                    </div>
                @endforeach
            </div>
            <div class="box-feature-product">
                <div class="text-feature-product">Feature Product</div>
                <div>
                    @foreach ($featuredProducts as $product)
                        <div class="box-product-in" style="{{ $loop->last ? 'border: none;' : '' }}">
                            <div class="picture-product-in">
                                <a href="">
                                    <img src="{{ $product->images->first() ? asset($product->images->first()->image_url) : asset('images/no-image.png') }}"
                                        alt="{{ $product->name }}">
                                </a>
                            </div>
                            <div class="box-in-content">
                                <div class="box-star">
                                    @php
                                        $avg = round($product->reviews->avg('rating'), 1);
                                    @endphp
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= floor($avg))
                                            <i class="fa-solid fa-star" style="color: #fcad02;"></i>
                                        @elseif($i - $avg < 1 && $avg - floor($avg) >= 0.5)
                                            <i class="fa-solid fa-star-half-stroke" style="color: #fcad02;"></i>
                                        @else
                                            <i class="fa-solid fa-star" style="color: #ccc;"></i>
                                        @endif
                                    @endfor
                                </div>
                                <div class="title-feature-product">
                                    {{ $product->name }}
                                </div>
                                <div class="price-feature-prod">
                                    @if ($product->old_price)
                                        <del>{{ number_format($product->old_price, 0, ',', '.') }} đ</del>
                                    @endif
                                    <span>{{ number_format($product->regular_price, 0, ',', '.') }} đ</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="box-all-product">
            @if (session('success'))
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        toastr.success("{{ session('success') }}");
                    });
                </script>
            @endif
            @if (session('info'))
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        toastr.info("{{ session('info') }}");
                    });
                </script>
            @endif
            @if (session('error'))
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        toastr.error("{{ session('error') }}");
                    });
                </script>
            @endif
            <div class="header-product">
                <form method="GET" id="sort-form" style="display:inline;">
                    @foreach (request()->except(['sort', 'page']) as $key => $value)
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                    @endforeach
                    <select name="sort" id="box-all-list" onchange="document.getElementById('sort-form').submit()">
                        <option value="">Sắp xếp mặc định</option>
                        <option value="popularity" {{ request('sort') == 'popularity' ? 'selected' : '' }}>Phổ biến nhất
                        </option>
                        <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>Đánh giá cao nhất
                        </option>
                        <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Mới nhất</option>
                        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Giá: Thấp đến Cao
                        </option>
                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Giá: Cao đến
                            Thấp</option>
                    </select>
                </form>
            </div>
            <div class="all-box-new-product" style="display: flex; flex-wrap: wrap; gap: 24px;">
                @php
                    $wishlistProductIds = [];
                    if (Auth::check() && Auth::user()->wishlist) {
                        $wishlistProductIds = Auth::user()->wishlist->items->pluck('product_id')->toArray();
                    }
                @endphp
                @foreach ($products as $product)
                    <div class="new-product-1">
                        <div class="pic-product-1">
                            <a href="{{ route('client.product.show', $product->slug) }}">
                                <img src="{{ $product->images->first() ? asset($product->images->first()->image_url) : asset('images/no-image.png') }}"
                                    alt="{{ $product->name }}"
                                    onmouseover="this.src='{{ $product->images->get(1) ? asset($product->images->get(1)->image_url) : asset($product->images->first() ? $product->images->first()->image_url : 'images/no-image.png') }}'"
                                    onmouseout="this.src='{{ $product->images->first() ? asset($product->images->first()->image_url) : asset('images/no-image.png') }}'">
                            </a>

                            @if ($product->status !== 'draft')
                                <div class="box-icon-new-product">
                                    <a href="{{ route('client.product.show', $product->slug) }}">
                                        <i style="font-size: 19px;" id="search-Product"
                                            class="fa-solid fa-magnifying-glass"></i>
                                    </a>
                                    <button class="wishlist-btn" data-product-id="{{ $product->id }}"
                                        style="background:none;border:none;padding:0;cursor:pointer;">
                                        <i style="font-size: 18px; color:{{ in_array($product->id, $wishlistProductIds) ? 'red' : '#545353' }};"
                                            class="fa-solid fa-heart" id="heart-Product"></i>
                                    </button>
                                    <a href="{{ route('client.product.show', $product->slug) }}">
                                        <i style="font-size: 18px;" id="cart-Product"
                                            class="fa-solid fa-cart-shopping"></i>
                                    </a>
                                </div>
                            @else
                                {{-- <div style="text-align: center; padding: 10px 0; color: red; font-weight: bold;">
                                    Sản phẩm ngừng kinh doanh
                                </div> --}}
                            @endif
                        </div>

                        <div class="box-star" style="width: 100%; height: 23px;">
                            @php
                                $avg = round($product->reviews->avg('rating'), 1);
                                $count = $product->reviews->count();
                            @endphp
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= floor($avg))
                                    <i style="color: #fcad02; margin-left: 0;" class="fa-solid fa-star"></i>
                                @elseif($i - $avg < 1 && $avg - floor($avg) >= 0.5)
                                    <i style="color: #fcad02; margin-left: 0;" class="fa-solid fa-star-half-stroke"></i>
                                @else
                                    <i style="color: #ccc; margin-left: 0;" class="fa-solid fa-star"></i>
                                @endif
                            @endfor
                            <span style="margin-left: 5px; color: rgb(201, 201, 201); font-size: 12px;">
                                ({{ $count }} review{{ $count != 1 ? 's' : '' }})
                            </span>
                        </div>

                        <div class="title-new-product">
                            <a href="{{ route('client.product.show', $product->slug) }}">{{ $product->name }}</a>
                        </div>

                        @php
                            $totalStock = $product->variants->sum('stock_quantity');
                        @endphp

                        <div style="font-size: 16px; color: rgb(170, 167, 167);">
                            @if ($product->status === 'draft')
                                <span style="color:red;font-weight:bold;">Ngừng kinh doanh</span>
                            @elseif ($product->variants->count() > 0 && $totalStock <= 0)
                                <span style="color:red;font-weight:bold;">Hết hàng</span>
                            @else
                                {{ number_format($product->regular_price, 0, ',', '.') }} đ
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="box-footer-product"
                style="display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; padding: 18px 20px; background: #f8f8f8; border-radius: 10px; margin-top: 24px;">
                <div class="title-footer-product" style="font-size: 15px; color: #333;">
                    Hiển thị
                    <span style="font-weight: bold;">{{ $products->firstItem() }}–{{ $products->lastItem() }}</span>
                    trên tổng số
                    <span style="font-weight: bold;">{{ $products->total() }}</span>
                    sản phẩm
                </div>
                <div class="buttom-load"
                    style="min-width: 180px; display: flex; justify-content: flex-end; padding-left: 44%;">
                    {{ $products->links('ecomus.pagination') }}
                </div>
            </div>
        </div>
    </div>

    <script>
        // thêm vào yêu thích
        document.addEventListener("DOMContentLoaded", function() {
            toastr.options = {
                "positionClass": "toast-top-right",
                "timeOut": "1000",
                "closeButton": true,
                "progressBar": true
            };
            let wishlistProcessing = false;
            document.querySelectorAll('.wishlist-btn').forEach(function(btn) {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    if (wishlistProcessing) {
                        toastr.warning('Bạn thao tác quá nhanh, vui lòng chờ!');
                        return;
                    }
                    wishlistProcessing = true;
                    var isLoggedIn = {{ Auth::check() ? 'true' : 'false' }};
                    if (!isLoggedIn) {
                        toastr.error('Bạn cần đăng nhập!');
                        wishlistProcessing = false;
                        return;
                    }
                    var productId = this.getAttribute('data-product-id');
                    var icon = this.querySelector('i');
                    var isActive = icon.style.color === 'red';
                    var url = isActive ? "{{ route('client.wishlist.remove') }}" :
                        "{{ route('client.wishlist.add') }}";
                    var method = 'POST';
                    var body = isActive ? new FormData() : JSON.stringify({
                        product_id: productId
                    });
                    if (isActive) body.append('product_id', productId);
                    fetch(url, {
                            method: method,
                            headers: isActive ? {
                                'X-CSRF-TOKEN': document.querySelector(
                                    'meta[name=csrf-token]').getAttribute('content'),
                                'Accept': 'application/json'
                            } : {
                                'Accept': 'application/json',
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector(
                                    'meta[name=csrf-token]').getAttribute('content')
                            },
                            body: body
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (!isActive && data.success !== false) {
                                toastr.success(data.message || 'Đã thêm vào yêu thích!');
                                icon.classList.remove('fa-regular');
                                icon.classList.add('fa-solid');
                                icon.style.color = 'red';
                                // Badge +1
                                var badge = document.querySelector('.wishlist-badge');
                                if (badge) {
                                    let count = parseInt(badge.textContent) || 0;
                                    badge.textContent = count + 1;
                                } else {
                                    var heartIcon = document.querySelector(
                                        '#wishlist-header-btn .fa-heart');
                                    if (heartIcon) {
                                        var span = document.createElement('span');
                                        span.className = 'wishlist-badge';
                                        span.style =
                                            'position:absolute;top:-6px;right:-10px;min-width:18px;height:18px;display:flex;align-items:center;justify-content:center;background:#fcad02;color:#fff;font-size:11px;padding:0 4px;border-radius:50%;font-weight:bold;line-height:1;box-shadow:0 1px 4px rgba(0,0,0,0.08);z-index:2;';
                                        span.textContent = '1';
                                        heartIcon.parentNode.appendChild(span);
                                    }
                                }
                            } else if (isActive && data.success) {
                                toastr.success('Đã xóa khỏi yêu thích!');
                                icon.classList.remove('fa-solid');
                                icon.classList.add('fa-regular');
                                icon.style.color = '#545353';
                                // Badge -1
                                var badge = document.querySelector('.wishlist-badge');
                                if (badge) {
                                    let count = parseInt(badge.textContent) || 0;
                                    badge.textContent = Math.max(count - 1, 0);
                                    if (badge.textContent == '0') badge.remove();
                                }
                                // Đổi màu thông báo xóa khỏi yêu thích
                                setTimeout(function() {
                                    var toast = document.querySelector(
                                        '.toast-success');
                                    if (toast) {
                                        toast.style.backgroundColor = '#e53935';
                                        toast.style.color = '#fff';
                                    }
                                }, 100);
                            } else {
                                if (data.message && data.message.includes('đăng nhập')) {
                                    toastr.error(data.message);
                                } else {
                                    toastr.info(data.message ||
                                        'Sản phẩm đã có trong yêu thích!');
                                }
                            }
                            // Cập nhật mini-wishlist
                            fetch('/wishlist/mini-list')
                                .then(res => res.text())
                                .then(html => {
                                    var miniWishlist = document.querySelector(
                                        '#mini-wishlist-content');
                                    if (miniWishlist) miniWishlist.innerHTML = html;
                                });
                        })
                        .catch(error => {
                            toastr.error('Lỗi xảy ra!');
                            console.error(error);
                        })
                        .finally(() => {
                            setTimeout(function() {
                                wishlistProcessing = false;
                            }, 600);
                        });
                });
            });
        });
        //
    </script>

@endsection
