@extends('client.layout.client')

@section('title', $product->name)
<link rel="stylesheet" href="{{ asset('client/ecomus/fonts/fonts.css') }}">
<link rel="stylesheet" href="{{ asset('client/ecomus/fonts/font-icons.css') }}">
<link rel="stylesheet" href="{{ asset('client/ecomus/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('client/ecomus/css/swiper-bundle.min.css') }}">
<link rel="stylesheet" href="{{ asset('client/ecomus/css/animate.css') }}">
<link rel="stylesheet" href="{{ asset('client/ecomus/css/styles.css') }}">
@section('content')
    <!-- Kiểm tra xem người dùng đã đăng nhập và có danh sách yêu thích -->
    @php
        $wishlistProductIds = [];
        if (Auth::check() && Auth::user()->wishlist) {
            $wishlistProductIds = Auth::user()->wishlist->items->pluck('product_id')->toArray();
        }
    @endphp
    <!-- breadcrumb -->
    <div class="tf-breadcrumb">
        <div class="container">
            <div class="tf-breadcrumb-wrap d-flex justify-content-between flex-wrap align-items-center">
                <div class="tf-breadcrumb-list">
                    <a href="{{ route('home') }}" class="text">Trang chủ</a>
                    <i class="icon icon-arrow-right"></i>
                    <a href="#" class="text">{{ $product->category->name ?? 'Danh mục' }}</a>
                    <i class="icon icon-arrow-right"></i>
                    <span class="text">{{ $product->name }}</span>
                </div>
            </div>
        </div>
    </div>
    <!-- /breadcrumb -->

    <!-- Sản phẩm -->
    <section class="flat-spacing-4 pt_0">
        <div class="tf-main-product section-image-zoom">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="tf-product-media-wrap">
                            <div class="thumbs-slider">
                                <div dir="ltr" class="swiper tf-product-media-thumbs other-image-zoom"
                                    id="thumbs-swiper">
                                    <div class="swiper-wrapper">
                                        {{-- Mỗi ảnh phụ là 1 slide --}}
                                        @foreach ($product->images as $image)
                                            <div class="swiper-slide stagger-item">
                                                <div class="item">
                                                    <img style="width: 100%;" class="lazyload mb-1"
                                                        data-src="{{ asset($image->image_url) }}"
                                                        src="{{ asset($image->image_url) }}" alt="{{ $product->name }}">
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="swiper-scrollbar"></div>
                                </div>
                                <style>
                                    #thumbs-swiper {
                                        max-width: 90px;
                                        height: 400px;
                                        /* 5 ảnh x 70px + 4 khoảng cách x 10px */
                                        overflow: hidden;
                                    }

                                    #thumbs-swiper .swiper-wrapper {
                                        flex-direction: column;
                                    }

                                    #thumbs-swiper .swiper-slide {
                                        height: 70px !important;
                                        width: 70px !important;
                                        display: flex;
                                        align-items: center;
                                        justify-content: center;
                                    }
                                </style>
                                <script>
                                    var thumbsSwiper = new Swiper('#thumbs-swiper', {
                                        direction: 'vertical',
                                        slidesPerView: 5, // Hiển thị đúng 5 ảnh
                                        spaceBetween: 10,
                                        mousewheel: true,
                                        scrollbar: {
                                            el: '.swiper-scrollbar',
                                            draggable: true,
                                        },
                                        watchSlidesProgress: true,
                                        watchSlidesVisibility: true,
                                        loop: false,
                                        breakpoints: {
                                            0: {
                                                direction: 'horizontal',
                                                slidesPerView: 5
                                            },
                                            769: {
                                                direction: 'vertical',
                                                slidesPerView: 5
                                            }
                                        }
                                    });
                                </script>
                                <div class="swiper tf-product-media-main" id="gallery-swiper-started">
                                    <div class="swiper-wrapper">
                                        @foreach ($product->images as $image)
                                            <div class="swiper-slide">
                                                <img style="width: 100%;" class="tf-image-zoom lazyload"
                                                    data-zoom="{{ asset($image->image_url) }}"
                                                    data-src="{{ asset($image->image_url) }}"
                                                    src="{{ asset($image->image_url) }}" alt="{{ $product->name }}">
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="swiper-button-next button-style-arrow thumbs-next"></div>
                                    <div class="swiper-button-prev button-style-arrow thumbs-prev"></div>
                                </div>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        var thumbsSwiper = new Swiper('#thumbs-swiper', {
                                            direction: 'vertical',
                                            slidesPerView: 4,
                                            spaceBetween: 10,
                                            watchSlidesProgress: true,
                                            watchSlidesVisibility: true,
                                            loop: false, // Thêm dòng này
                                            breakpoints: {
                                                0: {
                                                    direction: 'horizontal',
                                                    slidesPerView: 'auto'
                                                },
                                                769: {
                                                    direction: 'vertical',
                                                    slidesPerView: 4
                                                }
                                            }
                                        });

                                        var gallerySwiper = new Swiper('#gallery-swiper-started', {
                                            navigation: {
                                                nextEl: '.swiper-button-next',
                                                prevEl: '.swiper-button-prev',
                                            },
                                            loop: true, // Chỉ dùng loop ở gallery
                                            slidesPerView: 1,
                                            spaceBetween: 10,
                                            thumbs: {
                                                swiper: thumbsSwiper
                                            }
                                        });
                                        window.gallerySwiper = gallerySwiper; // <-- Thêm dòng này

                                        // Responsive thumbs direction on resize
                                        window.addEventListener('resize', function() {
                                            let dir = window.innerWidth > 768 ? 'vertical' : 'horizontal';
                                            thumbsSwiper.changeDirection(dir);
                                        });
                                    });
                                </script>
                                <style>
                                    @media (min-width: 1200px) {

                                        .container,
                                        .container-lg,
                                        .container-md,
                                        .container-sm,
                                        .container-xl {
                                            max-width: 1440px;
                                        }
                                    }

                                    #gallery-swiper-started {
                                        max-width: 1200px;
                                        height: 100%;
                                        margin: 0 auto;
                                        border-radius: 18px;
                                        border: #ff6600 1px solid;
                                    }

                                    #gallery-swiper-started .swiper-slide {
                                        display: flex;
                                        justify-content: center;
                                        align-items: center;
                                        height: 100%;
                                    }

                                    #gallery-swiper-started img {
                                        width: auto;
                                        height: 100%;
                                        max-width: 100%;
                                        object-fit: cover;
                                        display: block;
                                        box-shadow: 0 2px 16px rgba(0, 0, 0, 0.08);
                                        background: #fff;
                                        border-radius: 18px;
                                    }

                                    #thumbs-swiper img,
                                    #gallery-swiper-started img {
                                        user-select: none;
                                        -webkit-user-select: none;
                                        -webkit-touch-callout: none;
                                    }

                                    #thumbs-swiper {
                                        max-width: 90px;
                                    }

                                    #thumbs-swiper .swiper-slide {
                                        display: flex;
                                        justify-content: center;
                                        align-items: center;
                                        height: 70px !important;
                                        width: 70px !important;
                                        min-height: 70px !important;
                                        min-width: 70px !important;
                                        max-height: 70px !important;
                                        max-width: 70px !important;
                                        box-sizing: border-box;
                                        padding: 0;
                                    }

                                    #thumbs-swiper .item img {
                                        width: 70px !important;
                                        height: 70px !important;
                                        object-fit: cover;
                                        border-radius: 12px;
                                        display: block;
                                        background: #fff;
                                    }

                                    #thumbs-swiper .swiper-slide.thumb-active .item img {
                                        border: 2px solid #ff6600;
                                        border-radius: 12px;
                                        box-shadow: none;
                                    }

                                    #thumbs-swiper .swiper-slide .item img {
                                        transition: border 0.2s;
                                    }

                                    .tf-product-info-variant-picker {
                                        font-size: 80%;
                                    }

                                    .tf-product-info-variant-picker .variant-box {

                                        min-width: 112px !important;
                                        border-width: 1px !important;
                                        border-radius: 4px !important;
                                        font-size: 110%;
                                    }

                                    .tf-product-info-variant-picker .variant-box img {
                                        width: 25px !important;
                                        /* 36px * 0.7 */
                                        height: 25px !important;
                                    }

                                    .tf-product-info-variant-picker .badge {
                                        font-size: 90%;
                                        padding: 2px 6px;
                                    }
                                </style>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="tf-product-info-wrap position-relative">
                            <div class="tf-zoom-main"></div>
                            <div class="tf-product-info-list other-image-zoom">
                                <div class="tf-product-info-title">
                                    <h5 id="product-title">
                                        {{ $product->name }}
                                        <span id="variant-title" style="font-weight:400; color:#888;"></span>
                                    </h5>
                                </div>
                                <div class="tf-product-info-badges">
                                    @php
                                        // Đếm số lượt đánh giá đã duyệt
                                        $approvedReviews = $reviews->where('status', 'approved');
                                        $reviewCount = $approvedReviews->count();

                                        // Tính trung bình rate
                                        $averageRate = $reviewCount > 0 ? round($approvedReviews->avg('rating'), 1) : 0;
                                    @endphp
                                    <div class="badges text-uppercase">{{ $reviewCount }} Lượt đánh giá | <span
                                            class="ms-2">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <i class="icon icon-star{{ $i <= round($averageRate) ? '' : '-o' }}"></i>
                                            @endfor
                                        </span>
                                    </div>

                                </div>
                                <div class="tf-product-info-badges">
                                    @if ($product->is_featured)
                                        <div class="badges">Nổi bật</div>
                                    @endif
                                </div>
                                {{-- Hiển thị giá --}}
                                <div class="card shadow-none border-0" style="background: #f5f7fa;">
                                    <div class="tf-product-info-price p-3">
                                        <div class="price-on-sale text-danger" id="product-price">
                                            {{ number_format($product->regular_price, 0, ',', '.') }}đ
                                        </div>
                                    </div>
                                </div>

                                {{-- Hiển thị các biến thể (variants) --}}
                                @if ($product->variants->count())
                                    <div class="tf-product-info-variant-picker mb-3">
                                        <!-- shoppingCart -->
                                        <div class="modal fullRight fade modal-shopping-cart" id="shoppingCart">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="header">
                                                        <div class="title fw-5">Thêm vào giỏ hàng</div>
                                                        <span class="icon-close icon-close-popup"
                                                            data-bs-dismiss="modal"></span>
                                                    </div>
                                                    <div class="wrap">
                                                        <div class="tf-mini-cart-wrap">
                                                            <div class="tf-mini-cart-main">
                                                                <div class="tf-mini-cart-sroll">
                                                                    <div class="tf-mini-cart-items">
                                                                        @foreach ($product->variants as $variant)
                                                                            <div class="tf-mini-cart-item{{ ($variant->stock_quantity ?? 0) <= 0 ? ' out-of-stock' : '' }}"
                                                                                data-variant-id="{{ $variant->id }}">
                                                                                <div class="tf-mini-cart-image"
                                                                                    style="margin-left: 12px;">
                                                                                    <a href="javascript:void(0);">
                                                                                        <img style="object-fit: cover;"
                                                                                            src="{{ $variant->image ? asset($variant->image->image_url) : asset('images/products/default.jpg') }}"
                                                                                            alt="{{ $variant->name_variant ?? $product->name }}">
                                                                                    </a>
                                                                                </div>
                                                                                <div class="tf-mini-cart-info">
                                                                                    <a class="title link text-decoration-none fs-5"
                                                                                        href="javascript:void(0);">
                                                                                        {{ $variant->name_variant ?? $product->name }}
                                                                                    </a>
                                                                                    <div class="meta-variant">
                                                                                        @if ($variant->size)
                                                                                            <span>Kích thước:
                                                                                                {{ $variant->size }}</span>
                                                                                        @endif
                                                                                    </div>
                                                                                    <div class="meta-variant">
                                                                                        @if ($variant->material)
                                                                                            <span>Chất liệu:
                                                                                                {{ $variant->material }}</span>
                                                                                        @endif
                                                                                        @if ($variant->attributeValues && $variant->attributeValues->count())
                                                                                            @foreach ($variant->attributeValues as $attrVal)
                                                                                                <span>
                                                                                                    {{ $attrVal->attribute->name ?? '' }}:
                                                                                                    {{ $attrVal->value ?? '' }}</span>
                                                                                            @endforeach
                                                                                        @endif
                                                                                    </div>
                                                                                    <div class="meta-variant">
                                                                                        @if (($variant->stock_quantity ?? 0) <= 0)
                                                                                            <span
                                                                                                style="color: red; font-weight: bold;">Hết
                                                                                                hàng</span>
                                                                                        @else
                                                                                            <span>Tồn kho:
                                                                                                {{ $variant->stock_quantity }}</span>
                                                                                        @endif
                                                                                    </div>
                                                                                    <div class="price fw-6">
                                                                                        {{ number_format($product->regular_price + $variant->price_modifier, 0, ',', '.') }}đ
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        @endforeach

                                                                        <style>
                                                                            .tf-mini-cart-item.selected {
                                                                                background: lightgray !important;
                                                                                /* màu xanh dương nhạt */
                                                                                transition: background 0.2s;
                                                                            }

                                                                            .tf-mini-cart-item {
                                                                                cursor: pointer;
                                                                            }

                                                                            .tf-mini-cart-item.out-of-stock {
                                                                                background: #f5f5f5 !important;
                                                                                cursor: not-allowed;
                                                                                opacity: 0.5;
                                                                                pointer-events: none;
                                                                            }

                                                                            .tf-mini-cart-item.out-of-stock * {
                                                                                color: #888 !important;
                                                                                /* Làm mờ chữ */
                                                                            }

                                                                            .tf-mini-cart-item.out-of-stock img {
                                                                                filter: grayscale(1) brightness(0.9);
                                                                                opacity: 0.7;
                                                                            }
                                                                        </style>

                                                                        <script>
                                                                            document.addEventListener('DOMContentLoaded', function() {
                                                                                document.querySelectorAll('.tf-mini-cart-item').forEach(function(item) {
                                                                                    item.addEventListener('click', function() {
                                                                                        // Không cho chọn nếu hết hàng
                                                                                        if (this.classList.contains('out-of-stock')) return;

                                                                                        if (this.classList.contains('selected')) {
                                                                                            // Nếu click lại chính nó thì bỏ chọn luôn
                                                                                            this.classList.remove('selected');
                                                                                            window.selectedVariantId = null;
                                                                                        } else {
                                                                                            document.querySelectorAll('.tf-mini-cart-item').forEach(function(i) {
                                                                                                i.classList.remove('selected');
                                                                                            });
                                                                                            this.classList.add('selected');
                                                                                            window.selectedVariantId = this.getAttribute('data-variant-id');
                                                                                        }
                                                                                    });
                                                                                });
                                                                            });
                                                                        </script>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="tf-mini-cart-bottom">
                                                                <div class="tf-mini-cart-bottom-wrap">
                                                                    <div class="tf-product-info-quantity">
                                                                        <div class="quantity-title fw-6 d-flex">Số lượng
                                                                        </div>
                                                                        <div class="wg-quantity">
                                                                            <span
                                                                                class="btn-quantity btn-decrease">-</span>
                                                                            <input type="text" class="quantity-product"
                                                                                id="quantity-product" name="number"
                                                                                value="1" min="1">
                                                                            <span
                                                                                class="btn-quantity btn-increase">+</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="tf-mini-cart-line"></div>
                                                                    <div class="tf-mini-cart-view-checkout">
                                                                        <a href="javascript:void(0);"
                                                                            class="tf-btn btn-fill animate-hover-btn radius-3 w-100 justify-content-center text-decoration-none btn-add-to-cart"><span>Thêm
                                                                                ngay</span></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /shoppingCart -->
                                    </div>
                                @endif

                                <div class="tf-product-info-buy-button">
                                    <form class="">
                                        <a href="javascript:void(0);" data-bs-toggle="modal"
                                            data-bs-target="#shoppingCart"
                                            class="tf-btn btn-fill justify-content-center fw-6 fs-16 flex-grow-1 animate-hover-btn">
                                            <span>Thêm vào giỏ hàng</span>
                                        </a>
                                        <div class="tf-product-btn-wishlist btn-icon-action">
                                            <button class="wishlist-btn" data-product-id="{{ $product->id }}"
                                                style="background:none;border:none;padding:0;cursor:pointer;">
                                                <i style="font-size: 18px; color:{{ in_array($product->id, $wishlistProductIds) ? 'red' : '#545353' }};"
                                                    class="fa-solid fa-heart" id="heart-Product"></i>
                                            </button>
                                            <i class="icon-delete"></i>
                                        </div>
                                        <style>
                                            .wishlist-btn i {
                                                font-size: 18px !important;
                                                color: #545353 !important;
                                                vertical-align: middle;
                                                margin: 0 !important;
                                                transition: color 0.2s;
                                                width: 22px;
                                                text-align: center;
                                                display: inline-block;
                                            }

                                            .wishlist-btn i.fa-solid {
                                                color: red !important;
                                            }
                                        </style>
                                        {{-- <div class="w-100">
                                            <a href="#" class="btns-full fw-6 fs-16">Mua với</a>
                                        </div> --}}
                                </div>
                                <div class="tf-product-info-extra-link">
                                    <a href="#delivery_return" data-bs-toggle="modal" class="tf-product-extra-icon">
                                        <div class="icon">
                                            <svg class="d-inline-block" xmlns="http://www.w3.org/2000/svg" width="22"
                                                height="18" viewBox="0 0 22 18" fill="currentColor">
                                                <path
                                                    d="M21.7872 10.4724C21.7872 9.73685 21.5432 9.00864 21.1002 8.4217L18.7221 5.27043C18.2421 4.63481 17.4804 4.25532 16.684 4.25532H14.9787V2.54885C14.9787 1.14111 13.8334 0 12.4255 0H9.95745V1.69779H12.4255C12.8948 1.69779 13.2766 2.07962 13.2766 2.54885V14.5957H8.15145C7.80021 13.6052 6.85421 12.8936 5.74468 12.8936C4.63515 12.8936 3.68915 13.6052 3.33792 14.5957H2.55319C2.08396 14.5957 1.70213 14.2139 1.70213 13.7447V2.54885C1.70213 2.07962 2.08396 1.69779 2.55319 1.69779H9.95745V0H2.55319C1.14528 0 0 1.14111 0 2.54885V13.7447C0 15.1526 1.14528 16.2979 2.55319 16.2979H3.33792C3.68915 17.2884 4.63515 18 5.74468 18C6.85421 18 7.80021 17.2884 8.15145 16.2979H13.423C13.7742 17.2884 14.7202 18 15.8297 18C16.9393 18 17.8853 17.2884 18.2365 16.2979H21.7872V10.4724ZM16.684 5.95745C16.9494 5.95745 17.2034 6.08396 17.3634 6.29574L19.5166 9.14894H14.9787V5.95745H16.684ZM5.74468 16.2979C5.27545 16.2979 4.89362 15.916 4.89362 15.4468C4.89362 14.9776 5.27545 14.5957 5.74468 14.5957C6.21392 14.5957 6.59575 14.9776 6.59575 15.4468C6.59575 15.916 6.21392 16.2979 5.74468 16.2979ZM15.8298 16.2979C15.3606 16.2979 14.9787 15.916 14.9787 15.4468C14.9787 14.9776 15.3606 14.5957 15.8298 14.5957C16.299 14.5957 16.6809 14.9776 16.6809 15.4468C16.6809 15.916 16.299 16.2979 15.8298 16.2979ZM18.2366 14.5957C17.8853 13.6052 16.9393 12.8936 15.8298 12.8936C15.5398 12.8935 15.252 12.943 14.9787 13.04V10.8511H20.0851V14.5957H18.2366Z">
                                                </path>
                                            </svg>
                                        </div>
                                        <div class="text fw-6">Giao hàng & Đổi trả</div>
                                    </a>
                                    <a href="#share_social" data-bs-toggle="modal" class="tf-product-extra-icon">
                                        <div class="icon">
                                            <i class="icon-share"></i>
                                        </div>
                                        <div class="text fw-6">Chia sẻ</div>
                                    </a>
                                </div>
                                <div class="tf-product-info-trust-seal">
                                    <div class="tf-product-trust-mess">
                                        <i class="icon-safe"></i>
                                        <p class="fw-6">Thanh toán an toàn <br> Đảm bảo</p>
                                    </div>
                                    <div class="tf-payment">
                                        <img src="{{ asset('client/ecomus/images/payments/visa.png') }}" alt="">
                                        <img src="{{ asset('client/ecomus/images/payments/img-1.png') }}" alt="">
                                        <img src="{{ asset('client/ecomus/images/payments/img-2.png') }}" alt="">
                                        <img src="{{ asset('client/ecomus/images/payments/img-3.png') }}" alt="">
                                        <img src="{{ asset('client/ecomus/images/payments/img-4.png') }}" alt="">
                                    </div>
                                </div>
                                {{-- Các phần khác giữ nguyên --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /Sản phẩm -->
    <script>
        // Hiển thị giá gốc sản phẩm, chỉ đổi sang giá biến thể khi chọn, bấm lại lần 2 sẽ bỏ chọn về giá gốc
        document.addEventListener('DOMContentLoaded', function() {
            const variantRadios = document.querySelectorAll('input[name="variant_id"]');
            const priceEl = document.getElementById('product-price');
            const totalPriceEl = document.getElementById('total-price');
            const materialLabel = document.getElementById('material-label');
            const quantityInput = document.getElementById('quantity-product');
            const defaultPrice = {{ $product->regular_price }};

            // Lưu trạng thái chọn lần trước
            let lastChecked = null;

            function updatePrice() {
                let checked = document.querySelector('input[name="variant_id"]:checked');
                let price = defaultPrice;
                if (checked && checked.dataset.price) {
                    price = Number(checked.dataset.price);
                }
                let qty = parseInt(quantityInput.value) || 1;
                priceEl.textContent = price.toLocaleString('vi-VN') + 'đ';
                totalPriceEl.textContent = (price * qty).toLocaleString('vi-VN') + 'đ';
                if (materialLabel) {
                    if (checked && checked.dataset.material) {
                        materialLabel.textContent = checked.dataset.material;
                    } else {
                        materialLabel.textContent = '';
                    }
                }
            }

            // Không chọn biến thể nào mặc định
            variantRadios.forEach(radio => {
                radio.checked = false;

                radio.addEventListener('click', function(e) {
                    // Nếu đã chọn rồi và bấm lại thì bỏ chọn
                    if (lastChecked === this) {
                        this.checked = false;
                        lastChecked = null;
                    } else {
                        lastChecked = this;
                    }
                    updatePrice();
                    updateProductTitle();
                });
            });

            quantityInput.addEventListener('input', updatePrice);

            // // Tăng giảm số lượng
            // document.querySelectorAll('.btn-quantity').forEach(btn => {
            //     btn.addEventListener('click', function() {
            //         let val = parseInt(quantityInput.value) || 1;
            //         if (this.classList.contains('btn-increase')) {
            //             quantityInput.value = val + 1;
            //         } else if (this.classList.contains('btn-decrease') && val > 1) {
            //             quantityInput.value = val - 1;
            //         }
            //         updatePrice();
            //     });
            // });

            // Cập nhật tiêu đề sản phẩm
            function updateProductTitle() {
                const checked = document.querySelector('input[name="variant_id"]:checked');
                const variantTitle = document.getElementById('variant-title');
                if (checked && checked.dataset.title) {
                    variantTitle.textContent = ' - ' + checked.dataset.title;
                } else {
                    variantTitle.textContent = '';
                }
            }

            function updateMainImage() {
                const checked = document.querySelector('input[name="variant_id"]:checked');
                if (checked && checked.dataset.image) {
                    // Tìm đúng slide có src trùng với ảnh biến thể
                    const mainSwiperImgs = document.querySelectorAll('#gallery-swiper-started .swiper-slide img');
                    let found = false;
                    mainSwiperImgs.forEach((img, idx) => {
                        // So sánh tuyệt đối đường dẫn ảnh
                        if (img.getAttribute('src') === checked.dataset.image) {
                            found = true;
                            if (window.gallerySwiper) {
                                // Lấy realIndex của slide thực (Swiper loop sẽ có slide ảo)
                                const slide = img.closest('.swiper-slide');
                                if (slide && typeof slide.dataset.swiperSlideIndex !== 'undefined') {
                                    window.gallerySwiper.slideToLoop(Number(slide.dataset
                                        .swiperSlideIndex));
                                } else {
                                    window.gallerySwiper.slideToLoop(idx);
                                }
                            }
                        }
                    });
                    // Nếu không tìm thấy, đổi trực tiếp src ảnh đầu tiên (fallback)
                    if (!found) {
                        const mainImg = document.querySelector('#gallery-swiper-started .swiper-slide img');
                        if (mainImg) {
                            mainImg.src = checked.dataset.image;
                            mainImg.setAttribute('data-zoom', checked.dataset.image);
                            mainImg.setAttribute('data-src', checked.dataset.image);
                        }
                    }
                }
            }

            // Gọi khi chọn biến thể
            variantRadios.forEach(radio => {
                radio.addEventListener('click', function(e) {
                    updatePrice();
                    updateProductTitle();
                    updateMainImage();
                });
            });

            // Gọi khi load trang
            updateProductTitle();
        });
    </script>

    <!-- tabs -->
    <section class="flat-spacing-17 pt_0">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="widget-tabs style-has-border">
                        <ul class="widget-menu-tab">
                            <li class="item-title active">
                                <span class="inner">Mô tả</span>
                            </li>
                            <li class="item-title">
                                <span class="inner">Đánh giá</span>
                            </li>
                            <li class="item-title">
                                <span class="inner">Vận chuyển</span>
                            </li>
                            <li class="item-title">
                                <span class="inner">Chính sách đổi trả</span>
                            </li>
                        </ul>
                        <div class="widget-content-tab">
                            {{-- mô tả --}}
                            <div class="widget-content-inner active">
                                <div class="">
                                    <p class="mb_30">
                                        {!! nl2br(e($product->description)) !!}
                                    </p>
                                    <div class="tf-product-des-demo">
                                        <div class="right">
                                            <h3 class="fs-16 fw-5">Tính năng nổi bật</h3>
                                            <ul>
                                                <li>Thiết kế hiện đại, phù hợp với nhiều không gian nội thất</li>
                                                <li>Chất liệu gỗ tự nhiên/kim loại cao cấp, bền bỉ</li>
                                                <li>Khả năng chịu lực tốt, tuổi thọ cao</li>
                                                <li>Dễ dàng lắp ráp và di chuyển</li>
                                            </ul>

                                            <h3 class="fs-16 fw-5">Chất liệu & Thông tin kỹ thuật</h3>
                                            <ul class="mb-0">
                                                <li>Chất liệu: Gỗ sồi tự nhiên/Gỗ MDF phủ Melamine</li>
                                                <li>Kích thước: D120 x R60 x C75 cm</li>
                                                <li>Màu sắc: Nâu tự nhiên/Trắng</li>
                                                <li>Sản xuất tại: Việt Nam</li>
                                            </ul>
                                        </div>

                                        <div class="left">
                                            <h3 class="fs-16 fw-5">Hướng dẫn bảo quản</h3>
                                            <div class="d-flex gap-10 mb_15 align-items-center">
                                                <div class="icon">
                                                    <i class="icon-machine"></i>
                                                </div>
                                                <span>Dùng khăn mềm ẩm lau bề mặt định kỳ</span>
                                            </div>
                                            <div class="d-flex gap-10 mb_15 align-items-center">
                                                <div class="icon">
                                                    <i class="icon-bleach"></i>
                                                </div>
                                                <span>Không dùng hóa chất tẩy mạnh</span>
                                            </div>
                                            <div class="d-flex gap-10 mb_15 align-items-center">
                                                <div class="icon">
                                                    <i class="icon-dry-clean"></i>
                                                </div>
                                                <span>Không ngâm nước hoặc để tiếp xúc lâu với chất lỏng</span>
                                            </div>
                                            <div class="d-flex gap-10 align-items-center">
                                                <div class="icon">
                                                    <i class="icon-tumble-dry"></i>
                                                </div>
                                                <span>Bảo quản nơi khô ráo, thông thoáng</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- /mô tả --}}

                            {{-- đánh giá --}}
                            @php
                                // Đếm số lượt đánh giá đã duyệt
                                $approvedReviews = $reviews->where('status', 'approved');
                                $reviewCount = $approvedReviews->count();

                                // Tính trung bình rate
                                $averageRate = $reviewCount > 0 ? round($approvedReviews->avg('rating'), 1) : 0;

                                // Đếm số lượng từng rate
                                $rateCounts = [];
                                for ($i = 1; $i <= 5; $i++) {
                                    $rateCounts[$i] = $approvedReviews->where('rating', $i)->count();
                                }
                            @endphp
                            <div class="widget-content-inner">
                                <div class="tab-reviews write-cancel-review-wrap">
                                    <div class="tab-reviews-heading">
                                        <div class="top">
                                            <div class="text-center">
                                                <h1 class="number fw-6">{{ $averageRate }}</h1>
                                                <div class="list-star">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <i
                                                            class="icon icon-star{{ $i <= round($averageRate) ? '' : '-o' }}"></i>
                                                    @endfor
                                                </div>
                                                <p>({{ $reviewCount }} Đánh giá)</p>
                                            </div>
                                            <div class="rating-score">
                                                @for ($i = 5; $i >= 1; $i--)
                                                    <div class="item">
                                                        <div class="number-1 text-caption-1">{{ $i }}</div>
                                                        <i class="icon icon-star"></i>
                                                        <div class="line-bg">
                                                            @php
                                                                $percent =
                                                                    $reviewCount > 0
                                                                        ? ($rateCounts[$i] / $reviewCount) * 100
                                                                        : 0;
                                                            @endphp
                                                            <div style="width: {{ $percent }}%;"></div>
                                                        </div>
                                                        <div class="number-2 text-caption-1">{{ $rateCounts[$i] }}</div>
                                                    </div>
                                                @endfor
                                            </div>
                                        </div>
                                        <div>
                                            <div class="tf-btn btn-outline-dark fw-6 btn-comment-review btn-cancel-review">
                                                Hủy đánh giá</div>
                                            <div class="tf-btn btn-outline-dark fw-6 btn-comment-review btn-write-review">
                                                Viết đánh giá</div>
                                        </div>
                                    </div>
                                    <div class="reply-comment cancel-review-wrap">
                                        <div
                                            class="d-flex mb_24 gap-20 align-items-center justify-content-between flex-wrap">
                                            <h5 class="">{{ $reviewCount }} Bình luận</h5>
                                            <form method="GET" id="review-sort-form">
                                                <select name="sort" id="sort-select"
                                                    class="form-select d-inline w-auto"
                                                    onchange="document.getElementById('review-sort-form').submit()">
                                                    <option value="newest"
                                                        {{ request('sort') === 'newest' ? 'selected' : '' }}>Mới nhất
                                                    </option>
                                                    <option value="oldest"
                                                        {{ request('sort') === 'oldest' ? 'selected' : '' }}>Cũ nhất
                                                    </option>
                                                </select>
                                            </form>

                                        </div>
                                        <div class="reply-comment-wrap">
                                            @foreach ($reviews as $review)
                                                @if ($review->status === 'approved')
                                                    {{-- Hiển thị bình thường nếu đã duyệt --}}
                                                    <div class="reply-comment-item">
                                                        <div class="user">
                                                            <div class="image">
                                                                <img src="{{ asset('client/ecomus/images/collections/collection-circle-9.jpg') }}"
                                                                    alt="">
                                                            </div>
                                                            <div>
                                                                <h6>
                                                                    <a href="#" class="link">
                                                                        @php
                                                                            $name =
                                                                                $review->user->full_name ?? 'Ẩn danh';
                                                                            if (
                                                                                $name !== 'Ẩn danh' &&
                                                                                mb_strlen($name) > 6
                                                                            ) {
                                                                                $first = mb_substr($name, 0, 3);
                                                                                $last = mb_substr($name, -3);
                                                                                $masked =
                                                                                    $first .
                                                                                    str_repeat(
                                                                                        '*',
                                                                                        mb_strlen($name) - 6,
                                                                                    ) .
                                                                                    $last;
                                                                                echo $masked;
                                                                            } else {
                                                                                echo $name;
                                                                            }
                                                                        @endphp
                                                                    </a>
                                                                </h6>
                                                                <div class="day text_black-3">
                                                                    {{ $review->created_at->diffForHumans() }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="list-star mb-1">
                                                            @for ($i = 1; $i <= 5; $i++)
                                                                <i
                                                                    class="icon icon-star{{ $i <= $review->rating ? '' : '-o' }}"></i>
                                                            @endfor
                                                        </div>
                                                        <p class="text_black-3">{{ $review->comment }}</p>
                                                    </div>
                                                    @if ($review->admin_reply)
                                                        <div class="reply-comment-item type-reply">
                                                            <div class="user">
                                                                <div class="image">
                                                                    <img src="{{ asset('client/ecomus/images/collections/collection-circle-10.jpg') }}"
                                                                        alt="">
                                                                </div>
                                                                <div>
                                                                    <h6>
                                                                        <a href="#" class="link">
                                                                            @php
                                                                                // Nếu có admin, lấy tên admin, còn không thì hiển thị mặc định
                                                                                $adminName =
                                                                                    $review->admin->full_name ??
                                                                                    'Admin';
                                                                                if (mb_strlen($adminName) > 6) {
                                                                                    $first = mb_substr(
                                                                                        $adminName,
                                                                                        0,
                                                                                        3,
                                                                                    );
                                                                                    $last = mb_substr($adminName, -3);
                                                                                    $masked =
                                                                                        $first .
                                                                                        str_repeat(
                                                                                            '*',
                                                                                            mb_strlen($adminName) - 6,
                                                                                        ) .
                                                                                        $last;
                                                                                    echo $masked;
                                                                                } else {
                                                                                    echo $adminName;
                                                                                }
                                                                            @endphp
                                                                        </a>
                                                                    </h6>
                                                                    <div class="day text_black-3">
                                                                        {{ $review->admin_reply_created_at ? \Carbon\Carbon::parse($review->admin_reply_created_at)->diffForHumans() : '' }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <p class="text_black-3">{{ $review->admin_reply }}</p>
                                                        </div>
                                                    @endif
                                                @elseif ($review->status === 'pending' && auth()->check() && auth()->id() === $review->user_id)
                                                    {{-- Làm mờ và chỉ user đánh giá thấy --}}
                                                    <div class="reply-comment-item" style="opacity: 0.5;">
                                                        <div class="user">
                                                            <div class="image">
                                                                <img src="{{ asset('client/ecomus/images/collections/collection-circle-9.jpg') }}"
                                                                    alt="">
                                                            </div>
                                                            <div>
                                                                <h6>
                                                                    <a href="#" class="link">
                                                                        @php
                                                                            $name =
                                                                                $review->user->full_name ?? 'Ẩn danh';
                                                                            if (
                                                                                $name !== 'Ẩn danh' &&
                                                                                mb_strlen($name) > 6
                                                                            ) {
                                                                                $first = mb_substr($name, 0, 3);
                                                                                $last = mb_substr($name, -3);
                                                                                $masked =
                                                                                    $first .
                                                                                    str_repeat(
                                                                                        '*',
                                                                                        mb_strlen($name) - 6,
                                                                                    ) .
                                                                                    $last;
                                                                                echo $masked;
                                                                            } else {
                                                                                echo $name;
                                                                            }
                                                                        @endphp
                                                                    </a>
                                                                </h6>
                                                                <div class="day text_black-3">
                                                                    {{ $review->created_at->diffForHumans() }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="list-star mb-1">
                                                            @for ($i = 1; $i <= 5; $i++)
                                                                <i
                                                                    class="icon icon-star{{ $i <= $review->rating ? '' : '-o' }}"></i>
                                                            @endfor
                                                        </div>
                                                        <p class="text_black-3"><em>Đánh giá của bạn đang chờ
                                                                duyệt</em><br>{{ $review->comment }}</p>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    {{-- ...form viết đánh giá giữ nguyên... --}}
                                    <form class="form-write-review write-review-wrap" method="POST"
                                        action="{{ route('client.reviews.store', $product->id) }}">
                                        @csrf
                                        <div class="heading">
                                            <h5>Viết đánh giá:</h5>
                                            <div class="list-rating-check">
                                                <input type="radio" id="star5" name="rating" value="5" />
                                                <label for="star5" title="text"></label>
                                                <input type="radio" id="star4" name="rating" value="4" />
                                                <label for="star4" title="text"></label>
                                                <input type="radio" id="star3" name="rating" value="3" />
                                                <label for="star3" title="text"></label>
                                                <input type="radio" id="star2" name="rating" value="2" />
                                                <label for="star2" title="text"></label>
                                                <input type="radio" id="star1" name="rating" value="1"
                                                    checked />
                                                <label for="star1" title="text"></label>
                                            </div>
                                        </div>
                                        <div class="form-content">
                                            <fieldset class="box-field">
                                                <label class="label">Nội dung đánh giá</label>
                                                <textarea rows="4" name="comment" placeholder="Viết bình luận của bạn tại đây" tabindex="2" required></textarea>
                                            </fieldset>
                                            {{-- <div class="box-check">
                                                <input type="checkbox" name="availability" class="tf-check"
                                                    id="check1" {{ old('availability') ? 'checked' : '' }}>
                                                <label class="text_black-3" for="check1">
                                                    Tôi Đồng Ý Tuân Thủ Quy Tắc Cộng Đồng Và Tôn Trọng Mọi Người.
                                                </label>
                                            </div> --}}
                                        </div>
                                        <div class="button-submit">
                                            <button type="submit" class="tf-btn btn-fill animate-hover-btn">
                                                Gửi đánh giá
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            {{-- /đánh giá --}}

                            {{-- vận chuyển --}}
                            <div class="widget-content-inner">
                                <div class="tf-page-privacy-policy">
                                    <div class="title">Chính sách Vận chuyển</div>

                                    <p>Funori Furniture cam kết giao hàng đến tay khách hàng một cách nhanh chóng, an toàn
                                        và đúng hẹn. Chính sách vận chuyển áp dụng cho tất cả đơn hàng được đặt trên website
                                        <strong>funori.vn</strong> và các kênh bán hàng chính thức của chúng tôi.
                                    </p>

                                    <h3 class="fs-16 fw-5 mt-4">1. Khu vực giao hàng</h3>
                                    <ul>
                                        <li>Giao hàng toàn quốc với các đơn vị vận chuyển uy tín như Giao hàng tiết kiệm,
                                            Viettel Post, Ahamove,...</li>
                                        <li>Giao nội thành Hà Nội và TP.HCM bằng đội ngũ riêng của Funori (đối với sản phẩm
                                            cồng kềnh, cần lắp đặt)</li>
                                    </ul>

                                    <h3 class="fs-16 fw-5 mt-4">2. Thời gian giao hàng</h3>
                                    <ul>
                                        <li>Nội thành: 1–3 ngày làm việc</li>
                                        <li>Ngoại thành & tỉnh thành khác: 3–7 ngày làm việc (tùy vị trí)</li>
                                        <li>Đơn hàng cần gia công/lắp đặt: từ 5–10 ngày tùy vào sản phẩm</li>
                                    </ul>

                                    <h3 class="fs-16 fw-5 mt-4">3. Phí vận chuyển</h3>
                                    <ul>
                                        <li>Miễn phí giao hàng tại Hà Nội & TP.HCM với đơn hàng từ 5.000.000đ</li>
                                        <li>Phí vận chuyển các khu vực khác sẽ được tính tự động tại bước thanh toán</li>
                                        <li>Đơn hàng cồng kềnh/lắp đặt: có thể có phụ phí, sẽ được nhân viên thông báo trước
                                            khi xác nhận đơn hàng</li>
                                    </ul>

                                    <h3 class="fs-16 fw-5 mt-4">4. Chính sách kiểm tra & nhận hàng</h3>
                                    <ul>
                                        <li>Quý khách được kiểm tra ngoại quan sản phẩm trước khi nhận hàng</li>
                                        <li>Trong trường hợp sản phẩm bị hư hại do vận chuyển, vui lòng từ chối nhận và liên
                                            hệ ngay hotline bên dưới</li>
                                    </ul>

                                    <h3 class="fs-16 fw-5 mt-4">5. Hỗ trợ</h3>
                                    <p>Nếu có thắc mắc hoặc cần hỗ trợ thêm, vui lòng liên hệ bộ phận Chăm sóc khách hàng:
                                    </p>
                                    <p>
                                        📞 Hotline: <strong>1900 1234</strong> (8h00 – 20h00)<br>
                                        📧 Email: <a href="mailto:support@funori.vn">support@funori.vn</a>
                                    </p>
                                </div>
                            </div>
                            {{-- /vận chuyển --}}

                            {{-- chính sách / ưu điểm --}}
                            <div class="widget-content-inner">
                                <ul class="d-flex justify-content-center flex-wrap gap-4 mb_18 text-center">
                                    <li style="width: 100px;">
                                        <i class="fas fa-truck fa-2x text-primary"></i>
                                        <p class="mt-2 small">Giao hàng tận nơi</p>
                                    </li>
                                    <li style="width: 100px;">
                                        <i class="fas fa-tools fa-2x text-primary"></i>
                                        <p class="mt-2 small">Lắp đặt tại nhà</p>
                                    </li>
                                    <li style="width: 100px;">
                                        <i class="fas fa-shield-alt fa-2x text-primary"></i>
                                        <p class="mt-2 small">Bảo hành 12 tháng</p>
                                    </li>
                                    <li style="width: 100px;">
                                        <i class="fas fa-credit-card fa-2x text-primary"></i>
                                        <p class="mt-2 small">Thanh toán khi nhận</p>
                                    </li>
                                    <li style="width: 100px;">
                                        <i class="fas fa-rotate-left fa-2x text-primary"></i>
                                        <p class="mt-2 small">Đổi trả 7 ngày</p>
                                    </li>
                                    <li style="width: 100px;">
                                        <i class="fas fa-couch fa-2x text-primary"></i>
                                        <p class="mt-2 small">Chất liệu cao cấp</p>
                                    </li>
                                </ul>
                            </div>
                            {{-- /chính sách --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /tabs -->

    <!-- modal delivery_return -->
    <div class="modal modalCentered fade modalDemo tf-product-modal modal-part-content" id="delivery_return">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="header">
                    <div class="demo-title">Giao hàng & Đổi trả</div>
                    <span class="icon-close icon-close-popup" data-bs-dismiss="modal"></span>
                </div>
                <div class="overflow-y-auto">
                    <!-- Chính sách giao hàng -->
                    <div class="tf-product-popup-delivery">
                        <div class="title">Giao hàng</div>
                        <p class="text-paragraph">Tất cả đơn hàng được giao qua đối tác vận chuyển uy tín như GHTK,
                            Ahamove, Viettel Post.</p>
                        <p class="text-paragraph">Miễn phí giao hàng với đơn từ 5.000.000đ tại Hà Nội và TP.HCM.</p>
                        <p class="text-paragraph">Thời gian giao hàng từ 2–7 ngày làm việc tùy khu vực.</p>
                        <p class="text-paragraph">Bạn sẽ nhận được mã theo dõi đơn hàng sau khi xác nhận.</p>
                    </div>

                    <!-- Chính sách đổi trả -->
                    <div class="tf-product-popup-delivery">
                        <div class="title">Đổi trả</div>
                        <p class="text-paragraph">Sản phẩm được đổi trả trong vòng 7 ngày nếu có lỗi từ nhà sản xuất hoặc
                            vận chuyển.</p>
                        <p class="text-paragraph">Sản phẩm phải còn nguyên bao bì, chưa qua sử dụng hoặc lắp đặt.</p>
                        <p class="text-paragraph">Chi phí vận chuyển đổi/trả do khách hàng chi trả (trừ lỗi từ phía công
                            ty).</p>
                        <p class="text-paragraph">Không áp dụng đổi trả với sản phẩm giảm giá, đặt hàng riêng theo yêu cầu.
                        </p>
                    </div>

                    <!-- Liên hệ hỗ trợ -->
                    <div class="tf-product-popup-delivery">
                        <div class="title">Hỗ trợ</div>
                        <p class="text-paragraph">Nếu bạn có bất kỳ câu hỏi nào, vui lòng liên hệ với chúng tôi:</p>
                        <p class="text-paragraph">Email: <a href="mailto:support@funori.vn">support@funori.vn</a></p>
                        <p class="text-paragraph mb-0">Hotline: 1900 1234 (8h00 – 20h00)</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /modal delivery_return -->

    <!-- modal share social -->
    <div class="modal modalCentered fade modalDemo tf-product-modal modal-part-content" id="share_social">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="header">
                    <div class="demo-title">Chia sẻ</div>
                    <span class="icon-close icon-close-popup" data-bs-dismiss="modal"></span>
                </div>
                <div class="overflow-y-auto">
                    <ul class="tf-social-icon d-flex gap-10">
                        <li>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(Request::fullUrl()) }}"
                                target="_blank" class="box-icon social-facebook bg_line justify-content-center">
                                <i class="icon icon-fb"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="box-icon social-instagram bg_line justify-content-center disabled">
                                <i class="icon icon-instagram"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="box-icon social-tiktok bg_line justify-content-center disabled">
                                <i class="icon icon-tiktok"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://pinterest.com/pin/create/button/?url={{ urlencode(Request::fullUrl()) }}"
                                target="_blank" class="box-icon social-pinterest bg_line justify-content-center">
                                <i class="icon icon-pinterest-1"></i>
                            </a>
                        </li>
                    </ul>

                    <form class="form-share" method="post">
                        <fieldset>
                            <input id="share-url" type="text" value="{{ Request::fullUrl() }}" readonly>
                        </fieldset>
                        <div class="button-submit">
                            <button id="copy-btn" type="button"
                                class="tf-btn btn-sm radius-3 btn-fill btn-icon animate-hover-btn"
                                onclick="copyShareLink()">
                                Sao chép liên kết
                            </button>
                        </div>
                        <script>
                            function copyShareLink() {
                                const input = document.getElementById('share-url');
                                const button = document.getElementById('copy-btn');
                                const originalText = button.innerHTML;

                                navigator.clipboard.writeText(input.value)
                                    .then(() => {
                                        button.innerHTML = 'Đã sao chép!';

                                        // Sau 2.5 giây, khôi phục lại nút gốc
                                        setTimeout(() => {
                                            button.innerHTML = originalText;
                                        }, 2500);
                                    })
                                    .catch(() => {
                                        button.innerHTML = 'Lỗi sao chép!';
                                        setTimeout(() => {
                                            button.innerHTML = originalText;
                                        }, 2500);
                                    });
                            }
                        </script>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /modal share social -->

    <!-- Toastr hiển thị thông báo session -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('shoppingCart');
            if (!modal) return;

            // Gán sự kiện cho nút "Thêm ngay" trong modal, không phụ thuộc vào sự kiện mở modal
            const addToCartBtn = modal.querySelector('.btn-add-to-cart');
            if (addToCartBtn) {
                addToCartBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    // Lấy input số lượng trong modal
                    const quantityInput = modal.querySelector('#quantity-product');
                    let quantity = parseInt(quantityInput ? quantityInput.value : 1) || 1;
                    // Lấy biến thể đã chọn trong modal
                    const selectedVariant = modal.querySelector('.tf-mini-cart-item.selected');
                    let productVariantId = selectedVariant ? selectedVariant.getAttribute(
                        'data-variant-id') : null;
                    let hasVariants = {{ $product->variants->count() > 0 ? 'true' : 'false' }};
                    if (hasVariants && !productVariantId) {
                        toastr.error('Vui lòng chọn biến thể trước khi thêm vào giỏ hàng!');
                        return;
                    }
                    fetch('{{ route('client.cart.add') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                product_id: {{ $product->id }},
                                quantity: quantity,
                                product_variant_id: productVariantId
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                toastr.success('Đã thêm vào giỏ hàng!');
                            } else {
                                toastr.error(data.message || 'Có lỗi xảy ra!');
                            }
                        })
                        .catch(error => {
                            toastr.error('Có lỗi xảy ra!');
                            console.error(error);
                        });
                });
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            const tabTitles = document.querySelectorAll('.widget-menu-tab .item-title');
            const tabContents = document.querySelectorAll('.widget-content-tab .widget-content-inner');
            tabTitles.forEach((tab, idx) => {
                tab.addEventListener('click', function() {
                    tabTitles.forEach(t => t.classList.remove('active'));
                    tabContents.forEach(c => c.classList.remove('active'));
                    tab.classList.add('active');
                    tabContents[idx].classList.add('active');
                });
            });
        });

        document.addEventListener("DOMContentLoaded", function() {
            const writeBtn = document.querySelector('.btn-write-review');
            const cancelBtn = document.querySelector('.btn-cancel-review');
            const formReview = document.querySelector('.form-write-review');
            const commentWrap = document.querySelector('.reply-comment'); // Phần chứa tất cả bình luận

            if (writeBtn && cancelBtn && formReview && commentWrap) {
                // Mặc định ẩn form, hiện bình luận
                formReview.style.display = "none";
                cancelBtn.style.display = "none";
                commentWrap.style.display = "block";

                // Khi bấm nút "Viết đánh giá"
                writeBtn.addEventListener('click', function() {
                    formReview.style.display = "block";
                    commentWrap.style.display = "none";
                    writeBtn.style.display = "none";
                    cancelBtn.style.display = "inline-block";
                    // formReview.scrollIntoView({ behavior: "smooth" });
                });

                // Khi bấm nút "Hủy đánh giá"
                cancelBtn.addEventListener('click', function() {
                    formReview.style.display = "none";
                    commentWrap.style.display = "block";
                    writeBtn.style.display = "inline-block";
                    cancelBtn.style.display = "none";
                });
            }
        });

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
                                    if (miniWishlist) miniclient.wishlist.innerHTML = html;
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
    </script>
@endsection
