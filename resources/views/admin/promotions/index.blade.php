@extends('admin.layout.admin')

@section('title', 'Quản lý khuyến mãi')

@section('content')
<div class="main-content-inner">
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-30">
            <h3>All Promotions</h3>
            <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                <li>
                    <a href="{{ route('admin.dashboard') }}">
                        <div class="text-tiny">Dashboard</div>
                    </a>
                </li>
                <li>
                    <i class="icon-chevron-right"></i>
                </li>
                <li>
                    <div class="text-tiny">Promotions</div>
                </li>
            </ul>
        </div>
        <div class="wg-box">
            <div class="flex items-center justify-between gap10 flex-wrap mb-20">
                <div class="wg-filter flex-grow">
                    <form class="form-search" method="GET" action="{{ route('admin.promotions.index') }}">
                        <fieldset class="name">
                            <input type="text" placeholder="Tìm kiếm tên hoặc mã..." name="q" tabindex="2"
                                value="{{ request('q') }}">
                        </fieldset>
                        <div class="button-submit">
                            <button type="submit"><i class="icon-search"></i></button>
                        </div>
                    </form>
                </div>
                <a class="tf-button style-1 w208" href="{{ route('admin.promotions.create') }}"><i class="icon-plus"></i>Thêm khuyến mãi</a>
            </div>
            @if(session('success'))
                <div class="alert alert-success mb-3">{{ session('success') }}</div>
            @endif
            <div class="wg-table table-product-list">
                <ul class="table-title flex gap20 mb-14">
                    <li><div class="body-title">Tên</div></li>
                    <li><div class="body-title">Mã</div></li>
                    <li><div class="body-title">Loại</div></li>
                    <li><div class="body-title">Giá trị</div></li>
                    <li><div class="body-title">Thời gian</div></li>
                    <li><div class="body-title">Trạng thái</div></li>
                    <li><div class="body-title">Áp dụng</div></li>
                    <li><div class="body-title">Ngày tạo</div></li>
                    <li><div class="body-title">Hành động</div></li>
                </ul>
                <ul class="flex flex-column">
                    @forelse($promotions as $promotion)
                    <li class="wg-product item-row gap20">
                        <div class="body-text">{{ $promotion->name }}</div>
                        <div class="body-text">{{ $promotion->code }}</div>
                        <div>
                            <span class="badge bg-info">
                                {{ $promotion->discount_type == 'percentage' ? 'Phần trăm' : 'Tiền mặt' }}
                            </span>
                        </div>
                        <div class="body-text">
                            {{ $promotion->discount_type == 'percentage' ? $promotion->discount_value.'%' : number_format($promotion->discount_value,0,',','.') . ' đ' }}
                        </div>
                        <div class="body-text">
                            {{ $promotion->start_date ? $promotion->start_date->format('d/m/Y') : '-' }}<br>
                            {{ $promotion->end_date ? $promotion->end_date->format('d/m/Y') : '-' }}
                        </div>
                        <div>
                            @if($promotion->is_active)
                                <span class="badge bg-success">Kích hoạt</span>
                            @else
                                <span class="badge bg-secondary">Ẩn</span>
                            @endif
                        </div>
                        <div>
                            @if($promotion->applies_to == 'all_products')
                                <span class="badge bg-info text-dark">Tất cả SP</span>
                            @elseif($promotion->applies_to == 'specific_products')
                                <span class="badge bg-primary">Sản phẩm</span>
                            @else
                                <span class="badge bg-warning text-dark">Danh mục</span>
                            @endif
                        </div>
                        <div class="body-text">
                            {{ $promotion->created_at ? $promotion->created_at->format('d/m/Y') : '-' }}
                        </div>
                        <div class="list-icon-function">
                            <div class="item edit">
                                <a href="{{ route('admin.promotions.edit', $promotion->id) }}"><i class="icon-edit-3"></i></a>
                            </div>
                            <div class="item trash">
                                <form action="{{ route('admin.promotions.destroy', $promotion->id) }}" method="POST" onsubmit="return confirm('Xóa khuyến mãi này?');" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="background:transparent;border:none;padding:0;">
                                        <i class="icon-trash-2"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </li>
                    @empty
                    <li class="text-center text-muted py-4">Chưa có khuyến mãi nào.</li>
                    @endforelse
                </ul>
            </div>
            <div class="divider"></div>
            <div class="flex items-center justify-between flex-wrap gap10">
                <div class="text-tiny">
                    Hiển thị {{ $promotions->firstItem() }} đến {{ $promotions->lastItem() }} của {{ $promotions->total() }} khuyến mãi
                </div>
                <ul class="wg-pagination">
                    <li>
                        @if ($promotions->onFirstPage())
                        <span><i class="icon-chevron-left"></i></span>
                        @else
                        <a href="{{ $promotions->previousPageUrl() }}"><i class="icon-chevron-left"></i></a>
                        @endif
                    </li>
                    @foreach ($promotions->getUrlRange(1, $promotions->lastPage()) as $page => $url)
                    <li class="{{ $page == $promotions->currentPage() ? 'active' : '' }}">
                        @if ($page == $promotions->currentPage())
                        <span>{{ $page }}</span>
                        @else
                        <a href="{{ $url }}">{{ $page }}</a>
                        @endif
                    </li>
                    @endforeach
                    <li>
                        @if ($promotions->hasMorePages())
                        <a href="{{ $promotions->nextPageUrl() }}"><i class="icon-chevron-right"></i></a>
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