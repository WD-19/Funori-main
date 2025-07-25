{{-- filepath: resources/views/client/page/show.blade.php --}}
@extends('client.layout.client')

@section('title', $post->title)

@section('content')
    <style>
        .inspiration-article-bg {
            background: #f5f6fa;
            min-height: 100vh;
            padding: 40px 0;
        }

        .inspiration-article-container {
            width: 75%;
            max-width: 1300px;
            margin: 0 auto;
        }

        .inspiration-article-title {
            font-size: 2.4rem;
            font-weight: 800;
            text-align: center;
            margin-bottom: 18px;
            color: #222;
            line-height: 1.2;
        }

        .inspiration-article-image {
            margin-bottom: 32px;
            width: 100%;
        }

        .inspiration-article-image img {
            width: 100%;
            max-width: 100%;
            height: auto;
            box-shadow: none;
            object-fit: contain;
            background: #eee;
            display: block;
            margin: 0 auto;
        }

        .inspiration-article-content {
            font-size: 1.15rem;
            color: #333;
            line-height: 1.8;
            text-align: justify;
            margin-bottom: 0;
            overflow: hidden;
            /* Ngăn nội dung tràn */
        }

        .inspiration-article-content img {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 0 auto 20px auto;
        }

        .inspiration-article-content img[align="left"],
        .inspiration-article-content img[data-mce-style*="float: left"] {
            float: left;
            margin-right: 20px;
            margin-bottom: 10px;
            max-width: 40%;
            /* Giảm xuống để tránh tràn */
            clear: both;
        }

        .inspiration-article-content img[align="right"],
        .inspiration-article-content img[data-mce-style*="float: right"] {
            float: right;
            margin-left: 20px;
            margin-bottom: 10px;
            max-width: 40%;
            /* Giảm xuống để tránh tràn */
            clear: both;
        }

        /* Improved Related Section Styles */
        .related-section {
            margin: 60px auto 0 auto;
            max-width: 1300px;
            background: #fff;
            padding: 40px 30px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
            border-radius: 12px;
        }

        .related-section-title {
            font-size: 1.6rem;
            font-weight: 700;
            margin-bottom: 30px;
            color: #222;
            text-align: center;
            position: relative;
            padding-bottom: 15px;
        }

        .related-section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 3px;
            background: linear-gradient(90deg, #ff6200, #ff8c00); /* Đổi màu xanh thành cam vàng */
            border-radius: 2px;
        }

        .related-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 30px;
            margin-bottom: 40px;
        }

        .related-card {
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 6px 24px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            position: relative;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .related-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
        }

        .related-card a {
            text-decoration: none;
            color: inherit;
            display: block;
        }

        .related-card-image {
            width: 100%;
            height: 180px;
            overflow: hidden;
            position: relative;
        }

        .related-card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .related-card:hover .related-card-image img {
            transform: scale(1.08);
        }

        .related-card-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to bottom, transparent 0%, rgba(0, 0, 0, 0.1) 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .related-card:hover .related-card-overlay {
            opacity: 1;
        }

        .related-card-content {
            padding: 20px;
            background: #fff;
        }

        .related-card-title {
            font-weight: 600;
            font-size: 1.1rem;
            line-height: 1.4;
            margin-bottom: 12px;
            color: #222;
            height: 50px;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }

        .related-card:hover .related-card-title {
            color: #ff6200; /* Đổi màu hover từ xanh (#0066cc) thành cam (#ff6200) */
        }

        .related-card-desc {
            font-size: 0.95rem;
            color: #666;
            line-height: 1.5;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            height: 42px;
        }

        .related-card-price {
            font-size: 1.1rem;
            color: red; /* Đổi màu giá tiền thành đỏ */
            font-weight: 500;
            margin-top: 8px;
        }

        /* Product specific styles */
        .product-card .related-card-content {
            padding: 20px;
            text-align: center;
        }

        .product-badge {
            position: absolute;
            top: 12px;
            right: 12px;
            background: rgba(255, 98, 0, 0.9); /* Đổi màu badge từ xanh thành cam */
            color: white;
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 0.8rem;
            font-weight: 600;
            backdrop-filter: blur(10px);
            z-index: 2;
        }

        .view-more-btn {
            display: inline-block;
            background: linear-gradient(135deg, #ff6200, #ff8c00); /* Đổi màu nút từ xanh thành cam vàng */
            color: white;
            padding: 12px 32px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(255, 98, 0, 0.3); /* Đổi shadow thành cam */
        }

        .view-more-btn:hover {
            background: linear-gradient(135deg, #ff8c00, #ff6200); /* Đổi màu hover nút thành cam vàng */
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(255, 98, 0, 0.4); /* Đổi shadow hover thành cam */
            color: white;
            text-decoration: none;
        }

        .view-more-container {
            text-align: center;
            margin-top: 30px;
        }

        @media (max-width: 1200px) {
            .related-grid {
                grid-template-columns: repeat(3, 1fr);
                gap: 25px;
            }
        }

        @media (max-width: 900px) {
            .inspiration-article-container {
                width: 98%;
            }

            .inspiration-article-title {
                font-size: 1.4rem;
            }

            .inspiration-article-image img {
                width: 100%;
                height: auto;
            }

            .inspiration-article-content img[align="left"],
            .inspiration-article-content img[align="right"],
            .inspiration-article-content img[data-mce-style*="float: left"],
            .inspiration-article-content img[data-mce-style*="float: right"] {
                float: none;
                max-width: 100%;
                margin: 0 auto 20px auto;
            }

            .related-section {
                margin: 40px auto 0 auto;
                padding: 30px 20px;
            }

            .related-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 20px;
            }

            .related-section-title {
                font-size: 1.4rem;
            }
        }

        @media (max-width: 600px) {
            .related-grid {
                grid-template-columns: 1fr;
            }

            .related-card-image {
                height: 200px;
            }
        }
    </style>
    
    <div class="inspiration-article-bg">
        <div class="inspiration-article-container">
            @if ($post->featured_image_url)
                <div class="inspiration-article-image">
                    <img src="{{ asset('storage/' . $post->featured_image_url) }}" alt="{{ $post->title }}">
                </div>
            @endif
            <h1 class="inspiration-article-title">{{ $post->title }}</h1>
            <div class="inspiration-article-content">
                {!! str_replace('/admin/storage', '/storage', $post->content) !!}
            </div>
        </div>
    </div>

    @if ($otherPosts->count())
        <div class="related-section">
            <h2 class="related-section-title">Các bài viết khác</h2>
            <div class="related-grid">
                @foreach ($otherPosts as $item)
                    <article class="related-card">
                        <a href="{{ route('client.page.show', $item->slug) }}">
                            <div class="related-card-image">
                                <img src="{{ $item->featured_image_url ? asset('storage/' . $item->featured_image_url) : asset('client/Picture/Blog/default.jpg') }}"
                                    alt="{{ $item->meta_title }}">
                                <div class="related-card-overlay"></div>
                            </div>
                            <div class="related-card-content">
                                <h3 class="related-card-title">{{ $item->meta_title }}</h3>
                                <p class="related-card-desc">{{ $item->meta_description }}</p>
                            </div>
                        </a>
                    </article>
                @endforeach
            </div>
            <div class="view-more-container">
                <a href="{{ route('client.page') }}" class="view-more-btn">
                    <i class="fas fa-plus-circle" style="margin-right: 8px;"></i>
                    Xem thêm bài viết
                </a>
            </div>
        </div>
    @endif

    @if ($suggestedProducts->count())
        <div class="related-section">
            <h2 class="related-section-title">Các sản phẩm bạn có thể thích</h2>
            <div class="related-grid">
                @foreach ($suggestedProducts as $product)
                    <article class="related-card product-card">
                        <a href="{{ route('client.product.show', $product->slug) }}">
                            <div class="related-card-image">
                                <img src="{{ $product->images->first() ? asset($product->images->first()->image_url) : asset('images/no-image.png') }}"
                                    alt="{{ $product->name }}">
                                <div class="related-card-overlay"></div>
                                <div class="product-badge">Sản phẩm</div>
                            </div>
                            <div class="related-card-content">
                                <h3 class="related-card-title">{{ $product->name }}</h3>
                                <div class="related-card-price">
                                    {{ number_format($product->regular_price, 0, ',', '.') }} đ
                                </div>
                            </div>
                        </a>
                    </article>
                @endforeach
            </div>
            <div class="view-more-container">
                <a href="{{ route('shop') }}" class="view-more-btn">
                    <i class="fas fa-shopping-bag" style="margin-right: 8px;"></i>
                    Xem thêm sản phẩm
                </a>
            </div>
        </div>
    @endif
@endsection