@extends('client.layout.client')

@section('title', 'Trang chủ')

@section('content')
    <!-- breadcrumb -->
    <div class="tf-breadcrumb">
        <div class="container">
            <div class="tf-breadcrumb-wrap d-flex justify-content-between flex-wrap align-items-center">
                <div class="tf-breadcrumb-list">
                    <a href="{{ route('client.home') }}" class="text">Trang chủ</a>
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
                        <div class="tf-product-media-wrap sticky-top">
                            <div class="thumbs-slider">
                                <div dir="ltr" class="swiper tf-product-media-thumbs other-image-zoom"
                                    id="thumbs-swiper" data-direction="vertical">
                                    <div class="swiper-wrapper stagger-wrap">
                                        {{-- Mỗi ảnh phụ là 1 slide --}}
                                        @foreach ($product->images as $image)
                                            <div class="swiper-slide stagger-item">
                                                <div class="item">
                                                    <img class="lazyload mb-1" data-src="{{ asset($image->image_url) }}"
                                                        src="{{ asset($image->image_url) }}" alt="{{ $product->name }}">
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="swiper tf-product-media-main" id="gallery-swiper-started">
                                    <div class="swiper-wrapper">
                                        @foreach ($product->images as $image)
                                            <div class="swiper-slide">
                                                <img class="tf-image-zoom lazyload"
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
                                            loop: true,
                                            slidesPerView: 1,
                                            spaceBetween: 10,
                                            thumbs: {
                                                swiper: thumbsSwiper
                                            }
                                        });

                                        // Border active cho ảnh phụ
                                        function updateThumbBorder() {
                                            let activeIndex = gallerySwiper.realIndex;
                                            document.querySelectorAll('#thumbs-swiper .swiper-slide').forEach((el, idx) => {
                                                if (idx === activeIndex) {
                                                    el.classList.add('thumb-active');
                                                } else {
                                                    el.classList.remove('thumb-active');
                                                }
                                            });
                                        }
                                        gallerySwiper.on('slideChange', updateThumbBorder);
                                        updateThumbBorder();

                                        // Responsive thumbs direction on resize
                                        window.addEventListener('resize', function() {
                                            let dir = window.innerWidth > 768 ? 'vertical' : 'horizontal';
                                            thumbsSwiper.changeDirection(dir);
                                        });
                                    });
                                </script>
                                <style>
                                    #gallery-swiper-started {
                                        max-width: 700px;
                                        height: 600px;
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
                                </style>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="tf-product-info-wrap position-relative">
                            <div class="tf-zoom-main"></div>
                            <div class="tf-product-info-list other-image-zoom">
                                <div class="tf-product-info-title">
                                    <h5>{{ $product->name }}</h5>
                                </div>
                                <div class="tf-product-info-badges">
                                    <div class="badges text-uppercase">Bán chạy</div>
                                    <div class="product-status-content">
                                        <i class="icon-lightning"></i>
                                        <p class="fw-6">Đang bán rất chạy! 48 người đã thêm vào giỏ hàng.</p>
                                    </div>
                                </div>
                                <div class="tf-product-info-badges">
                                    @if ($product->is_featured)
                                        <div class="badges">Nổi bật</div>
                                    @endif
                                </div>
                                <div class="tf-product-info-price">
                                    <div class="price-on-sale" id="product-price">
                                        {{ number_format($product->regular_price, 0, ',', '.') }}đ
                                    </div>
                                </div>
                                {{-- Chọn biến thể kích thước --}}
                                @if ($product->variants->count())
                                    <div class="tf-product-info-variant-picker">
                                        <div class="variant-picker-item">
                                            <div class="variant-picker-label">
                                                Chọn kích thước:
                                            </div>
                                            <div class="variant-picker-values">
                                                @foreach ($product->variants as $variant)
                                                    <input id="variant-{{ $variant->id }}" type="radio"
                                                        name="variant_id" value="{{ $variant->id }}"
                                                        data-price="{{ $variant->price_modifier }}"
                                                        data-image="{{ $variant->image ? asset('client/ecomus/' . $variant->image->image_url) : '' }}"
                                                        data-material="{{ $variant->material ?? '' }}">
                                                    <label class="style-text size-btn" for="variant-{{ $variant->id }}">
                                                        <p>{{ $variant->size }}</p>
                                                    </label>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Biến thể chất liệu --}}
                                    <div class="tf-product-info-variant-picker mt-2">
                                        <div class="variant-picker-item">
                                            <div class="variant-picker-label">
                                                Chất liệu:
                                                <span id="material-label">
                                                    {{ $product->variants->first()->material ?? '' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="tf-product-info-quantity">
                                    <div class="quantity-title fw-6">Số lượng</div>
                                    <div class="wg-quantity">
                                        <span class="btn-quantity btn-decrease">-</span>
                                        <input type="text" class="quantity-product" id="quantity-product" name="number"
                                            value="1" min="1">
                                        <span class="btn-quantity btn-increase">+</span>
                                    </div>
                                </div>
                                <div class="tf-product-info-buy-button">
                                    <form class="">
                                        <a href="javascript:void(0);"
                                            class="tf-btn btn-fill justify-content-center fw-6 fs-16 flex-grow-1 animate-hover-btn btn-add-to-cart">
                                            <span>Thêm vào giỏ hàng -&nbsp;</span>
                                            <span class="tf-qty-price" id="total-price">
                                                {{ number_format($product->regular_price, 0, ',', '.') }}đ
                                            </span>
                                        </a>
                                        <div class="tf-product-btn-wishlist btn-icon-action">
                                            <i class="icon-heart"></i>
                                            <i class="icon-delete"></i>
                                        </div>
                                        <div class="w-100">
                                            <a href="#" class="btns-full">Mua với <img
                                                    src="{{ asset('client/ecomus/images/payments/paypal.png') }}"
                                                    alt=""></a>
                                            <a href="#" class="payment-more-option">Thêm phương thức thanh toán</a>
                                        </div>
                                    </form>
                                </div>
                                <div class="tf-product-info-extra-link">
                                    <a href="#compare_color" data-bs-toggle="modal" class="tf-product-extra-icon">
                                        <div class="icon">
                                            <img src="{{ asset('client/ecomus/images/item/compare.svg') }}"
                                                alt="">
                                        </div>
                                        <div class="text fw-6">So sánh màu</div>
                                    </a>
                                    <a href="#ask_question" data-bs-toggle="modal" class="tf-product-extra-icon">
                                        <div class="icon">
                                            <i class="icon-question"></i>
                                        </div>
                                        <div class="text fw-6">Hỏi đáp</div>
                                    </a>
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
                                <div class="tf-product-info-delivery-return">
                                    <div class="row">
                                        <div class="col-xl-6 col-12">
                                            <div class="tf-product-delivery">
                                                <div class="icon">
                                                    <i class="icon-delivery-time"></i>
                                                </div>
                                                <p>Thời gian giao hàng dự kiến: <span class="fw-7">12-26 ngày</span>
                                                    (Quốc tế), <span class="fw-7">3-6 ngày</span> (Nội địa).</p>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-12">
                                            <div class="tf-product-delivery mb-0">
                                                <div class="icon">
                                                    <i class="icon-return-order"></i>
                                                </div>
                                                <p>Đổi trả trong vòng <span class="fw-7">30 ngày</span> kể từ ngày mua.
                                                    Thuế và phí không hoàn lại.</p>
                                            </div>
                                        </div>
                                    </div>
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
    <!-- /default -->

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
                });
            });

            quantityInput.addEventListener('input', updatePrice);

            // Tăng giảm số lượng
            document.querySelectorAll('.btn-quantity').forEach(btn => {
                btn.addEventListener('click', function() {
                    let val = parseInt(quantityInput.value) || 1;
                    if (this.classList.contains('btn-increase')) {
                        quantityInput.value = val + 1;
                    } else if (this.classList.contains('btn-decrease') && val > 1) {
                        quantityInput.value = val - 1;
                    }
                    updatePrice();
                });
            });

            updatePrice();
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
                                <span class="inner">Thông tin bổ sung</span>
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
                            <div class="widget-content-inner active">
                                <div class="">
                                    <p class="mb_30">
                                        {{ $product->short_description }}
                                        <br><br>
                                        {!! nl2br(e($product->description)) !!}
                                    </p>
                                    <div class="tf-product-des-demo">
                                        <div class="right">
                                            <h3 class="fs-16 fw-5">Tính năng</h3>
                                            <ul>
                                                <li>Cài nút phía trước</li>
                                                <li> Điều chỉnh tay áo</li>
                                                <li>Thêu logo Babaton ở ngực và gấu áo</li>
                                            </ul>
                                            <h3 class="fs-16 fw-5">Chất liệu & Bảo quản</h3>
                                            <ul class="mb-0">
                                                <li>Thành phần: 100% LENZING™ ECOVERO™ Viscose</li>
                                                <li>Bảo quản: Giặt tay</li>
                                                <li>Nhập khẩu</li>
                                            </ul>
                                        </div>
                                        <div class="left">
                                            <h3 class="fs-16 fw-5">Chất liệu & Bảo quản</h3>
                                            <div class="d-flex gap-10 mb_15 align-items-center">
                                                <div class="icon">
                                                    <i class="icon-machine"></i>
                                                </div>
                                                <span>Giặt máy tối đa 30ºC. Vắt nhẹ.</span>
                                            </div>
                                            <div class="d-flex gap-10 mb_15 align-items-center">
                                                <div class="icon">
                                                    <i class="icon-iron"></i>
                                                </div>
                                                <span>Là tối đa 110ºC.</span>
                                            </div>
                                            <div class="d-flex gap-10 mb_15 align-items-center">
                                                <div class="icon">
                                                    <i class="icon-bleach"></i>
                                                </div>
                                                <span>Không tẩy.</span>
                                            </div>
                                            <div class="d-flex gap-10 mb_15 align-items-center">
                                                <div class="icon">
                                                    <i class="icon-dry-clean"></i>
                                                </div>
                                                <span>Không giặt khô.</span>
                                            </div>
                                            <div class="d-flex gap-10 align-items-center">
                                                <div class="icon">
                                                    <i class="icon-tumble-dry"></i>
                                                </div>
                                                <span>Sấy khô ở nhiệt độ trung bình.</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-content-inner">
                                <table class="tf-pr-attrs">
                                    <tbody>
                                        <tr class="tf-attr-pa-color">
                                            <th class="tf-attr-label">Màu sắc</th>
                                            <td class="tf-attr-value">
                                                <p>Trắng, Hồng, Đen</p>
                                            </td>
                                        </tr>
                                        <tr class="tf-attr-pa-size">
                                            <th class="tf-attr-label">Kích thước</th>
                                            <td class="tf-attr-value">
                                                <p>S, M, L, XL</p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            {{-- đánh giá --}}
                            <div class="widget-content-inner">
                                <div class="tab-reviews write-cancel-review-wrap">
                                    <div class="tab-reviews-heading">
                                        <div class="top">
                                            <div class="text-center">
                                                <h1 class="number fw-6">4.8</h1>
                                                <div class="list-star">
                                                    <i class="icon icon-star"></i>
                                                    <i class="icon icon-star"></i>
                                                    <i class="icon icon-star"></i>
                                                    <i class="icon icon-star"></i>
                                                    <i class="icon icon-star"></i>
                                                </div>
                                                <p>(168 Đánh giá)</p>
                                            </div>
                                            <div class="rating-score">
                                                <div class="item">
                                                    <div class="number-1 text-caption-1">5</div>
                                                    <i class="icon icon-star"></i>
                                                    <div class="line-bg">
                                                        <div style="width: 94.67%;"></div>
                                                    </div>
                                                    <div class="number-2 text-caption-1">59</div>
                                                </div>
                                                <div class="item">
                                                    <div class="number-1 text-caption-1">4</div>
                                                    <i class="icon icon-star"></i>
                                                    <div class="line-bg">
                                                        <div style="width: 60%;"></div>
                                                    </div>
                                                    <div class="number-2 text-caption-1">46</div>
                                                </div>
                                                <div class="item">
                                                    <div class="number-1 text-caption-1">3</div>
                                                    <i class="icon icon-star"></i>
                                                    <div class="line-bg">
                                                        <div style="width: 0%;"></div>
                                                    </div>
                                                    <div class="number-2 text-caption-1">0</div>
                                                </div>
                                                <div class="item">
                                                    <div class="number-1 text-caption-1">2</div>
                                                    <i class="icon icon-star"></i>
                                                    <div class="line-bg">
                                                        <div style="width: 0%;"></div>
                                                    </div>
                                                    <div class="number-2 text-caption-1">0</div>
                                                </div>
                                                <div class="item">
                                                    <div class="number-1 text-caption-1">1</div>
                                                    <i class="icon icon-star"></i>
                                                    <div class="line-bg">
                                                        <div style="width: 0%;"></div>
                                                    </div>
                                                    <div class="number-2 text-caption-1">0</div>
                                                </div>
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
                                            <h5 class="">03 Bình luận</h5>
                                            <div class="d-flex align-items-center gap-12">
                                                <div class="text-caption-1">Sắp xếp theo:</div>
                                                <div class="tf-dropdown-sort" data-bs-toggle="dropdown">
                                                    <div class="btn-select">
                                                        <span class="text-sort-value">Mới nhất</span>
                                                        <span class="icon icon-arrow-down"></span>
                                                    </div>
                                                    <div class="dropdown-menu">
                                                        <div class="select-item active">
                                                            <span class="text-value-item">Mới nhất</span>
                                                        </div>
                                                        <div class="select-item">
                                                            <span class="text-value-item">Cũ nhất</span>
                                                        </div>
                                                        <div class="select-item">
                                                            <span class="text-value-item">Phổ biến nhất</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="reply-comment-wrap">
                                            <div class="reply-comment-item">
                                                <div class="user">
                                                    <div class="image">
                                                        <img src="{{ asset('client/ecomus/images/collections/collection-circle-9.jpg') }}"
                                                            alt="">
                                                    </div>
                                                    <div>
                                                        <h6>
                                                            <a href="#" class="link">Chất lượng tuyệt vời vượt
                                                                mong đợi</a>
                                                        </h6>
                                                        <div class="day text_black-3">1 ngày trước</div>
                                                    </div>
                                                </div>
                                                <p class="text_black-3">Giao diện tuyệt vời - chúng tôi đang tìm một giao
                                                    diện với nhiều tính năng tích hợp sẵn và linh hoạt, và đây là lựa chọn
                                                    hoàn hảo. Chúng tôi nghĩ sẽ phải thuê lập trình viên để hoàn thiện,
                                                    nhưng thực tế tự làm được hết. Hỗ trợ cũng rất nhanh và hữu ích.</p>
                                            </div>
                                            <div class="reply-comment-item type-reply">
                                                <div class="user">
                                                    <div class="image">
                                                        <img src="{{ asset('client/ecomus/images/collections/collection-circle-10.jpg') }}"
                                                            alt="">
                                                    </div>
                                                    <div>
                                                        <h6>
                                                            <a href="#" class="link">Phản hồi từ Modave</a>
                                                        </h6>
                                                        <div class="day text_black-3">1 ngày trước</div>
                                                    </div>
                                                </div>
                                                <p class="text_black-3">Chúng tôi rất vui khi nghe điều đó! Điều chúng tôi
                                                    yêu thích nhất ở Modave là giúp chủ shop tự xây dựng website đẹp mà
                                                    không cần thuê lập trình viên :) Cảm ơn bạn vì đánh giá tuyệt vời này!
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <form class="form-write-review write-review-wrap">
                                        <div class="heading">
                                            <h5>Viết đánh giá:</h5>
                                            <div class="list-rating-check">
                                                <input type="radio" id="star5" name="rate" value="5" />
                                                <label for="star5" title="text"></label>
                                                <input type="radio" id="star4" name="rate" value="4" />
                                                <label for="star4" title="text"></label>
                                                <input type="radio" id="star3" name="rate" value="3" />
                                                <label for="star3" title="text"></label>
                                                <input type="radio" id="star2" name="rate" value="2" />
                                                <label for="star2" title="text"></label>
                                                <input type="radio" id="star1" name="rate" value="1" />
                                                <label for="star1" title="text"></label>
                                            </div>
                                        </div>
                                        <div class="form-content">
                                            <fieldset class="box-field">
                                                <label class="label">Tiêu đề đánh giá</label>
                                                <input type="text" placeholder="Nhập tiêu đề đánh giá" name="text"
                                                    tabindex="2" value="" aria-required="true" required="">
                                            </fieldset>
                                            <fieldset class="box-field">
                                                <label class="label">Nội dung đánh giá</label>
                                                <textarea rows="4" placeholder="Viết bình luận của bạn tại đây" tabindex="2" aria-required="true"
                                                    required=""></textarea>
                                            </fieldset>
                                            <div class="box-field group-2">
                                                <fieldset>
                                                    <input type="text" placeholder="Tên của bạn (hiển thị công khai)"
                                                        name="text" tabindex="2" value=""
                                                        aria-required="true" required="">
                                                </fieldset>
                                                <fieldset>
                                                    <input type="email" placeholder="Email của bạn (bảo mật)"
                                                        name="email" tabindex="2" value=""
                                                        aria-required="true" required="">
                                                </fieldset>
                                            </div>
                                            <div class="box-check">
                                                <input type="checkbox" name="availability" class="tf-check"
                                                    id="check1">
                                                <label class="text_black-3" for="check1">Lưu tên, email và website của
                                                    tôi cho lần bình luận sau.</label>
                                            </div>
                                        </div>
                                        <div class="button-submit">
                                            <button class="tf-btn btn-fill animate-hover-btn" type="submit">Gửi đánh
                                                giá</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            {{-- đánh giá --}}
                            <div class="widget-content-inner">
                                <div class="tf-page-privacy-policy">
                                    <div class="title">Chính sách bảo mật của Công ty</div>
                                    <p>Công ty TNHH và các công ty con, công ty mẹ, công ty liên kết của chúng tôi được coi
                                        là vận hành Website này (“chúng tôi”) nhận thấy bạn quan tâm đến cách thông tin về
                                        bạn được sử dụng và chia sẻ. Chúng tôi đã tạo ra Chính sách bảo mật này để thông báo
                                        cho bạn biết chúng tôi thu thập những thông tin gì trên Website, cách chúng tôi sử
                                        dụng thông tin của bạn và các lựa chọn bạn có về cách thông tin của bạn được thu
                                        thập và sử dụng. Vui lòng đọc kỹ Chính sách bảo mật này. Việc bạn sử dụng Website
                                        đồng nghĩa với việc bạn đã đọc và chấp nhận các thực tiễn bảo mật của chúng tôi như
                                        được nêu trong Chính sách bảo mật này.</p>
                                    <p>Lưu ý rằng các thực tiễn được mô tả trong Chính sách bảo mật này áp dụng cho thông
                                        tin được chúng tôi hoặc các công ty con, công ty liên kết hoặc đại lý của chúng tôi
                                        thu thập: (i) thông qua Website này, (ii) khi áp dụng, thông qua Bộ phận Chăm sóc
                                        khách hàng của chúng tôi liên quan đến Website này, (iii) thông qua thông tin được
                                        cung cấp cho chúng tôi tại các cửa hàng bán lẻ độc lập của chúng tôi, và (iv) thông
                                        qua thông tin được cung cấp cho chúng tôi liên quan đến các chương trình khuyến mãi
                                        và rút thăm trúng thưởng.</p>
                                    <p>Chúng tôi không chịu trách nhiệm về nội dung hoặc thực tiễn bảo mật trên bất kỳ trang
                                        web nào khác.</p>
                                    <p>Chúng tôi có quyền, theo quyết định riêng của mình, sửa đổi, cập nhật, bổ sung,
                                        ngừng, xóa hoặc thay đổi bất kỳ phần nào của Chính sách bảo mật này, toàn bộ hoặc
                                        một phần, bất cứ lúc nào. Khi chúng tôi sửa đổi Chính sách bảo mật này, chúng tôi sẽ
                                        cập nhật ngày “cập nhật lần cuối” nằm ở đầu Chính sách bảo mật này.</p>
                                    <p>Nếu bạn cung cấp thông tin cho chúng tôi hoặc truy cập hoặc sử dụng Website dưới bất
                                        kỳ hình thức nào sau khi Chính sách bảo mật này đã được thay đổi, bạn sẽ được coi là
                                        đã vô điều kiện đồng ý với những thay đổi đó. Phiên bản mới nhất của Chính sách bảo
                                        mật này sẽ có trên Website và sẽ thay thế tất cả các phiên bản trước đó.</p>
                                    <p>Nếu bạn có bất kỳ câu hỏi nào về Chính sách bảo mật này, vui lòng liên hệ Bộ phận
                                        Chăm sóc khách hàng của chúng tôi qua email tại marketing@company.com</p>
                                </div>
                            </div>
                            <div class="widget-content-inner">
                                <ul class="d-flex justify-content-center mb_18">
                                    <li class="">
                                        <svg viewBox="0 0 40 40" width="35px" height="35px" color="#222"
                                            margin="5px">
                                            <path fill="currentColor"
                                                d="M8.7 30.7h22.7c.3 0 .6-.2.7-.6l4-25.3c-.1-.4-.3-.7-.7-.8s-.7.2-.8.6L34 8.9l-3-1.1c-2.4-.9-5.1-.5-7.2 1-2.3 1.6-5.3 1.6-7.6 0-2.1-1.5-4.8-1.9-7.2-1L6 8.9l-.7-4.3c0-.4-.4-.7-.7-.6-.4.1-.6.4-.6.8l4 25.3c.1.3.3.6.7.6zm.8-21.6c2-.7 4.2-.4 6 .8 1.4 1 3 1.5 4.6 1.5s3.2-.5 4.6-1.5c1.7-1.2 4-1.6 6-.8l3.3 1.2-3 19.1H9.2l-3-19.1 3.3-1.2zM32 32H8c-.4 0-.7.3-.7.7s.3.7.7.7h24c.4 0 .7-.3.7-.7s-.3-.7-.7-.7zm0 2.7H8c-.4 0-.7.3-.7.7s.3.6.7.6h24c.4 0 .7-.3.7-.7s-.3-.6-.7-.6zm-17.9-8.9c-1 0-1.8-.3-2.4-.6l.1-2.1c.6.4 1.4.6 2 .6.8 0 1.2-.4 1.2-1.3s-.4-1.3-1.3-1.3h-1.3l.2-1.9h1.1c.6 0 1-.3 1-1.3 0-.8-.4-1.2-1.1-1.2s-1.2.2-1.9.4l-.2-1.9c.7-.4 1.5-.6 2.3-.6 2 0 3 1.3 3 2.9 0 1.2-.4 1.9-1.1 2.3 1 .4 1.3 1.4 1.3 2.5.3 1.8-.6 3.5-2.9 3.5zm4-5.5c0-3.9 1.2-5.5 3.2-5.5s3.2 1.6 3.2 5.5-1.2 5.5-3.2 5.5-3.2-1.6-3.2-5.5zm4.1 0c0-2-.1-3.5-.9-3.5s-1 1.5-1 3.5.1 3.5 1 3.5c.8 0 .9-1.5.9-3.5zm4.5-1.4c-.9 0-1.5-.8-1.5-2.1s.6-2.1 1.5-2.1 1.5.8 1.5 2.1-.5 2.1-1.5 2.1zm0-.8c.4 0 .7-.5.7-1.2s-.2-1.2-.7-1.2-.7.5-.7 1.2.3 1.2.7 1.2z">
                                            </path>
                                        </svg>
                                    </li>
                                    <li class="">
                                        <svg viewBox="0 0 40 40" width="35px" height="35px" color="#222"
                                            margin="5px">
                                            <path fill="currentColor"
                                                d="M36.7 31.1l-2.8-1.3-4.7-9.1 7.5-3.5c.4-.2.6-.6.4-1s-.6-.5-1-.4l-7.5 3.5-7.8-15c-.3-.5-1.1-.5-1.4 0l-7.8 15L4 15.9c-.4-.2-.8 0-1 .4s0 .8.4 1l7.5 3.5-4.7 9.1-2.8 1.3c-.4.2-.6.6-.4 1 .1.3.4.4.7.4.1 0 .2 0 .3-.1l1-.4-1.5 2.8c-.1.2-.1.5 0 .8.1.2.4.3.7.3h31.7c.3 0 .5-.1.7-.4.1-.2.1-.5 0-.8L35.1 32l1 .4c.1 0 .2.1.3.1.3 0 .6-.2.7-.4.1-.3 0-.8-.4-1zm-5.1-2.3l-9.8-4.6 6-2.8 3.8 7.4zM20 6.4L27.1 20 20 23.3 12.9 20 20 6.4zm-7.8 15l6 2.8-9.8 4.6 3.8-7.4zm22.4 13.1H5.4L7.2 31 20 25l12.8 6 1.8 3.5z">
                                            </path>
                                        </svg>
                                    </li>
                                    <li class="">
                                        <svg viewBox="0 0 40 40" width="35px" height="35px" color="#222"
                                            margin="5px">
                                            <path fill="currentColor"
                                                d="M5.9 5.9v28.2h28.2V5.9H5.9zM19.1 20l-8.3 8.3c-2-2.2-3.2-5.1-3.2-8.3s1.2-6.1 3.2-8.3l8.3 8.3zm-7.4-9.3c2.2-2 5.1-3.2 8.3-3.2s6.1 1.2 8.3 3.2L20 19.1l-8.3-8.4zM20 20.9l8.3 8.3c-2.2 2-5.1 3.2-8.3 3.2s-6.1-1.2-8.3-3.2l8.3-8.3zm.9-.9l8.3-8.3c2 2.2 3.2 5.1 3.2 8.3s-1.2 6.1-3.2 8.3L20.9 20zm8.4-10.2c-1.2-1.1-2.6-2-4.1-2.6h6.6l-2.5 2.6zm-18.6 0L8.2 7.2h6.6c-1.5.6-2.9 1.5-4.1 2.6zm-.9.9c-1.1 1.2-2 2.6-2.6 4.1V8.2l2.6 2.5zM7.2 25.2c.6 1.5 1.5 2.9 2.6 4.1l-2.6 2.6v-6.7zm3.5 5c1.2 1.1 2.6 2 4.1 2.6H8.2l2.5-2.6zm18.6 0l2.6 2.6h-6.6c1.4-.6 2.8-1.5 4-2.6zm.9-.9c1.1-1.2 2-2.6 2.6-4.1v6.6l-2.6-2.5zm2.6-14.5c-.6-1.5-1.5-2.9-2.6-4.1l2.6-2.6v6.7z">
                                            </path>
                                        </svg>
                                    </li>
                                    <li class="">
                                        <svg viewBox="0 0 40 40" width="35px" height="35px" color="#222"
                                            margin="5px">
                                            <path fill="currentColor"
                                                d="M35.1 33.6L33.2 6.2c0-.4-.3-.7-.7-.7H13.9c-.4 0-.7.3-.7.7s.3.7.7.7h18l.7 10.5H20.8c-8.8.2-15.9 7.5-15.9 16.4 0 .4.3.7.7.7h28.9c.2 0 .4-.1.5-.2s.2-.3.2-.5v-.2h-.1zm-28.8-.5C6.7 25.3 13 19 20.8 18.9h11.9l1 14.2H6.3zm11.2-6.8c0 1.2-1 2.1-2.1 2.1s-2.1-1-2.1-2.1 1-2.1 2.1-2.1 2.1 1 2.1 2.1zm6.3 0c0 1.2-1 2.1-2.1 2.1-1.2 0-2.1-1-2.1-2.1s1-2.1 2.1-2.1 2.1 1 2.1 2.1z">
                                            </path>
                                        </svg>
                                    </li>
                                    <li class="">
                                        <svg viewBox="0 0 40 40" width="35px" height="35px" color="#222"
                                            margin="5px">
                                            <path fill="currentColor"
                                                d="M20 33.8c7.6 0 13.8-6.2 13.8-13.8S27.6 6.2 20 6.2 6.2 12.4 6.2 20 12.4 33.8 20 33.8zm0-26.3c6.9 0 12.5 5.6 12.5 12.5S26.9 32.5 20 32.5 7.5 26.9 7.5 20 13.1 7.5 20 7.5zm-.4 15h.5c1.8 0 3-1.1 3-3.7 0-2.2-1.1-3.6-3.1-3.6h-2.6v10.6h2.2v-3.3zm0-5.2h.4c.6 0 .9.5.9 1.7 0 1.1-.3 1.7-.9 1.7h-.4v-3.4z">
                                            </path>
                                        </svg>
                                    </li>
                                    <li class="">
                                        <svg viewBox="0 0 40 40" width="35px" height="35px" color="#222"
                                            margin="5px">
                                            <path fill="currentColor"
                                                d="M30.2 29.3c2.2-2.5 3.6-5.7 3.6-9.3s-1.4-6.8-3.6-9.3l3.6-3.6c.3-.3.3-.7 0-.9-.3-.3-.7-.3-.9 0l-3.6 3.6c-2.5-2.2-5.7-3.6-9.3-3.6s-6.8 1.4-9.3 3.6L7.1 6.2c-.3-.3-.7-.3-.9 0-.3.3-.3.7 0 .9l3.6 3.6c-2.2 2.5-3.6 5.7-3.6 9.3s1.4 6.8 3.6 9.3l-3.6 3.6c-.3.3-.3.7 0 .9.1.1.3.2.5.2s.3-.1.5-.2l3.6-3.6c2.5 2.2 5.7 3.6 9.3 3.6s6.8-1.4 9.3-3.6l3.6 3.6c.1.1.3.2.5.2s.3-.1.5-.2c.3-.3.3-.7 0-.9l-3.8-3.6z">
                                            </path>
                                        </svg>
                                    </li>
                                    <li class="">
                                        <svg viewBox="0 0 40 40" width="35px" height="35px" color="#222"
                                            margin="5px">
                                            <path fill="currentColor"
                                                d="M34.1 34 .1H5.9V5.9h28.2v28.2zM7.2 32.8h25.6V7.2H7.2v25.6zm13.5-18.3a.68.68 0 0 0-.7-.7.68.68 0 0 0-.7.7v10.9a.68.68 0 0 0 .7.7.68.68 0 0 0 .7-.7V14.5z">
                                            </path>
                                        </svg>
                                    </li>
                                </ul>
                                <p class="text-center text-paragraph">LT01: 70% len, 15% polyester, 10% polyamide, 5%
                                    acrylic 900 Grms/mt</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /tabs -->
@endsection
