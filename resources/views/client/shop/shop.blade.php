@extends('client.layout.client')

@section('title', 'Cửa Hàng')

@section('content')
    <div class="box-banner-shop">
        <div class="in-box-banner">
            <div class="text-title-banner">
                Cửa hàng
            </div>
            <div class="box-path">
                <div>
                    Trang chủ
                </div>
                <div class="icon">
                    <i class="fa-solid fa-angle-right"></i>
                </div>
                <div>
                    Cửa hàng
                </div>
            </div>
            <div class="box-list-product">
                <div class="box-shop-product">
                    <a href="">
                        <img src="{{ asset('client/picture/Shop/categories-19.jpg') }}" alt="">
                        <div class="name-product">
                            <p>Ghế bành</p>
                        </div>
                    </a>
                </div>
                <div class="box-shop-product">
                    <a href="">
                        <img src="{{ asset('client/picture/Shop/categories-18.jpg') }}" alt="">
                        <div class="name-product">
                            <p>Ngoài trời</p>
                        </div>
                    </a>
                </div>
                <div class="box-shop-product">
                    <a href="">
                        <img src="{{ asset('client/picture/Shop/categories-6.jpg') }}" alt="">
                        <div class="name-product">
                            <p>Sofa</p>
                        </div>
                    </a>
                </div>
                <div class="box-shop-product">
                    <a href="">
                        <img src="{{ asset('client/picture/Shop/categories-10.jpg') }}" alt="">
                        <div class="name-product">
                            <p>Lưu trữ</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="box-shop">
        <div class="box-sidebar">
            <div class="first-sidebar">
                <div class="title-sidebar">
                    Danh mục
                </div>
                <div class="in-sidebar">
                    <div class="name">Ghế bành</div>
                    <div class="box-number">1</div>
                </div>
                <div class="in-sidebar">
                    <div class="name">Phòng ngủ</div>
                    <div class="box-number">9</div>
                </div>
                <div class="in-sidebar">
                    <div class="name">Bóng đèn</div>
                    <div class="box-number">5</div>
                </div>
                <div class="in-sidebar">
                    <div class="name">Đèn chiếu sáng</div>
                    <div class="box-number">1</div>
                </div>
                <div class="in-sidebar">
                    <div class="name">Phòng khách</div>
                    <div class="box-number">6</div>
                </div>
                <div class="in-sidebar">
                    <div class="name">Ngoài trời</div>
                    <div class="box-number">9</div>
                </div>
                <div class="in-sidebar">
                    <div class="name">Sofa</div>
                    <div class="box-number">1</div>
                </div>
                <div class="in-sidebar">
                    <div class="name">Lưu trữ</div>
                    <div class="box-number">1</div>
                </div>
                <div class="in-sidebar">
                    <div class="name">Bàn</div>
                    <div class="box-number">1</div>
                </div>
            </div>
            <div class="box-price">
                <div class="price-title">Giá</div>
                <input type="range" name="" id="">
                <div class="box-range">
                    Khoảng giá:
                    <span>50.000đ</span>
                    <span>-</span>
                    <span>500.000đ</span>
                </div>
            </div>
            <div class="box-color">
                <div class="title-box-color">Màu sắc</div>
                <div class="list-color">
                    <ul>
                        <li>
                            <div class="color-name">
                                <div class="in-color" style="background-color: black;"></div>
                                <span class="name-color">Đen</span>
                            </div>
                            <div class="text-number">2</div>
                        </li>
                        <li>
                            <div class="color-name">
                                <div class="in-color" style="background-color: #445162;"></div>
                                <span class="name-color">Xanh dương</span>
                            </div>
                            <div class="text-number">2</div>
                        </li>
                        <li>
                            <div class="color-name">
                                <div class="in-color" style="background-color: #4B4E43;"></div>
                                <span class="name-color">Xanh lá</span>
                            </div>
                            <div class="text-number">1</div>
                        </li>
                        <li>
                            <div class="color-name">
                                <div class="in-color" style="background-color: #E7DDD1;"></div>
                                <span class="name-color">Kem</span>
                            </div>
                            <div class="text-number">1</div>
                        </li>
                        <li>
                            <div class="color-name">
                                <div class="in-color" style="background-color: #EF5050;"></div>
                                <span class="name-color">Đỏ</span>
                            </div>
                            <div class="text-number">1</div>
                        </li>
                        <li>
                            <div class="color-name">
                                <div class="in-color" style="background-color: #F9C9BF;"></div>
                                <span class="name-color">Hồng</span>
                            </div>
                            <div class="text-number">1</div>
                        </li>
                        <li>
                            <div class="color-name">
                                <div class="in-color" style="background-color: #DCA489;"></div>
                                <span class="name-color">Nâu nhạt</span>
                            </div>
                            <div class="text-number">1</div>
                        </li>
                        <li>
                            <div class="color-name">
                                <div class="in-color" style="background-color: #fff; border: 1px solid gray;"></div>
                                <span class="name-color">Trắng</span>
                            </div>
                            <div class="text-number">4</div>
                        </li>
                        <li>
                            <div class="color-name">
                                <div class="in-color" style="background-color: #C69A02;"></div>
                                <span class="name-color">Vàng</span>
                            </div>
                            <div class="text-number">2</div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="all-box-brands">
                <div class="title-brands">Thương hiệu</div>
                <div class="box-list-brands">
                    <div class="box-img-brands">
                        <a href="">
                            <img src="{{ asset('client/picture/Shop/brand-1-1.jpg') }}" alt="">
                        </a>
                    </div>
                    <div class="box-img-brands">
                        <a href="">
                            <img src="{{ asset('client/picture/Shop/brand-2-1.jpg') }}" alt="">
                        </a>
                    </div>
                    <div class="box-img-brands">
                        <a href="">
                            <img src="{{ asset('client/picture/Shop/brand-3-1.jpg') }}" alt="">
                        </a>
                    </div>
                    <div class="box-img-brands">
                        <a href="">
                            <img src="{{ asset('client/picture/Shop/brand-4-1.jpg') }}" alt="">
                        </a>
                    </div>
                </div>
            </div>
            <div class="box-feature-product">
                <div class="text-feature-product">Sản phẩm nổi bật</div>
                <div>
                    <div class="box-product-in">
                        <div class="picture-product-in">
                            <a href="">
                                <img src="{{ asset('client/picture/Shop/products-10-7.jpg') }}" alt="">
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
                                Bàn ăn tròn Theo
                            </div>
                            <div class="price-feature-prod">
                                <del>1.800.000đ</del>
                                <span>1.200.000đ</span>
                            </div>
                        </div>
                    </div>
                    <div class="box-product-in">
                        <div class="picture-product-in">
                            <a href="">
                                <img src="{{ asset('client/picture/Shop/products-4.jpg') }}" alt="">
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
                                Bàn ăn Egg
                            </div>
                            <div class="price-feature-prod">
                                <del>3.500.000đ</del>
                                <span>2.500.000đ</span>
                            </div>
                        </div>
                    </div>
                    <div class="box-product-in" style="border: none;">
                        <div class="picture-product-in">
                            <a href="">
                                <img src="{{ asset('client/picture/Shop/products-16-6.jpg') }}" alt="">
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
                                Bàn ăn T12 - Đen
                            </div>
                            <div class="price-feature-prod">
                                <del>12.000.000đ</del>
                                <span>10.000.000đ</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="box-all-product">
            <div class="header-product">
                <div class="show-item">
                    <div>Hiển thị 1–12 trên tổng 23 sản phẩm</div>
                </div>
                <select name="" id="box-all-list">
                    <option value="">Sắp xếp mặc định</option>
                    <option value="">Sắp xếp theo phổ biến</option>
                    <option value="">Sắp xếp theo đánh giá</option>
                    <option value="">Sắp xếp theo mới nhất</option>
                    <option value="">Sắp xếp theo giá: thấp đến cao</option>
                    <option value="">Sắp xếp theo giá: cao đến thấp</option>
                </select>
            </div>
            <div class="all-box-new-product">
                <div class="new-product-1">
                    <div class="pic-product-1">
                        <a href="">
                            <img id="Pic-product-1" src="{{ asset('client/picture/Shop/products-10-1-600x600.jpg') }}" alt="">
                            <script>
                                let newProduct = document.getElementById('Pic-product-1');
                                newProduct.addEventListener('mouseout', function() {
                                    newProduct.src = "{{ asset('client/picture/Shop/products-10-1-600x600.jpg') }}";
                                });
                                newProduct.addEventListener('mouseover', function() {
                                    newProduct.src = "{{ asset('client/picture/Shop/products-10-2-600x600.jpg') }}";
                                });
                            </script>
                            <div class="box-icon-new-product">
                                <i style="font-size: 19px;" id="cart-Product" class="fa-solid fa-cart-shopping"></i>
                                <i style="font-size: 18px;" id="heart-Product" class="fa-solid fa-heart"></i>
                                <i style="font-size: 18px;" id="search-Product" class="fa-solid fa-magnifying-glass"></i>
                            </div>
                        </a>
                    </div>
                    <div class="box-star" style="width: 100%; height: 23px;">
                        <i style="color: #fcad02; margin-left: 0;" class="fa-solid fa-star"></i>
                        <i style="color: #fcad02;" class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <span style="margin-left: 5px; color: rgb(201, 201, 201); font-size: 12px;">(1 review)</span>
                    </div>
                    <div class="title-new-product">
                        <a href="">About a Chair AAC 22 – Oak Base</a>
                    </div>
                    <div style="font-size: 16px; color: rgb(170, 167, 167);">
                        $250.0
                    </div>
                </div>
                <div class="new-product-1">
                    <div class="pic-product-1">
                        <a href="">
                            <img id="Pic-product-2" src="{{ asset('client/picture/Shop/products-15-6-600x600.jpg') }}" alt="">
                            <script>
                                let newProduct_1 = document.getElementById('Pic-product-2');
                                newProduct_1.addEventListener('mouseout', function() {
                                    newProduct_1.src = "{{ asset('client/picture/Shop/products-15-6-600x600.jpg') }}";
                                });
                                newProduct_1.addEventListener('mouseover', function() {
                                    newProduct_1.src = "{{ asset('client/picture/Shop/products-15-7-600x600.jpg') }}";
                                });
                            </script>
                            <div class="box-icon-new-product">
                                <i style="font-size: 19px;" id="cart-Product" class="fa-solid fa-cart-shopping"></i>
                                <i style="font-size: 18px;" id="heart-Product" class="fa-solid fa-heart"></i>
                                <i style="font-size: 18px;" id="search-Product" class="fa-solid fa-magnifying-glass"></i>
                            </div>
                        </a>
                    </div>
                    <div class="box-star" style="width: 100%; height: 23px;">
                        <i style="margin-left: 0;" class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <span style="margin-left: 5px; color: rgb(201, 201, 201); font-size: 12px;">(1 review)</span>
                    </div>
                    <div class="title-new-product">
                        <a href="">Bell Chair – Set of 4</a>
                    </div>
                    <div style="font-size: 16px; color: rgb(170, 167, 167);">
                        $400.00 – $410.00
                    </div>
                </div>
                <div class="new-product-1">
                    <div class="pic-product-1">
                        <a href="">
                            <img id="Pic-product-3" src="{{ asset('client/picture/Shop/products-13-600x600.jpg') }}" alt="">
                            <script>
                                let newProduct_2 = document.getElementById('Pic-product-3');
                                newProduct_2.addEventListener('mouseout', function() {
                                    newProduct_2.src = "{{ asset('client/picture/Shop/products-13-600x600.jpg') }}";
                                });
                                newProduct_2.addEventListener('mouseover', function() {
                                    newProduct_2.src = "{{ asset('client/picture/Shop/products-13-1-600x600.jpg') }}";
                                });
                            </script>
                            <div class="box-icon-new-product">
                                <i style="font-size: 19px;" id="cart-Product" class="fa-solid fa-cart-shopping"></i>
                                <i style="font-size: 18px;" id="heart-Product" class="fa-solid fa-heart"></i>
                                <i style="font-size: 18px;" id="search-Product" class="fa-solid fa-magnifying-glass"></i>
                            </div>
                        </a>
                    </div>
                    <div class="box-star" style="width: 100%; height: 23px;">
                        <i style="margin-left: 0;" class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <span style="margin-left: 5px; color: rgb(201, 201, 201); font-size: 12px;">(0 review)</span>
                    </div>
                    <div class="title-new-product">
                        <a href="">Bond Shelving – Ceiling Mounted</a>
                    </div>
                    <div style="font-size: 16px; color: rgb(170, 167, 167);">
                        $214.22
                    </div>
                </div>
                <div class="new-product-1">
                    <div class="pic-product-1">
                        <a href="">
                            <img id="Pic-product-4" src="{{ asset('client/picture/Shop/products-17-6-600x600.jpg') }}" alt="">
                            <script>
                                let newProduct_3 = document.getElementById('Pic-product-4');
                                newProduct_3.addEventListener('mouseout', function() {
                                    newProduct_3.src = "{{ asset('client/picture/Shop/products-17-6-600x600.jpg') }}";
                                });
                                newProduct_3.addEventListener('mouseover', function() {
                                    newProduct_3.src = "{{ asset('client/picture/Shop/products-17-7-600x600.jpg') }}";
                                });
                            </script>
                            <div class="box-icon-new-product">
                                <i style="font-size: 19px;" id="cart-Product" class="fa-solid fa-cart-shopping"></i>
                                <i style="font-size: 18px;" id="heart-Product" class="fa-solid fa-heart"></i>
                                <i style="font-size: 18px;" id="search-Product" class="fa-solid fa-magnifying-glass"></i>
                            </div>
                        </a>
                    </div>
                    <div class="box-star" style="width: 100%; height: 23px;">
                        <i style="margin-left: 0;" class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <span style="margin-left: 5px; color: rgb(201, 201, 201); font-size: 12px;">(0 review)</span>
                    </div>
                    <div class="title-new-product">
                        <a href="">Caravaggio Read Wall Light</a>
                    </div>
                    <div style="font-size: 16px; color: rgb(170, 167, 167);">
                        <del>$400.00</del>
                        <span style="color: red;">$350.00</span>
                    </div>
                </div>
                <div class="new-product-1">
                    <div class="pic-product-1">
                        <a href="">
                            <img id="Pic-product-5" src="{{ asset('client/picture/Shop/products-17-2-600x600.jpg') }}" alt="">
                            <script>
                                let newProduct_4 = document.getElementById('Pic-product-5');
                                newProduct_4.addEventListener('mouseout', function() {
                                    newProduct_4.src = "{{ asset('client/picture/Shop/products-17-2-600x600.jpg') }}";
                                });
                                newProduct_4.addEventListener('mouseover', function() {
                                    newProduct_4.src = "{{ asset('client/picture/Shop/products-17-3-600x600.jpg') }}";
                                });
                            </script>
                            <div class="box-icon-new-product">
                                <i style="font-size: 19px;" id="cart-Product" class="fa-solid fa-cart-shopping"></i>
                                <i style="font-size: 18px;" id="heart-Product" class="fa-solid fa-heart"></i>
                                <i style="font-size: 18px;" id="search-Product" class="fa-solid fa-magnifying-glass"></i>
                            </div>
                        </a>
                    </div>
                    <div class="box-star" style="width: 100%; height: 23px;">
                        <i style="margin-left: 0;" class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <span style="margin-left: 5px; color: rgb(201, 201, 201); font-size: 12px;">(0 review)</span>
                    </div>
                    <div class="title-new-product">
                        <a href="">CH07 Shell Chair – Leather</a>
                    </div>
                    <div style="font-size: 16px; color: rgb(170, 167, 167);">
                        <del>$200.00</del>
                        <span style="color: red;">$180.00</span>
                    </div>
                </div>
                <div class="new-product-1">
                    <div class="pic-product-1">
                        <a href="">
                            <img id="Pic-product-6" src="{{ asset('client/picture/Shop/products-10-4-600x600.jpg') }}" alt="">
                            <script>
                                let newProduct_5 = document.getElementById('Pic-product-6');
                                newProduct_5.addEventListener('mouseout', function() {
                                    newProduct_5.src = "{{ asset('client/picture/Shop/products-10-4-600x600.jpg') }}";
                                });
                                newProduct_5.addEventListener('mouseover', function() {
                                    newProduct_5.src = "{{ asset('client/picture/Shop/products-10-5-600x600.jpg') }}";
                                });
                            </script>
                            <div class="box-icon-new-product">
                                <i style="font-size: 19px;" id="cart-Product" class="fa-solid fa-cart-shopping"></i>
                                <i style="font-size: 18px;" id="heart-Product" class="fa-solid fa-heart"></i>
                                <i style="font-size: 18px;" id="search-Product" class="fa-solid fa-magnifying-glass"></i>
                            </div>
                        </a>
                    </div>
                    <div class="box-star" style="width: 100%; height: 23px;">
                        <i style="color: #fcad02; margin-left: 0;" class="fa-solid fa-star"></i>
                        <i style="color: #fcad02;" class="fa-solid fa-star"></i>
                        <i style="color: #fcad02;" class="fa-solid fa-star"></i>
                        <i style="color: #fcad02;" class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <span style="margin-left: 5px; color: rgb(201, 201, 201); font-size: 12px;">(0 review)</span>
                    </div>
                    <div class="title-new-product">
                        <a href="">CH24 Wishbone Chair – Soft</a>
                    </div>
                    <div style="font-size: 16px; color: rgb(170, 167, 167);">
                        <del>$150.00</del>
                        <span style="color: red;">$90.00</span>
                    </div>
                </div>
                <div class="new-product-1">
                    <div class="pic-product-1">
                        <a href="">
                            <img id="Pic-product-7" src="{{ asset('client/picture/Shop/products-10-1-600x600.jpg') }}" alt="">
                            <script>
                                let newProduct_12 = document.getElementById('Pic-product-7');
                                newProduct_12.addEventListener('mouseout', function() {
                                    newProduct_12.src = "{{ asset('client/picture/Shop/products-10-1-600x600.jpg') }}";
                                });
                                newProduct_12.addEventListener('mouseover', function() {
                                    newProduct_12.src = "{{ asset('client/picture/Shop/products-10-2-600x600.jpg') }}";
                                });
                            </script>
                            <div class="box-icon-new-product">
                                <i style="font-size: 19px;" id="cart-Product" class="fa-solid fa-cart-shopping"></i>
                                <i style="font-size: 18px;" id="heart-Product" class="fa-solid fa-heart"></i>
                                <i style="font-size: 18px;" id="search-Product" class="fa-solid fa-magnifying-glass"></i>
                            </div>
                        </a>
                    </div>
                    <div class="box-star" style="width: 100%; height: 23px;">
                        <i style="color: #fcad02; margin-left: 0;" class="fa-solid fa-star"></i>
                        <i style="color: #fcad02;" class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <span style="margin-left: 5px; color: rgb(201, 201, 201); font-size: 12px;">(1 review)</span>
                    </div>
                    <div class="title-new-product">
                        <a href="">About a Chair AAC 22 – Oak Base</a>
                    </div>
                    <div style="font-size: 16px; color: rgb(170, 167, 167);">
                        $250.0
                    </div>
                </div>
                <div class="new-product-1">
                    <div class="pic-product-1">
                        <a href="">
                            <img id="Pic-product-8" src="{{ asset('client/picture/Shop/products-15-6-600x600.jpg') }}" alt="">
                            <script>
                                let newProduct_13 = document.getElementById('Pic-product-8');
                                newProduct_13.addEventListener('mouseout', function() {
                                    newProduct_13.src = "{{ asset('client/picture/Shop/products-15-6-600x600.jpg') }}";
                                });
                                newProduct_13.addEventListener('mouseover', function() {
                                    newProduct_13.src = "{{ asset('client/picture/Shop/products-15-7-600x600.jpg') }}";
                                });
                            </script>
                            <div class="box-icon-new-product">
                                <i style="font-size: 19px;" id="cart-Product" class="fa-solid fa-cart-shopping"></i>
                                <i style="font-size: 18px;" id="heart-Product" class="fa-solid fa-heart"></i>
                                <i style="font-size: 18px;" id="search-Product" class="fa-solid fa-magnifying-glass"></i>
                            </div>
                        </a>
                    </div>
                    <div class="box-star" style="width: 100%; height: 23px;">
                        <i style="margin-left: 0;" class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <span style="margin-left: 5px; color: rgb(201, 201, 201); font-size: 12px;">(1 review)</span>
                    </div>
                    <div class="title-new-product">
                        <a href="">Bell Chair – Set of 4</a>
                    </div>
                    <div style="font-size: 16px; color: rgb(170, 167, 167);">
                        $400.00 – $410.00
                    </div>
                </div>
                <div class="new-product-1">
                    <div class="pic-product-1">
                        <a href="">
                            <img id="Pic-product-9" src="{{ asset('client/picture/Shop/products-13-600x600.jpg') }}" alt="">
                            <script>
                                let newProduct_14 = document.getElementById('Pic-product-9');
                                newProduct_14.addEventListener('mouseout', function() {
                                    newProduct_14.src = "{{ asset('client/picture/Shop/products-13-600x600.jpg') }}";
                                });
                                newProduct_14.addEventListener('mouseover', function() {
                                    newProduct_14.src = "{{ asset('client/picture/Shop/products-13-1-600x600.jpg') }}";
                                });
                            </script>
                            <div class="box-icon-new-product">
                                <i style="font-size: 19px;" id="cart-Product" class="fa-solid fa-cart-shopping"></i>
                                <i style="font-size: 18px;" id="heart-Product" class="fa-solid fa-heart"></i>
                                <i style="font-size: 18px;" id="search-Product" class="fa-solid fa-magnifying-glass"></i>
                            </div>
                        </a>
                    </div>
                    <div class="box-star" style="width: 100%; height: 23px;">
                        <i style="margin-left: 0;" class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <span style="margin-left: 5px; color: rgb(201, 201, 201); font-size: 12px;">(0 review)</span>
                    </div>
                    <div class="title-new-product">
                        <a href="">Bond Shelving – Ceiling Mounted</a>
                    </div>
                    <div style="font-size: 16px; color: rgb(170, 167, 167);">
                        $214.22
                    </div>
                </div>
                <div class="new-product-1">
                    <div class="pic-product-1">
                        <a href="">
                            <img id="Pic-product-10" src="{{ asset('client/picture/Shop/products-17-6-600x600.jpg') }}" alt="">
                            <script>
                                let newProduct_15 = document.getElementById('Pic-product-10');
                                newProduct_15.addEventListener('mouseout', function() {
                                    newProduct_15.src = "{{ asset('client/picture/Shop/products-17-6-600x600.jpg') }}";
                                });
                                newProduct_15.addEventListener('mouseover', function() {
                                    newProduct_15.src = "{{ asset('client/picture/Shop/products-17-7-600x600.jpg') }}";
                                });
                            </script>
                            <div class="box-icon-new-product">
                                <i style="font-size: 19px;" id="cart-Product" class="fa-solid fa-cart-shopping"></i>
                                <i style="font-size: 18px;" id="heart-Product" class="fa-solid fa-heart"></i>
                                <i style="font-size: 18px;" id="search-Product" class="fa-solid fa-magnifying-glass"></i>
                            </div>
                        </a>
                    </div>
                    <div class="box-star" style="width: 100%; height: 23px;">
                        <i style="margin-left: 0;" class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <span style="margin-left: 5px; color: rgb(201, 201, 201); font-size: 12px;">(0 review)</span>
                    </div>
                    <div class="title-new-product">
                        <a href="">Caravaggio Read Wall Light</a>
                    </div>
                    <div style="font-size: 16px; color: rgb(170, 167, 167);">
                        <del>$400.00</del>
                        <span style="color: red;">$350.00</span>
                    </div>
                </div>
                <div class="new-product-1">
                    <div class="pic-product-1">
                        <a href="">
                            <img id="Pic-product-11" src="{{ asset('client/picture/Shop/products-17-2-600x600.jpg') }}" alt="">
                            <script>
                                let newProduct_16 = document.getElementById('Pic-product-11');
                                newProduct_16.addEventListener('mouseout', function() {
                                    newProduct_16.src = "{{ asset('client/picture/Shop/products-17-2-600x600.jpg') }}";
                                });
                                newProduct_16.addEventListener('mouseover', function() {
                                    newProduct_16.src = "{{ asset('client/picture/Shop/products-17-3-600x600.jpg') }}";
                                });
                            </script>
                            <div class="box-icon-new-product">
                                <i style="font-size: 19px;" id="cart-Product" class="fa-solid fa-cart-shopping"></i>
                                <i style="font-size: 18px;" id="heart-Product" class="fa-solid fa-heart"></i>
                                <i style="font-size: 18px;" id="search-Product" class="fa-solid fa-magnifying-glass"></i>
                            </div>
                        </a>
                    </div>
                    <div class="box-star" style="width: 100%; height: 23px;">
                        <i style="margin-left: 0;" class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <span style="margin-left: 5px; color: rgb(201, 201, 201); font-size: 12px;">(0 review)</span>
                    </div>
                    <div class="title-new-product">
                        <a href="">CH07 Shell Chair – Leather</a>
                    </div>
                    <div style="font-size: 16px; color: rgb(170, 167, 167);">
                        <del>$200.00</del>
                        <span style="color: red;">$180.00</span>
                    </div>
                </div>
                <div class="new-product-1">
                    <div class="pic-product-1">
                        <a href="">
                            <img id="Pic-product-12" src="{{ asset('client/picture/Shop/products-10-4-600x600.jpg') }}" alt="">
                            <script>
                                let newProduct_17 = document.getElementById('Pic-product-12');
                                newProduct_17.addEventListener('mouseout', function() {
                                    newProduct_17.src = "{{ asset('client/picture/Shop/products-10-4-600x600.jpg') }}";
                                });
                                newProduct_17.addEventListener('mouseover', function() {
                                    newProduct_17.src = "{{ asset('client/picture/Shop/products-10-5-600x600.jpg') }}";
                                });
                            </script>
                            <div class="box-icon-new-product">
                                <i style="font-size: 19px;" id="cart-Product" class="fa-solid fa-cart-shopping"></i>
                                <i style="font-size: 18px;" id="heart-Product" class="fa-solid fa-heart"></i>
                                <i style="font-size: 18px;" id="search-Product" class="fa-solid fa-magnifying-glass"></i>
                            </div>
                        </a>
                    </div>
                    <div class="box-star" style="width: 100%; height: 23px;">
                        <i style="color: #fcad02; margin-left: 0;" class="fa-solid fa-star"></i>
                        <i style="color: #fcad02;" class="fa-solid fa-star"></i>
                        <i style="color: #fcad02;" class="fa-solid fa-star"></i>
                        <i style="color: #fcad02;" class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <span style="margin-left: 5px; color: rgb(201, 201, 201); font-size: 12px;">(0 review)</span>
                    </div>
                    <div class="title-new-product">
                        <a href="">CH24 Wishbone Chair – Soft</a>
                    </div>
                    <div style="font-size: 16px; color: rgb(170, 167, 167);">
                        <del>$150.00</del>
                        <span style="color: red;">$90.00</span>
                    </div>
                </div>
            </div>
            <div class="box-footer-product">
                <div class="title-footer-product">
                    Hiển thị 1–12 trên tổng 23 sản phẩm
                </div>
                <div class="box-percent">
                    <div class="in-percent"></div>
                </div>
                <div class="buttom-load">
                    <button>Tải thêm</button>
                </div>
            </div>
        </div>
    </div>
@endsection
