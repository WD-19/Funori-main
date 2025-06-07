@extends('admin.layout.admin')

@section('content')
    <div class="main-content-inner">
        <!-- main-content-wrap -->
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-30">
                <h3>Contact List</h3>
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
                            <div class="text-tiny">Contact</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">Contact List</div>
                    </li>
                </ul>
            </div>
            <!-- order-list -->
            <div class="wg-box">
                <div class="flex items-center justify-between gap10 flex-wrap">
                    <div class="wg-filter flex-grow">
                        <form class="form-search flex gap10" method="GET">
                            <fieldset class="name">
                                <input type="text" placeholder="Search name or email..." name="keyword"
                                    value="{{ request('keyword') }}">
                            </fieldset>
                            <fieldset>
                                <select name="status">
                                    <option value="">All Status</option>
                                    <option value="new" {{ request('status') == 'new' ? 'selected' : '' }}>New</option>
                                    <option value="read" {{ request('status') == 'read' ? 'selected' : '' }}>Read</option>
                                    <option value="replied" {{ request('status') == 'replied' ? 'selected' : '' }}>Replied
                                    </option>
                                    <option value="resolved" {{ request('status') == 'resolved' ? 'selected' : '' }}>
                                        Resolved</option>
                                </select>
                            </fieldset>
                            <div class="button-submit">
                                <button type="submit"><i class="icon-search"></i></button>
                            </div>
                        </form>
                    </div>
                    <a class="tf-button style-1 w208" href="#">
                        {{-- <a class="tf-button style-1 w208" href="{{ route('admin.reviews.export') }}"> --}}
                        <i class="icon-file-text"></i>Export all order
                    </a>
                </div>
                <div class="wg-table table-all-category">
                    <ul class="table-title flex gap20 mb-14">
                        <li>
                            <div class="body-title">Order ID</div>
                        </li>
                        <li>
                            <div class="body-title">Product ID</div>
                        </li>
                        <li>
                            <div class="body-title">Product Variant ID</div>
                        </li>
                        <li>
                            <div class="body-title">Product Name</div>
                        </li>
                        <li>
                            <div class="body-title">Variant Attribute</div>
                        </li>
                        <li>
                            <div class="body-title">Quantity</div>
                        </li>
                        <li>
                            <div class="body-title">Subtotal</div>
                        </li>
                        <li>
                            <div class="body-title">Created At</div>
                        </li>
                        <li>
                            <div class="body-title">Action</div>
                        </li>
                    </ul>
                    <ul class="flex flex-column">
                        @foreach ($reviews as $value)
                            <li class="wg-product item-row gap20">
                                <div class="body-text text-main-dark mt-4">
                                    {{ $value->order_id }}
                                </div>
                                <div class="body-text text-main-dark mt-4">
                                    {{ $value->product_id }}
                                </div>
                                <div class="body-text text-main-dark mt-4">
                                    {{ $value->product_variant_id ?? 'N/A' }}
                                </div>
                                <div class="body-text text-main-dark mt-4">
                                    {{ $value->product ? $value->product->name : $value->product_id }}
                                </div>
                                <div class="body-text text-main-dark mt-4">
                                    @if ($value->variant_attributes)
                                        @php $attrs = is_array($value->variant_attributes) ? $value->variant_attributes : json_decode($value->variant_attributes, true); @endphp
                                        @foreach ($attrs as $key => $val)
                                            <span>{{ $key }}: {{ $val }}</span>
                                            @if (!$loop->last)
                                                ,
                                            @endif
                                        @endforeach
                                    @else
                                        N/A
                                    @endif
                                </div>
                                <div class="body-text text-main-dark mt-4">
                                    {{ $value->quantity }}
                                </div>
                                <div class="body-text text-main-dark mt-4">
                                    {{ number_format($value->subtotal, 2) }}
                                </div>
                                <div class="body-text text-main-dark mt-4">
                                    {{ $value->created_at ? \Carbon\Carbon::parse($value->created_at)->format('d-m-Y H:i') : '' }}
                                </div>
                                <div class="list-icon-function">
                                    <div class="item edit">
                                        <a href="{{ route('admin.reviews.edit', $value->id) }}"><i
                                                class="icon-edit-3"></i></a>
                                    </div>
                                    <div class="item trash">
                                        <form action="{{ route('admin.reviews.destroy', $value->id) }}" method="POST"
                                            style="display:inline;"
                                            onsubmit="return confirm('Are you sure you want to delete this review?');">
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
                <div class="divider"></div>
                <div class="flex items-center justify-between flex-wrap gap10">
                    <div class="text-tiny">
                        Hiển thị {{ $reviews->firstItem() }} đến {{ $reviews->lastItem() }} trong tổng số
                        {{ $reviews->total() }} bản ghi
                    </div>

                    <ul class="wg-pagination">
                        {{-- Previous Page Link --}}
                        <li class="{{ $reviews->onFirstPage() ? 'disabled' : '' }}">
                            <a href="{{ $reviews->previousPageUrl() ?? '#' }}">
                                <i class="icon-chevron-left"></i>
                            </a>
                        </li>

                        {{-- Pagination Elements --}}
                        @for ($i = 1; $i <= $reviews->lastPage(); $i++)
                            <li class="{{ $reviews->currentPage() == $i ? 'active' : '' }}">
                                <a href="{{ $reviews->url($i) }}">{{ $i }}</a>
                            </li>
                        @endfor

                        {{-- Next Page Link --}}
                        <li class="{{ $reviews->hasMorePages() ? '' : 'disabled' }}">
                            <a href="{{ $reviews->nextPageUrl() ?? '#' }}">
                                <i class="icon-chevron-right"></i>
                            </a>
                        </li>
                    </ul>
                </div>

            </div>
            <!-- /order-list -->
        </div>
        <!-- /main-content-wrap -->
    </div>
@endsection
