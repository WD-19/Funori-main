@extends('client.layout.client')

@section('title', 'Đặt hàng thành công')

@section('content')
    <div class="checkout-success"
        style="max-width: 500px; margin: 40px auto; background: #fff; border-radius: 12px; box-shadow: 0 2px 16px rgba(0,0,0,0.08); padding: 32px; text-align: center;">
        <div class="success-icon" style="font-size: 64px; color: #28a745; margin-bottom: 16px;">
            <i class="fa fa-check-circle"></i>
        </div>
        <h2 style="font-weight: 600; font-size: 24px; color: #ff3029;">Đặt hàng thành công!</h2>
        <p>Cảm ơn bạn đã đặt hàng tại Funori.</p>
        @if (isset($order))
            <div class="order-info" style="margin: 24px 0 12px 0; text-align: left;">
                <p><strong>Mã đơn hàng:</strong> {{ $order->order_code }}</p>
                <p><strong>Trạng thái thanh toán:</strong> {{ $order->payment_status }}</p>
                <p><strong>Tổng tiền:</strong> {{ number_format($order->total_amount, 0, ',', '.') }} VND</p>
            </div>
            @if (isset($paymentDetails) && is_array($paymentDetails) && isset($paymentDetails['vnp_TransactionNo']))
                <h3 style="margin-top: 32px; font-size: 20px; color: #007bff;">Chi tiết giao dịch VNPAY</h3>
                <table class="table table-bordered"
                    style="margin: 16px auto; text-align: left; width: 100%; max-width: 100%; background: #f8f9fa;">
                    <tr>
                        <th>Mã giao dịch</th>
                        <td>{{ $paymentDetails['vnp_TransactionNo'] ?? '' }}</td>
                    </tr>
                    <tr>
                        <th>Ngân hàng</th>
                        <td>{{ $paymentDetails['vnp_BankCode'] ?? '' }}</td>
                    </tr>
                    <tr>
                        <th>Số tiền</th>
                        <td>{{ isset($paymentDetails['vnp_Amount']) ? number_format($paymentDetails['vnp_Amount'] / 100, 0, ',', '.') : '' }}
                            VND</td>
                    </tr>
                    <tr>
                        <th>Thời gian</th>
                        <td>{{ $paymentDetails['vnp_PayDate'] ?? '' }}</td>
                    </tr>
                    <tr>
                        <th>Trạng thái</th>
                        <td>
                            @if (($paymentDetails['vnp_ResponseCode'] ?? '') == '00')
                                <span class="text-success">Thành công</span>
                            @else
                                <span class="text-danger">Thất bại</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Mã đơn hàng</th>
                        <td>{{ $paymentDetails['vnp_TxnRef'] ?? '' }}</td>
                    </tr>
                </table>
            @endif
        @endif
        <a href="{{ route('home') }}" class="btn btn-primary mt-3"
            style="background: #ff3029; color: #fff; padding: 12px 28px; font-weight: bold; border-radius: 3px; margin-right: 8px;">Về
            trang chủ</a>
        <a href="{{ route('client.profile.my_account.order') }}" class="btn btn-outline-secondary mt-3"
            style="padding: 12px 28px; font-weight: bold; border-radius: 3px; border: 1px solid #ff3029; color: #ff3029;">Xem
            đơn hàng của tôi</a>
    </div>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
@endsection
