@extends('client.layout.client')

@section('title', 'Tìm Kiếm')

@section('content')
    <div class="box-banner-about" style="background-position: 50%; margin-bottom: -30px;">
        <div class="in-banner-about">
            <div class="title-banner">Tìm Kiếm</div>
            <div class="box-path-about">
                <div>Trang chủ</div>
                <div class="icon">
                    <i class="fa-solid fa-angle-right"></i>
                </div>
                <div>Tìm Kiếm</div>
            </div>
        </div>
    </div>

    <div class="flat-spacing-8 page-search-inner">
        <div class="tf-search-head">
            <form class="tf-mini-search-frm" method="GET" action="{{ route('client.search') }}">
                <fieldset class="text">
                    <input type="text" name="keyword" placeholder="Nhập từ khóa..." value="{{ request('keyword') }}">
                </fieldset>
                <button type="submit"><i class="icon-search"></i></button>
            </form>

            {{-- <div class="tf-col-quicklink mt-2">
                <span class="title">Tìm nhanh:</span>
                <a href="#">Bàn ghế</a>,
                <a href="#">Tủ kệ</a>,
                <a href="#">Nội thất phòng ngủ</a>
            </div> --}}
        </div>

        <div class="container">
            <div class="row">
                @if ($products->isEmpty())
                    <div class="col-12 text-center py-5">
                        <h5>Không tìm thấy sản phẩm phù hợp.</h5>
                    </div>
                @else
                    @foreach ($products as $value)
                        <div class="col-lg-3 col-md-4 col-6">
                            <div class="card-product mb_30">
                                <div class="card-product-wrapper">
                                    <a href="{{ route('client.product.show', ['slug' => $value->slug]) }}"
                                        class="product-img">
                                        <img class="lazyload img-product"
                                            data-src="{{ asset(optional($value->thumbnail)->image_url ?? 'images/no-image.jpg') }}"
                                            src="{{ asset(optional($value->thumbnail)->image_url ?? 'images/no-image.jpg') }}"
                                            alt="{{ $value->name }}">
                                        <img class="lazyload img-hover"
                                            data-src="{{ asset(optional($value->thumbnail)->image_url ?? 'images/no-image.jpg') }}"
                                            src="{{ asset(optional($value->thumbnail)->image_url ?? 'images/no-image.jpg') }}"
                                            alt="{{ $value->name }}">
                                    </a>
                                </div>
                                <div class="card-product-info">
                                    <a href="{{ route('client.product.show', ['slug' => $value->slug]) }}"
                                        class="title link">{{ $value->name }}</a>
                                    <span
                                        class="price text-danger">{{ number_format($value->regular_price, 0, ',', '.') }}₫</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

        </div>
        @if ($products->count())
            <div class="d-flex justify-content-center mt-4">
                <nav>
                    <ul class="pagination">
                        {{-- Previous Page --}}
                        <li class="page-item {{ $products->onFirstPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $products->onFirstPage() ? '#' : $products->previousPageUrl() }}"
                                aria-label="Trang trước">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>

                        {{-- Page Numbers --}}
                        @for ($i = 1; $i <= $products->lastPage(); $i++)
                            <li class="page-item {{ $products->currentPage() == $i ? 'active' : '' }}">
                                <a class="page-link" href="{{ $products->url($i) }}">{{ $i }}</a>
                            </li>
                        @endfor

                        {{-- Next Page --}}
                        <li class="page-item {{ $products->hasMorePages() ? '' : 'disabled' }}">
                            <a class="page-link" href="{{ $products->hasMorePages() ? $products->nextPageUrl() : '#' }}"
                                aria-label="Trang sau">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        @endif
    </div>
@endsection
