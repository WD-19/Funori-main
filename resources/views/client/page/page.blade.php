@extends('client.layout.client')

@section('title', 'Tin Tức')

@section('content')
    <div class="tf-page-title mb-5">
        <div class="container-full">
            <div class="heading text-center">@yield('page_title', 'Tin Tức')</div>
        </div>
    </div>
    <div class="container-fluid" style="width: 90%; max-width: none; padding: 0 20px;"> <!-- 90% width, no padding constraints -->
        <div class="box-content-blog">
            <style>
                /* Banner */
                .custom-banner {
                    width: 100%;
                    position: relative;
                    overflow: hidden;
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

                .banner-breadcrumb {
                    font-size: 1rem;
                    font-weight: 400;
                }

                /* CSS nội dung - 90% width, không bo góc */
                .blog-grid {
                    display: grid;
                    grid-template-columns: repeat(3, 1fr);
                    gap: 40px; /* Tăng gap */
                    width: 100%;
                    margin: 0 auto;
                }

                .blog-card {
                    background: #fff;
                    border-radius: 0; /* Bỏ bo góc */
                    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08); /* Tăng shadow */
                    overflow: hidden;
                    display: flex;
                    flex-direction: column;
                    transition: all 0.3s ease;
                    height: 100%;
                    min-height: 480px; /* Tăng chiều cao tối thiểu */
                }

                .blog-card:hover {
                    box-shadow: 0 8px 40px rgba(0, 0, 0, 0.15);
                    transform: translateY(-8px);
                }

                .blog-card-img-wrap {
                    width: 100%;
                    aspect-ratio: 16/10; /* Tăng tỷ lệ chiều cao */
                    background: #eee;
                    overflow: hidden;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    position: relative;
                    transition: all 0.3s ease;
                }

                .blog-card-img-wrap img {
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                    display: block;
                    transition: transform 0.4s ease;
                }

                .blog-card:hover .blog-card-img-wrap img {
                    transform: scale(1.06);
                }

                .blog-card-body {
                    padding: 28px 24px 24px 24px; /* Tăng padding */
                    display: flex;
                    flex-direction: column;
                    flex: 1;
                }

                .blog-card-title {
                    font-size: 1.4rem; /* Tăng font size */
                    font-weight: 700;
                    margin-bottom: 16px; /* Tăng margin */
                    color: #222;
                    min-height: 60px; /* Tăng min-height */
                    line-height: 1.35;
                }

                .blog-card-title a:hover {
                    color: #0066cc;
                    transition: color 0.3s ease;
                }

                .blog-card-desc {
                    color: #555;
                    font-size: 1.1rem; /* Tăng font size */
                    line-height: 1.6;
                    margin-bottom: 18px;
                    display: -webkit-box;
                    -webkit-line-clamp: 3; /* Tăng số dòng hiển thị */
                    -webkit-box-orient: vertical;
                    overflow: hidden;
                    text-overflow: ellipsis;
                    min-height: 5.2em; /* Tăng min-height */
                    max-width: 100%;
                }

                .blog-card-meta {
                    color: #888;
                    font-size: 1rem; /* Tăng font size */
                    margin-top: auto;
                }

                .blog-card-date {
                    position: absolute;
                    top: 18px; /* Tăng khoảng cách */
                    left: 18px; /* Tăng khoảng cách */
                    background: rgba(255, 255, 255, 0.95);
                    color: #222;
                    font-weight: 700;
                    font-size: 1.25rem; /* Tăng font size */
                    padding: 12px 16px 8px 16px; /* Tăng padding */
                    border-radius: 0; /* Bỏ bo góc cho date badge */
                    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
                    text-align: center;
                    z-index: 2;
                    line-height: 1.1;
                    min-width: 56px; /* Tăng min-width */
                    backdrop-filter: blur(10px);
                }

                .blog-card-date span {
                    display: block;
                    font-size: 0.8em;
                    font-weight: 400;
                    color: #666;
                    margin-top: 2px;
                }

                /* Responsive - 90% width */
                @media (max-width: 1400px) {
                    .blog-grid {
                        gap: 35px;
                    }
                }

                @media (max-width: 1200px) {
                    .blog-grid {
                        grid-template-columns: repeat(2, 1fr);
                        gap: 30px;
                    }
                    .blog-card {
                        min-height: 450px;
                    }
                }

                @media (max-width: 768px) {
                    .blog-grid {
                        grid-template-columns: 1fr;
                        gap: 25px;
                    }
                    .blog-card {
                        min-height: 400px;
                    }
                    .blog-card-title {
                        font-size: 1.25rem;
                        min-height: 50px;
                    }
                    .blog-card-desc {
                        font-size: 1rem;
                    }
                }

                @media (max-width: 480px) {
                    .container-fluid {
                        width: 95%; /* Trên mobile giữ 95% để có padding phù hợp */
                        padding: 0 10px;
                    }
                    .blog-grid {
                        gap: 20px;
                    }
                    .blog-card-body {
                        padding: 20px 18px 18px 18px;
                    }
                }

                /* Pagination styling */
                .pagination-wrapper {
                    margin-top: 50px;
                    display: flex;
                    justify-content: center;
                    width: 100%;
                }

                .pagination {
                    gap: 8px;
                }

                .pagination .page-link {
                    border-radius: 8px;
                    border: 1px solid #ddd;
                    padding: 12px 16px;
                    font-weight: 500;
                    transition: all 0.3s ease;
                }

                .pagination .page-link:hover {
                    background-color: #0066cc;
                    border-color: #0066cc;
                    color: #fff;
                }

                .pagination .active .page-link {
                    background-color: #0066cc;
                    border-color: #0066cc;
                }
            </style>
            
            <div class="blog-grid">
                @forelse($posts as $post)
                    <article class="blog-card">
                        <a href="{{ route('client.page.show', $post->slug) }}" style="display:block; position:relative;">
                            <div class="blog-card-img-wrap">
                                @if ($post->published_at)
                                    <div class="blog-card-date">
                                        {{ $post->published_at->format('d') }}
                                        <span>{{ $post->published_at->format('m/Y') }}</span>
                                    </div>
                                @endif
                                <img src="{{ $post->featured_image_url ? asset('storage/' . $post->featured_image_url) : asset('client/Picture/Blog/default.jpg') }}"
                                    alt="{{ $post->meta_title }}"
                                    loading="lazy">
                            </div>
                        </a>
                        <div class="blog-card-body" style="align-items: center; text-align: center;">
                            <h3 class="blog-card-title">
                                <a href="{{ route('client.page.show', $post->slug) }}"
                                    style="color:inherit; text-decoration:none; display: inline-block;">
                                    {{ $post->meta_title }}
                                </a>
                            </h3>
                            <div class="blog-card-desc">
                                {{ $post->meta_description }}
                            </div>
                        </div>
                    </article>
                @empty
                    <div style="grid-column: 1 / -1; text-align: center; padding: 60px 20px;">
                        <p style="font-size: 1.2rem; color: #666; margin: 0;">Không có bài viết nào.</p>
                    </div>
                @endforelse
            </div>
            <div class="pagination-wrapper">
                {{ $posts->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection