@extends('client.layout.client')

@section('title', $product->name)

@section('content')
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
                                {{-- Hiển thị giá --}}
                                <div class="tf-product-info-price">
                                    <div class="price-on-sale" id="product-price">
                                        {{ number_format($product->regular_price, 0, ',', '.') }}đ
                                    </div>
                                </div>

                                {{-- Hiển thị các biến thể (variants) --}}
                                @if ($product->variants->count())
                                    <div class="tf-product-info-variant-picker mb-3">
                                        <div class="variant-picker-label mb-2">
                                            Chọn biến thể:
                                        </div>
                                        <div class="variant-picker-values d-flex flex-wrap gap-2">
                                            @foreach ($product->variants as $variant)
                                                <label class="variant-box p-2 border rounded mb-2"
                                                    style="min-width:160px; cursor:pointer;">
                                                    <input type="radio" name="variant_id" value="{{ $variant->id }}"
                                                        data-price="{{ $product->regular_price + $variant->price_modifier }}"
                                                        data-material="{{ $variant->material ?? '' }}"
                                                        style="margin-right: 8px;">
                                                    @if ($variant->image)
                                                        <img src="{{ asset($variant->image->image_url) }}"
                                                            alt="Ảnh biến thể"
                                                            style="width:36px;height:36px;object-fit:cover;border-radius:6px;">
                                                    @endif
                                                    <div>
                                                        <strong>Kích thước:</strong> {{ $variant->size ?? '-' }}<br>
                                                        <strong>Giá:</strong>
                                                        {{ number_format($product->regular_price + $variant->price_modifier, 0, ',', '.') }}đ<br>
                                                        <strong>Kho:</strong> {{ $variant->stock_quantity ?? '-' }}<br>
                                                        {{-- Hiển thị các thuộc tính của biến thể --}}
                                                        @if ($variant->attributeValues && $variant->attributeValues->count())
                                                            <div>
                                                                @foreach ($variant->attributeValues as $attrVal)
                                                                    <span
                                                                        class="badge bg-light text-dark border">{{ $attrVal->attribute->name ?? '' }}:
                                                                        {{ $attrVal->value ?? '' }}</span>
                                                                @endforeach
                                                            </div>
                                                        @endif
                                                    </div>
                                                </label>
                                            @endforeach
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
                            {{-- mô tả --}}
                            <div class="widget-content-inner active">
                                <div class="">
                                    <p class="mb_30">
                                        {{ $product->short_description }}
                                        <br><br>
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

                            {{-- biến thể --}}
                            <div class="widget-content-inner">
                                <table class="tf-pr-attrs">
                                    <tbody>
                                        <tr>
                                            <th class="tf-attr-label">Màu sắc</th>
                                            <td class="tf-attr-value">
                                                <p>Trắng sữa, Gỗ tự nhiên, Đen nhám</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="tf-attr-label">Kích thước</th>
                                            <td class="tf-attr-value">
                                                <p>Dài 120cm x Rộng 60cm x Cao 75cm</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="tf-attr-label">Chất liệu</th>
                                            <td class="tf-attr-value">
                                                <p>Gỗ MDF phủ Melamine chống trầy xước</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="tf-attr-label">Bảo hành</th>
                                            <td class="tf-attr-value">
                                                <p>12 tháng</p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            {{-- /biến thể --}}

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
                                                <label for="sort-select" class="me-2">Sắp xếp theo:</label>
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
            toastr.options = {
                "positionClass": "toast-bottom-right",
                "timeOut": "3000",
                "closeButton": true,
                "progressBar": true
            };
            @if (session('success'))
                toastr.success("{{ session('success') }}");
            @endif

            @if (session('error'))
                toastr.error("{{ session('error') }}");
            @endif

            document.querySelector('.btn-add-to-cart').addEventListener('click', function(e) {
                e.preventDefault();
                let
                    productId = {{ $product->id }};
                let quantity = parseInt(document.getElementById('quantity-product').value) || 1;
                let
                    variantInput = document.querySelector('input[name="variant_id" ]:checked');
                let productVariantId = variantInput ?
                    variantInput.value : null; // Nếu có biến thể nhưng chưa chọn thì báo lỗi const
                hasVariants = {{ $product->variants->count() > 0 ? 'true' : 'false' }};
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
                            product_id: productId,
                            quantity: quantity,
                            product_variant_id: productVariantId
                        })
                    }).then(response =>
                        response.json())
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

                    // Nếu muốn scroll tới form thì mở dòng sau
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
    </script>

@endsection
