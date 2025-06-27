{{-- filepath: d:\laragon\www\Funori-main\resources\views\client\shop.blade.php --}}
@extends('client.layout.client')

@section('content')

    <div class="box-banner-shop">
        <div class="in-box-banner">
            <div class="text-title-banner">
                Shop
            </div>
            <div class="box-path">
                <div>
                    Home
                </div>
                <div class="icon">
                    <i class="fa-solid fa-angle-right"></i>
                </div>
                <div>
                    Shop
                </div>
            </div>
            <div class="box-list-product">
                <div class="box-shop-product">
                    <a href="">
                        <img src="../Picture/Shop/categories-19.jpg" alt="">
                        <div class="name-product">
                            <p>Armchairs</p>
                        </div>
                    </a>
                </div>
                <div class="box-shop-product">
                    <a href="">
                        <img src="../Picture/Shop/categories-18.jpg" alt="">
                        <div class="name-product">
                            <p>Outdoor</p>
                        </div>
                    </a>
                </div>
                <div class="box-shop-product">
                    <a href="">
                        <img src="../Picture/Shop/categories-6.jpg" alt="">
                        <div class="name-product">
                            <p>Sofas</p>
                        </div>
                    </a>
                </div>
                <div class="box-shop-product">
                    <a href="">
                        <img src="../Picture/Shop/categories-10.jpg" alt="">
                        <div class="name-product">
                            <p>Storage</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="box-shop">
        <div class="box-sidebar">
            <div class="first-sidebar" style="margin-bottom: 20px;">
                <div class="title-sidebar">
                    Categories
                </div>
                @foreach($categories as $category)
                    <div class="in-sidebar">
                        <a href="{{ route('shop', ['category_id' => $category->id]) }}"
                            style="display:flex;justify-content:space-between;align-items:center;text-decoration:none;color:inherit;">
                            <div class="name" @if(request('category_id') == $category->id) style="font-weight:bold;color:#fcad02;"
                            @endif>
                                {{ $category->name }}
                            </div>
                            <div class="box-number">{{ $category->products_count }}</div>
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="box-price">
                <div class="price-title">Price</div>
                <input type="range" name="" id="">
                <div class="box-range">
                    Range:
                    <span>$50</span>
                    <span>-</span>
                    <span>$500</span>
                </div>
            </div>

            <div class="all-box-brands">
                <div class="title-brands">Brands</div>
                <div class="box-list-brands">
                    <div class="box-img-brands">
                        <a href="">
                            <img src="../Picture/Shop/brand-1-1.jpg" alt="">
                        </a>
                    </div>
                    <div class="box-img-brands">
                        <a href="">
                            <img src="../Picture/Shop/brand-2-1.jpg" alt="">
                        </a>
                    </div>
                    <div class="box-img-brands">
                        <a href="">
                            <img src="../Picture/Shop/brand-3-1.jpg" alt="">
                        </a>
                    </div>
                    <div class="box-img-brands">
                        <a href="">
                            <img src="../Picture/Shop/brand-4-1.jpg" alt="">
                        </a>
                    </div>
                </div>
            </div>
            <div class="box-feature-product">
                <div class="text-feature-product">Feature Product</div>
                <div>
                    <div class="box-product-in">
                        <div class="picture-product-in">
                            <a href="">
                                <img src="../Picture/Shop/products-10-7.jpg" alt="">
                            </a>
                        </div>
                        <div class="box-in-content">
                            <div class="box-star">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                            <div class="title-feature-product">
                                Theo Round Dining Table
                            </div>
                            <div class="price-feature-prod">
                                <del>$80.00</del>
                                <span>$50.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="box-product-in">
                        <div class="picture-product-in">
                            <a href="">
                                <img src="../Picture/Shop/products-4.jpg" alt="">
                            </a>
                        </div>
                        <div class="box-in-content">
                            <div class="box-star">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                            <div class="title-feature-product">
                                Egg Dining Table
                            </div>
                            <div class="price-feature-prod">
                                <del>$150.00</del>
                                <span>$100.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="box-product-in" style="border: none;">
                        <div class="picture-product-in">
                            <a href="">
                                <img src="../Picture/Shop/products-16-6.jpg" alt="">
                            </a>
                        </div>
                        <div class="box-in-content">
                            <div class="box-star">
                                <i style="color: rgb(219, 218, 218);" class="fa-solid fa-star"></i>
                                <i style="color: rgb(219, 218, 218);" class="fa-solid fa-star"></i>
                                <i style="color: rgb(219, 218, 218);" class="fa-solid fa-star"></i>
                                <i style="color: rgb(219, 218, 218);" class="fa-solid fa-star"></i>
                                <i style="color: rgb(219, 218, 218);" class="fa-solid fa-star"></i>
                            </div>
                            <div class="title-feature-product">
                                T12 Dining Table - Black
                            </div>
                            <div class="price-feature-prod">
                                <del>$500.00</del>
                                <span>$450.00</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="box-all-product">
            <div class="header-product">
                <div class="show-item">
                    <div>
                        Hiển thị {{ $products->firstItem() }}–{{ $products->lastItem() }} trên tổng số
                        {{ $products->total() }} sản phẩm
                    </div>
                </div>
                <select name="" id="box-all-list">
                    <option value="">Default Sorting</option>
                    <option value="">Sort By Popularity</option>
                    <option value="">Sort By Average Rating</option>
                    <option value="">Sort By Latest</option>
                    <option value="">Sort By Price: Low To High</option>
                    <option value="">Sort By Price: High To Low</option>
                </select>
            </div>
            <div class="all-box-new-product" style="display: flex; flex-wrap: wrap; gap: 24px;">
                @foreach($products as $product)
                    <div class="new-product-1">
                        <div class="pic-product-1">
                            <a href="">
                                <img src="{{ $product->images->first() ? asset($product->images->first()->image_url) : asset('images/no-image.png') }}"
                                    alt="{{ $product->name }}"
                                    onmouseover="this.src='{{ $product->images->get(1) ? asset($product->images->get(1)->image_url) : asset($product->images->first() ? $product->images->first()->image_url : 'images/no-image.png') }}'"
                                    onmouseout="this.src='{{ $product->images->first() ? asset($product->images->first()->image_url) : asset('images/no-image.png') }}'">
                                <div class="box-icon-new-product">
                                    <i style="font-size: 19px;" id="cart-Product" class="fa-solid fa-cart-shopping"></i>
                                    <i style="font-size: 18px;" id="heart-Product" class="fa-solid fa-heart"></i>
                                    <i style="font-size: 18px;" id="search-Product" class="fa-solid fa-magnifying-glass"></i>
                                </div>
                            </a>
                        </div>
                        <div class="box-star" style="width: 100%; height: 23px;">
                            @php
                                $avg = round($product->reviews->avg('rating'), 1);
                                $count = $product->reviews->count();
                            @endphp
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= floor($avg))
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
                            <a href="   ">{{ $product->name }}</a>
                        </div>
                        <div style="font-size: 16px; color: rgb(170, 167, 167);">
                            {{ number_format($product->regular_price, 0, ',', '.') }} đ
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="box-footer-product">
                <div class="title-footer-product">
                    Hiển thị {{ $products->firstItem() }}–{{ $products->lastItem() }} trên tổng số {{ $products->total() }}
                    sản phẩm
                </div>
                <div class="box-percent">
                    <div class="in-percent"></div>
                </div>
                <div class="buttom-load">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>

@endsection