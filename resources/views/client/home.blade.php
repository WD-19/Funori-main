@extends('client.layout.client')

@section('title', 'Trang chủ')

@section('content')
    @php
        $wishlistProductIds = [];
        if (Auth::check() && Auth::user()->wishlist) {
            $wishlistProductIds = Auth::user()->wishlist->items->pluck('product_id')->toArray();
        }
    @endphp
    <div class="banner">
        <script>
            var img = [
                @foreach ($banners as $banner)
                    "{{ asset('storage/' . $banner->image_url) }}",
                @endforeach
            ];
        </script>
        <img id="pic" src="{{ count($banners) ? asset('storage/' . $banners[0]->image_url) : '' }}" alt="" />

        <div class="in-content">
            <div class="tran-box">
                <div class="title">Thiết kế cho cuộc sống</div>
                <div class="text-title">
                    Chào đón những sản phẩm mới nhất của chúng tôi.
                </div>
                <div class="all-button">
                    <button>Xem sản phẩm</button>
                </div>
            </div>
            <button id="left">
                <i class="fa-solid fa-arrow-left"></i>
            </button>
            <button id="right">
                <i class="fa-solid fa-arrow-right"></i>
            </button>
        </div>
        <div id="list">
            <ul id="banner-dots">
                @foreach ($banners as $index => $banner)
                    <li><button onclick="indexNumber({{ $index }})"></button></li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="box-room">
        <a href="">
            <div class="living-room">
                <img src="{{ asset('client/picture/Living-room.jpg') }}" alt="" />
                <div class="title-Living-room">Phòng khách</div>
                <div class="Shop-col">Xem bộ sưu tập</div>
            </div>
        </a>
        <a href="">
            <div class="bed-room">
                <img src="{{ asset('client/picture/bedroom.jpg') }}" alt="" />
                <div class="title-bed-room">Phòng ngủ</div>
                <div class="Shop-col">Xem bộ sưu tập</div>
            </div>
        </a>
        <a href="">
            <div class="ketchen-room">
                <img src="{{ asset('client/picture/ketchen-room.jpg') }}" alt="" />
                <div class="title-kitchen-room">Phòng bếp</div>
                <div class="Shop-col">Xem bộ sưu tập</div>
            </div>
        </a>
    </div>
    <div class="setion-shop">
        <div class="box-title">
            <div class="title-shop">Chọn nội thất theo nhu cầu</div>
        </div>
        <div class="all-box-product">
            <div class="box-product">
                <a href="">
                    <img src="{{ asset('client/picture/categories-9.jpg') }}" alt="" />
                    <div class="title-product">Ghế bành</div>
                </a>
            </div>
            <div class="box-product">
                <a href="#1">
                    <img src="{{ asset('client/picture/categories-7.jpg') }}" alt="" />
                    <div class="title-product">Ghế ăn</div>
                </a>
            </div>
            <div class="box-product">
                <a href="#2">
                    <img src="{{ asset('client/picture/categories-6.jpg') }}" alt="" />
                    <div class="title-product">Sofa</div>
                </a>
            </div>
            <div class="box-product">
                <a href="#3">
                    <img src="{{ asset('client/picture/categories-11.jpg') }}" alt="" />
                    <div class="title-product">Đèn chiếu sáng</div>
                </a>
            </div>
            <div class="box-product">
                <a href="#4">
                    <img src="{{ asset('client/picture/categories-10.jpg') }}" alt="" />
                    <div class="title-product">Tủ kệ</div>
                </a>
            </div>
        </div>
    </div>
    <div class="box-product-sell">
        <div class="box-product-sell-2">
            <div class="in-title">
                <div class="word">Sản phẩm mới</div>
                <div class="see-deals">
                    <a href="{{ route('shop') }}">
                        Xem tất cả sản phẩm
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            <div class="all-new-product">
                @foreach ($products as $product)
                    <div class="new-product">
                        <div class="all-product">
                            <a href="{{ route('client.product.show', ['slug' => $product->slug]) }}"
                                style="text-decoration: none">
                                <div class="new-img-product">
                                    <img src="{{ asset($product->thumbnail->image_url ?? 'default.jpg') }}"
                                        alt="{{ $product->thumbnail->alt_text ?? $product->name }}">
                                    <div class="note-notif">
                                        @if ($product->is_featured)
                                            <div class="title-hot">Hot</div>
                                        @endif
                                    </div>
                            </a>
                            <div class="all-box-icon">
                                <button class="wishlist-btn" data-product-id="{{ $product->id }}"
                                    style="background:none;border:none;padding:0;cursor:pointer;">
                                    <i style="font-size: 18px; color:{{ in_array($product->id, $wishlistProductIds) ? 'red' : '#545353' }};"
                                        class="fa-solid fa-heart" id="heart-Product"></i>
                                </button>
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </div>
                        </div>
                        <div class="contents-new-product">
                            <div class="star">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="fa-solid fa-star"></i>
                                @endfor
                            </div>
                            <div class="view-product">
                                ({{ $product->reviews->count() }} đánh giá)
                            </div>
                        </div>


                        <div class="box-name-product">
                            <div class="name-product">{{ $product->name }}</div>
                            <div id="Prict-prod" class="price-product">
                                <span>{{ number_format($product->regular_price) }} đ</span>
                            </div>
                            <div class="buttom-1">
                                <button type="submit">
                                    <i class="fa-solid fa-cart-plus"></i>
                                    <span>Thêm vào giỏ</span>
                                </button>
                            </div>

                        </div>
                    </div>
            </div>
            @endforeach

            {{-- <div class="new-product">
                    <div class="all-product">
                        <a href="" style="text-decoration: none">
                            <div class="new-img-product">
                                <img id="Pic-2" src="{{ asset('client/picture/img-15-9-600x600.jpg') }}"
                                    alt="" />
                                <div class="note-notif">
                                    <!-- <div class="box-sell">
                                                    -33%
                                                </div> -->
                                    <div class="title-hot">Hot</div>
                                </div>
                                <div class="all-box-icon">
                                    <i class="fa-regular fa-heart"></i>
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </div>
                            </div>
                            <div class="contents-new-product">
                                <div class="star">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                </div>
                                <div class="view-product">(4 review)</div>
                            </div>
                        </a>
                        <div class="box-name-product">
                            <div class="name-product">Zunkel Schawarz</div>
                            <div class="price-product">
                                <!-- <del>$ 150.00</del> -->
                                <span>$ 100.00</span>
                            </div>
                            <div class="buttom-1">
                                <button type="submit">
                                    <i class="fa-solid fa-cart-plus"></i>
                                    <span>Thêm vào giỏ</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="new-product">
                    <div class="all-product">
                        <a href="" style="text-decoration: none">
                            <div class="new-img-product">
                                <img id="Pic-3" src="{{ asset('client/picture/products-1-600x600.jpg') }}"
                                    alt="" />
                                <div class="note-notif">
                                    <div class="box-sell">-33%</div>
                                    <div class="title-hot">Hot</div>
                                </div>
                                <div class="all-box-icon">
                                    <i class="fa-regular fa-heart"></i>
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </div>
                            </div>
                            <div class="contents-new-product">
                                <div class="star">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                </div>
                                <div class="view-product">(4 review)</div>
                            </div>
                        </a>
                        <div class="box-name-product">
                            <div class="name-product">
                                Drop Dining Chair
                            </div>
                            <div class="price-product">
                                <del>$ 200.00</del>
                                <span>$ 180.00</span>
                            </div>
                            <div class="buttom-1">
                                <button type="submit">
                                    <i class="fa-solid fa-cart-plus"></i>
                                    <span>Thêm vào giỏ</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div> --}}
        </div>
    </div>
    </div>
    <div class="box-bg">
        <div class="box-img">
            <img class="pic-animation" src="{{ asset('client/picture/text-animation.png') }}" alt="" />
            <img class="pic-chair" src="{{ asset('client/picture/img-1.png') }}" alt="" />
        </div>
        <div class="box-content"
            style="background: #f5f5f5; padding: 32px 0; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
            <div class="title-content" style="color: #222; font-size: 2rem; font-weight: bold;">Funori furniture</div>
            <div class="box-first-content">
                <div class="first-content">
                    <!-- SVG giữ nguyên -->
                    <!-- ... -->
                </div>
                <div class="word-content">
                    <h3 style="color: #ff9b42; font-weight: bold;">DỊCH VỤ TỐT NHẤT</h3>
                    <p style="color: #333;">
                        Chúng tôi luôn đặt khách hàng lên hàng đầu. Dịch vụ chuyên nghiệp,<br />
                        tận tâm và sẵn sàng phục vụ bạn mọi lúc. Trải nghiệm chất lượng tuyệt vời tại đây.
                    </p>
                </div>

            </div>
            <div class="box-first-content">
                <div class="first-content">
                    <!-- SVG giữ nguyên -->
                    <!-- ... -->
                </div>
                <div class="word-content">
                    <h3 style="color: #ff9b42; font-weight: bold;">Thiết kế nội thất hiện đại</h3>
                    <p style="color: #333;">
                        Chúng tôi cung cấp các mẫu nội thất với thiết kế tinh tế, phù hợp với mọi không gian sống.<br />
                        Chất lượng cao, kiểu dáng hiện đại, mang lại sự tiện nghi và thẩm mỹ cho ngôi nhà của bạn.
                    </p>
                </div>

            </div>
            <div class="box-button">
                <button
                    style="background: #ff9b42; color: #fff; border: none; padding: 10px 23px; border-radius: 6px; font-weight: bold;">Khám
                    phá</button>
            </div>
        </div>
    </div>
    <div class="all-box-banner">
        <div class="box-first-banner">
            <div class="box-img-banner">
                <a href="">
                    <img src="{{ asset('client/Picture/banner-6-1.jpg') }}" alt="" />
                </a>
            </div>
            <div class="title-in-banner">
                <h3>Biến ngôi nhà thành tổ ấm hoàn hảo</h3>
                <a href="">Xem Bộ Sưu Tập</a>
            </div>

        </div>
        <div class="box-first-banner">
            <div class="box-img-banner">
                <a href="">
                    <img src="{{ asset('client/Picture/banner-7-1.jpg') }}" alt="" />
                </a>
            </div>
            <div class="title-in-banner">
                <h3>Từ sofa nhỏ đến bộ ghế cao cấp</h3>
                <a href="">Xem Bộ Sưu Tập</a>
            </div>

        </div>
    </div>
    <div class="box-brand">
        <div class="in-brand">
            <a href="">
                <img src="{{ asset('client/picture/brand-1-1.jpg') }}" alt="" />
            </a>
            <a href="">
                <img src="{{ asset('client/picture/brand-2-1.jpg') }}" alt="" />
            </a>
            <a href="">
                <img src="{{ asset('client/picture/brand-3-1.jpg') }}" alt="" />
            </a>
            <a href="">
                <img src="{{ asset('client/picture/brand-4-1.jpg') }}" alt="" />
            </a>
            <a href="">
                <img src="{{ asset('client/picture/brand-5-1.jpg') }}" alt="" />
            </a>
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
                    var isActive = icon.classList.contains('fa-solid') && icon.style.color ===
                    'red';
                    var url = isActive ? "{{ route('client.wishlist.remove') }}" :
                        "{{ route('client.wishlist.add') }}";
                    var method = 'POST';
                    var body = JSON.stringify({
                        product_id: productId
                    });
                    fetch(url, {
                            method: method,
                            headers: {
                                'Accept': 'application/json',
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]')
                                    .getAttribute('content')
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
                            fetch('{{ route('wishlist.miniList') }}')
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
