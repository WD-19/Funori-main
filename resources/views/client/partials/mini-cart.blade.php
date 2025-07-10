@if ($cartItems && count($cartItems) > 0)
    @foreach ($cartItems as $cartItem)
        <div style="display: flex; align-items: center; margin-bottom: 14px;">
            <img src="{{ asset($cartItem['image_url']) }}"
                alt="Sản phẩm"
                style="width: 64px; height: 64px; object-fit: cover; border-radius: 6px; border: 1px solid #eee;">
            <div style="flex: 1; overflow: hidden; padding-left: 12px;">
                <div style="font-weight: 600; font-size: 14px; color: #333; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                    {{ isset($cartItem['product']) ? $cartItem['product']->name : 'Sản phẩm đã xóa' }}
                </div>
                @if (!empty($cartItem['variant']))
                    <div style="font-size: 12px; color: #666; margin-top: 2px;">
                        @foreach ($cartItem['variant']->attributeValues as $attrValue)
                            {{ $attrValue->attribute->name }}: {{ $attrValue->value }}
                            @if (!$loop->last), @endif
                        @endforeach
                    </div>
                @endif
            </div>
            <div style="color: #e53935; font-weight: 500; font-size: 14px; min-width: 70px; text-align: right;">
                {{ number_format($cartItem['price_at_addition'], 0, ',', '.') }}đ
            </div>
        </div>
    @endforeach

    <div style="padding: 10px 0; border-top: 1px solid #f0f0f0; margin-top: 10px;">
        <div style="display: flex; align-items: center; justify-content: space-between;">
            @if ($cartCount > 3)
                <span style="color: #999; font-size: 14px;">
                    +{{ $cartCount - 3 }} sản phẩm khác
                </span>
            @else
                <span></span>
            @endif
            <a href="{{ route('client.view-cart') }}" class="btn btn-danger"
                style="padding: 6px 16px; font-weight: 600; font-size: 14px; border-radius: 6px;">
                Xem Giỏ Hàng
            </a>
        </div>
    </div>
@else
    <div style="padding: 20px 0; text-align: center; color: #888; font-size: 14px;">
        Giỏ hàng của bạn đang trống.
    </div>
@endif 