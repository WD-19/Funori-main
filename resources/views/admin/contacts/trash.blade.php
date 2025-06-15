@extends('admin.layout.admin')

@section('content')
    @php use Illuminate\Support\Str; @endphp
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-30">
                <h3>Thùng rác liên hệ</h3>
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
                        <a href="{{ route('admin.contacts.index') }}">
                            <div class="text-tiny">Liên hệ</div>
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
                            <div class="body-title">Email</div>
                        </li>
                        <li>
                            <div class="body-title">Họ tên</div>
                        </li>
                        <li>
                            <div class="body-title">Số điện thoại</div>
                        </li>
                        <li>
                            <div class="body-title">Tiêu đề</div>
                        </li>
                        <li>
                            <div class="body-title">Nội dung</div>
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
                        @foreach ($contacts as $value)
                            <li class="wg-product item-row gap20">
                                <div class="body-text text-main-dark mt-4">{{ $value->email }}</div>
                                <div class="body-text text-main-dark mt-4">{{ $value->name }}</div>
                                <div class="body-text text-main-dark mt-4">{{ $value->phone }}</div>
                                <div class="body-text text-main-dark mt-4">{{ $value->subject }}</div>
                                <div class="body-text text-main-dark mt-4">{{ Str::limit($value->message, 30) }}</div>
                                <div class="body-text text-main-dark mt-4">{{ $value->status }}</div>
                                <div class="body-text text-main-dark mt-4">
                                    {{ $value->deleted_at ? $value->deleted_at->format('d-m-Y H:i') : '' }}</div>
                                <div class="list-icon-function flex gap10">
                                    <!-- Khôi phục -->
                                    <div class="item undo">
                                        <form action="{{ route('admin.contacts.restore', $value->id) }}" method="POST"
                                            style="display:inline;"
                                            onsubmit="return confirm('Bạn có chắc chắn muốn khôi phục liên hệ này?');">
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
                                        <form action="{{ route('admin.contacts.forceDelete', $value->id) }}" method="POST"
                                            style="display:inline;"
                                            onsubmit="return confirm('Bạn có chắc chắn muốn xóa vĩnh viễn liên hệ này?');">
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
                        @endforeach
                    </ul>
                </div>
                <div class="divider"></div>
                <div class="flex items-center justify-between flex-wrap gap10">
                    <div class="text-tiny">
                        Hiển thị {{ $contacts->firstItem() }} đến {{ $contacts->lastItem() }} trong tổng số
                        {{ $contacts->total() }} bản ghi
                    </div>
                    <ul class="wg-pagination">
                        <li class="{{ $contacts->onFirstPage() ? 'disabled' : '' }}">
                            <a href="{{ $contacts->previousPageUrl() ?? '#' }}">
                                <i class="icon-chevron-left"></i>
                            </a>
                        </li>
                        @for ($i = 1; $i <= $contacts->lastPage(); $i++)
                            <li class="{{ $contacts->currentPage() == $i ? 'active' : '' }}">
                                <a href="{{ $contacts->url($i) }}">{{ $i }}</a>
                            </li>
                        @endfor
                        <li class="{{ $contacts->hasMorePages() ? '' : 'disabled' }}">
                            <a href="{{ $contacts->nextPageUrl() ?? '#' }}">
                                <i class="icon-chevron-right"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
