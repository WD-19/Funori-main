@extends('client.profile.profile_base')

@section('page_title', 'Chi tiết hủy đơn hàng')

@section('content_profile')
<div class="container-fluid py-4">
    <div class="card shadow-sm border-0 rounded-lg mx-auto" style="max-width: 1200px;">
        {{-- Header --}}
        <div class="card-header bg-warning bg-opacity-10 text-warning rounded-top-lg border-0 p-4">
            <h4 class="mb-0 fw-semibold d-flex align-items-center">
                <i class="fas fa-times-circle me-2"></i>Đơn hàng đã hủy
            </h4>
        </div>

        <div class="card-body p-4" style="font-family: 'Roboto', sans-serif;">
            <div class="row g-4">
                {{-- Thông tin chung --}}
                <div class="col-xl-6 col-lg-12">
                    <div class="bg-light p-4 rounded-lg h-100">
                        <h5 class="fw-bold text-dark mb-3 d-flex align-items-center">
                            <i class="fas fa-info-circle me-2 text-primary"></i>Thông tin đơn hàng
                        </h5>
                        <div class="info-grid">
                            <div class="info-item d-flex justify-content-between align-items-center py-3 border-bottom">
                                <span class="fw-medium text-dark">Mã đơn hàng:</span>
                                <span class="badge bg-primary fs-6">{{ $order->order_code }}</span>
                            </div>
                            <div class="info-item d-flex justify-content-between align-items-center py-3 border-bottom">
                                <span class="fw-medium text-dark">Ngày đặt:</span>
                                <span class="text-muted">{{ $order->created_at->format('d/m/Y H:i') }}</span>
                            </div>
                            <div class="info-item d-flex justify-content-between align-items-center py-3 border-bottom">
                                <span class="fw-medium text-dark">Tổng tiền:</span>
                                <span class="text-danger fw-bold fs-5">{{ number_format($order->total_amount) }} VNĐ</span>
                            </div>
                            <div class="info-item d-flex justify-content-between align-items-center py-3">
                                <span class="fw-medium text-dark">Thanh toán:</span>
                                <span class="badge bg-info">{{ $order->paymentMethod->name ?? 'N/A' }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Hoàn tiền --}}
                <div class="col-xl-6 col-lg-12">
                    <div class="bg-light p-4 rounded-lg h-100">
                        <h5 class="fw-bold text-dark mb-3 d-flex align-items-center">
                            <i class="fas fa-money-bill-wave me-2 text-success"></i>Trạng thái hoàn tiền
                        </h5>
                        @if($refund)
                            <div class="alert alert-{{ $refund->status === 'success' ? 'success' : ($refund->status === 'pending' ? 'warning' : 'danger') }} border-0 rounded-lg p-4 mb-3">
                                <div class="d-flex align-items-start">
                                    <i class="fas fa-{{ $refund->status === 'success' ? 'check-circle' : ($refund->status === 'pending' ? 'clock' : 'exclamation-triangle') }} me-3 fs-3 mt-1"></i>
                                    <div class="flex-grow-1">
                                        <h6 class="alert-heading mb-2 fw-bold">
                                            @switch($refund->status)
                                                @case('success') 
                                                    Đã hoàn tiền 
                                                @break
                                                @case('pending') 
                                                    <i class="fas fa-clock me-1"></i>Đang xử lý 
                                                @break
                                                @case('failed') 
                                                    <i class="fas fa-times-circle me-1"></i>Thất bại 
                                                @break
                                                @case('cancelled') 
                                                    <i class="fas fa-ban me-1"></i>Đã hủy 
                                                @break
                                                @default {{ ucfirst($refund->status) }} @break
                                            @endswitch
                                        </h6>
                                        <p class="mb-0 small">
                                            @switch($refund->status)
                                                @case('pending') Vui lòng liên hệ nếu có vấn đề @break
                                                @case('failed') Có lỗi xảy ra. Vui lòng liên hệ hỗ trợ @break
                                                @case('cancelled') Thời gian giao hàng quá lâu @break
                                            @endswitch
                                        </p>
                                    </div>
                                </div>
                            </div>

                            @if($refund->status !== 'cancelled')
                            <div class="refund-details">
                                <div class="row g-2">
                                    <div class="col-12">
                                        <div class="d-flex justify-content-between align-items-center p-3 bg-white rounded border">
                                            <span class="fw-medium text-dark">Số tiền hoàn:</span>
                                            <span class="text-success fw-bold fs-5">{{ number_format($refund->amount) }} VNĐ</span>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-flex justify-content-between align-items-center p-3 bg-white rounded border">
                                            <span class="fw-medium text-dark">Phương thức:</span>
                                            <span>
                                                @switch($refund->gateway)
                                                    @case('vnpay') <span class="badge bg-primary">VNPAY</span> @break
                                                    @case('momo') <span class="badge bg-danger">MoMo</span> @break
                                                    @default <span class="badge bg-secondary">Thủ công</span> @break
                                                @endswitch
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        @else
                            <div class="alert alert-secondary border-0 rounded-lg text-center p-4">
                                <i class="fas fa-info-circle fs-3 mb-2 d-block text-muted"></i>
                                <p class="mb-0 fw-medium">Đơn hàng chưa thanh toán, không cần hoàn tiền.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Danh sách sản phẩm --}}
            <div class="mt-5 pt-4 border-top">
                <h5 class="fw-bold text-dark mb-4 d-flex align-items-center">
                    <i class="fas fa-shopping-cart me-2 text-primary"></i>Sản phẩm trong đơn hàng
                </h5>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th class="border-0 fw-bold text-dark">Sản phẩm</th>
                                <th class="border-0 fw-bold text-dark text-center">Giá</th>
                                <th class="border-0 fw-bold text-dark text-center">Số lượng</th>
                                <th class="border-0 fw-bold text-dark text-end">Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->items as $item)
                            <tr class="border-bottom">
                                <td class="py-3">
                                    <div class="d-flex align-items-center">
                                        @php
                                            $variantInfo = $item->variant ? (is_array($item->variant) ? $item->variant : json_decode($item->variant, true)) : null;
                                        @endphp
                                        @if($item->productVariant && $item->productVariant->image)
                                            <img src="{{ asset($item->productVariant->image->image_url) }}" 
                                                 alt="{{ $item->product_name }}" 
                                                 class="img-fluid rounded me-3 shadow-sm" 
                                                 style="width: 70px; height: 70px; object-fit: cover;">
                                        @elseif($item->product && $item->product->thumbnail)
                                            <img src="{{ asset('storage/' . $item->product->thumbnail->image_url) }}" 
                                                 alt="{{ $item->product_name }}" 
                                                 class="img-fluid rounded me-3 shadow-sm" 
                                                 style="width: 70px; height: 70px; object-fit: cover;">
                                        @else
                                            <div class="bg-light rounded me-3 d-flex align-items-center justify-content-center shadow-sm" 
                                                 style="width: 70px; height: 70px;">
                                                <i class="fas fa-image text-muted fs-4"></i>
                                            </div>
                                        @endif
                                        <div>
                                            <div class="fw-bold text-dark mb-1">{{ $item->product_name }}</div>
                                            @if($variantInfo)
                                                <small class="text-muted">
                                                    <span class="badge bg-light text-dark me-1">{{ $variantInfo['name_variant'] ?? '' }}</span>
                                                    @if(!empty($variantInfo['size']))
                                                        <span class="badge bg-light text-dark me-1">Kích thước: {{ $variantInfo['size'] }}</span>
                                                    @endif
                                                </small>
                                            @endif
                                            @if($item->variant_attributes)
                                                <div class="mt-1">
                                                    @php
                                                        $attributes = is_array($item->variant_attributes) ? $item->variant_attributes : json_decode($item->variant_attributes, true);
                                                    @endphp
                                                    @if(is_array($attributes))
                                                        @foreach($attributes as $attribute)
                                                            <span class="badge bg-light text-dark me-1">{{ $attribute }}</span>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center py-3">
                                    <span class="fw-medium">{{ number_format($item->price ?? ($item->subtotal / $item->quantity)) }} VNĐ</span>
                                </td>
                                <td class="text-center py-3">
                                    <span class="badge bg-primary fs-6">{{ $item->quantity }}</span>
                                </td>
                                <td class="text-end py-3">
                                    <span class="fw-bold text-primary fs-5">{{ number_format($item->subtotal) }} VNĐ</span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Lý do hủy --}}
            @if($order->cancellation_reason)
            <div class="mt-4">
                <div class="p-4 bg-light rounded-lg border-start border-4 border-warning">
                    <h6 class="fw-bold mb-3 d-flex align-items-center text-dark">
                        <i class="fas fa-comment me-2 text-warning"></i>Lý do hủy đơn hàng
                    </h6>
                    <p class="mb-0 text-muted">{{ $order->cancellation_reason }}</p>
                </div>
            </div>
            @endif

            {{-- Các nút điều hướng --}}
            <div class="mt-5 pt-4 border-top d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                <div class="text-muted small">
                    <i class="fas fa-clock me-1"></i>
                    Thời gian giao hàng quá lâu
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('client.profile.my_account.orderdetail', ['id' => $order->id]) }}" 
                       class="btn btn-outline-primary px-4">
                        <i class="fas fa-eye me-2"></i>Xem chi tiết
                    </a>
                    <a href="{{ route('client.profile.my_account.order') }}" 
                       class="btn btn-secondary px-4">
                        <i class="fas fa-arrow-left me-2"></i>Quay lại
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    :root {
        --bs-border-radius-lg: 0.75rem;
    }
    
    .rounded-lg { 
        border-radius: var(--bs-border-radius-lg) !important; 
    }
    
    .card-header.rounded-top-lg { 
        border-top-left-radius: var(--bs-border-radius-lg) !important; 
        border-top-right-radius: var(--bs-border-radius-lg) !important; 
    }
    
    body, .card, .table { 
        font-family: 'Roboto', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; 
        font-size: 0.95rem; 
    }
    
    .info-grid .info-item {
        transition: background-color 0.2s ease;
    }
    
    .info-grid .info-item:hover {
        background-color: rgba(0,0,0,0.02);
        border-radius: 0.5rem;
        margin: 0 -0.5rem;
        padding-left: 0.5rem !important;
        padding-right: 0.5rem !important;
    }
    
    .table > :not(caption) > * > * {
        padding: 1rem 0.75rem;
    }
    
    .refund-details .col-12:not(:last-child) {
        margin-bottom: 0.5rem;
    }
    
    .btn {
        border-radius: 0.5rem;
        font-weight: 500;
        transition: all 0.2s ease;
    }
    
    .btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.15);
    }
    
    .alert {
        border: none;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    .badge {
        font-weight: 500;
        padding: 0.5em 0.75em;
    }
    
    .border-4 {
        border-width: 4px !important;
    }
    
    @media (max-width: 768px) {
        .container-fluid {
            padding-left: 15px;
            padding-right: 15px;
        }
        
        .card-body {
            padding: 1.5rem !important;
        }
        
        .table-responsive {
            font-size: 0.875rem;
        }
        
        .btn {
            width: 100%;
            margin-bottom: 0.5rem;
        }
        
        .btn:last-child {
            margin-bottom: 0;
        }
    }
</style>
@endpush
