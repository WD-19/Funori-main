@extends('admin.layout.admin')

@section('title', 'Danh sách thương hiệu')

@section('content')
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-30">
                <h3>Tất cả thương hiệu</h3>
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
                        <a href="{{ route('admin.brands.index') }}">
                            <div class="text-tiny">Thương hiệu</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">Danh sách thương hiệu</div>
                    </li>
                </ul>

            </div>
            <div class="wg-box">
                <div class="title-box">
                    <i class="icon-layers"></i>
                    <div class="body-text">Quản lý các thương hiệu của bạn tại đây. Bạn có thể chỉnh sửa, ẩn/hiện hoặc xóa
                        thương hiệu theo nhu cầu.</div>
                </div>
                <div class="flex items-center justify-between gap10 flex-wrap" style="min-width: max-content;">
                    <div class="wg-filter flex-grow">
                        <form class="form-search flex gap10" method="GET" action="#">
                            <fieldset class="name">
                                <input type="text" placeholder="Tìm kiếm tên thương hiệu..." name="name"
                                    value="{{ request('name') }}">
                            </fieldset>
                            <div class="button-submit">
                                <button type="submit"><i class="icon-search"></i></button>
                            </div>
                        </form>
                    </div>
                    <a class="tf-button style-1 w208" href="{{ route('admin.brands.create') }}"><i
                            class="icon-plus"></i>Thêm mới</a>
                </div>
                <div class="wg-table table-product-list" style="overflow-x:auto; width:100%;">
                    <ul class="table-title flex gap20 mb-14" style="min-width: max-content;">
                        <li style="width:5%">
                            <div class="body-title">ID</div>
                        </li>
                        <li style="width:25%">
                            <div class="body-title">Tên</div>
                        </li>
                        <li style="width:25%">
                            <div class="body-title">Slug</div>
                        </li>
                        <li style="width:15%">
                            <div class="body-title">Logo</div>
                        </li>
                        <li style="width:10%">
                            <div class="body-title">Trạng thái</div>
                        </li>
                        <li style="width:20%">
                            <div class="body-title">Hành động</div>
                        </li>
                    </ul>
                    <ul class="flex flex-column">
                        @foreach ($brands as $brand)
                            <li class="wg-product item-row gap20" style="align-items:center;">
                                <div class="body-text" style="width:5%">{{ $brand->id }}</div>
                                <div class="body-text fw-7" style="width:25%">{{ $brand->name }}</div>
                                <div class="body-text" style="width:25%">{{ $brand->slug }}</div>
                                <div class="body-text" style="width:15%">
                                    @if ($brand->logo_url)
                                        <img src="{{ Storage::url($brand->logo_url) }}" alt="Logo" width="60">
                                    @else
                                        <span class="text-muted">Không có</span>
                                    @endif
                                </div>
                                <div style="width:10%">
                                    @if ($brand->is_active)
                                        <span class="block-available bg-1 fw-7">Hiện</span>
                                    @else
                                        <span class="block-stock bg-1 fw-7">Ẩn</span>
                                    @endif
                                </div>
                                <div class="list-icon-function" style="width: 20%; display: flex; gap: 16px; align-items: center;">
                                    <form action="{{ route('admin.brands.toggle', $brand) }}" method="POST"
                                        style="display:inline-block;">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="item eye"
                                            style="background:none; border:none; padding:0; margin:0; cursor:pointer;">
                                            <i class="{{ $brand->is_active ? 'icon-eye-off' : 'icon-eye' }}"></i>
                                        </button>
                                    </form>
                                    <a href="{{ route('admin.brands.edit', $brand) }}" class="item edit"><i
                                            class="icon-edit-3"></i></a>
                                    <div class="item trash">
                                        <form action="{{ route('admin.brands.destroy', $brand) }}" method="POST"
                                            style="display:inline;"
                                            onsubmit="return confirm('Bạn có chắc chắn muốn xóa thương hiệu này?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                style="background: none; border: none; padding: 0; color: inherit; cursor: pointer; display: flex; align-items: center;">
                                                <i class="icon-trash-2" style="color: red; font-size: 20px;"></i>
                                            </button>
                                        </form>
                                    </div>
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
