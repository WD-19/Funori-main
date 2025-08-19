@extends('client.profile.profile_base')

@section('page_title', 'Chi tiết hủy đơn hàng')

@section('content_profile')
<div class="container py-4">
    <div class="card shadow-sm border-0 rounded-lg">
        <div class="card-header bg-danger text-white d-flex align-items-center justify-content-between rounded-top-lg">
            <h4 class="mb-0 fw-bold">
                <i class="fas fa-times-circle me-2"></i>Đơn hàng đã hủy
            </h4>
            <div class="d-flex gap-2">
                <a href="{{ route('client.profile.my_account.orderdetail', ['id' => $order->id]) }}" class="btn btn-light btn-sm">
                    <i class="fas fa-eye me-1"></i>Xem chi tiết
                </a>
                <a href="{{ route('client.profile.my_account.order') }}" class="btn btn-light btn-sm">
                    <i class="fas fa-arrow-left me-1"></i>Quay lại
                </a>
            </div>
        </div>
        <div class="card-body p-4">
            <div class="row g-4">
                {{-- Thông tin chung và Lý do hủy --}}
                <div class="col-lg-6">
                    <div class="bg-light p-3 rounded-lg h-100">
                        <h5 class="fw-bold text-dark mb-3">Thông tin đơn hàng</h5>
                        <ul class="list-unstyled mb-0">
                            <li class="d-flex justify-content-between py-2 border-bottom">
                                <span><strong>Mã đơn hàng:</strong></span>
                                <span>{{ $order->order_code }}</span>
                            </li>
                            <li class="d-flex justify-content-between py-2 border-bottom">
                                <span><strong>Ngày đặt:</strong></span>
                                <span>{{ $order->created_at->format('d/m/Y H:i') }}</span>
                            </li>
                            <li class="d-flex justify-content-between py-2 border-bottom">
                                <span><strong>Tổng tiền:</strong></span>
                                <span class="text-danger fw-bold">{{ number_format($order->total_amount) }} VNĐ</span>
                            </li>
                            <li class="d-flex justify-content-between py-2">
                                <span><strong>Phương thức thanh toán:</strong></span>
                                <span>{{ $order->paymentMethod->name ?? 'N/A' }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
                
                {{-- Thông tin hoàn tiền --}}
                <div class="col-lg-6">
                    <div class="bg-light p-3 rounded-lg h-100">
                        <h5 class="fw-bold text-dark mb-3">Trạng thái hoàn tiền</h5>
                        @if($refund)
                            <div class="alert alert-{{ $refund->status === 'success' ? 'success' : ($refund->status === 'pending' ? 'warning' : 'danger') }} p-3 mb-3 d-flex align-items-center rounded-lg">
                                <i class="fas fa-{{ $refund->status === 'success' ? 'check-circle' : ($refund->status === 'pending' ? 'clock' : 'exclamation-triangle') }} me-3 fs-4"></i>
                                <div>
                                    <h6 class="alert-heading mb-1 fw-bold">
                                        @switch($refund->status)
                                            @case('success') Đã hoàn tiền @break
                                            @case('pending') Đang xử lý @break
                                            @case('failed') Thất bại @break
                                            @case('cancelled') Đã hủy @break
                                            @default {{ ucfirst($refund->status) }} @break
                                        @endswitch
                                    </h6>
                                    <p class="mb-0 small">
                                        @switch($refund->status)
                                            @case('success') Tiền đã được hoàn về tài khoản của bạn. Thời gian nhận tiền có thể mất 1-3 ngày làm việc. @break
                                            @case('pending') Yêu cầu hoàn tiền đang được xử lý. Vui lòng chờ đợi trong giây lát. @break
                                            @case('failed') Có lỗi xảy ra. Vui lòng liên hệ hỗ trợ để được giải quyết. @break
                                            @case('cancelled') Đơn hàng đã được hủy thành công. Không có hoàn tiền vì đơn hàng chưa thanh toán. @break
                                        @endswitch
                                    </p>
                                </div>
                            </div>
                            
                            @if($refund->status !== 'cancelled')
                            <div class="card border-0">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <strong>Số tiền hoàn:</strong>
                                        <span class="text-success fw-bold">{{ number_format($refund->amount) }} VNĐ</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <strong>Phương thức:</strong>
                                        <span>
                                            @switch($refund->gateway)
                                                @case('vnpay') <span class="badge bg-primary">VNPay</span> @break
                                                @case('momo') <span class="badge bg-pink">MoMo</span> @break
                                                @default <span class="badge bg-secondary">Thủ công</span> @break
                                            @endswitch
                                        </span>
                                    </li>
                                    @if($refund->refund_transaction_id)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <strong>Mã hoàn tiền:</strong>
                                        <code class="text-muted small">{{ $refund->refund_transaction_id }}</code>
                                    </li>
                                    @endif
                                    @if($refund->refunded_at)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <strong>Ngày hoàn tiền:</strong>
                                        <span>{{ $refund->refunded_at->format('d/m/Y H:i') }}</span>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                            @endif
                            
                            @if($refund->status === 'pending')
                            <div class="text-center mt-3">
                                <button class="btn btn-outline-info btn-sm" onclick="checkRefundStatus({{ $refund->id }})">
                                    <i class="fas fa-sync-alt me-1"></i>Kiểm tra trạng thái
                                </button>
                            </div>
                            @endif
                        @else
                            <div class="alert alert-secondary text-center rounded-lg">
                                <i class="fas fa-info-circle me-2"></i>Đơn hàng chưa thanh toán, không cần hoàn tiền.
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Danh sách sản phẩm --}}
            <div class="mt-4 pt-4 border-top">
                <h5 class="fw-bold text-dark mb-3">Sản phẩm trong đơn hàng</h5>
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle">
                        <thead>
                            <tr class="table-secondary">
                                <th scope="col">Sản phẩm</th>
                                <th scope="col">Giá</th>
                                <th scope="col">Số lượng</th>
                                <th scope="col" class="text-end">Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->items as $item)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        @if($item->productVariant && $item->productVariant->image)
                                            {{-- Hiển thị ảnh biến thể nếu có --}}
                                            <img src="{{ asset($item->productVariant->image->image_url) }}" 
                                                 alt="{{ $item->product_name }}" 
                                                 class="img-fluid rounded-lg me-3" 
                                                 style="width: 60px; height: 60px; object-fit: cover;">
                                        @elseif($item->product && $item->product->thumbnail)
                                            {{-- Fallback về ảnh sản phẩm chính nếu không có ảnh biến thể --}}
                                            <img src="{{ asset('storage/' . $item->product->thumbnail->image_url) }}" 
                                                 alt="{{ $item->product_name }}" 
                                                 class="img-fluid rounded-lg me-3" 
                                                 style="width: 60px; height: 60px; object-fit: cover;">
                                        @else
                                            {{-- Ảnh mặc định nếu không có ảnh nào --}}
                                            <div class="bg-light rounded-lg me-3 d-flex align-items-center justify-content-center" 
                                                 style="width: 60px; height: 60px;">
                                                <i class="fas fa-image text-muted"></i>
                                            </div>
                                        @endif
                                        <div>
                                            <div class="fw-bold text-dark">{{ $item->product_name }}</div>
                                            @if($item->variant_attributes)
                                                <small class="text-muted d-block mt-1">
                                                    @foreach(json_decode($item->variant_attributes, true) as $attr => $value)
                                                        <span>{{ $attr }}: {{ $value }}</span>@if(!$loop->last), @endif
                                                    @endforeach
                                                </small>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td>{{ number_format($item->subtotal / $item->quantity) }} VNĐ</td>
                                <td>{{ $item->quantity }}</td>
                                <td class="text-end">{{ number_format($item->subtotal) }} VNĐ</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Lý do hủy --}}
            @if($order->cancellation_reason)
            <div class="mt-4">
                <div class="p-3 bg-light rounded-lg">
                    <h6 class="fw-bold mb-1"><i class="fas fa-comment me-2"></i>Lý do hủy đơn hàng</h6>
                    <p class="mb-0 text-muted small">{{ $order->cancellation_reason }}</p>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

