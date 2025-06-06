@extends('admin.layout.admin')

@section('title', 'Danh sách sản phẩm')

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
                <div class="wg-table table-banner-list">
                    <ul class="table-title flex gap20 mb-14">
                        <table class="table table-striped table-borderless">
                            <tr>
                                <td>
                                    <div class="body-title">Title</div>
                                </td>
                                <td>
                                    <div class="body-title">Image_url</div>
                                </td>
                                <td>
                                    <div class="body-title">tdnk_url</div>
                                </td>
                                <td>
                                    <div class="body-title">Description</div>
                                </td>
                                <td>
                                    <div class="body-title">Position</div>
                                </td>
                                <td>
                                    <div class="body-title">Order</div>
                                </td>

                                <td>
                                    <div class="body-title">Start_date</div>
                                </td>
                                <td>
                                    <div class="body-title">End date</div>
                                </td>
                                <td>
                                    <div class="body-title">Is_active</div>
                                </td>
                                <td>
                                    <div class="body-title">Created_at</div>
                                </td>
                                <td>
                                    <div class="body-title">Updated_at</div>
                                </td>
                                <td colspan="2">
                                    <div class="body-title">Action</div>
                                </td>
                            </tr>
                            @foreach ($banners as $banner)
                                <tr>
                                    <td class="">
                                        {{ $banner->title }}
                                    </td>
                                    <td class="">

                                        <img src="{{ asset('storage/' . $banner->image_url) }} " alt="">

                                    </td>
                                    <td class="">
                                        {{ $banner->link_url }}
                                    </td>
                                    <td class="">
                                        {{ $banner->description }}
                                    </td>
                                    <td class="">
                                        {{ $banner->position }}
                                    </td>
                                    <td class="">
                                        {{ $banner->order }}
                                    </td>
                                    <td class="">
                                        {{ $banner->start_date }}
                                    </td>
                                    <td class="">
                                        {{ $banner->end_date }}
                                    </td>
                                    <td class="">
                                        {{ $banner->is_active == 1 ? 'Đã kích hoạt' : 'Chưa kích hoạt' }}
                                    </td>
                                    <td class="">
                                        {{ $banner->created_at }}
                                    </td>
                                    <td class="">
                                        {{ $banner->updated_at }}
                                    </td>
                                    {{-- <td class="item eye">
                                        <a href="{{ route('admin.banners.show', $banner->id) }}"><i
                                                class="icon-eye"></i></a>
                                    </td> --}}
                                    <td class="item edit">
                                        <a href="{{ route('admin.banners.edit', $banner->id) }}"><i
                                                class="icon-edit-3"></i></a>
                                    </td>
                                    <td class="item trash">
                                        <form action="{{ route('admin.banners.destroy', $banner->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" style="background:transparent;border:none;padding:0;">
                                                <i class="icon-trash-2"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </table>


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
