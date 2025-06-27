@extends('client.layout.client')

@section('title', 'Tin Tức')

@section('content')
    <div class="box-banner-about" style="background-position: 50%;">
        <div class="in-banner-about">
            <div class="title-banner">Tin Tức</div>
            <div class="box-path-about">
                <div>Trang chủ</div>
                <div class="icon">
                    <i class="fa-solid fa-angle-right"></i>
                </div>
                <div>Tin Tức</div>
            </div>
        </div>
    </div>
    <div class="container">
        {{-- <div class="all-box-sidebar">
            <div class="box-search">
                <h3>Tìm kiếm</h3>
                <div class="from-search">
                    <input type="text" placeholder="Tìm kiếm...">
                    <button>
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
            </div>
            <div class="box-categories">
                <h3>Danh mục</h3>
                <div class="in-categories">
                    <i class="fa-solid fa-angle-right"></i>
                    <a href="">
                        <div>Ba lô (8)</div>
                    </a>
                </div>
                <div class="in-categories" style="padding-top: 5px;">
                    <i class="fa-solid fa-angle-right"></i>
                    <a href="">
                        <div>Thời trang (4)</div>
                    </a>
                </div>
                <div class="in-categories" style="padding-top: 5px;">
                    <i class="fa-solid fa-angle-right"></i>
                    <a href="">
                        <div>Phong cách sống (4)</div>
                    </a>
                </div>
                <div class="in-categories" style="padding-top: 5px;">
                    <i class="fa-solid fa-angle-right"></i>
                    <a href="">
                        <div>Quần short (5)</div>
                    </a>
                </div>
                <div class="in-categories" style="padding: 5px 0 0 0;">
                    <i class="fa-solid fa-angle-right"></i>
                    <a href="">
                        <div>Đồ bơi (4)</div>
                    </a>
                </div>
            </div>
            <div class="box-recent">
                <h3>Bài viết mới</h3>
                <div class="in-recent">
                    <div class="in-content-recent">
                        <img src="{{ asset('client/Picture/Blog/Blog_01-500x500.jpg') }}" alt="">
                        <div class="box-text-recent">
                            <div>30/05/2018</div>
                            <a href="">Những mẹo đơn giản cho trang trí nhà cửa</a>
                        </div>
                    </div>
                    <div class="in-content-recent">
                        <img src="{{ asset('client/Picture/Blog/Blog_02-500x500.jpg') }}" alt="">
                        <div class="box-text-recent">
                            <div>30/05/2018</div>
                            <a href="">Cách biến ngôi nhà của bạn thành nơi đáng sống</a>
                        </div>
                    </div>
                    <div class="in-content-recent" style="border-bottom: none;">
                        <img src="{{ asset('client/Picture/Blog/Blog_03-500x500.jpg') }}" alt="">
                        <div class="box-text-recent">
                            <div>30/05/2018</div>
                            <a href="">Nội thất ấn tượng với vẻ đẹp thẩm mỹ</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-categories">
                <h3>Lưu trữ</h3>
                <div class="in-categories">
                    <i class="fa-solid fa-angle-right"></i>
                    <a href="">
                        <div>Tháng 5 2018</div>
                    </a>
                </div>
                <div class="in-categories" style="padding-top: 5px;">
                    <i class="fa-solid fa-angle-right"></i>
                    <a href="">
                        <div>Tháng 4 2017</div>
                    </a>
                </div>
            </div>
            <div class="box-tags">
                <h3>Thẻ</h3>
                <div class="in-tag-1">
                    <a href="" class="tag-1">Cạo râu</a>
                    <a href="" class="tag-1">Đồ cho bé</a>
                    <a href="" class="tag-1">Làm đẹp</a>
                    <a href="" class="tag-1">Mỹ phẩm</a>
                    <a href="" class="tag-1">Chăm sóc tai</a>
                    <a href="" class="tag-1">Điện tử</a>
                    <a href="" class="tag-1">Thời trang</a>
                    <a href="" class="tag-1">Thực phẩm</a>
                    <a href="" class="tag-1">Trang sức</a>
                    <a href="" class="tag-1">Y tế</a>
                    <a href="" class="tag-1">Tối giản</a>
                    <a href="" class="tag-1">Hữu cơ</a>
                    <a href="" class="tag-1">Đơn giản</a>
                    <a href="" class="tag-1">Thể thao</a>
                </div>
            </div>
        </div> --}}
        <div class="box-content-blog">
            <div class="blog-1">
                <a href="">
                    <img src="{{ asset('client/Picture/Blog/Blog_01.jpg') }}" alt="">
                </a>
                <div class="content-blog-1">
                    <div class="list-link">
                        <a href="">Ba lô</a>
                        <span>,</span>
                        <a href="">Thời trang</a>
                        <span>,</span>
                        <a href="">Phong cách sống</a>
                    </div>
                    <div class="title">
                        <a href="">Giải pháp đơn giản cho trang trí nhà cửa</a>
                    </div>
                    <div class="box-by">
                        <span>Bởi: Wpbingo</span>
                        <span>|</span>
                        <span>4 Bình luận</span>
                    </div>
                </div>
            </div>
            <div class="blog-2">
                <div class="box-1 pading-img-1">
                    <img src="{{ asset('client/Picture/Blog/Blog_02.jpg') }}" alt="">
                    <div class="content-box-1">
                        <div class="first-content">
                            <a href="">Ba lô</a>
                            <span>,</span>
                            <a href="">Thời trang</a>
                            <span>,</span>
                            <a href="">Phong cách sống</a>
                        </div>
                        <div class="second-content">
                            <a href="">Cách biến ngôi nhà của bạn thành nơi đáng sống</a>
                        </div>
                        <div class="three-content">
                            <span>Bởi: Wpbingo</span>
                            <span>|</span>
                            <span>1 Bình luận</span>
                        </div>
                    </div>
                </div>
                <div class="box-1 pading-img-2">
                    <img src="{{ asset('client/Picture/Blog/Blog_03.jpg') }}" alt="">
                    <div class="content-box-1">
                        <div class="first-content">
                            <a href="">Ba lô</a>
                            <span>,</span>
                            <a href="">Thời trang</a>
                            <span>,</span>
                            <a href="">Phong cách sống</a>
                        </div>
                        <div class="second-content">
                            <a href="">Nội thất ấn tượng với vẻ đẹp thẩm mỹ</a>
                        </div>
                        <div class="three-content">
                            <span>Bởi: Wpbingo</span>
                            <span>|</span>
                            <span>1 Bình luận</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="blog-1">
                <a href="">
                    <img src="{{ asset('client/Picture/Blog/Blog_04.jpg') }}" alt="">
                </a>
                <div class="content-blog-1">
                    <div class="list-link">
                        <a href="">Ba lô</a>
                        <span>,</span>
                        <a href="">Thời trang</a>
                        <span>,</span>
                        <a href="">Phong cách sống</a>
                        <span>,</span>
                        <a href="">Đồ bơi</a>
                    </div>
                    <div class="title">
                        <a href="">Cách chọn ghế sofa phù hợp</a>
                    </div>
                    <div class="box-by">
                        <span>Bởi: Wpbingo</span>
                        <span>|</span>
                        <span>0 Bình luận</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
