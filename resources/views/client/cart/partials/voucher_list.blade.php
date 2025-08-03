<div class="modal-header">
    <h5 class="modal-title" id="voucherModalLabel">Chọn mã giảm giá</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    @if($vouchers->isEmpty())
        <p>Không có mã giảm giá nào khả dụng.</p>
    @else
        <ul class="list-group">
            @foreach($vouchers as $voucher)
                <li class="list-group-item d-flex justify-content-between align-items-center voucher-item" data-code="{{ $voucher->code }}">
                    <div>
                        <strong>{{ $voucher->code }}</strong> - 
                        @if($voucher->discount_type == 'percentage')
                            Giảm {{ $voucher->discount_value }}%
                            @if($voucher->max_discount_amount)
                                (Tối đa {{ number_format($voucher->max_discount_amount, 0, ',', '.') }}đ)
                            @endif
                        @else
                            Giảm {{ number_format($voucher->discount_value, 0, ',', '.') }}đ
                        @endif
                        @if($voucher->min_order_value)
                            <br><small>Đơn hàng tối thiểu: {{ number_format($voucher->min_order_value, 0, ',', '.') }}đ</small>
                        @endif
                    </div>
                    <button type="button" class="btn btn-sm btn-primary apply-voucher-btn" data-code="{{ $voucher->code }}">Chọn</button>
                </li>
            @endforeach
        </ul>
    @endif
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
</div>

<style>
    .voucher-item {
        cursor: pointer;
        margin-bottom: 10px;
        border: 1px solid #eee;
        border-radius: 5px;
        padding: 10px;
    }
    .voucher-item:hover {
        background-color: #f8f8f8;
    }
    .apply-voucher-btn {
        margin-left: 15px;
    }
</style>