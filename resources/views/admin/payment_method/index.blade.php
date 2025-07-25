@extends('admin.layout.admin')

@section('title', 'Danh sách phương thức thanh toán')

@section('content')
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-30">
                <h3>Danh sách phương thức thanh toán</h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li>
                        <a href="{{ route('admin.dashboard') }}">
                            <div class="text-tiny">Bảng điều khiển</div>
                        </a>
                    </li>
                    <li><i class="icon-chevron-right"></i></li>
                    <li>
                        <div class="text-tiny">Phương thức</div>
                    </li>
                    <li><i class="icon-chevron-right"></i></li>
                    <li>
                        <div class="text-tiny">Thanh toán</div>
                    </li>
                </ul>
            </div>

            <div class="wg-box">
                <div class="title-box">
                    <i class="icon-credit-card"></i>
                    <div class="body-text">
                        Quản lý các phương thức thanh toán tại đây. Bạn có thể bật/tắt hoặc xóa phương thức theo nhu cầu.
                    </div>
                </div>
                <div class="flex items-center justify-between gap10 flex-wrap">
                    <div class="wg-filter flex-grow">
                        <form class="form-search flex gap10" method="GET" action="#">
                            <fieldset class="name">
                                <input type="text" placeholder="Tìm kiếm tên phương thức thanh toán..." name="name"
                                    value="{{ request('name') }}">
                            </fieldset>
                            <div class="button-submit">
                                <button type="submit"><i class="icon-search"></i></button>
                            </div>
                        </form>
                    </div>
                    <a class="tf-button style-1 w208" href="{{ route('admin.payment_methods.create') }}"><i
                            class="icon-plus"></i>Thêm mới</a>
                </div>
                <div class="wg-table table-product-list">
                    <ul class="table-title flex gap20 mb-14">
                        <li style="width:7%">
                            <div class="body-title">STT</div>
                        </li>
                        <li style="width:18%">
                            <div class="body-title">Tên</div>
                        </li>
                        <li style="width:15%">
                            <div class="body-title">Mã</div>
                        </li>
                        <li style="width:30%">
                            <div class="body-title">Mô tả</div>
                        </li>
                        <li style="width:12%">
                            <div class="body-title">Trạng thái</div>
                        </li>
                        <li style="width:18%">
                            <div class="body-title">Hành động</div>
                        </li>
                    </ul>
                    <ul class="flex flex-column">
                        @foreach ($methods as $method)
                            <li class="wg-product item-row gap20" style="align-items:center; display: flex;">
                                <div class="body-text" style="width:7%">
                                    {{ ($methods->currentPage() - 1) * $methods->perPage() + $loop->iteration }}
                                </div>

                                <div class="body-text fw-7" style="width:18%">{{ $method->name }}</div>

                                <div class="body-text" style="width:15%">{{ $method->code }}</div>

                                <div class="body-text" style="width:30%">{{ Str::limit($method->description, 40) }}</div>

                                <div class="body-text" style="width:12%">
                                    @if ($method->is_active)
                                        <span class="block-available bg-1 fw-7">Đang bật</span>
                                    @else
                                        <span class="block-stock bg-1 fw-7">Đang tắt</span>
                                    @endif
                                </div>

                                <div class="list-icon-function"
                                    style="width: 18%; display: flex; gap: 8px; align-items: center;">
                                    <form action="{{ route('admin.payment_methods.destroy', $method->id) }}" method="POST"
                                        style="display:inline;"
                                        onsubmit="return confirm('Bạn có chắc chắn muốn xóa phương thức thanh toán này?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            style="background: none; border: none; padding: 0; color: inherit; cursor: pointer; display: flex; align-items: center;">
                                            <i class="icon-trash-2" style="color: red; font-size: 20px;"></i>
                                        </button>
                                    </form>
                                    <a href="{{ route('admin.payment_methods.edit', $method->id) }}" class="item edit"
                                        style="background:none; border:none; padding:0; margin:0; cursor:pointer;">
                                        <i class="icon-edit-3" style="color:#22c55e;font-size:20px;"></i>
                                    </a>
                                    <form action="{{ route('admin.payment_methods.toggle', $method->id) }}" method="POST"
                                        style="display:inline-block;">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="item eye"
                                            style="background:none; border:none; padding:0; margin:0; cursor:pointer;">
                                            <i class="{{ $method->is_active ? 'icon-eye-off' : 'icon-eye' }}"
                                                style="color:#f59e0b;font-size:20px;"></i>
                                        </button>
                                    </form>
                                </div>
                            </li>
                        @endforeach
                    </ul>

                </div>
            </div>
        </div>
    </div>

    <style>
        .tf-button.custom-danger {
            background: #e3342f;
            border-color: #e3342f;
            color: #fff;
            transition: background 0.2s, border-color 0.2s;
        }

        .tf-button.custom-danger:hover,
        .tf-button.custom-danger:focus {
            background: #b91c1c;
            border-color: #b91c1c;
            color: #fff;
        }
    </style>
@endsection
