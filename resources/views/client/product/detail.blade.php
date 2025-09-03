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
        $canReview = false;

        if (Auth::check() && Auth::user()->wishlist) {
            $wishlistProductIds = Auth::user()->wishlist->items->pluck('product_id')->toArray();
        }

        // Kiểm tra xem khách hàng đã mua sản phẩm này và đơn hàng đã giao thành công chưa
        if (Auth::check()) {
            $user = Auth::user();
            $deliveredOrderItems = $user
                ->orders()
                ->where('order_status', 'delivered')
                ->whereHas('items', function ($query) use ($product) {
                    $query->where('product_id', $product->id);
                })
                ->with('items')
                ->get()
                ->flatMap(function ($order) use ($product) {
                    return $order->items->where('product_id', $product->id);
                });

            $reviewedCount = \App\Models\Review::where('user_id', $user->id)
                ->where('product_id', $product->id)
                ->count();

            $canReview = $deliveredOrderItems->count() > $reviewedCount;
            $remainingReviews = $deliveredOrderItems->count() - $reviewedCount;
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

    <!-- Hiển thị thông báo session -->
    @if(session('success'))
        <div class="container mt-3">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="container mt-3">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif

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
                            <div class="mt-3 product-description-wrap" style="position: relative;">
                                <div class="product-description-shadow product-description-content"
                                    id="product-description-content">
                                    {!! nl2br(e($product->description)) !!}
                                </div>
                                <button type="button" class="btn-show-more" id="btn-show-more" style="display:none;">
                                    <span>Xem thêm</span>
                                    <i class="fa fa-chevron-down"></i>
                                </button>
                            </div>

                            <style>
                                .product-description-shadow {
                                    border: 1px solid #eee;
                                    border-radius: 12px;
                                    box-shadow: 0 2px 12px rgba(0, 0, 0, 0.07);
                                    padding: 18px 20px;
                                    background: #fff;
                                }

                                .product-description-content {
                                    max-height: 120px;
                                    overflow: hidden;
                                    transition: max-height 0.25s cubic-bezier(0.4, 0, 0.2, 1);
                                    position: relative;
                                }

                                .product-description-wrap.expanded .product-description-content {
                                    max-height: 800px;
                                }

                                .btn-show-more {
                                    background: none;
                                    border: none;
                                    color: #fcad02;
                                    font-weight: 600;
                                    cursor: pointer;
                                    display: flex;
                                    align-items: center;
                                    margin: 0 auto;
                                    padding: 8px 0 0 0;
                                }
                            </style>

                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const descWrap = document.querySelector('.product-description-wrap');
                                    const descContent = document.getElementById('product-description-content');
                                    const btnShowMore = document.getElementById('btn-show-more');
                                    const maxHeight = 120; // px

                                    if (descContent.scrollHeight > maxHeight) {
                                        btnShowMore.style.display = 'flex';
                                        btnShowMore.addEventListener('click', function() {
                                            if (!descWrap.classList.contains('expanded')) {
                                                // Mở rộng: set max-height đúng chiều cao thật
                                                descContent.style.maxHeight = descContent.scrollHeight + 'px';
                                                descWrap.classList.add('expanded');
                                                btnShowMore.innerHTML =
                                                    '<span>Thu gọn</span> <i class="fa fa-chevron-up mx-1"></i>';
                                            } else {
                                                // Thu gọn: set lại max-height nhỏ
                                                descContent.style.maxHeight = maxHeight + 'px';
                                                descWrap.classList.remove('expanded');
                                                btnShowMore.innerHTML =
                                                    '<span>Xem thêm</span> <i class="fa fa-chevron-down mx-1"></i>';
                                            }
                                        });
                                        // Đảm bảo trạng thái thu gọn ban đầu
                                        descContent.style.maxHeight = maxHeight + 'px';
                                    }
                                });
                            </script>
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
                                    <div class="badges text-uppercase">
                                        {{ $reviewCount }} Lượt đánh giá |
                                        <span class="ms-2">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <i
                                                    class="fa{{ $i <= ($reviewCount > 0 ? round($averageRate) : 5) ? 's' : 'r' }} fa-star"></i>
                                            @endfor
                                        </span>
                                    </div>
                                    <div class="product-status-content">
                                        <i class="icon-lightning"></i>
                                        <p class="fw-6">Mua nhanh! Số Lượng chỉ dành cho những người nhanh nhất.
                                        </p>
                                    </div>
                                </div>
                                <div class="tf-product-info-badges">
                                    @if ($product->is_featured)
                                        <div class="badges">Nổi bật</div>
                                    @endif
                                </div>

                                {{-- Hiển thị mô tả ngắn --}}
                                <p class="mb_30">
                                    {!! nl2br(e($product->short_description)) !!}
                                </p>
                                {{-- /Hiển thị mô tả ngắn --}}

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
                                        <select id="variant-select" class="form-select">
                                            <option value="">-- Chọn biến thể --</option>
                                            @foreach ($product->variants as $variant)
                                                @php
                                                    $material = '';
                                                    if ($variant->attributeValues) {
                                                        foreach ($variant->attributeValues as $attrVal) {
                                                            if (
                                                                isset($attrVal->attribute) &&
                                                                (strtolower($attrVal->attribute->name) ===
                                                                    'chất liệu' ||
                                                                    strtolower($attrVal->attribute->slug) ===
                                                                        'chat-lieu')
                                                            ) {
                                                                $material = $attrVal->value ?? '';
                                                                break;
                                                            }
                                                        }
                                                    }
                                                @endphp

                                                <option value="{{ $variant->id }}"
                                                    data-image="{{ $variant->image ? asset($variant->image->image_url) : asset('images/products/default.jpg') }}"
                                                    data-title="{{ $variant->name_variant ?? $product->name }}"
                                                    data-price="{{ $product->regular_price + $variant->price_modifier }}"
                                                    data-material="{{ $variant->material ?? '' }}"
                                                    data-size="{{ $variant->size ?? '' }}"
                                                    data-stock="{{ $variant->stock_quantity ?? 0 }}"
                                                    {{ ($variant->stock_quantity ?? 0) <= 0 ? 'disabled' : '' }}>
                                                    {{ $variant->name_variant ?? $product->name }}
                                                    @if ($variant->size)
                                                        - Kích thước: {{ $variant->size }}
                                                    @endif
                                                    @if ($material)
                                                        | Chất liệu: {{ $material }}
                                                    @endif
                                                    @if (($variant->stock_quantity ?? 0) <= 0)
                                                        (Hết hàng)
                                                    @else
                                                        (Kho: {{ $variant->stock_quantity }})
                                                    @endif
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif
                                <div class="tf-product-info-quantity">
                                    <div class="quantity-title fw-6 d-flex">Số lượng
                                    </div>
                                    <div class="wg-quantity">
                                        <span class="btn-quantity btn-decrease">-</span>
                                        <input type="text" class="quantity-product" id="quantity-product"
                                            name="number" value="1" min="1">
                                        <span class="btn-quantity btn-increase">+</span>
                                    </div>
                                </div>
                                <div class="tf-product-info-buy-button">
                                    <form class="">
                                        @if ($product->status == 'draft')
                                            <a href="javascript:void(0);"
                                                class="tf-btn btn-fill justify-content-center fw-6 fs-16 flex-grow-1 animate-hover-btn"
                                                style="pointer-events: none; opacity: 0.5;">
                                                <span>Sản phẩm đã ngừng kinh doanh</span>
                                            </a>
                                        @else
                                            <a href="javascript:void(0);"
                                                class="tf-btn btn-fill justify-content-center fw-6 fs-16 flex-grow-1 animate-hover-btn btn-add-to-cart">
                                                <span>Thêm vào giỏ hàng</span>
                                            </a>
                                        @endif
                                        <div class="tf-product-btn-wishlist btn-icon-action">
                                            <button class="wishlist-btn" data-product-id="{{ $product->id }}"
                                                style="background:none;border:none;padding:0;cursor:pointer;">
                                                <i 
                                                    class="fa-heart {{ in_array($product->id, $wishlistProductIds) ? 'fa-solid active' : 'fa-regular' }}" 
                                                    id="heart-Product"
                                                    style="font-size: 18px; color: {{ in_array($product->id, $wishlistProductIds) ? 'red' : '#545353' }};"
                                                ></i>
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
                                            <a href="#" class="btns-full fw-6 fs-16">Mua Ngay</a>
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
        document.addEventListener('DOMContentLoaded', function() {
            const variantSelect = document.getElementById('variant-select');
            const priceEl = document.getElementById('product-price');
            const totalPriceEl = document.getElementById('total-price');
            const materialLabel = document.getElementById('material-label');
            const quantityInput = document.getElementById('quantity-product');
            const variantTitle = document.getElementById('variant-title');
            const defaultPrice = {{ $product->regular_price }};

            function updateAll() {
                let selected = variantSelect && variantSelect.selectedOptions[0];
                let price = defaultPrice;
                if (selected && selected.dataset.price) {
                    price = Number(selected.dataset.price);
                }
                let qty = parseInt(quantityInput.value) || 1;
                priceEl.textContent = price.toLocaleString('vi-VN') + 'đ';
                if (totalPriceEl) totalPriceEl.textContent = (price * qty).toLocaleString('vi-VN') + 'đ';
                if (materialLabel) {
                    materialLabel.textContent = selected && selected.dataset.material ? selected.dataset.material :
                        '';
                }
                if (variantTitle) {
                    variantTitle.textContent = selected && selected.dataset.title ? ' - ' + selected.dataset.title :
                        '';
                }
                // Đổi ảnh sản phẩm chính và chuyển Swiper về đúng slide
                if (selected && selected.dataset.image) {
                    const mainSwiperImgs = document.querySelectorAll('#gallery-swiper-started .swiper-slide img');
                    let found = false;
                    mainSwiperImgs.forEach((img, idx) => {
                        // So sánh tuyệt đối đường dẫn ảnh
                        if (img.getAttribute('src') === selected.dataset.image) {
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
                            mainImg.src = selected.dataset.image;
                            mainImg.setAttribute('data-zoom', selected.dataset.image);
                            mainImg.setAttribute('data-src', selected.dataset.image);
                        }
                    }
                }
            }

            if (variantSelect) {
                variantSelect.addEventListener('change', updateAll);
            }
            if (quantityInput) {
                quantityInput.addEventListener('input', updateAll);
            }
            document.querySelectorAll('.btn-quantity').forEach(btn => {
                btn.addEventListener('click', function() {
                    let val = parseInt(quantityInput.value) || 1;
                    if (this.classList.contains('btn-increase')) {
                        quantityInput.value = val + 1;
                    } else if (this.classList.contains('btn-decrease') && val > 1) {
                        quantityInput.value = val - 1;
                    }
                    updateAll();
                });
            });

            updateAll();
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
                                <span class="inner">Thông Tin</span>
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
                            {{-- thông tin --}}
                            <div class="widget-content-inner active">
                                <div class="">
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
                            {{-- /thông tin --}}

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
                                <div class="tab-reviews write-cancel-review-wrap" id="product-reviews">
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
                                            @if ($canReview)
                                                <div
                                                    class="tf-btn btn-outline-dark fw-6 btn-comment-review btn-write-review">
                                                    @if(isset($remainingReviews) && $remainingReviews > 0)
                                                        Viết đánh giá ({{ $remainingReviews }} lần còn lại)
                                                    @else
                                                        Viết đánh giá
                                                    @endif
                                                </div>
                                            @else
                                                <div class="tf-btn btn-outline-secondary fw-6"
                                                    style="cursor: not-allowed; opacity: 0.6; padding: 8px 20px;">
                                                    @if(isset($remainingReviews) && $remainingReviews == 0)
                                                        Đã đánh giá đủ
                                                    @else
                                                        Chưa mua sản phẩm
                                                    @endif
                                                </div>
                                            @endif
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
                                                                <img src="{{ $review->user && $review->user->avatar_url ? asset('storage/' . $review->user->avatar_url) : asset('client/ecomus/images/collections/collection-circle-9.jpg') }}"
                                                                     alt="{{ $review->user->full_name ?? 'User' }}"
                                                                     data-avatar-url="{{ $review->user->avatar_url ?? '' }}"
                                                                     onerror="this.src='{{ asset('client/ecomus/images/collections/collection-circle-9.jpg') }}'"
                                                                     style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;">
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
                                                                <div class="day text_black-3" style="font-size: 11px; color: #666;">
                                                                    {{ $review->created_at->format('d/m/Y H:i') }} ({{ $review->created_at->diffForHumans() }})
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="list-star mb-1">
                                                            @for ($i = 1; $i <= 5; $i++)
                                                                <i
                                                                    class="icon icon-star{{ $i <= $review->rating ? '' : '-o' }}"
                                                                    style="color: {{ $i <= $review->rating ? '#ffb321' : '#ccc' }};"></i>
                                                            @endfor
                                                        </div>
                                                        <p class="text_black-3">{{ $review->comment }}</p>
                                                    </div>
                                                    @if ($review->admin_reply)
                                                        <div class="reply-comment-item type-reply">
                                                            <div class="user">
                                                                <div class="image">
                                                                                                                                        <img src="{{ asset('client/ecomus/images/collections/collection-circle-10.jpg') }}"
                                                                        alt="Admin Avatar">
                                                                </div>
                                                                <div>
                                                                    <h6>
                                                                        <a href="#" class="link">
                                                                            Admin Funori
                                                                        </a>
                                                                    </h6>
                                                                                                                                         <div class="day text_black-3" style="font-size: 11px; color: #666;">
                                                                     {{ $review->admin_reply_created_at ? \Carbon\Carbon::parse($review->admin_reply_created_at)->format('d/m/Y H:i') . ' (' . \Carbon\Carbon::parse($review->admin_reply_created_at)->diffForHumans() . ')' : '' }}
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
                                                                <img src="{{ $review->user && $review->user->avatar_url ? asset('storage/' . $review->user->avatar_url) : asset('client/ecomus/images/collections/collection-circle-9.jpg') }}"
                                                                     alt="{{ $review->user->full_name ?? 'User' }}"
                                                                     data-avatar-url="{{ $review->user->avatar_url ?? '' }}"
                                                                     onerror="this.src='{{ asset('client/ecomus/images/collections/collection-circle-9.jpg') }}'"
                                                                     style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;">
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
                                                                                                                                 <div class="day text_black-3" style="font-size: 11px; color: #666;">
                                                                     {{ $review->created_at ? $review->created_at->format('d/m/Y H:i') . ' (' . $review->created_at->diffForHumans() . ')' : '' }}
                                                                 </div>
                                                            </div>
                                                        </div>
                                                        <div class="list-star mb-1">
                                                            @for ($i = 1; $i <= 5; $i++)
                                                                <i
                                                                    class="icon icon-star{{ $i <= $review->rating ? '' : '-o' }}"
                                                                    style="color: {{ $i <= $review->rating ? '#FFD700' : '#ccc' }};"></i>
                                                            @endfor
                                                        </div>
                                                        {{-- <p class="text_black-3"><em>Đánh giá của bạn đang chờ
                                                                duyệt</em><br>{{ $review->comment }}</p> --}}
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    {{-- Form viết đánh giá - chỉ hiển thị cho khách hàng đã mua sản phẩm --}}
                                    @if ($canReview)
                                        <form class="form-write-review write-review-wrap" method="POST"
                                            action="{{ route('client.reviews.store', $product->id) }}">
                                            @csrf
                                            <div class="heading">
                                                <h5>Viết đánh giá:</h5>
                                                <div class="list-rating-check">
                                                    <input type="radio" id="star5" name="rating" value="5"
                                                        checked />
                                                    <label for="star5" title="text"></label>
                                                    <input type="radio" id="star4" name="rating"
                                                        value="4" />
                                                    <label for="star4" title="text"></label>
                                                    <input type="radio" id="star3" name="rating"
                                                        value="3" />
                                                    <label for="star3" title="text"></label>
                                                    <input type="radio" id="star2" name="rating"
                                                        value="2" />
                                                    <label for="star2" title="text"></label>
                                                    <input type="radio" id="star1" name="rating"
                                                        value="1" />
                                                    <label for="star1" title="text"></label>
                                                </div>
                                            </div>
                                            <div class="form-content">
                                                <fieldset class="box-field">
                                                    <label class="label">Nội dung đánh giá <small class="text-muted">(không bắt buộc)</small></label>
                                                    <textarea rows="4" name="comment" placeholder="Viết bình luận của bạn tại đây (không bắt buộc)" tabindex="2"></textarea>
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
                                    @else
                                        <div class="text-center py-4">
                                            <div class="alert alert-info" style="background: #f8f9fa; border: 1px solid #dee2e6; border-radius: 8px; padding: 20px;">
                                                <i class="bi bi-info-circle me-2" style="color: #0dcaf0;"></i>
                                                @if(isset($remainingReviews) && $remainingReviews > 0)
                                                    <strong>Thông báo:</strong> Bạn còn {{ $remainingReviews }} lần đánh giá cho sản phẩm này.
                                                    <br><small class="text-muted mt-2 d-block">Bạn có thể đánh giá lại khi mua thêm sản phẩm này.</small>
                                                @else
                                                    <strong>Thông báo:</strong> Chỉ khách hàng đã mua và nhận hàng thành công mới có thể đánh giá sản phẩm này.
                                                    <br><small class="text-muted mt-2 d-block">Đánh giá của bạn sẽ giúp khách hàng khác đưa ra quyết định mua hàng tốt hơn.</small>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
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

    {{-- Sản phẩm ngẫu nhiên --}}
    @php
        $relatedProducts = \App\Models\Product::where('id', '!=', $product->id)->inRandomOrder()->take(3)->get();
    @endphp
    <div class="box-product-sell">
        <div class="box-product-sell-2">
            <div class="in-title">
                <div class="word">Sản phẩm bạn có thể thích</div>
                <div class="see-deals">
                    <a href="{{ route('shop') }}">
                        Xem tất cả sản phẩm
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            <div class="all-new-product" id="related-products-list">
                @foreach ($relatedProducts as $idx => $item)
                    <div class="new-product" style="{{ $idx > 2 ? 'display:none;' : '' }}">
                        <div class="all-product">
                            <a href="{{ route('client.product.show', $item->slug) }}" style="text-decoration: none">
                                <div class="new-img-product">
                                    <img src="{{ asset($item->thumbnail->image_url ?? 'default.jpg') }}"
                                        alt="{{ $item->thumbnail->alt_text ?? $item->name }}">
                                    <div class="note-notif">
                                        @if ($item->is_featured)
                                            <div class="title-hot">Hot</div>
                                        @endif
                                    </div>
                                </div>
                            </a>
                            <div class="all-box-icon">
                                <button class="wishlist-btn" data-product-id="{{ $item->id }}"
                                    style="background:none;border:none;padding:0;cursor:pointer;">
                                    <i style="font-size: 18px; color:{{ in_array($item->id, $wishlistProductIds) ? 'red' : '#545353' }};"
                                        class="fa-solid fa-heart" id="heart-Product"></i>
                                </button>
                                <a href="{{ route('client.product.show', $item->slug) }}" style="color:inherit;">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </a>
                            </div>
                        </div>
                        <div class="contents-new-product">
                            <div class="star">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="fa-solid fa-star"></i>
                                @endfor
                            </div>
                            <div class="view-product">
                                ({{ $item->reviews->count() }} đánh giá)
                            </div>
                        </div>
                        <div class="box-name-product" data-product-id="{{ $item->id }}">
                            <div class="name-product">{{ $item->name }}</div>
                            <div id="Prict-prod">
                                <span>{{ number_format($item->regular_price, 2) }} đ</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            {{-- @if (count($relatedProducts) > 3)
                <div class="text-center mt-3">
                    <button id="show-more-related" class="btn btn-outline-dark px-4 py-2">Xem thêm sản phẩm</button>
                </div>
            @endif --}}
        </div>
    </div>
    {{-- /Sản phẩm ngẫu nhiên --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const btn = document.getElementById('show-more-related');
            if (btn) {
                btn.addEventListener('click', function() {
                    document.querySelectorAll('#related-products-list .new-product').forEach(function(el) {
                        el.style.display = '';
                    });
                    btn.style.display = 'none';
                });
            }
        });
    </script>

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
            const addToCartBtn = document.querySelector('.btn-add-to-cart');
            if (!addToCartBtn) return;

            addToCartBtn.addEventListener('click', function(e) {
                e.preventDefault();

                // Lấy số lượng
                const quantityInput = document.getElementById('quantity-product');
                let quantity = parseInt(quantityInput ? quantityInput.value : 1) || 1;

                // Lấy biến thể đã chọn từ dropdown
                let productVariantId = null;
                const variantSelect = document.getElementById('variant-select');
                if (variantSelect) {
                    productVariantId = variantSelect.value || null;
                }

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

                            // Cập nhật số lượng sản phẩm trong giỏ hàng
                            if (data.cart_count !== undefined) {
                                // Sử dụng function có sẵn từ header để cập nhật badge
                                if (typeof updateCartCountBadge === 'function') {
                                    updateCartCountBadge(data.cart_count);
                                } else {
                                    // Fallback: cập nhật trực tiếp badge
                                    const cartBadge = document.getElementById('cart-count-badge');
                                    if (cartBadge) {
                                        cartBadge.textContent = data.cart_count;
                                        cartBadge.style.display = data.cart_count > 0 ? 'flex' : 'none';
                                    }
                                }

                                // Cập nhật mini cart nếu có
                                if (typeof updateMiniCartContent === 'function') {
                                    updateMiniCartContent();
                                } else {
                                    // Fallback: load lại mini cart
                                    fetch('{{ route('client.cart.miniList') }}')
                                        .then(response => response.text())
                                        .then(html => {
                                            const cartPopupContent = document.getElementById(
                                                'cart-popup-content');
                                            if (cartPopupContent) {
                                                cartPopupContent.innerHTML = html;
                                            }
                                        })
                                        .catch(error => console.error('Error updating mini cart:',
                                            error));
                                }
                            }
                        } else {
                            toastr.error(data.message || 'Có lỗi xảy ra!');
                        }
                    })
                    .catch(error => {
                        toastr.error('Có lỗi xảy ra!');
                        console.error(error);
                    });
            });
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
                "timeOut": "3000",
                "closeButton": true,
                "progressBar": true,
                "preventDuplicates": true,
                "newestOnTop": true
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
                                    'meta[name=csrf-token]').getAttribute(
                                    'content'),
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
                                    if (miniWishlist) miniclient.wishlist.innerHTML =
                                        html;
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

    <style>
        @keyframes flash {
            0% {
                box-shadow: 0 0 0 rgba(0, 123, 255, 0);
                background-color: rgba(0, 123, 255, 0.05);
            }

            50% {
                box-shadow: 0 0 20px rgba(0, 123, 255, 0.35);
                background-color: rgba(0, 123, 255, 0.12);
            }

            100% {
                box-shadow: 0 0 0 rgba(0, 123, 255, 0);
                background-color: rgba(0, 123, 255, 0.05);
            }
        }

        .flash-twice {
            animation: flash 0.8s ease-in-out 2;
            border-radius: 8px;
        }

        /* Toastr custom styles */
        #toast-container > .toast-top-right {
            top: 20px;
            right: 20px;
        }

        .toast-success {
            background-color: #28a745;
            border-color: #1e7e34;
        }

        .toast-error {
            background-color: #dc3545;
            border-color: #bd2130;
        }

        .toast-warning {
            background-color: #ffc107;
            border-color: #e0a800;
            color: #212529;
        }

        .toast-info {
            background-color: #17a2b8;
            border-color: #117a8b;
        }

        .toast {
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            font-size: 14px;
            font-weight: 500;
        }

        /* Avatar styles - đồng bộ với header */
        .reply-comment-item .user .image img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid rgba(255, 48, 41, 0.15);
            display: block;
            vertical-align: middle;
        }

        .reply-comment-item .user .image img:hover {
            border-color: rgba(255, 48, 41, 0.3);
            transition: border-color 0.3s ease;
        }

        /* Star rating styles */
        .list-star .icon {
            font-size: 16px;
            margin-right: 2px;
            transition: color 0.3s ease;
        }

        .list-star .icon:hover {
            transform: scale(1.1);
        }

        /* Review date styles */
        .reply-comment-item .day {
            font-size: 13px !important;
            color: #666 !important;
            margin-top: 2px;
        }
    </style>

    <!-- Script xử lý scroll tự động đến phần đánh giá -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Kiểm tra xem có phải chuyển từ trang orderDetail không
            const fromOrderDetail = sessionStorage.getItem('fromOrderDetail');
            const scrollToReviews = sessionStorage.getItem('scrollToReviews');

            if (fromOrderDetail === 'true' && scrollToReviews === 'product-reviews') {
                // Xóa dữ liệu sessionStorage
                sessionStorage.removeItem('fromOrderDetail');
                sessionStorage.removeItem('scrollToReviews');

                // Đợi trang load hoàn toàn rồi chuyển tab và scroll
                setTimeout(function() {
                    // Tự động chuyển sang tab "Đánh giá"
                    const tabItems = document.querySelectorAll('.widget-menu-tab .item-title');
                    if (tabItems.length >= 2) {
                        // Sử dụng đúng cách mà JavaScript tab đã được thiết lập
                        const tabContents = document.querySelectorAll(
                            '.widget-content-tab .widget-content-inner');

                        // Xóa active class từ tất cả tab và content
                        tabItems.forEach(t => t.classList.remove('active'));
                        tabContents.forEach(c => c.classList.remove('active'));

                        // Thêm active class vào tab "Đánh giá" (index 1) và content tương ứng
                        tabItems[1].classList.add('active');
                        tabContents[1].classList.add('active');

                        // Đợi tab chuyển xong rồi mới scroll
                        setTimeout(function() {
                            console.log('Bắt đầu tìm phần đánh giá...');

                            // Tìm phần đánh giá sau khi đã chuyển tab
                            let reviewsSection = document.getElementById('product-reviews');

                            if (!reviewsSection) {
                                console.log('Không tìm thấy #product-reviews, tìm .tab-reviews');
                                reviewsSection = document.querySelector('.tab-reviews');
                            }

                            if (!reviewsSection) {
                                console.log(
                                    'Không tìm thấy .tab-reviews, tìm .widget-content-inner');
                                reviewsSection = document.querySelector('.widget-content-inner');
                            }

                            // Tìm tất cả các element có thể là phần đánh giá
                            const allPossibleElements = document.querySelectorAll(
                                '.tab-reviews, .widget-content-inner, [id*="review"], [class*="review"]'
                            );
                            console.log('Tất cả element có thể:', allPossibleElements);

                            // Tìm element có offsetTop lớn nhất (ở xa đầu trang nhất)
                            let bestElement = reviewsSection;
                            let maxOffsetTop = reviewsSection ? reviewsSection.offsetTop : 0;

                            allPossibleElements.forEach(element => {
                                console.log('Element:', element, 'offsetTop:', element
                                    .offsetTop);
                                if (element.offsetTop > maxOffsetTop) {
                                    maxOffsetTop = element.offsetTop;
                                    bestElement = element;
                                }
                            });

                            reviewsSection = bestElement;
                            console.log('Chọn element tốt nhất:', reviewsSection, 'offsetTop:',
                                maxOffsetTop);

                            if (reviewsSection) {
                                console.log('Bắt đầu scroll...');

                                // Scroll mượt mà đến phần đánh giá
                                const headerHeight = document.querySelector('header') ? document
                                    .querySelector('header').offsetHeight : 80;
                                const elementTop = reviewsSection.offsetTop - headerHeight - 20;

                                console.log('Header height:', headerHeight);
                                console.log('Element offsetTop:', reviewsSection.offsetTop);
                                console.log('Scroll to position:', elementTop);

                                // Tăng scroll position để scroll xa hơn
                                const scrollPosition = Math.max(0, elementTop + 550);
                                console.log('Final scroll position:', scrollPosition);

                                // Scroll với animation chậm hơn để thấy rõ
                                window.scrollTo({
                                    top: scrollPosition,
                                    behavior: 'smooth'
                                });

                                console.log('Đã thực hiện scroll');

                                // Thêm class để nháy (flash) rõ ràng hơn
                                setTimeout(function() {
                                    reviewsSection.classList.add('flash-twice');
                                    // tự gỡ class sau khi chạy xong để lần sau còn hiệu ứng
                                    setTimeout(function() {
                                        reviewsSection.classList.remove(
                                            'flash-twice');
                                    }, 1600);
                                }, 300);

                                // Thêm hiệu ứng highlight cho phần đánh giá
                                reviewsSection.style.transition = 'all 0.3s ease';
                                reviewsSection.style.boxShadow = '0 0 20px rgba(0, 123, 255, 0.3)';
                                reviewsSection.style.borderRadius = '8px';
                                reviewsSection.style.backgroundColor = 'rgba(0, 123, 255, 0.05)';

                                // Xóa hiệu ứng sau 2 giây
                                setTimeout(function() {
                                    reviewsSection.style.boxShadow = '';
                                    reviewsSection.style.borderRadius = '';
                                    reviewsSection.style.backgroundColor = '';
                                }, 2000);
                            } else {
                                console.log('Không tìm thấy phần đánh giá!');
                                // Thử scroll đến vị trí gần cuối trang
                                window.scrollTo({
                                    top: document.body.scrollHeight - window.innerHeight,
                                    behavior: 'smooth'
                                });
                            }
                        }, 200); // Tăng thời gian chờ lên 200ms

                        // Hiển thị thông báo
                        if (typeof toastr !== 'undefined') {
                            toastr.info('Bạn có thể đánh giá sản phẩm này!', 'Đánh giá sản phẩm', {
                                timeOut: 3000,
                                progressBar: true
                            });
                        }

                        // Sau đó mở form đánh giá
                        setTimeout(function() {
                            const writeReviewBtn = document.querySelector('.btn-write-review');
                            if (writeReviewBtn) {
                                writeReviewBtn.click();
                            }
                        }, 800); // Tăng thời gian chờ để đảm bảo scroll xong
                    }
                }, 500);
            }
        });

        // Hiển thị toastr từ session messages
        document.addEventListener('DOMContentLoaded', function() {
            // Kiểm tra và hiển thị toastr từ session
            @if(session('toastr_success'))
                toastr.success("{{ session('toastr_success') }}", "Thành công");
            @endif
            
            @if(session('toastr_error'))
                toastr.error("{{ session('toastr_error') }}", "Lỗi");
            @endif
            
            @if(session('toastr_warning'))
                toastr.warning("{{ session('toastr_warning') }}", "Cảnh báo");
            @endif
            
            @if(session('toastr_info'))
                toastr.info("{{ session('toastr_info') }}", "Thông tin");
            @endif

            // Xử lý hiển thị avatar
            handleAvatarDisplay();
        });

        // Function xử lý hiển thị avatar (đơn giản hóa)
        function handleAvatarDisplay() {
            const avatarImages = document.querySelectorAll('.reply-comment-item .user .image img[data-avatar-url]');
            
            avatarImages.forEach(function(img) {
                const avatarUrl = img.getAttribute('data-avatar-url');
                console.log('Avatar URL:', avatarUrl); // Debug log
                
                // Kiểm tra xem ảnh có load thành công không
                img.addEventListener('load', function() {
                    console.log('Avatar loaded successfully:', this.src); // Debug log
                });

                img.addEventListener('error', function() {
                    console.log('Avatar failed to load:', this.src); // Debug log
                });
            });
        }

        // Xử lý ngăn chặn đánh giá nhiều lần cùng lúc và validate form
        document.addEventListener('DOMContentLoaded', function() {
            const reviewForm = document.querySelector('.form-write-review');
            if (reviewForm) {
                let isSubmitting = false;
                
                reviewForm.addEventListener('submit', function(e) {
                    // Validate form trước khi submit
                    const rating = reviewForm.querySelector('input[name="rating"]:checked');
                    const comment = reviewForm.querySelector('textarea[name="comment"]').value.trim();
                    
                    if (!rating) {
                        e.preventDefault();
                        toastr.error('Vui lòng chọn số sao đánh giá!');
                        return false;
                    }
                    
                    // Comment không bắt buộc, nhưng nếu có thì phải đủ 10 ký tự
                    if (comment && comment.length < 10) {
                        e.preventDefault();
                        toastr.error('Nội dung đánh giá phải có ít nhất 10 ký tự!');
                        reviewForm.querySelector('textarea[name="comment"]').focus();
                        return false;
                    }
                    
                    if (isSubmitting) {
                        e.preventDefault();
                        toastr.warning('Bạn vừa gửi đánh giá. Vui lòng đợi một chút trước khi gửi lại!');
                        return false;
                    }
                    
                    isSubmitting = true;
                    
                    // Disable nút submit
                    const submitBtn = reviewForm.querySelector('button[type="submit"]');
                    if (submitBtn) {
                        const originalText = submitBtn.innerHTML;
                        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Đang gửi...';
                        submitBtn.disabled = true;
                        
                        // Re-enable sau 30 giây nếu có lỗi
                        setTimeout(function() {
                            isSubmitting = false;
                            submitBtn.innerHTML = originalText;
                            submitBtn.disabled = false;
                        }, 30000);
                    }
                });
                
                // Thêm validation real-time cho textarea (comment không bắt buộc)
                const commentTextarea = reviewForm.querySelector('textarea[name="comment"]');
                if (commentTextarea) {
                    commentTextarea.addEventListener('input', function() {
                        const value = this.value.trim();
                        const minLength = 10;
                        
                        // Chỉ hiển thị cảnh báo nếu có nội dung nhưng chưa đủ 10 ký tự
                        if (value.length > 0 && value.length < minLength) {
                            this.style.borderColor = '#ffc107'; // Màu vàng cảnh báo thay vì đỏ
                            this.title = `Nếu viết nội dung thì cần ít nhất ${minLength} ký tự (hiện tại: ${value.length})`;
                        } else {
                            this.style.borderColor = '';
                            this.title = '';
                        }
                    });
                }
            }
        });
    </script>
@endsection