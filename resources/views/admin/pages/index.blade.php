{{-- filepath: resources/views/admin/pages/index.blade.php --}}
@extends('admin.layout.admin')

@section('title', 'Danh sách trang')

@section('content')
    <div class="main-content-inner">
        <div class="main-content-wrap">
            {{-- <div class="w-100">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show mt-2 mb-3" role="alert"
                        style="max-width: 600px; margin: 0 auto;">
                        <i class="bi bi-check-circle-fill me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Đóng"></button>
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show mt-2 mb-3" role="alert"
                        style="max-width: 600px; margin: 0 auto;">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Đóng"></button>
                    </div>
                @endif
            </div> --}}
            <div class="flex items-center flex-wrap justify-between gap20 mb-30">
                <h3>Tất cả trang</h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li>
                        <a href="{{ route('admin.dashboard') }}">
                            <div class="text-tiny">Bảng điều khiển</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <a href="{{ route('admin.pages.index') }}">
                            <div class="text-tiny">Trang</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">Tất cả trang</div>
                    </li>
                </ul>
            </div>
            <!-- all-pages -->
            <div class="wg-box">
                <div class="flex items-center justify-between gap10 flex-wrap">
                    <div class="wg-filter flex-grow">
                        <form class="form-search flex gap10" method="GET" action="{{ route('admin.pages.index') }}">
                            <fieldset class="name">
                                <input type="text" placeholder="Tìm kiếm tên tiêu đề..." class="" name="q"
                                    value="{{ request('q') }}">
                            </fieldset>
                            <fieldset>
                                <select name="status">
                                    <option value="">Trạng thái</option>
                                    <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Đã
                                        xuất bản
                                    </option>
                                    <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Nháp
                                    </option>
                                </select>
                            </fieldset>
                            <fieldset>
                                <select name="page_type">
                                    <option value="">Loại trang</option>
                                    @foreach ($pageTypes as $type)
                                        <option value="{{ $type }}"
                                            {{ request('page_type') == $type ? 'selected' : '' }}>
                                            {{ $type }}
                                        </option>
                                    @endforeach
                                </select>
                            </fieldset>
                            <div class="button-submit">
                                <button type="submit"><i class="icon-search"></i></button>
                            </div>
                        </form>
                    </div>
                    <a class="tf-button style-1 w208" href="{{ route('admin.pages.create') }}"><i
                            class="icon-plus"></i>Thêm mới
                    </a>
                </div>
                <div class="wg-table table-all-attribute">
                    <thead>
                        <ul class="table-title flex gap20 mb-14">
                            <li>
                                <div class="body-title">STT</div>
                            </li>
                            <li>
                                <div class="body-title">Tiêu đề</div>
                            </li>
                            <li>
                                <div class="body-title">Tác giả</div>
                            </li>
                            <li>
                                <div class="body-title">Loại trang</div>
                            </li>
                            <li>
                                <div class="body-title">Trạng thái</div>
                            </li>
                            <li>
                                <div class="body-title">Ảnh</div>
                            </li>
                            <li>
                                <div class="body-title">Ngày xuất bản</div>
                            </li>
                            <li>
                                <div class="body-title">Hành động</div>
                            </li>
                        </ul>
                    </thead>
                    <tbody>
                        <ul class="flex flex-column">
                            @foreach ($pages as $page)
                                <li class="attribute-item item-row flex items-center justify-between gap20">
                                    <div class="body-text">{{ $pages->firstItem() + $loop->index }}</div>
                                    <div class="body-text">{{ $page->title }}</div>
                                    <div class="body-text">{{ $page->author ? $page->author->full_name : 'N/A' }}</div>
                                    <div class="body-text">{{ $page->page_type }}</div>
                                    <div class="body-text">
                                        @if ($page->status == 'published')
                                            <span class="badge bg-success">Đã xuất bản</span>
                                        @else
                                            <span class="badge bg-secondary">Nháp</span>
                                        @endif
                                    </div>
                                    <div class="body-text">
                                        @if ($page->featured_image_url)
                                            <img src="{{ asset('storage/' . $page->featured_image_url) }}" alt="Ảnh"
                                                style="max-width:60px;max-height:60px;">
                                        @else
                                            Không có ảnh
                                        @endif
                                    </div>
                                    <div class="body-text">
                                        {{ $page->published_at ? $page->published_at->format('d/m/Y H:i') : '-' }}
                                    </div>
                                    <div class="list-icon-function">
                                        <div class="item eye" data-bs-toggle="modal"
                                            data-bs-target="#quickViewModalPage{{ $page->id }}">
                                            <i class="icon-eye"></i>
                                        </div>
                                        <!-- Modal quick view -->
                                        <div class="modal fade" id="quickViewModalPage{{ $page->id }}" tabindex="-1"
                                            aria-labelledby="quickViewLabelPage{{ $page->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-xl">
                                                <div class="modal-content shadow-lg rounded-4 border-0">
                                                    <div class="modal-header bg-primary text-white">
                                                        <h3 class="modal-title fw-bold mb-0 text-light"
                                                            id="quickViewLabelPage{{ $page->id }}">
                                                            <i class="bi bi-info-circle me-2"></i>Xem trước trang
                                                        </h3>
                                                        <button type="button" class="btn-close btn-close-white"
                                                            data-bs-dismiss="modal" aria-label="Đóng"></button>
                                                    </div>
                                                    <div class="modal-body px-5 py-4" style="max-height: 80vh; overflow-y: auto;">
                                                        <div class="inspiration-article-bg" style="background: #f5f6fa; padding: 40px;">
                                                            <div class="inspiration-article-container" style="width: 100%; max-width: 1300px; margin: 0 auto;">
                                                                @if ($page->featured_image_url)
                                                                    <div class="inspiration-article-image">
                                                                        <img src="{{ asset('storage/' . $page->featured_image_url) }}"
                                                                            alt="{{ $page->title }}"
                                                                            style="width: 100%; max-width: 100%; height: auto; object-fit: contain; background: #eee; display: block; margin: 0 auto;">
                                                                    </div>
                                                                @endif
                                                                <h1 class="inspiration-article-title" style="font-size: 2.4rem; font-weight: 800; text-align: center; margin-bottom: 18px; color: #222; line-height: 1.2;">
                                                                    {{ $page->title }}
                                                                </h1>
                                                                <div class="inspiration-article-content" style="font-size: 1.15rem; color: #333; line-height: 1.8; text-align: justify; margin-bottom: 0; overflow: hidden;">
                                                                    {!! str_replace('/admin/storage', '/storage', $page->content) !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item edit">
                                            <a href="{{ route('admin.pages.edit', $page->id) }}" class="item edit"><i
                                                    class="icon-edit-3"></i></a>
                                        </div>
                                        <form action="{{ route('admin.pages.destroy', $page->id) }}" method="POST"
                                            style="display:inline;" onclick="return confirm('Xóa trang này?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                style="background: none; border: none; padding: 0; color: inherit; cursor: pointer; display: flex; align-items: center;">
                                                <i class="icon-trash-2" style="color: red; font-size: 20px;"></i>
                                            </button>
                                        </form>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </tbody>
                </div>
                <div class="divider"></div>
                <div class="flex items-center justify-between flex-wrap gap10 mt-3">
                    <div class="text-tiny">
                        Showing {{ $pages->firstItem() }} to {{ $pages->lastItem() }} of {{ $pages->total() }} entries
                    </div>
                    <ul class="wg-pagination">
                        <li>
                            <a href="{{ $pages->previousPageUrl() ?? '#' }}" {!! $pages->onFirstPage() ? 'class=disabled' : '' !!}>
                                <i class="icon-chevron-left"></i>
                            </a>
                        </li>
                        @for ($i = 1; $i <= $pages->lastPage(); $i++)
                            <li class="{{ $pages->currentPage() == $i ? 'active' : '' }}>
                                <a href="{{ $pages->url($i) }}">{{ $i }}</a>
                            </li>
                        @endfor
                        <li>
                            <a href="{{ $pages->nextPageUrl() ?? '#' }}" {!! $pages->currentPage() == $pages->lastPage() ? 'class=disabled' : '' !!}>
                                <i class="icon-chevron-right"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- /all-pages -->
        </div>
        <!-- /main-content-wrap -->
    </div>

    <style>
        .inspiration-article-bg {
            background: #f5f6fa;
            min-height: 100%;
            padding: 40px 0;
        }

        .inspiration-article-container {
            width: 100%;
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
            clear: both;
        }

        .inspiration-article-content img[align="right"],
        .inspiration-article-content img[data-mce-style*="float: right"] {
            float: right;
            margin-left: 20px;
            margin-bottom: 10px;
            max-width: 40%;
            clear: both;
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
        }
    </style>
@endsection