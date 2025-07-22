@extends('client.profile.profile_base')

@section('page_title', 'Yêu thích')

@section('content_profile')
    <div class="my-account-content account-wishlist">
        <form method="GET" class="mb-4 row g-2 align-items-center" style="max-width: 600px;">
            <div class="col">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Tìm kiếm sản phẩm yêu thích...">
            </div>
            <div class="col-auto">
                <select name="sort" class="form-select">
                    <option value="">Sắp xếp</option>
                    <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Mới nhất</option>
                </select>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-warning d-flex align-items-center gap-1" style="background:#fcad02;color:#fff;">
                    <i class="fa fa-search"></i> <span>Tìm kiếm</span>
                </button>
            </div>
            {{-- <div class="col-auto">
                <a href="{{ route('client.profile.wishlist') }}" class="btn btn-outline-secondary d-flex align-items-center gap-1">
                    <i class="fa fa-rotate-left"></i> <span>Đặt lại</span>
                </a>
            </div> --}}
        </form>
        <div class="grid-layout wrapper-shop" data-grid="grid-3">
            <!-- card product 1 -->
            @foreach($wishlistItems as $item)
            <div class="card-product">
                <div class="card-product-wrapper">
                    <a href="{{ route('client.product.show', $item->product->slug) }}" class="product-img">
                        <img class="lazyload img-product" src="{{ $item->product->images->first() ? asset($item->product->images->first()->image_url) : asset('images/no-image.png') }}" alt="image-product">
                        @if($item->product->images->get(1))
                            <img class="lazyload img-hover" src="{{ asset($item->product->images->get(1)->image_url) }}" alt="image-product">
                        @endif
                    </a>
                    <div class="list-product-btn absolute-2 ">
                        <a href="#quick_add" data-bs-toggle="modal" class="box-icon bg_white quick-add tf-btn-loading justify-content-center">
                            <span class="icon icon-bag "></span>
                            <span class="tooltip">Quick Add</span>
                        </a>
                        <form action="{{ route('client.wishlist.remove') }}" method="POST" class="form-remove-wishlist" style="display:inline;">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $item->product->id }}">
                            <button type="submit" class="box-icon bg_white wishlist btn-icon-action  justify-content-center btn-remove-wishlist" style="background:none;border:none;padding:0;cursor:pointer;">
                                <span class="icon icon-heart "></span>
                                <span class="tooltip">Remove from Wishlist</span>
                                <span class="icon icon-delete"></span>
                            </button>
                        </form>
                        <a href="#compare" data-bs-toggle="offcanvas" aria-controls="offcanvasLeft" class="box-icon bg_white compare btn-icon-action justify-content-center">
                            <span class="icon icon-compare"></span>
                            <span class="tooltip">Add to Compare</span>
                            <span class="icon icon-check"></span>
                        </a>
                        <a href="#quick_view" data-bs-toggle="modal" class="box-icon bg_white quickview tf-btn-loading justify-content-center">
                            <span class="icon icon-view"></span>
                            <span class="tooltip">Quick View</span>
                        </a>
                    </div>
                </div>
                <div class="card-product-info">
                    <a href="{{ route('client.product.show', $item->product->slug) }}" class="title link">{{ $item->product->name }}</a>
                    <span class="price">{{ number_format($item->product->regular_price, 0, ',', '.') }} đ</span>
                </div>
            </div>
            @endforeach
            <!-- end card product -->
        </div>
        @if($wishlistItems instanceof \Illuminate\Pagination\LengthAwarePaginator)
            <div class="mt-4 d-flex justify-content-center">
                {{ $wishlistItems->links() }}
            </div>
        @endif
    </div>
    @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                toastr.options.positionClass = 'toast-top-right';
                toastr.success("{{ session('success') }}");
                var toastEls = document.querySelectorAll('.toast-success');
                toastEls.forEach(function(el){el.style.backgroundColor = '#fcad02'; el.style.color = '#fff';});
            });
        </script>
    @endif
    @if(session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                toastr.options.positionClass = 'toast-top-right';
                toastr.error("{{ session('error') }}");
            });
        </script>
    @endif
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.form-remove-wishlist').forEach(function(form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            var card = form.closest('.card-product');
            var formData = new FormData(form);
            fetch(form.action, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    toastr.options.positionClass = 'toast-top-right';
                    toastr.success('Đã xóa khỏi yêu thích!');
                    card.remove();
                } else {
                    toastr.options.positionClass = 'toast-top-right';
                    toastr.error(data.message || 'Lỗi!');
                }
            })
            .catch(error => {
                toastr.options.positionClass = 'toast-top-right';
                toastr.error('Lỗi!');
                console.error(error);
            });
        });
    });
});
</script>
@endsection
