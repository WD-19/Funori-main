@extends('client.layout.client')

@section('title', 'Đặt hàng thành công')

@section('content')
    <div style="max-width: 66vw; margin: 60px auto; padding: 0 16px; text-align: center;">
        <h2 style="font-weight: 600; font-size: 24px; color: #ff3029;">Đặt hàng thành công!</h2>
        <p>Cảm ơn bạn đã đặt hàng. Chúng tôi sẽ liên hệ sớm để xác nhận.</p>
        <a href="{{ route('shop') }}" class="tf-btn btn-fill" style="background: #ff3029; color: #fff; padding: 12px 28px; font-weight: bold; border-radius: 3px;">
            Tiếp tục mua sắm
        </a>
    </div>
@endsection