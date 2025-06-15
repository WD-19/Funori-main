@extends('admin.layout.admin')

@section('content')
    @php use Illuminate\Support\Str; @endphp
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-30">
                <h3>Thùng rác đánh giá</h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li>
                        <a href="{{ route('admin.dashboard') }}">
                            <div class="text-tiny">Trang chủ</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <a href="{{ route('admin.reviews.index') }}">
                            <div class="text-tiny">Đánh giá</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">Thùng rác</div>
                    </li>
                </ul>
            </div>
            <div class="wg-box">
                <div class="wg-table table-all-category">
                    <ul class="table-title flex gap20 mb-14">
                        <li>
                            <div class="body-title">Người dùng</div>
                        </li>
                        <li>
                            <div class="body-title">Sản phẩm</div>
                        </li>
                        <li>
                            <div class="body-title">Đánh giá</div>
                        </li>
                        <li>
                            <div class="body-title">Bình luận</div>
                        </li>
                        <li>
                            <div class="body-title">Trạng thái</div>
                        </li>
                        <li>
                            <div class="body-title">Ngày xóa</div>
                        </li>
                        <li>
                            <div class="body-title">Thao tác</div>
                        </li>
                    </ul>
                    <ul class="flex flex-column">
                        @forelse ($reviews as $value)
                            <li class="wg-product item-row gap20">
                                {{-- User Name --}}
                                <div class="body-text text-main-dark mt-4">
                                    {{ $value->user->full_name ?? 'Không rõ' }}
                                </div>
                                {{-- Product Name --}}
                                <div class="body-text text-main-dark mt-4">
                                    {{ $value->product->name ?? 'Không rõ' }}
                                </div>
                                {{-- Rating --}}
                                <div class="body-text text-main-dark mt-4">
                                    <span class="badge" style="background: #ffc107; color: #111; font-weight: bold;">
                                        ★ {{ $value->rating ?? 'N/A' }}
                                    </span>
                                </div>
                                {{-- Comment --}}
                                <div class="body-text text-main-dark mt-4">
                                    {{ Str::limit($value->comment, 30) }}
                                </div>
                                {{-- Status --}}
                                <div class="body-text text-main-dark mt-4">
                                    @php
                                        $status = strtolower($value->status ?? '');
                                        $statusColor = match ($status) {
                                            'approved' => '#28a745',
                                            'pending' => '#ffc107',
                                            'rejected' => '#dc3545',
                                            default => '#6c757d',
                                        };
                                        $statusText = match ($status) {
                                            'approved' => 'Đã duyệt',
                                            'pending' => 'Chờ duyệt',
                                            'rejected' => 'Từ chối',
                                            default => 'Không rõ',
                                        };
                                    @endphp
                                    <span class="badge"
                                        style="background: {{ $statusColor }}; color: #fff; font-weight: bold;">
                                        {{ $statusText }}
                                    </span>
                                </div>
                                {{-- Deleted At --}}
                                <div class="body-text text-main-dark mt-4">
                                    {{ $value->deleted_at ? $value->deleted_at->format('d-m-Y H:i') : '' }}
                                </div>
                                {{-- Action --}}
                                <div class="list-icon-function flex gap10">
                                    <!-- Khôi phục -->
                                    <div class="item undo">
                                        <form action="{{ route('admin.reviews.restore', $value->id) }}" method="POST"
                                            style="display:inline;"
                                            onsubmit="return confirm('Bạn có chắc chắn muốn khôi phục đánh giá này?');">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit"
                                                style="background: none; border: none; padding: 0; color: inherit; cursor: pointer; display: flex; align-items: center;"
                                                title="Khôi phục">
                                                <i class="icon-rotate-ccw" style="color: green; font-size: 20px;"></i>
                                            </button>
                                        </form>
                                    </div>
                                    <!-- Xóa vĩnh viễn -->
                                    <div class="item trash">
                                        <form action="{{ route('admin.reviews.forceDelete', $value->id) }}" method="POST"
                                            style="display:inline;"
                                            onsubmit="return confirm('Bạn có chắc chắn muốn xóa vĩnh viễn đánh giá này?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                style="background: none; border: none; padding: 0; color: inherit; cursor: pointer; display: flex; align-items: center;"
                                                title="Xóa vĩnh viễn">
                                                <i class="icon-trash-2" style="color: red; font-size: 20px;"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </li>
                        @empty
                            <li class="body-text text-center w-full py-4" style="font-size: 1.1rem; color: #888;">
                                Không có đánh giá nào trong thùng rác.
                            </li>
                        @endforelse
                    </ul>
                </div>
                <div class="divider"></div>
                <div class="flex items-center justify-between flex-wrap gap10">
                    <div class="text-tiny">
                        Hiển thị {{ $reviews->firstItem() }} đến {{ $reviews->lastItem() }} trong tổng số
                        {{ $reviews->total() }} bản ghi
                    </div>
                    <ul class="wg-pagination">
                        <li class="{{ $reviews->onFirstPage() ? 'disabled' : '' }}">
                            <a href="{{ $reviews->previousPageUrl() ?? '#' }}">
                                <i class="icon-chevron-left"></i>
                            </a>
                        </li>
                        @for ($i = 1; $i <= $reviews->lastPage(); $i++)
                            <li class="{{ $reviews->currentPage() == $i ? 'active' : '' }}">
                                <a href="{{ $reviews->url($i) }}">{{ $i }}</a>
                            </li>
                        @endfor
                        <li class="{{ $reviews->hasMorePages() ? '' : 'disabled' }}">
                            <a href="{{ $reviews->nextPageUrl() ?? '#' }}">
                                <i class="icon-chevron-right"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
