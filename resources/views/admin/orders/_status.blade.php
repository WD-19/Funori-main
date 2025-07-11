@php
    $allStatuses = [
        'pending_confirmation' => 'Pending Confirmation',
        'processing' => 'đang xử lý',
        'shipped' => 'đang giao hàng',
        'delivered' => 'Đã nhận hàng',
        'cancelled' => 'Đã hủy đơn hàng',
        'returned' => 'Đã trả hàng',
    ];
@endphp

@php
    $statuses = $transitions[$currentStatus] ?? [];

    // Nếu đang giao hàng thì loại bỏ trạng thái 'cancelled'
    if ($currentStatus === 'shipped') {
        // Giữ lại các trạng thái khác ngoài 'cancelled'
        $statuses = array_filter($statuses, function($status) {
            return $status !== 'cancelled';
        });
       
    }
@endphp

@if(empty($statuses))
    <div class="alert alert-info mb-0">Không thể chuyển tiếp trạng thái.</div>
@else
    <select name="order_status" id="order_status" class="form-select" style="height:44px; border-radius:8px;" required>
        @foreach($statuses as $status)
            <option value="{{ $status }}" @if($order->order_status == $status) selected @endif>
                {{ $allStatuses[$status] ?? ucfirst($status) }}
            </option>
        @endforeach
    </select>
@endif

