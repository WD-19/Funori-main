@extends('admin.layout.admin')

@section('title', 'Danh sách danh mục')

@section('content')
<div class="main-content-inner">
    <!-- main-content-wrap -->
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-30">
            <h3>All Category</h3>
            {{-- <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                <li>
                    <a href="index.html"><div class="text-tiny">Dashboard</div></a>
                </li>
                <li>
                    <i class="icon-chevron-right"></i>
                </li>
                <li>
                    <a href="#"><div class="text-tiny">Product</div></a>
                </li>
                <li>
                    <i class="icon-chevron-right"></i>
                </li>
                <li>
                    <div class="text-tiny">All category</div>
                </li>
            </ul> --}}
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
        </div>
        <!-- all-category -->
        <div class="wg-box">
            <div class="flex items-center justify-between gap10 flex-wrap">
                <div class="wg-filter flex-grow">
                    <div class="show">
                        <div class="text-tiny">Showing</div>
                        <div class="select">
                            <select class="">
                                <option>10</option>
                                <option>20</option>
                                <option>30</option>
                            </select>
                        </div>
                        <div class="text-tiny">entries</div>
                    </div>
                    <form class="form-search">
                        <fieldset class="name">
                            <input type="text" placeholder="Search here..." class="" name="name" tabindex="2" value="" aria-required="true" required="">
                        </fieldset>
                        <div class="button-submit">
                            <button class="" type="submit"><i class="icon-search"></i></button>
                        </div>
                    </form>
                </div>
                <a class="tf-button style-1 w208" href="add-attributes.html"><i class="icon-plus"></i>Add new</a>
            </div>
            <div class="wg-table table-all-attribute">
                <ul class="table-title flex gap20 mb-14">
                    <li>
                        <div class="body-title">Category name</div>
                    </li>    
                    <li>
                        <div class="body-title">Parent Category</div>
                    </li>
                    <li>
                        <div class="body-title">Status</div>
                    </li>
                    <li>
                        <div class="body-title">Image</div>
                    </li>
                    <li>
                        <div class="body-title">Action</div>
                    </li>
                </ul>
                <ul class="flex flex-column">
                    <li class="attribute-item item-row flex items-center justify-between gap20">
                        <div class="name">
                            <a href="add-attributes.html" class="body-title-2">Color</a>
                        </div>
                        <div class="body-text">Blue, green, white</div>
                        <div class="list-icon-function">
                            <div class="item eye">
                                <i class="icon-eye"></i>
                            </div>
                            <div class="item edit">
                                <i class="icon-edit-3"></i>
                            </div>
                            <div class="item trash">
                                <i class="icon-trash-2"></i>
                            </div>
                        </div>
                    </li>
                    <li class="attribute-item item-row flex items-center justify-between gap20">
                        <div class="name">
                            <a href="add-attributes.html" class="body-title-2">Size</a>
                        </div>
                        <div class="body-text">S, M, L, XL</div>
                        <div class="list-icon-function">
                            <div class="item eye">
                                <i class="icon-eye"></i>
                            </div>
                            <div class="item edit">
                                <i class="icon-edit-3"></i>
                            </div>
                            <div class="item trash">
                                <i class="icon-trash-2"></i>
                            </div>
                        </div>
                    </li>
                    <li class="attribute-item item-row flex items-center justify-between gap20">
                        <div class="name">
                            <a href="add-attributes.html" class="body-title-2">Material</a>
                        </div>
                        <div class="body-text">Cotton, Polyster</div>
                        <div class="list-icon-function">
                            <div class="item eye">
                                <i class="icon-eye"></i>
                            </div>
                            <div class="item edit">
                                <i class="icon-edit-3"></i>
                            </div>
                            <div class="item trash">
                                <i class="icon-trash-2"></i>
                            </div>
                        </div>
                    </li>
                    <li class="attribute-item item-row flex items-center justify-between gap20">
                        <div class="name">
                            <a href="add-attributes.html" class="body-title-2">Style</a>
                        </div>
                        <div class="body-text">Classic, mordern, ethnic, western</div>
                        <div class="list-icon-function">
                            <div class="item eye">
                                <i class="icon-eye"></i>
                            </div>
                            <div class="item edit">
                                <i class="icon-edit-3"></i>
                            </div>
                            <div class="item trash">
                                <i class="icon-trash-2"></i>
                            </div>
                        </div>
                    </li>
                    <li class="attribute-item item-row flex items-center justify-between gap20">
                        <div class="name">
                            <a href="add-attributes.html" class="body-title-2">Meat Type</a>
                        </div>
                        <div class="body-text">Fresh, Frozen, Marinated</div>
                        <div class="list-icon-function">
                            <div class="item eye">
                                <i class="icon-eye"></i>
                            </div>
                            <div class="item edit">
                                <i class="icon-edit-3"></i>
                            </div>
                            <div class="item trash">
                                <i class="icon-trash-2"></i>
                            </div>
                        </div>
                    </li>
                    <li class="attribute-item item-row flex items-center justify-between gap20">
                        <div class="name">
                            <a href="add-attributes.html" class="body-title-2">Weight</a>
                        </div>
                        <div class="body-text">1kg, 2kg, 3kg, over 5kg</div>
                        <div class="list-icon-function">
                            <div class="item eye">
                                <i class="icon-eye"></i>
                            </div>
                            <div class="item edit">
                                <i class="icon-edit-3"></i>
                            </div>
                            <div class="item trash">
                                <i class="icon-trash-2"></i>
                            </div>
                        </div>
                    </li>
                    <li class="attribute-item item-row flex items-center justify-between gap20">
                        <div class="name">
                            <a href="add-attributes.html" class="body-title-2">Packaging</a>
                        </div>
                        <div class="body-text">Plastic box, paper, nylon, tin cans</div>
                        <div class="list-icon-function">
                            <div class="item eye">
                                <i class="icon-eye"></i>
                            </div>
                            <div class="item edit">
                                <i class="icon-edit-3"></i>
                            </div>
                            <div class="item trash">
                                <i class="icon-trash-2"></i>
                            </div>
                        </div>
                    </li>
                    <li class="attribute-item item-row flex items-center justify-between gap20">
                        <div class="name">
                            <a href="add-attributes.html" class="body-title-2">Kind of food</a>
                        </div>
                        <div class="body-text">Dried food, wet food, supplementary food</div>
                        <div class="list-icon-function">
                            <div class="item eye">
                                <i class="icon-eye"></i>
                            </div>
                            <div class="item edit">
                                <i class="icon-edit-3"></i>
                            </div>
                            <div class="item trash">
                                <i class="icon-trash-2"></i>
                            </div>
                        </div>
                    </li>
                    <li class="attribute-item item-row flex items-center justify-between gap20">
                        <div class="name">
                            <a href="add-attributes.html" class="body-title-2">Milk</a>
                        </div>
                        <div class="body-text">Formula milk, fresh milk</div>
                        <div class="list-icon-function">
                            <div class="item eye">
                                <i class="icon-eye"></i>
                            </div>
                            <div class="item edit">
                                <i class="icon-edit-3"></i>
                            </div>
                            <div class="item trash">
                                <i class="icon-trash-2"></i>
                            </div>
                        </div>
                    </li>
                    <li class="attribute-item item-row flex items-center justify-between gap20">
                        <div class="name">
                            <a href="add-attributes.html" class="body-title-2">Combo</a>
                        </div>
                        <div class="body-text">Cat food, dog food</div>
                        <div class="list-icon-function">
                            <div class="item eye">
                                <i class="icon-eye"></i>
                            </div>
                            <div class="item edit">
                                <i class="icon-edit-3"></i>
                            </div>
                            <div class="item trash">
                                <i class="icon-trash-2"></i>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="divider"></div>
            {{ $categories->links() }}
        </div>
        <!-- /all-category -->
    </div>
    <!-- /main-content-wrap -->
</div>
<div class="container mt-4">
    <h2 class="mb-4">Danh sách danh mục</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
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
                @foreach($categories as $category)
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
</div>

@endsection