@extends('client.layout.client')

@section('title', 'Tin Tức')

@section('content')
    <div class="custom-banner-full">
        <div class="custom-banner">
            <div class="banner-image">
                <img src="{{ asset('client/picture/Living-room.jpg') }}" alt="Tin tức">
                <div class="banner-overlay">
                    <h1 class="banner-title">Tin Tức</h1>
                    <div class="banner-breadcrumb">Trang chủ &nbsp; > &nbsp; Tin tức</div>
                </div>
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
            <style>
                /* CSS banner */
                .custom-banner {
                    width: 100%;
                    position: relative;
                    overflow: hidden;
                    border-radius: 12px;
                    margin-bottom: 40px;
                }

                .banner-image {
                    position: relative;
                    width: 100%;
                    height: 360px;
                    overflow: hidden;
                }

                .banner-image img {
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                    transition: transform 0.5s ease;
                }

                .banner-image:hover img {
                    transform: scale(1.05);
                }

                .banner-overlay {
                    position: absolute;
                    top: 50%;
                    left: 50%;
                    transform: translate(-50%, -50%);
                    text-align: center;
                    color: #fff;
                    text-shadow: 0 2px 8px rgba(0, 0, 0, 0.6);
                }

                .banner-title {
                    font-size: 3rem;
                    font-weight: 800;
                    margin-bottom: 12px;
                    text-transform: uppercase;
                }

                .banner-breadcrumb {
                    font-size: 1rem;
                    font-weight: 400;
                }

                /* CSS nôi dung */
                .blog-grid {
                    display: grid;
                    grid-template-columns: repeat(3, 1fr);
                    gap: 32px;
                }

                .blog-card {
                    background: #fff;
                    border-radius: 14px;
                    box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
                    overflow: hidden;
                    display: flex;
                    flex-direction: column;
                    transition: box-shadow 0.2s;
                    height: 100%;
                }

                .blog-card:hover {
                    box-shadow: 0 4px 24px rgba(0, 0, 0, 0.12);
                }

                .blog-card-img-wrap {
                    width: 100%;
                    aspect-ratio: 4/3;
                    background: #eee;
                    overflow: hidden;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                }

                .blog-card-img-wrap img {
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                    display: block;
                }

                .blog-card-body {
                    padding: 18px 18px 14px 18px;
                    display: flex;
                    flex-direction: column;
                    flex: 1;
                }

                .blog-card-title {
                    font-size: 1.15rem;
                    font-weight: 700;
                    margin-bottom: 10px;
                    color: #222;
                    min-height: 48px;
                    line-height: 1.3;
                }

                .blog-card-meta {
                    color: #888;
                    font-size: 0.97rem;
                    margin-top: auto;
                }

                @media (max-width: 1200px) {
                    .blog-grid {
                        grid-template-columns: repeat(2, 1fr);
                    }
                }

                @media (max-width: 900px) {
                    .blog-grid {
                        grid-template-columns: 1fr;
                    }
                }
            </style>
            <div class="blog-grid">
                @forelse($posts as $post)
                    <div class="blog-card">
                        <a href="{{ route('client.page.show', $post->slug) }}" style="display:block; position:relative;">
                            <div class="blog-card-img-wrap" style="position:relative;">
                                @if ($post->published_at)
                                    <div class="blog-card-date">
                                        {{ $post->published_at->format('d') }}
                                        <span>{{ $post->published_at->format('m/Y') }}</span>
                                    </div>
                                @endif
                                <img src="{{ $post->featured_image_url ? asset('storage/' . $post->featured_image_url) : asset('client/Picture/Blog/default.jpg') }}"
                                    alt="{{ $post->meta_title }}">
                            </div>
                        </a>
                        <div class="blog-card-body" style="align-items: center; text-align: center;">
                            <div class="blog-card-title" style="margin-bottom: 12px;">
                                <a href="{{ route('client.page.show', $post->slug) }}"
                                    style="color:inherit; text-decoration:none; display: inline-block;">
                                    {{ $post->meta_title }}
                                </a>
                            </div>
                            <div class="blog-card-desc"
                                style="
                    color: #555;
                    font-size: 1rem;
                    margin-bottom: 14px;
                    display: -webkit-box;
                    -webkit-line-clamp: 2;
                    -webkit-box-orient: vertical;
                    overflow: hidden;
                    text-overflow: ellipsis;
                    min-height: 2.6em;
                    max-width: 95%;
                ">
                                {{ $post->meta_description }}
                            </div>
                        </div>
                    </div>
                @empty
                    <p>Không có bài viết nào.</p>
                @endforelse
            </div>
            <div class="mt-4 d-flex justify-content-center">
                {{ $posts->links('pagination::bootstrap-4') }}
            </div>

            <style>
                .blog-card-img-wrap {
                    width: 100%;
                    aspect-ratio: 4/3;
                    background: #eee;
                    overflow: hidden;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    border-radius: 16px 16px 0 0;
                    box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
                    position: relative;
                    transition: box-shadow 0.2s;
                }

                .blog-card-img-wrap img {
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                    display: block;
                    border-radius: 16px 16px 0 0;
                    transition: transform 0.3s;
                }

                .blog-card:hover .blog-card-img-wrap img {
                    transform: scale(1.04);
                    box-shadow: 0 6px 24px rgba(0, 0, 0, 0.13);
                }

                .blog-card-date {
                    position: absolute;
                    top: 14px;
                    left: 14px;
                    background: rgba(255, 255, 255, 0.92);
                    color: #222;
                    font-weight: 700;
                    font-size: 1.1rem;
                    padding: 7px 13px 4px 13px;
                    border-radius: 12px;
                    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.07);
                    text-align: center;
                    z-index: 2;
                    line-height: 1.1;
                    min-width: 48px;
                }

                .blog-card-date span {
                    display: block;
                    font-size: 0.85em;
                    font-weight: 400;
                    color: #888;
                    margin-top: 1px;
                }
            </style>

        </div>

    </div>


@endsection
