@extends('admin.layout.admin')

@section('title', 'Danh sách sản phẩm')

@once
    <style>
        .wg-table {
            overflow: auto !important;
            height: 350px;
        }

        .wg-table.table-product-list .wg-product>*:nth-child(1),
        .wg-table.table-product-list ul.table-title>*:nth-child(1){
            width: 150px !important;
        }
        .wg-product .image{
            width: 100px !important;
            height: 100px !important;
        }
    </style>
@endonce

@section('content')
    <div class="main-content-inner">
        <!-- main-content-wrap -->
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-30">
                <h3>All Banner</h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li>
                        <a href="index.html">
                            <div class="text-tiny">Dashboard</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <a href="#">
                            <div class="text-tiny">Banner</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">All Banner</div>
                    </li>
                </ul>
            </div>
            <!-- banner-list -->
            <div class="wg-box">
                <div class="title-box">
                    <i class="icon-coffee"></i>
                    <div class="body-text">Tip search by banner ID: Each banner is provided with a unique ID, which you can
                        rely on to find the exact banner you need.</div>
                </div>
                <div class="flex items-center justify-between gap10 flex-wrap">
                    <div class="wg-filter flex-grow">
                        <form class="form-search" method="GET" action="{{ route('admin.banners.index') }}">
                            <fieldset class="name">
                                <input type="text" placeholder="Search here..." name="search" tabindex="2"
                                    value="{{ request('name') }}">
                            </fieldset>
                            <div class="button-submit">
                                <button type="submit"><i class="icon-search"></i></button>
                            </div>
                        </form>
                    </div>
                    <a class="tf-button style-1 w208" href="{{ route('admin.banners.create') }}"><i
                            class="icon-plus"></i>Add new</a>
                </div>
                <div class="wg-table table-product-list">
                    <ul class="table-title flex gap20 mb-14">
                        <li>
                            <div class="body-title">Title</div>
                        </li>
                        <li>
                            <div class="body-title">image_url</div>
                        </li>
                        <li>
                            <div class="body-title">link_url</div>
                        </li>
                        <li>
                            <div class="body-title">Description</div>
                        </li>
                        <li>
                            <div class="body-title">Position</div>
                        </li>
                        <li>
                            <div class="body-title">Order</div>
                        </li>
                        <li>
                            <div class="body-title">Is_active</div>
                        </li>
                        <li>
                            <div class="body-title">Start_date</div>
                        </li>
                        <li>
                            <div class="body-title">End date</div>
                        </li>
                        <li>
                            <div class="body-title">Created_at</div>
                        </li>
                        <li>
                            <div class="body-title">Updated_at</div>
                        </li>
                        <li>
                            <div class="body-title">Action</div>
                        </li>
                    </ul>
                    <ul class="flex flex-column">
                        @foreach ($banners as $banner)
                            <li class="wg-product item-row gap20">
                                <div class="body-text text-main-dark mt-4">{{ $banner->title }}</div>
                                <div class="name">
                                    <div class="image">
                                        <img src="{{ asset('/storage/' . $banner->image_url) }}" alt="">
                                    </div>
                                    {{-- <div class="title line-clamp-2 mb-0">
                                        <a href="#" class="body-text">Dog Food, Chicken &amp; Chicken Liver
                                            Recipe...</a>
                                    </div> --}}
                                </div>
                                <div class="body-text text-main-dark mt-4">{{ $banner->link_url }}</div>
                                <div class="body-text text-main-dark mt-4">{{ $banner->description }}</div>
                                <div class="body-text text-main-dark mt-4">{{ $banner->position }}</div>
                                <div class="body-text text-main-dark mt-4">{{ $banner->order }}</div>
                                <div class="body-text text-main-dark mt-4">
                                    {{ $banner->is_active == 1 ? 'Kích hoạt' : 'Chưa kích hoạt' }}
                                </div>

                                <div class="body-text text-main-dark mt-4">{{ $banner->start_date }}</div>
                                <div class="body-text text-main-dark mt-4">{{ $banner->end_date }}</div>
                                <div class="body-text text-main-dark mt-4">{{ $banner->created_at }}</div>
                                <div class="body-text text-main-dark mt-4">{{ $banner->updated_at }}</div>

                                <div class="list-icon-function">
                                    {{-- <div class="item eye">
                                        <a href="{{ route('admin.banners.show', $banner->id) }}"><i
                                                class="icon-eye"></i></a>
                                    </div> --}}
                                    <div class="item edit">
                                        <a href="{{ route('admin.banners.edit', $banner->id) }}"><i
                                                class="icon-edit"></i></a>
                                    </div>
                                    <div class="item trash">
                                        <form action="{{ route('admin.banners.destroy', $banner->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" style="background:transparent;border:none;padding:0;">
                                                <i class="icon-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="divider"></div>
                <div class="flex items-center justify-between flex-wrap gap10">
                    <div class="text-tiny">
                        Showing {{ $banners->firstItem() }} to {{ $banners->lastItem() }} of {{ $banners->total() }}
                        entries
                    </div>
                    <ul class="wg-pagination">
                        <li>
                            @if ($banners->onFirstPage())
                                <span><i class="icon-chevron-left"></i></span>
                            @else
                                <a href="{{ $banners->previousPageUrl() }}"><i class="icon-chevron-left"></i></a>
                            @endif
                        </li>
                        @foreach ($banners->getUrlRange(1, $banners->lastPage()) as $page => $url)
                            <li class="{{ $page == $banners->currentPage() ? 'active' : '' }}">
                                @if ($page == $banners->currentPage())
                                    <span>{{ $page }}</span>
                                @else
                                    <a href="{{ $url }}">{{ $page }}</a>
                                @endif
                            </li>
                        @endforeach
                        <li>
                            @if ($banners->hasMorePages())
                                <a href="{{ $banners->nextPageUrl() }}"><i class="icon-chevron-right"></i></a>
                            @else
                                <span><i class="icon-chevron-right"></i></span>
                            @endif
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>

@endsection
