<div class="variant-picker-values d-flex flex-wrap gap-2">
    @foreach ($product->variants as $variant)
        <label class="variant-box p-2 border rounded mb-2" style="min-width:160px; cursor:pointer;">

            <input type="radio" name="variant_id" value="{{ $variant->id }}"
                data-title="{{ $variant->name_variant ?? '' }}"
                data-price="{{ $product->regular_price + $variant->price_modifier }}"
                data-material="{{ $variant->material ?? '' }}"
                @if ($variant->image) data-image="{{ asset($variant->image->image_url) }}" @endif
                style="margin-right: 8px;">
            @if ($variant->image)
                <img style="width: 100%;" src="{{ asset($variant->image->image_url) }}" alt="Ảnh biến thể"
                    style="width:36px;height:36px;object-fit:cover;border-radius:6px;">
            @endif
            <div>
                <br>
                <strong>Kho:</strong>
                @if (($variant->stock_quantity ?? 0) <= 0)
                    <span style="color:red;font-weight:bold;">Hết hàng</span>
                @else
                    {{ $variant->stock_quantity }}
                @endif
                <br>
                <strong>Kích thước:</strong> {{ $variant->size ?? '-' }}<br>
                {{-- Hiển thị các thuộc tính của biến thể --}}
                @if ($variant->attributeValues && $variant->attributeValues->count())
                    {{-- <div> --}}
                    {{-- <span class="badge bg-light text-dark border"> Kích thước: {{ $variant->size ?? '-' }}</span> --}}
                    @foreach ($variant->attributeValues as $attrVal)
                        <strong>{{ $attrVal->attribute->name ?? '' }}</strong> {{ $attrVal->value ?? '' }}<br>
                        {{-- <span
                                                                        class="badge bg-light text-dark border">{{ $attrVal->attribute->name ?? '' }}:
                {{ $attrVal->value ?? '' }}</span> --}}
                    @endforeach
                    {{-- </div> --}}
                @endif
            </div>
        </label>
    @endforeach
</div>
