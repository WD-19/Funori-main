@extends('admin.layout.admin')

@section('title', 'Danh sách danh mục')

@section('content')
    <div class="main-content-inner">
        <!-- main-content-wrap -->
        <div class="main-content-wrap">
            <div class="w-100">
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
            </div>
            <div class="flex items-center flex-wrap justify-between gap20 mb-30">
                <h3>Tất cả danh mục</h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li>
                        <a href="#">
                            <div class="text-tiny">Dashboard</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <a href="#">
                            <div class="text-tiny">Danh mục</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">Tất cả danh mục</div>
                    </li>
                </ul>

            </div>
            <!-- all-category -->
            <div class="wg-box">
                <div class="flex items-center justify-between gap10 flex-wrap">
                    <div class="wg-filter flex-grow">
                        <form class="form-search flex gap10" method="GET" action="{{ route('admin.categories.index') }}">
                            <fieldset class="name">
                                <input type="text" placeholder="Tìm kiếm tên danh mục..." name="name"
                                    value="{{ request('name') }}">
                            </fieldset>
                            <fieldset>
                                <select name="is_active">
                                    <option value="">Trạng thái</option>
                                    <option value="1" {{ request('is_active') === '1' ? 'selected' : '' }}>Kích hoạt
                                    </option>
                                    <option value="0" {{ request('is_active') === '0' ? 'selected' : '' }}>Không kích
                                        hoạt</option>
                                </select>
                            </fieldset>
                            <div class="button-submit">
                                <button type="submit"><i class="icon-search"></i></button>
                            </div>
                        </form>
                    </div>
                    <a class="tf-button style-1 w208" href="{{ route('admin.categories.create') }}"><i
                            class="icon-plus"></i>Thêm mới</a>
                </div>
                <div class="wg-table table-all-attribute">
                    <thead>
                        <ul class="table-title flex gap20 mb-14">
                            <li>
                                <div class="body-title">ID</div>
                            </li>
                            <li>
                                <div class="body-title">Tên danh mục</div>
                            </li>
                            <li>
                                <div class="body-title">Ảnh</div>
                            </li>
                            <li>
                                <div class="body-title">Trạng thái</div>
                            </li>
                            <li>
                                <div class="body-title">Hành động</div>
                            </li>
                        </ul>
                    </thead>
                    <tbody>
                        <ul class="flex flex-column">
                            @if ($isSearching)
                                @foreach ($categories as $category)
                                    <li class="attribute-item item-row flex items-center justify-between gap20">
                                        <div class="body-text">{{ $category->id }}</div>
                                        <div class="name d-flex align-items-center">
                                            <span class="body-title-2">{{ $category->name }}</span>
                                        </div>
                                        <div class="body-text">
                                            @if ($category->image_url)
                                                <img src="{{ asset('storage/' . $category->image_url) }}" alt="Ảnh"
                                                    style="max-width:60px;max-height:60px;">
                                            @else
                                                Không có ảnh
                                            @endif
                                        </div>
                                        <div class="body-text">
                                            @if ($category->is_active)
                                                <span class="badge bg-success">Kích hoạt</span>
                                            @else
                                                <span class="badge bg-danger">Không kích hoạt</span>
                                            @endif
                                        </div>
                                        <div class="list-icon-function">

                                            <!-- Quick View Modal for Category Parent -->
                                            <div class="item eye" data-bs-toggle="modal"
                                                data-bs-target="#quickViewModalParent{{ $category->id }}">
                                                <i class="icon-eye"></i>
                                            </div>
                                            <div class="modal fade" id="quickViewModalParent{{ $category->id }}"
                                                tabindex="-1" aria-labelledby="quickViewLabelParent{{ $category->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                                    <div class="modal-content shadow-lg rounded-4 border-0"
                                                        style="font-size: 16px;">
                                                        <div class="modal-header bg-primary text-white">
                                                            <h3 class="modal-title fw-bold mb-0 text-light"
                                                                id="quickViewLabelParent{{ $category->id }}">
                                                                <i class="bi bi-info-circle me-2"></i>Chi
                                                                tiết danh mục
                                                            </h3>
                                                            <button type="button" class="btn-close btn-close-white"
                                                                data-bs-dismiss="modal" aria-label="Đóng"></button>
                                                        </div>
                                                        <div class="modal-body px-5 py-4">
                                                            <div class="row gy-3">
                                                                <div class="col-sm-6">
                                                                    <strong>Tên danh mục:</strong>
                                                                    <div class="text-muted">
                                                                        {{ $category->name }}</div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <strong>Slug:</strong>
                                                                    <div class="text-muted">
                                                                        {{ $category->slug }}</div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <strong>Danh mục cha:</strong>
                                                                    <div class="text-muted">
                                                                        {{ $category->parent ? $category->parent->name : 'Không có' }}
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <strong>Trạng thái:</strong>
                                                                    @if ($category->is_active)
                                                                        <span class="badge bg-success">Kích
                                                                            hoạt</span>
                                                                    @else
                                                                        <span class="badge bg-danger">Không
                                                                            kích hoạt</span>
                                                                    @endif
                                                                </div>
                                                                <div class="col-12">
                                                                    <strong>Mô tả:</strong>
                                                                    <div class="text-muted">
                                                                        {{ $category->description ?? '(Không có mô tả)' }}
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <strong>Ảnh:</strong><br>
                                                                    @if ($category->image_url)
                                                                        <img src="{{ asset('storage/' . $category->image_url) }}"
                                                                            alt="Ảnh"
                                                                            style="max-width:120px;max-height:120px;">
                                                                    @else
                                                                        <span class="text-muted">Không có
                                                                            ảnh</span>
                                                                    @endif
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <strong>Ngày tạo:</strong>
                                                                    <div class="text-muted">
                                                                        {{ $category->created_at }}</div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <strong>Ngày cập nhật:</strong>
                                                                    <div class="text-muted">
                                                                        {{ $category->updated_at }}</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Quick View Modal for Category Parent -->

                                            <a href="{{ route('admin.categories.edit', $category->id) }}"><i
                                                    class="icon-edit-3"></i></a>
                                            <form action="{{ route('admin.categories.destroy', $category->id) }}"
                                                method="POST" style="display:inline;"
                                                onclick="return confirm('Xóa danh mục này??');">
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
                            @else
                                @foreach ($categories as $category)
                                    <li class="attribute-item item-row flex items-center justify-between gap20
                                        {{ request('new_id') == $category->id ? 'bg-warning bg-opacity-25 border border-warning' : '' }}"
                                        style="align-items: flex-start;">
                                        <div class="body-text">{{ $category->id }}</div>
                                        <div class="name d-flex align-items-center">
                                            @if ($category->children->count())
                                                <button class="btn btn-sm btn-outline-secondary me-2" type="button"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#collapseChildren{{ $category->id }}"
                                                    aria-expanded="false"
                                                    aria-controls="collapseChildren{{ $category->id }}">
                                                    <i class="bi bi-chevron-down"></i>
                                                </button>
                                            @endif
                                            <span class="body-title-2">{{ $category->name }}</span>
                                        </div>
                                        <div class="body-text">
                                            @if ($category->image_url)
                                                <img src="{{ asset('storage/' . $category->image_url) }}" alt="Ảnh"
                                                    style="max-width:60px;max-height:60px;">
                                            @else
                                                Không có ảnh
                                            @endif
                                        </div>
                                        <div class="body-text">
                                            @if ($category->is_active)
                                                <span class="badge bg-success">Kích hoạt</span>
                                            @else
                                                <span class="badge bg-danger">Không kích hoạt</span>
                                            @endif
                                        </div>
                                        <div class="list-icon-function">

                                            <!-- Quick View Modal for Category Parent -->
                                            <div class="item eye" data-bs-toggle="modal"
                                                data-bs-target="#quickViewModalParent{{ $category->id }}">
                                                <i class="icon-eye"></i>
                                            </div>
                                            <div class="modal fade" id="quickViewModalParent{{ $category->id }}"
                                                tabindex="-1" aria-labelledby="quickViewLabelParent{{ $category->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                                    <div class="modal-content shadow-lg rounded-4 border-0"
                                                        style="font-size: 16px;">
                                                        <div class="modal-header bg-primary text-white">
                                                            <h3 class="modal-title fw-bold mb-0 text-light"
                                                                id="quickViewLabelParent{{ $category->id }}">
                                                                <i class="bi bi-info-circle me-2"></i>Chi
                                                                tiết danh mục
                                                            </h3>
                                                            <button type="button" class="btn-close btn-close-white"
                                                                data-bs-dismiss="modal" aria-label="Đóng"></button>
                                                        </div>
                                                        <div class="modal-body px-5 py-4">
                                                            <div class="row gy-3">
                                                                <div class="col-sm-6">
                                                                    <strong>Tên danh mục:</strong>
                                                                    <div class="text-muted">
                                                                        {{ $category->name }}</div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <strong>Slug:</strong>
                                                                    <div class="text-muted">
                                                                        {{ $category->slug }}</div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <strong>Danh mục cha:</strong>
                                                                    <div class="text-muted">
                                                                        {{ $category->parent ? $category->parent->name : 'Không có' }}
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <strong>Trạng thái:</strong>
                                                                    @if ($category->is_active)
                                                                        <span class="badge bg-success">Kích
                                                                            hoạt</span>
                                                                    @else
                                                                        <span class="badge bg-danger">Không
                                                                            kích hoạt</span>
                                                                    @endif
                                                                </div>
                                                                <div class="col-12">
                                                                    <strong>Mô tả:</strong>
                                                                    <div class="text-muted">
                                                                        {{ $category->description ?? '(Không có mô tả)' }}
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <strong>Ảnh:</strong><br>
                                                                    @if ($category->image_url)
                                                                        <img src="{{ asset('storage/' . $category->image_url) }}"
                                                                            alt="Ảnh"
                                                                            style="max-width:120px;max-height:120px;">
                                                                    @else
                                                                        <span class="text-muted">Không có
                                                                            ảnh</span>
                                                                    @endif
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <strong>Ngày tạo:</strong>
                                                                    <div class="text-muted">
                                                                        {{ $category->created_at }}</div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <strong>Ngày cập nhật:</strong>
                                                                    <div class="text-muted">
                                                                        {{ $category->updated_at }}</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Quick View Modal for Category Parent -->

                                            <a href="{{ route('admin.categories.edit', $category->id) }}"><i
                                                    class="icon-edit-3"></i></a>
                                            <form action="{{ route('admin.categories.destroy', $category->id) }}"
                                                method="POST" style="display:inline;"
                                                onclick="return confirm('Xóa danh mục này??');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    style="background: none; border: none; padding: 0; color: inherit; cursor: pointer; display: flex; align-items: center;">
                                                    <i class="icon-trash-2" style="color: red; font-size: 20px;"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </li>
                                    @if ($category->children->count())
                                        <li class="collapse" id="collapseChildren{{ $category->id }}">
                                            <ul class="ms-5">
                                                @foreach ($category->children as $child)
                                                    <li
                                                        class="attribute-item item-row flex items-center justify-between gap20
                                                        {{ request('new_id') == $child->id ? 'bg-warning bg-opacity-25 border border-warning' : '' }}">
                                                        <div class="body-text">{{ $child->id }}</div>
                                                        <div class="name">
                                                            <span class="body-title-2">{{ $child->name }}</span>
                                                        </div>
                                                        <div class="body-text">
                                                            @if ($child->image_url)
                                                                <img src="{{ asset('storage/' . $child->image_url) }}"
                                                                    alt="Ảnh"
                                                                    style="max-width:60px;max-height:60px;">
                                                            @else
                                                                Không có ảnh
                                                            @endif
                                                        </div>
                                                        <div class="body-text">
                                                            @if ($child->is_active)
                                                                <span class="badge bg-success">Kích hoạt</span>
                                                            @else
                                                                <span class="badge bg-danger">Không kích hoạt</span>
                                                            @endif
                                                        </div>
                                                        <div class="list-icon-function">

                                                            <!-- Quick View Modal for Child Parent -->
                                                            <div class="item eye" data-bs-toggle="modal"
                                                                data-bs-target="#quickViewModalParent{{ $child->id }}">
                                                                <i class="icon-eye"></i>
                                                            </div>
                                                            <div class="modal fade"
                                                                id="quickViewModalParent{{ $child->id }}"
                                                                tabindex="-1"
                                                                aria-labelledby="quickViewLabelParent{{ $child->id }}"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                                                    <div class="modal-content shadow-lg rounded-4 border-0"
                                                                        style="font-size: 16px;">
                                                                        <div class="modal-header bg-primary text-white">
                                                                            <h3 class="modal-title fw-bold mb-0 text-light"
                                                                                id="quickViewLabelParent{{ $child->id }}">
                                                                                <i class="bi bi-info-circle me-2"></i>Chi
                                                                                tiết danh mục
                                                                            </h3>
                                                                            <button type="button"
                                                                                class="btn-close btn-close-white"
                                                                                data-bs-dismiss="modal"
                                                                                aria-label="Đóng"></button>
                                                                        </div>
                                                                        <div class="modal-body px-5 py-4">
                                                                            <div class="row gy-3">
                                                                                <div class="col-sm-6">
                                                                                    <strong>Tên danh mục:</strong>
                                                                                    <div class="text-muted">
                                                                                        {{ $child->name }}</div>
                                                                                </div>
                                                                                <div class="col-sm-6">
                                                                                    <strong>Slug:</strong>
                                                                                    <div class="text-muted">
                                                                                        {{ $child->slug }}</div>
                                                                                </div>
                                                                                <div class="col-sm-6">
                                                                                    <strong>Danh mục cha:</strong>
                                                                                    <div class="text-muted">
                                                                                        {{ $child->parent ? $child->parent->name : 'Không có' }}
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-6">
                                                                                    <strong>Trạng thái:</strong>
                                                                                    @if ($child->is_active)
                                                                                        <span class="badge bg-success">Kích
                                                                                            hoạt</span>
                                                                                    @else
                                                                                        <span class="badge bg-danger">Không
                                                                                            kích hoạt</span>
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-12">
                                                                                    <strong>Mô tả:</strong>
                                                                                    <div class="text-muted">
                                                                                        {{ $child->description ?? '(Không có mô tả)' }}
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-12">
                                                                                    <strong>Ảnh:</strong><br>
                                                                                    @if ($child->image_url)
                                                                                        <img src="{{ asset('storage/' . $child->image_url) }}"
                                                                                            alt="Ảnh"
                                                                                            style="max-width:120px;max-height:120px;">
                                                                                    @else
                                                                                        <span class="text-muted">Không có
                                                                                            ảnh</span>
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-sm-6">
                                                                                    <strong>Ngày tạo:</strong>
                                                                                    <div class="text-muted">
                                                                                        {{ $child->created_at }}</div>
                                                                                </div>
                                                                                <div class="col-sm-6">
                                                                                    <strong>Ngày cập nhật:</strong>
                                                                                    <div class="text-muted">
                                                                                        {{ $child->updated_at }}</div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- End Quick View Modal for Child Parent -->

                                                            <a href="{{ route('admin.categories.edit', $child->id) }}"><i
                                                                    class="icon-edit-3"></i></a>
                                                            <form
                                                                action="{{ route('admin.categories.destroy', $child->id) }}"
                                                                method="POST" style="display:inline;"
                                                                onclick="return confirm('Xóa danh mục này??');">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    style="background: none; border: none; padding: 0; color: inherit; cursor: pointer; display: flex; align-items: center;">
                                                                    <i class="icon-trash-2"
                                                                        style="color: red; font-size: 20px;"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @endif
                                @endforeach
                            @endif
                        </ul>
                    </tbody>
                </div>
                <div class="divider"></div>
                <div class="flex items-center justify-between flex-wrap gap10 mt-3">
                    <div class="text-tiny">
                        Showing {{ $categories->firstItem() }} to {{ $categories->lastItem() }} of
                        {{ $categories->total() }} entries
                    </div>
                    <ul class="wg-pagination">
                        {{-- Previous Page --}}
                        <li>
                            <a href="{{ $categories->previousPageUrl() ?? '#' }}" {!! $categories->onFirstPage() ? 'class=disabled' : '' !!}>
                                <i class="icon-chevron-left"></i>
                            </a>
                        </li>
                        {{-- Page Numbers --}}
                        @for ($i = 1; $i <= $categories->lastPage(); $i++)
                            <li class="{{ $categories->currentPage() == $i ? 'active' : '' }}">
                                <a href="{{ $categories->url($i) }}">{{ $i }}</a>
                            </li>
                        @endfor
                        {{-- Next Page --}}
                        <li>
                            <a href="{{ $categories->nextPageUrl() ?? '#' }}" {!! $categories->currentPage() == $categories->lastPage() ? 'class=disabled' : '' !!}>
                                <i class="icon-chevron-right"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- /all-category -->
        </div>
        <!-- /main-content-wrap -->
    </div>
    {{-- <div class="container mt-4">
    <h2 class="mb-4">Danh sách danh mục</h2>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Tên danh mục</th>
                    <th>Danh mục cha</th>
                    <th>Trạng thái</th>
                    <th>Hình ảnh</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>
                            <strong>{{ str_repeat('*', $category->depth ?? 0) }}{{ $category->name }}</strong>
                        </td>
                        <td>{{ $category->parent ? $category->parent->name : 'Không có' }}</td>
                        <td>{{ $category->is_active ? 'Kích hoạt' : 'Không kích hoạt' }}</td>
                        <td>{{ $category->image_url }}</td>
                        <td>
                            <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-sm btn-primary">Sửa</a>
                            <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Xóa danh mục này?')">Xóa</button>
                            </form>
                        </td>
                    </tr>
                    @foreach ($category->children as $child)
                        <tr>
                            <td>
                                <strong>{{ str_repeat('*', $child->depth ?? 1) }}{{ $child->name }}</strong>
                            </td>
                            <td>{{ $child->parent ? $child->parent->name : 'Không có' }}</td>
                            <td>{{ $child->is_active ? 'Kích hoạt' : 'Không kích hoạt' }}</td>
                            <td>{{ $child->image_url }}</td>
                            <td>
                                <a href="{{ route('admin.categories.edit', $child->id) }}" class="btn btn-sm btn-primary">Sửa</a>
                                <form action="{{ route('admin.categories.destroy', $child->id) }}" method="POST" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Xóa danh mục này?')">Xóa</button>
                                </form>
                            </td>
                    </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
        <div>
            {{ $categories->links() }}
        </div>
    </div>
</div> --}}

@endsection
