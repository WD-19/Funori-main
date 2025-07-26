@extends('client.layout.client')

@section('title', 'Kết quả tìm kiếm')

@section('content')
<div class="container" style="padding-top: 32px; padding-bottom: 48px;">
    <div class="row">
        <div class="col-12">
            <div class="mb-4">
                <h1 class="h4 mb-2">
                    @if($query)
                        Kết quả tìm kiếm cho "{{ $query }}"
                    @else
                        Tất cả sản phẩm
                    @endif
                </h1>
                <p class="text-muted">Tìm thấy {{ $products->total() }} sản phẩm</p>
            </div>

            @if($products->isEmpty())
                <div class="text-center py-5">
                    <i class="fa-solid fa-search mb-3" style="font-size: 48px; color: #ddd;"></i>
                    <p class="mb-0">Không tìm thấy sản phẩm nào phù hợp với từ khóa "{{ $query }}"</p>
                </div>
            @else
                <div class="row">
                    @foreach($products as $product)
                        <div class="col-6 col-md-4 col-lg-3 mb-4">
                            <div class="card h-100 border-0 shadow-sm">
                                <a href="{{ route('client.product.show', $product->slug) }}">
                                    <img src="{{ $product->images->first() ? asset($product->images->first()->image_url) : asset('images/no-image.png') }}"
                                        class="card-img-top" alt="{{ $product->name }}" 
                                        style="height: 200px; object-fit: cover;">
                                </a>
                                <div class="card-body">
                                    <h5 class="card-title mb-2" style="font-size: 14px;">
                                        <a href="{{ route('client.product.show', $product->slug) }}" 
                                           class="text-dark text-decoration-none">
                                            {{ $product->name }}
                                        </a>
                                    </h5>
                                    @if($product->brand)
                                        <p class="card-text text-muted mb-2" style="font-size: 13px;">
                                            {{ $product->brand->name }}
                                        </p>
                                    @endif
                                    <p class="card-text mb-0" style="font-size: 16px; font-weight: 500; color: #fc573b;">
                                        {{ number_format($product->regular_price, 0, ',', '.') }}đ
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="d-flex justify-content-center mt-4">
                    {{ $products->appends(['q' => $query])->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.card {
    transition: transform 0.2s;
}
.card:hover {
    transform: translateY(-5px);
}
.pagination {
    margin-bottom: 0;
}
</style>
@endpush
