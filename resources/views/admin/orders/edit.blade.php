@extends('admin.layout.admin')
@section('title', 'Chỉnh sửa Đơn hàng #' . $order->order_code)
@section('content')
<div class="main-content-inner">
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap-20 mb-30">
            <h3 class="text-lg font-semibold">Chỉnh sửa Đơn hàng #{{ $order->order_code }}</h3>
            <ul class="breadcrumbs flex items-center flex-wrap justify-start gap-10">
                <li><a href="{{ route('admin.dashboard') }}" class="text-tiny">Bảng điều khiển</a></li>
                <li><i class="icon-chevron-right"></i></li>
                <li><a href="{{ route('admin.orders.index') }}" class="text-tiny">Đơn hàng</a></li>
                <li><i class="icon-chevron-right"></i></li>
                <li class="text-tiny">Chỉnh sửa Đơn hàng</li>
            </ul>
        </div>

        <form action="{{ route('admin.orders.update', $order->id) }}" method="POST" class="wg-box mb-20" style="max-width: 700px;">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 gap-6 mb-6">
                <fieldset class="mb-4">
                    <label class="body-title mb-2">Tên khách hàng</label>
                    <input type="text" name="customer_name" value="{{ old('customer_name', $order->customer_name) }}" required class="input-field">
                </fieldset>
                <fieldset class="mb-4">
                    <label class="body-title mb-2">Email khách hàng</label>
                    <input type="email" name="customer_email" value="{{ old('customer_email', $order->customer_email) }}" required class="input-field">
                </fieldset>
                <fieldset class="mb-4">
                    <label class="body-title mb-2">SĐT khách hàng</label>
                    <input type="text" name="customer_phone" value="{{ old('customer_phone', $order->customer_phone) }}" required class="input-field">
                </fieldset>
                <fieldset class="mb-4">
                    <label class="body-title mb-2">Địa chỉ giao hàng</label>
                    <input type="text" name="shipping_address" value="{{ old('shipping_address', $order->shipping_address) }}" required class="input-field">
                </fieldset>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <fieldset class="mb-4">
                    <label class="body-title mb-2">Tạm tính</label>
                    <input type="number" step="0.01" name="subtotal_amount" value="{{ old('subtotal_amount', $order->subtotal_amount) }}" required class="input-field">
                </fieldset>
                <fieldset class="mb-4">
                    <label class="body-title mb-2">Phí vận chuyển</label>
                    <input type="number" step="0.01" name="shipping_fee" value="{{ old('shipping_fee', $order->shipping_fee) }}" required class="input-field">
                </fieldset>
                <fieldset class="mb-4">
                    <label class="body-title mb-2">Giảm giá</label>
                    <input type="number" step="0.01" name="discount_amount" value="{{ old('discount_amount', $order->discount_amount) }}" class="input-field">
                </fieldset>
                <fieldset class="mb-4">
                    <label class="body-title mb-2">Thuế</label>
                    <input type="number" step="0.01" name="tax_amount" value="{{ old('tax_amount', $order->tax_amount) }}" class="input-field">
                </fieldset>
                <fieldset class="mb-4">
                    <label class="body-title mb-2">Tổng cộng</label>
                    <input type="number" step="0.01" name="total_amount" value="{{ old('total_amount', $order->total_amount) }}" required class="input-field">
                </fieldset>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <fieldset class="mb-4">
                    <label class="body-title mb-2">Phương thức thanh toán</label>
                    <select name="payment_method_id" required class="input-field">
                        @foreach(\App\Models\PaymentMethod::all() as $pm)
                            <option value="{{ $pm->id }}" @if($order->payment_method_id == $pm->id) selected @endif>{{ $pm->name }}</option>
                        @endforeach
                    </select>
                </fieldset>
                <fieldset class="mb-4">
                    <label class="body-title mb-2">Trạng thái thanh toán</label>
                    <select name="payment_status" required class="input-field">
                        <option value="pending" @if($order->payment_status=='pending') selected @endif>Chờ thanh toán</option>
                        <option value="paid" @if($order->payment_status=='paid') selected @endif>Đã thanh toán</option>
                        <option value="failed" @if($order->payment_status=='failed') selected @endif>Thanh toán thất bại</option>
                        <option value="refunded" @if($order->payment_status=='refunded') selected @endif>Đã hoàn tiền</option>
                    </select>
                </fieldset>
                <fieldset class="mb-4">
                    <label class="body-title mb-2">Phương thức vận chuyển</label>
                    <select name="shipping_method_id" required class="input-field">
                        @foreach(\App\Models\ShippingMethod::all() as $sm)
                            <option value="{{ $sm->id }}" @if($order->shipping_method_id == $sm->id) selected @endif>{{ $sm->name }}</option>
                        @endforeach
                    </select>
                </fieldset>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <fieldset class="mb-4">
                    <label class="body-title mb-2">Trạng thái đơn hàng</label>
                    <select name="order_status" required class="input-field">
                        <option value="pending_confirmation" @if($order->order_status=='pending_confirmation') selected @endif>Chờ xác nhận</option>
                        <option value="processing" @if($order->order_status=='processing') selected @endif>Đang xử lý</option>
                        <option value="shipped" @if($order->order_status=='shipped') selected @endif>Đang giao hàng</option>
                        <option value="delivered" @if($order->order_status=='delivered') selected @endif>Đã giao</option>
                        <option value="cancelled" @if($order->order_status=='cancelled') selected @endif>Đã hủy</option>
                        <option value="returned" @if($order->order_status=='returned') selected @endif>Đã trả hàng</option>
                    </select>
                </fieldset>
                <fieldset class="mb-4">
                    <label class="body-title mb-2">Ngày đặt hàng</label>
                    <input type="datetime-local" name="ordered_at" value="{{ old('ordered_at', $order->ordered_at ? $order->ordered_at->format('Y-m-d\TH:i') : '') }}" class="input-field">
                </fieldset>
                <fieldset class="mb-4">
                    <label class="body-title mb-2">Ngày giao hàng</label>
                    <input type="datetime-local" name="delivered_at" value="{{ old('delivered_at', $order->delivered_at ? $order->delivered_at->format('Y-m-d\TH:i') : '') }}" class="input-field">
                </fieldset>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <fieldset class="mb-4">
                    <label class="body-title mb-2">Ghi chú của khách hàng</label>
                    <textarea name="customer_note" rows="2" class="input-field">{{ old('customer_note', $order->customer_note) }}</textarea>
                </fieldset>
                <fieldset class="mb-4">
                    <label class="body-title mb-2">Ghi chú của quản trị viên</label>
                    <textarea name="admin_note" rows="2" class="input-field">{{ old('admin_note', $order->admin_note) }}</textarea>
                </fieldset>
            </div>

            <div class="flex justify-between mt-6">
                <button class="tf-button w-1/3" type="submit">Cập nhật đơn hàng</button>
                <a href="{{ route('admin.orders.show', $order->id) }}" class="tf-button w-1/3 style-2">Quay lại</a>
            </div>
        </form>
    </div>
</div>

@endsection
