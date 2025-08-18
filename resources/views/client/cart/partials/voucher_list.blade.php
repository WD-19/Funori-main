<div class="modal-header border-0 pb-0">
    <h5 class="modal-title fw-bold text-dark" id="voucherModalLabel">
        <i class="fas fa-ticket-alt me-2 text-primary"></i>
        Chọn mã giảm giá
    </h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<div class="modal-body px-4">
    @if($vouchers->isEmpty())
        <div class="text-center py-5">
            <div class="mb-3">
                <i class="fas fa-gift text-muted" style="font-size: 3rem;"></i>
            </div>
            <h6 class="text-muted mb-2">Chưa có mã giảm giá</h6>
            <p class="text-muted small">Hiện tại không có mã giảm giá nào khả dụng. Hãy quay lại sau!</p>
        </div>
    @else
        <div class="voucher-list">
            @foreach($vouchers as $voucher)
                <div class="voucher-card mb-3" data-code="{{ $voucher->code }}">
                    <div class="voucher-content">
                        <div class="voucher-info">
                            <div class="voucher-header">
                                <div class="voucher-code">
                                    <span class="code-text">{{ $voucher->code }}</span>
                                    @if($voucher->discount_type == 'percentage')
                                        <span class="discount-badge percentage">
                                            -{{ $voucher->discount_value }}%
                                        </span>
                                    @else
                                        <span class="discount-badge fixed">
                                            -{{ number_format($voucher->discount_value, 0, ',', '.') }}đ
                                        </span>
                                    @endif
                                </div>
                                <div class="voucher-description">
                                    <p class="mb-1">{{ $voucher->name }}</p>
                                    @if($voucher->description)
                                        <small class="text-muted">{{ $voucher->description }}</small>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="voucher-details">
                                @if($voucher->min_order_value)
                                    <div class="detail-item">
                                        <i class="fas fa-shopping-cart text-muted me-2"></i>
                                        <span class="small">Đơn hàng tối thiểu: {{ number_format($voucher->min_order_value, 0, ',', '.') }}đ</span>
                                    </div>
                                @endif
                                
                                @if($voucher->discount_type == 'percentage' && $voucher->max_discount_amount)
                                    <div class="detail-item">
                                        <i class="fas fa-gift text-muted me-2"></i>
                                        <span class="small">Giảm tối đa: {{ number_format($voucher->max_discount_amount, 0, ',', '.') }}đ</span>
                                    </div>
                                @endif
                                
                                <div class="detail-item">
                                    <i class="fas fa-calendar-alt text-muted me-2"></i>
                                    <span class="small">Hạn sử dụng: {{ \Carbon\Carbon::parse($voucher->end_date)->format('d/m/Y') }}</span>
                                </div>
                                
                                @if($voucher->usage_limit_per_voucher)
                                    <div class="detail-item">
                                        <i class="fas fa-users text-muted me-2"></i>
                                        <span class="small" title="Tổng số lần voucher này đã được sử dụng bởi tất cả người dùng">
                                            Tổng lượt dùng: {{ $voucher->times_used }}/{{ $voucher->usage_limit_per_voucher }}
                                            @php
                                                $remainingUses = $voucher->usage_limit_per_voucher - $voucher->times_used;
                                            @endphp
                                            @if($remainingUses > 0)
                                                <span class="text-success">(Còn {{ $remainingUses }} lượt)</span>
                                            @else
                                                <span class="text-danger">(Hết lượt)</span>
                                            @endif
                                        </span>
                                    </div>
                                @endif
                                
                                @if(Auth::check() && $voucher->usage_limit_per_user)
                                    <div class="detail-item">
                                        <i class="fas fa-user text-muted me-2"></i>
                                        <span class="small" title="Số lần bạn đã sử dụng voucher này">
                                            Bạn đã dùng: {{ $voucher->user_used_count ?? 0 }}/{{ $voucher->usage_limit_per_user }}
                                            @php
                                                $userRemainingUses = $voucher->usage_limit_per_user - ($voucher->user_used_count ?? 0);
                                            @endphp
                                            @if($userRemainingUses > 0)
                                                <span class="text-success">(Còn {{ $userRemainingUses }} lượt)</span>
                                            @else
                                                <span class="text-danger">(Đã hết)</span>
                                            @endif
                                        </span>
                                    </div>
                                @endif
                            </div>
                        </div>
                        
                        <div class="voucher-action">
                            @php
                                $canUse = true;
                                if ($voucher->usage_limit_per_voucher) {
                                    $remainingUses = $voucher->usage_limit_per_voucher - $voucher->times_used;
                                    $canUse = $remainingUses > 0;
                                }
                            @endphp
                            
                            @if($canUse)
                                @php
                                    $userCanUse = true;
                                    if (Auth::check() && $voucher->usage_limit_per_user) {
                                        $userCanUse = ($voucher->user_used_count ?? 0) < $voucher->usage_limit_per_user;
                                    }
                                @endphp
                                
                                @if($userCanUse)
                                    <button type="button" class="btn btn-primary btn-sm apply-voucher-btn" data-code="{{ $voucher->code }}">
                                        <i class="fas fa-check me-1"></i>
                                        Chọn
                                    </button>
                                @else
                                    <span class="btn btn-warning btn-sm disabled">
                                        <i class="fas fa-user-times me-1"></i>
                                        Đã dùng
                                    </span>
                                @endif
                            @else
                                <span class="btn btn-secondary btn-sm disabled">
                                    <i class="fas fa-times me-1"></i>
                                    Hết lượt
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<div class="modal-footer border-0 pt-0">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
        <i class="fas fa-times me-1"></i>
        Đóng
    </button>
