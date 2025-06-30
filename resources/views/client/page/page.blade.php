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
            <div class="row" style="display: flex; flex-wrap: wrap; gap: 30px;">
                @forelse($posts as $post)
                    <div class="blog-1" style="flex: 1 1 45%; max-width: 48%; box-sizing: border-box; margin-bottom: 30px;">
                        <a href="{{ route('client.page.show', $post->slug) }}">
                            <img src="{{ $post->featured_image_url ? asset('storage/' . $post->featured_image_url) : asset('client/Picture/Blog/default.jpg') }}"
                                alt="{{ $post->title }}" style="width:100%;height:350px;object-fit:cover;display:block;">
                        </a>
                        <div class="content-blog-1">
                            <div class="list-link">
                                {{-- Nếu có categories, foreach ở đây --}}
                            </div>
                            <div class="title">
                                <a href="{{ route('client.page.show', $post->slug) }}">{{ $post->title }}</a>
                            </div>
                            <div class="box-by">
                                <span>Bởi: {{ $post->author->name ?? 'N/A' }}</span>
                                <span>|</span>
                                <span>{{ $post->published_at ? $post->published_at->format('d/m/Y') : '' }}</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <p>Không có bài viết nào.</p>
                @endforelse
            </div>
        </div>
        {{-- <div class="mt-3">
            {{ $posts->links() }}
        </div> --}}
    </div>


@endsection
