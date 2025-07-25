@extends('admin.layout.admin')

@section('title', 'Quản lý phương thức giao hàng')

@section('content')
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-30">
                <h3>Danh sách phương thức giao hàng</h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li>
                        <a href="{{ route('admin.dashboard') }}">
                            <div class="text-tiny">bảng điều khiển</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <a href="#">
                            <div class="text-tiny">Phương thức</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">Giao hàng</div>
                    </li>
                </ul>
            </div>
            <div class="wg-box">
                <div class="title-box">
                    <i class="icon-truck"></i>
                    <div class="body-text">Quản lý các phương thức giao hàng tại đây. Bạn có thể ẩn/hiện hoặc xóa phương
                        thức theo nhu cầu.</div>
                </div>
                <div class="flex items-center justify-between gap10 flex-wrap">
                    <div class="wg-filter flex-grow">
                        <form class="form-search flex gap10" method="GET" action="#">
                            <fieldset class="name">
                                <input type="text" placeholder="Tìm kiếm tên phương thức giao hàng..." name="name"
                                    value="{{ request('name') }}">
                            </fieldset>
                            <div class="button-submit">
                                <button type="submit"><i class="icon-search"></i></button>
                            </div>
                        </form>
                    </div>
                    <a class="tf-button style-1 w208" href="{{ route('admin.shipping_methods.create') }}"><i
                            class="icon-plus"></i>Thêm mới</a>
                </div>
                <div class="wg-table table-product-list">
                    <ul class="table-title flex gap20 mb-14">
                        <li style="width:7%">
                            <div class="body-title">STT</div>
                        </li>
                        <li style="width:20%">
                            <div class="body-title">Tên</div>
                        </li>
                        <li style="width:30%">
                            <div class="body-title">Mô tả</div>
                        </li>
                        <li style="width:15%">
                            <div class="body-title">Chi phí</div>
                        </li>
                        <li style="width:15%">
                            <div class="body-title">Trạng thái</div>
                        </li>
                        <li style="width:13%">
                            <div class="body-title">Hành động</div>
                        </li>
                    </ul>
                    <ul class="flex flex-column">
                        @foreach ($methods as $method)
                            <li class="wg-product item-row gap20" style="align-items:center;">
                                <div class="body-text" style="width:7%">
                                    {{ ($methods->currentPage() - 1) * $methods->perPage() + $loop->iteration }}
                                </div>
                                <div class="body-text fw-7" style="width:20%">{{ $method->name }}</div>
                                <div class="body-text" style="width:30%">{{ $method->description }}</div>
                                <div class="body-text" style="width:15%">{{ number_format($method->cost, 2) }} đ</div>
                                <div style="width:15%">
                                    @if ($method->is_active)
                                        <span class="block-available bg-1 fw-7">Đang bật</span>
                                    @else
                                        <span class="block-stock bg-1 fw-7">Đang tắt</span>
                                    @endif
                                </div>
                                <div class="list-icon-function"
                                    style="width:13%; display:flex; gap:8px; align-items:center;">
                                    <form method="POST"
                                        action="{{ $method->is_active ? route('admin.shipping_methods.deactivate', $method->id) : route('admin.shipping_methods.activate', $method->id) }}">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="icon-button" title="{{ $method->is_active ? 'Tắt phương thức' : 'Bật phương thức' }}">
                                            <i class="{{ $method->is_active ? 'icon-eye-off' : 'icon-eye' }}" style="color:#f59e0b;font-size:20px;"></i>
                                        </button>
                                    </form>
                                    <form method="POST"
                                        action="{{ route('admin.shipping_methods.destroy', $method->id) }}"
                                        onsubmit="return confirm('Bạn có chắc chắn muốn xóa?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="icon-button danger" title="Xóa phương thức">
                                            <i class="icon-trash-2"></i>
                                        </button>
                                    </form>
                                    <a href="{{ route('admin.shipping_methods.edit', $method->id) }}" class="item edit"
                                        style="background:none; border:none; padding:0; margin:0; cursor:pointer;">
                                        <i class="icon-edit-3" style="color:#22c55e;font-size:20px;"></i>
                                    </a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <style>
        .icon-button {
            background: transparent;
            border: none;
            cursor: pointer;
            font-size: 1.75rem;
            padding: 4px;
            color: #374151;
            /* xám nhạt */
            transition: color 0.2s ease;
        }

        .icon-button:hover {
            color: #2563eb;
            /* xanh dương khi hover */
        }

        .icon-button.danger {
            color: #e3342f;
        }

        .icon-button.danger:hover {
            color: #b91c1c;
        }
    </style>
@endsection