</div>

<style>
.voucher-list {
    max-height: 400px;
    overflow-y: auto;
}

.voucher-card {
    border: 2px solid #e9ecef;
    border-radius: 12px;
    background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);
    transition: all 0.3s ease;
    cursor: pointer;
    position: relative;
    overflow: hidden;
}

.voucher-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: linear-gradient(90deg, #ff3029, #ff6b6b);
}

.voucher-card:hover {
    border-color: #ff3029;
    box-shadow: 0 4px 15px rgba(255, 48, 41, 0.15);
    transform: translateY(-2px);
}

.voucher-content {
    display: flex;
    align-items: center;
    padding: 16px;
    gap: 16px;
}

.voucher-info {
    flex: 1;
}

.voucher-header {
    margin-bottom: 12px;
}

.voucher-code {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 8px;
}

.code-text {
    font-family: 'Courier New', monospace;
    font-weight: bold;
    font-size: 1.1rem;
    color: #ff3029;
    background: #fff3f3;
    padding: 4px 8px;
    border-radius: 6px;
    border: 1px dashed #ff3029;
}

.discount-badge {
    padding: 4px 8px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: bold;
    color: white;
}

.discount-badge.percentage {
    background: linear-gradient(45deg, #ff3029, #ff6b6b);
}

.discount-badge.fixed {
    background: linear-gradient(45deg, #28a745, #20c997);
}

.voucher-description p {
    font-weight: 600;
    color: #333;
    margin: 0;
}

.voucher-details {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.detail-item {
    display: flex;
    align-items: center;
    color: #6c757d;
}

.voucher-action {
    flex-shrink: 0;
}

.apply-voucher-btn {
    background: linear-gradient(45deg, #ff3029, #ff6b6b);
    border: none;
    border-radius: 8px;
    padding: 8px 16px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.apply-voucher-btn:hover {
    background: linear-gradient(45deg, #e02a23, #ff5252);
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(255, 48, 41, 0.3);
}

/* Custom scrollbar */
.voucher-list::-webkit-scrollbar {
    width: 6px;
}

.voucher-list::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 3px;
}

.voucher-list::-webkit-scrollbar-thumb {
    background: #c1c1c1;
    border-radius: 3px;
}

.voucher-list::-webkit-scrollbar-thumb:hover {
    background: #a8a8a8;
}

/* Responsive */
@media (max-width: 576px) {
    .voucher-content {
        flex-direction: column;
        align-items: stretch;
        gap: 12px;
    }
    
    .voucher-action {
        text-align: center;
    }
    
    .apply-voucher-btn {
        width: 100%;
    }
}
</style>