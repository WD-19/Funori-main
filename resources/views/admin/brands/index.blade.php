@extends('admin.layout.admin')

@section('title', 'Danh sách nhãn hàng')

@once
    <style>
        .wg-table {
            overflow: auto !important;
            height: 350px;
        }

        .wg-table.table-product-list .wg-product>*:nth-child(1),
        .wg-table.table-product-list ul.table-title>*:nth-child(1) {
            width: 150px !important;
        }

        .wg-product .image {
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
                <h3>All Brand</h3>
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
                            <div class="text-tiny">Brand</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">All Brand</div>
                    </li>
                </ul>
            </div>
            <!-- brand-list -->
            <div class="wg-box">
                <div class="title-box">
                    <i class="icon-coffee"></i>
                    <div class="body-text">Tip search by brand ID: Each brand is provided with a unique ID, which you can
                        rely on to find the exact brand you need.</div>
                </div>
                <div class="flex items-center justify-between gap10 flex-wrap">
                    <div class="wg-filter flex-grow">
                        <form class="form-search" method="GET" action="{{ route('admin.brands.index') }}">
                            <fieldset class="name">
                                <input type="text" placeholder="Search here..." name="search" tabindex="2"
                                    value="{{ request('name') }}">
                            </fieldset>
                            <div class="button-submit">
                                <button type="submit"><i class="icon-search"></i></button>
                            </div>
                        </form>
                    </div>
                    <a class="tf-button style-1 w208" href="{{ route('admin.brands.create') }}"><i class="icon-plus"></i>Add
                        new</a>
                </div>
                <div class="wg-table table-brand-list">
                    <ul class="table-title flex gap20 mb-14">
                        <li>
                            <div class="body-title">Name</div>
                        </li>
                        <li>
                            <div class="body-title">Slug</div>
                        </li>
                        <li>
                            <div class="body-title">Logo_url</div>
                        </li>
                        <li>
                            <div class="body-title">Description</div>
                        </li>
                        <li>
                            <div class="body-title">Is_active</div>
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
                        @foreach ($brands as $brand)
                            <li class="wg-product item-row gap20">
                                <div class="body-text text-main-dark mt-4">{{ $brand->name }}</div>
                                <div class="body-text text-main-dark mt-4">{{ $brand->slug }}</div>
                                <div class="name">
                                    <div class="image">
                                        <img src="{{ asset('storage/' . $brand->logo_url) }}" alt="">
                                    </div>
                                </div>
                                <div class="body-text text-main-dark mt-4">{{ $brand->description }}</div>
                                <div class="body-text text-main-dark mt-4">
                                    {{ $brand->is_active == 1 ? 'Đã kích hoạt' : 'Chưa kích hoạt' }}
                                </div>
                                <div class="body-text text-main-dark mt-4">{{ $brand->created_at }}</div>
                                <div class="body-text text-main-dark mt-4">{{ $brand->updated_at }}</div>
                                <div class="list-icon-function">
                                    {{-- <div class="item eye">
                        <a href="{{ route('admin.brands.show', $brand->id) }}"><i class="icon-eye"></i></a>
                    </div> --}}
                                    <div class="item edit">
                                        <a href="{{ route('admin.brands.edit', $brand->id) }}"><i
                                                class="icon-edit-3"></i></a>
                                    </div>
                                    <div class="item trash">
                                        <form action="{{ route('admin.brands.destroy', $brand->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" style="background:transparent;border:none;padding:0;">
                                                <i class="icon-trash-2"></i>
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
                        Showing {{ $brands->firstItem() }} to {{ $brands->lastItem() }} of {{ $brands->total() }}
                        entries
                    </div>
                    <ul class="wg-pagination">
                        <li>
                            @if ($brands->onFirstPage())
                                <span><i class="icon-chevron-left"></i></span>
                            @else
                                <a href="{{ $brands->previousPageUrl() }}"><i class="icon-chevron-left"></i></a>
                            @endif
                        </li>
                        @foreach ($brands->getUrlRange(1, $brands->lastPage()) as $page => $url)
                            <li class="{{ $page == $brands->currentPage() ? 'active' : '' }}">
                                @if ($page == $brands->currentPage())
                                    <span>{{ $page }}</span>
                                @else
                                    <a href="{{ $url }}">{{ $page }}</a>
                                @endif
                            </li>
                        @endforeach
                        <li>
                            @if ($brands->hasMorePages())
                                <a href="{{ $brands->nextPageUrl() }}"><i class="icon-chevron-right"></i></a>
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