{{-- Modal và scripts giữ nguyên như cũ --}}
<div class="modal fade" id="refundStatusModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Trạng thái hoàn tiền</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="refundStatusContent">
                <div class="text-center">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mt-2 text-muted">Đang kiểm tra trạng thái...</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    function checkRefundStatus(refundId) {
        const modal = new bootstrap.Modal(document.getElementById('refundStatusModal'));
        modal.show();
    
        fetch(`/profile/refund/${refundId}/status`)
            .then(response => response.json())
            .then(data => {
                const content = document.getElementById('refundStatusContent');
                if (data.success) {
                    content.innerHTML = `
                        <div class="alert alert-success">
                            <h6><i class="fas fa-check-circle"></i> Cập nhật trạng thái</h6>
                            <p>${data.message}</p>
                            <button type="button" class="btn btn-primary" onclick="location.reload()">
                                Làm mới trang
                            </button>
                        </div>
                    `;
                } else {
                    content.innerHTML = `
                        <div class="alert alert-warning">
                            <h6><i class="fas fa-info-circle"></i> Thông báo</h6>
                            <p>${data.message}</p>
                        </div>
                    `;
                }
            })
            .catch(error => {
                const content = document.getElementById('refundStatusContent');
                content.innerHTML = `
                    <div class="alert alert-danger">
                        <h6><i class="fas fa-exclamation-triangle"></i> Lỗi</h6>
                        <p>Có lỗi xảy ra khi kiểm tra trạng thái</p>
                    </div>
                `;
            });
    }
</script>
@endpush

@push('styles')
<style>
    .badge.bg-pink {
        background-color: #e91e63 !important;
    }
    .rounded-lg {
        border-radius: 0.75rem !important;
    }
    .card-header.rounded-top-lg {
        border-top-left-radius: 0.75rem !important;
        border-top-right-radius: 0.75rem !important;
    }
</style>
@endpush