@php
    $maxShow = 5;
    $user = Auth::user();
    $totalWishlist = ($user && $user->wishlist) ? $user->wishlist->items()->count() : 0;
@endphp
@if($wishlistItems->count())
    @foreach($wishlistItems->sortByDesc('created_at')->take($maxShow) as $item)
        <a href="{{ route('client.product.show', $item->product->slug) }}" class="mini-wishlist-item-link d-flex align-items-center mb-2 p-2" style="border-radius:6px;transition:background 0.15s; text-decoration:none; color:#333;" title="{{ $item->product->name }}">
            <img src="{{ $item->product->images->first() ? asset($item->product->images->first()->image_url) : asset('images/no-image.png') }}" style="width:40px;height:40px;object-fit:cover;border-radius:6px;margin-right:10px;">
            <span class="mini-wishlist-name" style="font-size:14px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:130px;display:inline-block;">{{ $item->product->name }}</span>
        </a>
    @endforeach
    @if($totalWishlist > $maxShow)
        <div class="mini-wishlist-more" style="text-align:center;font-size:13px;color:#888;margin-bottom:4px;">+{{ $totalWishlist - $maxShow }} sản phẩm khác...</div>
    @endif
    <div style="text-align:center;margin-top:8px;">
        <a href="{{ route('client.profile.wishlist') }}" class="mini-wishlist-viewall btn btn-sm btn-warning" style="background:#fcad02;color:#fff;font-weight:600;padding:8px 24px;border-radius:8px;font-size:15px;">Xem tất cả</a>
    </div>
@else
    <div style="text-align:center;color:#888;font-size:14px;">Chưa có sản phẩm yêu thích</div>
@endif
<style>
.mini-wishlist-item-link:hover .mini-wishlist-name {
    color: #fcad02 !important;
    text-decoration: underline;
}
.mini-wishlist-item-link:hover {
    background: #fcf3e6 !important;
    text-decoration: none;
}
.mini-wishlist-viewall {
    display: inline-block;
    background: #fcad02;
    color: #fff;
    font-weight: 600;
    border-radius: 8px;
    padding: 8px 24px;
    margin: 0 auto;
    transition: background 0.2s, color 0.2s;
    text-decoration: none;
    font-size: 15px;
    border: none;
}
.mini-wishlist-viewall:hover {
    background: #e89c00;
    color: #fff;
    text-decoration: none;
}
</style>
