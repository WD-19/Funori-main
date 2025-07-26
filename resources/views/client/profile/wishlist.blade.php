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
        <div class="all-box-new-product" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px;">
            @foreach ($wishlistItems as $item)
                <div class="new-product-1" style="min-width: 280px; max-width: 320px; flex: 1 1 300px;">
                    <div class="pic-product-1">
                        <a href="{{ route('client.product.show', $item->product->slug) }}">
                            <img src="{{ $item->product->images->first() ? asset($item->product->images->first()->image_url) : asset('images/no-image.png') }}"
                                alt="{{ $item->product->name }}"
                                onmouseover="this.src='{{ $item->product->images->get(1) ? asset($item->product->images->get(1)->image_url) : asset($item->product->images->first() ? $item->product->images->first()->image_url : 'images/no-image.png') }}'"
                                onmouseout="this.src='{{ $item->product->images->first() ? asset($item->product->images->first()->image_url) : asset('images/no-image.png') }}'">
                        </a>
                        <div class="box-icon-new-product">
                            <form action="{{ route('client.wishlist.remove') }}" method="POST" class="form-remove-wishlist" style="display:inline;">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $item->product->id }}">
                                <button type="submit" class="wishlist-btn" data-product-id="{{ $item->product->id }}"
                                    style="background:none;border:none;padding:0;cursor:pointer;">
                                    <i style="font-size: 18px; color:red;" class="fa-solid fa-heart" id="heart-Product"></i>
                                </button>
                            </form>
                            <a href="{{ route('client.product.show', $item->product->slug) }}"><i style="font-size: 19px;"
                                id="search-Product" class="fa-solid fa-magnifying-glass"></i>
                            </a>
                            <a href="{{ route('client.product.show', $item->product->slug) }}"><i style="font-size: 18px;" id="cart-Product" class="fa-solid fa-cart-shopping"></i></a>
                        </div>
                    </div>
                    <div class="box-star" style="width: 100%; height: 23px;">
                        @php
                            $avg = round($item->product->reviews->avg('rating'), 1);
                            $count = $item->product->reviews->count();
                        @endphp
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= floor($avg))
                                <i style="color: #fcad02; margin-left: 0;" class="fa-solid fa-star"></i>
                            @elseif($i - $avg < 1 && $avg - floor($avg) >= 0.5)
                                <i style="color: #fcad02; margin-left: 0;" class="fa-solid fa-star-half-stroke"></i>
                            @else
                                <i style="color: #ccc; margin-left: 0;" class="fa-solid fa-star"></i>
                            @endif
                        @endfor
                        <span style="margin-left: 5px; color: rgb(201, 201, 201); font-size: 12px;">
                            ({{ $count }} review{{ $count != 1 ? 's' : '' }})
                        </span>
                    </div>
                    <div class="title-new-product">
                        <a href="{{ route('client.product.show', $item->product->slug) }}">{{ $item->product->name }}</a>
                    </div>
                    <div style="font-size: 16px; color: rgb(170, 167, 167);">
                        {{ number_format($item->product->regular_price, 0, ',', '.') }} đ
                    </div>
                </div>
            @endforeach
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
