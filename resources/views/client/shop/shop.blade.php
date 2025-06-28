{{-- filepath: d:\laragon\www\Funori-main\resources\views\client\shop.blade.php --}}
@extends('client.layout.client')

@section('content')

    <div class="box-banner-shop"
        @if(isset($mainBanner))
            style="background: url('{{ asset('storage/'.$mainBanner->image_url) }}') center center/cover no-repeat; border-radius: 16px; min-height: 260px; position: relative;"
        @endif
    >
        <div class="in-box-banner" style="background: rgba(255,255,255,0.85); border-radius: 16px; padding: 32px;">
            <div class="text-title-banner">
                {{ $mainBanner->title ?? 'Shop' }}
            </div>
            <div class="box-path">
                <div>Home</div>
                <div class="icon"><i class="fa-solid fa-angle-right"></i></div>
                <div>Shop</div>
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
                    @foreach($brands as $brand)
                        <div class="box-img-brands" style="margin-bottom: 10px;">
                            <a href="{{ route('shop', array_merge(request()->except('page'), ['brand_id' => $brand->id])) }}"
                               style="display:block;{{ request('brand_id') == $brand->id ? 'border:2px solid #fcad02;border-radius:8px;' : '' }}">
                                @if($brand->logo_url)
                                    <img src="{{ asset('storage/'.$brand->logo_url) }}" alt="{{ $brand->name }}" style="max-width:60px;max-height:60px;">
                                @else
                                    <div style="width:60px;height:60px;display:flex;align-items:center;justify-content:center;background:#f3f3f3;border-radius:8px;">
                                        {{ $brand->name }}
                                    </div>
                                @endif
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="box-feature-product">
                <div class="text-feature-product">Feature Product</div>
                <div>
                    @foreach($featuredProducts as $product)
                        <div class="box-product-in" style="{{ $loop->last ? 'border: none;' : '' }}">
                            <div class="picture-product-in">
                                <a href="">
                                    <img src="{{ $product->images->first() ? asset($product->images->first()->image_url) : asset('images/no-image.png') }}" alt="{{ $product->name }}">
                                </a>
                            </div>
                            <div class="box-in-content">
                                <div class="box-star">
                                    @php
                                        $avg = round($product->reviews->avg('rating'), 1);
                                    @endphp
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= floor($avg))
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
                                    @if($product->old_price)
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
            <div class="header-product">
                <form method="GET" id="sort-form" style="display:inline;">
                    @foreach(request()->except(['sort','page']) as $key => $value)
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                    @endforeach
                    <select name="sort" id="box-all-list" onchange="document.getElementById('sort-form').submit()">
                        <option value="">Default Sorting</option>
                        <option value="popularity" {{ request('sort') == 'popularity' ? 'selected' : '' }}>Sort By Popularity</option>
                        <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>Sort By Average Rating</option>
                        <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Sort By Latest</option>
                        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Sort By Price: Low To High</option>
                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Sort By Price: High To Low</option>
                    </select>
                </form>
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
            <div class="box-footer-product" style="display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; padding: 18px 20px; background: #f8f8f8; border-radius: 10px; margin-top: 24px;">
                <div class="title-footer-product" style="font-size: 15px; color: #333;">
                    Hiển thị
                    <span style="font-weight: bold;">{{ $products->firstItem() }}–{{ $products->lastItem() }}</span>
                    trên tổng số
                    <span style="font-weight: bold;">{{ $products->total() }}</span>
                    sản phẩm
                </div>
                <div class="box-percent" style="flex: 1; margin: 0 24px;">
                    <div class="in-percent" style="height: 6px; background: #e0e0e0; border-radius: 3px; position: relative;">
                        <div style="height: 100%; background: #fcad02; border-radius: 3px; width: {{ $products->lastItem()/$products->total()*100 }}%; transition: width 0.3s;"></div>
                    </div>
                </div>
                <div class="buttom-load" style="min-width: 180px; display: flex; justify-content: flex-end;">
                    {{ $products->links('vendor.pagination.bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>

@endsection
