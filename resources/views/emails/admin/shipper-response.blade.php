<div style="font-family: Arial, Helvetica, sans-serif; line-height: 1.5; color: #222">
    <h2 style="margin:0 0 12px">Thông báo phản hồi từ Shipper</h2>

    <p style="margin:0 0 8px">
        Đơn hàng: <strong>#{{ $order->order_code }}</strong>
    </p>

    <p style="margin:0 0 8px">
        Shipper: <strong>{{ optional($shipper)->name ?? 'Không xác định' }}</strong>
        @if(optional($shipper)->email)
            ({{ $shipper->email }})
        @endif
    </p>

    <p style="margin:0 0 8px">
        Trạng thái phản hồi: 
        @if($response === 'accepted')
            <strong style="color:#16a34a">Đã nhận</strong>
        @elseif($response === 'rejected')
            <strong style="color:#dc2626">Từ chối</strong>
        @else
            <strong>{{ ucfirst($response) }}</strong>
        @endif
    </p>

    @if(!empty($reason))
        <p style="margin:0 0 8px">
            Lý do: <em>{{ $reason }}</em>
        </p>
    @endif

    <hr style="border:none; border-top:1px solid #e5e7eb; margin:12px 0" />

    <p style="margin:0 0 6px">Thông tin đơn hàng tóm tắt:</p>
    <ul style="margin:0 0 12px 16px; padding:0">
        <li>Mã đơn: {{ $order->order_code }}</li>
        <li>Trạng thái hiện tại: {{ $order->order_status }}</li>
        <li>Tổng tiền: {{ number_format($order->total_amount, 0, ',', '.') }} đ</li>
        @if($order->user)
            <li>Khách hàng: {{ $order->user->name }} ({{ $order->user->email }})</li>
        @endif
        @if(!empty($order->delivery_address))
            <li>Địa chỉ giao: {{ $order->delivery_address }}</li>
        @endif
    </ul>

    <p style="margin:0 0 4px">Vui lòng đăng nhập trang quản trị để xử lý tiếp.</p>
    <p style="margin:0">Trân trọng!</p>
</div>




